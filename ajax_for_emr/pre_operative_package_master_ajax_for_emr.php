<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `pre_operative_package` FROM `pre_operative_package_master_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$pre_operative_package=$row['pre_operative_package'];

$arr=array("id" => $id,"pre_operative_package" => $pre_operative_package);
echo json_encode($arr);
}

?> 

