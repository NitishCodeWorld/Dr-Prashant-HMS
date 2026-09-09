<?php

include '../conn.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$request_id=$_POST["id"];

$sql="SELECT * FROM `patient_registration_form` WHERE `uhid_no`='".$request_id."' ORDER BY `id` DESC LIMIT 1";

$result=$conn->query($sql) ;

$count=$result->num_rows;

$row = $result->fetch_assoc();

if($count>0)

{
$id=$row['id'];

$uhid_no=$row['uhid_no'];

$patient_name=$row['patient_name'];

$admiting_doctor=$row['admiting_doctor'];

$prefix=$row['prefix'];

if($row['dob']==''){

	$dob='';

}else{

	$dob=date("d-m-Y", strtotime($row['dob']));

}

$age=$row['age'];

$gender=$row['gender'];

$phone_no=$row['phone_no'];

$email_id=$row['email_id'];

$alternate_phone_no=$row['alternate_phone_no'];

$address=$row['address'];

$zip_code=$row['zip_code'];

$district=$row['district'];
$registration_date=$row['registration_date'];
$registration_time=$row['registration_time'];

$flag=1;



}
$doctor_id='';
$sql="SELECT * FROM `prescription_details_for_emr` WHERE `mrd_no`='".$request_id."' AND `doctor_id`<>'' ORDER BY `id` DESC LIMIT 1";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
	$doctor_id=$row['doctor_id'];
}
$reffered_other_doc='';
if($doctor_id==''){
	
	$sql="SELECT * FROM `prescription_details_for_emr` WHERE `mrd_no`='".$request_id."' AND `reffered_other_doc`<>'' ORDER BY `id` DESC LIMIT 1";
	$result=$conn->query($sql) ;
	$count=$result->num_rows;
	$row = $result->fetch_assoc();
	if($count>0)
	{
		$reffered_other_doc=$row['reffered_other_doc'];
	}
}




$arr=array("id" => $id,"uhid_no" => $uhid_no,"patient_name" => $patient_name,"admiting_doctor" => $admiting_doctor,"prefix" => $prefix,"dob" => $dob,"age" => $age,"gender" => $gender,"phone_no" => $phone_no,"email_id" => $email_id,"alternate_phone_no" => $alternate_phone_no,"address" => $address,"zip_code" => $zip_code,"district" => $district,"registration_date" => $registration_date,"registration_time" => $registration_time,"doctor_id" => $doctor_id,"reffered_other_doc" => $reffered_other_doc);

echo json_encode($arr);

?> 