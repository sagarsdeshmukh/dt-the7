<?php
/**
 * Albums justified grid shortcode
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Albums_Jgrid', false ) ) {

	class DT_Shortcode_Albums_Jgrid extends DT_Masonry_Posts_Shortcode {

		protected $shortcode_name = 'dt_albums_jgrid';
		protected $post_type = 'dt_gallery';
		protected $taxonomy = 'dt_gallery_category';

		public function shortcode( $atts, $content = null ) {
			parent::setup( $atts, $content );

			// vc inline dummy
			if ( $this->vc_is_inline ) {
				$terms_title = _x( 'Display categories', 'vc inline dummy', 'the7mk2' );

				return $this->vc_inline_dummy( array(
					'class' => 'dt_vc-albums_justified_grid',
					'title' => _x( 'Albums Justified Grid', 'vc inline dummy', 'the7mk2' ),
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
					'masonry_container_class' => array( 'wf-container', 'dt-albums-shortcode', 'jgrid-shortcode' ),
					'post_template_callback' => array( $this, 'post_template' ),
					'query' => $dt_query,
					'full_width' => $this->atts['full_width'],
					'select' => $this->atts['select'],
					'show_filter' => $this->atts['show_filter'],
					'posts_per_page' => $this->atts['posts_per_page']
				) );

				$this->restore_theme_config();
				$this->restore_post_object();

			}

			return $output;
		}

		protected function post_template() {
			presscore_populate_album_post_config();

			presscore_get_template_part( 'mod_albums', 'album-masonry/album' );
		}

		protected function sanitize_attributes( &$atts ) {
			$default_atts = array(
				'category'                    => '',
				'order'                       => 'desc',
				'orderby'                     => 'date',
				'number'                      => '12',
				'show_title'                  => '',
				'show_excerpt'                => '',
				'show_categories'             => '',
				'show_date'                   => '',
				'show_author'                 => '',
				'show_comments'               => '',
				'show_miniatures'             => '',
				'show_media_count'            => '',
				'padding'                     => '20',
				'target_height'               => '240',
				'hide_last_row'               => '',
				'descriptions'                => 'on_hover_centered',
				'hover_bg_color'              => 'accent',
				'bg_under_albums'             => 'disabled',
				'content_aligment'            => 'left',
				'colored_bg_content_aligment' => 'centre',
				'hover_animation'             => 'fade',
				'bgwl_animation_effect'       => '1',
				'hover_content_visibility'    => 'on_hover',
				'loading_effect'              => 'none',
				'proportion'                  => '',
				'full_width'                  => '',
				'show_filter'                 => '',
				'posts_per_page'              => '-1',
			);

			$attributes = shortcode_atts( $default_atts, $atts );

			// sanitize attributes
			$attributes['loading_effect'] = sanitize_key( $attributes['loading_effect'] );
			$attributes['hover_bg_color'] = sanitize_key( $attributes['hover_bg_color'] );
			$attributes['hover_animation'] = sanitize_key( $attributes['hover_animation'] );
			$attributes['bgwl_animation_effect'] = sanitize_key($attributes['bgwl_animation_effect']);

			$attributes['descriptions'] = sanitize_key( $attributes['descriptions'] );
			$attributes['descriptions'] = str_replace( 'hover', 'hoover', $attributes['descriptions'] );

			$attributes['bg_under_albums'] = sanitize_key( $attributes['bg_under_albums'] );
			$attributes['content_aligment'] = in_array( $attributes['content_aligment'], array( 'centre', 'center' ) ) ? 'center' : 'left';
			$attributes['colored_bg_content_aligment'] = str_replace('centre', 'center', $attributes['colored_bg_content_aligment']);

			$attributes['hover_content_visibility'] = sanitize_key( $attributes['hover_content_visibility'] );
			$attributes['hover_content_visibility'] = str_replace( 'hover', 'hoover', $attributes['hover_content_visibility'] );

			$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
			$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);
			$attributes['posts_per_page'] = apply_filters('dt_sanitize_posts_per_page', $attributes['posts_per_page'], $attributes['number']);

			$attributes['show_title'] = apply_filters('dt_sanitize_flag', $attributes['show_title']);
			$attributes['show_excerpt'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpt']);

			$attributes['show_categories'] = apply_filters('dt_sanitize_flag', $attributes['show_categories']);
			$attributes['show_date'] = apply_filters('dt_sanitize_flag', $attributes['show_date']);
			$attributes['show_author'] = apply_filters('dt_sanitize_flag', $attributes['show_author']);
			$attributes['show_comments'] = apply_filters('dt_sanitize_flag', $attributes['show_comments']);

			$attributes['show_filter'] = apply_filters('dt_sanitize_flag', $attributes['show_filter']);

			$attributes['show_miniatures'] = apply_filters('dt_sanitize_flag', $attributes['show_miniatures']);
			$attributes['show_miniatures'] = apply_filters('dt_sanitize_flag', $attributes['show_miniatures']);
			$attributes['show_media_count'] = apply_filters('dt_sanitize_flag', $attributes['show_media_count']);

			$attributes['full_width'] = apply_filters('dt_sanitize_flag', $attributes['full_width']);
			$attributes['hide_last_row'] = apply_filters('dt_sanitize_flag', $attributes['hide_last_row']);

			$attributes['padding'] = intval($attributes['padding']);
			$attributes['target_height'] = intval($attributes['target_height']);

			if ( $attributes['category'] ) {
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

			$config->map( array(
				'template'                                            => array( 'value', 'albums' ),
				'template.layout.type'                                => array( 'value', 'masonry' ),
				'layout'                                              => array( 'value', 'grid' ),
				'load_style'                                          => array( 'value', 'default' ),
				'justified_grid'                                      => array( 'value', true ),
				'all_the_same_width'                                  => array( 'value', true ),
				'post.preview.buttons.details.enabled'                => array( 'value', false ),
				'post.preview.background.enabled'                     => array( 'value', false ),
				'post.preview.background.style'                       => array( 'value', false ),

				'template.posts_filter.orderby.enabled'               => array( 'value', false ),
				'template.posts_filter.order.enabled'                 => array( 'value', false ),

				'hide_last_row'                                       => array( 'value', $atts['hide_last_row'] ),
				'image_layout'                                        => array( 'value', $atts['proportion'] ? 'resize' : 'original' ),
				'thumb_proportions'                                   => array( 'value', $atts['proportion'] ),
				'target_height'                                       => array( 'value', $atts['target_height'] ),
				'item_padding'                                        => array( 'value', $atts['padding'] ),

				'show_titles'                                         => array( 'value', $atts['show_title'] ),
				'show_excerpts'                                       => array( 'value', $atts['show_excerpt'] ),

				'post.preview.description.style'                      => array( 'value', $atts['descriptions'] ),

				'post.preview.hover.animation'                        => array( 'value', $atts['hover_animation'] ),
				'post.preview.hover.color'                            => array( 'value', $atts['hover_bg_color'] ),
				'post.preview.hover.content.visibility'               => array( 'value', $atts['hover_content_visibility'] ),
				'post.preview.hover.title.visibility'                 => array( 'value', $atts['hover_content_visibility'] ),
				'post.preview.hover.lines.animation'                  => array( 'value', $atts['bgwl_animation_effect'] ),

				'post.preview.load.effect'                            => array( 'value', $atts['loading_effect'] ),

				'post.meta.fields.media_number'                       => array( 'value', $atts['show_media_count'] ),
				'post.meta.fields.date'                               => array( 'value', $atts['show_date'] ),
				'post.meta.fields.categories'                         => array( 'value', $atts['show_categories'] ),
				'post.meta.fields.comments'                           => array( 'value', $atts['show_comments'] ),
				'post.meta.fields.author'                             => array( 'value', $atts['show_author'] ),
				'post.preview.mini_images.enabled'                    => array( 'value', $atts['show_miniatures'] ),

				'template.posts_filter.terms.enabled'                 => array( 'value', $atts['show_filter'] ),

				'order'                                               => array( 'value', $atts['order'] ),
				'orderby'                                             => array( 'value', $atts['orderby'] ),
			) );

			// content alignment
			if ( 'on_hoover_centered' == $atts['descriptions'] ) {
				$config->set( 'post.preview.description.alignment', $atts['colored_bg_content_aligment'] );
			} else if ( 'bg_with_lines' == $atts['descriptions'] ) {
				$config->set( 'post.preview.description.alignment', false );
			} else {
				$config->set( 'post.preview.description.alignment', $atts['content_aligment'] );
			}
		}

	}

	add_shortcode( 'dt_albums_jgrid', array( new DT_Shortcode_Albums_Jgrid(), 'shortcode' ) );
}
