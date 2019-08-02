<?php
add_action('widgets_init', 'ew_promotion_product');
function ew_promotion_product() {
        register_widget('ew_promotion_product');
}
class ew_promotion_product extends WP_Widget {
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
    function __construct() {
        $widget_ops = array(
            'classname' => 'list-product ew_promotion_product',
            'description' => __('Sản phẩm khuyến mãi - Video - Content Home', 'eweb')
        );
        parent::__construct('ew_promotion_product', __('EW: Sản phẩm khuyến mãi - Video - Content Home', 'eweb'), $widget_ops);
    }

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {
        extract($args);
        global $post;
        $title = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        $link = $instance['link'];
        $image_uri = $instance['image_uri'];
		$link_video = $instance['link_video'];
        $hidden_sm = $instance['hidden_sm'];
        $hidden_xs = $instance['hidden_xs'];

        $args = array(
            'post_type' => 'product',
            'ignore_sticky_posts' => 1,
            'meta_key' => 'on_off_km',
            'meta_value' => 'on',
            'showposts' => $number,
            'orderby' => 'rand'
        );?>
        <div class="col-lg-12">
        <div class="<?php if($hidden_sm == 'on') echo 'hidden-sm';?> <?php if($hidden_xs == 'on') echo 'hidden-xs';?>col-lg-8 col-sm-12 col-xs-12">
            <?php 
            echo $before_widget;
                $loop = new WP_Query( $args );
                echo $before_title;?>
                    <span><?php echo $title;?></span>
                <?php echo $after_title;
                if(!empty($image_uri)){?>
                    <a class="img-cate" href="<?php echo $link;?>">
                        <img src="<?php echo $image_uri;?>" class="">
                    </a>
                <?php }?>
                <div class="promotion-products">
                    <div id="owl-selling" class="owl-carousel">
                        <?php while($loop->have_posts()) : $loop->the_post();
                            get_template_part('template-parts/content-promotion');
                        endwhile;
                        wp_reset_query(); ?>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            var owl_selling;
                            owl_selling = jQuery("#owl-selling");
                            owl_selling.owlCarousel({
                                autoplay : false,
                                loop:true,
                                nav:true,
                                dots: false,
                                navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                                responsiveClass:true,
                                responsive:{
                                    320:{
                                        items:2,
                                    },
                                    390:{
                                        items:2,
                                    },
                                    480:{
                                        items:2,
                                    },
                                    768:{
                                        items:2,
                                    },
                                    1000:{
                                        items:3,
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            <?php echo $after_widget;?>
        </div>
		<div style="margin-top:20px" class="col-lg-4 col-sm-12 col-xs-12">
		<div class="block-title">
			<h2 class="title-module"><span><i class="fa fa-apple"></i>Video</span></h2>
		</div>
		<iframe width="350" height="280" src="<?php echo 'https://www.youtube.com/embed/'.substr($link_video,-11);?>" frameborder="0" allowfullscreen></iframe>
		
		</div>
        </div>
	<?php }

	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        $instance['link'] = $new_instance['link'];
        $instance['image_uri'] = $new_instance['image_uri'];
        $instance['hidden_sm'] = $new_instance['hidden_sm'];
        $instance['hidden_xs'] = $new_instance['hidden_xs'];
		$instance['link_video'] = $new_instance['link_video'];

		return $instance;
	}
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*-----------------------------------------------------------------------------------*/

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Sản phẩm khuyến mại';
        $number = isset($instance['number']) ? absint($instance['number']) : 8;
        $link = $instance[ 'link' ];
		$link_video = $instance[ 'link_video' ];
        $image_uri = $instance[ 'image_uri' ];
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
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php echo 'Link';?></label><br />
            <input type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php echo $link; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br />
            <img class="custom_media_image" src="<?php echo $image_uri; ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
            <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>">
        </p>
        <p>
            <input type="button" value="<?php echo 'Upload Image';?>" class="button custom_media_upload" id="custom_image_uploader"/>
        </p>
        <p>
            <input name="<?php echo $this->get_field_name('hidden_sm'); ?>" type="checkbox" <?php if ($hidden_sm == 'on') echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('hidden_sm'); ?>">Hidden on Table</label>
        </p>
        <p>
            <input name="<?php echo $this->get_field_name('hidden_xs'); ?>" type="checkbox" <?php if ($hidden_xs == 'on') echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('hidden_xs'); ?>">Hidden on Mobile</label>
        </p>
				<p>
            <label for="<?php echo $this->get_field_id('link_video'); ?>">Link Video</label></br>
			<input class="widefat" id="<?php echo $this->get_field_id('link_video'); ?>" name="<?php echo $this->get_field_name('link_video'); ?>" type="text" value="<?php echo $link_video; ?>" />
        </p>
		<?php
	}
}
?>