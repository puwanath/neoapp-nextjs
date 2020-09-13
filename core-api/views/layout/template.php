<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"  >
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$title;?></title>
	<meta name="Description" content="<?=$description;?>">
	<meta name="Keywords" content="<?=$keyword;?>">
	<meta name="Copyright" content="<?=$title;?>">
	<meta http-equiv="content-script-type" content="text/javascript">
	<meta property="og:title" content="<?=$title;?>">
	<meta property="og:site_name" content="<?=$title;?>">
	<meta property="og:description" content="<?=$description;?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?=$urlweb;?>">
	<meta property="og:image" content="<?=$imageurl;?>">
	<meta property="og:locale" content="th_TH"/>
	<meta name="author" content="<?=getcomp('companyname');?>">
	<meta name="stats-in-th" content="fdff" />
	<meta name="robots" content="noodp,index,follow" />
	<meta name='revisit-after' content='1 days' />
	<link rel="shortcut icon" href="<?=$url;?>/images/favicon.png" />
	<!--ออกแบบและพัฒนาโดย นายภูวนาท  ใบบัว  start development   new version development 10/06/63-->

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?=$dir;?>plugins/socicon/socicon.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/animate/animate.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN: BASE PLUGINS  -->
	<link href="<?=$dir;?>plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/revo-slider/css/layers.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/revo-slider/css/navigation.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/slider-for-bootstrap/css/slider.css" rel="stylesheet" type="text/css"/>
	<!-- END: BASE PLUGINS -->

	<!-- BEGIN: PAGE STYLES -->
	<link href="<?=$dir;?>plugins/ilightbox/css/ilightbox.css" rel="stylesheet" type="text/css"/>
	<!-- END: PAGE STYLES -->

  <!-- BEGIN THEME STYLES -->
	<link href="<?=$dir;?>kapong/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>kapong/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>kapong/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css"/>
	<link href="<?=$dir;?>kapong/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<?php
	if(count($cssarr)>0):
	foreach ($cssarr as $value) {
		echo $value;
	}
	endif;


	// condition Header fullscreen
	if($get_part0=='' or $get_part0=='welcome'){
		$fullpage = 'c-layout-header-fullscreen';
	}else{
		$fullpage = '';
	}
	?>
</head>
<body class="c-layout-header-fixed c-layout-header-mobile-fixed">
	<?php include('views/layout/header.php');?>

	<!-- BEGIN: PAGE CONTAINER -->
	<div class="c-layout-page">
		<!-- BEGIN: PAGE CONTENT -->
		<?php
		foreach($content as $p){
			include($p);
		}
		?>

		<!-- END: PAGE CONTENT -->
	</div>
	<!-- END: PAGE CONTAINER -->


	<?php include('views/layout/footer.php');?>

	<!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
	<div class="c-layout-go2top">
		<i class="icon-arrow-up"></i>
	</div>
	<!-- END: LAYOUT/FOOTERS/GO2TOP -->

	<!--[if lt IE 9]>
	<script src="<?=$dir;?>global/plugins/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?=$dir;?>plugins/jquery.min.js" type="text/javascript" ></script>
	<script src="<?=$dir;?>plugins/jquery-migrate.min.js" type="text/javascript" ></script>
	<script src="<?=$dir;?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
	<script src="<?=$dir;?>plugins/jquery.easing.min.js" type="text/javascript" ></script>
	<script src="<?=$dir;?>plugins/reveal-animate/wow.js" type="text/javascript" ></script>
	<script src="<?=$dir;?>kapong/js/scripts/reveal-animate/reveal-animate.js" type="text/javascript" ></script>
	<!-- END: CORE PLUGINS -->

	<!-- BEGIN: LAYOUT PLUGINS -->
	<script src="<?=$dir;?>plugins/revo-slider/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/revo-slider/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/revo-slider/js/extensions/revolution.extension.navigation.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/revo-slider/js/extensions/revolution.extension.video.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/revo-slider/js/extensions/revolution.extension.parallax.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/smooth-scroll/jquery.smooth-scroll.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/typed/typed.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/slider-for-bootstrap/js/bootstrap-slider.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/js-cookie/js.cookie.js" type="text/javascript"></script>
		<!-- END: LAYOUT PLUGINS -->

	<!-- BEGIN: THEME SCRIPTS -->
	<script src="<?=$dir;?>base/js/components.js" type="text/javascript"></script>
	<script src="<?=$dir;?>base/js/components-shop.js" type="text/javascript"></script>
	<script src="<?=$dir;?>base/js/app.js" type="text/javascript"></script>
	<script>
	$(document).ready(function() {
		App.init(); // init core
	});
	</script>
	<!-- END: THEME SCRIPTS -->

	<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.0.0/dist/lazyload.min.js" defer></script>
	<script type="text/javascript">
		$(document).ready(function(){

			var lazyLazy = new LazyLoad({
				elements_selector: ".lazy",
				threshold: 100
			});

	   });
	</script>

	<!-- BEGIN: PAGE SCRIPTS -->
	<script src="<?=$dir;?>kapong/js/scripts/revo-slider/slider-4.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/isotope/isotope.pkgd.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/isotope/imagesloaded.pkgd.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/isotope/packery-mode.pkgd.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/ilightbox/js/jquery.requestAnimationFrame.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/ilightbox/js/jquery.mousewheel.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/ilightbox/js/ilightbox.packed.js" type="text/javascript"></script>
	<script src="<?=$dir;?>kapong/js/scripts/pages/isotope-gallery.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/revo-slider/js/extensions/revolution.extension.parallax.min.js" type="text/javascript"></script>
	<!-- END: PAGE SCRIPTS -->
</body>
</html>
