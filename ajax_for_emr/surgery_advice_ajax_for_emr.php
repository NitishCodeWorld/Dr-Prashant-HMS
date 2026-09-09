<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `surgery_advice` FROM `surgery_advice_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$surgery_advice=$row['surgery_advice'];
$arr=array("id" => $id,"surgery_advice" => $surgery_advice);
echo json_encode($arr);
}

?> 

