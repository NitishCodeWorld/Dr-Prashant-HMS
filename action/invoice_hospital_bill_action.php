<?php

include '../conn.php'; 

$a = $_REQUEST['a'];

$id = $_REQUEST['id'];

$reason = $_REQUEST['reason'];

$deleted_by=$_SESSION['id'];

$deleted_time=date('Y-m-d H:i:s');



if($a == 'delLabBill'){	

	$lab_investigation_sheet_id = $_REQUEST['lab_investigation_sheet_id'];

	$lab_billing_query_id = $_REQUEST['lab_billing_query_id'];	

	$sql = $conn->query("UPDATE `lab_investigation_sheet` SET `billing_flag`='0',`lab_billing_query_id`='0' WHERE `id`='".$lab_investigation_sheet_id."'");

	$sql13 = $conn->query("UPDATE `invoice_lab_billing` SET `del_flag`='1', `status`='3',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `id`='".$lab_billing_query_id."'");

	$sql13 = $conn->query("UPDATE `invoice_lab_payment_billing` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$lab_billing_query_id."'");

	$sql13 = $conn->query("UPDATE `adavnce_lab_billing` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$lab_billing_query_id."'");

	$sql13 = $conn->query("UPDATE `invoice_lab_procedure` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$lab_billing_query_id."'");

	$msg= "Bill cancelled successfully.";

	$flg=0;

	$redirectUrl=ADMIN_URL.'lab_billing_archieve_dashboard.php?msg='.$msg.'&flg='.$flg;

	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

}



if($a == 'delFinalBill'){	

	$reason = $_REQUEST['reason'];

	$id = $_REQUEST['id'];	

	$sql13 = $conn->query("UPDATE `invoice_final_billing` SET `del_flag`='1', `status`='3',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."',`reason`='".$reason."' WHERE `id`='".$id."'");

	$sql13 = $conn->query("UPDATE `invoice_final_procedure` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	$sql13 = $conn->query("UPDATE `invoice_final_payment_billing` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	$sql13 = $conn->query("UPDATE `invoice_final_break_up_procedure` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	

	$sql_final_billing_info="SELECT * FROM `invoice_final_payment_billing` WHERE `i_id`='".$id."' AND `advance_bill_invoice_unique_id`<>'' AND `advance_bill_refund_flag`='0' ";	

	$res_final_billing_info=mysqli_query($conn,$sql_final_billing_info) or die(mysqli_error($conn));

	//$row_final_billing_info=mysqli_fetch_assoc($res_final_billing_info);
	 while($row_final_billing_info=mysqli_fetch_array($res_final_billing_info,MYSQLI_ASSOC))
		{	

			$sql87 = $conn->query(" UPDATE `adavnce_final_payment_billing` SET `adjust_with_final_bill_flag`='0' WHERE  `i_id`='".$row_final_billing_info['advance_bill_invoice_unique_id']."'  ")				;			
			$sql87 = $conn->query(" UPDATE `adavnce_final_billing` SET `adjust_with_final_bill_flag`='0' WHERE  `id`='".$row_final_billing_info['advance_bill_invoice_unique_id']."'  ");		 
		}
		
		
		$sql_final_billing_info_ref="SELECT * FROM `invoice_final_payment_billing` WHERE `i_id`='".$id."' AND `advance_bill_invoice_unique_id`<>'' AND `advance_bill_refund_flag`='1' ";	

	$res_final_billing_info_ref=mysqli_query($conn,$sql_final_billing_info_ref) or die(mysqli_error($conn));

	//$row_final_billing_info=mysqli_fetch_assoc($res_final_billing_info);
	 while($row_final_billing_info_ref=mysqli_fetch_array($res_final_billing_info_ref,MYSQLI_ASSOC))
		{	

			$sql87 = $conn->query(" UPDATE `refund_adavnce_final_payment_billing` SET `adjust_with_final_bill_flag`='0' WHERE  `i_id`='".$row_final_billing_info['advance_bill_invoice_unique_id']."'  ")				;			
			$sql87 = $conn->query(" UPDATE `refund_adavnce_final_billing` SET `adjust_with_final_bill_flag`='0' WHERE  `id`='".$row_final_billing_info['advance_bill_invoice_unique_id']."'  ");		 
		}
	 

	$msg= "Bill cancelled successfully.";

	$flg=0;

	$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard.php?msg='.$msg.'&flg='.$flg;

	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

}



if($a == 'delDraftBill'){	

	$reason = $_REQUEST['reason'];

	$id = $_REQUEST['id'];	

	$sql13 = $conn->query("UPDATE `invoice_final_billing_for_draft_bill` SET `del_flag`='1', `status`='3',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."',`reason`='".$reason."' WHERE `id`='".$id."'");

	$sql13 = $conn->query("UPDATE `invoice_final_procedure_for_draft_bill` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	$sql13 = $conn->query("UPDATE `invoice_final_payment_billing_for_draft_bill` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	$sql13 = $conn->query("UPDATE `invoice_final_break_up_procedure_for_draft_bill` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	$msg= "Bill cancelled successfully.";

	$flg=0;

	$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard_for_draft_bill.php?msg='.$msg.'&flg='.$flg;

	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

}



if($a == 'delAdvanceBill'){	

	$reason = $_REQUEST['reason'];

	$id = $_REQUEST['id'];	

	$sql13 = $conn->query("UPDATE `adavnce_final_billing` SET `del_flag`='1', `status`='3',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."',`reason`='".$reason."' WHERE `id`='".$id."'");

	$sql13 = $conn->query("UPDATE `adavnce_final_procedure` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	$sql13 = $conn->query("UPDATE `adavnce_final_payment_billing` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	

	$msg= "Bill cancelled successfully.";

	$flg=0;

	$redirectUrl=ADMIN_URL.'advance_final_billing_archieve_dashboard.php?msg='.$msg.'&flg='.$flg;

	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

}

if($a == 'delAdvanceBillRefund'){	

	$reason = $_REQUEST['reason'];

	$id = $_REQUEST['id'];	

	$sql13 = $conn->query("UPDATE `refund_adavnce_final_billing` SET `del_flag`='1', `status`='3',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."',`reason`='".$reason."' WHERE `id`='".$id."'");

	//$sql13 = $conn->query("UPDATE `adavnce_final_procedure` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	$sql13 = $conn->query("UPDATE `refund_adavnce_final_payment_billing` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `i_id`='".$id."'");

	

	$msg= "Bill cancelled successfully.";

	$flg=0;

	$redirectUrl=ADMIN_URL.'advance_final_billing_archieve_dashboard.php?msg='.$msg.'&flg='.$flg;

	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

}



?>