<?php
$param = "sysdata";
require "models/$param.php";


class sysdataController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "ข้อมูลของระบบ";
		$param = "sysdata";
		$classpage = "";
		$model = new sysdataController;

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

		$qr = $this->fetchdata("kp_sysinfo","where 1");
		$res = $qr->fetch_object();


		$rows = array(
			'company_name'=>$res->company_name,
			'company_name_th'=>$res->company_name_th,
			'company_addr1'=>$res->company_addr1,
			'company_addr2'=>$res->company_addr2,
			'company_tel'=>$res->company_tel,
			'vat_percentage'=>$res->vat_percentage,
			'tax_no'=>$res->tax_no,
			'juristic_percentage'=>$res->juristic_percentage,
			'lease_line1'=>$res->lease_line1,
			'lease_line2'=>$res->lease_line2,
			'lease_line3'=>$res->lease_line3,
			'kiosk_fine_perday'=>$res->kiosk_fine_perday,
			'klease_witness1'=>$res->klease_witness1,
			'klease_witness2'=>$res->klease_witness2,

		);

		echo json_encode($rows);
	}



	//begin function updateData
	public function updateData()
	{
		// $id = '1';
		$company_name = $_REQUEST['company_name'];
		$company_name_th = $_REQUEST['company_name_th'];
		$company_addr1 = $_REQUEST['company_addr1'];
		$company_addr1 = $_REQUEST['company_addr2'];
		$company_tel = $_REQUEST['company_tel'];
		$vat_percentage = $_REQUEST['vat_percentage'];
		$tax_no = $_REQUEST['tax_no'];
		$juristic_percentage = $_REQUEST['juristic_percentage'];
		$lease_line1 = $_REQUEST['lease_line1'];
		$lease_line2 = $_REQUEST['lease_line2'];
		$lease_line3 = $_REQUEST['lease_line3'];
		$kiosk_fine_perday = $_REQUEST['kiosk_fine_perday'];
		$klease_witness1 = $_REQUEST['klease_witness1'];
		$klease_witness2= $_REQUEST['klease_witness2'];

		if(isset($company_name)):

		$form_data = array(
			'company_name'=>$company_name,
			'company_name_th'=>$company_name_th,
			'company_addr1'=>$company_addr1,
			'company_addr2'=>$company_addr1,
			'company_tel'=>$company_tel,
			'vat_percentage'=>$vat_percentage,
			'tax_no'=>$tax_no,
			'juristic_percentage'=>$juristic_percentage,
			'lease_line1'=>$lease_line1,
			'lease_line2'=>$lease_line2,
			'lease_line3'=>$lease_line3,
			'kiosk_fine_perday'=>$kiosk_fine_perday,
			'klease_witness1'=>$klease_witness1,
			'klease_witness2'=>$klease_witness2
		);

		$update = $this->updaterow('kp_sysinfo', $form_data, "WHERE 1");
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


	// end function delete img

	public function loadProvince(){
		$arr = array();
		$qr = $this->fetchdata("kp_province","where 1 order by provincename asc");
		while($res = $qr->fetch_object()){
			$arr['id'] = $res->provincecode;
			$arr['name'] = $res->provincename;
			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}


}
