<?php
/**
 * Bulk actions scripts.
 *
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Add Bulk edit fields.
 *
 */
function presscore_add_bulk_edit_fields( $col, $type ) {
	// display for one column
	if ( ! in_array( $col, array( 'presscore-sidebar' ) ) ) {
		return;
	}
	$no_change_option = '<option value="-1">' . _x( '&mdash; No Change &mdash;', 'backend bulk edit', 'the7mk2' ) .'</option>';
	?>
	<div class="clear"></div>
	<div class="inline-edit-col-left presscore-bulk-actions">
		<fieldset>
			<div class="inline-edit-col">
				<h4><?php _ex( 'Sidebar and footer options', 'backend bulk edit', 'the7mk2' ); ?></h4>
				<div class="inline-edit-group">
					<label class="alignleft">
						<span class="title"><?php _ex( 'Sidebar layout', 'backend bulk edit', 'the7mk2' ); ?></span>
						<?php
						$sidebar_options = array(
							'left' 		=> _x('Left', 'backend bulk edit', 'the7mk2'),
							'right' 	=> _x('Right', 'backend bulk edit', 'the7mk2'),
							'disabled'	=> _x('Disabled', 'backend bulk edit', 'the7mk2'),
						);
						?>
						<select name="_dt_bulk_edit_sidebar_options">
							<?php echo $no_change_option; ?>
							<?php foreach ( $sidebar_options as $value=>$title ): ?>
								<option value="<?php echo $value; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</label>

					<label class="alignright">
						<span class="title"><?php _ex( 'Show footer', 'backend bulk edit', 'the7mk2' ); ?></span>
						<?php
						$show_wf = array(
							1	=> _x('Yes', 'backend bulk edit footer', 'the7mk2'),
							0	=> _x('No', 'backend bulk edit footer', 'the7mk2'),
						);
						?>
						<select name="_dt_bulk_edit_show_footer">
							<?php echo $no_change_option; ?>
							<?php foreach ( $show_wf as $value=>$title ): ?>
								<option value="<?php echo $value; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				</div>

			<?php if ( function_exists('presscore_get_widgetareas_options') && $wa_list = presscore_get_widgetareas_options() ): ?>

				<div class="inline-edit-group">
					<label class="alignleft">
						<span class="title"><?php _ex( 'Choose sidebar', 'backend bulk edit', 'the7mk2' ); ?></span>
						<select name="_dt_bulk_edit_sidebar">
							<?php echo $no_change_option; ?>
							<?php foreach ( $wa_list as $value=>$title ): ?>
								<option value="<?php echo esc_attr($value); ?>"><?php echo esc_html( $title ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>

					<label class="alignright">
						<span class="title"><?php _ex( 'Choose footer', 'backend bulk edit', 'the7mk2' ); ?></span>
						<select name="_dt_bulk_edit_footer">
							<?php echo $no_change_option; ?>
							<?php foreach ( $wa_list as $value=>$title ): ?>
								<option value="<?php echo esc_attr($value); ?>"><?php echo esc_html( $title ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				</div>

			<?php endif; ?>

			</div>
		</fieldset>
	</div>
	<div class="inline-edit-col-center presscore-bulk-actions">

	<?php if ( 'post' === $type ) : ?>

		<fieldset>
			<div class="inline-edit-col">
				<h4><?php _ex( 'Single post options', 'backend bulk edit', 'the7mk2' ); ?></h4>
				<div class="inline-edit-group">
					<label class="alignleft">
						<span class="title"><?php _ex( 'Show thumbnail', 'backend bulk edit', 'the7mk2' ); ?></span>
						<select name="_dt_bulk_edit_show_thumbnail">
							<?php echo $no_change_option; ?>
							<option value="0"><?php _ex( 'Yes', 'backend bulk edit', 'the7mk2' ); ?></option>
							<option value="1"><?php _ex( 'No', 'backend bulk edit', 'the7mk2' ); ?></option>
						</select>
					</label>
				</div>
			</div>
		</fieldset>

	<?php endif; ?>

	</div>
<?php
}
add_action( 'bulk_edit_custom_box', 'presscore_add_bulk_edit_fields', 10, 2 );

/**
 * Save changes made by bulk edit.
 *
 */
function presscore_bulk_edit_save_changes( $post_ID, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( !isset($_REQUEST['_ajax_nonce']) && !isset($_REQUEST['_wpnonce']) ) {
		return;
	}

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !check_ajax_referer( 'bulk-posts', false, false ) ) {
		return;
	}

	// Check permissions
	if ( !current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	if ( isset($_REQUEST['bulk_edit']) ) {

		// sidebar options
		if ( isset( $_REQUEST['_dt_bulk_edit_sidebar_options'] ) && in_array( $_REQUEST['_dt_bulk_edit_sidebar_options'], array( 'left', 'right', 'disabled' ) ) ) {
			update_post_meta( $post_ID, '_dt_sidebar_position', esc_attr( $_REQUEST['_dt_bulk_edit_sidebar_options'] ) );
		}

		// update sidebar
		if ( isset( $_REQUEST['_dt_bulk_edit_sidebar'] ) && '-1' != $_REQUEST['_dt_bulk_edit_sidebar'] ) {
			update_post_meta( $post_ID, '_dt_sidebar_widgetarea_id', esc_attr( $_REQUEST['_dt_bulk_edit_sidebar'] ) );
		}

		// update footer
		if ( isset( $_REQUEST['_dt_bulk_edit_footer'] ) && '-1' != $_REQUEST['_dt_bulk_edit_footer'] ) {
			update_post_meta( $post_ID, '_dt_footer_widgetarea_id', esc_attr( $_REQUEST['_dt_bulk_edit_footer'] ) );
		}

		// show footer
		if ( isset( $_REQUEST['_dt_bulk_edit_show_footer'] ) && '-1' != $_REQUEST['_dt_bulk_edit_show_footer'] ) {
			update_post_meta( $post_ID, '_dt_footer_show', absint( $_REQUEST['_dt_bulk_edit_show_footer'] ) );
		}

		// featured images
		if ( isset( $_REQUEST['_dt_bulk_edit_show_thumbnail'] ) && '-1' != $_REQUEST['_dt_bulk_edit_show_thumbnail'] ) {
			update_post_meta( $post_ID, '_dt_post_options_hide_thumbnail', absint( $_REQUEST['_dt_bulk_edit_show_thumbnail'] ) );
		}
	}
}
add_action( 'save_post', 'presscore_bulk_edit_save_changes', 10, 2 );

/**
 * Add hide and show title bulk actions to list.
 */
function presscore_add_media_bulk_actions() {
	global $post_type;
	if ( $post_type == 'attachment' ) {
		$show_title_text = _x('Show titles', 'media bulk action', 'the7mk2');
		$hide_title_text = _x('Hide titles', 'media bulk action', 'the7mk2');
	?>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			var $wpAction = jQuery("select[name='action']"),
				$wpAction2 = jQuery("select[name='action2']");

			jQuery('<option>').val('dt_hide_title').text('<?php echo $hide_title_text; ?>').appendTo($wpAction);
			jQuery('<option>').val('dt_hide_title').text('<?php echo $hide_title_text; ?>').appendTo($wpAction2);

			jQuery('<option>').val('dt_show_title').text('<?php echo $show_title_text; ?>').appendTo($wpAction);
			jQuery('<option>').val('dt_show_title').text('<?php echo $show_title_text; ?>').appendTo($wpAction2);
		});
		</script>
	<?php
	}
}
add_action('admin_footer-upload.php', 'presscore_add_media_bulk_actions');

/**
 * Add handler to close and resolve bulk actions.
 *
 * see http://www.foxrunsoftware.net/articles/wordpress/add-custom-bulk-action/
 */
function presscore_media_bulk_actions_handler() {
	global $typenow;
	$post_type = $typenow;

	if ( $post_type == '') {

		// get the action
		$wp_list_table = _get_list_table('WP_Media_List_Table');  // depending on your resource type this could be WP_Users_List_Table, WP_Comments_List_Table, etc
		$action = $wp_list_table->current_action();

		$allowed_actions = array("dt_hide_title", "dt_show_title");
		if ( !in_array($action, $allowed_actions) ) {
			return;
		}

		// security check
		check_admin_referer('bulk-media');

		// make sure ids are submitted.  depending on the resource type, this may be 'media' or 'ids'
		if ( isset($_REQUEST['media']) ) {
			$post_ids = array_map('intval', $_REQUEST['media']);
		}

		if ( empty($post_ids) ) {
			return;
		}

		// this is based on wp-admin/edit.php
		$sendback = remove_query_arg( array('titles_hidden', 'titles_shown', 'untrashed', 'deleted', 'ids'), wp_get_referer() );
		if ( ! $sendback ) {
			$sendback = admin_url( "edit.php?post_type=$post_type" );
		}

		$pagenum = $wp_list_table->get_pagenum();
		$sendback = add_query_arg( 'paged', $pagenum, $sendback );
		$error_msg = _x('You are not allowed to perform this action.', 'backend media error', 'the7mk2');

		switch ( $action ) {
			case 'dt_hide_title':

				foreach( $post_ids as $post_id ) {

					update_post_meta( $post_id, 'dt-img-hide-title', 1 );
				}

				$sendback = add_query_arg( array('titles_hidden' => count($post_ids), 'ids' => join(',', $post_ids) ), $sendback );
			break;

			case 'dt_show_title':

				foreach( $post_ids as $post_id ) {

					update_post_meta( $post_id, 'dt-img-hide-title', 0 );
				}

				$sendback = add_query_arg( array('titles_shown' => count($post_ids), 'ids' => join(',', $post_ids) ), $sendback );
			break;

			default: return;
		}

		$sendback = remove_query_arg( array('action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status',  'post', 'bulk_edit', 'post_view'), $sendback );

		wp_redirect( esc_url_raw( $sendback ) );
		exit();
	}
}
add_action('load-upload.php', 'presscore_media_bulk_actions_handler');
