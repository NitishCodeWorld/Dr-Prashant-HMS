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







$qry = mysqli_query($conn, "select * from `invoice_final_billing_for_draft_bill` where `id`='".$id."'"); // select query



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

$claim_no="";

$tpa_amt=0;

$sql_payment = "SELECT `invoice_final_payment_billing_for_draft_bill`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name`,`tpa_masters`.`name` AS `tpa_company` ,`insurance_masters`.`name` AS `insurance_company` FROM `invoice_final_payment_billing_for_draft_bill` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing_for_draft_bill`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing_for_draft_bill`.`payment_type` =`payment_type_masters`.`id` LEFT JOIN `tpa_masters` ON `invoice_final_payment_billing_for_draft_bill`.`tpa_name` =`tpa_masters`.`id` LEFT JOIN `insurance_masters` ON `invoice_final_payment_billing_for_draft_bill`.`insurance_name` =`insurance_masters`.`id`  WHERE `invoice_final_payment_billing_for_draft_bill`.`i_id` = '".$id."' AND `invoice_final_payment_billing_for_draft_bill`.`p_key`='5'  AND `invoice_final_payment_billing_for_draft_bill`.`del_flag`='0' ";

$result_payment = $conn->query($sql_payment);

if($result_payment->num_rows > 0){

	while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

	{

		$payor_name=$row2_payment['tpa_company'];

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
<title>IPD Bill</title>
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
    <td colspan="3" style="padding:6px; font-size:12pt; text-align:center; font-family:Arial, Helvetica, sans-serif"><strong><?php echo $cancled;  ?></strong></td>
  </tr>
  <tr>
    <td colspan="3" style="border: 2px solid #333; padding:6px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15%" style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Bill No.</strong></td>
          <td width="35%" style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/DRF/'.$row3['invo_no'];  ?></td>
          <td width="15%" style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px"><strong>Bill Date</strong></td>
          <td width="35%" style="padding-left:4px; border-bottom: 1px solid #333;"><?php echo date("d/M/Y", strtotime($row3['billing_date']));  ?> <?php echo date("h:i A", strtotime($row3['billing_time']));  ?></td>
        </tr>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Patient Name</strong></td>
          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $prefix.' '.$row3['name'];  ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px"><strong>Patient ID</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333;"><?php echo $row3['hospital_number'];  ?></td>
        </tr>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Age/Sex - DOB</strong></td>
          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $row3['age'].' Yrs'.$gen.$dob; ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px"><strong>Cons/Optm/Tech</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333;"><?php 

					  	$qry_doctor = mysqli_query($conn, "SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`id`='".$row3['doc_id']."'"); 

						$row3_doctor = mysqli_fetch_array($qry_doctor); 

					  echo $row3_doctor['name'];  ?>
            <?php		

						$sql2_additional_doc="SELECT `user_infos`.`name` FROM `additional_doctor_for_invoice_final_billing_for_draft_bill` INNER JOIN `user_infos` ON `additional_doctor_for_invoice_final_billing_for_draft_bill`.`additional_doctor_id` =`user_infos`.`users_id` WHERE `additional_doctor_for_invoice_final_billing_for_draft_bill`.`i_id`= '" .$id. "' AND `additional_doctor_for_invoice_final_billing_for_draft_bill`.`patient_registration_id`= '" .$row3['patient_registration_id']. "' AND `additional_doctor_for_invoice_final_billing_for_draft_bill`.`hospital_number`= '" .$row3['hospital_number']. "'  AND `additional_doctor_for_invoice_final_billing_for_draft_bill`.`del_flag`='0' ";



						 $result2_additional_doc=$conn->query($sql2_additional_doc) ;

						 $count_additional_doc=$result2_additional_doc->num_rows;

						 if($count_additional_doc>0){

						 while ($row2_additional_doc=mysqli_fetch_array($result2_additional_doc,MYSQLI_ASSOC))

						{

							echo ',<br>'.$row2_additional_doc['name'];



						} } ?></td>
        </tr>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Payor Name</strong></td>
          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $payor_name;  ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px"><strong>Mobile No.</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333;"><?php echo $row3['mobile'];  ?></td>
        </tr>
        <?php if($row3['admission_date']!=''){ ?>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Admission Date</strong></td>
          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php if($row3['admission_date']!=''){ echo date("d/M/Y", strtotime($row3['admission_date'])); } ?>
            <?php if($row3['admission_time']!=''){ echo date("h:i A", strtotime($row3['admission_time']));}  ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px"><strong>Discharge Date</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333;"><?php if($row3['date_of_discharge']!=''){ echo date("d/M/Y", strtotime($row3['date_of_discharge'])); } ?>
            <?php if($row3['time_of_discharge']!=''){ echo date("h:i A", strtotime($row3['time_of_discharge']));}  ?></td>
        </tr>
        <?php } ?>
        <?php if($row3['ref_doctor_id']!=''){ ?>
        <?php 
			$ref_by="";
					  	$qry_ref_by = mysqli_query($conn, "SELECT * FROM `doctor_masters_for_emr` WHERE `id`='".$row3['ref_doctor_id']."'"); 

						$row3_ref_by = mysqli_fetch_array($qry_ref_by); 

					  $ref_by=$row3_ref_by['doctor_name'];  ?>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333;"><strong>Ref By</strong></td>
          <td style="border-bottom: 1px solid #333; padding-left:4px"><?php echo $ref_by;  ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-left:4px"></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333;"></td>
        </tr>
        <?php } ?>
      </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <?php if($payor_name!='SELF'){ ?>
  <tr>
    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="30%" style="padding-left:4px;border-bottom: 1px solid #333; border-right: 1px solid #333; text-align:left;"><strong>Insurance Company</strong></td>
          <td width="70%" style="padding-left:4px; border-bottom: 1px solid #333; text-align:left;"><?php echo $insurance_name;  ?></td>
        </tr>
        <tr>
          <td width="30%" style="padding-left:4px;border-bottom: 1px solid #333; border-right: 1px solid #333; text-align:left;"><strong>Claim No.</strong></td>
          <td width="70%" style="padding-left:4px; border-bottom: 1px solid #333; text-align:left;"><?php echo $claim_no;  ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="6%" style="border-bottom: 1px solid #333; border-right: 1px solid #333; text-align:center;"><strong>Sl. No.</strong></td>
          <td width="61%" style="border-right: 1px solid #333; border-bottom: 1px solid #333; text-align:left; padding-right:9px"><strong>Service Name</strong></td>
          <td width="11%" style="padding-left:4px; border-bottom: 1px solid #333; text-align:right;border-right: 1px solid #333;"><strong>Total Amount</strong></td>
          <td width="11%" style="padding-left:4px; border-bottom: 1px solid #333; text-align:right;border-right: 1px solid #333;"><strong>Disc. Amount</strong></td>
          <td width="11%" style="padding-left:4px; border-bottom: 1px solid #333; text-align:right;"><strong>Net Amount</strong></td>
        </tr>
        <?php		

			$procedure_amount_tot=0;

			$procedure_discount_tot=0;

			$procedure_net_amount_tot=0;

			$sl_lab_proc=1;	

			

			$sql2_lab_proc="SELECT * FROM `invoice_final_procedure_for_draft_bill` WHERE `i_id`= '" .$id. "' AND `patient_registration_id`= '" .$row3['patient_registration_id']. "' AND `hospital_number`= '" .$row3['hospital_number']. "'  AND `del_flag`='0' ";

			 $result2_lab_proc=$conn->query($sql2_lab_proc) ;

			 while ($row2_lab_proc=mysqli_fetch_array($result2_lab_proc,MYSQLI_ASSOC))

				{



			?>
        <tr>
          <td style="border-bottom: 1px solid #333; border-right: 1px solid #333; text-align:center;"><?php echo $sl_lab_proc;  ?></td>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; text-align:left; padding-right:9px; text-transform:uppercase"><?php 

					  $qry_lab_test = mysqli_query($conn, "SELECT `procedure_name` FROM `procedure_masters`  where `id`='".$row2_lab_proc['procedure_id']."'");

						$row3_lab_test = mysqli_fetch_array($qry_lab_test); 

					  echo $row3_lab_test['procedure_name'];  ?>
            <?php if($row2_lab_proc['procedure_remarks']!='') { echo ' ( '.$row2_lab_proc['procedure_remarks'].' ) '; }  ?></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333; text-align:right;border-right: 1px solid #333;"><?php echo number_format(($row2_lab_proc['amount']),2);  ?></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333; text-align:right;border-right: 1px solid #333;"><?php echo number_format(($row2_lab_proc['discount']),2);  ?></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333; text-align:right;"><?php echo number_format(($row2_lab_proc['net_amount']),2);  ?></td>
        </tr>
        <?php

		  	$procedure_amount_tot=$procedure_amount_tot+$row2_lab_proc['amount'];

			$procedure_discount_tot=$procedure_discount_tot+$row2_lab_proc['discount'];

			$procedure_net_amount_tot=$procedure_net_amount_tot+$row2_lab_proc['net_amount'];

			$sl_lab_proc++;

		   } ?>
        <?php

		    $total_dicount=0;

		   

		    $total_dicount=($procedure_amount_tot-$row3['total']);

		   

		  

		   $paid_by_patient=$row3['total']-$tpa_amt;

		   $discount_reason="";

		   //if($row3['discount_type']=='F'){ $discount_reason= ' ( -'.$row3['discount'].' )'; }

		  // if($row3['discount_type']=='P'){ $discount_reason= ' ( '.$row3['discount'].'% )'; }

		   ?>
      </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <?php $default_rowspan=3;

  if($total_dicount>0){

	  $default_rowspan=$default_rowspan+3;

  }

   if($tpa_amt>0){

	  $default_rowspan=$default_rowspan+1;

  }

  $pt_amt_flag=0;

  ?>
  <tr>
    <td colspan="3" style="padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td rowspan="<?php echo $default_rowspan; ?>" style="text-align:left; vertical-align:top"><p><strong>Net Amount in words:</strong> Rupees
              <?php if($tpa_amt>0){ echo ucwords(number_to_indian_rupees_convert($tpa_amt));}else{ echo ucwords(number_to_indian_rupees_convert($row3['total'])); }?>
              only </p>
            <?php if($tpa_amt==$row3['total']){ $pt_amt_flag=1;}?>
            <?php if($pt_amt_flag==0){ ?>
            <table width="90%" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17%" style="border-bottom: 1px solid #333; border-right: 1px solid #333; text-align:left;" class="receipt_td"><strong>Receipt Date</strong></td>
                <td width="14%" style="border-bottom: 1px solid #333;border-right: 1px solid #333;" class="receipt_td"><strong>Recp. No.</strong></td>
                <td width="20%" style="border-right: 1px solid #333; border-bottom: 1px solid #333; text-align:left; " class="receipt_td" ><strong>Deposit Type</strong></td>
                <td width="14%" style="border-right: 1px solid #333; border-bottom: 1px solid #333; text-align:left; " class="receipt_td"><strong>Pay Type</strong></td>
                <td width="18%" style="border-right: 1px solid #333; border-bottom: 1px solid #333; padding-right:4px; text-align:left;" class="receipt_td"><strong>Chq/Ref.No.</strong></td>
                <td width="17%" style="padding-left:4px; border-bottom: 1px solid #333; text-align:right;" class="receipt_td"><strong>Net Amount</strong></td>
              </tr>
              <?php

		 $sql_payment_details = "SELECT `invoice_final_payment_billing_for_draft_bill`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing_for_draft_bill` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing_for_draft_bill`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing_for_draft_bill`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing_for_draft_bill`.`i_id` = '".$id."' AND `invoice_final_payment_billing_for_draft_bill`.`p_key`<>'5'  AND `invoice_final_payment_billing_for_draft_bill`.`del_flag`='0' ";

$result_payment_details = $conn->query($sql_payment_details);

if($result_payment_details->num_rows > 0){

	while ($row2_payment_details=mysqli_fetch_array($result_payment_details,MYSQLI_ASSOC))

	{

		

		?>
              <tr>
                <td style="border-right: 1px solid #333; text-align:left;" class="receipt_td"><?php echo date("d/M/Y", strtotime($row2_payment_details['payment_date']));  ?></td>
                <td style="border-right: 1px solid #333;" class="receipt_td"><?php if($row2_payment_details['advance_bill_invoice_no']!=''){ $var_arr = preg_split ("/\//", $row2_payment_details['advance_bill_invoice_no']);

	echo $first_char=$var_arr[0]; }else{ echo $row3['invo_no'];}  ?></td>
                <td style="border-right: 1px solid #333; text-align:left; " class="receipt_td"><?php echo $row2_payment_details['payment_type_name'];  ?></td>
                <td style="border-right: 1px solid #333; text-align:left; " class="receipt_td"><?php echo $row2_payment_details['payment_mode_name'];  ?></td>
                <td style="border-right: 1px solid #333; padding-right:4px; text-align:left;" class="receipt_td"><?php echo $row2_payment_details['claim_no'];  ?></td>
                <td style="padding-left:4px; text-align:right;" class="receipt_td"><?php echo number_format(($row2_payment_details['p_value']),2);  ?></td>
              </tr>
              <?php 	}

}

		?>
            </table>
            <?php  }?></td>
          <td width="25%" style="border-right: 1px solid #333; border-top: 1px solid #333; border-left: 1px solid #333; padding-right:4px; text-align:left;"><strong>Total Amount</strong></td>
          <td width="12%" style="padding-left:4px; border-top: 1px solid #333; border-right: 1px solid #333; text-align:right;"><?php echo number_format(($procedure_amount_tot),2);  ?></td>
        </tr>
        <?php if($total_dicount>0){ ?>
        <tr>
          <td style="border-right: 1px solid #333; border-top: 1px solid #333; border-left: 1px solid #333; padding-right:4px; text-align:left;"><strong>
            <?php if($row3['free_reason']!=''){ echo $row3['free_reason'].' '; }  ?>
            Discount <?php echo $discount_reason; ?></strong></td>
          <td style="padding-left:4px; border-top: 1px solid #333; border-right: 1px solid #333; text-align:right;"><?php echo number_format(($total_dicount),2);  ?></td>
        </tr>
        <tr>
          <td style="border-right: 1px solid #333; border-top: 1px solid #333; border-left: 1px solid #333; padding-right:4px; text-align:left;"><strong>Net Bill Amount</strong></td>
          <td style="padding-left:4px; border-top: 1px solid #333; border-right: 1px solid #333; text-align:right;"><?php echo number_format(($row3['total']),2);  ?></td>
        </tr>
        <?php } ?>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; border-top: 1px solid #333; border-left: 1px solid #333; padding-right:4px; text-align:left;"><strong>Paid Amount by Patient</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333; border-top: 1px solid #333; border-right: 1px solid #333; text-align:right;"><?php echo number_format(($paid_by_patient),2);  ?></td>
        </tr>
        <?php if($tpa_amt>0){ ?>
        <tr>
          <td style="border-right: 1px solid #333; border-bottom: 1px solid #333; border-top: 1px solid #333; border-left: 1px solid #333; padding-right:4px; text-align:left;"><strong>Payor Amount</strong></td>
          <td style="padding-left:4px; border-bottom: 1px solid #333; border-top: 1px solid #333; border-right: 1px solid #333; text-align:right;"><?php echo number_format(($tpa_amt),2);  ?></td>
        </tr>
        <?php }else{ ?>
        <tr>
          <td style="border-right: 0px solid #333; border-bottom: 0px solid #333; border-top: 0px solid #333; border-left: 0px solid #333; padding-right:4px; text-align:left;"><strong>&nbsp;</strong></td>
          <td style="border-right: 0px solid #333; border-bottom: 0px solid #333; border-top: 0px solid #333; border-left: 0px solid #333; padding-right:4px; text-align:left;"><strong>&nbsp;</strong></td>
        </tr>
        <?php } ?>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Patient / Attendant</strong></td>
    <td><strong>Prepared by</strong></td>
    <td style="text-align:right; padding-right:9px;font-size: 11pt;"><strong>For: <?php echo $row_hospital_info['hospital_name'];  ?></strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>
      <?php $sql7_user="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";

					 $result7_user=$conn->query($sql7_user) ;	

					 $row7_user = $result7_user->fetch_assoc();

					 $count7_user=$result7_user->num_rows;

					 if($count7_user>0)

					 {

						echo $created_by=$row7_user['name'];

					 } ?>
      </strong></td>
    <td style="text-align:right; padding-right:9px;"><strong>Authorized Signatory</strong></td>
  </tr>
</table>
<script>

window.print();

</script>
</body>
</html>
