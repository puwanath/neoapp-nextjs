<?php
$param = "register";
require "models/$param.php";

class registerController extends Controllers
{

	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar('register');
		$param = "register";
		$active_register = "c-active";
		$model = new registerController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'sendregister' :
				$model->sendRegister();
				break;

			default :
			$urlredirec = "welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}
		endif;

		$content = array(
			"views/$param/index.php"
		);
		//end content
		if($select==''){
			$page = include("views/layout/template.php");
			return $page;
		}
	}


	public function sendRegister(){
		$readData = $_POST;
		$contact_name  = $readData['contact_name'];
		$contact_tel 	 = $readData['contact_tel'];
		$contact_email = $readData['contact_email'];
		$contact_time  = $readData['contact_time'];
		$project  = $readData['project'];
		if(SUBSTR($project,0,2)=='PC'){
			$project_name = $this->getTextformid('kp_projects_cat','project_cat_name_th','project_cat_id',$project);
		}elseif(SUBSTR($project,0,2)=='PM'){
			$project_name = $this->getTextformid('kp_promotions','promotion_name_th','promotion_id',$project);
		}elseif(SUBSTR($project,0,2)=='LP'){
			$project_name = $this->getTextformid('kp_landingpages','landing_name_th','landing_id',$project);
		}
		$budget  = $readData['budget'];
		$linkpage  = $readData['linkpage'];
		$subject  = 'New! '.$contact_name.' register from website.';

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ipclnxx = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ipclnxx = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		$ipclnxx = $_SERVER['REMOTE_ADDR'];
		}

		$mailname = "noreply";
		$mailfrom = "noreply@narawadee.co.th";
		$strSubject = "=?UTF-8?B?".base64_encode($subject)."?=";
		$strHeader .= "MIME-Version: 1.0' . \r\n";
		$strHeader .= "Content-type: text/html; charset=utf-8\r\n";
		$strHeader .= "From: $mailname <$mailfrom>\r\nReply-To: $mailfrom";
		$strVar = "ข้อความภาษาไทย";


		$body = "<div>
					<div>Dear : All.</div>
					<br/>
					<div>Name: $contact_name</div>
					<div>Tel: $contact_tel</div>
					<div>Email: $contact_email</div>
					<div>Project : $project_name</div>
					<div>Budget : $budget</div>
					<div>Contact Peried: $contact_time</div>
					<br/>
					<hr/>
					<div>Mail Message From Website narawadee.co.th</div>
					<div>From page: $linkpage</div>
					<div>Client IP Address: $ipclnxx</div>
				</div>";

			if(isset($contact_email))
			{
				////// Email
				// @set_magic_quotes_runtime(false);
				// ini_set('magic_quotes_runtime', 0);
				require_once("common/mailer/class.phpmailer.php");
				require_once("common/mailer/class.smtp.php");

				$subj = $subject. date("Y-m-d H:i:s");
				$mail = new PHPMailer(); // create a new object

				//$mail->IsSMTP(); // enable SMTP
				$mail->CharSet = "utf-8";
				$mail->IsHTML(true);
				// $mail->IsSMTP();
				$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only ,false = Disable
				// $mail->Host = "mail.narawadee.co.th";
				// $mail->Port = '25';
				$mail->Host = "smtp.gmail.com";
				$mail->Port = 587;
				$mail->SMTPAuth = true; // enable SMTP authentication
				$mail->SMTPSecure = 'tls'; // sets the prefix to the servier
				$mail->Username = "nrdnoreply@gmail.com"; //from@domainname.com
				$mail->Password = "ZongKingkong555";
				$mail->SetFrom("nrdnoreply@gmail.com", $subj);
				$mail->Subject = $subj;
				$mail->Body    = $body;

				$qrpopmailall = $this->fetchdata("kp_popup_email","where project_cat_id = '' and status =1 and is_delete=0 ");
				while($respopmailall=$qrpopmailall->fetch_object()){
					$popmailall = $respopmailall->email;
					$popnameall = $respopmailall->name;
					$mail->AddAddress("$popmailall","$popnameall");
				}

				$qrpopmail = $this->fetchdata("kp_popup_email","where project_cat_id = '$project' and status =1 and is_delete=0 ");
				if($qrpopmail->num_rows>0){
					while($respopmail=$qrpopmail->fetch_object()){
						$popmail = $respopmail->email;
						$popname = $respopmail->name;
						$mail->AddAddress("$popmail","$popname");
					}
				}else{
					$qrpopmail = $this->fetchdata("kp_popup_email","where status =1 and is_delete=0 ");
					while($respopmail=$qrpopmail->fetch_object()){
						$popmail = $respopmail->email;
						$popname = $respopmail->name;
						$mail->AddAddress("$popmail","$popname");
					}
				}

				// $mail->AddAddress("info@narawadee.co.th","info");
				$mail->AddAddress("puwanath007@gmail.com","noreply");
				if(!$mail->Send()){
					$flgSend = 0;
					$status = "fail";
					// $err = "Mailer Error: " . $mail->ErrorInfo;
		    }else{
					$flgSend = 1;
					$status = "success";
					$err = "";
					$custname = explode(" ", $contact_name);
					$cust_fname = $custname[0];
					$cust_sname = $custname[1];
					$arrpost = array(
						'cust_name'=>$cust_fname,
						'cust_sname'=>$cust_sname,
						'cust_tel'=>$contact_tel,
						'cust_email'=>$contact_email,
						'project'=>$project_name
					);

					$url_api = "https://167.71.218.249:41113/~kapong/narawadee-api/?page=register&select=register";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url_api);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,$arrpost);
					// receive server response ...
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec ($ch);
					curl_close ($ch);
					// further processing ....
					if ($server_output=="OK") { $respon = '';} else { $respon = ''; }

				}
			}

		//return $err;
		// $flgSend = @mail($strTo,$strSubject,$body,$strHeader);  // @ = No Show Error //
		// return $flgSend;
		echo json_encode(array('status'=>$status,'msg'=>$err,'curlrespon'=>$server_output));
	}


	public function getProject_name($id){
		if(SUBSTR($id,0,2)=='PJ'){
			$qr = $this->fetchdata("kp_projects_cat","where project_cat_id in
			(select project_cat_id from kp_projects where project_id = '$id' ) ");
			$res = $qr->fetch_object();

			return $res->project_cat_name_th;
		}else{
			$qr = $this->fetchdata("kp_projects_cat","where project_cat_id = '$id' ");
			$res = $qr->fetch_object();

			return $res->project_cat_name_th;
		}
	}

}
?>
