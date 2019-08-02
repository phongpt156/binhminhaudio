<?php
add_action('widgets_init', 'ew_partner');
function ew_partner() {
        register_widget('ew_partner');
}
class ew_partner extends WP_Widget {
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
    function __construct() {
        $widget_ops = array(
            'classname' => 'ew_partner',
            'description' => __('Đối tác - Content Home', 'eweb')
        );
        parent::__construct('ew_partner', __('EW: Đối tác - Content Home', 'eweb'), $widget_ops);
    }

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {
        extract($args);
        global $post;

        $title = apply_filters('widget_title', $instance['title']);

        echo $before_widget;?>
            <h4 class="title-module">
                <?php echo $title;?>
            </h4>
            <div id="partner">
                <div id="owl-partner" class="owl-carousel">
                    <?php
                    $partners = ot_get_option( 'partner', array() );
                    foreach( $partners as $partner ) {
                        echo '
                            <div class="item">
                                <a href="'.$partner['link_partner'].'" title="'.$partner['title'].'">
                                    <img src="'.$partner['logo_partner'].'" alt="'.$partner['title'].'" title="'.$partner['title'].'">
                                </a>
                            </div>
                        ';
                    }?>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        var owl_partner;
                        owl_partner = jQuery("#owl-partner");
                        owl_partner.owlCarousel({
                            loop:true,
                            margin:15,
                            nav:true,
                            dots: false,
                            navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                            responsiveClass:true,
                            responsive:{
                                320:{
                                    items:2,
                                },
                                390:{
                                    items:3,
                                },
                                480:{
                                    items:4,
                                },
                                600:{
                                    items:5,
                                },
                                1000:{
                                    items:10,
                                }
                            }
                        });
                    });
                </script>
            </div>
        <?php
        echo $after_widget;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*-----------------------------------------------------------------------------------*/

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Đối tác';
		?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label></br>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<?php
	}
}
?>