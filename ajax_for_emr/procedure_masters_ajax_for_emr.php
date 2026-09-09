<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `procedure_name`, `pt_type`, `bill_type`, `amount`, `del_flag`, `created_by`, `created_on`, `modified_by`, `modified_time`, `deleted_by`, `deleted_time`,`surgery_flag` FROM `procedure_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$procedure_name=$row['procedure_name'];
$pt_type=$row['pt_type'];
$bill_type=$row['bill_type'];
$amount=$row['amount'];
$surgery_flag=$row['surgery_flag'];
$arr=array("id" => $id,"procedure_name" => $procedure_name,"pt_type" => $pt_type,"bill_type" => $bill_type,"amount" => $amount,"surgery_flag" => $surgery_flag);
echo json_encode($arr);
}
?> 