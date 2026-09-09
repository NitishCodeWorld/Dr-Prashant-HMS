<?php include 'conn.php'; ?>
<?php 

//Add Code

if(isset($_REQUEST['submit']))

{

	// Edit Data

	if($_REQUEST['id']!=''){			

		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);

		$doctor_name=mysqli_real_escape_string($conn,$_REQUEST['doctor_name']);		

		$doctor_email=mysqli_real_escape_string($conn,$_REQUEST['doctor_email']);

		$doctor_mob=mysqli_real_escape_string($conn,$_REQUEST['doctor_mob']);
		$doctor_ini=mysqli_real_escape_string($conn,$_REQUEST['doctor_ini']);

		$sql = "UPDATE `doctor_masters_for_emr` SET `doctor_name`='".$doctor_name."',`doctor_email`='".$doctor_email."',`doctor_mob`='".$doctor_mob."' ,`doctor_ini`='".$doctor_ini."' WHERE `id`='".$id."'";

		if($conn->query($sql)===TRUE)

		{

		$msg="Record updated successfully";

		$flg=0;

		$redirectUrl=ADMIN_URL.'doctor_masters_for_emr.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

		}

		else

		{

		$flg=1;

		$msg="Error:".$sql."<br>".$conn->error;

		$redirectUrl=ADMIN_URL.'doctor_masters_for_emr.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

		}

	}

	//Add Data

	else{

		

		$doctor_name=mysqli_real_escape_string($conn,$_REQUEST['doctor_name']);		

		$doctor_email=mysqli_real_escape_string($conn,$_REQUEST['doctor_email']);

		$doctor_mob=mysqli_real_escape_string($conn,$_REQUEST['doctor_mob']);	
		$doctor_ini=mysqli_real_escape_string($conn,$_REQUEST['doctor_ini']);

		$sql = "INSERT INTO `doctor_masters_for_emr` SET `doctor_name`='".$doctor_name."',`doctor_email`='".$doctor_email."',`doctor_mob`='".$doctor_mob."' ,`doctor_ini`='".$doctor_ini."' ";		

		

		if($conn->query($sql)===TRUE)

		{

		$flg=0;

		$msg="New record created successfully";

		$redirectUrl=ADMIN_URL.'doctor_masters_for_emr.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

		}

		else

		{

		$flg=1;

		$msg="Error:".$sql."<br>".$conn->error;

		$redirectUrl=ADMIN_URL.'doctor_masters_for_emr.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

		}

	}

} 

//Delete Data

if(isset($_REQUEST['delete']))

{	

	$deleted_by=$_SESSION['id'];

	$deleted_time=date('Y-m-d H:i:s');

	$sql = "UPDATE `doctor_masters_for_emr` SET `del_flag`='1' WHERE `id`='".$_REQUEST['delete']."'";

	$result=$conn->query($sql);

	if ($conn->query($sql) === TRUE)

	{

	$flg=0;

	$msg= "Record deleted successfully";

	$redirectUrl=ADMIN_URL.'doctor_masters_for_emr.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

	}

	else 

	{

	$flg=1;

	$msg= "Error deleting record: " . $conn->error;

	$redirectUrl=ADMIN_URL.'doctor_masters_for_emr.php?msg='.$msg.'&flg='.$flg;

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

				$sql="SELECT COUNT(DISTINCT `id`) AS `total_count` FROM `doctor_masters_for_emr`  ";

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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Referred Doctor Master</span></div>
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
                    <th>Doctor Name</th>
                    <th>INI</th>
                    <th>Ph No</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

				  $sql3="SELECT `id`, `doctor_name`, `doctor_email`, `doctor_mob`, `del_flag`,`doctor_ini` FROM `doctor_masters_for_emr` WHERE `del_flag`='0'  ORDER BY `id` DESC";

				  $result3=$conn->query($sql3) ;

				  $id=1;

				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

				 {

					 

					 ?>
                  <tr style="background-color:<?php echo $rowclass; ?>;font-family: 'Lucida Console', 'Courier New', monospace; " >
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row3['doctor_name']; ?></td>
                    <td><?php echo $row3['doctor_ini']; ?></td>
                    <td><?php echo $row3['doctor_mob']; ?></td>
                    <td><a onClick="edit('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" ><img src="<?php echo ADMIN_URL; ?>icon/bt_edit.gif"  title="Edit "> </a> | <a onClick="if(confirm('Are you sure to delete?')) return true; else return false;" href="?delete=<?php echo $row3['id'];  ?>"><img src="<?php echo ADMIN_URL; ?>icon/delete.gif"  title="Delete"> </a></td>
                  </tr>
                  <?php 

				  $id++; }?>
                </tbody>
              </table>
              
              <!--Modal-->
              
              <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog" id="model_header">
                  <div class="modal-content">
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
                                <label class="col-md-4 control-label">Referred Doctor Name</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="text" name="doctor_name" id="doctor_name" class="form-control" placeholder="Enter text" required />
                                    <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label">INI</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="text" name="doctor_ini" id="doctor_ini" class="form-control" placeholder="Enter text"  />
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label">Email ID</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="text" name="doctor_email" id="doctor_email" class="form-control" placeholder="Enter text"  />
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-4 control-label">Phone No.</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="text" name="doctor_mob" id="doctor_mob" class="form-control" placeholder="Enter text"  />
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-actions top">
                              <div class="row">
                                <div class="col-md-offset-4 col-md-7">
                                  <button type="submit" name="submit" id="submit" class="btn green">Submit</button>
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

				var ety='0';			

				$("#id").val(empty);	

				$("#doctor_name").val(empty);
				$("#doctor_ini").val(empty);

				$("#doctor_mob").val(empty);		

				$("#doctor_email").val(empty);									

				});

      });

function edit(id){



try{

		//alert(id);

		$.ajax({

						type : "POST",

						url : "<?php echo ADMIN_URL; ?>ajax_for_emr/doctor_masters_ajax_for_emr.php",

						dataType : "json", 

						data : "id="+id,

						success : function(data) {						

							//alert(data.flag);

							try{ 

								 $('#draggable').modal('show');	

								 $("#id").val(data.id);	

								 $("#doctor_name").val(data.doctor_name);	
								 $("#doctor_ini").val(data.doctor_ini);

								 $("#doctor_mob").val(data.doctor_mob);		

								 $("#doctor_email").val(data.doctor_email);						 						 

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

<!-- END JAVASCRIPTS -->

</body><!-- END BODY -->

</html>