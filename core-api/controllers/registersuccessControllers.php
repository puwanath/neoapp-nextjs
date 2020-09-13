<?php
$param = "registersuccess";
require "models/$param.php";

class registersuccessController extends Controllers
{

	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar('register success');
		$param = "registersuccess";
		$active_registersuccess = "c-active";
		$model = new registersuccessController;

		$title = 'Register Success!'.getseo('seotitle');
		$description = getseo('seodesc');
		$keyword = getseo('seokeyword');
		$urlweb = getsocial('linkurl');
		$imageurl = "$url2/images/logo.png";

		$content = array(
			"views/$param/index.php"
		);
		//end content
		if($select==''){
			$page = include("views/layout/template.php");
			return $page;
		}
	}




}
?>
