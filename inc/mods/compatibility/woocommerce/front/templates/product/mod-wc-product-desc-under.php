<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// get rollover icons
$rollover_icons = dt_woocommerce_get_product_preview_icons();
if ( $rollover_icons ) {
	$rollover_icons = '<div class="woo-buttons">' . $rollover_icons . '</div>';
}
?>
<figure class="woocom-project">
	<div class="buttons-on-img">

		<?php presscore_wc_template_loop_product_thumbnail( 'alignnone' ); ?>

		<?php echo $rollover_icons; ?>

	</div>
	<figcaption class="woocom-list-content">
		<?php echo dt_woocommerce_get_product_description(); ?>
	</figcaption>
</figure>