<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Lib_SimpleBag', false ) ) :

	/**
	* Simple bag.
	*/
	class Presscore_Lib_SimpleBag {
		const INDEX_LIST = 1;
		const INDEX_ASSOC = 2;

		protected $items = array();

		public function get( $key, $index = self::INDEX_LIST ) {
			if ( is_array( $key ) ) {
				if ( self::INDEX_ASSOC === $index ) {
					return $this->get_assoc( $key );
				} else {
					return $this->get_list( $key );
				}
			} else if ( $this->has( $key ) ) {
				return $this->items[ $key ];
			}

			return null;
		}

		public function set( $key, $value ) {
			if ( is_array( $key ) ) {
				if ( ! is_array( $value ) ) {
					$value = array( $value );
				}

				foreach ( $key as $i=>$k ) {
					if ( ! $k ) {
						continue;
					}

					if ( array_key_exists( $i, $value ) ) {
						$this->items[ $k ] = $value[ $i ];
					} else {
						$this->items[ $k ] = null;
					}
				}
			} else if ( $key ) {
				$this->items[ $key ] = $value;
			}
		}

		public function map( $items ) {
			foreach ( (array)$items as $key=>$value ) {
				$this->items[ $key ] = $value;
			}
		}

		public function has( $key ) {
			return array_key_exists( $key, $this->items );
		}

		public function remove( $key ) {
			if ( is_array( $key ) ) {
				foreach ( $key as $k ) {
					unset( $this->items[ $k ] );
				}
			} else {
				unset( $this->items[ $key ] );
			}
		}

		public function get_all() {
			return $this->items;
		}

		protected function get_assoc( $keys ) {
			$_items = array();
			foreach ( $keys as $i=>$k ) {
				if ( $this->has( $k ) ) {
					$_items[ $k ] = $this->items[ $k ];
				} else {
					$_items[ $k ] = null;
				}
			}
			return $_items;
		}

		protected function get_list( $keys ) {
			$_items = array();
			foreach ( $keys as $k ) {
				if ( $this->has( $k ) ) {
					$_items[] = $this->items[ $k ];
				} else {
					$_items[] = null;
				}
			}
			return $_items;
		}
	}

endif;
