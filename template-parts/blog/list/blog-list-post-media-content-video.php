<?php
/**
 * Blog post media template for video post format in list layout
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// thumbnail meta
$thumb_id = get_post_thumbnail_id();
$video_url = esc_url( get_post_meta( $thumb_id, 'dt-video-url', true ) );

$thumb_args = array(
	'img_meta' => wp_get_attachment_image_src( $thumb_id, 'full' ),
	'img_id' => $thumb_id,
	'href' => $video_url,
	'wrap' => '<a %HREF% %CLASS% %CUSTOM% title="%RAW_ALT%" data-dt-img-description="%RAW_TITLE%"><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a>'
);

$config = presscore_get_config();
$align = 'normal' == $config->get( 'post.preview.width' ) ? 'alignleft' : 'alignnone';
$post_preview_style = $config->get( 'post.preview.video.style' );

if ( ! $video_url ) {
	$thumb_args['href'] = get_permalink();
	$thumb_args['class'] = $align . ' rollover';
} else if ( 'image' == $post_preview_style ) {
	$thumb_args['class'] = $align . ' rollover dt-single-mfp-popup dt-mfp-item mfp-iframe';
} else if ( 'image_play' == $post_preview_style ) {
	$thumb_args['class'] = 'video-icon dt-single-mfp-popup dt-mfp-item mfp-iframe';
	$thumb_args['wrap'] = '<div class="' . $align . ' rollover-video" %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %CLASS% title="%RAW_ALT%" data-dt-img-description="%RAW_TITLE%"></a></div>';
}

$thumb_args = apply_filters( 'dt_post_thumbnail_args', $thumb_args );

// output media
dt_get_thumb_img( $thumb_args );
