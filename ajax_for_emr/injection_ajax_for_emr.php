<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `name` FROM `injections_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$name=$row['name'];
$arr=array("id" => $id, "name" => $name);
echo json_encode($arr);
}
?> 

