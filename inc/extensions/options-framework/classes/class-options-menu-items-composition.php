<?php
class Presscore_Options_Menu_Items_Composition {

	protected $menu_items;

	public function __construct() {
		$this->menu_items = array();
	}

	public function set( $slug, Presscore_Options_Menu_Item $item ) {
		$this->menu_items[ $slug ] = $item;
	}

	public function get( $slug ) {
		if ( $this->has( $slug ) ) {
			return $this->menu_items[ $slug ];
		}
		return false;
	}

	public function has( $slug ) {
		return array_key_exists( $slug, $this->menu_items );
	}

	public function delete( $slug ) {
		unset( $this->menu_items[ $slug ] );
	}

	public function get_all() {
		return $this->menu_items;
	}

	public function pluck( $field, $index_key = null ) {
		$newlist = array();

		if ( ! $index_key ) {
			foreach ( $this->menu_items as $slug => $menu_item ) {
				$newlist[ $slug ] = $menu_item->get( $field );
			}
			return $newlist;
		}

		foreach ( $this->menu_items as $menu_item ) {
			$_index_key = $menu_item->get( $index_key );
			if ( ! empty( $_index_key ) ) {
				$newlist[ $_index_key ] = $menu_item->get( $field );
			} else {
				$newlist[] = $menu_item->get( $field );
			}
		}

		return $newlist;
	}

	public static function create_from_array( $menu_items ) {
		$items_comp = new self;
		foreach ( $menu_items as $slug=>$menu_item ) {
			$menu_item['slug'] = $slug;
			$items_comp->set( $slug, self::create_menu_item( $menu_item ) );
		}

		return $items_comp;
	}

	public static function create_menu_item( $args = array() ) {
		return new Presscore_Options_Menu_Item( $args );
	}
}
