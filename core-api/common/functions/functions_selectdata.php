<?php
function selectdata($tb,$colume,$whereid,$condition){
	require 'econtrol/common/include/config.php';

	$sql = "select $colume as data from $tb where $whereid = '$condition'";
	$select = $dbCon->query($sql);
	$re = $select->fetch_object();

	return $re->data;
}

function getImgbanner($getpage,$url){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];

	$sql = "select * from kp_banner_ads where baposition = '$get_part0' and status =1";
	$select = $dbCon->query($sql);
	$re = $select->fetch_object();
	$num = $select->num_rows;
	if($num>0):
	//$img = "<a href=\"$re->balink\"><img src=\"$url/images/banners/ads/$re->baimg\" alt=\"$re->baname\" class=\"img-rounded\" title=\"$re->baname\" /></a>";
	$img = $url."/images/banners/ads/".$re->baimg;
	endif;
	return $img;
}


function getLocation_project(){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];
	$arr = array();
	$sql = "select * from kp_location where status=1 and is_delete=0 order by location_id ASC";
	$select = $dbCon->query($sql);
	while($re = $select->fetch_object()){

		if($_SESSION['lg']=="TH"){
			$location_name = $re->location_name_th;
		}else{
			$location_name = $re->location_name_en;
		}

		$data = "<li><a href=\"$url/projects/location/$re->location_id/$location_name\">$location_name</a></li>";
		array_push($arr,$data);
	}

	return implode('',$arr);
}

function getCat_news(){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];
	$arr = array();
	$sql = "select * from kp_type_news where is_delete=0 order by sort ASC";
	$select = $dbCon->query($sql) or die($dbCon->error);
	while($re = $select->fetch_object()){
		$type_id = $re->type_id;
		$slug = $re->slug;
		if($_SESSION['lg']=="TH"){
			$cat_name = $re->type_name_th;
		}else{
			$cat_name = $re->type_name_en;
		}

		$data = "<li><a href=\"$url/$slug\">$cat_name</a></li>";
		array_push($arr,$data);
	}

	return implode('',$arr);
}

function getProject_type(){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];
	$arr = array();
	$sql = "select * from kp_projects_type where status=1 and is_delete=0 and project_type_main_id='main' order by (project_type_id+0) ASC";
	$select = $dbCon->query($sql);
	while($re = $select->fetch_object()){
		$type_id = $re->project_type_id;
		if($_SESSION['lg']=="TH"){
			$type_name = $re->project_type_name_th;
		}else{
			$type_name = $re->project_type_name_en;
		}

		// sub menu
		$arrsub = array();
		$sqlsub = $dbCon->query("select * from kp_projects_type where status = 1 and project_type_main_id = '".$type_id."' order by (project_type_id+0) ASC limit 0,5") or die($dbCon->error);
		while($ressub = $sqlsub->fetch_object()){
			if($_SESSION['lg']=="TH"){
				$type_name_sub = $ressub->project_type_name_th;
			}else{
				$type_name_sub = $ressub->project_type_name_en;
			}
			$datasub = "<li><a href=\"$url/projects/type/$ressub->project_type_id/$ressub->project_type_name_en\">$type_name_sub</a></li>";
			array_push($arrsub,$datasub);
		}
		// end sub menu

		$data = "<div class=\"col\">";
		$data.= "<h6 class=\"tt-title-submenu\"><a href=\"$url/projects/type/$re->project_type_id/$re->project_type_name_en\">$type_name</a></h6>";
		$data.= "<ul class=\"tt-megamenu-submenu\">";
		$data.= implode('',$arrsub);
		$data.= "</ul>";
		$data.= "</div>";


		array_push($arr,$data);
	}

	return implode('',$arr);
}

// project category footer
function getProject_type_footer($id){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];
	$arr = array();
	$sql = "select * from kp_projects_type where project_type_id = '$id' and status=1 and is_delete=0 and project_type_main_id='main'";
	$select = $dbCon->query($sql);
	$re = $select->fetch_object();
		$type_id = $re->project_type_id;
		if($_SESSION['lg']=="TH"){
			$type_name = $re->project_type_name_th;
		}else{
			$type_name = $re->project_type_name_en;
		}

		// sub menu
		$arrsub = array();
		$sqlsub = $dbCon->query("select * from kp_projects_type where status = 1 and project_type_main_id = '".$type_id."' order by (project_type_id+0) ASC limit 0,5") or die($dbCon->error);
		while($ressub = $sqlsub->fetch_object()){
			if($_SESSION['lg']=="TH"){
				$type_name_sub = $ressub->project_type_name_th;
			}else{
				$type_name_sub = $ressub->project_type_name_en;
			}
			$datasub = "<li><a href=\"$url/projects/type/$ressub->project_type_id/$ressub->project_type_name_en\">$type_name_sub</a></li>";
			array_push($arrsub,$datasub);
		}
		// end sub menu

		$data = "<div class=\"tt-mobile-collapse\">";
		$data.= "<h4 class=\"tt-collapse-title\">";
		$data.= $type_name;
		$data.= "</h4>";
		$data.= "<div class=\"tt-collapse-content\">";
		$data.= "<ul class=\"tt-list\">";
		$data.= implode('',$arrsub);
		$data.= "</ul>";
		$data.= "</div>";
		$data.= "</div>";


	return $data;
}


function getProject_category(){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$word = new word();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];
	$arr = array();
	$sql = "select * from kp_projects_cat where status =1 and is_delete=0 order by sort ASC";
	$select = $dbCon->query($sql);
	while($re = $select->fetch_object()){
		$cat_id = $re->project_cat_id;
		$slugcat = urlencode($re->slug);
		if($_SESSION['lg']=="TH"){
			$cat_name = $re->project_cat_name_th;
		}else{
			$cat_name = $re->project_cat_name_en;
		}

		// sub menu
		$arrsub = array();
		$sqlsub = $dbCon->query("select * from kp_projects where status=1 and is_delete=0 and project_cat_id = '".$cat_id."' order by sort ASC limit 0,3") or die($dbCon->error);
		while($ressub = $sqlsub->fetch_object()){
			$slug = urlencode($ressub->slug);
			if($_SESSION['lg']=="TH"){
				$projectname = $ressub->project_name_th;
			}else{
				$projectname = $ressub->project_name_en;
			}
			$datasub = "<li><a href=\"$url/$slug\">$projectname</a></li>";
			array_push($arrsub,$datasub);
		}
		// end sub menu

		$data = "<div class=\"col-sm-4\">";
		// $data.= "<h6 class=\"tt-title-submenu\"><a href=\"$url/projects/category/$cat_id/$re->project_cat_name_en\">$cat_name</a></h6>";
		$data.= "<ul class=\"dropdown-menu c-menu-type-inline\">";
		$data.= "<li><a href=\"$slugcat\"><h4>$cat_name</h4></a></li>";
		$data.= implode('',$arrsub);
		$data.= "<li><a href=\"$url/$slugcat\">".$word->wordvar('more')."...</a></li>";
		$data.= "</ul>";
		$data.= "</div>";


		array_push($arr,$data);
	}

	return implode('',$arr);
}

function getProject_category_footer(){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$word = new word();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];
	$arr = array();
	$sql = "select * from kp_projects_cat where status =1 order by (project_cat_sort+0) ASC";
	$select = $dbCon->query($sql);
	while($re = $select->fetch_object()){
		$cat_id = $re->project_cat_id;
		if($_SESSION['lg']=="TH"){
			$cat_name = $re->project_cat_name_th;
		}else{
			$cat_name = $re->project_cat_name_en;
		}

		$data = "<li><a href=\"$url/projects/category/$cat_id/$cat_name\">$cat_name</a></li>";
		array_push($arr,$data);
	}

	return implode('',$arr);
}

// =========================Mobile menu ==============================//
function getProject_category_mobile(){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$word = new word();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];
	$arr = array();
	$sql = "select * from kp_projects_cat where status =1 order by (project_cat_sort+0) ASC";
	$select = $dbCon->query($sql);
	while($re = $select->fetch_object()){
		$cat_id = $re->project_cat_id;
		if($_SESSION['lg']=="TH"){
			$cat_name = $re->project_cat_name_th;
		}else{
			$cat_name = $re->project_cat_name_en;
		}

		// sub menu
		$arrsub = array();
		$sqlsub = $dbCon->query("select * from kp_projects where status = 1 and project_cat_id = '".$cat_id."' order by (project_cat_id+0) ASC limit 0,5") or die($dbCon->error);
		while($ressub = $sqlsub->fetch_object()){
			if($_SESSION['lg']=="TH"){
				$projectname = $ressub->project_name_th;
			}else{
				$projectname = $ressub->project_name_en;
			}
			$datasub = "<li><a href=\"$url/projects/view/$ressub->project_id/$ressub->project_name_en\">$projectname</a></li>";
			array_push($arrsub,$datasub);
		}
		// end sub menu

		$data = "<li>";
		$data.= "<a href=\"$url/projects/category/$cat_id/$re->project_cat_name_en\">$cat_name</a>";
		$data.= "<ul>";
		$data.= implode('',$arrsub);
		// $data.= "<li><a href=\"$url/projects/category/$cat_id/$cat_name\">".$word->wordvar('more')."</a></li>";
		$data.= "</ul>";
		$data.= "</li>";


		array_push($arr,$data);
	}

	return implode('',$arr);
}

function getProject_type_mobile(){
	require 'econtrol/common/include/config.php';
	$url = curPageURL();
	$path_info = parse_path();
	$get_part0 = $path_info['call_parts'][0];
	$arr = array();
	$sql = "select * from kp_projects_type where status =1 and project_type_main_id='main' order by (project_type_id+0) ASC";
	$select = $dbCon->query($sql);
	while($re = $select->fetch_object()){
		$type_id = $re->project_type_id;
		if($_SESSION['lg']=="TH"){
			$type_name = $re->project_type_name_th;
		}else{
			$type_name = $re->project_type_name_en;
		}

		// sub menu
		$arrsub = array();
		$sqlsub = $dbCon->query("select * from kp_projects_type where status = 1 and project_type_main_id = '".$type_id."' order by (project_type_id+0) ASC limit 0,5") or die($dbCon->error);
		while($ressub = $sqlsub->fetch_object()){
			if($_SESSION['lg']=="TH"){
				$type_name_sub = $ressub->project_type_name_th;
			}else{
				$type_name_sub = $ressub->project_type_name_en;
			}
			$datasub = "<li><a href=\"$url/projects/type/$ressub->project_type_id/$ressub->project_type_name_en\">$type_name_sub</a></li>";
			array_push($arrsub,$datasub);
		}
		// end sub menu

		$data = "<li>";
		$data.= "<a href=\"$url/projects/type/$re->project_type_id/$re->project_type_name_en\">$type_name</a>";
		$data.= "<ul>";
		$data.= implode('',$arrsub);
		$data.= "</ul>";
		$data.= "</li>";


		array_push($arr,$data);
	}

	return implode('',$arr);
}

?>
