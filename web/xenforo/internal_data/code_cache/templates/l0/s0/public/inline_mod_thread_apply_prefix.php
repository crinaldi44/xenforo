<?php
// FROM HASH: 4e326cfe8c541bdd0e475ddb521bd254
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Inline moderation - Apply thread prefix');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__templater->isTraversable($__vars['threads'])) {
		foreach ($__vars['threads'] AS $__vars['thread']) {
			$__compilerTemp1 .= '
		' . $__templater->formHiddenVal('ids[]', $__vars['thread']['thread_id'], array(
			)) . '
	';
		}
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('Are you sure you want to apply the prefix specified below to the ' . $__templater->escape($__vars['total']) . ' selected threads?', array(
		'rowtype' => 'confirm',
	)) . '

			' . $__templater->callMacro(null, 'prefix_macros::row', array(
		'type' => 'thread',
		'prefixes' => $__vars['prefixes'],
		'selected' => $__vars['selectedPrefix'],
		'explain' => ((($__vars['forumCount'] > 1)) ? 'The threads you have selected are located in more than one forum. Threads will only be updated if the chosen prefix is valid in its forum.' : ''),
	), $__vars) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'confirm',
	), array(
	)) . '
	</div>

	' . $__compilerTemp1 . '

	' . $__templater->formHiddenVal('type', 'thread', array(
	)) . '
	' . $__templater->formHiddenVal('action', 'apply_prefix', array(
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