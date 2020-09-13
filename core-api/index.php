<?php
ob_start();
ob_start('ob_gzhandler');
session_start();
setlocale(LC_MONETARY,"en_US");

if(isset($_SESSION['lg'])):$lg = $_SESSION['lg'];else:$lg = 'EN';$_SESSION['lg']= 'EN';endif;

require "../econtrol/common/include/config.php";
require "common/functions/functions_setting.php";

if(getcomp('store_system')==1){

	// start functions all include in all page
	require "common/functions/functions_pages.php";
	// require 'common/functions/functions_pushstatic.php';
	// require "common/functions/functions_navipage.php";
	// require "common/functions/functions_selectdata.php";
	// require "common/functions/functions_loaddata.php";
	// require 'common/functions/functions_wordvar.php';
	// require 'common/functions/functions_banner.php';
	// require 'common/functions/functions_substr.php';
	// require 'common/functions/functions_convert_webp.php';
	// require 'common/functions/functions_popup.php';
	// require 'common/functions/functions_minify.php';
	// $word = new word();
	// putstatic(); // function เก็บ สถิติ
	$url = curPageURL();

	$download=$_GET['download'];
	$path="images/files";
	if(isset($download)) {
		header("Content-Type: application/force-download");
		header("Content-Disposition: attachment; filename=$download");
		@readfile("$path/$download");
	}

	//end functions
	$pages->index($get_part0,$get_part1,$get_part2,$get_part3);
	/*
	$content = minify_html( ob_get_clean() );
	$content = preg_replace_callback('#<script(>|\s[^<>]*?>)([\s\S]*?)<\/script>#', function($m) {
		return '<script' . $m[1] . minify_js($m[2]) . '</script>';
	},
	$content);
	echo $content;
	*/


}else{
  include "assets/underconstruction/index.html";
}
$dbCon->close();

?>
