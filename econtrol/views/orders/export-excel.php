<style type="text/css">
.page {
  font-family : "THSarabun";
    width: 29.7cm;
    min-height: 21cm;
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
$strExcelFileName="Export-Orders-transections-".time().".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

include "common/include/config.php";
$requestData = $_GET;
$total_page_data = 0;  // เก็บจำนวนหน้า รายการทั้งหมด
$total_page_item = 20; // จำนวนรายการที่แสดงสูงสุดในแต่ละหน้า
$total_page_item_all = 0; // ไว้เก็บจำนวนรายการจริงทั้งหมด
$arr_data_set=array(array()); // [][];
$sql = "select od.order_date,od.order_id,od.member_id,mb.member_name,mb.member_email,od.order_amount,od.order_vat,od.order_fee,od.order_totamount,od.payment_id,od.payment_desc,od.payment_amount,od.payment_reference_no,od.payment_status,od.order_status
from kp_orders as od
INNER JOIN kp_members as mb on mb.member_id = od.member_id ";
if($requestData['order_status']!='all') {
  $order_status = 'Order Status : '.$requestData['order_status'];
  $sql.= "AND od.order_status = '".$requestData['order_status']."' ";
}
if(!empty($requestData['start_date']) and !empty($requestData['end_date'])){
  $start_date = date("Y-m-d",strtotime($requestData['start_date']));
  $end_date = date("Y-m-d",strtotime($requestData['end_date']));
  $datemix = 'Date Between '.date("d F,Y",strtotime($requestData['start_date'])).' to '.date("d F,Y",strtotime($requestData['end_date']));
  $sql.= "AND (substr(od.order_date,1,10) BETWEEN '".$start_date."' AND '".$end_date."') ";
}
if(!empty($requestData['searchkeyword'])){
  $requestData['searchkeyword']=addslashes($requestData['searchkeyword']);
  $text_search = 'Keyword Search : '.$requestData['searchkeyword'];
  $sql.= "AND ( od.order_id LIKE '%".$requestData['searchkeyword']."%' ";
  $sql.= "OR od.member_id LIKE '%".$requestData['searchkeyword']."%' ";
  $sql.= "OR od.member_id in (select member_id from kp_members where (member_name LIKE '%".$requestData['searchkeyword']."%' or member_firstname LIKE '%".$requestData['searchkeyword']."%' or member_lastname LIKE '%".$requestData['searchkeyword']."%') )  ";
  $sql.= "OR lower(od.member_id) LIKE lower('%".$requestData['searchkeyword']."%') ";
  $sql.= "OR lower(od.payment_desc) LIKE lower('%".$requestData['searchkeyword']."%') ";
  $sql.= "OR od.payment_reference_no LIKE '%".$requestData['searchkeyword']."%' ) ";
}
$sql.= " order by od.order_date desc";
$i=0;
$result = $dbCon->query($sql) or die($dbCon->error);
if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
    $total_page_item_all = $result->num_rows; // จำนวนรายการทั้งหมด
    $total_page_data = ceil($total_page_item_all/$total_page_item); // หาจำนวนหน้าจากรายการทั้งหมด
    while($row = $result->fetch_assoc()){ // วนลูปแสดงรายการ
        $order_id = $row['order_id'];
        $arr_data_set['order_id'][$i]=$order_id;
        $arr_data_set['order_date'][$i]= date("d/m/Y H:i:s",strtotime($row['order_date']));
        $arr_data_set['member_name'][$i]= $row['member_name'];
        $arr_data_set['member_email'][$i]= $row['member_email'];

        $arr_data_set['order_amount'][$i]= number_format($row['order_amount'],2);
        $arr_data_set['order_vat'][$i]= number_format($row['order_vat'],2);
        $arr_data_set['order_fee'][$i]= number_format($row['order_fee'],2);
        $arr_data_set['order_totamount'][$i]= number_format($row['order_totamount'],2);
        $arr_data_set['payment_desc'][$i]= $row['payment_desc'];
        $arr_data_set['payment_amount'][$i]= number_format($row['payment_amount'],2);
        $arr_data_set['payment_reference_no'][$i]= $row['payment_reference_no'];
        $arr_data_set['payment_status'][$i]= $row['payment_status'];
        $arr_data_set['order_status'][$i]= $row['order_status'];

        // $arr_data_set['rntb'][$i]= $this->getTextformid("kp_rntb","rntb_desc","rntb_id",$row['rntb_id']);;
        // $arr_data_set['trn_remark'][$i]= $row['trn_remark'];
        $i++;
    }
}
?>
  <div class="page-break<?=($i==1)?"-no":""?>">&nbsp;</div>
  <div class="page">
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <!-- <td align="left">Page <?//=$i?></td> -->
    </tr>
    <tr>
      <td align="center" class="headTitle" style="font-size:15px;">ORDERS TRANSACTIONS<br />
        <?php
          if(!empty($requestData['order_status'])){
            echo '<span style="font-size:12px;">'.$order_status.'</span><br />';
          }
          if(!empty($requestData['start_date']) and !empty($requestData['end_date'])){
            echo '<span style="font-size:12px;">'.$datemix.'</span><br />';
          }
          if(!empty($requestData['searchkeyword'])){
            echo '<span style="font-size:12px;">'.$text_search.'</span><br />';
          }
        ?>
        <span></span> <br />
      </td>
    </tr>
    <tr>
      <td align="left">

      </td>
    </tr>
    <tr>
      <td align="left">
        <table width="1530" border="0" align="left" cellpadding="5" cellspacing="5" style="border-collapse:collapse;border-top:5px double #000;">
          <tr>
            <td width="30" class="headerTitle01"  align="center" valign="middle">Order ID</td>
            <td width="50" class="headerTitle01"  align="center" valign="middle">Order Date</td>
            <td width="100" class="headerTitle01"  align="center" valign="middle">Member Name</td>
            <td width="100" class="headerTitle01" align="center" valign="middle">Member Email</td>
            <td width="80" class="headerTitle01" align="center" valign="middle">Amount</td>
            <td width="80" class="headerTitle01" align="center" valign="middle">Vat</td>
            <td width="80" class="headerTitle01" align="center" valign="bottom">Fee</td>
            <td width="100" class="headerTitle01_r" align="center" valign="middle">Total Amount</td>
            <td width="80" class="headerTitle01_r" align="center" valign="middle">Payment Desc</td>
            <td width="100" class="headerTitle01_r" align="center" valign="middle">Payment Amount</td>
            <td width="100" class="headerTitle01_r" align="center" valign="middle">Payment Ref</td>
            <td width="80" class="headerTitle01_r" align="center" valign="middle">Payment Status</td>
            <td width="80" class="headerTitle01_r" align="center" valign="middle">Order Status</td>
          </tr>
          <?php
          // ส่วนของ repeat content

          for($v=0;$v<=$total_page_item_all;$v++){
              // $item_i=(($i-1)*$total_page_item)+$v;
              $item_i= $v;
              $order_id = isset($arr_data_set['order_id'][$item_i])?$arr_data_set['order_id'][$item_i]:"";
              $order_date = isset($arr_data_set['order_date'][$item_i])?$arr_data_set['order_date'][$item_i]:"";
              $member_name = isset($arr_data_set['member_name'][$item_i])?$arr_data_set['member_name'][$item_i]:"";
              $member_email = isset($arr_data_set['member_email'][$item_i])?$arr_data_set['member_email'][$item_i]:"";
              $order_amount = isset($arr_data_set['order_amount'][$item_i])?$arr_data_set['order_amount'][$item_i]:"";
              $order_vat = isset($arr_data_set['order_vat'][$item_i])?$arr_data_set['order_vat'][$item_i]:"";
              $order_fee = isset($arr_data_set['order_fee'][$item_i])?$arr_data_set['order_fee'][$item_i]:"";
              $order_totamount = isset($arr_data_set['order_totamount'][$item_i])?$arr_data_set['order_totamount'][$item_i]:"";
              $payment_desc = isset($arr_data_set['payment_desc'][$item_i])?$arr_data_set['payment_desc'][$item_i]:"ทำรายการไม่สำเร็จ!";
              $payment_amount = isset($arr_data_set['payment_amount'][$item_i])?$arr_data_set['payment_amount'][$item_i]:"";
              $payment_reference_no = isset($arr_data_set['payment_reference_no'][$item_i])?$arr_data_set['payment_reference_no'][$item_i]:"";
              $payment_status = isset($arr_data_set['payment_status'][$item_i])?$arr_data_set['payment_status'][$item_i]:"";
              $order_status = isset($arr_data_set['order_status'][$item_i])?$arr_data_set['order_status'][$item_i]:"";
              $item_i = isset($arr_data_set['order_id'][$item_i])?$item_i:"";
          ?>
          <tr>
            <td height="20" align="center" class="left_bottom"><?=$order_id?></td>
            <td align="center" class="left_bottom"><?=$order_date?></td>
            <td align="left" class="left_bottom"><?=$member_name;?></td>
            <td align="left" class="left_bottom"><?=$member_email;?></td>
            <td align="right" class="left_bottom"><?=$order_amount;?></td>
            <td align="right" class="left_bottom"><?=$order_vat;?></td>
            <td align="right" class="left_bottom"><?=$order_fee;?></td>
            <td align="right" class="left_bottom"><?=$order_totamount;?></td>
            <td align="center" class="left_bottom"><?=$payment_desc;?></td>
            <td align="right" class="left_bottom"><?=$payment_amount;?></td>
            <td align="center" class="left_bottom"><?=$payment_reference_no;?></td>
            <td align="center" class="left_bottom"><?=$payment_status;?></td>
            <td align="center" class="left_right_bottom"><?=$order_status;?></td>
          </tr>
          <?php } ?>
        </table>
      </td>
    </tr>
  </table>
  </div>
