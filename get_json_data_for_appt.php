<?php
include_once("conn.php");
$main_url=ADMIN_URL;
$site_url=ADMIN_URL2;

$allowedOrigins = [
		"$site_url",
		"$main_url",
		"http://localhost/",
];
if (in_array($_SERVER["HTTP_ORIGIN"], $allowedOrigins)) {
 header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
 }

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

/*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/


//include_once("conn.php");



$flag=isset($_POST["flag"]) ? $_POST["flag"] : $_GET["flag"];



$dr_flag=(isset($_POST["dr_flag"])) ? $_POST["dr_flag"] : "";



$department_id=(isset($_POST["department_id"])) ? $_POST["department_id"] : "";



if($flag=="1"){



	$opd_flag=$_POST["opd_flag"];



	get_doctor_days($opd_flag);



}else if($flag=="2"){



	$dr_flag=$_POST['dr_flag'];



	get_doctor_list($dr_flag);



}else if($flag=="3"){



	$opd_flag=$_POST["opd_flag"];



	insert_patient_info($opd_flag);



}else if($flag=="5") get_branch_list();

else if($flag=="6") get_patient_shed();

else if($flag=="8") save_branch();

else if($flag=="9") save_proc();

else if($flag=="10") load_availability();

else if($flag=="11") save_availability();

else if($flag=="12") booked_patients();



else if($flag=="13") delete_schedule();



else if($flag=="14") load_offdays();



else if($flag=="15") save_offdays();



else if($flag=="16") delete_event();



else if($flag=="17") load_holidays();



else if($flag=="18") save_holidays();



else if($flag=="19") delete_holidays();



else if($flag=="22") get_patient_info();  // To be make



else if($flag=="23") delete_availability();



else if($flag=="24") load_procedures();



else if($flag=="38") load_branches_chember();



else if($flag=="39") delete_branches();



else if($flag=="40") load_procedure_chember();



else if($flag=="41") delete_procedure();



else if($flag=="46") load_each_availability();



else if($flag=="47") update_availability();



else if($flag=="48") load_reffer_procedures();



else if($flag=="49") validate_pw();



else if($flag=="50") schedulings_deletion_log();



else if($flag=="51") save_availability_particular_date();



else if($flag=="52") edit_patient_infos_show();



else if($flag=="53") edit_patient_infos_save();



else if($flag=="57") edit_details_for_branch();

else if($flag=="58") edit_details_for_procedure();
else if($flag=="59") slected_date_time();
else if($flag=="60") show_details_for_edit();
else if($flag=="62") load_ref_doctors();
else if($flag=="63") load_procedures_purpose();
else if($flag=="64") load_old_pt_details_for_appt_age_gender();
else if($flag=="65") appt_booked_patients_new_format();
else if($flag=="66") appt_booked_deleted_patients_new_format();
else if($flag=="67") restore_schedule();


function get_doctor_days($flag=1){	



		global $conn;



		



		$doctor_user_id=$_POST["doc_id"];



		$weekday=$_POST["weekday"];



		//$branches_id=13;

		$branches_id=$_POST["branches_id"];



		$procedure_id=($_POST["procedure_id"]=="") ? die(json_encode(array("counter"=>0))) : $_POST["procedure_id"] ;



		$visiting_date=date('Y-m-d',strtotime($_POST["selected_date"]));
		
		$button_id_first="btn_".$doctor_user_id.'_'.date('Ymd',strtotime($_POST["selected_date"])).'_'.$procedure_id;



		$sql_time="select time from `opd_procedures_for_appt` where dr_user_id='$doctor_user_id' and id = '$procedure_id' ";



		$result_time=mysqli_query($conn,$sql_time) or die(mysqli_error($conn).$sql_time);



		$row_interval=mysqli_fetch_assoc($result_time);



		$time_interval=$row_interval["time"];



		//$time_interval=($time_interval!="") ? date("i",strtotime($time_interval)) : 10;



		//echo "Time Interval:".$time_interval=$time_interval*60;



		



		$online=$_POST['online'];



		if($_SESSION['role']=='2'){



		$sql="select * from doctors_availabilitiys_for_appt where dr_user_id='$doctor_user_id' and branches_id='$branches_id' and `schedule_type` = '".abs($flag-2)."' and visiting_day='$visiting_date' AND `doctors_only`<>'1'";



		}else{



			$sql="select * from doctors_availabilitiys_for_appt where dr_user_id='$doctor_user_id' and branches_id='$branches_id' and `schedule_type` = '".abs($flag-2)."' and visiting_day='$visiting_date' ";



			}



		//echo "SQL:".$sql;



		$sql_leave="select * from `dr_leaves_for_appt` where `dr_user_id`='$doctor_user_id' and (`start_date`<='$visiting_date' and `end_date`>='$visiting_date')";		

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);

		$result_leave=mysqli_query($conn,$sql_leave) or die(mysqli_error($conn).$sql_leave);

		$flag_leave=0;

		$flag_leave=mysqli_num_rows($result_leave);

		

		

		$sql_holiday="SELECT * FROM `holidays_for_appt` where `holiday_date`='$visiting_date'";

		$result_holiday=mysqli_query($conn,$sql_holiday) or die(mysqli_error($conn).$sql_holiday);

		$flag_holiday=0;

		$flag_holiday=mysqli_num_rows($result_holiday);





		//echo $flag_leave;



		$arr=array();



		while($row=mysqli_fetch_assoc($result)){



			



			extract($row);	



			$arr[]=array("dr_id"=>$dr_user_id,"visiting_day"=>$visiting_day,"visiting_starttime"=>$visiting_starttime,"visiting_endtime"=>$visiting_endtime);



			//$start_h=intval(date("H",strtotime($visiting_starttime)));



			$end_h=intval(date("H",strtotime($visiting_endtime)));



			$start_m=intval(date("i",strtotime($visiting_starttime)));



			$start_h=intval(date("H",strtotime($visiting_starttime)));



			$end_m=intval(date("i",strtotime($visiting_endtime)));



			$start=($start_h*60)+$start_m;



			$end=($end_h*60)+$end_m;

			$k=1;

			$start_temp=date("h:i a",strtotime('-1 minutes',strtotime($visiting_starttime)));



			



			$i=0;



		

			

			if($flag_leave<=0  && $flag_holiday<=0 ){



			//*************Change by Chandrachur



			for($i=$start;$i<$end;$i+=$time_interval){

				$button_id_unique="";
				
				$start_temp1=date("h:i a",strtotime('+1 minutes',strtotime($start_temp)));



				$start_temp=date("h:i a",strtotime('+'.($time_interval).' minutes',strtotime($start_temp1)));



				$flag1=($flag==2) ? 2 : 1;



				$sql1="select * from opd_schedules_for_appt where start_time like '".date("Y-m-d H:i:s",strtotime($visiting_date." ".$start_temp1))."' and scheduled_type='$flag1' and users_id=$dr_user_id ";



				$res=mysqli_query($conn,$sql1) or die(mysqli_error($conn));



				$num_rows=mysqli_num_rows($res);



				$color="";



				$confirm_col=0;



				if($num_rows==0) { $color="#009933";}



				else if($num_rows==1) {$color="#ff9900";$confirm_col=1;}
				/*else if($num_rows==1) {$color="#009933";}
				else if($num_rows==2) {$color="#009933";}
				else if($num_rows==3) {$color="#009933";}
				else if($num_rows==4) {$color="#009933";}
				else if($num_rows==5) {$color="#ff9900";$confirm_col=0;}*/



				//else if($num_rows==2) $color="#ff6633";
				$starting_time_space=preg_replace('/\s+/', '', $start_temp1);
				$starting_time=str_replace(':', '_', $starting_time_space);
				$button_id_unique=$button_id_first.'_'.$starting_time;

				if($online==1){

						if($num_rows<=0) $arr[]=array("flag"=>"0","button_name"=>$start_temp1,"value"=>$start_temp1.'-'.$start_temp,"bgcolor"=>$color,"confirm_col"=>$confirm_col,"button_id_unique"=>$button_id_unique);

		



						else if($num_rows>0){



						

						 $arr[]=array("flag"=>"1","button_name"=>"Booked","value"=>$start_temp1.'-'.$start_temp,"button_id_unique"=>$button_id_unique);



						}



				



				}else{



						if($num_rows<=1) $arr[]=array("flag"=>"0","button_name"=>$start_temp1,"value"=>$start_temp1.'-'.$start_temp,"bgcolor"=>$color,"confirm_col"=>$confirm_col,"button_id_unique"=>$button_id_unique);

		



						else if($num_rows>1){

						$color="#a70606";

						 $arr[]=array("flag"=>"1","button_name"=>"Booked","value"=>$start_temp1.'-'.$start_temp,"bgcolor"=>$color,"button_id_unique"=>$button_id_unique);



						}



				}





				//else if($num_rows>4 and $num_rows<=11) $arr[]=array("flag"=>"2","button_name"=>"$start_temp1 <BR /> Almost Full","value"=>$start_temp1.'-'.$start_temp);



				//else $arr[]=array("flag"=>"3","button_name"=>"Booked","value"=>$start_temp1.'-'.$start_temp);



				



				$k++;



				//*************change by Chandrachur



				$i++;



				//print_r($arr);



				//die();



			}



			}



			$arr[]=array("counter"=>$k);



		



		}



		



		



		echo json_encode($arr);



	



	}



	



	function get_doctor_list($doc_flag){		



		global $conn;
		
		// OR `users`.`role`='4' 

		if($_SESSION['choose_doctors']!='0'){

			 $sql="SELECT `user_infos`.`name`,`users`.`id` FROM `users` INNER JOIN `user_infos` ON `users`.`id`=`user_infos`.`users_id` WHERE `users`.`role`='5' AND `users`.`inactive_status`='0' AND `users`.`choose_doctors`='".$_SESSION['choose_doctors']."' ORDER BY `user_infos`.`name`";

			 

		 }else{

			 $sql="SELECT `user_infos`.`name`,`users`.`id` FROM `users` INNER JOIN `user_infos` ON `users`.`id`=`user_infos`.`users_id` WHERE `users`.`role`='5' AND `users`.`inactive_status`='0' ORDER BY `user_infos`.`name`";

			 

		 }

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);



		$arr=array();



		while($row=mysqli_fetch_assoc($result)){



			extract($row);	



			$arr[]=array("value"=>$id,"text"=> ucwords($name));



		}



		//$arr[]=array("value"=>$id,"text"=> $sql);



		echo json_encode($arr);



	}



	function insert_patient_info($flag=1){	



		global $conn;

		

		$fname_text=mysqli_real_escape_string($conn,$_REQUEST['fname']);
		$fname = ucwords(strtolower($fname_text));

		$email=mysqli_real_escape_string($conn,$_REQUEST['email']);

		$phone_no=mysqli_real_escape_string($conn,$_REQUEST['phone_no']);



		$doc_id=$_POST["doc_id"];

		$doc_name=mysqli_real_escape_string($conn,$_REQUEST['doc_name']);



		$branches_id=$_POST["branches_id"];



		$procedure_id=$_POST["procedure_id"];



		$selected_date=$_POST["selected_date"];



		$selected_time=$_POST["selected_time"];

		

		$description=mysqli_real_escape_string($conn,$_REQUEST['description']);



		$old_db_id=mysqli_real_escape_string($conn,$_REQUEST['old_db_id']);



		$online=(isset($_POST["online"])) ? "online" : "offline";



		$branches_name=$_POST["branches_name"];



		$user_id=(isset($_POST["user_id"])) ? $_POST["user_id"] : "40" ;



		$start_time_temp=explode("-",$selected_time);



		$start_time=date("Y-m-d H:i:s",strtotime($selected_date." ".$start_time_temp[0]));



		$end_time=date("Y-m-d H:i:s",strtotime($selected_date." ".$start_time_temp[1]));



		

		$mrd_no=mysqli_real_escape_string($conn,$_REQUEST['mrd_no']);

		$created_on=date('Y-m-d H:i:s');

		$created_by=$_SESSION['id'];



		if($mrd_no==''){

			$generate_uhid_flag=0;

		}else{

			$generate_uhid_flag=1;

		}
		
		
		$age=mysqli_real_escape_string($conn,$_REQUEST['age']);
		$gender=mysqli_real_escape_string($conn,$_REQUEST['gender']);
		$ref_doctor_id=mysqli_real_escape_string($conn,$_REQUEST['ref_doctor_id']);
		if($_REQUEST['dob']==''){
			$dob='NULL';
		}else{
			$dob= "'".date("Y-m-d", strtotime($_REQUEST['dob']))."'";

		}

		if($procedure_id!=''){



			



		$sql7="select count(`id`) AS `total_schedule` from `opd_schedules_for_appt` where `branches_id`= '".$branches_id."' AND `start_time`= '".$start_time."' AND `users_id`= '".$doc_id."' AND `opd_procedures_id`= '".$procedure_id."'";



		$result7=mysqli_query($conn,$sql7) or die(mysqli_error($conn).$sql7);



		$count=$result7->num_rows;



		$row7 = $result7->fetch_assoc();



		if($row7['total_schedule']<'6'){ //New Animesh



		



		$tans_sql="SET autocommit = 0;";



		mysqli_query($conn,$tans_sql);	



		$tans_sql="START TRANSACTION;";



		mysqli_query($conn,$tans_sql);

		

		$sql="INSERT INTO `patient_infos_for_appt` SET `name`='".$fname."', `email_id`='".$email."', `phone_no`='".$phone_no."', `patient_type`='1' , `status`='1' , `branches_id`='".$branches_id."', `mrdno`='".$mrd_no."' , `created_by`='".$created_by."', `created_on`='".$created_on."', `age`='".$age."', `gender`='".$gender."',`dob`=".$dob." ";



		$arr[]=array("flag"=>0);



		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);



		$id=mysqli_insert_id($conn);

	

		

		$sql="INSERT INTO `opd_schedules_for_appt` SET `mrd_no`='".$mrd_no."', `patient_infos_id`='".$id."', `start_time`='".$start_time."' , `end_time`='".$end_time."', `branches_id`='".$branches_id."' , `users_id`='".$doc_id."', `opd_procedures_id`='".$procedure_id."' , `scheduled_type`='".$flag."' , `description`='".$description."' , `admin_user_id`='".$user_id."', `created_by`='".$created_by."', `created_on`='".$created_on."', `generate_uhid_flag`='".$generate_uhid_flag."' , `old_db_id`='".$old_db_id."' , `ref_doctor_id`='".$ref_doctor_id."' ";



		unset($arr);



		$arr[]=array("flag"=>0);



		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);		



		if($result){



			$tans_sql="COMMIT;";



			mysqli_query($conn,$tans_sql);



		}		



		

		/*



		 $isd_code='91';		

		$sms_from='TRNETR';

		$mobile=$isd_code.$phone_no;



		$sms_body="Dear $fname, Your appointment has been scheduled with $doc_name, on $selected_date at ".date("H:i:s",strtotime($start_time))." at Trenetralaya, Kolkata. A thorough checkup may take approximately 2 hours from your appointment time. Sincere regards , Team Trenetralaya";





		 $smsStatus=sendSms($sms_body,$sms_from,$mobile);



		if($smsStatus!=0){



			$sqlSms="insert into `sms_logs`(`name`,`phone_no`,`sms_type`,`sms_status`,`created`,`doctors_name`) values('".$fname."','".$mobile."','1','".$smsStatus."','".date("Y-m-d H:i:s")."','".$doc_id."')";



			$resSms=mysqli_query($conn,$sqlSms);



			if($resSms){



			$tans_sql="COMMIT;";



			mysqli_query($conn,$tans_sql);



			}



		}*/





			unset($arr);



		$arr=array("flag"=>1);



		echo json_encode($arr);



		}



		}else{



			



			



				unset($arr);



		$arr=array("flag"=>2);



		echo json_encode($arr);



			}



	}



	



	

	

	function edit_details_for_branch(){



		



		global $conn;

		$edit_id=$_REQUEST['edit_id'];



		$sql="select `branches_id`, `branch_name`, `address` from `branches_for_appt` where `branches_id`='".$edit_id."'";



		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));



		$arr=array();



		while($row=mysqli_fetch_assoc($result)){



			



			extract($row);	



			$arr=array("branches_id"=>$branches_id,"branch_name"=>$branch_name,"address"=>$address);



		



		}



		



		echo json_encode($arr);



	



	



	}

	

	function edit_details_for_procedure(){



		



		global $conn;

		$edit_id=$_REQUEST['edit_id'];



		$sql="SELECT `id`, `dr_user_id`, `procedure_name`, `time` from `opd_procedures_for_appt` where `id`='".$edit_id."'";



		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));



		$arr=array();



		while($row=mysqli_fetch_assoc($result)){



			



			extract($row);	

			$new_time=($time+1);

			$arr=array("proc_insert_id"=>$id,"dr_user_id"=>$dr_user_id,"procedure_name"=>$procedure_name,"time"=>$new_time);



		



		}



		



		echo json_encode($arr);



	



	



	}



	



	function get_branch_list(){



		



		global $conn;



		$sql="select branches_id,branch_name from branches_for_appt WHERE `del_flag`='0'";



		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));



		$arr=array();



		while($row=mysqli_fetch_assoc($result)){



			



			extract($row);	



			$arr[]=array("value"=>$branches_id,"text"=>$branch_name);



		



		}



		



		echo json_encode($arr);



	



	



	}



	



function load_reffer_procedures(){



		



		global $conn;



		$sql="select `id`, `name` from `reffer_procedures`";



		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));



		$arr=array();



		while($row=mysqli_fetch_assoc($result)){



			



			extract($row);	



			$arr[]=array("value"=>$name,"text"=>$name);



		



		}



		



		echo json_encode($arr);



	



	



	}



function get_patient_shed(){



		global $conn;



		



		$dr_id=$_POST["doc_id"];



		//$branches_id=$_POST["branches_id"];



		$toddate=$_POST["selected_date"];



		$branch_id=$_POST["branch_id"];



		//$selected_time=$_POST["selected_time"];



		//$start_time_temp=explode("-",$selected_time);



		//$start_time=date("Y-m-d H:i:s",strtotime($toddate." ".$start_time_temp[0]));



		//$end_time=date("Y-m-d H:i:s",strtotime($toddate." ".$start_time_temp[1]));



?>

<div class="col-md-12">
  <?php



			 



			 $sqls1=mysqli_query($conn,"SELECT `opd_schedules_for_appt`.*,users.username FROM `opd_schedules_for_appt` left join users on users.id=opd_schedules_for_appt.admin_user_id WHERE `users_id`='".$dr_id."' AND `delete_flag`<>'1' and DATE(start_time) between '".$toddate."' and '".$toddate."' ");



	 	 $cont=mysqli_num_rows($sqls1);



			 



			 ?>
  <div class="col-md-12">
    <div class="panel panel-default" style="overflow:hidden;">
      <div class="panel-heading">
        <h3 class="panel-title"><b><?php echo $toddate; ?> Schedule Patient Information </b>(<?php echo $cont; ?>)</h3>
      </div>
      <div class="panel-body" style="max-height:369px; overflow:auto;">
        <table cellpadding="0" border="2" cellspacing="0" align="center" width="100%" style="text-align:center; vertical-align:middle; background:#f5f5f5; font-size:8pt; font-family:Arial, Helvetica, sans-serif; margin:0 0 19px 0">
          <tr style="text-align:center; background:#285883; color:#ffffff; border-left:1px dotted #c1c1c1;">
            <td>SL NO</td>
            <td>Name</td>
            <td>Phone No</td>
            <td>Location</td>
            <td>Start Time</td>
            <td>Notes</td>
            <td>STATUS</td>
            <td>TYPE</td>
            <td>Username</td>
            <td>ACTION</td>
          </tr>
          <?php



				$sl=1;



				 while($fethsql=mysqli_fetch_assoc($sqls1)){ ?>
          <?php



				$pa_info = mysqli_query($conn,"SELECT * FROM `patient_infos_for_appt` WHERE `id` = '".$fethsql['patient_infos_id']."' ");



				$fetpat = mysqli_fetch_assoc($pa_info);



				$opd_sc_table=mysqli_query($conn,"SELECT * FROM `branches_for_appt` WHERE `branches_id` = '".$fethsql['branches_id']."' ");



				$fetch_opd_sc_table=mysqli_fetch_assoc($opd_sc_table);



				?>
          <tr style="text-align:center; border-left:1px dotted #c1c1c1;">
            <td><?php echo $sl; $sl++ ?></td>
            <td><?php echo $fetpat['name']; ?></td>
            <td><?php echo $fetpat['phone_no']; ?></td>
            <td><?php echo $fetch_opd_sc_table['branch_name']; ?></td>
            <td><?php echo date("d-m-Y h:i A", strtotime($fethsql['start_time'])); ?></td>
            <td><?php echo $fethsql['description'];?>
            <td><?php echo $fethsql['mrd_no']; ?></td>
            <td><?php if($fethsql['scheduled_type']=='1'){ echo 'OPD';}if($fethsql['scheduled_type']=='2'){ echo 'OT';} ?></td>
            <td><?php echo $fethsql['username']; ?></td>
            <td><?php if($fethsql['visit_flag']==0) echo "<a onclick='if(confirm(\"Are you sure you want to delete the patient?\")) { delval(\"".encode($fethsql['id'])."\"); }' href='javascript:void(0)'><span class='glyphicon glyphicon-trash'></span>"; ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>
<?php



}



function encode( $str )



		{



			$str=convert_uuencode($str);



			$str=bin2hex($str);	



			$str=addcslashes($str,'a..z');



			$str=base64_encode($str);



			return $str;



		}

/*

function sendSms($message_p,$sms_from_p,$mobile_p)



{



	$seq=substr(str_shuffle(rand().time()),0,6);



	$returnVal=0;	



	$patterns = array();



	$patterns[0] = '/\"/';



	$patterns[1] = '/\r\n/';



	$patterns[2] = '/>/';



	$patterns[3] = '/</';



	$replacements = array();



	$replacements[0] = '&quot;';



	$replacements[1] = '&#013;';



	$replacements[2] = '&gt;';



	$replacements[3] = '&lt;';



	$message_p=stripslashes($message_p);



	$message_p=preg_replace($patterns,$replacements,$message_p);	



	$message_p=urlencode($message_p);		



	//$sms_from="BBEVIP";



	$profile_id="1201159628110577697";



	//$sender_id="BBEVIP";



	$api_key="3a23945e2e877a2e155ba0dca8efa116";



				 



	$curl=curl_init();



		 



	curl_setopt_array($curl, array(



		 CURLOPT_URL => "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=$api_key&message=$message_p&senderId=$sms_from_p&routeId=1&mobileNos=$mobile_p&smsContentType=english",



		 CURLOPT_RETURNTRANSFER => true,



		 CURLOPT_ENCODING => "",



		 CURLOPT_MAXREDIRS => 10,



		 CURLOPT_TIMEOUT => 30,



		 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,



		 CURLOPT_CUSTOMREQUEST => "GET",



		 CURLOPT_HTTPHEADER => array(



			"Cache-Control: no-cache"



		 ),



		));



		



		$response = curl_exec($curl);



		$err = curl_error($curl);



		



		//echo($response);



		//echo $err;



		$res=json_decode($response);



		



		curl_close($curl);



		



		$file = fopen("smsLog.txt","a");



		fwrite($file,$message_p."\n\n".$res->responseCode."\n".$res->response."\n"."http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=$api_key&message=$message_p&senderId=$sms_from_p&routeId=1&mobileNos=$mobile_p&smsContentType=english");



		fclose($file);



		



		if ($err) {



		 //echo "cURL Error #:" . $err;



		} else {



		 //echo "Response Code:".$res->responseCode;



		 //echo "Response:".$res->response;



		 if($res->responseCode=="3001") $returnVal=1;



		 



		}



		



		return $returnVal;	



}*/



///============== End SMS ============================







function save_branch(){



	global $conn;



	



	//print_r($_POST);



	$branchname=mysqli_real_escape_string($conn,$_REQUEST['branchname']);



	$address=mysqli_real_escape_string($conn,$_REQUEST['address']);

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	$branches_id=$_POST['branches_id'];

	

	if($branches_id==''){

	$sql="INSERT INTO `branches_for_appt` SET `branch_name`='".$branchname."', `address`='".$address."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

	}else{

		$sql="UPDATE  `branches_for_appt` SET `branch_name`='".$branchname."', `address`='".$address."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `branches_id`='".$branches_id."'  ";

	}

	



	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



	



	if($res){



		



		$arr=array("flag"=>"1");



	



	}



	else $arr=array("flag"=>"0");



	



	echo json_encode($arr);



}



function save_proc(){



	global $conn;

	$doctors=mysqli_real_escape_string($conn,$_REQUEST['doctors']);

	$procname=mysqli_real_escape_string($conn,$_REQUEST['procname']);

	$proc_type=mysqli_real_escape_string($conn,$_REQUEST['proc_type']);

	$duration_old=mysqli_real_escape_string($conn,$_REQUEST['duration']);

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	$proc_insert_id=$_POST['proc_insert_id'];

	$duration=$duration_old-1;

	

	if($proc_insert_id==''){

	$sql="INSERT INTO `opd_procedures_for_appt` SET `dr_user_id`='".$doctors."', `procedure_name`='".$procname."', `time`='".$duration."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

	}else{

		$sql="UPDATE  `opd_procedures_for_appt` SET `dr_user_id`='".$doctors."', `procedure_name`='".$procname."', `time`='".$duration."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$proc_insert_id."'  ";

	}



	



	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



	



	if($res){



		



		$arr=array("flag"=>"1");



	



	}



	else $arr=array("flag"=>"0");



	



	echo json_encode($arr);



}



function load_availability(){



	global $conn;



	$choose_doctors=(isset($_REQUEST["choose_doctors"])) ? $_REQUEST["choose_doctors"] : $_SESSION['choose_doctors'];



	$date1=date_create($_POST["start"]);



	$date2=date_create($_POST["end"]);



	$diff=date_diff($date1,$date2);



	//echo "Months::".$months=$diff->format('%m');



	/*$date_val=intval(date("m",strtotime($_POST["start"])));



	$date_val=($date_val == 12 ) ? 1 : intval($date_val)+1;



	$date_val=(intval(date("d",strtotime($_POST["start"]))) == 1) ? intval($date_val)-1 : $date_val;*/



	//$date_val=date("m",strtotime("+1 months",strtotime($_GET["start"])));



	//else $date_val=date("m",strtotime($_POST["start"]));



	//$date_val=(isset($_POST["start_date"])) ? date("m",strtotime($_POST["date_val"])) : date("m");
	
	$date_val=intval(date("m",strtotime($_REQUEST["start"])));
	 $date_val_end=intval(date("m",strtotime($_REQUEST["end"])));

	
	if(($date_val!=12)&&($date_val!=6)){
		 $date_val= intval($date_val)+1 ;
	}else{
		if($date_val==12){
		if($date_val_end=='01'){
			 $date_val= 12 ;
		}else{
			 $date_val= '01' ;
		}
		}
		if($date_val=='06'){
			if($date_val_end=='07'){
				 $date_val= '06' ;
			}else{
				 $date_val= '07' ;
			}
		}
	}


	$default_doctor=1;

	$sql7="SELECT `id` FROM `users` WHERE `role`='5' OR `users`.`role`='4' AND `inactive_status`='0' ";

	$result7=mysqli_query($conn,$sql7) or die(mysqli_error($conn).$sql7);

	$count=$result7->num_rows;

	$row7 = $result7->fetch_assoc();

	if($count>0){

	$default_doctor=$row7['id'];

	}

	if($choose_doctors!=''){



	$sql="SELECT `id`, `dr_user_id`,`user_infos`.name as `doctor_name`,`visiting_day`, `visiting_starttime`, `visiting_endtime`, `schedule_type`, doctors_availabilitiys_for_appt.`status`,`branch_name`	 FROM `doctors_availabilitiys_for_appt` INNER JOIN branches_for_appt on doctors_availabilitiys_for_appt.branches_id=branches_for_appt.branches_id inner join user_infos on doctors_availabilitiys_for_appt.dr_user_id = user_infos.users_id WHERE MONTH(`visiting_day`)='".$date_val."' AND `user_infos`.`users_id`='".$choose_doctors."'";



	}



	if($choose_doctors=='0'){



		$sql="SELECT `id`, `dr_user_id`,`user_infos`.name as `doctor_name`,`visiting_day`, `visiting_starttime`, `visiting_endtime`, `schedule_type`, doctors_availabilitiys_for_appt.`status`,`branch_name`	 FROM `doctors_availabilitiys_for_appt` INNER JOIN branches_for_appt on doctors_availabilitiys_for_appt.branches_id=branches_for_appt.branches_id inner join user_infos on doctors_availabilitiys_for_appt.dr_user_id = user_infos.users_id WHERE MONTH(`visiting_day`)='".$date_val."' AND `user_infos`.`users_id`='".$default_doctor."'";



		}



	//echo $sql;

	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



	while($row=mysqli_fetch_assoc($res)){

	extract($row);	



	$arr[]=array('id'=>$id,'title'=>utf8_encode("<div style='padding:0px;width:100%;float:left;background:#1351bb'>$doctor_name <br/> $branch_name <a href='#' style='white-space: nowrap;' target='_blank'></a></div><div style='background-color:#1351bb;color:$color_code;padding:2px;float:left;width:100%;white-space: nowrap;'><b>$visiting_starttime - $visiting_endtime</b> <div style='float:right'><span class='glyphicon glyphicon-edit'></span></div></div>"),'start'=>$visiting_day,'end'=>$visiting_day,'backgroundColor'=>'#1351bb','textColor'=>'#ffffff');

	}



	echo json_encode($arr);



}



function save_availability(){



	global $conn;



	



	$dtval=$_POST['dtval'];



	$doctors=$_POST['doctor'];



	$branches=$_POST['branches'];



	$weekdays=$_POST['weekdays'];



	$input_starttime=$_POST['input_starttime'];



	$etime=$_POST['etime'];



	$schedule_type=$_POST['schedule_type'];



	$patient_limit=$_POST['patient_limit'];



	$destination_month=$_POST['destination_month'];



	$destination_year=$_POST['destination_year'];



	$doctors_only=$_POST['doctors_only'];

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	



	//$weekdays_arr=explode(',',$weekdays);



	



	//print_r($weekdays);



		



	foreach($weekdays as $key => $val){



	//echo $val."\n";



	//getDateForSpecificDayBetweenDates();



	$year=$destination_year;



	$target_month=$destination_month;



	$dtval.":".$year."-".$target_month."-31".":".$val."\n";



	$dateArr=getDateForSpecificDayBetweenDates($dtval, $year.'-'.$target_month.'-31', $val);



	//print_r($dateArr);



	foreach($dateArr as $key1 => $val1){



			

		$sql="INSERT INTO `doctors_availabilitiys_for_appt` SET `dr_user_id`='".$doctors."', `visiting_day`='".$val1."', `visiting_starttime`='".date("H:i",strtotime($input_starttime[$key]))."', `visiting_endtime`='".date("H:i",strtotime($etime[$key]))."' , `branches_id`='".$branches."', `schedule_type`='".$schedule_type."', `patient_limit`='".$patient_limit."', `destination_month`='".$destination_month."', `doctors_only`='".$doctors_only."' , `created_by`='".$created_by."', `created_on`='".$created_on."' ";



		



		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



		



		if($res) $arr=array("flag"=>1);



		else $arr=array("flag"=>0);



		



		}



	}



	



	echo json_encode($arr);



}



function getDateForSpecificDayBetweenDates($startDate, $endDate, $weekdayNumber)



{



	//echo $endDate."\n";



 $startDate = strtotime($startDate);



 $endDate = strtotime($endDate);



//echo date('Y-m-d', $endDate)."\n";



 $dateArr = array();



 do



 {



 if(date("w", $startDate) != $weekdayNumber)



 {



 $startDate += (24 * 3600); // add 1 day



 }



 } while(date("w", $startDate) != $weekdayNumber);



	



 while($startDate <= $endDate)



 {



 $dateArr[] = date('Y-m-d', $startDate);



 $startDate += (7 * 24 * 3600); // add 7 days



		//echo "Start Date::".date('Y-m-d', $startDate)."\n";



 }



 return($dateArr);



}



function booked_patients(){



	



	global $conn;



	



		/*



	 * Script: DataTables server-side script for PHP and MySQL



	 * Copyright: 2010 - Allan Jardine



	 * License: GPL v2 or BSD (3-point)



	 */



	



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *



	 * Easy set variables



	 */



	



	/* Array of database columns which should be read and sent back to DataTables. Use a space where



	 * you want to insert a non-database field (for example a counter or static image)



	 */



	$aColumns = array('opd_schedules_for_appt.del_flag','opd_schedules_for_appt.mrd_no', 'patient_infos_for_appt.name', 'patient_infos_for_appt.phone_no', 'patient_infos_for_appt.age', 'date(start_time) as appt_date', 'start_time', 'user_infos.name as doctor_name', '`opd_procedures_for_appt`.procedure_name','(select user_infos.name from user_infos where user_infos.users_id=opd_schedules_for_appt.admin_user_id) as admin_user','opd_schedules_for_appt.description','opd_schedules_for_appt.id','opd_schedules_for_appt.patient_infos_id','patient_infos_for_appt.created_by','patient_infos_for_appt.created_on','patient_infos_for_appt.modified_by','patient_infos_for_appt.modified_time', 'patient_infos_for_appt.email_id','opd_schedules_for_appt.generate_uhid_flag', 'patient_infos_for_appt.gender');



	



	/* Indexed column (used for fast and accurate table cardinality) */



	$sIndexColumn = "opd_schedules_for_appt.id";



	



	/* DB table to use */



	$sTable = "opd_schedules_for_appt";



	



	



	



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *



	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is



	 * no need to edit below this line



	 */



	



	



	/*



	 * Paging



	 */



	$sLimit = "";



	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )



	{



		$sLimit = "LIMIT ".mysqli_real_escape_string($conn, $_GET['iDisplayStart'] ).", ".



			mysqli_real_escape_string($conn, $_GET['iDisplayLength'] );



	}






	$sWhere = "";



	if ( $_GET['sSearch'] != "" )



	{



		$sWhere = "WHERE (";



		for ( $i=0 ; $i<count($aColumns) ; $i++ )



		{



			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn, $_GET['sSearch'] )."%' OR ";



		}



		$sWhere = substr_replace( $sWhere, "", -3 );



		$sWhere .= ')';



	}



	



	/* Individual column filtering */



	for ( $i=0 ; $i<count($aColumns) ; $i++ )



	{



	 if(isset($_GET['bSearchable_'.$i])){



		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )



		{



			if ( $sWhere == "" )



			{



				$sWhere = "WHERE ";



			}



			else



			{



				$sWhere .= " AND ";



			}



			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn,$_GET['sSearch_'.$i])."%' ";



		}



	 }	



	}



	




	



	if ( $sWhere == "" )



 {



		 $sWhere .= ($_GET["schedule_type"]!="") ? " WHERE scheduled_type = '".mysqli_real_escape_string($conn,$_GET["schedule_type"])."'" : "";



		



	}else{



		



		$sWhere .= ($_GET["schedule_type"]!="") ? " and scheduled_type = '".mysqli_real_escape_string($conn,$_GET["schedule_type"])."'" : "";



		



	}



	



	//echo "Where::".$sWhere;



	

	$date_empty_flag=0;

	if($_GET["from_date"]!=""){
	 $from_date_chnage=$_GET["from_date"];
	 $from_date=date("Y-m-d",strtotime($from_date_chnage));
	 $date_empty_flag=1;
	}else{

		$from_date="";
		$date_empty_flag=0;
	}

	if($_GET["to_date"]!=""){
	 $to_date_chnage=$_GET["to_date"];
	 $to_date=date("Y-m-d",strtotime($to_date_chnage));
	 $date_empty_flag=1;
	}else{

		$to_date="";
		$date_empty_flag=0;
	}
	
	

	if($_GET["branches_list"]!=""){
	 $branch_id=$_GET['branches_list'];
	}else{
		$branch_id=1;
	}
	
	$doctors_list="";
	if($_GET["doctors_list"]!=""){
	 $doctors_list=$_GET['doctors_list'];
	}
	
	if($_GET["patient_name_search"]!=""){
	 $patient_name_search=$_GET['patient_name_search'];
	 $sWhere.= " and patient_infos_for_appt.name like '%".$patient_name_search."%' ";
	}else{
		$sWhere.= " ";
	}
	
	if($_GET["patient_uhid_search"]!=""){
	 $patient_uhid_search=$_GET['patient_uhid_search'];
	 $sWhere.= " and patient_infos_for_appt.mrdno = '".$patient_uhid_search."' ";
	}else{
		$sWhere.= " ";
	}
	
	if($_GET["patient_ph_search"]!=""){
	 $patient_ph_search=$_GET['patient_ph_search'];
	 $sWhere.= " and patient_infos_for_appt.phone_no = '".$patient_ph_search."' ";
	}else{
		$sWhere.= " ";
	}
	
	if($date_empty_flag=="1"){
	 $sWhere.= " and (DATE(start_time) between '".$from_date."' and '".$to_date."') ";
	}else{
		$sWhere.= " ";
	}


	if ( $sWhere == "" )
	 {

		 if($doctors_list!=""){
			$sWhere .=  " AND  ".$sTable.".branches_id='".$branch_id."' and ".$sTable.".users_id='".$doctors_list."' ".$where_info." " ;
		
		}else{
			$sWhere .=  " AND  ".$sTable.".branches_id='".$branch_id."' ".$where_info."   " ;
			
		}
	}else{

		if($doctors_list!=""){
			$sWhere .=  " AND ".$sTable.".branches_id='".$branch_id."' and ".$sTable.".users_id='".$doctors_list."' ".$where_info." " ;
		
		}else{
			$sWhere .=  " AND  ".$sTable.".branches_id='".$branch_id."' ".$where_info." " ;
			
		}
	}

	if ( $sWhere == "" )
 	{
		 $sOrder .= "  ORDER BY `user_infos`.`name` ASC ,`opd_schedules_for_appt`.`start_time` ASC, `patient_infos_for_appt`.`name` ASC ";
	}else{
		$sOrder .= "  ORDER BY `user_infos`.`name` ASC, `opd_schedules_for_appt`.`start_time` ASC , `patient_infos_for_appt`.`name` ASC";

	}


//user_infos.name
	


	



	/*



	 * SQL queries



	 * Get data to display



	 */



	if($_SESSION['choose_doctors']=='0'){



	$sQuery = "



		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."



		FROM $sTable left join opd_procedures_for_appt on ".$sTable.".opd_procedures_id=opd_procedures_for_appt.id  left join user_infos on ".$sTable.".users_id=user_infos.users_id left join patient_infos_for_appt on ".$sTable.".patient_infos_id=patient_infos_for_appt.id left join branches_for_appt on branches_for_appt.branches_id=".$sTable.".branches_id



		$sWhere 



		$sOrder



		$sLimit



	";}
	//  $swhere er por AND ".$sTable.".generate_uhid_flag=0

	else{



		$sQuery = "



		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."



		FROM $sTable left join opd_procedures_for_appt on ".$sTable.".opd_procedures_id=opd_procedures_for_appt.id  left join user_infos on ".$sTable.".users_id=user_infos.users_id left join patient_infos_for_appt on ".$sTable.".patient_infos_id=patient_infos_for_appt.id left join branches_for_appt on branches_for_appt.branches_id=".$sTable.".branches_id



		$sWhere AND ".$sTable.".users_id=".$_SESSION['choose_doctors']." 



		$sOrder



		$sLimit



	";

	}



	



	 //echo $sQuery;
	
	



	$sql="set time_zone='+5:30'";



	$res=$conn->query($sql);



	



	$rResult = mysqli_query( $conn,$sQuery) or die(error_log(mysqli_error($conn)));



	



	/* Data set length after filtering */



	$sQuery = "



		SELECT FOUND_ROWS()



	";



	$rResultFilterTotal = mysqli_query($conn, $sQuery) or die(mysqli_error($conn));



	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);



	$iFilteredTotal = $aResultFilterTotal[0];



	



	/* Total data set length */



	$sQuery = "



		SELECT COUNT(".$sIndexColumn.")



		FROM $sTable



	";



	$rResultTotal = mysqli_query( $conn,$sQuery) or die(mysqli_error());



	$aResultTotal = mysqli_fetch_array($rResultTotal);



	$iTotal = $aResultTotal[0];



	



	



	/*



	 * Output



	 */



	$output = array(



		"sEcho" => intval($_GET['sEcho']),



		"iTotalRecords" => $iTotal,



		"iTotalDisplayRecords" => $iFilteredTotal,



		"aaData" => array()



	);



	

	$sl=1;	

	while ( $aRow = mysqli_fetch_array( $rResult ) )



	{



		$row = array();



		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{

			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */



				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];

			}

			else if ( $aColumns[$i] == "opd_schedules_for_appt.del_flag" )

			{

				$row[] =$sl;

			}

			else if ( $aColumns[$i] == "opd_schedules_for_appt.mrd_no" )
			{

				$row[] =$aRow['mrd_no'];

			}else if ( $aColumns[$i] == "patient_infos_for_appt.name" )
			{
				$row[] =$aRow['name'];

			}else if ( $aColumns[$i] == "patient_infos_for_appt.phone_no" )
			{
				$email_id_rows="";

				if($aRow['email_id']!=''){

					$email_id_rows=	'<br> Email ID: '.$aRow['email_id'];

				}

				$row[] =$aRow['phone_no'].$email_id_rows;
				
			}
			else if ( $aColumns[$i] == "patient_infos_for_appt.age" )
			{
				$gender_rows="";

				if($aRow['gender']=='1'){
					$gender_rows=' /M';
				}
				if($aRow['gender']=='2'){
					$gender_rows=' /F';
				}
				if($aRow['gender']=='3'){
					$gender_rows=' /O';
				}

				$row[] =$aRow['age'].$gender_rows;
			}
			
			else if ( $aColumns[$i] == "date(start_time) as appt_date" )
			{


				$row[] =date("d-m-y",strtotime($aRow['start_time']));


			}
			else if ( $aColumns[$i] == "start_time" )
			{


				$row[] =date("h:i A",strtotime($aRow['start_time']));


			}
			else if ( $aColumns[$i] == "user_infos.name as doctor_name" )
			{

				$row[] =$aRow['doctor_name'];

			}else if ( $aColumns[$i] == "`opd_procedures_for_appt`.procedure_name" )
			{
				$row[] =$aRow['procedure_name'];

			}else if ( $aColumns[$i] == "(select user_infos.name from user_infos where user_infos.users_id=opd_schedules_for_appt.admin_user_id) as admin_user" )
			{				

				$modifies_rows_new="";

				if($aRow['created_by']!='0'){

					 $sql8="SELECT `username` FROM `users` Where `id`='".$aRow['created_by']."'";

					 $result8=$conn->query($sql8) ;				

					 $row8 = $result8->fetch_assoc();

					 $count8=$result8->num_rows;

					 if($count8>0)

					 {

						

					 	$created_by=$row8['username'];

					 }

					// $modifies_rows_new='Created By: '.$created_by.'<br>'.'Created On: '.date("d-m-Y", strtotime($aRow['created_on'])).'<br/>'.date("h:i A", strtotime($aRow['created_on']));
					$modifies_rows_new=$created_by;
				}

				$modifies_rows="";

				/*if($aRow['modified_by']!='0'){

					$sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$aRow['modified_by']."'";

					 $result8=$conn->query($sql8) ;				

					 $row8 = $result8->fetch_assoc();

					 $count8=$result8->num_rows;

					 if($count8>0)

					 {

					 	$modified_by=$row8['name'];

					 }

					 $modifies_rows='<br/>Modified By: '.$modified_by.'<br>'.'Modified On: '.date("d-m-Y h:i A", strtotime($aRow['modified_time']));

				}*/

				$row[] =$modifies_rows_new.$modifies_rows;			

				//$row[] =$aRow['admin_user'];
			}else if ( $aColumns[$i] == "opd_schedules_for_appt.description" )
			{

				$row[] =$aRow['description'];

			}
			else if ( $aColumns[$i] == "opd_schedules_for_appt.id" )
			{			

				if($aRow['generate_uhid_flag']=='0'){		

				//$row[] ="<a href='javascript:void(0);' onclick='edit_infos(".$aRow['patient_infos_id'].")'><span class='glyphicon glyphicon-edit'></span></a> | <a href='javascript:void(0);' onclick='ask_pw(".$aRow['id'].")'><span class='glyphicon glyphicon-trash'></span></a>";
				$action_tab7="";
				if($_SESSION['emr_pres_master_add_flag']=='1'){
					$action_tab7="| <a href='javascript:void(0);' onclick='delete_val(".$aRow['id'].")'><span class='glyphicon glyphicon-trash'></span></a>";
				}
				$row[] ="<a href='javascript:void(0);' onclick='special_edit_infos(".$aRow['patient_infos_id'].",".$aRow['id'].")'><span class='glyphicon glyphicon-edit'></span></a> $action_tab7";

				}else{

					//$row[] ="";
					$action_tab7="";
				if($_SESSION['emr_pres_master_add_flag']=='1'){
					$action_tab7="| <a href='javascript:void(0);' onclick='delete_val(".$aRow['id'].")'><span class='glyphicon glyphicon-trash'></span></a>";
				}
				$row[] ="<a href='javascript:void(0);' onclick='special_edit_infos(".$aRow['patient_infos_id'].",".$aRow['id'].")'><span class='glyphicon glyphicon-edit'></span></a> $action_tab7";

				}



				



			}else if ( !($aColumns[$i] == ' '))
			{

				/* General output */

				$row[] = $aRow[ $aColumns[$i] ];
			}
		}

		$sl++;

		$output['aaData'][] = $row;
	}

	echo json_encode( $output );


}



function delete_schedule(){



	global $conn;
	


	$id=$_POST['id'];

	

	$sql_logs="select * from `opd_schedules_for_appt` where id='$id'";

	$res_logs=mysqli_query($conn,$sql_logs);

	$rows_logs=mysqli_fetch_assoc($res_logs) or die(mysqli_error($res_logs));
	
	$modified_time_appt='';
	if($rows_logs['modified_time']==''){
		$modified_time_appt='NULL';
	}else{
		$modified_time_appt= "'".$rows_logs['modified_time']."'";
	}
	
	$deleted_time_appt='';
	if($rows_logs['deleted_time']==''){
		$deleted_time_appt='NULL';
	}else{
		$deleted_time_appt= "'".$rows_logs['deleted_time']."'";
	}


	$delete_query_logs="INSERT INTO `opd_schedules_for_appt` SET `id`='".$rows_logs['id']."', `mrd_no`='".$rows_logs['mrd_no']."', `patient_infos_id`='".$rows_logs['patient_infos_id']."', `start_time`='".$rows_logs['start_time']."', `end_time`='".$rows_logs['end_time']."', `branches_id`='".$rows_logs['branches_id']."', `users_id`='".$rows_logs['users_id']."', `admin_user_id`='".$rows_logs['admin_user_id']."', `opd_procedures_id`='".$rows_logs['opd_procedures_id']."', `scheduled_type`='".$rows_logs['scheduled_type']."', `description`='".$rows_logs['description']."', `generate_uhid_flag`='".$rows_logs['generate_uhid_flag']."', `created_by`='".$rows_logs['created_by']."', `created_on`='".$rows_logs['created_on']."', `modified_by`='".$rows_logs['modified_by']."', `modified_time`=".$modified_time_appt.", `del_flag`='".$rows_logs['del_flag']."', `deleted_by`='".$rows_logs['deleted_by']."', `deleted_time`=".$deleted_time_appt.", `old_db_id`='".$rows_logs['old_db_id']."', `ref_doctor_id`='".$rows_logs['ref_doctor_id']."' ";

	$sql_logs_for_new_delete="INSERT INTO `opd_schedules_delete_for_appt` SET `id`='".$rows_logs['id']."', `mrd_no`='".$rows_logs['mrd_no']."', `patient_infos_id`='".$rows_logs['patient_infos_id']."', `start_time`='".$rows_logs['start_time']."', `end_time`='".$rows_logs['end_time']."', `branches_id`='".$rows_logs['branches_id']."', `users_id`='".$rows_logs['users_id']."', `admin_user_id`='".$rows_logs['admin_user_id']."', `opd_procedures_id`='".$rows_logs['opd_procedures_id']."', `scheduled_type`='".$rows_logs['scheduled_type']."', `description`='".$rows_logs['description']."', `generate_uhid_flag`='".$rows_logs['generate_uhid_flag']."', `created_by`='".$rows_logs['created_by']."', `created_on`='".$rows_logs['created_on']."', `modified_by`='".$rows_logs['modified_by']."', `modified_time`=".$modified_time_appt.", `del_flag`='".$rows_logs['del_flag']."', `deleted_by`='".$rows_logs['deleted_by']."', `deleted_time`=".$deleted_time_appt.", `old_db_id`='".$rows_logs['old_db_id']."', `ref_doctor_id`='".$rows_logs['ref_doctor_id']."'   ";

	$res_logs_for_new_delete=mysqli_query($conn,$sql_logs_for_new_delete);
	


	

	$sql_logs_patient_infos="select * from `patient_infos_for_appt` where id='".$rows_logs['patient_infos_id']."'";

	$res_logs_patient_infos=mysqli_query($conn,$sql_logs_patient_infos);

	$rows_logs_patient_infos=mysqli_fetch_assoc($res_logs_patient_infos) or die(mysqli_error($res_logs_patient_infos));
	
	
	$modified_time_patient='';
	if($rows_logs_patient_infos['modified_time']==''){
		$modified_time_patient='NULL';
	}else{
		$modified_time_patient= "'".$rows_logs_patient_infos['modified_time']."'";
	}
	
	$deleted_time_patient='';
	if($rows_logs_patient_infos['deleted_time']==''){
		$deleted_time_patient='NULL';
	}else{
		$deleted_time_patient= "'".$rows_logs_patient_infos['deleted_time']."'";
	}
	
	$dob_patient='';
	if($rows_logs_patient_infos['dob']==''){
		$dob_patient='NULL';
	}else{
		$dob_patient= "'".$rows_logs_patient_infos['dob']."'";
	}


	$delete_query_logs_patient_infos="INSERT INTO `patient_infos_for_appt` SET `id`='".$rows_logs_patient_infos['id']."', `branches_id`='".$rows_logs_patient_infos['branches_id']."', `mrdno`='".$rows_logs_patient_infos['mrdno']."', `name`='".$rows_logs_patient_infos['name']."', `phone_no`='".$rows_logs_patient_infos['phone_no']."', `email_id`='".$rows_logs_patient_infos['email_id']."', `patient_type`='".$rows_logs_patient_infos['patient_type']."', `status`='".$rows_logs_patient_infos['status']."', `created_by`='".$rows_logs_patient_infos['created_by']."', `created_on`='".$rows_logs_patient_infos['created_on']."', `modified_by`='".$rows_logs_patient_infos['modified_by']."', `modified_time`=".$modified_time_patient.", `del_flag`='".$rows_logs_patient_infos['del_flag']."', `deleted_by`='".$rows_logs_patient_infos['deleted_by']."', `deleted_time`=".$deleted_time_patient." , `created_userid`='".$rows_logs_patient_infos['created_userid']."', `age`='".$rows_logs_patient_infos['age']."', `gender`='".$rows_logs_patient_infos['gender']."', `dob`=".$dob_patient." ";

	
	$sql_logs_patient_for_new_delete="INSERT INTO `patient_infos_delete_for_appt` SET `id`='".$rows_logs_patient_infos['id']."', `branches_id`='".$rows_logs_patient_infos['branches_id']."', `mrdno`='".$rows_logs_patient_infos['mrdno']."', `name`='".$rows_logs_patient_infos['name']."', `phone_no`='".$rows_logs_patient_infos['phone_no']."', `email_id`='".$rows_logs_patient_infos['email_id']."', `patient_type`='".$rows_logs_patient_infos['patient_type']."', `status`='".$rows_logs_patient_infos['status']."', `created_by`='".$rows_logs_patient_infos['created_by']."', `created_on`='".$rows_logs_patient_infos['created_on']."', `modified_by`='".$rows_logs_patient_infos['modified_by']."', `modified_time`=".$modified_time_patient.", `del_flag`='".$rows_logs_patient_infos['del_flag']."', `deleted_by`='".$rows_logs_patient_infos['deleted_by']."', `deleted_time`=".$deleted_time_patient." , `created_userid`='".$rows_logs_patient_infos['created_userid']."', `age`='".$rows_logs_patient_infos['age']."', `gender`='".$rows_logs_patient_infos['gender']."', `dob`=".$dob_patient."  ";

	$res_logs_patient_for_new_delete=mysqli_query($conn,$sql_logs_patient_for_new_delete);	

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	$delete_query_logs_new=mysqli_real_escape_string($conn,$delete_query_logs);	

	$delete_query_logs_patient_infos_new=mysqli_real_escape_string($conn,$delete_query_logs_patient_infos);	

	$mode='DELETE';

	

	$sql_log="INSERT INTO `schedule_deletion_log_for_appt` SET `doctor_id`='".$rows_logs['users_id']."', `branch`='".$rows_logs['branches_id']."', `user_name`='".$_SESSION['username']."', `mode`='".$mode."',`main_table`='opd_schedules_for_appt', `unique_foreign_id`='".$rows_logs['patient_infos_id']."', `delete_query_logs`='".$delete_query_logs_new."', `created_by`='".$created_by."', `created_on`='".$created_on."'  ";

	$res_log=mysqli_query($conn,$sql_log);

	

	$sql_log_patient="INSERT INTO `schedule_deletion_log_for_appt` SET `doctor_id`='".$rows_logs['users_id']."', `branch`='".$rows_logs['branches_id']."', `user_name`='".$_SESSION['username']."', `mode`='".$mode."',`main_table`='patient_infos_for_appt', `unique_foreign_id`='".$rows_logs['patient_infos_id']."', `delete_query_logs`='".$delete_query_logs_patient_infos_new."', `created_by`='".$created_by."', `created_on`='".$created_on."'  ";

	$res_log_patient=mysqli_query($conn,$sql_log_patient);

	

	

	$sql="delete from `opd_schedules_for_appt` where id='".$id."'";



	$res=mysqli_query($conn,$sql);



	$sql="delete from `patient_infos_for_appt` where id='".$rows_logs['patient_infos_id']."'";



	$res=mysqli_query($conn,$sql);



	if($res){





	 $arr=array("flag"=>"1");



	



	 /*$isd_code='91';



	 if($branches_id=="10") $sms_from='BBEVIP';



	 else if($branches_id=="11") $sms_from='NETRLM';



	 else $sms_from='';



		$mobile=$isd_code.$phone_no;



//**********************************************************



	$sms_flag=$_POST['sms_flag'];



	



	 if($sms_flag==1){



	 	



		if($branches_id=="10"){



		



			$sms_body="Dear $fname, Your appointment has been cancelled with $doc_name, on ".date("d/m/y",strtotime($start_time))." at ".date("H:i:s",strtotime($start_time))." at $branches_name, Kolkata.";



			



		}else if($branches_id=="11"){



			



			$sms_body="Dear $fname, Your appointment has been cancelled with $doc_name, on ".date("d/m/y",strtotime($start_time))." at ".date("H:i:s",strtotime($start_time))." at $branches_name, Kolkata. With Regards Team Netralayam";



			



		}else $sms_body="";



		$smsStatus=sendSms($sms_body,$sms_from,$mobile);



		if($smsStatus!=0){



		



			$sqlSms="insert into `sms_logs`(`name`,`phone_no`,`sms_type`,`sms_status`,`created`,`doctors_name`) values('".$fname."','".$mobile."','1','".$smsStatus."','".date("Y-m-d H:i:s")."','".$doc_id."')";



			$resSms=mysqli_query($conn,$sqlSms);



			if($resSms){



			$tans_sql="COMMIT;";



			mysqli_query($conn,$tans_sql);



			}		



		}



	 }*/



//*********************************************************************



	}else $arr=array("flag"=>"0");



	echo json_encode($arr);



}



function load_offdays(){



	global $conn;



	$doctor=$_POST['doctor'];



	$date_val_start=(isset($_POST["start"])) ? date("Y-m-d",strtotime($_POST["start"])) : date("Y-m-d");



	$date_val_end=(isset($_POST["end"])) ? date("Y-m-d",strtotime($_POST["end"])) : date("Y-m-d");



	



	$sql="SELECT `id`, `dr_user_id`, `start_date`, `end_date`, `status`,`colour_code` FROM `dr_leaves_for_appt` WHERE `start_date`>='".$date_val_start."' and `end_date`<='".$date_val_end."' and dr_user_id='".$doctor."'";



	



	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



	



	while($row=mysqli_fetch_assoc($res)){



	



	extract($row);	



		

	$new_end_date=date("Y-m-d",strtotime('+1 days',strtotime($end_date))); 

	//if($schedule_type=="1"){	



	$arr[]=array('id'=>$id,'title'=>utf8_encode("<div style='padding:10px;width:100%;float:left;background-color:$colour_code;'>Off Day</div><div style='padding:0px;width:60px;float:right;'>Click to remove</div>"),'start'=>$start_date,'end'=>$new_end_date,'backgroundcolor'=>'$colour_code');



	



	//}



	//print_r($arr);



	



	}



	



	echo json_encode($arr);



}



function save_offdays(){



	global $conn;



	$doctor=$_POST['doctor'];

	$date_temp=(isset($_POST['date_range'])) ? $_POST['date_range'] : date("Y-m-d")."-".date("Y-m-d");



	$date_range=explode('-',$date_temp);

	$color=$_POST['color'];

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	

	$sql="INSERT INTO `dr_leaves_for_appt` SET `dr_user_id`='".$doctor."', `start_date`='".date("Y-m-d",strtotime($date_range[0]))."', `end_date`='".date("Y-m-d",strtotime($date_range[1]))."', `colour_code`='".$color."', `status`='1', `created_by`='".$created_by."', `created_on`='".$created_on."'  ";

	

	$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","error"=>mysqli_error($conn))));



	if($res) $arr=array("flag"=>"1");



	else $arr=array("flag"=>"0");



	echo json_encode($arr);



}



function delete_event(){



	global $conn;

	$id=$_POST["id"];



	$sql="delete from dr_leaves_for_appt where `id`='".$id."' ";



	$res=mysqli_query($conn,$sql);



	if($res) $arr=array("flag"=>1);



	else $arr=array("flag"=>0);



	echo json_encode($arr);



}



function load_holidays(){



	global $conn;



	$date_val_start=(isset($_POST["start"])) ? date("Y-m-d",strtotime($_POST["start"])) : date("Y-m-d");



	$date_val_end=(isset($_POST["end"])) ? date("Y-m-d",strtotime($_POST["end"])) : date("Y-m-d");



	$sql="SELECT `id`, 	holiday_date,holiday_reason FROM `holidays_for_appt` WHERE `holiday_date`>='".$date_val_start."' and `holiday_date`<='".$date_val_end."'";

	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

	while($row=mysqli_fetch_assoc($res)){

	extract($row);	

	//if($schedule_type=="1"){	



	$arr[]=array('id'=>$id,'title'=>utf8_encode("<div style='padding:0px;width:100%;float:left;'>$holiday_reason</div><div style='padding:0px;width:60px;float:right;'>Click to remove</div>"),'start'=>$holiday_date,'end'=>$holiday_date,'backgroundColor'=>'$colour_code');



	}



	echo json_encode($arr);



}



function save_holidays(){



	global $conn;



	$holiday_date=$_POST['holiday_date'];

	$holiday_reason=mysqli_real_escape_string($conn,$_REQUEST['holiday_reason']);

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	

	$sql="INSERT INTO `holidays_for_appt` SET `holiday_date`='".date("Y-m-d",strtotime($holiday_date))."', `holiday_reason`='".$holiday_reason."', `created_by`='".$created_by."', `created_on`='".$created_on."' ";

	$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","error"=>mysqli_error($conn))));

	if($res) $arr=array("flag"=>"1");

	else $arr=array("flag"=>"0");

	echo json_encode($arr);



}



function delete_holidays(){



	global $conn;



	$id=$_POST["id"];



	$sql="DELETE FROM holidays_for_appt WHERE `id`='".$id."' ";



	$res=mysqli_query($conn,$sql);



	if($res) $arr=array("flag"=>1);



	else $arr=array("flag"=>0);



	echo json_encode($arr);



}





function load_branches_chember(){



	global $conn;



	

		/*



	 * Script: DataTables server-side script for PHP and MySQL



	 * Copyright: 2010 - Allan Jardine



	 * License: GPL v2 or BSD (3-point)



	 */



	



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *



	 * Easy set variables



	 */



	



	/* Array of database columns which should be read and sent back to DataTables. Use a space where



	 * you want to insert a non-database field (for example a counter or static image)



	 */

	 



	$aColumns = array( 'branches_for_appt.branch_name','branches_for_appt.address','user_infos.name as created_by', 'branches_for_appt.branches_id','branches_for_appt.created_on','branches_for_appt.modified_by','branches_for_appt.modified_time');



	



	/* Indexed column (used for fast and accurate table cardinality) */



	$sIndexColumn = "branches_for_appt.branches_id";



	



	/* DB table to use */



	$sTable = "branches_for_appt";



	



	



	



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *



	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is



	 * no need to edit below this line



	 */



	



	



	/*



	 * Paging



	 */



	$sLimit = "";



	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )



	{



		$sLimit = "LIMIT ".mysqli_real_escape_string($conn, $_GET['iDisplayStart'] ).", ".



			mysqli_real_escape_string($conn, $_GET['iDisplayLength'] );



	}



	



	



	/*



	 * Ordering



	 */



	if ( isset( $_GET['iSortCol_0'] ) )



	{



		$sOrder = "ORDER BY ";



		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )



		{



			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )



			{



				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."



				 	".mysqli_real_escape_string($conn, $_GET['sSortDir_'.$i] ) .", ";



			}



		}



		



		$sOrder = substr_replace( $sOrder, "", -2 );



		if ( $sOrder == "ORDER BY " )



		{



			$sOrder = "";



		}



	}



	



	



	/*



	 * Filtering



	 * NOTE this does not match the built-in DataTables filtering which does it



	 * word by word on any field. It's possible to do here, but concerned about efficiency



	 * on very large tables, and MySQL's regex functionality is very limited



	 */



	$sWhere = "";



	if ( $_GET['sSearch'] != "" )



	{



		$sWhere = "WHERE (";



		for ( $i=0 ; $i<2 ; $i++ )



		{



			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn, $_GET['sSearch'] )."%' OR ";



		}



		$sWhere = substr_replace( $sWhere, "", -3 );



		$sWhere .= ')';



	}



	



	/* Individual column filtering */



	for ( $i=0 ; $i<2 ; $i++ )



	{



	 if(isset($_GET['bSearchable_'.$i])){



		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )



		{



			if ( $sWhere == "" )



			{



				$sWhere = "WHERE ";



			}



			else



			{



				$sWhere .= " AND ";



			}



			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn,$_GET['sSearch_'.$i])."%' ";



		}



	 }	



	}



	



	/*if ( $sWhere == "" )



 {



		 $sWhere = ($_GET["group_name"]!="") ? " WHERE G.id like '".mysqli_real_escape_string($conn,$_GET["group_name"])."'" : "";



		



	}*/



	



	



	



	//$date = new DateTime($aRow[ $aColumns[$i] ], new DateTimeZone('America/Los_Angeles'));



	//$date->setTimezone(new DateTimeZone('Asia/Kolkata'));



	



	



	/*



	 * SQL queries



	 * Get data to display



	 */

	 if ( $sWhere == "" )

    {

		 $sWhere .= " WHERE `branches_for_appt`.`del_flag`='0' " ;

	}else{



		 $sWhere .= " AND `branches_for_appt`.`del_flag`='0' " ;

	}



	 $sQuery = "



		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."



		FROM $sTable INNER JOIN `user_infos` on ".$sTable.".created_by=user_infos.users_id 



		$sWhere



		$sOrder



		$sLimit



	";



	



	//echo $sQuery;



	$sql="set time_zone='+5:30'";



	$res=$conn->query($sql);



	



	$rResult = mysqli_query( $conn,$sQuery) or die(error_log(mysqli_error($conn)));



	



	/* Data set length after filtering */



	$sQuery = "



		SELECT FOUND_ROWS()



	";



	$rResultFilterTotal = mysqli_query($conn, $sQuery) or die(mysqli_error($conn));



	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);



	$iFilteredTotal = $aResultFilterTotal[0];



	



	/* Total data set length */



	$sQuery = "



		SELECT COUNT(".$sIndexColumn.")



		FROM $sTable



	";



	$rResultTotal = mysqli_query( $conn,$sQuery) or die(mysqli_error());



	$aResultTotal = mysqli_fetch_array($rResultTotal);



	$iTotal = $aResultTotal[0];



	



	



	/*



	 * Output



	 */



	$output = array(



		"sEcho" => intval($_GET['sEcho']),



		"iTotalRecords" => $iTotal,



		"iTotalDisplayRecords" => $iFilteredTotal,



		"aaData" => array()



	);



	



	while ( $aRow = mysqli_fetch_array( $rResult ) )



	{



		$row = array();



		for ( $i=0 ; $i<count($aColumns) ; $i++ )



		{



			if ( $aColumns[$i] == "version" )



			{

				/* Special output formatting for 'version' column */

				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];

			}

			else if ( $aColumns[$i] == "branches_for_appt.branch_name" )

			{

				$row[] =$aRow['branch_name'];

			}

			else if ( $aColumns[$i] == "branches_for_appt.address" )

			{

				$row[] =$aRow['address'];

			}

			else if ( $aColumns[$i] == "user_infos.name as created_by" )

			{

				$modifies_rows="";

				if($aRow['modified_by']!='0'){

					$sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$aRow['modified_by']."'";

					 $result8=$conn->query($sql8) ;				

					 $row8 = $result8->fetch_assoc();

					 $count8=$result8->num_rows;

					 if($count8>0)

					 {

					 	$modified_by=$row8['name'];

					 }

					 $modifies_rows='<br/>Modified By: '.$modified_by.'<br>'.'Modified On: '.date("d-m-Y h:i A", strtotime($aRow['modified_time']));

				}

				$row[] ='Created By: '.$aRow['created_by'].'<br>'.'Created On: '.date("d-m-Y h:i A", strtotime($aRow['created_on'])).$modifies_rows;

			}

			else if ( $aColumns[$i] == "branches_for_appt.branches_id" )

			{

				/* Special output formatting for 'version' column */



				$row[] = '<a href="javascript:void(0);" onclick="edit_this(\''. $aRow['branches_id'] .'\')"><span class="glyphicon glyphicon-edit"></span></a>';

			}else{



				/* General output */



				$row[] = $aRow[ $aColumns[$i] ];



			}



		}



		$output['aaData'][] = $row;



	}



	



	echo json_encode( $output );



}



function delete_branches(){



	global $conn;



	$id=$_POST['id'];	



	$sql="DELETE FROM `branches_for_appt` WHERE branches_id=$id";



	



	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



	



	if($res) $arr=array("flag"=>"1");



	else $arr=array("flag"=>"0");



	





	echo json_encode( $arr );



}



function load_procedure_chember(){

	



	global $conn;



	



		/*



	 * Script: DataTables server-side script for PHP and MySQL



	 * Copyright: 2010 - Allan Jardine



	 * License: GPL v2 or BSD (3-point)



	 */



	



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *



	 * Easy set variables



	 */



	/* Array of database columns which should be read and sent back to DataTables. Use a space where



	 * you want to insert a non-database field (for example a counter or static image)



	 */

	 $aColumns = array( 'opd_procedures_for_appt.procedure_name','opd_procedures_for_appt.time','user_infos.name as choose_doctor','opd_procedures_for_appt.created_by', 'opd_procedures_for_appt.id','opd_procedures_for_appt.created_on','opd_procedures_for_appt.modified_by','opd_procedures_for_appt.modified_time');	



	/* Indexed column (used for fast and accurate table cardinality) */



	$sIndexColumn = "opd_procedures_for_appt.id";



	



	/* DB table to use */



	$sTable = "opd_procedures_for_appt";



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *



	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is



	 * no need to edit below this line



	 */





	/*



	 * Paging



	 */



	$sLimit = "";



	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )



	{



		$sLimit = "LIMIT ".mysqli_real_escape_string($conn, $_GET['iDisplayStart'] ).", ".



			mysqli_real_escape_string($conn, $_GET['iDisplayLength'] );



	}



	/*



	 * Ordering



	 */



	if ( isset( $_GET['iSortCol_0'] ) )



	{



		$sOrder = "ORDER BY ";



		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )



		{



			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )



			{



				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."



				 	".mysqli_real_escape_string($conn, $_GET['sSortDir_'.$i] ) .", ";



			}



		}



		



		$sOrder = substr_replace( $sOrder, "", -2 );



		if ( $sOrder == "ORDER BY " )



		{



			$sOrder = "";



		}



	}



	

	/*



	 * Filtering



	 * NOTE this does not match the built-in DataTables filtering which does it



	 * word by word on any field. It's possible to do here, but concerned about efficiency



	 * on very large tables, and MySQL's regex functionality is very limited



	 */



	$sWhere = "";



	if ( $_GET['sSearch'] != "" )



	{



		$sWhere = "WHERE (";



		for ( $i=0 ; $i<2 ; $i++ )



		{



			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn, $_GET['sSearch'] )."%' OR ";



		}



		$sWhere = substr_replace( $sWhere, "", -3 );



		$sWhere .= ')';



	}



	



	/* Individual column filtering */



	for ( $i=0 ; $i<2 ; $i++ )



	{



	 if(isset($_GET['bSearchable_'.$i])){



		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )



		{



			if ( $sWhere == "" )



			{



				$sWhere = "WHERE ";



			}



			else



			{



				$sWhere .= " AND ";



			}



			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn,$_GET['sSearch_'.$i])."%' ";



		}



	 }	



	}



	



	/*



	 * SQL queries



	 * Get data to display



	 */

	 if ( $sWhere == "" )

    {

		 $sWhere .= " WHERE `opd_procedures_for_appt`.`del_flag`='0' " ;

	}else{



		 $sWhere .= " AND `opd_procedures_for_appt`.`del_flag`='0' " ;

	}

	

	 if ( $_SESSION['choose_doctors'] == "0" )

    {

		 $sWhere .= "  " ;

	}else{



		 $sWhere .= " AND `opd_procedures_for_appt`.`dr_user_id`='".$_SESSION['choose_doctors']."' " ;

	}



	 $sQuery = "



		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."



		FROM $sTable INNER JOIN `user_infos` on ".$sTable.".dr_user_id=user_infos.users_id 



		$sWhere



		$sOrder



		$sLimit



	";



	



	$sQuery;



	$sql="set time_zone='+5:30'";



	$res=$conn->query($sql);



	



	$rResult = mysqli_query( $conn,$sQuery) or die(error_log(mysqli_error($conn)));



	



	/* Data set length after filtering */



	$sQuery = "



		SELECT FOUND_ROWS()



	";



	$rResultFilterTotal = mysqli_query($conn, $sQuery) or die(mysqli_error($conn));



	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);



	$iFilteredTotal = $aResultFilterTotal[0];



	



	/* Total data set length */



	$sQuery = "



		SELECT COUNT(".$sIndexColumn.")



		FROM $sTable



	";



	$rResultTotal = mysqli_query( $conn,$sQuery) or die(mysqli_error());



	$aResultTotal = mysqli_fetch_array($rResultTotal);



	$iTotal = $aResultTotal[0];



	



	



	/*



	 * Output



	 */



	$output = array(



		"sEcho" => intval($_GET['sEcho']),



		"iTotalRecords" => $iTotal,



		"iTotalDisplayRecords" => $iFilteredTotal,



		"aaData" => array()



	);



	



	while ( $aRow = mysqli_fetch_array( $rResult ) )



	{



		$row = array();



		for ( $i=0 ; $i<count($aColumns) ; $i++ )



		{



			if ( $aColumns[$i] == "version" )



			{

				/* Special output formatting for 'version' column */

				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];

			}

			

			else if ( $aColumns[$i] == "opd_procedures_for_appt.procedure_name" )

			{

				$row[] =$aRow['procedure_name'];

			}

			else if ( $aColumns[$i] == "opd_procedures_for_appt.time" )

			{

				$row[] =$aRow['time']+1;

			}

			else if ( $aColumns[$i] == "user_infos.name as choose_doctor" )

			{

				$row[] =$aRow['choose_doctor'];

			}

			

			else if ( $aColumns[$i] == "opd_procedures_for_appt.created_by" )

			{

				$modifies_rows_new="";

				if($aRow['created_by']!='0'){

					 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$aRow['created_by']."'";

					 $result8=$conn->query($sql8) ;				

					 $row8 = $result8->fetch_assoc();

					 $count8=$result8->num_rows;

					 if($count8>0)

					 {

						

					 	$created_by=$row8['name'];

					 }

					 $modifies_rows_new='Created By: '.$created_by.'<br>'.'Created On: '.date("d-m-Y h:i A", strtotime($aRow['created_on']));

				}

				$modifies_rows="";

				if($aRow['modified_by']!='0'){

					$sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$aRow['modified_by']."'";

					 $result8=$conn->query($sql8) ;				

					 $row8 = $result8->fetch_assoc();

					 $count8=$result8->num_rows;

					 if($count8>0)

					 {

					 	$modified_by=$row8['name'];

					 }

					 $modifies_rows='<br/>Modified By: '.$modified_by.'<br>'.'Modified On: '.date("d-m-Y h:i A", strtotime($aRow['modified_time']));

				}

				$row[] =$modifies_rows_new.$modifies_rows;

			}

			else if ( $aColumns[$i] == "opd_procedures_for_appt.id" )

			{

				/* Special output formatting for 'version' column */



				$row[] = '<a href="javascript:void(0);" onclick="edit_this(\''. $aRow['id'] .'\')"><span class="glyphicon glyphicon-edit"></span></a>';

			}else{



				/* General output */



				$row[] = $aRow[ $aColumns[$i] ];



			}



		}



		$output['aaData'][] = $row;



	}



	



	echo json_encode( $output );



}



function delete_procedure(){



	global $conn;



	$id=$_POST['id'];	



	$sql="DELETE FROM `opd_procedures_for_appt` WHERE `id`=$id";



	



	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



	



	if($res) $arr=array("flag"=>"1");



	else $arr=array("flag"=>"0");



	



	echo json_encode( $arr );



}







function get_patient_info(){



	global $conn;



	$mobile_no=$_POST['mobile_no'];



	// $sql="SELECT `id`, `mrd_no`, `name`, `mobile`,`email` FROM `invoice` WHERE $filter GROUP BY `mrd_no` ORDER BY `id` DESC ";



	//$sql="SELECT `p1`.`id`,`p1`.`mrd_no`, `p1`.`name` ,`p1`.`mobile`, `p1`.`email` FROM `invoice` AS `p1` INNER JOIN ( SELECT MAX(`id`) AS `m_id` FROM `invoice` GROUP BY `mrd_no` ) AS `p2` ON `p1`.`id`=`p2`.`m_id` WHERE `p1`.`mobile`='".$_POST['mobile_no']."' AND `p1`.`name`<>'' AND `p1`.`mobile`<>'' ORDER BY `p1`.`id` DESC ";



	$sql="SELECT `p1`.`id`,`p1`.`uhid_no`, `p1`.`patient_name` ,`p1`.`phone_no`, `p1`.`email_id` FROM `patient_registration_form` AS `p1` INNER JOIN ( SELECT MAX(`id`) AS `m_id` FROM `patient_registration_form` GROUP BY `uhid_no` ) AS `p2` ON `p1`.`id`=`p2`.`m_id` WHERE `p1`.`phone_no`='".$mobile_no."' AND `p1`.`patient_name`<>'' AND `p1`.`phone_no`<>'' AND `p1`.`uhid_no`<>'' ORDER BY `p1`.`id` DESC ";



	$res=mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0")));



	$fl=0;



	while($row=mysqli_fetch_assoc($res)){



		$arr[]=array("flag"=>"1","mrd"=>$row['uhid_no'],"name"=>$row['patient_name'],"phone"=>$row['phone_no'],"email"=>$row['email_id'],"id"=>$row['id']);



		$fl++;



	}	



	if(!$res) $arr[]=array("flag"=>"0");



	else{



		if($fl==0) $arr[]=array("flag"=>"2");



	}



	echo json_encode( $arr );



}







function delete_availability(){



	global $conn;



	$id=$_POST['id'];	



	$yearflag=$_POST['yearflag'];	



	if($yearflag=="2"){	

	

		$sql_logs="select * from `doctors_availabilitiys_for_appt` where id='$id'";

		$res_logs=mysqli_query($conn,$sql_logs);

		$rows_logs=mysqli_fetch_assoc($res_logs) or die(mysqli_error($res_logs));

		$delete_query_logs="INSERT INTO `doctors_availabilitiys_for_appt` SET `id`='".$rows_logs['id']."', `dr_user_id`='".$rows_logs['dr_user_id']."', `visiting_day`='".$rows_logs['visiting_day']."', `visiting_starttime`='".$rows_logs['visiting_starttime']."', `visiting_endtime`='".$rows_logs['visiting_endtime']."', `branches_id`='".$rows_logs['branches_id']."', `schedule_type`='".$rows_logs['schedule_type']."', `status`='".$rows_logs['status']."', `patient_limit`='".$rows_logs['patient_limit']."', `destination_month`='".$rows_logs['destination_month']."', `doctors_only`='".$rows_logs['doctors_only']."', `created_by`='".$rows_logs['created_by']."', `created_on`='".$rows_logs['created_on']."', `modified_by`='".$rows_logs['modified_by']."', `modified_time`='".$rows_logs['modified_time']."', `del_flag`='".$rows_logs['del_flag']."', `deleted_by`='".$rows_logs['deleted_by']."', `deleted_time`='".$rows_logs['deleted_time']."'";

		

		//****************Log sticker****************************

			availability_log('delete',$rows_logs['dr_user_id'],$rows_logs['branches_id'],$delete_query_logs);

		//*******************End*********************************

		

		$sql="DELETE FROM `doctors_availabilitiys_for_appt` WHERE `id`='".$id."' ";

		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		if($res) $arr=array("flag"=>"1");

		else $arr=array("flag"=>"0");



	}else{

		$sql="select * from `doctors_availabilitiys_for_appt` where id='$id'";

		$res=mysqli_query($conn,$sql);

		$rows=mysqli_fetch_assoc($res) or die(mysqli_error($res));



		$visiting_day=$rows['visiting_day'];



		$old_weekday=date('N',strtotime($visiting_day));



		$dr_user_id=$rows['dr_user_id'];



		$branches_id=$rows['branches_id'];



		$visiting_starttime=$rows['visiting_starttime'];



		$visiting_endtime=$rows['visiting_endtime'];



		$schedule_type1=$rows['schedule_type'];	



		



		$old_weekday=($old_weekday=="7") ? "0" : $old_weekday;



		$year=date("Y",strtotime($visiting_day));



		



		



		$olddateArr=getDateForSpecificDayBetweenDates($visiting_day, $year.'-12-31', $old_weekday);



		



		//print_r($olddateArr);



		



		//die();



		



		foreach($olddateArr as $key1 => $val1){



		$sql_logs="select * from `doctors_availabilitiys_for_appt` WHERE `dr_user_id`='".$dr_user_id."' AND `visiting_day`='".$val1."' AND `visiting_starttime`='".$visiting_starttime."' AND `visiting_endtime`= '".$visiting_endtime."' AND `branches_id`='".$branches_id."' AND `schedule_type`='".$schedule_type1."' ";

		$res_logs=mysqli_query($conn,$sql_logs);

		$rows_logs=mysqli_fetch_assoc($res_logs) or die(mysqli_error($res_logs));

		$delete_query_logs="INSERT INTO `doctors_availabilitiys_for_appt` SET `id`='".$rows_logs['id']."', `dr_user_id`='".$rows_logs['dr_user_id']."', `visiting_day`='".$rows_logs['visiting_day']."', `visiting_starttime`='".$rows_logs['visiting_starttime']."', `visiting_endtime`='".$rows_logs['visiting_endtime']."', `branches_id`='".$rows_logs['branches_id']."', `schedule_type`='".$rows_logs['schedule_type']."', `status`='".$rows_logs['status']."', `patient_limit`='".$rows_logs['patient_limit']."', `destination_month`='".$rows_logs['destination_month']."', `doctors_only`='".$rows_logs['doctors_only']."', `created_by`='".$rows_logs['created_by']."', `created_on`='".$rows_logs['created_on']."', `modified_by`='".$rows_logs['modified_by']."', `modified_time`='".$rows_logs['modified_time']."', `del_flag`='".$rows_logs['del_flag']."', `deleted_by`='".$rows_logs['deleted_by']."', `deleted_time`='".$rows_logs['deleted_time']."'";

		

		//****************Log sticker****************************

			availability_log('delete',$rows_logs['dr_user_id'],$rows_logs['branches_id'],$delete_query_logs);

		//*******************End*********************************



			$sql="DELETE FROM `doctors_availabilitiys_for_appt` WHERE `dr_user_id`='".$dr_user_id."' AND `visiting_day`='".$val1."' AND `visiting_starttime`='".$visiting_starttime."' AND `visiting_endtime`= '".$visiting_endtime."' AND `branches_id`='".$branches_id."' AND `schedule_type`='".$schedule_type1."' ";



			$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		



			if($res) $arr=array("flag"=>"1");



			else $arr=array("flag"=>"0");



		



		}



	



	}



	







	



	



	echo json_encode( $arr );



}



function load_procedures(){



		global $conn;



		$fl=$_POST['fl'];



		$doc_id=$_POST['doc_id'];



		$sql="select id,procedure_name from `opd_procedures_for_appt` where dr_user_id='$doc_id'";



		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));



		$arr=array();



		while($row=mysqli_fetch_assoc($result)){



			



			extract($row);	



			$arr[]=array("value"=>$id,"text"=>$procedure_name);



		



		}



		



		echo json_encode($arr);



	



	



	}



	





function load_each_availability(){



	global $conn;



	



	$id=$_POST['id'];



	



	$sql="SELECT `id`, `dr_user_id`,`visiting_day`, `visiting_starttime`, `visiting_endtime`, `schedule_type`,`branches_id`,`patient_limit`,`destination_month`,`doctors_only` FROM `doctors_availabilitiys_for_appt` WHERE id='$id'";



	



	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



	



	while($row=mysqli_fetch_assoc($res)){



	



	extract($row);	



		



	$arr=array('id'=>$id,'visiting_starttime'=>date("h:i A",strtotime($visiting_starttime)),'visiting_endtime'=>date("h:i A",strtotime($visiting_endtime)),'doctor_id'=>$dr_user_id,'branches_id'=>$branches_id,'schedule_type'=>$schedule_type,'patient_limit'=>$patient_limit,'destination_month'=>$destination_month,'doctors_only'=>$doctors_only);



	}



	



	echo json_encode( $arr );



}



function update_availability(){



	global $conn;



	



	$id=$_POST['id'];



	$dtval=$_POST['dtval'];



	$doctors=$_POST['doctor'];



	$branches=$_POST['branches'];



	$weekdays=$_POST['weekdays'];



	$input_starttime=$_POST['input_starttime'];



	$etime=$_POST['etime'];



	$schedule_type=$_POST['schedule_type'];



	$yearflag=$_POST['yearflag'];



	$patient_limit=$_POST['patient_limit'];



	$destination_month=$_POST['destination_month'];



	$doctors_only=$_POST['doctors_only'];



	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];



	



	



	if($yearflag=="1"){



	



	



		$sql="select * from `doctors_availabilitiys_for_appt` where id='$id'";



	



		$res=mysqli_query($conn,$sql);



		



		$rows=mysqli_fetch_assoc($res);



		



		$visiting_day=$rows['visiting_day'];



		$old_weekday=date('N',strtotime($visiting_day));



		//$old_weekday=$old_weekday-1;



		$old_weekday=($old_weekday=="7") ? "0" : $old_weekday;



		$dr_user_id=$rows['dr_user_id'];



		$branches_id=$rows['branches_id'];



		$visiting_starttime=$rows['visiting_starttime'];



		$visiting_endtime=$rows['visiting_endtime'];



		$schedule_type1=$rows['schedule_type'];



	



		$year=date("Y",strtotime($dtval));



		$target_month=$destination_month;



		$dtval.":".$year."-".$target_month."-31".":".$val."\n";



		$dateArr=getDateForSpecificDayBetweenDates($dtval, $year.'-'.$target_month.'-31', $weekdays);



		$olddateArr=getDateForSpecificDayBetweenDates($dtval, $year.'-'.$target_month.'-31', $old_weekday);



	



		foreach($olddateArr as $key1 => $val1){





			$sql="UPDATE `doctors_availabilitiys_for_appt` SET `dr_user_id`='".$doctors."', `visiting_day`='".$olddateArr[$key1]."', `visiting_starttime`='".date("H:i",strtotime($input_starttime))."', `visiting_endtime`='".date("H:i",strtotime($etime))."' , `branches_id`='".$branches."', `schedule_type`='".$schedule_type."', `patient_limit`='".$patient_limit."', `destination_month`='".$destination_month."', `doctors_only`='".$doctors_only."' , `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `dr_user_id`='".$dr_user_id."' AND `visiting_day`='".$val1."' AND `visiting_starttime`='".$visiting_starttime."' AND `visiting_endtime`= '".$visiting_endtime."' AND `branches_id`='".$branches_id."' AND `schedule_type`='".$schedule_type1."' ";



			$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



			



			if($res) $arr=array("flag"=>1);



			else $arr=array("flag"=>0);			



			



		}



	



	}else{



			

			$sql="UPDATE `doctors_availabilitiys_for_appt` SET `dr_user_id`='".$doctors."', `visiting_day`='".$dtval."', `visiting_starttime`='".date("H:i",strtotime($input_starttime))."', `visiting_endtime`='".date("H:i",strtotime($etime))."' , `branches_id`='".$branches."', `schedule_type`='".$schedule_type."', `patient_limit`='".$patient_limit."', `destination_month`='".$destination_month."', `doctors_only`='".$doctors_only."' , `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$id."' ";



			



			$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



			



			if($res) $arr=array("flag"=>1);



			else $arr=array("flag"=>0);



	



	



	}



	//}



	



	



	



	



	/*$file = fopen("updateLog.txt","a");



	fwrite($file,$sql_log);



	fclose($file);*/



//****************Log sticker****************************



	



	//availability_log('edit',$dr_user_id,$branches);



	



//*******************End*********************************



	



	echo json_encode($arr);



}



function validate_pw(){



	$pw=$_POST['pw'];



	if($pw=="Cancel@6541") $arr=array("flag"=>1);



	else $arr=array("flag"=>0);



	echo json_encode($arr);



}



function schedulings_deletion_log(){



	global $conn;



		/*



	 * Script: DataTables server-side script for PHP and MySQL



	 * Copyright: 2010 - Allan Jardine



	 * License: GPL v2 or BSD (3-point)



	 */



	



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *



	 * Easy set variables



	 */



	



	/* Array of database columns which should be read and sent back to DataTables. Use a space where



	 * you want to insert a non-database field (for example a counter or static image)



	 */



	$aColumns = array('patient_infos_for_appt.name','schedule_deletion_log.doc_name','convert_tz(schedule_deletion_log.date_time,"+00:00","+11:30") as date_time','user_infos.name');



	



	/* Indexed column (used for fast and accurate table cardinality) */



	$sIndexColumn = "schedule_deletion_log.id";



	



	/* DB table to use */



	$sTable = "schedule_deletion_log";



	



	



	



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *



	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is



	 * no need to edit below this line



	 */



	



	



	/*



	 * Paging



	 */



	$sLimit = "";



	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )



	{



		$sLimit = "LIMIT ".mysqli_real_escape_string($conn, $_GET['iDisplayStart'] ).", ".



			mysqli_real_escape_string($conn, $_GET['iDisplayLength'] );



	}



	



	



	/*



	 * Ordering



	 */



	if ( isset( $_GET['iSortCol_0'] ) )



	{



		$sOrder = "ORDER BY ";



		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )



		{



			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )



			{



				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."



				 	".mysqli_real_escape_string($conn, $_GET['sSortDir_'.$i] ) .", ";



			}



		}



		



		$sOrder = substr_replace( $sOrder, "", -2 );



		if ( $sOrder == "ORDER BY " )



		{



			$sOrder = "";



		}



	}



	



	



	/*



	 * Filtering



	 * NOTE this does not match the built-in DataTables filtering which does it



	 * word by word on any field. It's possible to do here, but concerned about efficiency



	 * on very large tables, and MySQL's regex functionality is very limited



	 */



	$sWhere = "";



	if ( $_GET['sSearch'] != "" )



	{



		$sWhere = "WHERE (";



		for ( $i=0 ; $i<count($aColumns) ; $i++ )



		{



			if($aColumns[$i]!='convert_tz(schedule_deletion_log.date_time,"+00:00","+11:30") as date_time') $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn, $_GET['sSearch'] )."%' OR ";



		}



		$sWhere = substr_replace( $sWhere, "", -3 );



		$sWhere .= ')';



	}



	



	/* Individual column filtering */



	for ( $i=0 ; $i<count($aColumns) ; $i++ )



	{



	 if(isset($_GET['bSearchable_'.$i])){



		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )



		{



			if ( $sWhere == "" )



			{



				$sWhere = "WHERE ";



			}



			else



			{



				$sWhere .= " AND ";



			}



			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($conn,$_GET['sSearch_'.$i])."%' ";



		}



	 }	



	}



	



	/*if ( $sWhere == "" )



 {



		 $sWhere = ($_GET["group_name"]!="") ? " WHERE G.id like '".mysqli_real_escape_string($conn,$_GET["group_name"])."'" : "";



		



	}*/



	



		



	//echo "Where::".$sWhere;



	



	/*if ( $sWhere == "" )



 {



		$vdate=mysqli_real_escape_string($conn,$_GET["date_filter"]);



		 $sWhere .= ($_GET["date_filter"]!="") ? " WHERE DATE(created) = '".date("Y-m-d",strtotime($vdate))."'" : "";



		



	}else{



		$vdate=mysqli_real_escape_string($conn,$_GET["date_filter"]);



		$sWhere .= ($_GET["date_filter"]!="") ? " and DATE(created) = '".date("Y-m-d",strtotime($vdate))."'" : "";



		



	}*/



	



	//$date = new DateTime($aRow[ $aColumns[$i] ], new DateTimeZone('America/Los_Angeles'));



	//$date->setTimezone(new DateTimeZone('Asia/Kolkata'));



	



	



	/*



	 * SQL queries



	 * Get data to display



	 */



	$sQuery = "



		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."



		FROM $sTable left join `user_infos` on `user_infos`.`users_id`=`schedule_deletion_log`.`user_id` left join patient_infos_for_appt on schedule_deletion_log.patient_id=patient_infos_for_appt.id



		$sWhere



		$sOrder



		$sLimit



	";



	//echo $sQuery;



	//$sql="set time_zone='+5:30'";



	//$res=$conn->query($sql);



	



	$rResult = mysqli_query( $conn,$sQuery) or die(error_log(mysqli_error($conn)));



	



	/* Data set length after filtering */



	$sQuery = "



		SELECT FOUND_ROWS()



	";



	$rResultFilterTotal = mysqli_query($conn, $sQuery) or die(mysqli_error($conn));



	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);



	$iFilteredTotal = $aResultFilterTotal[0];



	



	/* Total data set length */



	$sQuery = "



		SELECT COUNT(".$sIndexColumn.")



		FROM $sTable



	";



	$rResultTotal = mysqli_query( $conn,$sQuery) or die(mysql_error());



	$aResultTotal = mysqli_fetch_array($rResultTotal);



	$iTotal = $aResultTotal[0];



	



	



	/*



	 * Output



	 */



	$output = array(



		"sEcho" => intval($_GET['sEcho']),



		"iTotalRecords" => $iTotal,



		"iTotalDisplayRecords" => $iFilteredTotal,



		"aaData" => array()



	);



	



	while ( $aRow = mysqli_fetch_array( $rResult ) )



	{



		$row = array();



		for ( $i=0 ; $i<count($aColumns) ; $i++ )



		{



			if ( $aColumns[$i] == "version" )



			{



				/* Special output formatting for 'version' column */



				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];



			}else if($aColumns[$i]=='patient_infos_for_appt.name'){



			



				$row[] = $aRow[0];



			



			}else if($aColumns[$i]=='schedule_deletion_log.doc_name'){



			



				$row[] = $aRow['doc_name'];



			



			}else if($aColumns[$i]=='user_infos.name'){



			



				$row[] = $aRow[3];



			



			}else if($aColumns[$i]=='convert_tz(schedule_deletion_log.date_time,"+00:00","+11:30") as date_time'){



			



				$row[] = $aRow[2];



			



			}else if ( !($aColumns[$i] == ' '))



			{



				/* General output */



				//print_r($aRow);



				$row[] = $aRow[ $aColumns[$i] ];



			}



		}



		$output['aaData'][] = $row;



	}



	



	echo json_encode( $output );



	



	



}



function availability_log($mode,$doctor_id,$branches,$delete_query_logs){



	global $conn;



	$log_select="select name as dr_name,(select branch_name from branches_for_appt where branches_id='".$branches."') as br_name from user_infos inner join users on users.id=user_infos.users_id where user_infos.users_id='".$doctor_id."'";

	$res_v=mysqli_query($conn,$log_select);

	$row_log=mysqli_fetch_assoc($res_v);



	$dr_name=$row_log['dr_name'];



	$br_name=$row_log['br_name'];



	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	$delete_query_logs_new=mysqli_real_escape_string($conn,$delete_query_logs);

	

	$sql_log="INSERT INTO `dravailability_deletion_log_for_appt` SET `doctor_name`='".$dr_name."', `branch`='".$br_name."', `user_name`='".$_SESSION['username']."', `mode`='".$mode."', `delete_query_logs`='".$delete_query_logs_new."', `created_by`='".$created_by."', `created_on`='".$created_on."'  ";



	$res_log=mysqli_query($conn,$sql_log);



}



function save_availability_particular_date(){



	global $conn;



	



	$particular_date=$_POST['particular_date'];



	$particular_date_starttime=$_POST['particular_date_starttime'];



	$particular_date_etime=$_POST['particular_date_etime'];



	$particular_date_doctors=$_POST['particular_date_doctors'];



	$particular_date_branches=$_POST['particular_date_branches'];



	$particular_date_schedule_type=$_POST['particular_date_schedule_type'];



	$particular_date_patient_limit=$_POST['particular_date_patient_limit'];



	$particular_date_doctors_only=$_POST['particular_date_doctors_only'];

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	



	

	$sql="INSERT INTO `doctors_availabilitiys_for_appt` SET `dr_user_id`='".$particular_date_doctors."', `visiting_day`='".$particular_date."', `visiting_starttime`='".date("H:i",strtotime($particular_date_starttime))."', `visiting_endtime`='".date("H:i",strtotime($particular_date_etime))."', `branches_id`='".$particular_date_branches."', `schedule_type`='".$particular_date_schedule_type."', `patient_limit`='".$particular_date_patient_limit."', `doctors_only`='".$particular_date_doctors_only."', `created_by`='".$created_by."', `created_on`='".$created_on."'";



		



		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));



		



		if($res) $arr=array("flag"=>1);



		else $arr=array("flag"=>0);



	





	echo json_encode($arr);



}



function edit_patient_infos_show(){



		global $conn;	



		$id=$_POST['id'];		



		$sql="SELECT * FROM `patient_infos_for_appt` WHERE `id`='$id'";	



		$res=mysqli_query($conn,$sql);		



		$rows=mysqli_fetch_assoc($res);		



		$patient_infos_save_name=$rows['name'];



		$patient_infos_save_phone_no=$rows['phone_no'];



		$patient_infos_save_email_id=$rows['email_id'];
		
		$sql_opd="SELECT * FROM `opd_schedules_for_appt` WHERE `patient_infos_id`='$id'";	



		$res_opd=mysqli_query($conn,$sql_opd);		



		$rows_opd=mysqli_fetch_assoc($res_opd);	
		$patient_infos_save_description=$rows_opd['description'];


		$arr=array("patient_infos_save_name"=>$patient_infos_save_name,"patient_infos_save_phone_no"=>$patient_infos_save_phone_no,"patient_infos_save_email_id"=>$patient_infos_save_email_id,"patient_infos_save_description"=>$patient_infos_save_description);	



		echo json_encode($arr);



}



function edit_patient_infos_save(){	



	global $conn;



	$patient_infos_save_id=$_POST["patient_infos_save_id"];

	$patient_infos_save_name=mysqli_real_escape_string($conn,$_REQUEST['patient_infos_save_name']);

	$patient_infos_save_phone_no=mysqli_real_escape_string($conn,$_REQUEST['patient_infos_save_phone_no']);

	$patient_infos_save_email_id=mysqli_real_escape_string($conn,$_REQUEST['patient_infos_save_email_id']);
	$patient_infos_save_description=mysqli_real_escape_string($conn,$_REQUEST['patient_infos_save_description']);

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];



	



	$tans_sql="SET autocommit = 0;";



	mysqli_query($conn,$tans_sql);



	



	$tans_sql="START TRANSACTION;";



	mysqli_query($conn,$tans_sql);



	

	$sql="UPDATE  `patient_infos_for_appt` SET `name`='".$patient_infos_save_name."', `phone_no`='".$patient_infos_save_phone_no."', `email_id`='".$patient_infos_save_email_id."', `modified_by`='".$created_by."', `modified_time`='".$created_on."' WHERE `id`='".$patient_infos_save_id."'  ";



	$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));		



	if($result){



		$tans_sql="COMMIT;";



		mysqli_query($conn,$tans_sql);



	}	


	$sql_appt="UPDATE  `opd_schedules_for_appt` SET `description`='".$patient_infos_save_description."' WHERE `patient_infos_id`='".$patient_infos_save_id."'  ";



	$result_appt=mysqli_query($conn,$sql_appt) or die(mysqli_error($conn));		



	if($result_appt){



		$tans_sql="COMMIT;";



		mysqli_query($conn,$tans_sql);



	}	

	unset($arr);



	$arr[]=array("flag"=>1);



	echo json_encode($arr);



}

function slected_date_time(){
	global $conn;
	$select_date_cal= date("d-m-Y", strtotime($_POST['select_date_cal']));
	$selected_times= $_POST['selected_times'];
	$var_arr = preg_split ("/\-/", $selected_times);
	$first_char=$var_arr[0];
	$first_letter=strtoupper($first_char);
	$arr=array("select_date_cal"=>$select_date_cal,"first_letter"=>$first_letter);
	echo json_encode($arr);
}

function show_details_for_edit(){
	global $conn;
	
	$patient_info_unique_id= $_POST['patient_info_unique_id'];
	$opd_schedule_unique_id= $_POST['opd_schedule_unique_id'];
	
	$sql_opd="SELECT * FROM `opd_schedules_for_appt` WHERE `id`='".$opd_schedule_unique_id."'";
	$res_opd=mysqli_query($conn,$sql_opd);	
	$rows_opd=mysqli_fetch_assoc($res_opd);	
	
	$sql_patient="SELECT * FROM `patient_infos_for_appt` WHERE `id`='".$opd_schedule_unique_id."'";
	$res_patient=mysqli_query($conn,$sql_patient);	
	$rows_patient=mysqli_fetch_assoc($res_patient);
	
	
	$selected_date_calender_special_edit= date("d/m/Y", strtotime($rows_opd['start_time']));
	$selected_time_special_edit= date("H:i:s", strtotime($rows_opd['start_time']));
	$selected_date_special_edit= date("Y-m-d", strtotime($rows_opd['start_time']));
	$selected_slot_show_special_edit= date("d-m-Y h:i A", strtotime($rows_opd['start_time']));
	$mrd_no_special_edit= $rows_opd['mrd_no'];
	$branches_id_special_edit= $rows_opd['branches_id'];
	$users_id_special_edit= $rows_opd['users_id'];
	$admin_user_id_special_edit= $_SESSION['id'];
	$opd_procedures_id_special_edit= $rows_opd['opd_procedures_id'];
	$scheduled_type_special_edit= $rows_opd['scheduled_type'];
	$description_special_edit= $rows_opd['description'];
	$generate_uhid_flag_special_edit= $rows_opd['generate_uhid_flag'];
	$old_db_id_special_edit= $rows_opd['old_db_id'];
	$ref_doctor_id_special_edit= $rows_opd['ref_doctor_id'];
	if($ref_doctor_id_special_edit==''){
		$ref_doctor_id_special_edit= 1;
	}
	
	$name_special_edit= $rows_patient['name'];
	$phone_no_special_edit= $rows_patient['phone_no'];
	$email_id_special_edit= $rows_patient['email_id'];
	$patient_type_special_edit= 1;
	$status_special_edit= 1;
	
	$time_slot_for_btn= date("h:i A", strtotime($rows_opd['start_time']));
	
	$selected_slot_staring= date("h:i A", strtotime($rows_opd['start_time']));
	$selected_slot_ending= date("h:i A", strtotime($rows_opd['end_time']));
	$selected_slot_start_ending=strtolower($selected_slot_staring).'-'.strtolower($selected_slot_ending);
	
	$button_id_unique="";
	$button_id_first="btn_".$users_id_special_edit.'_'.date('Ymd',strtotime($selected_date_special_edit)).'_'.$opd_procedures_id_special_edit;
	$starting_time_space=preg_replace('/\s+/', '', $time_slot_for_btn);
	$starting_time=str_replace(':', '_', $starting_time_space);
	$button_id_unique=$button_id_first.'_'.strtolower($starting_time);
	$age_special_edit=$rows_patient['age'];
	$gender_special_edit=1;
	if($rows_patient['gender']!=''){
		$gender_special_edit=$rows_patient['gender'];
	}
	$dob_special_edit='';
	if($rows_patient['dob']!=''){
		$dob_special_edit=date("d-m-Y", strtotime($rows_patient['dob']));
		
	}
	
	$arr=array("selected_date_calender_special_edit"=>$selected_date_calender_special_edit,"selected_time_special_edit"=>$selected_time_special_edit,"selected_date_special_edit"=>$selected_date_special_edit,"selected_slot_show_special_edit"=>$selected_slot_show_special_edit,"mrd_no_special_edit"=>$mrd_no_special_edit,"branches_id_special_edit"=>$branches_id_special_edit,"doc_id_special_edit"=>$users_id_special_edit,"admin_user_id_special_edit"=>$admin_user_id_special_edit,"opd_procedures_id_special_edit"=>$opd_procedures_id_special_edit,"scheduled_type_special_edit"=>$scheduled_type_special_edit,"description_special_edit"=>$description_special_edit,"generate_uhid_flag_special_edit"=>$generate_uhid_flag_special_edit,"old_db_id_special_edit"=>$old_db_id_special_edit,"name_special_edit"=>$name_special_edit,"phone_no_special_edit"=>$phone_no_special_edit,"email_id_special_edit"=>$email_id_special_edit,"patient_type_special_edit"=>$patient_type_special_edit,"status_special_edit"=>$status_special_edit,"button_id_unique"=>$button_id_unique,"selected_slot_start_ending"=>$selected_slot_start_ending,"age_special_edit"=>$age_special_edit,"gender_special_edit"=>$gender_special_edit,"ref_doctor_id_special_edit"=>$ref_doctor_id_special_edit,"dob_special_edit"=>$dob_special_edit);
	echo json_encode($arr);
}

function load_ref_doctors(){	
		global $conn;
		$defualts_val= $_POST['defualts_val'];		
		if($defualts_val=='0'){
			 $sql="SELECT * FROM `doctor_masters_for_emr` WHERE `del_flag`='0' ORDER BY `doctor_name`";
		 }else{
 			$sql="SELECT * FROM `doctor_masters_for_emr`  ORDER BY `doctor_name`";

		 }
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
		$arr=array();
		while($row=mysqli_fetch_assoc($result)){
			extract($row);	
			$arr[]=array("value"=>$id,"doctor_name"=> ucwords($doctor_name),"doctor_ini"=>$doctor_ini);

		}
		//$arr[]=array("value"=>$id,"text"=> $sql);
		echo json_encode($arr);
	}
	
	
	function load_procedures_purpose(){	
		global $conn;
		$sql="SELECT * FROM `procedure_purpose_masters_for_appt` WHERE `del_flag`='0' ORDER BY `purpose_name`";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);
		$arr=array();

		while($row=mysqli_fetch_assoc($result)){
			extract($row);	
			$arr[]=array("value"=>$id,"purpose_name"=>$purpose_name);

		}
		//$arr[]=array("value"=>$id,"text"=> $sql);
		echo json_encode($arr);
	}


function load_old_pt_details_for_appt_age_gender(){
	global $conn;
	$arr=array();
	$mrd_no=$_REQUEST["mrd_no"];

	$sql3="SELECT * FROM `patient_registration_form_old_db` WHERE `uhid_no`='".$mrd_no."' AND `uhid_no`<>'' AND `reg_for_new_db_flag`='0' ORDER BY `id` DESC LIMIT 1";	
	$result3=$conn->query($sql3) ;	 
	 $count3=$result3->num_rows;
	 if($count3>0){
		 $age=0;
		$row3=mysqli_fetch_assoc($result3);
		$dob = '';
		$gender = mysqli_real_escape_string($conn,$row3['gender']);	
		if(($row3['dob']!='')){
		$dob=date("d-m-Y", strtotime($row3['dob']));
		$diff = date_diff(date_create($row3['dob']), date_create(date('Y-m-d')));	
		$age = $diff->format('%y');
		}else{
			$dob='';
			$age=0;
		}		
		//$arr[]=array("dob"=>$dob,"gender"=>$gender,"new_db_id"=>'0',"age"=>$age);
		
	 }	 
	 	
	$sql4="SELECT * FROM `patient_registration_form` WHERE `uhid_no`='".$mrd_no."' AND `uhid_no`<>''  ORDER BY `id` DESC LIMIT 1 ";	
	$result4=$conn->query($sql4) ;
	$count4=$result4->num_rows;
	 if($count4>0){		
		$age=0;
		$row4=mysqli_fetch_assoc($result4);
		$dob = '';
		$gender = mysqli_real_escape_string($conn,$row4['gender']);	
		if(($row4['dob']!='')){
		$dob=date("d-m-Y", strtotime($row4['dob']));
		$diff = date_diff(date_create($row4['dob']), date_create(date('Y-m-d')));	
		$age = $diff->format('%y');
		}else{
			$dob='';
			$age=0;
		}
		$new_db_id=1;		
	 }
	 $arr=array("dob"=>$dob,"gender"=>$gender,"new_db_id"=>$new_db_id,"age"=>$age);
		echo json_encode($arr);				

}

function appt_booked_patients_new_format(){
	global $conn;

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$sTable = "`opd_schedules_for_appt`";

$date_empty_flag=0;

	if($_REQUEST["from_date"]!=""){
	 $from_date_chnage=$_REQUEST["from_date"];
	 $from_date=date("Y-m-d",strtotime($from_date_chnage));
	 $date_empty_flag=1;
	}else{

		$from_date="";
		$date_empty_flag=0;
	}

	if($_REQUEST["to_date"]!=""){
	 $to_date_chnage=$_REQUEST["to_date"];
	 $to_date=date("Y-m-d",strtotime($to_date_chnage));
	 $date_empty_flag=1;
	}else{

		$to_date="";
		$date_empty_flag=0;
	}

	if($_REQUEST["branches_list"]!=""){
	 $branch_id=$_REQUEST['branches_list'];
	}else{
		$branch_id=1;
	}
	
	$doctors_list="";
	if($_REQUEST["doctors_list"]!=""){
	 $doctors_list=$_REQUEST['doctors_list'];
	}
	
	if($_REQUEST["patient_name_search"]!=""){
	 $patient_name_search=$_REQUEST['patient_name_search'];
	 $sWhere.= " and `patient_infos_for_appt`.`name` like '%".$patient_name_search."%' ";
	}else{
		$sWhere.= " ";
	}
	
	if($_REQUEST["patient_uhid_search"]!=""){
	 $patient_uhid_search=$_REQUEST['patient_uhid_search'];
	 $sWhere.= " and `patient_infos_for_appt`.`mrdno` = '".$patient_uhid_search."' ";
	}else{
		$sWhere.= " ";
	}
	
	if($_REQUEST["patient_ph_search"]!=""){
	 $patient_ph_search=$_REQUEST['patient_ph_search'];
	 $sWhere.= " and `patient_infos_for_appt`.`phone_no` = '".$patient_ph_search."' ";
	}else{
		$sWhere.= " ";
	}
	
	if($date_empty_flag=="1"){
	 $sWhere.= " and (DATE(".$sTable.".`start_time`) between '".$from_date."' and '".$to_date."') ";
	}else{
		$sWhere.= " ";
	}


	if ( $sWhere == "" )
	 {

		 if($doctors_list!=""){
			$sWhere .=  " AND  ".$sTable.".`branches_id`='".$branch_id."' and ".$sTable.".`users_id`='".$doctors_list."' ".$where_info." " ;
		
		}else{
			$sWhere .=  " AND  ".$sTable.".`branches_id`='".$branch_id."' ".$where_info."   " ;
			
		}
	}else{

		if($doctors_list!=""){
			$sWhere .=  " AND ".$sTable.".`branches_id`='".$branch_id."' and ".$sTable.".users_id='".$doctors_list."' ".$where_info." " ;
		
		}else{
			$sWhere .=  " AND  ".$sTable.".`branches_id`='".$branch_id."' ".$where_info." " ;
			
		}
	}

	if ( $sWhere == "" )
 	{
		 $sOrder .= "  ORDER BY `user_infos`.`name` ASC ,`opd_schedules_for_appt`.`start_time` ASC, `patient_infos_for_appt`.`name` ASC ";
	}else{
		$sOrder .= "  ORDER BY `user_infos`.`name` ASC, `opd_schedules_for_appt`.`start_time` ASC , `patient_infos_for_appt`.`name` ASC";

	}
	$arr=array();
	
	$sl=1;
	$sql_doc=" SELECT DISTINCT (`opd_schedules_for_appt`.`users_id`) AS `distinct_doc_id` FROM `opd_schedules_for_appt` INNER JOIN `user_infos` ON `opd_schedules_for_appt`.`users_id`=`user_infos`.`users_id`  left join `patient_infos_for_appt` on ".$sTable.".`patient_infos_id`=`patient_infos_for_appt`.`id`  WHERE 1 $sWhere ORDER BY `user_infos`.`name` ASC ";                   

	 $result_doc=$conn->query($sql_doc) ;
	 $count_doc=$result_doc->num_rows;
	 if($count_doc>'0'){
		 while ($row_doc=mysqli_fetch_array($result_doc,MYSQLI_ASSOC))
			 {	
	
	$select_column="";
	$select_column=" `opd_schedules_for_appt`.`del_flag`,`opd_schedules_for_appt`.`mrd_no`, `patient_infos_for_appt`.`name`, `patient_infos_for_appt`.`phone_no`, `patient_infos_for_appt`.`age`, date(`opd_schedules_for_appt`.`start_time`) as `appt_date`, `opd_schedules_for_appt`.`start_time`, `user_infos`.`name` as `doctor_name`, `opd_procedures_for_appt`.`procedure_name`,(select `user_infos`.`name` from `user_infos` where `user_infos`.`users_id`=`opd_schedules_for_appt`.`admin_user_id`) as `admin_user`,`opd_schedules_for_appt`.`description`,`opd_schedules_for_appt`.`id`,`opd_schedules_for_appt`.`patient_infos_id`,`patient_infos_for_appt`.`created_by`,`patient_infos_for_appt`.`created_on`,`patient_infos_for_appt`.`modified_by`,`patient_infos_for_appt`.`modified_time`, `patient_infos_for_appt`.`email_id`,`opd_schedules_for_appt`.`generate_uhid_flag`, `patient_infos_for_appt`.`gender`,`opd_schedules_for_appt`.`ref_doctor_id` ";
	
	if($_SESSION['choose_doctors']=='0'){
	$sQuery = " SELECT ".$select_column." FROM $sTable left join `opd_procedures_for_appt` on ".$sTable.".`opd_procedures_id`=`opd_procedures_for_appt`.`id`  left join `user_infos` on ".$sTable.".`users_id`=`user_infos`.`users_id` left join `patient_infos_for_appt` on ".$sTable.".`patient_infos_id`=`patient_infos_for_appt`.`id` left join `branches_for_appt` on `branches_for_appt`.`branches_id`=".$sTable.".`branches_id` WHERE 1 $sWhere AND ".$sTable.".users_id=".$row_doc['distinct_doc_id']." $sOrder";	
	}
	//  $swhere er por AND ".$sTable.".generate_uhid_flag=0

	else{
		$sQuery = " SELECT ".$select_column." FROM $sTable left join `opd_procedures_for_appt` on ".$sTable.".`opd_procedures_id`=`opd_procedures_for_appt`.`id`  left join `user_infos` on ".$sTable.".`users_id`=`user_infos`.`users_id` left join `patient_infos_for_appt` on ".$sTable.".`patient_infos_id`=`patient_infos_for_appt`.`id` left join `branches_for_appt` on `branches_for_appt`.`branches_id`=".$sTable.".`branches_id` WHERE 1 $sWhere AND ".$sTable.".users_id=".$_SESSION['choose_doctors']."  $sOrder";	
		
	}
	//echo $sQuery;
	
	$doc_sl=1;
	$result=mysqli_query($conn,$sQuery) or die(mysqli_error($conn).$sQuery);	
	while($row=mysqli_fetch_assoc($result)){
		$mrd_no='';
		$name='';
		$phone_no='';
		$email_id='';
		$age='';
		$gender_age='';
		$start_date='';
		$start_time='';		
		$doctor_name='';
		$procedure_name='';
		$created_by='';
		$description='';
		$action_tab='';
		
		$mrd_no=$row['mrd_no'];
		$name=$row['name'];
		$phone_no=$row['phone_no'];
		$email_id=$row['email_id'];
		$age=$row['age'];
		$gender_rows="";
		if($row['gender']=='1'){
			$gender_rows=' /M';
		}
		if($row['gender']=='2'){
			$gender_rows=' /F';
		}
		if($row['gender']=='3'){
			$gender_rows=' /O';
		}
		$gender_age =$age.$gender_rows;
		
		$start_date=date("d-M-y",strtotime($row['start_time']));
		$start_time=date("h:i A",strtotime($row['start_time']));
		$doctor_name=$row['doctor_name'];
		$procedure_name=$row['procedure_name'];
		$sql8="SELECT `username` FROM `users` Where `id`='".$row['created_by']."'";
		 $result8=$conn->query($sql8) ;	
		 $row8 = $result8->fetch_assoc();
		 $count8=$result8->num_rows;
		 if($count8>0)
		 {
			$created_by=$row8['username'];
		 }
		 
		 $ref_by="";
		 $sql14="SELECT `doctor_ini` FROM `doctor_masters_for_emr` Where `id`='".$row['ref_doctor_id']."'";
		 $result14=$conn->query($sql14) ;	
		 $row14 = $result14->fetch_assoc();
		 $count14=$result14->num_rows;
		 if($count14>0)
		 {
			$ref_by=$row14['doctor_ini'];
		 }
		$description=$row['description'];
		$action_tab7="";
		if($_SESSION['emr_pres_master_add_flag']=='1'){
			$action_tab7="| <a href='javascript:void(0);' onclick='delete_val(".$row['id'].")'><span class='glyphicon glyphicon-trash'></span></a>";
		}
		$action_tab8 ="<a href='javascript:void(0);' onclick='special_edit_infos(".$row['patient_infos_id'].",".$row['id'].")'><span class='glyphicon glyphicon-edit'></span></a> ";
		$action_tab=$action_tab8.$action_tab7;
		
		$arr[]=array("sl"=>$sl,"mrd_no"=>$mrd_no,"name"=>$name,"phone_no"=>$phone_no,"email_id"=>$email_id,"age"=>$age,"gender_age"=>$gender_age,"start_date"=>$start_date,"start_time"=>$start_time,"doctor_name"=>$doctor_name,"procedure_name"=>$procedure_name,"created_by"=>$created_by,"description"=>$description,"action_tab"=>$action_tab,"ref_by"=>$ref_by,"doc_sl"=>$doc_sl);
		$sl++;
		$doc_sl++;
	}
			 }}
	echo json_encode($arr);					

	
	



}

function appt_booked_deleted_patients_new_format(){
	global $conn;

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$sTable = "`opd_schedules_delete_for_appt`";

$date_empty_flag=0;

	if($_REQUEST["from_date"]!=""){
	 $from_date_chnage=$_REQUEST["from_date"];
	 $from_date=date("Y-m-d",strtotime($from_date_chnage));
	 $date_empty_flag=1;
	}else{

		$from_date="";
		$date_empty_flag=0;
	}

	if($_REQUEST["to_date"]!=""){
	 $to_date_chnage=$_REQUEST["to_date"];
	 $to_date=date("Y-m-d",strtotime($to_date_chnage));
	 $date_empty_flag=1;
	}else{

		$to_date="";
		$date_empty_flag=0;
	}

	if($_REQUEST["branches_list"]!=""){
	 $branch_id=$_REQUEST['branches_list'];
	}else{
		$branch_id=1;
	}
	
	$doctors_list="";
	if($_REQUEST["doctors_list"]!=""){
	 $doctors_list=$_REQUEST['doctors_list'];
	}
	
	if($_REQUEST["patient_name_search"]!=""){
	 $patient_name_search=$_REQUEST['patient_name_search'];
	 $sWhere.= " and `patient_infos_delete_for_appt`.`name` like '%".$patient_name_search."%' ";
	}else{
		$sWhere.= " ";
	}
	
	if($_REQUEST["patient_uhid_search"]!=""){
	 $patient_uhid_search=$_REQUEST['patient_uhid_search'];
	 $sWhere.= " and `patient_infos_delete_for_appt`.`mrdno` = '".$patient_uhid_search."' ";
	}else{
		$sWhere.= " ";
	}
	
	if($_REQUEST["patient_ph_search"]!=""){
	 $patient_ph_search=$_REQUEST['patient_ph_search'];
	 $sWhere.= " and `patient_infos_delete_for_appt`.`phone_no` = '".$patient_ph_search."' ";
	}else{
		$sWhere.= " ";
	}
	
	if($date_empty_flag=="1"){
	 $sWhere.= " and (DATE(".$sTable.".`start_time`) between '".$from_date."' and '".$to_date."') ";
	}else{
		$sWhere.= " ";
	}


	if ( $sWhere == "" )
	 {

		 if($doctors_list!=""){
			$sWhere .=  " AND  ".$sTable.".`branches_id`='".$branch_id."' and ".$sTable.".`users_id`='".$doctors_list."' ".$where_info." " ;
		
		}else{
			$sWhere .=  " AND  ".$sTable.".`branches_id`='".$branch_id."' ".$where_info."   " ;
			
		}
	}else{

		if($doctors_list!=""){
			$sWhere .=  " AND ".$sTable.".`branches_id`='".$branch_id."' and ".$sTable.".users_id='".$doctors_list."' ".$where_info." " ;
		
		}else{
			$sWhere .=  " AND  ".$sTable.".`branches_id`='".$branch_id."' ".$where_info." " ;
			
		}
	}

	if ( $sWhere == "" )
 	{
		 $sOrder .= "  ORDER BY `user_infos`.`name` ASC ,`opd_schedules_delete_for_appt`.`start_time` ASC, `patient_infos_delete_for_appt`.`name` ASC ";
	}else{
		$sOrder .= "  ORDER BY `user_infos`.`name` ASC, `opd_schedules_delete_for_appt`.`start_time` ASC , `patient_infos_delete_for_appt`.`name` ASC";

	}
	$arr=array();
	
	$sl=1;
	$sql_doc=" SELECT DISTINCT (`opd_schedules_delete_for_appt`.`users_id`) AS `distinct_doc_id` FROM `opd_schedules_delete_for_appt` INNER JOIN `user_infos` ON `opd_schedules_delete_for_appt`.`users_id`=`user_infos`.`users_id`  left join `patient_infos_delete_for_appt` on ".$sTable.".`patient_infos_id`=`patient_infos_delete_for_appt`.`id`  WHERE 1 $sWhere ORDER BY `user_infos`.`name` ASC ";                   

	 $result_doc=$conn->query($sql_doc) ;
	 $count_doc=$result_doc->num_rows;
	 if($count_doc>'0'){
		 while ($row_doc=mysqli_fetch_array($result_doc,MYSQLI_ASSOC))
			 {	
	
	$select_column="";
	$select_column=" `opd_schedules_delete_for_appt`.`del_flag`,`opd_schedules_delete_for_appt`.`mrd_no`, `patient_infos_delete_for_appt`.`name`, `patient_infos_delete_for_appt`.`phone_no`, `patient_infos_delete_for_appt`.`age`, date(`opd_schedules_delete_for_appt`.`start_time`) as `appt_date`, `opd_schedules_delete_for_appt`.`start_time`, `user_infos`.`name` as `doctor_name`, `opd_procedures_for_appt`.`procedure_name`,(select `user_infos`.`name` from `user_infos` where `user_infos`.`users_id`=`opd_schedules_delete_for_appt`.`admin_user_id`) as `admin_user`,`opd_schedules_delete_for_appt`.`description`,`opd_schedules_delete_for_appt`.`id`,`opd_schedules_delete_for_appt`.`patient_infos_id`,`patient_infos_delete_for_appt`.`created_by`,`patient_infos_delete_for_appt`.`created_on`,`patient_infos_delete_for_appt`.`modified_by`,`patient_infos_delete_for_appt`.`modified_time`, `patient_infos_delete_for_appt`.`email_id`,`opd_schedules_delete_for_appt`.`generate_uhid_flag`, `patient_infos_delete_for_appt`.`gender`,`opd_schedules_delete_for_appt`.`ref_doctor_id` ";
	
	if($_SESSION['choose_doctors']=='0'){
	$sQuery = " SELECT ".$select_column." FROM $sTable left join `opd_procedures_for_appt` on ".$sTable.".`opd_procedures_id`=`opd_procedures_for_appt`.`id`  left join `user_infos` on ".$sTable.".`users_id`=`user_infos`.`users_id` left join `patient_infos_delete_for_appt` on ".$sTable.".`patient_infos_id`=`patient_infos_delete_for_appt`.`id` left join `branches_for_appt` on `branches_for_appt`.`branches_id`=".$sTable.".`branches_id` WHERE 1 $sWhere  AND  ".$sTable.".`del_flag`='0'  AND ".$sTable.".users_id=".$row_doc['distinct_doc_id']." $sOrder";	
	}
	//  $swhere er por AND ".$sTable.".generate_uhid_flag=0

	else{
		$sQuery = " SELECT ".$select_column." FROM $sTable left join `opd_procedures_for_appt` on ".$sTable.".`opd_procedures_id`=`opd_procedures_for_appt`.`id`  left join `user_infos` on ".$sTable.".`users_id`=`user_infos`.`users_id` left join `patient_infos_delete_for_appt` on ".$sTable.".`patient_infos_id`=`patient_infos_delete_for_appt`.`id` left join `branches_for_appt` on `branches_for_appt`.`branches_id`=".$sTable.".`branches_id` WHERE 1 $sWhere  AND  ".$sTable.".`del_flag`='0' AND ".$sTable.".users_id=".$_SESSION['choose_doctors']."  $sOrder";	
		
	}
	//echo $sQuery;
	
	$doc_sl=1;
	$result=mysqli_query($conn,$sQuery) or die(mysqli_error($conn).$sQuery);	
	while($row=mysqli_fetch_assoc($result)){
		$mrd_no='';
		$name='';
		$phone_no='';
		$email_id='';
		$age='';
		$gender_age='';
		$start_date='';
		$start_time='';		
		$doctor_name='';
		$procedure_name='';
		$created_by='';
		$description='';
		$action_tab='';
		
		$mrd_no=$row['mrd_no'];
		$name=$row['name'];
		$phone_no=$row['phone_no'];
		$email_id=$row['email_id'];
		$age=$row['age'];
		$gender_rows="";
		if($row['gender']=='1'){
			$gender_rows=' /M';
		}
		if($row['gender']=='2'){
			$gender_rows=' /F';
		}
		if($row['gender']=='3'){
			$gender_rows=' /O';
		}
		$gender_age =$age.$gender_rows;
		
		$start_date=date("d-M-y",strtotime($row['start_time']));
		$start_time=date("h:i A",strtotime($row['start_time']));
		$doctor_name=$row['doctor_name'];
		$procedure_name=$row['procedure_name'];
		$sql8="SELECT `username` FROM `users` Where `id`='".$row['created_by']."'";
		 $result8=$conn->query($sql8) ;	
		 $row8 = $result8->fetch_assoc();
		 $count8=$result8->num_rows;
		 if($count8>0)
		 {
			$created_by=$row8['username'];
		 }
		 
		 $ref_by="";
		 $sql14="SELECT `doctor_ini` FROM `doctor_masters_for_emr` Where `id`='".$row['ref_doctor_id']."'";
		 $result14=$conn->query($sql14) ;	
		 $row14 = $result14->fetch_assoc();
		 $count14=$result14->num_rows;
		 if($count14>0)
		 {
			$ref_by=$row14['doctor_ini'];
		 }
		$description=$row['description'];
		$action_tab7="";
		if($_SESSION['emr_pres_master_add_flag']=='1'){
			$action_tab7="<a href='javascript:void(0);' onclick='restore_val(".$row['id'].")' title='Restore Appointment' ><img src='".ADMIN_URL."icon/restore.png' title='Restore Appointment'></a>";
		}
	
		$action_tab=$action_tab7;
		
		$arr[]=array("sl"=>$sl,"mrd_no"=>$mrd_no,"name"=>$name,"phone_no"=>$phone_no,"email_id"=>$email_id,"age"=>$age,"gender_age"=>$gender_age,"start_date"=>$start_date,"start_time"=>$start_time,"doctor_name"=>$doctor_name,"procedure_name"=>$procedure_name,"created_by"=>$created_by,"description"=>$description,"action_tab"=>$action_tab,"ref_by"=>$ref_by,"doc_sl"=>$doc_sl);
		$sl++;
		$doc_sl++;
	}
			 }}
	echo json_encode($arr);					

	
	



}




function restore_schedule(){



	global $conn;
	
	ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);



	$id=$_POST['id'];

	$created_on=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	$sql_logs="select * from `schedule_deletion_log_for_appt` where `unique_foreign_id`='".$id."'";

	$res_logs=mysqli_query($conn,$sql_logs);
	
	while($rows_logs=mysqli_fetch_assoc($res_logs)){	
		$query_for_restore='';
		$query_for_restore=$rows_logs['delete_query_logs'];		
		$res_logs_for_new_delete=mysqli_query($conn,$query_for_restore);
	}
	$sql_logs_for_new_delete="UPDATE  `opd_schedules_delete_for_appt` SET `restore_time`='".$created_on."', `restore_by`='".$created_by."', `del_flag`='1', `deleted_by`='".$created_by."', `deleted_time`='".$created_on."'  WHERE `id`='".$id."'  ";
	$res_logs_for_new_delete=mysqli_query($conn,$sql_logs_for_new_delete);
	
	$sql="delete from `schedule_deletion_log_for_appt` where `unique_foreign_id`='".$id."' ";
	$res=mysqli_query($conn,$sql);

	if($res){
	 $arr=array("flag"=>"1");
	}else $arr=array("flag"=>"0");
	echo json_encode($arr);

}

?>
