<?php
$param = "booking";
require "models/$param.php";

class bookingController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar("booking");
		$bgcover = "$url/images/bgabout.jpg";
		$param = "booking";
		$model = new bookingController;

		$current_home = "active";
		$title = getseo('seotitle');
		$description = getseo('seodesc');
		$keyword = getseo('seokeyword');
		$urlweb = getcomp('url');
		$imageurl = "$url2/images/logo.png";

		//content detail
		$content = array(
		"views/$param/index.php"
		);
		//end content

		$page = include("views/layout/template.php");
		return $page;
	}


	public function getData($id,$fillpage){
		$qr = $this->fetchdata("kp_page","where slang = '$id'");
		$res = $qr->fetch_object();
		if($fillpage=="pagename"):
		if($_SESSION['lg']=="TH"):return $res->pagename;else: return $res->pagename_en;endif;
		endif;
		if($fillpage=="pagedetail"):
		if($_SESSION['lg']=="TH"):return $res->pagedetail;else: return $res->pagedetail_en;endif;
		endif;
	}

	public function getMenulist($id){
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata("kp_page","where status =1 and showmenu=1 order by pageid asc");
		while($res = $qr->fetch_object()){
			if($_SESSION['lg']=="TH"){
				$pagename = $res->pagename;
			}else{
				$pagename = $res->pagename_en;
			}
			$pageid = $res->pageid;
			if($res->slang==$id){$active = "c-active";}else{$active="";}

			$data = "<li class=\"$active\"><a href=\"$url/booking-us/$res->slang\"><i class=\"icon icon-cursor\"></i> $pagename </a></li>";
			array_push($arr,$data);
		}
		return $arr;
	}


}
?>
