<?php
include 'conn.php'; 
if(isset($_REQUEST['delete']))
{
$status=1;
$deleted_by=$_SESSION['id'];
$deleted_time=date('Y-m-d H:i:s');	
$sql = "UPDATE `invoice_ledger_wise_payment_to_vendor` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `id`='".$_REQUEST['delete']."'";
$result=$conn->query($sql);
if ($conn->query($sql) === TRUE)
{
$msg= "Record deleted successfully";
$redirectUrl=ADMIN_URL.'ledger_wise_payment_to_vendor_dashboard.php?msg='.$msg;
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
} 
else 
{
$msg= "Error deleting record: " . $conn->error;
}
}

function get_purchase_amt($vendor_id){
	global $conn;	
	//$vendor_id=$_POST["vendor_id"];
	$total_purchase_amt['total_purchase_amt']=0;
	$total_payment_amt['total_payment_amt']=0;
	$due_amt=0;
	
	$sql="SELECT SUM(`amount`) AS `total_purchase_amt` FROM `purchase` WHERE  `vendor_id`='".$vendor_id."' ;";	
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$total_purchase_amt=mysqli_fetch_assoc($res);
	
	$sql2="SELECT SUM(`amount_to_be_paid`) AS `total_payment_amt` FROM `invoice_ledger_wise_payment_to_vendor` WHERE  `vendor_id`='".$vendor_id."' AND `del_flag`='0' ;";	
	$res2=mysqli_query($conn,$sql2) or die(mysqli_error($conn));
	$total_payment_amt=mysqli_fetch_assoc($res2);
	
	$due_amt=($total_purchase_amt['total_purchase_amt']-$total_payment_amt['total_payment_amt']);
	return $due_amt;
} 

?>
<?php include "header.php"; ?>
<style>
.th_head{
	color:blue;
	font-weight:bold;
	font-size:16px;	
}
</style>

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
          <li class="active"> Dashboard </li>
        </ul>
      </div>
      <!-- END PAGE TITLE --> 
    </div>
  </div>
  <!-- END PAGE HEAD -->
  
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Ledger Wise Payment To Vendor Dashbaoard</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats margin-bottom-30">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}else{ echo '<div class="alert alert-success" id="alert_msg" style="display:none;">';}?>
                  <button class="close" data-close="alert"></button>
                  <span id="error_msg">
                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg']; echo '</div>';}?>
                  </span> </div>
              </div>
              <p>&nbsp;</p>
              <div class="table-toolbar">
              <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important;margin-top:-10px;padding-bottom:10px;">
                  
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">                     
                      <div class="col-md-12">
                      <a href="<?php echo ADMIN_URL; ?>ledger_wise_payment_to_vendor.php">
                        <button type="button" name="archieve" id="archieve" class="btn blue" title="Add New+">Add New Ledger Wise Payment To Vendor</button>
                        </a>
                       </div>
                    </div>
                  </form>
                </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <p style="text-align:right">By MRD Number, Name</p>
                <thead>
                  <tr>
                    <th>Sl. No</th>
                    <th>Payment Date</th>
                    <th>Vendor Name</th>
                     <th>Opening Bal.(Rs.)</th>
                    <th>Payment Amount(Rs.)</th>
                    <th>Total Due Amt(Rs.)<br/> Till Present Date</th>
                    <th>Details</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
				 
					  $sql3="SELECT `invoice_ledger_wise_payment_to_vendor`.*,`vendor_master`.`vendor_name` FROM `invoice_ledger_wise_payment_to_vendor` INNER JOIN `vendor_master` ON `invoice_ledger_wise_payment_to_vendor`.`vendor_id` =`vendor_master`.`id` WHERE  `invoice_ledger_wise_payment_to_vendor`.`del_flag`='0' GROUP BY `invoice_ledger_wise_payment_to_vendor`.`vendor_id` ORDER BY `invoice_ledger_wise_payment_to_vendor`.`id` DESC";
					
			 
				 $result3=$conn->query($sql3) ;
				 $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {		 
					 	
						//$rowclass="#ebcccc";
						 
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
						 
						 $sql9="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['deleted_by']."'";
						 $result9=$conn->query($sql9) ;				
						 $row9 = $result9->fetch_assoc();
						 $count9=$result9->num_rows;
						 if($count9>0)
						 {
							$deleted_by=$row9['name'];
						 }
						 
						 
				?>
                  <tr >
                    <td><?php echo $id; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row3['payment_date'])); ?></td>
                    <td><?php echo $row3['vendor_name']; ?></td>
                    <td><?php echo $row3['opening_bal']; ?></td> 
                    <td><?php echo $row3['amount_to_be_paid']; ?></td>                     
                    <td><?php $due_amt=get_purchase_amt($row3['vendor_id']);echo $due_amt+$row3['opening_bal']; ?></td>                   
                    <td>
                     <b>Created By: </b><?php echo $created_by; ?> <br/>
                      <b>Created On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['created_on'])); ?> <br/>
                      <?php if($row3['modified_time']!=''){ ?>
                      <b>Last Modified By: </b><?php echo $modified_by; ?> <br/>
                      <b>Modified On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['modified_time'])); ?><br>
                      <?php } ?>
                      <?php if($row3['deleted_time']!=''){ ?>
                      <b>Reason: </b><?php echo $row3['reason']; ?> <br/>
                      <b>Cancel By: </b><?php echo $deleted_by; ?> <br/>
                      <b>Cancel On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['deleted_time'])); ?>
                      <?php } ?></td>
                    <td> <a onclick="if(confirm('Are you sure to add payment?')) return true; else return false;"  href="<?php echo ADMIN_URL; ?>ledger_wise_payment_to_vendor_particular_vendor.php?vendor_id=<?php echo $row3['vendor_id']; ?>&opening_bal=<?php echo $row3['opening_bal']; ?>" title="Add Payment"><img src="<?php echo ADMIN_URL; ?>icon/new.png"  title="Add Payment"> </a> | <a onclick="if(confirm('Are you sure delete?')) return true; else return false;"  href="?delete=<?php echo $row3['id']; ?>"><img src="<?php echo ADMIN_URL; ?>icon/delete.gif"  title="Delete"> | <a href="javascript:void(0);"  onclick="paymentspopup(<?php echo $row3['vendor_id']; ?>)"> <i class="fa fa-eye" aria-hidden="true" title="View Payments"></i></a>
                    </td>
                    
                  </tr>
                  <?php  
				  $id++; }?>
                </tbody>
              </table>
              <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog" id="model_header">
                  <div class="modal-content"> 
                  
                    <div class="modal-body">
                      <div class="portlet box blue-hoki">
                        <div class="portlet-title" >
                          <div class="caption"> <i class="fa fa-gift"></i>Payment Details</div>
                        </div>
                        <div class="portlet-body form"> 
                          <!-- BEGIN FORM-->
                          <div id="payment_vendors_details"></div>
                          <button type="button" class="btn default" id="model_close">Close</button>
                          <!-- END FORM--> 
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
              </div>
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
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script>
 $(document).ready( function() {       
setTimeout('$("#alert_msg").hide()',3000);


	$(".table-striped>tbody>tr:nth-of-type(odd)").removeClass("odd");
	$(".table-striped>tbody>tr:nth-of-type(even)").removeClass("even");
	
	$("#model_close").click(function(){
		location.reload();
	});
	
 });

function purpose(id){
	var purpose = prompt("Please enter reason");
	if (purpose != null && purpose != '') {
		location.href = '<?php echo ADMIN_URL; ?>action/invoice_hospital_reg_action.php?id='+id+'&a=delbillpharmacy&reason='+purpose;
	}
}

function paymentspopup(vendor_id){
	$("#payment_vendors_details").html('');	
	$.ajax({
		type : "POST",
		url : "<?php echo ADMIN_URL; ?>get_json_data_inventory.php?flag=90",
		data : "vendor_id="+vendor_id,
		success : function(data) {			
				 $('#draggable').modal('show'); 								
				 $("#payment_vendors_details").html(data);						
		}
	});
}

</script> 
<!-- END PAGE CONTAINER -->
<?php include "footer.php" ?>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>