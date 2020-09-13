<?php
include "models/errorpage.php";
class errController extends Controllers
{

	public function index(){
		$page = include('views/errorpage/404.php');
		return $page;
	}

	public function getbgHead($get_part0,$pagename,$pagename2,$url){
		$word = new word();
		$url = curPageURL();
		$img  = getImgbanner($get_part0,$url);
		$page = include('views/layers/bghead.php');
		return $page;
	}
}
?>
