<?php
$param = "shippingsetting";
require "models/$param.php";

class shippingsettingController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการประเภทการจัดส่ง";
		$pagename = "ตั้งค่าจัดส่งสินค้า";
		$param = "shippingsetting";
		$classpage = "";
		$model = new shippingsettingController;

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

		$page = $requestData["page"];
		$limit = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;
		$totalrows = isset($requestData["totalrows"]) ? $requestData["totalrows"]: false;
		if($totalrows) {
		    $limit = $totalrows;
		}

		$sql = "select count(*) as count from kp_shipping_type where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  shipping_type_name LIKE '%".$requestData['search']."%' ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$res = $qr->fetch_object();
		$count = $res->count;

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

		$sql = "select * from kp_shipping_type where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND  shipping_type_name LIKE '%".$requestData['search']."%' ";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$shipping_type_id = $res->shipping_type_id;
			$shipping_type_name = $res->shipping_type_name;
			$shipping_type_price = $res->shipping_type_price;
			$sortnum = $res->sort;

			if(!empty($res->shipping_type_icon)){
				if(file_exists("../images/shipping/tmp/$res->shipping_type_icon")==true){
					$img = $urlweb."/images/shipping/tmp/$res->shipping_type_icon";
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

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$shipping_type_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$shipping_type_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btn_sort = "<button type=\"button\" onclick=\"sortRow('$sortnum','up','shipping_type_id','$shipping_type_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-up\"></i></button>";
			$btn_sort.= "<button type=\"button\" onclick=\"sortRow('$sortnum','down','shipping_type_id','$shipping_type_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-down\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$shipping_type_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$shipping_type_id','$shipping_type_name');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['id'] = $shipping_type_id;
			$row['shipping_type_name'] = $shipping_type_name;
			$row['shipping_type_price'] = $shipping_type_price;
			$row['shipping_type_icon'] = $img;
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

	//begin function addData
	public function addData()
	{
		$shipping_type_name = $_POST['shipping_type_name'];
		$shipping_type_price = $_POST['shipping_type_price'];
		$is_delete = 0;
		$is_status = 1;
		$sort = $this->sortMax('kp_shipping_type','sort');
		$usercreate = getSession();

		if(isset($shipping_type_name)):

			$form_data = array(
				'shipping_type_name'=>$shipping_type_name,
				'shipping_type_price'=>$shipping_type_price,
				'user_create'=>$usercreate,
				'is_delete'=>$is_delete,
				'sort'=>$sort,
				'status'=>$is_status
			);

			$insert = $this->insertrow('kp_shipping_type',$form_data);
		endif;

		if($insert){

			//start function save log transection
			$desclog = "เพิ่ม [รูปแบบการจัดส่ง] ชื่อ $shipping_type_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Add $shipping_type_name success!";
			$respon['id'] = $insert['insert_id'];

		}else{

			$respon['status'] = "error";
			$respon['msg'] = "Add $shipping_type_name error!";
			$respon['id'] = $insert['insert_id'];

		}

		echo json_encode($respon);
	}

	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_shipping_type","where shipping_type_id = '$id' ");
		$res = $qr->fetch_object();

		$output = array();
		$output['shipping_type_id'] = $res->shipping_type_id;
		$output['shipping_type_name'] = $res->shipping_type_name;
		$output['shipping_type_price'] = $res->shipping_type_price;
		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function updateData
	public function updateData()
	{
		$id = $_REQUEST['shipping_type_id'];
		$shipping_type_name = $_POST['shipping_type_name'];
		$shipping_type_price = $_POST['shipping_type_price'];
		$usercreate = getSession();

		if(isset($id)):

			$form_data = array(
				'shipping_type_name'=>$shipping_type_name,
				'shipping_type_price'=>$shipping_type_price
			);

			$update = $this->updaterow('kp_shipping_type', $form_data, "WHERE shipping_type_id = '$id'");

		endif;

		if($update){

			//start function save log transection
			$desclog = "แก้ไข [รูปแบบการจัดส่ง] ชื่อ $shipping_type_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Update [$shipping_type_name] success!";
			$respon['id'] = $id;

		}else{

			$respon['status'] = "success";
			$respon['msg'] = "Update [$shipping_type_name] error!";
			$respon['id'] = $id;

		}
		echo json_encode($respon);
	}
	//end function updateData

	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_shipping_type","where shipping_type_id = '$id' ");
		$res= $qr->fetch_object();
		$shipping_type_name = $res->shipping_type_name;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_shipping_type",array('is_delete'=>'1'),"where shipping_type_id = '$id' ");
		endif;

		if($del){
			$this->sortDatanew();
			//start function save log transection
			$desclog = "ลบ [รูปแบบการจัดส่ง] ชื่อ $shipping_type_name";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Delete [$shipping_type_name] success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete [$shipping_type_name] error!";
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
				$del = $this->updaterow("kp_shipping_type",array('is_delete'=>'1'),"where shipping_type_id = '$id' ");
			}
		}

		if($del){
			$set_id = implode(',',$set_id);
			$this->sortDatanew();
			//start function save log transection
			$desclog = "ลบ [ช้อมูลรูปแบบการจัดส่งตามที่เลือก] Set $set_id";
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
		$shipping_type_name = $this->getTextformid("kp_shipping_type","shipping_type_name","shipping_type_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_shipping_type",array('status'=>$status),"where shipping_type_id = '$id' ");
		}


		if($updatestatus){
			//start function save log transection
			$desclog = "เปลี่ยน $shipping_type_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$shipping_type_name] success!";
		}else{
			$respon['status'] = "success";
			$respon['msg'] = "Change Status [$shipping_type_name] error!";
		}
		echo json_encode($respon);
	}

	public function sortDatanew(){
		$qr = $this->fetchdata("kp_shipping_type","where is_delete=0 order by sort asc");
		while($res = $qr->fetch_object()){
			$id = $res->shipping_type_id;
			$arrid[] = $id;
		}

		$i = 0;
		foreach ($arrid as $value) {
			$shipping_type_id = $value;
			$data = array('sort'=>$i);
			$this->updaterow("kp_shipping_type",$data,"where shipping_type_id = '".$shipping_type_id."' ");
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
		}elseif($_REQUEST['line']==($this->countdatasort("sort","kp_shipping_type")-1) and $sorttype=="down"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output['status'] = "success";
			if($sorttype=="up"){
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_shipping_type","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_shipping_type","where sort = '$sort_post' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_post
				);

				$this->updaterow("kp_shipping_type",$sortdata,"where shipping_type_id = '".$resu->shipping_type_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_shipping_type",$sortdata2,"where shipping_type_id = '".$resu2->shipping_type_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_shipping_type","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_shipping_type","where sort = '$sort_plus' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_plus
				);

				$this->updaterow("kp_shipping_type",$sortdata,"where shipping_type_id = '".$resu->shipping_type_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_shipping_type",$sortdata2,"where shipping_type_id = '".$resu2->shipping_type_id."' ");
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
		$qr = $this->fetchdata("kp_shipping_type","where shipping_type_id = '$id' ");
		$res = $qr->fetch_object();

		if($res->shipping_type_icon!=''){
			$img = "$url2/images/shipping/tmp/$res->shipping_type_icon";
			$btn = "<div class=\"sk-rotating-plane\" style=\"margin: 0 auto;\">
				<button type=\"button\" onclick=\"delImg('shipping_type_icon','$id')\" class=\"btn btn-danger btn-oblong
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
		$img 			 = $_REQUEST['img'];
		$file      = $_FILES['fle']['name'];
		$file_tmp  = $_FILES['fle']['tmp_name'];
		$file_type = $_FILES['fle']['type'];


		if($file != "")
		{
			require 'common/functions/functions_images.php';
			$dot = substr($file,-3,3);
			$pic_name = 'shipping-'.time().".".$dot;
			resize($file_type,$file_tmp,$pic_name,300,"../images/shipping/tmp/");
			copy($file_tmp,"../images/shipping/$pic_name");

			if(empty($_REQUEST['shipping_type_id'])==true){
				$sort = $this->sortMax('kp_shipping_type','sort');
				$usercreate = getSession();
				$form_data = array(
					'shipping_type_icon'=>$pic_name,
					'is_delete'=>0,
					'status'=>1,
					'sort'=>$sort,
					'user_create'=>$usercreate
				);
				$updateimg = $this->insertrow('kp_shipping_type',$form_data);
				$id = $updateimg['insert_id'];
			}else{
				$id = $_REQUEST['shipping_type_id'];
				$form_data = array(
					'shipping_type_icon'=>$pic_name
				);

				$updateimg = $this->updaterow('kp_shipping_type', $form_data, "WHERE shipping_type_id = '$id'");
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

		$qr = $this->fetchdata("kp_shipping_type","where shipping_type_id = '$id' ");
		$res = $qr->fetch_object();

		$updateimg = $this->updaterow('kp_shipping_type', array('shipping_type_icon'=>''), "WHERE shipping_type_id = '".$id."' ");

		if($updateimg){
			$output['status'] = "success";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
			$output['id'] =$id;

			if(file_exists("../images/shipping/$res->shipping_type_icon")==true){
				unlink("../images/shipping/$res->shipping_type_icon");
				unlink("../images/shipping/tmp/$res->shipping_type_icon");
			}
		}else{
			$output['status'] = "error";
			$output['msg'] = "ลบรูปภาพสำเร็จ!";
		}


		echo json_encode($output);

	}


}
