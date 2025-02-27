<?php

namespace XF\Pub;

use XF\Container;
use XF\CookieConsent;
use XF\Entity\UserRemember;
use XF\Finder\ReportFinder;
use XF\Http\Response;
use XF\IndexNow\Api;
use XF\Mvc\Renderer\AbstractRenderer;
use XF\Mvc\Reply\AbstractReply;
use XF\Mvc\Reply\Error;
use XF\Mvc\Reply\Message;
use XF\Mvc\Reply\View;
use XF\NoticeList;
use XF\PageCache;
use XF\Repository\ApprovalQueueRepository;
use XF\Repository\IpRepository;
use XF\Repository\NoticeRepository;
use XF\Repository\TfaRepository;
use XF\Repository\TrophyRepository;
use XF\Repository\UserAlertRepository;
use XF\Repository\UserGroupPromotionRepository;
use XF\Repository\UserRememberRepository;
use XF\Repository\UserRepository;
use XF\Session\Session;
use XF\Sitemap\Renderer;
use XF\Style;
use XF\Util\File;
use XF\Util\Php;

use function in_array, intval;

class App extends \XF\App
{
	public static $allowPageCache = true;

	protected $isServedFromCache = false;

	protected $preLoadLocal = [
		'bannedIps',
		'bbCodeCustom',
		'discouragedIps',
		'forumTypes',
		'notices',
		'noticesLastReset',
		'routeFilters',
		'routesPublic',
		'styles',
		'userFieldsInfo',
		'threadFieldsInfo',
		'threadPrefixes',
		'threadTypes',
	];

	public function initializeExtra()
	{
		$container = $this->container;

		$container['app.classType'] = 'Pub';
		$container['app.defaultType'] = 'public';

		$container['router'] = function (Container $c)
		{
			return $c['router.public'];
		};
		$container['session'] = function (Container $c)
		{
			return $c['session.public'];
		};

		$container['pageCache'] = function (Container $c)
		{
			$options = $c['config']['pageCache'];
			if (!$options['enabled'])
			{
				return null;
			}

			$cache = $this->cache('page', false, false);
			if (!$cache)
			{
				return null;
			}

			$pageCache = new PageCache($c['request'], $cache, $options['lifetime']);
			if (!$pageCache->isRequestCacheable())
			{
				return null;
			}

			if ($options['routeMatches'] && !$pageCache->routeMatchesPrefixes((array) $options['routeMatches']))
			{
				return null;
			}

			$pageCache->setRecordSessionActivity($options['recordSessionActivity']);

			$onSetup = $options['onSetup'];
			if ($onSetup instanceof \Closure)
			{
				$result = $onSetup($pageCache);
				if ($result === false)
				{
					return null;
				}
			}

			return $pageCache;
		};
	}

	public function setup(array $options = [])
	{
		parent::setup($options);
		$this->assertConfigExists();

		$this->fire('app_pub_setup', [$this]);
	}

	/**
	 * @return list<string>
	 */
	protected function getPreloadExtraKeys(): array
	{
		$keys = parent::getPreloadExtraKeys();

		$this->fire('app_pub_registry_preload', [$this, &$keys]);

		return $keys;
	}

	public function start($allowShortCircuit = false)
	{
		parent::start($allowShortCircuit);

		$this->fire('app_pub_start_begin', [$this]);

		$request = $this->request();
		$guestCacher = self::$allowPageCache ? $this->pageCache() : false;
		$guestCacheChecked = false;

		if ($allowShortCircuit)
		{
			switch ($request->getRequestUri())
			{
				case '/browserconfig.xml':
				case '/crossdomain.xml':
				case '/favicon.ico':
				case '/robots.txt':
					$response = $this->response();
					$response->httpCode(404);
					return $response;
			}

			$extendedUrl = ltrim($request->getExtendedUrl(), '/');

			if (preg_match('#^indexNow-[A-z0-9-]+\.txt$#', $extendedUrl, $match)
				&& $match[0] === Api::getKeyFileName())
			{
				return $this->renderIndexNow();
			}

			$sitemapCounter = null;
			if ($extendedUrl == 'sitemap.xml')
			{
				$sitemapCounter = 0;
			}
			else if (preg_match('#^sitemap-(\d+)\.xml$#', $extendedUrl, $match))
			{
				$sitemapCounter = intval($match[1]);
			}

			if ($sitemapCounter !== null)
			{
				/** @var Renderer $renderer */
				$renderer = $this['sitemap.renderer'];
				return $renderer->outputSitemap($this->response(), $sitemapCounter);
			}

			if ($guestCacher && $guestCacher->isDefinitelyGuest())
			{
				$cacheResponse = $guestCacher->getCachedPage($this);
				if ($cacheResponse)
				{
					$this->isServedFromCache = true;
					return $cacheResponse;
				}
				$guestCacheChecked = true;
			}
		}

		$session = $this->session();
		if (!$session->exists())
		{
			$this->onSessionCreation($session);
		}

		$user = $this->getVisitorFromSession($session);
		\XF::setVisitor($user);

		if ($allowShortCircuit && !$user->user_id && $guestCacher && !$guestCacheChecked)
		{
			$cacheResponse = $guestCacher->getCachedPage($this);
			if ($cacheResponse)
			{
				$this->isServedFromCache = true;
				return $cacheResponse;
			}
		}

		$visitor = \XF::visitor();
		if ($visitor->user_id)
		{
			$languageId = $visitor->language_id;
		}
		else
		{
			$username = $request->filter('_xfUsername', 'str', '');
			if ($username && !preg_match('/./su', $username))
			{
				$username = '';
			}

			$styleId = intval($request->getCookie('style_id', 0));
			$styleVariation = $request->getCookie('style_variation', '');
			if ($styleVariation && !preg_match('/./su', $styleVariation))
			{
				$styleVariation = '';
			}

			$languageId = intval($request->getCookie('language_id', 0));

			$visitor->setReadOnly(false);
			$visitor->setAsSaved('username', $username);
			$visitor->setAsSaved('style_id', $styleId);
			$visitor->setAsSaved('style_variation', $styleVariation);
			$visitor->setAsSaved('language_id', $languageId);
			$visitor->setReadOnly(true);
		}

		$language = $this->language($languageId);
		if (!$language->isUsable($visitor))
		{
			$language = $this->language(0);
		}

		$language->setTimeZone($visitor->timezone);
		\XF::setLanguage($language);

		$this->updateUserCaches();
		$this->updateModeratorCaches();

		$this->fire('app_pub_start_end', [$this]);

		return null;
	}

	protected function updateUserCaches()
	{
		$visitor = \XF::visitor();
		$session = $this->session();

		if (!$visitor->user_id)
		{
			return;
		}

		if ($this->options()->enableNotices)
		{
			if (!$session->keyExists('dismissedNotices'))
			{
				$updateDismissed = true;
			}
			else
			{
				$sessionLastNoticeUpdate = intval($session->get('lastNoticeUpdate'));
				$dbLastNoticeReset = $this->get('notices.lastReset');
				$updateDismissed = ($dbLastNoticeReset > $sessionLastNoticeUpdate);
			}

			if ($updateDismissed)
			{
				$session->dismissedNotices = $this->repository(NoticeRepository::class)->getDismissedNoticesForUser($visitor);
				$session->lastNoticeUpdate = \XF::$time;
			}
		}

		if (!$session->promotionChecked)
		{
			$session->promotionChecked = true;

			// if we've recently been active, let cron handle it
			if ($visitor->getValue('last_activity') < \XF::$time - 1800)
			{
				/** @var UserGroupPromotionRepository $userGroupPromotionRepo */
				$userGroupPromotionRepo = $this->repository(UserGroupPromotionRepository::class);
				$userGroupPromotionRepo->updatePromotionsForUser($visitor);
			}
		}

		if ($this->options()->enableTrophies && !$session->trophyChecked)
		{
			$session->trophyChecked = true;

			// if we've recently been active, let cron handle it
			if ($visitor->getValue('last_activity') < \XF::$time - 1800)
			{
				/** @var TrophyRepository $trophyRepo */
				$trophyRepo = $this->repository(TrophyRepository::class);
				$trophyRepo->updateTrophiesForUser($visitor);
			}
		}

		if (!$session->keyExists('previousActivity'))
		{
			$session->previousActivity = $visitor->getValue('last_activity'); // skip the getter to get what's in the DB
		}

		if ($visitor->alerts_unviewed && !$session->alertCountChecked)
		{
			$session->alertCountChecked = true;

			// count unread/unviewed alerts if last activity was over 30 days ago (the alert expiry cut off)
			if ($visitor->getValue('last_activity') < \XF::$time - (30 * 86400))
			{
				/** @var UserAlertRepository $alertRepo */
				$alertRepo = $this->repository(UserAlertRepository::class);
				$alertRepo->updateUnviewedCountForUser($visitor);
				$alertRepo->updateUnreadCountForUser($visitor);
			}
		}

		if ($visitor->last_summary_email_date === 0)
		{
			$visitor->fastUpdate('last_summary_email_date', \XF::$time);
		}
	}

	protected function updateModeratorCaches()
	{
		$visitor = \XF::visitor();
		$session = $this->session();

		if (!$visitor->is_moderator)
		{
			return;
		}

		$sessionReportCounts = $session->reportCounts;
		$registryReportCounts = $this->container->reportCounts;

		if ($sessionReportCounts === null
			|| ($sessionReportCounts && ($sessionReportCounts['lastBuilt'] < $registryReportCounts['lastModified']))
		)
		{
			/** @var ReportFinder $reportsFinder */
			$reportsFinder = $this->finder(ReportFinder::class);
			$reports = $reportsFinder->isActive()->fetch()->filterViewable();

			$total = 0;
			$assigned = 0;

			foreach ($reports AS $reportId => $report)
			{
				$total++;
				if ($report->assigned_user_id == $visitor->user_id)
				{
					$assigned++;
				}
			}

			$reportCounts = [
				'total' => $total,
				'assigned' => $assigned,
				'lastBuilt' => $registryReportCounts['lastModified'],
			];

			$session->reportCounts = $reportCounts;
		}

		$sessionUnapprovedCounts = $session->unapprovedCounts;
		$registryUnapprovedCounts = $this->container->unapprovedCounts;

		if ($sessionUnapprovedCounts === null
			|| ($sessionUnapprovedCounts && ($sessionUnapprovedCounts['lastBuilt'] < $registryUnapprovedCounts['lastModified']))
		)
		{
			/** @var ApprovalQueueRepository $approvalQueueRepo */
			$approvalQueueRepo = $this->repository(ApprovalQueueRepository::class);

			$unapprovedItems = $approvalQueueRepo->findUnapprovedContent()->fetch();
			$approvalQueueRepo->addContentToUnapprovedItems($unapprovedItems);
			$unapprovedItems = $approvalQueueRepo->filterViewableUnapprovedItems($unapprovedItems);

			$unapprovedCounts = [
				'total' => $unapprovedItems->count(),
				'lastBuilt' => $registryUnapprovedCounts['lastModified'],
			];

			$session->unapprovedCounts = $unapprovedCounts;
		}
	}

	protected function onSessionCreation(Session $session)
	{
		$loginUserId = $this->loginFromRememberCookie($session);

		if (!$loginUserId)
		{
			$this->request()->populateFromSearch($this->response());
		}
	}

	protected function loginFromRememberCookie(Session $session)
	{
		$rememberCookie = $this->request()->getCookie('user');
		if (!$rememberCookie)
		{
			return null;
		}

		/** @var UserRememberRepository $rememberRepo */
		$rememberRepo = $this->repository(UserRememberRepository::class);
		if (!$rememberRepo->validateByCookieValue($rememberCookie, $remember))
		{
			$this->response()->setCookie('user', false);
			return null;
		}

		/** @var UserRepository $userRepo */
		$userRepo = $this->repository(UserRepository::class);
		$user = $userRepo->getVisitor($remember->user_id);
		if (!$user)
		{
			return null;
		}

		$trustKey = $this->request()->getCookie('tfa_trust');

		/** @var TfaRepository $tfaRepo */
		$tfaRepo = $this->repository(TfaRepository::class);
		if ($tfaRepo->isUserTfaConfirmationRequired($user, $trustKey))
		{
			$session->tfaLoginUserId = $user->user_id;
			$session->tfaLoginDate = time();
			$session->tfaLoginRedirect = true;

			return null;
		}

		$session->changeUser($user);

		/** @var IpRepository $ipRepo */
		$ipRepo = $this->repository(IpRepository::class);
		$ipRepo->logCookieLoginIfNeeded($user->user_id, $this->request()->getIp());

		/** @var UserRemember $remember */
		$remember->extendExpiryDate();
		$remember->save();

		return $remember->user_id;
	}

	public function preRender(AbstractReply $reply, $responseType)
	{
		$visitor = \XF::visitor();

		$viewOptions = $reply->getViewOptions();
		if (!empty($viewOptions['style_id']))
		{
			$styleId = $viewOptions['style_id'];
			$forceStyle = true;
		}
		else
		{
			$styleId = $visitor->style_id;
			$forceStyle = false;
		}

		/** @var Style $style */
		$style = $this->container->create('style', $styleId);
		if ($style['style_id'] == $styleId)
		{
			// true if the style matches the requested one; if it didn't just accept it
			if (!$forceStyle && !$style->isUsable($visitor))
			{
				$style = $this->container->create('style', 0);
			}
		}

		$this->templater()->setStyle($style);
		$this->iconRenderer()->setStyle($style);

		if (!empty($viewOptions['sessionActivity']) && self::$allowPageCache && !\XF::visitor()->user_id)
		{
			$guestCacher = $this->pageCache();
			if ($guestCacher)
			{
				$guestCacher->setSessionActivity($viewOptions['sessionActivity']);
			}
		}

		parent::preRender($reply, $responseType);
	}

	public function complete(Response $response)
	{
		parent::complete($response);

		if ($this->container->isCached('session'))
		{
			$session = $this->session();
			if ($session->isStarted() && $session->hasData())
			{
				$session->save();
				$session->applyToResponse($response);
			}
			// don't save empty sessions as it would generally be pointless
		}

		if (self::$allowPageCache && !$this->isServedFromCache && !\XF::visitor()->user_id)
		{
			$guestCacher = $this->pageCache();
			if ($guestCacher)
			{
				$guestCacher->saveToCache($response, $this);
			}
		}

		$this->fire('app_pub_complete', [$this, &$response]);
	}

	protected function renderPageHtml($content, array $params, AbstractReply $reply, AbstractRenderer $renderer)
	{
		$templateName = $params['template'] ?? 'PAGE_CONTAINER';
		if (!$templateName)
		{
			return $content;
		}

		$templater = $this->templater();

		if (!strpos($templateName, ':'))
		{
			$templateName = 'public:' . $templateName;
		}

		$pageSection = $reply->getSectionContext();
		if (isset($params['section']))
		{
			$pageSection = $params['section'];
			$reply->setSectionContext($pageSection);
		}
		$params['pageSection'] = $pageSection;

		$params['controller'] = $reply->getControllerClass();
		$params['action'] = $reply->getAction();
		$params['actionMethod'] = $reply->getAction()
			? 'action' . Php::camelCase($reply->getAction(), '-')
			: null;

		$params['classType'] = $this->container('app.classType');
		$params['containerKey'] = $reply->getContainerKey();
		$params['contentKey'] = $reply->getContentKey();

		if ($reply instanceof View)
		{
			$params['view'] = $reply->getViewClass();
			$params['template'] = $reply->getTemplateName();
		}
		else if ($reply instanceof Error || $reply->getResponseCode() >= 400)
		{
			$params['template'] = 'error';
		}
		else if ($reply instanceof Message)
		{
			$params['template'] = 'message_page';
		}

		$params['fromSearch'] = $this->request()->getFromSearch();
		$params['pageStyleId'] = $templater->getStyleId();

		$navTree = $this->getNavigation($params, $pageSection)['tree'];
		$params['navTree'] = $navTree;

		// note that this intentionally only selects a top level entry
		if (isset($navTree[$pageSection]))
		{
			$selectedNavEntry = $navTree[$pageSection];
		}
		else
		{
			$defaultNavId = $this->get('defaultNavigationId');
			$selectedNavEntry = $navTree[$defaultNavId] ?? null;
		}

		$params['selectedNavEntry'] = $selectedNavEntry;
		$params['selectedNavChildren'] = !empty($selectedNavEntry['children']) ? $selectedNavEntry['children'] : [];

		$params['content'] = $content;
		$params['notices'] = $this->getNoticeList($params)->getNotices();

		$skipSidebarWidgets = $params['skipSidebarWidgets'] ?? false;

		// TODO: These positions should receive some context (could just pass in $params but we want this for non global positions too)
		if (!$skipSidebarWidgets)
		{
			$topWidgets = $templater->widgetPosition('pub_sidebar_top');
			$bottomWidgets = $templater->widgetPosition('pub_sidebar_bottom');
			$templater->modifySidebarHtml('_xfWidgetPositionPubSidebarTop', $topWidgets, 'prepend');
			$templater->modifySidebarHtml('_xfWidgetPositionPubSidebarBottom', $bottomWidgets, 'append');

			$params['sidebar'] = $templater->getSidebarHtml();
			$params['sideNav'] = $templater->getSideNavHtml();
		}

		$this->fire('app_pub_render_page', [$this, &$params, $reply, $renderer]);

		return $templater->renderTemplate($templateName, $params);
	}

	protected function getNavigation(array $params, $selectedNav = '')
	{
		$navigation = null;

		$file = File::getCodeCachePath() . '/' . $this->container['navigation.file'];
		if (file_exists($file))
		{
			$closure = include $file;
			if ($closure)
			{
				$navigation = $this->templater()->renderNavigationClosure($closure, $selectedNav, $params);
			}
		}

		if (!$navigation || !isset($navigation['tree']))
		{
			$navigation = [
				'tree' => [],
				'flat' => [],
			];
		}

		$this->fire('navigation_setup', [$this, &$navigation['flat'], &$navigation['tree']]);

		return $navigation;
	}

	protected function getNoticeList(array $pageParams)
	{
		$class = $this->extendClass(NoticeList::class);
		/** @var NoticeList $noticeList */
		$noticeList = new $class($this, \XF::visitor(), $pageParams);

		$dismissedNotices = $this->session()->dismissedNotices;
		if ($dismissedNotices)
		{
			$noticeList->setDismissed($dismissedNotices);
		}
		$this->addDefaultNotices($noticeList, $pageParams);

		if ($this->options()->enableNotices)
		{
			foreach ($this->container('notices') AS $key => $notice)
			{
				$noticeList->addConditionalNotice($key, $notice['notice_type'], $notice['message'], $notice);
			}
		}

		$this->fire('notices_setup', [$this, $noticeList, $pageParams]);

		return $noticeList;
	}

	protected function addDefaultNotices(NoticeList $noticeList, array $pageParams)
	{
		$options = $this->options();
		$visitor = \XF::visitor();
		$templater = $this->templater();

		if (\XF::$debugMode && \XF::$versionId != $options->currentVersionId)
		{
			$noticeList->addNotice(
				'upgrade_pending',
				'block',
				$templater->renderTemplate('public:notice_upgrade_pending', $pageParams),
				['display_style' => 'accent']
			);
		}

		if (!$options->boardActive && $visitor->is_admin)
		{
			$noticeList->addNotice(
				'board_closed',
				'block',
				$templater->renderTemplate('public:notice_board_closed', $pageParams),
				['display_style' => 'accent']
			);
		}

		if ($visitor->user_id && in_array($visitor->user_state, ['email_confirm', 'email_confirm_edit']))
		{
			$noticeList->addNotice(
				'confirm_email',
				'block',
				$templater->renderTemplate('public:notice_confirm_email', $pageParams)
			);
		}

		if ($visitor->user_id && $visitor->user_state == 'email_bounce')
		{
			$noticeList->addNotice(
				'email_bounce',
				'block',
				$templater->renderTemplate('public:notice_email_bounce', $pageParams)
			);
		}

		if ($visitor->user_id && $visitor->user_state == 'moderated')
		{
			$noticeList->addNotice(
				'moderated',
				'block',
				$templater->renderTemplate('public:notice_moderated', $pageParams)
			);
		}

		if ($visitor->canUsePushNotifications())
		{
			$noticeList->addNotice(
				'enable_push',
				'bottom_fixer',
				$templater->renderTemplate('public:notice_enable_push', $pageParams),
				[
					'display_style' => 'custom',
					'css_class' => 'notice--primary notice--enablePush js-enablePushContainer',
				]
			);
		}

		$cookieConsent = $this->options()->cookieConsent ?? [];
		$cookieConsentMode = $cookieConsent['type'] ?? 'disabled';
		if (
			$cookieConsentMode === CookieConsent::MODE_ADVANCED ||
			(!$visitor->user_id && $cookieConsentMode === CookieConsent::MODE_SIMPLE)
		)
		{
			$cookieCssClasses = ['notice--primary'];
			if ($cookieConsentMode === CookieConsent::MODE_ADVANCED)
			{
				$cookieCssClasses[] = 'notice--cookieAdvanced';
			}
			else
			{
				$cookieCssClasses[] = 'notice--cookie';
			}

			$noticeList->addNotice(
				'cookies',
				'bottom_fixer',
				$templater->renderTemplate('public:notice_cookies', $pageParams),
				[
					'dismissible' => true,
					'notice_id' => -1,
					'custom_dismissible' => true,
					'display_style' => 'custom',
					'css_class' => implode(' ', $cookieCssClasses),
				]
			);
		}
	}

	protected function renderIndexNow()
	{
		$request = $this->request();
		$response = $this->response();

		$indexNowKeyContent = Api::getKeyFileContents();

		$response->body(trim($indexNowKeyContent));
		$response->httpCode(200);
		$response->send($request);

		exit();
	}

	/**
	 * @return PageCache|null
	 */
	public function pageCache()
	{
		return $this->container['pageCache'];
	}

	public function isServedFromCache(): bool
	{
		return $this->isServedFromCache;
	}
}
