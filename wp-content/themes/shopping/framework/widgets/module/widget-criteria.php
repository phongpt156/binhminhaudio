<?php
add_action('widgets_init', 'ew_widget_criteria');
function ew_widget_criteria() {
        register_widget('ew_widget_criteria');
}
class ew_widget_criteria extends WP_Widget {
    /*-----------------------------------------------------------------------------------*/
    /*  Widget Setup
    /*-----------------------------------------------------------------------------------*/
    function __construct() {
        $widget_ops = array(
            'classname' => 'ew_widget_criteria',
            'description' => __('EW: Tiêu chí - Content Home', 'eweb')
        );
        parent::__construct('ew_widget_criteria', __('EW: Tiêu chí - Content Home', 'eweb'), $widget_ops);
        add_action('admin_enqueue_scripts', array($this, 'ew_script'));
    }

    public function ew_script() {
        wp_enqueue_script('repeater', get_template_directory_uri() . '/framework/widgets/module/js/repeater.js', null, null, true);
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Display Widget
    /*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {
        extract($args);
        global $post;

        $title = apply_filters('widget_title', $instance['title']);
        $hidden_sm = $instance['hidden_sm'];
        $hidden_xs = $instance['hidden_xs'];
        $max_entries = '4';

        echo $before_widget;?>
            <div class="services_head <?php if($hidden_sm == 'on') echo 'hidden-sm';?> <?php if($hidden_xs == 'on') echo 'hidden-xs';?>">
                <div class="row">
                    <?php
                    for($i = 0; $i < $max_entries; $i++){
                        $block = $instance['block-' . $i];  
                        if(isset($block) && $block != "") {
                            $title_cri = $instance['title-' . $i];
                            $icon = $instance['icon-' . $i];?>
                            <div class="col-lg-3 col-sm-6 col-xs-6">
                                <div class="box-services">
                                    <div class="icon"><i class="fa <?php echo $icon;?>" aria-hidden="true"></i></div>
                                    <div class="content-service">
                                        <h3><?php echo $title_cri;?></h3>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        <?php
        echo $after_widget;
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Update Widget
    /*-----------------------------------------------------------------------------------*/
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['hidden_sm'] = $new_instance['hidden_sm'];
        $instance['hidden_xs'] = $new_instance['hidden_xs'];

        $max_entries = '4';

        for($i=0; $i < $max_entries; $i++){ 
            $block = $new_instance['block-' . $i];
            if($block == 0 || $block == "") {
                $instance['block-' . $i] = $new_instance['block-' . $i];
                $instance['title-' . $i] = $new_instance['title-' . $i];
                $instance['icon-' . $i] = $new_instance['icon-' . $i];
            }
            else {
                $count = $block - 1;
                $instance['block-' . $count] = $new_instance['block-' . $i];
                $instance['title-' . $count] = $new_instance['title-' . $i];
                $instance['icon-' . $count] = $new_instance['icon-' . $i];
            }
        }

        return $instance;
    }
    /*-----------------------------------------------------------------------------------*/
    /*  Widget Settings (Displays the widget settings controls on the widget panel)
    /*-----------------------------------------------------------------------------------*/

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : 'Tiêu chí';
        $max_entries = '4';
        $widget_add_id = $this->id . "-add";
        $hidden_sm = $instance['hidden_sm'];
        $hidden_xs = $instance['hidden_xs'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label></br>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <div class="<?php echo $widget_add_id;?>-input-containers">
            <div id="entries">
                <?php
                for( $i =0; $i < $max_entries; $i++) {
                    $display = (!isset($instance['block-' . $i]) || ($instance['block-' . $i] == "")) ? 'style="display:none;"' : '';
                    if($display)
                        unset($instance);?>
                        <div id="entry<?php echo $i+1;?>" <?php echo $display;?> class="entrys">
                            <span class="entry-title" onclick = "slider(this);">Entry</span>
                            <div class="entry-desc">
                                <input class="widefat" id="<?php echo $this->get_field_id('block-' . $i );?>" name="<?php echo $this->get_field_name('block-' . $i );?>" type="hidden" value="<?php echo $instance['block-' . $i];?>">
                                <?php $title_cri = $instance['title-' . $i];?>
                                <p>
                                    <label>Title Cri:</label>
                                    <input class="widefat" name="<?php echo $this->get_field_name('title-' . $i);?>" type="text" value="<?php echo $title_cri;?>" />
                                </p>
                                <?php $icon = $instance['icon-' . $i];?>
                                <p>
                                    <label>iCon (http://fontawesome.io/icons - Name of iCon. Exp: star, male, rocket....):</label>
                                    <input class="widefat" name="<?php echo $this->get_field_name('icon-' . $i);?>" type="text" value="<?php echo $icon;?>" />
                                </p>
                                <p><a href="#delete"><span class="delete-row">Delete Row</span></a></p>
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>
        <div id="message">Sorry, you reached to the limit of <?php echo $max_entries;?> maximum entries.</div>
        <div class="<?php echo $widget_add_id;?>" style="display:none" >ADD ROW</div>
        
        <p>
            <input name="<?php echo $this->get_field_name('hidden_sm'); ?>" type="checkbox" <?php if ($hidden_sm == 'on') echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('hidden_sm'); ?>">Hidden on Table</label>
        </p>
        <p>
            <input name="<?php echo $this->get_field_name('hidden_xs'); ?>" type="checkbox" <?php if ($hidden_xs == 'on') echo 'checked'; ?> />
            <label for="<?php echo $this->get_field_id('hidden_xs'); ?>">Hidden on Mobile</label>
        </p>

        <script>    
            jQuery(document).ready(function(e) {      
                jQuery.each(jQuery(".<?php echo $widget_add_id; ?>-input-containers #entries").children(), function(){
                    if(jQuery(this).find('input').val() != ''){
                        jQuery(this).show(); 
                    }
                });      
                jQuery(".<?php echo $widget_add_id; ?>" ).bind('click', function(e) {      
                    var rows = 0;
                    jQuery.each(jQuery(".<?php echo $widget_add_id; ?>-input-containers #entries").children(), function(){  
                        if(jQuery(this).find('input').val() == ''){                
                            jQuery(this).find(".entry-title").addClass("active");
                            jQuery(this).find(".entry-desc").slideDown();           
                            jQuery(this).find('input').first().val('0');
                            jQuery(this).show();
                            return false; 
                        }else{
                            rows++;       
                            jQuery(this).show();
                            jQuery(this).find(".entry-title").removeClass("active");
                            jQuery(this).find(".entry-desc").slideUp();
                        }
                    });
                    if(rows == '<?php echo $max_entries;?>'){
                        jQuery("#so_container #message").show();
                        jQuery(".<?php echo $widget_add_id; ?>").hide();
                    }
                });  
                jQuery(".delete-row" ).bind('click', function(e) { 
                    var count = 1;
                    var current = jQuery(this).closest('.entrys').attr('id');
                    jQuery.each(jQuery("#entries #"+current+" .entry-desc").children(), function(){ 
                        jQuery(this).val('');             
                    });
                    jQuery.each(jQuery("#entries #"+current+" .entry-desc p").children(), function(){ 
                        jQuery(this).val('');             
                    }); 
                    jQuery('#entries #'+current+" .entry-title").removeClass('active');          
                    jQuery('#entries #'+current+" .entry-desc").hide();
                    jQuery('#entries #'+current).remove();

                    jQuery.each(jQuery(".<?php echo $widget_add_id; ?>-input-containers #entries").children(), function(){ 
                        if(jQuery(this).find('input').val() != ''){  
                            jQuery(this).find('input').first().val(count);
                        }
                        count++;
                    }); 
                });
            });
        </script>
        <style>
            <?php echo '.'.$widget_add_id; ?>{background: #ccc none repeat scroll 0 0;font-weight: bold;margin: 20px 0px 9px;padding: 6px;text-align: center;cursor:pointer; display: block!important}
            #entries{ padding:10px 0 0;}
            #entries .entrys{ padding:0; border:1px solid #e5e5e5; margin:10px 0 0; clear:both;}
            #entries .entrys:first-child{ margin:0;}
            #entries .entry-title{ display:block; font-size:14px; line-height:18px; font-weight:600; background:#f1f1f1; padding:7px 5px; position :relative;}
            #entries .entry-title:after{ content: '\f140'; font: 400 20px/1 dashicons; position :absolute; right:10px; top:6px; color:#a0a5aa;}
            #entries .entry-title.active:after{ content: '\f142';}
            #entries .entry-desc{ display:none; padding:0 10px 10px; border-top:1px solid #e5e5e5;}
            #message{padding:6px;display:none;color:red;font-weight:bold;}
            .delete-row{color: red; text-decoration: underline;}
        </style>
        <?php
    }
}