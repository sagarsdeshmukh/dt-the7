<?php
/**
 * Options templates.
 *
 * @package The7\Options\Templates
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Lib_Options_LogoTemplate', false ) ) :

	/**
	 * Logo options template class.
	 */
	class Presscore_Lib_Options_LogoTemplate extends Presscore_Lib_Options_Template {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = array();

			$_fields['logo_regular'] = array(
				'name'		=> _x( 'Logo', 'theme-options', 'the7mk2' ),
				'type'		=> 'upload',
				'mode'		=> 'full',
				'std'		=> array( '', 0 ),
			);

			$_fields['logo_hd'] = array(
				'name'		=> _x( 'High-DPI (retina) logo', 'theme-options', 'the7mk2' ),
				'type'		=> 'upload',
				'mode'		=> 'full',
				'std'		=> array( '', 0 ),
			);

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_IndentsTemplate', false ) ) :

	/**
	 * Indents options template class.
	 */
	class Presscore_Lib_Options_IndentsTemplate extends Presscore_Lib_Options_Template {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = array();

			$_fields['top'] = array(
				'name'       => _x( 'Top padding (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '0',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
			);

			$_fields['right'] = array(
				'name'       => _x( 'Right padding (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '0',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
			);

			$_fields['bottom'] = array(
				'name'       => _x( 'Bottom padding (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '0',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
			);

			$_fields['left'] = array(
				'name'       => _x( 'Left padding (px)', 'theme-options', 'the7mk2' ),
				'type'       => 'text',
				'std'        => '0',
				'class'      => 'mini',
				'sanitize'   => 'dimensions',
			);

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_IndentsMarginsTemplate', false ) ) :

	/**
	 * Margin indents options template class.
	 */
	class Presscore_Lib_Options_IndentsMarginsTemplate extends Presscore_Lib_Options_IndentsTemplate {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = parent::do_execute();

			$_fields['top']['name'] = _x( 'Top margin (px)', 'theme-options', 'the7mk2' );
			$_fields['right']['name'] = _x( 'Right margin (px)', 'theme-options', 'the7mk2' );
			$_fields['bottom']['name'] = _x( 'Bottom margin (px)', 'theme-options', 'the7mk2' );
			$_fields['left']['name'] = _x( 'Left margin (px)', 'theme-options', 'the7mk2' );

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_IndentsHTemplate', false ) ) :

	/**
	 * Horizontal indents options template class.
	 */
	class Presscore_Lib_Options_IndentsHTemplate extends Presscore_Lib_Options_IndentsTemplate {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = parent::do_execute();

			// remove vertical indention
			unset( $_fields['top'], $_fields['bottom'] );

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_IndentsVTemplate', false ) ) :

	/**
	 * Vertical indents options template class.
	 */
	class Presscore_Lib_Options_IndentsVTemplate extends Presscore_Lib_Options_IndentsTemplate {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = parent::do_execute();

			// remove horizontal indention
			unset( $_fields['left'], $_fields['right'] );

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_SideHeaderMenuTemplate', false ) ) :

	/**
	 * Side header menu options template class.
	 */
	class Presscore_Lib_Options_SideHeaderMenuTemplate extends Presscore_Lib_Options_Template {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = array();

			$_fields['menu-position'] = array(
				'name'    => _x( 'Menu position', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'v_top',
				'options' => array(
					'v_top'        => array(
						'title' => _x( 'Top', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-menu-position-top.gif',
					),
					'v_center'     => array(
						'title' => _x( 'Center', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-menu-position-center.gif',
					),
					'v_bottom'     => array(
						'title' => _x( 'Bottom', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-menu-position-bottom.gif',
					),
				),
				'class'   => 'small',
			);

			$_fields['logo-position'] = array(
				'name'    => _x( 'Logo and additional info position', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'fully_inside',
				'options' => array(
					'fully_inside' => array(
						'title' => _x( 'Along the edges of menu', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-logo-position-fullyinside.gif',
					),
					'inside'       => array(
						'title' => _x( 'Along the edges of entire content', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-logo-position-inside.gif',
					),
				),
				'class'   => 'small',
			);

			$_fields[] = array( 'type' => 'divider' );

			$_fields[] = array( 'name' => _x( 'Menu paddings', 'theme-options', 'the7mk2' ), 'type' => 'title' );

			if ( class_exists( 'Presscore_Lib_Options_IndentsVTemplate', false ) ) {

				$template = new Presscore_Lib_Options_IndentsVTemplate();
				$template->execute( $_fields, 'menu-padding' );
				unset( $template );

			}

			$_fields['menu-items_alignment'] = array(
				'name'    => _x( 'Menu items alignment', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'left',
				'options' => array(
					'left'       => array(
						'title' => _x( 'Left', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-menu-itemsalignment-left.gif',
					),
					'center'     => array(
						'title' => _x( 'Center', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-menu-itemsalignment-center.gif',
					),
				),
				'class'   => 'small',
			);

			$_fields['menu-items_link'] = array(
				'name'    => _x( 'Menu items link area', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'fullwidth',
				'options' => array(
					'fullwidth'     => array(
						'title' => _x( 'Full-width', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-menu-itemslink-fullwidth.gif',
					),
					'textwidth'     => array(
						'title' => _x( 'Text-width', 'theme-options', 'the7mk2' ),
						'src'   => '/inc/admin/assets/images/header-side-menu-itemslink-textwidth.gif',
					),
				),
				'class'   => 'small',
			);

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_SideHeaderContentTemplate', false ) ) :

	/**
	 * Side header content options template class.
	 */
	class Presscore_Lib_Options_SideHeaderContentTemplate extends Presscore_Lib_Options_IndentsTemplate {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = array();

			$_fields['content-width'] = array(
				'name'     => _x( 'Width of header content (px or %)', 'theme-options', 'the7mk2' ),
				'type'     => 'text',
				'std'      => '220px', 
				'sanitize' => 'css_width',
			);

			$_fields['content-position'] = array(
				'name'    => _x( 'Position of header content', 'theme-options', 'the7mk2' ),
				'type'    => 'images',
				'std'     => 'left',
				'options' => array(
					'left'    => array(
						'title' => _x( 'Left', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-side-content-position-left.gif',
					),
					'center'  => array(
						'title' => _x( 'Center', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-side-content-position-center.gif',
					),
					'right'   => array(
						'title' => _x( 'Right', 'theme-options', 'the7mk2' ),
						'src' => '/inc/admin/assets/images/header-side-content-position-right.gif',
					),
				),
				'class'   => 'small',
			);

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_SlideoutHeaderLayoutTemplate', false ) ) :

	/**
	 * Side header layout options template class.
	 */
	class Presscore_Lib_Options_SlideoutHeaderLayoutTemplate extends Presscore_Lib_Options_IndentsTemplate {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = array();

			$_fields['layout'] = array(
				'name'    => _x( 'Layout', 'theme-options', 'the7mk2' ),
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

				// Menu icons.
				$_fields['layout-menu_icon-show_floating_logo'] = array(
					'name'    => _x( 'Floating logo', 'theme-options', 'the7mk2' ),
					'type'    => 'images',
					'std'     => '1',
					'options' => array(
						'1' => array(
							'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
							'src'   => '/inc/admin/assets/images/header-slideout-layout-menuicon-showfloatinglogo-enabled.gif',
						),
						'0' => array(
							'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
							'src'   => '/inc/admin/assets/images/header-slideout-layout-menuicon-showfloatinglogo-disabled.gif',
						),
					),
					'dependency' => array(
						array(
							array(
								'field' => 'layout',
								'operator' => '==',
								'value' => 'menu_icon',
							),
						),
					),
					'class'      => 'small',
				);

				// Top line.
				$_fields['layout-top_line-height'] = array(
					'name'       => _x( 'Height (px)', 'theme-options', 'the7mk2' ),
					'type'       => 'text',
					'std'        => '130',
					'class'      => 'mini',
					'sanitize'   => 'dimensions',
					'dependency' => array(
						array(
							array(
								'field' => 'layout',
								'operator' => '==',
								'value' => 'top_line',
							),
						),
					),
				);

				$_fields['layout-top_line-is_fullwidth'] = array(
					'name' => _x( 'Full width', 'theme-options', 'the7mk2' ),
					'type'		=> 'images',
					'class'     => 'small',
					'std'  => '0',
					'options'	=> array(
						'1'    => array(
							'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
							'src' => '/inc/admin/assets/images/header-topline-fullwidth-enabled.gif',
						),
						'0'    => array(
							'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
							'src' => '/inc/admin/assets/images/header-topline-fullwidth-disabled.gif',
						),
					),
					'dependency' => array(
						array(
							array(
								'field' => 'layout',
								'operator' => '==',
								'value' => 'top_line',
							),
						),
					),
				);

				$_fields['layout-top_line-logo-position'] = array(
					'name'    => _x( 'Logo position', 'theme-options', 'the7mk2' ),
					'type'    => 'images',
					'std'     => 'left',
					'options' => array(
						'center'    => array(
							'title' => _x( 'Center', 'theme-options', 'the7mk2' ),
							'src'   => '/inc/admin/assets/images/header-slideout-layout-topline-logo-position-center.gif',
						),
						'left'      => array(
							'title' => _x( 'Side', 'theme-options', 'the7mk2' ),
							'src'   => '/inc/admin/assets/images/header-slideout-layout-topline-logo-position-left.gif',
						),
					),
					'dependency' => array(
						array(
							array(
								'field' => 'layout',
								'operator' => '==',
								'value' => 'top_line',
							),
						),
					),
					'class'      => 'small',
				);

				// Side line.
				$_fields['layout-side_line-width'] = array(
					'name'       => _x( 'Width (px)', 'theme-options', 'the7mk2' ),
					'type'       => 'text',
					'std'        => '60',
					'class'      => 'mini',
					'sanitize'   => 'dimensions',
					'dependency' => array(
						array(
							array(
								'field' => 'layout',
								'operator' => '==',
								'value' => 'side_line',
							),
						),
					),
				);

				$_fields['layout-side_line-position'] = array(
					'name'    => _x( 'Show header', 'theme-options', 'the7mk2' ),
					'type'    => 'images',
					'std'     => 'above',
					'options' => array(
						'above'    => array(
							'title' => _x( 'Above the line', 'theme-options', 'the7mk2' ),
							'src'   => '/inc/admin/assets/images/header-slideout-layout-sideline-position-above.gif',
						),
						'under'    => array(
							'title' => _x( 'Under the line', 'theme-options', 'the7mk2' ),
							'src'   => '/inc/admin/assets/images/header-slideout-layout-sideline-position-under.gif',
						),
					),
					'dependency' => array(
						array(
							array(
								'field' => 'layout',
								'operator' => '==',
								'value' => 'side_line',
							),
						),
					),
					'class'      => 'small',
				);

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_MobileHeaderTemplate', false ) ) :

	/**
	 * Mobile header options template class.
	 */
	class Presscore_Lib_Options_MobileHeaderTemplate extends Presscore_Lib_Options_IndentsTemplate {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = array();

			$_fields['after'] = array(
				'name'     => _x( 'Switch after (px)', 'theme-options', 'the7mk2' ),
				'type'     => 'text',
				'std'      => '1024',
				'class'    => 'mini',
				'sanitize' => 'dimensions',
			);

			$_fields['layout'] = array(
				'name'    => _x( 'Layout', 'theme-options', 'the7mk2' ),
				'type'    => 'radio',
				'std'     => 'left_right',
				'options' => array(
					'left_right'   => _x( 'Left menu + right logo', 'theme-options', 'the7mk2' ),
					'left_center'  => _x( 'Left menu + centered logo', 'theme-options', 'the7mk2' ),
					'right_left'   => _x( 'Right menu + left logo', 'theme-options', 'the7mk2' ),
					'right_center' => _x( 'Right menu + centered logo', 'theme-options', 'the7mk2' ),
				),
				'divider' => 'top',
			);

			$_fields['height'] = array(
				'name'     => _x( 'Header height (px)', 'theme-options', 'the7mk2' ),
				'type'     => 'text',
				'std'      => '150',
				'class'    => 'mini',
				'sanitize' => 'dimensions',
				'divider'  => 'top',
			);

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_HeaderElementMobileLayoutTemplate', false ) ) :

	/**
	 * Header element mobile layout options template class.
	 */
	class Presscore_Lib_Options_HeaderElementMobileLayoutTemplate extends Presscore_Lib_Options_Template {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = array();

			$_fields['mobile-layout'] = array(
				'name'    => _x( 'For second header switch point (phone)', 'theme-options', 'the7mk2' ),
				'type'    => 'radio',
				'std'     => 'in_menu',
				'options' => array(
					'in_menu'   => _x( 'Show in the menu', 'theme-options', 'the7mk2' ),
					'near_logo' => _x( 'Show near logo', 'theme-options', 'the7mk2' ),
					'hidden'    => _x( 'Hide', 'theme-options', 'the7mk2' ),
				),
			);

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_BasicHeaderElementTemplate', false ) ) :

	/**
	 * Basic header element options template class.
	 */
	class Presscore_Lib_Options_BasicHeaderElementTemplate extends Presscore_Lib_Options_Template {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = array();

			$_fields['caption'] = array(
				'name' => _x( 'Caption', 'theme-options', 'the7mk2' ),
				'type'     => 'text',
				'std'      => '',
				'sanitize' => 'textarea',
				'divider'  => 'top',
			);

			$_fields['icon'] = array(
				'name' => _x( 'Show graphic icon', 'theme-options', 'the7mk2' ),
				'type' => 'checkbox',
				'std'  => '1',
			);

			if ( class_exists( 'Presscore_Lib_Options_HeaderElementMobileLayoutTemplate', false ) ) {

				$element = new Presscore_Lib_Options_HeaderElementMobileLayoutTemplate();
				$element->execute( $_fields, '' );
				unset( $element );

			}

			return $_fields;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Lib_Options_ExtConditionalColorTemplate', false ) ) :

	/**
	 * Conditional color with accent options template class.
	 */
	class Presscore_Lib_Options_ExtConditionalColorTemplate extends Presscore_Lib_Options_Template {

		/**
		 * @return array
		 */
		protected function do_execute() {
			$_fields = array();

			$_fields['color-style'] = array(
				'name'		=> _x( 'Font color', 'theme-options', 'the7mk2' ),
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

				$_fields['color'] = array(
					'name'	=> _x( 'Color', 'theme-options', 'the7mk2' ),
					'type'	=> 'color',
					'std'	=> '#ffffff',
					'dependency' => array(
						array(
							array(
								'field' => 'color-style',
								'operator' => '==',
								'value' => 'color',
							),
						),
					),
				);

				$_fields['gradient'] = array(
					'name'	=> _x( 'Gradient', 'theme-options', 'the7mk2' ),
					'type'	=> 'gradient',
					'std'	=> array( '#ffffff', '#000000' ),
					'dependency' => array(
						array(
							array(
								'field' => 'color-style',
								'operator' => '==',
								'value' => 'gradient',
							),
						),
					),
				);

			return $_fields;
		}
	}

endif;
