<?php
// FROM HASH: a0aaa36989849c99d7941891a2c56801
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Continue with ' . $__templater->escape($__vars['provider']['title']) . '');
	$__finalCompiled .= '

';
	$__compilerTemp1 = $__vars;
	$__compilerTemp1['pageSelected'] = 'connected_account';
	$__templater->wrapTemplate('account_wrapper', $__compilerTemp1);
	$__finalCompiled .= '

';
	$__compilerTemp2 = '';
	if ($__vars['passwordEmailed']) {
		$__compilerTemp2 .= '
				' . $__templater->formInfoRow('
					<div class="blockMessage blockMessage--important blockMessage--iconic">' . 'To confirm your identity, we have sent an email to ' . $__templater->filter($__vars['user']['email'], array(array('email_display', array()),), true) . ' inviting you to create a password. Once you have followed that link, please enter your new password below.' . '</div>
				', array(
		)) . '
			';
	}
	$__finalCompiled .= $__templater->form('

	<div class="block-container">
		<div class="block-body">
			' . $__compilerTemp2 . '

			' . $__templater->formRow('
				' . $__templater->escape($__vars['xf']['visitor']['username']) . '
			', array(
		'label' => 'Associate with',
	)) . '

			' . $__templater->formPasswordBoxRow(array(
		'name' => 'password',
	), array(
		'label' => 'Password',
		'explain' => 'This is the password of the ' . $__templater->escape($__vars['xf']['options']['boardTitle']) . ' account that you wish to associate with.',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Associate',
	), array(
	)) . '
	</div>
	' . $__templater->func('redirect_input', array($__vars['redirect'], null, true)) . '
', array(
		'action' => $__templater->func('link', array('register/connected-accounts/associate', $__vars['provider'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
}
);