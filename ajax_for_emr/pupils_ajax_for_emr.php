<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `pupils` FROM `pupils_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$pupils=$row['pupils'];
$arr=array("id" => $id,"pupils" => $pupils);
echo json_encode($arr);
}

?> 

