<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `general_information_masters_name` FROM `general_information_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$general_information_masters_name=$row['general_information_masters_name'];
$arr=array("id" => $id,"general_information_masters_name" => $general_information_masters_name);
echo json_encode($arr);
}

?> 

