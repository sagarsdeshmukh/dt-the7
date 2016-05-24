<?php
/**
 * Blog post content with media, odd layout
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// remove presscore_the_excerpt() filter
remove_filter( 'presscore_post_details_link', 'presscore_return_empty_string', 15 );
?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class( 'post' ); ?>>

	<?php
	/////////////
	// media //
	/////////////

	if ( presscore_post_format_supports_media_content( get_post_format() ) ) {
		presscore_get_template_part( 'theme', 'blog/masonry/blog-masonry-post-media' );
	}

	//////////////
	// content //
	//////////////

	presscore_get_template_part( 'theme', 'blog/masonry/blog-masonry-post-content' );
	?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>