<?php
// FROM HASH: 249e73de08bf978af915741f1e5aec3e
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['event'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add code event');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit code event' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['event']['event_id']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['event'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->func('link', array('code-events/delete', $__vars['event'], ), false),
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
		'name' => 'event_id',
		'value' => $__vars['event'],
		'dir' => 'ltr',
	), array(
		'label' => 'Event ID',
	)) . '

			' . $__templater->formCodeEditorRow(array(
		'name' => 'description',
		'value' => $__vars['event']['description'],
		'mode' => 'html',
	), array(
		'label' => 'Description',
		'hint' => 'You may use HTML',
	)) . '

			' . $__templater->callMacro(null, 'addon_macros::addon_edit', array(
		'addOnId' => $__vars['event']['addon_id'],
	), $__vars) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>

', array(
		'action' => $__templater->func('link', array('code-events/save', $__vars['event'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
}
);