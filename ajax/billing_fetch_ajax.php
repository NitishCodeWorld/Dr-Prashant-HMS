<?php

include '../conn.php';

$request_id=$_POST["id"];



$arr=array();

$sql="SELECT * FROM `patient_registration_form` WHERE `uhid_no`='".$request_id."' ORDER BY `id` DESC LIMIT 1";

$result=$conn->query($sql) ;

$count=$result->num_rows;

$row = $result->fetch_assoc();

if($count>0)

{

$id=$row['id'];

$uhid_no=$row['uhid_no'];

$name=$row['patient_name'];

$age=$row['age'];

$mobile=$row['phone_no'];

$gender=$row['gender'];

$admiting_doctor=$row['admiting_doctor'];

$address=$row['address'];

$prefix=$row['prefix'];

$flag=1;

$arr=array("id" => $id,"uhid_no" => $uhid_no,"name" => $name,"mobile" => $mobile,"gender" => $gender,"admiting_doctor" => $admiting_doctor,"flag" => $flag,"age" => $age,"prefix" => $prefix,"address" => $address);

}

echo json_encode($arr);

?> 