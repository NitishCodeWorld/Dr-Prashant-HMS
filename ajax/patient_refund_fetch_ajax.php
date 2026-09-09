<?php

include '../function.php';

include '../conn.php';

$patient_registration_id=$_POST["patient_registration_id"];

$opd_flag=$_POST["opd_flag"];

$char_lett="A";

$terminate_flag=0;

$arr=array();



//Payment 1

$sql="SELECT * FROM `refund_adavnce_final_billing` WHERE `patient_registration_id`= '" .$patient_registration_id. "' AND `del_flag`='0' AND `opd_flag`= '" .$opd_flag. "' AND `adjust_with_final_bill_flag`='0' ";

$result=$conn->query($sql) ;

$count=$result->num_rows;

$counter=1;

//$row = $result->fetch_assoc();

if($count>0)

{	

$total_expence_loop=0;

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

$id=$row['id'];

$lab_bill_date=date("d-m-Y", strtotime($row['billing_date'])).' '.date("h:i A", strtotime($row['billing_time']));

$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");

$lab_bill_invo= $row['invo_no'].'/'.$m_f_year;

$total_charge_occupied_bed=$row['total'];



$expneses_abouts="<a href='".ADMIN_URL."print_refund_advance_final_bill.php?id=".$id."' target='_blank' >Refund Bill No: '".$lab_bill_invo."' </a> <br/>Bill date: '".$lab_bill_date;

$expence_title="Refund Bill";

$total_expence_loop=$total_expence_loop+$total_charge_occupied_bed;

$advacnce_amt=$total_expence_loop;

$terminate_flag++;

//unset($arr);

//$arr=array("count" => $count);

$arr[]=array("count" => $count,"char_lett" => $char_lett,"expence_title" => $expence_title,"id" => $id,"expneses_abouts" => $expneses_abouts,"total_charge_occupied_bed" => $total_charge_occupied_bed,"counter" => $counter,"total_expence_loop" => $total_expence_loop,"terminate_flag" => $terminate_flag,"lab_bill_invo" => $lab_bill_invo,"invo_no" => $row['invo_no']);

$counter++;



}

$char_lett++;

}





/// last echo mendatory

echo json_encode($arr);

?>