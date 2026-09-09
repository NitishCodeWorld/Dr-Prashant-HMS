<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `purpose_visit` FROM `purposevisit_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$purpose_visit=$row['purpose_visit'];
$arr=array("id" => $id,"purpose_visit" => $purpose_visit);
echo json_encode($arr);
}
?> 



