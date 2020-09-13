<?php
$param = "setting";
require "models/$param.php";


class cogController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "ตั้งค่าระบบ";
		$param = "setting";
		$classpage = "";
		$model = new cogController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->readData();
				 break;

			case 'update' :
				 $model->updateData();
				 break;

		  case 'uploadimg-logo' :
 				 $model->uploadImglogo();
 				 break;

		  case 'uploadimg-logoweb' :
 				 $model->uploadImglogoweb();
 				 break;

		  case 'uploadimg-headlogo' :
 				 $model->uploadImgheadlogo();
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

		// permission mwnu
		$mainmenu = array(
			'confirm'=>' <button type="button" class="btnsave btn btn-primary btn-with-icon">
							<div class="ht-40">
								<span class="icon wd-40"><i class="fa fa-save"></i></span>
								<span class="pd-x-15">บันทึกแก้ไข</span>
							</div>
						</button>'
		);
		// permission mwnu

		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link href='".$dir."lib/spectrum/spectrum.css' rel='stylesheet'>",
			"<link href='".$dir."sweetalert2/dist/sweetalert2.min.css' rel='stylesheet' type='text/css' />",
			"<script src='".$dir."sweetalert2/dist/sweetalert2.min.js'></script>",
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",
			"<script src='".$dir."lib/spectrum/spectrum.js'></script>",


		);
		//end css and js script

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
		$qr = $this->fetchdata("kp_config","where cog_id = '1' ");
		$res = $qr->fetch_object();
		if($res->logo!=''){
			$img = "$url/images/$res->logo";
			$btn_logo = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('logo')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img = "";
			$btn_logo = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}
		if($res->logo_web!=''){
			$imgweb = "$urlweb/images/$res->logo_web";
			$btn_logoweb = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('logo_web')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$imgweb = "";
			$btn_logoweb = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fleweb')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}
		if($res->head_logo!=''){
			$imghead = "$urlweb/images/$res->head_logo";
			$btn_headlogo = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('head_logo')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$imghead = "";
			$btn_headlogo = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fleheadprint')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}

		// $qrvat = $this->fetchdata("kp_vat","where vat_id = '1'");
		// $resvat = $qrvat->fetch_object();


		$rows = array(
			'companyname'=>$res->companyname,
			'companyname_en'=>$res->companyname_en,
			'companyaddress1'=>$res->companyaddress1,
			'companyaddress2'=>$res->companyaddress2,
			'companyaddress1_en'=>$res->companyaddress1_en,
			'companyaddress2_en'=>$res->companyaddress2_en,
			'companyprovince'=>$res->companyprovince,
			'companypostcode'=>$res->companypostcode,
			'companytel1'=>$res->companytel1,
			'companytel2'=>$res->companytel2,
			'companyemail'=>$res->companyemail,
			'companytax'=>$res->companytax,
			'brancetype'=>$res->companybrance,
			'branceno'=>$res->companybrance_number,
			'vat'=>$res->vat,
			'fee'=>$res->fee,
			'logo'=>$img,
			'logoweb'=>$imgweb,
			'headlogo'=>$imghead,
			'btn_logo'=>$btn_logo,
			'btn_logoweb'=>$btn_logoweb,
			'btn_headlogo'=>$btn_headlogo,
			'mail_host'=>$res->mail_host,
			'mail_port'=>$res->mail_port,
			'mail_username'=>$res->mail_username,
			'mail_password'=>$res->mail_password,
			// 'vat7'=>$resvat->s_vat,
			// 'tax3'=>$resvat->w_vat,
			'dateupdate'=>date("d/m/Y H:i:s",$res->dateupdate),
			'status'=>$res->status

		);

		echo json_encode($rows);
	}





	//begin function updateData
	public function updateData()
	{
		$id = '1';
		$compname = $_REQUEST['txtcompname_th'];
		$compname_en = $_REQUEST['txtcompname_en'];
		$compaddress1 = $_REQUEST['txtadddess1_th'];
		$compaddress2 = $_REQUEST['txtadddess2_th'];
		$compaddress1_en = $_REQUEST['txtadddess1_en'];
		$compaddress2_en = $_REQUEST['txtadddess2_en'];
		$compprovince = $_REQUEST['txtprovince'];
		$comppostcode = $_REQUEST['txtpostcode'];
		$brancetext = $_REQUEST['txtbrancetype'];
		$branceno = $_REQUEST['txtbranceno'];
		$comptel1 = $_REQUEST['txttel1'];
		$comptel2 = $_REQUEST['txttel2'];
		$compemail= $_REQUEST['txtemail'];
		$comptax= $_REQUEST['txttax'];
		$vat7= $_REQUEST['txtvat7'];
		$fee= $_REQUEST['txtfee'];
		$tax3= $_REQUEST['tax3'];
		$status = $_REQUEST['status'];
		$mail_host = $_REQUEST['mail_host'];
		$mail_port = $_REQUEST['mail_port'];
		$mail_username = $_REQUEST['mail_username'];
		$mail_password = $_REQUEST['mail_password'];


		if(isset($id)):

		$form_data = array(
			'companyname'=>$compname,
			'companyname_en'=>$compname_en,
			'companyaddress1'=>$compaddress1,
			'companyaddress2'=>$compaddress2,
			'companyaddress1_en'=>$compaddress1_en,
			'companyaddress2_en'=>$compaddress2_en,
			'companyprovince'=>$compprovince,
			'companypostcode'=>$comppostcode,
			'companytel1'=>$comptel1,
			'companytel2'=>$comptel2,
			'companyemail'=>$compemail,
			'companytax'=>$comptax,
			'companybrance'=>$brancetext,
			'companybrance_number'=>$branceno,
			'vat'=>$vat7,
			'fee'=>$fee,
			'mail_host'=>$mail_host,
			'mail_port'=>$mail_port,
			'mail_username'=>$mail_username,
			'mail_password'=>$mail_password,
			'dateupdate'=>strtotime(date("Y-m-d H:i:s")),
			'status'=>$status
		);

		$update = $this->updaterow('kp_config', $form_data, "WHERE cog_id = '$id'");
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
	public function uploadImglogo()
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
			$pic_name = "logoecontrol-".time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"images/");
			copy($file_tmp,"images/$pic_name");

			$form_data = array(
				'logo'=>$pic_name
			);

			$updateimg = $this->updaterow('kp_config', $form_data, "WHERE cog_id = '$id'");
		}

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "อัพโหลดสำเร็จ!";
		}else{
			$output['status'] = "error";
			$output['msg'] = "อัพโหลดไม่สำเร็จ!";
		}


		echo json_encode($output);

	}
	public function uploadImglogoweb()
	{
		$id = 1;
		$img = $_REQUEST['img'];
		$file      = $_FILES['fleweb']['name'];
		$file_tmp  = $_FILES['fleweb']['tmp_name'];
		$file_type = $_FILES['fleweb']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = "logoweb-".time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"../images/");
			copy($file_tmp,"../images/$pic_name");

			$form_data = array(
				'logo_web'=>$pic_name
			);

			$updateimg = $this->updaterow('kp_config', $form_data, "WHERE cog_id = '$id'");
		}

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "อัพโหลดสำเร็จ!";
		}else{
			$output['status'] = "error";
			$output['msg'] = "อัพโหลดไม่สำเร็จ!";
		}


		echo json_encode($output);

	}
	public function uploadImgheadlogo()
	{
		$id = 1;
		$img = $_REQUEST['img'];
		$file      = $_FILES['fleheadprint']['name'];
		$file_tmp  = $_FILES['fleheadprint']['tmp_name'];
		$file_type = $_FILES['fleheadprint']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = "headprint-".time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"../images/");
			copy($file_tmp,"../images/$pic_name");

			$form_data = array(
				'head_logo'=>$pic_name
			);

			$updateimg = $this->updaterow('kp_config', $form_data, "WHERE cog_id = '$id'");
		}

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "อัพโหลดสำเร็จ!";
		}else{
			$output['status'] = "error";
			$output['msg'] = "อัพโหลดไม่สำเร็จ!";
		}


		echo json_encode($output);

	}
	//end function updateimg

	// begin function delete img
	public function delImg(){
		$f = $_GET['f'];
		$id =1;
		$qr = $this->fetchdata("kp_config","where cog_id = '$id' ");
		$res = $qr->fetch_object();
		if($f=='logo'){
			if(file_exists("images/$res->logo")){
				unlink('images/'.$res->logo);
			}
			$del = $this->updaterow("kp_config",array('logo'=>''),"where cog_id = 1");
		}elseif($f=='logo_web'){
			if(file_exists("../images/$res->logo_web")){
				unlink('../images/'.$res->logo_web);
			}
			$del = $this->updaterow("kp_config",array('logo_web'=>''),"where cog_id = 1");
		}elseif($f=='head_logo'){
			if(file_exists("../images/$res->head_logo")){
				unlink('../images/'.$res->head_logo);
			}
			$del = $this->updaterow("kp_config",array('head_logo'=>''),"where cog_id = 1");
		}

		if($del){
			$output['status'] = "success";
			$output['msg'] = "ลบภาพเสร็จแล้ว!";
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบภาพไม่สำเร็จ กรุณาตรวจสอบ!";
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
