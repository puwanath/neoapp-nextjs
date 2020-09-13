<?php
$param = "products";
require "models/$param.php";

class productsController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$url2 = curPageURL2();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar("products");
		$bgcover = "$url/images/bgabout.jpg";
		$param = "products";
		$active_allproject = "c-active";
		$model = new productsController;

		if($get_part0!='products' and $get_part0!=''){
			putrating("kp_projects","slug",$get_part0); //update static
			$current_promotions = "active";
			$title = $this->getData('seo_title',$get_part0);
			$copyright = getcomp('companyname');
			$description = truncateStr(strip_tags($this->getData('seo_desc',$get_part0)),165,"");
			$keyword = $this->getData('seo_keyword',$get_part0);
			$urlweb = $uri;
			$imageurl = $this->getData('imgtmp',$get_part0);
			$project_cat_name = $this->getData('project_cat_name',$get_part0);
			$link_project_cat = $this->getData('link_project_cat',$get_part0);
			$urlredirect_register = $uri."?registersuccess";

			$p = "view.php";
		}else{
			$current_promotions = "active";
			$title = "$pagename | ".getseo('seotitle');
			$description = getseo('seodesc');
			$keyword = getseo('seokeyword');
			$urlweb = $uri;
			$imageurl = "$url/images/logo.png";

			$p = "index.php";
		}

		//content detail

		$content = array(
		"views/$param/$p"
		);
		//end content

		// begin css and js
		$cssarr = array(
			"<link rel='stylesheet' href='".$dir."gallery-master/css/blueimp-gallery.min.css'>",
			"<link rel='stylesheet' href='".$dir."popup/styles_popup.css'>",
			"<link rel='stylesheet' href='".$dir."my-icons/font/flaticon.css'>",
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
				document.getElementById('links2').onclick = function (event) {
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

			case 'register' :
				$model->sendRegister();
				break;

			case 'send' :
				$model->sendMail();
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


	// products zone
	public function getSlide($id){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata('kp_projects',"where project_id = '$id' and status = 1 ");
		$res = $qr->fetch_object();
		$qrslide = $this->fetchdata('kp_projects_gallery',"where project_id = '$id' and img_type = 'gallery' order by sort asc");
		while($resgall = $qrslide->fetch_object()){
			if(file_exists("images/projects/$resgall->project_img")==true){
				$img = "$url/images/projects/$resgall->project_img";

			if($_SESSION['lg']=='TH'){
				$imgname = $res->project_name_th;
				$detail = $res->project_shortdetail_th;
			}else{
				$imgname = $res->project_name_en;
				$detail = $res->project_shortdetail_en;
			}

			$data = "<li data-thumb=\"$img\" data-transition=\"fade\" data-slotamount=\"1\" data-masterspeed=\"1000\" data-saveperformance=\"off\"  data-title=\"$imgname\">
				<img src=\"$img\"  alt=\"$imgname\"  data-bgposition=\"center center\" data-bgfit=\"cover\" data-bgrepeat=\"no-repeat\" >
				<div class=\"tp-caption tp-caption1 lft stb\"
					data-x=\"center\"
					data-y=\"center\"
					data-hoffset=\"0\"
					data-voffset=\"-150\"
					data-speed=\"600\"
					data-start=\"900\"
					data-easing=\"Power4.easeOut\"
					data-endeasing=\"Power4.easeIn\">
				</div>
			</li>";
			array_push($arr,$data);
			}

		}

		if(count($arr)>0){
			$datahtml = "<div class=\"slider-revolution revolution-default\">";
				$datahtml.= "<div class=\"tp-banner-container\">";
					$datahtml.= "<div class=\"tp-banner revolution\">";
						$datahtml.= "<ul>";
							$datahtml.= implode('',$arr);
						$datahtml.= "</ul>";
					$datahtml.= "</div>";
				$datahtml.= "</div>";
			$datahtml.= "</div>";
			return $datahtml;
		}else{
			return false;
		}
	}

	public function getData($fill,$id){
		$url = curPageURL();
		$word = new word();
		$qr = $this->fetchdata("kp_projects","where slug = '$id' ");
		$res = $qr->fetch_object();
		$project_id = $res->project_id;
		$project_cat_id = $res->project_cat_id;
		if($_SESSION['lg']=='TH'){
			$project_name = $res->project_name_th;
		}else{
			$project_name = $res->project_name_en;
		}
		if($fill=="logo"){
			if($res->project_logo!=''){
				if(file_exists("images/projects/$res->project_logo")==true){
					$img_logo = img_webp("images/projects/$res->project_logo");
					return "<img src='$img_logo' class='img-fluid' style='height:50px;' />";
				}
			}
		}elseif($fill=="project_cat_name"){
			if($_SESSION['lg']=='TH'){
				$project_cat_name = $this->getTextfromwhere("kp_projects_cat","project_cat_name_th","where project_cat_id = '$project_cat_id' ");
			}else{
				$project_cat_name = $this->getTextfromwhere("kp_projects_cat","project_cat_name_en","where project_cat_id = '$project_cat_id' ");
			}
			return $project_cat_name;
		}elseif($fill=="link_project_cat"){
			$project_cat_link = $this->getTextfromwhere("kp_projects_cat","slug","where project_cat_id = '$project_cat_id' ");
			return $project_cat_link;
		}elseif($fill=="cover"){

			$getdevice = detectDevice();
			if($getdevice=="Computer"){
				$bg_cover = $this->getTextfromwhere('kp_projects_gallery','project_img',"where project_id = '$project_id' and is_desktop=1 and img_type='cover' ");
			}elseif($getdevice=="Tablet"){
				$bg_cover = $this->getTextfromwhere('kp_projects_gallery','project_img',"where project_id = '$project_id' and is_tablet=1 and img_type='cover' ");
			}elseif($getdevice=="Mobile"){
				$bg_cover = $this->getTextfromwhere('kp_projects_gallery','project_img',"where project_id = '$project_id' and is_mobile=1 and img_type='cover' ");
			}else{
				$bg_cover = $this->getTextfromwhere('kp_projects_gallery','project_img',"where project_id = '$project_id' and is_desktop=1 and img_type='cover' ");
			}
			if(!empty($bg_cover)){
				return img_webp("images/projects/$bg_cover");
			}else{
				return img_webp("images/banner1440.jpg");
			}

		}elseif($fill=="cover-img"){
			$img=  $this->getImgcover($project_id);
			return '<img src="'.$img.'" class="img-responsive" style="margin:auto;"/>';
		}elseif($fill=="name"){
			if($_SESSION['lg']=='TH'){
				return $res->project_name_th;
			}else{
				return $res->project_name_en;
			}
		}elseif($fill=="detail"){
			if($_SESSION['lg']=='TH'){
				return $res->project_detail_th;
			}else{
				return $res->project_detail_en;
			}
		}elseif($fill=="shortdetail"){
			if($_SESSION['lg']=='TH'){
				return $res->project_shortdetail_th;
			}else{
				return $res->project_shortdetail_en;
			}
		}elseif($fill=="price"){
			if($_SESSION['lg']=='TH'){
				return $res->project_price_th;
			}else{
				return $res->project_price_en;
			}
		}elseif($fill=="map"){
			return $res->project_map;
		}elseif($fill=="gallery"){
			$arr = array();
			$qr = $this->fetchdata("kp_projects_gallery","where project_id = '$project_id' and img_type = 'gallery' order by sort asc ");
			while($res = $qr->fetch_object()){
				if(file_exists("images/projects/$res->project_img")){
					$img_gall = img_webp("images/projects/$res->project_img");
					$img = $img_gall;

					// $data = "<div class=\"col-md-4\">
	        //   <div class=\"card mb-4 hoverable\">
	        //     <div class=\"view\" style=\"max-height: 200px;\">
	        //       <a href=\"$img\" title=\"$project_name\"><img class=\"card-img-top\" style=\"width: 100%; display: block;\" alt=\"$project_name\" src=\"$img\" data-holder-rendered=\"true\"></a>
	        //     </div>
	        //   </div>
	        // </div>";

					$data = "<div >
			      <a href=\"$img\" ><img data-lazy=\"$img\" alt=\"$project_cat_name\" data-srcset=\"$img\" src=\"$img\"></a>
			    </div>";
					array_push($arr,$data);
				}
			}

			// if(count($arr)>=3){
				// $datahtml = "<div class=\"tt-block-title text-left\" style=\"padding-bottom:20px;\">";
				// 	$datahtml.= "<h1 class=\"tt-title project-headblog\">".$word->wordvar('Gallery')."</h1>";
				// $datahtml.= "</div>";
				// $datahtml.= "<div id=\"links\"  class=\"slider multiple-items-project-gallery row\">";
				// 	$datahtml.= implode('',$arr);
				// $datahtml.= "</div>";

				$datahtml.= "<section id=\"links\" class=\"gallery-center slider pd-x-50\" >";
					$datahtml.= implode('',$arr);
				$datahtml.= "</section>";
				return $datahtml;
			// }else{
				// return false;
			// }

		}elseif($fill=="mainpic"){
			$img = $this->getImgcover($res->project_id);

			if($img!=''){
				$datahtml = "<img src=\"$img\" class=\"img-fluid\" alt=\"$project_name\"/>";
				return $datahtml;
			}else{
				return "";
			}

		}elseif($fill=="plan"){
			$arr = array();
			$qr = $this->fetchdata("kp_projects_gallery","where project_id = '$project_id' and img_type = 'plan' order by sort asc ");
			while($res = $qr->fetch_object()){
				if(file_exists("images/projects/$res->project_img")){
					$img = img_webp("images/projects/$res->project_img");

					$data = "<div class=\"col-md-12 col-xs-12\">
	          <div class=\"card mb-4 hoverable\">
	            <div class=\"view\" >
	              <a href=\"$img\" ><img class=\"card-img-top\" style=\"width: 100%; display: block;\" data-lazy=\"$img\" alt=\"$project_cat_name\" data-srcset=\"$img\" src=\"$img\" data-holder-rendered=\"true\"></a>
	            </div>
	          </div>
	        </div>";
					array_push($arr,$data);
				}
			}

			if(count($arr)>0){
				// $datahtml.= "<div id=\"links\"  class=\"slider multiple-items-project-plan row\">";
				$datahtml.= "<div class=\"slider row\" id=\"links2\">";
					$datahtml.= implode('',$arr);
				$datahtml.= "</div>";
				return $datahtml;
			}else{
				return false;
			}




		}elseif($fill=="360view"){

			$link360 = "$url/images/projects/360view/$res->project_360_view";
			$imglink = "<a href=\"javascript:void(0);\" onClick=\"window.open('$link360', '',
'fullscreen=yes, scrollbars=auto');\"><img src=\"$url/images/360view.jpg\" class=\"img-fluid\" style=\"max-height:412px;\" alt=\"$project_name\" /></a>";

			if($res->project_360_view!=''){
				return $imglink;
			}else{
				return "";
			}

		}elseif($fill=="location"){
			return $this->getHomelocation($res->project_cat_id);
		}elseif($fill=="hometype"){
			return $this->getHometypename($res->project_type_id);
		}elseif($fill=="description"){
			$arr = array();
			$qr = $this->fetchdata("kp_projects_detail","where project_id = '$project_id' order by text_sort asc ");
			while($res = $qr->fetch_object()){
				$descname= $this->getDesc('name',$res->desc_id);
				$descicon= $this->getDesc('icon',$res->desc_id);

				if($_SESSION['lg']=='TH'){
					$textname = $res->text_th;
				}else{
					$textname = $res->text_en;
				}
				$data = "<div class=\"col-md-4\">
          <div class=\"project-text card mb-4 hoverable\" style=\"margin-bottom:10px!important;\">
            <div class=\"card-body\" style=\"\">
              <h4 class=\"card-text-title project-text-title\"><i class=\"$descicon\"></i> $textname</h4>
            </div>
          </div>
        </div>";
				if($textname<>""){
				array_push($arr,$data);
				}
			}

			return implode('',$arr);
		}elseif($fill=="calculator"){
			$arr = array();
			$qr = $this->fetchdata("kp_projects_conditions","where project_id = '$id' order by condition_sort asc");
			while($res = $qr->fetch_object()){
				if($_SESSION['lg']=='TH'){
					$hometype = $res->condition_home_type_th;
					$homearea = $res->condition_area_th;
					$price = $res->condition_price_th;
					$downmoney = $res->condition_downmoney_th;
					$booking = $res->condition_reservation_th;
					$sign = $res->condition_sign_th;
					$payment = $res->condition_payment_th;
					$installment = $res->condition_installment_permonth_th;
					$interest = $res->condition_interest_th;
					$year = $res->condition_years_th;
				}else{
					$hometype = $res->condition_home_type_en;
					$homearea = $res->condition_area_en;
					$price = $res->condition_price_en;
					$downmoney = $res->condition_downmoney_en;
					$booking = $res->condition_reservation_en;
					$sign = $res->condition_sign_en;
					$payment = $res->condition_payment_en;
					$installment = $res->condition_installment_permonth_en;
					$interest = $res->condition_interest_en;
					$year = $res->condition_years_en;
				}

				$data = "<tr>";
					$data.= "<td scope=\"row\" class=\"text-center\">$hometype</td>";
					$data.= "<td scope=\"row\" class=\"text-center\">$homearea</td>";
					$data.= "<td scope=\"row\" class=\"text-center\">$price</td>";
					$data.= "<td scope=\"row\" class=\"text-center\">$downmoney</td>";
					$data.= "<td scope=\"row\" class=\"text-center\">$booking</td>";
					$data.= "<td scope=\"row\" class=\"text-center\">$sign</td>";
					$data.= "<td scope=\"row\" class=\"text-center\">$payment</td>";
					$data.= "<td scope=\"row\" class=\"text-center\">$installment</td>";
					$data.= "<td scope=\"row\" class=\"text-center\">$interest</td>";
					$data.= "<td scope=\"row\" class=\"text-center\">$year</td>";
				$data.= "</tr>";
				array_push($arr,$data);
			}

			if(count($arr)>0){
				$datahtml = "<div class=\"tt-block-title text-left\" style=\"padding-bottom:20px;\">";
					$datahtml.= "<h1 class=\"tt-title project-headblog\">".$word->wordvar('Table and conditions are approximate')."</h1>";
				$datahtml.= "</div>";
				$datahtml.= "<div class=\"row\">";
					$datahtml.= "<div class=\"col-md-12 col-xs-12\">";
					$datahtml.= "<div class=\"text-right\"><a href=\"#\" style=\"color:#fff;font-size:16px;\"><img src=\"$url/images/calculator.png\" />  คำนวณค่าผ่อนบ้าน</a></div>";
					$datahtml.= "<div style=\"margin-top:10px;width:100%;overflow:auto;\">";
						$datahtml.= "<table class=\"table\" style=\"width:100%;\">";
							$datahtml.= "<thead class=\"thead-light\">";
								$datahtml.= "<tr>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Home Type')."</th>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Area')."</th>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Price')."</th>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Down 20%')."</th>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Booking')."</th>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Sign')."</th>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Payment')."</th>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Installment')."</th>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Interest %')."</th>
									<th scope=\"col\" class=\"text-center\">".$word->wordvar('Year')."</th>
								</tr>";
							$datahtml.= "</thead>";
							$datahtml.= "<tbody>";
								$datahtml.= implode('',$arr);
							$datahtml.= "</tbody>";
						$datahtml.= "</table>";
					$datahtml.= "</div>";
								$datahtml.= "<div>
									<p style=\"color:#FFF;\">* กรุณาตรวจสอบเงื่อนไขและราคากับทางโครงการอีกครั้ง</p>
									<p style=\"color:#FFF;\">* อัตราดอกเบี้ย กรุณาตรวจสอบกับธนาคารที่ใช้บริการอีกครั้ง</p>
								</div>";
					$datahtml.= "</div>";
				$datahtml.= "</div>";
				return $datahtml;
			}else{
				return false;
			}

		}elseif($fill=="facilities"){

			$arr = array();
			$qr = $this->fetchdata("kp_projects_cat_facilities","where project_cat_id = '$project_cat_id' and status = 1 order by fac_id asc ");
			while($res = $qr->fetch_object()){
				if($res->fac_img!=''){
					if(file_exists("images/projects_cat/facilities/$res->fac_img")==true){
						$img = img_webp("images/projects_cat/facilities/$res->fac_img");
					}else{
						$img = img_webp("images/noimg.png");
					}
				}else{
					$img = img_webp("images/noimg.png");
				}
				if($_SESSION['lg']=='TH'){
					$facname = $res->fac_name_th;
				}else{
					$facname = $res->fac_name_en;
				}
				$data = "<div class=\"col-md-4 col-xs-6\">
          <div class=\"card mb-4 hoverable\">
            <div class=\"view overlay\" style=\"max-height:250px;overflow:hidden;\">
              <a href=\"#\"><img class=\"card-img-top\" style=\"width: 100%; display: block;\" src=\"$img\" data-holder-rendered=\"true\"></a>
            </div>
            <div class=\"card-body\" style=\"\">
              <h4 class=\"card-text-title project-fac-title\">$facname</h4>
            </div>
          </div>
        </div>";
				array_push($arr,$data);
			}

			if(count($arr)>0){
				$datahtml = "<div class=\"col-lg-12 col-sm-12 col-xs-12 c-center pd-x-50\">";
					$datahtml.= "<h1 class=\"h1-project\">".$word->wordvar('facilities')."</h1>";
				$datahtml.= "</div>";
				$datahtml.= "<div class=\"slider row\">";
					$datahtml.= implode('',$arr);
				$datahtml.= "</div>";
				return $datahtml;
			}else{
				return false;
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
		$qr = $this->fetchdata("kp_projects_location","where location_id in (select location_id from kp_projects where project_cat_id = '".$id."') ");
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
				if(file_exists("images/projects/$res->project_img")){
					$img = img_webp("images/projects/$res->project_img");
				}else{
					$img = img_webp("images/noimg.png");
				}
			}else{
				$img = img_webp("images/noimg.png");
			}
			return $img;
		}else{
			$qr = $this->fetchdata("kp_projects_gallery","where project_id = '".$id."' and img_type='gallery' limit 0,1 ");
			$res = $qr->fetch_object();
			if(!empty($res->project_img)){
				if(file_exists("images/projects/$res->project_img")){
					$img = img_webp("images/projects/$res->project_img");
				}else{
					$img = img_webp("images/noimg.png");
				}
			}else{
				$img = img_webp("images/noimg.png");
			}
			return $img;
		}
	}

	// contact mail
	public function sendMail(){
		$word = new word();
		$mailto = getcomp('companyemail');
		$contact_name 	 = $_POST['contact_name'];
		$contact_tel 	 = $_POST['contact_phone'];
		$mailfrom = $_POST['contact_email'];
		$subject = "";
		if($_POST['contact_type1']==1){
			$subject  = $word->wordvar("Signup and Get Discount");
		}
		if($_POST['contact_type2']==1){
			$subject  = $word->wordvar("Appointment Visit Project");
		}
		if($_POST['contact_type3']==1){
			$subject  = $word->wordvar("After sales service");
		}
		$contact_message  = $_POST['contact_message'];


		$strTo = $mailto;
		$strSubject = "=?UTF-8?B?".base64_encode($subject)."?=";
		$strHeader .= "MIME-Version: 1.0' . \r\n";
		$strHeader .= "Content-type: text/html; charset=utf-8\r\n";
		$strHeader .= "From: Narawadee Website <noreply@narawadee.co.th>\r\nReply-To: info@narawadee.co.th";
		$strVar = "ข้อความภาษาไทย";


		$body = "<div>
					<div>Dear : Customer Service.</div>
					<br/>
					<div>$subject</div>
					<div>$contact_message</div>
					<br/>
					<hr/>
					<div>Name: $contact_name</div>
					<div>Tel: $contact_tel</div>
					<div>Email: $mailfrom</div>
					<div>Mail Message From Website Narawadee.co.th</div>
				</div>";

			if(isset($_POST["send"]))
			{
				////// Email
				// @set_magic_quotes_runtime(false);
				// ini_set('magic_quotes_runtime', 0);
				require_once("common/mailer/class.phpmailer.php");
				require_once("common/mailer/class.smtp.php");

				$subj = 'New Message From Website. '. date("Y-m-d H:i:s");
				$mail = new PHPMailer(); // create a new object

				//$mail->IsSMTP(); // enable SMTP
				$mail->CharSet = "utf-8";
				$mail->IsHTML(true);
				$mail->IsSMTP();
				$mail->SMTPAuth = true; // enable SMTP authentication
				$mail->SMTPSecure = ''; // sets the prefix to the servier
				$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only ,false = Disable
				$mail->Host = "mail.narawadee.co.th";
				$mail->Port = '25';
				$mail->Username = "noreply@narawadee.co.th"; //from@domainname.com
				$mail->Password = "9kapong";
				$mail->SetFrom("noreply@narawadee.co.th", $subj);
				$mail->Subject = $subject;
				$mail->Body    = $body;
				$mail->AddAddress($mailto);
				$mail->AddAddress("noreply@narawadee.co.th");
				if(!$mail->Send()){
					$flgSend = 0;
					$status = "fail";
					//$err = "Mailer Error: " . $mail->ErrorInfo;
			    }else{
					$flgSend = 1;
					$status = "success";
				}



			}

		//print $status;
		echo json_encode(array('status'=>$status));
	}


	// fucntion register from popup
	public function sendRegister(){

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ipclnxx = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ipclnxx = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		$ipclnxx = $_SERVER['REMOTE_ADDR'];
		}

		$word = new word();
		$url = curPageURL();
		// $mailto = getcomp('companyemail');
		$cust_name 	 = $_REQUEST['cust_name'];
		$cust_tel 	 = $_REQUEST['cust_tel'];
		$cust_email = $_REQUEST['cust_email'];
		$budget = $_REQUEST['budget'];
		$time_to_contact = $_REQUEST['time_to_contact'];
		$project = $_REQUEST['proj'];
		$project_name = $this->getProject_name($project);
		$mailto = $this->getEmail($project);
		$subject = "Registration ".$cust_name;


		$strTo = $mailto;
		$strSubject = "=?UTF-8?B?".base64_encode($cust_name)."?=";
		$strHeader .= "MIME-Version: 1.0' . \r\n";
		$strHeader .= "Content-type: text/html; charset=utf-8\r\n";
		$strHeader .= "From: $name <$mailfrom>\r\nReply-To: $mailfrom";
		$strVar = "ข้อความภาษาไทย";


		$body = "<div>
					<div>Dear : All.</div>
					<br/>
					<div>$subject</div>
					<br/>
					<hr/>
					<div>Name : $cust_name</div>
					<div>Tel : $cust_tel</div>
					<div>Email : $cust_email</div>
					<div>Project : $project_name</div>
					<div>Budget : $budget</div>
					<div>Contact Time : $time_to_contact</div>
					<hr/>
					<div>Mail Message From Website Narawadee.co.th</div>
					<div>Client IP Address: $ipclnxx</div>
				</div>";

			if(isset($_REQUEST["send"]))
			{
				////// Email

				// @set_magic_quotes_runtime(false);
				// ini_set('magic_quotes_runtime', 0);
				require_once("common/mailer/class.phpmailer.php");
				require_once("common/mailer/class.smtp.php");

				$subj = 'New Message Registration '. date("Y-m-d H:i:s");
				$mail = new PHPMailer(); // create a new object

				//$mail->IsSMTP(); // enable SMTP
				$mail->CharSet = "utf-8";
				$mail->IsHTML(true);
				$mail->IsSMTP();
				$mail->SMTPAuth = true; // enable SMTP authentication
				$mail->SMTPSecure = ''; // sets the prefix to the servier
				$mail->SMTPDebug = false; // debugging: 1 = errors and messages, 2 = messages only ,false = Disable
				$mail->Host = "mail.narawadee.co.th";
				$mail->Port = '25';
				$mail->Username = "noreply@narawadee.co.th"; //from@domainname.com
				$mail->Password = "9kapong";
				$mail->SetFrom("noreply@narawadee.co.th", $subj);
				$mail->Subject = $subject;
				$mail->Body    = $body;
				foreach ($mailto as $value) {
					$mail->AddAddress($value);
				}
				$mail->AddAddress("noreply@narawadee.co.th");
				if(!$mail->Send()){
					$flgSend = 0;
					$status = "fail";
					$err = "Mailer Error: " . $mail->ErrorInfo;
			    }else{
					$flgSend = 1;
					$status = "success";
					$err = "";
					$custname = explode(" ", $cust_name);
					$cust_fname = $custname[0];
					$cust_sname = $custname[1];
					$arrpost = array(
						'cust_name'=>$cust_fname,
						'cust_sname'=>$cust_sname,
						'cust_tel'=>$cust_tel,
						'cust_email'=>$cust_email,
						'project'=>$project_name
					);

					// $url_api = "$url/narawadee-api/register?select=register";
					$url_api = "http://192.168.3.4/narawadee-api/register?select=register";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url_api);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,$arrpost);
					// receive server response ...
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec ($ch);
					curl_close ($ch);
					// further processing ....
					if ($server_output=="OK") { $respon = '';} else { $respon = ''; }

				}
			}

		//print $status;
		echo json_encode(array('status'=>$status,'msg'=>$err,'curlrespon'=>$server_output));
	}


	public function getEmail($id){
		$arr = array();
		if(SUBSTR($id,0,2)=='PJ'){
			$qr = $this->fetchdata("kp_popup_email","where project_cat_id in
			(select project_cat_id from kp_projects where project_id = '$id' ) ");
			while($res = $qr->fetch_object()){
				$email = $res->email;
				array_push($arr,$email);
			}

			return $arr;
		}else{
			$qr = $this->fetchdata("kp_popup_email","where project_cat_id = '$id' ");
			while($res = $qr->fetch_object()){
				$email = $res->email;
				array_push($arr,$email);
			}

			return $arr;
		}
	}


	// function project name and category project name
	public function getProject_name($id){
		if(SUBSTR($id,0,2)=='PJ'){
			$qr = $this->fetchdata("kp_projects","where project_cat_id in
			(select project_cat_id from kp_projects where project_id = '$id' ) ");
			$res = $qr->fetch_object();

			return $res->project_name_th;
		}else{
			$qr = $this->fetchdata("kp_projects","where project_cat_id = '$id' ");
			$res = $qr->fetch_object();

			return $res->project_name_th;
		}
	}

	public function getProject_id($id){
		if(SUBSTR($id,0,2)=='PJ'){
			$qr = $this->fetchdata("kp_projects","where project_cat_id in
			(select project_cat_id from kp_projects where project_id = '$id' ) ");
			$res = $qr->fetch_object();

			return $res->project_cat_id;
		}else{
			$qr = $this->fetchdata("kp_projects","where project_cat_id = '$id' ");
			$res = $qr->fetch_object();

			return $res->project_cat_id;
		}
	}

}

?>
