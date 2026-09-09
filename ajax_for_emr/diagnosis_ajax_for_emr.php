<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `code`, `diagnosis` FROM `diagnosis_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$code=$row['code'];
$diagnosis=$row['diagnosis'];
$arr=array("id" => $id,"code" => $code,"diagnosis" => $diagnosis);
echo json_encode($arr);
}
?> 

