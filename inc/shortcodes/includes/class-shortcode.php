<?php
/**
 * Shortcodes class.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode', false ) ):

	class DT_Shortcode {

		protected $post_backup = null;
		protected $config_backup = null;

		public function get_posts_by_terms( $instance = array() ) {
			if ( empty($this->post_type) || empty($this->taxonomy) ) {
				return false;
			}

			$args = array(
				'posts_per_page'        => isset( $instance['number'] ) ? $instance['number'] : -1,
				'post_type'             => $this->post_type,
				'post_status'           => 'publish',
				'orderby'               => isset( $instance['orderby'] ) ? $instance['orderby'] : 'date',
				'order'                 => isset( $instance['order'] ) ? $instance['order'] : 'DESC',
				'tax_query'             => array( array(
					'taxonomy'          => $this->taxonomy,
					'field'             => 'slug',
					'terms'             => $instance['category']
				) ),
			);

			switch( $instance['select'] ) {
				case 'only': $args['tax_query'][0]['operator'] = 'IN'; break;
				case 'except': $args['tax_query'][0]['operator'] = 'NOT IN'; break;
				default: unset( $args['tax_query'] );
			}

			return new WP_Query( $args );
		}

		protected function vc_inline_dummy( $args = array() ) {
			$defaults = array(
				'title' => '',
				'title_tag' => 'h5',
				'fields' => array(),
				'class' => array(),
				'style' => array( 'height' => '250px' )
			);

			$args = wp_parse_args( $args, $defaults );

			extract( $args );

			$fields = (array) $fields;
			$class = (array) $class;
			$style = (array) $style;

			////////////
			// class //
			////////////

			$class[] = 'dt_vc-shortcode_dummy';

			////////////
			// style //
			////////////

			$style_attr = '';
			if ( count( $style ) ) {

				foreach( $style as $rule=>$value ) {
					$style_attr .= "{$rule}: {$value};";
				}

				$style_attr = ' style="' . esc_attr( $style_attr ) . '"';
			}

			/////////////
			// Fields //
			/////////////

			$fields_html = '';
			if ( count( $fields ) ) {

				foreach( $fields as $field_title=>$field_value ) {
					$fields_html .= sprintf( '<p class="text-small"><strong>%s:</strong> %s</p>', $field_title, $field_value );
				}

			}

			$output = sprintf(
				'<div class="%1$s"%2$s><%3$s>%4$s</%3$s>%5$s</div>',
				esc_attr( join( ' ', $class ) ),
				$style_attr,
				$title_tag,
				$title,
				$fields_html
			);

			return $output;
		}

		protected function backup_post_object() {
			global $post;
			$this->post_backup = $post;
		}

		protected function restore_post_object() {
			global $post;
			$post = $this->post_backup;
			setup_postdata( $post );
			unset( $this->post_backup );
		}

		protected function backup_theme_config() {
			$this->config_backup = presscore_get_config()->get();
		}

		protected function restore_theme_config() {
			presscore_get_config()->reset( $this->config_backup );
			unset( $this->config_backup );
		}

		protected function set_compatible_att_value( &$atts, $new_att, $old_att ) {
			if ( ! isset( $atts[ $new_att ] ) && isset( $atts[ $old_att ] ) ) {
				$atts[ $new_att ] = $atts[ $old_att ];
				return $atts[ $new_att ];
			}

			return false;
		}

	}

endif;
