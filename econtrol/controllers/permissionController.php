<?php
$param = "permission";
require "models/$param.php";

class permissionController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1,$get_part2){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "ตั้งค่าระดับสิทธิ์";
		$param = "permission";
		$classpage = "collapsed-menu with-subleft";
		$model = new permissionController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'readdata' :
				 $model->readData();
				 break;

			case 'updatepermission' :
				 $model->updateData();
				 break;

		  case 'loaddatalevel' :
				 $model->loadUserlevel();
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



	public function readData()
	{
		$url = curPageURL();
		$levelid = $_REQUEST['id'];
		$arr = array();
		$qr = $this->fetchdata("kp_menu","where menu_name!='' order by menu_id,menu_main_id asc ");
		while($res = $qr->fetch_object()){
			$i++;

			if($res->menu_main_id!=''){
				$menuname = "-- <i style='color:#999;'>".$res->menu_name."</i>";
			}else{
				$menuname = "<font color='#000'><b>".$res->menu_name."</b></font>";
			}

			$mappermission = $this->fetchdata("kp_user_permission","where level_id = '$levelid' and menu_id = '$res->menu_id' ");
			$resmap = $mappermission->fetch_object();

			if($resmap->permis_show==1){
				$checkpermis_show = "checked";
			}else{
				$checkpermis_show = "";
			}
			if($resmap->permis_add==1){
				$checkpermis_add = "checked";
			}else{
				$checkpermis_add = "";
			}
			if($resmap->permis_edit==1){
				$checkpermis_edit = "checked";
			}else{
				$checkpermis_edit = "";
			}
			if($resmap->permis_del==1){
				$checkpermis_del = "checked";
			}else{
				$checkpermis_del = "";
			}
			if($resmap->permis_cf==1){
				$checkpermis_confirm = "checked";
			}else{
				$checkpermis_confirm = "";
			}

			if($res->menu_name!='' or $res->menu_name!=null):
			$dataarr = "<tr>
				<td align=\"center\">$i</td>
				<td style=\"color:#000;\">$menuname <input type=\"hidden\" name=\"menuid[]\" value=\"$res->menu_id\"/></td>
				<td align=\"center\" for=\"$i\"><label class=\"ckbox\"><input type=\"checkbox\" id=\"$i\" name=\"per_show_$res->menu_id\" value=\"1\" $checkpermis_show/><span></span></label></td>
				<td align=\"center\" for=\"$i\"><label class=\"ckbox\"><input type=\"checkbox\" id=\"$i\" name=\"per_add_$res->menu_id\" value=\"1\" $checkpermis_add/><span></span></label></td>
				<td align=\"center\" for=\"$i\"><label class=\"ckbox\"><input type=\"checkbox\" id=\"$i\" name=\"per_edit_$res->menu_id\" value=\"1\" $checkpermis_edit/><span></span></label></td>
				<td align=\"center\" for=\"$i\"><label class=\"ckbox\"><input type=\"checkbox\" id=\"$i\" name=\"per_del_$res->menu_id\" value=\"1\" $checkpermis_del/><span></span></label></td>
				<td align=\"center\" for=\"$i\"><label class=\"ckbox\"><input type=\"checkbox\" id=\"$i\" name=\"per_conf_$res->menu_id\" value=\"1\" $checkpermis_confirm/><span></span></label></td>
			</tr>";
			array_push($arr,$dataarr);
			endif;
		}

		$qrlevel = $this->fetchdata("kp_user_level","where level_id = '$levelid'");
		$reslevel = $qrlevel->fetch_object();

		$title = "<div style=\"font-size:20px;color:#000;\">ตั้งค่าระดับสิทธิ์การเข้าถึงของ : $reslevel->level_name</div>";
		$data = "<table class=\"table table-bordered table-responsive nowrap\">";
		$data.= "<tr bgcolor=\"#eee\">
			<td width=\"15\" align=\"center\">ลำดับ</td>
			<td align=\"center\">ชื่อเมนู</td>
			<td width=\"25\" align=\"center\">แสดง</td>
			<td width=\"25\" align=\"center\">เพิ่ม</td>
			<td width=\"25\" align=\"center\">แก้ไข</td>
			<td width=\"25\" align=\"center\">ลบ</td>
			<td width=\"25\" align=\"center\">ยืนยัน</td>
		</tr>";
		$data.= implode('',$arr);
		$data.= "</table>";
		echo json_encode(array('textpermission'=>$data,'texttitle'=>$title));
	}


	//begin function addData
	public function updateData()
	{
		$id = $_REQUEST['levelid'];

		if(isset($id)):

			$cleardata = $this->delrow("kp_user_permission","where level_id = '$id' ");
			if($cleardata){

			for($i=0;$i<count($_POST['menuid']);$i++){

				$menuid = $_POST['menuid'][$i];
				$show = $_POST['per_show_'.$menuid];
				$add = $_POST['per_add_'.$menuid];
				$edit = $_POST['per_edit_'.$menuid];
				$delete = $_POST['per_del_'.$menuid];
				$confirm = $_POST['per_conf_'.$menuid];

				if($menuid!=''){
					$form_data = array(
						'level_id'=>$id,
						'menu_id'=>$menuid,
						'permis_show'=>$show,
						'permis_add'=>$add,
						'permis_edit'=>$edit,
						'permis_del'=>$delete,
						'permis_cf'=>$confirm,
					);

					$update = $this->insertrow('kp_user_permission', $form_data);
				}

			}

			}

		endif;


		if($update){
			$jsonstatus = "success";
			$jsonmsg = "อัพเดทระดับสิทธิ์ เรียบร้อย!";
			$jsonrespontext = "Update Success!";
		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถ อัพเดทระดับสิทธิ์ ได้  กรุณาติดต่อ Support";
			$jsonrespontext = "อัพเดทระดับสิทธิ์ เรียบร้อย!";
			$jsonrespontext = "Update Error!";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg",'textrespon'=>$jsonrespontext);
		echo json_encode($respon);
	}

	//end function addData

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
				"edit"=>" <button type=\"button\" onclick=\"editRowlevel('$level_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"removeRowlevel('$level_id','$level_name');\" class=\"btn btn-sm btn-secondary\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.' '.$btnsetpermission.' '.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$rownum++;

			$row = array();
			$row[id] = $level_id;
			$row[row] = $rownum;
			$row[level_name] = $level_name;
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
			$textstatus = "success";
			$textrespon = "เพิ่ม ระดับสิทธิ์ $levelname สำเร็จ!";
			$textmsg = "Add Success!";
		}else{
			$textstatus = "error";
			$textrespon = "เพิ่ม ระดับสิทธิ์ $levelname ไม่สำเร็จ!";
			$textmsg = "Add Error!";
		}

		$respon = array('status'=>$textstatus,'msg'=>$textmsg,'textrespon'=>$textrespon);
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
			$textstatus = "success";
			$textrespon = "แก้ไข ระดับสิทธิ์ $levelname สำเร็จ!";
			$textmsg = "Edit Success!";
		}else{
			$textstatus = "error";
			$textrespon = "แก้ไข ระดับสิทธิ์ $levelname ไม่สำเร็จ!";
			$textmsg = "Edit Error!";
		}


		$respon = array('status'=>$textstatus,'msg'=>$textmsg,'textrespon'=>$textrespon);
		echo json_encode($respon);
	}

	public function delDatalevel()
	{
		$id = $_REQUEST['id'];

		if(isset($id)):
			$level_name = $this->getTextformid('kp_user_level','level_name','level_id',$id);

			$del = $this->updaterow("kp_user_level",array('is_delete'=>1),"where level_id = '$id' ");
		endif;

		if($del===TRUE){
			$textstatus = "success";
			$textrespon = "ลบ ระดับสิทธิ์ $level_name สำเร็จ!";
			$textmsg = "Delete Success!";
		}else{
			$textstatus = "error";
			$textrespon = "ลบ ระดับสิทธิ์ $level_name ไม่สำเร็จ!";
			$textmsg = "Delete Error!";
		}

		$respon = array('status'=>$textstatus,'msg'=>$textmsg,'textrespon'=>$textrespon);
		echo json_encode($respon);
	}
	//end function addData

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

}
