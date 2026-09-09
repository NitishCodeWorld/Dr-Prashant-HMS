<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `location`, `location_address`, `phone_no`, `email`, `logo` FROM `location_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$location=$row['location'];
$location_address=$row['location_address'];
$phone_no=$row['phone_no'];
$email=$row['email'];
$logo=$row['logo'];
$arr=array("id" => $id,"location" => $location,"location_address" => $location_address,"phone_no" => $phone_no,"email" => $email,"logo" => $logo);
echo json_encode($arr);
}

?> 

