<?php
$param = "social";
require "models/$param.php";

class socialController extends Controllers
{
	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "ตั้งค่าลิงค์ Social";
		$param = "social";
		$classpage = "";
		$model = new socialController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->readData();
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
			'add'=>' <button type="button" class="btnsave btn btn-primary btn-with-icon">
							<div class="ht-40">
								<span class="icon wd-40"><i class="fa fa-save"></i></span>
								<span class="pd-x-15">บันทึกแก้ไข</span>
							</div>
						</button>'
		);
		// permission mwnu


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
		$urlweb = curPageURLweb();
		$qr = $this->fetchdata("kp_social","where id = '1' ");
		$res = $qr->fetch_object();


		$rows = array(
			'linkurl'=>$res->linkurl,
			'facebook'=>$res->facebook,
			'facebookchat'=>$res->facebook_chat,
			'google'=>$res->google,
			'lineadd'=>$res->lineadd,
			'line'=>$res->line,
			'youtube'=>$res->youtube,
			'instagram'=>$res->instagram,
			'updatedate'=>$res->updatedate
		);

		echo json_encode($rows);
	}

	//begin function updateData
	public function updateData()
	{
		$id = '1';
		$link = $_REQUEST['txtlink'];
		$facebook = $_REQUEST['txtfacebook'];
		$facebookchat = $_REQUEST['txtfacebookchat'];
		$google = $_REQUEST['txtgoogle'];
		$lineadd = $_REQUEST['txtlineadd'];
		$lineid = $_REQUEST['txtlineid'];
		$youtube = $_REQUEST['txtyoutube'];
		$instagram = $_REQUEST['txtinstagram'];
		$dateupdate = date("Y-m-d H:i:s");

		if($id):
		$form_data = array(
			'linkurl'=>$link,
			'facebook'=>$facebook,
			'facebook_chat'=>$facebookchat,
			'google'=>$google,
			'lineadd'=>$lineadd,
			'line'=>$lineid,
			'youtube'=>$youtube,
			'instagram'=>$instagram,
			'updatedate'=>$dateupdate
		);

		$update = $this->updaterow('kp_social', $form_data, "WHERE id = '$id'");
		endif;

		if($update){
			$respon['status'] = "success";
			$respon['msg'] = "Update success!";
		}else{
			$respon['status'] = "success";
			$respon['msg'] = "Update fail!";
		}

		echo json_encode($respon);
	}

	//end function addData

}
