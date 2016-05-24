<?php
/**
 * Blog helpers
 *
 * @since 1.0.0
 * @package vogue
 */

if ( ! function_exists( 'presscore_display_related_posts' ) ) :

	/**
	 * Display related posts.
	 *
	 */
	function presscore_display_related_posts() {
		if ( !of_get_option( 'general-show_rel_posts', false ) ) {
			return '';
		}

		global $post;

		$html = '';
		$terms = array();

		switch ( get_post_meta( $post->ID, '_dt_post_options_related_mode', true ) ) {
			case 'custom': $terms = get_post_meta( $post->ID, '_dt_post_options_related_categories', true ); break;
			default: $terms = wp_get_object_terms( $post->ID, 'category', array('fields' => 'ids') );
		}

		if ( $terms && !is_wp_error($terms) ) {

			$attachments_data = presscore_get_related_posts( array(
				'cats'		=> $terms,
				'post_type' => 'post',
				'taxonomy'	=> 'category',
				'args'		=> array( 'posts_per_page' => intval(of_get_option('general-rel_posts_max', 12)) )
			) );

			$posts_list = presscore_get_posts_small_list( $attachments_data, array( 'image_dimensions' => array( 'w' => 80, 'h' => 60 ) ) );
			if ( $posts_list ) {

				$config = Presscore_Config::get_instance();

				if ( 'disabled' != $config->get('sidebar_position') ) {
					$column_class = 'wf-1-2';
				} else {
					$column_class = 'wf-1-3';
				}

				foreach ( $posts_list as $p ) {
					$html .= sprintf( '<div class="wf-cell %s"><div class="borders">%s</div></div>', $column_class, $p );
				}

				$html = '<section class="items-grid wf-container">' . $html . '</section>';

				$head_title = esc_html( of_get_option( 'general-rel_posts_head_title', 'Related posts' ) );
				// add title
				if ( $head_title ) {
					$html = '<div class="dt-fancy-separator title-left fancy-posts-title"><div class="dt-fancy-title">' . $head_title . '<span class="separator-holder separator-right"></span></div></div>' . $html;
				}

			}
		}

		echo (string) apply_filters( 'presscore_display_related_posts', $html );
	}

endif;

if ( ! function_exists( 'presscore_get_blog_post_fancy_date' ) ) :

	/**
	 * Returns fancy date for posts
	 *
	 * @return string Fancy date html
	 */
	function presscore_get_blog_post_fancy_date() {

		$config = Presscore_Config::get_instance();

		if ( !$config->get( 'post.fancy_date.enabled' ) ) {
			return '';
		}

		$additional_classes = '';
		if ( 'right_list' == $config->get( 'layout' ) ) {
			$additional_classes .= 'right-aligned';
		}

		return presscore_get_post_fancy_date( $additional_classes );
	}

endif;

if ( ! function_exists( 'presscore_post_format_supports_media_content' ) ) :

	/**
	 * Check if post format supports media content
	 *
	 * @since 1.0.0
	 *
	 * @param  string $post_format Post format
	 * @return boolean
	 */
	function presscore_post_format_supports_media_content( $post_format = '' ) {
		return in_array( $post_format, array( '', 'video', 'gallery', 'image' ) );
	}

endif;

if ( ! function_exists( 'presscore_get_post_format' ) ) :

	/**
	 * Description here
	 *
	 * @since 1.0.0
	 *
	 * @return string Post format
	 */
	function presscore_get_post_format() {

		$post_format = get_post_format();
		if ( ! $post_format ) {
			$post_format = 'standard';
		}

		return $post_format;
	}

endif;

if ( ! function_exists( 'presscore_get_blog_list_content_width' ) ) :

	function presscore_get_blog_list_content_width( $content_type = 'content' ) {
		static $static_content_width = null;

		if ( null == $static_content_width ) {

			$max_content_width = 100;
			$min_content_width = 0;
			$config = Presscore_Config::get_instance();
			$media_content_width = absint( $config->get( 'post.preview.media.width' ) );

			if ( $media_content_width > $max_content_width ) {
				$media_content_width = $max_content_width;

			} else if ( $media_content_width < $min_content_width ) {
				$media_content_width = $min_content_width;

			}

			$static_content_width = array();

			$static_content_width['media'] = $media_content_width;

			$static_content_width['content'] = $max_content_width - $media_content_width;
			if ( $static_content_width['content'] <= 0 ) {
				$static_content_width['content'] = 100;
			}

		}

		return array_key_exists($content_type, $static_content_width) ? $static_content_width[ $content_type ] : $static_content_width['content'];
	}

endif;

if ( ! function_exists( 'presscore_get_post_content_style_for_blog_list' ) ) :

	/**
	 * Get style attribute for content parts for blog posts
	 * 
	 * @param  string $content_type Content type: 'content' or 'media'
	 * @return string               Empty string for wide preview or if post type do not support media content, width style attribute in other case
	 */
	function presscore_get_post_content_style_for_blog_list( $content_type = 'content' ) {
		$config = Presscore_Config::get_instance();

		if ( 'wide' == $config->get( 'post.preview.width' ) || !presscore_post_format_supports_media_content( get_post_format() ) ) {
			return '';

		} else {
			return sprintf( 'style="width: %s%%;"', presscore_get_blog_list_content_width( $content_type ) );

		}
	}

endif;

if ( ! function_exists( 'presscore_blog_ajax_loading_responce' ) ) :

	function presscore_blog_ajax_loading_responce( $ajax_data = array() ) {
		global $post, $wp_query, $paged, $page;

		extract( $ajax_data );

		if ( !$nonce || !$post_id || !$post_paged || !$target_page || !wp_verify_nonce( $nonce, 'presscore-posts-ajax' ) ) {
			$responce = array( 'success' => false, 'reason' => 'corrupted data' );

		} else {

			require_once PRESSCORE_EXTENSIONS_DIR . '/aq_resizer.php';
			require_once PRESSCORE_DIR . '/template-hooks.php';
			require_once PRESSCORE_EXTENSIONS_DIR . '/dt-pagination.php';

			// get page
			query_posts( array(
				'post_type' => 'page',
				'page_id' => $post_id,
				'post_status' => 'publish',
				'page' => $target_page
			) );

			$html = '';
			if ( have_posts() && !post_password_required() ) : while ( have_posts() ) : the_post(); // main loop

				$config = Presscore_Config::get_instance();

				$config->set( 'template', 'blog' );
				$config->set( 'layout', empty( $page_data['layout'] ) ? 'masonry' : $page_data['layout'] );

				presscore_config_base_init();
				presscore_react_on_categorizer();

				do_action( 'presscore_before_loop' );

				ob_start();

				$query = presscore_get_blog_query();

				if ( $query->have_posts() ) {

					$page_layout = presscore_get_current_layout_type();
					$current_post = $posts_count;

					while( $query->have_posts() ) { $query->the_post();
/*
						// check if current post already loaded
						$key_in_loaded = array_search( $post->ID, $loaded_items );
						if ( false !== $key_in_loaded ) {
							unset( $loaded_items[ $key_in_loaded ] );
							continue;
						}
*/
						presscore_populate_post_config();

						switch ( $page_layout ) {
							case 'masonry':
								presscore_get_template_part( 'theme', 'blog/masonry/blog-masonry-post' );
								break;
							case 'list':
								// global posts counter
								$config->set( 'post.query.var.current_post', ++$current_post );

								presscore_get_template_part( 'theme', 'blog/list/blog-list-post' );
								break;
						}
					}

					wp_reset_postdata();

				}

				$html .= ob_get_clean();

			endwhile;

			$responce = array( 'success' => true );

			///////////////////
			// pagination //
			///////////////////

			$next_page_link = dt_get_next_posts_url( $query->max_num_pages );

			if ( $next_page_link ) {
				$responce['nextPage'] = dt_get_paged_var() + 1;

			} else {
				$responce['nextPage'] = 0;

			}

			$load_style = $config->get( 'load_style' );

			// pagination style
			if ( presscore_is_load_more_pagination() ) {
				$pagination = dt_get_next_page_button( $query->max_num_pages, 'paginator paginator-more-button with-ajax' );

				if ( $pagination ) {
					$responce['currentPage'] = dt_get_paged_var();
					$responce['paginationHtml'] = $pagination;
				} else {
					$responce['currentPage'] = $post_paged;
				}

				$responce['paginationType'] = 'more';

			} else if ( 'ajax_pagination' == $load_style ) {

				ob_start();
				dt_paginator( $query, array('class' => 'paginator with-ajax', 'ajaxing' => true ) );
				$pagination = ob_get_clean();

				if ( $pagination ) {
					$responce['paginationHtml'] = $pagination;
				}

				$responce['paginationType'] = 'paginator';

			}

			/////////////////
			// response //
			/////////////////

			$responce['itemsToDelete'] = array_values( $loaded_items );
			// $responce['query'] = $page_query->query;
			$responce['order'] = $query->query['order'];
			$responce['orderby'] = $query->query['orderby'];

			endif; // main loop

			$responce['html'] = $html;

		}

		return $responce;
	}

endif;

if ( ! function_exists( 'presscore_get_post_media_slider' ) ) :

	/**
	 * Post media slider.
	 *
	 * Based on royal slider. Properly works only in the loop.
	 *
	 * @since 1.0.0
	 * 
	 * @return string HTML.
	 */
	function presscore_get_post_media_slider( $attachments_data, $options = array() ) {
		if ( ! $attachments_data ) {
			return '';
		}

		$default_options = array(
			'class'	=> array(),
			'style'	=> ' style="width: 100%"',
			'proportions' => array( 'width' => '', 'height' => '' )
		);
		$options = wp_parse_args( $options, $default_options );

		$width = $options['proportions']['width'];
		$height = $options['proportions']['height'];

		$slideshow = presscore_get_royal_slider( $attachments_data, array(
			'width'		=> $width,
			'height'	=> $height,
			'class' 	=> $options['class'],
			'style'		=> $options['style'],
			'show_info'	=> array()
		) );

		return $slideshow;
	}

endif;

if ( ! function_exists( 'presscore_search_post_galleries' ) ) :

	/**
	 * Recursively search for gallery shortcodes in given content.
	 *
	 * @since 1.0.0
	 *
	 * @param  string  $content   Target content
	 * @param  boolean $html      If true - return array of galleries html
	 * @param  integer $num       Number of galleries to search
	 * @param  array   $galleries Base galleries array
	 * @return array              Found galleries array
	 */
	function presscore_search_post_galleries( $content = '', $html = true, $num = 0, $galleries = array() ) {
		if ( preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER ) ) {
			foreach ( $matches as $shortcode ) {
				if ( 'gallery' === $shortcode[2] ) {
					$srcs = array();

					$gallery = do_shortcode_tag( $shortcode );
					if ( $html ) {
						$galleries[] = $gallery;
					} else {
						preg_match_all( '#src=([\'"])(.+?)\1#is', $gallery, $src, PREG_SET_ORDER );
						if ( ! empty( $src ) ) {
							foreach ( $src as $s )
								$srcs[] = $s[2];
						}

						$data = shortcode_parse_atts( $shortcode[3] );
						$data['src'] = array_values( array_unique( $srcs ) );
						$galleries[] = $data;
					}
				}

				if ( $num && count( $galleries ) >= $num ) {
					break;
				}

				if ( ! empty( $shortcode[5] ) ) {
					$galleries = presscore_search_post_galleries( $shortcode[5], $html, $num, $galleries );
				}
			}
		}

		return $galleries;
	}

endif;

if ( ! function_exists( 'presscore_get_post_galleries_recursive' ) ) :

	/**
	 * Recursively search for gallery shortcodes in given post.
	 *
	 * @since 1.0.0
	 * 
	 * @param  integer $post Post ID
	 * @param  boolean $html If true - return array of galleries html
	 * @param  integer $num  Number of galleries to search
	 * @return array         Found galleries array
	 */
	function presscore_get_post_galleries_recursive( $post, $html = true, $num = 0 ) {
		if ( ! $post = get_post( $post ) )
			return array();

		if ( ! has_shortcode( $post->post_content, 'gallery' ) )
			return array();

		$galleries = presscore_search_post_galleries( $post->post_content, $html, $num );

		return apply_filters( 'presscore_get_post_galleries_recursive', $galleries, $post );
	}

endif;

if ( ! function_exists( 'presscore_get_post_gallery_recursive' ) ) :

	/**
	 * Return first gallery shortcode info in post.
	 *
	 * @since 1.0.0
	 * 
	 * @param  integer $post Post ID
	 * @param  boolean $html If true - return array of galleries html
	 * @return array         Found shotcode info
	 */
	function presscore_get_post_gallery_recursive( $post = 0, $html = true ) {
		$galleries = presscore_get_post_galleries_recursive( $post, $html, 2 );
		$gallery = reset( $galleries );

		return apply_filters( 'presscore_get_post_gallery_recursive', $gallery, $post, $galleries );
	}

endif;

if ( ! function_exists( 'presscore_post_buttons' ) ) :

	/**
	 * PressCore post Details and Edit buttons in <p> tag.
	 */
	function presscore_post_buttons() {
		echo presscore_post_details_link() . presscore_post_edit_link();
	}

endif;

if ( ! function_exists( 'presscore_get_post_format_class' ) ) :

	/**
	 * Post format class adapter.
	 */
	function presscore_get_post_format_class( $post_format = null ) {

		if ( 'post' == get_post_type() && null === $post_format ) {
			$post_format = get_post_format();
		}

		$format_class_adapter = array(
			''			=> 'format-standard',
			'image'		=> 'format-photo',
			'gallery'	=> 'format-gallery',
			'quote'		=> 'format-quote',
			'video'		=> 'format-video',
			'link'		=> 'format-link',
			'audio'		=> 'format-audio',
			'chat'		=> 'format-chat',
			'status'	=> 'format-status',
			'aside'		=> 'format-aside'
		);
		$format_class = isset( $format_class_adapter[ $post_format ] ) ? $format_class_adapter[ $post_format ] : $format_class_adapter[''];

		return $format_class;
	} 

endif;

if ( ! function_exists( 'presscore_get_blog_post_date' ) ) :

	/**
	 * Return post date only for blog. Reacts on themeoptions settings.
	 *
	 * @return string
	 */
	function presscore_get_blog_post_date() {
		$post_meta = of_get_option( 'general-blog_meta_on', 1 );
		$post_date = of_get_option( 'general-blog_meta_date', 1 );

		if ( !$post_meta ) {
			return '';
		}

		if ( !$post_date ) {
			return '&nbsp;';
		}

		return presscore_get_post_data();
	}

endif;

if ( ! function_exists( 'presscore_get_blog_query' ) ) :

	function presscore_get_blog_query() {
		$config = presscore_get_config();
		$orderby = $config->get( 'orderby' );

		$query_args = array(
			'post_type'		=> 'post',
			'post_status'	=> 'publish',
			'paged'			=> dt_get_paged_var(),
			'order'			=> $config->get( 'order' ),
			'orderby'		=> 'name' == $orderby ? 'title' : $orderby,
		);

		$ppp = $config->get( 'posts_per_page' );
		if ( $ppp ) {
			$query_args['posts_per_page'] = intval( $ppp );
		}

		$display = $config->get( 'display' );
		if ( ! empty( $display['terms_ids'] ) ) {
			$terms_ids = array_values($display['terms_ids']);

			switch( $display['select'] ) {
				case 'only':
					$query_args['category__in'] = $terms_ids;
					break;

				case 'except':
					$query_args['category__not_in'] = $terms_ids;
			}

		}

		// get filter request
		$request_display = $config->get('request_display');
		if ( $request_display ) {

			// get all category terms
			$all_terms = get_categories( array(
				'type'          => 'post',
				'hide_empty'    => 1,
				'hierarchical'  => 0,
				'taxonomy'      => 'category',
				'pad_counts'    => false
			) );

			// populate $all_terms_array with terms names
			$all_terms_array = array();
			foreach ( $all_terms as $term ) {
				$all_terms_array[] = $term->term_id;
			}

			// except for empty term that appers when all filter category selcted, see it's url
			if ( 0 == current($request_display['terms_ids']) ) {
				$request_display['terms_ids'] = $all_terms_array;
			}

			// override base tax_query
			$query_args['tax_query'] = array( array(
				'taxonomy'	=> 'category',
				'field'		=> 'id',
				'terms'		=> array_values($request_display['terms_ids']),
				'operator'	=> 'IN',
			) );

			if ( 'except' == $request_display['select'] ) {
				$query_args['tax_query'][0]['operator'] = 'NOT IN';
			}
		}

		$query = new WP_Query( $query_args );

		return $query;
	}

endif;
