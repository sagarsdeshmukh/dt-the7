<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$category = presscore_get_config()->get( 'subcategory' );
?>

<div class="rollover-project forward-post">

	<?php dt_woocommerce_subcategory_thumbnail( $category ); ?>

	<?php if ( dt_woocommerce_product_show_content() ) : ?>

		<div class="rollover-content">
			<div class="wf-table">
				<div class="wf-td">
					<div class="rollover-content-container">

						<?php dt_woocommerce_template_subcategory_description(); ?>

					</div>
				</div>
			</div>
		</div>

	<?php endif; ?>

</div>