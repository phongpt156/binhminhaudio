<?php
add_action('widgets_init', 'ew_new_post_footer');
function ew_new_post_footer() {
        register_widget('ew_new_post_footer');
}
class ew_new_post_footer extends WP_Widget {
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
    function __construct() {
        $widget_ops = array(
            'classname' => 'block-new-post',
            'description' => __('Bài viết mới nhất - Footer', 'eweb')
        );
        parent::__construct('ew_new_post_footer', __('EW: Bài viết mới nhất', 'eweb'), $widget_ops);
    }

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {
        extract($args);
        global $post;
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
		?>
		<?php echo $before_widget;?>
		<?php
        $args = array(
            'post_type' => 'post',
            'ignore_sticky_posts' => 0,
            'showposts'=> $number,
            /*'meta_query' => array(
                array(
                    'key' => 'is_feature_post',
                    'value' => 'feature_post',
                    'compare' => 'LIKE'
                )
            )*/
        );
        $vonglap = new WP_Query($args);?>
        <?php echo $before_title;?>
        <?php echo $title;?>
        <?php echo $after_title;?>
        <ul>
        <?php while($vonglap->have_posts()) : $vonglap->the_post();?>
            <li>
                <a class='text-666' href="<?php the_permalink();?>" title="<?php the_title();?>">
                    <?php the_title();?>
                </a>
            </li>
        <?php endwhile;wp_reset_query();?>
        </ul>
        <?php echo $after_widget;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];

		return $instance;
	}
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*-----------------------------------------------------------------------------------*/

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Baì viết mới nhất';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title</label></br>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('number'); ?>">Number Post</label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}
?>