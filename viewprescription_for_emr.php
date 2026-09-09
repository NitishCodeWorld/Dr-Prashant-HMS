<?php include 'conn.php'; 
	  include 'function.php';
?>
<?php 

if(isset($_REQUEST['delete']))

{

$status=1;

$sql = "UPDATE `prescription_details_for_emr` SET `del_flag`='".$status."'  WHERE `id`='".$_REQUEST['delete']."'";

$result=$conn->query($sql);

if ($conn->query($sql) === TRUE)

{

$msg= "Record deleted successfully";

$redirectUrl=ADMIN_URL.'viewprescription.php?msg='.$msg;

echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

} 

else 

{

$msg= "Error deleting record: " . $conn->error;

}

}




function limit_text($text, $limit) {

      if (str_word_count($text, 0) > $limit) {

          $words = str_word_count($text, 2);

          $pos = array_keys($words);

          $text = substr($text, 0, $pos[$limit]) . '...';

      }

      return $text;

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
          <li class="active"> Prescription </li>
        </ul>
      </div>
      
      <!-- END PAGE TITLE --> 
      
    </div>
  </div>
  
  <!-- END PAGE HEAD -->
  
  <?php 

				 //$today='2020-03-13';

				 $today=date('Y-m-d');

				 $prev_date2=date('Y-m-d', strtotime("-2 days"));

				 $prev_date1=date('Y-m-d', strtotime("-1 days"));

				 $today_patient=0;

				 $prev_date1_patient=0;

				 $prev_date2_patient=0; 

				 $all_patient=0;		

				

				$sql="SELECT COUNT(`mrd_no`) AS `total_pat` FROM `prescription_details_for_emr` WHERE date(`created_on`) BETWEEN '".$prev_date2."' AND '".$today."' AND `del_flag`='0'";

				$result=$conn->query($sql) ;				

				$row = $result->fetch_assoc();

				$all_patient=$row['total_pat'];

				

				$sql2="SELECT COUNT(DISTINCT `mrd_no`) AS `today_pat` FROM `prescription_details_for_emr` WHERE date(`created_on`) BETWEEN '".$prev_date2."' AND '".$today."' AND `del_flag`='0'";

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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Patients record</span></div>
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
                  <div class="col-md-6"> <span class="caption-subject font-blue-sharp bold uppercase">Patients record from <?php echo  date("d-m-Y", strtotime($prev_date2)); ?> to <?php echo  date("d-m-Y", strtotime($today)); ?> </span> </div>
                  <div class="col-md-6">
                    <div class="col-md-12 col-sm-12 col-xs-12 clearfix" style="text-align:right !important; border:none !important"> Save Template: <span class="btn btn-sm" style="background-color: #baaae3;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Dialation: <span class="btn btn-sm" style="background-color: #92bce0;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Print: <span class="btn btn-sm" style="background-color: #d0e9c6;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Terminate: <span class="btn btn-sm"style="background-color: #ebcccc;">&nbsp;</span> </div>
                    <div class="btn-group pull-right"> 
                     
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <p style="text-align:right">By MRD Number, Name</p>
                <thead>
                  <tr>
                    <th>Sl. No</th>
                    <th>MRD No</th>
                    <th>Name</th>
                    <th>Visit Purpose</th>
                    <th>Investigations<br />Surgery Advice<br />Procedure Advice</th>
                    <th>Prescription Date</th>
                    <th>Dilatation Time</th>
                    <th>OPTOMETRIST</th>
                     <?php 				
					if($_SESSION['role']!='5'){
						echo '<th>Doctor</th>';
					}?>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
			 
			 $swhere=" ";
				if($_SESSION['role']=='5'){
					$swhere=" AND `prescription_details_for_emr`.`primary_doctor`='".$_SESSION['id']."' ";
				}
				
			  $sql3="SELECT `prescription_details_for_emr`.`id`,`prescription_details_for_emr`.`mrd_no`,`prescription_details_for_emr`.`prefix`,`prescription_details_for_emr`.`fname`,`prescription_details_for_emr`.`lname`,`prescription_details_for_emr`.`age`,`prescription_details_for_emr`.`investigation`,`prescription_details_for_emr`.`created_on`,`prescription_details_for_emr`.`temp_save`,`prescription_details_for_emr`.`dilatation`,`prescription_details_for_emr`.`dilatation_time`,`prescription_details_for_emr`.`username77`,`prescription_details_for_emr`.`print_prescription`,`prescription_details_for_emr`.`termination`,`purposevisit_masters_for_emr`.`purpose_visit` AS `purpose_visit_name`,`prescription_details_for_emr`.`next_visit_day`,`prescription_details_for_emr`.`next_visit_week`,`prescription_details_for_emr`.`next_visit_month`,`prescription_details_for_emr`.`next_visit_year`,`prescription_details_for_emr`.`mobile`,`prescription_details_for_emr`.`surgery`,`prescription_details_for_emr`.`procedure_comments` FROM `prescription_details_for_emr` LEFT JOIN `purposevisit_masters_for_emr` ON `prescription_details_for_emr`.`purpose_visit_id`= `purposevisit_masters_for_emr`.`id`  WHERE date(`prescription_details_for_emr`.`created_on`) BETWEEN '".$prev_date2."' AND '".$today."' $swhere ORDER BY `prescription_details_for_emr`.`id` DESC ";
				 $result3=$conn->query($sql3) ;
				 $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {		 
					 	$rowclass="";
					 	if($row3['temp_save']=='1'){
							$rowclass="#baaae3";
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
				?>
                  <tr style="background-color:<?php echo $rowclass; ?>;">
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row3['mrd_no']; ?></td>
                    <td><?php echo $row3['prefix'].' '.$row3['fname'].' '.$row3['lname']; ?> <br/>
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
                    <td><?php if(($row3['dilatation']==1)&&($row3['dilatation_time']!='')){echo date('h:i A',strtotime($row3['dilatation_time'])); }else if(($row3['no_dialation']==1)&&($row3['no_dialation_reason']!='')){ echo '<b>Reason Of No Dilatation : </b>'.$row3['no_dialation_reason'];} else{ echo '--';} ?></td>
                    <td><?php echo $optom_name; ?></td>
                    <?php 				
					if($_SESSION['role']!='5'){
						?>
                    <td><?php echo $row3['doc_name']; ?></td>
                    <?php
					}?>
                    <td><a href="<?php echo ADMIN_URL; ?>edit_prescription.php?id=<?php echo $row3['id']; ?>"><img src="<?php echo ADMIN_URL; ?>icon/bt_edit.gif"  title="Edit Prescription"></a> | <a href="<?php echo ADMIN_URL; ?>printPrescription.php?id=<?php echo $row3['id']; ?>"  target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Prescription"> </a> | <a onClick="check('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" title="Download Attachments"><img src="<?php echo ADMIN_URL; ?>icon/download_icon.png"  title="View Attachment"></a> | <a href="<?php echo ADMIN_URL; ?>sepGlassprescription.php?id=<?php echo $row3['id']; ?>"  target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Glass Prescription"> </a> | <a onClick="if(confirm('Are you sure to delete?')) return true; else return false;" href="?delete=<?php echo $row3['id']; ?>"><img src="<?php echo ADMIN_URL; ?>icon/delete.gif"  title="Delete Prescription"> </a> | <a href="<?php echo ADMIN_URL; ?>sepMedication.php?id=<?php echo $row3['id']; ?>"  target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Medication"> </a> | <a onClick="if(confirm('Are you sure to terminate?')) return true; else return false;" href="?terminate=<?php echo $row3['id']; ?>&termination=<?php echo $row3['termination']; ?>&mobile=<?php echo $row3['mobile']; ?>&nextday=<?php echo $row3['next_visit_day']; ?>&nextweek=<?php echo $row3['next_visit_week']; ?>&nextmonth=<?php echo $row3['next_visit_month']; ?>&nextyear=<?php echo $row3['next_visit_year']; ?>&fname=<?php echo $row3['fname'];  ?>&lname=<?php echo $row3['lname'];  ?>&mrd_no=<?php echo $row3['mrd_no']; ?>"><img src="<?php echo ADMIN_URL; ?>icon/terminate.png"  title="Terminate Prescription"> </a> | <a href="<?php echo ADMIN_URL; ?>view_archive.php?id=<?php echo $row3['id']; ?>"  target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/eye.png"  title="View Prescription"> </a> | <a href="<?php echo ADMIN_URL; ?>oldpatient_search.php?id=<?php echo $row3['id']; ?>&mrd=<?php echo $row3['mrd_no']; ?>"  target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/arrow.png"  title="Old Prescription Archive"> </a> | <a onClick="mail('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" title="Send Mail"><img src="<?php echo ADMIN_URL; ?>icon/email2.png"  title="Send Mail"></a> | <a onClick="check3('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" title="Download Camera Attachments"><img src="<?php echo ADMIN_URL; ?>icon/download_icon.png"  title="View Camera Attachment"></a></td>
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
<!-- END PAGE CONTAINER --> 
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
								// alert(data.filename1);

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

								 $("#table_atch_field_image").append('<tr><td width="20%">Attachment1 MRD No. : ' + data.mrd_no + '</td><td width="30%" id="atch1"><a href="<?php echo ADMIN_URL; ?>upload_fieldtest/' + data.filename1 + '" title="Download" download >' + data.filename1 + '</a></td><td width="50%" id="atch1"><img src="<?php echo ADMIN_URL; ?>upload_fieldtest/' + data.filename1 + '" title="Download" width="80px" height="80px" /></a></tr><tr></td><td width="20%">Attachment2 MRD No. : ' + data.mrd_no + '</td><td width="30%" id="atch2"><a href="<?php echo ADMIN_URL; ?>upload_fieldtest/' + data.filename2 + '" title="Download" download >' + data.filename2 + '</a></td><td width="50%" id="atch2"><img src="<?php echo ADMIN_URL; ?>upload_fieldtest/' + data.filename2 + '" title="Download" width="80px" height="80px" /></a></td> </tr>');							

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
								 $("#table_atch_camera_image").append('<tr><td width="20%">Attachment1 MRD No. : ' + data.mrd_no + '</td><td width="80%" id="atch1"><a href="' + data.url + '" title="Download" target="_blank" ><img src="' + data.url + '" title="Download" width="160px" height="160px" /></a></tr>');							
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