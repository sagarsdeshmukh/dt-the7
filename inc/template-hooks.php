<?php
/**
 * Theme hooks
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_head', 'dt_core_detect_retina_script', 1 );

if ( ! function_exists( 'presscore_template_config_init' ) ) :

	function presscore_template_config_init() {
		presscore_config_base_init();
	}
	add_action( 'get_header', 'presscore_template_config_init', 9 );

endif;

if ( ! function_exists( 'presscore_tracking_code_in_header_action' ) ) :

	/**
	 * Output trcking code in header.
	 *
	 * @since 3.0.0
	 */
	function presscore_tracking_code_in_header_action() {
		if ( ! is_preview() ) {
			echo of_get_option( 'general-tracking_code' );
		}
	}

	add_action( 'wp_head', 'presscore_tracking_code_in_header_action', 9999 );

endif;

if ( ! function_exists( 'presscore_show_navigation_next_prev_posts_titles' ) ) :

	/**
	 * For blog posts only show next/prev posts titles.
	 *
	 */
	function presscore_show_navigation_next_prev_posts_titles( $args = array() ) {
		$args['next_post_text']	= '%title';
		$args['prev_post_text']	= '%title';
		return $args;
	}

endif;

if ( ! function_exists( 'presscore_filter_attachment_data' ) ) :

	/**
	 * Filter attachment data.
	 *
	 * @since 3.1
	 */
	function presscore_filter_attachment_data( $attachment_data = array() ) {

		// hide title
		if ( !empty($attachment_data['ID']) ) {
			$hide_title = presscore_imagee_title_is_hidden( $attachment_data['ID'] );

			if ( $hide_title ) {
				$attachment_data['title'] = false;
			}
		}

		$defaults = array(
			'alt' => '',
			'caption' => '',
			'description' => '',
			'title' => '',
			'permalink' => '',
			'video_url' => '',
			'ID' => '',
		);

		$image_attachment_data = array_intersect_key( $attachment_data, $defaults );
		$image_attachment_data = wp_parse_args( $image_attachment_data, $defaults );

		$attachment_data['image_attachment_data'] = $image_attachment_data;

		return $attachment_data;
	}

endif;

add_filter( 'presscore_get_attachment_post_data-attachment_data', 'presscore_filter_attachment_data', 15 );


if ( ! function_exists( 'presscore_add_default_meta_to_images' ) ) :

	/**
	 * Add description to images.
	 *
	 * TODO: use proper image attributes i.e. img_title and alt. Change all images wraps.
	 */
	function presscore_add_default_meta_to_images( $args = array() ) {

		// add description to images if it's not defined
		if ( $id = absint($args['img_id']) ) {

			$attachment = get_post( $id );

			if ( $attachment ) {

				if ( '' === $args['title'] ) {
					$args['title'] = esc_attr($attachment->post_title);
				}

				// set image description
				if ( empty( $args['img_description'] ) ) {
					$args['img_description'] = $attachment->post_content;
				}

			}

			$hide_title = presscore_imagee_title_is_hidden( $id );

			// use image title instead alt
			if ( $hide_title ) {
				// $args['alt'] = get_the_title( $id );
			// } else {
				$args['img_title'] = false;
			}
		}

		return $args;
	}

endif;

add_filter( 'dt_get_thumb_img-args', 'presscore_add_default_meta_to_images', 15 );


if ( ! function_exists( 'presscore_wrap_edit_link_in_p' ) ) :

	/**
	 * Wrap edit link in p tag.
	 *
	 */
	function presscore_wrap_edit_link_in_p( $link = '' ){
		if ( $link ) {
			$link = '<p>' . $link . '</p>';
		}
		return $link;
	}

endif;

add_filter( 'presscore_post_edit_link', 'presscore_wrap_edit_link_in_p', 15 );

if ( ! function_exists( 'presscore_filter_categorizer_hash_arg' ) ) :

	/**
	 * Categorizer hash filter.
	 *
	 */
	function presscore_filter_categorizer_hash_arg( $args ) {
		$config = Presscore_Config::get_instance();

		$order = $config->get('order');
		$orderby = $config->get('orderby');

		$hash = add_query_arg( array('term' => '%TERM_ID%', 'orderby' => $orderby, 'order' => $order), get_permalink() );

		$args['hash'] = $hash;

		return $args;
	}

endif;

add_filter( 'presscore_get_category_list-args', 'presscore_filter_categorizer_hash_arg', 15 );


if ( ! function_exists( 'presscore_parse_query_for_front_page_categorizer' ) ) :

	/**
	 * Add exceptions for front page templates with category filter.
	 *
	 */
	function presscore_parse_query_for_front_page_categorizer( $query ) {

		if ( $query->is_main_query() && $query->is_home && 'page' == get_option('show_on_front') && get_option('page_on_front') ) {

			$_query = wp_parse_args($query->query);

			if ( empty($_query) || !array_diff( array_keys($_query), array('term', 'order', 'orderby', 'page', 'paged', 'preview', 'cpage', 'lang') ) ) {
				$query->is_page = true;
				$query->is_home = false;
				$query->is_singular = true;

				$query->query_vars['page_id'] = get_option('page_on_front');
				// Correct <!--nextpage--> for page_on_front
				if ( !empty($query->query_vars['paged']) ) {
					$query->query_vars['page'] = $query->query_vars['paged'];
				}
			}
		}

	}

endif;

add_action( 'parse_query', 'presscore_parse_query_for_front_page_categorizer' );

if ( ! function_exists( 'presscore_filter_categorizer_current_arg' ) ) :

	/**
	 * Categorizer current filter.
	 *
	 */
	function presscore_filter_categorizer_current_arg( $args ) {
		$config = Presscore_Config::get_instance();

		$display = $config->get('request_display');

		if ( !$display ) {
			return $args;
		}

		if ( 'only' == $display['select'] && !empty($display['terms_ids']) ) {
			$args['current'] = current($display['terms_ids']);
		} else if ( 'except' == $display['select'] && 0 == current($display['terms_ids']) ) {
			$args['current'] = 'none';
		}
		return $args;
	}

endif;

if ( ! function_exists( 'presscore_react_on_categorizer' ) ) :

	/**
	 * Change config, categorizer.
	 *
	 */
	function presscore_react_on_categorizer() {

		if ( !isset($_REQUEST['term'], $_REQUEST['order'], $_REQUEST['orderby']) ) {
			return;
		}

		$config = Presscore_Config::get_instance();

		// sanitize
		if ( '' == $_REQUEST['term'] ) {
			$display = array();
		} else if ( 'none' == $_REQUEST['term'] ) {
			$display = array( 'terms_ids' => array(0), 'select' => 'except' );
		} else {
			$display = array( 'terms_ids' => array( absint($_REQUEST['term']) ), 'select' => 'only' );
		}

		$order = esc_attr($_REQUEST['order']);
		if ( in_array( $order, array( 'ASC', 'asc', 'DESC', 'desc' ) ) ) {
			$config->set('order', $order);
		}

		$orderby = esc_attr($_REQUEST['orderby']);
		if ( in_array( $orderby, array( 'name', 'date' ) ) ) {
			$config->set('orderby', $orderby);
		}

		$config->set('request_display', $display);

		add_filter( 'presscore_get_category_list-args', 'presscore_filter_categorizer_current_arg', 15 );
	}

endif;

add_action('init', 'presscore_react_on_categorizer', 15);

if ( ! function_exists( 'presscore_post_navigation_controller' ) ) :

	/**
	 * Post pagination controller.
	 */
	function presscore_post_navigation_controller() {
		if ( !in_the_loop() ) {
			return;
		}

		$show_navigation = presscore_is_post_navigation_enabled();

		// show navigation
		if ( $show_navigation ) {
			presscore_post_navigation();
		}
	}

endif;

if ( ! function_exists( 'presscore_remove_post_format_classes' ) ) :

	/**
	 * Remove post format classes.
	 */
	function presscore_remove_post_format_classes( $classes = array() ) {
		global $post;

		if ( 'post' != get_post_type( $post ) ) {
			return $classes;
		}

		$post_format = get_post_format();
		if ( !$post_format ) {
			$post_format = 'standard';
		}

		return array_diff( $classes, array('format-' . $post_format) );
	}

endif;

if ( ! function_exists( 'presscore_add_post_format_classes' ) ) :

	/**
	 * Add post format classes to post.
	 */
	function presscore_add_post_format_classes( $classes = array() ) {
		global $post;

		if ( 'post' != get_post_type( $post ) ) {
			return $classes;
		}

		$post_format_class = presscore_get_post_format_class();
		if ( $post_format_class ) {
			$classes[] = $post_format_class;
		}

		return array_unique($classes);
	}

endif;

add_filter( 'post_class', 'presscore_add_post_format_classes' );

if ( ! function_exists( 'presscore_add_password_form_to_excerpts' ) ) :

	/**
	 * Add post password form to excerpts.
	 *
	 * @return string
	 */
	function presscore_add_password_form_to_excerpts( $content ) {
		if ( post_password_required() ) {
			$content = get_the_password_form();
		}

		return $content;
	}

endif;

add_filter( 'the_excerpt', 'presscore_add_password_form_to_excerpts', 99 );

if ( ! function_exists( 'presscore_excerpt_more_filter' ) ) :

	/**
	 * Replace default excerpt more to &hellip;
	 *
	 * @return string
	 */
	function presscore_excerpt_more_filter( $more ) {
	    return '&hellip;';
	}

endif;

add_filter( 'excerpt_more', 'presscore_excerpt_more_filter' );

if ( ! function_exists( 'presscore_add_more_anchor' ) ) :

	/**
	 * Add anchor #more-{$post->ID} to href.
	 *
	 * @param string $content
	 *
	 * @return string
	 */
	function presscore_add_more_anchor( $content = '' ) {
		global $post;

		if ( $post ) {
			$content = preg_replace( '/href=[\'"]?([^\'" >]+)/', ( 'href="$1#more-' . $post->ID ), $content );
		}

		// added in helpers.php:3120+
		remove_filter( 'presscore_post_details_link', 'presscore_add_more_anchor', 15 );
		return $content;
	}

endif;

if ( ! function_exists( 'presscore_return_empty_string' ) ) :

	/**
	 * Return empty string.
	 *
	 * @return string
	 */
	function presscore_return_empty_string() {
		return '';
	}

endif;

if ( ! function_exists( 'presscore_gallery_post_exclude_featured_image_from_gallery' ) ) :

	/**
	 * Attempt to exclude featured image from hovered gallery in albums.
	 * Works only in the loop.
	 */
	function presscore_gallery_post_exclude_featured_image_from_gallery( $args = array(), $default_args = array(), $options = array() ) {
		global $post;

		return $args;

		if ( in_the_loop() && get_post_meta( $post->ID, '_dt_album_options_exclude_featured_image', true ) ) {
			$args['custom'] = isset($args['custom']) ? $args['custom'] : trim(str_replace( $options['links_rel'], '', $default_args['custom'] ));
			$args['class'] = $default_args['class'] . ' ignore-feaured-image';
		}

		return $args;
	}

endif;

if ( ! function_exists( 'presscore_set_image_width_based_on_column_width' ) ) :

	/**
	 * Set image width for testimonials template and shortcode.
	 *
	 */
	function presscore_set_image_width_based_on_column_width( $args = array() ) {
		$config = Presscore_Config::get_instance();
		$target_width = $config->get('target_width');

		if ( $target_width ) {
			$args['options'] = array( 'w' => round($target_width * 1.5), 'z' => 0 );
		}

		return $args;
	}

endif;

add_filter( 'teammate_thumbnail_args', 'presscore_set_image_width_based_on_column_width', 15 );


if ( ! function_exists( 'presscore_add_preload_me_class_to_images' ) ) :

	/**
	 * Add preload-me to every image that created with dt_get_thumb_img().
	 *
	 */
	function presscore_add_preload_me_class_to_images( $args = array() ) {
		$img_class = $args['img_class'];
		
		// clear
		$img_class = str_replace('preload-me', '', $img_class);
		
		// add class
		$img_class .= ' preload-me';
		$args['img_class'] = trim( $img_class );

		return $args;
	}

endif;

add_filter( 'dt_get_thumb_img-args', 'presscore_add_preload_me_class_to_images', 15 );


if ( ! function_exists( 'presscore_before_post_testimonials_list' ) ) :

	/**
	 * Testimonials list layout post container.
	 *
	 */
	function presscore_before_post_testimonials_list() {
		echo '<div class="wf-cell wf-1">';
	}

endif;

if ( ! function_exists( 'presscore_before_post_masonry' ) ) :

	/**
	 * Add post open div for masonry layout.
	 */
	function presscore_before_post_masonry() {
		global $post;

		$config = presscore_config();
		$html_class = array( 'wf-cell' );

		// wide posts
		if ( ! $config->get( 'all_the_same_width' ) && 'wide' == $config->get( 'post.preview.width' ) ) {
			$html_class[] = 'double-width';
		}

		// masonry layout
		if ( 'masonry' == $config->get( 'layout' ) ) {
			$html_class[] = 'iso-item';
		}

		// if filter enabled
		if (
			$config->get( 'template.posts_filter.terms.enabled' ) || 
			$config->get( 'template.posts_filter.orderby.enabled' ) || 
			$config->get( 'template.posts_filter.order.enabled' )
			)
		{
			// add terms to class
			$taxonomy = apply_filters( 'presscore_before_post_masonry-filter_taxonomy', 'category', get_post_type() );
			$terms = get_the_terms( get_the_ID(), $taxonomy );
			if ( $terms && ! is_wp_error( $terms ) ) {

				foreach ( $terms as $term ) {
					$html_class[] = 'category-' . $term->term_id;
				}

			} else {
				$html_class[] = 'category-0';
			}
		}

		// data attributes for filtering
		$data_attr = array(
			'post-id'	=> get_the_ID(),
			'date'		=> esc_attr( get_the_date( 'c' ) ),
			'name'		=> esc_attr( $post->post_title )
		);
		$data_attr = apply_filters( 'presscore_before_post_masonry-wrap_data_attr', $data_attr );
		$html_class = apply_filters( 'presscore_before_post_masonry-wrap_class', $html_class );

		echo '<div class="' . presscore_esc_implode( ' ', $html_class ) . '" ' . presscore_get_inlide_data_attr( $data_attr ) . '>';
	}

endif;

if ( ! function_exists( 'presscore_after_post_masonry' ) ) :

	/**
	 * Add post close div for masonry layout.
	 */
	function presscore_after_post_masonry() {
		echo '</div>';
	}

endif;

if ( ! function_exists( 'presscore_page_masonry_controller' ) ) :

	add_action('presscore_before_loop', 'presscore_page_masonry_controller', 25);
	add_action('presscore_before_shortcode_loop', 'presscore_page_masonry_controller', 25);

	/**
	 * Page masonry controller.
	 *
	 * Filter classes used in post masonry wrap.
	 */
	function presscore_page_masonry_controller() {
		$config = Presscore_Config::get_instance();

		// add masonry wrap
		if ( in_array( $config->get('layout'), array('masonry', 'grid') ) ) {

			add_action('presscore_before_post', 'presscore_before_post_masonry', 15);
			add_action('presscore_after_post', 'presscore_after_post_masonry', 15);

		}
	}

endif;

if ( ! function_exists( 'presscore_remove_posts_masonry_wrap' ) ) :

	add_action('presscore_after_loop', 'presscore_remove_posts_masonry_wrap', 15);
	add_action('presscore_after_shortcode_loop', 'presscore_remove_posts_masonry_wrap', 15);

	/**
	 * Removes posts masonry wrap
	 *
	 * @since 5.0.0
	 */
	function presscore_remove_posts_masonry_wrap() {
		remove_action('presscore_before_post', 'presscore_before_post_masonry', 15);
		remove_action('presscore_after_post', 'presscore_after_post_masonry', 15);
	}

endif;

if ( ! function_exists( 'presscore_share_buttons_for_page_action' ) ) :

	/**
	 * Display share buttons for page templates.
	 *
	 * @since 3.1.5
	 */
	function presscore_share_buttons_for_page_action() {
		if ( is_page() ) {
			presscore_display_share_buttons_for_post( 'page' );
		}
	}

	add_action( 'presscore_after_loop', 'presscore_share_buttons_for_page_action', 30 );

endif;

if ( ! function_exists( 'presscore_add_footer_widgetarea' ) ) :

	/**
	 * Add footer widgetarea.
	 */
	function presscore_add_footer_widgetarea() {
		get_sidebar( 'footer' );
	}

endif;

add_action('presscore_after_main_container', 'presscore_add_footer_widgetarea', 15);

if ( ! function_exists( 'presscore_add_sidebar_widgetarea' ) ) :

	/**
	 * Add sidebar widgetarea.
	 */
	function presscore_add_sidebar_widgetarea() {
		get_sidebar();
	}

endif;

add_action('presscore_after_content', 'presscore_add_sidebar_widgetarea', 15);

if ( ! function_exists( 'presscore_get_page_content_before' ) ) :

	/**
	 * Display page content before.
	 * Used in presscore_page_content_controller
	 */
	function presscore_get_page_content_before() {
		if ( get_the_content() && ! post_password_required() ) {
			echo '<div class="page-info">';
			the_content();
			echo '</div>';
		}
	}

endif;

if ( ! function_exists( 'presscore_get_page_content_after' ) ) :

	/**
	 * Display page content after.
	 * Used in presscore_page_content_controller
	 */
	function presscore_get_page_content_after() {
		if ( get_the_content() ) {
			echo '<div>';
			the_content();
			echo '</div>';
		}
	}

endif;

if ( ! function_exists( 'presscore_page_content_controller' ) ) :

	/**
	 * Show content for blog'like page templates.
	 *
	 * Uses template settings.
	 */
	function presscore_page_content_controller() {
		global $post;

		// if is not page - return
		if ( !is_page() ) {
			return;
		}

		$display_content = get_post_meta( $post->ID, '_dt_content_display',  true );

		// if content hidden - return
		if ( !$display_content || 'no' == $display_content ) {
			return;
		}

		// only for first page
		if ( 'on_first_page' == $display_content && dt_get_paged_var() > 1 ) {
			return;
		}

		$content_position = get_post_meta( $post->ID, '_dt_content_position',  true );

		if ( 'before_items' == $content_position ) {

			add_action('presscore_before_loop', 'presscore_get_page_content_before', 20);
		} else {

			add_action('presscore_after_loop', 'presscore_get_page_content_after', 20);
		}
	}

endif;

if ( ! function_exists( 'presscore_fancy_header_controller' ) ) :

	/**
	 * Fancy header controller.
	 *
	 */
	function presscore_fancy_header_controller() {
		$config = Presscore_Config::get_instance();

		if ( 'fancy' != $config->get('header_title') ) {
			return;
		}

		/////////////
		// title //
		/////////////

		$title = '';

		// TODO apply 'the_title' filter here
		$custom_title = ( 'generic' == $config->get('fancy_header.title.mode') ) ? presscore_get_page_title() : $config->get('fancy_header.title');
		if ( $custom_title ) {

			$title_class = presscore_get_font_size_class( $config->get('fancy_header.title.font.size') );
			if ( 'accent' == $config->get('fancy_header.title.color.mode') ) {
				$title_class .= ' color-accent';
			}

			$title_style = '';
			if ( 'color' == $config->get('fancy_header.title.color.mode') ) {
				$title_style = ' style="color: ' . esc_attr( $config->get('fancy_header.title.color') ) . '"';
			}

			$custom_title = '<h1 class="fancy-title entry-title ' . $title_class . '"' . $title_style . '><span>' . strip_tags( $custom_title ) . '</span></h1>';

			$title .= apply_filters( 'presscore_page_title', $custom_title );

		}

		////////////////
		// subtitle //
		////////////////

		// TODO apply 'the_title' filter here
		$sybtitle = $config->get( 'fancy_header.subtitle' );
		if ( $sybtitle ) {

			$subtitle_class = presscore_get_font_size_class( $config->get('fancy_header.subtitle.font.size') );
			if ( 'accent' == $config->get('fancy_header.subtitle.color.mode') ) {
				$subtitle_class .= ' color-accent';
			}

			$title .= sprintf( '<h2 class="fancy-subtitle %s"', $subtitle_class );

			if ( 'color' == $config->get('fancy_header.subtitle.color.mode') ) {
				$title .= ' style="color: ' . esc_attr( $config->get('fancy_header.subtitle.color') ) . '"';
			}

			$title .= '><span>' . strip_tags( $sybtitle ) . '</span></h2>'; 

		}

		// container class
		$container_classes = array( 'fancy-header' );

		if ( $title ) {
			$title = '<div class="wf-td hgroup">' . $title . '</div>';

		// if title and subtitle empty
		} else {
			$container_classes[] = 'titles-off';

		}

		//////////////////
		// bredcrumbs //
		//////////////////

		$breadcrumbs = '';
		if ( 'enabled' == $config->get( 'fancy_header.breadcrumbs' ) ) {

			$breadcrumbs_args = array(
				'beforeBreadcrumbs' => '<div class="wf-td">',
				'afterBreadcrumbs' => '</div>'
			);

			$breadcrumbs_class = 'breadcrumbs text-small';

			switch ( $config->get( 'fancy_header.breadcrumbs.bg_color' ) ) {
				case 'black':
					$breadcrumbs_class .= ' bg-dark breadcrumbs-bg';
					break;

				case 'white':
					$breadcrumbs_class .= ' bg-light breadcrumbs-bg';
					break;
			}

			$breadcrumbs_args['listAttr'] = ' class="' . $breadcrumbs_class . '"';

			$breadcrumbs_text_color = $config->get( 'fancy_header.breadcrumbs.text_color' );
			if ( $breadcrumbs_text_color ) {
				$breadcrumbs_args['listAttr'] .= ' style="color: ' . $breadcrumbs_text_color . ';"';
			}

			$breadcrumbs = presscore_get_breadcrumbs( $breadcrumbs_args );

		} else {
			$container_classes[] = 'breadcrumbs-off';

		}

		/////////////////
		// container //
		/////////////////

		$content = $title . $breadcrumbs;
		switch ( $config->get('fancy_header.title.aligment') ) {
			case 'center': $container_classes[] = 'title-center'; break;
			case 'right':
				$container_classes[] = 'title-right';
				$content = $breadcrumbs . $title;
				break;
			case 'all_left':
				$container_classes[] = 'content-left';
				break;
			case 'all_right':
				$container_classes[] = 'content-right';
				break;
			default: $container_classes[] = 'title-left';
		}

		////////////////
		// parallax //
		////////////////

		$data_attr = array();
		$parallax_speed = $config->get('fancy_header.parallax.speed');
		if ( $parallax_speed ) {
			$container_classes[] = 'fancy-parallax-bg';

			$data_attr[] = 'data-prlx-speed="' . $parallax_speed . '"';
		}

		///////////////////////
		// container style //
		///////////////////////

		$container_style = array();
		if ( $config->get('fancy_header.bg.color') ) {
			$container_style[] = 'background-color: ' . $config->get('fancy_header.bg.color');
		}

		if ( $config->get('fancy_header.bg.image') ) {

			$image_meta = wp_get_attachment_image_src( current($config->get('fancy_header.bg.image')), 'full' );
			if ( $image_meta ) {

				if ( $config->get('fancy_header.bg.fullscreen') ) {

					$bg_size = 'cover';
					$repeat = 'no-repeat';

				} else {

					$bg_size = 'auto auto';
					$repeat = $config->get('fancy_header.bg.repeat');

				}

				$container_style[] = "background-size: {$bg_size}";
				$container_style[] = "background-repeat: {$repeat}";
				$container_style[] = "background-image: url({$image_meta[0]})";

				$position_x = $config->get('fancy_header.bg.position.x');
				$position_y = $config->get('fancy_header.bg.position.y');
				$container_style[] = "background-position: {$position_x} {$position_y}";

				if ( $config->get('fancy_header.bg.fixed') ) {

					$container_style[] = 'background-attachment: fixed';

				}

			}

		}

		/////////////////////
		// header height //
		/////////////////////

		$min_h_height = ' style="min-height: ' . $config->get('fancy_header.height') . 'px;"';
		$wf_table_height = ' style="height: ' . $config->get('fancy_header.height') . 'px;"';
		$container_style[] = 'min-height: ' . $config->get('fancy_header.height') . 'px';

		//////////////
		// output //
		//////////////

		printf(
			'<header id="fancy-header" class="%1$s" style="%2$s" %3$s>
			<div class="wf-wrap">
				<div class="wf-table"%5$s>%4$s</div>
			</div>
			</header>',
			esc_attr( implode( ' ', $container_classes ) ),
			esc_attr( implode( '; ', $container_style ) ),
			implode( ' ', $data_attr ),
			$content,
			$wf_table_height,
			$min_h_height
		);
	}

endif;

add_action('presscore_before_main_container', 'presscore_fancy_header_controller', 15);

if ( ! function_exists( 'presscore_page_title_controller' ) ) :

	function presscore_page_title_controller() {
		$config = Presscore_Config::get_instance();

		if ( ! ( $config->get( 'page_title.enabled' ) || $config->get( 'page_title.breadcrumbs.enabled' ) ) ) {
			return;
		}

		$show_page_title = ( presscore_is_post_title_enabled() && presscore_is_content_visible() );
		if ( ! $show_page_title ) {
			return;
		}

		$page_title_wrap_attrs = '';

		$parallax_speed = $config->get( 'page_title.background.parallax_speed' );
		if ( $parallax_speed ) {
			$page_title_wrap_attrs .= ' data-prlx-speed="' . $parallax_speed . '"';
		}

		$title_height = absint( $config->get( 'page_title.height' ) );
		$page_title_wrap_attrs .= ' style="min-height: ' . $title_height . 'px;"';

		$page_title_wrap_table_style = ' style="height: ' . $title_height . 'px;"';

		?>

		<div <?php echo presscore_get_page_title_wrap_html_class( 'page-title' ), $page_title_wrap_attrs; ?>>
			<div class="wf-wrap">
				<div class="wf-container-title">
					<div class="wf-table"<?php echo $page_title_wrap_table_style; ?>>

						<?php
						// get page title
						if ( $config->get( 'page_title.enabled' ) ) {
							$page_title = '<div class="wf-td hgroup"><h1 ' . presscore_get_page_title_html_class() . '>' . presscore_get_page_title() . '</h1></div>';
						} else {
							$page_title = '';
						}
						$page_title = apply_filters( 'presscore_page_title', $page_title );

						// get breadcrumbs
						if ( $config->get( 'page_title.breadcrumbs.enabled' ) ) {
							$breadcrumbs = presscore_get_page_title_breadcrumbs();
						} else {
							$breadcrumbs = '';
						}

						// output
						if ( 'right' == $config->get( 'page_title.align' ) ) {
							echo $breadcrumbs, $page_title;
						} else {
							echo $page_title, $breadcrumbs;
						}
						?>

					</div>
				</div>
			</div>
		</div>

		<?php

	}

endif;
add_action('presscore_before_main_container', 'presscore_page_title_controller', 16);


if ( ! function_exists( 'presscore_before_comment_form' ) ) :

	function presscore_before_comment_form() { ?>

		<div class="dt-fancy-separator title-left fancy-comments-form">
			<div class="dt-fancy-title"><?php _e( 'Leave Comment', 'the7mk2' ); ?><span class="separator-holder separator-right"></span></div>
		</div>

	<?php }

endif;
add_action( 'comment_form_before', 'presscore_before_comment_form' );


if ( ! function_exists( 'presscore_post_class_filter' ) ) :

	/**
	 * Add post format classes to post.
	 */
	function presscore_post_class_filter( $classes = array() ) {
		$config = Presscore_Config::get_instance();

		$is_archive = is_search() || is_archive();

		// post preview width
		if ( !$is_archive && 'wide' == $config->get( 'post.preview.width' ) ) {
			$classes[] = 'media-wide';
		}

		// post preview background
		if ( $config->get( 'post.preview.background.enabled' ) ) {
			$classes[] = 'bg-on';
		}

		$current_layout_type = presscore_get_current_layout_type();

		// only for layouts from masonry family
		if ( 'masonry' == $current_layout_type ) {

			// fullwidth preview background
			if ( $config->get( 'post.preview.background.enabled' ) && 'fullwidth' == $config->get( 'post.preview.background.style' ) ) {
				$classes[] = 'fullwidth-img';
			}

			if ( ! $config->get( 'post.media.library' ) && ! has_post_thumbnail() ) {
				$classes[] = 'no-img';
			}

			// preview content alignment
			if ( 'center' == $config->get( 'post.preview.description.alignment' ) ) {
				$classes[] = 'text-centered';
			}

		}

		if ( ! $config->get( 'post.preview.content.visible' ) ) {
			$classes[] = 'description-off';
		}

		if ( is_single() ) {

			$hentry_key = array_search( 'hentry', $classes );
			if ( $hentry_key !== false ) {
				unset( $classes[ $hentry_key ] );
			}

		}

		return $classes;
	}

endif;

add_filter( 'post_class', 'presscore_post_class_filter' );

if ( ! function_exists( 'presscore_add_sorting_for_category_list' ) ) :

	/**
	 * Add sorting fields to category list.
	 */
	function presscore_add_sorting_for_category_list( $html ) {
		return $html . presscore_get_categorizer_sorting_fields();
	}

endif;

add_filter( 'presscore_get_category_list', 'presscore_add_sorting_for_category_list', 15 );

if ( ! function_exists( 'presscore_add_wrap_for_catgorizer' ) ) :

	/**
	 * Categorizer wrap.
	 *
	 */
	function presscore_add_wrap_for_catgorizer( $html, $args ) {
		if ( $html ) {

			// get class or use default one
			$class = empty($args['class']) ? 'filter' : $args['class'];

			// wrap categorizer
			$html = '<div class="' . esc_attr($class) . '">' . $html . '</div>';
		}

		return $html;
	}

endif;

add_filter( 'presscore_get_category_list', 'presscore_add_wrap_for_catgorizer', 16, 2 );

if ( ! function_exists( 'presscore_add_thumbnail_class_for_masonry' ) ) :

	/**
	 * Add proportions to images.
	 *
	 * @return array.
	 */
	function presscore_add_thumbnail_class_for_masonry( $args = array() ) {
		$config = Presscore_Config::get_instance();
		$thumb_proportions = $config->get('thumb_proportions');

		if ( 'resize' == $config->get('image_layout') && $thumb_proportions ) {

			if ( is_array($thumb_proportions) ) {
				$width = ($thumb_proportions['width'] > 0) ? absint($thumb_proportions['width']) : 1;
				$height = ($thumb_proportions['height'] > 0) ? absint($thumb_proportions['height']) : 1;

				$args['prop'] = $width / $height;
			} else {
				$args['prop'] = presscore_meta_boxes_get_images_proportions( $thumb_proportions );
			}

		}

		return $args;
	}

endif;

add_filter( 'dt_portfolio_thumbnail_args', 'presscore_add_thumbnail_class_for_masonry', 15 );
add_filter( 'dt_post_thumbnail_args', 'presscore_add_thumbnail_class_for_masonry', 15 );
add_filter( 'dt_album_title_image_args', 'presscore_add_thumbnail_class_for_masonry', 15 );
add_filter( 'dt_media_image_args', 'presscore_add_thumbnail_class_for_masonry', 15 );
add_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_add_thumbnail_class_for_masonry', 15 );

if ( ! function_exists( 'presscore_render_fullscreen_overlay' ) ) :

	/**
	 * Renders fullscreen overlay.
	 */
	function presscore_render_fullscreen_overlay() {
		if ( presscore_config()->get_bool( 'template.beautiful_loading.enabled' ) ) {

			$tpl_args = array();
			switch( presscore_config()->get( 'template.beautiful_loading.loadr.style' ) ) {
				case 'square_jelly_box':
					$tpl_args['load_class'] = 'ring-loader';
					break;
				case 'ball_elastic_dots':
					$tpl_args['load_class'] = 'hourglass-loader';
					break;
				case 'custom':
					$tpl_args['loader_code'] = presscore_config()->get( 'template.beautiful_loading.loadr.custom_code' );
					break;
				default:
					$tpl_args['load_class'] = 'spinner-loader';
			}

			presscore_get_template_part( 'theme', 'loader', null, $tpl_args );

		}
	}

	add_action( 'presscore_body_top', 'presscore_render_fullscreen_overlay' );

endif;

if ( ! function_exists( 'presscore_slideshow_controller' ) ) :

	/**
	 * Slideshow controller.
	 *
	 */
	function presscore_slideshow_controller() {
		global $post;
		$config = Presscore_Config::get_instance();

		if ( 'slideshow' != $config->get('header_title') ){
			return;
		}

		// turn off regular titles and breadcrumbs
		remove_action('presscore_before_main_container', 'presscore_page_title_controller', 16);

		if ( dt_get_paged_var() > 1 ) {
			return;
		}

		switch ( $config->get('slideshow_mode') ) {

			case 'revolution':
				$rev_slider = $config->get('slideshow_revolution_slider');

				if ( $rev_slider && function_exists('putRevSlider') ) {

					echo '<div id="main-slideshow">';
					putRevSlider( $rev_slider );
					echo '</div>';
				}
				break;

			case 'layer':
				$layer_slider = $config->get('slideshow_layer_slider');
				$layer_bg_and_paddings = $config->get('slideshow_layer_bg_and_paddings');

				if ( $layer_slider && function_exists('layerslider') ) {

					echo '<div id="main-slideshow"' . ( $layer_bg_and_paddings ? ' class="layer-fixed"' : '' ) . '>';
					layerslider( $layer_slider );
					echo '</div>';
				}

		} // switch

		do_action( 'presscore_do_header_slideshow', $config->get( 'slideshow_mode' ) );
	}
	add_action('presscore_before_main_container', 'presscore_slideshow_controller', 15);

endif;

if ( ! function_exists( 'presscore_remove_wp_site_icon' ) ) :

	/**
	 * Remove wp_site_icon hook if favicons set in theme options.
	 * @since 2.3.1
	 */
	function presscore_remove_wp_site_icon() {
		if ( presscore_get_favicon() || presscore_get_device_icons() ) {
			remove_action( 'wp_head', 'wp_site_icon', 99 );
		}
	}

	add_action( 'init', 'presscore_remove_wp_site_icon' );

endif;

if ( ! function_exists( 'presscore_site_icon' ) ) :

	/**
	 * Display site icon.
	 *
	 * @since 2.2.1
	 */
	function presscore_site_icon() {
		if ( is_customize_preview() ) {
			return;
		}

		// display favicon
		echo presscore_get_favicon();

		$meta_tags = presscore_get_device_icons();

		foreach ( $meta_tags as $meta_tag ) {
			echo "$meta_tag\n";
		}
	}

	add_action( 'wp_head', 'presscore_site_icon', 99 );

endif;

if ( ! function_exists( 'presscore_update_post_thumbnail_cache' ) ) :

	/**
	 * Update post thumbnail cache for $query.
	 *
	 * @param  WP_Query $query
	 */
	function presscore_update_post_thumbnail_cache( $query ) {
		if ( $query->have_posts() ) {
			update_post_thumbnail_cache( $query );
		}
	}

	add_action( 'presscore_get_filtered_posts', 'presscore_update_post_thumbnail_cache' );

endif;

if ( ! function_exists( 'presscore_empty_top_bar_microwidgets_exception_filter' ) ) :

	function presscore_empty_top_bar_microwidgets_exception_filter( $elements ) {
		if ( ! $elements ) {
			$elements = array( 'dummy_element' );
		}
		return $elements;
	}

	add_filter( 'presscore_get_header_elements_list-top_bar_left', 'presscore_empty_top_bar_microwidgets_exception_filter' );

endif;

if ( ! function_exists( 'presscore_empty_classic_header_microwidgets_exception_filter' ) ) :

	/**
	 * Render empty microwidgets wrap if there is no elements near logo for classic layout.
	 *
	 * @since 3.0.0
	 *
	 * @param  array $elements
	 * @return array
	 */
	function presscore_empty_classic_header_microwidgets_exception_filter( $elements ) {
		if ( ! $elements && 'classic' == presscore_config()->get( 'header.layout' ) ) {
			$elements = array( 'dummy_element' );
		}
		return $elements;
	}

	add_filter( 'presscore_get_header_elements_list-near_logo_left', 'presscore_empty_classic_header_microwidgets_exception_filter' );
	add_filter( 'presscore_get_header_elements_list-near_logo_right', 'presscore_empty_classic_header_microwidgets_exception_filter' );

endif;

if ( ! function_exists( 'presscore_empty_top_line_microwidgets_exception_filter' ) ) :

	/**
	 * Render empty microwidgets wrap if there is no elements in top bar for "on click" haders.
	 *
	 * @since 3.0.0
	 *
	 * @param  array $elements
	 * @return array
	 */
	function presscore_empty_top_line_microwidgets_exception_filter( $elements ) {
		if ( ! $elements && presscore_mixed_header_with_top_line() ) {
			$elements = array( 'dummy_element' );
		}
		return $elements;
	}

	add_filter( 'presscore_get_header_elements_list-side_top_line', 'presscore_empty_top_line_microwidgets_exception_filter' );

endif;

if ( ! function_exists( 'presscore_add_srcsets' ) ) :

	/**
	 * Add srcsest attribute for post thumbnails.
	 *
	 * @todo  Remove
	 * 
	 * @param  array  $args
	 * @return array
	 */
	function presscore_add_srcsets( $args = array() ) {
		if ( ! empty( $args['options'] ) ) {
			$args['options']['use_srcset'] = true;
		}

		return $args;
	}

	// add_filter( 'dt_get_thumb_img-args', 'presscore_add_srcsets' );

endif;

if ( ! function_exists( 'presscore_add_images_lazy_loading' ) ) :

	/**
	 * Add lazy loading capabilities to images.
	 *
	 * @param  array  $args
	 * @return array
	 */
	function presscore_add_images_lazy_loading( $args = array() ) {
		if ( presscore_lazy_loading_enabled() ) {
			$args['lazy_loading'] = true;
			$layzr_class = 'lazy-load';
			$args['img_class'] = ( isset( $args['img_class'] ) ? $args['img_class'] . " {$layzr_class}" : $layzr_class );
			$layzr_bg_class = 'layzr-bg';
			$args['class'] = ( isset( $args['class'] ) ? $args['class'] . " {$layzr_bg_class}" : $layzr_bg_class );
		}

		return $args;
	}

endif;

if ( ! function_exists( 'presscore_add_lazy_load_attrs' ) ) :

	function presscore_add_lazy_load_attrs() {
		if ( ! has_filter( 'dt_get_thumb_img-args', 'presscore_add_images_lazy_loading' ) ) {
			add_filter( 'dt_get_thumb_img-args', 'presscore_add_images_lazy_loading' );
		}
	}

	presscore_add_lazy_load_attrs();

endif;

if ( ! function_exists( 'presscore_remove_lazy_load_attrs' ) ) :

	function presscore_remove_lazy_load_attrs() {
		remove_filter( 'dt_get_thumb_img-args', 'presscore_add_images_lazy_loading' );
	}

endif;

if ( ! function_exists( 'presscore_add_masonry_lazy_load_attrs' ) ) :

	/**
	 * Add lazy loading images attributes.
	 */
	function presscore_add_masonry_lazy_load_attrs() {
		if ( ! has_filter( 'dt_get_thumb_img-output', 'presscore_masonry_lazy_loading' ) ) {
			add_filter( 'dt_get_thumb_img-output', 'presscore_masonry_lazy_loading', 10, 2 );
		}
	}

	add_action( 'presscore_before_loop', 'presscore_add_masonry_lazy_load_attrs' );
	add_action( 'presscore_before_shortcode_loop', 'presscore_add_masonry_lazy_load_attrs' );

endif;

if ( ! function_exists( 'presscore_remove_masonry_lazy_load_attrs' ) ) :

	/**
	 * Remove lazy loading images attributes.
	 */
	function presscore_remove_masonry_lazy_load_attrs() {
		remove_filter( 'dt_get_thumb_img-output', 'presscore_masonry_lazy_loading', 10, 2 );
	}

	add_action( 'presscore_after_loop', 'presscore_remove_masonry_lazy_load_attrs' );
	add_action( 'presscore_after_shortcode_loop', 'presscore_remove_masonry_lazy_load_attrs' );

endif;

if ( ! function_exists( 'presscore_masonry_lazy_loading' ) ) :

	/**
	 * Custom layzr attribute for masonry layout.
	 *
	 * @since 3.3.0
	 *
	 * @param  string $output
	 * @param  array $args
	 * @return string
	 */
	function presscore_masonry_lazy_loading( $output = '', $args = array() ) {
		$config = presscore_config();
		if ( ! empty( $args['lazy_loading'] ) && ! $config->get( 'is_scroller' ) ) {
			if ( $config->get( 'justified_grid' ) ) {
				$output = str_replace( 'lazy-load', 'jgrid-lazy-load', $output );
			} elseif ( in_array( $config->get( 'layout' ), array( 'masonry', 'grid' ) ) ) {
				$output = str_replace( 'lazy-load', 'iso-lazy-load', $output );
			}
		}
		return $output;
	}

endif;

if ( ! function_exists( 'presscore_is_srcset_based_retina' ) ) :

	/**
	 * Determine that srcset based retina images is active.
	 *
	 * @todo  Remove
	 *
	 * @return boolean
	 */
	function presscore_is_srcset_based_retina() {
		return true;
	}

endif;

if ( ! function_exists( 'presscore_is_logos_only_retina' ) ) :

	/**
	 * Determine that retina images used only for logos.
	 *
	 * @todo Remove
	 *
	 * @return boolean
	 */
	function presscore_is_logos_only_retina() {
		return false;
	}

endif;
