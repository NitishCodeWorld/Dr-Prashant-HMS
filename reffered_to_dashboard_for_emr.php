<?php 
include 'function.php';
include 'conn.php'; 

if(isset($_REQUEST['delete']))
{
$status=1;
$sql = "UPDATE `prescription_details_for_emr` SET `del_flag`='".$status."'  WHERE `id`='".$_REQUEST['delete']."'";
$result=$conn->query($sql);
if ($conn->query($sql) === TRUE)
{
$msg= "Record deleted successfully";
$redirectUrl=ADMIN_URL.'dashboard_for_emr.php?msg='.$msg;
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
} 
else 
{
$msg= "Error deleting record: " . $conn->error;
}
}
if(isset($_REQUEST['terminate']))
{
	if($_REQUEST['termination']=='0')
	{
		$status=1;
	}
	if($_REQUEST['termination']=='1')
	{
		$status=0;
	}
$sql = "UPDATE `prescription_details_for_emr` SET `termination`='".$status."'  WHERE `id`='".$_REQUEST['terminate']."'";
$result=$conn->query($sql);
if ($conn->query($sql) === TRUE)
{

					$sql_val="select * from `prescription_details` where id ='".$_REQUEST['terminate']."'";
					$result_val=$conn->query($sql_val) or die($conn->error());
					$res_row=mysqli_fetch_assoc($result_val);

					$mobile=$res_row['mobile'];
					$nextday=$res_row['next_visit_day'];
					$nextweek=$res_row['next_visit_week'];
					$nextmonth=$res_row['next_visit_month'];
					$nextyear=$res_row['next_visit_year'];
					$fname=$res_row['fname'];
					$lname=$res_row['lname'];
					$mrd=$res_row['mrd_no'];

			if($mobile!=''){	
					$isd_code='91';

					$sms_from='DRRAVI';

					$mobile=$isd_code.$mobile;

					$nd=($nextday!="0") ? $nextday ." days" : ""; 
					$nd.=($nextweek!="0") ? $nextweek." weeks" : ""; 
					$nd.=($nextmonth!="0") ? $nextmonth." months" : "";
					$nd.=($nextyear!="0") ? $nextyear." years" : "";
					$nd.=($nd!="") ? "" : " few days";


					//$sms_body="Dear $fname $lname, Welcome. Dr. Kr Ravi is commited to provide you the best eye care. Your MRD no is $mrd , www.drkumarravi.com";
					//$sms_body="Dear $fname $lname, Thank you for giving us opportunity to help you in your eyecare. You are advised to review after $nd . Regards Dr. Kumar Ravi. For further assistance visit www.drkumarravi.com";
					
					//$smsStatus=sendSms($sms_body,$sms_from,$mobile);

					if($smsStatus!='0')

					{

						$sql12 = $conn->query("INSERT INTO  `sms_logs_for_emr` SET `mrd_no` = '".$mrd."',`sms_type` = '0',`sms_status` = '".$smsStatus."',`log_date` = '".date("Y-m-d H:i:s")."',`reciepent`= '".$mobile."' ");
						
						//$sql12 = $conn->query("UPDATE  `prescription_details` SET `send_sms` = '1' WHERE `id`='".$id."' ");
						$sql12 = $conn->query("UPDATE  `prescription_details_for_emr` SET `send_sms` = '1' WHERE `mrd_no`='".$mrd."' ");
					} 
			
			
			}



$msg= "Presciption terminated successfully";
$redirectUrl=ADMIN_URL.'dashboard_for_emr.php?msg='.$msg;
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
} 
else 
{
$msg= "Error Presciption terminated: " . $conn->error;
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
				 $today_patient=0;
				 $all_patient=0;
				
				$sql="SELECT COUNT( DISTINCT `mrd_no`) AS `total_pat` FROM `prescription_details_for_emr` WHERE `del_flag`='0'";
				$result=$conn->query($sql) ;				
				$row = $result->fetch_assoc();
				$all_patient=$row['total_pat'];
				
				$sql2="SELECT COUNT(DISTINCT `mrd_no`) AS `today_pat` FROM `prescription_details_for_emr` WHERE date(`created_on`)='".$today."' AND `del_flag`='0'";
				$result2=$conn->query($sql2) ;				
				$row2 = $result2->fetch_assoc();
				$today_patient=$row2['today_pat'];
				
					 
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Today patients record</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats margin-bottom-30">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>
                  <button class="close" data-close="alert"></button>
                  <span>
                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg']; echo '</div>';}?>
                  </span> </div>
              </div>
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-6">
                    <div class="btn-group">
                      <button id="" class="btn btn-sm green">
                      <a href="<?php echo ADMIN_URL; ?>oldpatient_for_emr.php" title="Old Patient" style="color:#fff !important; text-decoration:none">Old Patient</a>
                      </button>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-12 col-sm-12 col-xs-12 clearfix" style="text-align:right !important; border:none !important"> Optom Workup Done: <span class="btn btn-sm" style="background-color: #f59f01;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Dialation: <span class="btn btn-sm" style="background-color: #92bce0;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Print: <span class="btn btn-sm" style="background-color: #d0e9c6;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Terminate: <span class="btn btn-sm"style="background-color: #ebcccc;">&nbsp;</span> </div>
                    <div class="btn-group pull-right"> </div>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <p style="text-align:right">Search</p>
                <thead>
                  <tr>
                    <th>Sl. No</th>
                    <th>UHID No.</th>
                    <th>Name</th>
                    <th>Visit Purpose</th>
                    <th>Investigations<br />
                      Surgery Advice<br />
                      Procedure Advice</th>
                    <th>Prescription Date</th>
                    <th>Dilatation Time</th>
                    <th>OPTOMETRIST</th>
                    <?php 					
						echo '<th>Primary Doctor</th>';?>
                    <?php 				
					if($_SESSION['role']!='1'){
						echo '<th>Reffered Doctor</th>';
					}?>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
				$swhere=" ";
				if($_SESSION['role']=='5'){
					$swhere=" AND `reffered_to_for_emr`.`reffered_to_doc`='".$_SESSION['id']."' ";
				}
				
			  $sql3="SELECT `prescription_details_for_emr`.`id`,`prescription_details_for_emr`.`mrd_no`,`prefix_masters`.`prefix_name`,`prescription_details_for_emr`.`fname`,`prescription_details_for_emr`.`lname`,`prescription_details_for_emr`.`age`,`prescription_details_for_emr`.`investigation`,`prescription_details_for_emr`.`created_on`,`prescription_details_for_emr`.`temp_save`,`prescription_details_for_emr`.`dilatation`,`prescription_details_for_emr`.`dilatation_time`,`prescription_details_for_emr`.`username77`,`prescription_details_for_emr`.`print_prescription`,`prescription_details_for_emr`.`termination`,`purposevisit_masters_for_emr`.`purpose_visit` AS `purpose_visit_name`,`prescription_details_for_emr`.`next_visit_day`,`prescription_details_for_emr`.`next_visit_week`,`prescription_details_for_emr`.`next_visit_month`,`prescription_details_for_emr`.`next_visit_year`,`prescription_details_for_emr`.`mobile`,`prescription_details_for_emr`.`surgery`,`prescription_details_for_emr`.`procedure_comments`,`user_infos`.`name` AS `doc_name`,`reffered_to_for_emr`.`reffered_to_doc`,`prescription_details_for_emr`.`primary_doctor` FROM `prescription_details_for_emr` LEFT JOIN `purposevisit_masters_for_emr` ON `prescription_details_for_emr`.`purpose_visit_id`= `purposevisit_masters_for_emr`.`id` INNER JOIN `user_infos` ON `prescription_details_for_emr`.`primary_doctor`= `user_infos`.`users_id` INNER JOIN `reffered_to_for_emr` ON `prescription_details_for_emr`.`id`= `reffered_to_for_emr`.`prescription_id` INNER JOIN `prefix_masters` ON `prescription_details_for_emr`.`prefix`= `prefix_masters`.`id` WHERE date(`prescription_details_for_emr`.`created_on`)='".$today."' $swhere ORDER BY `prescription_details_for_emr`.`id` DESC ";
				 $result3=$conn->query($sql3) ;
				 $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {		 
					 	$rowclass="";
					 	if($row3['username77']!=''){
							$rowclass="#f59f01";
						}
						if($row3['dilatation']=='1'){
							$rowclass="#92bce0";
						}
						if($row3['print_prescription']=='1'){
							$rowclass="#d0e9c6";
						}
						if($row3['termination']=='1'){
							$rowclass="#ebcccc";
						}
						$optom_name="";
						if($row3['username77']!=''){
							$sql25="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['username77']."'";
								 $result25=$conn->query($sql25) ;				
								 $row25 = $result25->fetch_assoc();
								 $count25=$result25->num_rows;
								 if($count25>0)
								 {
									$optom_name=$row25['name'];
								 }
						}
						
						
						$sql2="SELECT * FROM `user_infos` WHERE `users_id`='".$row3['reffered_to_doc']."'";
	$pres_city=$conn->query($sql2) ;				
	$pres_city_fetch = $pres_city->fetch_assoc();
				?>
                  <tr style="background-color:<?php echo $rowclass; ?>;">
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row3['mrd_no']; ?></td>
                    <td><?php echo $row3['prefix_name'].' '.$row3['fname'].' '.$row3['lname']; ?> <br/>
                      Age: <?php echo $row3['age']; ?><br/>
                      Mobile No.: <?php echo $row3['mobile']; ?></td>
                    <td><?php echo $row3['purpose_visit_name']; ?></td>
                    <td>Investigation: <?php echo limit_text($row3['investigation'], 4); ?><br/>
                      Surgery Advice: <?php echo limit_text($row3['surgery'], 4); ?><br/>
                      Procedure Advice: <?php echo limit_text($row3['procedure_comments'], 4); ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row3['created_on']));  ?><br/>
                      <b>Starting time : </b> <?php echo date("h:i A", strtotime($row3['created_on']));  ?>
                      <?php 				
					if($row3['terminted_on']!=''){
						?>
                      <br />
                      <b>Print Prescription time / Terminated Time: </b> <?php echo date("h:i A", strtotime($row3['terminted_on']));  ?> <br />
                      <b>Prescription Duration Time: </b>
                      <?php $assigned_time = $row3['created_on'];
$completed_time= $row3['terminted_on'];   
$d1 = new DateTime($assigned_time);
$d2 = new DateTime($completed_time);
$interval = $d2->diff($d1);
echo $interval->format('%H hours, %I minutes, %S seconds'); ?>
                      <br />
                      <?php
					}?></td>
                    <td><?php if(($row3['dilatation']==1)&&($row3['dilatation_time']!='')){echo date('h:i A',strtotime($row3['dilatation_time'])); }else{ echo '';} ?></td>
                    <td><?php echo $optom_name; ?></td>
                    <td><?php echo $row3['doc_name']; ?></td>
                    <?php 				
					if($_SESSION['role']!='1'){
						?>
                    <td><?php echo $pres_city_fetch['name']; ?></td>
                    <?php
					}?>
                    <td><a href="<?php echo ADMIN_URL; ?>oldprescription2_for_emr.php?id=<?php echo $row3['id']; ?>&mrd=<?php echo $row3['mrd_no']; ?>"  target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/arrow.png"  title="New Prescription"> </a> | <a href="<?php echo ADMIN_URL; ?>printPrescription_for_emr.php?id=<?php echo $row3['id']; ?>"  target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Prescription"> </a> | <a href="<?php echo ADMIN_URL; ?>sepMedication_for_emr.php?id=<?php echo $row3['id']; ?>"  target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Medication"> </a></td>
                  </tr>
                  <?php  
				  $id++; }?>
                </tbody>
              </table>
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
                          <div class="caption"> <i class="fa fa-gift"></i>Attachment (Click On The Link To Download)</div>
                        </div>
                        <div class="portlet-body form">
                          <input type="hidden" id="ct" value="0">
                          <!-- BEGIN FORM-->
                          <table class="table table-striped table-hover table-bordered" id="table_atch">
                          </table>
                          <!-- END FORM--> 
                        </div>
                        <div class="form-actions top">
                          <div class="row">
                            <div class="col-md-offset-4 col-md-7"> 
                              
                              <!--<button type="button" class="btn default">Cancel</button>-->
                              <button type="button" class="btn red" data-dismiss="modal" id="model_close">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
              </div>
              <div class="modal fade draggable-modal" id="draggable_field_image" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog" id="model_header">
                  <div class="modal-content"> 
                    <!-- <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                         <h4 class="modal-title"><strong>Add New Doctor</strong></h4>
                        </div>-->
                    <div class="modal-body">
                      <div class="portlet box blue-hoki">
                        <div class="portlet-title" >
                          <div class="caption"> <i class="fa fa-gift"></i>Attachment Of Field Image Test (Click On The Link To Download)</div>
                        </div>
                        <div class="portlet-body form">
                          <input type="hidden" id="ct_field_image" value="0">
                          <!-- BEGIN FORM-->
                          <table class="table table-striped table-hover table-bordered" id="table_atch_field_image">
                          </table>
                          <!-- END FORM--> 
                        </div>
                        <div class="form-actions top">
                          <div class="row">
                            <div class="col-md-offset-4 col-md-7"> 
                              
                              <!--<button type="button" class="btn default">Cancel</button>-->
                              <button type="button" class="btn red" data-dismiss="modal" id="model_close2">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
              </div>
              <div class="modal fade draggable-modal" id="draggable_camera_image" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog" id="model_header">
                  <div class="modal-content"> 
                    <!-- <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                         <h4 class="modal-title"><strong>Add New Doctor</strong></h4>
                        </div>-->
                    <div class="modal-body">
                      <div class="portlet box blue-hoki">
                        <div class="portlet-title" >
                          <div class="caption"> <i class="fa fa-gift"></i>Attachment Of Camera Image  (Click On The Image To Show / Download)</div>
                        </div>
                        <div class="portlet-body form">
                          <input type="hidden" id="ct_camera_image" value="0">
                          <!-- BEGIN FORM-->
                          <table class="table table-striped table-hover table-bordered" id="table_atch_camera_image">
                          </table>
                          <!-- END FORM--> 
                        </div>
                        <div class="form-actions top">
                          <div class="row">
                            <div class="col-md-offset-4 col-md-7"> 
                              
                              <!--<button type="button" class="btn default">Cancel</button>-->
                              <button type="button" class="btn red" data-dismiss="modal" id="model_close3">Close</button>
                            </div>
                          </div>
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
	$("#model_close2").click(function(){
		location.reload();
	});
	$("#model_close3").click(function(){
		location.reload();
	});
 });
 
 function check(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax_for_emr/download_ajax_for_emr.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {						
						//alert(data.flag);
						try{
								var i=$("#ct").val();
								i=parseInt(i)+1;
								$("#ct").val(i);
							 $('#draggable').modal('show'); 
							 if(i=='1'){
							  $("#table_atch").append('<tr><td width="30%">Attachment1</td><td width="70%" id="atch1"><a href="<?php echo ADMIN_URL; ?>'+ data.filepath1 +   data.filename1 + '" title="Download" download >' + data.filename1 + '</a></td> </tr><tr><td width="30%">Attachment2</td><td width="70%" id="atch2"><a href="<?php echo ADMIN_URL; ?>'+ data.filepath2 +   data.filename2 + '" title="Download" download >' + data.filename2 + '</a></td> </tr><tr><td width="30%">Attachment3</td><td width="70%" id="atch3"><a href="<?php echo ADMIN_URL; ?>'+ data.filepath3 +   data.filename3 + '" title="Download" download >' + data.filename3 + '</a></td> </tr><tr><td width="30%">Attachment4</td><td width="70%" id="atch4"><a href="<?php echo ADMIN_URL; ?>'+ data.filepath4 +   data.filename4 + '" title="Download" download >' + data.filename4 + '</a></td> </tr>');							
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

function check2(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax_for_emr/download_field_image_ajax_for_emr.php",
						dataType : "json", 
						data : "id="+id,					
						success : function(data) {						
							//alert(data.flag);
							try{
									var i=$("#ct_field_image").val();
									i=parseInt(i)+1;
			 						$("#ct_field_image").val(i);
								 $('#draggable_field_image').modal('show'); 
								 if(i=='1'){
								 $("#table_atch_field_image").append('<tr><td width="20%">Attachment1 UHID No.. : ' + data.mrd_no + '</td><td width="30%" id="atch1"><a href="<?php echo ADMIN_URL; ?>upload_fieldtest/' + data.filename1 + '" title="Download" download >' + data.filename1 + '</a></td><td width="50%" id="atch1"><img src="<?php echo ADMIN_URL; ?>upload_fieldtest/' + data.filename1 + '" title="Download" width="80px" height="80px" /></a></tr><tr></td><td width="20%">Attachment2 UHID No.. : ' + data.mrd_no + '</td><td width="30%" id="atch2"><a href="<?php echo ADMIN_URL; ?>upload_fieldtest/' + data.filename2 + '" title="Download" download >' + data.filename2 + '</a></td><td width="50%" id="atch2"><img src="<?php echo ADMIN_URL; ?>upload_fieldtest/' + data.filename2 + '" title="Download" width="80px" height="80px" /></a></td> </tr>');							
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


function check3(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax_for_emr/download_camera_image_ajax_for_emr.php",
						dataType : "json", 
						data : "id="+id,					
						success : function(data) {						
							//alert(data.flag);
							try{
									var i=$("#ct_camera_image").val();
									i=parseInt(i)+1;
			 						$("#ct_camera_image").val(i);
								 $('#draggable_camera_image').modal('show'); 
								 if(i=='1'){
								 $("#table_atch_camera_image").append('<tr><td width="20%">Attachment1 UHID No.. : ' + data.mrd_no + '</td><td width="80%" id="atch1"><a href="' + data.url + '" title="Download" target="_blank" ><img src="' + data.url + '" title="Download" width="160px" height="160px" /></a></tr>');							
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

function mail(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax_for_emr/mail_sent_ajax_for_emr.php",
						dataType : "json", 
						data : "id="+id,					
						success : function(data) {						
							//alert(data.flag);
							try{
									
								 if(data.sms_status=='1'){
									
								   $("#alert_msg").removeClass("alert-reception");
									 $("#alert_msg").removeClass("alert-success");
									 $("#alert_msg").addClass("alert-success");
									 $("#alert_msg").css('display','block');
									 $('#error_msg').html('Mail is sent');	
									 setTimeout('$("#alert_msg").hide()',3000);						
								 }
								 else{
									 $("#alert_msg").removeClass("alert-reception");
									 $("#alert_msg").removeClass("alert-success");
									 $("#alert_msg").addClass("alert-reception");
									 $("#alert_msg").css('display','block');
									 $('#error_msg').html('Mail is not sent');	
									 setTimeout('$("#alert_msg").hide()',3000);
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
<!-- END PAGE CONTAINER -->
<?php include "footer.php" ?>
<!-- END JAVASCRIPTS -->
</body><!-- END BODY -->
</html>