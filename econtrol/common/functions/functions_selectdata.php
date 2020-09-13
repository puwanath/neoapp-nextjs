<?php

function Getlaw(){
	include('common/include/config.php');

	$arr = array();
	$sql = "select * from kp_law where 1 order by law_num ASC";
	$qr = $dbCon->query($sql) or die($dbCon->error);
	while($res = $qr->fetch_object()){
		$data= "<option value='$res->law_id'>$res->law_num</option>";
		array_push($arr,$data);
	}


	return implode('',$arr);
}


function getcomp($fill){
	include('common/include/config.php');

	$sql = "select $fill as f from kp_config where cog_id = 1";
	$qr = $dbCon->query($sql) or die($dbCon->error);
	$res = $qr->fetch_object();



	return $res->f;
}


function convd($Dstr,$fomattext)
{
	$dv = date_create($Dstr);
	$dd = date_format($dv,$fomattext);

	return $dd;
}


function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
       if ('.' === $file || '..' === $file) continue;
       if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
       else unlink("$dir/$file");
   }

   rmdir($dir);
}








?>
