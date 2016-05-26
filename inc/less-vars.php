<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Compilled less special cases.
 *
 */
function presscore_new_compilled_less_special_cases( $options = array() ) {
	// @todo remove this!
	$options['bottom-divider-bg-color'] = 'rgba(56, 57, 58, 1)';
	$options['bottom-divider-bg-color-ie'] = 'rgb(56, 57, 58)';

	return $options;
}
add_filter( 'presscore_compiled_less_vars', 'presscore_new_compilled_less_special_cases', 16 );

function presscore_action_add_less_vars( $less_vars ) {

	/*
	DEPRECATED VARS

	@text-near-logo-color = 'header-near_logo_bg_color'
	@padding-side = 'header-side_paddings'
	@menu-divider-bg
	@menu-paddings = 'menu-top_bottom_paddings'
	@menu-item-distance = 'menu-items_distance'
	@submenu-item-distance = 'submenu-items_distance'
	@mobile-menu-bg-color = 'header-mobile-menu_color-background'
	@mobile-menu-color = 'header-mobile-menu_color-text'
	@divider-thick-switch = 'general-thick_divider_style', 'style-1'
	@divider-thick-bread-switch = implode('-', current(array_chunk(explode('-', @divider-thick-switch ), 2)) )
	@divider-thin-height
	@divider-thin-style
	@main-slideshow-bg-color
	@main-slideshow-bg-color-ie
	@main-slideshow-bg-image
	@main-slideshow-bg-repeat
	@main-slideshow-bg-position-x
	@main-slideshow-bg-position-y
	@main-slideshow-bg-size

	 */

	// setup accent colors
	$_accent_color = presscore_less_get_accent_colors( $less_vars );

	$less_vars->add_rgba_color(
		array( 'beautiful-loading-bg', 'beautiful-loading-bg-2' ),
		presscore_less_get_conditional_colors(
			array( 'general-fullscreen_overlay_color_mode' ),
			array( 'general-fullscreen_overlay_color', '#ffffff' ),
			array( 'general-fullscreen_overlay_gradient', array( '#ffffff', '#000000' ) ),
			$_accent_color
		),
		of_get_option( 'general-fullscreen_overlay_opacity' )
	);

	/**
	 * Header & Top Bar -> Top bar
	 */

	$less_vars->add_font(
		array(
			'top-bar-font-family',
			'top-bar-font-weight',
			'top-bar-font-style',
		),
		of_get_option( 'top_bar-font-family' )
	);

	$less_vars->add_pixel_number(
		'top-bar-font-size',
		of_get_option( 'top_bar-font-size', '16' )
	);

	$less_vars->add_keyword(
		'top-bar-text-transform',
		( of_get_option( 'top_bar-font-is_capitalized' ) ? 'uppercase' : 'none' )
	);

	$less_vars->add_hex_color(
		'top-color',
		of_get_option( 'top_bar-font-color' )
	);

	$less_vars->add_pixel_number(
		'top-bar-padding-top',
		of_get_option( 'top_bar-paddings-top' )
	);

	$less_vars->add_pixel_number(
		'top-bar-padding-bottom',
		of_get_option( 'top_bar-paddings-bottom' )
	);

	$less_vars->add_pixel_number(
		'top-bar-side-paddings',
		of_get_option( 'top_bar-paddings-horizontal' )
	);

	$less_vars->add_rgba_color(
		'top-bg-color',
		of_get_option( 'top_bar-bg-color' ),
		of_get_option( 'top_bar-bg-opacity' )
	);

	$less_vars->add_image(
		array(
			'top-bg-image',
			'top-bg-repeat',
			'top-bg-position-x',
			'top-bg-position-y',
		),
		of_get_option( 'top_bar-bg-image' )
	);

	if ( 'color' == of_get_option( 'header-elements-soc_icons-bg' ) ) {
		$less_vars->add_rgba_color(
			array( 'top-icons-bg-color', 'top-icons-bg-color-2' ),
			array( of_get_option( 'header-elements-soc_icons-bg-color' ), '' ),
			of_get_option( 'header-elements-soc_icons-bg-opacity' )
		);
	} else {
		$less_vars->add_hex_color(
			array( 'top-icons-bg-color', 'top-icons-bg-color-2' ),
			presscore_less_get_conditional_colors(
				array( 'header-elements-soc_icons-bg' ),
				array( 'header-elements-soc_icons-bg-color', '#ffffff' ),
				array( 'header-elements-soc_icons-bg-gradient', array( '#ffffff', '#000000' ) ),
				$_accent_color
			)
		);
	}

	if ( 'color' == of_get_option( 'header-elements-soc_icons-hover-bg' ) ) {
		$less_vars->add_rgba_color(
			array( 'top-icons-bg-color-hover', 'top-icons-bg-color-hover-2' ),
			array( of_get_option( 'header-elements-soc_icons-hover-bg-color' ), '' ),
			of_get_option( 'header-elements-soc_icons-bg-hover-opacity' )
		);
	} else {
		$less_vars->add_hex_color(
			array( 'top-icons-bg-color-hover', 'top-icons-bg-color-hover-2' ),
			presscore_less_get_conditional_colors(
				array( 'header-elements-soc_icons-hover-bg' ),
				array( 'header-elements-soc_icons-hover-bg-color', '#ffffff' ),
				array( 'header-elements-soc_icons-hover-bg-gradient', array( '#ffffff', '#000000' ) ),
				$_accent_color
			)
		);
	}

	/**
	 * Header & Top Bar -> Header
	 */

	$less_vars->add_rgba_color(
		'header-decoration',
		of_get_option( "header-decoration-color" ),
		of_get_option( "header-decoration-opacity" )
	);

	$less_vars->add_rgba_color(
		'header-bg-color',
		of_get_option( "header-bg-color" ),
		of_get_option( "header-bg-opacity" )
	);

	$less_vars->add_image(
		array(
			'header-bg-image',
			'header-bg-repeat',
			'header-bg-position-x',
			'header-bg-position-y',
		),
		of_get_option( 'header-bg-image' )
	);

	$less_vars->add_keyword(
		'header-bg-size',
		( of_get_option( 'header-bg-is_fullscreen' ) ? 'cover' : 'auto' )
	);

	// fix bg repeat
	if ( 'cover' === $less_vars->get_var( 'header-bg-size' ) ) {
		$less_vars->add_keyword( 'header-bg-repeat', 'no-repeat' );
	}

	$less_vars->add_keyword(
		'header-bg-attachment',
		( of_get_option( 'header-bg-is_fixed' ) ? 'fixed' : '~""' )
	);

	$less_vars->add_rgba_color(
		'navigation-line-decoration-color',
		of_get_option( "header-mixed-decoration-color" ),
		of_get_option( "header-mixed-decoration-opacity" )
	);

	$less_vars->add_rgba_color(
		'navigation-line-bg',
		of_get_option( "header-mixed-bg-color" ),
		of_get_option( "header-mixed-bg-opacity" )
	);

	$less_vars->add_hex_color(
		'toggle-menu-color',
		of_get_option( "header-menu_icon-color" )
	);

	$less_vars->add_rgba_color(
		'toggle-menu-bg-color',
		of_get_option( "header-menu_icon-bg-color" ),
		of_get_option( "header-menu_icon-bg-opacity" )
	);

	$less_vars->add_hex_color(
		'toggle-menu-hover-color',
		of_get_option( "header-menu_icon-hover-color" )
	);

	$less_vars->add_rgba_color(
		'toggle-menu-hover-bg-color',
		of_get_option( "header-menu_icon-hover-bg-color" ),
		of_get_option( "header-menu_icon-hover-bg-opacity" )
	);

	$less_vars->add_rgba_color(
		'navigation-bg-color',
		of_get_option( "header-classic-menu-bg-color" ),
		of_get_option( "header-classic-menu-bg-opacity" )
	);

	$less_vars->add_rgba_color(
		'overlay-cursor-color',
		of_get_option( 'header-slide_out-overlay-x_cursor-color', '#000000' ),
		of_get_option( 'header-slide_out-overlay-x_cursor-opacity', '90' )
	);

	$less_vars->add_rgba_color(
		array( 'sticky-header-overlay-bg', 'sticky-header-overlay-bg-2' ),
		presscore_less_get_conditional_colors(
			array( 'header-slide_out-overlay-bg-color-style' ),
			array( 'header-slide_out-overlay-bg-color', '#ffffff' ),
			array( 'header-slide_out-overlay-bg-gradient', array( '#ffffff', '#000000' ) ),
			$_accent_color
		),
		of_get_option( "header-slide_out-overlay-bg-opacity" )
	);

	foreach ( array( 'top', 'right', 'bottom', 'left' ) as $indent ) {
		$less_vars->add_pixel_number( "toggle-menu-{$indent}-margin", of_get_option( "header-menu_icon-margin-{$indent}", '0' ) );
	}

	unset( $indent );

	$less_vars->add_pixel_number(
		'toggle-menu-border-radius',
		of_get_option( 'header-menu_icon-bg-border-radius', '0' )
	);

	/**
	 * Header & Top Bar -> Floating navigation
	 */

	$less_vars->add_pixel_number(
		'float-menu-height',
		of_get_option( 'header-floating_navigation-height', '100' )
	);

	$less_vars->add_rgba_color(
		'float-menu-bg',
		of_get_option( 'header-floating_navigation-bg-color' ),
		of_get_option( 'header-floating_navigation-bg-opacity' )
	);

	$less_vars->add_rgba_color(
		'float-menu-line-decoration-color',
		of_get_option( 'header-floating_navigation-decoration-color' ),
		of_get_option( 'header-floating_navigation-decoration-opacity' )
	);

	/**
	 * Header & Top Bar -> Main menu
	 */

	$less_vars->add_font(
		array(
			'menu-font-family',
			'menu-font-weight',
			'menu-font-style',
		),
		of_get_option( 'header-menu-font-family' )
	);

	$less_vars->add_pixel_number(
		'menu-font-size',
		of_get_option( 'header-menu-font-size', '16' )
	);

	$less_vars->add_pixel_number(
		'outside-item-custom-margin',
		of_get_option( 'header-menu-item-surround_margins-custom-margin' )
	);

	$less_vars->add_keyword(
		'menu-text-transform',
		( of_get_option( 'header-menu-font-is_capitalized' ) ? 'uppercase' : 'none' )
	);

	$less_vars->add_font(
		array(
			'subtitle-font-family',
			'subtitle-font-weight',
			'subtitle-font-style',
		),
		of_get_option( 'header-menu-subtitle-font-family' )
	);

	$less_vars->add_pixel_number(
		'subtitle-font-size',
		of_get_option( 'header-menu-subtitle-font-size', '10' )
	);

	$less_vars->add_hex_color(
		'menu-color',
		of_get_option( 'header-menu-font-color', '#ffffff' )
	);

	$less_vars->add_pixel_number(
		'main-menu-icon-size',
		of_get_option( 'header-menu-icon-size', '16' )
	);

	// paddings
	$less_vars->add_pixel_number(
		'menu-item-padding-left',
		of_get_option( 'header-menu-item-padding-left', '10' )
	);

	$less_vars->add_pixel_number(
		'menu-item-padding-right',
		of_get_option( 'header-menu-item-padding-right', '10' )
	);

	$less_vars->add_pixel_number(
		'menu-item-padding-top',
		of_get_option( 'header-menu-item-padding-top', '5' )
	);

	$less_vars->add_pixel_number(
		'menu-item-padding-bottom',
		of_get_option( 'header-menu-item-padding-bottom', '5' )
	);

	// margins
	$less_vars->add_pixel_number(
		'menu-item-margin-left',
		of_get_option( 'header-menu-item-margin-left', '0' )
	);

	$less_vars->add_pixel_number(
		'menu-item-margin-right',
		of_get_option( 'header-menu-item-margin-right', '0' )
	);

	$less_vars->add_pixel_number(
		'menu-item-margin-top',
		of_get_option( 'header-menu-item-margin-top', '0' )
	);

	$less_vars->add_pixel_number(
		'menu-item-margin-bottom',
		of_get_option( 'header-menu-item-margin-bottom', '0' )
	);

	if ( 'custom' === of_get_option( 'header-menu-dividers-height-style' ) ) {

		$less_vars->add_pixel_number(
			'menu-tem-divider-height',
			of_get_option( 'header-menu-dividers-height', '20' )
		);

	} else {

		$less_vars->add_percent_number(
			'menu-tem-divider-height',
			'100'
		);

	}

	$less_vars->add_rgba_color(
		'menu-tem-divider-color',
		of_get_option( 'header-menu-dividers-color', '#999999' ),
		of_get_option( 'header-menu-dividers-opacity', '30' )
	);

	$decor_vars = array( 'menu-decor-color', 'menu-decor-color-2' );
	$decoration = of_get_option( 'header-menu-decoration-style' );
	if ( 'underline' === $decoration ) {

		$less_vars->add_rgb_color(
			$decor_vars,
			presscore_less_get_conditional_colors(
				array( 'header-menu-decoration-underline-color-style' ),
				array( 'header-menu-decoration-underline-color', '#ffffff' ),
				array( 'header-menu-decoration-underline-gradient', array( '#ffffff', '#000000' ) ),
				$_accent_color
			)
		);

	} else if ( 'other' === $decoration ) {

		$less_vars->add_rgba_color(
			$decor_vars,
			presscore_less_get_conditional_colors(
				array( 'header-menu-decoration-other-hover-color-style' ),
				array( 'header-menu-decoration-other-hover-color', '#ffffff' ),
				array( 'header-menu-decoration-other-hover-gradient', array( '#ffffff', '#000000' ) ),
				$_accent_color
			),
			of_get_option( 'header-menu-decoration-other-opacity', '100' )
		);

	}
	unset( $decor_vars, $decoration );

	$color = presscore_less_get_conditional_colors(
		array( 'header-menu-decoration-other-hover-line-color-style' ),
		array( 'header-menu-decoration-other-hover-line-color', '#ffffff' ),
		array( 'header-menu-decoration-other-hover-line-gradient', array( '#ffffff', '#000000' ) ),
		$_accent_color
	);
	$opacity = of_get_option( 'header-menu-decoration-other-hover-line-opacity', '100' );

	$less_vars->add_rgba_color(
		array( 'menu-line-decor-color', 'menu-line-decor-color-2' ),
		$color,
		$opacity
	);

	$less_vars->add_rgba_color(
		array( 'menu-hover-decor-color', 'menu-hover-decor-color-2' ),
		$color,
		$opacity
	);

	unset( $color, $opacity );

	$less_vars->add_rgba_color(
		array( 'menu-active-decor-color', 'menu-active-decor-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'header-menu-decoration-other-active-color-style' ),
			array( 'header-menu-decoration-other-active-color', '#ffffff' ),
			array( 'header-menu-decoration-other-active-gradient', array( '#ffffff', '#000000' ) ),
			$_accent_color
		),
		of_get_option( 'header-menu-decoration-other-active-opacity' )
	);

	$less_vars->add_rgba_color(
		array( 'menu-active-line-decor-color', 'menu-active-line-decor-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'header-menu-decoration-other-active-line-color-style' ),
			array( 'header-menu-decoration-other-active-line-color', '#ffffff' ),
			array( 'header-menu-decoration-other-active-line-gradient', array( '#ffffff', '#000000' ) ),
			$_accent_color
		),
		of_get_option( 'header-menu-decoration-other-active-line-opacity', '100' )
	);

	$less_vars->add_rgba_color(
		array( 'menu-click-decor-bg-color', 'menu-click-decor-bg-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'header-menu-decoration-other-click_decor-color-style' ),
			array( 'header-menu-decoration-other-click_decor-color' ),
			array( 'header-menu-decoration-other-click_decor-gradient' ),
			$_accent_color
		),
		of_get_option( 'header-menu-decoration-other-click_decor-opacity' )
	);

	$less_vars->add_pixel_number(
		'menu-decor-border-radius',
		of_get_option( 'header-menu-decoration-other-border-radius' )
	);

	$less_vars->add_hex_color(
		array( 'menu-hover-color', 'menu-hover-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'header-menu-hover-font-color-style' ),
			array( 'header-menu-hover-font-color', '#ffffff' ),
			array( 'header-menu-hover-font-gradient', array( '#ffffff', '#000000' ) ),
			$_accent_color
		)
	);

	$less_vars->add_hex_color(
		array( 'menu-active-color', 'menu-active-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'header-menu-active_item-font-color-style' ),
			array( 'header-menu-active_item-font-color', '#ffffff' ),
			array( 'header-menu-active_item-font-gradient', array( '#ffffff', '#000000' ) ),
			$_accent_color
		)
	);

	/**
	 * Header & Top Bar -> Submenu
	 */

	$less_vars->add_font(
		array(
			'submenu-font-family',
			'submenu-font-weight',
			'submenu-font-style',
		),
		of_get_option( 'header-menu-submenu-font-family' )
	);

	$less_vars->add_pixel_number(
		'submenu-font-size',
		of_get_option( 'header-menu-submenu-font-size' )
	);

	$less_vars->add_keyword(
		'submenu-text-transform',
		( of_get_option( 'header-menu-submenu-font-is_uppercase' ) ? 'uppercase' : 'none' )
	);

	$less_vars->add_font(
		array(
			'sub-subtitle-font-family',
			'sub-subtitle-font-weight',
			'sub-subtitle-font-style',
		),
		of_get_option( 'header-menu-submenu-subtitle-font-family' )
	);

	$less_vars->add_pixel_number(
		'sub-subtitle-font-size',
		of_get_option( 'header-menu-submenu-subtitle-font-size' )
	);

	$less_vars->add_hex_color(
		'submenu-color',
		of_get_option( 'header-menu-submenu-font-color' )
	);

	$less_vars->add_hex_color(
		array( 'submenu-hover-color', 'submenu-hover-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'header-menu-submenu-hover-font-color-style' ),
			array( 'header-menu-submenu-hover-font-color' ),
			array( 'header-menu-submenu-hover-font-gradient' ),
			$_accent_color
		)
	);

	$less_vars->add_hex_color(
		array( 'submenu-active-color', 'submenu-active-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'header-menu-submenu-active-font-color-style' ),
			array( 'header-menu-submenu-active-font-color' ),
			array( 'header-menu-submenu-active-font-gradient' ),
			$_accent_color
		)
	);

	$less_vars->add_pixel_number(
		'sub-menu-icon-size',
		of_get_option( 'header-menu-submenu-icon-size' )
	);

	// paddings
	$less_vars->add_pixel_number(
		'submenu-item-padding-left',
		of_get_option( 'header-menu-submenu-item-padding-left', '10' )
	);

	$less_vars->add_pixel_number(
		'submenu-item-padding-right',
		of_get_option( 'header-menu-submenu-item-padding-right', '10' )
	);

	$less_vars->add_pixel_number(
		'submenu-item-padding-top',
		of_get_option( 'header-menu-submenu-item-padding-top', '5' )
	);

	$less_vars->add_pixel_number(
		'submenu-item-padding-bottom',
		of_get_option( 'header-menu-submenu-item-padding-bottom', '5' )
	);

	// margins
	$less_vars->add_pixel_number(
		'submenu-item-margin-left',
		of_get_option( 'header-menu-submenu-item-margin-left', '0' )
	);

	$less_vars->add_pixel_number(
		'submenu-item-margin-right',
		of_get_option( 'header-menu-submenu-item-margin-right', '0' )
	);

	$less_vars->add_pixel_number(
		'submenu-item-margin-top',
		of_get_option( 'header-menu-submenu-item-margin-top', '0' )
	);

	$less_vars->add_pixel_number(
		'submenu-item-margin-bottom',
		of_get_option( 'header-menu-submenu-item-margin-bottom', '0' )
	);

	$less_vars->add_rgba_color(
		'submenu-bg-color',
		of_get_option( 'header-menu-submenu-bg-color' ),
		of_get_option( 'header-menu-submenu-bg-opacity' )
	);

	$less_vars->add_pixel_number(
		'submenu-width',
		of_get_option( 'header-menu-submenu-bg-width' )
	);

	/**
	 * Header & Top Bar -> Additional elements
	 */

	$less_vars->add_font(
		array(
			'additional-menu-elements-font-family',
			'additional-menu-elements-font-weight',
			'additional-menu-elements-font-style',
		),
		of_get_option( 'header-elements-near_menu-font_family' )
	);

	$less_vars->add_pixel_number(
		'additional-menu-elements-font-size',
		of_get_option( 'header-elements-near_menu-font_size', '14' )
	);

	$less_vars->add_hex_color(
		'additional-menu-elements-color',
		of_get_option( 'header-elements-near_menu-font_color', '#888888' )
	);

	$less_vars->add_font(
		array(
			'additional-logo-elements-font-family',
			'additional-logo-elements-font-weight',
			'additional-logo-elements-font-style',
		),
		of_get_option( 'header-elements-near_logo-font_family' )
	);

	$less_vars->add_pixel_number(
		'additional-logo-elements-font-size',
		of_get_option( 'header-elements-near_logo-font_size', '16' )
	);

	$less_vars->add_hex_color(
		'additional-logo-elements-color',
		of_get_option( 'header-elements-near_logo-font_color', '#888888' )
	);

	$less_vars->add_hex_color(
		'top-icons-color',
		of_get_option( 'header-elements-soc_icons-color', '#828282' )
	);

	$less_vars->add_hex_color(
		'soc-ico-hover-color',
		of_get_option( 'header-elements-soc_icons-hover-color', '#828282' )
	);

	/**
	 * Header & Top Bar -> Layout
	 */

	$header = 'header-' . of_get_option( 'header-layout', 'inline' ) . '-';
	$areas_paddings = array(
		'menu-area-left-padding-left'        => "{$header}elements-near_menu_left-padding-left",
		'menu-area-left-padding-right'       => "{$header}elements-near_menu_left-padding-right",
		'menu-area-left-padding-top'         => "{$header}elements-near_menu_left-padding-top",
		'menu-area-left-padding-bottom'      => "{$header}elements-near_menu_left-padding-bottom",

		'menu-area-right-padding-left'       => "{$header}elements-near_menu_right-padding-left",
		'menu-area-right-padding-right'      => "{$header}elements-near_menu_right-padding-right",
		'menu-area-right-padding-top'        => "{$header}elements-near_menu_right-padding-top",
		'menu-area-right-padding-bottom'     => "{$header}elements-near_menu_right-padding-bottom",

		'menu-area-top-line-padding-left'    => "{$header}elements-top_line-padding-left",
		'menu-area-top-line-padding-right'   => "{$header}elements-top_line-padding-right",
		'menu-area-top-line-padding-top'     => "{$header}elements-top_line-padding-top",
		'menu-area-top-line-padding-bottom'  => "{$header}elements-top_line-padding-bottom",

		// @todo Delete.
		'menu-area-top-side-padding-top'     => "{$header}elements-side_line-padding-top",
		'menu-area-top-side-padding-bottom'  => "{$header}elements-side_line-padding-bottom",

		'menu-area-below-padding-top'        => "{$header}elements-below_menu-padding-top",
		'menu-area-below-padding-bottom'     => "{$header}elements-below_menu-padding-bottom",
		'menu-area-below-padding-left'       => "{$header}elements-below_menu-padding-left",
		'menu-area-below-padding-right'      => "{$header}elements-below_menu-padding-right",

		'logo-area-left-padding-left'        => "{$header}elements-near_logo_left-padding-left",
		'logo-area-left-padding-right'       => "{$header}elements-near_logo_left-padding-right",
		'logo-area-left-padding-top'         => "{$header}elements-near_logo_left-padding-top",
		'logo-area-left-padding-bottom'      => "{$header}elements-near_logo_left-padding-bottom",

		'logo-area-right-padding-left'       => "{$header}elements-near_logo_right-padding-left",
		'logo-area-right-padding-right'      => "{$header}elements-near_logo_right-padding-right",
		'logo-area-right-padding-top'        => "{$header}elements-near_logo_right-padding-top",
		'logo-area-right-padding-bottom'     => "{$header}elements-near_logo_right-padding-bottom",

		'top-content-padding'                => "{$header}content-padding-top",
		'bottom-content-padding'             => "{$header}content-padding-bottom",
		'left-content-padding'               => "{$header}content-padding-left",
		'right-content-padding'              => "{$header}content-padding-right",

		'side-menu-top-padding'              => "{$header}menu-padding-top",
		'side-menu-bottom-padding'           => "{$header}menu-padding-bottom",
	);

	foreach ( $areas_paddings as $var => $opt_id ) {
		$less_vars->add_pixel_number( $var, of_get_option( $opt_id, '0' ) );
	}
	unset( $areas_paddings, $var, $opt_id );

	$less_vars->add_pixel_number(
		'classic-menu-top-margin',
		of_get_option( "{$header}menu-margin-top", '0' )
	);

	$less_vars->add_pixel_number(
		'classic-menu-bottom-margin',
		of_get_option( "{$header}menu-margin-bottom", '0' )
	);

	$less_vars->add_pixel_number(
		'header-height',
		of_get_option( "{$header}height", '140' )
	);

	$less_vars->add_pixel_number(
		'side-header-h-stroke-height',
		of_get_option( "{$header}layout-top_line-height", '130' )
	);

	$less_vars->add_pixel_number(
		'side-header-v-stroke-width',
		of_get_option( "{$header}layout-side_line-width", '60' )
	);

	$less_vars->add_number(
		'header-side-width',
		of_get_option( "{$header}width", '300px' )
	);

	$less_vars->add_number(
		'header-side-content-width',
		of_get_option( "{$header}content-width", '220px' )
	);

	unset( $header );

	/**
	 * Branding.
	 */

	// paddings
	$indention = array(
		'main'        => 'header',
		'transparent' => 'header-style-transparent',
		'floating'    => 'header-style-floating',
		'mobile'      => 'header-style-mobile',
		'bottom'      => 'bottom_bar',
		'mixed'       => 'header-style-mixed',
	);

	foreach ( $indention as $var_refix => $opt_prefix ) {
		$less_vars->add_pixel_number( "{$var_refix}-logo-top-padding", of_get_option( "{$opt_prefix}-logo-padding-top" ) );
		$less_vars->add_pixel_number( "{$var_refix}-logo-right-padding", of_get_option( "{$opt_prefix}-logo-padding-right" ) );
		$less_vars->add_pixel_number( "{$var_refix}-logo-bottom-padding", of_get_option( "{$opt_prefix}-logo-padding-bottom" ) );
		$less_vars->add_pixel_number( "{$var_refix}-logo-left-padding", of_get_option( "{$opt_prefix}-logo-padding-left" ) );
	}
	unset( $indention, $var_refix, $opt_prefix );

	/**
	 * Bottom bar.
	 */

	$less_vars->add_hex_color(
		'bottom-color',
		of_get_option( 'bottom_bar-color', '#757575' )
	);

	$less_vars->add_rgba_color(
		'bottom-bg-color',
		of_get_option( 'bottom_bar-bg_color', '#ffffff' ),
		of_get_option( 'bottom_bar-bg_opacity', '100' )
	);

	$less_vars->add_image(
		array(
			'bottom-bg-image',
			'bottom-bg-repeat',
			'bottom-bg-position-x',
			'bottom-bg-position-y'
		),
		of_get_option( 'bottom_bar-bg_image' )
	);

	/**
	 * Fonts.
	 */

	$less_vars->add_font(
		array(
			'base-font-family',
			'base-font-weight',
			'base-font-style'
		),
		of_get_option( 'fonts-font_family' )
	);

	$less_vars->add_pixel_number(
		'base-line-height',
		of_get_option( 'fonts-normal_size_line_height', '20' )
	);

	$less_vars->add_pixel_number(
		'text-small-line-height',
		of_get_option( 'fonts-small_size_line_height', '20' )
	);

	$less_vars->add_pixel_number(
		'text-big-line-height',
		of_get_option( 'fonts-big_size_line_height', '20' )
	);

	$less_vars->add_pixel_number(
		'base-font-size',
		of_get_option( 'fonts-normal_size', '13' )
	);

	$less_vars->add_pixel_number(
		'text-small',
		of_get_option( 'fonts-small_size', '11' )
	);

	$less_vars->add_pixel_number(
		'text-big',
		of_get_option( 'fonts-big_size', '15' )
	);

	/**
	 * Sidebar.
	 */

	$less_vars->add_percent_number(
		'sidebar-width',
		of_get_option( 'sidebar-width', '30' )
	);

	$less_vars->add_pixel_number(
		'widget-sidebar-distace',
		of_get_option( 'sidebar-vertical_distance', '60' )
	);

	$less_vars->add_rgba_color(
		'widget-sidebar-bg-color',
		of_get_option( 'sidebar-bg_color', '#ffffff' ),
		of_get_option( 'sidebar-bg_opacity', '100' )
	);

	$less_vars->add_rgba_color(
		'sidebar-outline-color',
		of_get_option( 'sidebar-decoration_outline_color', '#ffffff' ),
		of_get_option( 'sidebar-decoration_outline_opacity', '100' )
	);

	$less_vars->add_image(
		array(
			'widget-sidebar-bg-image',
			'widget-sidebar-bg-repeat',
			'widget-sidebar-bg-position-x',
			'widget-sidebar-bg-position-y',
		),
		of_get_option( 'sidebar-bg_image' )
	);

	$less_vars->add_hex_color(
		'widget-sidebar-color',
		of_get_option( 'sidebar-primary_text_color', '#686868' )
	);

	$less_vars->add_hex_color(
		'widget-sidebar-header-color',
		of_get_option( 'sidebar-headers_color', '#000000' )
	);

	/**
	 * Footer.
	 */

	$less_vars->add_rgba_color(
		'footer-bg-color',
		of_get_option( 'footer-bg_color', '#1b1b1b' ),
		of_get_option( 'footer-bg_opacity', '100' )
	);

	$less_vars->add_rgba_color(
		'footer-outline-color',
		of_get_option( 'footer-decoration_outline_color', '#ffffff' ),
		of_get_option( 'footer-decoration_outline_opacity', '100' )
	);

	$less_vars->add_image(
		array(
			'footer-bg-image',
			'footer-bg-repeat',
			'footer-bg-position-x',
			'footer-bg-position-y',
		),
		of_get_option( 'footer-bg_image' )
	);

	$less_vars->add_hex_color(
		'widget-footer-color',
		of_get_option( 'footer-primary_text_color', '#828282' )
	);

	$less_vars->add_hex_color(
		'widget-footer-header-color',
		of_get_option( 'footer-headers_color', '#ffffff' )
	);

	$less_vars->add_pixel_number(
		'footer-top-padding',
		of_get_option( 'footer-padding-top' )
	);

	$less_vars->add_pixel_number(
		'footer-bottom-padding',
		of_get_option( 'footer-padding-bottom' )
	);

	$less_vars->add_pixel_number(
		'widget-footer-padding',
		of_get_option( 'footer-paddings-columns', '44' )
	);

	$less_vars->add_pixel_number(
		'footer-switch',
		of_get_option( 'footer-collapse_after', '760' )
	);

	/**
	 * Page titles.
	 */

	$less_vars->add_rgba_color(
		'header-transparent-bg-color',
		of_get_option( 'header-transparent_bg_color', '#000000' ),
		of_get_option( 'header-transparent_bg_opacity', '50' )
	);

	$less_vars->add_pixel_number(
		'page-title-top-padding',
		of_get_option( 'page_title-padding-top', '0' )
	);

	$less_vars->add_pixel_number(
		'page-title-bottom-padding',
		of_get_option( 'page_title-padding-bottom', '0' )
	);

	$less_vars->add_keyword(
		'page-title-bg-size',
		( of_get_option( 'general-title_bg_fullscreen' ) ? '~"cover"' : '~"auto auto"' )
	);

	/**
	 * General.
	 */

	$less_vars->add_number(
		'content-width',
		of_get_option( 'general-content_width' )
	);

	$less_vars->add_number(
		'box-width',
		of_get_option( 'general-box_width' )
	);

	$less_vars->add_pixel_number(
		'side-content-paddings',
		of_get_option( 'general-side_content_paddings' )
	);

	$less_vars->add_pixel_number(
		'switch-content-paddings',
		of_get_option( 'general-switch_content_paddings' )
	);

	$less_vars->add_pixel_number(
		'mobile-side-content-paddings',
		of_get_option( 'general-mobile_side_content_paddings' )
	);

	$less_vars->add_hex_color(
		'base-color',
		of_get_option( 'content-primary_text_color', '#686868' )
	);

	$less_vars->add_pixel_number(
		'content-switch',
		of_get_option( 'general-responsiveness-treshold', '800' )
	);

	$less_vars->add_rgba_color(
		'page-bg-color',
		of_get_option( 'general-bg_color', '#252525' ),
		of_get_option( 'general-bg_opacity', '100' )
	);

	$less_vars->add_rgba_color(
		'beautiful-spinner-color',
		of_get_option( 'general-spinner_color', '#ffffff' ),
		of_get_option( 'general-spinner_opacity', '100' )
	);

	$less_vars->add_image(
		array(
			'page-bg-image',
			'page-bg-repeat',
			'page-bg-position-x',
			'page-bg-position-y',
		),
		of_get_option( 'general-bg_image' )
	);

	$less_vars->add_keyword(
		'page-bg-size',
		( of_get_option( 'general-bg_fullscreen' ) ? 'cover' : 'auto' )
	);

	if ( 'cover' === $less_vars->get_var( 'page-bg-size' ) ) {
		$less_vars->add_keyword( 'page-bg-repeat', 'no-repeat' );
	}

	$less_vars->add_keyword(
		'page-bg-attachment',
		( of_get_option( 'general-bg_fixed' ) ? 'fixed' : '~""' )
	);

	$less_vars->add_hex_color(
		'body-bg-color',
		of_get_option( 'general-boxed_bg_color', '#252525' )
	);

	$less_vars->add_image(
		array(
			'body-bg-image',
			'body-bg-repeat',
			'body-bg-position-x',
			'body-bg-position-y',
		),
		of_get_option( 'general-boxed_bg_image' )
	);

	$less_vars->add_keyword(
		'body-bg-size',
		( of_get_option( 'general-boxed_bg_fullscreen' ) ? 'cover' : 'auto' )
	);

	if ( 'cover' === $less_vars->get_var( 'body-bg-size' ) ) {
		$less_vars->add_keyword( 'body-bg-repeat', 'no-repeat' );
	}

	$less_vars->add_keyword(
		'body-bg-attachment',
		( of_get_option( 'general-boxed_bg_fixed' ) ? 'fixed' : '~""' )
	);

	$less_vars->add_rgba_color(
		'content-boxes-bg',
		of_get_option( 'general-content_boxes_bg_color', '#ffffff' ),
		of_get_option( 'general-content_boxes_bg_opacity', '100' )
	);

	$less_vars->add_rgba_color(
		'divider-bg-color',
		of_get_option( 'general-content_boxes_decoration_outline_color', '#ffffff' ),
		of_get_option( 'general-content_boxes_decoration_outline_opacity', '100' )
	);

	$less_vars->add_pixel_number(
		'border-radius-size',
		of_get_option( 'general-border_radius', '8' )
	);

	$less_vars->add_font(
		array(
			'filter-font-family',
			'filter-font-weight',
			'filter-font-style',
		),
		of_get_option( 'general-filter-font-family' )
	);

	$less_vars->add_pixel_number(
		'filter-font-size',
		of_get_option( 'general-filter-font-size' )
	);

	$less_vars->add_pixel_number(
		'filter-line-height',
		of_get_option( 'general-filter-line_height' )
	);

	$less_vars->add_keyword(
		'filter-text-transform',
		( of_get_option( 'general-filter_ucase' ) ? 'uppercase' : 'none' )
	);

	// paddings
	$less_vars->add_pixel_number(
		'filter-item-padding-left',
		of_get_option( 'general-filter-padding-left' )
	);

	$less_vars->add_pixel_number(
		'filter-item-padding-right',
		of_get_option( 'general-filter-padding-right' )
	);

	$less_vars->add_pixel_number(
		'filter-item-padding-top',
		of_get_option( 'general-filter-padding-top' )
	);

	$less_vars->add_pixel_number(
		'filter-item-padding-bottom',
		of_get_option( 'general-filter-padding-bottom' )
	);

	// margins
	$less_vars->add_pixel_number(
		'filter-item-margin-left',
		of_get_option( 'general-filter-margin-left' )
	);

	$less_vars->add_pixel_number(
		'filter-item-margin-right',
		of_get_option( 'general-filter-margin-right' )
	);

	$less_vars->add_pixel_number(
		'filter-item-margin-top',
		of_get_option( 'general-filter-margin-top' )
	);

	$less_vars->add_pixel_number(
		'filter-item-margin-bottom',
		of_get_option( 'general-filter-margin-bottom' )
	);

	/**
	 * Image hovers.
	 */

	$less_vars->add_percent_number(
		'plain-hover-opacity',
		of_get_option( 'image_hover-opacity', '30' )
	);

	$less_vars->add_percent_number(
		'project-bg-hover-opacity',
		of_get_option( 'image_hover-project_rollover_opacity', '70' )
	);

	// TODO: investigate usage of this var, maybe duplication of @project-bg-hover-opacity
	$less_vars->add_percent_number(
		'bg-hover-opacity',
		of_get_option( 'image_hover-project_rollover_opacity', '70' )
	);

	$less_vars->add_hex_color(
		array( 'rollover-bg-color', 'rollover-bg-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'image_hover-color_mode' ),
			array( 'image_hover-color' ),
			array( 'image_hover-color_gradient' ),
			$_accent_color
		)
	);

	$less_vars->add_hex_color(
		array( 'project-rollover-bg-color', 'project-rollover-bg-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'image_hover-project_rollover_color_mode' ),
			array( 'image_hover-project_rollover_color' ),
			array( 'image_hover-project_rollover_color_gradient' ),
			$_accent_color
		)
	);

	/**
	 * Fonts.
	 */

	if ( function_exists('presscore_themeoptions_get_headers_defaults') ) {

		foreach ( presscore_themeoptions_get_headers_defaults() as $id=>$opts ) {

			$less_vars->add_font(
				array( "{$id}-font-family", "{$id}-font-weight", "{$id}-font-style" ),
				of_get_option( "fonts-{$id}_font_family" )
			);

			$less_vars->add_pixel_number(
				"{$id}-font-size",
				of_get_option( "fonts-{$id}_font_size" )
			);

			$less_vars->add_pixel_number(
				"{$id}-line-height",
				of_get_option( "fonts-{$id}_line_height" )
			);

			$less_vars->add_keyword(
				"{$id}-text-transform",
				( of_get_option( "fonts-{$id}_uppercase" ) ? 'uppercase' : 'none' )
			);

			$less_vars->add_hex_color(
				"{$id}-color",
				of_get_option( 'content-headers_color' )
			);

		}

	}

	/**
	 * Mobile.
	 */

	$less_vars->add_pixel_number(
		'first-switch',
		of_get_option( 'header-mobile-first_switch-after' )
	);

	$less_vars->add_pixel_number(
		'second-switch',
		of_get_option( 'header-mobile-second_switch-after' )
	);

	// menu
	$less_vars->add_font(
		array( 'mobile-menu-font-family', 'mobile-menu-font-weight', 'mobile-menu-font-style' ),
		of_get_option( 'header-mobile-menu-font-family' )
	);

	$less_vars->add_pixel_number(
		'mobile-menu-font-size',
		of_get_option( 'header-mobile-menu-font-size' )
	);

	$less_vars->add_keyword(
		'mobile-menu-text-transform',
		( of_get_option( 'header-mobile-menu-font-is_capitalized' ) ? 'uppercase' : 'none' )
	);

	// submenu
	$less_vars->add_font(
		array( 'mobile-sub-menu-font-family', 'mobile-sub-menu-font-weight', 'mobile-sub-menu-font-style' ),
		of_get_option( 'header-mobile-submenu-font-family' )
	);

	$less_vars->add_pixel_number(
		'mobile-sub-menu-font-size',
		of_get_option( 'header-mobile-submenu-font-size' )
	);

	$less_vars->add_keyword(
		'mobile-sub-menu-text-transform',
		( of_get_option( 'header-mobile-submenu-font-is_capitalized' ) ? 'uppercase' : 'none' )
	);

	// color
	$less_vars->add_hex_color(
		'mobile-menu-color',
		of_get_option( 'header-mobile-menu-font-color' )
	);

	$less_vars->add_hex_color(
		array( 'mobile-menu-active-color', 'mobile-menu-active-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'header-mobile-menu-font-hover-color-style' ),
			array( 'header-mobile-menu-font-hover-color' ),
			array( 'header-mobile-menu-font-hover-gradient' ),
			$_accent_color
		)
	);

	$less_vars->add_hex_color(
		array( 'mobile-menu-hover-color', 'mobile-menu-hover-color-2' ),
		array( $less_vars->get_var( 'mobile-menu-active-color' ), $less_vars->get_var( 'mobile-menu-active-color-2' ) )
	);

	$less_vars->add_rgba_color(
		'mobile-menu-bg-color',
		of_get_option( 'header-mobile-menu-bg-color' ),
		of_get_option( 'header-mobile-menu-bg-opacity' )
	);

	$less_vars->add_pixel_number(
		'mobile-menu-width',
		of_get_option( 'header-mobile-menu-bg-width' )
	);

	$less_vars->add_pixel_number(
		'first-switch-mobile-header-height',
		of_get_option( 'header-mobile-first_switch-height' )
	);

	$less_vars->add_pixel_number(
		'second-switch-mobile-header-height',
		of_get_option( 'header-mobile-second_switch-height' )
	);

	/**
	 * Page titles.
	 */

	$less_vars->add_hex_color(
		'page-title-color',
		of_get_option( 'general-title_color' )
	);

	$less_vars->add_hex_color(
		'page-title-breadcrumbs-color',
		of_get_option( 'general-breadcrumbs_color' )
	);

	$less_vars->add_rgba_color(
		'title-outline-color',
		of_get_option( 'general-title_decoration_outline_color' ),
		of_get_option( 'general-title_decoration_outline_opacity' )
	);

	if ( 'gradient' === of_get_option( 'general-title_bg_mode' ) ) {
		$less_vars->add_hex_color(
			array(
				'page-title-bg-color',
				'page-title-bg-color-2',
			),
			of_get_option( 'general-title_bg_gradient' )
		);
	} else {
		$less_vars->add_rgba_color(
			'page-title-bg-color',
			of_get_option( 'general-title_bg_color' ),
			of_get_option( 'general-title_bg_opacity' )
		);
	}

	$less_vars->add_image(
		array(
			'page-title-bg-image',
			'page-title-bg-repeat',
			'page-title-bg-position-x',
			'page-title-bg-position-y',
		),
		of_get_option( 'general-title_bg_image' )
	);

	$less_vars->add_keyword(
		'page-title-bg-attachment',
		( of_get_option( 'general-title_bg_fixed' ) ? 'fixed' : '~""' )
	);

	/**
	 * Buttons.
	 */

	if ( function_exists( 'presscore_themeoptions_get_buttons_defaults' ) ) {

		foreach ( presscore_themeoptions_get_buttons_defaults() as $id=>$opts ) {

			$less_vars->add_font(
				array( "dt-btn-{$id}-font-family", "dt-btn-{$id}-font-weight", "dt-btn-{$id}-font-style" ),
				of_get_option( "buttons-{$id}_font_family" )
			);

			$less_vars->add_pixel_number(
				"dt-btn-{$id}-font-size",
				of_get_option( "buttons-{$id}_font_size", $opts['fs'] )
			);

			$less_vars->add_pixel_number(
				"dt-btn-{$id}-line-height",
				of_get_option( "buttons-{$id}_line_height", $opts['lh'] )
			);

			$less_vars->add_keyword(
				"dt-btn-{$id}-text-transform",
				( of_get_option( "buttons-{$id}_uppercase", $opts['uc'] ) ? 'uppercase' : 'none' )
			);

			$less_vars->add_pixel_number(
				"dt-btn-{$id}-border-radius",
				of_get_option( "buttons-{$id}_border_radius", $opts['border_radius'] )
			);

		}

	}

	$less_vars->add_hex_color(
		array( 'dt-btn-bg-color', 'dt-btn-bg-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'buttons-color_mode' ),
			array( 'buttons-color', '#ffffff' ),
			array( 'buttons-color_gradient', array( '#ffffff', '#000000' ) ),
			$_accent_color
		)
	);

	$less_vars->add_hex_color(
		array( 'dt-btn-hover-bg-color', 'dt-btn-hover-bg-color-2' ),
		presscore_less_get_conditional_colors(
			array( 'buttons-hover_color_mode' ),
			array( 'buttons-hover_color', '#ffffff' ),
			array( 'buttons-hover_color_gradient', array( '#ffffff', '#000000' ) ),
			$_accent_color
		)
	);

	$less_vars->add_hex_color(
		array( 'dt-btn-color' ),
		presscore_less_get_conditional_colors(
			array( 'buttons-text_color_mode' ),
			array( 'buttons-text_color' ),
			array(),
			$_accent_color
		)
	);

	$less_vars->add_hex_color(
		array( 'dt-btn-hover-color' ),
		presscore_less_get_conditional_colors(
			array( 'buttons-text_hover_color_mode' ),
			array( 'buttons-text_hover_color' ),
			array(),
			$_accent_color
		)
	);

	/**
	 * Stripes.
	 */

	if ( function_exists( 'presscore_themeoptions_get_stripes_list' ) ) {

		foreach ( presscore_themeoptions_get_stripes_list() as $id=>$opts ) {

			$less_vars->add_rgba_color(
				"strype-{$id}-bg-color",
				of_get_option( "stripes-stripe_{$id}_color", $opts['bg_color'] ),
				100
			);

			$less_vars->add_image(
				array(
					"strype-{$id}-bg-image",
					"strype-{$id}-bg-repeat",
					'',
					"strype-{$id}-bg-position-y",
				),
				of_get_option( "stripes-stripe_{$id}_bg_image", $opts['bg_img'] )
			);

			$less_vars->add_keyword(
				"strype-{$id}-bg-size",
				( of_get_option( "stripes-stripe_{$id}_bg_fullscreen" ) ? 'cover' : 'auto' )
			);

			$less_vars->add_hex_color(
				"strype-{$id}-header-color",
				of_get_option( "stripes-stripe_{$id}_headers_color", $opts['text_header_color'] )
			);

			$less_vars->add_rgba_color(
				"strype-{$id}-boxes-bg",
				of_get_option( "stripes-stripe_{$id}_content_boxes_bg_color" ),
				of_get_option( "stripes-stripe_{$id}_content_boxes_bg_opacity" )
			);

			$less_vars->add_rgba_color(
				"strype-{$id}-divider-bg-color",
				of_get_option( "stripes-stripe_{$id}_content_boxes_decoration_outline_color" ),
				of_get_option( "stripes-stripe_{$id}_content_boxes_decoration_outline_opacity" )
			);

			$less_vars->add_rgba_color(
				"strype-{$id}-backgrounds-bg-color",
				of_get_option( "stripes-stripe_{$id}_outline_color" ),
				of_get_option( "stripes-stripe_{$id}_outline_opacity" )
			);

			$less_vars->add_hex_color(
				"strype-{$id}-color",
				of_get_option( "stripes-stripe_{$id}_text_color", $opts['text_color'] )
			);

			if ( 'cover' === $less_vars->get_var( "strype-{$id}-bg-size" ) ) {
				$less_vars->add_keyword( "strype-{$id}-bg-repeat", 'no-repeat' );
				$less_vars->add_keyword( "strype-{$id}-bg-attachment", 'fixed' );
			} else {
				$less_vars->add_keyword( "strype-{$id}-bg-attachment", '~""' );
			}

		}

	}

	// var_dump( $less_vars->get_var( 'menu-tem-divider-height' ) ); die();
}
add_action( 'presscore_setup_less_vars', 'presscore_action_add_less_vars' );
