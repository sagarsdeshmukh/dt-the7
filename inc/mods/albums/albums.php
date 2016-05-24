<?php
/**
 * Albums module.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once plugin_dir_path( __FILE__ ) . 'includes/class-mod-albums.php';

if ( ! function_exists( 'presscore_mod_albums' ) ) {

	function presscore_mod_albums() {
		return Presscore_Mod_Albums::instance();
	}
	presscore_mod_albums();

}
