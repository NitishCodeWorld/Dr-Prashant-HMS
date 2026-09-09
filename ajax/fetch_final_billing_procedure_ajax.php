<?php

include '../conn.php';

$invoice_insert_id=$_POST["invoice_insert_id"];

$procedure_insert_id=$_POST["procedure_insert_id"];

$row_id=$_POST["row_id"];

$sql="SELECT * FROM `invoice_final_procedure` WHERE `i_id`='".$invoice_insert_id."' AND `del_flag`='0' AND `id`='".$procedure_insert_id."' ";

$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

while($row=mysqli_fetch_assoc($result)){			

	extract($row);	

	$arr=array("procedure_id"=>$procedure_id,"amount"=>$amount,"discount"=>$discount,"net_amount"=>$net_amount,"surgery_flag"=>$surgery_flag,"row_id"=>$row_id,"discount_percentage"=>$discount_percentage);



}

echo json_encode($arr);

?> 