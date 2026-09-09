<?php
include '../conn.php';
$optom_id=$_POST["id"];
 $sql="SELECT `id`, `kyc_document_name`, `created_by`, `created_on`, `modified_by`, `modified_time`, `del_flag`, `deleted_by`, `deleted_time` FROM `patient_kyc_document_masters`  WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$kyc_document_name=$row['kyc_document_name'];

$arr=array("id" => $id,"kyc_document_name" => $kyc_document_name);
echo json_encode($arr);
}
?> 