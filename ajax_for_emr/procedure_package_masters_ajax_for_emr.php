<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `procedure_package` FROM `procedure_package_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$procedure_package=$row['procedure_package'];

$arr=array("id" => $id,"procedure_package" => $procedure_package);
echo json_encode($arr);
}

?> 

