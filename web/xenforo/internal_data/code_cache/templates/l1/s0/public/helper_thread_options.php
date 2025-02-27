<?php
// FROM HASH: f93026ab20655a3af959d25eb52f96e2
return array(
'macros' => array('watch_input' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'thread' => '!',
		'rowType' => '',
		'label' => 'Options',
		'explain' => '',
		'forceWatchChecked' => null,
		'forceWatchEmailChecked' => null,
		'visible' => true,
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	';
	$__vars['threadWatch'] = $__vars['thread']['Watch'][$__vars['xf']['visitor']['user_id']];
	$__finalCompiled .= '
	';
	$__vars['defaultThreadWatch'] = ($__templater->method($__vars['thread'], 'isInsert', array()) ? $__vars['xf']['visitor']['Option']['creation_watch_state'] : $__vars['xf']['visitor']['Option']['interaction_watch_state']);
	$__finalCompiled .= '

	';
	if ($__vars['forceWatchChecked'] !== null) {
		$__finalCompiled .= '
		';
		$__vars['watchChecked'] = $__vars['forceWatchChecked'];
		$__finalCompiled .= '
	';
	} else {
		$__finalCompiled .= '
		';
		$__vars['watchChecked'] = ((($__vars['thread']['thread_id'] AND !$__templater->test($__vars['threadWatch'], 'empty', array()))) ?: (($__vars['defaultThreadWatch'] != '')));
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '

	';
	if ($__vars['forceWatchEmailChecked'] !== null) {
		$__finalCompiled .= '
		';
		$__vars['watchEmailChecked'] = $__vars['forceWatchEmailChecked'];
		$__finalCompiled .= '
	';
	} else {
		$__finalCompiled .= '
		';
		$__vars['watchEmailChecked'] = ((($__vars['thread']['thread_id'] AND $__vars['threadWatch']['email_subscribe'])) ?: (($__vars['defaultThreadWatch'] == 'watch_email')));
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '

	';
	if ($__vars['visible']) {
		$__finalCompiled .= '
		' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => 'watch_thread',
			'value' => '1',
			'selected' => $__vars['watchChecked'],
			'label' => 'Watch this thread' . $__vars['xf']['language']['ellipsis'],
			'_dependent' => array($__templater->formCheckBox(array(
		), array(array(
			'name' => 'watch_thread_email',
			'value' => '1',
			'selected' => $__vars['watchEmailChecked'],
			'label' => 'and receive email notifications',
			'_type' => 'option',
		)))),
			'_type' => 'option',
		)), array(
			'label' => $__templater->escape($__vars['label']),
			'rowtype' => $__vars['rowType'],
			'explain' => $__templater->escape($__vars['explain']),
		)) . '
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->formHiddenVal('watch_thread', $__vars['watchChecked'], array(
		)) . '
		' . $__templater->formHiddenVal('watch_thread_email', $__vars['watchEmailChecked'], array(
		)) . '
	';
	}
	$__finalCompiled .= '
	' . $__templater->formHiddenVal('_xfSet[watch_thread]', '1', array(
	)) . '
';
	return $__finalCompiled;
}
),
'thread_status' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'thread' => '!',
		'rowType' => '',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

	';
	$__compilerTemp1 = array();
	if ($__templater->method($__vars['thread'], 'canLockUnlock', array())) {
		$__compilerTemp1[] = array(
			'name' => 'discussion_open',
			'value' => '1',
			'selected' => $__vars['thread']['discussion_open'],
			'label' => 'Unlocked',
			'hint' => 'People may reply to this thread',
			'afterhtml' => '
					' . $__templater->formHiddenVal('_xfSet[discussion_open]', '1', array(
		)) . '
				',
			'_type' => 'option',
		);
	}
	if ($__templater->method($__vars['thread'], 'canStickUnstick', array())) {
		$__compilerTemp1[] = array(
			'name' => 'sticky',
			'value' => '1',
			'selected' => $__vars['thread']['sticky'],
			'label' => 'Sticky',
			'hint' => 'Sticky threads appear at the top of the first page of the list of threads in their parent forum',
			'afterhtml' => '
					' . $__templater->formHiddenVal('_xfSet[sticky]', '1', array(
		)) . '
				',
			'_type' => 'option',
		);
	}
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
		'hideempty' => 'true',
	), $__compilerTemp1, array(
		'rowtype' => $__vars['rowType'],
		'label' => 'Set thread status',
	)) . '

	';
	if ($__templater->method($__vars['thread'], 'canManageSearchEngineIndexing', array())) {
		$__finalCompiled .= '
		';
		if ($__templater->method($__vars['thread'], 'exists', array())) {
			$__finalCompiled .= '
			';
			$__vars['defaultIsIndexed'] = $__templater->method($__vars['thread']['Forum'], 'doesThreadMeetSearchEngineIndexCriteria', array($__vars['thread'], ));
			$__finalCompiled .= '
			';
			$__vars['defaultThreadIndexStatus'] = $__templater->preEscaped($__templater->func('parens', array(($__vars['defaultIsIndexed'] ? 'Yes' : 'No'), ), true));
			$__finalCompiled .= '
		';
		} else {
			$__finalCompiled .= '
			';
			$__vars['defaultThreadIndexStatus'] = '';
			$__finalCompiled .= '
		';
		}
		$__finalCompiled .= '

		' . $__templater->formRadioRow(array(
			'name' => 'index_state',
			'value' => $__vars['thread'],
		), array(array(
			'value' => 'default',
			'label' => 'Default' . ' ' . $__templater->escape($__vars['defaultThreadIndexStatus']),
			'hint' => 'Allows search engines to index this thread based on the settings of the forum it belongs to.',
			'_type' => 'option',
		),
		array(
			'value' => 'indexed',
			'label' => 'Yes',
			'hint' => 'Always allow search engines to index this thread',
			'_type' => 'option',
		),
		array(
			'value' => 'not_indexed',
			'label' => 'No',
			'hint' => 'Never allow search engines to index this thread',
			'_type' => 'option',
		)), array(
			'label' => 'Allow search engine indexing',
		)) . '

		' . $__templater->formHiddenVal('_xfSet[index_state]', '1', array(
		)) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	return $__finalCompiled;
}
);