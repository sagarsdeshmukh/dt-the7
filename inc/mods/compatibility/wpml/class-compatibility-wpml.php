<?php
/**
 * WPML compatibility class.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_Compatibility_WPML', false ) ) :

	class Presscore_Modules_Compatibility_WPML {

		public static function execute() {
			if ( ! class_exists( 'SitePress', false ) ) {
				return;
			}

			// load wpml helpers
			require_once trailingslashit( PRESSCORE_MODS_DIR ) . 'compatibility/' . basename( dirname( __FILE__ ) ) . '/wpml-integration.php';

			/**
			 * Do not load wpml language switcher css.
			 */
			if ( ! defined( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS' ) ) {
				define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
			}

			/**
			 * Dirty hack that fixes front page pagination with custom query.
			 */
			remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
			add_action( 'template_redirect', 'wp_shortlink_header',  11, 0 );

			/**
			 * Filter theme localized script.
			 */
			add_filter( 'presscore_localized_script', array( __CLASS__, 'localized_script_filter' ) );

			/**
			 * Enqueue dynamic stylesheets.
			 */
			add_filter( 'presscore_get_dynamic_stylesheets_list', array( __CLASS__, 'enqueue_dynamic_stylesheets_filter' ) );

			/**
			 * Add editor.
			 */
			add_action( 'init', array( __CLASS__, 'enable_editor_for_post_types_action' ), 16 );

			/**
			 * Hide editor.
			 */
			add_action( 'admin_print_styles-post.php', array( __CLASS__, 'hide_editor_for_post_types_action' ) );
			add_action( 'admin_print_styles-post-new.php', array( __CLASS__, 'hide_editor_for_post_types_action' ) );

			/**
			 * Render language switcher.
			 */
			add_action( 'presscore_render_header_element-language', array( __CLASS__, 'render_header_language_switcher_action' ) );

			/**
			 * Add language microwidget options.
			 */
			add_filter( 'presscore_options_files_to_load', array( __CLASS__, 'add_microwidget_options_filter' ) );

			/**
			 * For some reasons WPML remove '<ul></div>' from pages based menu html and add it after laguage switcher code.
			 * It has destroyed menu html so here we override this 'bad' WPML filter.
			 */
			global $icl_language_switcher;
			if ( is_object( $icl_language_switcher ) ) {
				remove_filter( 'wp_page_menu', array( $icl_language_switcher, 'wp_page_menu_filter' ), 10, 2 );
				add_filter( 'wp_page_menu', array( __CLASS__, 'wp_page_menu_filter' ), 10, 2 );
			}

			/**
			 * Add header layout elements.
			 */
			add_filter( 'header_layout_elements', array( __CLASS__, 'add_header_layout_elements_filter' ) );

			/**
			 * Add lang attribute for header search form.
			 */
			add_action( 'presscore_header_searchform_fields', array( __CLASS__, 'add_header_searchform_lang_action' ) );

			/**
			 * Add parse query action before ajax response.
			 */
			add_action( 'presscore_before_ajax_response', array( __CLASS__, 'add_parse_query_action' ) );

			/**
			 * Translate frontend.
			 */

			// Post back link.
			add_filter( 'presscore_post_back_link_id', array( __CLASS__, 'presscore_post_back_link_id_filter' ) );

			/**
			 * Translate custom fields.
			 */

			// Template category.
			add_filter( 'rwmb_fancy_category_meta', array( __CLASS__, 'rwmb_fancy_category_meta_filter' ), 10, 2 );

			// Images list.
			add_filter( 'rwmb_image_advanced_mk2_meta', array( __CLASS__, 'rwmb_image_advanced_mk2_meta_filter' ) );

			// Related posts.
			add_filter( 'rwmb_taxonomy_list_meta', array( __CLASS__, 'rwmb_taxonomy_list_meta_filter' ), 10, 2 );

			// Slideshow.
			add_filter( 'rwmb__dt_slideshow_sliders_meta', array( __CLASS__, 'rwmb__dt_slideshow_sliders_meta_filter' ) );

			// Back button page.
			add_filter( 'rwmb_dropdown_pages_meta', array( __CLASS__, 'rwmb_dropdown_pages_meta_filter' ), 10, 2 );
		}

		public static function localized_script_filter( $args = array() ) {
			global $sitepress;
			if ( array_key_exists( 'ajaxurl', $args ) && is_object( $sitepress ) && method_exists( $sitepress, 'get_current_language' ) ) {
				$args['ajaxurl'] = esc_url( add_query_arg( array( 'lang' => $sitepress->get_current_language() ), $args['ajaxurl'] ) );
			}
			return $args;
		}

		public static function add_microwidget_options_filter( $options ) {
			if ( array_key_exists( 'of-header-menu', $options ) ) {
				$options['of-wpml-language-microwidget-options'] = plugin_dir_path( __FILE__ ) . 'lang-mw-options.php';
			}
			return $options;
		}

		public static function enable_editor_for_post_types_action() {
			add_post_type_support( 'dt_slideshow', 'editor' );
			add_post_type_support( 'dt_logos', 'editor' );
		}

		public static function hide_editor_for_post_types_action() {
			if ( in_array( get_post_type(), array( 'dt_slideshow', 'dt_logos' ) ) ) {
				wp_add_inline_style( 'dt-mb-magick', '#postdivrich { display: none; }' );
			}
		}

		public static function render_header_language_switcher_action() {
			echo '<div class="' . presscore_esc_implode( ' ', presscore_get_mini_widget_class( 'header-elements-language', 'mini-wpml' ) ) . '">';
				do_action('icl_language_selector');
			echo '</div>';
		}

		public static function wp_page_menu_filter( $items, $args ) {
			$obj_args = new stdClass();
			foreach ( $args as $key => $value ) {
				$obj_args->$key = $value;
			}

			return apply_filters( 'wp_nav_menu_items', $items, $obj_args );
		}

		public static function add_header_layout_elements_filter( $elements = array() ) {
			$elements['language'] = array( 'title' => _x( 'WPML language', 'theme-options', 'the7mk2' ), 'class' => '' );
			return $elements;
		}

		public static function enqueue_dynamic_stylesheets_filter( $dynamic_stylesheets ) {
			$dynamic_stylesheets['wpml.less'] = array(
				'path' => PRESSCORE_THEME_DIR . '/css/compatibility/wpml.less',
				'src' => PRESSCORE_THEME_URI . '/css/compatibility/wpml.less',
				'fallback_src' => '',
				'deps' => array(),
				'ver' => wp_get_theme()->get( 'Version' ),
				'media' => 'all'
			);
			return $dynamic_stylesheets;
		}

		public static function add_header_searchform_lang_action() {
			if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
				echo '<input type="hidden" name="lang" value="' . ICL_LANGUAGE_CODE .'"/>';
			}
		}

		public static function add_parse_query_action() {
			if ( function_exists( 'presscore_wpml_parse_query_filter' ) ) {
				add_action( 'parse_query', 'presscore_wpml_parse_query_filter' );
			}
		}

		public static function rwmb_fancy_category_meta_filter( $meta, $field = array() ) {
			// Translate terms.
			if ( isset( $meta['terms_ids'], $field['taxonomy'] ) ) {
				$meta['terms_ids'] = presscore_translate_object_id( $meta['terms_ids'], $field['taxonomy'] );
			}

			// Translate posts.
			if ( isset( $meta['posts_ids'], $field['post_type'] ) ) {
				$meta['posts_ids'] = presscore_translate_object_id( $meta['posts_ids'], $field['post_type'] );
			}

			return $meta;
		}

		public static function rwmb_image_advanced_mk2_meta_filter( $meta ) {
			return presscore_translate_object_id( $meta, 'attachment' );
		}

		public static function rwmb__dt_slideshow_sliders_meta_filter( $meta ) {
			return presscore_translate_object_id( $meta, 'dt_slideshow' );
		}

		public static function rwmb_taxonomy_list_meta_filter( $meta, $field ) {
			if ( isset( $field['options']['taxonomy'] ) ) {
				return presscore_translate_object_id( $meta, $field['options']['taxonomy'] );
			}

			return $meta;
		}

		public static function rwmb_dropdown_pages_meta_filter( $meta, $field ) {
			return presscore_translate_object_id( $meta, 'page' );
		}

		public static function presscore_post_back_link_id_filter( $page_id ) {
			return presscore_translate_object_id( $page_id, 'page' );
		}
	}

	Presscore_Modules_Compatibility_WPML::execute();

endif;
