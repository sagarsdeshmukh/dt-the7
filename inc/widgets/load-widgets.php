<?php
/**
 * Load widgets
 *
 * @since 4.0.3
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Widgets list */
$presscore_widgets = array(
	'inc/widgets/contact-info/contact-info.php',
	'inc/widgets/custom-menu/custom-menu-1.php',
	'inc/widgets/custom-menu/custom-menu-2.php',
	'inc/widgets/blog-posts/blog-posts.php',
	'inc/widgets/blog-categories/blog-categories.php',
	'inc/widgets/flickr/flickr.php',
	'inc/widgets/progress-bars/progress-bars.php',
	'inc/widgets/contact-form/contact-form.php',
	'inc/widgets/accordion/accordion.php',
);
$presscore_widgets = apply_filters( 'presscore_widgets', $presscore_widgets );
foreach ( $presscore_widgets as $presscore_widget ) {
	include_once locate_template( $presscore_widget );
}
