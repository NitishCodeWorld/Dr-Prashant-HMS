<?php include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	// New Data Add
	if($_REQUEST['id']!=''){	
		
		$medication_package=mysqli_real_escape_string($conn,$_REQUEST['medication_package']);
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);
		$ct=mysqli_real_escape_string($conn,$_REQUEST['ct']);
		
		
		$sql = "UPDATE `medication_package_masters_for_emr` SET `medication_package`='".$medication_package."' WHERE `id`='".$id."'";
		if($conn->query($sql)===TRUE)
		{
			
		$sql3 = "DELETE FROM `medication_subpackage_masters_for_emr` WHERE `package_id`='".$id."'";
		$result3=$conn->query($sql3);
		
		for($i=0;$i<=$ct;$i++) {

		  if ($_REQUEST['medication_package_subtext'.$i]!='')

		   {
		
			   $sql4 = $conn->query("INSERT INTO `medication_subpackage_masters_for_emr` SET `package_id` = '".$id."',`medication_package_subtext` = '".$_REQUEST['medication_package_subtext'.$i]."'");

		   }   

   		}	
		$msg="Record updated successfully";
		$flg=0;
		$redirectUrl=ADMIN_URL.'medication_package_masters_for_emr.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'medication_package_masters_for_emr.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
	//Edit Data
	else{
		
		$medication_package=mysqli_real_escape_string($conn,$_REQUEST['medication_package']);
		$ct=mysqli_real_escape_string($conn,$_REQUEST['ct']);
		
		$sql = "INSERT INTO `medication_package_masters_for_emr` SET `medication_package`='".$medication_package."' ";
				
		
		if($conn->query($sql)===TRUE)
		{
		$id = $conn->insert_id;	
		
		$sql3 = "DELETE FROM `medication_subpackage_masters_for_emr` WHERE `package_id`='".$id."'";
		$result3=$conn->query($sql3);
		
		for($i=0;$i<=$ct;$i++) {

		  if ($_REQUEST['medication_package_subtext'.$i]!='')

		   {
		
			   $sql4 = $conn->query("INSERT INTO `medication_subpackage_masters_for_emr` SET `package_id` = '".$id."',`medication_package_subtext` = '".$_REQUEST['medication_package_subtext'.$i]."'");

		   }   

   		}
		
			
		$flg=0;
		$msg="New record created successfully";
		$redirectUrl=ADMIN_URL.'medication_package_masters_for_emr.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'medication_package_masters_for_emr.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
} 
//Delete Data
if(isset($_REQUEST['delete']))
{
	$sql = "DELETE FROM `medication_package_masters_for_emr` WHERE `id`='".$_REQUEST['delete']."'";
	$result=$conn->query($sql);
	if ($conn->query($sql) === TRUE)
	{
	$sql4 = $conn->query("DELETE FROM `medication_subpackage_masters_for_emr` WHERE `package_id`='".$_REQUEST['delete']."'");
	$flg=0;
	$msg= "Record deleted successfully";
	$redirectUrl=ADMIN_URL.'medication_package_masters_for_emr.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
	else 
	{
	$flg=1;
	$msg= "Error deleting record: " . $conn->error;
	$redirectUrl=ADMIN_URL.'medication_package_masters_for_emr.php?msg='.$msg.'&flg='.$flg;
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
				$sql="SELECT COUNT(DISTINCT `id`) AS `total_count` FROM `medication_package_masters_for_emr`";
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Medication Package Details </span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats">
                <div class="col-md-11 col-sm-11 col-xs-11" style="border:none !important">
                <a href="#draggable" id="add_new" class="btn btn-sm blue" data-toggle="modal" title="ADD NEW">+ Add New</a>
                
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
                        <span><?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?> </span>
					</div>
                 </div>                
              </div>
              
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <p style="text-align:right">Search By Name</p>
                <thead>
                  <tr> 
                    <th>Sl. No</th>
                    <th>Name</th> 
                    <th>Subpackage</th>                                   
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
				  $sql3="SELECT `id`,`medication_package` FROM `medication_package_masters_for_emr` ORDER BY `id` DESC";
				  $result3=$conn->query($sql3) ;
				  $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {
					 ?>                 
                   <tr >
                    <td> <?php echo $id; ?></td>
                    <td> <?php echo $row3['medication_package']; ?></td> 
                      <td>  <?php 
				  $sql4="SELECT `medication_package_subtext` FROM `medication_subpackage_masters_for_emr` WHERE `package_id`='".$row3['id']."' ";
				  $result4=$conn->query($sql4) ;
				  $j=1;
				 while ($row4=mysqli_fetch_array($result4,MYSQLI_ASSOC))
				 {
					 ?> 
                   <?php echo $j; ?>. <?php echo $row4['medication_package_subtext']; ?><br/>
                      <?php 
				  $j++; }?> 
                    </td>
                    <td> <a onClick="check('<?php echo $row3['id']; ?>');check2('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" ><i class="fa fa-edit" title="Edit"></i> </a> | <a onClick="if(confirm('Are you sure to delete?')) return true; else return false;" href="?delete=<?php echo $row3['id'];  ?>"><i class="fa fa-trash" title="Delete"></i> </a></td>                   
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
                              <div class="caption"> <i class="fa fa-gift"></i>Add New Medication Package</div>
                            </div>
                            <div class="portlet-body form"> 
                              <!-- BEGIN FORM-->
                              <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-body">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Name</label>
                                    <div class="col-md-7">
                                      <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                        
                                        <textarea name="medication_package" id="medication_package" class="form-control" placeholder="Enter text" required></textarea>
                                        <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />
                                      </div>
                                      <span class="help-block"> A block of help text. </span> </div>
                                  </div>
                                  <div class="col-md-11" style="text-align:right"><b>To Add Subpackage, Please Click On This Icon</b><a href="javascript:void(0);"  id="iop_add_button" class="btn" title="Add One IOP" style="margin:0 !important"><i class="fa fa-plus" style="font-size:20px;color:red;"></i></a></div>
                                 <input type="hidden" name="ct" id="ct" value="0">
                              <!-- BEGIN FORM-->
                            	 <table class="table table-striped table-hover table-bordered" id="iop_tab">
                                   
                                    
                             	</table>
                                 
                                </div>
                                <div class="form-actions top">
                                  <div class="row">
                                    <div class="col-md-offset-4 col-md-7">
                                      <button type="submit" name="submit" id="submit" class="btn green">Submit</button>
                                      <!--<button type="button" class="btn default">Cancel</button>-->
                                      <button type="button" id="model_close" class="btn default" data-dismiss="modal">Close</button>
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
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript"> 
      $(document).ready( function() {       
		setTimeout('$("#alert_msg").hide()',3000);
				
			$("#add_new").click(function(){
				var empty='';
				$("#medication_package").val(empty);
				$("#id").val(empty);	
					
				});
				$("#model_close").click(function(){
				 window.location.href="<?php echo ADMIN_URL; ?>medication_package_masters_for_emr.php";	
					
				});
				
	$("#iop_add_button").live('click',function(){ 

			 var i=$("#ct").val();

			 i=parseInt(i)+1;

			 $("#ct").val(i);

			 //alert(i);

			 $("#iop_tab").append('<tr id="iop' + i + '"><td width="80%"> <div class="input-group"> <span class="input-group-addon">Subpackage</span><input type="text" class="form-control" placeholder="Enter Subpackage Name" name="medication_package_subtext' + i + '" id="medication_package_subtext' + i + '" ></div></td><td width="20%"><a href="javascript:void(0);"  id="iop_remove' + i + '" onClick="remove_iop('+ i +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');



	 }); 
				
});

function remove_iop(j) {

	  //alert(i);

	  $("#iop"+j).remove();

	 

}	  
	  
	  
function check(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax_for_emr/medication_package_ajax_for_emr.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {						
							//alert(data.flag);
							try{
								
								
								 $('#draggable').modal('show');	
								 $("#id").val(data.id);	
								 $("#medication_package").val(data.medication_package);
								
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

 function check2(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax_for_emr/medication_subpackage_master_ajax_for_emr.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {						
						//alert(data.flag);
						try{
								
						var i=$("#ct").val();
						
						i=parseInt(i)+1;
						
						$("#ct").val(i);
						var cnt= data.count ;
						j=parseInt(cnt)+1;
						$("#ct").val(j);
						
							 var valData= data.medication_package_subtext ;
							 var valNew = valData.split('~');
							for (var j = 0; j < valNew.length; j++) {
							if(valNew[j]!=''){

			 $("#iop_tab").append('<tr id="iop' + j + '"><td width="80%"> <div class="input-group"> <span class="input-group-addon">Subpackage</span><input type="text" class="form-control" placeholder="Enter Subpackage Name" name="medication_package_subtext' + j + '" id="medication_package_subtext' + j + '"  value="' + valNew[j] + '"></div></td><td width="20%"><a href="javascript:void(0);"  id="iop_remove' + j + '" onClick="remove_iop('+ j +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
							}
							}
							 
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

