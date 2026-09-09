<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `anterior_segment` FROM `anterior_segment_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$anterior_segment=$row['anterior_segment'];
$arr=array("id" => $id,"anterior_segment" => $anterior_segment);
echo json_encode($arr);
}

?> 

