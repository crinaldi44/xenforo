<?php
// FROM HASH: 5bca637567d36d29c7da7ca54bc30432
return array(
'macros' => array('language_list' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'children' => '!',
		'defaultLanguageId' => '!',
		'depth' => '1',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	if (!$__templater->test($__vars['children'], 'empty', array())) {
		$__finalCompiled .= '
		';
		if ($__templater->isTraversable($__vars['children'])) {
			foreach ($__vars['children'] AS $__vars['child']) {
				$__finalCompiled .= '
			' . $__templater->callMacro(null, 'language_list_entry', array(
					'language' => $__vars['child']['record'],
					'children' => $__vars['child']['children'],
					'defaultLanguageId' => $__vars['defaultLanguageId'],
					'depth' => $__vars['depth'],
				), $__vars) . '
		';
			}
		}
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
),
'language_list_entry' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'language' => '!',
		'children' => '!',
		'defaultLanguageId' => '!',
		'depth' => '1',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	$__compilerTemp1 = array(array(
		'hash' => $__vars['language']['language_id'],
		'href' => ($__vars['language']['language_id'] ? $__templater->func('link', array('languages/edit', $__vars['language'], ), false) : ''),
		'label' => $__templater->escape($__vars['language']['title']),
		'class' => 'dataList-cell--d' . $__vars['depth'],
		'_type' => 'main',
		'html' => '',
	));
	if ($__vars['language']['language_id']) {
		$__compilerTemp1[] = array(
			'name' => 'user_selectable[' . $__vars['language']['language_id'] . ']',
			'selected' => $__vars['language']['user_selectable'],
			'class' => 'dataList-cell--separated u-hideMedium',
			'submit' => 'true',
			'tooltip' => 'Enable / disable \'' . $__vars['language']['title'] . '\'',
			'_type' => 'toggle',
			'html' => '',
		);
		$__compilerTemp1[] = array(
			'name' => 'default_language_id',
			'type' => 'radio',
			'value' => $__vars['language']['language_id'],
			'selected' => (($__vars['defaultLanguageId'] == $__vars['language']['language_id']) ? 1 : 0),
			'class' => 'dataList-cell--separated',
			'submit' => 'true',
			'_type' => 'toggle',
			'html' => '',
		);
	} else {
		$__compilerTemp1[] = array(
			'class' => 'u-hideMedium',
			'_type' => 'cell',
			'html' => '&nbsp;',
		);
		$__compilerTemp1[] = array(
			'_type' => 'cell',
			'html' => '&nbsp;',
		);
	}
	if ($__templater->method($__vars['language'], 'canEdit', array())) {
		$__compilerTemp1[] = array(
			'href' => $__templater->func('link', array('languages/phrases', $__vars['language'], ), false),
			'class' => 'dataList-cell--responsiveMenuItem',
			'_type' => 'action',
			'html' => 'Phrases',
		);
	} else {
		$__compilerTemp1[] = array(
			'class' => 'dataList-cell--alt dataList-cell--fauxResponsiveMenuItem',
			'_type' => 'cell',
			'html' => '&nbsp;',
		);
	}
	if ($__vars['language']['language_id']) {
		$__compilerTemp1[] = array(
			'href' => $__templater->func('link', array('languages/export', $__vars['language'], ), false),
			'overlay' => 'true',
			'class' => 'dataList-cell--responsiveMenuItem',
			'_type' => 'action',
			'html' => 'Export',
		);
	} else {
		$__compilerTemp1[] = array(
			'class' => 'dataList-cell--alt dataList-cell--fauxResponsiveMenuItem',
			'_type' => 'cell',
			'html' => '&nbsp;',
		);
	}
	if ($__templater->method($__vars['language'], 'canEdit', array())) {
		$__compilerTemp1[] = array(
			'class' => 'dataList-cell--responsiveMenuTrigger',
			'label' => '&#8226;&#8226;&#8226;',
			'_type' => 'popup',
			'html' => '
				<div class="menu" data-menu="menu" aria-hidden="true" data-menu-builder="dataList">
					<div class="menu-content">
						<h3 class="menu-header">' . 'More options' . '</h3>
						<div class="js-menuBuilderTarget"></div>
					</div>
				</div>
			',
		);
	} else {
		$__compilerTemp1[] = array(
			'class' => 'dataList-cell--alt dataList-cell--fauxResponsiveMenuTrigger',
			'_type' => 'cell',
			'html' => '&nbsp;',
		);
	}
	if ($__vars['language']['language_id']) {
		$__compilerTemp1[] = array(
			'href' => $__templater->func('link', array('languages/delete', $__vars['language'], ), false),
			'_type' => 'delete',
			'html' => '',
		);
	} else {
		$__compilerTemp1[] = array(
			'class' => 'dataList-cell--alt',
			'_type' => 'cell',
			'html' => '&nbsp;',
		);
	}
	$__finalCompiled .= $__templater->dataRow(array(
	), $__compilerTemp1) . '
	' . $__templater->callMacro(null, 'language_list', array(
		'children' => $__vars['children'],
		'depth' => ($__vars['depth'] + 1),
		'defaultLanguageId' => $__vars['defaultLanguageId'],
	), $__vars) . '
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Languages');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('Add language', array(
		'href' => $__templater->func('link', array('languages/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '
	' . $__templater->button('', array(
		'href' => $__templater->func('link', array('languages/import', ), false),
		'icon' => 'import',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

' . '
' . '

';
	if (!$__templater->test($__vars['languageTree'], 'empty', array())) {
		$__finalCompiled .= '
	' . $__templater->form('
		<div class="block-outer">
			' . $__templater->callMacro(null, 'filter_macros::quick_filter', array(
			'key' => 'languages',
			'class' => 'block-outer-opposite',
		), $__vars) . '
		</div>
		<div class="block-container">
			<div class="block-body">
				' . $__templater->dataList('
					' . $__templater->callMacro(null, 'language_list', array(
			'children' => $__vars['languageTree'],
			'defaultLanguageId' => $__vars['xf']['options']['defaultLanguageId'],
		), $__vars) . '
				', array(
		)) . '
			</div>
			<div class="block-footer">
				<span class="block-footer-counter">' . $__templater->func('display_totals', array($__templater->method($__vars['languageTree'], 'getFlattened', array(0, )), ), true) . '</span>
			</div>
		</div>
		' . $__templater->formHiddenVal('default_language_id_original', $__vars['xf']['options']['defaultLanguageId'], array(
		)) . '
	', array(
			'action' => $__templater->func('link', array('languages/toggle', ), false),
			'class' => 'block',
			'ajax' => 'true',
		)) . '
';
	}
	return $__finalCompiled;
}
);