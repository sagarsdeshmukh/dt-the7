<?php
/**
 * Admin functions.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_themeoptions_add_share_buttons' ) ) :

	/**
	 * Share buttons field filter.
	 *
	 * Populate share buttons field on theme options page.
	 *
	 * @since 1.0.0
	 *
	 * @param array $buttons
	 * @return array
	 */
	function presscore_themeoptions_add_share_buttons( $buttons ) {
		$theme_soc_buttons = presscore_themeoptions_get_social_buttons_list();
		if ( $theme_soc_buttons && is_array( $theme_soc_buttons ) ) {
			$buttons = array_merge( $buttons, $theme_soc_buttons );
		}

		return $buttons;
	}

	add_filter( 'optionsframework_interface-social_buttons', 'presscore_themeoptions_add_share_buttons' );

endif;

/**
 * Admin notice.
 *
 */
function presscore_admin_notice() {
	global $current_screen;

	if ( optionsframework_get_options_files( $current_screen->parent_base ) && ! apply_filters( 'presscore_less_cache_writable', true ) ) {
		presscore_admin_notices()->add_notice( 'unable-to-write-css', _x( 'Failed to create customization .CSS file. To improve your site performance, please check whether ".../wp-content/uploads/" folder is created, and its CHMOD is set to 777.', 'admin', 'the7mk2' ), 'updated' );
	}
}
add_action( 'admin_notices', 'presscore_admin_notice' );

if ( ! function_exists( 'presscore_less_cache_writable_filter' ) ) :

	function presscore_less_cache_writable_filter() {
		return ( '0' != get_option( 'presscore_less_css_is_writable', 1 ) );
	}

	add_filter( 'presscore_less_cache_writable', 'presscore_less_cache_writable_filter' );

endif;

/**
 * Remove save notice if update credentials saved.
 *
 */
function presscore_remove_optionsframework_save_options_notice( $clean, $input = array() ) {

	if ( isset( $input['theme_update-user_name'], $input['theme_update-api_key'] ) ) {

		remove_action( 'optionsframework_after_validate', 'optionsframework_save_options_notice' );

	}
}
add_action( 'optionsframework_after_validate', 'presscore_remove_optionsframework_save_options_notice', 9, 2 );

/**
 * Add video url field for attachments.
 *
 */
function presscore_attachment_fields_to_edit( $fields, $post ) {

	// hopefuly add new field only for images
	if ( strpos( get_post_mime_type( $post->ID ), 'image' ) !== false ) {
		$video_url = get_post_meta( $post->ID, 'dt-video-url', true );
		$img_link = get_post_meta( $post->ID, 'dt-img-link', true );
		$hide_title = get_post_meta( $post->ID, 'dt-img-hide-title', true );

		$fields['dt-video-url'] = array(
				'label' 		=> _x('Video url', 'attachment field', 'the7mk2'),
				'input' 		=> 'text',
				'value'			=> $video_url ? $video_url : '',
				'show_in_edit' 	=> true
		);

		$fields['dt-img-link'] = array(
				'label' 		=> _x('Image link', 'attachment field', 'the7mk2'),
				'input' 		=> 'text',
				'value'			=> $img_link ? $img_link : '',
				'show_in_edit' 	=> true
		);

		$fields['dt-img-hide-title'] = array(
				'label' 		=> _x('Hide title', 'attachment field', 'the7mk2'),
				'input' 		=> 'html',
				'html'       	=> "<input id='attachments-{$post->ID}-dt-img-hide-title' type='checkbox' name='attachments[{$post->ID}][dt-img-hide-title]' value='1' " . checked($hide_title, true, false) . "/>",
				'show_in_edit' 	=> true
		);
	}

	return $fields;
}
add_filter( 'attachment_fields_to_edit', 'presscore_attachment_fields_to_edit', 10, 2 );

/**
 * Save vide url attachment field.
 *
 */
function presscore_save_attachment_fields( $attachment_id ) {

	// video url
	if ( isset( $_REQUEST['attachments'][$attachment_id]['dt-video-url'] ) ) {

		$location = esc_url($_REQUEST['attachments'][$attachment_id]['dt-video-url']);
		update_post_meta( $attachment_id, 'dt-video-url', $location );
	}

	// image link
	if ( isset( $_REQUEST['attachments'][$attachment_id]['dt-img-link'] ) ) {

		$location = esc_url($_REQUEST['attachments'][$attachment_id]['dt-img-link']);
		update_post_meta( $attachment_id, 'dt-img-link', $location );
	}

	// hide title
	$hide_title = (int) isset( $_REQUEST['attachments'][$attachment_id]['dt-img-hide-title'] );
	update_post_meta( $attachment_id, 'dt-img-hide-title', $hide_title );
}
add_action( 'edit_attachment', 'presscore_save_attachment_fields' );

/**	
 * This function return array with thumbnail image meta for items list in admin are.
 * If fitured image not set it gets last image by menu order.
 * If there are no images and $noimage not empty it returns $noimage in other way it returns false
 *
 * @param integer $post_id
 * @param integer $max_w
 * @param integer $max_h
 * @param string $noimage
 */ 

function dt_get_admin_thumbnail ( $post_id, $max_w = 100, $max_h = 100, $noimage = '' ) {
	global $wp_query;
	$thumb = array();

	if ( $wp_query && $wp_query->posts ) {
		update_post_thumbnail_cache();
	}

	if ( has_post_thumbnail( $post_id ) ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
	}

	$thumb = apply_filters( 'presscore_admin_get_post_thumbnail', $thumb, get_post_type( $post_id ), $post_id );

	if ( empty( $thumb ) ) {

		if ( ! $noimage ) {
			return false;
		}

		$thumb = $noimage;
		$w = $max_w;
		$h = $max_h;
	} else {

		$sizes = wp_constrain_dimensions( $thumb[1], $thumb[2], $max_w, $max_h );
		$w = $sizes[0];
		$h = $sizes[1];
		$thumb = $thumb[0];
	}

	return array( esc_url( $thumb ), $w, $h );
}

/**
 * Description here.
 *
 * @param integer $post_id
 */
function dt_admin_thumbnail ( $post_id ) {
	$default_image = PRESSCORE_THEME_URI . '/images/noimage-thumbnail.jpg';
	$thumbnail = dt_get_admin_thumbnail( $post_id, 60, 60, $default_image );

	if ( $thumbnail ) {

		echo '<a style="display: inline-block;" href="post.php?post=' . absint( $post_id ) . '&action=edit" title="">
					<img src="' . esc_url( $thumbnail[0] ) . '" width="' . esc_attr( $thumbnail[1] ) . '" height="' . esc_attr( $thumbnail[2] ) . '" alt="" />
				</a>';
	}
}

/**
 * Add styles to media.
 *
 */
function presscore_admin_print_scripts_for_media() {
?>
<style type="text/css">
.fixed .column-presscore-media-title {
	width: 10%;
}
.fixed .column-presscore-media-title span {
	padding: 2px 5px;
}
.fixed .column-presscore-media-title .dt-media-hidden-title {
	background-color: red;
	color: white;
}
.fixed .column-presscore-media-title .dt-media-visible-title {
	background-color: green;
	color: white;
}
</style>
<?php
}
add_action( 'admin_print_scripts-upload.php', 'presscore_admin_print_scripts_for_media', 99 );

/**
 * Add thumbnails column in posts list.
 *
 */
function presscore_admin_add_thumbnail_column( $defaults ){
	$head = array_slice( $defaults, 0, 2 );
	$tail = array_slice( $defaults, 2 );

	$head['presscore-thumbs'] = _x( 'Thumbnail', 'backend', 'the7mk2' );

	$defaults = array_merge( $head, $tail );

	return $defaults;
}

/**
 * Add sidebar and footer columns in posts list.
 *
 */
function presscore_admin_add_sidebars_columns( $defaults ){
	$defaults['presscore-sidebar'] = _x( 'Sidebar', 'backend', 'the7mk2' );
	$defaults['presscore-footer'] = _x( 'Footer', 'backend', 'the7mk2' );
	return $defaults;
}
add_filter( 'manage_edit-page_columns', 'presscore_admin_add_sidebars_columns' );
add_filter( 'manage_edit-post_columns', 'presscore_admin_add_sidebars_columns' );

/**
 * Add slug column for posts list.
 *
 */
function presscore_admin_add_slug_column( $defaults ){
	$defaults['presscore-slug'] = _x( 'Slug', 'backend', 'the7mk2' );
	return $defaults;
}

/**
 * Add title column for media.
 *
 */
function presscore_admin_add_media_title_column( $columns ) {
	$columns['presscore-media-title'] = _x( 'Image title', 'backend', 'the7mk2' );
	return $columns;
}
add_filter( 'manage_media_columns', 'presscore_admin_add_media_title_column' );

/**
 * Handle custom columns.
 *
 */
function presscore_admin_handle_columns( $column_name, $id ){
	switch ( $column_name ) {
		case 'presscore-thumbs': dt_admin_thumbnail( $id ); break;
		case 'presscore-sidebar':
			echo presscore_admin_get_sidebar_column_message( $id );
			break;

		case 'presscore-footer':
			echo presscore_admin_get_footer_sidebar_column_message( $id );
			break;

		case 'presscore-slug':
			if ( $dt_post = get_post( $id ) ) {
				echo $dt_post->post_name;
			} else {
				echo '&mdash;';
			}
			break;
	}
}
add_action( 'manage_posts_custom_column', 'presscore_admin_handle_columns', 10, 2 );
add_action( 'manage_pages_custom_column', 'presscore_admin_handle_columns', 10, 2 );

function presscore_admin_get_sidebar_column_message( $post_id ) {
	global $DT_META_BOXES;

	$registered_sidebars = presscore_get_widgetareas_options();
	$sidebar_id = presscore_validate_sidebar( get_post_meta( $post_id, '_dt_sidebar_widgetarea_id', true ) );
	$sidebar_name = $registered_sidebars[ $sidebar_id ];

	if ( ! isset( $DT_META_BOXES['dt_page_box-sidebar']['fields'] ) ) {
		return $sidebar_name;
	}

	// Find sidebar layout options.
	$meta_fields = $DT_META_BOXES['dt_page_box-sidebar']['fields'];
	$position_meta_field_id = '_dt_sidebar_position';
	$position = get_post_meta( $post_id, $position_meta_field_id, true );
	$position_name = '';

	foreach( $meta_fields as $meta_field ) {
		if ( isset( $meta_field['id'] ) && $position_meta_field_id === $meta_field['id'] && isset( $meta_field['options'][ $position ] ) ) {
			$position_name = $meta_field['options'][ $position ];
			break;
		}
	}

	if ( ! $position_name ) {
		return $sidebar_name;
	} else if ( is_array( $position_name ) ) {
		$position_name = current( $position_name );
	}

	if ( 'disabled' === $position ) {
		return $position_name;
	}

	return esc_html( _x( 'Position:', 'admin', 'the7mk2' ) . ' ' . $position_name ) . '<br/>' . esc_html( $sidebar_name );
}

function presscore_admin_get_footer_sidebar_column_message( $post_id ) {
	$position = get_post_meta( $post_id, '_dt_footer_show', true );

	if ( ! $position ) {
		return _x( 'Disabled', 'admin', 'the7mk2' );
	}

	$registered_sidebars = presscore_get_widgetareas_options();
	$sidebar_id = presscore_validate_footer_sidebar( get_post_meta( $post_id, '_dt_footer_widgetarea_id', true ) );
	$sidebar_name = $registered_sidebars[ $sidebar_id ];

	return $sidebar_name;
}

/**
 * Show title status in media list.
 *
 * @since 3.1
 */
function presscore_display_title_status_for_media( $column_name, $id ) {
	if ( 'presscore-media-title' == $column_name ) {
		$hide_title = get_post_meta( $id, 'dt-img-hide-title', true );
		if ( '' === $hide_title ) {
			// $hide_title = 1;
		}

		if ( $hide_title ) {
			echo '<span class="dt-media-hidden-title">' . _x('Hidden', 'media title hidden', 'the7mk2') . '</span>';
		} else {
			echo '<span class="dt-media-visible-title">' . _x('Visible', 'media title visible', 'the7mk2') . '</span>';
		}
	}
}
add_action( 'manage_media_custom_column', 'presscore_display_title_status_for_media', 10, 2 );

if ( ! function_exists( 'presscore_admin_scripts' ) ) :

	/**
	 * Add metaboxes scripts and styles.
	 */
	function presscore_admin_scripts() {
		wp_enqueue_style( 'dt-admin-style', PRESSCORE_ADMIN_URI . '/assets/admin-style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	add_action( 'admin_enqueue_scripts', 'presscore_admin_scripts' );

endif;

if ( ! function_exists( 'presscore_admin_post_scripts' ) ) :

	/**
	 * Add metaboxes scripts and styles.
	 */
	function presscore_admin_post_scripts( $hook ) {
		if ( ! in_array( $hook, array( 'post-new.php', 'post.php' ) ) ) {
			return;
		}

		wp_enqueue_style( 'dt-mb-magick', PRESSCORE_ADMIN_URI . '/assets/admin_mbox_magick.css' );

		wp_enqueue_script( 'dt-metaboxses-scripts', PRESSCORE_ADMIN_URI . '/assets/custom-metaboxes.js', array('jquery'), false, true );
		wp_enqueue_script( 'dt-mb-magick', PRESSCORE_ADMIN_URI . '/assets/admin_mbox_magick.js', array('jquery'), false, true );

		// enqueue only for pages
		if ( 'page' === get_post_type() ) {
			wp_enqueue_script( 'dt-mb-switcher', PRESSCORE_ADMIN_URI . '/assets/admin_mbox_switcher.js', array('jquery'), false, true );
		}

		// for proportion ratio metabox field
		$proportions = presscore_meta_boxes_get_images_proportions();
		$proportions['length'] = count( $proportions );
		wp_localize_script( 'dt-metaboxses-scripts', 'rwmbImageRatios', $proportions );
	}

	add_action( 'admin_enqueue_scripts', 'presscore_admin_post_scripts', 11 );

endif;

if ( ! function_exists( 'presscore_admin_widgets_scripts' ) ) :

	/**
	 * Add widgets scripts. Enqueued only for widgets.php.
	 */
	function presscore_admin_widgets_scripts( $hook ) {

		if ( 'widgets.php' != $hook ) {
			return;
		}

		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		// enqueue wp colorpicker
		wp_enqueue_style( 'wp-color-picker' );

		// presscore stuff
		wp_enqueue_style( 'dt-admin-widgets', PRESSCORE_ADMIN_URI . '/assets/admin-widgets.css' );
		wp_enqueue_script( 'dt-admin-widgets', PRESSCORE_ADMIN_URI . '/assets/admin_widgets_page.js', array('jquery', 'wp-color-picker'), false, true );

		wp_localize_script( 'dt-admin-widgets', 'dtWidgtes', array(
			'title'			=> _x( 'Title', 'widget', 'the7mk2' ),
			'content'		=> _x( 'Content', 'widget', 'the7mk2' ),
			'percent'		=> _x( 'Percent', 'widget', 'the7mk2' ),
			'showPercent'	=> _x( 'Show', 'widget', 'the7mk2' ),
		) );

	}

	add_action( 'admin_enqueue_scripts', 'presscore_admin_widgets_scripts', 15 );

endif;

if ( ! function_exists( 'presscore_editor_open_images_in_lightbox' ) ) :

	function presscore_editor_open_images_in_lightbox( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
		$url_extension = pathinfo( $url, PATHINFO_EXTENSION );
		if ( in_array( $url_extension, array( 'jpg', 'jpeg', 'png', 'gif' ) ) ) {
			$count = 0;
			$anchor_classes = 'dt-single-image'; // dt-mfp-item
			$atts = ' data-dt-img-description="' . esc_attr( $caption ) . '"';
			$html = preg_replace( '/^(<a .*?)class="(\w*?)"(.*?>)(.*?<img.*?\/>.*?)(<\/a>)/', '${1}class="${2} ' . $anchor_classes . '"' . $atts . '${3}${4}${5}', $html, 1, $count );

			if ( ! $count ) {
				$html = preg_replace( '/^(<a .*?)(.*?>)(.*?<img.*?\/>.*?)(<\/a>)/', '${1}class="' . $anchor_classes . '"' . $atts . ' ${2}${3}${4}', $html );
			}
		}

		return $html;
	}

	add_filter( 'image_send_to_editor', 'presscore_editor_open_images_in_lightbox', 10, 8 );

endif;

if ( ! function_exists( 'presscore_admin_body_class_filter' ) ) :

	function presscore_admin_body_class_filter( $classes ) {
		$classes .= 'dt-hide-plugins-notification';
		return $classes;
	}

endif;

if ( ! function_exists( 'presscore_layerslider_overrides' ) ) :

	function presscore_layerslider_overrides() {

		// Disable auto-updates
		$GLOBALS['lsAutoUpdateBox'] = false;
	}

	add_action('layerslider_ready', 'presscore_layerslider_overrides');

endif;

if ( ! function_exists( 'presscore_turn_off_plugins_notifications' ) ) :

	function presscore_turn_off_plugins_notifications() {
		if ( ! of_get_option( 'general-hide_plugins_notifications', true ) ) {
			return;
		}

		// Ultimate addons
		if ( class_exists( 'Ultimate_VC_Addons', false ) ) {
			$constants = array(
				'ULTIMATE_USE_BUILTIN' => true,
				'ULTIMATE_NO_UPDATE_CHECK' => true,
				'ULTIMATE_NO_EDIT_PAGE_NOTICE' => true,
				'ULTIMATE_NO_PLUGIN_PAGE_NOTICE' => true,
				'BSF_PRODUCTS_NOTICES' => false,
				'BSF_CHECK_PRODUCT_UPDATES' => false,
			);

			foreach ( $constants as $const=>$val ) {
				if ( ! defined( $const ) ) {
					define( $const, $val );
				}
			}
		}

		add_filter( 'admin_body_class', 'presscore_admin_body_class_filter' );

		// Slider Revolution
		if ( function_exists( 'set_revslider_as_theme' ) ) {
			set_revslider_as_theme();
		}

		// Revolution slider.
		remove_action('admin_notices', array('RevSliderAdmin', 'add_plugins_page_notices'));
	}

	add_action( 'init', 'presscore_turn_off_plugins_notifications', 0 );

endif;

if ( ! function_exists( 'presscore_turn_off_ultimate_addons_notifications' ) ) :

	function presscore_turn_off_ultimate_addons_notifications() {
		if ( ! of_get_option( 'general-hide_plugins_notifications', true ) ) {
			return;
		}

		remove_action( 'admin_head','bsf_update_counter',999 );
		remove_action( 'core_upgrade_preamble', 'list_bsf_products_updates', 999 );
	}

	add_action( 'init', 'presscore_turn_off_ultimate_addons_notifications', 9999 );

endif;

function presscore_admin_fix_theme_options() {
	$optionsframework_settings = get_option( 'optionsframework' );
	$theme_options = get_option( $optionsframework_settings['id'] );

	if ( ! $theme_options ) {
		return;
	}

	if ( isset( $theme_options['top_bar-font-size'] ) ) {
		$theme_options['top_bar-font-size'] = presscore_options_canonize_font_size( $theme_options['top_bar-font-size'] );
	}

	/**
	 * Images Styling & Hovers.
	 */
	if ( isset( $theme_options['image_hover-with_icons_opacity'] ) ) {
		$theme_options['image_hover-project_rollover_opacity'] = $theme_options['image_hover-with_icons_opacity'];
		unset( $theme_options['image_hover-with_icons_opacity'] );
	}

	if ( $the72_options = get_option( 'the72' ) ) {
		$header_preset_relation = array(
			'left' => 'wizard01',
			'center' => 'wizard03',
			'classic' => 'wizard03',
			'side' => 'wizard05',
		);
		$header_layout = $the72_options['header-layout'];
		$preset_id = isset( $header_preset_relation[ $header_layout ] ) ? $header_preset_relation[ $header_layout ] : 'skin07s';
		$preset_options = optionsframework_presets_data( $preset_id );

		// Skin.
		$the72_options['preset'] = $preset_options['preset'];

		// Header layout.
		$the72_options['header-layout'] = $preset_options['header-layout'];
		if ( 'center' == $header_layout ) {
			$the72_options['header-classic-logo-position'] = 'center';
			$the72_options['header-classic-menu-position'] = 'center';
		}

		// Classic header microwidgets.
		$microwidgets_elements_relation = array(
			'top_bar_left' => 'top_bar_left',
			'top_bar_right' => 'top_bar_right',
			'near_menu_right' => 'nav_area',
			'near_logo_right' => 'logo_area',
			'near_logo_left' => '',
		);

		$the72_options['header-classic-elements'] = _presscore_fix_microwidgets_elements_options( $microwidgets_elements_relation, $the72_options['header-classic_layout_elements'] );

		// Content boxes.
		if ( 'solid' == $the72_options['general-content_boxes_bg_mode'] ) {
			$the72_options['general-content_boxes_bg_color'] = $the72_options['general-content_boxes_solid_bg_color'];
			$the72_options['general-content_boxes_bg_opacity'] = '100';
		}

		// Beautiful loading.
		if ( 'accent' == $the72_options['general-beautiful_loading'] ) {
			$the72_options['general-fullscreen_overlay_color_mode'] = 'accent';
			$the72_options['general-spinner_color'] = '#ffffff';
		}
		$the72_options['general-beautiful_loading'] = ( 'disabled' == $the72_options['general-beautiful_loading'] ? 'disabled' : 'enabled' );

		$theme_options = array_merge( $preset_options, $the72_options );
	}

	update_option( $optionsframework_settings['id'], $theme_options );
}

function _presscore_fix_microwidgets_elements_options( $relation_map, $values ) {
	$elements = array();
	foreach ( $relation_map as $new_val => $old_val ) {
		if ( isset( $values[ $old_val ] ) ) {
			$elements[ $new_val ] = $values[ $old_val ];
		} else {
			$elements[ $new_val ] = array();
		}
	}

	return $elements;
}

function presscore_admin_fix_postmeta() {
	global $wpdb;
	// fix hover bg color
	$meta_keys = array(
		'_dt_albums_options_hover_bg_color',
		'_dt_albums_options_jgrid_hover_bg_color',
		'_dt_portfolio_options_hover_bg_color',
		'_dt_portfolio_options_jgrid_hover_bg_color'
	);
	// $meta_ids = presscore_admin_get_postmeta_by_mkey( $meta_keys, 'accent' );
	// if ( $meta_ids ) {
	// 	var_dump( implode( ', ', $meta_ids ), count( $meta_ids ) );
	// }

	presscore_admin_update_postmeta_by_mkey( $meta_keys, 'theme', 'accent' );
}

function presscore_admin_get_postmeta_by_mkey( $meta_key, $value = null ) {
	global $wpdb;
	$_meta_key = esc_sql( $meta_key );
	if ( is_array( $_meta_key ) ) {
		$_meta_key = implode( "', '", $_meta_key );
	}
	$_value = esc_sql( $value );

	$query = "SELECT `meta_id` FROM {$wpdb->postmeta} WHERE `meta_key` IN ('%1\$s')";
	if ( null !== $value ) {
		$query .= " AND `meta_value` = '%2\$s'";
	}
	return $wpdb->get_col( sprintf( $query, $_meta_key, $_value ) );
}

function presscore_admin_update_postmeta_by_mkey( $meta_key, $value, $old_value = null ) {
	global $wpdb;
	$_meta_key = esc_sql( $meta_key );
	if ( is_array( $_meta_key ) ) {
		$_meta_key = implode( "', '", $_meta_key );
	}
	$_old_value = esc_sql( $old_value );
	$_value = esc_sql( $value );

	$query = "UPDATE {$wpdb->postmeta} SET `meta_value` = '%2\$s' WHERE `meta_key` IN ('%1\$s')";
	if ( null !== $old_value ) {
		if ( is_array( $_old_value ) ) {
			$_old_value = implode( "', '", $_old_value );
		}
		$query .= " AND `meta_value` IN ('%3\$s')";
	}
	return $wpdb->query( sprintf( $query, $_meta_key, $_value, $_old_value ) );
}

function presscore_admin_fix_db() {
	if ( ! get_option( 'presscore_db_is_fixed' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		presscore_admin_fix_theme_options();
		presscore_admin_fix_postmeta();

		if ( ! add_option( 'presscore_db_is_fixed', true, false, false ) ) {
			update_option( 'presscore_db_is_fixed', true );
		}
	}
}
// add_action( 'init', 'presscore_admin_fix_db', 20 );

function presscore_options_canonize_font_size( $font_size ) {
	$canonized_font_size = $font_size;
	switch ( $font_size ) {
		case 'big':
			$canonized_font_size = '16';
			break;
		case 'normal':
			$canonized_font_size = '15';
			break;
		case 'small':
			$canonized_font_size = '12';
			break;
	}
	return $canonized_font_size;
}

function presscore_is_dev_env() {
	return defined( 'DT_DEV_ENV' ) && DT_DEV_ENV;
}

if ( presscore_is_dev_env() ) {

	function presscore_do_dev_env_actions() {
		delete_option( 'presscore_db_is_fixed' );
	}
	add_action( 'init', 'presscore_do_dev_env_actions' );

}

if ( ! function_exists( 'presscore_admin_remove_wp_site_icon' ) ) :

	/**
	 * Remove wp_site_icon hook if favicons set in theme options.
	 * @since 2.3.1
	 */
	function presscore_admin_remove_wp_site_icon() {
		if ( presscore_get_favicon() || presscore_get_device_icons() ) {
			remove_action( 'admin_head', 'wp_site_icon' );
		}
	}

	add_action( 'admin_init', 'presscore_admin_remove_wp_site_icon' );

endif;

add_action( 'admin_head', 'presscore_site_icon' );

if ( ! function_exists( 'presscore_admin_options_blocks_filter' ) ) :

	/**
	 * Filter options html to hide some blocks.
	 *
	 * @since 3.0.0
	 *
	 * @param  string $output
	 * @param  array $value
	 * @return string
	 */
	function presscore_admin_options_blocks_filter( $output, $value ) {
		if ( isset( $value['id'], $value['type'] ) && ( 'block' == $value['type'] || 'block_begin' == $value['type'] ) ) {
			if (
				( 'branding-menu-icon-block' == $value['id'] && ! in_array( of_get_option( 'header-layout' ), array( 'slide_out', 'overlay' ) ) )
				|| ( 'branding-floating-nav-block' == $value['id'] && ! of_get_option( 'header-show_floating_navigation' ) )
			) {
				$output = str_replace( 'class="postbox', 'class="postbox block-disabled', $output );
			}
		}
		return $output;
	}

	add_filter( 'options-interface-output', 'presscore_admin_options_blocks_filter', 10, 2 );

endif;

if ( ! function_exists( 'presscore_of_localized_vars_filter' ) ) :

	/**
	 * Setup blocks dependencies for "Top Bar & Header" options page. Filter optionsframework localized vars.
	 *
	 * @since 3.0.0
	 *
	 * @param  array $vars
	 * @return array
	 */
	function presscore_of_localized_vars_filter( $vars ) {
		if ( 'of-header-menu' != optionsframework_get_cur_page_id() ) {
			return $vars;
		}

		$vars['blockDependencies'] = array(
			// Layout.
			'header-classic-menu-bg-block' => array(
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'classic',
					)
				)
			),
			'header-hamburger-block' => array(
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'slide_out',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'overlay',
					)
				)
			),
			'header-mixed-line-block' => array(
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'slide_out',
					),
					array(
						'field' => 'header-slide_out-layout',
						'operator' => '!=',
						'value' => 'menu_icon',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'overlay',
					),
					array(
						'field' => 'header-overlay-layout',
						'operator' => '!=',
						'value' => 'menu_icon',
					)
				)
			),

			// Menu
			'menu-horizontal-decoration-block' => array(
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'classic',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'inline',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'split',
					)
				)
			),
			'menu-top-headers-indention' => array(
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'classic',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'inline',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'split',
					)
				)
			),

			// Submenu
			'submenu-for-side-headers-block' => array(
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'side',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'slide_out',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'overlay',
					)
				)
			),

			// Microwidgets
			'microwidgets-tab' => array(
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'classic',
					),
					array(
						'field' => 'header-classic-show_elements',
						'operator' => '!=',
						'value' => '0',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'inline',
					),
					array(
						'field' => 'header-inline-show_elements',
						'operator' => '!=',
						'value' => '0',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'split',
					),
					array(
						'field' => 'header-split-show_elements',
						'operator' => '!=',
						'value' => '0',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'side',
					),
					array(
						'field' => 'header-side-show_elements',
						'operator' => '!=',
						'value' => '0',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'slide_out',
					),
					array(
						'field' => 'header-slide_out-show_elements',
						'operator' => '!=',
						'value' => '0',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'overlay',
					),
					array(
						'field' => 'header-overlay-show_elements',
						'operator' => '!=',
						'value' => '0',
					)
				)
			),
			'microwidgets-near-logo-block' => array(
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'classic',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'slide_out',
					),
					array(
						'field' => 'header-slide_out-layout',
						'operator' => '!=',
						'value' => 'menu_icon',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'overlay',
					),
					array(
						'field' => 'header-overlay-layout',
						'operator' => '!=',
						'value' => 'menu_icon',
					)
				)
			),

			// Floating header
			'floatingheader-tab' => array(
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'classic',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'inline',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'split',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'slide_out',
					),
					array(
						'field' => 'header-slide_out-layout',
						'operator' => '==',
						'value' => 'top_line',
					)
				),
				array(
					array(
						'field' => 'header-layout',
						'operator' => '==',
						'value' => 'overlay',
					),
					array(
						'field' => 'header-overlay-layout',
						'operator' => '==',
						'value' => 'top_line',
					)
				)
			)
		);

		return $vars;
	}

	add_filter( 'of_localized_vars', 'presscore_of_localized_vars_filter' );

endif;

if ( ! function_exists( 'presscore_options_black_list' ) ) :

	/**
	 * List of options ids that do not included while export.
	 *
	 * @since 1.0.0
	 *
	 * @param  array  $fields
	 * @return array
	 */
	function presscore_options_black_list( $fields = array() ) {
		$fields_black_list = array(
			'general-tracking_code',
			'general-post_type_portfolio_slug',
			'general-post_type_gallery_slug',
			'general-post_type_team_slug',
			'general-contact_form_send_mail_to',

			'general-favicon',
			'general-favicon_hd',
			'general-handheld_icon-old_iphone',
			'general-handheld_icon-old_ipad',
			'general-handheld_icon-retina_iphone',
			'general-handheld_icon-retina_ipad',

			'header-menu-submenu-parent_is_clickable',

			'footer-layout',
			'bottom_bar-copyrights',
			'bottom_bar-text',

			'general-beautiful_loading',

			'general-show_author_in_blog',
			'general-next_prev_in_blog',
			'general-show_back_button_in_post',
			'general-post_back_button_target_page_id',
			'general-blog_meta_on',
			'general-blog_meta_date',
			'general-blog_meta_author',
			'general-blog_meta_categories',
			'general-blog_meta_comments',
			'general-blog_meta_tags',

			'general-next_prev_in_portfolio',
			'general-show_back_button_in_project',
			'general-project_back_button_target_page_id',

			'general-hide_plugins_notifications',

			'general-portfolio_meta_on',
			'general-portfolio_meta_date',
			'general-portfolio_meta_author',
			'general-portfolio_meta_categories',
			'general-portfolio_meta_comments',

			'general-show_rel_projects',
			'general-rel_projects_head_title',
			'general-rel_projects_title',
			'general-rel_projects_excerpt',
			'general-rel_projects_info_date',
			'general-rel_projects_info_author',
			'general-rel_projects_info_comments',
			'general-rel_projects_info_categories',
			'general-rel_projects_link',
			'general-rel_projects_zoom',
			'general-rel_projects_details',
			'general-rel_projects_max',
			'general-rel_projects_fullwidth_height',
			'general-rel_projects_fullwidth_width_style',
			'general-rel_projects_fullwidth_width',
			'general-rel_projects_height',
			'general-rel_projects_width_style',
			'general-rel_projects_width',

			'social_buttons-post-button_title',
			'social_buttons-post',
			'social_buttons-portfolio_post-button_title',
			'social_buttons-portfolio_post',
			'social_buttons-photo-button_title',
			'social_buttons-photo',
			'social_buttons-page-button_title',
			'social_buttons-page',

			'theme_update-user_name',
			'theme_update-api_key',
			'widgetareas',

			// archives
			'template_page_id_author',
			'template_page_id_date',
			'template_page_id_blog_category',
			'template_page_id_blog_tags',
			'template_page_id_search',
			'template_page_id_portfolio_category',
			'template_page_id_gallery_category',

			// woocommerce
			'woocommerce_display_product_info',
			'woocommerce_show_product_titles',
			'woocommerce_show_product_price',
			'woocommerce_show_product_rating',
			'woocommerce_show_cart_icon',
			'woocommerce_shop_template_layout',
			'woocommerce_shop_template_gap',
			'woocommerce_shop_template_column_min_width',
			'woocommerce_shop_template_columns',
			'woocommerce_shop_template_fullwidth',
			'woocommerce_shop_template_loading_effect'
		);

		return array_unique( array_merge( $fields, $fields_black_list ) );
	}

	add_filter( 'optionsframework_fields_black_list', 'presscore_options_black_list' );
	add_filter( 'optionsframework_validate_preserve_fields', 'presscore_options_black_list', 14 );

endif;

if ( ! function_exists( 'presscore_themeoption_preserved_fields' ) ) :

	/**
	 * List of theme options ids that do not change after skin switch.
	 *
	 * @since 1.0.0
	 *
	 * @param  array  $fields
	 * @return array
	 */
	function presscore_themeoption_preserved_fields( $fields = array() ) {
		$preserved_fields = array(
			// header logo
			'header-logo_regular',
			'header-logo_hd',

			// bottom logo
			'bottom_bar-logo_regular',
			'bottom_bar-logo_hd',

			// mobile logo
			'header-style-mobile-logo_regular',
			'header-style-mobile-logo_hd',
			'header-style-mobile-logo-padding-top',
			'header-style-mobile-logo-padding-bottom',

			// floating logo
			'header-style-floating-choose_logo',
			'header-style-floating-logo_regular',
			'header-style-floating-logo_hd',

			// menu icons dimentions
			'header-icons_size',
			'header-submenu_icons_size',
			'header-submenu_next_level_indicator',
			'header-next_level_indicator',

			// header layout
			'header-login_caption',
			'header-logout_caption',
			'header-search_caption',
			'header-woocommerce_cart_caption',

			// Header layout.
			'header-classic-elements',
			'header-classic-show_elements',
			'header-inline-elements',
			'header-inline-show_elements',
			'header-split-elements',
			'header-split-show_elements',
			'header-side-elements',
			'header-side-show_elements',
			'header-slide_out-elements',
			'header-slide_out-show_elements',
			'header-overlay-elements',
			'header-overlay-show_elements',

			// Microwidgets.
			'header-elements-search-caption',
			'header-elements-search-icon',
			'header-elements-search-second-header-switch',
			'header-elements-contact-address-caption',
			'header-elements-contact-address-icon',
			'header-elements-contact-address-second-header-switch',
			'header-elements-contact-phone-caption',
			'header-elements-contact-phone-icon',
			'header-elements-contact-phone-second-header-switch',
			'header-elements-contact-email-caption',
			'header-elements-contact-email-icon',
			'header-elements-contact-email-second-header-switch',
			'header-elements-contact-skype-caption',
			'header-elements-contact-skype-icon',
			'header-elements-contact-skype-second-header-switch',
			'header-elements-contact-clock-caption',
			'header-elements-contact-clock-icon',
			'header-elements-contact-clock-second-header-switch',
			'header-elements-login-caption',
			'header-elements-logout-caption',
			'header-elements-login-icon',
			'header-elements-login-second-header-switch',
			'header-elements-login-url',
			'header-elements-text-second-header-switch',
			'header-elements-text',
			'header-elements-text-2-second-header-switch',
			'header-elements-text-2',
			'header-elements-text-3-second-header-switch',
			'header-elements-text-3',
			'header-elements-menu-second-header-switch',
			'header-elements-menu-style',
			'header-elements-soc_icons-second-header-switch',
			'header-elements-soc_icons',
			'header-elements-woocommerce_cart-caption',
			'header-elements-woocommerce_cart-icon',
			'header-elements-woocommerce_cart-second-header-switch',
			'header-elements-woocommerce_cart-show_sub_cart',
			'header-elements-woocommerce_cart-show_subtotal',
			'header-elements-woocommerce_cart-show_counter',
		);

		return array_unique( array_merge( $fields, $preserved_fields ) );
	}

	add_filter( 'optionsframework_validate_preserve_fields', 'presscore_themeoption_preserved_fields', 15 );

endif;
