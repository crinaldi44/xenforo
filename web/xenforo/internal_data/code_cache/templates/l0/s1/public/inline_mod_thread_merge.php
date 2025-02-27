<?php
// FROM HASH: 260d60760a3d7569fed59ba5fb071130
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Inline moderation - Merge threads');
	$__finalCompiled .= '

';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['threads'])) {
		foreach ($__vars['threads'] AS $__vars['thread']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['thread']['thread_id'],
				'label' => $__templater->func('prefix', array('thread', $__vars['thread'], 'escaped', ), true) . $__templater->escape($__vars['thread']['title']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp2 = '';
	if ($__templater->isTraversable($__vars['threads'])) {
		foreach ($__vars['threads'] AS $__vars['thread']) {
			$__compilerTemp2 .= '
		' . $__templater->formHiddenVal('ids[]', $__vars['thread']['thread_id'], array(
			)) . '
	';
		}
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('Are you sure you want to merge ' . $__templater->escape($__vars['total']) . ' threads?', array(
		'rowtype' => 'confirm',
	)) . '

			' . $__templater->formSelectRow(array(
		'name' => 'target_thread_id',
		'value' => $__vars['first']['thread_id'],
	), $__compilerTemp1, array(
		'label' => 'Destination thread',
		'explain' => 'All posts from the other threads will be merged into this thread.',
	)) . '

			' . $__templater->callMacro(null, 'helper_action::thread_redirect', array(
		'label' => 'Leave redirect for merged threads',
	), $__vars) . '

			' . $__templater->callMacro(null, 'helper_action::thread_alert', array(
		'selected' => ($__vars['total'] == 1),
	), $__vars) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'merge',
	), array(
	)) . '
	</div>

	' . $__compilerTemp2 . '

	' . $__templater->formHiddenVal('type', 'thread', array(
	)) . '
	' . $__templater->formHiddenVal('action', 'merge', array(
	)) . '
	' . $__templater->formHiddenVal('confirmed', '1', array(
	)) . '

	' . $__templater->func('redirect_input', array($__vars['redirect'], null, true)) . '
', array(
		'action' => $__templater->func('link', array('inline-mod', ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
}
);