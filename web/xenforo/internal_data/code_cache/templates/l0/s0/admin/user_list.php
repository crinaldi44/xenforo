<?php
// FROM HASH: 14106238c8dd52d9fb8f26a34e15c866
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Users');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('Export user list', array(
		'href' => $__templater->func('link', array('users/list-export', null, array('export' => 1, 'criteria' => $__vars['criteria'], 'order' => $__vars['order'], 'direction' => $__vars['direction'], ), ), false),
		'fa' => 'fa-file-export',
		'title' => 'Export a CSV list of all users that match the current search parameters.',
		'data-xf-init' => '_tooltip',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['users'], 'empty', array())) {
		$__finalCompiled .= '
	';
		$__compilerTemp1 = '';
		if (!$__vars['showingAll']) {
			$__compilerTemp1 .= '
			<div class="block-outer">
				<div class="block-outer-main">
					' . $__templater->button('
						' . 'Sort by' . $__vars['xf']['language']['label_separator'] . ' ' . ($__templater->escape($__vars['sortOptions'][$__vars['order']]) ?: 'Username') . '
					', array(
				'class' => 'button--link menuTrigger',
				'data-xf-click' => 'menu',
				'aria-expanded' => 'false',
				'aria-haspopup' => 'true',
			), '', array(
			)) . '

					<div class="menu" data-menu="menu" aria-hidden="true">
						<div class="menu-content">
							<h3 class="menu-header">' . 'Sort by' . $__vars['xf']['language']['ellipsis'] . '</h3>
							';
			if ($__templater->isTraversable($__vars['sortOptions'])) {
				foreach ($__vars['sortOptions'] AS $__vars['sortKey'] => $__vars['sortName']) {
					$__compilerTemp1 .= '
								<a href="' . $__templater->func('link', array('users/list', null, array('criteria' => $__vars['criteria'], 'order' => $__vars['sortKey'], ), ), true) . '"
									class="menu-linkRow ' . (($__vars['order'] == $__vars['sortKey']) ? 'is-selected' : '') . '">
									' . $__templater->escape($__vars['sortName']) . '
								</a>
							';
				}
			}
			$__compilerTemp1 .= '
						</div>
					</div>
				</div>
				' . $__templater->callMacro(null, 'filter_macros::quick_filter', array(
				'key' => 'users',
				'ajax' => $__templater->func('link', array('users/list', null, array('criteria' => $__vars['criteria'], 'order' => $__vars['order'], 'direction' => $__vars['direction'], ), ), false),
				'class' => 'block-outer-opposite',
			), $__vars) . '
			</div>
		';
		}
		$__compilerTemp2 = '';
		if ($__vars['showingAll']) {
			$__compilerTemp2 .= '
						';
			$__compilerTemp3 = array();
			if ($__vars['showingAll']) {
				$__compilerTemp3[] = array(
					'colspan' => '4',
					'_type' => 'cell',
					'html' => '
									' . $__templater->formCheckBox(array(
					'standalone' => 'true',
				), array(array(
					'value' => $__vars['user']['user_id'],
					'check-all' => '.dataList >',
					'label' => 'Select all',
					'_type' => 'option',
				))) . '
								',
				);
			}
			$__compilerTemp2 .= $__templater->dataRow(array(
				'rowtype' => 'header',
				'rowclass' => 'dataList-row--noHover',
			), $__compilerTemp3) . '
					';
		}
		$__compilerTemp4 = '';
		if ($__templater->isTraversable($__vars['users'])) {
			foreach ($__vars['users'] AS $__vars['user']) {
				$__compilerTemp4 .= '
						';
				$__compilerTemp5 = array();
				if ($__vars['showingAll']) {
					$__compilerTemp5[] = array(
						'name' => 'user_ids[]',
						'value' => $__vars['user']['user_id'],
						'selected' => true,
						'_type' => 'toggle',
						'html' => '',
					);
				}
				$__compilerTemp5[] = array(
					'class' => 'dataList-cell--min dataList-cell--image dataList-cell--imageSmall',
					'href' => $__templater->func('link', array('users/edit', $__vars['user'], ), false),
					'_type' => 'cell',
					'html' => '
								' . $__templater->func('avatar', array($__vars['user'], 's', false, array(
					'href' => '',
				))) . '
							',
				);
				$__compilerTemp5[] = array(
					'href' => $__templater->func('link', array('users/edit', $__vars['user'], ), false),
					'label' => $__templater->func('username_link', array($__vars['user'], true, array(
					'notooltip' => 'true',
					'href' => '',
				))),
					'hint' => $__templater->filter($__vars['user']['email'], array(array('email_display', array()),), true),
					'_type' => 'main',
					'html' => '',
				);
				$__compilerTemp5[] = array(
					'href' => $__templater->func('link', array('users/delete', $__vars['user'], ), false),
					'_type' => 'delete',
					'html' => '',
				);
				$__compilerTemp4 .= $__templater->dataRow(array(
					'rowclass' => (((($__vars['user']['user_state'] != 'valid') OR $__vars['user']['is_banned'])) ? 'dataList-row--deleted' : ''),
				), $__compilerTemp5) . '
					';
			}
		}
		$__compilerTemp6 = '';
		if ($__vars['filter'] AND ($__vars['total'] > $__vars['perPage'])) {
			$__compilerTemp6 .= '
						' . $__templater->dataRow(array(
				'rowclass' => 'dataList-row--note dataList-row--noHover js-filterForceShow',
			), array(array(
				'colspan' => '3',
				'_type' => 'cell',
				'html' => 'There are more records matching your filter. Please be more specific.' . '
							',
			))) . '
					';
		}
		$__compilerTemp7 = '';
		if ($__vars['showAll']) {
			$__compilerTemp7 .= '
					<span class="block-footer-controls"><a href="' . $__templater->func('link', array('users/list', null, array('criteria' => $__vars['criteria'], 'all' => true, ), ), true) . '">' . 'Show all matches' . '</a></span>
				';
		} else if ($__vars['showingAll']) {
			$__compilerTemp7 .= '
					<span class="block-footer-select">' . $__templater->formCheckBox(array(
				'standalone' => 'true',
			), array(array(
				'check-all' => '.dataList',
				'label' => 'Select all',
				'_type' => 'option',
			))) . '</span>
					<span class="block-footer-controls">' . $__templater->button('Batch update', array(
				'type' => 'submit',
			), '', array(
			)) . '</span>
				';
		}
		$__finalCompiled .= $__templater->form('
		' . $__compilerTemp1 . '
		<div class="block-container">
			<div class="block-body">
				' . $__templater->dataList('
					' . $__compilerTemp2 . '
					' . $__compilerTemp4 . '
					' . $__compilerTemp6 . '
				', array(
		)) . '
			</div>
			<div class="block-footer block-footer--split">
				<span class="block-footer-counter">' . $__templater->func('display_totals', array($__vars['users'], $__vars['total'], ), true) . '</span>
				' . $__compilerTemp7 . '
			</div>
		</div>

		' . $__templater->func('page_nav', array(array(
			'page' => $__vars['page'],
			'total' => $__vars['total'],
			'link' => 'users/list',
			'params' => array('criteria' => $__vars['criteria'], 'order' => $__vars['order'], 'direction' => $__vars['direction'], ),
			'wrapperclass' => 'js-filterHide block-outer block-outer--after',
			'perPage' => $__vars['perPage'],
		))) . '
	', array(
			'action' => $__templater->func('link', array('users/batch-update/confirm', ), false),
			'class' => 'block',
		)) . '
';
	} else {
		$__finalCompiled .= '
	<div class="blockMessage">' . 'No records matched.' . '</div>
';
	}
	return $__finalCompiled;
}
);