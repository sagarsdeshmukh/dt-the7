<?php
/**
 * Blog post content with media, even layout
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// remove presscore_the_excerpt() filter
remove_filter( 'presscore_post_details_link', 'presscore_return_empty_string', 15 );

$config = Presscore_Config::get_instance();

$article_content_layout = presscore_get_template_image_layout( $config->get( 'layout' ), $config->get( 'post.query.var.current_post' ) );
?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class( array( 'post', 'project-' . $article_content_layout ) ); ?>>

	<?php
	$post_format = get_post_format();

	if ( 'odd' == $article_content_layout || 'wide' == $config->get( 'post.preview.width' ) ) {

		// media
		if ( presscore_post_format_supports_media_content( $post_format ) ) {
			presscore_get_template_part( 'theme', 'blog/list/blog-list-post-media', $post_format );
		}

		// content
		presscore_get_template_part( 'theme', 'blog/list/blog-list-post-content', $post_format );

	} else {

		// content
		presscore_get_template_part( 'theme', 'blog/list/blog-list-post-content', $post_format );

		// media
		if ( presscore_post_format_supports_media_content( $post_format ) ) {
			presscore_get_template_part( 'theme', 'blog/list/blog-list-post-media', $post_format );
		}

	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>