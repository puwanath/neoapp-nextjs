<?php

function getcomp($att){
	require '../econtrol/common/include/config.php';

	$qsql = $dbCon->query("select * from kp_config where cog_id = 1 ") or die($dbCon->error);
	$res = $qsql->fetch_object();

	if($att=="companyname"){
		if($_SESSION['lg']=="TH"){
			return $res->companyname;
		}else{
			return $res->companyname_en;
		}
	}elseif($att=="address"){
		if($_SESSION['lg']=="TH"){
			$address = $res->companyaddress1;
			$address.= $res->companyaddress2;
			return $address;
		}else{
			$address = $res->companyaddress1_en;
			$address.= $res->companyaddress2_en;
			return $address;
		}
	}else{
		return $res->$att;
	}

}


function getcontact($att){
	require '../econtrol/common/include/config.php';

	$qsql = $dbCon->query("select * from kp_contact_info where id = 1 ") or die($dbCon->error);
	$res = $qsql->fetch_object();

	if($att=='contactname'){
		if($_SESSION['lg']=="TH"){
			return $res->contact_name_th;
		}else{
			return $res->contact_name_en;
		}
  }elseif($att=='address'){
		if($_SESSION['lg']=="TH"){
			return $res->contact_address_th;
		}else{
			return $res->contact_address_en;
		}
  }elseif($att=='tel'){
		if($_SESSION['lg']=="TH"){
			return $res->contact_tel_th;
		}else{
			return $res->contact_tel_en;
		}
	}else{
		return $res->$att;
	}
}


function getsocial($att){
	require '../econtrol/common/include/config.php';

	$qsql = $dbCon->query("select $att as attr from kp_social where id = '1' ") or die($dbCon->error);
	$res = $qsql->fetch_object();


	return $res->attr;
}

function getseo($att){
	require '../econtrol/common/include/config.php';

	$qsql = $dbCon->query("select $att as attr from kp_seo where id = '1' ") or die($dbCon->error);
	$res = $qsql->fetch_object();


	return $res->attr;
}


?>
