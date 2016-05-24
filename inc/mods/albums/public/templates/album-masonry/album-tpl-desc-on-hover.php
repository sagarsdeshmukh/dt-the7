<?php
/**
 * Album template with description on hover.
 *
 * @package the7\Albums\Templates
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$mini_images = presscore_mod_albums_get_mini_images();

$content = presscore_mod_albums_get_preview_decription();

// image
$image_class = '';
if ( ! $mini_images && ! $content ) {
	$image_class .= ' rollover';
	if ( 'lightbox' == $config->get( 'post.open_as' ) ) {
		$image_class .= ' rollover-zoom';
	}
}
$image = presscore_mod_albums_get_preview_gallery( $image_class );

$template_args = array(
	'image'				=> $image,
	'before_content'	=> $mini_images,
	'content'			=> $content,
	'figure_class'		=> 'links-hovers-disabled',
);

presscore_get_template_part( 'theme', 'post-layouts/description-on-image', null, $template_args );
