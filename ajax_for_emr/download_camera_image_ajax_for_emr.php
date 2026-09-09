<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `prescription_id`, `url`, `mrd_no` FROM `cameraimg_lists_for_emr` WHERE `prescription_id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$prescription_id=$row['prescription_id'];
$mrd_no=$row['mrd_no'];
$url=$row['url'];

$arr=array("id" => $id,"prescription_id" => $prescription_id,"mrd_no" => $mrd_no,"url" => $url);
echo json_encode($arr);
}

?> 

