<?php
$param = "err404";
require "models/$param.php";


class err404Controller extends Controllers
{

	//begin function index start page
	public function index(){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "404";
		$param = "err404";
		$model = new err404Controller;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->readData();
				 break;

			case 'static' :
				 $model->staticChart();
				 break;

			case 'join' :
				 $model->joinJob();
				 break;

			default :
			$urlredirec = "../welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}

		endif;

		$user = getSession();
		$qruser = $this->fetchdata("kp_users","where user_id = '$user' ");
		$re = $qruser->fetch_object();
		$userid = $re->user_id;
		$userfullname = $re->user_fullname.' '.$re->user_lastname;
		if($re->user_avatar!=''){
			$userimg = $re->user_avatar;
		}else{
			$userimg = "avatar.png";
		}


		$qr = $this->fetchdata("kp_user_level","where level_id = '".$re->user_level."' ");
		$res = $qr->fetch_object();

		$levelname = $res->level_name;


		if($select==''){
			$content = "views/$param/index.php";
			$page = include("views/layout/template.php");
			return $page;
		}


	}
	//end function page


}
