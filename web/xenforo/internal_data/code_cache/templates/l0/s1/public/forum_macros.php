<?php
// FROM HASH: ceea8f844034b1733e1d1ec8438f6590
return array(
'macros' => array('forum_page_options' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'forum' => '!',
		'thread' => '',
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
	';
	$__templater->setPageParam('forum', $__vars['forum']);
	$__finalCompiled .= '

	';
	if ($__vars['thread']) {
		$__finalCompiled .= '
		';
		$__templater->setPageParam('searchConstraints', array('Threads' => array('search_type' => 'post', ), 'This forum' => array('search_type' => 'post', 'c' => array('nodes' => array($__vars['forum']['node_id'], ), 'child_nodes' => 1, ), ), 'This thread' => array('search_type' => 'post', 'c' => array('thread' => $__vars['thread']['thread_id'], ), ), ));
		$__finalCompiled .= '
	';
	} else {
		$__finalCompiled .= '
		';
		$__templater->setPageParam('searchConstraints', array('Threads' => array('search_type' => 'post', ), 'This forum' => array('search_type' => 'post', 'c' => array('nodes' => array($__vars['forum']['node_id'], ), 'child_nodes' => 1, ), ), ));
		$__finalCompiled .= '
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

	return $__finalCompiled;
}
);