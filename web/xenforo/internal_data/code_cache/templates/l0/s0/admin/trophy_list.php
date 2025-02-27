<?php
// FROM HASH: 0d8134345c84e6fdea8d8661d626dd52
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Trophies');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('Add trophy', array(
		'href' => $__templater->func('link', array('trophies/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['trophies'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block">
		<div class="block-outer">
			' . $__templater->callMacro(null, 'filter_macros::quick_filter', array(
			'key' => 'trophies',
			'class' => 'block-outer-opposite',
		), $__vars) . '
		</div>
		<div class="block-container">
			<div class="block-body">
				';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['trophies'])) {
			foreach ($__vars['trophies'] AS $__vars['trophy']) {
				$__compilerTemp1 .= '
						' . $__templater->dataRow(array(
					'label' => $__templater->escape($__vars['trophy']['title']),
					'hint' => 'Points' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['trophy']['trophy_points']),
					'href' => $__templater->func('link', array('trophies/edit', $__vars['trophy'], ), false),
					'delete' => $__templater->func('link', array('trophies/delete', $__vars['trophy'], ), false),
				), array()) . '
					';
			}
		}
		$__finalCompiled .= $__templater->dataList('
					' . $__compilerTemp1 . '
				', array(
		)) . '
			</div>
			<div class="block-footer">
				<span class="block-footer-counter">' . $__templater->func('display_totals', array($__vars['trophies'], ), true) . '</span>
			</div>
		</div>
	</div>
';
	} else {
		$__finalCompiled .= '
	<div class="blockMessage">' . 'No trophies have been created yet.' . '</div>
';
	}
	$__finalCompiled .= '

' . $__templater->callMacro(null, 'option_macros::option_form_block', array(
		'options' => $__vars['options'],
	), $__vars);
	return $__finalCompiled;
}
);