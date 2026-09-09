<?php

include '../conn.php';

$request_id=$_POST["id"];

$sql="SELECT * FROM `doctor_masters_for_emr` WHERE `id`='".$request_id."'";

$result=$conn->query($sql) ;

$count=$result->num_rows;

$row = $result->fetch_assoc();

if($count>0)

{

$id=$row['id'];

$doctor_name=$row['doctor_name'];

$doctor_mob=$row['doctor_mob'];
$doctor_ini=$row['doctor_ini'];

$doctor_email=$row['doctor_email'];

$arr=array("id" => $id,"doctor_name" => $doctor_name,"doctor_mob" => $doctor_mob,"doctor_email" => $doctor_email,"doctor_ini" => $doctor_ini);

echo json_encode($arr);

}

?> 