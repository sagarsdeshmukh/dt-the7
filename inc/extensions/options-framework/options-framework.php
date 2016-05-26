<?php
/*
Plugin Name: Options Framework
Plugin URI: http://www.wptheming.com
Description: A framework for building theme options.
Version: 1.5
Author: Devin Price
Author URI: http://www.wptheming.com
License: GPLv2
Modified By: Daniel Gerasimov
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/* Basic plugin definitions */

define( 'OPTIONS_FRAMEWORK_VERSION', '1.5' );
define( 'OPTIONS_FRAMEWORK_URL', trailingslashit( get_template_directory_uri() . '/inc/extensions/' . basename(dirname( __FILE__ )) ) );
define( 'OPTIONS_FRAMEWORK_DIR', trailingslashit( dirname( __FILE__ ) ) );

/* Make sure we don't expose any info if called directly */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a little plugin, don't mind me.";
	exit;
}

require_once OPTIONS_FRAMEWORK_DIR . 'classes/class-options-menu-item.php';
require_once OPTIONS_FRAMEWORK_DIR . 'classes/class-options-menu-items-composition.php';
require_once OPTIONS_FRAMEWORK_DIR . 'classes/class-dependency.php';
require_once OPTIONS_FRAMEWORK_DIR . 'classes/class-template.php';

require_once OPTIONS_FRAMEWORK_DIR . 'options-custom.php';

/* If the user can't edit theme options, no use running this plugin */
add_action( 'init', 'optionsframework_rolescheck', 20 );

function optionsframework_rolescheck() {
	if ( ! current_user_can( optionsframework_read_capability() ) ) {
		return;
	}

	add_action( 'wp_before_admin_bar_render', 'optionsframework_adminbar' );

	// If the user can edit theme options, let the fun begin!
	add_action( 'admin_menu', 'optionsframework_add_page' );
	add_action( 'admin_init', 'optionsframework_init' );

	if ( is_admin() ) {
		add_action( 'admin_enqueue_scripts', 'of_load_global_admin_assets' );
	} else {
		add_action( 'wp_enqueue_scripts', 'of_load_global_admin_assets' );
	}
}

/**
 * Get options id.
 *
 */
function optionsframework_get_options_id() {
	return preg_replace("/\W/", "", strtolower(wp_get_theme()->Name) );
}

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */
function optionsframework_option_name() {
	$options_id = optionsframework_get_options_id();
	$of_settings = get_option('optionsframework');
	$update = false;

	if ( ! isset( $of_settings['id'] ) || $options_id != $of_settings['id'] ) {
		$of_settings['id'] = $options_id;
		$update = true;
	}

	if ( ! isset( $of_settings['knownoptions'] ) ) {
		$of_settings['knownoptions'] = array( $options_id );
		$update = true;
	} else if ( ! in_array( $options_id, $of_settings['knownoptions'] ) ) {
		$of_settings['knownoptions'][] = $options_id;
		$update = true;
	}

	if ( $update ) {
		update_option('optionsframework', $of_settings);
	}
}

/* Loads the file for option sanitization */

add_action( 'init', 'optionsframework_load_sanitization' );

function optionsframework_load_sanitization() {
	require_once dirname( __FILE__ ) . '/options-sanitize.php';
}

/*
 * The optionsframework_init loads all the required files and registers the settings.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 * The theme options are saved using a unique option id in the database.  Developers
 * traditionally set the option id via in theme using the function
 * optionsframework_option_name, but it can also be set using a hook of the same name.
 *
 * If a theme developer doesn't explictly set the unique option id using one of those
 * functions it will be set by default to: optionsframework_[the theme name]
 *
 */

function optionsframework_init() {

	// Include the required files
	require_once dirname( __FILE__ ) . '/options-interface.php';
	require_once dirname( __FILE__ ) . '/options-media-uploader.php';

	// Load settings
	$optionsframework_settings = get_option( 'optionsframework' );

	// Updates the unique option id in the database if it has changed
	if ( function_exists( 'optionsframework_option_name' ) ) {
		optionsframework_option_name();
	}
	elseif ( has_action( 'optionsframework_option_name' ) ) {
		do_action( 'optionsframework_option_name' );
	}
	// If the developer hasn't explicitly set an option id, we'll use a default
	else {
		$default_themename = get_option( 'stylesheet' );
		$default_themename = preg_replace("/\W/", "_", strtolower($default_themename) );
		$default_themename = 'optionsframework_' . $default_themename;
		if ( isset( $optionsframework_settings['id'] ) ) {
			if ( $optionsframework_settings['id'] == $default_themename ) {
				// All good, using default theme id
			} else {
				$optionsframework_settings['id'] = $default_themename;
				update_option( 'optionsframework', $optionsframework_settings );
			}
		}
		else {
			$optionsframework_settings['id'] = $default_themename;
			update_option( 'optionsframework', $optionsframework_settings );
		}
	}

	$optionsframework_settings = get_option( 'optionsframework' );

	$saved_settings = get_option( $optionsframework_settings['id'] );

	// If the option has no saved data, load the defaults
	if ( ! $saved_settings ) {
		optionsframework_setdefaults();
	}

	// Registers the settings fields and callback
	register_setting( 'optionsframework', $optionsframework_settings['id'], 'optionsframework_validate' );

	// Change the capability required to save the 'optionsframework' options group.
	add_filter( 'option_page_capability_optionsframework', 'optionsframework_page_capability' );
}

/**
 * Ensures that a user with the 'edit_theme_options' capability can actually set the options
 * See: http://core.trac.wordpress.org/ticket/14365
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */

function optionsframework_page_capability( $capability = '' ) {
	return 'edit_theme_options';
}

function optionsframework_read_capability() {
	return apply_filters( 'optionsframework_read_capability', 'edit_theme_options' );
}

/*
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

function optionsframework_setdefaults() {

	$optionsframework_settings = get_option( 'optionsframework' );

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	/*
	 * Each theme will hopefully have a unique id, and all of its options saved
	 * as a separate option set.  We need to track all of these option sets so
	 * it can be easily deleted if someone wishes to remove the plugin and
	 * its associated data.  No need to clutter the database.
	 *
	 */

	if ( isset( $optionsframework_settings['knownoptions'] ) ) {
		$knownoptions =  $optionsframework_settings['knownoptions'];
		if ( !in_array($option_name, $knownoptions) ) {
			array_push( $knownoptions, $option_name );
			$optionsframework_settings['knownoptions'] = $knownoptions;
			update_option( 'optionsframework', $optionsframework_settings);
		}
	} else {
		$newoptionname = array($option_name);
		$optionsframework_settings['knownoptions'] = $newoptionname;
		update_option('optionsframework', $optionsframework_settings);
	}

	// If the options haven't been added to the database yet, they are added now
	$values = of_get_default_values();

	if ( isset($values) ) {
		add_option( $option_name, $values ); // Add option with default settings
	}
}

function optionsframework_get_main_title() {
	return _x( 'Theme Options', 'backend', 'the7mk2' );
}

/* Add a subpage called "Theme Options" to the appearance menu. */

if ( !function_exists( 'optionsframework_add_page' ) ) {

	function optionsframework_add_page() {
		$sub_pages = optionsframework_get_menu_items_list();

		if ( empty( $sub_pages ) ) {
			return false;
		}

		$main_menu_item = array_shift( $sub_pages );
		$main_menu_slug = $main_menu_item->get( 'slug' );
		$page_callback = 'optionsframework_page';
		$capability = optionsframework_read_capability();

		// Add main page
		$main_page_id = add_menu_page(
			$main_menu_item->get( 'menu_title' ),
			optionsframework_get_main_title(),
			$capability,
			$main_menu_slug,
			$page_callback
		);

		// Adds actions to hook in the required css and javascript
		add_action( 'admin_print_styles-' . $main_page_id, 'optionsframework_load_styles' );
		add_action( 'admin_print_scripts-' . $main_page_id, 'optionsframework_load_scripts' );
		add_action( 'admin_print_scripts-' . $main_page_id, 'optionsframework_media_scripts' );

		// Add sub_pages
		foreach ( $sub_pages as $sub_page ) {
			$sub_page_id = add_submenu_page(
				$main_menu_slug,
				$sub_page->get( 'page_title' ),
				$sub_page->get( 'menu_title' ),
				$capability,
				$sub_page->get( 'slug' ),
				$page_callback
			);

			// Adds actions to hook in the required css and javascript
			add_action( 'admin_print_styles-' . $sub_page_id,'optionsframework_load_styles' );
			add_action( 'admin_print_scripts-' . $sub_page_id, 'optionsframework_load_scripts' );
			add_action( 'admin_print_scripts-' . $sub_page_id, 'optionsframework_media_scripts' );
		}

		// Change menu name for main page
		global $submenu;
		if ( isset( $submenu[ $main_menu_slug ] ) ) {
			$submenu[ $main_menu_slug ][0][0] = $main_menu_item->get( 'menu_title' );
		}
	}

}

/* Loads the CSS */

function optionsframework_load_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'optionsframework', OPTIONS_FRAMEWORK_URL.'css/optionsframework.css', false, $theme_version );
	wp_enqueue_style( 'optionsframework-jquery-ui', OPTIONS_FRAMEWORK_URL.'css/jquery-ui.css', false, $theme_version );
	wp_enqueue_style( 'options-select2', OPTIONS_FRAMEWORK_URL . 'js/select2/css/select2.css', false, $theme_version );

	if ( ! wp_style_is( 'wp-color-picker','registered' ) ) {
		wp_register_style('wp-color-picker', OPTIONS_FRAMEWORK_URL.'css/color-picker.min.css');
	}
	wp_enqueue_style( 'wp-color-picker' );
}

/* Loads the javascript */

function optionsframework_load_scripts($hook) {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueued some jQuery ui plugins
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-dialog' );
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_script( 'jquery-ui-widget' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'jquery-form' );

	// Enqueue custom option panel JS
	wp_enqueue_script( 'options-custom', OPTIONS_FRAMEWORK_URL . 'js/options-custom.js', array( 'jquery','wp-color-picker' ), $theme_version, true );

	// Select2
	wp_enqueue_script( 'options-select2', OPTIONS_FRAMEWORK_URL . 'js/select2/js/select2.js', array( 'jquery' ), $theme_version, true );

	// Inline scripts from options-interface.php
	add_action( 'admin_head', 'of_admin_head' );

	add_action( 'optionsframework_after', 'of_localize_scripts' );
}

function of_localize_scripts() {
	$localized_vars = array(
		'ajaxurl'        => admin_url( 'admin-ajax.php' ),
		'optionsNonce'   => wp_create_nonce( 'options-framework-nonce' ),
		'ajaxFontsNonce' => wp_create_nonce( 'options-framework-ajax-fonts-nonce' ),
		'dependencies'   => optionsframework_fields_dependency()->get_all(),
	);
	$localized_vars = apply_filters( 'of_localized_vars', $localized_vars );

	// Useful variables
	wp_localize_script( 'options-custom', 'optionsframework', $localized_vars );
}

function of_admin_head() {
	// Hook to add custom scripts
	do_action( 'optionsframework_custom_scripts' );
}

function of_load_global_admin_assets() {
	wp_enqueue_style( 'optionsframework-global', OPTIONS_FRAMEWORK_URL . 'css/admin-stylesheet.css', false, wp_get_theme()->get( 'Version' ) );
	wp_add_inline_style( 'admin-bar', '#wpadminbar #wp-admin-bar-options-framework-parent > .ab-item:before{content: "\f111";}' );
}

/*
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom optionsframework_fields.  See options-interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

if ( !function_exists( 'optionsframework_page' ) ) :
function optionsframework_page() {
	if ( presscore_options_debug() ) {
		$wrap_class = ' of-debug';
	} else {
		$wrap_class = '';
	}
?>

	<div id="optionsframework-wrap" class="wrap<?php echo esc_attr( $wrap_class ); ?>">

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<?php settings_errors( 'options-framework' ); ?>

		<?php do_action( 'optionsframework_before_tabs' ); ?>

		<h2 class="nav-tab-wrapper hide-if-js"><?php echo optionsframework_tabs(); ?></h2>

		<?php do_action( 'optionsframework_before' ); ?>

		<div id="optionsframework-metabox" class="metabox-holder">
			<div id="optionsframework">
				<form action="options.php" method="post">
					<?php settings_fields( 'optionsframework' ); ?>
					<?php optionsframework_fields(); /* Settings */ ?>

					<div id="submit-wrap">
						<div id="optionsframework-submit">
							<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options', 'the7mk2' ); ?>" />
							<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Restore Defaults', 'the7mk2' ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to restore default settings on this page!', 'the7mk2' ) ); ?>' );" />
							<div class="clear"></div>
						</div>
					</div>

					<?php do_action( 'optionsframework_after_options' ); ?>

				</form>
			</div> <!-- / #container -->
		</div>

		<?php do_action( 'optionsframework_after' ); ?>

	</div> <!-- / .wrap -->

<?php
}
endif;

/**
 * Validate Options.
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 * @uses $_POST['reset'] to restore default options
 */
function optionsframework_validate( $input ) {

	/*
	 * Restore Defaults.
	 *
	 * In the event that the user clicked the "Restore Defaults"
	 * button, the options defined in the theme's options.php
	 * file will be added to the option for the active theme.
	 */

	if ( isset( $_POST['reset'] ) ) {
		add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', 'the7mk2' ), 'updated fade' );
		$current = null;
		if ( isset( $_POST['_wp_http_referer'] ) ) {
			$arr = array();
			wp_parse_str( $_POST['_wp_http_referer'], $arr );
			$current = current($arr);
		}
		return of_get_default_values( $current );
	}

	/*
	 * Update Settings
	 *
	 * This used to check for $_POST['update'], but has been updated
	 * to be compatible with the theme customizer introduced in WordPress 3.4
	 */

	$input = apply_filters( 'optionsframework_validate_input', $input );

	/**
	 * Highjack saved options validation.
	 *
	 * @since 3.0.0
	 */
	if ( $clean = apply_filters( 'optionsframework_get_validated_options', array(), $input ) ) {
		$clean = apply_filters( 'optionsframework_validated_options', $clean );

		// Hook to run after validation
		do_action( 'optionsframework_after_validate', $clean, $input );

		return $clean;
	}

	// Get all saved options
	$known_options = get_option( 'optionsframework', array() );
	$saved_options = $used_options = get_option( $known_options['id'], array() );
	if ( ! is_array( $saved_options ) ) {
		$saved_options = $used_options = array();
	}
	$presets_list = optionsframework_get_presets_list();

	// If there are preset option on this page - use this options instead saved
	if ( isset( $input['preset'] ) && in_array( $input['preset'], array_keys( $presets_list ) ) ) {

		// Get preset options
		$preset_options = optionsframework_presets_data( $input['preset'] );

		$preserve = apply_filters( 'optionsframework_validate_preserve_fields', array() );

		// Ignore preserved options
		foreach ( $preserve as $option ) {
			if ( isset( $preset_options[ $option ] ) ) {
				unset( $preset_options[ $option ] );
			}
		}

		if ( !isset( $preset_options['preset'] ) ) {
			$preset_options['preset'] = $input['preset'];
		}

		// Use all options for sanitazing
		$options =& _optionsframework_options();

		// Merge options, use preset options 
		$used_options = array_merge( (array) $saved_options, $preset_options );

		$is_preset = true;

	// if import / export
	} else if ( !empty( $input['import_export'] ) ) {

		// Use all options for sanitazing
		$options =& _optionsframework_options();

		$import_options = @unserialize( @base64_decode( $input['import_export'] ) );

		if ( is_array( $import_options ) ) {
			$used_options = array_merge( (array) $saved_options, $import_options );
		}

		$is_preset = true;

	// If regular page
	} else {

		// Get kurrent preset options
		$preset_options = optionsframework_presets_data( $saved_options['preset'] );

		// Options only for current page
		$page_id = optionsframework_get_cur_page_id();
		$options = optionsframework_get_page_options( $page_id );

		// Defune options data with which we will work
		$used_options = $input;

		$is_preset = false;

	}

	$clean = array();

	// Sanitize options
	foreach ( $options as $option ) {

		if ( ! isset( $option['id'] ) ) {
			continue;
		}

		if ( ! isset( $option['type'] ) ) {
			continue;
		}

		$id = preg_replace( '/(\W!-)/', '', strtolower( $option['id'] ) );

		// Set checkbox to false if it wasn't sent in the $_POST
		if ( 'checkbox' == $option['type'] && ! isset( $used_options[ $id ] ) ) {
			$used_options[ $id ] = false;
		}

		// Set each item in the multicheck to false if it wasn't sent in the $_POST
		if ( 'multicheck' == $option['type'] && ! isset( $used_options[ $id ] ) ) {
			foreach ( $option['options'] as $key => $value ) {
				$used_options[ $id ][ $key ] = false;
			}
		}

		// Use preset value instead native std
		if ( isset($preset_options[ $id ]) ) {
			$option['std'] = $preset_options[ $id ];
		}

		if ( $is_preset ) {

			if ( 'upload' == $option['type'] && isset( $used_options[ $id ] ) && is_array( $used_options[ $id ] ) ) {
				$used_options[ $id ] = array_reverse( $used_options[ $id ] );
			}
		}

		if ( ! isset( $used_options[ $id ] ) ) {
			continue;
		}

		// For a value to be submitted to database it must pass through a sanitization filter
		if ( !empty( $option['sanitize'] ) && has_filter( 'of_sanitize_' . $option['sanitize'] ) ) {
			$clean[ $id ] = apply_filters( 'of_sanitize_' . $option['sanitize'], $used_options[ $id ], $option );
		} elseif ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
			$clean[ $id ] = apply_filters( 'of_sanitize_' . $option['type'], $used_options[ $id ], $option );
		}
	}

	// Merge current options and saved ones
	$clean = array_merge( $saved_options, $clean );
	$clean = apply_filters( 'optionsframework_validated_options', $clean );

	// Hook to run after validation
	do_action( 'optionsframework_after_validate', $clean, $input );

	return $clean;
}

function optionsframework_options_saved( $state = true ) {
	update_option( 'the7_options_saved', $state, false );
}

function optionsframework_options_is_saved() {
	return get_option( 'the7_options_saved' );
}

/**
 * Display message when options have been saved
 */
 
function optionsframework_save_options_notice() {
	add_settings_error( 'options-framework', 'save_options', _x( 'Options saved.', 'backend', 'the7mk2' ), 'updated fade' );
	optionsframework_options_saved();
}

add_action( 'optionsframework_after_validate', 'optionsframework_save_options_notice' );

/**
 * Format Configuration Array.
 *
 * Get an array of all default values as set in
 * options.php. The 'id','std' and 'type' keys need
 * to be defined in the configuration array. In the
 * event that these keys are not present the option
 * will not be included in this function's output.
 *
 * @return    array     Rey-keyed options configuration array.
 *
 * @access    private
 */

function of_get_default_values( $page = null ) {
	$output = $preset = $saved_options = array();
	$known_options = get_option( 'optionsframework', array() );
	$tmp_options = get_option( $known_options['id'], array() );

	// If this is first run - use one of preset
	if ( empty( $tmp_options ) ) {
		$tmp_options['preset'] = apply_filters('options_framework_first_run_skin', '');
	}

	// If this is preset page - restore it's defaults
	if ( isset( $tmp_options['preset'] ) ) {
		// Get preset options
		$preset = optionsframework_presets_data( $tmp_options['preset'] );

		// if preset not set - set it
		if ( !isset( $preset['preset'] ) ) {
			$preset['preset'] = $tmp_options['preset'];
		}
	}

	// Current page defaults
	if ( $page ) {
		$config = optionsframework_get_page_options( $page );
		$saved_options = $tmp_options;
	} else {
		$config =& _optionsframework_options();
	}

	foreach ( (array) $config as $option ) {
		if ( ! isset( $option['id'] ) ) {
			continue;
		}
		if ( ! isset( $option['std'] ) ) {
			continue;
		}
		if ( ! isset( $option['type'] ) ) {
			continue;
		}
		if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
			$value = $option['std'];

			// Use defaults from preset if it's present
			if ( isset( $preset[ $option['id'] ] ) ) {
				$preset_value = $preset[ $option['id'] ];

				if ( 'upload' == $option['type'] && isset($option['mode']) && 'full' == $option['mode'] ) {
					$preset_value = array_reverse($preset_value);
				}

				$value = $preset_value;
			}

			$output[ $option['id'] ] = apply_filters( 'of_sanitize_' . $option['type'], $value, $option );
		}
	}
	$output = array_merge($saved_options, $output);

	return apply_filters( 'of_get_default_values', $output );
}

/**
 * Add Theme Options menu item to Admin Bar.
 */

function optionsframework_adminbar() {
	global $wp_admin_bar;

	$menu_items = optionsframework_get_menu_items_list();

	if ( empty( $menu_items ) ) {
		return false;
	}

	$parent_menu_item = current( $menu_items );
	$parent_menu_id = 'options-framework-parent';

	$wp_admin_bar->add_menu( array(
		'id'    => $parent_menu_id,
		'title' => optionsframework_get_main_title(),
		'href'  => admin_url( 'admin.php?page=' . urlencode( $parent_menu_item->get( 'slug' ) ) )
	));

	foreach( $menu_items as $menu_item ) {
		$wp_admin_bar->add_menu( array(
			'parent' => $parent_menu_id,
			'id'     => $menu_item->get( 'slug' ),
			'title'  => $menu_item->get( 'menu_title' ),
			'href'   => admin_url( 'admin.php?page=' . urlencode( $menu_item->get( 'slug' ) ) )
		));
	}
}

/**
 * Description here.
 *
 */
function optionsframework_get_options() {
	$config_id = optionsframework_get_options_id();
	$config = get_option( 'optionsframework' );
	if ( !isset($config['knownoptions']) || !in_array($config_id, $config['knownoptions']) ) {
		return null;
	}

	return get_option( $config_id );
}


/**
 * Get Option.
 *
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 */

if ( ! function_exists( 'of_get_option' ) ) :

	function of_get_option( $name, $default = false ) {
		if ( false === ( $saved_options = wp_cache_get( 'saved_options', 'optionsframework' ) ) ) {

			$saved_options = optionsframework_get_options();
			$saved_options = apply_filters( 'dt_of_get_option_static', $saved_options );

			wp_cache_set( 'saved_options', $saved_options, 'optionsframework' );
		}

		$options = apply_filters( 'dt_of_get_option', $saved_options, $name );

		if ( isset( $options[ $name ] ) ) {
			return $options[ $name ];
		}

		if ( false === $default && null !== ( $def_val = _optionsframework_get_option_default_value( $name ) ) ) {
			return $def_val;
		}

		return $default;
	}

endif;

/**
 * Wrapper for optionsframework_options()
 *
 * Allows for manipulating or setting options via 'of_options' filter
 * For example:
 *
 * <code>
 * add_filter('of_options', function($options) {
 *     $options[] = array(
 *         'name' => 'Input Text Mini',
 *         'desc' => 'A mini text input field.',
 *         'id' => 'example_text_mini',
 *         'std' => 'Default',
 *         'class' => 'mini',
 *         'type' => 'text'
 *     );
 *
 *     return $options;
 * });
 * </code>
 *
 * Also allows for setting options via a return statement in the
 * options.php file.  For example (in options.php):
 *
 * <code>
 * return array(...);
 * </code>
 *
 * @return array (by reference)
 */
function &_optionsframework_options() {
	$options = optionsframework_load_options( optionsframework_get_options_files() );

	// Allow setting/manipulating options via filters
	$options = apply_filters( 'of_options', $options );

	return $options;
}


/**
 * Return array with actual theme options.
 * 
 * @return mixed
 */
function _optionsframework_get_clean_options() {
	if ( false === ( $clean_options = get_transient( 'optionsframework_clean_options' ) ) ) {
		$options =& _optionsframework_options();
		$clean_options = array();

		foreach ( $options as $option ) {
			if ( isset( $option['id'], $option['type'] ) ) {
				$clean_options[ $option['id'] ] = $option;
			}
		}

		set_transient( 'optionsframework_clean_options', $clean_options, 60 );
	}

	return $clean_options;
}

/**
 * Return option default value.
 * 
 * @param  string $id
 * @return mixed
 */
function _optionsframework_get_option_default_value( $id ) {
	$defaults = _optionsframework_get_clean_options();
	return ( isset( $defaults[ $id ]['std'] ) ? $defaults[ $id ]['std'] : null );
}
