<?php
require "functions_partconfig.php";
$get_part0 = $path_info['call_parts'][0];
$get_part1 = $path_info['call_parts'][1];
$get_part2 = $path_info['call_parts'][2];
$get_part3 = $path_info['call_parts'][3];
$get_part4 = $path_info['call_parts'][4];
$get_part5 = $path_info['call_parts'][5];
//funvtions if

if($get_part0=="home"){
	require "controllers/homeControllers.php";
	$pages = new homeController;
}elseif($get_part0=="about"){
	require "controllers/aboutusControllers.php";
	$pages = new aboutusController;
}else{
	require "controllers/homeControllers.php";
	$pages = new homeController;
}

?>
