<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Lib_LessVars_Font', false ) ) :

	class Presscore_Lib_LessVars_Font extends Presscore_Lib_LessVars_Builder {
		protected $family;
		protected $style;
		protected $weight;
		protected $trail;

		public function __construct( $font ) {
			$this->trail = 'Helvetica, Arial, Verdana, sans-serif';
			$this->init( $font );
		}

		public function weight( $weight ) {
			$this->weight = $this->sanitize_weight( $weight );
		}

		public function style( $style ) {
			$this->style = $this->sanitize_style( $style );
		}

		public function trail( $trail ) {
			$this->trail = $trail;
		}

		public function get() {
			$family = '';
			if ( $this->family ) {
				$family = '"' . $this->family . '"';
			}

			return array(
				$this->get_wrapped( $family . ( ( $family && $this->trail ) ? ', ' : '' ) . $this->trail ),
				$this->weight,
				$this->style,
			);
		}

		protected function init( $font ) {
			preg_match( '/^([\w\s]+):?(\d*)(\w*)/', $font, $matches );

			for ( $i = 0; $i < 4; $i++ ) {
				$matches[ $i ] = ( isset( $matches[ $i ] ) ? $matches[ $i ] : '' );
			}

			$this->family = $matches[1];
			$this->weight = $this->sanitize_weight( $matches[2] );
			$this->style = $this->sanitize_style( $matches[3] );
		}

		protected function sanitize_weight( $weight ) {
			if ( ! $weight ) {
				return '~""';
			} else if ( '700' == $weight ) {
				return 'bold';
			} else if( '400' == $weight ) {
				return 'normal';
			}

			return $weight;
		}

		protected function sanitize_style( $style ) {
			return 'italic' === $style ? $style : '~""';
		}
	}

endif;
