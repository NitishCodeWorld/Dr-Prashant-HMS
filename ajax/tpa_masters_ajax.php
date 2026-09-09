<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `name`,`address` FROM `tpa_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;

$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
	$id=$row['id'];
	$name=$row['name'];
	$address=$row['address'];
	
	$arr=array("id" => $id,"name" => $name,"address" => $address);
	
	echo json_encode($arr);

}
?> 