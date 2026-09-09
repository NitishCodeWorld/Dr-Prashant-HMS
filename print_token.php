<?php
include 'function.php';
include 'conn.php';

$id = $_REQUEST['id'];
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

?>
<?php

  $query_token = "SELECT * FROM `patient_slip_generate_form` where id = '$id'";

  $run_query_token=mysqli_query($conn,$query_token);

  $row_token = $run_query_token->fetch_assoc();

  $doc_id_token = $row_token['admiting_doctor'];

  $patient_id = $row_token['registration_unique_id'];

  $ref_doctor = $row_token['doctor_id'];  

	$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
	$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
	$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);
  		 

  $sql_doc_id ="SELECT * FROM `user_infos` WHERE `users_id`='$doc_id_token'";

  $sql_doc_id_fetch=mysqli_query($conn,$sql_doc_id);

  $row_id_doc_name = $sql_doc_id_fetch->fetch_assoc(); 
  
$prefix="";
$sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_token['prefix']."'";	
$res_prefix=mysqli_query($conn,$sql_prefix);
$row_prefix=mysqli_fetch_assoc($res_prefix);
$count_prefix=$res_prefix->num_rows;
if($count_prefix>0)
{
	$prefix=$row_prefix['prefix_name']; 
}

$purpose_visit="";
$sql_purpose_visit="SELECT * FROM `purposevisit_masters_for_emr` WHERE `id`='".$row_token['purpose_visit_id']."'";	
$res_purpose_visit=mysqli_query($conn,$sql_purpose_visit);
$row_purpose_visit=mysqli_fetch_assoc($res_purpose_visit);
$count_purpose_visit=$res_purpose_visit->num_rows;
if($count_purpose_visit>0)
{
	$purpose_visit=$row_purpose_visit['purpose_visit']; 
}

$payment_status="";
$sql_payment_status="SELECT * FROM `patient_payment_status_masters` WHERE `id`='".$row_token['patient_payment_status']."'";	
$res_payment_status=mysqli_query($conn,$sql_payment_status);
$row_payment_status=mysqli_fetch_assoc($res_payment_status);
$count_payment_status=$res_payment_status->num_rows;
if($count_payment_status>0)
{
	$payment_status=$row_payment_status['payment_status']; 
}
?>

<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8" />
<title>Print Token</title>
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
<style>
@page {
 size: A4;
 margin: 0;
}
 @media print {
html, body {
	width: 210mm;
	height: 100mm;
}
}
</style>
</head>

<body>
<div style="margin-top:30px;margin-left:200px;">
  <p style="line-height: 2px;"> <img src="<?php echo ADMIN_URL.'upload/right_side_logo/'.$row_hospital_info['right_side_logo'];  ?>" style="margin-left:50px;" ></p>
  <p style="line-height: 2px; font-size:13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>UHID NO. :
    <?php if($row_token['uhid_no'] != ''){echo $row_token['uhid_no'];}?>
    </b></p>
  <p style="line-height: 2px;font-size:12px;"><b>Reporting :</b>&nbsp;&nbsp;
    <?php  echo date("d/M/Y", strtotime($row_token['registration_date']));  ?>
    &nbsp;&nbsp;<b>at</b>&nbsp;
    <?php   echo date("h:i A", strtotime($row_token['registration_time']));?>
  </p>
  <p style="line-height:2px;font-size:12px;"><b>Name :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $prefix; ?> <?php echo $row_token['patient_name']; ?></p>
  <p style="line-height: 2px;font-size:12px;"><b>Phone :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_token['phone_no']; ?> &nbsp;&nbsp;<b>SL.</b> <?php echo $row_token['sl'];?></p>
  <?php if($row_token['email_id'] != ''){ ?>
  <p style="line-height: 2px;font-size:12px;"><b>Email :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_token['email_id']; ?></p>
  <?php } ?>
  <p style="line-height:6px;font-size:12px;"><b>Doctor :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $row_id_doc_name['name']; ?>
  </p>
  <p style="line-height:2px;font-size:12px;"><b>Purpose :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $purpose_visit;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>
  <p style="line-height:6px;font-size:12px;"><b>Status :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $payment_status; ?>
  </p>
  <?php if($row_token['doctor_id']!=''){  ?>
  <p style="line-height:2px;font-size:12px;"><b>Ref from :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php 
 
  $ref = $row_token['doctor_id'];

  $sql_ref_doc_id ="SELECT * FROM `doctor_masters_for_emr` WHERE `id`='$ref'";

  $sql_ref_doc_id_fetch=mysqli_query($conn,$sql_ref_doc_id);

  $row_ref_doc_name = $sql_ref_doc_id_fetch->fetch_assoc(); 

echo $row_ref_doc_name['doctor_name'];

?>
  </p>
  <?php } ?>
  <p style="line-height:2px;font-size:12px;text-transform:capitalize"><b>Prepared By:</b>
    <?php $sql7_user="SELECT `name` FROM `user_infos` Where `users_id`='".$row_token['created_by']."'";

					 $result7_user=$conn->query($sql7_user) ;	

					 $row7_user = $result7_user->fetch_assoc();

					 $count7_user=$result7_user->num_rows;

					 if($count7_user>0)

					 {

						echo $created_by=$row7_user['name'];

					 }  ?>
  </p>
</div>
<script>

window.print();

</script>
</body>
</html>