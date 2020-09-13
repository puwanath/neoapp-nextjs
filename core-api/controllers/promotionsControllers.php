<?php
$param = "promotions";
require "models/$param.php";

class promotionsController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar('Promotions');
		$bgcover = "$url/images/bgabout.jpg";
		$param = "promotions";
		$active_promotion = "c-active";
		$model = new promotionsController;

		//================seo==================
		if($get_part0!='promotions' and $get_part0!=''){
			putrating("kp_promotions","slug",$get_part0); //update static
			$current_promotions = "active";
			$title = $this->getData('seo_title',$get_part0);
			$copyright = getcomp('companyname');
			$description = truncateStr(strip_tags($this->getData('seo_desc',$get_part0)),165,"");
			$keyword = $this->getData('seo_keyword',$get_part0);
			$urlweb = $uri;
			$imageurl = $this->getData('imgtmp',$get_part0);
			$urlredirect_register = $uri."?registersuccess";
		}else{
			$current_promotions = "active";
			$title = "$pagename | ".getseo('seotitle');
			$description = getseo('seodesc');
			$keyword = getseo('seokeyword');
			$urlweb = $uri;
			$imageurl = "$url/images/logo.png";
		}
		//===============seo===================
		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				$model->loadData();
				break;

			default :
			$urlredirec = "welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}
		endif;

		// begin css and js
		$cssarr = array(
			"<script src='".$dir."countdown-js/jquery.countdown.js'></script>",
		);

		$jsarr = array(
			"<link href='".$dir."sweetalert2-8.18.5/dist/sweetalert2.min.css' rel='stylesheet' type='text/css' />",
			"<script src='".$dir."sweetalert2-8.18.5/dist/sweetalert2.min.js'></script>",
		);
		//end css and js script

		//content detail
		if($get_part0!='promotions' and $get_part0!=''){
			$p = "views.php";
		}else{
			$p = "index.php";
		}
		$content = array(
			"views/$param/$p"
		);
		//end content
		if($select==''){
			$layout = "views/$param/layout.php";
			$page = include("views/layout/template.php");
			return json_encode($page);
		}
	}


	public function getBannerslide($slugid){
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$arrdot = array();
		$datenow = date("Y-m-d");
		$i = 0;
		if(!empty($slugid)){
			$qr = $this->fetchdata("kp_promotions","where is_delete=0 and status =1 and lower(slug) = lower('$slugid') ");
		}else{
			$qr = $this->fetchdata("kp_promotions","where is_delete=0 and status =1 and ('$datenow' between promotion_start_date and promotion_end_date) order by promotion_start_date desc limit 0,6");
		}
		while($res = $qr->fetch_object()){
			$promotion_id = $res->promotion_id;
			$slug = $res->slug;
			if($_SESSION['lg']=="TH"){
				$promotion_name = $res->promotion_name_th;
				$promotion_detail = truncateStr($res->promotion_detail_th,150);
			}else{
				$promotion_name = $res->promotion_name_en;
				$promotion_detail = truncateStr($res->promotion_detail,150);
			}

			$date_start = date("d M Y",strtotime($res->promotion_start_date));
			$date_end = date("d M Y",strtotime($res->promotion_end_date));
			$date_text = $date_start.' - '.$date_end;

			$getdevice = detectDevice();
			if($getdevice=="Computer"){
				$img = $res->promotion_cover;
			}elseif($getdevice=="Tablet"){
				$img = $res->promotion_cover_tablet;
			}elseif($getdevice=="Mobile"){
				$img = $res->promotion_cover_mobile;
			}else{
				$img = $res->promotion_cover;
			}

			if(!empty($img)){
				$imgcover = img_webp("images/promotions/$img");
				$link = "$url/$slug";

				if($i==0){
					$active = 'active';
				}else{
					$active = '';
				}

				$data = '<div class="item '.$active.'">
									<img alt="'.$promotion_name.'" data-src="'.$imgcover.'" src="'.$imgcover.'" data-holder-rendered="true">
						      <div class="carousel-caption hidden-xs">
						        <a href="'.$link.'"><h2 style="color: #f37125;">'.$promotion_name.'</h2></a>
						        <p style="color:#333;">'.$promotion_detail.'</p>
						      </div>
						    </div>';
				$datadot = '<li data-target="#carousel-example-captions" data-slide-to="'.$i.'" class="'.$active.'"></li>';
				array_push($arr,$data);
				array_push($arrdot,$datadot);
				$i++;

			}
		}

		$html = '<ol class="carousel-indicators">';
		$html.= implode('',$arrdot);
		$html.= '</ol>';
		$html.= '<div class="carousel-inner" role="listbox">';
		$html.= implode('',$arr);
		$html.= '</div>';

		return $html;
	}

	public function getData($fill,$id){
		$url = curPageURL();
		$word = new word();
		$qr = $this->fetchdata("kp_promotions","where slug = '$id' and status = 1 and is_delete = 0");
		$res = $qr->fetch_object();
		if($fill=="img"){
			if($res->promotion_cover!=''){
				$img = img_webp("images/promotions/$res->promotion_cover");
			}else{
				$img = img_webp("images/no-image-box.png");
			}
			return $img;
		}elseif($fill=="imgtmp"){
			if($res->promotion_img!=''){
				$img = img_webp("images/promotions/tmp/$res->promotion_img");
			}else{
				$img = img_webp("images/no-image-box.png");
			}
			return $img;
		}elseif($fill=="imgbig"){
			if($res->promotion_img!=''){
				$img = img_webp("images/promotions/$res->promotion_img");
			}else{
				$img = img_webp("images/no-image-box.png");
			}
			return '<img src="'.$img.'" class="img-responsive" style="margin:auto;"/>';
		}elseif($fill=="date"){
			return date("d M,Y",strtotime($res->create_date));
		}elseif($fill=="start_date"){
			return date("d M,Y",strtotime($res->promotion_start_date));
		}elseif($fill=="end_date"){
			return date("d M,Y",strtotime($res->promotion_end_date));
		}elseif($fill=="end_date_countdown"){
			$date = DateTime::createFromFormat('Y-m-d', "$res->promotion_end_date");
			$date->modify('+1 day');
			return $date->format('Y/m/d');
		}elseif($fill=="end_date_check"){
			return date("Y-m-d",strtotime($res->promotion_end_date));

		}elseif($fill=="condition"){
			if($_SESSION['lg']=='TH'){
				$condition = $res->promotion_condition_th;
			}else{
				$condition = $res->promotion_condition_en;
			}
			$html = '<dl class="dl-horizontal">
				<dt>'.$word->wordvar('the condition').'</dt>
				<dd>'.$condition.'</dd>
			</dl>';

			return $html;

		}elseif($fill=="projects"){
			if(!empty($res->project_cat_id)){
				$project_cat_id = $res->project_cat_id;
				$qrprojects = $this->fetchdata("kp_projects_cat","where project_cat_id = '$project_cat_id' ");
				$resprojects = $qrprojects->fetch_object();

				$arr_facility = array();
				if($_SESSION['lg']=='TH'){
					$project_cat_name = $resprojects->project_cat_name_th;
					$location = $this->getTextformid('kp_projects_location','location_name_th','location_id',$resprojects->location_id);
					$project_cat_detail = $resprojects->project_cat_detail_th;
					$qrfacility = $this->fetchdata("kp_projects_cat_facilities","where project_cat_id = '$project_cat_id' ");
					while($resfacility = $qrfacility->fetch_object()){
						$facility_name = $resfacility->fac_name_th;
						array_push($arr_facility,$facility_name);
					}
					$fac_name = implode(',',$arr_facility);
				}else{
					$project_cat_name = $resprojects->project_cat_name_en;
					$location = $this->getTextformid('kp_projects_location','location_name_en','location_id',$resprojects->location_id);
					$project_cat_detail = $resprojects->project_cat_detail_en;
					$qrfacility = $this->fetchdata("kp_projects_cat_facilities","where project_cat_id = '$project_cat_id' ");
					while($resfacility = $qrfacility->fetch_object()){
						$facility_name = $resfacility->fac_name_en;
						array_push($arr_facility,$facility_name);
					}
					$fac_name = implode(',',$arr_facility);
				}


				$html = '<dl class="dl-horizontal">
				  <dt>'.$word->wordvar('Project Name').'</dt>
				  <dd>'.$project_cat_name.'</dd>
				  <dt>'.$word->wordvar('Location').'</dt>
				  <dd>'.$location.'</dd>
				  <dt>'.$word->wordvar('Description').'</dt>
				  <dd>'.$project_cat_detail.'</dd>
				  <dt>'.$word->wordvar('facilities').'</dt>
				  <dd>'.$fac_name.'</dd>
				</dl>';

			}
			return $html;

		}elseif($fill=="creater"){
			return $this->getCreator($res->user_create);
		}elseif($fill=="promotion_name"){
			if($_SESSION['lg']=="TH"){$promotion_name = $res->promotion_name_th;}else{$promotion_name = $res->promotion_name_en;}
			return $promotion_name;
		}elseif($fill=="detail"){
			if($_SESSION['lg']=="TH"){$promotion_detail = $res->promotion_detail_th;}else{$promotion_detail = $res->promotion_detail_en;}
			return $promotion_detail;
		}elseif($fill=="condition"){
			if($_SESSION['lg']=="TH"){$promotion_condition = $res->promotion_condition_th;}else{$promotion_condition = $res->promotion_condition_en;}
			return $promotion_condition;
		}elseif($fill=="dd"){
			return $dd = date("d",STRTOTIME($res->create_date));
		}elseif($fill=="mm"){
			return $mm = date("M",STRTOTIME($res->create_date));
		}elseif($fill=="mmdd"){
			return $mm = date("M",STRTOTIME($res->create_date)).date("d",STRTOTIME($res->create_date));;
		}elseif($fill=="yy"){
			return $yy = date("Y",STRTOTIME($res->create_date));
		}elseif($fill=="tags"){
			$arr2 = array();
			$tag = explode(",",$res->seo_keyword);
			foreach ($tag as $val) {
				$datatag = "<span><a href=\"$url/promotions?tags=$val\">$val</a></span> ";
				array_push($arr2,$datatag);
			}
			return implode('',$arr2);
		}else{
			return $res->$fill;
		}
	}


	public function loadData(){
		require 'econtrol/common/include/config.php';
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$readData = $_GET;
		if(!empty($readData['limit'])){
			$limit0 = $readData['limit'];
			$limit1 = 6;
		}else{
			$limit0 = 0;
			$limit1 = 6;
		}

		$qr = $this->fetchdata('kp_promotions',"where status =1 and is_delete=0 order by create_date desc limit $limit0,$limit1 ");
		$numrow = $qr->num_rows;
		if($numrow>0):
			while($res = $qr->fetch_object()){
				$promotion_id = $res->promotion_id;
				$slug = $res->slug;
				if($_SESSION['lg']=="TH"){
					$promotion_name = $res->promotion_name_th;
					$promotion_detail = truncateStr($res->promotion_detail_th,150);
				}else{
					$promotion_name = $res->promotion_name_en;
					$promotion_detail = truncateStr($res->promotion_detail,150);
				}

				$date_start = date("d M Y",strtotime($res->promotion_start_date));
				$date_end = date("d M Y",strtotime($res->promotion_end_date));
				$date_text = $date_start.' - '.$date_end;

				$datecreate = date("d/m/Y",strtotime($res->create_date));
				$create_by = $this->getCreator($res->user_create);
				if(file_exists("images/promotions/tmp/$res->promotion_img")==true){
					$imgtmp = img_webp("images/promotions/tmp/$res->promotion_img");
				}else{
					$imgtmp = img_webp("images/noimg.png");
				}
				$link = "$url/$slug";

				$data = "<div class=\"col-lg-4 col-sm-6 col-xs-12 c-content-person-1 c-option-2\" style=\"margin-top:30px;\">
					<a href=\"$link\">
					<div class=\"c-caption c-content-overlay\" style=\"height: 220px;\">
						<img src=\"$imgtmp\" class=\"img-responsive c-overlay-object\" style=\"height:100%;width:100%;\" alt=\"\">
					</div>
					<div class=\"c-body\" style=\"padding:10px;\">
						<div class=\"c-center\">
							<div class=\"c-name c-font-uppercase c-font-bold c-center\">$promotion_name</div>
						</div>
						<!--
						<p class=\"c-center\" style=\"height:60px;\">
							$promotion_detail
						</p>-->
						<div class=\"c-center\">
							<div class=\"c-name c-font-uppercase c-font-bold c-center\" style=\"color:#de6527;\"> $date_text </div>
						</div>
						<div class=\"c-center\">
							<a href=\"$link\" class=\"btn c-btn-orange\">".$word->wordvar('View Detail')."</a>
						</div>
					</div>
					</a>
				</div>";
				array_push($arr,$data);
			}

			$limit_next = $limit0+$limit1;
			$alldatapage = $numrow;
			$output = array();
			$output['datahtml'] = implode('',$arr);
			$output['limitnum'] = $limit_next;
			$output['alldatapage'] = $alldatapage;
		else:
			$limit_next = $limit0+$limit1;
			$output = array();
			$output['datahtml'] = '<div class="col-lg col-lg-12 col-sm-12 col-xs-12 c-center" style="margin-top:30px;">'.$word->wordvar('The information you are looking for cannot be found.').'</div>';
			$output['limitnum'] = 6;
			$output['alldatapage'] = 0;
		endif;

		echo json_encode($output);
	}


	public function relatedPost($id,$gp1){
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata('kp_promotions',"where cat_id in (select cat_id from kp_promotions where promotion_id = '$id' ) and promotion_id!='$id' and status =1 order by create_date desc limit 0,2 ");
		while($res = $qr->fetch_object()){

			if($_SESSION['lg']=="TH"){
				$promotion_name = truncateStr($res->promotion_name_th,100);
				$promotion_detail = truncateStr($res->promotion_detail_th,150);
			}else{
				$promotion_name = truncateStr($res->promotion_name_en,100);
				$promotion_detail = truncateStr($res->promotion_detail,150);
			}

			$datecreate = date("d/m/Y",strtotime($res->create_date));
			$create_by = $this->getCreator($res->user_create);
			if(file_exists("images/promotions/tmp/$res->promotion_cover")==true){
				$imgtmp = "$url/images/promotions/tmp/$res->promotion_cover";
			}else{
				$imgtmp = "$url/images/noimg.jpg";
			}
			$link = "$url/$gp1/view/$res->promotion_id/$promotion_name";

			$data = "<div class=\"col-sm-6\">
				<div class=\"tt-promotions-thumb\">
					<div class=\"tt-img\"><a href=\"$link\" target=\"_blank\"><img src=\"$imgtmp\" data-src=\"$imgtmp\" alt=\"\"></a></div>
					<div class=\"tt-title-description\">
						<div class=\"tt-background\"></div>
						<div class=\"tt-title\">
							<a href=\"$link\">$promotion_name</a>
						</div>
					</div>
				</div>
			</div>";

			array_push($arr,$data);
		}


		return implode('',$arr);
	}

	public function getCatpromotion_name($id){
		$qr = $this->fetchdata("kp_cat_post","where cat_id = '$id'");
		$res = $qr->fetch_object();

		return $res->cat_name_th;
	}

	public function getCreator($id){
		if(substr($id,0,1)=="M"){
			$qr = $this->fetchdata("kp_members","where member_id = '$id' ");
			$res = $qr->fetch_object();

			return $res->member_name;
		}else{
			$qr = $this->fetchdata("kp_users","where user_id = '$id' ");
			$res = $qr->fetch_object();

			return $res->user_fullname;
		}
	}

	public function recentPost($id){
		$arr = array();
		$url = curPageURL();
		$qr = $this->fetchdata("kp_promotions","where cat_id in (select cat_id from kp_promotions where promotion_id = '".$id."' ) order by promotion_id desc limit 0,5");
		while($res = $qr->fetch_object()){
			if($res->promotion_cover!=''){
				$img = "$url/images/promotions/$res->promotion_cover?v=".STRTOTIME($res->create_date);
			}else{
				$img = "$url/images/no-image-box.png?v=".STRTOTIME($res->create_date);
			}
			$data = "<div class=\"post-thumb\">
				<a href=\"$url/promotions/$res->promotion_id/view/$res->slang\" class=\"post-thumb-link\">
				<div style=\"width:381px;height:250px;overflow:hidden;background-image:url($img);background-size:cover;background-repeat:no-repeat;background-position:center center;\"></div></a>
				<h3 class=\"post-title\"><a href=\"$url/promotions/$res->promotion_id/$res->slang\">$res->promotion_name</a></h3>
			</div>";
			array_push($arr,$data);
		}

		return implode('',$arr).$catid;
	}

	public function tabPost($type){
		$arr = array();
		$url = curPageURL();
		if($type=="pop"){
			$qr = $this->fetchdata("post","where status =1 order by rating desc limit 0,5");
		}else{
			$qr = $this->fetchdata("post","where status =1 order by create_date desc limit 0,5");
		}

		while($res = $qr->fetch_object()){
			$promotion_name = truncateStr($res->promotion_name,"50","...");
			$verimg = strtotime($res->create_date);
			if(file_exists("images/promotions/$res->promotion_cover")){
				$img = "$url/images/promotions/$res->promotion_cover?v=$verimg";
			}else{
				$img = "$url/images/nopic.jpg?v=$verimg";
			}
			$catname = $this->getCatpromotion_name($res->cat_id);
			$postdate = date("d,M Y",strtotime($res->create_date));
			$counting = $res->rating;
			$creator = $this->getCreator($res->user_create);

			$data = "<article class=\"tg-theme-post tg-category-small\">
        <figure>
          <a href=\"$url/promotions/$res->promotion_id/view/$res->slang\">
					<div style=\"width:70px;height:70px;background-image:url($img);
					background-repeat:no-repeat;background-position:center center;
					background-size:cover;\"></div></a>
        </figure>
        <div class=\"tg-postdata\">
          <h3><a href=\"$url/promotions/$res->promotion_id/view/$res->slang\">$promotion_name</a></h3>
          <ul class=\"tg-postmetadata\">
            <li>
              <a href=\"#\">
                <i class=\"fa fa-clock-o\"></i>
                <span>$postdate</span>
              </a>
            </li>
          </ul>
        </div>
      </article>";
			array_push($arr,$data);

		}
		return $arr;
	}

	public function mostpromotions(){
		$arr = array();
		$url = curPageURL();
		$qr = $this->fetchdata("type_promotions","where status =1 order by sort asc");
		while($res = $qr->fetch_object()){
			$data = "<div class=\"item\">";
			$promotions = $this->fetchdata("promotions","where status =1 and typeid = '$res->type_id' order by rating desc limit 0,5");
			while($respromotions = $promotions->fetch_object()){
				$promotionsname = truncateStr($respromotions->promotion_name,"80","...");
				$verimg = strtotime($respromotions->create_date);
				if(file_exists("images/promotions/$respromotions->promotion_cover")){
					$img = "$url/images/promotions/$respromotions->promotion_cover?v=$verimg";
				}else{
					$img = "$url/images/nopic.jpg?v=$verimg";
				}
				$create_date = date("d,M Y",strtotime($respromotions->create_date));
				$data.="<article class=\"tg-theme-post tg-category-small\">
	        <figure>
						<div style=\"width:70px;height:70px;background-image:url($img);
						background-repeat:no-repeat;background-position:center center;
						background-size:cover;\"></div>
	        </figure>
	        <div class=\"tg-postdata\">
	          <h3><a href=\"$url/promotions/$respromotions->promotionsid/view/$respromotions->slang\">$promotionsname</a></h3>
	          <ul class=\"tg-postmetadata\">
	            <li>
	              <a href=\"$url/promotions/$respromotions->promotionsid/view/$respromotions->slang\">
	                <i class=\"fa fa-clock-o\"></i>
	                <span>$create_date</span>
	              </a>
	            </li>
	          </ul>
	        </div>
	      </article>";
			}
			$data.= "</div>";
			array_push($arr,$data);
		}

		return $arr;
	}

	public function getTag(){
		$arr = array();
		$arr2 = array();
		$url = curPageURL();
		$qr = $this->fetchdata("kp_promotions","where status =1");
		while($res = $qr->fetch_object()){
			$data = $res->promotion_detail;
			array_push($arr,$data);
		}
		$arrm = implode("",$arr);
		$tag = explode(",",$arrm);
		foreach ($tag as $val) {
			$datatag = "<a class=\"tg-btn\" href=\"$url/promotions?tags=$val\">$val</a> ";
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
