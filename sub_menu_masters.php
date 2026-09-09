<?php include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	// Edit Data 
	if($_REQUEST['id']!=''){	
		$sub_menu_name=mysqli_real_escape_string($conn,$_REQUEST['sub_menu_name']);
		$main_menu_id=mysqli_real_escape_string($conn,$_REQUEST['main_menu_id']);
		$url=mysqli_real_escape_string($conn,$_REQUEST['url']);
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);
		$modified_by=mysqli_real_escape_string($conn,$_REQUEST['modified_by']);
		$modified_time=mysqli_real_escape_string($conn,$_REQUEST['modified_time']);
		$function_click=mysqli_real_escape_string($conn,$_REQUEST['function_click']);
		$break_down_flag=mysqli_real_escape_string($conn,$_REQUEST['break_down_flag']);
		$sql = "UPDATE `sub_menu_masters` SET `sub_menu_name`='".$sub_menu_name."',`main_menu_id`='".$main_menu_id."',`url`='".$url."',`modified_by`='".$modified_by."' ,`modified_time`='".$modified_time."',`function_click`='".$function_click."',`break_down_flag`='".$break_down_flag."' WHERE `id`='".$id."'";
		if($conn->query($sql)===TRUE)
		{
		$msg="Record updated successfully";
		$flg=0;
		$redirectUrl=ADMIN_URL.'sub_menu_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'sub_menu_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
	//Add Data
	else{
		$sub_menu_name=mysqli_real_escape_string($conn,$_REQUEST['sub_menu_name']);
		$main_menu_id=mysqli_real_escape_string($conn,$_REQUEST['main_menu_id']);
		$url=mysqli_real_escape_string($conn,$_REQUEST['url']);
		$created_by=mysqli_real_escape_string($conn,$_REQUEST['created_by']);
		$created_on=mysqli_real_escape_string($conn,$_REQUEST['created_on']);
		$function_click=mysqli_real_escape_string($conn,$_REQUEST['function_click']);
		$break_down_flag=mysqli_real_escape_string($conn,$_REQUEST['break_down_flag']);
		$sql = "INSERT INTO `sub_menu_masters` SET `sub_menu_name`='".$sub_menu_name."',`main_menu_id`='".$main_menu_id."',`url`='".$url."',`created_by`='".$created_by."',`created_on`='".$created_on."',`function_click`='".$function_click."',`break_down_flag`='".$break_down_flag."'";
		if($conn->query($sql)===TRUE)
		{
		$flg=0;
		$msg="New record created successfully";
		$redirectUrl=ADMIN_URL.'sub_menu_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'sub_menu_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
} 
//Delete Data
if(isset($_REQUEST['delete']))
{
	$deleted_by=$_SESSION['id'];
	$deleted_time=date('Y-m-d H:i:s');
	$sql = "UPDATE `sub_menu_masters` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `id`='".$_REQUEST['delete']."'";
	$result=$conn->query($sql);
	if ($conn->query($sql) === TRUE)
	{
	$flg=0;
	$msg= "Record deleted successfully";
	$redirectUrl=ADMIN_URL.'sub_menu_masters.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
	else 
	{
	$flg=1;
	$msg= "Error deleting record: " . $conn->error;
	$redirectUrl=ADMIN_URL.'sub_menu_masters.php?msg='.$msg.'&flg='.$flg;
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
				$sql="SELECT COUNT(DISTINCT `id`) AS `total_count` FROM `sub_menu_masters` WHERE `del_flag`='0'";
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Sub Menu Master</span></div>
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
                  <th>Sub Menu Name</th>
                  <th>Main menu Name</th>
                  <th>File Name</th>
                  <th>Details</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				  $sql3="SELECT `sub_menu_masters`.*, `main_menu_masters`.`main_menu_name` FROM `sub_menu_masters` left join `main_menu_masters` on `main_menu_masters`.`id`=`sub_menu_masters`.`main_menu_id` WHERE `sub_menu_masters`.`del_flag`='0' ORDER BY `sub_menu_masters`.`id` DESC";
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
                  <td><?php echo $row3['sub_menu_name']; ?></td>
                  <td><?php echo $row3['main_menu_name']; ?></td>
                  <td><?php echo $row3['url']; ?>.php</td>
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
                        <div class="caption"> <i class="fa fa-gift"></i>Add New Menu</div>
                      </div>
                      <div class="portlet-body form"> 
                        <!-- BEGIN FORM-->
                        <form action="" method="post" class="form-horizontal">
                          <div class="form-body">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Sub Menu Name</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <input type="text" name="sub_menu_name" id="sub_menu_name" class="form-control" placeholder="Enter text" autocomplete="off" required/>
                                  <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />
                                  <input type="hidden" name="created_by" id="created_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />
                                  <input type="hidden" name="created_on" id="created_on" class="form-control" placeholder="Enter id" value="<?php echo date('Y-m-d H:i:s');?>" />
                                  <input type="hidden" name="modified_by" id="modified_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />
                                  <input type="hidden" name="modified_time" id="modified_time" class="form-control" placeholder="Enter id" value="<?php echo  date('Y-m-d H:i:s');?>" />
                                </div>
                                <span class="help-block"> A block of help text. </span> </div>
                                
                              <label class="col-md-4 control-label">Main Menu Name</label>
                              <div class="col-md-7">
                                <select name="main_menu_id" id="main_menu_id" class="form-control">
                                  <option value="">Choose..</option>
                                  <?php 
                                                  $sql7="SELECT `id`, `main_menu_name` FROM `main_menu_masters`  WHERE  `del_flag`='0' ORDER BY `id` ASC";
                                                 $result7=$conn->query($sql7) ;
                                                 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                                                 {									 
                                                     echo '<option value="'.$row7['id'].'" '; ; if($row3['main_menu_name']==$row7['id']) echo 'selected'; echo '>'.$row7['main_menu_name'].'</option>';
                                                 }
                                                ?>
                                </select>
                                <span class="help-block"> A block of help text. </span> </div>
                              <label class="col-md-4 control-label">File Name(Without ext)</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span> 
                                  <!-- readonly="readonly" -->
                                  <input type="text" name="url" id="url" class="form-control" placeholder="Enter text"   required/>
                                  <span class="input-group-addon">.php</span> </div>
                                <span class="help-block"> A block of help text. </span> </div>
                              	
                               <label class="col-md-4 control-label">Function Click</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <input type="text" name="function_click" id="function_click" class="form-control" placeholder="Enter text"   />
                                </div>
                                <span class="help-block"> A block of help text. </span> </div>
                                <label class="col-md-4 control-label">Break Down</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <select name="break_down_flag" id="break_down_flag" class="form-control">
                                  <option value="0" >No</option>
                                  <option value="1" >Yes</option>	
                                </select>
                                </div>
                                <span class="help-block"> A block of help text. </span> </div> 
                                
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script type="text/javascript"> 
      $(document).ready( function() {       
		setTimeout('$("#alert_msg").hide()',3000);
				
			$("#add_new").click(function(){
				var empty='';
				$("#sub_menu_name").val(empty);
				$("#main_menu_id").val(empty);
				$("#url").val(empty);
				$("#id").val(empty);
				$("#function_click").val(empty);
				$("#break_down_flag").val('0');				
				});
      });
function check(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/sub_menu_ajax.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {						
							//alert(data.flag);
							try{
								
								 $('#draggable').modal('show'); 								
								 $("#sub_menu_name").val(data.sub_menu_name);
								 $("#main_menu_id").val(data.main_menu_id);
								 $("#url").val(data.url);
								 $("#id").val(data.id);
								 $("#function_click").val(data.function_click);
								 $("#break_down_flag").val(data.break_down_flag);									
								
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
