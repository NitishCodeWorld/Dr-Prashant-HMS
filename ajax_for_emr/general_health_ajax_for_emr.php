<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `general_health_text` FROM `general_health_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$general_health_text=$row['general_health_text'];
$arr=array("id" => $id,"general_health_text" => $general_health_text);
echo json_encode($arr);
}

?> 

