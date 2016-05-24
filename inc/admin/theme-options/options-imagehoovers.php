<?php
/**
 * Image Hovers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Images Styling &amp; Hovers', 'theme-options', 'the7mk2'), "type" => "heading" );

/**
 * Styling.
 */
$options[] = array(	"name" => _x('Styling', 'theme-options', 'the7mk2'), "type" => "block" );

	// radio
	$options['image_hover-style'] = array(
		"name"		=> _x('Image &amp; hover decoration', 'theme-options', 'the7mk2'),
		"desc"		=> _x('May not have effect on some portfolio, photo albums and shortcodes image hovers.', 'theme-options', 'the7mk2'),
		"id"		=> 'image_hover-style',
		"std"		=> 'none',
		'type'		=> 'images',
		'class'     => 'small',
		'options'	=> array(
			'none' => array(
				'title' => _x('None', 'theme-options', 'the7mk2'),
				'src' => '/inc/admin/assets/images/image_hover-style-none.gif',
			),
			'grayscale' => array(
				'title' => _x('Grayscale', 'theme-options', 'the7mk2'),
				'src' => '/inc/admin/assets/images/image_hover-style-grayscale.gif',
			),
			'gray_color' => array(
				'title' => _x('Grayscale with color hovers', 'theme-options', 'the7mk2'),
				'src' => '/inc/admin/assets/images/image_hover-style-grayscale-with-color-hover.gif',
			),
			'blur' => array(
				'title' => _x('Blur', 'theme-options', 'the7mk2'),
				'src' => '/inc/admin/assets/images/image_hover-style-blur.gif',
			),
			'scale' => array(
				'title' => _x('Scale', 'theme-options', 'the7mk2'),
				'src' => '/inc/admin/assets/images/image_hover-style-scale.gif',
			),
		),
	);

	// checkbox
	$options['image_hover-onclick_animation'] = array(
		"name"      => _x( 'Animation on click', 'theme-options', 'the7mk2' ),
		"id"    	=> 'image_hover-onclick_animation',
		"type"  	=> 'checkbox',
		'std'   	=> 1
	);

/**
 * Hover color.
 */
$options[] = array(	"name" => _x('Default image hovers', 'theme-options', 'the7mk2'), "type" => "block" );

	$options["image_hover-default_icon"] = array(
		"name"		=> _x( "Icon", "theme-options", 'the7mk2' ),
		"id"		=> "image_hover-default_icon",
		"std"		=> "none",
		'type'		=> 'images',
		'class'     => 'small',
		'options'	=> array(
			'none'			=> array(
				'title' => _x( 'No icon', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/image_hover-style-grayscale.gif',
			),
			'small_corner'	=> array(
				'title' => _x( 'Small icon in the corner', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/image_hover-default_icon-small-icon.gif',
			),
			'big_center'	=> array(
				'title' => _x( 'Large centered icon', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/image_hover-default_icon-large-icon.gif',
			),
		)
	);

	// radio
	$options["image_hover-color_mode"] = array(
		"name"		=> _x( "Hovers background color", "theme-options", 'the7mk2' ),
		"id"		=> "image_hover-color_mode",
		"std"		=> "accent",
		'type'		=> 'images',
		'class'     => 'small',
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

		// colorpicker
		$options["image_hover-color"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "image_hover-color",
			"std"	=> "#ffffff",
			"type"	=> "color",
			"dependency" => array(
				array(
					array(
						'field' => 'image_hover-color_mode',
						'operator' => '==',
						'value' => 'color',
					)
				),
			),
		);

		// colorpicker
		$options["image_hover-color_gradient"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "image_hover-color_gradient",
			"std"	=> array( '#ffffff', '#000000' ),
			"type"	=> "gradient",
			"dependency" => array(
				array(
					array(
						'field' => 'image_hover-color_mode',
						'operator' => '==',
						'value' => 'gradient',
					)
				),
			),
		);

	// slider
	$options["image_hover-opacity"] = array(
		"name"      => _x( 'Hovers background opacity', 'theme-options', 'the7mk2' ),
		"id"        => "image_hover-opacity",
		"std"       => 30, 
		"type"      => "slider"
	);

/**
 * Hover opacity.
 */
$options[] = array(	"name" => _x('Portfolio &amp; photo albums hovers', 'theme-options', 'the7mk2'), "type" => "block" );

	// redio
	$options["image_hover-project_icons_style"] = array(
		"name"		=> _x( "Icons on hover in portfolio", "theme-options", 'the7mk2' ),
		"id"		=> "image_hover-project_icons_style",
		"std"		=> "accent",
		'type'		=> 'images',
		'class'     => 'small',
		'options'	=> array(
			'outline'		=> array(
				'title' => _x( 'Outline', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/image_hover-project_icons_style-outline.gif',
			),
			'transparent'	=> array(
				'title' => _x( 'Semitransparent', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/image_hover-project_icons_style-semitransp.gif',
			),
			'accent'		=> array(
				'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/image_hover-project_icons_style-accent.gif',
			),
			'small'			=> array(
				'title' => _x( 'Small', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/image_hover-project_icons_style-small.gif',
			),
		),
	);

	// radio
	$options["image_hover-album_miniatures_style"] = array(
		"name"		=> _x( "Image minuatures on hover in photo albums", "theme-options", 'the7mk2' ),
		"id"		=> "image_hover-album_miniatures_style",
		"style"		=> "vertical",
		"std"		=> "style_1",
		'type'		=> 'images',
		'class'     => 'small',
		'options'	=> array(
			'style_1'	=> array(
				'title' => _x( 'Overlapping miniatures of a different size', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/image_hover-album_miniatures_style-1.gif',
			),
			'style_2'	=> array(
				'title' => _x( 'Three miniatures in a row', 'theme-options', 'the7mk2' ),
				'src' => '/inc/admin/assets/images/image_hover-album_miniatures_style-2.gif',
			),
		),
	);

	// radio
	$options["image_hover-project_rollover_color_mode"] = array(
		"name"		=> _x( "Hovers background color", "theme-options", 'the7mk2' ),
		"id"		=> "image_hover-project_rollover_color_mode",
		"std"		=> "accent",
		'type'		=> 'images',
		'class'     => 'small',
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

		// colorpicker
		$options["image_hover-project_rollover_color"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "image_hover-project_rollover_color",
			"std"	=> "#ffffff",
			"type"	=> "color",
			"dependency" => array(
				array( 
					array(
						'field' => 'image_hover-project_rollover_color_mode',
						'operator' => '==',
						'value' => 'color',
					),
				),
			),
		);

		// colorpicker
		$options["image_hover-project_rollover_color_gradient"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "image_hover-project_rollover_color_gradient",
			"std"	=> array( '#ffffff', '#000000' ),
			"type"	=> "gradient",
			"dependency" => array(
				array( 
					array(
						'field' => 'image_hover-project_rollover_color_mode',
						'operator' => '==',
						'value' => 'gradient',
					),
				),
			),
		);

	// slider
	$options['image_hover-project_rollover_opacity'] = array(
		"name"		=> _x( 'Hovers background opacity', 'theme-options', 'the7mk2' ),
		"id"		=> "image_hover-project_rollover_opacity",
		"std"		=> 70, 
		"type"		=> "slider",
	);
