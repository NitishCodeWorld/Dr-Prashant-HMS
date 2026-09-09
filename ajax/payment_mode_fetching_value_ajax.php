<?php
include '../conn.php';
$p_key_id=$_POST["p_key_id"];
$sql="SELECT * FROM `payment_mode_masters` WHERE `id`='".$p_key_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$cheque_mode=$row['cheque_mode'];
$tpa_mode=$row['tpa_mode'];
$govt_health_mode=$row['govt_health_mode'];
$arr=array("cheque_mode" => $cheque_mode,"tpa_mode" => $tpa_mode,"govt_health_mode" => $govt_health_mode);
echo json_encode($arr);
}
?> 