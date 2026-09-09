<?php
include 'function.php';
include "conn.php";
//$_SESSION["department_id"]=8;
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
$flag=$_GET["flag"];
if($flag=="1"){	
	get_discharge_summery_next_final_post_of_chk();	
}else if($flag=="2"){	
	discharge_summery_remarks_update();	
}else if($flag=="3"){	
	all_patient_advance_bill_cancel();	
}else{
	echo "Flag  Not Selected";
}
// For IPD
function get_discharge_summery_next_final_post_of_chk(){
	global $conn;
	$from_date = ($_POST['from_date']!='') ? date('Y-m-d',strtotime($_POST['from_date'])) : '';
	$to_date = ($_POST['to_date']!='') ? date('Y-m-d',strtotime($_POST['to_date'])) : '';	
	$filter_purpose_of_discharge = ($_POST['filter_purpose_of_discharge']!='') ? $_POST['filter_purpose_of_discharge'] : '';
	//$post_up_form_discharge = ($_POST['post_up_form_discharge']!='') ? date('Y-m-d',strtotime($_POST['post_up_form_discharge'])) : '';	
	//$final_up_form_discharge = ($_POST['final_up_form_discharge']!='') ? date('Y-m-d',strtotime($_POST['final_up_form_discharge'])) : '';
	$search='';
	$having_search='';
	/*if($from_date!='' && $to_date!=''){
		$search=" and DATE(`created_on`) BETWEEN '".$from_date."' AND  '".$to_date."'";
	}else if($from_date!=''){
		$search=" and (DATE(`created_on`) BETWEEN '".$from_date."' AND  '".$from_date."')";
	}else{
		$search=" and (DATE(`created_on`) BETWEEN '".$to_date."' AND  '".$to_date."')";
	}*/
	if($from_date!='' && $to_date!=''){
		$search=" and DATE(`".$filter_purpose_of_discharge."`) BETWEEN '".$from_date."' AND  '".$to_date."'";
	}else if($from_date!=''){
		$search=" and (DATE(`".$filter_purpose_of_discharge."`) BETWEEN '".$from_date."' AND  '".$from_date."')";
	}else if($to_date!=''){
		$search=" and (DATE(`".$filter_purpose_of_discharge."`) BETWEEN '".$to_date."' AND  '".$to_date."')";
	}else{
		$search=" and (DATE(`".$filter_purpose_of_discharge."`) BETWEEN '".date('Y-m-d')."' AND  '".date('Y-m-d')."')";
	}
	/*if($search!='' && ($post_up_form_discharge!='' || $final_up_form_discharge!='')){
		$having_search=" HAVING ((date(next_postop_chkup) BETWEEN '".$post_up_form_discharge."' and '".$to_date."') OR (date(final_postop_chkup) BETWEEN '".$final_up_form_discharge."' and '".$to_date."'))";
		if($post_up_form_discharge!='' && $final_up_form_discharge==''){
		$having_search=" HAVING (date(next_postop_chkup) BETWEEN '".$post_up_form_discharge."' and '".$to_date."')";
		}
		if($final_up_form_discharge!='' && $post_up_form_discharge==''){
			$having_search=" HAVING (date(final_postop_chkup) BETWEEN '".$final_up_form_discharge."' and '".$to_date."')";
		}
	}*/
	/*$having_search1='';
	$having_search2='';
	if($post_up_form_discharge!='' ){
		$having_search1=" And (date(next_postop_chkup) BETWEEN '".$post_up_form_discharge."' and '".$post_up_form_discharge."')";
	}
	if($final_up_form_discharge!=''){
		$having_search2=" And (date(final_postop_chkup) BETWEEN '".$final_up_form_discharge."' and '".$final_up_form_discharge."')";
	}*/
	
	$arr=array();
	$sl_no=1;
	$sql3=" SELECT * FROM `patient_discharge_summary`  WHERE del_flag<>1 $search $having_search1  ORDER BY `id` DESC ";
	$result3=$conn->query($sql3) ;
	while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
		extract($row3);
		$sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$created_by."'";
	    $result7=$conn->query($sql7) ;				
	    $row7 = $result7->fetch_assoc();
	    $count7=$result7->num_rows;
	    if($count7>0){
		  $created_by=$row7['name'];
	    }
	    $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$modified_by."'";
	    $result8=$conn->query($sql8) ;				
	    $row8 = $result8->fetch_assoc();
	    $count8=$result8->num_rows;
	    if($count8>0) {
		  $modified_by=$row8['name'];
	    } 

	    $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$deleted_dy."'";
	    $result9=$conn->query($sql9) ;				
	    $row9 = $result9->fetch_assoc();
	    $count9=$result9->num_rows;
	    if($count9>0){
		  $deleted_by=$row9['name'];
	    }
		$sql11="SELECT `name` FROM `user_infos` Where `users_id`='".$admiting_doctor."'";
		 $result11=$conn->query($sql11) ;				
		 $row11 = $result11->fetch_assoc();
		 $count11=$result11->num_rows;
		 if($count11>0){
			$admiting_doctor=$row11['name'];
		 }
		 $sql121="SELECT * FROM `prefix_masters` Where `id`='".$prefix."'";
		 $result121=$conn->query($sql121) ;				
		 $row121 = $result121->fetch_assoc();
		 $count121=$result121->num_rows;
		 if($count121>0){
			$prefix=$row121['prefix_name'];
		 }
		 $sql113="SELECT * FROM `gender_masters` Where `id`='".$gender."'";
		 $result131=$conn->query($sql113) ;				
		 $row131 = $result131->fetch_assoc();
		 $count131=$result131->num_rows;
		 if($count131>0){
			$gender=$row131['gender'];
		 }
		 
		  if($registration_date==''){
			 $registration_date='';
		 }else{
			$registration_date=date('d-m-Y', strtotime($registration_date));
		 }
		 if($registration_time==''){
			 $registration_time='';
			 
		 }else{
			$registration_time=date('h:i A', strtotime($registration_time));
		 }
		 if($discharge_date==''){
			 $discharge_date='';
		 }else{
			$discharge_date=date('d-m-Y', strtotime($discharge_date));
		 }
		 if($discharge_time==''){
			 $discharge_time='';
		 }else{
			$discharge_time=date('h:i A', strtotime($discharge_time));
		 }
		 
		 if($discharge_date==''){
			 $discharge_date='';
		 }else{
			$discharge_date=date('d-m-Y', strtotime($discharge_date));
		 }
		 if($next_postop_chkup_time==''){
			 $next_postop_chkup_time='';
		 }else{
			$next_postop_chkup_time=date('h:i A', strtotime($next_postop_chkup_time));
		 }
		 if($final_postop_chkup==''){
			 $final_postop_chkup='';
		 }else{
			$final_postop_chkup=date('d-m-Y', strtotime($final_postop_chkup));
		 }
		 if($next_postop_chkup==''){
			 $next_postop_chkup='';
		 }else{
			$next_postop_chkup=date('d-m-Y', strtotime($next_postop_chkup));
		 }
		 if($discharge_remarks==''){
			 $discharge_remarks='';
		 }else{
			$discharge_remarks=$discharge_remarks;
		 }

		  if($modified_on!=''){ 
			$modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($modified_on)); 
		  } 
		  if($deleted_time!=''){
		   $deleted_details=" <b>Reason: </b> ".$row3['reason']."  <br/> <b>Cancel By: </b>". $deleted_by."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($deleted_time))."<br/>";
		   }
		  $data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($created_on))." ; <br/>". $modifiaction_details."<br/>". $deleted_details;
		 $remarks="";
		  $action_tab='<a href="discharge_summary_from_print.php?discharge_id='.$id.'" title="Print Discharge For '.$prefix.' '.$patient_name.'"><i class="fa fa-print"></i></a><a href="javascript:void(0)" title="Remarks For '.$prefix.' '.$patient_name.'" data-toggle="modal" data-target="#remarks_modal" onClick="remarks_patient('.$id.',\''.$prefix.' '.$patient_name.'\',\''.str_replace("\n","/n",$discharge_remarks).'\')"><i class="fa fa-comments-o"></i></a>';
		  
		$arr[]=array("sl_no"=>$sl_no,"prefix"=>$prefix,"uhid_no"=>$uhid_no,"patient_name"=>$patient_name,"phone_no"=>$phone_no,"dob"=>$dob,"age"=>$age,"gender"=>$gender,"admiting_doctor"=>$admiting_doctor,"registration_date"=>$registration_date,"registration_time"=>$registration_time,"discharge_date"=>$discharge_date,"discharge_time"=>$discharge_time,"data_details"=>$data_details,"action_tab"=>$action_tab,"anaesthetst_doctor"=>$anaesthetst_doctor,"next_postop_chkup"=>$next_postop_chkup,"next_postop_chkup_time"=>$next_postop_chkup_time,"final_postop_chkup"=>$final_postop_chkup,"discharge_remarks"=>$discharge_remarks);
		$sl_no++; 
	}
echo json_encode($arr);
}
function discharge_summery_remarks_update(){
	global $conn;
	$discharge_remarks=$_POST['discharge_remarks'];
	$id=$_POST['id'];
	$msg='';
	if($id!=''){
	$sql="UPDATE `patient_discharge_summary` SET `discharge_remarks`='".$discharge_remarks."' WHERE id='".$id."'";
	$result3=$conn->query($sql) ;
	$msg='Update data Sucessfully!....';
	}else{
	$msg='Id Mismatch Please Check Update Id!....';	
	}
	echo json_encode(array('Msg'=>$msg));
}
function all_patient_advance_bill_cancel(){
	
	global $conn;
	$from_date = ($_POST['from_date']!='') ? date('Y-m-d',strtotime($_POST['from_date'])) : '';
	$to_date = ($_POST['to_date']!='') ? date('Y-m-d',strtotime($_POST['to_date'])) : '';	
	$bill_tpe = ($_POST['bill_tpe']!='') ? $_POST['bill_tpe'] : '';	
	$search='';
	if($from_date!='' && $to_date!=''){
		$search=" and DATE(`deleted_time`) BETWEEN '".$from_date."' AND  '".$to_date."'";
	}else if($from_date!=''){
		$search=" and (DATE(`deleted_time`) BETWEEN '".$from_date."' AND  '".$from_date."')";
	}else{
		$search=" and (DATE(`deleted_time`) BETWEEN '".$to_date."' AND  '".$to_date."')";
	}
	if($bill_tpe=='opd'){
		$search .=" and opd_flag<>0;";
	}else if($bill_tpe=='ipd'){
		$search .=" and opd_flag<>1;";
	}else{
		$search .="";
	}
	$arr=array();
	/*Advance Final Billing*/
	$sl_no=1;
	$sql3=" SELECT * FROM `adavnce_final_billing`  WHERE del_flag<>0 and status='3' $search  ORDER BY `id` DESC ";
	$result3=$conn->query($sql3) ;
	while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
		$modifiaction_details='';
		 $modified_time='';
		 $deleted_time='';
		 $deleted_details='';
		 $bill_type='';
		 $gender='';
		 $prefix='';
		 $admiting_doctor='';
		extract($row3);
		$sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$created_by."'";
	    $result7=$conn->query($sql7) ;				
	    $row7 = $result7->fetch_assoc();
	    $count7=$result7->num_rows;
	    if($count7>0){
		  $created_by=$row7['name'];
	    }
	    $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$modified_by."'";
	    $result8=$conn->query($sql8) ;				
	    $row8 = $result8->fetch_assoc();
	    $count8=$result8->num_rows;
	    if($count8>0) {
		  $modified_by=$row8['name'];
	    } 

	    $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$deleted_by."'";
	    $result9=$conn->query($sql9) ;				
	    $row9 = $result9->fetch_assoc();
	    $count9=$result9->num_rows;
	    if($count9>0){
		  $deleted_by_=$row9['name'];
	    }
		$sql11="SELECT `name` FROM `user_infos` Where `users_id`='".$doc_id."'";
		 $result11=$conn->query($sql11) ;				
		 $row11 = $result11->fetch_assoc();
		 $count11=$result11->num_rows;
		 if($count11>0){
			$admiting_doctor=$row11['name'];
		 }
		 $sql121="SELECT * FROM `prefix_masters` Where `id`='".$prefix."'";
		 $result121=$conn->query($sql121) ;				
		 $row121 = $result121->fetch_assoc();
		 $count121=$result121->num_rows;
		 if($count121>0){
			$prefix=$row121['prefix_name'];
		 }
		 $sql113="SELECT * FROM `gender_masters` Where `id`='".$gender."'";
		 $result131=$conn->query($sql113) ;				
		 $row131 = $result131->fetch_assoc();
		 $count131=$result131->num_rows;
		 if($count131>0){
			$gender=$row131['gender'];
		 }
		 $bill_type='';
		 if($opd_flag=='1'){
			  $bill_type='OPD';
		 }
		 if($opd_flag=='0'){
			  $bill_type='IPD';
		 }
		 $billing_payment_mode='';
		 $sql_mode="SELECT `adavnce_final_payment_billing`.*,(SELECT `payment_mode_name` FROM `payment_mode_masters` Where `id`=adavnce_final_payment_billing.p_key) as mode_name FROM `adavnce_final_payment_billing` Where `i_id`='".$id."'";
		 $res_mode=$conn->query($sql_mode) ;				
		 while($row_mode = $res_mode->fetch_assoc()){
			 $billing_payment_mode .=$row_mode['mode_name'].' : '.$row_mode['p_value'].'<br>';
		 }

		   if($modified_time!=''){ 
			$modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($modified_time)); 
		  } 
		  if($deleted_time!=''){
		   $deleted_details=" <b>Reason: </b> ".$reason."  <br/> <b>Cancel By: </b>". $deleted_by_."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($deleted_time))."<br/>";
		   }
		  $created_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($created_on))." ; <br/>". $modifiaction_details."<br/>";
		 $remarks="";
		 $sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
		 $res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
		 $row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	
		 $m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($billing_date)) , "4/1", "3/31");
		 $bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/RECP/'.$bill_type.'/'.$invo_no;
		  //$action_tab='<a href="discharge_summary_from_print.php?discharge_id='.$id.'" title="Print Discharge For '.$prefix.' '.$patient_name.'"><i class="fa fa-print"></i></a><a href="javascript:void(0)" title="Remarks For '.$prefix.' '.$patient_name.'" data-toggle="modal" data-target="#remarks_modal" onClick="remarks_patient('.$id.',\''.$prefix.' '.$patient_name.'\',\''.str_replace("\n","/n",$discharge_remarks).'\')"><i class="fa fa-comments-o"></i></a>';
		  
		$arr[]=array("id"=>$id,"hospital_number"=>$hospital_number,"invo_no"=>$bill_no,"name"=>$name,"mobile_prefix"=>$mobile,"admiting_doctor"=>$admiting_doctor,"billing_date"=>$billing_date,"billing_time"=>$billing_time,"total"=>$total,"advance_amount"=>$advance_amount,"reason"=>$reason,"deleted_details"=>$deleted_details,"created_details"=>$created_details,"gender"=>$gender,"prefix"=>$prefix,"billing_payment_mode"=>$billing_payment_mode,"bill_type"=>$bill_type);
		$sl_no++; 
	}
	/**********************END********************/
	/*Final Billing*/
	$arr1=array();
	$sl_final=1;
	$sql_final=" SELECT * FROM `invoice_final_billing`  WHERE del_flag<>0 and status='3' $search  ORDER BY `id` DESC ";
	$res_final=$conn->query($sql_final) ;
	while ($row_final=mysqli_fetch_array($res_final,MYSQLI_ASSOC)){
		 $modifiaction_details='';
		 $modified_time='';
		 $deleted_time='';
		 $deleted_details='';
		 $bill_type='';
		 $gender='';
		 $prefix='';
		 $admiting_doctor='';
		 
		extract($row_final);
		$sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$created_by."'";
	    $result7=$conn->query($sql7) ;				
	    $row7 = $result7->fetch_assoc();
	    $count7=$result7->num_rows;
	    if($count7>0){
		  $created_by=$row7['name'];
	    }
	    $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$modified_by."'";
	    $result8=$conn->query($sql8) ;				
	    $row8 = $result8->fetch_assoc();
	    $count8=$result8->num_rows;
	    if($count8>0) {
		  $modified_by=$row8['name'];
	    } 

	    $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$deleted_by."'";
	    $result9=$conn->query($sql9) ;				
	    $row9 = $result9->fetch_assoc();
	    $count9=$result9->num_rows;
	    if($count9>0){
		  $deleted_by_=$row9['name'];
	    }
		$sql11="SELECT `name` FROM `user_infos` Where `users_id`='".$doc_id."'";
		 $result11=$conn->query($sql11) ;				
		 $row11 = $result11->fetch_assoc();
		 $count11=$result11->num_rows;
		 if($count11>0){
			$admiting_doctor=$row11['name'];
		 }
		 $sql121="SELECT * FROM `prefix_masters` Where `id`='".$prefix."'";
		 $result121=$conn->query($sql121) ;				
		 $row121 = $result121->fetch_assoc();
		 $count121=$result121->num_rows;
		 if($count121>0){
			$prefix=$row121['prefix_name'];
		 }
		 $sql113="SELECT * FROM `gender_masters` Where `id`='".$gender."'";
		 $result131=$conn->query($sql113) ;				
		 $row131 = $result131->fetch_assoc();
		 $count131=$result131->num_rows;
		 if($count131>0){
			$gender=$row131['gender'];
		 }
		 $billing_payment_mode='';
		 $bill_type='';
		 if($opd_flag=='1'){
			  $bill_type='OPD';
		 }
		 if($opd_flag=='0'){
			  $bill_type='IPD';
		 }
		
		
		 
		 $sql_mode="SELECT `invoice_final_payment_billing`.*,(SELECT `payment_mode_name` FROM `payment_mode_masters` Where `id`=invoice_final_payment_billing.p_key) as mode_name FROM `invoice_final_payment_billing` Where `i_id`='".$id."'";
		 $res_mode=$conn->query($sql_mode) ;				
		 while($row_mode = $res_mode->fetch_assoc()){
			 $billing_payment_mode .=$row_mode['mode_name'].' : '.$row_mode['p_value'].'<br>';
		 }

		  if($modified_time!=''){ 
			$modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($modified_time)); 
		  } 
		  if($deleted_time!=''){
		   $deleted_details=" <b>Reason: </b> ".$reason."  <br/> <b>Cancel By: </b>". $deleted_by_."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($deleted_time))."<br/>";
		   }
		  $created_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($created_on))." ; <br/>". $modifiaction_details."<br/>";
		 $remarks="";
		 $sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
		 $res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
		 $row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	
		 $m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($billing_date)) , "4/1", "3/31");
		 $bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_type.'/'.$invo_no;
		  //$action_tab='<a href="discharge_summary_from_print.php?discharge_id='.$id.'" title="Print Discharge For '.$prefix.' '.$patient_name.'"><i class="fa fa-print"></i></a><a href="javascript:void(0)" title="Remarks For '.$prefix.' '.$patient_name.'" data-toggle="modal" data-target="#remarks_modal" onClick="remarks_patient('.$id.',\''.$prefix.' '.$patient_name.'\',\''.str_replace("\n","/n",$discharge_remarks).'\')"><i class="fa fa-comments-o"></i></a>';
		  
		$arr1[]=array("id"=>$id,"hospital_number"=>$hospital_number,"invo_no"=>$bill_no,"name"=>$name,"mobile_prefix"=>$mobile_prefix,"mobile"=>$mobile,"admiting_doctor"=>$admiting_doctor,"billing_date"=>$billing_date,"billing_time"=>$billing_time,"total"=>$total,"advance_amount"=>$advance_amount,"reason"=>$reason,"deleted_details"=>$deleted_details,"created_details"=>$created_details,"gender"=>$gender,"prefix"=>$prefix,"billing_payment_mode"=>$billing_payment_mode,"bill_type"=>$bill_type,"opd_flag"=>$opd_flag);
		$sl_final++; 
	}
	/**********************END********************/
	
	/* Refund Advance Final Billing*/
	$arr_refund=array();
	$sl_no_refund=1;
	$sql3_refund=" SELECT * FROM `refund_adavnce_final_billing`  WHERE del_flag<>0 and status='3' $search  ORDER BY `id` DESC ";
	$result3_refund=$conn->query($sql3_refund) ;
	while ($row3_refund=mysqli_fetch_array($result3_refund,MYSQLI_ASSOC)){
		$modifiaction_details='';
		 $modified_time='';
		 $deleted_time='';
		 $deleted_details='';
		 $bill_type='';
		 $gender='';
		 $prefix='';
		 $admiting_doctor='';
		extract($row3_refund);
		$sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$created_by."'";
	    $result7=$conn->query($sql7) ;				
	    $row7 = $result7->fetch_assoc();
	    $count7=$result7->num_rows;
	    if($count7>0){
		  $created_by=$row7['name'];
	    }
	    $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$modified_by."'";
	    $result8=$conn->query($sql8) ;				
	    $row8 = $result8->fetch_assoc();
	    $count8=$result8->num_rows;
	    if($count8>0) {
		  $modified_by=$row8['name'];
	    } 

	    $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$deleted_by."'";
	    $result9=$conn->query($sql9) ;				
	    $row9 = $result9->fetch_assoc();
	    $count9=$result9->num_rows;
	    if($count9>0){
		  $deleted_by_=$row9['name'];
	    }
		$sql11="SELECT `name` FROM `user_infos` Where `users_id`='".$doc_id."'";
		 $result11=$conn->query($sql11) ;				
		 $row11 = $result11->fetch_assoc();
		 $count11=$result11->num_rows;
		 if($count11>0){
			$admiting_doctor=$row11['name'];
		 }
		 $sql121="SELECT * FROM `prefix_masters` Where `id`='".$prefix."'";
		 $result121=$conn->query($sql121) ;				
		 $row121 = $result121->fetch_assoc();
		 $count121=$result121->num_rows;
		 if($count121>0){
			$prefix=$row121['prefix_name'];
		 }
		 $sql113="SELECT * FROM `gender_masters` Where `id`='".$gender."'";
		 $result131=$conn->query($sql113) ;				
		 $row131 = $result131->fetch_assoc();
		 $count131=$result131->num_rows;
		 if($count131>0){
			$gender=$row131['gender'];
		 }
		 $bill_type='';
		 if($opd_flag=='1'){
			  $bill_type='OPD';
		 }
		 if($opd_flag=='0'){
			  $bill_type='IPD';
		 }
		 $billing_payment_mode='';
		 $sql_mode="SELECT `refund_adavnce_final_payment_billing`.*,(SELECT `payment_mode_name` FROM `payment_mode_masters` Where `id`=refund_adavnce_final_payment_billing.p_key) as mode_name FROM `refund_adavnce_final_payment_billing` Where `i_id`='".$id."'";
		 $res_mode=$conn->query($sql_mode) ;				
		 while($row_mode = $res_mode->fetch_assoc()){
			 $billing_payment_mode .=$row_mode['mode_name'].' : '.$row_mode['p_value'].'<br>';
		 }

		   if($modified_time!=''){ 
			$modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($modified_time)); 
		  } 
		  if($deleted_time!=''){
		   $deleted_details=" <b>Reason: </b> ".$reason."  <br/> <b>Cancel By: </b>". $deleted_by_."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($deleted_time))."<br/>";
		   }
		  $created_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($created_on))." ; <br/>". $modifiaction_details."<br/>";
		 $remarks="";
		 $sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
		 $res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
		 $row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	
		 $m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($billing_date)) , "4/1", "3/31");
		 $bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/REF/'.$bill_type.'/'.$invo_no;
		  //$action_tab='<a href="discharge_summary_from_print.php?discharge_id='.$id.'" title="Print Discharge For '.$prefix.' '.$patient_name.'"><i class="fa fa-print"></i></a><a href="javascript:void(0)" title="Remarks For '.$prefix.' '.$patient_name.'" data-toggle="modal" data-target="#remarks_modal" onClick="remarks_patient('.$id.',\''.$prefix.' '.$patient_name.'\',\''.str_replace("\n","/n",$discharge_remarks).'\')"><i class="fa fa-comments-o"></i></a>';
		  
		$arr_refund[]=array("id"=>$id,"hospital_number"=>$hospital_number,"invo_no"=>$bill_no,"name"=>$name,"mobile_prefix"=>$mobile,"admiting_doctor"=>$admiting_doctor,"billing_date"=>$billing_date,"billing_time"=>$billing_time,"total"=>$total,"advance_amount"=>$advance_amount,"reason"=>$reason,"deleted_details"=>$deleted_details,"created_details"=>$created_details,"gender"=>$gender,"prefix"=>$prefix,"billing_payment_mode"=>$billing_payment_mode,"bill_type"=>$bill_type);
		$sl_no_refund++; 
	}
	/**********************END********************/
	
	echo json_encode(array("advance"=>$arr,"final"=>$arr1,"refund"=>$arr_refund));
}
	

?>