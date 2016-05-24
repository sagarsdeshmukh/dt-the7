<?php
/**
 * Benefits module.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once plugin_dir_path( __FILE__ ) . 'includes/class-mod-benefits.php';

if ( ! function_exists( 'presscore_mod_benefits' ) ) {

	function presscore_mod_benefits() {
		return Presscore_Mod_Benefits::instance();
	}
	presscore_mod_benefits();

}
