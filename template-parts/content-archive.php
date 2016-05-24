<?php
/**
 * Arhive content.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php do_action('presscore_before_post'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<?php presscore_get_template_part( 'theme', 'blog/masonry/blog-masonry-post-content' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>