<?php
if( !class_exists('eweb_image_widget') ){

    add_action('widgets_init', 'image_widget2');
    function image_widget2() {
        register_widget('eweb_image_widget');
    }

    class eweb_image_widget extends WP_Widget {

        function eweb_image_widget(){
            $widget_ops = array(
              'classname' => 'ads',
              'description' => 'Ảnh quảng cáo'
            );
            parent::__construct('image_widget2', __('EW: Ảnh quảng cáo', 'eweb'), $widget_ops);
            add_action('admin_enqueue_scripts', array($this, 'ew_assets'));
        }
        public function ew_assets() {
            wp_enqueue_media();
            wp_enqueue_script('script', get_template_directory_uri() . '/framework/widgets/module/js/script.js', '', '', true);
        }

        function widget($args,  $instance) {
            extract($args);

            $title      = $instance['title'];
            $link       = $instance['link'];
            $image      = $instance['image'];
            //echo $before_widget;
            ?>
            <a href="<?php echo $link;?>" title="<?php echo $title;?>">
                <img src="<?php echo $image;?>" alt="<?php echo $title;?>">
            </a>
            <?php //echo $after_widget; //End QC?>
        <?php }


        function form($instance) {
            $title        = isset($instance['title']) ? esc_attr($instance['title']) : 'Title';
            $link         = isset($instance['link']) ? $instance['link'] : '#';
            $image        = $instance[ 'image' ];
            $img_style    = ( !empty($image) ) ? 'style="max-width:100%; display: block"' : 'style="display:none"';
            $button_style = ( !empty($image) ) ? '' : 'style="display:none"';
            $no_img_style = ( !empty($image) ) ? 'style="display:none;"' : 'style="border: 1px solid #ddd; padding: 10px; text-align: center; border-radius: 2px; margin: 10px 0; display: block"';
            ?>
            <p>
                <label>Title</label>
                <input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label>Link</label>
                <input class="widefat" type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php echo $link; ?>" />
            </p>
            <p>
                <label>Image Preview: </label>
                <img id="<?php echo $this->get_field_id( 'image' ); ?>-preview" src="<?php echo esc_attr( $instance['image'] ); ?>" <?php echo $img_style; ?> />
                <span id="<?php echo $this->get_field_id( 'image' ); ?>-noimg" <?php echo $no_img_style; ?>>No image selected</span>
            </p>
            <p>
                <label>URL Image: </label>
                <input id="<?php echo $this->get_field_id( 'image' ); ?>-url" type="text" class="widefat" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>">
            </p>
            <p>
                <?php $button_text = ( $instance[ 'image' ] != '' ) ? 'Change Image' : 'Select Image'; ?>
                <input type="button" value="<?php echo $button_text; ?>" class="button custom_media_upload" id="<?php echo $this->get_field_id( 'image' ); ?>-button"/>
                <input type="button" value="Remove" class="button ew-media-remove" id="<?php echo $this->get_field_id( 'image' ); ?>-remove" <?php echo $button_style; ?> />
            </p>
            <?php
        }

        function update($new_instance, $old_instance){
            $instance = $old_instance;
            $instance['title']    = strip_tags($new_instance['title']);
            $instance['link']     = $new_instance['link'];
            $instance['image']    = $new_instance['image'];
            return $instance;
        }

    }
}