<?php
// FROM HASH: cdd975af87ff841d4027ed30bf0d32cf
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '/* XF-RTL:disable */

.codeEditor
{
	// standard editor with fixed-width font and 55% screen height, used when the code editor is the primary
	// editable element on screen
	&.CodeMirror
	{
		height: 55vh;
		direction: ltr;

		.xf-input();
		font-family: @xf-fontFamilyCode;
		padding: 0;
		-ltr-rtl-border-color: @xf-borderColorHeavy @xf-borderColorLight @xf-borderColorLight @xf-borderColorHeavy;

		//color: @xf-inputTextColor;
		//background: @xf-inputBgColor;
		//border: @xf-borderSize solid;
		//border-radius: @xf-borderRadiusMedium;

		.m-inputZoomFix();

		&.CodeMirror-focused
		{
			.xf-inputFocus();
		}

		&.CodeMirror-simplescroll
		{
			.CodeMirror-sizer
			{
				// Bit hacky but solves issue with the simplescroll bars overlapping the content
				padding-right: 30px !important;
			}
		}
	}

	// short editor, taking only 30% of the vertical height
	&.codeEditor--short
	{
		height: 30vh;
	}

	// show an editor that shrinks to a very small height for very little content
	&.codeEditor--autoSize
	{
		height: auto;

		.CodeMirror-lines
		{
			min-height: (@xf-fontSizeNormal * @xf-lineHeightDefault * 2 + 8px); // 2 lines, 4px padding from .CodeMirror-lines
		}
	}

	// like --autoSize, but shrinks to a single line when empty
	&.codeEditor--oneLine
	{
		min-height: auto;
	}

	// use proportional font - use this when syntax highlighting is useful, but not imperative, like HTML-enabled descriptions
	&.codeEditor--proportional
	{
		font-family: @xf-fontFamilyUi;
	}
}

[disabled] + .codeEditor,
[disabled] + .codeEditor.CodeMirror-focused
{
	.xf-inputDisabled();
}

[readonly] + .codeEditor,
[readonly] + .codeEditor.CodeMirror-focused
{
	background: mix(xf-default(@xf-input--background-color, @xf-contentBg), xf-default(@xf-inputDisabled--background-color, @xf-paletteNeutral1));
}

// Default CSS (mostly)
' . $__templater->includeTemplate('codemirror.less', $__vars) . '

@_cm-black: @xf-textColor;
@_cm-999: @xf-textColorMuted;
@_cm-bbb: xf-diminish(@xf-borderColor, 12%);
@_cm-silver: @xf-borderColorHeavy;
@_cm-ccc: @xf-borderColorHeavy;
@_cm-d9d9d9: @xf-borderColor;
@_cm-ddd: @xf-borderColor;
@_cm-eee: @xf-borderColorFaint;
@_cm-f7f7f7: @xf-contentAltBg;
@_cm-white: @xf-contentBg;
@_cm-7e7: #7e7;
@_cm-bcd: #bcd;
@_cm-d7d4f0: @xf-contentHighlightBg;
@_cm-rgb_20_255_20: rgba(20, 255, 20, 0.5);
@_cm-rgba_255_255_0: rgba(255, 255, 0, .4);

.CodeMirror-scrollbar-filler, .CodeMirror-gutter-filler { background-color: @_cm-white; } // white
.CodeMirror-gutters {
	border-right-color: @_cm-ddd; // #ddd
	background-color: @_cm-f7f7f7; } // #f7f7f7
.CodeMirror-linenumber {
	color: @_cm-999; } // #999
.CodeMirror-guttermarker {
	color: @_cm-black; } // black
.CodeMirror-guttermarker-subtle {
	color: @_cm-999; } // #999
.CodeMirror-cursor {
	border-left-color: @_cm-black; } // black
.CodeMirror div.CodeMirror-secondarycursor {
	border-left-color: @_cm-silver; } // silver / #c0c0c0
.cm-fat-cursor .CodeMirror-cursor {
	background: @_cm-7e7; } // #7e7
.cm-animate-fat-cursor {
	background-color: @_cm-7e7; } // #7e7
.cm-fat-cursor-mark {
	background-color: @_cm-rgb_20_255_20; } // rgba(20, 255, 20, 0.5)
.CodeMirror-ruler {
	border-left-color: @_cm-ccc; } // #ccc
.CodeMirror {
	background: @_cm-white; } // white
.CodeMirror-selected {
	background: @_cm-d9d9d9; } // #d9d9d9;
.CodeMirror-focused .CodeMirror-selected {
	background: @_cm-d7d4f0; } // #d7d4f0
.CodeMirror-line::selection, .CodeMirror-line > span::selection, .CodeMirror-line > span > span::selection {
	background: @_cm-d7d4f0; } // #d7d4f0
.CodeMirror-line::-moz-selection, .CodeMirror-line > span::-moz-selection, .CodeMirror-line > span > span::-moz-selection {
	background: @_cm-d7d4f0; } // #d7d4f0
.cm-searching {
	background-color: @_cm-rgba_255_255_0; } // rgba(255, 255, 0, .4)
.CodeMirror-simplescroll-horizontal div, .CodeMirror-simplescroll-vertical div {
	background: @_cm-ccc; // #ccc
	border-color: @_cm-bbb; } // #bbb
.CodeMirror-simplescroll-horizontal, .CodeMirror-simplescroll-vertical {
	background: @_cm-eee; } // #eee
.CodeMirror-overlayscroll-horizontal div, .CodeMirror-overlayscroll-vertical div {
	background: @_cm-bcd; } // #bcd
.CodeMirror-dialog-top {
	border-bottom-color: @_cm-eee; } // #eee
.CodeMirror-dialog-bottom {
	border-top-color: @_cm-eee; } // #eee

// Extra stuff for DARK styles, taking values from CodeMirror\'s DARCULA theme
.cm-s-default
{
	.m-colorScheme(dark,
	{
		//&.CodeMirror
		//{
		//	.CodeMirror-cursor { border-left: 1px solid #dddddd; }
		//	.CodeMirror-activeline-background { background: #3A3A3A; }
		//	.CodeMirror-selected { background: #085a9c; }
		//	.CodeMirror-gutters { background: rgb(72, 72, 72); border-right: 1px solid grey; color: #606366 }
		//	.CodeMirror-matchingbracket { background-color: #3b514d; color: yellow !important; }
		//}
		&.CodeMirror-focused .CodeMirror-selected
		{
			background: lighten(@xf-contentHighlightBg, 10%);
		}
		.CodeMirror-line::selection, .CodeMirror-line > span::selection, .CodeMirror-line > span > span::selection
		{
			background: lighten(@xf-contentHighlightBg, 10%);
		}
		.CodeMirror-line::-moz-selection, .CodeMirror-line > span::-moz-selection, .CodeMirror-line > span > span::-moz-selection
		{
			background: lighten(@xf-contentHighlightBg, 10%);
		}

		span.cm-keyword { font-weight: bold; color: #CC7832; }
		span.cm-atom { font-weight: bold; color: #CC7832; }
		span.cm-number { color: #6897BB; }
		span.cm-def { color: #FFC66D; }
		span.cm-variable { color: #A9B7C6; }
		span.cm-property { color: #A9B7C6; }
		span.cm-operator { color: #A9B7C6; }
		span.cm-variable-2 { color: #A9B7C6; }
		span.cm-variable-3,
		span.cm-comment { color: #808080; }
		span.cm-string { color: #6A8759; }
		span.cm-string-2 { color: #6A8759; }
		span.cm-meta { color: #BBB529; }
		span.cm-qualifier { color: #6A8759; }
		span.cm-builtin { color: #A9B7C6; }
		span.cm-bracket { color: #A9B7C6; }
		span.cm-tag { color: #CC7832; }
		span.cm-attribute { color: #6A8759; }
		span.cm-link { color: #287BDE; }
		span.cm-error { color: #BC3F3C; }
		span.cm-invalidchar { color: #BC3F3C; }
		span.cm-type { color: #A9B7C6; }
	});
}

/* XF-RTL:enable */';
	return $__finalCompiled;
}
);