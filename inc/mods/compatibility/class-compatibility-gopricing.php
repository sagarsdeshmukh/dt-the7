<?php
/**
 * GO Pricing Table compatibility class.
 *
 * @package the7
 * @since 3.4.2
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_Compatibility_GoPricing', false ) ) :

	class Presscore_Modules_Compatibility_GoPricing {

		public static function execute() {
			if ( ! class_exists( 'GW_GoPricing', false ) ) {
				return;
			}

			/**
			 * Seems, that filter conflict with TGMPA so better remove it.
			 */
			if ( class_exists( 'GW_GoPricing_Update', false ) ) {
				remove_action( 'init', array( GW_GoPricing_Update::instance(), 'update_filters' ) );
			}
		}
	}

	Presscore_Modules_Compatibility_GoPricing::execute();

endif;
