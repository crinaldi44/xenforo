<?php
// FROM HASH: 0666cf781733e65cc81d12d8ca8d2d2f
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__vars['userIp'] = $__templater->method($__vars['user'], 'getIp', array('register', ));
	$__finalCompiled .= '
';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewIps', array()) AND $__vars['userIp']) {
		$__compilerTemp1 .= '
		<a href="' . $__templater->func('link', array('misc/ip-info', null, array('ip' => $__templater->filter($__vars['userIp'], array(array('ip', array()),), false), ), ), true) . '" target="_blank">' . $__templater->filter($__vars['userIp'], array(array('ip', array()),), true) . '</a>
	';
	}
	$__compilerTemp2 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canBypassUserPrivacy', array()) AND $__vars['user']['email']) {
		$__compilerTemp2 .= '
		' . $__templater->filter($__vars['user']['email'], array(array('email_display', array()),), true) . '
	';
	}
	$__vars['headerPhraseHtml'] = $__templater->preEscaped($__templater->func('trim', array('
	' . $__compilerTemp1 . '
	' . $__compilerTemp2 . '
'), false));
	$__finalCompiled .= '

';
	$__compilerTemp3 = '';
	if ($__vars['preRegAction'] AND $__vars['preRegHandler']) {
		$__compilerTemp3 .= '
		' . $__templater->filter($__templater->method($__vars['preRegHandler'], 'renderApprovalQueueInfo', array($__vars['preRegAction'], )), array(array('raw', array()),), true) . '
	';
	}
	$__compilerTemp4 = '';
	if ($__vars['changesGrouped']) {
		$__compilerTemp4 .= '
		<br />
		';
		$__compilerTemp5 = '';
		if ($__templater->isTraversable($__vars['changesGrouped'])) {
			foreach ($__vars['changesGrouped'] AS $__vars['group']) {
				$__compilerTemp5 .= '
				<tbody class="dataList-rowGroup">
				';
				if ($__templater->isTraversable($__vars['group']['changes'])) {
					foreach ($__vars['group']['changes'] AS $__vars['change']) {
						$__compilerTemp5 .= '
					' . $__templater->dataRow(array(
						), array(array(
							'_type' => 'cell',
							'html' => $__templater->escape($__vars['change']['label']),
						),
						array(
							'_type' => 'cell',
							'html' => $__templater->escape($__vars['change']['old']),
						),
						array(
							'_type' => 'cell',
							'html' => $__templater->escape($__vars['change']['new']),
						))) . '
				';
					}
				}
				$__compilerTemp5 .= '
				</tbody>
			';
			}
		}
		$__compilerTemp4 .= $__templater->dataList('
			<thead>
			' . $__templater->dataRow(array(
			'rowtype' => 'subSection',
		), array(array(
			'colspan' => '3',
			'_type' => 'cell',
			'html' => 'Change log',
		))) . '
			' . $__templater->dataRow(array(
			'rowtype' => 'header',
		), array(array(
			'_type' => 'cell',
			'html' => 'Field name',
		),
		array(
			'_type' => 'cell',
			'html' => 'Old value',
		),
		array(
			'_type' => 'cell',
			'html' => 'New value',
		))) . '
			</thead>
			' . $__compilerTemp5 . '
		', array(
			'data-xf-init' => 'responsive-data-list',
			'class' => 'dataList--separated',
		)) . '
	';
	}
	$__vars['messageHtml'] = $__templater->preEscaped($__templater->func('trim', array('

	' . $__templater->callMacro(null, 'custom_fields_macros::custom_fields_view', array(
		'type' => 'users',
		'group' => null,
		'set' => $__vars['user']['Profile']['custom_fields'],
		'additionalFilters' => array('registration', ),
	), $__vars) . '

	' . $__compilerTemp3 . '

	' . $__compilerTemp4 . '

'), false));
	$__finalCompiled .= '

';
	$__compilerTemp6 = array(array(
		'value' => '',
		'checked' => 'checked',
		'label' => 'Do nothing',
		'data-xf-click' => 'approval-control',
		'_type' => 'option',
	)
,array(
		'value' => 'approve',
		'label' => 'Approve',
		'data-xf-click' => 'approval-control',
		'_type' => 'option',
	));
	if ($__templater->method($__vars['xf']['visitor'], 'canCleanSpam', array()) AND $__templater->method($__vars['unapprovedItem']['Content'], 'isPossibleSpammer', array())) {
		$__compilerTemp6[] = array(
			'value' => 'spam_clean',
			'label' => 'Spam clean',
			'data-xf-click' => 'approval-control',
			'_type' => 'option',
		);
	}
	$__compilerTemp6[] = array(
		'value' => 'reject',
		'label' => 'Reject with reason' . $__vars['xf']['language']['label_separator'],
		'title' => 'Rejected users will not be deleted but will be set to \'rejected\'. The reason for rejection, if entered here, will be displayed when they next log in.',
		'data-xf-init' => 'tooltip',
		'data-xf-click' => 'approval-control',
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'reason[' . $__vars['unapprovedItem']['content_type'] . '][' . $__vars['unapprovedItem']['content_id'] . ']',
		'maxlength' => $__templater->func('max_length', array('XF:UserReject', 'reject_reason', ), false),
		'placeholder' => 'Optional',
	))),
		'html' => '
				<div class="formRow-explain">' . 'This will be shown to the user if provided.' . '</div>
			',
		'_type' => 'option',
	);
	$__vars['actionsHtml'] = $__templater->preEscaped('

	' . $__templater->formRadio(array(
		'name' => 'queue[' . $__vars['unapprovedItem']['content_type'] . '][' . $__vars['unapprovedItem']['content_id'] . ']',
	), $__compilerTemp6) . '

	' . $__templater->formCheckBox(array(
	), array(array(
		'name' => 'notify[' . $__vars['unapprovedItem']['content_type'] . '][' . $__vars['unapprovedItem']['content_id'] . ']',
		'value' => '1',
		'checked' => (!$__vars['spamDetails']),
		'label' => '
			' . 'Notify user if action was taken' . '
		',
		'_type' => 'option',
	))) . '

');
	$__finalCompiled .= '

' . $__templater->callMacro(null, 'approval_queue_macros::item_message_type', array(
		'content' => $__vars['content'],
		'contentDate' => $__vars['user']['register_date'],
		'user' => $__vars['user'],
		'messageHtml' => $__vars['messageHtml'],
		'typePhraseHtml' => 'User',
		'actionsHtml' => $__vars['actionsHtml'],
		'spamDetails' => $__vars['spamDetails'],
		'headerPhraseHtml' => $__vars['headerPhraseHtml'],
	), $__vars);
	return $__finalCompiled;
}
);