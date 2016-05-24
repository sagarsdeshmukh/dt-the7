<?php
/**
 * Class that stores theme meta boxes and corresponding logic
 *
 */

class Presscore_Meta_Box_Field_Template {

	/////////////////
	// Properties //
	/////////////////

	private static $templates = array();

	//////////////
	// Methods //
	//////////////

	public static function add( $name, $template ) {
		self::$templates[ $name ] = $template;
	}

	public static function get( $name ) {
		return array_key_exists( $name, self::$templates ) ? self::$templates[ $name ] : false;
	}

	public static function get_as_array( $name, $extend_array = array() ) {
		$template = self::get( $name );

		if ( false === $template ) {
			return false;
		}

		if ( !is_array( $template ) ) {
			$template = (array) $template;
		}

		if ( !empty( $extend_array ) && is_array( $extend_array ) ) {
			$template = array_merge( $template, $extend_array );
		}

		return $template;
	}
}
