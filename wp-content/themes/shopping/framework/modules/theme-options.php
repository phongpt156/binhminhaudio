<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => __( 'Cấu hình chung', 'ew' )
      ),
      array(
        'id'          => 'slider',
        'title'       => __( 'Slider', 'ew' )
      ),
      array(
        'id'          => 'footer',
        'title'       => __( 'Chân trang', 'ew' )
      ),
      array(
        'id'          => 'tab_chinh_sach',
        'title'       => __( 'Chi tiết sản phẩm', 'ew' )
      ),
      array(
        'id'          => 'doi_tac',
        'title'       => __( 'Đối tác', 'ew' )
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'logo',
        'label'       => __( 'Logo', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	        array(
        'id'          => 'header_top',
        'label'       => __( 'Header Banner', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_mobile',
        'label'       => __( 'Logo Mobile', 'ew' ),
        'desc'        => __( '<span style="color: red">(Note: Max-Width: 140px)</span>', 'ew' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'favicon',
        'label'       => __( 'Favicon', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'text_for_search',
        'label'       => __( 'Text for search', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'hotline',
        'label'       => __( 'Hotline', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'app_id_facebook',
        'label'       => __( 'App ID Facebook', 'ew' ),
        'desc'        => '<span style="color: red">(Guide: http://e-web.vn/cach-tao-mot-facebook-apps-va-lay-app-id-secret-key/)</span>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'user_facebook_id',
        'label'       => __( 'User Facebook ID', 'ew' ),
        'desc'        => '<span style="color: red">(Guide: http://e-web.vn/huong-dan-lay-user-facebook-id-ca-nhan-1-cach-chinh-xac-nhat/)</span>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'link_fanpage',
        'label'       => __( 'Link Fanpage', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tracking_code',
        'label'       => __( 'Tracking Code', 'ew' ),
        'desc'        => '<span style="color: red">(Note: Paste Google Analytics (or other) tracking code here.)</span>',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'hidden_slider',
        'label'       => __( 'Ẩn hiện Slider', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'slide_item',
        'label'       => __( 'Slide Item', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'upload_img',
            'label'       => __( 'Upload IMG', 'ew' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'link_slide_item',
            'label'       => __( 'Link Slide Item', 'ew' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'copyright',
        'label'       => __( 'Copyright', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'link_twitter',
        'label'       => __( 'Link Twitter', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'link_facebook',
        'label'       => __( 'Link Facebook', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'link_youtube',
        'label'       => __( 'Link Youtube', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'textblock_cs',
        'label'       => 'Chính sách',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'tab_chinh_sach',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'on_off_cs',
        'label'       => __( '', 'ew' ),
        'desc'        => '<span style="color: red">(Description: Bật/tắt chức năng)</span>',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'tab_chinh_sach',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'chinh_sach',
        'label'       => __( '', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'tab_chinh_sach',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'icon_policy',
            'label'       => __( 'Icon', 'ew' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'hotline_single',
        'label'       => __( 'Hotline', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'tab_chinh_sach',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'partner',
        'label'       => __( 'Đối tác', 'ew' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'doi_tac',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'logo_partner',
            'label'       => __( 'Logo đối tác', 'ew' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'link_partner',
            'label'       => __( 'Link đối tác', 'ew' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}