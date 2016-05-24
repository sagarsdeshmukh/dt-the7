<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Puny_Shortcodes', false ) ) {

	class Presscore_Puny_Shortcodes {

		protected static $registered_shortcodes = array();

		public static function add_puny_shortcode( $tag, $function ) {
			self::$registered_shortcodes[ $tag ] = $function;
		}

		public static function get_puny_shortcodes() {
			return self::$registered_shortcodes;
		}
	}

}
