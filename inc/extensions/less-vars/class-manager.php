<?php
/**
 * Less vars manager.
 */

if ( ! class_exists( 'Presscore_Lib_LessVars_Manager', false ) ) :

	class Presscore_Lib_LessVars_Manager {
		protected $storage;
		protected $factory;

		public function __construct( Presscore_Lib_SimpleBag $storage, Presscore_Lib_LessVars_Factory $factory ) {
			$this->storage = $storage;
			$this->factory = $factory;
		}

		public function import( $items ) {
			$this->storage->map( $items );
		}

		public function get_var( $var ) {
			return $this->storage->get( $var );
		}

		public function get_vars() {
			return $this->storage->get_all();
		}

		public function add_image( $var, $value, $wrap = null ) {
			$this->storage->set( $var, $this->factory->image( $value )->wrap( $wrap )->get() );
		}

		public function add_hex_color( $var, $value, $wrap = null ) {
			$color_obj = $this->populate_color( $value );
			$this->storage->set( $var, $color_obj->wrap( $wrap )->get_hex() );
		}

		public function add_rgb_color( $var, $value, $wrap = null ) {
			$color_obj = $this->populate_color( $value );
			$this->storage->set( $var, $color_obj->wrap( $wrap )->get_rgb() );
		}

		public function add_rgba_color( $var, $value, $opacity = null, $wrap = null ) {
			$color_obj = $this->populate_color( $value );
			$this->storage->set( $var, $color_obj->opacity( $opacity )->wrap( $wrap )->get_rgba() );
		}

		public function add_pixel_number( $var, $value, $wrap = null ) {
			$this->storage->set( $var, $this->factory->number( $value )->wrap( $wrap )->get_pixels() );
		}

		public function add_percent_number( $var, $value, $wrap = null ) {
			$this->storage->set( $var, $this->factory->number( $value )->wrap( $wrap )->get_percents() );
		}

		public function add_number( $var, $value, $wrap = null ) {
			$this->storage->set( $var, $this->factory->number( $value )->wrap( $wrap )->get() );
		}

		public function add_font( $var, $value, $wrap = null ) {
			$this->storage->set( $var, $this->factory->font( $value )->wrap( $wrap )->get() );
		}

		public function add_keyword( $var, $value, $wrap = null ) {
			$_value = $value;
			if ( $wrap ) {
				$_value = sprintf( strval( $wrap ), $value );
			}
			$this->storage->set( $var, $_value );
		}

		protected function populate_color( $value ) {
			if ( $value && is_array( $value ) ) {
				$color_obj = $this->factory->composition();
				foreach ( $value as $color ) {
					$color_obj->add( $this->factory->color( $color ) );
				}
			} else {
				$color_obj = $this->factory->color( $value );
			}

			return $color_obj;
		}
	}

endif;
