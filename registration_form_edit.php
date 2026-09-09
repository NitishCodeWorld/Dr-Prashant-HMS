<?php

include "conn.php"; // Using database connection file here



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

	

	$kyc_countiop=mysqli_real_escape_string($conn,$_POST['kyc_countiop']);  //IOP

	$kyc_remove_id=mysqli_real_escape_string($conn,$_POST['kyc_remove_id']); 

	

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

	$appt_id=mysqli_real_escape_string($conn,$_POST['appt_id']);  

	$patient_admission_type=mysqli_real_escape_string($conn,$_POST['patient_admission_type']);

	$today=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	$patient_infos_id=mysqli_real_escape_string($conn,$_POST['patient_infos_id']);	

	 $patient_registration_id = mysqli_real_escape_string($conn,$_POST['patient_registration_id']);

	$ref_doctor_id=mysqli_real_escape_string($conn,$_POST['ref_doctor_id']); 

  $edit = mysqli_query($conn,"UPDATE `patient_registration_form` SET  `uhid_no`='".$uhid_no."', `prefix`='".$prefix."', `patient_name`='".$patient_name."', `registration_date`=".$registration_date.", `registration_time`=".$registration_time.", `age`='".$age."', `gender`='".$gender."', `phone_no`='".$phone_no."', `email_id`='".$email_id."',`alternate_phone_no`='".$alternate_phone_no."', `address`='".$address."', `zip_code`='".$zip_code."', `district`='".$district."', `admiting_doctor`='".$admiting_doctor."', `patient_type`='".$patient_type."',`dob`=".$dob." , `appt_id`='".$appt_id."', `patient_admission_type`='".$patient_admission_type."', `modified_time`='".$today."' , `modified_by`='".$created_by."', `ref_doctor_id`='".$ref_doctor_id."' WHERE `id`='".$patient_registration_id."' ");

  

 

    if($edit)

    {

       

		

		$sql6 = $conn->query("UPDATE `patient_infos_for_appt` SET `mrdno`='".$uhid_no."',`name`='".$patient_name."',`phone_no`='".$phone_no."',`email_id`='".$email_id."', `modified_time`='".$today."' , `modified_by`='".$created_by."' where `id`='".$patient_infos_id."' ");	

		$sql6 = $conn->query("UPDATE `opd_schedules_for_appt` SET `mrd_no`='".$uhid_no."',`generate_uhid_flag`='1', `modified_time`='".$today."' , `modified_by`='".$created_by."' where `id`='".$appt_id."' ");

		 //Document Dynamically Upload--->

		   

		   

		   for($i=1;$i<=$kyc_countiop;$i++) {

	 if($_REQUEST['kyc_id'.$i]!='')

		   {

			   if($_REQUEST['patient_kyc_document_flag'.$i]!='1')

		   {

			   

			   if(!empty($_FILES["patient_kyc_document_upload".$i]["name"]))

				{

				//New Added extension	

					$file_ext=strtolower(end(explode('.',$_FILES["patient_kyc_document_upload".$i]["name"]))); 

					$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`   ORDER BY `file_extension_name` ASC";

					$result_ext=$conn->query($sql_ext) ;

					$count_ext=$result_ext->num_rows;

					$loop_initial=1;

					$file_extension_name="";		

					while ($row_ext=mysqli_fetch_array($result_ext,MYSQLI_ASSOC))

					{

						 $file_extension_name=$file_extension_name.''.$row_ext['file_extension_name'].'';if($loop_initial<($count_ext)){ $file_extension_name=$file_extension_name. ','; }

						 $loop_initial++;

					}		

					$string = $file_extension_name;

					$expensions = explode(",",$string);		

					if(in_array($file_ext,$expensions)=== false){

						 //$errors[]="extension not allowed, please choose a JPEG or PNG file.";

						 $patient_kyc_document_upload='';

						 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";

					  }else{ //New Added extension	

				

						$rand8=rand(1,999999);

						$target_dir8 = "upload/patient_kyc_document_upload/";

						$patient_kyc_document_upload =$rand8.basename($_FILES["patient_kyc_document_upload".$i]["name"]);

						if(move_uploaded_file($_FILES["patient_kyc_document_upload".$i]["tmp_name"],  $target_dir8 .$patient_kyc_document_upload)) 

						{

						$msg2="The file ". basename( $_FILES["patient_kyc_document_upload".$i]["name"]). " has been uploaded.";

						} 

						else

						{

						$patient_kyc_document_upload=$_REQUEST['patient_kyc_document_upload'.$i];

						}

					 }//New Added extension

				}			

				else			

				{			

				$patient_kyc_document_upload=$_REQUEST['patient_kyc_document_upload'.$i];			

				}

			  

			  $sql4 = $conn->query("INSERT INTO `patient_kyc_document_by_receptionist` SET `patient_admission_id` = '".$patient_registration_id."',`kyc_id` = '".$_REQUEST['kyc_id'.$i]."',`patient_kyc_document_flag` = '1', `created_on`='".$today."' , `created_by`='".$created_by."',`patient_kyc_document_upload` = '".$patient_kyc_document_upload."'");

		   }

		   }   

   		}

		for($i=1;$i<=$kyc_countiop;$i++) {

	 if($_REQUEST['kyc_id'.$i]!='')

		   {

			   if($_REQUEST['patient_kyc_document_flag'.$i]=='1')

		   {

			    if(!empty($_FILES["patient_kyc_document_upload".$i]["name"]))

				{

					//New Added extension	

					$file_ext=strtolower(end(explode('.',$_FILES["patient_kyc_document_upload".$i]["name"]))); 

					$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`   ORDER BY `file_extension_name` ASC";

					$result_ext=$conn->query($sql_ext) ;

					$count_ext=$result_ext->num_rows;

					$loop_initial=1;

					$file_extension_name="";		

					while ($row_ext=mysqli_fetch_array($result_ext,MYSQLI_ASSOC))

					{

						 $file_extension_name=$file_extension_name.''.$row_ext['file_extension_name'].'';if($loop_initial<($count_ext)){ $file_extension_name=$file_extension_name. ','; }

						 $loop_initial++;

					}		

					$string = $file_extension_name;

					$expensions = explode(",",$string);		

					if(in_array($file_ext,$expensions)=== false){

						 //$errors[]="extension not allowed, please choose a JPEG or PNG file.";

						 $patient_kyc_document_upload='';

						 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";

					  }else{ //New Added extension	

					

						$rand8=rand(1,999999);

						$target_dir8 = "upload/patient_kyc_document_upload/";

						$patient_kyc_document_upload =$rand8.basename($_FILES["patient_kyc_document_upload".$i]["name"]);

						if(move_uploaded_file($_FILES["patient_kyc_document_upload".$i]["tmp_name"],  $target_dir8 .$patient_kyc_document_upload)) 



						{

						$msg2="The file ". basename( $_FILES["patient_kyc_document_upload".$i]["name"]). " has been uploaded.";

						} 

						else

						{

						$patient_kyc_document_upload=$_REQUEST['patient_kyc_document_upload'.$i];

						}

					 }//New Added extension	

				}			

				else			

				{			

				$patient_kyc_document_upload=$_REQUEST['patient_kyc_document_upload'.$i];			

				}

				

			  $sql4 = $conn->query("UPDATE `patient_kyc_document_by_receptionist` SET `kyc_id` = '".$_REQUEST['kyc_id'.$i]."',`patient_kyc_document_flag` = '1',`patient_kyc_document_upload` = '".$patient_kyc_document_upload."', `modified_time`='".$today."' , `modified_by`='".$created_by."' WHERE `id`='".$_REQUEST['patient_kyc_id'.$i]."' ");

		   }

		   }   

   		}

		   if($kyc_remove_id!='')

		   {

			    $kyc_remove_id_array=explode(":",$kyc_remove_id);

			   //print_r($remove_id_array);

			    $itemCount = sizeof($kyc_remove_id_array);

			   //exit;

			   for($i=0;$i<($itemCount-1);$i++) {

			 	 $sql4 = $conn->query("UPDATE `patient_kyc_document_by_receptionist` SET `del_flag` = '1', `deleted_time`='".$today."' , `deleted_by`='".$created_by."' WHERE `id`='".$kyc_remove_id_array[$i]."' ");

			   }

			   

		   }

		

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

        $redirectUrl=ADMIN_URL.'registration_form_edit.php?msg='.$msg.'&flg='.$flg;

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
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />

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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Patient Registration</span></div>
            </div>
            <?php

			$patient_registration_id = $_REQUEST['patient_registration_id']; // get id through query string

			

				

				$qry = mysqli_query($conn,"select * from `patient_registration_form` where `id`='".$patient_registration_id."'"); // select query

				$row3 = mysqli_fetch_array($qry); // fetch data

				

				$qry_patient_infos = mysqli_query($conn,"select * from `opd_schedules_for_appt` where `id`='".$row3['appt_id']."'"); // select query

				$row_patient_infos = mysqli_fetch_array($qry_patient_infos); // fetch data

			

			?>
            <form  action="" method="post" enctype="multipart/form-data" class="horizontal-form">
              <div class="form-body">
                <div class="row" style="background:#dcefff; padding:9px 0px">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">UHID No.</label>
                      <input type="text" id="uhid_no" value="<?php echo $row3['uhid_no']; ?>" name="uhid_no" class="form-control" placeholder="UHID No." readonly>
                      <input type="hidden" name="appt_id" id="appt_id" class="form-control" value="<?php echo $row3['appt_id']; ?>" placeholder="Name" >
                      <input type="hidden" name="patient_admission_type" id="patient_admission_type" class="form-control" value="<?php echo $row3['patient_admission_type']; ?>" placeholder="Name" >
                      <input type="hidden" id="patient_infos_id" value="<?php echo $row_patient_infos['patient_infos_id']; ?>" name="patient_infos_id" class="form-control" >
                      <input type="hidden" name="patient_registration_id" id="patient_registration_id" class="form-control" value="<?php echo $patient_registration_id; ?>" placeholder="Name" >
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label class="control-label">Prefix</label>
                      <select class="form-control" name="prefix" id="prefix" onchange="gender_defualt();" >
                        <?php 

								  $sql7="SELECT `id`, `prefix_name` FROM `prefix_masters`  WHERE  `del_flag`='0' ORDER BY `prefix_name` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" '; if($row3['prefix']==$row7['id']) echo 'selected';  echo '>'.$row7['prefix_name'].'</option>';

								 }

					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Patient Name</label>
                      <input type="text" id="patient_name" value="<?php echo $row3['patient_name']; ?>" name="patient_name" class="form-control" placeholder="Patient Name"  onblur="case_convrt('patient_name')">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Registration Date (dd-mm-YYYY)</label>
                      <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" id="registration_date" name="registration_date" value="<?php if($row3['registration_date']!='') { echo date("d-m-Y", strtotime($row3['registration_date']));}?>" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Registration Time (h:m A)(12 Hours Format)</label>
                      <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Admitting Time" name="registration_time" id="registration_time" value="<?php if($row3['registration_time']!='') { echo date("h:i A", strtotime($row3['registration_time']));}?>"  />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Date of Birth (dd-mm-YYYY)</label>
                      <div class="input-group">
                        <input type="text" class="form-control form-control-inline date-picker" name="dob" id="dob" autocomplete="off" value="<?php if($row3['dob']!='') { echo date("d-m-Y", strtotime($row3['dob']));}?>" >
                        <span class="input-group-addon" style="padding:0 !important"><a href="javascript:void(0);"  id="calculate" class="btn btn-sm blue" title="Calculate">Calculate</a></span> </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Age (+Yrs.)</label>
                      <div class="input-group">
                        <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="age"  id="age"  autocomplete="off" placeholder="Age in Years" class="form-control" value="<?php echo $row3['age']; ?>" >
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

									 echo '<option value="'.$row7['id'].'"'; if($row3['gender']==$row7['id']) echo 'selected';  echo '>'.$row7['gender'].'</option>';

								 }

					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Phone No.(10 Digit ph no.)</label>
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'');mobile_check();" onblur="mobile_check();" name="phone_no"  id="phone_no"  autocomplete="off" placeholder="Enter 10 Digit ph no." class="form-control" value="<?php echo $row3['phone_no']; ?>" >
                      <span id="error_mobie" style="color: red;font-weight:bold;"></span> </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Email ID</label>
                      <input type="email" name="email_id"  id="email_id"  autocomplete="off" placeholder="Enter Email ID" class="form-control" value="<?php echo $row3['email_id']; ?>" >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Alternate Ph. No.(10 Digit)</label>
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="alternate_phone_no"  id="alternate_phone_no"  autocomplete="off" placeholder="Enter 10 Digit ph no." class="form-control" value="<?php echo $row3['alternate_phone_no']; ?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Address</label>
                      <textarea id="address" name="address" class="form-control" placeholder="Full Address with Vill./Ward No." rows="3"><?php echo $row3['address']; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">ZIP Code</label>
                      <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="zip_code"  id="zip_code"  autocomplete="off" placeholder="Enter zip code" class="form-control" value="<?php echo $row3['zip_code']; ?>">
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

									 echo '<option value="'.$row7['id'].'"'; if($row3['district']==$row7['id']) echo 'selected'; echo '>'.$row7['district_name'].'</option>';

								 }

					 			?>
                      </select>
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



									 echo '<option value="'.$row7['id'].'" '; if($row3['admiting_doctor']==$row7['id']) echo 'selected'; echo '>'.$row7['name'].'</option>';



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



                             echo '<option value="'.$row7['id'].'"'; if($row3['patient_type']==$row7['id']) echo 'selected'; echo '>'.$row7['name'].'</option>';



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
							if(isset($_REQUEST['patient_registration_id'])){
								 $sql7="SELECT * FROM `doctor_masters_for_emr`  ORDER BY `doctor_name`";
							 }else{								
								$sql7="SELECT * FROM `doctor_masters_for_emr` WHERE `del_flag`='0' ORDER BY `doctor_name`";					
							 }
							 
								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';if($row3['ref_doctor_id']==$row7['id']) echo 'selected';  echo '>'.$row7['doctor_name'].' ('.$row7['doctor_ini'].')</option>';



								 }



					 			?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                  <p>&nbsp;</p>
                  <div class="col-md-12">
                    <div class="portlet-body">
                      <div class="row">
                        <div class="col-md-12">
                          <label class="col-sm-2 control-label" style="text-align:center !important; line-height:24px !important;">
                          Upload Camera
                          <p style=" padding-top:3px;"><span><a href="javascript:void(0)" name="upload_image" id="upload_image" class="btn btn-danger" onclick="load_web_cam();" title="Open Web Camera"><i class="fa fa-camera-retro"></i></a></span></p>
                          </label>
                          <div class="col-sm-10"> 
                            <!--<div id="camera">-->
                            <video id="video" autoplay></video>
                            <span style="display: flex;"> <a href="javascript:void(0)" id="screenshotButton" class="btn btn-sm green" style="display:none;" title="Capture & Crop Image" ><i class="fa fa-camera"></i></a> <a href="javascript:void(0)" id="save_profile_image" class="btn btn-sm blue" style="display:none;" title="Save Image"><i class="fa fa-save"></i></a>&nbsp; <a href="javascript:void(0)" id="rotate_profile_image" class="btn btn-sm blue" style="display:none;transform: rotate(180deg);" title="Rotate Image"><i class="fa fa-undo"></i></a> </span>
                            <canvas id="canvas"></canvas>
                          </div>
                        </div>
                        <div class="col-md-12" > <img id="asdasd" style="display:none;">
                          <div id="upload_images"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" ><br/>
                    <p><span id="span_title"><u>Patient Related Documents Upload</u></span></p>
                  </div>
                  <div class="col-md-12" style="background:#3e9999; padding:9px 0px">
                    <div class="col-md-12" style="text-align:right"><span id="add_more">To add more, please click on this icon</span><a href="javascript:void(0);"  id="kyc_iop_add_button" class="btn" title="Add more" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                    <div class="col-md-12" style="margin-bottom:4px;overflow-x: auto !important;">
                      <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover" id="kyc_iop_tab" style="overflow-x: auto !important;">
                          <thead>
                            <tr>
                              <th style="min-width:200px !important">Document Name</th>
                              <th  style="min-width:300px !important">Upload Document File</th>
                              <th  style="min-width:200px !important">Download Updated Document File</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php



													 $sl=1;



													$sql5="SELECT * FROM `patient_kyc_document_by_receptionist` WHERE `patient_admission_id`= '" .$patient_registration_id. "' AND `del_flag`='0'";

													 $result5=$conn->query($sql5) ;

													 $count=$result5->num_rows;

													if($count=='0'){

													  echo '<input type="hidden" name="kyc_countiop" id="kyc_countiop" value="'.($count+1).'">';

													 ?>
                            <tr id="kyc_iop<?php echo ($count+1); ?>">
                              <td style="min-width:200px !important"><select class="form-control" name="kyc_id<?php echo ($count+1); ?>" id="kyc_id<?php echo ($count+1); ?>" >
                                  <option value="">Choose</option>
                                  <?php 

						   	



								 $sql7="SELECT  `id`, `kyc_document_name` FROM `patient_kyc_document_masters` WHERE  `del_flag`='0' ORDER BY `kyc_document_name` ASC ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['kyc_document_name'].'</option>';



								 }



					 			?>
                                </select>
                                <input type="hidden" class="form-control" name="patient_kyc_document_flag<?php echo ($count+1); ?>" id="patient_kyc_document_flag<?php echo ($count+1); ?>" value="0" ></td>
                              <td style="min-width:300px !important">Document(Upload .doc,.pdf,.jpg file) : <span style="color:#b32424;font-weight:bold;">
                                <?php  echo "Not Uploaded Yet.."; ?>
                                </span>
                                <input type="hidden" class="form-control" name="patient_kyc_document_upload<?php echo ($count+1); ?>" id="patient_kyc_document_upload<?php echo ($count+1); ?>" >
                                <input name="patient_kyc_document_upload<?php echo ($count+1); ?>" id="patient_kyc_document_upload<?php echo ($count+1); ?>"  class="form-control" type="file"></td>
                              <td style="min-width:100px !important"></td>
                            </tr>
                            <?php } else{

													 echo '<input type="hidden" name="kyc_countiop" id="kyc_countiop" value="'.$count.'">';



													 while ($row5=mysqli_fetch_array($result5,MYSQLI_ASSOC))

													{



												  ?>
                            <tr id="kyc_iop<?php echo $sl; ?>">
                              <td style="min-width:200px !important"><select class="form-control" name="kyc_id<?php echo $sl; ?>" id="kyc_id<?php echo $sl; ?>"   >
                                  <option value="">Choose</option>
                                  <?php 



								  $sql7="SELECT  `id`, `kyc_document_name` FROM `patient_kyc_document_masters` WHERE  `del_flag`='0' ORDER BY `kyc_document_name` ASC ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" '; if($row5['kyc_id']==$row7['id']) echo 'selected'; echo '>'.$row7['kyc_document_name'].'</option>';



								 }

					 			?>
                                </select>
                                <input type="hidden" class="form-control" name="patient_kyc_document_flag<?php echo $sl; ?>" id="patient_kyc_document_flag<?php echo $sl; ?>" value="<?php echo $row5['patient_kyc_document_flag']; ?>" >
                                <input type="hidden" class="form-control" name="patient_kyc_id<?php echo $sl; ?>" id="patient_kyc_id<?php echo $sl; ?>" value="<?php echo $row5['id']; ?>" ></td>
                              <td style="min-width:300px !important">Document(Upload .doc,.pdf,.jpg file) : <span style="color:#b32424;font-weight:bold;">
                                <?php if($row5['patient_kyc_document_upload']!=''){ echo "Uploaded..";}else{ echo "Not Uploaded Yet..";} ?>
                                </span>
                                <input type="hidden" class="form-control" name="patient_kyc_document_upload<?php echo $sl; ?>" id="patient_kyc_document_upload<?php echo $sl; ?>" value="<?php echo $row5['patient_kyc_document_upload']; ?>" >
                                <input name="patient_kyc_document_upload<?php echo $sl; ?>" id="patient_kyc_document_upload<?php echo $sl; ?>"  class="form-control" type="file"></td>
                              <td style="min-width:100px !important"><a href="javascript:void(0);"  id="kyc_iop_remove<?php echo $sl; ?>" onClick="kyc_remove_iop_del('<?php echo $sl; ?>','<?php echo $row5['id']; ?>')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a>
                                <?php if ($row5['patient_kyc_document_upload'] != '') { ?>
                                | <a href="<?php echo ADMIN_URL.'upload/patient_kyc_document_upload/'.$row5['patient_kyc_document_upload']; ?>" name="patient_kyc_document_updated_download<?php echo $sl; ?>" id="patient_kyc_document_updated_download<?php echo $sl; ?>"  download ><img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" title="Download"  ></a>
                                <?php } ?></td>
                            </tr>
                            <?php $sl++; }} ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <input type="hidden" class="form-control" name="kyc_remove_id" id="kyc_remove_id" value="" >
                  </div>
                  <p>&nbsp;</p>
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                </div>
                <p style="padding:12px 0 2px 0; text-align:center;backgroung:#fff">
                  <button type="submit" name="submit" id="submit" class="btn green" style="display:none;" disabled>Submit</button>
                  <button type="button" name="register" id="register" class="btn blue"  >Submit </button>
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

    setTimeout('$("#alert_msg").hide()',3000);

	var p_id=$("#uhid_no").val();
	if(p_id!=''){
	load_image_data(p_id); 
	}
	$("#district").select2();

	$("#admiting_doctor").select2();
	$("#ref_doctor_id").select2();
	

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

   

   $("#dob").datepicker({

		format: 'dd-mm-yyyy'

	});

   

   

    $("#kyc_iop_add_button").live('click',function(){ 

			 var i=$("#kyc_countiop").val();

			 i=parseInt(i)+1;

			 $("#kyc_countiop").val(i);

			 //alert(i);			

			 $("#kyc_iop_tab").append('<tr id="kyc_iop' + i + '"><td style="min-width:200px !important"><select class="form-control" name="kyc_id' + i + '" id="kyc_id' + i + '" ><option value="">Choose</option><?php  $sql7="SELECT  `id`, `kyc_document_name` FROM `patient_kyc_document_masters` WHERE  `del_flag`='0' ORDER BY `kyc_document_name` ASC "; $result7=$conn->query($sql7) ; while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)) { echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['kyc_document_name'].'</option>'; } ?></select><input type="hidden" class="form-control" name="patient_kyc_document_flag' + i + '" id="patient_kyc_document_flag' + i + '" value="0"  /></td><td style="min-width:300px !important">Document(Upload .doc,.pdf,.jpg file) : <span style="color:#b32424;font-weight:bold;"><?php  echo "Not Uploaded Yet.."; ?></span><input type="hidden" class="form-control" name="patient_kyc_document_upload' + i + '" id="patient_kyc_document_upload' + i + '" > <input name="patient_kyc_document_upload' + i + '" id="patient_kyc_document_upload' + i + '"  class="form-control" type="file"></td><td style="min-width:100px !important"><a href="javascript:void(0);"  id="kyc_iop_remove' + i + '" onClick="kyc_remove_iop('+ i +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

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

       

function kyc_remove_iop(j) {

  $("#kyc_iop"+j).remove();

}

function kyc_remove_iop_del(j,id) {

  $("#kyc_iop"+j).remove();	  

  var remove_id=$("#kyc_remove_id").val();

  var values_drug=remove_id+id+":";

  $("#kyc_remove_id").val(values_drug);

}


function load_image_data(p_id){
	$('#upload_images').html('');
	$.ajax({
            url: 'get_json_data_patient.php?flag=2',
			dataType: 'json',
			type: 'POST',
			data:{
					  uhid_no: $("#uhid_no").val(),
				  },
			success: function (data) {
				var html_lg='';
				var sl=1;
				if($.trim(data)!=''){
				  $.each(data, function(index, element) {
					html_lg +='<span style="display: flex;"><img src="upload/patient_reg_upload/'+element.image+'" alt="Screenshot" class="img-thumbnail"><a href="<?php echo ADMIN_URL; ?>upload/patient_reg_upload/'+element.image+'" style="position: relative;" id="download_cam_image" download><i class="fa fa-download" style="color:red;"></i></a></span>';
				 sl++;});
				 }else{
					
					html_lg +='No Image Data';	
				}
				$('#upload_images').html(html_lg);
			 }
		  });
}
</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script> 
<script>

function load_web_cam(){
	$('#screenshotButton').css('display','block');
	const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const croppedImage = document.getElementById('cropped');
    let cropper;

    // Access the camera
     navigator.mediaDevices.getUserMedia({ video: {
		facingMode: 'environment'
	  } })
        .then(function(stream) {
            video.srcObject = stream;
        })
        .catch(function(err) {
            console.error("Error accessing the camera: " + err);
        });

    // Capture the image when the button is clicked
    $('#screenshotButton').on('click', function() {
		$('#screenshotButton').css('display','none');
		$('#save_profile_image').css('display','block');
		$('#rotate_profile_image').css('display','block');
        const context = canvas.getContext('2d');		
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
		
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        video.pause();
		$("#video").remove();
        // Initialize Cropper.js
        if (cropper) {
            cropper.destroy();
        }
        cropper = new Cropper(canvas, {
            aspectRatio: 1 / 1,
            viewMode: 1,
            ready: function () {
                // Optional: code when cropper is ready
            }
        });
    });
	
	$('#rotate_profile_image').on('click', function() {
		 if (cropper) {
                cropper.rotate(90); // Rotate 90 degrees
          }
		
	});
	
    // Optionally, you can add a button to get the cropped image
    $('#save_profile_image').on('click', function() {
		var uh_check=$("#uhid_no").val();
		if(uh_check==''){
			alert('UHID No. is not exist!!!')
			return false;	
		}
        const croppedCanvas = cropper.getCroppedCanvas();
		const imageData = croppedCanvas.toDataURL('image/png');
        //croppedImage.src = croppedCanvas.toDataURL();
		 $.ajax({
				  type: "POST",
				  url: 'get_json_data_patient.php?flag=1',
				  data: {
					  uhid_no: $("#uhid_no").val(),
					 // mrd_no: $("#mrd_no_").val(),
					  imagedata: imageData
				  },
				  success: function(data) {
					//alert(data.Msg);
					$('#canvas').remove();
					cropper.destroy();
					$('.cropper-container').remove();
					$('#save_profile_image').css('display','none');
					$('#rotate_profile_image').css('display','none');
					load_image_data($("#uhid_no").val());
				  }
				});
    });
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
