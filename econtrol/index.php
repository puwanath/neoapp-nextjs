<?php
ob_start();
session_start();
setlocale(LC_MONETARY,"en_US");

require 'common/include/config.php';
require 'common/functions/functions_pages.php';
require 'common/functions/functions_log.php';
require 'common/functions/functions_selectdata.php';
require 'common/functions/functions_checkuser.php';
require 'common/functions/functions_menu_permission_left.php';
require 'common/functions/functions_navipage.php';
$url = curPageURL();
//update time user
onlineUser();
// checkUser();
//$checkuser = checkUser();
if(getcomp('status')==1):
if($_SESSION['user_id'][$privatesession]!=''){
// if($checkuser>0){
	//$_SESSION['user_id'];
	//checkUser();
	if (isset($_GET['logout'])) {
		doLogout();
	}
  if(checkUser()>0){
    $user = $_SESSION['user_id'][$privatesession];
  	$sql = "SELECT * FROM kp_users WHERE user_id = '$user'";
  	$q = $dbCon->query($sql);
  	$result = $q->fetch_object();
  	$userid = $result->user_id;
  	$userfullname = $result->user_fullname.' '.$result->user_lastname;
  	if($result->user_avatar!=''){
  		$userimg = $result->user_avatar;
  	}else{
  		$userimg = "avatar.png";
  	}
		$levelid = $result->user_level;
  	$qlevel = $dbCon->query("select * from kp_user_level where level_id = '".$result->user_level."' ") or die($dbCon->error);
  	$revel = $qlevel->fetch_object();

  	$levelname = $revel->level_name;


  	$pages->index($get_part0,$get_part1,$get_part2,$get_part3,$get_part4);
  }else{
		if($get_part0=="ulogin" and ($_GET['select']=="login" or $_GET['select']=="forgetpassword")){
			$pages->index($get_part0,$get_part1,$get_part2,$get_part3,$get_part4);
		}else{
			/* AJAX check  */
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				/* special ajax here */
				echo "LOGIN_REQUIRED";
				exit;
			}
			
			include('views/layout/login.php');
		}
  }

// }elseif($get_part0=="login"){
// 	include('views/layout/login.php');
}else{
	if($get_part0=="ulogin" and ($_GET['select']=="login" or $_GET['select']=="forgetpassword")){
		$pages->index($get_part0,$get_part1,$get_part2,$get_part3,$get_part4);
	}else{
		/* AJAX check  */
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			/* special ajax here */
			echo "LOGIN_REQUIRED";
			exit;
		}

		include('views/layout/login.php');
	}

}
else:
	include('views/layout/maintenance.php');
endif;
?>
