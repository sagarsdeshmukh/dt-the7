<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Lib_LessVars_Number', false ) ) :

	class Presscore_Lib_LessVars_Number extends Presscore_Lib_LessVars_Builder {
		protected $val;
		protected $suffix;

		public function __construct( $val = 0 ) {
			$this->val = 0;
			$this->suffix = '';

			preg_match( '/([-0-9]*)(.*)/', $val, $matches );
			if ( ! empty( $matches[1] ) ) {
				$this->val = intval( $matches[1] );
			}

			if ( ! empty( $matches[2] ) ) {
				$this->suffix = $matches[2];
			}
		}

		public function get() {
			return $this->get_wrapped( $this->val . $this->suffix );
		}

		public function get_percents() {
			return $this->get_wrapped( $this->val . '%' );
		}

		public function get_pixels() {
			return $this->get_wrapped( $this->val . 'px' );
		}
	}

endif;
