<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `medication_package` FROM `medication_package_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$investigation_package=$row['medication_package'];
$arr=array("id" => $id, "medication_package" => $investigation_package);
echo json_encode($arr);
}
?> 

