<?php
// FROM HASH: 0c1fb8a14d935ac0fd4ba04cffd31cf0
return array(
'macros' => array('title' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'node' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	' . $__templater->formTextBoxRow(array(
		'name' => 'node[title]',
		'value' => $__vars['node']['title'],
	), array(
		'label' => 'Title',
	)) . '
';
	return $__finalCompiled;
}
),
'description' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'node' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	' . $__templater->formTextAreaRow(array(
		'name' => 'node[description]',
		'value' => $__vars['node']['description'],
		'autosize' => 'true',
	), array(
		'label' => 'Description',
		'hint' => 'You may use HTML',
		'explain' => 'The text (or HTML) you insert here must be valid within a &lt;p&gt; tag.',
	)) . '
';
	return $__finalCompiled;
}
),
'node_name' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'node' => '!',
		'optional' => true,
		'additionalExplain' => '',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	' . $__templater->formTextBoxRow(array(
		'name' => 'node[node_name]',
		'value' => $__vars['node']['node_name'],
		'dir' => 'ltr',
	), array(
		'label' => 'URL portion',
		'hint' => ($__vars['optional'] ? 'Optional' : ''),
		'explain' => ($__vars['optional'] ? 'If entered, the URL to this node will not contain an ID. Use a-z, 0-9, _, and - characters only. Note that once specified, changing this value will cause URLs to be broken.' : '') . ($__vars['additionalExplain'] ? (' ' . $__templater->filter($__vars['additionalExplain'], array(array('raw', array()),), true)) : ''),
	)) . '
';
	return $__finalCompiled;
}
),
'position' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'node' => '!',
		'nodeTree' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	$__compilerTemp1 = array(array(
		'value' => '0',
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'None' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	$__compilerTemp2 = $__templater->method($__vars['nodeTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp2)) {
		foreach ($__compilerTemp2 AS $__vars['treeEntry']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['treeEntry']['record']['node_id'],
				'label' => $__templater->func('repeat', array('--', $__vars['treeEntry']['depth'], ), true) . ' ' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'node[parent_node_id]',
		'value' => $__vars['node']['parent_node_id'],
	), $__compilerTemp1, array(
		'label' => 'Parent node',
	)) . '

	' . $__templater->callMacro(null, 'display_order_macros::row', array(
		'name' => 'node[display_order]',
		'value' => $__vars['node'],
		'explain' => 'The position of this item relative to other nodes with the same parent.',
	), $__vars) . '

	' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'node[display_in_list]',
		'selected' => $__vars['node']['display_in_list'],
		'label' => 'Display in the node list',
		'hint' => 'If unselected, users will not see this node in the list. However, if the URL is known, it will still be accessible.',
		'_type' => 'option',
	)), array(
	)) . '
';
	return $__finalCompiled;
}
),
'style' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'node' => '!',
		'styleTree' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	$__compilerTemp1 = array();
	$__compilerTemp2 = $__templater->method($__vars['styleTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp2)) {
		foreach ($__compilerTemp2 AS $__vars['treeEntry']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['treeEntry']['record']['style_id'],
				'label' => $__templater->func('repeat', array('--', $__vars['treeEntry']['depth'], ), true) . ' ' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'style_override',
		'selected' => $__vars['node']['style_id'],
		'label' => 'Override user style choice',
		'explain' => 'If specified, all visitors will view this item and its contents using the selected style, regardless of their personal style preference.',
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'node[style_id]',
		'value' => $__vars['node']['style_id'],
	), $__compilerTemp1)),
		'_type' => 'option',
	)), array(
	)) . '
';
	return $__finalCompiled;
}
),
'navigation' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'node' => '!',
		'navChoices' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	$__vars['defaultValue'] = ($__vars['node']['Parent']['effective_navigation_id'] ?: 'forums');
	$__finalCompiled .= '
	';
	$__vars['defaultNav'] = $__vars['navChoices'][$__vars['defaultValue']];
	$__finalCompiled .= '
	';
	$__compilerTemp1 = array(array(
		'value' => '',
		'label' => ('Default' . ($__vars['defaultNav'] ? ((' (' . $__templater->escape($__vars['defaultNav']['title'])) . ')') : '')),
		'_type' => 'option',
	));
	if ($__templater->isTraversable($__vars['navChoices'])) {
		foreach ($__vars['navChoices'] AS $__vars['nav']) {
			if ($__vars['nav']['navigation_id'] != '_default') {
				$__compilerTemp1[] = array(
					'value' => $__vars['nav']['navigation_id'],
					'label' => $__templater->escape($__vars['nav']['title']),
					'_type' => 'option',
				);
			}
		}
	}
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'node[navigation_id]',
		'value' => $__vars['node']['navigation_id'],
	), $__compilerTemp1, array(
		'label' => 'Navigation section',
		'explain' => 'This controls the navigation section that will be selected when a visitor browses this node. Child nodes will automatically inherit this value.',
	)) . '
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

' . '

' . '

' . '

' . '

';
	return $__finalCompiled;
}
);