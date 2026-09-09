<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `prefix_name` ,`default_gender` FROM `prefix_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();

if($count>0)
{
$id=$row['id'];
$prefix_name=$row['prefix_name'];
$default_gender=$row['default_gender'];

$arr=array("id" => $id,"prefix_name" => $prefix_name,"default_gender" => $default_gender);
echo json_encode($arr);
}
?> 



