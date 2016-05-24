<?php
/**
 * Slideshow public part.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Slideshow_Public {

	public function register_shortcodes() {
		foreach ( array( 'slideshow' ) as $shortcode_name ) {
			include_once plugin_dir_path( __FILE__ ) . "shortcodes/{$shortcode_name}/{$shortcode_name}.php";
		}
	}

	public function load_shortcodes_vc_bridge() {
		include_once plugin_dir_path( __FILE__ ) . "shortcodes/mod-slideshow-shortcodes-bridge.php";
	}

	public function do_header_slideshow( $type ) {
		global $post;
		$config = Presscore_Config::get_instance();
		switch ( $type ) {
			case 'porthole':
				$class = 'fixed' == $config->get('slideshow_layout') ? 'class="fixed" ' : '';

				$height = absint($config->get( 'slideshow_slider_height' ));
				$width = absint($config->get( 'slideshow_slider_width' ));
				if ( !$height ) {
					$height = 500;
				}

				if ( !$width ) {
					$width = 1200;
				}

				printf( '<div id="main-slideshow" %sdata-width="%d" data-height="%d" data-autoslide="%d" data-scale="%s" data-paused="%s"></div>',
					$class,
					$width,
					$height,
					absint($config->get('slideshow_autoslide_interval')),
					'fit' == $config->get('slideshow_slider_scaling') ? 'fit' : 'fill',
					'paused' == $config->get('slideshow_autoplay') ? 'true' : 'false'
				);

				add_action( 'wp_footer', 'presscore_render_porthole_slider_data', 15 );

				break;

			case 'photo_scroller':
				$slides = array();
				$slider_id = $config->get('slideshow_sliders');
				$slideshow = presscore_query()->get_posts( array( 'post_type' => 'dt_slideshow', 'post__in' => $slider_id, 'has_password' => false ) );

				// prepare data
				if ( $slideshow->have_posts() ) {
					while ( $slideshow->have_posts() ) {

						$slideshow->the_post();

						$media_items = get_post_meta( $post->ID, '_dt_slider_media_items', true );
						if ( empty( $media_items ) ) {
							continue;
						}

						$slides = array_merge( $slides, $media_items );
					}
					wp_reset_postdata();
				}

				$photo_scroller = new Presscore_PhotoScroller( $slides, array(
					'wrap_class' => ( 'fullscreen' == $config->get( 'slideshow.photo_scroller.layout' ) ) ? 'fullscreen-scroller' : '',

					'background_color' => $config->get( 'slideshow.photo_scroller.background.color' ),

					'padding_top' => $config->get( 'slideshow.photo_scroller.padding.top' ),
					'padding_bottom' => $config->get( 'slideshow.photo_scroller.padding.bottom' ),
					'padding_side' => $config->get( 'slideshow.photo_scroller.padding.side' ),

					'autoplay' => ( 'play' == $config->get( 'slideshow.photo_scroller.autoplay.mode' ) ),
					'autoplay_speed' => $config->get( 'slideshow.photo_scroller.autoplay.speed' ),

					'thumbnails_visibility' => $config->get( 'slideshow.photo_scroller.thumbnails.visibility' ),
					'thumbnails_width' => $config->get( 'slideshow.photo_scroller.thumbnail.width' ),
					'thumbnails_height' => $config->get( 'slideshow.photo_scroller.thumbnail.height' ),

					'portrait_images_view' => array(
						'max_width' => $config->get( 'slideshow.photo_scroller.behavior.portrait.width.max' ),
						'min_width' => $config->get( 'slideshow.photo_scroller.behavior.portrait.width.min' ),
						'fill_desktop' => $config->get( 'slideshow.photo_scroller.behavior.portrait.fill.desktop' ),
						'fill_mobile' => $config->get( 'slideshow.photo_scroller.behavior.portrait.fill.mobile' )
					),
					'landscape_images_view' => array(
						'max_width' => $config->get( 'slideshow.photo_scroller.behavior.landscape.width.max' ),
						'min_width' => $config->get( 'slideshow.photo_scroller.behavior.landscape.width.min' ),
						'fill_desktop' => $config->get( 'slideshow.photo_scroller.behavior.landscape.fill.desktop' ),
						'fill_mobile' => $config->get( 'slideshow.photo_scroller.behavior.landscape.fill.mobile' )
					),

					'inactive_opacity' => $config->get( 'slideshow.photo_scroller.inactive.opacity' ),
					'show_overlay' => $config->get( 'slideshow.photo_scroller.overlay.enabled' ),
					'show_post_navigation' => false,
					'show_share_buttons' => false
				) );

				if ( $photo_scroller->have_slides() ) {

					echo $photo_scroller->get_html();

				}

				break;

			case '3d':

				$class = '';
				$data_attr = '';
				$slider_layout = $config->get('slideshow_3d_layout');

				if ( in_array( $slider_layout, array( 'prop-fullwidth', 'prop-content-width' ) ) ) {

					$class = ('prop-fullwidth' == $slider_layout) ? 'class="fixed-height" ' : 'class="fixed" ';

					$width = $config->get('slideshow_3d_slider_width');
					$height = $config->get('slideshow_3d_slider_height');
					$data_attr = sprintf( ' data-width="%d" data-height="%d"',
						$width ? absint($width) : 2500,
						$height ? absint($height) : 1200
					);
				}

				printf( '<div id="main-slideshow" %s><div class="three-d-slider"%s><span id="loading">0</span></div></div>',
					$class,
					$data_attr
				);

				add_action( 'wp_footer', 'presscore_render_3d_slider_data', 15 );

				break;

		} // switch
	}
}
