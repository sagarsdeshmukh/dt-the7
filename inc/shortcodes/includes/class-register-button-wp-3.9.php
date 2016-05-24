<?php
/**
 * Class which register tinymce buttons.
 *
 */

class DT_ADD_MCE_BUTTON {
	protected static $action_added = false;
	protected static $plugin_id = 'vogue_shortcodes';
	protected static $button_id = 'vogue_chortcodes_megabutton';

	function __construct( $plugin_name, $plugin_dir, $buttons = array(), $level = 3 ) {

		// init process for button control
		if ( !self::$action_added ) {
			add_action( 'admin_head', array ( __CLASS__, 'add_buttons' ) );
			self::$action_added = true;
		}
	}

	public static function add_buttons() {
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
			return;
		}

		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {

			// add the button for wp2.5 in a new way
			add_filter( 'mce_external_plugins', array( __CLASS__, 'add_plugins' ) );
			add_filter( 'mce_buttons', array( __CLASS__, 'register_buttons' ) );
		}
	}

	// used to insert button in wordpress 2.5x editor
	public static function register_buttons( $buttons ) {
		$buttons[] = self::$button_id;

		return $buttons;
	}

	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	public static function add_plugins( $plugins_array ) {
		$plugins_array[ self::$plugin_id ] = PRESSCORE_THEME_URI . '/inc/shortcodes/includes/plugin.js';

		return $plugins_array;
	}
}
