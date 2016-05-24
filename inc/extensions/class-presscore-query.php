<?php
/**
 * Presscore Query.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Query {

	public function get_posts_by_terms( $args = array() ) {
		$defaults = array(
			'post_type'			=> 'post',
			'taxonomy'			=> 'category',
			'terms'				=> null,
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'posts_per_page'	=> 10,
			'post__in'			=> null,
			'post__not_in'		=> null,
			'select'			=> 'all',
			'no_found_rows'		=> false
		);
		$args = wp_parse_args( $args, $defaults );

		if ( ! $this->verify_args( $args ) ) {
			return new WP_Query();
		}

		$query_args = array(
			'post_type'		=> $args['post_type'],
			'order'			=> $args['order'],
			'no_found_rows'	=> $args['no_found_rows'],
			'orderby'		=> 'name' == $args['orderby'] ? 'title' : $args['orderby'],
			'paged'			=> dt_get_paged_var(),
			'post_status'	=> 'publish' ,
		);

		if ( $args['posts_per_page'] ) {
			$query_args['posts_per_page'] = $args['posts_per_page'];
		}

		if ( $args['post__in'] ) {
			$query_args['post__in'] = $args['post__in'];
		}

		if ( $args['post__not_in'] ) {
			$query_args['post__not_in'] = $args['post__not_in'];
		}

		// construct base tax_query if not all terms slected
		if ( in_array( $args['select'], array( 'only', 'except' ) ) && ! empty( $args['terms'] ) && is_array( $args['terms'] ) ) {

			// get all terms ids
			$all_terms = wp_list_pluck( get_categories( array(
				'type'			=> $args['post_type'],
				'taxonomy'		=> $args['taxonomy'],
				'pad_counts'	=> false,
				'hide_empty'	=> 1,
				'hierarchical'	=> 0,
			) ), 'term_id' );

			// sanitize terms
			$terms = array_values( $args['terms'] );

			// ONLY tax_query
			if ( 'only' == $args['select'] ) {
				$operator = 'IN';
				if ( 0 == $terms[0] ) {
					$terms = $all_terms;
					$operator = 'NOT IN';
				}

				$query_args['tax_query'] = array( array(
					'taxonomy'	=> $args['taxonomy'],
					'terms'		=> $terms,
					'operator'	=> $operator,
					'field'		=> 'id',
				) );

			// EXCEPT tax_query
			} else if ( 'except' == $args['select'] ) {
				$in_terms = array_diff( $all_terms, $terms );
				sort( $in_terms );

				if ( $in_terms ) {
					$query_args['tax_query'] = array(
						'relation'	=> 'OR',
						array(
							'taxonomy'	=> $args['taxonomy'],
							'terms'		=> $in_terms,
							'operator'	=> 'IN',
							'field'		=> 'id',
						),
						array(
							'taxonomy'	=> $args['taxonomy'],
							'terms'		=> $terms,
							'operator'	=> 'NOT IN',
							'field'		=> 'id',
						)
					);

					add_filter( 'posts_clauses', 'dt_core_join_left_filter' );
				}
			}

		}

		$page_query = new WP_Query( $query_args );
		remove_filter( 'posts_clauses', 'dt_core_join_left_filter' );

		return $page_query;
	}

	public function get_related_posts_by_terms( $args = array() ) {
		$defaults = array(
			'post_type' => 'post',
			'taxonomy' => 'category',
			'posts_per_page' => 10,
			'terms' => null,
			'post__not_in' => array( get_the_ID() )
		);
		$args = wp_parse_args( $args, $defaults );

		if ( ! $this->verify_args( $args ) ) {
			return new WP_Query();
		}

		return new WP_Query( array(
			'no_found_rows'		=> 1,
			'posts_per_page'	=> $args['posts_per_page'],
			'post_type'			=> $args['post_type'],
			'post_status'		=> 'publish',
			'post__not_in'		=> $args['post__not_in'],
			'tax_query'			=> array( array(
				'taxonomy'	=> $args['taxonomy'],
				'fields'	=> 'term_id',
				'terms'		=> $args['terms']
			) ),
		) );
	}

	public function get_attachments( $args = array() ) {
		$defaults = array(
			'post_type'			=> 'attachment',
			'post_mime_type'	=> 'image',
			'post_status'		=> 'inherit',
			'orderby'			=> 'date',
			'order'				=> 'DESC',
			'posts_per_page'	=> 10,
			'no_found_rows'		=> true
		);
		$args = wp_parse_args( $args, $defaults );

		return new WP_Query( $args );
	}

	public function get_posts( $args = array() ) {
		$defaults = array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish' ,
			'orderby'			=> 'date',
			'order'				=> 'DESC',
			'posts_per_page'	=> 10,
			'no_found_rows'		=> false
		);
		$args = wp_parse_args( $args, $defaults );

		if ( ! $this->verify_args( $args ) ) {
			return new WP_Query();
		}

		return new WP_Query( $args );
	}

	protected function verify_args( $args ) {
		if ( ! post_type_exists( $args['post_type'] ) ) {
			return false;
		} else if ( isset( $args['taxonomy'] ) && ! taxonomy_exists( $args['taxonomy'] ) ) {
			return false;
		}
		return true;
	}
}
