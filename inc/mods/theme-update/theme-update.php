<?php
/**
 * Theme update functions.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_ThemeUpdateModule', false ) ) :

	class Presscore_Modules_ThemeUpdateModule {

		public static function execute() {
			add_action( 'init', array( __CLASS__, 'add_hooks' ) );
		}

		public static function add_hooks() {
			if ( ! is_user_logged_in() || is_child_theme() ) {
				return;
			}

			/**
			 * Update library.
			 */
			require_once plugin_dir_path( __FILE__ ) . 'envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php';

			add_filter( 'presscore_options_files_list', array( __CLASS__, 'add_options_filter' ) );
			add_action( 'admin_head', array( __CLASS__, 'check_for_update_action' ) );
			add_action( 'admin_init', array( __CLASS__, 'theme_update_action' ) );
		}

		public static function add_options_filter( $files_list ) {
			$menu_slug = 'of-themeupdate-menu';
			if ( ! array_key_exists( $menu_slug, $files_list ) ) {
				$files_list[ $menu_slug ] = plugin_dir_path( __FILE__ ) . 'options-themeupdate.php';
			}
			return $files_list;
		}

		public static function check_for_update_action() {
			$current_screen = get_current_screen();

			if ( $current_screen && false !== strpos( $current_screen->id, 'of-themeupdate-menu' ) ) {

				$user = of_get_option( 'theme_update-user_name', '' );
				$api_key = of_get_option( 'theme_update-api_key', '' );

				if ( $user || $api_key ) {

					$upgrader = new Envato_WordPress_Theme_Upgrader( $user, $api_key );

					if ( $upgrader ) {

						$responce = $upgrader->check_for_theme_update();
						$current_theme = wp_get_theme();
						$update_needed = false;

						//check is current theme up to date
						if ( isset($responce->updated_themes) ) {
							foreach ( $responce->updated_themes as $updated_theme ) {

								if ( $updated_theme->version == $current_theme->version && $updated_theme->name == $current_theme->name ) {
									$update_needed = true;
								}
							}
						}

						if ( !empty($responce->errors) ) {

							add_settings_error( 'options-framework', 'update_errors', _x('Error:<br />', 'backend', 'the7mk2') . implode( '<br \>', $responce->errors ), 'error' );
						} else if ( $update_needed ) {

							// changelog link
							$message = sprintf( _x('New version (<a href="%s" target="_blank">see changelog</a>) of theme is available!', 'backend', 'the7mk2'), presscore_theme_update_get_changelog_url() );

							// update link
							$message .= '&nbsp;<a href="' . esc_url( add_query_arg( 'theme-updater', 'update' ) ) . '">' . _x('Please, click here to update.', 'backend', 'the7mk2') . '</a>';

							add_settings_error( 'options-framework', 'update_nedded', $message, 'updated' );
						} else {

							add_settings_error( 'options-framework', 'theme_uptodate', _x("You have the most recent version of the theme.", 'backend', 'the7mk2'), 'updated salat' );
						}

						$update_result = get_transient( 'presscore_update_result' );

						if ( $update_result ) {

							if ( !empty($update_result->success) ) {

								add_settings_error( 'options-framework', 'update_result', _x('Theme was successfully updated to newest version!', 'backend', 'the7mk2'), 'updated salat' );
							} else if ( !empty($update_result->installation_feedback) ) {

								add_settings_error( 'options-framework', 'update_result', _x('Error:<br />', 'backend', 'the7mk2') . implode('<br />', $update_result->installation_feedback), 'error' );
							}
						}

					}

				}
			}
		}

		public static function theme_update_action() {
			if ( isset( $_GET['theme-updater'] ) && 'update' == $_GET['theme-updater'] ) {

				// global timestamp
				global $dt_lang_backup_dir_timestamp;
				$dt_lang_backup_dir_timestamp = time();

				// backup lang files
				add_filter( 'upgrader_pre_install', array( __CLASS__, 'before_theme_update_filter' ), 10, 2 );

				// restore lang files
				add_filter( 'upgrader_post_install', array( __CLASS__, 'after_theme_update_filter' ), 10, 3 );

				$user = of_get_option( 'theme_update-user_name', '' );
				$api_key = of_get_option( 'theme_update-api_key', '' );

				$upgrader = new Envato_WordPress_Theme_Upgrader( $user, $api_key );
				$response = $upgrader->upgrade_theme();

				set_transient( 'presscore_update_result', $response, 10 );

				unset( $dt_lang_backup_dir_timestamp );

				if ( $response ) {
					wp_safe_redirect( esc_url_raw( add_query_arg( 'theme-updater', 'updated', remove_query_arg( 'theme-updater' ) ) ) );
					exit;
				} else {
					wp_safe_redirect( esc_url_raw( remove_query_arg( 'theme-updater' ) ) );
					exit;
				}

			// regenrate stylesheets after succesful update
			} else if ( isset($_GET['theme-updater']) && 'updated' == $_GET['theme-updater'] && get_transient( 'presscore_update_result' ) ) {
				add_settings_error( 'options-framework', 'theme_updated', _x( 'Stylesheets regenerated.', 'backend', 'the7mk2' ), 'updated fade' );

			}
		}

		/**
		 * Backup files from language dir to temporary folder in uploads.
		 */
		public static function before_theme_update_filter( $res = true, $hook_extra = array() ) {
			global $wp_filesystem, $dt_lang_backup_dir_timestamp;

			if ( !is_wp_error($res) && !empty($dt_lang_backup_dir_timestamp) ) {

				$upload_dir = wp_upload_dir();
				$copy_folder = PRESSCORE_THEME_DIR . '/languages/';
				$dest_folder = $upload_dir['basedir'] . '/dt-language-cache/' . 't' . str_replace( array('\\', '/'), '', $dt_lang_backup_dir_timestamp ) . '/';

				// create dest dir if it's not exist
				if ( wp_mkdir_p( $dest_folder ) ) {

					$files = array_keys( $wp_filesystem->dirlist( $copy_folder ) );
					$files = array_diff( $files, array( 'the7mk2.pot', 'the7mk2.mo' ) );

					// backup files
					foreach ( $files as $file_name ) {
						$wp_filesystem->copy( $copy_folder . $file_name, $dest_folder . $file_name, true, FS_CHMOD_FILE );
					}

				}

			}

			return $res;
		}

		/**
		 * Restore stored language files.
		 */
		public static function after_theme_update_filter( $res = true, $hook_extra = array(), $result = array() ) {
			global $wp_filesystem, $dt_lang_backup_dir_timestamp;

			if ( !is_wp_error($res) && !empty($dt_lang_backup_dir_timestamp) ) {

				$upload_dir = wp_upload_dir();
				$dest_folder = PRESSCORE_THEME_DIR . '/languages/';
				$copy_base = $upload_dir['basedir'] . '/dt-language-cache/';
				$copy_folder = $copy_base . 't' . str_replace( array('\\', '/'), '', $dt_lang_backup_dir_timestamp ) . '/';

				// proceed only if both copy and destination folders exists
				if ( $wp_filesystem->exists( $copy_folder ) && $wp_filesystem->exists( $dest_folder ) ) {

					$files = array_keys( $wp_filesystem->dirlist( $copy_folder ) );

					// restore files
					foreach ( $files as $file_name ) {
						$wp_filesystem->copy( $copy_folder . $file_name, $dest_folder . $file_name, false, FS_CHMOD_FILE );
					}

					// remove backup folder
					if ( !is_wp_error($result) ) {
						$wp_filesystem->delete( $copy_base, true );
					}

				}

			}

			return $res;
		}
	}

	Presscore_Modules_ThemeUpdateModule::execute();

endif;

if ( ! function_exists( 'presscore_theme_update_get_changelog_url' ) ) :

	function presscore_theme_update_get_changelog_url() {
		return 'http://the7.dream-demo.com/changelog.txt';
	}

endif;

if ( ! function_exists( 'presscore_theme_update_get_install_plugins_link' ) ) :

	/**
	 * This function will return tgm admin page link if $show is true. By default return empty string.
	 *
	 * @since 3.1.3
	 * @param  boolean $show
	 * @return string
	 */
	function presscore_theme_update_get_install_plugins_link( $show = false ) {
		global $tgmpa;
		$link_html = '';
		if ( $tgmpa && ! $tgmpa->is_tgmpa_complete() ) {
			/* translators: Link on the Theme Update options page */
			$link_html = sprintf( __( '<a href="%s">Install/update recommended plugins</a>', 'the7mk2' ), esc_url( add_query_arg( 'page', $tgmpa->menu, admin_url( $tgmpa->parent_slug ) ) ) );
			$link_html .= '&nbsp;&nbsp;&nbsp;';
		}
		return $link_html;
	}

endif;
