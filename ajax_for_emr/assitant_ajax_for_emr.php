<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `assitant_name` FROM `assitants_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$assitant_name=$row['assitant_name'];
$arr=array("id" => $id,"assitant_name" => $assitant_name);
echo json_encode($arr);
}

?> 

