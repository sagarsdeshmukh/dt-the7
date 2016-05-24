<?php
/**
 * Class that stores theme meta boxes and corresponding logic
 *
 */

class Presscore_Meta_Box {

	/////////////////
	// Properties //
	/////////////////

	/**
	 * Stored meta boxes
	 * @var array
	 */
	private static $meta_boxes = array();

	//////////////
	// Methods //
	//////////////

	/**
	 * Store meta box
	 * @param mixed $meta_box
	 */
	public static function add( $meta_box ) {
		array_push( self::$meta_boxes, $meta_box );
	}

	/**
	 * Returns stored meta boxes
	 * @return mixed Stored meta boxes
	 */
	public static function get_all() {
		return self::$meta_boxes;
	}

}