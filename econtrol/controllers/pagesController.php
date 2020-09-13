<?php
$param = "pages";
require "models/$param.php";

class pagesController extends Controllers
{
	public function index($get_part0='',$get_part1='',$get_part2='',$get_part3=''){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$urlweb = curPageURLweb();
		$pagemain = "จัดการหน้า";
		$param = "pages";
		$model = new pagesController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'readdata' :
				$model->readdata();
				break;

			case 'add' :
				$model->addData();
				break;

			case 'loaddata' :
				$model->loadData();
				break;

			case 'edit' :
				 $model->updateData();
				 break;

			case 'del' :
				 $model->delData();
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

		  case 'isstatus' :
		  	 $model->changeIsstatus();
		  	 break;

		  case 'isshowmenu' :
		  	 $model->changeIsshowmenu();
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
		$userfullname = $re->fullname;
		if($re->user_avatar!=''){
			$userimg = $url.'/images/user/tmp/'.$re->user_avatar;
		}else{
			$userimg = $url.'/images/avatar.jpg';
		}

		$qr = $this->fetchdata("kp_user_level","where level_id = '".$re->user_level."' ");
		$res = $qr->fetch_object();
		$levelname = $res->level_name;

		// permission menu
		$mainmenu = array(
			'add'=>'<a href="'.$url.'/'.$get_part0.'/add" class="btn btn-primary btn-with-icon"><div class="ht-40"><span class="icon wd-40"><i class="fa fa-plus"></i></span><span class="pd-x-15">เพิ่ม</span></div></a>'
		);
		// permission menu

		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>"
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",
		);
		//end css and js script


		if($select==''){
			if($get_part1=="add" or $get_part1=="edit"){
				if($get_part1=="add" ){
					$pagename = "เพิ่มหน้าเพจใหม่";
				}else{
					$pagename = "แก้ไขหน้าเพจ";
				}
				$p = "form.php";
			}else{
				$pagename = "รายการหน้าเพจ";
				$p = "index.php";
			}
			$content = "views/$param/$p";
			$page = include("views/layout/template.php");
			return $page;
		}

	}

	public function readdata(){
		$url = curPageURL();
		$url2 = curPageURLweb();
		$id = $_REQUEST['id'];

		$output = array();
		$qr = $this->fetchdata("kp_page","WHERE pageid = '$id' ");
		$res = $qr->fetch_object();

		$output[id] = $res->pageid;
		$output[slug] = $res->slug;
		$output[pagename_th] = $res->pagename_th;
		$output[pagename_en] = $res->pagename_en;
		$output[pagedetail_th] = $res->pagedetail_th;
		$output[pagedetail_en] = $res->pagedetail_en;
		$output[creator] = $this->getcreater($res->user_create);
		$output[datecreate] = date("m/d/Y H:i:s",strtotime($res->create_date));
		$output[seo_title] = $res->seo_title;
		$output[seo_desc] = $res->seo_desc;
		$output[sitepage] = $res->site_id;
		$output[rating] = $res->rating;
		$output[status] = $res->status;

		echo json_encode($output);
	}

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

		$sql = "select count(*) as countrow from kp_page where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( pagename_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(pagename_en) LIKE lower('%".$requestData['search']."%') )";
		}
		$res = $dbCon->query($sql)->fetch_assoc;
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

		$sql = "select * from kp_page where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( pagename_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(pagename_en) LIKE lower('%".$requestData['search']."%') )";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$i = 0;
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$pageid = $res->pageid;
			$pagename_th = $res->pagename_th;
			$pagename_en = $res->pagename_en;
			$site_id = $this->getTextformid('kp_sitepage','site_name','site_id',$res->site_id);
			$slug = $res->slug;
			$rating = (int)$res->rating;
			$created = date("d/m/Y H:i:s",strtotime($res->create_date));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$pageid')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$pageid')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}
			if($res->showmenu==1){
				$btn_showmenu = "<button type=\"button\" onclick=\"isFuncShowmenu('0','$pageid')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-eye\"></i></button>";
			}else{
				$btn_showmenu = "<button type=\"button\" onclick=\"isFuncShowmenu('1','$pageid')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-eye\"></i></button>";
			}

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$pageid');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$pageid','$pagename_th');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_showmenu.$btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$i++;
			$row = array();
			$row['id'] = $pageid;
			$row['row'] = $i;
			$row['pagename_th'] = $pagename_th;
			$row['pagename_en'] = $pagename_en;
			$row['slug'] = $slug;
			$row['site_id'] = $site_id;
			$row['rating'] = $rating;
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


	public function addData(){
		$id = $this->NewID("P","pageid","kp_page");
		$pagename_th = $_POST['pagename_th'];
		$pagename_en = $_POST['pagename_en'];
		$slug = str_replace(' ','-',$_POST['slug']);
		$pagedetail_th = $_POST['pagedetail_th'];
		$pagedetail_en = $_POST['pagedetail_en'];
		$seo_title = $_POST['seo_title'];
		$seo_desc = $_POST['seo_desc'];
		$siteid = $_POST['sitepage'];
		$user_id = getSession();
		$status = 1;
		$showmenu = 0;
		$is_delete = 0;

		if($pagename_th):
			$form_data = array(
				'pageid'=>$id,
				'slug'=>$slug,
				'pagename_th'=>$pagename_th,
				'pagename_en'=>$pagename_en,
				'pagedetail_th'=>$pagedetail_th,
				'pagedetail_en'=>$pagedetail_en,
				'seo_title'=>$seo_title,
				'seo_desc'=>$seo_desc,
				'site_id'=>$siteid,
				'user_create'=>$user_id,
				'status'=>$status,
				'showmenu'=>$showmenu,
				'is_delete'=>$is_delete
			);

			$insert = $this->insertrow('kp_page',$form_data);
		endif;

		if($insert===TRUE){

			//start function save log transection
			$desclog = "เพิ่มหน้า $pagename_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "เพิ่มหน้า $pagename_th สำเร็จ!";
			$respon['id'] = $id;

		}else{
			$respon['status'] = "error";
			$respon['msg'] = "ไม่สามารถเพิ่มหน้า $pagename_th  กรุณาติดต่อ Support";
			$respon['id'] = $id;
		}

		echo json_encode($respon);
	}


	public function updateData(){
		$id = $_POST['id'];
		$pagename_th = $_POST['pagename_th'];
		$pagename_en = $_POST['pagename_en'];
		$slug = str_replace(' ','-',$_POST['slug']);
		$pagedetail_th = $_POST['pagedetail_th'];
		$pagedetail_en = $_POST['pagedetail_en'];
		$seo_title = $_POST['seo_title'];
		$seo_desc = $_POST['seo_desc'];
		$siteid = $_POST['sitepage'];
		$user_id = getSession();

		if($pagename_th):

			$form_data = array(
				'slug'=>$slug,
				'pagename_th'=>$pagename_th,
				'pagename_en'=>$pagename_en,
				'pagedetail_th'=>$pagedetail_th,
				'pagedetail_en'=>$pagedetail_en,
				'seo_title'=>$seo_title,
				'seo_desc'=>$seo_desc,
				'site_id'=>$siteid
			);

			$update = $this->updaterow('kp_page',$form_data,"where pageid = '$id' ");

		endif;

		if($update){
			//start function save log transection
			$desclog = "อัพเดทหน้า $pagename_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "อัพเดทหน้า $pagename_th สำเร็จ!";
			$respon['id'] = $id;

		}else{
			$respon['status'] = "error";
			$respon['msg'] = "ไม่สามารถอัพเดทหน้า $pagename_th  กรุณาติดต่อ Support";
			$respon['id'] = $id;
		}
		echo json_encode($respon);

	}


	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_page","where pageid = '$id' ");
		$res= $qr->fetch_object();
		$pagename = $res->pagename_th;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_page",array('is_delete'=>'1'),"where pageid = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [ หน้าเพจ ] ชื่อ $pagename";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['respontext'] = "Delete [$pagename] success!";
			$respon['msg'] = "ลบข้อมูล หน้าเพจ  [$pagename] สำเร็จ!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "error";
			$respon['respontext'] = "Delete [$pagename] error!";
			$respon['msg'] = "ไม่สามารถลบข้อมูล หน้าเพจ  [$pagename] สำเร็จ  กรุณาติดต่อ Support";
			$respon['id'] = $id;
		}

		echo json_encode($respon);
	}
	//end function delData

	//begin function updateimg
	public function readDataimg(){
		$url = curPageURL();
		$url2 = curPageURLweb();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_page","where pageid = '$id' ");
		$res = $qr->fetch_object();

		if($res->pageimg!=''){
			$img = "$url2/images/pages/tmp/$res->pageimg";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('pageimg','$id')\" class=\"btn btn-danger btn-oblong
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
		if(empty($_REQUEST['pageid'])==true){
			$id = $this->NewID('P','pageid','kp_page');
		}else{
			$id = $_REQUEST['pageid'];
		}
		$user_id   = getSession();
		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'post-'.$id.'-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,400,"../images/pages/tmp/");
			copy($file_tmp,"../images/pages/$pic_name");

			if(empty($_REQUEST['pageid'])==true){
				$form_data = array(
					'pageid'=>$id,
					'pageimg'=>$pic_name,
					'user_create'=>$user_id,
					'is_delete'=>0
				);
				$updateimg = $this->insertrow('kp_page',$form_data);
			}else{
				$form_data = array(
					'pageimg'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_page', $form_data, "WHERE pageid = '$id'");
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

		$qr = $this->fetchdata("kp_page","where pageid = '$id' ");
		$res = $qr->fetch_object();

		$updateimg = $this->updaterow('kp_page', array('pageimg'=>''), "WHERE pageid = '".$id."' ");

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
			$output['id'] =$id;

			if(file_exists("../images/pages/$res->pageimg")==true){
				unlink("../images/pages/$res->pageimg");
				unlink("../images/pages/tmp/$res->pageimg");
			}
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
		}

		echo json_encode($output);
	}


	public function getSite(){
		$arr = array();
		$qr = $this->fetchdata("kp_sitepage","where status = 1 order by site_id asc");
		while($res = $qr->fetch_object()){
			$data = "<option value='$res->site_id'>แสดงที่หน้า : $res->site_name</option>";
			array_push($arr,$data);
		}

		return $arr;
	}

	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$pagename_th = $this->getTextformid("kp_page","pagename_th","pageid",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_page",array('status'=>$status),"where pageid = '$id' ");
		}


		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $pagename_th ให้เปิดใช้งาน สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $pagename_th ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $pagename_th ให้เปิดใช้งาน ได้ กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
	}

	public function changeIsshowmenu(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$pagename_th = $this->getTextformid("kp_page","pagename_th","pageid",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_page",array('showmenu'=>$status),"where pageid = '$id' ");
		}


		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $pagename_th ให้แสดงที่เมนู สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $pagename_th ให้แสดงที่เมนู สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $pagename_th ให้แสดงที่เมนู ได้ กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
	}

	public function siteName($id){
		$qr = $this->fetchdata("kp_sitepage","where site_id = '$id' ");
		$res = $qr->fetch_object();

		return $res->site_name;
	}


}

?>
