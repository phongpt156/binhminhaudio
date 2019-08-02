<?php

function getStr($string,$start,$end){
	$str = explode($start,$string,2);
	$str = explode($end,$str[1],2);
	return $str[0];
}

function _curl($url,$post="",$usecookie = false) {
	$ch = curl_init();
	if($post) {
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3");
	if ($usecookie) {
		curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);
	}
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result=curl_exec ($ch);
	curl_close ($ch);
	return $result;
}

function get_data($url)
{
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function _yStatus($yID="b0y.k0_ol") {
    $url    = 'http://opi.yahoo.com/online?u='.$yID.'&m=t';
    $status = get_data($url);
    if($status == $yID.' is ONLINE') {
        $img_status = 'yahoo-on.png';
    } else {
        $img_status = 'yahoo-off.png';
    }
    return $img_status;
}
function _sStatus($sID="hieu.dev") {
    $url    = 'http://mystatus.skype.com/'.$sID.'.num';
    $status = get_data($url);
    if($status == 1) {
        $img_status = 'skype-off.png';
    } else {
        $img_status = 'skype-on.png';
    }
    return $img_status;
}
class EW_Online_Support extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'suport-widget',
            'description' => __('Hỗ trợ trực tuyến - Sidebar', 'eweb')
        );
        parent::__construct('EW_Online_Support', __('EW: Hỗ trợ trực tuyến', 'eweb'), $widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );

        echo $before_widget;?>
            <?php
            $title = apply_filters('widget_title', $instance['title']);
            echo $before_title;
                echo $title;
            echo $after_title;
            ?>

            <ul>
                <?php
                if ($instance['1st_support_name'] == "") { ?>

                <?php } else { ?>
                <li>
                    <span><?php echo $instance['1st_support_name']?> <strong><?php echo $instance['1st_support_hotline']?></strong></span>
                    <a href="ymsgr:sendIM?<?php echo $instance['1st_support_id_yahoo']?>" title="<?php echo $instance['1st_support_name']?>">
                        <img class="yahoo" src="<?php echo get_bloginfo('template_url').'/images/'._yStatus($instance['1st_support_id_yahoo']) ?>" alt="<?php echo $instance['1st_support_name']?>" title="<?php echo $instance['1st_support_name']?>" />
                    </a>
                    <a href="Skype:<?php echo $instance['1st_support_id_sky']?>?chat">
                        <img src="<?php echo get_bloginfo('template_url').'/images/'._sStatus($instance['1st_support_id_sky']); ?>" title="<?php echo $instance['1st_support_name']?>" alt=""/>
                    </a>
                </li>
                <?php } ?>
                <?php
                if ($instance['2nd_support_name'] == "") { ?>

                <?php } else { ?>
                <li>
                    <span><?php echo $instance['2nd_support_name']?> <strong><?php echo $instance['2nd_support_hotline']?></strong></span>
                    <a href="ymsgr:sendIM?<?php echo $instance['2nd_support_id_yahoo']?>" title="<?php echo $instance['2nd_support_name']?>">
                        <img class="yahoo" src="<?php echo get_bloginfo('template_url').'/images/'._yStatus($instance['2nd_support_id_yahoo']) ?>" alt="<?php echo $instance['2nd_support_name']?>" title="<?php echo $instance['2nd_support_name']?>" />
                    </a>
                    <a href="Skype:<?php echo $instance['2nd_support_id_sky']?>?chat">
                        <img src="<?php echo get_bloginfo('template_url').'/images/'._sStatus($instance['2nd_support_id_sky']); ?>" title="<?php echo $instance['2nd_support_name']?>" alt=""/>
                    </a>
                </li>
                <?php } ?>
                <?php
                if ($instance['3nd_support_name'] == "") { ?>

                <?php } else { ?>
                <li>
                    <span><?php echo $instance['3nd_support_name']?> <strong><?php echo $instance['3nd_support_hotline']?></strong></span>
                    <a href="ymsgr:sendIM?<?php echo $instance['3nd_support_id_yahoo']?>" title="<?php echo $instance['3nd_support_name']?>">
                        <img class="yahoo" src="<?php echo get_bloginfo('template_url').'/images/'._yStatus($instance['3nd_support_id_yahoo']) ?>" alt="<?php echo $instance['3nd_support_name']?>" title="<?php echo $instance['3nd_support_name']?>" />
                    </a>
                    <a href="Skype:<?php echo $instance['3nd_support_id_sky']?>?chat">
                        <img src="<?php echo get_bloginfo('template_url').'/images/'._sStatus($instance['3nd_support_id_sky']); ?>" title="<?php echo $instance['3nd_support_name']?>" alt=""/>
                    </a>
                </li>
                <?php } ?>
                <?php
                if ($instance['4nd_support_name'] == "") { ?>

                <?php } else { ?>
                <li>
                    <span><?php echo $instance['4nd_support_name']?> <strong><?php echo $instance['4nd_support_hotline']?></strong></span>
                    <a href="ymsgr:sendIM?<?php echo $instance['4nd_support_id_yahoo']?>" title="<?php echo $instance['4nd_support_name']?>">
                        <img class="yahoo" src="<?php echo get_bloginfo('template_url').'/images/'._yStatus($instance['4nd_support_id_yahoo']) ?>" alt="<?php echo $instance['4nd_support_name']?>" title="<?php echo $instance['4nd_support_name']?>" />
                    </a>
                    <a href="Skype:<?php echo $instance['4nd_support_id_sky']?>?chat">
                        <img src="<?php echo get_bloginfo('template_url').'/images/'._sStatus($instance['4nd_support_id_sky']); ?>" title="<?php echo $instance['4nd_support_name']?>" alt=""/>
                    </a>
                </li>
                <?php } ?>
                <div class="clear"></div>
            </ul>
<?php
        echo $after_widget;

    }

    function form($instance) { ?>

        <p>
            <label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Tên Widget' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("1st_support_name"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Chức vị' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("1st_support_name"); ?>" name="<?php echo $this->get_field_name("1st_support_name"); ?>" type="text" value="<?php echo esc_attr($instance["1st_support_name"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("1st_support_id_yahoo"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Yahoo' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("1st_support_id_yahoo"); ?>" name="<?php echo $this->get_field_name("1st_support_id_yahoo"); ?>" type="text" value="<?php echo esc_attr($instance["1st_support_id_yahoo"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("1st_support_hotline"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Hotline' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("1st_support_hotline"); ?>" name="<?php echo $this->get_field_name("1st_support_hotline"); ?>" type="text" value="<?php echo esc_attr($instance["1st_support_hotline"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("1st_support_id_sky"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Skype' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("1st_support_id_sky"); ?>" name="<?php echo $this->get_field_name("1st_support_id_sky"); ?>" type="text" value="<?php echo esc_attr($instance["1st_support_id_sky"]); ?>" size="8" />
			</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("2nd_support_name"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Chức vị' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("2nd_support_name"); ?>" name="<?php echo $this->get_field_name("2nd_support_name"); ?>" type="text" value="<?php echo esc_attr($instance["2nd_support_name"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("2nd_support_id_yahoo"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Yahoo' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("2nd_support_id_yahoo"); ?>" name="<?php echo $this->get_field_name("2nd_support_id_yahoo"); ?>" type="text" value="<?php echo esc_attr($instance["2nd_support_id_yahoo"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("2nd_support_hotline"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Hotline' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("2nd_support_hotline"); ?>" name="<?php echo $this->get_field_name("2nd_support_hotline"); ?>" type="text" value="<?php echo esc_attr($instance["2nd_support_hotline"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("2nd_support_id_sky"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Skype' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("2nd_support_id_sky"); ?>" name="<?php echo $this->get_field_name("2nd_support_id_sky"); ?>" type="text" value="<?php echo esc_attr($instance["2nd_support_id_sky"]); ?>" size="8" />
			</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("3nd_support_name"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Chức vị' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("3nd_support_name"); ?>" name="<?php echo $this->get_field_name("3nd_support_name"); ?>" type="text" value="<?php echo esc_attr($instance["3nd_support_name"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("3nd_support_id_yahoo"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Yahoo' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("3nd_support_id_yahoo"); ?>" name="<?php echo $this->get_field_name("3nd_support_id_yahoo"); ?>" type="text" value="<?php echo esc_attr($instance["3nd_support_id_yahoo"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("3nd_support_hotline"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Hotline' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("3nd_support_hotline"); ?>" name="<?php echo $this->get_field_name("3nd_support_hotline"); ?>" type="text" value="<?php echo esc_attr($instance["3nd_support_hotline"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("3nd_support_id_sky"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Skype' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("3nd_support_id_sky"); ?>" name="<?php echo $this->get_field_name("3nd_support_id_sky"); ?>" type="text" value="<?php echo esc_attr($instance["3nd_support_id_sky"]); ?>" size="8" />
			</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("4nd_support_name"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Chức vị' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("4nd_support_name"); ?>" name="<?php echo $this->get_field_name("4nd_support_name"); ?>" type="text" value="<?php echo esc_attr($instance["4nd_support_name"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("4nd_support_id_yahoo"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Yahoo' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("4nd_support_id_yahoo"); ?>" name="<?php echo $this->get_field_name("4nd_support_id_yahoo"); ?>" type="text" value="<?php echo esc_attr($instance["4nd_support_id_yahoo"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("4nd_support_hotline"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Hotline' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("4nd_support_hotline"); ?>" name="<?php echo $this->get_field_name("4nd_support_hotline"); ?>" type="text" value="<?php echo esc_attr($instance["4nd_support_hotline"]); ?>" size="8" />
			</label>
            <label for="<?php echo $this->get_field_id("4nd_support_id_sky"); ?>">
				<span style="width: 49%; float: left;"><?php _e( 'Skype' ); ?>:</span>
				<input style="width: 50%" id="<?php echo $this->get_field_id("4nd_support_id_sky"); ?>" name="<?php echo $this->get_field_name("4nd_support_id_sky"); ?>" type="text" value="<?php echo esc_attr($instance["4nd_support_id_sky"]); ?>" size="8" />
			</label>
        </p>
<?php
    }
}
add_action( 'widgets_init', create_function('', 'return register_widget("EW_Online_Support");') );
?>