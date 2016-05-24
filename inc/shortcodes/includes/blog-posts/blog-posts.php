<?php
/**
 * Blog masonry shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_BlogPosts', false ) ) {

	/**
	 * Shortcode Blog masonry class.
	 *
	 */
	class DT_Shortcode_BlogPosts extends DT_Masonry_Posts_Shortcode {

		protected $shortcode_name = 'dt_blog_posts';
		protected $post_type = 'post';
		protected $taxonomy = 'category';

		public static function get_instance() {
			static $instance = null;
			if ( null === $instance ) {
				$instance = new self();
			}
			return $instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			parent::setup( $atts, $content );

			// vc inline dummy
			if ( $this->vc_is_inline ) {
				$terms_title = _x( 'Display categories', 'vc inline dummy', 'the7mk2' );

				return $this->vc_inline_dummy( array(
					'class' => 'dt_vc-blog_masonry',
					'title' => _x( 'Blog Masonry & Grid', 'vc inline dummy', 'the7mk2' ),
					'fields' => array(
						$terms_title => presscore_get_terms_list_by_slug( array( 'slugs' => $this->atts['category'], 'taxonomy' => $this->taxonomy ) )
					)
				) );
			}

			return $this->shortcode_html();
		}

		protected function shortcode_html() {

			$dt_query = $this->get_posts_by_terms( array(
				'orderby' => $this->atts['orderby'],
				'order' => $this->atts['order'],
				'number' => $this->atts['number'],
				'select' => $this->atts['select'],
				'category' => $this->atts['category']
			) );

			$output = '';
			if ( $dt_query->have_posts() ) {

				$this->backup_post_object();
				$this->backup_theme_config();
				$this->setup_config();

				$output = $this->the_loop( array(
					'masonry_container_class' => array( 'wf-container', 'dt-blog-shortcode' ),
					'post_template_callback' => array( $this, 'post_template' ),
					'query' => $dt_query,
					'full_width' => $this->atts['full_width'],
					'select' => $this->atts['select'],
					'show_filter' => $this->atts['show_filter'],
					'posts_per_page' => $this->atts['posts_per_page']
				) );

				// cleanup
				$this->restore_theme_config();
				$this->restore_post_object();
			}

			return $output;
		}

		protected function post_template() {
			presscore_populate_post_config();

			presscore_get_template_part( 'theme', 'blog/masonry/blog-masonry-post' );
		}

		protected function sanitize_attributes( &$atts ) {
			$attributes = shortcode_atts( array(
				'type' => 'masonry',
				'category' => '',
				'order' => 'desc',
				'orderby' => 'date',
				'number' => '12',
				'proportion' => '',
				'same_width' => 'false',
				'padding' => '20',
				'column_width' => '370',
				'columns_number' => '3',
				'full_width' => '',
				'fancy_date' => '',
				'background' => 'disabled',
				'show_excerpts' => '',
				'show_read_more_button' => '',
				'loading_effect' => 'none',
				'show_post_categories' => '',
				'show_post_date' => '',
				'show_post_author' => '',
				'show_post_comments' => '',
				'show_filter' => '',
				'show_orderby' => '',
				'show_order' => '',
				'posts_per_page' => '-1'
			), $atts );

			// sanitize attributes
			$attributes['type'] = sanitize_key( $attributes['type'] );
			$attributes['background'] = sanitize_key( $attributes['background'] );
			$attributes['loading_effect'] = sanitize_key( $attributes['loading_effect'] );

			$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
			$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);
			$attributes['posts_per_page'] = apply_filters('dt_sanitize_posts_per_page', $attributes['posts_per_page'], $attributes['number']);

			$attributes['same_width'] = apply_filters('dt_sanitize_flag', $attributes['same_width']);
			$attributes['full_width'] = apply_filters('dt_sanitize_flag', $attributes['full_width']);

			$attributes['fancy_date'] = apply_filters('dt_sanitize_flag', $attributes['fancy_date']);
			$attributes['show_excerpts'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpts']);
			$attributes['show_read_more_button'] = apply_filters('dt_sanitize_flag', $attributes['show_read_more_button']);

			$attributes['show_post_categories'] = apply_filters('dt_sanitize_flag', $attributes['show_post_categories']);
			$attributes['show_post_date'] = apply_filters('dt_sanitize_flag', $attributes['show_post_date']);
			$attributes['show_post_author'] = apply_filters('dt_sanitize_flag', $attributes['show_post_author']);
			$attributes['show_post_comments'] = apply_filters('dt_sanitize_flag', $attributes['show_post_comments']);

			$attributes['show_filter'] = apply_filters('dt_sanitize_flag', $attributes['show_filter']);
			$attributes['show_orderby'] = apply_filters('dt_sanitize_flag', $attributes['show_orderby']);
			$attributes['show_order'] = apply_filters('dt_sanitize_flag', $attributes['show_order']);

			$attributes['padding'] = absint($attributes['padding']);
			$attributes['column_width'] = absint($attributes['column_width']);
			$attributes['columns_number'] = absint($attributes['columns_number']);

			if ( $attributes['category']) {
				$attributes['category'] = presscore_sanitize_explode_string( $attributes['category'] );
				$attributes['select'] = 'only';
			} else {
				$attributes['select'] = 'all';
			}

			if ( $attributes['proportion'] ) {
				$wh = array_map( 'absint', explode(':', $attributes['proportion']) );
				if ( 2 == count($wh) && !empty($wh[0]) && !empty($wh[1]) ) {
					$attributes['proportion'] = array( 'width' => $wh[0], 'height' => $wh[1] );
				} else {
					$attributes['proportion'] = '';
				}
			}

			return $attributes;
		}

		protected function setup_config() {
			$config = &$this->config;
			$atts = &$this->atts;

			$config->set( 'template', 'blog' );
			$config->set( 'load_style', 'default' );
			$config->set( 'post.preview.description.style', 'under_image' );
			$config->set( 'post.preview.description.alignment', 'left' );

			$config->set( 'layout', $atts['type'] );
			$config->set( 'all_the_same_width', $atts['same_width'] );
			$config->set( 'item_padding', $atts['padding']  );
			$config->set( 'show_excerpts', $atts['show_excerpts'] );
			$config->set( 'show_details', $atts['show_read_more_button'] );
			$config->set( 'image_layout', $atts['proportion'] ? 'resize' : 'original' );
			$config->set( 'thumb_proportions', $atts['proportion'] );

			$config->set( 'template.columns.number', $atts['columns_number'] );
			$config->set( 'post.meta.fields.date', $atts['show_post_date'] );
			$config->set( 'post.meta.fields.categories', $atts['show_post_categories'] );
			$config->set( 'post.meta.fields.comments', $atts['show_post_comments'] );
			$config->set( 'post.meta.fields.author', $atts['show_post_author'] );

			$config->set( 'post.fancy_date.enabled', $atts['fancy_date'] );
			$config->set( 'post.preview.background.enabled', $atts['background'] != 'disabled' );
			$config->set( 'post.preview.background.style',  $atts['background'] != 'disabled' ? $atts['background'] : '' );
			$config->set( 'post.preview.load.effect', $atts['loading_effect'], 'fade_in' );
			$config->set( 'post.preview.width.min', $atts['column_width'] );

			$config->set( 'template.posts_filter.terms.enabled', $atts['show_filter'] );
			$config->set( 'template.posts_filter.orderby.enabled', $atts['show_orderby'] );
			$config->set( 'template.posts_filter.order.enabled', $atts['show_order'] );
			$config->set( 'order', $atts['order'] );
			$config->set( 'orderby', $atts['orderby'] );
		}
	}

	// create shortcode
	DT_Shortcode_BlogPosts::get_instance();

}
