<?php
// FROM HASH: 9e9442f40bfefffef8aab2adc81c2bdf
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->includeJs(array(
		'src' => 'xf/embed.js',
		'min' => '1',
	));
	$__finalCompiled .= '

<div class="bbOembed bbMediaJustifier"
	  data-media-site-id="' . $__templater->escape($__vars['provider']) . '"
	  data-media-key="' . $__templater->escape($__vars['id']) . '"
	  data-xf-init="oembed"
	  data-provider="' . $__templater->escape($__vars['provider']) . '"
	  data-id="' . $__templater->escape($__vars['id']) . '">
	<a href="' . $__templater->escape($__vars['url']) . '" rel="external" target="_blank">' . $__templater->fontAwesome('fab fa-' . $__templater->escape($__vars['provider']) . ' fa-' . $__templater->escape($__vars['provider']) . '-square', array(
	)) . '
		' . $__templater->escape($__vars['url']) . '</a>
</div>';
	return $__finalCompiled;
}
);