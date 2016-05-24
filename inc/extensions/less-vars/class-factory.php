<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Lib_LessVars_Factory', false ) ) :

	class Presscore_Lib_LessVars_Factory {

		public function __call( $name, $args ) {
			$class_name = $this->get_class_name( $name );
			if ( class_exists( $class_name, false ) ) {
				return $this->create( $class_name, $args );
			}
		}

		protected function get_class_name( $name ) {
			$_name = implode( '', array_map( 'ucfirst', explode( '_', strtolower( $name ) ) ) );
			return 'Presscore_Lib_LessVars_' . $_name;
		}

		protected function create( $class_name, $args ) {
			return new $class_name( isset( $args[0] ) ? $args[0] : null );
		}
	}

endif;
