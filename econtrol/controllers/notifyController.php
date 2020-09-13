<?php
$param = "notify";
require "models/$param.php";


class notifyController extends Controllers
{

	//begin function index start page
	public function index(){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "Notify";
		$pagedesc = "";
		$param = "notify";
		$model = new notifyController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loadnotify' :
				 $model->loadNotify();
				 break;

			case 'loaduseronline' :
				 $model->loadUseronline();
				 break;

			case 'loaduseroffline' :
				 $model->loadUseroffline();
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


		if($select==''){
			$content = "views/$param/index.php";
			$page = include("views/layout/template.php");
			return $page;
		}


	}
	//end function page

	// function Notify
	public function loadNotify(){
		$url = curPageURL();
		$arr = array();
		$datenow = date("Y-m-d");
		$qr = $this->fetchdata("kp_log","where substr(log_time,1,10) = '$datenow' order by log_time desc limit 0,5");
		while($res = $qr->fetch_object()){

			$log_user_name = $this->getCreator('name',$res->log_user_id);
			$log_user_img = $this->getCreator('img',$res->log_user_id);
			$log_desc = $res->log_desc;
			$log_time = date("d/m/Y H:i:s",strtotime($res->log_time));

			$data = "<a href=\"\" class=\"media-list-link read\">
				<div class=\"media pd-x-20 pd-y-15\">
					<img src=\"$log_user_img\" class=\"wd-40 ht-40 rounded-circle\" alt=\"\">
					<div class=\"media-body\">
						<p class=\"tx-13 mg-b-0 tx-gray-700\"><strong class=\"tx-medium tx-gray-800\">$log_user_name</strong> $log_desc</p>
						<span class=\"tx-12\">$log_time</span>
					</div>
				</div>
			</a>";
			array_push($arr,$data);
		}

		$output = implode('',$arr);
		$output.= "<div class=\"pd-y-10 tx-center bd-t\">
			<a href=\"$url/setting/logtransection\" class=\"tx-12\"><i class=\"fa fa-angle-down mg-r-5\"></i> Show All Notifications </a>
		</div>";

		echo json_encode($output);
	}


	public function loadUseronline(){
		$arr = array();
		$qr = $this->fetchdata("kp_user_online","order by time_stamp desc");
		while($res = $qr->fetch_object()){

			$user_name = $this->getCreator('name',$res->user_id);
			$user_img = $this->getCreator('img',$res->user_id);
			$user_level = $this->getCreator('level_id',$res->user_id);
			$level_name = $this->getLevel($user_level);
			$user_last_login = $this->getCreator('user_last_login',$res->user_id);
			$timediff = $this->generate_date_today("d M Y H:i", $user_last_login, "th", true);

			$data = "<a href=\"\" class=\"contact-list-link new\">
				<div class=\"d-flex\">
					<div class=\"pos-relative\">
						<img src=\"$user_img\" class=\"wd-40 ht-40 rounded-circle\" alt=\"\">
						<div class=\"contact-status-indicator bg-success\"></div>
					</div>
					<div class=\"contact-person\">
						<p class=\"mg-b-0\">$user_name</p>
						<span class=\"tx-info tx-12\"><span class=\"square-8 bg-info rounded-circle\"></span> $timediff</span>
					</div>

				</div>
			</a>";
			array_push($arr,$data);
		}

		$output = implode('',$arr);

		echo json_encode($output);
	}

	public function loadUseroffline(){
		$arr = array();
		$qr = $this->fetchdata("kp_users","where user_id NOT IN (select user_id from kp_user_online) order by user_last_login desc");
		while($res = $qr->fetch_object()){

			$user_name = $this->getCreator('name',$res->user_id);
			$user_img = $this->getCreator('img',$res->user_id);
			$user_level = $this->getCreator('level_id',$res->user_id);
			$level_name = $this->getLevel($user_level);
			$user_last_login = $this->getCreator('user_last_login',$res->user_id);
			$timediff = $this->generate_date_today("d M Y H:i", $user_last_login, "th", true);

			$data = "<a href=\"\" class=\"contact-list-link new\">
				<div class=\"d-flex\">
					<div class=\"pos-relative\">
						<img src=\"$user_img\" class=\"wd-40 ht-40 rounded-circle\" alt=\"\">
						<div class=\"contact-status-indicator bg-gray-500\"></div>
					</div>
					<div class=\"contact-person\">
						<p class=\"mg-b-0\">$user_name</p>
						<span class=\"tx-info tx-12\"> $timediff</span>
					</div>
				</div>
			</a>";
			array_push($arr,$data);
		}

		$output = implode('',$arr);

		echo json_encode($output);
	}


	public function getCreator($fillname=null,$id=null){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_users","where user_id ='$id' ");
		$res = $qr->fetch_object();


		if($fillname=="img"){
			if(file_exists("images/user/$res->user_avatar")){
				// $img = "<img src='images/user/$res->user_avatar' width='25' height='25' class='img-circle' /> ";
				$img = $url.'/images/user/'.$res->user_avatar;
			}else{
				// $img = "<img src='images/device/avatar.png' width='25' height='25' class='img-circle' /> ";
				$img = $url."/images/avatar.jpg";
			}
			return $img;
		}elseif($fillname=="name"){
			return $res->user_fullname.' '.$res->user_lastname;
		}else{
			return $res->$fillname;
		}

	}

	public function getLevel($id){
		$qr = $this->fetchdata("kp_user_level","where level_id = '$id' ");
		$res = $qr->fetch_object();

		return $res->level_name;
	}


	// =========  CALULATE TIME  ===============//


	/* =Function
-------------------------------------------------------------- */
public function generate_date_today($Format, $Timestamp, $Language = "en", $TimeText = true )
{
	global $SuffixTime, $DateThai;
	/* =Time&Date Config
	-------------------------------------------------------------- */
	$SuffixTime = array(
		"th"=>array(
			"time"=>array(
				"Seconds"			=>		" วินาทีที่แล้ว",
				"Minutes"				=>		" นาทีที่แล้ว",
				"Hours"					=>		" ชั่วโมงที่แล้ว"
			),
			"day"=>array(
				"Yesterday"		=>		"เมื่อวาน เวลา ",
				"Monday"				=>		"วันจันทร์ เวลา ",
				"Tuesday"			=>		"วันอังคาร เวลา ",
				"Wednesday"	=>		"วันพุธ เวลา ",
				"Thursday"			=>		"วันพฤหัสบดี เวลา ",
				"Friday"				=>		"วันศุกร์ เวลา ",
				"Saturday"			=>		" วันวันเสาร์ เวลา ",
				"Sunday"				=>		"วันอาทิตย์ เวลา ",
			)
		),
		"en"=>array(
			"time"=>array(
				"Seconds"				=>		" seconds ago",
				"Minutes"				=>		" minutes ago",
				"Hours"					=>		" hours ago"
			),
			"day"=>array(
				"Yesterday"		=>		"Yesterday at ",
				"Monday"				=>		"Monday at ",
				"Tuesday"			=>		"Tuesday at ",
				"Wednesday"	=>		"Wednesday at ",
				"Thursday"			=>		"Thursday at ",
				"Friday"				=>		"Friday at ",
				"Saturday"			=>		"Saturday at ",
				"Sunday"				=>		"Sunday at ",
			)
		)
	);

	$DateThai = array(
		// Day
		"l" => array(	// Full day
			"Monday"				=>		"วันจันทร์",
			"Tuesday"			=>		"วันอังคาร",
			"Wednesday"	=>		"วันพุธ",
			"Thursday"			=>		"วันพฤหัสบดี",
			"Friday"				=>		"วันศุกร์",
			"Saturday"			=>		"วันวันเสาร์",
			"Sunday"				=>		"วันอาทิตย์",
		),
		"D" => array(	// Abbreviated day
			"Monday"				=>		"จันทร์",
			"Tuesday"			=>		"อังคาร",
			"Wednesday"	=>		"พุธ",
			"Thursday"			=>		"พฤหัส",
			"Friday"				=>		"ศุกร์",
			"Saturday"			=>		"วันเสาร์",
			"Sunday"				=>		"อาทิตย์",
		),

		// Month
		"F" => array(	// Full month
			"January"				=>		"มกราคม",
			"February"			=>		"กุมภาพันธ์",
			"March"					=>		"มีนาคม",
			"April"					=>		"เมษายน",
			"May"					=>		"พฤษภาคม",
			"June"					=>		"มิถุนายน",
			"July"						=>		"กรกฎาคม",
			"August"				=>		"สิงหาคม",
			"September"		=>		"กันยายน",
			"October"				=>		"ตุลาคม",
			"November"		=>		"พฤศจิกายน",
			"December"		=>		"ธันวาคม"
		),
		"M" => array(	// Abbreviated month
			"January"				=>		"ม.ค.",
			"February"			=>		"ก.พ.",
			"March"					=>		"มี.ค.",
			"April"					=>		"เม.ย.",
			"May"					=>		"พ.ค.",
			"June"					=>		"มิ.ย.",
			"July"						=>		"ก.ค.",
			"August"				=>		"ส.ค.",
			"September"		=>		"ก.ย.",
			"October"				=>		"ต.ค.",
			"November"		=>		"พ.ย.",
			"December"		=>		"ธ.ค."
		)
	);
	/* =Time&Date Config
	-------------------------------------------------------------- */




	//return date("i:H d-m-Y", $Timestamp) ." | ". date("i:H d-m-Y", time());
	if( date("Ymd", $Timestamp) >= date("Ymd", (time()-345600)) && $TimeText)				// Less than 3 days.
	{
		$TimeStampAgo = (time()-$Timestamp);

		if(($TimeStampAgo < 86400))			// Less than 1 day.
		{

			$TimeDay = "time";				// Use array time

			if($TimeStampAgo < 60)				// Less than 1 minute.
			{
				$Return = (time() - $Timestamp);
				$Values = "Seconds";
			}
			else if($TimeStampAgo < 3600)			// Less than 1 hour.
			{
				$Return = floor( (time() - $Timestamp)/60 );
				$Values = "Minutes";
			}
			else			// Less than 1 day.
			{
				$Return = floor( (time() - $Timestamp)/3600 );
				$Values = "Hours";
			}

		}
		else if($TimeStampAgo < 172800)			// Less than 2 day.
		{
			$Return = date("H:i", $Timestamp);
			$TimeDay = "day";
			$Values = "Yesterday";
		}
		else		// More than 2 hours..
		{
			$Return = date("H:i", $Timestamp);
			$TimeDay = "day";
			$Values = date("l", $Timestamp);
		}

		if($TimeDay == "time")
			$Return .= $SuffixTime[$Language][$TimeDay][$Values];
		else if($TimeDay == "day")
			$Return = $SuffixTime[$Language][$TimeDay][$Values] . $Return;

		return $Return;
	}
	else
	{
		if($Language == "en")
		{
			return date($Format, $Timestamp);
		}
		else if($Language == "th")
		{
			$Format = str_replace("l", "|1|", $Format);
			$Format = str_replace("D", "|2|", $Format);
			$Format = str_replace("F", "|3|", $Format);
			$Format = str_replace("M", "|4|", $Format);
			$Format = str_replace("y", "|x|", $Format);
			$Format = str_replace("Y", "|X|", $Format);

			$DateCache = date($Format, $Timestamp);

			$AR1 = array ("", "l", "D", "F", "M");
			$AR2 = array ("", "l", "l", "F", "F");

			for($i=1; $i<=4; $i++)
			{
				if(strstr($DateCache, "|". $i ."|"))
				{
					//$Return .= $i;

					$split = explode("|". $i ."|", $DateCache);
					for($j=0; $j<count($split)-1; $j++)
					{
						$StrCache .= $split[$j];
						$StrCache .= $DateThai[$AR1[$i]][date($AR2[$i], $Timestamp)];
					}
					$StrCache .= $split[count($split)-1];
					$DateCache = $StrCache;
					$StrCache = "";
					empty($split);
				}
			}

			if(strstr($DateCache, "|x|"))
				{

					$split = explode("|x|", $DateCache);

					for($i=0; $i<count($split)-1; $i++)
					{
						$StrCache .= $split[$i];
						$StrCache .= substr((date("Y", $Timestamp)+543), -2);
					}
					$StrCache .= $split[count($split)-1];
					$DateCache = $StrCache;
					$StrCache = "";
					empty($split);
				}

			if(strstr($DateCache, "|X|"))
				{

					$split = explode("|X|", $DateCache);

					for($i=0; $i<count($split)-1; $i++)
					{
						$StrCache .= $split[$i];
						$StrCache .= (date("Y", $Timestamp)+543);
					}
					$StrCache .= $split[count($split)-1];
					$DateCache = $StrCache;
					$StrCache = "";
					empty($split);
				}

				$Return = $DateCache;

			return $Return;
		}
	}
}
/* =Function
-------------------------------------------------------------- */





















	public function diff2time($time_a,$time_b){
    $now_time1=strtotime(date($time_a));
    $now_time2=strtotime(date($time_b));
    $time_diff=abs($now_time2-$now_time1);
    $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน
    return $time_diff_h." ชั่วโมง ".$time_diff_m." นาที ".$time_diff_s." วินาที";
	}


}
