<?php
$param = "teams";
require "models/$param.php";
class teamsController extends Controllers
{
	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการระบบทีมงาน";
		$pagename = "จัดการระบบทีมงาน";
		$param = "teams";
		$classpage = 1;
		$model = new teamsController;

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

			case 'loaddep' :
				 $model->loadDepartment();
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

			case 'save' :
				 $model->saveData();
				 break;

			case 'loaddataedit' :
				 $model->loadDataedit();
				 break;

			case 'del' :
				 $model->delData();
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
		$urlweb = curPageURLWeb();
		include "common/include/config.php";
		$requestData= $_REQUEST;

		$pageno = $requestData["page"];
		$rows = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;

		$sql = "select count(*) as countrow from kp_teams tm
		inner join kp_departments dep on dep.dep_id = tm.dep_id where tm.is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( tm.m_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR tm.m_name_en LIKE '%".$requestData['search']."%' ";
			$sql.= "OR tm.m_tel LIKE '%".$requestData['search']."%' ";
			$sql.= "OR tm.m_email LIKE '%".$requestData['search']."%' ";
			$sql.= "OR dep.dep_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR dep.dep_name_en LIKE '%".$requestData['search']."%' ";
			$sql.= "OR tm.m_position LIKE '%".$requestData['search']."%' )";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['rowcount'];
		$start = $rows * ($pageno -1);

		$sql = "select tm.*,dep.dep_name_th from kp_teams tm
		inner join kp_departments dep on dep.dep_id = tm.dep_id where tm.is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( tm.m_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR tm.m_name_en LIKE '%".$requestData['search']."%' ";
			$sql.= "OR tm.m_tel LIKE '%".$requestData['search']."%' ";
			$sql.= "OR tm.m_email LIKE '%".$requestData['search']."%' ";
			$sql.= "OR dep.dep_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR dep.dep_name_en LIKE '%".$requestData['search']."%' ";
			$sql.= "OR tm.m_position LIKE '%".$requestData['search']."%' )";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$m_id = $res->m_id;
			$m_name_th = $res->m_name_th;
			$m_name_en = $res->m_name_en;
			$m_desc_th = $res->m_desc_th;
			$m_desc_en = $res->m_desc_en;
			$m_tel = $res->m_tel;
			$m_email = $res->m_email;
			$m_line = $res->m_line;
			$dep_id = $res->dep_id;
			$dep_name = $res->dep_name_th;
			$m_position = $res->m_position;
			$sortnum = $res->sort;

			if(!empty($res->m_img)){
				if(file_exists("../images/teams/tmp/{$res->m_img}")==true){
					$img = "{$urlweb}/images/teams/tmp/{$res->m_img}";
					$img = "<img src='{$img}' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}else{
					$img = "{$urlweb}/images/no-img.jpg";
					$img = "<img src='{$img}' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}
			}else{
				$img = "{$urlweb}/images/no-img.jpg";
				$img = "<img src='{$img}' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
			}


			$created = date("d/m/Y H:i:s",strtotime($res->create_date));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);

			$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('".($res->status==1?0:1)."','{$m_id}')\" class=\"btn btn-sm ".($res->status==1?'btn-success':'btn-secondary')."\"><i class=\"fa fa-check\"></i></button>";

			$btn_sort = "<button type=\"button\" onclick=\"sortRow('{$sortnum}','up','m_id','{$m_id}');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-up\"></i></button>";
			$btn_sort.= "<button type=\"button\" onclick=\"sortRow('{$sortnum}','down','m_id','{$m_id}');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-down\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('{$m_id}');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('{$m_id}','{$m_name_th}');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_show.$btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['m_id'] = $m_id;
			$row['m_name_th'] = $m_name_th;
			$row['m_tel'] = $m_tel;
			$row['m_email'] = $m_email;
			$row['m_line'] = $m_line;
			$row['m_position'] = $m_position;
			$row['dep_id'] = $dep_name;
			$row['m_img'] = $img;
			$row['created'] = $created;
			$row['creator'] = $creator;
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


	//begin function department
	public function loadDepartment(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_departments","where is_delete=0 order by dep_name_th asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->dep_id;
			$arr['name']= $res->dep_name_th;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}

	//begin function addData
	public function saveData()
	{
		$formdata['m_name_th'] = addslashes($_POST['m_name_th']);
		$formdata['m_name_en'] = addslashes($_POST['m_name_en']);
		$formdata['m_tel'] = addslashes($_POST['m_tel']);
		$formdata['m_email'] = addslashes($_POST['m_email']);
		$formdata['m_line'] = addslashes($_POST['m_line']);
		$formdata['m_position'] = addslashes($_POST['m_position']);
		$formdata['dep_id'] = $_POST['dep_id'];

		if($_POST['action']=='add'){
			$m_id = $this->NewID('C','m_id','kp_teams');
			$formdata['m_id'] = $m_id;
			$formdata['sort'] = $this->sortMax('kp_teams','sort');
			$formdata['user_create'] = getSession();
			$formdata['status'] = 1;
			$formdata['is_delete'] = 0;

			$update = $this->insertrow("kp_teams",$formdata);
			if($update['status']===TRUE){

				//start function save log transection
				$desclog = "Create Staff {$_POST['m_name_th']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'create Staff success!';
				$output['id'] = $m_id;
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'create Staff fail!';
			}
			echo json_encode($output);
		}else{
			$m_id = $_POST['m_id'];
			$update = $this->updaterow("kp_teams",$formdata,"where m_id = '{$m_id}' ");
			if($update===TRUE){

				//start function save log transection
				$desclog = "Update Staff {$_POST['m_name_th']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'Update Staff success!';
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'Update Staff fail!';
			}
			echo json_encode($output);
		}
	}

	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_teams","where m_id = '{$id}'");
		$res = $qr->fetch_object();

		$output = array();
		$output['m_id'] = $res->m_id;
		$output['m_name_th'] = $res->m_name_th;
		$output['m_name_en'] = $res->m_name_en;
		$output['m_desc_th'] = $res->m_desc_th;
		$output['m_desc_en'] = $res->m_desc_en;
		$output['m_tel'] = $res->m_tel;
		$output['m_email'] = $res->m_email;
		$output['m_line'] = $res->m_line;
		$output['m_position'] = $res->m_position;
		$output['dep_id'] = $res->dep_id;


		$arrdatatype = array();
		$qrtype = $this->fetchdata("kp_departments","where is_delete=0 order by dep_name_th asc ");
		while($restype = $qrtype->fetch_object()){

			$arrdatatype['id'] = $restype->dep_id;
			$arrdatatype['name']= $restype->dep_name_th;

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
		$qr = $this->fetchdata("kp_teams","where m_id = '{$id}' ");
		$res= $qr->fetch_object();
		$m_name_th = $res->m_name_th;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_teams",array('is_delete'=>'1'),"where m_id = '{$id}' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [ทีมงาน] ชื่อ $m_name_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Delete [$m_name_th] success!";

		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete [$m_name_th] error!";
		}

		echo json_encode($respon);
	}
	//end function delData


	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$m_name = $this->getTextformid("kp_teams","m_name_th","m_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_teams",array('status'=>$status),"where m_id = '{$id}' ");
		}


		if($updatestatus){
			//start function save log transection
			$desclog = "เปลี่ยน $m_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Change status [$m_name] success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Change status [$m_name] error!";
		}


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
		}elseif($_REQUEST['line']==($this->countdatasort("sort","kp_teams")-1) and $sorttype=="down"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output['status'] = "success";
			if($sorttype=="up"){
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_teams","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_teams","where sort = '$sort_post' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_post
				);

				$this->updaterow("kp_teams",$sortdata,"where m_id = '".$resu->m_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_teams",$sortdata2,"where m_id = '".$resu2->m_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_teams","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_teams","where sort = '$sort_plus' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_plus
				);

				$this->updaterow("kp_teams",$sortdata,"where m_id = '".$resu->m_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_teams",$sortdata2,"where m_id = '".$resu2->m_id."' ");
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

	//begin function updateimg

	public function readDataimg(){
		$url = curPageURL();
		$url2 = curPageURLweb();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_teams","where m_id = '$id' ");
		$res = $qr->fetch_object();

		if($res->m_img!=''){
			$img = "{$url2}/images/teams/tmp/{$res->m_img}";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('m_img','{$id}')\" class=\"btn btn-danger btn-oblong
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
		if(empty($_REQUEST['m_id'])){
			$id = $this->NewID('C','m_id','kp_teams');
		}else{
			$id = $_REQUEST['m_id'];
		}

		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'teams-'.$id.'-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"../images/teams/tmp/");
			copy($file_tmp,"../images/teams/$pic_name");

			if(empty($_REQUEST['m_id'])==true){
				$sort = $this->sortMax('kp_teams','sort');
				$usercreate = getSession();
				$form_data = array(
					'm_id'=>$id,
					'm_img'=>$pic_name,
					'is_delete'=>0,
					'status'=>1,
					'sort'=>$sort,
					'user_create'=>$usercreate
				);
				$updateimg = $this->insertrow('kp_teams',$form_data);
			}else{
				$form_data = array(
					'm_img'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_teams', $form_data, "WHERE m_id = '$id'");
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

		$qr = $this->fetchdata("kp_teams","where m_id = '$id' ");
		$res = $qr->fetch_object();

		$updateimg = $this->updaterow('kp_teams', array('m_img'=>''), "WHERE m_id = '".$id."' ");

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
			$output['id'] =$id;

			if(file_exists("../images/teams/$res->m_img")==true){
				unlink("../images/teams/$res->m_img");
				unlink("../images/teams/tmp/$res->m_img");
			}
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
		}

		echo json_encode($output);
	}


}
