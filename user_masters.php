<?php include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
		
		$username=mysqli_real_escape_string($conn,$_REQUEST['username']);
		$password=mysqli_real_escape_string($conn,$_REQUEST['password']);
		$role=mysqli_real_escape_string($conn,$_REQUEST['role']);
		$created_by=mysqli_real_escape_string($conn,$_REQUEST['created_by']);
		$created_on=mysqli_real_escape_string($conn,$_REQUEST['created_on']);
		$name=mysqli_real_escape_string($conn,$_REQUEST['name']);
		$phone_no=mysqli_real_escape_string($conn,$_REQUEST['phone_no']);
		$address=mysqli_real_escape_string($conn,$_REQUEST['address']);
		$email_id=mysqli_real_escape_string($conn,$_REQUEST['email_id']);
		
$sql14='SELECT * FROM `users` WHERE `username`="'.$username.'" ';
$result14=$conn->query($sql14) ;
$count14=$result14->num_rows;
if($count14==0)
{
		
		$sql = "INSERT INTO `users` SET `username`='".$username."',`password`='".$password."',`role`='".$role."',`created_by`='".$created_by."' ,`created_on`='".$created_on."' ";		
		
		if($conn->query($sql)===TRUE)
		{
		$users_id = $conn->insert_id;
		$sql12 = $conn->query("INSERT INTO  `user_infos` SET `name` = '".$name."',`phone_no` = '".$phone_no."',`address` = '".$address."',`email_id` = '".$email_id."',`users_id` = '".$users_id."',`created_on`='".$created_on."' ");
		$flg=0;
		$msg="New record created successfully";
		$redirectUrl=ADMIN_URL.'user_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'user_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
}
else{
	$flg=1;
	$msg="Record is not inserted successfully. Login ID is already exist!!!!";
		$redirectUrl=ADMIN_URL.'user_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
}
	
} 
//Delete Data
if(isset($_REQUEST['delete']))
{	
	$deleted_by=$_SESSION['id'];
	$deleted_time=date('Y-m-d H:i:s');
	$sql = "UPDATE `users` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `id`='".$_REQUEST['delete']."'";
	$result=$conn->query($sql);
	if ($conn->query($sql) === TRUE)
	{
	$flg=0;
	$msg= "Record deleted successfully";
	$redirectUrl=ADMIN_URL.'user_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
	else 
	{
	$flg=1;
	$msg= "Error deleting record: " . $conn->error;
	$redirectUrl=ADMIN_URL.'user_masters.php?msg='.$msg.'&flg='.$flg;
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
        <h1><small>Welcome to EMR Dashboard</small></h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
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
				$sql="SELECT COUNT(DISTINCT `id`) AS `total_count` FROM `users` ";
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">User Create</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats">
                <div class="col-md-11 col-sm-11 col-xs-11" style="border:none !important"><a href="#draggable" id="add_new" class="btn btn-sm blue" data-toggle="modal" title="ADD NEW">+ Add New</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Records:</strong> <?php echo $total_count;?></div>
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
                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg']; echo '</div>';}?>
                  </span> </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <p style="text-align:right">Search By Name</p>
                <thead>
                  <tr>
                    <th>Sl. No</th>
                    <th>Login ID Name</th>
                    <th>Name</th>
                    <th>Phone No & Email ID & Address</th>
                    <th>Role</th>
                    <th>Details</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
				  $swhere=" 1 ";
				  if($_SESSION['role']=='2'){
					$swhere="  `users`.`role`<>'1' ";  
				  }
				  $sql3="SELECT  `users`.`id`,`users`.`username`, `users`.`password`, `users`.`role`, `users`.`del_flag`, `users`.`created_by`, `users`.`created_on`, `users`.`deleted_by`, `users`.`deleted_time`, `users`.`modified_by`, `users`.`modified_time`,`user_infos`.`name`, `user_infos`.`address`, `user_infos`.`phone_no`, `user_infos`.`email_id` FROM `users` INNER JOIN `user_infos` ON `users`.`id`= `user_infos`.`users_id` WHERE  $swhere ORDER BY `users`.`id` DESC";
				  $result3=$conn->query($sql3) ;
				  $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {
					 $created_by="None";
					 $modified_by="None";
					 $deleted_by="None";
					 $role="None";
					 $status="None";
					 if($row3['role']=='1'){
						 $role="Super Admin";
					 }
					 if($row3['role']=='2'){
						 $role="Admin";
					 }
					 if($row3['role']=='3'){
						 $role="Reception";
					 }
					 if($row3['role']=='4'){
						 $role="OT";
					 }
					 if($row3['role']=='5'){
						 $role="Store";
					 }
					 if($row3['role']=='6'){
						 $role="Optical";
					 }
					 if($row3['role']=='7'){
						 $role="Pharmacy";
					 }
					 if($row3['role']=='8'){
						 $role="Satelite center";
					 }
					 if($row3['del_flag']=='0'){
						 $status="Active";
					 }
					 if($row3['del_flag']=='1'){
						 $status="Inactive";
					 }
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
					 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['deleted_by']."'";
					 $result9=$conn->query($sql9) ;				
					 $row9 = $result9->fetch_assoc();
					 $count9=$result9->num_rows;
					 if($count9>0)
					 {
					 	$deleted_by=$row9['name'];
					 }
					 if($row3['del_flag']=='0'){
							$rowclass="#d0e9c6";
						}
						else{
							$rowclass="#ebcccc";
						}					
					 ?>
                  <tr style="background-color:<?php echo $rowclass; ?>; font-family: 'Lucida Console', 'Courier New', monospace;" >
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row3['username']; ?></td>
                    <td><?php echo $row3['name']; ?></td>
                    <td><b>Phone No.: </b><?php echo $row3['phone_no']; ?> <br/>
                      <b>Email ID: </b><?php echo $row3['email_id']; ?> <br/>
                      <b>Address: </b><?php echo $row3['address']; ?> <br/></td>
                    <td><?php echo $role; ?></td>
                    <td><b>Status: <?php echo $status; ?> </b><br/>
                      <b>Created By: </b><?php echo $created_by; ?> <br/>
                      <b>Created On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['created_on'])); ?> <br/>
                      <?php if($row3['modified_time']!=''){ ?>
                      <b>Last Modified By: </b><?php echo $modified_by; ?> <br/>
                      <b>Modified On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['modified_time'])); ?>
                      <?php } ?>
                      <br/>
                      <?php if($row3['deleted_time']!=''){ ?>
                      <b>Last Deleted By: </b><?php echo $deleted_by; ?> <br/>
                      <b>Deleted On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['deleted_time'])); ?>
                      <?php } ?></td>
                    <td><a onClick="javascript: return confirm(\'Please confirm deletion\');" href="?delete=<?php echo $row3['id'];  ?>"><img src="<?php echo ADMIN_URL; ?>icon/delete.gif"  title="Delete"> </a></td>
                  </tr>
                  <?php 
				  $id++; }?>
                </tbody>
              </table>
              
              <!--Modal-->
              <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog" id="model_header">
                  <div class="modal-content"> 
                    <!-- <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                         <h4 class="modal-title"><strong>Add New Doctor</strong></h4>
                        </div>-->
                    <div class="modal-body">
                      <div class="portlet box blue-hoki">
                        <div class="portlet-title" >
                          <div class="caption"> <i class="fa fa-gift"></i>Add / Edit </div>
                        </div>
                        <div class="portlet-body form"> 
                          <!-- BEGIN FORM-->
                          <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-body">
                              <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="text" name="name" id="name"  class="form-control" placeholder="Enter text" />
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label">Login ID </label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter text" autocomplete="new-password"/>
                                    <input type="hidden" name="created_by" id="created_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />
                                    <input type="hidden" name="created_on" id="created_on" class="form-control" placeholder="Enter id" value="<?php echo date('Y-m-d H:i:s');?>" />
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter text" autocomplete="new-password"/>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label">Role</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <select class="form-control" id="role" name="role" required>
                                      <?php if($_SESSION['role']=='1'){?>
                                      <option value="1">Super Admin</option>
                                      <option value="2">Admin</option>
                                      <option value="3">Reception</option>
                                      <option value="4">OT</option>
                                      <option value="5">Store</option>
                                      <option value="6">Optical</option>
                                      <option value="7">Pharmacy</option>
                                      <option value="8">Satelite center</option>
                                      <?php }?>
                                      <?php if($_SESSION['role']=='2'){?>
                                      <option value="2">Admin</option>
                                      <option value="3">Reception</option>
                                      <option value="4">OT</option>
                                      <option value="5">Store</option>
                                      <option value="6">Optical</option>
                                      <option value="7">Pharmacy</option>
                                      <option value="8">Satelite center</option>
                                      <?php }?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label">Email ID </label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="email" name="email_id" id="email_id" class="form-control" placeholder="Enter text" autocomplete="new-password"/>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label">Phone(10 Digit No.)</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="number" name="phone_no" id="phone_no" maxlength="10" class="form-control" placeholder="Enter text" />
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label">Address</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <textarea name="address" id="address"  class="form-control" placeholder="Enter text" ></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-actions top">
                              <div class="row">
                                <div class="col-md-offset-4 col-md-7">
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
</div>
<!-- END PAGE CONTAINER --> 
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript"> 

      $(document).ready( function() {       
		setTimeout('$("#alert_msg").hide()',10000);
				
			$("#add_new").click(function(){
				var empty='';				
				$("#id").val(empty);	
				$("#duration").val(empty);	
														
				});
      });

</script>
<?php include "footer.php" ?>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>