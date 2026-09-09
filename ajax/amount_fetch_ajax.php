<?php
include '../conn.php';
$procedure_id=$_POST["id"];
$pt_type=$_POST["pt_type"];
$sql_bifarcation="SELECT  `sub_amount` FROM `procedure_bifarcation_masters` WHERE `main_procedure_id`='".$procedure_id."' AND `del_flag`='0' AND `procedure_package_subtext`='".$pt_type."' ORDER BY `id` DESC ";
$result_bifarcation=$conn->query($sql_bifarcation) ;
$count_bifarcation=$result_bifarcation->num_rows;
$row_bifarcation = $result_bifarcation->fetch_assoc();
if($count_bifarcation>0)
{
$amount=$row_bifarcation['sub_amount'];
}
if($count_bifarcation==0)
{
$sql="SELECT  `amount` FROM `procedure_masters` WHERE `id`='".$procedure_id."' AND `del_flag`='0' ";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$amount=$row['amount'];
}
}
$arr=array("amount" => $amount);
echo json_encode($arr);
?> 