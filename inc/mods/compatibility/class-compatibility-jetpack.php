<?php
/**
 * Jetpack compatibility class.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_Compatibility_Jetpack', false ) ) :

	class Presscore_Modules_Compatibility_Jetpack {

		public static function execute() {
			if ( ! class_exists( 'Jetpack', false ) ) {
				return;
			}

			$jetpack_active_modules = get_option('jetpack_active_modules');
			if ( $jetpack_active_modules && in_array( 'photon', $jetpack_active_modules ) && class_exists( 'Jetpack_Photon', false ) ) {
				// deactivate photon
				remove_filter( 'image_downsize', array( Jetpack_Photon::instance(), 'filter_image_downsize' ) );
			}
		}
	}

	Presscore_Modules_Compatibility_Jetpack::execute();

endif;
