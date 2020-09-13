<?php
function convertdate($datadate)
{
	$month = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	
	$day = SUBSTR($datadate,8,2);
	$mon = SUBSTR($datadate,5,2);
	$year = SUBSTR($datadate,0,4);
	
	$mix = $day.' '.$month[$mon-1].' '.$year;
	return $mix;
}
?>