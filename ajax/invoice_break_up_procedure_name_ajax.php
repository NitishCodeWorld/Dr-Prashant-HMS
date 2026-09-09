<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `break_up_procedure_name`,`ipd_flag` FROM `invoice_break_up_procedure_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$break_up_procedure_name=$row['break_up_procedure_name'];
$ipd_flag=$row['ipd_flag'];
$arr=array("id" => $id,"break_up_procedure_name" => $break_up_procedure_name,"ipd_flag" => $ipd_flag);
echo json_encode($arr);
}
?> 

