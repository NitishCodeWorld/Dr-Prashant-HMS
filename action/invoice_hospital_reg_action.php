<?php
include '../conn.php'; 
$a = $_REQUEST['a'];
$id = $_REQUEST['id'];
$reason = $_REQUEST['reason'];
$deleted_by=$_SESSION['id'];
$deleted_time=date('Y-m-d H:i:s');
if($a == 'delete'){		
	$sql = $conn->query("UPDATE `invoice_hospital_registration` SET `status` = '3',`del_flag`='1', `reason` = '" . $reason . "', `deleted_time` = '" . $deleted_time . "', `deleted_by` = '" . $deleted_by . "' WHERE `id` = '".$id."'");
	$sql2 = $conn->query("UPDATE `invoice_payment_hospital_registration` SET `p_action` = 'C' WHERE `i_id` = '".$id."'");
	$msg= "Record deleted successfully";
	$flg=0;
	$redirectUrl=ADMIN_URL.'dashboard.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
if($a == 'dele'){		
	$sql = $conn->query("UPDATE `invoice_insurance_registration` SET `status` = '3',`del_flag`='1', `reason` = '" . $reason . "', `deleted_time` = '" . $deleted_time . "', `deleted_by` = '" . $deleted_by . "' WHERE `id` = '".$id."'");
	$sql2 = $conn->query("UPDATE `invoice_payment_insurance_registration` SET `p_action` = 'C' WHERE `i_id` = '".$id."'");
	$msg= "Record deleted successfully";
	$flg=0;
	$redirectUrl=ADMIN_URL.'insurance_dashboard.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
if($a == 'delbill'){		
	$sql = $conn->query("UPDATE `invoice_billing` SET `status`='3',`reason`='".$reason."',`del_flag` ='1',`deleted_by`='".$deleted_by."', `deleted_time`='".$deleted_time."'  WHERE `id`='".$id."'");
	$sql13 = $conn->query("UPDATE `invoice_payment_billing` SET `p_action`='C' WHERE `i_id`='".$id."'");
	$sql13 = $conn->query("UPDATE `invoice_procedure` SET `del_flag` ='1',`deleted_by`='".$deleted_by."', `deleted_time`='".$deleted_time."'  WHERE `i_id`='".$id."'");
	$sql13 = $conn->query("UPDATE `invoice_sub_procedure` SET `del_flag` ='1',`deleted_by`='".$deleted_by."', `deleted_time`='".$deleted_time."'  WHERE `i_id`='".$id."'");
	$msg= "Record deleted successfully";
	$flg=0;
	$redirectUrl=ADMIN_URL.'billing_dashboard.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
if($a == 'delbilloptical'){		
	$sql = $conn->query("UPDATE `invoice_optical_billing` SET `status`='3',`reason`='".$reason."',`del_flag` ='1',`deleted_by`='".$deleted_by."', `deleted_time`='".$deleted_time."'  WHERE `id`='".$id."'");
	$sql13 = $conn->query("UPDATE `invoice_payment_optical_billing` SET `p_action`='C' WHERE `i_id`='".$id."'");
	$sql13 = $conn->query("UPDATE `invoice_optical_item` SET `del_flag` ='1',`deleted_by`='".$deleted_by."', `deleted_time`='".$deleted_time."'  WHERE `i_id`='".$id."'");
	$sql13 = $conn->query("UPDATE `stock_entry` SET `del_flag` ='1',`deleted_by`='".$deleted_by."', `deleted_time`='".$deleted_time."'  WHERE `i_id`='".$id."'");
	$msg= "Record deleted successfully";
	$flg=0;
	$redirectUrl=ADMIN_URL.'billing_dashboard.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
if($a == 'delbillpharmacy'){		
	$sql = $conn->query("UPDATE `invoice_pharmacy_billing` SET `status`='3',`reason`='".$reason."',`del_flag` ='1',`deleted_by`='".$deleted_by."', `deleted_time`='".$deleted_time."'  WHERE `id`='".$id."'");
	$sql13 = $conn->query("UPDATE `invoice_payment_pharmacy_billing` SET `p_action`='C' WHERE `i_id`='".$id."'");
	$sql13 = $conn->query("UPDATE `invoice_pharmacy_item` SET `del_flag` ='1',`deleted_by`='".$deleted_by."', `deleted_time`='".$deleted_time."'  WHERE `i_id`='".$id."'");
	$sql13 = $conn->query("UPDATE `stock_entry` SET `del_flag` ='1',`deleted_by`='".$deleted_by."', `deleted_time`='".$deleted_time."'  WHERE `i_id`='".$id."'");
	$msg= "Record deleted successfully";
	$flg=0;
	$redirectUrl=ADMIN_URL.'billing_dashboard.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
?>