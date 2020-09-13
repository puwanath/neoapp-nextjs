<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Maintenance | <?=getcomp('companyname');?></title>
  <link rel="apple-touch-icon" href="<?=$url;?>/images/favicon.png">
  <link rel="shortcut icon" href="<?=$url;?>/images/favicon.png">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?=$dir;?>global/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=$dir;?>global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="<?=$dir;?>assets/css/site.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="<?=$dir;?>global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="<?=$dir;?>global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="<?=$dir;?>global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="<?=$dir;?>global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="<?=$dir;?>global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="<?=$dir;?>global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="<?=$dir;?>assets/examples/css/pages/maintenance.css">
  <!-- Fonts -->
  <link rel="stylesheet" href="<?=$dir;?>global/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="<?=$dir;?>global/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <!--[if lt IE 9]>
    <script src="<?//=$dir;?>global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="<?//=$dir;?>global/vendor/media-match/media.match.min.js"></script>
    <script src="<?//=$dir;?>global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="<?=$dir;?>global/vendor/breakpoints/breakpoints.js"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="animsition page-maintenance layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page vertical-align text-xs-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle">
      <i class="icon wb-settings icon-spin page-maintenance-icon" aria-hidden="true"></i>
      <h2>Under Maintenance</h2>
      <p>PLEASE GIVE US A MOMENT TO SORT THINGS OUT</p>
      <footer class="page-copyright">
        <p>Development By Kapong Idea</p>
        <p><?=getcomp('companyname');?> © <?=date('Y');?>. All RIGHT RESERVED.</p>

      </footer>
    </div>
  </div>
  <!-- End Page -->
  <!-- Core  -->
  <script src="<?=$dir;?>global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="<?=$dir;?>global/vendor/jquery/jquery.js"></script>
  <script src="<?=$dir;?>global/vendor/tether/tether.js"></script>
  <script src="<?=$dir;?>global/vendor/bootstrap/bootstrap.js"></script>
  <script src="<?=$dir;?>global/vendor/animsition/animsition.js"></script>
  <script src="<?=$dir;?>global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="<?=$dir;?>global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="<?=$dir;?>global/vendor/asscrollable/jquery-asScrollable.js"></script>
  <!-- Plugins -->
  <script src="<?=$dir;?>global/vendor/switchery/switchery.min.js"></script>
  <script src="<?=$dir;?>global/vendor/intro-js/intro.js"></script>
  <script src="<?=$dir;?>global/vendor/screenfull/screenfull.js"></script>
  <script src="<?=$dir;?>global/vendor/slidepanel/jquery-slidePanel.js"></script>
  <!-- Scripts -->
  <script src="<?=$dir;?>global/js/State.js"></script>
  <script src="<?=$dir;?>global/js/Component.js"></script>
  <script src="<?=$dir;?>global/js/Plugin.js"></script>
  <script src="<?=$dir;?>global/js/Base.js"></script>
  <script src="<?=$dir;?>global/js/Config.js"></script>
  <script src="<?=$dir;?>assets/js/Section/Menubar.js"></script>
  <script src="<?=$dir;?>assets/js/Section/Sidebar.js"></script>
  <script src="<?=$dir;?>assets/js/Section/PageAside.js"></script>
  <script src="<?=$dir;?>assets/js/Plugin/menu.js"></script>
  <!-- Config -->
  <script src="<?=$dir;?>global/js/config/colors.js"></script>
  <script src="<?=$dir;?>assets/js/config/tour.js"></script>
  <script>
  Config.set('assets', '<?=$dir;?>assets');
  </script>
  <!-- Page -->
  <script src="<?=$dir;?>assets/js/Site.js"></script>
  <script src="<?=$dir;?>global/js/Plugin/asscrollable.js"></script>
  <script src="<?=$dir;?>global/js/Plugin/slidepanel.js"></script>
  <script src="<?=$dir;?>global/js/Plugin/switchery.js"></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>
