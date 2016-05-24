<?php
/**
 * Mega menu front end.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_MegaMenu_Front', false ) ) :

	class Presscore_Modules_MegaMenu_Front {

		protected $columns = 3;
		protected $show_columns = false;
		protected $hide_desc = true;
		protected $hide_title = true;

		public static function execute() {
			return new Presscore_Modules_MegaMenu_Front();
		}

		public function __construct() {
			add_filter( 'presscore_nav_menu_link_before', array( $this, 'add_icon_filter' ), 10, 4 );
			add_action( 'presscore_primary_nav_menu_before', array( $this, 'add_hooks' ) );
			add_action( 'presscore_primary_nav_menu_after', array( $this, 'remove_hooks' ) );
		}

		public function add_hooks() {
			add_action( 'presscore_nav_menu_start_el', array( $this, 'detect_mega_menu_action' ), 10, 3 );
			add_filter( 'presscore_nav_menu_css_class', array( $this, 'mega_menu_class_filter' ), 10, 4 );
			add_filter( 'presscore_nav_menu_el_before', array( $this, 'add_new_column_filter' ), 10, 4 );
			add_filter( 'presscore_nav_menu_start_lvl', array( $this, 'start_row' ), 10, 4 );
			add_filter( 'presscore_nav_menu_end_lvl', array( $this, 'end_row' ), 10, 4 );
		}

		public function remove_hooks() {
			remove_action( 'presscore_nav_menu_start_el', array( $this, 'detect_mega_menu_action' ), 10, 3 );
			remove_filter( 'presscore_nav_menu_css_class', array( $this, 'mega_menu_class_filter' ), 10, 4 );
			remove_filter( 'presscore_nav_menu_el_before', array( $this, 'add_new_column_filter' ), 10, 4 );
			remove_filter( 'presscore_nav_menu_start_lvl', array( $this, 'start_row' ), 10, 4 );
			remove_filter( 'presscore_nav_menu_end_lvl', array( $this, 'end_row' ), 10, 4 );
		}

		public function add_icon_filter( $link_before, $item, $args, $depth ) {
			// add icon
			if ( ! empty( $item->dt_mega_menu_icon ) && 'iconfont' === $item->dt_mega_menu_icon && ! empty( $item->dt_mega_menu_iconfont ) ) {
				$link_before .= wp_kses( $item->dt_mega_menu_iconfont, array( 'i' => array( 'class' => array() ) ) );
			}

			return $link_before;
		}

		public function detect_mega_menu_action( $item, $args, $depth ) {
			if ( 0 === $depth ) {

				if ( ! empty( $item->dt_mega_menu_enabled ) ) {
					$this->show_columns = true;
					$this->columns = $item->dt_mega_menu_columns;

				} else {
					$this->show_columns = false;
					$this->columns = 3;
				}

			} else if ( 1 === $depth && $this->show_columns ) {
				$this->hide_desc = empty( $item->description );
				$this->hide_title = $item->dt_mega_menu_hide_title;

				if ( ! empty( $item->dt_mega_menu_remove_link ) ) {
					$item->dt_is_clickable = false;
				}

			}
		}

		public function mega_menu_class_filter( $classes, $item, $args, $depth ) {
			if ( $this->show_columns ) {

				if ( 0 === $depth ) {

					$classes[] = 'dt-mega-menu';

					if ( ! empty( $item->dt_mega_menu_fullwidth ) ) {
						$classes[] = 'mega-full-width';
					} else {
						$classes[] = 'mega-auto-width';
					}

					if ( ! empty( $item->dt_mega_menu_columns ) ) {
						$classes[] = 'mega-column-' . absint( $item->dt_mega_menu_columns );
					}

				} else if ( 1 === $depth ) {

					if ( ! empty( $item->dt_mega_menu_hide_title ) ) {
						$classes[] = 'hide-mega-title';
					}

					$classes[] = 'no-link';
					$classes[] = 'dt-mega-parent';
					$classes[] = $this->get_column_class( $this->columns );

					if ( ! empty( $item->dt_mega_menu_new_row ) ) {
						$classes[] = 'new-row';
					}

				}

				if ( $item->description ) {
					$classes[] = 'with-subtitle';
				}

			}

			return $classes;
		}

		public function start_row( $output, $depth, $args ) {
			if ( 0 === $depth && $this->show_columns ) {
				$output = '<div class="dt-mega-menu-wrap">' . $output;
			}

			return $output;
		}

		public function end_row( $output, $depth, $args ) {
			if ( 0 === $depth && $this->show_columns ) {
				$output .= '</div>';
			}

			return $output;
		}

		public function add_new_column_filter( $before, $item, $args, $depth ) {
			if ( $this->show_columns ) {

				if ( 1 === $depth && ! empty( $item->dt_mega_menu_new_row ) ) {
					$args->walker->end_lvl( $before, $depth, $args );
					$args->walker->start_lvl( $before, $depth, $args );
				} else if ( 2 === $depth && ! empty( $item->dt_mega_menu_new_column ) ) {
					$fake_column_classes = array( 'menu-item', 'menu-item-has-children', 'dt-mega-parent', 'has-children', 'new-column' );
					$fake_column_classes[] = $this->get_column_class( $this->columns );

					if ( $this->hide_title ) {
						$fake_column_classes[] = 'hide-mega-title';
					}

					// close prev submenu
					$args->walker->end_lvl( $before, $depth - 1, $args );
					$args->walker->end_el( $before, $item, $depth - 1, $args );

					// li wrap
					$before .= '<li class="' . implode( ' ', array_filter( $fake_column_classes ) ) . '">';
					$before .= '<a href="javascript:void(0)" onclick="return false;" style="cursor: default;">' . $args->link_before . '<span class="menu-item-text"><span class="menu-text">&nbsp;</span>' . ( $this->hide_desc ? '' : '<span class="subtitle-text">&nbsp;</span>' ) . '</span>' . $args->link_after . '</a>';

					$args->walker->start_lvl( $before, $depth - 1, $args );
				}

			}

			return $before;
		}

		protected function get_column_class( $col ) {
			$columns_classes = array(
				1 => 'wf-1',
				2 => 'wf-1-2',
				3 => 'wf-1-3',
				4 => 'wf-1-4',
				5 => 'wf-1-5'
			);

			return isset( $columns_classes[ $col ] ) ? $columns_classes[ $col ] : '';
		}

	}

endif;
