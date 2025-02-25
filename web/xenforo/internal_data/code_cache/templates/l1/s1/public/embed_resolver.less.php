<?php
// FROM HASH: 317f337eed034ec50352d0575c820df2
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= 'html.p-embed-container
{
	background: transparent;

	.embed
	{
		margin: 0;
		overflow: hidden;
	}
}

.embed
{
	display: flow-root;
	margin: .5em 0;
	width: 100%;
	max-width: 100%;

	border: 1px solid @xf-borderColor;
	border-radius: @xf-borderRadiusMedium;
	text-align: left;

	.m-blockAligner();

	overflow: hidden;
}

.embed-container
{
	padding: @xf-paddingMedium;

	.contentRow-header
	{
		margin: 0;
		font-weight: normal;
		.m-overflowEllipsis();
	}

	.contentRow-faderContainer
	{
		font-size: @xf-fontSizeSmaller;
		margin: .25em 0;
	}

	.contentRow-minor
	{
		font-size: @xf-fontSizeSmaller;

		.listInline
		{
			margin: 0;
		}
	}
}

.embed-cover
{
	padding: 0;
	border-bottom: 1px solid @xf-borderColor;
	overflow: hidden;
	height: 100%;

	img
	{
		display: block;
		width: 100%;
		height: 100%;
		max-height: 200px;
		object-fit: cover;
		object-position: center;
	}
}

.embed-preview
{
	padding: 0 @xf-paddingMedium;
	font-size: @xf-fontSizeSmall;
	font-style: italic;

	.bbCodeBlock
	{
		.bbCodeBlock-title,
		.bbCodeBlock-content
		{
			font-size: @xf-fontSizeSmaller;
			font-style: normal;
		}
	}
}

.embed-footer
{
	padding: @xf-paddingMedium;
	font-size: @xf-fontSizeSmaller;
	color: @xf-textColorMuted;
	//border-top: @xf-borderSize solid @xf-borderColorLight;

	.m-hiddenLinks();
	.m-clearFix();

	&:empty
	{
		display: none;
	}

	ul.listInline,
	ul.reactionSummary
	{
		margin: 0;
	}
}

.embed-footer-main { float: left; }
.embed-footer-opposite { float: right; }';
	return $__finalCompiled;
}
);