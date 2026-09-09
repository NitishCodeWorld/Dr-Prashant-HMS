<?php 
include 'function.php';
include 'conn.php'; 

if(isset($_REQUEST['delete']))
{
$status=1;
$deleted_by=$_SESSION['id'];
$deleted_time=date('Y-m-d H:i:s');	

$sql = "UPDATE `menu_access_distribution_to_employees` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `id`='".$_REQUEST['delete']."'";
if($conn->query($sql)===TRUE){
	
		$sqlx = $conn->query("UPDATE `menu_access_distribution_to_employees_individual` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `menu_access_unique_id`='".$_REQUEST['delete']."'");
		 
		
		 
$msg= "Record deleted successfully";
$redirectUrl=ADMIN_URL.'menu_access_distribution_to_employees_view.php?msg='.$msg;
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
else{
$msg= "Error deleting record: " . $conn->error;
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
          <li class="active"> Dashboard </li>
        </ul>
      </div>
      <!-- END PAGE TITLE --> 
    </div>
  </div>
  <!-- END PAGE HEAD -->
  <?php 
				 //$today='2020-03-13';
				  $today=date('Y-m-d');
				 // $today_patient=0;
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Employee Menu Distribution Details</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats margin-bottom-30">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}else{ echo '<div class="alert alert-success" id="alert_msg" style="display:none;">';}?>
                  <button class="close" data-close="alert"></button>
                  <span id="error_msg">
                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?>
                  </span> </div>
              </div>
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-6">
                    <div class="btn-group">
                      <button id="" class="btn btn-sm green">
                      <a onclick="if(confirm('Are you sure?')) return true; else return false;"  title="New User / Employee" style="color:#fff !important; text-decoration:none" href="<?php echo ADMIN_URL; ?>manu_access_employee.php">Add New Menu Distribution</a>
                      </button>
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
                    <th>Sl. No</th>
                    <th>Emp ID</th>
                    <th>Emp Deptartment</th>
                    <th>Full Name</th>
                    <th>Main Menu</th>
                    <th>Total Sub Menu</th>
                    <th>Details</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

            			 $sql3="SELECT * FROM `menu_access_distribution_to_employees` WHERE `del_flag`='0' ORDER BY `id` DESC";
                   // echo "SELECT * FROM `patient_admission_form` WHERE `del_flag`='0' ORDER BY `id` DESC";
            				 $result3=$conn->query($sql3) ;
            				 $id=1;
							 $flag_null=0; 
            				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
            				 {	
							 $created_by="None";
								 $modified_by="None";	
								 $dept="";				
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
								 $sql9="SELECT `department` FROM `department_masters` Where `id`='".$row3['emp_department']."'";
								 $result9=$conn->query($sql9) ;				
								 $row9 = $result9->fetch_assoc();
								 $count9=$result9->num_rows;
								 if($count9>0)
								 {
									$dept=$row9['department'];
								 }
								 
								 if($row3['user_login_name']==''){  $flag_null=1; }
            				?>
                  <tr >
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row3['emp_id']; ?></td>
                    <td><?php echo $dept; ?></td>
                    <td><?php echo $row3['emp_full_name']; ?></td>
                    <td><?php 
						$count92=0;
						//$sql9="SELECT GROUP_CONCAT(`mainmanu_id`) AS `Result`, COUNT(`submanu_id`) AS `Sub Manu` FROM `menu_access_distribution_to_employees_individual`";
						$sql92="SELECT DISTINCT(`main_menu_masters`.`main_menu_name`) AS `main_menus_distinct`  FROM `menu_access_distribution_to_employees_individual` INNER JOIN `main_menu_masters` ON  `menu_access_distribution_to_employees_individual`.`mainmanu_id`= `main_menu_masters`.`id` WHERE `menu_access_distribution_to_employees_individual`.`menu_access_unique_id`='".$row3['id']."' and `menu_access_distribution_to_employees_individual`.`del_flag`='0'";
								 $result92=$conn->query($sql92) ;
								 $nos=1;		
								 $main_manu='';							
								 while ($row92=mysqli_fetch_array($result92,MYSQLI_ASSOC))
            				 {
								if($nos==6){
								 $main_manu=$row92['main_menus_distinct'].'<br> , '.$main_manu;								 
								}else{
									$main_manu=$row92['main_menus_distinct'].' , '.$main_manu;	
								}
									$main_manu=rtrim($main_manu,' , ');
									$nos++;
							 }
								echo $main_manu;
								
								$sql92="SELECT `main_menu_masters`.`main_menu_name`  FROM `menu_access_distribution_to_employees_individual` INNER JOIN `main_menu_masters` ON  `menu_access_distribution_to_employees_individual`.`mainmanu_id`= `main_menu_masters`.`id` WHERE `menu_access_distribution_to_employees_individual`.`menu_access_unique_id`='".$row3['id']."' and `menu_access_distribution_to_employees_individual`.`del_flag`='0'";
								 $result92=$conn->query($sql92) ;	
								  $count92=$result92->num_rows;	
						?></td>
                    <td><?php echo $count92;?></td>
                    <td><b>Created By: </b><?php echo $created_by; ?> <br/>
                      <b>Created On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['created_on'])); ?> <br/>
                      <?php if($row3['modified_on']!=''){ ?>
                      <b>Last Modified By: </b><?php echo $modified_by; ?> <br/>
                      <b>Modified On: </b><?php echo date("d-m-Y h:i A", strtotime($row3['modified_on'])); ?>
                      <?php } ?></td>
                    <td><a href="<?php echo ADMIN_URL; ?>menu_access_distribution_to_employees.php?id=<?php echo $row3['id']; ?>&emp_id=<?php echo $row3['emp_id'];?>"><img src="<?php echo ADMIN_URL; ?>icon/bt_edit.gif"  title="Edit "></a> | <a onClick="if(confirm('Are you sure to delete?')) return true; else return false;" href="?delete=<?php echo $row3['id']; ?>"><img src="<?php echo ADMIN_URL; ?>icon/delete.gif"  title="Delete"> </a></td>
                  </tr>
                  <?php  
				  $id++; }?>
                <input type="hidden" name="null_val" id="null_val" value="<?php   echo $flag_null;  ?>" />
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

var null_val=$("#null_val").val();
if(null_val=='1')
{
	
	$(".btn-sm").css("display", "none") ;
}
 $(document).ready( function() {       
setTimeout('$("#alert_msg").hide()',3000);


	$(".table-striped>tbody>tr:nth-of-type(odd)").removeClass("odd");
	$(".table-striped>tbody>tr:nth-of-type(even)").removeClass("even");
	
	
 });
 
 
</script> 
<!-- END PAGE CONTAINER -->
<?php include "footer.php" ?>
