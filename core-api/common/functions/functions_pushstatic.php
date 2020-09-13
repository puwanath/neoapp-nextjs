<?php
//บันทึก static
function putstatic()
{
	require '../econtrol/common/include/config.php';

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $date = date('Y-m-d');
    $month = date('m');
    $year = date('Y');

    $insert_ip = $dbCon->query("INSERT kp_static_ip(date,ip) values('$date', '$ip')");


    $ckrating = $dbCon->query("SELECT date,crating FROM kp_static_rate WHERE date = '$date'");
    $num = $ckrating->num_rows;
    $rerating = $ckrating->fetch_assoc();

		savelog();
    //print $rerating[crating];

    if($num>0){

        $posi = $rerating['crating']+1;
        $update_rate = $dbCon->query("UPDATE kp_static_rate SET crating = '$posi' WHERE date = '$date'");
    }else{
        $posi = 1;
        $insert_rate = $dbCon->query("INSERT kp_static_rate(date,month,crating) VALUES('$date', '$month', '$posi')");
    }


}


function detectDevice(){
	$userAgent = $_SERVER["HTTP_USER_AGENT"];
	$devicesTypes = array(
      "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
      "tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
      "mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
      "bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
  );
		foreach($devicesTypes as $deviceType => $devices) {
      foreach($devices as $device) {
          if(preg_match("/" . $device . "/i", $userAgent)) {
              $deviceName = $deviceType;
          }
      }
  }
  return ucfirst($deviceName);
}


$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getOS() {

    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }

    return $os_platform;

}

function getBrowser() {

    global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}

function savelog()
{
  include('../econtrol/common/include/config.php');

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$iplog = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$iplog = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$iplog = $_SERVER['REMOTE_ADDR'];
	}

	$os        =   getOS();
	$browser   =   getBrowser();
	$device   =   detectDevice();
	$pagelog = $_SERVER["REQUEST_URI"];

	if(!empty($iplog)){
		$savelog = "INSERT INTO kp_static_logs(
								log_ip,
								log_os,
								log_browser,
								log_device,
								log_desc
								)
								values(
								'$iplog',
								'$os',
								'$browser',
								'$device',
								'$pagelog'
								)";
		$dbCon->query($savelog);
	}


}


function putrating($tb,$whereid,$id)
{
	require '../econtrol/common/include/config.php';
	$ck = "select rating from $tb where $whereid = '$id' ";
	$qck = $dbCon->query($ck);
	$reck = $qck->fetch_object();

	$num = $reck->rating+1;

	$update = "update $tb set kp_rating = '$num' where $whereid = '$id'";
	$dbCon->query($update);

}



?>
