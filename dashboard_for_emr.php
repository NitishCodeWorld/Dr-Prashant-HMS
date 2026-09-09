<?php 

include 'function.php';

include 'conn.php'; 



if(isset($_REQUEST['delete']))

{

$status=1;

$deleted_by=$_SESSION['id'];

$deleted_time=date('Y-m-d H:i:s');	

$sql = "UPDATE `prescription_details_for_emr` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `id`='".$_REQUEST['delete']."'";

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

	$terminted_on=date('Y-m-d H:i:s');

$sql = "UPDATE `prescription_details_for_emr` SET `termination`='".$status."',`terminted_on`= '".$terminted_on."'  WHERE `id`='".$_REQUEST['terminate']."'";

$result=$conn->query($sql);

if ($conn->query($sql) === TRUE)

{



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
<?php include "header_inventory.php"; ?>
<style>
.patient_info_wp_display_main {
	font-size:18px !important;
	font-weight:bold !important;
	text-decoration:underline;
	padding:6px !important;
	color:#33C !important;
}
.patient_info_wp_display {
	font-size:14px !important;
	font-weight:bold !important;
	padding:6px !important;
}
.patient_info_wp_display_send {
	float:left;
	font-size:16px !important;
	font-weight:bold !important;
	text-decoration:underline;
	padding:6px !important;
	color:#6833cc !important;
}
#msg_sent {
	font-size:14px !important;
	font-weight:bold !important;
	padding:6px !important;
	text-align:center;
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
  
  <?php 

				//$today='2025-04-14';

				 $today=date('Y-m-d');

				 $today_patient=0;

				 $all_patient=0;

				

				 

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
				
			  <!-- New Counter Statistics Row -->
				<div class="row" style="margin-bottom: 20px;">
				  <!-- Total Patients -->
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue" style="background-color: #3598dc; color: #fff; padding: 15px; border-radius: 4px;">
					  <div class="visual" style="float: left; padding-top: 10px; padding-left: 15px; font-size: 35px; opacity: 0.1;">
						<i class="fa fa-users"></i>
					  </div>
					  <div class="details" style="text-align: right;">
						<div class="number" style="font-size: 34px; font-weight: 300; letter-spacing: -1px; margin-bottom: 0px; line-height: 36px;">
						  <span id="total_patient"></span>
						</div>
						<div class="desc" style="font-size: 13px; opacity: 0.8; text-transform: uppercase; font-weight: 300;"> 
						  Total Patients 
						</div>
					  </div>
					</div>
				  </div>

				  <!-- Total IPD Patients -->
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red" style="background-color: #e7505a; color: #fff; padding: 15px; border-radius: 4px;">
					  <div class="visual" style="float: left; padding-top: 10px; padding-left: 15px; font-size: 35px; opacity: 0.1;">
						<i class="fa fa-user-plus"></i>
					  </div>
					  <div class="details" style="text-align: right;">
						<div class="number" style="font-size: 34px; font-weight: 300; letter-spacing: -1px; margin-bottom: 0px; line-height: 36px;">
						  <span id="today_ipd_total_patient"></span>
						</div>
						<div class="desc" style="font-size: 13px; opacity: 0.8; text-transform: uppercase; font-weight: 300;"> 
						  Today's Total IPD Patients 
						</div>
					  </div>
					</div>
				  </div>

				  <!-- Total OPD Patients -->
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green" style="background-color: #32c5d2; color: #fff; padding: 15px; border-radius: 4px;">
					  <div class="visual" style="float: left; padding-top: 10px; padding-left: 15px; font-size: 35px; opacity: 0.1;">
						<i class="fa fa-user"></i>
					  </div>
					  <div class="details" style="text-align: right;">
						<div class="number" style="font-size: 34px; font-weight: 300; letter-spacing: -1px; margin-bottom: 0px; line-height: 36px;">
						  <span id="today_opd_total_patient"></span>
						</div>
						<div class="desc" style="font-size: 13px; opacity: 0.8; text-transform: uppercase; font-weight: 300;"> 
						  Today's Total OPD Patients 
						</div>
					  </div>
					</div>
				  </div>

				  <!-- Total My Patients -->
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<?php if($_SESSION['role'] == 5 || $_SESSION['role'] == 1){ ?>
					<div class="dashboard-stat purple" style="background-color: #8e44ad; color: #fff; padding: 15px; border-radius: 4px;">
					  <div class="visual" style="float: left; padding-top: 10px; padding-left: 15px; font-size: 35px; opacity: 0.1;">
						<i class="fa fa-heart"></i>
					  </div>
					  <div class="details" style="text-align: right;">
						<div class="number" style="font-size: 34px; font-weight: 300; letter-spacing: -1px; margin-bottom: 0px; line-height: 36px;">
						  <span id="today_my_total_patient"></span>
						</div>
						<div class="desc" style="font-size: 13px; opacity: 0.8; text-transform: uppercase; font-weight: 300;"> 
						  Today's My Patients Total 
						</div>
					  </div>
					</div>
					<?php } ?>
				  </div>
				</div>
				
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-group">
                      <button id="" class="btn btn-sm green">
                      <a href="<?php echo ADMIN_URL; ?>oldpatient_for_emr.php" title="Old Patient" style="color:#fff !important; text-decoration:none">Old Patient</a>
                      </button>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="col-md-12 col-sm-12 col-xs-12 clearfix" style="text-align:right !important; border:none !important"> Optom Workup Done: <span class="btn btn-sm" style="background-color: #f59f01;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Dialation: <span class="btn btn-sm" style="background-color: #92bce0;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Print: <span class="btn btn-sm" style="background-color: #d0e9c6;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Time >= 1.5 hrs and less than 2 hrs: <span class="btn btn-sm" style="background-color: #10c52f;">&nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;Time >= greater than 2 hrs: <span class="btn btn-sm" style="background-color: #ed420f;">&nbsp;</span> Terminate: <span class="btn btn-sm"style="background-color: #ebcccc;">&nbsp;</span> </div>
                    <div class="btn-group pull-right"> </div>
                  </div>
                  <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                  <div class="col-md-12">
                    <form  action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                      <div class="col-md-2">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php if(isset($_POST['from_date'])){if($_POST['from_date']!=''){ echo date("d-m-Y", strtotime($_POST['from_date']));}else{ echo '';}}else{ echo date("d-m-Y");} ?>" />
                          <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#from_date').val(''))" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>
                      </div>
                      <div class="col-md-2">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Select To Date" id="to_date" name="to_date"  value="<?php if(isset($_POST['to_date'])){if($_POST['to_date']!=''){ echo date("d-m-Y", strtotime($_POST['to_date']));}else{ echo '';}}else{ echo date("d-m-Y");} ?>" />
                          <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#to_date').val(''))" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>
                      </div>
                      <div class="col-md-2">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="UHID NO." id="uhid_no_srch" name="uhid_no_srch" value="<?php if(isset($_POST['uhid_no_srch'])){if($_POST['uhid_no_srch']!=''){ echo $_POST['uhid_no_srch'];}else{ echo '';}}else{ echo '';} ?>" />
                          <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#uhid_no_srch').val(''))" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>
                      </div>
                      <div class="col-md-4">
                        <button type="button"  name="submit_filter" id="submit_filter" class="btn red" title="Submit"  onclick="date_wise_db();" >Filter</button>
                      </div>
                    </form>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="asset_entry_data_for_emr">
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

					if($_SESSION['role']!='5'){

						echo '<th>Doctor</th>';

					}?>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="assets_body_for_emr">
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
      <div class="modal fade draggable-modal" id="draggable_SMS" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog" id="model_header">
          <div class="modal-content">
            <div class="modal-body">
              <div class="portlet box blue-hoki">
                <div class="portlet-title" >
                  <div class="caption"> <i class="fa fa-gift"></i>Message Send (Click On The Icon To Send Message What You Want..)</div>
                </div>
                <div class="portlet-body form">
                  <input type="hidden" id="sms_msg_patient_name" name="sms_msg_patient_name"  value="">
                  <input type="hidden" id="sms_msg_patient_wp_no" name="sms_msg_patient_wp_no"  value="">
                  <input type="hidden" id="sms_msg_patient_mrd" name="sms_msg_patient_mrd"  value="">
                  <input type="hidden" id="sms_msg_patient_id" name="sms_msg_patient_id"  value="">
                  <input type="hidden" id="sms_msg_primary_doctor" name="sms_msg_primary_doctor"  value="">
                  <input type="hidden" id="error_mobile_no_flag" name="error_mobile_no_flag"  value="">
                  <!-- BEGIN FORM-->
                  <table class="table table-striped table-hover table-bordered" id="table_SMS">
                    <tr>
                      <td class="patient_info_wp"><span class="patient_info_wp_display_main" >MRD No.</span></td>
                      <td class="patient_info_wp"><span class="patient_info_wp_display_main" >Patient Name</span></td>
                      <td class="patient_info_wp"><span class="patient_info_wp_display_main" >Mobile No.</span></td>
                    </tr>
                    <tr>
                      <td class="patient_info_wp"><span class="patient_info_wp_display" id="sms_msg_patient_mrd_span"></span></td>
                      <td class="patient_info_wp"><span class="patient_info_wp_display" id="sms_msg_patient_name_span"></span></td>
                      <td class="patient_info_wp"><span class="patient_info_wp_display" id="sms_msg_patient_wp_no_span"></span></td>
                    </tr>
                  </table>
                  <div class="col-md-12"><span id="msg_sent"></span><br />
                    <br />
                  </div>
                  <center>
                    <table id="table_SMS" width="60%" >
                      <tr>
                        <td class="patient_info_wp"><span class="patient_info_wp_display_send" >Prescription URL send in SMS</span></td>
                        <td class="patient_info_wp"><span class="patient_info_wp_display" > <img src="<?php echo ADMIN_URL; ?>icon/arrow.png"  title="SMS Message Send"> &nbsp; <a onClick="prescription_sms()"  href="javascript:void(0);" title="SMS Message Send"><img src="<?php echo ADMIN_URL; ?>icon/sms_30x30.png"  title="SMS Message Send"></a></span></td>
                      </tr>
                      <tr>
                        <td class="patient_info_wp" colspan="2">&nbsp; <br /></td>
                      </tr>
                    </table>
                  </center>
                  <!-- END FORM--> 
                </div>
                <div class="form-actions top">
                  <div class="row">
                    <div class="col-md-offset-4 col-md-7"> 
                      
                      <!--<button type="button" class="btn default">Cancel</button>-->
                      <button type="button" class="btn red" data-dismiss="modal" id="model_close_SMS">Close</button>
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
      
      <!-- END PAGE CONTENT INNER --> 
      
    </div>
  </div>
</div>

<!-- END PAGE CONTAINER --> 
<?php include("footer_inevntory.php"); ?>

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

	
	 $("#from_date").datepicker({

	   format: 'dd-mm-yyyy'

   	});

   $("#to_date").datepicker({

	   format: 'dd-mm-yyyy'

   });

	 
	 //Load patient count **Nitish
	 $.ajax({
		 url:'ajax/load_patient_count.php',
		 type: 'GET',
		 dataType: 'json',
		 success: function(data){
			 $("#total_patient").html(data.total_patient);
			 $("#today_ipd_total_patient").html(data.today_ipd_total_patient);
			 $("#today_opd_total_patient").html(data.today_opd_total_patient);
			 $("#today_my_total_patient").html(data.today_my_total_patient);
		 },
	 });
	

 });

 

 function check_sms_send(id){
		//alert(id);
		$("#sms_msg_patient_name").val("");
		$("#sms_msg_patient_wp_no").val("");
		$("#sms_msg_patient_mrd").val("");
		$("#sms_msg_patient_id").val("");
		$("#sms_msg_primary_doctor").val("");
		$("#sms_msg_patient_mrd_span").html("");
		$("#sms_msg_patient_name_span").html("");
		$("#sms_msg_patient_wp_no_span").html("");
		$("#msg_sent").html("");
		$("#error_mobile_no_flag").val("");
		
		$.ajax({
			type : "POST",
			url : "<?php echo ADMIN_URL; ?>get_json_sms.php?data_flag=1",
			dataType : "json", 
			data : "id="+id,
			success : function(data) {	
				$('#draggable_SMS').modal('show'); 
				$("#sms_msg_patient_name").val(data.sms_msg_patient_name);
				$("#sms_msg_patient_wp_no").val(data.sms_msg_patient_wp_no);
				$("#sms_msg_patient_mrd").val(data.sms_msg_patient_mrd);
				$("#sms_msg_patient_id").val(data.sms_msg_patient_id);
				$("#sms_msg_primary_doctor").val(data.sms_msg_primary_doctor);
				$("#sms_msg_patient_mrd_span").html(data.sms_msg_patient_mrd);
				$("#sms_msg_patient_name_span").html(data.sms_msg_patient_name);
				$("#sms_msg_patient_wp_no_span").html(data.sms_msg_patient_wp_no);
				$("#error_mobile_no_flag").val(data.error_mobile_no_flag);
			}
		});				
 
} 

function prescription_sms(){
		var sms_msg_patient_wp_no=$("#sms_msg_patient_wp_no").val();
		if(sms_msg_patient_wp_no==''){
			$("#msg_sent").html("SMS no. is not provided, please edit prescription to enter SMS no.");
			$("#msg_sent").css("color","#cc335c");
			setInterval(function(){
				   $('#msg_sent').html('');
				}, 8000);
			return false;
		}
		var error_mobile_no_flag=$("#error_mobile_no_flag").val();
		if(error_mobile_no_flag=='1'){
			$("#msg_sent").html("SMS no. is not valid, please edit prescription to enter valid SMS no.");
			$("#msg_sent").css("color","#cc335c");
			setInterval(function(){
				   $('#msg_sent').html('');
				}, 8000);
			return false;
		}
		var form_data={
					"sms_msg_patient_name":$("#sms_msg_patient_name").val(),
					"sms_msg_patient_wp_no":$("#sms_msg_patient_wp_no").val(),	
					"sms_msg_patient_mrd":$("#sms_msg_patient_mrd").val(),
					"sms_msg_patient_id":$("#sms_msg_patient_id").val(),
					"sms_msg_primary_doctor":$("#sms_msg_primary_doctor").val()			
			};
		
		$.ajax({
			type : "POST",
			url : "<?php echo ADMIN_URL; ?>get_json_sms.php?data_flag=2",
			dataType : "json", 
			data : form_data,
			success : function(data) {	
				if(data.return_flag==1){			
					$("#msg_sent").html("SMS Message Sent Successfully...");
					$("#msg_sent").css("color","#33cc80");
				}else{
					$("#msg_sent").html("SMS Message did not sent, try again..");
					$("#msg_sent").css("color","#cc335c");
				}
				setInterval(function(){
				   $('#msg_sent').html('');
				}, 6000);
			}
		});				
 
} 

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



var tab_asset_entry_for_emr="";

load_admssion_details_for_emr();

function load_admssion_details_for_emr(){	

if(tab_asset_entry_for_emr!="") tab_asset_entry_for_emr.destroy();

var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val(),	
					"uhid_no_srch": $("#uhid_no_srch").val()		
	}

	$.ajax({



            url: 'get_json_data_for_ipd_details.php?flag=12',

			dataType: 'json',

			type: 'POST',
			data: data_details,

			beforeSend: function(){

			// Show image container

			$('#assets_body_for_emr').html('');

			//$("#loader").show();

			$('#assets_body_for_emr').html($('#assets_body_for_emr').html()+'<tr><td colspan="10" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');			

			

		   },

			success: function (data) {

			 $('#assets_body_for_emr').html('');

			  $.each(data, function(index, element) {

				  if(element.rowclass!=''){
					  var style_css='style="background-color:'+element.rowclass+'  !important;"';
				  }else{
					  var style_css='';
				  }
				   <?php 				

					if($_SESSION['role']!='5'){ ?>

						var td_add='<td><b>'+element.pri_doct+'</b></td>';

					<?php }else{?>
					
					var td_add='';
					<?php }?>
			 	$('#assets_body_for_emr').html($('#assets_body_for_emr').html()+'<tr '+style_css+'><td>'+element.sl_no+'</td><td><b>'+element.mrd_no+'</b></td><td><b>'+element.pateint_name+'</b></td><td><b>'+element.purpose_visit_name+'</b></td><td><b>'+element.pateint_others_test+'</b></td><td><b>'+element.data_details+'</b></td><td>'+element.dialation+'</td><td><b>'+element.optom_name+'</b></td>'+td_add+'<td><b>'+element.action_tab+'</b></td></tr>');

		 	});

				tab_asset_entry_for_emr=$("#asset_entry_data_for_emr").DataTable( {

					"destroy": true,

					dom: 'Bfrtip',

					"pageLength": 50,

					"language": {

					  "emptyTable": "No data available......"

					},

					"initComplete": function(settings, json) {

					//$('#products_filter').hide();

				}

				} );

				

				//$("#filter_show_all_data").prop("onclick", null).off("click");

			 }

		  });



}


function date_wise_db(){
	load_admssion_details_for_emr();
}

</script> 

<!-- END PAGE CONTAINER -->



<!-- END JAVASCRIPTS -->

</body><!-- END BODY -->

</html>