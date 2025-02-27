<?php
// FROM HASH: 6604742db07b99b1c338661173c52131
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<hr class="formRowSep" />

' . $__templater->callMacro(null, 'helper_callback_fields::callback_row', array(
		'label' => 'PHP callback',
		'explain' => 'Specify a PHP callback here that can be used to render your widget.<br />
<br />
Callback arguments:
<ol>
	<li><code>\\XF\\Widget\\AbstractWidget $widget</code><br />This widget. From this you can access the <code>WidgetConfig</code> object and the <code>\\XF\\App</code> object in order to fetch data and render a template by returning the <code>$widget->renderer()</code> object.</li>
</ol>',
		'className' => 'options[callback_class]',
		'classValue' => $__vars['options']['callback_class'],
		'methodName' => 'options[callback_method]',
		'methodValue' => $__vars['options']['callback_method'],
	), $__vars);
	return $__finalCompiled;
}
);