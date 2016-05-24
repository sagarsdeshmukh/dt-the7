<?php
/**
 * HTML helpers.
 *
 * @since 1.0.0
 * @package vogue
 */

if ( ! function_exists( 'presscore_convert_indexed2numeric_array' ) ) :

	function presscore_convert_indexed2numeric_array( $glue, $array, $prefix = '', $value_wrap = '%s' ) {
		$result = array();

		if ( is_array( $array ) && count( $array ) ) {
			foreach( $array as $key => $value ) {
				$result[] = $prefix . $key . $glue . sprintf( $value_wrap, $value );
			}
		}

		return $result;
	}

endif;

if ( ! function_exists( 'presscore_get_inline_style_attr' ) ) :

	function presscore_get_inline_style_attr( $css_style ) {
		if ( $css_style ) {
			return 'style="' . esc_attr( implode( ' ', presscore_convert_indexed2numeric_array( ':', $css_style, '', '%s;' ) ) ) . '"';
		}

		return '';
	}

endif;

if ( ! function_exists( 'presscore_get_inlide_data_attr' ) ) :

	function presscore_get_inlide_data_attr( $data_atts ) {
		if ( $data_atts ) {
			return implode( ' ', presscore_convert_indexed2numeric_array( '=', $data_atts, 'data-', '"%s"' ) );
		}

		return '';
	}

endif;

if ( ! function_exists( 'presscore_get_font_size_class' ) ) :

	/**
	 * Return proper class accordingly to $font_size.
	 *
	 * @param string $font_size Font size f.e. small
	 *
	 * @return string Proper font size class
	 */
	function presscore_get_font_size_class( $font_size = '' ) {
		switch ( $font_size ) {
			case 'h1': $class = 'h1-size'; break;
			case 'h2': $class = 'h2-size'; break;
			case 'h3': $class = 'h3-size'; break;
			case 'h4': $class = 'h4-size'; break;
			case 'h5': $class = 'h5-size'; break;
			case 'h6': $class = 'h6-size'; break;

			case 'normal': $class = 'text-normal'; break;
			case 'big': $class = 'text-big'; break;
			case 'small':
			default: $class = 'text-small';
		}

		return $class;
	}

endif;


if ( ! function_exists( 'presscore_get_menu_bg_mode_class' ) ) :

	/**
	 * Return proper class accordingly to $menu_bg_mode.
	 *
	 * @param string $menu_bg_mode Bg mode f.e. solid
	 *
	 * @return string Class
	 */
	function presscore_get_menu_bg_mode_class( $menu_bg_mode = '' ) {
		switch( $menu_bg_mode ) {
			case 'fullwidth_line': $class = 'full-width-line'; break;
			case 'solid': $class = 'solid-bg'; break;
			case 'content_line': $class = 'line-content'; break;
			default:
				$class = '';
		}

		return $class;
	}

endif;


if ( ! function_exists( 'presscore_is_gradient_color_mode' ) ) :

	/**
	 * Check whether the current colour mode is gradient
	 *
	 * @param string $color_mode Color mode f.e. color
	 * @return bool
	 */
	function presscore_is_gradient_color_mode( $color_mode = '' ) {
		if ( ('gradient' == $color_mode) || ('accent' == $color_mode && 'gradient' == presscore_config()->get( 'template.accent.color.mode' ) ) ) {
			return true;
		}
		return false;
	}

endif;


if ( ! function_exists( 'presscore_get_color_mode_class' ) ) :

	/**
	 * Return proper class accordingly to $color_mode.
	 * 
	 * @deprecated 3.0.0
	 * 
	 * @param string $color_mode Color mode f.e. color
	 * @return string Class
	 */
	function presscore_get_color_mode_class( $color_mode = '' ) {
		$class = '';

		if ( presscore_is_gradient_color_mode( $color_mode ) ) {
			$class = 'gradient-hover';
		}

		return $class;
	}

endif;

if ( ! function_exists( 'presscore_fancy_separator' ) ) :

	function presscore_fancy_separator( $args = array() ) {

		$default_args = array(
			'class' => '',
			'title_align' => 'left',
			'title' => ''
		);

		$args = wp_parse_args( $args, $default_args );

		$main_class = array( 'dt-fancy-separator' );
		$separator_class = array( 'separator-holder' );
		$title_template = '<div class="dt-fancy-title">%s</div>';
		$separator_template = '<span class="%s"></span>';
		$title = '';

		switch ( $args['title_align'] ) {

			case 'center':
				$separator_base_class = implode( ' ', $separator_class );

				$separator_left = sprintf( $separator_template, esc_attr( $separator_base_class . ' separator-left' ) );
				$separator_right = sprintf( $separator_template, esc_attr( $separator_base_class . ' separator-right' ) );

				$title = sprintf( $title_template, $separator_left . esc_html( $args['title'] ) . $separator_right );

				break;

			case 'right':
				$main_class[] = 'title-right';
				$separator_class[] = 'separator-left';

				$separator = sprintf( $separator_template, esc_attr( implode( ' ', $separator_class ) ) );

				$title = sprintf( $title_template, $separator . esc_html( $args['title'] ) );
				break;

			// left
			default:
				$main_class[] = 'title-left';
				$separator_class[] = 'separator-right';

				$separator = sprintf( $separator_template, esc_attr( implode( ' ', $separator_class ) ) );

				$title = sprintf( $title_template, esc_html( $args['title'] )  . $separator  );
		}

		if ( $args['class'] && is_string( $args['class'] ) ) {
			$main_class[] = $args['class'];
		}

		$html = '<div class="' . esc_attr( implode( ' ', $main_class ) ) . '">' . $title . '</div>';

		return $html;
	}

endif;

if ( ! function_exists( 'presscore_get_template_image_layout' ) ) :

	/**
	 * Returns image layout
	 *
	 * @since  1.0.0
	 * 
	 * @param  string  $lyout    Template layout
	 * @param  integer $post_num Post number
	 * @return string            Returns 'odd' (default) or 'even'
	 */
	function presscore_get_template_image_layout( $lyout = 'left', $post_num = 1 ) {

		switch ( $lyout ) {

			case 'right_list':
				$image_layout = 'even';
				break;

			case 'checkerboard':
				$image_layout = ( $post_num % 2 ) ? 'odd' : 'even';
				break;

			// list ?
			default:
				$image_layout = 'odd';
		}

		return $image_layout;
	}

endif;

if ( ! function_exists( 'presscore_main_container_classes' ) ) :

	/**
	 * Main container classes.
	 */
	function presscore_main_container_classes( $custom_class = array() ) {

		$classes = $custom_class;
		$config = presscore_config();

		switch( $config->get( 'sidebar_position' ) ) {
			case 'left':
				$classes[] = 'sidebar-left';
				break;
			case 'disabled':
				$classes[] = 'sidebar-none';
				break;
			default :
				$classes[] = 'sidebar-right';
		}

		if ( ! $config->get( 'sidebar.style.dividers.vertical' ) ) {
			$classes[] = 'sidebar-divider-off';
		}

		$classes = apply_filters( 'presscore_main_container_classes', $classes );
		if ( ! empty( $classes ) ) {
			printf( 'class="%s"', esc_attr( implode( ' ', (array)$classes ) ) );
		}
	}

endif;

if ( ! function_exists( 'presscore_get_post_tags_html' ) ) :

	function presscore_get_post_tags_html() {

		if ( !of_get_option( 'general-blog_meta_tags', 1 ) || !in_the_loop() ) {
			return '';
		}

		$tags = presscore_get_post_tags();

		return apply_filters( 'presscore_get_post_tags', $tags );
	}

endif;


if ( ! function_exists( 'presscore_get_post_day_link' ) ) :

	function presscore_get_post_day_link() {

		$archive_year = get_the_time('Y');
		$archive_month = get_the_time('m');
		$archive_day = get_the_time('d');

		return get_day_link( $archive_year, $archive_month, $archive_day );
	}

endif;


if ( ! function_exists( 'presscore_get_post_data' ) ) :

	/**
	 * Get post date.
	 */
	function presscore_get_post_data( $html = '' ) {

		$href = 'javascript: void(0);';

		if ( 'post' == get_post_type() ) {

			// remove link if in date archive
			if ( !(is_day() && is_month() && is_year()) ) {

				$href = presscore_get_post_day_link();
			}
		}

		$html .= sprintf(
			'<a href="%s" title="%s" class="data-link" rel="bookmark"><time class="entry-date updated" datetime="%s">%s</time></a>',
				$href,	// href
				esc_attr( get_the_time() ),	// title
				esc_attr( get_the_date( 'c' ) ),	// datetime
				esc_html( get_the_date() )	// date
		);

		return $html;
	}

endif; // presscore_get_post_data


if ( ! function_exists( 'presscore_get_post_comments' ) ) :

	/**
	 * Get post comments.
	 */
	function presscore_get_post_comments( $html = '' ) {
		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
			ob_start();
			comments_popup_link( __( 'Leave a comment', 'the7mk2' ), __( '1 Comment', 'the7mk2' ), __( '% Comments', 'the7mk2' ), 'comment-link' );
			$html .= ob_get_clean();
		endif;

		return $html;
	}

endif; // presscore_get_post_comments


if ( ! function_exists( 'presscore_get_post_categories' ) ) :

	/**
	 * Get post categories.
	 */
	function presscore_get_post_categories( $html = '' ) {
		$post_type = get_post_type();
		$categories_list = '';
		$divider = ', ';

		if ( 'post' == $post_type ) {
			$categories_list = get_the_category_list( $divider );
		} elseif ( taxonomy_exists( $post_type . '_category' ) ) {
			$categories_list = get_the_term_list( get_the_ID(), $post_type . '_category', '', $divider );
		}

		if ( $categories_list && !is_wp_error($categories_list) ) {

			$categories_list = str_replace( array( 'rel="tag"', 'rel="category tag"' ), '', $categories_list);
			$html .= '<span class="category-link">' . trim($categories_list) . '</span>';
		}

		return $html;
	}

endif; // presscore_get_post_categories

if ( !function_exists( 'presscore_get_posted_on' ) ) :

	/**
	 * This function returns post meta information.
	 *
	 * @uses 'presscore_get_posted_on_parts' - function.
	 * @uses 'presscore_posted_on_wrap_class' - filter.
	 * @uses 'presscore_posted_on_html' - filter.
	 * 
	 * @param array $class Array of wrap classes, by default contain 'enrty-meta'.
	 * 
	 * @return string Post meta information html.
	 *
	 * @since 3.0.0
	 */
	function presscore_get_posted_on( $class = array() ) {
		$post_meta_fields = presscore_get_posted_on_parts();
		$html = implode( '', $post_meta_fields );
		if ( $html ) {
			$class[] = 'entry-meta';
			$class = apply_filters( 'presscore_posted_on_wrap_class', $class );
			$html = '<div class="' . presscore_esc_implode( ' ', $class ) . '">' . $html .'</div>';
		}

		return apply_filters( 'presscore_posted_on_html', $html, $class );
	}

endif;

if ( ! function_exists( 'presscore_get_posted_on_parts' ) ) :

	/**
	 * This function returns array of posted on html parts.
	 *
	 * @return array Array of post meta html parts.
	 */
	function presscore_get_posted_on_parts() {
		$config = presscore_config();
		$parts = array();

		if ( $config->get( 'post.meta.fields.date' ) ) {
			$parts['date'] = presscore_get_post_data();
		}

		if ( $config->get( 'post.meta.fields.comments' ) ) {
			$parts['comments'] = presscore_get_post_comments();
		}

		if ( $config->get( 'post.meta.fields.categories' ) ) {
			$parts['categories'] = presscore_get_post_categories();
		}

		if ( $config->get( 'post.meta.fields.author' ) ) {
			$parts['author'] = presscore_get_post_author();
		}

		if ( $config->get( 'post.meta.fields.media_number' ) && 'albums' == $config->get( 'template' ) ) {
			$parts['media_count'] = presscore_get_post_media_count();
		}

		return apply_filters( 'presscore_posted_on_parts', $parts );
	}

endif;

if ( ! function_exists( 'presscore_post_details_link' ) ) :

	/**
	 * PressCore Details button.
	 *
	 * @param int $post_id Post ID.Default is null.
	 * @param mixed $class Custom classes. May be array or string with classes separated by ' '.
	 */
	function presscore_post_details_link( $post_id = null, $class = array('details', 'more-link'), $link_text = null ) {
		global $post;

		if ( !$post_id && !$post ) {
			return '';
		}elseif ( !$post_id ) {
			$post_id = $post->ID;
		}

		if ( post_password_required( $post_id ) ) {
			return '';
		}

		if ( ! is_array( $class ) ) {
			$class = explode( ' ', $class );
		}

		$output = '';
		$url = get_permalink( $post_id );

		if ( $url ) {
			$output = sprintf(
				'<a href="%1$s" class="%2$s" rel="nofollow">%3$s</a>',
				$url,
				esc_attr( implode( ' ', $class ) ),
				is_string( $link_text ) ? $link_text : __( 'Details', 'the7mk2' )
			);
		}

		return apply_filters( 'presscore_post_details_link', $output, $post_id, $class );
	}

endif; // presscore_post_details_link

if ( ! function_exists( 'presscore_post_edit_link' ) ) :

	/**
	 * PressCore edit link.
	 *
	 * @param int $post_id Post ID.Default is null.
	 * @param mixed $class Custom classes. May be array or string with classes separated by ' '.
	 */
	function presscore_post_edit_link( $post_id = null, $class = array() ) {
		$output = '';
		if ( current_user_can( 'edit_posts' ) ) {
			global $post;

			if ( !$post_id && !$post ) {
				return '';
			}

			if ( !$post_id ) {
				$post_id = $post->ID;
			}

			if ( !is_array( $class ) ) {
				$class = explode( ' ', $class );
			}

			$url = get_edit_post_link( $post_id );
			$default_classes = array( 'edit-link' );
			$final_classes = array_merge( $default_classes, $class );

			if ( $url ) {
				$output = sprintf(
					'<a href="%1$s" class="%2$s" target="_blank">%3$s</a>',
					$url,
					esc_attr( implode( ' ', $final_classes ) ),
					__( 'Edit', 'the7mk2' )
				);
			}
		}
		return apply_filters( 'presscore_post_edit_link', $output, $post_id, $class );
	}

endif; // presscore_post_edit_link

if ( ! function_exists( 'presscore_display_share_buttons' ) ) :

	/**
	 * Display share buttons.
	 */
	function presscore_display_share_buttons( $place = '', $options = array() ) {
		$default_options = array(
			'echo'			=> true,
			'class'			=> array( 'project-share-overlay' ),
			'id'			=> null,
			'title'			=> of_get_option( "social_buttons-{$place}-button_title", '' )
		);
		$options = wp_parse_args($options, $default_options);

		$share_buttons = presscore_get_share_buttons_list( $place, $options['id'] );

		if ( apply_filters( 'presscore_hide_share_buttons', empty( $share_buttons ) ) ) {
			return '';
		}

		$class = $options['class'];
		if ( ! is_array($class) ) {
			$class = explode( ' ', $class );
		}

		$title = esc_html( $options['title'] );

		$html =	'<div class="' . esc_attr( implode( ' ', $class ) ) . '">' 
					. presscore_get_button_html( array(
						'title' => $title ? $title : __( 'Share this', 'the7mk2' ),
						'href' => '#',
						'class' => 'share-button entry-share h5-size' . ( $title ? '' : ' no-text' )
					) ) 
					. '<div class="soc-ico">' 
						. implode( '', $share_buttons ) 
					. '</div>' 
				. '</div>';

		$html = apply_filters( 'presscore_display_share_buttons', $html );

		if ( $options['echo'] ) {
			echo $html;
		}
		return $html;
	}

endif; // presscore_display_share_buttons

if ( ! function_exists( 'presscore_display_share_buttons_for_post' ) ) :

	function presscore_display_share_buttons_for_post( $place = '', $options = array() ) {
		$default_options = array(
			'class'			=> array( 'project-share-overlay' ),
		);
		$options = wp_parse_args($options, $default_options);

		if ( 'allways' == of_get_option( 'social_buttons-visibility', 'on_hover' ) ) {
			$options['class'][] = 'allways-visible-icons';
		}

		return presscore_display_share_buttons( $place, $options );
	}

endif;

if ( ! function_exists( 'presscore_display_share_buttons_for_image' ) ) :

	function presscore_display_share_buttons_for_image( $place = '', $options = array() ) {
		$default_options = array(
			'class'			=> array( 'album-share-overlay' ),
		);
		$options = wp_parse_args($options, $default_options);

		return presscore_display_share_buttons( $place, $options );
	}

endif;

if ( ! function_exists( 'presscore_get_share_buttons_list' ) ) :

	function presscore_get_share_buttons_list( $place, $post_id = null ) {
		global $post;
		$buttons = of_get_option( 'social_buttons-' . $place, array() );

		if ( empty( $buttons ) ) {
			return array();
		}

		// get title
		if ( ! $post_id ) {
			$_post = $post;
			$post_id = $_post->ID;
		} else {
			$_post = get_post( $post_id );
		}

		$t = isset( $_post->post_title ) ? $_post->post_title : '';

		// get permalink
		$u = get_permalink( $post_id );

		$buttons_list = presscore_themeoptions_get_social_buttons_list();
		$protocol = is_ssl() ? "https" : "http";
		$share_buttons = array();

		foreach ( $buttons as $button ) {
			$url = $custom = '';
			$desc = $buttons_list[ $button ];

			switch( $button ) {
				case 'twitter':
					$icon_class = 'twitter';
					$url = add_query_arg( array('status' => urlencode($t . ' ' . $u) ), $protocol . '://twitter.com/home' );
					break;
				case 'facebook':
					$url_args = array( 'm2w', 's=100', urlencode('p[url]') . '=' . esc_url($u), urlencode('p[title]') . '=' . urlencode($t) );
					if ( has_post_thumbnail( $post_id ) ) {
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
						if ( $thumbnail ) {
							$url_args[] = urlencode('p[images][0]') . '=' . esc_url($thumbnail[0]);
						}
					}
					$icon_class = 'facebook';
					$url = $protocol . '://www.facebook.com/sharer.php?' . implode( '&', $url_args );
					break;
				case 'google+':
					$t = str_replace(' ', '+', $t);
					$icon_class = 'google';
					$url = add_query_arg( array('url' => $u, 'title' => $t), $protocol . '://plus.google.com/share' );
					break;
				case 'pinterest':
					$icon_class = 'pinterest pinit-marklet';
					$url = '//pinterest.com/pin/create/button/';
					$custom = ' data-pin-config="above" data-pin-do="buttonBookmark"';
					// if image
					if ( wp_attachment_is_image($post_id) ) {
						$image = wp_get_attachment_image_src($post_id, 'full');
						if ( !empty($image) ) {
							$url = add_query_arg( array(
								'url'			=> rawurlencode( $u ),
								'media'			=> rawurlencode( $image[0] ),
								'description'	=> rawurlencode( apply_filters( 'get_the_excerpt', $_post->post_content ) )
								), $url
							);
							$custom = ' data-pin-config="above" data-pin-do="buttonPin"';
							$icon_class = 'pinterest';
						}
					}
					break;
				case 'linkedin':
					$bt = get_bloginfo('name');
					$url = $protocol .'://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( $u ) . '&title=' . urlencode( $t ) . '&summary=&source=' . urlencode( $bt );
					$icon_class = 'linkedin';
					break;
			}

			$desc = esc_attr( $desc );
			$url = esc_url( $url );

			$share_button = sprintf(
				'<a href="%2$s" class="%1$s" target="_blank" title="%3$s"%4$s><span class="assistive-text">%3$s</span></a>',
				$icon_class,
				$url,
				$desc,
				$custom
			);

			$share_buttons[] = apply_filters( 'presscore_share_button', $share_button, $button, $icon_class, $url, $desc, $t, $u );
		}

		return $share_buttons;
	}

endif;

if ( ! function_exists( 'presscore_display_post_author' ) ) :

	/**
	 * Post author snippet.
	 *
	 * Use only in the loop.
	 *
	 * @since 1.0.0
	 */
	function presscore_display_post_author() {

		$user_url = get_the_author_meta('user_url');

		if ( dt_validate_gravatar( get_the_author_meta('user_email') ) ) {
			$avatar = get_avatar( get_the_author_meta('ID'), 85, presscore_get_default_avatar() );

		} else {
			$avatar = '';

		}
		?>

		<div class="dt-fancy-separator title-left fancy-author-title">
			<div class="dt-fancy-title"><?php _e('About the author', 'the7mk2'); ?><span class="separator-holder separator-right"></span></div>
		</div>
		<div class="entry-author wf-table">
			<?php
			if ( $avatar ) {

				echo '<div class="wf-td entry-author-img">';

				if ( $user_url ) {
					printf( '<a href="%s" class="alignleft">%s</a>', esc_url( $user_url ), $avatar );

				} else {
					echo str_replace( "class='", "class='alignleft ", $avatar );

				}

				echo '</div>';

			}
			?>
			<div class="wf-td entry-author-info">
				<p class="h5-size"><?php the_author_meta('display_name'); ?></p>
				<p class="text-normal"><?php the_author_meta('description'); ?></p>
			</div>
		</div>

	<?php
	}

endif; // presscore_display_post_author

if ( ! function_exists( 'presscore_set_image_width_options' ) ) :

	function presscore_set_image_width_options() {

		$config = presscore_get_config();
		$target_image_width = $config->get('post.preview.width.min');

		if ( 'wide' == $config->get( 'post.preview.width' ) && !$config->get('all_the_same_width') ) {
			$target_image_width *= 3;
			$image_options = array( 'w' => absint( round( $target_image_width ) ), 'z' => 0, 'hd_convert' => false );

		} else {
			$target_image_width *= 1.5;
			$image_options = array( 'w' => absint( round( $target_image_width ) ), 'z' => 0 );

		}

		return $image_options;
	}

endif;

if ( ! function_exists( 'presscore_set_image_dimesions' ) ) :

	function presscore_set_image_dimesions() {
		$config = presscore_get_config();

		if ( $config->get( 'justified_grid' ) ) {
			$target_image_height = $config->get('target_height');
			$target_image_height *= 1.3;
			$image_options = array( 'h' => round( $target_image_height ), 'z' => 0 );
		} else {

			$columns = $config->get( 'template.columns.number' );
			$content_width = $config->get( 'template.content.width' );
			$target_image_width = $config->get('post.preview.width.min');

			if ( false !== strpos( $content_width, '%' ) ) {
				$content_width = absint( str_replace( '%', '', $content_width ) );
				$content_width = round( $content_width * 19.20 );
			} else {
				$content_width = absint( str_replace( 'px', '', $content_width ) );
			}

			if ( $columns ) {
				$computed_width = max( array( $content_width / $columns, $target_image_width ) );
			} else {
				$computed_width = $target_image_width;
			}

			if ( 'wide' == $config->get( 'post.preview.width' ) && !$config->get('all_the_same_width') ) {
				$computed_width *= 3;
				$image_options = array( 'w' => absint( round( $computed_width ) ), 'z' => 0, 'hd_convert' => false );

			} else {
				$computed_width *= 1.5;
				$image_options = array( 'w' => absint( round( $computed_width ) ), 'z' => 0 );

			}

		}

		return $image_options;
	}

endif;

if ( ! function_exists( 'presscore_get_post_media_count' ) ) :

	function presscore_get_post_media_count( $html = '' ) {
		$config = Presscore_Config::get_instance();

		$media_items = $config->get( 'post.media.library' );

		if ( !$media_items ) {
			$media_items = array();
		}

		// add thumbnail to attachments list
		if ( has_post_thumbnail() && $config->get( 'post.media.featured_image.enabled' ) ) {
			array_unshift( $media_items, get_post_thumbnail_id() );
		}

		// if pass protected - show only cover image
		if ( $media_items && post_password_required() ) {
			$media_items = array( $media_items[0] );
		}

		list( $images_count, $videos_count ) = presscore_get_attachments_data_count( $media_items );

		$output = '';

		if ( $images_count || $videos_count ) {

			$output .= '<span class="num-of-images">';

			$counters = array();

			if ( $images_count ) {
				$counters[] = sprintf( _n( '1 image', '%s images', $images_count, 'the7mk2' ), $images_count );
			}

			if ( $videos_count ) {
				$counters[] = sprintf( _n( '1 video', '%s video', $videos_count, 'the7mk2' ), $videos_count );
			}

			$output .= implode( ' &amp; ', $counters );

			$output .= '</span>';
		}

		return $html . $output;
	}

endif;

if ( ! function_exists( 'presscore_get_media_content' ) ) :

	/**
	 * Get video embed.
	 *
	 */
	function presscore_get_media_content( $media_url, $id = '' ) {
		if ( !$media_url ) {
			return '';
		}

		if ( $id ) {
			$id = ' id="' . esc_attr( sanitize_html_class( $id ) ) . '"';
		}

		$html = '<div' . $id . ' class="pp-media-content" style="display: none;">' . dt_get_embed( $media_url ) . '</div>';

		return $html;
	}

endif;

if ( ! function_exists( 'presscore_get_post_attachment_html' ) ) :

	/**
	 * Get post attachment html.
	 *
	 * Check if there is video_url and react respectively.
	 *
	 * @param array $attachment_data
	 * @param array $options
	 *
	 * @return string
	 */
	function presscore_get_post_attachment_html( $attachment_data, $options = array() ) {
		if ( empty( $attachment_data['ID'] ) ) {
			return '';
		}

		$default_options = array(
			'link_rel'	=> '',
			'class'		=> array(),
			'wrap'		=> '',
		);
		$options = wp_parse_args( $options, $default_options );

		$class = $options['class'];
		$image_media_content = '';

		if ( !$options['wrap'] ) {
			$options['wrap'] = '<a %HREF% %CLASS% %CUSTOM%><img %SRC% %IMG_CLASS% %ALT% %IMG_TITLE% %SIZE% /></a>';
		}

		$image_args = array(
			'img_meta' 	=> array( $attachment_data['full'], $attachment_data['width'], $attachment_data['height'] ),
			'img_id'	=> empty( $attachment_data['ID'] ) ? $attachment_data['ID'] : 0,
			'alt'		=> $attachment_data['alt'],
			'title'		=> $attachment_data['title'],
			'img_class' => 'preload-me',
			'custom'	=> $options['link_rel'] . ' data-dt-img-description="' . esc_attr($attachment_data['description']) . '"',
			'echo'		=> false,
			'wrap'		=> $options['wrap']
		);

		$class[] = 'dt-single-mfp-popup';
		$class[] = 'dt-mfp-item';

		// check if image has video
		if ( empty($attachment_data['video_url']) ) {
			$class[] = 'rollover';
			$class[] = 'rollover-zoom';
			$class[] = 'mfp-image';

		} else {
			$class[] = 'video-icon';

			// $blank_image = presscore_get_blank_image();

			$image_args['href'] = $attachment_data['video_url'];
			$class[] = 'mfp-iframe';

			$image_args['wrap'] = '<div class="rollover-video"><img %SRC% %IMG_CLASS% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% %CLASS% %CUSTOM%></a></div>';
		}

		$image_args['class'] = implode( ' ', $class );

		$image = dt_get_thumb_img( $image_args );

		return $image;
	}

endif;

if ( ! function_exists( 'presscore_get_button_html' ) ) :

	/**
	 * Button helper.
	 * Look for filters in template-hooks.php
	 *
	 * @return string HTML.
	 */
	function presscore_get_button_html( $options = array() ) {
		$default_options = array(
			'before_title'	=> '',
			'after_title'	=> '',
			'title'			=> '',
			'target'		=> '',
			'href'			=> '',
			'class'			=> 'dt-btn',
			'atts'			=> ''
		);

		$options = wp_parse_args( $options, $default_options );

		$title = $options['title'];
		$class_parts = explode( ' ', $options['class'] );
		if ( in_array( 'dt-btn', $class_parts ) || in_array( 'btn-link', $class_parts ) ) {
			$title = '<span>' . $title . '</span>';
		}
		unset( $class_parts );

		$html = sprintf(
			'<a href="%1$s" class="%2$s"%3$s>%4$s</a>',
			$options['href'],
			esc_attr( $options['class'] ),
			( $options['target'] ? ' target="_blank"' : '' ) . $options['atts'],
			$options['before_title'] . $title . $options['after_title']
		);

		return apply_filters( 'presscore_get_button_html', $html, $options );
	}

endif;

if ( ! function_exists( 'presscore_get_post_author' ) ) :

	/**
	 * Get post author.
	 */
	function presscore_get_post_author( $html = '' ) {
		$html .= sprintf(
			'<a class="author vcard" href="%s" title="%s" rel="author">%s</a>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'the7mk2' ), get_the_author() ) ),
				sprintf( __( 'By %s', 'the7mk2' ), '<span class="fn">' . get_the_author() . '</span>' )
		);

		return $html;
	}

endif;

if ( ! function_exists( 'presscore_get_post_tags' ) ) :

	/**
	 * Get post tags.
	 */
	function presscore_get_post_tags( $html = '' ) {
		$tags_list = get_the_tag_list('', '');
		if ( $tags_list ) {
			$html .= sprintf(
				'<div class="entry-tags">%s</div>',
					$tags_list
			);
		}

		return $html;
	}

endif;

if ( ! function_exists( 'presscore_get_share_buttons_for_prettyphoto' ) ) :

	/**
	 * Share buttons lite.
	 *
	 */
	function presscore_get_share_buttons_for_prettyphoto( $place = '', $options = array() ) {
		global $post;
		$buttons = of_get_option('social_buttons-' . $place, array());

		if ( empty($buttons) ) return '';

		$default_options = array(
			'id'	=> null,
		);
		$options = wp_parse_args($options, $default_options);

		$options['id'] = $options['id'] ? absint($options['id']) : $post->ID;

		$html = '';

		$html .= sprintf(
			' data-pretty-share="%s"',
			esc_attr( str_replace( '+', '', implode( ',', $buttons ) ) )
		);

		return $html;
	}

endif;

if ( ! function_exists( 'presscore_the_title_trim' ) ) :

	/**
	 * Replace protected and private title part.
	 *
	 * From http://wordpress.org/support/topic/how-to-remove-private-from-private-pages
	 *
	 * @return string Clear title.
	 */
	function presscore_the_title_trim( $title ) {
		$pattern[0] = '/Protected:/';
		$pattern[1] = '/Private:/';
		$replacement[0] = ''; // Enter some text to put in place of Protected:
		$replacement[1] = ''; // Enter some text to put in place of Private	
		return preg_replace($pattern, $replacement, $title);
	}

endif;

if ( ! function_exists( 'presscore_get_image_with_srcset' ) ) :

	function presscore_get_image_with_srcset( $logo, $r_logo, $default, $custom = '', $class = '' ) {

		$logos = array( '1x' => $logo, '2x' => $r_logo );
		$srcset = array();

		foreach ( $logos as $xx => $_logo ) {
			if ( ! empty( $_logo ) ) {
				$srcset[] = "{$_logo[0]} {$xx}";
			}
		}

		$srcset = implode( ', ', $srcset );

		$output = '<img class="' . esc_attr( $class . ' preload-me' ) . '" srcset="' . esc_attr( $srcset ) . '" ' . image_hwstring( $default[1], $default[2] ) . $custom . ' />';

		return $output;
	}

endif;

if ( ! function_exists( 'presscore_substring' ) ) :

	/**
	 * Return substring $max_chars length with &hellip; at the end.
	 *
	 * @param string $str
	 * @param int $max_chars
	 *
	 * @return string
	 */

	function presscore_substring( $str, $max_chars = 30 ) {

		if ( function_exists('mb_strlen') && function_exists('mb_substr') ) {

			if ( mb_strlen( $str ) > $max_chars ) {

				$str = mb_substr( $str, 0, $max_chars );
				$str .= '&hellip;';
			}

		}
		return $str;
	}

endif;

if ( ! function_exists( 'presscore_get_social_icons' ) ) :

	/**
	 * Generate social icons links list.
	 * $icons = array( array( 'icon_class', 'title', 'link' ) )
	 *
	 * @param $icons array
	 *
	 * @return string
	 */
	function presscore_get_social_icons( $icons = array(), $common_classes = array() ) {
		if ( empty($icons) || !is_array($icons) ) {
			return '';
		}

		$classes = $common_classes;
		if ( !is_array($classes) ) {
			$classes = explode( ' ', trim($classes) );
		}

		$output = array();
		foreach ( $icons as $icon ) {

			if ( !isset($icon['icon'], $icon['link'], $icon['title']) ) {
				continue;
			}

			$output[] = presscore_get_social_icon( $icon['icon'], $icon['link'], $icon['title'], $classes );
		}

		return apply_filters( 'presscore_get_social_icons', implode( '', $output ), $output, $icons, $common_classes );
	}

endif;

if ( ! function_exists( 'presscore_get_social_icon' ) ) :

	/**
	 * Get social icon.
	 *
	 * @return string
	 */
	function presscore_get_social_icon( $icon = '', $url = '#', $title = '', $classes = array(), $target = '_blank' ) {
		$title = esc_attr( $title );

		$icon_attributes = array(
			'title="' . $title . '"',
		);

		if ( 'skype' === $icon ) {
			$url = esc_attr( $url );
		} else if ( 'mail' === $icon && is_email( $url ) ) {
			$url = 'mailto:' . esc_attr( $url );
			$target = '_top';
		} else {
			$url = esc_url( $url );
		}

		$icon_attributes[] = 'href="' . $url . '"';
		$icon_attributes[] = 'target="' . esc_attr( $target ) . '"';

		$icon_classes = is_array( $classes ) ? $classes : array();
		$icon_classes[] = $icon;

		$icon_attributes[] = 'class="' . esc_attr( implode( ' ',  $icon_classes ) ) . '"';

		$output = '<a ' . implode( ' ', $icon_attributes ) . '><span class="assistive-text">' . $title . '</span></a>';

		return $output;
	}

endif;

if ( ! function_exists( 'presscore_get_favicon' ) ) :

	/**
	 * Returns favicon tags html.
	 *
	 * @since 2.2.1
	 * 
	 * @return string
	 */
	function presscore_get_favicon() {
		return dt_get_favicon( presscore_choose_right_image_based_on_device_pixel_ratio(
			of_get_option( 'general-favicon', '' ),
			of_get_option( 'general-favicon_hd', '' )
		) );
	}

endif;

if ( ! function_exists( 'presscore_get_device_icons' ) ) :

	/**
	 * Returns device icons meta tags array.
	 *
	 * @since 2.2.1
	 * 
	 * @return array
	 */
	function presscore_get_device_icons() {
		$device_icons = array(
			array(
				'option_id' => 'general-handheld_icon-old_iphone',
			),
			array(
				'option_id' => 'general-handheld_icon-old_ipad',
				'sizes' => '76x76',
			),
			array(
				'option_id' => 'general-handheld_icon-retina_iphone',
				'sizes' => '120x120',
			),
			array(
				'option_id' => 'general-handheld_icon-retina_ipad',
				'sizes' => '152x152',
			),
		);

		$meta_tags = array();
		foreach ( $device_icons as $icon ) {
			$src = dt_get_of_uploaded_image( of_get_option( $icon['option_id'] ) );
			if ( $src ) {
				$meta_tags[] = '<link rel="apple-touch-icon"' . ( empty( $icon['sizes'] ) ? '' : ' sizes="' . esc_attr( $icon['sizes'] ) . '"' ) . ' href="' . esc_url( $src ) . '">';
			}
		}

		return $meta_tags;
	}

endif;

if ( ! function_exists( 'presscore_get_terms_list_by_slug' ) ) :

	/**
	 * Returns terms names list separated by separator based on terms slugs
	 *
	 * @since 4.1.5
	 * @param  array  $args Default arguments: array( 'slugs' => array(), 'taxonomy' => 'category', 'separator' => ', ', 'titles' => array() ).
	 * Default titles: array( 'empty_slugs' => __( 'All', 'the7mk2' ), 'no_result' => __('There is no categories', 'the7mk2') )
	 * @return string       Terms names list or title
	 */
	function presscore_get_terms_list_by_slug( $args = array() ) {

		$default_args = array(
			'slugs' => array(),
			'taxonomy' => 'category',
			'separator' => ', ',
			'titles' => array()
		);

		$default_titles = array(
			'empty_slugs' => __( 'All', 'the7mk2' ),
			'no_result' => __('There is no categories', 'the7mk2')
		);

		$args = wp_parse_args( $args, $default_args );
		$args['titles'] = wp_parse_args( $args['titles'], $default_titles );

		// get categories names list or show all
		if ( empty( $args['slugs'] ) ) {
			$output = $args['titles']['empty_slugs'];

		} else {

			$terms_names = array();
			foreach ( $args['slugs'] as $term_slug ) {
				$term = get_term_by( 'slug', $term_slug, $args['taxonomy'] );

				if ( $term ) {
					$terms_names[] = $term->name;
				}

			}

			if ( $terms_names ) {
				asort( $terms_names );
				$output = join( $args['separator'], $terms_names );

			} else {
				$output = $args['titles']['no_result'];

			}

		}

		return $output;
	}

endif;

if ( ! function_exists( 'presscore_choose_right_image_based_on_device_pixel_ratio' ) ) :

	/**
	 * Chooses what src to use, based on device pixel ratio and theme settings
	 * @param  string $regular_img_src Regular image src
	 * @param  string $hd_img_src      Hd image src
	 * @return string                  Best suitable src
	 */
	function presscore_choose_right_image_based_on_device_pixel_ratio( $regular_img_src, $hd_img_src = '' ) {

		$output_src = '';

		if ( !$regular_img_src && !$hd_img_src ) {
		} elseif ( !$regular_img_src ) {

			$output_src = $hd_img_src;
		} elseif ( !$hd_img_src ) {

			$output_src = $regular_img_src;
		} else {

			if ( dt_retina_on() ) {
				$output_src = dt_is_hd_device() ? $hd_img_src : $regular_img_src;
			} else {
				$output_src = $regular_img_src;
			}

		}

		return $output_src;

	}

endif;

if ( ! function_exists( 'presscore_bottom_bar_class' ) ) :

	/**
	 * Bottom bar html class
	 * 
	 * @param  array  $class Custom html class
	 * @return string        Html class attribute
	 */
	function presscore_bottom_bar_class( $class = array() ) {
		if ( $class ) {
			$output = is_array( $class ) ? $class : explode( ' ', $class );
		} else {
			$output = array();
		}

		switch( presscore_config()->get( 'template.bottom_bar.style' ) ) {
			case 'full_width_line' :
				$output[] = 'full-width-line';
				break;
			case 'solid_background' :
				$output[] = 'solid-bg';
				break;
			// default - content_width_line
		}

		$output = apply_filters( 'presscore_bottom_bar_class', $output );

		return $output ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $output ) ) ) : '';
	}

endif;

if ( ! function_exists( 'presscore_get_royal_slider' ) ) :

	/**
	 * Royal media slider.
	 *
	 * @param array $media_items Attachments id's array.
	 * @return string HTML.
	 */
	function presscore_get_royal_slider( $attachments_data, $options = array() ) {

		if ( empty( $attachments_data ) ) {
			return '';
		}

		$default_options = array(
			'echo'      => false,
			'width'     => null,
			'height'    => null,
			'class'     => array(),
			'style'     => '',
			'show_info' => array( 'title', 'link', 'description' )
		);
		$options = wp_parse_args( $options, $default_options );

		// common classes
		$options['class'][] = 'royalSlider';
		$options['class'][] = 'rsShor';

		$container_class = implode(' ', $options['class']);

		$data_attributes = '';
		if ( !empty($options['width']) ) {
			$data_attributes .= ' data-width="' . absint($options['width']) . '"';
		}

		if ( !empty($options['height']) ) {
			$data_attributes .= ' data-height="' . absint($options['height']) . '"';
		}

		if ( isset( $options['autoplay'] ) ) {
			$data_attributes .= ' data-autoslide="' . ( $options['interval'] ? $options['interval'] : $default_options['interval'] ) . '"';
		}

		if ( isset( $options['interval'] ) ) {
			$options['interval'] = absint( $options['interval'] );
			$data_attributes .= ' data-paused="' . ( $options['autoplay'] ? 'false' : 'true' ) . '"';
		}

		$html = "\n" . '<ul class="' . esc_attr($container_class) . '"' . $data_attributes . $options['style'] . '>';

		foreach ( $attachments_data as $data ) {

			if ( empty($data['full']) ) continue;

			$is_video = !empty( $data['video_url'] );

			$html .= "\n\t" . '<li' . ( ($is_video) ? ' class="rollover-video"' : '' ) . '>';

			$image_args = array(
				'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
				'img_id'	=> $data['ID'],
				'alt'		=> $data['alt'],
				'title'		=> $data['title'],
				'caption'	=> $data['caption'],
				'img_class' => 'rsImg',
				'custom'	=> '',
				'class'		=> '',
				'echo'		=> false,
				'wrap'		=> '<img %IMG_CLASS% %SRC% %SIZE% %ALT% %CUSTOM% />',
			);

			if ( $is_video ) {
				$video_url = remove_query_arg( array('iframe', 'width', 'height'), $data['video_url'] );
				$image_args['custom'] = 'data-rsVideo="' . esc_url($video_url) . '"';
			}

			$image = dt_get_thumb_img( $image_args );

			$html .= "\n\t\t" . $image;

			if ( !empty($data['link']) && in_array('link', $options['show_info']) ) {
				$html .= "\n\t\t" . '<a href="' . $data['link'] . '" class="rsCLink" target="_blank"></a>';
			}

			$caption_html = '';
			$links = '';

			if ( in_array('share_buttons', $options['show_info']) ) {
				$links .= "\n\t\t\t\t" . presscore_display_share_buttons_for_image( 'photo', array(
					'echo' => false,
					'id' => $data['ID']
				) );
			}

			if ( $links ) {
				$caption_html .= '<div class="album-content-btn">' . $links . '</div>';
			}

			if ( !empty($data['title']) && in_array('title', $options['show_info']) ) {
				$caption_html .= "\n\t\t\t\t" . '<h4>' . esc_html($data['title']) . '</h4>';
			}

			if ( !empty($data['description']) && in_array('description', $options['show_info']) ) {
				$caption_html .= "\n\t\t\t\t" . wpautop($data['description']);
			}

			if ( $caption_html ) {
				$html .= "\n\t\t" . '<div class="slider-post-caption">' . "\n\t\t\t" . '<div class="slider-post-inner">' . $caption_html . "\n\t\t\t" . '</div>' . "\n\t\t" . '</div>';
			}

			$html .= '</li>';

		}

		$html .= '</ul>';

		if ( $options['echo'] ) {
			echo $html;
		}

		return $html;
	}

endif; // presscore_get_royal_slider

if ( ! function_exists( 'presscore_get_images_list' ) ) :

	/**
	 * Images list.
	 *
	 * Description here.
	 *
	 * @return string HTML.
	 */
	function presscore_get_images_list( $attachments_data, $args = array() ) {
		if ( empty( $attachments_data ) ) {
			return '';
		}

		$default_args = array(
			'open_in_lightbox' => false,
			'show_share_buttons' => false
		);
		$args = wp_parse_args( $args, $default_args );

		static $gallery_counter = 0;
		$gallery_counter++;

		$html = '';

		$base_img_args = array(
			'custom' => '',
			'class' => '',
			'img_class' => 'images-list',
			'echo' => false,
			'wrap' => '<img %SRC% %IMG_CLASS% %ALT% style="width: 100%;" />',
		);

		$video_classes = 'video-icon dt-mfp-item mfp-iframe';

		if ( $args['open_in_lightbox'] ) {

			$base_img_args = array(
				'class' => 'dt-mfp-item rollover rollover-zoom mfp-image',
				'img_class' => 'images-list',
				'echo' => false,
				'wrap' => '<a %HREF% %CLASS% title="%RAW_ALT%" data-dt-img-description="%RAW_TITLE%"><img %SRC% %IMG_CLASS% %ALT% style="width: 100%;" /></a>'
			);

		} else {
			$video_classes .= ' dt-single-mfp-popup';
		}

		foreach ( $attachments_data as $data ) {

			if ( empty($data['full']) ) {
				continue;
			}

			$is_video = !empty( $data['video_url'] );

			$html .= "\n\t" . '<div class="images-list">';

			$image_args = array(
				'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
				'img_id'	=> empty($data['ID']) ? 0 : $data['ID'],
				'title'		=> $data['description'],
				'alt'		=> $data['title']
			);

			$image_args = array_merge( $base_img_args, $image_args );

			// $media_content = '';
			if ( $is_video ) {

				// $blank_image = presscore_get_blank_image();
				$image_args['href'] = $data['video_url'];
				$image_args['custom'] = 'data-dt-img-description="' . esc_attr($data['description']) . '"';
				$image_args['title'] = $data['title'];
				$image_args['class'] = $video_classes;
				$image_args['wrap'] = '<div class="rollover-video"><img %SRC% %IMG_CLASS% %ALT% style="width: 100%;" /><a %HREF% %TITLE% %CLASS% %CUSTOM%></a></div>';
			}

			$image = dt_get_thumb_img( $image_args );

			$html .= "\n\t\t" . $image;// . $media_content;

			if ( $args['show_share_buttons'] || !empty( $data['description'] ) || !empty($data['title']) || !empty($data['link']) ) {
				$html .= "\n\t\t" . '<div class="images-list-caption">' . "\n\t\t\t" . '<div class="images-list-inner">';

				$links = '';
				if ( !empty($data['link']) ) {
					$links .= '<a href="' . $data['link'] . '" class="slider-link" target="_blank"></a>';
				}

				if ( $args['show_share_buttons'] ) {
					$links .= presscore_display_share_buttons_for_image( 'photo', array( 'id' => $data['ID'], 'echo' => false ) );
				}

				if ( $links ) {
					$html .= '<div class="album-content-btn">' . $links . '</div>';
				}

				if ( !empty($data['title']) ) {
					$html .= "\n\t\t\t" . '<h4>' . $data['title'] . '</h4>';
				}

				$html .= "\n\t\t\t\t" . wpautop($data['description']);

				$html .= "\n\t\t\t" . '</div>' . "\n\t\t" . '</div>';
			}

			$html .= '</div>';

		}

		if ( $args['open_in_lightbox'] ) {

			$container_atts = '';
			if ( $args['show_share_buttons'] ) {
				$container_atts .= presscore_get_share_buttons_for_prettyphoto( 'photo' );
			}

			$html = '<div class="dt-gallery-container"' . $container_atts . '>' . $html . '</div>';
		}

		return $html;
	}

endif; // presscore_get_images_list

if ( ! function_exists( 'presscore_get_images_gallery_1' ) ) :

	/**
	 * Gallery helper.
	 *
	 * @param array $attachments_data Attachments data array.
	 * @return string HTML.
	 */
	function presscore_get_images_gallery_1( $attachments_data, $options = array() ) {
		if ( empty( $attachments_data ) ) {
			return '';
		}

		static $gallery_counter = 0;
		$gallery_counter++;

		$default_options = array(
			'echo'			=> false,
			'class'			=> array(),
			'links_rel'		=> '',
			'style'			=> '',
			'columns'		=> 4,
			'first_big'		=> true,
			'show_only'		=> count( $attachments_data ),
		);
		$options = wp_parse_args( $options, $default_options );
		$blank_image = presscore_get_blank_image();

		$gallery_cols = absint($options['columns']);
		if ( !$gallery_cols ) {
			$gallery_cols = $default_options['columns'];
		} else if ( $gallery_cols > 6 ) {
			$gallery_cols = 6;
		}

		$options['class'] = (array) $options['class']; 
		$options['class'][] = 'dt-format-gallery';
		$options['class'][] = 'gallery-col-' . $gallery_cols;
		$options['class'][] = 'dt-gallery-container';

		$container_class = implode( ' ', $options['class'] );

		$html = '<div class="' . esc_attr( $container_class ) . '"' . $options['style'] . '>';

		// clear attachments_data
		foreach ( $attachments_data as $index=>$data ) {
			if ( empty($data['full']) ) unset($attachments_data[ $index ]);
		}
		unset($data);

		if ( empty($attachments_data) ) {
			return '';
		}

		$show_only = absint( $options['show_only'] );

		if ( $options['first_big'] ) {

			$show_only--;
			$big_image = current( array_slice($attachments_data, 0, 1) );
			$gallery_images = array_slice($attachments_data, 1);
		} else {

			$gallery_images = $attachments_data;
		}

		$image_custom = $options['links_rel'];
		$media_container_class = 'rollover-video';

		$image_args = array(
			'img_class' => '',
			'class'		=> 'rollover rollover-zoom dt-mfp-item mfp-image',
			'echo'		=> false,
		);

		$media_args = array_merge( $image_args, array(
			'class'		=> 'dt-mfp-item mfp-iframe rollover rollover-video',
		) );

		if ( isset($big_image) ) {

			// big image
			$big_image_args = array(
				'img_meta' 	=> array( $big_image['full'], $big_image['width'], $big_image['height'] ),
				'img_id'	=> empty( $big_image['ID'] ) ? $big_image['ID'] : 0, 
				'options'	=> array( 'w' => 600, 'h' => 600, 'z' => true ),
				'alt'		=> $big_image['alt'],
				'title'		=> $big_image['title'],
				'echo'		=> false,
				'custom'	=> $image_custom . ' data-dt-img-description="' . esc_attr($big_image['description']) . '"'
			);

			if ( empty($big_image['video_url']) ) {
				$big_image_args['class'] = $image_args['class'] . ' big-img';

				$image = dt_get_thumb_img( array_merge( $image_args, $big_image_args ) );
			} else {
				$big_image_args['href'] = $big_image['video_url'];
				$big_image_args['class'] = $media_args['class'] . ' big-img';

				$image = dt_get_thumb_img( array_merge( $media_args, $big_image_args ) );
			}

			$html .= "\n\t\t" . $image;
		}

		// medium images
		if ( !empty($gallery_images) ) {

			foreach ( $gallery_images as $data ) {

				// hide images
				if ( 0 >= $show_only-- ) {
					$image_custom .= ' style="display: none;"';
				}

				$medium_image_args = array(
					'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
					'img_id'	=> empty( $data['ID'] ) ? $data['ID'] : 0, 
					'options'	=> array( 'w' => 300, 'h' => 300, 'z' => true ),
					'alt'		=> $data['alt'],
					'title'		=> $data['title'],
					'echo'		=> false,
					'custom'	=> $image_custom . ' data-dt-img-description="' . esc_attr($data['description']) . '"'
				);

				if ( empty($data['video_url']) ) {
					$image = dt_get_thumb_img( array_merge( $image_args, $medium_image_args ) );
				} else {
					$medium_image_args['href'] = $data['video_url'];

					$image = dt_get_thumb_img( array_merge( $media_args, $medium_image_args ) );
				}

				$html .= $image;
			}
		}

		$html .= '</div>';

		return $html;
	}

endif;

if ( ! function_exists( 'presscore_get_images_gallery_hoovered' ) ) :

	/**
	 * Hoovered gallery.
	 *
	 * @param array $attachments_data Attachments data array.
	 * @param array $options Gallery options.
	 *
	 * @return string HTML.
	 */
	function presscore_get_images_gallery_hoovered( $cover, $attachments_data = array(), $options = array() ) {
		// clear attachments_data
		foreach ( $attachments_data as $index=>$data ) {
			if ( empty( $data['full'] ) ) {
				unset( $attachments_data[ $index ] );
			}
		}
		unset( $data );

		if ( empty( $cover ) ) {
			return '';
		}

		static $gallery_counter = 0;
		$gallery_counter++;

		$id_mark_prefix = 'pp-gallery-hoovered-media-content-' . $gallery_counter . '-';

		$default_options = array(
			'echo'			=> false,
			'class'			=> array(),
			'links_rel'		=> '',
			'style'			=> '',
			'share_buttons'	=> false,
			'exclude_cover'	=> false,
			'title_img_options' => array(),
			'title_image_args' => array(),
			'attachments_count' => null,
			'show_preview_on_hover' => true,
			'video_icon' => true
		);
		$options = wp_parse_args( $options, $default_options );

		$class = implode( ' ', (array) $options['class'] );

		$small_images = array_slice( $attachments_data, 1 );
		$big_image = $cover;

		if ( ! is_array($options['attachments_count']) || count($options['attachments_count']) < 2 ) {

			$attachments_count = presscore_get_attachments_data_count( $options['exclude_cover'] ? $small_images : $attachments_data );

		} else {

			$attachments_count = $options['attachments_count'];
		}

		list( $images_count, $videos_count ) = $attachments_count;

		$count_text = array();

		if ( $images_count ) {
			$count_text[] = sprintf( _n( '1 image', '%s images', $images_count, 'the7mk2' ), $images_count );
		}

		if ( $videos_count ) {
			$count_text[] = sprintf( __( '%s video', 'the7mk2' ), $videos_count );
		}

		$count_text = implode( ',&nbsp;', $count_text );

		$image_args = array(
			'img_class' => 'preload-me',
			'class'		=> $class,
			'custom'	=> implode( ' ', array( $options['links_rel'], $options['style'] ) ),
			'echo'		=> false,
		);

		$image_hover = '';
		$mini_count = 3;
		$html = '';
		$share_buttons = '';

		if ( $options['share_buttons'] ) {
			$share_buttons = presscore_get_share_buttons_for_prettyphoto( 'photo' );
		}

		// medium images
		if ( !empty( $small_images ) ) {

			$html .= '<div class="dt-gallery-container mfp-hide"' . $share_buttons . '>';
			foreach ( $attachments_data as $key=>$data ) {
				$small_image_args = array(
					'img_meta' 	=> $data['thumbnail'],
					'img_id'	=> empty( $data['ID'] ) ? $data['ID'] : 0,
					'alt'		=> $data['title'],
					'title'		=> $data['description'],
					'href'		=> esc_url( $data['full'] ),
					'custom'	=> '',
					'class'		=> 'mfp-image',
				);

				if ( $options['share_buttons'] ) {
					$small_image_args['custom'] = 'data-dt-location="' . esc_attr($data['permalink']) . '" ';
				}

				$mini_image_args = array(
					'img_meta' 	=> $data['thumbnail'],
					'img_id'	=> empty( $data['ID'] ) ? $data['ID'] : 0,
					'alt'		=> $data['title'],
					'title'		=> $data['description'],
					'wrap'		=> '<img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% width="90" />',
				);

				if ( $mini_count && !( !$options['exclude_cover'] && 0 == $key ) && $options['show_preview_on_hover'] ) {
					$image_hover = '<span class="r-thumbn-' . $mini_count . '">' . dt_get_thumb_img( array_merge( $image_args, $mini_image_args ) ) . '<i>' . $count_text . '</i></span>' . $image_hover;
					$mini_count--;
				}

				if ( !empty($data['video_url']) ) {
					$small_image_args['href'] = $data['video_url'];
					$small_image_args['class'] = 'mfp-iframe';
				}

				$html .= sprintf( '<a href="%s" title="%s" class="%s" data-dt-img-description="%s" %s></a>',
					esc_url($small_image_args['href']),
					esc_attr($small_image_args['alt']),
					esc_attr($small_image_args['class'] . ' dt-mfp-item'),
					esc_attr($small_image_args['title']),
					$small_image_args['custom']
				);

			}
			$html .= '</div>';
		}
		unset( $image );

		if ( $image_hover && $options['show_preview_on_hover'] ) {
			$image_hover = '<span class="rollover-thumbnails">' . $image_hover . '</span>';
		}

		// big image
		$big_image_args = array(
			'img_meta' 	=> array( $big_image['full'], $big_image['width'], $big_image['height'] ),
			'img_id'	=> empty( $big_image['ID'] ) ? $big_image['ID'] : 0,
			'wrap'		=> '<a %HREF% %CLASS% %CUSTOM% %TITLE%><img %SRC% %IMG_CLASS% %ALT% %IMG_TITLE% %SIZE% />' . $image_hover . '</a>',
			'alt'		=> $big_image['alt'],
			'title'		=> $big_image['title'],
			'class'		=> $class,
			'options'	=> $options['title_img_options']
		);

		if ( empty( $small_images ) ) {

			$big_image_args['custom'] = ' data-dt-img-description="' . esc_attr($big_image['description']) . '"'. $share_buttons;

			if ( $options['share_buttons'] ) {
				$big_image_args['custom'] = ' data-dt-location="' . esc_attr($big_image['permalink']) . '"' . $big_image_args['custom'];
			}

			$big_image_args['class'] .= ' dt-single-mfp-popup dt-mfp-item mfp-image';
		} else {

			$big_image_args['custom'] = $image_args['custom'];
			$big_image_args['class'] .= ' dt-gallery-mfp-popup';
		}

		$big_image_args = apply_filters('presscore_get_images_gallery_hoovered-title_img_args', $big_image_args, $image_args, $options, $big_image);

		if ( $options['video_icon'] && !empty( $big_image['video_url'] ) && !$options['exclude_cover'] ) {
			$big_image_args['href'] = $big_image['video_url'];

			$blank_image = presscore_get_blank_image();

			$video_link_classes = 'video-icon';
			if ( empty( $small_images ) ) {
				$video_link_classes .= ' mfp-iframe dt-single-mfp-popup dt-mfp-item';
			} else {
				$video_link_classes .= ' dt-gallery-mfp-popup';
			}

			$video_link_custom = $big_image_args['custom'];

			$big_image_args['class'] = str_replace( array('rollover', 'mfp-image'), array('rollover-video', ''), $class);
			$big_image_args['custom'] = $options['style'];

			$big_image_args['wrap'] = '<div %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="' . $video_link_classes . '"' . $video_link_custom . '></a></div>';
		}
		$image = dt_get_thumb_img( array_merge( $image_args, $big_image_args, $options['title_image_args'] ) );

		$html = $image . $html;

		return $html;
	}

endif;
