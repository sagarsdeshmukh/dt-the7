<?php
/**
 * Theme options dependency class.
 *
 * @package the7\Options
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Options_Fields_Dependency', false ) ) :

	/**
	 * Theme options dependency class.
	 */
	class Presscore_Options_Fields_Dependency {

		protected $dependencies = array();

		public function set( $id, $dep ) {
			$this->dependencies[ $id ] = $dep;
		}

		public function get( $id ) {
			if ( isset( $this->dependencies[ $id ] ) ) {
				return $this->dependencies[ $id ];
			}
			return null;
		}

		public function get_all() {
			return $this->dependencies;
		}
	}

endif;

if ( ! function_exists( 'optionsframework_fields_dependency' ) ) :

	/**
	 * Returns object with stored options dependencies.
	 * 
	 * @since 3.0.0
	 * 
	 * @return Presscore_Options_Fields_Dependency
	 */
	function optionsframework_fields_dependency() {
		static $dep_obj = null;

		if ( null === $dep_obj ) {
			$dep_obj = new Presscore_Options_Fields_Dependency();
		}

		return $dep_obj;
	}

endif;
