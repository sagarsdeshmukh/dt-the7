<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$category = presscore_get_config()->get( 'subcategory' );
?>
<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

<?php do_action( 'woocommerce_before_subcategory_title', $category ); ?>

<?php if ( presscore_get_config()->get( 'show_titles' ) && get_the_title() ) : ?>

	<h3 class="entry-title">
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<?php
				echo $category->name;

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?>
		</a>
	</h3>

<?php endif; ?>

<?php do_action( 'woocommerce_after_subcategory_title', $category ); ?>

<?php do_action( 'woocommerce_after_subcategory', $category ); ?>