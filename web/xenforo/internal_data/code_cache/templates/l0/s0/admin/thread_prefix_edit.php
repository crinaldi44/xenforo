<?php
// FROM HASH: e52c4163c065b48b2598ec98a8eeb965
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__compilerTemp1 = $__vars;
	$__compilerTemp1['extraOptions'] = $__templater->preEscaped('
		' . $__templater->callMacro(null, 'forum_selection_macros::select_forums', array(
		'nodeIds' => $__vars['nodeIds'],
		'nodeTree' => $__vars['nodeTree'],
	), $__vars) . '
	');
	$__finalCompiled .= $__templater->includeTemplate('base_prefix_edit', $__compilerTemp1);
	return $__finalCompiled;
}
);