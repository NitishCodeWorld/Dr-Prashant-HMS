<?php 

include 'function.php';

include 'conn.php'; ?>
<?php 

//Add Code

if((isset($_REQUEST['submit']))||(isset($_REQUEST['submit_sms'])))

{

	// Data Edit

	$draft_bill=mysqli_real_escape_string($conn,$_REQUEST['draft_bill']);

	if($draft_bill==''){

			$draft_bill=0;

	}

	if($draft_bill==0){	

	//Final bill code	

		$patient_registration_id=mysqli_real_escape_string($conn,$_REQUEST['patient_registration_id']);

		$hospital_number=mysqli_real_escape_string($conn,$_REQUEST['hospital_number']);
		
		$fname_text=mysqli_real_escape_string($conn,$_REQUEST['name']);
  		$name = ucwords(strtolower($fname_text));	

		$doc_id=mysqli_real_escape_string($conn,$_REQUEST['doc_id']);

		$mobile_prefix=mysqli_real_escape_string($conn,$_REQUEST['mobile_prefix']); 	
		$prefix=mysqli_real_escape_string($conn,$_REQUEST['prefix']); 	

		$mobile=mysqli_real_escape_string($conn,$_REQUEST['mobile']); 

		$email=mysqli_real_escape_string($conn,$_REQUEST['email']); 

		$age=mysqli_real_escape_string($conn,$_REQUEST['age']);

		$address=mysqli_real_escape_string($conn,$_REQUEST['address']);	

		if($_REQUEST['date_of_discharge']==''){

		$date_of_discharge='NULL';

		}else{

			$date_of_discharge= "'".date("Y-m-d", strtotime($_POST['date_of_discharge']))."'";

		}

		if($_REQUEST['time_of_discharge']==''){

		$time_of_discharge='NULL';

		}else{

			$time_of_discharge= "'".date("H:i", strtotime($_POST['time_of_discharge']))."'";

		}	

		

		if($_REQUEST['admission_date']==''){

		$admission_date='NULL';

		}else{

			$admission_date= "'".date("Y-m-d", strtotime($_POST['admission_date']))."'";

		}

		if($_REQUEST['admission_time']==''){

		$admission_time='NULL';

		}else{

			$admission_time= "'".date("H:i", strtotime($_POST['admission_time']))."'";

		}

		

		$pt_type=mysqli_real_escape_string($conn,$_REQUEST['pt_type']);		

		$countiopc=mysqli_real_escape_string($conn,$_REQUEST['countiopc']);

		$discount_purpose=mysqli_real_escape_string($conn,$_REQUEST['discount_purpose']);		

		$discount=mysqli_real_escape_string($conn,$_REQUEST['discount']);

		$discount_type=mysqli_real_escape_string($conn,$_REQUEST['discount_type']);

		$total=mysqli_real_escape_string($conn,$_REQUEST['total']);				

		$status=mysqli_real_escape_string($conn,$_REQUEST['status']);		
		$free_reason=mysqli_real_escape_string($conn,$_REQUEST['free_reason']);

		$created_by=mysqli_real_escape_string($conn,$_REQUEST['created_by']);

		$created_on=mysqli_real_escape_string($conn,$_REQUEST['created_on']);

		

		if($_REQUEST['billing_date']==''){

		$billing_date='NULL';

		}else{

			$billing_date= "'".date("Y-m-d", strtotime($_POST['billing_date']))."'";

		}

		if($_REQUEST['billing_time']==''){

		$billing_time='NULL';

		}else{

			$billing_time= "'".date("H:i", strtotime($_POST['billing_time']))."'";

		}	

				

		$today_month_check=date('m');	
		//$today_month_check='04';		
		if($today_month_check<4){
			$year=(date('Y')-1).'-04-01';
			$year_next=(date('Y')).'-03-31';
		}else{
			$year=date('Y').'-04-01';
			$year_next=(date('Y')+1).'-03-31';
		}

		$opd_flag=mysqli_real_escape_string($conn,$_REQUEST['opd_flag']);

		

		$sql2="SELECT `invo_no` FROM `invoice_final_billing` WHERE date(`created_on`) BETWEEN '".$year."' AND '".$year_next."' AND `opd_flag`='".$opd_flag."' ORDER BY `id` DESC ";

		$result2=$conn->query($sql2) ;	

		$row2 = $result2->fetch_assoc();	

		$max_invo= $row2['invo_no']+1;	

		

		$gender=mysqli_real_escape_string($conn,$_REQUEST['gender']);

		 

		$count_payment_mode=mysqli_real_escape_string($conn,$_REQUEST['count_payment_mode']);

		$advance_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['advance_payment_amt_text']);

		$instant_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['instant_payment_amt_text']);

		$refund_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['refund_payment_amt_text']);

		$net_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['net_payment_amt_text']);

		$countiopc_additional_doctor=mysqli_real_escape_string($conn,$_REQUEST['countiopc_additional_doctor']);

		$ref_doctor_id=mysqli_real_escape_string($conn,$_POST['ref_doctor_id']); 

		

		$sql = "INSERT INTO `invoice_final_billing` SET `hospital_number`='".$hospital_number."',`patient_registration_id`='".$patient_registration_id."', `invo_no`='".$max_invo."', `name`='".$name."',`address`='".$address."',`mobile_prefix` ='".$mobile_prefix."',`mobile` ='".$mobile."',`email`='".$email."',`age` ='".$age."',`pt_type`='".$pt_type."',`discount`='".$discount."',`discount_purpose`='".$discount_purpose."',`discount_type`='".$discount_type."',`total`='".$total."',`status`='".$status."',`print_status`='1',`doc_id`='".$doc_id."',`created_by`='".$created_by."',`created_on`='".$created_on."' ,`billing_date`=".$billing_date.",`billing_time`=".$billing_time.",`opd_flag`='".$opd_flag."',`admission_date`=".$admission_date." ,`admission_time`=".$admission_time." ,`date_of_discharge`=".$date_of_discharge." ,`time_of_discharge`=".$time_of_discharge." ,`gender`='".$gender."' ,`advance_payment_amt_text`='".$advance_payment_amt_text."',`instant_payment_amt_text`='".$instant_payment_amt_text."',`refund_payment_amt_text`='".$refund_payment_amt_text."',`net_payment_amt_text`='".$net_payment_amt_text."',`prefix`='".$prefix."' ,`free_reason`='".$free_reason."' , `ref_doctor_id`='".$ref_doctor_id."' ";	

		

		if($conn->query($sql)===TRUE)

		{

			$msg="Record updated successfully";

			$flg=0;		

			$id = $conn->insert_id;	

											

				for($i=1;$i<=$countiopc;$i++) {

				 if($_REQUEST['procedure_id'.$i]!='')

				   {

					 $sql4 = $conn->query("INSERT INTO `invoice_final_procedure` SET `hospital_number`='".$hospital_number."',`patient_registration_id`='".$patient_registration_id."' ,`i_id` = '".$id."',`procedure_id` = '".$_REQUEST['procedure_id'.$i]."',`amount` = '".$_REQUEST['amount'.$i]."',`discount` = '".$_REQUEST['discount'.$i]."',`net_amount` = '".$_REQUEST['net_amount'.$i]."',`surgery_flag` = '".$_REQUEST['surgery_flag'.$i]."',`created_by`='".$created_by."',`created_on`='".$created_on."',`procedure_mode_flag` = '1',`procedure_remarks` = '".$_REQUEST['procedure_remarks'.$i]."',`discount_percentage` = '".$_REQUEST['discount_percentage'.$i]."' ");						

						

					 

				   }   

				}

				

				for($i=1;$i<=$countiopc_additional_doctor;$i++) {

				 if($_REQUEST['additional_doctor_id'.$i]!='0')

				   {

					 $sql4 = $conn->query("INSERT INTO `additional_doctor_for_invoice_final_billing` SET `hospital_number`='".$hospital_number."',`patient_registration_id`='".$patient_registration_id."' ,`i_id` = '".$id."',`additional_doctor_id` = '".$_REQUEST['additional_doctor_id'.$i]."',`remarks_additional_doctor` = '".$_REQUEST['remarks_additional_doctor'.$i]."',`created_by`='".$created_by."',`created_on`='".$created_on."',`additional_doctor_flag` = '1' ");	

				   }   

				}
		

		$p_action="S";
		
				for($i=1;$i<=$count_payment_mode;$i++) {

				 if($_REQUEST['p_key'.$i]!='')

				   {

					 $sql4 = $conn->query("INSERT INTO `invoice_final_payment_billing` SET `hospital_number`='".$hospital_number."',`patient_registration_id`='".$patient_registration_id."' ,`i_id` = '".$id."',`p_key` = '".$_REQUEST['p_key'.$i]."',`p_value` = '".$_REQUEST['p_value'.$i]."',`p_action` = '".$p_action."',`tpa_name` = '".$_REQUEST['tpa_name'.$i]."',`claim_no` = '".$_REQUEST['claim_no'.$i]."',`payment_date` = '".date("Y-m-d", strtotime($_REQUEST['payment_date'.$i]))."',`payment_time` = '".date("H:i", strtotime($_REQUEST['payment_time'.$i]))."',`payment_type` = '".$_REQUEST['payment_type'.$i]."',`payment_mode_flag` = '1',`created_by`='".$created_by."',`created_on`='".$created_on."',`advance_invoice_id` = '".$_REQUEST['advance_invoice_id'.$i]."',`advance_bill_invoice_no` = '".$_REQUEST['advance_bill_invoice_no'.$i]."',`advance_bill_invoice_unique_id` = '".$_REQUEST['advance_bill_invoice_unique_id'.$i]."',`insurance_name` = '".$_REQUEST['insurance_name'.$i]."',`advance_bill_refund_flag` = '".$_REQUEST['advance_bill_refund_flag'.$i]."' ");	

					 if($_REQUEST['advance_bill_refund_flag'.$i]=='0'){

					   if($_REQUEST['advance_invoice_id'.$i]!='')

					   {

						 $sql87 = $conn->query("UPDATE `adavnce_final_payment_billing` SET `adjust_with_final_bill_flag`='1' WHERE `id` = '".$_REQUEST['advance_invoice_id'.$i]."'  AND `patient_registration_id`='".$patient_registration_id."' ");	

						 

					   }

					    if($_REQUEST['advance_bill_invoice_unique_id'.$i]!='')

					   {

						 $sql87 = $conn->query("UPDATE `adavnce_final_billing` SET `adjust_with_final_bill_flag`='1' WHERE `id` = '".$_REQUEST['advance_bill_invoice_unique_id'.$i]."'  AND `patient_registration_id`='".$patient_registration_id."' ");	

						 

					   }
					 }
					 
					 
					 if($_REQUEST['advance_bill_refund_flag'.$i]=='1'){

					   if($_REQUEST['advance_invoice_id'.$i]!='')

					   {

						 $sql87 = $conn->query("UPDATE `refund_adavnce_final_payment_billing` SET `adjust_with_final_bill_flag`='1' WHERE `id` = '".$_REQUEST['advance_invoice_id'.$i]."'  AND `patient_registration_id`='".$patient_registration_id."' ");	

						 

					   }

					    if($_REQUEST['advance_bill_invoice_unique_id'.$i]!='')

					   {

						 $sql87 = $conn->query("UPDATE `refund_adavnce_final_billing` SET `adjust_with_final_bill_flag`='1' WHERE `id` = '".$_REQUEST['advance_bill_invoice_unique_id'.$i]."'  AND `patient_registration_id`='".$patient_registration_id."' ");	

						 

					   }
					 }
					    

				   }   

				}
				

			if($opd_flag=='1'){
				$redirectUrlPrint=ADMIN_URL.'print_final_bill_for_opd_new.php?id='.$id;
			}else{
				$redirectUrlPrint=ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$id;
			}



			if(isset($_REQUEST['submit_sms'])){			
				$sms_msg_patient_name=$name;
				$sms_msg_patient_wp_no=$mobile;
				$sms_msg_patient_mrd=$hospital_number;
				$sms_msg_patient_id=$id;
				$sms_msg_primary_doctor=$doc_id;
				
				$return_flag=0;
				$arr=array();
				
				$user_name='sunetraapi';
				$password='sms@2025';
				$sms_sent_no='91'.$sms_msg_patient_wp_no;
				$sms_from='SNETRA';
				
				if($opd_flag==1){
					//opd
					$text = "Dear $sms_msg_patient_name, Get your receipts from ".ADMIN_URL."print_final_bill_for_ipd_new.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
					//$text = "Dear $sms_msg_patient_name, Get your receipts from https://www.sunetrafecc.org/hms/print_final_bill_for_ipd_new.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
				}else{
					//ipd
					$text = "Dear $sms_msg_patient_name, Get your receipts from ".ADMIN_URL."print_final_bill_for_ipd_new.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
					//$text = "Dear $sms_msg_patient_name, Get your receipts from https://www.sunetrafecc.org/hms/print_final_bill_for_ipd_new.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
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
				
			}
						

			//$redirectUrlPrint=ADMIN_URL.'print_final_bill.php?id='.$id;

			$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\"> window.open('$redirectUrlPrint', '_blank'); window.location.href='$redirectUrl'; </script>";

		}

		else

		{

		$flg=1;

		$msg="Error:".$sql."<br>".$conn->error;

			 $redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";



		}

	}else{
		
		//Draft bill code	

		$patient_registration_id=mysqli_real_escape_string($conn,$_REQUEST['patient_registration_id']);

		$hospital_number=mysqli_real_escape_string($conn,$_REQUEST['hospital_number']);
		
		$fname_text=mysqli_real_escape_string($conn,$_REQUEST['name']);
  		$name = ucwords(strtolower($fname_text));	

		$doc_id=mysqli_real_escape_string($conn,$_REQUEST['doc_id']);

		$mobile_prefix=mysqli_real_escape_string($conn,$_REQUEST['mobile_prefix']); 	
		$prefix=mysqli_real_escape_string($conn,$_REQUEST['prefix']); 	

		$mobile=mysqli_real_escape_string($conn,$_REQUEST['mobile']); 

		$email=mysqli_real_escape_string($conn,$_REQUEST['email']); 

		$age=mysqli_real_escape_string($conn,$_REQUEST['age']);

		$address=mysqli_real_escape_string($conn,$_REQUEST['address']);	

		if($_REQUEST['date_of_discharge']==''){

		$date_of_discharge='NULL';

		}else{

			$date_of_discharge= "'".date("Y-m-d", strtotime($_POST['date_of_discharge']))."'";

		}

		if($_REQUEST['time_of_discharge']==''){

		$time_of_discharge='NULL';

		}else{

			$time_of_discharge= "'".date("H:i", strtotime($_POST['time_of_discharge']))."'";

		}	

		

		if($_REQUEST['admission_date']==''){

		$admission_date='NULL';

		}else{

			$admission_date= "'".date("Y-m-d", strtotime($_POST['admission_date']))."'";

		}

		if($_REQUEST['admission_time']==''){

		$admission_time='NULL';

		}else{

			$admission_time= "'".date("H:i", strtotime($_POST['admission_time']))."'";

		}

		

		$pt_type=mysqli_real_escape_string($conn,$_REQUEST['pt_type']);		

		$countiopc=mysqli_real_escape_string($conn,$_REQUEST['countiopc']);

		$discount_purpose=mysqli_real_escape_string($conn,$_REQUEST['discount_purpose']);		

		$discount=mysqli_real_escape_string($conn,$_REQUEST['discount']);

		$discount_type=mysqli_real_escape_string($conn,$_REQUEST['discount_type']);

		$total=mysqli_real_escape_string($conn,$_REQUEST['total']);				

		$status=mysqli_real_escape_string($conn,$_REQUEST['status']);		
		$free_reason=mysqli_real_escape_string($conn,$_REQUEST['free_reason']);

		$created_by=mysqli_real_escape_string($conn,$_REQUEST['created_by']);

		$created_on=mysqli_real_escape_string($conn,$_REQUEST['created_on']);

		

		if($_REQUEST['billing_date']==''){

		$billing_date='NULL';

		}else{

			$billing_date= "'".date("Y-m-d", strtotime($_POST['billing_date']))."'";

		}

		if($_REQUEST['billing_time']==''){

		$billing_time='NULL';

		}else{

			$billing_time= "'".date("H:i", strtotime($_POST['billing_time']))."'";

		}	

				

		$today_month_check=date('m');	
		//$today_month_check='04';		
		if($today_month_check<4){
			$year=(date('Y')-1).'-04-01';
			$year_next=(date('Y')).'-03-31';
		}else{
			$year=date('Y').'-04-01';
			$year_next=(date('Y')+1).'-03-31';
		}

		$opd_flag=mysqli_real_escape_string($conn,$_REQUEST['opd_flag']);

		

		$sql2="SELECT `invo_no` FROM `invoice_final_billing_for_draft_bill` WHERE date(`created_on`) BETWEEN '".$year."' AND '".$year_next."' AND `opd_flag`='".$opd_flag."' ORDER BY `id` DESC ";

		$result2=$conn->query($sql2) ;	

		$row2 = $result2->fetch_assoc();	

		$max_invo= $row2['invo_no']+1;	

		

		$gender=mysqli_real_escape_string($conn,$_REQUEST['gender']);

		 

		$count_payment_mode=mysqli_real_escape_string($conn,$_REQUEST['count_payment_mode']);

		$advance_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['advance_payment_amt_text']);

		$instant_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['instant_payment_amt_text']);

		$refund_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['refund_payment_amt_text']);

		$net_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['net_payment_amt_text']);

		$countiopc_additional_doctor=mysqli_real_escape_string($conn,$_REQUEST['countiopc_additional_doctor']);

		$ref_doctor_id=mysqli_real_escape_string($conn,$_POST['ref_doctor_id']); 

		

		$sql = "INSERT INTO `invoice_final_billing_for_draft_bill` SET `hospital_number`='".$hospital_number."',`patient_registration_id`='".$patient_registration_id."', `invo_no`='".$max_invo."', `name`='".$name."',`address`='".$address."',`mobile_prefix` ='".$mobile_prefix."',`mobile` ='".$mobile."',`email`='".$email."',`age` ='".$age."',`pt_type`='".$pt_type."',`discount`='".$discount."',`discount_purpose`='".$discount_purpose."',`discount_type`='".$discount_type."',`total`='".$total."',`status`='".$status."',`print_status`='1',`doc_id`='".$doc_id."',`created_by`='".$created_by."',`created_on`='".$created_on."' ,`billing_date`=".$billing_date.",`billing_time`=".$billing_time.",`opd_flag`='".$opd_flag."',`admission_date`=".$admission_date." ,`admission_time`=".$admission_time." ,`date_of_discharge`=".$date_of_discharge." ,`time_of_discharge`=".$time_of_discharge." ,`gender`='".$gender."' ,`advance_payment_amt_text`='".$advance_payment_amt_text."',`instant_payment_amt_text`='".$instant_payment_amt_text."',`refund_payment_amt_text`='".$refund_payment_amt_text."',`net_payment_amt_text`='".$net_payment_amt_text."',`prefix`='".$prefix."' ,`free_reason`='".$free_reason."' , `ref_doctor_id`='".$ref_doctor_id."' ";	

		

		if($conn->query($sql)===TRUE)

		{

			$msg="Record updated successfully";

			$flg=0;		

			$id = $conn->insert_id;	

											

				for($i=1;$i<=$countiopc;$i++) {

				 if($_REQUEST['procedure_id'.$i]!='')

				   {

					 $sql4 = $conn->query("INSERT INTO `invoice_final_procedure_for_draft_bill` SET `hospital_number`='".$hospital_number."',`patient_registration_id`='".$patient_registration_id."' ,`i_id` = '".$id."',`procedure_id` = '".$_REQUEST['procedure_id'.$i]."',`amount` = '".$_REQUEST['amount'.$i]."',`discount` = '".$_REQUEST['discount'.$i]."',`net_amount` = '".$_REQUEST['net_amount'.$i]."',`surgery_flag` = '".$_REQUEST['surgery_flag'.$i]."',`created_by`='".$created_by."',`created_on`='".$created_on."',`procedure_mode_flag` = '1',`procedure_remarks` = '".$_REQUEST['procedure_remarks'.$i]."',`discount_percentage` = '".$_REQUEST['discount_percentage'.$i]."' ");						

						

					 

				   }   

				}

				

				for($i=1;$i<=$countiopc_additional_doctor;$i++) {

				 if($_REQUEST['additional_doctor_id'.$i]!='0')

				   {

					 $sql4 = $conn->query("INSERT INTO `additional_doctor_for_invoice_final_billing_for_draft_bill` SET `hospital_number`='".$hospital_number."',`patient_registration_id`='".$patient_registration_id."' ,`i_id` = '".$id."',`additional_doctor_id` = '".$_REQUEST['additional_doctor_id'.$i]."',`remarks_additional_doctor` = '".$_REQUEST['remarks_additional_doctor'.$i]."',`created_by`='".$created_by."',`created_on`='".$created_on."',`additional_doctor_flag` = '1' ");	

				   }   

				}

				

		

		

		$p_action="S";

			

				

				for($i=1;$i<=$count_payment_mode;$i++) {

				 if($_REQUEST['p_key'.$i]!='')

				   {

					 $sql4 = $conn->query("INSERT INTO `invoice_final_payment_billing_for_draft_bill` SET `hospital_number`='".$hospital_number."',`patient_registration_id`='".$patient_registration_id."' ,`i_id` = '".$id."',`p_key` = '".$_REQUEST['p_key'.$i]."',`p_value` = '".$_REQUEST['p_value'.$i]."',`p_action` = '".$p_action."',`tpa_name` = '".$_REQUEST['tpa_name'.$i]."',`claim_no` = '".$_REQUEST['claim_no'.$i]."',`payment_date` = '".date("Y-m-d", strtotime($_REQUEST['payment_date'.$i]))."',`payment_time` = '".date("H:i", strtotime($_REQUEST['payment_time'.$i]))."',`payment_type` = '".$_REQUEST['payment_type'.$i]."',`payment_mode_flag` = '1',`created_by`='".$created_by."',`created_on`='".$created_on."',`advance_invoice_id` = '".$_REQUEST['advance_invoice_id'.$i]."',`advance_bill_invoice_no` = '".$_REQUEST['advance_bill_invoice_no'.$i]."',`advance_bill_invoice_unique_id` = '".$_REQUEST['advance_bill_invoice_unique_id'.$i]."',`insurance_name` = '".$_REQUEST['insurance_name'.$i]."',`advance_bill_refund_flag` = '".$_REQUEST['advance_bill_refund_flag'.$i]."' ");	

					
					 

				   }   

				}

			

			

			if($opd_flag=='1'){
				$redirectUrlPrint=ADMIN_URL.'print_final_bill_for_opd_new_for_draft_bill.php?id='.$id;
			}else{
				$redirectUrlPrint=ADMIN_URL.'print_final_bill_for_ipd_new_for_draft_bill.php?id='.$id;
			}

						

			//$redirectUrlPrint=ADMIN_URL.'print_final_bill.php?id='.$id;

			$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard_for_draft_bill.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\"> window.open('$redirectUrlPrint', '_blank'); window.location.href='$redirectUrl'; </script>";

		}

		else

		{

		$flg=1;

		$msg="Error:".$sql."<br>".$conn->error;

			 $redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard_for_draft_bill.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";



		}

		
		
		}



}

?>
<?php include "header.php"; ?>
<link href="select2/select2.css" rel="stylesheet" />
<style>
[data-id="chief"] {
 max-width: 630px !important;
}
#general_instructions_subpackage {
	width: 1030px !important;
}
#s2id_autogen1 {
	width: 180px !important;
}
</style>
<style>
.control-label {
	color: black !important;
	font-weight:bold !important;
}
.portlet-body > label {
	color: black !important;
	font-weight:bold !important;
}
.portlet-body .row {
	background:#dcefff !important;
	font-weight:bold !important;
}
.portlet.light {
	background:#fff !important;
	font-weight:bold !important;
}
.footer-block {
	background: transparent !important;
	font-weight:bold !important;
}
.font-green-sharp {
	color: black !important;
	font-weight:bold !important;
}
.font-black-sharp {
	color: black !important;
	font-weight:bold !important;
}
.select2-container {
	width: 342.083px !important;
}
#span_title {
	color:#b32424;
	font-weight:bold;
	text-transform:uppercase;
	font-size:16px;
	display: list-item;
	margin-left : 1em;
}
.span_title_new {
	color:#f9f8f8;
	font-weight:bold;
	text-transform:uppercase;
	font-size:16px;
	display: list-item;
	margin-left : 1em;
}
.span_title_new_adding {
	color:#f9f8f8;
	font-weight:bold;
	font-size:16px;
}
#billing_date_span {
	font-size:16px;
	color:#f9f8f8;
	font-weight:bold;
	padding : 12px;
	border:2px solid #F30;
}
#name {
	text-transform: capitalize;
}
</style>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container"> 
  
  <!-- BEGIN PAGE HEAD -->
  
  <div class="page-head">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE TITLE -->
      
      <div class="page-title">
        <h1><small>Welcome to EMR Dashboard</small></h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
          <li class="active"> Manage </li>
        </ul>
      </div>
      
      <!-- END PAGE TITLE --> 
      
    </div>
  </div>
  
  <!-- END PAGE HEAD --> 
  
  <!-- BEGIN PAGE CONTENT -->
  
  <div class="page-content">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE CONTENT INNER -->
      
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">
                <?php if($_REQUEST['opd_flag']=='1'){ echo 'OPD Final ';}else{ echo 'IPD Final ';} ?>
                Billing</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body"> 
              
              <!-- BEGIN FORM-->
              
              <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                <input type="hidden" name="uhid_no_param" id="uhid_no_param" class="form-control"  placeholder="Name" value="<?php if(isset($_REQUEST['uhid_no'])){ echo $_REQUEST['uhid_no']; }?>" >
                <div class="form-body">
                  <div class="row" style="background:#dcefff;!important; padding:9px 0px">
                    <center>
                      <h1><span class="caption-subject font-blue-sharp bold uppercase">
                        <?php if($_REQUEST['opd_flag']=='1'){ echo 'OPD Final ';}else{ echo 'IPD Final ';} ?>
                        Billing</span></h1>
                    </center>
                    <div class="col-md-12">
                      <div class="col-md-4" style="float:right !important;text-align:right !important;">
                        <label class="checkbox-inline">
                          <input type="checkbox" id="draft_bill" name="draft_bill" value="0"  />
                          <span class="caption-subject font-black-sharp" style="color:#e31669 !important;font-size:18px;"><strong>Draft Bill </strong></span></label>
                      </div>
                    </div>
                    <div class="col-md-12"><br/>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">UHID No.</label>
                        <input type="text" id="hospital_number" name="hospital_number" class="form-control" placeholder="Enter Text"  readonly />
                        <input type="hidden" id="created_on" name="created_on" class="form-control" value="<?php echo date('Y-m-d H:i:s');?>">
                        <input type="hidden" id="created_by" name="created_by" class="form-control" value="<?php echo $_SESSION['id'];?>">
                        <input type="hidden" id="status" name="status" class="form-control" value="1">
                        <input type="hidden" id="patient_registration_id" name="patient_registration_id" class="form-control" >
                        <input type="hidden" id="opd_flag" name="opd_flag" class="form-control" value="<?php echo $_REQUEST['opd_flag']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Date</label>
                        <input class="form-control form-control-inline date-picker" type="date"  placeholder="Select Date" id="crdate" name="crdate" value="<?php echo date("Y-m-d"); ?>" readonly />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Prefix</label>
                        <select class="form-control" name="prefix" id="prefix" onchange="gender_defualt();">
                          <?php 
								  $sql7="SELECT `id`, `prefix_name` FROM `prefix_masters`  WHERE  `del_flag`='0' ORDER BY `prefix_name` ASC";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
								 {								 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['prefix_name'].'</option>';

								 }
					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Patient Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Text"  onblur="case_convrt('name')"  />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Doctor </label>
                        <select class=" form-control select2" name="doc_id" id="doc_id" onChange="calculate_sales();" >
                          <option value="0">Select Doctor</option>
                          <?php 

							if(isset($_REQUEST['id'])){
									  $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'   ORDER BY `user_infos`.`name` ASC ";
								 }else{								
									 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'   AND `users`.`del_flag`='0' ORDER BY `user_infos`.`name` ASC ";			
								 }

								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';



								 }

					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Mobile</label>
                        <div class="input-group"> <span class="input-group-addon" style="padding:0 !important; width:20% !important">
                          <input type="text" id="mobile_prefix" name="mobile_prefix" class="form-control" value="" placeholder="+91"  />
                          </span> <span class="input-group-addon" style="padding:0 !important; width:70% !important">
                          <input type="phone"  autocomplete="off"  onkeyup="value=value.replace(/[^\d]/g,'');mobile_check();" onblur="mobile_check();" id="mobile" name="mobile" class="form-control" value="" placeholder="Enter 10 digit Phone No."  />
                          </span> </div>
                        <span id="error_mobie" style="color: red;font-weight:bold;"></span> </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Gender/Sex</label>
                        <input type="hidden" id="email" name="email" class="form-control" placeholder="Enter Text" />
                        <select class="form-control" name="gender" id="gender">
                          <option value="">Choose..</option>
                          <?php 

								  $sql7="SELECT `id`, `gender` FROM `gender_masters`  WHERE  `del_flag`='0' ORDER BY `id` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" '; echo '>'.$row7['gender'].'</option>';

								 }

					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Age (+Yrs.)</label>
                        <div class="input-group">
                          <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="age"  id="age"  autocomplete="off" placeholder="Age in Years" class="form-control" value="" >
                          <span class="input-group-addon" style="padding:0 !important">Years</span></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Address</label>
                        <textarea id="address" name="address" class="form-control" placeholder="Full Address with Vill./Ward No."></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <p>&nbsp;</p>
                    </div>
                    <div id="ipd_billing_date_time" style="display:none;" class="col-md-12">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Admission Date (dd-mm-YYYY)</label>
                          <input class="form-control form-control-inline date-picker" type="text"  placeholder="Select Date" id="admission_date" name="admission_date"   autocomplete="off"  />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Admission Time (h:m A)</label>
                          <input class="form-control form-control-inline date-picker" type="text"  placeholder="Select Date" id="admission_time" name="admission_time"  autocomplete="off"  />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Discharge Date (dd-mm-YYYY)</label>
                          <input class="form-control form-control-inline date-picker" type="text"  placeholder="Select Date" id="date_of_discharge" name="date_of_discharge"  autocomplete="off"   />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Discharge Time (h:m A)</label>
                          <input class="form-control form-control-inline time-picker" type="text"  placeholder="Select Time" id="time_of_discharge" name="time_of_discharge"  autocomplete="off"  />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <p>&nbsp;</p>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <label class="control-label">PT Type</label>
                        <select class=" form-control" name="pt_type" id="pt_type" onChange="retrieve_procedure();" >
                          <?php 

								  $sql7="SELECT `id`, `name` FROM `patient_type_master`  WHERE  `del_flag`='0' AND `id`='5' ORDER BY `name` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';

								 }

					 			?>
                          <?php 

								  $sql7="SELECT `id`, `name` FROM `patient_type_master`  WHERE  `del_flag`='0'  AND `id`<>'5' ORDER BY `name` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';

								 }

					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Billing Date & Time(dd-mm-YYYY)(h:m A)</label>
                        <div class="input-group">
                          <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Billing Date" id="billing_date" name="billing_date" value="<?php echo date("d-m-Y");  ?>" />
                          <span class="input-group-addon" style="padding:0 !important; width:50% !important">
                          <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Billing Time" name="billing_time" id="billing_time" value="<?php  echo date("h:i A");  ?>"  />
                          </span></div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Free Reason</label>
                        <textarea id="free_reason" name="free_reason" class="form-control" placeholder="Free / Discount Reason"></textarea>
                      </div>
                    </div>
                    <div id="defualt_individual_additional_doctor" style="display:none;" class="col-md-6">
                      <div class="col-md-12" style="text-align:right;font-weight:bold;"><b>To Add Additional Doctor / Optom, Please Click On This Icon</b><a href="javascript:void(0);"  id="iop_add_buttonc_additional_doctor" class="btn" title="Add One Doctor" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                        <div class="col-md-12">
                          <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover" id="iop_tabc_additional_doctor">
                              <?php

									$count=1;

									$sl=1;

                                     echo '<input type="hidden" name="countiopc_additional_doctor" id="countiopc_additional_doctor" value="'.$count.'">';

                                  ?>
                              <tr>
                                <th>Additional Doctor </th>
                                <th>Remarks</th>
                                <th>&nbsp;</th>
                              </tr>
                              <tr id="iopc_additional_doctor<?php echo $sl; ?>">
                                <td ><select  name="additional_doctor_id<?php echo $sl; ?>" id="additional_doctor_id<?php echo $sl; ?>"  class="form-control select2">
                                    <option value="0">Select Doctor </option>
                                    <?php 
									
									if(isset($_REQUEST['id'])){
										  $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'   ORDER BY `user_infos`.`name` ASC ";
									 }else{								
										 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'   AND `users`.`del_flag`='0' ORDER BY `user_infos`.`name` ASC ";			
									 }

								 
								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';



								 }

					 			?>
                                  </select></td>
                                <td ><textarea  class="form-control" placeholder="Enter Text" name="remarks_additional_doctor<?php echo $sl; ?>" id="remarks_additional_doctor<?php echo $sl; ?>"  ></textarea></td>
                                <input type="hidden" name="additional_doctor_flag<?php echo $sl; ?>" id="additional_doctor_flag<?php echo $sl; ?>" value="0">
                                <td ><a href="javascript:void(0);"  id="iop_removec_additional_doctor<?php echo $sl; ?>" onClick="remove_iopc_additional_doctor(<?php echo $sl; ?>)" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Ref By </label>
                        <select name="ref_doctor_id" id="ref_doctor_id" class="form-control select2"  >
                          <?php 
						

							if(isset($_REQUEST['id'])){
								 $sql7="SELECT * FROM `doctor_masters_for_emr`  ORDER BY `doctor_name`";
							 }else{								
								$sql7="SELECT * FROM `doctor_masters_for_emr` WHERE `del_flag`='0' ORDER BY `doctor_name`";					
							 }
							// echo $sql7;
								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';if($row3['ref_doctor_id']==$row7['id']) echo 'selected';  echo '>'.$row7['doctor_name'].' ('.$row7['doctor_ini'].')</option>';



								 }



					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <p>&nbsp;</p>
                    </div>
                    <div id="defualt_individual" style="display:block;">
                      <div class="col-md-12" style="text-align:left;font-weight:bold;"><b>To Add Procedure, Please Click On This Icon</b><a href="javascript:void(0);"  id="iop_add_buttonc" class="btn" title="Add One Procedure" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                        <div class="table-scrollable">
                          <table class="table table-striped table-bordered table-advance table-hover" id="iop_tabc">
                            <?php

									$count=1;

									$sl=1;

                                     echo '<input type="hidden" name="countiopc" id="countiopc" value="'.$count.'">';

                                  ?>
                            <tr>
                              <th>Procedure</th>
                              <th>Remarks</th>
                              <th>Amount</th>
                              <th>Disc %</th>
                              <th>Discount</th>
                              <th>Net Amount</th>
                              <th>&nbsp;</th>
                            </tr>
                            <tr id="iopc<?php echo $sl; ?>">
                              <td ><select  name="procedure_id<?php echo $sl; ?>" id="procedure_id<?php echo $sl; ?>"  class="form-control select2" 

                                    onChange="retrieve_amount('procedure_id<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();view_payment_details();view_refund_details();view_draft_bill_details_details();" >
                                  <option value="">Select Procedure</option>
                                </select></td>
                              <td ><textarea  class="form-control" placeholder="Enter Text" name="procedure_remarks<?php echo $sl; ?>" id="procedure_remarks<?php echo $sl; ?>"  ></textarea></td>
                              <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="amount<?php echo $sl; ?>" id="amount<?php echo $sl; ?>" onKeyUp="value=value.replace(/[^\d]/g,'');amount('amount<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();" ></td>
                              <td ><input type="text" autocomplete="off" class="form-control" placeholder="Enter Text" name="discount_percentage<?php echo $sl; ?>" id="discount_percentage<?php echo $sl; ?>"  onKeyUp="discount_amount_percentage('discount_percentage<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();" ></td>
                              <td ><input type="phone" autocomplete="off" class="form-control" placeholder="Enter Text" name="discount<?php echo $sl; ?>" id="discount<?php echo $sl; ?>"  onKeyUp="value=value.replace(/[^\d]/g,'');discount_amount('discount<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();" ></td>
                              <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="net_amount<?php echo $sl; ?>" id="net_amount<?php echo $sl; ?>" onKeyUp="value=value.replace(/[^\d]/g,'');calculate_sales();"  >
                                <input type="hidden" name="surgery_flag<?php echo $sl; ?>" id="surgery_flag<?php echo $sl; ?>" value="0"></td>
                              <td ><a href="javascript:void(0);"  id="iop_removec<?php echo $sl; ?>" onClick="remove_iopc('<?php echo $sl; ?>');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <input type="hidden" id="discount_purpose" name="discount_purpose" class="form-control" placeholder="Enter Text" value="" />
                      <input type="hidden" id="discount_type" name="discount_type" class="form-control" placeholder="Enter Text" value="" />
                      <input type="hidden" id="discount" name="discount" class="form-control" placeholder="Enter Text" value="0"  />
                    </div>
                    <!-- <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Discount Purpose</label>
                        <input type="text" id="discount_purpose" name="discount_purpose" class="form-control" placeholder="Enter Text"  />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Discount Type</label>
                        <select class="form-control" name="discount_type" id="discount_type"   >
                          <option value="">-Select-</option>
                          <option value="P">% Discount</option>
                          <option value="F">Gross Discount</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Discount Amount</label>
                        <input type="phone" autocomplete="off" id="discount" name="discount" class="form-control" placeholder="Enter Text"  value="0" onKeyUp="value=value.replace(/[^\d]/g,'');calculate_sales()"/>
                      </div>
                    </div>-->
                    
                    <div class="col-md-12" style="text-align:left;font-weight:bold;color:blue;font-size:16px;">
                      <div class="col-md-6"><b>Net Total: </b><span id="net_tot" style="color:red;">0</span>
                        <input type="hidden" id="total" name="total" class="form-control" placeholder="Enter Text"  value="0"/>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label" style="color:red !important;">Please Click On Calculate Button</label>
                          <br>
                          <button type="button" name="calcu" id="calcu" class="btn red" onClick="calculate_sales()" >Calculate</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12" style="text-align:left;font-weight:bold;color:#cb26b5;font-size:16px;padding-left:16px !important;"> ( <span style="border-bottom: 1px dotted black;">Rupees <span id="number_to_words_span"><?php echo ucwords(convertNumber(0));?></span> only</span> ) </div>
                    <div class="col-md-12">
                      <p>&nbsp;</p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                </div>
                <div class="row" style=" padding:9px 0px;">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;" >
                        <div class="col-md-12" style="text-align:left;font-weight:bold;color:#9b7419;font-size:16px;"><b>Patient's Advance Payments Book</b> <span>
                          <button type="button" name="payment_get_btn" id="payment_get_btn" class="btn-circle btn yellow" onClick="view_payment_details();" >Click here to get details</button>
                          </span></div>
                      </div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;" >
                        <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                          <div class="table-scrollable" style="border: 0 !important;">
                            <table class="table table-striped table-bordered table-advance table-hover" id="iop_payments_sub" style="width:100% !important;">
                              <thead>
                                <tr>
                                  <th style="font-size:16px;font-weight:bold;">Sl No.</th>
                                  <th style="width:70% !important;font-size:16px;font-weight:bold;">Payments About</th>
                                  <th style="font-size:16px;font-weight:bold;">Amount</th>
                                </tr>
                              </thead>
                              <tbody id="iop_payments_body">
                              </tbody>
                              <tfoot>
                                <tr  style="border: 3px solid #0014ff !important;font-size:19px;font-weight:bold;background-color: #d7d0d0 !important;">
                                  <td>Total of Payments :
                                    <input type="hidden" id="total_payments" name="total_payments" class="form-control" placeholder="Enter Text"  value="0"/></td>
                                  <td colspan="2" style="text-align:right;padding-right:25px;font-size:16px;color:red;"><span id="total_payments_net_tot" style="color:red;font-size:19px;font-weight:bold;">0</span></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;" >
                        <div class="col-md-12" style="text-align:left;font-weight:bold;color:#8e5fa2 ;font-size:16px;"><b>Draft Bill</b> <span>
                          <button type="button" name="draft_bill_details_get_btn" id="draft_bill_details_get_btn" class="btn-circle btn purple" onClick="view_draft_bill_details_details();" >Click here to get details</button>
                          </span></div>
                      </div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;" >
                        <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                          <div class="table-scrollable" style="border: 0 !important;">
                            <table class="table table-striped table-bordered table-advance table-hover" id="iop_draft_bill_detailss_sub" style="width:100% !important;">
                              <thead>
                                <tr>
                                  <th style="font-size:16px;font-weight:bold;">Sl No.</th>
                                  <th style="width:70% !important;font-size:16px;font-weight:bold;">Draft Bill Details</th>
                                  <th style="font-size:16px;font-weight:bold;">Action</th>
                                </tr>
                              </thead>
                              <tbody id="iop_draft_bill_details_body">
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                  </div>
                </div>
                <div class="row" style=" padding:9px 0px;">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;" >
                        <div class="col-md-12" style="text-align:left;font-weight:bold;color:#9b7419;font-size:16px;"><b>Patient's Advance Refund Book</b> <span>
                          <button type="button" name="payment_get_btn" id="payment_get_btn" class="btn-circle btn yellow" onClick="view_refund_details();" >Click here to get details</button>
                          </span></div>
                      </div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;" >
                        <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                          <div class="table-scrollable" style="border: 0 !important;">
                            <table class="table table-striped table-bordered table-advance table-hover" id="iop_refunds_sub" style="width:100% !important;">
                              <thead>
                                <tr>
                                  <th style="font-size:16px;font-weight:bold;">Sl No.</th>
                                  <th style="width:70% !important;font-size:16px;font-weight:bold;">Refund About</th>
                                  <th style="font-size:16px;font-weight:bold;">Amount</th>
                                </tr>
                              </thead>
                              <tbody id="iop_refunds_body">
                              </tbody>
                              <tfoot>
                                <tr  style="border: 3px solid #0014ff !important;font-size:19px;font-weight:bold;background-color: #d7d0d0 !important;">
                                  <td>Total of Refund :
                                    <input type="hidden" id="total_refunds" name="total_refunds" class="form-control" placeholder="Enter Text"  value="0"/></td>
                                  <td colspan="2" style="text-align:right;padding-right:25px;font-size:16px;color:red;"><span id="total_refunds_net_tot" style="color:red;font-size:19px;font-weight:bold;">0</span></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                  </div>
                </div>
                <div class="row" style="background:#3e9999 !important; padding:9px 0px;">
                  <div class="col-md-12">
                    <label for="nameField"><span class="span_title_new"><u>Payment Mode:</u></span></label>
                  </div>
                  <div class="col-md-12">
                    <div class="col-md-6" style="margin-bottom:4px; padding:0" ><span class="span_title_new_adding" >To add more, please click on this icon</span><a href="javascript:void(0);"  id="iop_payment_mode_add_btn" class="btn" title="Add more" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a> <span id="billing_date_span"> Billing Date: <?php echo date("d-m-Y");  ?></span></div>
                    <div class="col-md-6" style="text-align: right;padding-right: 3%;" id="advance_bill_pay_fetch_div"><span class="span_title_new_adding" >Fetch From Advance Billing Details</span><a href="javascript:void(0);" id="fetch_advance_details_btn" onclick="fetch_advance_details();" class="btn" title="Fetch" style="margin:0 !important"><img src="assets/admin/layout3/img/fetch.png" class="img-responsive" alt="Fetch"></a></div>
                  </div>
                  <div class="col-md-12" style="overflow-x: auto !important;">
                    <table class="table table-striped table-bordered table-advance table-hover" id="payment_mode_tab" style="overflow-x: auto !important;">
                      <thead>
                        <tr>
                          <th style="min-width:150px !important;width:150px !important;"> Payment Mode </th>
                          <th style="min-width:150px !important;width:150px !important;"> Payment Amount </th>
                          <th style="min-width:250px !important;width:250px !important;"> Date & Time </th>
                          <th style="min-width:100px !important;width:100px !important;"> Claim No. / Cheque No. </th>
                          <th style="min-width:150px !important;width:150px !important;"> TPA/ Govt. Health Scheme </th>
                          <th style="min-width:150px !important;width:150px !important;"> Payment Type </th>
                          <th style="min-width:150px !important;width:150px !important;"> Advance Bill <br />
                            Invoice No. </th>
                          <th style="min-width:150px !important;width:150px !important;"> Insurance </th>
                          <th style="min-width:50px !important;width:50px !important;">&nbsp; </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

								 $sl=1;

								 $sql2="SELECT * FROM `invoice_final_payment_billing` WHERE `i_id`= '" .$_REQUEST['id']. "' and `del_flag`='0' ";

								 $result2=$conn->query($sql2) ;

								 $count=$result2->num_rows;

								if($count=='0'){

								  echo '<input type="hidden" name="count_payment_mode" id="count_payment_mode" value="'.($count+1).'">';

							 ?>
                        <tr id="payment_mode_iop<?php echo ($count+1); ?>">
                          <td ><select name="p_key<?php echo ($count+1); ?>" id="p_key<?php echo ($count+1); ?>" class="form-control" onChange="option_payment(<?php echo ($count+1); ?>);">
                              <option value=""> Choose..</option>
                              <?php

                                  

                                   $query1="SELECT `id`, `payment_mode_name` FROM `payment_mode_masters` WHERE `del_flag`='0' ORDER BY `id`" ;

                                        $rslt=$conn->query($query1);

                                        while($rowd=mysqli_fetch_array($rslt)){

                                            echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_mode_name'].'</option>'; 

                                   

                                    }

                                  ?>
                            </select></td>
                          <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Payment Amt." name="p_value<?php echo ($count+1); ?>" id="p_value<?php echo ($count+1); ?>"  value="0" onKeyUp="value=value.replace(/[^\d]/g,'');summation_payment(<?php echo ($count+1); ?>);" onBlur="over_under_paid_calculation();" readonly="readonly">
                            <input type="hidden" name="payment_mode_flag<?php echo ($count+1); ?>" id="payment_mode_flag<?php echo ($count+1); ?>" value="0"></td>
                          <td ><div class="input-group">
                              <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Payment Time" name="payment_date<?php echo ($count+1); ?>" id="payment_date<?php echo ($count+1); ?>" value="<?php echo date("d-m-Y");  ?>" readonly="readonly" />
                              <span class="input-group-addon" style="padding:0 !important; width:50% !important">
                              <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Payment Time" name="payment_time<?php echo ($count+1); ?>" id="payment_time<?php echo ($count+1); ?>" value="<?php  echo date("h:i A");  ?>"  readonly="readonly" />
                              </span> </div></td>
                          <td ><input type="text" class="form-control" placeholder="Enter claim no. / Cheque No." name="claim_no<?php echo ($count+1); ?>" id="claim_no<?php echo ($count+1); ?>"  value="" readonly="readonly"></td>
                          <td ><select name="tpa_name<?php echo ($count+1); ?>" id="tpa_name<?php echo ($count+1); ?>" class="form-control select2" readonly="readonly">
                              <option value=""> Choose..</option>
                            </select></td>
                          <td ><select name="payment_type<?php echo ($count+1); ?>" id="payment_type<?php echo ($count+1); ?>" onChange="summation_payment(<?php echo ($count+1); ?>);over_under_paid_calculation();"  class="form-control" readonly="readonly">
                              <?php

                                  

                                   $query1="SELECT `id`, `payment_type_name` FROM `payment_type_masters` WHERE `del_flag`='0'  AND `advance_flag`='0' ORDER BY `id`" ;

                                        $rslt=$conn->query($query1);

                                        while($rowd=mysqli_fetch_array($rslt)){

                                            echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_type_name'].'</option>'; 

                                   

                                    }

                                  ?>
                            </select></td>
                          <td ><select name="advance_invoice_id<?php echo ($count+1); ?>" id="advance_invoice_id<?php echo ($count+1); ?>"  class="form-control" readonly="readonly">
                              <option value=""></option>
                            </select>
                            <input type="hidden" name="advance_bill_invoice_no<?php echo ($count+1); ?>" id="advance_bill_invoice_no<?php echo ($count+1); ?>" value="">
                            <input type="hidden" name="advance_bill_invoice_unique_id<?php echo ($count+1); ?>" id="advance_bill_invoice_unique_id<?php echo ($count+1); ?>" value=""></td>
                          <td ><select name="insurance_name<?php echo ($count+1); ?>" id="insurance_name<?php echo ($count+1); ?>" class="form-control select2" readonly="readonly">
                              <option value=""> Choose..</option>
                            </select></td>
                          <td><a href="javascript:void(0);" id="iop_remove<?php echo ($count+1); ?>" onClick="remove_payment_mode(<?php echo ($count+1); ?>)" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
                          <input type="hidden" name="advance_bill_refund_flag<?php echo ($count+1); ?>" id="advance_bill_refund_flag<?php echo ($count+1); ?>" value="3">
                        </tr>
                        <?php }  ?>
                      <input type="hidden" name="remove_id_for_payment_mode" id="remove_id_for_payment_mode" value="">
                        </tbody>
                      
                    </table>
                  </div>
                </div>
                <div class="row" style="background:#c9cfc8  !important; padding:9px 0px;color:#c9cfc8  !important;">
                  <div class="col-md-12" style="font-size:16px !important">
                    <p>&nbsp;</p>
                  </div>
                  <div class="col-md-12" style="font-size:16px !important">
                    <div class="col-md-4"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Advance Payment Amt. -> </strong></span> <strong><span id="advance_payment_amt_span" style="color:red;">0</span>
                      <input type="hidden" name="advance_payment_amt_text" id="advance_payment_amt_text" value="0" />
                      </strong> </div>
                    <div class="col-md-4"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Instant Payment Amt. -> </strong></span> <strong><span id="instant_payment_amt_span" style="color:red;">0</span>
                      <input type="hidden" name="instant_payment_amt_text" id="instant_payment_amt_text" value="0" />
                      </strong> </div>
                    <div class="col-md-4"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Refund Payment Amt. -> </strong></span> <strong><span id="refund_payment_amt_span" style="color:red;">0</span>
                      <input type="hidden" name="refund_payment_amt_text" id="refund_payment_amt_text" value="0" />
                      </strong> </div>
                  </div>
                  <div class="col-md-12" style="font-size:16px !important">
                    <p>&nbsp;</p>
                  </div>
                  <div class="col-md-12" style="font-size:16px !important">
                    <div class="col-md-4"> </div>
                    <div class="col-md-4"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Net Payment Amt. -> </strong></span> <strong><span id="net_payment_amt_span" style="color:red;">0</span>
                      <input type="hidden" name="net_payment_amt_text" id="net_payment_amt_text" value="0" />
                      </strong> </div>
                    <div class="col-md-4"> </div>
                  </div>
                  <div class="col-md-12" style="font-size:16px !important">
                    <p>&nbsp;</p>
                  </div>
                  <div class="col-md-12" style="font-size:16px !important">
                    <div class="col-md-4"> </div>
                    <div class="col-md-8" id="underpaid"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Amount to be paid -> </strong></span> <span id="to_be_underpaid" style="color:red;">0</span> </div>
                    <div class="col-md-8" id="overpaid" style="display:none;"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Amount to be reduced -> </strong></span> <span id="to_be_overpaid" style="color:red;">0</span> </div>
                  </div>
                </div>
                <p style="padding:12px 0 2px 0; text-align:center;" id="register_para" >
                  <input type="hidden" name="break_up_flag" id="break_up_flag" class="form-control" value="0">
                  <input type="hidden" name="check_sub_previous" id="check_sub_previous" class="form-control" value="0">
                  <input type="hidden" name="check_sub" id="check_sub" class="form-control" value="0">
                  <input type="hidden" name="hidden_button" id="hidden_button" class="form-control" value="0">
                  <button type="button" name="register" id="register" class="btn blue" disabled >Submit & Print</button>
                  <button type="submit" name="submit" id="submit" class="btn blue" style="display:none;" disabled>Submit & Print</button>
                  <button type="button" name="register_sms" id="register_sms" class="btn purple" disabled >Submit & SMS & Print</button>
                  <button type="submit" name="submit_sms" id="submit_sms" class="btn purple" style="display:none;" disabled>Submit & SMS & Print </button>
                  <button type="button" name="reset" id="reset" class="btn red" onClick="reset_forms_val();" >Reset</button>
                  <input type="hidden" name="request_mrd" id="request_mrd" class="form-control" value="<?php if(isset($_REQUEST['request_mrd'])){ echo $_REQUEST['request_mrd'];};?>" />
                </p>
                
                <!-- 48 hours code-->
                
              </form>
              
              <!-- END FORM--> 
              
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- END EXAMPLE TABLE PORTLET--> 
    
  </div>
</div>

<!-- END PAGE CONTENT INNER --> 

<!-- END PAGE CONTENT --> 

<!-- END PAGE CONTAINER --> 

<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script src="select2/select2.min.js"></script> 
<script type="text/javascript"> 

retrieve_procedure();



      $(document).ready( function() { 

	  $("#mrd_check").select2();

	  $("#doc_id").select2();

	  var opd_flag_check=$("#opd_flag").val();
	  
	  $("#ref_doctor_id").select2();

	  if(opd_flag_check=='0'){

		  $("#defualt_individual_additional_doctor").css('display', 'block');	

		  $("#additional_doctor_id1").select2();
		  $("#ipd_billing_date_time").css('display', 'block');

	  }

	  <?php if(isset($_REQUEST['uhid_no'])){ ?>
		var uhid_no_param=$("#uhid_no_param").val();
		mrd_check_ajax();
	  <?php } ?>

		

		setTimeout('$("#alert_msg").hide()',3000);

		$("#procedure_id1").select2();

		$("#tpa_name1").select2();

		$("#tpa_name1").attr('readonly', true);		
		$("#insurance_name1").select2();
		$("#insurance_name1").attr('readonly', true);	
			

		$("#mobile_prefix").val("+91");

		$("#billing_date").datepicker({

			   format: 'dd-mm-yyyy'

		   });

		   

		 $("#billing_time").timepicker({

			   timeFormat: 'h:mm p'

		   });

	   		

		  $("#date_of_discharge").datepicker({

			   format: 'dd-mm-yyyy'

		   });

		   

		   var d_time=$("#time_of_discharge").val();

			if(d_time!=''){

			$("#time_of_discharge").timepicker({

				timeFormat: 'h:mm p'

			});	

			}else{

			$("#time_of_discharge").timepicker({

				timeFormat: 'h:mm p'

			}).val('');	

			}

		   

		   $("#payment_date1").datepicker({

				format: 'dd-mm-yyyy'

			});

			$("#payment_time1").timepicker({

				timeFormat: 'h:mm p'

			});

			

			

		   $("#admission_date").datepicker({

			   format: 'dd-mm-yyyy'

		   });

		   

		   var d_time=$("#admission_time").val();

			if(d_time!=''){

			$("#admission_time").timepicker({

				timeFormat: 'h:mm p'

			});	

			}else{

			$("#admission_time").timepicker({

				timeFormat: 'h:mm p'

			}).val('');	

			}

			
			$('#billing_date').change(function(){
				 var billing_date=$("#billing_date").val();
				 //alert(billing_date);
				 $("#billing_date_span").html('');
				 $("#billing_date_span").html('Billing Date: '+billing_date);
			});
		

		

		$("#draft_bill").click(function(){

				if($(this).prop("checked") == true){

					var empty=1;

					$("#draft_bill").val(empty);					

				}

				else if($(this).prop("checked") == false){

					var empty=0;

					$("#draft_bill").val(empty);

				}

			});

		

		

		 

		$("#iop_add_buttonc").click(function(){ 

			 var i=$("#countiopc").val();			 

			 i=parseInt(i)+1;

			 $("#countiopc").val(i);

			  var pt_type=$("#pt_type").val();

				

				 //alert(i);

			 $("#iop_tabc").append('<tr id="iopc' + i + '"><td ><select  name="procedure_id' + i + '" id="procedure_id' + i + '"  class="form-control select2" onChange="retrieve_amount(\'procedure_id' + i + '\',\'' + i + '\');calculate_sales();view_payment_details();view_refund_details();view_draft_bill_details_details();" ><option value="">Select Procedure</option></select></td><td><textarea class="form-control" placeholder="Enter Text" name="procedure_remarks' + i + '" id="procedure_remarks' + i + '" ></textarea></td><td><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="amount' + i + '" id="amount' + i + '" onKeyUp="replace_value(\'amount' + i + '\',\'' + i + '\');amount(\'amount' + i + '\',\'' + i + '\');calculate_sales();" value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="discount_percentage' + i + '" id="discount_percentage' + i + '"  onKeyUp="discount_amount_percentage(\'discount_percentage' + i + '\',\'' + i + '\');calculate_sales();" value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="discount' + i + '" id="discount' + i + '"  onKeyUp="replace_value(\'discount' + i + '\',\'' + i + '\');discount_amount(\'discount' + i + '\',\'' + i + '\');calculate_sales();" value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="net_amount' + i + '" id="net_amount' + i + '" onKeyUp="replace_value(\'net_amount' + i + '\',\'' + i + '\');calculate_sales();" value="0"><input type="hidden" class="form-control" placeholder="Enter Text" name="surgery_flag' + i + '" id="surgery_flag' + i + '" value="0" ></td><td ><a href="javascript:void(0);"  id="iop_removec' + i + '" onClick="remove_iopc('+ i +');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

			 $("#procedure_id"+i).select2();

			retrieve_procedure_next();

							

		 });

		 

		 $("#iop_add_buttonc_additional_doctor").click(function(){ 

			 var i=$("#countiopc_additional_doctor").val();			 

			 i=parseInt(i)+1;

			 $("#countiopc_additional_doctor").val(i);

				 //alert(i);

			 $("#iop_tabc_additional_doctor").append('<tr id="iopc_additional_doctor' + i + '"> <td ><select  name="additional_doctor_id' + i + '" id="additional_doctor_id' + i + '"  class="form-control select2"><option value="0">Select Doctor</option><?php  $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'   AND `users`.`del_flag`='0' ORDER BY `user_infos`.`name` ASC ";$result7=$conn->query($sql7) ; while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)) { echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';	 }?></select></td><td ><textarea  class="form-control" placeholder="Enter Text" name="remarks_additional_doctor' + i + '" id="remarks_additional_doctor' + i + '"  ></textarea></td><input type="hidden" name="additional_doctor_flag' + i + '" id="additional_doctor_flag' + i + '" value="0"><td ><a href="javascript:void(0);"  id="iop_removec_additional_doctor' + i + '" onClick="remove_iopc_additional_doctor(' + i + ')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

			 $("#additional_doctor_id"+i).select2();

							

		 });

		 

		 

		 $("#iop_payment_mode_add_btn").live('click',function(){ 

					 var i=$("#count_payment_mode").val();

					 i=parseInt(i)+1;

					 $("#count_payment_mode").val(i);

					 //alert(i);

					 $("#payment_mode_tab").append('<tr id="payment_mode_iop'+i+'" style="background-color: #f5f5f5 !important;"><td ><select name="p_key'+i+'" id="p_key'+i+'" class="form-control" onChange="option_payment('+ i +');"><option value=""> Choose..</option><?php $query1="SELECT `id`, `payment_mode_name` FROM `payment_mode_masters` WHERE `del_flag`='0' ORDER BY `id`" ; $rslt=$conn->query($query1); while($rowd=mysqli_fetch_array($rslt)){ echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_mode_name'].'</option>';  } ?> </select></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Payment Amt." name="p_value'+i+'" id="p_value'+i+'"  value="0" onKeyUp="replace_value(\'p_value' + i + '\',\'' + i + '\');summation_payment('+ i +');" onBlur="over_under_paid_calculation();" readonly="readonly"> <input type="hidden" name="payment_mode_flag'+i+'" id="payment_mode_flag'+i+'" value="0"></td><td ><div class="input-group"><input type="text" class="form-control form-control-inline date-picker" placeholder="Select Payment Time" name="payment_date'+i+'" id="payment_date'+i+'" value="<?php echo date("d-m-Y");  ?>" readonly="readonly" /><span class="input-group-addon" style="padding:0 !important; width:50% !important"><input type="text" class="form-control form-control-inline time-picker" placeholder="Select Payment Time" name="payment_time'+i+'" id="payment_time'+i+'" value="<?php  echo date("h:i A");  ?>"  readonly="readonly" /> </span> </div></td><td ><input type="text" class="form-control" placeholder="Enter claim no. / Cheque No." name="claim_no'+i+'" id="claim_no'+i+'"  value="" readonly="readonly"></td><td ><select name="tpa_name'+i+'" id="tpa_name'+i+'" class="form-control select2" readonly="readonly"><option value=""> Choose..</option> </select></td> <td ><select name="payment_type'+i+'" id="payment_type'+i+'" class="form-control" onChange="summation_payment('+ i +');over_under_paid_calculation();" readonly="readonly"><?php $query1="SELECT `id`, `payment_type_name` FROM `payment_type_masters` WHERE `del_flag`='0'  AND `advance_flag`='0' ORDER BY `id`" ; $rslt=$conn->query($query1); while($rowd=mysqli_fetch_array($rslt)){ echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_type_name'].'</option>';  }  ?></select></td> <td ><select name="advance_invoice_id'+i+'" id="advance_invoice_id'+i+'"  class="form-control" readonly="readonly"><option value=""></option></select><input type="hidden" name="advance_bill_invoice_no'+i+'" id="advance_bill_invoice_no'+i+'" value=""><input type="hidden" name="advance_bill_invoice_unique_id'+i+'" id="advance_bill_invoice_unique_id'+i+'" value=""></td><td ><select name="insurance_name'+i+'" id="insurance_name'+i+'" class="form-control select2" readonly="readonly"><option value=""> Choose..</option> </select></td><td><a href="javascript:void(0);" id="iop_remove'+i+'" onClick="remove_payment_mode('+i+')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr><input type="hidden" name="advance_bill_refund_flag'+i+'" id="advance_bill_refund_flag'+i+'" value="3">');			 

						$("#payment_date"+i).datepicker({

							format: 'dd-mm-yyyy'

						});

						$("#payment_time"+i).timepicker({

							timeFormat: 'h:mm p'

						});

						$("#tpa_name"+i).select2();
						$("#insurance_name"+i).select2();

					});

					

					

		 

		 

		  $("#register").click(function(){ 

			 var submit_flag=0;

			 			 

			if($("#hospital_number").val()=="" ){

				alert("Please fill up patients details");

				$("#hospital_number").css( "border-width", "2px" );

				$("#hospital_number").css( "border-color", "red" );

				$("#hospital_number").focus();

				submit_flag=1;

			}

			

			if($("#name").val()=="" ){

				alert("Please fill up patients details");

				$("#name").css( "border-width", "2px" );

				$("#name").css( "border-color", "red" );

				$("#name").focus();

				submit_flag=1;

			}
			
			if($("#doc_id").val()=="0" ){

				alert("Please select doctor / optom...");				

				submit_flag=1;

			}
			
			if ($("#doc_id").val() == null) {

				alert("Please select doctor / optom...");				

				submit_flag=1;

			}
			if($("#prefix").val()=="" ){

				alert("Please select prefix...");				

				submit_flag=1;

			}
			
			if ($("#prefix").val() == null) {
				alert("Please select prefix...");				

				submit_flag=1;
			}
			
			var mob_flag=mobile_check();
			//alert(mob_flag);
			//return false;
			if(mob_flag=='1'){
				alert('Please check phone no.');
				submit_flag=1;
			}

			

			if($("#billing_date").val()=="" ){

				alert("Please check date format");

				$("#billing_date").css( "border-width", "2px" );

				$("#billing_date").css( "border-color", "red" );

				$("#billing_date").focus();

				submit_flag=1;

			}

			

			if($("#billing_time").val()=="" ){

				alert("Please check time format");

				$("#billing_time").css( "border-width", "2px" );

				$("#billing_time").css( "border-color", "red" );

				$("#billing_time").focus();

				submit_flag=1;

			}			

			/*alert(submit_flag);

			return false;*/

			var total=0;

			//net_total=Math.round(net_total);

			var  countiopc=$("#countiopc").val(); 

			for(var i=1;i<=countiopc;i++){

				var net_amount=$("#net_amount"+i).val();

				if ((isNaN(net_amount)) || (net_amount == '')) {

					 net_amount = 0;

				}

				total=parseFloat(total)+parseFloat(net_amount);

					

			}

			var net_total=total;

			if(net_total<0){

				alert("Net Total can not be Negative!!");

				submit_flag=1;

			}

			

			

			var discount_type=$("#discount_type").val();

			var discount_val=$("#discount").val();

			if((discount_type=='')&& (discount_val=='')){

				alert("Please Give Proper Discount");

				//$("#discount_type").focus();

				$("#discount").val('0');

				submit_flag=1;

			}

			

			var discount_total=net_total;

			if((discount_type!='')&& (discount_val!='')&& (discount_val!='0')){		

				if(discount_type=='F'){

					discount_total=(parseFloat(net_total)-parseFloat(discount_val));

				}

				if(discount_type=='P'){

					discount_total=parseFloat(net_total)-((parseFloat(net_total)*parseFloat(discount_val))/100);

				}

			}

			

			var fixed_net_total=Math.round(discount_total);

			total=fixed_net_total;

			$("#net_tot").html(fixed_net_total);

			$("#total").val(fixed_net_total);

			$("#to_be_underpaid").html(fixed_net_total);

			$("#to_be_overpaid").html(fixed_net_total);

			

			$("#number_to_words_span").html('Zero');

			$.ajax({

				type : "POST",

				url : "<?php echo ADMIN_URL; ?>ajax/fetch_convert_no_to_words_ajax.php",

				dataType : "json", 

				data : "fixed_net_total="+fixed_net_total,

				success : function(data) {				

				 	 $("#number_to_words_span").html(data.number_to_words_val);

				}

			});

			

			

			if(fixed_net_total<0){

				alert("Net Total can not be Negative!!");

				submit_flag=1;

			}

			

		var total_payment=$("#net_payment_amt_text").val();

		

			if(total_payment>total){

				alert("Payment is greater than net total!");

				//$("#cash_amount").focus();

				submit_flag=1;

				$("#p_value1").css( "border-width", "2px" );

				$("#p_value1").css( "border-color", "red" );

			}

			if(total_payment<total){

				alert("Payment is less than net total!");

				//$("#cash_amount").focus();

				submit_flag=1;

				$("#p_value1").css( "border-width", "2px" );

				$("#p_value1").css( "border-color", "red" );

			}

			

			over_under_paid_calculation();

			if(submit_flag==0)

			{

				//alert("success");

				$("#submit").prop( "disabled", false );

				$("#submit"). click();

			}

		
		 });
		 
		 


		
		  $("#register_sms").click(function(){ 

			 var submit_flag=0;

			 			 

			if($("#hospital_number").val()=="" ){

				alert("Please fill up patients details");

				$("#hospital_number").css( "border-width", "2px" );

				$("#hospital_number").css( "border-color", "red" );

				$("#hospital_number").focus();

				submit_flag=1;

			}

			

			if($("#name").val()=="" ){

				alert("Please fill up patients details");

				$("#name").css( "border-width", "2px" );

				$("#name").css( "border-color", "red" );

				$("#name").focus();

				submit_flag=1;

			}
			
			if($("#doc_id").val()=="0" ){

				alert("Please select doctor / optom...");				

				submit_flag=1;

			}
			
			if ($("#doc_id").val() == null) {

				alert("Please select doctor / optom...");				

				submit_flag=1;

			}
			if($("#prefix").val()=="" ){

				alert("Please select prefix...");				

				submit_flag=1;

			}
			
			if ($("#prefix").val() == null) {
				alert("Please select prefix...");				

				submit_flag=1;
			}
			
			var mob_flag=mobile_check();
			//alert(mob_flag);
			//return false;
			if(mob_flag=='1'){
				alert('Please check phone no.');
				submit_flag=1;
			}

			

			if($("#billing_date").val()=="" ){

				alert("Please check date format");

				$("#billing_date").css( "border-width", "2px" );

				$("#billing_date").css( "border-color", "red" );

				$("#billing_date").focus();

				submit_flag=1;

			}

			

			if($("#billing_time").val()=="" ){

				alert("Please check time format");

				$("#billing_time").css( "border-width", "2px" );

				$("#billing_time").css( "border-color", "red" );

				$("#billing_time").focus();

				submit_flag=1;

			}			

			/*alert(submit_flag);

			return false;*/

			var total=0;

			//net_total=Math.round(net_total);

			var  countiopc=$("#countiopc").val(); 

			for(var i=1;i<=countiopc;i++){

				var net_amount=$("#net_amount"+i).val();

				if ((isNaN(net_amount)) || (net_amount == '')) {

					 net_amount = 0;

				}

				total=parseFloat(total)+parseFloat(net_amount);

					

			}

			var net_total=total;

			if(net_total<0){

				alert("Net Total can not be Negative!!");

				submit_flag=1;

			}

			

			

			var discount_type=$("#discount_type").val();

			var discount_val=$("#discount").val();

			if((discount_type=='')&& (discount_val=='')){

				alert("Please Give Proper Discount");

				//$("#discount_type").focus();

				$("#discount").val('0');

				submit_flag=1;

			}

			

			var discount_total=net_total;

			if((discount_type!='')&& (discount_val!='')&& (discount_val!='0')){		

				if(discount_type=='F'){

					discount_total=(parseFloat(net_total)-parseFloat(discount_val));

				}

				if(discount_type=='P'){

					discount_total=parseFloat(net_total)-((parseFloat(net_total)*parseFloat(discount_val))/100);

				}

			}

			

			var fixed_net_total=Math.round(discount_total);

			total=fixed_net_total;

			$("#net_tot").html(fixed_net_total);

			$("#total").val(fixed_net_total);

			$("#to_be_underpaid").html(fixed_net_total);

			$("#to_be_overpaid").html(fixed_net_total);

			

			$("#number_to_words_span").html('Zero');

			$.ajax({

				type : "POST",

				url : "<?php echo ADMIN_URL; ?>ajax/fetch_convert_no_to_words_ajax.php",

				dataType : "json", 

				data : "fixed_net_total="+fixed_net_total,

				success : function(data) {				

				 	 $("#number_to_words_span").html(data.number_to_words_val);

				}

			});

			

			

			if(fixed_net_total<0){

				alert("Net Total can not be Negative!!");

				submit_flag=1;

			}

			

		var total_payment=$("#net_payment_amt_text").val();

		

			if(total_payment>total){

				alert("Payment is greater than net total!");

				//$("#cash_amount").focus();

				submit_flag=1;

				$("#p_value1").css( "border-width", "2px" );

				$("#p_value1").css( "border-color", "red" );

			}

			if(total_payment<total){

				alert("Payment is less than net total!");

				//$("#cash_amount").focus();

				submit_flag=1;

				$("#p_value1").css( "border-width", "2px" );

				$("#p_value1").css( "border-color", "red" );

			}

			

			over_under_paid_calculation();

			if(submit_flag==0)

			{

				//alert("success");

				$("#submit_sms").prop( "disabled", false );

				$("#submit_sms"). click();

			}

		
		 });
		 
		 

			
	  }); 

	  



function remove_iopc(j) {

	  $("#iopc"+j).remove();

	  hidden_button_func();

	  calculate_sales();

}



function remove_payment_mode(j) {

 	$("#payment_mode_iop"+j).remove();

	summation_payment();	 

	over_under_paid_calculation(); 

}



function remove_iopc_additional_doctor(j) {

	  $("#iopc_additional_doctor"+j).remove();

	  hidden_button_func();

	  calculate_sales();

}





function discount_amount(discount_id,no){

	hidden_button_func();

	var discount=$("#"+discount_id).val();

	if ((isNaN(discount)) || (discount == '')) {

		 discount = 0;

	}

	var amount=$("#amount"+no).val();

	if ((isNaN(amount)) || (amount == '')) {

		 amount = 0;

	}

	var net_amount=parseFloat(amount-discount);
	$("#net_amount"+no).val(net_amount);
	
	var discount_percentage=0;
	if(discount>0){
		discount_percentage=(((parseInt(amount)-parseInt(net_amount))/parseInt(amount))*100);
	}
	if (discount_percentage % 1 !== 0) {
		discount_percentage = discount_percentage.toFixed(2);
	}
	$("#discount_percentage"+no).val(discount_percentage);
	
}


function discount_amount_percentage(discount_id,no){

	hidden_button_func();

	var discount=$("#"+discount_id).val();

	if ((isNaN(discount)) || (discount == '')) {
		 discount = 0;
	}

	var amount=$("#amount"+no).val();
	if ((isNaN(amount)) || (amount == '')) {
		 amount = 0;
	}
	var net_amount=(parseInt(amount)*(1-(parseInt(discount)/100)));
	$("#net_amount"+no).val(net_amount);
	
	var discount_percentage=0;
	if(discount>0){
		discount_percentage=(parseInt(amount)-parseInt(net_amount));
	}
	$("#discount"+no).val(discount_percentage);	

}



function amount(amount_id,no){

	hidden_button_func();

	var amount=$("#"+amount_id).val();

	if ((isNaN(amount)) || (amount == '')) {

		 amount = 0;

	}

	var discount=$("#discount"+no).val();

	if ((isNaN(discount)) || (discount == '')) {

		 discount = 0;

	}

	var net_amount=parseFloat(amount-discount);

	$("#net_amount"+no).val(net_amount);	

}





function retrieve_procedure(){

	hidden_button_func();

	var pt_type=$("#pt_type").val();

	var countiopc=$("#countiopc").val();

	var opd_flag=$("#opd_flag").val();

	var lp=1;

	while(lp<=countiopc){

		$("#procedure_id"+lp).html("");

		$("#procedure_id"+lp).append($('<option/>', { 

		value: "",

		text : "Select Procedure" 

		}));

		//$("#iopc"+lp).remove();

		lp=lp+1;

		//$("#iopc"+lp).remove();

	}

	

	$.ajax({

		url: 'ajax/billing_fetch_procedure_ajax.php',

		dataType: 'json',

		type: 'POST',

		data: 'pt_type='+pt_type+'&opd_flag='+opd_flag,		

		success: function (data) {

			var i=1;

			while(i<=countiopc){			

			 $.each(data, function(index, element) {

				$('#procedure_id'+i).append($('<option/>', { 

					value: element.value,

					text : element.text 

				}));				

			 });

			 $("#amount"+i).val("0");

			 $("#net_amount"+i).val("0");

			 $("#discount"+i).val("0");			 
			 $("#discount_percentage"+i).val("0");			 
			  i=i+1;

				//$("#iopc"+lp).remove();

			}

		 }

		 

	 });

	 reset_procedure();

	

}

function retrieve_procedure_next(){

	hidden_button_func();

	var pt_type=$("#pt_type").val();

	var opd_flag=$("#opd_flag").val();

	var countiopc=$("#countiopc").val();	

	$("#procedure_id"+countiopc).html("");

	$("#procedure_id"+countiopc).append($('<option/>', { 

	value: "",

	text : "Select Procedure" 

	}));	

	$.ajax({

		url: 'ajax/billing_fetch_procedure_ajax.php',

		dataType: 'json',

		type: 'POST',

		data: 'pt_type='+pt_type+'&opd_flag='+opd_flag,			

		success: function (data) {

						

			 $.each(data, function(index, element) {

				$('#procedure_id'+countiopc).append($('<option/>', { 

					value: element.value,

					text : element.text 

				}));				

			 });

			 

		 }

		 

	 });	

}

function retrieve_amount(select_id,no){

	var id=$("#"+select_id).val();

	var pt_type=$("#pt_type").val();

	hidden_button_func();

	//alert(id);

	try{					

				$.ajax({

								type : "POST",

								url : "<?php echo ADMIN_URL; ?>ajax/amount_fetch_ajax.php",

								dataType : "json", 

								data : "id="+id+"&pt_type="+pt_type,

								success : function(data) {						

									//alert(data.amount);

									try{ 									 

										 $("#amount"+no).val(data.amount);

										 $("#net_amount"+no).val(data.amount);	

										 $("#discount"+no).val("0");
										 $("#discount_percentage"+no).val("0");	

										 calculate_sales();	 

									}

									catch(err){

										alert(err.message);

									}

								}

							});

						}catch(err){

							alert(err.message);

						}

					setInterval(function(){

					   $('#error_msg').html('');

					  }, 5000);

					 

}



function hidden_button_func(){

	$("#hidden_button").val("0");

	var hidden_button=$("#hidden_button").val();

	if(hidden_button=='1'){

		$("#register").prop( "disabled", false );	
		$("#register_sms").prop( "disabled", false );

	}else{

		$("#register").prop( "disabled", true );
		$("#register_sms").prop( "disabled", true );

	}	

}

function reset_procedure(){

	var countiopc=$("#countiopc").val();

	var i=2;

	while(i<=countiopc){

		remove_iopc(i);

		i=i+1;

	}

	$("#countiopc").val("1");

}









function calculate_sales(){	

	var submit_flag=0;

	//var net_total=$("#net_tot").html();

	

	if($("#hospital_number").val()=="" ){

		alert("Please fill up patients details");

		$("#hospital_number").css( "border-width", "2px" );

		$("#hospital_number").css( "border-color", "red" );

		$("#hospital_number").focus();

		submit_flag=1;

	}

	

	if($("#name").val()=="" ){

		alert("Please fill up patients details");

		$("#name").css( "border-width", "2px" );

		$("#name").css( "border-color", "red" );

		$("#name").focus();

		submit_flag=1;

	}
	
	if($("#doc_id").val()=="0" ){

		alert("Please select doctor / optom...");				

		submit_flag=1;

	}
	

	if ($("#doc_id").val() == null) {

		alert("Please select doctor / optom...");				

		submit_flag=1;

	}
	if($("#prefix").val()=="" ){

		alert("Please select prefix...");				

		submit_flag=1;

	}
	
	if ($("#prefix").val() == null) {
		alert("Please select prefix...");				

		submit_flag=1;
	}

	var mob_flag=mobile_check();	
	if(mob_flag=='1'){
		alert('Please check phone no.');
		submit_flag=1;
	}

	var total=0;

	//net_total=Math.round(net_total);

	var  countiopc=$("#countiopc").val(); 

	for(var i=1;i<=countiopc;i++){

		var net_amount=$("#net_amount"+i).val();

		if ((isNaN(net_amount)) || (net_amount == '')) {

			 net_amount = 0;

		}

		total=parseFloat(total)+parseFloat(net_amount);

			

	}

	var net_total=total;

	if(net_total<0){

		alert("Net Total can not be Negative!!");

		submit_flag=1;

	}

	

	

	var discount_type=$("#discount_type").val();

	var discount_val=$("#discount").val();

	if((discount_type=='')&& (discount_val=='')){

		alert("Please Give Proper Discount");

		//$("#discount_type").focus();

		$("#discount").val('0');

		submit_flag=1;

	}

	

	var discount_total=net_total;

	if((discount_type!='')&& (discount_val!='')&& (discount_val!='0')){		

		if(discount_type=='F'){

			discount_total=(parseFloat(net_total)-parseFloat(discount_val));

		}

		if(discount_type=='P'){

			discount_total=parseFloat(net_total)-((parseFloat(net_total)*parseFloat(discount_val))/100);

		}

	}

	var fixed_net_total=Math.round(discount_total);

	$("#net_tot").html(fixed_net_total);

	$("#total").val(fixed_net_total);

	$("#to_be_underpaid").html(fixed_net_total);

	$("#to_be_overpaid").html(fixed_net_total);

	

	$("#number_to_words_span").html('Zero');

	$.ajax({

		type : "POST",

		url : "<?php echo ADMIN_URL; ?>ajax/fetch_convert_no_to_words_ajax.php",

		dataType : "json", 

		data : "fixed_net_total="+fixed_net_total,

		success : function(data) {				

				 $("#number_to_words_span").html(data.number_to_words_val);

		}

	});

	

	if(fixed_net_total<0){

		alert("Net Total can not be Negative!!");

		$("#net_tot").css( "background-color", "#3ccd62" );

		$("#net_tot").css( "padding", "4px 10px" );

		$("#net_tot").focus();

		submit_flag=1;

	}

	if(submit_flag=='0'){

				$("#register").prop( "disabled", false );	
				$("#register_sms").prop( "disabled", false );

			}else{

				$("#register").prop( "disabled", true );
				$("#register_sms").prop( "disabled", true );

			}

}

function over_under_paid_calculation(){

	

			var submit_flag=0;

			var total=0;

			//net_total=Math.round(net_total);

			var  countiopc=$("#countiopc").val(); 

			for(var i=1;i<=countiopc;i++){

				var net_amount=$("#net_amount"+i).val();

				if ((isNaN(net_amount)) || (net_amount == '')) {

					 net_amount = 0;

				}

				total=parseFloat(total)+parseFloat(net_amount);

					

			}

			var net_total=total;

			if(net_total<0){

				alert("Net Total can not be Negative!!");

				submit_flag=1;

			}

			

			

			var discount_type=$("#discount_type").val();

			var discount_val=$("#discount").val();

			if((discount_type=='')&& (discount_val=='')){

				alert("Please Give Proper Discount");

				//$("#discount_type").focus();

				$("#discount").val('0');

				submit_flag=1;

			}

			

			var discount_total=net_total;

			if((discount_type!='')&& (discount_val!='')&& (discount_val!='0')){		

				if(discount_type=='F'){

					discount_total=(parseFloat(net_total)-parseFloat(discount_val));

				}

				if(discount_type=='P'){

					discount_total=parseFloat(net_total)-((parseFloat(net_total)*parseFloat(discount_val))/100);

				}

			}

			

			var fixed_net_total=Math.round(discount_total);

			total=fixed_net_total;			

							

			var total_payment=$("#net_payment_amt_text").val();									

			if(total_payment>total){

				alert("Payment is greater than net total!");

				//$("#cash_amount").focus();

				submit_flag=1;

				$("#p_value1").css( "border-width", "2px" );

				$("#p_value1").css( "border-color", "red" );

				var rest_amt=parseFloat(total)-parseFloat(total_payment);

				$("#overpaid").css( "display", "block" );

				$("#underpaid").css( "display", "none" );

				$("#to_be_overpaid").html("(Net Total - Total Payment Amt)= "+rest_amt);

				return;

			}

			

			if(total_payment<total){

				alert("Payment is less than net total!");

				//$("#cash_amount").focus();

				submit_flag=1;

				$("#p_value1").css( "border-width", "2px" );

				$("#p_value1").css( "border-color", "red" );

				var rest_amt=parseFloat(total)-parseFloat(total_payment);

				$("#overpaid").css( "display", "none" );

				$("#underpaid").css( "display", "block" );

				$("#to_be_underpaid").html("(Net Total - Total Payment Amt)= "+rest_amt);

				return ;

			}

			if(total_payment==total){							

				var rest_amt=parseFloat(total)-parseFloat(total_payment);

				$("#overpaid").css( "display", "none" );

				$("#underpaid").css( "display", "block" );

				submit_flag=0;

				$("#to_be_underpaid").html("(Net Total - Total Payment Amt)= "+rest_amt);

				return ;

			}

			

			if(submit_flag=='0'){

				$("#register").prop( "disabled", false );	
				$("#register_sms").prop( "disabled", false );

			}else{

				$("#register").prop( "disabled", true );
				$("#register_sms").prop( "disabled", true );

			}

}





function view_payment_details(){

	var patient_registration_id=$("#patient_registration_id").val();

	var opd_flag=$("#opd_flag").val();

	$("#iop_payments_body").html('');

	if(patient_registration_id!=''){						

				$.ajax({

								type : "POST",

								url : "<?php echo ADMIN_URL; ?>ajax/patient_payments_fetch_ajax.php",

								dataType : "json", 

								data : "patient_registration_id="+patient_registration_id+"&opd_flag="+opd_flag,

								success : function(data) {						

									//alert(data.amount);

									var total_all_expences=0;									

									var row_increase=0;

									 $.each(data, function(index, element) {

											row_increase=parseInt(row_increase)+1;

											if(element.counter=='1'){										

											$("#iop_payments_body").append('<tr id="iopc_payments_sub_details0" style="border-top: 3px solid red !important;border-left: 3px solid red !important;border-right: 3px solid red !important;font-size:16px;color:red;"><td colspan="3"><u>' + element.char_lett + ') ' + element.expence_title + '</u></td></tr>');	

											$("#iop_payments_body").append('<tr id="iopc_payments_sub_details' + element.counter + '" style="border-left: 3px solid red !important;border-right: 3px solid red !important;"><td >' + element.counter + '. </td> <td >' + element.expneses_abouts + '</td>  <td >' + element.total_charge_occupied_bed + '</td> </tr>');

											}else{

												$("#iop_payments_body").append('<tr id="iopc_payments_sub_details' + element.counter + '" style="border-left: 3px solid red !important;border-right: 3px solid red !important;"><td >' + element.counter + '. </td> <td >' + element.expneses_abouts + '</td>  <td >' + element.total_charge_occupied_bed + '</td> </tr>');

											}

											if(element.counter==element.count){

												if(row_increase==element.terminate_flag){

												$("#iop_payments_body").append('<tr id="iopc_payments_sub_details_final" style="border-left: 3px solid red !important;border-right: 3px solid red !important;border-bottom: 3px solid #0014ff  !important;font-size:16px;"><td>Total</td><td colspan="2" style="text-align:right;padding-right:25px;font-size:16px;color:red;">' + element.total_expence_loop + '</td></tr>');

												}else{

													$("#iop_payments_body").append('<tr id="iopc_payments_sub_details_final" style="border-left: 3px solid red !important;border-right: 3px solid red !important;border-bottom: 3px solid red !important;font-size:16px;"><td>Total</td><td colspan="2" style="text-align:right;padding-right:25px;font-size:16px;color:red;">' + element.total_expence_loop + '</td></tr>');

												}

												//console.log(element.terminate_flag);

												total_all_expences=parseInt(total_all_expences)+parseInt(element.total_expence_loop);;	

											}

									 });

										$("#total_payments_net_tot").html(total_all_expences);

										$("#total_payments").val(total_all_expences);									

								}								

							});

							}

						

}


function view_refund_details(){

	var patient_registration_id=$("#patient_registration_id").val();

	var opd_flag=$("#opd_flag").val();

	$("#iop_refunds_body").html('');

	if(patient_registration_id!=''){						

				$.ajax({

								type : "POST",

								url : "<?php echo ADMIN_URL; ?>ajax/patient_refund_fetch_ajax.php",

								dataType : "json", 

								data : "patient_registration_id="+patient_registration_id+"&opd_flag="+opd_flag,

								success : function(data) {						

									//alert(data.amount);

									var total_all_expences=0;									

									var row_increase=0;

									 $.each(data, function(index, element) {

											row_increase=parseInt(row_increase)+1;

											if(element.counter=='1'){										

											$("#iop_refunds_body").append('<tr id="iopc_refunds_sub_details0" style="border-top: 3px solid red !important;border-left: 3px solid red !important;border-right: 3px solid red !important;font-size:16px;color:red;"><td colspan="3"><u>' + element.char_lett + ') ' + element.expence_title + '</u></td></tr>');	

											$("#iop_refunds_body").append('<tr id="iopc_refunds_sub_details' + element.counter + '" style="border-left: 3px solid red !important;border-right: 3px solid red !important;"><td >' + element.counter + '. </td> <td >' + element.expneses_abouts + '</td>  <td >' + element.total_charge_occupied_bed + '</td> </tr>');

											}else{

												$("#iop_refunds_body").append('<tr id="iopc_refunds_sub_details' + element.counter + '" style="border-left: 3px solid red !important;border-right: 3px solid red !important;"><td >' + element.counter + '. </td> <td >' + element.expneses_abouts + '</td>  <td >' + element.total_charge_occupied_bed + '</td> </tr>');

											}

											if(element.counter==element.count){

												if(row_increase==element.terminate_flag){

												$("#iop_refunds_body").append('<tr id="iopc_refunds_sub_details_final" style="border-left: 3px solid red !important;border-right: 3px solid red !important;border-bottom: 3px solid #0014ff  !important;font-size:16px;"><td>Total</td><td colspan="2" style="text-align:right;padding-right:25px;font-size:16px;color:red;">' + element.total_expence_loop + '</td></tr>');

												}else{

													$("#iop_refunds_body").append('<tr id="iopc_refunds_sub_details_final" style="border-left: 3px solid red !important;border-right: 3px solid red !important;border-bottom: 3px solid red !important;font-size:16px;"><td>Total</td><td colspan="2" style="text-align:right;padding-right:25px;font-size:16px;color:red;">' + element.total_expence_loop + '</td></tr>');

												}

												//console.log(element.terminate_flag);

												total_all_expences=parseInt(total_all_expences)+parseInt(element.total_expence_loop);;	

											}

									 });

										$("#total_refunds_net_tot").html(total_all_expences);

										$("#total_refunds").val(total_all_expences);									

								}								

							});

							}

						

}





function view_draft_bill_details_details(){

	var patient_registration_id=$("#patient_registration_id").val();	

	var opd_flag=$("#opd_flag").val();

	$("#iop_draft_bill_details_body").html('');

	if(patient_registration_id!=''){						

				$.ajax({

								type : "POST",

								url : "<?php echo ADMIN_URL; ?>ajax/patient_draft_bill_details_fetch_ajax.php",

								dataType : "json", 

								data : "patient_registration_id="+patient_registration_id+"&opd_flag="+opd_flag,

								success : function(data) {						

									//alert(data.amount);

									var total_all_expences=0;									

									var row_increase=0;

									//var k=$("#countiopc_hos_sub").val();

									 $.each(data, function(index, element) {											

											row_increase=parseInt(row_increase)+1;											

											$("#iop_draft_bill_details_body").append('<tr id="iopc_draft_bill_details' + element.counter + '"style="border-top: 3px solid red !important;border-left: 3px solid red !important;border-right: 3px solid red !important;border-bottom: 3px solid #0014ff  !important;font-size:16px;"><td >' + element.counter + '. </td> <td >' + element.expneses_abouts + '</td>  <td >' + element.total_charge_occupied_bed + '</td> </tr>');											

									 });																		

								}								

							});

							}

						

}



function mrd_check_ajax(){	

				var id=$("#uhid_no_param").val();

				var hidden_button=$("#hidden_button").val();

								

				$.ajax({

								type : "POST",

								url : "<?php echo ADMIN_URL; ?>ajax/billing_fetch_ajax.php",

								dataType : "json", 

								data : "id="+id,

								success : function(data) {

										if(data.flag=='1'){						 

											$("#hospital_number").val(data.uhid_no);	

											$("#name").val(data.name);	
											case_convrt('name');									 

											$("#mobile").val(data.mobile);
											mobile_check();

											$("#patient_registration_id").val(data.id);

											$("#doc_id").select2("val", data.admiting_doctor);

											$("#address").val(data.address);

											$("#age").val(data.age);

											$("#gender").val(data.gender);
											$("#prefix").val(data.prefix);

											if(hidden_button=='1'){

												$("#register").prop( "disabled", false );	
												$("#register_sms").prop( "disabled", false );

											}else{

												$("#register").prop( "disabled", true );
												$("#register_sms").prop( "disabled", true );

											}

											retrieve_procedure();

											view_payment_details();
											view_refund_details();

											view_draft_bill_details_details();

										}

								}

							});

						

					

	

}

function option_payment(no){

		$("#p_value"+no).attr('readonly', true);

		$("#payment_date"+no).attr('readonly', true);

		$("#payment_time"+no).attr('readonly', true);

		$("#claim_no"+no).val('');

		$("#claim_no"+no).attr('readonly', true);

		$("#tpa_name"+no).attr('readonly', true);
		$("#insurance_name"+no).attr('readonly', true);

		$("#payment_type"+no).attr('readonly', true);

		$("#tpa_name"+no).html("");

		$("#tpa_name"+no).append($('<option/>', { 

			value: "",

			text : "Select" 

		}));
		$("#insurance_name"+no).html("");

		$("#insurance_name"+no).append($('<option/>', { 

			value: "",

			text : "Select" 

		}));

		$("#payment_type"+no).val('1');

		$("#p_value"+no).val('0');

		

	var p_key=$("#p_key"+no).val();

	if(p_key!=''){

		$("#p_value"+no).attr('readonly', false);

		$("#payment_date"+no).attr('readonly', false);

		$("#payment_time"+no).attr('readonly', false);

		$("#payment_type"+no).attr('readonly', false);

	}

	//alert("ani");

	

	$.ajax({

		url: 'ajax/payment_mode_fetching_value_ajax.php',

		dataType: 'json',

		type: 'POST',

		data: 'p_key_id='+p_key,		

		success: function (data) {			

			 if(data.cheque_mode==1){

				$("#claim_no"+no).attr('readonly', false); 

			 }

			 if(data.tpa_mode==1){

				$("#claim_no"+no).attr('readonly', false); 

				$("#tpa_name"+no).attr('readonly', false);
				 $("#insurance_name"+no).attr('readonly', false); 

				tpa_values_fetch(no);
				insurance_values_fetch(no);

			 }	

			 if(data.govt_health_mode==1){

				$("#claim_no"+no).attr('readonly', false); 

				$("#tpa_name"+no).attr('readonly', false);
				$("#insurance_name"+no).attr('readonly', false);

				govt_health_mode_values_fetch(no);

			 }

		 }

		 

	 });

	

	

}



function summation_payment(no){

		

	var total_payments=0;

	var instant_payments=0;

	var advance_payments=0;

	var refund_payments=0;

			//net_total=Math.round(net_total);

			var  count_payment_mode=$("#count_payment_mode").val(); 

			for(var i=1;i<=count_payment_mode;i++){				

				var payment_type=$("#payment_type"+i).val();

				if(payment_type==3){

					var p_value=$("#p_value"+i).val();

					if ((isNaN(p_value)) || (p_value == '')) {

						 p_value = 0;

					}

					refund_payments=parseFloat(refund_payments)+parseFloat(p_value);

				}else if(payment_type==2){

					var p_value=$("#p_value"+i).val();

					if ((isNaN(p_value)) || (p_value == '')) {

						 p_value = 0;

					}

					advance_payments=parseFloat(advance_payments)+parseFloat(p_value);

				}else{

					var p_value=$("#p_value"+i).val();

					if ((isNaN(p_value)) || (p_value == '')) {

						 p_value = 0;

					}

					instant_payments=parseFloat(instant_payments)+parseFloat(p_value);

				}

				

					

			}

			total_payments=(parseFloat(instant_payments)+parseFloat(advance_payments))-parseFloat(refund_payments);

				

				$("#advance_payment_amt_span").html(advance_payments);

				$("#advance_payment_amt_text").val(advance_payments);

				$("#instant_payment_amt_span").html(instant_payments);

				$("#instant_payment_amt_text").val(instant_payments);

				$("#refund_payment_amt_span").html(refund_payments);

				$("#refund_payment_amt_text").val(refund_payments);

				$("#net_payment_amt_span").html(total_payments);

				$("#net_payment_amt_text").val(total_payments);

				

				//over_under_paid_calculation();

				

}



function govt_health_mode_values_fetch(no){

	$("#tpa_name"+no).html("");

		$("#tpa_name"+no).append($('<option/>', { 

			value: "",

			text : "Select" 

		}));
		
		$("#insurance_name"+no).html("");

		$("#insurance_name"+no).append($('<option/>', { 

			value: "",

			text : "Select" 

		}));

		$.ajax({

		url: 'ajax/govt_health_option_fetch_ajax.php',

		dataType: 'json',

		type: 'POST',

		data: 'no='+no,			

		success: function (data) {						

			 $.each(data, function(index, element) {

				$('#tpa_name'+no).append($('<option/>', { 

					value: element.value,

					text : element.text 

				}));				

			 });

			 

		 }

		 

	 });

		

}



function tpa_values_fetch(no){

	$("#tpa_name"+no).html("");

		$("#tpa_name"+no).append($('<option/>', { 

			value: "",

			text : "Select" 

		}));
		

		$.ajax({

		url: 'ajax/tpa_option_fetch_ajax.php',

		dataType: 'json',

		type: 'POST',

		data: 'no='+no,			

		success: function (data) {						

			 $.each(data, function(index, element) {

				$('#tpa_name'+no).append($('<option/>', { 

					value: element.value,

					text : element.text 

				}));				

			 });

		 }
	 });
}


function insurance_values_fetch(no){
		
		$("#insurance_name"+no).html("");

		$("#insurance_name"+no).append($('<option/>', { 

			value: "",

			text : "Select" 

		}));

		$.ajax({

		url: 'ajax/insurance_option_fetch_ajax.php',

		dataType: 'json',

		type: 'POST',

		data: 'no='+no,			

		success: function (data) {						

			 $.each(data, function(index, element) {

				$('#insurance_name'+no).append($('<option/>', { 

					value: element.value,

					text : element.text 

				}));				

			 });

		 }
	 });
}





function fetch_advance_details(){

	var hospital_number=$("#hospital_number").val();

	var patient_registration_id=$("#patient_registration_id").val();

	var opd_flag=$("#opd_flag").val();

	if(hospital_number==''){

		alert("Please Enter UHID");

		return false;	

	}

	$("#advance_bill_pay_fetch_div").css('display','none');	

	$.ajax({				

			  type : "POST",

			  url : "<?php echo ADMIN_URL; ?>ajax/fetch_advance_details_ajax.php",

			  dataType : "json", 

			  data : "hospital_number="+hospital_number+"&patient_registration_id="+patient_registration_id+"&opd_flag="+opd_flag,

			  success : function(data) {						

				  //alert(data.amount);

				  var total_all_expences=0;						  

					  var row_increase=0;

					  var incmt=0;

					  $.each(data, function(index, element) {

							  incmt=parseInt(incmt)+1;

							  if(incmt=='1'){

								  var p_key_check=$("#p_key"+incmt).val();

								  var p_value_check=$("#p_value"+incmt).val();

								  if((p_key_check=='')&&(p_value_check=='0')){

									 remove_payment_mode(incmt); 

								  }

							  }

							   var i=$("#count_payment_mode").val();

								 i=parseInt(i)+1;

								 $("#count_payment_mode").val(i);

								 //alert(i);
								 var option_val='';
								  if(element.refund_flag=='1'){
									  option_val='<?php $query1="SELECT `id`, `payment_type_name` FROM `payment_type_masters` WHERE `del_flag`='0'  AND `refund_flag`='1'  ORDER BY `id`" ; $rslt=$conn->query($query1); while($rowd=mysqli_fetch_array($rslt)){ echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_type_name'].'</option>';  }  ?>';
								 }else{
									 option_val='<?php $query1="SELECT `id`, `payment_type_name` FROM `payment_type_masters` WHERE `del_flag`='0'  AND `advance_flag`='1'  ORDER BY `id`" ; $rslt=$conn->query($query1); while($rowd=mysqli_fetch_array($rslt)){ echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_type_name'].'</option>';  }  ?>';
								 }

								 $("#payment_mode_tab").append('<tr id="payment_mode_iop'+i+'" style="background-color: #f5f5f5 !important;"><td ><select name="p_key'+i+'" id="p_key'+i+'" class="form-control" onChange="option_payment('+ i +');"  readonly="readonly"><option value=""> Choose..</option><?php $query1="SELECT `id`, `payment_mode_name` FROM `payment_mode_masters` WHERE `del_flag`='0' ORDER BY `id`" ; $rslt=$conn->query($query1); while($rowd=mysqli_fetch_array($rslt)){ echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_mode_name'].'</option>';  } ?> </select></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Payment Amt." name="p_value'+i+'" id="p_value'+i+'"  value="0" onKeyUp="replace_value(\'p_value' + i + '\',\'' + i + '\');summation_payment('+ i +');" onBlur="over_under_paid_calculation();" readonly="readonly"> <input type="hidden" name="payment_mode_flag'+i+'" id="payment_mode_flag'+i+'" value="0"></td><td ><div class="input-group"><input type="text" class="form-control form-control-inline date-picker" placeholder="Select Payment Time" name="payment_date'+i+'" id="payment_date'+i+'" value="<?php echo date("d-m-Y");  ?>" readonly="readonly" /><span class="input-group-addon" style="padding:0 !important; width:50% !important"><input type="text" class="form-control form-control-inline time-picker" placeholder="Select Payment Time" name="payment_time'+i+'" id="payment_time'+i+'" value="<?php  echo date("h:i A");  ?>"  readonly="readonly" /> </span> </div></td><td ><input type="text" class="form-control" placeholder="Enter claim no. / Cheque No." name="claim_no'+i+'" id="claim_no'+i+'"  value="" readonly="readonly"></td><td ><select name="tpa_name'+i+'" id="tpa_name'+i+'" class="form-control select2" readonly="readonly"><option value=""> Choose..</option> </select></td> <td ><select name="payment_type'+i+'" id="payment_type'+i+'" class="form-control" onChange="summation_payment('+ i +');over_under_paid_calculation();" readonly="readonly">'+option_val+'</select></td> <td ><select name="advance_invoice_id'+i+'" id="advance_invoice_id'+i+'"  class="form-control" readonly="readonly"><option value=""></option></select><input type="hidden" name="advance_bill_invoice_no'+i+'" id="advance_bill_invoice_no'+i+'" value=""><input type="hidden" name="advance_bill_invoice_unique_id'+i+'" id="advance_bill_invoice_unique_id'+i+'" value=""></td><td ><select name="insurance_name'+i+'" id="insurance_name'+i+'" class="form-control select2" readonly="readonly"><option value=""> Choose..</option> </select></td><td><a href="javascript:void(0);" id="iop_remove'+i+'" onClick="special_alert('+i+');" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a> | <a href="<?php echo ADMIN_URL; ?>print_advance_final_bill.php?id='+element.advance_bill_invoice_unique_id+'" id="print_bill_url'+i+'" target="_blank" title="Print Advance Bill"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png" title="Print Advance Bill"> </a></td><input type="hidden" name="advance_bill_refund_flag'+i+'" id="advance_bill_refund_flag'+i+'" value="'+element.refund_flag+'"></tr>');


									$("#payment_date"+i).datepicker({

										format: 'dd-mm-yyyy'

									});

									$("#payment_time"+i).timepicker({

										timeFormat: 'h:mm p'

									});

									$("#tpa_name"+i).select2();

									$("#s2id_tpa_name"+i).attr('readonly', true); 

									$("#s2id_tpa_name"+i).find(".select2-choice").css('background-color','#eeeeee');

									$("#s2id_tpa_name"+i).find(".select2-arrow").css('background-color','#eeeeee');									

									$("#s2id_tpa_name"+i).find(".select2-choice").css('cursor','not-allowed');

									$("#s2id_tpa_name"+i).find(".select2-arrow").css('cursor','not-allowed');
									
									
									$("#insurance_name"+i).select2();

									$("#s2id_insurance_name"+i).attr('readonly', true); 

									$("#s2id_insurance_name"+i).find(".select2-choice").css('background-color','#eeeeee');

									$("#s2id_insurance_name"+i).find(".select2-arrow").css('background-color','#eeeeee');									

									$("#s2id_insurance_name"+i).find(".select2-choice").css('cursor','not-allowed');

									$("#s2id_insurance_name"+i).find(".select2-arrow").css('cursor','not-allowed');

									

									//$("#p_key"+i).val(element.p_key);

									$("#p_value"+i).val(element.p_value);

									$("#payment_date"+i).val(element.payment_date);

									$("#payment_time"+i).val(element.payment_time);

									$("#claim_no"+i).val(element.claim_no);

									$("#tpa_name"+i).val(element.tpa_name);
									
									//$("#insurance_name"+i).val(element.insurance_name);

									$("#payment_type"+i).val(element.payment_type);

									$("#advance_invoice_id"+i).html("");									 

									$('#advance_invoice_id'+i).append($('<option/>', { 

										value: element.id,

										text : element.lab_bill_invo 

									}));

									$("#p_key"+i).html("");									 

									$('#p_key'+i).append($('<option/>', { 

										value: element.p_key,

										text : element.payment_mode_name 

									}));

									$("#advance_bill_invoice_no"+i).val(element.lab_bill_invo);

									$("#advance_bill_invoice_unique_id"+i).val(element.advance_bill_invoice_unique_id);									

									summation_payment(1);

									over_under_paid_calculation();

									 

									

					   });

					   

					   

			  }		  

		  });

}



function special_alert(row_id){

	if(confirm('Are you sure to delete? Before deleting please adjust with advance final billing...')) {

		//return true; 

		remove_payment_mode_for_adavnce_billing(row_id);

		}

		else {

			return false;

		}

}

function remove_payment_mode_for_adavnce_billing(j) {

	var advance_bill_invoice_unique_id=$("#advance_bill_invoice_unique_id"+j).val();

	//alert(advance_bill_invoice_unique_id);

	var count_payment_mode=$("#count_payment_mode").val();	

	for(var lp=1;lp<=count_payment_mode;lp++){

		var check_unique_id=$("#advance_bill_invoice_unique_id"+lp).val();

		if(advance_bill_invoice_unique_id==check_unique_id){

			$("#payment_mode_iop"+lp).remove();

			summation_payment();	 

			over_under_paid_calculation(); 

		}

	}

	

}



function replace_value(select_id,no){

	/*var str = "Hello123!";

	var newStr = str.replace(/[a-zA-Z]/g, '*');*/

	var id_values=$("#"+select_id).val();

	//alert(id_values);

	var newStr = id_values.replace(/[a-zA-Z]/g, '');

	var newStr2 = newStr.replace(/[ ]/g, '');

	var newStr3 = newStr2.replace(/[_\W]+/g, '');

	//alert(newStr3);

	$("#"+select_id).val(newStr3);

}



function reset_forms_val(){

	location.reload();	

}

function gender_defualt(){
	
	 $.ajax({
		  type: "POST",
		  dataType : "json", 
		  url: 'get_json_data_patient.php?flag=3',		  
		  data: {
			  prefix: $("#prefix").val()
		  },
		  success: function(data) {
			//alert(data.Msg);
			$("#gender").val(data.default_gender);
			
		  }
	});
}

function case_convrt(input_id){
		let inputText = $("#"+input_id).val();
		//alert(inputText);
		let properCaseText = toProperCase(inputText);
		//alert(properCaseText);
		$("#"+input_id).val(properCaseText);            
}
function toProperCase(str) {
	return str.toLowerCase().replace(/\b\w/g, function(char) {
		return char.toUpperCase();
	});
}
function mobile_check() {
	$('#error_mobie').html('');	
	var mobile = $('#mobile').val();
    // Remove all non-digit characters
    mobile = mobile.replace(/\D/g, '');
    $('#mobile').val(mobile); // Set only digits back
	var mob_flag=0;
    if (mobile.length > 10) {
      $('#error_mobie').html('Mobile number cannot exceed 10 digits');
	  mob_flag=1;
    }else if (mobile.length < 10) {
      $('#error_mobie').html('Mobile number cannot less than 10 digits');
	  mob_flag=1;
    } else {
      $('#error_mobie').html('');
	  mob_flag=0;
    }
	return mob_flag;
}


</script>
<?php include "footer.php" ?>

<!-- END JAVASCRIPTS -->

</body><!-- END BODY -->

</html>