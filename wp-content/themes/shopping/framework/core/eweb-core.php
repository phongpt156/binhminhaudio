<?php

/*-----------------------------------------------------------------------------------*/
/*  Core features for all themes
/*  @package eweb
/*  @version 1.0 - 2014/21/05
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/

/*  @since 1.0.4
/*-----------------------------------------------------------------------------------*/
function eweb_html5shiv() { ?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/framework/core/js/html5.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/framework/core/js/css3-mediaqueries.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if lte IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/framework/core/css/ie.css" />
	<![endif]-->
<?php }
add_action('wp_head', 'eweb_html5shiv');

/**
 * Option Tree integration
 */

 /**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree Framework.
 */
load_template( trailingslashit( get_template_directory() ) . '/framework/theme_options/option-tree/ot-loader.php' );

/*-----------------------------------------------------------------------------------*/
/*  Clean WordPress header
/*-----------------------------------------------------------------------------------*/
	function clean_header() {
	    remove_action('wp_head', 'wp_generator'); // Remove wp_generator
		remove_action('wp_head', 'rsd_link'); // Remove Really simple discovery link
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head, 10, 0'); 
		
		remove_action('wp_head', 'print_emoji_detection_script', 7); // Remove emoji
	    remove_action('wp_print_styles', 'print_emoji_styles'); // Remove emoji
		add_filter('style_loader_src', 'ew_remove_ver_css_js', 9999); // Remove WP Version From Styles
		add_filter('script_loader_src', 'ew_remove_ver_css_js', 9999); // Remove WP Version From Scripts
		// Function to remove version numbers
		function ew_remove_ver_css_js($src) {
			if (strpos($src, 'ver='))
				$src = remove_query_arg('ver', $src);
			return $src;
		}
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	}
	add_action( 'after_setup_theme', 'clean_header' );

/*-----------------------------------------------------------------------------------*/
/*  When active theme then redirect to theme options
/*-----------------------------------------------------------------------------------*/
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
{
    wp_redirect( admin_url( 'admin.php?page=ot-theme-options' ) );
    exit;
}

/*-----------------------------------------------------------------------------------*/
/*  Display navigation to next/previous post when applicable.
/*-----------------------------------------------------------------------------------*/
/*if ( ! function_exists( 'eweb_post_nav' ) ) :
	function eweb_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<div class="simple-navigation">
			<?php if( get_previous_post(true)!='' or get_next_post(true)!='' ): ?>
				<div class="row">
					<?php if( get_previous_post(true) ): ?>
						<?php if(get_next_post(true)!=''){ ?>
						<div class="col-md-6 col-sm-6 col-xs-6 simple-navigation-item pull-left">
						<?php }else{ ?>
						<div class="col-md-6 col-sm-6 col-xs-6 simple-navigation-item pull-left">
						<?php } ?>
							<i class="fa fa-angle-left pull-left"></i>
							<div class="simple-navigation-item-content">
								<?php previous_post_link('%link','Bài cũ hơn',true); ?>
								<h5><?php previous_post_link('%link','%title',true); ?></h5>
							</div>
						</div><!--End-col-->
					<?php endif; ?>
					<?php if( get_next_post(true)): ?>
						<div class="col-md-6 col-sm-6 col-xs-6 simple-navigation-item pull-right">
							<i class="fa fa-angle-right pull-right"></i>
							<div class="simple-navigation-item-content">
								<?php next_post_link('%link','Bài mới hơn',true); ?>
								<h5><?php next_post_link('%link','%title',true); ?></h5>
							</div>
						</div><!--End-col-->
					<?php endif; ?>
				</div><!--End-row-->
			<?php endif; ?>
		</div><!--End-simple-navigation-->
		<?php
	}
endif;*/

/*-----------------------------------------------------------------------------------*/
/*  Display navigation to next/previous post_type when applicable.
/*-----------------------------------------------------------------------------------*/
/*if(!function_exists('eweb_post_nav_post_type')) :
	function eweb_post_nav_post_type(){
		global $post;
		// get_posts in same custom taxonomy
		$postlist_args = array(
		   'posts_per_page'  => -1,
		   'orderby'         => 'menu_order title',
		   'order'           => 'ASC',
		   'post_type'       => 'news',
		   'your_custom_taxonomy' => 'categories'
		);
		$postlist = get_posts( $postlist_args );

		// get ids of posts retrieved from get_posts
		$ids = array();
		foreach ($postlist as $thepost) {
		   $ids[] = $thepost->ID;
		}

		// get and echo previous and next post in the same taxonomy
		$thisindex = array_search($post->ID, $ids);
		$previd = $ids[$thisindex-1];
		$nextid = $ids[$thisindex+1];
		if ( !empty($previd) ) {?>
			<span class="nav-previous">
				<a href="<?php echo get_permalink($previd);?>" rel="prev">
					<span class="meta-nav">
						<i class="glyphicon glyphicon-chevron-left"></i>
					</span>
					<?php echo get_the_title($previd); ?>
				</a>
			</span>
		<?php }
		if ( !empty($nextid) ) {?>
			<span class="nav-next">
				<a href="<?php echo get_permalink($nextid);?>" rel="next">
					<?php echo get_the_title($nextid); ?>
					<span class="meta-nav">
						<i class="glyphicon glyphicon-chevron-right"></i>
					</span>
				</a>
			</span>
		<?php }
	}
endif;*/

/*-----------------------------------------------------------------------------------*/
/*  Enable oEmbed in Text/HTML Widgets
/*-----------------------------------------------------------------------------------*/
	add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
	add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );
	// remove 3 kích thước ảnh
	function eweb_filter_image_sizes( $sizes) {
		unset( $sizes['thumbnail']);
		unset( $sizes['medium']);
		unset( $sizes['large']);
		return $sizes;
	}
	add_filter('intermediate_image_sizes_advanced', 'eweb_filter_image_sizes');
	// Loại bỏ meta generator
	remove_action('wp_head', 'wp_generator');
	//Cho phép shortcode trong text widgets
	add_filter( 'widget_text', 'do_shortcode' );
	// Add Feature Image
	add_theme_support( 'post-thumbnails' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	// Enable support for Post Formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

/*-----------------------------------------------------------------------------------*/
/*  Truncate title
/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'eweb_truncate_title' ) ){
		function eweb_truncate_title($amount,$echo='',$post_id='') {
			if(!empty($post_id)){
				$content_post = get_post($post_id);
				$truncate = $content_post->post_title;
			}else{
				global $post;
				$truncate = $post->post_title;
			}

			$truncate = preg_replace('@\[caption[^\]]*?\].*?\[\/caption]@si', '', $truncate);

			if(!empty($amount))
				$amount = $amount;
			else
				$amount = 30;

			if ( strlen($truncate) <= $amount )
				$echo_out = '';
			else
				$echo_out = '...';

			$truncate = apply_filters('the_title', $truncate);
			$truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
			$truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);

			$truncate = strip_tags($truncate);

			if ($echo_out == '...')
				$truncate = mb_substr($truncate, 0, strrpos(mb_substr($truncate, 0, $amount), ' '));
			else
				$truncate = mb_substr($truncate, 0, $amount);

			if (!empty($echo))
				return $truncate . $echo;
			else
				return $truncate . $echo_out;
		}
	}

/*-----------------------------------------------------------------------------------*/
/*  Truncate description
/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'eweb_truncate_description' ) ){
		function eweb_truncate_description($amount,$echo='',$post_id='') {
			if(!empty($post_id)){
				$content_post = get_post($post_id);
				$truncate = $content_post->post_content;
			}else{
				global $post;
				$truncate = $post->post_content;
			}
			$truncate = preg_replace('@\[caption[^\]]*?\].*?\[\/caption]@si', '', $truncate);

			if(!empty($amount))
				$amount = $amount;
			else
				$amount = 100;

			if ( strlen($truncate) <= $amount )
				$echo_out = '';
			else
				$echo_out = '...';

			$truncate = apply_filters('the_content', $truncate);
			$truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
			$truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);

			$truncate = strip_tags($truncate);

			if ($echo_out == '...')
				$truncate = mb_substr($truncate, 0, strrpos(mb_substr($truncate, 0, $amount), ' '));
			else
				$truncate = mb_substr($truncate, 0, $amount);

			if (!empty($echo))
				return $truncate . $echo;
			else
				return $truncate . $echo_out;
		}
	}
/*if ( ! function_exists( 'eweb_truncate_description' ) ){
	function eweb_truncate_description($number) {
    	$content = get_the_content();
		$getlength = strlen($content);
		$thelength = $number;
    	return mb_substr($content, 0, $thelength).'...';
	}
}*/

/*-----------------------------------------------------------------------------------*/
/*  Get post view
/*-----------------------------------------------------------------------------------*/
/*if ( ! function_exists( 'eweb_getPostViews' ) ){
	function eweb_getPostViews($postID){ // hàm này dùng để lấy số người đã xem qua bài viết
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){ // Nếu như lượt xem không có
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return "0"; // giá trị trả về bằng 0
	    }
	    return $count; // Trả về giá trị lượt xem
	}
}*/

/*-----------------------------------------------------------------------------------*/
/*  Set post view
/*-----------------------------------------------------------------------------------*/
/*if ( ! function_exists( 'eweb_setPostViews' ) ){
	function eweb_setPostViews($postID) {// hàm này dùng để set và update số lượt người xem bài viết.
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }else{
	        $count++; // cộng dồn view
	        update_post_meta($postID, $count_key, $count); // update count
	    }
	}
}*/

/*-----------------------------------------------------------------------------------*/
/*  Info post
/*-----------------------------------------------------------------------------------*/
/*if ( ! function_exists( 'eweb_posted_on_single' ) ){
	function eweb_posted_on_single() {
		global $post;
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}else{
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		//$categories_list = get_the_category_list( __( ', ', 'eweb' ) );
		//if ( $categories_list ) :
		//printf( __( ' in %1$s', 'eweb' ), $categories_list );
		//endif;

		$term_list = wp_get_post_terms($post->ID, 'categories', array("fields" => "all"));
		if ( $term_list ) :
			foreach($term_list as $term){
				__('This entry was posted in <a title="'.$term->name.'" href="/categories/'.$term->slug.'">'.$term->name.'</a>','eweb');
			}
		endif;
		printf(
			__( '<span class="posted-on"> on %1$s</span>
				<span class="byline"> by %2$s </span>
				', 'eweb' ),
			sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( get_permalink() ),
				$time_string
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
	}
}*/
/*$allowed_hosts = array('bantheme.com');
if (!isset($_SERVER['HTTP_HOST']) || !in_array($_SERVER['HTTP_HOST'], $allowed_hosts)) {
	$newURL = 'http://e-web.vn';
	header('Location: '.$newURL);
    //header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
    exit;
}*/
/*-----------------------------------------------------------------------------------*/
/*  Phân trang
/*-----------------------------------------------------------------------------------*/
/*if(!function_exists( 'eweb_pagination') ){
    function eweb_pagination($pages = '', $range = 2){
         $showitems = ($range * 2)+1;

         global $paged;
         if(empty($paged)) $paged = 1;

         if($pages == '')
         {
             global $wp_query;
             $pages = $wp_query->max_num_pages;
             if(!$pages)
             {
                 $pages = 1;
             }
         }

         if(1 != $pages)
         {
             echo "<div class='pagination'>";
             if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
             if($paged > 0 && $showitems < $pages) echo "<a class='firstpag' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

             for ($i=1; $i <= $pages; $i++)
             {
                 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                 {
                     echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
                 }
             }

             if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
             if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='lastpag' href='".get_pagenum_link($pages)."'>&raquo;</a>";
             echo "</div>\n";
         }
    }
}*/


/*-----------------------------------------------------------------------------------*/
/*  Customize admin footer text
/*-----------------------------------------------------------------------------------*/
function eweb_custom_admin_footer() {
	echo '<a href="http://legiaz.vn" title="Tăng doanh số bằng Website chuyên nghiệp" target="_blank">Thiết kế Website legiaz.vn</a>';
}
add_filter('admin_footer_text', 'eweb_custom_admin_footer');

/*-----------------------------------------------------------------------------------*/
/*  CUSTOM ADMIN LOGIN HEADER LINK & ALT TEXT
/*-----------------------------------------------------------------------------------*/
function eweb_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'eweb_login_logo_url' );

function eweb_login_logo_url_title() {
	return '';
}
add_filter( 'login_headertitle', 'eweb_login_logo_url_title' );

/*-----------------------------------------------------------------------------------*/
/*  CUSTOM ADMIN LOGIN HEADER LOGO
/*-----------------------------------------------------------------------------------*/
function eweb_custom_login_logo() { ?>
    <style type="text/css">
		body.login {background: #fbfbfb url('<?php echo get_bloginfo( 'template_directory' ) ?>/framework/images/bg-admin.png') no-repeat fixed center}
		.login h1 a {background-image: url('<?php echo get_bloginfo( 'template_directory' ) ?>/framework/images/logo.png')!important}
		.message.register{display: none}
		.login form {border: 1px solid rgba(0,0,0,.2);-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;background: rgba(255, 255, 255, 0.5)!important}
		.login label {color: #fff!important}
		.login form .input,
		.login input[type="text"] { font-size: 13pt!important}
		input#rememberme {height: 18px;width: 18px;display: inline;vertical-align: middle;margin: 2px 5px 0 0;float: left}
		body.login div#login p#backtoblog {display:inline}
		body.login div#login p#backtoblog a {float:right;display:inline}
		div.updated,.login .message {background-color: lightYellow;border-color: #E6DB55;font-family: 'Open Sans Condensed', sans-serif;font-size: 16px;font-weight: 700}
		body.login div#login form#loginform input#user_pass,
		body.login div#login form#loginform input#user_login {font-size: 12px}
    </style>
<?php }
add_action('login_enqueue_scripts', 'eweb_custom_login_logo');