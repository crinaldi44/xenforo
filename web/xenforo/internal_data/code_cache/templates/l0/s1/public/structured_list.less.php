<?php
// FROM HASH: 1e4613c5afe68a0fc050e2ed63d10eb3
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '@_structItem-avatarSize: 36px;
@_structItem-avatarSizeExpanded: 48px;
@_structItem-avatarSizeEnd: @avatar-xxs;
@_structItem-cellPaddingH: ((@xf-paddingMedium + @xf-paddingLarge) / 2); // average
@_structItem-cellPaddingV: @xf-paddingLarge;

.structItemContainer
{
	border-collapse: collapse;
	list-style: none;
	margin: 0;
	padding: 0;
	width: 100%;
}

.structItemContainer-group
{
}

.structItemContainer > .structItem:first-child,
.structItemContainer > .structItemContainer-group:first-child > .structItem:first-child
{
	border-top: none;
}

.structItem
{
	display: table;
	table-layout: fixed;
	border-collapse: collapse;
	border-top: @xf-borderSize solid @xf-borderColorFaint;
	list-style: none;
	margin: 0;
	padding: 0;
	width: 100%;

	&.is-highlighted,
	&.is-moderated
	{
		background: @xf-contentHighlightBg;
	}

	&.is-deleted
	{
		opacity: .7;

		.structItem-title > *
		{
			text-decoration: line-through;
		}
	}

	&.is-mod-selected
	{
		background: @xf-inlineModHighlightColor;
		opacity: 1;
	}
}

.structItem-cell
{
	display: table-cell;
	vertical-align: top;
	padding: @_structItem-cellPaddingV @_structItem-cellPaddingH;

	.structItem--middle &
	{
		vertical-align: middle;
	}

	&.structItem-cell--vote
	{
		width: (@_structItem-cellPaddingH * 2 + 40px);
	}

	&.structItem-cell--icon
	{
		width: (@_structItem-avatarSize + @_structItem-cellPaddingH * 2);
		position: relative;

		&.structItem-cell--iconExpanded
		{
			width: (@_structItem-avatarSizeExpanded + @_structItem-cellPaddingH * 2);
		}

		&.structItem-cell--iconEnd
		{
			width: (@_structItem-avatarSizeEnd + @_structItem-cellPaddingH * 2);
			padding-left: (@_structItem-cellPaddingH / 2);

			.structItem-iconContainer
			{
				padding-top: @xf-paddingMedium;
			}
		}

		&.structItem-cell--iconFixedSmall
		{
			width: (@_structItem-cellPaddingH * 2 + 60px);
		}

		&.structItem-cell--iconFixedSmallest
		{
			width: (@_structItem-avatarSizeEnd + @_structItem-cellPaddingH * 2);
		}

		.solutionIcon
		{
			padding-left: 0;
			padding-right: 0;
		}
	}

	&.structItem-cell--meta
	{
		width: 135px;
	}

	&.structItem-cell--latest
	{
		width: 190px;
		text-align: right;
	}
}

.structItem-iconContainer
{
	position: relative;

	img
	{
		display: block;
		width: 100%;
	}

	.avatar
	{
		.m-avatarSize(@_structItem-avatarSize);

		&.avatar--xxs
		{
			.m-avatarSize(@_structItem-avatarSizeEnd);
		}
	}

	.structItem-secondaryIcon
	{
		position: absolute;
		right: -5px;
		bottom: -5px;

		.m-avatarSize((@_structItem-avatarSize / 2  + 2px));
	}

	.structItem-cell--iconExpanded &
	{
		.avatar
		{
			.m-avatarSize(@_structItem-avatarSizeExpanded);
		}

		.structItem-secondaryIcon
		{
			.m-avatarSize((@_structItem-avatarSizeExpanded / 2 - 2px));
		}
	}
}

.structItem-title
{
	font-size: @xf-fontSizeLarge;
	font-weight: @xf-fontWeightNormal;
	margin: 0;
	padding: 0;

	.label
	{
		font-weight: @xf-fontWeightNormal;
	}

	.is-unread &
	{
		font-weight: @xf-fontWeightHeavy;
	}
}

.structItem-minor
{
	font-size: @xf-fontSizeSmaller;
	color: @xf-textColorMuted;

	.m-hiddenLinks();
}

.structItem-parts
{
	.m-listPlain();
	display: inline;

	> li
	{
		display: inline;
		margin: 0;
		padding: 0;

		&:nth-child(even)
		{
			color: @xf-textColorDimmed;
		}

		&:before
		{
			content: "\\00B7\\20";
		}

		&:first-child:before
		{
			content: "";
			display: none;
		}
	}
}

.structItem-pageJump
{
	margin-left: 8px;
	font-size: @xf-fontSizeSmallest;

	a
	{
		.xf-chip();
		text-decoration: none;
		border-radius: @xf-borderRadiusSmall;
		padding: 0 3px;
		opacity: .5;
		.m-transition();

		.structItem:hover &,
		.has-touchevents &
		{
			opacity: 1;
		}

		&:hover
		{
			text-decoration: none;
			.xf-chipHover();
		}
	}
}

.structItem-statuses,
.structItem-extraInfo
{
	.m-listPlain();
	float: right;

	> li
	{
		float: left;
		margin-left: 8px;
	}

	input[type=checkbox]
	{
		.m-checkboxAligner();
	}
}

.structItem-statuses .reactionSummary
{
	vertical-align: -2px;
}

.structItem-extraInfo .reactionSummary
{
	vertical-align: middle;
}

.structItem-status
{
	&::before
	{
		.m-faBase();
		display: inline-block;
		font-size: 90%;
		color: @xf-textColorMuted;
	}

	&.fa--xf svg
	{
		color: @xf-textColorMuted;
	}

	&--deleted::before { .m-faContent(@fa-var-trash-alt, .875em); }
	&--locked::before { .m-faContent(@fa-var-lock, .875em); }
	&--moderated::before { .m-faContent(@fa-var-shield, 1em); color: @xf-textColorAttention; }
	&--redirect::before { .m-faContent(@fa-var-external-link, 1em); }
	&--starred::before { .m-faContent(@fa-var-star, 1.125em); color: @xf-starFullColor; }
	&--sticky::before { .m-faContent(@fa-var-thumbtack, .75em); }
	&--featured::before { .m-faContent(@fa-var-medal, 1em); }
	&--watched::before { .m-faContent(@fa-var-bell, .875em); }

	&--solved::before { .m-faContent(@fa-var-check-circle, 1em); color: @xf-votePositiveColor; }
	&--attention::before { .m-faContent(@fa-var-bullhorn, 1.125em); color: @xf-textColorAttention; }
	&--upvoted::before { .m-faContent(@fa-var-thumbs-up, 1em); }
	&--downvoted::before { .m-faContent(@fa-var-thumbs-down, 1em); }
}

.structItem.structItem--note
{
	.xf-contentHighlightBase();
	color: @xf-textColorFeature;

	.structItem-cell
	{
		padding-top: (@_structItem-cellPaddingV / 2);
		padding-bottom: (@_structItem-cellPaddingV / 2);
		font-size: @xf-fontSizeSmaller;
		text-align: center;
	}
}

@media (max-width: @xf-responsiveWide)
{
	.structItem-cell
	{
		vertical-align: top;

		&.structItem-cell--meta
		{
			width: 115px;
			font-size: @xf-fontSizeSmaller;
		}

		&.structItem-cell--latest
		{
			width: 140px;
			font-size: @xf-fontSizeSmaller;
		}
	}
}

@media (max-width: @xf-responsiveMedium)
{
	.structItem-cell
	{
		//padding: (@_structItem-cellPaddingV / 2) @_structItem-cellPaddingH;

		&.structItem-cell--icon
		{
			.structItem-cell + &
			{
				padding-left: 0;
				width: (@_structItem-avatarSize + @_structItem-cellPaddingH);
			}
		}

		&.structItem-cell--main,
		&.structItem-cell--newThread
		{
			display: block;
			padding-bottom: .2em;

			.structItem-cell + &
			{
				padding-left: 0;
			}
		}

		&.structItem-cell--meta
		{
			display: block;
			width: auto;
			float: left;
			padding-top: 0;
			padding-left: 0;
			padding-right: 0;
			color: @xf-textColorMuted;

			.structItem-minor
			{
				display: none;
			}

			.pairs
			{
				> dt,
				> dd
				{
					display: inline;
					float: none;
					margin: 0;
				}
			}
		}

		&.structItem-cell--latest
		{
			display: block;
			width: auto;
			float: left;
			padding-top: 0;
			padding-left: 0;

			&:before
			{
				content: "\\00A0\\00B7\\20";
				color: @xf-textColorMuted;
			}

			a
			{
				color: @xf-textColorMuted;
			}

			.structItem-minor
			{
				display: none;
			}
		}

		&.structItem-cell--iconEnd
		{
			display: none;
		}
	}

	.structItem-pageJump,
	.structItem-extraInfoMinor
	{
		display: none;
	}

	.is-unread .structItem-latestDate
	{
		font-weight: @xf-fontWeightNormal;
	}
}

@media (max-width: @xf-responsiveNarrow)
{
	.structItem-parts
	{
		.structItem-startDate
		{
			display: none;
		}
	}

	.structItem.structItem--quickCreate
	{
		.structItem-cell--icon,
		.structItem-cell--vote
		{
			display: none;
		}

		.structItem-cell--newThread
		{
			padding-left: @_structItem-cellPaddingH;
			padding-bottom: @_structItem-cellPaddingH;
		}
	}
}';
	return $__finalCompiled;
}
);