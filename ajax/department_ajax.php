<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `department` FROM `department_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$department=$row['department'];
$arr=array("id" => $id,"department" => $department);
echo json_encode($arr);
}
?> 