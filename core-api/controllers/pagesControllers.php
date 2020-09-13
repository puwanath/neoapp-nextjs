<?php
$param = "pages";
require "models/$param.php";
class pagesController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$_dir= "assets/";
		$word = new word();
		$url = curPageURL();
		$url2 = curPageURL2();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $this->getData($get_part1,'pagename');
		$param = "pages";
		$model = new pagesController;

		//================seo==================
		if($get_part0!='pages' and $get_part0!=""){
			putrating("kp_page","slug",$get_part0); //update static
			$current_pages = "active";
			$title = $this->getData('page-seo-title',$get_part0);
			$copyright = getcomp('companyname');
			$description = truncateStr(strip_tags($this->getData('page-seo-desc',$get_part0)),165,"");
			$keyword = getseo('seokeyword');
			$urlweb = $uri;
			$imageurl = $this->getData('imgtmp',$get_part0);
		}else{
			$current_pages = "active";
			$title = getseo('seotitle');
			$description = getseo('seodesc');
			$keyword = getseo('seokeyword');
			$urlweb = getcomp('url');
			$imageurl = "$url/images/logo.png";
		}
		//===============seo===================

		$content = array(
			"views/$param/index.php"
		);

		if($select==''){
			$page.= include("views/layout/template.php");
			return json_encode($page);
		}

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
			if($res->slang==$id){$active = "active";}else{$active="";}

			$data = "<li class=\"$active\"><a href=\"$url/pages/$res->pageid/$res->slang\"><i class=\"fa fa-check\"></i> $pagename </a></li>";
			array_push($arr,$data);
		}
		return implode('',$arr);
	}

	public function getCreator($id){
		if(substr($id,0,1)=="M"){
			$qr = $this->fetchdata("kp_members","where member_id = '$id' ");
			$res = $qr->fetch_object();

			return $res->cat_name_th;
		}else{
			$qr = $this->fetchdata("kp_users","where user_id = '$id' ");
			$res = $qr->fetch_object();

			return $res->fullname;
		}
	}


	public function getTag(){
		$arr = array();
		$arr2 = array();
		$url = curPageURL();
		$qr = $this->fetchdata("kp_post","where status =1");
		while($res = $qr->fetch_object()){
			$data = $res->posttag;
			array_push($arr,$data);
		}
		$arrm = implode("",$arr);
		$tag = explode(",",$arrm);
		foreach ($tag as $val) {
			$datatag = "<a class=\"btn\" href=\"$url/how-it-works?tags=$val\">$val</a> ";
			array_push($arr2,$datatag);
		}
		return $arr2;
	}

	public function partners(){
		$arr = array();
		$url = curPageURL();
		$qr = $this->fetchdata("kp_partner","where status = 1 order by partner_line asc");
		while($res = $qr->fetch_object()){
			$img = "$url/images/partners/$res->partner_img?v=$res->partner_id";
			if($res->partner_img!=''):
			// $data = "<div class=\"item\">
			// 						<a href=\"$res->partner_link\" target=\"_blank\">
			// 								<img src=\"$img\" alt=\"$res->partner_name\" />
			// 						</a>
			// 				</div>";
			$data = "<div class=\"tg-theme-post item\">
								<figure>
								<a href=\"$res->partner_link\" target=\"_blank\">
									<img src=\"$img\" alt=\"$res->partner_name\" style=\"width:80px;\">
								</a>
								</figure>
							</div>";
			array_push($arr,$data);
			endif;
		}

		return $arr;
	}


}
?>
