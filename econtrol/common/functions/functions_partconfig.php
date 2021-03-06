<?php
function parse_path() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);

    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
    $path['call_parts'] = explode('/', $path['call']);

    $path['query_utf8'] = urldecode($request_path[1]);
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
  }
return $path;
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"]."/neo.co.th/econtrol";
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"]."/neo.co.th/econtrol";   //แก้ไข part
  //$pageURL .= $_SERVER["SERVER_NAME"]."/ชื่อพาร์ทของคุณ/backoffice";   //แก้ไข part
 }
 return $pageURL;
}

function curPageURLWeb() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"]."/neo.co.th";
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"]."/neo.co.th";   //แก้ไข part
  //$pageURL .= $_SERVER["SERVER_NAME"]."/ชื่อพาร์ทของคุณ/backoffice";   //แก้ไข part
 }
 return $pageURL;
}

$path_info = parse_path();
//echo '<pre>'.print_r($path_info, true).'</pre>';
$dir= curPageURL()."/assets/";
$url= curPageURL()."/";
?>
