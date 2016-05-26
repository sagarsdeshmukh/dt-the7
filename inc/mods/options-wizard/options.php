<?php
/**
 * Wizard options.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options[] = array( 'name' => _x( 'General', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Layout', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-layout'] = array(
			'name'    => _x('Layout', 'theme-options', 'the7mk2'),
			'id'      => 'general-layout',
			'type'    => 'images',
			'std'     => 'wide',
			'class'   => 'small',
			'options' => array(
				'wide'    => array(
					'title' => _x( 'Wide', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-layout-wide.gif',
				),
				'boxed'    => array(
					'title' => _x( 'Boxed', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-layout-boxed.gif',
				),
			),
			'show_hide' => array( 'boxed' => true ),
		);

		$options[] = array( 'type' => 'js_hide_begin' );

			$options[] = array( 'type' => 'divider' );

			$options[] = array( 'name' => _x( 'Background under the box', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			$options['general-boxed_bg_color'] = array(
				'name' => _x( 'Background color', 'theme-options', 'the7mk2' ),
				'id'   => 'general-boxed_bg_color',
				'type' => 'color',
				'std'  => '#ffffff',
			);

			$options['general-boxed_bg_image'] = array(
				'name' => _x( 'Add background image', 'theme-options', 'the7mk2' ),
				'id'   => 'general-boxed_bg_image',
				'type' => 'background_img',
				'std'  => array(
					'image'      => '',
					'repeat'     => 'repeat',
					'position_x' => 'center',
					'position_y' => 'center',
				),
			);

			$options['general-boxed_bg_fullscreen'] = array(
				"name" => _x( 'Fullscreen ', 'theme-options', 'the7mk2' ),
				"id"   => 'general-boxed_bg_fullscreen',
				"type" => 'checkbox',
				'std'  => 0,
			);

			$options['general-boxed_bg_fixed'] = array(
				"name" => _x( 'Fixed background ', 'theme-options', 'the7mk2' ),
				"id"   => 'general-boxed_bg_fixed',
				"type" => 'checkbox',
				'std'  => 0,
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'name' => _x( 'Background', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-bg_color'] = array(
			'name' => _x( 'Color', 'theme-options', 'the7mk2' ),
			'id'   => 'general-bg_color',
			'type' => 'color',
			'std'  => '#252525',
		);

	$options[] = array( 'name' => _x( 'Text', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['fonts-font_family'] = array(
			'name' => _x( 'Text font family', 'theme-options', 'the7mk2' ),
			'id' => 'fonts-font_family',
			'std' => 'Open Sans',
			'type' => 'web_fonts',
			'options' => array(
				// 'Arial' => 'Arial',
				// 'Tahoma' => 'Tahoma',
				// 'Georgia' => 'Georgia',
				// 'Times New Roman' => 'Times New Roman',
				// 'Trebuchet MS' => 'Trebuchet MS',
				// 'Open Sans' => 'Open Sans',
				// 'Roboto' => 'Roboto',
				// 'Lato' => 'Lato',
				// 'PT Sans' => 'PT Sans',
				// 'Source Sans Pro' => 'Source Sans Pro',
				// 'Exo 2' => 'Exo 2',
				// 'Ubuntu' => 'Ubuntu',
				// 'Istok Web' => 'Istok Web',
				// 'Vollkorn' => 'Vollkorn',
				// 'Roboto Condensed' => 'Roboto Condensed',
				// 'Roboto Slab' => 'Roboto Slab',
				// 'Merriweather' => 'Merriweather',
				// 'Raleway' => 'Raleway',

				'Arial' => 'Arial',
				'Exo 2' => 'Exo 2',
				'Georgia' => 'Georgia',
				'Istok Web' => 'Istok Web',
				'Lato' => 'Lato',
				'Merriweather' => 'Merriweather',
				'Open Sans' => 'Open Sans',
				'PT Sans' => 'PT Sans',
				'Raleway' => 'Raleway',
				'Roboto Condensed' => 'Roboto Condensed',
				'Roboto Slab' => 'Roboto Slab',
				'Roboto' => 'Roboto',
				'Source Sans Pro' => 'Source Sans Pro',
				'Tahoma' => 'Tahoma',
				'Times New Roman' => 'Times New Roman',
				'Trebuchet MS' => 'Trebuchet MS',
				'Ubuntu' => 'Ubuntu',
				'Vollkorn' => 'Vollkorn',
			),
		);

		$options['content-primary_text_color'] = array(
			'name' => _x( 'Text color', 'theme-options', 'the7mk2' ),
			'id' => 'content-primary_text_color',
			'std' => '#686868',
			'type' => 'color',
		);

		$options['fonts-h1_font_family'] = array(
			'name' => _x( 'Headers  font family', 'theme-options', 'the7mk2' ),
			'id' => 'fonts-h1_font_family',
			'std' => 'Open Sans:600',
			'type' => 'web_fonts',
			'options' => array(
				// 'Arial:600' => 'Arial Bold',
				// 'Tahoma:600' => 'Tahoma Bold',
				// 'Georgia:600' => 'Georgia Bold',
				// 'Times New Roman:600' => 'Times New Roman Bold',
				// 'Trebuchet MS:600' => 'Trebuchet MS Bold',
				// 'Open Sans:600' => 'Open Sans Bold (600)',
				// 'Roboto:700' => 'Roboto Bold (700)',
				// 'Lato:700' => 'Lato Bold (700)',
				// 'PT Sans:700' => 'PT Sans Bold (700)',
				// 'Source Sans Pro:600' => 'Source Sans Pro Bold (600)',
				// 'Exo 2:600' => 'Exo 2 Bold (600)',
				// 'Ubuntu:700' => 'Ubuntu Bold (700)',
				// 'Istok Web:700' => 'Istok Web Bold (700)',
				// 'Arvo' => 'Arvo',
				// 'Abril Fatface' => 'Abril Fatface',
				// 'Vollkorn' => 'Vollkorn',
				// 'Roboto Condensed:700' => 'Roboto Condensed Bold (700)',
				// 'Roboto Slab' => 'Roboto Slab',
				// 'Merriweather:700' => 'Merriweather Bold (700)',
				// 'Oswald' => 'Oswald',
				// 'Dosis:700' => 'Dosis Bold (700)',
				// 'Raleway:600' => 'Raleway Bold (600)',

				'Abril Fatface' => 'Abril Fatface',
				'Arial:600' => 'Arial Bold',
				'Arvo' => 'Arvo',
				'Dosis:700' => 'Dosis Bold (700)',
				'Exo 2:600' => 'Exo 2 Bold (600)',
				'Georgia:600' => 'Georgia Bold',
				'Istok Web:700' => 'Istok Web Bold (700)',
				'Lato:700' => 'Lato Bold (700)',
				'Merriweather:700' => 'Merriweather Bold (700)',
				'Open Sans:600' => 'Open Sans Bold (600)',
				'Oswald' => 'Oswald',
				'PT Sans:700' => 'PT Sans Bold (700)',
				'Raleway:600' => 'Raleway Bold (600)',
				'Roboto Condensed:700' => 'Roboto Condensed Bold (700)',
				'Roboto Slab' => 'Roboto Slab',
				'Roboto:700' => 'Roboto Bold (700)',
				'Source Sans Pro:600' => 'Source Sans Pro Bold (600)',
				'Tahoma:600' => 'Tahoma Bold',
				'Times New Roman:600' => 'Times New Roman Bold',
				'Trebuchet MS:600' => 'Trebuchet MS Bold',
				'Ubuntu:700' => 'Ubuntu Bold (700)',
				'Vollkorn' => 'Vollkorn',
			),
		);

		$options['content-headers_color'] = array(
			'name' => _x( 'Headers color', 'theme-options', 'the7mk2' ),
			'id' => 'content-headers_color',
			'std' => '#252525',
			'type' => 'color',
		);

	$options[] = array( 'name' => _x( 'Color Accent', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-accent_color_mode'] = array(
			'name'		=> _x( 'Accent color', 'theme-options', 'the7mk2' ),
			'id'		=> 'general-accent_color_mode',
			'std'		=> 'color',
			'type'		=> 'images',
			'class'     => 'small',
			'show_hide'	=> array(
				'color' 	=> 'general-accent_color_mode-color',
				'gradient'	=> 'general-accent_color_mode-gradient'
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

		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-accent_color_mode general-accent_color_mode-color' );

			$options['general-accent_bg_color'] = array(
				'name'	=> '&nbsp;',
				'id'	=> 'general-accent_bg_color',
				'std'	=> '#D73B37',
				'type'	=> 'color'
			);

		$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-accent_color_mode general-accent_color_mode-gradient' );

			$options['general-accent_bg_color_gradient'] = array(
				'name'	=> '&nbsp;',
				'id'	=> 'general-accent_bg_color_gradient',
				'std'	=> array( '#ffffff', '#000000' ),
				'type'	=> 'gradient'
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'name' => _x( 'Categorization, sorting & pagination style', 'theme-options', 'the7mk2' ), 'type' => 'block' );

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

	$options[] = array( 'name' => _x( 'Buttons style', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['buttons-style'] = array(
			'name' => 'Choose buttons style',
			'id' => 'buttons-style',
			'std' => 'ios7',
			'type' => 'images',
			'class' => 'small',
			'options' => array(
				'ios7' => array(
					'title' => _x( 'iOS', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/buttons-style-ios.gif',
				),
				'flat' => array(
					'title' => _x( 'Flat', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/buttons-style-flat.gif',
				),
				'3d' => array(
					'title' => _x( '3D', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/buttons-style-3d.gif',
				),
				'material' => array(
					'title' => _x( 'Material design', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/buttons-style-material.gif',
				),
			),
		);

	$options[] = array(	'name' => _x('Border radius', 'theme-options', 'the7mk2'), 'type' => 'block' );

		$options[] = array(
			'name'		=> _x( 'Border Radius (px)', 'theme-options', 'the7mk2' ),
			'id'		=> 'general-border_radius',
			'std'		=> '8',
			'type'		=> 'text',
			'sanitize'	=> 'dimensions'
		);

$options[] = array( 'name' => _x( 'Top Bar & Header', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Header layout', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-layout'] = array(
			'id'        => 'header-layout',
			'name'      => _x( 'Choose layout', 'theme-options', 'the7mk2' ),
			'type'      => 'images',
			'std'       => 'classic',
			'style'     => 'vertical',
			'class'     => 'option-header-layout',
			'options'   => array(
				'classic'       => array(
					'title' => _x( 'Classic header', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/classic-header.gif',
				),
				'inline'        => array(
					'title' => _x( 'Inline header', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/inline-header.gif',
				),
				'split'         => array(
					'title' => _x( 'Split header', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/split-header.gif',
				),
				'side'          => array(
					'title' => _x( 'Side header', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/side-header.gif',
				),
				'slide_out'     => array(
					'title' => _x( 'Side navigation on click', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/slide-out-header.gif',
				),
				'overlay'       => array(
					'title' => _x( 'Overlay navigation', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/overlay-header.gif',
				),
			),
			'show_hide' => array(
				'classic'       => array( 'header-layout-classic-settings' ),
				'inline'        => array( 'header-layout-inline-settings' ),
				'split'         => array( 'header-layout-split-settings' ),
				'side'          => array( 'header-layout-side-settings' ),
				'slide_out'     => array( 'header-layout-slide_out-settings' ),
				'overlay'       => array( 'header-layout-overlay-settings' ),
			),
		);

		$options[] = array( 'type' => 'divider' );

		/**
		 * Classic layout.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-classic-settings' );

			$options['header-classic-logo-position'] = array(
				'id'      => 'header-classic-logo-position',
				'name'    => _x( 'Logo position', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'left',
				'options' => array(
					'left'   => array(
						'title' => _x( 'Left', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-classic-logo-position-left.gif',
					),
					'center' => array(
						'title' => _x( 'Center', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-classic-logo-position-center.gif',
					),
				),
				'class'   => 'small',
			);

			$options[] = array( 'type' => 'divider' );

			$options['header-classic-menu-position'] = array(
				'id'      => 'header-classic-menu-position',
				'name'    => _x( 'Menu position', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'left',
				'options' => array(
					'left'    => array(
						'title' => _x( 'Left', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-classic-menu-position-left.gif',
					),
					'center'  => array(
						'title' => _x( 'Center', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-classic-menu-position-center.gif',
					),
					'justify' => array(
						'title' => _x( 'Justified', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-classic-menu-position-justify.gif',
					),
				),
				'class'   => 'small',
			);

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Inline header.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-inline-settings' );

			$options['header-inline-menu-position'] = array(
				'id'      => 'header-inline-menu-position',
				'name'    => _x( 'Menu position', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'right',
				'options' => array(
					'left'    => array(
						'title' => _x( 'Left', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-inline-menu-position-left.gif',
					),
					'right'   => array(
						'title' => _x( 'Right', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-inline-menu-position-right.gif',
					),
					'center'  => array(
						'title' => _x( 'Center', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-inline-menu-position-center.gif',
					),
					'justify' => array(
						'title' => _x( 'Justified', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-inline-menu-position-justify.gif',
					),
				),
				'class'   => 'small',
			);

			$options[] = array( 'type' => 'divider' );

			$options['header-inline-is_fullwidth'] = array(
				'id'   => 'header-inline-is_fullwidth',
				'name' => _x( 'Full-width header', 'theme-options', 'the7mk2' ),
				'type'		=> 'images',
				'class'     => 'small',
				'std'  => '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-inline-isfullwidth-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-inline-isfullwidth-disabled.gif',
					),
				),
			);

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Split header.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-split-settings' );

			$options[] = array(
				'desc' => sprintf( _x( 'To display split menu You should <a href="%1$s">create</a> two separate custom menus and <a href="%2$s">assign</a> them to "Split Menu Left" and "Split Menu Right" locations.', 'theme-options', 'the7mk2' ), admin_url( 'nav-menus.php' ), admin_url( 'nav-menus.php?action=locations' ) ),
				'type' => 'info',
			);

			$options['header-split-menu-position'] = array(
				'id'      => 'header-split-menu-position',
				'name'    => _x( 'Menu position', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'inside',
				'options' => array(
					'justify'          => array(
						'title' => _x( 'Justified', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-split-menu-position-justify.gif',
					),
					'inside'           => array(
						'title' => _x( 'Menu inside, microwidgets outside', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-split-menu-position-inside.gif',
					),
					'fully_inside'     => array(
						'title' => _x( 'Menu inside, microwidgets inside', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-split-menu-position-fullyinside.gif',
					),
					'outside'          => array(
						'title' => _x( 'Menu outside, microwidgets outside', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-split-menu-position-outside.gif',
					),
				),
				'class'   => 'small',
			);

			$options[] = array( 'type' => 'divider' );

			$options['header-split-is_fullwidth'] = array(
				'id'   => 'header-split-is_fullwidth',
				'name' => _x( 'Full-width header', 'theme-options', 'the7mk2' ),
				'type'		=> 'images',
				'class'     => 'small',
				'std'  => '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-split-isfullwidth-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-split-isfullwidth-disabled.gif',
					),
				),
			);

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Side header.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-side-settings' );

			$options['header-side-position'] = array(
				'id'      => 'header-side-position',
				'name'    => _x( 'Header position', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'left',
				'options' => array(
					'left'   => array(
						'title' => _x( 'Left', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-side-position-left.gif',
					),
					'right'  => array(
						'title' => _x( 'Right', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-side-position-right.gif',
					),
				),
				'class'   => 'small',
			);

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Side on click header.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-slide_out-settings' );

			$options['header-slide_out-layout'] = array(
				'name'    => _x( 'Layout', 'theme-options', 'the7mk2' ),
				'id'      => 'header-slide_out-layout',
				'type'    => 'images',
				'std'     => 'menu_icon',
				'options' => array(
					'menu_icon'     => array(
						'title' => _x( 'Menu icon only', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-slideout-layout-menuicon.gif',
					),
					'top_line'      => array(
						'title' => _x( 'Top line', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-slideout-layout-topline.gif',
					),
					'side_line'     => array(
						'title' => _x( 'Side line', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-slideout-layout-sideline.gif',
					),
				),
				'class'   => 'small',
			);

			$options[] = array( 'type' => 'divider' );

			$options['header-slide_out-position'] = array(
				'id'      => 'header-slide_out-position',
				'name'    => _x( 'Header position', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'left',
				'options' => array(
					'left'   => array(
						'title' => _x( 'Left', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-position-left.gif',
					),
					'right'  => array(
						'title' => _x( 'Right', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-position-right.gif',
					),
				),
				'class'   => 'small',
			);

			$options['header-slide_out-overlay-animation'] = array(
				'id'      => 'header-slide_out-overlay-animation',
				'name'    => _x( 'Animation', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'fade',
				'options' => array(
					'fade'     => array(
						'title' => _x( 'Fade', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-slideout-overlay-animation-fade.gif',
					),
					'slide'    => array(
						'title' => _x( 'Slide', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-slideout-overlay-animation-slide.gif',
					),
					'move'     => array(
						'title' => _x( 'Move', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-slideout-overlay-animation-move.gif',
					),
				),
				'class'   => 'small',
			);

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Overlay navigation.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-overlay-settings' );

			$options['header-overlay-layout'] = array(
				'name'    => _x( 'Layout', 'theme-options', 'the7mk2' ),
				'id'      => 'header-overlay-layout',
				'type'    => 'images',
				'std'     => 'menu_icon',
				'options' => array(
					'menu_icon'     => array(
						'title' => _x( 'Menu icon only', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-slideout-layout-menuicon.gif',
					),
					'top_line'      => array(
						'title' => _x( 'Top line', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-slideout-layout-topline.gif',
					),
					'side_line'     => array(
						'title' => _x( 'Side line', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-slideout-layout-sideline.gif',
					),
				),
				'class'   => 'small',
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'name' => _x( 'Top bar', 'theme-options', 'the7mk2' ), 'class' => 'header-top_bar-block', 'type' => 'block' );

		$options[] = array(
			'desc' => sprintf( _x( 'You can set up micro widgets layout and content <a href="%s">here</a>.', 'theme-options', 'the7mk2' ), admin_url( 'admin.php?page=of-header-menu#admin-options-group-1' ) ),
			'type' => 'info',
		);

		$options['top_bar-font-color'] = array(
			'id'    => 'top_bar-font-color',
			'name'  => _x( 'Top bar font color', 'theme-options', 'the7mk2' ),
			'type'  => 'color',
			'std'   => '#686868',
		);

		$options[] = array( 'type' => 'divider' );

		$options['top_bar-bg-style'] = array(
			'id'      => 'top_bar-bg-style',
			'name'    => _x( 'Top bar background / line', 'theme-options', 'the7mk2' ),
			'type'    => 'images',
			'std'     => 'content_line',
			'options' => array(
				'disabled'       => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/topbar-bg-style-disabled.gif',
				),
				'content_line'   => array(
					'title' => _x( 'Content-width line', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/topbar-bg-style-contentline.gif',
				),
				'fullwidth_line' => array(
					'title' => _x( 'Full-width line', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/topbar-bg-style-fullwidthline.gif',
				),
				'solid'          => array(
					'title' => _x( 'Background', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/topbar-bg-style-solid.gif',
				),
			),
			'class'  => 'small',
		);

			// if not disabled

			$options['top_bar-bg-color'] = array(
				'id'         => 'top_bar-bg-color',
				'name'       => _x( 'Background (line) color', 'theme-options', 'the7mk2' ),
				'type'       => 'color',
				'std'        => '#ffffff',
				'divider'    => 'top',
				'dependency' => array(
					array(
						array(
							'field'    => 'top_bar-bg-style',
							'operator' => '==',
							'value'    => 'solid',
						),
					),
				),
			);

	$options[] = array( 'name' => _x( 'Header background', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-bg-color'] = array(
			'id'   => 'header-bg-color',
			'name' => _x( 'Color', 'theme-options', 'the7mk2' ),
			'type' => 'color',
			'std'  => '#000000',
		);

	$options[] = array( 'name' => _x( 'Top / Side line background', 'theme-options', 'the7mk2' ), 'class' => 'header-mixed-line-block', 'type' => 'block' );

		$options['header-mixed-bg-color'] = array(
			'id'   => 'header-mixed-bg-color',
			'name' => _x( 'Background color', 'theme-options', 'the7mk2' ),
			'type' => 'color',
			'std'  => '#000000',
		);

	$options[] = array( 'name' => _x( 'Main menu', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-menu-font-color'] = array(
			'id'	=> 'header-menu-font-color',
			'name'	=> _x( 'Font color', 'theme-options', 'the7mk2' ),
			'type'	=> 'color',
			'std'	=> '#ffffff',
		);

	$options[] = array( 'name' => _x( 'Submenu', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-menu-submenu-bg-color'] = array(
			'id'    => 'header-menu-submenu-bg-color',
			'name'  => _x( 'Background color', 'theme-options', 'the7mk2' ),
			'type'  => 'color',
			'std'   => '#ffffff',
		);

		$options['header-menu-submenu-bg-opacity'] = array(
			'id'		=> 'header-menu-submenu-bg-opacity',
			'name'		=> _x( 'Opacity', 'theme-options', 'the7mk2' ),
			'type'		=> 'slider',
			'std'		=> 30,
		);

		$options['header-menu-submenu-font-color'] = array(
			'id'	=> 'header-menu-submenu-font-color',
			'name'	=> _x( 'Font color', 'theme-options', 'the7mk2' ),
			'type'	=> 'color',
			'std'	=> '#ffffff',
		);

	$options[] = array( 'name' => _x( 'Floating navigation', 'theme-options', 'the7mk2' ), 'class' => 'header-floating-nav-block', 'type' => 'block' );

		$options['header-show_floating_navigation'] = array(
			'id'		=> 'header-show_floating_navigation',
			'name'		=> _x( 'Floating navigation', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> '1',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/header-showfloatingnavigation-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/header-showfloatingnavigation-disabled.gif',
				),
			),
			'show_hide'	=> array( '1' => true ),
		);

		$options[] = array( 'type' => 'js_hide_begin' );

			$options[] = array( 'type' => 'divider' );

			$options['header-floating_navigation-style'] = array(
				'id'		=> 'header-floating_navigation-style',
				'name'		=> _x( 'Effect', 'theme-options', 'the7mk2' ),
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> 'fade',
				'options'	=> array(
					'fade'   => array(
						'title' => _x( 'Fade on scroll', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-floatingnavigationstyle-fade.gif',
					),
					'slide'  => array(
						'title' => _x( 'Slide on scroll', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-floatingnavigationstyle-slide.gif',
					),
					'sticky' => array(
						'title' => _x( 'Sticky', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-floatingnavigationstyle-sticky.gif',
					),
				),
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'name' => _x( 'Mobile header', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'mobile-header', 'header-mobile-second_switch', array(
			'after'  => array( 'name' => _x( 'Switch after', 'theme-options', 'the7mk2' ) ),
			'height' => false,
			'layout' => array(
				'type'    => 'images',
				'options' => array(
					'left_right'   => array(
						'title' => _x( 'Left menu + right logo', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-mobile-secondswitch-layout-l-r.gif',
					),
					'left_center'  => array(
						'title' => _x( 'Left menu + centered logo', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-mobile-secondswitch-layout-l-c.gif',
					),
					'right_left'   => array(
						'title' => _x( 'Right menu + left logo', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-mobile-secondswitch-layout-r-l.gif',
					),
					'right_center' => array(
						'title' => _x( 'Right menu + centered logo', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-mobile-secondswitch-layout-r-c.gif',
					),
				),
				'class'   => 'small',
				'divider' => false,
			),
		) );

	$options[] = array( 'name' => _x( 'Floating mobile navigation', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-mobile-floating_navigation'] = array(
			'id'      => 'header-mobile-floating_navigation',
			'name'    => _x( 'Floating mobile navigation', 'theme-options', 'the7mk2' ),
			'type'    => 'images',
			'std'     => 'menu_icon',
			'options' => array(
				'disabled'     => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-mobile-floating_navigation-disabled.gif',
				),
				'sticky'    => array(
					'title' => _x( 'Sticky mobile header', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-mobile-floating_navigation-sticky-header.gif',
				),
				'menu_icon'    => array(
					'title' => _x( 'Floating menu icon', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-mobile-floating_navigation-icon.gif',
				),
			),
			'class'   => 'small',
		);

$options[] = array( 'name' => _x( 'Branding', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Main', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'header' );

	$options[] = array( 'name' => _x( 'Transparent header', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'header-style-transparent' );

	$options[] = array( 'name' => _x( 'Menu icon / top line / side line', 'theme-options', 'the7mk2' ), 'class' => 'branding-menu-icon-block', 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'header-style-mixed' );

	$options[] = array( 'name' => _x( 'Floating navigation', 'theme-options', 'the7mk2'), 'class' => 'branding-floating-nav-block', 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'header-style-floating' );

	$options[] = array( 'name' => _x( 'Mobile', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'header-style-mobile' );

	$options[] = array( 'name' => _x( 'Bottom bar', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'bottom_bar' );

	$options[] = array( 'name' => _x( 'Favicon', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-favicon'] = array(
			'id'	=> 'general-favicon',
			'name'	=> _x( 'Regular (16x16 px)', 'theme-options', 'the7mk2' ),
			'type'	=> 'upload',
			'std'	=> '',
		);

		$options['general-favicon_hd'] = array(
			'id'	=> 'general-favicon_hd',
			'name'	=> _x( 'High-DPI (32x32 px)', 'theme-options', 'the7mk2' ),
			'type'	=> 'upload',
			'std'	=> '',
		);

	$options[] = array(	'name' => _x( 'Copyright information', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['bottom_bar-copyrights'] = array(
			'id'		=> 'bottom_bar-copyrights',
			'name'		=> _x( 'Copyright information', 'theme-options', 'the7mk2' ),
			'type'		=> 'textarea',
			'std'		=> false,
		);

		$options['bottom_bar-credits'] = array(
			'id'		=> 'bottom_bar-credits',
			'name'		=> _x( 'Give credits to Dream-Theme', 'theme-options', 'the7mk2' ),
			'type'		=> 'checkbox',
			'std'		=> '1',
		);

$options[] = array( 'name' => _x( 'Sidebar & Footer', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Sidebar style', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['sidebar-visual_style'] = array(
			'name' => _x( 'Sidebar style', 'theme-options', 'the7mk2' ),
			'id' => 'sidebar-visual_style',
			'std' => 'with_dividers',
			'type' => 'images',
			'class' => 'small',
			'options' => array(
				'with_dividers' => array(
					'title' => _x( 'Dividers', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/sidebar-visual_style-dividers.gif',
				),
				'with_bg' => array(
					'title' => _x( 'Background behind whole sidebar', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/sidebar-visual_style-background-behind-whole-sidebar.gif',
				),
				'with_widgets_bg' => array(
					'title' => _x( 'Background behind each widget', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/sidebar-visual_style-background-behind-each-widget.gif',
				),
			),
		);

	$options[] = array( 'name' => _x( 'Footer style', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['footer-bg_color'] = array(
			'name' => _x( 'Background color', 'theme-options', 'the7mk2' ),
			'id' => 'footer-bg_color',
			'std' => '#1B1B1B',
			'type' => 'color',
		);

		$options['footer-headers_color'] = array(
			'name' => _x( 'Headers color', 'theme-options', 'the7mk2' ),
			'id' => 'footer-headers_color',
			'std' => '#ffffff',
			'type' => 'color'
		);

		$options['footer-primary_text_color'] = array(
			'name' => _x( 'Content color', 'theme-options', 'the7mk2' ),
			'id' => 'footer-primary_text_color',
			'std' => '#828282',
			'type' => 'color'
		);

	$options[] = array( 'name' => _x( 'Footer layout', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['footer-layout'] = array(
			'name' => _x( 'Layout', 'theme-options', 'the7mk2' ),
			'desc' => _x( 'E.g. "1/4+1/4+1/2"', 'theme-options', 'the7mk2' ),
			'id' => 'footer-layout',
			'std' => '1/4+1/4+1/4+1/4',
			'type' => 'text',
		);
