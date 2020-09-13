<?php
$param = "seo";
require "models/$param.php";


class seoController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "ตั้งค่า SEO";
		$param = "seo";
		$classpage = "";
		$model = new seoController;

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


		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/bootstrap-tagsinput/bootstrap-tagsinput.css' rel='stylesheet'>"
		);

		$jsarr = array(
			"<script src='".$dir."lib/bootstrap-tagsinput/bootstrap-tagsinput.js'></script>"
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
		$urlweb = curPageURLweb();
		$qr = $this->fetchdata("kp_seo","where id = '1' ");
		$res = $qr->fetch_object();


		$rows = array(
			'seotitle'=>$res->seotitle,
			'seodesc'=>$res->seodesc,
			'seokeyword'=>$res->seokeyword,
			'googleid'=>$res->google_id,
			'googledomain'=>$res->google_domain
		);

		echo json_encode($rows);
	}





	//begin function updateData
	public function updateData()
	{
		$id = '1';
		$title = $_REQUEST['txttitle'];
		$desc = $_REQUEST['txtdesc'];
		$keyword = $_REQUEST['txtkeyword'];
		$googleid = $_REQUEST['txtgoogle'];
		$googledomain = $_REQUEST['txtgoogledomain'];

		if($id):
		$form_data = array(
			'seotitle'=>$title,
			'seodesc'=>$desc,
			'seokeyword'=>$keyword,
			'google_id'=>$googleid,
			'google_domain'=>$googledomain
		);

		$update = $this->updaterow('kp_seo', $form_data, "WHERE id = '$id'");
		endif;

		if($update){
			$respon['status'] = "success";
			$respon['msg'] = "Update success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Update fail!";
		}

		echo json_encode($respon);
	}

	//end function addData

}
