<?php
// FROM HASH: a9292b92a5d23d775558152f29346e28
return array(
'macros' => array('currency_list' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'value' => '!',
		'includePopular' => true,
		'row' => false,
		'rowLabel' => '',
		'name' => 'cost_currency',
		'rowClass' => '',
		'class' => '',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	$__vars['currencyData'] = $__templater->method($__vars['xf']['app'], 'data', array('XF:Currency', ));
	$__finalCompiled .= '
	';
	$__vars['currencies'] = $__templater->method($__vars['currencyData'], 'getCurrencyOptions', array());
	$__finalCompiled .= '
	';
	if ($__vars['includePopular']) {
		$__finalCompiled .= '
		';
		$__vars['popularCurrencies'] = $__templater->method($__vars['currencyData'], 'getCurrencyOptions', array(true, ));
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '

	';
	$__compilerTemp1 = array(array(
		'value' => '',
		'label' => '&nbsp;',
		'_type' => 'option',
	));
	if ($__vars['popularCurrencies']) {
		$__compilerTemp1[] = array(
			'label' => 'Popular currencies',
			'_type' => 'optgroup',
			'options' => array(),
		);
		end($__compilerTemp1); $__compilerTemp2 = key($__compilerTemp1);
		$__compilerTemp1[$__compilerTemp2]['options'] = $__templater->mergeChoiceOptions($__compilerTemp1[$__compilerTemp2]['options'], $__vars['popularCurrencies']);
		$__compilerTemp1[] = array(
			'label' => 'Other currencies',
			'_type' => 'optgroup',
			'options' => array(),
		);
		end($__compilerTemp1); $__compilerTemp3 = key($__compilerTemp1);
		$__compilerTemp1[$__compilerTemp3]['options'] = $__templater->mergeChoiceOptions($__compilerTemp1[$__compilerTemp3]['options'], $__vars['currencies']);
	} else {
		$__compilerTemp1 = $__templater->mergeChoiceOptions($__compilerTemp1, $__vars['currencies']);
	}
	$__vars['select'] = $__templater->preEscaped('
		' . $__templater->formSelect(array(
		'name' => $__vars['name'],
		'value' => $__vars['value'],
		'class' => $__vars['class'],
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
			'class' => $__vars['rowClass'],
			'label' => $__templater->escape($__vars['rowLabel']),
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

	return $__finalCompiled;
}
);