<?php

include "conn.php"; // Using database connection file here



if(isset($_POST['submit'])) // when click on Update button

{

  $uhid_no = mysqli_real_escape_string($conn,$_POST['uhid_no']);

  $prefix = mysqli_real_escape_string($conn,$_POST['prefix']);

  
  $fname_text=mysqli_real_escape_string($conn,$_REQUEST['patient_name']);
  $patient_name = ucwords(strtolower($fname_text));

  $admiting_doctor = mysqli_real_escape_string($conn,$_POST['admiting_doctor']);

  $registration_unique_id = mysqli_real_escape_string($conn,$_POST['registration_unique_id']);

	$patient_payment_status = mysqli_real_escape_string($conn,$_POST['patient_payment_status']);

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

	

	$today=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	$today_date=date('Y-m-d');

	

	$sl_sql = "SELECT `sl` FROM `patient_slip_generate_form` WHERE date(`registration_date`) = '".$today_date."' and `admiting_doctor` = '".$admiting_doctor."' AND `del_flag`='0'	ORDER BY `id` DESC LIMIT 1 ";

	$sl_sql_run = mysqli_query($conn,$sl_sql);

	$row_sl = $sl_sql_run->fetch_assoc();

	$count=$sl_sql_run->num_rows;

	if( $count>0){

	if($row_sl){

	$sl_no = $row_sl['sl'] + 1;	

	}

	}else{

	  $sl_no=1;

	}

	

	if($_REQUEST['dob']==''){

	$dob='NULL';

	}else{

		$dob= "'".date("Y-m-d", strtotime($_POST['dob']))."'";

	}

	

	$age = mysqli_real_escape_string($conn,$_POST['age']);

	$gender = mysqli_real_escape_string($conn,$_POST['gender']);

	$phone_no = mysqli_real_escape_string($conn,$_POST['phone_no']);

	$email_id = mysqli_real_escape_string($conn,$_POST['email_id']);

	$alternate_phone_no = mysqli_real_escape_string($conn,$_POST['alternate_phone_no']);

	$address = mysqli_real_escape_string($conn,$_POST['address']);

	$zip_code = mysqli_real_escape_string($conn,$_POST['zip_code']);

	$district = mysqli_real_escape_string($conn,$_POST['district']);

	$location2=mysqli_real_escape_string($conn,$_REQUEST['location2']);

	$purpose_visit_id=mysqli_real_escape_string($conn,$_REQUEST['purpose_visit_id']);

	if($purpose_visit_id==''){

		$purpose_visit_id=0;

	}

	$doctor_id=mysqli_real_escape_string($conn,$_REQUEST['doctor_id']);

	$reffered_other_doc=mysqli_real_escape_string($conn,$_REQUEST['reffered_other_doc']);

  

	

  $edit = mysqli_query($conn,"INSERT INTO `patient_slip_generate_form` SET  `uhid_no`='".$uhid_no."', `prefix`='".$prefix."', `patient_name`='".$patient_name."', `registration_date`=".$registration_date.", `registration_time`=".$registration_time.", `admiting_doctor`='".$admiting_doctor."', `created_on`='".$today."' , `created_by`='".$created_by."', `registration_unique_id`='".$registration_unique_id."', `sl`='".$sl_no."', `age`='".$age."', `gender`='".$gender."', `phone_no`='".$phone_no."', `email_id`='".$email_id."',`alternate_phone_no`='".$alternate_phone_no."', `address`='".$address."', `zip_code`='".$zip_code."', `district`='".$district."',`dob`=".$dob." , `location2`='".$location2."', `purpose_visit_id`='".$purpose_visit_id."' , `doctor_id`='".$doctor_id."', `reffered_other_doc`='".$reffered_other_doc."', `patient_payment_status`='".$patient_payment_status."' ");

    if($edit)

    {

		$i_id = $conn->insert_id;

		

		$temp_name=explode(" ",$patient_name);

		//$fn=(count($temp_name)>2) ? $temp_name[0]." ".$temp_name[1] : $temp_name[0];	

		$total_cnt=(count($temp_name));

		$fname=$temp_name[0];

		$lname="";

		for($ni=1;$ni<$total_cnt;$ni++){

			$lname=$lname.' '.$temp_name[$ni];

		}

		//,`EOM`='Full, free and painless ',`EOM_left`='Full, free and painless ',`pupils`='Round Reacting To Light',`pupils_left`='Round Reacting To Light',`lid_adnexa`='WNL',`lid_adnexa_left`='WNL',`conjunctiva`='WNL',`conjunctiva_left`='WNL'

		$sql19 = $conn->query("INSERT INTO `prescription_details_for_emr` SET `mrd_no`='".$uhid_no."',`primary_doctor`='".$admiting_doctor."', `purpose_visit_id` = '".$purpose_visit_id."',`prefix` ='".$prefix."',`fname`='".$fname."',`lname`='".$lname."',`mobile`='".$phone_no."',`email`='".$email_id."',`address`='".$address."',`temp_save`='0',`ocular_block`='1',`created_on`='".$today."', `dob` = ".$dob.", `age` = '".$age."', `pin` = '".$zip_code."' ,`slip_id`='".$i_id."',`patient_registration_id`='".$registration_unique_id."' , `created_by`='".$created_by."',`medication_block`='1' , `location2`='".$location2."' , `doctor_id`='".$doctor_id."', `reffered_other_doc`='".$reffered_other_doc."',`EOM`='Full, free and painless',`EOM_left`='Full, free and painless',`pupils`='Round Reacting To Light',`pupils_left`='Round Reacting To Light',`lid_adnexa`='WNL',`lid_adnexa_left`='WNL',`nextvisit_block`='0',`conjunctiva`='WNL',`conjunctiva_left`='WNL',`eom_checkbox_check`='1',`lid_checkbox_check`='1',`conjunctiva_checkbox_check`='1',`pupils_checkbox_check`='1',`anterior_figure`='1'");
		
		

        $msg="Record updated successfully";

        $flg=0;
		
		$redirectUrlPrint=ADMIN_URL.'print_token.php?id='.$i_id;

			 $redirectUrl=ADMIN_URL.'view_registration_form.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\">window.open('$redirectUrlPrint', '_blank');   window.location.href='$redirectUrl'; </script>";	

       

    }

    else

    {

        // echo mysqli_error();

        $flg=1;

        $msg="Error:".$sql."<br>".$conn->error;

        $redirectUrl=ADMIN_URL.'slip_generate_form_add.php?msg='.$msg.'&flg='.$flg;

        echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

    }     

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
#patient_name {
	text-transform: capitalize;
}
</style>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container"> 
  
  <!-- BEGIN PAGE HEAD -->
  
  <div class="page-head">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE TITLE -->
      
      <div class="page-title">
        <h1><small>Welcome to ...</small></h1>
      </div>
      
      <!-- END PAGE TITLE --> 
      
    </div>
  </div>
  
  <!-- END PAGE HEAD --> 
  
  <!-- BEGIN PAGE CONTENT -->
  
  <div class="page-content">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE BREADCRUMB --> 
      
      <!--<ul class="page-breadcrumb breadcrumb">

        <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>

        <li class="active"> Dashboard </li>

      </ul> --> 
      
      <!-- END PAGE BREADCRUMB --> 
      
      <!-- BEGIN PAGE CONTENT INNER -->
      
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Patient Slip Generation</span></div>
            </div>
            <form  action="" method="post" enctype="multipart/form-data" class="horizontal-form">
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
                  
                  <!--/span-->
                  
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">UHID No.</label>
                      <input type="text" id="uhid_no"  name="uhid_no" class="form-control" placeholder="UHID No." readonly>
                      <input type="hidden" name="registration_unique_id" id="registration_unique_id" class="form-control"  placeholder="Name" >
                    </div>
                  </div>
                  
                  <!--/span-->
                  
                  <div class="col-md-1">
                    <div class="form-group">
                      <label class="control-label">Prefix</label>
                      <select class="form-control" name="prefix" id="prefix" onchange="gender_defualt();">
                        <?php 

								  $sql7="SELECT `id`, `prefix_name` FROM `prefix_masters`  WHERE  `del_flag`='0' ORDER BY `prefix_name` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['prefix_name'].'</option>';

								 }

					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Patient Name</label>
                      <input type="text" id="patient_name" value="" name="patient_name" class="form-control" placeholder="Patient Name"  onblur="case_convrt('patient_name')">
                    </div>
                  </div>
                  
                  <!--/span-->
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Slip Generate Date (dd-mm-YYYY)</label>
                      <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" id="registration_date" name="registration_date" value="<?php echo date("d-m-Y");  ?>" readonly />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Slip Generate Time (h:m A)(12 Hours Format)</label>
                      <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Admitting Time" name="registration_time" id="registration_time" value="<?php echo date("h:i A"); ?>" readonly />
                    </div>
                  </div>
                  <div class="col-md-12">&nbsp; <br>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Date of Birth (dd-mm-YYYY)</label>
                      <div class="input-group">
                        <input type="text" class="form-control form-control-inline date-picker" name="dob" id="dob" value=""  autocomplete="off">
                        <span class="input-group-addon" style="padding:0 !important"><a href="javascript:void(0);"  id="calculate" class="btn btn-sm blue" title="Calculate">Calculate</a></span> </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Age (+Yrs.)</label>
                      <div class="input-group">
                        <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="age"  id="age"  autocomplete="off" placeholder="Age in Years" class="form-control" value="" >
                        <span class="input-group-addon" style="padding:0 !important"><a href="javascript:void(0);"  id="calculate_dob" class="btn btn-sm blue" title="Calculate" onclick="dob_calculate();">Calculate DOB</a></span></div>
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

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['gender'].'</option>';

								 }

					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Phone No.(10 Digit ph no.)</label>
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'');mobile_check();" onblur="mobile_check();" name="phone_no"  id="phone_no"  autocomplete="off" placeholder="Enter 10 Digit ph no." class="form-control" value="" >
                      <span id="error_mobie" style="color: red;font-weight:bold;"></span> </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Email ID</label>
                      <input type="email" name="email_id"  id="email_id"  autocomplete="off" placeholder="Enter Email ID" class="form-control" value="" >
                      <!--onBlur="IsEmail(this.value);" --> 
                      
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Alternate Ph. No.(10 Digit)</label>
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="alternate_phone_no"  id="alternate_phone_no"  autocomplete="off" placeholder="Enter 10 Digit ph no." class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">&nbsp; <br>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Address</label>
                      <textarea id="address" name="address" class="form-control" placeholder="Full Address with Vill./Ward No." rows="3"></textarea>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">ZIP Code</label>
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="zip_code"  id="zip_code"  autocomplete="off" placeholder="Enter zip code" class="form-control" onBlur="getstate(this.value);" >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">LOCATION ACCORDING TO YOUR PIN CODE</label>
                      <select name="location2" id="location2" class="form-control">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">District</label>
                      <select name="district" id="district" class="form-control select2">
                        <option value="">Choose..</option>
                        <?php 

								  $sql7="SELECT `id`, `district_name` FROM `district_masters`  WHERE  `del_flag`='0' ORDER BY `district_name` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" '; echo '>'.$row7['district_name'].'</option>';

								 }

					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Purpose of visit</label>
                      <select  name="purpose_visit_id" id="purpose_visit_id" class="form-control" >
                        <option value="0">None</option>
                        <?php 



								 $sql7="select * from `purposevisit_masters_for_emr`  WHERE `del_flag`='0' order by `purpose_visit` asc";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {	

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['purpose_visit'].'</option>';



								 }

					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">&nbsp; <br>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Payment Status</label>
                      <select  name="patient_payment_status" id="patient_payment_status" class="form-control" >
                        <option value="0">None</option>
                        <?php 



								 $sql7="select * from `patient_payment_status_masters`  WHERE `del_flag`='0' order by `payment_status` asc";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {	

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['payment_status'].'</option>';



								 }

					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Referred by: </label>
                      <select class=" form-control select2" name="doctor_id" id="doctor_id"  >
                        <option value="">None</option>
                        <?php 



								 $sql7="select * from `doctor_masters_for_emr`  WHERE `del_flag`='0' order by `doctor_name` asc";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['doctor_name'].'</option>';



								 }

					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">&nbsp; </label>
                      <input type="text" id="reffered_other_doc" name="reffered_other_doc" value="<?php echo $row['reffered_other_doc']; ?>" class="form-control" placeholder="Referred By Other">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Attending Doctor </label>
                      <select name="admiting_doctor" id="admiting_doctor" class="form-control select2" >
                        <option value="">Choose Doctor</option>
                        <?php 



								 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'  ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';



								 }



					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                </div>
                <p style="padding:12px 0 2px 0; text-align:center;backgroung:#fff">
                  <button type="button" name="register" id="register" class="btn blue"  >Submit</button>
                  <button type="submit" name="submit" id="submit" class="btn blue" style="display:none;" disabled>Submit</button>
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

	

	 $("#dob").datepicker({

		format: 'dd-mm-yyyy'

	});

	$("#district").select2();

	$("#doctor_id").select2();
	<?php if(isset($_REQUEST['uhid_no'])){ ?>
var uhid_no_param=$("#uhid_no_param").val();
mrd_check_ajax();
<?php } ?>


	

	 $("#register").click(function(){ 

			 var submit_flag=0;

			 			 

			if($("#uhid_no").val()=="" ){

				alert("Please fill up patients details");

				$("#uhid_no").css( "border-width", "2px" );

				$("#uhid_no").css( "border-color", "red" );

				$("#uhid_no").focus();

				submit_flag=1;

			}

			

			if($("#patient_name").val()=="" ){

				alert("Please fill up patients details");

				$("#patient_name").css( "border-width", "2px" );

				$("#patient_name").css( "border-color", "red" );

				$("#patient_name").focus();

				submit_flag=1;

			}

			if($("#admiting_doctor").val()=="" ){

				alert("Please select doctor");

				$("#admiting_doctor").css( "border-width", "2px" );

				$("#admiting_doctor").css( "border-color", "red" );

				$("#admiting_doctor").focus();

				submit_flag=1;

			}

			if($("#purpose_visit_id").val()=="" ){

				alert("Please select Purpose Of Visit");

				$("#purpose_visit_id").css( "border-width", "2px" );

				$("#purpose_visit_id").css( "border-color", "red" );

				$("#purpose_visit_id").focus();

				submit_flag=1;

			}
			if($("#prefix").val()=="" ){

				alert("Please select prefix...");				

				submit_flag=1;

			}
			if ($("#prefix").val() == null) {
				alert("Please select prefix...");				

				submit_flag=1;
			}
			
			var mob_flag=mobile_check();
			//alert(mob_flag);
			//return false;
			if(mob_flag=='1'){
				alert('Please check phone no.');
				submit_flag=1;
			}


			var message_var="";

			if(submit_flag==0)

			{

				//alert("success");

				message_var=' For '+$("#patient_name").val()+'('+$("#uhid_no").val()+' ) Under ' +$("#admiting_doctor option:selected").text() ;

				slip_generate_or_not($("#uhid_no").val());

				if (confirm('Are You Sure To Slip Generate'+message_var)) {

   					 alert('Thanks for confirming');

					 $("#submit").prop( "disabled", false );

					 $("#submit"). click();

				} else {

					alert('Why did you press cancel? You should have confirmed');

				}

				

			}

	});

	

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

	 

});

       



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
										case_convrt('patient_name');									 

										$("#registration_unique_id").val(data.id);

										$("#prefix").val(data.prefix);

										$("#admiting_doctor").select2("val", data.admiting_doctor);

										$("#dob").val(data.dob);

										$("#age").val(data.age);

										$("#gender").val(data.gender);

										$("#phone_no").val(data.phone_no);
										mobile_check();
										$("#alternate_phone_no").val(data.alternate_phone_no);

										$("#address").val(data.address);

										$("#zip_code").val(data.zip_code);

										$("#district").select2("val", data.district);
										
										$("#doctor_id").select2("val", data.doctor_id);
										$("#reffered_other_doc").val(data.reffered_other_doc);
										/*if(data.doctor_id!=''){
											$("#reffered_other_doc").val("");
											$("#doctor_id").removeAttr("readonly");
											$("#reffered_other_doc").prop('readonly', true);											
										}
										
										if(data.reffered_other_doc!=''){
											$("#doctor_id").val("");
											$("#reffered_other_doc").removeAttr("readonly");
											$("#doctor_id").attr('readonly', 'readonly');										
										}*/
										

										if(data.dob!=''){

											$("#calculate"). click();

										}

										if(data.zip_code!=''){

											getstate(data.zip_code);

										}

										if(data.uhid_no!=''){

											slip_generate_or_not(data.uhid_no);

										}

								}

							});

						

					

	

}

function slip_generate_or_not(uhid_no){

	var registration_date=$("#registration_date").val();

	var admiting_doctor=$("#admiting_doctor").val();
	$("#alert_slip").html('');
	

	$.ajax({

			type : "POST",

			url : "<?php echo ADMIN_URL; ?>ajax/slip_sl_check_ajax.php",

			dataType : "json", 

			data : "uhid_no="+uhid_no+"&admiting_doctor="+admiting_doctor+"&registration_date="+registration_date,

			success : function(data) {
				

					if(data.flag=='1'){

						//alert("Slip Already Generated!!!")

						message_var=' For '+$("#patient_name").val()+'('+$("#uhid_no").val()+' ) Under ' +$("#admiting_doctor option:selected").text() ;
						
						$("#alert_slip").html('Slip Already Generated!!! Are You Sure To Slip Generate'+message_var);

						if (confirm('Slip Already Generated!!! Are You Sure To Slip Generate'+message_var)) {

							 alert('Thanks for confirming');

							 $("#register").prop( "disabled", false );

							 $("#register").prop( "disabled", false );

							 //$("#submit"). click();

						} else {

							alert('Please Click On Reload Button');

							$("#register").prop( "disabled", true );

							 $("#register").prop( "disabled", true );

						}

					}

					

			}

		});

	

}

function getstate(value) {

	//alert(value); 

	$.ajax({

		type: 'post',

		url: "<?php echo  ADMIN_URL; ?>Pincode/getstate.php",

		data: {

			'cid': value

		},

		success: function(resultData) {

			//console.log(resultData);

			$('#location2').html(resultData);

		}

	});

}

function reset_forms_val(){

	location.reload();	

}

/*

function IsEmail(email) {

	alert(email);

        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if(!regex.test(email)) {

			alert("No");

           return false;

        }else{

			alert("yes");

           return true;

        }

}*/

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


function case_convrt(input_id){
		let inputText = $("#"+input_id).val();
		//alert(inputText);
		let properCaseText = toProperCase(inputText);
		//alert(properCaseText);
		$("#"+input_id).val(properCaseText);            
}
function toProperCase(str) {
	return str.toLowerCase().replace(/\b\w/g, function(char) {
		return char.toUpperCase();
	});
}
function mobile_check() {
	$('#error_mobie').html('');	
	var mobile = $('#phone_no').val();
    // Remove all non-digit characters
    mobile = mobile.replace(/\D/g, '');
    $('#phone_no').val(mobile); // Set only digits back
	var mob_flag=0;
    if (mobile.length > 10) {
      $('#error_mobie').html('Mobile number cannot exceed 10 digits');
	  mob_flag=1;
    }else if (mobile.length < 10) {
      $('#error_mobie').html('Mobile number cannot less than 10 digits');
	  mob_flag=1;
    } else {
      $('#error_mobie').html('');
	  mob_flag=0;
    }
	return mob_flag;
}


function dob_calculate(){
	var age = $("#age").val();
	if(age==''){
		alert('Please Enter Age');
		return false;	
	}
	$.ajax({
			type: "POST",
			url: "<?php echo ADMIN_URL; ?>ajax_for_emr/dob_change_ajax_for_emr.php",
			dataType: "json",
			data: "age=" + age,
			success: function(data) {
					$("#dob").val(data.dob);    
			}
	});     
}

</script>
<?php include "footer.php" ?>
