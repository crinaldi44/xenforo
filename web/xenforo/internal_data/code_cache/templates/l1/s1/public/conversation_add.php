<?php
// FROM HASH: 38ba87c57b0720a95663eb165ef72ac5
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Send direct message');
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped('Direct messages'), $__templater->func('link', array('direct-messages', ), false), array(
	));
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
			';
	if (!$__templater->test($__vars['errorUsernames'], 'empty', array())) {
		$__compilerTemp1 .= '
				<div>' . 'You can not send a direct message to the following users because of their privacy settings: ' . $__templater->filter($__vars['errorUsernames'], array(array('join', array(', ', )),), true) . '.' . '</div>
			';
	}
	$__compilerTemp1 .= '

			';
	if (!$__templater->test($__vars['notFoundUsernames'], 'empty', array())) {
		$__compilerTemp1 .= '
				<div>' . 'The following users could not be found: ' . $__templater->filter($__vars['notFoundUsernames'], array(array('join', array(', ', )),), true) . '.' . '</div>
			';
	}
	$__compilerTemp1 .= '

			';
	if ($__vars['recipientLimit']) {
		$__compilerTemp1 .= '
				<div>' . 'You have exceeded the allowed number of recipients (' . $__templater->escape($__vars['recipientLimit']) . ') for this message.' . '</div>
			';
	}
	$__compilerTemp1 .= '
		';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
	<div class="blockMessage blockMessage--error blockMessage--iconic">
		' . $__compilerTemp1 . '
	</div>
';
	}
	$__finalCompiled .= '

';
	$__compilerTemp2 = '';
	if ($__vars['attachmentData']) {
		$__compilerTemp2 .= '
					' . $__templater->callMacro(null, 'helper_attach_upload::upload_block', array(
			'attachmentData' => $__vars['attachmentData'],
			'forceHash' => $__vars['draft']['attachment_hash'],
		), $__vars) . '
				';
	}
	$__compilerTemp3 = '';
	if ($__vars['xf']['options']['multiQuote']) {
		$__compilerTemp3 .= '
					' . $__templater->callMacro(null, 'multi_quote_macros::button', array(
			'href' => $__templater->func('link', array('direct-messages/multi-quote', $__vars['conversation'], ), false),
			'messageSelector' => '.js-message',
			'storageKey' => 'multiQuoteConversation',
		), $__vars) . '
				';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTokenInputRow(array(
		'name' => 'recipients',
		'value' => $__vars['to'],
		'href' => $__templater->func('link', array('members/find', ), false),
		'min-length' => '1',
		'max-tokens' => ((($__vars['maxRecipients'] > -1)) ? $__vars['maxRecipients'] : null),
	), array(
		'rowtype' => 'fullWidth',
		'label' => (((($__vars['maxRecipients'] == -1) OR ($__vars['maxRecipients'] > 1))) ? 'Recipients' : 'Recipient'),
		'explain' => (((($__vars['maxRecipients'] == -1) OR ($__vars['maxRecipients'] > 1))) ? 'You may enter multiple names here.' : null),
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => $__vars['title'],
		'class' => 'input--title',
		'maxlength' => $__templater->func('max_length', array('XF:ConversationMaster', 'title', ), false),
		'placeholder' => 'Title' . $__vars['xf']['language']['ellipsis'],
	), array(
		'rowtype' => 'fullWidth noLabel',
		'label' => 'Title',
	)) . '

			' . $__templater->formEditorRow(array(
		'name' => 'message',
		'value' => $__vars['message'],
		'attachments' => ($__vars['attachmentData'] ? $__vars['attachmentData']['attachments'] : array()),
		'data-preview-url' => $__templater->func('link', array('direct-messages/add-preview', ), false),
	), array(
		'rowtype' => 'fullWidth noLabel mergePrev',
	)) . '

			' . $__templater->formRow('
				' . $__compilerTemp2 . '

				' . $__compilerTemp3 . '
			', array(
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'open_invite',
		'checked' => ((($__vars['draft']['open_invite'] OR $__vars['conversation']['open_invite'])) ? 'checked' : ''),
		'label' => '
					' . 'Allow anyone in the direct message to invite others' . '
				',
		'_type' => 'option',
	),
	array(
		'name' => 'conversation_locked',
		'checked' => ((($__vars['draft']['conversation_open'] OR $__vars['conversation']['conversation_open'])) ? '' : 'checked'),
		'label' => '
					' . 'Lock direct message (no responses will be allowed)' . '
				',
		'_type' => 'option',
	)), array(
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Send direct message',
		'sticky' => 'true',
		'icon' => 'conversation',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('direct-messages/add', ), false),
		'ajax' => 'true',
		'draft' => $__templater->func('link', array('direct-messages/draft', ), false),
		'class' => 'block',
		'data-xf-init' => 'attachment-manager',
	));
	return $__finalCompiled;
}
);