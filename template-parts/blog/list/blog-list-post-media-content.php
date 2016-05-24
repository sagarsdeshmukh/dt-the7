<?php
/**
 * Blog post media template for list layout
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$thumb_id = get_post_thumbnail_id();

$thumb_args = array(
	'img_meta' 	=> wp_get_attachment_image_src( $thumb_id, 'full' ),
	'img_id'	=> $thumb_id,
	'class'		=> 'rollover',
	'href'		=> get_permalink(),
	'wrap'		=> '<a %HREF% %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a>',
);

$config = Presscore_Config::get_instance();

if ( 'normal' == $config->get( 'post.preview.width' ) ) {
	$thumb_args['class'] .= ' alignleft';

} else {
	$thumb_args['class'] .= ' alignnone';

}

$thumb_args = apply_filters( 'dt_post_thumbnail_args', $thumb_args );

// output media
dt_get_thumb_img( $thumb_args );
