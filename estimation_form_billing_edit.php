<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
include 'function.php';

include 'conn.php'; ?>
<?php 

//Add Code

if(isset($_REQUEST['register'])){
  $prefix = mysqli_real_escape_string($conn,$_POST['prefix']);
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $doc_id = mysqli_real_escape_string($conn,$_POST['doc_id']);
  $mobile_prefix = mysqli_real_escape_string($conn,$_POST['mobile_prefix']);
  $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
  $gender = mysqli_real_escape_string($conn,$_POST['gender']);
  $age = mysqli_real_escape_string($conn,$_POST['age']);
  $address = mysqli_real_escape_string($conn,$_POST['address']);
  $pt_type = mysqli_real_escape_string($conn,$_POST['pt_type']);
  $total = mysqli_real_escape_string($conn,$_POST['total']);
  
  $est_id = mysqli_real_escape_string($conn,$_POST['est_id']);
  	
    if($_REQUEST['billing_date']==''){
	$billing_date='NULL';
	}else{
		$billing_date= "'".date("Y-m-d", strtotime($_POST['billing_date']))."'";
	}
	
	if($_REQUEST['billing_time']==''){
	$billing_time='NULL';
	}else{
		$billing_time= "'".date("H:i", strtotime($_POST['billing_time']))."'";
	}
	if($_REQUEST['crdate']==''){
	$crdate='NULL';
	}else{
		$crdate= "'".date("Y-m-d", strtotime($_POST['crdate']))."'";
	}
	$created_by=$_SESSION['id'];
	$created_on=date('Y-m-d H:i:s');	
  //if($discharge_id==''){
	  $sql="UPDATE estimation_form_details set  `name`='".$name."',  `address`='".$address."',  `mobile_prefix`='".$mobile_prefix."',  `mobile`='".$mobile."',  `age`='".$age."',  `doc_id`='".$doc_id."',  `pt_type`='".$pt_type."',  `billing_date`=".$billing_date.",  `system_created_date`=".$crdate.",  `billing_time`=".$billing_time.",  `total`='".$total."', `created_by`='".$created_by."',  `created_on`='".$created_on."', `gender`='".$gender."', `prefix`='".$prefix."' where `id`='".$_REQUEST['est_id']."' ";
	  mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Patient Insert Sucessfully")));
	  
	    /*Diagnoses Entry*/
	    $count_diagnoses=mysqli_real_escape_string($conn,$_REQUEST['countiopc']);		
		$remove_id_for_procedure=mysqli_real_escape_string($conn,$_REQUEST['remove_id_for_procedure']);		
		for($i=1;$i<=$count_diagnoses;$i++) {		
			if($_REQUEST['procedure_id'.$i]!=''){
					if($_REQUEST['procedure_mode_flag'.$i]=='0'){
					$sql4 = $conn->query("INSERT INTO `estimation_purpose_details` SET `estimation_form_id`='".$est_id."',`procedure_id`='".$_REQUEST['procedure_id'.$i]."',`amount`='".$_REQUEST['amount'.$i]."',`discount`='".$_REQUEST['discount'.$i]."',`net_amount`='".$_REQUEST['net_amount'.$i]."',`created_by`='".$created_by."',`created_on`='".$created_on."' ,`procedure_mode_flag` = '1'  ");		
					}		
					if($_REQUEST['procedure_mode_flag'.$i]!='0'){
					$sql4 = $conn->query("update `estimation_purpose_details` SET `procedure_id`='".$_REQUEST['procedure_id'.$i]."',`amount`='".$_REQUEST['amount'.$i]."',`discount`='".$_REQUEST['discount'.$i]."',`net_amount`='".$_REQUEST['net_amount'.$i]."',`modified_by`='".$created_by."',`modified_time`='".$created_on."' where `id`='".$_REQUEST['est_unique_id'.$i]."'");		
					}		
			} 		
		}		
		if($remove_id_for_procedure!=''){
			$remove_id_array=explode(":",$remove_id_for_procedure);		
			//print_r($remove_id_array);		
			$itemCount = sizeof($remove_id_array);		
			//exit;		
			for($i=0;$i<($itemCount-1);$i++) {		
			$sql4 = $conn->query("UPDATE `estimation_purpose_details` SET `del_flag` = '1', `deleted_time`='".$created_on."' , `deleted_by`='".$created_by."' WHERE `id`='".$remove_id_array[$i]."' ");		
			}		
		}
		/*End Diagnoses*/
		
 // }
  $msg='Insert Data.....';
  $redirectUrlPrint=ADMIN_URL.'estimation_form_billing_print.php?est_id='.$est_id;
  $redirectUrl=ADMIN_URL.'estimation_dashboadrd.php?msg='.$msg.'&flg='.$flg;
  echo "<script type=\"text/javascript\">window.open('$redirectUrlPrint', '_blank'); window.location.href='$redirectUrl'; </script>";
	
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
#billing_date_span {
	font-size:16px;
	color:#f9f8f8;
	font-weight:bold;
	padding : 12px;
	border:2px solid #F30;
}
</style>
<div class="page-container">
  <div class="page-head">
    <div class="container-fluid">
      <div class="page-title">
        <h1><small>Welcome to EMR Dashboard</small></h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
          <li class="active"> Manage </li>
        </ul>
      </div>
    </div>
  </div>
  <?php
  $patient_discharge_id = $_REQUEST['est_id']; // get id through query string
  $qry = mysqli_query($conn,"select * from `estimation_form_details` where `id`='".$patient_discharge_id."'"); // select query
  $row2 = mysqli_fetch_array($qry);
  ?>
  <div class="page-content">
    <div class="container-fluid">
      <div class="row margin-top-10">
        <div class="col-md-12">
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"> Estimation Form</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                <div class="form-body">
                  <div class="row" style="background:#dcefff;!important; padding:9px 0px">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">PT Type</label>
                        <select class=" form-control" name="pt_type" id="pt_type" >
                          <?php 

							     $sql7="SELECT `id`, `name` FROM `patient_type_master`  WHERE  `del_flag`='0' AND `id`='5' ORDER BY `name` ASC";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){									 
									 echo '<option value="'.$row7['id'].'" ';if($row2['pt_type']==$row7['id']){echo 'selected';};  echo '>'.$row7['name'].'</option>';
								 }
					 			?>
                        </select>
                        <input type="hidden" id="created_on" name="created_on" class="form-control" value="<?php echo date('Y-m-d H:i:s');?>">
                        <input type="hidden" id="created_by" name="created_by" class="form-control" value="<?php echo $_SESSION['id'];?>">
                        <input type="hidden" id="status" name="status" class="form-control" value="1">
                        <input type="hidden" id="est_id" name="est_id" class="form-control" value="<?php echo $_REQUEST['est_id']; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">System Created Date</label>
                        <input class="form-control form-control-inline date-picker" type="date"  placeholder="Select Date" id="crdate" name="crdate" value="<?php echo date("Y-m-d",strtotime($row2['system_created_date'])); ?>" readonly />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Prefix</label>
                        <select class="form-control" name="prefix" id="prefix" onchange="gender_defualt();">
                          <?php 
								 $sql7="SELECT `id`, `prefix_name` FROM `prefix_masters`  WHERE  `del_flag`='0' ORDER BY `prefix_name` ASC";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){								 

									 echo '<option value="'.$row7['id'].'" ';if($row2['prefix']==$row7['id']){echo 'selected';}  echo '>'.$row7['prefix_name'].'</option>';

								 }
					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Patient Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Text"  value="<?php echo $row2['name']?>"/>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Doctor / Optom</label>
                        <select class=" form-control select2" name="doc_id" id="doc_id" >
                          <option value="0">Select Doctor / Optom</option>
                          <?php 

								 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'  OR `users`.`role`='4'  AND `users`.`del_flag`='0' ORDER BY `user_infos`.`name` ASC ";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){
									 echo '<option value="'.$row7['id'].'" ';if($row2['doc_id']==$row7['id']){echo 'selected';};  echo '>'.$row7['name'].'</option>';
								 }

					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Mobile</label>
                        <div class="input-group"> <span class="input-group-addon" style="padding:0 !important; width:20% !important">
                          <input type="text" id="mobile_prefix" name="mobile_prefix" class="form-control" value="<?php echo $row2['mobile_prefix']; ?>" placeholder="+91"  />
                          </span> <span class="input-group-addon" style="padding:0 !important; width:70% !important">
                          <input type="phone"  autocomplete="off"  onkeyup="value=value.replace(/[^\d]/g,'')" id="mobile" name="mobile" class="form-control" value="<?php echo $row2['mobile']; ?>" placeholder="Enter 10 digit Phone No."  />
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
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){									 
									 echo '<option value="'.$row7['id'].'" ';if($row2['gender']==$row7['id']){echo 'selected';}; echo '>'.$row7['gender'].'</option>';
								 }
					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Age (+Yrs.)</label>
                        <div class="input-group">
                          <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="age"  id="age"  autocomplete="off" placeholder="Age in Years" class="form-control" value="<?php echo $row2['age']?>" >
                          <span class="input-group-addon" style="padding:0 !important">Years</span></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Address</label>
                        <textarea id="address" name="address" class="form-control" placeholder="Full Address with Vill./Ward No."><?php echo $row2['address']?></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Estimation Date & Time(dd-mm-YYYY)(h:m A)</label>
                        <div class="input-group">
                          <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Billing Date" id="billing_date" name="billing_date" value="<?php echo date("d-m-Y",strtotime($row2['billing_date']));  ?>" />
                          <span class="input-group-addon" style="padding:0 !important; width:50% !important">
                          <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Billing Time" name="billing_time" id="billing_time" value="<?php  echo date("h:i A",strtotime($row2['billing_time']));  ?>"  />
                          </span></div>
                      </div>
                    </div>
                    <div id="defualt_individual" style="display:block;">
                      <div class="col-md-12" style="text-align:left;font-weight:bold;"><b>To Add Advance Purpose, Please Click On This Icon</b><a href="javascript:void(0);"  id="iop_add_buttonc" class="btn" title="Add One Procedure" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                        <div class="table-scrollable">
                          <table class="table table-bordered table-advance table-hover" id="iop_tabc">
                            <thead>
                              <tr>
                                <th>Estimation Purpose</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Net Amount</th>
                                <th>&nbsp;</th>
                              </tr>
                            </thead>
                            <tbody id="diagnoses_tbody">
                              <?php 
								  $sl=1;
								  $sql3="SELECT * FROM `estimation_purpose_details` WHERE `estimation_form_id`= '" .$row2['id']. "' and `del_flag`<>'1' ";
								  $result3=$conn->query($sql3) ;
								  $count=$result3->num_rows;
								  if($count=='0'){
								  echo '<input type="hidden" name="countiopc" id="countiopc" value="'.($count+1).'">';
								?>
                              <tr id="iopc<?php echo $sl; ?>">
                                <td ><textarea name="procedure_id<?php echo ($count+1); ?>" id="procedure_id<?php echo ($count+1); ?>"  class="form-control " placeholder="Enter Purpose"></textarea></td>
                                <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="amount<?php echo ($count+1); ?>" id="amount<?php echo ($count+1); ?>" onKeyUp="value=value.replace(/[^\d]/g,'');amount('amount<?php echo ($count+1); ?>','<?php echo ($count+1); ?>');calculate_sales();" value="0" ></td>
                                <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="discount<?php echo ($count+1); ?>" id="discount<?php echo ($count+1); ?>"  onKeyUp="value=value.replace(/[^\d]/g,'');discount_amount('discount<?php echo ($count+1); ?>','<?php echo ($count+1); ?>');calculate_sales();" value="0" ></td>
                                <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="net_amount<?php echo ($count+1); ?>" id="net_amount<?php echo ($count+1); ?>" onKeyUp="value=value.replace(/[^\d]/g,'');calculate_sales();" value="0" >
                                  <input type="hidden" name="procedure_mode_flag<?php echo ($count+1); ?>" id="procedure_mode_flag<?php echo ($count+1); ?>" value="0"></td>
                                <td ><a href="javascript:void(0);"  id="iop_removec<?php echo ($count+1); ?>" onClick="remove_iopc('<?php echo ($count+1); ?>');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
                              </tr>
                              <?php }else{
									  echo '<input type="hidden" name="countiopc" id="countiopc" value="'.$count.'">';
									  $sl=1;
									  while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){  
									?>
                              <tr id="iopc<?php echo $sl; ?>">
                                <td ><textarea name="procedure_id<?php echo $sl; ?>" id="procedure_id<?php echo $sl; ?>"  class="form-control " placeholder="Enter Purpose"><?php echo $row3['procedure_id']?></textarea></td>
                                <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="amount<?php echo $sl; ?>" id="amount<?php echo $sl; ?>" onKeyUp="value=value.replace(/[^\d]/g,'');amount('amount<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();" value="<?php echo $row3['amount']?>"></td>
                                <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="discount<?php echo $sl; ?>" id="discount<?php echo $sl; ?>"  onKeyUp="value=value.replace(/[^\d]/g,'');discount_amount('discount<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();" value="<?php if($row3['discount']!=''){echo $row3['discount'];}else{echo '0';}?>"></td>
                                <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="net_amount<?php echo $sl; ?>" id="net_amount<?php echo $sl; ?>" onKeyUp="value=value.replace(/[^\d]/g,'');calculate_sales();"  value="<?php echo $row3['net_amount']?>">
                                  <input type="hidden" name="est_unique_id<?php echo $sl; ?>" id="est_unique_id<?php echo $sl; ?>" value="<?php echo $row3['id']?>">
                                  <input type="hidden" name="procedure_mode_flag<?php echo $sl; ?>" id="procedure_mode_flag<?php echo $sl; ?>" value="<?php echo $row3['procedure_mode_flag']?>"></td>
                                <td ><a href="javascript:void(0);"  id="iop_removec<?php echo $sl; ?>" onClick="remove_iopc_update('<?php echo $sl; ?>','<?php echo $row3['id'];?>');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
                              </tr>
                              <?php  $sl++;}}?>
                            </tbody>
                          </table>
                          <input type="hidden" name="remove_id_for_procedure" id="remove_id_for_procedure" value="" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" style="color:red !important;">Please Click On Calculate Button</label>
                        <br>
                        <button type="button" name="calcu" id="calcu" class="btn red" onClick="calculate_sales()" >Calculate</button>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <input type="hidden" id="discount_purpose" name="discount_purpose" class="form-control" placeholder="Enter Text" value="" />
                      <input type="hidden" id="discount_type" name="discount_type" class="form-control" placeholder="Enter Text"  value="" onKeyUp="calculate_sales()"/>
                      <input type="hidden" id="discount" name="discount" class="form-control" placeholder="Enter Text"  value="0" onKeyUp="calculate_sales()"/>
                    </div>
                    <div class="col-md-12" style="text-align:left;font-weight:bold;color:blue;font-size:16px;"><b>Net Total: </b><span id="net_tot" style="color:red;">
                      <?php if($row2['total']!='0'){echo $row2['total'];}?>
                      </span>
                      <input type="hidden" id="total" name="total" class="form-control" placeholder="Enter Text"  value="0"/>
                    </div>
                    <div class="col-md-12" style="text-align:left;font-weight:bold;color:#cb26b5;font-size:16px;padding-left:16px !important;"> ( <span style="border-bottom: 1px dotted black;">Rupees <span id="number_to_words_span"><?php echo ucwords(convertNumber(0));?></span> only</span> ) </div>
                    <div class="col-md-12">
                      <p>&nbsp;</p>
                    </div>
                  </div>
                </div>
                <p style="padding:12px 0 2px 0; text-align:center;" id="register_para" >
                  <input type="hidden" name="break_up_flag" id="break_up_flag" class="form-control" value="0">
                  <input type="hidden" name="check_sub_previous" id="check_sub_previous" class="form-control" value="0">
                  <input type="hidden" name="check_sub" id="check_sub" class="form-control" value="0">
                  <input type="hidden" name="hidden_button" id="hidden_button" class="form-control" value="0">
                  <button type="submit" name="register" id="register" class="btn blue" disabled >Submit & Print</button>
                  <button type="button" name="reset" id="reset" class="btn red" onClick="reset_forms_val();" >Reset</button>
                  <input type="hidden" name="request_mrd" id="request_mrd" class="form-control" value="<?php if(isset($_REQUEST['request_mrd'])){ echo $_REQUEST['request_mrd'];};?>" />
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script src="select2/select2.min.js"></script> 
<script type="text/javascript"> 
      $(document).ready( function() { 
	 
	  $("#doc_id").select2();
		setTimeout('$("#alert_msg").hide()',3000);
			
		$("#mobile_prefix").val("+91");
		
		$("#billing_date").datepicker({
			   format: 'dd-mm-yyyy'
		   });
		 $("#billing_time").timepicker({
			   timeFormat: 'h:mm p'
		   });
		  

		$("#iop_add_buttonc").click(function(){ 
			 var i=$("#countiopc").val();			 
			 i=parseInt(i)+1;
			 $("#countiopc").val(i);
			  var pt_type=$("#pt_type").val();
				 //alert(i);
			 $("#iop_tabc").append('<tr id="iopc' + i + '"><td ><textarea name="procedure_id' + i + '" id="procedure_id' + i + '"  class="form-control " placeholder="Enter Purpose"></textarea></td> <td > <input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="amount' + i + '" id="amount' + i + '" onKeyUp="replace_value(\'amount' + i + '\',\'' + i + '\');amount(\'amount' + i + '\',\'' + i + '\');calculate_sales();" value="0"></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="discount' + i + '" id="discount' + i + '"  onKeyUp="replace_value(\'discount' + i + '\',\'' + i + '\');discount_amount(\'discount' + i + '\',\'' + i + '\');calculate_sales();" value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="net_amount' + i + '" id="net_amount' + i + '" onKeyUp="replace_value(\'net_amount' + i + '\',\'' + i + '\');calculate_sales();" value="0"><input type="hidden" class="form-control" placeholder="Enter Text" name="procedure_mode_flag' + i + '" id="procedure_mode_flag' + i + '" value="0" ></td><td ><a href="javascript:void(0);"  id="iop_removec' + i + '" onClick="remove_iopc('+ i +');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
		 });
	  }); 
	  
function remove_iopc_update(j,id) {

  $("#iopc"+j).remove();	  

  var remove_id_for_procedure=$("#remove_id_for_procedure").val();

  var values_drug=remove_id_for_procedure+id+":";

  $("#remove_id_for_procedure").val(values_drug);

  hidden_button_func();

  calculate_sales();

}


function remove_iopc(j) {

	  $("#iopc"+j).remove();

	  hidden_button_func();

	  calculate_sales();

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
function calculate_sales(){	
	var submit_flag=0;
	
	if($("#name").val()=="" ){
		alert("Please fill up patients details");
		$("#name").css( "border-width", "2px" );
		$("#name").css( "border-color", "red" );
		$("#name").focus();
		submit_flag=1;
	}
	if($("#doc_id").val()=="0" ){
		alert("Please select doctor / optom...");	
		submit_flag=1;
	}	
	var total=0;
	
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
	
	var fixed_net_total=Math.round(net_total);
	$("#net_tot").html(fixed_net_total);
	$("#total").val(fixed_net_total);
	$("#number_to_words_span").html('Zero');
	$.ajax({
		type : "POST",
		url : "<?php echo ADMIN_URL; ?>ajax/fetch_convert_no_to_words_ajax.php",
		dataType : "json", 
		data : "fixed_net_total="+fixed_net_total,
		success : function(data) {				
				 $("#number_to_words_span").html(data.number_to_words_val);
		}
	});
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


function replace_value(select_id,no){

	/*var str = "Hello123!";

	var newStr = str.replace(/[a-zA-Z]/g, '*');*/

	var id_values=$("#"+select_id).val();

	//alert(id_values);

	var newStr = id_values.replace(/[a-zA-Z]/g, '');

	var newStr2 = newStr.replace(/[ ]/g, '');

	var newStr3 = newStr2.replace(/[_\W]+/g, '');

	//alert(newStr3);

	$("#"+select_id).val(newStr3);

}

function reset_forms_val(){

	location.reload();	

}

function gender_defualt(){
	
	 $.ajax({
		  type: "POST",
		  dataType : "json", 
		  url: 'get_json_data_patient.php?flag=3',		  
		  data: {
			  prefix: $("#prefix").val()
		  },
		  success: function(data) {
			//alert(data.Msg);
			$("#gender").val(data.default_gender);
			
		  }
	});
}



</script>
<?php include "footer.php" ?>

<!-- END JAVASCRIPTS -->

</body><!-- END BODY -->

</html>