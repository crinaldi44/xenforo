<?php
// FROM HASH: 7e38e27425b7eae59c5102b01d770522
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// ### SETUP

.m-colorPreview(
	@size: 32px;
	@questionMarkSize: @xf-fontSizeLargest
)
{
	width: @size;
	height: @size;
	border: @xf-borderSize dashed @xf-borderColorHeavy;
	border-radius: @xf-borderRadiusSmall;
	background: @xf-contentBg;
	overflow: hidden;

	.color-sample
	{
		display: none;
		width: 100%;
		height: 100%;
	}

	&.is-unknown
	{
		&:after
		{
			display: block;
			content: \'?\';
			color: @xf-textColorMuted;
			font-size: @questionMarkSize;
			font-weight: @xf-fontWeightHeavy;
			line-height: @size;
			text-align: center;
		}
	}

	&.is-active
	{
		border-style: solid;
		.m-checkerboardBackground(calc(@size / 2));

		.color-sample
		{
			display: block;
		}
	}
}

.m-checkerboardBackground(
	@size;
	@foreground: #C3C3C3;
	@background: #FFF;
)
{
	background: repeating-conic-gradient(@foreground 0% 25%, @background 0% 50%) 50% / @size @size;
}

// ### BOX

.colorPickerBox
{
	.m-colorPreview(22px, @xf-fontSizeLarge);
	cursor: pointer;
}

// ### MENU

.colorPicker-sliders > *,
.colorPicker-inputs > *
{
	margin-bottom: @xf-paddingMedium;

	&:last-child
	{
		margin-bottom: 0;
	}
}

.colorPicker-palette,
.colorPicker-sliders
{
	border-bottom: @xf-borderSize solid @xf-borderColor;
}

.colorPicker-palette-color,
.colorPicker-sliders,
.colorPicker-inputs
{
	padding: @xf-paddingMedium @xf-paddingLarge;
}

// ### PALETTE

.colorPicker-palette
{
	height: 250px;
	overflow: auto;
}

.colorPicker-palette-color
{
	.xf-menuLinkRow();
	display: flex;
	align-items: center;
	cursor: pointer;

	&.is-active,
	&:hover
	{
		.xf-menuLinkRowSelected();
	}

	&.is-active
	{
		font-weight: @xf-fontWeightHeavy;
	}
}

.colorPicker-palette-color-preview
{
	flex: none;
	margin-right: @xf-paddingSmall;
	.m-colorPreview();

	.colorPicker-palette-color.is-active &
	{
		border-color: @xf-borderColorFeature;
	}
}

.colorPicker-palette-color-name
{
	color: @xf-textColorMuted;
	font-size: @xf-fontSizeSmallest;
	font-weight: @xf-fontWeightNormal;
}

// ### SLIDERS

/* XF-RTL:disable */

// HSV gradients from Spectrum (https://github.com/bgrins/spectrum), MIT licensed

.colorPicker-sliders-gradient,
.colorPicker-sliders-hue,
.colorPicker-sliders-alpha
{
	width: 100%;
	border: @xf-borderSize solid @xf-borderColorHeavy;
	border-radius: @xf-borderRadiusSmall;
}

.colorPicker-sliders-gradient
{
	height: 150px;
	overflow: hidden;
}

.colorPicker-sliders-hue,
.colorPicker-sliders-alpha
{
	height: 14px;
}

.colorPicker-sliders-hue
{
	background: linear-gradient(
		to right,
		hsl(359, 100%, 50%) 0%,
		hsl(298, 100%, 50%) 17%,
		hsl(241, 100%, 50%) 33%,
		hsl(180, 100%, 50%) 50%,
		hsl(118, 100%, 50%) 67%,
		hsl(61, 100%, 50%) 83%,
		hsl(0, 100%, 50%) 100%,
	);
}

.colorPicker-sliders-alpha
{
	.m-checkerboardBackground(14px);
}

.colorPicker-sliders-gradient-grid,
.colorPicker-sliders-hue-bar,
.colorPicker-sliders-alpha-bar
{
	position: relative;
	width: 100%;
	height: 100%;
	cursor: crosshair;
}

.colorPicker-sliders-gradient-saturation,
.colorPicker-sliders-gradient-value
{
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
}

.colorPicker-sliders-gradient-saturation
{
	background-image: linear-gradient(
		to right,
		#FFF,
		rgba(204, 154, 129, 0)
	);
}

.colorPicker-sliders-gradient-value
{
	background-image: linear-gradient(
		to top,
		#000,
		rgba(204, 154, 129, 0)
	);
}

.colorPicker-sliders-gradient-indicator,
.colorPicker-sliders-hue-indicator,
.colorPicker-sliders-alpha-indicator
{
	position: absolute;
	top: 0;
	left: 0;
	border-radius: 50%;
}

.colorPicker-sliders-gradient-indicator
{
	width: 12px;
	height: 12px;
	margin-left: -6px;
	margin-top: -6px;
	border: 1px solid #FFF;
	box-shadow: 0 0 1px 1px rgba(255, 255, 255, 0.25),
		0 2px 4px 0px rgba(0, 0, 0, 0.25);
	cursor: all-scroll;
}

.colorPicker-sliders-hue-indicator,
.colorPicker-sliders-alpha-indicator
{
	width: 14px;
	height: 14px;
	margin-left: -7px;
	margin-top: -1px;
	background: hsl(200, 12%, 95%);
	box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25),
		0 2px 4px 0px rgba(0, 0, 0, 0.25);
	cursor: ew-resize;

	.m-colorScheme(dark, {
		background: hsl(225, 5%, 17%);
		box-shadow: 0 0 1px 1px rgba(255, 255, 255, 0.25),
			0 2px 4px 0px rgba(255, 255, 255, 0.25);
	})
}

/* XF-RTL:enable */

// ### FOOTER

.colorPicker-inputs-save
{
	display: flex;
	justify-content: space-between;
	align-items: center;

	> *
	{
		margin-right: @xf-paddingSmall;

		&:last-child
		{
			margin-right: 0;
		}
	}
}

.colorPicker-preview
{
	position: relative;
	height: 32px;
	width: 62px;
	overflow: hidden;
	border: @xf-borderSize solid @xf-borderColorHeavy;
	border-radius: @xf-borderRadiusSmall;
	.m-checkerboardBackground(15px)
}

.colorPicker-preview-original,
.colorPicker-preview-current
{
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
}

.colorPicker-preview-original
{
	right: 50%;
}

.colorPicker-preview-current
{
	left: 50%;
}

// ### MISC

.inputGroup.inputGroup--colorSmall
{
	width: 180px;
}';
	return $__finalCompiled;
}
);