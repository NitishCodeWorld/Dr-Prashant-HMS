<?php
include 'conn.php'; 
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Prescription Sheet Pharmacy Billing Dashbaoard</span></div>
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
                      <!--<a href="<?php echo ADMIN_URL; ?>pharmacy_billing_dashboard_from_stat_sheet.php">
                        <button type="button" name="archieve" id="archieve" class="btn blue" title="Archieve">Stat Sheet Pharmacy Billing</button>
                        </a>
                        <a href="<?php echo ADMIN_URL; ?>pharmacy_billing_dashboard_from_discharge.php">
                        <button type="button" name="archieve" id="archieve" class="btn green" title="Archieve">Discharge Pharmacy Billing</button>
                        </a> --></div>
                    </div>
                  </form>
                </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <p style="text-align:right">By MRD Number, Name</p>
                <thead>
                  <tr>
                    <th>Sl. No</th>
                    <th>UHID No</th>
                    <th>Name</th>
                    <th>Phone No.</th>
                    <th>Billing Date</th>
                    <th>Details</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
				 
					 $sql3="SELECT `drugsheet`.*,`patient_registration_form`.`patient_name`,`patient_registration_form`.`phone_no` FROM `drugsheet` INNER JOIN `patient_registration_form` ON `drugsheet`.`patient_id` =`patient_registration_form`.`id` WHERE  `drugsheet`.`del_flag`='0' AND `drugsheet`.`prescription_flag`='1' AND `drugsheet`.`billing_flag`='0' AND `drugsheet`.`purchased_flag`='1' AND `patient_registration_form`.`patient_name`<>'' GROUP BY `drugsheet`.`patient_id` ORDER BY `drugsheet`.`id` DESC";
					
			 
				 $result3=$conn->query($sql3) ;
				 $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {		 
					 	
						$rowclass="#ebcccc";
						 
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
                  <tr style="background-color:<?php echo $rowclass; ?>;">
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row3['hospital_number']; ?></td>
                    <td><?php echo $row3['patient_name']; ?></td>
                    <td><?php echo $row3['phone_no']; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row3['created_on'])); ?></td>
                    
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
                    <td><a href="<?php echo ADMIN_URL; ?>pharma_invoice.php?patient_id=<?php echo $row3['patient_id']; ?>&hospital_number=<?php echo $row3['hospital_number']; ?>&treat_flag=1"  target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/bill.PNG"  title="Bill"> </a>  
                    </td>
                    
                  </tr>
                  <?php  
				  $id++; }?>
                </tbody>
              </table>
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
	$("#model_close2").click(function(){
		location.reload();
	});
	$("#model_close3").click(function(){
		location.reload();
	});
 });

function purpose(id){
	var purpose = prompt("Please enter reason");
	if (purpose != null && purpose != '') {
		location.href = '<?php echo ADMIN_URL; ?>action/invoice_hospital_reg_action.php?id='+id+'&a=delbillpharmacy&reason='+purpose;
	}
}
</script> 
<!-- END PAGE CONTAINER -->
<?php include "footer.php" ?>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>