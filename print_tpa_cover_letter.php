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



	$cancled=" INVOICE ( Cancelled Bill )";



}else{

	$cancled=" INVOICE ";	

}

if($row3['opd_flag']==1){

	$bill_for='OPD';

}else{

	$bill_for='IPD';

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

									

$sql_dob="select * from `patient_registration_form` Where `uhid_no`='".$row3['hospital_number']."' ";

$result_dob=$conn->query($sql_dob) ;

$row_dob=mysqli_fetch_assoc($result_dob);

if($row_dob['dob']!=''){

	$dob=' '.date("d/M/Y", strtotime($row_dob['dob']));

}else{

	$dob="";

}



$payor_name="SELF";

$insurance_name="";

$tpa_company_address="";

$claim_no="";

$tpa_amt=0;

$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name`,`tpa_masters`.`name` AS `tpa_company` ,`insurance_masters`.`name` AS `insurance_company`,`tpa_masters`.`address` AS `tpa_company_address`  FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id` LEFT JOIN `tpa_masters` ON `invoice_final_payment_billing`.`tpa_name` =`tpa_masters`.`id` LEFT JOIN `insurance_masters` ON `invoice_final_payment_billing`.`insurance_name` =`insurance_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$id."' AND `invoice_final_payment_billing`.`p_key`='5'  AND `invoice_final_payment_billing`.`del_flag`='0' ";

$result_payment = $conn->query($sql_payment);

if($result_payment->num_rows > 0){

	while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

	{

		$payor_name=$row2_payment['tpa_company'];

		$tpa_company_address=$row2_payment['tpa_company_address'];

		$insurance_name=$row2_payment['insurance_company'];

		$claim_no=$row2_payment['claim_no'];

		$tpa_amt=$tpa_amt+$row2_payment['p_value'];

		

	}

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>TPA COVER LETTER</title>

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

	vertical-align:middle !important;

	font-family:Arial, Helvetica, sans-serif;

	text-align:left;

	font-size:9pt;

	padding: 2px;

}

</style>

</head>



<body style="padding:25px;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <!--<tr>

    <td width="1276" style="border-left: 2px solid #333; border-top: 2px solid #333; border-bottom: 2px solid #333; padding:6px; text-align:LEFT"><h2 style="margin:0px"><?php echo $row_hospital_info['final_bill_unit'];  ?></h2>

      -----------------------------------------------------------------------------------------------------------------------<br />

      <strong><?php echo $row_hospital_info['building'];  ?></strong><br />

      <?php echo $row_hospital_info['address'];  ?><br />

      Tel / Fax: <?php echo $row_hospital_info['phone'];  ?> | Mob: <?php echo $row_hospital_info['mobile'];  ?><br />

      Email: <?php echo $row_hospital_info['email'];  ?> | Web: <?php echo $row_hospital_info['website'];  ?><br />

      Join Us: <?php echo $row_hospital_info['hospital_unit'];  ?></td>

    <td width="139" style="border-right: 2px solid #333; border-top: 2px solid #333; border-bottom: 2px solid #333; padding:6px; text-align:center"><img src="<?php echo ADMIN_URL.'upload/right_side_logo/'.$row_hospital_info['right_side_logo'];  ?>" alt="Sumetra" /></td>
border: 2px solid #333; 
  </tr>-->
 <tr>
	<td width="500">&nbsp;</td>
    <td width="150"> &nbsp; </td>
 </tr>
 
 <tr>
	<td colspan="2">&nbsp; <br /><br /><br /><br /><br /><br /><br /><br /><br /></td>
 </tr>

  <tr>

    <td style="padding:6px; font-size:10pt; text-align:left; font-family:Arial, Helvetica, sans-serif"><strong><?php echo $payor_name;  ?></strong><br />

      <?php echo nl2br($tpa_company_address);  ?></td>

    <td style="padding:6px; font-size:10pt; text-align:right; font-family:Arial, Helvetica, sans-serif"><strong>Date:</strong> <?php echo date("d/m/Y", strtotime($row3['billing_date']));  ?></td>

  </tr>

  <tr>

    <td colspan="2" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td colspan="2" style="border-bottom: 1px solid #333; text-align:center; font-size:11pt;"><strong>TPA Dispatch Details</strong></td>

        </tr>

        <tr>

          <td width="13%" style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>TPA Name</strong></td>

          <td width="87%" style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $payor_name;  ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Insurer Name</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $insurance_name;  ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Patient Name</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $prefix.' '.$row3['name'];  ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>DOA</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php if($row3['admission_date']!=''){ echo date("d/m/Y", strtotime($row3['admission_date'])); } ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>DOD</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php if($row3['date_of_discharge']!=''){ echo date("d/m/Y", strtotime($row3['date_of_discharge'])); } ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Patient Ref No.</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $row3['hospital_number'];  ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Diagnosis</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $row3['diagnosis'];  ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Bill No.</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row3['invo_no'];  ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Claim No.</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $claim_no;  ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Card No.</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $row3['card_no'];  ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Policy No.</strong></td>

          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $row3['policy_no'];  ?></td>

        </tr>

        <tr>

          <td style="border-right: 1px solid #333;"><strong>Claim Amount</strong></td>

          <td style="padding-left:4px">Rs.<?php echo $tpa_amt;  ?>/- <span style="padding-left:15px">(Rupees

            <?php if($tpa_amt>0){ echo ucwords(number_to_indian_rupees_convert($tpa_amt));}?>

            )</span></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="2">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2">We request you to kindly process the claim with the below enclosed documents and make the payment at the earliest and oblige.<br />

      Please quote Invoice No and Ref No for clarifications in this matter.<br />

      N.B.: Kindly provide any query, if raised, within 7 (seven) working days, shouid be mailed to sunetrafecc.kol@gmail.com</td>

  </tr>

  <tr>

    <td colspan="2">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="text-align:left; padding-right:9px;"><strong>With regards,<br />

      </strong>Yours truly,<br />

      For <?php echo $row_hospital_info['hospital_name'];  ?><br />

      (<?php echo $row_hospital_info['final_bill_unit'];  ?>) </td>

  </tr>

  <tr>

    <td colspan="2" style="text-align:right; padding-right:9px;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="text-align:right; padding-right:9px;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="text-align:left; padding-right:9px;"><strong>Authorized Signatory</strong></td>

  </tr>

  <tr>

    <td colspan="2" style="text-align:left; padding-right:9px;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="text-align:left; padding-right:9px;">Encl:</td>

  </tr>

  <tr>

    <td colspan="2" style="text-align:left; padding-right:9px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td width="68%" rowspan="2">1. Copy of Patient's ID cards<br />

            2. Copy of Insurance Policy Certificate<br />

            3. Original Pre-Authorization request form<br />

            4. Copy of Authorization Letter<br />

            5. Original Discharge summary with IOL sticker<br />

            6. Original Composite bill with details break-up<br />

            7. Original Pre-operative preparation &amp; admission advice</td>

          <td width="32%" style="text-align:center;"><strong>Our Bank Details</strong></td>

        </tr>

        <tr>

          <td style="text-align:left; padding:4px; border:2px solid #333"><strong>A/c Name: </strong>CALCUTTA EYE RESEARCH FOUNDATION<br />

            <strong>Bank Name: </strong>AXIS BANK LTD<br />

            <strong>Branch:</strong> GOLPARK<br />

            <strong>A/c Number: </strong>011010100095673<br />

            <strong>A/c Type: </strong>SAVINGS<br />

            <strong>IFSC:</strong> UTIB0000011</td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="2" style="text-align:left; padding-right:9px;">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" style="text-align:left; padding-right:9px;">&nbsp;</td>

  </tr>

</table>

<script>

window.print();

</script>

</body>

</html>

