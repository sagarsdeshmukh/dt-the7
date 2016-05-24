<?php
/**
 * Testimonials shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Testimonials', false ) ) {

	class DT_Shortcode_Testimonials extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_testimonials';
		protected $post_type = 'dt_testimonials';
		protected $taxonomy = 'dt_testimonials_category';

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Testimonials();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {

			$attributes = $this->sanitize_attributes( $atts );

			if ( 'slider' == $attributes['type'] ) {
				$output = $this->testimonials_slider( $attributes );
			} else {
				$output = $this->testimonials_masonry( $attributes );
			}

			return $output;
		}

		protected function testimonials_masonry( $attributes = array() ) {

			if ( presscore_vc_is_inline() ) {
				$terms_list = presscore_get_terms_list_by_slug( array( 'slugs' => $attributes['category'], 'taxonomy' => $this->taxonomy ) );

				$dummy = '
					<div class="dt_vc-shortcode_dummy dt_vc-testimonials" style="height: 250px;">
						<h5>Testimonials masonry</h5>
						<p class="text-small"><strong>Display categories:</strong> ' . $terms_list . '</p>
					</div>
				';

				return $dummy;
			}

			$output = '';

			$dt_query = $this->get_posts_by_terms( $attributes );
			if ( $dt_query->have_posts() ) {

				$this->backup_post_object();
				$this->backup_theme_config();

				$this->setup_config( $attributes );

				ob_start();

				do_action( 'presscore_before_shortcode_loop', $this->shortcode_name, $attributes );

				if ( $attributes['full_width'] ) { echo '<div class="full-width-wrap">'; }

					echo '<div ' . presscore_masonry_container_class( array( 'wf-container' ) ) . presscore_masonry_container_data_atts() . '>';

						while ( $dt_query->have_posts() ) { $dt_query->the_post();
							get_template_part( 'content', 'testimonials' );
						}

					echo '</div>';

				if ( $attributes['full_width'] ) { echo '</div>'; }

				do_action( 'presscore_after_shortcode_loop', $this->shortcode_name, $attributes );

				$output = ob_get_contents();
				ob_end_clean();

				$this->restore_theme_config();
				$this->restore_post_object();

			}

			return $output;
		}

		protected function testimonials_slider( $attributes = array() ) {

			if ( presscore_vc_is_inline() ) {
				$terms_list = presscore_get_terms_list_by_slug( array( 'slugs' => $attributes['category'], 'taxonomy' => $this->taxonomy ) );

				$dummy = '
					<div class="dt_vc-shortcode_dummy dt_vc-testimonials" style="height: 250px;">
						<h5>Testimonials slider</h5>
						<p class="text-small"><strong>Display categories:</strong> ' . $terms_list . '</p>
					</div>
				';

				return $dummy;
			}

			$output = '';

			$dt_query = $this->get_posts_by_terms( $attributes );
			if ( $dt_query->have_posts() ) {

				$this->backup_post_object();

				ob_start();

				echo '<section class="testimonial-item testimonial-item-slider">';
					$autoslide = $attributes['autoslide'];
					echo '<ul class="testimonials slider-content rsCont"' . ($autoslide ? ' data-autoslide="' . $autoslide . '"' : '') . '>' . "\n";

						while ( $dt_query->have_posts() ) { $dt_query->the_post();

							echo '<li>';
								presscore_get_template_part( 'mod_testimonials', 'testimonials-post' );
							echo '</li>';

						}

					echo '</ul>' . "\n";
				echo '</section>';

				$output = ob_get_contents();
				ob_end_clean();

				$this->restore_post_object();
			}

			return $output;
		}

		protected function sanitize_attributes( $atts ) {
			$default_atts = array(
				'type' => 'masonry',
				'category' => '',
				'columns' => '2',
				'order' => 'desc',
				'orderby' => 'date',
				'number' => '12',
				'padding' => '20',
				'column_width' => '370',
				'full_width' => '',
				'autoslide' => '0',
				'loading_effect' => 'none'
			);

			$attributes = shortcode_atts( $default_atts, $atts );

			// sanitize attributes
			$attributes['type'] = sanitize_key( $attributes['type'] );
			$attributes['loading_effect'] = sanitize_key( $attributes['loading_effect'] );

			$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
			$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);
			$attributes['full_width'] = apply_filters('dt_sanitize_flag', $attributes['full_width']);

			$attributes['padding'] = intval($attributes['padding']);

			$attributes['autoslide'] = absint($attributes['autoslide']);
			$attributes['column_width'] = absint($attributes['column_width']);
			$attributes['columns'] = absint($attributes['columns']);

			if ( $attributes['category'] ) {
				$attributes['category'] = presscore_sanitize_explode_string( $attributes['category'] );
				$attributes['select'] = 'only';
			} else {
				$attributes['select'] = 'all';
			}

			return $attributes;
		}

		protected function setup_config( &$attributes ) {
			$config = presscore_get_config();
			$config->set( 'template', 'testimonials' );
			$config->set( 'layout', 'masonry' );
			$config->set( 'template.layout.type', 'masonry' );

			$config->set( 'full_width', $attributes['full_width'] );
			$config->set( 'item_padding', $attributes['padding'] );
			$config->set( 'post.preview.width.min', $attributes['column_width'] );
			$config->set( 'template.columns.number', $attributes['columns'] );
			$config->set( 'post.preview.load.effect', $attributes['loading_effect'] );

			$config->set( 'post.preview.description.style', 'disabled' );
			$config->set( 'load_style', 'default' );
		}

	}

	// create shortcode
	DT_Shortcode_Testimonials::get_instance();

}
