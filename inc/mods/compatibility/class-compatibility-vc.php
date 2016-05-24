<?php
/**
 * Visual Composer compatibility class.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_Compatibility_VC', false ) ) :

	class Presscore_Modules_Compatibility_VC {

		public static function execute() {
			if ( ! class_exists( 'Vc_Manager', false ) ) {
				return;
			}

			if ( function_exists( 'vc_set_as_theme' ) ) {
				vc_set_as_theme( true );
			}

			if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
				vc_set_default_editor_post_types( apply_filters( 'presscore_mod_js_composer_default_editor_post_types', array( 'page', 'post' ) ) );
			}

			if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
				vc_set_shortcodes_templates_dir( PRESSCORE_THEME_DIR . '/inc/shortcodes/vc_templates' );
			}

			require_once locate_template( '/inc/shortcodes/vc-extensions.php' );

			add_action( 'init', array( __CLASS__, 'load_bridge' ), 20 );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_admin_static' ), 20 );
			add_action( 'admin_init', array( __CLASS__, 'remove_teaser_meta_box' ), 7 );
		}

		public static function load_bridge() {
			$shortcodes_to_remove = apply_filters( 'presscore_js_composer_shortcodes_to_remove', array( 
				"vc_wp_search",
				"vc_wp_meta",
				"vc_wp_recentcomments",
				"vc_wp_calendar",
				"vc_wp_pages",
				"vc_wp_tagcloud",
				"vc_wp_custommenu",
				"vc_wp_text",
				"vc_wp_posts",
				"vc_wp_links",
				"vc_wp_categories",
				"vc_wp_archives",
				"vc_wp_rss",
				"vc_gallery",
				"vc_teaser_grid",
				"vc_button",
				"vc_cta_button",
				"vc_posts_grid",
				"vc_carousel",
				"vc_images_carousel",
				"vc_posts_slider",
				"vc_cta_button2",
			) ); 

			foreach ( $shortcodes_to_remove as $shortcode ) {
				vc_remove_element( $shortcode );
			}

			require_once locate_template( '/inc/shortcodes/js_composer_bridge.php' );

			do_action( 'presscore_js_composer_after_bridge_loaded' );
		}

		public static function load_admin_static() {
			wp_enqueue_style( 'dt-vc-bridge', PRESSCORE_THEME_URI . '/inc/shortcodes/css/js_composer_bridge.css' );

			if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
				wp_enqueue_script( 'vc-custom-view-by-dt', PRESSCORE_THEME_URI . '/inc/shortcodes/js/vc-custom-view.js', array(), false, true );
			}
		}

		public static function remove_teaser_meta_box() {
			global $vc_teaser_box;
			if ( is_callable( 'vc_editor_post_types' ) && ! empty( $vc_teaser_box ) ) {
				$pt_array = vc_editor_post_types();
				foreach ( $pt_array as $pt ) {
					remove_meta_box( 'vc_teaser', $pt, 'side' );
				}
				remove_action( 'save_post', array( &$vc_teaser_box, 'saveTeaserMetaBox' ) );
			}
		}
	}

	Presscore_Modules_Compatibility_VC::execute();

endif;
