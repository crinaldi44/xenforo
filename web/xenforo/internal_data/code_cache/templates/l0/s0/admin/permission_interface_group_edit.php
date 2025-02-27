<?php
// FROM HASH: 794c2db6f0c689f0a794ce7808a6b954
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['interfaceGroup'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add interface group');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit interface group' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['interfaceGroup']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['interfaceGroup'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->func('link', array('permission-definitions/interface-groups/delete', $__vars['interfaceGroup'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTextBoxRow(array(
		'name' => 'interface_group_id',
		'value' => $__vars['interfaceGroup'],
		'dir' => 'ltr',
	), array(
		'label' => 'Interface group ID',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => $__vars['interfaceGroup'],
	), array(
		'label' => 'Title',
	)) . '

			' . $__templater->callMacro(null, 'display_order_macros::row', array(
		'value' => $__vars['interfaceGroup'],
	), $__vars) . '

			' . $__templater->formCheckBoxRow(array(
		'name' => 'is_moderator',
		'value' => $__vars['interfaceGroup']['is_moderator'],
	), array(array(
		'value' => '1',
		'label' => 'This interface group contains moderator permissions',
		'_type' => 'option',
	)), array(
	)) . '

			' . $__templater->callMacro(null, 'addon_macros::addon_edit', array(
		'addOnId' => $__vars['interfaceGroup']['addon_id'],
	), $__vars) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>

', array(
		'action' => $__templater->func('link', array('permission-definitions/interface-groups/save', $__vars['interfaceGroup'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
}
);