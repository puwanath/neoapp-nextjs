<?php
//session_start();

function onlineUser(){
	require "common/include/config.php";
	if (isset($_SESSION['user_id'][$privatesession])==true) {
		$uid = $_SESSION['user_id'][$privatesession];
		$qrcheck = $dbCon->query("SELECT * FROM kp_user_online WHERE user_id = '$uid' ") or die($dbCon->error);
		$numcheck = $qrcheck->num_rows;
		// insert and update function
		if($numcheck>0){
			$updatetime = $dbCon->query("UPDATE kp_user_online SET time_stamp = NOW() WHERE user_id = '$uid' ");
		}else{
			$updatetime = $dbCon->query("INSERT INTO kp_user_online (user_id) VALUES('$uid')");
		}

		//delete user
		// if($updatetime){
			$intRejectTime = 10; // Minute
			$delrow = $dbCon->query("DELETE FROM kp_user_online WHERE time_stamp < (NOW() - INTERVAL $intRejectTime MINUTE)");
		// }
	}
}



function checkUser(){
	require "common/include/config.php";
	if (isset($_SESSION['user_id'][$privatesession])==true) {

		$qrcheckuser = $dbCon->query("select * from kp_users where user_id = '".$_SESSION['user_id'][$privatesession]."' and status = 1 ") or die($dbCon->error);
		$numcheck = $qrcheckuser->num_rows;
		if($numcheck>0){
			//header('Location: ' . WEB_ROOT . '../../login');
			//exit;
			return 1;
		}else{
			return 0;
		}

	}else{
		return 0;
	}

}

function getSession(){
	require "common/include/config.php";
	return $_SESSION['user_id'][$privatesession];
}


function doLogin()
{
	require "common/include/config.php";

	// if we found an error save the error message in this variable
	$errorMessage = '';

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
			$sql = $dbCon->query("UPDATE kp_users
			        SET user_last_login = NOW()
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
				header('Location: ' . $_SESSION['login_return_url']);
				exit;
			} else {
				$_SESSION['user_id'][$privatesession];
				header('Location: welcome');
				exit;
			}
		}else{
			$errorMessage = 'ชื่อเข้าใช้งาน (Username) หรือ รหัสผ่าน (Password) ผิด. กรุณาลองใหม่อีกครั้ง!';
		}

	}
	return $errorMessage;

}

/*
	Logout a user
*/
function doLogout()
{
	require "common/include/config.php";
	if (isset($_SESSION['user_id'][$privatesession])) {

		//start function save log transection
		$desclog = "ออกจากระบบ";
		savelog($_SESSION['user_id'][$privatesession],$desclog);
		//end function save log transection

		unset($_SESSION['user_id'][$privatesession]);
		//session_unset();
		// session_unset('user_id');
	}

	$url = curPageURL();
	header("Location: $url");
	exit;
}




?>
