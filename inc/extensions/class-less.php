<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Lib_Less', false ) ) :

	class Presscore_Lib_Less {
		protected $container = array();

		public function __construct() {
			$this->container['vars'] = new Presscore_Lib_SimpleBag();
			$this->container['new'] = new Presscore_Lib_LessVars_Factory( 'Presscore_Lib_LessVars_%s' );
			$this->container['new']->composition = new Presscore_Lib_LessVars_Factory( 'Presscore_Lib_LessVars_%sComposition' );
		}

		public function __get( $name ) {
			if ( isset( $this->container[ $name ] ) ) {
				return $this->container[ $name ];
			}
			return null;
		}

		public function __set( $name, $value ) {
		}
	}

endif;
