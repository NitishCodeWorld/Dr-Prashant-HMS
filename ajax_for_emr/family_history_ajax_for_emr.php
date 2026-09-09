<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `family_history` FROM `family_history_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$family_history=$row['family_history'];
$arr=array("id" => $id,"family_history" => $family_history);
echo json_encode($arr);
}

?> 

