<?php
/**
 * Theme options files.
 *
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

return array(
	'options-framework'          => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-general.php',
	'of-skins-menu'              => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-skins.php',
	'of-header-menu'             => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-header.php',
	'of-branding-menu'           => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-branding.php',
	'of-stripes-menu'            => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-stripes.php',
	'of-sidebar-menu'            => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-sidebar.php',
	'of-footer-menu'             => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-footer.php',
	'of-blog-and-portfolio-menu' => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-blog-and-portfolio.php',
	'of-contentarea-menu'        => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-page-titles.php',
	'of-fonts-menu'              => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-fonts.php',
	'of-buttons-menu'            => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-buttons.php',
	'of-imghoovers-menu'         => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-imagehoovers.php',
	'of-likebuttons-menu'        => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-likebuttons.php',
	'of-widgetareas-menu'        => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-widgetareas.php',
	'of-importexport-menu'       => PRESSCORE_ADMIN_OPTIONS_DIR . '/options-importexport.php',
);
