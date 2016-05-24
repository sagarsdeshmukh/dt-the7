<?php
/**
 * Photos scroller shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Photos_Scroller', false ) ) {

	class DT_Shortcode_Photos_Scroller extends DT_Shortcode {

		protected $shortcode_name = 'dt_small_photos';
		protected $post_type = 'dt_gallery';
		protected $taxonomy = 'dt_gallery_category';
		protected $atts = array();
		protected $config = null;

		public function __construct() {
			$this->config = presscore_get_config();
		}

		public function shortcode( $atts, $content = null ) {
			$attributes = $this->atts = $this->sanitize_attributes( $atts );

			// vc inline dummy
			if ( presscore_vc_is_inline() ) {
				$terms_title = _x( 'Display categories', 'vc inline dummy', 'the7mk2' );
				$terms_list = presscore_get_terms_list_by_slug( array( 'slugs' => $attributes['category'], 'taxonomy' => $this->taxonomy ) );

				return $this->vc_inline_dummy( array(
					'class' => 'dt_vc-photos_scroller',
					'title' => _x( 'Photos scroller', 'vc inline dummy', 'the7mk2' ),
					'fields' => array( $terms_title => $terms_list )
				) );
			}

			$output = '';

			$dt_query = $this->get_albums_attachments( array(
				'orderby' => $attributes['orderby'],
				'order' => 'DESC',
				'number' => $attributes['number'],
				'select' => $attributes['select'],
				'category' => $attributes['category']
			) );

			if ( $dt_query->have_posts() ) {

				$this->backup_post_object();
				$this->backup_theme_config();
				$this->setup_config();
				$this->add_hooks();

				ob_start();

				// loop
				while( $dt_query->have_posts() ) { $dt_query->the_post();
					echo '<li class="fs-entry">';

					presscore_get_template_part( 'mod_albums', 'photo-masonry/photo' );

					echo '</li>';
				}

				$posts_html = ob_get_contents();
				ob_end_clean();

				// shape output
				$output = '<div ' . $this->get_container_html_class( array( 'dt-photos-shortcode', 'slider-wrapper', 'shortcode-instagram', 'dt-gallery-container' ) ) . ' ' . $this->get_container_data_atts() . presscore_get_share_buttons_for_prettyphoto( 'photo' ) . '>';
				$output .= '<div class="frame fullwidth-slider"><ul class="clearfix">' . $posts_html . '</ul></div>';
				if ( $attributes['arrows'] ) {
					$output .= '<div class="prev"><i></i></div><div class="next"><i></i></div>';
				}
				$output .= '</div>';

				// cleanup
				$this->remove_hooks();
				$this->restore_theme_config();
				$this->restore_post_object();

			}

			return $output;
		}

		public function set_image_dimensions( $args ) {
			$args['options'] = array( 'w' => $this->atts['width'], 'h' => $this->atts['height'] );
			$args['prop'] = false;
			return $args;
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
				'padding' => '20',
				'show_title' => '',
				'show_excerpt' => '',
				'number' => '12',
				'orderby' => 'recent',
				'autoslide' => '',
				'loop' => '',
				'arrows' => 'light',
				'width' => '0',
				'height' => '210',
			);

			$attributes = shortcode_atts( $default_atts, $atts );

			// sanitize attributes
			$attributes['orderby'] = ( 'recent' == $attributes['orderby'] ? 'date' : 'rand' );
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);

			$attributes['show_title'] = apply_filters('dt_sanitize_flag', $attributes['show_title']);
			$attributes['show_excerpt'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpt']);
			$attributes['loop'] = apply_filters('dt_sanitize_flag', $attributes['loop']);

			$attributes['arrows'] = sanitize_key( $attributes['arrows'] );

			$attributes['width'] = absint($attributes['width']);
			$attributes['height'] = absint($attributes['height']);
			$attributes['padding'] = absint($attributes['padding']);
			$attributes['autoslide'] = absint($attributes['autoslide']);

			if ( $attributes['category'] ) {
				$attributes['category'] = presscore_sanitize_explode_string( $attributes['category'] );
				$attributes['select'] = 'only';
			} else {
				$attributes['select'] = 'all';
			}

			return $attributes;
		}

		protected function setup_config() {
			$config = &$this->config;
			$attributes = &$this->atts;

			$config->set( 'template', 'media' );
			$config->set( 'layout', 'grid' );
			$config->set( 'load_style', 'default' );
			$config->set( 'image_layout', 'original' );
			$config->set( 'justified_grid', false );
			$config->set( 'thumb_proportions', false );
			$config->set( 'template.columns.number', false );
			$config->set( 'post.preview.load.effect', false );

			$config->set( 'item_padding', $attributes['padding'] );
			$config->set( 'show_excerpts', $attributes['show_excerpt'] );
			$config->set( 'show_titles', $attributes['show_title'] );

			$content_visible = $attributes['show_title'] || $attributes['show_excerpt'];

			$config->set( 'post.preview.content.visible', $content_visible );
			$config->set( 'post.preview.description.style', ( $content_visible ? 'on_hoover_centered' : 'disabled' ) );
			$config->set( 'post.preview.width.min', $attributes['width'] );
		}

		protected function get_container_html_class( $class = array() ) {
			$attributes = &$this->atts;

			switch ( $attributes['arrows'] ) {
				case 'light':
					$class[] = 'arrows-light';
					break;
				case 'dark':
					$class[] = 'arrows-dark';
					break;
				case 'rectangular_accent':
					$class[] = 'arrows-accent';
					break;
			}

			$html_class = presscore_masonry_container_class( $class );
			$html_class = str_replace( array( ' iso-grid', 'iso-grid ', ' loading-effect-fade-in', 'loading-effect-fade-in ' ), '', $html_class );

			return $html_class;
		}

		protected function get_container_data_atts() {
			return presscore_get_inlide_data_attr( array(
				'padding-side' => $this->atts['padding'],
				'autoslide' => $this->atts['autoslide'] ? 'true' : 'false',
				'delay' => $this->atts['autoslide'],
				'loop' => $this->atts['loop'] ? 'true' : 'false'
			) );
		}

		protected function add_hooks() {
			add_filter( 'dt_get_thumb_img-args', array( &$this, 'set_image_dimensions' ) );
		}

		protected function remove_hooks() {
			remove_filter( 'dt_get_thumb_img-args', array( &$this, 'set_image_dimensions' ) );
		}

	}

	add_shortcode( 'dt_small_photos', array( new DT_Shortcode_Photos_Scroller(), 'shortcode' ) );
}
