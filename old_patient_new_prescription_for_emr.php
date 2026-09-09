<?php
include 'conn.php';
$prescription_id = $_REQUEST['id'];
if ($prescription_id != '')
{
$sql="SELECT `id`,`mrd_no`,`created_on`,`patients_key_notes`,`prefix`,`fname`,`lname`,`dob`,`age`,`religion`,`mobile`,`email`,`guardian_name`,`address`,`purpose_visit_id`,`primary_doctor` , `age_month`,`age_days`,`w_mobile`,`pin`,`location2` FROM `prescription_details_for_emr` WHERE `id`= '" .$prescription_id. "'";
	$result=$conn->query($sql) ;	
	$row = $result->fetch_assoc();	
	
$sql3 = "INSERT INTO `prescription_details_for_emr` SET `mrd_no`='".$row['mrd_no']."',`created_on`='".date('Y-m-d H:i:s')."',`patients_key_notes`='".$row['patients_key_notes']."',`prefix`='".$row['prefix']."',`fname`='".$row['fname']."',`lname`='".$row['lname']."',`dob`='".$row['dob']."',`age`='".$row['age']."',`religion`='".$row['religion']."',`mobile`='".$row['mobile']."',`email`='".$row['email']."',`guardian_name`='".$row['guardian_name']."',`address`='".$row['address']."',`primary_doctor`='".$row['primary_doctor']."' , `age_month`='".$row['age_month']."',`age_days`='".$row['age_days']."',`w_mobile`='".$row['w_mobile']."',`pin`='".$row['pin']."',`location2`='".$row['location2']."',`temp_save`='0',`EOM`='Full, free and painless ',`EOM_left`='Full, free and painless ',`pupils`='Round Reacting To Light',`pupils_left`='Round Reacting To Light',`lid_adnexa`='WNL',`lid_adnexa_left`='WNL',`conjunctiva`='WNL',`conjunctiva_left`='WNL',`ocular_block`='1'";
    if ($conn->query($sql3) === true)
    {
		$id = $conn->insert_id;        
			$redirectUrl = ADMIN_URL . 'edit_prescription.php?id='.$id;
		
		echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
    }
	
}
?>