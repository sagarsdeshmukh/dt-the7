<?php
/**
 * Load Meta boxes
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

////////////////////
// Meta-Box class //
////////////////////

require_once PRESSCORE_EXTENSIONS_DIR . '/meta-box.php';

//////////////////////
// Theme Meta Boxes //
//////////////////////

function presscore_load_meta_boxes() {

	$dir = plugin_dir_path( __FILE__ );
	$metaboxes = apply_filters( 'presscore_load_meta_boxes', array(
		"{$dir}meta-boxes/metaboxes.php",
		"{$dir}meta-boxes/metaboxes-blog.php",
		"{$dir}meta-boxes/metaboxes-microsite.php"
	) );

	foreach ( $metaboxes as $file ) {
		include_once $file;
	}

}
add_action( 'admin_init', 'presscore_load_meta_boxes', 20 );
