<?php
/**
 * LearnDash LMS compatibility module.
 * 
 * @since   3.1.0
 * @package the7
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Presscore_Modules_Compatibility_LDLMS', false ) ) :

	class Presscore_Modules_Compatibility_LDLMS {

		public static function execute() {
			if ( ! class_exists( 'Semper_Fi_Module', false ) ) {
				return;
			}

			add_action( 'presscore_pages_with_basic_meta_boxes', array( __CLASS__, 'add_meta_boxes_filter' ) );
		}

		/**
		 * Add basic meta boxers for LearnDash post types.
		 *
		 * @param array $post_types
		 * @return array
		 */
		public static function add_meta_boxes_filter( $post_types = array() ) {
			$post_types[] = 'sfwd-lessons';
			$post_types[] = 'sfwd-courses';
			$post_types[] = 'sfwd-topic';
			$post_types[] = 'sfwd-quiz';
			return $post_types;
		}
	}

	Presscore_Modules_Compatibility_LDLMS::execute();

endif;
