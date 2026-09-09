<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `chief_complaints` FROM `chief_complaints_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$chief_complaints=$row['chief_complaints'];
$arr=array("id" => $id,"chief_complaints" => $chief_complaints);
echo json_encode($arr);
}

?> 

