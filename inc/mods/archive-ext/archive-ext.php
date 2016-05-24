<?php
/**
 * Arhive templates module.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_ArchiveExtModule', false ) ) :

	class Presscore_Modules_ArchiveExtModule {

		const ARCHIVE_OPTIONS_MENU_SLUG = 'of-archives-templates-menu';

		/**
		 * Execute module.
		 */
		public static function execute() {
			add_action( 'presscore_config_base_init', array( __CLASS__, 'archive_config_action' ) );

			add_filter( 'presscore_config_post_id_filter', array( __CLASS__, 'config_page_id_filter' ) );
			add_filter( 'presscore_options_files_list', array( __CLASS__, 'add_theme_options_filter' ) );
		}

		public static function config_page_id_filter( $page_id ) {
			if ( $page_id ) {
				return $page_id;
			}

			if ( is_search() ) {
				$new_page_id = of_get_option( 'template_page_id_search', null );
			} else if ( is_category() ) {
				$new_page_id = of_get_option( 'template_page_id_blog_category', null );
			} else if ( is_tag() ) {
				$new_page_id = of_get_option( 'template_page_id_blog_tags', null );
			} else if ( is_author() ) {
				$new_page_id = of_get_option( 'template_page_id_author', null );
			} else if ( is_date() || is_day() || is_month() || is_year() ) {
				$new_page_id = of_get_option( 'template_page_id_date', null );
			} else if ( is_home() ) {
				$new_page_id = null;
			} else if ( is_single() || is_page() ) {
				$new_page_id = get_the_ID();
			} else {
				$new_page_id = $page_id;
			}

			return $new_page_id ? $new_page_id : null;
		}

		public static function archive_config_action() {
			if ( ! ( is_archive() || is_search() ) ) {
				return;
			}

			$config = presscore_get_config();

			$config->set( 'show_titles', true );
			$config->set( 'show_excerpts', true );

			$config->set( 'show_links', true );
			$config->set( 'show_details', true );
			$config->set( 'show_zoom', true );

			$config->set( 'post.meta.fields.date', true );
			$config->set( 'post.meta.fields.categories', true );
			$config->set( 'post.meta.fields.comments', true );
			$config->set( 'post.meta.fields.author', true );
			$config->set( 'post.meta.fields.media_number', true );

			$config->set( 'post.preview.width.min', 320 );
			$config->set( 'post.preview.mini_images.enabled', true );
			$config->set( 'post.preview.load.effect', 'fade_in' );
			$config->set( 'post.preview.background.enabled', true );
			$config->set( 'post.preview.background.style', 'fullwidth' );
			$config->set( 'post.preview.description.alignment', 'left' );
			$config->set( 'post.preview.description.style', 'under_image' );

			$config->set( 'post.preview.hover.animation', 'fade' );
			$config->set( 'post.preview.hover.color', 'accent' );
			$config->set( 'post.preview.hover.content.visibility', 'on_hoover' );

			$config->set( 'post.fancy_date.enabled', false );

			$config->set( 'template.columns.number', 3 );
			$config->set( 'load_style', 'default' );
			$config->set( 'image_layout', 'original' );
			$config->set( 'all_the_same_width', true );
			$config->set( 'item_padding', 10 );

			$config->set( 'layout', 'masonry' );
			$config->set( 'template.layout.type', 'masonry' );
		}

		public static function add_theme_options_filter( $files_list ) {
			if ( ! array_key_exists( self::ARCHIVE_OPTIONS_MENU_SLUG, $files_list ) ) {
				$files_list[ self::ARCHIVE_OPTIONS_MENU_SLUG ] = plugin_dir_path( __FILE__ ) . 'options-archive.php';
			}
			return $files_list;
		}
	}

	Presscore_Modules_ArchiveExtModule::execute();

endif;

if ( ! function_exists( 'presscore_module_archive_get_menu_slug' ) ) :

	function presscore_module_archive_get_menu_slug() {
		return Presscore_Modules_ArchiveExtModule::ARCHIVE_OPTIONS_MENU_SLUG;
	}

endif;
