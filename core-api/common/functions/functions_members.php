<?php
$memberid = $_SESSION['member_id'][$privatesession];

function getSession(){
	require 'econtrol/common/include/config.php';
	return $_SESSION['member_id'][$privatesession];
}

function getmember($filltext){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$memberid = $_SESSION['member_id'][$privatesession];
	if($memberid!=''){
		$sqlm = "select * from kp_members where member_id = '$memberid'";
		$qm = $dbCon->query($sqlm) or die($dbCon->error);
		$res = $qm->fetch_object();
		$numrow = $qm->num_rows;
		if($filltext=="img"){
			if($res->member_img!=''){
				$img = "$url/images/members/$res->member_img";
			}else{
				if($res->member_avatar!=''){
					$img = $res->member_avatar;
				}else{
					$img = "$url/images/user_blank.png";
				}
			}
			return $img;
		}else{
			return $res->$filltext;
		}
	}
}

function getcheckMember($sid){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$sqlm = "select * from kp_members where member_id = '$sid'";
	$qm = $dbCon->query($sqlm) or die($dbCon->error);
	$res = $qm->fetch_object();
	$numrow = $qm->num_rows;

	if($numrow>0){
		if($res->fb_id!=''){
			$img = $res->member_avatar;
		}else{
			if($res->member_img!=''){
				$img = "$url/images/members/".$res->member_avatar;
			}else{
				$img = "$url/images/noprofile.jpg";
			}
		}

		$data = "<div class=\"checkout-box\">";
		$data.= "<ul class=\"nav navbar-nav\">";
		$data.= "<li style=\"padding:5px;\"><a href=\"$url/members/me\" style=\"padding: 0px;\"><img src='$img' id='avatar' class='img-responsive img-circle' style='width:30px;height:30px;'/></a></li>";
		$data.= "<li class=\"dropdown hidden-xs\" >";
		$data.= "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" style=\"color: #FFF;\" aria-expanded=\"false\">$res->member_name<span class=\"caret\"></span></a>";
		$data.= "<ul class=\"dropdown-menu\">";
		$data.= "<li><a href=\"$url/members/me\"><i class=\"fa fa-user\"></i> ภาพรวมของคุณ</a></li>";
		$data.= "<li><a href=\"$url/members/editprofile\"><i class=\"fa fa-cogs\"></i> แก้ไขโปรไฟล์</a></li>";
		$data.= "<li role=\"separator\" class=\"divider\"></li>";
		$data.= "<li><a href=\"$url/members?select=signout\"><i class=\"fa fa-power-off\"></i> ออกจากระบบ</a></li>";
		$data.= "</ul>";
		$data.= "</li>";
		$data.= "</ul>";
		$data.= "</div>";
	}else{
		$data = "<div class=\"checkout-box hidden-xs\">";
		//$data.= "<a href=\"javascript:gotoCreatestore('".getSession()."');\" class=\"btn btn-outline-front\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> เปิดร้าน </a>";
		$data.= "<a href=\"javascript:void(0);\" class=\"btn btn-signin-front btn-signin\" style=\"color:#fff;\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i> สมัคร - ล็อกอิน </a>";
		$data.= "</div>";
	}
	return $data;
}


?>
