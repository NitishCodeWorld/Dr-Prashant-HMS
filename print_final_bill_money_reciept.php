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
<title>Money Receipt | <?php echo $row_hospital_info['hospital_name'];  ?> </title>
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
    <td colspan="4" style="text-align:center"><span style="font-size:18pt; color:#666"><strong>Payment-In</strong></span></td>
  </tr>
  <tr>
    <td width="19%" ><strong>Received From</strong><br />
      <br />
      <strong><?php echo $row3['name'];  ?></strong> <br />
      <pre><?php echo $row3['address'];  ?></pre></td>
    <td colspan="3" style="text-align:right; vertical-align:top !important;"><strong>Receipt Details</strong><br />
      <br />
      Receipt No.: <?php echo $row3['invo_no'].'/'.$m_f_year;  ?><br />
    Date: <?php echo date("d-m-Y", strtotime($row3['billing_date']));  ?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="64%"><strong>Invoice Amount in Words</strong></td>
          <td width="6%" style="text-align:right">&nbsp;</td>
          <td width="6%" style="text-align:right"></td>
          <td width="12%" style="text-align:right">&nbsp;</td>
          <td width="12%" style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td><?php echo ucwords(number_to_indian_rupees_convert($row3['total']));?> Rupees only</td>
          <td style="text-align:left; border-bottom:1px solid #000">Received</td>
          <td style="text-align:right; border-bottom:1px solid #000">&nbsp;</td>
          <td style="text-align:right; border-bottom:1px solid #000">&nbsp;</td>
          <td style="text-align:right; border-bottom:1px solid #000">₹ <?php echo number_format(($row3['total']),2);  ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="4" style="text-align:center">For: <?php echo $row_hospital_info['hospital_name'];  ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right"></td>
          <td style="text-align:right">&nbsp;</td>
          <td style="text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="4" style="text-align:center"><strong>Authorized Signatory</strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
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
<script>
window.print() ;
</script>
</body>
</html>