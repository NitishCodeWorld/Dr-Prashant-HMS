<?php include 'conn.php'; ?>

<?php 

//Add Code

if(isset($_REQUEST['submit']))

{

	// New Data Add

	if($_REQUEST['id']!=''){	

		$name=mysqli_real_escape_string($conn,$_REQUEST['name']);

		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);

		$modified_by=mysqli_real_escape_string($conn,$_REQUEST['modified_by']);

		$modified_time=mysqli_real_escape_string($conn,$_REQUEST['modified_time']);

		$sql = "UPDATE `insurance_masters` SET `name`='".$name."',`modified_by`='".$modified_by."' ,`modified_time`='".$modified_time."' WHERE `id`='".$id."'";

		if($conn->query($sql)===TRUE)

		{

		$msg="Record updated successfully";

		$flg=0;

		$redirectUrl=ADMIN_URL.'insurance_masters.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

		}

		else

		{

		$flg=1;

		$msg="Error:".$sql."<br>".$conn->error;

		$redirectUrl=ADMIN_URL.'insurance_masters.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

		}

	}

	//Edit Data

	else{

		$name=mysqli_real_escape_string($conn,$_REQUEST['name']);

		$created_by=mysqli_real_escape_string($conn,$_REQUEST['created_by']);

		$created_on=mysqli_real_escape_string($conn,$_REQUEST['created_on']);

		//$sql = "INSERT INTO `insurance_masters`(`name`) VALUES ('".$name."')";

		$sql = "INSERT INTO `insurance_masters` SET `name`='".$name."',`created_by`='".$created_by."',`created_on`='".$created_on."' ";	

		if($conn->query($sql)===TRUE)

		{

		$flg=0;

		$msg="New record created successfully";

		$redirectUrl=ADMIN_URL.'insurance_masters.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

		}

		else

		{

		$flg=1;

		$msg="Error:".$sql."<br>".$conn->error;

		$redirectUrl=ADMIN_URL.'insurance_masters.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

		}

	}

} 

//Delete Data

if(isset($_REQUEST['delete']))

{

	//$sql = "DELETE FROM `insurance_masters` WHERE `id`='".$_REQUEST['delete']."'";

	$deleted_by=$_SESSION['id'];

	$deleted_time=date('Y-m-d H:i:s');

	$sql = "UPDATE `insurance_masters` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `id`='".$_REQUEST['delete']."'";

	$result=$conn->query($sql);

	if ($conn->query($sql) === TRUE)

	{

	$flg=0;

	$msg= "Record deleted successfully";

	$redirectUrl=ADMIN_URL.'insurance_masters.php?msg='.$msg.'&flg='.$flg;

	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

	}

	else 

	{

	$flg=1;

	$msg= "Error deleting record: " . $conn->error;

	$redirectUrl=ADMIN_URL.'insurance_masters.php?msg='.$msg.'&flg='.$flg;

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

          <li> <a href="<?php echo ADMIN_URL; ?>insurance_masters.php">Home</a><i class="fa fa-circle"></i> </li>

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

				$sql="SELECT COUNT(DISTINCT `id`) AS `total_count` FROM `insurance_masters`";

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

              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Insurance</span></div>

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

                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?>

                  </span> </div>

              </div>

            </div>

            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

              <p style="text-align:right">Search By Name</p>

              <thead>

                <tr>

                  <th>Sl. No</th>

                  <th>Insurance</th>

                  <th>Details</th>

                  <th>Action</th>

                </tr>

              </thead>

              <tbody>

                <?php 

				  $sql3="SELECT `id`, `name`,`created_by`, `created_on`, `modified_by`, `modified_time`, `del_flag`, `deleted_by`, `deleted_time` FROM `insurance_masters` WHERE  `del_flag`='0' ORDER BY `id` DESC";

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

                  <td><?php echo $row3['name']; ?></td>

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

              <div class="modal-dialog" id="model_header">

                <div class="modal-content"> 

                  <!-- <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                         <h4 class="modal-title"><strong>Add New Doctor</strong></h4>

                        </div>-->

                  <div class="modal-body">

                    <div class="portlet box blue-hoki">

                      <div class="portlet-title" >

                        <div class="caption"> <i class="fa fa-gift"></i>Add / Edit Insurance</div>

                      </div>

                      <div class="portlet-body form"> 

                        <!-- BEGIN FORM-->

                        <form action="" method="post" class="form-horizontal">

                          <div class="form-body">

                            <div class="form-group">

                              <label class="col-md-4 control-label">Insurance</label>

                              <div class="col-md-7">

                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>

                                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter text" required/>

                                  <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />

                                  <input type="hidden" name="created_by" id="created_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />

                                  <input type="hidden" name="created_on" id="created_on" class="form-control" placeholder="Enter id" value="<?php echo date('Y-m-d H:i:s');?>" />

                                  <input type="hidden" name="modified_by" id="modified_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />

                                  <input type="hidden" name="modified_time" id="modified_time" class="form-control" placeholder="Enter id" value="<?php echo  date('Y-m-d H:i:s');?>" />

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
<!-- END PAGE CONTAINER --> 

<script src="<?php echo ADMIN_URL; ?>newjs/jquery.min.js"></script> 

<script type="text/javascript"> 
$(document).ready( function() { 
	setTimeout('$("#alert_msg").hide()',3000);
	$("#add_new").click(function(){
		var empty='';
		$("#name").val(empty);
		$("#id").val(empty);
		});
});

function check(id){
		$.ajax({

						type : "POST",

						url : "<?php echo ADMIN_URL; ?>ajax/insurance_masters_ajax.php",

						dataType : "json", 

						data : "id="+id,

						success : function(data) {						

								 $('#draggable').modal('show'); 								

								 $("#name").val(data.name);

								 $("#id").val(data.id);	
						}

					});
}

	  

</script>

<?php include "footer.php" ?>

