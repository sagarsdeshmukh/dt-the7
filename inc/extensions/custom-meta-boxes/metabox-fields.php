<?php
/**
 * Metabox fields.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**************************************************************************************/
// Proportion slider field
/**************************************************************************************/

if ( !class_exists( 'RWMB_Proportion_Slider_Field' ) ) {
	class RWMB_Proportion_Slider_Field {
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts() {
			$url = RWMB_CSS_URL . 'jqueryui';
			wp_enqueue_style( 'jquery-ui-core', "{$url}/jquery.ui.core.css", array(), '1.8.17' );
			wp_enqueue_style( 'jquery-ui-theme', "{$url}/jquery.ui.theme.css", array(), '1.8.17' );
			wp_enqueue_style( 'jquery-ui-slider', "{$url}/jquery.ui.slider.css", array(), '1.8.17' );
			wp_enqueue_style( 'rwmb-slider', RWMB_CSS_URL . 'slider.css' );

			wp_enqueue_script( 'rwmb-slider', RWMB_JS_URL . 'slider.js', array( 'jquery-ui-slider', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-core' ), RWMB_VER, true );
		}

		/**
		 * Get div HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field ) {
			return sprintf(
				'<div class="clearfix">
					<div class="rwmb-slider" id="%s" data-options="%s"></div>
					<span class="rwmb-slider-value-label">%s<span>%s</span>%s</span>
					<input type="hidden" name="%s" value="%s" />
				</div>',
				$field['id'], esc_attr( json_encode( $field['js_options'] ) ),
				$field['prefix'], $meta, $field['suffix'],
				$field['field_name'], $meta
			);
		}

		/**
		 * Normalize parameters for field
		 *
		 * @param array $field
		 *
		 * @return array
		 */
		static function normalize_field( $field ) {
			$field = wp_parse_args( $field, array(
				'prefix'     => '',
				'suffix'     => '',
				'js_options' => array(),
			) );
			$field['js_options'] = wp_parse_args( $field['js_options'], array(
				'range' => 'min', // range = 'min' will add a dark background to sliding part, better UI
			) );

			if ( isset($field['std']) ) {
				$field['js_options']['value'] = absint($field['std']);
			} else {
				$field['js_options']['value'] = $field['js_options']['min'];
			}

			return $field;
		}

		/**
		 * Add proportions preview.
		 */
		static function dt_filter_begin_html( $begin, $field, $meta ) {
			$preview = '
			<div class="rwmb-proportion_slider-preview-container">
				<img src="' . PRESSCORE_ADMIN_URI .'/assets/images/blank.gif" class="rwmb-proportion_slider-prop-box" />
			</div>
			';

			// find label
			$begin_parts = explode('</div>', $begin, 2);
			
			if ( isset( $begin_parts[1] ) ) {
				// add previw after label
				$begin_parts[0] .= '</div>' . $preview;
			
			// if no label
			} else {
				$begin_parts[0] = $preview . $begin_parts[0];
			}

			return implode('', $begin_parts);
		}
	}
	add_filter('rwmb_proportion_slider_begin_html', array('RWMB_Proportion_Slider_Field', 'dt_filter_begin_html'), 10, 3);
}

/**************************************************************************************/
// New advanced image field
/**************************************************************************************/

if ( ! class_exists( 'RWMB_Image_Advanced_MK2_Field' ) )
{
	class RWMB_Image_Advanced_MK2_Field extends RWMB_Image_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			parent::admin_enqueue_scripts();

			// Make sure scripts for new media uploader in WordPress 3.5 is enqueued
			wp_enqueue_media();
			wp_enqueue_script( 'rwmb-image-advanced-mk2', PRESSCORE_EXTENSIONS_URI . '/custom-meta-boxes/js/media.js', array( 'jquery' ), RWMB_VER, true );
			wp_enqueue_style( 'rwmb-image-advanced-mk2-style', PRESSCORE_EXTENSIONS_URI . '/custom-meta-boxes/css/advanced-mk2.css', RWMB_VER );
		}

		/**
		 * Add actions
		 *
		 * @return void
		 */
		static function add_actions()
		{

			// Attach images via Ajax
			add_action( 'wp_ajax_rwmb_attach_media', array( __CLASS__, 'wp_ajax_attach_media' ), 9 );

			// Reorder images via Ajax
			add_action( 'wp_ajax_rwmb_reorder_images', array( __CLASS__, 'wp_ajax_reorder_images' ), 9 );

			// Delete file via Ajax
			add_action( 'wp_ajax_rwmb_delete_file', array( __CLASS__, 'wp_ajax_delete_file' ), 9 );

			// Image template
			add_action( 'admin_footer', array( __CLASS__, 'image_temaplate') );
		}

		/**
		 * Ajax callback for attaching media to field
		 *
		 * @return void
		 */
		static function wp_ajax_attach_media()
		{
			$post_id = is_numeric( $_REQUEST['post_id'] ) ? $_REQUEST['post_id'] : 0;
			$field_id = isset( $_POST['field_id'] ) ? $_POST['field_id'] : 0;
			// $attachment_id    = isset( $_POST['attachment_id'] ) ? $_POST['attachment_id'] : 0;
			$attachments_ids    = isset( $_POST['attachments_ids'] ) ? $_POST['attachments_ids'] : array();

			check_ajax_referer( "rwmb-attach-media_{$field_id}" );

			if ( empty($attachments_ids) ) {
				RW_Meta_Box::ajax_response( _x( 'Empty atachments', 'image upload', 'the7mk2' ), 'error' );
				exit;
			}

			//  sanitize data
			$attachments_ids = array_map( 'absint', $attachments_ids );

			// update
			update_post_meta( $post_id, $field_id, $attachments_ids );

			RW_Meta_Box::ajax_response( false, 'success' );

			exit;
		}

		/**
		 * Ajax callback for reordering images
		 *
		 * @return void
		 */
		static function wp_ajax_reorder_images()
		{
			$field_id 	= isset( $_POST['field_id'] ) ? $_POST['field_id'] : 0;
			$order    	= isset( $_POST['order'] ) ? $_POST['order'] : 0;
			$post_id 	= is_numeric( $_REQUEST['post_id'] ) ? $_REQUEST['post_id'] : 0;

			check_ajax_referer( "rwmb-reorder-images_{$field_id}" );

			parse_str( $order, $items );
			$items = array_map( 'absint', $items['item'] );

			update_post_meta( $post_id, $field_id, $items );

			RW_Meta_Box::ajax_response( _x( 'Order saved', 'image upload', 'the7mk2' ), 'success' );
			exit;
		}

		/**
		 * Ajax callback for deleting files.
		 * Modified from a function used by "Verve Meta Boxes" plugin
		 *
		 * @link http://goo.gl/LzYSq
		 * @return void
		 */
		static function wp_ajax_delete_file()
		{
			$post_id       = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
			$field_id      = isset( $_POST['field_id'] ) ? $_POST['field_id'] : 0;
			$attachment_id = isset( $_POST['attachment_id'] ) ? intval( $_POST['attachment_id'] ) : 0;
			$force_delete  = isset( $_POST['force_delete'] ) ? intval( $_POST['force_delete'] ) : 0;

			check_ajax_referer( "rwmb-delete-file_{$field_id}" );

			// get saved ids
			$saved_ids = get_post_meta( $post_id, $field_id, true );

			// sanitize
			$saved_ids = array_map( 'absint', $saved_ids );

			// exclude attachment from saved list
			$saved_ids = array_diff( $saved_ids, array( absint($attachment_id) ) );

			// update
			update_post_meta( $post_id, $field_id, $saved_ids );

			$ok = $force_delete ? wp_delete_attachment( $attachment_id ) : true;

			if ( $ok )
				RW_Meta_Box::ajax_response( '', 'success' );
			else
				RW_Meta_Box::ajax_response( _x( 'Error: Cannot delete file', 'image upload', 'the7mk2' ), 'error' );
			exit;
		}

		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field )
		{
			$i18n_title = apply_filters( 'rwmb_image_advanced_select_string', _x( 'Select or Upload Images', 'image upload', 'the7mk2' ), $field );
			$attach_nonce = wp_create_nonce( "rwmb-attach-media_{$field['id']}" );

			// Uploaded images
			$html .= self::get_uploaded_images( $meta, $field );

			// Show form upload
			$classes = array( 'button', 'rwmb-image-advanced-upload-mk2', 'hide-if-no-js', 'new-files' );
			if ( ! empty( $field['max_file_uploads'] ) && count( $meta ) >= (int) $field['max_file_uploads'] )
				$classes[] = 'hidden';

			$classes = implode( ' ', $classes );
			$html .= "<a href='#' class='{$classes}' data-attach_media_nonce={$attach_nonce}>{$i18n_title}</a>";

			return $html;
		}

		/**
		 * Get field value
		 * It's the combination of new (uploaded) images and saved images
		 *
		 * @param array $new
		 * @param array $old
		 * @param int   $post_id
		 * @param array $field
		 *
		 * @return array|mixed
		 */
		static function value( $new, $old, $post_id, $field )
		{				
			if ( !$new ) $new = array();
			if ( !$old ) $old = array();
			
			$new = (array) $new;
			
			return array_unique( array_merge( $old, $new ) );
		}

		/**
		 * Save post taxonomy
		 *
		 * @param $post_id
		 * @param $field
		 * @param $old
		 *
		 * @param $new
		 */
		static function save( $new, $old, $post_id, $field )
		{
			// some way this methid fire wen attachments added/removed to revision !!!
			if ( 'revision' == get_post_type($post_id) ) {
				return;
			}

			$name = $field['id'];

			if ( '' === $new || array() === $new ) {
				delete_post_meta( $post_id, $name );
				return;
			}

			update_post_meta( $post_id, $name, (array) $new );
		}

		/**
		 * Standard meta retrieval
		 *
		 * @param mixed $meta
		 * @param int   $post_id
		 * @param array $field
		 * @param bool  $saved
		 *
		 * @return mixed
		 */
		static function meta( $meta, $post_id, $saved, $field )
		{
			$meta = RW_Meta_Box::meta( $meta, $post_id, $saved, $field );

			if ( empty( $meta ) )
				return array();

			return (array) $meta;
		}

		/**
		 * Normalize parameters for field
		 *
		 * @param array $field
		 *
		 * @return array
		 */
		static function normalize_field( $field )
		{
			$field = parent::normalize_field( $field );
			$field['multiple'] = false;
			return $field;
		}

		/**
		 * Get HTML markup for uploaded images
		 *
		 * @param array $images
		 * @param array $field
		 *
		 * @return string
		 */
		static function get_uploaded_images( $images, $field )
		{
			$reorder_nonce = wp_create_nonce( "rwmb-reorder-images_{$field['id']}" );
			$delete_nonce = wp_create_nonce( "rwmb-delete-file_{$field['id']}" );
			$classes = array('rwmb-images', 'rwmb-uploaded');
			if ( count( $images ) <= 0  )
				$classes[] = 'hidden';
			$ul = '<ul class="%s" data-field_id="%s" data-delete_nonce="%s" data-reorder_nonce="%s" data-force_delete="%s" data-max_file_uploads="%s">';
			$html = sprintf(
				$ul,
				implode( ' ', $classes ),
				$field['id'],
				$delete_nonce,
				$reorder_nonce,
				$field['force_delete'] ? 1 : 0,
				$field['max_file_uploads']
			);

			_prime_post_caches( $images, false, true );

			foreach ( $images as $image )
			{
				$html .= self::img_html( $image );
			}

			$html .= '</ul>';

			return $html;
		}
		
		/**
		 * Get HTML markup for ONE uploaded image
		 *
		 * @param int $image Image ID
		 *
		 * @return string
		 */
		static function img_html( $image )
		{
			$i18n_delete = apply_filters( 'rwmb_image_delete_string', _x( 'Delete', 'image upload', 'the7mk2' ) );
			$i18n_edit   = apply_filters( 'rwmb_image_edit_string', _x( 'Edit', 'image upload', 'the7mk2' ) );
			$li = '
				<li id="item_%s">
					<img src="%s" />
					<div class="rwmb-image-bar">
						<a title="%s" class="rwmb-edit-file" href="%s" target="_blank">%s</a> |
						<a title="%s" class="rwmb-delete-file" href="#" data-attachment_id="%s">×</a>
					</div>
				</li>
			';

			$mime_type = get_post_mime_type($image);

			if ( strpos($mime_type, 'image') !== false ) {
				$src  = wp_get_attachment_image_src( $image, 'thumbnail' );
				$src  = $src[0];
			} else {
				$src = wp_mime_type_icon( $mime_type );
			}
			
			$link = get_edit_post_link( $image );

			return sprintf(
				$li,
				$image,
				$src,
				$i18n_edit, $link, $i18n_edit,
				$i18n_delete, $image
			);
		}

		static function image_temaplate() {
			if ( !in_array($GLOBALS['hook_suffix'], array('post.php', 'post-new.php')) ) return;

			?>
			<script type="text/html" id="tmpl-dt-post-gallery-item">
				<li id="item_{{ data.imgID }}">
					<img src="{{ data.imgSrc }}" />
					<div class="rwmb-image-bar">
						<a title="{{ data.editTitle }}" class="rwmb-edit-file" href="{{ data.editHref }}" target="_blank">{{ data.editTitle }}</a> |
						<a title="{{ data.deleteTitle }}" class="rwmb-delete-file" href="#" data-attachment_id="{{ data.imgID }}">×</a>
					</div>
				</li>
			</script>
			<?php
		}
	}
}

/**************************************************************************************/
// Fancy category field
/**************************************************************************************/

if ( ! class_exists( 'RWMB_Fancy_Category_Field' ) ) {
	class RWMB_Fancy_Category_Field {

		static $field = array();
		static $meta = '';
		static $post_type_obj = null;
		static $taxonomy_obj = null;
		static $posts_query = array();
		static $tax_query = array();

		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field ) {

			$meta_defaults = array(
				'select'	=> 'all',
				'type'		=> 'albums',
				'posts_ids'	=> array(),
				'terms_ids'	=> array(),
			);

			// in taxonomy mode change default type to 'category'
			if ( 'taxonomy' == $field['mode'] ) { $meta_defaults['type'] = 'category'; }

			$meta = wp_parse_args($meta, $meta_defaults);

			if ( !is_array($meta['posts_ids']) ) { $meta['posts_ids'] = explode(',', $meta['posts_ids']); }
			if ( !is_array($meta['terms_ids']) ) { $meta['terms_ids'] = explode(',', $meta['terms_ids']); }

			// store field
			self::$field = $field;
			self::$meta = $meta;

			$html = $posts_html = $taxonomy_html = '';

			if ( in_array( $field['mode'], array('both', 'posts') ) ) {

				if ( !empty($field['post_type']) ) {
					self::$post_type_obj = get_post_type_object( $field['post_type'] );

					$query = self::get_posts_query( $field['post_type'] );

					update_post_thumbnail_cache( $query );
				}

				$posts_html = self::get_posts_tab();
			}

			if ( in_array( $field['mode'], array('both', 'taxonomy') ) ) {

				if ( $field['taxonomy'] ) {
					self::$taxonomy_obj = get_taxonomy( $field['taxonomy'] );

					self::get_taxonomy_query( $field['taxonomy'] );
				}

				$taxonomy_html = self::get_taxonomy_tab();
			}

			$html .= self::get_tabs();

			$html .= '<div class="dt_tabs-content">';

			$html .= self::get_main_tab();

			$html .= '<div class="dt_tab-select hide-if-js">';

			$html .= $posts_html . $taxonomy_html;

			$html .= '</div><!-- /.dt_tab-select -->';

			$html .= '</div><!-- /.dt_tabs-content -->';

			return $html;
		}

		/**
		 * Get posts list.
		 */
		static function get_posts_tab() {

			if ( ! self::get_posts_query()->have_posts() ) {
				return '';
			}

			global $post, $wpdb;

			$imgs_text = array(
				_x('no pictures', 'backend', 'the7mk2'),
				_x('1 picture', 'backend', 'the7mk2'),
				_x('% pictures', 'backend', 'the7mk2')
			);

			$html = '';

			$html .= '<div class="dt_tab-items hide-if-js">';

			update_post_thumbnail_cache( self::get_posts_query() );

			foreach ( self::get_posts_query()->posts as $_post ) {
				
				$attachments = get_post_meta( $_post->ID, '_dt_album_media_items', true );

				// count post images
				$imgs_count = count( $attachments );

				// prepare title info
				if ( 0 == $imgs_count ) { $title_info = $imgs_text[0]; }
				elseif ( 1 == $imgs_count ) { $title_info = $imgs_text[1]; }
				else { $title_info = str_replace('%', $imgs_count, $imgs_text[2]); }

				// post terms
				$terms = get_the_terms( $_post->ID, self::$field['taxonomy'] );
				if( !is_wp_error($terms) && $terms ) { 
					$term_links = array();
					foreach ( $terms as $term ) {
						$link = get_admin_url() . 'edit-tags.php';
						$link = add_query_arg(
							array(
								'action'	=> 'edit',
								'post_type'	=> self::$field['post_type'],
								'taxonomy'	=> self::$field['taxonomy'],
								'tag_ID'	=> $term->term_id
							),
							$link
						);
						$term_links[] = '<a href="' . esc_url( $link ) . '" rel="tag" target="_blank">' . $term->name . '</a>';
					}
					
					if( empty($term_links) ) {
						$term_links[] = 'none';
					}
					
					$terms_list = '<p><strong>' . _x('Categories: ', 'backend', 'the7mk2') . '</strong>' . implode( ', ', $term_links ) . '</p>';
				}else {
					$terms_list = '<p></p>';
				}

				// item start
				$item_str = '<div class="dt_list-item"><div class="dt_item-holder">';
				
				// item checkbox
				$item_str .= sprintf( '<label class="dt_checkbox"><input type="checkbox" name="%s" value="%s" %s /></label>',
					self::$field['field_name'] . '[posts_ids][' . $_post->ID . ']',
					$_post->ID,
					checked( in_array($_post->ID, (array) self::$meta['posts_ids']), true, false )
				);

				// get thumbnail or first post image
				$img = '';
				if ( has_post_thumbnail($_post->ID) ) {
					$img = wp_get_attachment_image_src( get_post_thumbnail_id($_post->ID), 'thumbnail' );
				} else {
					
					if ( $attachments && is_array( $attachments ) ) {
						$img = wp_get_attachment_image_src( current( $attachments ), 'thumbnail' );
					}
				}

				// if no image
				if ( !$img ) {
					$img = array( get_template_directory_uri() . '/images/no-avatar.gif' );
				}

				// image style and dimensions
				$cover_style = 'dt_album-cover';
				$w = $h = 88; 
				if( 'dt_slider' == $_post->post_type ) {
					$cover_style = 'dt_slider-cover';
					$w = 98; $h = 68;
				}

				// image block
				$item_str .= sprintf( '<div class="dt_item-cover %s"><div><img src="%s" heught="%d" width="%d" /></div></div>',
					$cover_style, $img[0], $h, $w
				);

				// description start
				$item_str .= '<div class="dt_item-desc">';

				// title
				$item_str .= '<strong><a href="' . esc_url(get_admin_url() . 'post.php?post=' . $_post->ID . '&action=edit') . '" target="_blank">' . get_the_title( $_post->ID ) . '</a> (' . $title_info . ')</strong>';

				// terms list
				$item_str .= $terms_list;

				// date
				$date_format = get_option('date_format');
				$item_str .= sprintf( '<strong>%1$s</strong><abbr title="%2$s">%2$s</abbr>',
					_x('Date: ', 'backend', 'the7mk2'),
					apply_filters('get_the_date', mysql2date($date_format, $_post->post_date), $date_format)
				);
				
				// actions start
				$item_str .= '<div class="row-actions">';

					// edit
					$item_str .= sprintf('<span class="edit"><a title="%s" href="%s" target="_blank">%s</a></span>',
						_x( 'Edit this item', 'backend', 'the7mk2' ),
						esc_url(get_admin_url() . 'post.php?post=' . $_post->ID . '&action=edit'),
						_x( 'Edit', 'backend', 'the7mk2' ) 
					);

					// move to trash
					if( current_user_can( 'edit_post', $_post->ID ) ) {
						$item_str .= sprintf(' | <span class="trash"><a title="%s" href="%s">%s</a></span>',
							_x( 'Move this item to the Trash', 'backend', 'the7mk2' ),
							wp_nonce_url( site_url() . "/wp-admin/post.php?action=trash&post=" . $_post->ID, 'trash-' . $_post->post_type . '_' . $_post->ID),
							_x( 'Trash', 'backend', 'the7mk2' )
						);
					}

				// ections end
				$item_str .= '</div>';

				// description end
				$item_str .= '</div>';

				$item_str .= '</div></div>';

				$html .= $item_str;
			}

			$html .= '</div>';

			return $html;
		}

		/**
		 * Get taxonomy list.
		 */
		static function get_taxonomy_tab() {
			if ( ! self::get_taxonomy_query() ) {
				return '';
			}

			$html = '';

			$html .= '<div class="dt_tab-categories hide-if-js">';

			foreach ( self::get_taxonomy_query() as $term ) {
				$html .= sprintf( '<div class="dt_list-item"><label class="dt_checkbox"><input type="checkbox" name="%1$s" value="%2$s" %3$s /></label><span>%4$s</span></div>',
					self::$field['field_name'] . '[terms_ids][' . $term->term_id . ']',
					$term->term_id,
					checked( in_array($term->term_id, (array) self::$meta['terms_ids']), true, false ),
					sprintf( '%s (%d)', $term->name, $term->count )
				);

			}

			$html .= '</div>';

			return $html;
		}

		/**
		 * Main tab.
		 */
		static function get_main_tab() {
			global $wpdb;
			$admin_url = get_admin_url();
			
			$post_type_info = empty(self::$field['post_type_info']) ? array('posts', 'categories') : (array) self::$field['post_type_info'];
			$tab_class = empty(self::$field['main_tab_class']) ? 'dt_all_sliders' : esc_attr(self::$field['main_tab_class']);

			$html = '';
			
			// buttons
			$buttons = array();
			if ( null !== self::$post_type_obj ) {

				// add new
				$buttons[] = self::get_admin_link( 'post-new.php?post_type=' . self::$field['post_type'], self::$post_type_obj->labels->add_new_item );
				
				// edit
				$buttons[] = self::get_admin_link( 'edit.php?post_type=' . self::$field['post_type'], self::$post_type_obj->labels->edit_item );

				if ( null !== self::$taxonomy_obj ) {
					// taxonomy
					$buttons[] = self::get_admin_link(
						'edit-tags.php?taxonomy=' . self::$field['taxonomy'] . '&post_type=' . self::$field['post_type'],
						self::$taxonomy_obj->labels->name
					);
				}

			}

			// post type info
			$total = array();
			if ( null !== self::$post_type_obj ) {
				$posts_ids = array();

				// $posts_count = count($posts_ids);
				$posts_count = self::get_posts_query()->found_posts;

				// posts total
				if ( in_array('posts', $post_type_info) ) {
					$total[] = sprintf( '<li class="dt_total_albums">%d %s</li>', $posts_count, self::$post_type_obj->labels->name );
				}
			}

			if ( null !== self::$taxonomy_obj && in_array('categories', $post_type_info) ) {
				$tax_count = count(self::get_taxonomy_query());

				// taxonomy total
				$total[] = sprintf( '<li class="dt_total_categories">%d %s</li>', $tax_count, self::$taxonomy_obj->labels->name );
			}

			$html .= '
			<div class="dt_tab-all hide-if-js">
				<div class="dt_all_desc ' . $tab_class . '">';

			if ( !empty(self::$field['desc']) ) {
				$html .= self::$field['desc'];
			}

			$html .= '<p class="dt_hr"></p>';
			$html .= '<h4>' . _x('You have:', 'backend', 'the7mk2') . '</h4>';
			
			// output total
			$html .= '<ul class="dt_total">' . implode('', $total) . '</ul>';
			
			$html .= implode('', $buttons);

			$html .= '
				</div>
			</div>';

			return $html;
		}

		/**
		 * Get tabs and mode switcher.
		 */
		static function get_tabs() {
			$select = array(
				'all'       => _x('All', 'backend metabox', 'the7mk2'),
				'only'      => _x('Only', 'backend metabox', 'the7mk2'),
				'except'    => _x('All, except', 'backend metabox', 'the7mk2'),
			);

			$type = array(
				'albums'		=> _x('Albums', 'backend metabox', 'the7mk2'),
				'category'		=> _x('Category', 'backend metabox', 'the7mk2'),
			);

			$html = '';
			$html .= '<div class="dt_tabs">';
				
				$hidden_class = '';
				if ( 'both' != self::$field['mode'] ) { $hidden_class = ' hide-if-js'; }

				// Arrange
				$html .= '<div class="dt_arrange-by' . $hidden_class . '">';
				
					if ( 'both' == self::$field['mode'] ) {
						$html .= '<strong>' . _x('Arrange by:', 'backend metabox', 'the7mk2') . '</strong>';
					}

					foreach ( $type as $value=>$title ) {
						
						$class = $value;
						if ( 'category' == $value ) { $class = 'categories'; }

						$html .= '<label class="dt_arrange dt_by-' . esc_attr($class) . '">';
						$html .= sprintf( '<input class="type_selector" type="radio" name="%s" value="%s" %s/>',
							self::$field['field_name'] . '[type]',
							$value,
							checked(self::$meta['type'], $value, false)
						);
						$html .= '<span>' . $title . '</span></label>';
					}

				$html .= '</div>';

				// Tabs
				foreach ( $select as $value=>$title ) {
					$html .= '<label class="dt_tab dt_' . esc_attr($value) . '">';
					$html .= sprintf( '<input type="radio" name="%s" value="%s" %s/>',
						self::$field['field_name'] . '[select]',
						$value,
						checked(self::$meta['select'], $value, false)
					);
					$html .= '<span>' . $title . '</span></label>';
				}

			$html .= '</div>';

			return $html;
		}

		static function get_admin_link( $action, $desc = '' ) {
			return sprintf('<a href="%s" class="button" target="_blank">%s</a>', esc_url(get_admin_url() . $action), $desc);
		}

		static function begin_html( $begin ) {
			return '';
		}

		static function end_html( $end ) {
			return '';
		}

		static function value( $new, $field, $old ) {

			if ( ! is_array( $new ) ) {
				$new = array( 'select' => 'all', 'type' => 'category' );
			}

			if ( 'all' != $new['select'] ) {
				if ( ( empty($new['posts_ids']) && 'albums' == $new['type'] ) || ( empty($new['terms_ids']) && 'category' == $new['type'] ) ) {
					$new['select'] = 'all';
				}
			}

			return $new;
		}

		static function meta( $meta, $post_id, $saved, $field ) {
			$meta = get_post_meta( $post_id, $field['id'], !$field['multiple'] );

			// Use $field['std'] only when the meta box hasn't been saved (i.e. the first time we run)
			$meta = ( !$saved && '' === $meta || array() === $meta ) ? $field['std'] : $meta;

			return $meta;
		}

		static function get_posts_query( $post_type = '' ) {
			static $_post_type = '';
			if ( $post_type ) {
				$_post_type = $post_type;
			}

			if ( ! array_key_exists( $_post_type, self::$posts_query ) ) {
				self::$posts_query[ $_post_type ] = new WP_Query(array(
					'post_type'			=> $_post_type,
					'posts_per_page'	=> -1,
					'post_status'		=> 'publish'
				));
			}
			return self::$posts_query[ $_post_type ];
		}

		static function get_taxonomy_query( $taxonomy = '' ) {
			static $_taxonomy = '';
			if ( $taxonomy ) {
				$_taxonomy = $taxonomy;
			}

			if ( ! array_key_exists( $_taxonomy, self::$tax_query ) ) {
				self::$tax_query[ $_taxonomy ] = get_terms(
					$_taxonomy,
					array(
						'hide_empty'               => true,
						'hierarchical'             => false,
						'pad_counts'               => false
					)
				);
			}
			return self::$tax_query[ $_taxonomy ];
		}
	}
	add_filter( 'rwmb_fancy_category_begin_html', array('RWMB_Fancy_Category_Field', 'begin_html'), 10 );
	add_filter( 'rwmb_fancy_category_end_html', array('RWMB_Fancy_Category_Field', 'end_html'), 10 );
}

/**************************************************************************************/
// Proper taxonomy field
/**************************************************************************************/

if ( ! class_exists( 'RWMB_Taxonomy_List_Field' ) )
{
	class RWMB_Taxonomy_List_Field extends RWMB_Taxonomy_Field
	{
		/**
		 * Normalize parameters for field
		 *
		 * @param array $field
		 *
		 * @return array
		 */
		static function normalize_field( $field )
		{
			$field = parent::normalize_field( $field );
			$field['multiple'] = false;
			return $field;
		}

		/**
		 * Save post taxonomy
		 *
		 * @param $post_id
		 * @param $field
		 * @param $old
		 *
		 * @param $new
		 */
		static function save( $new, $old, $post_id, $field )
		{
			// some way this methid fire wen attachments added/removed to revision !!!
			if ( 'revision' == get_post_type($post_id) ) {
				return;
			}

			$name = $field['id'];

			if ( '' === $new || array() === $new ) {
				delete_post_meta( $post_id, $name );
				return;
			}

			update_post_meta( $post_id, $name, $new );
		}

		/**
		 * Standard meta retrieval
		 *
		 * @param mixed 	$meta
		 * @param int		$post_id
		 * @param array  	$field
		 * @param bool  	$saved
		 *
		 * @return mixed
		 */
		static function meta( $meta, $post_id, $saved, $field )
		{
			$meta = RW_Meta_Box::meta( $meta, $post_id, $saved, $field );

			if ( empty( $meta ) )
				return array();

			return (array) $meta;
		}
	}
}

/**************************************************************************************/
// Simple proportions field
/**************************************************************************************/

if ( ! class_exists( 'RWMB_Simple_Proportions_Field' ) )
{
	class RWMB_Simple_Proportions_Field
	{
		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field )
		{
			$width_name = $field['field_name'] . '[width]';
			$height_name = $field['field_name'] . '[height]';

			return sprintf(
				'<label>%s <input type="text" class="rwmb-text" name="%s" id="%s-width" value="%s" size="%s" %s/></label> <span>&times;</span> <label>%s <input type="text" class="rwmb-text" name="%s" id="%s-height" value="%s" size="%s" %s/></label>%s',
				_x( 'width', 'metabox', 'the7mk2' ),
				$width_name,
				$field['id'],
				$meta['width'],
				$field['size'],
				!$field['datalist'] ?  '' : "list='{$field['datalist']['id']}'",
				_x( 'height', 'metabox', 'the7mk2' ),
				$height_name,
				$field['id'],
				$meta['height'],
				$field['size'],
				!$field['datalist'] ?  '' : "list='{$field['datalist']['id']}'",
				self::datalist_html($field)
			);
		}

		/**
		 * Normalize parameters for field
		 *
		 * @param array $field
		 *
		 * @return array
		 */
		static function normalize_field( $field )
		{
			$field = wp_parse_args( $field, array(
				'size' 		=> 10,
				'datalist' 	=> false,
				'multiple'	=> false,
			) );
			return $field;
		}
		
		/**
		 * Create datalist, if any
		 *
		 * @param array $field
		 *
		 * @return array
		 */
		static function datalist_html( $field )
		{
			if( !$field['datalist'] )
				return '';
			$datalist = $field['datalist'];
			$html = sprintf(
				'<datalist id="%s">',
				$datalist['id']
			);
			
			foreach( $datalist['options'] as $option ) {
				$html.= sprintf('<option value="%s"></option>', $option);	
			}
			
			$html .= '</datalist>';
			
			return $html;
		}

		/**
		 * Save post taxonomy
		 *
		 * @param $post_id
		 * @param $field
		 * @param $old
		 *
		 * @param $new
		 */
		static function save( $new, $old, $post_id, $field )
		{
			// some way this methid fire wen attachments added/removed to revision !!!
			if ( 'revision' == get_post_type($post_id) ) {
				return;
			}

			$name = $field['id'];

			if ( '' === $new || array() === $new ) {
				delete_post_meta( $post_id, $name );
				return;
			}

			$new = wp_parse_args( $new, array( 'width' => '', 'height' => '' ) );
			$new = array_map('esc_attr', $new);

			update_post_meta( $post_id, $name, $new );
		}

		/**
		 * Standard meta retrieval
		 *
		 * @param mixed 	$meta
		 * @param int		$post_id
		 * @param array  	$field
		 * @param bool  	$saved
		 *
		 * @return mixed
		 */
		static function meta( $meta, $post_id, $saved, $field )
		{
			$meta = RW_Meta_Box::meta( $meta, $post_id, $saved, $field );

			if ( empty( $meta ) )
				return array('width' => '', 'height' => '');

			return (array) $meta;
		}
	}
}

/**
 * Dropdown Pages.
 */
if ( !class_exists( 'RWMB_Dropdown_Pages_Field' ) )
{
	class RWMB_Dropdown_Pages_Field
	{

		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field )
		{
			$html = wp_dropdown_pages( array(
				'name'              => esc_attr( $field['id'] ),
				'id'                => esc_attr( $field['id'] ),
				'echo'              => 0,
				'show_option_none'  => $field['placeholder'],
				'option_none_value' => '0',
				'selected'          => $meta,
				'post_status'       => $field['post_status'],
				'class'             => 'rwmb-select',
			) );

			return $html;
		}

		/**
		 * Normalize parameters for field
		 *
		 * @param array $field
		 *
		 * @return array
		 */
		static function normalize_field( $field )
		{
			$field = wp_parse_args( $field, array(
				'post_status' => 'publish',
			) );

			$field['std'] = empty( $field['std'] ) ? _x( 'Select a Page', 'pages', 'the7mk2' ) : $field['std'];

			return RWMB_Select_Field::normalize_field( $field );
		}

		/**
		 * Get meta value
		 * If field is cloneable, value is saved as a single entry in DB
		 * Otherwise value is saved as multiple entries (for backward compatibility)
		 *
		 * @see "save" method for better understanding
		 *
		 * @param $meta
		 * @param $post_id
		 * @param $saved
		 * @param $field
		 *
		 * @return array
		 */
		static function meta( $meta, $post_id, $saved, $field )
		{
			$meta = RWMB_Select_Field::meta( $meta, $post_id, $saved, $field );
			return is_array( $meta ) ? current( $meta ) : $meta;
		}

		/**
		 * Save meta value
		 * If field is cloneable, value is saved as a single entry in DB
		 * Otherwise value is saved as multiple entries (for backward compatibility)
		 *
		 * TODO: A good way to ALWAYS save values in single entry in DB, while maintaining backward compatibility
		 *
		 * @param $new
		 * @param $old
		 * @param $post_id
		 * @param $field
		 */
		static function save( $new, $old, $post_id, $field )
		{
			return RWMB_Select_Field::save( $new, $old, $post_id, $field );
		}
	}
}

/**
 * Add assistive text to text input.
 */
function presscore_meta_box_text_assistive_text( $field_html, $field, $meta ) {
	if ( !empty($field['assistive_text']) ) {
		$field_html .= '&nbsp;<small>' . $field['assistive_text'] . '</small>';
	}
	return $field_html;
}
add_filter( 'rwmb_text_html', 'presscore_meta_box_text_assistive_text', 10, 3 );

/**
 * Add some classes to meta box wrap.
 */
function presscore_meta_box_classes( $begin, $field, $meta ) {
	$classes = array(
		'rwmb-input-'.esc_attr($field['id'])
	);

	// compatibility with old scripts and styles
	switch ( $field['type'] ) {
		case 'radio':
			foreach( $field['options'] as $option ) {
				if ( is_array($option) ) { $classes[] = 'dt_radio-img'; break; }
			}
			
			break;
	}

	if ( !empty($field['show_on']) ) {
		$begin = str_replace('class="rwmb-field', 'data-show-on="' . esc_attr(implode(',', (array) $field['show_on'])) . '" class="rwmb-field hide-if-js', $begin);
	}

	if ( !empty($field['top_divider']) ) {
		$begin = '<div class="dt_hr dt_hr-top"></div>' . $begin;
	}

	// divider
	if ( !empty( $field['divider'] ) && in_array( $field['divider'], array( 'top', 'top_and_bottom' ) ) ) {
		$begin = '<div class="dt_hr dt_hr-top"></div>' . $begin;
	}

	return str_replace('class="rwmb-input', 'class="rwmb-input ' . implode(' ', $classes), $begin);
}
add_filter('rwmb_begin_html', 'presscore_meta_box_classes', 10, 3);

/**
 * Add some classes to meta box wrap.
 */
function presscore_meta_box_classes_end_html( $end, $field, $meta ) {
	
	// divider
	if ( !empty( $field['divider'] ) && in_array( $field['divider'], array( 'bottom', 'top_and_bottom' ) ) ) {
		$end .= '<div class="dt_hr dt_hr-bottom"></div>';
	}

	if ( !empty($field['bottom_divider']) ) {
		$end .= '<div class="dt_hr dt_hr-bottom"></div>';
	}

	return $end;
}
add_filter('rwmb_end_html', 'presscore_meta_box_classes_end_html', 10, 3);


function presscore_meta_box_before_html( $before_html, $field ) {
	static $saved_show_on_template = array();

	$open_template = '<div class="rwmb-hidden-field hide-if-js" data-show-on="%s">';
	$close_template = '</div>';

	$field_show_on_template = isset( $field['show_on_template'] ) ? $field['show_on_template'] : array();
	if ( !is_array( $field_show_on_template ) ) {
		$field_show_on_template = explode( ',', $field_show_on_template );
	}
	$field_show_on_template = array_map( 'trim', $field_show_on_template );
	sort( $field_show_on_template );

	$result_html = $before_html;
	if ( empty( $saved_show_on_template ) && !empty( $field_show_on_template ) ) {
		$saved_show_on_template = $field_show_on_template;
		$result_html .= sprintf( $open_template, implode( ',', $saved_show_on_template ) );

	} else if ( !empty( $saved_show_on_template ) && empty( $field_show_on_template ) ) {
		$saved_show_on_template = array();
		$result_html = $close_template . $result_html;

	} else if ( !empty( $saved_show_on_template ) && !empty( $field_show_on_template ) ) {

		$saved_string = implode( ',', $saved_show_on_template );
		$field_string = implode( ',', $field_show_on_template );

		if ( $saved_string != $field_string ) {
			$saved_show_on_template = $field_show_on_template;
			$result_html = $close_template . $before_html . sprintf( $open_template, implode( ',', $saved_show_on_template ) );
		}

	}

	return $result_html;
}
add_filter( 'rwmb_field_before_html', 'presscore_meta_box_before_html', 10, 2 );
