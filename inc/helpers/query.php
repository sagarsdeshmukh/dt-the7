<?php
/**
 * Query helpers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_get_filtered_posts' ) ) :

	function presscore_get_filtered_posts( $args ) {
		$config = presscore_config();

		// sanitize
		$request = $config->get( 'request_display' );
		if ( $request ) {
			$request = wp_parse_args( $request, array( 'terms_ids' => null ) );
		}
		$display = $config->get( 'display' );
		if ( ! is_array( $display ) ) {
			$display = array();
		}
		$display = wp_parse_args( $display, array(
			'terms_ids' => null,
			'posts_ids' => null,
			'type'      => 'category',
			'select'    => 'all'
		) );

		$is_posts_query = ( 'albums' == $display['type'] );
		$terms = $request ? $request['terms_ids'] : ( $is_posts_query ? null : $display['terms_ids'] );

		$defaults = array(
			'post_type'      => 'post',
			'taxonomy'       => 'category',
			'select'         => $request ? 'only' : $display['select'],
			'order'          => $config->get( 'order' ),
			'orderby'        => $config->get( 'orderby' ),
			'posts_per_page' => $config->get( 'posts_per_page' ),

			'terms'          => $terms,

			'post__in'       => $is_posts_query && 'only' == $display['select'] ? $display['posts_ids'] : null,
			'post__not_in'   => $is_posts_query && 'except' == $display['select'] ? $display['posts_ids'] : null,

			'query'          => presscore_query()
		);
		$args = wp_parse_args( $args, $defaults );

		$query = $args['query'];
		unset( $args['query'] );

		$posts_query = $query->get_posts_by_terms( $args );

		do_action( 'presscore_get_filtered_posts-' . $args['post_type'], $posts_query );
		do_action( 'presscore_get_filtered_posts', $posts_query );

		return $posts_query;
	}

endif;