<?php
// FROM HASH: 0fe71863fa5403a070afe331780b324d
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit tags');
	$__finalCompiled .= '

';
	$__templater->breadcrumbs($__templater->method($__vars['thread'], 'getBreadcrumbs', array()));
	$__finalCompiled .= '

' . $__templater->callMacro(null, 'tag_macros::edit_form', array(
		'action' => $__templater->func('link', array('threads/tags', $__vars['thread'], ), false),
		'uneditableTags' => $__vars['uneditableTags'],
		'editableTags' => $__vars['editableTags'],
		'minTags' => $__vars['forum']['min_tags'],
		'tagList' => 'tagList--thread-' . $__vars['thread']['thread_id'],
	), $__vars) . '
';
	return $__finalCompiled;
}
);