<?php
/**
 * Archive helpers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_archive_post_content' ) ) {

	function presscore_archive_post_content() {
		$post_type = get_post_type();
		$html = apply_filters( "presscore_archive_post_content-{$post_type}", '' );
		if ( $html ) {

			echo $html;

		} else if ( 'post' == $post_type ) {

			presscore_config()->set( 'show_details', false );
			presscore_populate_post_config();
			presscore_get_template_part( 'theme' , 'blog/masonry/blog-masonry-post' );

		} else {

			presscore_get_template_part( 'theme', 'content-archive' );

		}
	}

}
