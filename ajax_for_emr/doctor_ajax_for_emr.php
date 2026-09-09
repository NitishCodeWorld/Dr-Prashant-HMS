<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `doctor_name`,`phone_no`, `doctor_email` FROM `doctor_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$doctor_name=$row['doctor_name'];
$phone_no=$row['phone_no'];
$doctor_email=$row['doctor_email'];
$arr=array("id" => $id,"doctor_name" => $doctor_name,"phone_no" => $phone_no,"doctor_email" => $doctor_email);
echo json_encode($arr);
}

?> 

