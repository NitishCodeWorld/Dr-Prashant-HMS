<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `gender` FROM `gender_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$gender=$row['gender'];
$arr=array("id" => $id,"gender" => $gender);
echo json_encode($arr);
}

?> 

