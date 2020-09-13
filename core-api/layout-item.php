<?php
session_start();
if($_GET['l']!=''):

$uri = $_GET['uri'];

$_SESSION['l'] = $_GET['l'];

header("Location: $uri");
exit();


endif;
?>
