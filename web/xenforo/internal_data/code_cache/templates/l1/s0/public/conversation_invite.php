<?php
// FROM HASH: 419040388eeb1f3a2d7371c8e3e5fb9c
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Invite members to direct message');
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped('Direct messages'), $__templater->func('link', array('direct-messages', ), false), array(
	));
	$__finalCompiled .= '
';
	$__templater->breadcrumb($__templater->preEscaped($__templater->escape($__vars['conversation']['title'])), $__templater->func('link', array('direct-messages', $__vars['conversation'], ), false), array(
	));
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['remainingRecipients'] > 1) {
		$__compilerTemp1 .= 'You may enter multiple names here.';
	}
	$__compilerTemp2 = '';
	if ($__vars['remainingRecipients'] > 0) {
		$__compilerTemp2 .= 'You may invite up to ' . $__templater->filter($__vars['remainingRecipients'], array(array('number', array()),), true) . ' member(s).';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTokenInputRow(array(
		'name' => 'recipients',
		'href' => $__templater->func('link', array('members/find', ), false),
		'min-length' => '1',
		'max-tokens' => ((($__vars['remainingRecipients'] > -1)) ? $__vars['remainingRecipients'] : null),
	), array(
		'label' => 'Invite members',
		'explain' => '
					' . $__compilerTemp1 . ' ' . 'Invited members will be able to see the entire direct message from the beginning.' . '
					' . $__compilerTemp2 . '
				',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Invite',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('direct-messages/invite', $__vars['conversation'], ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
}
);