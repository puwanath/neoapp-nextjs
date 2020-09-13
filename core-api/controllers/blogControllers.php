<?php
$param = "blog";
require "models/$param.php";

class blogController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar('In Ayutthaya');
		$bgcover = "$url/images/bgabout.jpg";
		$param = "blog";
		$model = new blogController;

		//================seo==================
		if($get_part0!='' and ($get_part0!='in-ayutthaya' and $get_part0!='House-knowledge')){
			putrating("kp_post","slug",$get_part0); //update static
			$active_blog = "c-active";
			$title = $this->getData('seo_title',$get_part0);
			$copyright = getcomp('companyname');
			$description = truncateStr(strip_tags($this->getData('seo_desc',$get_part0)),165,"");
			$keyword = getseo('seokeyword');
			$urlweb = $uri;
			$imageurl = $this->getData('imgtmp',$get_part0);

			$p = "views.php";
		}else{
			$active_blog = "c-active";
			$title = "$pagename | ".getseo('seotitle');
			$description = getseo('seodesc');
			$keyword = getseo('seokeyword');
			$urlweb = $uri;
			$imageurl = "$url/images/logo.png";

			$p = "index.php";
		}
		//===============seo===================
		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'search' :
				$model->searchData();
				break;

			case 'loaddatapost' :
				 $model->loadData();
				 break;

			default :
			$urlredirec = "welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}

		endif;

		//content detail
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


	public function getSlidepost($slug){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$word = new word();
		$arr = array();
		$qrslide = $this->fetchdata('kp_post',"where cat_id in (select cat_id from kp_cat_post where slug = '$slug') and status =1 and is_delete=0 order by postid desc limit 0,3 ");
		while($res = $qrslide->fetch_object()){

			if($_SESSION['lg']=='TH'){
				$imgname = $res->postname_th;
				$detail = truncateStr(strip_tags($res->postdetail_th),200,"...");
				$datepost = "วันที่ ".date("d/m/Y",strtotime($res->postdate));
				$cat_post = $this->getTextformid("kp_cat_post","cat_name_th","cat_id",$res->cat_id);
			}else{
				$imgname = $res->postname_en;
				$detail = truncateStr(strip_tags($res->postdetail_en),200,"...");
				$datepost = "Date ".date("d/m/Y",strtotime($res->postdate));
				$cat_post = $this->getTextformid("kp_cat_post","cat_name_en","cat_id",$res->cat_id);
			}
			$postid = $res->postid;
			$link = "$url/$res->slug";
			$img = $res->postimg;
			if(!empty($img)){
				$img_bg = img_webp("images/posts/$img");


				// $data = "<li data-transition=\"fade\" data-slotamount=\"1\" data-masterspeed=\"1000\">
				// 	<img alt=\"\" src=\"$img_bg\" data-bgposition=\"center center\" data-bgfit=\"cover\" data-bgrepeat=\"no-repeat\">";

				$data = "<li data-transition=\"zoomin\" data-slotamount=\"7\" data-easein=\"Power4.easeInOut\" data-easeout=\"Power4.easeInOut\" data-masterspeed=\"2000\" data-rotate=\"0\"  data-saveperformance=\"off\">
					<img alt=\"\" src=\"$img_bg\" data-bgposition=\"center center\" data-bgfit=\"cover\" data-bgrepeat=\"no-repeat\" data-kenburns=\"on\" data-duration=\"15000\" data-ease=\"Linear.easeNone\" data-scalestart=\"100\" data-scaleend=\"120\"
					data-rotatestart=\"0\" data-rotateend=\"0\" data-offsetstart=\"0 -500\" data-offsetend=\"0 500\" class=\"rev-slidebg\" data-no-retina>";

				$data.= "<div class=\"container\" data-elementdelay=\"0.2\" data-endelementdelay=\"0.2\" data-easing=\"Back.easeOut\"  data-speed=\"500\" data-start=\"1500\" data-transform_in=\"x:0;y:0;z:0;rotationX:0.5;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;s:500;e:Back.easeInOut;\"
						data-transform_out=\"x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;s:600;e:Back.easeInOut;\" >
			    <div class=\"row\">
			      <div class=\"col-md-6 col-xs-12\">

			      </div>
			      <div class=\"col-md-6 col-xs-12\">
			        <div class=\"c-feature-15-container project-cat-box-shortdetail\" data-elementdelay=\"0.2\" data-endelementdelay=\"0.2\" data-easing=\"Back.easeOut\"  data-speed=\"500\" data-start=\"1500\" data-transform_in=\"x:0;y:0;z:0;rotationX:0.5;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;s:500;e:Back.easeInOut;\"
									data-transform_out=\"x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;s:600;e:Back.easeInOut;\">
			          <h2 style=\"font-weight:bold;font-size:35px;color: #fff;text-shadow: 0.5px 0.5px 9px #000;\">$imgname</h2>
								<p style=\"font-size:18px;color:#fff;text-shadow: 0.5px 0.5px 9px #000;\">$datepost</p>
								<p><button type=\"button\" class=\"btn c-btn-yellow c-font-uppercase c-btn-circle c-btn-border-1x\">$cat_post</button></p>
			          <p style=\"font-size:18px;color:#fff;text-shadow: 0.5px 0.5px 9px #000;font-weight: 400;\">
								$detail
			          </p>
								<p><a href=\"$link\" class=\"btn c-btn-orange\" style=\"text-shadow: 0px 0px;\">".$word->wordvar('Read more')."</a></p>
			        </div>
			      </div>
			    </div>
			  </div>";


				$data.= "</li>";


				array_push($arr,$data);
			}
		}

		// return implode("",$arr);
		return $arr;
	}


	public function getGroup(){
		$arr = array();
		$url = curPageURL();
		$qr = $this->fetchdata("kp_cat_post","where status =1 order by cat_id asc");
		while($res = $qr->fetch_object()){
			$data = "<li role=\"presentation\"><a href=\"#\" class=\"item-group\" data-id=\"$res->cat_id\"><i class=\"fa fa-leaf\"></i> $res->cat_name_th</a></li>";
			array_push($arr,$data);
		}

		return "<ul class=\"nav nav-pills\">".implode('',$arr)."</ul>";
	}


	public function getData($fill,$id){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_post","where slug = '$id' and status = 1 and is_delete=0");
		$res = $qr->fetch_object();
		if($fill=="img"){
			if($res->postimg!=''){
				$img = "$url/images/posts/$res->postimg";
			}else{
				$img = "$url/images/no-image-box.png";
			}
			return $img;
		}elseif($fill=="imgtmp"){
			if($res->postimg!=''){
				$img = "$url/images/posts/tmp/$res->postimg";
			}else{
				$img = "$url/images/no-image-box.png";
			}
			return $img;
		}elseif($fill=="date"){
			return date("d M,Y",strtotime($res->create_date));
		}elseif($fill=="creater"){
			return $this->getCreator($res->user_create);
		}elseif($fill=="postname"){
			if($_SESSION['lg']=="TH"){$postname = $res->postname_th;}else{$postname = $res->postname_en;}
			return $postname;
		}elseif($fill=="detail"){
			if($_SESSION['lg']=="TH"){$postdetail = $res->postdetail_th;}else{$postdetail = $res->postdetail_en;}
			return $postdetail;
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
			$tag = explode(",",$res->posttag);
			foreach ($tag as $val) {
				// $datatag = "<span><a href=\"$url/in-ayutthaya?tags=$val\">$val</a></span> ";
				$datatag = "<li>$val</li>";
				array_push($arr2,$datatag);
			}
			
			$html = '<ul class="c-tags c-theme-ul-bg">';
			$html.= implode('',$arr2);;
			$html.= '</ul>';


			return $html;
		}else{
			return $res->$fill;
		}
	}


	public function loadData(){
		require 'econtrol/common/include/config.php';
		$url = curPageURL();
		$word = new word();
		$arr = array();
		$readData = $_GET;
		$cat_id = $readData['cat_id'];
		if(!empty($readData['limit'])){
			$limit0 = $readData['limit'];
			$limit1 = 6;
		}else{
			$limit0 = 0;
			$limit1 = 6;
		}


		$sql = "select * from kp_post ";
		$sql.= "where is_delete=0 and status = 1 and cat_id = '$cat_id' ";
		$sql.= "order by postid desc limit $limit0,$limit1";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$numrow = $qr->num_rows;
		if($numrow>0):
		while($res = $qr->fetch_object()){
			$postid = $res->postid;
			$slug = $res->slug;
			if($_SESSION['lg']=="TH"){
				$postname = $res->postname_th;
				$postdetail = truncateStr($res->postdetail_th,110);
				$cat_post = $this->getTextformid("kp_cat_post","cat_name_th","cat_id",$res->cat_id);
			}else{
				$postname = $res->postname_en;
				$postdetail = truncateStr($res->postdetail_en,110);
				$cat_post = $this->getTextformid("kp_cat_post","cat_name_en","cat_id",$res->cat_id);
			}
			$getcat_slug = $this->getTextformid("kp_cat_post","slug","cat_id",$cat_id);
			$link = "$url/$slug";
			$imgcover = $this->getImgcoverpost($postid);


			$data = "<div class=\"col-lg-4 col-sm-4 col-xs-12 c-content-person-1 c-option-2\" style=\"margin-top:30px;\">
				<a href=\"$link\">
				<div class=\"c-caption c-content-overlay img-project\">
					<img src=\"$imgcover\" class=\"img-responsive c-overlay-object\" style=\"height:100%;width:100%;\" alt=\"\">
				</div>
				<button type=\"button\" class=\"btn c-btn-bold c-btn-border-1x c-btn-circle\"
				style=\"z-index:999;position: absolute;
								top: 190px;
								left: 20px;
								padding: 0px 18px 0px 18px;
								background-color: #ffffffd4;\">$cat_post</button>
				<div class=\"c-body\" style=\"padding:15px;\">
					<div class=\"c-center\" style=\"margin-top:10px;\">
						<div class=\"c-name c-font-uppercase c-font-bold c-center\" style=\"font-size:18px;height:50px;\">$postname</div>
					</div>
					<p class=\"c-center\" style=\"height:60px;\">
						$postdetail
					</p>
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


	public function getImgcoverpost($id){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_post","where postid = '$id' limit 0,1 ");
		$res = $qr->fetch_object();
		$num = $qr->num_rows;
		if($num>0){
			if(!empty($res->postimg)){
				if(file_exists("images/posts/$res->postimg")==true){
					$img = img_webp("images/posts/$res->postimg");
				}else{
					$img = img_webp("images/noimg.png");
				}
			}else{
				$img = img_webp("images/noimg.png");
			}
			return $img;
		}else{
			$qr = $this->fetchdata("kp_post","where postid = '$id' limit 0,1 ");
			$res = $qr->fetch_object();
			if(!empty($res->postimg)){
				if(file_exists("images/posts/$res->postimg")==true){
					$img = img_webp("images/posts/$res->postimg");
				}else{
					$img = img_webp("images/noimg.png");
				}
			}else{
				$img = img_webp("images/noimg.png");
			}

			return $img;
		}
	}


	public function otherPost($gp0){
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata('kp_post',"where cat_id in (select cat_id from kp_post where slug = '$gp0' ) and slug!='$gp0' and status =1 and is_delete=0 order by create_date desc limit 0,6 ");
		while($res = $qr->fetch_object()){
			$postid = $res->postid;
			$slug = $res->slug;
			if($_SESSION['lg']=="TH"){
				$postname = truncateStr($res->postname_th,100);
				$postdetail = truncateStr($res->postdetail_th,150);
			}else{
				$postname = truncateStr($res->postname_en,100);
				$postdetail = truncateStr($res->postdetail_en,150);
			}

			$datecreate = date("d M,Y",strtotime($res->create_date));
			$create_by = $this->getCreator($res->user_create);
			if(file_exists("images/posts/tmp/$res->postimg")==true){
				$imgtmp = "$url/images/posts/tmp/$res->postimg";
			}else{
				$imgtmp = "$url/images/noimg.jpg";
			}
			$link = "$url/$slug";

			$data = '<div class="item">
				<div class="c-content-blog-post-card-1 c-option-2">
					<div class="c-media c-content-overlay" style="height:205px;overflow:hidden;">
						<div class="c-overlay-wrapper">
							<div class="c-overlay-content">
								<a href="'.$link.'"><i class="icon-link"></i></a>
							</div>
						</div>
						<img class="c-overlay-object img-responsive" src="'.$imgtmp.'" alt="'.$postname.'">
					</div>
					<div class="c-body">
						<div class="c-title c-font-uppercase c-font-bold">
							<a href="'.$link.'">'.$postname.'</a>
						</div>
						<div class="c-author">
							By <a href="#"><span class="c-font-uppercase">'.$create_by.'</span></a>
							on <span class="c-font-uppercase">'.$datecreate.'</span>
						</div>
						<p>
							'.$postdetail.'
						</p>
					</div>
				</div>
			</div>';

			array_push($arr,$data);
		}


		return implode('',$arr);
	}

	public function getCatpostname($id){
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
		$qr = $this->fetchdata("kp_post","where cat_id in (select cat_id from kp_post where postid = '".$id."' ) order by postid desc limit 0,5");
		while($res = $qr->fetch_object()){
			if($res->postimg!=''){
				$img = "$url/images/posts/$res->postimg?v=".STRTOTIME($res->create_date);
			}else{
				$img = "$url/images/no-image-box.png?v=".STRTOTIME($res->create_date);
			}
			$data = "<div class=\"post-thumb\">
				<a href=\"$url/blog/$res->postid/view/$res->slang\" class=\"post-thumb-link\">
				<div style=\"width:381px;height:250px;overflow:hidden;background-image:url($img);background-size:cover;background-repeat:no-repeat;background-position:center center;\"></div></a>
				<h3 class=\"post-title\"><a href=\"$url/blog/$res->postid/$res->slang\">$res->postname</a></h3>
			</div>";
			array_push($arr,$data);
		}

		return implode('',$arr).$catid;
	}


	public function getTag(){
		$arr = array();
		$arr2 = array();
		$url = curPageURL();
		$qr = $this->fetchdata("kp_post","where status =1");
		while($res = $qr->fetch_object()){
			$data = $res->postdetail;
			array_push($arr,$data);
		}
		$arrm = implode("",$arr);
		$tag = explode(",",$arrm);
		foreach ($tag as $val) {
			$datatag = "<a class=\"tg-btn\" href=\"$url/blog?tags=$val\">$val</a> ";
			array_push($arr2,$datatag);
		}
		return $arr2;
	}



}
?>
