<?php
/**
 * Album template with description under image.
 *
 * @package the7\Albums\Templates
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$mini_images = presscore_mod_albums_get_mini_images();

$content = presscore_mod_albums_get_preview_decription();

// image
$image_class = 'rollover';
if ( ! $mini_images ) {
	$image_class .= ' rollover-zoom';
}
$image = presscore_mod_albums_get_preview_gallery( $image_class );

$template_args = array(
	'image'				=> $image,
	'content'			=> $content,
	'rollover_content'	=> $mini_images,
);

presscore_get_template_part( 'theme', 'post-layouts/description-under-image-odd', null, $template_args );
