<?php include 'conn.php'; ?>
<?php 
if(isset($_REQUEST['mrd']))
{
	$sql = "UPDATE  `prescription_details_for_emr` SET `del_flag` = '0' WHERE `mrd_no`='".$_REQUEST['mrd']."' ";
	$result=$conn->query($sql);
	if ($conn->query($sql) === TRUE)
	{
	$flg=0;
	$msg= "Reload Cancel Prescription Updated Successfully";
	$redirectUrl=ADMIN_URL.'oldpatient_for_emr.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
	
	}
	else 
	{
	$flg=1;
	$msg= "Error updating record: " . $conn->error;
	$redirectUrl=ADMIN_URL.'oldpatient_for_emr.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
	}
} 
?>
<?php include "header.php"; ?>
<style>
#sample_editable_1_filter{
	display:none !important;
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
          <li class="active">Old Patients </li>
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Old patients record</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats" >
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>
                  <button class="close" data-close="alert"></button>
                  <span>
                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg']; echo '</div>';}?>
                  </span> </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                  <div class="form-body">
                    <div class="col-md-4">
                      <select class="form-control" name="type" id="type">
                        <option value="1" <?php if($_POST['type']=='1') echo 'selected'; ?> >UHID No.</option>
                        <option value="2" <?php if($_POST['type']=='2') echo 'selected'; ?> >Name</option>
                        <option value="3" <?php if($_POST['type']=='3') echo 'selected'; ?> >phone</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="srch" name="srch" class="form-control" value="<?php echo $_POST['srch']; ?>" placeholder="Enter value">
                    </div>
                    <div class="col-md-4">
                      <button type="submit" name="submit" id="submit" class="btn blue" title="Submit">Submit</button>
                      <a href="<?php echo ADMIN_URL; ?>oldpatient.php">
                      <button type="button" name="reload" id="reload" class="btn green" title="Reload">Reload</button>
                      </a> </div>
                  </div>
                </form>
              </div>
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <p style="text-align:right">&nbsp;</p>
                <thead>
                  <tr>
                    <th>Sl. No</th>
                    <th>UHID No.</th>
                    <th>Name</th>
                    <th>Phone No.</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

				$today=date('Y-m-d');

				 $prev_date2=date('Y-m-d', strtotime("-7 days"));
				 $swhere=" ";
				if($_SESSION['role']=='5'){
					$swhere=" AND `primary_doctor`='".$_SESSION['id']."' ";
				}

				 if(isset($_POST['type'])){

					 if($_POST['type']=='1'){

					$sql3="SELECT `id`,`mrd_no`,`fname`,`prefix`,`lname`,`mobile` FROM `prescription_details_for_emr` WHERE `mrd_no`='".$_POST['srch']."' $swhere group by `mrd_no` ORDER BY `prescription_details_for_emr`.`mrd_no` DESC";

				}

					if($_POST['type']=='2'){

					$sql3="SELECT `id`,`mrd_no`,`fname`,`prefix`,`lname`,`mobile` FROM `prescription_details_for_emr` WHERE `fname` like '%".$_POST['srch']."%' OR `lname` like '%".$_POST['srch']."%'  $swhere group by `mrd_no` ORDER BY `prescription_details_for_emr`.`mrd_no` DESC";

				}

					 if($_POST['type']=='3'){

					$sql3="SELECT `id`,`mrd_no`,`fname`,`prefix`,`lname`,`mobile` FROM `prescription_details_for_emr` WHERE `mobile`='".$_POST['srch']."'  $swhere group by `mrd_no` ORDER BY `prescription_details_for_emr`.`mrd_no` DESC";

					 }

				 }

				else{

					//$sql3="SELECT `id`,`mrd_no`,`fname`,`prefix`,`lname`,`mobile` FROM `prescription_details_for_emr` WHERE date(`created_on`) BETWEEN '".$prev_date2."' AND '".$today."' group by `mrd_no` ORDER BY `prescription_details_for_emr`.`mrd_no` DESC";
					$sql3="SELECT `id`,`mrd_no`,`fname`,`prefix`,`lname`,`mobile` FROM `prescription_details_for_emr` where `fname`<>'' $swhere group by `mrd_no` ORDER BY `prescription_details_for_emr`.`mrd_no` DESC LIMIT 50";

					}

				 $result3=$conn->query($sql3) ;

				 $id=1;

				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

				 {

					 $prefix="";	
					 $sql_prefix="select * from `prefix_masters` Where `id`='".$row3['prefix']."' ";
					 $result_prefix=$conn->query($sql_prefix) ;
					 while($row_prefix=mysqli_fetch_array($result_prefix,MYSQLI_ASSOC))
					 {	
						 $prefix=$row_prefix['prefix_name'];
					 }

					?>
                  <tr class="success odd">
                    <td><?php echo $id; ?></td>
                    <td><a href="<?php echo ADMIN_URL; ?>oldpatient_search_for_emr.php?id=<?php echo $row3['id']; ?>&mrd=<?php echo $row3['mrd_no']; ?>"> <?php echo $row3['mrd_no']; ?></a></td>
                    <td><?php echo $prefix.' '.$row3['fname'].' '.$row3['lname']; ?></td>
                    <td><?php echo $row3['mobile']; ?></td>
                    <td><a href="?mrd=<?php echo $row3['mrd_no']; ?>"> <i class="fa fa-refresh" title="Reload Cancel Prescription"></i></a></td>
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
<!-- END JAVASCRIPTS -->
</body><!-- END BODY -->
</html>