<?php
// FROM HASH: 82fae1e2a7b1dca7dbfa6909bbb0fab5
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Search phrases');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->callMacro(null, 'language_macros::language_select', array(
		'languageTree' => $__vars['languageTree'],
		'languageId' => $__vars['languageId'],
	), $__vars) . '

			' . $__templater->callMacro(null, 'addon_macros::addon_select', array(
		'addOnId' => '_any',
		'includeAny' => true,
		'emptyValue' => '_none',
	), $__vars) . '

			<hr class="formRowSep" />

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'type' => 'search',
		'dir' => 'ltr',
	), array(
		'label' => 'Title contains',
	)) . '

			' . $__templater->formRow('

				<ul class="inputList">
					<li>' . $__templater->formTextArea(array(
		'name' => 'text',
		'autosize' => 'true',
	)) . '</li>
					<li>' . $__templater->formCheckBox(array(
		'standalone' => 'true',
	), array(array(
		'name' => 'text_cs',
		'label' => 'Case sensitive',
		'_type' => 'option',
	))) . '</li>
				</ul>
			', array(
		'rowtype' => 'input',
		'label' => 'Text contains',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formCheckBoxRow(array(
		'name' => 'state[]',
	), array(array(
		'value' => 'default',
		'selected' => true,
		'label' => 'Unmodified',
		'_type' => 'option',
	),
	array(
		'value' => 'inherited',
		'selected' => true,
		'label' => 'Modified in a parent language',
		'_type' => 'option',
	),
	array(
		'value' => 'custom',
		'selected' => true,
		'label' => 'Modified in this language',
		'_type' => 'option',
	)), array(
		'label' => 'Phrase status',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'search',
	), array(
		'html' => $__templater->button('', array(
		'type' => 'submit',
		'icon' => 'translate',
		'name' => 'translate',
	), '', array(
	)),
	)) . '
	</div>

	' . $__templater->formHiddenVal('search', '1', array(
	)) . '
', array(
		'action' => $__templater->func('link', array('phrases/search', ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
}
);