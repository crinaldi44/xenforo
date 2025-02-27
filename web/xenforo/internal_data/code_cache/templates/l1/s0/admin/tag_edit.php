<?php
// FROM HASH: 2985d293ce8d80fdd8d3eacb848b5799
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['tag'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add tag');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit tag' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['tag']['tag']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['tag'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->func('link', array('tags/delete', $__vars['tag'], ), false),
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
		'name' => 'tag',
		'value' => $__vars['tag'],
	), array(
		'label' => 'Tag',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'tag_url',
		'value' => $__vars['tag'],
		'dir' => 'ltr',
	), array(
		'label' => 'URL version',
		'explain' => 'This will be used to uniquely identify this tag in a URL. It may only contain a-z, 0-9, - and _. Leave this blank to automatically generate it.',
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'permanent',
		'selected' => $__vars['tag']['permanent'],
		'label' => 'Permanent',
		'hint' => 'Making a tag permanent prevents it from being removed when it is no longer in use.',
		'_type' => 'option',
	)), array(
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('tags/save', $__vars['tag'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
}
);