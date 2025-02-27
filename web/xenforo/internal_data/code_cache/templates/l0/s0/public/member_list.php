<?php
// FROM HASH: 1451a5a0cd8929b15543cec8672e74cc
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Registered members');
	$__templater->pageParams['pageNumber'] = $__vars['page'];
	$__finalCompiled .= '

';
	$__compilerTemp1 = $__vars;
	$__compilerTemp1['pageSelected'] = 'member_list';
	$__templater->wrapTemplate('member_wrapper', $__compilerTemp1);
	$__finalCompiled .= '

' . $__templater->callMacro(null, 'metadata_macros::canonical_url', array(
		'canonicalUrl' => $__templater->func('link', array('canonical:members/list', null, array('page' => $__vars['page'], ), ), false),
	), $__vars) . '

<div class="block">
	<div class="block-container">
		<ol class="block-body">
			';
	if ($__templater->isTraversable($__vars['users'])) {
		foreach ($__vars['users'] AS $__vars['userId'] => $__vars['user']) {
			$__finalCompiled .= '
				<li class="block-row block-row--separated">
					' . $__templater->callMacro(null, 'member_list_macros::item', array(
				'user' => $__vars['user'],
			), $__vars) . '
				</li>
			';
		}
	}
	$__finalCompiled .= '
		</ol>
	</div>
	' . $__templater->func('page_nav', array(array(
		'link' => 'members/list',
		'page' => $__vars['page'],
		'total' => $__vars['total'],
		'wrapperclass' => 'block-outer block-outer--after',
		'perPage' => $__vars['perPage'],
	))) . '
</div>

';
	$__templater->modifySidebarHtml('_xfWidgetPositionSidebar542a4d64301ee04674b7c081f682b282', $__templater->widgetPosition('member_list_sidebar', array()), 'replace');
	return $__finalCompiled;
}
);