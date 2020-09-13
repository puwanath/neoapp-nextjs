<?php
$param = "slide";
require "models/$param.php";

class slideController extends Controllers
{
	//begin function index start page
	public function index($get_part0,$get_part1,$get_part2){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการแบนเนอร์";
		$pagename = "จัดการแบนเนอร์สไลน์";
		$param = "slide";
		$model = new slideController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->loadData();
				 break;

			case 'readdata' :
				 $model->readData();
				 break;

		  case 'readdataimg' :
				 $model->readDataimg();
				 break;

			case 'add' :
				 $model->addData();
				 break;

			case 'update' :
				 $model->updateData();
				 break;

			case 'del' :
				 $model->delData();
				 break;

			case 'delimg' :
				 $model->delImg();
				 break;

		  case 'isstatus' :
		  	 $model->changeIsstatus();
		  	 break;

		  case 'sortrow' :
			   $model->sortRow();
			   break;

		  case 'uploadimg' :
 			   $model->uploadImg();
 			   break;

		  case 'uploadimg_tablet' :
 			   $model->uploadImg_tablet();
 			   break;

		  case 'uploadimg_mobile' :
 			   $model->uploadImg_mobile();
 			   break;


			default :
			$urlredirec = "../welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}

		endif;

		$user = getSession();
		$qruser = $this->fetchdata("kp_users","where user_id = '$user' ");
		$re = $qruser->fetch_object();
		$userid = $re->user_id;
		$userfullname = $re->user_fullname.' '.$re->user_lastname;
		if($re->user_avatar!=''){
			$userimg = $url.'/images/user/tmp/'.$re->user_avatar;
		}else{
			$userimg = $url.'/images/avatar.jpg';
		}


		$qr = $this->fetchdata("kp_user_level","where level_id = '".$re->user_level."' ");
		$res = $qr->fetch_object();
		$levelname = $res->level_name;

		// permission menu
		$mainmenu = array(
			'add'=>'<a href="'.$url.'/'.$get_part0.'/add" class="btn btn-primary btn-with-icon"><div class="ht-40"><span class="icon wd-40"><i class="fa fa-plus"></i></span><span class="pd-x-15">เพิ่ม</span></div></a>',
		);
		// permission menu

		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>",
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",

		);
		//end css and js script


		if($select==''){
			if($get_part1=="add" or $get_part1=="edit"){
				$p = "form.php";
			}else{
				$p = "index.php";
			}
			$content = "views/$param/$p";
			$page = include("views/layout/template.php");
			return $page;
		}


	}
	//end function page
	public function loadData(){
		$arr = array();
		$urlweb = curPageURLWeb();
		include "common/include/config.php";
		$requestData= $_REQUEST;

		$page = $requestData["page"];
		$limit = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;
		$totalrows = isset($requestData["totalrows"]) ? $requestData["totalrows"]: false;
		if($totalrows) {
		    $limit = $totalrows;
		}

		$sql = "select count(*) as countrow from kp_banner_slide where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( slide_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(slide_name_en) LIKE lower('%".$requestData['search']."%') )";
		}
		$res = $dbCon->query($sql)->fetch_assoc;
		$count = $res['countrow'];

		if ($count > 0 ) {
		    $var = @($count/$limit);
		    $totalpages = ceil ($var);
		} else {
		    $totalpages = 0;
		}

		if ($page > $totalpages) $page=$totalpages;
		if ($limit < 0) $limit = 0;

		$start = $limit*$page - $limit;
		if ($start < 0) $start = 0;

		$sql = "select * from kp_banner_slide where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( slide_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(slide_name_en) LIKE lower('%".$requestData['search']."%') )";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = 1;
		while($res= $qr->fetch_object()){
			$slide_id = $res->slide_id;
			$slide_name_th = $res->slide_name_th;
			$slide_name_en = $res->slide_name_en;
			$slide_position = $res->slide_position_y.' '.$res->slide_position_x;
			$slide_between = date("d/m/Y",strtotime($res->datestart)).' '.date("d/m/Y",strtotime($res->dateend));
			$site_name = $this->getTextformid("kp_sitepage","site_name","site_id",$res->site_id);
			$sortnum = $res->sort;

			if(!empty($res->slide_img)){
				if(file_exists("../images/banners/slide/tmp/$res->slide_img")==true){
					$img = $urlweb."/images/banners/slide/tmp/$res->slide_img";
					$img = "<img src='$img' class='img-fluid' style='height:25px;'/>";
				}else{
					$img = $urlweb."/images/no-img.jpg";
					$img = "<img src='$img' class='img-fluid' style='height:25px;'/>";
				}
			}else{
				$img = $urlweb."/images/no-img.jpg";
				$img = "<img src='$img' class='img-fluid' style='height:30px;'/>";
			}

			if(!empty($res->slide_youtube)){
				$yt = '<span class="badge badge-danger">YT</span>';
			}else{
				$yt = '';
			}


			$created = date("d/m/Y H:i:s",strtotime($res->create_date));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$slide_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$slide_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btn_sort = "<button type=\"button\" onclick=\"sortRow('$sortnum','up','slide_id','$slide_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-up\"></i></button>";
			$btn_sort.= "<button type=\"button\" onclick=\"sortRow('$sortnum','down','slide_id','$slide_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-down\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$slide_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$slide_id','$slide_name_th');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_show.$btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row['row'] = $i;
			$row['slide_img'] = $img;
			$row['slide_name_th'] = $slide_name_th.' '.$yt;
			$row['slide_name_en'] = $slide_name_en.' '.$yt;
			$row['slide_between'] = $slide_between;
			$row['slide_position'] = $slide_position;
			$row['site_id'] = $site_name;
			$row['created'] = $created;
			$row['creator'] = $creator;
			$row['btn_act'] = $btnaction;
			$arr[] = $row;

			$i++;
		}
		$output = array();
		$output['records'] = $count;
		$output['page'] = $page;
		$output['total'] = ceil($count/$limit);
		$output['rows'] = $arr;

		echo json_encode($output);
	}


	public function readData()
	{
		$url = curPageURL();
		$url2 = curPageURLweb();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_banner_slide","where slide_id = '$id' ");
		$res = $qr->fetch_object();

		$slide_id = $res->slide_id;
		if($res->slide_img!=''){
			$img = "$url2/images/banners/slide/tmp/$res->slide_img";
			$btn_desktop = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('slide_img','$slide_id')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img = "";
			$btn_desktop = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}
		if($res->slide_img_tablet!=''){
			$img_tablet = "$url2/images/banners/slide/tmp/$res->slide_img_tablet";
			$btn_tablet = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('slide_img_tablet','$slide_id')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img_tablet = "";
			$btn_tablet = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle_tablet')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}
		if($res->slide_img_mobile!=''){
			$img_mobile = "$url2/images/banners/slide/tmp/$res->slide_img_mobile";
			$btn_mobile = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('slide_img_mobile','$slide_id')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img_mobile = "";
			$btn_mobile = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle_mobile')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}

		$output['id'] = $res->slide_id;
		$output['slide_name_th'] = $res->slide_name_th;
		$output['slide_name_en'] = $res->slide_name_en;
		$output['slide_detail_th'] = $res->slide_detail_th;
		$output['slide_detail_en'] = $res->slide_detail_en;
		$output['slide_img'] = $img;
		$output['slide_img_tablet'] = $img_tablet;
		$output['slide_img_mobile'] = $img_mobile;
		$output['slide_link'] = $res->slide_link;
		$output['slide_youtube'] = $res->slide_youtube;
		$output['slide_position_x'] = $res->slide_position_x;
		$output['slide_position_y'] = $res->slide_position_y;
		$output['site_id'] = $res->site_id;
		$output['datestart'] = date('m/d/Y', strtotime($res->datestart));
		$output['dateend'] = date('m/d/Y', strtotime($res->dateend));
		$output['creator'] = $this->createby($res->user_create);
		$output['datecreate'] = date("d/m/Y H:i:s",strtotime($res->create_date));
		$output['status'] = $res->status;
		$output['sort'] = $res->sort;

		echo json_encode($output);
	}


	public function readDataimg(){
		$url = curPageURL();
		$url2 = curPageURLweb();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_banner_slide","where slide_id = '$id' ");
		$res = $qr->fetch_object();
		$slide_id = $res->slide_id;

		if($res->slide_img!=''){
			$img = "$url2/images/banners/slide/tmp/$res->slide_img";
			$btn_desktop = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('slide_img','$slide_id')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img = "";
			$btn_desktop = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}
		if($res->slide_img_tablet!=''){
			$img_tablet = "$url2/images/banners/slide/tmp/$res->slide_img_tablet";
			$btn_tablet = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('slide_img_tablet','$slide_id')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img_tablet = "";
			$btn_tablet = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle_tablet')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}
		if($res->slide_img_mobile!=''){
			$img_mobile = "$url2/images/banners/slide/tmp/$res->slide_img_mobile";
			$btn_mobile = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('slide_img_mobile','$slide_id')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img_mobile = "";
			$btn_mobile = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle_mobile')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}

		echo json_encode(array('btnupload'=>$btn_desktop,'btnupload_tablet'=>$btn_tablet,'btnupload_mobile'=>$btn_mobile,'img'=>$img,'img_tablet'=>$img_tablet,'img_mobile'=>$img_mobile));
	}

	//begin function addData
	public function addData()
	{
		$id = $this->NewID('SLD','slide_id','kp_banner_slide');
		$slidename_th = addslashes($_POST['slidename_th']);
		$slidename_en = addslashes($_POST['slidename_en']);
		$slidedetail_th = addslashes($_POST['slidedetail_th']);
		$slidedetail_en = addslashes($_POST['slidedetail_en']);
		$datestart	= date('Y-m-d', strtotime($_POST['slide_start_date']));
		$dateend	= date('Y-m-d', strtotime($_POST['slide_end_date']));
		$slide_link = $_POST['slide_link'];
		$slide_youtube = $_POST['slide_youtube'];
		$slide_position_y = $_POST['slide_position_y'];
		$slide_position_x = $_POST['slide_position_x'];
		$slide_sort = $this->sortMax('kp_banner_slide','sort');
		$site_id = $_POST['sitepage'];
		$status = 1;
		$usercreate = getSession();

		if(isset($_REQUEST['slidename_th'])):

			$form_data = array(
				'slide_id'=>$id,
				'slide_name_th'=>$slidename_th,
				'slide_name_en'=>$slidename_en,
				'slide_detail_th'=>$slidedetail_th,
				'slide_detail_en'=>$slidedetail_en,
				'slide_link'=>$slide_link,
				'slide_youtube'=>$slide_youtube,
				'slide_position_x'=>$slide_position_x,
				'slide_position_y'=>$slide_position_y,
				'site_id'=>$site_id,
				'datestart'=>$datestart,
				'dateend'=>$dateend,
				'user_create'=>$usercreate,
				'sort'=>$slide_sort,
				'status'=>$status,
				'is_delete'=>0
			);
			$insert = $this->insertrow('kp_banner_slide',$form_data);

		endif;

		if($insert===TRUE){
			//start function save log transection
			$desclog = "เพิ่ม แบนเนอร์สไลน์  ชื่อ $slidename_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['respontext'] = "Add $slidename_th success!";
			$respon['msg'] = "เพิ่ม แบนเนอร์สไลน์สำเร็จ!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "error";
			$respon['respontext'] = "Add $slidename_th error!";
			$respon['msg'] = "ไม่สามารถ เพิ่ม แบนเนอร์สไลน์สำเร็จ  กรุณาติดต่อ Support";
			$respon['id'] = $id;
		}

		echo json_encode($respon);
	}

	//end function addData

	//begin function addData
	public function updateData()
	{
		$id = $_REQUEST['id'];
		$slidename_th = addslashes($_POST['slidename_th']);
		$slidename_en = addslashes($_POST['slidename_en']);
		$slidedetail_th = addslashes($_POST['slidedetail_th']);
		$slidedetail_en = addslashes($_POST['slidedetail_en']);
		$datestart	= date('Y-m-d', strtotime($_POST['slide_start_date']));
		$dateend	= date('Y-m-d', strtotime($_POST['slide_end_date']));
		$slide_link = $_POST['slide_link'];
		$slide_youtube = $_POST['slide_youtube'];
		$slide_position_y = $_POST['slide_position_y'];
		$slide_position_x = $_POST['slide_position_x'];
		$site_id = $_POST['sitepage'];
		$status = 1;
		$usercreate = getSession();

		if(isset($_REQUEST['id'])):

			$form_data = array(
				'slide_name_th'=>$slidename_th,
				'slide_name_en'=>$slidename_en,
				'slide_detail_th'=>$slidedetail_th,
				'slide_detail_en'=>$slidedetail_en,
				'slide_link'=>$slide_link,
				'slide_youtube'=>$slide_youtube,
				'slide_position_x'=>$slide_position_x,
				'slide_position_y'=>$slide_position_y,
				'site_id'=>$site_id,
				'datestart'=>$datestart,
				'dateend'=>$dateend,
				'user_create'=>$usercreate,
				'status'=>$status
			);
			$update = $this->updaterow('kp_banner_slide',$form_data,"where slide_id = '$id' ");
		endif;

		if($update===TRUE){
			//start function save log transection
			$desclog = "แก้ไข แบนเนอร์สไลน์  ชื่อ $slidename_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['respontext'] = "Update $slidename_th success!";
			$respon['msg'] = "แก้ไข แบนเนอร์สไลน์สำเร็จ!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "error";
			$respon['respontext'] = "Update $slidename_th error!";
			$respon['msg'] = "ไม่สามารถ แก้ไข แบนเนอร์สไลน์สำเร็จ  กรุณาติดต่อ Support";
			$respon['id'] = $id;
		}
		echo json_encode($respon);
	}

	//end function addData

	//begin function addData
	public function delData()
	{
		$id = $_REQUEST['id'];
		if(isset($id)):
			$qr = $this->fetchdata("kp_banner_slide","where slide_id = '$id'");
			$res = $qr->fetch_object();
			$sname = $res->slide_name_th;
			$del = $this->updaterow("kp_banner_slide",array('is_delete'=>1),"where slide_id = '$id' ");
		endif;

		if($del===TRUE){
			//start function save log transection
			$desclog = "ลบ แบนเนอร์สไลน์  ชื่อ $sname";
			savelog(getSession(),$desclog);
			//end function save log transection
			$respon['status'] = "success";
			$respon['respontext'] = "Delete slide success!";
			$respon['msg'] = "ลบ แบนเนอร์สไลน์สำเร็จ!";
			$this->sortDatanew();
		}else{
			$respon['status'] = "error";
			$respon['respontext'] = "Delete slide error!";
			$respon['msg'] = "ไม่สามารถ ลบ  แบนเนอร์สไลน์สำเร็จ  กรุณาติดต่อ Support";
		}

		echo json_encode($respon);
	}

	// begin function upload img
	public function uploadImg()
	{
		if(empty($_REQUEST['slideid'])==true){
			$id = $this->NewID('SLD','slide_id','kp_banner_slide');
			$slide_sort = $this->sortMax('kp_banner_slide','sort');
		}else{
			$id = $_REQUEST['slideid'];
		}

		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'bannerslide-'.$id.'-deskop1440-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,400,"../images/banners/slide/tmp/");
			copy($file_tmp,"../images/banners/slide/$pic_name");

			if(empty($_REQUEST['slideid'])==true){
				$form_data = array(
					'slide_id'=>$id,
					'slide_img'=>$pic_name,
					'sort'=>$slide_sort,
					'is_delete'=>0
				);
				$updateimg = $this->insertrow('kp_banner_slide',$form_data);
			}else{
				$form_data = array(
					'slide_img'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_banner_slide', $form_data, "WHERE slide_id = '$id'");
			}

		}

		if($updateimg===TRUE){
			$output['status'] = "success";
			$output['msg'] = "อัพโหลดสำเร็จ!";
			$output['id'] = $id;
		}else{
			$output['status'] = "error";
			$output['msg'] = "อัพโหลดไม่สำเร็จ!";
			$output['id'] = $id;
		}

		echo json_encode($output);
	}

	public function uploadImg_tablet()
	{
		if(empty($_REQUEST['slideid'])==true){
			$id = $this->NewID('SLD','slide_id','kp_banner_slide');
			$slide_sort = $this->sortMax('kp_banner_slide','sort');
		}else{
			$id = $_REQUEST['slideid'];
		}

		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle_tablet']['name'];
		$file_tmp  = $_FILES['fle_tablet']['tmp_name'];
		$file_type = $_FILES['fle_tablet']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'bannerslide-'.$id.'-tablet778-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,400,"../images/banners/slide/tmp/");
			copy($file_tmp,"../images/banners/slide/$pic_name");

			if(empty($_REQUEST['slideid'])==true){
				$form_data = array(
					'slide_id'=>$id,
					'slide_img_tablet'=>$pic_name,
					'sort'=>$slide_sort,
					'is_delete'=>0
				);
				$updateimg = $this->insertrow('kp_banner_slide',$form_data);
			}else{
				$form_data = array(
					'slide_img_tablet'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_banner_slide', $form_data, "WHERE slide_id = '$id'");
			}

		}
		$output = array();
		if($updateimg===TRUE){
			$output['status'] = "success";
			$output['msg'] = "อัพโหลดสำเร็จ!";
			$output['id'] = $id;
		}else{
			$output['status'] = "error";
			$output['msg'] = "อัพโหลดไม่สำเร็จ!";
			$output['id'] = $id;
		}

		echo json_encode($output);
	}


	public function uploadImg_mobile()
	{
		if(empty($_REQUEST['slideid'])==true){
			$id = $this->NewID('SLD','slide_id','kp_banner_slide');
			$slide_sort = $this->sortMax('kp_banner_slide','sort');
		}else{
			$id = $_REQUEST['slideid'];
		}

		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle_mobile']['name'];
		$file_tmp  = $_FILES['fle_mobile']['tmp_name'];
		$file_type = $_FILES['fle_mobile']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'bannerslide-'.$id.'-mobile480-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,400,"../images/banners/slide/tmp/");
			copy($file_tmp,"../images/banners/slide/$pic_name");

			if(empty($_REQUEST['slideid'])==true){
				$form_data = array(
					'slide_id'=>$id,
					'slide_img_mobile'=>$pic_name,
					'sort'=>$slide_sort,
					'is_delete'=>0
				);
				$updateimg = $this->insertrow('kp_banner_slide',$form_data);
			}else{
				$form_data = array(
					'slide_img_mobile'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_banner_slide', $form_data, "WHERE slide_id = '$id'");
			}

		}
		$output = array();
		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "อัพโหลดสำเร็จ!";
			$output['id'] = $id;
		}else{
			$output['status'] = "error";
			$output['msg'] = "อัพโหลดไม่สำเร็จ!";
			$output['id'] = $id;
		}

		echo json_encode($output);
	}


	public function delImg(){
		$f = $_REQUEST['f'];
		$id = $_REQUEST['id'];
		$output = array();
		$qr = $this->fetchdata("kp_banner_slide","where slide_id = '$id' ");
		$res = $qr->fetch_object();

		if($f=='slide_img'){
			$updateimg = $this->updaterow('kp_banner_slide', array('slide_img'=>''), "WHERE slide_id = '".$id."' ");
			if($updateimg){
				$output['status'] = "success";
				$output['msg'] = "ลบรูปภาพสำเร็จ!";
				$output['id'] =$id;

				if(file_exists("../images/banners/slide/$res->slide_img")==true){
					unlink("../images/banners/slide/$res->slide_img");
					unlink("../images/banners/slide/tmp/$res->slide_img");
				}
			}else{
				$output['status'] = "error";
				$output['msg'] = "ลบรูปภาพสำเร็จ!";
				$output['id'] =$id;
			}
		}elseif($f=='slide_img_tablet'){
			$updateimg = $this->updaterow('kp_banner_slide', array('slide_img_tablet'=>''), "WHERE slide_id = '".$id."' ");
			if($updateimg){
				$output['status'] = "success";
				$output['msg'] = "ลบรูปภาพสำเร็จ!";
				$output['id'] =$id;

				if(file_exists("../images/banners/slide/$res->slide_img_tablet")==true){
					unlink("../images/banners/slide/$res->slide_img_tablet");
					unlink("../images/banners/slide/tmp/$res->slide_img_tablet");
				}
			}else{
				$output['status'] = "error";
				$output['msg'] = "ลบรูปภาพสำเร็จ!";
				$output['id'] =$id;
			}
		}elseif($f=='slide_img_mobile'){
			$updateimg = $this->updaterow('kp_banner_slide', array('slide_img_mobile'=>''), "WHERE slide_id = '".$id."' ");
			if($updateimg){
				$output['status'] = "success";
				$output['msg'] = "ลบรูปภาพสำเร็จ!";
				$output['id'] =$id;

				if(file_exists("../images/banners/slide/$res->slide_img_mobile")==true){
					unlink("../images/banners/slide/$res->slide_img_mobile");
					unlink("../images/banners/slide/tmp/$res->slide_img_mobile");
				}
			}else{
				$output['status'] = "error";
				$output['msg'] = "ลบรูปภาพสำเร็จ!";
				$output['id'] =$id;
			}
		}

		echo json_encode($output);
	}

	//end function addData

	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$name = $this->getTextformid("kp_banner_slide","slide_name_th","slide_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_banner_slide",array('status'=>$status),"where slide_id = '$id' ");
		}


		if($updatestatus){
			//start function save log transection
			$desclog = "เปลี่ยน $name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "เปลี่ยน $name ให้เปิดใช้งาน สำเร็จ!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "ไม่สามารถเปลี่ยน $name ให้เปิดใช้งาน ได้ กรุณาติดต่อ Support";
		}
		echo json_encode($respon);
	}

	public function sortDatanew(){
		$arrid = array();
		$qr = $this->fetchdata("kp_banner_slide","order by sort asc");
		while($res = $qr->fetch_object()){
			$id = $res->slide_id;
			array_push($arrid,$id);
		}

		$i = 0;
		foreach ($arrid as $value) {
			$slideid = $value;
			$data = array('sort'=>$i);
			$this->updaterow("kp_banner_slide",$data,"where slide_id = '".$slideid."' ");
			//echo "<br/>$i<br/>";
			$i++;

		}
	}


	public function sortRow(){
		$sorttype = $_REQUEST['type'];
		if($_REQUEST['line']==0 and $sorttype=="up"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับบนสุดแล้ว!";
		}elseif($_REQUEST['trackline']==($this->countdatasort("sort","kp_banner_slide")-1) and $sorttype=="down"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output['status'] = "success";
			if($sorttype=="up"){
				$slide_sort = $_REQUEST['line'];
				$slidesort_plus = $slide_sort+1;
				$slidesort_post = $slide_sort-1;
				$slideline = $this->fetchdata("kp_banner_slide","where sort = '$slide_sort' ");
				$resslide = $slideline->fetch_object();

				$slideline2 = $this->fetchdata("kp_banner_slide","where sort = '$slidesort_post' ");
				$resslide2 = $slideline2->fetch_object();

				$sortdata = array(
					'sort'=>$slidesort_post
				);

				$this->updaterow("kp_banner_slide",$sortdata,"where slide_id = '".$resslide->slide_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$slide_sort
				);

				$this->updaterow("kp_banner_slide",$sortdata2,"where slide_id = '".$resslide2->slide_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$slide_sort = $_REQUEST['line'];
				$slidesort_plus = $slide_sort+1;
				$slidesort_post = $slide_sort-1;
				$slideline = $this->fetchdata("kp_banner_slide","where sort = '$slide_sort' ");
				$resslide = $slideline->fetch_object();

				$slideline2 = $this->fetchdata("kp_banner_slide","where sort = '$slidesort_plus' ");
				$resslide2 = $slideline2->fetch_object();

				$sortdata = array(
					'sort'=>$slidesort_plus
				);

				$this->updaterow("kp_banner_slide",$sortdata,"where slide_id = '".$resslide->slide_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$slide_sort
				);

				$this->updaterow("kp_banner_slide",$sortdata2,"where slide_id = '".$resslide2->slide_id."' ");
			}
		}

		echo json_encode($output);
	}


	public function getSite(){
		$arr = array();
		$qr = $this->fetchdata("kp_sitepage","where status = 1 order by site_id asc");
		while($res = $qr->fetch_object()){
			$data = "<option value='$res->site_id'>แสดงที่หน้า : $res->site_name</option>";
			array_push($arr,$data);
		}

		return $arr;
	}


}
