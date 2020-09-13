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
	<!--ออกแบบและพัฒนาโดย นายภูวนาท  ใบบัว  start development   new version development 01/03/63-->

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?=$dir;?>plugins/socicon/socicon.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/animate/animate.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->

	<script src="<?=$dir;?>plugins/jquery.min.js" type="text/javascript" ></script>

	<?php
	if(count($cssarr)>0):
	foreach ($cssarr as $value) {
		echo $value;
	}
	endif;


	// condition Header fullscreen
	if($get_part0=='' or $get_part0=='welcome'){
		// $getdevice = detectDevice();
		// if($getdevice!="Computer"){
			$fullpage = 'c-layout-header-fullscreen';
		// }else{
			// $fullpage = '';
		// }

	}else{
		$fullpage = '';
	}
	?>
</head>
<body class="c-layout-header-fixed c-layout-header-mobile-fixed <?php echo $fullpage;?>">

	<!-- BEGIN: LAYOUT/HEADERS/HEADER-ONEPAGE -->
	<!-- BEGIN: HEADER -->
	<?php include('views/layout/header.php');?>
	<!-- END: HEADER -->
	<!-- END: LAYOUT/HEADERS/HEADER-ONEPAGE -->



	<!-- BEGIN: PAGE CONTAINER -->
	<div class="c-layout-page">
		<!-- BEGIN: PAGE CONTENT -->
		<?php
		foreach($content as $p){
			include($p);
		}
		?>
	</div>
	<!-- END: PAGE CONTAINER -->

	<!-- BEGIN: LAYOUT/FOOTERS/FOOTER-8 -->
	<?php include('views/layout/footer.php');?>
	<!-- END: LAYOUT/FOOTERS/FOOTER-8 -->

	<!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
	<div class="c-layout-go2top">
		<i class="icon-arrow-up"></i>
	</div>
	<!-- END: LAYOUT/FOOTERS/GO2TOP -->

	<!-- BEGIN: BASE PLUGINS  -->
	<link href="<?=$dir;?>plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/revo-slider/css/layers.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/revo-slider/css/navigation.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>plugins/slider-for-bootstrap/css/slider.css" rel="stylesheet" type="text/css"/>
		<!-- END: BASE PLUGINS -->

    <!-- BEGIN THEME STYLES -->
	<link href="<?=$dir;?>demos/default/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>demos/default/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="<?=$dir;?>demos/default/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css"/>
	<link href="<?=$dir;?>demos/default/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->

	<!-- BEGIN: LAYOUT/BASE/BOTTOM -->
  <!-- BEGIN: CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="<?=$dir;?>global/plugins/excanvas.min.js"></script>
	<![endif]-->

	<script src="<?=$dir;?>plugins/jquery-migrate.min.js" type="text/javascript" ></script>
	<script src="<?=$dir;?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
	<script src="<?=$dir;?>plugins/jquery.easing.min.js" type="text/javascript" ></script>
	<script src="<?=$dir;?>plugins/reveal-animate/wow.js" type="text/javascript" ></script>
	<script src="<?=$dir;?>demos/default/js/scripts/reveal-animate/reveal-animate.js" type="text/javascript" ></script>
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
	<script src="<?=$dir;?>plugins/isotope/isotope.pkgd.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/isotope/imagesloaded.pkgd.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/isotope/packery-mode.pkgd.min.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/ilightbox/js/jquery.requestAnimationFrame.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/ilightbox/js/jquery.mousewheel.js" type="text/javascript"></script>
	<script src="<?=$dir;?>plugins/ilightbox/js/ilightbox.packed.js" type="text/javascript"></script>
	<script src="<?=$dir;?>demos/default/js/scripts/pages/isotope-gallery.js" type="text/javascript"></script>
	<script src="<?=$dir;?>base/js/app.js" type="text/javascript"></script>
	<script>
	$(document).ready(function() {
		App.init(); // init core
	});
	</script>
	<!-- END: THEME SCRIPTS -->
	<!-- BEGIN: PAGE SCRIPTS -->
	<script src="<?=$dir;?>demos/default/js/scripts/revo-slider/slider-12.js" type="text/javascript"></script>
	<!-- END: PAGE SCRIPTS -->
	<!-- END: LAYOUT/BASE/BOTTOM -->

	<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.0.0/dist/lazyload.min.js" defer></script>
	<script type="text/javascript">
		$(document).ready(function(){

			var lazyLazy = new LazyLoad({
				elements_selector: ".lazy",
				threshold: 100
			});

	   });
	</script>
	<script type="text/javascript">
	(function($, window, document, undefined) {
	  'use strict';

	  // init cubeportfolio
	  $('#grid-container').cubeportfolio({
	      filters: '#filters-container',
	      defaultFilter: '.googlemap',
	      animationType: 'sequentially',
	      gridAdjustment: 'responsive',
	      displayType: 'default',
	      caption: 'expand',
	      mediaQueries: [{
	          width: 1,
	          cols: 1
	      }],
	      gapHorizontal: 0,
	      gapVertical: 0
	  });

	})(jQuery, window, document);
	</script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9_6ATqCVgB1zlz1u-bMGp9Sd6ClfZIjE"></script>
	<script type="text/javascript">
		window.onload = function () {
				initMap();
		};

		var map;
		var marker;
	  var markers = [];
		function initMap() {

			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: <?=getcontact('contact_location_zoom');?>,
	      mapTypeId: google.maps.MapTypeId.ROADMAP,
				center: {lat: <?=getcontact('contact_location_lat');?>, lng: <?=getcontact('contact_location_lon');?>}
			});

			var infowindow = new google.maps.InfoWindow();

	    var image = '<?=$url;?>/images/marker.png';
	    markers.push(new google.maps.Marker({
	      position: {lat: <?=getcontact('contact_location_lat');?>, lng: <?=getcontact('contact_location_lon');?>},
	      map: map,
	      icon: image
	    }));


		}

	</script>

</body>
</html>
