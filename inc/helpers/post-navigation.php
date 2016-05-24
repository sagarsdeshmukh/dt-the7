<?php
/**
 * Post navigation helpers
 * 
 * @package vogue
 * @since 1.0.0
 */

if ( ! function_exists( 'presscore_get_next_post_link' ) ) :

	function presscore_get_next_post_link( $link_text = '', $link_class = '', $dummy = '' ) {
		$post_link = get_next_post_link( '%link', $link_text );
		if ( $post_link ) {
			return str_replace( 'href=', 'class="'. esc_attr( $link_class ) . '" href=', $post_link );
		}

		return $dummy;
	}

endif;

if ( ! function_exists( 'presscore_get_previous_post_link' ) ) :

	function presscore_get_previous_post_link( $link_text = '', $link_class = '', $dummy = '' ) {
		$post_link = get_previous_post_link( '%link', $link_text );
		if ( $post_link ) {
			return str_replace( 'href=', 'class="'. esc_attr( $link_class ) . '" href=', $post_link );
		}

		return $dummy;
	}

endif;

if ( ! function_exists( 'presscore_get_post_back_link' ) ) :

	function presscore_get_post_back_link() {
		$page_id = apply_filters( 'presscore_post_back_link_id', presscore_config()->get( 'post.navigation.back_button.target_page_id' ) );
		if ( $page_id ) {
			return '<a class="back-to-list" href="' . esc_url( get_permalink( $page_id ) ) . '"></a>';
		}

		return '';
	}

endif;

if ( ! function_exists( 'presscore_post_navigation' ) ) :

	function presscore_post_navigation() {

		if ( ! in_the_loop() ) {
			return '';
		}

		$config = Presscore_Config::get_instance();

		$output = '';

		if ( $config->get( 'post.navigation.arrows.enabled' ) ) {
			$output .= presscore_get_next_post_link( '', 'prev-post', '<a class="prev-post disabled" href="javascript: void(0);"></a>' );
		}

		if ( $config->get( 'post.navigation.back_button.enabled' ) ) {
			$output .= presscore_get_post_back_link();
		}

		if ( $config->get( 'post.navigation.arrows.enabled' ) ) {
			$output .= presscore_get_previous_post_link( '', 'next-post', '<a class="next-post disabled" href="javascript: void(0);"></a>' );
		}

		return $output;
	}

endif;

if ( ! function_exists( 'presscore_single_post_navigation_bar' ) ) :

	function presscore_single_post_navigation_bar() {

		if ( ! ( is_single() && presscore_is_content_visible() ) ) {
			return;
		}

		$post_meta = presscore_get_posted_on();
		$post_navigation = presscore_post_navigation();

		if ( $post_meta || $post_navigation ) {

			$article_top_bar_html_class = 'article-top-bar ' . presscore_get_page_title_bg_mode_html_class();

			if ( ! $post_meta ) {
				$article_top_bar_html_class .= ' post-meta-disabled';
			}

			echo '<div class="' . esc_attr( $article_top_bar_html_class ) . '"><div class="wf-wrap"><div class="wf-container-top">';

			echo $post_meta;

			echo '<div class="navigation-inner"><div class="single-navigation-wrap">' . $post_navigation . '</div></div>';

			echo '</div></div></div>';
		}

	}

endif;
add_action( 'presscore_before_content', 'presscore_single_post_navigation_bar', 20 );

if ( ! function_exists( 'dt_get_next_page_button' ) ) :

	/**
	 * Next page button.
	 *
	 */
	function dt_get_next_page_button( $max, $class = '' ) {
		$next_posts_link = dt_get_next_posts_url( $max );

		if ( $next_posts_link ) {

			$button_html_class = 'button-load-more';
			if ( presscore_is_lazy_loading() ) {
				$button_html_class .= ' button-lazy-loading';
				$caption = __( 'Loading...', 'the7mk2' );
			} else {
				$caption = __( 'Load more', 'the7mk2' );
			}
			$caption = apply_filters( 'dt_get_next_page_button-caption', $caption );
			$class = apply_filters( 'dt_get_next_page_button-wrap_class', $class );
			$icon = '<span class="stick"></span><span class="stick"></span><span class="stick"></span>';

			return '<div class="' . esc_attr( $class ) . '">
				<a class="' . esc_attr( $button_html_class ) . '" href="javascript: void(0);" data-dt-page="' . esc_attr( dt_get_paged_var() ) .'" >'. $icon . '<span class="h5-size button-caption">' . esc_html( $caption ) . '</span></a>
			</div>';

		}

		return '';
	}

endif;

if ( ! function_exists( 'presscore_get_breadcrumbs' ) ) :

	/**
	 * Returns breadcrumbs html
	 * original script you can find on http://dimox.net
	 * 
	 * @since 1.0.0
	 * 
	 * @return string Breadcrumbs html
	 */
	function presscore_get_breadcrumbs( $args = array() ) {

		$default_args = array(
			'text' => array(
				'home' => __( 'Home', 'the7mk2'),
				'category' => __( 'Category "%s"', 'the7mk2'),
				'search' => __( 'Results for "%s"', 'the7mk2'),
				'tag' => __( 'Entries tagged with "%s"', 'the7mk2'),
				'author' => __( 'Article author %s', 'the7mk2'),
				'404' => __( 'Error 404', 'the7mk2'),
			),
			'showCurrent' => 1,
			'showOnHome' => 1,
			'delimiter' => '',
			'before' => '<li class="current">',
			'after' => '</li>',
			'linkBefore' => '<li typeof="v:Breadcrumb">',
			'linkAfter' => '</li>',
			'linkAttr' => ' rel="v:url" property="v:title"',
			'beforeBreadcrumbs' => '',
			'afterBreadcrumbs' => '',
			'listAttr' => ' class="breadcrumbs text-small"'
		);

		$args = wp_parse_args( $args, $default_args );

		$breadcrumbs_html = apply_filters( 'presscore_get_breadcrumbs-html', '', $args );
		if ( $breadcrumbs_html ) {
			return $breadcrumbs_html;
		}

		extract( array_intersect_key( $args, $default_args ) );

		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s" title="">%2$s</a>' . $linkAfter;

		$breadcrumbs_html .= '<div class="assistive-text">' . __( 'You are here:', 'the7mk2' ) . '</div>';

		$homeLink = home_url() . '/';
		global $post;

		if (is_home() || is_front_page()) {

			if ($showOnHome == 1) {
				$breadcrumbs_html .= '<ol' . $listAttr . '><a href="' . $homeLink . '">' . $text['home'] . '</a></ol>';
			}

		} else {

			$breadcrumbs_html .= '<ol' . $listAttr . ' xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

			if ( is_category() ) {

				$thisCat = get_category(get_query_var('cat'), false);

				if ($thisCat->parent != 0) {

					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

					if(preg_match( '/title="/', $cats ) ===0) {
						$cats = preg_replace('/title=""/', 'title=""', $cats);
					}

					$breadcrumbs_html .= $cats;
				}

				$breadcrumbs_html .= $before . sprintf($text['category'], single_cat_title('', false)) . $after;

			} elseif ( is_search() ) {

				$breadcrumbs_html .= $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {

				$breadcrumbs_html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				$breadcrumbs_html .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				$breadcrumbs_html .= $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {

				$breadcrumbs_html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				$breadcrumbs_html .= $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {

				$breadcrumbs_html .= $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {

				$post_type = get_post_type();
				if ( $post_type !== 'post' ) {

					$post_type_obj = get_post_type_object( $post_type );
					$breadcrumbs_html .= sprintf($link, get_post_type_archive_link( $post_type ), $post_type_obj->labels->singular_name);

					if ($showCurrent == 1) {
						$breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
					}

				} else {

					$cat = get_the_category();
					if ( $cat ) {
						$cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, $delimiter);

						if ( ! is_wp_error( $cats ) ) {
							if ($showCurrent == 0) {
								$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
							}

							$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
							$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

							$breadcrumbs_html .= $cats;
						}
					}

					if ($showCurrent == 1) {
						$breadcrumbs_html .= $before . get_the_title() . $after;
					}

				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

				$post_type_obj = get_post_type_object(get_post_type());
				if ( $post_type_obj ) {
					$breadcrumbs_html .= $before . $post_type_obj->labels->singular_name . $after;
				}

			} elseif ( is_attachment() ) {

				if ($showCurrent == 1) {
					$breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
				}

			} elseif ( is_page() && !$post->post_parent ) {

				if ($showCurrent == 1) {
					$breadcrumbs_html .= $before . get_the_title() . $after;
				}

			} elseif ( is_page() && $post->post_parent ) {

				$parent_id  = $post->post_parent;
				$breadcrumbs = array();

				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}

				$breadcrumbs = array_reverse($breadcrumbs);

				for ($i = 0; $i < count($breadcrumbs); $i++) {

					$breadcrumbs_html .= $breadcrumbs[$i];

					if ($i != count($breadcrumbs)-1) {
						$breadcrumbs_html .= $delimiter;
					}
				}

				if ($showCurrent == 1) {
					$breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
				}

			} elseif ( is_tag() ) {

				$breadcrumbs_html .= $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {

				global $author;
				$userdata = get_userdata($author);
				$breadcrumbs_html .= $before . sprintf($text['author'], $userdata->display_name) . $after;

			} elseif ( is_404() ) {

				$breadcrumbs_html .= $before . $text['404'] . $after;
			}

			if ( get_query_var('paged') ) {

				$breadcrumbs_html .= $before;

				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					$breadcrumbs_html .= ' (';
				}

				$breadcrumbs_html .= __( 'Page', 'the7mk2' ) . ' ' . get_query_var('paged');

				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					$breadcrumbs_html .= ')';
				}

				$breadcrumbs_html .= $after;

			}

			$breadcrumbs_html .= '</ol>';
		}

		return apply_filters( 'presscore_get_breadcrumbs', $beforeBreadcrumbs . $breadcrumbs_html . $afterBreadcrumbs, $args );
	} // end presscore_get_breadcrumbs()

endif;

if ( ! function_exists( 'presscore_complex_pagination' ) ) :

	function presscore_complex_pagination( &$query ) {
		if ( $query ) {

			if ( presscore_is_load_more_pagination() ) {

				// load more button
				echo dt_get_next_page_button( $query->max_num_pages, 'paginator paginator-more-button with-ajax' );

			} else {

				$ajax_class = 'default' != presscore_get_config()->get( 'load_style' ) ? ' with-ajax' : '';

				// paginator
				dt_paginator( $query, array( 'class' => 'paginator' . $ajax_class ) );

			}

		}
	}

endif;

if ( ! function_exists( 'presscore_display_posts_filter' ) ) :

	function presscore_display_posts_filter( $args = array() ) {

		$default_args = array(
			'post_type' => 'post',
			'taxonomy' => 'category',
			'query' => null
		);
		$args = wp_parse_args( $args, $default_args );

		$config = presscore_get_config();
		$load_style = $config->get('load_style');

		// categorizer
		$filter_args = array();
		if ( $config->get( 'template.posts_filter.terms.enabled' ) ) {

			// $posts_ids = $terms_ids = array();
			$default_display = array(
				'select' => 'all',
				'type' => 'category',
				'terms_ids' => array(),
				'posts_ids' => array(),
			);
			$display = wp_parse_args( $config->get( 'display' ), $default_display );

			// categorizer args
			$filter_args = array(
				'taxonomy'	=> $args['taxonomy'],
				'post_type'	=> $args['post_type'],
				'select'	=> $display['select'],
			);

			if ( 'category' == $display['type'] ) {

				$terms_ids = empty($display['terms_ids']) ? array() : $display['terms_ids'];
				$filter_args['terms'] = $terms_ids;

			} elseif ( 'albums' == $display['type'] ) {

				$posts_ids = isset($display['posts_ids']) ? $display['posts_ids'] : array();
				$filter_args['post_ids'] = $posts_ids;

			}
		}

		$filter_class = '';

		if ( 'default' !== $load_style ) {
			$filter_class .= ' with-ajax';
		} else {
			$filter_class .= ' without-isotope';
		}

		if ( ! $config->get( 'template.posts_filter.orderby.enabled' ) && ! $config->get( 'template.posts_filter.order.enabled' ) ) {
			$filter_class .= ' extras-off';
		}

		// display categorizer
		presscore_get_category_list( array(
			// function located in /in/extensions/core-functions.php
			'data'	=> dt_prepare_categorizer_data( $filter_args ),
			'class'	=> 'filter' . $filter_class
		) );
	}

endif;
