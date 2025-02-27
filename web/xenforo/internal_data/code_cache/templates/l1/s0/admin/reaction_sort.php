<?php
// FROM HASH: 5d5744a38079376f32528fdce86494fe
return array(
'macros' => array('reaction_list' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'reactions' => '!',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	<ol class="nestable-list">
		';
	if ($__templater->isTraversable($__vars['reactions'])) {
		foreach ($__vars['reactions'] AS $__vars['id'] => $__vars['reaction']) {
			$__finalCompiled .= '
			<li class="nestable-item" data-id="' . $__templater->escape($__vars['id']) . '">
				<div class="nestable-handle" aria-label="' . $__templater->filter('Drag handle', array(array('for_attr', array()),), true) . '">' . $__templater->fontAwesome('fa-bars', array(
			)) . '</div>
				<div class="nestable-content">
					' . $__templater->func('reaction', array(array(
				'id' => $__vars['reaction'],
				'showtitle' => 'true',
				'small' => 'true',
			))) . '
				</div>
			</li>
		';
		}
	}
	$__finalCompiled .= '
	</ol>
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Sort reactions');
	$__finalCompiled .= '

' . $__templater->callMacro(null, 'public:nestable_macros::setup', array(), $__vars) . '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			<div class="nestable-container" data-xf-init="nestable" data-max-depth="1" data-value-function="serialize">
				' . $__templater->callMacro(null, 'reaction_list', array(
		'reactions' => $__vars['reactions'],
	), $__vars) . '
				' . $__templater->formHiddenVal('reactions', '', array(
	)) . '
			</div>
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
	), array(
		'rowtype' => 'simple',
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('reactions/sort', ), false),
		'class' => 'block',
		'ajax' => 'true',
	)) . '

';
	return $__finalCompiled;
}
);