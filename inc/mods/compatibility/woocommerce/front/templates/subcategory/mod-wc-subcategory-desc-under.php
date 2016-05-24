<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$category = presscore_get_config()->get( 'subcategory' );
?>
<div class="project-list-media">
	<div class="buttons-on-img">

		<?php dt_woocommerce_subcategory_thumbnail( $category, 'alignnone' ); ?>

	</div>
</div>
<div class="project-list-content">

	<?php dt_woocommerce_template_subcategory_description(); ?>

</div>