<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `fundus` FROM `fundus_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$fundus=$row['fundus'];
$arr=array("id" => $id,"fundus" => $fundus);
echo json_encode($arr);
}

?> 

