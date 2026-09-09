<?php 
include 'function.php';
include 'conn.php'; 
if(isset($_REQUEST['submit_feedback']))
{
	// Edit Data 	
	if($_REQUEST['meeting_id_for_feedback']!=''){	
		$emp_id=mysqli_real_escape_string($conn,$_REQUEST['user_login_id']);
		$meeting_id=mysqli_real_escape_string($conn,$_REQUEST['meeting_id_for_feedback']);
		$meeting_feedback_time=mysqli_real_escape_string($conn,$_REQUEST['meeting_feedback_time']);
		$meeting_feedback=mysqli_real_escape_string($conn,$_REQUEST['meeting_feedback']);
		$sql = "UPDATE `meeting_scheduling_employee_by_hr` SET `meeting_feedback`='".$meeting_feedback."',`meeting_feedback_time`='".$meeting_feedback_time."' WHERE `emp_id`='".$emp_id."' AND `meeting_id`='".$meeting_id."'";
		if($conn->query($sql)===TRUE)
		{
		$msg="Feedback submitted successfully";
		$flg=0;
		$redirectUrl=ADMIN_URL.'view_notifiactions.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'view_notifiactions.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
}
?>
<?php include "header.php"; ?>
<style>
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #fff !important;
	
}
.table-hover>tbody>tr:hover {
    background-color: #f5f5f5 !important;
}
</style>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container"> 
  <!-- BEGIN PAGE HEAD -->
  <div class="page-head">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1><small>Welcome to Electronic Medical Records System</small></h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="<?php echo ADMIN_URL; ?>dashboard.php">Home</a><i class="fa fa-circle"></i> </li>
          <li class="active"> Dashboard </li>
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Notifications</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-4">
                    
                  </div>
                  <div class="col-md-8">
                    <div class="col-md-12 col-sm-12 col-xs-12 clearfix" style="text-align:right !important; border:none !important;font-weight:bold;"> Notifaction Read: <span class="btn" style="background-color: #d0e9c6;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Notifaction Unread: <span class="btn" style="background-color: #c33b3b;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Particular Notification: <span class="btn" style="background-color: #baaae3;">&nbsp;</span> </div>
                    <div class="btn-group pull-right">                       
                    </div>
                  </div>
                </div>
              </div>
              <div class="row number-stats" >
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                	<?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>                    
                        <button class="close" data-close="alert"></button>
                        <span><?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?> </span>
                        <?php if(isset($_REQUEST['msg'])){ echo '</div>';}?> 
					</div>
                 </div>
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <!-- <p style="text-align:right">By MRD Number, Name</p> -->
                <thead>
                  <tr>
                    <th>Sl. No</th>
                    <th>Notification Details</th>
                    <th>Details</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  
					 $today_dates=date('Y-m-d');
					$prev_dates= date('Y-m-d', strtotime($today_dates. ' - 30 days'));
					$next_dates= date('Y-m-d', strtotime($today_dates. ' + 30 days'));
					$total_notifation=0;
					/*
					$notifation_type=1 -> meeting_get_notifation
					$notifation_type=2 -> meeting_cancel_notifation
					$notifation_type=3 -> meeting_feedback_notifation
					$notifation_type=4 -> roaster_get_notifation
					 */				
			 
			 		/* meeting_notifation */	
					$sql3="SELECT `meeting_scheduling_employee_by_hr`.*,`meeting_scheduling_by_hr`.`meeting_topic`, `meeting_scheduling_by_hr`.`meeting_date`, `meeting_scheduling_by_hr`.`meeting_time`, `meeting_scheduling_by_hr`.`meeting_place`, `meeting_scheduling_by_hr`.`meeting_speaker`, `meeting_scheduling_by_hr`.`meeting_points`, `meeting_scheduling_by_hr`.`meeting_photo`, `meeting_scheduling_by_hr`.`meeting_done_flag`, `meeting_scheduling_by_hr`.`meeting_status`, `meeting_scheduling_by_hr`.`meeting_remarks`, `meeting_scheduling_by_hr`.`meeting_agenda_id` FROM `meeting_scheduling_employee_by_hr` INNER JOIN `meeting_scheduling_by_hr` ON  `meeting_scheduling_employee_by_hr`.`meeting_id`= `meeting_scheduling_by_hr`.`id` WHERE `meeting_scheduling_employee_by_hr`.`emp_id`= '" .$_SESSION['id']. "'  AND `meeting_scheduling_employee_by_hr`.`meeting_attending_option`='0' ORDER BY `meeting_scheduling_employee_by_hr`.`id` DESC";
                     $result3=$conn->query($sql3) ;
                     $sl=1;
                     while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
                     {
                                  $created_by="None";
								 $modified_by="None";
								 $meeting_agenda_name="";					
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
								 $sql15="SELECT `meeting_agenda` FROM `meeting_agenda_masters` Where `id`='".$row3['meeting_agenda_id']."'";
								 $result15=$conn->query($sql15) ;				
								 $row15 = $result15->fetch_assoc();
								 $count15=$result15->num_rows;
								 if($count15>0)
								 {
									$meeting_agenda_name=$row15['meeting_agenda'];
								 } 
								 $notifation_type=1;
								 if(($row3['meeting_status']=='3')){
									  $notifation_type=2;
								  }
								  if(($row3['meeting_status']=='1')&&($row3['meeting_feedback']=='')){
									  $notifation_type=3;
								  }
								 $rowclass="";
									if($row3['meeting_attending_notification_get']=='0'){
										$rowclass="#c33b3b !important";
									}
									if($row3['meeting_attending_notification_get']=='1'){
										$rowclass="#d0e9c6 !important";
									}
                    ?>
                  <tr id="meeting_<?php echo $row3['meeting_id']; ?>" style="background-color:<?php echo $rowclass; ?>;">
                    <td><?php echo $sl; ?></td>
                    <td><span style="color:#0014ff;font-weight:bold;font-size:14px;text-decoration: underline ;display: list-item;margin-left : 1em;"> Meeting Details</span><br/>
					<?php if($row3['meeting_attending_notification_get']=='0') { echo "<b>New meeting scheduled ariived, To view meeting details <br/> please click on eye icon in action tab.</b>";}else{?><b>Meeting Agenda: </b><?php echo $meeting_agenda_name; ?> <br/>
                      <b>Meeting Topic: </b><?php echo $row3['meeting_topic']; ?> <br/>
                      <b>Meeting Date & Time: </b>
                      <?php if($row3['meeting_date']!='') echo date("d/m/Y", strtotime($row3['meeting_date'])); ?>
                      <?php if($row3['meeting_time']!='') echo date("h:i A", strtotime($row3['meeting_time'])); ?>
                      <br/>
                      <b>Place: </b><?php echo $row3['meeting_place']; ?> <br/>
                      <b>Speaker: </b><?php echo $row3['meeting_speaker']; ?> <br/><?php } ?></td>
                    <td><b>Created By: </b><?php echo $created_by; ?> <br/>
                      <b>Created On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['created_on'])); ?> <br/>
                      <?php if($row3['modified_time']!=''){ ?>
                      <b>Last Modified By: </b><?php echo $modified_by; ?> <br/>
                      <b>Modified On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['modified_time'])); ?>
                      <?php } ?></td>  
                    <td><a onClick="notification_details('<?php echo $row3['meeting_id']; ?>','<?php echo $_SESSION['id']; ?>','<?php echo $notifation_type; ?>')"  href="javascript:void(0);" title="View Notifation Details"><img src="<?php echo ADMIN_URL; ?>icon/eye.png"  title="View Notifation Details"></a> <?php if(($row3['meeting_status']=='1')&&($row3['meeting_feedback']=='')){ ?> | <a onClick="notification_feedback('<?php echo $row3['meeting_id']; ?>','<?php echo $_SESSION['id']; ?>','<?php echo $notifation_type; ?>')"  href="javascript:void(0);" title="Give Feedback"><img src="<?php echo ADMIN_URL; ?>icon/feedback_2_32x32.png"  title="Give Feedback"></a><?php } ?></td>
                  </tr>
                  <?php  
          $sl++; }?>
         		 <?php 
          			/* roaster_notifation */	
					$sql3="SELECT `monthly_roaster_details_by_hr`.* FROM `monthly_roaster_details_by_hr` INNER JOIN `monthly_roaster_by_hr` ON  `monthly_roaster_details_by_hr`.`roaster_id`= `monthly_roaster_by_hr`.`id` WHERE `monthly_roaster_details_by_hr`.`emp_id`= '" .$_SESSION['id']. "' AND `monthly_roaster_by_hr`.`del_flag`='0'  AND `monthly_roaster_by_hr`.`from_date` >= '" .$prev_dates. "' AND `monthly_roaster_by_hr`.`to_date` <= '" .$next_dates. "' ORDER BY `monthly_roaster_details_by_hr`.`id` DESC";
                     $result3=$conn->query($sql3) ;
                     $sl=1;
                     while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
                     {
                                  $created_by="None";
								 $modified_by="None";				
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
								 $notifation_type=4;
								 $rowclass="";
									if($row3['roaster_attending_notification_get']=='0'){
										$rowclass="#c33b3b !important";
									}
									if($row3['roaster_attending_notification_get']=='1'){
										$rowclass="#d0e9c6 !important";
									}
                    ?>
                  <tr id="roaster_<?php echo $row3['roaster_id']; ?>" style="background-color:<?php echo $rowclass; ?>;">
                    <td><?php echo $sl; ?></td>
                    <td><span style="color:#0014ff;font-weight:bold;font-size:14px;text-decoration: underline ;display: list-item;margin-left : 1em;"> Roster Details</span><br/>
					<?php if($row3['roaster_attending_notification_get']=='0') { echo "<b>New roster ariived, To view roaster details <br/> please click on eye icon in action tab.</b>";}else{?><b>From Date: </b><?php echo  date("d-m-Y", strtotime($row3['from_date'])); ?> <br/>
                      <b>To Date: </b><?php echo date("d-m-Y", strtotime($row3['to_date'])); ?> <br/>                      
                      <b>For The Month Of: </b><?php echo date("M", mktime(0, 0, 0, $row3['start_month'], 10)).', '.$row3['start_year']; ?> <br/><?php } ?></td>
                    <td><b>Created By: </b><?php echo $created_by; ?> <br/>
                      <b>Created On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['created_on'])); ?> <br/>
                      <?php if($row3['modified_time']!=''){ ?>
                      <b>Last Modified By: </b><?php echo $modified_by; ?> <br/>
                      <b>Modified On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['modified_time'])); ?>
                      <?php } ?></td>  
                    <td><a onClick="roaster_details('<?php echo $row3['roaster_id']; ?>','<?php echo $_SESSION['id']; ?>','<?php echo $notifation_type; ?>')"  href="javascript:void(0);" title="View Notifation Details"><img src="<?php echo ADMIN_URL; ?>icon/eye.png"  title="View Notifation Details"></a> </td>
                  </tr>
                  <?php  
          $sl++; }?>
          <?php 
          			/* Salary_Slip_Upload_notifation */	
					$sql3="SELECT * FROM `salary_sheet_employee` WHERE `user_id`= '" .$_SESSION['id']. "' AND `del_flag`='0' AND  `salary_sheet_pdf` <>''  AND date(`modified_on`) BETWEEN '" .$prev_dates. "' AND '" .$next_dates. "' ORDER BY `id` DESC";
                     $result3=$conn->query($sql3) ;
                     $sl=1;
                     while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
                     {
                                  $created_by="None";
								 $modified_by="None";				
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
								 $notifation_type=5;
								 $rowclass="";
									if($row3['salary_upload_flag']=='1'){
										$rowclass="#c33b3b !important";
									}
									if($row3['salary_upload_flag']=='0'){
										$rowclass="#d0e9c6 !important";
									}
                    ?>
                  <tr id="salary_sheet_<?php echo $row3['id']; ?>" style="background-color:<?php echo $rowclass; ?>;">
                    <td><?php echo $sl; ?></td>
                    <td><span style="color:#0014ff;font-weight:bold;font-size:14px;text-decoration: underline ;display: list-item;margin-left : 1em;"> Salary Slip Details</span><br/>
					<?php if($row3['salary_upload_flag']=='1') { echo "<b>New salary slip ariived, To view salary slip details <br/> please click on eye icon in action tab.</b>";}else{?>
                    <b> <?php if($row3['from_month']!='') { echo 'Payslip for the month of: '.date("M", mktime(0, 0, 0, $row3['from_month'], 10)); if($row3['from_year']!=''){ echo  ' , '.$row3['from_year'];} }?> <br/>
                    Gross Monthly Salary : <?php if($row3['earnings_total']!='') { echo  $row3['earnings_total']; }else{ echo '0';}?> <br />
                    Total Deductions : <?php if($row3['deductions_total']!='') { echo  $row3['deductions_total']; }else{ echo '0';};?> <br />
                    Net Pay : <?php if($row3['net_pay_total_this_month']!='') { echo  $row3['net_pay_total_this_month']; }else{ echo '0';}?> <br />
                    Total Yearly Components Paid : <?php if($row3['yearly_components_total']!='') { echo  $row3['yearly_components_total']; }else{ echo '0';}?> <br />
                    --------------------------------------------------------------<br/>
                    Total Pay : <?php if($row3['total_pay_this_month']!='') { echo  $row3['total_pay_this_month']; }else{ echo '0';}?> <br />
                      </b><?php } ?></td>
                    <td><b>Created By: </b><?php echo $created_by; ?> <br/>
                      <b>Created On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['created_on'])); ?> <br/>
                      <?php if($row3['modified_time']!=''){ ?>
                      <b>Last Modified By: </b><?php echo $modified_by; ?> <br/>
                      <b>Modified On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['modified_time'])); ?>
                      <?php } ?></td>  
                    <td><a onClick="salary_slip_details('<?php echo $row3['id']; ?>','<?php echo $_SESSION['id']; ?>','<?php echo $notifation_type; ?>')"  href="javascript:void(0);" title="View Notifation Details"><img src="<?php echo ADMIN_URL; ?>icon/eye.png"  title="View Notifation Details"></a> </td>
                  </tr>
                  <?php  
          $sl++; }?>
                </tbody>
              </table>
              <input type="hidden" id="meeting_id" name="meeting_id" value="<?php if(isset($_REQUEST['meeting_id'])){ echo $_REQUEST['meeting_id'];}else{ echo '';} ?>">
              <input type="hidden" id="roaster_id" name="roaster_id" value="<?php if(isset($_REQUEST['roaster_id'])){ echo $_REQUEST['roaster_id'];}else{ echo '';} ?>">
               <input type="hidden" id="salary_id" name="salary_id" value="<?php if(isset($_REQUEST['salary_id'])){ echo $_REQUEST['salary_id'];}else{ echo '';} ?>">
              <div id="staticBackdrop1" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content"  style="width:1000px !important;margin-left:-200px !important;">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label class="col-md-12 control-label" style="font-weight:bold;">Notifiaction Details : </label>
                        <div class="col-md-12">
                          <div id="meeting_all_details">
                            
                          </div>
                        </div>
                      </div>
                      <div style="clear:both"></div>
                      <div class="form-group" style="margin-top:10px">
                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-offset-3 col-md-4"> 
                              <!--<button type="button" class="btn green" onClick="save_type(); return false;">Submit</button>-->
                              <center>
                                <button type="button" class="btn btn-sm red"  id="close_models"  aria-label="Close">Close</button>
                              </center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
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
  </div>
  <!-- END PAGE CONTENT --> 
</div>
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script>

 $(document).ready( function() {       
  setTimeout('$("#alert_msg").hide()',3000);
  $(".table-striped>tbody>tr:nth-of-type(odd)").removeClass("odd");
	$(".table-striped>tbody>tr:nth-of-type(even)").removeClass("even");
	$("#close_models").click(function(){
		location.reload();
	});
	var meeting_id=$('#meeting_id').val();
	if(meeting_id!=''){		
		$("#meeting_"+meeting_id).removeAttr("style");		
		$("#meeting_"+meeting_id).attr("style", "background-color : #baaae3 !important;");		
	}
	var roaster_id=$('#roaster_id').val();
	if(roaster_id!=''){		
		$("#roaster_"+meeting_id).removeAttr("style");		
		$("#roaster_"+meeting_id).attr("style", "background-color : #baaae3 !important;");		
	}
	var salary_id=$('#salary_id').val();
	if(salary_id!=''){		
		$("#salary_sheet_"+salary_id).removeAttr("style");		
		$("#salary_sheet_"+salary_id).attr("style", "background-color : #baaae3 !important;");		
	}
	
 });
 
function check(id){
  setInterval(function(){
   $('#error_msg').html('');
  }, 5000);
 
} 
function notification_details(meeting_id,user_login_id,notifation_type){
	$('#staticBackdrop1').modal('show');
	$('#meeting_all_details').html('');
		


var data_details={
		"meeting_id": meeting_id,	
		"user_login_id": user_login_id,
		"notifation_type": notifation_type
			
}

$.ajax({
            url: 'get_json_data_notifications.php?flag=1',
			type: 'POST',
			data: data_details,
			success: function (data) {			
				$("#meeting_all_details").html(data);
			}
		});
	
}


function notification_feedback(meeting_id,user_login_id,notifation_type){
	$('#staticBackdrop1').modal('show');
	$('#meeting_all_details').html('');
		


var data_details={
		"meeting_id": meeting_id,	
		"user_login_id": user_login_id,
		"notifation_type": notifation_type
			
}

$.ajax({
            url: 'get_json_data_notifications.php?flag=2',
			type: 'POST',
			data: data_details,
			success: function (data) {			
				$("#meeting_all_details").html(data);
			}
		});
	
}

function roaster_details(roaster_id,user_login_id,notifation_type){
	$('#staticBackdrop1').modal('show');
	$('#meeting_all_details').html('');
		


var data_details={
		"roaster_id": roaster_id,	
		"user_login_id": user_login_id,
		"notifation_type": notifation_type
			
}

$.ajax({
            url: 'get_json_data_notifications.php?flag=4',
			type: 'POST',
			data: data_details,
			success: function (data) {			
				$("#meeting_all_details").html(data);
			}
		});
	
}

function salary_slip_details(salary_id,user_login_id,notifation_type){
	$('#staticBackdrop1').modal('show');
	$('#meeting_all_details').html('');
	

var data_details={
		"salary_id": salary_id,
		"user_login_id": user_login_id,
		"notifation_type": notifation_type
			
}

$.ajax({
            url: 'get_json_data_notifications.php?flag=5',
			type: 'POST',
			data: data_details,
			success: function (data) {			
				$("#meeting_all_details").html(data);
			}
		});
	
}
</script> 
<!-- END PAGE CONTAINER -->
<?php include "footer.php" ?>