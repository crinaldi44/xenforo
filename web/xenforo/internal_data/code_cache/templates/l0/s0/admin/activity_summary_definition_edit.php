<?php
// FROM HASH: 1645755f196a2273253610094a784698
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['definition'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add activity summary definition');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit activity summary definition' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['definition']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['definition'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->func('link', array('activity-summary/definitions/delete', $__vars['definition'], ), false),
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
		'name' => 'definition_id',
		'value' => $__vars['definition'],
		'dir' => 'ltr',
	), array(
		'label' => 'Definition ID',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => $__vars['definition'],
	), array(
		'label' => 'Title',
	)) . '

			' . $__templater->formTextAreaRow(array(
		'name' => 'description',
		'value' => $__vars['definition'],
		'autosize' => 'true',
	), array(
		'label' => 'Description',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'definition_class',
		'value' => $__vars['definition'],
		'dir' => 'ltr',
	), array(
		'label' => 'Definition class',
		'explain' => 'This class should implement all relevant activity summary section behaviors. It should be based on <code>XF\\ActivitySummary\\AbstractSection</code>.',
	)) . '

			' . $__templater->callMacro(null, 'addon_macros::addon_edit', array(
		'addOnId' => $__vars['definition']['addon_id'],
	), $__vars) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('activity-summary/definitions/save', $__vars['definition'], ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
}
);