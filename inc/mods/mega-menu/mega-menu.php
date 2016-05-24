<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_MegaMenuModule', false ) ) :

	class Presscore_Modules_MegaMenuModule {

		/**
		 * Execute module.
		 */
		public static function execute() {
			$plugin_dir = plugin_dir_path( __FILE__ );
			require $plugin_dir . 'class-edit-menu-walker.php';
			require $plugin_dir . 'class-mega-menu-admin.php';
			require $plugin_dir . 'class-mega-menu-front.php';

			Presscore_Modules_MegaMenu_Admin::execute();
			Presscore_Modules_MegaMenu_Front::execute();
		}
	}

	Presscore_Modules_MegaMenuModule::execute();

endif;
