<?php
/**
 * Ajax response class.
 */

abstract class Presscore_Ajax_Content_Builder {

	protected $config;
	protected $input;
	protected $response;

	public function get_response( $input ) {
		$this->input = $input;
		$this->config = presscore_config();
		$this->response = $this->get_default_response();
		$this->do_response();
		return $this->response;
	}

	protected function get_default_response() {
		return array( 'success' => true, 'html' => '' );
	}

	protected function do_response() {
		$this->do_page_query();

		if ( have_posts() && !post_password_required() ) {

			$this->configure_template();

			while ( have_posts() ) { the_post();
				ob_start();
				$query = $this->custom_loop();
				$html = ob_get_clean();

				$this->after_custom_loop( $html, $query );
			}

			$this->do_pagination( $query );
		}
	}

	abstract protected function custom_loop();

	abstract protected function configure_template();

	protected function do_page_query() {
		query_posts( array(
			'post_type' => 'page',
			'page_id' => $this->input['post_id'],
			'post_status' => 'publish',
			'page' => $this->input['target_page']
		) );
	}

	protected function after_custom_loop( $html, $query ) {

		$this->response['html'] = $html;
		$this->response['itemsToDelete'] = array_values( $this->input['loaded_items'] );

		if ( ! is_wp_error( $query ) ) {
			$this->response['order'] = strtolower( $query->query['order'] );
			$this->response['orderby'] = strtolower( $query->query['orderby'] );
		}
	}

	protected function do_pagination( $query ) {
		if ( is_wp_error( $query ) ) {
			return;
		}

		$paged = dt_get_paged_var();
		$this->response['nextPage'] = dt_get_next_posts_url( $query->max_num_pages ) ? $paged + 1 : 0;

		$load_style = $this->config->get( 'load_style' );

		if ( presscore_is_load_more_pagination() ) {

			$pagination = dt_get_next_page_button( $query->max_num_pages, 'paginator paginator-more-button with-ajax' );
			if ( $pagination ) {
				$this->response['currentPage'] = $paged;
				$this->response['paginationHtml'] = $pagination;
			} else {
				$this->response['currentPage'] = $this->input['post_paged'];
			}

			$this->response['paginationType'] = 'more';

		} else if ( 'ajax_pagination' == $load_style ) {

			ob_start();
			dt_paginator( $query, array('class' => 'paginator with-ajax', 'ajaxing' => true ) );
			$pagination = ob_get_clean();

			if ( $pagination ) {
				$this->response['paginationHtml'] = $pagination;
			}

			$this->response['paginationType'] = 'paginator';

		}
	}
}
