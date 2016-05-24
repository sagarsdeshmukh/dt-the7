<?php
/**
 * Shortcodes setup.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// $current_dir = dirname( __FILE__ );

require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'class-register-button-wp-3.9.php';
require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'class-shortcode.php';
require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'class-shortcode-masonry-posts.php';
require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'puny-shortcodes-functions.php';
require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'shortcodes-animation-functions.php';
require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'shortcodes-hooks.php';

$tinymce_button = new DT_ADD_MCE_BUTTON('', '');

// List of shortcodes folders to include
// All folders located in /include
$presscore_shortcodes = array(
	'accordion',
	'animated-text',
	'banner',
	'before-after',
	'blog-posts',
	'blog-posts-small',
	'blog-slider',
	'box',
	'button',
	'call-to-action',
	'code',
	'columns',
	'contact-form',
	'divider',
	'fancy-image',
	'fancy-separators-vc',
	'fancy-titles-vc',
	'fancy-video-vc',
	'gallery',
	'gap',
	'highlight',
	'list',
	'list-vc',
	'map',
	'progress-bars',
	'quote',
	'shortcode-teasers',
	'simple-login',
	'social-icons',
	'stripes',
	'tabs',
	'toggles',
	'tooltips'
);
$presscore_shortcodes = apply_filters( 'presscore_shortcodes', $presscore_shortcodes );

foreach ( $presscore_shortcodes as $shortcode_dirname ) {
	include_once locate_template( 'inc/shortcodes/includes/' . $shortcode_dirname . '/' . $shortcode_dirname . '.php' );
}
