<?php
include '../conn.php';
$request_id=$_POST["id"];
$sql="SELECT `id`, `doctor_name`, `medical_no` FROM `doctor_masters` WHERE `id`='".$request_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$doctor_name=$row['doctor_name'];
$medical_no=$row['medical_no'];
$arr=array("id" => $id,"doctor_name" => $doctor_name,"medical_no" => $medical_no);
echo json_encode($arr);
}
?> 