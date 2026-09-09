<?php

include 'function.php';

include "conn.php";



//$_SESSION["department_id"]=8;



/*ini_set('display_errors', 1);



ini_set('display_startup_errors', 1);



error_reporting(E_ALL);*/





$flag=$_GET["flag"];



if($flag=="1"){		



	load_ipd_admssion_details();	



}



else if($flag=="2"){		



	load_ipd_admssion_details_for_walk_in();	



}



else if($flag=="3"){		



	load_ipd_admssion_details_for_follow_up();	



}



else if($flag=="4"){		



	load_ipd_admssion_details_for_slip_generated();	



}

else if($flag=="5"){		



	load_final_billing_details();	



}else if($flag=="6"){		



	load_advance_billing_details();	



}else if($flag=="7"){		



	discharge_summery_details();	



}else if($flag=="8"){		



	estimation_record_details();	



}else if($flag=="9"){		



	load_refund_advance_billing_details();	



}else if($flag=="10"){		



	load_final_billing_details_for_draft_bill();	



}

else if($flag=="11"){		



	load_ipd_admssion_details_for_reg_by_pat();	



}

else if($flag=="12"){		



	load_ipd_admssion_details_for_emr_details();	
}
else{



	echo "Flag  Not Selected";		



}



		



		// For IPD



function load_ipd_admssion_details(){







	global $conn;



	 $from_date = date("Y-m-d");

	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));

	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));



	$arr=array();



	$sl_no=1;



	$sql3="SELECT `opd_schedules_for_appt`.`mrd_no`,`patient_infos_for_appt`.`name`,`patient_infos_for_appt`.`phone_no` , `opd_schedules_for_appt`.`start_time`,`user_infos`.`name` AS `doctor_name` ,`opd_procedures_for_appt`.`procedure_name`,`opd_schedules_for_appt`.`description`, `patient_infos_for_appt`.`created_by`,`patient_infos_for_appt`.`created_on`,`patient_infos_for_appt`.`modified_by`,`patient_infos_for_appt`.`modified_time`,`opd_schedules_for_appt`.`id`,`opd_schedules_for_appt`.`patient_infos_id`,`opd_schedules_for_appt`.`old_db_id`,`opd_schedules_for_appt`.`users_id` AS `doc_id_appt` FROM `opd_schedules_for_appt` LEFT JOIN `opd_procedures_for_appt` ON `opd_schedules_for_appt`.`opd_procedures_id`=`opd_procedures_for_appt`.`id`  LEFT JOIN `user_infos` ON `opd_schedules_for_appt`.`users_id`=`user_infos`.`users_id` LEFT JOIN `patient_infos_for_appt` ON `opd_schedules_for_appt`.`patient_infos_id`=`patient_infos_for_appt`.`id`  WHERE DATE(`opd_schedules_for_appt`.`start_time`) BETWEEN '".$from_date."' AND  '".$to_date."' ORDER BY `opd_schedules_for_appt`.`start_time` ASC ";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	



							$created_by="";



							 $modified_by="";					



							 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



							 $result7=$conn->query($sql7) ;				



							 $row7 = $result7->fetch_assoc();



							 $count7=$result7->num_rows;



							 if($count7>0)



							 {



								$created_by=$row7['name'];



							 }



							 



							 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



							 $result8=$conn->query($sql8) ;				



							 $row8 = $result8->fetch_assoc();



							 $count8=$result8->num_rows;



							 if($count8>0)



							 {



								$modified_by=$row8['name'];



							 } 



							 $patient_registration_id="";

							 $patient_reg_upload="";



							 if($row3['mrd_no']!=''){



								 $sql9="SELECT * FROM `patient_registration_form` Where `uhid_no`='".$row3['mrd_no']."'";



								 $result9=$conn->query($sql9) ;				



								 $row9 = $result9->fetch_assoc();



								 $count9=$result9->num_rows;



								 if($count9>0)



								 {



									$patient_registration_id=$row9['id'];



								 }

								  $sql12="SELECT `image_name` FROM `patient_reg_upload` Where `uhid_no`='".$row3['mrd_no']."'";



								 $result12=$conn->query($sql12) ;				

	

								 $row12 = $result12->fetch_assoc();

	

								 $count12=$result12->num_rows;

	

								 if($count12>0)

	

								 {

	

									$patient_reg_upload=$row12['image_name'];

	

								 }



							 }



			



	$appt_time="";				

	$doc_id_appt="";

	 $appt_time =date("d-m-y",strtotime($row3['start_time'])).'<br>'.date("H:i A",strtotime($row3['start_time']));



	 $old_db_id="";



	 //patient_admission_type=1  ->  Appt Patient



	 //patient_admission_type=2  ->  Walk In Patient



	 //patient_admission_type=3  ->  Follow UP Patient



	$pateint_name=$row3['name'].' ( '.$row3['phone_no'].'  '.$row3['mrd_no'].' )';

	$old_db_id=$row3['old_db_id'];

	$doc_id_appt=$row3['doc_id_appt'];

	 $modifiaction_details="";

	$action_tab_new="";
	$action_tab="";

	if($row3['modified_time']!=''){ 



	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 



	  } 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details;



	if($row3['mrd_no']==''){



	$action_tab="<a onClick=\"if(confirm('Are you sure to UHID Generate for $pateint_name?')) return true; else return false;\"  href='".ADMIN_URL."registration_form_add.php?appt_id=".$row3['id']."&patient_admission_type=1'  title='UHID Generate' ><img src='". ADMIN_URL."icon/uhid_generate.png'  title='UHID Generate'></a> ";
	
	


	}else{

		if($patient_registration_id!=''){



		$action_tab="<a onClick=\"if(confirm('Are you sure to Edit for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."registration_form_edit.php?patient_registration_id=".$patient_registration_id."'  title='EDIT' ><img src='". ADMIN_URL."icon/bt_edit.gif'  title='Edit'></a> ";
		 $action_tab_new="| <a href='".ADMIN_URL."print_card.php?id=".$patient_registration_id."'  target='_blank' title='Print UHID Card' ><img src='". ADMIN_URL."icon/PRINT-UHID.png'  title='Print UHID Card'></a> | <a onClick=\"if(confirm('Are you sure to Slip Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."slip_generate_form_add.php?uhid_no=".$row3['mrd_no']."'  title='Slip Generate' ><img src='". ADMIN_URL."icon/PRINT-Slip.png'  title='Slip Generate'></a> | <a onClick=\"if(confirm('Are you sure to OPD Bill Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=1&uhid_no=".$row3['mrd_no']."'  title='OPD Bill Generate' ><img src='". ADMIN_URL."icon/OPD-BIll.png'  title='OPD Bill Generate'></a> | <a onClick=\"if(confirm('Are you sure to IPD Bill Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=0&uhid_no=".$row3['mrd_no']."'  title='IPD Bill Generate' ><img src='". ADMIN_URL."icon/IPD-Bill.png'  title='IPD Bill Generate'></a> ";	

		}

		else{

			$action_tab="<button id='' class='btn btn-default green'><a onClick=\"if(confirm('Are you sure to register $pateint_name ?')) return true; else return false;\" href='".ADMIN_URL."registration_form_add.php?appt_id=0&patient_admission_type=2&old_db_id=".$old_db_id."&doc_id_appt=".$doc_id_appt."'  title='Register' style='color:white !important;font-weight:bold !important;'  >&nbsp; &nbsp; Add New Registration For New Software + &nbsp; &nbsp;</a></button> ";

			

		}



	}



	



		$arr[]=array("sl_no"=>$sl_no,"mrd_no"=>$row3['mrd_no'],"name"=>$row3['name'],"phone_no"=>$row3['phone_no'],"appt_time"=>$appt_time,"doctor_name"=>$row3['doctor_name'],"procedure_name"=>$row3['procedure_name'],"description"=>$row3['description'],"data_details"=>$data_details,"action_tab"=>$action_tab,"patient_reg_upload"=>$patient_reg_upload,"action_tab_new"=>$action_tab_new);



		



		$sl_no++; 



	}}



		echo json_encode($arr);



	







}

function load_ipd_admssion_details_for_walk_in(){







	global $conn;



	 $from_date = date("Y-m-d");

	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));

	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));



	$arr=array();



	$sl_no=1;



	$sql3="SELECT * FROM `patient_registration_form` WHERE DATE(`registration_date`)  BETWEEN '".$from_date."' AND  '".$to_date."' AND `del_flag`='0' AND  `patient_admission_type`='2' ORDER BY `id` DESC ";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	

						 	 $old_db_fetch=0;

							 $created_by="";

							 $modified_by="";				 

							 $patient_reg_upload="";		



							 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



							 $result7=$conn->query($sql7) ;				



							 $row7 = $result7->fetch_assoc();



							 $count7=$result7->num_rows;



							 if($count7>0)



							 {



								$created_by=$row7['name'];



							 }



							 



							 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



							 $result8=$conn->query($sql8) ;				



							 $row8 = $result8->fetch_assoc();



							 $count8=$result8->num_rows;



							 if($count8>0)



							 {



								$modified_by=$row8['name'];



							 } 



							 $admiting_doctor="";



							 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['admiting_doctor']."'";



							 $result9=$conn->query($sql9) ;				



							 $row9 = $result9->fetch_assoc();



							 $count9=$result9->num_rows;



							 if($count9>0)



							 {



								$admiting_doctor=$row9['name'];



							 }

							 

							 $sql12="SELECT `image_name` FROM `patient_reg_upload` Where `uhid_no`='".$row3['uhid_no']."'";



							 $result12=$conn->query($sql12) ;				



							 $row12 = $result12->fetch_assoc();



							 $count12=$result12->num_rows;



							 if($count12>0)



							 {



								$patient_reg_upload=$row12['image_name'];



							 }

			



	 $appt_time="";				



	 $appt_time =date("d-m-y",strtotime($row3['registration_date'])).'<br>'.date("H:i A",strtotime($row3['registration_time']));



	 



	 //patient_admission_type=1  ->  Appt Patient



	 //patient_admission_type=2  ->  Walk In Patient



	 //patient_admission_type=3  ->  Follow UP Patient



	$pateint_name=$row3['patient_name'].' ( '.$row3['phone_no'].'  '.$row3['uhid_no'].' )';



	 $modifiaction_details="";



	if($row3['modified_time']!=''){ 



	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 



	  } 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details;



	



	$action_tab="<a onClick=\"if(confirm('Are you sure to Edit for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."registration_form_edit.php?patient_registration_id=".$row3['id']."'  title='EDIT' ><img src='". ADMIN_URL."icon/bt_edit.gif'  title='Edit'></a> ";
	
	
	 
	 $action_tab_new="| <a href='".ADMIN_URL."print_card.php?id=".$row3['id']."'  target='_blank' title='Print UHID Card' ><img src='". ADMIN_URL."icon/PRINT-UHID.png'  title='Print UHID Card'></a> | <a onClick=\"if(confirm('Are you sure to Slip Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."slip_generate_form_add.php?uhid_no=".$row3['uhid_no']."'  title='Slip Generate' ><img src='". ADMIN_URL."icon/PRINT-Slip.png'  title='Slip Generate'></a> | <a onClick=\"if(confirm('Are you sure to OPD Bill Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=1&uhid_no=".$row3['uhid_no']."'  title='OPD Bill Generate' ><img src='". ADMIN_URL."icon/OPD-BIll.png'  title='OPD Bill Generate'></a> | <a onClick=\"if(confirm('Are you sure to IPD Bill Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=0&uhid_no=".$row3['uhid_no']."'  title='IPD Bill Generate' ><img src='". ADMIN_URL."icon/IPD-Bill.png'  title='IPD Bill Generate'></a> ";

	

	$action_tab_del="";

	if($row3['uhid_no']==''){

	$action_tab_del=" | <a onClick=\"if(confirm('Are you sure to Delete Walk In Patient for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."view_registration_form.php?delete_walk_in=".$row3['id']."'  title='Delete' ><img src='". ADMIN_URL."icon/delete.gif'  title='Delete'></a> ";

	$action_tab=$action_tab.$action_tab_del;

	}



		$arr[]=array("sl_no"=>$sl_no,"uhid_no"=>$row3['uhid_no'],"patient_name"=>$row3['patient_name'],"phone_no"=>$row3['phone_no'],"appt_time"=>$appt_time,"doctor_name"=>$admiting_doctor,"data_details"=>$data_details,"action_tab"=>$action_tab,"old_db_fetch"=>$old_db_fetch,"patient_reg_upload"=>$patient_reg_upload,"action_tab_new"=>$action_tab_new);







		



		$sl_no++; 



	}}

	

	

	$sql3="SELECT * FROM `patient_registration_form` WHERE DATE(`created_on`)  BETWEEN '".$from_date."' AND  '".$to_date."' AND `del_flag`='0' AND  `patient_admission_type`='2' ORDER BY `id` DESC ";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	

						 $check_reg_date=date("d-m-Y",strtotime($row3['registration_date']));

						 $check_created_on=date("d-m-Y",strtotime($row3['created_on']));

						 $patient_reg_upload="";

						 if($check_reg_date!=$check_created_on){

							 $old_db_fetch=1;

							$created_by="";



							 $modified_by="";					



							 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



							 $result7=$conn->query($sql7) ;				



							 $row7 = $result7->fetch_assoc();



							 $count7=$result7->num_rows;



							 if($count7>0)



							 {



								$created_by=$row7['name'];



							 }



							 



							 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



							 $result8=$conn->query($sql8) ;				



							 $row8 = $result8->fetch_assoc();



							 $count8=$result8->num_rows;



							 if($count8>0)



							 {



								$modified_by=$row8['name'];



							 } 



							 $admiting_doctor="";



							 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['admiting_doctor']."'";



							 $result9=$conn->query($sql9) ;				



							 $row9 = $result9->fetch_assoc();



							 $count9=$result9->num_rows;



							 if($count9>0)



							 {



								$admiting_doctor=$row9['name'];



							 }



						     $sql12="SELECT `image_name` FROM `patient_reg_upload` Where `uhid_no`='".$row3['uhid_no']."'";



							 $result12=$conn->query($sql12) ;				



							 $row12 = $result12->fetch_assoc();



							 $count12=$result12->num_rows;



							 if($count12>0)



							 {



								$patient_reg_upload=$row12['image_name'];



							 }

							 



			



	$appt_time="";				



	 $appt_time =date("d-m-y",strtotime($row3['registration_date'])).'<br>'.date("H:i A",strtotime($row3['registration_time']));



	 



	 //patient_admission_type=1  ->  Appt Patient



	 //patient_admission_type=2  ->  Walk In Patient



	 //patient_admission_type=3  ->  Follow UP Patient



	$pateint_name=$row3['patient_name'].' ( '.$row3['phone_no'].'  '.$row3['uhid_no'].' )';



	 $modifiaction_details="";



	if($row3['modified_time']!=''){ 



	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 



	  } 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details;



	



	$action_tab="<a onClick=\"if(confirm('Are you sure to Edit for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."registration_form_edit.php?patient_registration_id=".$row3['id']."'  title='EDIT' ><img src='". ADMIN_URL."icon/bt_edit.gif'  title='Edit'></a> ";



	$action_tab_del="";

	if($row3['uhid_no']==''){

	$action_tab_del=" | <a onClick=\"if(confirm('Are you sure to Delete Walk In Patient for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."view_registration_form.php?delete_walk_in=".$row3['id']."'  title='Delete' ><img src='". ADMIN_URL."icon/delete.gif'  title='Delete'></a> ";

	$action_tab=$action_tab.$action_tab_del;

	}



		$arr[]=array("sl_no"=>$sl_no,"uhid_no"=>$row3['uhid_no'],"patient_name"=>$row3['patient_name'],"phone_no"=>$row3['phone_no'],"appt_time"=>$appt_time,"doctor_name"=>$admiting_doctor,"data_details"=>$data_details,"action_tab"=>$action_tab,"old_db_fetch"=>$old_db_fetch,"patient_reg_upload"=>$patient_reg_upload);







		



		$sl_no++; 

		

						 }



	}}



		echo json_encode($arr);



	







}

function load_ipd_admssion_details_for_follow_up(){







	global $conn;



	 $from_date = date("Y-m-d");

	 

	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));

		 $to_date = date("Y-m-d", strtotime($_POST['to_date']));



	$arr=array();



	$sl_no=1;



	$sql3="SELECT `patient_registration_form`.`phone_no`,`patient_follow_up_form`.* FROM `patient_follow_up_form` INNER JOIN  `patient_registration_form` ON `patient_follow_up_form`.`registration_unique_id`=`patient_registration_form`.`id` WHERE DATE(`patient_follow_up_form`.`registration_date`)  BETWEEN '".$from_date."' AND  '".$to_date."' AND `patient_follow_up_form`.`del_flag`='0'  ORDER BY `patient_follow_up_form`.`id` DESC ";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	



							$created_by="";



							 $modified_by="";					



							 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



							 $result7=$conn->query($sql7) ;				



							 $row7 = $result7->fetch_assoc();



							 $count7=$result7->num_rows;



							 if($count7>0)



							 {



								$created_by=$row7['name'];



							 }



							 



							 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



							 $result8=$conn->query($sql8) ;				



							 $row8 = $result8->fetch_assoc();



							 $count8=$result8->num_rows;



							 if($count8>0)



							 {



								$modified_by=$row8['name'];



							 } 



							 $admiting_doctor="";



							 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['admiting_doctor']."'";



							 $result9=$conn->query($sql9) ;				



							 $row9 = $result9->fetch_assoc();



							 $count9=$result9->num_rows;



							 if($count9>0)



							 {



								$admiting_doctor=$row9['name'];



							 }



							 



			



	$appt_time="";				



	 $appt_time =date("d-m-y",strtotime($row3['registration_date'])).'<br>'.date("H:i A",strtotime($row3['registration_time']));



	 



	 //patient_admission_type=1  ->  Appt Patient



	 //patient_admission_type=2  ->  Walk In Patient



	 //patient_admission_type=3  ->  Follow UP Patient



	$pateint_name=$row3['patient_name'].' ( '.$row3['phone_no'].'  '.$row3['uhid_no'].' )';



	 $modifiaction_details="";



	if($row3['modified_time']!=''){ 



	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 



	  } 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details;



	



	$action_tab="<a onClick=\"if(confirm('Are you sure to Delete Follow Up for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."view_registration_form.php?delete=".$row3['id']."'  title='Delete' ><img src='". ADMIN_URL."icon/delete.gif'  title='Delete'></a> ";



	



		$arr[]=array("sl_no"=>$sl_no,"uhid_no"=>$row3['uhid_no'],"patient_name"=>$row3['patient_name'],"phone_no"=>$row3['phone_no'],"appt_time"=>$appt_time,"doctor_name"=>$admiting_doctor,"data_details"=>$data_details,"action_tab"=>$action_tab);







		



		$sl_no++; 



	}}



		echo json_encode($arr);



	







}

function load_ipd_admssion_details_for_slip_generated(){







	global $conn;



	 $from_date = date("Y-m-d");

	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));

	$to_date = date("Y-m-d", strtotime($_POST['to_date']));



	$arr=array();



	$sl_no=1;



	$sql3="SELECT `patient_slip_generate_form`.* FROM `patient_slip_generate_form` INNER JOIN  `patient_registration_form` ON `patient_slip_generate_form`.`registration_unique_id`=`patient_registration_form`.`id` WHERE DATE(`patient_slip_generate_form`.`registration_date`) BETWEEN '".$from_date."' AND  '".$to_date."' AND `patient_slip_generate_form`.`del_flag`='0'  ORDER BY `patient_slip_generate_form`.`id` DESC ";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	



							$created_by="";



							 $modified_by="";					



							 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



							 $result7=$conn->query($sql7) ;				



							 $row7 = $result7->fetch_assoc();



							 $count7=$result7->num_rows;



							 if($count7>0)



							 {



								$created_by=$row7['name'];



							 }



							 



							 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



							 $result8=$conn->query($sql8) ;				



							 $row8 = $result8->fetch_assoc();



							 $count8=$result8->num_rows;



							 if($count8>0)



							 {



								$modified_by=$row8['name'];



							 } 



							 $admiting_doctor="";



							 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['admiting_doctor']."'";



							 $result9=$conn->query($sql9) ;				



							 $row9 = $result9->fetch_assoc();



							 $count9=$result9->num_rows;



							 if($count9>0)



							 {



								$admiting_doctor=$row9['name'];



							 }



							 



			



	$appt_time="";				



	 $appt_time =date("d-m-y",strtotime($row3['registration_date'])).'<br>'.date("H:i A",strtotime($row3['registration_time']));



	 



	 //patient_admission_type=1  ->  Appt Patient



	 //patient_admission_type=2  ->  Walk In Patient



	 //patient_admission_type=3  ->  Follow UP Patient



	$pateint_name=$row3['patient_name'].' ( '.$row3['phone_no'].'  '.$row3['uhid_no'].' )';



	$slip_no=$row3['sl'];



	 $modifiaction_details="";



	if($row3['modified_time']!=''){ 



	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 



	  } 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details;

	$action_tab_new="";
	$action_tab="";

	$action_tab="<a onClick=\"if(confirm('Are you sure to Delete Slip for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."view_registration_form.php?delete_slip=".$row3['id']."'  title='Delete' ><img src='". ADMIN_URL."icon/delete.gif'  title='Delete'></a> | <a href='".ADMIN_URL."print_token.php?id=".$row3['id']."'  target='_blank' title='Print Slip' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print Slip'></a> ";

 $action_tab_new="| <a onClick=\"if(confirm('Are you sure to Slip Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."slip_generate_form_add.php?uhid_no=".$row3['uhid_no']."'  title='Slip Generate' ><img src='". ADMIN_URL."icon/PRINT-Slip.png'  title='Slip Generate'></a> | <a onClick=\"if(confirm('Are you sure to OPD Bill Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=1&uhid_no=".$row3['uhid_no']."'  title='OPD Bill Generate' ><img src='". ADMIN_URL."icon/OPD-BIll.png'  title='OPD Bill Generate'></a> | <a onClick=\"if(confirm('Are you sure to IPD Bill Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=0&uhid_no=".$row3['uhid_no']."'  title='IPD Bill Generate' ><img src='". ADMIN_URL."icon/IPD-Bill.png'  title='IPD Bill Generate'></a> ";	

	



		$arr[]=array("sl_no"=>$sl_no,"uhid_no"=>$row3['uhid_no'],"patient_name"=>$row3['patient_name'],"phone_no"=>$row3['phone_no'],"appt_time"=>$appt_time,"doctor_name"=>$admiting_doctor,"data_details"=>$data_details,"action_tab"=>$action_tab,"slip_no"=>$slip_no,"action_tab_new"=>$action_tab_new);







		



		$sl_no++; 



	}}



		echo json_encode($arr);



	







}

function load_final_billing_details(){







	global $conn;



	 $today = date("Y-m-d");

	 if($_POST['from_date']!=''){

	 	$from_date = date("Y-m-d", strtotime($_POST['from_date']));

	 }

	 if($_POST['to_date']!=''){

	 	$to_date = date("Y-m-d", strtotime($_POST['to_date']));

	 }

	 

	 $extra_query="";

	 $uhid_query="";

	 $date_query="";

	 $default_query="";

	  

	 $bill_type =$_POST['bill_type'];

	 if($bill_type=='3'){

		 $extra_query="";

	 }else{

		$extra_query=" AND `opd_flag`='".$bill_type."' ";

	 }

	 

	 $uhid_no_srch =$_POST['uhid_no_srch'];

	 if($uhid_no_srch==''){

		 $uhid_query="";

	 }else{

		$uhid_query=" AND `hospital_number`='".$uhid_no_srch."' ";

	 }

	 

	 if(($from_date=='')||($to_date=='')){

		 $date_query="";

	 }else{

		$date_query=" AND DATE(`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' ";

	 }

	 

	 if(($from_date=='')&&($to_date=='')&&($uhid_no_srch=='')){

		 $default_query=" AND DATE(`billing_date`) BETWEEN '".$today."' AND  '".$today."' ";

	 }

	 

	 

	$arr=array();



	$sl_no=1;



	$sql3=" SELECT * FROM `invoice_final_billing`  WHERE 1  $default_query $date_query $extra_query $uhid_query ORDER BY `id` DESC ";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	

						 $rowclass="#cfebcc";



						 



						 $created_by="None";



						 $modified_by="None";



						 $edited_by="None";

						 $primary_doctor="";



												



						 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



						 $result7=$conn->query($sql7) ;				



						 $row7 = $result7->fetch_assoc();



						 $count7=$result7->num_rows;



						 if($count7>0)



						 {



							$created_by=$row7['name'];



						 }



						 



						 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



						 $result8=$conn->query($sql8) ;				



						 $row8 = $result8->fetch_assoc();



						 $count8=$result8->num_rows;



						 if($count8>0)



						 {



							$modified_by=$row8['name'];



						 } 



						 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['deleted_by']."'";



						 $result9=$conn->query($sql9) ;				



						 $row9 = $result9->fetch_assoc();



						 $count9=$result9->num_rows;



						 if($count9>0)



						 {



							$deleted_by=$row9['name'];



						 }

						 

						 $sql10="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['one_time_edit_by']."'";



						 $result10=$conn->query($sql10) ;				



						 $row10 = $result10->fetch_assoc();



						 $count10=$result10->num_rows;



						 if($count10>0)



						 {



							$edited_by=$row10['name'];



						 }

						 

						 $sql11="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['doc_id']."'";



						 $result11=$conn->query($sql11) ;				



						 $row11 = $result11->fetch_assoc();



						 $count11=$result11->num_rows;



						 if($count11>0)



						 {



							$primary_doctor=$row11['name'];



						 }



						 



						 if($row3['status']=='3')



						 {



							 $rowclass="#ebcccc";



						 }



						 if(($row3['reason_for_edit']!='')&&($row3['remarks_for_edit']==''))



						 {



							 $rowclass="#ebe7cc";



						 }



						 if(($row3['reason_for_edit']!='')&&($row3['remarks_for_edit']!='')&&($row3['otp_status']=='0'))



						 {



							 $rowclass="#baaae3";



						 }



					  if(($row3['otp_status']=='1')&&($row3['open_for_edit_flag']=='1')&&($row3['one_time_edit_flag']=='0')){



						  $rowclass="#31badb";



					  }



					  if(($row3['otp_status']=='1')&&($row3['open_for_edit_flag']=='1')&&($row3['one_time_edit_flag']=='1')){



						  $rowclass="#7fbd78";



					  }



		if($row3['opd_flag']==1){

			$bill_for='OPD';

		}else{

			$bill_for='IPD';

		}	

		$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

		$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

		$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

		$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['billing_date'])) , "4/1", "3/31");

		$bill_no="";

		$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row3['invo_no'];

	

	 $billing_date="";	

	 $billing_date =date("d-m-Y", strtotime($row3['billing_date']));	



	 $modifiaction_details="";

	 $deleted_details="";

	 $edit_details="";

	 if($row3['opd_flag']=='1'){ $bill_type_name='OPD Bill';}else{ $bill_type_name='IPD Bill';}



	if($row3['modified_time']!=''){ 

	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 

    } 

	if($row3['deleted_time']!=''){

	 $deleted_details=" <b>Reason: </b> ".$row3['reason']."  <br/> <b>Cancel By: </b>". $deleted_by."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($row3['deleted_time']))."<br/>";

	 } 

	 if($row3['one_time_edit_time']!=''){

	 $edit_details=" <b>Edited By: </b> ".$edited_by."  <br/> <b>Edited On: </b>". date("d-m-Y h:i A", strtotime($row3['one_time_edit_time']))."<br/>";

	 } 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details."<br/>". $deleted_details."<br/>". $$edit_details;

	

	$action_tab1="";

	$action_tab_for_first="";

	$action_tab="";

	$action_tab2="";

	$action_tab3="";

	$action_tab4="";

	$action_tab5="";

	$action_tab6="";

	$action_tab7="";
	$action_tab8="";

	

	if($row3['del_flag']!='1'){

		if($row3['reason_for_edit']==''){

			//$action_tab1="<a href='javascript:void(0);' onclick='request_function_for_edit(".$row3['id'].");' title='Request For Edit' ><img src='". ADMIN_URL."icon/request_24x24.png'  title='Request For Edit'></a> | ";

		

		}

		if(($row3['reason_for_edit']!='')&&($row3['otp_status']=='0')){

			//$action_tab2="<a href='javascript:void(0);'  onclick='request_function_for_edit_after_otp(".$row3['id'].");' title='Request For Edit With OTP' ><img src='". ADMIN_URL."icon/otp_unlock_24x24.png'  title='Request For Edit With OTP'></a> | ";

		

		}

		if(($row3['otp_status']=='1')&&($row3['open_for_edit_flag']=='1')&&($row3['one_time_edit_flag']=='0')){ 

			//$action_tab3="<a href='".ADMIN_URL."invoice_final_billing_edit.php?id=".$row3['id']."' title='Edit' ><img src='". ADMIN_URL."icon/edit_bill_24x24.png'  title='Edit'></a> | ";

		

		}

		if($_SESSION['emr_pres_master_add_flag']=='1'){

			//$action_tab7=" <a href='".ADMIN_URL."invoice_final_billing_edit.php?id=".$row3['id']."' title='Edit' ><img src='". ADMIN_URL."icon/edit_bill_24x24.png'  title='Edit'></a> | ";
			
			$action_tab7="<a href='javascript:void(0);'  onclick='purpose(".$row3['id'].");' title='Cancel Bill' ><img src='". ADMIN_URL."icon/delete.gif'  title='Cancel Bill'></a> | ";

		}

		//$action_tab4=$action_tab7."<a href='javascript:void(0);'  onclick='purpose(".$row3['id'].");' title='Cancel Bill' ><img src='". ADMIN_URL."icon/delete.gif'  title='Cancel Bill'></a> | ";


	$action_tab4=" <a href='".ADMIN_URL."invoice_final_billing_edit.php?id=".$row3['id']."' title='Edit' ><img src='". ADMIN_URL."icon/edit_bill_24x24.png'  title='Edit'></a> | ".$action_tab7;
		

		$action_tab_for_first=$action_tab1.$action_tab2.$action_tab3.$action_tab4;

		$action_tab8=" | <a href='".ADMIN_URL."money_receipt_for_final_bill.php?id=".$row3['id']."' target='_blank' title='Print Money Receipt' ><img src='". ADMIN_URL."icon/money_reciept.png'  title='Print Money Receipt'></a> | <a href='javascript:void(0);'  onclick='check_sms_send(".$row3['id'].");' title='SMS Sent' ><img src='". ADMIN_URL."icon/sms_30x30.png'  title='SMS Sent'></a>";

	}

	if(($row3['opd_flag']=='1')){

	$action_tab5="<a href='".ADMIN_URL."print_final_bill_for_opd_new.php?id=".$row3['id']."' target='_blank' title='Print OPD Final Bill' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print OPD Final Bill'></a> ";

	}

	if(($row3['opd_flag']=='0')){

		$action_tab6="<a href='".ADMIN_URL."print_final_bill_for_ipd_new.php?id=".$row3['id']."' target='_blank' title='Print IPD Final Bill' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print IPD Final Bill'></a> <br/>| <a href='".ADMIN_URL."print_final_bill_for_ipd_tpa.php?id=".$row3['id']."' target='_blank' title='Print TPA Bill' ><img src='". ADMIN_URL."icon/bill-icon_tpa.png'  title='Print TPA Bill'></a> | <a href='".ADMIN_URL."print_tpa_cover_letter.php?id=".$row3['id']."' target='_blank' title='Print TPA Cover Letter' ><img src='". ADMIN_URL."icon/cover-letter.png'  title='Print TPA Cover Letter'></a>";

	}

	$action_tab=$action_tab_for_first.$action_tab5.$action_tab6.$action_tab8;



		$arr[]=array("sl_no"=>$sl_no,"hospital_number"=>$row3['hospital_number'],"name"=>$row3['name'],"mobile"=>$row3['mobile'],"billing_date"=>$billing_date,"primary_doctor"=>$primary_doctor,"bill_type_name"=>$bill_type_name,"total"=>$row3['total'],"data_details"=>$data_details,"action_tab"=>$action_tab,"rowclass"=>$rowclass,"bill_no"=>$bill_no,"bill_unique_id"=>$row3['id']);



		



		$sl_no++; 



	}}



		echo json_encode($arr);



	







}





function load_advance_billing_details(){







	global $conn;



	 

	 $today = date("Y-m-d");

	 if($_POST['from_date']!=''){

	 	$from_date = date("Y-m-d", strtotime($_POST['from_date']));

	 }

	 if($_POST['to_date']!=''){

	 	$to_date = date("Y-m-d", strtotime($_POST['to_date']));

	 }

	 

	 $extra_query="";

	 $uhid_query="";

	 $date_query="";

	 $default_query="";

	  

	 $bill_type =$_POST['bill_type'];

	 if($bill_type=='3'){

		 $extra_query="";

	 }else{

		$extra_query=" AND `opd_flag`='".$bill_type."' ";

	 }

	 

	 $uhid_no_srch =$_POST['uhid_no_srch'];

	 if($uhid_no_srch==''){

		 $uhid_query="";

	 }else{

		$uhid_query=" AND `hospital_number`='".$uhid_no_srch."' ";

	 }

	 

	 if(($from_date=='')||($to_date=='')){

		 $date_query="";

	 }else{

		$date_query=" AND DATE(`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' ";

	 }

	 

	 if(($from_date=='')&&($to_date=='')&&($uhid_no_srch=='')){

		 $default_query=" AND DATE(`billing_date`) BETWEEN '".$today."' AND  '".$today."' ";

	 }

	 

	$arr=array();



	$sl_no=1;



	 $sql3=" SELECT * FROM `adavnce_final_billing`  WHERE  1  $default_query $date_query $extra_query $uhid_query  ORDER BY `id` DESC ";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	

						 $rowclass="#cfebcc";



						 



						 $created_by="None";



						 $modified_by="None";



						 $edited_by="None";

						 $primary_doctor="";



												



						 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



						 $result7=$conn->query($sql7) ;				



						 $row7 = $result7->fetch_assoc();



						 $count7=$result7->num_rows;



						 if($count7>0)



						 {



							$created_by=$row7['name'];



						 }



						 



						 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



						 $result8=$conn->query($sql8) ;				



						 $row8 = $result8->fetch_assoc();



						 $count8=$result8->num_rows;



						 if($count8>0)



						 {



							$modified_by=$row8['name'];



						 } 



						 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['deleted_by']."'";



						 $result9=$conn->query($sql9) ;				



						 $row9 = $result9->fetch_assoc();



						 $count9=$result9->num_rows;



						 if($count9>0)



						 {



							$deleted_by=$row9['name'];



						 }

						 

						

						 $sql11="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['doc_id']."'";



						 $result11=$conn->query($sql11) ;				



						 $row11 = $result11->fetch_assoc();



						 $count11=$result11->num_rows;



						 if($count11>0)



						 {



							$primary_doctor=$row11['name'];



						 }



						 



						 if($row3['status']=='3')



						 {



							 $rowclass="#ebcccc";



						 }



						

			if($row3['opd_flag']==1){

				$bill_for='RECP/OPD';

			}else{

				$bill_for='RECP/IPD';

			}	

			$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

			$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

			$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

			$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['billing_date'])) , "4/1", "3/31");

			$bill_no="";

			$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row3['invo_no'];



	 $billing_date="";	

	 $billing_date =date("d-m-Y", strtotime($row3['billing_date']));	



	 $modifiaction_details="";

	 $deleted_details="";

	 $edit_details="";

	 if($row3['opd_flag']=='1'){ $bill_type_name='OPD Bill';}else{ $bill_type_name='IPD Bill';}



	if($row3['modified_time']!=''){ 

	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 

    } 

	if($row3['deleted_time']!=''){

	 $deleted_details=" <b>Reason: </b> ".$row3['reason']."  <br/> <b>Cancel By: </b>". $deleted_by."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($row3['deleted_time']))."<br/>";

	 } 

	 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details."<br/>". $deleted_details;

	

	

	$action_tab_for_first="";

	$action_tab="";	

	$action_tab4="";

	$action_tab5="";

	$action_tab7="";

	$action_tab_refnd="";

	if($_SESSION['emr_pres_master_add_flag']=='1'){

			$action_tab7="<a href='javascript:void(0);'  onclick='purpose(".$row3['id'].");' title='Cancel Bill' ><img src='". ADMIN_URL."icon/delete.gif'  title='Cancel Bill'></a> |";

	}

	

	if($row3['del_flag']!='1'){

		

		$action_tab4=" <a href='".ADMIN_URL."adavnce_final_billing_edit.php?id=".$row3['id']."' title='Edit' ><img src='". ADMIN_URL."icon/edit_bill_24x24.png'  title='Edit'></a> | ";

		

		$action_tab_for_first=$action_tab4;



	}

	

	

	$action_tab5="<a href='".ADMIN_URL."print_advance_final_bill.php?id=".$row3['id']."' target='_blank' title='Print Advance Final Bill' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print Advance Final Bill'></a> ";

	$action_tab_refnd=" | <a href='".ADMIN_URL."refund_advance_final_bill.php?id=".$row3['id']."' title='Refund Advance Final Bill' ><img src='". ADMIN_URL."icon/refund_icon.png'  title='Refund Advance Final Bill'></a> ";

	

	$action_tab=$action_tab_for_first.$action_tab7.$action_tab5.$action_tab_refnd;



		$arr[]=array("sl_no"=>$sl_no,"hospital_number"=>$row3['hospital_number'],"name"=>$row3['name'],"mobile"=>$row3['mobile'],"billing_date"=>$billing_date,"primary_doctor"=>$primary_doctor,"bill_type_name"=>$bill_type_name,"total"=>$row3['total'],"data_details"=>$data_details,"action_tab"=>$action_tab,"rowclass"=>$rowclass,"bill_no"=>$bill_no);



		



		$sl_no++; 



	}}



		echo json_encode($arr);



	







}

function discharge_summery_details(){

	global $conn;

	$from_date = date("Y-m-d");

	$from_date = date("Y-m-d", strtotime($_POST['from_date']));

	$to_date = date("Y-m-d", strtotime($_POST['to_date']));

	$extra_query=($_POST['uhid_no']=='') ? '' : ' and uhid_no='.$_POST['uhid_no'].'';	

	$arr=array();

	$sl_no=1;

	$sql3=" SELECT * FROM `patient_discharge_summary`  WHERE DATE(`created_on`) BETWEEN '".$from_date."' AND  '".$to_date."' and del_flag<>1 $extra_query  ORDER BY `id` DESC ";

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



		  if($modified_on!=''){ 

			$modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($modified_on)); 

		  } 

		  if($deleted_time!=''){

		   $deleted_details=" <b>Reason: </b> ".$row3['reason']."  <br/> <b>Cancel By: </b>". $deleted_by."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($deleted_time))."<br/>";

		   }

		  $data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($created_on))." ; <br/>". $modifiaction_details."<br/>". $deleted_details;

		 

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

		 $action_tab_delete='';

		$action_tab_delete="<a onClick=\"if(confirm('Are you sure to Delete Discharge Summery for $patient_name?')) return true; else return false;\" href='".ADMIN_URL."discharge_dashboadrd.php?discharge_id=".$id."'  title='Delete' ><img src='". ADMIN_URL."icon/delete.gif'  title='Delete'></a> ";



		  $action_tab='<a href="discharge_summary_from_edit.php?discharge_id='.$id.'" title="Discharge Summary '.$patient_name.'"><img src="'.ADMIN_URL.'icon/edit_bill_24x24.png" title="Edit"></a> | '.$action_tab_delete.' | <a href="discharge_summary_from_print.php?discharge_id='.$id.'" title="Print Discharge For '.$patient_name.'" target="_blank"><i class="fa fa-print"></i></a>';

		  

		$arr[]=array("sl_no"=>$sl_no,"prefix"=>$prefix,"uhid_no"=>$uhid_no,"patient_name"=>$patient_name,"phone_no"=>$phone_no,"dob"=>$dob,"age"=>$age,"gender"=>$gender,"admiting_doctor"=>$admiting_doctor,"registration_date"=>$registration_date,"registration_time"=>$registration_time,"discharge_date"=>$discharge_date,"discharge_time"=>$discharge_time,"data_details"=>$data_details,"action_tab"=>$action_tab);

		$sl_no++; 

	}

echo json_encode($arr);

}



function estimation_record_details(){

	global $conn;

	$from_date = date("Y-m-d");

	$from_date = date("Y-m-d", strtotime($_POST['from_date']));

	$to_date = date("Y-m-d", strtotime($_POST['to_date']));

	$extra_query=($_POST['uhid_no']=='') ? '' : ' and uhid_no='.$_POST['uhid_no'].'';	

	$arr=array();

	$sl_no=1;

	$sql3=" SELECT * FROM `estimation_form_details`  WHERE DATE(`created_on`) BETWEEN '".$from_date."' AND  '".$to_date."' and del_flag<>1 $extra_query  ORDER BY `id` DESC ";

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

			$gender_=$row131['gender'];

		 }



		  if($modified_on!=''){ 

			$modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($modified_on)); 

		  } 

		  if($deleted_time!=''){

		   $deleted_details=" <b>Reason: </b> ".$row3['reason']."  <br/> <b>Cancel By: </b>". $deleted_by."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($deleted_time))."<br/>";

		   }

		  $data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($created_on))." ; <br/>". $modifiaction_details."<br/>". $deleted_details;

		 

		 if($billing_date==''){

			 $billing_date='';

		 }else{

			$billing_date=date('d-m-Y', strtotime($billing_date));

		 }

		 if($billing_time==''){

			 $billing_time='';

			 

		 }else{

			$billing_time=date('h:i A', strtotime($billing_time));

		 }

		 

		 $action_tab_delete='';

		$action_tab_delete="<a onClick=\"if(confirm('Are you sure to Delete Discharge Summery for $patient_name?')) return true; else return false;\" href='".ADMIN_URL."estimation_dashboadrd.php?est_id=".$id."'  title='Delete' ><img src='". ADMIN_URL."icon/delete.gif'  title='Delete'></a> ";



		  $action_tab='<a href="estimation_form_billing_edit.php?est_id='.$id.'" title="Estimation Form Edit '.$patient_name.'"><img src="'.ADMIN_URL.'icon/edit_bill_24x24.png" title="Edit"></a> | '.$action_tab_delete.' | <a href="estimation_form_billing_print.php?est_id='.$id.'" title="Print Estimation Form For '.$patient_name.'" target="_blank"><i class="fa fa-print"></i></a>';

		  

		$arr[]=array("sl_no"=>$sl_no,"prefix"=>$prefix,"patient_name"=>$name,"address"=>$address,"mobile_prefix"=>$mobile_prefix,"mobile"=>$mobile,"age"=>$age,"admiting_doctor"=>$admiting_doctor,"pt_type"=>$pt_type,"gender"=>$gender_,"billing_date"=>$billing_date,"billing_time"=>$billing_time,"total"=>$total,"action_tab"=>$action_tab);

		$sl_no++; 

	}

echo json_encode($arr);

}





function load_refund_advance_billing_details(){







	global $conn;



	$today = date("Y-m-d");

	 if($_POST['from_date']!=''){

	 	$from_date = date("Y-m-d", strtotime($_POST['from_date']));

	 }

	 if($_POST['to_date']!=''){

	 	$to_date = date("Y-m-d", strtotime($_POST['to_date']));

	 }

	 

	 $extra_query="";

	 $uhid_query="";

	 $date_query="";

	 $default_query="";

	  

	 $bill_type =$_POST['bill_type'];

	 if($bill_type=='3'){

		 $extra_query="";

	 }else{

		$extra_query=" AND `opd_flag`='".$bill_type."' ";

	 }

	 

	 $uhid_no_srch =$_POST['uhid_no_srch'];

	 if($uhid_no_srch==''){

		 $uhid_query="";

	 }else{

		$uhid_query=" AND `hospital_number`='".$uhid_no_srch."' ";

	 }

	 

	 if(($from_date=='')||($to_date=='')){

		 $date_query="";

	 }else{

		$date_query=" AND DATE(`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' ";

	 }

	 

	 if(($from_date=='')&&($to_date=='')&&($uhid_no_srch=='')){

		 $default_query=" AND DATE(`billing_date`) BETWEEN '".$today."' AND  '".$today."' ";

	 }

	 

	$arr=array();



	$sl_no=1;



	 $sql3=" SELECT * FROM `refund_adavnce_final_billing`  WHERE 1  $default_query $date_query $extra_query $uhid_query  ORDER BY `id` DESC ";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	

						 $rowclass="#cfebcc";



						 



						 $created_by="None";



						 $modified_by="None";



						 $edited_by="None";

						 $primary_doctor="";



												



						 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



						 $result7=$conn->query($sql7) ;				



						 $row7 = $result7->fetch_assoc();



						 $count7=$result7->num_rows;



						 if($count7>0)



						 {



							$created_by=$row7['name'];



						 }



						 



						 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



						 $result8=$conn->query($sql8) ;				



						 $row8 = $result8->fetch_assoc();



						 $count8=$result8->num_rows;



						 if($count8>0)



						 {



							$modified_by=$row8['name'];



						 } 



						 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['deleted_by']."'";



						 $result9=$conn->query($sql9) ;				



						 $row9 = $result9->fetch_assoc();



						 $count9=$result9->num_rows;



						 if($count9>0)



						 {



							$deleted_by=$row9['name'];



						 }

						 

						

						 $sql11="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['doc_id']."'";



						 $result11=$conn->query($sql11) ;				



						 $row11 = $result11->fetch_assoc();



						 $count11=$result11->num_rows;



						 if($count11>0)



						 {



							$primary_doctor=$row11['name'];



						 }



						 



						 if($row3['status']=='3')



						 {



							 $rowclass="#ebcccc";



						 }



						

			if($row3['opd_flag']==1){

				$bill_for='REF/OPD';

			}else{

				$bill_for='REF/IPD';

			}	

			$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

			$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

			$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

			$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['billing_date'])) , "4/1", "3/31");

			$bill_no="";

			$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row3['invo_no'];



	 $billing_date="";	

	 $billing_date =date("d-m-Y", strtotime($row3['billing_date']));	



	 $modifiaction_details="";

	 $deleted_details="";

	 $edit_details="";

	 if($row3['opd_flag']=='1'){ $bill_type_name='OPD Bill';}else{ $bill_type_name='IPD Bill';}



	if($row3['modified_time']!=''){ 

	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 

    } 

	if($row3['deleted_time']!=''){

	 $deleted_details=" <b>Reason: </b> ".$row3['reason']."  <br/> <b>Cancel By: </b>". $deleted_by."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($row3['deleted_time']))."<br/>";

	 } 

	 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details."<br/>". $deleted_details;

	

	

	$action_tab_for_first="";

	$action_tab="";	

	$action_tab4="";

	$action_tab5="";

	$action_tab7="";

	$action_tab_refnd="";

	

	if($row3['del_flag']!='1'){

		

		$action_tab4="<a href='javascript:void(0);'  onclick='purpose(".$row3['id'].");' title='Cancel Bill' ><img src='". ADMIN_URL."icon/delete.gif'  title='Cancel Bill'></a> | ";

		

		$action_tab_for_first=$action_tab4;



	}

	

	

	$action_tab5="<a href='".ADMIN_URL."print_refund_advance_final_bill.php?id=".$row3['id']."' target='_blank' title='Print Refund Advance Final Bill' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print Advance Final Bill'></a> ";

	

	

	$action_tab=$action_tab7.$action_tab_for_first.$action_tab5.$action_tab_refnd;



		$arr[]=array("sl_no"=>$sl_no,"hospital_number"=>$row3['hospital_number'],"name"=>$row3['name'],"mobile"=>$row3['mobile'],"billing_date"=>$billing_date,"primary_doctor"=>$primary_doctor,"bill_type_name"=>$bill_type_name,"total"=>$row3['total'],"data_details"=>$data_details,"action_tab"=>$action_tab,"rowclass"=>$rowclass,"bill_no"=>$bill_no);



		



		$sl_no++; 



	}}



		echo json_encode($arr);



	







}	



function load_final_billing_details_for_draft_bill(){







	global $conn;



	 $today = date("Y-m-d");

	 if($_POST['from_date']!=''){

	 	$from_date = date("Y-m-d", strtotime($_POST['from_date']));

	 }

	 if($_POST['to_date']!=''){

	 	$to_date = date("Y-m-d", strtotime($_POST['to_date']));

	 }

	 

	 $extra_query="";

	 $uhid_query="";

	 $date_query="";

	 $default_query="";

	  

	 $bill_type =$_POST['bill_type'];

	 if($bill_type=='3'){

		 $extra_query="";

	 }else{

		$extra_query=" AND `opd_flag`='".$bill_type."' ";

	 }

	 

	 $uhid_no_srch =$_POST['uhid_no_srch'];

	 if($uhid_no_srch==''){

		 $uhid_query="";

	 }else{

		$uhid_query=" AND `hospital_number`='".$uhid_no_srch."' ";

	 }

	 

	 if(($from_date=='')||($to_date=='')){

		 $date_query="";

	 }else{

		$date_query=" AND DATE(`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' ";

	 }

	 

	 if(($from_date=='')&&($to_date=='')&&($uhid_no_srch=='')){

		 $default_query=" AND DATE(`billing_date`) BETWEEN '".$today."' AND  '".$today."' ";

	 }

	 

	 

	$arr=array();



	$sl_no=1;



	$sql3=" SELECT * FROM `invoice_final_billing_for_draft_bill`  WHERE 1  $default_query $date_query $extra_query $uhid_query ORDER BY `id` DESC ";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	

						 $rowclass="#cfebcc";



						 



						 $created_by="None";



						 $modified_by="None";



						 $edited_by="None";

						 $primary_doctor="";



												



						 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



						 $result7=$conn->query($sql7) ;				



						 $row7 = $result7->fetch_assoc();



						 $count7=$result7->num_rows;



						 if($count7>0)



						 {



							$created_by=$row7['name'];



						 }



						 



						 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



						 $result8=$conn->query($sql8) ;				



						 $row8 = $result8->fetch_assoc();



						 $count8=$result8->num_rows;



						 if($count8>0)



						 {



							$modified_by=$row8['name'];



						 } 



						 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['deleted_by']."'";



						 $result9=$conn->query($sql9) ;				



						 $row9 = $result9->fetch_assoc();



						 $count9=$result9->num_rows;



						 if($count9>0)



						 {



							$deleted_by=$row9['name'];



						 }

						 

						 $sql10="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['one_time_edit_by']."'";



						 $result10=$conn->query($sql10) ;				



						 $row10 = $result10->fetch_assoc();



						 $count10=$result10->num_rows;



						 if($count10>0)



						 {



							$edited_by=$row10['name'];



						 }

						 

						 $sql11="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['doc_id']."'";



						 $result11=$conn->query($sql11) ;				



						 $row11 = $result11->fetch_assoc();



						 $count11=$result11->num_rows;



						 if($count11>0)



						 {



							$primary_doctor=$row11['name'];



						 }



						 



						 if($row3['status']=='3')



						 {



							 $rowclass="#ebcccc";



						 }



						 if(($row3['reason_for_edit']!='')&&($row3['remarks_for_edit']==''))



						 {



							 $rowclass="#ebe7cc";



						 }



						 if(($row3['reason_for_edit']!='')&&($row3['remarks_for_edit']!='')&&($row3['otp_status']=='0'))



						 {



							 $rowclass="#baaae3";



						 }



					  if(($row3['otp_status']=='1')&&($row3['open_for_edit_flag']=='1')&&($row3['one_time_edit_flag']=='0')){



						  $rowclass="#31badb";



					  }



					  if(($row3['otp_status']=='1')&&($row3['open_for_edit_flag']=='1')&&($row3['one_time_edit_flag']=='1')){



						  $rowclass="#7fbd78";



					  }



		if($row3['opd_flag']==1){

			$bill_for='OPD';

		}else{

			$bill_for='IPD';

		}	

		$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

		$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

		$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

		$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['billing_date'])) , "4/1", "3/31");

		$bill_no="";

		$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/DRF/'.$row3['invo_no'];

	

	 $billing_date="";	

	 $billing_date =date("d-m-Y", strtotime($row3['billing_date']));	



	 $modifiaction_details="";

	 $deleted_details="";

	 $edit_details="";

	 if($row3['opd_flag']=='1'){ $bill_type_name='OPD Bill';}else{ $bill_type_name='IPD Bill';}



	if($row3['modified_time']!=''){ 

	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 

    } 

	if($row3['deleted_time']!=''){

	 $deleted_details=" <b>Reason: </b> ".$row3['reason']."  <br/> <b>Cancel By: </b>". $deleted_by."  <br/> <b>Cancel On: </b>". date("d-m-Y h:i A", strtotime($row3['deleted_time']))."<br/>";

	 } 

	 if($row3['one_time_edit_time']!=''){

	 $edit_details=" <b>Edited By: </b> ".$edited_by."  <br/> <b>Edited On: </b>". date("d-m-Y h:i A", strtotime($row3['one_time_edit_time']))."<br/>";

	 } 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details."<br/>". $deleted_details."<br/>". $$edit_details;

	

	$action_tab1="";

	$action_tab_for_first="";

	$action_tab="";

	$action_tab2="";

	$action_tab3="";

	$action_tab4="";

	$action_tab5="";

	$action_tab6="";

	$action_tab7="";

	

	if($row3['del_flag']!='1'){

	
		$action_tab4=$action_tab7."<a href='javascript:void(0);'  onclick='purpose(".$row3['id'].");' title='Cancel Bill' ><img src='". ADMIN_URL."icon/delete.gif'  title='Cancel Bill'></a> | ";

		

		$action_tab_for_first=$action_tab4;



	}

	if(($row3['opd_flag']=='1')){

	$action_tab5="<a href='".ADMIN_URL."print_final_bill_for_opd_new_for_draft_bill.php?id=".$row3['id']."' target='_blank' title='Print OPD Draft Bill' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print OPD Draft Bill'></a> ";

	}

	if(($row3['opd_flag']=='0')){

		$action_tab6="<a href='".ADMIN_URL."print_final_bill_for_ipd_new_for_draft_bill.php?id=".$row3['id']."' target='_blank' title='Print IPD Draft Bill' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print IPD Draft Bill'></a> <br/>";

	}

	$action_tab=$action_tab_for_first.$action_tab5.$action_tab6;



		$arr[]=array("sl_no"=>$sl_no,"hospital_number"=>$row3['hospital_number'],"name"=>$row3['name'],"mobile"=>$row3['mobile'],"billing_date"=>$billing_date,"primary_doctor"=>$primary_doctor,"bill_type_name"=>$bill_type_name,"total"=>$row3['total'],"data_details"=>$data_details,"action_tab"=>$action_tab,"rowclass"=>$rowclass,"bill_no"=>$bill_no,"bill_unique_id"=>$row3['id']);



		



		$sl_no++; 



	}}



		echo json_encode($arr);



	







}


function load_ipd_admssion_details_for_reg_by_pat(){







	global $conn;



	 $from_date = date("Y-m-d");

	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));

	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));



	$arr=array();



	$sl_no=1;



	$sql3="SELECT * FROM `patient_registration_form_by_patient` WHERE DATE(`registration_date`)  BETWEEN '".$from_date."' AND  '".$to_date."' AND `del_flag`='0'   AND `patient_register_flag`='0' ORDER BY `id` ASC";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	

						 	 $old_db_fetch=0;

							 $created_by="";

							 $modified_by="";				 

							 $patient_reg_upload="";		



							 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



							 $result7=$conn->query($sql7) ;				



							 $row7 = $result7->fetch_assoc();



							 $count7=$result7->num_rows;



							 if($count7>0)



							 {



								$created_by=$row7['name'];



							 }



							 



							 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



							 $result8=$conn->query($sql8) ;				



							 $row8 = $result8->fetch_assoc();



							 $count8=$result8->num_rows;



							 if($count8>0)



							 {



								$modified_by=$row8['name'];



							 } 



							 $admiting_doctor="";



							 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['admiting_doctor']."'";



							 $result9=$conn->query($sql9) ;				



							 $row9 = $result9->fetch_assoc();



							 $count9=$result9->num_rows;



							 if($count9>0)



							 {



								$admiting_doctor=$row9['name'];



							 }

							 

							 $sql12="SELECT `image_name` FROM `patient_reg_upload` Where `uhid_no`='".$row3['uhid_no']."'";



							 $result12=$conn->query($sql12) ;				



							 $row12 = $result12->fetch_assoc();



							 $count12=$result12->num_rows;



							 if($count12>0)



							 {



								$patient_reg_upload=$row12['image_name'];



							 }

			



	 $appt_time="";				



	 $appt_time =date("d-m-y",strtotime($row3['registration_date'])).'<br>'.date("H:i A",strtotime($row3['registration_time']));



	 
	$pateint_name=$row3['patient_name'].' ( '.$row3['phone_no'].'  '.$row3['uhid_no'].' )';



	 $modifiaction_details="";



	if($row3['modified_time']!=''){ 



	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 



	  } 

$created_by="Patient Self";

	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details;



	$action_tab='';

	if($row3['uhid_no']==''){
	$action_tab="<a onClick=\"if(confirm('Are you sure to UHID Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."registration_form_add.php?appt_id=0&patient_admission_type=2&register_by_pat_id=".$row3['id']."'  title='Registration' ><img src='". ADMIN_URL."icon/add-button.png'  title='Registration'></a> ";	
	}
	
	$action_tab_del="";

	


		$arr[]=array("sl_no"=>$sl_no,"uhid_no"=>$row3['uhid_no'],"patient_name"=>$row3['patient_name'],"phone_no"=>$row3['phone_no'],"appt_time"=>$appt_time,"doctor_name"=>$admiting_doctor,"data_details"=>$data_details,"action_tab"=>$action_tab,"old_db_fetch"=>$old_db_fetch,"patient_reg_upload"=>$patient_reg_upload);







		$sl_no++; 



	}}
	
	$sql3="SELECT * FROM `patient_registration_form_by_patient` WHERE DATE(`registration_date`)  BETWEEN '".$from_date."' AND  '".$to_date."' AND `del_flag`='0'   AND `patient_register_flag`='1' ORDER BY `id` ASC";                   



	 $result3=$conn->query($sql3) ;



	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	

						 	 $old_db_fetch=0;

							 $created_by="";

							 $modified_by="";				 

							 $patient_reg_upload="";		



							 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";



							 $result7=$conn->query($sql7) ;				



							 $row7 = $result7->fetch_assoc();



							 $count7=$result7->num_rows;



							 if($count7>0)



							 {



								$created_by=$row7['name'];



							 }
							$created_by="Patient Self";


							 



							 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";



							 $result8=$conn->query($sql8) ;				



							 $row8 = $result8->fetch_assoc();



							 $count8=$result8->num_rows;



							 if($count8>0)



							 {



								$modified_by=$row8['name'];



							 } 



							 $admiting_doctor="";



							 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['admiting_doctor']."'";



							 $result9=$conn->query($sql9) ;				



							 $row9 = $result9->fetch_assoc();



							 $count9=$result9->num_rows;



							 if($count9>0)



							 {



								$admiting_doctor=$row9['name'];



							 }

							 

							 $sql12="SELECT `image_name` FROM `patient_reg_upload` Where `uhid_no`='".$row3['uhid_no']."'";



							 $result12=$conn->query($sql12) ;				



							 $row12 = $result12->fetch_assoc();



							 $count12=$result12->num_rows;



							 if($count12>0)



							 {



								$patient_reg_upload=$row12['image_name'];



							 }

			



	 $appt_time="";				



	 $appt_time =date("d-m-y",strtotime($row3['registration_date'])).'<br>'.date("H:i A",strtotime($row3['registration_time']));



	 
	$pateint_name=$row3['patient_name'].' ( '.$row3['phone_no'].'  '.$row3['uhid_no'].' )';



	 $modifiaction_details="";



	if($row3['modified_time']!=''){ 



	  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 



	  } 



	$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details;



	$action_tab='';
	
	 $action_tab_new="";

	if($row3['uhid_no']==''){
	$action_tab="<a onClick=\"if(confirm('Are you sure to UHID Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."registration_form_add.php?appt_id=0&patient_admission_type=2&register_by_pat_id=".$row3['id']."'  title='Registration' ><img src='". ADMIN_URL."icon/add-button.png'  title='Registration'></a> ";	
	}else{
		
	$action_tab="<a onClick=\"if(confirm('Are you sure to Edit for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."registration_form_edit.php?patient_registration_id=".$row3['id']."'  title='EDIT' ><img src='". ADMIN_URL."icon/bt_edit.gif'  title='Edit'></a> ";
	
	
	 
	 $action_tab_new="| <a href='".ADMIN_URL."print_card.php?id=".$row3['patient_admission_id']."'  target='_blank' title='Print UHID Card' ><img src='". ADMIN_URL."icon/PRINT-UHID.png'  title='Print UHID Card'></a> | <a onClick=\"if(confirm('Are you sure to Slip Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."slip_generate_form_add.php?uhid_no=".$row3['uhid_no']."'  title='Slip Generate' ><img src='". ADMIN_URL."icon/PRINT-Slip.png'  title='Slip Generate'></a> | <a onClick=\"if(confirm('Are you sure to OPD Bill Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=1&uhid_no=".$row3['uhid_no']."'  title='OPD Bill Generate' ><img src='". ADMIN_URL."icon/OPD-BIll.png'  title='OPD Bill Generate'></a> | <a onClick=\"if(confirm('Are you sure to IPD Bill Generate for $pateint_name?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=0&uhid_no=".$row3['uhid_no']."'  title='IPD Bill Generate' ><img src='". ADMIN_URL."icon/IPD-Bill.png'  title='IPD Bill Generate'></a> ";	
	}
	
	$action_tab_del="";

	


		$arr[]=array("sl_no"=>$sl_no,"uhid_no"=>$row3['uhid_no'],"patient_name"=>$row3['patient_name'],"phone_no"=>$row3['phone_no'],"appt_time"=>$appt_time,"doctor_name"=>$admiting_doctor,"data_details"=>$data_details,"action_tab"=>$action_tab,"old_db_fetch"=>$old_db_fetch,"patient_reg_upload"=>$patient_reg_upload,"action_tab_new"=>$action_tab_new);







		$sl_no++; 



	}}


	

	



		echo json_encode($arr);



	







}



function load_ipd_admssion_details_for_emr_details(){







	global $conn; 
	
	
	
	 $today = date("Y-m-d");

	 if($_POST['from_date']!=''){

	 	$from_date = date("Y-m-d", strtotime($_POST['from_date']));

	 }

	 if($_POST['to_date']!=''){

	 	$to_date = date("Y-m-d", strtotime($_POST['to_date']));

	 }

	 

	 $extra_query="";

	 $uhid_query="";

	 $date_query="";

	 $default_query="";

	  if($_SESSION['role']=='5'){

		$extra_query=" AND `prescription_details_for_emr`.`primary_doctor`='".$_SESSION['id']."' ";

	  }

	 $uhid_no_srch =$_POST['uhid_no_srch'];

	 if($uhid_no_srch==''){

		 $uhid_query="";

	 }else{

		$uhid_query=" AND `prescription_details_for_emr`.`mrd_no`='".$uhid_no_srch."' ";

	 }

	 

	 if(($from_date=='')||($to_date=='')){

		 $date_query="";

	 }else{

		$date_query=" AND DATE(`prescription_details_for_emr`.`created_on`) BETWEEN '".$from_date."' AND  '".$to_date."' ";

	 }

	 

	 if(($from_date=='')&&($to_date=='')&&($uhid_no_srch=='')){

		 $default_query=" AND DATE(`prescription_details_for_emr`.`created_on`) BETWEEN '".$today."' AND  '".$today."' ";

	 }

	 

	 

	$arr=array();



	$sl_no=1;



	
	
	$sql3="SELECT `prescription_details_for_emr`.`id`,`prescription_details_for_emr`.`mrd_no`,`prefix_masters`.`prefix_name`,`prescription_details_for_emr`.`fname`,`prescription_details_for_emr`.`lname`,`prescription_details_for_emr`.`age`,`prescription_details_for_emr`.`investigation`,`prescription_details_for_emr`.`created_on`,`prescription_details_for_emr`.`temp_save`,`prescription_details_for_emr`.`dilatation`,`prescription_details_for_emr`.`dilatation_time`,`prescription_details_for_emr`.`username77`,`prescription_details_for_emr`.`print_prescription`,`prescription_details_for_emr`.`termination`,`purposevisit_masters_for_emr`.`purpose_visit` AS `purpose_visit_name`,`prescription_details_for_emr`.`next_visit_day`,`prescription_details_for_emr`.`next_visit_week`,`prescription_details_for_emr`.`next_visit_month`,`prescription_details_for_emr`.`next_visit_year`,`prescription_details_for_emr`.`mobile`,`prescription_details_for_emr`.`surgery`,`prescription_details_for_emr`.`procedure_comments`,`user_infos`.`name` AS `doc_name`,`prescription_details_for_emr`.`no_dialation`,`prescription_details_for_emr`.`no_dialation_reason`,`prescription_details_for_emr`.`terminted_on`,`prescription_details_for_emr`.`primary_doctor`,`prescription_details_for_emr`.`wrdoby` FROM `prescription_details_for_emr` LEFT JOIN `purposevisit_masters_for_emr` ON `prescription_details_for_emr`.`purpose_visit_id`= `purposevisit_masters_for_emr`.`id` INNER JOIN `user_infos` ON `prescription_details_for_emr`.`primary_doctor`= `user_infos`.`users_id` INNER JOIN `prefix_masters` ON `prescription_details_for_emr`.`prefix`= `prefix_masters`.`id` WHERE 1 $default_query $date_query $extra_query $uhid_query AND `prescription_details_for_emr`.`del_flag`='0'  ORDER BY `prescription_details_for_emr`.`termination` ASC, `prescription_details_for_emr`.`id` DESC LIMIT 1000 ";               



	 $result3=$conn->query($sql3) ;


	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	



							$rowclass="";

					 	if($row3['username77']!=''){

							$rowclass="#f59f01";

						}

						if($row3['dilatation']=='1'){

							$rowclass="#92bce0";

						}

						if($row3['print_prescription']=='1'){

							$rowclass="#d0e9c6";

						}						

						

						if($row3['terminted_on']!=''){

						$assigned_time_new = $row3['created_on'];

						$completed_time_new= $row3['terminted_on'];   

						$d1_new = new DateTime($assigned_time_new);

						$d2_new = new DateTime($completed_time_new);

						$interval_new = $d2_new->diff($d1_new);

						$time_taken=$interval_new->format('%H');

						$time_taken_minutes=$interval_new->format('%I');

						

						if($time_taken=='01'){

							if($time_taken_minutes>'29'){

							$rowclass="#10c52f";

							}

						}else{


							$rowclass="#ed420f";

						}

						

						}

						if($row3['termination']=='1'){

							$rowclass="#ebcccc";

						}						

						

						$optom_name="";

						if($row3['username77']!=''){

							$sql25="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['username77']."'";

								 $result25=$conn->query($sql25) ;				

								 $row25 = $result25->fetch_assoc();

								 $count25=$result25->num_rows;

								 if($count25>0)

								 {

									$optom_name=$row25['name'];

								 }

						}


	$pateint_name="";
	$pateint_others_test="";
		
	$id=$row3['id'];

	$mrd_no=$row3['mrd_no'];
	$pateint_name=$row3['prefix_name'].' '.$row3['fname'].' '.$row3['lname'].'<br/> Age: '.$row3['age'].'<br/> Mobile No.: '.$row3['mobile'];
	$patient_name=$row3['prefix_name'].' '.$row3['fname'].' '.$row3['lname'];	


	$purpose_visit_name=$row3['purpose_visit_name'];

	$pateint_others_test='Investigation: '.limit_text($row3['investigation'], 4).'<br/> Surgery Advice: '.limit_text($row3['surgery'], 4).'<br/> Procedure Advice: '. limit_text($row3['procedure_comments'], 4);	

	 $modifiaction_details="";



	if($row3['terminted_on']!=''){ 	
		$assigned_time = $row3['created_on'];		
		$completed_time= $row3['terminted_on'];  		
		$d1 = new DateTime($assigned_time);		
		$d2 = new DateTime($completed_time);		
		$interval = $d2->diff($d1);		
		$desired_time_int= $interval->format('%H hours, %I minutes, %S seconds');                       

	  $modifiaction_details=' <br /><b>Print Prescription time / Terminated Time: </b> '. date("h:i A", strtotime($row3['terminted_on'])).'<br /> <b>Prescription Duration Time: </b>'.$desired_time_int; 
	  } 



	$data_details=date("d/m/Y", strtotime($row3['created_on'])).'<br/><b>Starting time : </b> '.date("h:i A", strtotime($row3['created_on'])). $modifiaction_details;

	$dialation="";
	if(($row3['dilatation']==1)&&($row3['dilatation_time']!='')){		
		$dialation=date('h:i A',strtotime($row3['dilatation_time']));
	}else if(($row3['no_dialation']==1)&&($row3['no_dialation_reason']!='')){
		 $dialation='<b>Reason Of No Dilatation : </b>'.$row3['no_dialation_reason'];
	} else{ $dialation='--';}
	$optom_name=$optom_name;
	$pri_doct="";
	$pri_doct=$row3['doc_name'];

	
	
	$action_tab="<a href='".ADMIN_URL."edit_prescription_for_emr.php?id=".$row3['id']."'  title='Edit Prescription' ><img src='". ADMIN_URL."icon/bt_edit.gif'  title='Edit Prescription'></a> | <a href='".ADMIN_URL."edit_prescription_for_emr_for_mobile.php?id=".$row3['id']."'  title='Edit Prescription for Mobile' ><img src='". ADMIN_URL."icon/mob_edit.png'  title='Edit Prescription for Mobile'></a> | <a href='".ADMIN_URL."printPrescription_for_emr.php?id=".$row3['id']."' target='_blank' title='Print Prescription' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print Prescription'></a> | <a href='javascript:void(0);' onclick='check(".$row3['id'].");' title='Download Attachments' ><img src='". ADMIN_URL."icon/download_icon.png'  title='Download Attachments'></a> | <a href='".ADMIN_URL."sepGlassprescription_for_emr.php?id=".$row3['id']."' target='_blank' title='Print Glass Prescription' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print Glass Prescription'></a> | <a onClick=\"if(confirm('Are you sure to Delete for $patient_name?')) return true; else return false;\" href='".ADMIN_URL."?delete=".$row3['id']."'  title='Delete' ><img src='". ADMIN_URL."icon/delete.gif'  title='Delete'></a> | <a href='".ADMIN_URL."sepMedication_for_emr.php?id=".$row3['id']."' target='_blank' title='Print Medication Prescription' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print Medication Prescription'></a> | <a onClick=\"if(confirm('Are you sure to terminate for $patient_name?')) return true; else return false;\" href='".ADMIN_URL."?terminate=".$row3['id']."&termination=".$row3['termination']."&mobile=".$row3['mobile']."&nextday=".$row3['next_visit_day']."&nextweek=".$row3['next_visit_week']."&nextmonth=".$row3['next_visit_month']."&nextyear=".$row3['next_visit_year']."&fname=".$row3['fname']."&lname=".$row3['lname']."&mrd_no=".$row3['mrd_no']."'  title='Terminate ' ><img src='". ADMIN_URL."icon/terminate.png'  title='Terminate '></a> | <a href='".ADMIN_URL."oldpatient_search_for_emr.php?id=".$row3['id']."&mrd=".$row3['mrd_no']."' target='_blank' title='Old Prescription Archive' ><img src='". ADMIN_URL."icon/arrow.png'  title='Old Prescription Archive'></a> | <a href='javascript:void(0);' onclick='check3(".$row3['id'].");' title='Download Camera Attachments' ><img src='". ADMIN_URL."icon/download_icon.png'  title='Download Camera Attachments'></a> | <a href='javascript:void(0);' onclick='check_sms_send(".$row3['id'].");' title='SMS Message Send' ><img src='". ADMIN_URL."icon/sms_30x30.png'  title='SMS Message Send'></a>";




		$arr[]=array("sl_no"=>$sl_no,"id"=>$id,"rowclass"=>$rowclass,"mrd_no"=>$mrd_no,"pateint_name"=>$pateint_name,"purpose_visit_name"=>$purpose_visit_name,"pateint_others_test"=>$pateint_others_test,"data_details"=>$data_details,"dialation"=>$dialation,"optom_name"=>$optom_name,"pri_doct"=>$pri_doct,"action_tab"=>$action_tab);



		$sl_no++; 



	}}



		echo json_encode($arr);



	







}




?>