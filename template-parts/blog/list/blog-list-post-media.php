<?php
/**
 * Blog post content media template
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// check show or not media content
if ( presscore_show_post_media() ): ?>

	<div class="blog-media wf-td" <?php echo presscore_get_post_content_style_for_blog_list( 'media' ); ?>>

	<?php
	/////////////////
	// fancy date //
	/////////////////

	echo presscore_get_blog_post_fancy_date();

	/////////////////////
	// media template //
	/////////////////////

	presscore_get_template_part( 'theme', "blog/list/blog-list-post-media-content", get_post_format() );
	?>

	</div>

<?php endif; ?>