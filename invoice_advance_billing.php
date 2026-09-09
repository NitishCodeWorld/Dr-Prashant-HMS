<?php 
include 'function.php';
include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	// Data Edit
		$patient_id=mysqli_real_escape_string($conn,$_REQUEST['patient_id']);
		$hospital_number=mysqli_real_escape_string($conn,$_REQUEST['hospital_number']);
		$name=mysqli_real_escape_string($conn,$_REQUEST['name']);		
		$doc_id=mysqli_real_escape_string($conn,$_REQUEST['doc_id']);
		$mobile_prefix=mysqli_real_escape_string($conn,$_REQUEST['mobile_prefix']); 		
		$mobile=mysqli_real_escape_string($conn,$_REQUEST['mobile']); 
		$email=mysqli_real_escape_string($conn,$_REQUEST['email']); 
		$age=mysqli_real_escape_string($conn,$_REQUEST['age']);
		$address=mysqli_real_escape_string($conn,$_REQUEST['address']);		
		
		$admission_date = date("Y-m-d", strtotime($_REQUEST['admission_date']));
  		$admission_time =date("H:i", strtotime($_REQUEST['admission_time']));	
		$date_of_discharge = date("Y-m-d", strtotime($_REQUEST['date_of_discharge']));
  		$time_of_discharge =date("H:i", strtotime($_REQUEST['time_of_discharge']));		
		$bill_type=mysqli_real_escape_string($conn,$_REQUEST['bill_type']);	
		
		$pt_type=mysqli_real_escape_string($conn,$_REQUEST['pt_type']);		
		$countiopc=mysqli_real_escape_string($conn,$_REQUEST['countiopc']);
		$discount_purpose=mysqli_real_escape_string($conn,$_REQUEST['discount_purpose']);		
		$discount=mysqli_real_escape_string($conn,$_REQUEST['discount']);
		$discount_type=mysqli_real_escape_string($conn,$_REQUEST['discount_type']);
		$total=mysqli_real_escape_string($conn,$_REQUEST['total']);				
		$status=mysqli_real_escape_string($conn,$_REQUEST['status']);
		
		$amount_due=0;
		if($amount_due==1){
			$status=2;
			$advance_amount="";
		}	
			
		$created_by=mysqli_real_escape_string($conn,$_REQUEST['created_by']);
		$created_on=mysqli_real_escape_string($conn,$_REQUEST['created_on']);
		$billing_date = date("Y-m-d", strtotime($_REQUEST['billing_date']));
  		$billing_time =date("H:i", strtotime($_REQUEST['billing_time']));		
				
		$today_month_check=date('m');	
		//$today_month_check='04';		
		if($today_month_check<4){
			$year=(date('Y')-1).'-04-01';
			$year_next=(date('Y')).'-03-31';
		}else{
			$year=date('Y').'-04-01';
			$year_next=(date('Y')+1).'-03-31';
		}
		$opd_flag=mysqli_real_escape_string($conn,$_REQUEST['opd_flag']);
		
		$sql2="SELECT MAX(`invo_no`) AS `max_invo` FROM `invoice_final_billing_advance` WHERE date(`created_on`) BETWEEN '".$year."' AND '".$year_next."' AND `opd_flag`='".$opd_flag."'";
		$result2=$conn->query($sql2) ;	
		$row2 = $result2->fetch_assoc();	
		$max_invo= $row2['max_invo']+1;	
		
		
		$gender=mysqli_real_escape_string($conn,$_REQUEST['gender']);
		 
		$count_payment_mode=mysqli_real_escape_string($conn,$_REQUEST['count_payment_mode']);
		$advance_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['advance_payment_amt_text']);
		$instant_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['instant_payment_amt_text']);
		$refund_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['refund_payment_amt_text']);
		$net_payment_amt_text=mysqli_real_escape_string($conn,$_REQUEST['net_payment_amt_text']);
	
		
		$sql = "INSERT INTO `invoice_final_billing_advance` SET `hospital_number`='".$hospital_number."',`patient_id`='".$patient_id."', `invo_no`='".$max_invo."', `name`='".$name."',`address`='".$address."',`mobile_prefix` ='".$mobile_prefix."',`mobile` ='".$mobile."',`email`='".$email."',`age` ='".$age."',`pt_type`='".$pt_type."',`discount`='".$discount."',`discount_purpose`='".$discount_purpose."',`discount_type`='".$discount_type."',`total`='".$total."',`status`='".$status."',`print_status`='1',`doc_id`='".$doc_id."',`created_by`='".$created_by."',`created_on`='".$created_on."' ,`billing_date`='".$billing_date."',`billing_time`='".$billing_time."',`amount_due`='".$amount_due."',`opd_flag`='".$opd_flag."',`admission_date`='".$admission_date."' ,`admission_time`='".$admission_time."' ,`date_of_discharge`='".$date_of_discharge."' ,`time_of_discharge`='".$time_of_discharge."' ,`bill_type`='".$bill_type."' ,`gender`='".$gender."' ,`advance_payment_amt_text`='".$advance_payment_amt_text."',`instant_payment_amt_text`='".$instant_payment_amt_text."',`refund_payment_amt_text`='".$refund_payment_amt_text."',`net_payment_amt_text`='".$net_payment_amt_text."' ";	
		
			
		
		
		if($conn->query($sql)===TRUE)
		{
			$msg="Record updated successfully";
			$flg=0;		
			$id = $conn->insert_id;	
											
				for($i=1;$i<=$countiopc;$i++) {
				 if($_REQUEST['procedure_id'.$i]!='')
				   {
					 $sql4 = $conn->query("INSERT INTO `invoice_final_procedure_advance` SET `hospital_number`='".$hospital_number."',`patient_id`='".$patient_id."' ,`i_id` = '".$id."',`procedure_id` = '".$_REQUEST['procedure_id'.$i]."',`amount` = '".$_REQUEST['amount'.$i]."',`discount` = '".$_REQUEST['discount'.$i]."',`net_amount` = '".$_REQUEST['net_amount'.$i]."',`surgery_flag` = '".$_REQUEST['surgery_flag'.$i]."',`created_by`='".$created_by."',`created_on`='".$created_on."'");						
						
					 
				   }   
				}
				
		
		
		$p_action="S";
			
				
		if($status!=2){	
				for($i=1;$i<=$count_payment_mode;$i++) {
				 if($_REQUEST['p_key'.$i]!='')
				   {
					 $sql4 = $conn->query("INSERT INTO `invoice_final_payment_billing_advance` SET `hospital_number`='".$hospital_number."',`patient_id`='".$patient_id."' ,`i_id` = '".$id."',`p_key` = '".$_REQUEST['p_key'.$i]."',`p_value` = '".$_REQUEST['p_value'.$i]."',`p_action` = '".$p_action."',`tpa_name` = '".$_REQUEST['tpa_name'.$i]."',`claim_no` = '".$_REQUEST['claim_no'.$i]."',`payment_date` = '".date("Y-m-d", strtotime($_REQUEST['payment_date'.$i]))."',`payment_time` = '".date("H:i", strtotime($_REQUEST['payment_time'.$i]))."',`payment_type` = '".$_REQUEST['payment_type'.$i]."',`payment_mode_flag` = '1',`created_by`='".$created_by."',`created_on`='".$created_on."'");						
						
					 
				   }   
				}
			}	
			
						
			$redirectUrlPrint=ADMIN_URL.'print_final_bill_advance.php?id='.$id;
			$redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard_advance.php?msg='.$msg.'&flg='.$flg;
			echo "<script type=\"text/javascript\"> window.open('$redirectUrlPrint', '_blank'); window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
			 $redirectUrl=ADMIN_URL.'final_billing_archieve_dashboard_advance.php?msg='.$msg.'&flg='.$flg;
			echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

		}

}
?>
<?php include "header.php"; ?>
<link href="select2/select2.css" rel="stylesheet" />
<style>
[data-id="chief"] {
 max-width: 630px !important;
}
#general_instructions_subpackage {
	width: 1030px !important;
}
#s2id_autogen1 {
	width: 180px !important;
}
</style>
<style>
.control-label {
	color: black !important;
	font-weight:bold !important;
}
.portlet-body > label {
	color: black !important;
	font-weight:bold !important;
}
.portlet-body .row {
	background:#dcefff !important;
	font-weight:bold !important;
}
.portlet.light {
	background:#fff !important;
	font-weight:bold !important;
}
.footer-block {
	background: transparent !important;
	font-weight:bold !important;
}
.font-green-sharp {
	color: black !important;
	font-weight:bold !important;
}
.font-black-sharp {
	color: black !important;
	font-weight:bold !important;
}
.select2-container {
	width: 342.083px !important;
}
#span_title {
	color:#b32424;
	font-weight:bold;
	text-transform:uppercase;
	font-size:16px;
	display: list-item;
	margin-left : 1em;
}
#span_title_new {
	color:#f9f8f8;
	font-weight:bold;
	text-transform:uppercase;
	font-size:16px;
	display: list-item;
	margin-left : 1em;
}
</style>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container"> 
  
  <!-- BEGIN PAGE HEAD -->
  
  <div class="page-head">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE TITLE -->
      
      <div class="page-title">
        <h1><small>Welcome to EMR Dashboard</small></h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
          <li class="active"> Manage </li>
        </ul>
      </div>
      
      <!-- END PAGE TITLE --> 
      
    </div>
  </div>
  
  <!-- END PAGE HEAD --> 
  
  <!-- BEGIN PAGE CONTENT -->
  
  <div class="page-content">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE CONTENT INNER -->
      
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Billing</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div id="reg_div">
                <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                  <div class="form-body">
                    <div class="col-md-12">
                      <div class="portlet-body">
                        <div class="row"> </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff;!important; padding:9px 0px">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Enter MRD No. / Hospital No. Click On Check</label>
                          <div class="input-group">
                            <select name="mrd_check" id="mrd_check" class="form-control select2" onChange="mrd_check_ajax();">
                              <option value="">Choose..</option>
                              <?php 
                                      $sql7="SELECT * FROM `patient_admission_form`  WHERE  `del_flag`='0'   ORDER BY `id` DESC";
                                     $result7=$conn->query($sql7) ;
                                     while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                                     {									 
                                         echo '<option value="'.$row7['uhid_no'].'" ';  echo '>'.$row7['uhid_no'].' ( '.$row7['patient_name'].' '.$row7['phone_no'].' )</option>';
                                     }
                                    ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8" style="padding-top:25px !important;">
                        <div class="form-group"> </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- 48 hours code-->
                  
                </form>
                
                <!-- BEGIN FORM-->
                <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                  <div class="form-body">
                    <div class="col-md-12">
                      <div class="portlet-body">
                        <div class="row">
                          <input type="hidden" id="created_on" name="created_on" class="form-control" value="<?php echo date('Y-m-d H:i:s');?>">
                          <input type="hidden" id="created_by" name="created_by" class="form-control" value="<?php echo $_SESSION['id'];?>">
                          <input type="hidden" id="status" name="status" class="form-control" value="1">
                          <input type="hidden" id="patient_id" name="patient_id" class="form-control" >
                          <!-- <input type="hidden" id="ipd_flag" name="ipd_flag" class="form-control" value="<?php if($_SESSION['role']=='3'){ echo 1;}else{ echo 0;}?>">-->
                          <input type="hidden" id="opd_flag" name="opd_flag" class="form-control" value="0">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff;!important; padding:9px 0px">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">MRD No. / Hospital No.</label>
                          <input type="text" id="hospital_number" name="hospital_number" class="form-control" placeholder="Enter Text"  readonly />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Date</label>
                          <input class="form-control form-control-inline date-picker" type="date"  placeholder="Select Date" id="crdate" name="crdate" value="<?php echo date("Y-m-d"); ?>" readonly />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Name</label>
                          <input type="text" id="name" name="name" class="form-control" placeholder="Enter Text"  />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Doctor</label>
                          <select class=" form-control select2" name="doc_id" id="doc_id" >
                            <option value="0">Select Doctor</option>
                            <?php 
								  $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5' AND `users`.`del_flag`='0' ORDER BY `user_infos`.`name` ASC ";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';

								 }
					 			?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Mobile</label>
                          <div class="input-group"> <span class="input-group-addon" style="padding:0 !important; width:20% !important">
                            <input type="text" id="mobile_prefix" name="mobile_prefix" class="form-control" value="<?php echo $row['mobile_prefix']; ?>" placeholder="+91"  />
                            </span> <span class="input-group-addon" style="padding:0 !important; width:70% !important">
                            <input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo $row['mobile']; ?>" placeholder="Enter 10 digit Phone No."  />
                            </span> </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Gender/Sex</label>
                          <input type="hidden" id="email" name="email" class="form-control" placeholder="Enter Text" />
                          <select class="form-control" name="gender" id="gender">
                            <option value="">Choose..</option>
                            <?php 
								  $sql7="SELECT `id`, `gender` FROM `gender_masters`  WHERE  `del_flag`='0' ORDER BY `id` ASC";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
								 {									 
									 echo '<option value="'.$row7['id'].'" '; echo '>'.$row7['gender'].'</option>';
								 }
					 			?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Age</label>
                          <input type="text" id="age" name="age" class="form-control" placeholder="Enter Text" />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Address</label>
                          <textarea id="address" name="address" class="form-control" placeholder="Full Address with Vill./Ward No."></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <p>&nbsp;</p>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Admission Date</label>
                          <input class="form-control form-control-inline date-picker" type="date"  placeholder="Select Date" id="admission_date" name="admission_date"  readonly />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Admission Time</label>
                          <input class="form-control form-control-inline date-picker" type="time"  placeholder="Select Date" id="admission_time" name="admission_time"  readonly />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Discharge Date</label>
                          <input class="form-control form-control-inline date-picker" type="text"  placeholder="Select Date" id="date_of_discharge" name="date_of_discharge"    />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Discharge Time</label>
                          <input class="form-control form-control-inline date-picker" type="text"  placeholder="Select Time" id="time_of_discharge" name="time_of_discharge"   />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">PT Type</label>
                          <select class=" form-control" name="pt_type" id="pt_type" onChange="retrieve_procedure();" >
                            <?php 
								  $sql7="SELECT `id`, `name` FROM `patient_type_master`  WHERE  `del_flag`='0' ORDER BY `name` ASC";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
								 {									 
									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';
								 }
					 			?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Bill Type</label>
                          <select class=" form-control" name="bill_type" id="bill_type" onChange="retrieve_procedure();" >
                            <?php 
								  $sql7="SELECT `id`, `bill_type_name` FROM `bill_type_masters`  WHERE  `del_flag`='0' ORDER BY `bill_type_name` ASC";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
								 {									 
									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['bill_type_name'].'</option>';
								 }
					 			?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Billing Date & Time(dd-mm-YYYY)(h:m A)</label>
                          <div class="input-group">
                            <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Billing Date" id="billing_date" name="billing_date" value="<?php echo date("d-m-Y");  ?>" />
                            <span class="input-group-addon" style="padding:0 !important; width:50% !important">
                            <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Billing Time" name="billing_time" id="billing_time" value="<?php  echo date("h:i A");  ?>"  />
                            </span></div>
                        </div>
                      </div>
                      <div id="defualt_individual" style="display:block;">
                        <div class="col-md-12" style="text-align:left;font-weight:bold;"><b>To Add Procedure, Please Click On This Icon</b><a href="javascript:void(0);"  id="iop_add_buttonc" class="btn" title="Add One Procedure" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                        <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                          <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover" id="iop_tabc">
                              <?php
									$count=1;
									$sl=1;
                                     echo '<input type="hidden" name="countiopc" id="countiopc" value="'.$count.'">';
                                  ?>
                              <tr>
                                <th>Advance Purpose</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Net Amount</th>
                                <th>&nbsp;</th>
                              </tr>
                              <tr id="iopc<?php echo $sl; ?>">
                                <td ><textarea name="procedure_id<?php echo $sl; ?>" id="procedure_id<?php echo $sl; ?>"  class="form-control "  ></textarea></td>
                                <td ><input type="number" class="form-control" placeholder="Enter Text" name="amount<?php echo $sl; ?>" id="amount<?php echo $sl; ?>" onKeyUp="amount('amount<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();" ></td>
                                <td ><input type="number" class="form-control" placeholder="Enter Text" name="discount<?php echo $sl; ?>" id="discount<?php echo $sl; ?>"  onKeyUp="discount_amount('discount<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();" ></td>
                                <td ><input type="number" class="form-control" placeholder="Enter Text" name="net_amount<?php echo $sl; ?>" id="net_amount<?php echo $sl; ?>" onKeyUp="calculate_sales();"  >
                                  <input type="hidden" name="surgery_flag<?php echo $sl; ?>" id="surgery_flag<?php echo $sl; ?>" value="0"></td>
                                <td ><a href="javascript:void(0);"  id="iop_removec<?php echo $sl; ?>" onClick="remove_iopc('<?php echo $sl; ?>');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Discount Purpose</label>
                          <input type="text" id="discount_purpose" name="discount_purpose" class="form-control" placeholder="Enter Text"  />
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="control-label">Discount Type</label>
                          <select class="form-control" name="discount_type" id="discount_type"   >
                            <option value="">-Select-</option>
                            <option value="P">% Discount</option>
                            <option value="F">Gross Discount</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Discount Amount</label>
                          <input type="number" id="discount" name="discount" class="form-control" placeholder="Enter Text"  value="0" onKeyUp="calculate_sales()"/>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label" style="color:red !important;">Please Click On Calculate Button</label>
                          <br>
                          <button type="button" name="calcu" id="calcu" class="btn red" onClick="calculate_sales()" >Calculate</button>
                        </div>
                      </div>
                      <div class="col-md-12" style="text-align:left;font-weight:bold;color:blue;font-size:16px;"><b>Net Total: </b><span id="net_tot" style="color:red;">0</span>
                        <input type="hidden" id="total" name="total" class="form-control" placeholder="Enter Text"  value="0"/>
                      </div>
                      <div class="col-md-12">
                        <p>&nbsp;</p>
                      </div>
                      <div id="package_hos_sub_div" style="display:block;padding-left:40px;">
                        
                        <div class="col-md-12" style="text-align:left;font-weight:bold;color:blue;font-size:16px;"><b>Patient's Expenses Book</b> <span>
                          <button type="button" name="expnece_get_btn" id="expnece_get_btn" class="btn-circle btn blue" onClick="view_expense_details();" >Click here to get details</button>
                          </span></div>
                        
                        <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                          <div class="table-scrollable" style="border: 0 !important;">
                            <table class="table table-striped table-bordered table-advance table-hover" id="iop_expences_sub" style="width:100% !important;">
                              <thead>
                                <tr>
                                  <th style="font-size:16px;font-weight:bold;">Sl No.</th>
                                  <th style="width:70% !important;font-size:16px;font-weight:bold;">Expenses About</th>
                                  <th style="font-size:16px;font-weight:bold;">Amount</th>
                                </tr>
                              </thead>
                              <tbody id="iop_expences_body">
                              </tbody>
                              <tfoot>
                                <tr  style="border: 3px solid #0014ff !important;font-size:19px;font-weight:bold;background-color: #d7d0d0 !important;">
                                  <td>Total of Expenses :
                                    <input type="hidden" id="total_expenses" name="total_expenses" class="form-control" placeholder="Enter Text"  value="0"/></td>
                                  <td colspan="2" style="text-align:right;padding-right:25px;font-size:16px;color:red;"><span id="total_expenses_net_tot" style="color:red;font-size:19px;font-weight:bold;">0</span></td>
                                </tr>
                                
                              </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <p>&nbsp;</p>
                      </div>
                      <!--<div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label" style="text-align:left;font-weight:bold;color:green !important;font-size:16px;"><br />
                            <b>If you want to pay in advance, please enter advance amount: </b></label>
                          <input type="number" id="advance_amount" name="advance_amount" class="form-control" placeholder="Enter Advance Amount" onblur="over_under_paid_calculation();" />
                        </div>
                      </div>--> 
                    </div>
                    <div class="row" style="background:#3e9999 !important; padding:9px 0px;">
                      <div class="col-md-12">
                        <label for="nameField"><span id="span_title_new"><u>Payment Mode:</u></span></label>
                      </div>
                      <div class="col-md-12" style="margin-bottom:4px; padding:0"><b>To add more, please click on this icon</b><a href="javascript:void(0);"  id="iop_payment_mode_add_btn" class="btn" title="Add more" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                      <div class="col-md-12" style="overflow-x: auto !important;">
                        <table class="table table-striped table-bordered table-advance table-hover" id="payment_mode_tab" style="overflow-x: auto !important;">
                          <thead>
                            <tr>
                              <th style="min-width:50px !important;width:50px !important;"> SL.No </th>
                              <th style="min-width:150px !important;width:150px !important;"> Payment Mode </th>
                              <th style="min-width:150px !important;width:150px !important;"> Payment Amount </th>
                              <th style="min-width:250px !important;width:250px !important;"> Date & Time </th>
                              <th style="min-width:100px !important;width:100px !important;"> Claim No. / Cheque No. </th>
                              <th style="min-width:150px !important;width:150px !important;"> TPA/ Govt. Health Scheme </th>
                              <th style="min-width:150px !important;width:150px !important;"> Payment Type </th>
                              <th style="min-width:50px !important;width:50px !important;">&nbsp; </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
								 $sl=1;
								 $sql2="SELECT * FROM `invoice_final_payment_billing` WHERE `i_id`= '" .$_REQUEST['id']. "' and `del_flag`='0' ";
								 $result2=$conn->query($sql2) ;
								 $count=$result2->num_rows;
								if($count=='0'){
								  echo '<input type="hidden" name="count_payment_mode" id="count_payment_mode" value="'.($count+1).'">';
							 ?>
                            <tr id="payment_mode_iop<?php echo ($count+1); ?>">
                              <td ><?php echo ($count+1); ?></td>
                              <td ><select name="p_key<?php echo ($count+1); ?>" id="p_key<?php echo ($count+1); ?>" class="form-control" onChange="option_payment(<?php echo ($count+1); ?>);">
                                  <option value=""> Choose..</option>
                                  <?php
                                  
                                   $query1="SELECT `id`, `payment_mode_name` FROM `payment_mode_masters` WHERE `del_flag`='0' ORDER BY `id`" ;
                                        $rslt=$conn->query($query1);
                                        while($rowd=mysqli_fetch_array($rslt)){
                                            echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_mode_name'].'</option>'; 
                                   
                                    }
                                  ?>
                                </select></td>
                              <td ><input type="number" class="form-control" placeholder="Enter Payment Amt." name="p_value<?php echo ($count+1); ?>" id="p_value<?php echo ($count+1); ?>"  value="0" onKeyUp="summation_payment(<?php echo ($count+1); ?>);" onBlur="over_under_paid_calculation();" readonly="readonly">
                                <input type="hidden" name="payment_mode_flag<?php echo ($count+1); ?>" id="payment_mode_flag<?php echo ($count+1); ?>" value="0"></td>
                              <td ><div class="input-group">
                                  <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Payment Time" name="payment_date<?php echo ($count+1); ?>" id="payment_date<?php echo ($count+1); ?>" value="<?php echo date("d-m-Y");  ?>" readonly="readonly" />
                                  <span class="input-group-addon" style="padding:0 !important; width:50% !important">
                                  <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Payment Time" name="payment_time<?php echo ($count+1); ?>" id="payment_time<?php echo ($count+1); ?>" value="<?php  echo date("h:i A");  ?>"  readonly="readonly" />
                                  </span> </div></td>
                              <td ><input type="text" class="form-control" placeholder="Enter claim no. / Cheque No." name="claim_no<?php echo ($count+1); ?>" id="claim_no<?php echo ($count+1); ?>"  value="" readonly="readonly"></td>
                              <td ><select name="tpa_name<?php echo ($count+1); ?>" id="tpa_name<?php echo ($count+1); ?>" class="form-control select2" readonly="readonly">
                                  <option value=""> Choose..</option>
                                </select></td>
                              <td ><select name="payment_type<?php echo ($count+1); ?>" id="payment_type<?php echo ($count+1); ?>" onChange="summation_payment(<?php echo ($count+1); ?>);over_under_paid_calculation();"  class="form-control" readonly="readonly">
                                  <?php
                                  
                                   $query1="SELECT `id`, `payment_type_name` FROM `payment_type_masters` WHERE `del_flag`='0' AND `advance_flag`='1' ORDER BY `id`" ;
                                        $rslt=$conn->query($query1);
                                        while($rowd=mysqli_fetch_array($rslt)){
                                            echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_type_name'].'</option>'; 
                                   
                                    }
                                  ?>
                                </select></td>
                              <td >&nbsp;</td>
                            </tr>
                            <?php } ?>
                          <input type="hidden" name="remove_id_for_payment_mode" id="remove_id_for_payment_mode" value="">
                            </tbody>
                          
                        </table>
                      </div>
                    </div>
                    <div class="row" style="background:#c9cfc8  !important; padding:9px 0px;color:#c9cfc8  !important;">
                      <div class="col-md-12" style="font-size:16px !important">
                        <p>&nbsp;</p>
                      </div>
                      <div class="col-md-12" style="font-size:16px !important">
                        <div class="col-md-4"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Advance Payment Amt. -> </strong></span> <strong><span id="advance_payment_amt_span" style="color:red;">0</span>
                          <input type="hidden" name="advance_payment_amt_text" id="advance_payment_amt_text" value="0" />
                          </strong> </div>
                        <div class="col-md-4"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Instant Payment Amt. -> </strong></span> <strong><span id="instant_payment_amt_span" style="color:red;">0</span>
                          <input type="hidden" name="instant_payment_amt_text" id="instant_payment_amt_text" value="0" />
                          </strong> </div>
                        <div class="col-md-4"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Refund Payment Amt. -> </strong></span> <strong><span id="refund_payment_amt_span" style="color:red;">0</span>
                          <input type="hidden" name="refund_payment_amt_text" id="refund_payment_amt_text" value="0" />
                          </strong> </div>
                      </div>
                      <div class="col-md-12" style="font-size:16px !important">
                        <p>&nbsp;</p>
                      </div>
                      <div class="col-md-12" style="font-size:16px !important">
                        <div class="col-md-4"> </div>
                        <div class="col-md-4"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Net Payment Amt. -> </strong></span> <strong><span id="net_payment_amt_span" style="color:red;">0</span>
                          <input type="hidden" name="net_payment_amt_text" id="net_payment_amt_text" value="0" />
                          </strong> </div>
                        <div class="col-md-4"> </div>
                      </div>
                      <div class="col-md-12" style="font-size:16px !important">
                        <p>&nbsp;</p>
                      </div>
                      <div class="col-md-12" style="font-size:16px !important">
                        <div class="col-md-4">
                          <input type="hidden" id="amount_due" name="amount_due" value="0"  />
                        </div>
                        <div class="col-md-8" id="underpaid"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Amount to be paid -> </strong></span> <span id="to_be_underpaid" style="color:red;">0</span> </div>
                        <div class="col-md-8" id="overpaid" style="display:none;"> <span class="caption-subject font-black-sharp" style="color:#1625e3  !important;"><strong>Amount to be reduced -> </strong></span> <span id="to_be_overpaid" style="color:red;">0</span> </div>
                      </div>
                    </div>
                  </div>
                  <p style="padding:12px 0 2px 0; text-align:center;" id="register_para" >
                    <input type="hidden" name="break_up_flag" id="break_up_flag" class="form-control" value="0">
                    <input type="hidden" name="check_sub_previous" id="check_sub_previous" class="form-control" value="0">
                    <input type="hidden" name="check_sub" id="check_sub" class="form-control" value="0">
                    <input type="hidden" name="hidden_button" id="hidden_button" class="form-control" value="0">
                    <button type="button" name="register" id="register" class="btn blue" disabled >Submit & Print</button>
                    <button type="submit" name="submit" id="submit" class="btn blue" style="display:none;" disabled>Submit & Print</button>
                    <button type="button" name="reset" id="reset" class="btn red" onClick="reset_forms_val();" >Reset</button>
                    <input type="hidden" name="request_mrd" id="request_mrd" class="form-control" value="<?php if(isset($_REQUEST['request_mrd'])){ echo $_REQUEST['request_mrd'];};?>" />
                  </p>
                  
                  <!-- 48 hours code-->
                  
                </form>
                <!-- END FORM--> 
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- END EXAMPLE TABLE PORTLET--> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTENT INNER --> 
  
</div>

<!-- END PAGE CONTENT --> 

<!-- END PAGE CONTAINER --> 

<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script src="select2/select2.min.js"></script> 
<script type="text/javascript"> 
retrieve_procedure();

      $(document).ready( function() { 
	  $("#mrd_check").select2();
	  $("#doc_id").select2();
		
		setTimeout('$("#alert_msg").hide()',3000);
		$("#procedure_id1").select2();
		$("#procedure_id_insur1").select2();
		$("#procedure_id_hos1").select2();
		$("#tpa_name1").select2();
		$("#tpa_name1").attr('readonly', true);
		
		$('#country option[value="Nepal"]').attr("selected", "selected");		
		$("#mobile_prefix").val("+977");

		$("#country").change(function(){
			var country=$("#country").val();
			if(country=='India'){
				$("#mobile_prefix").val("+91");
			}
			if(country=='Nepal'){
				$("#mobile_prefix").val("+977");
			}
			if(country=='Others'){
				$("#mobile_prefix").val("");
			}
		});
		
		$("#billing_date").datepicker({
			   format: 'dd-mm-yyyy'
		   });
		   
		 $("#billing_time").timepicker({
			   timeFormat: 'h:mm p'
		   });
	   		
		  $("#date_of_discharge").datepicker({
			   format: 'dd-mm-yyyy'
		   });
		   
		   $("#time_of_discharge").timepicker({
			   timeFormat: 'h:mm p'
		   });
		   
		   $("#payment_date1").datepicker({
				format: 'dd-mm-yyyy'
			});
			$("#payment_time1").timepicker({
				timeFormat: 'h:mm p'
			});
	   
	     
		 
		 $("#amount_due").click(function(){
				if($(this).prop("checked") == true){
					var empty=1;
					$("#amount_due").val(empty);
					var tot_span=$("#total").val();
					$("#to_be_overpaid").html(tot_span);
					$("#to_be_underpaid").html(tot_span);
				}
				else if($(this).prop("checked") == false){
					var empty=0;
					$("#amount_due").val(empty);
				}
			});
		
		
		
		
		 
		$("#iop_add_buttonc").click(function(){ 
			 var i=$("#countiopc").val();			 
			 i=parseInt(i)+1;
			 $("#countiopc").val(i);
			  var pt_type=$("#pt_type").val();				
				var bill_type=$("#bill_type").val();
				
				 //alert(i);
			 $("#iop_tabc").append('<tr id="iopc' + i + '"><td ><select  name="procedure_id' + i + '" id="procedure_id' + i + '"  class="form-control select2" onChange="retrieve_amount(\'procedure_id' + i + '\',\'' + i + '\'),retrieve_break_hos(\'procedure_id' + i + '\',\'' + i + '\');calculate_sales();view_expense_details();" ><option value="">Select Procedure</option></select></td> <td > <input type="number" class="form-control" placeholder="Enter Text" name="amount' + i + '" id="amount' + i + '" onKeyUp="amount(\'amount' + i + '\',\'' + i + '\');calculate_sales();" ></td><td ><input type="number" class="form-control" placeholder="Enter Text" name="discount' + i + '" id="discount' + i + '"  onKeyUp="discount_amount(\'discount' + i + '\',\'' + i + '\');calculate_sales();" ></td><td ><input type="number" class="form-control" placeholder="Enter Text" name="net_amount' + i + '" id="net_amount' + i + '" onKeyUp="calculate_sales();"><input type="hidden" class="form-control" placeholder="Enter Text" name="surgery_flag' + i + '" id="surgery_flag' + i + '" value="0" ></td><td ><a href="javascript:void(0);"  id="iop_removec' + i + '" onClick="remove_iopc('+ i +');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
			 $("#procedure_id"+i).select2();
			retrieve_procedure_next();
			calculate_sub_sales();
							
		 });
		 
		 
		 $("#iop_payment_mode_add_btn").live('click',function(){ 
					 var i=$("#count_payment_mode").val();
					 i=parseInt(i)+1;
					 $("#count_payment_mode").val(i);
					 //alert(i);
					 $("#payment_mode_tab").append('<tr id="payment_mode_iop'+i+'" style="background-color: #f5f5f5 !important;"><td >'+i+'</td><td ><select name="p_key'+i+'" id="p_key'+i+'" class="form-control" onChange="option_payment('+ i +');"><option value=""> Choose..</option><?php $query1="SELECT `id`, `payment_mode_name` FROM `payment_mode_masters` WHERE `del_flag`='0' ORDER BY `id`" ; $rslt=$conn->query($query1); while($rowd=mysqli_fetch_array($rslt)){ echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_mode_name'].'</option>';  } ?> </select></td><td ><input type="number" class="form-control" placeholder="Enter Payment Amt." name="p_value'+i+'" id="p_value'+i+'"  value="0" onKeyUp="summation_payment('+ i +');" onBlur="over_under_paid_calculation();" readonly="readonly"> <input type="hidden" name="payment_mode_flag'+i+'" id="payment_mode_flag'+i+'" value="0"></td><td ><div class="input-group"><input type="text" class="form-control form-control-inline date-picker" placeholder="Select Payment Time" name="payment_date'+i+'" id="payment_date'+i+'" value="<?php echo date("d-m-Y");  ?>" readonly="readonly" /><span class="input-group-addon" style="padding:0 !important; width:50% !important"><input type="text" class="form-control form-control-inline time-picker" placeholder="Select Payment Time" name="payment_time'+i+'" id="payment_time'+i+'" value="<?php  echo date("h:i A");  ?>"  readonly="readonly" /> </span> </div></td><td ><input type="text" class="form-control" placeholder="Enter claim no. / Cheque No." name="claim_no'+i+'" id="claim_no'+i+'"  value="" readonly="readonly"></td><td ><select name="tpa_name'+i+'" id="tpa_name'+i+'" class="form-control select2" readonly="readonly"><option value=""> Choose..</option> </select></td> <td ><select name="payment_type'+i+'" id="payment_type'+i+'" class="form-control" onChange="summation_payment('+ i +');over_under_paid_calculation();" readonly="readonly"><?php $query1="SELECT `id`, `payment_type_name` FROM `payment_type_masters` WHERE `del_flag`='0' ORDER BY `id`" ; $rslt=$conn->query($query1); while($rowd=mysqli_fetch_array($rslt)){ echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['payment_type_name'].'</option>';  }  ?></select></td><td><a href="javascript:void(0);" id="iop_remove'+i+'" onClick="remove_payment_mode('+i+')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
						$("#payment_date"+i).datepicker({
							format: 'dd-mm-yyyy'
						});
						$("#payment_time"+i).timepicker({
							timeFormat: 'h:mm p'
						});
						$("#tpa_name"+i).select2();
						//fun_nebu_calcu();
					});
					
					
		 
		 
		  $("#register").click(function(){ 
			 var submit_flag=0;
			 			 
			if($("#hospital_number").val()=="" ){
				alert("Please fill up patients details");
				$("#hospital_number").css( "border-width", "2px" );
				$("#hospital_number").css( "border-color", "red" );
				$("#hospital_number").focus();
				submit_flag=1;
			}
			
			if($("#name").val()=="" ){
				alert("Please fill up patients details");
				$("#name").css( "border-width", "2px" );
				$("#name").css( "border-color", "red" );
				$("#name").focus();
				submit_flag=1;
			}
			
			if($("#billing_date").val()=="" ){
				alert("Please check date format");
				$("#billing_date").css( "border-width", "2px" );
				$("#billing_date").css( "border-color", "red" );
				$("#billing_date").focus();
				submit_flag=1;
			}
			
			if($("#billing_time").val()=="" ){
				alert("Please check time format");
				$("#billing_time").css( "border-width", "2px" );
				$("#billing_time").css( "border-color", "red" );
				$("#billing_time").focus();
				submit_flag=1;
			}			
			/*alert(submit_flag);
			return false;*/
			var total=0;
			//net_total=Math.round(net_total);
			var  countiopc=$("#countiopc").val(); 
			for(var i=1;i<=countiopc;i++){
				var net_amount=$("#net_amount"+i).val();
				if ((isNaN(net_amount)) || (net_amount == '')) {
					 net_amount = 0;
				}
				total=parseFloat(total)+parseFloat(net_amount);
					
			}
			var net_total=total;
			if(net_total<0){
				alert("Net Total can not be Negative!!");
				submit_flag=1;
			}
			
			
			var discount_type=$("#discount_type").val();
			var discount_val=$("#discount").val();
			if((discount_type=='')&& (discount_val=='')){
				alert("Please Give Proper Discount");
				//$("#discount_type").focus();
				$("#discount").val('0');
				submit_flag=1;
			}
			
			var discount_total=net_total;
			if((discount_type!='')&& (discount_val!='')&& (discount_val!='0')){		
				if(discount_type=='F'){
					discount_total=(parseFloat(net_total)-parseFloat(discount_val));
				}
				if(discount_type=='P'){
					discount_total=parseFloat(net_total)-((parseFloat(net_total)*parseFloat(discount_val))/100);
				}
			}
			
			var fixed_net_total=Math.round(discount_total);
			total=fixed_net_total;
			$("#net_tot").html(fixed_net_total);
			$("#total").val(fixed_net_total);
			$("#full_due_tot").html(fixed_net_total);
			$("#to_be_underpaid").html(fixed_net_total);
			$("#to_be_overpaid").html(fixed_net_total);
			
			
			if(fixed_net_total<0){
				alert("Net Total can not be Negative!!");
				submit_flag=1;
			}
			var amount_due=$("#amount_due").val();
			if(amount_due==0){
					var total_payment=$("#net_payment_amt_text").val();
					/*var refund_payment_amt_text=$("#refund_payment_amt_text").val();
					var new_total=parseFloat(total)-parseFloat(refund_payment_amt_text);
					alert(total_payment);
					alert(refund_payment_amt_text);
					alert(new_total);*/
									
						if(total_payment>total){
							alert("Payment is greater than net total!");
							//$("#cash_amount").focus();
							submit_flag=1;
							$("#p_value1").css( "border-width", "2px" );
							$("#p_value1").css( "border-color", "red" );
						}
						if(total_payment<total){
							alert("Payment is less than net total!");
							//$("#cash_amount").focus();
							submit_flag=1;
							$("#p_value1").css( "border-width", "2px" );
							$("#p_value1").css( "border-color", "red" );
						}
					
			}
			if(submit_flag==0)
			{
				//alert("success");
				$("#submit").prop( "disabled", false );
				$("#submit"). click();
			}
			//alert(submit_flag);
			
			
		 });
		 
		
		 
		
		 	 
	  }); 
	  

function remove_iopc(j) {
	  $("#iopc"+j).remove();
	  hidden_button_func();
	  calculate_sales();
}

function remove_payment_mode(j) {
 	$("#payment_mode_iop"+j).remove();
	summation_payment();	  
}


function discount_amount(discount_id,no){
	hidden_button_func();
	var discount=$("#"+discount_id).val();
	if ((isNaN(discount)) || (discount == '')) {
		 discount = 0;
	}
	var amount=$("#amount"+no).val();
	if ((isNaN(amount)) || (amount == '')) {
		 amount = 0;
	}
	var net_amount=parseFloat(amount-discount);
	$("#net_amount"+no).val(net_amount);	
}

function amount(amount_id,no){
	hidden_button_func();
	var amount=$("#"+amount_id).val();
	if ((isNaN(amount)) || (amount == '')) {
		 amount = 0;
	}
	var discount=$("#discount"+no).val();
	if ((isNaN(discount)) || (discount == '')) {
		 discount = 0;
	}
	var net_amount=parseFloat(amount-discount);
	$("#net_amount"+no).val(net_amount);	
}


function retrieve_procedure(){
	hidden_button_func();
	var pt_type=$("#pt_type").val();	
	var bill_type=$("#bill_type").val();
	var countiopc=$("#countiopc").val();
	var opd_flag=$("#opd_flag").val();
	var lp=1;
	while(lp<=countiopc){
		$("#procedure_id"+lp).html("");
		$("#procedure_id"+lp).append($('<option/>', { 
		value: "",
		text : "Select Procedure" 
		}));
		//$("#iopc"+lp).remove();
		lp=lp+1;
		//$("#iopc"+lp).remove();
	}
	
	$.ajax({
		url: 'ajax/billing_fetch_procedure_ajax.php',
		dataType: 'json',
		type: 'POST',
		data: 'pt_type='+pt_type+'&bill_type='+bill_type+'&opd_flag='+opd_flag,		
		success: function (data) {
			var i=1;
			while(i<=countiopc){			
			 $.each(data, function(index, element) {
				$('#procedure_id'+i).append($('<option/>', { 
					value: element.value,
					text : element.text 
				}));				
			 });
			 $("#amount"+i).val("0");
			 $("#net_amount"+i).val("0");
			 $("#discount"+i).val("0");			 
			  i=i+1;
				//$("#iopc"+lp).remove();
			}
		 }
		 
	 });
	 reset_procedure();
	
}
function retrieve_procedure_next(){
	hidden_button_func();
	var pt_type=$("#pt_type").val();	
	var bill_type=$("#bill_type").val();
	var opd_flag=$("#opd_flag").val();
	var countiopc=$("#countiopc").val();	
	$("#procedure_id"+countiopc).html("");
	$("#procedure_id"+countiopc).append($('<option/>', { 
	value: "",
	text : "Select Procedure" 
	}));	
	$.ajax({
		url: 'ajax/billing_fetch_procedure_ajax.php',
		dataType: 'json',
		type: 'POST',
		data: 'pt_type='+pt_type+'&bill_type='+bill_type+'&opd_flag='+opd_flag,			
		success: function (data) {
						
			 $.each(data, function(index, element) {
				$('#procedure_id'+countiopc).append($('<option/>', { 
					value: element.value,
					text : element.text 
				}));				
			 });
			 
		 }
		 
	 });	
}
function retrieve_amount(select_id,no){
	var id=$("#"+select_id).val();
	hidden_button_func();
	//alert(id);
	try{					
				$.ajax({
								type : "POST",
								url : "<?php echo ADMIN_URL; ?>ajax/amount_fetch_ajax.php",
								dataType : "json", 
								data : "id="+id,
								success : function(data) {						
									//alert(data.amount);
									try{ 									 
										 $("#amount"+no).val(data.amount);
										 $("#net_amount"+no).val(data.amount);	
										 $("#discount"+no).val("0");	
										 calculate_sales();	 
									}
									catch(err){
										alert(err.message);
									}
								}
							});
						}catch(err){
							alert(err.message);
						}
					setInterval(function(){
					   $('#error_msg').html('');
					  }, 5000);
					 
}

function hidden_button_func(){
	$("#hidden_button").val("0");
	var hidden_button=$("#hidden_button").val();
	if(hidden_button=='1'){
		$("#register").prop( "disabled", false );	
	}else{
		$("#register").prop( "disabled", true );
	}	
}
function reset_procedure(){
	var countiopc=$("#countiopc").val();
	var i=2;
	while(i<=countiopc){
		remove_iopc(i);
		i=i+1;
	}
	$("#countiopc").val("1");
}


function retrieve_break_hos(select_id,no){
	var id=$("#"+select_id).val();
	var countiopc=$("#countiopc").val();
	var initial_countiopc=$("#countiopc_hos_sub").val();
	var initial_countiopc_hos_sub=parseInt(initial_countiopc)+parseInt(1);
	var color = '#135346';
	var opd_flag=$("#opd_flag").val();
    
	var break_up_flag=$("#break_up_flag").val();
	if(break_up_flag=='0'){
		$("#break_up_flag").val('1');
	try{					
				$.ajax({
								type : "POST",
								url : "<?php echo ADMIN_URL; ?>ajax/break_up_procedure_fetch_ajax.php",
								dataType : "json", 
								data : "id="+id+'&opd_flag='+opd_flag,
								success : function(data) {						
									//alert(data.amount);
									try{ 
										 var k=$("#countiopc_hos_sub").val();
										 $.each(data, function(index, element) {
												var m=parseInt(element.counter);		 
												var j=parseInt(k)+parseInt(m);
												$("#countiopc_hos_sub").val(j);												
												$("#iop_tabc_hos_sub").append('<tr id="iopc_hos_sub' + j + '" style="border: 1px solid red;background-color: '+color+';"><td ><select  name="sub_procedure_id_hos_sub' + j + '" id="sub_procedure_id_hos_sub' + j + '"  class="form-control "  ><option value="' + element.id + '">' + element.break_up_procedure_name + '</option></select></td> <td > <input type="number" class="form-control" placeholder="Enter Text" name="amount_hos_sub' + j + '" id="amount_hos_sub' + j + '"  value="' + element.sub_amount + '"  onKeyUp="amount_hos_sub(\'amount_hos_sub' + j + '\',\'' + j + '\');"></td><td ><input type="hidden" class="form-control" placeholder="Enter Text" name="net_amount_hos_sub' + j + '" id="net_amount_hos_sub' + j + '" value="' + element.sub_amount + '"><input type="hidden" class="form-control" placeholder="Enter Text" name="color_code' + j + '" id="color_code' + j + '" value="' + color + '" ><a href="javascript:void(0);"  id="iop_removec_hos_sub' + j + '" onClick="remove_iopc_hos_sub('+ j +');calculate_sub_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');	
												
										 });	
										 
									}									 
									catch(err){
										alert(err.message);
									}
								}
								
							});
						}catch(err){
							alert(err.message);
						}	}
						//check_sub(id);					
					setInterval(function(){
					   $('#error_msg').html('');
					  }, 5000);
//check_sub(id);
}

function check_sub(id){
	//alert("ani");
	var countiopc=$("#countiopc").val();
	var check_sub=$("#check_sub").val();	
	var arr = check_sub.split("#");
	//alert(check_sub);
	//$("#check_sub_btn"). click();
}
function check_sub_btn(id){
	//alert("ani");
	var countiopc=$("#countiopc").val();
	var check_sub=$("#check_sub").val();	
	var arr = check_sub.split("#");
	//alert(check_sub);
	//$("#check_sub_btn"). click();
}
/*$("#check_sub_btn").click(function(){
			var check_sub=$("#check_sub").val();		
			alert(check_sub); 
		 });*/


function remove_iopc_hos_sub(j) {
	  $("#iopc_hos_sub"+j).remove();
}

function calculate_sales(){	
	var submit_flag=0;
	//var net_total=$("#net_tot").html();
	
	if($("#hospital_number").val()=="" ){
		alert("Please fill up patients details");
		$("#hospital_number").css( "border-width", "2px" );
		$("#hospital_number").css( "border-color", "red" );
		$("#hospital_number").focus();
		submit_flag=1;
	}
	
	if($("#name").val()=="" ){
		alert("Please fill up patients details");
		$("#name").css( "border-width", "2px" );
		$("#name").css( "border-color", "red" );
		$("#name").focus();
		submit_flag=1;
	}
	
	var total=0;
	//net_total=Math.round(net_total);
	var  countiopc=$("#countiopc").val(); 
	for(var i=1;i<=countiopc;i++){
		var net_amount=$("#net_amount"+i).val();
		if ((isNaN(net_amount)) || (net_amount == '')) {
			 net_amount = 0;
		}
		total=parseFloat(total)+parseFloat(net_amount);
			
	}
	var net_total=total;
	if(net_total<0){
		alert("Net Total can not be Negative!!");
		submit_flag=1;
	}
	
	
	var discount_type=$("#discount_type").val();
	var discount_val=$("#discount").val();
	if((discount_type=='')&& (discount_val=='')){
		alert("Please Give Proper Discount");
		//$("#discount_type").focus();
		$("#discount").val('0');
		submit_flag=1;
	}
	
	var discount_total=net_total;
	if((discount_type!='')&& (discount_val!='')&& (discount_val!='0')){		
		if(discount_type=='F'){
			discount_total=(parseFloat(net_total)-parseFloat(discount_val));
		}
		if(discount_type=='P'){
			discount_total=parseFloat(net_total)-((parseFloat(net_total)*parseFloat(discount_val))/100);
		}
	}
	var fixed_net_total=Math.round(discount_total);
	$("#net_tot").html(fixed_net_total);
	$("#total").val(fixed_net_total);
	$("#full_due_tot").html(fixed_net_total);
	$("#to_be_underpaid").html(fixed_net_total);
	$("#to_be_overpaid").html(fixed_net_total);
	
	if(fixed_net_total<0){
		alert("Net Total can not be Negative!!");
		$("#net_tot").css( "background-color", "#3ccd62" );
		$("#net_tot").css( "padding", "4px 10px" );
		$("#net_tot").focus();
		submit_flag=1;
	}
	if(submit_flag=='0'){
				$("#register").prop( "disabled", false );	
			}else{
				$("#register").prop( "disabled", true );
			}
}
function over_under_paid_calculation(){
	
			var submit_flag=0;
			var total=0;
			//net_total=Math.round(net_total);
			var  countiopc=$("#countiopc").val(); 
			for(var i=1;i<=countiopc;i++){
				var net_amount=$("#net_amount"+i).val();
				if ((isNaN(net_amount)) || (net_amount == '')) {
					 net_amount = 0;
				}
				total=parseFloat(total)+parseFloat(net_amount);
					
			}
			var net_total=total;
			if(net_total<0){
				alert("Net Total can not be Negative!!");
				submit_flag=1;
			}
			
			
			var discount_type=$("#discount_type").val();
			var discount_val=$("#discount").val();
			if((discount_type=='')&& (discount_val=='')){
				alert("Please Give Proper Discount");
				//$("#discount_type").focus();
				$("#discount").val('0');
				submit_flag=1;
			}
			
			var discount_total=net_total;
			if((discount_type!='')&& (discount_val!='')&& (discount_val!='0')){		
				if(discount_type=='F'){
					discount_total=(parseFloat(net_total)-parseFloat(discount_val));
				}
				if(discount_type=='P'){
					discount_total=parseFloat(net_total)-((parseFloat(net_total)*parseFloat(discount_val))/100);
				}
			}
			
			var fixed_net_total=Math.round(discount_total);
			total=fixed_net_total;			
			var amount_due=$("#amount_due").val();
			if(amount_due==1){
				alert("Please deselect Full Amount Due Tick Option");
			}
			if(amount_due==0){
				
					var total_payment=$("#net_payment_amt_text").val();									
						if(total_payment>total){
							alert("Payment is greater than net total!");
							//$("#cash_amount").focus();
							submit_flag=1;
							$("#p_value1").css( "border-width", "2px" );
							$("#p_value1").css( "border-color", "red" );
							var rest_amt=parseFloat(total)-parseFloat(total_payment);
							$("#overpaid").css( "display", "block" );
							$("#underpaid").css( "display", "none" );
							$("#to_be_overpaid").html("(Net Total - Total Payment Amt)= "+rest_amt);
							return;
						}
						
						if(total_payment<total){
							alert("Payment is less than net total!");
							//$("#cash_amount").focus();
							submit_flag=1;
							$("#p_value1").css( "border-width", "2px" );
							$("#p_value1").css( "border-color", "red" );
							var rest_amt=parseFloat(total)-parseFloat(total_payment);
							$("#overpaid").css( "display", "none" );
							$("#underpaid").css( "display", "block" );
							$("#to_be_underpaid").html("(Net Total - Total Payment Amt)= "+rest_amt);
							return ;
						}
						if(total_payment==total){							
							var rest_amt=parseFloat(total)-parseFloat(total_payment);
							$("#overpaid").css( "display", "none" );
							$("#underpaid").css( "display", "block" );
							submit_flag=0;
							$("#to_be_underpaid").html("(Net Total - Total Payment Amt)= "+rest_amt);
							return ;
						}
					}
					if(submit_flag=='0'){
						$("#register").prop( "disabled", false );	
					}else{
						$("#register").prop( "disabled", true );
					}
}
function calculate_sub_sales(){	
	var submit_flag=0;
	//var net_total=$("#net_tot").html();
	
	if($("#hospital_number").val()=="" ){
		alert("Please fill up patients details");
		$("#hospital_number").css( "border-width", "2px" );
		$("#hospital_number").css( "border-color", "red" );
		$("#hospital_number").focus();
		submit_flag=1;
	}
	
	if($("#name").val()=="" ){
		alert("Please fill up patients details");
		$("#name").css( "border-width", "2px" );
		$("#name").css( "border-color", "red" );
		$("#name").focus();
		submit_flag=1;
	}
	
	var total=0;
	//net_total=Math.round(net_total);
	var  countiopc_hos_sub=$("#countiopc_hos_sub").val(); 
	for(var i=1;i<=countiopc_hos_sub;i++){
		var net_amount=$("#net_amount_hos_sub"+i).val();
		if ((isNaN(net_amount)) || (net_amount == '')) {
			 net_amount = 0;
		}
		total=parseFloat(total)+parseFloat(net_amount);
			
	}
	var net_total=total;
	if(net_total<0){
		alert("Net Total can not be Negative!!");
		submit_flag=1;
	}
	//over_under_paid_calculation();
	var grand_total=$("#total").val();
	
	var remain_amt=parseFloat(grand_total)-parseFloat(net_total);
	//alert(remain_amt);
	var fixed_net_total=Math.round(net_total);
	$("#sub_net_tot").html(fixed_net_total);
	$("#sub_total").val(fixed_net_total);
	/*$("#to_be_underpaid").html(fixed_net_total);
	$("#to_be_overpaid").html(fixed_net_total);*/
	
	if(remain_amt>0){							
		$("#overpaid_sub_breakup").css( "display", "none" );
		$("#underpaid_sub_breakup").css( "display", "block" );
		$("#to_be_underpaid_sub_breakup").html("(Net Total - Total of Break Up Procedure)= "+remain_amt);
	}
	if(remain_amt<0){							
		$("#overpaid_sub_breakup").css( "display", "block" );
		$("#underpaid_sub_breakup").css( "display", "none" );
		$("#to_be_overpaid_sub_breakup").html("(Net Total - Total of Break Up Procedure)= "+remain_amt);
	}
	if(remain_amt==0){							
		$("#overpaid_sub_breakup").css( "display", "none" );
		$("#underpaid_sub_breakup").css( "display", "block" );
		$("#to_be_underpaid_sub_breakup").html("(Net Total - Total of Break Up Procedure)= "+remain_amt);
	}
	
	if(fixed_net_total<0){
		alert("Break Up Procedure Total can not be Negative!!");		
		submit_flag=1;
	}
	if(submit_flag=='0'){
				$("#register").prop( "disabled", false );	
			}else{
				$("#register").prop( "disabled", true );
			}
}

function amount_hos_sub(amount_id,no){
	//hidden_button_func();
	var amount=$("#"+amount_id).val();
	if ((isNaN(amount)) || (amount == '')) {
		 amount = 0;
	}	
	var net_amount=parseFloat(amount);
	$("#net_amount_hos_sub"+no).val(net_amount);	
	calculate_sub_sales();
}

function view_expense_details(){
	var patient_id=$("#patient_id").val();
	$("#iop_expences_body").html('');
	if(patient_id!=''){
	try{					
				$.ajax({
								type : "POST",
								url : "<?php echo ADMIN_URL; ?>ajax/patient_expenses_fetch_ajax.php",
								dataType : "json", 
								data : "patient_id="+patient_id,
								success : function(data) {						
									//alert(data.amount);
									var total_all_expences=0;
									try{ 
										var row_increase=0;
										//var k=$("#countiopc_hos_sub").val();
										 $.each(data, function(index, element) {
												/*var m=parseInt(element.counter);		 
												var j=parseInt(k)+parseInt(m);
												$("#countiopc_hos_sub").val(j);	*/
												row_increase=parseInt(row_increase)+1;
												if(element.counter=='1'){										
												$("#iop_expences_body").append('<tr id="iopc_expensces_sub_details0" style="border-top: 3px solid red !important;border-left: 3px solid red !important;border-right: 3px solid red !important;font-size:16px;color:red;"><td colspan="3"><u>' + element.char_lett + ') ' + element.expence_title + '</u></td></tr>');	
												$("#iop_expences_body").append('<tr id="iopc_expensces_sub_details' + element.counter + '" style="border-left: 3px solid red !important;border-right: 3px solid red !important;"><td >' + element.counter + '. </td> <td >' + element.expneses_abouts + '</td>  <td >' + element.total_charge_occupied_bed + '</td> </tr>');
												}else{
													$("#iop_expences_body").append('<tr id="iopc_expensces_sub_details' + element.counter + '" style="border-left: 3px solid red !important;border-right: 3px solid red !important;"><td >' + element.counter + '. </td> <td >' + element.expneses_abouts + '</td>  <td >' + element.total_charge_occupied_bed + '</td> </tr>');
												}
												if(element.counter==element.count){
													if(row_increase==element.terminate_flag){
													$("#iop_expences_body").append('<tr id="iopc_expensces_sub_details_final" style="border-left: 3px solid red !important;border-right: 3px solid red !important;border-bottom: 3px solid #0014ff  !important;font-size:16px;"><td>Total</td><td colspan="2" style="text-align:right;padding-right:25px;font-size:16px;color:red;">' + element.total_expence_loop + '</td></tr>');
													}else{
														$("#iop_expences_body").append('<tr id="iopc_expensces_sub_details_final" style="border-left: 3px solid red !important;border-right: 3px solid red !important;border-bottom: 3px solid red !important;font-size:16px;"><td>Total</td><td colspan="2" style="text-align:right;padding-right:25px;font-size:16px;color:red;">' + element.total_expence_loop + '</td></tr>');
													}
													//console.log(element.terminate_flag);
													total_all_expences=parseInt(total_all_expences)+parseInt(element.total_expence_loop);;	
												}
												
												
										 });
										 	$("#total_expenses_net_tot").html(total_all_expences);
											$("#total_expenses").val(total_all_expences);
										  
									}									 
									catch(err){
										alert(err.message);
									}
								}
								
							});
						}catch(err){
							alert(err.message);
						}	}
						//check_sub(id);					
					setInterval(function(){
					   $('#error_msg').html('');
					  }, 5000);
//check_sub(id);
}

function mrd_check_ajax(){	
				var id=$("#mrd_check").val();
				var hidden_button=$("#hidden_button").val();
				//alert(id);
				try{					
				$.ajax({
								type : "POST",
								url : "<?php echo ADMIN_URL; ?>ajax/billing_fetch_ajax.php",
								dataType : "json", 
								data : "id="+id,
								success : function(data) {						
									//alert(data.amount);
									try{ 		
										if(data.flag=='1'){						 
											$("#hospital_number").val(data.uhid_no);	
											$("#name").val(data.name);										 
											$("#mobile").val(data.mobile);
											//$("#doc_id").val(data.consultant);
											$("#doc_id").select2("val", data.consultant);
											$("#address").val(data.address);		
											$("#pt_type").val(data.patient_type);
											$("#age").val(data.age);
											$("#gender").val(data.gender);
											$("#patient_id").val(data.patient_id);
											$("#admission_date").val(data.admission_date);
											$("#admission_time").val(data.admission_time);
											$("#date_of_discharge").val(data.date_of_discharge);
											$("#time_of_discharge").val(data.time_of_discharge);
											$("#opd_flag").val(data.opd_flag);
											//$("#register").prop( "disabled", false );
											//alert("ani");
											if(hidden_button=='1'){
												$("#register").prop( "disabled", false );	
											}else{
												$("#register").prop( "disabled", true );
											}
											retrieve_procedure();
											view_expense_details();
											retrieve_break_hos('procedure_id1','1');
										}
										
									}
									catch(err){
										alert(err.message);
									}
								}
							});
						}catch(err){
							alert(err.message);
						}
					setInterval(function(){
					   $('#error_msg').html('');
					  }, 5000);
	
}
function option_payment(no){
		$("#p_value"+no).attr('readonly', true);
		$("#payment_date"+no).attr('readonly', true);
		$("#payment_time"+no).attr('readonly', true);
		$("#claim_no"+no).val('');
		$("#claim_no"+no).attr('readonly', true);
		$("#tpa_name"+no).attr('readonly', true);
		$("#payment_type"+no).attr('readonly', true);
		$("#tpa_name"+no).html("");
		$("#tpa_name"+no).append($('<option/>', { 
			value: "",
			text : "Select" 
		}));
		$("#payment_type"+no).val('1');
		$("#p_value"+no).val('0');
		
	var p_key=$("#p_key"+no).val();
	if(p_key!=''){
		$("#p_value"+no).attr('readonly', false);
		$("#payment_date"+no).attr('readonly', false);
		$("#payment_time"+no).attr('readonly', false);
		$("#payment_type"+no).attr('readonly', false);
	}
	//alert("ani");
	
	$.ajax({
		url: 'ajax/payment_mode_fetching_value_ajax.php',
		dataType: 'json',
		type: 'POST',
		data: 'p_key_id='+p_key,		
		success: function (data) {			
			 if(data.cheque_mode==1){
				$("#claim_no"+no).attr('readonly', false); 
			 }
			 if(data.tpa_mode==1){
				$("#claim_no"+no).attr('readonly', false); 
				$("#tpa_name"+no).attr('readonly', false); 
				tpa_values_fetch(no);
			 }	
			 if(data.govt_health_mode==1){
				$("#claim_no"+no).attr('readonly', false); 
				$("#tpa_name"+no).attr('readonly', false); 
				govt_health_mode_values_fetch(no);
			 }
		 }
		 
	 });
	
	
}

function summation_payment(no){
		
	var total_payments=0;
	var instant_payments=0;
	var advance_payments=0;
	var refund_payments=0;
			//net_total=Math.round(net_total);
			var  count_payment_mode=$("#count_payment_mode").val(); 
			for(var i=1;i<=count_payment_mode;i++){				
				var payment_type=$("#payment_type"+i).val();
				if(payment_type==3){
					var p_value=$("#p_value"+i).val();
					if ((isNaN(p_value)) || (p_value == '')) {
						 p_value = 0;
					}
					refund_payments=parseFloat(refund_payments)+parseFloat(p_value);
				}else if(payment_type==2){
					var p_value=$("#p_value"+i).val();
					if ((isNaN(p_value)) || (p_value == '')) {
						 p_value = 0;
					}
					advance_payments=parseFloat(advance_payments)+parseFloat(p_value);
				}else{
					var p_value=$("#p_value"+i).val();
					if ((isNaN(p_value)) || (p_value == '')) {
						 p_value = 0;
					}
					instant_payments=parseFloat(instant_payments)+parseFloat(p_value);
				}
				
					
			}
			total_payments=(parseFloat(instant_payments)+parseFloat(advance_payments))-parseFloat(refund_payments);
				
				$("#advance_payment_amt_span").html(advance_payments);
				$("#advance_payment_amt_text").val(advance_payments);
				$("#instant_payment_amt_span").html(instant_payments);
				$("#instant_payment_amt_text").val(instant_payments);
				$("#refund_payment_amt_span").html(refund_payments);
				$("#refund_payment_amt_text").val(refund_payments);
				$("#net_payment_amt_span").html(total_payments);
				$("#net_payment_amt_text").val(total_payments);
				
}

function govt_health_mode_values_fetch(no){
	$("#tpa_name"+no).html("");
		$("#tpa_name"+no).append($('<option/>', { 
			value: "",
			text : "Select" 
		}));
		$.ajax({
		url: 'ajax/govt_health_option_fetch_ajax.php',
		dataType: 'json',
		type: 'POST',
		data: 'no='+no,			
		success: function (data) {						
			 $.each(data, function(index, element) {
				$('#tpa_name'+no).append($('<option/>', { 
					value: element.value,
					text : element.text 
				}));				
			 });
			 
		 }
		 
	 });
		
}

function tpa_values_fetch(no){
	$("#tpa_name"+no).html("");
		$("#tpa_name"+no).append($('<option/>', { 
			value: "",
			text : "Select" 
		}));
		$.ajax({
		url: 'ajax/tpa_option_fetch_ajax.php',
		dataType: 'json',
		type: 'POST',
		data: 'no='+no,			
		success: function (data) {						
			 $.each(data, function(index, element) {
				$('#tpa_name'+no).append($('<option/>', { 
					value: element.value,
					text : element.text 
				}));				
			 });
			 
		 }
		 
	 });
		
}

</script>
<?php include "footer.php" ?>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>