<?php
/**
 * Portfolio module main class.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Mod_Portfolio', false ) ) {

	class Presscore_Mod_Portfolio {

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
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mod-portfolio-admin.php';

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mod-portfolio-public.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mod-portfolio-scroller.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mod-portfolio-ajax-content-builder.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/mod-portfolio-helpers.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/mod-portfolio-template-config-helpers.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/widgets/portfolio.php';
		}

		private function setup_services() {
			presscore_template_manager()->add_path( 'mod_portfolio', dt_plugin_dir_relative_path( dirname( __FILE__ ) ) . 'public/templates' );
		}

		private function define_admin_hooks() {
			// rewrite post type slug
			$rewrite_filter = new Presscore_Post_Type_Rewrite_Rules_Filter( 'general-post_type_portfolio_slug' );

			// filter post type args prior it's registration
			add_filter( 'presscore_post_type_dt_portfolio_args', array( $rewrite_filter, 'filter_post_type_rewrite' ) );

			// flush rewrite rules after post type slug change
			add_action( 'optionsframework_after_validate', array( $rewrite_filter, 'flush_rules_after_slug_change' ) );

			$mod_admin = new Presscore_Mod_Portfolio_Admin();

			// enable js composer for this post type by default
			add_filter( 'presscore_mod_js_composer_default_editor_post_types', array( $mod_admin, 'js_composer_default_editor_post_types_filter' ) );

			// add basic meta boxes for this post type
			add_filter( 'presscore_pages_with_basic_meta_boxes', array( $mod_admin, 'add_basic_meta_boxes_support' ) );

			// add custom theme options
			add_filter( 'presscore_options_files_to_load', array( $mod_admin, 'add_options' ), 20 );

			// register post type and taxonomy
			add_action( 'init', array( $mod_admin, 'register_post_types' ), 5 );
			add_action( 'init', array( $mod_admin, 'register_taxonomies' ), 5 );

			// add custom meta boxes
			add_action( 'presscore_load_meta_boxes', array( $mod_admin, 'add_meta_boxes' ) );

			// add thmbnail column for posts list
			add_filter( 'manage_edit-dt_portfolio_columns', 'presscore_admin_add_thumbnail_column' );

			// add sidebars columns
			add_filter( 'manage_edit-dt_portfolio_columns', 'presscore_admin_add_sidebars_columns' );
		}

		private function define_public_hooks() {
			$mod_public = new Presscore_Mod_Portfolio_Public();

			add_filter( 'presscore_ajax_pagination_response', array( $mod_public, 'resolve_template_ajax' ), 20, 3 );
			add_filter( 'presscore_config_post_id_filter', array( $mod_public, 'archive_page_id' ), 15 );
			add_filter( 'presscore_archive_post_content-dt_portfolio', array( $mod_public, 'archive_post_content' ) );
			add_filter( 'presscore_posted_on_wrap_class', array( $mod_public, 'post_meta_wrap_class_filter' ) );
			add_filter( 'presscore_get_page_title', array( $mod_public, 'filter_page_title' ) );
			add_filter( 'body_class', array( $mod_public, 'filter_body_class' ), 20 );
			add_filter( 'presscore_before_post_masonry-filter_taxonomy', array( $mod_public, 'filter_masonry_wrap_taxonomy' ), 10, 2 );
			add_filter( 'presscore_author_archive_post_types', array( $mod_public, 'filter_add_to_author_archive' ) );

			add_action( 'init', array( $mod_public, 'register_shortcodes' ) );
			add_action( 'presscore_js_composer_after_bridge_loaded', array( $mod_public, 'load_shortcodes_vc_bridge' ) );
			add_action( 'widgets_init', array( $mod_public, 'init_widgets' ) );
			add_action( 'presscore_config_base_init', array( $mod_public, 'init_template_config' ), 10, 2 );
		}
	}

}
