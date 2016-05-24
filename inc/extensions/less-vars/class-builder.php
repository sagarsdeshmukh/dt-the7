<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Lib_LessVars_Builder' ) ) :

	abstract class Presscore_Lib_LessVars_Builder {
		private $wrap = '%s';

		public function wrap( $wrap ) {
			if ( $wrap ) {
				$this->wrap = strval( $wrap );
			}
			return $this;
		}

		protected function get_wrapped( $val ) {
			return sprintf( $this->wrap, $val );
		}
	}

endif;
