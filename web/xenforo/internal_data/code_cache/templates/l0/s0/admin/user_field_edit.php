<?php
// FROM HASH: 92417a91db40a2f5279e76b365100376
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__compilerTemp1 = $__vars;
	$__compilerTemp1['extraOptions'] = $__templater->preEscaped('
		' . $__templater->callMacro(null, 'base_custom_field_macros::common_options', array(
		'field' => $__vars['field'],
		'supportsUserEditable' => true,
		'supportsEditableOnce' => true,
		'supportsModeratorEditable' => true,
	), $__vars) . '

		' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'show_registration',
		'selected' => $__vars['field']['show_registration'],
		'label' => 'Show during registration',
		'hint' => 'Required fields will always be shown during registration.',
		'_type' => 'option',
	),
	array(
		'name' => 'viewable_profile',
		'selected' => $__vars['field']['viewable_profile'],
		'label' => 'Viewable on profile pages',
		'hint' => 'This does not apply to fields displayed within the preferences page.',
		'_type' => 'option',
	),
	array(
		'name' => 'viewable_message',
		'selected' => $__vars['field']['viewable_message'],
		'label' => 'Viewable in message user info',
		'hint' => 'This field will only be shown on message user info if the \'Custom fields\' style property is enabled within the \'Message user info elements\' (messageUserElements) setting, in the \'Messages\' group.',
		'_type' => 'option',
	)), array(
	)) . '
	');
	$__finalCompiled .= $__templater->includeTemplate('base_custom_field_edit', $__compilerTemp1);
	return $__finalCompiled;
}
);