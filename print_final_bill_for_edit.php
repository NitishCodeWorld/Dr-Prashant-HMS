<?php
include 'function.php';
include 'conn.php';
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
?>
<?php
$id = $_GET['id']; // get id through query string
// Changes_to_be

$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);

$qry = mysqli_query($conn, "select * from `invoice_final_billing` where `id`='".$id."'"); // select query
$row3 = mysqli_fetch_array($qry); // fetch data
$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['billing_date'])) , "4/1", "3/31");
$del_flag=$row3['del_flag'];
$cancled="";
if($del_flag=='1'){
	$cancled=" ( Cancelled Bill )";
}
?>
<?php include "header_for_final_bill_edit_print.php"; ?>

<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title" style="text-align:center !important; margin-top:-5px; padding-bottom:9px; margin-bottom:0"> <span class="portlet-title" style="text-align:center !important; padding-bottom:9px"><span class="portlet-title" style="text-align:center !important; padding-bottom:9px"><strong style="font-size:14pt !important"><?php echo $row_hospital_info['hospital_name'];  ?></strong><br>
              <strong style="font-size:9pt !important"><?php echo $row_hospital_info['final_bill_unit'];  ?></strong><br/>
              <?php echo $row_hospital_info['address'];  ?> <br>              
              Phone No. <?php echo $row_hospital_info['final_bill_mobile'];  ?><br/>
              E-mail: <?php echo $row_hospital_info['email'];  ?> :: Website: <?php echo $row_hospital_info['website'];  ?></span></span></div>            
            <!-- BEGIN FORM-->
            <div class="form-body">
            <div class="row">
                <div class="col-md-12" style="padding-bottom:4px">
                  <table class="ott" style="width:100%" cellpadding="0" cellspacing="0" align="center">
                  <tr>
                      <td colspan="2"><center><strong style="font-size:12pt !important;text-decoration:underline;"><?php if($row3['status'] == 4){ echo "PROFORMA INVOICE CUM ADVANCE RECEIPT";}else if($row3['status'] == 2){ echo "FULL DUE BILL"; }else { echo "FINAL BILL";} echo $cancled; ?></strong></center></td>   
                    </tr>
                    <tr>
                      <td ><strong>Bill No: <?php echo $row3['invo_no'].'/'.$m_f_year;  ?></strong></td> 
                      <td  style="text-align:right !important;"><strong>Bill Date : <?php echo date("d-m-Y", strtotime($row3['billing_date']));  ?> </strong></td>
                    </tr>
                    <tr>
                      <td >&nbsp;</td> 
                      <td  style="text-align:right !important;"><strong>Bill Time: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("h:i A", strtotime($row3['billing_time']));  ?> </strong></td>
                    </tr>
                    
                  </table>
                </div>
                <!-------------------------field end---------------------> 
              </div>
              <div class="row">
                <div class="col-md-12" style="padding-bottom:4px">
                  <table class="ott" style="width:100%" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                      <td colspan="2">PATIENT NAME: <strong><?php echo $row3['name'];  ?></strong></td>
                      <td width="23%" style="text-align:right !important;">SEX.: <strong><?php 
					  	$qry_gender = mysqli_query($conn, "SELECT `gender` FROM `gender_masters`  where `id`='".$row3['gender']."'"); 
						$row3_gender = mysqli_fetch_array($qry_gender); 
					  echo $row3_gender['gender'];  ?></strong></td>
                      <td width="24%" style="text-align:right !important;">AGE: <strong><?php echo $row3['age'];  ?> YEARS</strong></td>
                    </tr>
                    
                    <tr>
                      <td colspan="2">UHID No.: <strong><?php echo $row3['hospital_number'];  ?></strong></td>                      
                      <td  width="47%" colspan="2" style="text-align:right !important;">CONSULTANT: <strong><?php 
					  	$qry_doctor = mysqli_query($conn, "SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`id`='".$row3['doc_id']."'"); 
						$row3_doctor = mysqli_fetch_array($qry_doctor); 
					  echo $row3_doctor['name'];  ?></strong></td>                      
                    </tr>
                    <?php 
			 $approved_amt=0;
				  $tpa_name_fetch="";
				  $claim_no="";
				  $co_pay_amt=0;
				   $condition=" AND `invoice_final_payment_billing`.`del_flag`='0' ";
				  if($del_flag=='1'){
					  $condition=" AND `invoice_final_payment_billing`.`del_flag`='1' ";
				  }
			 $sql_lab_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id` WHERE `invoice_final_payment_billing`.`i_id` = '".$id."' $condition AND `invoice_final_payment_billing`.`tpa_name`<>'' ";
			$result_lab_payment = $conn->query($sql_lab_payment);
			if($result_lab_payment->num_rows > 0){
				while ($row2_lab_payment=mysqli_fetch_array($result_lab_payment,MYSQLI_ASSOC))
														{
															$approved_amt=$approved_amt+$row2_lab_payment['p_value'];
															
															
															if($row2_lab_payment['p_key']=='5'){
															$qry_tpa = mysqli_query($conn, "SELECT  `name` FROM `tpa_masters` WHERE  `id`='".$row2_lab_payment['tpa_name']."'"); 
															$row3_tpa = mysqli_fetch_array($qry_tpa); 
															 $tpa_name_fetch=$row3_tpa['name'];
															}
															
															 $claim_no=$row2_lab_payment['claim_no'];
														}
			}
				?>
                <?php  if($tpa_name_fetch!=''){ ?>
                    <tr>
                      <td colspan="2">Tpa Name: : <strong><?php echo $tpa_name_fetch;  ?></strong></td>                      
                      <td  width="47%" colspan="2" style="text-align:right !important;">Claim No: : <strong><?php  echo $claim_no;  ?></strong></td>                      
                    </tr>
                    <?php  }?>
                    <!-------------------------row end--------------------->
                    
                  </table>
                </div>
                <!-------------------------field end---------------------> 
              </div>
              <!--<div class="portlet-title" style="border-top:1px dashed #333; padding-top:0; height:1px !important">&nbsp;</div>-->
              <div class="row">
                <div class="col-md-12">
                  <table class="ot" style="width:100%" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                      <th width="4%">S.N.</th>
                      <th width="85%"><strong>Particulars</strong></th>
                      <th width="11%"><strong>Amount</strong></th>
                    </tr>
                     <?php		$procedure_amt_tot=0;
								$sl_lab_proc=1;	
								$condition=" AND `del_flag`='0' ";
								  if($del_flag=='1'){
									  $condition=" AND `del_flag`='1' ";
								  }									
								$sql2_lab_proc="SELECT * FROM `invoice_final_procedure` WHERE `i_id`= '" .$id. "' AND `patient_registration_id`= '" .$row3['patient_registration_id']. "' AND `hospital_number`= '" .$row3['hospital_number']. "'  $condition ";
								 $result2_lab_proc=$conn->query($sql2_lab_proc) ;
								 while ($row2_lab_proc=mysqli_fetch_array($result2_lab_proc,MYSQLI_ASSOC))
														{
													 ?>
                    <tr>
                      <td><?php echo $sl_lab_proc;  ?>.</td>
                      <td><?php 
					  $qry_lab_test = mysqli_query($conn, "SELECT `procedure_name` FROM `procedure_masters`  where `id`='".$row2_lab_proc['procedure_id']."'"); 
						$row3_lab_test = mysqli_fetch_array($qry_lab_test); 
					  echo $row3_lab_test['procedure_name'];  ?><?php if($row2_lab_proc['procedure_remarks']!='') { echo ' ( '.$row2_lab_proc['procedure_remarks'].' ) '; }  ?></td>
                      <td style="text-align:right !important; padding-right:19px"><?php echo number_format(($row2_lab_proc['net_amount']),2);  ?></td>
                    </tr>
                    <?php	$procedure_amt_tot=$procedure_amt_tot+$row2_lab_proc['net_amount']; 
					$sl_lab_proc++; } ?>
                     <?php if($row3['discount_type']!=''){ ?>
                     <tr>
                      <td>&nbsp;</td>
                      <td>Less Discount:( <?php if($row3['discount_type']=='F'){ echo '-'.$row3['discount']; }else{ echo $row3['discount'].'%'; }
					  
					  ?> )</td>
                      <td style="text-align:right !important; padding-right:19px"><?php $balance_amt=$row3['total']-$procedure_amt_tot; echo number_format(($balance_amt),2);  ?></td>
                    </tr>
                     <?php } ?>
                   
                    <!-------------------------row end--------------------->
                  </table>
                  
                  <table class="ot" style="width:100%" cellpadding="0" cellspacing="0" align="center">
                   <?php 
				  if($approved_amt>0){
					  $co_pay_amt=$row3['total']-$approved_amt;
				  
				  ?>
                  <tr>
                      <th width="4%">&nbsp;</th>
                      <th width="85%" style="text-align:right !important;"><strong>Approved Amount:</strong></th>
                      <th width="11%" style="text-align:right !important; padding-right:19px"><strong><?php echo number_format(($approved_amt),2);  ?></strong></th>
                    </tr>
                    <tr>
                      <th width="4%">&nbsp;</th>
                      <th width="85%" style="text-align:right !important;"><strong>Co. Payment:</strong></th>
                      <th width="11%" style="text-align:right !important; padding-right:19px"><strong><?php echo number_format(($co_pay_amt),2);  ?></strong></th>
                    </tr>
                    <?php 
				 	 }
					?>
                  
                    <tr>
                      <th width="4%">&nbsp;</th>
                      <th width="85%" style="text-align:right !important;"><strong>TOTAL:</strong></th>
                      <th width="11%" style="text-align:right !important; padding-right:19px"><strong><?php echo number_format(($row3['total']),2);  ?></strong></th>
                    </tr>
                    
                    
                    <!-------------------------row end--------------------->
                  </table>
                 
                </div>
                <div class="col-md-12">
                  <table class="ot" style="width:100%"  cellpadding="0" cellspacing="0" >
                    <tr >
                      <td colspan="2"><span style="font-weight:bold;border-bottom: 1px dotted black;padding-left:2px !important;font-size:14px;">Rupees <?php echo ucwords(number_to_indian_rupees_convert($row3['total']));?> only</span></td>
                      
                    </tr>
                   
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>                    
                    <!-------------------------row end--------------------->
                  </table>
                </div>
                <div class="col-md-12">
                  <table class="ot" style="width:70%" border="1" cellpadding="0" cellspacing="0" >
                   
                    <tr>
                      <td colspan="2" style="font-weight:bold;padding-left:2px !important;">Payment Received with thanks by <?php $sql7_user="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";
						 $result7_user=$conn->query($sql7_user) ;				
						 $row7_user = $result7_user->fetch_assoc();
						 $count7_user=$result7_user->num_rows;
						 if($count7_user>0)
						 {
							echo $created_by=$row7_user['name'];
						 } ?></td>
                      
                    </tr>
                    <?php 
					$condition=" AND `invoice_final_payment_billing`.`del_flag`='0' ";
				  if($del_flag=='1'){
					  $condition=" AND `invoice_final_payment_billing`.`del_flag`='1' ";
				  }
					$sql_lab_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id` WHERE `invoice_final_payment_billing`.`i_id` = '".$id."'  $condition ";
			$result_lab_payment = $conn->query($sql_lab_payment);
			if($result_lab_payment->num_rows > 0){
				while ($row2_lab_payment=mysqli_fetch_array($result_lab_payment,MYSQLI_ASSOC))
														{
				?>
                    <tr>
                      <td colspan="2" style="font-weight:bold;padding-left:2px !important;"><?php echo $row2_lab_payment['payment_type_name'].' :-> '.$row2_lab_payment['payment_mode_name'].' : '.number_format(($row2_lab_payment['p_value']),2).' ( on '.date("d-m-Y", strtotime($row2_lab_payment['payment_date'])).'  '.date("h:i A", strtotime($row2_lab_payment['payment_time'])).' )';  ?></td>
                      
                    </tr>
                    <?php }} ?>
                    
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>                    
                    <!-------------------------row end--------------------->
                  </table>
                </div>
                <div class="col-md-12">
                  
                  <table class="ot" style="width:100%" cellpadding="0" cellspacing="0" align="center">                    
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><u>Terms &amp; Conditions:</u></td>
                      <td style="border-bottom:1px solid #666; padding-bottom:4px;"><strong>Reciever's Signature:</strong></td>
                    </tr>
                    <tr>
                      <td>E. &amp; O.E</td>
                      <td style="text-align:right">for <b><?php echo $row_hospital_info['hospital_name'];  ?></b><br>
                        Authorised Signatory</td>
                    </tr>
                    <!-------------------------row end--------------------->
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- END PAGE CONTENT --> 
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "footer_for_final_bill_edit_print.php" ?>