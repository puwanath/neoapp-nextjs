<?php
require_once 'vendor/autoload.php';

// $mpdf = new \Mpdf\Mpdf();
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path']);
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();

?>
