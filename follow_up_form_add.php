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

	

  $edit = mysqli_query($conn,"INSERT INTO `patient_follow_up_form` SET  `uhid_no`='".$uhid_no."', `prefix`='".$prefix."', `patient_name`='".$patient_name."', `registration_date`=".$registration_date.", `registration_time`=".$registration_time.", `admiting_doctor`='".$admiting_doctor."', `created_on`='".$today."' , `created_by`='".$created_by."', `registration_unique_id`='".$registration_unique_id."' ");

  

 

    if($edit)

    {

        

        $msg="Record updated successfully";

        $flg=0;

        $redirectUrl=ADMIN_URL.'view_registration_form.php?msg='.$msg.'&flg='.$flg;

        echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

    }

    else

    {

        // echo mysqli_error();

        $flg=1;

        $msg="Error:".$sql."<br>".$conn->error;

        $redirectUrl=ADMIN_URL.'follow_up_form_add.php?msg='.$msg.'&flg='.$flg;

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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Patient Follow Up</span></div>
            </div>
            <form  action="" method="post" enctype="multipart/form-data" class="horizontal-form">
              <div class="form-body">
                <div class="row" style="background:#dcefff;!important; padding:9px 0px">
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="hidden" name="uhid_no_param" id="uhid_no_param" class="form-control"  placeholder="Name" value="<?php if(isset($_REQUEST['uhid_no'])){ echo $_REQUEST['uhid_no']; }?>" >
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8" style="padding-top:25px !important;">
                    <div class="form-group"> </div>
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
                      <select class="form-control" name="prefix" id="prefix">
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
                      <input type="text" id="patient_name" value="" name="patient_name" class="form-control" placeholder="Patient Name" onblur="case_convrt('patient_name')" >
                    </div>
                  </div>
                  
                  <!--/span-->
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Registration Date (dd-mm-YYYY)</label>
                      <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" id="registration_date" name="registration_date" value="<?php echo date("d-m-Y");  ?>" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Registration Time (h:m A)(12 Hours Format)</label>
                      <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Admitting Time" name="registration_time" id="registration_time" value="<?php echo date("h:i A"); ?>"  />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Attending Doctor</label>
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

   

   var registration_time=$("#registration_time").val();

	if(registration_time!=''){

	$("#registration_time").timepicker({

		timeFormat: 'h:mm p'

	});		

	}else{

	$("#registration_time").timepicker({

		timeFormat: 'h:mm p'

	}).val('');	

	}

<?php if(isset($_REQUEST['uhid_no'])){ ?>
var uhid_no_param=$("#uhid_no_param").val();
mrd_check_ajax();
<?php } ?>



	 $("#register").click(function(){ 
		 	 var submit_flag=0;
			 if($("#uhid_no").val()=="" ){

				alert("Please fill up patients details");

				$("#hospital_number").css( "border-width", "2px" );

				$("#hospital_number").css( "border-color", "red" );

				$("#hospital_number").focus();

				submit_flag=1;

			}
			
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
			
			//alert(submit_flag);
			if(submit_flag==0)

			{

				//alert("success");

				$("#submit").prop( "disabled", false );

				$("#submit"). click();

				

			}
		 
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

											$("#registration_unique_id").val(data.id);

											$("#prefix").val(data.prefix);

											$("#admiting_doctor").select2("val", data.admiting_doctor);

										

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

</script>
<?php include "footer.php" ?>
