<?php
// FROM HASH: 2e50ce8667fca020ba52e26304a54ce6
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Preferences');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canChangeStyle', array())) {
		$__compilerTemp1 .= '

				';
		$__compilerTemp2 = array(array(
			'value' => '0',
			'label' => 'Use default style' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['defaultStyle']['title']),
			'_type' => 'option',
		));
		if ($__templater->isTraversable($__vars['styles'])) {
			foreach ($__vars['styles'] AS $__vars['style']) {
				$__compilerTemp2[] = array(
					'value' => $__vars['style']['style_id'],
					'label' => $__templater->escape($__vars['style']['title']) . ((!$__vars['style']['user_selectable']) ? ' *' : ''),
					'_type' => 'option',
				);
			}
		}
		$__compilerTemp1 .= $__templater->formSelectRow(array(
			'name' => 'user[style_id]',
			'value' => $__vars['xf']['visitor'],
			'data-xf-init' => 'style-variation-input',
		), $__compilerTemp2, array(
			'label' => 'Style',
		)) . '
			';
	} else {
		$__compilerTemp1 .= '
				' . $__templater->formHiddenVal('user[style_id]', $__vars['xf']['visitor']['style_id'], array(
		)) . '
			';
	}
	$__compilerTemp3 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canChangeLanguage', array())) {
		$__compilerTemp3 .= '
				';
		$__compilerTemp4 = array();
		if ($__templater->isTraversable($__vars['languages'])) {
			foreach ($__vars['languages'] AS $__vars['language']) {
				$__compilerTemp4[] = array(
					'value' => $__vars['language']['language_id'],
					'label' => $__templater->escape($__vars['language']['title']) . ((!$__vars['language']['user_selectable']) ? ' *' : ''),
					'_type' => 'option',
				);
			}
		}
		$__compilerTemp3 .= $__templater->formSelectRow(array(
			'name' => 'user[language_id]',
			'value' => $__vars['xf']['visitor'],
		), $__compilerTemp4, array(
			'label' => 'Language',
		)) . '
			';
	} else {
		$__compilerTemp3 .= '
				' . $__templater->formHiddenVal('user[language_id]', ($__vars['xf']['visitor']['language_id'] ?: $__vars['xf']['options']['defaultLanguageId']), array(
		)) . '
			';
	}
	$__compilerTemp5 = $__templater->mergeChoiceOptions(array(), $__vars['timeZones']);
	$__compilerTemp6 = '';
	if ($__vars['xf']['visitor']['is_moderator']) {
		$__compilerTemp6 .= '
				' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => 'moderator[notify_report]',
			'checked' => $__vars['xf']['visitor']['Moderator']['notify_report'],
			'label' => 'Receive email when content is reported',
			'_type' => 'option',
		),
		array(
			'name' => 'moderator[notify_approval]',
			'checked' => $__vars['xf']['visitor']['Moderator']['notify_approval'],
			'label' => 'Receive email when content is pending approval',
			'_type' => 'option',
		)), array(
			'label' => 'Moderator options',
		)) . '
			';
	}
	$__compilerTemp7 = '';
	if ($__vars['xf']['options']['enableNotices'] AND (($__templater->func('count', array($__vars['xf']['session']['dismissedNotices'], ), false) > 0))) {
		$__compilerTemp7 .= '
				<hr class="formRowSep" />

				' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => 'restore_notices',
			'label' => 'Restore dismissed notices',
			'hint' => 'Any notices you have previously dismissed will be restored to view if you check this option.',
			'_type' => 'option',
		)), array(
		)) . '
			';
	}
	$__compilerTemp8 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canUsePushNotifications', array())) {
		$__compilerTemp8 .= '
				' . $__templater->formRow('
					' . $__templater->button('
						' . 'Checking device capabilities' . $__vars['xf']['language']['ellipsis'] . '
					', array(
			'class' => 'is-disabled',
			'data-xf-init' => 'push-toggle',
		), '', array(
		)) . '
				', array(
			'label' => 'Push notifications',
			'rowtype' => 'button',
			'explain' => 'Enabling push notifications requires a supported device. Enabling push notifications will enable them for this device only. If you log out of this device, you will need to re-enable push notifications.',
		)) . '

				' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => 'option[push_on_conversation]',
			'checked' => $__vars['xf']['visitor']['Option']['push_on_conversation'],
			'label' => 'Receive push notification when a new direct message is received',
			'_type' => 'option',
		)), array(
			'label' => '',
		)) . '

				';
		$__templater->inlineJs('
					XF.extendObject(true, XF.config, {
						skipPushNotificationSubscription: true,
						skipPushNotificationCta: true
					});

					XF.extendObject(XF.phrases, {
						push_enable_label: "' . $__templater->filter('Enable push notifications', array(array('escape', array('js', )),), false) . '",
						push_disable_label: "' . $__templater->filter('Disable push notifications', array(array('escape', array('js', )),), false) . '",
						push_not_supported_label: "' . $__templater->filter('Push notifications not supported', array(array('escape', array('js', )),), false) . '",
						push_blocked_label: "' . $__templater->filter('Push notifications blocked', array(array('escape', array('js', )),), false) . '"
					});
				', true);
		$__compilerTemp8 .= '
			';
	} else {
		$__compilerTemp8 .= '
				' . $__templater->formHiddenVal('option[push_on_conversation]', $__vars['xf']['visitor']['Option']['push_on_conversation'], array(
		)) . '
			';
	}
	$__compilerTemp9 = '';
	if (!$__templater->test($__vars['alertOptOuts'], 'empty', array())) {
		$__compilerTemp9 .= '
			';
		$__templater->includeCss('notification_opt_out.less');
		$__compilerTemp9 .= '
			<h2 class="block-formSectionHeader"><span class="block-formSectionHeader-aligner">' . 'Receive a notification when someone' . $__vars['xf']['language']['ellipsis'] . '</span></h2>
			<div class="block-body">
				';
		$__vars['canPush'] = $__templater->method($__vars['xf']['visitor'], 'canUsePushNotifications', array());
		$__compilerTemp9 .= '
				';
		if ($__templater->isTraversable($__vars['alertOptOuts'])) {
			foreach ($__vars['alertOptOuts'] AS $__vars['contentType'] => $__vars['options']) {
				$__compilerTemp9 .= '
					';
				if ($__templater->isTraversable($__vars['options'])) {
					foreach ($__vars['options'] AS $__vars['action'] => $__vars['label']) {
						$__compilerTemp9 .= '
						';
						$__compilerTemp10 = '';
						if ($__vars['canPush']) {
							$__compilerTemp10 .= '
									<li class="notificationChoices-choice notificationChoices-choice--push">
										' . $__templater->formCheckBox(array(
								'standalone' => 'true',
							), array(array(
								'name' => 'push[' . $__vars['contentType'] . '_' . $__vars['action'] . ']',
								'checked' => $__templater->method($__vars['xf']['visitor']['Option'], 'doesReceivePush', array($__vars['contentType'], $__vars['action'], )),
								'label' => 'Push',
								'_type' => 'option',
							))) . '
										' . $__templater->formHiddenVal('push_shown[' . $__vars['contentType'] . '_' . $__vars['action'] . ']', '1', array(
							)) . '
									</li>
								';
						}
						$__compilerTemp9 .= $__templater->formRow('
							<ul class="notificationChoices">
								<li class="notificationChoices-choice notificationChoices-choice--alert">
									' . $__templater->formCheckBox(array(
							'standalone' => 'true',
						), array(array(
							'name' => 'alert[' . $__vars['contentType'] . '_' . $__vars['action'] . ']',
							'data-xf-init' => ($__vars['canPush'] ? 'disabler' : ''),
							'data-container' => '< .notificationChoices | .notificationChoices-choice--push',
							'checked' => $__templater->method($__vars['xf']['visitor']['Option'], 'doesReceiveAlert', array($__vars['contentType'], $__vars['action'], )),
							'label' => 'Alert',
							'_type' => 'option',
						))) . '
								</li>
								' . $__compilerTemp10 . '
							</ul>
						', array(
							'label' => $__templater->escape($__vars['label']),
							'data-content-type' => $__vars['contentType'],
							'data-action' => $__vars['action'],
						)) . '
					';
					}
				}
				$__compilerTemp9 .= '
					<hr class="formRowSep" />
				';
			}
		}
		$__compilerTemp9 .= '

			</div>
		';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__compilerTemp1 . '

			<div class="js-variationContainer">
				' . $__templater->callMacro(null, 'style_variation_macros::variation_input', array(
		'style' => $__vars['xf']['style'],
	), $__vars) . '
			</div>

			' . $__compilerTemp3 . '

			' . $__templater->formSelectRow(array(
		'name' => 'user[timezone]',
		'value' => $__vars['xf']['visitor'],
	), $__compilerTemp5, array(
		'label' => 'Time zone',
	)) . '

			' . $__templater->callMacro(null, 'helper_account::email_options_row', array(
		'showConversationOption' => true,
	), $__vars) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'value' => 'watch_no_email',
		'name' => 'option[creation_watch_state]',
		'checked' => ($__vars['xf']['visitor']['Option']['creation_watch_state'] ? true : false),
		'label' => 'Automatically watch content you create' . $__vars['xf']['language']['ellipsis'],
		'_dependent' => array($__templater->formCheckBox(array(
	), array(array(
		'value' => 'watch_email',
		'name' => 'option[creation_watch_state]',
		'checked' => ($__vars['xf']['visitor']['Option']['creation_watch_state'] == 'watch_email'),
		'label' => 'and receive email notifications',
		'_type' => 'option',
	)))),
		'_type' => 'option',
	),
	array(
		'value' => 'watch_no_email',
		'name' => 'option[interaction_watch_state]',
		'checked' => ($__vars['xf']['visitor']['Option']['interaction_watch_state'] ? true : false),
		'label' => 'Automatically watch content you interact with' . $__vars['xf']['language']['ellipsis'],
		'_dependent' => array($__templater->formCheckBox(array(
	), array(array(
		'value' => 'watch_email',
		'name' => 'option[interaction_watch_state]',
		'checked' => ($__vars['xf']['visitor']['Option']['interaction_watch_state'] == 'watch_email'),
		'label' => 'and receive email notifications',
		'_type' => 'option',
	)))),
		'_type' => 'option',
	),
	array(
		'name' => 'option[content_show_signature]',
		'checked' => $__vars['xf']['visitor']['Option']['content_show_signature'],
		'label' => 'Show people\'s signatures with their messages',
		'_type' => 'option',
	)), array(
		'label' => 'Content options',
	)) . '

			' . $__templater->callMacro(null, 'helper_account::activity_privacy_row', array(), $__vars) . '

			' . $__compilerTemp6 . '

			' . $__templater->callMacro(null, 'custom_fields_macros::custom_fields_edit', array(
		'type' => 'users',
		'group' => 'preferences',
		'set' => $__vars['xf']['visitor']['Profile']['custom_fields'],
	), $__vars) . '
			
			' . $__compilerTemp7 . '

			' . $__compilerTemp8 . '
		</div>

		' . $__compilerTemp9 . '

		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('account/preferences', ), false),
		'ajax' => 'true',
		'class' => 'block',
		'data-force-flash-message' => 'true',
	)) . '
';
	return $__finalCompiled;
}
);