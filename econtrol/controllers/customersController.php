<?php
$param = "customers";
require "models/$param.php";

class customersController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "ฐานข้อมูลของระบบ";
		$pagename = "ข้อมูลผู้เช่าอาคาร";
		$param = "customers";
		$classpage = 1;
		$model = new customersController;

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

			case 'loadrentertype' :
				 $model->loadRentertype();
				 break;

			case 'add' :
				 $model->addData();
				 break;

			case 'loaddataedit' :
				 $model->loadDataedit();
				 break;

			case 'edit' :
				 $model->updateData();
				 break;

			case 'del' :
				 $model->delData();
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
			'add'=>'<a href="javascript:;" id="addform" class="btn btn-info"> เพิ่ม </a>'
		);
		// permission mwnu

		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link href='".$dir."lib/datatables/buttons.dataTables.min.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>",
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",
			"<script src='".$dir."lib/datatables/dataTables.buttons.min.js'></script>",
			"<script src='".$dir."lib/datatables/buttons.flash.min.js'></script>",
			"<script src='".$dir."lib/datatables/jszip.min.js'></script>",
			"<script src='".$dir."lib/datatables/pdfmake.min.js'></script>",
			"<script src='".$dir."lib/datatables/vfs_fonts.js'></script>",
			"<script src='".$dir."lib/datatables/buttons.html5.min.js'></script>",
			"<script src='".$dir."lib/datatables/buttons.print.min.js'></script>",

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

		$sql = "select * from kp_renter where is_delete = 0 ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$num = $qr->num_rows;
		$count = $num;

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

		$sql = "select * from kp_renter where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( lower(renter_name) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR lower(renter_addr1) LIKE lower('%".$requestData['search']."%')";
			$sql.= "OR renter_tel LIKE '%".$requestData['search']."%' ";
			$sql.= "OR renter_taxno LIKE '%".$requestData['search']."%' ";
			$sql.= "OR renter_cardno LIKE '%".$requestData['search']."%' ) ";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$renter_id = $res->renter_id;
			$renter_name = $res->renter_name;
			$renter_addr1 = $res->renter_addr1;
			$renter_addr2 = $res->renter_addr2;
			$renter_tel = $res->renter_tel;
			$renter_fax = $res->renter_fax;
			$renter_cardno = $res->renter_cardno;
			$renter_taxno = $res->renter_taxno;
			$renter_note = $res->renter_note;
			$renter_type = $this->getTextformid('kp_rentertype','rentertype_name','rentertype_id',$res->rentertype_id);
			$created = date("d/m/Y H:i:s",strtotime($res->create_date));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);
			// $btn_act = '<div>';
			// $btn_act.= '<button class="btn btn-sm btn-danger"><i class="icon ion-trash-a"></i></button>';
			// $btn_act.= '</div>';
			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$renter_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$renter_id','$renter_name');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = getMenu_permission_button($btn_act);

			$row = array();
			$row[id] = $renter_id;
			$row[renter_name] = $renter_name;
			$row[renter_type] = $renter_type;
			$row[renter_addr1] = $renter_addr1;
			$row[renter_addr2] = $renter_addr2;
			$row[renter_tel] = $renter_tel;
			$row[renter_fax] = $renter_fax;
			$row[renter_cardno] = $renter_cardno;
			$row[renter_taxno] = $renter_taxno;
			$row[renter_note] = $renter_note;
			$row[created] = $created;
			$row[creator] = $creator;
			$row[btn_act] = $btnaction;
			array_push($arr,$row);
		}
		$output = array();
		$output[records] = $count;
		$output[page] = $page;
		$output[total] = ceil($count/$limit);
		$output[rows] = $arr;

		echo json_encode($output);
	}


	// brgin function loadrentertype
	public function loadRentertype(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_rentertype","where is_delete=0 order by rentertype_id asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->rentertype_id;
			$arr['name']= $res->rentertype_name;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}


	// end function loadrentertype

	//begin function addData
	public function addData()
	{
		$renter_id = $this->NewID('C','renter_id','kp_renter');
		$renter_name = $_POST['renter_name'];
		$renter_addr1 = $_POST['renter_addr1'];
		$renter_addr2 = $_POST['renter_addr2'];
		$renter_tel = $_POST['renter_tel'];
		$renter_fax = $_POST['renter_fax'];
		$renter_cardno = $_POST['renter_cardno'];
		$renter_taxno = $_POST['renter_taxno'];
		$renter_note = $_POST['renter_note'];
		$rentertype_id = $_POST['rentertype_id'];
		$is_delete = 0;
		$usercreate = getSession();

		if(isset($renter_name)):

			$form_data = array(
				'renter_id'=>$renter_id,
				'renter_name'=>$renter_name,
				'renter_addr1'=>$renter_addr1,
				'renter_addr2'=>$renter_addr2,
				'renter_tel'=>$renter_tel,
				'renter_fax'=>$renter_fax,
				'renter_cardno'=>$renter_cardno,
				'renter_taxno'=>$renter_taxno,
				'renter_note'=>$renter_note,
				'rentertype_id'=>$rentertype_id,
				'user_create'=>$usercreate,
				'is_delete'=>$is_delete
			);

			$insert = $this->insertrow('kp_renter',$form_data);

		endif;

		if($insert){

			//start function save log transection
			$desclog = "เพิ่ม [ช้อมูลผู้เช่า] ชื่อ $renter_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$jsonstatus = "success";
			$jsonrespontext = "Add $renter_name success!";
			$jsonmsg = "เพิ่มข้อมูลผู้เช่าสำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Add $renter_name error!";
			$jsonmsg = "ไม่สามารถ เพิ่มข้อมูลผู้เช่าสำเร็จ  กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
	}

	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_renter","where renter_id = '$id'");
		$res = $qr->fetch_object();

		$output = array();
		$output[renter_id] = $res->renter_id;
		$output[renter_name] = $res->renter_name;
		$output[renter_addr1] = $res->renter_addr1;
		$output[renter_addr2] = $res->renter_addr2;
		$output[renter_tel] = $res->renter_tel;
		$output[renter_fax] = $res->renter_fax;
		$output[renter_taxno] = $res->renter_taxno;
		$output[renter_cardno] = $res->renter_cardno;
		$output[renter_note] = $res->renter_note;
		$output[rentertype_id] = $res->rentertype_id;

		$arrdatatype = array();
		$qrtype = $this->fetchdata("kp_rentertype","where is_delete=0 order by rentertype_id asc ");
		while($restype = $qrtype->fetch_object()){

			$arrdatatype['id'] = $restype->rentertype_id;
			$arrdatatype['name']= $restype->rentertype_name;

			$respon['datarow'][] = $arrdatatype;
		}

		$output[datatype] = $respon;

		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function updateData
	public function updateData()
	{
		$id = $_REQUEST['renter_id'];
		$renter_name = $_POST['renter_name'];
		$renter_addr1 = $_POST['renter_addr1'];
		$renter_addr2 = $_POST['renter_addr2'];
		$renter_tel = $_POST['renter_tel'];
		$renter_fax = $_POST['renter_fax'];
		$renter_cardno = $_POST['renter_cardno'];
		$renter_taxno = $_POST['renter_taxno'];
		$renter_note = $_POST['renter_note'];
		$rentertype_id = $_POST['rentertype_id'];
		$usercreate = getSession();

		if(isset($id)):

			$form_data = array(
				'renter_name'=>$renter_name,
				'renter_addr1'=>$renter_addr1,
				'renter_addr2'=>$renter_addr2,
				'renter_tel'=>$renter_tel,
				'renter_fax'=>$renter_fax,
				'renter_cardno'=>$renter_cardno,
				'renter_taxno'=>$renter_taxno,
				'renter_note'=>$renter_note,
				'rentertype_id'=>$rentertype_id
			);

			$update = $this->updaterow('kp_renter', $form_data, "WHERE renter_id = '$id'");

		endif;

		if($update){

			//start function save log transection
			$desclog = "แก้ไข [ช้อมูลผู้เช่า] ชื่อ $renter_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$jsonstatus = "success";
			$jsonrespontext = "Update [$renter_name] success!";
			$jsonmsg = "แก้ไข ข้อมูลผู้เช่า [$renter_name] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Update [$renter_name] error!";
			$jsonmsg = "ไม่สามารถ แก้ไขข้อมูลผู้เช่า [$renter_name] สำเร็จ  กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","respontext"=>$jsonrespontext,"msg"=>"$jsonmsg");
		echo json_encode($respon);
	}
	//end function updateData

	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_renter","where renter_id = '$id' ");
		$res= $qr->fetch_object();
		$renter_name = $res->renter_name;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_renter",array('is_delete'=>'1'),"where renter_id = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [ช้อมูลผู้เช่า] ชื่อ $renter_name";
			savelog(getSession(),$desclog);
			//end function save log transection


			$jsonstatus = "success";
			$jsonrespontext = "Delete [$renter_name] success!";
			$jsonmsg = "ลบ ข้อมูลผู้เช่า [$renter_name] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Delete [$renter_name] error!";
			$jsonmsg = "ไม่สามารถ ลบ ข้อมูลผู้เช่า [$renter_name] สำเร็จ  กรุณาติดต่อ Support";
		}

		$respon = array('status'=>$jsonstatus,'respontext'=>$jsonrespontext,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}
	//end function delData

}
