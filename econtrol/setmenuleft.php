<?php
session_start();
if($_SESSION['classnum']=='close'){
  // unset($_SESSION['class']);
  $_SESSION['class']='with-subleft';
  $_SESSION['classnum']='open';
}else{
  $_SESSION['class']='collapsed-menu with-subleft';
  $_SESSION['classnum']='close';
}
$mixsession = $_SESSION['class'].'-'.$_SESSION['classnum'];
echo json_encode(array('status'=>$_SESSION['class']));
?>
