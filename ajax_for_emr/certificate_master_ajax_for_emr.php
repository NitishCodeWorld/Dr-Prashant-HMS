<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `certificate_masters_name` FROM `certificate_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$certificate_masters_name=$row['certificate_masters_name'];
$arr=array("id" => $id,"certificate_masters_name" => $certificate_masters_name);
echo json_encode($arr);
}

?> 

