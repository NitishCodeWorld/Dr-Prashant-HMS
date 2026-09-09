<?php
include '../conn.php';
$optom_id=$_POST["id"];

$sql="SELECT `id`, `a_name`,`a_phone`,`a_address` FROM `agent_name_master` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$a_name=$row['a_name'];
$a_phone=$row['a_phone'];
$a_address=$row['a_address'];
$arr=array("id" => $id,"a_name" => $a_name,"a_phone" => $a_phone,"a_address" => $a_address);
echo json_encode($arr);
}

?> 

