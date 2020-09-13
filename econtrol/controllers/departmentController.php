<?php
$param = "department";
require "models/$param.php";

class departmentController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "เริ่มระบบ";
		$pagename = "จัดการฝ่าย/แผนกทีมงาน";
		$param = "department";
		$classpage = "";
		$model = new departmentController;

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

			case 'save' :
				 $model->saveData();
				 break;

			case 'loaddataedit' :
				 $model->loadDataedit();
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

		  case 'sortrow' :
				 $model->sortRow();
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

		$pageno = $requestData["page"];
		$rows = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;

		$sql = "select count(*) as rowcount from kp_departments where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  (dep_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  dep_name_en LIKE '%".$requestData['search']."%') ";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['rowcount'];
		$start = $rows * ($pageno -1);

		$sql = "select * from kp_departments where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  (dep_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  dep_name_en LIKE '%".$requestData['search']."%') ";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_assoc()){
			$dep_id = $res['dep_id'];
			$dep_name_th = $res['dep_name_th'];
			$dep_name_en = $res['dep_name_en'];
			$sortnum = $res['sort'];

			$created = date("d/m/Y H:i:s",strtotime($res['create_date']));
			$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('".($res['status']==1?0:1)."','{$dep_id}')\" class=\"btn btn-sm ".($res['status']==1?'btn-success':'btn-secondary')."\"><i class=\"fa fa-check\"></i></button>";

			$btn_sort = "<button type=\"button\" onclick=\"sortRow('{$sortnum}','up','dep_id','{$dep_id}');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-up\"></i></button>";
			$btn_sort.= "<button type=\"button\" onclick=\"sortRow('{$sortnum}','down','dep_id','{$dep_id}');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-down\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('{$dep_id}');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('{$dep_id}','{$dep_name_th}');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['id'] = $dep_id;
			$row['dep_name_th'] = $dep_name_th;
			$row['dep_name_en'] = $dep_name_en;
			$row['created'] = $created;
			$row['btn_act'] = $btnaction;
			$arr[] = $row;
		}
		$output = array();
		$output['records'] = $rowcount;
		$output['page'] = $pageno;
		$output['total'] = ceil($rowcount/$rows);
		$output['rows'] = $arr;

		echo json_encode($output);
	}

	//begin function addData
	public function saveData()
	{
		$formdata['dep_name_th'] = addslashes($_POST['dep_name_th']);
		$formdata['dep_name_en'] = addslashes($_POST['dep_name_en']);

		if($_POST['action']=='add'){
			$formdata['sort'] = $this->sortMax('kp_departments','sort');
			$formdata['status'] = 1;
			$formdata['is_delete'] = 0;

			$update = $this->insertrow("kp_departments",$formdata);
			if($update['status']===TRUE){

				//start function save log transection
				$desclog = "Create Department {$_POST['dep_name_th']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'create department success!';
				$output['id'] = $update['insert_id'];
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'create department fail!'.implode(',',$formdata);
			}
			echo json_encode($output);
		}else{
			$dep_id = $_POST['dep_id'];
			$update = $this->updaterow("kp_departments",$formdata,"where dep_id = '{$dep_id}' ");
			if($update===TRUE){

				//start function save log transection
				$desclog = "Update Department {$_POST['dep_name_th']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'Update department success!';
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'Update department fail!';
			}
			echo json_encode($output);
		}
	}

	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_departments","where dep_id = '{$id}' ");
		$res = $qr->fetch_assoc();

		$output = array();
		$output['dep_id'] = $res['dep_id'];
		$output['dep_name_th'] = $res['dep_name_th'];
		$output['dep_name_en'] = $res['dep_name_en'];

		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_departments","where dep_id = '{$id}' ");
		$res= $qr->fetch_object();
		$dep_name_th = $res->dep_name_th;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_departments",array('is_delete'=>'1'),"where dep_id = '{$id}' ");
		endif;

		if($del){
			$this->sortDatanew();
			//start function save log transection
			$desclog = "ลบ [ฝ่าย/แผนก] ชื่อ {$dep_name_th}";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Delete [{$dep_name_th}] success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete [{$dep_name_th}] error!";
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
				$del = $this->updaterow("kp_departments",array('is_delete'=>'1'),"where dep_id = '{$id}' ");
			}
		}

		if($del){
			$set_id = implode(',',$set_id);
			$this->sortDatanew();
			//start function save log transection
			$desclog = "ลบ [ช้อมูลฝ่าย/แผนกตามที่เลือก] Set $set_id";
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
		$dep_name_th = $this->getTextformid("kp_departments","dep_name_th","dep_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_departments",array('status'=>$status),"where dep_id = '{$id}' ");
		}


		if($updatestatus){
			//start function save log transection
			$desclog = "เปลี่ยน $dep_name_th ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$dep_name_th] success!";
		}else{
			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$dep_name_th] error!";
		}
		echo json_encode($respon);
	}

	public function sortDatanew(){
		$qr = $this->fetchdata("kp_departments","where is_delete=0 order by sort asc");
		while($res = $qr->fetch_object()){
			$id = $res->dep_id;
			$arrid[] = $id;
		}

		$i = 0;
		foreach ($arrid as $value) {
			$dep_id = $value;
			$data = array('sort'=>$i);
			$this->updaterow("kp_departments",$data,"where dep_id = '".$dep_id."' ");
			//echo "<br/>$i<br/>";
			$i++;

		}
	}

	//begin function sort row
	public function sortRow(){
		$sorttype = $_REQUEST['type'];
		$fid = $_REQUEST['fid'];
		$mainid = $_REQUEST['mainid'];
		$output = array();
		if($_REQUEST['line']==0 and $sorttype=="up"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับบนสุดแล้ว!";
		}elseif($_REQUEST['line']==($this->countdatasort("sort","kp_departments")-1) and $sorttype=="down"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output['status'] = "success";
			if($sorttype=="up"){
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_departments","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_departments","where sort = '$sort_post' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_post
				);

				$this->updaterow("kp_departments",$sortdata,"where dep_id = '".$resu->dep_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_departments",$sortdata2,"where dep_id = '".$resu2->dep_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_departments","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_departments","where sort = '$sort_plus' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_plus
				);

				$this->updaterow("kp_departments",$sortdata,"where dep_id = '".$resu->dep_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_departments",$sortdata2,"where dep_id = '".$resu2->dep_id."' ");
			}
		}

		echo json_encode($output);
	}


	public function sortMax($tb,$fill){
		include "common/include/config.php";

		$sql = "select MAX($fill) as maxsort from $tb";
		$q = $dbCon->query($sql) or die($dbCon->error);
		$res = $q->fetch_object();

		return $res->maxsort+1;
	}

	public function countdatasort($fill,$tb){
		include "common/include/config.php";
		$qr = $dbCon->query("select MAX($fill)+1 as maxnumber from $tb") or die($dbCon->error);
		$res = $qr->fetch_object();
		$maxsort_number = $res->maxnumber;

		return $maxsort_number;
	}

	//end function sort


}
