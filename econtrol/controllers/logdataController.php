<?php
$param = "logdata";
require "models/$param.php";


class logdataController extends Controllers
{
	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "Vhost Log";
		$param = "logdata";
		$classpage = "collapsed-menu with-subleft";
		$model = new logdataController;

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
		$logdatadatestart = date("Y-m-d",strtotime($requestData['logdatestart']));
		$logdatadateend = date("Y-m-d",strtotime($requestData['logdateend']));

		$sql = "select * from trn_accesslog where access_date between '$logdatadatestart' and '$logdatadateend' ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$num = $qr->num_rows;
		$totalFiltered = $num;

		$sql = "select * from trn_accesslog where access_date between '$logdatadatestart' and '$logdatadateend' ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( lower(domain) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR lower(url) LIKE lower('%".$requestData['search']."%') ";
			$sql.= "OR lower(agent) LIKE '%".$requestData['search']."%' ";
			$sql.= "OR remote_ipaddr LIKE '%".$requestData['search']."%' ) ";
		}
		if( !empty($requestData['domain']) ) {
			$sql.= "AND lower(domain) LIKE lower('%".$requestData['domain']."%') ";
		}

		if( !empty($requestData['sidx']) ) {
			$sql.= "order by ".$requestData['sidx']." ".$requestData['sord']." ";
		}
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$logdata_date = date("d/m/Y",$res->access_date);
			$logdata_time = date_create($res->accress_time);
			$logdata_time = date_format($logdata_time,"d/m/Y H:m:i");
			$logdata_domain = $res->domain;
			$logdata_ip = $res->remote_ipaddr;
			$logdata_tx = $res->tx_bytes;
			$logdata_rx = $res->rx_bytes;
			$logdata_url = $res->url;

			$row = array();
			$row[logdata_time] = $logdata_time;
			$row[logdata_domain] = $logdata_domain;
			$row[logdata_ip] = $logdata_ip;
			$row[logdata_tx] = $logdata_tx;
			$row[logdata_rx] = $logdata_rx;
			$row[logdata_url] = $logdata_url;
			array_push($arr,$row);
		}
		$output = array();
		$output[records] = $totalFiltered;
		$output[page] = $requestData['page'];
		$output[total] = ceil($totalFiltered/$requestData['rows']);
		$output[rows] = $arr;

		echo json_encode($output);
	}

	public function getNameuser($id){
		$qruser = $this->fetchdata("kp_users","where user_id = '".$id."' ");
		$reuser = $qruser->fetch_object();

		return $reuser->user_fullname;
	}


	public function getarrDomain(){
		include "common/include/config.php";
		$arr = array();
		$qr = $dbCon->query("select DISTINCT domain from trn_accesslog") or die($dbCon->error) ;
		while($res = $qr->fetch_object()){

			$countlog = $this->countLog($res->domain);
			if($countlog>0):
				$data = "<a class=\"nav-link\" href=\"javascript:void(0)\" data-id=\"$res->domain\"><i class=\"icon ion-coffee tx-16-force\"></i> $res->domain</a>";
				array_push($arr,$data);
			endif;
		}

		return implode('',$arr);
	}


}
