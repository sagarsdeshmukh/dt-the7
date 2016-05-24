<?php
/**
 * Albums shortcodes VC bridge
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// common
$loading_effect = array(
	array(
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
	),
);

$show_meta = array(
		array(
			"heading"		=> __( "Show album categories", 'the7mk2' ),
			"param_name"	=> "show_categories",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show album date", 'the7mk2' ),
			"param_name"	=> "show_date",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show album author", 'the7mk2' ),
			"param_name"	=> "show_author",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show album comments", 'the7mk2' ),
			"param_name"	=> "show_comments",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
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
	array(
		"heading"		=> __( "Categories", 'the7mk2' ),
		"description"	=> __( "Note: By default, all your albums will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2' ),
		"param_name"	=> "category",
		"type"			=> "dt_taxonomy",
		"taxonomy"		=> "dt_gallery_category",
		"admin_label"	=> true,
	)
);

$padding = array(
	array(
		"heading"		=> __( "Gap between images (px)", 'the7mk2' ),
		"param_name"	=> "padding",
		"type"			=> "textfield",
		"value"			=> "20",
	),
);

$proportion = array(
	array(
		"heading"		=> __( "Thumbnails proportions", 'the7mk2' ),
		"description"	=> __( "Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", 'the7mk2' ),
		"param_name"	=> "proportion",
		"type"			=> "textfield",
		"value"			=> "",
	),
);

// albums
$show_albums_content = array(
		array(
			"heading"		=> __( "Show albums titles", 'the7mk2' ),
			"param_name"	=> "show_title",
			"type"			=> "checkbox",
			"value"			=> array( "" => "true" ),
		),
		array(
			"heading"		=> __( "Show albums excerpts", 'the7mk2' ),
			"param_name"	=> "show_excerpt",
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

$show_miniatures = array(
	array(
		"heading" => __( "Show image miniatures", 'the7mk2' ),
		"param_name" => "show_miniatures",
		"type" => "checkbox",
		"value" => array( "" => "true" ),
	),
);

$albums_to_show = array(
		array(
			"heading"		=> __( "Number of albums to show", 'the7mk2' ),
			"param_name"	=> "number",
			"type"			=> "textfield",
			"value"			=> "12",
		),
);

$show_media_count = array(
	array(
		"heading" => __( "Show number of images & videos", 'the7mk2' ),
		"param_name" => "show_media_count",
		"type" => "checkbox",
		"value" => array( "" => "true" ),
	),
);

$albums_per_page = array(
		array(
			"heading"		=> __( "Number of albums to display on one page", 'the7mk2' ),
			"param_name"	=> "posts_per_page",
			"type"			=> "textfield",
			"value"			=> "-1",
		),
);

// photos
$show_photos_content = $show_albums_content;
$show_photos_content[0]["heading"] = __( "Show titles", 'the7mk2' );
$show_photos_content[1]["heading"] = __( "Show items captions", 'the7mk2' );

$photos_to_show = $albums_to_show;
$photos_to_show[0]["heading"] = __( "Number of items to show", 'the7mk2' );

// masonry
$padding_masonry = $padding;
$padding_masonry[0]["description"] = __( "Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)", 'the7mk2' );

$appearance = array(
	array(
		"heading" => __( "Appearance", 'the7mk2' ),
		"param_name" => "type",
		"type" => "dropdown",
		"value" => array(
			"Masonry" => "masonry",
			"Grid" => "grid",
		),
	),
);

$column_width = array(
	array(
		"heading" => __( "Column minimum width (px)", 'the7mk2' ),
		"param_name" => "column_width",
		"type" => "textfield",
		"value" => "370",
	),
);

$columns = array(
	array(
		"heading" => __( "Desired columns number", 'the7mk2' ),
		"param_name" => "columns",
		"type" => "textfield",
		"value" => "2",
	),
);

// jgrid
$target_height = array(
	array(
		"heading" => __( "Row target height (px)", 'the7mk2' ),
		"param_name" => "target_height",
		"type" => "textfield",
		"value" => "240",
	),
);

$hide_last_row = array(
	array(
		"heading" => __( "Hide last row if there's not enough images to fill it", 'the7mk2' ),
		"param_name" => "hide_last_row",
		"type" => "checkbox",
		"value" => array( "" => "true" ),
	),
);

// scroller
$scroller_height = array(
	array(
		"heading" => __( "Thumbnails height", 'the7mk2' ),
		"description" => __( "In pixels.", 'the7mk2' ),
		"param_name" => "height",
		"type" => "textfield",
		"value" => "210",
	),
);

$scroller_width = array(
	array(
		"heading" => __( "Thumbnails width", 'the7mk2' ),
		"description" => __( "In pixels. Leave this field empty if you want to preserve original thumbnails proportions.", 'the7mk2' ),
		"param_name" => "width",
		"type" => "textfield",
		"value" => "",
	),
);

$scroller_arrows = array(
	array(
		"heading" => __("Arrows", 'the7mk2'),
		"param_name" => "arrows",
		"type" => "dropdown",
		"value" => array(
			'light' => 'light',
			'dark' => 'dark',
			'rectangular accent' => 'rectangular_accent',
			'disabled' => 'disabled',
		),
	),
);

$scroller_slidehow_controls = array(
	array(
		"heading" => __( "Autoslide interval (in milliseconds)", 'the7mk2' ),
		"param_name" => "autoslide",
		"type" => "textfield",
		"value" => "",
	),
	array(
		"heading" => __( "Loop", 'the7mk2' ),
		"param_name" => "loop",
		"type" => "checkbox",
		"value" => array( "" => "true" ),
	),
);

// hover
$descriptions = array(
	"heading"		=> __( "Show albums descriptions", 'the7mk2' ),
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

$bg_under_posts = array(
	"heading"		=> __( "Background under albums", 'the7mk2' ),
	"param_name"	=> "bg_under_albums",
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

$descriptions_masonry = array(
	$descriptions,
	array_merge( $bg_under_posts, array(
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
);

$descriptions_jgrid = array(
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
);

// ! Albums masonry
vc_map( array(
	"weight" => -1,
	"base" => 'dt_albums',
	"name" => __( "Albums Masonry & Grid", 'the7mk2' ),
	"category" => __( 'by Dream-Theme', 'the7mk2' ),
	"icon" => "dt_vc_ico_albums",
	"class" => "dt_vc_sc_albums",
	"params" => array_merge(
		$category,
		$appearance,
		$padding_masonry,
		$column_width,
		$columns,
		$proportion,
		array(
			array(
				"heading" => __( "Albums width", 'the7mk2' ),
				"param_name" => "same_width",
				"type" => "dropdown",
				"value" => array(
					"Preserve original width" => "false",
					"Make albums same width" => "true",
				),
			)
		),
		$descriptions_masonry,
		$loading_effect,
		$show_albums_content,
		$show_miniatures,
		$show_meta,
		$show_filter,
		$show_filter_ordering,
		$show_media_count,
		$albums_to_show,
		$albums_per_page,
		$ordering
	)
) );

// ! Photos masonry
vc_map( array(
	"weight" => -1,
	"base" => 'dt_photos_masonry',
	"name" => __( "Photos Masonry & Grid", 'the7mk2' ),
	"category" => __( 'by Dream-Theme', 'the7mk2' ),
	"icon" => "dt_vc_ico_photos",
	"class" => "dt_vc_sc_photos",
	"params" => array_merge(
		$category,
		$appearance,
		$padding_masonry,
		$column_width,
		$columns,
		$proportion,
		$loading_effect,
		$show_photos_content,
		$photos_to_show,
		$ordering
	)
) );

// ! Albums justified grid
vc_map( array(
	"weight" => -1,
	"base" => "dt_albums_jgrid",
	"name" => __( "Albums Justified Grid", 'the7mk2' ),
	"category" => __( 'by Dream-Theme', 'the7mk2' ),
	"icon" => "dt_vc_ico_albums",
	"class" => "dt_vc_sc_albums",
	"params" => array_merge(
		$category,
		$padding,
		$target_height,
		$proportion,
		$descriptions_jgrid,
		$loading_effect,
		$hide_last_row,
		$show_albums_content,
		$show_miniatures,
		$show_meta,
		$show_media_count,
		$show_filter,
		$albums_to_show,
		$albums_per_page,
		$ordering
	)
) );

// ! Photos jgrid
vc_map( array(
	"weight" => -1,
	"base" => 'dt_photos_jgrid',
	"name" => __( "Photos Justified Grid", 'the7mk2' ),
	"category" => __( 'by Dream-Theme', 'the7mk2' ),
	"icon" => "dt_vc_ico_photos",
	"class" => "dt_vc_sc_photos",
	"params" => array_merge(
		$category,
		$padding,
		$target_height,
		$proportion,
		$loading_effect,
		$hide_last_row,
		$show_photos_content,
		$photos_to_show,
		$ordering
	)
) );

// ! Albums scroller
vc_map( array(
	"weight" => -1,
	"base" => 'dt_albums_scroller',
	"name" => __( "Albums Scroller", 'the7mk2' ),
	"category" => __( 'by Dream-Theme', 'the7mk2' ),
	"icon" => "dt_vc_ico_albums",
	"class" => "dt_vc_sc_albums",
	"params" => array_merge(
		$category,
		$scroller_height,
		$scroller_width,
		$padding,
		$scroller_arrows,
		$descriptions_masonry,
		$show_albums_content,
		$show_miniatures,
		$show_meta,
		$show_media_count,
		$albums_to_show,
		$scroller_slidehow_controls,
		$ordering
	)
) );

// ! Photos scroller
vc_map( array(
	"weight" => -1,
	"base" => 'dt_small_photos',
	"name" => __( "Photos Scroller", 'the7mk2' ),
	"category" => __( 'by Dream-Theme', 'the7mk2' ),
	"icon" => "dt_vc_ico_photos",
	"class" => "dt_vc_sc_photos",
	"params" => array_merge(
		$category,
		$scroller_height,
		$scroller_width,
		$padding,
		$scroller_arrows,
		$show_photos_content,
		$photos_to_show,
		$scroller_slidehow_controls,
		array(
			array(
				"heading" => __( "Show", 'the7mk2' ),
				"param_name" => "orderby",
				"type" => "dropdown",
				"value" => array(
					"Recent photos" => "recent",
					"Random photos" => "random",
				),
			)
		)
	)
) );
