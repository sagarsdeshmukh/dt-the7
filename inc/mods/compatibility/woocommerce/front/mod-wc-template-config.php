<?php
/**
 * Woocommerce configuration functions.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'dt_woocommerce_configure_mini_cart' ) ) :

	/**
	 * This function configures woocommerce cart mini widget for header and bottom bar.
	 */
	function dt_woocommerce_configure_mini_cart() {
		$config = presscore_config();
		$config->set( 'woocommerce.mini_cart.caption', of_get_option( 'header-elements-woocommerce_cart-caption' ) );
		$config->set( 'woocommerce.mini_cart.icon', of_get_option( 'header-elements-woocommerce_cart-icon', true ) );
		$config->set( 'woocommerce.mini_cart.subtotal', of_get_option( 'header-elements-woocommerce_cart-show_subtotal' ) );
		$config->set( 'woocommerce.mini_cart.counter', of_get_option( 'header-elements-woocommerce_cart-show_counter', 'allways' ) );
		$config->set( 'woocommerce.mini_cart.counter.style', of_get_option( 'header-elements-woocommerce_cart-counter-style', 'round' ) );
		$config->set( 'woocommerce.mini_cart.counter.bg', of_get_option( 'header-elements-woocommerce_cart-counter-bg', 'accent' ) );
		$config->set( 'woocommerce.mini_cart.dropdown', of_get_option( 'header-elements-woocommerce_cart-show_sub_cart' ) );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_configure_template' ) ) :

	/**
	 * Init theme config for shop.
	 *
	 * @param string $name
	 */
	function dt_woocommerce_configure_template( $name = '' ) {
		dt_woocommerce_configure_mini_cart();

		// Add template configuration actions.
		$config = presscore_config();
		$mod_wc_config = dt_woocommerce_template_config( $config );

		add_action( 'dt_wc_loop_start', array( $mod_wc_config, 'setup' ) );
		add_action( 'dt_wc_loop_end', array( $mod_wc_config, 'cleanup' ) );

		// Stop if not on woocommerce page.
		if ( 'shop' !== $name ) {
			return;
		}

		// From what page get settings?
		$post_id = null;
		if ( is_shop() ) {
			$post_id = woocommerce_get_page_id( 'shop' );
		} else if ( is_cart() ) {
			$post_id = woocommerce_get_page_id( 'cart' );
		} else if ( is_checkout() ) {
			$post_id = woocommerce_get_page_id( 'checkout' );
		}

		if ( $post_id ) {
			$config->set( 'post_id', $post_id );
		}

		if ( ! is_product() ) {
			add_filter( 'presscore_get_page_title', 'dt_woocommerce_get_page_title', 20 );
		}

		// Replace theme breadcrumbs.
		add_filter( 'presscore_get_breadcrumbs-html', 'dt_woocommerce_replace_theme_breadcrumbs', 20, 2 );
	}

	add_action( 'get_header', 'dt_woocommerce_configure_template', 5 );

endif;

if ( ! function_exists( 'dt_woocommerce_configure_archive_templates' ) ) :

	/**
	 * This function configure sidebar and footer as for the 'shop' woocommerce page.
	 *
	 * @param string $name
	 */
	function dt_woocommerce_configure_archive_templates( $name = '' ) {
		if ( 'shop' !== $name ) {
			return;
		}

		if ( is_product_category() || is_product_tag() ) {
			$post_id = woocommerce_get_page_id( 'shop' );
			if ( $post_id ) {
				presscore_get_config()->set( 'post_id', $post_id );
				presscore_config_populate_sidebar_and_footer_options();
				presscore_get_config()->set( 'post_id', null );
			}
		}
	}

	add_action( 'get_header', 'dt_woocommerce_configure_archive_templates', 20 );

endif;
