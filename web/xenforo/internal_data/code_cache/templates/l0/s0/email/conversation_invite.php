<?php
// FROM HASH: c978cabb85afd8066d59d10ba36d4364
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<mail:subject>
	' . '' . $__templater->escape($__vars['sender']['username']) . ' added you to the direct message "' . $__templater->escape($__vars['conversation']['title']) . '"' . '
</mail:subject>

' . '<p>' . $__templater->escape($__vars['sender']['username']) . ' added you to an existing direct message at ' . (((('<a href="' . $__templater->func('link', array('canonical:index', ), true)) . '">') . $__templater->escape($__vars['xf']['options']['boardTitle'])) . '</a>') . '.</p>' . '

<h2><a href="' . $__templater->func('link', array('canonical:direct-messages/unread', $__vars['conversation'], ), true) . '">' . $__templater->escape($__vars['conversation']['title']) . '</a></h2>

';
	if ($__vars['xf']['options']['emailConversationIncludeMessage']) {
		$__finalCompiled .= '
	<div class="message">' . $__templater->func('bb_code_type', array('emailHtml', $__vars['message']['message'], 'conversation_message', $__vars['message'], ), true) . '</div>
';
	}
	$__finalCompiled .= '

<table cellpadding="10" cellspacing="0" border="0" width="100%" class="linkBar">
<tr>
	<td>
		<a href="' . $__templater->func('link', array('canonical:direct-messages', $__vars['conversation'], ), true) . '" class="button">' . 'View this direct message' . '</a>
	</td>
	<td align="' . ($__vars['xf']['isRtl'] ? 'left' : 'right') . '">
		<a href="' . $__templater->func('link', array('canonical:direct-message', ), true) . '" class="buttonFake">' . 'View all your direct messages' . '</a>
	</td>
</tr>
</table>

' . $__templater->callMacro(null, 'conversation_macros::footer', array(
		'conversation' => $__vars['conversation'],
	), $__vars);
	return $__finalCompiled;
}
);