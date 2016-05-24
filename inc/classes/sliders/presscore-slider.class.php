<?php
/**
 * Slider meta class
 *
 * @package vogue
 * @since 1.0.0
 */

class Presscore_Slider {

	protected $slides = array();
	protected $settings = array();
	protected $errors = array();

	public function __construct( $items_ids, $args = array() ) {

		$this->init_settings( $args );

		$query = $this->query( $items_ids );

		if ( is_wp_error( $query ) ) {
			$this->errors[] = $query;
		} else {
			$this->init_slides( $query );
		}
	}

	public function have_slides() {
		return ! empty( $this->slides );
	}

	public function get_errors() {
		return $this->errors;
	}

	protected function init_settings( $settings = array() ) {}

	protected function query( $items_ids ) {

		if ( !is_array( $items_ids ) ) {
			$items_ids = array_map( 'trim', explode( ',', $items_ids ) );
		}

		if ( empty( $items_ids ) ) {
			return new WP_Error( 'presscore slider no items', 'No items' );
		}

		$query_args = array(
			'post__in'				=> array_values( $items_ids ),
			'post_type'				=> 'attachment',
			'post_status'			=> 'inherit',
			'order'					=> 'ASC',
			'orderby'				=> 'post__in',
			'ignore_sticky_posts'	=> true,
			'posts_per_page'		=> -1,
			'no_found_rows'			=> true
		);

		$query = new WP_Query( $query_args );

		if ( ! $query->have_posts() ) {
			return new WP_Error( 'presscore slider empty query', 'Empty query' );
		}

		return $query;
	}

	protected function init_slides( WP_Query $query ) {

		if ( $query->have_posts() ) {

			while( $query->have_posts() ) { $query->the_post();

				$slide = new stdClass();
				$post_id = get_the_ID();

				$slide->image_src = wp_get_attachment_image_src( $post_id, 'full' );
				$slide->image_alt = get_post_meta( $post_id, '_wp_attachment_image_alt', true );
				$slide->link = get_post_meta( $post_id, 'dt-img-link', true );

				// hide title
				if ( get_post_meta( $post_id, 'dt-img-hide-title', true ) ) {
					$slide->title = '';
				} else {
					$slide->title = get_the_title();
				}

				$slide->description = get_the_content();
				$slide->id = $post_id;

				$this->slides[] = $slide;
			}
			wp_reset_postdata();

		} // have_posts
	}

	protected function array_index2num( $glue, $array, $prefix = '', $value_wrap = '%s' ) {
		$result = array();

		if ( ! ( empty( $array ) || !is_array( $array ) ) ) {
			foreach( $array as $key=>$value ) {
				$result[] = $prefix . $key . $glue . sprintf( $value_wrap, $value );
			}
		}

		return $result;
	}

	protected function style_attr( $atts = array() ) {
		if ( $atts ) {
			return 'style="' . esc_attr( implode( ' ', $this->array_index2num( ':', $atts, '', '%s;' ) ) ) . '"';
		}

		return '';
	}

	protected function data_attr( $atts = array() ) {
		if ( $atts ) {
			return implode( ' ', $this->array_index2num( '=', $atts, 'data-', '"%s"' ) );
		}

		return '';
	}

	protected function html_class_attr( $atts = array() ) {
		if ( $atts ) {
			return 'class="' . esc_attr( implode( ' ', $this->array_index2num( '', $atts ) ) ) . '"';
		}

		return '';
	}

}
