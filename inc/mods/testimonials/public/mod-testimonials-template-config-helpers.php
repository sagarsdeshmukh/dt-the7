<?php
/**
 * Testimonials template config helpers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

///////////////////////////
// TESTIMONIALS TEMPLATE //
///////////////////////////

if ( ! function_exists( 'presscore_congif_populate_testimonials_vars' ) ) :

	function presscore_congif_populate_testimonials_vars() {
		$config = presscore_config();
		$post_id = $config->get( 'post_id' );
		$prefix = '_dt_testimonials_options_';

		$config->set( 'layout', get_post_meta( $post_id, "{$prefix}masonry_layout", true ), 'masonry' );
		$config->set( 'posts_per_page', get_post_meta( $post_id, "{$prefix}ppp", true ) );
		$config->set( 'display', get_post_meta( $post_id, "_dt_testimonials_display", true ) );

		$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}full_width", true ), false );
		$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}item_padding", true ), 20 );
		$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}target_width", true ), 370 );
		$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}columns_number", true ), 3 );

		$config->set( 'load_style', get_post_meta( $post_id, "{$prefix}load_style", true ), 'default' );
		$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}load_effect", true ), 'fade_in' );

		$config->set( 'post.preview.description.style', 'on_hoover_centered' );
		$config->set( 'post.preview.description.alignment', 'left' );
	}

endif;