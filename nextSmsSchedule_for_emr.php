<?php 
include 'function.php';
include 'conn.php'; 
 $query="SELECT `prescription_details_for_emr`.`id`,`prescription_details_for_emr`.`mrd_no`,`prescription_details_for_emr`.`fname`,`prescription_details_for_emr`.`lname`,`prescription_details_for_emr`.`mobile`,`prescription_details_for_emr`.`next_visit_day`,`prescription_details_for_emr`.`next_visit_week`,`prescription_details_for_emr`.`next_visit_month`,date(`prescription_details_for_emr`.`created_on`) as `cdate`,`prescription_details_for_emr`.`primary_doctor`,`prescription_details_for_emr`.`prefix` FROM `prescription_details_for_emr` WHERE (`prescription_details_for_emr`.`next_visit_month` <> '0' OR `prescription_details_for_emr`.`next_visit_week` <> '0'  OR `prescription_details_for_emr`.`next_visit_day` <> '0')   AND `prescription_details_for_emr`.`mobile` <> '' GROUP BY `prescription_details_for_emr`.`mrd_no` ORDER BY `prescription_details_for_emr`.`id` ASC";
$result=$conn->query($query) ;
while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	 $created_on= date($row['cdate']);
	 if(($row['next_visit_day']!='0')||($row['next_visit_week']<4)||($row['next_visit_month']<2))
	 {
		  $cur_date=date('Y-m-d',strtotime("+2 day"));
	 }
	 else{
		 $cur_date=date('Y-m-d',strtotime("+7 day"));
	 }
	
		/* if($row['next_visit_day']!='0')
		{
			$or_date = $created_on;
			$m=$row['next_visit_day'];
			$dt = strtotime($or_date);
			$next_visit_sms_day= date("Y-m-d", strtotime("+".$m." day", $dt));
			$yr = date('Y', strtotime($next_visit_sms_day));
			$mnth = date('M', strtotime($next_visit_sms_day));
			$dat = date('d', strtotime($next_visit_sms_day));
			$vstdate= $dat.' '.$mnth.', '.$yr;		
		}	*/
		if($row['next_visit_month']!='0')
					{							
						$m=$row['next_visit_month'];
						$mnth = date('m', strtotime($created_on));
						if($m>$mnth)
						{
							$yr = date('Y', strtotime($created_on));
							$dat = date('d', strtotime($created_on));
							if($m<10){
								$mth='0'.$m;
								}
								else{
								$mth=$m;
								}
							$vstdate= $dat.' '.$mth.', '.$yr;
							$next_visit_sms_day=$yr.'-'.$mth.'-'.$dat;
						}else{
							$yr = date('Y', strtotime($created_on))+1;
							$dat = date('d', strtotime($created_on));
							if($m<10){
								$mth='0'.$m;
								}
								else{
								$mth=$m;
								}
							$vstdate= $dat.' '.$mth.', '.$yr;
							$next_visit_sms_day=$yr.'-'.$mth.'-'.$dat;
							}
		}	
		if($row['next_visit_week']!='0')
		{		
			$or_date = $created_on;
			$m=$row['next_visit_week'];
			$dt = strtotime($or_date);
			$next_visit_sms_day= date("Y-m-d", strtotime("+".$m." week", $dt));
			$yr = date('Y', strtotime($next_visit_sms_day));
			$mnth = date('M', strtotime($next_visit_sms_day));
			$dat = date('d', strtotime($next_visit_sms_day));
			$vstdate= $dat.' '.$mnth.', '.$yr;		
		}		
		if($row['next_visit_month']!='0')
		{	
			$or_date = $created_on;
			$m=$row['next_visit_month'];
			$dt = strtotime($or_date);
			$next_visit_sms_day= date("Y-m-d", strtotime("+".$m." month", $dt));
			$yr = date('Y', strtotime($next_visit_sms_day));
			$mnth = date('M', strtotime($next_visit_sms_day));
			$dat = date('d', strtotime($next_visit_sms_day));
			$vstdate= $dat.' '.$mnth.', '.$yr;		
		}
	if($next_visit_sms_day==$cur_date){
	
		$mrd_no=$row['mrd_no'];
		$mobile=$row['mobile'];		
		$fname=$row['fname'];
		$lname=$row['lname'];
		$prefix=$row['prefix'];
		$primary_doctor=$row['primary_doctor'];
		$prescription_id=$row['id'];
		$isd_code='91';
		$sms_from='DRSUDP';
		$mobile=$isd_code.$mobile;
		$fullname=$prefix.' '.$fname.' '.$lname;
		$sendDate=date("Y-m-d H:i:s");
		$sql22 = "SELECT * FROM `user_infos`  WHERE `users_id`='".$primary_doctor."'";
		$query22=mysqli_query($conn,$sql22);
		$row22 = $query22->fetch_assoc();
		$doctor_name = $row22['name'];
		//$sms_body="Dear $fullname, Your appointment with Dr. Sudipta Das is due. Please contact 8444800008 or 8444900009 for the same. Next appointment is due in 1 week.";
		$sms_body="Dear $fullname, Your next eye-checkup is scheduled next week. Please contact Global Eye Hospital for appointment. Regards $doctor_name";
		
		$smsStatus=sendSms($sms_body,$sms_from,$mobile);
		if($smsStatus!='0')
		{
			//$sql_smsLog="insert into `sms_logs` (`mrd_no`, `sms_type`, `sms_status`, `log_date`) values ('$mrd_no','2','$smsStatus','$sendDate')";
			$sql12 = $conn->query("INSERT INTO  `sms_logs` SET `mrd_no` = '".$mrd_no."',`sms_type` = '2',`sms_status` = '".$smsStatus."',`log_date` = '".$sendDate."',`reciepent`= '".$mobile."',`prescription_id`= '".$prescription_id."',`doc_id` = '".$primary_doctor."' ");
			//mysql_query($sql_smsLog,$conn);
		}
	}
}
?>