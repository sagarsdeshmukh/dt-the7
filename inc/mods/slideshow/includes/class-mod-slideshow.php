<?php
/**
 * Slideshow module main class.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Mod_Slideshow', false ) ) {

	class Presscore_Mod_Slideshow {

		protected static $_instance = null;

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function __construct() {
			$this->load_dependencies();
			$this->define_admin_hooks();
			$this->define_public_hooks();
		}

		private function load_dependencies() {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mod-slideshow-admin.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mod-slideshow-public.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/mod-slideshow-helpers.php';
		}

		private function define_admin_hooks() {
			$mod_admin = new Presscore_Mod_Slideshow_Admin();

			// filter admin posts thumbnail to use first image from slideshow if there is no thumbnail
			add_filter( 'presscore_admin_get_post_thumbnail', array( $mod_admin, 'filter_admin_post_thumbnail' ), 10, 3 );

			// register post type
			add_action( 'init', array( $mod_admin, 'register_post_types' ), 5 );

			// add custom meta boxes
			add_action( 'presscore_load_meta_boxes', array( $mod_admin, 'add_meta_boxes' ) );

			// add thmbnail column for posts list
			add_filter( 'manage_edit-dt_slideshow_columns', 'presscore_admin_add_thumbnail_column' );

			// add slug column for posts list
			add_filter( 'manage_edit-dt_slideshow_columns', 'presscore_admin_add_slug_column' );
		}

		private function define_public_hooks() {
			$mod_public = new Presscore_Mod_Slideshow_Public();

			add_action( 'init', array( $mod_public, 'register_shortcodes' ) );
			add_action( 'presscore_js_composer_after_bridge_loaded', array( $mod_public, 'load_shortcodes_vc_bridge' ) );
			add_action( 'presscore_do_header_slideshow', array( $mod_public, 'do_header_slideshow' ) );
		}
	}

}
