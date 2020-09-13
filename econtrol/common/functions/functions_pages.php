<?php
include('functions_partconfig.php');

$get_part0 = $path_info['call_parts'][0];
$get_part1 = $path_info['call_parts'][1];
$get_part2 = $path_info['call_parts'][2];
$get_part3 = $path_info['call_parts'][3];
$get_part4 = $path_info['call_parts'][4];
$get_part5 = $path_info['call_parts'][5];

//funvtions if
if($get_part0=="setting" and $get_part1!=''){

	if($get_part1=="users"){
		require "controllers/userController.php";
		$pages = new userController;
	}elseif($get_part1=="permission"){
		require "controllers/permissionController.php";
		$pages = new permissionController;
	}elseif($get_part1=="config"){
		require "controllers/cogController.php";
		$pages = new cogController;
	}elseif($get_part1=="profile"){
		require "controllers/profileController.php";
		$pages = new profileController;
	}elseif($get_part1=="logtransection"){
		require "controllers/logController.php";
		$pages = new logController;
	}elseif($get_part1=="profile"){
		require "controllers/profileController.php";
		$pages = new profileController;
	}elseif($get_part1=="menu"){
		require "controllers/menuController.php";
		$pages = new menuController;
	}elseif($get_part1=="social"){
		require "controllers/socialController.php";
		$pages = new socialController;
	}elseif($get_part1=="seo"){
		require "controllers/seoController.php";
		$pages = new seoController;
	}elseif($get_part1=="language"){
		require "controllers/languageController.php";
		$pages = new languageController;
	/* ========================================================================== */

	}

	/* ========================================================================== */

}elseif($get_part0=="sales-dashboard"){
	require "controllers/salesdashboardController.php";
	$pages = new salesdashboardController;

}elseif($get_part0=="ads"){
	require "controllers/adsController.php";
	$pages = new adsController;

}elseif($get_part0=="slide"){
	require "controllers/slideController.php";
	$pages = new slideController;

}elseif($get_part0=="pages"){
	require "controllers/pagesController.php";
	$pages = new pagesController;

}elseif($get_part0=="posts"){
	require "controllers/postsController.php";
	$pages = new postsController;

}elseif($get_part0=="news"){
	require "controllers/newsController.php";
	$pages = new newsController;

}elseif($get_part0=="catnews"){
	require "controllers/catnewsController.php";
	$pages = new catnewsController;

}elseif($get_part0=="catposts"){
	require "controllers/catpostsController.php";
	$pages = new catpostsController;

}elseif($get_part0=="applications"){
	require "controllers/applicationsController.php";
	$pages = new applicationsController;

}elseif($get_part0=="process"){
	require "controllers/processController.php";
	$pages = new processController;

}elseif($get_part0=="department"){
	require "controllers/departmentController.php";
	$pages = new departmentController;

//============================================================

}elseif($get_part0=="category-setting"){
	require "controllers/categorysettingController.php";
	$pages = new categorysettingController;

}elseif($get_part0=="brand-setting"){
	require "controllers/brandsettingController.php";
	$pages = new brandsettingController;

}elseif($get_part0=="suppliers-setting"){
	require "controllers/supplierssettingController.php";
	$pages = new suppliersController;

}elseif($get_part0=="attribute-setting"){
	require "controllers/attributesettingController.php";
	$pages = new attributesettingController;

}elseif($get_part0=="producttype-setting"){
	require "controllers/producttypesettingController.php";
	$pages = new producttypesettingController;

}elseif($get_part0=="productstatus-setting"){
	require "controllers/productstatussettingController.php";
	$pages = new productstatussettingController;

}elseif($get_part0=="products"){
	require "controllers/productsController.php";
	$pages = new productsController;

}elseif($get_part0=="teams"){
	require "controllers/teamsController.php";
	$pages = new teamsController;

}elseif($get_part0=="contact-manage"){
	require "controllers/contactmanageController.php";
	$pages = new contactmanageController;

//============================================================

}elseif($get_part0=="ulogin"){
	require "controllers/loginController.php";
	$pages = new loginController;

}elseif($get_part0=="data-log"){
	require "controllers/logdataController.php";
	$pages = new logdataController;

}elseif($get_part0=="upload"){
	require "controllers/uploadfileController.php";
	$pages = new uploadController;

}elseif($get_part0=="notify"){
	require "controllers/notifyController.php";
	$pages = new notifyController;

// ==========================================================

}elseif($get_part0=="customers"){
	require "controllers/customersController.php";
	$pages = new customersController;

}elseif($get_part0=="members"){
	require "controllers/membersController.php";
	$pages = new membersController;

}elseif($get_part0=="orders"){
	require "controllers/ordersController.php";
	$pages = new ordersController;

}elseif($get_part0=="coupon-setting"){
	require "controllers/couponController.php";
	$pages = new couponController;

}elseif($get_part0=="payment-setting"){
	require "controllers/paymentsettingController.php";
	$pages = new paymentsettingController;

}elseif($get_part0=="bank-setting"){
	require "controllers/banksettingController.php";
	$pages = new banksettingController;

}elseif($get_part0=="shipping-setting"){
	require "controllers/shippingtypeController.php";
	$pages = new shippingsettingController;


// main ====================================================
}else{
	if($get_part0!='' and $get_part0!="welcome"){
		require "controllers/err404Controller.php";
		$pages = new err404Controller;
	}else{
		require "controllers/mainController.php";
		$pages = new homeController;
	}

}

?>
