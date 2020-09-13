<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" name="viewport">
		<title><?php echo $pagename;?> | <?php echo getcomp('companyname');?></title>
    <!-- Meta -->
    <meta name="description" content="Backend Website Management">
    <meta name="author" content="Kapong Idea">

    <!-- vendor css -->
    <link href="<?=$dir;?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=$dir;?>lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="<?=$dir;?>open-iconic-master/font/css/open-iconic-bootstrap.min.css" rel="stylesheet">
    <link href="<?=$dir;?>lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?=$dir;?>lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="<?=$dir;?>lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="<?=$dir;?>lib/chartist/chartist.css" rel="stylesheet">
    <!-- <link href="<?=$dir;?>lib/jt.timepicker/jquery.timepicker.css" rel="stylesheet"> -->
    <link href="<?=$dir;?>lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="<?=$dir;?>lib/datatables-responsive/responsive.dataTables.min.css" rel="stylesheet">
    <link href="<?=$dir;?>toastr-master/build/toastr.css" rel="stylesheet" type="text/css" />
    <link href="<?=$dir;?>dist/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?=$dir;?>editor/jodit.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?=$url;?>/images/favicon.png" />
    <link rel="icon" type="image/x-icon" href="<?=$url;?>/images/favicon.png" />

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?=$dir;?>css/bracket.css" type="text/css">
    <link rel="stylesheet" href="<?=$dir;?>css/styles.css" type="text/css">
    <link rel="stylesheet" href="<?=$dir;?>thbank-font/css/thbanklogos.min.css" id="stylesheet">
		<style type="text/css">
      #showSubLeft{
        position: absolute;
        z-index: 99;
        height: 90px;
        width: 100px;
        left: -60px;
        top: 50%;
      }

      #showSubLeft i{
        text-align: right;
        position: absolute;
        right: 10px;
        top: 33px;
        font-size: 25px;
      }

		</style>

    <script type="text/javascript" src="<?=$dir;?>lib/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?=$dir;?>lib/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?=$dir;?>lib/datatables-responsive/dataTables.responsive.js"></script>
    <script type="text/javascript" src="<?=$dir;?>lib/moment/moment.js"></script>

    <?php
    if(count($cssarr)>0):
    foreach ($cssarr as $value) {
      echo $value;
    }
    endif;
    ?>

  </head>
  <!-- <body class="<?//php if($classpage==1){ echo "collapsed-menu with-subleft";}else{ echo $_SESSION['class'];}?>"> -->
  <body class="<?php if($_SESSION['class']){echo $_SESSION['class'];}else{ echo $classpage;}?>">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include('views/layout/menu_leftpanel.php');?>
    <!-- ########## END: LEFT PANEL ########## -->
    <!-- ########## START: HEAD PANEL ########## -->
    <?php include('views/layout/menu_headpanel.php');?>
    <!-- ########## END: HEAD PANEL ########## -->
    <!-- ########## START: RIGHT PANEL ########## -->
    <?php include('views/layout/menu_rightpanel.php');?>
    <!-- ########## END: RIGHT PANEL ########## --->
    <!-- ########## START: MAIN PANEL ########## -->
    <?php include($content);?>
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="<?=$dir;?>lib/popper.js/popper.js"></script>
    <script src="<?=$dir;?>lib/bootstrap/bootstrap.js"></script>
    <script src="<?=$dir;?>lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="<?=$dir;?>lib/jquery-ui/jquery-ui.js"></script>
    <script src="<?=$dir;?>lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="<?=$dir;?>lib/peity/jquery.peity.js"></script>
    <script src="<?=$dir;?>lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
    <script src="<?=$dir;?>lib/d3/d3.js"></script>
    <script src="<?=$dir;?>lib/rickshaw/rickshaw.min.js"></script>
    <!-- <script src="<?=$dir;?>lib/jt.timepicker/jquery.timepicker.js"></script> -->
    <script src="<?=$dir;?>toastr-master/toastr.js"></script>
    <script src="<?=$dir;?>editor/jodit.min.js"></script>
		<script src="<?=$dir;?>dist/sweetalert-dev.js"></script>

     <div id="waitajax">
       <div class="iconload">
         <img src='<?=$url;?>/images/loading.svg' /><br>กรุณารอสักครู่..
       </div>
     </div>
    <?php
    if(count($jsarr)>0):
    foreach ($jsarr as $value) {
      echo $value;
    }
    endif;
    ?>

    <script src="<?=$dir;?>js/bracket.js"></script>
    <script src="<?=$dir;?>js/ResizeSensor.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $(document).ajaxStart(function(){
            $("#waitajax").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $("#waitajax").css("display", "none");
        });
      });
    </script>
    <style type="text/css">
      #waitajax{
        z-index: 999;
        display: none;
        position: fixed;
        margin: 0 auto;
        text-align: center;
        color: #000;
        /*background-color: rgba(0, 0, 0, 0.38);*/
        height: calc(100% - 0px);
        width: 100%;
        top: 0;
        left: 0;
        height: 100%;
      }

      #waitajax .iconload{
        position: relative;
        display: inline-block;
        justify-content: center;
        align-items: center;
        text-align: center;
        color:#000;
        top:50%;
        width: 100%;
      }

    </style>

    <script type="text/javascript">
      //  start texteditor
      new Jodit('#edit', {
        enableDragAndDropFileToEditor: true,
        uploader: {
          url: '<?=$url;?>/upload?select=upload',
          filesVariableName: 'images',
          process: function (resp) {
            var i, images = resp[this.options.uploader.filesVariableName] || [];
            if (images.length) {
              for (i = 0;i < images.length; i += 1) {
                images[i] = '/' + images[i]
              }
            }
            this.events.fire('errorPopap', ['Files ' + images.join(',') + ' were uploaded', 'success']);
            return {
              files: images,
              path: 'images/',
              baseurl: '<?=curPageURLweb();?>',
              error: resp.error,
              msg: resp.msg
            };
          },
        },
        filebrowser: {
            ajax: {
                url: '<?=$url;?>/upload?select=readimg',
                process: function (resp) {
                    resp.baseurl = '<?=curPageURLweb();?>/images/';
                    return resp;
                },
            }
        }
      });

      new Jodit('#edit2', {
        enableDragAndDropFileToEditor: true,
        uploader: {
          url: '<?=$url;?>/upload?select=upload',
          filesVariableName: 'images',
          process: function (resp) {
            var i, images = resp[this.options.uploader.filesVariableName] || [];
            if (images.length) {
              for (i = 0;i < images.length; i += 1) {
                images[i] = '/' + images[i]
              }
            }
            this.events.fire('errorPopap', ['Files ' + images.join(',') + ' were uploaded', 'success']);
            return {
              files: images,
              path: 'images/',
              baseurl: '<?=curPageURLweb();?>',
              error: resp.error,
              msg: resp.msg
            };
          },
        },
        filebrowser: {
            ajax: {
                url: '<?=$url;?>/upload?select=readimg',
                process: function (resp) {
                    resp.baseurl = '<?=curPageURLweb();?>/images/';
                    return resp;
                },
            }
        }
      });


      var editor = new Jodit('.edit-box', {
        enableDragAndDropFileToEditor: true,
        uploader: {
          url: '<?=$url;?>/upload?select=upload',
          filesVariableName: 'images',
          process: function (resp) {
            var i, images = resp[this.options.uploader.filesVariableName] || [];
            if (images.length) {
              for (i = 0;i < images.length; i += 1) {
                images[i] = '/' + images[i]
              }
            }
            this.events.fire('errorPopap', ['Files ' + images.join(',') + ' were uploaded', 'success']);
            return {
              files: images,
              path: 'images/',
              baseurl: '<?=curPageURLweb();?>',
              error: resp.error,
              msg: resp.msg
            };
          },
        },
        filebrowser: {
            ajax: {
                url: '<?=$url;?>/upload?select=readimg',
                process: function (resp) {
                    resp.baseurl = '<?=curPageURLweb();?>/images/';
                    return resp;
                },
            }
        }
      });

      var editor2 = new Jodit('.edit-box2', {
        enableDragAndDropFileToEditor: true,
        uploader: {
          url: '<?=$url;?>/upload?select=upload',
          filesVariableName: 'images',
          process: function (resp) {
            var i, images = resp[this.options.uploader.filesVariableName] || [];
            if (images.length) {
              for (i = 0;i < images.length; i += 1) {
                images[i] = '/' + images[i]
              }
            }
            this.events.fire('errorPopap', ['Files ' + images.join(',') + ' were uploaded', 'success']);
            return {
              files: images,
              path: 'images/',
              baseurl: '<?=curPageURLweb();?>',
              error: resp.error,
              msg: resp.msg
            };
          },
        },
        filebrowser: {
            ajax: {
                url: '<?=$url;?>/upload?select=readimg',
                process: function (resp) {
                    resp.baseurl = '<?=curPageURLweb();?>/images/';
                    return resp;
                },
            }
        }
      });



      // text editor jodit


      $(function(){
        'use strict'

        /*===============================##====================================*/
        /*=============================##==##==================================*/
        /*===============================##====================================*/
        $( document ).ajaxComplete(function( event,request, settings ) {
      			if (request.responseText == 'LOGIN_REQUIRED') {
      				window.location.href = '<?php echo $_SESSION['login_return_url'];?>'
      			}
      	});
        /*===============================##====================================*/
        /*=============================##==##==================================*/
        /*===============================##====================================*/

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function(){
          minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
          if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
          } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
          }
        }

        // Showing sub left menu
        $('#showSubLeft').on('click', function(){
          if($('body').hasClass('show-subleft')) {
            $('body').removeClass('show-subleft');
          } else {
            $('body').addClass('show-subleft');
          }
        });

        $(".btnshownotifi").on('click',function(e){
          loadNotify();
        })


        $('#datepicker').datepicker({
            numberOfMonths: [1, 1],
            beforeShowDay: highlightDays
        }).click(function() {
            $('.ui-datepicker-today a', $(this).next()).removeClass('ui-state-highlight ui-state-hover');
            $('.highlight a', $(this).next()).addClass('ui-state-highlight');
        });

      });

      var dates = [new Date(2011, 9 - 1, 19),
             new Date(2011, 9 - 1, 20),
             new Date(2011, 9 - 1, 21),
             new Date(2011, 10 - 1, 31)];

      function highlightDays(date) {
          for (var i = 0; i < dates.length; i++) {
              if (dates[i].getTime() == date.getTime()) {
                  return [true, 'highlight'];
              }
          }
          return [true, ''];
      }

      $(document).ready(function(){
        $('#btnRightMenu').on('click',function(e){

          loadUseronline();
          loadUseroffline();


        });

        $('#btnLeftMenu').on('click',function(e){
          setMenuleft();
        });
      });

      function loadNotify(){
        $.ajax({
           type: "GET",
           async: false,
           url: "<?=$url;?>/notify",
           data: {select: 'loadnotify'},
           dataType: "json",
           success: function(data) {

            $("#div_shownotify").empty();
            $("#div_shownotify").html(data);

           }
        });
      }

      function loadUseronline(){
        $.ajax({
           type: "GET",
           async: false,
           url: "<?=$url;?>/notify",
           data: {select: 'loaduseronline'},
           dataType: "json",
           success: function(data) {

            $("#div_useronline").empty();
            $("#div_useronline").html(data);

           }
        });
      }
      function loadUseroffline(){
        $.ajax({
           type: "GET",
           async: false,
           url: "<?=$url;?>/notify",
           data: {select: 'loaduseroffline'},
           dataType: "json",
           success: function(data) {

            $("#div_useroffline").empty();
            $("#div_useroffline").html(data);

           }
        });
      }
      function setMenuleft(){
        $.ajax({
          type: "POST",
          async: false,
          url: "<?=$url;?>/setmenuleft.php",
          // data: {select: 'loaduseroffline'},
          dataType: "json",
          success: function(data) {
           console.log(data.status);
          }
        });
      }

    </script>
  </body>
</html>
