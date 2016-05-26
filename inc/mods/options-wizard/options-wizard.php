<?php
/**
 * Options wizard module.
 *
 * @since 3.0.0
 * @package the7
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Presscore_Modules_OptionsWizardModule', false ) ) :

	class Presscore_Modules_OptionsWizardModule {
		protected static $options_page_id = 'of-options-wizard';

		/**
		 * Main method.
		 */
		public static function execute() {
			// Add options page.
			add_filter( 'presscore_options_menu_config', array( __CLASS__, 'add_options_menu_items_filter' ) );
			add_filter( 'presscore_options_files_list', array( __CLASS__, 'register_options_file_filter' ), 0, 2 );

			add_action( 'admin_init', array( __CLASS__, 'add_hooks_action' ) );
		}

		public static function cleanup_action() {
			delete_option( 'the7_wizard_page_first_run' );
			delete_option( 'the7_options_saved' );
		}

		/**
		 * Add wizard page specific hooks.
		 */
		public static function add_hooks_action() {
			if ( self::$options_page_id != optionsframework_get_cur_page_id() ) {
				return;
			}

			// Setup custom dependencies.
			add_filter( 'of_localized_vars', array( __CLASS__, 'of_localized_vars_filter' ) );

			add_filter( 'of_get_default_values', array( __CLASS__, 'override_options_filter' ) );
			add_filter( 'optionsframework_get_validated_options', array( __CLASS__, 'optionsframework_get_validated_options_filter' ), 10, 2 );

			if ( self::wizard_start_from_scratch() ) {
				add_filter( ( 'optionsframework_fields_saved_settings-' . self::$options_page_id ), array( __CLASS__, 'optionsframework_fields_saved_settings_filter' ) );
				add_action( 'optionsframework_after_options', array( __CLASS__, 'wizard_mode_hidden_fields_action' ) );
				add_action( 'optionsframework_before', array( __CLASS__, 'optionsframework_before_action' ) );
			} else {
				add_action( 'optionsframework_after', array( __CLASS__, 'print_wizard_mode_selector_action' ) );
				add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_enqueue_scripts_action' ) );
			}
		}

		public static function admin_enqueue_scripts_action() {
			wp_enqueue_script( 'dt-wizard', trailingslashit( PRESSCORE_MODS_URI ) . basename( dirname( __FILE__ ) ) . '/assets/js/wizard.js', array( 'options-custom' ), wp_get_theme()->get( 'Version' ), true );

			$options_is_saved = optionsframework_options_is_saved();
			$saved_msg = get_settings_errors( 'options-framework' );

			wp_localize_script('dt-wizard', 'dtWizard', array(
				'showModeSelector' => empty( $saved_msg ) && $options_is_saved,
			));
		}

		/**
		 * Validate wizard options.
		 *
		 * @param  array $clean
		 * @param  array $input
		 * @return array
		 */
		public static function optionsframework_get_validated_options_filter( $clean, $input ) {
			$header_preset_relation = array(
				'inline' => 'wizard01',
				'split' => 'wizard02',
				'classic' => 'wizard03',
				'slide_out' => 'wizard04',
				'side' => 'wizard05',
				'overlay' => 'wizard06',
			);
			$header_layout = $input['header-layout'];

			$preset_id = isset( $header_preset_relation[ $header_layout ] ) ? $header_preset_relation[ $header_layout ] : 'skin07s';

			// Get all saved options.
			$known_options = get_option( 'optionsframework', array() );
			$saved_options = get_option( $known_options['id'], array() );
			if ( ! is_array( $saved_options ) ) {
				$saved_options = array();
			}

			// Get preset options.
			$preset_options = optionsframework_presets_data( $preset_id );

			$preserve = apply_filters( 'optionsframework_validate_preserve_fields', array() );

			// Ignore preserved options.
			foreach ( $preserve as $option ) {
				if ( isset( $preset_options[ $option ] ) ) {
					unset( $preset_options[ $option ] );
				}
			}

			if ( !isset( $preset_options['preset'] ) ) {
				$preset_options['preset'] = $preset_id;
			}

			$sanitized_input = self::sanitize_options( (array) $input, $preset_options );

			if ( isset( $_POST['pcor_wizard_mode'] ) && 'from_scratch' === $_POST['pcor_wizard_mode'] ) {
				$sanitized_input = self::override_options_filter( array_merge( $preset_options, $sanitized_input ) );
				$sanitized_input = self::sanitize_options( $sanitized_input, $preset_options );

				add_filter( 'wp_redirect', array( __CLASS__, 'switch_mode_with_redirect_filter' ) );
			}

			return array_merge( $saved_options, $sanitized_input );
		}

		/**
		 * Filter for "wp_redirect". Switch off "from_scratch" wizard mode.
		 *
		 * @return string
		 */
		public static function switch_mode_with_redirect_filter( $location ) {
			return remove_query_arg( 'wizard_mode', $location );
		}

		/**
		 * Output wizard mode selection dialog.
		 */
		public static function print_wizard_mode_selector_action() {
			?>

			<div class="of-info-block hide-if-js">
				<p><?php echo _x( 'Theme Options Wizard works in two modes: it allows to "Customize Existing Design" or "Start From a Scratch".', 'theme-options', 'the7mk2' ); ?></p>
				<p><?php printf( _x( '<strong>Attention!</strong> If you choose to "Start From a Scratch", Wizard will automatically calculate and overwrite most of your settings! You may want to use <a href="%s">Export/Import Options</a> interface to backup your current theme options state before proceeding.', 'theme-options', 'the7mk2' ), admin_url( 'admin.php?page=of-importexport-menu' ) ); ?></p>
				<p>
					<a class="button-secondary" href="<?php echo esc_url( add_query_arg( array( 'page' => self::$options_page_id, 'wizard_mode' => 'from_scratch' ), admin_url( 'admin.php' ) ) ); ?>" onclick="return confirm( '<?php print esc_js( _x( 'Attention! By “Starting From a Scratch", you will reset most of your site appearance settings! Would you like to proceed?', 'theme-options', 'the7mk2' ) ); ?>' );"><?php echo esc_html( _x( 'Start From a Scratch', 'theme-options', 'the7mk2' ) ); ?></a>
					<input class="button-primary" value="<?php echo esc_attr( _x( 'Customize Existing Design', 'theme-options', 'the7mk2' ) ); ?>" type="button">
				</p>
			</div>

			<?php
		}

		/**
		 * Output hidden input with wizard mode.
		 */
		public static function wizard_mode_hidden_fields_action() {
			echo '<input type="hidden" name="pcor_wizard_mode" value="from_scratch" />';
		}

		/**
		 * Add inline css to hide "Restore Defaults" button.
		 */
		public static function optionsframework_before_action() {
			?>
			<style type="text/css">
			#optionsframework-submit .reset-button {display: none;}
			</style>
			<?php
		}

		/**
		 * Checking from_scratch mode.
		 *
		 * @return boolean
		 */
		public static function wizard_start_from_scratch() {
			return ( isset( $_GET['wizard_mode'] ) && 'from_scratch' == $_GET['wizard_mode'] );
		}

		/**
		 * Populate wizard options with default values.
		 *
		 * @param  array $settings
		 * @return array
		 */
		public static function optionsframework_fields_saved_settings_filter( $settings ) {
			return optionsframework_presets_data( 'wizard01' );
		}

		/**
		 * Add wizard page to theme options menu.
		 *
		 * @param array $pages
		 * @return array
		 */
		public static function add_options_menu_items_filter( $pages = array() ) {
			$pages = array_reverse( $pages );
			$pages[ self::$options_page_id ] = array( 'menu_title' => _x( 'Wizard', 'theme-options', 'the7mk2' ) );
			$pages = array_reverse( $pages );
			return $pages;
		}

		/**
		 * Register wizard options.
		 *
		 * @param  array  $files
		 * @param  string $page_slug
		 * @return array
		 */
		public static function register_options_file_filter( $files = array(), $page_slug = null ) {
			if ( self::$options_page_id === $page_slug ) {
				$files[ self::$options_page_id ] = plugin_dir_path( __FILE__ ) . 'options.php';
			}
			return $files;
		}

		/**
		 * Setup wizard options dependencies.
		 *
		 * @param  array $vars
		 * @return array
		 */
		public static function of_localized_vars_filter( $vars ) {
			$vars['blockDependencies'] = array(
				// Layout.
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

				// Branding.
				'branding-menu-icon-block' => array(
					array(
						array(
							'field' => 'header-layout',
							'operator' => '==',
							'value' => 'slide_out',
						),
					),
					array(
						array(
							'field' => 'header-layout',
							'operator' => '==',
							'value' => 'overlay',
						),
					),
				),
				'branding-floating-nav-block' => array(
					array(
						array(
							'field' => 'header-layout',
							'operator' => '==',
							'value' => 'classic',
						),
						array(
							'field' => 'header-show_floating_navigation',
							'operator' => '==',
							'value' => '1',
						),
					),
					array(
						array(
							'field' => 'header-layout',
							'operator' => '==',
							'value' => 'inline',
						),
						array(
							'field' => 'header-show_floating_navigation',
							'operator' => '==',
							'value' => '1',
						),
					),
					array(
						array(
							'field' => 'header-layout',
							'operator' => '==',
							'value' => 'split',
						),
						array(
							'field' => 'header-show_floating_navigation',
							'operator' => '==',
							'value' => '1',
						),
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
						),
						array(
							'field' => 'header-show_floating_navigation',
							'operator' => '==',
							'value' => '1',
						),
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
						),
						array(
							'field' => 'header-show_floating_navigation',
							'operator' => '==',
							'value' => '1',
						),
					)
				),

				// Floating header
				'header-floating-nav-block' => array(
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

		/**
		 * Override saved options.
		 *
		 * @param  array $options
		 * @return array
		 */
		public static function override_options_filter( $options ) {
			// Text color.
			$options['stripes-stripe_1_text_color'] = $options['footer-primary_text_color'];
			$options['sidebar-primary_text_color'] = $options['general-breadcrumbs_color'] = $options['content-primary_text_color'];

			// Headers color.
			$options['stripes-stripe_1_headers_color'] = $options['footer-headers_color'];
			$options['sidebar-headers_color'] = $options['general-title_color'] = $options['content-headers_color'];

			// Stripe background color.
			$options['stripes-stripe_1_color'] = $options['footer-bg_color'];

			// Text font family.
			$options['top_bar-font-family'] = $options['header-menu-submenu-font-family'] = $options['header-mobile-submenu-font-family'] = $options['header-elements-near_menu-font_family'] = $options['header-elements-near_logo-font_family'] = $options['fonts-font_family'];

			// Headers font family.
			$options['fonts-h2_font_family'] = $options['fonts-h3_font_family'] = $options['fonts-h4_font_family'] = $options['fonts-h5_font_family'] = $options['fonts-h6_font_family'] = $options['header-menu-font-family'] = $options['header-mobile-menu-font-family'] = $options['buttons-s_font_family'] = $options['buttons-m_font_family'] = $options['buttons-l_font_family'] = $options['fonts-h1_font_family'];

			// Sidebar style
			switch ( $options['sidebar-visual_style'] ) {
				case 'with_dividers':
					$options['sidebar-divider-vertical'] = '1';
					$options['sidebar-divider-horizontal'] = '1';
					$options['sidebar-vertical_distance'] = '88';
					break;
				case 'with_bg':
					$options['sidebar-divider-horizontal'] = '1';
					$options['sidebar-vertical_distance'] = '70';
					break;
				case 'with_widgets_bg':
					$options['sidebar-vertical_distance'] = '20';
					break;
			}

			$options['bottom_bar-color'] = $options['footer-primary_text_color'];

			// Header.
			$header_layout = $options['header-layout'];
			switch( $header_layout ) {
				case 'classic':
					if ( 'left' == $options['header-classic-logo-position'] ) {
						$options['header-classic-elements-near_logo_left-padding-right'] = '30';
					} else {
						$options['header-classic-elements-near_logo_left-padding-right'] = '0';
					}
					break;
				case 'inline':
					if ( $options['header-inline-is_fullwidth'] ) {
						$options['top_bar-paddings-horizontal'] = $options['header-inline-elements-near_menu_right-padding-right'] = $options['header-logo-padding-left'] = $options['header-style-transparent-logo-padding-left'] = $options['header-style-floating-logo-padding-left'] = '30';
					} else {
						$options['top_bar-paddings-horizontal'] = $options['header-inline-elements-near_menu_right-padding-right'] = $options['header-logo-padding-left'] = $options['header-style-transparent-logo-padding-left'] = $options['header-style-floating-logo-padding-left'] = '0';
					}

					if ( 'left' == $options['header-inline-menu-position'] ) {
						$options['header-style-floating-logo-padding-right'] = '30';
					} else {
						$options['header-style-floating-logo-padding-right'] = '0';
					}
					break;
				case 'split':
					if ( $options['header-split-is_fullwidth'] ) {
						$options['top_bar-paddings-horizontal'] = $options['header-split-elements-near_menu_left-padding-left'] = $options['header-split-elements-near_menu_right-padding-right'] = '30';
					} else {
						$options['top_bar-paddings-horizontal'] = $options['header-split-elements-near_menu_left-padding-left'] = $options['header-split-elements-near_menu_right-padding-right'] = '0';
					}
					break;
				case 'slide_out':
				case 'overlay':
					if ( 'menu_icon' == $options["header-{$header_layout}-layout"] ) {
						self::populate_indent_options( $options, 'header-menu_icon-margin', '30' );
						self::populate_indent_options( $options, 'header-style-mixed-logo-padding', '30' );
					} elseif ( 'top_line' == $options["header-{$header_layout}-layout"] ) {
						self::populate_indent_options( $options, 'header-menu_icon-margin', array( '0', '30', '0', '30' ) );
						self::populate_indent_options( $options, 'header-style-mixed-logo-padding', '0' );
					} elseif ( 'side_line' == $options["header-{$header_layout}-layout"] ) {
						self::populate_indent_options( $options, 'header-menu_icon-margin', '5' );
						self::populate_indent_options( $options, 'header-style-mixed-logo-padding', '5' );
					}
					$options["header-{$header_layout}-layout-top_line-is_fullwidth"] = '1';
					break;
			}

			// Fill floating navigation bg color with header bg color.
			$options['header-floating_navigation-bg-color'] = $options['header-bg-color'];

			// Microwidgets color.
			$options['header-elements-near_menu-font_color'] = $options['header-elements-near_logo-font_color'] = $options['header-menu-font-color'];

			// Bottom bar color.
			$options['bottom_bar-bg_color'] = $options['footer-primary_text_color'];
			$options['bottom_bar-bg_opacity'] = '15';

			// Top bar color.
			if ( in_array( $options['top_bar-bg-style'], array( 'content_line', 'fullwidth_line' ) ) ) {
				$options['top_bar-bg-color'] = $options['header-menu-font-color'];
				$options['top_bar-bg-opacity'] = '15';
			}

			// Social icons color.
			$options['header-elements-soc_icons-color'] = $options['header-elements-soc_icons-bg-color'] = $options['top_bar-font-color'];
			$options['header-elements-soc_icons-bg-opacity'] = '15';

			return $options;
		}

		/**
		 * Sanitize wizard options.
		 *
		 * @param  array $used_options
		 * @param  array  $defaults
		 * @return array
		 */
		protected static function sanitize_options( $used_options, $defaults = array() ) {
			// Use all options for sanitazing.
			$options =& _optionsframework_options();
			$clean = array();
			foreach ( $options as $option ) {
				if ( ! isset( $option['id'], $option['type'] ) ) {
					continue;
				}

				$id = preg_replace( '/(\W!-)/', '', strtolower( $option['id'] ) );

				// Set checkbox to false if it wasn't sent in the $_POST.
				if ( 'checkbox' == $option['type'] && ! isset( $used_options[ $id ] ) ) {
					$used_options[ $id ] = false;
				}

				// Set each item in the multicheck to false if it wasn't sent in the $_POST.
				if ( 'multicheck' == $option['type'] && ! isset( $used_options[ $id ] ) ) {
					foreach ( $option['options'] as $key => $value ) {
						$used_options[ $id ][ $key ] = false;
					}
				}

				// Override defaults.
				if ( isset( $defaults[ $id ] ) ) {
					$option['std'] = $defaults[ $id ];
				}

				if ( ! isset( $used_options[ $id ] ) ) {
					continue;
				}

				if ( 'upload' == $option['type'] && is_array( $used_options[ $id ] ) && isset( $used_options[ $id ][1] ) && is_numeric( $used_options[ $id ][1] ) ) {
					$used_options[ $id ] = array_reverse( $used_options[ $id ] );
				}

				// For a value to be submitted to database it must pass through a sanitization filter.
				if ( ! empty( $option['sanitize'] ) && has_filter( 'of_sanitize_' . $option['sanitize'] ) ) {
					$clean[ $id ] = apply_filters( 'of_sanitize_' . $option['sanitize'], $used_options[ $id ], $option );
				} elseif ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
					$clean[ $id ] = apply_filters( 'of_sanitize_' . $option['type'], $used_options[ $id ], $option );
				}
			}
			return $clean;
		}

		/**
		 * This method helps populate indent options.
		 *
		 * @param  array &$options
		 * @param  string $option_base
		 * @param  string $val
		 * @return array
		 */
		protected static function populate_indent_options( &$options, $option_base, $val = '0' ) {
			if ( ! is_array( $val ) ) {
				$val = array_fill( 0, 4, $val );
			}

			$options["{$option_base}-top"] = $val[0];
			$options["{$option_base}-right"] = $val[1];
			$options["{$option_base}-bottom"] = $val[2];
			$options["{$option_base}-left"] = $val[3];
		}
	}

	Presscore_Modules_OptionsWizardModule::execute();

endif;
