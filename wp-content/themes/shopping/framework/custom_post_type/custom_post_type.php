<?php
function codex_custom_init() {

	// Sản phẩm
	$labels = array(
		'name' => 'Sản phẩm',
		'singular_name' => 'All Posts',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Post',
		'edit_item' => 'Edit Post',
		'new_item' => 'New Post',
		'all_items' => 'All Post',
		'view_item' => 'View Post',
		'search_items' => 'Search Posts',
		'not_found' =>  'No posts found',
		'not_found_in_trash' => 'No posts found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Sản phẩm'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'san-pham' ),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		//'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-news.png',
		'menu_position' => 5,
		'supports' => array( 'title', 'editor', 'thumbnail'),
		'taxonomies' =>array('','post_tag')
	);
	register_post_type( 'san-pham', $args );

	// Video
	/*$labels = array(
		'name' => 'Video',
		'singular_name' => 'All Posts',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Post',
		'edit_item' => 'Edit Post',
		'new_item' => 'New Post',
		'all_items' => 'All Post',
		'view_item' => 'View Post',
		'search_items' => 'Search Posts',
		'not_found' =>  'No posts found',
		'not_found_in_trash' => 'No posts found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Video'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'video' ),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 7,
		'supports' => array( 'title'),
		'taxonomies' =>array('','post_tag')
	);
	register_post_type( 'video', $args );*/

	flush_rewrite_rules();
}
add_action( 'init', 'codex_custom_init' );?>