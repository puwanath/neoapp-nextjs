<?php
$param = "attributesetting";
require "models/$param.php";

class attributesettingController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการระบบสินค้า";
		$pagename = "คุณสมบัติ/รายละเอียดเพิ่มเติม";
		$param = "attributesetting";
		$classpage = 1;
		$model = new attributesettingController;

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

		$page = $requestData["page"];
		$limit = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;
		$totalrows = isset($requestData["totalrows"]) ? $requestData["totalrows"]: false;
		if($totalrows) {
		    $limit = $totalrows;
		}

		$sql = "select * from kp_products_varible where is_delete = 0 ";
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

		$sql = "select * from kp_products_varible where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( var_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR var_name_en LIKE '%".$requestData['search']."%' ) ";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$var_id = $res->var_id;
			$var_name_th = $res->var_name_th;
			$var_name_en = $res->var_name_en;
			$var_param = $res->var_param;
			$var_input_type = $res->var_input_type;
			$sortnum = $res->sort;

			if($var_input_type=='text'){
				$var_input_typename = 'ชนิดข้อความ Text box';
			}elseif($var_input_type=='number'){
				$var_input_typename = 'ชนิดตัวเลข Number box';
			}elseif($var_input_type=='color'){
				$var_input_typename = 'ชนิดกล่องสี RGB Color box';
			}else{
				$var_input_typename = '';
			}

			$created = date("d/m/Y H:i:s",strtotime($res->create_date));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$var_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$var_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btn_sort = "<button type=\"button\" onclick=\"sortRow('$sortnum','up','var_id','$var_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-up\"></i></button>";
			$btn_sort.= "<button type=\"button\" onclick=\"sortRow('$sortnum','down','var_id','$var_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-sort-down\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$var_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$var_id','$var_name_th');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['id'] = $var_id;
			$row['var_name_th'] = $var_name_th;
			$row['var_name_en'] = $var_name_en;
			$row['var_param'] = $var_param;
			$row['var_input_type'] = $var_input_typename;
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
		$var_name_th = $_POST['var_name_th'];
		$var_name_en = $_POST['var_name_en'];
		$var_param = $_POST['var_param'];
		$var_input_type = $_POST['var_input_type'];
		$is_delete = 0;
		$is_status = 1;
		$sort = $this->sortMax('kp_products_varible','sort');
		$usercreate = getSession();

		if(isset($var_name_th)):

			$form_data = array(
				'var_id'=>$var_id,
				'var_name_th'=>$var_name_th,
				'var_name_en'=>$var_name_en,
				'var_param'=>$var_param,
				'var_input_type'=>$var_input_type,
				'user_create'=>$usercreate,
				'is_delete'=>$is_delete,
				'sort'=>$sort,
				'status'=>$is_status
			);

			$insert = $this->insertrow('kp_products_varible',$form_data);

		endif;

		if($insert){

			//start function save log transection
			$desclog = "เพิ่ม [คุณสมบัติเพิ่มเติมสินค้า] ชื่อ $var_name_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Add [$var_name_th] success!";
			$respon['id'] = $var_id;
		}else{

			$respon['status'] = "error";
			$respon['msg'] = "Add [$var_name_th] error!";
			$respon['id'] = $var_id;
		}
		echo json_encode($respon);
	}

	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_products_varible","where var_id = '$id'");
		$res = $qr->fetch_object();

		$output = array();
		$output['var_id'] = $res->var_id;
		$output['var_name_th'] = $res->var_name_th;
		$output['var_name_en'] = $res->var_name_en;
		$output['var_param'] = $res->var_param;
		$output['var_input_type'] = $res->var_input_type;

		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function updateData
	public function updateData()
	{
		$id = $_REQUEST['var_id'];
		$var_name_th = $_POST['var_name_th'];
		$var_name_en = $_POST['var_name_en'];
		$var_param = $_POST['var_param'];
		$var_input_type = $_POST['var_input_type'];
		$usercreate = getSession();

		if(isset($id)):

			$form_data = array(
				'var_name_th'=>$var_name_th,
				'var_name_en'=>$var_name_en,
				'var_param'=>$var_param,
				'var_input_type'=>$var_input_type
			);

			$update = $this->updaterow('kp_products_varible', $form_data, "WHERE var_id = '$id'");

		endif;

		if($update){

			//start function save log transection
			$desclog = "แก้ไข [คุณสมบัติเพิ่มเติมสินค้า] ชื่อ $var_name_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Update [$var_name_th] success!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Update [$var_name_th] error!";
			$respon['id'] = $id;
		}
		echo json_encode($respon);
	}
	//end function updateData

	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_products_varible","where var_id = '$id' ");
		$res= $qr->fetch_object();
		$var_name_th = $res->var_name_th;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_products_varible",array('is_delete'=>'1'),"where var_id = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [คุณสมบัติเพิ่มเติมสินค้า] ชื่อ $var_name_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Delete [$var_name_th] success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete [$var_name_th] error!";
		}

		echo json_encode($respon);
	}
	//end function delData


	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$var_name_th = $this->getTextformid("kp_products_varible","var_name_th","var_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_products_varible",array('status'=>$status),"where var_id = '$id' ");
		}


		if($updatestatus){
			$respon['status'] = "success";
			$respon['msg'] = "Change status [$var_name_th] success!";

			//start function save log transection
			$desclog = "เปลี่ยน $var_name_th ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Change status [$var_name_th] error!";
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
		}elseif($_REQUEST['line']==($this->countdatasort("sort","kp_products_varible")-1) and $sorttype=="down"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output['status'] = "success";
			if($sorttype=="up"){
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_products_varible","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_products_varible","where sort = '$sort_post' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_post
				);

				$this->updaterow("kp_products_varible",$sortdata,"where var_id = '".$resu->var_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_products_varible",$sortdata2,"where var_id = '".$resu2->var_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$qr = $this->fetchdata("kp_products_varible","where sort = '$sort' ");
				$resu = $qr->fetch_object();

				$qr2 = $this->fetchdata("kp_products_varible","where sort = '$sort_plus' ");
				$resu2 = $qr2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_plus
				);

				$this->updaterow("kp_products_varible",$sortdata,"where var_id = '".$resu->var_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_products_varible",$sortdata2,"where var_id = '".$resu2->var_id."' ");
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
