<?php
/**
 * Project template for masonry/grid/justified-grid layouts.
 *
 * @package the7\Portfolio\Templates
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class('post'); ?>>

	<?php
	if ( 'under_image' == presscore_config()->get( 'post.preview.description.style' ) ) {
		include plugin_dir_path( __FILE__ ) . 'project-tpl-desc-under-img.php';
	} else {
		include plugin_dir_path( __FILE__ ) . 'project-tpl-desc-on-hover.php';
	}
	?>

</article>

<?php do_action('presscore_after_post'); ?>