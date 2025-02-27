<?php
// FROM HASH: e8411e0e3fa6d91dcfbefabda2693918
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['widgetDefinition'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add widget definition');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit widget definition' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['widgetDefinition']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['widgetDefinition'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->func('link', array('widgets/definitions/delete', $__vars['widgetDefinition'], ), false),
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
		'value' => $__vars['widgetDefinition'],
		'dir' => 'ltr',
	), array(
		'label' => 'Definition ID',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => $__vars['widgetDefinition'],
	), array(
		'label' => 'Title',
	)) . '

			' . $__templater->formTextAreaRow(array(
		'name' => 'description',
		'value' => $__vars['widgetDefinition'],
		'autosize' => 'true',
	), array(
		'label' => 'Description',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'definition_class',
		'value' => $__vars['widgetDefinition'],
		'dir' => 'ltr',
	), array(
		'label' => 'Definition class',
		'explain' => 'This class should implement all relevant widget behaviours. It should be based on <code>\\XF\\Widget\\AbstractWidget</code>.',
	)) . '

			' . $__templater->callMacro(null, 'addon_macros::addon_edit', array(
		'addOnId' => $__vars['widgetDefinition']['addon_id'],
	), $__vars) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('widgets/definitions/save', $__vars['widgetDefinition'], ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
}
);