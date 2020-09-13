<?php
$param = "contact";
require "models/$param.php";

class contactController extends Controllers
{

	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar('Contact us');
		$bgcover = "$url/images/bgcontact.jpg";
		$param = "contact";
		$active_contact = "c-active";
		$model = new contactController;

		$current_about = "active";
		$title = getcontact('contactname');
		$description = getseo('seodesc');
		$keyword = getseo('seokeyword');
		$urlweb = getcomp('url');
		$imageurl = "$url/images/logo.png";

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'sendmail' :
				$model->sendMail();
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

	public function getContactinfo($f){
		$word = new word();
		$url = curPageURL();

		$qr = $this->fetchdata("kp_contact_info","where id = '1' ");
		$res = $qr->fetch_object();

		if($f=='contact_info'){
			if($_SESSION['lg']=='TH'){
				$contact_name = $res->contact_name_th;
				$contact_address = $res->contact_address_th;
				$contact_tel = $res->contact_tel_th;
			}else{
				$contact_name = $res->contact_name_en;
				$contact_address = $res->contact_address_en;
				$contact_tel = $res->contact_tel_en;
			}
			$email = $res->contact_email;

			$html = '<dl class="dl-horizontal">
				<dt style="font-size:20px;margin-bottom:10px;">'.$word->wordvar('Contact Information').'</dt>
				<dd></dd>
				<dt>'.$word->wordvar('Company Name').'</dt>
				<dd>'.$contact_name.'</dd>
				<dt>'.$word->wordvar('Address').'</dt>
				<dd>'.$contact_address.'</dd>
				<dt>'.$word->wordvar('Telephone').'</dt>
				<dd>'.$contact_tel.'</dd>
				<dt>'.$word->wordvar('Email').'</dt>
				<dd>'.$email.'</dd>';
			if(!empty($res->contact_lineid)){
				$html.= '<dt>'.$word->wordvar('Line ID').'</dt>
				<dd>'.$res->contact_lineid.'</dd>';
			}
			if(!empty($res->contact_facebook)){
				$html.= '<dt>'.$word->wordvar('Facebook').'</dt>
				<dd>'.$res->contact_facebook.'</dd>';
			}

			$html.= '</dl>';


			return $html;
		}else{
			return $res->$f;
		}
	}

	public function sendMail(){

		$mailto = getcontact('contact_receive_mail');
		$mailfrom = $_POST['email'];
		$name 	 = $_POST['name'];
		$tel 	 = $_POST['tel'];
		$subject  = $_POST['subject'];
		$message  = $_POST['message'];


		$strTo = $mailto;
		$strSubject = "=?UTF-8?B?".base64_encode($subject)."?=";
		$strHeader .= "MIME-Version: 1.0' . \r\n";
		$strHeader .= "Content-type: text/html; charset=utf-8\r\n";
		$strHeader .= "From: $name <$mailfrom>\r\nReply-To: $mailfrom";
		$strVar = "ข้อความภาษาไทย";


		$body = "<div>
					<div>Dear : Customer Service.</div>
					<br/>
					<div>$message
					<br/>
					<hr/>
					</div>
					<div>Name: $name</div>
					<div>Tel: $tel</div>
					<div>Email: $mailfrom</div>
					<div>Mail Message From Website Narawadee.co.th</div>
				</div>";

			if(isset($_POST["send"]))
			{
				////// Email
				// @set_magic_quotes_runtime(false);
				// ini_set('magic_quotes_runtime', 0);
				require_once("common/mailer/class.phpmailer.php");
				require_once("common/mailer/class.smtp.php");

				$subj = 'New Message From Website. '. date("Y-m-d H:i:s");
				$mail = new PHPMailer(); // create a new object

				//$mail->IsSMTP(); // enable SMTP
				$mail->CharSet = "utf-8";
				$mail->IsHTML(true);
				$mail->IsSMTP();
				$mail->SMTPAuth = true; // enable SMTP authentication
				$mail->SMTPSecure = ""; // sets the prefix to the servier
				$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only ,false = Disable
				$mail->Host = "mail.narawadee.co.th";
				$mail->Port = '25';
				$mail->Username = "noreply@narawadee.co.th"; //from@domainname.com
				$mail->Password = "9kapong";
				$mail->SetFrom("noreply@narawadee.co.th", $subj);
				$mail->Subject = $subject;
				$mail->Body    = $body;
				$mail->AddAddress($mailto);
				$mail->AddAddress("noreply@narawadee.co.th");
				if(!$mail->Send()){
					$flgSend = 0;
					$flgSend.= "Mailer Error: " . $mail->ErrorInfo;
			    }else{
					$flgSend = 1;
				}

			}

		//return $err;
		// $flgSend = @mail($strTo,$strSubject,$body,$strHeader);  // @ = No Show Error //
		return $flgSend;
	}

}
?>
