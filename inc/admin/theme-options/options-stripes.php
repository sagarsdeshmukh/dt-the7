<?php
/**
 * Stripes.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Stripes", 'theme-options', 'the7mk2' ),
		"menu_title"	=> _x( "Stripes", 'theme-options', 'the7mk2' ),
		"menu_slug"		=> "of-stripes-menu",
		"type"			=> "page"
);

foreach ( presscore_themeoptions_get_stripes_list() as $suffix=>$stripe ) {

	/**
	 * Heading definition.
	 */
	$options[] = array( "name" => $stripe['title'], "type" => "heading" );

	/**
	 * Stripe.
	 */
	$options[] = array(	"name" => $stripe['title'], "type" => "block_begin" );

		//*************************************************************************************************
		// Background
		//*************************************************************************************************

		// title
		$options[] = array( "type" => 'title', "name" => _x('Background', 'theme-options', 'the7mk2') );

		// colorpicker
		$options[] = array(
			"name"	=> _x( 'Color', 'theme-options', 'the7mk2' ),
			"id"	=> "stripes-stripe_{$suffix}_color",
			"std"	=> $stripe['bg_color'],
			"type"	=> "color"
		);

		// background_img
		$options[] = array(
			'name' 			=> _x( 'Add background image', 'theme-options', 'the7mk2' ),
			'id' 			=> "stripes-stripe_{$suffix}_bg_image",
			'std' 			=> $stripe['bg_img'],
			'type' 			=> 'background_img',
			'fields'		=> array(),
		);

		//*************************************************************************************************
		// Outlines
		//*************************************************************************************************

		// divider
		$options[] = array( "type" => 'divider' );

		// radio
		$options[] = array(
			"name"		=> _x( "Outlines", "theme-options", 'the7mk2' ),
			"id"		=> "stripes-stripe_{$suffix}_outline",
			"std"		=> "hide",
			'type'		=> 'images',
			'class'     => 'small',
			"show_hide"	=> array( 'show'	=> true ),
			'options'	=> array(
				'show'	=> array(
					'title' => _x('Show', 'theme-options', 'the7mk2'),
					'src' => '/inc/admin/assets/images/stripes-stripe-outline-enabled.gif',
				),
				'hide'	=> array(
					'title' => _x('Hide', 'theme-options', 'the7mk2'),
					'src' => '/inc/admin/assets/images/stripes-stripe-outline-disabled.gif',
				),
			),
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin" );

			// colorpicker
			$options[] = array(
				"name"	=> _x( 'Outlines color', 'theme-options', 'the7mk2' ),
				"id"	=> "stripes-stripe_{$suffix}_outline_color",
				"std"	=> "#FFFFFF",
				"type"	=> "color"
			);

			// slider
			$options[] = array(
				"name"      => _x( 'Outlines opacity', 'theme-options', 'the7mk2' ),
				"id"        => "stripes-stripe_{$suffix}_outline_opacity",
				"std"       => 100, 
				"type"      => "slider"
			);

		$options[] = array( "type" => "js_hide_end" );

		//*************************************************************************************************
		// Content boxes background
		//*************************************************************************************************

		// divider
		$options[] = array( "type" => 'divider' );

		// title
		$options[] = array( "type" => 'title', "name" => _x('Content boxes background', 'theme-options', 'the7mk2') );

		// colorpicker
		$options[] = array(
			"name"	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
			"id"	=> "stripes-stripe_{$suffix}_content_boxes_bg_color",
			"std"	=> "#FFFFFF",
			"type"	=> "color"
		);

		// slider
		$options[] = array(
			"name"      => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
			"id"        => "stripes-stripe_{$suffix}_content_boxes_bg_opacity",
			"std"       => 100, 
			"type"      => "slider"
		);

		// radio
		$options[] = array(
			"name"		=> _x( "Decoration", "theme-options", 'the7mk2' ),
			"id"		=> "stripes-stripe_{$suffix}_content_boxes_decoration",
			"std"		=> "none",
			'type'		=> 'images',
			'class'     => 'small',
			"show_hide"	=> array( 'outline'	=> true ),
			'options'	=> array(
				'none'		=> array(
					'title' => _x( 'None', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-content_boxes_decoration-none.gif',
				),
				'shadow'	=> array(
					'title' => _x( 'Shadow', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-content_boxes_decoration-shadow.gif',
				),
				'outline'	=> array(
					'title' => _x( 'Outline', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-content_boxes_decoration-outline.gif',
				),
			),
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin" );

			// colorpicker
			$options[] = array(
				"name"	=> _x( 'Decoration outline color', 'theme-options', 'the7mk2' ),
				"id"	=> "stripes-stripe_{$suffix}_content_boxes_decoration_outline_color",
				"std"	=> "#FFFFFF",
				"type"	=> "color"
			);

			// slider
			$options[] = array(
				"name"      => _x( 'Decoration outline opacity', 'theme-options', 'the7mk2' ),
				"id"        => "stripes-stripe_{$suffix}_content_boxes_decoration_outline_opacity",
				"std"       => 100, 
				"type"      => "slider"
			);

		$options[] = array( "type" => "js_hide_end" );

		//*************************************************************************************************
		// Text
		//*************************************************************************************************

		// divider
		$options[] = array( "type" => 'divider' );

		// title
		$options[] = array( "type" => 'title', "name" => _x( 'Text', 'theme-options', 'the7mk2' ) );

		// colorpicker
		$options[] = array(
			"desc" => '',
			"name"	=> _x( 'Headers color', 'theme-options', 'the7mk2' ),
			"id"	=> "stripes-stripe_{$suffix}_headers_color",
			"std"	=> $stripe['text_header_color'],
			"type"	=> "color"
		);

		// colorpicker
		$options[] = array(
			"desc"	=> '',
			"name"	=> _x( 'Text color', 'theme-options', 'the7mk2' ),
			"id"	=> "stripes-stripe_{$suffix}_text_color",
			"std"	=> $stripe['text_color'],
			"type"	=> "color"
		);

	$options[] = array(	"type"  => "block_end");

}
