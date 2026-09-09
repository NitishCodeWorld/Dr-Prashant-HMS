<?php

include '../function.php';

include '../conn.php';

$flag=$_GET["flag"];



if($flag=="1"){		

	load_basic_details();	

}else if($flag=="2"){		

	save_request_details();		

}else if($flag=="3"){		

	validation_otp_for_edit();		

}
else if($flag=="4"){		

	load_extra_info_details();	

}else if($flag=="5"){		

	save_extra_info_details();		

}
else if($flag=="6"){		

	load_extra_info_details_tpa_adjustment();	

}
else if($flag=="7"){		

	save_extra_info_details_tpa_adjustment();		

}
else if($flag=="8"){		

	load_extra_info_details_tpa_adjustment_for_edit();		

}
else{

	echo "Flag  Not Selected";		

}



function load_basic_details(){

	global $conn;

	$invoice_id=$_POST["invoice_id"];

	

	$sql="SELECT * FROM `invoice_final_billing` WHERE `id`='".$invoice_id."' ORDER BY `id` DESC LIMIT 1";

	$result=$conn->query($sql) ;

	$count=$result->num_rows;

	$row = $result->fetch_assoc();

	if($count>0)

	{

	$id=$row['id'];	

	$hospital_number=$row['hospital_number'];

	$patient_registration_id=$row['patient_registration_id'];

	$name=$row['name'];

	$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");

	$invoice_no= $row['invo_no'].'/'.$m_f_year;

	$billing_date=date("d-m-Y", strtotime($row['billing_date'])); 

	$total=$row['total'];

	$request_by_span='';

	$requested_details_from_invoice='';

	$request_by=$row['request_by'];

	if($request_by!=''){

		$sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row['request_by']."'";

		 $result7=$conn->query($sql7) ;				

		 $row7 = $result7->fetch_assoc();

		 $count7=$result7->num_rows;

		 if($count7>0)

		 {

			$request_by_span=$row7['name'];

			$requested_time=date("d-m-Y h:i A", strtotime($row['requested_time']));

			$requested_details_from_invoice=$request_by_span.'<br><label for="recipient-name" class="col-form-label" style="font-weight:bold;font-size:16px;color: #333333;">Requested Time: &nbsp; </label>'.$requested_time;

		 }

	}

	if($request_by==''){

		$request_by=$_SESSION['user_id'];

	}

	$reason_for_edit='';

	$remarks_for_edit='';

	if($row['reason_for_edit']!=''){

	 	$reason_for_edit=$row['reason_for_edit'];

	}

	if($row['remarks_for_edit']!=''){

		$remarks_for_edit=$row['remarks_for_edit'];

	}

	

	$start_time='';

	$end_time='';

	$otp_generate='';

	$otp_timing='';

		

	$sql7="SELECT * FROM `otp_generate_for_final_bill_edit` WHERE `uhid`='".$row['hospital_number']."' AND `patient_registration_id`='".$row['patient_registration_id']."' AND `bill_id`='".$row['id']."'  AND `invoice_no`='".$row['invo_no']."' AND `del_flag`='0' ";

		 $result7=$conn->query($sql7) ;				

		 $row7 = $result7->fetch_assoc();

		 $count7=$result7->num_rows;

		 if($count7>0)

		 {

			$start_time=$row7['start_time'];

			$end_time=$row7['end_time'];

			$otp_generate=$row7['otp_generate'];

			$otp_timing='Valid For 15 Minutes : On '.date("d-m-Y", strtotime($row7['start_time'])).' | Start Time: '.date("h:i A", strtotime($row7['start_time'])).' | End Time: '.date("h:i A", strtotime($row7['end_time']));

		 }

		 

	

	$arr=array("id" => $id,"hospital_number" => $hospital_number,"patient_registration_id" => $patient_registration_id,"name" => $name,"invoice_no" => $invoice_no,"billing_date" => $billing_date,"total" => $total,"request_by_span" => $requested_details_from_invoice,"request_by" => $request_by,"reason_for_edit" => $reason_for_edit,"remarks_for_edit" => $remarks_for_edit,"start_time" => $start_time,"end_time" => $end_time,"otp_generate" => $otp_generate,"otp_timing" => $otp_timing);

	

	}

	echo json_encode($arr);

}




function save_request_details(){

	global $conn;

	$invoice_id=$_POST['invoice_id'];

	$request_by=$_POST['request_by'];

	$reason_for_edit=mysqli_real_escape_string($conn,$_POST['reason_for_edit']);

	$remarks_for_edit=mysqli_real_escape_string($conn,$_POST['remarks_for_edit']);

	$requested_time=date('Y-m-d H:i:s');

	

	$sql="UPDATE `invoice_final_billing` SET `reason_for_edit`='".$reason_for_edit."',`request_by`='".$request_by."',`remarks_for_edit`='".$remarks_for_edit."',`requested_time`='".$requested_time."'  WHERE `id`='".$invoice_id."'";

	if($conn->query($sql)===TRUE){

			$msg="Record updated successfully";

			$flg=0;	

			$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';	

	}else{

			$flg=1;

			$msg="Error:".$sql."<br>".$conn->error;

			$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';

		}

	

	echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));

	

}



function validation_otp_for_edit(){

	global $conn;

	$invoice_id=$_POST['invoice_id'];

	$generated_otp=$_POST['generated_otp'];

	$end_time=mysqli_real_escape_string($conn,$_POST['end_time']);

	$submitted_otp=mysqli_real_escape_string($conn,$_POST['submitted_otp']);	

	

	$flg=0;

	$msg='';

	$redirectUrl='';

	

	$sql7="SELECT * FROM `otp_generate_for_final_bill_edit` WHERE  `bill_id`='".$invoice_id."'   AND `del_flag`='0' ";

	 $result7=$conn->query($sql7) ;				

	 $row7 = $result7->fetch_assoc();

	 $count7=$result7->num_rows;

	 if($count7=='0')

	 {

		$msg="OTP is not generated . Please Inform Administrator For Generating OTP For Edit... ";

		$flg=1;	

		$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';

		echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));

		exit;

	 }

	

	if($generated_otp!=$submitted_otp){

		$msg="OTP is not matched with generated OTP . Please enter correct OTP... ";

		$flg=1;	

		$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';

		echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));

		exit;

	}

	

	$today_date=date("Y-m-d");	

	$edit_date=date("Y-m-d", strtotime($end_time));

	if($today_date!=$edit_date){

		$msg="OTP Expired. Please Again Inform Administrator For Generating OTP For Edit. Then Submit OTP For Edit. (Remember : OTP Valid For 15 Minutes After Generating Time..) ";

		$flg=1;	

		$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';

		echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));

		exit;

	}

	

	//$today_time=date("H:i:s");	

	//$currentTime = time() + 3600;

	$currentTime = time();

	$today_time = date('H:i',$currentTime);

	$edit_time=date("H:i", strtotime($end_time));

	

	$start = strtotime($today_time);

	$end = strtotime($edit_time);

	if ($start-$end > 0){

		$msg="OTP Expired. Please Again Inform Administrator For Generating OTP For Edit. Then Submit OTP For Edit. (Remember : OTP Valid For 15 Minutes After Generating Time..) ";

		$flg=1;	

		$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';

		echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));

		exit;

	}

	if($flg=='0'){

		$msg="Correct OTP is submitted. Now you can edit the bill for one time. Please do carefully.. Now click on edit button.. ";

		$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';

		$sql4 = $conn->query("UPDATE `invoice_final_billing` SET `generate_otp`='".$submitted_otp."',`otp_status`='1',`open_for_edit_flag`='1' WHERE `id`='".$invoice_id."'");

		echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));

		exit;

	}

	

	//echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));

	

}


function load_extra_info_details(){

	global $conn;

	$bill_unique_id=$_POST["bill_unique_id"];

	

	$sql="SELECT * FROM `invoice_final_billing` WHERE `id`='".$bill_unique_id."' ORDER BY `id` DESC LIMIT 1";

	$result=$conn->query($sql) ;

	$count=$result->num_rows;

	$row = $result->fetch_assoc();

	if($count>0)

	{

	$id=$row['id'];	

	$hospital_number=$row['hospital_number'];

	$patient_registration_id=$row['patient_registration_id'];

	$name=$row['name'];

	$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");

	$invoice_no= $row['invo_no'].'/'.$m_f_year;

	$billing_date=date("d-m-Y", strtotime($row['billing_date'])); 
	
	$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
	$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
	$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	
	$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");
	$bill_no="";
	$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row['invo_no'];

	$total=$row['total'];


	$diagnosis=$row['diagnosis'];
	$card_no=$row['card_no'];
	$policy_no=$row['policy_no'];
	$due_recieved_date='';
	$due_recieved_flag='0';	

	$arr=array("id" => $id,"hospital_number" => $hospital_number,"patient_registration_id" => $patient_registration_id,"name" => $name,"bill_no" => $bill_no,"billing_date" => $billing_date,"total" => $total,"diagnosis" => $diagnosis,"card_no" => $card_no,"policy_no" => $policy_no);

	

	}

	echo json_encode($arr);

}



function save_extra_info_details(){

	global $conn;
	
	$bill_unique_id=$_POST['bill_unique_id'];
	$diagnosis=mysqli_real_escape_string($conn,$_POST['diagnosis']);
	$card_no=mysqli_real_escape_string($conn,$_POST['card_no']);
	$policy_no=mysqli_real_escape_string($conn,$_POST['policy_no']);
	

	 $sql="UPDATE `invoice_final_billing` SET `diagnosis`='".$diagnosis."',`card_no`='".$card_no."',`policy_no`='".$policy_no."' WHERE `id`='".$bill_unique_id."'";

	if($conn->query($sql)===TRUE){
		
		
			$msg="Record updated successfully";

			$flg=0;	

			$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';	

	}else{

			$flg=1;

			$msg="Error:".$sql."<br>".$conn->error;

			$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';

		}

	

	echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));

	

}




function load_extra_info_details_tpa_adjustment(){

	global $conn;

	$bill_unique_id=$_POST["bill_unique_id"];
	$payment_unique_id=$_POST["payment_unique_id"];
	

	$sql="SELECT * FROM `invoice_final_billing` WHERE `id`='".$bill_unique_id."' ORDER BY `id` DESC LIMIT 1";

	$result=$conn->query($sql) ;

	$count=$result->num_rows;

	$row = $result->fetch_assoc();

	if($count>0)

	{

	$id=$row['id'];	

	$hospital_number=$row['hospital_number'];

	$patient_registration_id=$row['patient_registration_id'];

	$name=$row['name'];

	$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");

	$invoice_no= $row['invo_no'].'/'.$m_f_year;

	$billing_date=date("d-m-Y", strtotime($row['billing_date'])); 
	
	$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
	$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
	$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	
	$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");
	$bill_no="";
	$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row['invo_no'];

	$total=$row['total'];


	$diagnosis=$row['diagnosis'];
	$card_no=$row['card_no'];
	$policy_no=$row['policy_no'];
	$tpa_main_amt=0;
	
	$sql11="SELECT * FROM `invoice_final_payment_billing` WHERE `i_id`='".$bill_unique_id."' AND `p_key`='5' AND `del_flag`='0' AND `id`='".$payment_unique_id."' ";
	 $result11=$conn->query($sql11) ;
	 $row11 = $result11->fetch_assoc();
	 $count11=$result11->num_rows;
	 if($count11>0)
	 {
		$tpa_main_amt=$row11['p_value'];
		 
	 }
	
	$net_amt=0;
	/*$sql11="SELECT * FROM `invoice_final_payment_billing` WHERE `i_id`='".$bill_unique_id."' AND `p_key`='5' AND `del_flag`='0' AND `id`='".$payment_unique_id."' ";
	 $result11=$conn->query($sql11) ;
	 $row11 = $result11->fetch_assoc();
	 $count11=$result11->num_rows;
	 if($count11>0)
	 {
		if($row11['due_recieved_date']!=''){
		$due_recieved_date=date("d-m-Y", strtotime($row11['due_recieved_date']));
		}else{
			$due_recieved_date='';
		}
		$due_recieved_flag=$row11['due_recieved_flag'];
		$net_amt=$row11['p_value'];
		$recovery_amt='';
		 if($row11['recovery_amt']!=''){
			$recovery_amt=$row11['recovery_amt'];
		 }				 
		 $tds='';
		 if($row11['tds']!=''){
			$tds=$row11['tds'];
		 }				 
		 $discount_tpa='';
		 if($row11['discount_tpa']!=''){
			$discount_tpa=$row11['discount_tpa'];
		 }	 
		 $tpa_recovery_due='';
		 if($row11['tpa_recovery_due']!=''){
			$tpa_recovery_due=$row11['tpa_recovery_due'];
		 }	
		 $total_tpa='';
		 if($row11['total_tpa']!=''){
			$total_tpa=$row11['total_tpa'];
		 }
		 $remarks_tpa='';
		 if($row11['remarks_tpa']!=''){
			$remarks_tpa=$row11['remarks_tpa'];
		 }
		 if($row11['accounts_entry_date']!=''){
			$accounts_entry_date=date("d-m-Y", strtotime($row11['accounts_entry_date']));
		}else{
			$accounts_entry_date=date("d-m-Y");
		}
		 
	 }*/
	 
	
	$accounts_entry_date='';
	$due_recieved_date='';
	
	 $net_amt=0;
	 $recovery_amt=0;
	 $tds=0;
	 $discount_tpa=0;
	 $total_tpa=0;
	 $tpa_recovery_due=0;
	 $remarks_tpa='';
	 
	 
	 
	 $sql11="SELECT * FROM `invoice_final_part_payment_tpa` WHERE `bill_unique_id`='".$bill_unique_id."' AND `del_flag`='0' AND `payment_unique_id`='".$payment_unique_id."' ";
	 $result11=$conn->query($sql11) ;
	 $row11 = $result11->fetch_assoc();
	 $count11=$result11->num_rows;
	 if($count11>0)
	 {
		if($row11['accounts_entry_date']!=''){
			$accounts_entry_date=date("d-m-Y", strtotime($row11['accounts_entry_date'])).'<br>'.$accounts_entry_date;
		}
		if($row11['due_recieved_date']!=''){
			$due_recieved_date=date("d-m-Y", strtotime($row11['due_recieved_date'])).'<br>'.$due_recieved_date;
		}
		if($row11['p_value']!=''){
			$net_amt=$net_amt+$row11['net_amt'];
		}
		if($row11['recovery_amt']!=''){
			$recovery_amt=$recovery_amt+$row11['recovery_amt'];
		}
		if($row11['tds']!=''){
			$tds=$tds+$row11['tds'];
		}		
		if($row11['total_tpa']!=''){
			$total_tpa=$total_tpa+$row11['total_tpa'];
		}	
		if($row11['tpa_recovery_due']!=''){
			$tpa_recovery_due=$tpa_recovery_due+$row11['tpa_recovery_due'];
		}	
		if($row11['remarks_tpa']!=''){
			$remarks_tpa=$row11['remarks_tpa'].'<br>'.$remarks_tpa;
		}			
		 
	 }		

	$arr=array("id" => $id,"hospital_number" => $hospital_number,"patient_registration_id" => $patient_registration_id,"name" => $name,"bill_no" => $bill_no,"billing_date" => $billing_date,"total" => $total,"due_recieved_date" => $due_recieved_date,"net_amt" => $net_amt,"recovery_amt"=>$recovery_amt,"tds"=>$tds,"discount_tpa"=>$discount_tpa,"tpa_recovery_due"=>$tpa_recovery_due,"total_tpa"=>$total_tpa,"remarks_tpa"=>$remarks_tpa,"accounts_entry_date"=>$accounts_entry_date,"tpa_main_amt"=>$tpa_main_amt);

	

	}

	echo json_encode($arr);

}


function save_extra_info_details_tpa_adjustment(){

	global $conn;
	
	$payment_unique_id=$_POST['payment_unique_id'];
	if($_POST['due_recieved_date']!=''){
		$due_recieved_date= "'".date("Y-m-d", strtotime($_POST['due_recieved_date']))."'";
	}else{
		$due_recieved_date='NULL';
	}
	$due_recieved_flag=$_POST['due_recieved_flag'];
	if($_POST['accounts_entry_date']!=''){
		$accounts_entry_date= "'".date("Y-m-d", strtotime($_POST['accounts_entry_date']))."'";
	}else{
		$accounts_entry_date='NULL';
	}
	
	
	$recovery_amt=mysqli_real_escape_string($conn,$_POST['recovery_amt']);
	$tds=mysqli_real_escape_string($conn,$_POST['tds']);
	$discount_tpa=mysqli_real_escape_string($conn,$_POST['discount_tpa']);	
	$tpa_recovery_due=mysqli_real_escape_string($conn,$_POST['tpa_recovery_due']);
	$total_tpa=mysqli_real_escape_string($conn,$_POST['total_tpa']);
	$remarks_tpa=mysqli_real_escape_string($conn,$_POST['remarks_tpa']);

	 $sql="UPDATE `invoice_final_payment_billing` SET  `due_recieved_flag`='".$due_recieved_flag."',`due_recieved_date`=".$due_recieved_date.",`recovery_amt`='".$recovery_amt."',`tds`='".$tds."',`discount_tpa`='".$discount_tpa."',`tpa_recovery_due`='".$tpa_recovery_due."',`remarks_tpa`='".$remarks_tpa."' ,`total_tpa`='".$total_tpa."',`accounts_entry_date`=".$accounts_entry_date." WHERE `id`='".$payment_unique_id."'";

	if($conn->query($sql)===TRUE){
		
		 
			$msg="Record updated successfully";

			$flg=0;	

			$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';	

	}else{

			$flg=1;

			$msg="Error:".$sql."<br>".$conn->error;

			$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php';

		}

	

	echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));
	

}



function load_extra_info_details_tpa_adjustment_for_edit(){

	global $conn;

	$bill_unique_id=$_POST["bill_unique_id"];
	$payment_unique_id=$_POST["payment_unique_id"];
	

	
	 $sl=1;	 
	 $arr=array();
	  $sql11="SELECT * FROM `invoice_final_part_payment_tpa` WHERE `bill_unique_id`='".$bill_unique_id."' AND `del_flag`='0' AND `payment_unique_id`='".$payment_unique_id."' ";
	 $result11=$conn->query($sql11) ;
	 $count11=$result11->num_rows;
	 if($count11>0)
	 {

		while($row11=mysqli_fetch_array($result11,MYSQLI_ASSOC)){
			
			$accounts_entry_date='';
			$due_recieved_date='';
			
			 $net_amt=0;
			 $recovery_amt=0;
			 $tds=0;
			 $discount_tpa=0;
			 $total_tpa=0;
			 $tpa_recovery_due=0;
			 $remarks_tpa='';

				if($row11['accounts_entry_date']!=''){
					$accounts_entry_date=date("d-m-Y", strtotime($row11['accounts_entry_date']));
				}
				if($row11['due_recieved_date']!=''){
					$due_recieved_date=date("d-m-Y", strtotime($row11['due_recieved_date']));
				}
				if($row11['net_amt']!=''){
					$net_amt=$net_amt+$row11['net_amt'];
				}
				if($row11['recovery_amt']!=''){
					$recovery_amt=$recovery_amt+$row11['recovery_amt'];
				}
				if($row11['tds']!=''){
					$tds=$tds+$row11['tds'];
				}		
				if($row11['total_tpa']!=''){
					$total_tpa=$total_tpa+$row11['total_tpa'];
				}	
				if($row11['tpa_recovery_due']!=''){
					$tpa_recovery_due=$tpa_recovery_due+$row11['tpa_recovery_due'];
				}	
				if($row11['remarks_tpa']!=''){
					$remarks_tpa=$row11['remarks_tpa'];
				}			
		
				$part_payment_flag=$row11['part_payment_flag'];
				$part_payment_insrt_id=$row11['id'];
				
				$arr[]=array("part_payment_flag" => $part_payment_flag,"part_payment_insrt_id" => $part_payment_insrt_id,"accounts_entry_date"=>$accounts_entry_date,"due_recieved_date" => $due_recieved_date,"net_amt" => $net_amt,"recovery_amt"=>$recovery_amt,"tds"=>$tds,"discount_tpa"=>$discount_tpa,"total_tpa"=>$total_tpa,"tpa_recovery_due"=>$tpa_recovery_due,"remarks_tpa"=>$remarks_tpa,"total_rows"=>$count11,"sl"=>$sl);
				$sl++;	
		}
		
	 }		

	
	echo json_encode($arr);

}





?> 