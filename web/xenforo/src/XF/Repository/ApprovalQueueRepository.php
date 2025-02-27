<?php

namespace XF\Repository;

use XF\Attachment\AbstractHandler;
use XF\Entity\ApprovalQueue;
use XF\Entity\LinkableInterface;
use XF\Finder\ApprovalQueueFinder;
use XF\Mvc\Entity\AbstractCollection;
use XF\Mvc\Entity\ArrayCollection;
use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class ApprovalQueueRepository extends Repository
{
	protected $handlerCache = [];

	/**
	 * @return Finder
	 */
	public function findUnapprovedContent()
	{
		return $this->finder(ApprovalQueueFinder::class)
			->setDefaultOrder('content_date');
	}

	public function isContentAwaitingApproval($contentType, $contentId)
	{
		$result = $this->db()->fetchOne("
			SELECT 1
			FROM xf_approval_queue
			WHERE content_type = ? AND content_id = ?
		", [$contentType, $contentId]);
		return (bool) $result;
	}

	public function getContentTypesFromCurrentQueue()
	{
		return $this->db()->fetchAllColumn("
			SELECT DISTINCT content_type
			FROM xf_approval_queue
			ORDER BY CONVERT (content_type USING {$this->db()->getUtf8Type()})
		");
	}

	/**
	 * @return AbstractHandler[]
	 */
	public function getApprovalQueueHandlers($throw = false)
	{
		$handlers = [];

		foreach (\XF::app()->getContentTypeField('approval_queue_handler_class') AS $contentType => $handlerClass)
		{
			$handler = $this->getApprovalQueueHandler($contentType, $throw);
			if ($handler)
			{
				$handlers[$contentType] = $handler;
			}
		}

		return $handlers;
	}
	/**
	 * @param $type
	 * @param bool $throw
	 *
	 * @return \XF\ApprovalQueue\AbstractHandler|null
	 */
	public function getApprovalQueueHandler($type, $throw = false)
	{
		if (isset($this->handlerCache[$type]))
		{
			return $this->handlerCache[$type];
		}

		$handlerClass = \XF::app()->getContentTypeFieldValue($type, 'approval_queue_handler_class');
		if (!$handlerClass)
		{
			if ($throw)
			{
				throw new \InvalidArgumentException("No approval queue handler for '$type'");
			}
			return null;
		}

		if (!class_exists($handlerClass))
		{
			if ($throw)
			{
				throw new \InvalidArgumentException("Approval queue handler for '$type' does not exist: $handlerClass");
			}
			return null;
		}

		$handlerClass = \XF::extendClass($handlerClass);
		$handler = new $handlerClass($type);

		$this->handlerCache[$type] = $handler;

		return $handler;
	}

	/**
	 * @param ArrayCollection $unapprovedItems
	 */
	public function filterViewableUnapprovedItems($unapprovedItems)
	{
		return $unapprovedItems->filter(function (ApprovalQueue $unapprovedItem)
		{
			$handler = $this->getApprovalQueueHandler($unapprovedItem->content_type);
			if (!$handler)
			{
				return false;
			}

			$content = $unapprovedItem->Content;
			return ($content && $handler->canView($content));
		});
	}

	/**
	 * @param AbstractCollection<ApprovalQueue> $unapprovedItems
	 */
	public function addContentToUnapprovedItems($unapprovedItems)
	{
		$contentMap = [];
		foreach ($unapprovedItems AS $key => $unapprovedItem)
		{
			$contentType = $unapprovedItem->content_type;
			if (!isset($contentMap[$contentType]))
			{
				$contentMap[$contentType] = [];
			}
			$contentMap[$contentType][$key] = $unapprovedItem->content_id;
		}

		foreach ($contentMap AS $contentType => $contentIds)
		{
			$handler = $this->getApprovalQueueHandler($contentType);
			if (!$handler)
			{
				continue;
			}

			$data = $handler->getContent($contentIds);
			foreach ($contentIds AS $key => $contentId)
			{
				$content = $data[$contentId] ?? null;
				$unapprovedItems[$key]->setContent($content);
			}

			$spamDetails = $handler->getSpamDetails($contentIds);
			foreach ($contentIds AS $key => $contentId)
			{
				$spamLogDetail = $spamDetails[$contentId] ?? null;
				$unapprovedItems[$key]->setSpamDetails($spamLogDetail);
			}
		}
	}

	/**
	 * @param ApprovalQueue[] $unapprovedItems
	 */
	public function cleanUpInvalidRecords($unapprovedItems)
	{
		foreach ($unapprovedItems AS $item)
		{
			if ($item->isInvalid())
			{
				$item->delete(false);
			}
		}
	}

	public function filterQueue(array $queue)
	{
		$newQueue = [];

		foreach ($queue AS $contentType => $actions)
		{
			$handler = $this->getApprovalQueueHandler($contentType);
			if (!$handler)
			{
				continue;
			}

			foreach ($actions AS $contentId => $action)
			{
				if (!$action)
				{
					continue;
				}

				$content = $handler->getContent($contentId);
				if (!$content || !$handler->canView($content))
				{
					continue;
				}

				$newQueue[$contentType][$contentId] = $action;
			}
		}

		return $newQueue;
	}

	public function rebuildUnapprovedCounts()
	{
		$cache = [
			'total' => $this->db()->fetchOne('SELECT COUNT(*) FROM xf_approval_queue'),
			'lastModified' => time(),
		];

		\XF::registry()->set('unapprovedCounts', $cache);
		return $cache;
	}

	public function getModeratorsWhoCanActionItem(
		Entity $content,
		bool $notifiableOnly = false
	)
	{
		/** @var ModeratorRepository $moderatorRepo */
		$moderatorRepo = $this->repository(ModeratorRepository::class);

		$moderators = $moderatorRepo
			->findModeratorsForList()
			->with('User.PermissionCombination')
			->fetch();

		if ($moderators->count())
		{
			/** @var \XF\ApprovalQueue\AbstractHandler $handler */
			$handler = $this->getApprovalQueueHandler($content->getEntityContentType());

			foreach ($moderators AS $id => $moderator)
			{
				$canView = \XF::asVisitor(
					$moderator->User,
					function () use ($content, $handler) { return $handler->canView($content); }
				);
				if (!$canView)
				{
					unset($moderators[$id]);
				}

				if ($notifiableOnly && !$moderator->notify_approval)
				{
					unset($moderators[$id]);
				}
			}
		}

		return $moderators;
	}

	public function sendModeratorActionEmail(ApprovalQueue $approvalQueueItem): bool
	{
		$content = $approvalQueueItem->getContent();
		if (!$content instanceof LinkableInterface)
		{
			return false;
		}

		$handler = $approvalQueueItem->getHandler();
		if (!$handler)
		{
			return false;
		}

		$emailTemplate = $handler->getEmailTemplateName();
		if (!$emailTemplate)
		{
			return false;
		}

		$moderatorsToEmail = $this->getModeratorsWhoCanActionItem($content, true);

		foreach ($moderatorsToEmail AS $moderator)
		{
			if ($moderator->notify_approval)
			{
				$user = $moderator->User;

				$params = array_merge([
					'receiver' => $user,
					'title' => $content->getContentTitle(),
					'link' => $content->getContentUrl(true),
				], $handler->getTemplateData($approvalQueueItem));

				$mailer = $this->app()->mailer();
				$mailer->newMail()
					->setToUser($user)
					->setTemplate($emailTemplate, $params)
					->queue();
			}
		}

		return true;
	}
}
