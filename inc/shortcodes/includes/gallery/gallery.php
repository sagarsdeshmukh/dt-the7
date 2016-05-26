<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode testimonials class.
 *
 */
class DT_Shortcode_Gallery extends DT_Shortcode {

	static protected $instance;

	public static function get_instance() {
		if ( !self::$instance ) {
			self::$instance = new DT_Shortcode_Gallery();
		}
		return self::$instance;
	}

	protected function __construct() {
		// Do not alter slideshow_gallery if jetpacks carousel or tiled-gallery modules active.
		// Theme do not support that modules.
		if ( class_exists( 'Jetpack', false ) ) {
			$jetpack_active_modules = get_option('jetpack_active_modules');
			if ( $jetpack_active_modules && ( in_array( 'carousel', $jetpack_active_modules ) || in_array( 'tiled-gallery', $jetpack_active_modules ) ) ) {
				return;
			}
		}

		add_filter( 'post_gallery', array( $this, 'shortcode' ), 20, 3 );
	}

	/**
	 * Add class, title and data-dt-img-description attrs for a tag.
	 *
	 * @param  string  $html
	 * @param  integer $id
	 * @param  string  $size
	 * @param  boolean $permalink
	 * @param  boolean $icon
	 * @param  boolean $text
	 * @return string
	 */
	public function wp_get_attachment_link_filter( $html, $id = 0, $size = 'thumbnail', $permalink = false, $icon = false, $text = false ) {
		if ( $permalink ) {
			$html = str_replace( '<a ', '<a class="rollover" ', $html );
		} else {
			$attachment = get_post( $id );
			$title = ( presscore_imagee_title_is_hidden( $id ) ? '' : esc_attr( trim( strip_tags( $attachment->post_title ) ) ) );
			$desc = esc_html( $attachment->post_content );
			$html = str_replace( '<a ', "<a class='rollover rollover-zoom dt-mfp-item mfp-image' title='{$title}' data-dt-img-description='{$desc}' ", $html );
		}
		return $html;
	}

	/**
	 * Add custom class to gallery wrap.
	 *
	 * @param  string $gallery_style
	 * @return string
	 */
	public function gallery_style_filter( $gallery_style ) {
		return str_replace( "class='", "class='dt-gallery-container ", $gallery_style );
	}

	/**
	 * gallery_shortcode override.
	 *
	 * @param  string  $content
	 * @param  array   $attr
	 * @param  integer $instance
	 * @return string
	 */
	public function shortcode( $content = '', $attr = array(), $instance = 0 ) {
		if ( $content ) {
			return $content;
		}

		$html5 = current_theme_supports( 'html5', 'gallery' );

		$post = get_post();

		$atts = shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'itemtag'    => $html5 ? 'figure'     : 'dl',
			'icontag'    => $html5 ? 'div'        : 'dt',
			'captiontag' => $html5 ? 'figcaption' : 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => '',
			'link'       => '',

			// Custom atts.
			'mode'       => 'standard',
			'first_big'  => 'true',
			'width'      => 1200,
			'height'     => 500,
		), $attr, 'gallery' );

		$id = intval( $atts['id'] );

		if ( ! empty( $atts['include'] ) ) {
			$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( ! empty( $atts['exclude'] ) ) {
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
		} else {
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
			}
			return $output;
		}

		switch ( $atts['mode'] ) {
			case 'slideshow':
				$output = $this->slideshow( $attachments, $atts, $instance, $id );
				break;
			case 'metro':
				$output = $this->metro_gallery( $attachments, $atts, $instance, $id );
				break;
			default:
				add_filter( 'gallery_style', array( $this, 'gallery_style_filter' ) );
				add_filter( 'wp_get_attachment_link', array( $this, 'wp_get_attachment_link_filter' ), 5, 6 );

				$output = $this->wp_gallery_shortcode( $attachments, $atts, $instance, $id, $html5 );

				remove_filter( 'wp_get_attachment_link', array( $this, 'wp_get_attachment_link_filter' ), 5, 6 );
				remove_filter( 'gallery_style', array( $this, 'gallery_style_filter' ) );
		}

		return $output;
	}

	/**
	 * Dender default gallery shortcode html with lightbox.
	 *
	 * @param  array $attachments
	 * @param  array $atts
	 * @param  integer $instance
	 * @param  string $id
	 * @param  boolean $html5
	 * @return string
	 */
	protected function wp_gallery_shortcode( $attachments, $atts, $instance, $id, $html5 ) {
		$itemtag = tag_escape( $atts['itemtag'] );
		$captiontag = tag_escape( $atts['captiontag'] );
		$icontag = tag_escape( $atts['icontag'] );
		$valid_tags = wp_kses_allowed_html( 'post' );
		if ( ! isset( $valid_tags[ $itemtag ] ) ) {
			$itemtag = 'dl';
		}
		if ( ! isset( $valid_tags[ $captiontag ] ) ) {
			$captiontag = 'dd';
		}
		if ( ! isset( $valid_tags[ $icontag ] ) ) {
			$icontag = 'dt';
		}

		$columns = intval( $atts['columns'] );
		$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
		$float = is_rtl() ? 'right' : 'left';

		$selector = "gallery-{$instance}";

		$gallery_style = '';

		/**
		 * Filter whether to print default gallery styles.
		 *
		 * @since 3.1.0
		 *
		 * @param bool $print Whether to print default gallery styles.
		 *                    Defaults to false if the theme supports HTML5 galleries.
		 *                    Otherwise, defaults to true.
		 */
		if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
			$gallery_style = "
			<style type='text/css'>
				#{$selector} {
					margin: auto;
				}
				#{$selector} .gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
				}
				#{$selector} img {
					border: 2px solid #cfcfcf;
				}
				#{$selector} .gallery-caption {
					margin-left: 0;
				}
				/* see gallery_shortcode() in wp-includes/media.php */
			</style>\n\t\t";
		}

		$size_class = sanitize_html_class( $atts['size'] );
		$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

		/**
		 * Filter the default gallery shortcode CSS styles.
		 *
		 * @since 2.5.0
		 *
		 * @param string $gallery_style Default CSS styles and opening HTML div container
		 *                              for the gallery shortcode output.
		 */
		$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {

			$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
			if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
				$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
			} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
				$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
			} else {
				$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
			}
			$image_meta  = wp_get_attachment_metadata( $id );

			$orientation = '';
			if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
				$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
			}
			$output .= "<{$itemtag} class='gallery-item'>";
			$output .= "
				<{$icontag} class='gallery-icon {$orientation}'>
					$image_output
				</{$icontag}>";
			if ( $captiontag && trim($attachment->post_excerpt) ) {
				$output .= "
					<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
					" . wptexturize($attachment->post_excerpt) . "
					</{$captiontag}>";
			}
			$output .= "</{$itemtag}>";
			if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
				$output .= '<br style="clear: both" />';
			}
		}

		if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
			$output .= "
				<br style='clear: both' />";
		}

		$output .= "
			</div>\n";

		return $output;
	}

	/**
	 * Render metro gallery.
	 *
	 * @param  array $attachments
	 * @param  array $atts
	 * @param  integer $instance
	 * @param  string $id
	 * @return string
	 */
	public function metro_gallery( $attachments, $atts, $instance, $id ) {
		$columns = intval( $atts['columns'] );
		$columns = ( ( $columns > 0 && $columns <= 6 ) ? $columns : 6 );

		$classes = array(
			'shortcode-gallery',
			'dt-format-gallery',
			"gallery-col-{$columns}",
			"galleryid-{$id}",
			'dt-gallery-container',
		);

		$first_big = ( ! in_array( $atts['first_big'], array( 'n', '0', 'no', 'false', '' ) ) );

		if ( ! $first_big ) {
			$classes[] = 'shortcode-gallery-standard';
		}

		$output = '<div class="' . esc_attr( implode( ' ', $classes ) ) . '" style="width: 100%;">';

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			$alt = trim( strip_tags( get_post_meta( $id, '_wp_attachment_image_alt', true ) ) ); // Use Alt field first
			if ( ! $alt ) {
				$alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
			}
			if ( ! $alt ) {
				$alt = trim( strip_tags( $attachment->post_title ) ); // Finally, use the title
			}

			$image_args = array(
				'img_id' => $id,
				'alt' => $alt,
				'title' => ( presscore_imagee_title_is_hidden( $id ) ? false : trim( strip_tags( $attachment->post_title ) ) ),
				'echo' => false,
				'img_class' => '',
				'class' => '',
			);

			if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
				$image_args['custom'] = ' data-dt-img-description="' . esc_attr( $attachment->post_content ) . '"';

				// Check video link.
				$image_video_url = esc_url( get_post_meta( $id, 'dt-video-url', true ) );
				if ( $image_video_url ) {
					$image_args['class'] .= ' rollover rollover-video dt-mfp-item mfp-iframe';
					$image_args['href'] = $image_video_url;
				} else {
					$image_args['class'] .= ' rollover rollover-zoom dt-mfp-item mfp-image';
				}
			} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
				$image_args['custom'] = 'style="cursor: default;"';
				$image_args['wrap'] = '<a href="javascript:void(0)" %CLASS% %TITLE% %CUSTOM%><img %SRC% %IMG_CLASS% %SIZE% %ALT% %IMG_TITLE% /></a>';
			} else {
				$image_args['class'] .= ' rollover';
				$image_args['href'] = get_permalink( $id );
			}

			if ( ! ( 0 == $i++ && $first_big ) ) {
				$image_args['options'] = array( 'w' => 300, 'h' => 300, 'z' => true );
			} else {
				// Big image.
				$image_args['options'] = array( 'w' => 600, 'h' => 600, 'z' => true );
				$image_args['class'] .= ' big-img';
			}

			$output .= dt_get_thumb_img( $image_args );
		}

		$output .= '</div>';

		return $output;
	}

	/**
	 * Render slideshow.
	 *
	 * @param  array $attachments
	 * @param  array $atts
	 * @param  integer $instance
	 * @param  string $id
	 * @return string
	 */
	protected function slideshow( $attachments, $atts, $instance, $id ) {
		$attachments_data = presscore_get_attachment_post_data( wp_list_pluck( $attachments, 'ID' ) );
		$html = presscore_get_photo_slider( $attachments_data, array(
			'width'     => $atts['width'],
			'height'    => $atts['height'],
			'class'     => array( 'slider-simple', "galleryid-{$id}" ),
			'style'     => ' style="width: 100%;"',
			'show_info' => array( 'title', 'link', 'description' ),
		) );

		return $html;
	}
}

// create shortcode
DT_Shortcode_Gallery::get_instance();