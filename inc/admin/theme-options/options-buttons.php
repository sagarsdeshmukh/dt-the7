<?php
/**
 * Buttons.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title"	=> _x( "Buttons", 'theme-options', 'the7mk2' ),
	"menu_title"	=> _x( "Buttons", 'theme-options', 'the7mk2' ),
	"menu_slug"		=> "of-buttons-menu",
	"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Buttons', 'theme-options', 'the7mk2'), "type" => "heading" );

/**
 * Buttons style.
 */
$options[] = array( "name" => _x("Buttons style", "theme-options", 'the7mk2'), "type" => "block_begin" );

	$options["buttons-style"] = array(
		"name"		=> "Choose buttons style",
		"id"		=> "buttons-style",
		"std"		=> "ios7",
		'type'		=> 'images',
		'class'     => 'small',
		"options"	=> array(
			"ios7"		=> array(
				'title' => _x( "iOS", "theme-options", 'the7mk2' ),
				'src' => '/inc/admin/assets/images/buttons-style-ios.gif',
			),
			"flat"		=> array(
				'title' => _x( "Flat", "theme-options", 'the7mk2' ),
				'src' => '/inc/admin/assets/images/buttons-style-flat.gif',
			),
			"3d"		=> array(
				'title' => _x( "3D", "theme-options", 'the7mk2' ),
				'src' => '/inc/admin/assets/images/buttons-style-3d.gif',
			),
			"material"	=> array(
				'title' => _x( "Material design", "theme-options", 'the7mk2' ),
				'src' => '/inc/admin/assets/images/buttons-style-material.gif',
			),
		),
	);

$options[] = array( "type" => "block_end" );

/**
 * Buttons color.
 */
$options[] = array( "name" => _x("Buttons color", "theme-options", 'the7mk2'), "type" => "block_begin" );

	// Buttons color
	$options["buttons-color_mode"] = array(
		"name"		=> _x( "Buttons color", "theme-options", 'the7mk2' ),
		"id"		=> "buttons-color_mode",
		"std"		=> "accent",
		'type'		=> 'images',
		'class'     => 'small',
		"show_hide"	=> array(
			'color' 	=> "buttons-mode-color",
			'gradient'	=> "buttons-mode-gradient"
		),
		'options'	=> array(
			'accent'	=> array(
				'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-accent.gif',
			),
			'color'		=> array(
				'title' => _x( 'Custom color', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-custom.gif',
			),
			'gradient'	=> array(
				'title' => _x( 'Custom gradient', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-custom-gradient.gif',
			),
		),
	);
		$options[] = array( "type" => "js_hide_begin", "class" => "buttons-color_mode buttons-mode-color" );
			$options["buttons-color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "buttons-color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);
		$options[] = array( "type" => "js_hide_end" );

		$options[] = array( "type" => "js_hide_begin", "class" => "buttons-color_mode buttons-mode-gradient" );
			$options["buttons-color_gradient"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "buttons-color_gradient",
				"std"	=> array( '#ffffff', '#000000' ),
				"type"	=> "gradient"
			);
		$options[] = array( "type" => "js_hide_end" );

	$options["buttons-hover_color_mode"] = array(
		"name"		=> _x( "Buttons hover color", "theme-options", 'the7mk2' ),
		"id"		=> "buttons-hover_color_mode",
		"std"		=> "accent",
		'type'		=> 'images',
		'class'     => 'small',
		'divider'   => 'top',
		"show_hide"	=> array(
			'color' 	=> "buttons-hover-mode-color",
			'gradient'	=> "buttons-hover-mode-gradient"
		),
		'options'	=> array(
			'accent'	=> array(
				'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-accent.gif',
			),
			'color'		=> array(
				'title' => _x( 'Custom color', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-custom.gif',
			),
			'gradient'	=> array(
				'title' => _x( 'Custom gradient', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-custom-gradient.gif',
			),
		),
	);

		$options[] = array( "type" => "js_hide_begin", "class" => "buttons-hover_color_mode buttons-hover-mode-color" );
			$options["buttons-hover_color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "buttons-hover_color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);
		$options[] = array( "type" => "js_hide_end" );

		$options[] = array( "type" => "js_hide_begin", "class" => "buttons-hover_color_mode buttons-hover-mode-gradient" );
			$options["buttons-hover_color_gradient"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "buttons-hover_color_gradient",
				"std"	=> array( '#ffffff', '#000000' ),
				"type"	=> "gradient"
			);
		$options[] = array( "type" => "js_hide_end" );

	$options["buttons-text_color_mode"] = array(
		"name"		=> _x( "Text color", "theme-options", 'the7mk2' ),
		"id"		=> "buttons-text_color_mode",
		"std"		=> "color",
		'type'		=> 'images',
		'class'     => 'small',
		'divider'   => 'top',
		"show_hide"	=> array(
			'color' 	=> true
		),
		'options'	=> array(
			'accent'	=> array(
				'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-accent.gif',
			),
			'color'		=> array(
				'title' => _x( 'Custom color', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-custom.gif',
			),
		),
	);

		$options[] = array( "type" => "js_hide_begin" );
			$options["buttons-text_color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "buttons-text_color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);
		$options[] = array( "type" => "js_hide_end" );

	$options["buttons-text_hover_color_mode"] = array(
		"name"		=> _x( "Text hover color", "theme-options", 'the7mk2' ),
		"id"		=> "buttons-text_hover_color_mode",
		"std"		=> "color",
		'type'		=> 'images',
		'class'     => 'small',
		'divider'   => 'top',
		"show_hide"	=> array(
			'color' 	=> true
		),
		'options'	=> array(
			'accent'	=> array(
				'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-accent.gif',
			),
			'color'		=> array(
				'title' => _x( 'Custom color', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/color-custom.gif',
			),
		),
	);

		$options[] = array( "type" => "js_hide_begin" );
			$options["buttons-text_hover_color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "buttons-text_hover_color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);
		$options[] = array( "type" => "js_hide_end" );

$options[] = array( "type" => "block_end" );


/**
 * Small, Medium, Big Buttons.
 */

$buttons = presscore_themeoptions_get_buttons_defaults();

foreach ( $buttons as $id=>$opts ) {

	$options[] = array(	"name" => _x($opts['desc'], 'theme-options', 'the7mk2'), "type" => "block_begin" );

		///////////////////
		// Font family //
		///////////////////

		// select
		$options[] = array(
			"name"      => _x( 'Font-family', 'theme-options', 'the7mk2' ),
			"id"        => "buttons-{$id}_font_family",
			"std"       => (!empty($opts['ff']) ? $opts['ff'] : "Open Sans"),
			"type"      => "web_fonts",
			"fonts"     => 'all',
		);

		/////////////////
		// Font size //
		/////////////////

		// slider
		$options[] = array(
			"name"      => _x( 'Font-size', 'theme-options', 'the7mk2' ),
			"id"        => "buttons-{$id}_font_size",
			"std"       => $opts['fs'], 
			"type"      => "slider",
			"options"   => array( 'min' => 9, 'max' => 120 ),
			"sanitize"  => 'font_size'
		);

		/////////////////
		// Uppercase //
		/////////////////

		// checkbox
		$options[] = array(
			"name"      => _x( 'Capitalize', 'theme-options', 'the7mk2' ),
			"id"        => "buttons-{$id}_uppercase",
			"type"      => 'checkbox',
			'std'       => $opts['uc']
		);

		///////////////////
		// Line height //
		///////////////////

		// slider
		$options[] = array(
			"name"        => _x( 'Line-height', 'theme-options', 'the7mk2' ),
			"id"        => "buttons-{$id}_line_height",
			"std"        => $opts['lh'], 
			"type"        => "slider",
		);

		/////////////////////
		// Border radius //
		/////////////////////

		// input
		$options[] = array(
			"name"		=> _x( "Border Radius (px)", "theme-options", 'the7mk2' ),
			"id"		=> "buttons-{$id}_border_radius",
			"class"		=> "mini",
			"std"		=> $opts['border_radius'],
			"type"		=> "text",
			"sanitize"	=> "dimensions"
		);

	$options[] = array(	"type" => "block_end");
}
