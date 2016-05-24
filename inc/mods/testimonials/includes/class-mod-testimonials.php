<?php
/**
 * Testimonials module main class.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Mod_Testimonials', false ) ) {

	class Presscore_Mod_Testimonials {

		protected static $_instance = null;

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function __construct() {
			$this->load_dependencies();
			$this->setup_services();
			$this->define_admin_hooks();
			$this->define_public_hooks();
		}

		private function load_dependencies() {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mod-testimonials-admin.php';

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mod-testimonials-public.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mod-testimonials-ajax-content-builder.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/widgets/testimonials-list.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/widgets/testimonials-slider.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/mod-testimonials-template-config-helpers.php';
		}

		private function setup_services() {
			presscore_template_manager()->add_path( 'mod_testimonials', dt_plugin_dir_relative_path( dirname( __FILE__ ) ) . 'public/templates' );
		}

		private function define_admin_hooks() {
			$mod_admin = new Presscore_Mod_Testimonials_Admin();

			// register post type and taxonomy
			add_action( 'init', array( $mod_admin, 'register_post_types' ), 5 );
			add_action( 'init', array( $mod_admin, 'register_taxonomies' ), 5 );

			// add custom meta boxes
			add_action( 'presscore_load_meta_boxes', array( $mod_admin, 'add_meta_boxes' ) );

			// add thmbnail column for posts list
			add_filter( 'manage_edit-dt_testimonials_columns', 'presscore_admin_add_thumbnail_column' );
		}

		private function define_public_hooks() {
			$mod_public = new Presscore_Mod_Testimonials_Public();

			add_filter( 'presscore_ajax_pagination_response', array( $mod_public, 'resolve_template_ajax' ), 20, 3 );
			add_filter( 'presscore_archive_post_content-dt_testimonials', array( $mod_public, 'archive_post_content' ) );

			add_action( 'init', array( $mod_public, 'register_shortcodes' ) );
			add_action( 'presscore_js_composer_after_bridge_loaded', array( $mod_public, 'load_shortcodes_vc_bridge' ) );
			add_action( 'widgets_init', array( $mod_public, 'init_widgets' ) );
			add_action( 'presscore_config_base_init', array( $mod_public, 'init_template_config' ), 10, 2 );
		}
	}

}
