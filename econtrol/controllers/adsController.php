<?php
$param = "ads";
require "models/$param.php";

class adsController extends Controllers
{
	//begin function index start page
	public function index($get_part0,$get_part1,$get_part2){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการแบนเนอร์";
		$pagename = "จัดการแบนเนอร์โฆษณา";
		$param = "ads";
		$model = new adsController;

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

		  case 'uploadimg' :
 			   $model->uploadImg();
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

		$pageno = $requestData["page"];
		$rows = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;

		$sql = "select count(*) as countrow from kp_banner_ads where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ads_name LIKE '%".$requestData['search']."%' ";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['countrow'];
		$start = $rows * ($pageno -1);

		$sql = "select * from kp_banner_ads where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ads_name LIKE '%".$requestData['search']."%' ";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";

		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = 1;
		while($res= $qr->fetch_object()){
			$ads_id = $res->ads_id;
			$ads_name = $res->ads_name;
			$ads_position = $res->ads_position;
			$ads_between = date("d/m/Y",strtotime($res->datestart)).' - '.date("d/m/Y",strtotime($res->dateend));

			if(!empty($res->ads_img)){
				if(file_exists("../images/banners/ads/tmp/{$res->ads_img}")==true){
					$img = "{$urlweb}/images/banners/ads/tmp/{$res->ads_img}";
					$img = "<img src='$img' class='img-fluid' style='height:25px;'/>";
				}else{
					$img = "{$urlweb}/images/no-img.jpg";
					$img = "<img src='$img' class='img-fluid' style='height:25px;'/>";
				}
			}else{
				$img = "{$urlweb}/images/no-img.jpg";
				$img = "<img src='$img' class='img-fluid' style='height:30px;'/>";
			}


			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$ads_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$ads_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}


			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$ads_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$ads_id','$ads_name');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row['row'] = $i;
			$row['ads_img'] = $img;
			$row['ads_name'] = $ads_name;
			$row['ads_between'] = $ads_between;
			$row['ads_position'] = $ads_position;
			$row['btn_act'] = $btnaction;
			$arr[] = $row;

			$i++;
		}
		$output['records'] = $rowcount;
		$output['page'] = $pageno;
		$output['total'] = ceil($rowcount/$rows);
		$output['rows'] = $arr;

		echo json_encode($output);
	}


	public function readData()
	{
		$url = curPageURL();
		$url2 = curPageURLweb();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_banner_ads","where ads_id = '$id' ");
		$res = $qr->fetch_object();

		$ads_id = $res->ads_id;
		if($res->ads_img!=''){
			$img = "$url2/images/banners/ads/tmp/$res->ads_img";
			$btn_desktop = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('ads_img','$ads_id')\" class=\"btn btn-danger btn-oblong
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



		$output['id'] = $res->ads_id;
		$output['ads_name'] = $res->ads_name;
		$output['ads_img'] = $img;
		$output['ads_link'] = $res->ads_link;
		$output['ads_position'] = $res->ads_position;
		$output['datestart'] = date('m/d/Y', strtotime($res->datestart));
		$output['dateend'] = date('m/d/Y', strtotime($res->dateend));
		$output['status'] = $res->status;

		echo json_encode($output);
	}


	public function readDataimg(){
		$url = curPageURL();
		$url2 = curPageURLweb();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_banner_ads","where ads_id = '$id' ");
		$res = $qr->fetch_object();
		$ads_id = $res->ads_id;

		if($res->ads_img!=''){
			$img = "{$url2}/images/banners/ads/tmp/{$res->ads_img}";
			$btn_desktop = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('ads_img','$ads_id')\" class=\"btn btn-danger btn-oblong
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


		echo json_encode(array('btnupload'=>$btn_desktop,'btnupload_tablet'=>$btn_tablet,'btnupload_mobile'=>$btn_mobile,'img'=>$img,'img_tablet'=>$img_tablet,'img_mobile'=>$img_mobile));
	}

	//begin function addData
	public function addData()
	{
		$id = $this->NewID('ADS','ads_id','kp_banner_ads');
		$ads_name = addslashes($_POST['ads_name']);
		$ads_code = addslashes($_POST['ads_code']);
		$datestart	= date('Y-m-d', strtotime($_POST['datestart']));
		$dateend	= date('Y-m-d', strtotime($_POST['dateend']));
		$ads_link = $_POST['ads_link'];
		$ads_position = $_POST['ads_position'];
		$status = 1;
		$usercreate = getSession();

		if(isset($_REQUEST['ads_name'])):

			$form_data = array(
				'ads_id'=>$id,
				'ads_name'=>$ads_name,
				'ads_code'=>$ads_code,
				'ads_link'=>$ads_link,
				'ads_position'=>$ads_position,
				'datestart'=>$datestart,
				'dateend'=>$dateend,
				'status'=>$status,
				'is_delete'=>0
			);
			$insert = $this->insertrow('kp_banner_ads',$form_data);

		endif;

		if($insert===TRUE){
			//start function save log transection
			$desclog = "เพิ่ม แบนเนอร์โฆษณา  ชื่อ $ads_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['respontext'] = "Add $ads_name success!";
			$respon['msg'] = "เพิ่ม แบนเนอร์โฆษณาสำเร็จ!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "error";
			$respon['respontext'] = "Add $ads_name error!";
			$respon['msg'] = "ไม่สามารถ เพิ่ม แบนเนอร์โฆษณาสำเร็จ  กรุณาติดต่อ Support";
			$respon['id'] = $id;
		}

		echo json_encode($respon);
	}

	//end function addData

	//begin function addData
	public function updateData()
	{
		$id = $_REQUEST['ads_id'];
		$ads_name = addslashes($_POST['ads_name']);
		$ads_code = addslashes($_POST['ads_code']);
		$datestart	= date('Y-m-d', strtotime($_POST['datestart']));
		$dateend	= date('Y-m-d', strtotime($_POST['dateend']));
		$ads_link = $_POST['ads_link'];
		$ads_position = $_POST['ads_position'];
		$status = 1;
		$usercreate = getSession();

		if(isset($_REQUEST['ads_id'])):

			$form_data = array(
				'ads_name'=>$ads_name,
				'ads_code'=>$ads_code,
				'ads_link'=>$ads_link,
				'ads_position'=>$ads_position,
				'datestart'=>$datestart,
				'dateend'=>$dateend,
				'status'=>$status
			);
			$update = $this->updaterow('kp_banner_ads',$form_data,"where ads_id = '{$id}' ");
		endif;

		if($update===TRUE){
			//start function save log transection
			$desclog = "แก้ไข แบนเนอร์โฆษณา  ชื่อ $ads_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['respontext'] = "Update $ads_name success!";
			$respon['msg'] = "แก้ไข แบนเนอร์โฆษณาสำเร็จ!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "error";
			$respon['respontext'] = "Update $ads_name error!";
			$respon['msg'] = "ไม่สามารถ แก้ไข แบนเนอร์โฆษณาสำเร็จ  กรุณาติดต่อ Support";
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
			$qr = $this->fetchdata("kp_banner_ads","where ads_id = '$id'");
			$res = $qr->fetch_object();
			$sname = $res->ads_name;
			$del = $this->updaterow("kp_banner_ads",array('is_delete'=>1),"where ads_id = '$id' ");
		endif;

		if($del===TRUE){
			//start function save log transection
			$desclog = "ลบ แบนเนอร์โฆษณา  ชื่อ $sname";
			savelog(getSession(),$desclog);
			//end function save log transection
			$respon['status'] = "success";
			$respon['respontext'] = "Delete ads success!";
			$respon['msg'] = "ลบ แบนเนอร์โฆษณาสำเร็จ!";
		}else{
			$respon['status'] = "error";
			$respon['respontext'] = "Delete ads error!";
			$respon['msg'] = "ไม่สามารถ ลบ  แบนเนอร์โฆษณาสำเร็จ  กรุณาติดต่อ Support";
		}

		echo json_encode($respon);
	}

	// begin function upload img
	public function uploadImg()
	{
		if(empty($_REQUEST['ads_id'])==true){
			$id = $this->NewID('ADS','ads_id','kp_banner_ads');
		}else{
			$id = $_REQUEST['ads_id'];
		}

		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'bannerads-'.$id.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,400,"../images/banners/ads/tmp/");
			copy($file_tmp,"../images/banners/ads/$pic_name");

			if(empty($_REQUEST['ads_id'])==true){
				$form_data = array(
					'ads_id'=>$id,
					'ads_img'=>$pic_name,
					'is_delete'=>0
				);
				$updateimg = $this->insertrow('kp_banner_ads',$form_data);
			}else{
				$form_data = array(
					'ads_img'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_banner_ads', $form_data, "WHERE ads_id = '$id'");
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


	public function delImg(){
		$f = $_REQUEST['f'];
		$id = $_REQUEST['id'];
		$output = array();
		$qr = $this->fetchdata("kp_banner_ads","where ads_id = '{$id}' ");
		$res = $qr->fetch_object();

		if($f=='ads_img'){
			$updateimg = $this->updaterow('kp_banner_ads', array('ads_img'=>''), "WHERE ads_id = '{$id}' ");
			if($updateimg){
				$output['status'] = "success";
				$output['msg'] = "ลบรูปภาพสำเร็จ!";
				$output['id'] =$id;

				if(file_exists("../images/banners/ads/{$res->ads_img}")==true){
					unlink("../images/banners/ads/{$res->ads_img}");
					unlink("../images/banners/ads/tmp/{$res->ads_img}");
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
		$name = $this->getTextformid("kp_banner_ads","ads_name","ads_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_banner_ads",array('status'=>$status),"where ads_id = '{$id}' ");
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



}
