<?php

//position top
function ads728($url){
	require 'econtrol/common/include/config.php';
	$advert2 = array();
	$date = date("Y-m-d");
	$sql = "select * from kp_banner_ads where baposition = '1' and status = '1' and (datestart <= '$date' and dateend > '$date')";
	$q = $dbCon->query($sql);
	while($re = $q->fetch_object()){
		if($re->bacode==""){
			$advert2[] = "<img onclick=\"location.href='$re->balink'\" src=\"$url/images/banners/ads/$re->baimg\" alt=\"\" width='728' height='90' title='$re->baname' />";
		}else{
			$advert2[] = $re->bacode;
		}
	}

	shuffle($advert2);
	return $advert2[0];

}

function adsPOP($url){
	require 'econtrol/common/include/config.php';
	$advert2 = array();
	$date = date("Y-m-d");
	$sql = "select * from kp_banner_ads where baposition = '10' and status = '1' and (datestart <= '$date' and dateend > '$date')";
	$q = $dbCon->query($sql);
	while($re = $q->fetch_object()){
		if($re->bacode==""){
			$advert2[] = " <a href=\"$re->blink\" target=\"_blank\" class=\"your-class\">
			<img onclick=\"location.href='$re->balink'\" src=\"$url/images/banners/ads/$re->baimg\" alt=\"\" class='img-responsive' title='$re->baname' /></a>";
		}else{
			$advert2[] = $re->bacode;
		}
	}

	shuffle($advert2);
	return $advert2[0];

}

//position right top
function ads300x1($url){
	require 'econtrol/common/include/config.php';
	$advert1 = array();
	$date = date("Y-m-d");
	$sql = "select * from kp_banner_ads where baposition = '2' and status = '1' and (datestart <= '$date' and dateend > '$date')";
	$q = $dbCon->query($sql);
	while($re = $q->fetch_object()){
		if($re->bacode==""){
			$img = "<div style=\"margin-top:10px;\"><img onclick=\"location.href='$re->balink'\" src=\"$url/images/banners/ads/$re->baimg\" alt=\"\" width='250' title='$re->baname' /></div>";
		}else{
			$img = $re->bacode;
		}

		array_push($advert1,$img);
	}

	//shuffle($advert2);
	return implode(' ',$advert1);
}

//position right middern
function ads300x2($url){
	require 'econtrol/common/include/config.php';
	$advert2 = array();
	$date = date("Y-m-d");
	$sql = "select * from kp_banner_ads where baposition = '3' and status = '1' and (datestart <= '$date' and dateend > '$date')";
	$q = $dbCon->query($sql);
	while($re = $q->fetch_object()){
		if($re->bacode==""){
			$img = "<div style=\"margin-top:10px;\"><img onclick=\"location.href='$re->balink'\" src=\"$url/images/banners/ads/$re->baimg\" alt=\"\" width='250' title='$re->baname' /></div>";
		}else{
			$img = $re->bacode;
		}

		array_push($advert2,$img);
	}

	//shuffle($advert2);
	return implode(' ',$advert2);
}

//position left botton
function ads300x3($url){
	require 'econtrol/common/include/config.php';
	$advert3 = array();
	$date = date("Y-m-d");
	$sql = "select * from kp_banner_ads where baposition = '4' and status = '1' and (datestart <= '$date' and dateend > '$date')";
	$q = $dbCon->query($sql);
	while($re = $q->fetch_object()){
		if($re->bacode==""){
			$img = "<div style=\"margin-top:10px;\"><img onclick=\"location.href='$re->balink'\" src=\"$url/images/banners/ads/$re->baimg\" alt=\"\" width='250' title='$re->baname' /></div>";
		}else{
			$img = $re->bacode;
		}

		array_push($advert3,$img);
	}

	//shuffle($advert2);
	return implode(' ',$advert3);
}

//position home botton


?>
