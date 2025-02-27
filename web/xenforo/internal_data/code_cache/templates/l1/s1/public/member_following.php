<?php
// FROM HASH: 223b25ff57a235be6bf87d06dbbf1751
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Members ' . $__templater->escape($__vars['user']['username']) . ' is following');
	$__finalCompiled .= '

';
	$__templater->setPageParam('head.' . 'metaNoindex', $__templater->preEscaped('<meta name="robots" content="noindex" />'));
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped($__templater->escape($__vars['user']['username'])), $__templater->func('link', array('members', $__vars['user'], ), false), array(
	));
	$__finalCompiled .= '

<div class="block">
	<div class="block-container js-followingList' . $__templater->escape($__vars['user']['user_id']) . '">
		<ol class="block-body">
			';
	if ($__templater->isTraversable($__vars['following'])) {
		foreach ($__vars['following'] AS $__vars['followingUser']) {
			$__finalCompiled .= '
				<li class="block-row block-row--separated">
					' . $__templater->callMacro(null, 'member_list_macros::item', array(
				'user' => $__vars['followingUser'],
			), $__vars) . '
				</li>
			';
		}
	}
	$__finalCompiled .= '
		</ol>
		';
	if ($__vars['hasMore']) {
		$__finalCompiled .= '
			<div class="block-footer">
				<span class="block-footer-controls">' . $__templater->button('
					' . 'More' . $__vars['xf']['language']['ellipsis'] . '
				', array(
			'href' => $__templater->func('link', array('members/following', $__vars['user'], array('page' => $__vars['page'] + 1, ), ), false),
			'rel' => 'nofollow',
			'data-xf-click' => 'inserter',
			'data-replace' => '.js-followingList' . $__vars['user']['user_id'],
			'data-scroll-target' => '< .overlay',
		), '', array(
		)) . '</span>
			</div>
		';
	}
	$__finalCompiled .= '
	</div>
</div>';
	return $__finalCompiled;
}
);