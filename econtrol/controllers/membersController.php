<?php
$param = "members";
require "models/$param.php";
class membersController extends Controllers
{
	//begin function index start page
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการสมาชิกเว็บไซต์";
		$pagename = "รายการสมาชิก";
		$param = "members";
		$classpage = '';
		$model = new membersController;

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

			case 'loaddataedit' :
				 $model->loadDataedit();
				 break;

			case 'edit' :
				 $model->updateData();
				 break;

			case 'del' :
				 $model->delData();
				 break;

		  case 'isstatus' :
		  	 $model->changeIsstatus();
		  	 break;

		  case 'isstatusban' :
		  	 $model->changeIsstatusBan();
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
			''
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

			if($get_part1=='add' or $get_part1=='edit'){
				//$p = 'form.php';
			}else{
				$p = 'index.php';
			}

			$content = "views/$param/$p";
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

		$sql = "select count(*) as countrow from kp_members where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( member_name LIKE '%{$requestData['search']}%' ";
			$sql.= "OR member_firstname LIKE '%{$requestData['search']}%' ";
			$sql.= "OR member_lastname LIKE '%{$requestData['search']}%' ";
			$sql.= "OR member_email LIKE '%{$requestData['search']}%' ";
			$sql.= "OR member_idcard LIKE '%{$requestData['search']}%' )";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['countrow'];
		$start = $rows * ($pageno -1);

		$sql = "select * from kp_members where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( member_name LIKE '%{$requestData['search']}%' ";
			$sql.= "OR member_firstname LIKE '%{$requestData['search']}%' ";
			$sql.= "OR member_lastname LIKE '%{$requestData['search']}%' ";
			$sql.= "OR member_email LIKE '%{$requestData['search']}%' ";
			$sql.= "OR member_idcard LIKE '%{$requestData['search']}%' )";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";

		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$member_id = $res->member_id;
			$member_name = $res->member_name;
			$member_idcard = $res->member_idcard;
			$member_email = $res->member_email;
			$member_tel = $res->member_tel;
			if(!empty($res->fb_id)){
				$signuptype = 'Facebook';
			}else{
				$signuptype = 'Email';
			}

			if(!empty($res->member_img)){
				if(file_exists("../images/members/tmp/$res->member_img")==true){
					$img = $urlweb."/images/members/tmp/$res->member_img";
					$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}else{
					$img = $urlweb."/images/no-img.jpg";
					$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}
			}else{
				if(!empty($res->member_avatar_small)){
					$img_avatar = str_replace('http://','https://',$res->member_avatar_small);
					$img = "<img src='$img_avatar' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}else{
					$img = $urlweb."/images/no-img.jpg";
					$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}

			}

			$created = date("d/m/Y H:i:s",strtotime($res->create_date));

			if($res->status_ban==1){
				$btn_status_ban = "<button type=\"button\" onclick=\"isFuncStatusBan('0','$member_id')\" class=\"btn btn-sm btn-danger\"><i class=\"fa fa-check\"></i> ถูกแบน </button>";
			}else{
				$btn_status_ban = "<button type=\"button\" onclick=\"isFuncStatusBan('1','$member_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i> ปกติ </button>";
			}

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$member_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i> ยืนยันแล้ว </button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$member_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i> รอยืนยัน </button>";
			}


			$btn_act = array(
				// "edit"=>" <button type=\"button\" onclick=\"editFunc('$member_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$member_id','$member_name');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_show.$btn_status_ban.$btn_status.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['id'] = $member_id;
			$row['member_name'] = $member_name;
			$row['member_firstname'] = $member_firstname;
			$row['member_idcard'] = $member_idcard;
			$row['member_email'] = $member_email;
			$row['member_tel'] = $member_tel;
			$row['member_avatar'] = $img;
			$row['member_signup_status'] = $signuptype;
			$row['member_lastlogin'] = date("d/m/Y H:i:s",strtotime($res->last_login));
			$row['created'] = $created;
			$row['btn_act'] = $btnaction;
			$arr[] = $row;
		}
		$output['records'] = $rowcount;
		$output['page'] = $pageno;
		$output['total'] = ceil($rowcount/$rows);
		$output['rows'] = $arr;
		// $output['error'] = $sql;

		echo json_encode($output);
	}


	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_members","where member_id = '$id'");
		$res = $qr->fetch_object();

		$output = array();
		$output['member_id'] = $res->member_id;
		$output['member_name'] = $res->member_name;
		$output['member_firstname'] = $res->member_firstname;
		$output['member_lastname'] = $res->member_lastname;
		$output['member_idcard'] = $res->member_idcard;
		$output['member_address1'] = $res->member_address1;
		$output['member_address2'] = $res->member_address2;
		$output['province'] = $res->province;
		$output['postcode'] = $res->postcode;
		$output['member_email'] = $res->member_email;
		$output['member_tel'] = $res->member_tel;
		$output['member_birthday'] = $res->member_birthday;
		$output['member_lineid'] = $res->member_lineid;
		$output['member_username'] = $res->member_username;
		$output['member_blood'] = $res->member_blood;
		$output['member_hcc'] = $res->member_hcc;
		$output['member_ec_name'] = $res->member_ec_name;
		$output['member_ec_relationship'] = $res->member_ec_relationship;
		$output['member_ec_tel'] = $res->member_ec_tel;

		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function updateData
	public function updateData()
	{
		$id = $_REQUEST['member_id'];
		$member_name = $_POST['member_name'];
		$member_firstname = $_POST['member_firstname'];
		$member_lastname = $_POST['member_lastname'];
		$member_idcard = $_POST['member_idcard'];
		$member_address1 = $_POST['member_address1'];
		$usercreate = getSession();

		if(isset($id)):

			$form_data = array(
				'member_name'=>$member_name,
				'member_firstname'=>$member_firstname,
				'member_lastname'=>$member_lastname,
				'member_idcard'=>$member_idcard,
				'member_address1'=>$member_address1,
			);

			$update = $this->updaterow('kp_members', $form_data, "WHERE member_id = '$id'");

		endif;

		if($update){

			//start function save log transection
			$desclog = "แก้ไข [ทีมงาน] ชื่อ $member_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$jsonstatus = "success";
			$jsonrespontext = "Update [$member_name] success!";
			$jsonmsg = "แก้ไข ข้อมูลทีมงาน [$member_name] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Update [$member_name] error!";
			$jsonmsg = "ไม่สามารถ แก้ไขข้อมูลทีมงาน [$member_name] สำเร็จ  กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","respontext"=>$jsonrespontext,"msg"=>"$jsonmsg","id"=>$id);
		echo json_encode($respon);
	}
	//end function updateData

	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_members","where member_id = '$id' ");
		$res= $qr->fetch_object();
		$member_name = $res->member_name;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_members",array('is_delete'=>'1'),"where member_id = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [ทีมงาน] ชื่อ $member_name";
			savelog(getSession(),$desclog);
			//end function save log transection


			$jsonstatus = "success";
			$jsonrespontext = "Delete [$member_name] success!";
			$jsonmsg = "ลบ ข้อมูลทีมงาน [$member_name] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Delete [$member_name] error!";
			$jsonmsg = "ไม่สามารถ ลบ ข้อมูลทีมงาน [$member_name] สำเร็จ  กรุณาติดต่อ Support";
		}

		$respon = array('status'=>$jsonstatus,'respontext'=>$jsonrespontext,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}
	//end function delData


	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$member_name = $this->getTextformid("kp_members","member_name","member_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_members",array('status'=>$status),"where member_id = '$id' ");
		}


		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $member_name ให้เปิดใช้งาน สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $member_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $member_name ให้เปิดใช้งาน ได้ กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
	}

	public function changeIsstatusBan(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$member_name = $this->getTextformid("kp_members","member_name","member_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_members",array('status_ban'=>$status),"where member_id = '$id' ");
		}


		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $member_name ให้เปิดใช้งาน สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $member_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $member_name ให้เปิดใช้งาน ได้ กรุณาติดต่อ Support";
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
			$output[status] = "error";
			$output[msg] = "รายการที่จัดเรียง ของคุณอยู่อันดับบนสุดแล้ว!";
		}elseif($_REQUEST['line']==($this->countdatasort("sort","kp_members")-1) and $sorttype=="down"){
			$output[status] = "error";
			$output[msg] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output[status] = "success";
			if($sorttype=="up"){
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_members","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_members","where sort = '$sort_post' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_post
				);

				$this->updaterow("kp_members",$sortdata,"where member_id = '".$resu->member_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_members",$sortdata2,"where member_id = '".$resu2->member_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_members","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_members","where sort = '$sort_plus' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_plus
				);

				$this->updaterow("kp_members",$sortdata,"where member_id = '".$resu->member_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_members",$sortdata2,"where member_id = '".$resu2->member_id."' ");
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
		$qr = $this->fetchdata("kp_members","where member_id = '$id' ");
		$res = $qr->fetch_object();

		if($res->m_img!=''){
			$img = "$url2/images/members/tmp/$res->m_img";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('m_img','$id')\" class=\"btn btn-danger btn-oblong
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
		if(empty($_REQUEST['member_id'])){
			$id = $this->NewID('C','member_id','kp_members');
		}else{
			$id = $_REQUEST['member_id'];
		}

		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'members-'.$id.'-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"../images/members/tmp/");
			copy($file_tmp,"../images/members/$pic_name");

			if(empty($_REQUEST['member_id'])==true){
				$sort = $this->sortMax('kp_members','sort');
				$usercreate = getSession();
				$form_data = array(
					'member_id'=>$id,
					'm_img'=>$pic_name,
					'is_delete'=>0,
					'status'=>1,
					'sort'=>$sort,
					'user_create'=>$usercreate
				);
				$updateimg = $this->insertrow('kp_members',$form_data);
			}else{
				$form_data = array(
					'm_img'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_members', $form_data, "WHERE member_id = '$id'");
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

		$qr = $this->fetchdata("kp_members","where member_id = '$id' ");
		$res = $qr->fetch_object();

		$updateimg = $this->updaterow('kp_members', array('m_img'=>''), "WHERE member_id = '".$id."' ");

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
			$output['id'] =$id;

			if(file_exists("../images/members/$res->m_img")==true){
				unlink("../images/members/$res->m_img");
				unlink("../images/members/tmp/$res->m_img");
			}
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
		}
		echo json_encode($output);
	}


}
