<?php
/**
 * Albums helpers.
 *
 * @package the7\Albums\Helpers
 * @since 3.0.0
 */

if ( ! function_exists( 'presscore_mod_albums_get_photos' ) ) {

	/**
	 * @return WP_Query Album photos query.
	 */
	function presscore_mod_albums_get_photos() {

		$albums_query = presscore_get_filtered_posts( array( 'post_type' => 'dt_gallery', 'taxonomy' => 'dt_gallery_category', 'posts_per_page' => -1 ) );

		$media_items = array(0);
		if ( $albums_query->have_posts() ) {
			$media_items = array();
			foreach ( $albums_query->posts as $gallery ) {
				$gallery_media = get_post_meta($gallery->ID, '_dt_album_media_items', true);
				if ( is_array($gallery_media) ) {
					$media_items = array_merge( $media_items, $gallery_media );
				}
			}
		}

		$media_items = array_unique( $media_items );

		$attachments_args = array(
			'post__in'      => $media_items,
			'orderby'       => 'post__in',
			'no_found_rows' => false,
			'paged'         => dt_get_paged_var()
		);

		$posts_per_page = presscore_config()->get( 'posts_per_page' );
		if ( $posts_per_page ) {
			$attachments_args['posts_per_page'] = $posts_per_page;
		}

		return presscore_query()->get_attachments( $attachments_args );
	}

}

if ( ! function_exists( 'presscore_mod_albums_single_post_photoscroller' ) ) :

	/**
	 * Display single album as photoscroller. Disable post title, navigation and meta information.
	 */
	function presscore_mod_albums_single_post_photoscroller() {

		$config = presscore_config();
		if ( ! is_single() || 'dt_gallery' !== get_post_type() || 'photo_scroller' !== $config->get( 'post.media.type' ) || post_password_required() ) {
			return '';
		}

		$media_items = $config->get( 'post.media.library' );

		if ( has_post_thumbnail() && $config->get( 'post.media.featured_image.enabled' ) ) {
			array_unshift( $media_items, absint( get_post_thumbnail_id() ) );
		}

		$args = array(
			'wrap_class' => ( 'fullscreen' == $config->get( 'post.media.photo_scroller.layout' ) ) ? 'fullscreen-scroller' : '',

			'background_color' => $config->get( 'post.media.photo_scroller.background.color' ),

			'padding_top' => $config->get( 'post.media.photo_scroller.padding.top' ),
			'padding_bottom' => $config->get( 'post.media.photo_scroller.padding.bottom' ),
			'padding_side' => $config->get( 'post.media.photo_scroller.padding.side' ),

			'autoplay' => ( 'play' == $config->get( 'post.media.photo_scroller.autoplay.mode' ) ),
			'autoplay_speed' => $config->get( 'post.media.photo_scroller.autoplay.speed' ),

			'thumbnails_visibility' => $config->get( 'post.media.photo_scroller.thumbnails.visibility' ),
			'thumbnails_width' => $config->get( 'post.media.photo_scroller.thumbnail.width' ),
			'thumbnails_height' => $config->get( 'post.media.photo_scroller.thumbnail.height' ),

			'portrait_images_view' => array(
				'max_width' => $config->get( 'post.media.photo_scroller.behavior.portrait.width.max' ),
				'min_width' => $config->get( 'post.media.photo_scroller.behavior.portrait.width.min' ),
				'fill_desktop' => $config->get( 'post.media.photo_scroller.behavior.portrait.fill.desktop' ),
				'fill_mobile' => $config->get( 'post.media.photo_scroller.behavior.portrait.fill.mobile' )
			),
			'landscape_images_view' => array(
				'max_width' => $config->get( 'post.media.photo_scroller.behavior.landscape.width.max' ),
				'min_width' => $config->get( 'post.media.photo_scroller.behavior.landscape.width.min' ),
				'fill_desktop' => $config->get( 'post.media.photo_scroller.behavior.landscape.fill.desktop' ),
				'fill_mobile' => $config->get( 'post.media.photo_scroller.behavior.landscape.fill.mobile' )
			),

			'inactive_opacity' => $config->get( 'post.media.photo_scroller.inactive.opacity' ),
			'show_overlay' => $config->get( 'post.media.photo_scroller.overlay.enabled' )
		);
		$photo_scroller = new Presscore_PhotoScroller( $media_items, $args );

		if ( $photo_scroller->have_slides() ) {

			echo $photo_scroller->get_html();

			// do not show post title
			$config->set( 'page_title.enabled', false );

			// do not show post navigation
			$config->set( 'post.navigation.arrows.enabled', false );
			$config->set( 'post.navigation.back_button.enabled', false );

			$config->set( 'post.meta.fields.date', false );
			$config->set( 'post.meta.fields.categories', false );
			$config->set( 'post.meta.fields.comments', false );
			$config->set( 'post.meta.fields.author', false );
		}
	}

endif;

if ( ! function_exists( 'presscore_mod_albums_get_preview_gallery' ) ) :

	/**
	 * @param  string $class
	 * @return string
	 */
	function presscore_mod_albums_get_preview_gallery( $class = '' ) {
		$config = presscore_config();

		// get gallery items
		$media_items = $config->get( 'post.media.library' );
		if ( ! $media_items ) {
			$media_items = array();
		}

		$open_post = ( 'post' == $config->get( 'post.open_as' ) );
		$exclude_cover = ! $config->get( 'post.media.featured_image.enabled' ) && has_post_thumbnail();

		// get gallery cover
		if ( has_post_thumbnail() ) {
			$gallery_cover = presscore_get_attachment_post_data( array( get_post_thumbnail_id() ) );

			// if ! exlude cover - prepend cover
			if ( ! $exclude_cover ) {
				array_unshift( $media_items, get_post_thumbnail_id() );
			}
		} else if ( $media_items ) {
			$gallery_cover = presscore_get_attachment_post_data( array( $media_items[0] ) );
		} else {
			$gallery_cover = array();
		}
		$gallery_cover = current( $gallery_cover );

		if ( post_password_required() || $open_post ) {
			$media_items = array();
		}

		$class .= ' rollover-click-target';

		// If album lead to single post we need to display only one image
		if ( $open_post ) {
			$class .= ' go-to';
		}

		// get attachments data
		$attachments_data = presscore_get_attachment_post_data( $media_items );

		$gallery_args = array(
			'class'					=> $class,
			'exclude_cover'			=> $exclude_cover,
			'title_img_options'		=> presscore_set_image_dimesions(),
			'share_buttons'			=> true,
			'attachments_count'		=> false,
			'video_icon'			=> false,
			'show_preview_on_hover' => false,
		);

		// open album post instead lightbox gallery
		if ( $open_post ) {
			$gallery_args['title_image_args'] = array( 'href' => get_permalink(), 'class' => $class );
		}

		return presscore_get_images_gallery_hoovered( $gallery_cover, $attachments_data, $gallery_args );
	}

endif;

if ( ! function_exists( 'presscore_mod_albums_get_preview_decription' ) ) :

	/**
	 * @return string
	 */
	function presscore_mod_albums_get_preview_decription() {
		$config = presscore_config();
		$html = '';

		if ( $config->get( 'show_titles' ) && $title = get_the_title() ) {
			$title_class = '';
			if ( 'lightbox' == $config->get( 'post.open_as' ) ) {
				$title_class = 'dt-trigger-first-mfp';
			}

			$html .= sprintf( '<h3 class="entry-title"><a href="%s" title="%s" class="%s">%s</a></h3>', get_permalink(), the_title_attribute( 'echo=0' ), $title_class, $title );
		}

		if ( $config->get( 'show_excerpts' ) ) {
			$html .= apply_filters( 'the_excerpt', get_the_excerpt() );
		}

		$html .= presscore_get_posted_on();

		if ( $html ) {
			$html .= presscore_post_edit_link();
		}

		return $html;
	}

endif;

if ( ! function_exists( 'presscore_mod_albums_get_mini_images' ) ) :

	/**
	 * @return string
	 */
	function presscore_mod_albums_get_mini_images() {
		$config = presscore_config();

		if ( ! $config->get( 'post.preview.mini_images.enabled' ) ) {
			return '';
		}

		$media_items = $config->get( 'post.media.library' );
		if ( ! $media_items ) {
			$media_items = array();
		}

		$include_featured_image = $config->get( 'post.media.featured_image.enabled' );
		$post_thumbnail_id = get_post_thumbnail_id();

		// We need to show next three images right after album cover
		if ( $post_thumbnail_id && $include_featured_image ) {
			array_unshift( $media_items, $post_thumbnail_id );
		}

		$media_items = array_unique( $media_items );

		if ( count( $media_items ) <= 1 ) {
			return '';
		}

		$mini_count = 3;
		$html = '';

		foreach ( $media_items as $media_id ) {
			$mini_image_args = array(
				'img_meta' 	=> wp_get_attachment_image_src( $media_id, 'thumbnail' ),
				'img_id'	=> $media_id,
				'img_class' => 'preload-me',
				'alt'		=> get_post_meta( $media_id, '_wp_attachment_image_alt', true ),
				'wrap'		=> '<img %IMG_CLASS% %SRC% %ALT% width="90" />',
				'echo'		=> false,
			);

			if ( $mini_count ) {
				$html = '<span class="r-thumbn-' . $mini_count . '">' . dt_get_thumb_img( $mini_image_args ) . '<i></i></span>' . $html;
				$mini_count--;
			} else {
				break;
			}
		}

		if ( $html ) {
			$html = '<span class="rollover-thumbnails">' . $html . '</span>';
		}

		return $html;
	}

endif;

if ( ! function_exists( 'presscore_mod_albums_get_photo_img' ) ) :

	/**
	 * @param  int $thumb_id
	 * @param  string $class
	 * @return string
	 */
	function presscore_mod_albums_get_photo_img( $thumb_id, $class = '' ) {
		$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );
		$thumb_title = presscore_image_title_enabled( $thumb_id ) ? get_the_title() : '';

		$thumb_args = array(
			'echo'				=> false,
			'img_meta' 			=> $thumb_meta,
			'img_id'			=> $thumb_id,
			'img_class' 		=> 'preload-me',
			'class'				=> $class . ' dt-mfp-item',
			'img_description'	=> get_the_content(),
			'title'				=> $thumb_title,
			'options'			=> presscore_set_image_dimesions(),
			'wrap'				=> '<a %HREF% %CLASS% %TITLE% data-dt-img-description="%RAW_IMG_DESCRIPTION%" %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %SIZE% /></a>'
		);

		$video_url = presscore_get_image_video_url( $thumb_id );

		if ( $video_url ) {
			$thumb_args['class'] .= ' mfp-iframe';
			$thumb_args['href'] = $video_url;
		} else {
			$thumb_args['class'] .= ' mfp-image';
		}

		// set proportion
		$thumb_args = presscore_add_thumbnail_class_for_masonry( $thumb_args );

		return dt_get_thumb_img( $thumb_args );
	}

endif;

if ( ! function_exists( 'presscore_mod_albums_get_photo_description' ) ) :

	/**
	 * @return string
	 */
	function presscore_mod_albums_get_photo_description() {
		$html = '';
		$config = presscore_config();

		if ( presscore_image_title_enabled( get_the_ID() ) && $config->get( 'show_titles' ) && $title = get_the_title() ) {
			$html .= sprintf( '<h3 class="entry-title"><a class="dt-trigger-first-mfp" href="%s" title="%s" rel="bookmark">%s</a></h3>', get_permalink(), the_title_attribute( 'echo=0' ), $title );
		}

		if ( $config->get( 'show_excerpts' ) ) {
			$html .= wpautop( get_the_content() );
		}

		if ( $html ) {
			$html .= presscore_post_edit_link();
		}

		return $html;
	}

endif;
