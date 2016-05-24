<?php
/**
 * Portfolio post content part with rollover
 *
 * @since 1.0.0
 * @package vogue
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$content = presscore_mod_albums_get_photo_description();

$img_id = get_the_ID();
$img_class = '';
if ( ! $content ) {
	$img_class .= ' rollover';
	$img_class .= presscore_get_image_video_url( $img_id ) ? ' rollover-video' : ' rollover-zoom';
}
$image = presscore_mod_albums_get_photo_img( $img_id, $img_class );

$template_args = array(
	'image'				=> $image,
	'content'			=> $content,
	'figure_class'		=> 'links-hovers-disabled',
);

presscore_get_template_part( 'theme', 'post-layouts/description-on-image', null, $template_args );
