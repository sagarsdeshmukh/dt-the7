<?php
/**
 * Portfolio shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Portfolio', false ) ) {

	class DT_Shortcode_Portfolio extends DT_Masonry_Posts_Shortcode {

		protected $shortcode_name = 'dt_portfolio';
		protected $post_type = 'dt_portfolio';
		protected $taxonomy = 'dt_portfolio_category';

		public function shortcode( $atts, $content = null ) {
			parent::setup( $atts, $content );

			// vc inline dummy
			if ( $this->vc_is_inline ) {
				$terms_title = _x( 'Display categories', 'vc inline dummy', 'the7mk2' );

				return $this->vc_inline_dummy( array(
					'class' => 'dt_vc-portfolio_masonry',
					'title' => _x( 'Portfolio Masonry & Grid', 'vc inline dummy', 'the7mk2' ),
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
					'masonry_container_class'	=> array( 'wf-container', 'dt-portfolio-shortcode' ),
					'post_template_callback'	=> array( $this, 'post_template' ),
					'query'						=> $dt_query,
					'full_width'				=> $this->atts['full_width'],
					'select'					=> $this->atts['select'],
					'show_filter'				=> $this->atts['show_filter'],
					'posts_per_page'			=> $this->atts['posts_per_page'],
				) );

				// cleanup
				$this->restore_theme_config();
				$this->restore_post_object();
			}

			return $output;
		}

		protected function post_template() {
			presscore_populate_portfolio_config();

			presscore_get_template_part( 'mod_portfolio', 'masonry/project' );
		}

		protected function sanitize_attributes( &$atts ) {
			$attributes = shortcode_atts( array(
				'type' => 'masonry',
				'category' => '',
				'order' => 'desc',
				'orderby' => 'date',
				'number' => '12',
				'show_title' => '',
				'show_excerpt' => '',
				'show_details' => '',
				'show_link' => '',
				'show_zoom' => '',
				'show_categories' => '',
				'show_date' => '',
				'show_author' => '',
				'show_comments' => '',
				'columns' => '2',
				'column_width' => '370',
				'padding' => '20',
				'descriptions' => 'under_image',
				'hover_bg_color' => 'accent',
				'bg_under_projects' => 'with_paddings',
				'content_aligment' => 'left',
				'colored_bg_content_aligment' => 'centre',
				'hover_animation' => 'fade',
				'bgwl_animation_effect' => '1',
				'hover_content_visibility' => 'on_hover',
				'loading_effect' => 'none',
				'proportion' => '',
				'same_width' => 'false',
				'full_width' => '',
				'show_filter' => '',
				'show_orderby' => '',
				'show_order' => '',
				'posts_per_page' => '-1'
			), $atts );

			// sanitize attributes
			$attributes['type'] = sanitize_key( $attributes['type'] );
			$attributes['loading_effect'] = sanitize_key( $attributes['loading_effect'] );

			$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
			$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);
			$attributes['posts_per_page'] = apply_filters('dt_sanitize_posts_per_page', $attributes['posts_per_page'], $attributes['number']);

			if ( $attributes['category'] ) {
				$attributes['category'] = presscore_sanitize_explode_string( $attributes['category'] );
				$attributes['select'] = 'only';
			} else {
				$attributes['select'] = 'all';
			}

			$attributes['show_title'] = apply_filters('dt_sanitize_flag', $attributes['show_title']);
			$attributes['show_excerpt'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpt']);

			$attributes['show_details'] = apply_filters('dt_sanitize_flag', $attributes['show_details']);
			$attributes['show_link'] = apply_filters('dt_sanitize_flag', $attributes['show_link']);
			$attributes['show_zoom'] = apply_filters('dt_sanitize_flag', $attributes['show_zoom']);

			$attributes['show_categories'] = apply_filters('dt_sanitize_flag', $attributes['show_categories']);
			$attributes['show_date'] = apply_filters('dt_sanitize_flag', $attributes['show_date']);
			$attributes['show_author'] = apply_filters('dt_sanitize_flag', $attributes['show_author']);
			$attributes['show_comments'] = apply_filters('dt_sanitize_flag', $attributes['show_comments']);

			$attributes['show_filter'] = apply_filters('dt_sanitize_flag', $attributes['show_filter']);
			$attributes['show_orderby'] = apply_filters('dt_sanitize_flag', $attributes['show_orderby']);
			$attributes['show_order'] = apply_filters('dt_sanitize_flag', $attributes['show_order']);

			$attributes['columns'] = absint($attributes['columns']);

			$attributes['descriptions'] = sanitize_key($attributes['descriptions']);
			$attributes['descriptions'] = str_replace('hover', 'hoover', $attributes['descriptions']);

			$attributes['hover_bg_color'] = sanitize_key($attributes['hover_bg_color']);
			$attributes['bg_under_projects'] = sanitize_key($attributes['bg_under_projects']);
			$attributes['hover_animation'] = sanitize_key($attributes['hover_animation']);
			$attributes['bgwl_animation_effect'] = sanitize_key($attributes['bgwl_animation_effect']);
			$attributes['hover_content_visibility'] = sanitize_key($attributes['hover_content_visibility']);
			$attributes['hover_content_visibility'] = str_replace('hover', 'hoover', $attributes['hover_content_visibility']);

			$attributes['content_aligment'] = in_array($attributes['content_aligment'], array('centre', 'center')) ? 'center' : 'left';
			$attributes['colored_bg_content_aligment'] = str_replace('centre', 'center', $attributes['colored_bg_content_aligment']);

			$attributes['same_width'] = apply_filters('dt_sanitize_flag', $attributes['same_width']);

			$attributes['full_width'] = apply_filters('dt_sanitize_flag', $attributes['full_width']);
			$attributes['padding'] = intval($attributes['padding']);
			$attributes['column_width'] = intval($attributes['column_width']);

			if ( $attributes['proportion'] ) {
				$wh = array_map( 'absint', explode(':', $attributes['proportion']) );
				if ( 2 == count($wh) && !empty($wh[0]) && !empty($wh[1]) ) {
					$attributes['proportion'] = array( 'width' => $wh[0], 'height' => $wh[1] );
				} else {
					$attributes['proportion'] = absint( $attributes['proportion'] );
				}
			}

			return $attributes;
		}

		protected function setup_config() {
			$config = &$this->config;
			$atts = &$this->atts;

			$config->map( array(
				'template'								=> array( 'value', 'portfolio' ),
				'load_style'							=> array( 'value', 'default' ),
				'post.preview.buttons.details.enabled'	=> array( 'value', false ),
				'post.preview.background.enabled'		=> array( 'value', false ),
				'post.preview.background.style'			=> array( 'value', false ),

				'layout'								=> array( 'value', $atts['type'] ),
				'item_padding'							=> array( 'value', $atts['padding'] ),
				'all_the_same_width'					=> array( 'value', $atts['same_width'] ),
				'post.preview.width.min'				=> array( 'value', $atts['column_width'] ),
				'template.columns.number'				=> array( 'value', $atts['columns'] ),
				'image_layout'							=> array( 'value', $atts['proportion'] ? 'resize' : 'original' ),
				'thumb_proportions'						=> array( 'value', $atts['proportion'] ),

				'show_links'							=> array( 'value', $atts['show_link'] ),
				'show_titles'							=> array( 'value', $atts['show_title'] ),
				'show_details'							=> array( 'value', $atts['show_details'] ),
				'show_excerpts'							=> array( 'value', $atts['show_excerpt'] ),
				'show_zoom'								=> array( 'value', $atts['show_zoom'] ),

				'post.preview.description.style'		=> array( 'value', $atts['descriptions'] ),

				'post.preview.hover.animation'			=> array( 'value', $atts['hover_animation'] ),
				'post.preview.hover.color'				=> array( 'value', $atts['hover_bg_color'] ),
				'post.preview.hover.content.visibility'	=> array( 'value', $atts['hover_content_visibility'] ),
				'post.preview.hover.title.visibility'	=> array( 'value', $atts['hover_content_visibility'] ),
				'post.preview.hover.lines.animation'	=> array( 'value', $atts['bgwl_animation_effect'] ),

				'post.preview.load.effect'				=> array( 'value', $atts['loading_effect'], 'fade_in' ),

				'post.meta.fields.date'					=> array( 'value', $atts['show_date'] ),
				'post.meta.fields.categories'			=> array( 'value', $atts['show_categories'] ),
				'post.meta.fields.comments'				=> array( 'value', $atts['show_comments'] ),
				'post.meta.fields.author'				=> array( 'value', $atts['show_author'] ),

				'template.posts_filter.terms.enabled'	=> array( 'value', $atts['show_filter'] ),
				'template.posts_filter.orderby.enabled'	=> array( 'value', $atts['show_orderby'] ),
				'template.posts_filter.order.enabled'	=> array( 'value', $atts['show_order'] ),

				'order'									=> array( 'value', $atts['order'] ),
				'orderby'								=> array( 'value', $atts['orderby'] ),
			) );

			// content alignment
			if ( 'on_hoover_centered' == $atts['descriptions'] ) {
				$config->set( 'post.preview.description.alignment', $atts['colored_bg_content_aligment'] );
			} else if ( 'bg_with_lines' == $atts['descriptions'] ) {
				$config->set( 'post.preview.description.alignment', false );
			} else {
				$config->set( 'post.preview.description.alignment', $atts['content_aligment'] );
			}

			// preview background
			if ( 'under_image' == $atts['descriptions'] ) {
				$config->set( 'post.preview.background.enabled', ! in_array( $atts['bg_under_projects'], array( 'disabled', '' ) ) );
				$config->set( 'post.preview.background.style', $atts['bg_under_projects'] );
			}
		}

	}

	add_shortcode( 'dt_portfolio', array( new DT_Shortcode_Portfolio(), 'shortcode' ) );
}
