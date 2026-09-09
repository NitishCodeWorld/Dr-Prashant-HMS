<?php
include '../conn.php';
$dose_id=$_REQUEST["dose_id"];
$drugsheet_time=$_REQUEST["drugsheet_time"];
$sql="SELECT  `times` FROM `medicine_timing_masters` WHERE  `id`='".$dose_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$times=$row['times'];
$qty=$times*$drugsheet_time;
$arr=array("qty" => $qty);
echo json_encode($arr);
}

?> 

