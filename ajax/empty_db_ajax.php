<?php
include '../conn.php';
$id=$_POST["id"];
$table_name=$_POST["table_name"];
$sql="SELECT `id`, `db_name` FROM `$table_name` WHERE `id`='".$id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$db_name=$row['db_name'];
$arr=array("id" => $id,"db_name" => $db_name);
echo json_encode($arr);
}
?> 

