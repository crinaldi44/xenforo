<?php
// FROM HASH: 9a54773a97a89dd52f131c6bba001e51
return array(
'macros' => array('message' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'message' => '!',
		'conversation' => '!',
		'position' => '',
		'lastRead' => null,
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	$__templater->includeCss('message.less');
	$__finalCompiled .= '
	<article class="message message--conversationMessage ' . ($__templater->method($__vars['message'], 'isIgnored', array()) ? ' is-ignored' : '') . ' ' . ($__templater->method($__vars['message'], 'isUnread', array($__vars['lastRead'], )) ? 'is-unread' : '') . ' js-message" data-author="' . ($__templater->escape($__vars['message']['User']['username']) ?: $__templater->escape($__vars['message']['username'])) . '">
		<span class="u-anchorTarget" id="convMessage-' . $__templater->escape($__vars['message']['message_id']) . '"></span>
		<div class="message-inner">
			<div class="message-cell message-cell--user">
				' . $__templater->callMacro(null, 'message_macros::user_info', array(
		'user' => $__vars['message']['User'],
		'fallbackName' => $__vars['message']['username'],
	), $__vars) . '
			</div>
			<div class="message-cell message-cell--main">
				<div class="message-main js-quickEditTarget">
					<div class="message-content">
						<header class="message-attribution">
							<a href="' . $__templater->func('link', array('direct-messages/replies', $__vars['message'], ), true) . '" class="message-attribution-main u-concealed" rel="nofollow">
								' . $__templater->func('date_dynamic', array($__vars['message']['message_date'], array(
	))) . '
							</a>
							<span class="message-attribution-opposite">
								';
	if ($__templater->method($__vars['message'], 'isUnread', array($__vars['lastRead'], ))) {
		$__finalCompiled .= '
									<span class="message-newIndicator">' . 'New' . '</span>
								';
	}
	$__finalCompiled .= '
								';
	if ($__vars['position']) {
		$__finalCompiled .= '#' . $__templater->filter($__vars['position'], array(array('number', array()),), true);
	}
	$__finalCompiled .= '
							</span>
						</header>

						';
	if ($__templater->method($__vars['message'], 'isIgnored', array())) {
		$__finalCompiled .= '
							<div class="messageNotice messageNotice--ignored">
								' . 'You are ignoring content by this member.' . '
							</div>
						';
	}
	$__finalCompiled .= '

						<div class="message-userContent lbContainer js-lbContainer"
							data-lb-id="message-' . $__templater->escape($__vars['message']['message_id']) . '"
							data-lb-caption-title="' . ($__vars['message']['User'] ? $__templater->escape($__vars['message']['User']['username']) : $__templater->escape($__vars['message']['username'])) . '"
							data-lb-caption-desc="' . $__templater->func('date_time', array($__vars['message']['message_date'], ), true) . '">

							<article class="message-body js-selectToQuote">
								' . $__templater->func('bb_code', array($__vars['message']['message'], 'conversation_message', $__vars['message'], ), true) . '
								<div class="js-selectToQuoteEnd">&nbsp;</div>
							</article>

							';
	if ($__vars['message']['attach_count']) {
		$__finalCompiled .= '
								' . $__templater->callMacro(null, 'message_macros::attachments', array(
			'attachments' => $__vars['message']['Attachments'],
			'message' => $__vars['message'],
			'canView' => true,
		), $__vars) . '
							';
	}
	$__finalCompiled .= '
						</div>

						' . $__templater->callMacro(null, 'message_macros::signature', array(
		'user' => $__vars['message']['User'],
	), $__vars) . '
					</div>

					<footer class="message-footer">
						';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
									';
	$__compilerTemp2 = '';
	$__compilerTemp2 .= '
												' . $__templater->func('react', array(array(
		'content' => $__vars['message'],
		'link' => 'direct-messages/replies/react',
		'list' => '< .js-message | .js-reactionsList',
	))) . '

												';
	if ($__templater->method($__vars['conversation'], 'canReply', array())) {
		$__compilerTemp2 .= '
													';
		$__vars['quoteLink'] = $__templater->preEscaped($__templater->func('link', array('direct-messages/reply', $__vars['conversation'], array('quote' => $__vars['message']['message_id'], ), ), true));
		$__compilerTemp2 .= '
													';
		if ($__vars['xf']['options']['multiQuote']) {
			$__compilerTemp2 .= '
														<a href="' . $__templater->escape($__vars['quoteLink']) . '"
															class="actionBar-action actionBar-action--mq u-jsOnly js-multiQuote"
															title="' . $__templater->filter('Toggle multi-quote', array(array('for_attr', array()),), true) . '"
															data-message-id="' . $__templater->escape($__vars['message']['message_id']) . '"
															data-mq-action="add">
															' . 'Quote' . '
														</a>
													';
		}
		$__compilerTemp2 .= '
													<a href="' . $__templater->escape($__vars['quoteLink']) . '"
														class="actionBar-action actionBar-action--reply"
														title="' . $__templater->filter('Reply, quoting this message', array(array('for_attr', array()),), true) . '"
														data-xf-click="quote"
														data-quote-href="' . $__templater->func('link', array('direct-messages/replies/quote', $__vars['message'], ), true) . '">' . 'Reply' . '</a>

												';
	}
	$__compilerTemp2 .= '
											';
	if (strlen(trim($__compilerTemp2)) > 0) {
		$__compilerTemp1 .= '
										<div class="actionBar-set actionBar-set--external">
											' . $__compilerTemp2 . '
										</div>
									';
	}
	$__compilerTemp1 .= '

									';
	$__compilerTemp3 = '';
	$__compilerTemp3 .= '
												';
	if ($__templater->method($__vars['message'], 'canReport', array())) {
		$__compilerTemp3 .= '
													<a href="' . $__templater->func('link', array('direct-messages/replies/report', $__vars['message'], ), true) . '" class="actionBar-action actionBar-action--report" data-xf-click="overlay" data-cache="false">' . 'Report' . '</a>
												';
	}
	$__compilerTemp3 .= '

												';
	if ($__templater->method($__vars['message'], 'canEdit', array())) {
		$__compilerTemp3 .= '
													';
		$__templater->includeJs(array(
			'src' => 'xf/action.js, xf/message.js',
			'min' => '1',
		));
		$__compilerTemp3 .= '
													<a href="' . $__templater->func('link', array('direct-messages/replies/edit', $__vars['message'], ), true) . '"
														class="actionBar-action actionBar-action--edit"
														data-xf-click="quick-edit"
														data-editor-target="< .js-quickEditTarget">' . 'Edit' . '</a>
												';
	}
	$__compilerTemp3 .= '

												';
	if ($__templater->method($__vars['message'], 'canCleanSpam', array())) {
		$__compilerTemp3 .= '
													<a href="' . $__templater->func('link', array('spam-cleaner', $__vars['message'], ), true) . '"
														class="actionBar-action actionBar-action--spam actionBar-action--menuItem"
														data-xf-click="overlay">' . 'Spam' . '</a>
												';
	}
	$__compilerTemp3 .= '

												';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewIps', array()) AND $__vars['message']['ip_id']) {
		$__compilerTemp3 .= '
													<a href="' . $__templater->func('link', array('direct-messages/replies/ip', $__vars['message'], ), true) . '"
														class="actionBar-action actionBar-action--ip"
														data-xf-click="overlay">' . 'IP' . '</a>
												';
	}
	$__compilerTemp3 .= '
											';
	if (strlen(trim($__compilerTemp3)) > 0) {
		$__compilerTemp1 .= '
										<div class="actionBar-set actionBar-set--internal">
											' . $__compilerTemp3 . '
										</div>
									';
	}
	$__compilerTemp1 .= '
								';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
							<div class="message-actionBar actionBar">
								' . $__compilerTemp1 . '
							</div>
						';
	}
	$__finalCompiled .= '

						<div class="reactionsBar js-reactionsList ' . ($__vars['message']['reactions'] ? 'is-active' : '') . '">
							' . $__templater->func('reactions', array($__vars['message'], 'direct-messages/replies/reactions', array())) . '
						</div>
					</footer>
				</div>
			</div>
		</div>
	</article>
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';

	return $__finalCompiled;
}
);