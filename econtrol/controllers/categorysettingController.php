<?php
$param = "categorysetting";
require "models/$param.php";

class categorysettingController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการระบบสินค้า";
		$pagename = "หมวดหมู่สินค้า";
		$param = "categorysetting";
		$classpage = "";
		$model = new categorysettingController;

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

			case 'loadcategorymain' :
				 $model->loadCategorymain();
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

		  case 'isshow' :
		  	 $model->changeIsshow();
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

		$sql = "select count(*) as rowcount from kp_products_category where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "and ( cat_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "or cat_name_en LIKE '%".$requestData['search']."%' ";
			$sql.= "or cat_slug LIKE '%".$requestData['search']."%' ";
			$sql.= "or cat_id LIKE '%".$requestData['search']."%' )";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['rowcount'];
		$start = $rows * ($pageno -1);

		$sql = "select * from kp_products_category where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "and ( cat_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "or cat_name_en LIKE '%".$requestData['search']."%' ";
			$sql.= "or cat_slug LIKE '%".$requestData['search']."%' ";
			$sql.= "or cat_id LIKE '%".$requestData['search']."%' )";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$cat_id = $res->cat_id;
			$cat_name_th = $res->cat_name_th;
			$cat_name_en = $res->cat_name_en;
			if($cat_id!=$res->cat_id_main){
				$cat_nameth = '<span style="color:#666;font-style: italic;">-'.$cat_name_th.'</span>';
				$cat_nameen = '<span style="color:#666;font-style: italic;">-'.$cat_name_en.'</span>';
			}else{
				$cat_nameth = '<span style="font-weight: bold;">'.$cat_name_th.'</span>';
				$cat_nameen = '<span style="font-weight: bold;">'.$cat_name_en.'</span>';
			}
			$cat_detail_th = $res->cat_detail_th;
			$cat_detail_en = $res->cat_detail_en;
			$cat_slug = $res->cat_slug;
			$sortnum = $res->sort;
			if($res->cat_id_main!=$res->cat_id){
				$cat_main = $this->getTextformid('kp_products_category','cat_name_th','cat_id',$res->cat_id_main);
			}else{
				$cat_main = '';
			}

			if(!empty($res->cat_img)){
				if(file_exists("../images/category/tmp/$res->cat_img")==true){
					$img = $urlweb."/images/category/tmp/$res->cat_img";
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

			if($res->is_show==1){
				$btn_show = "<button type=\"button\" onclick=\"isFuncShow('0','$cat_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-eye\"></i></button>";
			}else{
				$btn_show = "<button type=\"button\" onclick=\"isFuncShow('1','$cat_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-eye\"></i></button>";
			}

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$cat_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$cat_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btn_sort = "<button type=\"button\" onclick=\"sortRow('$sortnum','up','cat_id','$cat_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-up\"></i></button>";
			$btn_sort.= "<button type=\"button\" onclick=\"sortRow('$sortnum','down','cat_id','$cat_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-down\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$cat_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$cat_id','$cat_name_th');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_show.$btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['cat_id'] = $cat_id;
			$row['cat_name_th'] = $cat_nameth;
			$row['cat_name_en'] = $cat_nameen;
			$row['cat_id_main'] = $cat_main;
			$row['cat_img'] = $img;
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


	// brgin function loadrentertype
	public function loadCategorymain(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_products_category","where is_delete=0 order by cat_id asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->cat_id;
			$arr['name']= $res->cat_name_th;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}


	// end function loadrentertype

	//begin function addData
	public function addData()
	{
		if(!empty($_POST['cat_id'])){
			$cat_id = $_POST['cat_id'];
		}else{
			$cat_id = $this->NewID('C','cat_id','kp_products_category');
		}
		$cat_name_th = $_POST['cat_name_th'];
		$cat_name_en = $_POST['cat_name_en'];
		$cat_slug = str_replace(' ','-',$_POST['cat_slug']);
		$cat_detail_th = $_POST['cat_detail_th'];
		$cat_detail_en = $_POST['cat_detail_en'];
		if(!empty($_POST['cat_id_main'])){
			$cat_id_main = $_POST['cat_id_main'];
		}else{
			$cat_id_main = $cat_id;
		}
		$seo_title = $_POST['seo_title'];
		$seo_desc = $_POST['seo_desc'];
		$seo_keyword = $_POST['seo_keyword'];
		$is_delete = 0;
		$is_show = 1;
		$is_status = 1;
		$sort = $this->sortMax('kp_products_category','sort');
		$usercreate = getSession();

		if(isset($cat_name_th)):

			$form_data = array(
				'cat_id'=>$cat_id,
				'cat_name_th'=>$cat_name_th,
				'cat_name_en'=>$cat_name_en,
				'cat_slug'=>$cat_slug,
				'cat_detail_th'=>$cat_detail_th,
				'cat_detail_en'=>$cat_detail_en,
				'cat_id_main'=>$cat_id_main,
				'seo_title'=>$seo_title,
				'seo_desc'=>$seo_desc,
				'seo_keyword'=>$seo_keyword,
				'user_create'=>$usercreate,
				'is_delete'=>$is_delete,
				'is_show'=>$is_show,
				'sort'=>$sort,
				'status'=>$is_status
			);

			$insert = $this->insertrow('kp_products_category',$form_data);

		endif;

		if($insert){

			//start function save log transection
			$desclog = "เพิ่ม [หมวดหมู่สินค้า] ชื่อ $cat_name_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Add [$cat_name_th] success!";
			$respon['id'] = $cat_id;
		}else{

			$respon['status'] = "error";
			$respon['msg'] = "Add [$cat_name_th] error!";
			$respon['id'] = $cat_id;
		}
		echo json_encode($respon);
	}

	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_products_category","where cat_id = '$id'");
		$res = $qr->fetch_object();

		$output = array();
		$output['cat_id'] = $res->cat_id;
		$output['cat_name_th'] = $res->cat_name_th;
		$output['cat_name_en'] = $res->cat_name_en;
		$output['cat_slug'] = $res->cat_slug;
		$output['cat_detail_th'] = $res->cat_detail_th;
		$output['cat_detail_en'] = $res->cat_detail_en;
		$output['cat_id_main'] = $res->cat_id_main;
		$output['seo_title'] = $res->seo_title;
		$output['seo_desc'] = $res->seo_desc;
		$output['seo_keyword'] = $res->seo_keyword;

		$arrdatatype = array();
		$qrtype = $this->fetchdata("kp_products_category","where is_delete=0 and status =1 order by cat_id asc ");
		while($restype = $qrtype->fetch_object()){

			$arrdatatype['id'] = $restype->cat_id;
			$arrdatatype['name']= $restype->cat_name_th;

			$respon['datarow'][] = $arrdatatype;
		}

		$output['datatype'] = $respon;

		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function updateData
	public function updateData()
	{
		$id = $_REQUEST['cat_id'];
		$cat_name_th = $_POST['cat_name_th'];
		$cat_name_en = $_POST['cat_name_en'];
		$cat_slug = str_replace(' ','-',$_POST['cat_slug']);
		$cat_detail_th = $_POST['cat_detail_th'];
		$cat_detail_en = $_POST['cat_detail_en'];
		if(!empty($_POST['cat_id_main'])){
			$cat_id_main = $_POST['cat_id_main'];
		}else{
			$cat_id_main = $id;
		}
		$seo_title = $_POST['seo_title'];
		$seo_desc = $_POST['seo_desc'];
		$seo_keyword = $_POST['seo_keyword'];
		$usercreate = getSession();

		if(isset($id)):

			$form_data = array(
				'cat_name_th'=>$cat_name_th,
				'cat_name_en'=>$cat_name_en,
				'cat_slug'=>$cat_slug,
				'cat_detail_th'=>$cat_detail_th,
				'cat_detail_en'=>$cat_detail_en,
				'cat_id_main'=>$cat_id_main,
				'seo_title'=>$seo_title,
				'seo_desc'=>$seo_desc,
				'seo_keyword'=>$seo_keyword
			);

			$update = $this->updaterow('kp_products_category', $form_data, "WHERE cat_id = '$id'");

		endif;

		if($update){

			//start function save log transection
			$desclog = "แก้ไข [หมวดหมู่สินค้า] ชื่อ $cat_name_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Update [$cat_name_th] success!";
			$respon['id'] = $id;

		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Update [$cat_name_th] error!";
			$respon['id'] = $id;
		}

		echo json_encode($respon);
	}
	//end function updateData

	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_products_category","where cat_id = '$id' ");
		$res= $qr->fetch_object();
		$cat_name_th = $res->cat_name_th;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_products_category",array('is_delete'=>'1'),"where cat_id = '$id' ");
		endif;

		if($del){
			$this->sortDatanew();
			//start function save log transection
			$desclog = "ลบ [หมวดหมู่สินค้า] ชื่อ $cat_name_th";
			savelog(getSession(),$desclog);
			//end function save log transection
			$respon['status'] = "success";
			$respon['msg'] = "Delete [$cat_name_th] success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete [$cat_name_th] error!";
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
				$del = $this->updaterow("kp_products_category",array('is_delete'=>'1'),"where cat_id = '$id' ");
			}
		}

		if($del){
			$set_id = implode(',',$set_id);
			//start function save log transection
			$desclog = "ลบ [ช้อมูลหมวดหมู่สินค้าตามที่เลือก] Set $set_id";
			savelog(getSession(),$desclog);
			//end function save log transection

			$this->sortDatanew();


			$respon['status'] = "success";
			$respon['msg'] = "Delete [$set_id] success!";
		}else{

			$respon['error'] = "success";
			$respon['msg'] = "Delete [$set_id] error!";
		}

		echo json_encode($respon);
	}
	//end function delselectData


	public function changeIsshow(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$cat_name = $this->getTextformid("kp_products_category","cat_name_th","cat_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_products_category",array('is_show'=>$status),"where cat_id = '$id' ");
		}


		if($updatestatus){
			$respon['status'] = "success";
			$respon['msg'] = "Change Status Show [$cat_name] success!";

			//start function save log transection
			$desclog = "เปลี่ยน $cat_name ให้แสดงที่หน้าเว็บไซต์ สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Change Status Show [$cat_name] error!";

		}
		echo json_encode($respon);
	}

	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$cat_name = $this->getTextformid("kp_products_category","cat_name_th","cat_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_products_category",array('status'=>$status),"where cat_id = '$id' ");
		}


		if($updatestatus){
			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$cat_name] success!";

			//start function save log transection
			$desclog = "เปลี่ยน $cat_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Change Status [$cat_name] error!";
		}
		echo json_encode($respon);
	}

	public function sortDatanew(){
		$qr = $this->fetchdata("kp_products_category","order by sort asc");
		while($res = $qr->fetch_object()){
			$id = $res->cat_id;
			$arrid[] = $id;
		}

		$i = 0;
		foreach ($arrid as $value) {
			$cat_id = $value;
			$data = array('sort'=>$i);
			$this->updaterow("kp_products_category",$data,"where cat_id = '".$cat_id."' ");
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
		}elseif($_REQUEST['line']==($this->countdatasort("sort","kp_products_category")-1) and $sorttype=="down"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output['status'] = "success";
			if($sorttype=="up"){
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_products_category","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_products_category","where sort = '$sort_post' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_post
				);

				$this->updaterow("kp_products_category",$sortdata,"where cat_id = '".$resu->cat_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_products_category",$sortdata2,"where cat_id = '".$resu2->cat_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_products_category","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_products_category","where sort = '$sort_plus' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_plus
				);

				$this->updaterow("kp_products_category",$sortdata,"where cat_id = '".$resu->cat_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_products_category",$sortdata2,"where cat_id = '".$resu2->cat_id."' ");
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
		$qr = $this->fetchdata("kp_products_category","where cat_id = '$id' ");
		$res = $qr->fetch_object();

		if($res->cat_img!=''){
			$img = "$url2/images/category/tmp/$res->cat_img";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('cat_img','$id')\" class=\"btn btn-danger btn-oblong
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
		if(empty($_REQUEST['cat_id'])){
			$id = $this->NewID('C','cat_id','kp_products_category');
		}else{
			$id = $_REQUEST['cat_id'];
		}

		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'category-'.$id.'-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"../images/category/tmp/");
			copy($file_tmp,"../images/category/$pic_name");

			if(empty($_REQUEST['cat_id'])==true){
				$sort = $this->sortMax('kp_products_category','sort');
				$usercreate = getSession();
				$form_data = array(
					'cat_id'=>$id,
					'cat_img'=>$pic_name,
					'is_delete'=>0,
					'is_show'=>1,
					'status'=>1,
					'sort'=>$sort,
					'user_create'=>$usercreate
				);
				$updateimg = $this->insertrow('kp_products_category',$form_data);
			}else{
				$form_data = array(
					'cat_img'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_products_category', $form_data, "WHERE cat_id = '$id'");
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

		$qr = $this->fetchdata("kp_products_category","where cat_id = '$id' ");
		$res = $qr->fetch_object();

		$updateimg = $this->updaterow('kp_products_category', array('cat_img'=>''), "WHERE cat_id = '".$id."' ");

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
			$output['id'] =$id;

			if(file_exists("../images/category/$res->cat_img")==true){
				unlink("../images/category/$res->cat_img");
				unlink("../images/category/tmp/$res->cat_img");
			}
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
		}


		echo json_encode($output);

	}


}
