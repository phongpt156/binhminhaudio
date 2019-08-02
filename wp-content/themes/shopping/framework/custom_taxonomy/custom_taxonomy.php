<?php
add_action( 'init', 'create_news_taxonomies', 0 );

function create_news_taxonomies() {

	// Danh mục sản phẩm
	$labels = array(
		'name'              => __( 'Danh mục sản phẩm' ),
		'singular_name'     => __( 'Categories' ),
		'search_items'      => __( 'Search' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category :' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Danh mục sản phẩm' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'danh-muc-san-pham' ),
	);

	register_taxonomy( 'danh-muc-san-pham', array('san-pham'), $args );

	flush_rewrite_rules();
}
?>