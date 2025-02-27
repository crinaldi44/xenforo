<?php
// FROM HASH: 678810e49bd192c59295ec60d5bde3e7
return array(
'macros' => array('property_edit' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'property' => '!',
		'definitionEditable' => false,
		'isActive' => true,
		'customizationState' => '',
		'enableVariations' => false,
		'submitName' => 'properties',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	';
	if ($__vars['property']['property_type'] == 'css') {
		$__finalCompiled .= '
		' . $__templater->callMacro(null, 'property_edit_css', array(
			'property' => $__vars['property'],
			'definitionEditable' => $__vars['definitionEditable'],
			'isActive' => $__vars['isActive'],
			'customizationState' => $__vars['customizationState'],
			'submitName' => $__vars['submitName'],
		), $__vars) . '
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->callMacro(null, 'property_edit_value', array(
			'property' => $__vars['property'],
			'definitionEditable' => $__vars['definitionEditable'],
			'customizationState' => $__vars['customizationState'],
			'enableVariations' => $__vars['enableVariations'],
			'submitName' => $__vars['submitName'],
		), $__vars) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
),
'property_edit_value' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'property' => '!',
		'definitionEditable' => '!',
		'customizationState' => '!',
		'enableVariations' => false,
		'submitName' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	';
	$__templater->includeCss('style_properties.less');
	$__finalCompiled .= '

	';
	$__vars['titleHtml'] = $__templater->preEscaped('<span class="u-anchorTarget" id="sp-' . $__templater->escape($__vars['property']['property_name']) . '"></span>' . $__templater->escape($__vars['property']['title']));
	$__finalCompiled .= '

	';
	$__vars['formBaseKey'] = $__vars['submitName'] . '[' . $__vars['property']['property_name'] . ']';
	$__finalCompiled .= '

	';
	$__compilerTemp1 = '';
	if ($__vars['xf']['development']) {
		$__compilerTemp1 .= $__templater->escape($__vars['property']['property_name']) . ' ' . $__templater->filter($__vars['property']['display_order'], array(array('parens', array()),), true);
	}
	$__compilerTemp2 = '';
	if ($__vars['definitionEditable']) {
		$__compilerTemp2 .= '
			<a href="' . $__templater->func('link', array('style-properties/edit', $__vars['property'], ), true) . '">' . 'Edit' . '</a>
		';
	}
	$__compilerTemp3 = '';
	if ($__vars['property']['addon_id'] AND ($__vars['property']['Group'] AND (($__vars['property']['addon_id'] != $__vars['property']['Group']['addon_id']) AND ($__vars['property']['addon_id'] != 'XF')))) {
		$__compilerTemp3 .= '
			<span class="formRow-hint-featured">
				' . $__templater->escape($__vars['property']['AddOn']['title']) . '
			</span>
		';
	}
	$__vars['hintHtml'] = $__templater->preEscaped($__templater->func('trim', array('
		' . $__compilerTemp1 . '
		' . $__compilerTemp2 . '

		' . $__compilerTemp3 . '

		' . $__templater->callMacro(null, 'customization_hint', array(
		'state' => $__vars['customizationState'],
		'submitName' => $__vars['submitName'],
		'property' => $__vars['property'],
		'checkbox' => true,
	), $__vars) . '

		' . $__templater->formHiddenVal($__vars['submitName'] . '_listed[]', $__vars['property']['property_name'], array(
	)) . '
	'), false));
	$__finalCompiled .= '

	';
	$__vars['valueOptions'] = $__templater->method($__vars['property'], 'getValueOptions', array());
	$__finalCompiled .= '

	';
	$__vars['rowClass'] = ($__vars['property']['depends_on'] ? ('js-stylePropDependsOn-' . $__vars['property']['depends_on']) : '') . ' xf-' . $__vars['property']['property_name'] . ' js-property--' . $__vars['property']['property_name'];
	$__finalCompiled .= '

	<span class="u-anchorTarget" id="@xf-' . $__templater->escape($__vars['property']['property_name']) . '"></span>

	';
	if ($__vars['property']['value_type'] == 'boolean') {
		$__finalCompiled .= '

		<!--boolean-->
		' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => $__vars['formBaseKey'],
			'value' => '1',
			'selected' => $__vars['property']['property_value'] == 1,
			'data-xf-init' => 'disabler',
			'data-container' => '.js-stylePropDependsOn-' . $__vars['property']['property_name'],
			'data-optional' => 'true',
			'data-hide' => ($__vars['valueOptions']['hideDependent'] ?: 'false'),
			'label' => $__templater->escape($__vars['titleHtml']),
			'hint' => $__templater->escape($__vars['property']['description']),
			'_type' => 'option',
		)), array(
			'rowclass' => $__vars['rowClass'],
			'hint' => $__templater->escape($__vars['hintHtml']),
		)) . '


	';
	} else if ($__vars['property']['value_type'] == 'radio') {
		$__finalCompiled .= '

		';
		if ($__vars['property']['has_variations']) {
			$__finalCompiled .= '
			';
			$__compilerTemp4 = '';
			if ($__vars['enableVariations']) {
				$__compilerTemp4 .= '
					<ul class="listPlain inputGroup-container">
						<li>
							<div class="inputGroup inputGroup--grow">
								';
				$__compilerTemp5 = $__templater->method($__vars['property'], 'getVariations', array());
				if ($__templater->isTraversable($__compilerTemp5)) {
					foreach ($__compilerTemp5 AS $__vars['variation']) {
						$__compilerTemp4 .= '
									';
						if ($__vars['variation'] != 'default') {
							$__compilerTemp4 .= '
										<span class="inputGroup-splitter"></span>
									';
						}
						$__compilerTemp4 .= '

									';
						$__compilerTemp6 = $__templater->mergeChoiceOptions(array(), $__vars['valueOptions']);
						$__compilerTemp4 .= $__templater->formRadio(array(
							'name' => $__vars['formBaseKey'] . '[' . $__vars['variation'] . ']',
							'value' => $__templater->method($__vars['property'], 'getVariationValue', array($__vars['variation'], )),
						), $__compilerTemp6) . '
								';
					}
				}
				$__compilerTemp4 .= '
							</div>
						</li>
					</ul>
				';
			} else {
				$__compilerTemp4 .= '
					';
				$__compilerTemp7 = $__templater->mergeChoiceOptions(array(), $__vars['valueOptions']);
				$__compilerTemp4 .= $__templater->formRadio(array(
					'name' => $__vars['formBaseKey'] . '[default]',
					'value' => $__templater->method($__vars['property'], 'getVariationValue', array('default', )),
				), $__compilerTemp7) . '

					';
				$__compilerTemp8 = $__templater->method($__vars['property'], 'getVariations', array(false, ));
				if ($__templater->isTraversable($__compilerTemp8)) {
					foreach ($__compilerTemp8 AS $__vars['variation']) {
						$__compilerTemp4 .= '
						' . $__templater->formHiddenVal($__vars['formBaseKey'] . '[' . $__vars['variation'] . ']', $__templater->method($__vars['property'], 'getVariationValue', array($__vars['variation'], )), array(
						)) . '
					';
					}
				}
				$__compilerTemp4 .= '
				';
			}
			$__finalCompiled .= $__templater->formRow('

				' . $__compilerTemp4 . '
			', array(
				'rowtype' => 'input',
				'rowclass' => 'formRow-styleProperty ' . $__vars['rowClass'],
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
				'explain' => $__templater->escape($__vars['property']['description']),
			)) . '
		';
		} else {
			$__finalCompiled .= '
			';
			$__compilerTemp9 = $__templater->mergeChoiceOptions(array(), $__vars['valueOptions']);
			$__finalCompiled .= $__templater->formRadioRow(array(
				'name' => $__vars['formBaseKey'],
				'value' => $__vars['property']['property_value'],
			), $__compilerTemp9, array(
				'rowclass' => $__vars['rowClass'],
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
				'explain' => $__templater->escape($__vars['property']['description']),
			)) . '
		';
		}
		$__finalCompiled .= '


	';
	} else if ($__vars['property']['value_type'] == 'select') {
		$__finalCompiled .= '

		';
		$__compilerTemp10 = $__templater->mergeChoiceOptions(array(), $__vars['valueOptions']);
		$__finalCompiled .= $__templater->formSelectRow(array(
			'name' => $__vars['formBaseKey'],
			'value' => $__vars['property']['property_value'],
		), $__compilerTemp10, array(
			'rowclass' => $__vars['rowClass'],
			'label' => $__templater->escape($__vars['titleHtml']),
			'hint' => $__templater->escape($__vars['hintHtml']),
			'explain' => $__templater->escape($__vars['property']['description']),
		)) . '

	';
	} else if ($__vars['property']['value_type'] == 'number') {
		$__finalCompiled .= '

		' . $__templater->formNumberBoxRow(array(
			'name' => $__vars['formBaseKey'],
			'value' => $__vars['property']['property_value'],
			'min' => $__vars['valueOptions']['min'],
			'max' => $__vars['valueOptions']['max'],
			'step' => $__vars['valueOptions']['step'],
			'units' => $__vars['valueOptions']['units'],
		), array(
			'rowclass' => $__vars['rowClass'],
			'rowid' => 'propRow_' . $__vars['property']['property_name'],
			'label' => $__templater->escape($__vars['titleHtml']),
			'hint' => $__templater->escape($__vars['hintHtml']),
			'explain' => $__templater->escape($__vars['property']['description']),
		)) . '

	';
	} else if ($__vars['property']['value_type'] == 'color') {
		$__finalCompiled .= '

		';
		if ($__vars['property']['has_variations']) {
			$__finalCompiled .= '
			';
			$__compilerTemp11 = '';
			if ($__vars['enableVariations']) {
				$__compilerTemp11 .= '
					<ul class="listPlain inputGroup-container">
						<li>
							<div class="inputGroup inputGroup--grow">
								';
				$__compilerTemp12 = $__templater->method($__vars['property'], 'getVariations', array());
				if ($__templater->isTraversable($__compilerTemp12)) {
					foreach ($__compilerTemp12 AS $__vars['variation']) {
						$__compilerTemp11 .= '
									';
						if ($__vars['variation'] != 'default') {
							$__compilerTemp11 .= '
										<span class="inputGroup-splitter"></span>
									';
						}
						$__compilerTemp11 .= '

									' . $__templater->callMacro(null, 'public:color_picker_macros::color_picker', array(
							'name' => $__vars['formBaseKey'] . '[' . $__vars['variation'] . ']',
							'value' => $__templater->method($__vars['property'], 'getVariationValue', array($__vars['variation'], )),
							'mapVariation' => $__vars['variation'],
							'mapName' => '@xf-' . $__vars['property']['property_name'],
							'allowPalette' => ($__vars['valueOptions']['hidePalette'] ? 'false' : 'true'),
							'row' => false,
							'includeScripts' => false,
							'showTxt' => true,
						), $__vars) . '
								';
					}
				}
				$__compilerTemp11 .= '
							</div>
						</li>
					</ul>
				';
			} else {
				$__compilerTemp11 .= '
					' . $__templater->callMacro(null, 'public:color_picker_macros::color_picker', array(
					'name' => $__vars['formBaseKey'] . '[default]',
					'value' => $__templater->method($__vars['property'], 'getVariationValue', array('default', )),
					'mapVariation' => 'default',
					'mapName' => '@xf-' . $__vars['property']['property_name'],
					'allowPalette' => ($__vars['valueOptions']['hidePalette'] ? 'false' : 'true'),
					'row' => false,
					'includeScripts' => false,
					'showTxt' => true,
				), $__vars) . '

					';
				$__compilerTemp13 = $__templater->method($__vars['property'], 'getVariations', array(false, ));
				if ($__templater->isTraversable($__compilerTemp13)) {
					foreach ($__compilerTemp13 AS $__vars['variation']) {
						$__compilerTemp11 .= '
						' . $__templater->formHiddenVal($__vars['formBaseKey'] . '[' . $__vars['variation'] . ']', $__templater->method($__vars['property'], 'getVariationValue', array($__vars['variation'], )), array(
						)) . '
					';
					}
				}
				$__compilerTemp11 .= '
				';
			}
			$__finalCompiled .= $__templater->formRow('

				' . $__compilerTemp11 . '
			', array(
				'rowtype' => 'input',
				'rowclass' => 'formRow-styleProperty ' . $__vars['rowClass'],
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
				'explain' => $__templater->escape($__vars['property']['description']),
			)) . '
		';
		} else {
			$__finalCompiled .= '
			' . $__templater->callMacro('public:color_picker_macros', 'color_picker', array(
				'name' => $__vars['formBaseKey'],
				'value' => $__vars['property']['property_value'],
				'mapVariation' => 'default',
				'mapName' => '@xf-' . $__vars['property']['property_name'],
				'allowPalette' => ($__vars['valueOptions']['hidePalette'] ? 'false' : 'true'),
				'label' => $__vars['titleHtml'],
				'hint' => $__vars['hintHtml'],
				'explain' => $__vars['property']['description'],
				'rowClass' => 'formRow-styleProperty ' . $__vars['rowClass'],
				'includeScripts' => false,
				'showTxt' => true,
			), $__vars) . '
		';
		}
		$__finalCompiled .= '

	';
	} else if ($__vars['property']['value_type'] == 'unit') {
		$__finalCompiled .= '

		' . $__templater->formTextBoxRow(array(
			'name' => $__vars['formBaseKey'],
			'value' => $__vars['property']['property_value'],
			'class' => 'input--number',
			'dir' => 'ltr',
		), array(
			'rowclass' => $__vars['rowClass'],
			'label' => $__templater->escape($__vars['titleHtml']),
			'hint' => $__templater->escape($__vars['hintHtml']),
			'explain' => $__templater->escape($__vars['property']['description']),
		)) . '

	';
	} else if ($__vars['property']['value_type'] == 'template') {
		$__finalCompiled .= '

		';
		if ($__vars['valueOptions']['template']) {
			$__finalCompiled .= '
			';
			$__vars['includeHtml'] = $__templater->preEscaped($__templater->includeTemplate($__vars['valueOptions']['template'], $__vars));
			$__finalCompiled .= '
			';
			if ($__templater->test($__vars['includeHtml'], 'empty', array())) {
				$__finalCompiled .= '
				' . $__templater->formRow('
					<div class="blockMessage blockMessage--error blockMessage--iconic">' . 'Template ' . $__templater->escape($__vars['valueOptions']['template']) . ' not found.' . '</div>
				', array(
					'label' => $__templater->escape($__vars['titleHtml']),
					'hint' => $__templater->escape($__vars['hintHtml']),
				)) . '
			';
			} else {
				$__finalCompiled .= '
				' . $__templater->escape($__vars['includeHtml']) . '
			';
			}
			$__finalCompiled .= '
		';
		} else {
			$__finalCompiled .= '
			' . $__templater->formRow('
				<div class="blockMessage blockMessage--error blockMessage--iconic">' . 'No template specified.' . '</div>
			', array(
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
			)) . '
		';
		}
		$__finalCompiled .= '

	';
	} else if (($__vars['property']['value_type'] == 'string') AND ($__vars['valueOptions']['rows'] > 1)) {
		$__finalCompiled .= '

		';
		if ($__vars['property']['has_variations']) {
			$__finalCompiled .= '
			';
			$__compilerTemp14 = '';
			if ($__vars['enableVariations']) {
				$__compilerTemp14 .= '
					<ul class="listPlain inputGroup-container">
						<li>
							<div class="inputGroup inputGroup--grow">
								';
				$__compilerTemp15 = $__templater->method($__vars['property'], 'getVariations', array());
				if ($__templater->isTraversable($__compilerTemp15)) {
					foreach ($__compilerTemp15 AS $__vars['variation']) {
						$__compilerTemp14 .= '
									';
						if ($__vars['variation'] != 'default') {
							$__compilerTemp14 .= '
										<span class="inputGroup-splitter"></span>
									';
						}
						$__compilerTemp14 .= '

									' . $__templater->formTextArea(array(
							'name' => $__vars['formBaseKey'] . '[default]',
							'value' => $__templater->method($__vars['property'], 'getVariationValue', array('default', )),
							'rows' => $__vars['valueOptions']['rows'],
							'autosize' => 'true',
							'code' => $__vars['valueOptions']['code'],
							'dir' => 'auto',
						)) . '
								';
					}
				}
				$__compilerTemp14 .= '
							</div>
						</li>
					</ul>
				';
			} else {
				$__compilerTemp14 .= '
					' . $__templater->formTextArea(array(
					'name' => $__vars['formBaseKey'] . '[default]',
					'value' => $__templater->method($__vars['property'], 'getVariationValue', array('default', )),
					'rows' => $__vars['valueOptions']['rows'],
					'autosize' => 'true',
					'code' => $__vars['valueOptions']['code'],
					'dir' => 'auto',
				)) . '

					';
				$__compilerTemp16 = $__templater->method($__vars['property'], 'getVariations', array(false, ));
				if ($__templater->isTraversable($__compilerTemp16)) {
					foreach ($__compilerTemp16 AS $__vars['variation']) {
						$__compilerTemp14 .= '
						' . $__templater->formHiddenVal($__vars['formBaseKey'] . '[' . $__vars['variation'] . ']', $__templater->method($__vars['property'], 'getVariationValue', array($__vars['variation'], )), array(
						)) . '
					';
					}
				}
				$__compilerTemp14 .= '
				';
			}
			$__finalCompiled .= $__templater->formRow('

				' . $__compilerTemp14 . '
			', array(
				'rowtype' => 'input',
				'class' => $__vars['valueOptions']['class'],
				'rowclass' => 'formRow-styleProperty ' . $__vars['rowClass'],
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
				'explain' => $__templater->escape($__vars['property']['description']),
			)) . '
		';
		} else {
			$__finalCompiled .= '
			' . $__templater->formTextAreaRow(array(
				'name' => $__vars['formBaseKey'],
				'value' => $__vars['property']['property_value'],
				'rows' => $__vars['valueOptions']['rows'],
				'autosize' => 'true',
				'class' => $__vars['valueOptions']['class'],
				'code' => $__vars['valueOptions']['code'],
				'dir' => 'auto',
			), array(
				'rowclass' => $__vars['rowClass'],
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
				'explain' => $__templater->escape($__vars['property']['description']),
			)) . '
		';
		}
		$__finalCompiled .= '

	';
	} else if (($__vars['property']['value_type'] == 'string') AND $__vars['valueOptions']['asset']) {
		$__finalCompiled .= '

		';
		if ($__vars['property']['has_variations']) {
			$__finalCompiled .= '
			';
			$__compilerTemp17 = '';
			if ($__vars['enableVariations']) {
				$__compilerTemp17 .= '
					<ul class="listPlain inputGroup-container">
						<li>
							<div class="inputGroup inputGroup--grow">
								';
				$__compilerTemp18 = $__templater->method($__vars['property'], 'getVariations', array());
				if ($__templater->isTraversable($__compilerTemp18)) {
					foreach ($__compilerTemp18 AS $__vars['variation']) {
						$__compilerTemp17 .= '
									';
						if ($__vars['variation'] != 'default') {
							$__compilerTemp17 .= '
										<span class="inputGroup-splitter"></span>
									';
						}
						$__compilerTemp17 .= '

									' . $__templater->formAssetUpload(array(
							'name' => $__vars['formBaseKey'] . '[' . $__vars['variation'] . ']',
							'value' => $__templater->method($__vars['property'], 'getVariationValue', array($__vars['variation'], )),
							'asset' => $__vars['valueOptions']['asset'] . '_' . $__vars['variation'],
						)) . '
								';
					}
				}
				$__compilerTemp17 .= '
							</div>
						</li>
					</ul>
				';
			} else {
				$__compilerTemp17 .= '
					' . $__templater->formAssetUpload(array(
					'name' => $__vars['formBaseKey'] . '[default]',
					'value' => $__templater->method($__vars['property'], 'getVariationValue', array('default', )),
					'asset' => $__vars['valueOptions']['asset'] . '_default',
				)) . '

					';
				$__compilerTemp19 = $__templater->method($__vars['property'], 'getVariations', array(false, ));
				if ($__templater->isTraversable($__compilerTemp19)) {
					foreach ($__compilerTemp19 AS $__vars['variation']) {
						$__compilerTemp17 .= '
						' . $__templater->formHiddenVal($__vars['formBaseKey'] . '[' . $__vars['variation'] . ']', $__templater->method($__vars['property'], 'getVariationValue', array($__vars['variation'], )), array(
						)) . '
					';
					}
				}
				$__compilerTemp17 .= '
				';
			}
			$__finalCompiled .= $__templater->formRow('

				' . $__compilerTemp17 . '
			', array(
				'rowtype' => 'input',
				'class' => $__vars['valueOptions']['class'],
				'rowclass' => 'formRow-styleProperty ' . $__vars['rowClass'],
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
				'explain' => $__templater->escape($__vars['property']['description']),
			)) . '
		';
		} else {
			$__finalCompiled .= '
			' . $__templater->formAssetUploadRow(array(
				'name' => $__vars['formBaseKey'],
				'value' => $__vars['property']['property_value'],
				'asset' => $__vars['valueOptions']['asset'],
				'class' => $__vars['valueOptions']['class'],
			), array(
				'rowclass' => $__vars['rowClass'],
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
				'explain' => $__templater->escape($__vars['property']['description']),
			)) . '
		';
		}
		$__finalCompiled .= '

	';
	} else {
		$__finalCompiled .= '

		';
		if ($__vars['property']['has_variations']) {
			$__finalCompiled .= '
			';
			$__compilerTemp20 = '';
			if ($__vars['enableVariations']) {
				$__compilerTemp20 .= '
					<ul class="listPlain inputGroup-container">
						<li>
							<div class="inputGroup inputGroup--grow">
								';
				$__compilerTemp21 = $__templater->method($__vars['property'], 'getVariations', array());
				if ($__templater->isTraversable($__compilerTemp21)) {
					foreach ($__compilerTemp21 AS $__vars['variation']) {
						$__compilerTemp20 .= '
									';
						if ($__vars['variation'] != 'default') {
							$__compilerTemp20 .= '
										<span class="inputGroup-splitter"></span>
									';
						}
						$__compilerTemp20 .= '

									' . $__templater->formTextBox(array(
							'name' => $__vars['formBaseKey'] . '[' . $__vars['variation'] . ']',
							'value' => $__templater->method($__vars['property'], 'getVariationValue', array($__vars['variation'], )),
						)) . '
								';
					}
				}
				$__compilerTemp20 .= '
							</div>
						</li>
					</ul>
				';
			} else {
				$__compilerTemp20 .= '
					' . $__templater->formTextBox(array(
					'name' => $__vars['formBaseKey'] . '[default]',
					'value' => $__templater->method($__vars['property'], 'getVariationValue', array('default', )),
				)) . '

					';
				$__compilerTemp22 = $__templater->method($__vars['property'], 'getVariations', array(false, ));
				if ($__templater->isTraversable($__compilerTemp22)) {
					foreach ($__compilerTemp22 AS $__vars['variation']) {
						$__compilerTemp20 .= '
						' . $__templater->formHiddenVal($__vars['formBaseKey'] . '[' . $__vars['variation'] . ']', $__templater->method($__vars['property'], 'getVariationValue', array($__vars['variation'], )), array(
						)) . '
					';
					}
				}
				$__compilerTemp20 .= '
				';
			}
			$__finalCompiled .= $__templater->formRow('

				' . $__compilerTemp20 . '
			', array(
				'rowtype' => 'input',
				'class' => $__vars['valueOptions']['class'],
				'rowclass' => 'formRow-styleProperty ' . $__vars['rowClass'],
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
				'explain' => $__templater->escape($__vars['property']['description']),
			)) . '
		';
		} else {
			$__finalCompiled .= '
			' . $__templater->formTextBoxRow(array(
				'name' => $__vars['formBaseKey'],
				'value' => $__vars['property']['property_value'],
				'type' => $__vars['valueOptions']['type'],
				'class' => $__vars['valueOptions']['class'],
				'code' => $__vars['valueOptions']['code'],
				'dir' => 'auto',
			), array(
				'rowclass' => $__vars['rowClass'],
				'label' => $__templater->escape($__vars['titleHtml']),
				'hint' => $__templater->escape($__vars['hintHtml']),
				'explain' => $__templater->escape($__vars['property']['description']),
			)) . '
		';
		}
		$__finalCompiled .= '

	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
),
'property_edit_css' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'property' => '!',
		'definitionEditable' => '!',
		'isActive' => true,
		'customizationState' => '!',
		'submitName' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	';
	$__templater->includeCss('style_properties.less');
	$__finalCompiled .= '
	';
	$__templater->includeCss('public:color_picker.less');
	$__finalCompiled .= '
	';
	$__templater->includeJs(array(
		'src' => 'xf/color_picker.js',
		'min' => '1',
	));
	$__finalCompiled .= '

	';
	$__vars['formBaseKey'] = $__vars['submitName'] . '[' . $__vars['property']['property_name'] . ']';
	$__finalCompiled .= '

	<div class="cssPropertyWrapper js-property--' . $__templater->escape($__vars['property']['property_name']) . '" data-toggle-wrapper="1">
		<h3 class="block-header block-header--separated">
			<span class="collapseTrigger collapseTrigger--block ' . ($__vars['isActive'] ? 'is-active' : '') . '"
				data-xf-click="toggle"
				data-target="< :up :next"
				data-xf-init="toggle-storage"
				data-storage-key="sp-' . $__templater->escape($__vars['property']['property_name']) . '">
				<span class="u-anchorTarget" id="sp-' . $__templater->escape($__vars['property']['property_name']) . '"></span><span>' . $__templater->escape($__vars['property']['title']) . '</span>
				';
	if ($__vars['property']['description']) {
		$__finalCompiled .= '<span class="block-desc">' . $__templater->escape($__vars['property']['description']) . '</span>';
	}
	$__finalCompiled .= '
			</span>

			<!-- customization_hint -->
			' . $__templater->callMacro(null, 'customization_hint', array(
		'state' => $__vars['customizationState'],
		'submitName' => $__vars['submitName'],
		'property' => $__vars['property'],
		'checkbox' => '1',
	), $__vars) . '
			<!-- /customization_hint -->
			' . $__templater->formHiddenVal($__vars['submitName'] . '_listed[]', $__vars['property']['property_name'], array(
	)) . '
		</h3>
		<div class="block-body block-body--collapsible ' . ($__vars['isActive'] ? 'is-active' : '') . '">
			<div class="block-row">
				';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
						';
	if ($__vars['definitionEditable']) {
		$__compilerTemp1 .= '
							<span class="u-pullRight">
								' . $__templater->button('', array(
			'href' => $__templater->func('link', array('style-properties/edit', $__vars['property'], ), false),
			'class' => 'button--link button--small',
			'icon' => 'edit',
		), '', array(
		)) . '
							</span>
						';
	}
	$__compilerTemp1 .= '
						';
	if ($__vars['xf']['development']) {
		$__compilerTemp1 .= '<div class="u-muted">' . $__templater->escape($__vars['property']['property_name']) . ' ' . $__templater->filter($__vars['property']['display_order'], array(array('parens', array()),), true) . '</div>';
	}
	$__compilerTemp1 .= '
					';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
					<div class="cssPropertyDescription">
					' . $__compilerTemp1 . '
					</div>
				';
	}
	$__finalCompiled .= '

				<ul class="cssProperty">
					';
	if ($__templater->method($__vars['property'], 'isValidCssComponent', array('text', ))) {
		$__finalCompiled .= '
						<li>
							<h4 class="cssPropertyHeader">' . 'Text' . '</h4>
							<table class="cssPropertySet">
							<tr class="cssPropertySet-headerRow">
								<th>' . 'Size' . '</th>
								<th>' . 'Color' . '</th>
								<th>' . 'Weight' . '</th>
							</tr>
							<tr>
								<td>' . $__templater->formTextBox(array(
			'name' => $__vars['formBaseKey'] . '[font-size]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('font-size', )),
			'title' => 'font-size',
			'class' => 'input--cssProp input--cssLength',
			'dir' => 'ltr',
		)) . '
								</td>

								<td><div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker">
									' . $__templater->formTextBox(array(
			'name' => $__vars['formBaseKey'] . '[color]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('color', )),
			'title' => 'color',
			'class' => 'input--cssProp',
			'dir' => 'ltr',
		)) . '
									<div class="inputGroup-text"><span class="colorPickerBox js-colorPickerTrigger"></span></div>
								</div></td>

								<td>' . $__templater->formSelect(array(
			'name' => $__vars['formBaseKey'] . '[font-weight]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('font-weight', )),
			'title' => 'font-weight',
			'class' => 'input--cssProp',
		), array(array(
			'value' => '',
			'label' => '&nbsp;',
			'_type' => 'option',
		),
		array(
			'value' => '@xf-fontWeightHeavy',
			'label' => 'Bold',
			'_type' => 'option',
		),
		array(
			'value' => '@xf-fontWeightNormal',
			'label' => 'Normal',
			'_type' => 'option',
		),
		array(
			'value' => '@xf-fontWeightLight',
			'label' => 'Light',
			'_type' => 'option',
		))) . '</td>
							</tr>
							<tr>
								<td colspan="3">
									' . $__templater->formCheckBox(array(
			'listclass' => 'inputChoices--cssTextOptions',
		), array(array(
			'name' => $__vars['formBaseKey'] . '[font-style]',
			'value' => 'italic',
			'selected' => ($__templater->method($__vars['property'], 'getCssPropertyValue', array('font-style', )) == 'italic'),
			'label' => '
											' . 'Italic' . '
										',
			'_type' => 'option',
		),
		array(
			'name' => $__vars['formBaseKey'] . '[text-decoration]',
			'value' => 'underline',
			'selected' => ($__templater->method($__vars['property'], 'getCssPropertyValue', array('text-decoration', )) == 'underline'),
			'label' => '
											' . 'Underline' . '
										',
			'_type' => 'option',
		),
		array(
			'name' => $__vars['formBaseKey'] . '[text-decoration]',
			'value' => 'none',
			'selected' => ($__templater->method($__vars['property'], 'getCssPropertyValue', array('text-decoration', )) == 'none'),
			'label' => '
											' . 'No text decoration' . '
										',
			'_type' => 'option',
		))) . '
								</td>
							</tr>
							</table>
						</li>
					';
	}
	$__finalCompiled .= '

					';
	if ($__templater->method($__vars['property'], 'isValidCssComponent', array('background', ))) {
		$__finalCompiled .= '
						<li>
							<h4 class="cssPropertyHeader">' . 'Background' . '</h4>
							<table class="cssPropertySet">
							<tr class="cssPropertySet-headerRow">
								<th>' . 'Color' . '</th>
							</tr>
							<tr>
								<td><div class="inputGroup inputGroup--joined inputGroup--color" data-xf-init="color-picker">
									' . $__templater->formTextBox(array(
			'name' => $__vars['formBaseKey'] . '[background-color]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('background-color', )),
			'title' => 'background-color',
			'class' => 'input--cssProp',
			'dir' => 'ltr',
		)) . '
									<div class="inputGroup-text"><span class="colorPickerBox js-colorPickerTrigger"></span></div>
								</div></td>
							</tr>
							<tr class="cssPropertySet-headerRow">
								<th>' . 'Image' . '</th>
							</tr>
							<tr>
								<td>' . $__templater->formAssetUpload(array(
			'name' => $__vars['formBaseKey'] . '[background-image]',
			'asset' => 'style_properties',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('background-image', )),
			'title' => 'background-image',
			'class' => 'input--cssProp input--colorWidthMatched',
		)) . '</td>
							</tr>
							</table>
						</li>
					';
	}
	$__finalCompiled .= '

					';
	if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border', )) OR $__templater->method($__vars['property'], 'isValidCssComponent', array('border_radius', ))) {
		$__finalCompiled .= '
						<li>
							<table class="cssPropertySet">
							<tr class="cssPropertySet-headerRow cssPropertySet-headerRow--separated">
								<th class="cssPropertySet-headerSetLabel">' . 'Border' . '</th>
								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border', ))) {
			$__finalCompiled .= '
									<th>' . 'Width' . '</th>
									<th>' . 'Color' . '</th>
								';
		}
		$__finalCompiled .= '
								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border_radius', ))) {
			$__finalCompiled .= '
									<th>' . 'Radius' . '</th>
								';
		}
		$__finalCompiled .= '
							</tr>
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'All' . '</td>

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-width]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-width', )),
				'title' => 'border-width',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '</td>

									<td><div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker">
										' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-color]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-color', )),
				'title' => 'border-color',
				'class' => 'input--cssProp',
				'dir' => 'ltr',
			)) . '
										<div class="inputGroup-text"><span class="colorPickerBox js-colorPickerTrigger"></span></div>
									</div></td>
								';
		}
		$__finalCompiled .= '

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border_radius', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-radius]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-radius', )),
				'title' => 'border-radius',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '
									</td>
								';
		}
		$__finalCompiled .= '
							</tr>
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'Top' . '</td>

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-top-width]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-top-width', )),
				'title' => 'border-top-width',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '
									</td>

									<td><div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker">
										' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-top-color]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-top-color', )),
				'title' => 'border-top-color',
				'class' => 'input--cssProp',
				'dir' => 'ltr',
			)) . '
										<div class="inputGroup-text"><span class="colorPickerBox js-colorPickerTrigger"></span></div>
									</div></td>
								';
		}
		$__finalCompiled .= '

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border_radius', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-top-left-radius]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-top-left-radius', )),
				'title' => 'border-top-left-radius',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '
									</td>
								';
		}
		$__finalCompiled .= '
							</tr>
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'Right' . '</td>

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-right-width]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-right-width', )),
				'title' => 'border-right-width',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '
									</td>

									<td><div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker">
										' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-right-color]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-right-color', )),
				'title' => 'border-right-color',
				'class' => 'input--cssProp',
				'dir' => 'ltr',
			)) . '
										<div class="inputGroup-text"><span class="colorPickerBox js-colorPickerTrigger"></span></div>
									</div></td>
								';
		}
		$__finalCompiled .= '

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border_radius', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-top-right-radius]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-top-right-radius', )),
				'title' => 'border-top-right-radius',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '
									</td>
								';
		}
		$__finalCompiled .= '
							</tr>
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'Bottom' . '</td>

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-bottom-width]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-bottom-width', )),
				'title' => 'border-bottom-width',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '
									</td>

									<td><div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker">
										' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-bottom-color]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-bottom-color', )),
				'title' => 'border-bottom-color',
				'class' => 'input--cssProp',
				'dir' => 'ltr',
			)) . '
										<div class="inputGroup-text"><span class="colorPickerBox js-colorPickerTrigger"></span></div>
									</div></td>
								';
		}
		$__finalCompiled .= '

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border_radius', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-bottom-right-radius]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-bottom-right-radius', )),
				'title' => 'border-bottom-right-radius',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '
									</td>
								';
		}
		$__finalCompiled .= '
							</tr>
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'Left' . '</td>

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-left-width]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-left-width', )),
				'title' => 'border-left-width',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '
									</td>

									<td><div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker">
										' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-left-color]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-left-color', )),
				'title' => 'border-left-color',
				'class' => 'input--cssProp',
				'dir' => 'ltr',
			)) . '
										<div class="inputGroup-text"><span class="colorPickerBox js-colorPickerTrigger"></span></div>
									</div></td>
								';
		}
		$__finalCompiled .= '

								';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border_radius', ))) {
			$__finalCompiled .= '
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-bottom-left-radius]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-bottom-left-radius', )),
				'title' => 'border-bottom-left-radius',
				'class' => 'input--cssProp input--cssLength',
				'dir' => 'ltr',
			)) . '
									</td>
								';
		}
		$__finalCompiled .= '
							</tr>
							</table>
						</li>
					';
	} else if ($__templater->method($__vars['property'], 'isValidCssComponent', array(array('border_color_simple', 'border_width_simple', 'border_radius_simple', ), ))) {
		$__finalCompiled .= '
						<li>
							<h4 class="cssPropertyHeader">' . 'Border' . '</h4>
							<table class="cssPropertySet">
							';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border_width_simple', ))) {
			$__finalCompiled .= '
								<tr class="cssPropertySet-headerRow">
									<th>' . 'Width' . '</th>
								</tr>
								<tr>
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-width]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-width', )),
				'title' => 'border-width',
				'class' => 'input--cssProp input--colorWidthMatched',
				'dir' => 'ltr',
			)) . '</td>
								</tr>
							';
		}
		$__finalCompiled .= '

							';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border_color_simple', ))) {
			$__finalCompiled .= '
								<tr class="cssPropertySet-headerRow">
									<th>' . 'Color' . '</th>
								</tr>
								<tr>
									<td><div class="inputGroup inputGroup--joined inputGroup--color" data-xf-init="color-picker">
										' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-color]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-color', )),
				'title' => 'border-color',
				'class' => 'input--cssProp',
				'dir' => 'ltr',
			)) . '
										<div class="inputGroup-text"><span class="colorPickerBox js-colorPickerTrigger"></span></div>
									</div></td>
								</tr>
							';
		}
		$__finalCompiled .= '

							';
		if ($__templater->method($__vars['property'], 'isValidCssComponent', array('border_radius_simple', ))) {
			$__finalCompiled .= '
								<tr class="cssPropertySet-headerRow">
									<th>' . 'Radius' . '</th>
								</tr>
								<tr>
									<td>' . $__templater->formTextBox(array(
				'name' => $__vars['formBaseKey'] . '[border-radius]',
				'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('border-radius', )),
				'title' => 'border-radius',
				'class' => 'input--cssProp input--colorWidthMatched',
				'dir' => 'ltr',
			)) . '</td>
								</tr>
							';
		}
		$__finalCompiled .= '
							</table>
						</li>
					';
	}
	$__finalCompiled .= '

					';
	if ($__templater->method($__vars['property'], 'isValidCssComponent', array('padding', ))) {
		$__finalCompiled .= '
						<li>
							<h4 class="cssPropertyHeader">' . 'Padding' . '</h4>
							<table class="cssPropertySet">
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'All' . '</td>

								<td>' . $__templater->formTextBox(array(
			'name' => $__vars['formBaseKey'] . '[padding]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('padding', )),
			'title' => 'padding',
			'class' => 'input--cssProp input--cssLength',
			'dir' => 'ltr',
		)) . '
								</td>
							</tr>
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'Top' . '</td>

								<td>' . $__templater->formTextBox(array(
			'name' => $__vars['formBaseKey'] . '[padding-top]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('padding-top', )),
			'title' => 'padding-top',
			'class' => 'input--cssProp input--cssLength',
			'dir' => 'ltr',
		)) . '
								</td>
							</tr>
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'Right' . '</td>

								<td>' . $__templater->formTextBox(array(
			'name' => $__vars['formBaseKey'] . '[padding-right]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('padding-right', )),
			'title' => 'padding-right',
			'class' => 'input--cssProp input--cssLength',
			'dir' => 'ltr',
		)) . '
								</td>
							</tr>
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'Bottom' . '</td>

								<td>' . $__templater->formTextBox(array(
			'name' => $__vars['formBaseKey'] . '[padding-bottom]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('padding-bottom', )),
			'title' => 'padding-bottom',
			'class' => 'input--cssProp input--cssLength',
			'dir' => 'ltr',
		)) . '
								</td>
							</tr>
							<tr>
								<td class="cssPropertySet-rowLabel">' . 'Left' . '</td>

								<td>' . $__templater->formTextBox(array(
			'name' => $__vars['formBaseKey'] . '[padding-left]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('padding-left', )),
			'title' => 'padding-left',
			'class' => 'input--cssProp input--cssLength',
			'dir' => 'ltr',
		)) . '
								</td>
							</tr>
							</table>
						</li>
					';
	}
	$__finalCompiled .= '

					';
	if ($__templater->method($__vars['property'], 'isValidCssComponent', array('extra', ))) {
		$__finalCompiled .= '
						<li class="cssPropertyExtra">
							<h4 class="cssPropertyHeader">' . 'Extra' . '</h4>
							<table class="cssPropertySet">
								<tr class="cssPropertySet-headerRow">
									<th>' . 'Freeform CSS/LESS code' . '</th>
								</tr>
								<tr>
									<!--<td>' . $__templater->formCodeEditor(array(
			'name' => $__vars['formBaseKey'] . '[extra]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('extra', )),
			'mode' => 'less',
			'class' => 'codeEditor&#45;&#45;autoSize',
		)) . '</td>-->
									<td>' . $__templater->formTextArea(array(
			'name' => $__vars['formBaseKey'] . '[extra]',
			'value' => $__templater->method($__vars['property'], 'getCssPropertyValue', array('extra', )),
		)) . '</td>
								</tr>
							</table>
						</li>
					';
	}
	$__finalCompiled .= '
				</ul>
			</div>
		</div>
	</div>
';
	return $__finalCompiled;
}
),
'customization_hint' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'state' => '!',
		'submitName' => '!',
		'property' => '!',
		'checkbox' => false,
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	<!-- customization_hint ' . $__templater->escape($__vars['property']['property_name']) . ' -->
	<span class="formRow-hint--customState cssCustomHighlight cssCustomHighlight--' . $__templater->escape($__vars['state']) . '">

		<span class="hint hint--custom"
			data-xf-init="tooltip" title="' . $__templater->filter('The value for this property has been customized in this style', array(array('for_attr', array()),), true) . '">
			';
	if ($__vars['checkbox']) {
		$__finalCompiled .= '
				' . $__templater->callMacro(null, 'revert_code', array(
			'submitName' => $__vars['submitName'],
			'property' => $__vars['property'],
			'label' => 'Revert customized value',
			'Xcontainer' => 'dl.xf-' . $__vars['property']['property_name'] . ' > dd',
			'container' => '.js-property--' . $__vars['property']['property_name'],
		), $__vars) . '
			';
	} else {
		$__finalCompiled .= '
				' . 'Value customized' . '
			';
	}
	$__finalCompiled .= '
		</span>

		<span class="hint hint--inherited"
			data-xf-init="tooltip" title="' . $__templater->filter('The customized value for this property is inherited from a parent style', array(array('for_attr', array()),), true) . '">' . 'Value inherited' . '</span>

		<span class="hint hint--added"
			data-xf-init="tooltip" title="' . $__templater->filter('This property was created in this style, and does not exist in parent styles', array(array('for_attr', array()),), true) . '">' . 'Custom property' . '</span>

	</span>
	<!-- / customization_hint ' . $__templater->escape($__vars['property']['property_name']) . ' -->
';
	return $__finalCompiled;
}
),
'revert_code' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'submitName' => '!',
		'property' => '!',
		'label' => '!',
		'container' => '< dl',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	' . $__templater->formCheckBox(array(
		'standalone' => 'true',
	), array(array(
		'name' => $__vars['submitName'] . '_revert[]',
		'value' => $__vars['property']['property_name'],
		'labelclass' => 'formRow-revert',
		'class' => 'js-disablerExemption',
		'data-xf-init' => 'disabler',
		'data-container' => $__vars['container'],
		'data-invert' => 'true',
		'label' => $__templater->escape($__vars['label']),
		'_type' => 'option',
	))) . '
';
	return $__finalCompiled;
}
),
'variation_labels' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'property' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	<div class="inputGroup">
		';
	$__compilerTemp1 = $__templater->method($__vars['property'], 'getVariations', array());
	if ($__templater->isTraversable($__compilerTemp1)) {
		foreach ($__compilerTemp1 AS $__vars['variation']) {
			$__finalCompiled .= '
			';
			if ($__vars['variation'] != 'default') {
				$__finalCompiled .= '
				<span class="inputGroup-splitter"></span>
			';
			}
			$__finalCompiled .= '

			<span class="inputGroup-label">' . $__templater->func('phrase_dynamic', array('style_variation.' . $__vars['variation'], ), true) . '</span>
		';
		}
	}
	$__finalCompiled .= '
	</div>
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