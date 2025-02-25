<?php
// FROM HASH: 71c6e723d323d941ab3d690a1b18479d
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// Variables
// --------------------------

@fa-font-path:         "styles/fonts/fa";
@fa-font-size-base:    16px;
@fa-font-display:      block;
@fa-line-height-base:  1;
@fa-css-prefix:        fa;
@fa-version:           "5.15.3";
@fa-border-color:      #eee;
@fa-inverse:           #fff;
@fa-li-width:          2em;
@fa-primary-opacity:   1;
@fa-secondary-opacity: .4;

// Mixins
// --------------------------

.fa-icon() {
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  display: inline-block;
  font-style: normal;
  font-variant: normal;
  font-weight: normal;
  line-height: 1;
}

.fa-icon-rotate(@degrees, @rotation) {
  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=@{rotation})";
  transform: rotate(@degrees);
}

.fa-icon-flip(@horiz, @vert, @rotation) {
  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=@{rotation}, mirror=1)";
  transform: scale(@horiz, @vert);
}


// Only display content to screen readers. A la Bootstrap 4.
//
// See: http://a11yproject.com/posts/how-to-hide-content/

.sr-only() {
  border: 0;
  clip: rect(0,0,0,0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

// Use in conjunction with .sr-only to only display content when it\'s focused.
//
// Useful for "Skip to main content" links; see http://www.w3.org/TR/2013/NOTE-WCAG20-TECHS-20130905/G1
//
// Credit: HTML5 Boilerplate

.sr-only-focusable() {
  &:active,
  &:focus {
    clip: auto;
    height: auto;
    margin: 0;
    overflow: visible;
    position: static;
    width: auto;
  }
}
';
	return $__finalCompiled;
}
);