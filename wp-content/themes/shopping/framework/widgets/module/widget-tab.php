<?php
add_action('widgets_init', 'ew_widget_tab');
function ew_widget_tab() {
        register_widget('ew_widget_tab');
}
class ew_widget_tab extends WP_Widget {
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
    function __construct() {
        $widget_ops = array(
            'classname' => 'ew_widget_tab',
            'description' => __('EW: Module Tab - Content Home', 'eweb')
        );
        parent::__construct('ew_widget_tab', __('EW: Module Tab - Content Home', 'eweb'), $widget_ops);
    }

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {
        extract($args);
        global $post;

        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        $hidden_sm = $instance['hidden_sm'];
        $hidden_xs = $instance['hidden_xs'];

        echo $before_widget;?>
            <section class="flw x8_product_module <?php if($hidden_sm == 'on') echo 'hidden-sm';?> <?php if($hidden_xs == 'on') echo 'hidden-xs';?>">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#smp"><i class="fa fa-heart-o"></i> Sản phẩm mới</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#spnb"><i class="fa fa-briefcase"></i> Sản phẩm nổi bật</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#spgg"><i class="fa fa-users"></i> Sản phẩm giảm giá</a>
                    </li>
                </ul>
                <div class="flw tab-content">
                    <div id="smp" class="tab-pane fade in active">
                        <div class="widget-odd list-product-tab">
                            <?php
                            $args = array(
                                'post_type'     => 'product',
                                'showposts'     => $number
                            );
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post();
                                get_template_part('template-parts/content');
                            endwhile;
                            wp_reset_query(); ?>
                         </div>
                    </div>
                    <div id="spnb" class="tab-pane fade">
                        <div class="widget-odd list-product-tab">
                            <?php
                            $args = array(
                                'post_type'     => 'product',
                                'meta_key'      => '_featured',
                                'meta_value'    => 'yes',
                                'showposts'     => $number
                            );
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post();
                                get_template_part('template-parts/content');
                            endwhile;
                            wp_reset_query(); ?>
                         </div>
                    </div>
                    <div id="spgg" class="tab-pane fade">
                        <div class="widget-odd list-product-tab">
                            <?php
                            $args = array(
                                'post_type'      => 'product',
                                'showposts'     => $number,
                                'order'          => 'ASC',
                                'paged'          => $paged,
                                'meta_query'     => array(
                                    array(
                                        'key'           => '_sale_price',
                                        'value'         => 0,
                                        'compare'       => '>',
                                        'type'          => 'numeric'
                                    )
                                )
                            );
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post();
                                get_template_part('template-parts/content');
                            endwhile;
                            wp_reset_query(); ?>
                         </div>
                    </div>
                </div>
            </section>
        <?php
        echo $after_widget;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        $instance['hidden_sm'] = $new_instance['hidden_sm'];
        $instance['hidden_xs'] = $new_instance['hidden_xs'];

		return $instance;
	}
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*-----------------------------------------------------------------------------------*/

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Module Tab Product';
        $number = isset($instance['number']) ? absint($instance['number']) : 8;
        $hidden_sm = $instance['hidden_sm'];
        $hidden_xs = $instance['hidden_xs'];
		?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label></br>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">Number Post</label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo $number; ?>" size="3" />
        </p>
        <p>
            <input name="<?php echo $this->get_field_name('hidden_sm'); ?>" type="checkbox" <?php if ($hidden_sm == 'on') echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('hidden_sm'); ?>">Hidden on Table</label>
        </p>
        <p>
            <input name="<?php echo $this->get_field_name('hidden_xs'); ?>" type="checkbox" <?php if ($hidden_xs == 'on') echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('hidden_xs'); ?>">Hidden on Mobile</label>
        </p>
		<?php
	}
}