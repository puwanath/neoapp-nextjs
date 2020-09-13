<?php
$param = "coupon";
require "models/$param.php";

class couponController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการคูปอง";
		$pagename = "จัดการคูปอง";
		$param = "coupon";
		$classpage = 1;
		$model = new couponController;

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
								<span class="pd-x-15">เพิ่มคูปอง</span>
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
			"<script src='//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js'></script>",
			"<script src='".$dir."datetimepicker/js/bootstrap-datetimepicker.min.js'></script>",
			"<link href='".$dir."datetimepicker/css/bootstrap-datetimepicker.css' rel='stylesheet'>"
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

		$sql = "select count(*) as countrow from kp_coupon where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( lower(coupon_code) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR coupon_name LIKE '%".$requestData['search']."%' )";
		}
		$res = $dbCon->query($sql)->fetch_assoc;
		$count = $res->countrow;

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

		$sql = "select * from kp_coupon where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( lower(coupon_code) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR coupon_name LIKE '%".$requestData['search']."%' )";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		// if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		// }
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$coupon_id = $res->coupon_id;
			$coupon_code = $res->coupon_code;
			$coupon_name = $res->coupon_name;
			$coupon_type = $res->coupon_type;
			if($coupon_type=='percent'){
				$coupon_amt = $res->coupon_amt.' %';
			}else{
				$coupon_amt = $res->coupon_amt.' Baht';
			}
			if($res->coupon_limit==0){
				$coupon_limit = 'ไม่กำหนดจำนวน';
			}else{
				$coupon_limit = $res->coupon_limit;
			}
			if($res->coupon_min_sales==0){
				$coupon_min_sales = 'ไม่มีขั้นต่ำในการสั่งซื้อ';
			}else{
				$coupon_min_sales = number_format($res->coupon_min_sales,2);
			}

			$coupon_start = date("d/m/Y",strtotime($res->coupon_start));
			$coupon_end = date("d/m/Y",strtotime($res->coupon_end));


			$created = date("d/m/Y H:i:s",strtotime($res->create_date));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);


			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$coupon_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$coupon_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$coupon_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$coupon_id','$coupon_code');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['id'] = $coupon_id;
			$row['coupon_code'] = $coupon_code;
			$row['coupon_name'] = $coupon_name;
			$row['coupon_amt'] = $coupon_amt;
			$row['coupon_type'] = $coupon_type;
			$row['coupon_limit'] = $coupon_limit;
			$row['coupon_min_sales'] = $coupon_min_sales;
			$row['coupon_between'] = $coupon_start.' - '.$coupon_end;
			$row['created'] = $created;
			$row['creator'] = $creator;
			$row['btn_act'] = $btnaction;
			array_push($arr,$row);
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
		$readData = $_POST;
		$coupon_id = $this->NewID('C','coupon_id','kp_coupon');
		$coupon_code = $readData['coupon_code'];
		$coupon_name = $readData['coupon_name'];
		$coupon_amt = $readData['coupon_amt'];
		$coupon_type = $readData['coupon_type'];
		$coupon_limit = $readData['coupon_limit'];
		$coupon_min_sales = $readData['coupon_min_sales'];
		$coupon_start = str_replace('/', '-', $readData['coupon_start']);
		$coupon_start = date("Y-m-d",strtotime($coupon_start));
		$coupon_end = str_replace('/', '-', $readData['coupon_end']);
		$coupon_end = date("Y-m-d",strtotime($coupon_end));
		$is_delete = 0;
		$is_status = 1;
		$usercreate = getSession();

		if(isset($coupon_code)):

			$form_data = array(
				'coupon_id'=>$coupon_id,
				'coupon_code'=>$coupon_code,
				'coupon_name'=>$coupon_name,
				'coupon_amt'=>$coupon_amt,
				'coupon_type'=>$coupon_type,
				'coupon_limit'=>$coupon_limit,
				'coupon_min_sales'=>$coupon_min_sales,
				'coupon_start'=>$coupon_start,
				'coupon_end'=>$coupon_end,
				'user_create'=>$usercreate,
				'is_delete'=>$is_delete,
				'status'=>$is_status
			);

			$insert = $this->insertrow('kp_coupon',$form_data);

		endif;

		if($insert){

			//start function save log transection
			$desclog = "เพิ่ม [ Coupon ] ชื่อ $coupon_code";
			savelog(getSession(),$desclog);
			//end function save log transection

			$jsonstatus = "success";
			$jsonrespontext = "Add $coupon_code success!";
			$jsonmsg = "เพิ่มข้อมูล Coupon สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Add $coupon_code error!";
			$jsonmsg = "ไม่สามารถ เพิ่มข้อมูล Coupon สำเร็จ  กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg","id"=>$coupon_id);
		echo json_encode($respon);
	}

	//end function addData

	//begin function loaddataedit
	public function loadDataedit(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_coupon","where coupon_id = '$id'");
		$res = $qr->fetch_object();

		$output = array();
		$output['coupon_id'] = $res->coupon_id;
		$output['coupon_code'] = $res->coupon_code;
		$output['coupon_name'] = $res->coupon_name;
		$output['coupon_amt'] = $res->coupon_amt;
		$output['coupon_type'] = $res->coupon_type;
		$output['coupon_limit'] = $res->coupon_limit;
		$output['coupon_min_sales'] = $res->coupon_min_sales;
		$output['coupon_start'] = date("d/m/Y",strtotime($res->coupon_start));
		$output['coupon_end'] = date("d/m/Y",strtotime($res->coupon_end));


		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function updateData
	public function updateData()
	{
		$readData = $_POST;
		$id = $readData['coupon_id'];
		$coupon_code = $readData['coupon_code'];
		$coupon_name = $readData['coupon_name'];
		$coupon_amt = $readData['coupon_amt'];
		$coupon_type = $readData['coupon_type'];
		$coupon_limit = $readData['coupon_limit'];
		$coupon_min_sales = $readData['coupon_min_sales'];
		$coupon_start = str_replace('/', '-', $readData['coupon_start']);
		$coupon_start = date("Y-m-d",strtotime($coupon_start));
		$coupon_end = str_replace('/', '-', $readData['coupon_end']);
		$coupon_end = date("Y-m-d",strtotime($coupon_end));
		$is_delete = 0;
		$is_status = 1;
		$usercreate = getSession();

		if(isset($id)):

			$form_data = array(
				'coupon_code'=>$coupon_code,
				'coupon_name'=>$coupon_name,
				'coupon_amt'=>$coupon_amt,
				'coupon_type'=>$coupon_type,
				'coupon_limit'=>$coupon_limit,
				'coupon_min_sales'=>$coupon_min_sales,
				'coupon_start'=>$coupon_start,
				'coupon_end'=>$coupon_end
			);

			$update = $this->updaterow('kp_coupon', $form_data, "WHERE coupon_id = '$id'");

		endif;

		if($update){

			//start function save log transection
			$desclog = "แก้ไข [ Coupon ] ชื่อ $coupon_code";
			savelog(getSession(),$desclog);
			//end function save log transection

			$jsonstatus = "success";
			$jsonrespontext = "Update [$coupon_code] success!";
			$jsonmsg = "แก้ไข ข้อมูล Coupon  [$coupon_code] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Update [$coupon_code] error!";
			$jsonmsg = "ไม่สามารถ แก้ไขข้อมูล Coupon  [$coupon_code] สำเร็จ  กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","respontext"=>$jsonrespontext,"msg"=>"$jsonmsg","id"=>$id);
		echo json_encode($respon);
	}
	//end function updateData

	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_coupon","where coupon_id = '$id' ");
		$res= $qr->fetch_object();
		$coupon_code = $res->coupon_code;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_coupon",array('is_delete'=>'1'),"where coupon_id = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [ Coupon ] ชื่อ $coupon_code";
			savelog(getSession(),$desclog);
			//end function save log transection

			$jsonstatus = "success";
			$jsonrespontext = "Delete [$coupon_code] success!";
			$jsonmsg = "ลบ ข้อมูล Coupon  [$coupon_code] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Delete [$coupon_code] error!";
			$jsonmsg = "ไม่สามารถ ลบ ข้อมูล Coupon  [$coupon_code] สำเร็จ  กรุณาติดต่อ Support";
		}

		$respon = array('status'=>$jsonstatus,'respontext'=>$jsonrespontext,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}
	//end function delData

	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$coupon_name = $this->getTextformid("kp_coupon","coupon_name","coupon_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_coupon",array('status'=>$status),"where coupon_id = '$id' ");
		}


		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $coupon_name ให้เปิดใช้งาน สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $coupon_name ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $coupon_name ให้เปิดใช้งาน ได้ กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
	}



}
