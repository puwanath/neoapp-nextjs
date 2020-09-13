<?php
$param = "faq";
require "models/$param.php";

class faqController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar("faq");
		$param = "faq";
		$model = new faqController;

		//================seo==================

		$current_faq = "active";
		$title = $pagename." | ".getseo('seotitle');
		$description = getseo('seodesc');
		$keyword = getseo('seokeyword');
		$urlweb = getcomp('url');
		$imageurl = "$url/images/logo.png";

		//===============seo===================

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'search' :
				$model->searchData();
				break;

			case 'loaddata' :
				$model->loadData();
				break;

			default :
			$urlredirec = "welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}

		endif;

		//content detail
		if($get_part1!='' and $get_part2=='detail'){
			$p = "viewsdetail.php";
		}else{
			$p = "index.php";
		}

		$content = array(
		"views/$param/index.php"
		);
		//end content

		if($select==''){
			$layout = "views/$param/layout.php";
			$page = include("views/layout/template.php");
			return json_encode($page);
		}
	}

	public function getData($id,$fill){
		$qr = $this->fetchdata("kp_faq","where faqid = '$id' and status =1");
		$res = $qr->fetch_object();
		if($fill=="name"):
			return $res->question;
		elseif($fill=="detail"):
			return $res->answer;
		elseif($fill=="catname"):
			return $this->getCatname($res->cat_id);
		elseif($fill=="createdate"):
			return date("d/m/y",strtotime($res->dateadd));
		endif;
	}

	public function getMenulist($id){
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata("kp_cat_faq","where status =1  order by cat_id asc");
		while($res = $qr->fetch_object()){
			$name = $res->question;
			$id = $res->faqid;
			if($res->faqid==$id){$active = "active";}else{$active="";}
			$data = "<li class=\"$active\"><a href=\"$url/faq/$res->cat_id/group\"><i class=\"icon icon-cursor\"></i> $name </a></li>";
			array_push($arr,$data);
		}
		return $arr;
	}


	public function getGroup(){
		$arr = array();
		$url = curPageURL();
		$qr = $this->fetchdata("kp_cat_faq","where status =1 order by cat_id asc");
		while($res = $qr->fetch_object()){
			$data = "<li role=\"presentation\"><a href=\"#\" class=\"item-group\" data-id=\"$res->cat_id\"><i class=\"fa fa-question-circle\"></i> $res->cat_name_th</a></li>";
			array_push($arr,$data);
		}

		return "<ul class=\"nav nav-pills\">".implode('',$arr)."</ul>";
	}

	public function loadData(){
		$arr = array();
		$url = curPageURL();
		$group = $_GET['group'];
		$search = $_GET['searchkeyword'];
		if($group!=''){
			$qr = $this->fetchdata("kp_faq","where status =1 and cat_id = '$group' order by cat_id asc");
		}elseif($search!=''){
			$qr = $this->fetchdata("kp_faq","where status =1 and (question like '%$search%' or answer like '%$search%')  order by cat_id asc");
		}else{
			$qr = $this->fetchdata("kp_faq","where status =1 order by faqid asc");
		}

		while($res = $qr->fetch_object()){
			$i++;
			if($i==1){$active = "true";$in = "in";}else{$active = "false";$in = "";}

			$data = "<div class=\"panel panel-default\">";
			$data.= "<div class=\"panel-heading\" role=\"tab\" id=\"heading$i\">";
			$data.= "<h4 class=\"panel-title\">";
			$data.= "<a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse$i\" aria-expanded=\"$active\" aria-controls=\"collapse$i\">";
			$data.= "<i class=\"fa fa-question\"></i> ".$res->question;
			$data.= "</a>";
			$data.= "</h4>";
			$data.= "</div>";
			$data.= "<div id=\"collapse$i\" class=\"panel-collapse collapse $in\" role=\"tabpanel\" aria-labelledby=\"heading$i\">";
			$data.= "<div class=\"panel-body\">";
			$data.= $res->answer;
			$data.= "</div>";
			$data.= "</div>";
			$data.= "</div>";
			array_push($arr,$data);
		}
		$respon = "<div class=\"panel-group\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">";
		$respon.= implode('',$arr);
		$respon.= "</div>";

		echo json_encode($respon);
	}


	public function getCatname($id){
		$qr = $this->fetchdata("kp_cat_faq","where cat_id = '$id'");
		$res = $qr->fetch_object();

		return $res->cat_name_th;
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
			$datatag = "<a class=\"tg-btn\" href=\"$url/faq?tags=$val\">$val</a> ";
			array_push($arr2,$datatag);
		}
		return $arr2;
	}



}
?>
