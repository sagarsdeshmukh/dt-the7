<?php
/**
 * Page titles settings.
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$options[] = array( 'name' => _x( 'Page titles', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Title area layout', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-title_align'] = array(
			'id'        => 'general-title_align',
			'name'      => _x( 'Title area layout', 'theme-options', 'the7mk2' ),
			'desc'      => _x( 'Title and breadcrumbs interposition', 'theme-options', 'the7mk2' ),
			'type'      => 'images',
			'class'     => 'small',
			'std'       => 'left',
			'options'   => array(
				'left'		=> array(
					'title' => 'Left title + right breadcrumbs',
					'src'   => '/inc/admin/assets/images/l-r.gif',
				),
				'right'		=> array(
					'title' => 'Right title + left breadcrumbs',
					'src'   => '/inc/admin/assets/images/r-l.gif',
				),
				'all_left'	=> array(
					'title' => 'Left',
					'src'   => '/inc/admin/assets/images/l-l.gif',
				),
				'all_right'	=> array(
					'title' => 'Right',
					'src'   => '/inc/admin/assets/images/r-r.gif',
				),
				'center'	=> array(
					'title' => 'Centered',
					'src'   => '/inc/admin/assets/images/centre.gif',
				),
			),
		);

		$options[] = array( 'type' => 'divider' );

		$options['general-title_height'] = array(
			'id'		=> 'general-title_height',
			'name'		=> _x( 'Title area height (px)', 'theme-options', 'the7mk2' ),
			'type'		=> 'text',
			'std'		=> '170',
			'class'		=> 'mini',
			'sanitize'	=> 'slider',
		);

		$options[] = array( 'type' => 'divider' );

		presscore_options_apply_template( $options, 'indents-v', 'page_title-padding' );

	$options[] = array( 'name' => _x( 'Page title', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-show_titles'] = array(
			'id'		=> 'general-show_titles',
			'name'		=> _x( 'Page title', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> '1',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-showtitles-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-showtitles-disabled.gif',
				),
			),
		);

			$options['general-title_size'] = array(
				'id'		=> 'general-title_size',
				'name'		=> _x( 'Title size', 'theme-options', 'the7mk2' ),
				'type'		=> 'select',
				'std'		=> 'normal',
				'class'		=> 'mini',
				'options'	=> array(
					'h1'		=> _x( 'h1', 'backend metabox', 'the7mk2' ),
					'h2'		=> _x( 'h2', 'backend metabox', 'the7mk2' ),
					'h3'		=> _x( 'h3', 'backend metabox', 'the7mk2' ),
					'h4'		=> _x( 'h4', 'backend metabox', 'the7mk2' ),
					'h5'		=> _x( 'h5', 'backend metabox', 'the7mk2' ),
					'h6'		=> _x( 'h6', 'backend metabox', 'the7mk2' ),
					'small'		=> _x( 'small', 'backend metabox', 'the7mk2' ),
					'normal'	=> _x( 'medium', 'backend metabox', 'the7mk2' ),
					'big'		=> _x( 'large', 'backend metabox', 'the7mk2' ),
				),
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_titles',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['general-title_color'] = array(
				'id'	=> 'general-title_color',
				'name'	=> _x( 'Title color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_titles',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

	$options[] = array( 'name' => _x( 'Breadcrumbs', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-show_breadcrumbs'] = array(
			'id'		=> 'general-show_breadcrumbs',
			'name'		=> _x('Breadcrumbs', 'theme-options', 'the7mk2'),
			'std'		=> '1',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-showbreadcrumbs-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-showbreadcrumbs-disabled.gif',
				),
			),
		);

			$options['general-breadcrumbs_color'] = array(
				'id'	=> 'general-breadcrumbs_color',
				'name'	=> _x( 'Breadcrumbs color', 'theme-options', 'the7mk2' ),
				'type'	=> 'color',
				'std'	=> '#ffffff',
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

			$options['general-breadcrumbs_bg_color'] = array(
				'id'		=> 'general-breadcrumbs_bg_color',
				'name'		=> _x( 'Breadcrumbs background color', 'theme-options', 'the7mk2' ),
				'type'		=> 'images',
				'class'     => 'small',
				'std'		=> 'disabled',
				'options'	=> array(
					'disabled'	=> array(
						'title' => _x( 'Disabled', 'backend metabox', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/general-breadcrumbsbgcolor-disabled.gif',
					),
					'black'		=> array(
						'title' => _x( 'Black', 'backend metabox', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/general-breadcrumbsbgcolor-black.gif',
					),
					'white'		=> array(
						'title' => _x( 'White', 'backend metabox', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/general-breadcrumbsbgcolor-white.gif',
					),
				),
				'dependency' => array(
					array(
						array(
							'field'    => 'general-show_breadcrumbs',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			);

	$options[] = array( 'name' => _x( 'Title area style', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-title_bg_mode'] = array(
			'id'		=> 'general-title_bg_mode',
			'name'		=> _x( 'Title background / line', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> 'content_line',
			'options'	=> array(
				'disabled'			=> array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-title_bg_mode-disabled.gif',
				),
				'content_line'		=> array(
					'title' => _x( 'Content-width line', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-title_bg_mode-content-width-line.gif',
				),
				'fullwidth_line'	=> array(
					'title' => _x( 'Full-width line', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-title_bg_mode-full-width-line.gif',
				),
				'background'		=> array(
					'title' => _x( 'Background', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/centre.gif',
				),
				'gradient'			=> array(
					'title' => _x( 'Gradient', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-title_bg_mode-gradient.gif',
				),
			),
			'show_hide'	=> array(
				'background' => array( 'general-title-bg-mode-main-container', 'general-title-bg-image', 'general-title-bg-solid-color' ),
				'gradient' => array( 'general-title-bg-mode-main-container', 'general-title-bg-gradient-color' ),
			),
		);

		$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-title_bg_mode general-title-bg-mode-main-container' );

			$options[] = array( 'type' => 'divider' );

			$options['header-background'] = array(
				'id'      		=> 'header-background',
				'name'    		=> _x( 'Header style', 'theme-options', 'the7mk2' ),
				'std'			=> 'normal',
				'type'    		=> 'images',
				'class'         => 'small',
				'options'		=> array(
					'normal'		=> array(
						'src' => '/inc/admin/assets/images/header-background-default.gif',
						'title' => _x( 'Default', 'theme-options', 'the7mk2' ),
						//'title_width' => 100,
					),
					'overlap'		=> array(
						'src' => '/inc/admin/assets/images/header-background-overlapping.gif',
						'title' => _x( 'Overlapping', 'theme-options', 'the7mk2' ),
						//'title_width' => 100,
					),
					'transparent'	=> array(
						'src' => '/inc/admin/assets/images/header-background-transparent.gif',
						'title' => _x( 'Transparent', 'theme-options', 'the7mk2' ),
						//'title_width' => 100,
					),
				),
				'show_hide'	=> array(
					'transparent' => true,
				),
			);

			$options[] = array( 'type' => 'js_hide_begin' );

				$options[] = array( 'type' => 'divider' );

				$options['header-transparent_bg_color'] = array(
					'id'      		=> 'header-transparent_bg_color',
					'name'    		=> _x( 'Transparent background color', 'backend metabox', 'the7mk2' ),
					'type'    		=> 'color',
					'std'			=> '#000000',
				);

				$options['header-transparent_bg_opacity'] = array(
					'id'	=> 'header-transparent_bg_opacity',
					'name'	=> _x( 'Transparent background opacity', 'backend metabox', 'the7mk2' ),
					'type'	=> 'slider',
					'std'	=> '50',
					'options' => array(
						'min' => 0,
						'max' => 100,
					),
				);

				$options['page_title-background-style-transparent-color_scheme'] = array(
					'id'		=> 'page_title-background-style-transparent-color_scheme',
					'name'		=> _x( 'Color scheme', 'theme-options', 'the7mk2' ),
					'type'		=> 'radio',
					'std'		=> 'from_options',
					'options'	=> array(
						'from_options' => _x( 'From Theme Options', 'theme-options', 'the7mk2' ),
						'light'        => _x( 'Light', 'theme-options', 'the7mk2' ),
					),
				);

			$options[] = array( 'type' => 'js_hide_end' );

			$options[] = array( 'type' => 'divider' );

			$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-title_bg_mode general-title-bg-solid-color' );

				$options['general-title_bg_color'] = array(
					'id'	=> 'general-title_bg_color',
					'name'	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
					'type'	=> 'color',
					'std'	=> '#ffffff',
				);

				$options['general-title_bg_opacity'] = array(
					'id'        => 'general-title_bg_opacity',
					'name'      => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
					'type'      => 'slider',
					'std'       => 100, 
				);

				$options['general-title_decoration'] = array(
					'id'		=> 'general-title_decoration',
					'name'		=> _x( 'Decoration', 'theme-options', 'the7mk2' ),
					'type'		=> 'images',
					'class'     => 'small',
					'std'		=> 'none',
					'show_hide'	=> array( 'outline'	=> true ),
					'options'	=> array(
						'none'		=> array(
							'title' => _x( 'None', 'theme-options', 'the7mk2' ),
							'src' => '/inc/admin/assets/images/centre.gif',
						),
						'outline'	=> array(
							'title' => _x( 'Line', 'theme-options', 'the7mk2' ),
							'src' => '/inc/admin/assets/images/general-title_decoration-line.gif',
						),
					),
				);

				$options[] = array( 'type' => 'js_hide_begin' );

					$options['general-title_decoration_outline_color'] = array(
						'id'	=> 'general-title_decoration_outline_color',
						'name'	=> _x( 'Decoration outline color', 'theme-options', 'the7mk2' ),
						'type'	=> 'color',
						'std'	=> '#FFFFFF',
					);

					$options['general-title_decoration_outline_opacity'] = array(
						'id'        => 'general-title_decoration_outline_opacity',
						'name'      => _x( 'Decoration outline opacity', 'theme-options', 'the7mk2' ),
						'type'      => 'slider',
						'std'       => 100,
					);

				$options[] = array( 'type' => 'js_hide_end' );

				$options[] = array( 'type' => 'divider' );

			$options[] = array( 'type' => 'js_hide_end' );

			$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-title_bg_mode general-title-bg-gradient-color' );

				$options['general-title_bg_gradient'] = array(
					'id'	=> 'general-title_bg_gradient',
					'name'	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
					'type'	=> 'gradient',
					'std'	=> array( '#ffffff', '#000000' ),
				);

			$options[] = array( 'type' => 'js_hide_end' );

			$options[] = array( 'type' => 'js_hide_begin', 'class' => 'general-title_bg_mode general-title-bg-image' );

				$options['general-title_bg_image'] = array(
					'id' 			=> 'general-title_bg_image',
					'name' 			=> _x( 'Add background image', 'theme-options', 'the7mk2' ),
					'type' 			=> 'background_img',
					'std' 			=> array(
						'image'			=> '',
						'repeat'		=> 'repeat',
						'position_x'	=> 'center',
						'position_y'	=> 'center',
					),
				);

				$options['general-title_bg_fullscreen'] = array(
					'id'    	=> 'general-title_bg_fullscreen',
					'name'      => _x( 'Fullscreen ', 'theme-options', 'the7mk2' ),
					'type'  	=> 'checkbox',
					'std'   	=> 0,
				);

				$options['general-title_bg_fixed'] = array(
					'id'    	=> 'general-title_bg_fixed',
					'name'      => _x( 'Fixed ', 'theme-options', 'the7mk2' ),
					'type'  	=> 'checkbox',
					'std'   	=> 0,
				);

				$options['general-title_bg_parallax'] = array(
					'id'		=> 'general-title_bg_parallax',
					'name'		=> _x( 'Enable parallax & Parallax speed', 'theme-options', 'the7mk2' ),
					'type'		=> 'text',
					'std'		=> '0',
					'class'		=> 'mini',
				);

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );
