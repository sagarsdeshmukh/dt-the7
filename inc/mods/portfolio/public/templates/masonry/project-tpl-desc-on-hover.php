<?php
/**
 * Project template with description on hover.
 *
 * @package the7\Portfolio\Templates
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// rollover icons
$rollover_icons = presscore_project_get_preview_buttons( get_post_thumbnail_id() );

// content
$content = presscore_project_get_preview_content();

// image
$image_id = has_post_thumbnail() ? get_post_thumbnail_id() : 0;

$link_class = '';
if ( ! $rollover_icons && ! $content ) {
	$link_class .= presscore_get_image_video_url( $image_id ) ? ' rollover-video' : ' rollover';
}

$image = presscore_project_get_thumbnail_img( $image_id, $link_class );

$buttonts_count = presscore_project_preview_buttons_count();

$rollover_class = '';
if ( 0 == $buttonts_count ) {
	$rollover_class .= ' forward-post';
} else if ( $buttonts_count < 2 ) {
	$rollover_class .= ' rollover-active';
}

$template_args = array(
	'image'				=> $image,
	'content'			=> $content,
	'before_content'	=> $rollover_icons,
	'figure_class'		=> $rollover_class,
);

presscore_get_template_part( 'theme', 'post-layouts/description-on-image', null, $template_args );
