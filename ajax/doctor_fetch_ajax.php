<?php
include '../conn.php';
$request_id=$_POST["id"];
$sql="SELECT `id`, `doctor_name`, `medical_no` FROM `doctor_masters` WHERE `id`='".$request_id."' ";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$medical_no=$row['medical_no'];
$arr=array("medical_no" => $medical_no);
echo json_encode($arr);
}
?> 