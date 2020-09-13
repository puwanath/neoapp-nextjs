<?php
$param = "banksetting";
require "models/$param.php";

class banksettingController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการบัญชีธนาคาร";
		$pagename = "รายการบัญชีธนาคาร";
		$param = "banksetting";
		$classpage = "";
		$model = new banksettingController;

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

		  case 'readdataimg' :
				 $model->readDataimg();
				 break;

		  case 'uploadimg' :
				 $model->uploadImg();
				 break;

		  case 'delimg' :
				 $model->delImg();
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

			case 'delselect' :
 	 			 $model->delselectData();
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
			'add'=>' <button type="button" id="addform" class="btn btn-primary btn-with-icon">
							<div class="ht-40">
								<span class="icon wd-40"><i class="fa fa-plus"></i></span>
								<span class="pd-x-15">เพิ่ม</span>
							</div>
						</button>',
			'del'=>' <button type="button" id="delselect" class="btn btn-danger btn-with-icon" disabled="true" >
							<div class="ht-40">
								<span class="icon wd-40"><i class="fa fa-trash"></i></span>
								<span class="pd-x-15">ลบที่เลือก</span>
							</div>
						</button>'
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

		$sql = "select count(*) as count from kp_bank where 1=1 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  (bank_name LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  bank_acc_branch LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  bank_acc_name LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  bank_acc_num LIKE '%".$requestData['search']."%') ";
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

		$sql = "select * from kp_bank where 1=1 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  (bank_name LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  bank_acc_branch LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  bank_acc_name LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  bank_acc_num LIKE '%".$requestData['search']."%') ";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$bank_id = $res->bank_id;
			$bank_name = $res->bank_name;
			$bank_branch = $res->bank_branch;
			$bank_acc_name = $res->bank_acc_name;
			$bank_acc_num = $res->bank_acc_num;

			if(!empty($res->bank_icon)){
				if(file_exists("../images/bank/tmp/$res->bank_icon")==true){
					$img = $urlweb."/images/bank/tmp/$res->bank_icon";
					$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}else{
					$img = $urlweb."/images/no-img.jpg";
					$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}
			}else{
				$img = $urlweb."/images/no-img.jpg";
				$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
			}


			$created = date("d/m/Y H:i:s",strtotime($res->create_date));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$bank_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$bank_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$bank_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$bank_id','$bank_name');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['id'] = $bank_id;
			$row['bank_name'] = $bank_name;
			$row['bank_branch'] = $bank_branch;
			$row['bank_acc_name'] = $bank_acc_name;
			$row['bank_acc_num'] = $bank_acc_num;
			$row['bank_icon'] = $img;
			$row['created'] = $created;
			$row['creator'] = $creator;
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

	//begin function addData
	public function addData()
	{
		$bank_name = $_POST['bank_name'];
		$bank_branch = $_POST['bank_branch'];
		$bank_acc_name = $_POST['bank_acc_name'];
		$bank_acc_num = $_POST['bank_acc_num'];
		$is_status = 1;
		$usercreate = getSession();

		if(isset($bank_name)):

			$form_data = array(
				'bank_name'=>$bank_name,
				'bank_branch'=>$bank_branch,
				'bank_acc_name'=>$bank_acc_name,
				'bank_acc_num'=>$bank_acc_num,
				'user_create'=>$usercreate,
				'status'=>$is_status
			);

			$insert = $this->insertrow('kp_bank',$form_data);
		endif;

		if($insert){
			//start function save log transection
			$desclog = "เพิ่ม [ธนาคาร] ชื่อ $bank_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Add $bank_name success!";
			$respon['id'] = $insert['insert_id'];
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Add $bank_name error!";
			$respon['id'] = $insert['insert_id'];
		}

		echo json_encode($respon);
	}
	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_bank","where bank_id = '$id' ");
		$res = $qr->fetch_object();

		$output = array();
		$output['bank_id'] = $res->bank_id;
		$output['bank_name'] = $res->bank_name;
		$output['bank_branch'] = $res->bank_branch;
		$output['bank_acc_name'] = $res->bank_acc_name;
		$output['bank_acc_num'] = $res->bank_acc_num;
		echo json_encode($output);
	}
	//end function loaddataedit

	//begin function updateData
	public function updateData()
	{
		$id = $_REQUEST['bank_id'];
		$bank_name = $_POST['bank_name'];
		$bank_branch = $_POST['bank_branch'];
		$bank_acc_name = $_POST['bank_acc_name'];
		$bank_acc_num = $_POST['bank_acc_num'];
		$usercreate = getSession();

		if(isset($id)):

			$form_data = array(
				'bank_name'=>$bank_name,
				'bank_branch'=>$bank_branch,
				'bank_acc_name'=>$bank_acc_name,
				'bank_acc_num'=>$bank_acc_num
			);

			$update = $this->updaterow('kp_bank', $form_data, "WHERE bank_id = '$id'");

		endif;

		if($update){

			//start function save log transection
			$desclog = "แก้ไข [ธนาคาร] ชื่อ $bank_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Update [$bank_name] success!";
			$respon['id'] = $id;

		}else{

			$respon['status'] = "success";
			$respon['msg'] = "Update [$bank_name] error!";
			$respon['id'] = $id;

		}
		echo json_encode($respon);
	}
	//end function updateData

	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_bank","where bank_id = '$id' ");
		$res= $qr->fetch_object();
		$bank_name = $res->bank_name;
		if(($qr->num_rows)>0):
		  $del = $this->delrow("kp_bank","where bank_id = '$id' ");
		endif;

		if($del){
			//start function save log transection
			$desclog = "ลบ [ธนาคาร] ชื่อ $bank_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Delete [$bank_name] success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete [$bank_name] error!";
		}

		echo json_encode($respon);
	}
	//end function delData

	//begin function delselectData
	public function delselectData()
	{
		$set_id = $_REQUEST['setid'];
		// $set_id = explode(',',$set_id);

		foreach ($set_id as $key => $value) {
			$id = $value;
			if(isset($id)){
				$del = $this->delrow("kp_bank","where bank_id = '$id' ");
			}
		}

		if($del){
			$set_id = implode(',',$set_id);

			//start function save log transection
			$desclog = "ลบ [ช้อมูลธนาคารตามที่เลือก] Set $set_id";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Delete [$set_id] success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete [$set_id] error!";
		}

		echo json_encode($respon);
	}
	//end function delselectData


	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$bank_name = $this->getTextformid("kp_bank","bank_name","bank_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_bank",array('status'=>$status),"where bank_id = '$id' ");
		}


		if($updatestatus){
			//start function save log transection
			$desclog = "เปลี่ยน $bank_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$bank_name] success!";
		}else{
			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$bank_name] error!";
		}
		echo json_encode($respon);
	}


	//begin function updateimg
	public function readDataimg(){
		$url = curPageURL();
		$url2 = curPageURLweb();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_bank","where bank_id = '$id' ");
		$res = $qr->fetch_object();

		if($res->bank_icon!=''){
			$img = "$url2/images/bank/tmp/$res->bank_icon";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('bank_icon','$id')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img = "";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}

		echo json_encode(array('btnupload'=>$btn,'img'=>$img));
	}

	public function uploadImg()
	{
		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'bank-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"../images/bank/tmp/");
			copy($file_tmp,"../images/bank/$pic_name");

			if(empty($_REQUEST['bank_id'])==true){
				$sort = $this->sortMax('kp_bank','sort');
				$usercreate = getSession();
				$form_data = array(
					'bank_icon'=>$pic_name,
					'status'=>1,
					'user_create'=>$usercreate
				);
				$updateimg = $this->insertrow('kp_bank',$form_data);
				$id = $updateimg['insert_id'];
			}else{
				$id = $_REQUEST['bank_id'];
				$form_data = array(
					'bank_icon'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_bank', $form_data, "WHERE bank_id = '$id'");
			}

		}

		if($updateimg){
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

		$qr = $this->fetchdata("kp_bank","where bank_id = '$id' ");
		$res = $qr->fetch_object();

		$updateimg = $this->updaterow('kp_bank', array('bank_icon'=>''), "WHERE bank_id = '".$id."' ");

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
			$output['id'] =$id;

			if(file_exists("../images/bank/$res->bank_icon")==true){
				unlink("../images/bank/$res->bank_icon");
				unlink("../images/bank/tmp/$res->bank_icon");
			}
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
		}


		echo json_encode($output);

	}


}
