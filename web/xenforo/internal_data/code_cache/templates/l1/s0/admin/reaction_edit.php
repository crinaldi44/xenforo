<?php
// FROM HASH: c25686f37c4e466e38e5bf0efc23d917
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['reaction'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add reaction');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit reaction' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['reaction']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['reaction'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->func('link', array('reactions/delete', $__vars['reaction'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

';
	$__vars['explain'] = $__templater->preEscaped('Pick a text color to use when this reaction has been given. If you do not wish to associate this reaction to a specific color, leave it blank.<br /><br /><b>Note: Palette colors may appear differently depending on selected style.</b>');
	$__compilerTemp1 = $__templater->mergeChoiceOptions(array(), $__vars['reactionScores']);
	$__compilerTemp1[] = array(
		'label' => 'Custom score',
		'value' => '',
		'selected' => $__vars['reaction']['is_custom_score'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'custom_reaction_score',
		'value' => $__vars['reaction']['reaction_score'],
		'step' => '1',
	))),
		'_type' => 'option',
	);
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => $__vars['reaction'],
	), array(
		'label' => 'Title',
	)) . '

			' . '' . '
			' . $__templater->callMacro(null, 'public:color_picker_macros::color_picker', array(
		'name' => 'text_color',
		'value' => $__vars['reaction']['text_color'],
		'allowPalette' => 'true',
		'colorData' => $__vars['colorData'],
		'label' => 'Text color',
		'explain' => $__vars['explain'],
	), $__vars) . '

			' . $__templater->formRadioRow(array(
		'name' => 'reaction_score',
		'value' => $__vars['reaction'],
	), $__compilerTemp1, array(
		'label' => 'Reaction score',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->callMacro(null, 'display_order_macros::row', array(
		'value' => $__vars['reaction'],
	), $__vars) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'active',
		'selected' => $__vars['reaction']['active'],
		'label' => 'Reaction is active',
		'hint' => 'Disabled reactions can no longer be used, and will no longer appear in content summaries.',
		'_type' => 'option',
	)), array(
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formTextBoxRow(array(
		'name' => 'emoji_shortname',
		'value' => $__vars['reaction'],
		'data-xf-init' => 'emoji-completer',
		'data-exclude-smilies' => 'true',
		'data-insert-emoji' => 'true',
	), array(
		'label' => 'Emoji replacement',
		'hint' => 'Optional',
		'explain' => 'Enter an emoji or emoji short-name (such as :smile:) to use as the reaction icon. If you use an emoji-based icon, you should not enter any image URL below.',
	)) . '

			' . $__templater->formAssetUploadRow(array(
		'name' => 'image_url',
		'value' => $__vars['reaction'],
		'asset' => 'reactions',
	), array(
		'label' => 'Image replacement URL',
		'hint' => 'Optional',
	)) . '

			' . $__templater->formAssetUploadRow(array(
		'name' => 'image_url_2x',
		'value' => $__vars['reaction'],
		'asset' => 'reactions',
	), array(
		'hint' => 'Optional',
		'label' => '2x image replacement URL',
		'explain' => 'If provided, the 2x image will be automatically displayed instead of the image URL above on devices capable of displaying a higher pixel resolution.<br />
<br />
<strong>Note: This option has no effect with sprite mode enabled.</strong>',
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'sprite_mode',
		'selected' => $__vars['reaction']['sprite_mode'],
		'label' => 'Enable CSS sprite mode with the following parameters:',
		'data-hide' => 'true',
		'data-xf-init' => 'disabler',
		'data-container' => '.js-reactionSpriteOptions',
		'_type' => 'option',
	)), array(
		'label' => 'Sprite mode',
	)) . '

			<div class="js-reactionSpriteOptions">
				' . $__templater->formRow('

					<div class="inputGroup">
						' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[w]',
		'value' => $__vars['reaction']['sprite_params']['w'],
		'min' => '1',
		'title' => $__templater->filter('Width', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
						<span class="inputGroup-text">x</span>
						' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[h]',
		'value' => $__vars['reaction']['sprite_params']['h'],
		'min' => '1',
		'title' => $__templater->filter('Height', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
						<span class="inputGroup-text">' . 'Pixels' . '</span>
					</div>
				', array(
		'rowtype' => 'input',
		'label' => 'Sprite dimensions',
	)) . '

				' . $__templater->formRow('

					<div class="inputGroup">
						' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[x]',
		'value' => $__vars['reaction']['sprite_params']['x'],
		'title' => $__templater->filter('Background position x', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
						<span class="inputGroup-text">x</span>
						' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[y]',
		'value' => $__vars['reaction']['sprite_params']['y'],
		'title' => $__templater->filter('Background position y', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
						<span class="inputGroup-text">' . 'Pixels' . '</span>
					</div>
					<div class="formRow-explain">' . 'CSS will be generated automatically for small and medium size sprites based on the values above. Dimensions of 32px x 32px are recommended.' . '</div>
				', array(
		'rowtype' => 'input',
		'label' => 'Sprite position',
	)) . '

				' . $__templater->formTextBoxRow(array(
		'name' => 'sprite_params[bs]',
		'value' => $__vars['reaction']['sprite_params']['bs'],
		'dir' => 'ltr',
	), array(
		'label' => 'Background size',
		'explain' => 'If required, enter a value for the <code>background-size</code> CSS property for this sprite.',
	)) . '
			</div>
		</div>

		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('reactions/save', $__vars['reaction'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
}
);