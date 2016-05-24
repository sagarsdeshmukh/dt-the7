<?php
/**
 * Top bar.
 *
 * @package the7
 * @since 1.0.0
 * @version 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
		<div <?php presscore_top_bar_class( 'top-bar' ); ?>>
			<?php presscore_render_header_elements( 'top_bar_left' ); ?>
			<?php presscore_render_header_elements( 'top_bar_right' ); ?>
		</div>