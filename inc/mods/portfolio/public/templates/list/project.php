<?php
/**
 * Portfolio list content. 
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = presscore_config();

$article_content_layout = presscore_get_template_image_layout( $config->get( 'layout' ), $config->get( 'post.query.var.current_post' ) );
?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class( array( 'post', 'project-' . $article_content_layout ) ); ?>>

	<?php
	$image = $rollover_content = $rollover_class = '';

	if ( ! post_password_required() ) {
		switch ( $config->get( 'post.preview.media.style' ) ) {
			case 'featured_image':
				$image_id = get_post_thumbnail_id();
				$link_class = '';
				$link_class .= presscore_get_image_video_url( $image_id ) ? ' rollover-video' : ' rollover';
				$link_class .= 'normal' == $config->get( 'post.preview.width' ) ? ' alignleft' : ' alignnone';

				$image = presscore_project_get_thumbnail_img( $image_id, $link_class );
				$rollover_content = presscore_project_get_preview_buttons( $image_id );

				if ( 1 == presscore_project_preview_buttons_count() ) {
					$rollover_class .= ' rollover-active';
				}
				break;
			case 'slideshow':
				$class = array( 'slider-simple' );
				if ( 'normal' == $config->get( 'post.preview.width' ) ) {
					$class[] = 'alignleft';
				} else {
					$class[] = 'alignnone';
				}
				$image = '<div class="post-slider">' . presscore_get_project_media_slider( $class ) . '</div>';
				break;
		}
	}

	$content = presscore_project_get_preview_content();

	$template_args = array(
		'image'					=> $image,
		'content'				=> $content,
		'rollover_content'		=> $rollover_content,
		'figure_class'			=> $rollover_class,
		'content_wrap_atts'		=> presscore_get_post_content_style_for_blog_list( 'content' ),
		'media_wrap_atts'		=> presscore_get_post_content_style_for_blog_list( 'media' ),
	);

	if ( 'odd' == $article_content_layout || 'wide' == $config->get( 'post.preview.width' ) ) {
		presscore_get_template_part( 'theme', 'post-layouts/description-under-image-odd', null, $template_args );
	} else {
		presscore_get_template_part( 'theme', 'post-layouts/description-under-image-even', null, $template_args );
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>