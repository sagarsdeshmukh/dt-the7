<?php
/**
 * Classic header.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<div <?php presscore_header_class( 'masthead classic-header' ); presscore_header_inline_style(); ?> role="banner">

	<?php presscore_get_template_part( 'theme', 'header/top-bar' ); ?>

	<header class="header-bar">

		<?php presscore_get_template_part( 'theme', 'header/branding' ); ?>

		<nav class="navigation">

			<?php presscore_get_template_part( 'theme', 'header/primary-menu' ); ?>

			<?php presscore_render_header_elements( 'near_menu_right' ); ?>

		</nav>

	</header>

</div>