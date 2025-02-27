<?php
// FROM HASH: cf5dff757303e0f9d12f01c77adfac2c
return array(
'macros' => array('select_forums' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'nodeIds' => '!',
		'nodeTree' => '!',
		'withRow' => '1',
		'selectName' => 'node_ids',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	';
	$__compilerTemp1 = array(array(
		'value' => '',
		'selected' => !$__vars['nodeIds'],
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'None' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	$__compilerTemp2 = $__templater->method($__vars['nodeTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp2)) {
		foreach ($__compilerTemp2 AS $__vars['treeEntry']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['treeEntry']['record']['node_id'],
				'disabled' => ($__vars['treeEntry']['record']['node_type_id'] != 'Forum'),
				'label' => $__templater->filter($__templater->func('repeat', array('&nbsp;&nbsp;', $__vars['treeEntry']['depth'], ), false), array(array('raw', array()),), true) . ' ' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__vars['inner'] = $__templater->preEscaped('
		<ul class="inputList">
			<li>' . $__templater->formSelect(array(
		'name' => $__vars['selectName'] . '[]',
		'value' => $__vars['nodeIds'],
		'size' => '7',
		'multiple' => 'multiple',
		'id' => 'js-applicableForums',
	), $__compilerTemp1) . '</li>

			' . $__templater->formCheckBox(array(
	), array(array(
		'label' => 'Select all',
		'id' => 'js-selectAllForums',
		'_type' => 'option',
	))) . '
		</ul>
	');
	$__finalCompiled .= '

	';
	if ($__vars['withRow']) {
		$__finalCompiled .= '
		' . $__templater->formRow('
			' . $__templater->filter($__vars['inner'], array(array('raw', array()),), true) . '
		', array(
			'rowtype' => 'input',
			'label' => 'Applicable forums',
		)) . '
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['inner'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '

	';
	$__templater->inlineJs('
		const selectAll = document.querySelector(\'#js-selectAllForums\')
		XF.on(selectAll, \'click\', e =>
		{
			const forums = document.querySelector(\'#js-applicableForums\')
			const options = forums.querySelectorAll(\'option:enabled\')
			options.forEach(option =>
			{
				option.selected = option.matches(\'[value=""]\')
					? !e.target.checked
					: e.target.checked
			})
		})
	', true);
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';

	return $__finalCompiled;
}
);