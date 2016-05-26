<?php
/**
 * General.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Appearance', 'theme-options', 'the7mk2'), "type" => "heading" );

	/**
	 * Layout.
	 */
	$options[] = array(	"name" => _x('Layout', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// text
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x( 'Content width (in "px" or "%")', 'theme-options', 'the7mk2' ),
			"id"		=> "general-content_width",
			"std"		=> '1200px', 
			"type"		=> "text",
			"sanitize"	=> 'css_width'
		);

		// radio
		$options[] = array(
			"name"		=> _x('Layout', 'theme-options', 'the7mk2'),
			"id"		=> 'general-layout',
			"std"		=> 'wide',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'wide'    => array(
					'title' => _x( 'Wide', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-layout-wide.gif',
				),
				'boxed'    => array(
					'title' => _x( 'Boxed', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-layout-boxed.gif',
				),	
			),
			"show_hide"	=> array( "boxed" => true )
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin" );

			// text
			$options[] = array(
				"desc"		=> '',
				"name"		=> _x( 'Box width (in "px" or "%")', 'theme-options', 'the7mk2' ),
				"id"		=> "general-box_width",
				"std"		=> '1320px', 
				"type"		=> "text",
				"sanitize"	=> 'css_width'
			);

		$options[] = array( "type" => "js_hide_end" );

		$options[] = array( 'type' => 'divider' );

		// title
		$options[] = array(
			"type" => 'title',
			"name" => _x('Background under the box', 'theme-options', 'the7mk2')
		);

		// colorpicker
		$options[] = array(
			"name"	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
			"id"	=> "general-boxed_bg_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

		// background_img
		$options[] = array(
			'type' 			=> 'background_img',
			'id' 			=> 'general-boxed_bg_image',
			'name' 			=> _x( 'Add background image', 'theme-options', 'the7mk2' ),
			'std' 			=> array(
				'image'			=> '',
				'repeat'		=> 'repeat',
				'position_x'	=> 'center',
				'position_y'	=> 'center'
			),
		);

		// checkbox
		$options[] = array(
			"name"      => _x( 'Fullscreen ', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-boxed_bg_fullscreen',
			"type"  	=> 'checkbox',
			'std'   	=> 0
		);

		// Fixed background
		$options[] = array(
			"name"      => _x( 'Fixed background ', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-boxed_bg_fixed',
			"type"  	=> 'checkbox',
			'std'   	=> 0
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Background.
	 */
	$options[] = array(	"name" => _x('Background', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// colorpicker
		$options[] = array(
			"name"	=> _x( 'Color', 'theme-options', 'the7mk2' ),
			"id"	=> "general-bg_color",
			"std"	=> "#252525",
			"type"	=> "color"
		);

		// slider
		$options[] = array(
			"name"      => _x( 'Opacity', 'theme-options', 'the7mk2' ),
			"desc"      => _x( '"Opacity" isn\'t compatible with slide-out footer', 'theme-options', 'the7mk2' ),
			"id"        => "general-bg_opacity",
			"std"       => 100, 
			"type"      => "slider"
		);

		// background_img
		$options[] = array(
			'name' 			=> _x( 'Add background image', 'theme-options', 'the7mk2' ),
			'id' 			=> 'general-bg_image',
			'std' 			=> array(
				'image'			=> '',
				'repeat'		=> 'repeat',
				'position_x'	=> 'center',
				'position_y'	=> 'center'
			),
			'type'			=> 'background_img'
		);

		// checkbox
		$options[] = array(
			"name"      => _x( 'Fullscreen', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-bg_fullscreen',
			"type"  	=> 'checkbox',
			'std'   	=> 0
		);

		// Fixed background
		$options[] = array(
			"type"  	=> 'checkbox',
			"id"    	=> 'general-bg_fixed',
			"name"      => _x( 'Fixed background', 'theme-options', 'the7mk2' ),
			"desc"      => _x( '"Fixed" setting isn\'t compatible with "overlapping" title area style.', 'theme-options', 'the7mk2' ),
			'std'   	=> 0
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Content boxes.
	 */
	$options[] = array(	"name" => _x('Content boxes', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// colorpicker
		$options[] = array(
			"name"	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
			"id"	=> "general-content_boxes_bg_color",
			"std"	=> "#FFFFFF",
			"type"	=> "color"
		);

		// slider
		$options[] = array(
			"name"      => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
			"id"        => "general-content_boxes_bg_opacity",
			"std"       => 100, 
			"type"      => "slider"
		);

		// radio
		$options[] = array(
			"name"		=> _x( "Decoration", "theme-options", 'the7mk2' ),
			"id"		=> "general-content_boxes_decoration",
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
				"id"	=> "general-content_boxes_decoration_outline_color",
				"std"	=> "#FFFFFF",
				"type"	=> "color"
			);

			// slider
			$options[] = array(
				"name"      => _x( 'Decoration outline opacity', 'theme-options', 'the7mk2' ),
				"id"        => "general-content_boxes_decoration_outline_opacity",
				"std"       => 100, 
				"type"      => "slider"
			);

		$options[] = array( "type" => "js_hide_end" );

	$options[] = array(	"type" => "block_end");

	/**
	 * Categorization, sorting & pagination style.
	 */
	$options[] = array(	"name" => _x('Categorization, sorting & pagination style', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		$options['general-filter_style'] = array(
			'id'      => 'general-filter_style',
			'name'    => _x( 'Style', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'     => 'ios',
			'options' => array(
				'ios'      => array(
					'title' => _x( 'iOS', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-filter_style-ios.gif',
				),
				'minimal'  => array(
					'title' => _x( 'Minimal', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-filter_style-minimal.gif',
				),
				'material' => array(
					'title' => _x( 'Material design', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-filter_style-material.gif',
				),
			),
		);

		$options[] = array( 'type' => 'divider' );

		$options['general-filter-font-family'] = array(
			'id'        => 'general-filter-font-family',
			'name'      => _x( 'Font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Open Sans',
			'fonts'     => 'all',
		);

		$options['general-filter-font-size'] = array(
			'id'        => 'general-filter-font-size',
			'name'      => _x( 'Font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'sanitize'  => 'font_size',
			'std'       => 16, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
		);

		$options['general-filter-line_height'] = array(
			'id'        => 'general-filter-line_height',
			'name'      => _x( 'Line height', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'std'       => 20, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
		);

		$options['general-filter_ucase'] = array(
			'id'   => 'general-filter_ucase',
			'name' => _x( 'Capitalize', 'theme-options', 'the7mk2' ),
			'type' => 'checkbox',
			'std'  => 0,
		);

		$options[] = array( 'type' => 'divider' );

		presscore_options_apply_template( $options, 'indents', 'general-filter-padding', array(
			'left'   => array( 'std' => '5' ),
			'right'  => array( 'std' => '5' ),
			'top'    => array( 'std' => '5' ),
			'bottom' => array( 'std' => '5' ),
		) );

		presscore_options_apply_template( $options, 'indents-margins', 'general-filter-margin', array(
			'left'   => array(  'std' => '5' ),
			'right'  => array(  'std' => '5' ),
		) );

	$options[] = array(	"type" => "block_end");

	/**
	 * Text.
	 */
	$options[] = array(	"name" => _x('Text', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// colorpicker
		$options[] = array(
			"desc" => '',
			"name"	=> _x( 'Headers color', 'theme-options', 'the7mk2' ),
			"id"	=> "content-headers_color",
			"std"	=> "#252525",
			"type"	=> "color"
		);

		// colorpicker
		$options[] = array(
			"desc" => '',
			"name"	=> _x( 'Text color', 'theme-options', 'the7mk2' ),
			"id"	=> "content-primary_text_color",
			"std"	=> "#686868",
			"type"	=> "color"
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Color Accent.
	 */
	$options[] = array(	"name" => _x('Color Accent', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options["general-accent_color_mode"] = array(
			"name"		=> _x( "Accent color", "theme-options", 'the7mk2' ),
			"id"		=> "general-accent_color_mode",
			"std"		=> "color",
			'type'		=> 'images',
			'class'     => 'small',
			"show_hide"	=> array(
				'color' 	=> "general-accent_color_mode-color",
				'gradient'	=> "general-accent_color_mode-gradient"
			),
			'options'	=> array(
				'color'		=> array(
					'title' => _x( 'Solid color', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/color-accent.gif',
				),
				'gradient'	=> array(
					'title' => _x( 'Gradient', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/color-custom-gradient.gif',
				),
			),
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "general-accent_color_mode general-accent_color_mode-color" );

			// colorpicker
			$options["general-accent_bg_color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "general-accent_bg_color",
				"std"	=> "#D73B37",
				"type"	=> "color"
			);

		$options[] = array( "type" => "js_hide_end" );

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "general-accent_color_mode general-accent_color_mode-gradient" );

			// colorpicker
			$options["general-accent_bg_color_gradient"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "general-accent_bg_color_gradient",
				"std"	=> array( '#ffffff', '#000000' ),
				"type"	=> "gradient"
			);

		$options[] = array( "type" => "js_hide_end" );

	$options[] = array(	"type" => "block_end");

	/**
	 * Border radius.
	 */
	$options[] = array(	"name" => _x('Border radius', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// input
		$options[] = array(
			"name"		=> _x( 'Border Radius (px)', 'theme-options', 'the7mk2' ),
			"id"		=> 'general-border_radius',
			"std"		=> '8',
			"type"		=> 'text',
			"sanitize"	=> 'dimensions'
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Icons.
	 */
	$options[] = array(	"name" => _x('Icons', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// input
		$options['general-icons_style'] = array(
			"name"		=> _x( 'Icons', 'theme-options', 'the7mk2' ),
			"id"		=> 'general-icons_style',
			"std"		=> 'light',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'light'		=> array(
					'title' => _x( 'Light', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-icons_style-light.gif',
				),
				'bold'		=> array(
					'title' => _x( 'Bold', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-icons_style-bold.gif',
				),
			),
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Contact form.
	 */
	$options[] = array(	"name" => _x('Contact form', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"		=> _x( "Style", "theme-options", 'the7mk2' ),
			"id"		=> "general-contact_form_style",
			'type'		=> 'images',
			'class'     => 'small',
			"std"		=> "ios",
			'options'	=> array(
				'ios'		=> array(
					'title' => _x( 'iOS', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-contact_form_style-ios.gif',
				),
				'minimal'	=> array(
					'title' => _x( 'Minimal', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-contact_form_style-minimal.gif',
				),
				'material'	=> array(
					'title' => _x( 'Material design', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-contact_form_style-material.gif',
				),
			),
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Fancy datas in blog lists.
	 */
	$options[] = array(	"name" => _x('Fancy datas in blog lists', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"		=> _x( "Size", "theme-options", 'the7mk2' ),
			"id"		=> "general-fancy_date_size",
			'type'		=> 'images',
			'class'     => 'small',
			"std"		=> "big",
			'options'	=> array(
				'big'		=> array(
					'title' => _x( 'Large', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-fancy_date_size-large.gif',
				),
				'small'		=> array(
					'title' => _x( 'Small', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-fancy_date_size-small.gif',
				),
			),
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Slideshow bullets.
	 */
	$options[] = array(	"name" => _x('Slideshow bullets', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"		=> _x( "Style", "theme-options", 'the7mk2' ),
			"id"		=> "general-slideshow_bullets_style",
			'type'		=> 'images',
			'class'     => 'small',
			"std"		=> "outline",
			'options'	=> array(
				'transparent'	=> array(
					'title' => _x( 'Semitransparent', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-slideshow_bullets_style-semi.gif',
				),
				'accent'		=> array(
					'title' => _x( 'Accent color', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-slideshow_bullets_style-accent.gif',
				),
				'outline'		=> array(
					'title' => _x( 'Outlines', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-slideshow_bullets_style-outlines.gif',
				),
			)
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Beautiful loading.
	 */
	$options[] = array( 'name' => _x( 'Beautiful loading', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-beautiful_loading'] = array(
			'name' => _x( 'Beautiful loading', 'theme-options', 'the7mk2' ),
			'id' => 'general-beautiful_loading',
			'type'		=> 'images',
			'class'     => 'small',
			'std' => 'enabled',
			'options' => array(
				'enabled' => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-beautiful_loading-enabled.gif',
				),
				'disabled' => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-beautiful_loading-disabled.gif',
				),
			),
			'show_hide'	=> array( 'enabled' => true ),
		);

		$options[] = array( 'type' => 'js_hide_begin' );

			$options['general-fullscreen_overlay_color_mode'] = array(
				'name' => _x( 'Fullscreen overlay color', 'theme-options', 'the7mk2' ),
				'id' => 'general-fullscreen_overlay_color_mode',
				'type'		=> 'images',
				'class'     => 'small',
				'std' => 'accent',
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

			$options['general-fullscreen_overlay_color'] = array(
				'name' => _x( 'Fullscreen overlay custom color', 'theme-options', 'the7mk2' ),
				'id' => 'general-fullscreen_overlay_color',
				'dependency' => array(
					array(
						array(
							'field' => 'general-fullscreen_overlay_color_mode',
							'operator' => '==',
							'value' => 'color',
						),
						array(
							'field' => 'general-beautiful_loading',
							'operator' => '==',
							'value' => 'enabled',
						),
					),
				),
				'type' => 'color',
				'std' => '#ffffff',
			);

			$options['general-fullscreen_overlay_gradient'] = array(
				'name' => _x( 'Fullscreen overlay custom gradient', 'theme-options', 'the7mk2' ),
				'id' => 'general-fullscreen_overlay_gradient',
				'dependency' => array(
					array(
						array(
							'field' => 'general-fullscreen_overlay_color_mode',
							'operator' => '==',
							'value' => 'gradient',
						),
						array(
							'field' => 'general-beautiful_loading',
							'operator' => '==',
							'value' => 'enabled',
						),
					),
				),
				'type' => 'gradient',
				'std' => array(
					0 => '#ffffff',
					1 => '#ffffff',
				),
			);

			$options['general-fullscreen_overlay_opacity'] = array(
				'name' => _x( 'Fullscreen overlay opacity', 'theme-options', 'the7mk2' ),
				'id' => 'general-fullscreen_overlay_opacity',
				'type' => 'slider',
				'std' => 100,
				'options' => array(
					'max' => 100,
					'min' => 0,
					'step' => 1,
				),
			);

			$options['general-spinner_color'] = array(
				'name' => _x( 'Spinner color', 'theme-options', 'the7mk2' ),
				'id' => 'general-spinner_color',
				'type' => 'color',
				'std' => '#ffffff',
			);

			$options['general-spinner_opacity'] = array(
				'name' => _x( 'Spinner opacity', 'theme-options', 'the7mk2' ),
				'id' => 'general-spinner_opacity',
				'type' => 'slider',
				'std' => 100,
				'options' => array(
					'max' => 100,
					'min' => 0,
					'step' => 1,
				),
			);

			$options['general-loader_style'] = array(
				'name' => _x( 'Loader style', 'theme-options', 'the7mk2' ),
				'id' => 'general-loader_style',
				'type' => 'radio',
				'std' => 'double_circles',
				'options' => array(
					'double_circles' => _x( 'Spinner', 'theme-options', 'the7mk2' ),
					'square_jelly_box' => _x( 'Ring', 'theme-options', 'the7mk2' ),
					'ball_elastic_dots' => _x( 'Bars', 'theme-options', 'the7mk2' ),
					'custom' => _x( 'Custom', 'theme-options', 'the7mk2' ),
				),
				'show_hide' => array( 'custom' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options[] = array(
					'desc' => _x( 'Paste HTML code of your custom pre-loader image in the field below.', 'theme-options', 'the7mk2' ),
					'type' => 'info',
				);

				$options['general-custom_loader'] = array(
					'id' => 'general-custom_loader',
					'type' => 'textarea',
					'std' => false,
					'sanitize' => 'without_sanitize',
					'settings' => array( 'rows' => 8 ),
				);

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Custom CSS", "theme-options", 'the7mk2'), "type" => "heading" );

	/**
	 * Custom css
	 */
	$options[] = array(	"name" => _x('Custom CSS', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// textarea
		$options[] = array(
			"settings"	=> array( 'rows' => 16 ),
			"id"		=> "general-custom_css",
			"std"		=> false,
			"type"		=> 'textarea',
			"sanitize"	=> 'without_sanitize'
		);

	$options[] = array(	"type" => "block_end");


/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Advanced", "theme-options", 'the7mk2'), "type" => "heading" );

	/**
	 * Responsive.
	 */
	$options[] = array(	"name" => _x('Responsiveness', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"		=> _x('Responsive layout', 'theme-options', 'the7mk2'),
			"id"		=> 'general-responsive',
			"std"		=> '1',
			"type"		=> 'radio',
			'show_hide'	=> array( '1' => true ),
			"options"	=> $en_dis_options
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin" );

			$options[] = array( "type" => "divider" );

			// input
			$options[] = array(
				"name"		=> _x( "Collapse content to one column after (px)", "theme-options", 'the7mk2' ),
				"desc"		=> _x( "does not affect VC columns", "theme-options", 'the7mk2' ),
				"id"		=> "general-responsiveness-treshold",
				"std"		=> 800,
				"type"		=> "text",
				"class"		=> "mini",
				"sanitize"	=> "dimensions"
			);

		$options[] = array( "type" => "js_hide_end" );

		$options[] = array( 'type' => 'divider' );

		$options[] = array(
			"type" => 'title',
			"name" => _x('Side paddings', 'theme-options', 'the7mk2')
		);

		$options['general-side_content_paddings'] = array(
			'name' => _x( 'Side paddings (px)', 'theme-options', 'the7mk2' ),
			'id' => 'general-side_content_paddings',
			'std' => '40', 
			'type' => 'text',
			'sanitize' => 'dimensions',
		);

		$options['general-switch_content_paddings'] = array(
			'name' => _x( 'When screen width is less then.. (px)', 'theme-options', 'the7mk2' ),
			'id' => 'general-switch_content_paddings',
			'std' => '640', 
			'type' => 'text',
			'sanitize' => 'dimensions',
		);

		$options['general-mobile_side_content_paddings'] = array(
			'name' => _x( '..make paddings (px)', 'theme-options', 'the7mk2' ),
			'id' => 'general-mobile_side_content_paddings',
			'std' => '20', 
			'type' => 'text',
			'sanitize' => 'dimensions',
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Images lazy loading.
	 */
	$options[] = array(	"name" => _x('Images lazy loading', 'theme-options', 'the7mk2'), "type" => "block" );

		$options['general-images_lazy_loading'] = array(
			"id"		=> 'general-images_lazy_loading',
			"name"		=> _x('Images lazy loading', 'theme-options', 'the7mk2'),
			"desc"		=> _x('Can dramatically reduce page loading speed. Recommended.', 'theme-options', 'the7mk2'),
			"std"		=> '1',
			"type"		=> 'radio',
			"options"	=> array(
				'1' => _x('Enabled', 'theme-options', 'the7mk2'),
				'0' => _x('Disabled', 'theme-options', 'the7mk2'),
			)
		);

	/**
	 * Smooth scroll.
	 */
	$options[] = array(	"name" => _x('Smooth scroll', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"		=> _x('Enable "scroll-behaviour: smooth" for next gen browsers', 'theme-options', 'the7mk2'),
			"id"		=> 'general-smooth_scroll',
			"std"		=> 'on',
			"type"		=> 'radio',
			"options"	=> array(
				'on'			=> _x( 'Yes', 'theme-options', 'the7mk2' ),
				'off'			=> _x( 'No', 'theme-options', 'the7mk2' ),
				'on_parallax'	=> _x( 'On only on pages with parallax', 'theme-options', 'the7mk2' )
			)
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Slugs
	 */
	$options[] = array( "name" => _x("Slugs", "theme-options", 'the7mk2'), "type" => "block_begin" );

		$options['posts_slugs_placeholder'] = array();

	$options[] = array( "type" => "block_end" );

	/**
	 * Contact form sends emails to:.
	 */
	$options[] = array( "name" => _x("Contact form sends emails to:", "theme-options", 'the7mk2'), "type" => "block_begin" );

		// input
		$options[] = array(
			"name"		=> '&nbsp;',
			"id"		=> "general-contact_form_send_mail_to",
			"std"		=> "",
			"type"		=> "text",
			"sanitize"	=> 'email'
			// "class"		=> "mini",
		);

	$options[] = array( "type" => "block_end" );

	/**
	 * Plugins notifications.
	 */
	$options[] = array( "name" => _x("Plugins notifications", "theme-options", 'the7mk2'), "type" => "block_begin" );

		// checkbox
		$options[] = array(
			"name"      => _x( 'Silence plugins activation notifications', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-hide_plugins_notifications',
			"type"  	=> 'checkbox',
			'std'   	=> 1
		);

	$options[] = array( "type" => "block_end" );

	/**
	 * Tracking code
	 */
	$options[] = array(	"name" => _x('Tracking code (e.g. Google analytics) or arbitrary JavaScript', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// textarea
		$options[] = array(
			"settings"	=> array( 'rows' => 16 ),
			"id"		=> "general-tracking_code",
			"std"		=> false,
			"type"		=> 'textarea',
			"sanitize"	=> 'without_sanitize'
		);

	$options[] = array(	"type" => "block_end");
