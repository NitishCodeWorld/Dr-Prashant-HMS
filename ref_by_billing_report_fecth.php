<?php
include 'function.php';
include 'conn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function removeConsecutiveDuplicates($input) {
    $items = explode(", ", $input);
    $result = [];
    
    foreach ($items as $index => $item) {
        if ($index == 0 || $item !== $items[$index - 1]) {
            $result[] = $item;
        }
    }
    
    return implode(", ", $result);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pushpanjali collection Reports MIS</title>
<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<!--<link rel="manifest" href="favicon/manifest.json">-->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<style>
td {
	vertical-align:middle !important;
	font-family:Arial, Helvetica, sans-serif;
	text-align:left;
	font-size:9pt;
	padding: 2px;
}
</style>
<style>
.defualt_td {
	font-size:10px !important;
	padding:4px;
	text-align:center;
}
.defualt_td_spcl {
	font-size:9px !important;
	padding:4px;
	text-align:center;
}
.bold_td {
	font-size:12px !important;
	font-weight:bold !important;
	padding:4px;
	text-align:center;
}
.bord {
	border:none !important;
	padding:4px;
	text-align:center;
}
.bord_bott {
	border-left:none !important;
	border-right:none !important;
	border-top:none !important;
	border-bottom:2px solid #000 !important;
	padding:4px;
	text-align:center;
}
.bord_bott_final {
	border-left:none !important;
	border-right:none !important;
	border-top:none !important;
	border-bottom:2px solid #000 !important;
	padding:4px;
	text-align:center;
	font-size:16px !important;
}
.bord_bott_final_tot {
	border-left:none !important;
	border-right:none !important;
	border-top:none !important;
	border-bottom:2px solid #000 !important;
	padding:4px 4px 4px 12px;
	text-align:right;
	font-size:16px !important;
}
.bord_top {
	border-left:none !important;
	border-right:none !important;
	border-bottom:none !important;
	border-top:2px solid #000 !important;
	padding:4px;
	text-align:center;
}
.bold_td_big {
	font-size:13px !important;
	font-weight:bold !important;
	color:#C00 !important;
	padding:4px;
	text-align:center;
}
</style>
<style type="text/css" media="print">
@media print {
.notprnt {
	display:none;
}
}
</style>
</head>

<body style="padding:5px;">
<?php 
$from_date = date("Y-m-d", strtotime($_REQUEST['from_date']));
$to_date = date("Y-m-d", strtotime($_REQUEST['to_date']));
$title_span="Ref By Billing Details From ".date("d-M-Y", strtotime($_REQUEST['from_date']))." To ".date("d-M-Y", strtotime($_REQUEST['to_date']));
?>
<div class="notprnt">
  <div class="col-md-12">
    <div class="col-md-3">
      <button type="button" name="exportBtn"  id="exportBtn"  class="btn red" title="Export to Excel">Export to Excel</button>
      <button type="button" name="printBtn"  id="printBtn"  class="btn red" title="Export to Excel" onclick="window.print();">Print</button>
      <input type="hidden" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo $_REQUEST['from_date']; ?>" />
      <input type="hidden" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo $_REQUEST['to_date']; ?>" />
    </div>
  </div>
  <div class="col-md-12">
    <p>&nbsp;</p>
  </div>
</div>
<table width="100%" border="1" cellspacing="0" cellpadding="0" id="my_data_Table" >
  <tr>
    <td colspan="14" style="padding:6px 4px; font-size:12pt; text-align:left; font-family:Arial, Helvetica, sans-serif"><strong><?php echo $title_span; ?></strong></td>
  </tr>
  <?php 
				$procedure_fecth_amount_grand_tot=0;
				$procedure_fecth_discount_grand_tot=0;
				$procedure_fecth_net_amount_grand_tot=0;
				$total_recieved_cash_grand_tot=0;
				$due_amt_grand_tot=0;
			  $due_net_total=0;
			  $due_amt=0;
			   $extra_query=" ";
			   $doc_sl=1;
			   $sql_doc=" SELECT DISTINCT (`invoice_final_billing`.`ref_doctor_id`) AS `distinct_doc_id` FROM `invoice_final_billing` INNER JOIN `doctor_masters_for_emr` ON `invoice_final_billing`.`ref_doctor_id`=`doctor_masters_for_emr`.`id`  WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  $extra_query AND `invoice_final_billing`.`del_flag`='0' AND `invoice_final_billing`.`ref_doctor_id`<>'' ORDER BY `doctor_masters_for_emr`.`doctor_name` ASC ";                   

	 $result_doc=$conn->query($sql_doc) ;
	 $count_doc=$result_doc->num_rows;
	 if($count_doc>'0'){
		 while ($row_doc=mysqli_fetch_array($result_doc,MYSQLI_ASSOC))
			 {	
			 
					$ref_doctor="";
					 $ref_ini="";	
			  		 $sql_ref="SELECT * FROM `doctor_masters_for_emr`  Where `id`='".$row_doc['distinct_doc_id']."'";
					 $result_ref=$conn->query($sql_ref) ;
					 $row_ref = $result_ref->fetch_assoc();
					 $count_ref=$result_ref->num_rows;
					 if($count_ref>0)
					 {
						$ref_doctor=$row_ref['doctor_name'];
						$ref_ini=$row_ref['doctor_ini'];
					 }
			
			 
			 echo '<tr><td colspan="14" style="padding:4px;"><center><span style="font-size:13pt;font-weight:bold !important;">'.$ref_doctor.' ('.$ref_ini.')</span></center></td></tr>' ;
			 
			$doc_where="";
			 $doc_where=" AND `invoice_final_billing`.`ref_doctor_id`='".$row_doc['distinct_doc_id']."' ";	  
 
  $sql3=" SELECT `invoice_final_billing`.* FROM  `invoice_final_billing` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  $extra_query  AND  `invoice_final_billing`.`del_flag`='0' AND `invoice_final_billing`.`ref_doctor_id`<>''  $doc_where ORDER BY `invoice_final_billing`.`billing_date` ASC "; 
  
   $result3=$conn->query($sql3) ;
	 $count=$result3->num_rows;
	$amount_grand_total=0;
	$discount_grand_total=0;
	$paid_grand_total=0;
	$advance_grand_total=0;
	
	$procedure_fecth_amount_net_tot=0;
	$procedure_fecth_discount_net_tot=0;
	$procedure_fecth_net_amount_net_tot=0;
	$total_recieved_cash_net_tot=0;
	$due_amt_net_tot=0;
	
	$print_url="";
	 if($count>'0'){
			 $sl_no=1;
			 while ($row_inner=mysqli_fetch_array($result3,MYSQLI_ASSOC))
			 {		
			 
			 
			 
			  if($sl_no==1){						
						
						echo '<tr>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Sl No.</strong></td>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Bill Date </strong></td>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Bill No. </strong></td>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>RegId</strong></td>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Patient Name</strong></td>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Party Name</strong></td>
				<td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Doctor</strong></td>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Particular</strong></td>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Total Amount</strong></td>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Dis.</strong></td>
                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Net Amt</strong></td>
				<td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Total<br/>Received</strong></td>
				<td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Pay Mode</strong></td>
				<td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Due</strong></td>
              </tr>';
			  }
			  
			  $amount_net_total=0;
	 $discount_net_total=0;
	 $paid_net_total=0;
	 $paid_advance_total=0;
			  
			  $primary_doctor="";
					 $ini="";	
			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";
					 $result11=$conn->query($sql11) ;
					 $row11 = $result11->fetch_assoc();
					 $count11=$result11->num_rows;
					 if($count11>0)
					 {
						$primary_doctor=$row11['name'];
						$ini=$row11['username'];
					 }
					 if($row_inner['opd_flag']==1){
						$bill_for='OPD';
					}else{
						$bill_for='IPD';
					}	
					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	
					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");
					$bill_no="";
					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row_inner['invo_no'];
				
					 $billing_date="";	
					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));
					 
					 $prefix="";
					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	
					$res_prefix=mysqli_query($conn,$sql_prefix);
					$row_prefix=mysqli_fetch_assoc($res_prefix);
					$count_prefix=$res_prefix->num_rows;
					 if($count_prefix>0)
					 {
					 $prefix=$row_prefix['prefix_name']; 
					 }
					$payor_name="SELF";
					$pay_mode="";
					$advance_amt=0;
					$pay_mode_ret="";
					$advance_amt_ret=0;
					$due_amt=0;
					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name`,`tpa_masters`.`name` AS `tpa_company`  FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id` LEFT JOIN `tpa_masters` ON `invoice_final_payment_billing`.`tpa_name` =`tpa_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`='5'  AND `invoice_final_payment_billing`.`del_flag`='0' ";
					$result_payment = $conn->query($sql_payment);
					if($result_payment->num_rows > 0){
						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))
						{
							$payor_name=$row2_payment['tpa_company'];						
							/*if($pay_mode==''){
								$pay_mode=$row2_payment['payment_mode_name'];
							}else{
								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];
							}*/
							
							
								$due_amt=$due_amt+$row2_payment['p_value'];
							
							
						}
					}
					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='3'  ";
					$result_payment = $conn->query($sql_payment);
					if($result_payment->num_rows > 0){
						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))
						{	if($pay_mode==''){
								$pay_mode=$row2_payment['payment_mode_name'];
							}else{
								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];
							}
							
							
						}
					}
					
					 $sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='0'  ";
					$result_payment = $conn->query($sql_payment);
					if($result_payment->num_rows > 0){
						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))
						{	if($pay_mode==''){
								$pay_mode=$row2_payment['payment_mode_name'];
							}else{
								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];
							}
							if($row2_payment['advance_bill_invoice_no']!=''){
								$advance_amt=$advance_amt+$row2_payment['p_value'];
							}
							
						}
					}
					
				
					
					$output = removeConsecutiveDuplicates($pay_mode);
					$pay_mode=$output;
					 
					 $amount=0;
					 $discount=0;
					 $net_amount=0;
					 $procedure_amount=0;
					 $procedure_dicount=0;
					 $procedure_net_amount=0;
					 
					
					 
					 $amount=$procedure_amount;
					 $discount=$procedure_dicount;
					 $net_amount=$procedure_net_amount;
					 $dicount_calculate=0;
					 $dicount_calculate_int=0;
					 $dicount_calculate_per_proc=0;
					 $dicount_calculate_per_proc_int=0;
					 
					 if($row_inner['discount']!='0'){
						 if($row_inner['discount']!=''){
							$sql_discount=" SELECT  SUM(`net_amount`) AS `tot_net`,COUNT(`id`) AS `total_proc_cnt`  FROM `invoice_final_procedure` WHERE `i_id`='".$row_inner['id']."' AND `del_flag`='0'  ";  
	 						$result_discount=$conn->query($sql_discount) ;
							$row_discount = $result_discount->fetch_assoc();
							
							 if($row_inner['discount_type']=='P'){
								 	$dicount_calculate=( $row_discount['tot_net']*$row_inner['discount'])/100;
									$dicount_calculate_int=round($dicount_calculate);
									$dicount_calculate_per_proc=($dicount_calculate_int/$row_discount['total_proc_cnt']);
									$dicount_calculate_per_proc_int=round($dicount_calculate_per_proc);
							 }
							 if($row_inner['discount_type']=='F'){
									$dicount_calculate_per_proc=($row_inner['discount']/$row_discount['total_proc_cnt']);
									$dicount_calculate_per_proc_int=round($dicount_calculate_per_proc);
							 }
							 
						 }						 
					 }
					 $amount=$procedure_amount;
					 $discount=$procedure_dicount+$dicount_calculate_per_proc_int;
					 $net_amount=$procedure_net_amount-$dicount_calculate_per_proc_int;
					 
					 $amount_net_total=$amount_net_total+$amount;
					 $discount_net_total=$discount_net_total+$discount;
					 $paid_net_total=$paid_net_total+$net_amount;
					 $paid_advance_total=$paid_advance_total+$advance_amt;
					 
					 //$due_net_total=$due_net_total+$due_amt-$advance_amt_ret;
					 $due_net_total=$due_amt;
					 $adjamt=0;
					 $adjamt=$advance_amt-$advance_amt_ret;
					 //$due_amt=$due_amt-$advance_amt_ret;
					 
					 $procedure_fecth_pro_name='';
					 $procedure_fecth_amount=0;
					 $procedure_fecth_discount=0;
					 $procedure_fecth_net_amount=0;
					 $total_recieved_cash=0;
					 $sl_procedure=1;
					 $sql_procedure_fetch = "SELECT `invoice_final_procedure`.* , `procedure_masters`.`procedure_name` FROM `invoice_final_procedure` INNER JOIN `procedure_masters` ON `invoice_final_procedure`.`procedure_id` =`procedure_masters`.`id`  WHERE `invoice_final_procedure`.`i_id` = '".$row_inner['id']."' AND  `invoice_final_procedure`.`del_flag`='0'   ";	
					$result_procedure_fetch = $conn->query($sql_procedure_fetch);
					if($result_procedure_fetch->num_rows > 0){
						while ($row2_procedure_fetch=mysqli_fetch_array($result_procedure_fetch,MYSQLI_ASSOC))
						{	if($procedure_fecth_pro_name==''){
								$procedure_fecth_pro_name=$sl_procedure.') '.$row2_procedure_fetch['procedure_name'];
							}else{
								$procedure_fecth_pro_name=$procedure_fecth_pro_name.' <br/>'.$sl_procedure.') '.$row2_procedure_fetch['procedure_name'];
							}
							
							 $procedure_fecth_amount=$procedure_fecth_amount+$row2_procedure_fetch['amount'];
							 $procedure_fecth_discount=$procedure_fecth_discount+$row2_procedure_fetch['discount'];
							 $procedure_fecth_net_amount=$procedure_fecth_net_amount+$row2_procedure_fetch['net_amount'];
							
							 $sl_procedure++; 	
						}
					}
					$total_recieved_cash=($procedure_fecth_net_amount-$due_amt);
			  
			   $print_url= ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$row_inner['id'];  
					echo ' <tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td">'.date("d-M-Y", strtotime($row_inner['billing_date'])).'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$payor_name.'</td><td class="defualt_td">'.$primary_doctor.'</td><td class="defualt_td" style="text-align:left !important;">'.$procedure_fecth_pro_name.'</td><td class="defualt_td">'.$procedure_fecth_amount.'</td><td class="defualt_td">'.$procedure_fecth_discount.'</td><td class="defualt_td">'.$procedure_fecth_net_amount.'</td><td class="defualt_td">'.$total_recieved_cash.'</td><td class="defualt_td">'.$pay_mode.'</td><td class="defualt_td">'.$due_amt.'</td></tr>';
					
					
					$procedure_fecth_amount_net_tot=$procedure_fecth_amount_net_tot+$procedure_fecth_amount;
					$procedure_fecth_discount_net_tot=$procedure_fecth_discount_net_tot+$procedure_fecth_discount;
					$procedure_fecth_net_amount_net_tot=$procedure_fecth_net_amount_net_tot+$procedure_fecth_net_amount;
					$total_recieved_cash_net_tot=$total_recieved_cash_net_tot+$total_recieved_cash;
					$due_amt_net_tot=$due_amt_net_tot+$due_amt;
			  
			 $sl_no++; 

	}}		
  
  
	echo '<tr ><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final_tot" >Total Of  '.$ref_doctor.' :</td><td class="bold_td bord_bott_final">'.$procedure_fecth_amount_net_tot.'</td><td class="bold_td bord_bott_final">'.$procedure_fecth_discount_net_tot.'</td><td class="bold_td bord_bott_final">'.$procedure_fecth_net_amount_net_tot.'</td><td class="bold_td bord_bott_final">'.$total_recieved_cash_net_tot.'</td><td class="bold_td bord_bott_final"> </td><td class="bold_td bord_bott_final">'.$due_amt_net_tot.'</td></tr>';
	
	$procedure_fecth_amount_grand_tot=$procedure_fecth_amount_grand_tot+$procedure_fecth_amount_net_tot;
	$procedure_fecth_discount_grand_tot=$procedure_fecth_discount_grand_tot+$procedure_fecth_discount_net_tot;
	$procedure_fecth_net_amount_grand_tot=$procedure_fecth_net_amount_grand_tot+$procedure_fecth_net_amount_net_tot;
	$total_recieved_cash_grand_tot=$total_recieved_cash_grand_tot+$total_recieved_cash_net_tot;
	$due_amt_grand_tot=$due_amt_grand_tot+$due_amt_net_tot;	
				 
			 }}
			 echo '<tr ><td class="bold_td bord_bott_final"> </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final" > </td><td class="bold_td bord_bott_final_tot" >Total IPD Billng:</td><td class="bold_td bord_bott_final">'.$procedure_fecth_amount_grand_tot.'</td><td class="bold_td bord_bott_final">'.$procedure_fecth_discount_grand_tot.'</td><td class="bold_td bord_bott_final">'.$procedure_fecth_net_amount_grand_tot.'</td><td class="bold_td bord_bott_final">'.$total_recieved_cash_grand_tot.'</td><td class="bold_td bord_bott_final"> </td><td class="bold_td bord_bott_final">'.$due_amt_grand_tot.'</td></tr>';
	
    ?>
</table>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready( function() {  
	$('#exportBtn').on('click', function () {
		var tableData = [];
		$('#my_data_Table tr').each(function () {
			var rowData = [];
			$(this).find('th, td').each(function () {
				rowData.push($(this).text());
			});
			tableData.push(rowData);
		});
		var from_date=$("#from_date").val();
		var to_date=$("#to_date").val();
	
		$.ajax({
			url: 'ref_by_billing_data.php?from_date='+from_date+'&to_date='+to_date,
			type: 'POST',
			data: { tableData: JSON.stringify(tableData) },
			success: function (response) {
				// Trigger download
				window.location.href = response;
			}
		});
	});

});
</script>
<script>
//window.print();
</script>
</html>
