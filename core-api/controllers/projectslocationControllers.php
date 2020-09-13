<?php
$param = "projectslocation";
require "models/$param.php";

class projectslocationController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$url2 = curPageURL2();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar("Projects Location");
		$bgcover = "$url/images/bgabout.jpg";
		$param = "projectslocation";
		$active_allproject = "c-active";
		$model = new projectslocationController;


		$pagename = $word->wordvar("Ready to move in house project").' '.$this->getData('name',$get_part0);
		$title = "$pagename | ".getseo('seotitle');
		$description = getseo('seodesc');
		$keyword = getseo('seokeyword');
		$urlweb = $uri;
		$imageurl = "$url/images/logo.png";

		$p = "index.php";


		$content = array(
		"views/$param/$p"
		);
		//end content

		// begin css and js
		$cssarr = array(
			"<link rel='stylesheet' href='".$dir."gallery-master/css/blueimp-gallery.min.css'>",
			"<link rel='stylesheet' href='".$dir."popup/styles_popup.css'>",
			"<link rel='stylesheet' type='text/css' href='".$dir."slick/slick.css'>",
			"<link rel='stylesheet' type='text/css' href='".$dir."slick/slick-theme.css'>"
		);

		$jsarr = array(
			"<script src='".$dir."gallery-master/js/blueimp-gallery.min.js'></script>",
			"<script>
				document.getElementById('links').onclick = function (event) {
				    event = event || window.event;
				    var target = event.target || event.srcElement,
				        link = target.src ? target.parentNode : target,
				        options = {index: link, event: event},
				        links = this.getElementsByTagName('a');
				    blueimp.Gallery(links, options);
				};
				</script>",
			"<link href='".$dir."sweetalert2-8.18.5/dist/sweetalert2.min.css' rel='stylesheet' type='text/css' />",
			"<script src='".$dir."sweetalert2-8.18.5/dist/sweetalert2.min.js'></script>",
			"<script src='".$dir."popup/js.cookie.js'></script>",
			"<script src='".$dir."slick/slick.js' type='text/javascript' charset='utf-8'></script>"
			// "<script src='".$dir."popup/js_popup.js'></script>",
			// "<script src='".$dir."blueimp-gallery/js/blueimp-gallery-fullscreen.js'></script>",
		);


		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddatahomeplan' :
				$model->loadDatahomeplan();
				break;

			default :
			$urlredirec = "welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}

		endif;

		//end css and js script
		// if($_GET['select']=='send'){
		// 	$this->sendMail();
		// }else{
			if($select==''){
				$page = include("views/layout/template.php");
				return $page;
			}
		//}
	}

	public function listProjectscat($get_part0){
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$location_id = $this->getTextformid('kp_projects_location','location_id','slug',$get_part0);
		$qr = $this->fetchdata('kp_projects_cat',"where status = 1 and is_delete=0 and location_id = '$location_id' order by sort asc");
		while($res = $qr->fetch_object()){
			$project_cat_id = $res->project_cat_id;
			$slug = $res->slug;
			if($_SESSION['lg']=="TH"){
				$project_cat_name = $res->project_cat_name_th;
				$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_th),80,"...");
			}else{
				$project_cat_name = $res->project_cat_name_en;
				$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_en),80,"...");
			}
			$link = "$url/$slug";
			if($res->project_cat_logo!=''){
				if(file_exists("images/projects_cat/$res->project_cat_logo")==true){
					$imglogo = img_webp("images/projects_cat/$res->project_cat_logo");
					$imglogo = "<img src=\"$imglogo\" class=\"c-center\" style=\"height:60px;width: auto;margin: 0 auto;\"/>";
				}else{
					$imglogo = "";
				}
			}
			$imgcover = $this->getImgcoverCat($project_cat_id);

			$data = "<div class=\"col-lg-4 col-sm-6 col-xs-12 c-content-person-1 c-option-2\">
				<div class=\"c-caption c-content-overlay\">
					<img src=\"$imgcover\" class=\"img-responsive c-overlay-object\" alt=\"\">
				</div>
				<div class=\"c-body\">
					<div class=\"c-center\">
						$imglogo
					</div>
					<div class=\"c-center\" style=\"margin-top:10px;\">
						<div class=\"c-name c-font-uppercase c-font-bold c-center\" style=\"font-size:19px;\">$project_cat_name</div>
					</div>
					<p class=\"c-center\" style=\"height:60px;\">
						$project_cat_shortdetail
					</p>
					<!--<div class=\"c-center\">
						<div class=\"c-name c-font-uppercase c-font-bold c-center\">-----</div>
					</div>-->
					<div class=\"c-center\">
						<a href=\"$link\" class=\"btn c-btn-orange\">".$word->wordvar('View Detail')."</a>
					</div>
				</div>
			</div>";
			array_push($arr,$data);
		}
		return implode('',$arr);
	}

	public function getData($fill,$id){
		$url = curPageURL();
		$word = new word();
		$qr = $this->fetchdata("kp_projects_location","where slug = '$id' ");
		$res = $qr->fetch_object();
		$location_id = $res->location_id;


		if($_SESSION['lg']=='TH'){
			$project_location_name = $res->location_name_th;
		}else{
			$project_location_name = $res->location_name_en;
		}

		if($fill=="name"){
			if($_SESSION['lg']=='TH'){
				return $project_location_name;
			}else{
				return $project_location_name;
			}
		}else{
			return $res->$fill;
		}
	}


	// =======================================================

	public function getDesc($fill,$id){
		$qr = $this->fetchdata("kp_projects_desc","where desc_id = '$id' ");
		$res = $qr->fetch_object();

		if($fill=='name'){
			if($_SESSION['lg']=='TH'){
				$name = $res->desc_name_th;
			}else{
				$name = $res->desc_name_en;
			}
			return $name;
		}elseif($fill=='icon'){
			return $res->desc_icon;
		}

	}

	public function getHometypename($id){
		$qr = $this->fetchdata("kp_projects_type","where project_type_id = '$id' ");
		$res = $qr->fetch_object();

		if($_SESSION['lg']=='TH'){
			$name = $res->project_type_name_th;
		}else{
			$name = $res->project_type_name_en;
		}

		return $name;
	}

	public function getHomelocation($id){
		$qr = $this->fetchdata("kp_location","where location_id in (select location_id from kp_projects_cat where project_cat_id = '".$id."') ");
		$res = $qr->fetch_object();

		if($_SESSION['lg']=='TH'){
			$name = $res->location_name_th;
		}else{
			$name = $res->location_name_en;
		}

		return $name;
	}


	public function getImgcover($id){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_projects_gallery","where project_id = '".$id."' and is_cover=1 and img_type='gallery' limit 0,1 ");
		$res = $qr->fetch_object();
		$num = $qr->num_rows;
		if($num>0){
			if(!empty($res->project_img)){
				if(file_exists("images/projects/$res->project_img")==true){
					$img = img_webp("images/projects/$res->project_img");
				}else{
					$img = img_webp("images/noimg.jpg");
				}
			}else{
				$img = img_webp("images/noimg.jpg");
			}
			return $img;
		}else{
			$qr = $this->fetchdata("kp_projects_gallery","where project_id = '".$id."' and img_type='gallery' limit 0,1 ");
			$res = $qr->fetch_object();
			if(!empty($res->project_img)){
				if(file_exists("images/projects/$res->project_img")==true){
					$img = img_webp("images/projects/$res->project_img");
				}else{
					$img = img_webp("images/noimg.jpg");
				}
			}else{
				$img = img_webp("images/noimg.jpg");
			}

			return $img;
		}
	}

	public function getImgcoverCat($id){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_projects_cat_gallery","where project_cat_id = '$id' and is_cover=1 limit 0,1 ");
		$res = $qr->fetch_object();
		$num = $qr->num_rows;
		if($num>0){
			if(!empty($res->project_cat_img)){
				if(file_exists("images/projects_cat/$res->project_cat_img")==true){
					$img = img_webp("images/projects_cat/$res->project_cat_img");
				}else{
					$img = img_webp("images/noimg.png");
				}
			}else{
				$img = img_webp("images/noimg.png");
			}
			return $img;
		}else{
			$qr = $this->fetchdata("kp_projects_cat_gallery","where project_cat_id = '$id' limit 0,1 ");
			$res = $qr->fetch_object();
			if(!empty($res->project_cat_img)){
				if(file_exists("images/projects_cat/$res->project_cat_img")==true){
					$img = img_webp("images/projects_cat/$res->project_cat_img");
				}else{
					$img = img_webp("images/noimg.png");
				}
			}else{
				$img = img_webp("images/noimg.png");
			}
			return $img;
		}
	}


}

?>
