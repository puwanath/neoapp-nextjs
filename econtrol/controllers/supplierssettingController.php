<?php
$param = "suppliers";
require "models/$param.php";

class suppliersController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการระบบสินค้า";
		$pagename = "ผู้ผลิตสินค้า";
		$param = "suppliers";
		$classpage = "";
		$model = new suppliersController;

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

		$sql = "select count(*) as rowcount from kp_products_suppliers where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  (supp_name LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  supp_id LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  slug LIKE '%".$requestData['search']."%') ";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['rowcount'];
		$start = $rows * ($pageno -1);

		$sql = "select * from kp_products_suppliers where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  (supp_name LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  supp_id LIKE '%".$requestData['search']."%' ";
			$sql.= "OR  slug LIKE '%".$requestData['search']."%') ";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_assoc()){
			$supp_id = $res['supp_id'];
			$supp_name_th = $res['supp_name_th'];
			$supp_name_en = $res['supp_name_en'];
			$slug = $res['slug'];
			$sortnum = $res['sort'];

			if(!empty($res['supp_img'])){
				if(file_exists("../images/suppliers/tmp/{$res['supp_img']}")==true){
					$img = "{$urlweb}/images/suppliers/tmp/{$res['supp_img']}";
					$img = "<img src='{$img}' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}else{
					$img = "{$urlweb}/images/no-img.jpg";
					$img = "<img src='{$img}' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
				}
			}else{
				$img = "{$urlweb}/images/no-img.jpg";
				$img = "<img src='{$img}' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
			}


			$created = date("d/m/Y H:i:s",strtotime($res['create_date']));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res['user_create']);
			$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('".($res['status']==1?0:1)."','{$supp_id}')\" class=\"btn btn-sm ".($res['status']==1?'btn-success':'btn-secondary')."\"><i class=\"fa fa-check\"></i></button>";

			$btn_sort = "<button type=\"button\" onclick=\"sortRow('{$sortnum}','up','supp_id','{$supp_id}');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-up\"></i></button>";
			$btn_sort.= "<button type=\"button\" onclick=\"sortRow('{$sortnum}','down','supp_id','{$supp_id}');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-down\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('{$supp_id}');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('{$supp_id}','{$supp_name}');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['id'] = $supp_id;
			$row['supp_name_th'] = $supp_name_th;
			$row['supp_name_en'] = $supp_name_en;
			$row['slug'] = $slug;
			$row['supp_img'] = $img;
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

	//begin function addData
	public function saveData()
	{
		$formdata['supp_name_th'] = addslashes($_POST['supp_name_th']);
		$formdata['supp_name_en'] = addslashes($_POST['supp_name_en']);
		$formdata['supp_detail_th'] = addslashes($_POST['supp_detail_th']);
		$formdata['supp_detail_en'] = addslashes($_POST['supp_detail_en']);
		$formdata['slug'] = str_replace(' ','-',$_POST['slug']);

		if($_POST['action']=='add'){
			$formdata['sort'] = $this->sortMax('kp_products_suppliers','sort');
			$formdata['status'] = 1;
			$formdata['is_delete'] = 0;

			$update = $this->insertrow("kp_products_suppliers",$formdata);
			if($update['status']===TRUE){

				//start function save log transection
				$desclog = "Create Supplier {$_POST['supp_name']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'create suppliers success!';
				$output['id'] = $update['insert_id'];
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'create suppliers fail!'.implode(',',$formdata);
			}
			echo json_encode($output);
		}else{
			$supp_id = $_POST['supp_id'];
			$update = $this->updaterow("kp_products_suppliers",$formdata,"where supp_id = '{$supp_id}' ");
			if($update===TRUE){

				//start function save log transection
				$desclog = "Update Supplier {$_POST['supp_name']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'Update suppliers success!';
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'Update suppliers fail!';
			}
			echo json_encode($output);
		}
	}

	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_products_suppliers","where supp_id = '{$id}' ");
		$res = $qr->fetch_assoc();

		$output = array();
		$output['supp_id'] = $res['supp_id'];
		$output['supp_name_th'] = $res['supp_name_th'];
		$output['supp_name_en'] = $res['supp_name_en'];
		$output['supp_detail_th'] = $res['supp_detail_th'];
		$output['supp_detail_en'] = $res['supp_detail_en'];
		$output['slug'] = $res['slug'];

		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_products_suppliers","where supp_id = '{$id}' ");
		$res= $qr->fetch_object();
		$supp_name = $res->supp_name;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_products_suppliers",array('is_delete'=>'1'),"where supp_id = '{$id}' ");
		endif;

		if($del){
			$this->sortDatanew();
			//start function save log transection
			$desclog = "ลบ [แบรนด์สินค้า] ชื่อ {$supp_name}";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Delete [{$supp_name}] success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete [{$supp_name}] error!";
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
				$del = $this->updaterow("kp_products_suppliers",array('is_delete'=>'1'),"where supp_id = '{$id}' ");
			}
		}

		if($del){
			$set_id = implode(',',$set_id);
			$this->sortDatanew();
			//start function save log transection
			$desclog = "ลบ [ช้อมูลแบรนด์สินค้าตามที่เลือก] Set $set_id";
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
		$supp_name = $this->getTextformid("kp_products_suppliers","supp_name","supp_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_products_suppliers",array('status'=>$status),"where supp_id = '{$id}' ");
		}


		if($updatestatus){
			//start function save log transection
			$desclog = "เปลี่ยน $supp_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$supp_name] success!";
		}else{
			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$supp_name] error!";
		}
		echo json_encode($respon);
	}

	public function sortDatanew(){
		$qr = $this->fetchdata("kp_products_suppliers","where is_delete=0 order by sort asc");
		while($res = $qr->fetch_object()){
			$id = $res->supp_id;
			$arrid[] = $id;
		}

		$i = 0;
		foreach ($arrid as $value) {
			$supp_id = $value;
			$data = array('sort'=>$i);
			$this->updaterow("kp_products_suppliers",$data,"where supp_id = '".$supp_id."' ");
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
		}elseif($_REQUEST['line']==($this->countdatasort("sort","kp_products_suppliers")-1) and $sorttype=="down"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output['status'] = "success";
			if($sorttype=="up"){
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_products_suppliers","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_products_suppliers","where sort = '$sort_post' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_post
				);

				$this->updaterow("kp_products_suppliers",$sortdata,"where supp_id = '".$resu->supp_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_products_suppliers",$sortdata2,"where supp_id = '".$resu2->supp_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_products_suppliers","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_products_suppliers","where sort = '$sort_plus' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_plus
				);

				$this->updaterow("kp_products_suppliers",$sortdata,"where supp_id = '".$resu->supp_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_products_suppliers",$sortdata2,"where supp_id = '".$resu2->supp_id."' ");
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
		$qr = $this->fetchdata("kp_products_suppliers","where supp_id = '$id' ");
		$res = $qr->fetch_object();

		if($res->supp_img!=''){
			$img = "$url2/images/suppliers/tmp/$res->supp_img";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('supp_img','$id')\" class=\"btn btn-danger btn-oblong
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
		if(empty($_REQUEST['supp_id'])){
			$id = $this->NewID('B','supp_id','kp_products_suppliers');
		}else{
			$id = $_REQUEST['supp_id'];
		}

		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'suppliers-'.$id.'-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"../images/suppliers/tmp/");
			copy($file_tmp,"../images/suppliers/$pic_name");

			if(empty($_REQUEST['supp_id'])==true){
				$sort = $this->sortMax('kp_products_suppliers','sort');
				$usercreate = getSession();
				$form_data = array(
					'supp_id'=>$id,
					'supp_img'=>$pic_name,
					'is_delete'=>0,
					'status'=>1,
					'sort'=>$sort,
					'user_create'=>$usercreate
				);
				$updateimg = $this->insertrow('kp_products_suppliers',$form_data);
			}else{
				$form_data = array(
					'supp_img'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_products_suppliers', $form_data, "WHERE supp_id = '$id'");
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

		$qr = $this->fetchdata("kp_products_suppliers","where supp_id = '{$id}' ");
		$res = $qr->fetch_object();

		$updateimg = $this->updaterow('kp_products_suppliers', array('supp_img'=>''), "WHERE supp_id = '{$id}' ");

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
			$output['id'] =$id;

			if(file_exists("../images/suppliers/{$res->supp_img}")==true){
				unlink("../images/suppliers/{$res->supp_img}");
				unlink("../images/suppliers/tmp/{$res->supp_img}");
			}
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
		}


		echo json_encode($output);

	}


}
