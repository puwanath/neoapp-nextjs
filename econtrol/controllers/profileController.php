<?php
$param = "profile";
require "models/$param.php";


class profileController extends Controllers
{

	//begin function index start page
	public function index($get_part0){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "จัดการข้อมูลส่วนตัว";
		$param = "profile";
		$model = new profileController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->readData();
				 break;

			case 'uploadimg' :
	 				$model->uploadImg();
	 				break;

			case 'updatepassword' :
				 $model->updatePassword();
				 break;

			case 'update' :
				 $model->updateData();
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
		$useremail = $re->user_email;


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
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_users","where user_id = '$id' ");
		$res = $qr->fetch_object();

		if($res->user_avatar!=''){
			$img = "$url/images/user/tmp/$res->user_avatar";
			$img_big = "$url/images/user/$res->user_avatar";
		}else{
			$img = "$url/images/user/avatar.png";
		}


		$rows = array(
			'id'=>$res->user_id,
			'fullname'=>$res->user_fullname,
			'lastname'=>$res->user_lastname,
			'email'=>$res->user_email,
			'tel'=>$res->user_tel,
			'img'=>$img,
			'imgbig'=>$img_big

		);

		echo json_encode($rows);
	}

	//begin function updateimg
	public function uploadImg()
	{
		$id = getSession();
		$img = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$imgname = md5($file);
			$dot = substr($file,-3,3);
			$pic_name = $imgname ."-".time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,150,"images/user/tmp/");
			copy($file_tmp,"images/user/$pic_name");

			$form_data = array(
				'user_avatar'=>$pic_name
			);


			$updateimg = $this->updaterow('kp_users', $form_data, "WHERE user_id = '$id'");

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



	//begin function addData
	public function updateData()
	{
		$id = $_REQUEST['id'];
		$fullname = $_REQUEST['fullname'];
		$lastname = $_REQUEST['lastname'];
		$email = $_REQUEST['email'];
		$tel = $_REQUEST['tel'];

		if(isset($id)):
		$form_data = array(
			'user_fullname'=>$fullname,
			'user_lastname'=>$lastname,
			'user_tel'=>$tel,
			'user_email'=>$email
		);


		$this->updaterow('kp_users', $form_data, "WHERE user_id = '$id'");
		endif;

		$respon = array('status'=>'success');
		echo json_encode($respon);
	}

	//end function addData


	public function updatePassword()
	{
		$id = $_REQUEST['id'];
		$password = $_REQUEST['currentpass'];
		$newpassword = $_REQUEST['newpass'];
		$confirmpassword = $_REQUEST['confirmpass'];

		$qr = $this->fetchdata("kp_users","where user_id = '$id' ");
		$res = $qr->fetch_object();

		if(md5($password)==$res->user_password){

			if($newpassword==$confirmpassword){
				$mdpass = md5($newpassword);
				$form_data = array(
					'user_password'=>$mdpass
				);

				$this->updaterow('kp_users', $form_data, "WHERE user_id = '$id'");

				$status = "success";
				$msg = "เปลี่ยนรหัสผ่านสำเร็จ!";
			}else{
				$status = "error";
				$msg = "เปลี่ยนรหัสผ่านไม่สำเร็จ! ยืนยันรหัสผ่านไม่ถูกต้อง";

			}


		}else{
			$status = "error";
			$msg = "เปลี่ยนรหัสผ่านไม่สำเร็จ! รหัสผ่านเดิมของคุณไม่ถูกต้อง กรุณาลองใหม่ภายหลัง";
		}




		$respon = array('status'=>$status,'msg'=>$msg);
		echo json_encode($respon);
	}


}
