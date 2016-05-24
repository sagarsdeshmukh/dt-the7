<?php
/**
 * Portfolio single template
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('project-post'); ?>>

	<?php
	do_action('presscore_before_post_content');

	if ( ! post_password_required() ) {
		presscore_get_template_part( 'mod_portfolio', 'portfolio-post-single-content' );

	} else {
		the_content();

	}

	do_action('presscore_after_post_content');
	?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php presscore_display_related_projects(); ?>