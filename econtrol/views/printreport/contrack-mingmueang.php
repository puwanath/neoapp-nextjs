<?php
$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once 'vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$url = urldecode($_REQUEST['url']);
$urlsys = curPageURL();

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

// $mpdf = new \Mpdf\Mpdf();
$mpdf = new \Mpdf\Mpdf([
  'tempDir' => __DIR__ . '/custom/temp/dir/path',
  'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'thsarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew-Italic.ttf',
            'B' => 'THSarabunNew-Bold.ttf',
        ]
    ],
    'default_font' => 'thsarabun',
    'setAutoTopMargin' => 'stretch',
    'autoMarginPadding' => 0,
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_top' => 5,
    'margin_bottom' => 5,
  	'margin_left' => 5,
  	'margin_right' => 5,
  	'mirrorMargins' => true,
    'margin_header' => 10,
	  'margin_footer' => 10
]);

$content = '
<style>
.container{
    font-family: "THSarabun";
    font-size: 12pt;
    padding:0px;
}
p{
  font-family: "THSarabun";
  text-align: justify;
}
h1{
  font-family: "THSarabun";
  text-align: center;
}

table{
  font-size: 12pt;
}

.table1{
  width:100px;
  border-collapse: collapse;
}

.table1 tr td{
  padding:2px;
  border:1px solid #000;
}

.table2{
  width:100px;
  border-collapse: collapse;
}

.table2 tr td{
  padding:0px;
  border:0px;
}

</style>';

$content.='<div class="container">';
$content.='<div style="height:100vh;">';
$content.='<table style="width:100%;" border="0">';
$content.='<tr>';
$content.='<td align="center" colspan="10" nowrap="nowrap">
  <div style="font-size:20px;margin-top:10px;"><b>บันทึกข้อตกลงการขอใช้พื้นที่ลาน OTOP ศูนย์การค้า ดิโอลด์ สยาม พลาซ่า</b></div>
  <div><b>8/6-7 อาคารดิโอลด์สยามพลาซ่า ถ.บูรพาภิรมร์ เขตพระนคร กรุงเทพมหานคร</b></div>
  <div><b>โทร. 02-2260156-8  โทรสาร 02-2260159  เลขที่ผู้เสียภาษี 0105530058476</b></div>
</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td>เลขที่สัญญา</td>';
$content.='<td style="width:5px;"></td>';
$content.='<td colspan="3"><b>6109001</b></td>';
$content.='<td colspan="2"></td>';
$content.='<td width="50"></td>';
$content.='<td width="40"></td>';
$content.='<td nowrap="nowrap" style="width:150px;">
  <div style="float:right;">
    <div style="text-align:left;">ทำที่ ดิ โอลด์ สยาม พลาซ่า</div>
    <div style="text-align:left;">19 กันยนยน 2018</div>
  </div>
</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td nowrap="nowrap" colspan="2">ชื่อผู้ขอใช้พื้นที่</td>';
$content.='<td nowrap="nowrap" style="text-align:left;width:100px;"><b>ภูวนาท  ใบบัว</b></td>';
$content.='<td nowrap="nowrap" style="width:100px;text-align:center;">บัตรประชาชน </td>';
$content.='<td nowrap="nowrap" style="padding-left:5px;padding-right:5px;width:100px;"><b>1 3299 00240 38 9</b> </td>';
$content.='<td nowrap="nowrap" style="width:100px;text-align:center;">อยู่บ้านเลขที่ </td>';
$content.='<td colspan="4" nowrap="nowrap" style="padding-left:5px;width:380px;">313/378 สินธนาคอนโด ซ.นวมินทร์ 54 ถ.นวมินทร์ แขวงคลองกุ่ม เขตบึงกุ่ม กรุงเทพฯ 10230</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td nowrap="nowrap" colspan="6">โดยผู้ขอใช้พื้นที่ให้สัญญาต่อ บริษัท สยามสินธร จำกัด ดังนี้ :-</td>';
$content.='<td colspan="4" nowrap="nowrap" style="padding-left:5px;">Tel. 089-520-0321</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="3">1. ผู้ขอใช้พื้นที่ขอใช้พื้นที่ร่วมแสดงสินค้าในงาน</td>';
$content.='<td nowrap="nowrap" style="padding-left:5px;"><b>OT61007</b></td>';
$content.='<td colspan="5" nowrap="nowrap"></td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="4">2. ผู้ขอใช่พื้นที่ตกลงขอใช้พื้นที่เป็นเวลา 31 วัน</td>';
$content.='<td colspan="5" nowrap="nowrap" style="padding-left:10px;"></td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" style="padding-left:5px;text-align:center;"> วันก่อสร้างคูหา</td>';
$content.='<td nowrap="nowrap" style="padding-left:0px;width:80px;text-align:center;">30 มิถุนายน 2018</td>';
$content.='<td nowrap="nowrap" style="text-align:center;"> วันที่แสดงสินค้า</td>';
$content.='<td nowrap="nowrap" style="padding-left:0px;text-align:center;">1 กรกฏาคม 2018</td>';
$content.='<td nowrap="nowrap" style="text-align:center;width:100px;"> วันที่รื้อถอน</td>';
$content.='<td nowrap="nowrap" style="padding-left:0px;" colspan="3">31 กรกฏาคม 2018</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">3. ผู้ขอใช้พื้นที่จะใช้สถานที่เพื่อจำหน่ายสินค้า/บริการประเภท <b style="padding-left:20px;">ของตกแต่งบ้าน ดอกไม้ ต้นไม้ เซรามิก ของจัดสวน</b></td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">4. ผู้ขอใช้พื้นที่บริเวณลานมิ่งเมืองในหมายเลขบูธที่ระบุและใช้สถานที่จัดแสดงสินค้าสูงได้ไม่เกินที่กำหนด  ไม่ว่าจะเป็นการจัดวางสินค้า ตาข่าย ตู้โชว์ หรือวัสดุอื่นใด<br/>
	&nbsp;&nbsp;&nbsp;&nbsp;กรณีร้านค้ามีความประสงค์จะใช่โชว์และ/หรือ เสาสูงเพื่อโชว์สินค้า สามารถตั้งหุ่นโชว์ได้ไม่เกินบูธละ 2 ตัว สูงได้ไม่เกิน 1.90 เมตร  และเสาสูงโชว์สินค้าไม่เกินบูธละ 2 เสา<br/>
  &nbsp;&nbsp;&nbsp;&nbsp;แขวนสินค้าได้เสาละ 2 ชิ้น สูงได้ไม่เกิน 2.00 เมตร</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td colspan="10">
<table class="table1" style="width:100%;">
  <tr>
    <td style="text-align:center">บูธ</td>
    <td style="text-align:center">วันที่เริ่มเช่า</td>
    <td style="text-align:center">วันที่สิ้นสุดการเช่า</td>
    <td style="text-align:center">ความสูงของบูธ (เมตร)</td>
    <td style="text-align:center">จำนวนวันการเช่า</td>
    <td style="text-align:center">กำลังไฟฟ้า (วัตต์)</td>
    <td style="text-align:center">จำนวนเงินค่าไฟฟ้า</td>
    <td style="text-align:center">ราคาค่าเช่าบูธ ต่อวัน</td>
    <td style="text-align:center">ส่วนลด (ร้อยละ)</td>
    <td style="text-align:center">จำนวนเงินค่าเช่าบูธ</td>
  </tr>
  <tr>
    <td style="text-align:center;">T02</td>
    <td style="text-align:center;">1 ก.ค. 18</td>
    <td style="text-align:center;">31 ก.ค. 18</td>
    <td style="text-align:center;"></td>
    <td style="text-align:center;">31</td>
    <td style="text-align:center;"></td>
    <td style="text-align:center;"></td>
    <td style="text-align:right;">500.00</td>
    <td style="text-align:right;"></td>
    <td style="text-align:right;">15,500.00</td>
  </tr>
  <tr>
    <td style="text-align:right;border:0px;" colspan="6"><b>รวมค่าไฟฟ้าทั้งหมด</b></td>
    <td style="text-align:right;"><b>0.00</b></td>
    <td style="text-align:right;border:0px;" colspan="2"><b>ค่าเช่าบูธทั้งหมด รวม VAT 7%</b></td>
    <td style="text-align:right;"><b>15,500.00</b></td>
  </tr>
</table>
</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">5. ค่าบริการใช้พื้นที่  ผู้ขอใช้พื้นที่ตกลงจะชำระให้แก่บริษัท เป็นงวดดังนี้ :-</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td colspan="10">
<table class="table1" style="width:100%;">
  <tr>
    <td style="text-align:center">งวดชำระครั้งที่</td>
    <td style="text-align:center">ชำระภายใน</td>
    <td style="text-align:center">ร้อยละของค่าเช่าทั้งหมด</td>
    <td style="text-align:center">จำนวนเงินค่าเช่า</td>
  </tr>
  <tr>
    <td style="text-align:center;">1</td>
    <td style="text-align:center;">30 มิถุนายน 2018</td>
    <td style="text-align:center;">50.00</td>
    <td style="text-align:right;">7,750.00</td>
  </tr>
  <tr>
    <td style="text-align:center;">2</td>
    <td style="text-align:center;">12 กรกฏาคม 2018</td>
    <td style="text-align:center;">50.00</td>
    <td style="text-align:right;">7,750.00</td>
  </tr>
  <tr>
    <td style="text-align:right;border:0px;" colspan="3"><b>รวมทั้งหมด</b></td>
    <td style="text-align:right;"><b>15,500.00</b></td>
  </tr>
</table>
</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">6. อุปกรณ์ที่ผู้เช่าพื้นที่ขอยืมใช้</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="7">
  <table class="table1" style="width:100%;">
    <tr>
      <td style="text-align:center;">บูธ</td>
      <td style="text-align:center;">โต๊ะขาว(ตัว)</td>
      <td style="text-align:center;">เสาเหล็ก(ต้น)</td>
      <td style="text-align:center;">เก้าอี้พลาสติก(ตัว)</td>
    </tr>
    <tr>
      <td style="text-align:center;">T02</td>
      <td style="text-align:center;"></td>
      <td style="text-align:center;"></td>
      <td style="text-align:center;"></td>
    </tr>
  </table>
</td>';
$content.='<td></td>';
$content.='<td></td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">7. การใช้ไฟฟ้าในการแสดงทางศูนย์ระบุให้ใช้ได้ไม่เกิน 500 วัตต์ ต่อ 1 บูธ หากใช้เกินกำหนด ต้องชำระเพิ่มค่าไฟฟ้าในอัตราเหมาตลอดระยะเวลาเข้าร่วมสินค้าโดย</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="7">
  <table class="table2" style="width:100%;">
    <tr>
      <td style="text-align:center;">จำนวนไฟฟ้าที่ใช้รวมทั้งหมด (วัตต์)</td>
      <td style="text-align:center;">ชำระเพิ่มเติมต่อวัน(บาท)</td>
      <td style="text-align:center;">จำนวนไฟฟ้าที่ใช้รวมทั้งหมด(วัตต์)</td>
      <td style="text-align:center;">ชำระเพิ่มต่อวัน(บาท)</td>
    </tr>
    <tr>
      <td style="text-align:center;">501-600</td>
      <td style="text-align:center;">30</td>
      <td style="text-align:center;">901-1000</td>
      <td style="text-align:center;">50</td>
    </tr>
    <tr>
      <td style="text-align:center;">601-700</td>
      <td style="text-align:center;">35</td>
      <td style="text-align:center;">1001-1500</td>
      <td style="text-align:center;">100</td>
    </tr>
    <tr>
      <td style="text-align:center;">701-800</td>
      <td style="text-align:center;">40</td>
      <td style="text-align:center;">1501-4500</td>
      <td style="text-align:center;">200</td>
    </tr>
    <tr>
      <td style="text-align:center;">801-900</td>
      <td style="text-align:center;">45</td>
      <td style="text-align:center;">4501-8500</td>
      <td style="text-align:center;">265</td>
    </tr>
  </table>
</td>';
$content.='<td></td>';
$content.='<td></td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9" style="width:700px;">&nbsp;&nbsp;&nbsp;&nbsp;กรณีท่านชำระค่าไฟฟ้าตามอัตราที่ศูนย์กำหนดในวันจองพื้นที่ หากตรวจพบภายหลังว่่าท่านใช้เกินจากที่ท่านได้ชำระไว้แล้วจะถูกปรับค่าไฟฟ้าเป็น 2 เท่า ของอัตราที่กำหนดในราคาเหมาตลอดทั้งงาน</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">8. เวลาเปิด-ปิด ร้านค้าภายในศูนย์ 9.00-20.00 น. หากท่านเปิด-ปิด เวลาไม่ตามกำหนดของศูนย์ ทางศูนย์จะทำการปรับ 200 บาท/วัน</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">9. กรณีที่ท่านไม่ปฏิบัติตามเงื่อนไขด้านล่างนี้</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">&nbsp;&nbsp;&nbsp;&nbsp; 9.1 ไม่ชำระเงินภายในกำหนด</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">&nbsp;&nbsp;&nbsp;&nbsp; 9.2 ประเภทสินค้าที่นำมาแสดง ไม่ตรงกับที่ระบุในบันทึกข้อตกลงการใช้พื้นที่</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">&nbsp;&nbsp;&nbsp;&nbsp; 9.3 จัดวางสินค้าเกินแนวเขตพื้นที่ที่กำหนด (ห้ามเกินแนวเส้นสีแดงที่ศูนย์กำหนด)</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9" >&nbsp;&nbsp;&nbsp;&nbsp; 9.4 ผู้ขอใช้พื้นที่สัญญาว่า ผู้ขอใช้พื้นที่จะใช้พื้นที่เช่าเพื่อประกอบธุรกิจตามวัตถุประสงค์ที่ระบุไว้ในข้อที่ 3 เท่านั้น และจะไม่ประกอบธุรกิจ และ/หรือ กระทำการใดๆก็ตามที่ขัดต่อกฏหมาย<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ที่ประกาศใช้อยู่ในขณะนี้ หรือที่จะได้ประกาศใช้ต่อไป และ/หรือ ที่ขัดต่อความสงบเรียบร้อย จารีตประเพณี ตลอดจนศีลธรรมอันดีงามของประชาชน และ/หรือ จะไม่ขายสินค้าที่<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผืดลิขสิทธิ ละเมิดลอกเลียนแบบจากสินค้าต้นแบบ รวมทั้งจะไม่กระทำการ หรืองดเว้นการกระทำใดๆ ตลอดจนยินยอมให้ผู้อื่นใดกระทำ และ/หรือ ไม่กระทำการใดๆ อันอาจเป็น<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ที่น่ารังเกียจ และ/หรือ เป็นอันตราย และ/หรือ ก่อให้เกิดความเสียหาย และ/หรือ ความเดือดร้อน และ/หรือ ความรำคาญต่อผู้ใช้พื้นที่รายอื่นหรือกระทบถึงบุคคลอื่นเด็ดขาด<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไม่ว่าทางตรงหรือทางอ้อม</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9" >&nbsp;&nbsp;&nbsp;&nbsp;หากผู้ขอใช้พื้นที่หรือตัวแทนของผู้ขอใช้พื้นที่ดำเนินการใดๆ ซึ่งบริษัทเห็นหรือคาดเห็นได้ว่าอาจรบกวนสิทธิในการใช้ประโยชน์ หรือ ก่อความเดือดร้อนรำคาญต่อผู้ใช้พื้นที่รายอื่น<br/>
&nbsp;&nbsp;&nbsp;&nbsp;หรือบุคคลทั่วไป หรือมีการละเมิดลิขสิทธิทางปัญญาของบุคคลอื่น หรือผิดสัญญาข้อใดข้อหนึ่งที่ระบุไว้ข้างต้น บริษัทขอสงวนสิทธิ์ยกเลิกในสมัครเข้าร่วมงานแสดงสินค้าและ<br/>
&nbsp;&nbsp;&nbsp;&nbsp;ริบเงินทั้งจำนวนที่ได้ชำระไว้แล้วทันที โดยไม่ต้องแจ้งให้ทราบล่วงหน้า และบริษัทสามารถกลับเข้าครอบครองพื้นที่ และ/หรือ มีสิทธิ์ทำลายกุญแจหรือสิ่งกีดขวางอื่นใด<br/>
&nbsp;&nbsp;&nbsp;&nbsp;โดยไม่ถือว่าบริษัทมีความผิดฐานบุกรุกหรือทำให้เสียทรัพย์ หร้อมยินยอมให้บริษัทขนย้ายทรัพย์สินต่างๆ ออกไปไว้ในสถานที่อื่น โดยบริษัทไม่ต้องรับผิดชอบ<br/>
&nbsp;&nbsp;&nbsp;&nbsp;ในความเสียหายใดๆที่เกิดขึ้นกับทรัพย์สิน</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">10. การที่บริษัทฯเพิกเฉยไม่กระทำการ และ/หรือ  ไม่ใช้สิทธิ์ของบริษัทตามสัญญา เมื่อผู้ใช้สถานที่ไม่กระทำการใดๆ ที่กำหนดไว้ในสัญญา ไม่ถือว่าบริษัทฯ ผ่อนเวลาให้แก่ผู้ขอใช้พื้นที่ และ/หรือ<br/>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สละสิทธิ์ของบริษัทฯ ตามสัญญาแต่อย่างใดทั้งสิ้น</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">11. แผนผังแสดงที่ตั้งพื้นที่ที่ขอใช้, ระเบียบและข้อบังคับการให้บริการแผงลอย ถือเป็นส่วนหนึ่งของบันทึกข้อตกลงนี้ด้วย</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">12. หากผู้ขอใช้พื้นที่ฝ่าฝืนระเบียบข้อบังคับ หรือข้อตกลงใดๆ ในสัญญานี้และไม่ปฏิบัติตามคำตักเตือน บริษัทจะระงับบริการ และ/หรือ การอำนวยความสะดวก และ/หรือ ระงับการใช้พื้นที่<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทันทีอีกทั้งขึ้นบัญชีดำเพื่อไม่เปิดโอกาศให้ผู้ขอใช้พื้นที่ได้ใช้พื้นที่ ในศูนย์อีกต่อไปโดยไม่มีกำหนด</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9"></td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9">ผู้ขอใช้พื้นที่ได้อ่าน และเข้าใจข้อความใบบันทึกการขอให้พื้นที่ลาน OTOP ฉบับนี้เป็นอย่างดีแล้ว เห็นว่าถูกต้องตรงความประสงค์ทุกประการ จึงได้ลงนามไว้เป็นสำคัญต่อหน้าพยาน</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td></td>';
$content.='<td nowrap="nowrap" colspan="9"></td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td nowrap="nowrap" colspan="10">
  <table class="table2" style="width:100%">
    <tr>
      <td style="text-align:center;">ลงชื่อ..........................................................................ผู้ขอใช้พื้นที่</td>
      <td style="text-align:center;">ลงชื่อ..........................................................................ผู้รับมอบอำนาจ</td>
    </tr>
    <tr>
      <td style="text-align:center;">(ภูวนาท ใบบัว)</td>
      <td style="text-align:center;">(บริษัท สยามสินธร จำกัด)</td>
    </tr>
  </table>
</td>';
$content.='</tr>';

$content.='<tr>';
$content.='<td nowrap="nowrap" colspan="10" style="text-align:right;"><span style="font-size:10pt;">พิมพ์วันที่ 20 กันยายน พ.ศ.2561 เวลา 11.39 น.  โดย ภูวนาท  ใบบัว</span></td>';
$content.='</tr>';

$content.='</table>';
$content.='</div>';
$content.='</div>';


$mpdf->SetProtection(array('print'));
// $mpdf->SetHeader($url . "\n\n" . 'หน้า {PAGENO}');  // optional - just as an example
$mpdf->SetTitle("บันทึกข้อตกลงขอใช้พื้นที่ลาน OTOP");
$mpdf->SetAuthor("siamsindhorn co.,ltd.");

$mpdf->SetWatermarkImage(
    $urlsys.'/images/watermark_new.png'
);
$mpdf->showWatermarkImage = true;

// $mpdf->SetWatermarkText("Demo");
// $mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

// echo $content;
$mpdf->WriteHTML($content);

// $mpdf->WriteHTML(utf8_encode($content));
// $content = $mpdf->Output('', 'S');
//
// // Create instance of Swift_Attachment with our PDF file
// $attachment = new Swift_Attachment($content, 'test-contrack-otop-6109001.pdf', 'application/pdf');
//
// $message = Swift_Message::newInstance()
//   ->setSubject('Test functon send contrack otop 6109001')
//   ->setFrom(array('info@siamsindhorn.com' => 'OSPBOOTH'))
//   ->setTo(array('puwanath@siamsindhorn.com', 'puwanath@siamsindhorn.com' => 'puwanath baibua'))
//   ->setBody('TEST Send actachfile')
//   ->attach($attachment);
//
// $transport = Swift_MailTransport::newInstance();
//
// // Create the Mailer using your created Transport
// $mailer = Swift_Mailer::newInstance($transport);
//
// // Send the created message
// $mailer->send($message);
//
// // Then, you can send PDF to the browser
// $mpdf->Output($filename ,'I');






// $mpdf->AddPage('L'); // เพิ่มหน้าใหม่แบบแนวนอน

// $content2 = '
// <style>
// .container{
//     font-family: "THSarabun";
//     font-size: 14pt;
//     padding:0px;
// }
// p{
//   font-family: "THSarabun";
//   text-align: justify;
// }
// h1{
//   font-family: "THSarabun";
//   text-align: center;
// }
// </style>';
// $content2.='<div class="container">';
// $content2.='<h4>แผนผัง</h4>';
// $content2.='</div>';
//
// $mpdf->WriteHTML($content2);

// $mpdf->WriteHTML('<h1>Test Hello world! mingmueang ทดสอบ</h1>');
$mpdf->Output();

?>
