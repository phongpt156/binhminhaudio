<?php
add_action('widgets_init', 'eweb_product_by_cate_home');
function eweb_product_by_cate_home() {
        register_widget('eweb_product_by_cate_home');
}
class eweb_product_by_cate_home extends WP_Widget {
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
    function __construct() {
        $widget_ops = array(
            'classname' => 'list-product',
            'description' => __('Sản phẩm theo chuyên mục - Content Home', 'eweb')
        );
        parent::__construct('eweb_product_by_cate_home', __('EW: Sản phẩm theo chuyên mục - Content Home', 'eweb'), $widget_ops);
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
        $link = $instance['link'];
        $image_uri = $instance['image_uri'];
        //$subcat = $instance['subcat'];
        $hidden_sm = $instance['hidden_sm'];
        $hidden_xs = $instance['hidden_xs'];
		$banner_left = $instance['banner_left'];
        $subcat = $instance[ 'subcat' ] ? 'true' : 'false';
		foreach ($cat as $cat_id) {
        	$args = array(
				'post_type' =>'product',
               	'showposts'=> $number,
               	'orderby' => 'rand',
               	'order'=>'DESC',
               	'tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'term_id',
						'terms' => $cat_id
					)
				)
    		);
    		$term = get_term_by('id', $cat_id, 'product_cat');
	        $term_name = $term->name;
	        $slug = $term->slug;
	        $term_link = get_term_link( $slug, 'product_cat' );
	        if ( is_wp_error( $term_link ) ) {
	            continue;
	        }
        }
		?>    
		<div class="col-sm-12">

				<div style="" class="col-lg-10 col-sm-10 col-sx-12<?php if($hidden_sm == 'on') echo 'hidden-sm';?> <?php if($hidden_xs == 'on') echo 'hidden-xs';?>">
					<?php echo $before_widget;?>
			            <?php echo $before_title;?>
			                <a href="<?php echo $term_link; ?>">
			                	<span><?php echo $title;?></span>
			                </a>
			            <?php if ($subcat == 'true'): ?>
			            <ul class="sub-menu hidden-md hidden-sm hidden-xs">
				            	<?php
								$taxonomy_name = 'product_cat';
								$termchildren = get_term_children( $cat_id, $taxonomy_name );
								foreach ( $termchildren as $child ) {
									$term = get_term_by( 'id', $child, $taxonomy_name );
									echo '<li><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
								}?>
			        	</ul>
			        	<?php endif; ?>
			            <?php echo $after_title;?>

			            	<?php if(!empty($image_uri)){?>
			    				<a class="img-cate" href="<?php echo $link;?>">
						            <img src="<?php echo $image_uri;?>" class="">
						        </a>
			    			<?php }?>
		            		<div class="show-products">
		            			<?php
				                $vonglap = new WP_Query($args);
				                while($vonglap->have_posts()) : $vonglap->the_post();
				                	get_template_part('template-parts/content');
				                endwhile;wp_reset_query();
				                ?>
		            		</div>
			        <?php echo $after_widget;?>
		        </div>
				<div style="margin-top:20px;" class="col-lg-2 hidden-md hidden-sm hidden-xs">
					<img src="<?php echo $banner_left;?>"/>
				</div>		        
		</div>
	<?php }

	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cats'] = $new_instance['cats'];
        $instance['number'] = $new_instance['number'];
        $instance['link'] = $new_instance['link'];
        $instance['image_uri'] = $new_instance['image_uri'];
        $instance['subcat'] = $new_instance['subcat'];
        $instance['hidden_sm'] = $new_instance['hidden_sm'];
        $instance['hidden_xs'] = $new_instance['hidden_xs'];
		$instance['banner_left'] = $new_instance['banner_left'];

		return $instance;
	}
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*-----------------------------------------------------------------------------------*/

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 4;
		$link = $instance[ 'link' ];
        $image_uri = $instance[ 'image_uri' ];
        $subcat = isset($instance['subcat']) ? absint($instance['subcat']) : 'on';
        $hidden_sm = $instance['hidden_sm'];
        $hidden_xs = $instance['hidden_xs'];
		$banner_left = $instance['banner_left'];
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
          	<label for="<?php echo $this->get_field_id('banner_left'); ?>">Image</label><br />
            <img class="custom_media_image" src="<?php echo $banner_left; ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
            <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('banner_left'); ?>" id="<?php echo $this->get_field_id('banner_left'); ?>" value="<?php echo $banner_left; ?>">
        </p>
        <p>
            <input type="button" value="<?php echo 'Upload Image';?>" class="button custom_media_upload" id="custom_image_uploader"/>
        </p>
        <!-- <p>
        	<input id="<?php echo $this->get_field_id('subcat'); ?>" name="<?php echo $this->get_field_name('subcat'); ?>" type="checkbox" <?php if ($subcat == 'on') echo 'checked="checked"'; ?>/>
        	<label for="<?php echo $this->get_field_id('subcat'); ?>">Show category's children</label>
        </p> -->
        <p>
		    <input class="checkbox" type="checkbox" <?php checked( $instance[ 'subcat' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'subcat' ); ?>" name="<?php echo $this->get_field_name( 'subcat' ); ?>" />
		    <label for="<?php echo $this->get_field_id( 'subcat' ); ?>">Show category's children</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Lựa chọn danh mục', 'eweb'); ?>
				<?php
				$args = array(
                    'orderby' => 'count',
                );
                $terms = get_terms('product_cat', $args);
				echo "<br/>";
				$i=1;
				foreach ($terms as $cat) {
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
					$option .= $cat->name;
					$option .= '&nbsp;('.$cat->count.' sản phẩm)';
					$option .= '<br />';
					echo $option;
					$i++;
				}
				?>
			</label>
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