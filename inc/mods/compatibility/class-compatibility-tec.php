<?php
/**
 * Tribe Events Calendar compatibility class.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_Compatibility_TEC', false ) ) :

	class Presscore_Modules_Compatibility_TEC {

		public static function execute() {
			if ( ! class_exists( 'Tribe__Events__Main', false ) ) {
				return;
			}

			add_action( 'get_header', array( __CLASS__, 'hide_theme_page_title_action' ), 10 );
		}

		/**
		 * Hide theme page title on plugin pages. 
		 *
		 * @see https://gist.github.com/jo-snips/2415009
		 */
		public static function hide_theme_page_title_action() {
			// detect calendar pages
			if (
				( tribe_is_month() && !is_tax() ) 
				|| ( tribe_is_month() && is_tax() ) 
				|| ( tribe_is_past() || tribe_is_upcoming() && !is_tax() ) 
				|| ( tribe_is_past() || tribe_is_upcoming() && is_tax() ) 
				|| ( tribe_is_day() && !is_tax() ) 
				|| ( tribe_is_day() && is_tax() ) 
				|| ( tribe_is_event() && is_single() ) 
				|| ( tribe_is_venue() ) 
				|| ( function_exists( 'tribe_is_week' ) && tribe_is_week() ) 
				|| ( function_exists( 'tribe_is_photo' ) && tribe_is_photo() ) 
				|| ( function_exists( 'tribe_is_map' ) && tribe_is_map() ) 
				|| ( get_post_type() == 'tribe_organizer' && is_single() ) 
			) {
				// remove theme title controller
				remove_action( 'presscore_before_main_container', 'presscore_page_title_controller', 16 );
			}
		}
	}

	Presscore_Modules_Compatibility_TEC::execute();

endif;
