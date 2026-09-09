<?php

include "conn.php"; // Using database connection file here

if(isset($_REQUEST['submit']))

{
  //Edit Data

	$emp_id = mysqli_real_escape_string($conn,$_REQUEST['emp_id']);

	$emp_department = mysqli_real_escape_string($conn,$_REQUEST['emp_department']);

	$username = mysqli_real_escape_string($conn,$_REQUEST['username']);

	$password = mysqli_real_escape_string($conn,$_REQUEST['password']);

	$emp_name = mysqli_real_escape_string($conn,$_REQUEST['emp_name']);

	$mobile = mysqli_real_escape_string($conn,$_REQUEST['mobile']);

	$email = mysqli_real_escape_string($conn,$_REQUEST['email']);

	$address = mysqli_real_escape_string($conn,$_REQUEST['address']);

	$pincode = mysqli_real_escape_string($conn,$_REQUEST['pincode']);

	$date_of_birth = mysqli_real_escape_string($conn,$_REQUEST['date_of_birth']);

	$modified_by=$_REQUEST['modified_by'];

	$modified_time=$_REQUEST['modified_time'];

	$users_id=$_REQUEST['users_id'];

	$today=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	

	if($_REQUEST['date_of_joining']==''){

    $date_of_joining='NULL';

	}else{

		$date_of_joining= "'".date("Y-m-d", strtotime($_POST['date_of_joining']))."'";

	}

	

	

	

	$kyc_countiop=mysqli_real_escape_string($conn,$_REQUEST['kyc_countiop']);  //IOP

	$kyc_remove_id=mysqli_real_escape_string($conn,$_REQUEST['kyc_remove_id']);

	//,,,,,     

	$department_id=mysqli_real_escape_string($conn,$_REQUEST['department_id']);

	$user_role=mysqli_real_escape_string($conn,$_REQUEST['user_role']);

	$inactive_status=mysqli_real_escape_string($conn,$_REQUEST['inactive_status']);

	/**/

	$patient_show_flag=mysqli_real_escape_string($conn,$_REQUEST['patient_show_flag']);

	$choose_doctors=mysqli_real_escape_string($conn,$_REQUEST['choose_doctors']);

	$regd_no=mysqli_real_escape_string($conn,$_REQUEST['regd_no']);

	$designation=mysqli_real_escape_string($conn,$_REQUEST['designation']);
	$designation_desc=mysqli_real_escape_string($conn,$_REQUEST['designation_desc']);
	$emr_pres_master_add_flag=mysqli_real_escape_string($conn,$_REQUEST['emr_pres_master_add_flag']);
	

	$sql="SELECT * FROM `hr_login` WHERE `username`='".$username."' AND `del_flag`='0'";

	$result=$conn->query($sql) ;

	$count=$result->num_rows;

	$row = $result->fetch_assoc();

	if($count>1)

	{

		echo "<script type=\"text/javascript\"> alert('Username already exist!!! Try another username'); </script>";

		$redirectUrl=ADMIN_URL.'hrlogin_edit.php?users_id='.$users_id;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

	}

	

	

	//exit;

	

	

	

 $edit = mysqli_query($conn,"UPDATE `users` SET `username`='".$username."',`password`='".$password."' ,`role`='".$emp_department."', `modified_by`='".$modified_by."', `modified_time`='".$modified_time."' ,`department_id`='".$department_id."',`user_role`='".$user_role."' ,`patient_show_flag`='".$patient_show_flag."' ,`choose_doctors`='".$choose_doctors."' ,`emr_pres_master_add_flag`='".$emr_pres_master_add_flag."' where `id`='".$users_id."' ") ;



    if($edit)

    {

		

       		

		/************************Last SAndip Edit**************/ 

		

		$sql6 = $conn->query("update `hr_login` set `emp_department`='".$emp_department."', `username`='".$username."', `password`='".$password."', `emp_name`='".$emp_name."', `mobile`='".$mobile."', `email`='".$email."', `address`='".$address."', `pincode`='".$pincode."', `date_of_birth`='".$date_of_birth."', `modified_by`='".$modified_by."', `modified_time`='".$modified_time."', `date_of_joining`=".$date_of_joining." where `users_id`='".$users_id."'");

		

		if($inactive_status=='1'){

			$date_of_resigning =date("Y-m-d", strtotime($_POST['date_of_resigning']));	

			$sql6 = $conn->query("update `hr_login` set  `date_of_resigning`='".$date_of_resigning."' where `users_id`='".$users_id."'");

			

		}

		

	$sql6 = $conn->query("UPDATE `user_infos` SET `name`='".$emp_name."',`address`='".$address."' ,`phone_no`='".$mobile."',`email_id`='".$email."',`regd_no`='".$regd_no."',`designation`='".$designation."' ,`designation_desc`='".$designation_desc."' where `users_id`='".$users_id."'");

	

		   

		   //KYC DOcument Dynamically Upload--->

		   

		   

		   for($i=1;$i<=$kyc_countiop;$i++) {

	 if($_REQUEST['kyc_id'.$i]!='')

		   {

			   if($_REQUEST['employee_kyc_document_flag'.$i]!='1')

		   {

			   

			   if(!empty($_FILES["employee_kyc_document_upload".$i]["name"]))

				{

				//New Added extension	

					$file_ext=strtolower(end(explode('.',$_FILES["employee_kyc_document_upload".$i]["name"]))); 

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

						 $employee_kyc_document_upload='';

						 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";

					  }else{ //New Added extension	

				

						$rand8=rand(1,999999);

						$target_dir8 = "upload/employee_kyc_document_upload/";

						$employee_kyc_document_upload =$rand8.basename($_FILES["employee_kyc_document_upload".$i]["name"]);

						if(move_uploaded_file($_FILES["employee_kyc_document_upload".$i]["tmp_name"],  $target_dir8 .$employee_kyc_document_upload)) 

						{

						$msg2="The file ". basename( $_FILES["employee_kyc_document_upload".$i]["name"]). " has been uploaded.";

						} 

						else

						{

						$employee_kyc_document_upload=$_REQUEST['employee_kyc_document_upload'.$i];

						}

					 }//New Added extension

				}			

				else			

				{			

				$employee_kyc_document_upload=$_REQUEST['employee_kyc_document_upload'.$i];			

				}

			   

			  $sql4 = $conn->query("INSERT INTO `employee_kyc_document_by_hr` SET `emp_id` = '".$users_id."',`kyc_id` = '".$_REQUEST['kyc_id'.$i]."',`employee_kyc_document_flag` = '1', `created_on`='".$today."' , `created_by`='".$created_by."',`employee_kyc_document_upload` = '".$employee_kyc_document_upload."'");

		   }

		   }   

   		}

		for($i=1;$i<=$kyc_countiop;$i++) {

	 if($_REQUEST['kyc_id'.$i]!='')

		   {

			   if($_REQUEST['employee_kyc_document_flag'.$i]=='1')

		   {

			    if(!empty($_FILES["employee_kyc_document_upload".$i]["name"]))

				{

					//New Added extension	

					$file_ext=strtolower(end(explode('.',$_FILES["employee_kyc_document_upload".$i]["name"]))); 

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

						 $employee_kyc_document_upload='';

						 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";

					  }else{ //New Added extension	

					

						$rand8=rand(1,999999);

						$target_dir8 = "upload/employee_kyc_document_upload/";

						$employee_kyc_document_upload =$rand8.basename($_FILES["employee_kyc_document_upload".$i]["name"]);

						if(move_uploaded_file($_FILES["employee_kyc_document_upload".$i]["tmp_name"],  $target_dir8 .$employee_kyc_document_upload)) 

						{

						$msg2="The file ". basename( $_FILES["employee_kyc_document_upload".$i]["name"]). " has been uploaded.";

						} 

						else

						{

						$employee_kyc_document_upload=$_REQUEST['employee_kyc_document_upload'.$i];

						}

					 }//New Added extension	

				}			

				else			

				{			

				$employee_kyc_document_upload=$_REQUEST['employee_kyc_document_upload'.$i];			

				}

				

			  $sql4 = $conn->query("UPDATE `employee_kyc_document_by_hr` SET `kyc_id` = '".$_REQUEST['kyc_id'.$i]."',`employee_kyc_document_flag` = '1', `modified_time`='".$today."' , `modified_by`='".$created_by."',`employee_kyc_document_upload` = '".$employee_kyc_document_upload."' WHERE `id`='".$_REQUEST['employee_kyc_id'.$i]."' ");

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

				  // "UPDATE `drugsheet` SET `del_flag` = '1', `deleted_time`='".$today."' , `deleted_by`='".$created_by."' WHERE `id`='".$remove_id_array[$i]."' ";

			 	 $sql4 = $conn->query("UPDATE `employee_kyc_document_by_hr` SET `del_flag` = '1', `deleted_time`='".$today."' , `deleted_by`='".$created_by."' WHERE `id`='".$kyc_remove_id_array[$i]."' ");

			   }

			   

		   }

		   		  

	

        $msg="Record updated successfully";

        $flg=0;

        $redirectUrl=ADMIN_URL.'hrlogin_view.php?msg='.$msg.'&flg='.$flg;

        echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

    }

    else

    {

       

		echo "<script type=\"text/javascript\"> alert('Username already exist!!! Try another username'); </script>";

		$redirectUrl=ADMIN_URL.'hrlogin_edit.php?users_id='.$users_id;

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
}
.input-group-addon {
	padding: 2px 12px;
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
  <div class="row number-stats" >
    <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
      <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>
      <button class="close" data-close="alert"></button>
      <span>
      <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg']; echo '</div>';}?>
      </span> </div>
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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">USER / EMPLOYEE Creation By HR</span></div>
            </div>
            <?php

			$users_id = $_REQUEST['users_id']; // get id through query string

			

			$qry = mysqli_query($conn,"select * from `hr_login` where `users_id`='".$users_id."'"); // select query

			

			$row3 = mysqli_fetch_array($qry); // fetch data

			

			?>
            <form  action="" method="post" enctype="multipart/form-data" class="horizontal-form" autocomplete="off">
              <div class="form-body">
                <div class="row" style="background:#dcefff; padding:9px 0px">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="col-md-12" >
                        <p><span id="span_title"><u>Basic Details</u></span></p>
                      </div>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">Emp. ID</label>
                        <input type="hidden" name="users_id" id="users_id" class="form-control" value="<?php echo $_GET['users_id']; ?>" placeholder="Name" >
                        <input type="hidden" name="modified_by" id="modified_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />
                        <input type="hidden" name="modified_time" id="modified_time" class="form-control" placeholder="Enter id" value="<?php echo date('Y-m-d H:i:s');?>" />
                        <input type="text" name="emp_id" id="emp_id" class="form-control" value="<?php echo $row3['emp_id']; ?>" placeholder="<?php echo $row3['emp_id']; ?>" readonly>
                        <input type="hidden" name="inactive_status" id="inactive_status" class="form-control" placeholder="<?php echo $row3['inactive_status']; ?>" value="<?php echo $row3['inactive_status']; ?>" readonly>
                      </div>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">Department</label>
                        <select class="form-control" name="emp_department" id="emp_department"   required>
                          <option value="">Choose..</option>
                          <?php 

						

								 $sql7="SELECT `id`, `department` FROM `department_masters` WHERE `del_flag`='0' ORDER BY `department` ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" '; if($row3['emp_department']==$row7['id']) echo 'selected'; echo '>'.$row7['department'].'</option>';



								 }



					 			?>
                        </select>
                      </div>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">User Name <span style="color:red;">(Login ID)(INI)</span></label>
                        <input type="text" name="username" id="username" value="<?php echo $row3['username']; ?>" class="form-control" placeholder=""  required autocomplete="new-password">
                      </div>
                      <div class="col-md-3" style="padding:0 0 6px 0">
                        <div class="form-group">
                          <label class="control-label">Password</label>
                          <div class="input-group">
                            <input type="password" name="password" id="password" value="<?php echo $row3['password']; ?>" class="form-control" placeholder="" required autocomplete="new-password">
                            <span class="input-group-addon"><b> <a href="javascript:void(0);" onclick="show_pass();" style="font-weight:bold;" id="show_anchor"> <i class="fa fa-eye"></i> </a> <a href="javascript:void(0);" onclick="hide_pass();" style="font-weight:bold;display:none;" id="hide_anchor"> <i class="fa fa-eye-slash"></i> </a> </b></span> </div>
                        </div>
                      </div>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">Employee Name</label>
                        <input type="text" name="emp_name" id="emp_name" value="<?php echo $row3['emp_name']; ?>" class="form-control" placeholder="" required>
                      </div>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">Mobile *</label>
                        <input type="text" name="mobile" id="mobile" value="<?php echo $row3['mobile']; ?>" class="form-control" placeholder="" required>
                      </div>
                      <div class="col-md-3" style="padding:0 0 6px 0">
                        <label class="control-label">Email *</label>
                        <input type="email" id="email" name="email" value="<?php echo $row3['email']; ?>" class="form-control" placeholder="" >
                      </div>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $row3['date_of_birth']; ?>" class="form-control" placeholder="">
                      </div>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">Address</label>
                        <textarea name="address" id="address" class="form-control"><?php echo $row3['address']; ?></textarea>
                      </div>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">Pincode</label>
                        <input type="text" name="pincode" id="pincode" value="<?php echo $row3['pincode']; ?>" class="form-control" placeholder="">
                      </div>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">Date of Joining</label>
                        
                        <!-- <input type="date" name="date_of_joining" id="date_of_joining" value="<?php echo $row3['date_of_joining']; ?>" class="form-control" placeholder="">-->
                        
                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" id="date_of_joining" name="date_of_joining" value="<?php if($row3['date_of_joining']!='') { echo date("d-m-Y", strtotime($row3['date_of_joining']));} else{ echo date("d-m-Y"); } ?>" />
                      </div>
                      <?php if($row3['inactive_status']=='1'){?>
                      <div class="col-md-3" style="padding:0 6px 6px 0">
                        <label class="control-label">Last Working Date</label>
                        <?php if($row3['date_of_resigning']!=''){?>
                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" id="date_of_resigning" name="date_of_resigning" value="<?php if($row3['date_of_resigning']!='') { echo date("d-m-Y", strtotime($row3['date_of_resigning']));} ?>" />
                        <?php }else{?>
                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" id="date_of_resigning" name="date_of_resigning" value="<?php date("d-m-Y");  ?>" />
                        <?php }?>
                      </div>
                      <?php }?>
                      <div class="col-md-12">
                        <p>&nbsp;<br/>
                        </p>
                      </div>
                      <div class="col-md-4" style="padding:0 6px 12px 0">
                        <label class="control-label"> Patient Show Flag</label>
                        <select class="form-control" name="patient_show_flag" id="patient_show_flag"   >
                          <?php 

										$sqlshowflag="SELECT `users`.`patient_show_flag` FROM `users` WHERE `id`='".$users_id."'";

										$resultshowflag=$conn->query($sqlshowflag) ;

										$rowshowflag = mysqli_fetch_array($resultshowflag);

										$patient_show_flag=$rowshowflag['patient_show_flag'];									

					 			?>
                          <option value="0" <?php if($patient_show_flag=='0'){ echo 'Selected';} ?>>ALL</option>
                          <option value="1" <?php if($patient_show_flag=='1'){ echo 'Selected';} ?>>Doctor wise individual</option>
                        </select>
                      </div>
                      <div class="col-md-4" style="padding:0 6px 6px 0">
                        <label class="control-label">Appt taken for</label>
                        <select class="form-control select2" name="choose_doctors" id="choose_doctors"   >
                          <option value="0" <?php if($row3['choose_doctors']==0) echo 'selected'; ?>>All Doctors</option>
                          <?php 

						

								 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE (`users`.`role`='5' ) ORDER BY `user_infos`.`name`  ";

								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" '; if($row3['choose_doctors']==$row7['id']) echo 'selected'; echo '>'.$row7['name'].'</option>';



								 }



					 			?>
                        </select>
                      </div>
                      <?php 

										$sql_emr="SELECT `regd_no`, `designation`, `designation_desc` FROM `user_infos` WHERE `users_id`='".$users_id."'";

										$result_emr=$conn->query($sql_emr) ;

										$row_emr = mysqli_fetch_array($result_emr);

										$regd_no=$row_emr['regd_no'];	

										$designation=$row_emr['designation'];		
										$designation_desc=$row_emr['designation_desc'];							

					 			?>
                      <div class="col-md-4" style="padding:0 6px 6px 0">
                        <label class="control-label">Doctor's Regd. No.</label>
                        <input type="text" name="regd_no" id="regd_no" value="<?php echo $regd_no; ?>" class="form-control" placeholder="WBMC 46544">
                      </div>
                      <div class="col-md-12">
                        <p>&nbsp;<br/>
                        </p>
                      </div>
                      <div class="col-md-4" style="padding:0 6px 6px 0">
                        <label class="control-label">Doctor's Designation</label>
                        <input type="text" name="designation" id="designation" value="<?php echo $designation; ?>" class="form-control" placeholder="Consultant Ophthalmic Surgeon">
                      </div>
                      <div class="col-md-4" style="padding:0 6px 6px 0">
                        <label class="control-label">Doctor's Degree</label>
                        <textarea  name="designation_desc" id="designation_desc"  class="form-control" placeholder="MBBS (Vellore), MD (AIIMS)
Former Consultant, Sankara Nethralaya (Chennai)
Fellow Yale Eye Centre (USA);
Fellow Wills Eye Hospital (USA)" rows="6"><?php echo $designation_desc; ?></textarea>
                      </div>
                      <div class="col-md-4" style="padding:0 6px 12px 0">
                        <label class="control-label"> EMR Prescription Master Add</label>
                        <select class="form-control" name="emr_pres_master_add_flag" id="emr_pres_master_add_flag"   >
                          <?php 

										$sqlshowflag_master="SELECT `users`.`emr_pres_master_add_flag` FROM `users` WHERE `id`='".$users_id."'";

										$resultshowflag_master=$conn->query($sqlshowflag_master) ;

										$rowshowflag_master = mysqli_fetch_array($resultshowflag_master);

										$emr_pres_master_add_flag=$rowshowflag_master['emr_pres_master_add_flag'];									

					 			?>
                          <option value="0" <?php if($emr_pres_master_add_flag=='0'){ echo 'Selected';} ?>>No</option>
                          <option value="1" <?php if($emr_pres_master_add_flag=='1'){ echo 'Selected';} ?>>Yes</option>
                        </select>
                      </div>
                      <div class="col-md-12">
                        <p>&nbsp;<br/>
                        </p>
                      </div>
                      <div class="col-md-12" ><br/>
                        <p><span id="span_title"><u>KYC Documents Upload</u></span></p>
                      </div>
                      <div class="col-md-12" style="background:#3e9999; padding:9px 0px">
                        <div class="col-md-12" style="text-align:right"><span id="add_more">To add more, please click on this icon</span><a href="javascript:void(0);"  id="kyc_iop_add_button" class="btn" title="Add more" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                        <div class="col-md-12" style="margin-bottom:4px;overflow-x: auto !important;">
                          <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover" id="kyc_iop_tab" style="overflow-x: auto !important;">
                              <thead>
                                <tr>
                                  <th style="min-width:200px !important">KYC Document Name</th>
                                  <th  style="min-width:300px !important">Upload Document File</th>
                                  <th  style="min-width:200px !important">Download Updated Document File</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php



													 $sl=1;



													 $sql5="SELECT * FROM `employee_kyc_document_by_hr` WHERE `emp_id`= '" .$users_id. "' AND `del_flag`='0'";



													 $result5=$conn->query($sql5) ;



													 $count=$result5->num_rows;

													if($count=='0'){

													  echo '<input type="hidden" name="kyc_countiop" id="kyc_countiop" value="'.($count+1).'">';

													 ?>
                                <tr id="kyc_iop<?php echo ($count+1); ?>">
                                  <td style="min-width:200px !important"><select class="form-control" name="kyc_id<?php echo ($count+1); ?>" id="kyc_id<?php echo ($count+1); ?>" >
                                      <option value="">Choose</option>
                                      <?php 

						   	



								 $sql7="SELECT  `id`, `kyc_document_name` FROM `employee_kyc_document_masters` WHERE  `del_flag`='0' ORDER BY `kyc_document_name` ASC ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['kyc_document_name'].'</option>';



								 }



					 			?>
                                    </select>
                                    <input type="hidden" class="form-control" name="employee_kyc_document_flag<?php echo ($count+1); ?>" id="employee_kyc_document_flag<?php echo ($count+1); ?>" value="0" ></td>
                                  <td style="min-width:300px !important">KYC Document(Upload .doc,.pdf,.jpg file) : <span style="color:#b32424;font-weight:bold;">
                                    <?php  echo "Not Uploaded Yet.."; ?>
                                    </span>
                                    <input type="hidden" class="form-control" name="employee_kyc_document_upload<?php echo ($count+1); ?>" id="employee_kyc_document_upload<?php echo ($count+1); ?>" >
                                    <input name="employee_kyc_document_upload<?php echo ($count+1); ?>" id="employee_kyc_document_upload<?php echo ($count+1); ?>"  class="form-control" type="file"></td>
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



								  $sql7="SELECT  `id`, `kyc_document_name` FROM `employee_kyc_document_masters` WHERE  `del_flag`='0' ORDER BY `kyc_document_name` ASC ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" '; if($row5['kyc_id']==$row7['id']) echo 'selected'; echo '>'.$row7['kyc_document_name'].'</option>';



								 }

					 			?>
                                    </select>
                                    <input type="hidden" class="form-control" name="employee_kyc_document_flag<?php echo $sl; ?>" id="employee_kyc_document_flag<?php echo $sl; ?>" value="<?php echo $row5['employee_kyc_document_flag']; ?>" >
                                    <input type="hidden" class="form-control" name="employee_kyc_id<?php echo $sl; ?>" id="employee_kyc_id<?php echo $sl; ?>" value="<?php echo $row5['id']; ?>" ></td>
                                  <td style="min-width:300px !important">KYC Document(Upload .doc,.pdf,.jpg file) : <span style="color:#b32424;font-weight:bold;">
                                    <?php if($row5['employee_kyc_document_upload']!=''){ echo "Uploaded..";}else{ echo "Not Uploaded Yet..";} ?>
                                    </span>
                                    <input type="hidden" class="form-control" name="employee_kyc_document_upload<?php echo $sl; ?>" id="employee_kyc_document_upload<?php echo $sl; ?>" value="<?php echo $row5['employee_kyc_document_upload']; ?>" >
                                    <input name="employee_kyc_document_upload<?php echo $sl; ?>" id="employee_kyc_document_upload<?php echo $sl; ?>"  class="form-control" type="file"></td>
                                  <td style="min-width:100px !important"><a href="javascript:void(0);"  id="kyc_iop_remove<?php echo $sl; ?>" onClick="kyc_remove_iop_del('<?php echo $sl; ?>','<?php echo $row5['id']; ?>')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a>
                                    <?php if ($row5['employee_kyc_document_upload'] != '') { ?>
                                    | <a href="<?php echo ADMIN_URL.'upload/employee_kyc_document_upload/'.$row5['employee_kyc_document_upload']; ?>" name="employee_kyc_document_updated_download<?php echo $sl; ?>" id="employee_kyc_document_updated_download<?php echo $sl; ?>"  download ><img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" title="Download"  ></a>
                                    <?php } ?></td>
                                </tr>
                                <?php $sl++; }} ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <input type="hidden" class="form-control" name="kyc_remove_id" id="kyc_remove_id" value="" >
                        <input type="hidden" class="form-control" name="department_id" id="department_id" value="8" >
                        <input type="hidden" class="form-control" name="user_role" id="user_role" value="4" >
                      </div>
                      <div class="col-md-12">
                        <p>&nbsp;<br/>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <p style="padding:12px 0 2px 0; text-align:center;backgroung:#fff">
                  <button type="submit" name="submit" id="submit" class="btn green">Submit</button>
                </p>
              </div>
            </form>
          </div>
          
          <!-- </div> --> 
          
        </div>
        
        <!-- END PAGE CONTENT --> 
        
      </div>
    </div>
  </div>
  
  <!-- END PAGE CONTENT INNER --> 
  
</div>

<!-- END PAGE CONTENT --> 

<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript">





$(document).ready( function() {

	$("#choose_doctors").select2();

	

/*For Curent DAte*/

$("#date_of_joining").datepicker({

	format: 'dd-mm-yyyy'

});   

$("#date_of_resigning").datepicker({

	format: 'dd-mm-yyyy'

}); 



   

    setTimeout('$("#alert_msg").hide()',3000);   

	 $("#kyc_iop_add_button").live('click',function(){ 

			 var i=$("#kyc_countiop").val();

			 i=parseInt(i)+1;

			 $("#kyc_countiop").val(i);

			 //alert(i);			

			 $("#kyc_iop_tab").append('<tr id="kyc_iop' + i + '"><td style="min-width:200px !important"><select class="form-control" name="kyc_id' + i + '" id="kyc_id' + i + '" onChange="retrieve_amount(\'kyc_id' + i + '\',\'' + i + '\');"><option value="">Choose</option><?php  $sql7="SELECT  `id`, `kyc_document_name` FROM `employee_kyc_document_masters` WHERE  `del_flag`='0' ORDER BY `id` ASC "; $result7=$conn->query($sql7) ; while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)) { echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['kyc_document_name'].'</option>'; } ?></select><input type="hidden" class="form-control" name="employee_kyc_document_flag' + i + '" id="employee_kyc_document_flag' + i + '" value="0"  /></td><td style="min-width:300px !important">KYC Document(Upload .doc,.pdf,.jpg file) : <span style="color:#b32424;font-weight:bold;"><?php  echo "Not Uploaded Yet.."; ?></span><input type="hidden" class="form-control" name="employee_kyc_document_upload' + i + '" id="employee_kyc_document_upload' + i + '" > <input name="employee_kyc_document_upload' + i + '" id="employee_kyc_document_upload' + i + '"  class="form-control" type="file"></td><td style="min-width:100px !important"><a href="javascript:void(0);"  id="kyc_iop_remove' + i + '" onClick="kyc_remove_iop('+ i +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

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







  

function show_pass(){

	$("#show_anchor").css("display", "none") ;

	$("#password").prop("type", "text") ;

	$("#hide_anchor").css("display", "block") ;

}

function hide_pass(){

	$("#hide_anchor").css("display", "none") ;

	$("#password").prop("type", "password") ;

	$("#show_anchor").css("display", "block") ;

}



</script>
<?php include "footer.php" ?>

<!-- END JAVASCRIPTS -->

</body><!-- END BODY -->

</html>