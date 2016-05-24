<?php
/**
 * Benefits public part.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Benefits_Public {

	public function register_shortcodes() {
		foreach ( array( 'benefits', 'benefits-vc' ) as $shortcode_name ) {
			include_once plugin_dir_path( __FILE__ ) . "shortcodes/{$shortcode_name}/{$shortcode_name}.php";
		}
	}

	public function load_shortcodes_vc_bridge() {
		include_once plugin_dir_path( __FILE__ ) . "shortcodes/mod-benefits-shortcodes-bridge.php";
	}
}
