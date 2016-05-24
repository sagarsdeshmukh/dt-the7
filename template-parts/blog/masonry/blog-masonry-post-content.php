<?php
/**
 * Blog simple post content
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

?>
<div class="blog-content wf-td">

	<?php presscore_get_template_part( 'theme', 'blog/blog-post-content-part', get_post_format() ); ?>

	<?php
	if ( presscore_get_config()->get( 'show_details' ) ) {
		echo presscore_post_details_link();
	}
	?>

	<?php echo presscore_get_posted_on(); ?>

	<?php echo presscore_post_edit_link(); ?>

</div>