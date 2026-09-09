<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `stock_name` FROM `ot_summary_stock_id` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$stock_name=$row['stock_name'];
$arr=array("id" => $id,"stock_name" => $stock_name);
echo json_encode($arr);
}

?> 

