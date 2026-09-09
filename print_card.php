<?php
include 'function.php';
include 'conn.php';

$id = $_REQUEST['id'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php

	$query_token = "SELECT * FROM `patient_registration_form` where `id` = '$id'";	
	$run_query_token=mysqli_query($conn,$query_token);	
	$row_token = $run_query_token->fetch_assoc();	
	$id = $row_token['id'];	
	if($row_token['dob']!=''){
	 $dob = date('d/m/Y',strtotime($row_token['dob']));	
	}else{
		$dob ="";
	}
	//$dob = $row_token['dob'];	
	$age = $row_token['age'];
	
	$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
	$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
	$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);
	
	
	$sql_doc_id ="SELECT * FROM `user_infos` WHERE `users_id`='".$row_token['admiting_doctor']."'";	
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
	
	$gender="";
	$sql_gender="SELECT * FROM `gender_masters` WHERE `id`='".$row_token['gender']."'";		
	$res_gender=mysqli_query($conn,$sql_gender);	
	$row_gender=mysqli_fetch_assoc($res_gender);	
	$count_gender=$res_gender->num_rows;	
	if($count_gender>0)	
	{	
		$gender=$row_gender['gender']; 	
	}

 ?>

<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8" />
<title>Print UHID Card</title>
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
#page-wrap {
	width: 450px;
}
</style>
</head>

<body>
<div id="page-wrap" style="margin-top:15px;margin-left:200px;">
  <div style="float:left;width:285px">
    <p style="line-height: 2px;font-size:16px;"><b>&nbsp;&nbsp;<?php echo $row_hospital_info['hospital_name'];  ?></b></p>
    <!--<p style="line-height: 2px;font-size:10px;">&nbsp;&nbsp;&nbsp; <pre style="font-size:10px;"><?php echo $row_hospital_info['address'];  ?></pre></p>-->
    <p style="line-height: 10px;font-size:10px;">&nbsp;<?php echo $row_hospital_info['address'];  ?></p>
    <p style="line-height: 2px;font-size:10px;">&nbsp;Email : <?php echo $row_hospital_info['email'];  ?></p>
    <p style="line-height: 2px;font-size:10px;">&nbsp;Phone : <?php echo $row_hospital_info['final_bill_mobile'];  ?></p>
    <p style="line-height: 10px;font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>UHID NO. : <?php echo $row_token['uhid_no']; ?></b></p>
    <p style="line-height: 2px;font-size:12px;"><b>Name :</b>&nbsp;&nbsp;&nbsp; <?php echo $prefix; ?> <?php echo $row_token['patient_name']; ?> </p>
    <p style="line-height: 2px;font-size:12px;"><b>Sex :</b>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $gender;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php if($age != ''){ ?>
      <b>Age :</b>&nbsp;&nbsp; <?php echo $age;}else{ ?> <b>Date of Birth :</b>&nbsp;&nbsp;<?php echo $dob;} ?> </p>
    <p style="line-height: 2px;font-size:12px;"><b>Phone :</b>&nbsp;&nbsp;&nbsp; <?php echo $row_token['phone_no'];?></p>
    <p style="line-height:6px;font-size:12px;"><b>Date of Issue :</b>&nbsp;<?php  echo date("d/M/Y", strtotime($row_token['registration_date'])); ?></p>
    <p style="line-height:6px;font-size:12px;"><b>Consulting Doctor :</b>&nbsp;<?php  echo $row_id_doc_name['name']; ?></p>
    <p style="line-height: 10px;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please bring this card on your next visit</p>
    <p style="line-height: 2px;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>visit : <?php echo $row_hospital_info['website'];  ?></b></p>
  </div>
  <div style="float:left;width:50px"> <img src="<?php echo ADMIN_URL.'upload/right_side_logo/'.$row_hospital_info['right_side_logo'];  ?>" style="margin-left:-60px;"  ></div>
</div>
<script>

window.print();

</script>
</body>
</html>