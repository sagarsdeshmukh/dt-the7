<?php
/**
 * Microsite template helpers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_microsite_hide_header' ) ) :

	// Microsite header classes filter
	function presscore_microsite_hide_header( $classes = array() ) {
		$classes[] = 'hidden-header';
		return $classes;
	}

endif;

if ( ! function_exists( 'presscore_microsite_disable_headers' ) ) :

	// Microsite header classes filter
	function presscore_microsite_disable_headers( $classes = array() ) {
		$classes[] = 'disable-headers';
		return $classes;
	}

endif;

if ( ! function_exists( 'presscore_microsite_logo_meta_convert' ) ) :

	/**
	 * Convert logo from page meta to theme options format and override $name option.
	 *
	 * @since  3.0.0
	 * @param  string $meta_id
	 * @param  array &$options
	 * @param  string $name
	 * @return boolean
	 */
	function presscore_microsite_logo_meta_convert( $meta_id, &$options, $name ) {
		global $post;

		$meta_logo = get_post_meta( $post->ID, $meta_id, true );
		if ( $meta_logo ) {
			$options[ $name ] = array( '', absint( $meta_logo[0] ) );
			return true;
		}

		return false;
	}

endif;

if ( ! function_exists( 'presscore_microsite_theme_options_filter' ) ) :

	/**
	 * Microsite theme options filter.
	 *
	 */
	function presscore_microsite_theme_options_filter( $options = array(), $name = '' ) {
		global $post;

		$field_prefix = '_dt_microsite_';

		switch ( $name ) {

			/**
			 * Main logo.
			 */

			case 'header-logo_regular':
				presscore_microsite_logo_meta_convert( "{$field_prefix}main_logo_regular", $options, $name );
				break;

			case 'header-logo_hd':
				presscore_microsite_logo_meta_convert( "{$field_prefix}main_logo_hd", $options, $name );
				break;

			/**
			 * Transparent logo.
			 */

			case 'header-style-transparent-logo_regular':
				presscore_microsite_logo_meta_convert( "{$field_prefix}transparent_logo_regular", $options, $name );
				break;

			case 'header-style-transparent-logo_hd':
				presscore_microsite_logo_meta_convert( "{$field_prefix}transparent_logo_hd", $options, $name );
				break;

			/**
			 * Mixed logo.
			 */

			case 'header-style-mixed-logo_regular':
				presscore_microsite_logo_meta_convert( "{$field_prefix}mixed_logo_regular", $options, $name );
				break;

			case 'header-style-mixed-logo_hd':
				presscore_microsite_logo_meta_convert( "{$field_prefix}mixed_logo_hd", $options, $name );
				break;

			/**
			 * Floating logo.
			 */

			case 'header-style-floating-logo_regular':
				presscore_microsite_logo_meta_convert( "{$field_prefix}floating_logo_regular", $options, $name );
				break;

			case 'header-style-floating-logo_hd':
				presscore_microsite_logo_meta_convert( "{$field_prefix}floating_logo_hd", $options, $name );
				break;

			/**
			 * Mobile logo.
			 */

			case 'header-style-mobile-logo_regular':
				presscore_microsite_logo_meta_convert( "{$field_prefix}mobile_logo_regular", $options, $name );
				break;

			case 'header-style-mobile-logo_hd':
				presscore_microsite_logo_meta_convert( "{$field_prefix}mobile_logo_hd", $options, $name );
				break;

			/**
			 * Bottom logo.
			 */

			case 'bottom_bar-logo_regular':
				presscore_microsite_logo_meta_convert( "{$field_prefix}bottom_logo_regular", $options, $name );
				break;

			case 'bottom_bar-logo_hd':
				presscore_microsite_logo_meta_convert( "{$field_prefix}bottom_logo_hd", $options, $name );
				break;

			/**
			 * Favicon.
			 */

			case 'general-favicon':
				$favicon = get_post_meta( $post->ID, "{$field_prefix}favicon", true );
				if ( $favicon ) {
					$icon_image = wp_get_attachment_image_src( $favicon[0], 'full' );

					if ( $icon_image ) {
						$options[ $name ] = $icon_image[0];
					}
				}
				break;
		}

		return $options;
	}

endif;

if ( ! function_exists( 'presscore_microsite_add_options_filters' ) ) :

	function presscore_microsite_add_options_filters() {
		global $post;

		if ( ! $post || ! presscore_is_microsite() ) {
			return;
		}

		// add filter for theme options here
		add_filter( 'dt_of_get_option', 'presscore_microsite_theme_options_filter', 15, 2 );
	}

	add_action( 'presscore_config_before_base_init', 'presscore_microsite_add_options_filters' );

endif;

if ( ! function_exists( 'presscore_microsite_menu_filter' ) ) :

	/**
	 * Microsite menu filter.
	 *
	 */
	function presscore_microsite_menu_filter( $args = array() ) {
		$location = $args['theme_location'];
		$page_menu = get_post_meta( get_the_ID(), "_dt_microsite_{$location}_menu", true );
		$page_menu = intval( $page_menu );

		if ( $page_menu > 0 ) {
			$args['menu'] = $page_menu;
		}

		return $args;
	}

endif;

if ( ! function_exists( 'presscore_microsite_pre_nav_menu_filter' ) ) :

	/**
	 * Add capability to display page menu on microsite. Same as empty menu location.
	 *
	 * @since  3.0.0
	 * @param mixed $nav_menu
	 * @param array $args
	 * @return string
	 */
	function presscore_microsite_pre_nav_menu_filter( $nav_menu, $args = array() ) {
		$location = $args['theme_location'];
		$page_menu = get_post_meta( get_the_ID(), "_dt_microsite_{$location}_menu", true );
		if ( intval( $page_menu ) < 0 && isset( $args['fallback_cb'] ) && is_callable( $args['fallback_cb'] ) ) {
			$args['echo'] = false;
			return call_user_func( $args['fallback_cb'], $args );
		}

		return $nav_menu;
	}

endif;

if ( ! function_exists( 'presscore_microsite_has_mobile_menu_filter' ) ) :

	function presscore_microsite_has_mobile_menu_filter( $has_menu ) {
		$page_menu = get_post_meta( get_the_ID(), '_dt_microsite_mobile_menu', true );
		$page_menu = intval( $page_menu );
		if ( 0 !== $page_menu ) {
			return true;
		}

		return $has_menu;
	}

endif;

if ( ! function_exists( 'presscore_microsite_setup' ) ) :

	function presscore_microsite_setup() {
		global $post;

		if ( ! $post || ! presscore_is_microsite() ) {
			return;
		}

		// add menu filter here
		add_filter( 'presscore_nav_menu_args', 'presscore_microsite_menu_filter' );
		add_filter( 'presscore_pre_nav_menu', 'presscore_microsite_pre_nav_menu_filter', 10, 2 );
		add_filter( 'presscore_has_mobile_menu', 'presscore_microsite_has_mobile_menu_filter' );

		// hide template parts
		$config = presscore_config();
		$hidden_parts = get_post_meta( $post->ID, "_dt_microsite_hidden_parts", false );
		$hide_header = in_array( 'header', $hidden_parts );
		$hide_floating_menu = in_array( 'floating_menu', $hidden_parts );

		if ( $hide_header && $hide_floating_menu ) {
			add_filter( 'presscore_show_header', '__return_false' );
			add_filter( 'body_class', 'presscore_microsite_disable_headers' );
		} else if ( $hide_header ) {
			add_filter( 'body_class', 'presscore_microsite_hide_header' );
		}

		// hide bottom bar
		if ( in_array( 'bottom_bar', $hidden_parts ) ) {
			add_filter( 'presscore_show_bottom_bar', '__return_false' );
		}

		// hide content
		if ( in_array( 'content', $hidden_parts ) ) {
			add_filter( 'presscore_is_content_visible', '__return_false' );
		}

		$loading = get_post_meta( $post->ID, '_dt_microsite_page_loading', true );
		$config->set( 'template.beautiful_loading.enabled', ( $loading ? $loading : 'enabled' ) );

		$layout = get_post_meta( $post->ID, '_dt_microsite_page_layout', true );
		$config->set( 'template.layout', ( $layout ? $layout : 'wide' ) );

		$config->set( 'header.floating_navigation.enabled', ! $hide_floating_menu );
	}

	add_action( 'presscore_config_base_init', 'presscore_microsite_setup' );

endif;

if ( ! function_exists( 'presscore_is_microsite' ) ) :

	/**
	 * @since 3.0.0
	 * @return boolean
	 */
	function presscore_is_microsite() {
		return ( 'microsite' === presscore_config()->get( 'template' ) );
	}

endif;
