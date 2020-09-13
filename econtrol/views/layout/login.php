<?php
//session_start();
//require 'common/include/config.php';

//require 'common/functions/functions_checkuser.php';
/*
$errorMessage = "กรุณาเข้าสู่ระบบ เพื่อใช้งาน";

if (isset($_POST['txtUserName'])) {
	$result = doLogin();

	if ($result != '') {
		$errorMessage = $result;
	}
}
*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Meta -->
    <meta name="description" content="eControl Website Management">
    <meta name="author" content="Mr.Puwanath Baibua">
    <title>Login to [eControl] Content Management System : <?=getcomp('companyname');?> By Kapongidea.com</title>
    <!-- vendor css -->
    <link href="<?=$dir;?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=$dir;?>lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Satisfy" rel="stylesheet">
    <link rel="shortcut icon" href="<?=$url;?>/images/favicon.png" />
    <link rel="icon" type="image/x-icon" href="<?=$url;?>/images/favicon.png" />

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?=$dir;?>css/bracket.css">
  </head>

  <body style="background-image: url('<?=$url;?>/images/bg.jpg');
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;">

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v" id="m_login">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40">
        <?php if(!empty(getcomp('logo'))):?>
        <div class="signin-logo tx-center"><img src="<?=$url;?>/images/<?=getcomp('logo');?>" style="max-width:150px;"></div>
        <?php endif;?>
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse" style="color:#FFF;"><span class="tx-normal">[</span> eControl <span class="tx-normal">] V7.0</span></div>
        <div class="tx-center mg-b-10 tx-white">ระบบจัดการเว็บไซต์ v7.0.2020</div>
        <div class="tx-center tx-15" style="color:yellow;" id="errtext"></div>
				<form class="m-login__form m-form" id="frmlogin" autocomplete='off'>
            <input type="hidden" id="urlweb" name="urlweb" value="<?=$url;?>" />
	        <div class="form-group">
	          <input type="text" class="form-control" id="txtUserName" autocomplete="off" name="txtUserName" placeholder="Enter your username" autofocus="true">
            <span id="errusername" style="color:red;"></span>
	        </div><!-- form-group -->
	        <div class="form-group">
	          <input type="password" class="form-control" id="txtPassword" autocomplete="off" name="txtPassword" placeholder="Enter your password">
            <span id="errpassword" style="color:red;"></span>
	          <!-- <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a> -->
	        </div><!-- form-group -->
	        <button class="btn btn-info btn-block" id="m_login_signin_submit"> เข้าสู่ระบบ</button>
				</form>
        <div class="mg-t-60 tx-center tx-white">Development by <a href="mailto:puwanath.kapongidea@gmail.com" class="tx-info" style="font-family: 'Satisfy', cursive;">Kapongidea</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <div id="waitajax">
      <div class="iconload">
        <img src='<?=$url;?>/images/loading.svg' /><br>Loading..
      </div>
    </div>

    <script src="<?=$dir;?>lib/jquery/jquery.js"></script>
    <script src="<?=$dir;?>lib/popper.js/popper.js"></script>
    <script src="<?=$dir;?>lib/bootstrap/bootstrap.js"></script>
		<script src="<?=$dir;?>user/login.js" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
          $(document).ajaxStart(function(){
              $("#waitajax").css("display", "block");
          });
          $(document).ajaxComplete(function(){
              $("#waitajax").css("display", "none");
          });
      });
    </script>
    <style type="text/css">
      #waitajax{
        z-index: 999;
        display: none;
        position: fixed;
        margin: 0 auto;
        text-align: center;
        color: #000;
        /*background-color: rgba(0, 0, 0, 0.38);*/
        height: calc(100% - 0px);
        width: 100%;
        top: 0;
        left: 0;
        height: 100%;
      }

      #waitajax .iconload{
        position: relative;
        display: inline-block;
        justify-content: center;
        align-items: center;
        text-align: center;
        color:#000;
        top:50%;
        width: 100%;
      }

    </style>

  </body>
</html>
