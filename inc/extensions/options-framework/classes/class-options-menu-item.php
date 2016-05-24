<?php
/**
 * Options menu item class.
 * 
 * @package the7\Options
 * @since 3.0.0
 */

if ( ! class_exists( 'Presscore_Options_Menu_Item', false ) ) {

	class Presscore_Options_Menu_Item {

		const DEFAULT_CAPABILITY = 'edit_theme_options';

		/**
		 * @var array
		 */
		protected $body;

		/**
		 * @param array $args
		 */
		public function __construct( $args = array() ) {
			$this->body = $this->sanitize_body( $args );
		}

		/**
		 * @param  string $key
		 * @return mixed        Returns false if $key does not exists.
		 */
		public function get( $key ) {
			if ( $this->has( $key ) ) {
				return $this->body[ $key ];
			}
			return false;
		}

		/**
		 * @param string $key
		 * @param mixed $value
		 */
		public function set( $key, $value ) {
			$this->body[ $key ] = $value;
		}

		/**
		 * @param  string  $key
		 * @return boolean
		 */
		public function has( $key ) {
			return array_key_exists( $key, $this->body );
		}

		/**
		 * @param  array &$args
		 * @return array
		 */
		protected function sanitize_body( &$args ) {
			$default = array(
				'slug'             => '',
				'page_title'       => '',
				'menu_title'       => '',
				'file'             => '',
				'capability'       => self::DEFAULT_CAPABILITY,
			);
			$_args = wp_parse_args( $args, $default );

			$_args['page_title'] = $_args['page_title'] ? $_args['page_title'] : $_args['menu_title'];
			$_args['menu_title'] = $_args['menu_title'] ? $_args['menu_title'] : $_args['page_title'];

			return $_args;
		}
	}

}
