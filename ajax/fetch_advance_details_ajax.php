<?php

include '../function.php';

include '../conn.php';

$patient_registration_id=$_POST["patient_registration_id"];

$hospital_number=$_POST["hospital_number"];

$opd_flag=$_POST["opd_flag"];

$terminate_flag=0;

$arr=array();



//Payment 1

$sql="SELECT `adavnce_final_payment_billing`.*,`adavnce_final_billing`.`invo_no` ,`adavnce_final_billing`.`billing_date`,`payment_mode_masters`.`payment_mode_name` FROM `adavnce_final_payment_billing` INNER JOIN `adavnce_final_billing` ON `adavnce_final_payment_billing`.`i_id`=`adavnce_final_billing`.`id` INNER JOIN `payment_mode_masters` ON `adavnce_final_payment_billing`.`p_key`=`payment_mode_masters`.`id`  WHERE `adavnce_final_payment_billing`.`patient_registration_id`= '" .$patient_registration_id. "' AND `adavnce_final_payment_billing`.`del_flag`='0' AND `adavnce_final_billing`.`del_flag`='0' AND `adavnce_final_billing`.`opd_flag`= '" .$opd_flag. "' AND `adavnce_final_billing`.`hospital_number`= '" .$hospital_number. "'  AND `adavnce_final_payment_billing`.`adjust_with_final_bill_flag`='0' ";

$result=$conn->query($sql) ;

$count=$result->num_rows;

$counter=1;

//$row = $result->fetch_assoc();

if($count>0)

{	

$total_expence_loop=0;

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

$id=$row['id'];

$payment_date=date("d-m-Y", strtotime($row['payment_date']));

$payment_time=date("h:i A", strtotime($row['payment_time']));

$p_key=$row['p_key'];

$p_value=$row['p_value'];

$tpa_name=$row['tpa_name'];

$claim_no=$row['claim_no'];

$payment_type=$row['payment_type'];

$payment_mode_name=$row['payment_mode_name'];

$i_id=$row['i_id'];



$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");

$lab_bill_invo= $row['invo_no'].'/'.$m_f_year;



$total_expence_loop=$total_expence_loop+$p_value;

$terminate_flag++;
$refund_flag=0;

//unset($arr);

//$arr=array("count" => $count);

$arr[]=array("count" => $count,"id" => $id,"payment_date" => $payment_date,"payment_time" => $payment_time,"p_key" => $p_key,"p_value" => $p_value,"tpa_name" => $tpa_name,"claim_no" => $claim_no,"payment_type" => $payment_type,"payment_mode_name" => $payment_mode_name,"counter" => $counter,"total_expence_loop" => $total_expence_loop,"terminate_flag" => $terminate_flag,"lab_bill_invo" => $lab_bill_invo,"advance_bill_invoice_unique_id" => $i_id,"refund_flag" => $refund_flag);

$counter++;



}

$char_lett++;

}

//Refund 1

$sql="SELECT `refund_adavnce_final_payment_billing`.*,`refund_adavnce_final_billing`.`invo_no` ,`refund_adavnce_final_billing`.`billing_date`,`payment_mode_masters`.`payment_mode_name` FROM `refund_adavnce_final_payment_billing` INNER JOIN `refund_adavnce_final_billing` ON `refund_adavnce_final_payment_billing`.`i_id`=`refund_adavnce_final_billing`.`id` INNER JOIN `payment_mode_masters` ON `refund_adavnce_final_payment_billing`.`p_key`=`payment_mode_masters`.`id`  WHERE `refund_adavnce_final_payment_billing`.`patient_registration_id`= '" .$patient_registration_id. "' AND `refund_adavnce_final_payment_billing`.`del_flag`='0' AND `refund_adavnce_final_billing`.`del_flag`='0' AND `refund_adavnce_final_billing`.`opd_flag`= '" .$opd_flag. "' AND `refund_adavnce_final_billing`.`hospital_number`= '" .$hospital_number. "'  AND `refund_adavnce_final_payment_billing`.`adjust_with_final_bill_flag`='0' ";

$result=$conn->query($sql) ;

$count=$result->num_rows;

$counter=1;

//$row = $result->fetch_assoc();

if($count>0)

{	

$total_expence_loop=0;

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

$id=$row['id'];

$payment_date=date("d-m-Y", strtotime($row['payment_date']));

$payment_time=date("h:i A", strtotime($row['payment_time']));

$p_key=$row['p_key'];

$p_value=$row['p_value'];

$tpa_name=$row['tpa_name'];

$claim_no=$row['claim_no'];

$payment_type=$row['payment_type'];

$payment_mode_name=$row['payment_mode_name'];

$i_id=$row['i_id'];



$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");

$lab_bill_invo= $row['invo_no'].'/'.$m_f_year;



$total_expence_loop=$total_expence_loop+$p_value;

$terminate_flag++;
$refund_flag=1;

//unset($arr);

//$arr=array("count" => $count);

$arr[]=array("count" => $count,"id" => $id,"payment_date" => $payment_date,"payment_time" => $payment_time,"p_key" => $p_key,"p_value" => $p_value,"tpa_name" => $tpa_name,"claim_no" => $claim_no,"payment_type" => $payment_type,"payment_mode_name" => $payment_mode_name,"counter" => $counter,"total_expence_loop" => $total_expence_loop,"terminate_flag" => $terminate_flag,"lab_bill_invo" => $lab_bill_invo,"advance_bill_invoice_unique_id" => $i_id,"refund_flag" => $refund_flag);

$counter++;



}

$char_lett++;

}

/// last echo mendatory

echo json_encode($arr);

?>