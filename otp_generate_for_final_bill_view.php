<?php 
include 'function.php';
include 'conn.php'; 
if(isset($_REQUEST['delete']))
{
$deleted_by=$_SESSION['id'];
$deleted_time=date('Y-m-d H:i:s');	
$sql = "UPDATE `otp_generate_for_final_bill_edit` SET `del_flag`='1',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."' WHERE `id`='".$_REQUEST['delete']."'";

$result=$conn->query($sql);
if ($conn->query($sql) === TRUE)
{
$msg= "Record deleted successfully";
$redirectUrl=ADMIN_URL.'otp_generate_for_final_bill_view.php?msg='.$msg;
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
} 
else 
{
$msg= "Error deleting record: " . $conn->error;
}
}

?>
<?php include "header.php"; ?>

<style>
.alert_otp{
	color:#c54040;
	font-weight:bold;
	font-size:15px;
}
</style>
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">OTP Generate Record</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-6">
                    <div class="btn-group">
                     	<a href="<?php echo ADMIN_URL; ?>otp_generate_for_final_bill_edit.php">
                        <button type="button" name="archieve" id="archieve" class="btn blue" title="Add OTP For Billing Edit">Add OTP For Billing Edit</button>
                        </a>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="btn-group pull-right"> </div>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <!-- <p style="text-align:right">By MRD Number, Name</p> -->
                <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>UHID</th>
                    <th>Invoice No <br/> Bill No.</th>
                    <th>Patient Name</th>                    
                    <th>OTP</th>
                    <th>OTP Valid For</th>
                    <th>Details</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
					 
                     $sql3="SELECT * FROM `otp_generate_for_final_bill_edit` WHERE del_flag='0' ORDER BY `id` DESC";
                     $result3=$conn->query($sql3) ;
                     $id=1;
                     while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
                     {
						 $sql="SELECT * FROM `invoice_final_billing` WHERE `hospital_number`='".$row3['uhid']."'";
						 $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
						 $row=mysqli_fetch_assoc($res);
						 $m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row['billing_date'])) , "4/1", "3/31");
	
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
                  <tr>
                    <td><?php echo $id; ?></td>
                    <td><span class="alert_otp"><?php echo $row3['uhid']; ?></span></td>
                    <td><?php echo $row3['invoice_no'].'/'.$m_f_year; ?></td>
                    <td><?php echo $row3['patient_name']; ?></td>                    
                    <td><span class="alert_otp"><?php echo $row3['otp_generate']; ?></span></td>
                    <td><b>Start Time: </b><?php echo date("d-m-Y", strtotime($row3['start_time'])); ?>  <span class="alert_otp"><?php echo date("h:i A", strtotime($row3['start_time'])); ?></span><br/>
                    	<b>End Time: </b><?php echo date("d-m-Y", strtotime($row3['end_time'])); ?>  <span class="alert_otp"><?php echo date("h:i A", strtotime($row3['end_time'])); ?></span><br/>
                        <b>Valid To: </b><span class="alert_otp">15 Minutes</span></td>
                     <td><b>Created By: </b><?php echo $created_by; ?> <br/>
                      <b>Created On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['created_on'])); ?> <br/>
                      <?php if($row3['modified_time']!=''){ ?>
                      <b>Last Modified By: </b><?php echo $modified_by; ?> <br/>
                      <b>Modified On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['modified_time'])); ?>
                      <?php } ?></td>
                    <td><a onClick="if(confirm('Are you sure to delete?')) return true; else return false;" href="?delete=<?php echo $row3['id']; ?>"><img src="<?php echo ADMIN_URL; ?>icon/delete.gif"  title="Delete Treatment Sheet"> </a> | <a href="<?php echo ADMIN_URL; ?>print_final_bill.php?id=<?php echo $row3['bill_id']; ?>"   target="_blank" title="Print Final Bill"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Final Bill"></a></td>
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
 });
</script> 
<!-- END PAGE CONTAINER -->
<?php include "footer.php" ?>