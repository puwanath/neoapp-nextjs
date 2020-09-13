<?php
$param = "log";
require "models/$param.php";


class logController extends Controllers
{
	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "Log Transactions";
		$param = "log";
		$classpage = "collapsed-menu with-subleft";
		$model = new logController;

		// date formater
		$date = new DateTime('now');
		$date->modify('first day of this month');
		$startdate = $date->format('Y-m-d');
		$date->modify('last day of this month');
		$enddate = $date->format('Y-m-d');

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->loadData();
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


		// begin css and js
		$cssarr = array(
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>",
			"<link href='".$dir."daterangepicker-master/daterangepicker.css' rel='stylesheet'>",
		);

		$jsarr = array(
			"<script src='".$dir."daterangepicker-master/moment.min.js'></script>",
			"<script src='".$dir."daterangepicker-master/daterangepicker.js'></script>",
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
		include "common/include/config.php";
		$requestData= $_REQUEST;
		$logdatestart = date("Y-m-d",strtotime($requestData['logdatestart']));
		$logdateend = date("Y-m-d",strtotime($requestData['logdateend']));

		$page = $requestData["page"];
		$limit = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;
		$totalrows = isset($requestData["totalrows"]) ? $requestData["totalrows"]: false;
		if($totalrows) {
		    $limit = $totalrows;
		}

		$sql = "select * from kp_log where substr(log_time,1,10) between '$logdatestart' and '$logdateend' ";
		if( !empty($requestData['user']) ){
			$sql.= "and log_user_id = '".$requestData['user']."' ";
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

		$sql = "select * from kp_log where substr(log_time,1,10) between '$logdatestart' and '$logdateend' ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( lower(log_os) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR lower(log_browser) LIKE lower('%".$requestData['search']."%')";
			$sql.= "OR log_desc LIKE '%".$requestData['search']."%' ";
			$sql.= "OR log_ip LIKE '%".$requestData['search']."%' ";
			$sql.= "OR log_user_id IN (select user_id from kp_users where user_fullname like '%".$requestData['search']."%' ) ) ";
		}
		if( !empty($requestData['user']) ){
			$sql.= "AND log_user_id = '".$requestData['user']."' ";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$id = $res->log_id;
			$log_time = date_create($res->log_time);
			$log_time = date_format($log_time,"d/m/Y H:m:i");
			$log_user = $this->getNameuser($res->log_user_id);
			$log_desc = $res->log_desc;
			$log_browser = $res->log_browser;
			$log_os = $res->log_os;
			$log_ip = $res->log_ip;

			$row = array();
			$row[id] = $id;
			$row[log_time] = $log_time;
			$row[log_user] = $log_user;
			$row[log_desc] = $log_desc;
			$row[log_browser] = $log_browser;
			$row[log_os] = $log_os;
			$row[log_ip] = $log_ip;
			array_push($arr,$row);
		}
		$output = array();
		$output[records] = $count;
		$output[page] = $page;
		$output[total] = ceil($count/$limit);
		$output[rows] = $arr;

		echo json_encode($output);
	}

	public function readData()
	{
		$url = curPageURL();
		$id = $_REQUEST['id'];
		$loguser = $_REQUEST['user'];
		$requestData= $_REQUEST;
		$logdate = date("Y-m-d",strtotime($_REQUEST['logdate']));
		$data = array();

		$columns = array(
		    0 => 'log_time',
		    1 => 'log_user_id',
		    2 => 'log_desc',
		    3 => 'log_browser',
		    4 => 'log_os',
		    5 => 'log_ip',
		);


		$sql = "select * ";
		$sql.= "from kp_log";
		$qr = $this->queryData($sql);
		$totalData = $qr->num_rows;
		$totalFiltered = $totalData;

		$sql = "select * ";
		$sql.= "from kp_log where 1=1";
		if( !empty($requestData['search']['value']) ) {
			$sql.= " and (log_time LIKE '%".$requestData['search']['value']."%' ";
			$sql.= "or log_user_id LIKE '%".$requestData['search']['value']."%' ";
			$sql.= "or log_desc LIKE '%".$requestData['search']['value']."%' ";
			$sql.= "or log_browser LIKE '%".$requestData['search']['value']."%' ";
			$sql.= "or log_os LIKE '%".$requestData['search']['value']."%' ";
			$sql.= "or log_ip LIKE '%".$requestData['search']['value']."%') ";
		}

		if(!empty($loguser) and !empty($logdate)){
			$sql.= " and substr(log_time,1,10) = '".$logdate."' and log_user_id = '".$loguser."' ";
		}elseif(!empty($loguser) and empty($logdate)){
			$sql.= " and log_user_id = '".$loguser."' ";
		}elseif(empty($loguser) and !empty($logdate)){
		  $sql.= " and substr(log_time,1,10) = '".$logdate."' ";
		}else{
			$sql.= " and substr(log_time,1,10) = '".date("Y-m-d")."' ";
		}

		$qr = $this->queryData($sql);
		$totalFiltered = $qr->num_rows;
		$sql.= "order by ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']." ";
		$qr = $this->queryData($sql);

		//echo $sql;


		while($res = $qr->fetch_object()){

			$qruser = $this->fetchdata("kp_users","where user_id = '".$res->log_user_id."' ");
			$reuser = $qruser->fetch_object();

			$time = date_create($res->log_time);
			$logtime = date_format($time,"d/m/Y H:m:i");

			$rows = array();
			$i++;
			$rows[] = $logtime;
			$rows[] = $reuser->user_fullname.' '.$reuser->user_lastname;
			$rows[] = $res->log_desc;
			$rows[] = $res->log_browser;
			$rows[] = $res->log_os;
			$rows[] = $res->log_ip;


			$data[] = $rows;
		}


		$json_data = array(
			"draw" => intval( $requestData['draw'] ),
			"recordsTotal" => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data" => $data   // total data array
		);

		echo json_encode($json_data);  // send data as json format

	}

	public function getNameuser($id){
		$qruser = $this->fetchdata("kp_users","where user_id = '".$id."' ");
		$reuser = $qruser->fetch_object();

		return $reuser->user_fullname;
	}


	public function getarrUser(){
		$arr = array();
		$qr = $this->fetchdata("kp_users","where status = 1 order by user_fullname asc");
		while($res = $qr->fetch_object()){

			$countLog = $this->countLog($res->user_id);
			if($countLog>0):
				$data = "<a class=\"nav-link nav-user\" href=\"javascript:void(0)\" data-id=\"$res->user_id\"><i class=\"icon ion-person-stalker tx-16-force\"></i> $res->user_fullname</a>";
				array_push($arr,$data);
			endif;
		}

		return implode('',$arr);
	}


}
