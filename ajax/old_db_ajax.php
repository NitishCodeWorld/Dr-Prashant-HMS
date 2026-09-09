<?php

include '../conn.php';

$flag=$_GET["flag"];
if($flag=="1"){		

	load_old_pt_details();	

}

else if($flag=="2"){		

	fetch_old_pt_details();	

}else if($flag=="3"){		

	load_old_pt_details_for_appt();	

}
else if($flag=="4"){		

	phone_change();	

}else if($flag=="5"){		

	load_reg_by_patient();	

}
else{

	echo "Flag  Not Selected";		

}
function load_old_pt_details(){
	global $conn;
	$arr=array();
	$type=$_REQUEST["type"];
	$srch=$_REQUEST["srch"];
	$page_name=$_REQUEST["page_name"];
	
	 if($type=='1'){

		$sql3="SELECT * FROM `patient_registration_form_old_db` WHERE `uhid_no`='".$srch."' AND `uhid_no`<>'' AND reg_for_new_db_flag='0' ORDER BY `id` DESC";
	}
	 if($type=='2'){

		$sql3="SELECT * FROM `patient_registration_form_old_db` WHERE `patient_name` LIKE '%".$srch."%' AND `patient_name`<>'' AND reg_for_new_db_flag='0' ORDER BY `id` DESC";
	}
	 if($type=='3'){

		$sql3="SELECT * FROM `patient_registration_form_old_db` WHERE `phone_no`='".$srch."' AND `phone_no`<>'' AND reg_for_new_db_flag='0' ORDER BY `id` DESC";
	}
	$result3=$conn->query($sql3) ;
	 $sl=1;
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		 

		$uhid_no = mysqli_real_escape_string($conn,$row3['uhid_no']);
		$old_prefix = mysqli_real_escape_string($conn,$row3['old_prefix']);
		$patient_name = mysqli_real_escape_string($conn,$row3['patient_name']);
		$registration_date = date("d-m-Y", strtotime($row3['registration_date']));
		$dob = date("d-m-Y", strtotime($row3['dob']));
		$old_gender = mysqli_real_escape_string($conn,$row3['old_gender']);
		$phone_no = mysqli_real_escape_string($conn,$row3['phone_no']);
		$address = $row3['address'];
		$reg_for_new_db_flag = mysqli_real_escape_string($conn,$row3['reg_for_new_db_flag']);
		$old_db_id = mysqli_real_escape_string($conn,$row3['id']);
		
		$patient_reg_upload='';
		$action_tab_new='';
		
		$check_flag=0;
		
		if($reg_for_new_db_flag=='1'){
			$color="#2386ca";
		}else{
			$color="#8e5fa2";
			$action_tab="<button id='' class='btn btn-default green'><a onClick=\"if(confirm('Are you sure to register $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."registration_form_add.php?appt_id=0&patient_admission_type=2&old_db_id=".$old_db_id."'  title='Register' style='color:white !important;font-weight:bold !important;'  >&nbsp; &nbsp; Add New Registration For New Software + &nbsp; &nbsp;</a></button> ";
		}
		
		$arr[]=array("sl"=>$sl,"old_db_id"=>$old_db_id,"uhid_no"=>$uhid_no,"old_prefix"=>$old_prefix,"patient_name"=>$patient_name,"registration_date"=>$registration_date,"dob"=>$dob,"old_gender"=>$old_gender,"phone_no"=>$phone_no,"address"=>$address,"color"=>$color,"action_tab"=>$action_tab,"patient_reg_upload"=>$patient_reg_upload,"action_tab_new"=>$action_tab_new,"check_flag"=>$check_flag);

		$sl++;	
	 }
	 
	 if($type=='1'){

		$sql3="SELECT * FROM `patient_registration_form` WHERE `uhid_no`='".$srch."'  AND `uhid_no`<>'' ORDER BY `id` DESC";
	}
	 if($type=='2'){

		$sql3="SELECT * FROM `patient_registration_form` WHERE `patient_name` LIKE '%".$srch."%'  AND `patient_name`<>'' ORDER BY `id` DESC";
	}
	 if($type=='3'){

		$sql3="SELECT * FROM `patient_registration_form` WHERE `phone_no`='".$srch."'  AND `phone_no`<>''  ORDER BY `id` DESC";
	}
	
	$result3=$conn->query($sql3) ;
	
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		 

		$uhid_no = mysqli_real_escape_string($conn,$row3['uhid_no']);
		$old_prefix = mysqli_real_escape_string($conn,$row3['old_prefix']);
		$patient_name = mysqli_real_escape_string($conn,$row3['patient_name']);
		$registration_date = date("d-m-Y", strtotime($row3['registration_date']));
		$dob = date("d-m-Y", strtotime($row3['dob']));
		$old_gender = mysqli_real_escape_string($conn,$row3['gender']);
		$phone_no = mysqli_real_escape_string($conn,$row3['phone_no']);
		$address = $row3['address'];
		$old_db_id = mysqli_real_escape_string($conn,$row3['old_db_id']);
		$patient_registration_id=$row3['id'];
		$gender="";
		$prefix="";
		
		$check_flag=1;
		
		$sql9="SELECT * FROM `prefix_masters` Where `id`='".$row3['prefix']."'";

		 $result9=$conn->query($sql9) ;				

		 $row9 = $result9->fetch_assoc();

		 $count9=$result9->num_rows;

		 if($count9>0)

		 {

			$prefix=$row9['prefix_name'];

		 }
		 
		$sql12="SELECT * FROM `gender_masters` Where `id`='".$row3['gender']."'";

		 $result12=$conn->query($sql12) ;				

		 $row12 = $result12->fetch_assoc();

		 $count12=$result12->num_rows;

		 if($count12>0)

		 {

			$gender=mb_substr($row12['gender'], 0, 1);

		 }
		 
		 $patient_reg_upload="";
		 
		 $sql13="SELECT `image_name` FROM `patient_reg_upload` Where `uhid_no`='".$uhid_no."'";

		 $result13=$conn->query($sql13) ;				

		 $row13 = $result13->fetch_assoc();

		 $count13=$result13->num_rows;

		 if($count13>0)

		 {

			$patient_reg_upload=$row13['image_name'];

		 }
		
		 
		 $action_tab_new="";
		 $action_tab="";
		if($page_name=='reg'){
			 $action_tab_new="<a onClick=\"if(confirm('Are you sure to Edit for $patient_name?')) return true; else return false;\" href='".ADMIN_URL."registration_form_edit.php?patient_registration_id=".$patient_registration_id."'  title='EDIT' ><img src='". ADMIN_URL."icon/bt_edit.gif'  title='Edit'></a> | ";
			 $action_tab="<button id='' class='btn btn-default blue'><a onClick=\"if(confirm('Are you sure to follow up $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."follow_up_form_add.php?uhid_no=".$uhid_no."'  title='follow up' style='color:white !important;font-weight:bold !important;' >&nbsp; &nbsp; Follow Up + &nbsp; &nbsp;</a></button> <button id='' class='btn btn-default purple'><a onClick=\"if(confirm('Are you sure to Slip Generate $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."slip_generate_form_add.php?uhid_no=".$uhid_no."'  title='Slip Generate' style='color:white !important;font-weight:bold !important;' >&nbsp; &nbsp; Slip Generate + &nbsp; &nbsp;</a></button>  <button id='' class='btn btn-default bg-green-jungle'><a onClick=\"if(confirm('Are you sure to OPD Bill Generate $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=1&uhid_no=".$uhid_no."'  title='OPD Bill Generate' style='color:white !important;font-weight:bold !important;' >&nbsp; &nbsp; OPD Bill + &nbsp; &nbsp;</a></button> <button id='' class='btn btn-default red'><a onClick=\"if(confirm('Are you sure to IPD Bill Generate $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=0&uhid_no=".$uhid_no."'  title='IPD Bill Generate' style='color:white !important;font-weight:bold !important;' >&nbsp; &nbsp; IPD Bill + &nbsp; &nbsp;</a></button><button id='' class='btn btn-default yellow'><a onClick=\"if(confirm('Are you sure to Add Discharge $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."discharge_summary_from.php?uhid_no=".$uhid_no."'  title='Discharge Summary' style='color:white !important;font-weight:bold !important;' >&nbsp; Add Discharge &nbsp; &nbsp;</a></button>";
		}
		if($page_name=='bill'){
			 $action_tab="<button id='' class='btn btn-default bg-green-jungle'><a onClick=\"if(confirm('Are you sure to OPD Bill Generate $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=1&uhid_no=".$uhid_no."'  title='OPD Bill Generate' style='color:white !important;font-weight:bold !important;' >&nbsp; &nbsp; OPD Bill + &nbsp; &nbsp;</a></button> <button id='' class='btn btn-default red'><a onClick=\"if(confirm('Are you sure to IPD Bill Generate $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."invoice_final_billing.php?opd_flag=0&uhid_no=".$uhid_no."'  title='IPD Bill Generate' style='color:white !important;font-weight:bold !important;' >&nbsp; &nbsp; IPD Bill + &nbsp; &nbsp;</a></button> ";
		}
		if($page_name=='advance'){
			 $action_tab="<button id='' class='btn btn-default bg-green-jungle'><a onClick=\"if(confirm('Are you sure to OPD Advance Bill Generate $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."adavnce_final_billing.php?opd_flag=1&uhid_no=".$uhid_no."'  title='OPD Advance Bill Generate' style='color:white !important;font-weight:bold !important;' >&nbsp; &nbsp; OPD Advance Bill + &nbsp; &nbsp;</a></button> <button id='' class='btn btn-default red'><a onClick=\"if(confirm('Are you sure to IPD Advance Bill Generate $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."adavnce_final_billing.php?opd_flag=0&uhid_no=".$uhid_no."'  title='IPD Advance Bill Generate' style='color:white !important;font-weight:bold !important;' >&nbsp; &nbsp; IPD Advance Bill + &nbsp; &nbsp;</a></button> ";
		}
		if($page_name=='discharge'){
			 $action_tab="<button id='' class='btn btn-default yellow'><a onClick=\"if(confirm('Are you sure to Add Discharge $patient_name ?')) return true; else return false;\" href='".ADMIN_URL."discharge_summary_from.php?uhid_no=".$uhid_no."'  title='Discharge Summary' style='color:white !important;font-weight:bold !important;' >&nbsp; Add Discharge &nbsp; &nbsp;</a></button>";
		}
		
		
		$arr[]=array("sl"=>$sl,"old_db_id"=>$old_db_id,"uhid_no"=>$uhid_no,"old_prefix"=>$prefix,"patient_name"=>$patient_name,"registration_date"=>$registration_date,"dob"=>$dob,"old_gender"=>$gender,"phone_no"=>$phone_no,"address"=>$address,"color"=>$color,"action_tab"=>$action_tab,"patient_reg_upload"=>$patient_reg_upload,"action_tab_new"=>$action_tab_new,"check_flag"=>$check_flag);

		$sl++;	
	 }




		echo json_encode($arr);					

}

function fetch_old_pt_details(){
	global $conn;
	$arr=array();
	$old_db_id=$_REQUEST["old_db_id"];
	
	$sql3="SELECT * FROM `patient_registration_form_old_db` WHERE `id`='".$old_db_id."' AND reg_for_new_db_flag='0' ORDER BY `id` DESC";
	
	$result3=$conn->query($sql3) ;
	 $sl=1;
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		 

		$uhid_no = mysqli_real_escape_string($conn,$row3['uhid_no']);
		$old_prefix = mysqli_real_escape_string($conn,$row3['old_prefix']);
		$patient_name = mysqli_real_escape_string($conn,$row3['patient_name']);
		$registration_date = date("d-m-Y", strtotime($row3['registration_date']));
		$dob = date("d-m-Y", strtotime($row3['dob']));
		$old_gender = mysqli_real_escape_string($conn,$row3['old_gender']);
		$phone_no = mysqli_real_escape_string($conn,$row3['phone_no']);
		//$address = mysqli_real_escape_string($conn,$row3['address']);
		$address = $row3['address'];
		$reg_for_new_db_flag = mysqli_real_escape_string($conn,$row3['reg_for_new_db_flag']);
		$old_db_id = mysqli_real_escape_string($conn,$row3['id']);
		$prefix = mysqli_real_escape_string($conn,$row3['prefix']);
		$gender = mysqli_real_escape_string($conn,$row3['gender']);
		
		$arr=array("sl"=>$sl,"old_db_id"=>$old_db_id,"uhid_no"=>$uhid_no,"old_prefix"=>$old_prefix,"patient_name"=>$patient_name,"registration_date"=>$registration_date,"dob"=>$dob,"old_gender"=>$old_gender,"phone_no"=>$phone_no,"address"=>$address,"prefix"=>$prefix,"gender"=>$gender);

		$sl++;	
	 }




		echo json_encode($arr);					

}



function load_old_pt_details_for_appt(){
	global $conn;
	$arr=array();
	$type=$_REQUEST["type"];
	$srch=$_REQUEST["srch"];
	$page_name=$_REQUEST["page_name"];
	
	 if($type=='1'){

		$sql3="SELECT * FROM `patient_registration_form_old_db` WHERE `uhid_no`='".$srch."' AND `uhid_no`<>'' AND reg_for_new_db_flag='0' ORDER BY `id` DESC";
	}
	 if($type=='2'){

		$sql3="SELECT * FROM `patient_registration_form_old_db` WHERE `patient_name` LIKE '%".$srch."%' AND `patient_name`<>'' AND reg_for_new_db_flag='0' ORDER BY `id` DESC";
	}
	 if($type=='3'){

		$sql3="SELECT * FROM `patient_registration_form_old_db` WHERE `phone_no`='".$srch."' AND `phone_no`<>'' AND reg_for_new_db_flag='0' ORDER BY `id` DESC";
	}
	$result3=$conn->query($sql3) ;
	 $sl=1;
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		 

		$uhid_no = mysqli_real_escape_string($conn,$row3['uhid_no']);
		$old_prefix = mysqli_real_escape_string($conn,$row3['old_prefix']);
		$patient_name = mysqli_real_escape_string($conn,$row3['patient_name']);
		$registration_date = date("d-m-Y", strtotime($row3['registration_date']));
		$dob = date("d-m-Y", strtotime($row3['dob']));
		$old_gender = mysqli_real_escape_string($conn,$row3['old_gender']);
		$phone_no = mysqli_real_escape_string($conn,$row3['phone_no']);
		$address = $row3['address'];
		$reg_for_new_db_flag = mysqli_real_escape_string($conn,$row3['reg_for_new_db_flag']);
		$old_db_id = mysqli_real_escape_string($conn,$row3['id']);
		
		
		if($reg_for_new_db_flag=='1'){
			$color="#2386ca";
		}else{
			$color="#8e5fa2";
			$action_tab="0";
		}
		
		$arr[]=array("sl"=>$sl,"old_db_id"=>$old_db_id,"uhid_no"=>$uhid_no,"old_prefix"=>$old_prefix,"patient_name"=>$patient_name,"registration_date"=>$registration_date,"dob"=>$dob,"old_gender"=>$old_gender,"phone_no"=>$phone_no,"address"=>$address,"color"=>$color,"action_tab"=>$action_tab,"new_db_id"=>'0');

		$sl++;	
	 }
	 
	 if($type=='1'){

		$sql3="SELECT * FROM `patient_registration_form` WHERE `uhid_no`='".$srch."' AND `uhid_no`<>'' ORDER BY `id` DESC";
	}
	 if($type=='2'){

		$sql3="SELECT * FROM `patient_registration_form` WHERE `patient_name` LIKE '%".$srch."%' AND `patient_name`<>''  ORDER BY `id` DESC";
	}
	 if($type=='3'){

		$sql3="SELECT * FROM `patient_registration_form` WHERE `phone_no`='".$srch."' AND `phone_no`<>'' ORDER BY `id` DESC";
	}
	
	$result3=$conn->query($sql3) ;
	
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		 

		$uhid_no = mysqli_real_escape_string($conn,$row3['uhid_no']);
		$old_prefix = mysqli_real_escape_string($conn,$row3['old_prefix']);
		$patient_name = mysqli_real_escape_string($conn,$row3['patient_name']);
		$registration_date = date("d-m-Y", strtotime($row3['registration_date']));
		$dob = date("d-m-Y", strtotime($row3['dob']));
		$old_gender = mysqli_real_escape_string($conn,$row3['old_gender']);
		$phone_no = mysqli_real_escape_string($conn,$row3['phone_no']);
		$address = $row3['address'];
		$old_db_id = mysqli_real_escape_string($conn,$row3['id']);
		
		$gender="";
		$prefix="";
		
		$sql9="SELECT * FROM `prefix_masters` Where `id`='".$row3['prefix']."'";

		 $result9=$conn->query($sql9) ;				

		 $row9 = $result9->fetch_assoc();

		 $count9=$result9->num_rows;

		 if($count9>0)

		 {

			$prefix=$row9['prefix_name'];

		 }
		 
		$sql12="SELECT * FROM `gender_masters` Where `id`='".$row3['gender']."'";

		 $result12=$conn->query($sql12) ;				

		 $row12 = $result12->fetch_assoc();

		 $count12=$result12->num_rows;

		 if($count12>0)

		 {

			$gender=mb_substr($row12['gender'], 0, 1);

		 }
		 
		$action_tab="1";
		
		
		$arr[]=array("sl"=>$sl,"new_db_id"=>$old_db_id,"uhid_no"=>$uhid_no,"old_prefix"=>$prefix,"patient_name"=>$patient_name,"registration_date"=>$registration_date,"dob"=>$dob,"old_gender"=>$gender,"phone_no"=>$phone_no,"address"=>$address,"color"=>$color,"action_tab"=>$action_tab,"old_db_id"=>'0');

		$sl++;	
	 }




		echo json_encode($arr);					

}

function phone_change(){
	global $conn;
	$arr=array();
	$uhid_no=$_REQUEST["uhid_no"];
	
	$sql3="SELECT * FROM `patient_infos_for_appt` WHERE `mrdno`='".$uhid_no."'  ORDER BY `id` DESC";
	
	$result3=$conn->query($sql3) ;
	 $sl=1;
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		$phone_no = mysqli_real_escape_string($conn,$row3['phone_no']);		
		$arr=array("phone_no"=>$phone_no);
		$sl++;	
	 }

	echo json_encode($arr);					

}


function load_reg_by_patient(){
	global $conn;
	$arr=array();
	$register_by_pat_id=$_REQUEST["register_by_pat_id"];
	
	$sql3="SELECT * FROM `patient_registration_form_by_patient` WHERE `id`='".$register_by_pat_id."' ORDER BY `id` DESC";
	
	$result3=$conn->query($sql3) ;
	 $sl=1;
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		 
		$prefix = mysqli_real_escape_string($conn,$row3['prefix']);
		$patient_name = mysqli_real_escape_string($conn,$row3['patient_name']);		
		if($row3['dob']!=''){
			$dob = date("d-m-Y", strtotime($row3['dob']));
		}else{
			$dob = '';
		}
		$age = mysqli_real_escape_string($conn,$row3['age']);
		$gender = mysqli_real_escape_string($conn,$row3['gender']);
		$phone_no = mysqli_real_escape_string($conn,$row3['phone_no']);
		$email_id = mysqli_real_escape_string($conn,$row3['email_id']);
		$alternate_phone_no = mysqli_real_escape_string($conn,$row3['alternate_phone_no']);
		$address = $row3['address'];
		$zip_code = mysqli_real_escape_string($conn,$row3['zip_code']);
		$district = mysqli_real_escape_string($conn,$row3['district']);
		$admiting_doctor = mysqli_real_escape_string($conn,$row3['admiting_doctor']);
		
		
		
		$arr=array("sl"=>$sl,"prefix"=>$prefix,"patient_name"=>$patient_name,"dob"=>$dob,"age"=>$age,"gender"=>$gender,"phone_no"=>$phone_no,"email_id"=>$email_id,"alternate_phone_no"=>$alternate_phone_no,"address"=>$address,"zip_code"=>$zip_code,"district"=>$district,"admiting_doctor"=>$admiting_doctor);

		$sl++;	
	 }




		echo json_encode($arr);					

}



?> 