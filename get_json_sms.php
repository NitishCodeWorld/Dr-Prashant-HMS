<?php
include "conn.php";
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

$data_flag=$_GET["data_flag"];
if($data_flag=="1"){		
	load_patient_details();	
}
else if($data_flag=="2"){		
	prescription_url_sent();	
}
else if($data_flag=="3"){		
	load_bill_patient_details();	
}
else if($data_flag=="4"){		
	bill_url_sent();	
}
else{
	echo "Flag  Not Selected";		
}

function load_patient_details(){
	global $conn;
	$arr=array();
	$sl_no=1;
	$id=$_REQUEST["id"];
	$error_mobile_no_flag=0;
	$sql3="SELECT * FROM `prescription_details_for_emr`  WHERE `id` = '".$id."'  ";                   
	$result3=$conn->query($sql3) ;
	$count=$result3->num_rows;	
	$row3 = $result3->fetch_assoc();	
	$sms_msg_patient_id=$row3['id'];
	$sms_msg_patient_mrd=$row3['mrd_no'];
	$sms_msg_patient_name=$row3['fname'].' '.$row3['lname'];
	$sms_msg_patient_wp_no=$row3['mobile'];
	$sms_msg_primary_doctor=$row3['primary_doctor'];
	//$sms_msg_patient_wp_no='9830042331';
	//$sms_msg_patient_wp_no='9123991694';
	$length_no=strlen($sms_msg_patient_wp_no);
	if($length_no>10){
		$error_mobile_no_flag=1;
	}
	$result_1st_digit = mb_substr($sms_msg_patient_wp_no, 0, 1);
	if($result_1st_digit<6){
		$error_mobile_no_flag=1;
	}
	
	$arr=array("sl_no"=>$sl_no,"sms_msg_patient_mrd"=>$sms_msg_patient_mrd,"sms_msg_patient_name"=>$sms_msg_patient_name,"sms_msg_patient_wp_no"=>$sms_msg_patient_wp_no,"sms_msg_patient_id"=>$sms_msg_patient_id,"error_mobile_no_flag"=>$error_mobile_no_flag,"sms_msg_primary_doctor"=>$sms_msg_primary_doctor);		
	echo json_encode($arr);	
}


function prescription_url_sent(){
	global $conn;
	$sms_msg_patient_name=$_REQUEST["sms_msg_patient_name"];
	$sms_msg_patient_wp_no=$_REQUEST["sms_msg_patient_wp_no"];
	$sms_msg_patient_mrd=$_REQUEST["sms_msg_patient_mrd"];
	$sms_msg_patient_id=$_REQUEST["sms_msg_patient_id"];
	$sms_msg_primary_doctor=$_REQUEST["sms_msg_primary_doctor"];
	
	$return_flag=0;
	$arr=array();
	
	$user_name='sunetraapi';
	$password='sms@2025';
	$sms_sent_no='91'.$sms_msg_patient_wp_no;
	$sms_from='SNETRA';
	
	//$text = "Dear $sms_msg_patient_name, Get your prescription from ".ADMIN_URL."printPrescription_for_emr.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
	$text = "Dear $sms_msg_patient_name, Get your prescription from ".ADMIN_URL."printPrescription_for_emr.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";

	$encoded_text = rawurlencode($text);

	$url_wp_send = "https://103.229.250.200/smpp/sendsms?username=$user_name&password=$password&to=$sms_sent_no&from=$sms_from&text=" . $encoded_text;
	
	
	// Initialize cURL session
	$crl_wp_send = curl_init();	
	// Set the URL option
	curl_setopt($crl_wp_send, CURLOPT_URL, $url_wp_send);	
	// Set to return the response as a string instead of outputting it directly
	curl_setopt($crl_wp_send, CURLOPT_RETURNTRANSFER, true);	
	// Set to true to get a fresh connection each time, avoiding issues with cached connections
	curl_setopt($crl_wp_send, CURLOPT_FRESH_CONNECT, true);	
	// Optionally, fail on HTTP errors
	curl_setopt($crl_wp_send, CURLOPT_FAILONERROR, true);	
	// Execute the cURL request
	$response_wp_send = curl_exec($crl_wp_send);	
	// Check for cURL errors
	if (curl_errno($crl_wp_send)) {
		//die('cURL Error: ' . curl_error($crl) . ' - Code: ' . curl_errno($crl));
		$returnVal=0;
	} else {
		$returnVal=1;
	}
	
	// Display the response
	//var_dump($response);
	//echo($response);	
	// Close the cURL session
	curl_close($crl_wp_send);
	if($returnVal==1){
	$sql12 = $conn->query("INSERT INTO  `sms_logs_for_emr` SET `mrd_no` = '".$sms_msg_patient_mrd."',`sms_type` = '1',`sms_status` = '1',`log_date` = '".date("Y-m-d H:i:s")."',`reciepent`= '".$sms_msg_patient_wp_no."',`prescription_id` = '".$sms_msg_patient_id."',`doc_id` = '".$sms_msg_primary_doctor."',`sms_body_sent` = '".$url_wp_send."' ");
	
	$return_flag=1;
	}
	
	$arr=array("return_flag"=>$return_flag);	
	echo json_encode($arr);	
}



function load_bill_patient_details(){
	global $conn;
	$arr=array();
	$sl_no=1;
	$id=$_REQUEST["id"];
	$error_mobile_no_flag=0;
	$sql3="SELECT * FROM `invoice_final_billing`  WHERE `id` = '".$id."'  ";                   
	$result3=$conn->query($sql3) ;
	$count=$result3->num_rows;	
	$row3 = $result3->fetch_assoc();	
	$sms_msg_patient_id=$row3['id'];
	$sms_msg_patient_mrd=$row3['hospital_number'];
	$sms_msg_patient_name=$row3['name'];
	$sms_msg_patient_wp_no=$row3['mobile'];
	$sms_msg_primary_doctor=$row3['doc_id'];
	$sms_msg_opd_flag=$row3['opd_flag'];
	//$sms_msg_patient_wp_no='9830042331';
	//$sms_msg_patient_wp_no='9123991694';
	//$sms_msg_patient_wp_no='6290961775';
	$length_no=strlen($sms_msg_patient_wp_no);
	if($length_no>10){
		$error_mobile_no_flag=1;
	}
	$result_1st_digit = mb_substr($sms_msg_patient_wp_no, 0, 1);
	if($result_1st_digit<6){
		$error_mobile_no_flag=1;
	}
	
	$arr=array("sl_no"=>$sl_no,"sms_msg_patient_mrd"=>$sms_msg_patient_mrd,"sms_msg_patient_name"=>$sms_msg_patient_name,"sms_msg_patient_wp_no"=>$sms_msg_patient_wp_no,"sms_msg_patient_id"=>$sms_msg_patient_id,"error_mobile_no_flag"=>$error_mobile_no_flag,"sms_msg_primary_doctor"=>$sms_msg_primary_doctor,"sms_msg_opd_flag"=>$sms_msg_opd_flag);		
	echo json_encode($arr);	
}

function bill_url_sent(){
	global $conn;
	$sms_msg_patient_name=$_REQUEST["sms_msg_patient_name"];
	$sms_msg_patient_wp_no=$_REQUEST["sms_msg_patient_wp_no"];
	$sms_msg_patient_mrd=$_REQUEST["sms_msg_patient_mrd"];
	$sms_msg_patient_id=$_REQUEST["sms_msg_patient_id"];
	$sms_msg_primary_doctor=$_REQUEST["sms_msg_primary_doctor"];
	$sms_msg_opd_flag=$_REQUEST["sms_msg_opd_flag"];
	
	$return_flag=0;
	$arr=array();
	
	$user_name='sunetraapi';
	$password='sms@2025';
	$sms_sent_no='91'.$sms_msg_patient_wp_no;
	$sms_from='SNETRA';
	
	//$text = "Dear $sms_msg_patient_name, Get your prescription from ".ADMIN_URL."printPrescription_for_emr.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
	//$text = "Dear $sms_msg_patient_name, Get your prescription from https://www.sunetrafecc.org/hms/printPrescription_for_emr.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
	if($sms_msg_opd_flag==1){
		//opd
		$text = "Dear $sms_msg_patient_name, Get your receipts from ".ADMIN_URL."print_final_bill_for_ipd_new.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
	}else{
		//ipd
		$text = "Dear $sms_msg_patient_name, Get your receipts from ".ADMIN_URL."print_final_bill_for_ipd_new.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
	}

	$encoded_text = rawurlencode($text);

	$url_wp_send = "https://103.229.250.200/smpp/sendsms?username=$user_name&password=$password&to=$sms_sent_no&from=$sms_from&text=" . $encoded_text;
	
	
	// Initialize cURL session
	$crl_wp_send = curl_init();	
	// Set the URL option
	curl_setopt($crl_wp_send, CURLOPT_URL, $url_wp_send);	
	// Set to return the response as a string instead of outputting it directly
	curl_setopt($crl_wp_send, CURLOPT_RETURNTRANSFER, true);	
	// Set to true to get a fresh connection each time, avoiding issues with cached connections
	curl_setopt($crl_wp_send, CURLOPT_FRESH_CONNECT, true);	
	// Optionally, fail on HTTP errors
	curl_setopt($crl_wp_send, CURLOPT_FAILONERROR, true);	
	// Execute the cURL request
	$response_wp_send = curl_exec($crl_wp_send);	
	// Check for cURL errors
	if (curl_errno($crl_wp_send)) {
		//die('cURL Error: ' . curl_error($crl) . ' - Code: ' . curl_errno($crl));
		$returnVal=0;
	} else {
		$returnVal=1;
	}
	
	// Display the response
	//var_dump($response);
	//echo($response);	
	// Close the cURL session
	curl_close($crl_wp_send);
	if($returnVal==1){
	$sql12 = $conn->query("INSERT INTO  `sms_logs_for_emr` SET `mrd_no` = '".$sms_msg_patient_mrd."',`sms_type` = '2',`sms_status` = '1',`log_date` = '".date("Y-m-d H:i:s")."',`reciepent`= '".$sms_msg_patient_wp_no."',`prescription_id` = '".$sms_msg_patient_id."',`doc_id` = '".$sms_msg_primary_doctor."',`sms_body_sent` = '".$url_wp_send."' ");
	
	$return_flag=1;
	}
	
	$arr=array("return_flag"=>$return_flag);	
	echo json_encode($arr);	
}



?>