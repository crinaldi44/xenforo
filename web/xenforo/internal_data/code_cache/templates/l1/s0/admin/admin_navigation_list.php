<?php
// FROM HASH: 01b4e1f794b15e2ad0b78ad9dd8aac24
return array(
'macros' => array('navigation_list' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'children' => '!',
		'depth' => '1',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	if ($__templater->isTraversable($__vars['children'])) {
		foreach ($__vars['children'] AS $__vars['child']) {
			$__finalCompiled .= '
		' . $__templater->callMacro(null, 'navigation_list_entry', array(
				'navigation' => $__vars['child']['record'],
				'children' => $__vars['child']['children'],
				'depth' => $__vars['depth'],
			), $__vars) . '
	';
		}
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
),
'navigation_list_entry' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'navigation' => '!',
		'children' => '!',
		'depth' => '1',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	if ($__vars['depth'] == 1) {
		$__finalCompiled .= '
		';
		$__compilerTemp1 = '';
		if ($__vars['navigation']['icon']) {
			$__compilerTemp1 .= $__templater->fontAwesome($__templater->escape($__vars['navigation']['icon']) . ' fa-fw', array(
			));
		}
		$__compilerTemp2 = '';
		if ($__vars['navigation']['link']) {
			$__compilerTemp2 .= '<span class="dataList-hint" dir="auto">' . $__templater->escape($__vars['navigation']['link']) . '</span>';
		}
		$__finalCompiled .= $__templater->dataRow(array(
			'rowtype' => 'subsection',
		), array(array(
			'href' => $__templater->func('link', array('admin-navigation/edit', $__vars['navigation'], ), false),
			'hash' => $__vars['navigation']['navigation_id'],
			'_type' => 'cell',
			'html' => '
				<div class="dataList-textRow">
					' . $__compilerTemp1 . '
					' . $__templater->escape($__vars['navigation']['title']) . '
					' . $__compilerTemp2 . '
				</div>
			',
		),
		array(
			'class' => 'dataList-cell--min dataList-cell--hint',
			'_type' => 'cell',
			'html' => $__templater->escape($__vars['navigation']['display_order']),
		),
		array(
			'_type' => 'cell',
			'html' => '&nbsp;',
		),
		array(
			'href' => $__templater->func('link', array('admin-navigation/delete', $__vars['navigation'], ), false),
			'_type' => 'delete',
			'html' => '',
		))) . '
	';
	} else {
		$__finalCompiled .= '
		';
		$__compilerTemp3 = '';
		if ($__vars['navigation']['icon']) {
			$__compilerTemp3 .= $__templater->fontAwesome($__templater->escape($__vars['navigation']['icon']), array(
			));
		}
		$__compilerTemp4 = '';
		if ($__vars['navigation']['link']) {
			$__compilerTemp4 .= '<span class="dataList-hint" dir="auto">' . $__templater->escape($__vars['navigation']['link']) . '</span>';
		}
		$__finalCompiled .= $__templater->dataRow(array(
		), array(array(
			'href' => $__templater->func('link', array('admin-navigation/edit', $__vars['navigation'], ), false),
			'class' => 'dataList-cell--d' . ($__vars['depth'] - 1),
			'hash' => $__vars['navigation']['navigation_id'],
			'_type' => 'cell',
			'html' => '

				<div class="dataList-textRow">
					' . $__compilerTemp3 . '
					' . $__templater->escape($__vars['navigation']['title']) . '
					' . $__compilerTemp4 . '
				</div>
			',
		),
		array(
			'class' => 'dataList-cell--min dataList-cell--hint',
			'_type' => 'cell',
			'html' => $__templater->escape($__vars['navigation']['navigation_id']) . ' / ' . $__templater->escape($__vars['navigation']['display_order']),
		),
		array(
			'class' => 'dataList-cell--action u-hideMedium',
			'label' => 'Add' . $__vars['xf']['language']['ellipsis'],
			'_type' => 'popup',
			'html' => '

				<div class="menu" data-menu="menu" aria-hidden="true">
					<div class="menu-content">
						<h3 class="menu-header">' . 'Add' . $__vars['xf']['language']['ellipsis'] . '</h3>
						<a href="' . $__templater->func('link', array('admin-navigation/add', null, array('parent_navigation_id' => $__vars['navigation']['parent_navigation_id'], ), ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Sibling' . '</a>
						<a href="' . $__templater->func('link', array('admin-navigation/add', null, array('parent_navigation_id' => $__vars['navigation']['navigation_id'], ), ), true) . '" class="menu-linkRow" data-xf-click="overlay">' . 'Child' . '</a>
					</div>
				</div>
			',
		),
		array(
			'href' => $__templater->func('link', array('admin-navigation/delete', $__vars['navigation'], ), false),
			'_type' => 'delete',
			'html' => '',
		))) . '
	';
	}
	$__finalCompiled .= '
	' . $__templater->callMacro(null, 'navigation_list', array(
		'children' => $__vars['children'],
		'depth' => ($__vars['depth'] + 1),
	), $__vars) . '
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Admin navigation');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('Add navigation', array(
		'href' => $__templater->func('link', array('admin-navigation/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

<div class="block">
	<div class="block-outer">
		' . $__templater->callMacro(null, 'filter_macros::quick_filter', array(
		'key' => 'admin-navigation',
		'class' => 'block-outer-opposite',
	), $__vars) . '
	</div>
	<div class="block-container">
		<div class="block-body">
			' . $__templater->dataList('
				' . $__templater->callMacro(null, 'navigation_list', array(
		'children' => $__vars['tree'],
	), $__vars) . '
			', array(
	)) . '
		</div>
		<div class="block-footer">
			<span class="block-footer-counter">' . $__templater->func('display_totals', array($__templater->method($__vars['tree'], 'getFlattened', array(0, )), ), true) . '</span>
		</div>
	</div>
</div>

' . '

';
	return $__finalCompiled;
}
);