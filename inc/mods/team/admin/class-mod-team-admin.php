<?php
/**
 * Team admin part.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Team_Admin {

	public function register_post_types() {
		$post_type = 'dt_team';
		$args = array(
			'labels'                => array(
				'name'                  => _x('Team',							'backend team', 'the7mk2'),
				'singular_name'         => _x('Teammate',						'backend team', 'the7mk2'),
				'add_new'               => _x('Add New',						'backend team', 'the7mk2'),
				'add_new_item'          => _x('Add New Teammate',				'backend team', 'the7mk2'),
				'edit_item'             => _x('Edit Teammate',					'backend team', 'the7mk2'),
				'new_item'              => _x('New Teammate',					'backend team', 'the7mk2'),
				'view_item'             => _x('View Teammate',					'backend team', 'the7mk2'),
				'search_items'          => _x('Search Teammates',				'backend team', 'the7mk2'),
				'not_found'             => _x('No teammates found',				'backend team', 'the7mk2'),
				'not_found_in_trash'    => _x('No Teammates found in Trash',	'backend team', 'the7mk2'), 
				'parent_item_colon'     => '',
				'menu_name'             => _x('Team',							'backend team', 'the7mk2')
			),
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true, 
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'dt_team' ),
			'capability_type'       => 'post',
			'has_archive'           => true, 
			'hierarchical'          => false,
			'menu_position'         => 37,
			'supports'              => array( 'title', 'editor', 'comments', 'excerpt', 'thumbnail' )
		);

		$args = apply_filters( "presscore_post_type_{$post_type}_args", $args );

		register_post_type( $post_type, $args );
	}

	public function register_taxonomies() {
		$post_type = 'dt_team';
		$taxonomy = 'dt_team_category';
		$args = array(
			'labels'                => array(
				'name'              => _x( 'Team Categories',			'backend team', 'the7mk2' ),
				'singular_name'     => _x( 'Team Category',				'backend team', 'the7mk2' ),
				'search_items'      => _x( 'Search in Team Category',	'backend team', 'the7mk2' ),
				'all_items'         => _x( 'Team Categories',			'backend team', 'the7mk2' ),
				'parent_item'       => _x( 'Parent Team Category',		'backend team', 'the7mk2' ),
				'parent_item_colon' => _x( 'Parent Team Category:',		'backend team', 'the7mk2' ),
				'edit_item'         => _x( 'Edit Team Category',		'backend team', 'the7mk2' ), 
				'update_item'       => _x( 'Update Team Category',		'backend team', 'the7mk2' ),
				'add_new_item'      => _x( 'Add New Team Category',		'backend team', 'the7mk2' ),
				'new_item_name'     => _x( 'New Team Category Name',	'backend team', 'the7mk2' ),
				'menu_name'         => _x( 'Team Categories',			'backend team', 'the7mk2' )
			),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'rewrite'               => true,
			'show_admin_column'		=> true,
		);

		$args = apply_filters( "presscore_taxonomy_{$taxonomy}_args", $args );

		register_taxonomy( $taxonomy, array( $post_type ), $args );
	}

	public function add_meta_boxes( $metaboxes ) {
		$metaboxes[] = plugin_dir_path( __FILE__ ) . 'metaboxes/metaboxes-team.php';
		return $metaboxes;
	}

	public function add_basic_meta_boxes_support( $pages ) {
		$pages[] = 'dt_team';
		return $pages;
	}
}
