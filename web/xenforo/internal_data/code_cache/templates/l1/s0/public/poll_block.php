<?php
// FROM HASH: 32bf1b359658677f90570a39e6a01c33
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Poll results');
	$__finalCompiled .= '

';
	$__templater->breadcrumbs($__vars['breadcrumbs']);
	$__finalCompiled .= '

' . $__templater->callMacro(null, 'poll_macros::poll_block', array(
		'poll' => $__vars['poll'],
		'simpleDisplay' => $__vars['simpleDisplay'],
	), $__vars);
	return $__finalCompiled;
}
);