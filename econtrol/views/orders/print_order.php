<style type="text/css">
@import url("../../../assets/fonts/supermaket-font/stylesheet.css");
body {
    margin: 0;
    padding: 0;
    font-family: 'supermarketregular', sans-serif;
    background-color: transparent !important;
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

.headTitle {
    font-size:14px;
    font-weight:bold;
    text-transform:uppercase;
}
.headerTitle01 {
    border:1px solid #333333;
    background-color: yellow;
    border-left:1px solid #000;
    border-bottom-width:1px;
    border-top-width:1px;
    font-size:14px;
    font-weight: 600;
}
.headerTitle01_r {
    border:1px solid #333333;
    background-color: yellow;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom-width:1px;
    border-top-width:1px;
    font-size:14px;
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
  font-size: 14px;
    border-left:1px solid #000;
    border-bottom:1px solid #000;
}
/* กำหนดเส้นบรรทัดซ้าย ขวา และด้านล่าง */
.left_right_bottom {
  font-size: 14px;
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
.page {
  font-family : 'supermarketregular', sans-serif;
  font-size: :13px;
    width: 21cm;
    min-height: 29.7cm;
    padding: 1cm;
    padding-left: 2cm;
    padding-bottom: 3mm;
    margin: 1.5cm auto;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

@page {
    size: A4;
    margin: 0;
}
@media print {
    .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
    }
}
</style>
<?php
include "../../common/include/config.php";
include "../../../common/functions/functions_thaibaht.php";

function getcomp($att){
  include "../../common/include/config.php";
	$qsql = $dbCon->query("select * from kp_config where cog_id = '1' ") or die($dbCon->error);
	$res = $qsql->fetch_object();

	if($att=="companyname"){
		if($_SESSION['lg']=="TH"){
			return $res->companyname;
		}else{
			return $res->companyname_en;
		}
	}elseif($att=="address"){
		if($_SESSION['lg']=="TH"){
			return $res->companyaddress;
		}else{
			return $res->companyaddress_en;
		}
	}else{
		return $res->$att;
	}

}


function getProvince($provincecode){
  include "../../common/include/config.php";
	$qsql = $dbCon->query("select name_en from kp_provinces where code = '$provincecode' ") or die($dbCon->error);
	$res = $qsql->fetch_object();
	return $res->name_en;
}

function getDistrict($id){
  include "../../common/include/config.php";
	$qsql = $dbCon->query("select * from kp_districts where id = '$id' ") or die($dbCon->error);
	$res = $qsql->fetch_object();
	return $res->name_th;
}
function getAmphur($id){
  include "../../common/include/config.php";
	$qsql = $dbCon->query("select * from kp_amphures where id = '$id' ") or die($dbCon->error);
	$res = $qsql->fetch_object();
	return $res->name_th;
}
function getProvinces($id){
  include "../../common/include/config.php";
	$qsql = $dbCon->query("select * from kp_provinces where id = '$id' ") or die($dbCon->error);
	$res = $qsql->fetch_object();
	return $res->name_th;
}
function getProduct($fill,$id){
  include "../../common/include/config.php";
	$qsql = $dbCon->query("select * from kp_products where prodid = '$id' ") or die($dbCon->error);
	$res = $qsql->fetch_object();
	return $res->$fill;
}
function getEvent($fill,$id){
  include "../../common/include/config.php";
	$qsql = $dbCon->query("select * from kp_events where event_id = '$id' ") or die($dbCon->error);
	$res = $qsql->fetch_object();
	return $res->$fill;
}
function getEventpackage($fill,$whare){
  include "../../common/include/config.php";
	$qsql = $dbCon->query("select * from kp_events_package $whare ") or die($dbCon->error);
	$res = $qsql->fetch_object();
	return $res->$fill;
}
function getTextformid($table,$fill,$whare){
  include "../../common/include/config.php";
	$qsql = $dbCon->query("select * from $table $whare ") or die($dbCon->error);
	$res = $qsql->fetch_object();
	return $res->$fill;
}

function genQrcode($orderid){
  $url = 'https://promptforward.com';
  $amount = getTextformid('kp_orders','order_totamount',"where order_id = '$orderid'");
  $detail = 'Order ID : '.$orderid;
  $responseUrl = "$url/basket/success/$orderid";
  $backgroundUrl = "$url/basket/checkout/$orderid?select=updatepayment&payment_id=2&payment_desc=qrcode&order_id=$orderid";
  $token = '___TOKENCODE___';

  $member_id = getTextformid('kp_orders','member_id',"where order_id = '$orderid'");
  $customerName = getTextformid('kp_members','member_name',"where member_id = '$member_id' ");
  $customerEmail = getTextformid('kp_members','member_email',"where member_id = '$member_id' ");

  $form = array(
    'amount'=>number_format($amount,2,'.',''),
    'responseUrl'=>"$responseUrl",
    'backgroundUrl'=>"$backgroundUrl",
    'detail'=>"$detail",
    'customerName'=>"$customerName",
    'customerEmail'=>"$customerEmail",
    'referenceNo'=>"$orderid",
    'token'=>"$token",
    'payType'=>'F'
  );

  // header('Content-Type: image/png');
  $ch = curl_init();
  $ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13';
  curl_setopt($ch, CURLOPT_URL,"https://api.gbprimepay.com/gbp/gateway/qrcode");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLINFO_HEADER_OUT, 0);
  curl_setopt($ch, CURLOPT_BINARYTRANSFER, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$form);

  // Receive server response ...
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_USERAGENT, $ua);
  $output = curl_exec($ch);
  curl_close($ch);
  // $info = curl_getinfo($ch);
  // header('Content-Type:' . $info['content_type']);

  // Further processing ...
  return "<img src='data:image/png;base64,".base64_encode($output)."' class='img-responsive' style='width:120px;' />";
}



// require_once "../../common/functions/functions_setting.php";
$requestData = $_REQUEST;
$order_id = $requestData['order_id'];
$total_page_data = 0;  // เก็บจำนวนหน้า รายการทั้งหมด
$total_page_item = 20; // จำนวนรายการที่แสดงสูงสุดในแต่ละหน้า
$total_page_item_all = 0; // ไว้เก็บจำนวนรายการจริงทั้งหมด
$arr_data_set=array(array()); // [][];

$sql = "select * from kp_orders where order_id = '{$order_id}' ";
$qr = $dbCon->query($sql) or die($dbCon->error);
$res = $qr->fetch_object();
$order_no = $res->order_id;
$order_status = $res->order_status;
$order_date = date("d/m/Y H:i:s",strtotime($res->order_date));
if($order_status!='cancel'){
  if($res->payment_status=='pending'){
    $payment_status = 'ยังไม่ได้ชำระเงิน';
  }elseif($res->payment_status=='pending-review'){
    $payment_status = 'แจ้งชำระเงินแล้ว';
  }elseif($res->payment_status=='success'){
    $payment_status = 'ชำระเงินแล้ว';
  }
}else{
  $payment_status = 'ถูกยกเลิกคำสั่งซื้อแล้ว';
}
$member_id = $res->member_id;

$qrcust = $dbCon->query("select * from kp_members where member_id = '$member_id'  ") or die($dbCon->error);
$rescust = $qrcust->fetch_object();
$customername = $rescust->member_name;
$customertel = $rescust->member_tel;
$customeremail = $rescust->member_email;
$customeraddress = $rescust->member_address1.' '.$rescust->member_address2.' '.getProvince($rescust->province).' '.$rescust->postcode;

$qrshipping = $dbCon->query("select * from kp_orders_shipping where order_id = '$order_id' ") or die($dbCon->error);
$resshipping = $qrshipping->fetch_object();
$shipping_name = $resshipping->shipping_name;
$shipping_address = $resshipping->shipping_address;
$shipping_district = getDistrict($resshipping->shipping_district_id);
$shipping_amphur = getAmphur($resshipping->shipping_amphur_id);
$shipping_province = getProvinces($resshipping->shipping_province_id);
$shipping_zipcode = $resshipping->shipping_zipcode;
$shipping_tel = $resshipping->shipping_tel;

$i=1;
?>
  <div class="page-break<?=($i==1)?"-no":""?>">&nbsp;</div>
  <div class="page">
  <table style="width:100%;" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="left" valign="top" style="width:50%;">
        <img src="../../../images/<?=getcomp('head_logo');?>" style="max-height:100px;"/>
        <div style="font-size:12px;font-weight:600;"><?=getcomp('companyname');?></div>
        <div style="font-size:12px;font-weight:600;"><?=getcomp('companyaddress1');?> <?=getcomp('companyaddress2');?> <?=getcomp('companypostcode');?></div>
        <div style="font-size:12px;font-weight:400;"><?=getcomp('companytel1');?> <?=(getcomp('companytel2')?','.getcomp('companytel2'):'');?> <?=(getcomp('companyemail')?' | '.getcomp('companyemail'):'');?>  </div>
      </td>
      <td align="right" valign="top" style="width:50%;">
        <div style="font-size:45px;font-weight:600;">INVOICE</div>
        <div style="font-size:14px;font-weight:600;">เลขที่สั่งซื้อ / ORDER ID : <?=$order_no;?></div>
        <div style="font-size:13px;font-weight:600;">วันที่สั่งซื้อ / ORDER DATE : <?=$order_date;?></div>
        <div style="font-size:13px;font-weight:600;">สถานะการชำระเงิน / PAYMENT STATUS : <?=$payment_status;?></div>
      </td>
    </tr>
    <tr>
      <td align="center" class="headTitle">&nbsp;</td>
      <td align="center" class="headTitle">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" class="headTitle">
        <div style="height:150px;border:1px solid #000;border-radius:3px;text-align:left;padding:5px;">
          <div style="font-size:14px;font-weight:600;">CUSTOMER INFORMATION</div>
          <div style="font-size:12px;"><b>Name : </b> <?=$customername;?></div>
          <div style="font-size:12px;"><b>Address : </b> <?=$customeraddress;?></div>
          <div style="font-size:12px;"><b>Tel : </b> <?=$customertel;?></div>
          <div style="font-size:12px;"><b>Email : </b> <?=$customeremail;?></div>
        </div>
      </td>
      <td align="center" class="headTitle">
        <div style="height:150px;border:1px solid #000;border-radius:3px;text-align:left;padding:5px;">
          <div style="font-size:14px;font-weight:600;">CUSTOMER SHIPPING</div>
          <div style="font-size:12px;"><b>Name : </b> <?=$shipping_name;?></div>
          <div style="font-size:12px;"><b>Address : </b> <?=$shipping_address.' '.$shipping_district.' '.$shipping_amphur.' '.$shipping_province.' '.$shipping_zipcode;?></div>
          <div style="font-size:12px;"><b>Tel : </b> <?=$shipping_tel;?></div>
        </div>
      </td>
    </tr>
    <tr>
      <td align="left" height="10" colspan="2"></td>
    </tr>
    <tr>
      <td align="left" colspan="2">
        <table border="0" align="left" cellpadding="5" cellspacing="5" style="font-size:12px;border-collapse:collapse;border-top:5px double #000;width:100%;">
          <tr>
            <td width="10%" class="headerTitle01"  align="center" valign="middle">No.</td>
            <td width="50%" class="headerTitle01"  align="center" valign="middle">Description</td>
            <td width="10%" class="headerTitle01"  align="center" valign="middle">Amount</td>
            <td width="15%" class="headerTitle01"  align="center" valign="middle">Price</td>
            <td width="15%" class="headerTitle01_r"  align="center" valign="middle">Total</td>
          </tr>
          <?php
          $subtotal = 0;
          $i = 1;
          $qrproduct = $dbCon->query("select * from kp_orders_detail where order_id = '$order_id' order by prodid asc") or die($dbCon->error);
          while($resprod = $qrproduct->fetch_object()){
            $product_name = '<div>'.getProduct('prodname_en',$resprod->prodid).'</div>';
            $product_name.= '<div>--'.$resprod->proddesc.'</div>';
            $product_amount = $resprod->qty;
            $product_price = $resprod->price;
            $product_total = $resprod->tot_amount;
          ?>
          <tr>
            <td height="20" align="center" class="left_bottom"><?=$i;?></td>
            <td align="left" class="left_bottom"><?=$product_name;?></td>
            <td align="center" class="left_bottom"><?=$product_amount;?></td>
            <td align="right" class="left_bottom"><?=number_format($product_price,2);?></td>
            <td align="right" class="left_right_bottom"><?=number_format($product_total,2);?></td>
          </tr>
          <?php
          $subtotal+=$product_total;
          $i++;
          }
          ?>
          <?php
          for($k=$i;$k<=10;$k++){
          ?>
          <tr>
            <td height="35" align="center" class="left_bottom"></td>
            <td align="left" class="left_bottom"></td>
            <td align="center" class="left_bottom"></td>
            <td align="right" class="left_bottom"></td>
            <td align="right" class="left_right_bottom"></td>
          </tr>
          <?php }
          $coupon_code = $res->coupon_code;
          $coupon_amt = $res->coupon_amt;
          $shipping_amt = $res->shipping_amt;


          $order_amount = $res->order_amount;
          $total = ($order_amount-$coupon_amt)+$shipping_amt;
          $order_vat = $res->order_vat;
          $order_fee = $res->order_fee;
          $order_totamount = $res->order_totamount;
          ?>
          <tr>
            <td height="35" colspan="2" rowspan="6" valign="top" align="center" >
              <div style="font-size:13px;font-weight:600;border:1px solid #333;border-radius:5px;padding:1px;background-color:#eee;"> <l>(<?=baht_text($order_totamount);?>)</l> </div>
              <div style="margin-top:5px;font-size:13px;font-weight:600;border:1px solid #333;border-radius:5px;padding:5px;text-align:left;">
                หมายเหตุ : หากท่านยังไม่ได้ชำระเงิน กรุณาชำระเงินภายใน 3 ชม. หลังจากนั้น ออเดอร์ของท่านจะถูกยกเลิกอัตโนมัติ
              </div>
            </td>
            <td height="35" colspan="2"  align="right" class="left_bottom"><b>TOTAL (Ex.VAT)</b></td>
            <td align="right" class="left_right_bottom"><b><?=number_format($order_amount,2);?></b></td>
          </tr>
          <tr>
            <td height="35" colspan="2" align="right" class="left_bottom"><b>DISCOUNT</b></td>
            <td align="right" class="left_right_bottom"><b><?=number_format($coupon_amt,2);?></b></td>
          </tr>
          <tr>
            <td height="35" colspan="2" align="right" class="left_bottom"><b>SHIPPING</b></td>
            <td align="right" class="left_right_bottom"><b><?=number_format($shipping_amt,2);?></b></td>
          </tr>
          <tr>
            <td height="35" colspan="2" align="right" class="left_bottom"><b>SUB TOTAL</b></td>
            <td align="right" class="left_right_bottom"><b><?=number_format($total,2);?></b></td>
          </tr>
          <tr>
            <td height="35" colspan="2" align="right" class="left_bottom"><b>VAT 7%</b></td>
            <td align="right" class="left_right_bottom"><b><?=number_format($order_vat,2);?></b></td>
          </tr>
          <tr>
            <td height="35" colspan="2" align="right" class="left_bottom"><b>GRAND TOTAL</b></td>
            <td align="right" class="left_right_bottom"><b><?=number_format($order_totamount,2);?></b></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">
        <?php
        if($res->payment_status=='pending'):
        ?>
        <div style="font-size:15px;font-weight:600;text-align:left;">ช่องทางที่ท่านเลือกชำระเงิน</div>
        <div style="text-align:left;">
          <?php
          if($order_status!='cancel'){
            // echo genQrcode($order_id);
            $qr = $dbCon->query("select * from kp_bank where bank_id = '$res->bank_id' and status=1 ");
        		$res = $qr->fetch_assoc();
      			$data = "<div>
      				ชื่อบัญชี : {$res['bank_acc_name']}<br />
      				ธนาคาร : {$res['bank_name']}<br />
      				สาขา : {$res['bank_branch']}<br />
      				เลขที่บัญชี : {$res['bank_acc_num']}<br />
      			</div>";
      			echo $data;
          }
          ?>
        </div>
        <?php endif;?>
      </td>
      <td align="left">&nbsp;</td>
    </tr>
  </table>
  </div>
