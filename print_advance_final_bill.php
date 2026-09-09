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



$qry = mysqli_query($conn, "select * from `adavnce_final_billing` where `id`='".$id."'"); // select query

$row3 = mysqli_fetch_array($qry); // fetch data

$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['billing_date'])) , "4/1", "3/31");

$del_flag=$row3['del_flag'];

$cancled="";

if($del_flag=='1'){

	$cancled=" Receipt ( Cancelled Bill )";

}else{
	$cancled=" Receipt ";	
}
if($row3['opd_flag']==1){
	$bill_for='RECP/OPD';
}else{
	$bill_for='RECP/IPD';
}

$prefix="";
$sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row3['prefix']."'";	
$res_prefix=mysqli_query($conn,$sql_prefix);
$row_prefix=mysqli_fetch_assoc($res_prefix);
$count_prefix=$res_prefix->num_rows;
if($count_prefix>0)
{
	$prefix=$row_prefix['prefix_name']; 
}


$sql_gen="select * from `gender_masters` Where `id`='".$row3['gender']."' ";
$result_gen=$conn->query($sql_gen) ;
$row_gen=mysqli_fetch_assoc($result_gen);
$gen="";							 
$gen=" / ".mb_substr($row_gen['gender'], 0, 1);;
									


$payor_name="SELF";
$insurance_name="";
$claim_no="";
$tpa_amt=0;
$pay_mode="";
$deposit_type="";
 $sql_payment = "SELECT `adavnce_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `adavnce_final_payment_billing` INNER JOIN `payment_mode_masters` ON `adavnce_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `adavnce_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `adavnce_final_payment_billing`.`i_id` = '".$id."' AND `adavnce_final_payment_billing`.`p_key`<>'5'  AND `adavnce_final_payment_billing`.`del_flag`='0' ";
$result_payment = $conn->query($sql_payment);
if($result_payment->num_rows > 0){
	while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))
	{	if($pay_mode==''){
			$pay_mode=$row2_payment['payment_mode_name'];
		}else{
			$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];
		}
		$deposit_type=$row2_payment['payment_type_name'];
		
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Receipt Bill</title>
<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<!--<link rel="manifest" href="favicon/manifest.json">-->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<style>
td {
	vertical-align:middle;
	font-family:Arial, Helvetica, sans-serif;
	text-align:left;
	font-size:9pt;
	padding: 2px;
}
.receipt_td {
	font-size:7pt;
}
</style>
</head>

<body style="padding:5px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13%" style="border-left: 1px solid #333; border-top: 1px solid #333; border-bottom: 1px solid #333; padding:1px 4px 1px 4px; text-align:center"><img src="<?php echo ADMIN_URL.'upload/left_side_logo/'.$row_hospital_info['left_side_logo'];  ?>" alt="left" /></td>
    <td width="74%" style="font-family:Times New Roman, Times, serif; font-size:9pt; border-top: 1px solid #333; border-bottom: 1px solid #333; line-height:18px; padding:5px; text-align:center; vertical-align:middle !important;"><h3 style="margin:0px"> <?php echo $row_hospital_info['hospital_name'];  ?></h3>
      (<?php echo $row_hospital_info['final_bill_unit'];  ?>)<br />
      <?php echo $row_hospital_info['address'];  ?><br />
      <?php echo $row_hospital_info['final_bill_mobile'];  ?>; <?php echo $row_hospital_info['email'];  ?></td>
    <td width="13%" style="border-right: 1px solid #333; border-top: 1px solid #333; border-bottom: 1px solid #333; padding:1px 4px 1px 4px; text-align:center"><img src="<?php echo ADMIN_URL.'upload/right_side_logo/'.$row_hospital_info['right_side_logo'];  ?>" alt="Sumetra"  /></td>
  </tr>
  <tr>
    <td colspan="3" style="padding:6px; font-size:10pt; text-align:center; font-family:Arial, Helvetica, sans-serif"><strong><?php echo $cancled;  ?></strong></td>
  </tr>
  <tr>
    <td colspan="3" style="border: 2px solid #333; padding:6px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15%" style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Bill No.</strong></td>
          <td width="35%" style="border-bottom: 1px solid #333; padding-left:4px;border-right: 1px solid #333;"><?php echo $row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row3['invo_no'];  ?></td>
          <td width="15%" style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px"><strong>Receipt Date</strong></td>
          <td width="35%" style="padding-left:4px; border-bottom: 1px solid #333;"><?php echo date("d/M/Y", strtotime($row3['billing_date']));  ?></td>
        </tr>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Patient ID</strong></td>
          <td style="border-bottom: 1px solid #333; padding-left:4px;border-right: 1px solid #333;"><?php echo $row3['hospital_number'];  ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px;border-right: 1px solid #333;"><strong>Deposit Type</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333;"><?php echo $deposit_type;  ?></td>
        </tr>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Patient Name</strong></td>
          <td style="border-bottom: 1px solid #333; padding-left:4px;border-right: 1px solid #333;"><?php echo $prefix.' '.$row3['name'];  ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px"><strong>Age/Sex</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333;"><?php echo $row3['age'].' Yrs'.$gen;  ?></td>
        </tr>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Address</strong></td>
          <td style="border-bottom: 1px solid #333; padding-left:4px;border-right: 1px solid #333;"><?php echo $row3['address'];  ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px"><strong>Contact No.</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333;"><?php echo $row3['mobile'];  ?></td>
        </tr>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; "><strong>Doctor Name</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333;"><?php 
					  	$qry_doctor = mysqli_query($conn, "SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`id`='".$row3['doc_id']."'"); 
						$row3_doctor = mysqli_fetch_array($qry_doctor); 
					  echo $row3_doctor['name'];  ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Party Name</strong></td>
          <td style="border-bottom: 1px solid #333; padding-left:4px" ><?php echo $payor_name;  ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:left; vertical-align:top;font-size:15px;"><strong>Received Amount : Rupees <?php echo number_format(($row3['total']),2);?> Only</strong></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:left; vertical-align:top;font-size:14px;"><strong>Received With Thanks Rupees <?php echo ucwords(number_to_indian_rupees_convert($row3['total']));?> Only. By <?php echo $pay_mode;  ?></strong><br/></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17%" style="border-bottom: 1px solid #333; border-right: 1px solid #333; text-align:left;"><strong>Receipt Date</strong></td>
          <td width="17%" style="border-bottom: 1px solid #333;border-right: 1px solid #333;"><strong>Receipt No.</strong></td>
          <td width="17%" style="border-right: 1px solid #333; border-bottom: 1px solid #333; text-align:left; padding-right:9px"><strong>Deposit Type</strong></td>
          <td width="14%" style="border-right: 1px solid #333; border-bottom: 1px solid #333; text-align:left; padding-right:9px"><strong>Pay Type</strong></td>
          <td width="18%" style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-right:4px; text-align:left;"><strong>Chq/Ref.No.</strong></td>
          <td width="17%" style="padding-left:4px; border-bottom: 1px solid #333; text-align:right;"><strong>Net Amount</strong></td>
        </tr>
        <?php
		 $sql_payment_details = "SELECT `adavnce_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `adavnce_final_payment_billing` INNER JOIN `payment_mode_masters` ON `adavnce_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `adavnce_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `adavnce_final_payment_billing`.`i_id` = '".$id."' AND `adavnce_final_payment_billing`.`p_key`<>'5'  AND `adavnce_final_payment_billing`.`del_flag`='0' ";
$result_payment_details = $conn->query($sql_payment_details);
if($result_payment_details->num_rows > 0){
	while ($row2_payment_details=mysqli_fetch_array($result_payment_details,MYSQLI_ASSOC))
	{
		
		?>
        <tr>
          <td style="border-right: 1px solid #333; text-align:left;"><?php echo date("d/M/Y", strtotime($row2_payment_details['payment_date']));  ?></td>
          <td style="border-right: 1px solid #333;"><?php if($row2_payment_details['advance_bill_invoice_no']!=''){ $var_arr = preg_split ("/\//", $row2_payment_details['advance_bill_invoice_no']);
	echo $first_char=$var_arr[0]; }else{ echo $row3['invo_no'];}  ?></td>
          <td style="border-right: 1px solid #333; text-align:left; padding-right:9px"><?php echo $row2_payment_details['payment_type_name'];  ?></td>
          <td style="border-right: 1px solid #333; text-align:left; padding-right:9px"><?php echo $row2_payment_details['payment_mode_name'];  ?></td>
          <td style="border-right: 1px solid #333; padding-right:4px; text-align:left;"><?php echo $row2_payment_details['claim_no'];  ?></td>
          <td style="padding-left:4px; text-align:right;"><?php echo number_format(($row2_payment_details['p_value']),2);  ?></td>
        </tr>
        <?php 	}
}
		?>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Prepared by</strong> <br/>
      <?php $sql7_user="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";
					 $result7_user=$conn->query($sql7_user) ;	
					 $row7_user = $result7_user->fetch_assoc();
					 $count7_user=$result7_user->num_rows;
					 if($count7_user>0)
					 {
						echo $created_by=$row7_user['name'];
					 } ?></td>
    <td style="text-align:right; padding-right:9px;font-size: 11pt;"><strong>For: <?php echo $row_hospital_info['hospital_name'];  ?></strong></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:left; padding-right:9px;">This is Computerized Receipt, hence no signature required.</td>
  </tr>
</table>
<script>
window.print();
</script>
</body>
</html>
