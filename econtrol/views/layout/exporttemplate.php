<!-- Required meta tags -->
<meta charset="utf-8">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" name="viewport">
<style type="text/css">
body {
    margin: 0;
    padding: 0;
    font-family:Arial, "times New Roman", tahoma;
    font-size:12px;
    background-color: transparent !important;
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

.headTitle {
    font-size:12px;
    font-weight:bold;
    text-transform:uppercase;
}
.headerTitle01 {
    border:1px solid #333333;
    background-color: yellow;
    border-left:1px solid #000;
    border-bottom-width:1px;
    border-top-width:1px;
    font-size:12px;
    font-weight: 600;
}
.headerTitle01_r {
    border:1px solid #333333;
    background-color: yellow;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom-width:1px;
    border-top-width:1px;
    font-size:12px;
    font-weight: 600;
}
/* สำหรับช่องกรอกข้อมูล  */
.box_data1 {
    font-family:Arial, "times New Roman", tahoma;
    height:18px;
    border:0px dotted #333333;
    border-bottom-width:1px;
}
/* กำหนดเส้นบรรทัดซ้าย  และด้านล่าง */
.left_bottom {
    border-left:1px solid #000;
    border-bottom:1px solid #000;
}
/* กำหนดเส้นบรรทัดซ้าย ขวา และด้านล่าง */
.left_right_bottom {
    border-left:1px solid #000;
    border-bottom:1px solid #000;
    border-right:1px solid #000;
}
/* สร้างช่องสี่เหลี่ยมสำหรับเช็คเลือก */
.chk_box {
    display:block;
    width:10px;
    height:10px;
    overflow:hidden;
    border:1px solid #000;
}
/* css ส่วนสำหรับการแบ่งหน้าข้อมูลสำหรับการพิมพ์ */
@media all
{
    .page-break { display:none; }
    .page-break-no{ display:none; }
}
@media print
{
    .page-break { display:block;height:1px; page-break-before:always; }
    .page-break-no{ display:block;height:1px; page-break-after:avoid; }
}
</style>
<!-- Meta -->
<meta name="description" content="OSP PLAZA Management Develop By puwanath baibua">
<meta name="author" content="puwanath baibua">
<link rel="shortcut icon" href="<?=$url;?>/images/favicon.png" />
<link rel="icon" type="image/x-icon" href="<?=$url;?>/images/favicon.png" />
<link rel="stylesheet" href="<?=$dir;?>css/bracket.css" type="text/css">
<link rel="stylesheet" href="<?=$dir;?>css/styles.css" type="text/css">
<script src="<?=$dir;?>lib/jquery/jquery.js"></script>
<style type="text/css">
  body{
    color:#000 !important;
  }
</style>
<?php
//load css
if(count($cssarr)>0):
foreach ($cssarr as $value) {
  echo $value;
}
endif;

//load content
include($content);

//load js
if(count($jsarr)>0):
foreach ($jsarr as $value) {
  echo $value;
}
endif;
?>
<script type="text/javascript">
$(function(){
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
});
</script>
