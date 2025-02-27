<?php
// FROM HASH: 90eac99f1c8b0f29f024b662e07ef1ef
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Lost password');
	$__finalCompiled .= '

';
	$__templater->setPageParam('head.' . 'robots', $__templater->preEscaped('<meta name="robots" content="noindex" />'));
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['xf']['options']['lostPasswordCaptcha']) {
		$__compilerTemp1 .= '
				' . $__templater->formRowIfContent($__templater->func('captcha_options', array(array(
			'label' => 'Verification',
			'context' => 'xf_lost_password',
		))), array(
			'label' => 'Verification',
			'context' => 'xf_lost_password',
		)) . '
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('If you have forgotten your password, you can use this form to reset your password. You will receive an email with instructions.', array(
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'email',
		'type' => 'email',
		'autofocus' => 'autofocus',
		'autocomplete' => 'email',
		'maxlength' => $__templater->func('max_length', array($__vars['xf']['visitor'], 'email', ), false),
	), array(
		'label' => 'Email',
		'explain' => 'The email address you are registered with is required to reset your password.',
	)) . '

			' . $__compilerTemp1 . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Reset',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('lost-password', ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
}
);