<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `payment_mode_name`,`cheque_mode`,`tpa_mode`,`govt_health_mode` FROM `payment_mode_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$payment_mode_name=$row['payment_mode_name'];
$cheque_mode=$row['cheque_mode'];
$tpa_mode=$row['tpa_mode'];
$govt_health_mode=$row['govt_health_mode'];

$arr=array("id" => $id,"payment_mode_name" => $payment_mode_name,"cheque_mode" => $cheque_mode,"tpa_mode" => $tpa_mode,"govt_health_mode" => $govt_health_mode);
echo json_encode($arr);
}

?> 

