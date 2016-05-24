<?php
/**
 * Dynamic stylesheets functions.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_get_dynamic_stylesheets_list' ) ) :

	function presscore_get_dynamic_stylesheets_list() {

		static $dynamic_stylesheets = null;

		if ( null === $dynamic_stylesheets ) {

			$template_uri = PRESSCORE_THEME_URI;
			$template_directory = PRESSCORE_THEME_DIR;

			$theme_version = wp_get_theme()->get( 'Version' );

			$dynamic_stylesheets = array();

			$dynamic_stylesheets['dt-custom-old-ie.less'] = array(
				'path' => $template_directory . '/css/custom-old-ie.less',
				'src' => $template_uri . '/css/custom-old-ie.less',
				'fallback_src' => $template_uri . '/css/compiled/custom-old-ie-%preset%.css',
				'deps' => array(),
				'ver' => $theme_version,
				'media' => 'all'
			);

			$dynamic_stylesheets['dt-custom.less'] = array(
				'path' => $template_directory . '/css/custom.less',
				'src' => $template_uri . '/css/custom.less',
				'fallback_src' => $template_uri . '/css/compiled/custom-%preset%.css',
				'deps' => array(),
				'ver' => $theme_version,
				'media' => 'all'
			);

			if ( dt_is_woocommerce_enabled() ) {

				$dynamic_stylesheets['wc-dt-custom.less'] = array(
					'path' => $template_directory . '/css/compatibility/wc-dt-custom.less',
					'src' => $template_uri . '/css/compatibility/wc-dt-custom.less',
					'fallback_src' => $template_uri . '/css/compiled/compatibility/wc-dt-custom-%preset%.css',
					'deps' => array(),
					'ver' => $theme_version,
					'media' => 'all'
				);

			}

			if ( presscore_responsive() ) {

				$dynamic_stylesheets['dt-media.less'] = array(
					'path' => $template_directory . '/css/media.less',
					'src' => $template_uri . '/css/media.less',
					'fallback_src' => $template_uri . '/css/compiled/media-%preset%.css',
					'deps' => array(),
					'ver' => $theme_version,
					'media' => 'all'
				);

			}

		}

		return apply_filters( 'presscore_get_dynamic_stylesheets_list', $dynamic_stylesheets );
	}

endif;

if ( ! function_exists('presscore_generate_less_css_file_after_options_save') ) :

	/**
	 * Update custom.less stylesheet.
	 *
	 */
	function presscore_generate_less_css_file_after_options_save() {
		$css_is_writable = apply_filters( 'presscore_less_cache_writable', true );

		$set = get_settings_errors( 'options-framework' );
		if ( ! empty( $set ) ) {

			$dynamic_stylesheets = presscore_get_dynamic_stylesheets_list();

			foreach ( $dynamic_stylesheets as $stylesheet_handle=>$stylesheet ) {

				presscore_generate_less_css_file( $stylesheet_handle, $stylesheet['src'] );
			}

			if ( $css_is_writable ) {
				add_settings_error( 'presscore-wp-less', 'save_stylesheet', _x( 'Stylesheet saved.', 'backend', 'the7mk2' ), 'updated fade' );
			}
		}

	}
	add_action( 'admin_init', 'presscore_generate_less_css_file_after_options_save', 11 );

endif; // presscore_generate_less_css_file_after_options_save

if ( ! function_exists( 'presscore_generate_less_css_file' ) ) :

	/**
	 * Update custom.less stylesheet.
	 */
	function presscore_generate_less_css_file( $handler = 'dt-custom.less', $src = '' ) {

		/**
		 * Include WP-Less.
		 *
		 */
		require_once( PRESSCORE_EXTENSIONS_DIR . '/wp-less/bootstrap-for-theme.php' );

		// WP-Less init
		if ( class_exists('WPLessPlugin') ) {
			$less = WPLessPlugin::getInstance();
			$less->dispatch();
		} else {
			return false;
		}

		/**
		 * Less helpers.
		 *
		 * @since presscore 1.0.6
		 */
		require_once( PRESSCORE_EXTENSIONS_DIR . '/less-vars/less-functions.php' );

		/**
		 * Less variables.
		 *
		 * @since presscore 0.5
		 */
		if ( $located_file = locate_template( 'inc/less-vars.php' ) ) {
			include_once( $located_file );
		}

		// $less = WPLessPlugin::getInstance();
		$config = $less->getConfiguration();

		if ( !wp_style_is($handler, 'registered') ) {

			if ( !$src ) {
				$src = PRESSCORE_THEME_URI . '/css/custom.less';
			}

			wp_register_style( $handler, $src );
		}

		// save options
		$options = presscore_compile_less_vars();

		if ( $options ) {
			$less->setVariables( $options );
		}

		$less->setImportDir( PRESSCORE_THEME_DIR . '/css' );
		WPLessStylesheet::$upload_dir = $config->getUploadDir();
		WPLessStylesheet::$upload_uri = $config->getUploadUrl();

		return $less->processStylesheet( $handler, true );
	}

endif;

if ( !function_exists('dt_make_relative_image_path') ) :

	/**
	 * Make image path relative.
	 *
	 */
	function dt_make_relative_image_path( $content = '', $stylesheet ) {

		if ( ! apply_filters( 'presscore_less_cache_writable', true ) ) {
			return $content;
		}

		$http_content_url = set_url_scheme( content_url(), 'http' );
		$https_content_url = set_url_scheme( $http_content_url, 'https' );
		$http_source_url = set_url_scheme( dirname( $stylesheet->getSourceUri() ), 'http' );

		// stylesheet path relative to wp content url
		$stylesheet_path = str_replace( $http_content_url, '', $http_source_url );
		$relative_path = implode( '/', array_fill( 0, count( explode( '/', $stylesheet_path ) ), '..' ) );

		// replace wp content url with relative path
		$content = str_replace( array( $http_content_url, $https_content_url ), $relative_path, $content );

		return $content;
	}
	add_filter( 'wp-less_stylesheet_save', 'dt_make_relative_image_path', 99, 2 );

endif;

if ( ! function_exists( 'presscore_get_dynamic_stylesheet_cache' ) ) :

	/**
	 * Returns dynamic stylesheet cache.
	 *
	 * @since 1.0.0
	 * 
	 * @param  string $stylesheet_handle Stylesheet handler
	 * @param  string $stylesheet_path   Stylesheet path
	 * @param  string $stylesheet_src    Stylesheet url
	 * @param  string $fallback_src      Fallback stylesheet url
	 * @return string                    Cahced css
	 */
	function presscore_get_dynamic_stylesheet_cache( $stylesheet_handle, $stylesheet_path, $stylesheet_src, $fallback_src = '' ) {
		$stylesheet_path_hash = md5( $stylesheet_path );
		$stylesheet_cache_name = 'wp_less_stylesheet_data_' . $stylesheet_path_hash;
		$stylesheet_cache = get_option( $stylesheet_cache_name );
		$fallback_path = str_replace( PRESSCORE_THEME_URI, PRESSCORE_THEME_DIR, $fallback_src );

		// regenerate less files if needed
		if (
			( defined('DT_ALWAYS_REGENERATE_DYNAMIC_CSS') && DT_ALWAYS_REGENERATE_DYNAMIC_CSS ) 
			|| 
			( ( ! $fallback_path || ! file_exists( $fallback_path ) ) && !$stylesheet_cache )
		) {

			presscore_generate_less_css_file( $stylesheet_handle, $stylesheet_src );
			$stylesheet_cache = get_option( $stylesheet_cache_name );
		}

		return $stylesheet_cache;
	}

endif;

if ( ! function_exists( 'presscore_enqueue_dynamic_stylesheets' ) ) :

	/**
	 * Enqueue *.less files
	 */
	function presscore_enqueue_dynamic_stylesheets(){

		$dynamic_stylesheets = presscore_get_dynamic_stylesheets_list();
		$preset = of_get_option( 'preset', presscore_set_first_run_skin() );

		foreach ( $dynamic_stylesheets as $stylesheet_handle=>$stylesheet ) {

			$stylesheet_path_hash = md5( $stylesheet['path'] );
			$stylesheet_cache_name = 'wp_less_stylesheet_data_' . $stylesheet_path_hash;
			$stylesheet_cache = get_option( $stylesheet_cache_name );
			$fallback_path = str_replace( array( PRESSCORE_THEME_URI, '%preset%' ), array( PRESSCORE_THEME_DIR, esc_attr( $preset ) ), $stylesheet['fallback_src'] );

			// regenerate less files if needed
			if (
				( defined('DT_ALWAYS_REGENERATE_DYNAMIC_CSS') && DT_ALWAYS_REGENERATE_DYNAMIC_CSS ) 
				|| 
				( ( ! $fallback_path || ! file_exists( $fallback_path ) ) && !$stylesheet_cache )
			) {

				try {
					presscore_generate_less_css_file( $stylesheet_handle, $stylesheet['src'] );
				} catch ( Exception $e ) {
					continue;
					// wp_die( 'Incorrect less var!' );
				}

				$stylesheet_cache = get_option( $stylesheet_cache_name );
			}

			// enqueue stylesheets
			presscore_enqueue_dynamic_style( array( 'handle' => $stylesheet_handle, 'cache' => $stylesheet_cache, 'stylesheet' => $stylesheet ) );
		}

		do_action( 'presscore_enqueue_dynamic_stylesheets' );

	}

endif;

if ( ! function_exists( 'presscore_enqueue_dynamic_style' ) ) :

	function presscore_enqueue_dynamic_style( $args = array() ) {

		$stylesheet = empty( $args['stylesheet'] ) ? array() : $args['stylesheet'];
		$handle = empty( $args['handle'] ) ? '' : $args['handle'];

		if ( empty( $stylesheet ) || empty( $handle )) {
			return;
		}

		$stylesheet_cache = empty( $args['cache'] ) ? array() : $args['cache'];

		// less stylesheet
		if ( apply_filters( 'presscore_less_cache_writable', true ) && isset($stylesheet_cache['target_uri']) ) {

			$stylesheet_src = set_url_scheme( $stylesheet_cache['target_uri'], is_ssl() ? 'https' : 'http' );
			wp_enqueue_style( $handle, $stylesheet_src, $stylesheet['deps'], $stylesheet['ver'], $stylesheet['media'] );

		// print custom css inline
		} elseif ( !empty($stylesheet_cache['compiled']) ) {

			$inline_stylesheet = $stylesheet_cache['compiled'];
			if ( is_ssl() ) {
				$inline_stylesheet = str_replace( site_url('', 'http'), site_url('', 'https'), $inline_stylesheet );
			}

			wp_add_inline_style( 'dt-main', $inline_stylesheet );
		} elseif ( !empty($stylesheet['fallback_src']) ) {

			// get current skin name
			$preset = of_get_option( 'preset', presscore_set_first_run_skin() );

			$fallback_src = str_replace('%preset%', esc_attr( $preset ), $stylesheet['fallback_src']);

			// load skin precompiled css
			wp_enqueue_style( $handle, $fallback_src, $stylesheet['deps'], $stylesheet['ver'], $stylesheet['media'] );
		}

	}

endif;

if ( ! function_exists( 'presscore_filter_wp_less_source_path' ) ) :

	function presscore_filter_wp_less_source_path( $path = '', $stylesheet = null ) {

		if ( $stylesheet ) {
			$dynamic_stylesheets = presscore_get_dynamic_stylesheets_list();
			$handle = $stylesheet->handle;
			if ( 
				array_key_exists( $handle , $dynamic_stylesheets ) 
				&& ! empty( $dynamic_stylesheets[ $handle ]['path'] )
			 ) {
				$path = $dynamic_stylesheets[ $handle ]['path'];
			}
		}

		return $path;
	}

	add_filter( 'wp-less_stylesheet_source_path', 'presscore_filter_wp_less_source_path', 10, 2 );

endif;
