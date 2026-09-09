<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `options` FROM `system_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$sys=$row['options'];
$arr=array("id" => $id,"options" => $sys);
echo json_encode($arr);
}

?> 

