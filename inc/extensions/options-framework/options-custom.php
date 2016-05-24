<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Widgetareas theme-options filter.
 */
function optionsframework_widgetareas_interface( $output, $value ) {

	// Name
	$output .= '<label for="widgetareas-name">' . _x('Sidebar name', 'theme-options', 'the7mk2') . '</label>';
	$output .= '<input type="text" id="widgetareas-name" class="of_fields_gen_title" value=""/>';

	// Description
	$output .= '<label for="widgetareas-description">' . _x('Sidebar description (optional)', 'theme-options', 'the7mk2') . '</label>';
	$output .= '<textarea id="widgetareas-description"></textarea>';    

	// Button
	$output .= '<button id="widgetareas-add" class="of_fields_gen_add">' . _x('Update', 'theme-options', 'the7mk2') . '</button>';

	return $output;
}

/**
 * Widgetareas ajax handler.
 */
function optionsframework_widgetareas_ajax() {
	$action = empty($_POST['type']) ? '' : $_POST['type'];
	$nonce = empty($_POST['waNonce']) ? '' : $_POST['waNonce'];
	$wa_id = empty($_POST['waId']) ? 0 : absint($_POST['waId']);
	$wa_title = empty($_POST['waTitle']) ? '' : $_POST['waTitle'];
	$wa_desc = empty($_POST['waDesc']) ? '' : $_POST['waDesc'];

	// check to see if the submitted nonce matches with the
	// generated nonce we created earlier
	if ( ! wp_verify_nonce( $nonce, 'options-framework-nonce' ) ) {		
		die ( 'Busted!');
	}

	// ignore the request if the current user doesn't have
	// sufficient permissions
	if ( current_user_can( 'edit_theme_options' ) ) {
		
		$response = array( 'success' => false );
		$wa_array = of_get_option('widgetareas', array());

		if ( 'get' == $action && $wa_id ) {

			if ( $wa_array && isset($wa_array[ $wa_id ]) ) {

				$response['title'] = $wa_array[ $wa_id ]['title'];
				$response['desc'] = $wa_array[ $wa_id ]['desc'];
				$response['success'] = true;
			}
		} else if ( 'update' == $action && $wa_title ) {

			$known_options = get_option( 'optionsframework', array() );
			$saved_options = get_option( $known_options['id'], array() );
			
			if ( isset($saved_options['widgetareas']) ) {
				$wa_array = $saved_options['widgetareas'];
				
				// Get field id
				if ( !$wa_id ) { $wa_id = $wa_array['next_id']++; }
				
				// Update/Add new field
				$wa_array[ $wa_id ] = array(
					'title' => $wa_title,
					'desc'	=> $wa_desc
				);

				// Sanitize
				$saved_options['widgetareas'] = apply_filters('of_sanitize_widgetareas', $wa_array);

				// Update options
				$response['success'] = update_option($known_options['id'], $saved_options);
				$response['id'] = $wa_id;
			}
		}

		// generate the response
		$response = json_encode($response);
 
		// response output
		header( "Content-Type: application/json" );
		echo $response;
	}
 
	// IMPORTANT: don't forget to "exit"
	exit;
}
add_action('wp_ajax_process_widgetarea', 'optionsframework_widgetareas_ajax');

/**
 *	DEPRECATED.
 *
 * @param  boolean $get_defaults
 * @return array
 */
function dt_get_google_fonts_list( $get_defaults = false ) {
	return presscore_options_get_web_fonts();
}

// get images for options framework
function dt_get_images_in( $dir = '', $one_img_dir = '', $basedir = false ){
	if ( ! $basedir ) {
		$basedir = dirname(__FILE__) . '/../../../';
	}

	$dirname = $basedir . $dir;
	$cache_field_name = 'dt_opts_assets_' . sanitize_key( str_replace( '/', '_', $dir ) );

	if ( ! $res = get_transient( $cache_field_name ) ) {
		$noimage = '/images/noimage_small.jpg';
		$res = $full_dir = $thumbs_dir = array();

		// full dir
		if ( file_exists($dirname. '/full') && $handle = opendir( $dirname. '/full') ) {
			while (false !== ($file = readdir($handle))) {
				if (preg_match('/\.(jpeg|jpg|png|gif)$/', $file)) {
					$f_name = preg_split( '/\.[^.]+$/', $file );
					$full_dir[$f_name[0]] = $file;
				}
			}
			closedir($handle);
		}
		unset($file);
		
		// thumbs dir
		if ( file_exists($dirname. '/thumbs') && $handle = opendir( $dirname. '/thumbs') ) {
			while (false !== ($file = readdir($handle))) {
				if ( preg_match('/\.(jpeg|jpg|png|gif)$/', $file) ) {
					$f_name = preg_split( '/\.[^.]+$/', $file );
					$thumbs_dir[$f_name[0]] = $file;
				}
			}
			closedir($handle);
		}
		unset($file);
		asort($full_dir);

		foreach( $full_dir as $name=>$file ){
			$full_link = '/' . $dir . '/full/' . $file;
			$thumb_link = $full_link;
			if( array_key_exists( $name, $thumbs_dir ) ){
				$thumb_link = '/' . $dir . '/thumbs/' . $thumbs_dir[$name];
			}else {
				$one_img = explode('.', $name);
				$file_name = $basedir . $one_img_dir . '/' . $one_img[0];

				if ( count($one_img) > 1 && $one_img[0] != $name && $one_img_dir && file_exists($file_name . '.png') ) {
					$thumb_link = '/'.$one_img_dir.'/'.$one_img[0].'.png';
				}

				if ( count($one_img) > 1 && $one_img[0] != $name && $one_img_dir && file_exists($file_name . '.jpg') ) {
					$thumb_link = '/'.$one_img_dir.'/'.$one_img[0].'.jpg';
				}

				if ( count($one_img) > 1 && $one_img[0] != $name && $one_img_dir && file_exists($file_name . '.gif') ) {
					$thumb_link = '/'.$one_img_dir.'/'.$one_img[0].'.gif';
				}
			}

			$res[$full_link] = $thumb_link;
		}

		set_transient( $cache_field_name, $res, 60*60 );
	}

	return $res;
}

/* find option pages in array */
function optionsframework_options_page_filter( $item ) {
	if( isset($item['type']) && 'page' == $item['type'] ) {
		return true;
	}
	return false;
}

/* find options for current page */
function optionsframework_options_for_page_filter( $item ) {
	static $bingo = false;
	static $found_main = false;

	if ( $item == 0 ) { $bingo = $found_main = false; }

	if( !isset($_GET['page']) ) {
		if( !isset($_POST['_wp_http_referer']) ) {
			return true;
		}else {
			$arr = array();
			wp_parse_str($_POST['_wp_http_referer'], $arr);
			$current = current($arr);
		}
	}else {
		$current = $_GET['page'];
	}

	if( 'options-framework' == $current && !$found_main ) {
		$bingo = true;
		$found_main = true;
	}

	if( isset($item['type']) && 'page' == $item['type'] && $item['menu_slug'] == $current ) {
		$bingo = true;
		return false;
	}elseif( isset($item['type']) && 'page' == $item['type'] ) {
		$bingo = false;
	}

	return $bingo;
}

function optionsframework_get_cur_page_id() {
	if ( isset( $_GET['page'] ) ) {
		return $_GET['page'];
	}

	if ( isset( $_POST['_wp_http_referer'] ) ) {
		$arr = array();
		wp_parse_str( $_POST['_wp_http_referer'], $arr );
		return current( $arr );
	}

	return false;
}

function optionsframework_get_presets_list () {
	return apply_filters( 'optionsframework_get_presets_list', array() );
}

function optionsframework_presets_data( $id ) {
	$preset = array();
	$registered_presets = optionsframework_get_presets_list();
	if ( array_key_exists( $id, $registered_presets ) ) {

		$preset = apply_filters( 'presscore_options_return_preset', array(), $id );
		if ( $preset ) {
			return $preset;
		}

		include OPTIONS_FRAMEWORK_PRESETS_DIR . $id . '.php';

		if ( isset( $presets[ $id ] ) ) {
			$preset = $presets[ $id ];
		}
	}
	return $preset;
}

/**
 * Store framework pages.
 *
 */
function optionsframework_menu_items() {
	$menu_config = array();
	$menu_config_file = locate_template( 'inc/admin/theme-options-menu-list.php', false, false );
	if ( $menu_config_file ) {
		$menu_config = include $menu_config_file;
	}
	$options_files = optionsframework_get_options_files();

	$menu_config = array_intersect_key( $menu_config, $options_files );

	$menu_config = apply_filters( 'presscore_options_menu_config', $menu_config );

	return Presscore_Options_Menu_Items_Composition::create_from_array( $menu_config );
}

function optionsframework_get_options_files( $page_slug = null ) {
	$files_list = include trailingslashit( PRESSCORE_ADMIN_DIR ) . 'theme-options-files.php';
	$files_list = presscore_assure_is_array( $files_list );

	$files_list = apply_filters( 'presscore_options_files_list', $files_list, $page_slug );

	if ( $page_slug ) {
		return isset( $files_list[ $page_slug ] ) ? array( $page_slug => $files_list[ $page_slug ] ) : array();
	}

	return $files_list;
}

function optionsframework_get_page_options( $page_slug ) {
	return optionsframework_load_options( optionsframework_get_options_files( $page_slug ) );
}

function optionsframework_get_menu_items_list() {
	$user_menu = apply_filters( 'presscore_options_menu_items', optionsframework_menu_items()->get_all() );
	reset( $user_menu );
	return $user_menu;
}

function optionsframework_load_options( $files_list ) {
	$files_list = presscore_assure_is_array( $files_list );

	$files_list = apply_filters( 'presscore_options_files_to_load', $files_list );

	$options = array();

	if ( $files_list ) {
		include PRESSCORE_ADMIN_OPTIONS_DIR . '/options.php';

		foreach ( $files_list as $slug=>$file_path ) {
			include $file_path;
		}
	}

	$options = apply_filters( 'presscore_loaded_options', $options, $files_list );

	return $options;
}

function presscore_opts_get_bg_images( $field_id = '' ) {
	static $filtered_presets_images = null;
	if ( null === $filtered_presets_images ) {
		$filtered_presets_images = array();
		$presets_images = dt_get_images_in( 'inc/presets/images', 'inc/presets/images', trailingslashit( get_template_directory() ) );
		if ( $presets_images ) {
			foreach ( $presets_images as $full => $thumb ) {
				$img_field_id = explode( '.', $full );

				// ignore
				if ( count( $img_field_id ) < 3 ) {
					continue;
				}

				$img_field_id = $img_field_id[1];
				$clear_key = sanitize_key( str_replace( '-', '_', $img_field_id ) );

				if ( ! isset( $filtered_presets_images[ $clear_key ] ) ) {
					$filtered_presets_images[ $clear_key ] = array();
				}

				$filtered_presets_images[ $clear_key ][ $full ] = $thumb;
			}
		}
	}

	$field_id = sanitize_key( str_replace( '-', '_', $field_id ) );
	$bg_images = dt_get_images_in( 'images/backgrounds/patterns', 'images/backgrounds', trailingslashit( get_template_directory() ) );
	if ( array_key_exists( $field_id, $filtered_presets_images ) ) {
		$bg_images = array_merge( $filtered_presets_images[ $field_id ], $bg_images );
	}

	return $bg_images;
}

function presscore_options_debug() {
	return ( defined( 'OPTIONS_FRAMEWORK_DEBUG' ) && OPTIONS_FRAMEWORK_DEBUG );
}

function presscore_options_add_debug_info() {
	if ( ! presscore_options_debug() ) {
		return;
	}

	echo '<button class="show-debug-info button hide-if-js">toggle debug info</button>';

	wp_enqueue_script( 'of-debug-info', OPTIONS_FRAMEWORK_URL . 'js/debug-scripts.js', array( 'jquery' ), false, true );
}
add_action( 'optionsframework_before', 'presscore_options_add_debug_info' );
