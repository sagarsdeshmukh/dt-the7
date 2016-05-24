<?php
/**
 * PhotoScroller slider
 *
 * @package vogue
 * @since 1.0.0
 */

class Presscore_PhotoScroller extends Presscore_Slider {

	public function get_html() {

		// wrap open
		$html = '<div ' . $this->wrap_class() . ' ' .  $this->wrap_data_attr() . ' ' . $this->wrap_style() . '>';

		// slides container
		$html .= '<div class="photoSlider">';

		foreach( $this->slides as $slide ) {
			$html .= $this->get_slide( $slide );
		}

		$html .= '</div>';

		// slide caption
		$html .= '<div class="slide-caption"></div>';

		if ( $this->settings['show_post_navigation'] ) {

			// post navigation
			$html .= $this->get_post_navigation();

		}

		// slider controls
		$html .= $this->get_slider_controls();

		// wrap close
		$html .= '</div>';

		return $html;
	}

	protected function init_settings( $settings = array() ) {

		$defaults = array(
			'wrap_class' => '',
			'background_color' => '#A1A1A1',
			'padding_top' => 30,
			'padding_bottom' => 30,
			'padding_side' => 30,
			'inactive_opacity' => 40,
			'thumbnails_visibility' => 'show', // can be 'show', 'hide' or 'disabled'
			'thumbnails_width' => 0,
			'thumbnails_height' => 80,
			'autoplay' => false,
			'autoplay_speed' => 3000,
			'loop' => true,
			'portrait_images_view' => array(
				'max_width' => 100,
				'min_width' => 0,
				'fill_desktop' => 'fill',
				'fill_mobile' => 'fill'
			),
			'landscape_images_view' => array(
				'max_width' => 100,
				'min_width' => 0,
				'fill_desktop' => 'fill',
				'fill_mobile' => 'fill'
			),
			'fullscreen' => false,
			'show_overlay' => true,
			'show_slide_title' => true,
			'show_slide_description' => true,
			'show_slide_link' => true,
			'show_post_navigation' => true,
			'show_share_buttons' => true
		);

		$this->settings = wp_parse_args( $settings, $defaults );
	}

	protected function init_slides( WP_Query $query ) {

		if ( $query->have_posts() ) {

			while( $query->have_posts() ) { $query->the_post();

				$slide = new stdClass();
				$post_id = get_the_ID();

				$slide->image_src = wp_get_attachment_image_src( $post_id, 'full' );
				$slide->image_alt = get_post_meta( $post_id, '_wp_attachment_image_alt', true );
				$slide->link = get_post_meta( $post_id, 'dt-img-link', true );
				$slide->video_url = get_post_meta( $post_id, 'dt-video-url', true );

				$slide->share_icons = $this->get_slide_share_buttons();

				// hide title
				if ( get_post_meta( $post_id, 'dt-img-hide-title', true ) ) {
					$slide->title = '';
				} else {
					$slide->title = get_the_title();
				}

				$slide->description = get_the_content();
				$slide->id = $post_id;

				$this->slides[] = $slide;
			}
			wp_reset_postdata();

		} // have_posts
	}

	protected function wrap_class() {
		$class = array( 'photo-scroller' );

		if ( $this->settings['wrap_class'] ) {
			$class[] = $this->settings['wrap_class'];
		}

		// thumbnails visibility
		switch ( $this->settings['thumbnails_visibility'] ) {
			case 'hide': $class[] = 'hide-thumbs';
				break;

			case 'disabled': $class[] = 'disable-thumbs';
				break;
		}

		if ( $this->settings['show_overlay'] ) {
			$class[] = 'show-overlay';
		}

		return 'class="' . esc_attr( implode( ' ', $class ) ) . '"';
	}

	protected function wrap_data_attr() {
		$settings = &$this->settings;

		$data_attr = array(
			'scale' => ( $settings['fullscreen'] ? 'fill' : 'fit' ),

			'autoslide' => ( $settings['autoplay'] ? 'true' : 'false' ),
			'delay' => absint( $settings['autoplay_speed'] ),
			'loop' => ( $settings['loop'] ? 'true' : 'false' ),

			'padding-top' => absint( $settings['padding_top'] ),
			'padding-bottom' => absint( $settings['padding_bottom'] ),
			'padding-side' => absint( $settings['padding_side'] ),

			'transparency' => sprintf( '%1.2f', absint( $settings['inactive_opacity'] ) / 100 ),

			'ls-max' => absint( $settings['landscape_images_view']['max_width'] ),
			'ls-min' => absint( $settings['landscape_images_view']['min_width'] ),
			'ls-fill-dt' => esc_attr( $settings['landscape_images_view']['fill_desktop'] ),
			'ls-fill-mob' => esc_attr( $settings['landscape_images_view']['fill_mobile'] ),

			'pt-max' => absint( $settings['portrait_images_view']['max_width'] ),
			'pt-min' => absint( $settings['portrait_images_view']['min_width'] ),
			'pt-fill-dt' => esc_attr( $settings['portrait_images_view']['fill_desktop'] ),
			'pt-fill-mob' => esc_attr( $settings['portrait_images_view']['fill_mobile'] ),

			'thumb-width' => absint( $settings['thumbnails_width'] ),
			'thumb-height' => absint( $settings['thumbnails_height'] )
		);

		return $this->data_attr( $data_attr );
	}

	protected function wrap_style() {
		$style = array();

		if ( $this->settings['background_color'] ) {
			$style['background-color'] = $this->settings['background_color'];
		}

		return $this->style_attr( $style );
	}

	protected function get_slide( &$slide ) {
		$settings = &$this->settings;

		$caption = '';

		$caption .= $this->get_share_icons( $slide );
		$caption .= $this->get_slide_description( $slide );

		if ( $caption ) {
			$caption = '<figcaption>' . $caption . '</figcaption>';
		}
		$caption .= $this->get_slide_buttons( $slide );

		$slide_image = $this->get_slide_thumbnail( $slide );

		$slide_atts = $this->slide_data_attr( $slide );
		$slide_atts .= $this->slide_html_class( $slide );

		return sprintf( '<figure %1$s><a href="%2$s">%3$s</a>%4$s</figure>',
			$slide_atts,
			esc_url( $slide->image_src[0] ),
			$slide_image,
			$caption
		);
	}

	protected function get_slide_thumbnail( &$slide ) {
		$args = array(
			'img_meta' => $slide->image_src,
			'img_id' => $slide->id,
			'alt' => $slide->image_alt,
			'options' => array( 'w' => ( $this->settings['thumbnails_width'] ? $this->settings['thumbnails_width'] : null ), 'h' => $this->settings['thumbnails_height'], 'z' => 1 ),
			'wrap' => '<img %IMG_CLASS% %SRC% %SIZE% %ALT% />',
			'echo' => false,
		);
		return dt_get_thumb_img( $args );
	}

	protected function get_slide_video_link( &$slide ) {
		$video_link = '';
		if ( $slide->video_url ) {
			$video_link = sprintf(
				'<a href="%s" class="video-icon dt-single-mfp-popup dt-mfp-item mfp-iframe" title="%s" data-dt-img-description="%s"></a>',
				esc_url( $slide->video_url ),
				esc_attr( $slide->title ),
				esc_attr( $slide->description )
			);
		}

		return $video_link;
	}

	protected function get_slide_description( &$slide ) {
		$slide_description = '';

		$show_slide_title = ( $this->settings['show_slide_title'] && $slide->title );
		if ( $show_slide_title ) {
			$slide_description .= '<h3 class="entry-title">' . $slide->title . '</h3>';
		}

		$show_slide_description = ( $this->settings['show_slide_description'] && $slide->description );
		if ( $show_slide_description ) {
			$slide_description .= wpautop( $slide->description );
		}

		if ( $slide_description ) {
			$slide_description = '<div class="album-content-description">' . $slide_description  . '</div>';
		}

		return $slide_description;
	}

	protected function get_slide_buttons( &$slide ) {
		$slide_buttons = '';

		$show_slide_link = ( $this->settings['show_slide_link'] && $slide->link );
		if ( $show_slide_link ) {
			$slide_buttons .= '<a href="' . esc_url( $slide->link ) . '" class="ps-link" target="_blank"></a>';
		}

		if ( $slide->video_url ) {
			$slide_buttons .= $this->get_slide_video_link( $slide );
		}

		if ( $slide_buttons ) {
			$container_class = '';
			if ( $show_slide_link && $slide->video_url ) {
				$container_class = ' BtnCenterer';
			}

			$slide_buttons = '<div class="ps-center-btn' . $container_class . '">' . $slide_buttons . '</div>';
		}

		return $slide_buttons;
	}

	protected function get_share_icons( &$slide ) {
		$slide_buttons = '';

		if ( ! empty( $slide->share_icons ) ) {
			$slide_buttons = '<div class="album-content-btn">' . $slide->share_icons . '</div>';
		}

		return $slide_buttons;
	}

	protected function slide_html_class( &$slide ) {
		if ( $slide->video_url ) {
			return 'class="ts-video"';
		}

		return '';
	}

	protected function slide_data_attr( &$slide ) {
		$data_attr = array(
			'width' => absint( $slide->image_src[1] ),
			'height' => absint( $slide->image_src[2] )
		);

		return $this->data_attr( $data_attr );
	}

	protected function get_slider_controls() {
		return '
		<div class="btn-cntr">
			<a href="#" class="hide-thumb-btn"></a>
			<a href="#" class="auto-play-btn"></a>
			<a href="#" class="full-screen-btn"></a>
		</div>
		';
	}

	protected function get_post_navigation() {

		if ( function_exists( 'presscore_post_navigation' ) ) {
			$post_navigation = presscore_post_navigation();
		} else {
			$post_navigation = '';
		}

		return '<div class="project-navigation">' . '<span>' . get_the_title() . '</span>' . $post_navigation . '</div>';
	}

	protected function get_slide_share_buttons() {
		if ( ! function_exists( 'presscore_get_share_buttons_list' ) || ! $this->settings['show_share_buttons'] ) {
			return '';
		}

		$html = presscore_display_share_buttons( 'photo', array( 'echo' => false, 'class' => 'album-share-overlay' ) );

		return $html;
	}
}
