<?php
// FROM HASH: e7cf5ad92be8f0d66b44fe6fcead1ad3
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	if ($__vars['context'] == 'setup') {
		$__finalCompiled .= '
	';
		$__templater->includeJs(array(
			'src' => 'vendor/kjua/kjua.min.js',
		));
		$__finalCompiled .= '
	' . $__templater->formRow('
		' . 'To receive verification codes via a phone app, you must first install a code-generating app such as <a href="https://www.authy.com" target="_blank">Authy</a> or <a href="https://support.google.com/accounts/answer/1066447?hl=en" target="_blank">Google Authenticator</a> on your phone.<br />
			<br />
			Once you have done this, you will need to scan the QR code below into the app and enter the generated code below to confirm.' . '
		<div style="text-align: center; margin: 10px 0px;"><span id="js-totpQrCode" style="display: inline-block; background: white; padding: 12px"></span></div>
		' . 'Alternatively, you may enter the secret into the app directly: ' . $__templater->escape($__vars['secret']) . '' . '
	', array(
			'label' => 'Setup',
		)) . '
	';
		$__templater->inlineJs('
		const el = document.querySelector(\'#js-totpQrCode\')
		const qr = kjua({
			text: \'' . $__templater->filter($__vars['otpUrl'], array(array('escape', array('js', )),), false) . '\'
		})
		el.innerHTML = \'\'
		el.append(qr)
	', true);
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	' . $__templater->formInfoRow('Please enter the verification code generated by the app on your phone.', array(
		)) . '
';
	}
	$__finalCompiled .= '

' . $__templater->formTextBoxRow(array(
		'name' => 'code',
		'autofocus' => 'autofocus',
		'inputmode' => 'numeric',
		'pattern' => '[0-9]*',
		'autocomplete' => 'one-time-code',
	), array(
		'label' => 'Verification code',
	));
	return $__finalCompiled;
}
);