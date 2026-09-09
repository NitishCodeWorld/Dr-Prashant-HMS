<?php
include '../conn.php';

$today = date('Y-m-d');
$count_arr = array();

//Today's Total
$sql_total_patient = "SELECT COUNT(DISTINCT `mrd_no`) AS `total_patient` FROM `mrd_increments`";
$result_total_patient = $conn->query($sql_total_patient);
$row_total_patient = $result_total_patient->fetch_assoc();
$total_patient = ($row_total_patient['total_patient'] > 0) ? $row_total_patient['total_patient'] : 0;


//Today's IPD Total
$sql_today_ipd_total_patient = "SELECT COUNT(`id`) AS `today_ipd_total_patient` FROM `invoice_final_billing` WHERE `billing_date`='".$today."' and `del_flag`=0 AND `opd_flag`=0";
$result_today_ipd_total_patient = $conn->query($sql_today_ipd_total_patient);
$row_today_ipd_total_patient = $result_today_ipd_total_patient->fetch_assoc();
$today_ipd_total_patient = ($row_today_ipd_total_patient['today_ipd_total_patient'] > 0) ? $row_today_ipd_total_patient['today_ipd_total_patient'] : 0;


//Today's OPD Total
$sql_today_opd_total_patient = "SELECT COUNT(`id`) AS `today_opd_total_patient` FROM `invoice_final_billing` WHERE `billing_date`='".$today."' and `del_flag`=0 AND `opd_flag`=1";
$result_today_opd_total_patient = $conn->query($sql_today_opd_total_patient);
$row_today_opd_total_patient = $result_today_opd_total_patient->fetch_assoc();
$today_opd_total_patient = ($row_today_opd_total_patient['today_opd_total_patient'] > 0) ? $row_today_opd_total_patient['today_opd_total_patient'] : 0;


//Today's Individual Total
$sql_today_my_total_patient = "SELECT COUNT(`id`) AS `today_my_total_patient` FROM `prescription_details_for_emr` WHERE date(`created_on`) like '%".$today."%' and `del_flag`=0 AND `primary_doctor`='".$_SESSION['id']."'";
$result_today_my_total_patient = $conn->query($sql_today_my_total_patient);
$row_today_my_total_patient = $result_today_my_total_patient->fetch_assoc();
$today_my_total_patient = ($row_today_my_total_patient['today_my_total_patient'] > 0) ? $row_today_my_total_patient['today_my_total_patient'] : 0;


$count_arr = array('total_patient'=>$total_patient, 'today_ipd_total_patient'=>$today_ipd_total_patient, 'today_opd_total_patient'=>$today_opd_total_patient, 'today_my_total_patient'=>$today_my_total_patient);

echo json_encode($count_arr);

?> 

