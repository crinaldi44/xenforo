<?php
// FROM HASH: 6def30b56db98d350f18ed245136cdb2
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// ###################################### INPUTS ##########################

@_input-numberWidth: 150px;
@_input-numberNarrowWidth: 90px;
@_input-dateInputWidth: 220px;
@_input-textColor: xf-default(@xf-input--color, @xf-textColor);
@_input-elementSpacer: @xf-paddingMedium;
@_input-checkBoxSpacer: 1.5em;

.m-inputReadOnly()
{
	color: mix(xf-default(@xf-input--color, @xf-textColor), xf-default(@xf-inputDisabled--color, @xf-textColorMuted));
	background: mix(xf-default(@xf-input--background-color, @xf-contentBg), xf-default(@xf-inputDisabled--background-color, @xf-paletteNeutral1));
}

:root
{
	--input-border-heavy: darken(@xf-borderColor, 4%);
	--input-border-light: lighten(@xf-borderColor, 4%);
}

.input:focus,
.input.is-focused,
.inputGroup:focus-within,
#XF .fr-box.fr-basic.is-focused,
.codeEditor.CodeMirror.CodeMirror-focused,
.input.tagify--focus
{
	--input-border-heavy: darken(@xf-borderColorHighlight, 5%);
	--input-border-light: lighten(@xf-borderColorHighlight, 3%);
}

.input
{
	.xf-input();
	display: inline-flex;
	align-items: center;
	justify-content: flex-start;
	width: 100%;
	vertical-align: top;
	line-height: @xf-lineHeightDefault;
	text-align: left; // this will be flipped in RTL
	word-wrap: break-word;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	.m-transition();
	.m-placeholder({color: fade(@_input-textColor, 40%); });

	&:focus,
	&.is-focused
	{
		outline: 0;
		.xf-inputFocus();
		.m-placeholder({color: fade(@_input-textColor, 50%); });
	}

	&[readonly],
	&.is-readonly
	{
		.m-inputReadOnly();
	}

	&[disabled]
	{
		.xf-inputDisabled();
	}

	&[type=number],
	&.input--number
	{
		text-align: right;
		max-width: @_input-numberWidth;

		&.input--numberNarrow
		{
			width: @_input-numberNarrowWidth;
		}
	}

	&.input--date,
	&.input--datetime-local,
	&.input--time
	{
		height: 2.4em;
		max-width: @_input-dateInputWidth;
		position: relative;

		&::-webkit-calendar-picker-indicator
		{
			right: @xf-paddingMedium;
			position: absolute;
		}
	}

	&.input--flipped
	{
		text-align: right;
	}

	textarea&
	{
		min-height: 0;
		max-height: 400px;
		max-height: 75vh;
		resize: vertical;

		&.input--fitHeight
		{
			height: auto;
			resize: none;

			&.input--fitHeight--short
			{
				max-height: 200px;
				max-height: 35vh;
			}
		}

		&.input--code
		{
			overflow-x: auto;
			-ltr-rtl-text-align: left; // force blocks of code back to left align
		}

		&.input--maxHeight-300px
		{
			max-height: 300px;
		}

		.has-js &[rows="1"][data-single-line]
		{
			overflow: hidden;
			resize: none;
		}
	}

	// this makes select inputs consistent across all browsers and OSes
	select&,
	&.input--select
	{
		padding-right: 1em !important;
		background-size: 1em !important;
		background-repeat: no-repeat !important;
		-ltr-background-position: 100% !important;
		white-space: nowrap;
		word-wrap: normal;
		-webkit-appearance: none !important;
		-moz-appearance: none !important;
		appearance: none !important;

		.m-selectGadgetColor(' . $__templater->func('property_variation', array('input--color', 'default', $__templater->func('property_variation', array('textColor', 'default', ), false), ), true) . ');

		';
	if ($__templater->method($__vars['xf']['style'], 'hasAlternateStyleTypeVariation', array())) {
		$__finalCompiled .= '
			.m-colorScheme(' . $__templater->escape($__templater->method($__vars['xf']['style'], 'getAlternateStyleType', array())) . ', {
				.m-selectGadgetColor(' . $__templater->func('property_variation', array('input--color', $__templater->method($__vars['xf']['style'], 'getAlternateStyleTypeVariation', array()), $__templater->func('property_variation', array('textColor', $__templater->method($__vars['xf']['style'], 'getAlternateStyleTypeVariation', array()), ), false), ), true) . ');
			});
		';
	}
	$__finalCompiled .= '

		overflow-x: hidden; // iOS seems to require this to prevent overflow with long options...
		overflow-y: auto; // ...and Firefox seems to require this to prevent the above from breaking vertical scroll...

		&[disabled]
		{
			.m-selectGadgetColor(' . $__templater->func('property_variation', array('inputDisabled--color', 'default', $__templater->func('property_variation', array('textColor', 'default', ), false), ), true) . ');

			';
	if ($__templater->method($__vars['xf']['style'], 'hasAlternateStyleTypeVariation', array())) {
		$__finalCompiled .= '
				.m-colorScheme(' . $__templater->escape($__templater->method($__vars['xf']['style'], 'getAlternateStyleType', array())) . ', {
					.m-selectGadgetColor(' . $__templater->func('property_variation', array('inputDisabled--color', $__templater->method($__vars['xf']['style'], 'getAlternateStyleTypeVariation', array()), $__templater->func('property_variation', array('textColor', $__templater->method($__vars['xf']['style'], 'getAlternateStyleTypeVariation', array()), ), false), ), true) . ');
				});
			';
	}
	$__finalCompiled .= '
		}

		&[size],
		&[multiple]
		{
			background-image: none !important;
			padding-right: xf-default(@xf-input--padding, 5px) !important;
		}

		&[multiple]
		{
			height: initial;
		}
	}

	&.input--autoSize
	{
		width: auto;
	}

	&.input--inline
	{
		display: inline;
		width: auto;

		&.input--time
		{
			width: 110px;
		}
	}

	&.input--block
	{
		display: block;
	}

	&.input--code
	{
		font-family: @xf-fontFamilyCode;
		direction: ltr;
		//white-space: nowrap;
		word-wrap: normal;
	}

	&.input--title
	{
		font-size: @xf-fontSizeLargest;
	}

	&.input--avatarSizeS
	{
		min-height: @avatar-s;
	}

	&.input--passwordHideShow
	{
		::-ms-reveal,
		::-ms-clear
		{
			display: none !important;
		}
	}

	.m-inputZoomFix();

	.fa--inputOverlay + &
	{
		padding-left: 1.7em;
	}
}

// Overlay a FontAwesome icon over the start of a text box as a hint to its use
// Use the \'fa\' attribute in XF template syntax for xf:textbox, xf:numberbox and xf:textarea
.fa--xf.fa--inputOverlay
{
	position: absolute;
	padding: (xf-default(@xf-input--padding, 0) + 2) xf-default(@xf-input--padding, 0) xf-default(@xf-input--padding, 0);
	line-height: @xf-lineHeightDefault;
	color: @xf-input--border-top-color;

	//& + .input
	//{
	//	padding-left: xf-default(@xf-input--padding, 0) * 2 + xf-default(@xf-input--font-size, @xf-fontSizeNormal);
	//}
}

// ############################# NEW ICONIC CONTROLS ######################

@controlColor: xf-default(@xf-buttonPrimary--background-color, @xf-paletteColor4);
@controlColor--hover: xf-intensify(@controlColor, 25%);

.iconicIcon(@setPosition: true)
{
	.m-iconicIcon(@setPosition);
}

.iconic
{
	display: inline-block;
	position: relative;
	max-width: 100%;

	> input
	{
		.m-visuallyHidden();
		position: absolute;
		left: 0;
		width: auto;
		height: auto;

		+ i
		{
			.m-iconicIcon();
		}

		& + i:after
		{
			opacity: 0;
		}

		&:disabled + i:before,
		&[readonly] + i:before
		{
			opacity: .3;
		}

		&:disabled:checked + i:after,
		&[readonly]:checked + i:after
		{
			opacity: .3;
		}

		&:checked
		{
			& + i:before
			{
				opacity: 0;
			}

			& + i:after
			{
				opacity: 1;
			}
		}

		&:focus + i
		{
			&:before,
			&:after
			{
				outline: Highlight solid 2px;
				-moz-outline-radius: 5px;

				@media (-webkit-min-device-pixel-ratio: 0)
				{
					outline: -webkit-focus-ring-color auto 5px;
				}
			}
		}
	}

	// handler for labelled inputs - indent the text away from the control
	.iconic-label:before
	{
		content: \'\';
		display: inline-block;
		width: (@_input-checkBoxSpacer - 1em); // min-width of input > i
	}

	&.iconic--hideShow
	{
		min-width: 56px;
		cursor: pointer;

		> input[type=checkbox] + i
		{
			&:before
			{
				.m-faContent(@fa-var-eye);
			}

			&:after
			{
				.m-faContent(@fa-var-eye-slash);
			}
		}

		.iconic-label
		{
			font-size: @xf-fontSizeSmall;
			vertical-align: text-top;
		}
	}

	&.iconic--hiddenLabel .iconic-label:before
	{
		display: none;
	}

	> input[type=checkbox] + i
	{
		&:before { .m-faContent(@fa-var-regular-square, .88em); }
		&:after  { .m-faContent(@fa-var-regular-check-square, .88em); }
	}

	> input[type=radio] + i
	{
		&:before { .m-faContent(@fa-var-regular-circle, 1em); }
		&:after  { .m-faContent(@fa-var-regular-check-circle, 1em); }
	}

	&.iconic--toggle > input[type=checkbox] + i
	{
		&:before { .m-faContent(@fa-var-toggle-off, 1em); }
		&:after  { .m-faContent(@fa-var-toggle-on, 1em); }
	}
}

// Fix position for inputChoices to allow nested indenting


.inputChoices > .inputChoices-choice
{
	position: relative;

	.iconic
	{
		position: static;

		> input + i
		{
			position: absolute;
			left: 0;
		}

		&.iconic--noLabel
		{
			display: inline;
		}
	}

	// undo the normal indenting of text from checkbox
	.iconic-label:before {
		display: none;
	}
}

// Basic control colours for common scenarios

.formRow,
.inputGroup,
.inputChoices,
.block-footer,
.dataList-cell,
.message-cell--extra
{
	.iconic,
	&.dataList-cell--fa > a
	{
		> i, svg
		{
			color: @controlColor;
			fill: currentColor;
		}

		&:hover > i,
		&:hover svg
		{
			color: @controlColor--hover;
			fill: currentColor;
		}
	}
}

// ############################# END ICONIC CONTROLS ######################

.u-inputSpacer
{
	margin-top: @_input-elementSpacer;
}

.inputGroup
{
	display: flex;
	align-items: stretch;
	max-width: 100%;

	.inputGroup-text
	{
		flex-grow: 0;
		display: flex;
		align-items: center;

		white-space: nowrap;
		vertical-align: middle;
		padding: 0 @xf-paddingMedium;

		&:first-child { padding-left: 0; }
		&:last-child { padding-right: 0; }
	}

	.inputGroup-splitter
	{
		display: inline-block;
		width: @_form-elementSpacer;
		flex-shrink: 0;
	}

	.input
	{
		flex-shrink: 1;
		min-width: 0; // firefox bug - https://bugzilla.mozilla.org/show_bug.cgi?id=1021913
	}

	.button
	{
		flex-shrink: 0;
	}

	&:not(.inputGroup--joined)
	{
		.input,
		.button
		{
			+ .input,
			+ .button
			{
				margin-left: @_form-elementSpacer;
			}
		}
	}

	.inputGroup-label
	{
		flex-shrink: 1;
		width: 100%;
		padding: 0 0 @xf-paddingMedium;

		.m-appendColon();
	}

	@media (max-width: @xf-formResponsive)
	{
		.input:not(.input--autoSize):not(.input--numberNarrow)
		{
			width: 100%;
		}
	}

	&.inputGroup--inline
	{
		display: inline-flex;
	}

	&.inputGroup--auto
	{
		.input
		{
			width: auto;
		}
	}

	&.inputGroup--grow
	{
		> .inputGroup,
		> .inputChoices
		{
			flex: 1;
		}
	}

	&.inputGroup--joined
	{
		.input
		{
			border-radius: 0;

			&:first-child
			{
				border-top-left-radius: @xf-borderRadiusMedium;
				border-bottom-left-radius: @xf-borderRadiusMedium;
				border-right: none;
			}

			&:last-child
			{
				border-top-right-radius: @xf-borderRadiusMedium;
				border-bottom-right-radius: @xf-borderRadiusMedium;
				border-left: none;
			}
		}

		.inputGroup-text
		{
			.xf-input(border);
			.xf-input(background);
			text-align: center;
			padding: @xf-paddingSmall @xf-paddingMedium;

			&.inputGroup-text--disabled,
			&.is-disabled,
			&[disabled]
			{
				.xf-inputDisabled();

				a { text-decoration: none; }
			}

			&:first-child
			{
				border-right: 0;
				border-top-left-radius: @xf-borderRadiusMedium;
				border-bottom-left-radius: @xf-borderRadiusMedium;
			}

			&:last-child
			{
				border-left: 0;
				border-top-right-radius: @xf-borderRadiusMedium;
				border-bottom-right-radius: @xf-borderRadiusMedium;
			}
		}

		.input + .inputGroup-text,
		.input + .input,
		.inputGroup-text + .input
		{
			border-left: @xf-borderSize solid var(--input-border-light);
		}

		.inputGroup-text + .inputGroup-text,
		.inputGroup-text + select.input
		{
			border-left: 0;
		}
	}
}

.inputGroup-container > .inputGroup
{
	margin-top: @xf-paddingMedium;

	&:first-child
	{
		margin-top: 0;
	}
}

.inputNumber
{
	.input--number
	{
		-moz-appearance: textfield !important;

		&::-webkit-inner-spin-button,
		&::-webkit-outer-spin-button
		{
			margin: 0 !important;
			-webkit-appearance: none !important;
		}

		@media (max-width: @xf-formResponsive)
		{
			min-width: auto;
			max-width: 120px;
		}
	}
}

.inputNumber-button
{
	position: relative;

	.m-faBase();
	color: @controlColor;
	font-size: 1.0em;
	font-style: normal !important;
	line-height: .75em;
	vertical-align: -15%;

	width: 45px;
	justify-content: center;
	text-align: center;

	cursor: pointer;

	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;

	&.inputNumber-button--smaller
	{
		vertical-align: 0;
		width: 35px;
	}

	&--up::before
	{
		.m-faContent(@fa-var-plus, .88em);
	}

	&--down::before
	{
		.m-faContent(@fa-var-minus, .88em);
	}

	.inputGroup.inputGroup--joined &
	{
		&:hover,
		&:active,
		&:focus
		{
			background-color: @xf-contentHighlightBg;
			color: @controlColor--hover;
		}
	}

	.input.input--number[readonly] ~ &
	{
		.m-inputReadOnly();
	}

	.input.input--number[disabled] ~ &
	{
		cursor: default;
		.xf-inputDisabled();
	}
}

.inputDate
{
	.inputDate-icon
	{
		position: relative;

		.m-faBase();
		color: @xf-linkColor;
		font-size: 1.0em;
		font-style: normal !important;
		line-height: .75em;
		vertical-align: -15%;

		cursor: pointer;

		width: 45px;
		justify-content: center;
		text-align: center;

		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;

		@media (max-width: @xf-formResponsive)
		{
			vertical-align: 0;
			width: 25px;
		}

		&::before
		{
			.m-faContent(@fa-var-calendar, .88em);
		};
	}
}

.inputUploadButton
{
	position: relative;

	.m-faBase();
	color: @controlColor;
	font-size: 1.0em;
	font-style: normal !important;
	line-height: .75em;
	vertical-align: -15%;

	width: 45px;
	justify-content: center;
	text-align: center;

	cursor: pointer;

	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;

	.inputGroup.inputGroup--joined &
	{
		&:hover,
		&:active,
		&:focus
		{
			background-color: saturate(xf-intensify(@xf-paletteColor1, 4%), 12%);
			color: @controlColor--hover;
		}
	}

	&:before
	{
		.m-faContent(@fa-var-upload, 1.25em);
	}

	input[type="file"]
	{
		visibility: hidden;
		position: absolute;
		width: 1px;
		height: 1px;
		overflow: hidden;
		left: -1000px;
		z-index: -1;
		opacity: 0;
	}
}

.inputList
{
	.m-listPlain();

	> li
	{
		margin-top: @xf-paddingMedium;

		&:first-child
		{
			margin-top: 0;
		}
	}
}

.inputPair
{
	.m-clearFix();

	> .input,
	.inputPair-input
	{
		float: right;
		width: 49%; // fallback
		width: ~"calc(50% - 2px)";

		&:first-child
		{
			float: left;
		}
	}
}

.inputPair-container > .inputPair
{
	margin-top: @xf-paddingMedium;

	&:first-child
	{
		margin-top: 0;
	}
}

.inputLabelPair
{
	.m-clearFix();
	margin: @xf-paddingMedium 0;
	padding: 0;

	> dt,
	> dd
	{
		float: left;
		margin: 0;
		padding: 0;
	}

	> dt
	{
		width: 65%;
		padding-right: @xf-paddingMedium;
		padding-top: .6em;

		> label
		{
			.m-appendColon();
		}
	}

	> dd
	{
		width: 35%;
		text-align: right;

		.input
		{
			width: 100%;
			max-width: none;
		}
	}

	@media (max-width: @xf-responsiveNarrow)
	{
		> dt,
		> dd
		{
			width: 50%;
		}
	}
}

.inputChoices
{
	list-style: none;
	padding: 0;
	margin: 0;

	> .inputChoices-choice
	{
		margin-bottom: @_input-elementSpacer;
		padding-left: @_input-checkBoxSpacer;

		&:last-child
		{
			margin-bottom: 0;
		}

		> .inputChoices,
		.inputChoices-spacer
		{
			margin-top: @_input-elementSpacer;
		}
	}

	&.inputChoices--expanded > .inputChoices-choice
	{
		margin-bottom: (@_input-elementSpacer * 2);

		&:last-child
		{
			margin-bottom: 0;
		}
	}

	&.inputChoices--noChoice > .inputChoices-choice,
	.inputChoices-plainChoice
	{
		padding-left: 0;
	}

	&.inputChoices--inline > .inputChoices-choice
	{
		display: inline-block;
		margin-right: @_input-elementSpacer;
		margin-bottom: 0;

		&:last-child
		{
			margin-right: 0;
		}
	}

	.inputChoices-label
	{
		padding-left: 0;
		font-size: @xf-fontSizeSmall;
		color: @xf-textColorMuted;
	}

	+ .inputChoices:not(.inputChoices--inline)
	{
		margin-top: @_input-elementSpacer;
	}
}

.inputChoices-group + .inputChoices-group,
.inputChoices-choice + .inputChoices-group
{
	margin-top: (@xf-paddingMedium * 2);
}

.inputChoices-spacer + .inputChoices
{
	margin-top: @_input-elementSpacer;
}

.inputChoices-heading
{
	color: @xf-textColorMuted;
	padding-bottom: (@xf-paddingMedium / 2);
	border-bottom: @xf-borderSize solid @xf-borderColorFaint;
	margin-bottom: @xf-paddingMedium;
	position: relative;

	&.inputChoices-heading--checkAll {
		.iconic {
			position: static;

			& > input + i {
				position: absolute;
				right: 0;
				left: auto;
				width: auto;
			}
		}
	}
}

.inputChoices-explain
{
	.m-formElementExplain();

	&.inputChoices-explain--after
	{
		margin-top: @_input-elementSpacer;
	}
}

.inputChoices-dependencies
{
	list-style: none;
	padding: 0;
	margin: 0;

	> li
	{
		margin-top: @_input-elementSpacer;

		> label
		{
			display: block;
			padding: @xf-paddingSmall 0;

			&.iconic--labelled > input + i
			{
				margin-left: 0;
			}
		}
	}
}

.inputValidationError
{
	margin-top: @xf-paddingMedium;
	padding: @xf-blockPaddingV @xf-blockPaddingH;
	.xf-blockBorder();
	border-radius: @xf-blockBorderRadius;
	border-left: @xf-borderSizeFeature solid @xf-errorFeatureColor;
	background: @xf-errorBg;
	color: @xf-errorColor;

	.m-textColoredLinks();

	.m-hiddenEl(true);

	&:empty
	{
		display: none;
	}

	> ul,
	> ol
	{
		margin-top: 0;
		margin-bottom: 0;
	}
}


@media (max-width: @xf-responsiveNarrow)
{
	.input.input--title
	{
		font-size: @xf-fontSizeLarge;
	}
}';
	return $__finalCompiled;
}
);