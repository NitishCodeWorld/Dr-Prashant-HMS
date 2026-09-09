<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `past_ocular_text` FROM `past_ocular_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$past_ocular_text=$row['past_ocular_text'];
$arr=array("id" => $id,"past_ocular_text" => $past_ocular_text);
echo json_encode($arr);
}

?> 

