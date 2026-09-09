<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
include "conn.php";
//$_SESSION["department_id"]=8;
$flag=$_GET["flag"];

	if($flag=="1"){	
	
		load_meeting_details();
	
	}
	else if($flag=="2"){
	
		notification_feedback();
	
	}else if($flag=="4"){	
	
		load_roaster_details();
	
	}
	else if($flag=="5"){	
	
		load_salary_sheet_details();
	
	}
	else{
		echo "Flag  Not Selected";
		
		}
	
	

function load_meeting_details(){
	
		global $conn;
		
		$meeting_id=$_POST['meeting_id'];
		$user_login_id=$_POST['user_login_id'];
		$notifation_type=$_POST['notifation_type'];
		if($notifation_type=='2'){
			
			$sql6 = $conn->query("UPDATE `meeting_scheduling_employee_by_hr` SET `meeting_cancel_notification_get`='1'  where `meeting_id`='".$meeting_id."' AND `emp_id`='".$user_login_id."' ");
		
		$sql="SELECT `meeting_scheduling_employee_by_hr`.*,`meeting_scheduling_by_hr`.`meeting_topic`, `meeting_scheduling_by_hr`.`meeting_date`, `meeting_scheduling_by_hr`.`meeting_time`, `meeting_scheduling_by_hr`.`meeting_place`, `meeting_scheduling_by_hr`.`meeting_speaker`, `meeting_scheduling_by_hr`.`meeting_points`, `meeting_scheduling_by_hr`.`meeting_photo`, `meeting_scheduling_by_hr`.`meeting_done_flag`, `meeting_scheduling_by_hr`.`meeting_status`, `meeting_scheduling_by_hr`.`meeting_remarks`, `meeting_scheduling_by_hr`.`meeting_agenda_id` FROM `meeting_scheduling_employee_by_hr` INNER JOIN `meeting_scheduling_by_hr` ON  `meeting_scheduling_employee_by_hr`.`meeting_id`= `meeting_scheduling_by_hr`.`id` WHERE `meeting_scheduling_employee_by_hr`.`emp_id`= '" .$user_login_id. "' AND `meeting_scheduling_employee_by_hr`.`meeting_id`= '" .$meeting_id. "' ORDER BY `meeting_scheduling_employee_by_hr`.`id` DESC";
		
		
		$sl=1;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$flag_order=0;
			$meeting_agenda_name="";
			$sql15="SELECT `meeting_agenda` FROM `meeting_agenda_masters` Where `id`='".$row['meeting_agenda_id']."'";
								 $result15=$conn->query($sql15) ;				
								 $row15 = $result15->fetch_assoc();
								 $count15=$result15->num_rows;
								 if($count15>0)
								 {
									$meeting_agenda_name=$row15['meeting_agenda'];
								 } 
			
		?>

<div class="col-md-6"> <b>Meeting Agenda: </b><?php echo $meeting_agenda_name; ?> <br/>
  <b>Meeting Topic: </b><?php echo $row['meeting_topic']; ?> <br/>
  <b>Meeting Date & Time: </b>
  <?php if($row['meeting_date']!='') echo date("d/m/Y", strtotime($row['meeting_date'])); ?>
  <?php if($row['meeting_time']!='') echo date("h:i A", strtotime($row['meeting_time'])); ?>
  <br/>
  <b>Place: </b><?php echo $row['meeting_place']; ?> <br/>
  <b>Speaker: </b><?php echo $row['meeting_speaker']; ?> <br/>
</div>
<div class="col-md-6">
  <?php if($row['meeting_points']!=''){ ?>
  <b>Meeting Agenda: </b><?php echo $row['meeting_points']; ?> <br/>
  <?php  } ?>
</div>
<div class="col-md-12">
  <p>&nbsp;</p>
</div>
<div class="col-md-6"> <b>Meeting Status: </b>
  <?php if($row['meeting_status']=='0'){ echo 'Meeting Created';} else if($row['meeting_status']=='2'){ echo 'Meeting Started';}else if($row['meeting_status']=='1'){ echo 'Meeting Ended';}else { echo 'Meeting Canceled';} ?>
  <br/>
</div>
<div class="col-md-6"> <b>Meeting Attendence: </b>
  <?php if($row['meeting_attendence']=='0'){ echo 'No';}else { echo 'Yes';} ?>
  <br/>
</div>
<div class="col-md-12">
  <p>&nbsp;</p>
</div>
<div class="col-md-6">
  <?php if($row['meeting_feedback']!=''){ ?>
  <b>Meeting Feedback: </b><?php echo $row['meeting_feedback']; ?> <br/>
  <?php  } ?>
</div>
<div class="col-md-6">
  <?php if($row['meeting_photo']!=''){ ?>
  <b>Meeting Photo: </b> <a href="<?php echo  ADMIN_URL.'upload/meeting_photo/'.$row['meeting_photo']; ?>" name="meeting_photo_download" id="meeting_photo_download" download=""><img src="<?php echo  ADMIN_URL; ?>icon/download_icon.png" title="Download"></a> <br/>
  <?php  } ?>
</div>
<?php
			
		$sl++;
		}	
		}else{
			$sql6 = $conn->query("UPDATE `meeting_scheduling_employee_by_hr` SET `meeting_attending_notification_get`='1'  where `meeting_id`='".$meeting_id."' AND `emp_id`='".$user_login_id."' ");
		
		$sql="SELECT `meeting_scheduling_employee_by_hr`.*,`meeting_scheduling_by_hr`.`meeting_topic`, `meeting_scheduling_by_hr`.`meeting_date`, `meeting_scheduling_by_hr`.`meeting_time`, `meeting_scheduling_by_hr`.`meeting_place`, `meeting_scheduling_by_hr`.`meeting_speaker`, `meeting_scheduling_by_hr`.`meeting_points`, `meeting_scheduling_by_hr`.`meeting_photo`, `meeting_scheduling_by_hr`.`meeting_done_flag`, `meeting_scheduling_by_hr`.`meeting_status`, `meeting_scheduling_by_hr`.`meeting_remarks`, `meeting_scheduling_by_hr`.`meeting_agenda_id` FROM `meeting_scheduling_employee_by_hr` INNER JOIN `meeting_scheduling_by_hr` ON  `meeting_scheduling_employee_by_hr`.`meeting_id`= `meeting_scheduling_by_hr`.`id` WHERE `meeting_scheduling_employee_by_hr`.`emp_id`= '" .$user_login_id. "' AND `meeting_scheduling_employee_by_hr`.`meeting_id`= '" .$meeting_id. "' ORDER BY `meeting_scheduling_employee_by_hr`.`id` DESC";
		
		
		$sl=1;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$flag_order=0;
			$meeting_agenda_name="";
			$sql15="SELECT `meeting_agenda` FROM `meeting_agenda_masters` Where `id`='".$row['meeting_agenda_id']."'";
								 $result15=$conn->query($sql15) ;				
								 $row15 = $result15->fetch_assoc();
								 $count15=$result15->num_rows;
								 if($count15>0)
								 {
									$meeting_agenda_name=$row15['meeting_agenda'];
								 } 
			
		?>
<div class="col-md-6"> <b>Meeting Agenda: </b><?php echo $meeting_agenda_name; ?> <br/>
  <b>Meeting Topic: </b><?php echo $row['meeting_topic']; ?> <br/>
  <b>Meeting Date & Time: </b>
  <?php if($row['meeting_date']!='') echo date("d/m/Y", strtotime($row['meeting_date'])); ?>
  <?php if($row['meeting_time']!='') echo date("h:i A", strtotime($row['meeting_time'])); ?>
  <br/>
  <b>Place: </b><?php echo $row['meeting_place']; ?> <br/>
  <b>Speaker: </b><?php echo $row['meeting_speaker']; ?> <br/>
</div>
<div class="col-md-6">
  <?php if($row['meeting_points']!=''){ ?>
  <b>Meeting Agenda: </b><?php echo $row['meeting_points']; ?> <br/>
  <?php  } ?>
</div>
<div class="col-md-12">
  <p>&nbsp;</p>
</div>
<div class="col-md-6"> <b>Meeting Status: </b>
  <?php if($row['meeting_status']=='0'){ echo 'Meeting Created';} else if($row['meeting_status']=='2'){ echo 'Meeting Started';}else if($row['meeting_status']=='1'){ echo 'Meeting Ended';}else { echo 'Meeting Canceled';} ?>
  <br/>
</div>
<div class="col-md-6"> <b>Meeting Attendence: </b>
  <?php if($row['meeting_attendence']=='0'){ echo 'No';}else { echo 'Yes';} ?>
  <br/>
</div>
<div class="col-md-12">
  <p>&nbsp;</p>
</div>
<div class="col-md-6">
  <?php if($row['meeting_feedback']!=''){ ?>
  <b>Meeting Feedback: </b><?php echo $row['meeting_feedback']; ?> <br/>
  <?php  } ?>
</div>
<div class="col-md-6">
  <?php if($row['meeting_photo']!=''){ ?>
  <b>Meeting Photo: </b> <a href="<?php echo  ADMIN_URL.'upload/meeting_photo/'.$row['meeting_photo']; ?>" name="meeting_photo_download" id="meeting_photo_download" download=""><img src="<?php echo  ADMIN_URL; ?>icon/download_icon.png" title="Download"></a> <br/>
  <?php  } ?>
</div>
<?php
			
		$sl++;
		}	
			
		}
		
		
	
	}
	
	function notification_feedback(){
	
		global $conn;
		
		$meeting_id=$_POST['meeting_id'];
		$user_login_id=$_POST['user_login_id'];
		$notifation_type=$_POST['notifation_type'];
		
		$sql="SELECT `meeting_scheduling_employee_by_hr`.*,`meeting_scheduling_by_hr`.`meeting_topic`, `meeting_scheduling_by_hr`.`meeting_date`, `meeting_scheduling_by_hr`.`meeting_time`, `meeting_scheduling_by_hr`.`meeting_place`, `meeting_scheduling_by_hr`.`meeting_speaker`, `meeting_scheduling_by_hr`.`meeting_points`, `meeting_scheduling_by_hr`.`meeting_photo`, `meeting_scheduling_by_hr`.`meeting_done_flag`, `meeting_scheduling_by_hr`.`meeting_status`, `meeting_scheduling_by_hr`.`meeting_remarks`, `meeting_scheduling_by_hr`.`meeting_agenda_id` FROM `meeting_scheduling_employee_by_hr` INNER JOIN `meeting_scheduling_by_hr` ON  `meeting_scheduling_employee_by_hr`.`meeting_id`= `meeting_scheduling_by_hr`.`id` WHERE `meeting_scheduling_employee_by_hr`.`emp_id`= '" .$user_login_id. "' AND `meeting_scheduling_employee_by_hr`.`meeting_id`= '" .$meeting_id. "' ORDER BY `meeting_scheduling_employee_by_hr`.`id` DESC";
		
		
		$sl=1;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$flag_order=0;
			$meeting_agenda_name="";
			$sql15="SELECT `meeting_agenda` FROM `meeting_agenda_masters` Where `id`='".$row['meeting_agenda_id']."'";
								 $result15=$conn->query($sql15) ;				
								 $row15 = $result15->fetch_assoc();
								 $count15=$result15->num_rows;
								 if($count15>0)
								 {
									$meeting_agenda_name=$row15['meeting_agenda'];
								 } 
			
		?>
<div class="col-md-6"> <b>Meeting Agenda: </b><?php echo $meeting_agenda_name; ?> <br/>
  <b>Meeting Topic: </b><?php echo $row['meeting_topic']; ?> <br/>
  <b>Meeting Date & Time: </b>
  <?php if($row['meeting_date']!='') echo date("d/m/Y", strtotime($row['meeting_date'])); ?>
  <?php if($row['meeting_time']!='') echo date("h:i A", strtotime($row['meeting_time'])); ?>
  <br/>
  <b>Place: </b><?php echo $row['meeting_place']; ?> <br/>
  <b>Speaker: </b><?php echo $row['meeting_speaker']; ?> <br/>
</div>
<div class="col-md-12">
  <p>&nbsp;</p>
</div>
<form action="" method="post" class="form-horizontal">
  <div class="form-body">
    <div class="form-group">
      <label class="col-md-4 control-label"><b>Give Feedback For Above Meeting : </b></label>
      <div class="col-md-7">
        <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
          <textarea name="meeting_feedback" id="meeting_feedback" class="form-control" placeholder="Enter Meeting Feedback" autocomplete="off" required="" ></textarea>
          <input type="hidden" name="meeting_id_for_feedback" id="meeting_id_for_feedback" class="form-control" placeholder="Enter id" value="<?php echo $meeting_id; ?>">
          <input type="hidden" name="user_login_id" id="user_login_id" class="form-control" placeholder="Enter id" value="<?php echo $user_login_id; ?>">
          <input type="hidden" name="meeting_feedback_time" id="meeting_feedback_time" class="form-control" placeholder="Enter id" value="<?php echo date('Y-m-d H:i:s');?>" />
        </div>
      </div>
    </div>
  </div>
  <div class="form-actions top">
    <div class="row">
      <div class="col-md-offset-4 col-md-7">
        <button type="submit" name="submit_feedback" id="submit_feedback" class="btn green">Submit Feedback</button>
      </div>
    </div>
  </div>
</form>
<?php 
		}
	}
	
?>
<?php 
function load_roaster_details(){
	
		global $conn;
		
		$roaster_id=$_POST['roaster_id'];
		$user_login_id=$_POST['user_login_id'];
		$notifation_type=$_POST['notifation_type'];
		

		
			$sql6 = $conn->query("UPDATE `monthly_roaster_details_by_hr` SET `roaster_attending_notification_get`='1'  where `roaster_id`='".$roaster_id."' AND `emp_id`='".$user_login_id."' ");
		
		$sql="SELECT `monthly_roaster_details_by_hr`.* FROM `monthly_roaster_details_by_hr` INNER JOIN `monthly_roaster_by_hr` ON  `monthly_roaster_details_by_hr`.`roaster_id`= `monthly_roaster_by_hr`.`id` WHERE `monthly_roaster_details_by_hr`.`emp_id`= '" .$user_login_id. "' AND `monthly_roaster_details_by_hr`.`roaster_id`= '" .$roaster_id. "' ORDER BY `monthly_roaster_details_by_hr`.`id` DESC";
		
		
		$sl=1;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$flag_order=0;		
			
			
		?>
<div class="col-md-6"> <b>From Date: </b><?php echo  date("d-m-Y", strtotime($row['from_date'])); ?> <br/>
  <b>To Date: </b><?php echo date("d-m-Y", strtotime($row['to_date'])); ?> <br/>
  <b>For The Month Of: </b><?php echo date("M", mktime(0, 0, 0, $row['start_month'], 10)).', '.$row['start_year']; ?> <br/>
</div>
<div class="col-md-6">
  <?php if($row['daily_roaster_file_photo']!=''){ ?>
  <b>Roster Download: </b> <a href="<?php echo  ADMIN_URL.'upload/roaster_register/'.$row['daily_roaster_file_photo']; ?>" name="roaster_photo_download" id="roaster_photo_download" download=""><img src="<?php echo  ADMIN_URL; ?>icon/download_icon.png" title="Download"></a> <br/>
  <?php  } ?>
</div>
<div class="col-md-12">
  <p>&nbsp;</p>
</div>
<?php
			
		$sl++;
		}	
	}
	?>
<?php 
function load_salary_sheet_details(){
	
		global $conn;
		
		$salary_id=$_POST['salary_id'];
		$user_login_id=$_POST['user_login_id'];
		$notifation_type=$_POST['notifation_type'];
		

		
			$sql6 = $conn->query("UPDATE `salary_sheet_employee` SET `salary_upload_flag`='0'  where `id`='".$salary_id."' AND `user_id`='".$user_login_id."' ");
		
		
		$sql="SELECT * FROM `salary_sheet_employee` WHERE `user_id`= '" .$user_login_id. "' AND `del_flag`='0'   AND `id`='".$salary_id."' ORDER BY `id` DESC";	
		$sl=1;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$flag_order=0;		
			
			
		?>
<div class="col-md-6"> <b>
  <?php if($row['from_month']!='') { echo 'Payslip for the month of: '.date("M", mktime(0, 0, 0, $row['from_month'], 10)); if($row['from_year']!=''){ echo  ' , '.$row['from_year'];} }?>
  <br/>
  Gross Monthly Salary :
  <?php if($row['earnings_total']!='') { echo  $row['earnings_total']; }else{ echo '0';}?>
  <br />
  Total Deductions :
  <?php if($row['deductions_total']!='') { echo  $row['deductions_total']; }else{ echo '0';};?>
  <br />
  Net Pay :
  <?php if($row['net_pay_total_this_month']!='') { echo  $row['net_pay_total_this_month']; }else{ echo '0';}?>
  <br />
  Total Yearly Components Paid :
  <?php if($row['yearly_components_total']!='') { echo  $row['yearly_components_total']; }else{ echo '0';}?>
  <br />
  </b> </div>
<div class="col-md-6">
  <?php if($row['salary_sheet_pdf']!=''){ ?>
  <b>Pay Slip Download: </b> <a href="<?php echo  ADMIN_URL.'upload/salary_sheet_pdf/'.$row['salary_sheet_pdf']; ?>" name="roaster_photo_download" id="roaster_photo_download" download=""><img src="<?php echo  ADMIN_URL; ?>icon/download_icon.png" title="Download"></a> <br/>
  <?php  } ?>
</div>
<div class="col-md-12">
  <p>&nbsp;</p>
</div>
<?php
			
		$sl++;
		}	
	}
	?>
