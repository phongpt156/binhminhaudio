<?php
function eweb_widgets_init() {
	// Content Home
	register_sidebar( array(
		'name' => __( 'Content Home', 'eweb' ),
		'id' => 'content-home',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="block-title"><h2 class="title-module">',
        'after_title' => '</h2></div>'
	));
		// Content Home
	register_sidebar( array(
		'name' => __( 'Menu', 'eweb' ),
		'id' => 'menu-home',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="block-title"><h2 class="title-module">',
        'after_title' => '</h2></div>'
	));
	// Sidebar
	register_sidebar( array(
		'name' => __( 'Sidebar', 'eweb' ),
		'id' => 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget block-sidebar %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="block-title"><h4 class="title-module">',
        'after_title' => '</h4></div><div class="flw wrapper-sb">'
	));
	// Bottom
	register_sidebar( array(
		'name' => __( 'Bottom', 'eweb' ),
		'id' => 'bottom',
		'before_widget' => '<div id="%1$s" class="widget block-sidebar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="block-title"><h5 class="title-module">',
        'after_title' => '</h5></div>'
	));
	// Footer Block 1
	register_sidebar( array(
		'name' => __( 'Footer Block 1', 'eweb' ),
		'id' => 'footer-block-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s box_footer">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="title">',
        'after_title' => '</h5>'
	));
	// Footer Block 2
	register_sidebar( array(
		'name' => __( 'Footer Block 2', 'eweb' ),
		'id' => 'footer-block-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s box_footer">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="title">',
        'after_title' => '</h5>'
	));
	// Footer Block 3
	register_sidebar( array(
		'name' => __( 'Footer Block 3', 'eweb' ),
		'id' => 'footer-block-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s box_footer">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="title">',
        'after_title' => '</h5>'
	));
	// Footer Block 4
	register_sidebar( array(
		'name' => __( 'Footer Block 4', 'eweb' ),
		'id' => 'footer-block-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s box_footer">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="title">',
        'after_title' => '</h5>'
	));
}
add_action( 'widgets_init', 'eweb_widgets_init' );
?>