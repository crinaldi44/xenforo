<?php
// FROM HASH: 202647972931136b114b86d906d97a23
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->includeJs(array(
		'src' => 'xf/login_signup.js',
		'min' => '1',
	));
	$__finalCompiled .= '
';
	$__templater->includeJs(array(
		'src' => 'xf/webauthn.js',
		'min' => '1',
	));
	$__finalCompiled .= '

';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Log in');
	$__finalCompiled .= '

';
	$__templater->setPageParam('head.' . 'robots', $__templater->preEscaped('<meta name="robots" content="noindex" />'));
	$__finalCompiled .= '

';
	if ($__vars['xf']['session']['preRegActionKey']) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--highlight">
		' . 'Thanks for your contribution. 
Before your content can be posted, please take a few moments to login to your user account.' . '<br />
		<br />
		' . 'Don\'t have an account?' . '
		' . $__templater->button('Register', array(
			'class' => 'button--link',
			'href' => $__templater->func('link', array('register', null, array('_xfRedirect' => $__vars['redirect'], ), ), false),
			'data-xf-click' => 'overlay',
		), '', array(
		)) . '
	</div>
';
	}
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= $__templater->escape($__vars['error']);
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--error blockMessage--iconic">
		' . $__compilerTemp1 . '
	</div>
';
	}
	$__finalCompiled .= '

<div class="blocks">
	';
	$__compilerTemp2 = '';
	if ($__vars['captcha']) {
		$__compilerTemp2 .= '
					' . $__templater->formRowIfContent($__templater->func('captcha_options', array(array(
			'label' => 'Verification',
			'force' => 'true',
			'force-visible' => 'true',
			'context' => 'xf_login',
		))), array(
			'label' => 'Verification',
			'force' => 'true',
			'force-visible' => 'true',
			'context' => 'xf_login',
		)) . '
				';
	}
	$__compilerTemp3 = '';
	if ($__vars['xf']['options']['registrationSetup']['enabled']) {
		$__compilerTemp3 .= '
			<div class="block-outer block-outer--after">
				<div class="block-outer-middle">
					' . 'Don\'t have an account?' . ' ' . $__templater->button('Register now', array(
			'href' => $__templater->func('link', array('register', ), false),
		), '', array(
		)) . '
				</div>
			</div>
		';
	}
	$__finalCompiled .= $__templater->form('
		<div class="block-container">
			<div class="block-body">
				' . $__templater->formTextBoxRow(array(
		'name' => 'login',
		'value' => $__vars['login'],
		'autofocus' => 'autofocus',
		'autocomplete' => 'username',
	), array(
		'label' => 'Your name or email address',
	)) . '

				' . $__templater->formPasswordBoxRow(array(
		'name' => 'password',
		'autocomplete' => 'current-password',
	), array(
		'label' => 'Password',
		'html' => '
						<a href="' . $__templater->func('link', array('lost-password', ), true) . '" data-xf-click="overlay">' . 'Forgot your password?' . '</a>
					',
	)) . '

				' . $__compilerTemp2 . '

				' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'remember',
		'selected' => true,
		'label' => 'Stay logged in',
		'_type' => 'option',
	)), array(
	)) . '

				' . $__templater->formHiddenVal('_xfRedirect', $__vars['redirect'], array(
	)) . '
			</div>
			' . $__templater->formSubmitRow(array(
		'icon' => 'login',
	), array(
	)) . '
		</div>
		' . $__compilerTemp3 . '
	', array(
		'action' => $__templater->func('link', array('login/login', ), false),
		'class' => 'block',
	)) . '

	<div class="blocks-textJoiner"><span></span><em>' . 'or' . '</em><span></span></div>

	<div class="block">
		<div class="block-container">
			<div class="block-body">
				';
	$__compilerTemp4 = '';
	if ($__templater->isTraversable($__vars['providers'])) {
		foreach ($__vars['providers'] AS $__vars['provider']) {
			if (!$__templater->test($__vars['providers'], 'empty', array())) {
				$__compilerTemp4 .= '
							<li>
								' . $__templater->callMacro(null, 'connected_account_macros::button', array(
					'provider' => $__vars['provider'],
				), $__vars) . '
							</li>
						';
			}
		}
	}
	$__finalCompiled .= $__templater->formRow('

					<ul class="listHeap">
						<li>
							' . $__templater->form('

									' . $__templater->button('
										' . $__templater->func('passkey_icon', array(), true) . ' ' . 'Passkey' . '
									', array(
		'class' => 'button--provider button--provider--passkey js-webauthnStart',
	), '', array(
	)) . '

								' . $__templater->formHiddenVal('webauthn_payload', '', array(
	)) . '
								' . $__templater->formHiddenVal('webauthn_challenge', ($__vars['passkey'] ? $__templater->method($__vars['passkey'], 'getChallenge', array()) : ''), array(
	)) . '
							', array(
		'action' => $__templater->func('link', array('login/login', ), false),
		'data-xf-init' => 'webauthn',
		'data-type' => 'get',
		'data-autotrigger' => 'false',
		'data-autosubmit' => 'true',
		'data-verifying' => 'Verifying' . $__vars['xf']['language']['ellipsis'],
	)) . '
						</li>

						' . $__compilerTemp4 . '
					</ul>
				', array(
		'rowtype' => 'button',
		'label' => 'Log in using',
	)) . '
			</div>
		</div>
	</div>
</div>';
	return $__finalCompiled;
}
);