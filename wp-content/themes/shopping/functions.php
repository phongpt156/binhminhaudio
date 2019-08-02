<?php
/**
 * Legiaz functions and definitions
 *
 */

/*-----------------------------------------------------------------------------------*/
/*  Make theme available for translation.
/*  Translations can be filed in the /languages/ directory.
/*  If you're building a theme based on eweb, use a find and replace
/*  to change 'eweb' to the name of your theme in all the template files
/*-----------------------------------------------------------------------------------*/
    load_theme_textdomain( 'eweb', get_template_directory() . '/languages' );

/*-----------------------------------------------------------------------------------*/
/*  Core Features
/*-----------------------------------------------------------------------------------*/
    require get_template_directory() . '/framework/core/eweb-core.php';

/*-----------------------------------------------------------------------------------*/
/*  Register Widget
/*-----------------------------------------------------------------------------------*/
    include(TEMPLATEPATH . '/framework/widgets/create_widget.php');
    include(TEMPLATEPATH . '/framework/widgets/create_area_widget.php');

/*-----------------------------------------------------------------------------------*/
/*  Create metadata
/*-----------------------------------------------------------------------------------*/
    include (TEMPLATEPATH . '/framework/custom_field/metadata.php' );

/*-----------------------------------------------------------------------------------*/
/*  Theme Option
/*-----------------------------------------------------------------------------------*/
    include (TEMPLATEPATH . '/framework/modules/theme-options.php' );

/* ----------------------------------------------------------------------------------- */
/*  Function Woocommerce
/*----------------------------------------------------------------------------------- */
    include get_template_directory() . '/function-woo.php';

/* ----------------------------------------------------------------------------------- */
/*  Tgm Plugin Activation
/*----------------------------------------------------------------------------------- */
    include get_template_directory() . '/framework/modules/class-tgm-plugin-activation.php';
    include get_template_directory() . '/framework/modules/activation.php';

/*-----------------------------------------------------------------------------------*/
/*  Register Menu
/*-----------------------------------------------------------------------------------*/
    register_nav_menus( array(
        'main_menu' => __( 'Menu chính', 'eweb' ),
        'footer_menu' => __( 'Menu chân trang', 'eweb' ),
        'second_menu' => __( 'Menu phụ', 'eweb' ),
        'cate_menu' => __( 'Menu danh mục', 'eweb' ),
        'mobile_menu' => __( 'Menu Mobile', 'eweb' ),
		'home_menu' => __( 'Menu Home', 'eweb' )
    ) );

/*-----------------------------------------------------------------------------------*/
/*  Adding Default Thumbnail Sizes
/*-----------------------------------------------------------------------------------*/
    if( function_exists( 'add_theme_support' ) ){
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'thumb_252x182', 252, 182, true);
        add_image_size( 'thumb_230x140', 230, 140, true);
    }

/*-----------------------------------------------------------------------------------*/
/*  Load Required CSS Styles
/*-----------------------------------------------------------------------------------*/
    if(!function_exists('load_theme_styles')){
        function load_theme_styles(){
            if (!is_admin()) {
                $stylesheet_url = get_template_directory_uri().'/css/';
                //wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', '', 'v3.3.4', false );
                //wp_enqueue_style( 'owl.carousel', $stylesheet_url . 'owl.carousel.min.css', '', 'v2.0.0', false );
                //wp_enqueue_style( 'owl.default', $stylesheet_url . 'owl.theme.default.min.css', '', 'v2.0.0', false );
                //wp_enqueue_style( 'animate', $stylesheet_url . 'animate.min.css', '', '', false );
                //wp_enqueue_style( 'font.awesome', get_template_directory_uri() .'/font-awesome/css/font-awesome.min.css', '', 'v4.3.0', false );
                //wp_enqueue_style( 'vertical.menu', $stylesheet_url . 'vertical-menu.css');
                wp_enqueue_style( 'style', get_stylesheet_uri() );
                wp_enqueue_style( 'google-font', 'http://fonts.googleapis.com/css?family=Roboto+Condensed:700,400&subset=latin,vietnamese');
            }
            // Royal Slider
            /*if(is_single()){
                wp_enqueue_style( 'royalslider-css', get_template_directory_uri() . '/royalslider/css/royalslider.css');
                wp_enqueue_style( 'rs-default', get_template_directory_uri() . '/royalslider/css/rs-default.css');
                //wp_enqueue_style( 'lightbox', $stylesheet_url.'lightbox.css', '', 'v2.7.1', false );
            }*/
        }
    }
    add_action( 'wp_enqueue_scripts', 'load_theme_styles' );

/*-----------------------------------------------------------------------------------*/
/*  Load Required JS Scripts
/*-----------------------------------------------------------------------------------*/
    if(!function_exists('load_theme_scripts')){
        function load_theme_scripts(){
            if (!is_admin()) {
                $java_script_url = get_template_directory_uri().'/js/';

                wp_enqueue_script('jquery');
                wp_enqueue_script('owl.carousel', $java_script_url . 'owl.carousel.min.js', array('jquery'), 'v2.0.0', true);
                wp_enqueue_script('dcverticalmegamenu', $java_script_url . 'jquery.dcverticalmegamenu.1.3.min.js', array('jquery'), 'v1.3', true);
                wp_enqueue_script('hoverIntent', $java_script_url . 'jquery.hoverIntent.minified.js', array('jquery'), '', true);
                wp_enqueue_script('countdown', $java_script_url . 'jquery.downCount.js', array('jquery'), '', true);
                wp_enqueue_script('bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), '', true);
                wp_enqueue_script('custom', $java_script_url . 'global.js', array('jquery'), '', true);

            }
        }
    }
    add_action('wp_enqueue_scripts', 'load_theme_scripts');

/*-----------------------------------------------------------------------------------*/
/*  Info Head
/*-----------------------------------------------------------------------------------*/
    add_action('wp_head', 'ew_info_head',1,1);
    function ew_info_head(){?>
        <?php
        $favicon = ot_get_option('favicon');
        if( !empty($favicon) ){?>
            <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
        <?php }?>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $app_id = ot_get_option('app_id_facebook');
        $user_facebook_id = ot_get_option('user_facebook_id');
        $link_fanpage = ot_get_option('link_fanpage');
        ?>
        <meta property="article:author" content="<?php echo $link_fanpage;?>" />
        <meta property="fb:app_id" content="<?php echo $app_id;?>"/>
        <meta property="fb:admins" content="<?php echo $user_facebook_id;?>"/>

    <?php }

/*-----------------------------------------------------------------------------------*/
/*  Info Footer
/*-----------------------------------------------------------------------------------*/
    add_action('wp_footer', 'ew_footer');
    function ew_footer(){
        $tracking_code = ot_get_option('tracking_code');
        if(!empty($tracking_code)){
            echo $tracking_code;
        }
    }

/*-----------------------------------------------------------------------------------*/
/*  Function Comment Facebook
/*-----------------------------------------------------------------------------------*/
    function ew_comment_fb(){
        $app_id = ot_get_option('app_id_facebook');
        if(!empty($app_id)){?>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=<?php echo $app_id;?>";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="box-comment">
                <!-- <div class="share-send">
                    <div class="fb-btn fb-send" data-href="<?php the_permalink(); ?>"></div>
                    <div class="fb-btn fb-like" data-href="<?php the_permalink(); ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                </div> -->
                <div class="fb-comments" data-href="<?php the_permalink();?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
            </div>
        <?php }
    }

/*-----------------------------------------------------------------------------------*/
/*  Chỉ có danh mục có post_type là post mới xuất hiện trên trang kết quả tìm kiếm
/*-----------------------------------------------------------------------------------*/
    if ( ! function_exists( 'eweb_search_filter' ) ){
        function eweb_search_filter($query) {
        if ( !$query->is_admin && $query->is_search) {
        $query->set('post_type', array('product') ); // id of page or post
        }
        return $query;
        }
        add_filter( 'pre_get_posts', 'eweb_search_filter' );
    }

/*-----------------------------------------------------------------------------------*/
/*  Add custom post type vào feed
/*-----------------------------------------------------------------------------------*/
    function myfeed_request($qv) {
        if (isset($qv['feed']) && !isset($qv['post_type']))
            $qv['post_type'] = array('product', 'product_cat');
        return $qv;
    }
    add_filter('request', 'myfeed_request');

/*-----------------------------------------------------------------------------------*/
/*  Cho phép title widget chạy shortcode
/*-----------------------------------------------------------------------------------*/
    add_filter( 'widget_title', 'do_shortcode' );

/*-----------------------------------------------------------------------------------*/
/*  Tạo shortcode gắn vào title widget
/*-----------------------------------------------------------------------------------*/
    add_shortcode( 'fa', 'so_shortcode_fa' );
    function so_shortcode_fa( $attr, $content ) {
        return '<i class="fa fa-'. $content . '"></i>';
    }



/*-----------------------------------------------------------------------------------*/
/*  thay doi nut mua ngay
/*-----------------------------------------------------------------------------------*/
add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text' );                                // < 2.1
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
  
function woo_custom_cart_button_text() {
  
        return __( 'Mua Ngay', 'woocommerce' );
  
}




/*-----------------------------------------------------------------------------------*/
/*  Add item to menu
/*-----------------------------------------------------------------------------------*/
    // add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);
    // function add_search_form($items, $args) {
    //     if( $args->theme_location == 'main_menu' )
    //     $items .= ' <li class="search">
    //                     <form role="search" method="get" id="searchform" action="'.home_url( '/' ).'">
    //                         <input type="text" value="" placeholder="search" name="s" id="s">
    //                         <input type="submit" id="searchsubmit">
    //                     </form>
    //                 </li>
    //             ';
    //     return $items;
    // }
    add_filter('wp_nav_menu_items', 'add_hl', 10, 2);
    function add_hl($items, $args) {
        $hotline = ot_get_option('hotline');
        if(!empty($hotline)){
            if( $args->theme_location == 'main_menu' ){
                $items .= ' <li class="pull-right gradient hotline_menu">
                                <span class="icon"><i class="fa fa-phone fa-2x" aria-hidden="true"></i></span>
                                <span class="text">'.ot_get_option('hotline').'</span>
                            </li>
                        ';
            }
        }
        return $items;
    }
    add_filter('wp_nav_menu_items', 'ew_add_li', 10, 2);
    function ew_add_li($items, $args) {
        if( $args->theme_location == 'mobile_menu' ){
            $items_close = '
                <li class="close-menu">
                    <a class="" href="#" title="Close">
                        <i class="fa fa-times-circle"></i>
                    </a>
                </li>
            ';
            $items = $items_close.$items;
        }
        return $items;
    }

add_filter('woocommerce_empty_price_html', 'custom_call_for_price');
 
function custom_call_for_price() {
return 'Liên hệ';
}
add_filter('wpdiscuz_profile_url', 'wpdiscuz_bp_profile_url', 10, 2);
function wpdiscuz_bp_profile_url($profile_url, $user) {
    if ($user && class_exists('BuddyPress')) {
        $profile_url = bp_core_get_user_domain($user->ID);
    }
    return $profile_url;
}
