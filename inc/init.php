<?php
/**
 * Theme init.
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// load constants.
require_once trailingslashit( get_template_directory() ) . 'inc/constants.php';

// Load extensions
if ( ! class_exists( 'Mobile_Detect', false ) ) {
	require_once PRESSCORE_EXTENSIONS_DIR . '/mobile-detect.php';
}

if ( ! class_exists( 'Color', false ) ) {
	require_once PRESSCORE_EXTENSIONS_DIR . '/color.php';
}

require_once PRESSCORE_EXTENSIONS_DIR . '/aq_resizer.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/core-functions.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/stylesheet-functions.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/dt-pagination.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/presscore-web-fonts-compressor.php';

// less
require_once PRESSCORE_EXTENSIONS_DIR . '/class-less.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/class-composition.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/class-factory.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/class-builder.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/class-color.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/class-number.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/class-image.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/class-font.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/less-vars/class-manager.php';

// utils
require_once PRESSCORE_EXTENSIONS_DIR . '/class-presscore-simple-bag.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/class-presscore-template-manager.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/class-presscore-query.php';

if ( ! defined( 'OPTIONS_FRAMEWORK_VERSION' ) ) {
	require_once PRESSCORE_EXTENSIONS_DIR . '/options-framework/options-framework.php';
	require_once PRESSCORE_ADMIN_DIR . '/theme-options-parts.php';

	add_filter( 'options_framework_location', 'presscore_add_theme_options' );
}

/**
 * Include utility classes.
 */
require_once PRESSCORE_CLASSES_DIR . '/template-config/presscore-config.class.php';

require_once PRESSCORE_CLASSES_DIR . '/class-primary-menu.php';

require_once PRESSCORE_CLASSES_DIR . '/sliders/presscore-slider.class.php';
require_once PRESSCORE_CLASSES_DIR . '/sliders/presscore-photoscroller.class.php';
require_once PRESSCORE_CLASSES_DIR . '/sliders/slider-swapper.class.php';
require_once PRESSCORE_CLASSES_DIR . '/sliders/presscore-posts-slider-scroller.class.php';

require_once PRESSCORE_CLASSES_DIR . '/layout/columns-layout-parser.class.php';
require_once PRESSCORE_CLASSES_DIR . '/layout/sidebar-layout-parser.class.php';

require_once PRESSCORE_CLASSES_DIR . '/abstract-presscore-ajax-content-builder.php';

require_once PRESSCORE_CLASSES_DIR . '/tags.class.php';
require_once PRESSCORE_CLASSES_DIR . '/class-presscore-post-type-rewrite-rules-filter.php';

require_once PRESSCORE_DIR . '/helpers.php';
require_once PRESSCORE_DIR . '/template-hooks.php';

include_once locate_template( 'inc/widgets/load-widgets.php' );
include_once locate_template( 'inc/shortcodes/load-shortcodes.php' );

// Setup theme.
require_once PRESSCORE_DIR . '/theme-setup.php';

// Dynamic stylesheets.
require_once PRESSCORE_DIR . '/dynamic-stylesheets-functions.php';

// Frontend functions.
require_once PRESSCORE_DIR . '/static.php';

// Ajax functions.
require_once PRESSCORE_DIR . '/ajax-functions.php';

if ( is_admin() ) {

	require_once PRESSCORE_EXTENSIONS_DIR . '/class-presscore-admin-notices.php';

	require_once PRESSCORE_ADMIN_DIR . '/admin-notices.php';
	require_once PRESSCORE_ADMIN_DIR . '/admin-functions.php';
	require_once PRESSCORE_ADMIN_DIR . '/admin-bulk-actions.php';

	include_once locate_template( 'inc/admin/load-meta-boxes.php' );

}
