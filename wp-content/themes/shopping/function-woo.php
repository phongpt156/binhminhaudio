<?php
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}

	add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
	function woo_new_product_tab( $tabs = array() ) {
	    // Adds the new tab
	    $tabs['thong_so'] = array(
	        'title'     => __( 'Thông số kĩ thuật', 'woocommerce' ),
	        'priority'  => 50,
	        'callback'  => 'woo_new_product_tab_content'
	    );
	    return $tabs;
	}
	function woo_new_product_tab_content()  {
	    // The new tab content
	    /*$prod_id = get_the_ID();
	    echo get_post_meta($prod_id,'additional information',true);*/
	    the_excerpt();
	}
	add_filter( 'woocommerce_product_tabs', 'ew_woo_move_description_tab', 98);
	function ew_woo_move_description_tab($tabs) {
	    $tabs['thong_so']['priority'] = 15;
	    return $tabs;
	}

/**
 * Change on single product panel "Product Description"
 * since it already says "features" on tab.
 */
	add_filter('woocommerce_product_description_heading','eweb_product_description_heading');

	function eweb_product_description_heading() {
	    return __('', 'woocommerce');
	}

/*-----------------------------------------------------------------------------------*/
/*  Woocommerce remove field checkout
/*-----------------------------------------------------------------------------------*/
    add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
    function custom_override_checkout_fields( $fields ) {
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_country']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['billing']['billing_state']);
        unset($fields['billing']['billing_city']);
        $fields['billing']['billing_email']['required'] = false;
        $fields['billing']['billing_first_name']['label'] = "Họ";
        $fields['billing']['billing_address_1']['label'] = false;
        //unset($fields['billing']['billing_city']);
        return $fields;
    }

/*-----------------------------------------------------------------------------------*/
/*  Woocommerce remove required field
/*-----------------------------------------------------------------------------------*/
    /*add_filter( 'woocommerce_checkout_fields' , 'customize_fields' );
    function customize_fields( $fields ) {
        $fields['billing']['billing_email']['required'] = false;
        $fields['billing']['billing_first_name']['label'] = "Họ";
        $fields['billing']['billing_address_1']['label'] = false;
        return $fields;
    }*/

/*-----------------------------------------------------------------------------------*/
/*  Countdown
/*-----------------------------------------------------------------------------------*/
    add_action('wp_head', 'pluginname_ajaxurl');
    function pluginname_ajaxurl() {
        ?>
        <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
        </script>
        <?php
    }

    function set_countdown($post_id){
        global $product;

        $countdown = get_post_meta($post_id, 'countdown', true);

        $c_date = get_post_meta($post_id, 'count_date', true);
        $c_date_a = explode("-", $c_date);
        $c_date_b = $c_date_a[1] . "/" . $c_date_a[2] . "/" . $c_date_a[0];

        $c_hour = get_post_meta($post_id, 'count_hour', true);
        $c_min = get_post_meta($post_id, 'count_min', true);
        $c_sec = get_post_meta($post_id, 'count_sec', true);

        $timezone = get_option('gmt_offset');
        $offset = $timezone > 0 ? '+' . $timezone : $timezone;

        $currenttime = strtotime(current_time("Y-m-d H:i:s"));
        $targettime = strtotime(date($c_date . " " . $c_hour . ':' . $c_min . ':' . $c_sec));
        $diff = $targettime - $currenttime;

        if ($product->sale_price && ('on' == $countdown) && ( $diff > 0)) {
            ?>
            <script>
                jQuery(function () {
                    jQuery('.xid-<?php echo $post_id; ?>').downCount({
                        date: '<?php echo $c_date_b . ' ' . $c_hour . ':' . $c_min . ':' . $c_sec; ?>',
                        offset: <?php echo $offset; ?>
                    }, function(){
                        jQuery("#productcountdown").hide( 10 );
                        jQuery.ajax({
                            url: ajaxurl,
                            dataType: 'json',
                            data : { action : "remove_sales", post_id : "<?php echo $post_id; ?>", regular_price : "<?php echo $product->regular_price; ?>"},
                            success: function(data){
                                if (data.error) {
                                    alert(data.error);
                                } else{
                                    location.reload();
                                }
                            }
                        });
                    });
                });

            </script>
            <div id="productcountdown">
                <ul class="productcountdown xid-<?php echo $post_id; ?>">
                    <li>
                        <span class="days">00</span>
                        <p class="days_ref">ngày</p>
                    </li>
                    <li>
                        <span class="hours">00</span>
                        <p class="hours_ref">giờ</p>
                    </li>
                    <li>
                        <span class="minutes">00</span>
                        <p class="minutes_ref">phút</p>
                    </li>
                    <li>
                        <span class="seconds">00</span>
                        <p class="seconds_ref">giây</p>
                    </li>
                </ul>
            </div>
            <?php
        }
    }

    add_action('wp_ajax_remove_sales', 'ajax_remove_sales');

    function ajax_remove_sales() {
        header('Content-Type: application/json');
        if (!isset($_GET['post_id'])) {
            $re['error'] = __('post_id is not exist', 'wbt');
            echo json_encode($re);
            die();
        } else {
            $product = get_product($_GET['post_id']);

            update_post_meta($product->id, '_regular_price', $_GET['regular_price']);
            update_post_meta($product->id, '_sale_price', '');
            update_post_meta($product->id, '_price', $_GET['regular_price']);

            $re['text'] = "success";

            echo json_encode($re);
            die();
        }
    }

/**
 * This function updates the Top Navigation WooCommerce cart link contents when an item is added via AJAX.
 */
    add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
    function woocommerce_header_add_to_cart_fragment( $fragments ) {
        ob_start();?>
            <a href="<?php echo esc_url( WC()->cart->get_cart_url() );?>" title="Giỏ hàng của bạn">
                <i class="fa fa-opencart"></i>&nbsp;
                Giỏ hàng [ <b><span id="count_shopping_cart"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ) );?> sản phẩm</span></b> ]
            </a>
        <?php
        $fragments['div.link-cart a'] = ob_get_clean();
        return $fragments;
    }

/*
* replace read more buttons for out of stock items
**/
if (!function_exists('woocommerce_template_loop_add_to_cart')) {
    function woocommerce_template_loop_add_to_cart() {
        global $product;
        if (!$product->is_in_stock()) {
            echo '<a href="'.get_permalink().'" rel="nofollow" class="outstock_button">Out of Stock</a>';
        }
        else
        {
            woocommerce_get_template('loop/add-to-cart.php');
        }
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Optimize WooCommerce Scripts
/*  Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
/*-----------------------------------------------------------------------------------*/
    add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
     
    function child_manage_woocommerce_styles() {
        //remove generator meta tag
        remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
     
        //first check that woo exists to prevent fatal errors
        if ( function_exists( 'is_woocommerce' ) ) {
            //dequeue scripts and styles
            if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
                wp_dequeue_style( 'woocommerce_frontend_styles' );
                wp_dequeue_style( 'woocommerce_fancybox_styles' );
                wp_dequeue_style( 'woocommerce_chosen_styles' );
                wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
                wp_dequeue_script( 'wc_price_slider' );
                wp_dequeue_script( 'wc-single-product' );
                wp_dequeue_script( 'wc-add-to-cart' );
                wp_dequeue_script( 'wc-cart-fragments' );
                wp_dequeue_script( 'wc-checkout' );
                wp_dequeue_script( 'wc-add-to-cart-variation' );
                wp_dequeue_script( 'wc-single-product' );
                wp_dequeue_script( 'wc-cart' );
                wp_dequeue_script( 'wc-chosen' );
                //wp_dequeue_script( 'woocommerce' );
                wp_dequeue_script( 'prettyPhoto' );
                wp_dequeue_script( 'prettyPhoto-init' );
                wp_dequeue_script( 'jquery-blockui' );
                wp_dequeue_script( 'jquery-placeholder' );
                wp_dequeue_script( 'fancybox' );
                wp_dequeue_script( 'jqueryui' );
            }
        }
    }

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

    add_filter ( 'woocommerce_product_thumbnails_columns', 'ew_thumb_cols' );
    function ew_thumb_cols() {
        return 5; // .last class applied to every 4th thumbnail
    }

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
    $args['posts_per_page'] = 4; // 4 related products
    return $args;
}