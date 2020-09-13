<?php
$param = "users";
require "models/$param.php";

class userController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "จัดการข้อมูลผู้ใช้งาน";
		$param = "users";
		$classpage = "collapsed-menu with-subleft";
		$model = new userController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->loadData();
				 break;

			case 'loaduserlevel' :
				 $model->loadUserlevel();
				 break;

			case 'readdata' :
				 $model->readData();
				 break;

		  case 'readdataimg' :
				 $model->readDataimg();
				 break;

			case 'add' :
				 $model->addData();
				 break;

			case 'update' :
				 $model->updateData();
				 break;

			case 'del' :
				 $model->delData();
				 break;

		  case 'loaddatalevel' :
				 $model->loadDatalavel();
				 break;

			case 'readdatalevel' :
 				 $model->readDatalevel();
 				 break;

 			case 'addlevel' :
 				 $model->addDatalevel();
 				 break;

 			case 'updatelevel' :
 				 $model->updateDatalevel();
 				 break;

 			case 'dellevel' :
 				 $model->delDatalevel();
 				 break;

		  case 'uploadimg' :
 			   $model->uploadImg();
 			   break;

			case 'delimg' :
				 $model->delImg();
				 break;

			case 'isstatus' :
			   $model->changeIsstatus();
				 break;

			case 'isstatususer' :
			   $model->changeIsstatusUser();
				 break;

			case 'loadpermissionlevel' :
			   $model->loadPermissionlevel();
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

	public function loadData()
	{
		$url = curPageURL();
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

		$sql = "select count(*) as countrow from kp_users where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( user_fullname LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(user_name) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR user_lastname LIKE '%".$requestData['search']."%' ";
			$sql.= "OR user_email LIKE '%".$requestData['search']."%' ) ";
		}
		$res = $dbCon->query($sql)->fetch_assoc();
		$count = $res['countrow'];

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

		$sql = "select * from kp_users where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( user_fullname LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(user_name) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR user_lastname LIKE '%".$requestData['search']."%' ";
			$sql.= "OR user_email LIKE '%".$requestData['search']."%' ) ";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$user_id = $res->user_id;
			$user_fullname = $res->user_fullname;
			$user_name = $res->user_name;
			$level_name = $this->getTextformid('kp_user_level','level_name','level_id',$res->user_level);
			$last_login = date("d M Y H:i:s",$res->user_last_login);

			if($res->user_avatar!=''){
				if(file_exists("images/user/tmp/$res->user_avatar")===TRUE){
					$img = "<img src='../images/user/tmp/$res->user_avatar' width='32' class='wd-32 ht-32 rounded-circle' />";
				}else{
					$img = "<img src='../images/user/unknown.jpg' width='32' class='wd-32 ht-32 rounded-circle' />";
				}

			}else{
				$img = "<img src='../images/user/unknown.jpg width='32' class='wd-32 ht-32 rounded-circle' />";
			}

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatusUser('0','$user_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatusUser('1','$user_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editRow('$user_id');\" class=\"btn btn-sm btn-warning\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"removeRow('$user_id','$user_name');\" class=\"btn btn-sm btn-danger\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.' '.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$rownum++;

			$row = array();
			$row['id'] = $user_id;
			$row['row'] = $rownum;
			$row['user_img'] = $img;
			$row['user_fullname'] = $user_fullname;
			$row['user_name'] = $user_name;
			$row['user_level'] = $level_name;
			$row['user_last_login'] = $last_login;
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


	public function readDataimg(){
		$url = curPageURL();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_users","where user_id = '$id' ");
		$res = $qr->fetch_object();

		if($res->user_avatar!=''){
			$img = "$url/images/user/tmp/$res->user_avatar";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('user_avatar','$id')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-20 pd-y-10 tx-uppercase tx-bold tx-spacing-6 tx-16\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img = "";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-20 pd-y-10 tx-uppercase tx-bold tx-spacing-6 tx-16\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}

		echo json_encode(array('btnupload'=>$btn,'img'=>$img));
	}

	public function readData()
	{
		$url = curPageURL();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_users","where user_id = '$id' ");
		$res = $qr->fetch_object();

		if($res->user_avatar!=''){
			$img = "$url/images/user/tmp/$res->user_avatar";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('user_avatar','$id')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-20 pd-y-10 tx-uppercase tx-bold tx-spacing-6 tx-16\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img = "";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-20 pd-y-10 tx-uppercase tx-bold tx-spacing-6 tx-16\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}


		$rows = array(
			'id'=>$res->user_id,
			'fullname'=>$res->user_fullname,
			'lastname'=>$res->user_lastname,
			'username'=>$res->user_name,
			'email'=>$res->user_email,
			'tel'=>$res->user_tel,
			'img'=>$img,
			'btnupload'=>$btn,
			'level'=>$res->user_level,
			'status'=>$res->status

		);

		echo json_encode($rows);
	}

	//begin function addData
	public function addData()
	{
		$id = $this->NewID('U','user_id','kp_users');
		$fullname = $_REQUEST['txtname'];
		$lastname = $_REQUEST['txtlastname'];
		$username = $_REQUEST['txtusername'];
		$userpass = $_REQUEST['txtpassword'];
		$email = $_REQUEST['txtemail'];
		$tel = $_REQUEST['txttel'];
		$level = $_REQUEST['txtlevel'];
		$status = $_REQUEST['txtstatus'];

		if(isset($_REQUEST['txtname'])):

			$form_data = array(
				'user_id'=>$id,
				'user_fullname'=>$fullname,
				'user_lastname'=>$lastname,
				'user_name'=>$username,
				'user_password'=>md5($userpass),
				'user_email'=>$email,
				'user_tel'=>$tel,
				'user_level'=>$level,
				'create_date'=>strtotime(date("Y-m-d H:i:s")),
				'is_delete'=>0,
				'status'=>$status
			);

			$insert = $this->insertrow('kp_users',$form_data);

		endif;

		if($insert){
			//start function save log transection
			$desclog = "ได้เพิ่มผู้ใช้งานใหม่  ชื่อ $fullname";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Add $fullname success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Add $fullname error!";
		}
		echo json_encode($respon);
	}

	//end function addData

	//begin function addData
	public function updateData()
	{
		$id = $_REQUEST['iduser'];
		$fullname = $_REQUEST['txtname'];
		$lastname = $_REQUEST['txtlastname'];
		$username = $_REQUEST['txtusername'];
		$userpass = $_REQUEST['txtpassword'];
		$email = $_REQUEST['txtemail'];
		$tel = $_REQUEST['txttel'];
		$level = $_REQUEST['txtlevel'];
		$status = $_REQUEST['txtstatus'];


		if($_REQUEST['txtpassword']!=''){
			$form_pass = array(
				'user_password'=>md5($userpass)
			);
			$this->updaterow('kp_users', $form_pass, "WHERE user_id = '$id'");
		}


		if(isset($_REQUEST['txtname'])):

			$form_data = array(
				'user_fullname'=>$fullname,
				'user_lastname'=>$lastname,
				'user_name'=>$username,
				'user_email'=>$email,
				'user_tel'=>$tel,
				'user_level'=>$level,
				'status'=>$status
			);

			$update = $this->updaterow('kp_users', $form_data, "WHERE user_id = '$id'");

		endif;


		if($update){
			//start function save log transection
			$desclog = "ได้แก้ไขผู้ใช้งานระบบ  ชื่อ $fullname";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Update $fullname success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Update $fullname error!";
		}

		echo json_encode($respon);
	}

	//end function addData

	//begin function addData
	public function delData()
	{
		$id = $_REQUEST['id'];

		if(isset($id)):
			$user_fullname = $this->getTextformid("kp_users","user_fullname","user_id",$id);

			$del = $this->updaterow("kp_users",array('is_delete'=>1),"where user_id = '$id' ");
		endif;

		if($del){
			//start function save log transection
			$desclog = "ได้ลบผู้ใช้งานระบบ  ชื่อ $user_fullname";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Delete $fullname success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete $fullname error!";
		}

		echo json_encode($respon);
	}

	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	public function loadUserlevel()
	{
		$url = curPageURL();
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

		$sql = "select * from kp_user_level where is_delete = 0 ";
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

		$sql = "select * from kp_user_level where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND level_name LIKE '%".$requestData['search']."%' ";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$level_id = $res->level_id;
			$level_name = $res->level_name;


			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$level_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$level_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btnsetpermission = "<button type=\"button\" onclick=\"window.location.href='$url/setting/permission/$level_id'\" class=\"btn btn-primary btn-sm\"><i class=\"icon ion-key\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editRowlevel('$level_id');\" class=\"btn btn-sm btn-warning\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"removeRowlevel('$level_id','$level_name');\" class=\"btn btn-sm btn-danger\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.' '.$btnsetpermission.' '.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$rownum++;

			$row = array();
			$row['id'] = $level_id;
			$row['row'] = $rownum;
			$row['level_name'] = $level_name;
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

	public function readDatalevel()
	{
		$url = curPageURL();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_user_level","where level_id = '$id' ");
		$res = $qr->fetch_object();

		$rows = array(
			'id'=>$res->level_id,
			'levelname'=>$res->level_name,
			'status'=>$res->status

		);

		echo json_encode($rows);
	}

	public function addDatalevel(){
		$levelname = $_POST['txtlevelname'];
		$levelstatus = $_POST['txtstatus'];

		$form_data = array(
			'level_name'=>$levelname,
			'is_delete'=>0,
			'status'=>$levelstatus
		);

		$insert = $this->insertrow("kp_user_level",$form_data);
		if($insert){
			$respon['status'] = "success";
			$respon['msg'] = "Add $levelname success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Add $levelname error!";
		}

		echo json_encode($respon);
	}

	public function updateDatalevel(){
		$id = $_POST['levelid'];
		$levelname = $_POST['txtlevelname'];
		$levelstatus = $_POST['txtstatus'];

		if(isset($id)):
		$form_data = array(
			'level_name'=>$levelname,
			'status'=>$levelstatus
		);

		$update = $this->updaterow("kp_user_level",$form_data,"where level_id = '$id'");
		endif;
		if($update){
			$respon['status'] = "success";
			$respon['msg'] = "Update $levelname success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Update $levelname error!";
		}

		echo json_encode($respon);
	}

	public function delDatalevel()
	{
		$id = $_REQUEST['id'];
		if(isset($id)):
			$level_name = $this->getTextformid('kp_user_level','level_name','level_id',$id);
			$del = $this->updaterow("kp_user_level",array('is_delete'=>1),"where level_id = '$id' ");
		endif;

		$output = array();
		if($del===TRUE){
			$output['status'] = "success";
			$output['msg'] = "ลบ ระดับสิทธิ์ $level_name สำเร็จ!";
			$output['textrespon'] = "Delete Success!";
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบ ระดับสิทธิ์ $level_name ไม่สำเร็จ!";
			$output['textrespon'] = "Delete Error!";
		}

		echo json_encode($output);
	}
	//end function addData

	//begin function updateimg
	public function uploadImg()
	{
		if(empty($_REQUEST['uid'])==true){
			$id = $this->NewID('U','user_id','kp_users');
		}else{
			$id = $_REQUEST['uid'];
		}
		$img = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = $id.'-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"images/user/tmp/");
			copy($file_tmp,"images/user/$pic_name");


			if(empty($_REQUEST['uid'])==true){
				$form_data = array(
					'user_id'=>$id,
					'user_avatar'=>$pic_name,
					'is_delete'=>0
				);
				$updateimg = $this->insertrow('kp_users',$form_data);
			}else{
				$form_data = array(
					'user_avatar'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_users', $form_data, "WHERE user_id = '$id'");
			}

		}

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "อัพโหลดสำเร็จ!";
			$output['id'] =$id;
		}else{
			$output['status'] = "error";
			$output['msg'] = "อัพโหลดไม่สำเร็จ!";
		}

		echo json_encode($output);
	}


	public function delImg(){
		$f = $_REQUEST['f'];
		$id = $_REQUEST['id'];

		$qr = $this->fetchdata("kp_users","where user_id = '$id' ");
		$res = $qr->fetch_object();

		$updateimg = $this->updaterow('kp_users', array('user_avatar'=>''), "WHERE user_id = '".$id."' ");

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
			$output['id'] =$id;

			if(file_exists("images/users/$res->user_avatar")==true){
				unlink("images/users/$res->user_avatar");
				unlink("images/users/tmp/$res->user_avatar");
			}
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
		}


		echo json_encode($output);
	}


	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$level_name = $this->getTextformid("kp_user_level","level_name","level_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_user_level",array('status'=>$status),"where level_id = '$id' ");
		}


		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $level_name ให้เปิดใช้งาน สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $level_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $level_name ให้เปิดใช้งาน ได้ กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
	}


	public function changeIsstatusUser(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$user_name = $this->getTextformid("kp_users","user_fullname","user_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_users",array('status'=>$status),"where user_id = '$id' ");
		}


		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $user_name ให้เปิดใช้งาน สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $user_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $user_name ให้เปิดใช้งาน ได้ กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
	}

	public function loadPermissionlevel(){
		$arr = array();
		$qr = $this->fetchdata("kp_user_level","where is_delete=0 order by level_id asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->level_id;
			$arr['name']= $res->level_name;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}

}
