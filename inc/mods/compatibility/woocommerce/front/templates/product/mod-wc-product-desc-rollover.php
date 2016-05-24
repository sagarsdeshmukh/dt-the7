<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// get rollover icons
$rollover_icons = dt_woocommerce_get_product_preview_icons();
if ( $rollover_icons ) {
	$rollover_icons = '<div class="woo-buttons">' . $rollover_icons . '</div>';
}

// get content
$content = dt_woocommerce_get_product_description();
if ( $content ) {
	$content = '<div class="rollover-content-container">' . $content . '</div>';
}
?>
<figure class="woocom-project">

	<?php presscore_wc_template_loop_product_thumbnail(); ?>

	<?php if ( $rollover_icons || $content ) : ?>

		<figcaption class="woocom-rollover-content">

			<?php echo $content; ?>

			<?php echo $rollover_icons; ?>

		</figcaption>

	<?php endif; ?>

</figure>