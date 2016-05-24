<?php
/**
 * Ajax functions.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_ajax_pagination_controller' ) ) :

	/**
	 * Ajax pagination controller.
	 *
	 */
	function presscore_ajax_pagination_controller() {

		$ajax_data = array(
			'nonce'        => isset($_POST['nonce']) ? $_POST['nonce'] : false,
			'post_id'      => isset($_POST['postID']) ? absint($_POST['postID']) : false,
			'post_paged'   => isset($_POST['paged']) ? absint($_POST['paged']) : false,
			'target_page'  => isset($_POST['targetPage']) ? absint($_POST['targetPage']) : false,
			'page_data'    => isset($_POST['pageData']) ? $_POST['pageData'] : false,
			'term'         => isset($_POST['term']) ? $_POST['term'] : '',
			'orderby'      => isset($_POST['orderby']) ? $_POST['orderby'] : '',
			'order'        => isset($_POST['order']) ? $_POST['order'] : '',
			'loaded_items' => isset($_POST['visibleItems']) ? array_map('absint', $_POST['visibleItems']) : array(),
			'sender'       => isset($_POST['sender']) ? $_POST['sender'] : '',
			'posts_count'  => isset($_POST['postsCount']) ? $_POST['postsCount'] : 0,
		);

		if ( $ajax_data['post_id'] && 'page' == get_post_type($ajax_data['post_id']) ) {
			$template = dt_get_template_name( $ajax_data['post_id'], true );
		} else if ( is_array($ajax_data['page_data']) ) {

			switch ( $ajax_data['page_data'][0] ) {
				case 'archive' : $template = 'archive'; break;
				case 'search' : $template = 'search';
			}
		}

		do_action( 'presscore_before_ajax_response', $template );

		$response = array( 'success' => false, 'reason' => 'undefined template' );
		if ( in_array( $template, array( 'template-blog-list.php', 'template-blog-masonry.php' ) ) ) {
			$response = presscore_blog_ajax_loading_responce( $ajax_data );
		}

		$response = apply_filters( 'presscore_ajax_pagination_response', $response, $ajax_data, $template );

		wp_send_json( $response );
	}
	add_action( 'wp_ajax_nopriv_presscore_template_ajax', 'presscore_ajax_pagination_controller' );
	add_action( 'wp_ajax_presscore_template_ajax', 'presscore_ajax_pagination_controller' );

endif;
