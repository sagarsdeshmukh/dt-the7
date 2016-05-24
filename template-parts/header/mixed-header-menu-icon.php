<?php
/**
 * Slide out header - menu icon.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div <?php presscore_mixed_header_class( 'masthead mixed-header' ); ?> role="banner">

	<header class="header-bar">

		<?php presscore_get_template_part( 'theme', 'header/mixed-branding' ); ?>

		<?php presscore_header_menu_icon(); ?>

	</header>

</div>