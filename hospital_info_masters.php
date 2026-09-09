<?php include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	// Edit Data 
	if($_REQUEST['id']!=''){
			
		$hospital_name=mysqli_real_escape_string($conn,$_REQUEST['hospital_name']);
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);
		$address=mysqli_real_escape_string($conn,$_REQUEST['address']);
		$phone=mysqli_real_escape_string($conn,$_REQUEST['phone']);
		$mobile=mysqli_real_escape_string($conn,$_REQUEST['mobile']);
		$email=mysqli_real_escape_string($conn,$_REQUEST['email']);
		$hospital_unit=mysqli_real_escape_string($conn,$_REQUEST['hospital_unit']);
		$gst_in=mysqli_real_escape_string($conn,$_REQUEST['gst_in']);
		$drug_licence=mysqli_real_escape_string($conn,$_REQUEST['drug_licence']);
		$hos_reg_no=mysqli_real_escape_string($conn,$_REQUEST['hos_reg_no']);
		$website=mysqli_real_escape_string($conn,$_REQUEST['website']);
		$final_bill_unit=mysqli_real_escape_string($conn,$_REQUEST['final_bill_unit']);
		$final_bill_mobile=mysqli_real_escape_string($conn,$_REQUEST['final_bill_mobile']);
		$modified_by=mysqli_real_escape_string($conn,$_REQUEST['modified_by']);
		$modified_time=mysqli_real_escape_string($conn,$_REQUEST['modified_time']);
		/*Update Document File*/
		if(!empty($_FILES["hospital_pic"]["name"]))
		{
			//New Added extension
			$file_ext=strtolower(end(explode('.',$_FILES["hospital_pic"]["name"]))); 
			$sql_ext="SELECT `file_extension_name` FROM `file_format_extension` WHERE `image_flag` ='1'  ORDER BY `file_extension_name` ASC";
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
				 $hospital_pic='';
				 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";
			  }else{ //New Added extension
				$rand8=rand(1,999999);
				$target_dir8 = "upload/hospital_pic/";
				$hospital_pic =$rand8.basename($_FILES["hospital_pic"]["name"]);
				if(move_uploaded_file($_FILES["hospital_pic"]["tmp_name"],  $target_dir8 .$hospital_pic)) 
				{
				$msg2="The file ". basename( $_FILES["hospital_pic"]["name"]). " has been uploaded.";
				} 
				else
				{
				$hospital_pic=$_REQUEST['hospital_pic'];
				}
			 }//New Added extension
		}	
		else
		{
		$hospital_pic=$_REQUEST['hospital_pic'];
		}
		if(!empty($_FILES["hospital_logo"]["name"]))
		{
			//New Added extension
			$file_ext=strtolower(end(explode('.',$_FILES["hospital_logo"]["name"]))); 
			$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`  WHERE `image_flag` ='1' ORDER BY `file_extension_name` ASC";
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
				 $hospital_logo='';
				 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";
			  }else{ //New Added extension
				$rand8=rand(1,999999);
				$target_dir8 = "upload/hospital_logo/";
				$hospital_logo =$rand8.basename($_FILES["hospital_logo"]["name"]);
				if(move_uploaded_file($_FILES["hospital_logo"]["tmp_name"],  $target_dir8 .$hospital_logo)) 
				{
				$msg2="The file ". basename( $_FILES["hospital_logo"]["name"]). " has been uploaded.";
				} 
				else
				{
				$hospital_logo=$_REQUEST['hospital_logo'];
				}
			 }//New Added extension
		}	
		else
		{
		$hospital_logo=$_REQUEST['hospital_logo'];
		}
		if(!empty($_FILES["left_side_logo"]["name"]))
		{
			//New Added extension
			$file_ext=strtolower(end(explode('.',$_FILES["left_side_logo"]["name"]))); 
			$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`  WHERE `image_flag` ='1' ORDER BY `file_extension_name` ASC";
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
				 $left_side_logo='';
				 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";
			  }else{ //New Added extension
				$rand8=rand(1,999999);
				$target_dir8 = "upload/left_side_logo/";
				$left_side_logo =$rand8.basename($_FILES["left_side_logo"]["name"]);
				if(move_uploaded_file($_FILES["left_side_logo"]["tmp_name"],  $target_dir8 .$left_side_logo)) 
				{
				$msg2="The file ". basename( $_FILES["left_side_logo"]["name"]). " has been uploaded.";
				} 
				else
				{
				$left_side_logo=$_REQUEST['left_side_logo'];
				}
			 }//New Added extension
		}	
		else
		{
		$left_side_logo=$_REQUEST['left_side_logo'];
		}
		
		if(!empty($_FILES["right_side_logo"]["name"]))
		{
			//New Added extension
			$file_ext=strtolower(end(explode('.',$_FILES["right_side_logo"]["name"]))); 
			$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`  WHERE `image_flag` ='1' ORDER BY `file_extension_name` ASC";
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
				 $right_side_logo='';
				 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";
			  }else{ //New Added extension
				$rand8=rand(1,999999);
				$target_dir8 = "upload/right_side_logo/";
				$right_side_logo =$rand8.basename($_FILES["right_side_logo"]["name"]);
				if(move_uploaded_file($_FILES["right_side_logo"]["tmp_name"],  $target_dir8 .$right_side_logo)) 
				{
				$msg2="The file ". basename( $_FILES["right_side_logo"]["name"]). " has been uploaded.";
				} 
				else
				{
				$right_side_logo=$_REQUEST['right_side_logo'];
				}
			 }//New Added extension
		}	
		else
		{
		$right_side_logo=$_REQUEST['right_side_logo'];
		}
		/*End Update Uoload File*/
		$sql = "UPDATE `hospital_info_masters` SET `hospital_name`='".$hospital_name."', `address`='".$address."', `phone`='".$phone."', `mobile`='".$mobile."', `email`='".$email."', `hospital_unit`='".$hospital_unit."', `gst_in`='".$gst_in."', `drug_licence`='".$drug_licence."', `hos_reg_no`='".$hos_reg_no."', `website`='".$website."', `final_bill_unit`='".$final_bill_unit."', `final_bill_mobile`='".$final_bill_mobile."', `hospital_pic`='".$hospital_pic."', `hospital_logo`='".$hospital_logo."', `modified_by`='".$modified_by."' ,`modified_time`='".$modified_time."', `left_side_logo`='".$left_side_logo."', `right_side_logo`='".$right_side_logo."' WHERE `id`='".$id."'";
		if($conn->query($sql)===TRUE)
		{
		$msg="Record updated successfully";
		$flg=0;
		$redirectUrl=ADMIN_URL.'hospital_info_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'hospital_info_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
	//Add Data
	else{
		$hospital_name=mysqli_real_escape_string($conn,$_REQUEST['hospital_name']);
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);
		$address=mysqli_real_escape_string($conn,$_REQUEST['address']);
		$phone=mysqli_real_escape_string($conn,$_REQUEST['phone']);
		$mobile=mysqli_real_escape_string($conn,$_REQUEST['mobile']);
		$email=mysqli_real_escape_string($conn,$_REQUEST['email']);
		$hospital_unit=mysqli_real_escape_string($conn,$_REQUEST['hospital_unit']);
		$gst_in=mysqli_real_escape_string($conn,$_REQUEST['gst_in']);
		$drug_licence=mysqli_real_escape_string($conn,$_REQUEST['drug_licence']);
		$hos_reg_no=mysqli_real_escape_string($conn,$_REQUEST['hos_reg_no']);
		$website=mysqli_real_escape_string($conn,$_REQUEST['website']);
		$final_bill_unit=mysqli_real_escape_string($conn,$_REQUEST['final_bill_unit']);
		$final_bill_mobile=mysqli_real_escape_string($conn,$_REQUEST['final_bill_mobile']);
		$created_by=mysqli_real_escape_string($conn,$_REQUEST['created_by']);
		$created_on=mysqli_real_escape_string($conn,$_REQUEST['created_on']);
		
		/*Update Document File*/
		/*Update Document File*/
		if(!empty($_FILES["hospital_pic"]["name"]))
		{
			//New Added extension
			$file_ext=strtolower(end(explode('.',$_FILES["hospital_pic"]["name"]))); 
			$sql_ext="SELECT `file_extension_name` FROM `file_format_extension` WHERE `image_flag` ='1'  ORDER BY `file_extension_name` ASC";
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
				 $hospital_pic='';
				 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";
			  }else{ //New Added extension
				$rand8=rand(1,999999);
				$target_dir8 = "upload/hospital_pic/";
				$hospital_pic =$rand8.basename($_FILES["hospital_pic"]["name"]);
				if(move_uploaded_file($_FILES["hospital_pic"]["tmp_name"],  $target_dir8 .$hospital_pic)) 
				{
				$msg2="The file ". basename( $_FILES["hospital_pic"]["name"]). " has been uploaded.";
				} 
				else
				{
				$hospital_pic=$_REQUEST['hospital_pic'];
				}
			 }//New Added extension
		}	
		else
		{
		$hospital_pic=$_REQUEST['hospital_pic'];
		}
		if(!empty($_FILES["hospital_logo"]["name"]))
		{
			//New Added extension
			$file_ext=strtolower(end(explode('.',$_FILES["hospital_logo"]["name"]))); 
			$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`  WHERE `image_flag` ='1' ORDER BY `file_extension_name` ASC";
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
				 $hospital_logo='';
				 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";
			  }else{ //New Added extension
				$rand8=rand(1,999999);
				$target_dir8 = "upload/hospital_logo/";
				$hospital_logo =$rand8.basename($_FILES["hospital_logo"]["name"]);
				if(move_uploaded_file($_FILES["hospital_logo"]["tmp_name"],  $target_dir8 .$hospital_logo)) 
				{
				$msg2="The file ". basename( $_FILES["hospital_logo"]["name"]). " has been uploaded.";
				} 
				else
				{
				$hospital_logo=$_REQUEST['hospital_logo'];
				}
			 }//New Added extension
		}	
		else
		{
		$hospital_logo=$_REQUEST['hospital_logo'];
		}
		
		if(!empty($_FILES["left_side_logo"]["name"]))
		{
			//New Added extension
			$file_ext=strtolower(end(explode('.',$_FILES["left_side_logo"]["name"]))); 
			$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`  WHERE `image_flag` ='1' ORDER BY `file_extension_name` ASC";
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
				 $left_side_logo='';
				 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";
			  }else{ //New Added extension
				$rand8=rand(1,999999);
				$target_dir8 = "upload/left_side_logo/";
				$left_side_logo =$rand8.basename($_FILES["left_side_logo"]["name"]);
				if(move_uploaded_file($_FILES["left_side_logo"]["tmp_name"],  $target_dir8 .$left_side_logo)) 
				{
				$msg2="The file ". basename( $_FILES["left_side_logo"]["name"]). " has been uploaded.";
				} 
				else
				{
				$left_side_logo=$_REQUEST['left_side_logo'];
				}
			 }//New Added extension
		}	
		else
		{
		$left_side_logo=$_REQUEST['left_side_logo'];
		}
		
		if(!empty($_FILES["right_side_logo"]["name"]))
		{
			//New Added extension
			$file_ext=strtolower(end(explode('.',$_FILES["right_side_logo"]["name"]))); 
			$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`  WHERE `image_flag` ='1' ORDER BY `file_extension_name` ASC";
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
				 $right_side_logo='';
				 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";
			  }else{ //New Added extension
				$rand8=rand(1,999999);
				$target_dir8 = "upload/right_side_logo/";
				$right_side_logo =$rand8.basename($_FILES["right_side_logo"]["name"]);
				if(move_uploaded_file($_FILES["right_side_logo"]["tmp_name"],  $target_dir8 .$right_side_logo)) 
				{
				$msg2="The file ". basename( $_FILES["right_side_logo"]["name"]). " has been uploaded.";
				} 
				else
				{
				$right_side_logo=$_REQUEST['right_side_logo'];
				}
			 }//New Added extension
		}	
		else
		{
		$right_side_logo=$_REQUEST['right_side_logo'];
		}
		/*End Upload File*/
		$sql = "INSERT INTO `hospital_info_masters` SET `hospital_name`='".$hospital_name."', `address`='".$address."', `phone`='".$phone."', `mobile`='".$mobile."', `email`='".$email."', `hospital_unit`='".$hospital_unit."', `gst_in`='".$gst_in."', `drug_licence`='".$drug_licence."', `hos_reg_no`='".$hos_reg_no."', `website`='".$website."', `final_bill_unit`='".$final_bill_unit."', `final_bill_mobile`='".$final_bill_mobile."', `hospital_pic`='".$hospital_pic."', `hospital_logo`='".$hospital_logo."',`created_by`='".$created_by."',`created_on`='".$created_on."', `left_side_logo`='".$left_side_logo."', `right_side_logo`='".$right_side_logo."'";
		if($conn->query($sql)===TRUE)
		{
		$flg=0;
		$msg="New record created successfully";
		$redirectUrl=ADMIN_URL.'hospital_info_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'hospital_info_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
}

//Delete Data
if(isset($_REQUEST['delete']))
{
	$deleted_by=$_SESSION['id'];
	$deleted_time=date('Y-m-d H:i:s');
	$sql = "UPDATE `hospital_info_masters` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `id`='".$_REQUEST['delete']."'";
	$result=$conn->query($sql);
	if ($conn->query($sql) === TRUE)
	{
	$flg=0;
	$msg= "Record deleted successfully";
	$redirectUrl=ADMIN_URL.'hospital_info_masters.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
	else 
	{
	$flg=1;
	$msg= "Error deleting record: " . $conn->error;
	$redirectUrl=ADMIN_URL.'hospital_info_masters.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
} 
?>
<?php include "header.php"; ?>

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
          <li class="active"> Masters </li>
        </ul>
      </div>
      <!-- END PAGE TITLE --> 
    </div>
  </div>
  <!-- END PAGE HEAD -->
  <?php 
				 $today='2020-02-18';
				 //$today=date('Y-m-d');
				 $total_count=0;
				$sql="SELECT COUNT(DISTINCT `id`) AS `total_count` FROM `hospital_info_masters` WHERE `del_flag`='0'";
				$result=$conn->query($sql) ;				
				$row = $result->fetch_assoc();
				$total_count=$row['total_count'];					 
			 ?>
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Hospotal Info Master</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats">
                <div class="col-md-11 col-sm-11 col-xs-11" style="border:none !important">
                  <?php if($total_count=='0'){?>
                  <a href="#draggable" id="add_new" class="btn btn-sm blue" data-toggle="modal" title="ADD NEW">+ Add New</a>
                  <?php } ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Records:</strong> <?php echo $total_count;?></div>
                <div class="col-md-1 col-sm-1 col-xs-1 table-toolbar">
                  <div class="btn-group pull-right"> 
                    <!--<button class="btn btn-sm grey-cascade dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i> </button>
                    <ul class="dropdown-menu pull-right">
                      <li> <a href="#" onclick="window.print();return false;"> Print </a> </li>
                      <li> <a href="javascript:;"> Save as PDF </a> </li>
                      <li> <a href="javascript:;"> Export to Excel </a> </li>
                    </ul>--> 
                  </div>
                </div>
              </div>
              <div class="row number-stats" >
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>
                  <button class="close" data-close="alert"></button>
                  <span>
                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?>
                  </span> </div>
              </div>
            </div>
            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
              <p style="text-align:right">Search By Name</p>
              <thead>
                <tr>
                  <th>Sl. No</th>
                  <th>Hospital Name</th>
                  <th>Details</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				  $sql3="SELECT * FROM `hospital_info_masters` WHERE `del_flag`='0' ORDER BY `id` DESC LIMIT 1";
				  $result3=$conn->query($sql3) ;
				  $id=1;
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
					 ?>
                <tr >
                  <td><?php echo $id; ?></td>
                  <td><?php echo $row3['hospital_name']; ?></td>
                  <td><b>Created By: </b><?php echo $created_by; ?> <br/>
                    <b>Created On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['created_on'])); ?> <br/>
                    <?php if($row3['modified_time']!=''){ ?>
                    <b>Last Modified By: </b><?php echo $modified_by; ?> <br/>
                    <b>Modified On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['modified_time'])); ?>
                    <?php } ?></td>
                  <td><a onClick="check('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" ><i class="fa fa-edit" title="Edit"></i> </a> | <a onClick="javascript: return confirm(\'Please confirm deletion\');" href="?delete=<?php echo $row3['id'];  ?>"><i class="fa fa-trash" title="Delete"></i> </a></td>
                </tr>
                <?php 
				  $id++; }?>
              </tbody>
            </table>
            
            <!--Modal-->
            <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
              <div class="modal-dialog" id="model_header" style="width: 1200px !important;">
                <div class="modal-content" style="width:1190px !important;"> 
                  <!-- <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                         <h4 class="modal-title"><strong>Add New Doctor</strong></h4>
                        </div>-->
                  <div class="modal-body">
                    <div class="portlet box blue-hoki">
                      <div class="portlet-title" >
                        <div class="caption"> <i class="fa fa-gift"></i>Add / Edit Hospital Details</div>
                      </div>
                      <div class="portlet-body form"> 
                        <!-- BEGIN FORM-->
                        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                          <div class="form-body">
                            <div class="form-group">
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Hospital Name</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="hospital_name" id="hospital_name" class="form-control" placeholder="Enter text" autocomplete="off" />
                                        <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />
                                        <input type="hidden" name="created_by" id="created_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />
                                        <input type="hidden" name="created_on" id="created_on" class="form-control" placeholder="Enter id" value="<?php echo date('Y-m-d H:i:s');?>" />
                                        <input type="hidden" name="modified_by" id="modified_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />
                                        <input type="hidden" name="modified_time" id="modified_time" class="form-control" placeholder="Enter id" value="<?php echo  date('Y-m-d H:i:s');?>" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Drug Licence</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="drug_licence" id="drug_licence" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Address</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <textarea name="address" id="address" class="form-control" placeholder="Enter text" rows="" cols=""></textarea>
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Hospital Reg No.</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="hos_reg_no" id="hos_reg_no" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Tel / Fax:</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Website</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="website" id="website" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Mobile No.</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>E-mail ID</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Facebook Link</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="hospital_unit" id="hospital_unit" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Hospital Unit(Print Out)</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <textarea name="final_bill_unit" id="final_bill_unit" class="form-control" placeholder="Enter text" rows="" cols=""></textarea>
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>GST IN</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="gst_in" id="gst_in" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Hospital Mobile(Print Out)</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="text" name="final_bill_mobile" id="final_bill_mobile" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block"></span> </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Hospital Logo (69 x 69 px)</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="hidden" name="hospital_logo" id="hospital_logo" class="form-control" placeholder="Enter text" autocomplete="off" />
                                        <input type="file" name="hospital_logo" id="hospital_logo" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block" id="hospital_logo_span_title" style="font-weight:bold;color:#900;display:none;">Uploaded <a href="" name="hospital_logo_download_file" id="hospital_logo_download_file"  download ><img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" title="Download"  ></a></span></div>
                                  </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Hospital Picture (400 x 60 px)</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="hidden" name="hospital_pic" id="hospital_pic" class="form-control" placeholder="Enter text" autocomplete="off" />
                                        <input type="file" name="hospital_pic" id="hospital_pic" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block" id="hospital_pic_span_title" style="font-weight:bold;color:#900;display:none;">Uploaded <a href="" name="hospital_pic_download_file" id="hospital_pic_download_file"  download ><img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" title="Download"  ></a></span> </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group" id="hospital_logo_img_div" style="display:none;padding:0 60px 0 60px;">
                                    <div class="col-md-12"> <img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" id="hospital_logo_img" title="Hospital Logo" > </div>
                                  </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group" id="hospital_pic_img_div" style="display:none;padding:0 60px 0 60px;">
                                    <div class="col-md-12"> <img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" id="hospital_pic_img" title="Hospital Picture" width="280px"  height="180px"> </div>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-md-12"><div class="col-md-6">
                                  <div class="form-group"><p>&nbsp;<br /></p></div></div></div>
                            
                             <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group">
                                  <label class="col-md-4 control-label"><strong>Print Out Left Side<br />
                                    Logo (125 x 111 px)</strong></label>
                                  <div class="col-md-8">
                                    <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                      <input type="hidden" name="left_side_logo" id="left_side_logo" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      <input type="file" name="left_side_logo" id="left_side_logo" class="form-control" placeholder="Enter text" autocomplete="off" />
                                    </div>
                                    <span class="help-block" id="left_side_logo_span_title" style="font-weight:bold;color:#900;display:none;">Uploaded <a href="" name="left_side_logo_download_file" id="left_side_logo_download_file"  download ><img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" title="Download"  ></a></span></div>
                                </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Print Out Right Side <br/>
                                      Logo (125 x 111 px)</strong></label>
                                    <div class="col-md-8">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        <input type="hidden" name="right_side_logo" id="right_side_logo" class="form-control" placeholder="Enter text" autocomplete="off" />
                                        <input type="file" name="right_side_logo" id="right_side_logo" class="form-control" placeholder="Enter text" autocomplete="off" />
                                      </div>
                                      <span class="help-block" id="right_side_logo_span_title" style="font-weight:bold;color:#900;display:none;">Uploaded <a href="" name="right_side_logo_download_file" id="right_side_logo_download_file"  download ><img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" title="Download"  ></a></span></div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group" id="left_side_logo_img_div" style="display:none;padding:0 60px 0 60px;">
                                    <div class="col-md-12"> <img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" id="left_side_logo_img" title="Left Side Logo"   > </div>
                                  </div>
                                </div>
                                <div class="col-md-6" >
                                  <div class="form-group" id="right_side_logo_img_div" style="display:none;padding:0 60px 0 60px;">
                                    <div class="col-md-12"> <img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" id="right_side_logo_img" title="Left Right Logo"> </div>
                                  </div>
                                </div>
                              </div>
                              
                              
                            </div>
                            
                          </div>
                          <div class="form-actions top">
                                <div class="row">
                                  <div class="col-md-offset-4 col-md-7" style="margin-left: 41.333333% !important;">
                                    <button type="submit" name="submit" id="submit" class="btn green">Submit</button>
                                    <!--<button type="button" class="btn default">Cancel</button>-->
                                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                        </form>
                        
                        <!-- END FORM--> 
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.modal-content --> 
              </div>
              <!-- /.modal-dialog --> 
            </div>
            
            <!--Modal End--> 
            
          </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET--> 
      </div>
    </div>
    <!-- END PAGE CONTENT INNER --> 
  </div>
</div>
<!-- END PAGE CONTENT --> 
<!-- END PAGE CONTAINER --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script type="text/javascript"> 
      $(document).ready( function() {       
		setTimeout('$("#alert_msg").hide()',3000);
				
			$("#add_new").click(function(){
				var empty='';
				$("#hospital_name").val(empty);
				$("#address").val(empty);
				$("#phone").val(empty);
				$("#mobile").val(empty);
				$("#email").val(empty);
				$("#hospital_unit").val(empty);
				$("#gst_in").val(empty);
				$("#drug_licence").val(empty);
				$("#hos_reg_no").val(empty);
				$("#website").val(empty);
				$("#final_bill_unit").val(empty);
				$("#final_bill_mobile").val(empty);
				$("#hospital_pic").val(empty);
				$("#hospital_logo").val(empty);
				$("#left_side_logo").val(empty);
				$("#right_side_logo").val(empty);
				$("#id").val(empty);				
				});
      });
function check(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/hospital_info_masters_ajax.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {						
							//alert(data.flag);
							try{
								
								 $('#draggable').modal('show');								
								 $("#hospital_name").val(data.hospital_name);
								  $("#address").val(data.address);
								  $("#phone").val(data.phone);
								  $("#mobile").val(data.mobile);
								  $("#email").val(data.email);
								  $("#hospital_unit").val(data.hospital_unit);
								  $("#gst_in").val(data.gst_in);
								  $("#drug_licence").val(data.drug_licence);
								  $("#hos_reg_no").val(data.hos_reg_no);
								  $("#website").val(data.website);								  
								  $("#final_bill_unit").val(data.final_bill_unit);
								  $("#final_bill_mobile").val(data.final_bill_mobile);
								  $("#hospital_pic").val(data.hospital_pic);
								  $("#hospital_logo").val(data.hospital_logo);
								  $("#left_side_logo").val(data.left_side_logo);
								  $("#right_side_logo").val(data.right_side_logo);
								  if((data.hospital_pic)!=''){
									  $("#hospital_pic_span_title").css("display","block");
									  $("#hospital_pic_img_div").css("display","block");
									   $('#hospital_pic_img').attr('src','<?php echo  ADMIN_URL.'upload/hospital_pic/'?>'+data.hospital_pic);
									   $('#hospital_pic_download_file').attr('href','<?php echo  ADMIN_URL.'upload/hospital_pic/'?>'+data.hospital_pic);
								  }else{
									  $("#hospital_pic_span_title").css("display","none");
									  $("#hospital_pic_img_div").css("display","none");
								  }
								  if((data.hospital_logo)!=''){
									  $("#hospital_logo_span_title").css("display","block");
									  $("#hospital_logo_img_div").css("display","block");
									   $('#hospital_logo_img').attr('src','<?php echo  ADMIN_URL.'upload/hospital_logo/'?>'+data.hospital_logo);
									   $('#hospital_logo_download_file').attr('href','<?php echo  ADMIN_URL.'upload/hospital_logo/'?>'+data.hospital_logo);
								  }else{
									  $("#hospital_logo_span_title").css("display","none");
									  $("#hospital_logo_img_div").css("display","none");
								  } 
								  if((data.left_side_logo)!=''){
									  $("#left_side_logo_span_title").css("display","block");
									  $("#left_side_logo_img_div").css("display","block");
									   $('#left_side_logo_img').attr('src','<?php echo  ADMIN_URL.'upload/left_side_logo/'?>'+data.left_side_logo);
									   $('#left_side_logo_download_file').attr('href','<?php echo  ADMIN_URL.'upload/left_side_logo/'?>'+data.left_side_logo);
								  }else{
									  $("#left_side_logo_span_title").css("display","none");
									  $("#left_side_logo_img_div").css("display","none");
								  }
								  if((data.right_side_logo)!=''){
									  $("#right_side_logo_span_title").css("display","block");
									  $("#right_side_logo_img_div").css("display","block");
									   $('#right_side_logo_img').attr('src','<?php echo  ADMIN_URL.'upload/right_side_logo/'?>'+data.right_side_logo);
									   $('#right_side_logo_download_file').attr('href','<?php echo  ADMIN_URL.'upload/right_side_logo/'?>'+data.right_side_logo);
								  }else{
									  $("#right_side_logo_span_title").css("display","none");
									  $("#right_side_logo_img_div").css("display","none");
								  }
								 $("#id").val(data.id);								
								
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
	  
</script>
<?php include "footer.php" ?>
