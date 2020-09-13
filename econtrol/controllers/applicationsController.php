<?php
$param = "applications";
require "models/$param.php";

class applicationsController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "ฐานข้อมูลระบบ";
		$pagename = "จัดการ Application";
		$param = "applications";
		$classpage = "";
		$model = new applicationsController;

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

			case 'loadappmain' :
				 $model->loadAppmain();
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

			case 'deleteselect' :
				 $model->delDataselect();
				 break;

		  case 'isstatus' :
		  	 $model->changeIsstatus();
		  	 break;

		  case 'mergedataApplication' :
				 $model->mergeDatasource();
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
			'add'=>' <button type="button" id="addform" class="btn btn-primary"> เพิ่ม </button>',
			// 'edit'=>' <button type="button" id="mergeData" class="btn btn-info" disabled="true"> ร่วมข้อมูลที่ซ้ำกัน </button>',
			'del'=>' <button type="button" id="delselect" class="btn btn-danger" disabled="true"> ลบที่เลือก </button>'
		);
		// permission mwnu

		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>",
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",

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
		include "common/include/config.php";
		$requestData= $_REQUEST;

		$pageno = $requestData["page"];
		$rows = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;

		$sql = "select count(*) as rowcount from kp_applications where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  (app_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  app_name_en LIKE '%".$requestData['search']."%') ";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['rowcount'];
		$start = $rows * ($pageno -1);

		$sql = "select * from kp_applications where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  (app_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  app_name_en LIKE '%".$requestData['search']."%') ";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_assoc()){
			$app_id = $res['app_id'];
			$app_name_th = $res['app_name_th'];
			$app_name_en = $res['app_name_en'];
			if($app_id!=$res['app_main_id']){
				$app_name = '<span style="color:#666;font-style: italic;">-'.$app_name_th.'</span>';
			}else{
				$app_name = '<span style="font-weight: bold;">'.$app_name_th.'</span>';
			}

			if($app_id!=$res['app_main_id']){
				$app_main = $this->getTextformid('kp_applications','app_name_th','app_main_id',$res['app_main_id']);
			}else{
				$app_main = '';
			}

			$created = date("d/m/Y H:i:s",strtotime($res['create_date']));
			$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('".($res['status']==1?0:1)."','{$app_id}')\" class=\"btn btn-sm ".($res['status']==1?'btn-success':'btn-secondary')."\"><i class=\"fa fa-check\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('{$app_id}');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('{$app_id}','{$app_name_th}');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['app_id'] = $app_id;
			$row['app_name_th'] = $app_name;
			$row['app_main_id'] = $app_main;
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


	// brgin function loadrentertype
	public function loadAppmain(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_applications","where is_delete=0 and app_id=app_main_id order by app_id asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->app_id;
			$arr['name']= $res->app_name_th;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}


	// end function loadrentertype

	//begin function addData
	public function saveData()
	{
		$formdata['app_name_th'] = addslashes($_POST['app_name_th']);
		$formdata['app_name_en'] = addslashes($_POST['app_name_en']);
		$formdata['app_main_id'] = $_POST['app_main_id'];

		if($_POST['action']=='add'){
			$formdata['status'] = 1;
			$formdata['is_delete'] = 0;
			$formdata['user_create'] = getSession();

			$update = $this->insertrow("kp_applications",$formdata);
			if($update['status']===TRUE){

				if(empty($_POST['app_main_id'])){
					$this->updaterow("kp_applications",array('app_main_id'=>$update['insert_id']),"app_id = '{$update['insert_id']}' ");
				}

				//start function save log transection
				$desclog = "Create Application {$_POST['app_name_th']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'create Application success!';
				$output['id'] = $update['insert_id'];
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'create Application fail!';
				$output['err'] = $update['status'];
			}
			echo json_encode($output);
		}else{
			$app_id = $_POST['app_id'];
			$update = $this->updaterow("kp_applications",$formdata,"where app_id = '{$app_id}' ");
			if($update===TRUE){

				if(empty($_POST['app_main_id'])){
					$this->updaterow("kp_applications",array('app_main_id'=>$app_id),"app_id = '{$app_id}' ");
				}

				//start function save log transection
				$desclog = "Update Application {$_POST['app_name_th']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'Update Application success!';
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'Update Application fail!';
			}
			echo json_encode($output);
		}
	}

	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_applications","where app_id = '{$id}'");
		$res = $qr->fetch_object();

		$output = array();
		$output['app_id'] = $res->app_id;
		$output['app_name_th'] = $res->app_name_th;
		$output['app_name_en'] = $res->app_name_en;
		$output['app_main_id'] = $res->app_main_id;

		$arrdatatype = array();
		$qrtype = $this->fetchdata("kp_applications","where is_delete=0 order by app_id asc ");
		while($restype = $qrtype->fetch_object()){

			$arrdatatype['id'] = $restype->app_id;
			$arrdatatype['name']= $restype->app_name_th;

			$respon['datarow'][] = $arrdatatype;
		}

		$output['datatype'] = $respon;

		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_applications","where app_id = '$id' ");
		$res= $qr->fetch_object();
		$app_name_th = $res->app_name_th;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_applications",array('is_delete'=>'1'),"where app_id = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [ Application ] ชื่อ $app_name_th";
			savelog(getSession(),$desclog);
			//end function save log transection


			$jsonstatus = "success";
			$jsonrespontext = "Delete [$app_name_th] success!";
			$jsonmsg = "ลบ ข้อมูล Application  [$app_name_th] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Delete [$app_name_th] error!";
			$jsonmsg = "ไม่สามารถ ลบ ข้อมูล Application  [$app_name_th] สำเร็จ  กรุณาติดต่อ Support";
		}

		$respon = array('status'=>$jsonstatus,'respontext'=>$jsonrespontext,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}
	//end function delData

	public function delDataselect(){
		$set_id = $_REQUEST['setid'];

		foreach ($set_id as $key => $value) {
			$id = $value;
			if(isset($id)){
				$del = $this->updaterow("kp_applications",array('is_delete'=>'1'),"where app_id = '$id' ");
			}
		}

		if($del){
			$set_id = implode(',',$set_id);

			$jsonstatus = "success";
			$jsonmsg = "Delete Application Set ID [$set_id] สำเร็จ!";

			//start function save log transection
			$desclog = "Delete Application Set ID  [$set_id]";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถลบ Set [$set_id] กรุณาติดต่อ Support";
		}


		$output = array();
		$output[status] = $jsonstatus;
		$output[msg] = $jsonmsg;

		echo json_encode($output);
	}


	public function mergeDatasource(){
		$set_id = $_REQUEST['setid'];

		// foreach ($set_id as $key => $value) {
		// 	$id = $value;
		// 	if(isset($id)){
		// 		$del = $this->updaterow("kp_applications",array('is_delete'=>'1'),"where app_id = '$id' ");
		// 	}
		// }
		$id_1 = $set_id[1];
		$qr = $this->fetchdata("kp_visit_transections","where app_id = '$id_1' and is_delete=0 order by trn_id asc ");
		while($res = $qr->fetch_object()){
			$trn_id = $res->trn_id;
			$update_app_id = $set_id[0];
			$update = $this->updaterow("kp_visit_transections",array("app_id"=>"$update_app_id"),"where trn_id = '$trn_id' ");
		}


		$del = $this->updaterow("kp_applications",array('is_delete'=>'1'),"where app_id = '$id_1' ");
		if($del){
			$set_id_im = implode(',',$set_id);

			$jsonstatus = "success";
			$jsonmsg = "Merge Data of Application ID $set_id[1] to $set_id[0] สำเร็จ!";

			//start function save log transection
			$desclog = "Merge Data of Application ID $set_id[1] to $set_id[0] ";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{

			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถรวมข้อมูล ID $set_id[1] ไปยัง $set_id[0] ได้กรุณาติดต่อ Support";
		}


		$output = array();
		$output['status'] = $jsonstatus;
		$output['msg'] = $jsonmsg;

		echo json_encode($output);
	}


	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$app_name_th = $this->getTextformid("kp_applications","app_name_th","app_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_applications",array('status'=>$status),"where app_id = '$id' ");
		}


		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $app_name_th ให้แสดงในรายงาน สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $app_name_th ให้แสดงในรายงาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $app_name_th ให้แสดงในรายงาน ได้ กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
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
		}elseif($_REQUEST['line']==($this->countdatasort("sort","kp_applications")-1) and $sorttype=="down"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output['status'] = "success";
			if($sorttype=="up"){
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_applications","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_applications","where sort = '$sort_post' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_post
				);

				$this->updaterow("kp_applications",$sortdata,"where app_id = '".$resu->app_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_applications",$sortdata2,"where app_id = '".$resu2->app_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_applications","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_applications","where sort = '$sort_plus' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_plus
				);

				$this->updaterow("kp_applications",$sortdata,"where app_id = '".$resu->app_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_applications",$sortdata2,"where app_id = '".$resu2->app_id."' ");
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
