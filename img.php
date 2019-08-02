<?php
require_once( dirname( __FILE__ ) . '/wp-load.php' );
global $wpdb;
//$utf8_with_bom = "thông-tin-s-n-ph-m-5.jpg";

//echo urlencode($utf8_with_bom);
/*$blex= explode("/", "http://binhminhaudio.vn/wp-content/uploads/2019/03/thông-tin-s-n-ph-m-5.jpg");

$name_file = $blex[count($blex)-1];
$blw_2 = explode(".",$name_file);
$duoi_file = $blw_2[count($blw_2)-1];
$ten_file = $blw_2[0];

//$file_ok = $ten_file.".".$duoi_file;

$file_ok_repleca = sanitize_title($ten_file);
echo $name_file;
rename(dirname( __FILE__ )."/".$name_file,dirname( __FILE__ )."/".$file_ok_repleca.".".$duoi_file);*/
function utf8convert($str) {
    if(!$str) return false;
    $utf8 = array('a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ','d'=>'đ|Đ','e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ','i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị','o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ','u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự','y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',);
    foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
    return $str;
}
//$result = array();
$i=1;
$dir = dirname( __FILE__ )."/wp-content/uploads/";
$datas = $wpdb->get_results("SELECT id FROM wp_posts WHERE post_type = 'attachment' ORDER BY id DESC LIMIT 0,500000",OBJECT);
foreach ($datas as $p_item) {
	$id = $p_item->id;
	$meta_data = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE post_id = '$id' AND meta_key = '_wp_attached_file' LIMIT 1",OBJECT);
	if(count($meta_data) > 0){
		$meta = $meta_data[0];
		$path = $dir.$meta->meta_value;
		if (!file_exists($path)) {
			echo $i."-".$meta->meta_value."<br>";
			//array_push($result,$id);
			$i++;
		}
	}
}
//$file_handler=fopen(dirname( __FILE__ )."/log.txt",'w');
//fwrite($file_handler,implode(",",$result));
//fclose($file_handler);
?>