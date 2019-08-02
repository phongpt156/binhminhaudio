<?php
add_action('widgets_init', 'ew_new_post_content');
function ew_new_post_content() {
        register_widget('ew_new_post_content');
}
class ew_new_post_content extends WP_Widget {
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
    function __construct() {
        $widget_ops = array(
            'classname' => 'post-content',
            'description' => __('Bài viết mới nhất - Content Home', 'eweb')
        );
        parent::__construct('ew_new_post_content', __('EW: Bài viết mới nhất - Content Home', 'eweb'), $widget_ops);
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
        $hidden_xs = $instance['hidden_xs'];?>

        <div class="<?php if($hidden_sm == 'on') echo 'hidden-sm';?> <?php if($hidden_xs == 'on') echo 'hidden-xs';?>">
    		<?php echo $before_widget;
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
                $vonglap = new WP_Query($args);
                echo $before_title;
                    echo '<span>'.$title.'</span>';
                echo $after_title;?>
                <div id="owl-news" class="owl-carousel">
                    <?php $vonglap = new WP_Query($args);
                    while($vonglap->have_posts()) : $vonglap->the_post();?>
                        <div class="item">
                            <div class="item-blog">
                                <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                                    <?php the_post_thumbnail('thumb_230x140');?>
                                </a>
                                <a href="<?php the_permalink();?>" class="blog-title" title="<?php the_title();?>"><?php the_title();?></a>
                                <div class="blog-exp">
                                    <?php echo eweb_truncate_description('75');?>
                                </div>
                                <a rel="nofollow" href="<?php the_permalink();?>" class="blog-more">Đọc thêm</a>
                            </div>
                        </div>
                    <?php endwhile;wp_reset_query();?>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        var owl_news;
                        owl_news = jQuery("#owl-news");
                        owl_news.owlCarousel({
                            autoplay : true,
                            loop:true,
                            margin: 15,
                            nav:false,
                            dots: false,
                            responsiveClass:true,
                            responsive:{
                                320:{
                                    items:1,
                                },
                                480:{
                                    items:2,
                                },
                                767:{
                                    items:3,
                                },
                                991:{
                                    items:3,
                                }
                            }
                        });
                    });
                </script>
            <?php echo $after_widget;?>
        </div>
	<?php }

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
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Baì viết mới nhất';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        $hidden_sm = $instance['hidden_sm'];
        $hidden_xs = $instance['hidden_xs'];
		?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label></br>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">Number Post</label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
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
?>