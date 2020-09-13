<?php
$param = "orders";
require "models/$param.php";

class ordersController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "รายการขาย";
		$pagename = "จัดการรายการขาย";
		$param = "orders";
		$classpage = "collapsed-menu with-subleft";
		$model = new ordersController;

		// date formater
		$date = new DateTime('now');
		$date->modify('first day of this month');
		$startdate = $date->format('Y-m-d');
		$date->modify('last day of this month');
		$enddate = $date->format('Y-m-d');

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

			case 'updatestatus' :
				 $model->updateStatus();
				 break;

			case 'getdetailConfirm' :
				 $model->loadDatadetail();
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

		  case 'sendemailconfirm' :
				 $model->sendEmailconfirm();
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
		// $mainmenu = array(
		// 	'add'=>'<a href="'.$url.'/'.$get_part0.'/add" class="btn btn-info btn-with-icon"> <div class="ht-40">
		// 		<span class="icon wd-40"><i class="fa fa-plus"></i></span>
		// 		<span class="pd-x-15">Add New</span>
		// 	</div> </a>'
		// );
		// permission mwnu

		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link href='".$dir."lib/spectrum/spectrum.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>",
			"<link href='".$dir."daterangepicker-master/daterangepicker.css' rel='stylesheet'>"
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",
			"<script src='".$dir."lib/spectrum/spectrum.js'></script>",
			"<script src='".$dir."daterangepicker-master/moment.min.js'></script>",
			"<script src='".$dir."daterangepicker-master/daterangepicker.js'></script>",

		);
		//end css and js script

		if($select==''){

			if($get_part1=='export-excel'){
				$content = "views/$param/export-excel.php";
				$page = include("views/layout/exporttemplate.php");
				return $page;
			}else{
				$pagename = "รายการสั่งซื้อสินค้า ";
				$content = "views/$param/index.php";
				$page = include("views/layout/template.php");
				return $page;
			}


		}
	}
	//end function page

	public function loadData(){
		$arr = array();
		include "common/include/config.php";
		$requestData= $_REQUEST;
		$datestart = date("Y-m-d",strtotime($requestData['datestart']));
		$dateend = date("Y-m-d",strtotime($requestData['dateend']));


		$url = curPageURL();
		$pageno = $requestData["page"];
		$rows = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;

		$sql = "select count(*) as countrow from kp_orders where 1 ";
		if(!empty($requestData['datestart']) and !empty($requestData['dateend'])){
		$sql.= "and SUBSTR(order_date,1,10) between '$datestart' and '$dateend' ";
		}
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( order_id LIKE '%".$requestData['search']."%' ";
			$sql.= "OR member_id LIKE '%".$requestData['search']."%' ";
			$sql.= "OR member_id in (select member_id from kp_members where (member_name LIKE '%".$requestData['search']."%' or member_firstname LIKE '%".$requestData['search']."%' or member_lastname LIKE '%".$requestData['search']."%') )  ";
			$sql.= "OR lower(payment_desc) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR payment_reference_no LIKE '%".$requestData['search']."%' ) ";
		}
		if($requestData['order_status']!='all') {
			$requestData['order_status']=addslashes($requestData['order_status']);
			$sql.= "AND order_status = '".$requestData['order_status']."' ";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['countrow'];
		$start = $rows * ($pageno -1);


		$sql = "select * from kp_orders where 1 ";
		if(!empty($requestData['datestart']) and !empty($requestData['dateend'])){
		$sql.= "and SUBSTR(order_date,1,10) between '$datestart' and '$dateend' ";
		}
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( order_id LIKE '%".$requestData['search']."%' ";
			$sql.= "OR member_id LIKE '%".$requestData['search']."%' ";
			$sql.= "OR member_id in (select member_id from kp_members where (member_name LIKE '%".$requestData['search']."%' or member_firstname LIKE '%".$requestData['search']."%' or member_lastname LIKE '%".$requestData['search']."%') )  ";
			$sql.= "OR lower(payment_desc) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR payment_reference_no LIKE '%".$requestData['search']."%' ) ";
		}
		if($requestData['order_status']!='all') {
			$requestData['order_status']=addslashes($requestData['order_status']);
			$sql.= "AND order_status = '".$requestData['order_status']."' ";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";

		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = $start;
		while($res= $qr->fetch_object()){
			$order_id = $res->order_id;
			$order_date = date("d/m/Y H:i:s",strtotime($res->order_date));
			$order_no = '<div><span class="badge badge-success" style="font-size:16px;color:#000;"> '.$order_id.' </span></div>';
			$order_no.= '<div>'.$order_date.'</div>';
			$member_id = $res->member_id;
			$member_name = $this->getTextformid("kp_members","member_name","member_id",$member_id);
			$member_email = $this->getTextformid("kp_members","member_email","member_id",$member_id);
			$member_desc = '<div>'.$member_name.'</div>';
			$member_desc.= '<div>'.$member_email.'</div>';
			$order_amount = number_format($res->order_totamount,2);
			$shipping_type = $this->getTextformid("kp_shipping_type","shipping_type_name","shipping_type_id",$res->shipping_type_id);
			$shipping_amt = number_format($res->shipping_amt,2);
			$payment_type = $res->payment_desc;
			$payment_resultcode = $res->payment_resultcode;
			$payment_reference_no = $res->payment_reference_no;
			if($payment_resultcode=='00'){
				$resultcode = '<span class="badge badge-success"> '.$payment_resultcode.' </span>';
			}else{
				$resultcode = '<span class="badge badge-warning"> '.$payment_resultcode.' </span>';
			}
			if(!empty($payment_resultcode)){
				$payment_resultcode = '<div>'.$resultcode.'</div>';
				$payment_resultcode.= '<div>'.$payment_reference_no.'</div>';
			}else{
				$payment_resultcode = '';
			}

			$payment_amount = ($res->payment_confirm_amount>0?number_format($res->payment_confirm_amount,2):number_format($res->payment_amount,2));
			if(!empty($res->payment_confirm_file) or !empty($res->payment_confirm_note)){
				$payment_confirm = " <button type=\"button\" onclick=\"viewPaymentFunc('$order_id');\" class=\"btn btn-sm btn-secondary\"><i class=\"icon ion-eye\"></i> Payment Confirm </button>";
			}else{
				$payment_confirm = "-";
			}
			$order_point = $res->order_point;



			if($res->payment_status=='success'){
				$payment_status =  "<span class='badge badge-success'><i class='fa fa-check'></i> ชำระเงินสำเร็จ</span>";
			}elseif($res->payment_status=='pending'){
				$payment_status =  "<span class='badge badge-warning'><i class='fa fa-check'></i> รอการชำระเงิน</span>";
			}elseif($res->payment_status=='pending-payment'){
				$payment_status =  "<span class='badge badge-warning'><i class='fa fa-check'></i> รอการชำระเงิน</span>";
			}elseif($res->payment_status=='pending-review'){
				$payment_status =  "<span class='badge badge-light'><i class='fa fa-check'></i> ชำระแล้ว/รอตรวจสอบ</span>";
			}elseif($res->payment_status=='cancel'){
				$payment_status =  "<span class='badge badge-danger'><i class='fa fa-check'></i> ยกเลิก</span>";
			}else{
				$payment_status = "<span class='badge badge-danger'><i class='fa fa-check'></i> ทำรายการไม่สำเร็จ!</span>";
			}

			$order_status = $res->order_status;
			if($order_status=='success'){
				$order_status_tab =  "<span class='badge badge-success'><i class='fa fa-check'></i> ดำเนินการสำเร็จ</span>";
				$class_btn = 'btn-success';
			}elseif($order_status=='pending'){
				$order_status_tab =  "<span class='badge badge-warning'><i class='fa fa-check'></i> รอดำเนินการ</span>";
				$class_btn = 'btn-secondary';
			}elseif($order_status=='pending-payment'){
				$order_status_tab =  "<span class='badge badge-warning'><i class='fa fa-check'></i> รอการชำระเงิน</span>";
				$class_btn = 'btn-secondary';
			}elseif($order_status=='pending-review'){
				$order_status_tab =  "<span class='badge badge-light'><i class='fa fa-check'></i> ตรวจสอบชำระเงิน</span>";
				$class_btn = 'btn-light';
			}elseif($order_status=='shipping-success'){
				$order_status_tab =  "<span class='badge badge-success'><i class='fa fa-check'></i> จัดส่งสินค้าแล้ว</span>";
				$class_btn = 'btn-success';
			}elseif($order_status=='cancel'){
				$order_status_tab =  "<span class='badge badge-danger'><i class='fa fa-check'></i> ยกเลิก</span>";
				$class_btn = 'btn-danger';
			}else{
				$order_status_tab = '';
				$class_btn = 'btn-secondary';
			}

			// $btn_act = array(
			// 	"edit"=>" <button type=\"button\" onclick=\"editFunc('$order_date');\" class=\"btn btn-sm btn-warning\"><i class=\"icon ion-edit\"></i></button>",
			// 	"del"=>" <button type=\"button\" onclick=\"delFunc('$order_date','$cust_name');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			// );
			// $btnaction = '<div class="btn-group" role="group" aria-label="">';
			// $btnaction.= $btn_spam.getMenu_permission_button($btn_act);
			// $btnaction.= '</div>';

			// $btn_act = "<div class=\"btn-group\" role=\"group\" aria-label=\"Button Status\" style=\"z-index:9000;\">
			// 						<div class=\"btn-group\" role=\"group\" style=\"z-index:9999;\">
			// 							<select class=\"form-control-sm btn btn-secondary btn-sm\" name=\"order_status\" id=\"$order_id\" onchange=\"changeStatus('$order_id');\">
			// 								<option value=\"success\">ดำเนินการสำเร็จ</option>
			// 								<option value=\"pending\">รอดำเนินการ</option>
			// 								<option value=\"pending-review\">ตรวจสอบชำระเงิน</option>
			// 								<option value=\"cancel\">ยกเลิก</option>
			// 							</select>
			// 						</div>
			// 					  <button type=\"button\" onclick=\"printOrder('$order_id');\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-print\"></i></button>
			// 					  <button type=\"button\" onclick=\"trashOrder('$order_id');\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash\"></i></button>
			// 					</div>";



			$btn_act = "<div class=\"btn-group\" role=\"group\" aria-label=\"Button Status\" style=\"z-index:9000;\">
									<div class=\"btn-group\" role=\"group\" style=\"z-index:9999;\">
										<select class=\"form-control-sm btn $class_btn btn-sm\" name=\"order_status\" id=\"$order_id\" onchange=\"changeStatus('$order_id');\">";
										if($order_status=='success'){
											$btn_act.= "<option value=\"success\" selected>ดำเนินการสำเร็จ</option>";
										}else{
											$btn_act.= "<option value=\"success\" >ดำเนินการสำเร็จ</option>";
										}
										if($order_status=='shipping-success'){
											$btn_act.= "<option value=\"shipping-success\" selected>จัดส่งสินค้าแล้ว</option>";
										}else{
											$btn_act.= "<option value=\"shipping-success\" >จัดส่งสินค้าแล้ว</option>";
										}
										if($order_status=='pending'){
											$btn_act.= "<option value=\"pending\" selected>รอดำเนินการ</option>";
										}else{
											$btn_act.= "<option value=\"pending\" >รอดำเนินการ</option>";
										}
										if($order_status=='pending-payment'){
											$btn_act.= "<option value=\"pending-payment\" selected>รอการชำระเงิน</option>";
										}else{
											$btn_act.= "<option value=\"pending-payment\" >รอการชำระเงิน</option>";
										}
										if($order_status=='pending-review'){
											$btn_act.= "<option value=\"pending-review\" selected>ตรวจสอบชำระเงิน</option>";
										}else{
											$btn_act.= "<option value=\"pending-review\" >ตรวจสอบชำระเงิน</option>";
										}
										if($order_status=='cancel'){
											$btn_act.= "<option value=\"cancel\" selected>ยกเลิก</option>";
										}else{
											$btn_act.= "<option value=\"cancel\" >ยกเลิก</option>";
										}


				$btn_act.= "</select>
									</div>
								  <button type=\"button\" onclick=\"printOrder('$order_id');\" class=\"btn btn-light btn-sm\"><i class=\"fa fa-print\"></i></button>
								</div>";


			$i++;
			$row['row'] = $i;
			$row['order_id'] = $order_no;
			$row['order_no'] = $order_id;
			$row['order_date'] = $order_date;
			$row['member_name'] = $member_name;
			$row['member_email'] = $member_email;
			$row['member_desc'] = $member_desc;
			$row['order_amount'] = $order_amount;
			$row['shipping_type_id'] = $shipping_type_id;
			$row['shipping_amt'] = $shipping_amt;
			$row['payment_desc'] = $payment_type;
			$row['payment_resultcode'] = $payment_resultcode;
			$row['payment_reference_no'] = $payment_reference_no;
			$row['payment_amount'] = $payment_amount;
			$row['payment_confirm'] = $payment_confirm;
			$row['payment_status'] = $payment_status;
			$row['order_status'] = $order_status_tab;
			$row['order_point'] = $order_point;
			$row['btn_act'] = $btn_act;
			$arr[] = $row;
		}
		$output['records'] = $rowcount;
		$output['page'] = $pageno;
		$output['total'] = ceil($rowcount/$rows);
		$output['rows'] = $arr;
		// $output[msg] = $sql;

		echo json_encode($output);
	}

	//begin function loaddatadetail
	public function loadDatadetail(){
		$readData = $_REQUEST;
		$url = curPageURLweb();
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_orders","where order_id = '$id'");
		$res = $qr->fetch_object();
		$member_id = $res->member_id;
		$member_name = $this->getTextformid("kp_members","member_name","member_id",$member_id);
		$member_email = $this->getTextformid("kp_members","member_email","member_id",$member_id);
		$payment_confirm_file = "$url/images/paymentfile/$res->payment_confirm_file";
		$payment_confirm_amount = number_format($res->payment_confirm_amount,2);
		$payment_confirm_time = date("d/m/Y H:i:s",strtotime($res->payment_confirm_time));
		$payment_confirm_bank = $res->payment_confirm_bank;
		$payment_confirm_branch = $res->payment_confirm_branch;
		$payment_confirm_note = $res->payment_confirm_note;
		if(empty($res->payment_confirm_file)){
			$files = scandir('../images/paymentfile/');
			foreach ($files as $file) {
			    if (preg_match("/$member_name|$member_email/",$file) ? true : false) {
							if(preg_match("/pdf/",SUBSTR($file,-3,3)) ? true : false){
								$payment_file = "<embed src=\"{$url}/images/paymentfile/{$file}\" type=\"application/pdf\" width=\"300\">";
							}else{
								$payment_file = "<img src=\"{$url}/images/paymentfile/{$file}\" class=\"img-responsive\" style=\"max-width:300px;\"/>";
							}

			    }
			}
		}else{
			$payment_file = "<img src=\"{$url}/images/paymentfile/{$res->payment_confirm_file}\" class=\"img-responsive\" style=\"max-width:300px;\"/>";
		}

		$html = '<div class="row">';
		$html.= '<div class="col-lg-12 col-xs-12"><b>Paymant Date : </b> '.$payment_confirm_time.'</div>';
		$html.= '<div class="col-lg-12 col-xs-12"><b>Paymant Amount : </b> '.$payment_confirm_amount.'</div>';
		$html.= '<div class="col-lg-6 col-xs-12"><b>Paymant Bank : </b> '.$payment_confirm_bank.'</div>';
		$html.= '<div class="col-lg-6 col-xs-12"><b>Branch : </b> '.$payment_confirm_branch.'</div>';
		$html.= '<div class="col-lg-12 col-xs-12"><b>Paymant File : </b>
							<div class="text-center">
								'.$payment_file.'
							</div>
						</div>';
		$html.= '<div class="col-lg-12 col-xs-12"><b>Paymant Note : </b> '.$payment_confirm_note.'</div>';
		$html.= '</div>';

		$output = array();
		$output['order_id'] = $res->order_id;
		$output['order_date'] = date("d/m/Y H:i:s",strtotime($res->order_date));
		$output['detail'] = $html;

		echo json_encode($output);
	}
	//end function loaddatadetail

	public function updateStatus(){
		$readData = $_POST;
		$id = $readData['id'];
		$status = $readData['status'];

		if(!empty($id)){

			if($status=='cancel'){
				$updateorder = $this->updaterow('kp_orders',array('order_status'=>$status),"where order_id = '$id' ");
				if($updateorder===TRUE){
					$this->updateStock($id);
				}
			}elseif($status=='pending'){

				$order_status = $this->getTextformid('kp_orders','order_status','order_id',$id);
				if($order_status=='cancel'){
					$this->updateStock_post($id);
				}

				$updateorder = $this->updaterow('kp_orders',array('order_status'=>$status),"where order_id = '$id' ");
			}elseif($status=='shipping-success'){

				$order_status = $this->getTextformid('kp_orders','order_status','order_id',$id);
				if($order_status=='cancel'){
					$this->updateStock_post($id);
				}

				$updateorder = $this->updaterow('kp_orders',array('order_status'=>$status),"where order_id = '$id' ");
			}elseif($status=='pending-payment'){

				$order_status = $this->getTextformid('kp_orders','order_status','order_id',$id);
				if($order_status=='cancel'){
					$this->updateStock_post($id);
				}

				$updateorder = $this->updaterow('kp_orders',array('order_status'=>$status,'payment_status'=>$status),"where order_id = '$id' ");
			}elseif($status=='pending-review'){

				$order_status = $this->getTextformid('kp_orders','order_status','order_id',$id);
				if($order_status=='cancel'){
					$this->updateStock_post($id);
				}

				$updateorder = $this->updaterow('kp_orders',array('order_status'=>$status,'payment_status'=>$status),"where order_id = '$id' ");
			}elseif($status=='success'){

				$order_status = $this->getTextformid('kp_orders','order_status','order_id',$id);
				if($order_status=='cancel'){
					$this->updateStock_post($id);
				}

				$updateorder = $this->updaterow('kp_orders',array('order_status'=>$status,'payment_status'=>$status),"where order_id = '$id' ");
			}

			if($updateorder==TRUE){

				//start function save log transection
				$desclog = "อัพเดทสถานะ Order เลขที่ $id เป็น $status ";
				savelog(getSession(),$desclog);
				//end function save log transection

				$respon['status'] = "success";
				$respon['msg'] = "Update status Order ID $id success!";
				$respon['order_id'] = $id;
				$respon['order_status'] = $status;
			}else{
				$respon['status'] = "error";
				$respon['msg'] = "Update status Order ID $id error!";
			}

			echo json_encode($respon);
		}
	}



	public function updateStock($order_id){
		$qr = $this->fetchdata("kp_orders_detail","where order_id = '$order_id' ");
		while($res = $qr->fetch_object()){
			$qty = $res->qty;
			$prodid = $res->prodid;
			$this->calStock($prodid,$qty);
		}
		return 1;
	}


	public function calStock($prodid,$qty){
		$stock = $this->getTextformid('kp_products','qty','prodid',$prodid);
		if($qty>0){
			$amount = $stock+$qty;
			$arr_data = array(
				'qty'=>$amount
			);

			$update_stock = $this->updaterow('kp_products',$arr_data,"where prodid = '$prodid' ");
		}
		if($update_stock===TRUE){
			return 1;
		}else{
			return 0;
		}
	}

	public function updateStock_post($order_id){
		$qr = $this->fetchdata("kp_orders_detail","where order_id = '$order_id' ");
		while($res = $qr->fetch_object()){
			$qty = $res->qty;
			$prodid = $res->prodid;
			$this->calStock_post($prodid,$qty);
		}
		return 1;
	}


	public function calStock_post($prodid,$qty){
		$stock = $this->getTextformid('kp_products','qty','prodid',$prodid);
		if($qty>0){
			$amount = $stock-$qty;
			$arr_data = array(
				'qty'=>$amount
			);

			$update_stock = $this->updaterow('kp_products',$arr_data,"where prodid = '$prodid' ");
		}
		if($update_stock===TRUE){
			return 1;
		}else{
			return 0;
		}
	}


	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_orders","where order_date = '$id' ");
		$res= $qr->fetch_object();
		$cust_name = $res->cust_name;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_orders",array('is_delete'=>'1'),"where order_date = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [orders] ชื่อ $cust_name";
			savelog(getSession(),$desclog);
			//end function save log transection


			$jsonstatus = "success";
			$jsonrespontext = "Delete [$cust_name] success!";
			$jsonmsg = "ลบ ข้อมูลorders [$cust_name] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Delete [$cust_name] error!";
			$jsonmsg = "ไม่สามารถ ลบ ข้อมูลorders [$cust_name] สำเร็จ  กรุณาติดต่อ Support";
		}

		$respon = array('status'=>$jsonstatus,'respontext'=>$jsonrespontext,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}
	//end function delData

	//begin function spamData
	public function spamData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_orders","where order_date = '$id' ");
		$res= $qr->fetch_object();
		$cust_name = $res->cust_name;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_orders",array('is_spam'=>'1'),"where order_date = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "[orders] Move Transection to Spam Box ชื่อ $cust_name";
			savelog(getSession(),$desclog);
			//end function save log transection


			$jsonstatus = "success";
			$jsonrespontext = "Move Transection to Spam Box [$cust_name] success!";
			$jsonmsg = "ลบ ข้อมูลorders [$cust_name] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Move Transection to Spam Box [$cust_name] error!";
			$jsonmsg = "ไม่สามารถ Move Transection to Spam Box ข้อมูล [$cust_name] สำเร็จ  กรุณาติดต่อ Support";
		}

		$respon = array('status'=>$jsonstatus,'respontext'=>$jsonrespontext,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}
	//end function spamData



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





// =============================================================================
// =============================================================================

public function sendEmailconfirm(){
	$readData = $_POST;
	$order_id = $readData['order_id'];
	$qr = $this->fetchdata("kp_orders","where order_id = '{$order_id}'");
	$res = $qr->fetch_assoc();
	$member_id = $res['member_id'];
	$mailto = $this->getTextformid("kp_members","member_email","member_id",$member_id);
	$subject = "RECEIPT FOR YOUR PAYMENT TO ".getcomp('companyname');


	$this->sendMail_order_tocustomers($member_id,$mailto,$subject,$order_id);
	exit;
}


public function genMailorder_html($order_id){
	$urlweb = curPageURLWeb();
	$qrorder = $this->fetchdata("kp_orders","where order_id = '{$order_id}' ");
	$resorder = $qrorder->fetch_object();
	$cust_name = $this->getTextformid('kp_members','member_name','member_id',$resorder->member_id);
	$order_id = $resorder->order_id;
	$order_status = $resorder->order_status;
	$payment_desc = $resorder->payment_desc;
	$order_date = date("d F,Y H:i:s",strtotime($resorder->order_date));
	$shipping_type = $this->getTextformid('kp_shipping_type','shipping_type_name','shipping_type_id',$resorder->shipping_type_id);
	$shipping_amt = number_format($resorder->shipping_amt,2);
	$payment_status = $resorder->payment_status;
	$payment_amount = number_format($resorder->payment_amount,2);
	$fee = number_format($resorder->order_fee,2);


	// order detail
	$arr_detail = array();
	$i = 0;
	$totalAmt = 0;
	$qrorder_detail = $this->fetchdata("kp_orders_detail","where order_id = '{$order_id}' ");
	while($reslist = $qrorder_detail->fetch_object()){
		$i++;
		$prodname = $this->getTextformid('kp_products','prodname_en','prodid',$reslist->prodid);
		$prodtext = '<div style="font-size:10pt;color:#000;">'.$prodname.'</div>';
		$prodtext.= '<div style="font-size:10pt;color:#rrr;">'.$reslist->proddesc.'</div>';
		$tot_amount = number_format($reslist->tot_amount,2);
		$data = '<tr>
			<td align="center">'.$i.'</td>
			<td align="left">'.$prodtext.'</td>
			<td align="center">'.$reslist->qty.'</td>
			<td align="right">'.$tot_amount.'</td>
		</tr>';
		$totalAmt+=  $tot_amount;

		array_push($arr_detail,$data);
	}

	$logo_web = "{$urlweb}/images/".getcomp('logo_web');
	$html = '<html><body>';
	$html.= '<div style="padding:20px;width:100%;background-color:#eee;">
		<div style="margin:auto;max-width:600px;padding-top:10px;padding-bottom:10px;">
			<table style="width:100%;">
				<tr>
					<td width="50%"><img src="'.$logo_web.'" style="height:50px;"  alt="'.getcomp('companyname').'" /></td>
					<td width="50%" align="right"><b>Order Status</b> : '.$order_status.'</td>
				</tr>
			</table>
		</div>
		<div style="margin:auto;max-width:600px;background-color:#fff;padding:10px;">
			<div style="font-size:11pt;font-weight:bold;color:#000;">เรียน '.$cust_name.'</div>
			<div style="font-size:10pt;color:#333;">'.getcomp('companyname').' ได้รับ ORDER เลขที่ '.$order_id.' และได้รับการชำระเงินจากท่านเรียบร้อย </div>
			<div style="font-size:10pt;color:#333;">สถานะการชำระเงิน : '.$payment_status.'</div>';

	if($payment_amount>0){
		$html.= '<div style="font-size:10pt;color:#333;">ยอดเงินที่ชำระเข้ามา : '.$payment_amount.'</div>';
	}
	$html.= '<div style="margin-top:10px;padding:5px;">
				<table style="width:100%;" border="0" cellpadding="5">';
	if(count($arr_detail)>0){
	$html.='<tr><td colspan="4"><b>รายการสินค้าที่คุณสั่งซื้อ</b></td></tr>
					<tr>
						<td width="10%">ลำดับ</td>
						<td width="50%">รายการ</td>
						<td width="20%">จำนวน</td>
						<td width="20%">รวม</td>
					</tr>
					'.implode('',$arr_detail).'
					<tr>
						<td align="right" colspan="3"><b>รวมทั้งหมด</b></td>
						<td align="right"><b>'.number_format($totalAmt,2).'</b></td>
					</tr>
					<tr><td colspan="4"></td></tr>';
	}


	$html.= '<tr><td align="right" colspan="4" style="height:5px;border-bottom:1px dotted #333;"></td></tr>';
	$html.= '<tr>
		<td align="right" colspan="3"><b>ยอดรวมทั้งหมด</b></td>
		<td align="right"><b>'.number_format(($totalAmt+$totalAmt_booking),2).'</b></td>
	</tr>';

	$html.= '<tr>
		<td align="right" colspan="3"><b>รูปแบบการจัดส่ง/รับสินค้า</b></td>
		<td align="right"><b>'.$shipping_type.'</b></td>
	</tr>';
	$html.= '<tr>
		<td align="right" colspan="3"><b>ค่าจัดส่ง</b></td>
		<td align="right"><b>'.$shipping_amt.'</b></td>
	</tr>';
	$html.= '<tr>
		<td align="right" colspan="3"><b>ยอดรวมสุทธิ</b></td>
		<td align="right"><b>'.number_format(($totalAmt+$totalAmt_booking+$shipping_amt),2).'</b></td>
	</tr>';
	$html.= '</table>
			</div>
		</div>';

	$html.= '</div>';
	$html.= '<div style="text-align:center;"><span style="color:#333;font-size:7pt;">Please do not reply to this email. This mailbox is not monitored and you will not receive a response. For assistance, please use details as mentioned above.</span></div>';
	$html.= '<div style="text-align:center;"><span style="color:#333;font-size:6pt;">Copyright © '.getcomp('companyname').'  | '.getsocial('linkurl').'</span></div>';
	$html.= '</body></html>';

	return $html;
}

public function sendMail_order_tocustomers($member_id,$mailto,$subject,$order_id){

	//=================================//
	$member_name = $this->getTextformid('kp_members','member_name','member_id',$member_id);
	$name 	 	= getcomp('companyname');
	$mailfrom = getcomp('mail_username');
	$strSubject = "=?UTF-8?B?".base64_encode($subject)."?=";
	$strHeader .= "MIME-Version: 1.0' . \r\n";
	$strHeader .= "Content-type: text/html; charset=utf-8\r\n";
	$strHeader .= "From: $name <$mailfrom>\r\nReply-To: $mailfrom";
	$strVar = "ข้อความภาษาไทย";
	$body = $this->genMailorder_html($order_id);

		if(isset($mailto))
		{
			////// Email
			// @set_magic_quotes_runtime(false);
			// ini_set('magic_quotes_runtime', 0);
			require_once("common/mailer/class.phpmailer.php");
			require_once("common/mailer/class.smtp.php");

			$subj = $subject.' | '.date("F d,Y H:i:s");
			$mail = new PHPMailer(); // create a new object

			//$mail->IsSMTP(); // enable SMTP
			$mail->CharSet = "utf-8";
			$mail->IsHTML(true);
			$mail->IsSMTP();
			$mail->SMTPAuth = true; // enable SMTP authentication
			$mail->SMTPSecure = ""; // sets the prefix to the servier
			$mail->SMTPDebug = false; // debugging: 1 = errors and messages, 2 = messages only ,false = Disable
			$mail->Host = getcomp('mail_host');
			$mail->Port = getcomp('mail_port');
			$mail->Username = getcomp('mail_username'); //from@domainname.com
			$mail->Password = getcomp('mail_password');
			$mail->SetFrom(getcomp('mail_username'), $subj);
			$mail->Subject = $subj;
			$mail->Body    = $body;
			$mail->AddAddress($mailto);
			// $mail->AddAddress("puwanath.kapongidea@gmail.com");
			$mail->AddBCC("puwanath.kapongidea@gmail.com","CTO");
			if(!$mail->Send()){
				$flgSend = 0;
				//$err = "Mailer Error: " . $mail->ErrorInfo;
				}else{
				$flgSend = 1;
			}

		}

	//return $err;
	// $flgSend = @mail($strTo,$strSubject,$body,$strHeader);  // @ = No Show Error //
	return $flgSend;
}


// =============================================================================
// =============================================================================
// =============================================================================
}
