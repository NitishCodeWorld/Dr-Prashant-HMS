<?php

include "conn.php"; // Using database connection file here
if(isset($_POST['submit'])){
  $uhid_no = mysqli_real_escape_string($conn,$_POST['uhid_no']);
  $discharge_id = mysqli_real_escape_string($conn,$_POST['discharge_id']);
  $prefix = mysqli_real_escape_string($conn,$_POST['prefix']);
  $patient_name = mysqli_real_escape_string($conn,$_POST['patient_name']);
  //$dob = mysqli_real_escape_string($conn,$_POST['dob']);
  $age = mysqli_real_escape_string($conn,$_POST['age']);
  $gender = mysqli_real_escape_string($conn,$_POST['gender']);
 
  $phone_no = mysqli_real_escape_string($conn,$_POST['phone_no']);
  $procedure = mysqli_real_escape_string($conn,$_POST['procedure']);
  $procedure_eye = mysqli_real_escape_string($conn,$_POST['procedure_eye']);
  $procedure_type = mysqli_real_escape_string($conn,$_POST['procedure_type']);
  $admiting_doctor = mysqli_real_escape_string($conn,$_POST['admiting_doctor']);
  $anaesthetst_doctor = mysqli_real_escape_string($conn,$_POST['anaesthetst_doctor']);
  $medication_editor = mysqli_real_escape_string($conn,$_POST['medication_editor']);
  $query_contact_number = mysqli_real_escape_string($conn,$_POST['query_contact_number']);
  	
    if($_REQUEST['discharge_date']==''){
	$discharge_date='NULL';
	}else{
		$discharge_date= "'".date("Y-m-d", strtotime($_POST['discharge_date']))."'";
	}
	if($_REQUEST['anaesthesia_date']==''){
	$anaesthesia_date='NULL';
	}else{
		$anaesthesia_date= "'".date("Y-m-d", strtotime($_POST['anaesthesia_date']))."'";
	}
	if($_REQUEST['next_postop_chkup']==''){
	$next_postop_chkup='NULL';
	}else{
		$next_postop_chkup= "'".date("Y-m-d", strtotime($_POST['next_postop_chkup']))."'";
	}
	if($_REQUEST['next_postop_chkup_time']==''){
	$next_postop_chkup_time='NULL';
	}else{
		$next_postop_chkup_time= "'".date("H:i", strtotime($_POST['next_postop_chkup_time']))."'";
	}
	if($_REQUEST['final_postop_chkup']==''){
	$final_postop_chkup='NULL';
	}else{
		$final_postop_chkup= "'".date("Y-m-d", strtotime($_POST['final_postop_chkup']))."'";
	}
    if($_REQUEST['registration_date']==''){
	$registration_date='NULL';
	}else{
		$registration_date= "'".date("Y-m-d", strtotime($_POST['registration_date']))."'";
	}
	if($_REQUEST['registration_time']==''){
	$registration_time='NULL';
	}else{
		$registration_time= "'".date("H:i", strtotime($_POST['registration_time']))."'";
	}
	if($_REQUEST['discharge_time']==''){
	$discharge_time='NULL';
	}else{
		$discharge_time= "'".date("H:i", strtotime($_POST['discharge_time']))."'";
	}
	if($_REQUEST['dob']==''){
	$dob='NULL';
	}else{
		$dob= "'".date("Y-m-d", strtotime($_POST['dob']))."'";
	}
	$created_by=$_SESSION['id'];
	$created_on=date('Y-m-d H:i:s');	
	
	  $sql="insert into patient_discharge_summary set `uhid_no`='".$uhid_no."', `prefix`='".$prefix."', `patient_name`='".$patient_name."', `dob`=".$dob.", `age`='".$age."', `gender`='".$gender."', `registration_date`=".$registration_date.", `registration_time`=".$registration_time.", `discharge_date`=".$discharge_date.", `phone_no`='".$phone_no."', `procedure`='".$procedure."', `procedure_eye`='".$procedure_eye."', `procedure_type`='".$procedure_type."', `anaesthesia_date`=".$anaesthesia_date.", `admiting_doctor`='".$admiting_doctor."', `anaesthetst_doctor`='".$anaesthetst_doctor."', `medication_editor`='".$medication_editor."', `next_postop_chkup`=".$next_postop_chkup.", `next_postop_chkup_time`=".$next_postop_chkup_time.", `final_postop_chkup`=".$final_postop_chkup.", `query_contact_number`='".$query_contact_number."',`created_on`='".$created_on."', `discharge_time`=".$discharge_time.",`created_by`='".$created_by."'";
	  mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Patient Insert Sucessfully")));
	  $discharge_id=mysqli_insert_id($conn);
	    /*Diagnoses Entry*/
	    $count_diagnoses=mysqli_real_escape_string($conn,$_REQUEST['count_diagnoses']);		
		$deleted_diagnoses=mysqli_real_escape_string($conn,$_REQUEST['deleted_diagnoses']);		
		for($i=1;$i<=$count_diagnoses;$i++) {		
			if($_REQUEST['discharge_diagnoses_name'.$i]!='' && $_REQUEST['discharge_diagnoses_eye'.$i]!=''){
					if($_REQUEST['diagnoses_id'.$i]=='0'){
					$sql4 = $conn->query("INSERT INTO `patient_discharge_diagnoses_details_table` SET `patient_discharge_id`='".$discharge_id."',`uhid`='".$uhid_no."',`discharge_diagnoses_name`='".$_REQUEST['discharge_diagnoses_name'.$i]."',`discharge_diagnoses_eye`='".$_REQUEST['discharge_diagnoses_eye'.$i]."'");		
					}		
					if($_REQUEST['diagnoses_id'.$i]!='0'){
					$sql4 = $conn->query("update `patient_discharge_diagnoses_details_table` SET `discharge_diagnoses_name`='".$_REQUEST['discharge_diagnoses_name'.$i]."',`discharge_diagnoses_eye`='".$_REQUEST['discharge_diagnoses_eye'.$i]."' where `id`='".$_REQUEST['diagnoses_id'.$i]."'");		
					}		
			} 		
		}		
		if($deleted_diagnoses!=''){
			$remove_id_array=explode(":",$deleted_diagnoses);		
			//print_r($remove_id_array);		
			$itemCount = sizeof($remove_id_array);		
			//exit;		
			for($i=0;$i<($itemCount-1);$i++) {		
			$sql4 = $conn->query("UPDATE `patient_discharge_diagnoses_details_table` SET `del_flag` = '1' WHERE `id`='".$remove_id_array[$i]."' ");		
			}		
		}
		/*End Diagnoses*/
		/*Anaesthetst Assistent Entry*/
	    $count_anaesthetst=mysqli_real_escape_string($conn,$_REQUEST['count_anaesthetst']);		
		$deleted_anaesthetst_assistent=mysqli_real_escape_string($conn,$_REQUEST['deleted_anaesthetst_assistent']);		
		for($i=1;$i<=$count_anaesthetst;$i++) {		
			if($_REQUEST['anaesthetst_assistent'.$i]!=''){
					if($_REQUEST['anaesthetst_id'.$i]=='0'){
					$sql4 = $conn->query("INSERT INTO `patient_discharge_anaesthetst_assistent_details` SET `patient_discharge_id`='".$discharge_id."',`uhid`='".$uhid_no."',`anaesthetst_assistent`='".$_REQUEST['anaesthetst_assistent'.$i]."'");		
					}		
					if($_REQUEST['anaesthetst_id'.$i]!='0'){
					$sql4 = $conn->query("update `patient_discharge_anaesthetst_assistent_details` SET `patient_discharge_id`='".$discharge_id."',`uhid`='".$uhid_no."',`anaesthetst_assistent`='".$_REQUEST['anaesthetst_assistent'.$i]."' where `id`='".$_REQUEST['anaesthetst_id'.$i]."'");		
					}		
			} 		
		}		
		if($deleted_anaesthetst_assistent!=''){
			$remove_id_array=explode(":",$deleted_anaesthetst_assistent);		
			//print_r($remove_id_array);		
			$itemCount = sizeof($remove_id_array);		
			//exit;		
			for($i=0;$i<($itemCount-1);$i++) {		
			$sql4 = $conn->query("UPDATE `patient_discharge_anaesthetst_assistent_details` SET `del_flag` = '1' WHERE `id`='".$remove_id_array[$i]."' ");		
			}		
		}
		/*End Anaesthetst Assistent*/
		/*Post OP CHECK UP Entry*/
	    $count_post_up_chkup=mysqli_real_escape_string($conn,$_REQUEST['count_post_up_chkup']);		
		$deleted_post_up_chkup=mysqli_real_escape_string($conn,$_REQUEST['deleted_post_up_chkup']);		
		for($i=1;$i<=$count_post_up_chkup;$i++) {		
			if($_REQUEST['post_up_chk_up_advice'.$i]!=''){
					if($_REQUEST['post_up_chkup_id'.$i]=='0'){
					$sql4 = $conn->query("INSERT INTO `patient_discharge_post_up_chkup_details` SET `patient_discharge_id`='".$discharge_id."',`uhid`='".$uhid_no."',`post_up_chk_up_advice`='".$_REQUEST['post_up_chk_up_advice'.$i]."'");		
					}		
					if($_REQUEST['post_up_chkup_id'.$i]!='0'){
					$sql4 = $conn->query("update `patient_discharge_post_up_chkup_details` SET `post_up_chk_up_advice`='".$_REQUEST['post_up_chk_up_advice'.$i]."' where `id`='".$_REQUEST['diagnoses_id'.$i]."'");		
					}		
			} 		
		}		
		if($deleted_post_up_chkup!=''){
			$remove_id_array=explode(":",$deleted_post_up_chkup);		
			//print_r($remove_id_array);		
			$itemCount = sizeof($remove_id_array);		
			//exit;		
			for($i=0;$i<($itemCount-1);$i++) {		
			$sql4 = $conn->query("UPDATE `patient_discharge_post_up_chkup_details` SET `del_flag` = '1' WHERE `id`='".$remove_id_array[$i]."' ");		
			}		
		}
		/*End Post OP CHECK UP*/
  
  $msg='Insert Data.....';
  $redirectUrlPrint=ADMIN_URL.'discharge_summary_from_print.php?discharge_id='.$discharge_id;
  $redirectUrl=ADMIN_URL.'discharge_dashboadrd.php?msg='.$msg.'&flg='.$flg;
  echo "<script type=\"text/javascript\"> window.open('$redirectUrlPrint', '_blank'); window.location.href='$redirectUrl'; </script>";
	
}
?>
<?php include "header.php"; ?>
<style>
#span_title {
	color:#b32424;
	font-weight:bold;
	text-transform:uppercase;
	font-size:16px;
	display: list-item;
	margin-left : 1em;
}
.control-label {
	font-weight:bold;
}
th {
	font-weight:bold !important;
}
#add_more {
	font-weight:bold !important;
	font-size:16px;
	color: #eef7e9;
}
#alert_slip {
	font-weight:bold !important;
	font-size:20px;
	color: #971309;
}
</style>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
  <div class="page-head">
    <div class="container-fluid">
      <div class="page-title">
        <h1><small>Welcome to ...</small></h1>
      </div>
    </div>
  </div>
  <?php 
  $patient_registration_id = $_REQUEST['patient_registration_id']; // get id through query string
  $qry = mysqli_query($conn,"select * from `patient_registration_form` where `id`='".$patient_registration_id."'"); // select query
  $row3 = mysqli_fetch_array($qry);
  ?>
  <div class="page-content">
    <div class="container-fluid">
      <div class="row margin-top-10">
        <div class="col-md-12">
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">discharge summary form</span></div>
            </div>
            <form  action="" method="post" enctype="multipart/form-data" class="horizontal-form">
            <input type="hidden" name="discharge_id" id="discharge_id" value="" />
              <div class="form-body">
                <div class="row" style="background:#dcefff;!important; padding:9px 0px">
                  <div class="col-md-1">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="hidden" name="uhid_no_param" id="uhid_no_param" class="form-control"  placeholder="Name" value="<?php if(isset($_REQUEST['uhid_no'])){ echo $_REQUEST['uhid_no']; }?>" >
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10" style="padding-top:25px !important;">
                    <div class="form-group"> <span id="alert_slip"></span></div>
                  </div>
                </div>
                <div class="row" style="background:#dcefff; padding:9px 0px">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">UHID No.</label>
                      <input type="text" id="uhid_no"  name="uhid_no" class="form-control" placeholder="UHID No." readonly>
                      <input type="hidden" name="registration_unique_id" id="registration_unique_id" class="form-control"  placeholder="Name" >
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label class="control-label">Prefix</label>
                      <select class="form-control" name="prefix" id="prefix" onchange="gender_defualt();">
                        <?php 
								 $sql7="SELECT `id`, `prefix_name` FROM `prefix_masters`  WHERE  `del_flag`='0' ORDER BY `prefix_name` ASC";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){									 
									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['prefix_name'].'</option>';
								 }
					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Patient Name</label>
                      <input type="text" id="patient_name" value="" name="patient_name" class="form-control" placeholder="Patient Name">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Date of Birth (dd-mm-YYYY)</label>
                      <div class="input-group">
                        <input type="text" class="form-control form-control-inline date-picker" name="dob" id="dob" value=""  autocomplete="off" >
                        <span class="input-group-addon" style="padding:0 !important"><a href="javascript:void(0);"  id="calculate" class="btn btn-sm default" title="Calculate">Calculate</a></span> </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Age (+Yrs.)</label>
                      <div class="input-group">
                        <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="age"  id="age"  autocomplete="off" placeholder="Age in Years" class="form-control" value="" >
                        <span class="input-group-addon" style="padding:0 !important">Years</span></div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Gender/Sex</label>
                      <select class="form-control" name="gender" id="gender">
                        <option value="">Choose..</option>
                        <?php 
								 $sql7="SELECT `id`, `gender` FROM `gender_masters`  WHERE  `del_flag`='0' ORDER BY `id` ASC";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){									 
									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['gender'].'</option>';
								 }
					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Admission Date (dd-mm-YYYY)</label>
                      <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" id="registration_date" name="registration_date" value="" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Admission Time (h:m A))</label>
                      <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" id="registration_time" name="registration_time" value="" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Discharge Date Time (dd-mm-YYYY h:m A)</label>
                      <div class="input-group">
                          <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Discharge Date" id="discharge_date" name="discharge_date" value="">
                          <span class="input-group-addon" style="padding:0 !important; width:50% !important">
                          <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Discharge Time" name="discharge_time" id="discharge_time" value="">
                          </span></div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Phone No.(10 Digit ph no.)</label>
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="phone_no"  id="phone_no"  autocomplete="off" placeholder="Enter 10 Digit ph no." class="form-control" value="<?php echo $row_patient_infos['phone_no']; ?>" >
                    </div>
                  </div>
                 
                  <div class="col-md-12"> <span style="display:flex;justify-content: space-between;">
                    <p><strong>Main Ocular Diagnoses:</strong></p>
                    <p>Click To add One <a href="javascript:void(0)" id="add_diagnoses" class="btn"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></p>
                    </span>
                    <div class="col-md-12">
                      <table class="table table-bordered table-advance table-hover" id="tab_medication">
                        <thead>
                          <tr>
                            <th ><strong>sl</strong></th>
                            <th ><strong>Diagnoses Name</strong></th>
                            <th ><strong>EYE</strong></th>
                            <th ><strong>&nbsp;</strong></th>
                          </tr>
                        </thead>
                        <tbody id="diagnoses_tbody">
                          <?php 
								  $sl=1;
								  $sql2="SELECT * FROM `patient_discharge_diagnoses_details_table` WHERE `uhid`= '" .$_REQUEST['id']. "' and `del_flag`<>1";
								  $result2=$conn->query($sql2) ;
								  $count=$result2->num_rows;
								  if($count=='0'){
								  echo '<input type="hidden" name="count_diagnoses" id="count_diagnoses" value="'.($count+1).'">';
								?>
                          <tr id="medication<?php echo ($count+1);?>">
                            <td><?php echo ($count+1);?></td>
                            <td><input type="text" name="discharge_diagnoses_name<?php echo ($count+1);?>" id="discharge_diagnoses_name<?php echo ($count+1);?>" class="form-control" value=""/></td>
                            <td><div class="input-group">
                                <select class="form-control" name="discharge_diagnoses_eye<?php echo ($count+1);?>" id="discharge_diagnoses_eye<?php echo ($count+1);?>">
                                  <option value="">(None)</option>
                                  <option value="RIGHT EYE">RIGHT EYE</option>
                                  <option value="LEFT EYE">LEFT EYE</option>
                                  <option value="BOTH EYES">BOTH EYES</option>
                                </select>
                              </div></td>
                            <td><div class="input-group">
                                <input type="hidden" name="diagnoses_id<?php echo ($count+1);?>" id="diagnoses_id<?php echo ($count+1);?>" value="0">
                                <a href="javascript:void(0);"  id="mide_remove" class="btn btn-sm default" title="Remove" onClick="remove_diagnoses('<?php echo ($count+1);?>')"><i class="fa fa-minus"></i></a> </div></td>
                          </tr>
                          <?php }else{
									  echo '<input type="hidden" name="count_diagnoses" id="count_diagnoses" value="'.$count.'">';
									  $sl_med=1;
									  while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){  
									?>
                          <tr id="diagnoses<?php echo $sl_med;?>">
                            <td><?php echo $sl_med;?></td>
                            <td><input type="text" name="discharge_diagnoses_name<?php echo $sl_med;?>" id="discharge_diagnoses_name<?php echo $sl_med;?>" class="form-control" value="<?php echo $row2['discharge_diagnoses_name'];?>"/></td>
                            <td><div class="input-group">
                                <select class="form-control" name="discharge_diagnoses_eye<?php echo $sl_med;?>" id="discharge_diagnoses_eye<?php echo $sl_med;?>">
                                  <option value="">(None)</option>
                                  <option value="RIGHT EYE" <?php if($row2['discharge_diagnoses_eye']=='RIGHT EYE') echo 'selected'; ?>>RIGHT EYE</option>
                                  <option value="LEFT EYE" <?php if($row2['discharge_diagnoses_eye']=='LEFT EYE') echo 'selected'; ?>>LEFT EYE</option>
                                  <option value="BOTH EYES" <?php if($row2['discharge_diagnoses_eye']=='BOTH EYE') echo 'selected'; ?>>BOTH EYES</option>
                                </select>
                              </div></td>
                            <td><input type="hidden" name="diagnoses_id<?php echo $sl_med?>" id="diagnoses_id<?php echo $sl_med?>" value="<?php echo $row2['id'];?>">
                              <div class="input-group"> <a href="javascript:void(0);"  id="mide_remove" class="btn btn-sm default" title="Remove" onClick="remove_diagnoses('<?php echo $sl_med;?>')"><i class="fa fa-minus"></i></a> </div></td>
                          </tr>
                          <?php  $sl_med++;}}?>
                        </tbody>
                      </table>
                      <input type="hidden" name="deleted_diagnoses" id="deleted_diagnoses" value="" />
                    </div>
                    <div class="col-md-12">
                      <div class="input-group"> <span class="input-group-addon">Procedure</span>
                        <!--<input type="text" name="procedure" id="procedure" class="form-control" value="" placeholder="Enter Procedure"/>-->
                        <textarea name="procedure" id="procedure" class="form-control" value="" placeholder="Enter Procedure"></textarea>
                        <span class="input-group-addon">In the</span>
                        <input type="text" name="procedure_eye" id="procedure_eye" class="form-control" value="" placeholder="Enter Eye"/>
                        <span class="input-group-addon"> under</span>
                        <input type="text" name="procedure_type" id="procedure_type" class="form-control" value="" placeholder="Enter Type"/>
                        <span class="input-group-addon">anaesthesia on</span>
                        <input type="text" name="anaesthesia_date" id="anaesthesia_date" class="form-control form-control-inline date-picker" value="" placeholder="Enter Date"/>
                      </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px;">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Admitting Doctor</label>
                          <select name="admiting_doctor" id="admiting_doctor" class="form-control select2" >
                            <option value="">Choose Doctor</option>
                            <?php 
								 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'  ";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){
									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';
								 }
					 			?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Anaesthetist</label>
                          <input type="text" name="anaesthetst_doctor" id="anaesthetst_doctor" class="form-control" value="" placeholder="Enter Anaesthetist" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <p style="float:right;">Click To add One <a href="javascript:void(0)" id="add_anaesthetst" class="btn"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></p>
                        <div class="form-group">
                          <table class="table table-bordered table-advance table-hover" id="tab_anaesthetst">
                            <thead>
                              <tr>
                                <td style="text-align:center;font-weight:bold;color:black;">SL</td>
                                <td style="text-align:center;font-weight:bold;color:black;">Assistant</td>
                                <td>&nbsp;</td>
                              </tr>
                            </thead>
                            <tbody id="anaesthetst_tbody">
                              <?php 
								  $sl=1;
								  $sql2="SELECT * FROM `patient_discharge_anaesthetst_assistent_details` WHERE `uhid`= '" .$_REQUEST['id']. "' and `del_flag`<>1";
								  $result2=$conn->query($sql2) ;
								  $count=$result2->num_rows;
								  if($count=='0'){
								  echo '<input type="hidden" name="count_anaesthetst" id="count_anaesthetst" value="'.($count+1).'">';
								?>
                              <tr id="anaesthetst<?php echo ($count+1);?>">
                                <td><?php echo ($count+1);?></td>
                                <td><input type="text" name="anaesthetst_assistent<?php echo ($count+1);?>" id="anaesthetst_assistent<?php echo ($count+1);?>" class="form-control" value=""/></td>
                                <td><div class="input-group">
                                    <input type="hidden" name="anaesthetst_id<?php echo ($count+1);?>" id="anaesthetst_id<?php echo ($count+1);?>" value="0">
                                    <a href="javascript:void(0);"  id="mide_remove" class="btn btn-sm default" title="Remove" onClick="remove_anaesthetst('<?php echo ($count+1);?>')"><i class="fa fa-minus"></i></a> </div></td>
                              </tr>
                              <?php }else{
									  echo '<input type="hidden" name="count_anaesthetst" id="count_anaesthetst" value="'.$count.'">';
									  $sl_med=1;
									  while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){  
									?>
                              <tr id="diagnoses<?php echo $sl_med;?>">
                                <td><?php echo $sl_med;?></td>
                                <td><input type="text" name="anaesthetst_assistent<?php echo $sl_med;?>" id="anaesthetst_assistent<?php echo $sl_med;?>" class="form-control" value="<?php echo $row2['anaesthetst_assistent'];?>"/></td>
                                <td><input type="hidden" name="anaesthetst_id<?php echo $sl_med?>" id="anaesthetst_id<?php echo $sl_med?>" value="<?php echo $row2['id'];?>">
                                  <div class="input-group"> <a href="javascript:void(0);"  id="mide_remove" class="btn btn-sm default" title="Remove" onClick="remove_anaesthetst('<?php echo $sl_med;?>')"><i class="fa fa-minus"></i></a> </div></td>
                              </tr>
                              <?php  $sl_med++;}}?>
                            </tbody>
                          </table>
                          <input type="hidden" name="deleted_anaesthetst_assistent" id="deleted_anaesthetst_assistent" value="" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <p> <strong>Medications</strong>
                        <select name="medication_dropdown" id="medication_dropdown" class="form-control" onchange="load_medication_tamplate(this.value);">
                          <option value=""> Choose Name </option>
                          <?php                
							 $sql7="select * from `disease_template_masters_for_emr` Where `name`<>'' ORDER BY `name` ";
							 $result7=$conn->query($sql7) ;
							 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){								 
							  echo '<option value="'.$row7['id'].'" '; echo '>'.$row7['name'].'</option>';			
							 }
							?>
                        </select>
                      </p>
                      <textarea id="medication_editor" name="medication_editor" class="form-control ckeditor" placeholder="Enter text"></textarea>
                    </div>
                    <div class="col-md-12"  style="margin-top:12px;">
                      <p><strong>FOLLOW UP</strong></p>
                      <div class="input-group"> <span class="input-group-addon">Next post-op check-up:</span>
                        <input type="text" name="next_postop_chkup" id="next_postop_chkup" class="form-control" value="" placeholder="Enter Date"/>
                        <span class="input-group-addon">at</span>
                        <input type="text" name="next_postop_chkup_time" id="next_postop_chkup_time" class="form-control" value="" placeholder="Enter Time"/>
                        <span class="input-group-addon">Final post-op check-up:</span>
                        <input type="text" name="final_postop_chkup" id="final_postop_chkup" class="form-control" value="" placeholder="Enter Date"/>
                        <span class="input-group-addon">Contact No:</span>
                        <input type="text" name="query_contact_number" id="query_contact_number" class="form-control" value="" placeholder="Enter Contact No."/>
                      </div>
                      <div class="col-md-12">
                        <p style="float:right;">Click To add One <a href="javascript:void(0)" id="add_post_up_chkup" class="btn"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></p>
                        <div class="form-group">
                          <table class="table table-bordered table-advance table-hover" id="tab_post_up_chkup">
                            <thead>
                              <tr>
                                <td style="text-align:center;font-weight:bold;color:black;">SL</td>
                                <td style="text-align:center;font-weight:bold;color:black;">Post OP CHECK UP</td>
                                <td>&nbsp;</td>
                              </tr>
                            </thead>
                            <tbody id="post_up_chkup_tbody">
                              <?php 
								  $sl=1;
								  $sql2="SELECT * FROM `patient_discharge_post_up_chkup_details` WHERE `uhid`= '" .$_REQUEST['id']. "' and `del_flag`<>1";
								  $result2=$conn->query($sql2) ;
								  $count=$result2->num_rows;
								  if($count=='0'){
								  echo '<input type="hidden" name="count_post_up_chkup" id="count_post_up_chkup" value="'.($count+1).'">';
								?>
                              <tr id="post_up_chkup<?php echo ($count+1);?>">
                                <td><?php echo ($count+1);?></td>
                                <td><textarea name="post_up_chk_up_advice<?php echo ($count+1);?>" id="post_up_chk_up_advice<?php echo ($count+1);?>" class="form-control"></textarea></td>
                                <td><div class="input-group">
                                    <input type="hidden" name="post_up_chkup_id<?php echo ($count+1);?>" id="post_up_chkup_id<?php echo ($count+1);?>" value="0">
                                    <a href="javascript:void(0);"  id="mide_remove" class="btn btn-sm default" title="Remove" onClick="remove_post_up_chkup('<?php echo ($count+1);?>')"><i class="fa fa-minus"></i></a> </div></td>
                              </tr>
                              <?php }else{
									  echo '<input type="hidden" name="count_post_up_chkup" id="count_post_up_chkup" value="'.$count.'">';
									  $sl_med=1;
									  while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){  
									?>
                              <tr id="post_up_chkup<?php echo $sl_med;?>">
                                <td><?php echo $sl_med;?></td>
                                <td><textarea name="post_up_chk_up_advice<?php echo $sl_med;?>" id="post_up_chk_up_advice<?php echo $sl_med?>" class="form-control"></textarea></td>
                                <td><input type="hidden" name="post_up_chkup_id<?php echo $sl_med?>" id="post_up_chkup_id<?php echo $sl_med?>" value="<?php echo $row2['id'];?>">
                                  <div class="input-group"> <a href="javascript:void(0);"  id="mide_remove" class="btn btn-sm default" title="Remove" onClick="remove_post_up_chkup('<?php echo $sl_med;?>')"><i class="fa fa-minus"></i></a> </div></td>
                              </tr>
                              <?php  $sl_med++;}}?>
                            </tbody>
                          </table>
                          <input type="hidden" name="deleted_post_up_chkup" id="deleted_post_up_chkup" value="" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <p style="padding:12px 0 2px 0; text-align:center;backgroung:#fff">
                  <button type="submit" name="submit" id="submit" class="btn blue">Submit</button>
                  <button type="button" name="reset" id="reset" class="btn red" onClick="reset_forms_val();" >Reload</button>
                </p>
              </div>
            </form>
            
            <!-- </div> --> 
            
          </div>
          
          <!-- END PAGE CONTENT --> 
          
        </div>
      </div>
    </div>
    
    <!-- END PAGE CONTENT INNER --> 
    
  </div>
</div>

<!-- END PAGE CONTENT --> 

<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript"> 

$(document).ready( function() {  

	$("#admiting_doctor").select2();
	$("#mrd_check").select2();
	
   $("#registration_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
   var d_time=$("#registration_time").val();

	if(d_time!=''){

	$("#registration_time").timepicker({

		timeFormat: 'h:mm p'

	});	

	}else{

	$("#registration_time").timepicker({

		timeFormat: 'h:mm p'

	}).val('');	

	}
   
    $("#next_postop_chkup").datepicker({
	   format: 'dd-mm-yyyy'
   });
    $("#final_postop_chkup").datepicker({
	   format: 'dd-mm-yyyy'
   });
  
   var d_time_=$("#next_postop_chkup_time").val();

	if(d_time_!=''){

	$("#next_postop_chkup_time").timepicker({

		timeFormat: 'h:mm p'

	});	

	}else{

	$("#next_postop_chkup_time").timepicker({

		timeFormat: 'h:mm p'

	}).val('');	

	}
    $("#discharge_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
     var di_time_=$("#discharge_time").val();

	if(di_time_!=''){

	$("#discharge_time").timepicker({

		timeFormat: 'h:mm p'

	});	

	}else{

	$("#discharge_time").timepicker({

		timeFormat: 'h:mm p'

	}).val('');	

	}
	$("#dob").datepicker({
	   format: 'dd-mm-yyyy'
   });
   $("#anaesthesia_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
	
	$("#district").select2();

	$("#doctor_id").select2();
	<?php if(isset($_REQUEST['uhid_no'])){ ?>
	var uhid_no_param=$("#uhid_no_param").val();
	mrd_check_ajax();
	<?php } ?>
	$("#calculate").click(function(){

			var dob = $("#dob").val();

			$.ajax({

							type : "POST",

							url : "<?php echo ADMIN_URL; ?>ajax/age_change_ajax.php",

							dataType : "json", 

							data : "dob="+dob,

							success : function(data) {	

									$("#age").val(data.age);

							}

				});

		});
	$("#doctor_id").click(function() {

		$("#doctor_id").removeAttr("readonly");

		$("#reffered_other_doc").prop('readonly', true);

	});
	$("#reffered_other_doc").click(function() {

		$("#reffered_other_doc").prop('readonly', false);

		$("#doctor_id").attr('readonly', 'readonly');

	});
	$("#doctor_id").change(function() {

		$("#reffered_other_doc").val("");

		$("#reffered_other_doc").prop('readonly', true);

	});
	$("#reffered_other_doc").keyup(function() {

		if($("#reffered_other_doc").val()!=''){

			//$("#doctor_id").val("");

			$("#doctor_id").select2("val", "");		

		}

		$("#doctor_id").attr('readonly', 'readonly');

	});
	$("#add_diagnoses").on('click',function(){ 
	 var i=$("#count_diagnoses").val();
	 i=parseInt(i)+1;
	 $("#count_diagnoses").val(i);
	 $("#diagnoses_tbody").append('<tr id="diagnoses'+i+'"><td>'+i+'</td><td><input type="text" name="discharge_diagnoses_name'+i+'" id="discharge_diagnoses_name'+i+'" class="form-control" value=""/></td><td><div class="input-group"><select class="form-control" name="discharge_diagnoses_eye'+i+'" id="discharge_diagnoses_eye'+i+'">  <option value="">(None)</option>  <option value="RIGHT EYE">RIGHT EYE</option><option value="LEFT EYE">LEFT EYE</option><option value="BOTH EYES">BOTH EYES</option></select>  </div></td><td><div class="input-group"><input type="hidden" name="diagnoses_id'+i+'" id="diagnoses_id'+i+'" value="0"><a href="javascript:void(0);"  id="mide_remove" class="btn btn-sm default" title="Remove" onClick="remove_diagnoses('+i+')"><i class="fa fa-minus"></i></a> </div></td></tr>'); 
	});
	$("#add_anaesthetst").on('click',function(){ 
	 var i=$("#count_anaesthetst").val();
	 i=parseInt(i)+1;
	 $("#count_anaesthetst").val(i);
	 $("#anaesthetst_tbody").append('<tr id="anaesthetst'+i+'"><td>'+i+'</td><td><input type="text" name="anaesthetst_assistent'+i+'" id="anaesthetst_assistent'+i+'" class="form-control" value=""/></td><td><div class="input-group"><input type="hidden" name="anaesthetst_id'+i+'" id="anaesthetst_id'+i+'" value="0"><a href="javascript:void(0);"  id="mide_remove" class="btn btn-sm default" title="Remove" onClick="remove_anaesthetst('+i+')"><i class="fa fa-minus"></i></a> </div></td></tr>'); 
	});
	$("#add_post_up_chkup").on('click',function(){ 
	 var i=$("#count_post_up_chkup").val();
	 i=parseInt(i)+1;
	 $("#count_post_up_chkup").val(i);
	 $("#post_up_chkup_tbody").append('<tr id="post_up_chkup'+i+'"><td>'+i+'</td><td><textarea name="post_up_chk_up_advice'+i+'" id="post_up_chk_up_advice'+i+'" class="form-control"></textarea></td><td><div class="input-group"><input type="hidden" name="post_up_chkup_id'+i+'" id="post_up_chkup_id'+i+'" value="0"><a href="javascript:void(0);"  id="mide_remove" class="btn btn-sm default" title="Remove" onClick="remove_post_up_chkup('+i+')"><i class="fa fa-minus"></i></a> </div></td></tr>'); 
	});
});
function remove_diagnoses(sl){
		//alert(sl);
			var med_row_id=$('#diagnoses_id'+sl).val();
			var remove_id_for_current_medication=$("#deleted_diagnoses").val();
			var values_current_medication=remove_id_for_current_medication+med_row_id+":";
			$("#deleted_diagnoses").val(values_current_medication);
			$('#diagnoses'+sl).remove();
			/* var i=$("#count_medication").val();
			 i=parseInt(i)-1;
			 $("#count_medication").val(i);*/
}function remove_anaesthetst(sl){
		//alert(sl);
			var med_row_id=$('#anaesthetst_id'+sl).val();
			var remove_id_for_current_medication=$("#deleted_anaesthetst_assistent").val();
			var values_current_medication=remove_id_for_current_medication+med_row_id+":";
			$("#deleted_anaesthetst_assistent").val(values_current_medication);
			$('#anaesthetst'+sl).remove();
			/* var i=$("#count_medication").val();
			 i=parseInt(i)-1;
			 $("#count_medication").val(i);*/
}function remove_post_up_chkup(sl){
		//alert(sl);
			var med_row_id=$('#post_up_chkup_id'+sl).val();
			var remove_id_for_current_medication=$("#deleted_post_up_chkup").val();
			var values_current_medication=remove_id_for_current_medication+med_row_id+":";
			$("#deleted_post_up_chkup").val(values_current_medication);
			$('#post_up_chkup'+sl).remove();
			/* var i=$("#count_medication").val();
			 i=parseInt(i)-1;
			 $("#count_medication").val(i);*/
}
function mrd_check_ajax(){	
	var id=$("#uhid_no_param").val();
	$.ajax({
		  type : "POST",
		  url : "<?php echo ADMIN_URL; ?>ajax/follow_up_fetch_ajax.php",
		  dataType : "json", 
		  data : "id="+id,
		  success : function(data) {					 
				  $("#uhid_no").val(data.uhid_no);	
				  $("#patient_name").val(data.patient_name);										 
				  $("#registration_unique_id").val(data.id);
				  $("#prefix").val(data.prefix);
				  $("#admiting_doctor").select2("val", data.admiting_doctor);
				  $("#dob").val(data.dob);
				  $("#age").val(data.age);
				  $("#gender").val(data.gender);
				  $("#phone_no").val(data.phone_no);
				  $("#alternate_phone_no").val(data.alternate_phone_no);
				  $("#address").val(data.address);
				  
				  if(data.dob!=''){
					  $("#calculate"). click();
				  }
				 
		  }
	  });
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
function load_medication_tamplate(id){
		//alert(id);
		$.ajax({
				type : "POST",
				url : "<?php echo ADMIN_URL; ?>ajax/medications_template_masters_ajax_for_emr.php",
				dataType : "json", 
				data : "id="+id,
				success : function(data) {
					CKEDITOR.instances['medication_editor'].setData(data.template_html);
				//CKEDITOR.instances["medication_editor"].setData(data.template_html);	
				}
			});
}
</script>
<?php include "footer.php" ?>
