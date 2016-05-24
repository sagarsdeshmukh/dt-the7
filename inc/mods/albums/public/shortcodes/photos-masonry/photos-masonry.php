<?php
/**
 * Photos masonry shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Photos_Masonry', false ) ) {

	class DT_Shortcode_Photos_Masonry extends DT_Masonry_Posts_Shortcode {

		protected $shortcode_name = 'dt_photos_masonry';
		protected $post_type = 'dt_gallery';
		protected $taxonomy = 'dt_gallery_category';

		public function shortcode( $atts, $content = null ) {
			parent::setup( $atts, $content );

			// vc inline dummy
			if ( $this->vc_is_inline ) {
				$terms_title = _x( 'Display categories', 'vc inline dummy', 'the7mk2' );

				return $this->vc_inline_dummy( array(
					'class' => 'dt_vc-photos_masonry',
					'title' => _x( 'Photos masonry', 'vc inline dummy', 'the7mk2' ),
					'fields' => array(
						$terms_title => presscore_get_terms_list_by_slug( array( 'slugs' => $this->atts['category'], 'taxonomy' => $this->taxonomy ) )
					)
				) );
			}

			return $this->shortcode_html();
		}

		protected function shortcode_html() {

			$dt_query = $this->get_albums_attachments( array(
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

				ob_start();

				do_action( 'presscore_before_shortcode_loop', $this->shortcode_name, $this->atts );

				// masonry container open
				echo '<div ' . presscore_masonry_container_class( array( 'wf-container', 'dt-gallery-container', 'dt-photos-shortcode' ) ) . presscore_masonry_container_data_atts() . presscore_get_share_buttons_for_prettyphoto( 'photo' ) . '>';

					while( $dt_query->have_posts() ) { $dt_query->the_post();

						presscore_get_template_part( 'mod_albums', 'photo-masonry/photo' );

					}

				// masonry container close
				echo '</div>';

				do_action( 'presscore_after_shortcode_loop', $this->shortcode_name, $this->atts );

				$output = ob_get_contents();
				ob_end_clean();

				// cleanup
				$this->restore_theme_config();
				$this->restore_post_object();

			}

			return $output;
		}

		protected function get_albums_attachments( $args = array() ) {
			$defaults = array(
				'orderby' => 'date',
				'order' => 'DESC',
				'number' => false,
				'category' => array(),
				'select' => 'all'
			);

			$args = wp_parse_args( $args, $defaults );

			$page_query = $this->get_posts_by_terms( $args );

			$media_items = array(0);
			if ( $page_query->have_posts() ) {
				$media_items = array();
				foreach ( $page_query->posts as $gallery ) {
					$gallery_media = get_post_meta( $gallery->ID, '_dt_album_media_items', true );
					if ( is_array( $gallery_media ) ) {
						$media_items = array_merge( $media_items, $gallery_media );
					}
				}
			}

			$media_items = array_unique( $media_items );

			$media_args = array(
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'post_status' => 'inherit',
				'post__in' => $media_items,
				'orderby' => 'post__in',
			);

			if ( $args['number'] ) {
				$media_args['posts_per_page'] = intval( $args['number'] );
			}

			return new WP_Query( $media_args );
		}

		protected function sanitize_attributes( &$atts ) {
			$default_atts = array(
				'category' => '',
				'type' => 'masonry',
				'padding' => '20',
				'column_width' => '370',
				'columns' => '2',
				'proportion' => '',
				'loading_effect' => 'none',
				'show_title' => '',
				'show_excerpt' => '',
				'number' => '12',
				'order' => 'desc',
				'orderby' => 'date',
			);

			$attributes = shortcode_atts( $default_atts, $atts );

			// sanitize attributes
			$attributes['type'] = sanitize_key( $attributes['type'] );
			$attributes['loading_effect'] = sanitize_key( $attributes['loading_effect'] );

			$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
			$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);

			$attributes['show_title'] = apply_filters('dt_sanitize_flag', $attributes['show_title']);
			$attributes['show_excerpt'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpt']);

			$attributes['columns'] = absint($attributes['columns']);
			$attributes['column_width'] = absint($attributes['column_width']);
			$attributes['padding'] = intval($attributes['padding']);

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

			$config->set( 'template', 'media' );
			$config->set( 'layout', 'masonry' );
			$config->set( 'load_style', 'default' );
			$config->set( 'justified_grid', false );
			$config->set( 'full_width', false );

			$config->set( 'item_padding', $atts['padding'] );
			$config->set( 'image_layout', $atts['proportion'] ? 'resize' : 'original' );
			$config->set( 'thumb_proportions', $atts['proportion'] );
			$config->set( 'show_excerpts', $atts['show_excerpt'] );
			$config->set( 'show_titles', $atts['show_title'] );

			$content_visible = $atts['show_title'] || $atts['show_excerpt'];

			$config->set( 'post.preview.content.visible', $content_visible );
			$config->set( 'post.preview.description.style', ( $content_visible ? 'under_image' : 'disabled' ) );
			$config->set( 'post.preview.load.effect', $atts['loading_effect'] );
			$config->set( 'post.preview.width.min', $atts['column_width'] );
			$config->set( 'template.columns.number', $atts['columns'] );
		}

	}

	add_shortcode( 'dt_photos_masonry', array( new DT_Shortcode_Photos_Masonry(), 'shortcode' ) );
}
