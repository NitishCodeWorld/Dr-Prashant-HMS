<?php
include "conn.php"; // Using database connection file here

$_SESSION['username']=0;

if(isset($_POST['submit'])) // when click on Update button
{
  $uhid_no = mysqli_real_escape_string($conn,$_POST['uhid_no']);
  $prefix = mysqli_real_escape_string($conn,$_POST['prefix']);  
  $fname_text=mysqli_real_escape_string($conn,$_REQUEST['patient_name']);
  $patient_name = ucwords(strtolower($fname_text));  
  $age = mysqli_real_escape_string($conn,$_POST['age']);
  $gender = mysqli_real_escape_string($conn,$_POST['gender']);
  $phone_no = mysqli_real_escape_string($conn,$_POST['phone_no']);
  $email_id = mysqli_real_escape_string($conn,$_POST['email_id']);
  $alternate_phone_no = mysqli_real_escape_string($conn,$_POST['alternate_phone_no']);
  $address = mysqli_real_escape_string($conn,$_POST['address']);
  $zip_code = mysqli_real_escape_string($conn,$_POST['zip_code']);
  $district = mysqli_real_escape_string($conn,$_POST['district']);
  $admiting_doctor = mysqli_real_escape_string($conn,$_POST['admiting_doctor']);
  $patient_type = mysqli_real_escape_string($conn,$_POST['patient_type']);
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
	if($_REQUEST['dob']==''){
		$dob='NULL';
	}else{
		$dob= "'".date("Y-m-d", strtotime($_POST['dob']))."'";
	}
	$ref_doctor_id=mysqli_real_escape_string($conn,$_POST['ref_doctor_id']); 
	$today=date('Y-m-d H:i:s');
	$created_by=0;	

  $edit = mysqli_query($conn,"INSERT INTO `patient_registration_form_by_patient` SET  `uhid_no`='".$uhid_no."', `prefix`='".$prefix."', `patient_name`='".$patient_name."', `registration_date`=".$registration_date.", `registration_time`=".$registration_time.", `age`='".$age."', `gender`='".$gender."', `phone_no`='".$phone_no."', `email_id`='".$email_id."',`alternate_phone_no`='".$alternate_phone_no."', `address`='".$address."', `zip_code`='".$zip_code."', `district`='".$district."', `admiting_doctor`='".$admiting_doctor."', `patient_type`='".$patient_type."',`dob`=".$dob." , `created_on`='".$today."' , `created_by`='".$created_by."' , `ref_doctor_id`='".$ref_doctor_id."' ");

    if($edit)
    {
        $patient_admission_id = $conn->insert_id;
        $msg="Thank you. Your record updated successfully.. If you want to register for another patient , Please scan the QR again...";
        $flg=0;
        $redirectUrl=ADMIN_URL.'registration_form_add_by_patient.php?msg='.$msg.'&flg='.$flg;
        echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
    }

    else
    {
        // echo mysqli_error();
        $flg=1;
        $msg="Error:".$sql."<br>".$conn->error;
        $redirectUrl=ADMIN_URL.'registration_form_add_by_patient.php?msg='.$msg.'&flg='.$flg;
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
.head_span {
	font-size:18px;
	font-weight:bold;
	color:red;
	padding-left:200px;
}
/*.proper_case_div {
	text-transform: capitalize !important;
}*/

.cropper-bg {
	width: 80% !important;
}
.cropper-canvas {
	width: 80% !important;
	left:-20% !important;
}
.cropper-crop-box {
	/*width: 80% !important;*/
	left:-20% !important;
}
#patient_name {
	text-transform: capitalize;
}
#alert_msg{
	font-size:18px;
	font-weight:bold;
	color:#390;
}
.pull-right{
	display:none !important;	
}
@media only screen and (min-width: 200px) and (max-width: 750px) { 
.form-control {
    display: block !important;
    width: 90% !important;
    height: 60px !important;
	
}
label {
    font-weight: bold !important;
    font-size: 25px !important;
}
.portlet.light > .portlet-title > .caption > .caption-subject {
    font-size: 22px !important;
}
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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Patient Registration (Please Fill Up the form carefully...)</span> </div>
            </div>
            <form  action="" method="post" enctype="multipart/form-data" class="horizontal-form">
              <div class="form-body">
                <div class="row" style="background:#dcefff; padding:9px 0px">
                <div class="col-md-12" ><span id="alert_msg"></span></div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Prefix <span id="old_db_pref" style="color:#F39"></span></label>
                      <select class="form-control" name="prefix" id="prefix" onchange="gender_defualt();">
                        <?php 

								  $sql7="SELECT `id`, `prefix_name` FROM `prefix_masters`  WHERE  `del_flag`='0' AND `id`='1' ORDER BY `prefix_name` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['prefix_name'].'</option>';

								 }

					 			?>
                        <?php 

								  $sql7="SELECT `id`, `prefix_name` FROM `prefix_masters`  WHERE  `del_flag`='0'  AND `id`<>'1' ORDER BY `prefix_name` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['prefix_name'].'</option>';

								 }

					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Patient Name</label>
                      <input type="hidden" id="uhid_no"  name="uhid_no" class="form-control" placeholder="UHID No." value="" readonly>
                      <input type="hidden" id="msg"  name="msg" class="form-control" placeholder="UHID No." value="<?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];} ?>" readonly>
                      <input type="text" id="patient_name" value=""  name="patient_name" class="form-control proper_case_div" onblur="case_convrt('patient_name')" placeholder="Patient Name">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Registration Date (dd-mm-YYYY)</label>
                      <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" id="registration_date" name="registration_date" value="<?php echo date("d-m-Y");  ?>" readonly/>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Registration Time (h:m A)(12 Hours Format)</label>
                      <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Admitting Time" name="registration_time" id="registration_time" value="<?php echo date("h:i A"); ?>" readonly />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Date of Birth (dd-mm-YYYY)</label>
                      <div class="input-group">
                        <input type="text" class="form-control form-control-inline date-picker" name="dob" id="dob" value=""   autocomplete="off">
                        <span class="input-group-addon" style="padding:0 !important"><a href="javascript:void(0);"  id="calculate" class="btn btn-sm blue" title="Calculate">Calculate</a></span> </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Age (+Yrs.)</label>
                      <div class="input-group">
                        <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="age"  id="age"  autocomplete="off" placeholder="Age in Years" class="form-control"value=""  >
                        <span class="input-group-addon" style="padding:0 !important"><a href="javascript:void(0);"  id="calculate_dob" class="btn btn-sm blue" title="Calculate" onclick="dob_calculate();">Calculate DOB</a></span></div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Gender/Sex</label>
                      <select class="form-control" name="gender" id="gender" >
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
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'');mobile_check();" onblur="mobile_check();" name="phone_no"  id="phone_no"  autocomplete="off" placeholder="Enter 10 Digit ph no." class="form-control" value=""  >
                      <span id="error_mobie" style="color: red;font-weight:bold;"></span> </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Email ID</label>
                      <input type="email" name="email_id"  id="email_id"  autocomplete="off" placeholder="Enter Email ID" class="form-control"value="" >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Alternate Ph. No.(10 Digit)</label>
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="alternate_phone_no"  id="alternate_phone_no"  autocomplete="off" placeholder="Enter 10 Digit ph no." class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <p>&nbsp;</p>
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
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="zip_code"  id="zip_code"  autocomplete="off" placeholder="Enter zip code" class="form-control">
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
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Attending Doctor </label>
                      <select name="admiting_doctor" id="admiting_doctor" class="form-control select2"  >
                        <option value="">Choose Doctor</option>
                        <?php 
							

								 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'  ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" '; echo '>'.$row7['name'].'</option>';



								 }



					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Patient Type</label>
                      <select name="patient_type" class="form-control" id="patient_type">
                        <?php 



                           $sql7="select * from `patient_type_master` ";



                           $result7=$conn->query($sql7) ;



                           while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



                           {                   



                             echo '<option value="'.$row7['id'].'" '; echo '>'.$row7['name'].'</option>';



                           }



                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Ref By </label>
                      <select name="ref_doctor_id" id="ref_doctor_id" class="form-control select2"  >
                        <?php 
						
							
								$sql7="SELECT * FROM `doctor_masters_for_emr` WHERE `del_flag`='0' ORDER BY `doctor_name`";					
							
								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['doctor_name'].' ('.$row7['doctor_ini'].')</option>';



								 }



					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                  <p>&nbsp;</p>
                </div>
                <p style="padding:12px 0 2px 0; text-align:center;backgroung:#fff">
                  <button type="button" name="submit_check" id="submit_check" class="btn green" >Submit</button>
                  <button type="submit" name="submit" id="submit" class="btn green" style="display:none;" >Submit</button>
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

    setTimeout('$("#alert_msg").hide()',10000);

	$("#district").select2();

	$("#admiting_doctor").select2();

	$("#ref_doctor_id").select2();

	var msg=$("#msg").val();
	if(msg!=''){
		$("#alert_msg").html(msg+'<br/>');
		$("#submit_check").prop( "disabled", true );
		$("#submit").prop( "disabled", true );
	}

   

   $("#dob").datepicker({

		format: 'dd-mm-yyyy'

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


		 $("#submit_check").click(function(){ 
		 	 var submit_flag=0;
			 
			
			if($("#patient_name").val()=="" ){

				alert("Please fill up patients details");

				$("#name").css( "border-width", "2px" );

				$("#name").css( "border-color", "red" );

				$("#name").focus();

				submit_flag=1;

			}
			
			
			if($("#admiting_doctor").val()=="" ){

				alert("Please select doctor / optom...");				

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
			
			//alert(submit_flag);
			if(submit_flag==0)

			{

				//alert("success");

				$("#submit").prop( "disabled", false );

				$("#submit"). click();

				

			}
		 
		 });
	 

});


</script> 
<script>


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

function validation_check(){
		 	 var submit_flag=0;
			 
			
			if($("#patient_name").val()=="" ){

				alert("Please fill up patients details");

				$("#name").css( "border-width", "2px" );

				$("#name").css( "border-color", "red" );

				$("#name").focus();

				submit_flag=1;

			}
			
			
			if($("#admiting_doctor").val()=="" ){

				alert("Please select doctor / optom...");				

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
			
			/*
			if(submit_flag==0)
			{
				$("#submit").prop( "disabled", false );
				$("#submit"). click();
			}	
			*/
			return submit_flag;
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
