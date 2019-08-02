<?php
add_action('widgets_init', 'ew_new_post');
function ew_new_post() {
        register_widget('ew_new_post');
}
class ew_new_post extends WP_Widget {
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
    function __construct() {
        $widget_ops = array(
            'classname' => 'list-news-sidebar',
            'description' => __('Bài viết mới nhất - Sidebar', 'eweb')
        );
        parent::__construct('ew_new_post', __('EW: Bài viết mới nhất - Sidebar', 'eweb'), $widget_ops);
    }

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {
        extract($args);
        global $post;
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];

		echo $before_widget;

        $args = array(
            'post_type' => 'post',
            'ignore_sticky_posts' => 1,
            'showposts'=> $number,
        );
        echo $before_title;
            echo $title;
        echo $after_title;

        $vonglap = new WP_Query($args);
        echo '<ul>';
            while($vonglap->have_posts()) : $vonglap->the_post();?>
            <li>
                <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                    <?php the_post_thumbnail('thumb_80x70');?>
                </a>
                <a class='news-title' href="<?php the_permalink();?>" title="<?php the_title();?>">
                    <?php echo eweb_truncate_title('25');?>
                </a>
                <p class="post-date"><i class="fa fa-calendar"></i> <?php printf( '%s', '<span>' . get_the_date('D, m / Y') . '</span>' );?></p>
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
        $number = isset($instance['number']) ? absint($instance['number']) : 4;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title</label></br>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('number'); ?>">Number Post</label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}
?>