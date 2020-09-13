<?php
$param = "home";
require "models/$param.php";
class homeController extends Controllers
{
	//begin function index start page
	public function index(){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "Dashboard";
		$pagedesc = "แดชบอร์ดการเข้าใช้เว็บไซต์";
		$param = "home";
		$classpage = "collapsed-menu with-subleft";
		$model = new homeController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loadstatic' :
				 $model->staticData();
				 break;

			case 'loadchart_of_device' :
				 $model->staticChartofDevice();
				 break;

			case 'loadchart_of_browser' :
				 $model->staticChartofBrowser();
				 break;

			case 'selectmonth' :
 				 $model->Monthofreport();
 				 break;

			case 'loadchart_by_daily' :
				 $model->staticChartbydaily();
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
		$requestData= $_REQUEST;
		$datestart = date("Y-m-d",strtotime($requestData['datestart']));
		$dateend = date("Y-m-d",strtotime($requestData['dateend']));

		$mixeddate = date("M d,Y",strtotime($datestart)).'-'.date("M d,Y",strtotime($dateend));
		$output['selectdate'] = $mixeddate;
		// counting visit distince log_ip
		$sqlcountip = "select count(DISTINCT log_ip) as countrow
		from kp_static_logs where SUBSTR(log_time,1,10) between '{$datestart}' and '{$dateend}' ";
		$qrcountip = $dbCon->query($sqlcountip) or die($dbCon->error);
		$rescountip = $qrcountip->fetch_assoc();
		$output['visitors'] = (int)$rescountip['countrow'];

		// counting visit sessions
		$sqlcountsession = "select count(*) as countrow
		from kp_static_logs where SUBSTR(log_time,1,10) between '{$datestart}' and '{$dateend}' ";
		$qrcountsession = $dbCon->query($sqlcountsession) or die($dbCon->error);
		$rescountsession = $qrcountsession->fetch_assoc();
		$output['sessions'] = (int)$rescountsession['countrow'];

		// counting visit distince log_ip this week
		$d = strtotime("today");
		$start_week = strtotime("last sunday midnight",$d);
		$end_week = strtotime("next saturday",$d);
		$start_sun = date("Y-m-d",$start_week);
		$end_sat = date("Y-m-d",$end_week);
		$sqlcountip_w = "select count(DISTINCT log_ip) as countrow
		from kp_static_logs where SUBSTR(log_time,1,10) between '{$start_sun}' and '{$end_sat}' ";
		$qrcountip_w = $dbCon->query($sqlcountip_w) or die($dbCon->error);
		$rescountip_w = $qrcountip_w->fetch_assoc();
		$start_week = date("M d,Y",$start_week);
		$end_week = date("M d,Y",$end_week);
		$output['showdate_week'] = $start_week.'-'.$end_week;
		$output['visitor_this_week'] = (int)$rescountip_w['countrow'];

		// counting visit distince log_ip this month
		$thismonth = date("Y-m");
		$sqlcountip_m = "select count(DISTINCT log_ip) as countrow
		from kp_static_logs where SUBSTR(log_time,1,7) = '$thismonth' ";
		$qrcountip_m = $dbCon->query($sqlcountip_m) or die($dbCon->error);
		$rescountip_m = $qrcountip_m->fetch_assoc();
		$output['showdate_month'] = date("F Y");
		$output['visitor_this_month'] = (int)$rescountip_m['countrow'];


		echo json_encode($output);
	}


	public function staticChartofDevice(){
		include "common/include/config.php";
		$requestData= $_REQUEST;
		$datestart = date("Y-m-d",strtotime($requestData['datestart']));
		$dateend = date("Y-m-d",strtotime($requestData['dateend']));
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

		$mixeddate = date("d",strtotime($datestart)).' '.$thai_month_arr[date("m",strtotime($datestart))].' '.date("Y",strtotime($datestart)).' ถึง '.date("d",strtotime($dateend)).' '.$thai_month_arr[date("m",strtotime($dateend))].' '.date("Y",strtotime($dateend));
		$output['selectdate'] = $mixeddate;

		$sql = "select log_device,count(DISTINCT log_ip) as countrow
		from kp_static_logs where SUBSTR(log_time,1,10) between '{$datestart}' and '{$dateend}'
		group by log_device order by countrow desc ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res = $qr->fetch_assoc()){
			$device_name = $res['log_device'];
			$device_count = (int)$res['countrow'];
			$data = array($device_name,$device_count,false);
			$arr_data[] = $data;
		}

		$output['categories'] = '';
		$output['txtdata'] = $arr_data;
		$output['subtitle'] = "ระหว่าง $mixeddate";
		$output['chartname'] = 'เปอร์เซ็นผู้เข้าชม/จำแนกตามอุปกรณ์';

		echo json_encode($output);
	}

	public function staticChartofBrowser(){
		include "common/include/config.php";
		$requestData= $_REQUEST;
		$datestart = date("Y-m-d",strtotime($requestData['datestart']));
		$dateend = date("Y-m-d",strtotime($requestData['dateend']));

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

		$mixeddate = date("d",strtotime($datestart)).' '.$thai_month_arr[date("m",strtotime($datestart))].' '.date("Y",strtotime($datestart)).' ถึง '.date("d",strtotime($dateend)).' '.$thai_month_arr[date("m",strtotime($dateend))].' '.date("Y",strtotime($dateend));
		$output['selectdate'] = $mixeddate;

		$sql = "select log_browser,count(DISTINCT log_ip) as countrow
		from kp_static_logs where SUBSTR(log_time,1,10) between '{$datestart}' and '{$dateend}'
		group by log_browser order by countrow desc ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res = $qr->fetch_assoc()){
			$browser_name = $res['log_browser'];
			$browser_count = (int)$res['countrow'];
			$data = array($browser_name,$browser_count,false);
			$arr_data[] = $data;
		}

		$output['categories'] = '';
		$output['txtdata'] = $arr_data;
		$output['subtitle'] = "ระหว่าง $mixeddate";
		$output['chartname'] = 'เปอร์เซ็นผู้เข้าชม/จำแนกตามบราวเซอร์';

		echo json_encode($output);
	}


	public function staticChartbydaily(){
		include "common/include/config.php";
		$requestData= $_REQUEST;
		$datestart = date("Y-m-d",strtotime($requestData['datestart']));
		$dateend = date("Y-m-d",strtotime($requestData['dateend']));
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

		$mixeddate = date("d",strtotime($datestart)).' '.$thai_month_arr[date("m",strtotime($datestart))].' '.date("Y",strtotime($datestart)).' ถึง '.date("d",strtotime($dateend)).' '.$thai_month_arr[date("m",strtotime($dateend))].' '.date("Y",strtotime($dateend));

		$arr = array();
		$output = array();
		$sql = "SELECT SUBSTR(log_time,1,10) as logday,log_ip,
		count(DISTINCT log_ip) AS countip,
		count(*) AS countview
		FROM kp_static_logs WHERE SUBSTR(log_time,1,10) BETWEEN '{$datestart}' AND '{$dateend}'
		GROUP BY logday
		ORDER BY logday ASC ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$i = 0;
		while ($res = $qr->fetch_object()) {
			$dayname = date("d/m/Y",strtotime($res->logday));
			$countip = (int)$res->countip;
			$countview = (int)$res->countview;

			$arr_cat[] = $dayname;
			$arr_data[] = $countip;
			$arr_dataval[] = $countview;
			$i++;
		}


		$output['categories'] = $arr_cat;
		$output['txtdata'] = $arr_data;
		$output['txtdataval'] = $arr_dataval;
		$output['subtitle'] = "จำนวนผู้เข้าชม ระหว่าง ".$mixeddate;
		$output['chartname'] = 'จำนวนการเข้าชม จำแนกวัน';

		echo json_encode($output);
	}


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

		$qr = $dbCon->query("SELECT DISTINCT MONTH(log_time) as mm,year(log_time) as yy FROM kp_static_logs ") or die($dbCon->error);
		while($res = $qr->fetch_object()){
			$yymm = $res->yy.'-'.sprintf("%02d",$res->mm);
			$mmyyname = $thai_month_arr[sprintf("%02d",$res->mm)].' '.$res->yy;
			$data['id'] = $yymm;
			$data['name'] = $mmyyname;
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
