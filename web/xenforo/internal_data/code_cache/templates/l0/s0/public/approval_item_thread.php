<?php
// FROM HASH: f4c7da975152a68418a240f7b9023d8e
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__vars['messageHtml'] = $__templater->preEscaped('
	<h4 class="message-title"><a href="' . $__templater->func('link', array('threads', $__vars['content'], ), true) . '">' . $__templater->escape($__vars['content']['title']) . '</a></h4>
	' . $__templater->func('bb_code', array($__vars['content']['FirstPost']['message'], 'post', $__vars['content']['FirstPost'], ), true) . '
');
	$__finalCompiled .= '

' . $__templater->callMacro(null, 'approval_queue_macros::item_message_type', array(
		'content' => $__vars['content'],
		'user' => $__vars['content']['User'],
		'messageHtml' => $__vars['messageHtml'],
		'typePhraseHtml' => 'Thread',
		'spamDetails' => $__vars['spamDetails'],
		'unapprovedItem' => $__vars['unapprovedItem'],
		'handler' => $__vars['handler'],
		'headerPhraseHtml' => 'Thread <a href="' . $__templater->func('link', array('threads', $__vars['content'], ), true) . '">' . $__templater->escape($__vars['content']['title']) . '</a> posted in forum <a href="' . $__templater->func('link', array('forums', $__vars['content']['Forum'], ), true) . '">' . $__templater->escape($__vars['content']['Forum']['title']) . '</a>',
	), $__vars);
	return $__finalCompiled;
}
);