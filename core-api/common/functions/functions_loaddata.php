<?php

function getCategory(){
	require 'econtrol/common/include/config.php';
	$arr = array();
	$url = curPageURL();
	$url2 = curPageURL2();
	$qr = $dbCon->query("select * from kp_category where status =1 order by (cat_id+0) desc");
	while($res = $qr->fetch_object()){
		if($res->cat_img!=''){
			$img = "$url2/images/category/tmp/$res->cat_img";
			if($_SESSION['lg']=="TH"){
				$catname = $res->cat_name;
			}else{
				$catname = $res->cat_name_en;
			}
			$data = "<option value=\"$res->cat_id\">$catname</option>";
			array_push($arr,$data);
		}
	}

	return $arr;
}

function getCategoryall(){
	require 'econtrol/common/include/config.php';
	$arr = array();
	$url = curPageURL();
	$url2 = curPageURL2();
	$qr = $dbCon->query("select * from kp_category where status =1 order by (cat_sort+1) desc limit 0,20");
	while($res = $qr->fetch_object()){
		if($res->cat_img!=''){
			$img = "$url2/images/category/$res->cat_img";
			$i++;
			if($i>=12){
				$css = "cat-link-orther";
			}else{
				$css = "";
			}
			if($_SESSION['lg']=="TH"){
				$catname = $res->cat_name;
			}else{
				$catname = $res->cat_name_en;
			}
			$data = "<li class=\"$css\"><a href=\"$url/cat/$res->cat_id/$res->cat_slang\"><img class=\"icon-menu\" width=\"35\" height=\"20\" alt=\"$res->cat_name\" src=\"$img\">$catname</a></li>";
			array_push($arr,$data);
		}
	}

	return $arr;
}





?>
