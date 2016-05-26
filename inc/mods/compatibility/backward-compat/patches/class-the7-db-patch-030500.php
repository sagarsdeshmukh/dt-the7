<?php
/**
 * The7 3.5.0 patch.
 *
 * @package the7
 * @since 3.5.0
 */

if ( ! class_exists( 'The7_DB_Patch_030500', false ) ) {

	class The7_DB_Patch_030500 extends The7_DB_Patch {

		protected function do_apply() {

			// Rename microwidgets '-mobile-layout' option.
			$microwidgets = array(
				'header-elements-contact-address',
				'header-elements-contact-phone',
				'header-elements-contact-email',
				'header-elements-contact-skype',
				'header-elements-contact-clock',
				'header-elements-login',
				'header-elements-text',
				'header-elements-text-2',
				'header-elements-text-3',
				'header-elements-menu',
				'header-elements-woocommerce_cart',
				'header-elements-soc_icons',
				'header-elements-search',
			);

			foreach ( $microwidgets as $base_key ) {
				$this->rename_option( "{$base_key}-mobile-layout", "{$base_key}-second-header-switch" );
			}
		}

	}

}
