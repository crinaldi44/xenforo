<?php
// FROM HASH: a16e1e56ad0981f8af24255750a7c307
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// ################################## BLOCK STATUS MESSAGES ##############################

.blockStatus
{
	.xf-contentAltBase();
	.xf-blockBorder();
	border-left: @xf-borderSizeFeature solid @xf-borderColorAttention;
	border-radius: @xf-blockBorderRadius;
	margin: 0;
	padding: @xf-paddingMedium 0;
	font-size: @xf-fontSizeSmall;
	text-align: left;

	//.m-transition(border, margin;); // edgeSpacerRemoval

	> dt
	{
		display: none;
	}

	&.blockStatus--info
	{
		border-left-color: @xf-borderColorFeature;
	}

	&.blockStatus--simple
	{
		.xf-blockBorder();
	}

	&.blockStatus--standalone
	{
		margin-bottom: (@xf-elementSpacer / 2);
	}
}

.blockStatus-message
{
	display: block;
	padding: 0 @xf-paddingMedium;
	margin: .2em 0 0;

	&:first-of-type
	{
		margin-top: 0;
	}

	&:before
	{
		.m-faBase();
		display: inline-block;
		min-width: .8em;
		color: @xf-textColorAttention;
	}

	&--deleted::before { .m-faContent("@{fa-var-trash}\\20"); }
	&--locked::before { .m-faContent("@{fa-var-lock}\\20"); }
	&--moderated::before { .m-faContent("@{fa-var-shield}\\20"); }
	&--warning:before { .m-faContent("@{fa-var-exclamation-triangle}\\20"); }
	&--ignored:before { .m-faContent("@{fa-var-microphone-slash}\\20"); }
}';
	return $__finalCompiled;
}
);