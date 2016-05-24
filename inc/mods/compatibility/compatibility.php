<?php
/**
 * Compatibility module.
 *
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_ComparibilityModule', false ) ) :

	class Presscore_Modules_ComparibilityModule {

		/**
		 * Execute module.
		 */
		public static function execute() {
			$path = trailingslashit( dirname( __FILE__ ) );

			include $path . 'class-compatibility-vc.php';
			include $path . 'class-compatibility-ubermenu.php';
			include $path . 'class-compatibility-tec.php';
			include $path . 'class-compatibility-layerslider.php';
			include $path . 'class-compatibility-jetpack.php';
			include $path . 'class-compatibility-bbpress.php';
			include $path . 'class-compatibility-ldlms.php';
			include $path . 'woocommerce/class-compatibility-woocommerce.php';
			include $path . 'wpml/class-compatibility-wpml.php';
			include $path . 'backward-compat/mod-the7-compatibility.php';
		}
	}

	Presscore_Modules_ComparibilityModule::execute();

endif;
