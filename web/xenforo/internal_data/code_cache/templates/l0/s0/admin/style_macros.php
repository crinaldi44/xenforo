<?php
// FROM HASH: 419df2894fb9a72113c63e951afd4070
return array(
'macros' => array('style_change_menu' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'styleTree' => '!',
		'route' => '!',
		'routeParams' => array(),
		'currentStyle' => null,
		'linkClass' => 'button button--link',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	<a class="' . $__templater->escape($__vars['linkClass']) . ' menuTrigger"
		data-xf-click="menu"
		role="button"
		tabindex="0"
		aria-expanded="false"
		aria-haspopup="true">' . 'Style' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['currentStyle']['title']) . '</a>

	<div class="menu" data-menu="menu" aria-hidden="true">
		<div class="menu-content">
			<h3 class="menu-header">' . 'Styles' . '</h3>
			';
	$__compilerTemp1 = $__templater->method($__vars['styleTree'], 'getFlattened', array());
	if ($__templater->isTraversable($__compilerTemp1)) {
		foreach ($__compilerTemp1 AS $__vars['treeEntry']) {
			$__finalCompiled .= '
				<a href="' . $__templater->func('link', array($__vars['route'], $__vars['treeEntry']['record'], $__vars['routeParams'], ), true) . '"
					class="menu-linkRow ' . ((($__vars['currentStyle'] AND ($__vars['currentStyle']['style_id'] == $__vars['treeEntry']['record']['style_id']))) ? 'is-selected' : '') . '">
					<span class="u-depth' . $__templater->escape($__vars['treeEntry']['depth']) . '">' . $__templater->escape($__vars['treeEntry']['record']['title']) . '</span>
				</a>
			';
		}
	}
	$__finalCompiled .= '
		</div>
	</div>
';
	return $__finalCompiled;
}
),
'style_select' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'styleTree' => '!',
		'styleId' => '!',
		'name' => 'style_id',
		'row' => true,
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	';
	$__compilerTemp1 = array();
	$__compilerTemp2 = $__templater->method($__vars['styleTree'], 'getFlattened', array());
	if ($__templater->isTraversable($__compilerTemp2)) {
		foreach ($__compilerTemp2 AS $__vars['treeEntry']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['treeEntry']['record']['style_id'],
				'label' => $__templater->func('repeat', array('--', $__vars['treeEntry']['depth'], ), true) . ' ' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__vars['select'] = $__templater->preEscaped('
		' . $__templater->formSelect(array(
		'name' => $__vars['name'],
		'value' => $__vars['styleId'],
	), $__compilerTemp1) . '
	');
	$__finalCompiled .= '

	';
	if ($__vars['row']) {
		$__finalCompiled .= '
		' . $__templater->formRow('

			' . $__templater->filter($__vars['select'], array(array('raw', array()),), true) . '
		', array(
			'rowtype' => 'input',
			'label' => 'Style',
		)) . '
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['select'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	return $__finalCompiled;
}
);