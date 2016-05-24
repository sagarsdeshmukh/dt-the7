<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( 'disabled' == presscore_config()->get( 'sidebar_position' ) ) {
	return;
}

$sidebar = presscore_config()->get( 'sidebar_widgetarea_id' );

// default sidebar
if ( ! $sidebar ) {
	$sidebar = apply_filters( 'presscore_default_sidebar', 'sidebar_1' );
}

// disable widget dividers
$dividers_off = '';
if ( ! presscore_config()->get( 'sidebar.style.dividers.horizontal' ) ) {
	$dividers_off = ' widget-divider-off';
}

if ( is_active_sidebar( $sidebar ) ) : ?>

				<aside id="sidebar" <?php echo presscore_sidebar_html_class( 'sidebar' ); ?>>
					<div class="sidebar-content<?php echo $dividers_off; ?>">
						<?php
						do_action( 'presscore_before_sidebar_widgets' );
						dynamic_sidebar( $sidebar );
						?>
					</div>
				</aside><!-- #sidebar -->

<?php endif; ?>