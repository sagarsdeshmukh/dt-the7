<?php
/**
 * Theme setup.
 *
 * @package the7
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'presscore_load_theme_modules' ) ) :

	/**
	 * Load supported modules.
	 *
	 * @since 3.0.0
	 */
	function presscore_load_theme_modules() {
		$supported_modules = get_theme_support( 'presscore-modules' );
		if ( ! empty( $supported_modules[0] ) ) {

			$modules_white_list = array(
				'admin-icons-bar',
				'archive-ext',
				'compatibility',
				'mega-menu',
				'theme-update',
				'tgmpa',
				'options-wizard',
			);
			$supported_modules[0] = array_intersect( $supported_modules[0], $modules_white_list );

			foreach ( $supported_modules[0] as $module ) {
				locate_template( "inc/mods/{$module}/{$module}.php", true );
			}
		}
	}

	add_action( 'after_setup_theme', 'presscore_load_theme_modules', 10 );

endif;

if ( ! function_exists( 'presscore_setup' ) ) :

	/**
	 * Theme setup.
	 *
	 * @since 1.0.0
	 */
	function presscore_setup() {
		/**
		 * Load child theme text domain.
		 */
		if ( is_child_theme() ) {
			load_child_theme_textdomain( 'the7mk2', get_stylesheet_directory() . '/languages' );
		}

		/**
		 * Load theme text domain.
		 */
		load_theme_textdomain( 'the7mk2', get_template_directory() . '/languages' );

		/**
		 * Register custom menu.
		 */
		register_nav_menus( array(
			'primary'     => _x( 'Primary Menu', 'backend', 'the7mk2' ),
			'split_left'  => _x( 'Split Menu Left', 'backend', 'the7mk2' ),
			'split_right' => _x( 'Split Menu Right', 'backend', 'the7mk2' ),
			'mobile'      => _x( 'Mobile Menu', 'backend', 'the7mk2' ),
			'top'         => _x( 'Top Menu', 'backend', 'the7mk2' ),
			'bottom'      => _x( 'Bottom Menu', 'backend', 'the7mk2' ),
		) );

		/**
		 * Load editor style.
		 */
		add_editor_style();

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add title tag support.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Formats.
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status' ) );

		/**
		 * Enable support for various theme modules.
		 */
		presscore_enable_theme_modules();

		/**
		 * Allow shortcodes in widgets.
		 */
		add_filter( 'widget_text', 'do_shortcode' );

		/**
		 * Create upload dir.
		 */
		wp_upload_dir();

		/**
		 * Register theme template parts dir.
		 */
		presscore_template_manager()->add_path( 'theme', 'template-parts' );
	}

	add_action( 'after_setup_theme', 'presscore_setup', 5 );

endif;

/**
 * Flush rewrite rules after theme switch.
 *
 * @since 1.0.0
 */
add_action( 'after_switch_theme', 'flush_rewrite_rules' );

if ( ! function_exists( 'presscore_turn_off_custom_fields_meta' ) ) :

	/**
	 * Removes support of custom-fields for pages and posts.
	 *
	 * @since 3.0.0
	 */
	function presscore_turn_off_custom_fields_meta() {

		/**
		 * Custom fields significantly increases db load because of theme heavily uses meta fields. It's a simplest way to reduce db load.
		 */
		remove_post_type_support( 'post', 'custom-fields' );
		remove_post_type_support( 'page', 'custom-fields' );
	}

	add_action( 'init', 'presscore_turn_off_custom_fields_meta' );

endif;

if ( ! function_exists( 'presscore_enable_theme_modules' ) ) :

	/**
	 * This function add support for various theme modules.
	 *
	 * @since 3.1.4
	 */
	function presscore_enable_theme_modules() {
		$modules = array(
			'admin-icons-bar',
			'archive-ext',
			'compatibility',
			'mega-menu',
			'theme-update',
			'tgmpa',
			'options-wizard',
		);

		$pt_modules = array(
			'portfolio',
			'albums',
			'team',
			'testimonials',
			'slideshow',
			'benefits',
			'logos',
		);

		// Enable post type modules.
		foreach ( $pt_modules as $module_name ) {
			if ( 'disabled' != of_get_option( "modules-{$module_name}-status" ) ) {
				$modules[] = $module_name;
			}
		}

		add_theme_support( 'presscore-modules', $modules );
	}

endif;

if ( ! function_exists( 'presscore_add_theme_options' ) ) :

	/**
	 * Set theme options path.
	 *
	 * @since 1.0.0
	 */
	function presscore_add_theme_options() {
		return array( 'inc/admin/load-theme-options.php' );
	}

endif;

if ( ! function_exists('presscore_widgets_init') ) :

	/**
	 * Register widgetized areas.
	 *
	 * @since 1.0.0
	 */
	function presscore_widgets_init() {
		if ( function_exists( 'of_get_option' ) ) {
			$w_params = array(
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<div class="widget-title">',
				'after_title' => '</div>',
			);

			$w_areas = apply_filters( 'presscore_widgets_init-sidebars', of_get_option( 'widgetareas' ) );

			if ( ! empty( $w_areas ) && is_array( $w_areas ) ) {
				$prefix = 'sidebar_';

				foreach( $w_areas as $sidebar_id=>$sidebar ) {
					$sidebar_args = array(
						'name'          => ( isset( $sidebar['sidebar_name'] ) ? $sidebar['sidebar_name'] : '' ),
						'id'            => $prefix . $sidebar_id,
						'description'   => ( isset( $sidebar['sidebar_desc'] ) ? $sidebar['sidebar_desc'] : '' ),
						'before_widget' => $w_params['before_widget'],
						'after_widget'  => $w_params['after_widget'],
						'before_title'  => $w_params['before_title'],
						'after_title'   => $w_params['after_title'],
					);

					$sidebar_args = apply_filters( 'presscore_widgets_init-sidebar_args', $sidebar_args, $sidebar_id, $sidebar );

					register_sidebar( $sidebar_args );
				}
			}
		}
	}

	add_action( 'widgets_init', 'presscore_widgets_init' );

endif;

if ( ! function_exists( 'presscore_post_types_author_archives' ) ) :

	/**
	 * Add custom post types to author archives.
	 *
	 * @since 1.0.0
	 *
	 * @param object $query
	 */
	function presscore_post_types_author_archives( $query ) {
		/**
		 * To avoid conflicts, run this hack in frontend only.
		 */
		if ( is_admin() ) {
			return;
		}

		if ( $query->is_main_query() && $query->is_author ) {
			$new_post_types = (array) apply_filters( 'presscore_author_archive_post_types', array() );
			if ( $new_post_types ) {
				array_unshift( $new_post_types, 'post' );
				$post_type = $query->get( 'post_type' );
				if( ! $post_type ) {
					$post_type = array();
				}
				$query->set( 'post_type', array_merge( (array) $post_type, $new_post_types ) );
			}
		}
	}

	add_action( 'pre_get_posts', 'presscore_post_types_author_archives' );

endif;

if ( ! function_exists( 'presscore_add_presets' ) ) :

	/**
	 * Add theme options presets.
	 *
	 * @param array $presets
	 * @return array
	 */
	function presscore_add_presets( $presets = array() ) {
		// noimage - /images/noimage-small.jpg

		$presets_names = array(
			'skin01r',
			'skin02r',
			'skin03r',
			'skin04r',
			'skin05r',
			'skin06b',
			'skin06r',
			'skin07b',
			'skin07c',
			'skin07s',
			'skin09r',
			'skin10r',
			'skin11b',
			'skin11r',
			'skin12r',
			'skin13r',
			'skin14r',
			'skin15r',
			'skin16r',
			'skin18r',
			'skin19b',
			'skin19r',
			'skin19s',
			'skin20r',
			'skin21',

			'wizard01',
			'wizard02',
			'wizard03',
			'wizard04',
			'wizard05',
			'wizard06',
		);

		foreach( $presets_names as $preset_name ) {
			$presets[ $preset_name ] = array(
				'src'   => '/inc/presets/icons/' . $preset_name . '.gif',
				'title' => $preset_name,
			);
		}

		return $presets;
	}

	add_filter( 'optionsframework_get_presets_list', 'presscore_add_presets' );

endif;


if ( ! function_exists('presscore_set_first_run_skin') ) :

	/**
	 * Set first run skin.
	 *
	 * @since 1.0.0
	 *
	 * @param string $skin_name
	 * @return string
	 */
	function presscore_set_first_run_skin( $skin_name = '' ) {
		return 'skin07s';
	}

	add_filter( 'options_framework_first_run_skin', 'presscore_set_first_run_skin' );

endif;

if ( ! function_exists( 'presscore_set_default_contact_form_email' ) ) :

	/**
	 * Set default email for contact forms if it's not empty.
	 * See theme options General->Advanced.
	 *
	 * @since 1.1.0
	 *
	 * @param  string $email
	 * @return string
	 */
	function presscore_set_default_contact_form_email( $email = '' ) {
		$default_email = of_get_option( 'general-contact_form_send_mail_to', '' );
		if ( $default_email ) {
			$email = $default_email;
		}

		return $email;
	}

	add_filter( 'dt_core_send_mail-to', 'presscore_set_default_contact_form_email' );

endif;

if ( ! function_exists( 'presscore_dt_paginator_args_filter' ) ) :

	/**
	 * Populate paginator args.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args
	 * @return array
	 */
	function presscore_dt_paginator_args_filter( $args ) {
		$args['wrap'] = '<div class="%CLASS%" role="navigation"><div class="page-links">%LIST%</div><div class="page-nav">%PREV%%NEXT%</div></div>';
		$args['pages_wrap'] = '';
		$args['item_wrap'] = '<a href="%HREF%" %CLASS_ACT% data-page-num="%PAGE_NUM%">%TEXT%</a>';
		$args['first_wrap'] = '<a href="%HREF%" %CLASS_ACT% data-page-num="%PAGE_NUM%">%FIRST_PAGE%</a>';
		$args['last_wrap'] = '<a href="%HREF%" %CLASS_ACT% data-page-num="%PAGE_NUM%">%LAST_PAGE%</a>';
		$args['dotleft_wrap'] = '<a href="javascript:void(0);" class="dots">%TEXT%</a>';
		$args['dotright_wrap'] = '<a href="javascript:void(0);" class="dots">%TEXT%</a>';
		$args['pages_prev_class'] = 'nav-prev';
		$args['pages_next_class'] = 'nav-next';
		$args['act_class'] = 'act';
		$args['next_text'] = __( 'Next page', 'the7mk2' );
		$args['prev_text'] = __( 'Prev page', 'the7mk2' );
		$args['no_next'] = '';
		$args['no_prev'] = '';
		$args['first_is_first_mode'] = true;
		$show_all_pages = is_page() ? presscore_config()->get( 'show_all_pages' ) : '0';
		$args['num_pages'] = ( '0' == $show_all_pages ? 5 : 9999 );

		return $args;
	}

	add_filter( 'dt_paginator_args', 'presscore_dt_paginator_args_filter' );

endif;
