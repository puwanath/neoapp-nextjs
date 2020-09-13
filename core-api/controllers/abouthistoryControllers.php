<?php
$param = "abouthistory";
require "models/$param.php";

class abouthistoryController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar("About History");
		$bgcover = "$url/images/bgabout.jpg";
		$param = "abouthistory";
		$model = new abouthistoryController;

		$current_home = "active";
		$title = $this->getData('page-seo-title',$get_part0);
		$description = $this->getData('page-seo-desc',$get_part0);
		$keyword = getseo('seokeyword');
		$urlweb = $uri;
		$imageurl = "$url2/images/logo.png";

		//content detail
		$content = array(
		"views/$param/index.php"
		);
		//end content

		$page = include("views/layout/template.php");
		return $page;
	}


	public function getData($fillpage,$id){
		$qr = $this->fetchdata("kp_page","where slug = '$id'");
		$res = $qr->fetch_object();
		if($fillpage=="pagename"):
		if($_SESSION['lg']=="TH"):return $res->pagename_th;else: return $res->pagename_en;endif;
		endif;
		if($fillpage=="pagedetail"):
		if($_SESSION['lg']=="TH"):return $res->pagedetail_th;else: return $res->pagedetail_en;endif;
		endif;
		if($fillpage=="page-seo-title"):
			return $res->seo_title;
		endif;
		if($fillpage=="page-seo-desc"):
			return $res->seo_desc;
		endif;
	}


}
?>
