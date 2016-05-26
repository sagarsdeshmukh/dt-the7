<?php
/**
 * Frontend functions.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/////////////////////
// Enqueue scripts //
/////////////////////

if ( ! function_exists( 'presscore_enqueue_scripts' ) ) :

	/**
	 * Enqueue scripts and styles.
	 */
	function presscore_enqueue_scripts() {
		global $wp_styles;

		// Enqueue web fonts if needed.
		presscore_enqueue_web_fonts();

		presscore_enqueue_theme_stylesheet( 'dt-main', 'css/main' );

		// Get theme config.
		$config = presscore_config();

		// Loader inline css.
		if ( $config->get_bool( 'template.beautiful_loading.enabled' ) ) {
			wp_add_inline_style( 'dt-main', presscore_get_loader_inline_css() );
		}

		presscore_enqueue_theme_stylesheet( 'dt-old-ie', 'css/old-ie' );
		$wp_styles->add_data( 'dt-old-ie', 'conditional', 'lt IE 10' );

		// Enqueue fonts.
		presscore_enqueue_theme_stylesheet( 'dt-awsome-fonts', 'fonts/FontAwesome/css/font-awesome' );

		if ( locate_template( 'fonts/fontello/css/fontello.css', false ) ) {
			presscore_enqueue_theme_stylesheet( 'dt-fontello', 'fonts/fontello/css/fontello' );
		}

		// 3D slide show css.
		if ( 'slideshow' == $config->get( 'header_title' ) && '3d' == $config->get( 'slideshow_mode' ) ) {
			presscore_enqueue_theme_stylesheet( 'dt-3d-slider', 'css/compatibility/3D-slider' );
		}

		wp_enqueue_style( 'style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

		// Enqueue base js.
		presscore_enqueue_theme_script( 'dt-above-fold', 'js/above-the-fold', array( 'jquery' ), false, false );
		presscore_enqueue_theme_script( 'dt-main', 'js/main', array( 'jquery' ), false, true );

		// Queue dt-main js first.
		global $wp_scripts;

		$dt_main_key = array_search( 'dt-main', $wp_scripts->queue );
		if ( $dt_main_key !== false ) {
			unset( $wp_scripts->queue[ $dt_main_key ] );
		}

		array_unshift( $wp_scripts->queue, 'dt-main' );

		// Detect device type.
		/* @todo Seems that it's not in yse. If so - remove it. */
		$detect = new Mobile_Detect;
		$device_type = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		$config->set( 'device_type', $device_type );

		if ( is_page() ) {
			$page_data = array(
				'type' => 'page',
				'template' => $config->get('template'),
				'layout' => $config->get('justified_grid') ? 'jgrid' : $config->get('layout')
			);
		} else if ( is_archive() ) {
			$page_data = array(
				'type' => 'archive',
				'template' => $config->get('template'),
				'layout' => $config->get('justified_grid') ? 'jgrid' : $config->get('layout')
			);
		} else if ( is_search() ) {
			$page_data = array(
				'type' => 'search',
				'template' => $config->get('template'),
				'layout' => $config->get('justified_grid') ? 'jgrid' : $config->get('layout')
			);
		} else {
			$page_data = false;
		}

		global $post;

		$dt_local = array(
			'themeUrl' => get_template_directory_uri(),
			'passText' => __( 'To view this protected post, enter the password below:', 'the7mk2' ),
			'moreButtonText' => array(
				'loading' => __( 'Loading...', 'the7mk2' ),
			),
			'postID' => empty( $post->ID ) ? null : $post->ID,
			'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'contactNonce' => wp_create_nonce('dt_contact_form'),
			'ajaxNonce' => wp_create_nonce('presscore-posts-ajax'),
			'pageData' => $page_data,
			'themeSettings' => array(
				'smoothScroll' => of_get_option('general-smooth_scroll', 'on'),
				'lazyLoading' => ( 'lazy_loading' === $config->get( 'load_style' ) ),
				'accentColor' => array(),
				'floatingHeader' => array(
					'showAfter' => $config->get( 'header.floating_navigation.show_after' ),
					'showMenu' => ( dt_sanitize_flag( $config->get( 'header.floating_navigation.enabled' ) ) ),
					'height' => of_get_option( 'header-floating_navigation-height' ),
				),
				'mobileHeader' => array(
					'firstSwitchPoint' => of_get_option( 'header-mobile-first_switch-after', 1024 ),
					'secondSwitchPoint' => of_get_option( 'header-mobile-second_switch-after', 200 )
				),
				'content' => array(
					'responsivenessTreshold' => of_get_option( 'general-responsiveness-treshold', 800 ),
					'textColor' => of_get_option( 'content-primary_text_color', '#000000' ),
					'headerColor' => of_get_option( 'content-headers_color', '#000000' )
				),
				'stripes' => array(
					'stripe1' => array(
						'textColor' => of_get_option( 'stripes-stripe_1_text_color', '#000000' ),
						'headerColor' => of_get_option( 'stripes-stripe_1_headers_color', '#000000' )
					),
					'stripe2' => array(
						'textColor' => of_get_option( 'stripes-stripe_2_text_color', '#000000' ),
						'headerColor' => of_get_option( 'stripes-stripe_2_headers_color', '#000000' )
					),
					'stripe3' => array(
						'textColor' => of_get_option( 'stripes-stripe_3_text_color', '#000000' ),
						'headerColor' => of_get_option( 'stripes-stripe_3_headers_color', '#000000' )
					),
				),
			),
		);

		// floating menu
		$dt_local['themeSettings']['floatingHeader']['logo'] = array(
			'showLogo'      => ( 'none' !== $config->get( 'header.floating_navigation.logo.style' ) ),
			'html'          => presscore_get_logo_image( presscore_get_floating_menu_logos_meta() ),
		);

		switch ( $config->get( 'template.accent.color.mode' ) ) {
			case 'gradient':
				$dt_local['themeSettings']['accentColor']['mode'] = 'gradient';
				$dt_local['themeSettings']['accentColor']['color'] = of_get_option( 'general-accent_bg_color_gradient', array( '#000000', '#000000' ) );
				break;
			case 'color':
			default:
				$dt_local['themeSettings']['accentColor']['mode'] = 'solid';
				$dt_local['themeSettings']['accentColor']['color'] = of_get_option( 'general-accent_bg_color', '#000000' );
		}

		$dt_local = apply_filters( 'presscore_localized_script', $dt_local );

		wp_localize_script( 'dt-above-fold', 'dtLocal', $dt_local );

		// Comments clear script.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Add custom css from theme options.
		$custom_css = of_get_option( 'general-custom_css', '' );
		if ( $custom_css ) {
			wp_add_inline_style( 'style', $custom_css );
		}
	}

endif;

add_action( 'wp_enqueue_scripts', 'presscore_enqueue_scripts', 15 );

/**
 * Enqueue dynamic stylesheets.
 *
 * @since 3.7.1
 * @see dynamic-styleheets-functions.php
 */
add_action( 'wp_enqueue_scripts', 'presscore_enqueue_dynamic_stylesheets', 20 );

if ( ! function_exists( 'presscore_print_beautiful_loading_scripts_in_footer' ) ):

	function presscore_print_beautiful_loading_scripts_in_footer() {
?>
<script type="text/javascript">
jQuery(function($) {
	var $window = $(window),
		$load = $("#load");
	
	$window.removeLoading = setTimeout(function() {
		$load.addClass("loader-removed").fadeOut(500);
	}, 500);
	
	$window.one("dt.removeLoading", function() {
		if (!$load.hasClass("loader-removed")) {
			clearTimeout($window.removeLoading);
			$("#load").addClass("loader-removed").fadeOut(500);
		}
	});
});
</script>
<?php
	}

	add_action( 'wp_head', 'presscore_print_beautiful_loading_scripts_in_footer', 20 );

endif;

/**
 * Add new body classes.
 *
 */
if ( ! function_exists( 'presscore_body_class' ) ) :

	function presscore_body_class( $classes ) {
		$config = Presscore_Config::get_instance();
		$desc_on_hoover = ( 'under_image' != $config->get('post.preview.description.style') );
		$template = $config->get('template');
		$layout = $config->get('layout');

		///////////////////////
		// template classes //
		///////////////////////

		switch ( $template ) {
			case 'blog':
				$classes[] = 'blog';
				break;
			case 'portfolio': $classes[] = 'portfolio'; break;
			case 'team': $classes[] = 'team'; break;
			case 'testimonials': $classes[] = 'testimonials'; break;
			case 'archive': $classes[] = 'archive'; break;
			case 'search': $classes[] = 'search'; break;
			case 'albums': $classes[] = 'albums'; break;
			case 'media': $classes[] = 'media'; break;
			case 'microsite': $classes[] = 'one-page-row'; break;
		}

		/////////////////////
		// layout classes //
		/////////////////////

		switch ( $layout ) {
			case 'masonry':
				if ( $desc_on_hoover ) {
					$classes[] = 'layout-masonry-grid';

				} else {
					$classes[] = 'layout-masonry';
				}
				break;
			case 'grid':
				$classes[] = 'layout-grid';
				if ( $desc_on_hoover ) {
					$classes[] = 'grid-text-hovers';
				}
				break;
			case 'checkerboard':
			case 'list':
			case 'right_list':
				$classes[] = 'layout-list';
				break;
		}

		////////////////////
		// hover classes //
		////////////////////

		if ( in_array($layout, array('masonry', 'grid')) && !in_array($template, array('testimonials', 'team')) ) {
			$classes[] = $desc_on_hoover ? 'description-on-hover' : 'description-under-image';
		}

		//////////////////////////////////////
		// hide dividers if content is off //
		//////////////////////////////////////

		if ( in_array($config->get('template'), array('albums', 'portfolio')) && 'masonry' == $config->get('layout') ) {
			$show_dividers = $config->get('show_titles') || $config->get('show_details') || $config->get('show_excerpts') || $config->get('show_terms') || $config->get('show_links');
			if ( !$show_dividers ) {
				$classes[] = 'description-off';
			}
		}

		/////////////////////
		// single classes //
		/////////////////////

		if ( is_single() && ( post_password_required() || ( ! comments_open() && '0' == get_comments_number() ) ) ) {
			$classes[] = 'no-comments';
		}

		////////////////////////
		// header background //
		////////////////////////

		if ( presscore_mixed_header_with_top_line() ) {
			$classes[] = 'header-top-line-active';
		}

		if ( presscore_header_with_bg() && ( presscore_mixed_header_with_top_line() || ! presscore_header_layout_is_side() ) ) {

			switch ( $config->get('header_background') ) {
				case 'overlap':
					$classes['header_background'] = 'overlap';
					break;
				case 'transparent':
					$classes['header_background'] = 'transparent';

					if ( 'light' === $config->get( 'header.transparent.color_scheme' ) ) {
						$classes[] = 'light-preset-color';
					}

					break;
			}

			if (
				$config->get_bool( 'header.slideshow.header_below' ) 
				&& 'slideshow' === $config->get( 'header_title' ) 
				&& in_array( $config->get( 'header_background' ), array( 'transparent', 'normal' ) ) 
			) {
				$classes[] = 'floating-navigation-below-slider';
			}

		}

		///////////////////
		// header title //
		///////////////////

		if ( 'fancy' == $config->get( 'header_title' ) ) {
			$classes[] = 'fancy-header-on';

		} elseif ( 'slideshow' == $config->get( 'header_title' ) ) {
			$classes[] = 'slideshow-on';

			if ( '3d' == $config->get( 'slideshow_mode' ) && 'fullscreen-content' == $config->get( 'slideshow_3d_layout' ) ) {
				$classes[] = 'threed-fullscreen';

			}

			if ( dt_get_paged_var() > 1 && isset($classes['header_background']) ) {
				unset($classes['header_background']);

			}

		} elseif ( is_single() && 'disabled' == $config->get( 'header_title' ) ) {
			$classes[] = 'title-off';

		}

		///////////////////
		// hover style //
		///////////////////

		switch( $config->get( 'template.images.hover.style' ) ) {
			case 'grayscale': $classes[] = 'filter-grayscale-static'; break;
			case 'gray_color': $classes[] = 'filter-grayscale'; break;
			case 'blur' : $classes[] = 'image-blur'; break;
			case 'scale' : $classes[] = 'scale-on-hover'; break;
		}

		// default hover icons
		switch ( $config->get( 'template.images.hover.icon' ) ) {
			case 'none':
				$classes[] = 'disabled-hover-icons';
				break;
			case 'small_corner':
				$classes[] = 'small-hover-icons';
				break;
			case 'big_center':
				$classes[] = 'large-hover-icons';
				break;
		}

		if ( $config->get( 'template.images.hover.animation' ) ) {
			$classes[] = 'click-effect-on-img';
		}

		////////////
		// boxed //
		////////////

		if ( 'boxed' == $config->get( 'template.layout' ) ) {
			$classes[] = 'boxed-layout';
		}

		/////////////////////
		// responsiveness //
		/////////////////////

		if ( !presscore_responsive() ) {
			$classes[] = 'responsive-off';
		}

		/////////////////////
		// justified grid //
		/////////////////////

		if ( $config->get( 'justified_grid' ) ) {
			$classes[] = 'justified-grid';
		}

		////////////////////
		// header layout //
		////////////////////

		switch ( $config->get( 'header.position' ) ) {
			case 'right':
				$classes[] = 'header-side-right';
				break;
			case 'left':
				$classes[] = 'header-side-left';
				break;
		}

		switch ( $config->get( 'header.layout' ) ) {
			case 'slide_out':
				$classes[] = 'sticky-header';
				break;
			case 'overlay':
				$classes[] = 'overlay-navigation';
				break;
		}

		switch ( $config->get( 'header.layout.slide_out.animation' ) ) {
			case 'fade':
				$classes[] = 'fade-header-animation';
				break;
			case 'move':
				$classes[] = 'move-header-animation';
				break;
			case 'slide':
				$classes[] = 'slide-header-animation';
				break;
		}

		if ( 'side_line' === $config->get( 'header.mixed.view' ) ) {
			$classes[] = 'header-side-line';

			switch ( $config->get( 'header.mixed.view.side_line.position' ) ) {
				case 'above':
					$classes[] = 'header-above-side-line';
					break;
				case 'under':
					$classes[] = 'header-under-side-line';
					break;
			}
		}

		if ( $config->get( 'header.layout.slide_out.x_cursor.enabled' ) ) {
			$classes[] = 'overlay-cursor-on';
		}

		//////////////////////
		// accent gradient //
		//////////////////////

		if ( 'gradient' == $config->get( 'template.accent.color.mode' ) ) {
			$classes[] = 'accent-gradient';
		}

		//////////////////////////////
		// srcset based hd images //
		//////////////////////////////

		$classes[] = 'srcset-enabled';

		///////////////
		// buttons //
		///////////////

		// buttons style
		switch ( $config->get( 'buttons.style' ) ) {
			case '3d':
				$classes[] = 'btn-3d';
				break;
			case 'flat':
				$classes[] = 'btn-flat';
				break;
			case 'material':
				$classes[] = 'btn-material';
				break;
			case 'ios7':
			default:
				$classes[] = 'btn-ios';
				break;
		}

		// buttons text color
		switch ( $config->get( 'buttons.text.color' ) ) {
			case 'accent':
				$classes[] = 'accent-btn-color';
				break;
			case 'color':
				$classes[] = 'custom-btn-color';
				break;
		}

		// buttons hover text color
		switch ( $config->get( 'buttons.hover.text.color' ) ) {
			case 'accent':
				$classes[] = 'accent-btn-hover-color';
				break;
			case 'color':
				$classes[] = 'custom-btn-hover-color';
				break;
		}

		if ( $config->get( 'template.footer.background.slideout_mode' ) ) {
			$classes[] = 'footer-overlap';
		}

		////////////////////////
		// content boxes bg //
		////////////////////////

		switch ( $config->get( 'template.content.boxes.background.decoration' ) ) {
			case 'shadow':
				$classes[] = 'shadow-element-decoration';
				break;
			case 'outline':
				$classes[] = 'outline-element-decoration';
				break;
		}

		////////////////////
		// filter style //
		////////////////////

		switch ( $config->get( 'template.posts_filter.style' ) ) {
			case 'ios':
				$classes[] = 'filter-style-ios';
				break;
			case 'minimal':
				$classes[] = 'filter-style-minimal';
				break;
			case 'material':
				$classes[] = 'filter-style-material';
				break;
		}

		//////////////////////////
		// contact form style //
		//////////////////////////

		switch ( $config->get( 'template.contact_form.style' ) ) {
			case 'ios':
				$classes[] = 'contact-form-ios';
				break;
			case 'minimal':
				$classes[] = 'contact-form-minimal';
				break;
			case 'material':
				$classes[] = 'contact-form-material';
				break;
		}

		///////////////////////
		// fancy date size //
		///////////////////////

		if ( 'small' == $config->get( 'post.fancy_date.size' ) ) {
			$classes[] = 'small-fancy-datas';
		} else {
			$classes[] = 'large-fancy-datas';
		}

		if ( $config->get_bool( 'header.layout.slide_out.blur.enabled' ) ) {
			$classes[] = 'blur-page';
		}

		///////////////////////////////
		// slideshow bullets style //
		///////////////////////////////

		switch ( $config->get( 'slideshow.bullets.style' ) ) {
			case 'transparent':
				$classes[] = 'semitransparent-bullets';
				break;
			case 'accent':
				$classes[] = 'accent-bullets';
				break;
			case 'outline':
				$classes[] = 'outlines-bullets';
				break;
		}

		///////////////////
		// icons style //
		///////////////////

		switch ( $config->get( 'template.icons.style' ) ) {
			case 'bold':
				$classes[] = 'bold-icons';
				break;
			case 'light':
				$classes[] = 'light-icons';
				break;
		}

		/////////////////////
		// floating menu //
		/////////////////////

		if ( $config->get( 'header.floating_navigation.enabled' ) ) {

			$classes[] = presscore_array_value( $config->get( 'header.floating_navigation.style' ), array(
				'fade'   => 'phantom-fade',
				'slide'  => 'phantom-slide',
				'sticky' => 'phantom-sticky',
			) );

			$classes[] = presscore_array_value( $config->get( 'header.floating_navigation.decoraion' ), array(
				'disabled' => 'phantom-disable-decoration',
				'shadow'   => 'phantom-shadow-decoration',
				'line'     => 'phantom-line-decoration',
			) );

			$classes[] = presscore_array_value( $config->get( 'header.floating_navigation.logo.style' ), array(
				'custom' => 'phantom-custom-logo-on',
				'main'   => 'phantom-main-logo-on',
				'none'   => 'phantom-logo-off',
			) );

		}

		$classes[] = presscore_array_value( $config->get( 'header.mobile.floatin_navigation' ), array(
			'sticky'    => 'sticky-mobile-header',
			'menu_icon' => 'floating-mobile-menu-icon',
		) );

		////////////////////////////////////
		// Sidebar and footer on mobile //
		////////////////////////////////////

		if ( 'disabled' != $config->get( 'sidebar_position' ) && $config->get( 'sidebar_hide_on_mobile' ) ) {
			$classes[] = 'mobile-hide-sidebar';
		}

		if ( $config->get( 'footer_show' ) && $config->get( 'footer_hide_on_mobile' ) ) {
			$classes[] = 'mobile-hide-footer';
		}

		if ( in_array( $config->get( 'header.layout' ), array( 'classic', 'inline', 'split' ) ) ) {
			$classes[] = 'top-header';
		}

		// mobile logo
		$classes[] = presscore_array_value( $config->get( 'header.mobile.logo.first_switch.layout' ), array(
			'left_right' => 'first-switch-logo-right first-switch-menu-left',
			'left_center' => 'first-switch-logo-center first-switch-menu-left',
			'right_left' => 'first-switch-logo-left first-switch-menu-right',
			'right_center' => 'first-switch-logo-center first-switch-menu-right',
		) );

		$classes[] = presscore_array_value( $config->get( 'header.mobile.logo.second_switch.layout' ), array(
			'left_right' => 'second-switch-logo-right second-switch-menu-left',
			'left_center' => 'second-switch-logo-center second-switch-menu-left',
			'right_left' => 'second-switch-logo-left second-switch-menu-right',
			'right_center' => 'second-switch-logo-center second-switch-menu-right',
		) );

		if ( 'right' === $config->get( 'header.mobile.menu.align' ) ) {
			$classes[] = 'right-mobile-menu';
		}

		if ( presscore_lazy_loading_enabled() ) {
			$classes[] = 'layzr-loading-on';
		}

		if ( ! get_option( 'show_avatars' ) ) {
			$classes[] = 'no-avatars';
		}

		/////////////
		// return //
		/////////////

		return array_values( array_unique( $classes ) );
	}
	add_filter( 'body_class', 'presscore_body_class' );

endif;

if ( ! function_exists( 'presscore_get_blank_image' ) ) :

	/**
	 * Get blank image.
	 *
	 */
	function presscore_get_blank_image() {
		return PRESSCORE_THEME_URI . '/images/1px.gif';
	}

endif; // presscore_get_blank_image

if ( ! function_exists( 'presscore_get_default_avatar' ) ) :

	/**
	 * Get default avatar.
	 *
	 * @return string.
	 */
	function presscore_get_default_avatar() {
		return PRESSCORE_THEME_URI . '/images/no-avatar.gif';
	}

endif; // presscore_get_default_avatar

if ( !function_exists('presscore_get_default_image') ) :

	/**
	 * Get default image.
	 *
	 * Return array( 'url', 'width', 'height' );
	 *
	 * @return array.
	 */
	function presscore_get_default_image() {
		return array( PRESSCORE_THEME_URI . '/images/noimage.jpg', 1000, 700 );
	}

endif;

if ( !function_exists('presscore_get_default_thumbnail_image') ) :

	/**
	 * Get default image.
	 *
	 * Return array( 'url', 'width', 'height' );
	 *
	 * @return array.
	 */
	function presscore_get_default_thumbnail_image() {
		return array( PRESSCORE_THEME_URI . '/images/noimage-thumbnail.jpg', 150, 150 );
	}

endif;

if ( !function_exists('presscore_get_default_small_image') ) :

	/**
	 * Get default image.
	 *
	 * Return array( 'url', 'width', 'height' );
	 *
	 * @return array.
	 */
	function presscore_get_default_small_image() {
		return array( PRESSCORE_THEME_URI . '/images/noimage-small.jpg', 119, 119 );
	}

endif;

if ( ! function_exists( 'presscore_get_widgetareas_options' ) ) :

	/**
	 * Prepare array with widgetareas options.
	 *
	 */
	function presscore_get_widgetareas_options() {
		global $wp_registered_sidebars;

		return wp_list_pluck( $wp_registered_sidebars, 'name', 'id' );
	}

endif; // presscore_get_widgetareas_options

if ( ! function_exists( 'presscore_enqueue_web_fonts' ) ) :

	/**
	 * Web fonts override.
	 *
	 */
	function presscore_enqueue_web_fonts() {
		$fonts = array();
		$options = _optionsframework_get_clean_options();
		foreach ( $options as $option ) {
			if ( 'web_fonts' === $option['type'] ) {
				// Replace &amp; coz in db value sanitized with esc_attr().
				$fonts[] = str_replace( '&amp;', '&', of_get_option( $option['id'] ) );
			}
		}

		$fonts_compressor = new Presscore_Web_Fonts_Compressor();
		$compressed_fonts = $fonts_compressor->compress_fonts( presscore_filter_web_fonts( $fonts ) );

		wp_enqueue_style( 'dt-web-fonts', dt_make_web_font_uri( $compressed_fonts ) );
	}

endif;

if ( ! function_exists( 'presscore_filter_web_fonts' ) ) :

	function presscore_filter_web_fonts( $fonts ) {

		$web_fonts = array();
		foreach ( $fonts as $font ) {
			if ( dt_stylesheet_maybe_web_font( $font ) ) {
				$web_fonts[] = $font;
			}
		}

		return $web_fonts;
	}

endif;

if ( ! function_exists( 'presscore_comment_id_fields_filter' ) ) :

	/**
	 * PressCore comments fields filter. Add Post Comment and clear links before hudden fields.
	 *
	 * @since presscore 0.1
	 */
	function presscore_comment_id_fields_filter( $result ) {

		$comment_buttons = presscore_get_button_html( array( 'href' => 'javascript:void(0);', 'title' => __( 'clear form', 'the7mk2' ), 'class' => 'clear-form' ) );
		$comment_buttons .= presscore_get_button_html( array( 'href' => 'javascript:void(0);', 'title' => __( 'Submit', 'the7mk2' ), 'class' => 'dt-btn dt-btn-m' ) );

		return $comment_buttons . $result;
	}

endif; // presscore_comment_id_fields_filter

add_filter( 'comment_id_fields', 'presscore_comment_id_fields_filter' );

if ( ! function_exists( 'presscore_add_compat_header' ) ) {

	add_filter( 'wp_headers', 'presscore_add_compat_header' );

	/**
	 * [presscore_add_compat_header description]
	 * 
	 * @param  array $headers
	 * @return array
	 */
	function presscore_add_compat_header( $headers ) {
		if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false) {
			$headers['X-UA-Compatible'] = 'IE=EmulateIE10';
		}
		return $headers;
	}
}

if ( ! function_exists( 'presscore_enqueue_theme_stylesheet' ) ) :

	/**
	 * [presscore_enqueue_theme_stylesheet description]
	 *
	 * @since  4.2.2
	 * 
	 * @param  string       $handle [description]
	 * @param  string|bool  $src    [description]
	 * @param  array        $deps   [description]
	 * @param  string|bool  $ver    [description]
	 * @param  string       $media  [description]
	 */
	function presscore_enqueue_theme_stylesheet( $handle, $src, $deps = array(), $ver = false, $media = 'all' ) {
		$src = get_template_directory_uri() . '/' . presscore_locate_stylesheet( $src );
		if ( ! $ver ) {
			$ver = wp_get_theme()->get( 'Version' );
		}

		wp_enqueue_style( $handle, $src, $deps, $ver, $media );
	}

endif;

if ( ! function_exists( 'presscore_enqueue_theme_script' ) ) :

	/**
	 * [presscore_enqueue_theme_script description]
	 *
	 * @since 4.2.2
	 * 
	 * @param string      $handle    Name of the script.
	 * @param string|bool $src       Path to the script from the root directory of WordPress. Example: '/js/myscript'.
	 * @param array       $deps      An array of registered handles this script depends on. Default jquery.
	 * @param string|bool $ver       Optional. String specifying the script version number, if it has one. This parameter
	 *                               is used to ensure that the correct version is sent to the client regardless of caching,
	 *                               and so should be included if a version number is available and makes sense for the script.
	 * @param bool        $in_footer Optional. Whether to enqueue the script before </head> or before </body>.
	 *                               Default 'false'. Accepts 'false' or 'true'.
	 */
	function presscore_enqueue_theme_script( $handle, $src = false, $deps = array( 'jquery' ), $ver = false, $in_footer = true ) {
		$src = get_template_directory_uri() . '/' . presscore_locate_script( $src );
		if ( ! $ver ) {
			$ver = wp_get_theme()->get( 'Version' );
		}

		wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
	}

endif;

if ( ! function_exists( 'presscore_locate_asset' ) ) :

	/**
	 * Try to locate minified file first, if file not exists - return $path.$ext
	 * 
	 * @since 4.2.2
	 * 
	 * @param  string $path File path without extension
	 * @param  string $ext  File extension
	 * @return string       File path
	 */
	function presscore_locate_asset( $path, $ext = 'css' ) {
		if ( locate_template( $path . '.min.' . $ext, false ) ) {
			return $path . '.min.' . $ext;

		} else {
			return $path . '.' . $ext;

		}
	}

endif;

if ( ! function_exists( 'presscore_locate_stylesheet' ) ) :

	/**
	 * Locate stylesheet file
	 *
	 * @since 4.2.2
	 * 
	 * @param  string $path File path
	 * @return string       File path
	 */
	function presscore_locate_stylesheet( $path ) {
		return presscore_locate_asset( $path, 'css' );
	}

endif;

if ( ! function_exists( 'presscore_locate_script' ) ) :

	/**
	 * Locate script file
	 *
	 * @since 4.2.2
	 * 
	 * @param  string $path File path
	 * @return string       File path
	 */
	function presscore_locate_script( $path ) {
		return presscore_locate_asset( $path, 'js' );
	}

endif;
