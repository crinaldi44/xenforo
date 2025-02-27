<?php
// FROM HASH: 7d335e8ece78676bc4eda9fcee48ae74
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Confirm action');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Please confirm that you want to ban the following IP address' . $__vars['xf']['language']['label_separator'] . '
				<strong><a href="' . $__templater->func('link', array('users/ip-users', null, array('ip' => $__vars['ip']['ip'], ), ), true) . '" dir="ltr">' . $__templater->escape($__vars['ip']['ip']) . '</a></strong>
			', array(
		'rowtype' => 'confirm',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'reason',
		'value' => $__vars['ip'],
	), array(
		'label' => 'Reason',
		'hint' => 'Optional',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('banning/ips/add', null, array('ip' => $__vars['ip']['ip'], ), ), false),
		'ajax' => 'true',
		'data-redirect' => 'off',
		'class' => 'block',
	));
	return $__finalCompiled;
}
);