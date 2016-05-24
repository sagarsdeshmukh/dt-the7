<?php
/**
 * Menu helpers.
 *
 * @package the7/helpers
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_get_primary_menu_class' ) ) :

	/**
	 * Primary menu wrap classes.
	 * 
	 * @param  string|array $class
	 * @return array
	 */
	function presscore_get_primary_menu_class( $class = '' ) {
		$classes = presscore_split_classes( $class );

		$config = presscore_config();
		switch( $config->get( 'header.menu.decoration.style' ) ) {
			case 'underline':
				$classes[] = 'underline-decoration';

				$classes[] = presscore_array_value( $config->get( 'header.menu.decoration.style.underline.direction' ), array(
					'left_to_right'      => 'l-to-r-line',
					'from_center'        => 'from-centre-line',
					'upwards'            => 'upwards-line',
					'downwards'          => 'downwards-line',
				) );
				break;
			case 'other':
				$classes[] = 'bg-outline-decoration';

				$classes[] = presscore_array_value( $config->get( 'header.menu.decoration.style.other.hover.style' ), array(
					'outline'    => 'hover-outline-decoration',
					'background' => 'hover-bg-decoration',
				) );

				if ( $config->get( 'header.menu.decoration.style.other.hover.line.enabled' ) ) {
					$classes[] = 'hover-line-decoration';
				}

				$classes[] = presscore_array_value( $config->get( 'header.menu.decoration.style.other.active.style' ), array(
					'outline'    => 'active-outline-decoration',
					'background' => 'active-bg-decoration',
				) );

				if ( $config->get( 'header.menu.decoration.style.other.active.line.enabled' ) ) {
					$classes[] = 'active-line-decoration';
				}

				if ( $config->get( 'header.menu.decoration.style.other.click_decor.enabled' ) ) {
					$classes[] = 'animate-click-decoration';
				}
				break;
		}

		if ( presscore_is_gradient_color_mode( $config->get( 'header.menu.hover.color.style' ) ) ) {
			$classes[] = 'gradient-hover';
		}

		if ( $config->get( 'header.menu.show_next_lvl_icons' ) ) {
			$classes[] = 'level-arrows-on';
		}

		$classes[] = presscore_array_value( $config->get( 'header.menu.items.margins.style' ), array(
			'double'   => 'outside-item-double-margin',
			'custom'   => 'outside-item-custom-margin',
			'disabled' => 'outside-item-remove-margin',
		) );

		$classes = apply_filters( 'presscore_primary_menu_class', $classes );

		return presscore_sanitize_classes( $classes );
	}

endif;

if ( ! function_exists( 'presscore_get_primary_submenu_class' ) ) :

	/**
	 * Primary menu submenu classes.
	 * 
	 * @param  string|array $class
	 * @return array
	 */
	function presscore_get_primary_submenu_class( $class = '' ) {
		$classes = presscore_split_classes( $class );

		$config = presscore_config();

		if ( presscore_is_gradient_color_mode( $config->get( 'header.menu.submenu.hover.color.style' ) ) ) {
			$classes[] = 'gradient-hover';
		}

		$classes[] = presscore_array_value( $config->get( 'header.menu.submenu.background.hover.style' ), array(
			'background'          => 'hover-style-bg',
			'animated_background' => 'hover-style-click-bg',
		) );

		if ( $config->get( 'header.menu.submenu.show_next_lvl_icons' ) ) {
			$classes[] = 'level-arrows-on';
		}

		$classes = apply_filters( 'presscore_primary_submenu_class', $classes );

		return presscore_sanitize_classes( $classes );
	}

endif;

if ( ! function_exists( 'presscore_nav_menu_list' ) ) :

	/**
	 * Display secondary nav menu.
	 * 
	 * @since  3.0.0
	 * @param  string $location
	 * @param  array  $class
	 */
	function presscore_nav_menu_list( $location, $class = array() ) {
		$cahce_name = "secondary_nav_menu_{$location}";

		if ( false === ( $menu_html = wp_cache_get( $cahce_name, 'presscore' ) ) ) {
			$locations = get_nav_menu_locations();

			$menu = isset( $locations[ $location ] ) ? wp_get_nav_menu_object( $locations[ $location ] ) : null;
			if ( ! $menu ) {
				return;
			}

			ob_start();

			presscore_nav_menu( array(
				'theme_location' => $location,
				'items_wrap' => '<ul>%3$s</ul>',
				'submenu_class' => implode( ' ', presscore_get_primary_submenu_class( 'sub-nav' ) ),
				'parent_is_clickable' => true,
				'fallback_cb' => '',
			) );

			echo '<div class="menu-select"><span class="customSelect1"><span class="customSelectInner">' . $menu->name . '</span></span></div>';

			$menu_html = ob_get_contents();
			ob_end_clean();

			wp_cache_set( $cahce_name, $menu_html, 'presscore' );
		}

		$classes = presscore_split_classes( $class );
		array_unshift( $classes, 'mini-nav' );
		echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';

			echo $menu_html;

		echo '</div>';
	}

endif;

if ( ! function_exists( 'presscore_primary_nav_menu' ) ) :

	/**
	 * Display theme primary nav menu.
	 * 
	 * @since  3.0.0
	 * @param  string $location
	 */
	function presscore_primary_nav_menu( $location ) {
		$cahce_name = "primary_nav_menu_{$location}";

		if ( false === ( $cache = wp_cache_get( $cahce_name, 'presscore' ) ) ) {
			ob_start();

			do_action( 'presscore_primary_nav_menu_before' );

			presscore_nav_menu( array(
				'theme_location'      => $location,
				'items_wrap'          => '%3$s',
				'submenu_class'       => implode( ' ', presscore_get_primary_submenu_class( 'sub-nav' ) ),
				'parent_is_clickable' => presscore_config()->get( 'header.menu.submenu.parent_clickable' ),
			) );

			do_action( 'presscore_primary_nav_menu_after' );

			$cache = ob_get_contents();
			ob_end_clean();

			wp_cache_set( $cahce_name, $cache, 'presscore' );
		}

		echo $cache;
	}

endif;

if ( ! function_exists( 'presscore_has_mobile_menu' ) ) :

	/**
	 * This helper checks if a page has mobile menu on it.
	 *
	 * @since 3.0.0
	 * @return boolean
	 */
	function presscore_has_mobile_menu() {
		return apply_filters( 'presscore_has_mobile_menu', has_nav_menu( 'mobile' ) );
	}

endif;
