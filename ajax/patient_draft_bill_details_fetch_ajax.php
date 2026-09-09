<?php
include '../function.php';
include '../conn.php';
$patient_registration_id=$_POST["patient_registration_id"];
$opd_flag=$_POST["opd_flag"];
$char_lett="A";
$terminate_flag=0;
$arr=array();

//Payment 1
$sql="SELECT * FROM `invoice_final_billing_for_draft_bill` WHERE `patient_registration_id`= '" .$patient_registration_id. "' AND `del_flag`='0' AND `opd_flag`= '" .$opd_flag. "'   ";
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
$icon='<img src="'. ADMIN_URL.'icon/printButton.png"  title="Print Draft Bill">';
$total_charge_occupied_bed="<a href='".ADMIN_URL."print_final_bill_for_draft_bill.php?id=".$id."' target='_blank'  title='Print Draft Bill'> ".$icon." </a> ";

$expneses_abouts="<a href='".ADMIN_URL."print_final_bill_for_draft_bill.php?id=".$id."' target='_blank' >Draft Bill No: '".$lab_bill_invo."' </a> <br/>Bill date: '".$lab_bill_date;
$expence_title="Draft Bill";
$total_expence_loop=$total_expence_loop;
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