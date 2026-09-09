<?php
include 'function.php';
include 'conn.php';

/*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/

?>

<?php

$id = $_GET['id']; // get id through query string
// Changes_to_be

$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);

$qry = mysqli_query($conn, "select * from `invoice_final_billing` where `id`='".$id."'"); // select query
$row3 = mysqli_fetch_array($qry); // fetch data
$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['billing_date'])) , "4/1", "3/31");
$del_flag=$row3['del_flag'];
$cancled="";
if($del_flag=='1'){
	$cancled=" ( Cancelled Bill )";

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tax Invoice | <?php echo $row_hospital_info['hospital_name'];  ?> </title>
<meta content="Evolution of EMR stands for Electronic medical records, which are the digital equivalent of paper records, or charts at a clinician's office. EMRs typically contain general information such as treatment and medical history about a patient as it is collected by the individual medical practice." name="description">
<meta content="ESPPL" name="author">
<meta name="keywords" content="EMR, Electronic medical records, Hospital, Patient, Prescription ">
<link rel="shortcut icon" href="favicon.ico">
<style>
td {
	padding:4px;
	font-family:calibri;
	font-size:10.5pt;
	color:#000;
}
</style>
</head>

<body>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="4" style="border-bottom:1px solid #000"><span style="font-size:18pt;"><strong><?php echo $row_hospital_info['hospital_name'];  ?></strong></span> <br />
      <?php echo $row_hospital_info['address'];  ?> <br />
      CE LICENCE NO 33735587 Rohini Id 8900080386891.<br />
      Phone no.: <?php echo $row_hospital_info['final_bill_mobile'];  ?> <br />
      Email:  <?php echo $row_hospital_info['email'];  ?></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align:center"><span style="font-size:18pt; color:#666"><strong>Tax Invoice</strong></span></td>
  </tr>
  <tr>
    <td width="19%"><strong>Bill To<br />
      <?php echo $row3['name'];  ?> <br />
      </strong><pre><?php echo $row3['address'];  ?></pre></td>
    <td colspan="3" style="text-align:right"><strong>Invoice Details</strong><br />
      Invoice No.: <?php echo $row3['invo_no'].'/'.$m_f_year;  ?><br />
      Date: <?php echo date("d-m-Y", strtotime($row3['billing_date']));  ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="7%" style="background:#CCC"><strong>#</strong></td>
          <td width="52%" style="background:#CCC"><strong>Item Name</strong></td>
          <td width="11%" style="background:#CCC"><strong>HSN/SAC</strong></td>
          <td width="6%" style="background:#CCC; text-align:right"><strong>Quantity</strong></td>
          <td width="12%" style="background:#CCC; text-align:right"><strong>Price/unit</strong></td>
          <td width="12%" style="background:#CCC; text-align:right"><strong>Amount</strong></td>
        </tr>
		<?php		
		$procedure_amt_tot=0;

		$sl_lab_proc=1;	
		
		$condition=" AND `del_flag`='0' ";
		
		if($del_flag=='1'){
		
		$condition=" AND `del_flag`='1' ";
		
		}									
		
		$sql2_lab_proc="SELECT * FROM `invoice_final_procedure` WHERE `i_id`= '" .$id. "' AND `patient_registration_id`= '" .$row3['patient_registration_id']. "' AND `hospital_number`= '" .$row3['hospital_number']. "'  $condition ";
		
		$result2_lab_proc=$conn->query($sql2_lab_proc) ;
		
		while ($row2_lab_proc=mysqli_fetch_array($result2_lab_proc,MYSQLI_ASSOC))
		
						{
		
					 ?>
        <tr>
          <td><?php echo $sl_lab_proc;  ?></td>
          <td><?php 
			  $qry_lab_test = mysqli_query($conn, "SELECT `procedure_name` FROM `procedure_masters`  where `id`='".$row2_lab_proc['procedure_id']."'"); 
			  $row3_lab_test = mysqli_fetch_array($qry_lab_test); 
			  echo $row3_lab_test['procedure_name'];  ?></td>
          <td>&nbsp;</td>
          <td style="text-align:right">1</td>
          <td style="text-align:right">₹ <?php echo number_format(($row2_lab_proc['net_amount']),2);  ?></td>
          <td style="text-align:right">₹ <?php echo number_format(($row2_lab_proc['net_amount']),2);  ?></td>
        </tr>
         <?php	
		 $procedure_amt_tot=$procedure_amt_tot+$row2_lab_proc['net_amount']; 
		 $sl_lab_proc++; } ?>
         
         <?php if($row3['discount_type']!=''){ ?>

                     <tr>
                      <td>&nbsp;</td>
                      <td>Less Discount:( <?php if($row3['discount_type']=='F'){ echo '-'.$row3['discount']; }else{ echo $row3['discount'].'%'; } ?> )</td>
                      <td style="text-align:right !important; " colspan="4"><?php $balance_amt=$row3['total']-$procedure_amt_tot; echo number_format(($balance_amt),2);  ?></td>
                    </tr>
                     <?php } ?>
       
        <tr>
          <td style="border-top: 1px solid #000; border-bottom: 1px solid #000;">&nbsp;</td>
          <td style="border-top: 1px solid #000; border-bottom: 1px solid #000;"><strong>Total</strong></td>
          <td style="border-top: 1px solid #000; border-bottom: 1px solid #000;">&nbsp;</td>
          <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; text-align:right"><strong><?php echo ($sl_lab_proc-1);  ?></strong></td>
          <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; text-align:right">&nbsp;</td>
          <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; text-align:right"><span style="text-align:right"><strong>₹</strong></span> <strong><?php echo number_format(($row3['total']),2);  ?></strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><strong>Invoice Amount in Words</strong></td>
          <td style="text-align:right"><strong>Sub Total</strong></td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"><strong>₹</strong> <strong><?php echo number_format(($row3['total']),2);  ?></strong></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo ucwords(number_to_indian_rupees_convert($row3['total']));?> Rupees only</td>
          <td style="text-align:right; background:#ccc"><strong>Total</strong></td>
          <td style="text-align:right; background:#ccc"></td>
          <td style="text-align:right; background:#ccc">&nbsp;</td>
          <td style="text-align:right; background:#ccc"><strong>₹</strong> <strong><?php echo number_format(($row3['total']),2);  ?></strong></td>
        </tr>
        <tr>
          <td colspan="2"><strong>Terms and Conditions</strong></td>
          <td style="text-align:right">Received</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">₹ 0.00</td>
        </tr>
        <tr>
          <td colspan="2">Thank you for providing the chance to serve you</td>
          <td style="text-align:right; border-bottom:1px solid #000">Balance</td>
          <td style="text-align:right; border-bottom:1px solid #000">&nbsp;</td>
          <td style="text-align:right; border-bottom:1px solid #000">&nbsp;</td>
          <td style="text-align:right; border-bottom:1px solid #000">₹ <?php echo number_format(($row3['total']),2);  ?></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td colspan="3" style="text-align:center">For: <?php echo $row_hospital_info['hospital_name'];  ?></td>
        </tr>
         
        <tr>
          <td colspan="2">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td colspan="3" style="text-align:center"><strong>Authorized Signatory</strong></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
      </table></td>
  </tr>

  <tr>
    <td colspan="4" style="color:#666">&nbsp;</td>
  </tr>
</table>
</body>
<script>
window.print() ;
</script>
</html>