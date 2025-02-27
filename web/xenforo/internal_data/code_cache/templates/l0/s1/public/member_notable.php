<?php
// FROM HASH: 7e9eff154952ec528f119e5f7aa704ae
return array(
'macros' => array('overview_block' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'memberStat' => '!',
		'results' => '!',
		'showTitle' => true,
		'showFooter' => true,
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
					';
	if ($__templater->isTraversable($__vars['results'])) {
		foreach ($__vars['results'] AS $__vars['userId'] => $__vars['data']) {
			$__compilerTemp1 .= '
						<li>
							' . $__templater->callMacro(null, 'overview_row', array(
				'data' => $__vars['data'],
			), $__vars) . '
						</li>
					';
		}
	}
	$__compilerTemp1 .= '
				';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
		<li class="memberOverviewBlock">
			';
		if ($__vars['showTitle']) {
			$__finalCompiled .= '
				<h3 class="block-textHeader">
					<a href="' . $__templater->func('link', array('members', null, array('key' => $__vars['memberStat']['member_stat_key'], ), ), true) . '"
						class="memberOverViewBlock-title">' . $__templater->escape($__vars['memberStat']['title']) . '</a>
				</h3>
			';
		}
		$__finalCompiled .= '
			<ol class="memberOverviewBlock-list">
				' . $__compilerTemp1 . '
			</ol>
			';
		if ($__vars['showFooter']) {
			$__finalCompiled .= '
				<div class="memberOverviewBlock-seeMore">
					<a href="' . $__templater->func('link', array('members', null, array('key' => $__vars['memberStat']['member_stat_key'], ), ), true) . '">' . 'See more' . $__vars['xf']['language']['ellipsis'] . '</a>
				</div>
			';
		}
		$__finalCompiled .= '
		</li>
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
),
'overview_row' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'data' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	<div class="contentRow contentRow--alignMiddle">
		<div class="contentRow-figure">
			' . $__templater->func('avatar', array($__vars['data']['user'], 'xs', false, array(
	))) . '
		</div>
		<div class="contentRow-main">
			';
	if ($__vars['data']['value']) {
		$__finalCompiled .= '
				<div class="contentRow-extra contentRow-extra--large">' . $__templater->escape($__vars['data']['value']) . '</div>
			';
	}
	$__finalCompiled .= '
			<h3 class="contentRow-title">' . $__templater->func('username_link', array($__vars['data']['user'], true, array(
	))) . '</h3>
		</div>
	</div>
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped(($__vars['active'] ? $__templater->escape($__vars['active']['title']) : 'Notable members'));
	$__finalCompiled .= '

';
	$__compilerTemp1 = $__vars;
	$__compilerTemp1['pageSelected'] = ($__vars['active'] ? $__vars['active']['member_stat_key'] : 'overview');
	$__templater->wrapTemplate('member_wrapper', $__compilerTemp1);
	$__finalCompiled .= '

' . $__templater->callMacro(null, 'metadata_macros::canonical_url', array(
		'canonicalUrl' => $__templater->func('link', array('canonical:members', null, array('key' => ($__vars['active'] ? $__vars['active']['member_stat_key'] : null), ), ), false),
	), $__vars) . '

';
	$__templater->includeCss('member.less');
	$__finalCompiled .= '

';
	if ($__vars['userNotFound']) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--error blockMessage--iconic">' . 'The specified member cannot be found. Please enter a member\'s entire name.' . '</div>
';
	}
	$__finalCompiled .= '

';
	if ($__templater->test($__vars['memberStats'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="blockMessage">' . 'No notable members can currently be shown.' . '</div>
';
	} else {
		$__finalCompiled .= '
	<section class="block">
		<div class="block-container">
			';
		if ($__vars['active']) {
			$__finalCompiled .= '
				<ol class="block-body">
					';
			$__compilerTemp2 = true;
			if ($__templater->isTraversable($__vars['resultsData'][$__vars['active']['member_stat_key']])) {
				foreach ($__vars['resultsData'][$__vars['active']['member_stat_key']] AS $__vars['userId'] => $__vars['data']) {
					$__compilerTemp2 = false;
					$__finalCompiled .= '
						<li class="block-row block-row--separated">
							' . $__templater->callMacro(null, 'member_list_macros::item', array(
						'user' => $__vars['data']['user'],
						'extraData' => $__vars['data']['value'],
						'extraDataBig' => true,
					), $__vars) . '
						</li>
					';
				}
			}
			if ($__compilerTemp2) {
				$__finalCompiled .= '
						<li class="block-row">' . 'No users match the specified criteria.' . '</li>
					';
			}
			$__finalCompiled .= '
				</ol>
			';
		} else {
			$__finalCompiled .= '
				<div class="block-body">
					<ol class="memberOverviewBlocks">
						';
			if ($__templater->isTraversable($__vars['memberStats'])) {
				foreach ($__vars['memberStats'] AS $__vars['key'] => $__vars['memberStat']) {
					$__finalCompiled .= '
							' . $__templater->callMacro(null, 'overview_block', array(
						'memberStat' => $__vars['memberStat'],
						'results' => $__vars['resultsData'][$__vars['key']],
					), $__vars) . '
						';
				}
			}
			$__finalCompiled .= '
					</ol>
				</div>
			';
		}
		$__finalCompiled .= '
		</div>
	</section>
';
	}
	$__finalCompiled .= '

' . '

';
	return $__finalCompiled;
}
);