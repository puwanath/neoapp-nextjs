<?php
$param = "news";
require "models/$param.php";

class newsController extends Controllers
{
	public function index($get_part0='',$get_part1='',$get_part2='',$get_part3=''){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$urlweb = curPageURLweb();
		$pagemain = "จัดการข่าวสาร-กิจกรรม";
		$param = "news";
		$model = new newsController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'readdata' :
				$model->readdata();
				break;

			case 'readdataimg' :
				$model->readDataimg();
				break;

			case 'add' :
				$model->addData();
				break;

			case 'loaddata' :
				$model->loadData();
				break;

			case 'update' :
				 $model->updateData();
				 break;

		  case 'uploadimg' :
				 $model->uploadImg();
				 break;

			case 'del' :
				 $model->delData();
				 break;

		  case 'delimg' :
				 $model->delImg();
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
		$useremail = $re->user_email;
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
			"<link href='".$dir."lib/bootstrap-tagsinput/bootstrap-tagsinput.css' rel='stylesheet'>",
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>",
			"<script src='//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js'></script>",
			"<script src='".$dir."datetimepicker/js/bootstrap-datetimepicker.min.js'></script>",
			"<link href='".$dir."datetimepicker/css/bootstrap-datetimepicker.css' rel='stylesheet'>"
		);

		$jsarr = array(
			"<script src='".$dir."lib/bootstrap-tagsinput/bootstrap-tagsinput.js'></script>",
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",
		);

		//end css and js script


		if($select==''){
			if($get_part1=="add" or $get_part1=="edit"){
				if($get_part1=="add" ){
					$pagename = "เพิ่มข่าวสาร/กิจกรรมใหม่";
				}else{
					$pagename = "แก้ไขข่าวสาร/กิจกรรม";
				}
				$p = "form.php";
			}else{
				$pagename = "รายการข่าวสาร/กิจกรรม";
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
		$qr = $this->fetchdata("kp_news","WHERE newsid = '$id' ");
		$res = $qr->fetch_object();

		if($res->newsimg!=''){
			$img = "$url2/images/news/tmp/$res->newsimg";
			$btn_logo = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('newsimg')\" class=\"btn btn-danger btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> ลบภาพ
				</button>
			</div>";
		}else{
			$img = "";
			$btn_logo = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"btngetfile('fle')\" class=\"btn btn-primary btn-oblong
				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12\">
					<i class=\"fa fa-upload\"></i> อัพโหลดภาพ
				</button>
			</div>";
		}


		$output['id'] = $res->newsid;
		$output['slug'] = $res->slug;
		$output['newstopic_th'] = $res->newstopic_th;
		$output['newstopic_en'] = $res->newstopic_en;
		$output['newsdetail_th'] = $res->newsdetail_th;
		$output['newsdetail_en'] = $res->newsdetail_en;
		$output['creator'] = $this->getcreator($res->user_create);
		$output['datecreate'] = date("d/m/Y H:i:s",strtotime($res->create_date));
		$output['newsdate'] = date("d/m/Y",strtotime($res->newsdate));
		$output['rating'] = $res->rating;
		$output['seo_title'] = $res->seo_title;
		$output['seo_desc'] = $res->seo_desc;
		$output['sitepage'] = $res->site_id;
		$output['type_id'] = $res->type_id;
		$output['tags'] = $res->newstag;
		$output['status'] = $res->status;

		echo json_encode($output);
	}


	public function readDataimg(){
		$url = curPageURL();
		$url2 = curPageURLweb();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_news","where newsid = '$id' ");
		$res = $qr->fetch_object();

		if($res->newsimg!=''){
			$img = "$url2/images/news/tmp/$res->newsimg";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('newsimg','$id')\" class=\"btn btn-danger btn-oblong
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

		$sql = "select * from kp_news where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( newstopic_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(newstopic_en) LIKE lower('%".$requestData['search']."%') )";
		}
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

		$sql = "select * from kp_news where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( newstopic_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(newstopic_en) LIKE lower('%".$requestData['search']."%') )";
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
			$newsid = $res->newsid;
			$newstopic_th = $res->newstopic_th;
			$newstopic_en = $res->newstopic_en;
			$site_id = $this->getTextformid('kp_sitepage','site_name','site_id',$res->site_id);
			$type_id = $this->getTextformid('kp_type_news','type_name_th','type_id',$res->type_id);
			$slug = $res->slug;
			$rating = (int)$res->rating;
			$newsdate = date("d/m/Y",strtotime($res->newsdate));
			$created = date("d/m/Y H:i:s",strtotime($res->create_date));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);

			if(!empty($res->newsimg)){
				if(file_exists("../images/news/tmp/$res->newsimg")==true){
					$img = $urlweb."/images/news/tmp/$res->newsimg";
					$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}else{
					$img = $urlweb."/images/no-img.jpg";
					$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}
			}else{
				$img = $urlweb."/images/no-img.jpg";
				$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
			}

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$newsid')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$newsid')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$newsid');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$newsid','$newstopic_th');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$i++;
			$row = array();
			$row['id'] = $newsid;
			$row['row'] = $i;
			$row['img'] = $img;
			$row['newstopic_th'] = $newstopic_th;
			$row['newstopic_en'] = $newstopic_en;
			$row['slug'] = $slug;
			$row['newsdate'] = $newsdate;
			$row['type_id'] = $type_id;
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
		$id = $this->NewID('NEWS','newsid','kp_news');
		$newstopic_th = $_POST['newstopic_th'];
		$newstopic_en = $_POST['newstopic_en'];
		$slug = str_replace(' ','-',$_POST['slug']);
		$newsdetail_th = $_POST['newsdetail_th'];
		$newsdetail_en = $_POST['newsdetail_en'];
		$seo_title = $_POST['seo_title'];
		$seo_desc = $_POST['seo_desc'];
		$newsdate = str_replace('/', '-', $_POST['newsdate']);
		$newsdate = date("Y-m-d",strtotime($newsdate));
		$siteid = $_POST['sitepage'];
		$type_id = $_POST['type_id'];
		$tags = $_POST['tags'];
		$user_id = getSession();
		$status = 1;
		$is_delete = 0;

		if($newstopic_th):

			$form_data = array(
				'newsid'=>$id,
				'slug'=>$slug,
				'newstopic_th'=>$newstopic_th,
				'newstopic_en'=>$newstopic_en,
				'newsdetail_th'=>$newsdetail_th,
				'newsdetail_en'=>$newsdetail_en,
				'newsdate'=>$newsdate,
				'seo_title'=>$seo_title,
				'seo_desc'=>$seo_desc,
				'site_id'=>$siteid,
				'type_id'=>$type_id,
				'newstag'=>$tags,
				'user_create'=>$user_id,
				'status'=>$status,
				'is_delete'=>$is_delete
			);

			$insert = $this->insertrow('kp_news',$form_data);

		endif;

		if($insert){
			//start function save log transection
			$desclog = "เพิ่มข่าวสาร/กิจกรรม $newstopic_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "เพิ่มข่าวสาร/กิจกรรม $newstopic_th สำเร็จ!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "ไม่สามารถเพิ่มข่าวสาร/กิจกรรม $newstopic_th  กรุณาติดต่อ Support";
			$respon['id'] = $id;
		}
		echo json_encode($respon);
	}


	public function updateData(){
		$id = $_POST['id'];
		$newstopic_th = $_POST['newstopic_th'];
		$newstopic_en = $_POST['newstopic_en'];
		$slug = str_replace(' ','-',$_POST['slug']);
		$newsdetail_th = $_POST['newsdetail_th'];
		$newsdetail_en = $_POST['newsdetail_en'];
		$seo_title = $_POST['seo_title'];
		$seo_desc = $_POST['seo_desc'];
		$newsdate = str_replace('/', '-', $_POST['newsdate']);
		$newsdate = date("Y-m-d",strtotime($newsdate));
		$siteid = $_POST['sitepage'];
		$type_id = $_POST['type_id'];
		$tags = $_POST['tags'];
		$user_id = getSession();

		if($newstopic_th):

			$form_data = array(
				'slug'=>$slug,
				'newstopic_th'=>$newstopic_th,
				'newstopic_en'=>$newstopic_en,
				'newsdetail_th'=>$newsdetail_th,
				'newsdetail_en'=>$newsdetail_en,
				'newsdate'=>$newsdate,
				'seo_title'=>$seo_title,
				'seo_desc'=>$seo_desc,
				'site_id'=>$siteid,
				'type_id'=>$type_id,
				'newstag'=>$tags,
				'user_create'=>$user_id
			);

			$update = $this->updaterow('kp_news',$form_data,"where newsid = '$id' ");

		endif;

		if($update){
			//start function save log transection
			$desclog = "อัพเดทข่าวสาร/กิจกรรม $newstopic_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "อัพเดทข่าวสาร/กิจกรรม $newstopic_th สำเร็จ!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "ไม่สามารถอัพเดทข่าวสาร/กิจกรรม $newstopic_th ได้สำเร็จ  กรุณาติดต่อ Support";
			$respon['id'] = $id;
		}
		echo json_encode($respon);
	}

	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_news","where newsid = '$id' ");
		$res= $qr->fetch_object();
		$newstopic = $res->newstopic_th;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_news",array('is_delete'=>'1'),"where newsid = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [ ข่าวสาร/กิจกรรม ] ชื่อ $newstopic";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['respontext'] = "Delete [$newstopic] success!";
			$respon['msg'] = "ลบข้อมูล ข้อมูลข่าวสาร/กิจกรรม  [$newstopic] สำเร็จ!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "error";
			$respon['respontext'] = "Delete [$newstopic] error!";
			$respon['msg'] = "ไม่สามารถลบข้อมูล ข่าวสาร/กิจกรรม  [$newstopic] สำเร็จ  กรุณาติดต่อ Support";
			$respon['id'] = $id;
		}

		echo json_encode($respon);
	}
	//end function delData

	//begin function updateimg
	public function uploadImg()
	{
		if(empty($_REQUEST['newsid'])==true){
			$id = $this->NewID('NEWS','newsid','kp_news');
		}else{
			$id = $_REQUEST['newsid'];
		}

		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'post-'.$id.'-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,400,"../images/news/tmp/");
			copy($file_tmp,"../images/news/$pic_name");

			if(empty($_REQUEST['newsid'])==true){
				$form_data = array(
					'newsid'=>$id,
					'newsimg'=>$pic_name,
					'is_delete'=>0,
					'status'=>1
				);
				$updateimg = $this->insertrow('kp_news',$form_data);
			}else{
				$form_data = array(
					'newsimg'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_news', $form_data, "WHERE newsid = '$id'");
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

		$qr = $this->fetchdata("kp_news","where newsid = '$id' ");
		$res = $qr->fetch_object();

		$updateimg = $this->updaterow('kp_news', array('newsimg'=>''), "WHERE newsid = '".$id."' ");

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
			$output['id'] =$id;

			if(file_exists("../images/news/$res->newsimg")==true){
				unlink("../images/news/$res->newsimg");
				unlink("../images/news/tmp/$res->newsimg");
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
		$newstopic = $this->getTextformid("kp_news","newstopic_th","newsid",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_news",array('status'=>$status),"where newsid = '$id' ");
		}

		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $newstopic ให้เปิดใช้งาน สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $newstopic ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $newstopic ให้เปิดใช้งาน ได้ กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
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
	public function getCat(){
		$arr = array();
		$qr = $this->fetchdata("kp_type_news","where status = 1 order by type_id asc");
		while($res = $qr->fetch_object()){
			$data = "<option value='$res->type_id'>Select Category : $res->type_name_th</option>";
			array_push($arr,$data);
		}

		return $arr;
	}

	public function siteName($id){
		$qr = $this->fetchdata("kp_sitepage","where site_id = '$id' ");
		$res = $qr->fetch_object();

		return $res->site_name;
	}

	public function typeName($id){
		$qr = $this->fetchdata("kp_type_news","where type_id = '$id' ");
		$res = $qr->fetch_object();

		return $res->type_name_th;
	}



}

?>
