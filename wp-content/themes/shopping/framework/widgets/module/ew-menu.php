<?php
if( !class_exists('eweb_menu_widget') ){
    add_action('widgets_init', 'menu_widget');
    function menu_widget() {
        register_widget('eweb_menu_widget');
    }

    class eweb_menu_widget extends WP_Widget {

        function eweb_menu_widget(){
            $widget_ops = array(
              'classname' => 'ads',
              'description' => 'Menu - Sidebar'
            );
            parent::__construct('menu_widget', __('EW: Menu', 'eweb'), $widget_ops);
        }

        function widget($args,  $instance) {
            extract($args);

            $title = apply_filters('widget_title', $instance['title']);
            /*$can_sub = $instance['can_sub'];
            if(!empty($can_sub)){
                $id_menu = 'mega-sidebar';
            }else{
                $id_menu = 'mega';
            }*/
            ?>
            <div class="widget menu-sp">
                <div class="dcjq-vertical-mega-menu">
                    <?php //echo $before_title;?>
                        <?php //echo $title;?>
                    <?php //echo $after_title;?>
                    <?php
                    $menu_id = 'mega';
                    $menu_class = 'menu';
                    wp_nav_menu( array(
                        'theme_location' => 'cate_menu',
                        'container' => false,
                        'menu_id' => $menu_id,
                        'menu_class' => $menu_class
                    ));
                    ?>
                </div>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery('#mega').dcVerticalMegaMenu();
                });
            </script>
        <?php }


        function form($instance) {
            $title = isset($instance['title']) ? esc_attr($instance['title']) : 'Danh mục sản phẩm';
            //$can_sub = isset($instance['can_sub']) ? esc_attr($instance['can_sub']) : '';
            ?>
            <p>
              <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title';?></label><br />
              <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" class="widefat" />
            </p>
            <!-- <p>
              <label for="<?php echo $this->get_field_id('can_sub'); ?>"><?php echo 'Căn submenu';?></label><br />
              <input type="text" name="<?php echo $this->get_field_name('can_sub'); ?>" id="<?php echo $this->get_field_id('can_sub'); ?>" value="<?php echo $can_sub; ?>" class="widefat" />
              <i>Để trống mặc định là bên phải. Muốn bên trái ghi 'left'</i>
            </p> -->
            <?php
        }

        function update($new_instance, $old_instance){
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            //$instance['can_sub'] = strip_tags($new_instance['can_sub']);
            return $instance;
        }
    }
}