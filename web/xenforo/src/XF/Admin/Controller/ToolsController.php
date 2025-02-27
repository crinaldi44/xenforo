<?php

namespace XF\Admin\Controller;

use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use XF\ControllerPlugin\AdminSectionPlugin;
use XF\Entity\AddOnInstallBatch;
use XF\Entity\FileCheck;
use XF\Entity\UpgradeCheck;
use XF\Job\JobResult;
use XF\Job\PermissionRebuild;
use XF\Mvc\ParameterBag;
use XF\Repository\AddOnRepository;
use XF\Repository\FileCheckRepository;
use XF\Repository\PermissionCombinationRepository;
use XF\Repository\PermissionEntryRepository;
use XF\Repository\UpgradeCheckRepository;
use XF\Service\AddOnArchive\InstallBatchCreatorService;
use XF\Service\ImageProxyService;
use XF\Service\Unfurl\TesterService;
use XF\Service\Upgrade\CheckerService;
use XF\Service\Upgrade\DownloaderService;
use XF\Service\Upgrade\ValidatorService;
use XF\Session\Session;
use XF\Util\File;
use XF\Validator\Email;
use XF\Validator\Url;

use function get_class;

class ToolsController extends AbstractController
{
	public function actionIndex()
	{
		return $this->plugin(AdminSectionPlugin::class)->actionView('tools');
	}

	public function actionRebuild()
	{
		$this->setSectionContext('rebuildCaches');
		$this->assertAdminPermission('rebuildCache');

		if ($this->isPost())
		{
			$job = $this->filter('job', 'str');
			$options = $this->filter('options', 'array');

			$runner = $this->app->job($job, null, $options);
			if ($runner && $runner->canTriggerByChoice())
			{
				$uniqueId = 'Rebuild' . $job;
				$id = $this->app->jobManager()->enqueueUnique(
					$uniqueId,
					$job,
					$options
				);

				$reply = $this->redirect(
					$this->buildLink('tools/run-job', null, [
						'only_id' => $id,
						'_xfRedirect' => $this->buildLink('tools/rebuild', null, ['success' => 1]),
					])
				);
				$reply->setPageParam('skipManualJobRun', true);
				return $reply;
			}
			else
			{
				return $this->error(\XF::phrase('this_cache_could_not_be_rebuilt'), 500);
			}
		}
		else
		{
			$viewParams = [
				'success' => $this->filter('success', 'bool'),
				'hasStoppedManualJobs' => $this->app->jobManager()->hasStoppedManualJobs(),
			];
			return $this->view('XF:Tools\Rebuild', 'tools_rebuild', $viewParams);
		}
	}

	public function actionRunJob()
	{
		$redirect = $this->getDynamicRedirect(null, false);

		$jobManager = $this->app->jobManager();

		$onlyIdsComma = $this->filter('only_ids', 'str');
		if ($onlyIdsComma)
		{
			$onlyIds = array_map('intval', explode(',', $onlyIdsComma));
		}
		else
		{
			$onlyIds = [];
		}

		$onlyId = $this->filter('only_id', 'uint');
		if ($onlyId)
		{
			array_unshift($onlyIds, $onlyId);
		}

		$only = $this->filter('only', 'str');
		if ($only)
		{
			$onlyByName = $jobManager->getUniqueJob($only);
			if ($onlyByName)
			{
				$onlyIds[] = $onlyByName['job_id'];
			}
		}

		$canCancel = false;
		$skipManualJobRun = false;
		$status = '';
		$jobId = null;

		if ($this->isPost())
		{
			// we may be doing an add-on action, so lets make sure that any errors get logged
			\XF::app()->error()->setIgnorePendingUpgrade(true);

			// force errors onto this page -- otherwise errors display the standard wrapper which can
			// cause people to leave which creates other problems
			$this->setViewOption('force_page_template', 'PAGE_RUN_JOB');

			$cancel = $this->filter('cancel', 'uint');
			if ($cancel)
			{
				$job = $jobManager->getJob($cancel);
				if ($job)
				{
					$runner = $jobManager->getJobRunner($job);
					if ($runner && $runner->canCancel())
					{
						$jobManager->cancelJob($job);
					}
				}
			}

			$maxRunTime = $this->app->config('jobMaxRunTime');

			if ($onlyIds)
			{
				$runResult = $jobManager->runByIds($onlyIds, $maxRunTime);
				$result = $runResult['result'];
				$onlyIds = $runResult['remaining'];

				if ($jobManager->hasManualEnqueued())
				{
					$extraIds = $jobManager->getManualEnqueued();
					foreach ($extraIds AS $extraId)
					{
						$onlyIds[] = $extraId;
					}

					$skipManualJobRun = true;
				}

				$continue = !empty($onlyIds);
			}
			else
			{
				$result = $jobManager->runQueue(true, $this->app->config('jobMaxRunTime'));
				$continue = $jobManager->queuePending(true);
			}

			if (!$continue)
			{
				// if we had manual jobs added, this will never be hit so we don't need to skip
				return $this->redirect($redirect);
			}

			if ($result)
			{
				$canCancel = $result->canCancel && $result->result !== JobResult::RESULT_COMPLETED;
				$status = $result->statusMessage;
				$jobId = $result->jobId;
			}
		}

		if (!$jobId)
		{
			if ($onlyIds)
			{
				$firstId = reset($onlyIds);
				$job = $jobManager->getJob($firstId);
			}
			else
			{
				$job = $jobManager->getFirstRunnable(true);
			}
			if ($job)
			{
				$runner = $jobManager->getJobRunner($job);
				if ($runner)
				{
					$canCancel = $runner->canCancel();
					$status = $runner->getStatusMessage();
					$jobId = $runner->getJobId();
				}
			}
		}

		$viewParams = [
			'canCancel' => $canCancel,
			'status' => $status,
			'jobId' => $jobId,
			'redirect' => $redirect,
			'onlyIds' => $onlyIds,
		];
		$reply = $this->view('XF:Tools\RunJob', 'tools_run_job', $viewParams);
		$reply->setPageParam('skipManualJobRun', $skipManualJobRun);

		return $reply;
	}

	public function actionCleanUpPermissions()
	{
		$this->assertPostOnly();
		$this->setSectionContext('rebuildCaches');
		$this->assertAdminPermission('rebuildCache');

		/** @var PermissionCombinationRepository $permComboRepo */
		$permComboRepo = $this->repository(PermissionCombinationRepository::class);

		$missing = $permComboRepo->insertGuestCombinationIfMissing();
		if ($missing)
		{
			$this->app->jobManager()->enqueueUnique('permissionRebuild', PermissionRebuild::class);
		}

		/** @var PermissionEntryRepository $permEntryRepo */
		$permEntryRepo = $this->repository(PermissionEntryRepository::class);

		$permEntryRepo->deleteOrphanedGlobalUserPermissionEntries();
		$permEntryRepo->deleteOrphanedContentUserPermissionEntries();

		$permComboRepo->deleteUnusedPermissionCombinations();

		return $this->redirect($this->buildLink('tools/rebuild', null, ['success' => 1]));
	}

	public function actionTestUrlUnfurling()
	{
		$this->setSectionContext('testUrlUnfurling');
		$this->assertAdminPermission('checksAndTests');

		$urlValidator = \XF::app()->validator(Url::class);

		$url = $this->filter('url', 'str');
		$url = $urlValidator->coerceValue($url);

		if ($this->isPost())
		{
			if ($urlValidator->isValid($url, $errorKey))
			{
				/** @var TesterService $testerService */
				$testerService = $this->service(TesterService::class, $url);
				$results = $testerService->test($error, $body);
			}
			else
			{
				$results = false;
				$error = "The URL was not valid.";
				$body = null;
			}
		}
		else
		{
			$results = false;
			$error = false;
			$body = null;
		}

		$viewParams = [
			'url' => $url,
			'results' => $results,
			'error' => $error,
			'body' => $body,
		];
		return $this->view('XF:Tools\TestUrlUnfurling', 'tools_test_url_unfurling', $viewParams);
	}

	public function actionTestEmail()
	{
		$this->setSectionContext('testOutboundEmail');
		$this->assertAdminPermission('checksAndTests');

		$emailValidator = $this->app->validator(Email::class);
		$options = $this->options();

		$defaultEmail = \XF::visitor()->email ?: $options->contactEmailAddress ?: $options->defaultEmailAddress;

		$email = $this->filter('email', 'str', $defaultEmail);
		$email = $emailValidator->coerceValue($email);

		$mailer = $this->app->mailer();
		$transport = $mailer->getDefaultTransport();
		$result = false;

		if ($this->isPost() && $emailValidator->isValid($email))
		{
			$mail = $mailer->newMail();
			$mail->setTo($email);
			$mail->setContent(
				\XF::phrase('outbound_email_test_subject', ['board' => $this->options()->boardTitle])->render('raw'),
				\XF::phrase('outbound_email_test_body', ['username' => \XF::visitor()->username, 'board' => $this->options()->boardTitle])
			);

			$sent = $mail->send($transport, false);

			if ($sent)
			{
				$result = [
					'sent' => true,
					'log' => $sent->getDebug(),
				];
			}
		}

		$class = get_class($transport);
		$extra = '';

		if ($transport instanceof EsmtpTransport)
		{
			$extra = $transport->getStream()->getHost() . ':' . $transport->getStream()->getPort();
		}

		$viewParams = [
			'email' => $email,
			'transportClass' => $class,
			'transportExtra' => $extra,
			'result' => $result,
		];
		return $this->view('XF:Tools\TestMail', 'tools_test_mail', $viewParams);
	}

	public function actionTestImageProxy()
	{
		$this->setSectionContext('testImageProxy');
		$this->assertAdminPermission('checksAndTests');

		$urlValidator = \XF::app()->validator(Url::class);

		$url = $this->filter('url', 'str');
		$url = $urlValidator->coerceValue($url);

		if ($this->isPost() && $url && $urlValidator->isValid($url))
		{
			/** @var ImageProxyService $proxyService */
			$proxyService = $this->service(ImageProxyService::class);
			$results = $proxyService->testImageFetch($url);
		}
		else
		{
			$results = false;
		}

		$viewParams = [
			'url' => $url,
			'results' => $results,
		];
		return $this->view('XF:Tools\TestImageProxy', 'tools_test_image_proxy', $viewParams);
	}

	public function actionFileCheck()
	{
		$this->assertAdminPermission('checksAndTests');

		if ($this->isPost())
		{
			$fileCheck = $this->em()->create(FileCheck::class);
			$fileCheck->save();

			$this->app->jobManager()->enqueueUnique(
				'fileCheck',
				\XF\Job\FileCheck::class,
				[
					'check_id' => $fileCheck->check_id,
				]
			);

			$reply = $this->redirect(
				$this->buildLink('tools/run-job', null, [
					'only' => 'fileCheck',
					'_xfRedirect' => $this->buildLink('tools/file-check/results', $fileCheck),
				])
			);
			$reply->setPageParam('skipManualJobRun', true);
			return $reply;
		}
		else
		{
			$page = $this->filterPage();
			$perPage = 20;

			/** @var FileCheckRepository $fileCheckRepo */
			$fileCheckRepo = $this->repository(FileCheckRepository::class);
			$fileCheckFinder = $fileCheckRepo->findFileChecksForList()
				->limitByPage($page, $perPage);

			$viewParams = [
				'fileChecks' => $fileCheckFinder->fetch(),
				'page' => $page,
				'perPage' => $perPage,
				'total' => $fileCheckFinder->total(),
			];
			return $this->view('XF:Tools\FileCheck', 'tools_file_check', $viewParams);
		}
	}

	public function actionFileCheckResults(ParameterBag $params)
	{
		$this->assertAdminPermission('checksAndTests');

		/** @var FileCheck $fileCheck */
		$fileCheck = $this->assertRecordExists(FileCheck::class, $params->check_id);

		$addOns = $this->repository(AddOnRepository::class)->findAddOnsForList();

		$viewParams = [
			'addOns' => $addOns->fetch(),
			'fileCheck' => $fileCheck,
			'results' => $fileCheck->results,
		];
		return $this->view('XF:Tools\FileCheckResult', 'tools_file_check_result', $viewParams);
	}

	public function actionUpgradeCheck()
	{
		$this->assertAdminPermission('upgradeXenForo');
		$this->assertUpgradeCheckingPossible();

		/** @var UpgradeCheckRepository $upgradeCheckRepo */
		$upgradeCheckRepo = $this->repository(UpgradeCheckRepository::class);

		if ($this->isPost())
		{
			/** @var CheckerService $checker */
			$checker = $this->app->service(CheckerService::class);
			$check = $checker->check();
			$failed = $check ? false : true;

			return $this->redirect($this->buildLink('tools/upgrade-check', null, ['failed' => $failed]));
		}
		else
		{
			$viewParams = [
				'upgradeCheck' => $upgradeCheckRepo->getLatestUpgradeCheck(),
				'failed' => $this->filter('failed', 'bool'),
			];
			return $this->view('XF:Tools\UpgradeCheck', 'tools_upgrade_check', $viewParams);
		}
	}

	public function actionUpgradeXf()
	{
		$this->assertAdminPermission('upgradeXenForo');
		$this->assertUpgradeCheckingPossible();
		$this->assertCanOneClickUpgrade();

		/** @var UpgradeCheckRepository $upgradeCheckRepo */
		$upgradeCheckRepo = $this->repository(UpgradeCheckRepository::class);
		$upgradeCheck = $upgradeCheckRepo->getLatestUpgradeCheck();

		if (!$upgradeCheck)
		{
			return $this->redirect($this->buildLink('tools/upgrade-check'));
		}

		if (!$this->isPost())
		{
			// only do this if we're going to show the form listing the upgrades
			$upgradeCheck = $this->rerunUpgradeCheckIfNeeded($upgradeCheck);
		}

		if (!$upgradeCheck->canDownload())
		{
			return $this->error(\XF::phrase('issues_with_license_must_resolve_before_upgrading'));
		}
		if (!$upgradeCheck->hasAvailableUpdate('XF', $error, $availableUpdate))
		{
			return $this->message($error);
		}

		/** @var ValidatorService $validator */
		$validator = $this->service(ValidatorService::class);
		if (!$validator->canAttempt($error))
		{
			return $this->error(\XF::phrase('following_issue_found_one_click_upgrade_x', ['error' => $error]));
		}

		$latestXfAvailable = $upgradeCheck->getLatestAvailableInfo('XF');
		if ($latestXfAvailable && $latestXfAvailable['version_id'] > $availableUpdate['version_id'])
		{
			$alternativeVersion = $latestXfAvailable;
		}
		else
		{
			$alternativeVersion = null;
		}

		$useLatest = $this->filter('latest', 'bool');
		if ($useLatest && $alternativeVersion)
		{
			$availableUpdate = $alternativeVersion;
			$alternativeVersion = null;
		}

		if ($this->isPost())
		{
			$confirmVersionId = $this->filter('confirm_version_id', 'uint');
			if ($confirmVersionId != $availableUpdate['version_id'])
			{
				return $this->error(\XF::phrase('available_versions_changed_since_last_upgrade_check_back_refresh'));
			}

			if ($upgradeCheck->license_agreement_required)
			{
				$agree = $this->filter('agree', 'bool');
				if (!$agree)
				{
					return $this->error(\XF::phrase('you_must_agree_to_terms_of_xenforo_license_agreement_to_continue'));
				}
			}

			/** @var DownloaderService $downloader */
			$downloader = $this->service(DownloaderService::class, 'XF');

			$dir = File::getTempDir();
			$upgradeKey = \XF::generateRandomString(40);
			$targetFile = "{$dir}/upgrade-{$upgradeKey}.zip";
			$downloader->setDownloadTarget($targetFile);

			if ($upgradeCheck->license_agreement_required)
			{
				$downloader->setLicenseAgreementAccepted(true);
			}

			$download = $downloader->download($availableUpdate['version_id'], $availableUpdate['release_date'], $error);
			if (!$download)
			{
				return $this->error($error);
			}

			// setup an install session so we can start the upgrade immediately
			/** @var Session $installSession */
			$installSession = $this->app->get('session.install');
			$installSession->changeUser(\XF::visitor());
			$installSession->save();
			$installSession->applyToResponse($this->app->response());

			$pather = $this->app->router()->getPather();
			$viewParams = [
				'upgraderUrl' => $pather('install/oc-upgrader.php', 'base'),
				'upgradeKey' => $upgradeKey,
			];
			return $this->view(
				'XF:Tools\UpgradeXfRedirect',
				'tools_upgrade_xf_redirect',
				$viewParams
			);
		}
		else
		{
			$viewParams = [
				'upgradeCheck' => $upgradeCheck,
				'availableUpdate' => $availableUpdate,
				'alternativeVersion' => $alternativeVersion,
				'useLatest' => $useLatest,
			];
			return $this->view(
				'XF:Tools\UpgradeXf',
				'tools_upgrade_xf',
				$viewParams
			);
		}
	}

	protected function downloadAndCreateAddOnBatch(array $filesToDownload, bool $acceptedLicenseAgreement = false)
	{
		$downloadedFiles = [];

		foreach ($filesToDownload AS $addOnId => $fileToDownload)
		{
			/** @var DownloaderService $downloader */
			$downloader = $this->service(DownloaderService::class, $addOnId);
			$downloader->setValidateFile(false); // most validation happens in the archive validator

			if ($acceptedLicenseAgreement)
			{
				$downloader->setLicenseAgreementAccepted(true);
			}

			$download = $downloader->download($fileToDownload['version_id'], $fileToDownload['release_date'], $error);
			if (!$download)
			{
				throw $this->exception($this->error($error));
			}

			/** @var \XF\Service\AddOnArchive\ValidatorService $validator */
			$validator = $this->service(\XF\Service\AddOnArchive\ValidatorService::class, $download, $addOnId);
			if (!$validator->validate($error))
			{
				throw $this->exception($this->error($error));
			}

			$downloadedFiles[$addOnId] = $download;
		}

		/** @var InstallBatchCreatorService $creator */
		$creator = $this->service(InstallBatchCreatorService::class, $this->app->addOnManager());
		foreach ($downloadedFiles AS $addOnId => $downloadedFile)
		{
			$creator->addArchive($downloadedFile, "{$addOnId}.zip");
		}

		if (!$creator->validate($errors))
		{
			throw $this->exception($this->error($errors));
		}

		/** @var AddOnInstallBatch $addOnBatch */
		return $creator->save();
	}

	public function actionUpgradeXfAddOn()
	{
		$this->assertAdminPermission('upgradeXenForo');
		$this->assertAdminPermission('addOn');
		$this->assertUpgradeCheckingPossible();
		$this->assertCanOneClickUpgrade();

		/** @var UpgradeCheckRepository $upgradeCheckRepo */
		$upgradeCheckRepo = $this->repository(UpgradeCheckRepository::class);
		$upgradeCheck = $upgradeCheckRepo->getLatestUpgradeCheck();

		if (!$upgradeCheck)
		{
			return $this->redirect($this->buildLink('tools/upgrade-check'));
		}

		if (!$this->isPost())
		{
			// only do this if we're going to show the form listing the upgrades
			$upgradeCheck = $this->rerunUpgradeCheckIfNeeded($upgradeCheck);
		}

		if (!$upgradeCheck->canDownload())
		{
			return $this->error(\XF::phrase('issues_with_license_must_resolve_before_upgrading'));
		}

		/** @var AddOnRepository $addOnRepo */
		$addOnRepo = $this->repository(AddOnRepository::class);
		if (!$addOnRepo->canInstallFromArchive($error, true))
		{
			return $this->error(\XF::phrase('following_issue_found_one_click_upgrade_x', ['error' => $error]));
		}

		$availableUpdates = [];
		$addOns = [];

		foreach ($upgradeCheck->available_updates AS $addOnId => $null)
		{
			if ($upgradeCheck->hasAvailableUpdate($addOnId, $error, $availableUpdate, $addOn))
			{
				$availableUpdates[$addOnId] = $availableUpdate;
				$addOns[$addOnId] = $addOn;
			}
		}

		if ($this->isPost())
		{
			$confirmUpdates = $this->filter('confirm_updates', 'array-uint');
			$filesToDownload = [];
			foreach ($confirmUpdates AS $addOnId => $versionId)
			{
				if (!$upgradeCheck->hasAvailableUpdate($addOnId, $error, $availableUpdate))
				{
					return $this->message($error);
				}
				if ($availableUpdate['version_id'] !== $versionId)
				{
					return $this->error(\XF::phrase('available_versions_changed_since_last_upgrade_check_back_refresh'));
				}
				$filesToDownload[$addOnId] = $availableUpdate;
			}

			if (!$filesToDownload)
			{
				return $this->error(\XF::phrase('no_updates_were_selected_for_download'));
			}

			if ($upgradeCheck->license_agreement_required)
			{
				$agree = $this->filter('agree', 'bool');
				if (!$agree)
				{
					return $this->error(\XF::phrase('you_must_agree_to_terms_of_xenforo_license_agreement_to_continue'));
				}
			}

			$addOnBatch = $this->downloadAndCreateAddOnBatch($filesToDownload, $upgradeCheck->license_agreement_required);

			// note: this will bypass the install from archive config check intentionally
			return $this->redirect(
				$this->buildLink('add-ons/install-from-archive-confirm', null, ['batch_id' => $addOnBatch->batch_id])
			);
		}
		else
		{
			$viewParams = [
				'upgradeCheck' => $upgradeCheck,
				'availableUpdates' => $availableUpdates,
				'addOns' => $addOns,
			];
			return $this->view(
				'XF:Tools\UpgradeXfAddOn',
				'tools_upgrade_xf_addon',
				$viewParams
			);
		}
	}

	public function actionInstallXfAddOn()
	{
		$this->assertAdminPermission('upgradeXenForo');
		$this->assertAdminPermission('addOn');
		$this->assertUpgradeCheckingPossible();
		$this->assertCanOneClickUpgrade();

		/** @var UpgradeCheckRepository $upgradeCheckRepo */
		$upgradeCheckRepo = $this->repository(UpgradeCheckRepository::class);
		$upgradeCheck = $upgradeCheckRepo->getLatestUpgradeCheck();

		if (!$upgradeCheck)
		{
			return $this->redirect($this->buildLink('tools/upgrade-check'));
		}
		if (!$upgradeCheck->canDownload())
		{
			return $this->error(\XF::phrase('issues_with_license_must_resolve_before_upgrading'));
		}

		/** @var AddOnRepository $addOnRepo */
		$addOnRepo = $this->repository(AddOnRepository::class);
		if (!$addOnRepo->canInstallFromArchive($error, true))
		{
			return $this->error(\XF::phrase('following_issue_found_one_click_upgrade_x', ['error' => $error]));
		}

		$installableAddOns = [];

		foreach ($upgradeCheck->installable_add_ons AS $addOnId => $install)
		{
			$installableAddOns[$addOnId] = $install;
		}

		if ($this->isPost())
		{
			$confirmInstalls = $this->filter('confirm_install', 'array-uint');
			$filesToDownload = [];
			foreach ($confirmInstalls AS $addOnId => $versionId)
			{
				$filesToDownload[$addOnId] = $installableAddOns[$addOnId];
			}

			if (!$filesToDownload)
			{
				return $this->error(\XF::phrase('no_installs_were_selected_for_download'));
			}

			if ($upgradeCheck->license_agreement_required)
			{
				$agree = $this->filter('agree', 'bool');
				if (!$agree)
				{
					return $this->error(\XF::phrase('you_must_agree_to_terms_of_xenforo_license_agreement_to_continue'));
				}
			}

			$addOnBatch = $this->downloadAndCreateAddOnBatch($filesToDownload, $upgradeCheck->license_agreement_required);

			// note: this will bypass the install from archive config check intentionally
			return $this->redirect(
				$this->buildLink('add-ons/install-from-archive-confirm', null, ['batch_id' => $addOnBatch->batch_id])
			);
		}
		else
		{
			$viewParams = [
				'upgradeCheck' => $upgradeCheck,
				'installableAddOns' => $installableAddOns,
			];
			return $this->view(
				'XF:Tools\InstallXfAddOn',
				'tools_install_xf_addon',
				$viewParams
			);
		}
	}

	/**
	 * If the upgrade check is potentially out of date, rerun the check and if we get a result
	 * back, return the new check result. (If not, keep the old one.)
	 *
	 * This helps account for a case where the available versions have changed between check and download.
	 *
	 * @param UpgradeCheck $upgradeCheck
	 *
	 * @return UpgradeCheck
	 */
	protected function rerunUpgradeCheckIfNeeded(UpgradeCheck $upgradeCheck)
	{
		if ($upgradeCheck->isRefreshRecommended())
		{
			/** @var CheckerService $checker */
			$checker = $this->app->service(CheckerService::class);
			$newCheck = $checker->check();
			if ($newCheck)
			{
				$upgradeCheck = $newCheck;
			}
		}

		return $upgradeCheck;
	}

	protected function assertUpgradeCheckingPossible()
	{
		/** @var UpgradeCheckRepository $upgradeCheckRepo */
		$upgradeCheckRepo = $this->repository(UpgradeCheckRepository::class);

		if (!$upgradeCheckRepo->canCheckForUpgrades($error))
		{
			if (!$error)
			{
				$error = \XF::phrase('due_to_your_configuration_not_possible_check_for_upgrades');
			}
			throw $this->exception($this->error($error));
		}
	}

	protected function assertCanOneClickUpgrade()
	{
		/** @var UpgradeCheckRepository $upgradeCheckRepo */
		$upgradeCheckRepo = $this->repository(UpgradeCheckRepository::class);

		if (!$upgradeCheckRepo->canOneClickUpgrade($error))
		{
			throw $this->exception($this->error($error));
		}
	}

	public function actionTransmogrifier()
	{
		return $this->view('XF:Tools\Transmogrifer', 'tools_transmogrifer');
	}

	public function actionTransmogrifierReset()
	{
		$this->assertPostOnly();

		$simpleCache = $this->app->simpleCache();
		$transmogrifierCount = $simpleCache['XF']['transmogrifierCount'] += 1;

		$viewParams = [
			'count' => $transmogrifierCount,
		];
		return $this->view('XF:Tools\Transmogrifer\Reset', 'tools_transmogrifer_reset', $viewParams);
	}

	public function actionPhpinfo()
	{
		$this->assertAdminPermission('serverInfo');
		phpinfo();
		die();
	}
}
