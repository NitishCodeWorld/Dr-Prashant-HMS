<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql10="SELECT * FROM `procedure_bifarcation_masters` WHERE `main_procedure_id`='".$optom_id."' AND `del_flag`='0'";
$result10=$conn->query($sql10) ;				
$row10 = $result10->fetch_assoc();
$count10=$result10->num_rows;

$sql="SELECT `id`, `procedure_name`, `pt_type`, `ipd_flag`, `amount`  FROM `procedure_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$procedure_name=$row['procedure_name'];
$pt_type=$row['pt_type'];
$amount=$row['amount'];
$ipd_flag=$row['ipd_flag'];
$arr=array("id" => $id,"procedure_name" => $procedure_name,"pt_type" => $pt_type,"amount" => $amount,"ipd_flag" => $ipd_flag,"ct" =>$count10);
echo json_encode($arr);
}
?> 