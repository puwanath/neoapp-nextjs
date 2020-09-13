<?php
$param = "salesdashboard";
require "models/$param.php";
class salesdashboardController extends Controllers
{
	//begin function index start page
	public function index($get_part0=''){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "Sales Dashboard";
		$pagedesc = "แดชบอร์ดการขาย";
		$param = "salesdashboard";
		$classpage = "collapsed-menu with-subleft";
		$model = new salesdashboardController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loadstatic' :
				 $model->staticData();
				 break;

			case 'loadsalesproductgroup' :
				 $model->staticSalesproductgroup();
				 break;

			case 'loadsalesproductbrand' :
				 $model->staticSalesproductbrand();
				 break;

			case 'selectmonth' :
				 $model->Monthofreport();
				 break;

			case 'selectyear' :
				 $model->Yearofreport();
				 break;

		  case 'loadsalesdaily' :
 			 	 $model->staticSalesdaily();
 			 	 break;

		  case 'loadsalesmonth' :
 			 	 $model->staticSalesmonth();
 			 	 break;

		  case 'loadsalestop10products' :
 			 	 $model->staticSalestop10products();
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

		// begin css and js
		$cssarr = array(
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<link href='".$dir."daterangepicker-master/daterangepicker.css' rel='stylesheet'>",
		);

		$jsarr = array(
			"<script src='".$dir."daterangepicker-master/moment.min.js'></script>",
			"<script src='".$dir."daterangepicker-master/daterangepicker.js'></script>",
			'<script src="https://code.highcharts.com/stock/highstock.js"></script>',
			'<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>',
			'<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>'
		);
		//end css and js script

		if($select==''){
			$content = "views/$param/index.php";
			$page = include("views/layout/template.php");
			return $page;
		}


	}
	//end function page


	public function staticData(){
		include "common/include/config.php";
		$thai_month_arr=array(
			"00"=>"",
			"01"=>"มกราคม",
			"02"=>"กุมภาพันธ์",
			"03"=>"มีนาคม",
			"04"=>"เมษายน",
			"05"=>"พฤษภาคม",
			"06"=>"มิถุนายน",
			"07"=>"กรกฎาคม",
			"08"=>"สิงหาคม",
			"09"=>"กันยายน",
			"10"=>"ตุลาคม",
			"11"=>"พฤศจิกายน",
			"12"=>"ธันวาคม"
		);

		// sales today
		$datenow = date("Y-m-d");
		$sqlsumtoday = "select sum(order_totamount) as sumamount from kp_orders
		where order_date = '{$datenow}' and order_status != 'cancel' ";
		$qrsumtoday = $dbCon->query($sqlsumtoday) or die($dbCon->error);
		$ressumtoday = $qrsumtoday->fetch_assoc();
		$sumtoday  = $ressumtoday['sumamount'];
		$output['datetoday'] = date("d").' '.$thai_month_arr[date("m")].' '.date("Y");
		$output['today_sales'] = number_format($sumtoday,2);

		// sales this week
		$d = strtotime("today");
		$start_week = strtotime("last sunday midnight",$d);
		$end_week = strtotime("next saturday",$d);
		$start_week = date("d",$start_week).' '.$thai_month_arr[date("m",$start_week)].' '.date("Y",$start_week);
		$end_week = date("d",$end_week).' '.$thai_month_arr[date("m",$end_week)].' '.date("Y",$end_week);;
		$sqlsumweek = "select sum(order_totamount) as sumamount from kp_orders
		where WEEK(order_date) = WEEK('{$datenow}') and order_status != 'cancel' ";
		$qrsumweek = $dbCon->query($sqlsumweek) or die($dbCon->error);
		$ressumweek = $qrsumweek->fetch_assoc();
		$sumweek  = $ressumweek['sumamount'];
		$output['dateweek'] = $start_week.'-'.$end_week;
		$output['sales_this_week'] = number_format($sumweek,2);

		// sales this month
		$thismonth = date("Y-m");
		$sqlsummonth = "select sum(order_totamount) as sumamount from kp_orders
		where SUBSTR(order_date,1,7) = '$thismonth' and order_status != 'cancel' ";
		$qrsummonth = $dbCon->query($sqlsummonth) or die($dbCon->error);
		$ressummonth = $qrsummonth->fetch_assoc();
		$summonth  = $ressummonth['sumamount'];
		$output['datemonth'] = $thai_month_arr[date("m")].' '.date("Y");
		$output['sales_this_month'] = number_format($summonth,2);


		//count customers
		$sqlcountcust = "select count(*) as countcust from kp_members
		where is_delete=0 ";
		$qrcountcust = $dbCon->query($sqlcountcust) or die($dbCon->error);
		$rescountcust = $qrcountcust->fetch_assoc();
		$countcust  = $rescountcust['countcust'];
		$output['datecountcust'] = 'ทั้งหมด';
		$output['countcust'] = $countcust;

		echo json_encode($output);
	}

	public function staticSalesproductgroup(){
		include "common/include/config.php";
		$requestData= $_REQUEST;
		$datestart = date("Y-m-d",strtotime($requestData['datestart']));
		$dateend = date("Y-m-d",strtotime($requestData['dateend']));
		$mixeddate = date("F d,Y",strtotime($datestart)).' ถึง '.date("F d,Y",strtotime($dateend));

		$sql = "select cat.cat_name_th,sum(od.order_totamount) as sumamount
		from kp_orders as od
		inner join kp_orders_detail as ord on od.order_id = ord.order_id
		inner join kp_products as pd on pd.prodid = ord.prodid
		inner join kp_products_category as cat on cat.cat_id = pd.cat_id and cat.is_delete=0
		where od.order_status!='cancel' and od.order_date between '$datestart' and '$dateend'
		order by sumamount desc";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = 0;
		while ($res = $qr->fetch_object()) {
			$sumamount = (int)number_format($res->sumamount,2);
			if(!empty($res->cat_name_th)){
				$cat_name = $res->cat_name_th.' ('.$sumamount.')';
			}else{
				$cat_name = 'Not specified';
			}
			if($i==0){
				$data = array($cat_name,$sumamount,true,true);
			}else{
				$data = array($cat_name,$sumamount,false);
			}

			$arr_data[] = $data;
			$i++;
		}


		$output['categories'] = '';
		$output['txtdata'] = $arr_data;
		$output['subtitle'] = "ระหว่าง $mixeddate";
		$output['chartname'] = 'ยอดขาย จำแนกหมวดหมู่สินค้า';

		echo json_encode($output);
	}

	public function staticSalesproductbrand(){
		include "common/include/config.php";
		$requestData= $_REQUEST;
		$datestart = date("Y-m-d",strtotime($requestData['datestart']));
		$dateend = date("Y-m-d",strtotime($requestData['dateend']));
		$mixeddate = date("F d,Y",strtotime($datestart)).' ถึง '.date("F d,Y",strtotime($dateend));

		$sql = "select brand.brand_name,sum(od.order_totamount) as sumamount
		from kp_orders as od
		inner join kp_orders_detail as ord on od.order_id = ord.order_id
		inner join kp_products as pd on pd.prodid = ord.prodid
		inner join kp_products_brand as brand on brand.brand_id = pd.brand_id and brand.is_delete=0
		where od.order_status!='cancel' and od.order_date between '$datestart' and '$dateend'
		order by sumamount desc";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = 0;
		while ($res = $qr->fetch_object()) {
			$sumamount = (int)number_format($res->sumamount,2);
			if(!empty($res->brand_name)){
				$brand_name = $res->brand_name.' ('.$sumamount.')';
			}else{
				$brand_name = 'Not specified';
			}
			if($i==0){
				$data = array($brand_name,$sumamount,true,true);
			}else{
				$data = array($brand_name,$sumamount,false);
			}

			$arr_data[] = $data;
			$i++;
		}


		$output['categories'] = '';
		$output['txtdata'] = $arr_data;
		$output['subtitle'] = "ระหว่าง $mixeddate";
		$output['chartname'] = 'ยอดขาย จำแนกแบรนด์';

		echo json_encode($output);
	}


	public function staticSalesdaily(){
		include "common/include/config.php";
		$month = $_GET['month'];
		$thai_month_arr=array(
			"00"=>"",
			"01"=>"มกราคม",
			"02"=>"กุมภาพันธ์",
			"03"=>"มีนาคม",
			"04"=>"เมษายน",
			"05"=>"พฤษภาคม",
			"06"=>"มิถุนายน",
			"07"=>"กรกฎาคม",
			"08"=>"สิงหาคม",
			"09"=>"กันยายน",
			"10"=>"ตุลาคม",
			"11"=>"พฤศจิกายน",
			"12"=>"ธันวาคม"
		);

		$mixeddate = $thai_month_arr[substr($month,6,2)].' '.substr($month,0,4);

		$arr = array();
		$output = array();
		$arr_cat = array();
		$arr_data = array();
		$sql = "select order_date,sum(order_totamount) as totamount
		from kp_orders
		where order_status!='cancel' and substr(order_date,1,7) = '{$month}'
		group by order_date order by order_date asc";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = 0;
		while ($res = $qr->fetch_object()) {
			$order_date = date("d",strtotime($res->order_date));
			$sumamount = (int)$res->totamount;

			array_push($arr_cat,$order_date);
			array_push($arr_data,$sumamount);
			$i++;
		}


		$output['categories'] = $arr_cat;
		$output['txtdata'] = $arr_data;
		$output['subtitle'] = "ระหว่าง $mixeddate";
		$output['chartname'] = 'ยอดขาย จำแนกวัน';

		echo json_encode($output);
	}

	public function staticSalesmonth(){
		include "common/include/config.php";
		$year = $_GET['year'];
		$thai_month_arr=array(
			"00"=>"",
			"01"=>"มกราคม",
			"02"=>"กุมภาพันธ์",
			"03"=>"มีนาคม",
			"04"=>"เมษายน",
			"05"=>"พฤษภาคม",
			"06"=>"มิถุนายน",
			"07"=>"กรกฎาคม",
			"08"=>"สิงหาคม",
			"09"=>"กันยายน",
			"10"=>"ตุลาคม",
			"11"=>"พฤศจิกายน",
			"12"=>"ธันวาคม"
		);

		$mixeddate = 'ปี '.$year;

		$arr = array();
		$output = array();
		$arr_cat = array();
		$arr_data = array();
		$sql = "select order_date,sum(order_totamount) as totamount
		from kp_orders
		where order_status!='cancel' and substr(order_date,1,4) = '{$year}'
		group by order_date order by order_date asc";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = 0;
		while ($res = $qr->fetch_object()) {
			$order_date = $thai_month_arr[date("d",strtotime($res->order_date))];
			$sumamount = (int)$res->totamount;

			array_push($arr_cat,$order_date);
			array_push($arr_data,$sumamount);
			$i++;
		}


		$output['categories'] = $arr_cat;
		$output['txtdata'] = $arr_data;
		$output['subtitle'] = "ระหว่าง $mixeddate";
		$output['chartname'] = 'ยอดขาย จำแนกเดือน';

		echo json_encode($output);
	}

	public function staticSalestop10products(){
		include "common/include/config.php";
		$requestData= $_REQUEST;
		$datestart = date("Y-m-d",strtotime($requestData['datestart']));
		$dateend = date("Y-m-d",strtotime($requestData['dateend']));
		$mixeddate = date("F d,Y",strtotime($datestart)).' to '.date("F d,Y",strtotime($dateend));

		$arr = array();
		$output = array();
		$arr_cat = array();
		$arr_data = array();
		$sql = "select odd.prodid,pd.prodname_th,sum(od.order_totamount) as totamount
		from kp_orders as od
		inner join kp_orders_detail as odd on odd.order_id = od.order_id
		inner join kp_products as pd on pd.prodid = odd.prodid
		where od.order_status!='cancel' and od.order_date between '{$datestart}' and '{$dateend}'
		group by odd.prodid order by totamount desc limit 0,10 ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = 0;
		while ($res = $qr->fetch_object()) {
			$product_name = $res->prodname_th;
			$sumamount = (int)$res->totamount;

			array_push($arr_cat,$product_name);
			array_push($arr_data,$sumamount);
			$i++;
		}


		$output['categories'] = $arr_cat;
		$output['txtdata'] = $arr_data;
		$output['subtitle'] = "ระหว่าง $mixeddate";
		$output['chartname'] = '10 สินค้าที่ขายดีที่สุด';

		echo json_encode($output);
	}

	// ==============================================================//
	// ==============================================================//

	public function Monthofreport(){
		include "common/include/config.php";

		$thai_month_arr=array(
			"00"=>"",
			"01"=>"มกราคม",
			"02"=>"กุมภาพันธ์",
			"03"=>"มีนาคม",
			"04"=>"เมษายน",
			"05"=>"พฤษภาคม",
			"06"=>"มิถุนายน",
			"07"=>"กรกฎาคม",
			"08"=>"สิงหาคม",
			"09"=>"กันยายน",
			"10"=>"ตุลาคม",
			"11"=>"พฤศจิกายน",
			"12"=>"ธันวาคม"
		);

		$qr = $dbCon->query("SELECT DISTINCT MONTH(order_date) as mm,year(order_date) as yy FROM kp_orders where order_status!='cancel' ") or die($dbCon->error);
		while($res = $qr->fetch_object()){
			$yymm = $res->yy.'-'.sprintf("%02d",$res->mm);
			$mmyyname = $thai_month_arr[sprintf("%02d",$res->mm)].' '.$res->yy;
			$data['id'] = $yymm;
			$data['name'] = $mmyyname;
			$arr['datarow'][] = $data;
		}
		echo json_encode($arr);
	}

	public function Yearofreport(){
		include "common/include/config.php";

		$qr = $dbCon->query("SELECT DISTINCT year(order_date) as yy FROM kp_orders where order_status!='cancel' ") or die($dbCon->error);
		while($res = $qr->fetch_object()){
			$yy = $res->yy;
			$yyname = "ปี ".$yy;
			$data['id'] = $yy;
			$data['name'] = $yyname;
			$arr['datarow'][] = $data;
		}

		echo json_encode($arr);
	}



	public function progressWD($num){
		if($num>=96 and $num<=100){
			return 100;
		}elseif($num>=91 and $num<=95){
			return 95;
		}elseif($num>=86 and $num<=90){
			return 90;
		}elseif($num>=81 and $num<=85){
			return 85;
		}elseif($num>=76 and $num<=80){
			return 80;
		}elseif($num>=71 and $num<=75){
			return 75;
		}elseif($num>=66 and $num<=70){
			return 70;
		}elseif($num>=61 and $num<=65){
			return 65;
		}elseif($num>=56 and $num<=60){
			return 60;
		}elseif($num>=51 and $num<=55){
			return 55;
		}elseif($num>=46 and $num<=50){
			return 50;
		}elseif($num>=41 and $num<=45){
			return 45;
		}elseif($num>=36 and $num<=40){
			return 40;
		}elseif($num>=31 and $num<=35){
			return 35;
		}elseif($num>=26 and $num<=30){
			return 30;
		}elseif($num>=21 and $num<=25){
			return 25;
		}elseif($num>=16 and $num<=20){
			return 20;
		}elseif($num>=11 and $num<=15){
			return 15;
		}elseif($num>=6 and $num<=10){
			return 10;
		}elseif($num>=1 and $num<=5){
			return 5;
		}else{
			return 0;
		}
	}


	public function date_diff($str_start,$str_end)
	{
		$str_start = strtotime($str_start); // ทำวันที่ให้อยู่ในรูปแบบ timestamp
		$str_end = strtotime($str_end); // ทำวันที่ให้อยู่ในรูปแบบ timestamp

		$nseconds = $str_start - $str_end; // วันที่ระหว่างเริ่มและสิ้นสุดมาลบกัน
		$ndays = $nseconds / 86400; // หนึ่งวันมี 86400 วินาที


		return $ndays;
	}

}
