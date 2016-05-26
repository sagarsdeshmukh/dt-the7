<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Lib_LessVars_Image', false ) ) :

	class Presscore_Lib_LessVars_Image extends Presscore_Lib_LessVars_Builder {
		protected $val;

		public function __construct( $val = array() ) {
			$defaults = array(
				'image'      => '',
				'repeat'     => 'repeat',
				'position_x' => 'center',
				'position_y' => 'center',
			);

			$this->val = wp_parse_args( $val, $defaults );
			$this->val['image'] = $this->build_src( $this->val['image'] );
		}

		public function get_assoc() {
			return array_map( array( $this, 'get_wrapped' ), $this->val );
		}

		public function get() {
			return array_values( $this->get_assoc() );
		}

		protected function build_src( $src ) {
			if ( empty( $src ) ) {
				return 'none';
			}

			$uri = $src;
			if ( ! parse_url( $src, PHP_URL_SCHEME ) ) {
				$uploads = wp_upload_dir();
				$baseurl = str_replace( site_url(), '', $uploads['baseurl'] );
				$pattern = '/' . trailingslashit( basename( WP_CONTENT_URL ) );

				if ( strpos( $src, $baseurl ) !== false || strpos( $src, $pattern ) !== false ) {
					$uri = site_url( $src );
				} else {
					$uri = PRESSCORE_PRESET_BASE_URI . $src;
				}
			}

			return sprintf( "url('%s')", esc_url( $uri ) );
		}
	}

endif;
