<?php
function getPopup($fill){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];
	$datenow = date("Y-m-d");
	$sql = "select * from kp_popup where id = '1' and ('$datenow' between popup_start and popup_end) ";
	$select = $dbCon->query($sql);
	$res = $select->fetch_object();
	if($fill=='name'){
		if($_SESSION['lg']=='TH'){
			return $res->popup_name_th;
		}else{
			return $res->popup_name_en;
		}
	}elseif($fill=='desc'){
		if($_SESSION['lg']=='TH'){
			return $res->popup_desc_th;
		}else{
			return $res->popup_desc_en;
		}
	}elseif($fill=='banner'){
		$img = $url.'/images/popup/'.$res->popup_banner;
		$img = "<img src='$img' alt='$res->popup_name_th' title='$res->popup_name_th' class='img-responsive' />";
		return $img;
	}elseif($fill=='checkbanner'){
		if($res->popup_banner=='' or $res->popup_banner==null){
			return 0;
		}else{
			return 1;
		}
	}elseif($fill=='bg'){
		if($res->popup_bg!=''){
			$img = img_webp("images/popup/$res->popup_bg");
			return $url.'/'.$img;
		}else{
			return '';
		}
	}elseif($fill=='cookie_status'){
		return $res->cookie_status;
	}elseif($fill=='cookie_time'){
		return $res->cookie_time;
	}elseif($fill=='status'){
		return $res->status;
	}else{
		return $res->$fill;
	}
}


?>
