<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `investigation_package` FROM `investigation_package_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$investigation_package=$row['investigation_package'];

$arr=array("id" => $id,"investigation_package" => $investigation_package);
echo json_encode($arr);
}

?> 

