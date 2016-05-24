<?php
/**
 * Portfolio shortcodes VC bridge.
 *
 * @package the7\Portfolio\Shortcodes
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// templates
$loading_effect = array(
	"heading"		=> __( "Loading effect", 'the7mk2' ),
	"param_name"	=> "loading_effect",
	"type"			=> "dropdown",
	"value"			=> array(
		'None'				=> 'none',
		'Fade in'			=> 'fade_in',
		'Move up'			=> 'move_up',
		'Scale up'			=> 'scale_up',
		'Fall perspective'	=> 'fall_perspective',
		'Fly'				=> 'fly',
		'Flip'				=> 'flip',
		'Helix'				=> 'helix',
		'Scale'				=> 'scale',
	),
);

$show_content = array(
		array(
			"heading"		=> __( "Show projects titles", 'the7mk2' ),
			"param_name"	=> "show_title",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show projects excerpts", 'the7mk2' ),
			"param_name"	=> "show_excerpt",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
);

$show_meta = array(
		array(
			"heading"		=> __( "Show project categories", 'the7mk2' ),
			"param_name"	=> "show_categories",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show project date", 'the7mk2' ),
			"param_name"	=> "show_date",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show project author", 'the7mk2' ),
			"param_name"	=> "show_author",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show project comments", 'the7mk2' ),
			"param_name"	=> "show_comments",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
);

$show_filter = array(
		array(
			"heading"		=> __( "Show categories filter", 'the7mk2' ),
			"param_name"	=> "show_filter",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
);

$show_filter_ordering = array(
		array(
			"heading"		=> __( "Show name / date ordering", 'the7mk2' ),
			"param_name"	=> "show_orderby",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show asc. / desc. ordering", 'the7mk2' ),
			"param_name"	=> "show_order",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
);

$show_icons = array(
		array(
			"heading"		=> __( "Show details icon", 'the7mk2' ),
			"param_name"	=> "show_details",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show link icon", 'the7mk2' ),
			"param_name"	=> "show_link",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show zoom icon", 'the7mk2' ),
			"param_name"	=> "show_zoom",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
);

$pagination = array(
		array(
			"heading"		=> __( "Number of projects to show", 'the7mk2' ),
			"param_name"	=> "number",
			"type"			=> "textfield",
			"value"			=> "12",
		),
		array(
			"heading"		=> __( "Number of projects to display on one page", 'the7mk2' ),
			"param_name"	=> "posts_per_page",
			"type"			=> "textfield",
			"value"			=> "-1",
		),
);

$ordering = array(
		array(
			"heading"		=> __( "Order by", 'the7mk2' ),
			"description"	=> __( "Select how to sort retrieved posts.", 'the7mk2' ),
			"param_name"	=> "orderby",
			"type"			=> "dropdown",
			"value"			=> array(
				"Date"			=> "date",
				"Author"		=> "author",
				"Title"			=> "title",
				"Slug"			=> "name",
				"Date modified"	=> "modified",
				"ID"			=> "id",
				"Random"		=> "rand",
			),
		),
		array(
			"heading"		=> __( "Order way", 'the7mk2' ),
			"description"	=> __( "Designates the ascending or descending order.", 'the7mk2' ),
			"param_name"	=> "order",
			"type"			=> "dropdown",
			"value"			=> array(
				"Descending"	=> "desc",
				"Ascending"		=> "asc",
			),
		),
);

$category = array(
	"heading"		=> __( "Categories", 'the7mk2' ),
	"description"	=> __( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2' ),
	"param_name"	=> "category",
	"type"			=> "dt_taxonomy",
	"taxonomy"		=> "dt_portfolio_category",
	"admin_label"	=> true,
);

$padding = array(
	"heading"		=> __( "Gap between images (px)", 'the7mk2' ),
	"param_name"	=> "padding",
	"type"			=> "textfield",
	"value"			=> "20",
);

$proportion = array(
	"heading"		=> __( "Thumbnails proportions", 'the7mk2' ),
	"description"	=> __( "Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", 'the7mk2' ),
	"param_name"	=> "proportion",
	"type"			=> "textfield",
	"value"			=> "",
);

$descriptions = array(
	"heading"		=> __( "Show projects descriptions", 'the7mk2' ),
	"param_name"	=> "descriptions",
	"type"			=> "dropdown",
	"value"			=> array(
		'Under images'							=> 'under_image',
		'On colored background'					=> 'on_hover_centered',
		'On dark gradient'						=> 'on_dark_gradient',
		'In the bottom'							=> 'from_bottom',
		'Background & animated lines'			=> 'bg_with_lines',
	),
);

$bg_under_projects = array(
	"heading"		=> __( "Background under projects", 'the7mk2' ),
	"param_name"	=> "bg_under_projects",
	"type"			=> "dropdown",
	"value"			=> array(
		'Enabled (image with paddings)'		=> 'with_paddings',
		'Enabled (image without paddings)'	=> 'fullwidth',
		'Disabled'							=> 'disabled'
	),
);

$hover_animation = array(
	"heading"		=> __( "Animation", 'the7mk2' ),
	"param_name"	=> "hover_animation",
	"type"			=> "dropdown",
	"value"			=> array(
		'Fade'						=> 'fade',
		'Direction aware'			=> 'direction_aware',
		'Reverse direction aware'	=> 'redirection_aware',
		'Scale in'					=> 'scale_in',
	),
);

$hover_bg_color = array(
	"heading"		=> __( "Image hover background color", 'the7mk2' ),
	"param_name"	=> "hover_bg_color",
	"type"			=> "dropdown",
	"value"			=> array(
		'Color (from Theme Options)'	=> 'accent',
		'Dark'							=> 'dark',
	),
);

$bgwl_animation_effect = array(
	"heading"		=> __( "Animation effect", 'the7mk2' ),
	"param_name"	=> "bgwl_animation_effect",
	"type"			=> "dropdown",
	"value"			=> array(
		'Effect 1'	=> '1',
		'Effect 2'	=> '2',
		'Effect 3'	=> '3',
	),
);

$hover_content_visibility = array(
	"heading"		=> __( "Content", 'the7mk2' ),
	"param_name"	=> "hover_content_visibility",
	"type"			=> "dropdown",
	"value"			=> array(
		'On hover'			=> 'on_hover',
		'Always visible'	=> 'always'
	),
);

$colored_bg_content_aligment = array(
	"heading"		=> __( "Content alignment", 'the7mk2' ),
	"param_name"	=> "colored_bg_content_aligment",
	"type"			=> "dropdown",
	"value"			=> array(
		"Centre"		=> "centre",
		"Bottom"		=> "bottom",
		"Left & top"	=> "left_top",
		"Left & bottom"	=> "left_bottom",
	),
);

$content_aligment = array(
	"heading"		=> __( "Content alignment", 'the7mk2' ),
	"param_name"	=> "content_aligment",
	"type"			=> "dropdown",
	"value"			=> array(
		'Left'			=> 'left',
		'Centre'		=> 'center',
	),
);

/**
 * Portfolio Scroller.
 */

vc_map( array(
	"weight"	=> -1,
	"base"		=> "dt_portfolio_slider",
	"name"		=> __("Portfolio Scroller", 'the7mk2'),
	"category"	=> __('by Dream-Theme', 'the7mk2'),
	"icon"		=> "dt_vc_ico_portfolio_slider",
	"class"		=> "dt_vc_sc_portfolio_slider",
	"params"	=> array_merge(
		array(
			$category,
			array(
				"heading"		=> __("Thumbnails height", 'the7mk2'),
				"description"	=> __("In pixels.", 'the7mk2'),
				"param_name"	=> "height",
				"type"			=> "textfield",
				"value"			=> "210",
			),
			array(
				"heading"		=> __("Thumbnails width", 'the7mk2'),
				"description"	=> __("In pixels. Leave this field empty if you want to preserve original thumbnails proportions.", 'the7mk2'),
				"param_name"	=> "width",
				"type"			=> "textfield",
				"value"			=> "",
			),
			$padding,
			array(
				"heading"		=> __("Arrows", 'the7mk2'),
				"param_name"	=> "arrows",
				"type"			=> "dropdown",
				"value"			=> array(
					'light'					=> 'light',
					'dark'					=> 'dark',
					'rectangular accent'	=> 'rectangular_accent',
					'disabled'				=> 'disabled',
				)
			),
			array_merge( $descriptions, array( "param_name" => "appearance" ) ),
			array_merge( $bg_under_projects, array(
				"dependency"	=> array(
					"element"	=> "appearance",
					"value"		=> array( 'under_image' ),
				),
			) ),
			array_merge( $hover_animation, array(
				"dependency"	=> array(
					"element"		=> "appearance",
					"value"			=> array( 'on_hover_centered' ),
				),
			) ),
			array_merge( $hover_bg_color, array(
				"dependency"	=> array(
					"element"		=> "appearance",
					"value"			=> array(
						'on_hover_centered',
						'under_image',
						'bg_with_lines',
					),
				),
			) ),
			array_merge( $bgwl_animation_effect, array(
				"dependency"	=> array(
					"element"		=> "appearance",
					"value"			=> array( 'bg_with_lines' ),
				),
			) ),
			array_merge( $hover_content_visibility, array(
				"dependency"	=> array(
					"element"		=> "appearance",
					"value"			=> array(
						'on_dark_gradient',
						'bg_with_lines',
					),
				),
			) ),
			array_merge( $colored_bg_content_aligment, array(
				"dependency"	=> array(
					"element"		=> "appearance",
					"value"			=> array( 'on_hover_centered' ),
				),
			) ),
			array_merge( $content_aligment, array(
				"dependency"	=> array(
					"element"		=> "appearance",
					"value"			=> array(
						'under_image',
						'on_dark_gradient',
						'from_bottom',
					),
				),
			) ),
		),
		$show_content,
		$show_meta,
		$show_icons,
		array( current( $pagination ) ),
		array(
			array(
				"heading"		=> __("Autoslide interval (in milliseconds)", 'the7mk2'),
				"param_name"	=> "autoslide",
				"type"			=> "textfield",
				"value"			=> "",
			),
			array(
				"heading"		=> __("Loop", 'the7mk2'),
				"param_name"	=> "loop",
				"type"			=> "checkbox",
				"value"			=> array( "" => "true" ),
			),
		),
		$ordering
	)
) );

/**
 * Portfolio.
 */

vc_map( array(
	"weight"	=> -1,
	"base"		=> "dt_portfolio",
	"name"		=> __( "Portfolio Masonry & Grid", 'the7mk2' ),
	"category"	=> __( 'by Dream-Theme', 'the7mk2' ),
	"icon"		=> "dt_vc_ico_portfolio",
	"class"		=> "dt_vc_sc_portfolio",
	"params"	=> array_merge(
		array(
			$category,
			array(
				"heading"		=> __( "Appearance", 'the7mk2' ),
				"param_name"	=> "type",
				"type"			=> "dropdown",
				"value"			=> array(
					"Masonry"		=> "masonry",
					"Grid"			=> "grid",
				),
			),
			array_merge( $padding, array( "description"	=> __( "Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)", 'the7mk2' ) ) ),
			array(
				"heading"		=> __( "Column minimum width (px)", 'the7mk2' ),
				"param_name"	=> "column_width",
				"type"			=> "textfield",
				"value"			=> "370",
			),
			array(
				"heading"		=> __( "Desired columns number", 'the7mk2' ),
				"param_name"	=> "columns",
				"type"			=> "textfield",
				"value"			=> "2",
			),
			$proportion,
			array(
				"heading"		=> __( "Projects width", 'the7mk2' ),
				"param_name"	=> "same_width",
				"type"			=> "dropdown",
				"value"			=> array(
					"Preserve original width"	=> "false",
					"Make projects same width"	=> "true",
				),
			),
			$descriptions,
			array_merge( $bg_under_projects, array(
				"dependency"	=> array(
					"element"	=> "descriptions",
					"value"		=> array( 'under_image' ),
				),
			) ),
			array_merge( $hover_animation, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array( 'on_hover_centered' ),
				),
			) ),
			array_merge( $hover_bg_color, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array(
						'on_hover_centered',
						'under_image',
						'bg_with_lines',
					),
				),
			) ),
			array_merge( $bgwl_animation_effect, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array( 'bg_with_lines' ),
				),
			) ),
			array_merge( $hover_content_visibility, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array(
						'on_dark_gradient',
						'bg_with_lines',
					),
				),
			) ),
			array_merge( $colored_bg_content_aligment, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array( 'on_hover_centered' ),
				),
			) ),
			array_merge( $content_aligment, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array(
						'under_image',
						'on_dark_gradient',
						'from_bottom',
					),
				),
			) ),
			$loading_effect,
		),
		$show_content,
		$show_meta,
		$show_filter,
		$show_filter_ordering,
		$show_icons,
		$pagination,
		$ordering
	)
) );

/**
 * Portfolio justified grid.
 */

vc_map( array(
	"weight"	=> -1,
	"base"		=> 'dt_portfolio_jgrid',
	"name"		=> __( "Portfolio Justified Grid", 'the7mk2' ),
	"category"	=> __( 'by Dream-Theme', 'the7mk2' ),
	"icon"		=> "dt_vc_ico_portfolio",
	"class"		=> "dt_vc_sc_portfolio",
	"params"	=> array_merge(
		array(
			$category,
			$padding,
			array(
				"heading"		=> __( "Row target height (px)", 'the7mk2' ),
				"param_name"	=> "target_height",
				"type"			=> "textfield",
				"value"			=> "240",
			),
			$proportion,
			array_merge( $descriptions, array( 'value' => array_diff( $descriptions['value'], array( 'under_image' ) ) ) ),
			array_merge( $hover_animation, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array( 'on_hover_centered' ),
				),
			) ),
			array_merge( $hover_bg_color, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array(
						'on_hover_centered',
						'bg_with_lines',
					),
				),
			) ),
			array_merge( $bgwl_animation_effect, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array( 'bg_with_lines' ),
				),
			) ),
			array_merge( $hover_content_visibility, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array(
						'on_dark_gradient',
						'bg_with_lines',
					),
				),
			) ),
			array_merge( $colored_bg_content_aligment, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array( 'on_hover_centered' ),
				),
			) ),
			array_merge( $content_aligment, array(
				"dependency"	=> array(
					"element"		=> "descriptions",
					"value"			=> array(
						'on_dark_gradient',
						'from_bottom',
					),
				),
			) ),
			$loading_effect,
			array(
				"heading" => __( "Hide last row if there's not enough images to fill it", 'the7mk2' ),
				"param_name" => "hide_last_row",
				"type" => "checkbox",
				"value" => array( "" => "true" ),
			),
		),
		$show_content,
		$show_meta,
		$show_icons,
		$show_filter,
		$pagination,
		$ordering
	)
) );
