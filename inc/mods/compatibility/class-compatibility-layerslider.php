<?php
/**
 * Layer slider config.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_Compatibility_LayerSlider', false ) ) :

	class Presscore_Modules_Compatibility_LayerSlider {

		public static function execute() {
			if ( ! defined( 'LS_PLUGIN_VERSION' ) || ! class_exists( 'UniteBaseClassRev', false ) ) {
				return;
			}

			add_action( 'admin_init', array( __CLASS__, 'set_default_slider_properties_action' ), 9 );
		}

		public static function set_default_slider_properties_action() {
			if ( isset( $_POST['posted_add'] ) && strstr( $_SERVER['REQUEST_URI'], 'layerslider' ) && isset( $_POST['layerslider-slides'] ) ) {
				$_POST['layerslider-slides']['properties']['bodyinclude'] = 'on';
			}
		}
	}

	Presscore_Modules_Compatibility_LayerSlider::execute();

endif;
