<?php
// FROM HASH: 20633a615cd0d88c08fb79bee013b4ae
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped($__templater->escape($__vars['option']['title']));
	$__finalCompiled .= '

';
	$__vars['values'] = (($__vars['type'] == $__vars['option']['option_value']['emailTransport']) ? $__vars['option']['option_value'] : array());
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formRow('
				' . $__templater->filter($__vars['type'], array(array('to_upper', array()),), true) . '
				' . $__templater->formHiddenVal('emailTransport', $__vars['type'], array(
	)) . '
			', array(
		'label' => 'Connection type',
	)) . '

			' . '' . '

			' . $__templater->formRow('
				<div class="inputGroup">
					' . $__templater->formTextBox(array(
		'name' => 'smtpHost',
		'value' => $__vars['values']['smtpHost'],
		'placeholder' => 'Host',
		'size' => '40',
		'required' => 'required',
	)) . '
					<span class="inputGroup-text">:</span>
					' . $__templater->formTextBox(array(
		'name' => 'smtpPort',
		'value' => $__vars['values']['smtpPort'],
		'placeholder' => 'Port',
		'size' => '5',
		'required' => 'required',
	)) . '
				</div>
			', array(
		'label' => 'Host',
		'rowtype' => 'input',
	)) . '

			' . $__templater->formRadioRow(array(
		'name' => 'smtpAuth',
		'value' => ($__vars['values']['smtpAuth'] ?: 'none'),
	), array(array(
		'value' => 'none',
		'label' => 'None',
		'_type' => 'option',
	),
	array(
		'value' => 'login',
		'label' => 'Username and password',
		'_dependent' => array('
						<div class="inputGroup">
							' . $__templater->formTextBox(array(
		'name' => 'smtpLoginUsername',
		'value' => $__vars['values']['smtpLoginUsername'],
		'placeholder' => 'Username',
		'size' => '15',
	)) . '
							<span class="inputGroup-splitter"></span>
							' . $__templater->formTextBox(array(
		'name' => 'smtpLoginPassword',
		'placeholder' => 'Password',
		'type' => 'password',
		'size' => '15',
	)) . '
						</div>
					'),
		'_type' => 'option',
	)), array(
		'label' => 'Authentication',
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'smtpSsl',
		'checked' => $__vars['values']['smtpSsl'],
		'label' => 'Use SSL/TLS',
		'hint' => 'SSL/TLS is distinct from STARTTLS. STARTTLS will be used automatically if the mail server supports it. The <a href="https://secure.php.net/manual/en/book.openssl.php" target="_blank"><code>openssl</code></a> PHP extension is required to use STARTTLS or SSL/TLS.',
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
		'action' => $__templater->func('link', array('options/email-transport-server', $__vars['option'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
}
);