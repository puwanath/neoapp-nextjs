<?php
session_start();
if($_GET['lg']!=''):

$uri = $_GET['uri'];

$_SESSION['lg'] = $_GET['lg'];

header("Location: $uri");    
exit();


endif;
?>