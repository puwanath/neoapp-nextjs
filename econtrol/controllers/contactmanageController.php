<?php
$param = "contactmanage";
require "models/$param.php";


class contactmanageController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "จัดการข้อมูลติดต่อเรา";
		$param = "contactmanage";
		$classpage = "";
		$model = new contactmanageController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->readData();
				 break;

			case 'update' :
				 $model->updateData();
				 break;

		  case 'uploadimg-photomap' :
 				 $model->uploadimgphotomap();
 				 break;

		  case 'delimg' :
 				 $model->delImg();
 				 break;

			case 'loadprovince' :
				 $model->loadProvince();
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


		if($select==''){
			$content = "views/$param/index.php";
			$page = include("views/layout/template.php");
			return $page;
		}


	}
	//end function page

	public function readData()
	{
		$url = curPageURL();
		$urlweb = curPageURLWeb();
		$qr = $this->fetchdata("kp_contact_info","where id = '1' ");
		$res = $qr->fetch_object();
		if($res->contact_photomap!=''){
			$img = "$urlweb/images/$res->contact_photomap";
			$btn_contact_photomap = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('contact_photomap')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img = "";
			$btn_contact_photomap = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}


		$rows = array(
			'contact_name_th'=>$res->contact_name_th,
			'contact_name_en'=>$res->contact_name_en,
			'contact_address_th'=>$res->contact_address_th,
			'contact_address_en'=>$res->contact_address_en,
			'contact_tel_th'=>$res->contact_tel_th,
			'contact_tel_en'=>$res->contact_tel_en,
			'contact_email'=>$res->contact_email,
			'contact_lineid'=>$res->contact_lineid,
			'contact_facebook'=>$res->contact_facebook,
			'contact_location_name'=>$res->contact_location_name,
			'contact_location_lon'=>$res->contact_location_lon,
			'contact_location_lat'=>$res->contact_location_lat,
			'contact_location_zoom'=>$res->contact_location_zoom,
			'contact_receive_mail'=>$res->contact_receive_mail,
			'contact_photomap'=>$img,
			'btn_contact_photomap'=>$btn_contact_photomap,
			'dateupdate'=>date("d/m/Y H:i:s",strtotime($res->create_date))
		);

		echo json_encode($rows);
	}





	//begin function updateData
	public function updateData()
	{
		$id = '1';
		$contact_name_th = $_REQUEST['contact_name_th'];
		$contact_name_en = $_REQUEST['contact_name_en'];
		$contact_address_th = $_REQUEST['contact_address_th'];
		$contact_address_en = $_REQUEST['contact_address_en'];
		$contact_tel_th = $_REQUEST['contact_tel_th'];
		$contact_tel_en = $_REQUEST['contact_tel_en'];
		$contact_email = $_REQUEST['contact_email'];
		$contact_lineid = $_REQUEST['contact_lineid'];
		$contact_facebook = $_REQUEST['contact_facebook'];
		$contact_location_name = $_REQUEST['namePlace'];
		$contact_location_lon = $_REQUEST['lon_value'];
		$contact_location_lat = $_REQUEST['lat_value'];
		$contact_location_zoom= $_REQUEST['zoom_value'];
		$contact_receive_mail= $_REQUEST['contact_receive_mail'];



		if(isset($id)):

		$form_data = array(
			'contact_name_th'=>$contact_name_th,
			'contact_name_en'=>$contact_name_en,
			'contact_address_th'=>$contact_address_th,
			'contact_address_en'=>$contact_address_en,
			'contact_tel_th'=>$contact_tel_th,
			'contact_tel_en'=>$contact_tel_en,
			'contact_email'=>$contact_email,
			'contact_lineid'=>$contact_lineid,
			'contact_facebook'=>$contact_facebook,
			'contact_location_name'=>$contact_location_name,
			'contact_location_lon'=>$contact_location_lon,
			'contact_location_lat'=>$contact_location_lat,
			'contact_location_zoom'=>$contact_location_zoom,
			'contact_receive_mail'=>$contact_receive_mail
		);

		$update = $this->updaterow('kp_contact_info', $form_data, "WHERE id = '$id'");
		endif;

		if($update){
			$jsonstatus = "success";
			$jsonmsg = "Update Success!";
		}else{
			$jsonstatus = "error";
			$jsonmsg = "Update Error!";
		}

		$respon = array('status'=>$jsonstatus,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}

	//end function addData


	//begin function updateimg
	public function uploadimgphotomap()
	{
		$id = 1;
		$img = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = "contact_photomap-".time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"../images/");
			copy($file_tmp,"../images/$pic_name");

			$form_data = array(
				'contact_photomap'=>$pic_name
			);

			$updateimg = $this->updaterow('kp_contact_info', $form_data, "WHERE id = '$id'");
		}

		if($updateimg){
			$output[status] = "success";
			$output[msg] = "อัพโหลดสำเร็จ!";
		}else{
			$output[status] = "error";
			$output[msg] = "อัพโหลดไม่สำเร็จ!";
		}


		echo json_encode($output);

	}

	//end function updateimg

	// begin function delete img
	public function delImg(){
		$f = $_GET['f'];
		$id =1;
		$qr = $this->fetchdata("kp_contact_info","where id = '$id' ");
		$res = $qr->fetch_object();
		if($f=='contact_photomap'){
			if(file_exists("../images/$res->contact_photomap")){
				unlink('../images/'.$res->contact_photomap);
			}
			$del = $this->updaterow("kp_contact_info",array('contact_photomap'=>''),"where id = 1");
		}
		if($del){
			$output[status] = "success";
			$output[msg] = "ลบภาพเสร็จแล้ว!";
		}else{
			$output[status] = "error";
			$output[msg] = "ลบภาพไม่สำเร็จ กรุณาตรวจสอบ!";
		}


		echo json_encode($output);
	}

	// end function delete img

	public function loadProvince(){
		$arr = array();
		$qr = $this->fetchdata("kp_provinces","where 1 order by name_th asc");
		while($res = $qr->fetch_object()){
			$arr['id'] = $res->code;
			$arr['name'] = $res->name_th;
			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}


}
