<?php
/**
 * Ubermenu compatibility class.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_Compatibility_UberMenu', false ) ) :

	class Presscore_Modules_Compatibility_UberMenu {

		public static function execute() {
			if ( ! class_exists( 'UberMenu', false ) ) {
				return;
			}

			add_filter( 'body_class', array( __CLASS__, 'add_body_class_filter' ) );
		}

		public static function add_body_class_filter( $classes = array() ) {
			if ( has_nav_menu( 'primary' ) ) {
				$classes[] = 'dt-style-um';
			}

			return $classes;
		}
	}

	Presscore_Modules_Compatibility_UberMenu::execute();

endif;
