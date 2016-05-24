<?php

if ( ! function_exists( 'presscore_header_inline_style' ) ) :

	/**
	 * Output header inline css.
	 * 
	 * @since 3.0.0
	 */
	function presscore_header_inline_style() {
		$config = presscore_config();

		if (
			in_array( $config->get( 'header_title' ), array( 'fancy', 'slideshow' ) ) 
			&& 'transparent' === $config->get( 'header_background' ) 
			&& ( presscore_mixed_header_with_top_line() || ! presscore_header_layout_is_side() )
		) {
			$transparent_bg_color = dt_stylesheet_color_hex2rgba( $config->get( 'header.transparent.background.color' ), $config->get( 'header.transparent.background.opacity' ) );
			echo ' style="background-color: ' . esc_attr( $transparent_bg_color ) . ';"';
		}
	}

endif;

if ( ! function_exists( 'presscore_header_class' ) ) :

	/**
	 * Display the classes for the header.
	 *
	 * @since 1.0.0
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function presscore_header_class( $class = '' ) {
		echo 'class="' . implode( ' ', presscore_get_header_class( $class ) ) . '"';
	}

endif;


if ( ! function_exists( 'presscore_get_header_class' ) ) :

	/**
	 * Retrieve the classes for the top bar as an array.
	 *
	 * @since 3.0.0
	 * @param string|array $class
	 * @return array
	 */
	function presscore_get_header_class( $class = '' ) {
		$classes = presscore_split_classes( $class );

		$config = presscore_config();

		switch ( $config->get( 'header.menu.position' ) ) {
			case 'left':
				$classes[] = 'left';
				break;
			case 'right':
				$classes[] = 'right';
				break;
			case 'center':
				$classes[] = 'center';
				break;
			case 'justify':
				$classes[] = 'justify';
				break;
			case 'inside':
				$classes[] = 'inside';
				break;
			case 'fully_inside':
				$classes[] = 'fully-inside';
				break;
			case 'outside':
				$classes[] = 'outside';
				break;
			case 'v_bottom':
				$classes[] = 'v-bottom';
				break;
			case 'v_center':
				$classes[] = 'v-center';
				break;
		}

		switch ( $config->get( 'header.content.position' ) ) {
			case 'left':
				$classes[] = 'content-left';
				break;
			case 'right':
				$classes[] = 'content-right';
				break;
			case 'center':
				$classes[] = 'content-center';
				break;
		}

		switch ( $config->get( 'header.menu.background.style' ) ) {
			case 'content_line':
				$classes[] = 'content-width-line';
				break;
			case 'fullwidth_line':
				$classes[] = 'full-width-line';
				break;
			case 'solid':
				$classes[] = 'bg-behind-menu';
				break;
		}

		$classes[] = presscore_array_value( $config->get( 'header.logo.position' ), array(
			'center'       => 'logo-center',
			'fully_inside' => 'fully-inside',
		) );

		if ( $config->get( 'header.elements.enabled' ) && $config->get( 'header.elements' ) ) {
			$classes[] = 'widgets';
		}

		if ( 'none' !== $config->get( 'header.menu.decoration.style' ) && $config->get_bool( 'header.menu.decoration.style.other.links.is_justified' ) ) {
			$classes[] = 'full-height';
		}

		if ( $config->get( 'header.is_fullwidth' ) ) {
			$classes[] = 'full-width';
		}

		if ( 'center' === $config->get( 'header.menu.items.alignment' ) ) {
			$classes[] = 'h-center';
		}

		if ( 'fullwidth' === $config->get( 'header.menu.items.link' ) ) {
			$classes[] = 'h-justify';
		}

		if ( $config->get( 'header.menu.dividers.enabled' ) ) {
			$classes[] = 'dividers';
		}

		if ( $config->get( 'header.menu.dividers.surround' ) ) {
			$classes[] = 'surround';
		}

		$classes[] = presscore_header_get_decoration_class( $config->get( 'header.decoration' ) );

		if ( in_array( $config->get( 'header.layout' ), array( 'side', 'slide_out', 'overlay' ) ) ) {
			$classes[] = presscore_array_value( $config->get( 'header.layout.side.menu.submenu.position' ), array(
				'side' => 'sub-sideways',
				'down' => 'sub-downwards',
			) );
		}

		if ( $config->get( 'header.menu.submenu.parent_clickable' ) ) {
			$classes[] = 'dt-parent-menu-clickable';
		}

		$classes = apply_filters( 'presscore_header_class', $classes, $class );

		return presscore_sanitize_classes( $classes );
	}

endif;

if ( ! function_exists( 'presscore_get_header_elements_list' ) ) :

	/**
	 * Get header elements list based on current header layout and $field_name.
	 *
	 * @param string $field_name Field name
	 * @return array Elements list like array( 'element1', 'element2', ... )
	 */
	function presscore_get_header_elements_list( $field_name ) {
		$header_layout = of_get_option( 'header-layout', 'inline' );
		$elements = array();
		if ( dt_sanitize_flag( of_get_option( "header-{$header_layout}-show_elements", false ) ) ) {
			$fields = of_get_option( "header-{$header_layout}-elements", array() );

			if ( ! empty( $fields[ $field_name ] ) && is_array( $fields[ $field_name ] ) ) {
				$elements = $fields[ $field_name ];
			}
		}

		$elements = apply_filters( "presscore_get_header_elements_list-{$field_name}", $elements );
		$elements = apply_filters( 'presscore_get_header_elements_list', $elements );

		return $elements;
	}

endif;


if ( ! function_exists( 'presscore_render_header_elements' ) ) :

	/**
	 * Renders header elements for $field_name header field.
	 *
	 * @param string $field_name Field name
	 */
	function presscore_render_header_elements( $field_name, $class = '' ) {
		$field_elements = presscore_get_header_elements_list( $field_name );

		if ( $field_elements ) {
			$classes = presscore_split_classes( $class );
			$classes[] = 'mini-widgets';

			// wrap open
			echo '<div class="' . implode( ' ', presscore_sanitize_classes( $classes ) ) . '">';

			// render elements
			foreach ( $field_elements as $element ) {

				switch ( $element ) {
					case 'search':
						presscore_top_bar_search_element();
						break;

					case 'social_icons':
						echo presscore_get_topbar_social_icons();
						break;

					case 'custom_menu':
						presscore_top_bar_menu_element();
						break;

					case 'login':
						pressocore_render_login_form();
						break;

					case 'text_area':
						presscore_top_bar_text_element();
						break;

					case 'text2_area':
						presscore_top_bar_text2_element();
						break;

					case 'text3_area':
						presscore_top_bar_text3_element();
						break;

					case 'skype':
						presscore_top_bar_contact_element('skype');
						break;

					case 'email':
						presscore_top_bar_contact_element('email');
						break;

					case 'address':
						presscore_top_bar_contact_element('address');
						break;

					case 'phone':
						presscore_top_bar_contact_element('phone');
						break;

					case 'working_hours':
						presscore_top_bar_contact_element('clock');
						break;

					case 'info':
						presscore_top_bar_contact_element('info');
						break;
				}

				do_action( "presscore_render_header_element-{$element}" );
			}

			// wrap clos
			echo '</div>';
		}
	}

endif;

if ( ! function_exists( 'presscore_get_topbar_bg_mode_class' ) ) :

	/**
	 * Return proper class accordingly to $topbar_bg_mode.
	 *
	 * @uses presscore_get_menu_bg_mode_class
	 * @param string $topbar_bg_mode Font size f.e. solid
	 * @return string Class
	 */
	function presscore_get_topbar_bg_mode_class( $topbar_bg_mode = '' ) {
		return presscore_get_menu_bg_mode_class( $topbar_bg_mode );
	}

endif;


if ( ! function_exists( 'presscore_top_bar_class' ) ) :

	/**
	 * Display the classes for the top bar.
	 *
	 * @since 1.0.0
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function presscore_top_bar_class( $class = '' ) {
		echo 'class="' . implode( ' ', presscore_get_top_bar_class( $class ) ) . '"';
	}

endif;


if ( ! function_exists( 'presscore_get_top_bar_class()' ) ) :

	/**
	 * Retrieve the classes for the top bar as an array.
	 *
	 * @since 1.0.0
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes
	 */
	function presscore_get_top_bar_class( $class = '' ) {
		$classes = presscore_split_classes( $class );

		$config = presscore_config();

		$classes[] = presscore_get_topbar_bg_mode_class( $config->get( 'header.top_bar.background.mode' ) );

		$classes = apply_filters( 'presscore_top_bar_class', $classes, $class );

		return presscore_sanitize_classes( $classes );
	}

endif;

if ( ! function_exists( 'presscore_top_bar_menu_element' ) ) :

	/**
	 * Render custom menu microwidget.
	 *
	 * @since 3.1.2
	 */
	function presscore_top_bar_menu_element() {
		$classes = presscore_get_mini_widget_class( 'header-elements-menu' );
		$classes[] = ( 'list' == of_get_option( 'header-elements-menu-style' ) ? 'list-type-menu' : 'select-type-menu' );
		presscore_nav_menu_list( 'top', $classes );
	}

endif;

if ( ! function_exists( 'presscore_top_bar_contact_element' ) ) :

	/**
	 * Render contact information element.
	 *
	 * @since 1.0.0
	 */
	function presscore_top_bar_contact_element( $el ) {
		$el_id = 'header-elements-contact-' . $el;
		$caption = of_get_option( $el_id . '-caption' );

		if ( $caption ) {
			$class = array( 'mini-contacts ' . $el );

			if ( ! of_get_option( $el_id . '-icon', true ) ) {
				$class[] = 'icon-off';
			}

			$class = presscore_get_mini_widget_class( $el_id, $class );

			echo '<span class="' . implode( ' ', $class ) . '">' . $caption . '</span>';
		}
	}

endif;

if ( ! function_exists( 'presscore_top_bar_text_element' ) ) :

	/**
	 * Render header text mini widget.
	 * 
	 * @since 3.0.0
	 *
	 * @param string $opt_id
	 */
	function presscore_top_bar_text_element( $opt_id = 'header-elements-text' ) {
		$top_text = of_get_option( $opt_id );
		if ( $top_text ) {
			$classes = presscore_get_mini_widget_class( $opt_id, 'text-area' );
			echo '<div class="' . implode( ' ', $classes ) . '">' . wpautop( do_shortcode( $top_text ) ) . '</div>';
		}
	}

endif;

if ( ! function_exists( 'presscore_top_bar_text2_element' ) ) :

	/**
	 * Render header text2 mini widget.
	 * 
	 * @since 3.0.0
	 */
	function presscore_top_bar_text2_element() {
		presscore_top_bar_text_element( 'header-elements-text-2' );
	}

endif;

if ( ! function_exists( 'presscore_top_bar_text3_element' ) ) :

	/**
	 * Render header text3 mini widget.
	 * 
	 * @since 3.0.0
	 */
	function presscore_top_bar_text3_element() {
		presscore_top_bar_text_element( 'header-elements-text-3' );
	}

endif;

if ( ! function_exists( 'presscore_top_bar_search_element' ) ) :

	/**
	 * Render header search mini widget.
	 *
	 * @since 3.0.0
	 */
	function presscore_top_bar_search_element() {
		$classes = presscore_get_mini_widget_class( 'header-elements-search', 'mini-search' );
		echo '<div class="' . implode( ' ', $classes ) . '">';
			presscore_get_template_part( 'theme', 'header/searchform' );
		echo '</div>';
	}

endif;

if ( ! function_exists( 'presscore_get_mini_widget_class' ) ) :

	/**
	 * Return common mini widgets classes.
	 * 
	 * @param  string $opt_id
	 * @param  array  $class
	 * @return array
	 */
	function presscore_get_mini_widget_class( $opt_id, $class = array() ) {
		$classes = presscore_split_classes( $class );

		$classes[] = presscore_array_value( of_get_option( $opt_id . '-mobile-layout' ), array(
			'in_menu'   => 'in-menu-on-mobile',
			'near_logo' => 'near-logo-on-mobile',
			'hidden'    => 'hide-on-mobile',
		) );

		$classes = apply_filters( 'presscore_mini_widget_class', $classes, $class );

		return presscore_sanitize_classes( $classes );
	}

endif;

if ( ! function_exists( 'presscore_get_topbar_social_icons' ) ) :

	/**
	 * Return topbar social icons. Data grabbed from theme options.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function presscore_get_topbar_social_icons() {
		$opt_id = 'header-elements-soc_icons';
		$saved_icons = of_get_option( $opt_id );

		if ( ! $saved_icons || ! is_array( $saved_icons ) ) {
			return '';
		}

		$icons_data = presscore_get_social_icons_data();
		$icons_white_list = array_keys( $icons_data );
		$clean_icons = array();

		foreach ( $saved_icons as $saved_icon ) {

			if ( ! is_array( $saved_icon ) || empty( $saved_icon['url'] ) || empty( $saved_icon['icon'] ) || ! in_array( $saved_icon['icon'], $icons_white_list ) ) {
				continue;
			}

			$icon = $saved_icon['icon'];

			$clean_icons[] = array(
				'icon'  => $icon,
				'title' => $icons_data[ $icon ],
				'link'  => $saved_icon['url']
			);
		}

		if ( ! $clean_icons ) {
			return '';
		}

		$classes = presscore_get_mini_widget_class( $opt_id, 'soc-ico' );

		$classes[] = presscore_array_value( of_get_option( "{$opt_id}-bg" ), array(
			'gradient' => 'gradient-bg',
			'outline'  => 'outline-style',
			'accent'   => 'accent-bg',
			'color'    => 'custom-bg',
			'disabled' => 'disabled-bg',
		) );

		$classes[] = presscore_array_value( of_get_option( "{$opt_id}-hover-bg" ), array(
			'gradient' => 'hover-gradient-bg',
			'outline'  => 'outline-style-hover',
			'accent'   => 'hover-accent-bg',
			'color'    => 'hover-custom-bg',
			'disabled' => 'hover-disabled-bg',
		) );

		return '<div class="' . presscore_esc_implode( ' ', $classes ) . '">' . presscore_get_social_icons( $clean_icons ) . '</div>';
	}

endif;

if ( ! function_exists( 'pressocore_render_login_form' ) ) :

	/**
	 * Dispay login form.
	 *
	 * @since 3.0.0
	 */
	function pressocore_render_login_form() {
		$config = presscore_config();

		if ( is_user_logged_in() ) {
			$caption = $config->get( 'header.elements.logout.caption' );
			$login_link = wp_logout_url();
		} else {
			$caption = $config->get( 'header.elements.login.caption' );
			$login_link = esc_url( $config->get( 'header.elements.login.url' ) );
			if ( ! $login_link ) {
				$login_link = wp_login_url();
			}
		}

		$class = array( 'submit' );

		if ( ! $config->get( 'header.elements.login.icon.enabled' ) ) {
			$class[] = 'icon-off';
		} else if ( ! $caption ) {
			$class[] = 'text-disable';
		}

		if ( ! $caption ) {
			$caption = '&nbsp;';
		}

		$classes = presscore_get_mini_widget_class( 'header-elements-login', 'mini-login' );

		echo '<div class="' . implode( ' ', $classes ) . '"><a href="' . esc_url( $login_link ) .'" class="' . presscore_esc_implode( ' ', $class ) .'">' . esc_html( $caption ) . '</a></div>';
	}

endif;

if ( ! function_exists( 'presscore_mixed_header_class' ) ) :

	/**
	 * Display mixed header class.
	 *
	 * @since 3.0.0
	 * @param  string|array $class
	 */
	function presscore_mixed_header_class( $class = '' ) {
		echo 'class="' . implode( ' ', presscore_get_mixed_header_class( $class ) ) . '"';
	}

endif;

if ( ! function_exists( 'presscore_get_mixed_header_class' ) ) :

	/**
	 * Returns mixed header classes as array.
	 *
	 * @since 3.0.0
	 * @param  string|array $class
	 * @return array
	 */
	function presscore_get_mixed_header_class( $class = '' ) {
		$classes = presscore_split_classes( $class );

		$config = presscore_config();

		switch ( $config->get( 'header.mixed.view' ) ) {
			case 'side_line':
				$classes[] = 'side-header-v-stroke';
				break;
			case 'top_line':
				$classes[] = 'side-header-h-stroke';
				if ( dt_sanitize_flag( $config->get( 'header.mixed.view.top_line.is_fullwidth' ) ) ) {
					$classes[] = 'full-width';
				}
				$logo_pos = $config->get( 'header.mixed.view.top_line.logo.position' );
				if ( 'center' == $logo_pos ) {
					$classes[] = 'logo-center';
				} else if ( 'left' == $logo_pos ) {
					$classes[] = 'logo-left';
				} else if ( 'right' == $logo_pos ) {
					$classes[] = 'logo-right';
				}
				break;
			case 'menu_icon':
			default:
				$classes[] = 'side-header-menu-icon';
				if ( dt_sanitize_flag( $config->get( 'header.mixed.view.menu_icon.floating_logo.enabled' ) ) ) {
					$classes[] = 'floating-logo';
				}
				break;
		}

		$classes[] = presscore_header_get_decoration_class( $config->get( 'header.mixed.decoration' ) );

		$classes = apply_filters( 'presscore_mixed_header_class', $classes, $class );

		return presscore_sanitize_classes( $classes );
	}

endif;

if ( ! function_exists( 'presscore_header_add_mobile_logo_classe_filter' ) ) :

	/**
	 * Add mobile logo classes to $classes array.
	 * 
	 * @since  3.0.0
	 * @param  array  $classes
	 * @return array
	 */
	function presscore_header_add_mobile_logo_classe_filter( $classes = array() ) {
		// Do not add mobile logo classes to main header for layouts with mixed header
		if ( presscore_header_layout_is_mixed() && 'presscore_header_class' === current_filter() ) {
			return $classes;
		}

		if ( 'mobile' === presscore_config()->get( 'header.mobile.logo.first_switch' ) ) {
			$classes[] = 'show-device-logo';
		}

		if ( 'mobile' === presscore_config()->get( 'header.mobile.logo.second_switch' ) ) {
			$classes[] = 'show-mobile-logo';
		}

		return $classes;
	}
	add_filter( 'presscore_header_class', 'presscore_header_add_mobile_logo_classe_filter' );
	add_filter( 'presscore_mixed_header_class', 'presscore_header_add_mobile_logo_classe_filter' );

endif;

if ( ! function_exists( 'presscore_header_get_decoration_class' ) ) :

	/**
	 * Return decoration class based on $style.
	 * 
	 * @param  string $style
	 * @return string
	 */
	function presscore_header_get_decoration_class( $style ) {
		switch ( $style ) {
			case 'shadow':
				return 'shadow-decoration';
			case 'line':
				return 'line-decoration';
		}
		return '';
	}

endif;

if ( ! function_exists( 'presscore_header_menu_icon' ) ) :

	/**
	 * Display mobile menu icon.
	 *
	 * @since 3.0.0
	 */
	function presscore_header_menu_icon() {
		echo '<div class="menu-toggle"><a href="#">menu</a></div>';
	}

endif;

if ( ! function_exists( 'presscore_get_mixed_header_layout' ) ) :

	/**
	 * Return mixed header layout string based on 'header.mixed.view'.
	 *
	 * @since 3.0.0
	 * @return string
	 */
	function presscore_get_mixed_header_layout() {
		return str_replace( '_', '-', strtolower( presscore_config()->get( 'header.mixed.view' ) ) );
	}

endif;

if ( ! function_exists( 'presscore_header_with_bg' ) ) :

	/**
	 * Determine has header background or not.
	 *
	 * @since 3.0.0
	 * @return boolean
	 */
	function presscore_header_with_bg() {
		$config = presscore_config();
		switch ( $config->get( 'header_title' ) ) {
			case 'slideshow':
			case 'fancy':
				return true;

			case 'enabled':
				return in_array( $config->get( 'page_title.background.mode' ), array( 'background', 'gradient' ) );
		}

		return false;
	}

endif;

if ( ! function_exists( 'presscore_header_is_transparent' ) ) :

	/**
	 * Determine is header transparent.
	 *
	 * @since 3.0.0
	 * @return boolean
	 */
	function presscore_header_is_transparent() {
		return presscore_header_with_bg() && 'transparent' === presscore_config()->get( 'header_background' );
	}

endif;

if ( ! function_exists( 'presscore_header_layout_is_side' ) ) :

	/**
	 * Determine that header layout is side or slide_out or overlay.
	 *
	 * @since 3.0.0
	 * @return boolean
	 */
	function presscore_header_layout_is_side() {
		return in_array( presscore_config()->get( 'header.layout' ), array( 'side', 'slide_out', 'overlay' ) );
	}

endif;

if ( ! function_exists( 'presscore_mixed_header_with_top_line' ) ) :

	/**
	 * Determine that header with the top_line.
	 * 
	 * @since 3.0.0
	 * @return boolean
	 */
	function presscore_mixed_header_with_top_line() {
		return 'top_line' === presscore_config()->get( 'header.mixed.view' );
	}

endif;

if ( ! function_exists( 'presscore_header_layout_is_mixed' ) ) :

	/**
	 * Determine that the header is mixed.
	 * 
	 * @since 3.0.0
	 * @return boolean
	 */
	function presscore_header_layout_is_mixed() {
		return in_array( presscore_config()->get( 'header.layout' ), array( 'slide_out', 'overlay' ) );
	}

endif;