<?php
/**
 * Dt Mega menu admin class.
 *
 * inspired by http://www.wpexplorer.com/adding-custom-attributes-to-wordpress-menus/
 */

if ( ! class_exists( 'Presscore_Modules_MegaMenu_Admin', false ) ) :

	class Presscore_Modules_MegaMenu_Admin {

		public static function execute() {
			return new Presscore_Modules_MegaMenu_Admin();
		}

		function __construct() {

			// setup custom menu fields
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'setup_custom_nav_fields' ) );

			// save menu custom fields
			add_action( 'wp_update_nav_menu_item', array( $this, 'update_custom_nav_fields' ), 10, 3 );

			// replace menu walker
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'replace_walker_class' ), 90, 2 );

			// add menu item custom fields
			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'wp_nav_menu_item_custom_fields' ), 99, 4 );

			// add admin css
			add_action( 'admin_print_styles-nav-menus.php', array( $this, 'add_admin_menu_inline_css' ), 15 );

			// add some javascript
			add_action( 'admin_print_footer_scripts', array( $this, 'javascript_magic' ), 99 );
		}

		/**
		 * Setup custom menu item fields before output.
		 */
		function setup_custom_nav_fields( $menu_item ) {

			// common
			$menu_item->dt_mega_menu_icon = get_post_meta( $menu_item->ID, '_menu_item_dt_mega_menu_icon', true );
			$menu_item->dt_mega_menu_iconfont = get_post_meta( $menu_item->ID, '_menu_item_dt_mega_menu_iconfont', true );

			// first level
			$menu_item->dt_mega_menu_enabled = get_post_meta( $menu_item->ID, '_menu_item_dt_mega_menu_enabled', true );
			$menu_item->dt_mega_menu_fullwidth = get_post_meta( $menu_item->ID, '_menu_item_dt_mega_menu_fullwidth', true );
			$menu_item->dt_mega_menu_columns = get_post_meta( $menu_item->ID, '_menu_item_dt_mega_menu_columns', true );

			// second level
			$menu_item->dt_mega_menu_hide_title = get_post_meta( $menu_item->ID, '_menu_item_dt_mega_menu_hide_title', true );
			$menu_item->dt_mega_menu_remove_link = get_post_meta( $menu_item->ID, '_menu_item_dt_mega_menu_remove_link', true );
			$menu_item->dt_mega_menu_new_row = get_post_meta( $menu_item->ID, '_menu_item_dt_mega_menu_new_row', true );

			// third level
			$menu_item->dt_mega_menu_new_column = get_post_meta( $menu_item->ID, '_menu_item_dt_mega_menu_new_column', true );

			return $menu_item;
		}

		/**
		 * Update custom menu item fields.
		 */
		function update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

			// icon
			if ( isset($_REQUEST['menu-item-dt-icon']) && is_array( $_REQUEST['menu-item-dt-icon'] ) ) {
				$icon = in_array( $_REQUEST['menu-item-dt-icon'][$menu_item_db_id], array( 'image', 'iconfont' ) ) ? $_REQUEST['menu-item-dt-icon'][$menu_item_db_id] : 'none';
				update_post_meta( $menu_item_db_id, '_menu_item_dt_mega_menu_icon', $icon );
			}

			// iconfont
			if ( isset($_REQUEST['menu-item-dt-iconfont']) && is_array( $_REQUEST['menu-item-dt-iconfont'] ) ) {
				$iconfont = $_REQUEST['menu-item-dt-iconfont'][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_dt_mega_menu_iconfont', $iconfont );
			}

			// mega menu enabled
			$enable_mega_menu = isset($_REQUEST['menu-item-dt-enable-mega-menu'], $_REQUEST['menu-item-dt-enable-mega-menu'][$menu_item_db_id]);
			update_post_meta( $menu_item_db_id, '_menu_item_dt_mega_menu_enabled', $enable_mega_menu );

			// fullwidth
			$fullwidth = isset($_REQUEST['menu-item-dt-fullwidth-menu'], $_REQUEST['menu-item-dt-fullwidth-menu'][$menu_item_db_id]);
			update_post_meta( $menu_item_db_id, '_menu_item_dt_mega_menu_fullwidth', $fullwidth );

			// columns
			if ( isset($_REQUEST['menu-item-dt-columns']) && is_array( $_REQUEST['menu-item-dt-columns'] ) ) {
				$columns = absint($_REQUEST['menu-item-dt-columns'][$menu_item_db_id]);
				update_post_meta( $menu_item_db_id, '_menu_item_dt_mega_menu_columns', $columns );
			}

			// hide title
			$hide_title = isset($_REQUEST['menu-item-dt-hide-title'], $_REQUEST['menu-item-dt-hide-title'][$menu_item_db_id]);
			update_post_meta( $menu_item_db_id, '_menu_item_dt_mega_menu_hide_title', $hide_title );

			// remove link
			$remove_link = isset($_REQUEST['menu-item-dt-remove-link'], $_REQUEST['menu-item-dt-remove-link'][$menu_item_db_id]);
			update_post_meta( $menu_item_db_id, '_menu_item_dt_mega_menu_remove_link', $remove_link );

			// new row
			$new_row = isset($_REQUEST['menu-item-dt-new-row'], $_REQUEST['menu-item-dt-new-row'][$menu_item_db_id]);
			update_post_meta( $menu_item_db_id, '_menu_item_dt_mega_menu_new_row', $new_row );

			// new column
			$new_column = isset($_REQUEST['menu-item-dt-new-column'], $_REQUEST['menu-item-dt-new-column'][$menu_item_db_id]);
			update_post_meta( $menu_item_db_id, '_menu_item_dt_mega_menu_new_column', $new_column );
		}

		/**
		 * Replace Walker_Nav_Menu_Edit with custom one.
		 */
		function replace_walker_class( $walker, $menu_id ) {

			if ( 'Walker_Nav_Menu_Edit' == $walker ) {
				$walker = 'Presscore_Modules_MegaMenu_EditMenuWalker';
			}

			return $walker;
		}

		/**
		 * Add custom menu item fields.
		 */
		public function wp_nav_menu_item_custom_fields( $item_id, $item, $depth, $args ) {
			// set default item fields
			$default_mega_menu_fields = array(
				'dt_mega_menu_icon' => 'none',
				'dt_mega_menu_iconfont' => '',
				'dt_mega_menu_enabled' => 0,
				'dt_mega_menu_fullwidth' => 0,
				'dt_mega_menu_columns' => 3,
				'dt_mega_menu_hide_title' => 0,
				'dt_mega_menu_remove_link' => 0,
				'dt_mega_menu_new_row' => 0,
				'dt_mega_menu_new_column' => 0
			);

			// set defaults
			foreach ( $default_mega_menu_fields as $field=>$value ) {
				if ( !isset($item->$field) ) {
					$item->$field = $value;
				}
			}

			// for ajax added items
			if ( empty( $item->dt_mega_menu_icon ) ) {
				$item->dt_mega_menu_icon = 'none';
			}

			if ( empty( $item->dt_mega_menu_columns ) ) {
				$item->dt_mega_menu_columns = 3;
			}

			$mega_menu_container_classes = array( 'dt-mega-menu-feilds' );
			switch ( $item->dt_mega_menu_icon ) {
				case 'iconfont': $mega_menu_container_classes[] = 'field-dt-mega-menu-iconfont-icon';
			}

			$mega_menu_container_classes = implode( ' ', $mega_menu_container_classes );
			?>

			<!-- DT Mega Menu Start -->

			<div class="<?php echo esc_attr( $mega_menu_container_classes ); ?>">

				<p class="field-dt-icon description description-wide">
					<?php _ex( 'Icon :', 'edit menu walker', 'the7mk2' ); ?>
					<label>
						<input type="radio" name="menu-item-dt-icon[<?php echo $item_id; ?>]" value="none" <?php checked( $item->dt_mega_menu_icon, 'none' ); ?>/>
						<?php _ex( 'no', 'edit menu walker', 'the7mk2' ); ?>
					</label>
					<label>
						<input type="radio" name="menu-item-dt-icon[<?php echo $item_id; ?>]" value="iconfont" <?php checked( $item->dt_mega_menu_icon, 'iconfont' ); ?>/>
						<?php _ex( 'iconfont', 'edit menu walker', 'the7mk2' ); ?>
					</label>
				</p>
				<p class="field-dt-iconfont description description-wide">
					<label>
						<?php _ex( 'Iconfont code', 'edit menu walker', 'the7mk2' ); ?><br />
						<textarea class="widefat edit-menu-item-iconfont" rows="3" cols="20" name="menu-item-dt-iconfont[<?php echo $item_id; ?>]"><?php echo esc_html( $item->dt_mega_menu_iconfont ); // textarea_escaped ?></textarea>
					</label>
				</p>

				<!-- first level -->
				<p class="field-dt-enable-mega-menu">
					<label for="edit-menu-item-dt-enable-mega-menu-<?php echo $item_id; ?>">
						<input id="edit-menu-item-dt-enable-mega-menu-<?php echo $item_id; ?>" type="checkbox" class="menu-item-dt-enable-mega-menu" name="menu-item-dt-enable-mega-menu[<?php echo $item_id; ?>]" <?php checked( $item->dt_mega_menu_enabled ); ?>/>
						<?php _ex( 'Enable Mega Menu', 'edit menu walker', 'the7mk2' ); ?>
					</label>
				</p>
				<p class="field-dt-fullwidth-menu">
					<label for="edit-menu-item-dt-fullwidth-menu-<?php echo $item_id; ?>">
						<input id="edit-menu-item-dt-fullwidth-menu-<?php echo $item_id; ?>" type="checkbox" name="menu-item-dt-fullwidth-menu[<?php echo $item_id; ?>]" <?php checked( $item->dt_mega_menu_fullwidth ); ?>/>
						<?php _ex( 'Fullwidth', 'edit menu walker', 'the7mk2' ); ?>
					</label>
				</p>
				<p class="field-dt-columns description description-wide">
					<?php _ex( 'Number of columns: ', 'edit menu walker', 'the7mk2' ); ?>
					<select name="menu-item-dt-columns[<?php echo $item_id; ?>]" id="edit-menu-item-dt-columns-<?php echo $item_id; ?>">
						<?php foreach( array( '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5 ) as $title=>$value): ?>
							<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->dt_mega_menu_columns); ?>><?php echo esc_html($title); ?></option>
						<?php endforeach; ?>
					</select>
				</p>

				<!-- second level -->
				<p class="field-dt-hide-title">
					<label for="edit-menu-item-dt-hide-title-<?php echo $item_id; ?>">
						<input id="edit-menu-item-dt-hide-title-<?php echo $item_id; ?>" type="checkbox" name="menu-item-dt-hide-title[<?php echo $item_id; ?>]" <?php checked( $item->dt_mega_menu_hide_title ); ?>/>
						<?php _ex( 'Hide title in mega menu', 'edit menu walker', 'the7mk2' ); ?>
					</label>
				</p>
				<p class="field-dt-remove-link">
					<label for="edit-menu-item-dt-remove-link-<?php echo $item_id; ?>">
						<input id="edit-menu-item-dt-remove-link-<?php echo $item_id; ?>" type="checkbox" name="menu-item-dt-remove-link[<?php echo $item_id; ?>]" <?php checked( $item->dt_mega_menu_remove_link ); ?>/>
						<?php _ex( 'Remove link', 'edit menu walker', 'the7mk2' ); ?>
					</label>
				</p>
				<p class="field-dt-new-row">
					<label for="edit-menu-item-dt-new-row-<?php echo $item_id; ?>">
						<input id="edit-menu-item-dt-new-row-<?php echo $item_id; ?>" type="checkbox" name="menu-item-dt-new-row[<?php echo $item_id; ?>]" <?php checked( $item->dt_mega_menu_new_row ); ?>/>
						<?php _ex( 'This item should start a new row', 'edit menu walker', 'the7mk2' ); ?>
					</label>
				</p>

				<!-- third level -->
				<p class="field-dt-new-column">
					<label for="edit-menu-item-dt-new-column-<?php echo $item_id; ?>">
						<input id="edit-menu-item-dt-new-column-<?php echo $item_id; ?>" type="checkbox" name="menu-item-dt-new-column[<?php echo $item_id; ?>]" <?php checked( $item->dt_mega_menu_new_column ); ?>/>
						<?php _ex( 'This item should start a new column', 'edit menu walker', 'the7mk2' ); ?>
					</label>
				</p>

			</div>

			<!-- DT Mega Menu End -->

			<?php
		}

		/**
		 * Add some beautiful inline css for admin menus.
		 */
		function add_admin_menu_inline_css() {
			$css = '
				.menu.ui-sortable .dt-mega-menu-feilds p,
				.menu.ui-sortable .dt-mega-menu-feilds .field-dt-image {
					display: none;
				}

				.menu.ui-sortable .menu-item-depth-0 .dt-mega-menu-feilds .field-dt-enable-mega-menu,
				.menu.ui-sortable .dt-mega-menu-feilds .field-dt-icon,
				.menu.ui-sortable .dt-mega-menu-feilds.field-dt-mega-menu-image-icon .field-dt-image,
				.menu.ui-sortable .dt-mega-menu-feilds.field-dt-mega-menu-iconfont-icon .field-dt-iconfont {
					display: block;
				}

				.menu.ui-sortable .menu-item-depth-0.field-dt-mega-menu-enabled .dt-mega-menu-feilds .field-dt-fullwidth-menu,
				.menu.ui-sortable .menu-item-depth-0.field-dt-mega-menu-enabled .dt-mega-menu-feilds .field-dt-columns,

				.menu.ui-sortable .menu-item-depth-1.field-dt-mega-menu-enabled .dt-mega-menu-feilds .field-dt-hide-title,
				.menu.ui-sortable .menu-item-depth-1.field-dt-mega-menu-enabled .dt-mega-menu-feilds .field-dt-remove-link,
				.menu.ui-sortable .menu-item-depth-1.field-dt-mega-menu-enabled .dt-mega-menu-feilds .field-dt-new-row,

				.menu.ui-sortable .menu-item-depth-2.field-dt-mega-menu-enabled .dt-mega-menu-feilds .field-dt-new-column {
					display: block;
				}
			';
			wp_add_inline_style( 'wp-admin', $css );
		}

		/**
		 * Javascript magic.
		 */
		function javascript_magic() {
			?>
			<SCRIPT TYPE="text/javascript">
				jQuery(function(){

					var dt_fat_menu = {
						reTimeout: false,

						recalc : function() {
							$menuItems = jQuery('.menu-item', '#menu-to-edit');

							$menuItems.each( function(i) {
								var $item = jQuery(this),
									$checkbox = jQuery('.menu-item-dt-enable-mega-menu', this);

								if ( $item.is('.menu-item-depth-0') ) {

									if ( $checkbox.is(':checked') ) {
										$item.addClass('field-dt-mega-menu-enabled');
									}

								} else {

									var checkItem = $menuItems.filter(':eq('+(i-1)+')');
									if ( checkItem.is('.field-dt-mega-menu-enabled') ) {

										$item.addClass('field-dt-mega-menu-enabled');
										$checkbox.attr('checked','checked');
									} else {

										$item.removeClass('field-dt-mega-menu-enabled');
										$checkbox.attr('checked','');
									}

								}

							});

						},

						binds: function() {

							jQuery('#menu-to-edit').on('click', '.menu-item-dt-enable-mega-menu', function(event) {
								var $checkbox = jQuery(this),
									$container = $checkbox.parents('.menu-item:eq(0)');

								if ( $checkbox.is(':checked') ) {
									$container.addClass('field-dt-mega-menu-enabled');
								} else {
									$container.removeClass('field-dt-mega-menu-enabled');
								}

								dt_fat_menu.recalc();

								return true;
							});

							jQuery('#menu-to-edit').on('change', '.field-dt-icon input[type="radio"]', function(event){
								var $this = jQuery(this),
									$parentContainer = $this.parents('.dt-mega-menu-feilds');

								switch( $this.val() ) {
									case 'iconfont': $parentContainer.addClass('field-dt-mega-menu-iconfont-icon').removeClass('field-dt-mega-menu-image-icon'); break;
									default: $parentContainer.removeClass('field-dt-mega-menu-iconfont-icon field-dt-mega-menu-image-icon');
								}

								return true;
							});

						},

						init: function() {
							dt_fat_menu.binds();
							dt_fat_menu.recalc();

							jQuery( ".menu-item-bar" ).live( "mouseup", function(event, ui) {
								if ( !jQuery(event.target).is('a') ) {
									clearTimeout(dt_fat_menu.reTimeout);
									dt_fat_menu.reTimeout = setTimeout(dt_fat_menu.recalc, 700);
								}
							});
						},


					}

					dt_fat_menu.init();
				});
			</SCRIPT>
			<?php
		}
	}

endif;
