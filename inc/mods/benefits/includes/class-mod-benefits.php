<?php
/**
 * Benefits module main class.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Mod_Benefits', false ) ) {

	class Presscore_Mod_Benefits {

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
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mod-benefits-admin.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mod-benefits-public.php';
		}

		private function define_admin_hooks() {
			$mod_admin = new Presscore_Mod_Benefits_Admin();

			// enable js composer for this post type by default
			add_filter( 'presscore_mod_js_composer_default_editor_post_types', array( $mod_admin, 'js_composer_default_editor_post_types_filter' ) );

			// register post type and taxonomy
			add_action( 'init', array( $mod_admin, 'register_post_types' ), 5 );
			add_action( 'init', array( $mod_admin, 'register_taxonomies' ), 5 );

			// add custom meta boxes
			add_action( 'presscore_load_meta_boxes', array( $mod_admin, 'add_meta_boxes' ) );

			// add thmbnail column for posts list
			add_filter( 'manage_edit-dt_benefits_columns', 'presscore_admin_add_thumbnail_column' );
		}

		private function define_public_hooks() {
			$mod_public = new Presscore_Mod_Benefits_Public();

			add_action( 'init', array( $mod_public, 'register_shortcodes' ) );
			add_action( 'presscore_js_composer_after_bridge_loaded', array( $mod_public, 'load_shortcodes_vc_bridge' ) );
		}

	}
}
