<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$category = presscore_get_config()->get( 'subcategory' );
?>

<?php dt_woocommerce_subcategory_thumbnail( $category, 'alignnone' ); ?>

<div class="woocom-list-content">

	<?php dt_woocommerce_template_subcategory_description(); ?>

</div>