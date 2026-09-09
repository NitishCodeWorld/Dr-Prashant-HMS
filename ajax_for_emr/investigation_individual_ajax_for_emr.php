<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `investigation_individual` FROM `investigation_individual_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$investigation_individual=$row['investigation_individual'];
$arr=array("id" => $id, "investigation_individual" => $investigation_individual);
echo json_encode($arr);
}
?> 

