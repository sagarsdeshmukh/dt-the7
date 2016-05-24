<?php
/**
 * Fonts
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title"    => _x( "Fonts", 'theme-options', 'the7mk2' ),
	"menu_title"    => _x( "Fonts", 'theme-options', 'the7mk2' ),
	"menu_slug"     => "of-fonts-menu",
	"type"          => "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Content Fonts', 'theme-options', 'the7mk2'), "type" => "heading" );

/**
 * Base font.
 */
$options[] = array( "name" => _x('Basic font', 'theme-options', 'the7mk2'), "type" => "block_begin" );

	// select
	$options[] = array(
		"desc"      => '',
		"name"      => _x( 'Choose basic font-family', 'theme-options', 'the7mk2' ),
		"id"        => "fonts-font_family",
		"std"       => "Open Sans",
		"type"      => "web_fonts",
		"fonts"     => 'all',
	);

	// font sizes
	$font_sizes = array(
		'big_size'   => array(
			'font_std' => 15,
			'font_desc' => _x( 'Large font size', 'theme-options', 'the7mk2' ),

			'lh_std' => 20,
			'lh_desc' => _x( 'Large line-height', 'theme-options', 'the7mk2' ),

			'msg' => _x( 'Default font for content area & most shortcodes.', 'theme-options', 'the7mk2' ),
		),

		'normal_size'   => array(
			'font_std' => 13,
			'font_desc' => _x( 'Medium font size', 'theme-options', 'the7mk2' ),

			'lh_std' => 20,
			'lh_desc' => _x( 'Medium line-height', 'theme-options', 'the7mk2' ),

			'msg' => _x( 'Default font for widgets in side bar & bottom bar. Can be chosen for some shortcodes.', 'theme-options', 'the7mk2' ),
		),

		'small_size'   => array(
			'font_std' => 11,
			'font_desc' => _x( 'Small font size', 'theme-options', 'the7mk2' ),

			'lh_std' => 20,
			'lh_desc' => _x( 'Small line-height', 'theme-options', 'the7mk2' ),

			'msg' => _x( 'Default font for bottom bar, breadcrumbs, some meta information etc. Can be chosen for some shortcodes.', 'theme-options', 'the7mk2' ),
		),
	);

	foreach ( $font_sizes as $id=>$data ) {

		$options[] = array( 'type' => 'divider' );

		$options[] = array(
			"type" => "info",
			"desc" => $data['msg'],
		);

		// slider
		$options[] = array(
			"desc"      => '',
			"name"      => $data['font_desc'],
			"id"        => "fonts-" . $id,
			"std"       => $data['font_std'], 
			"type"      => "slider",
			"options"   => array( 'min' => 9, 'max' => 120 ),
			"sanitize"  => 'font_size',
		);

		// slider
		$options[] = array(
			"desc"      => '',
			"name"      => $data['lh_desc'],
			"id"        => "fonts-" . $id . "_line_height",
			"std"       => $data['lh_std'], 
			"type"      => "slider",
			"options"   => array( 'min' => 9, 'max' => 120 )
		);

	}

$options[] = array( "type" => "block_end");

/**
 * Headers font.
 */
$options[] = array( "name" => _x('Headers fonts', 'theme-options', 'the7mk2'), "type" => "block_begin" );

	// headers
	$headers = presscore_themeoptions_get_headers_defaults();

	foreach ( $headers as $id=>$opts ) {

		// do not show divider for first header
		if ( $id != 'h1' ) {

			// divider
			$options[] = array(
				"type" => 'divider',
			);

		}

		// title
		$options[] = array( "name" => $opts['desc'], "type" => 'title' );

		if ( 'h4' == $id ) {
			$options[] = array(
				'desc' => _x( 'Default font for post titles in masonry, grid, list layouts and scrollers.', 'theme-options', 'the7mk2' ),
				'type' => 'info',
			);
		} elseif ( 'h5' == $id ) {
			$options[] = array(
				'desc' => _x( 'Default font for widget titles in sidebar & footer.', 'theme-options', 'the7mk2' ),
				'type' => 'info',
			);
		}

		// select
		$options[] = array(
			"name" => _x( 'Font-family', 'theme-options', 'the7mk2' ),
			"id" => "fonts-" . $id . "_font_family",
			"std" => (!empty($opts['ff']) ? $opts['ff'] : "Open Sans"),
			"type" => "web_fonts",
			"fonts" => 'all',
		);

		// slider
		$options[] = array(
			"name" => _x( 'Font-size', 'theme-options', 'the7mk2' ),
			"id" => "fonts-" . $id . "_font_size",
			"std" => $opts['fs'], 
			"type" => "slider",
			"options" => array( 'min' => 9, 'max' => 120 ),
			"sanitize" => 'font_size',
		);

		// slider
		$options[] = array(
			"name" => _x( 'Line-height', 'theme-options', 'the7mk2' ),
			"id" => "fonts-" . $id ."_line_height",
			"std" => $opts['lh'], 
			"type" => "slider",
		);

		// checkbox
		$options[] = array(
			"name" => _x( 'Capitalize', 'theme-options', 'the7mk2' ),
			"id" => 'fonts-' . $id . '_uppercase',
			"type" => 'checkbox',
			'std' => $opts['uc'],
		);

	}

$options[] = array( "type" => "block_end");
