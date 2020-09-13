<?php
$param = "paymentsetting";
require "models/$param.php";

class paymentsettingController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการประเภทการชำระเงิน";
		$pagename = "ตั้งค่าการชำระเงิน";
		$param = "paymentsetting";
		$classpage = "";
		$model = new paymentsettingController;

		if(isset($_REQUEST['select'])){
			$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		}else{
			$select = isset($_REQUEST['oper']) ? $_REQUEST['oper'] : '';
		}

		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->loadData();
				 break;

		  case 'isstatus' :
		  	 $model->changeIsstatus();
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
			// 'add'=>' <button type="button" id="addform" class="btn btn-primary btn-with-icon">
			// 				<div class="ht-40">
			// 					<span class="icon wd-40"><i class="fa fa-plus"></i></span>
			// 					<span class="pd-x-15">เพิ่ม</span>
			// 				</div>
			// 			</button>',
			// 'del'=>' <button type="button" id="delselect" class="btn btn-danger btn-with-icon" disabled="true" >
			// 				<div class="ht-40">
			// 					<span class="icon wd-40"><i class="fa fa-trash"></i></span>
			// 					<span class="pd-x-15">ลบที่เลือก</span>
			// 				</div>
			// 			</button>'
		);
		// permission mwnu

		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>",
			"<link href='".$dir."lib/bootstrap-tagsinput/bootstrap-tagsinput.css' rel='stylesheet'>"
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",
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

	public function loadData(){
		$arr = array();
		$url = curPageURL();
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

		$sql = "select count(*) as count from kp_payment_type where 1=1 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( payment_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  payment_name_en LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  payment_code LIKE '%".$requestData['search']."%') ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$res = $qr->fetch_object();
		$count = $res->count;

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

		$sql = "select * from kp_payment_type where 1=1 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( payment_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  payment_name_en LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  payment_code LIKE '%".$requestData['search']."%') ";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$payment_id = $res->payment_id;
			$payment_name_th = $res->payment_name_th;
			$payment_name_en = $res->payment_name_en;
			$payment_code = $res->payment_code;
			$payment_setting = $res->payment_setting;


			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$payment_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$payment_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			if(!empty($payment_setting)){
				$btn_bank = "<a href=\"$url/$payment_setting\" class=\"btn btn-sm btn-dark\"><i class=\"fa fa-cog\"></i> จัดการธนาคาร </a>";
			}else{
				$btn_bank = "";
			}


			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_bank.$btn_status;
			$btnaction.= '</div>';

			$row = array();
			$row['id'] = $payment_id;
			$row['payment_name_th'] = $payment_name_th;
			$row['payment_name_en'] = $payment_name_en;
			$row['payment_code'] = $payment_code;
			$row['btn_act'] = $btnaction;
			$arr[] = $row;
		}
		$output = array();
		$output['records'] = $count;
		$output['page'] = $page;
		$output['total'] = ceil($count/$limit);
		$output['rows'] = $arr;

		echo json_encode($output);
	}

	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$payment_name_th = $this->getTextformid("kp_payment_type","payment_name_th","payment_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_payment_type",array('status'=>$status),"where payment_id = '$id' ");
		}


		if($updatestatus){
			//start function save log transection
			$desclog = "เปลี่ยน $payment_name_th ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$payment_name_th] success!";
		}else{
			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$payment_name_th] error!";
		}
		echo json_encode($respon);
	}


}
