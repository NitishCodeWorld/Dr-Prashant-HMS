<?php include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	if($_REQUEST['id']!=''){
	//Edit Data
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);
		$procedure_name=mysqli_real_escape_string($conn,$_REQUEST['procedure_name']);
		$amount=mysqli_real_escape_string($conn,$_REQUEST['amount']);
		$ipd_flag=mysqli_real_escape_string($conn,$_REQUEST['ipd_flag']);
		$pt_type=mysqli_real_escape_string($conn,$_REQUEST['pt_type']);
		$today=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		
		$ct=mysqli_real_escape_string($conn,$_REQUEST['ct']);	
		$main_procedure_id=$id;
		$remove_id_for_sub_proc=mysqli_real_escape_string($conn,$_REQUEST['remove_id_for_sub_proc']);	
		
		$sql = "UPDATE `procedure_masters` SET `procedure_name`='".$procedure_name."',`amount`='".$amount."',`modified_by`='".$created_by."' ,`modified_time`='".$today."',`ipd_flag`='".$ipd_flag."',`pt_type`='".$pt_type."'  WHERE `id`='".$id."' ";		
		
		if($conn->query($sql)===TRUE)
		{
		//$id = $conn->insert_id;	
		for($i=1;$i<=$ct;$i++) {
		if($_REQUEST['procedure_package_subtext'.$i]!='')
		 {
			   if($_REQUEST['procedure_package_flag'.$i]!='1')
		   {
				$sql4 = $conn->query("INSERT INTO `procedure_bifarcation_masters` SET `main_procedure_id`='".$main_procedure_id."',`procedure_package_subtext`='".$_REQUEST['procedure_package_subtext'.$i]."', `sub_amount`='".$_REQUEST['sub_amount'.$i]."', `procedure_package_flag`='1', `created_by`='".$created_by."', `created_on`='".$today."'");
			}
		   }   
		}
		
		for($i=1;$i<=$ct;$i++) {
		if($_REQUEST['procedure_package_subtext'.$i]!='')
		 {
			   if($_REQUEST['procedure_package_flag'.$i]=='1')
		   {
				$sql4 = $conn->query("UPDATE `procedure_bifarcation_masters` SET `main_procedure_id`='".$main_procedure_id."',`procedure_package_subtext`='".$_REQUEST['procedure_package_subtext'.$i]."', `sub_amount`='".$_REQUEST['sub_amount'.$i]."', `procedure_package_flag`='1', `modified_by`='".$created_by."', `modified_time`='".$today."' WHERE `id`='".$_REQUEST['procedure_bifarcation_unique_id'.$i]."' ");
			}
		   }   
		}
		
		if($remove_id_for_sub_proc!='')
		   {
			    $remove_id_array=explode(":",$remove_id_for_sub_proc);
			    $itemCount = sizeof($remove_id_array);
			   for($i=0;$i<($itemCount-1);$i++) {
			 	 $sql4 = $conn->query("UPDATE `procedure_bifarcation_masters` SET `del_flag` = '1', `deleted_time`='".$today."' , `deleted_by`='".$created_by."' WHERE `id`='".$remove_id_array[$i]."' ");
			   }
		   }
				
		$flg=0;
		$msg="New record created successfully";
		$redirectUrl=ADMIN_URL.'procedure_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'procedure_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		
	}
	else{
	//Add Data		
		$procedure_name=mysqli_real_escape_string($conn,$_REQUEST['procedure_name']);	
		$amount=mysqli_real_escape_string($conn,$_REQUEST['amount']);
		$today=date('Y-m-d H:i:s');
		$created_by=$_SESSION['id'];
		$ipd_flag=mysqli_real_escape_string($conn,$_REQUEST['ipd_flag']);
		$pt_type=mysqli_real_escape_string($conn,$_REQUEST['pt_type']);
		
		$sql = "INSERT INTO `procedure_masters` SET `procedure_name`='".$procedure_name."',`amount`='".$amount."',`created_by`='".$created_by."' ,`created_on`='".$today."',`ipd_flag`='".$ipd_flag."',`pt_type`='".$pt_type."'";		
		
		$ct=mysqli_real_escape_string($conn,$_REQUEST['ct']);	
		
		if($conn->query($sql)===TRUE)
		{
		$id = $conn->insert_id;		
		$main_procedure_id=$id;
		for($i=1;$i<=$ct;$i++) {
		if($_REQUEST['procedure_package_subtext'.$i]!='')
		 {
			   if($_REQUEST['procedure_package_flag'.$i]!='1')
		   {
				$sql4 = $conn->query("INSERT INTO `procedure_bifarcation_masters` SET `main_procedure_id`='".$main_procedure_id."',`procedure_package_subtext`='".$_REQUEST['procedure_package_subtext'.$i]."', `sub_amount`='".$_REQUEST['sub_amount'.$i]."', `procedure_package_flag`='1', `created_by`='".$created_by."', `created_on`='".$today."'");
			}
		   }   
		}		
		$flg=0;
		$msg="New record created successfully";
		$redirectUrl=ADMIN_URL.'procedure_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'procedure_masters.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		
	}
	
} 
//Delete Data

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
				$sql="SELECT COUNT(DISTINCT `id`) AS `total_count` FROM `procedure_masters`  ";
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Final Bill Procedure</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats">
                <div class="col-md-11 col-sm-11 col-xs-11" style="border:none !important"><a onClick="add_new_func();"  href="javascript:void(0);" id="add_new" class="btn btn-sm blue"  title="ADD NEW">+ Add New</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Records:</strong> <?php echo $total_count;?></div>
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
                    <th>Procedure Name</th>
                    <th>Procedure Details</th>
                    <th>General Amount</th>
                    <th>Details</th>
                    <th>Bifurcation</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
				  $sql3="SELECT `id`, `procedure_name`, `pt_type`, `amount`, `del_flag`, `created_by`, `created_on`, `modified_by`, `modified_time`, `deleted_by`, `deleted_time`,`ipd_flag` FROM `procedure_masters`  ORDER BY `id` DESC";
				  $result3=$conn->query($sql3) ;
				  $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {
					 $created_by="None";
					 $modified_by="None";
					 $deleted_by="None";
					 $pt_type="";
					 $bill_type="";
					 
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
					 
					  $sql10="SELECT `name` FROM `patient_type_master` Where `id`='".$row3['pt_type']."'";
					 $result10=$conn->query($sql10) ;				
					 $row10 = $result10->fetch_assoc();
					 $count10=$result10->num_rows;
					 if($count10>0)
					 {
					 	$pt_type=$row10['name'];
					 }
					 
					   
					 
					 if($row3['del_flag']=='0'){
						 $status="Active";
					 }else{
						 $status="Inactive";
					 }
					 if($row3['del_flag']=='0'){
						$rowclass="#d0e9c6";
					 }
					 else{
						$rowclass="#ebcccc";
					 }					
					
					 if($row3['ipd_flag']=='1'){
						$ipd_flag="IPD Procedure";
					 }
					 else{
						$ipd_flag="OPD Procedure";
					 }
					 ?>
                  <tr style="background-color:<?php echo $rowclass; ?>;font-family: 'Lucida Console', 'Courier New', monospace; " >
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row3['procedure_name']; ?></td>
                    <td><b>Patient Type: <?php echo $pt_type; ?> </b><br/>
                    <b>Procedure Type: <?php echo $ipd_flag; ?> </b></td>
                    <td><?php echo $row3['amount']; ?></td>
                     <td><?php 
						  $sql4="SELECT `patient_type_master`.`name`,`procedure_bifarcation_masters`.`sub_amount` FROM `procedure_bifarcation_masters` INNER JOIN `patient_type_master` ON `procedure_bifarcation_masters`.`procedure_package_subtext`=`patient_type_master`.`id` WHERE `procedure_bifarcation_masters`.`main_procedure_id`='".$row3['id']."' AND `procedure_bifarcation_masters`.`del_flag`='0' ";
						  $result4=$conn->query($sql4) ;
						  $j=1;
						 while ($row4=mysqli_fetch_array($result4,MYSQLI_ASSOC))
						 {
							 ?> 
						   <?php echo $j; ?>. <?php echo $row4['name'].' -> '.$row4['sub_amount']; ?><br/>
							  <?php 
						  $j++; }?> 
                    </td>
                    
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
                    <td><a onClick="edit('<?php echo $row3['id']; ?>');"  href="javascript:void(0);" ><img src="<?php echo ADMIN_URL; ?>icon/bt_edit.gif"  title="Edit "> </a> <!--| <a onClick="javascript: return confirm(\'Please confirm deletion\');" href="?delete=<?php echo $row3['id'];  ?>"><img src="<?php echo ADMIN_URL; ?>icon/delete.gif"  title="Delete"> </a>--></td>
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
                                <label class="col-md-4 control-label">Procedure Name</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="text" name="procedure_name" id="procedure_name" class="form-control" placeholder="Enter text" required />
                                    <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />
                                    <input type="hidden" name="created_by" id="created_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />
                                    <input type="hidden" name="created_on" id="created_on" class="form-control" placeholder="Enter id" value="<?php echo date('Y-m-d H:i:s');?>" />
                                    <input type="hidden" name="modified_by" id="modified_by" class="form-control" placeholder="Enter id" value="<?php echo $_SESSION['id'];?>" />
                                    <input type="hidden" name="modified_time" id="modified_time" class="form-control" placeholder="Enter id" value="<?php echo date('Y-m-d H:i:s');?>" />
                                  </div>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-md-4 control-label">Patient Type</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <select class=" form-control" name="pt_type" id="pt_type" >
									    <?php 
										  $sql7="SELECT `id`, `name` FROM `patient_type_master` WHERE  `del_flag`='0' AND `id`='5' ORDER BY `name` ASC ";
										 $result7=$conn->query($sql7) ;
										 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
										 {									 
											 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';
										 }
										?>
                                    </select>  
                                  </div>
                                </div>
                              </div>
                              
                              
                              
                              <div class="form-group">
                                <label class="col-md-4 control-label">IPD / OPD</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <select class=" form-control" name="ipd_flag" id="ipd_flag" >
                                    	<option value="1">IPD</option>
									  <option value="0">OPD</option>
                                      
                                    </select>  
                                  </div>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-md-4 control-label">Amount</label>
                                <div class="col-md-7">
                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter text"  />
                                  </div>
                                </div>
                              </div>
                              
                              <div id="subg" >
                               <div class="col-md-11" style="text-align:right"><b>To Add Procedure Bifurcation, Please Click On This Icon</b><a href="javascript:void(0);"  id="iop_add_button" class="btn" title="Add One Sub Package" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                                 <input type="hidden" name="ct" id="ct" value="0">
                              <!-- BEGIN FORM-->
                            	 <table class="table table-striped table-hover table-bordered" id="iop_tab">
                                   <thead>
                                       <th>Procedure Type</th>
                                       <th>Amount</th>
                                       <th>Remove</th>
                                    </thead>
                             	</table>
                                 <input type="hidden" name="remove_id_for_sub_proc" id="remove_id_for_sub_proc" value="">
                              
                            </div>
                             
                              
                            </div>
                            <div class="form-actions top">
                              <div class="row">
                                <div class="col-md-offset-4 col-md-7">
                                  <button type="submit" name="submit" id="submit" class="btn green">Submit</button>
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
</div>
<!-- END PAGE CONTAINER --> 
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript"> 
      $(document).ready( function() {       
		setTimeout('$("#alert_msg").hide()',10000);
			$("#model_close").click(function(){
				 window.location.href="<?php echo ADMIN_URL; ?>procedure_masters.php";						
				});	
				
		
				
				$("#iop_add_button").live('click',function(){ 
					 var i=$("#ct").val();		
					 i=parseInt(i)+1;		
					 $("#ct").val(i);		
					 //alert(i);		
					 $("#iop_tab").append('<tr id="iop' + i + '"><td width="40%"><select class=" form-control" name="procedure_package_subtext' + i + '" id="procedure_package_subtext' + i + '" ></select> </td><td width="40%"><input type="number" class="form-control" placeholder="Enter Sub Amount" name="sub_amount' + i + '" id="sub_amount' + i + '" value="0" ><input type="hidden" class="form-control" placeholder="Enter Sub Amount" name="procedure_package_flag' + i + '" id="procedure_package_flag' + i + '" value="0" ><input type="hidden" class="form-control" placeholder="Enter Sub Amount" name="procedure_bifarcation_unique_id' + i + '" id="procedure_bifarcation_unique_id' + i + '" value="0" ></td><td width="20%"><a href="javascript:void(0);"  id="iop_remove' + i + '" onClick="remove_iop('+ i +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
					 retrieve_procedure_next(i);
				 }); 
				
				 
      });
	  
function add_new_func(){
 	var empty='';	
	var ety='0';			
	$("#id").val(empty);	
	$("#procedure_name").val(empty);
	$("#amount").val(ety);
	$("#ipd_flag").val('1');
	
	var count_atten=$("#ct").val();
	if(count_atten!=0){
	for(var l=1;l<=count_atten;l++){
		remove_iop(l);
	}}
	$("#ct").val('0');
	$("#remove_id_for_sub_proc").val(empty);
	$('#draggable').modal('show');
	
}
function edit(id){
	
		add_new_func();
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/procedure_masters_ajax.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {		
								 $('#draggable').modal('show');	
								 $("#id").val(data.id);	
								 $("#procedure_name").val(data.procedure_name);	
								 $("#pt_type").val(data.pt_type);	
								 $("#amount").val(data.amount);	
								 $("#ipd_flag").val(data.ipd_flag);	
								 $("#ct").val(data.ct);
								 sub_procedure_edit_mode(id);
						}
					});
				
setInterval(function(){
   $('#error_msg').html('');
  }, 5000);
 
}

function sub_procedure_edit_mode(id){
	$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/sub_procedure_bifarcation_ajax.php",
						data: {'main_procedure_id': id},
						success:function(resultData) {		
							$('#iop_tab').append(resultData); 	
						}
					});
	
}

function retrieve_procedure_next(no){
	//alert(no);
	$("#procedure_package_subtext"+no).html("");
		$.ajax({
		url: 'ajax/procedure_type_fetch_for_master_ajax.php',
		dataType: 'json',
		type: 'POST',
		data: 'pt_type=1',			
		success: function (data) {						
			 $.each(data, function(index, element) {
				$('#procedure_package_subtext'+no).append($('<option/>', { 
					value: element.id,
					text : element.name 
				}));				
			 });
			 
		 }
		 
	 });
}
function remove_iop(j) {
	  //alert(i);
	  $("#iop"+j).remove();
}	

function remove_sub_proc_del(j,id) {
  $("#iop"+j).remove();	  
  var remove_id_for_sub_proc=$("#remove_id_for_sub_proc").val();
  var values_drug=remove_id_for_sub_proc+id+":";
  $("#remove_id_for_sub_proc").val(values_drug);
}

</script>
<?php include "footer.php" ?>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>