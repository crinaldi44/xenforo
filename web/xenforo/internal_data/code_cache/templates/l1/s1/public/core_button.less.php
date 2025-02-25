<?php
// FROM HASH: 50ace7b77029d1d3c4c97ff429e4ba32
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// ############################ BUTTONS #################

.button,
a.button // needed for specificity over a:link
{
	.m-buttonBase();

	a
	{
		color: inherit;
		text-decoration: none;
	}

	.xf-buttonDefault();
	.m-buttonBlockColorVariationSimple(xf-default(@xf-buttonDefault--background-color, transparent));

	&.button--primary
	{
		.xf-buttonPrimary();
		.m-buttonBlockColorVariationSimple(xf-default(@xf-buttonPrimary--background-color, transparent));
	}

	&.button--cta
	{
		.xf-buttonCta();
		.m-buttonBlockColorVariationSimple(xf-default(@xf-buttonCta--background-color, transparent));
	}

	&.button--link
	{
		// block colors
		background: @xf-contentBg;
		color: @xf-linkColor;
		.m-buttonBorderColorVariation(@xf-borderColor);

		&:hover,
		&:active,
		&:focus
		{
			text-decoration: none;
			background: @xf-contentHighlightBg;
		}
	}

	&.button--plain
	{
		background: none;
		color: @xf-linkColor;
		border: none;

		&:hover,
		&:active,
		&:focus
		{
			text-decoration: none;
			background: none;
		}
	}

	&.button--alt
	{
		// block colors
		background-color: @xf-paletteColor1;
		color: @xf-linkColor;
		.m-buttonBorderColorVariation(@xf-paletteColor2);

		&:hover,
		&:active,
		&:focus
		{
			background-color: @xf-paletteColor1;
			color: @xf-linkColor;
		}
	}

	&.button--longText
	{
		.m-overflowEllipsis();
		max-width: 100%;
		display: inline-block;
	}

	&.is-disabled
	{
		.xf-buttonDisabled();
		.m-buttonBorderColorVariation(xf-default(@xf-buttonDisabled--background-color, transparent));

		&:hover,
		&:active,
		&:focus
		{
			background: xf-default(@xf-buttonDisabled--background-color, transparent) !important;
		}
	}

	&.is-hidden
	{
		display: none;
	}

	&.button--scroll
	{
		background: fade(xf-default(@xf-buttonDefault--background-color, transparent), 75%);
		padding: 5px 8px;

		.m-dropShadow();
	}

	&.button--normal
	{
		font-size: @xf-fontSizeNormal;
	}

	&.button--small
	{
		font-size: @xf-fontSizeSmall;
		padding: 3px 6px;
	}

	&.button--smaller
	{
		font-size: @xf-fontSizeSmaller;
		padding: 2px 5px;
	}

	&.button--padded
	{
		padding: 7px 10px;
	}

	&.button--fullWidth
	{
		display: block;
		width: 100%;
	}

	&.button--adminStyleAsset
	{
		&.is-disabled
		{
			visibility: hidden;
		}

		&.is-modify
		{
			.m-buttonIcon(@fa-var-pencil);
		}

		&.is-revert
		{
			.m-buttonIcon(@fa-var-history);
		}
	}

	&.button--wrap
	{
		white-space: normal;
	}

	&.button--icon
	{
		> .button-text:before,
		.button-icon
		{
			.m-faBase();
		}

		> .button-text:before,
		> .fa--xf:before,
		> .fa--xf svg,
		.button-icon
		{
			font-size: 120%;
			vertical-align: .04em;
			display: inline-block;
			margin: -.255em 6px -.255em 0;
		}

		> .fa--xf
		{
			// helps fix a button alignment issue (Chrome only)
			line-height: inherit;
		}

		.button-icon
		{
			height: 1em;
			vertical-align: 0;
		}

		&.button--iconOnly
		{
			> .button-text:before,
			> i.fa--xf:before,
			> i.fa--xf svg,
			.button-icon
			{
				margin-left: 0;
				margin-right: 0;
			}
		}

		&--add          { .m-buttonIconWidth(.88em); }
		&--confirm      { .m-buttonIconWidth(1em); }
		&--write	    { .m-buttonIconWidth(1.13em); }
		&--import  	    { .m-buttonIconWidth(1.13em); }
		&--export  	    { .m-buttonIconWidth( 1.13em); }
		&--download	    { .m-buttonIconWidth(1.13em); }
		&--redirect	    { .m-buttonIconWidth(1em); }
		&--disable      { .m-buttonIconWidth(1em); }
		&--edit         { .m-buttonIconWidth(1.13em); }
		&--save         { .m-buttonIconWidth(.88em); }
		&--reply	    { .m-buttonIconWidth(1.13em); }
		&--quote	    { .m-buttonIconWidth(1.13em); }
		&--purchase	    { .m-buttonIconWidth(1.13em); }
		&--payment	    { .m-buttonIconWidth(1.13em); }
		&--convert	    { .m-buttonIconWidth(.75em); }
		&--search	    { .m-buttonIconWidth(1em); }
		&--sort         { .m-buttonIconWidth(.63em); }
		&--upload	    { .m-buttonIconWidth(1.13em); }
		&--attach	    { .m-buttonIconWidth(1em); }
		&--login {
			.m-buttonIconWidth(.88em);
		}
		&--rate         { .m-buttonIconWidth(1.13em); }
		&--config       { .m-buttonIconWidth(1em); }
		&--refresh      { .m-buttonIconWidth(1em); }
		&--translate    { .m-buttonIconWidth(.97em); }
		&--vote         { .m-buttonIconWidth(1em); }
		&--result       { .m-buttonIconWidth(1em); }
		&--history	    { .m-buttonIconWidth(1em); }
		&--cancel       { .m-buttonIconWidth(1em); }
		&--close        { .m-buttonIconWidth(.69em); }
		&--preview      { .m-buttonIconWidth(1.13em); }
		&--conversation { .m-buttonIconWidth(1.13em); }
		&--bolt         { .m-buttonIconWidth(.75em); }
		&--list         { .m-buttonIconWidth(1em); }
		&--prev			{ .m-buttonIconWidth(.63em); }
		&--next			{ .m-buttonIconWidth(.63em); }
		&--markRead     { .m-buttonIconWidth(.88em); }
		&--user         { .m-buttonIconWidth(.88em); }
		&--userCircle   { .m-buttonIconWidth(.97em); }

		&--notificationsOn  { .m-buttonIconWidth(1.25em); } // actually only .88em, but as we use this as a toggle, make it the same width as bell-slash
		&--notificationsOff { .m-buttonIconWidth(1.25em); }

		&--show			{ .m-buttonIconWidth(1.25em) } // actually only 1.13em, but it\'s a toggle
		&--hide			{ .m-buttonIconWidth(1.25em) }

		// for inline mod confirmations
		&--merge { .m-buttonIconWidth(.88em); }
		&--move { .m-buttonIconWidth(1.13em); }
		&--copy { .m-buttonIconWidth(.88em); }
		&--approve, &--unapprove { .m-buttonIconWidth(1em); }
		&--delete, &--undelete { .m-buttonIconWidth(.88em); }
		&--stick, &--unstick { .m-buttonIconWidth(.75em); }
		&--lock { .m-buttonIconWidth(.88em); }
		&--unlock { .m-buttonIconWidth(.88em); }

		&--bookmark
		{
			.m-buttonIcon(@fa-var-bookmark);

			&.is-bookmarked
			{
				.m-buttonIcon(@fa-var-solid-bookmark);
				color: @xf-textColorAttention;
			}
		}
	}

	&.button--provider
	{
		> .button-text:before,
		.button-icon
		{
			.m-faBase(\'Brands\');
			font-size: 120%;
			vertical-align: middle;
			display: inline-block;
			margin: -4px 6px -4px 0;
		}

		.button-icon
		{
			height: 1em;
			vertical-align: 0;
		}

		img.button-icon
		{
			aspect-ratio: 1 / 1;
		}

		&--facebook
		{
			.m-buttonColorVariation(#3B5998, white);
		}

		&--twitter
		{
			.m-buttonColorVariation(#1DA1F3, white);
		}

		&--google
		{
			.m-buttonColorVariation(white, #444);
			border-color: #e9e9e9;

			> .button-text:before
			{
				display: none;
			}
		}

		&--github
		{
			.m-buttonColorVariation(#666666, white);
		}

		&--linkedin
		{
			.m-buttonColorVariation(#0077b5, white);
		}

		&--microsoft
		{
			.m-buttonColorVariation(#00bcf2, white);
		}

		&--yahoo
		{
			.m-buttonColorVariation(#410093, white);
		}

		&--apple
		{
			.m-buttonColorVariation(black, white);
			.m-buttonIcon(@fa-var-apple, .88em);
		}

		&--passkey
		{
			svg
			{
				font-size: 120%;
				vertical-align: .04em;
				display: inline-block;
				margin: -0.255em 0px -0.255em 0;
			}
		}
	}

	&.button--splitTrigger
	{
		// button-text and button-menu are always children of button--splitTrigger
		// but are defined here for reasons of specificity, as these border colors
		// are overwritten by .m-buttonBorderColorVariation()
		> .button-text { border-right: @xf-borderSize solid transparent; }
		> .button-menu { border-left: @xf-borderSize solid transparent; }

		.m-clearFix();
		padding: 0;
		font-size: 0;
		display: inline-block;

		button.button-text
		{
			background: transparent;
			border: none;
			border-right: @xf-borderSize solid transparent;
			color: inherit;
		}

		> .button-text,
		> .button-menu
		{
			.xf-buttonBase();
			display: inline-block;

			&:hover
			{
				&:after
				{
					opacity: 1;
				}
			}
		}

		> .button-text
		{
			.m-borderRightRadius(0);
		}

		> .button-menu
		{
			.m-borderLeftRadius(0);
			padding-right: xf-default(@xf-buttonBase--padding-right, 0);// * (2/3);
			padding-left: xf-default(@xf-buttonBase--padding-left, 0);// * (2/3);

			&:after
			{
				.m-menuGadget(); // .58em
				opacity: .5;
			}
		}
	}
}

.buttonGroup
{
	display: inline-block;
	vertical-align: top;
	.m-clearFix();

	&.buttonGroup--aligned
	{
		vertical-align: middle;
	}

	> .button
	{
		float: left;

		&:not(:first-child)
		{
			border-left: none;
		}

		&:not(:first-child):not(:last-child)
		{
			border-radius: 0;
		}

		&:first-child:not(:last-child)
		{
			.m-borderRightRadius(0);
		}

		&:last-child:not(:first-child)
		{
			.m-borderLeftRadius(0);
		}
	}

	> .buttonGroup-buttonWrapper
	{
		float: left;

		&:not(:first-child) > .button
		{
			border-left: none;
		}

		&:not(:first-child):not(:last-child) > .button
		{
			border-radius: 0;
		}

		&:first-child:not(:last-child) > .button
		{
			.m-borderRightRadius(0);
		}

		&:last-child:not(:first-child) > .button
		{
			.m-borderLeftRadius(0);
		}
	}
}

.toggleButton
{
	> input
	{
		display: none;
	}

	> span
	{
		.xf-buttonDisabled();
		.m-buttonBorderColorVariation(xf-default(@xf-buttonDisabled--background-color, transparent));
	}

	&.toggleButton--small > span
	{
		font-size: @xf-fontSizeSmaller;
		padding: @xf-paddingSmall;
	}

	> input:checked + span
	{
		.xf-buttonDefault();
		.m-buttonBlockColorVariationSimple(xf-default(@xf-buttonDefault--background-color, transparent));
	}
}

.u-scrollButtons
{
	position: fixed;
	bottom: 30px;
	right: (@xf-pageEdgeSpacer / 2);

	.has-hiddenscroll &
	{
		right: 20px;
	}

	z-index: @zIndex-9;

	.m-transition(opacity; @xf-animationSpeed);
	opacity: 0;
	display: none;

	&.is-transitioning
	{
		display: block;
	}

	&.is-active
	{
		display: block;
		opacity: 1;
	}

	.button
	{
		display: block;

		+ .button
		{
			margin-top: (@xf-pageEdgeSpacer / 2);
		}
	}
}

.u-navButtons
{
	position: fixed;
	bottom: 30px;
	left: (@xf-pageEdgeSpacer) / 2;

	.has-hiddenscroll &
	{
		left: 20px;
	}

	z-index: @zIndex-9;

	.m-transition(opacity; @xf-animationSpeed);
	opacity: 0;
	display: none;

	&.is-transitioning
	{
		display: block;
	}

	&.is-active
	{
		display: block;
		opacity: 1;
	}

	.button
	{
		display: block;

		+ .button
		{
			margin-top: (@xf-pageEdgeSpacer) / 2;
		}
	}
}
';
	return $__finalCompiled;
}
);