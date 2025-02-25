<?php
// FROM HASH: 05821fed10770486df3c64375d3faefd
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.tagify
{
	display: inline-flex;
	align-items: flex-start;
	flex-wrap: wrap;
	padding: 0;
	line-height: 1.4;
	cursor: text;
	outline: 0;
	position: relative;
	box-sizing: border-box;

	&[disabled]
	{
		opacity: .5;
		pointer-events: none
	}
}

.tagify__input
{
	flex-grow: 1;
	display: inline-block;
	min-width: 110px;
	padding: 6px;
	line-height: 1.4;
	position: relative;
	white-space: pre-wrap;
	outline: 0;

	&:before
	{
		content: attr(data-placeholder);
		line-height: 1.4;
		margin: auto 0;
		z-index: 1;
		color: fade(@xf-input--color, 40%);
		white-space: nowrap;
		pointer-events: none;
		opacity: 0;
		position: absolute
	}

	&:after
	{
		content: attr(data-suggest);
		display: inline-block;
		vertical-align: middle;
		position: absolute;
		min-width: calc(100% - 1.5em);
		text-overflow: ellipsis;
		overflow: hidden;
		white-space: pre;
		color: @xf-input--color;
		opacity: .3;
		pointer-events: none;
		max-width: 100px
	}
}

.tagify__tag
{
	display: inline-flex;
	align-items: center;
	font-size: 15px;
	border-radius: @xf-borderRadiusMedium;

	.xf-chip();

	margin: 5px;
	padding-right: 5px;

	cursor: default;

	.avatar
	{
		padding: 2px;

		&.avatar--default
		{
			width: calc(@avatar-xxs - 4px);
			height: calc(@avatar-xxs - 4px);
			margin: 2px;
		}
	}

	[disabled] &,
	[readonly] &
	{
		> div
		{
			padding-left: 5px;
		}
	}

	> div
	{
		&:before
		{
			content: "";
			position: absolute;
			inset: var(--tag-bg-inset, 0);
			z-index: -1;
			pointer-events: none;
			transition: 120ms ease;
			animation: tags--bump .3s ease-out 1;
		}
	}
}

.tagify__tag-text
{
	vertical-align: middle;
}

.tagify__tag__removeBtn
{
	font-size: 0;
	cursor: pointer;
	margin: 0 3px;
	border-radius: @xf-borderRadiusSmall;

	[disabled] &,
	[readonly] &
	{
		display: none;
	}

	&:before
	{
		.m-faBase();
		font-size: @xf-fontSizeSmall;
		.m-faContent("@{fa-var-times}\\20");
		opacity: .5;
		.m-transition(opacity);
	}

	&:hover
	{
		color: white;
		background: @xf-errorFeatureColor;

		&:before
		{
			opacity: 1;
		}

		+ div > span
		{
			opacity: 0.6;
		}
	}
}

.tagify__dropdown
{
	position: absolute;
	z-index: 9999;
	transform: translateY(1px);
	overflow: hidden
}

.tagify__dropdown[placement=top]
{
	margin-top: 0;
	transform: translateY(-100%)
}

.tagify__dropdown[placement=top] .tagify__dropdown__wrapper
{
	border-top-width: 1.1px;
	border-bottom-width: 0
}

.tagify__dropdown[position=text]
{
	font-size: .9em
}

.tagify__dropdown[position=text] .tagify__dropdown__wrapper
{
	border-width: 1px
}

.tagify__dropdown--initial .tagify__dropdown__wrapper
{
	max-height: 20px;
	transform: translateY(-1em)
}

.tagify__dropdown--initial[placement=top] .tagify__dropdown__wrapper
{
	transform: translateY(2em)
}

.tagify__dropdown__wrapper
{
	.m-autoCompleteList();
	margin-top: 3px;
}

.tagify__dropdown__item
{
	padding: @xf-paddingMedium;
	line-height: 1.4;

	.m-clearFix();

	&.tagify__dropdown__item--active
	{
		background: @xf-contentHighlightBg;
	}
}

// display placeholders
.tagify--empty .tagify__input::before
{
	opacity: 1;
}

.tagify--loading
{
	pointer-events: none;

	.tagify__input
	{
		&:after
		{
			--loader-size: 1em;

			content: "";
			vertical-align: middle;
			opacity: 1;
			width: var(--loader-size);
			height: var(--loader-size);
			min-width: 0;
			border: 3px solid;
			border-color: xf-intensify(@xf-borderColorAttention, 20%) xf-intensify(@xf-borderColorAttention, 10%) @xf-borderColorAttention transparent;
			border-radius: 50%;
			animation: rotateLoader .4s infinite linear;
			margin: 1px 0 1px .5em
		}
	}
}

@keyframes rotateLoader
{
	to
	{
		transform: rotate(1turn)
	}
}';
	return $__finalCompiled;
}
);