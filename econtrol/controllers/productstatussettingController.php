<?php
$param = "productstatussetting";
require "models/$param.php";

class productstatussettingController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการระบบสินค้า";
		$pagename = "สถานะสินค้า";
		$param = "productstatussetting";
		$classpage = 1;
		$model = new productstatussettingController;

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

		  case 'deleteselect' :
				 $model->deleteSelect();
				 break;

			case 'celledit' :
				 $model->cellEdit();
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


		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>",
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>"

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
		include "common/include/config.php";
		$requestData= $_REQUEST;

		$pageno = $requestData["page"];
		$rows = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;

		$sql = "select count(*) as rowcount from kp_products_status where 1 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( prodstatus_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR prodstatus_name_en LIKE '%".$requestData['search']."%' ) ";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['rowcount'];
		$start = $rows * ($pageno -1);

		$sql = "select * from kp_products_status where 1 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( prodstatus_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR prodstatus_name_en LIKE '%".$requestData['search']."%' ) ";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";

		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = $start;
		while($res= $qr->fetch_object()){
			$i++;
			$id = $res->prodstatus_id;
			$prodstatus_name_th = $res->prodstatus_name_th;
			$prodstatus_name_en = $res->prodstatus_name_en;

			$row['id'] = $id;
			$row['rownum'] = $i;
			$row['prodstatus_name_th'] = $prodstatus_name_th;
			$row['prodstatus_name_en'] = $prodstatus_name_en;
			$row['create_date'] = date("d/m/Y H:i:s",strtotime($res->create));
			$arr[] = $row;
		}
		$output['records'] = $rowcount;
		$output['page'] = $pageno;
		$output['total'] = ceil($rowcount/$rows);
		$output['rows'] = $arr;

		echo json_encode($output);
	}


	public function cellEdit() {

		if($_POST['id']=='newrow')
			$_POST['id']=0;

		$id = $_POST['id'];

		if((isset($_POST['prodstatus_name_en']))&&($_POST['prodstatus_name_en']!='')) {
			$prodstatus_name_en  = $_POST['prodstatus_name_en'];
			$form_data['prodstatus_name_en'] = $prodstatus_name_en;
			$res = $this->fetchdata("kp_products_status","where prodstatus_name_en = '{$prodstatus_name_en}' and prodstatus_id <> {$id}");
			if($res->num_rows>0) {
				echo json_encode(array(
						'status'=>'fail',
						'errmsg'=>'ข้อมูล EN ซ้ำ',
				));
				exit;
			}
		}

		if((isset($_POST['prodstatus_name_th']))&&($_POST['prodstatus_name_th']=='')) {
			echo json_encode(array(
					'status'=>'fail',
					'errmsg'=>'ต้องระบุ คำแปล',
			));
			exit;
		}

		if(isset($_POST['prodstatus_name_en']))
			$form_data['prodstatus_name_en'] = $_POST['prodstatus_name_en'];
		if(isset($_POST['prodstatus_name_th']))
			$form_data['prodstatus_name_th'] = $_POST['prodstatus_name_th'];


		if($id==0) {
			$irow = $this->insertrow('kp_products_status',$form_data);

			$desclog = "เพิ่ม [สถานะสินค้า] $prodstatus_name_th";
			savelog(getSession(),$desclog);
			$jsonmsg = "เพิ่มสถานะสินค้า สำเร็จ!";

 			echo json_encode(array(
				"status"=>"success",
 				"msg"=>$jsonmsg,
				"newrow_id"=>$irow['insert_id'],
 			));
		}
		else {
			if($this->updaterow('kp_products_status', $form_data, "WHERE prodstatus_id = $id")){
				//start function save log transection
				$desclog = "แก้ไข [สถานะสินค้า] $prodstatus_name_th";
				savelog(getSession(),$desclog);
				//end function save log transection

				$jsonstatus = "success";
				$jsonrespontext = "Update สถานะสินค้า [$prodstatus_name_th] success!";
				$jsonmsg = "แก้ไข สถานะสินค้า  [$prodstatus_name_th] สำเร็จ!";
			}
			else {
				$jsonstatus = "error";
				$jsonrespontext = "Update สถานะสินค้า [$prodstatus_name_th] error!";
				$jsonmsg = "ไม่สามารถ แก้ไข สถานะสินค้า  [$prodstatus_name_th] สำเร็จ  กรุณาติดต่อ Support";
			}
			$respon = array("status"=>"$jsonstatus","respontext"=>$jsonrespontext,"msg"=>"$jsonmsg");
			echo json_encode($respon);
		}

	}
	//end function updateData

	//begin function delData
	public function deleteSelect(){
		$set_id = $_REQUEST['id'];

		foreach (explode(',', $set_id)as $ii)
			$del = $this->delrow("kp_products_status","where prodstatus_id = '$ii' ");

		if($del) {
			$set_id = implode(',',$set_id);
			$jsonstatus = "success";
			$jsonmsg = "Delete Product Status Set ID [$set_id] สำเร็จ!";
			//start function save log transection
			$desclog = "Delete Product Status Set ID  [$set_id]";
			savelog(getSession(),$desclog);
		}
		else {
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถลบ Set [$set_id] กรุณาติดต่อ Support";
		}
		$output = array();
		$output['status'] = $jsonstatus;
		$output['msg'] = $jsonmsg;
		echo json_encode($output);
	}
	//end function delData

}
