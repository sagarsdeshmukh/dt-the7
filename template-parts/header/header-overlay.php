<?php
/**
 * Overlay header.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<div <?php presscore_header_class( 'masthead side-header' ); ?> role="banner">

	<header class="header-bar">

		<?php presscore_get_template_part( 'theme', 'header/branding' ); ?>

		<?php presscore_get_template_part( 'theme', 'header/primary-menu' ); ?>

		<?php presscore_render_header_elements( 'below_menu' ); ?>

	</header>

</div>

<?php presscore_get_template_part( 'theme', 'header/mixed-header', presscore_get_mixed_header_layout() ); ?>