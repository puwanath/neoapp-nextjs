<?php
$param = "about";
require "models/$param.php";

class aboutController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar("about us");
		$bgcover = "$url/images/bgabout.jpg";
		$param = "about";
		$model = new aboutController;

		$active_about = "c-active";
		$title = "$pagename | ".getseo('seotitle');
		$description = getseo('seodesc');
		$keyword = getseo('seokeyword');
		$urlweb = $uri;
		$imageurl = "$url/images/logo.png";

		//content detail
		$content = array(
		"views/$param/index.php"
		);
		//end content

		$page = include("views/layout/template.php");
		return $page;
	}


	public function getData($fillpage,$id){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_page","where slug = '$id'");
		$res = $qr->fetch_object();
		if($fillpage=="pagename"):
		if($_SESSION['lg']=="TH"):return $res->pagename_th;else: return $res->pagename_en;endif;
		elseif($fillpage=="pagedetail"):
		if($_SESSION['lg']=="TH"):return $res->pagedetail_th;else: return $res->pagedetail_en;endif;
		elseif($fillpage=="page-seo-title"):
			return $res->seo_title;
		elseif($fillpage=="page-seo-desc"):
			return $res->seo_desc;
		elseif($fillpage=="pageimg"):
			return '<img src="'.$url.'/images/pages/'.$res->pageimg.'" style="width:100%;" class="img-responsive" alt="'.$res->pagename_en.'"/>';
		else:
			return $res->$fillpage;
		endif;
	}

	// brgin function team
	public function lastTeam(){
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata("kp_teams","where is_delete=0 and status=1 order by sort asc");
		while($res = $qr->fetch_object()){
			$m_id = $res->m_id;
			if($_SESSION['lg']=='TH'){
				$m_name = $res->m_name_th;
				$m_desc = $res->m_desc_th;
				$m_desc = truncateStr(strip_tags($m_desc),100,"");
			}else{
				$m_name = $res->m_name_en;
				$m_desc = $res->m_desc_en;
				$m_desc = truncateStr(strip_tags($m_desc),100,"");
			}
			$m_position = $res->m_position;
			if(!empty($res->m_img)){
				if(file_exists("images/teams/$res->m_img")===true){
					$img = "$url/images/teams/$res->m_img";
				}else{
					$img = "$url/images/noimg.jpg";
				}
			}else{
				$img = "$url/images/noimg.jpg";
			}

			$data = '<div class="col-md-4 col-sm-6 c-margin-b-30">
					<div class="c-content-person-1 c-option-2">
			  			<div class="c-caption c-content-overlay">
			  				<img class="c-overlay-object img-responsive" src="'.$img.'" alt="'.$m_name.'">
			  			</div>
			  			<div class="c-body">
				  			<div class="c-head">
				  				<div class="c-name c-font-uppercase c-font-bold">'.$m_name.'</div>
				  			</div>
				  			<div class="c-position">
				  				'.$m_position.'
				  			</div>
					  		<p>'.$m_desc.'</p>
		          </div>
	          </div>
				</div>';
			array_push($arr,$data);

		}

		return implode('',$arr);
	}
	// end function team


	// begin function past projects
	public function listProjects(){
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata('kp_projects_cat',"where status = 1 and is_delete=0 order by sort desc limit 0,6");
		while($res = $qr->fetch_object()){
				$project_cat_id = $res->project_cat_id;
				$slug = $res->slug;
				$getdevice = detectDevice();
				if($getdevice=="Computer"){
					if($_SESSION['lg']=="TH"){
						$project_cat_name = $res->project_cat_name_th;
						$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_th),110,"...");
					}else{
						$project_cat_name = $res->project_cat_name_en;
						$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_en),110,"...");
					}
				}elseif($getdevice=="Tablet"){
					if($_SESSION['lg']=="TH"){
						$project_cat_name = $res->project_cat_name_th;
						$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_th),80,"...");
					}else{
						$project_cat_name = $res->project_cat_name_en;
						$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_en),80,"...");
					}
				}elseif($getdevice=="Mobile"){
					if($_SESSION['lg']=="TH"){
						$project_cat_name = $res->project_cat_name_th;
						$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_th),70,"...");
					}else{
						$project_cat_name = $res->project_cat_name_en;
						$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_en),70,"...");
					}
				}else{
					if($_SESSION['lg']=="TH"){
						$project_cat_name = $res->project_cat_name_th;
						$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_th),110,"...");
					}else{
						$project_cat_name = $res->project_cat_name_en;
						$project_cat_shortdetail = truncateStr(strip_tags($res->project_cat_shortdetail_en),110,"...");
					}
				}

				$link = "$url/$slug";
				if(!empty($res->project_cat_logo)){
					if(file_exists("images/projects_cat/$res->project_cat_logo")==true){
						$imglogo = img_webp("images/projects_cat/$res->project_cat_logo");
						$imglogo = "<img src=\"$imglogo\" class=\"c-center\" style=\"height:50px;width: auto;margin: 0 auto;\"/>";
					}else{
						$imglogo = "";
					}
				}else{
					$imglogo = "";
				}
				$imgcover = $this->getImgcover($project_cat_id);

				$data = "<div class=\"c-content-person-1 c-option-2\">
					<div class=\"c-caption c-content-overlay\">
						<img src=\"$imgcover\" class=\"img-responsive c-overlay-object\" alt=\"\">
					</div>
					<div class=\"c-body\">
						<div class=\"c-center\" >
							$imglogo
						</div>
						<div class=\"c-center\" style=\"margin-top:10px;\">
							<div class=\"c-name c-font-uppercase c-font-bold c-center\" style=\"font-size:25px;\">$project_cat_name</div>
						</div>
						<p class=\"c-center\" style=\"height:70px;\">
							$project_cat_shortdetail
						</p>
						<!--<div class=\"c-center\">
							<div class=\"c-name c-font-uppercase c-font-bold c-center\">test</div>
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


	public function getImgcover($id){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_projects_cat_gallery","where project_cat_id = '$id' and img_type='gallery' and is_cover=1 limit 0,1 ");
		$res = $qr->fetch_object();
		$num = $qr->num_rows;
		if($num>0){
			if(!empty($res->project_cat_img)){
				if(file_exists("images/projects_cat/$res->project_cat_img")){
					$img = img_webp("images/projects_cat/$res->project_cat_img");
				}else{
					$img = img_webp("images/noimg.png");
				}
			}else{
				$img = img_webp("images/noimg.png");
			}

			return $img;
		}else{
			$qr = $this->fetchdata("kp_projects_cat_gallery","where project_cat_id = '$id' and img_type='gallery' limit 0,1 ");
			$res = $qr->fetch_object();
			if(!empty($res->project_cat_img)){
				if(file_exists("images/projects_cat/$res->project_cat_img")){
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

	// end function past projects




}
?>
