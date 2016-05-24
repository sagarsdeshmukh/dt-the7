<?php
/**
 * Logos public part.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Logos_Public {

	public function register_shortcodes() {
		foreach ( array( 'logos' ) as $shortcode_name ) {
			include_once plugin_dir_path( __FILE__ ) . "shortcodes/{$shortcode_name}/{$shortcode_name}.php";
		}
	}

	public function load_shortcodes_vc_bridge() {
		include_once plugin_dir_path( __FILE__ ) . "shortcodes/mod-logos-shortcodes-bridge.php";
	}

	public function init_widgets() {
		register_widget( 'Presscore_Inc_Widgets_Logos' );
	}
}
