<?php
/**
 * WooCommerce compatibility class.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Compatibility_Woocommerce', false ) ) :

	class Presscore_Compatibility_Woocommerce {

		public static function execute() {
			if ( ! class_exists( 'Woocommerce', false ) ) {
				return;
			}

			// add wooCommerce support
			add_theme_support( 'woocommerce' );

			// admin scripts
			require_once dirname(__FILE__) . '/admin/mod-wc-admin-functions.php';

			// frontend scripts
			require_once dirname(__FILE__) . '/front/mod-wc-class-template-config.php';
			require_once dirname(__FILE__) . '/front/mod-wc-template-functions.php';
			require_once dirname(__FILE__) . '/front/mod-wc-template-config.php';
			require_once dirname(__FILE__) . '/front/mod-wc-template-hooks.php';
		}
	}

	Presscore_Compatibility_Woocommerce::execute();

endif;
