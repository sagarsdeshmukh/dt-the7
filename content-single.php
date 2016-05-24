<?php
/**
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;

// thumbnail visibility
$hide_thumbnail = (bool) get_post_meta($post->ID, '_dt_post_options_hide_thumbnail', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action('presscore_before_post_content'); ?>

	<?php if ( !post_password_required() ) : ?>

	<?php

	$img_class = 'alignleft';
	$img_options = array( 'w' => 270, 'z' => 1 );

	$post_format = get_post_format();

	switch ( $post_format ) {

		case 'video':

			// thumbnail
			if ( has_post_thumbnail() && ( $video_url = esc_url( get_post_meta( get_post_thumbnail_id(), 'dt-video-url', true ) ) ) ) {
				echo '<div class="post-video alignnone">' . dt_get_embed( $video_url ) . '</div>';
			}

			// post content
			the_content();

			break;

		case 'gallery':

			// post content
			the_content();

			break;

		case 'aside':
		case 'link':
		case 'quote':
		case 'status':

			// post content
			presscore_get_template_part( 'theme', 'blog/blog-post-content-part', $post_format );
			break;

		case 'image':
		default:
			$img_class = 'alignnone';
			$img_options = false;

			// thumbnail
			if ( has_post_thumbnail() && !$hide_thumbnail ) {
				$thumb_id = get_post_thumbnail_id();
				$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );

				dt_get_thumb_img( array(
					'class'		=> $img_class . ' rollover rollover-zoom dt-single-mfp-popup dt-mfp-item mfp-image',
					'img_meta' 	=> $thumb_meta,
					'img_id'	=> $thumb_id,
					'options' 	=> $img_options,
					'wrap'		=> '<a %HREF% %CLASS% %CUSTOM% title="%RAW_ALT%" data-dt-img-description="%RAW_TITLE%"><img %IMG_CLASS% %SRC% %SIZE% %IMG_TITLE% %ALT% /></a>',
				) );
			}

			// post content
			the_content();

	}
	?>

	<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'the7mk2' ), 'after' => '</div>' ) ); ?>

	<?php
	$post_tags = '';
	$config = presscore_get_config();
	if ( $config->get( 'post.meta.fields.tags' ) ) {
		$post_tags = presscore_get_post_tags_html();
	}

	$share_buttons = presscore_display_share_buttons_for_post('post', array('echo' => false));

	if ( $share_buttons || $post_tags ) {
		printf( '<div class="post-meta wf-mobile-collapsed">%s</div>', $post_tags . $share_buttons );
	}
	?>

	<?php
	// 'theme options' -> 'general' -> 'show author info on blog post pages'
	if ( $config->get( 'post.author_block' ) ) {
		presscore_display_post_author();
	}
	?>

	<?php presscore_display_related_posts(); ?>

	<?php else: ?>

		<?php the_content(); ?>

	<?php endif; // !post_password_required ?>

	<?php do_action('presscore_after_post_content'); ?>

</article><!-- #post-<?php the_ID(); ?> -->