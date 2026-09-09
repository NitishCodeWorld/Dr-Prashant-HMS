<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `procedure_name` FROM `procedure_details_master_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$procedure_name=$row['procedure_name'];
$arr=array("id" => $id,"procedure_name" => $procedure_name);
echo json_encode($arr);
}

?> 

