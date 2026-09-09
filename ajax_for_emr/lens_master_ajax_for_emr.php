<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `lens_masters_name` FROM `lens_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$lens_masters_name=$row['lens_masters_name'];
$arr=array("id" => $id,"lens_masters_name" => $lens_masters_name);
echo json_encode($arr);
}

?> 

