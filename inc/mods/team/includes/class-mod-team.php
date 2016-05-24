<?php
/**
 * Team module main class.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Mod_Team', false ) ) {

	class Presscore_Mod_Team {

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
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mod-team-admin.php';

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mod-team-public.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/widgets/team.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/mod-team-template-config-helpers.php';
		}

		private function setup_services() {
			presscore_template_manager()->add_path( 'mod_team', dt_plugin_dir_relative_path( dirname( __FILE__ ) ) . 'public/templates' );
		}

		private function define_admin_hooks() {
			// rewrite post type slug
			$rewrite_filter = new Presscore_Post_Type_Rewrite_Rules_Filter( 'general-post_type_team_slug' );

			// filter post type args prior it's registration
			add_filter( 'presscore_post_type_dt_team_args', array( $rewrite_filter, 'filter_post_type_rewrite' ) );

			// flush rewrite rules after post type slug change
			add_action( 'optionsframework_after_validate', array( $rewrite_filter, 'flush_rules_after_slug_change' ) );

			$mod_admin = new Presscore_Mod_Team_Admin();

			// add basic meta boxes for this post type
			add_filter( 'presscore_pages_with_basic_meta_boxes', array( $mod_admin, 'add_basic_meta_boxes_support' ) );

			// register post type and taxonomy
			add_action( 'init', array( $mod_admin, 'register_post_types' ), 5 );
			add_action( 'init', array( $mod_admin, 'register_taxonomies' ), 5 );

			// add custom meta boxes
			add_action( 'presscore_load_meta_boxes', array( $mod_admin, 'add_meta_boxes' ) );

			// add thmbnail column for posts list
			add_filter( 'manage_edit-dt_team_columns', 'presscore_admin_add_thumbnail_column' );

			// add sidebars columns
			add_filter( 'manage_edit-dt_team_columns', 'presscore_admin_add_sidebars_columns' );
		}

		private function define_public_hooks() {
			$mod_public = new Presscore_Mod_Team_Public();

			add_filter( 'presscore_archive_post_content-dt_team', array( $mod_public, 'archive_post_content' ) );

			add_action( 'init', array( $mod_public, 'register_shortcodes' ) );
			add_action( 'presscore_js_composer_after_bridge_loaded', array( $mod_public, 'load_shortcodes_vc_bridge' ) );
			add_action( 'widgets_init', array( $mod_public, 'init_widgets' ) );
			add_action( 'presscore_config_base_init', array( $mod_public, 'init_template_config' ), 10, 2 );
		}
	}

}
