<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `surgery_risk` FROM `surgery_risk_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$surgery_risk=$row['surgery_risk'];
$arr=array("id" => $id,"surgery_risk" => $surgery_risk);
echo json_encode($arr);
}

?> 

