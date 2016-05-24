<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Masonry_Posts_Shortcode', false ) ):

	class DT_Masonry_Posts_Shortcode extends DT_Shortcode {

		protected $config = null;
		protected $atts = array();
		protected $vc_is_inline = false;
		protected $post_type = 'post';
		protected $taxonomy = 'category';

		protected function setup($atts = array(), $content = null) {
			$this->config = presscore_get_config();
			$this->vc_is_inline = presscore_vc_is_inline();
			$this->atts = $this->sanitize_attributes( $atts );
		}

		protected function the_loop( $args = array() ) {
			$default_args = array(
				'masonry_container_class' => array( 'wf-container' ),
				'masonry_container_data' => array(),
				'post_template_callback' => null,
				'query' => null,
				'post_type' => $this->post_type,
				'taxonomy' => $this->taxonomy,
				'select' => 'all',
				'show_filter' => false,
				'full_width' => false,
				'posts_per_page' => '-1'
			);
			$args = wp_parse_args( $args, $default_args );

			if ( ! isset( $args['query'], $args['post_template_callback'] ) || ! is_callable( $args['post_template_callback'] ) ) {
				return '';
			}

			ob_start();

			do_action( 'presscore_before_shortcode_loop', $this->shortcode_name, $this->atts );

			// main wrap
			echo '<div class="dt-shortcode with-isotope">';

			// posts filter
			$this->display_posts_filter( array(
				'post_type' => $this->post_type,
				'taxonomy' => $this->taxonomy,
				'query' => $args['query'],
				'select' => $args['select'],
				'show_category_filter' => $args['show_filter']
			) );

			// fullwidth wrap open
			if ( $args['full_width'] ) { echo '<div class="full-width-wrap">'; }

			$container_data = array(
				'data-posts-per-page="' . $args['posts_per_page'] . '"'
			);
			$container_data = empty( $args['masonry_container_data'] ) ? $container_data : array_merge( $container_data, (array) $args['masonry_container_data'] );

			// masonry container open
			echo '<div ' . presscore_masonry_container_class( $args['masonry_container_class'] ) . presscore_masonry_container_data_atts( $container_data ) . '>';

				while ( $args['query']->have_posts() ) { $args['query']->the_post();

					call_user_func( $args['post_template_callback'] );

				}

			// masonry container close
			echo '</div>';

			// fullwidth wrap close
			if ( $args['full_width'] ) { echo '</div>'; }

			// pagination
			if ( $args['posts_per_page'] > 0 ) {

				dt_paginator( $args['query'], array(
					'class' => 'paginator iso-paginator',
					'max_num_pages' => intval( ceil( count( $args['query']->posts ) / $args['posts_per_page'] ) ),
					'posts_per_page' => $args['posts_per_page'],
					'paged' => 1
				) );

			}

			// main wrap
			echo '</div>';

			do_action( 'presscore_after_shortcode_loop', $this->shortcode_name, $this->atts );

			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		}

		protected function display_posts_filter( $args = array() ) {
			$default_args = array(
				'post_type' => 'post',
				'taxonomy' => 'category',
				'query' => null,
				'select' => 'all',
				'show_category_filter' => true
			);
			$args = wp_parse_args( $args, $default_args );

			$filter_args = array();
			if ( $args['show_category_filter'] ) {

				// categorizer args
				$filter_args = array(
					'taxonomy'	=> $args['taxonomy'],
					'post_type'	=> $args['post_type'],
					'select'	=> $args['select']
				);

				if ( 'only' == $args['select'] && $args['query'] && $args['query']->posts && isset( $args['query']->tax_query->queried_terms[ $args['taxonomy'] ]['terms'] ) ) {
					$filter_args['terms'] = array();
					$queried_terms = $args['query']->tax_query->queried_terms[ $args['taxonomy'] ]['terms'];
					$posts_ids = wp_list_pluck( $args['query']->posts, 'ID' );
					$posts_terms = wp_get_object_terms( $posts_ids, $args['taxonomy'] );

					foreach ( $posts_terms as $term ) {
						if ( in_array( $term->slug, $queried_terms ) ) {
							$filter_args['terms'][] = intval( $term->term_id );
						}
					}
					$filter_args['terms'] = array_unique( $filter_args['terms'] );
				}

			}

			$filter_class = '';
			if ( ! $this->config->get( 'template.posts_filter.orderby.enabled' ) && ! $this->config->get( 'template.posts_filter.order.enabled' ) ) {
				$filter_class .= ' extras-off';
			}

			// display categorizer
			presscore_get_category_list( array(
				// function located in /in/extensions/core-functions.php
				'data'	=> dt_prepare_categorizer_data( $filter_args ),
				'class'	=> 'filter iso-filter' . $filter_class
			) );
		}

		protected function sanitize_attributes( &$atts ) {
			return $atts;
		}

	}

endif;
