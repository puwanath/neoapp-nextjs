<?php
#################### Db Connect
#กำหนด class การเชื่อมต่อ DB
$dbLocation = "localhost";//ที่อยู่ของฐานข้อมูล
$dbUser = "root";//ชื่อ User
$dbPass = "";//รหัสผ่าน
$dbName = "db_kpi_demo";//ชื่อฐานข้อมูล
$privatesession = md5("kapongidea"); //ตัวแปรกำหนด ชื่อ session

@$dbCon = new mysqli($dbLocation,$dbUser,$dbPass,$dbName);//เชื่อมต่อฐานข้อมูล
$dbCon->set_charset("utf8");//กำหนด charset เป็น utf8
if(mysqli_connect_errno()){
	echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ"." ".mysqli_connect_error();
	exit();
}
#################### End Db Connect



?>
