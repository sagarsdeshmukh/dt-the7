<?php
/**
 * Admin icons bar module.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_AdminIconsBarModule', false ) ) :

	class Presscore_Modules_AdminIconsBarModule {

		const CSS_PATH = 'fonts/fontello/css/fontello.css';
		const JSON_PATH = 'fonts/fontello/config.json';

		/**
		 * Execute module.
		 */
		public static function execute() {
			if ( ! is_admin() ) {
				return;
			}

			add_action( 'wp_before_admin_bar_render', array( __CLASS__, 'add_custom_toolbar_action' ) , 20 );

			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_scripts_action' ) );

			add_action( 'init', 'add_thickbox' );

			add_action( 'wp_ajax_icons_bar', array( __CLASS__, 'ajax_response_action' ) );
		}

		public static function enqueue_admin_scripts_action() {
			$font_css_url = str_replace( get_theme_root(), get_theme_root_uri(), locate_template( self::CSS_PATH, false ) );
			$font_css_url = apply_filters( 'presscore_admin_icons_bar_font_css_url', $font_css_url );
			if ( $font_css_url ) {
				wp_enqueue_style( 'the7-fontello', $font_css_url );
			}

			$assets_uri = self::get_assets_uri();
			wp_enqueue_style( 'presscore-icons-bar', $assets_uri . 'css/icons-bar.css' );
			wp_enqueue_script( 'presscore-isons-bar', $assets_uri . 'js/icons-bar.js', false, wp_get_theme()->get( 'Version' ), true );
		}

		public static function add_custom_toolbar_action() {
			global $wp_admin_bar;

			$wp_admin_bar->add_node( array(
				'id'    => 'presscore-icons-bar',
				'title' => _x( 'Icons Bar', 'admin icons bar', 'the7mk2' ),
				'href'  => '#TB_inline?width=1024&height=768&inlineId=presscore-icons-bar'
			) );
		}

		public static function ajax_response_action() {
			include trailingslashit( dirname( __FILE__ ) ) . 'view.php';
			wp_die();
		}

		public static function get_assets_uri() {
			$theme_root = str_replace( '\\', '/', get_theme_root() );
			$current_dir = str_replace( '\\', '/', trailingslashit( dirname( __FILE__ ) ) );

			return str_replace( $theme_root, get_theme_root_uri(), $current_dir );
		}

		public static function get_json_file_content() {
			$file_path = apply_filters( 'presscore_admin_icons_bar_json_file', locate_template( self::JSON_PATH, false ) );
			$json = file_get_contents( $file_path, 0, null, null );
			return json_decode( $json );
		}
	}

	Presscore_Modules_AdminIconsBarModule::execute();

endif;
