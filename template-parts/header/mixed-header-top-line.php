<?php
/**
 * Slide out header - top line.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div <?php presscore_mixed_header_class( 'masthead mixed-header' ); presscore_header_inline_style(); ?> role="banner">

	<header class="header-bar">

		<?php presscore_get_template_part( 'theme', 'header/mixed-branding' ); ?>

		<?php presscore_render_header_elements( 'side_top_line' ); ?>

		<?php presscore_header_menu_icon(); ?>

	</header>

</div>