<?php
// FROM HASH: 40baab4d74a1555d75aec66b5427008b
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->callMacro(null, 'prism_macros::setup', array(), $__vars) . '

<div class="bbCodeBlock bbCodeBlock--screenLimited bbCodeBlock--code">
	<div class="bbCodeBlock-title">
		' . ($__templater->escape($__vars['config']['phrase']) ?: 'Code') . $__templater->escape($__vars['xf']['language']['label_separator']) . '
	</div>
	<div class="bbCodeBlock-content" dir="ltr">
		<pre class="bbCodeCode" dir="ltr" data-xf-init="code-block" data-lang="' . ($__templater->escape($__vars['language']) ?: '') . '"><code>' . $__templater->escape($__vars['content']) . '</code></pre>
	</div>
</div>';
	return $__finalCompiled;
}
);