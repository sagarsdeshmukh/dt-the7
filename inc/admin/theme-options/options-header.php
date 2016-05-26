<?php
/**
 * Header.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$options[] = array( 'name' => _x( 'Layout', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

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
				'classic'       => array( 'header-layout-classic-microwidgets', 'header-layout-classic-settings' ),
				'inline'        => array( 'header-layout-inline-microwidgets', 'header-layout-inline-settings' ),
				'split'         => array( 'header-layout-split-microwidgets', 'header-layout-split-settings' ),
				'side'          => array( 'header-layout-side-microwidgets', 'header-layout-side-settings' ),
				'slide_out'     => array( 'header-layout-slide_out-microwidgets', 'header-layout-slide_out-settings' ),
				'overlay'       => array( 'header-layout-overlay-microwidgets', 'header-layout-overlay-settings' ),
			),
		);

		/**
		 * Classic layout.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-classic-microwidgets' );

			$options[] = array( 'type' => 'divider' );

			$options['header-classic-show_elements'] = array(
				'id'		=> 'header-classic-show_elements',
				'name'		=> _x( 'Microwidgets', 'theme-options', 'the7mk2' ),
				'desc'      => 'When enabled, microwidgets can  be rearranged below. You can set them up in dedicated "Microwidgets" tab.',
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
					),
				),
				'show_hide' => array( '1' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-classic-elements'] = array(
					'id'			=> 'header-classic-elements',
					'type'			=> 'sortable',
					'std'			=> array(),
					'palette_title' => _x( 'Inactive elements', 'theme-options', 'the7mk2' ),
					'items'			=> presscore_options_get_header_layout_elements(),
					'fields'		=> array(
						'top_bar_left'    => array(
							'title'         => _x( 'Top bar left', 'theme-options', 'the7mk2' ),
							'class'         => 'field-blue',
						),
						'top_bar_right'   => array(
							'title'         => _x( 'Top bar right', 'theme-options', 'the7mk2' ),
							'class'         => 'field-blue',
						),
						'near_menu_right'   => array(
							'title'         => _x( 'Near menu', 'theme-options', 'the7mk2' ),
							'class'         => 'field-green',
						),
						'near_logo_left'  => array(
							'title'         => _x( 'Near logo (left)', 'theme-options', 'the7mk2' ),
							'class'         => 'field-red',
						),
						'near_logo_right' => array(
							'title'         => _x( 'Near logo (right)', 'theme-options', 'the7mk2' ),
							'class'         => 'field-red',
						),
					),
				);

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area near menu', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				// horizontal
				presscore_options_apply_template( $options, 'indents', 'header-classic-elements-near_menu_right-padding' );

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area near logo (left)', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				// horizontal
				presscore_options_apply_template( $options, 'indents', 'header-classic-elements-near_logo_left-padding' );

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area near logo (right)', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				// horizontal
				presscore_options_apply_template( $options, 'indents', 'header-classic-elements-near_logo_right-padding' );

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Inline header.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-inline-microwidgets' );

			$options[] = array( 'type' => 'divider' );

			$options['header-inline-show_elements'] = array(
				'id'		=> 'header-inline-show_elements',
				'name'		=> _x( 'Microwidgets', 'theme-options', 'the7mk2' ),
				'desc'      => 'When enabled, microwidgets can  be rearranged below. You can set them up in dedicated "Microwidgets" tab.',
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
					),
				),
				'show_hide' => array( '1' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-inline-elements'] = array(
					'id'			=> 'header-inline-elements',
					'type'			=> 'sortable',
					'std'			=> array(),
					'palette_title' => _x( 'Inactive elements', 'theme-options', 'the7mk2' ),
					'items'			=> presscore_options_get_header_layout_elements(),
					'fields'		=> array(
						'top_bar_left'      => array(
							'title'         => _x( 'Top bar left', 'theme-options', 'the7mk2' ),
							'class'         => 'field-blue',
						),
						'top_bar_right'     => array(
							'title'         => _x( 'Top bar right', 'theme-options', 'the7mk2' ),
							'class'         => 'field-blue',
						),
						'near_menu_right'   => array(
							'title'         => _x( 'Near menu', 'theme-options', 'the7mk2' ),
							'class'         => 'field-green',
						),
					),
				);

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area near menu', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				// horizontal
				presscore_options_apply_template( $options, 'indents', 'header-inline-elements-near_menu_right-padding' );

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Split header.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-split-microwidgets' );

			$options[] = array( 'type' => 'divider' );

			$options[] = array(
				'desc' => sprintf( _x( 'To display split menu You should <a href="%1$s">create</a> two separate custom menus and <a href="%2$s">assign</a> them to "Split Menu Left" and "Split Menu Right" locations.', 'theme-options', 'the7mk2' ), admin_url( 'nav-menus.php' ), admin_url( 'nav-menus.php?action=locations' ) ),
				'type' => 'info',
			);

			$options['header-split-show_elements'] = array(
				'id'		=> 'header-split-show_elements',
				'name'		=> _x( 'Microwidgets', 'theme-options', 'the7mk2' ),
				'desc'      => 'When enabled, microwidgets can  be rearranged below. You can set them up in dedicated "Microwidgets" tab.',
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
					),
				),
				'show_hide' => array( '1' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-split-elements'] = array(
					'id'			=> 'header-split-elements',
					'type'			=> 'sortable',
					'std'			=> array(),
					'palette_title' => _x( 'Inactive elements', 'theme-options', 'the7mk2' ),
					'items'			=> presscore_options_get_header_layout_elements(),
					'fields'		=> array(
						'top_bar_left'    => array(
							'title'         => _x( 'Top bar left', 'theme-options', 'the7mk2' ),
							'class'         => 'field-blue',
						),
						'top_bar_right'   => array(
							'title'         => _x( 'Top bar right', 'theme-options', 'the7mk2' ),
							'class'         => 'field-blue',
						),
						'near_menu_left'  => array(
							'title'         => _x( 'Near menu (left)', 'theme-options', 'the7mk2' ),
							'class'         => 'field-green',
						),
						'near_menu_right' => array(
							'title'         => _x( 'Near menu (right)', 'theme-options', 'the7mk2' ),
							'class'         => 'field-green',
						),
					),
				);

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area near menu (left)', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				// horizontal
				presscore_options_apply_template( $options, 'indents', 'header-split-elements-near_menu_left-padding' );

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area near menu (right)', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				// horizontal
				presscore_options_apply_template( $options, 'indents', 'header-split-elements-near_menu_right-padding' );

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Side header.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-side-microwidgets' );

			$options[] = array( 'type' => 'divider' );

			$options['header-side-show_elements'] = array(
				'id'		=> 'header-side-show_elements',
				'name'		=> _x( 'Microwidgets', 'theme-options', 'the7mk2' ),
				'desc'      => 'When enabled, microwidgets can  be rearranged below. You can set them up in dedicated "Microwidgets" tab.',
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
					),
				),
				'show_hide' => array( '1' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-side-elements'] = array(
					'id'			=> 'header-side-elements',
					'type'			=> 'sortable',
					'std'			=> array(),
					'palette_title' => _x( 'Inactive elements', 'theme-options', 'the7mk2' ),
					'items'			=> presscore_options_get_header_layout_elements(),
					'fields'		=> array(
						'below_menu'  => array(
							'title'         => _x( 'Below menu', 'theme-options', 'the7mk2' ),
							'class'         => 'field-green',
						),
					),
				);

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area below menu', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				presscore_options_apply_template( $options, 'indents', 'header-side-elements-below_menu-padding' );

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Side on click header.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-slide_out-microwidgets' );

			$options[] = array( 'type' => 'divider' );

			$options['header-slide_out-show_elements'] = array(
				'id'        => 'header-slide_out-show_elements',
				'name'      => _x( 'Microwidgets', 'theme-options', 'the7mk2' ),
				'desc'      => 'When enabled, microwidgets can  be rearranged below. You can set them up in dedicated "Microwidgets" tab.',
				'type'		=> 'images',
				'class'     => 'small',
				'std'       => '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
					),
				),
				'show_hide' => array( '1' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-slide_out-elements'] = array(
					'id'            => 'header-slide_out-elements',
					'type'          => 'sortable',
					'std'           => array(),
					'palette_title' => _x( 'Inactive elements', 'theme-options', 'the7mk2' ),
					'items'         => presscore_options_get_header_layout_elements(),
					'fields'        => array(
						'side_top_line'  => array(
							'title'         => _x( 'Top line', 'theme-options', 'the7mk2' ),
							'class'         => 'field-red',
						),
						'below_menu'     => array(
							'title'         => _x( 'Below menu', 'theme-options', 'the7mk2' ),
							'class'         => 'field-green',
						),
					),
				);

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area in top line', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				// horizontal
				presscore_options_apply_template( $options, 'indents', 'header-slide_out-elements-top_line-padding' );

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area below menu', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				presscore_options_apply_template( $options, 'indents', 'header-slide_out-elements-below_menu-padding' );

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Overlay navigation.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-overlay-microwidgets' );

			$options[] = array( 'type' => 'divider' );

			$options['header-overlay-show_elements'] = array(
				'id'        => 'header-overlay-show_elements',
				'name'      => _x( 'Microwidgets', 'theme-options', 'the7mk2' ),
				'desc'      => 'When enabled, microwidgets can  be rearranged below. You can set them up in dedicated "Microwidgets" tab.',
				'type'		=> 'images',
				'class'     => 'small',
				'std'       => '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
					),
				),
				'show_hide' => array( '1' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-overlay-elements'] = array(
					'id'			=> 'header-overlay-elements',
					'type'			=> 'sortable',
					'std'			=> array(),
					'palette_title' => _x( 'Inactive elements', 'theme-options', 'the7mk2' ),
					'items'			=> presscore_options_get_header_layout_elements(),
					'fields'		=> array(
						'side_top_line' => array(
							'title'         => _x( 'Top line', 'theme-options', 'the7mk2' ),
							'class'         => 'field-red',
						),
						'below_menu'    => array(
							'title'         => _x( 'Below menu', 'theme-options', 'the7mk2' ),
							'class'         => 'field-green',
						),
					),
				);

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area in top line', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				// horizontal
				presscore_options_apply_template( $options, 'indents', 'header-overlay-elements-top_line-padding' );

				$options[] = array( 'type' => 'divider' );

				$options[] = array( 'name' => _x( 'Area below menu', 'theme-options', 'the7mk2' ), 'type' => 'title' );

				presscore_options_apply_template( $options, 'indents', 'header-overlay-elements-below_menu-padding' );

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'name' => _x( 'Layout settings', 'theme-options', 'the7mk2' ), 'class' => '', 'type' => 'block' );

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

			$options['header-classic-menu-margin-top'] = array(
				'id'         => 'header-classic-menu-margin-top',
				'name'       => _x( 'Margin above menu (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '0',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
			);

			$options['header-classic-menu-margin-bottom'] = array(
				'id'         => 'header-classic-menu-margin-bottom',
				'name'       => _x( 'Margin below menu (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '0',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
			);

			$options[] = array( 'type' => 'divider' );

			$options['header-classic-height'] = array(
				'id'         => 'header-classic-height',
				'name'       => _x( 'Header height (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '140',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
			);

			$options[] = array( 'type' => 'divider' );

			$options['header-classic-is_fullwidth'] = array(
				'id'   => 'header-classic-is_fullwidth',
				'name' => _x( 'Full-width header', 'theme-options', 'the7mk2' ),
				'type'		=> 'images',
				'class'     => 'small',
				'std'  => '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-classic-isfullwidth-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-classic-isfullwidth-disabled.gif',
					),
				),
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

			$options['header-inline-height'] = array(
				'id'         => 'header-inline-height',
				'name'       => _x( 'Header height (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '140',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
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

			$options['header-split-height'] = array(
				'id'         => 'header-split-height',
				'name'       => _x( 'Header height (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '100',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
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

			$options['header-side-width'] = array(
				'id'		=> 'header-side-width',
				'name'		=> _x( 'Header width (px or %)', 'theme-options', 'the7mk2' ),
				'type'		=> 'text',
				'std'		=> '300px', 
				'sanitize'	=> 'css_width',
			);

			presscore_options_apply_template( $options, 'side-header-content', 'header-side' );

			$options[] = array( 'type' => 'divider' );

			$options[] = array( 'name' => _x( 'Header content paddings', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			presscore_options_apply_template( $options, 'indents', 'header-side-content-padding' );

			$options[] = array( 'type' => 'divider' );

			presscore_options_apply_template( $options, 'side-header-menu', 'header-side' );

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Side on click header.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-slide_out-settings' );

			presscore_options_apply_template( $options, 'slideout-header-layout', 'header-slide_out' );

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

			$options['header-slide_out-width'] = array(
				'id'       => 'header-slide_out-width',
				'name'     => _x( 'Header width (px or %)', 'theme-options', 'the7mk2' ),
				'type'     => 'text',
				'std'      => '300px', 
				'sanitize' => 'css_width',
			);

			presscore_options_apply_template( $options, 'side-header-content', 'header-slide_out' );

			$options[] = array( 'type' => 'divider' );

			$options[] = array( 'name' => _x( 'Header content paddings', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			presscore_options_apply_template( $options, 'indents', 'header-slide_out-content-padding' );

			$options[] = array( 'type' => 'divider' );

			presscore_options_apply_template( $options, 'side-header-menu', 'header-slide_out' );

		$options[] = array( 'type' => 'js_hide_end' );

		/**
		 * Overlay navigation.
		 */
		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-overlay-settings' );

			presscore_options_apply_template( $options, 'slideout-header-layout', 'header-overlay', array(
				'layout-side_line-position' => false,
			) );

			$options[] = array( 'type' => 'divider' );

			presscore_options_apply_template( $options, 'side-header-content', 'header-overlay', array(
				'content-width' => array(
					'name' => _x( 'Width of content in overlay navigation (px or %)', 'theme-options', 'the7mk2' ),
					'std' => '400px',
				),
				'content-position' => array(
					'name' => _x( 'Position of content in overlay navigation', 'theme-options', 'the7mk2' ),
					'options' => array(
						'left' => array(
							'src' => '/inc/admin/assets/images/header-overlay-content-position-left.gif',
						),
						'center' => array(
							'src' => '/inc/admin/assets/images/header-overlay-content-position-center.gif',
						),
						'right' => array(
							'src' => '/inc/admin/assets/images/header-overlay-content-position-right.gif',
						),
					),
				),
			) );

			$options[] = array( 'type' => 'divider' );

			$options[] = array( 'name' => _x( 'Overlay navigation content paddings', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			presscore_options_apply_template( $options, 'indents', 'header-overlay-content-padding' );

			$options[] = array( 'type' => 'divider' );

			presscore_options_apply_template( $options, 'side-header-menu', 'header-overlay' );

		$options[] = array( 'type' => 'js_hide_end' );

$options[] = array( 'name' => _x( 'Top bar', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Top bar', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['top_bar-font-family'] = array(
			'id'        => 'top_bar-font-family',
			'name'      => _x( 'Top bar font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Open Sans',
			'fonts'     => 'all',
		);

		$options[] = array( 'type' => 'divider' );

		$options['top_bar-font-size'] = array(
			'id'        => 'top_bar-font-size',
			'name'      => _x( 'Top bar font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'sanitize'  => 'font_size',
			'std'       => 16, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
		);

		$options[] = array( 'type' => 'divider' );

		$options['top_bar-font-is_capitalized'] = array(
			'id'        => 'top_bar-font-is_capitalized',
			'name'      => _x( 'Capitalize ', 'theme-options', 'the7mk2' ),
			'type'      => 'checkbox',
			'std'       => 0,
		);

		$options[] = array( 'type' => 'divider' );

		$options['top_bar-font-color'] = array(
			'id'    => 'top_bar-font-color',
			'name'  => _x( 'Top bar font color', 'theme-options', 'the7mk2' ),
			'type'  => 'color',
			'std'   => '#686868',
		);

		$options[] = array( 'type' => 'divider' );

		// vertical
		presscore_options_apply_template( $options, 'indents-v', 'top_bar-paddings' );

		$options['top_bar-paddings-horizontal'] = array(
			'id'       => 'top_bar-paddings-horizontal',
			'name'     => _x( 'Side paddings (px)', 'theme-options', 'the7mk2' ),
			'type'     => 'text',
			'std'      => '0',
			'class'    => 'mini',
			'sanitize' => 'dimensions',
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
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
				),
			);

			$options['top_bar-bg-opacity'] = array(
				'id'         => 'top_bar-bg-opacity',
				'name'       => _x( 'Background (line) opacity', 'theme-options', 'the7mk2' ),
				'type'       => 'slider',
				'std'        => 100,
				'dependency' => array(
					array(
						array(
							'field'    => 'top_bar-bg-style',
							'operator' => '!=',
							'value'    => 'disabled',
						),
					),
				),
			);

			$options['top_bar-bg-image'] = array(
				'id'         => 'top_bar-bg-image',
				'name'       => _x( 'Add background image', 'theme-options', 'the7mk2' ),
				'type'       => 'background_img',
				'std'        => array(
					'image'      => '',
					'repeat'     => 'repeat',
					'position_x' => 'center',
					'position_y' => 'center',
				),
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

$options[] = array( 'name' => _x( 'Header', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Header / overlay navigation background', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-bg-color'] = array(
			'id'   => 'header-bg-color',
			'name' => _x( 'Background color', 'theme-options', 'the7mk2' ),
			'type' => 'color',
			'std'  => '#000000',
		);

		$options['header-bg-opacity'] = array(
			'id'   => 'header-bg-opacity',
			'name' => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
			'type' => 'slider',
			'std'  => 100,
		);

		$options['header-bg-image'] = array(
			'id'   => 'header-bg-image',
			'name' => _x( 'Add background image', 'theme-options', 'the7mk2' ),
			'type' => 'background_img',
			'std'  => array(
				'image'      => '',
				'repeat'     => 'repeat',
				'position_x' => 'center',
				'position_y' => 'center',
			),
		);

		$options['header-bg-is_fullscreen'] = array(
			'id'   => 'header-bg-is_fullscreen',
			'name' => _x( 'Fullscreen ', 'theme-options', 'the7mk2' ),
			'type' => 'checkbox',
			'std'  => 0,
		);

		$options['header-bg-is_fixed'] = array(
			'id'   => 'header-bg-is_fixed',
			'name' => _x( 'Fixed background ', 'theme-options', 'the7mk2' ),
			'type' => 'checkbox',
			'std'  => 0,
		);

		$options[] = array( 'type' => 'divider' );

		$options['header-decoration'] = array(
			'id'      => 'header-decoration',
			'name'    => _x( 'Header decoration', 'theme-options', 'the7mk2' ),
			'type'    => 'images',
			'std'     => 'shadow',
			'options' => array(
				'disabled' => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-decoration-disabled.gif',
				),
				'shadow'   => array(
					'title' => _x( 'Shadow', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-decoration-shadow.gif',
				),
				'line'     => array(
					'title' => _x( 'Line', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-decoration-line.gif',
				),
			),
			'class'   => 'small',
		);

			$options['header-decoration-color'] = array(
				'id'   => 'header-decoration-color',
				'name' => _x( 'Line color', 'theme-options', 'the7mk2' ),
				'type' => 'color',
				'std'  => '#ffffff',
				'dependency' => array(
					array(
						array(
							'field' => 'header-decoration',
							'operator' => '==',
							'value' => 'line',
						),
					),
				),
			);

			$options['header-decoration-opacity'] = array(
				'id'         => 'header-decoration-opacity',
				'name'       => _x( 'Line opacity', 'theme-options', 'the7mk2' ),
				'type'       => 'slider',
				'std'        => 100,
				'dependency' => array(
					array(
						array(
							'field' => 'header-decoration',
							'operator' => '==',
							'value' => 'line',
						),
					),
				),
			);

	$options[] = array( 'name' => _x( 'Menu background for "Classic" header', 'theme-options', 'the7mk2' ), 'class' => 'header-classic-menu-bg-block', 'type' => 'block' );

		$options['header-classic-menu-bg-style'] = array(
			'id'		=> 'header-classic-menu-bg-style',
			'name'		=> _x( 'Menu background / line', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'std'		=> 'disabled',
			'options'	=> array(
				'disabled'       => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-classic-menu-bg-style-disabled.gif',
				),
				'content_line'   => array(
					'title' => _x( 'Content-width line', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-classic-menu-bg-style-contentline.gif',
				),
				'fullwidth_line' => array(
					'title' => _x( 'Full-width line', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-classic-menu-bg-style-fullwidthline.gif',
				),
				'solid'          => array(
					'title' => _x( 'Background', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-classic-menu-bg-style-solid.gif',
				),
			),
			'class'     => 'small',
		);

			$options['header-classic-menu-bg-color'] = array(
				'id'    => 'header-classic-menu-bg-color',
				'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
				'type'  => 'color',
				'std'   => '#ffffff',
				'dependency' => array(
					array(
						array(
							'field' => 'header-classic-menu-bg-style',
							'operator' => '!=',
							'value' => 'disabled',
						),
					),
				),
			);

			$options['header-classic-menu-bg-opacity'] = array(
				'id'		=> 'header-classic-menu-bg-opacity',
				'name'		=> _x( 'Opacity', 'theme-options', 'the7mk2' ),
				'type'		=> 'slider',
				'std'		=> 100, 
				'dependency' => array(
					array(
						array(
							'field' => 'header-classic-menu-bg-style',
							'operator' => '!=',
							'value' => 'disabled',
						),
					),
				),
			);

	$options[] = array( 'name' => _x( 'Menu icon (hamburger)', 'theme-options', 'the7mk2' ), 'class' => 'header-hamburger-block', 'type' => 'block' );

		$options['header-menu_icon-color'] = array(
			'id'   => 'header-menu_icon-color',
			'name' => _x( '"Open menu" icon color', 'theme-options', 'the7mk2' ),
			'type' => 'color',
			'std'  => '#ffffff',
		);

		$options['header-menu_icon-bg-color'] = array(
			'id'   => 'header-menu_icon-bg-color',
			'name' => _x( '"Open menu" background', 'theme-options', 'the7mk2' ),
			'type' => 'color',
			'std'  => '#ffffff',
		);

		$options['header-menu_icon-bg-opacity'] = array(
			'id'   => 'header-menu_icon-bg-opacity',
			'name' => _x( '"Open menu" background opacity', 'theme-options', 'the7mk2' ),
			'type' => 'slider',
			'std'  => 100,
		);

		$options[] = array( 'type' => 'divider' );

		$options['header-menu_icon-hover-color'] = array(
			'id'   => 'header-menu_icon-hover-color',
			'name' => _x( '"Close menu" icon color', 'theme-options', 'the7mk2' ),
			'type' => 'color',
			'std'  => '#ffffff',
		);

		$options['header-menu_icon-hover-bg-color'] = array(
			'id'   => 'header-menu_icon-hover-bg-color',
			'name' => _x( '"Close menu" background', 'theme-options', 'the7mk2' ),
			'type' => 'color',
			'std'  => '#ffffff',
		);

		$options['header-menu_icon-hover-bg-opacity'] = array(
			'id'   => 'header-menu_icon-hover-bg-opacity',
			'name' => _x( '"Close menu" background opacity', 'theme-options', 'the7mk2' ),
			'type' => 'slider',
			'std'  => 100,
		);

		$options[] = array( 'type' => 'divider' );

		presscore_options_apply_template( $options, 'indents-margins', 'header-menu_icon-margin' );

		$options[] = array( 'type' => 'divider' );

		$options['header-menu_icon-bg-border-radius'] = array(
			'id'         => 'header-menu_icon-bg-border-radius',
			'name'       => _x( 'Background border radius (px)', 'theme-options', 'the7mk2' ),
			'type'       => 'text',
			'std'        => '0',
			'class'      => 'mini',
			'sanitize'   => 'dimensions',
		);

	$options[] = array( 'name' => _x( 'Line background for "Navigation on click" headers', 'theme-options', 'the7mk2' ), 'class' => 'header-mixed-line-block', 'type' => 'block' );

		$options['header-mixed-decoration'] = array(
			'id'      => 'header-mixed-decoration',
			'name'    => _x( 'Header decoration', 'theme-options', 'the7mk2' ),
			'type'    => 'images',
			'std'     => 'shadow',
			'options' => array(
				'disabled' => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-mixed-decoration-disabled.gif',
				),
				'shadow'   => array(
					'title' => _x( 'Shadow', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-mixed-decoration-shadow.gif',
				),
				'line'     => array(
					'title' => _x( 'Line', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-mixed-decoration-line.gif',
				),
			),
			'class'   => 'small',
		);

			$options['header-mixed-decoration-color'] = array(
				'id'         => 'header-mixed-decoration-color',
				'name'       => _x( 'Line color', 'theme-options', 'the7mk2' ),
				'type'       => 'color',
				'std'        => '#ffffff',
				'dependency' => array(
					array(
						array(
							'field'    => 'header-mixed-decoration',
							'operator' => '==',
							'value'    => 'line',
						),
					),
				),
			);

			$options['header-mixed-decoration-opacity'] = array(
				'id'         => 'header-mixed-decoration-opacity',
				'name'       => _x( 'Line opacity', 'theme-options', 'the7mk2' ),
				'type'       => 'slider',
				'std'        => 100,
				'dependency' => array(
					array(
						array(
							'field' => 'header-mixed-decoration',
							'operator' => '==',
							'value' => 'line',
						),
					),
				),
			);

		$options[] = array( 'type' => 'divider' );

		$options['header-mixed-bg-color'] = array(
			'id'   => 'header-mixed-bg-color',
			'name' => _x( 'Background color', 'theme-options', 'the7mk2' ),
			'type' => 'color',
			'std'  => '#000000',
		);

		$options['header-mixed-bg-opacity'] = array(
			'id'   => 'header-mixed-bg-opacity',
			'name' => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
			'type' => 'slider',
			'std'  => 100,
		);

	$options[] = array( 'name' => _x( 'Background overlay for "Navigation on click" headers and "Mobile menu"', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'ext-conditional-color', 'header-slide_out-overlay-bg', array(
			'color-style' => array(
				'name' => _x( 'Background overlay color', 'theme options', 'the7mk2' ),
			),
		) );

		$options['header-slide_out-overlay-bg-opacity'] = array(
			'id'		=> 'header-slide_out-overlay-bg-opacity',
			'name'		=> _x( 'Background overlay opacity', 'theme-options', 'the7mk2' ),
			'type'		=> 'slider',
			'std'		=> 50, 
		);

		$options['header-slide_out-overlay-blur'] = array(
			'id'      => 'header-slide_out-overlay-blur',
			'name'    => _x( 'Blur effect', 'theme-options', 'the7mk2' ),
			'desc'    => _x( 'Also works for overlay navigation and mobile menu.', 'theme-options', 'the7mk2' ),
			'type'    => 'images',
			'std'     => '0',
			'options' => array(
				'1' => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-slide_out-overlay-blur-enabled.gif',
				),
				'0'   => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-slide_out-overlay-blur-disabled.gif',
				),
			),
			'class'   => 'small',
		);

		$options['header-slide_out-overlay-x_cursor'] = array(
			'id'		=> 'header-slide_out-overlay-x_cursor',
			'name'		=> _x( '"X" cursor icon', 'theme-options', 'the7mk2' ),
			'type'		=> 'radio',
			'std'		=> '0',
			'options'	=> presscore_options_get_en_dis(),
		);

			$options['header-slide_out-overlay-x_cursor-color'] = array(
				'id'	=> 'header-slide_out-overlay-x_cursor-color',
				'name'	=> _x( 'Icon color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#000000',
				'dependency' => array(
					array(
						array(
							'field' => 'header-slide_out-overlay-x_cursor',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			);

			$options['header-slide_out-overlay-x_cursor-opacity'] = array(
				'id'		=> 'header-slide_out-overlay-x_cursor-opacity',
				'name'		=> _x( 'Icon opacity', 'theme-options', 'the7mk2' ),
				'type'		=> 'slider',
				'std'		=> 90, 
				'dependency' => array(
					array(
						array(
							'field' => 'header-slide_out-overlay-x_cursor',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
			);

$options[] = array( 'name' => _x( 'Menu', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Menu items font', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-menu-font-family'] = array(
			'id'        => 'header-menu-font-family',
			'name'      => _x( 'Font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Open Sans',
			'fonts'     => 'all',
		);

		$options['header-menu-font-size'] = array(
			'id'        => 'header-menu-font-size',
			'name'      => _x( 'Font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'std'       => 16, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
			'sanitize'  => 'font_size',
		);

		$options['header-menu-font-is_capitalized'] = array(
			'id'        => 'header-menu-font-is_capitalized',
			'name'      => _x( 'Capitalize ', 'theme-options', 'the7mk2' ),
			'type'      => 'checkbox',
			'std'       => 0,
		);

		$options[] = array( 'type' => 'divider' );

		$options['header-menu-subtitle-font-family'] = array(
			'id'        => 'header-menu-subtitle-font-family',
			'name'      => _x( 'Subtitles font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Arial',
			'fonts'     => 'all',
		);

		$options['header-menu-subtitle-font-size'] = array(
			'id'        => 'header-menu-subtitle-font-size',
			'name'      => _x( 'Subtitles font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'std'       => 10, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
			'sanitize'  => 'font_size',
		);

		$options[] = array( 'type' => 'divider' );

		$options['header-menu-font-color'] = array(
			'id'	=> 'header-menu-font-color',
			'name'	=> _x( 'Normal font color', 'theme-options', 'the7mk2' ),
			'type'	=> 'color',
			'std'	=> '#ffffff',
		);

		$options['header-menu-hover-font-color-style'] = array(
			'id'		=> 'header-menu-hover-font-color-style',
			'name'		=> _x( 'Hover font color', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'divider'   => 'top',
			'std'		=> 'accent',
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

			$options['header-menu-hover-font-color'] = array(
				'id'	=> 'header-menu-hover-font-color',
				'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
				'dependency' => array(
					array(
						array(
							'field' => 'header-menu-hover-font-color-style',
							'operator' => '==',
							'value' => 'color',
						),
					),
				),
			);

			$options['header-menu-hover-font-gradient'] = array(
				'id'	=> 'header-menu-hover-font-gradient',
				'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
				'type'	=> 'gradient',
				'std'	=> array( '#ffffff', '#000000' ),
				'dependency' => array(
					array(
						array(
							'field' => 'header-menu-hover-font-color-style',
							'operator' => '==',
							'value' => 'gradient',
						),
					),
				),
			);

		$options['header-menu-active_item-font-color-style'] = array(
			'id'		=> 'header-menu-active_item-font-color-style',
			'name'		=> _x( 'Active item font color', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'divider'   => 'top',
			'std'		=> 'accent',
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

			$options['header-menu-active_item-font-color'] = array(
				'id'	=> 'header-menu-active_item-font-color',
				'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
				'dependency' => array(
					array(
						array(
							'field' => 'header-menu-active_item-font-color-style',
							'operator' => '==',
							'value' => 'color',
						),
					),
				),
			);

			$options['header-menu-active_item-font-gradient'] = array(
				'id'	=> 'header-menu-active_item-font-gradient',
				'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
				'type'	=> 'gradient',
				'std'	=> array( '#ffffff', '#000000' ),
				'dependency' => array(
					array(
						array(
							'field' => 'header-menu-active_item-font-color-style',
							'operator' => '==',
							'value' => 'gradient',
						),
					),
				),
			);

		$options[] = array( 'type' => 'divider' );

		$options['header-menu-icon-size'] = array(
			'id'        => 'header-menu-icon-size',
			'name'      => _x( 'Menu icon size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'std'       => 16, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
			'sanitize'  => 'font_size',
		);

		$options['header-menu-show_next_lvl_icons'] = array(
			'id'        => 'header-menu-show_next_lvl_icons',
			'name'      => _x( 'Show next level indicator icons', 'theme-options', 'the7mk2' ),
			'desc'      => _x( 'Icons are always visible if parent menu items are clickable (for side and overlay headers).', 'theme-options', 'the7mk2' ),
			'type'      => 'checkbox',
			'std'       => 1,
		);

	$options[] = array( 'name' => _x( 'Menu items margins & paddings', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'indents', 'header-menu-item-padding', array(
			'left'   => array( 'std' => '10' ),
			'right'  => array( 'std' => '10' ),
			'top'    => array( 'std' => '5' ),
			'bottom' => array( 'std' => '5' ),
		) );

		presscore_options_apply_template( $options, 'indents-margins', 'header-menu-item-margin' );

		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'menu-top-headers-indention', 'hidden_by_default' => false );

		$options['header-menu-item-surround_margins-style'] = array(
			'id'      => 'header-menu-item-surround_margins-style',
			'name'    => _x( 'Side margins for first and last menu items', 'theme-options', 'the7mk2' ),
			'desc'    => _x( 'Works for top headers only', 'theme-options', 'the7mk2' ),
			'type'    => 'images',
			'class'   => 'small',
			'std'     => 'regular',
			'options' => array(
				'regular'  => array(
					'title' => _x( 'Regular', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-menu-item-surroundmargins-style-regular.gif',
				),
				'double'   => array(
					'title' => _x( 'Double', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-menu-item-surroundmargins-style-double.gif',
				),
				'custom'   => array(
					'title' => _x( 'Custom', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-menu-item-surroundmargins-style-custom.gif',
				),
				'disabled' => array(
					'title' => _x( 'Remove', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-menu-item-surroundmargins-style-disabled.gif',
				),
			),
			'divider' => 'top',
			'style'   => 'vertical',
		);

			$options['header-menu-item-surround_margins-custom-margin'] = array(
				'id'         => 'header-menu-item-surround_margins-custom-margin',
				'name'       => _x( 'Custom margin (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '0',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
				'dependency' => array(
					array(
						array(
							'field'    => 'header-menu-item-surround_margins-style',
							'operator' => '==',
							'value'    => 'custom',
						),
					),
				),
			);

		$options['header-menu-decoration-other-links-is_justified'] = array(
			'id'		=> 'header-menu-decoration-other-links-is_justified',
			'name'		=> _x( 'Full height & full width links', 'theme-options', 'the7mk2' ),
			'desc'      => _x( 'Works for top headers only', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> '0',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/header-menu-decoration-other-links-isjustified-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/header-menu-decoration-other-links-isjustified-disabled.gif',
				),
			),
			'divider' => 'top',
		);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'name' => _x( 'Dividers', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-menu-show_dividers'] = array(
			'id'		=> 'header-menu-show_dividers',
			'name'		=> _x( 'Dividers', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> '0',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-menu-showdividers-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-menu-showdividers-disabled.gif',
				),
			),
			'show_hide' => array( '1' => true ),
		);

		$options[] = array( 'type' => 'js_hide_begin' );

			$options['header-menu-dividers-height-style'] = array(
				'id'		=> 'header-menu-dividers-height-style',
				'name'		=> _x( 'Divider height (width)', 'theme-options', 'the7mk2' ),
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> 'full',
				'options'	=> array(
					'full' => array(
						'title' => _x( '100%', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-menu-dividers-height-style-full.gif',
					),
					'custom' => array(
						'title' => _x( 'Custom (in px)', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-menu-showdividers-enabled.gif',
					),
				),
			);

				$options['header-menu-dividers-height'] = array(
					'id'		=> 'header-menu-dividers-height',
					'name'		=> _x( "Height (px)", 'theme-options', 'the7mk2' ),
					'type'		=> 'text',
					'std'		=> 20,
					'sanitize'	=> 'slider',
					'dependency' => array(
						array(
							array(
								'field' => 'header-menu-dividers-height-style',
								'operator' => '==',
								'value' => 'custom',
							),
						),
					),
				);

			$options['header-menu-dividers-surround'] = array(
				'id'    	=> 'header-menu-dividers-surround',
				'name'      => _x( 'First & last dividers', 'theme-options', 'the7mk2' ),
				'type'  	=> 'images',
				'class'     => 'small',
				'std'   	=> '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-menu-showdividers-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-menu-dividers-surround-disabled.gif',
					),
				),
			);

			$options['header-menu-dividers-color'] = array(
				'id'    => 'header-menu-dividers-color',
				'name'  => _x( 'Dividers color', 'theme-options', 'the7mk2' ),
				'type'  => 'color',
				'std'   => '#999999',
			);

			$options['header-menu-dividers-opacity'] = array(
				'id'   => 'header-menu-dividers-opacity',
				'name' => _x( 'Dividers opacity', 'theme-options', 'the7mk2' ),
				'type' => 'slider',
				'std'  => 30, 
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'name' => _x( 'Decoration styles for horizontal headers', 'theme-options', 'the7mk2' ), 'class' => 'menu-horizontal-decoration-block', 'type' => 'block' );

		$options['header-menu-decoration-style'] = array(
			'id'        => 'header-menu-decoration-style',
			'name'      => _x( 'Decoration', 'theme-options', 'the7mk2' ),
			'type'      => 'images',
			'class'     => 'small',
			'std'       => 'none',
			'options'   => array(
				'none'              => array(
					'title' => _x( 'None', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-menu-decoration-style-none.gif',
				),
				'underline'         => array(
					'title' => _x( 'Underline', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-menu-decoration-style-underline.gif',
				),
				'other'             => array(
					'title' => _x( 'Background / outline / line', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-menu-decoration-style-other.gif',
				),
			),
			'show_hide' => array(
				'underline'         => 'decoration-underline',
				'other'             => 'decoration-other',
			),
		);

		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-menu-decoration-style decoration-underline' );

			$options['header-menu-decoration-underline-direction'] = array(
				'id'        => 'header-menu-decoration-underline-direction',
				'name'      => _x( 'Direction', 'theme-options', 'the7mk2' ),
				'type'      => 'images',
				'class'     => 'small',
				'divider'   => 'top',
				'std'       => 'left_to_right',
				'options'   => array(
					'left_to_right'      => array(
						'title' => _x( 'Left to right', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-menu-decoration-underline-direction-lefttoright.gif',
					),
					'from_center'        => array(
						'title' => _x( 'From center', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-menu-decoration-underline-direction-fromcenter.gif',
					),
					'upwards'            => array(
						'title' => _x( 'Upwards', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-menu-decoration-underline-direction-upwards.gif',
					),
					'downwards'          => array(
						'title' => _x( 'Downwards', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-menu-decoration-underline-direction-downwards.gif',
					),
				),
			);

			$options['header-menu-decoration-underline-color-style'] = array(
				'id'		=> 'header-menu-decoration-underline-color-style',
				'name'		=> _x( 'Underline color', 'theme-options', 'the7mk2' ),
				'type'		=> 'images',
				'class'     => 'small',
				'divider'   => 'top',
				'std'		=> 'accent',
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

				$options['header-menu-decoration-underline-color'] = array(
					'id'	=> 'header-menu-decoration-underline-color',
					'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
					'type'	=> 'color',
					'std'	=> '#ffffff',
					'dependency' => array(
						array(
							array(
								'field' => 'header-menu-decoration-underline-color-style',
								'operator' => '==',
								'value' => 'color',
							),
						),
					),
				);

				$options['header-menu-decoration-underline-gradient'] = array(
					'id'	=> 'header-menu-decoration-underline-gradient',
					'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
					'type'	=> 'gradient',
					'std'	=> array( '#ffffff', '#000000' ),
					'dependency' => array(
						array(
							array(
								'field' => 'header-menu-decoration-underline-color-style',
								'operator' => '==',
								'value' => 'gradient',
							),
						),
					),
				);

		$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-menu-decoration-style decoration-other' );

			$options[] = array( 'type' => 'divider' );

			$options[] = array( 'name' => _x( 'Hover', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			$options['header-menu-decoration-other-hover-style'] = array(
				'id'        => 'header-menu-decoration-other-hover-style',
				'name'      => _x( 'Hover style', 'theme-options', 'the7mk2' ),
				'type'      => 'images',
				'class'     => 'small',
				'std'       => 'outline',
				'options'   => array(
					'outline'      => array(
						'title' => _x( 'Outline', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-hover-style-outline.gif',
					),
					'background'   => array(
						'title' => _x( 'Background', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-hover-style-background.gif',
					),
				),
			);

			$options['header-menu-decoration-other-hover-color-style'] = array(
				'id'		=> 'header-menu-decoration-other-hover-color-style',
				'name'		=> _x( 'Hover color', 'theme-options', 'the7mk2' ),
				'desc'      => 'Of outline or background',
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> 'accent',
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

				$options['header-menu-decoration-other-hover-color'] = array(
					'id'	=> 'header-menu-decoration-other-hover-color',
					'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
					'type'	=> 'color',
					'std'	=> '#ffffff',
					'dependency' => array(
						array(
							array(
								'field' => 'header-menu-decoration-other-hover-color-style',
								'operator' => '==',
								'value' => 'color',
							),
						),
					),
				);

				$options['header-menu-decoration-other-hover-gradient'] = array(
					'id'	=> 'header-menu-decoration-other-hover-gradient',
					'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
					'type'	=> 'gradient',
					'std'	=> array( '#ffffff', '#000000' ),
					'dependency' => array(
						array(
							array(
								'field' => 'header-menu-decoration-other-hover-color-style',
								'operator' => '==',
								'value' => 'gradient',
							),
						),
					),
				);

			$options['header-menu-decoration-other-hover-opacity'] = array(
				'id'   => 'header-menu-decoration-other-opacity',
				'name' => _x( 'Hover opacity', 'theme-options', 'the7mk2' ),
				'type' => 'slider',
				'std'  => 100, 
			);

			$options['header-menu-decoration-other-hover-line'] = array(
				'id'        => 'header-menu-decoration-other-hover-line',
				'name'      => _x( 'Hover line', 'theme-options', 'the7mk2' ),
				'type'      => 'images',
				'class'     => 'small',
				'std'       => '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-hover-line-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-hover-line-disabled.gif',
					),
				),
				'show_hide' => array( '1' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-menu-decoration-other-hover-line-color-style'] = array(
					'id'		=> 'header-menu-decoration-other-hover-line-color-style',
					'name'		=> _x( 'Hover line color', 'theme-options', 'the7mk2' ),
					'type'		=> 'images',
					'class'     => 'small',
					'std'		=> 'accent',
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

					$options['header-menu-decoration-other-hover-line-color'] = array(
						'id'	=> 'header-menu-decoration-other-hover-line-color',
						'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
						'type'	=> 'color',
						'std'	=> '#ffffff',
						'dependency' => array(
							array(
								array(
									'field' => 'header-menu-decoration-other-hover-line-color-style',
									'operator' => '==',
									'value' => 'color',
								),
							),
						),
					);

					$options['header-menu-decoration-other-hover-line-gradient'] = array(
						'id'	=> 'header-menu-decoration-other-hover-line-gradient',
						'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
						'type'	=> 'gradient',
						'std'	=> array( '#ffffff', '#000000' ),
						'dependency' => array(
							array(
								array(
									'field' => 'header-menu-decoration-other-hover-line-color-style',
									'operator' => '==',
									'value' => 'gradient',
								),
							),
						),
					);

				$options['header-menu-decoration-other-hover-line-opacity'] = array(
					'id'   => 'header-menu-decoration-other-hover-line-opacity',
					'name' => _x( 'Hover line opacity', 'theme-options', 'the7mk2' ),
					'type' => 'slider',
					'std'  => 100, 
				);

			$options[] = array( 'type' => 'js_hide_end' );

			$options[] = array( 'type' => 'divider' );

			$options[] = array( 'name' => _x( 'Active', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			$options['header-menu-decoration-other-active-style'] = array(
				'id'        => 'header-menu-decoration-other-active-style',
				'name'      => _x( 'Active style', 'theme-options', 'the7mk2' ),
				'type'      => 'images',
				'class'     => 'small',
				'std'       => 'outline',
				'options'   => array(
					'outline'      => array(
						'title' => _x( 'Outline', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-active-style-outline.gif',
					),
					'background'   => array(
						'title' => _x( 'Background', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-active-style-background.gif',
					),
				),
			);

			$options['header-menu-decoration-other-active-color-style'] = array(
				'id'		=> 'header-menu-decoration-other-active-color-style',
				'name'		=> _x( 'Active color', 'theme-options', 'the7mk2' ),
				'desc'      => 'Of outline or background',
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> 'accent',
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

				$options['header-menu-decoration-other-active-color'] = array(
					'id'	=> 'header-menu-decoration-other-active-color',
					'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
					'type'	=> 'color',
					'std'	=> '#ffffff',
					'dependency' => array(
						array(
							array(
								'field' => 'header-menu-decoration-other-active-color-style',
								'operator' => '==',
								'value' => 'color',
							),
						),
					),
				);

				$options['header-menu-decoration-other-active-gradient'] = array(
					'id'	=> 'header-menu-decoration-other-active-gradient',
					'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
					'type'	=> 'gradient',
					'std'	=> array( '#ffffff', '#000000' ),
					'dependency' => array(
						array(
							array(
								'field' => 'header-menu-decoration-other-active-color-style',
								'operator' => '==',
								'value' => 'gradient',
							),
						),
					),
				);

			$options['header-menu-decoration-other-active-opacity'] = array(
				'id'   => 'header-menu-decoration-other-active-opacity',
				'name' => _x( 'Active opacity', 'theme-options', 'the7mk2' ),
				'type' => 'slider',
				'std'  => 100, 
			);

			$options['header-menu-decoration-other-active-line'] = array(
				'id'        => 'header-menu-decoration-other-active-line',
				'name'      => _x( 'Active line', 'theme-options', 'the7mk2' ),
				'type'      => 'images',
				'class'     => 'small',
				'std'       => '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-active-line-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-active-line-disabled.gif',
					),
				),
				'show_hide' => array( '1' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-menu-decoration-other-active-line-color-style'] = array(
					'id'		=> 'header-menu-decoration-other-active-line-color-style',
					'name'		=> _x( 'Active line color', 'theme-options', 'the7mk2' ),
					'type'		=> 'images',
					'class'     => 'small',
					'std'		=> 'accent',
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

					$options['header-menu-decoration-other-active-line-color'] = array(
						'id'	=> 'header-menu-decoration-other-active-line-color',
						'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
						'type'	=> 'color',
						'std'	=> '#ffffff',
						'dependency' => array(
							array(
								array(
									'field' => 'header-menu-decoration-other-active-line-color-style',
									'operator' => '==',
									'value' => 'color',
								),
							),
						),
					);

					$options['header-menu-decoration-other-active-line-gradient'] = array(
						'id'	=> 'header-menu-decoration-other-active-line-gradient',
						'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
						'type'	=> 'gradient',
						'std'	=> array( '#ffffff', '#000000' ),
						'dependency' => array(
							array(
								array(
									'field' => 'header-menu-decoration-other-active-line-color-style',
									'operator' => '==',
									'value' => 'gradient',
								),
							),
						),
					);

				$options['header-menu-decoration-other-active-line-opacity'] = array(
					'id'   => 'header-menu-decoration-other-active-line-opacity',
					'name' => _x( 'Active line opacity', 'theme-options', 'the7mk2' ),
					'type' => 'slider',
					'std'  => 100, 
				);

			$options[] = array( 'type' => 'js_hide_end' );

			$options[] = array( 'type' => 'divider' );

			$options[] = array( 'name' => _x( 'Animation', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			$options['header-menu-decoration-other-click_decor'] = array(
				'id'        => 'header-menu-decoration-other-click_decor',
				'name'      => _x( 'Animation on click', 'theme-options', 'the7mk2' ),
				'type'      => 'images',
				'class'     => 'small',
				'std'       => '0',
				'options'	=> array(
					'1'    => array(
						'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-clickdecor-enabled.gif',
					),
					'0'    => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-menu-decoration-other-clickdecor-disabled.gif',
					),
				),
				'show_hide' => array( '1' => true ),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options['header-menu-decoration-other-click_decor-color-style'] = array(
					'id'		=> 'header-menu-decoration-other-click_decor-color-style',
					'name'		=> _x( 'Animation color', 'theme-options', 'the7mk2' ),
					'type'		=> 'images',
					'class'     => 'small',
					'std'		=> 'accent',
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

					$options['header-menu-decoration-other-click_decor-color'] = array(
						'id'	=> 'header-menu-decoration-other-click_decor-color',
						'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
						'type'	=> 'color',
						'std'	=> '#ffffff',
						'dependency' => array(
							array(
								array(
									'field' => 'header-menu-decoration-other-click_decor-color-style',
									'operator' => '==',
									'value' => 'color',
								),
							),
						),
					);

					$options['header-menu-decoration-other-click_decor-gradient'] = array(
						'id'	=> 'header-menu-decoration-other-click_decor-gradient',
						'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
						'type'	=> 'gradient',
						'std'	=> array( '#ffffff', '#000000' ),
						'dependency' => array(
							array(
								array(
									'field' => 'header-menu-decoration-other-click_decor-color-style',
									'operator' => '==',
									'value' => 'gradient',
								),
							),
						),
					);

				$options['header-menu-decoration-other-click_decor-opacity'] = array(
					'id'   => 'header-menu-decoration-other-click_decor-opacity',
					'name' => _x( 'Animation opacity', 'theme-options', 'the7mk2' ),
					'type' => 'slider',
					'std'  => 100, 
				);

			$options[] = array( 'type' => 'js_hide_end' );

			$options['header-menu-decoration-other-border-radius'] = array(
				'id'        => 'header-menu-decoration-other-border-radius',
				'name'      => _x( 'Border radius', 'theme-options', 'the7mk2' ),
				'type'      => 'slider',
				'divider'   => 'top',
				'std'       => 0, 
				'options'   => array( 'min' => 0, 'max' => 120 ),
			);

		$options[] = array( 'type' => 'js_hide_end' );

$options[] = array( 'name' => _x( 'Submenu', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Submenu items font', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-menu-submenu-font-family'] = array(
			'id'        => 'header-menu-submenu-font-family',
			'name'      => _x( 'Font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Open Sans',
			'fonts'     => 'all',
		);

		$options['header-menu-submenu-font-size'] = array(
			'id'        => 'header-menu-submenu-font-size',
			'name'      => _x( 'Font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'std'       => 16, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
			'sanitize'  => 'font_size',
		);

		$options['header-menu-submenu-font-is_uppercase'] = array(
			'id'    	=> 'header-menu-submenu-font-is_uppercase',
			'name'      => _x( 'Capitalize', 'theme-options', 'the7mk2' ),
			'type'  	=> 'checkbox',
			'std'   	=> 0,
		);

		$options[] = array( 'type' => 'divider' );

		$options['header-menu-submenu-subtitle-font-family'] = array(
			'id'        => 'header-menu-submenu-subtitle-font-family',
			'name'      => _x( 'Subtitles font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Arial',
			'fonts'     => 'all',
		);

		$options['header-menu-submenu-subtitle-font-size'] = array(
			'id'        => 'header-menu-submenu-subtitle-font-size',
			'name'      => _x( 'Subtitles font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'std'       => 10, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
			'sanitize'  => 'font_size',
		);

		$options[] = array( 'type' => 'divider' );

		$options['header-menu-submenu-font-color'] = array(
			'id'	=> 'header-menu-submenu-font-color',
			'name'	=> _x( 'Normal font color', 'theme-options', 'the7mk2' ),
			'type'	=> 'color',
			'std'	=> '#ffffff',
		);

		$options['header-menu-submenu-hover-font-color-style'] = array(
			'id'		=> 'header-menu-submenu-hover-font-color-style',
			'name'		=> _x( 'Hover font color', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> 'accent',
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

			$options['header-menu-submenu-hover-font-color'] = array(
				'id'	=> 'header-menu-submenu-hover-font-color',
				'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
				'dependency' => array(
					array(
						array(
							'field' => 'header-menu-submenu-hover-font-color-style',
							'operator' => '==',
							'value' => 'color',
						),
					),
				),
			);

			$options['header-menu-submenu-hover-font-gradient'] = array(
				'id'	=> 'header-menu-submenu-hover-font-gradient',
				'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
				'type'	=> 'gradient',
				'std'	=> array( '#ffffff', '#000000' ),
				'dependency' => array(
					array(
						array(
							'field' => 'header-menu-submenu-hover-font-color-style',
							'operator' => '==',
							'value' => 'gradient',
						),
					),
				),
			);

		$options['header-menu-submenu-active-font-color-style'] = array(
			'id'		=> 'header-menu-submenu-active-font-color-style',
			'name'		=> _x( 'Active font color', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> 'accent',
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

			$options['header-menu-submenu-active-font-color'] = array(
				'id'	=> 'header-menu-submenu-active-font-color',
				'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
				'dependency' => array(
					array(
						array(
							'field' => 'header-menu-submenu-active-font-color-style',
							'operator' => '==',
							'value' => 'color',
						),
					),
				),
			);

			$options['header-menu-submenu-active-font-gradient'] = array(
				'id'	=> 'header-menu-submenu-active-font-gradient',
				'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
				'type'	=> 'gradient',
				'std'	=> array( '#ffffff', '#000000' ),
				'dependency' => array(
					array(
						array(
							'field' => 'header-menu-submenu-active-font-color-style',
							'operator' => '==',
							'value' => 'gradient',
						),
					),
				),
			);

		$options[] = array( 'type' => 'divider' );

		$options['header-menu-submenu-icon-size'] = array(
			'id'		=> 'header-menu-submenu-icon-size',
			'name'		=> _x( 'Menu icon size', 'theme-options', 'the7mk2' ),
			'type'		=> 'slider',
			'std'		=> 14, 
			'options'	=> array( 'min' => 8, 'max' => 50 ),
		);

		$options['header-menu-submenu-show_next_lvl_icons'] = array(
			'id'        => 'header-menu-submenu-show_next_lvl_icons',
			'name'      => _x( 'Show next level indicator icons', 'theme-options', 'the7mk2' ),
			'desc'      => _x( 'Icons are always visible if parent menu items are clickable (for side and overlay headers).', 'theme-options', 'the7mk2' ),
			'type'      => 'checkbox',
			'std'       => 1,
		);

		$options['header-menu-submenu-parent_is_clickable'] = array(
			'id'    	=> 'header-menu-submenu-parent_is_clickable',
			'name'      => _x( 'Make parent menu items clickable', 'theme-options', 'the7mk2' ),
			'type'  	=> 'checkbox',
			'std'   	=> 1,
		);

	$options[] = array( 'name' => _x( 'Submenu items margins & paddings', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'indents', 'header-menu-submenu-item-padding', array(
			'left'   => array( 'std' => '10' ),
			'right'  => array( 'std' => '10' ),
			'top'    => array( 'std' => '5' ),
			'bottom' => array( 'std' => '5' ),
		) );

		presscore_options_apply_template( $options, 'indents-margins', 'header-menu-submenu-item-margin' );

	$options[] = array( 'name' => _x( 'Submenu background', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-menu-submenu-bg-color'] = array(
			'id'    => 'header-menu-submenu-bg-color',
			'name'  => _x( 'Color', 'theme-options', 'the7mk2' ),
			'type'  => 'color',
			'std'   => '#ffffff',
		);

		$options['header-menu-submenu-bg-opacity'] = array(
			'id'		=> 'header-menu-submenu-bg-opacity',
			'name'		=> _x( 'Opacity', 'theme-options', 'the7mk2' ),
			'type'		=> 'slider',
			'std'		=> 30,
		);

		$options[] = array( 'type' => 'divider' );

		$options['header-menu-submenu-bg-width'] = array(
			'id'		=> 'header-menu-submenu-bg-width',
			'name'		=> _x( 'Width', 'theme-options', 'the7mk2' ),
			'type'		=> 'text',
			'std'		=> '240',
			'class'     => 'mini',
			'sanitize'	=> 'dimensions',
		);

		$options['header-menu-submenu-bg-hover'] = array(
			'id'      => 'header-menu-submenu-bg-hover',
			'name'    => _x( 'Hover background', 'theme-options', 'the7mk2' ),
			'type'    => 'images',
			'class'   => 'small',
			'std'     => 'none',
			'options' => array(
				'none'                => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/header-menu-decoration-style-none.gif',
				),
				'background'          => array(
					'title' => _x( 'Plain background', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/header-menu-decoration-other-hover-style-background.gif',
				),
				'animated_background' => array(
					'title' => _x( 'Background with animation on click', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/header-menu-submenu-bg-hover-background-with-animation-on-click.gif',
				),
			),
		);

	$options[] = array( 'name' => _x( 'Submenu for side & overlay navigation', 'theme-options', 'the7mk2' ), 'class' => 'submenu-for-side-headers-block', 'type' => 'block' );

		$options['header-side-menu-submenu-position'] = array(
			'id'      => 'header-side-menu-submenu-position',
			'name'    => _x( 'Show', 'theme-options', 'the7mk2' ),
			'type'    => 'images',
			'class'   => 'small',
			'std'     => 'side',
			'options' => array(
				'side' => array(
					'title' => _x( 'Sideways', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/header-side-menu-submenu-position-side.gif',
				),
				'down' => array(
					'title' => _x( 'Downwards', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/header-side-menu-submenu-position-down.gif',
				),
			),
		);

$options[] = array( 'name' => _x( 'Microwidgets', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Microwidgets near menu', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-elements-near_menu-font_family'] = array(
			'id'        => 'header-elements-near_menu-font_family',
			'name'      => _x( 'Font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Arial',
			'fonts'     => 'all',
		);

		$options['header-elements-near_menu-font_size'] = array(
			'id'        => 'header-elements-near_menu-font_size',
			'name'      => _x( 'Font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'sanitize'  => 'font_size',
			'std'       => 14, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
		);

		$options['header-elements-near_menu-font_color'] = array(
			'id'    => 'header-elements-near_menu-font_color',
			'name'  => _x( 'Font color', 'theme-options', 'the7mk2' ),
			'type'  => 'color',
			'std'   => '#888888',
		);

	$options[] = array( 'name' => _x( 'Microwidgets near logo', 'theme-options', 'the7mk2' ), 'class' => 'microwidgets-near-logo-block', 'type' => 'block' );

		$options['header-elements-near_logo-font_family'] = array(
			'id'        => 'header-elements-near_logo-font_family',
			'name'      => _x( 'Font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Arial',
			'fonts'     => 'all',
		);

		$options['header-elements-near_logo-font_size'] = array(
			'id'        => 'header-elements-near_logo-font_size',
			'name'      => _x( 'Font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'sanitize'  => 'font_size',
			'std'       => 16, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
		);

		$options['header-elements-near_logo-font_color'] = array(
			'id'    => 'header-elements-near_logo-font_color',
			'name'  => _x( 'Font color', 'theme-options', 'the7mk2' ),
			'type'  => 'color',
			'std'   => '#888888',
		);

	$options['header-before-elements-placeholder'] = array();

	$options[] = array( 'name' => _x( 'Search', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-search-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'basic-header-element', 'header-elements-search', array(
			'caption' => array(
				'divider' => false,
			),
		) );

	$options[] = array( 'name' => _x( 'Address', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-address-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'basic-header-element', 'header-elements-contact-address', array(
			'caption' => array(
				'name'    => _x( 'Address', 'theme-options', 'the7mk2' ),
				'divider' => false,
				'class' => 'wide',
			),
		) );

	$options[] = array( 'name' => _x( 'Phone', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-phone-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'basic-header-element', 'header-elements-contact-phone', array(
			'caption' => array(
				'name' => _x( 'Phone', 'theme-options', 'the7mk2' ),
				'divider' => false,
				'class' => 'wide',
			),
		) );

	$options[] = array( 'name' => _x( 'Email', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-email-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'basic-header-element', 'header-elements-contact-email', array(
			'caption' => array(
				'name' => _x( 'Email', 'theme-options', 'the7mk2' ),
				'divider' => false,
				'class' => 'wide',
			),
		) );

	$options[] = array( 'name' => _x( 'Skype', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-skype-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'basic-header-element', 'header-elements-contact-skype', array(
			'caption' => array(
				'name' => _x( 'Skype', 'theme-options', 'the7mk2' ),
				'divider' => false,
				'class' => 'wide',
			),
		) );

	$options[] = array( 'name' => _x( 'Working hours', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-working_hours-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'basic-header-element', 'header-elements-contact-clock', array(
			'caption' => array(
				'name' => _x( 'Working hours', 'theme-options', 'the7mk2' ),
				'divider' => false,
				'class' => 'wide',
			),
		) );

	$options[] = array( 'name' => _x( 'Login', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-login-block', 'class' => 'block-disabled', 'type' => 'block' );

		$options['header-elements-login-caption'] = array(
			'id'		=> 'header-elements-login-caption',
			'name'		=> _x( 'Login caption', 'theme-options', 'the7mk2' ),
			'type'		=> 'text',
			'std'		=> _x( 'Login', 'theme-options', 'the7mk2' ),
		);

		$options['header-elements-logout-caption'] = array(
			'id'		=> 'header-elements-logout-caption',
			'name'		=> _x( 'Logout caption', 'theme-options', 'the7mk2' ),
			'type'		=> 'text',
			'std'		=> _x( 'Logout', 'theme-options', 'the7mk2' ),
		);

		$options['header-elements-login-icon'] = array(
			'id'		=> 'header-elements-login-icon',
			'name'		=> _x( 'Show graphic icon', 'theme-options', 'the7mk2' ),
			'type'		=> 'checkbox',
			'std'		=> '1',
		);

		presscore_options_apply_template( $options, 'header-element-mobile-layout', 'header-elements-login' );

		$options[] = array( 'type' => 'divider' );

		$options['header-elements-login-url'] = array(
			'id'		=> 'header-elements-login-url',
			'name'		=> _x( 'Link', 'theme-options', 'the7mk2' ),
			'type'		=> 'text',
			'std'		=> '',
		);

	$options[] = array( 'name' => _x( 'Text 1', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-text_area-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'header-element-mobile-layout', 'header-elements-text' );

		$options['header-elements-text'] = array(
			'id'       => 'header-elements-text',
			'type'     => 'textarea',
			'std'      => false,
			'divider'  => 'top',
			'sanitize' =>'without_sanitize',
		);

	$options[] = array( 'name' => _x( 'Text 2', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-text2_area-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'header-element-mobile-layout', 'header-elements-text-2' );

		$options['header-elements-text-2'] = array(
			'id'       => 'header-elements-text-2',
			'type'     => 'textarea',
			'std'      => false,
			'divider'  => 'top',
			'sanitize' =>'without_sanitize',
		);

	$options[] = array( 'name' => _x( 'Text 3', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-text3_area-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'header-element-mobile-layout', 'header-elements-text-3' );

		$options['header-elements-text-3'] = array(
			'id'       => 'header-elements-text-3',
			'type'     => 'textarea',
			'std'      => false,
			'divider'  => 'top',
			'sanitize' =>'without_sanitize',
		);

	$options[] = array( 'name' => _x( 'Custom menu', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-custom_menu-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'header-element-mobile-layout', 'header-elements-menu' );

		$options['header-elements-menu-style'] = array(
			'id'		=> 'header-elements-menu-style',
			'name'		=> _x( 'Menu style', 'theme-options', 'the7mk2' ),
			'type'		=> 'radio',
			'std'		=> 'dropdown',
			'options'	=> array(
				'dropdown' => _x( 'Dropdown', 'theme-options', 'the7mk2' ),
				'list' => _x( 'List', 'theme-options', 'the7mk2' ),
			),
		);

	$options[] = array( 'name' => _x( 'Social icons', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-social_icons-block', 'class' => 'block-disabled', 'type' => 'block' );

		presscore_options_apply_template( $options, 'header-element-mobile-layout', 'header-elements-soc_icons' );

		$options['header-elements-soc_icons-color'] = array(
			'id'      => 'header-elements-soc_icons-color',
			'name'    => _x( 'Icons color', 'theme-options', 'the7mk2' ),
			'type'    => 'color',
			'std'     => '#828282',
			'divider' => 'surround',
		);

		$options['header-elements-soc_icons-bg'] = array(
			'id'		=> 'header-elements-soc_icons-bg',
			'name'		=> _x( 'Icons background color', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> 'accent',
			'options'	=> array(
				'disabled'	=> array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/color-disabled.gif',
				),
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
				'outline'	=> array(
					'title' => _x( 'Custom color outline', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/color-custom-outline.gif',
				),
			),
		);

			$options['header-elements-soc_icons-bg-color'] = array(
				'id'        => 'header-elements-soc_icons-bg-color',
				'name'      => _x( 'Color', 'theme-options', 'the7mk2' ),
				'type'      => 'color',
				'std'       => '#ffffff',
				'dependency' => array(
					array(
						array(
							'field'    => 'header-elements-soc_icons-bg',
							'operator' => '==',
							'value'    => 'color',
						),
					),
					array(
						array(
							'field'    => 'header-elements-soc_icons-bg',
							'operator' => '==',
							'value'    => 'outline',
						),
					),
				),
			);

			$options['header-elements-soc_icons-bg-opacity'] = array(
				'id'         => 'header-elements-soc_icons-bg-opacity',
				'name'       => _x( 'Opacity', 'theme-options', 'the7mk2' ),
				'type'       => 'slider',
				'std'        => 100,
				'dependency' => array(
					array(
						array(
							'field'    => 'header-elements-soc_icons-bg',
							'operator' => '==',
							'value'    => 'color',
						),
					),
				),
			);

			$options['header-elements-soc_icons-bg-gradient'] = array(
				'id'        => 'header-elements-soc_icons-bg-gradient',
				'name'      => _x( 'Gradient', 'theme-options', 'the7mk2' ),
				'type'      => 'gradient',
				'std'       => array( '#ffffff', '#000000' ),
				'dependency' => array(
					array(
						array(
							'field'    => 'header-elements-soc_icons-bg',
							'operator' => '==',
							'value'    => 'gradient',
						),
					),
				),
			);

		$options[] = array( 'type' => 'divider' );

		$options['header-elements-soc_icons-hover-color'] = array(
			'id'	=> 'header-elements-soc_icons-hover-color',
			'name'	=> _x( 'Icons hover', 'theme-options', 'the7mk2' ),
			'std'	=> '#828282',
			'type'	=> 'color'
		);

		$options[] = array( 'type' => 'divider' );

		$options['header-elements-soc_icons-hover-bg'] = array(
			'id'		=> 'header-elements-soc_icons-hover-bg',
			'name'		=> _x( 'Icons hover background color', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> 'accent',
			'options'	=> array(
				'disabled'	=> array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/color-disabled.gif',
				),
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
				'outline'	=> array(
					'title' => _x( 'Custom color outline', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/color-custom-outline.gif',
				),
			),
		);

			$options['header-elements-soc_icons-hover-bg-color'] = array(
				'id'        => 'header-elements-soc_icons-hover-bg-color',
				'name'      => _x( 'Color', 'theme-options', 'the7mk2' ),
				'type'      => 'color',
				'std'       => '#ffffff',
				'dependency' => array(
					array(
						array(
							'field'    => 'header-elements-soc_icons-hover-bg',
							'operator' => '==',
							'value'    => 'color',
						),
					),
					array(
						array(
							'field'    => 'header-elements-soc_icons-hover-bg',
							'operator' => '==',
							'value'    => 'outline',
						),
					),
				),
			);

			$options['header-elements-soc_icons-bg-hover-opacity'] = array(
				'id'         => 'header-elements-soc_icons-bg-hover-opacity',
				'name'       => _x( 'Opacity', 'theme-options', 'the7mk2' ),
				'type'       => 'slider',
				'std'        => 100,
				'dependency' => array(
					array(
						array(
							'field'    => 'header-elements-soc_icons-hover-bg',
							'operator' => '==',
							'value'    => 'color',
						),
					),
				),
			);

			$options['header-elements-soc_icons-hover-bg-gradient'] = array(
				'id'        => 'header-elements-soc_icons-hover-bg-gradient',
				'name'      => _x( 'Gradient', 'theme-options', 'the7mk2' ),
				'type'      => 'gradient',
				'std'       => array( '#ffffff', '#000000' ),
				'dependency' => array(
					array(
						array(
							'field'    => 'header-elements-soc_icons-hover-bg',
							'operator' => '==',
							'value'    => 'gradient',
						),
					),
				),
			);

		$options[] = array( 'type' => 'divider' );

		$options['header-elements-soc_icons'] = array(
			'id'        => 'header-elements-soc_icons',
			'type'      => 'fields_generator',
			'std'       => array(
				array( 'icon' => '', 'url' => '' ),
			),
			'options'   => array(
				'fields' => array(
					'icon'   => array(
						'type'          => 'select',
						'class'         => 'of_fields_gen_title',
						'description'   => _x( 'Icon', 'theme-options', 'the7mk2' ),
						'wrap'          => '<label>%2$s%1$s</label>',
						'desc_wrap'     => '%2$s',
						'options'		=> presscore_get_social_icons_data()
					),
					'url'   => array(
						'type'          => 'text',
						'description'   => _x( 'Url', 'theme-options', 'the7mk2' ),
						'wrap'          => '<label>%2$s%1$s</label>',
						'desc_wrap'     => '%2$s'
					)
				)
			)
		);

$options[] = array( 'name' => _x( 'Floating header', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Floating navigation', 'theme-options', 'the7mk2' ), 'type' => 'block' );
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

			$options['header-floating_navigation-show_after'] = array(
				'id'		=> 'header-floating_navigation-show_after',
				'name'		=> _x( 'Show after scrolling (px)', 'theme-options', 'the7mk2' ),
				'type'		=> 'text',
				'std'		=> '150',
				'sanitize'	=> 'slider'
			);

			$options['header-floating_navigation-height'] = array(
				'id'		=> 'header-floating_navigation-height',
				'name'		=> _x( 'Height (px)', 'theme-options', 'the7mk2' ),
				'type'		=> 'text',
				'std'		=> '100',
				'sanitize'	=> 'slider'
			);

			$options['header-floating_navigation-bg-color'] = array(
				'id'	=> 'header-floating_navigation-bg-color',
				'name'	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
			);

			$options['header-floating_navigation-bg-opacity'] = array(
				'id'		=> 'header-floating_navigation-bg-opacity',
				'name'		=> _x( 'Background opacity', 'theme-options', 'the7mk2' ),
				'type'		=> 'slider',
				'std'		=> 90, 
			);

			$options['header-floating_navigation-decoration'] = array(
				'id'      => 'header-floating_navigation-decoration',
				'name'    => _x( 'Decoration', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'class'   => 'small',
				'std'     => 'disabled',
				'options' => array(
					'disabled' => array(
						'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-floatingnavigation-decoration-disabled.gif',
					),
					'shadow'   => array(
						'title' => _x( 'Shadow', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-floatingnavigation-decoration-shadow.gif',
					),
					'line'     => array(
						'title' => _x( 'Line', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-floatingnavigation-decoration-line.gif',
					),
				),
			);

				$options['header-floating_navigation-decoration-color'] = array(
					'id'   => 'header-floating_navigation-decoration-color',
					'name' => _x( 'Line color', 'theme-options', 'the7mk2' ),
					'type' => 'color',
					'std'  => '#ffffff',
					'dependency' => array(
						array(
							array(
								'field' => 'header-floating_navigation-decoration',
								'operator' => '==',
								'value' => 'line',
							),
						),
					),
				);

				$options['header-floating_navigation-decoration-opacity'] = array(
					'id'         => 'header-floating_navigation-decoration-opacity',
					'name'       => _x( 'Line opacity', 'theme-options', 'the7mk2' ),
					'type'       => 'slider',
					'std'        => 100,
					'dependency' => array(
						array(
							array(
								'field' => 'header-floating_navigation-decoration',
								'operator' => '==',
								'value' => 'line',
							),
						),
					),
				);

		$options[] = array( 'type' => 'js_hide_end' );

$options[] = array( 'name' => _x( 'Mobile header', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'First header switch point (tablet)', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'mobile-header', 'header-mobile-first_switch', array(
			'after'  => array(
				'std'  => '1024',
				'desc' => _x( 'To skip this switch point set the same value as for the second (phone) point.', 'theme-options', 'the7mk2' ),
			),
			'height' => array( 'std' => '150' ),
			'layout' => array(
				'type'    => 'images',
				'options' => array(
					'left_right'   => array(
						'title' => _x( 'Left menu + right logo', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-mobile-firstswitch-layout-l-r.gif',
					),
					'left_center'  => array(
						'title' => _x( 'Left menu + centered logo', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-mobile-firstswitch-layout-l-c.gif',
					),
					'right_left'   => array(
						'title' => _x( 'Right menu + left logo', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-mobile-firstswitch-layout-r-l.gif',
					),
					'right_center' => array(
						'title' => _x( 'Right menu + centered logo', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-mobile-firstswitch-layout-r-c.gif',
					),
				),
				'class'   => 'small',
			),
		) );

	$options[] = array( 'name' => _x( 'Second header switch point (phone)', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'mobile-header', 'header-mobile-second_switch', array(
			'after'  => array(
				'std'  => '760',
				'desc' => _x( 'To skip this switch point set it to 0.', 'theme-options', 'the7mk2' ),
			),
			'height' => array( 'std' => '100' ),
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

	$options[] = array( 'name' => _x( 'Mobile menu font', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-mobile-menu-font-family'] = array(
			'id'        => 'header-mobile-menu-font-family',
			'name'      => _x( 'Menu font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Open Sans',
			'fonts'     => 'all',
		);

		$options['header-mobile-menu-font-size'] = array(
			'id'        => 'header-mobile-menu-font-size',
			'name'      => _x( 'Menu font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'sanitize'  => 'font_size',
			'std'       => 16, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
		);

		$options['header-mobile-menu-font-is_capitalized'] = array(
			'id'        => 'header-mobile-menu-font-is_capitalized',
			'name'      => _x( 'Capitalize menu', 'theme-options', 'the7mk2' ),
			'type'      => 'checkbox',
			'std'       => 0,
			'divider'   => 'bottom',
		);

		$options['header-mobile-submenu-font-family'] = array(
			'id'        => 'header-mobile-submenu-font-family',
			'name'      => _x( 'Submenu font', 'theme-options', 'the7mk2' ),
			'type'      => 'web_fonts',
			'std'       => 'Open Sans',
			'fonts'     => 'all',
		);

		$options['header-mobile-submenu-font-size'] = array(
			'id'        => 'header-mobile-submenu-font-size',
			'name'      => _x( 'Submenu font size', 'theme-options', 'the7mk2' ),
			'type'      => 'slider',
			'sanitize'  => 'font_size',
			'std'       => 16, 
			'options'   => array( 'min' => 9, 'max' => 120 ),
		);

		$options['header-mobile-submenu-font-is_capitalized'] = array(
			'id'        => 'header-mobile-submenu-font-is_capitalized',
			'name'      => _x( 'Capitalize submenu', 'theme-options', 'the7mk2' ),
			'type'      => 'checkbox',
			'std'       => 0,
			'divider'   => 'bottom',
		);

		$options['header-mobile-menu-font-color'] = array(
			'id'    => 'header-mobile-menu-font-color',
			'name'  => _x( 'Normal font color', 'theme-options', 'the7mk2' ),
			'type'  => 'color',
			'std'   => '#ffffff',
		);

		presscore_options_apply_template( $options, 'ext-conditional-color', 'header-mobile-menu-font-hover', array(
			'color-style' => array(
				'name' => _x( 'Active & hover font color', 'theme options', 'the7mk2' ),
			),
		) );

	$options[] = array( 'name' => _x( 'Mobile menu background', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-mobile-menu-bg-color'] = array(
			'id'   => 'header-mobile-menu-bg-color',
			'name' => _x( 'Background color', 'theme-options', 'the7mk2' ),
			'type' => 'color',
			'std'  => '#111111',
		);

		$options['header-mobile-menu-bg-opacity'] = array(
			'id'   => 'header-mobile-menu-bg-opacity',
			'name' => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
			'type' => 'slider',
			'std'  => 100,
		);

		$options['header-mobile-menu-bg-width'] = array(
			'id'       => 'header-mobile-menu-bg-width',
			'name'     => _x( 'Maximum background width (px)', 'theme-options', 'the7mk2' ),
			'type'     => 'text',
			'std'      => '400',
			'class'    => 'mini',
			'sanitize' => 'dimensions',
		);

		$options['header-mobile-menu-align'] = array(
			'id'      => 'header-mobile-menu-align',
			'name'    => _x( 'Mobile menu slides from', 'theme-options', 'the7mk2' ),
			'type'    => 'images',
			'std'     => 'left',
			'options' => array(
				'left'     => array(
					'title' => _x( 'Left', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-mobile-menu-align-left.gif',
				),
				'right'    => array(
					'title' => _x( 'Right', 'theme-options', 'the7mk2' ),
					'src'   => '/inc/admin/assets/images/header-mobile-menu-align-right.gif',
				),
			),
			'class'   => 'small',
		);
