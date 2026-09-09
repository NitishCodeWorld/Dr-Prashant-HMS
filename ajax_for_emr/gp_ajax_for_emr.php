<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `gp_name` FROM `gp_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$gp_name=$row['gp_name'];
$arr=array("id" => $id,"gp_name" => $gp_name);
echo json_encode($arr);
}

?> 

