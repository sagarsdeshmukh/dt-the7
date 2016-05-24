<?php
/**
 * Theme menu.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_nav_menu' ) ) :

	function presscore_nav_menu( $args = array() ) {
		$args = wp_parse_args( $args, array(
			'theme_location' => 'primary',
			'container' => false,
			'container_class' => false,
			'menu_class' => false,
			'menu_id' => 'mainmenu',
			'fallback_cb' => 'presscore_page_menu',
			'before' => '',
			'after' => '',
			'items_wrap' => '<ul id="%1$s">%3$s</ul>',
			'echo' => true,

			'submenu_class' => 'sub-nav',
			'parent_is_clickable' => true,
		) );
		$args = apply_filters( 'presscore_nav_menu_args', $args );

		$nav_menu = apply_filters( 'presscore_pre_nav_menu', null, $args );

		if ( null !== $nav_menu ) {
			if ( $args['echo'] ) {
				echo $nav_menu;
				return;
			}

			return $nav_menu;
		}

		if ( empty( $args['walker'] ) ) {
			$args['walker'] = new Presscore_Primary_Nav_Menu_Walker();
		}

		return wp_nav_menu( $args );
	}

endif;

if ( ! function_exists( 'presscore_page_menu' ) ) :

	function presscore_page_menu( $args = array() ) {
		$defaults = array(
			'sort_column'       => 'menu_order, post_title',
			'container_class'   => 'nav-bg',
			'menu_id'           => 'nav',
			'echo'              => false,
			'link_before'       => '',
			'link_after'        => '',
		);
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'wp_page_menu_args', $args );
		$menu = '';

		$list_args = $args;
		$list_args['echo'] = false;
		$list_args['title_li'] = '';
		$list_args['walker'] = new Presscore_Walker_Page();

		$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages( $list_args ) );

		if ( isset( $menu ) ) {
			$menu = sprintf(
				$args['items_wrap'],
				$args['menu_id'],
				$args['menu_class'],
				$menu
			);
		}

		$menu = apply_filters( 'wp_page_menu', $menu, $args );

		if ( $args['echo'] ) {
			echo $menu;
			return;
		} else {
			return $menu;
		}
	}

endif;

if ( ! class_exists( 'Presscore_Nav_Menu_Walker', false ) ) :

	class Presscore_Nav_Menu_Walker extends Walker_Nav_Menu {
		protected $dt_menu_parents = array();
		protected $dt_options = array();
		protected $dt_is_first = true;

		function __construct( $options = array() ) {
			if ( method_exists( 'Walker_Nav_Menu','__construct' ) ) {
				parent::__construct();
			}

			if ( is_array( $options ) ) {
				$this->dt_options = $options;
			}
		}

		function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
			if ( ! $element ) {
				return;
			}

			//Add indicators for top level menu items with submenus
			$id_field = $this->db_fields['id'];

			if ( ! empty( $children_elements[ $element->$id_field ] ) ) {
				$this->dt_menu_parents[] = $element->$id_field;
			}

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		function dt_get_item_atts( $item, $args, $depth, $atts = array() ) {
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			$atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel'] = ! empty( $item->xfn ) ? $item->xfn : '';

			// is clickable
			if ( ! $item->dt_is_clickable ) {
				$atts['class'] = 'not-clickable-item';
			}

			$atts['data-level'] = absint( $depth ) + 1;

			$atts = apply_filters( 'presscore_nav_menu_link_attributes', $atts, $item, $args, $depth );

			return apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		}

		function dt_prepare_atts( $atts = array() ) {
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= " {$attr}='{$value}'";
				}
			}

			return $attributes;
		}

		function dt_get_item_classes( $item, $args, $depth ) {
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			if (
				in_array( 'current-menu-item',  $classes ) ||
				in_array( 'current-menu-parent',  $classes ) ||
				in_array( 'current-menu-ancestor',  $classes )
			) {
				$classes[] = 'act';
			}

			if ( $item->dt_is_first ) {
				$classes[] = 'first';
			}

			if ( $item->dt_is_parent ) {
				$classes[] = 'has-children';
			}

			$classes = apply_filters( 'presscore_nav_menu_css_class', $classes, $item, $args, $depth );

			return apply_filters( 'nav_menu_css_class', array_unique( $classes ), $item, $args, $depth );
		}
	}

endif;

if ( ! class_exists( 'Presscore_Primary_Nav_Menu_Walker', false ) ) :

	class Presscore_Primary_Nav_Menu_Walker extends Presscore_Nav_Menu_Walker {

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$this->dt_is_first = true;

			$output .= apply_filters( 'presscore_nav_menu_start_lvl', '<ul class="' . esc_attr( $args->submenu_class ) . '">', $depth, $args );
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= apply_filters( 'presscore_nav_menu_end_lvl', '</ul>', $depth, $args );
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $current_id = 0 ) {
			$item->dt_is_first = $this->dt_is_first;
			$item->dt_is_parent = in_array( $item->ID, $this->dt_menu_parents );
			$item->dt_is_clickable = ( ! $item->dt_is_parent || $args->parent_is_clickable );

			do_action( 'presscore_nav_menu_start_el', $item, $args, $depth );

			$classes = $this->dt_get_item_classes( $item, $args, $depth );

			$link_before = apply_filters( 'presscore_nav_menu_link_before', $args->link_before, $item, $args, $depth );
			$link_after = apply_filters( 'presscore_nav_menu_link_after', $args->link_after, $item, $args, $depth );
			$el_before = apply_filters( 'presscore_nav_menu_el_before', '', $item, $args, $depth );

			// li wrap
			$output .= $el_before . '<li class="' . implode( ' ', array_filter( $classes ) ) . '">';

			$title = apply_filters( 'the_title', $item->title, $item->ID );
			$description = ( $item->description ? '<span class="subtitle-text">' . esc_html( $item->description ) . '</span>' : '' );

			$menu_item = $link_before . '<span class="menu-item-text"><span class="menu-text">' . $title . '</span>' . $description . '</span>' . $link_after;

			$attributes = $this->dt_prepare_atts( $this->dt_get_item_atts( $item, $args, $depth ) );
			if ( $attributes ) {
				$item_output = '<a' . $attributes . '>' . $menu_item . '</a>';
			} else {
				$item_output = '<span>' . $menu_item . '</span>';
			}

			$item_output = $args->before . $item_output . $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$this->dt_is_first = false;
			$el_after = apply_filters( 'presscore_nav_menu_el_after', '', $item, $args, $depth );

			$output .= '</li>' . $el_after . ' ';
		}
	}

endif;

if ( ! class_exists( 'Presscore_Walker_Page', false ) ) :

	class Presscore_Walker_Page extends Walker_Page {
		private $dt_menu_parents = array();
		private $dt_is_first = true;

		function __construct( $options = array() ) {
			if ( method_exists( 'Walker_Page','__construct' ) ){
				parent::__construct();
			}
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Calls parent function in wp-includes/class-wp-walker.php
		 */
		function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

			if ( ! $element ) {
				return;
			}

			//Add indicators for top level menu items with submenus
			$id_field = $this->db_fields['id'];

			if ( ! empty( $children_elements[ $element->$id_field ] ) ) {
				$this->dt_menu_parents[] = $element->$id_field;
			}

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$this->dt_is_first = true;

			$output .= '<ul class="' . esc_attr( $args['submenu_class'] ) . '">';
		}

		function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
			if ( $depth ) {
				$indent = str_repeat( "\t", $depth );
			} else {
				$indent = '';
			}

			$css_class = array( 'menu-item', 'page_item', 'page-item-' . $page->ID );

			if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
				$css_class[] = 'page_item_has_children';
			}

			if ( ! empty( $current_page ) ) {
				$_current_page = get_post( $current_page );
				if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
					$css_class[] = 'current_page_ancestor';
				}
				if ( $page->ID == $current_page ) {
					$css_class[] = 'current_page_item';
					$css_class[] = 'act';
				} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
					$css_class[] = 'current_page_parent';
				}
			} elseif ( $page->ID == get_option('page_for_posts') ) {
				$css_class[] = 'current_page_parent';
			}

			if ( $this->dt_is_first ) {
				$css_class[] = 'first';
			}

			$dt_is_parent = in_array( $page->ID, $this->dt_menu_parents );

			// add parent class
			if ( $dt_is_parent ) {
				$css_class[] = 'has-children';
			}

			$atts = array();
			$atts['href'] = get_permalink( $page->ID );

			// nonclicable parent menu items
			if ( $dt_is_parent && ! $args['parent_is_clickable'] ) {
				$atts['class'] = 'not-clickable-item';
			}

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$attributes .= " {$attr}='{$value}'";
				}
			}

			$css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

			if ( '' === $page->post_title ) {
				/* translators: %d: ID of a post */
				$page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
			}

			$args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
			$args['link_after'] = empty( $args['link_after'] ) ? '' : $args['link_after'];

			$output .= $indent . sprintf(
				'<li class="%s"><a %s>%s%s%s</a>',
				$css_classes,
				$attributes,
				$args['link_before'],
				'<span class="menu-item-text"><span class="menu-text">' . apply_filters( 'the_title', $page->post_title, $page->ID ) . '</span></span>',
				$args['link_after']
			);

			if ( ! empty( $args['show_date'] ) ) {
				if ( 'modified' == $args['show_date'] ) {
					$time = $page->post_modified;
				} else {
					$time = $page->post_date;
				}

				$date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
				$output .= " " . mysql2date( $date_format, $time );
			}
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= '</ul>';
		}

		function end_el( &$output, $page, $depth = 0, $args = array() ) {
			$this->dt_is_first = false;

			$output .= '</li>';
		}

	}

endif;
