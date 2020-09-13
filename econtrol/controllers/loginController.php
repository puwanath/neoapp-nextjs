<?php
$param = "login";
require "models/$param.php";


class loginController extends Controllers
{

	//begin function index start page
	public function index(){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "Dashboard";
		$param = "login";
		$model = new loginController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'login' :
				 $model->uLogin();
				 break;

			case 'forgetpassword' :
				 $model->uForget();
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


		if($select==''){
			$content = "views/$param/index.php";
			$page = include("views/layout/template.php");
			return $page;
		}


	}
	//end function page


	public function uLogin()
	{
		require "common/include/config.php";
		$userName = $_POST['txtUserName'];
		$password = $_POST['txtPassword'];
		$mdpass = md5($password);

		// first, make sure the username & password are not empty
		if ($userName == '') {
			$errorMessage = 'กรุณาใส่ชื่อผู้ใช้งานระบบด้วยครับ!';
		} else if ($password == '') {
			$errorMessage = 'กรูณากรอกรหัสผ่านด้วยครับ!';
		} else {
			// check the database and see if the username and password combo do match

			$sql = "SELECT user_id,user_name
					FROM kp_users
					WHERE user_name = '$userName' AND user_password = '$mdpass' and status = '1' ";
			$result = $dbCon->query($sql) or die($dbCon->error);
			if($result->num_rows == 1){
				$row = $result->fetch_assoc();
				$_SESSION['user_id'][$privatesession] = $row['user_id'];

				// log the time when the user last login
				$lastlogin = strtotime(date("Y-m-d H:i:s"));
				$sql = $dbCon->query("UPDATE kp_users
				        SET user_last_login = '$lastlogin'
						WHERE user_id = '{$row['user_id']}'");

				//start function save log transection
				$username =  $row['user_name'];
				$desclog = "เข้าสู่ระบบ ด้วย Username $username";
				savelog($_SESSION['user_id'][$privatesession],$desclog);
				//end function save log transection


				// now that the user is verified we move on to the next page
	            // if the user had been in the admin pages before we move to
				// the last page visited
				if (isset($_SESSION['login_return_url'])) {
					$loginsuccess = 0;
					//header('Location: ' . $_SESSION['login_return_url']);
					//exit;
				} else {
					$_SESSION['user_id'][$privatesession];
					$loginsuccess = 1;
					//header('Location: welcome');
					//exit;
				}
			}else{
				$errorMessage = 'ชื่อเข้าใช้งาน (Username) หรือ รหัสผ่าน (Password) ผิด. กรุณาลองใหม่อีกครั้ง!';
			}

		}



		$output = array();
		if($loginsuccess>0){
			$output['status'] = "success";
			$output['msg'] = "เข้าสู้ระบบสำเร็จ";
		}else{
			$output['status'] = "fail";
			$output['msg'] = $errorMessage;
		}


		echo json_encode($output);
	}


	public function getDevice($id=null){
		$qr = $this->fetchdata("kp_device","where dv_id = '$id' ");
		$res = $qr->fetch_object();

		return $res->dv_name;
	}

	public function getStaff($id=null){
		$qr = $this->fetchdata("kp_staff","where staff_id ='$id' ");
		$res = $qr->fetch_object();

		return $res->staff_name;
	}

	public function getCreator($fillname=null,$id=null){
		$qr = $this->fetchdata("kp_user","where user_id ='$id' ");
		$res = $qr->fetch_object();

		if($fillname=="img"){
			if(file_exists("images/user/$res->user_avatar")){
				$img = "<img src='images/user/$res->user_avatar' width='25' height='25' class='img-circle' /> ";
			}else{
				$img = "<img src='images/device/avatar.png' width='25' height='25' class='img-circle' /> ";
			}
			return $img;
		}elseif($fillname=="name"){
			return $res->user_fullname.' '.$res->user_lastname;
		}else{
			return $res->$fillname;
		}

	}

	public function joinJob(){
		$jobid = $_POST['jobid'];
		$userjoin = getSession();

		if($userjoin!='' and $jobid!=''){
			$form = array('job_id'=>$jobid,'user_id'=>$userjoin);
			$insert = $this->insertrow("kp_job_repairman",$form);

			if($insert){
				//start function save log transection
				$desclog = "เข้าร่วมทำงานในงานนี้ $jobid";
				savelog(getSession(),$desclog);
				//end function save log transection

				$jsonstatus = "success";
				$jsonrespontext = "Join success!";
				$jsonmsg = "เข้าร่วมงาน สำเร็จ!";
			}else{
				$jsonstatus = "error";
				$jsonrespontext = "Join error!";
				$jsonmsg = "ไม่สามารถ เข้าร่วมงานได้สำเร็จ  กรุณาติดต่อ Support";
			}
			$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
			echo json_encode($respon);
		}
	}


	public function staticChart(){
		$output = array();
		// jobsuccess
		$jobsuccess = $this->countJob("job_status = '3' ");
		$jobinprocess = $this->countJob("job_status = '1' ");
		$joball = $this->countJob("1 ");

		if($joball>0){
			$jobsuccess_per = abs($jobsuccess/$joball)*100;
		}else{
			$jobsuccess_per = 0;
		}

		if($joball>0){
			$jobinprocess_per = abs($jobinprocess_per/$joball)*100;
		}else{
			$jobinprocess_per = 0;
		}

	    $joball_per = 100;

	    $output[jobsuccess] =  $jobsuccess;
	    $output[jobsuccess_per] =  $jobsuccess_per."%";
	    $output[jobinprocess] =  $jobinprocess;
	    $output[jobinprocess_per] =  $jobinprocess_per."%";
	    $output[joball] =  $joball;
	    $output[joball_per] =  $joball_per."%";

	    echo json_encode($output);
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
