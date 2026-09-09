<?php
include '../function.php';
include '../conn.php';
$flag=$_GET["flag"];

	if($flag=="1"){	
	
		load_basic_details();
	
	}else if($flag=="2"){
		
		load_bill_tab_details();
		
	}else if($flag=="3"){
		
		invoice_final_bill_details();
		
	}else if($flag=="4"){
		
		save_final_bill_details();
		
	}
	else{
		echo "Flag  Not Selected";
		
		}
function load_basic_details(){
	global $conn;
	$request_id=$_POST["id"];
	
	$sql="SELECT * FROM `invoice_final_billing` WHERE `id`='".$request_id."' ORDER BY `id` DESC LIMIT 1";
	$result=$conn->query($sql) ;
	$count=$result->num_rows;
	$row = $result->fetch_assoc();
	if($count>0)
	{
	$id=$row['id'];
	$uhid_no=$row['hospital_number'];
	$name=$row['name'];
	$mobile=$row['mobile'];
	$patient_registration_id=$row['patient_registration_id'];
	if($row['opd_flag']=='1'){
		$opd_flag=1;
	}else{
		$opd_flag=0;
	}
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
			$requested_details_from_invoice=$request_by_span.'<br>'.$requested_time;
		 }
	}
	$reason_for_edit='';
	$remarks_for_edit='';
	if($row['reason_for_edit']!=''){
	 	$reason_for_edit=$row['reason_for_edit'];
	}
	if($row['remarks_for_edit']!=''){
		$remarks_for_edit=$row['remarks_for_edit'];
	}
	
	
	
	$flag=1;
	$arr=array("id" => $id,"uhid_no" => $uhid_no,"name" => $name,"mobile" => $mobile,"flag" => $flag,"patient_registration_id" => $patient_registration_id,"opd_flag" => $opd_flag,"request_by_span" => $requested_details_from_invoice,"reason_for_edit" => $reason_for_edit,"remarks_for_edit" => $remarks_for_edit);
	
	}
	echo json_encode($arr);
}

function load_bill_tab_details(){
	global $conn;
	$uhid_no=$_POST["uhid_no"];	
	$sql="SELECT * FROM `invoice_final_billing` WHERE `hospital_number`='".$uhid_no."' AND `del_flag`='0'";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$sl=1;
	$count=$res->num_rows;
	while($row=mysqli_fetch_assoc($res)){
	$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");
			?>
			<tr id="selected_rows_<?php echo $sl; ?>"><td><?php echo $sl; ?></td><td><?php echo $row['hospital_number']; ?></td><td><?php echo $row['name']; ?></td><td><?php echo $row['mobile']; ?></td><td><?php echo date("d-m-Y", strtotime($row['billing_date'])); ?></td><td><strong><?php echo $row['invo_no'].'/'.$m_f_year;  ?></td><td><input type="checkbox" name="cheack_inv_bill<?php echo $sl; ?>" id="cheack_inv_bill<?php echo $sl; ?>"  title="OTP Generate" onclick="cheack_ind_bill_details(<?php echo $row['id']; ?>,<?php echo $sl; ?>,<?php echo $count; ?>);"  /> | <a href="<?php echo ADMIN_URL; ?>print_final_bill.php?id=<?php echo $row['id']; ?>"   target="_blank" title="Print Final Bill"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Final Bill"></a></td></tr>
		<?php	
	$sl++;	}	
}

function invoice_final_bill_details(){
	global $conn;
	$uhid=$_POST["id"];
	$bill_id=$_POST['bill_id'];
	
	$sql="SELECT * FROM `invoice_final_billing` WHERE `hospital_number`='".$uhid."' and `id`='".$bill_id."'  AND `del_flag`='0'";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$count=$res->num_rows;
	$row = $res->fetch_assoc();
	if($count>0)
	{
	$id=$row['id'];
	$start_time=date("d-m-Y H:i:s");
	$end_time= date("d-m-Y H:i:s",strtotime("+15 minutes",strtotime($start_time)));
	$bill_id=$row['id'];
	$invoice_no=$row['invo_no'];
	
	$flag=1;
	$arr=array("start_time" => $start_time,"end_time" => $end_time,"bill_id" => $bill_id,"invoice_no" => $invoice_no,"flag"=>$flag);
	
	}
	echo json_encode($arr);
}
function save_final_bill_details(){
	global $conn;
	$patient_registration_id=$_POST['patient_registration_id'];
	$invoice_no=$_POST['invoice_no'];
	$bill_id=$_POST['bill_id'];
	$opd_flag=$_POST['opd_flag'];
	$hospital_number=$_POST['hospital_number'];
	$name=$_POST['name'];
	$start_time=date('Y-m-d H:i:s',strtotime($_POST['crdate']));
	$end_time=date('Y-m-d H:i:s',strtotime($_POST['end_time']));
	$created_on=date('Y-m-d H:i:s',strtotime($_POST['created_on']));
	$created_by=$_POST['created_by'];
	$last_otp='100011';
	$sql="SELECT MAX(`otp_generate`)AS `last_otp` FROM `otp_generate_for_final_bill_edit` WHERE `del_flag`='0'";
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$count=$res->num_rows;
	$row = $res->fetch_assoc();
	$random_no_check=(rand(1,5));
	if($row['last_otp']!=''){
	$last_otp=$row['last_otp']+$random_no_check;	
	}
	$remarks_for_edit=mysqli_real_escape_string($conn,$_POST['remarks_for_edit']);
	
	$sql_del="UPDATE `otp_generate_for_final_bill_edit` SET `del_flag`='1',`deleted_by`='".$created_by."',`deleted_time`='".$created_on."' WHERE `patient_registration_id`='".$patient_registration_id."' AND `uhid`='".$hospital_number."' AND `invoice_no`='".$invoice_no."' AND  `bill_id`='".$bill_id."'";
	$result_del=$conn->query($sql_del) ;
	
	$sql="INSERT INTO `otp_generate_for_final_bill_edit` SET `patient_registration_id`='".$patient_registration_id."',`uhid`='".$hospital_number."',`invoice_no`='".$invoice_no."',`patient_name`='".$name."',`bill_id`='".$bill_id."',`start_time`='".$start_time."',`end_time`='".$end_time."',`otp_generate`='".$last_otp."',`created_by`='".$created_by."',`created_on`='".$created_on."'";
	//$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	if($conn->query($sql)===TRUE){
		
			$sql4 = $conn->query("UPDATE `invoice_final_billing` SET `remarks_for_edit`='".$remarks_for_edit."' WHERE `id`='".$bill_id."'");
			$msg="Record updated successfully";
			$flg=0;	
			$redirectUrl=ADMIN_URL.'otp_generate_for_final_bill_view.php';	
	}else{
			$flg=1;
			$msg="Error:".$sql."<br>".$conn->error;
			$redirectUrl=ADMIN_URL.'otp_generate_for_final_bill_edit.php';
		}
	
	echo json_encode(array("flg" => $flg,"msg" => $msg,"redirectUrl"=>$redirectUrl));
	
}
?> 