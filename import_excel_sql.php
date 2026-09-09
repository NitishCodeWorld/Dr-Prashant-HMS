<?php 
include 'conn.php'; 
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

//SELECT `data_import`.*,`prefix_masters`.`prefix_name` ,`prefix_masters`.`id` AS `prefix_id` FROM `data_import` LEFT JOIN `prefix_masters` ON `data_import`.`old_prefix`=`prefix_masters`.`prefix_name`;
//SELECT `mrd`, `old_prefix`, `patient_name`, `reg_date`, `dob`, `gender`, `mobile`, `address`, `flag` FROM `data_import` WHERE 1
$sql7="SELECT `data_import`.*,`prefix_masters`.`prefix_name` ,`prefix_masters`.`id` AS `prefix_id` FROM `data_import` LEFT JOIN `prefix_masters` ON `data_import`.`old_prefix`=`prefix_masters`.`prefix_name`";

 $result7=$conn->query($sql7) ;
 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
 {	
					
					$uhid_no = mysqli_real_escape_string($conn,$row7['mrd']);
					$old_prefix = mysqli_real_escape_string($conn,$row7['old_prefix']);
					$patient_name = mysqli_real_escape_string($conn,$row7['patient_name']);
					$registration_date = date("Y-m-d", strtotime($row7['reg_date']));
					$dob = date("Y-m-d", strtotime($row7['dob']));
					$gender=0;
					if($row7['gender']=='M'){
						$gender=1;
					}
					if($row7['gender']=='F'){
						$gender=2;
					}
					$old_gender = mysqli_real_escape_string($conn,$row7['gender']);
					$phone_no = mysqli_real_escape_string($conn,$row7['mobile']);
					$address = mysqli_real_escape_string($conn,$row7['address']);
					$created_by=1;
					$created_on=date('Y-m-d H:i:s');
					$appt_id=0;
					$patient_admission_type=2;
					$prefix_id = mysqli_real_escape_string($conn,$row7['prefix_id']);
					
					
					 $sql = "INSERT INTO `patient_registration_form_old_db`( `uhid_no`, `patient_name`, `registration_date`, `dob`, `gender`, `phone_no`, `address`, `created_by`, `created_on`, `appt_id`, `patient_admission_type`, `old_prefix`, `old_gender`, `prefix`) VALUES ('".$uhid_no."','".$patient_name."','".$registration_date."','".$dob."','".$gender."','".$phone_no."','".$address."','".$created_by."','".$created_on."','".$appt_id."','".$patient_admission_type."','".$old_prefix."','".$old_gender."','".$prefix_id."') ";
	         //we are using mysql_query function. it returns a resource on true else False on error
	        $result = mysqli_query( $conn, $sql );
				if(! $result )
				{
					echo "Upload done";
				
				}
				
}

	        
?>