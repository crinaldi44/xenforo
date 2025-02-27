<?php
// FROM HASH: 526d9d8f0f054ba3efea3d0b1d6ec600
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Connected accounts');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('Connected accounts allow you to log in to this site more easily by using an account you already hold at one of the sites below.', array(
	)) . '
			';
	$__compilerTemp1 = true;
	if ($__templater->isTraversable($__vars['providers'])) {
		foreach ($__vars['providers'] AS $__vars['provider']) {
			$__compilerTemp1 = false;
			$__finalCompiled .= '
				';
			if ($__templater->method($__vars['provider'], 'isAssociated', array($__vars['xf']['visitor'], ))) {
				$__finalCompiled .= '
					' . $__templater->callMacro(null, 'connected_account_macros::disassociate', array(
					'provider' => $__vars['provider'],
					'hasPassword' => $__vars['hasPassword'],
				), $__vars) . '
				';
			} else {
				$__finalCompiled .= '
					' . $__templater->callMacro(null, 'connected_account_macros::associate', array(
					'provider' => $__vars['provider'],
				), $__vars) . '
				';
			}
			$__finalCompiled .= '
			';
		}
	}
	if ($__compilerTemp1) {
		$__finalCompiled .= '
				<div class="block-row">' . 'There are currently no usable external account providers.' . '</div>
			';
	}
	$__finalCompiled .= '
		</div>
	</div>
</div>';
	return $__finalCompiled;
}
);