<?php
$param = "news";
require "models/$param.php";

class newsController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$param = "news";
		$model = new newsController;

		//================seo==================
		if($get_part0!='' and $get_part0!='News-Activities'){
			putrating("kp_news","slug",$get_part0); //update static
			$active_news = "c-active";
			$title = $this->getData('seo_title',$get_part0);
			$copyright = getcomp('companyname');
			$description = truncateStr(strip_tags($this->getData('seo_desc',$get_part0)),165,"");
			$keyword = getseo('seokeyword');
			$urlweb = $uri;
			$imageurl = $this->getData('img',$get_part0);

			$p = "views.php";
		}else{
			$active_news = "c-active";
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

			case 'loaddatanews' :
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


	// function slide
	public function getSlidenews($slug){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$word = new word();
		$arr = array();
		$qrslide = $this->fetchdata('kp_news',"where type_id in (select type_id from kp_type_news where slug = '{$slug}') and status =1 and is_delete=0 order by newsdate desc limit 0,3 ");
		while($res = $qrslide->fetch_object()){

			if($_SESSION['lg']=='TH'){
				$imgname = $res->newstopic_th;
				$detail = truncateStr(strip_tags($res->newsdetail_th),200,"...");
				$datenews = "วันที่ ".date("d/m/Y",strtotime($res->newsdate));
				$type_news = $this->getTextformid("kp_type_news","type_name_th","type_id",$res->type_id);
			}else{
				$imgname = $res->newstopic_en;
				$detail = truncateStr(strip_tags($res->newsdetail_en),200,"...");
				$datenews = "Date ".date("d/m/Y",strtotime($res->newsdate));
				$type_news = $this->getTextformid("kp_type_news","type_name_en","type_id",$res->type_id);
			}
			$newsdate = $res->newsdate;
			$link = "$url/$res->slug";
			$img = $res->newsimg;

			if(!empty($img)){
				$img_bg = img_webp("images/news/$img");


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
								<p style=\"font-size:18px;color:#fff;text-shadow: 0.5px 0.5px 9px #000;\">$datenews</p>
								<p><button type=\"button\" class=\"btn c-btn-yellow c-font-uppercase c-btn-circle c-btn-border-1x\">$type_news</button></p>
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

		return $arr;
	}

	// end function slide



	public function getData($fill,$id){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_news","where slug = '$id' and status = 1 and is_delete=0 ");
		$res = $qr->fetch_object();
		$newsid = $res->newsid;
		if($fill=="img"){
			if($res->newsimg!=''){
				$img = "$url/images/news/$res->newsimg";
			}else{
				$img = "$url/images/noimg.png";
			}
			return $img;
		}elseif($fill=="imgtmp"){
			if($res->newsimg!=''){
				$img = "$url/images/news/tmp/$res->newsimg";
			}else{
				$img = "$url/images/noimg.png";
			}
			return $img;
		}elseif($fill=='imggall'){
			$arrgall = array();

			if($res->newsimg!=''){
				$img = "$url/images/news/$res->newsimg";
			}else{
				$img = "$url/images/noimg.png";
			}
			$datagall = '<div class="item">
				<div class="c-content-media-2" style="background-image: url('.$img.'); min-height: 460px;">
				</div>
			</div>';
			array_push($arrgall,$datagall);

			$qrgall = $this->fetchdata("kp_news_img","where newsid = '$newsid' order by sort asc ");
			while($resgall = $qrgall->fetch_object()){
				if($res->newsimg!=''){
					$img = "$url/images/news/$resgall->newsimg";
				}else{
					$img = "$url/images/noimg.png";
				}
				$datagall = '<div class="item">
					<div class="c-content-media-2" style="background-image: url('.$img.'); min-height: 460px;">
					</div>
				</div>';
				array_push($arrgall,$datagall);
			}

			return implode('',$arrgall);
		}elseif($fill=="date"){
			return date("d M,Y",strtotime($res->newsdate));
		}elseif($fill=="creater"){
			return $this->getCreator($res->user_create);
		}elseif($fill=="newstopic"){
			if($_SESSION['lg']=="TH"){$topicname = $res->newstopic_th;}else{$topicname = $res->newstopic_en;}
			return $topicname;
		}elseif($fill=="detail"){
			if($_SESSION['lg']=="TH"){$newsdetail = $res->newsdetail_th;}else{$newsdetail = $res->newsdetail_en;}
			return $newsdetail;
		}elseif($fill=="dd"){
			return $dd = date("d",STRTOTIME($res->newsdate));
		}elseif($fill=="mm"){
			return $mm = date("M",STRTOTIME($res->newsdate));
		}elseif($fill=="mmdd"){
			return $mm = date("M",STRTOTIME($res->newsdate)).date("d",STRTOTIME($res->newsdate));;
		}elseif($fill=="yy"){
			return $yy = date("Y",STRTOTIME($res->newsdate));
		}elseif($fill=="tags"){
			$arr2 = array();
			$tag = explode(",",$res->newstag);
			foreach ($tag as $val) {
				// $datatag = "<span><a href=\"$url/news?tags=$val\">$val</a></span> ";
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
		$type_id = $readData['type_id'];
		$year = $readData['year'];
		$month = $readData['month'];
		if(!empty($readData['limit'])){
			$limit0 = $readData['limit'];
			$limit1 = 6;
		}else{
			$limit0 = 0;
			$limit1 = 6;
		}


		$sql = "select * from kp_news ";
		$sql.= "where is_delete=0 and status = 1 and type_id = '$type_id' ";
		if(!empty($readData['year'])){
			$sql.= "and YEAR(newsdate) = '$year' ";
		}
		if(!empty($readData['year'])){
			$sql.= "and MONTH(newsdate) = '$month' ";
		}
		$sql.= "order by newsdate desc limit $limit0,$limit1";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$numrow = $qr->num_rows;
		if($numrow>0):
		while($res = $qr->fetch_object()){
			$newsid = $res->newsid;
			$slug = $res->slug;
			if($_SESSION['lg']=="TH"){
				$newsname = $res->newstopic_th;
				$newsdetail = truncateStr($res->newsdetail_th,110);
				$type_id = $this->getTextformid("kp_type_news","type_name_th","type_id",$res->type_id);
			}else{
				$newsname = $res->newstopic_en;
				$newsdetail = truncateStr($res->newsdetail_en,110);
				$type_id = $this->getTextformid("kp_type_news","type_name_en","type_id",$res->type_id);
			}
			$getcat_slug = $this->getTextformid("kp_type_news","slug","type_id",$type_id);
			$link = "$url/$slug";
			$imgcover = $this->getImgcovernews($newsid);


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
								background-color: #ffffffd4;\">$type_id</button>
				<div class=\"c-body\" style=\"padding:15px;\">
					<div class=\"c-center\" style=\"margin-top:10px;\">
						<div class=\"c-name c-font-uppercase c-font-bold c-center\" style=\"font-size:18px;height:50px;\">$newsname</div>
					</div>
					<p class=\"c-center\" style=\"height:60px;\">
						$newsdetail
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

	public function otherNews($gp0){
		$word = new word();
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata('kp_news',"where type_id in (select type_id from kp_news where slug = '$gp0' ) and slug!='$gp0' and status =1 and is_delete=0 order by newsdate desc limit 0,6 ");
		while($res = $qr->fetch_object()){
			$newsid = $res->newsid;
			$slug = $res->slug;
			if($_SESSION['lg']=="TH"){
				$topicname = truncateStr($res->newstopic_th,100);
				$newsdetail = truncateStr($res->newsdetail_th,150);
			}else{
				$topicname = truncateStr($res->newstopic_en,100);
				$newsdetail = truncateStr($res->newsdetail_en,150);
			}

			$datecreate = date("d M,Y",strtotime($res->newsdate));
			$create_by = $this->getCreator($res->user_create);
			if(file_exists("images/news/tmp/$res->newsimg")==true){
				$imgtmp = "$url/images/news/tmp/$res->newsimg";
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
						<img class="c-overlay-object img-responsive" src="'.$imgtmp.'" alt="'.$topicname.'">
					</div>
					<div class="c-body">
						<div class="c-title c-font-uppercase c-font-bold">
							<a href="'.$link.'">'.$topicname.'</a>
						</div>
						<div class="c-author">
							By <a href="#"><span class="c-font-uppercase">'.$create_by.'</span></a>
							on <span class="c-font-uppercase">'.$datecreate.'</span>
						</div>
						<p>
							'.$newsdetail.'
						</p>
					</div>
				</div>
			</div>';

			array_push($arr,$data);
		}


		return implode('',$arr);
	}


	public function getImgcovernews($id){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_news","where newsid = '$id' limit 0,1 ");
		$res = $qr->fetch_object();
		$num = $qr->num_rows;
		if($num>0){
			if(!empty($res->newsimg)){
				if(file_exists("images/news/$res->newsimg")==true){
					$img = img_webp("images/news/$res->newsimg");
				}else{
					$img = img_webp("images/noimg.png");
				}
			}else{
				$img = img_webp("images/noimg.png");
			}
			return $img;
		}else{
			$qr = $this->fetchdata("kp_news","where newsid = '$id' limit 0,1 ");
			$res = $qr->fetch_object();
			if(!empty($res->newsimg)){
				if(file_exists("images/news/$res->newsimg")==true){
					$img = img_webp("images/news/$res->newsimg");
				}else{
					$img = img_webp("images/noimg.png");
				}
			}else{
				$img = img_webp("images/noimg.png");
			}

			return $img;
		}
	}

	public function getYearfromnews(){
		require 'econtrol/common/include/config.php';
		$arr = array();

		$sql = "select DISTINCT YEAR(newsdate) as yearnews from kp_news where is_delete=0 order by yearnews DESC";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res = $qr->fetch_object()){
			$year = $res->yearnews;
			$data = "<option value='$year'>$year</option>";
			array_push($arr,$data);
		}

		return implode('',$arr);
	}

	public function getMonthfromnews(){
		require 'econtrol/common/include/config.php';
		$arr = array();
		$month_arr = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');

		$sql = "select DISTINCT MONTH(newsdate) as monthnews from kp_news where is_delete=0 order by monthnews DESC";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res = $qr->fetch_object()){
			$month = $res->monthnews;
			$monthname = $month_arr[$month-1];
			$data = "<option value='$month'>$monthname</option>";
			array_push($arr,$data);
		}

		return implode('',$arr);
	}

	public function getCatnewstopic($id){
		$qr = $this->fetchdata("kp_type_news","where type_id = '$id'");
		$res = $qr->fetch_object();

		if($_SESSION['lg']=='TH'){
			$name = $res->type_name_th;
		}else{
			$name = $res->type_name_en;
		}

		return $name;
	}

	public function getCatnewstopictitle($id){
		$qr = $this->fetchdata("kp_type_news","where type_id in (select type_id from kp_news where newsid = '$id')");
		$res = $qr->fetch_object();

		if($_SESSION['lg']=='TH'){
			$name = $res->type_name_th;
		}else{
			$name = $res->type_name_en;
		}

		return $name;
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
		$qr = $this->fetchdata("kp_news","where type_id in (select type_id from kp_news where newsid = '".$id."' ) order by newsid desc limit 0,5");
		while($res = $qr->fetch_object()){
			if($res->newsimg!=''){
				$img = "$url/images/news/$res->newsimg?v=".STRTOTIME($res->create_date);
			}else{
				$img = "$url/images/noimg.png?v=".STRTOTIME($res->create_date);
			}
			$data = "<div class=\"post-thumb\">
				<a href=\"$url/news/$res->newsid/view/$res->slang\" class=\"post-thumb-link\">
				<div style=\"width:381px;height:250px;overflow:hidden;background-image:url($img);background-size:cover;background-repeat:no-repeat;background-position:center center;\"></div></a>
				<h3 class=\"post-title\"><a href=\"$url/news/$res->newsid/$res->slang\">$res->newstopic</a></h3>
			</div>";
			array_push($arr,$data);
		}

		return implode('',$arr).$catid;
	}


	public function getTag(){
		$arr = array();
		$arr2 = array();
		$url = curPageURL();
		$qr = $this->fetchdata("kp_news","where status =1");
		while($res = $qr->fetch_object()){
			$data = $res->postdetail;
			array_push($arr,$data);
		}
		$arrm = implode("",$arr);
		$tag = explode(",",$arrm);
		foreach ($tag as $val) {
			$datatag = "<a class=\"tg-btn\" href=\"$url/news?tags=$val\">$val</a> ";
			array_push($arr2,$datatag);
		}
		return $arr2;
	}


}
?>
