<?php
add_action('widgets_init', 'eweb_post_by_cate');
function eweb_post_by_cate() {
        register_widget('eweb_post_by_cate');
}
class eweb_post_by_cate extends WP_Widget {
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
    function __construct() {
        $widget_ops = array(
            'classname' => 'list-news-sidebar',
            'description' => __('EW: Baì viết theo chuyên mục - Sidebar', 'eweb')
        );
        parent::__construct('eweb_post_by_cate', __('EW: Baì viết theo chuyên mục - Sidebar', 'eweb'), $widget_ops);
    }

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {
        extract($args);
        global $post;
        $title = apply_filters('widget_title', $instance['title']);
        $cat = $instance['cats'];
        $number = $instance['number'];
		foreach ($cat as $cat_id) {
        	$args = array(
               'showposts'=> $number,
               'ignore_sticky_posts' => 1,
               'cat' => $cat_id,
        		);
        }
		?>
		<?php echo $before_widget;?>
	            <?php echo $before_title;?>
	                <a href="<?php echo get_category_link($cat_id); ?>"><?php echo $title;?></a>
	            <?php echo $after_title;?>
                <ul class="list-items">
                	<?php
                	$vonglap = new WP_Query($args);
                	while($vonglap->have_posts()):$vonglap->the_post();?>
                	<li>
		                <a href="<?php the_permalink();?>" title="<?php the_title();?>">
		                    <?php the_post_thumbnail('shop_thumbnail', array('alt'=>get_the_title()));?>
		                </a>
		                <a class='news-title' href="<?php the_permalink();?>" title="<?php the_title();?>">
		                    <?php echo eweb_truncate_title('25');?>
		                </a>
		                <p class="post-date"><i class="fa fa-calendar"></i> <?php printf( '%s', '<span>' . get_the_date('D, m / Y') . '</span>' );?></p>
		            </li>
                    <?php endwhile;wp_reset_query();?>
                </ul>
        <?php echo $after_widget; //End Box
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cats'] = $new_instance['cats'];
        $instance['number'] = $new_instance['number'];

		return $instance;
	}
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*-----------------------------------------------------------------------------------*/

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 6;
		?>
		<p>
			<label>Title</label></br>
			<input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label>Number Post</label>
			<input name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Lựa chọn bài viết theo chuyên mục', 'eweb'); ?>
				<?php
				$categories = get_categories('hide_empty=0');
				echo "<br/>";
				$i=1;
				foreach ($categories as $cat) {
					$option = '<input type="radio" id="' . $this->get_field_id('cats') . '[]" name="' . $this->get_field_name('cats') . '[]"';
					if (isset($instance['cats'])) {
						foreach ($instance['cats'] as $cats) {
							if ($cats == $cat->term_id) {
								$option = $option . ' checked="checked"';
							}
						}
					}else{
						if($i == 1){
							$option = $option . ' checked="checked"';
						}
					}
					$option .= ' value="' . $cat->term_id . '" />';
					$option .= '&nbsp;';
					$option .= $cat->cat_name;
					$option .= '&nbsp;('.$cat->count.' bài viết)';
					$option .= '<br />';
					echo $option;
					$i++;
				} ?>
			</label>
		</p>
		<?php
	}
}
?>