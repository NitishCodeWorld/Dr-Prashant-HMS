<?php
include 'function.php';

include "conn.php"; // Using database connection file here
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

if(isset($_REQUEST['delete']))

{

$status=1;

$deleted_by=$_SESSION['id'];

$deleted_time=date('Y-m-d H:i:s');	

$sql = "UPDATE `patient_follow_up_form` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `id`='".$_REQUEST['delete']."'";

$result=$conn->query($sql);

if ($conn->query($sql) === TRUE)

{

$msg= "Record deleted successfully";

$redirectUrl=ADMIN_URL.'view_registration_form.php?msg='.$msg;

echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

} 

else 

{

$msg= "Error deleting record: " . $conn->error;

}

}

if(isset($_REQUEST['delete_slip']))

{

$status=1;

$deleted_by=$_SESSION['id'];

$deleted_time=date('Y-m-d H:i:s');	

$sql = "UPDATE `patient_slip_generate_form` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `id`='".$_REQUEST['delete_slip']."'";

$result=$conn->query($sql);

if ($conn->query($sql) === TRUE)

{

$new_quer=$conn->query("UPDATE `prescription_details_for_emr` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `slip_id`='".$_REQUEST['delete_slip']."'");

$msg= "Record deleted successfully";

$redirectUrl=ADMIN_URL.'view_registration_form.php?msg='.$msg;

echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

} 

else 

{

$msg= "Error deleting record: " . $conn->error;

}

}


if(isset($_REQUEST['delete_walk_in']))

{

$status=1;

$deleted_by=$_SESSION['id'];

$deleted_time=date('Y-m-d H:i:s');	

$sql = "UPDATE `patient_registration_form` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `id`='".$_REQUEST['delete_walk_in']."'";

$result=$conn->query($sql);

if ($conn->query($sql) === TRUE)

{

$msg= "Record deleted successfully";

$redirectUrl=ADMIN_URL.'view_registration_form.php?msg='.$msg;

echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

} 

else 

{

$msg= "Error deleting record: " . $conn->error;

}

}


?>
<?php include "header_inventory.php"; ?>
<style>
.head_span {
	font-size:18px;
	font-weight:bold;
	color:red;
}
.new_div_row {
	border:4px solid #006 !important;/*padding:6px !important;*/
}
</style>
<!-- END HEADER -->

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container"> 
  
  <!-- BEGIN PAGE HEAD -->
  
  <?php $today=date('Y-m-d'); ?>
  
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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Patients record</span></div>
            </div>
            
            <!-- BEGIN FORM-->
            
            <div class="table-toolbar">
              <div class="row">
                <div class="col-md-12">
                  <center>
                    <div class="col-md-3">
                      <div class="btn-group">
                        <button id="" class="btn btn-default green">
                        <a onclick="if(confirm('Are you sure to UHID Generate for Walk In Patient?')) return true; else return false;"  title="Walk In Patient" style="color:#fff !important; text-decoration:none" href="<?php echo ADMIN_URL; ?>registration_form_add.php?appt_id=0&patient_admission_type=2"><strong>&nbsp; &nbsp; Add New Walk In Patient + &nbsp; &nbsp;</strong></a>
                        </button>
                      </div>
                    </div>
                    <div class="col-md-9"> </div>
                    <div class="col-md-12">
                      <p><br/>
                      </p>
                    </div>
                    <?php 
					$last_uhid="";
					$sql9="SELECT * FROM `mrd_increments` ORDER BY `id` DESC LIMIT 1; ";
					 $result9=$conn->query($sql9) ;	
					 $row9 = $result9->fetch_assoc();
					 $count9=$result9->num_rows;			
					 if($count9>0)			
					 {
			
						$last_uhid=$row9['mrd_no'];
			
					 }
					?>
                    <div class="col-md-12">
                      <p><span class="head_span">Last MRD No./ UHID No. : <?php echo $last_uhid;?></span> </p>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <select class="form-control" name="type" id="type">
                          <option value="1"  >UHID No./ MRD / Hospital No.</option>
                          <option value="2"  >Name</option>
                          <option value="3" >Phone No.</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <input type="text" id="srch" name="srch" class="form-control" value="" placeholder="Enter value">
                      </div>
                      <div class="col-md-4">
                        <button type="button" name="submit" id="submit" class="btn blue" title="Submit" onclick="old_pt_search_db(1);">Search</button>
                      </div>
                      <div class="col-md-12">
                        <p><br/>
                        </p>
                      </div>
                      <table class="table table-striped table-hover table-bordered" id="asset_entry_data_for_old_db">
                        <thead>
                          <tr>
                            <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                            <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No</th>
                            <th class="draggable" data-column="asset_name" style="cursor: move;">OLD Prefix</th>
                            <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Name</th>
                            <th class="draggable" data-column="asset_name" style="cursor: move;">Reg. Date</th>
                            <th class="draggable" data-column="asset_name" style="cursor: move;">DOB</th>
                            <th class="draggable" data-column="asset_name" style="cursor: move;">Gender</th>
                            <th class="draggable" data-column="asset_name" style="cursor: move;">Phone No.</th>
                            <th class="draggable" data-column="asset_name" style="cursor: move;">Address</th>
                            <th class="print_ignore"><span>Action</span></th>
                          </tr>
                        </thead>
                        <tbody id="assets_body_for_old_db">
                        </tbody>
                      </table>
                    </div>
                  </center>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>
                  <button class="close" data-close="alert"></button>
                  <span id="error_msg">
                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg']; echo '</div>';}?>
                  </span> </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- END PAGE CONTENT INNER --> 
        
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-3"> </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo date("d-m-Y"); ?>" />
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo date("d-m-Y"); ?>" />
          </div>
          <div class="col-md-1">
            <button type="button" name="submit" id="submit" class="btn blue" title="Submit" onclick="date_wise_db();">Filter</button>
          </div>
          <div class="col-md-2"> </div>
        </div>
        <div class="col-md-12">
          <p>&nbsp; <br/>
          </p>
        </div>
      </div>
      <div class="col-md-12">
        <p>&nbsp;</p>
      </div>
      <div class="row new_div_row">
        <div class="col-md-12">
          <div class="col-md-4"></div>
          <div class="col-md-4 btn btn-sm red">
            <center>
              <strong>Today Registration By Patient List</strong>
            </center>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-hover table-bordered" id="asset_entry_data_for_reg_by_pat">
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Name</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Phone No.</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Reg. Date<br />
                  Time</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Doctor</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Details</th>
                <th class="print_ignore"><span>Action</span></th>
              </tr>
            </thead>
            <tbody id="assets_body_for_reg_by_pat">
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <p>&nbsp;</p>
      </div>
      <div class="row new_div_row">
        <div class="col-md-12">
          <div class="col-md-4"></div>
          <div class="col-md-4 btn btn-sm red">
            <center>
              <strong>Today Appointments List</strong>
            </center>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-hover table-bordered" id="asset_entry_data">
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Name</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Phone No.</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Appt. Date<br />
                  Time</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Doctor</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Procedure</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Description</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Details</th>
                <th class="print_ignore"><span>Action</span></th>
              </tr>
            </thead>
            <tbody id="assets_body">
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <p>&nbsp; <br/>
        </p>
      </div>
      <div class="row new_div_row">
        <div class="col-md-12">
          <div class="col-md-4"></div>
          <div class="col-md-4 btn btn-sm red">
            <center>
              <strong>Today Walk In Patient List</strong>
            </center>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-hover table-bordered" id="asset_entry_data_for_walk_in">
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Name</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Phone No.</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Reg. Date<br />
                  Time</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Doctor</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Details</th>
                <th class="print_ignore"><span>Action</span></th>
              </tr>
            </thead>
            <tbody id="assets_body_for_walk_in">
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <p>&nbsp; <br/>
        </p>
      </div>
      <div class="row new_div_row">
        <div class="col-md-12">
          <div class="col-md-4"></div>
          <div class="col-md-4 btn btn-sm red">
            <center>
              <strong>Today Follow UP Patient List</strong>
            </center>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-hover table-bordered" id="asset_entry_data_for_follow_up">
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Name</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Phone No.</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Reg. Date<br />
                  Time</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Doctor</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Details</th>
                <th class="print_ignore"><span>Action</span></th>
              </tr>
            </thead>
            <tbody id="assets_body_for_follow_up">
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        <p>&nbsp; <br/>
        </p>
      </div>
      <div class="row new_div_row">
        <div class="col-md-12">
          <div class="col-md-4"></div>
          <div class="col-md-4 btn btn-sm red">
            <center>
              <strong>Today Slip List</strong>
            </center>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-hover table-bordered" id="asset_entry_data_for_slip_generated">
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Name</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Phone No.</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Slip Generated<br>
                  Date & Time</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Doctor</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Slip SL. No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Details</th>
                <th class="print_ignore"><span>Action</span></th>
              </tr>
            </thead>
            <tbody id="assets_body_for_slip_generated">
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal fade" id="patient_reg_image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b> View Patient Registration Image </b></h5>
              
              <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>--> 
              
            </div>
            <div class="modal-body">
              <center>
                <div class="col-md-12" style="padding-top:50px;" > <img src="" id="patient_reg_image_loading" /> <a href=""  id="download_image_href" style="vertical-align:bottom;" download ><img src="<?php echo ADMIN_URL."icon/download_icon.png"; ?>" id="download_image" /></a></div>
                <div class="col-md-12" style="padding-top:50px;" >
                  <div class="col-md-6">
                    <table class="table table-striped table-hover table-bordered">
                      <thead>
                        <tr>
                          <td><b>UHID</b></td>
                          <td><b>Patient Name</b></td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><span id="uhid_span"></span></td>
                          <td><span id="pat_name_span"></span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </center>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <p>&nbsp; <br/>
        </p>
      </div>
      <div class="row new_div_row">
        <div class="col-md-12">
          <div class="col-md-4"></div>
          <div class="col-md-4 btn btn-sm red">
            <center>
              <strong>Today Post up Patient</strong>
            </center>
          </div>
          <div class="col-md-4"> </div>
        </div>
        <div class="col-md-12">
          <div class="btn-group">
            <label> Dicharge From Date
              <input type="text" class="form-control" placeholder="Select From Date" id="date_form_discharge" name="date_form_discharge" value="<?php echo date("d-m-Y"); ?>" />
            </label>
            <label> Dicharge To Date
              <input type="text" class="form-control" placeholder="Select To Date" id="date_to_discharge" name="date_to_discharge" value="<?php echo date("d-m-Y"); ?>" />
            </label>
            <label> Purpose Of Filter	Date:
              <select class="form-control" name="filter_purpose_of_discharge" id="filter_purpose_of_discharge">
                <option value="next_postop_chkup"> Next post-op check-up Date </option>
                <option value="final_postop_chkup"> Final post-op check-up Date </option>
                <option value="registration_date"> Registration Date </option>
                <option value="discharge_date"> Discharge Date </option>
              </select>
            </label>
            <!--<label> Post-op Date:
                         <input type="text" class="form-control" placeholder="Select To Date" id="post_up_form_discharge" name="date_to_discharge" value="" />
                      </label>
                      <label> Final post-op Date:
                         <input type="text" class="form-control" placeholder="Select To Date" id="final_up_form_discharge" name="post_up_form_discharge" value="" />
                      </label>
                      -->
            <label>
              <button id="filter_search" onclick="get_post_op_discharge_details();">Filter</button>
            </label>
            <!--<label>
                        <button onclick="$('#datepicker_select').val(''); tab_val_menu.draw();">Show All</button>
                      </label>--> 
          </div>
        </div>
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-hover table-bordered" id="get_post_op_discharge">
            
            <!--<p style="text-align:right">By Copmpany, Vacancy Number</p>-->
            
            <thead>
              <tr>
                <th style="width: 20px;">Sl No.</th>
                <th style="width: 100px;">UHID No.</th>
                <th style="width: 150px;">Patient Name</th>
                <th style="width: 80px;">Phone No.</th>
                <th style="width: 80px;">Reg. Date Time</th>
                <th style="width: 80px;">Discharge Date Time.</th>
                <th style="width: 80px;">Post-op Date Time</th>
                <th style="width: 100px;">Final Post-op Date</th>
                <th style="width: 150px;">Doctor</th>
                <th style="width: 100px;">Anaesthetist  Doctor</th>
                <th style="width: 80px;">Remarks</th>
                <th style="width: 50px;">Action</th>
              </tr>
            </thead>
            <tbody id="post_op_descharge_tbody">
            </tbody>
          </table>
          <div class="modal fade" id="remarks_modal" tabindex="-1" role="dialog" aria-labelledby="remarks_modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="remarks_modalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                  <label>Remarks</label>
                  <textarea name="discharge_remarks" id="discharge_remarks" class="form-control"></textarea>
                  <input type="hidden" name="discharge_summery_id" id="discharge_summery_id" value="" />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="update_discharge_summery();">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- END PAGE CONTENT --> 
    
  </div>
  
  <!-- END PAGE CONTAINER --> 
  
</div>
<?php include("footer_inevntory.php"); ?>
<script>

 $(document).ready( function() {    

 	$('input').attr('autocomplete','off');   

	setTimeout('$("#alert_msg").hide()',3000);
	 $("#from_date").datepicker({
	   format: 'dd-mm-yyyy'
   	});
   $("#to_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
	$("#date_form_discharge").datepicker({
	   format: 'dd-mm-yyyy'
   });
   $("#post_up_form_discharge").datepicker({
	   format: 'dd-mm-yyyy'
   });
   $("#final_up_form_discharge").datepicker({
	   format: 'dd-mm-yyyy'
   });
   $("#date_to_discharge").datepicker({
	   format: 'dd-mm-yyyy'
   });
 });

var tab_asset_entry="";

load_admssion_details();

function load_admssion_details(){	

if(tab_asset_entry!="") tab_asset_entry.destroy();
	var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val()			
	}
	
	$.ajax({



            url: 'get_json_data_for_ipd_details.php?flag=1',

			dataType: 'json',
			data: data_details,

			type: 'POST',

			beforeSend: function(){

			// Show image container

			$('#assets_body').html('');

			//$("#loader").show();

			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="10" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');			

			

		   },

			success: function (data) {

			 $('#assets_body').html('');

			  $.each(data, function(index, element) {

				  if(element.mrd_no==''){

					var background_color="";  

				  }else{

					  var background_color="style='background-color: #d0e9c6;'";  

				  }
				  var profile_pic="";
				  if(element.mrd_no!=''){
					  if(element.patient_reg_upload!=''){
						   profile_pic=' | <a href="javascript:void(0);"  onclick="image_view(\''+element.patient_reg_upload+'\',\''+element.mrd_no+'\',\''+element.name+'\');" title="Patient Image Show" ><img src="<?php echo ADMIN_URL."icon/user.png"; ?>"  title="Patient Image Show"></a>';
					  }else{
						  //var profile_pic='';
						  var emtry_pic=''
						  profile_pic=' | <a href="javascript:void(0);"  onclick="image_view(\''+emtry_pic+'\',\''+element.mrd_no+'\',\''+element.name+'\');" title="Patient Image Show" ><img src="<?php echo ADMIN_URL."icon/user.png"; ?>"  title="Patient Image Show"></a>';
					  }
				  }
				  

			 	$('#assets_body').html($('#assets_body').html()+'<tr '+background_color+'><td>'+element.sl_no+'</td><td><b>'+element.mrd_no+'</b></td><td><b>'+element.name+'</b></td><td><b>'+element.phone_no+'</b></td><td><b>'+element.appt_time+'</b></td><td><b>'+element.doctor_name+'</b></td><td>'+element.procedure_name+'</td><td>'+element.description+'</td><td>'+element.data_details+'</td><td>'+element.action_tab+' '+profile_pic+' '+element.action_tab_new+'</td></tr>');

		 	});

				tab_asset_entry=$("#asset_entry_data").DataTable( {

					"destroy": true,

					dom: 'Bfrtip',

					"pageLength": 15,

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





var tab_asset_entry_for_walk_in="";

load_admssion_details_for_walk_in();

function load_admssion_details_for_walk_in(){	

if(tab_asset_entry_for_walk_in!="") tab_asset_entry_for_walk_in.destroy();

var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val()			
	}

	$.ajax({



            url: 'get_json_data_for_ipd_details.php?flag=2',

			dataType: 'json',

			type: 'POST',
			data: data_details,

			beforeSend: function(){

			// Show image container

			$('#assets_body_for_walk_in').html('');

			//$("#loader").show();

			$('#assets_body_for_walk_in').html($('#assets_body_for_walk_in').html()+'<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');			

			

		   },

			success: function (data) {

			 $('#assets_body_for_walk_in').html('');

			  $.each(data, function(index, element) {

				  if(element.old_db_fetch=='1'){
					  var style_css='style="background-color:#87c0ef  !important;"';
				  }else{
					  var style_css='';
				  }
				  if(element.patient_reg_upload!=''){
					  var profile_pic=' | <a href="javascript:void(0);"  onclick="image_view(\''+element.patient_reg_upload+'\',\''+element.uhid_no+'\',\''+element.patient_name+'\');" title="Patient Image Show" ><img src="<?php echo ADMIN_URL."icon/user.png"; ?>"  title="Patient Image Show"></a>';
				  }else{
					  //var profile_pic='';
					  var emtry_pic=''
					  var profile_pic=' | <a href="javascript:void(0);"  onclick="image_view(\''+emtry_pic+'\',\''+element.uhid_no+'\',\''+element.patient_name+'\');" title="Patient Image Show" ><img src="<?php echo ADMIN_URL."icon/user.png"; ?>"  title="Patient Image Show"></a>';
				  }

			 	$('#assets_body_for_walk_in').html($('#assets_body_for_walk_in').html()+'<tr '+style_css+'><td>'+element.sl_no+'</td><td><b>'+element.uhid_no+'</b></td><td><b>'+element.patient_name+'</b></td><td><b>'+element.phone_no+'</b></td><td><b>'+element.appt_time+'</b></td><td><b>'+element.doctor_name+'</b></td><td>'+element.data_details+'</td><td>'+element.action_tab+' '+profile_pic+' '+element.action_tab_new+'</td></tr>');

		 	});

				tab_asset_entry_for_walk_in=$("#asset_entry_data_for_walk_in").DataTable( {

					"destroy": true,

					dom: 'Bfrtip',

					"pageLength": 15,

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





var tab_asset_entry_for_follow_up="";

load_admssion_details_for_follow_up();
function load_admssion_details_for_follow_up(){	

var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val()			
	}

if(tab_asset_entry_for_follow_up!="") tab_asset_entry_for_follow_up.destroy();

	$.ajax({



            url: 'get_json_data_for_ipd_details.php?flag=3',

			dataType: 'json',

			type: 'POST',
			data: data_details,

			beforeSend: function(){

			// Show image container

			$('#assets_body_for_follow_up').html('');

			//$("#loader").show();

			$('#assets_body_for_follow_up').html($('#assets_body_for_follow_up').html()+'<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');			

			

		   },

			success: function (data) {

			 $('#assets_body_for_follow_up').html('');

			  $.each(data, function(index, element) {

				  

			 	$('#assets_body_for_follow_up').html($('#assets_body_for_follow_up').html()+'<tr ><td>'+element.sl_no+'</td><td><b>'+element.uhid_no+'</b></td><td><b>'+element.patient_name+'</b></td><td><b>'+element.phone_no+'</b></td><td><b>'+element.appt_time+'</b></td><td><b>'+element.doctor_name+'</b></td><td>'+element.data_details+'</td><td>'+element.action_tab+'</td></tr>');

		 	});

				tab_asset_entry_for_follow_up=$("#asset_entry_data_for_follow_up").DataTable( {

					"destroy": true,

					dom: 'Bfrtip',

					"pageLength": 15,

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

var tab_asset_entry_for_slip_generated="";

load_admssion_details_for_slip_generated();


function load_admssion_details_for_slip_generated(){	
var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val()			
	}

if(tab_asset_entry_for_slip_generated!="") tab_asset_entry_for_slip_generated.destroy();

	$.ajax({



            url: 'get_json_data_for_ipd_details.php?flag=4',

			dataType: 'json',

			type: 'POST',
			data: data_details,

			beforeSend: function(){

			// Show image container

			$('#assets_body_for_slip_generated').html('');

			//$("#loader").show();

			$('#assets_body_for_slip_generated').html($('#assets_body_for_slip_generated').html()+'<tr><td colspan="9" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');			

			

		   },

			success: function (data) {

			 $('#assets_body_for_slip_generated').html('');

			  $.each(data, function(index, element) {

				  

			 	$('#assets_body_for_slip_generated').html($('#assets_body_for_slip_generated').html()+'<tr ><td>'+element.sl_no+'</td><td><b>'+element.uhid_no+'</b></td><td><b>'+element.patient_name+'</b></td><td><b>'+element.phone_no+'</b></td><td><b>'+element.appt_time+'</b></td><td><b>'+element.doctor_name+'</b></td><td><b>'+element.slip_no+'</b></td><td>'+element.data_details+'</td><td>'+element.action_tab+' '+element.action_tab_new+'</td></tr>');

		 	});

				tab_asset_entry_for_slip_generated=$("#asset_entry_data_for_slip_generated").DataTable( {

					"destroy": true,

					dom: 'Bfrtip',

					"pageLength": 15,

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

var tab_asset_entry_for_old_db="";
old_pt_search_db(0);
function old_pt_search_db(fl){
	
	if(tab_asset_entry_for_old_db!="") tab_asset_entry_for_old_db.destroy();
	var type=$('#type').val();
	var srch=$('#srch').val();
	if(fl=='1'){
	if(srch==''){
		alert("please enter search value!!");
		return false; 	
	}
	}
	$.ajax({

				type : "POST",

				url : "<?php echo ADMIN_URL; ?>ajax/old_db_ajax.php?flag=1",
				dataType : "json",

				data : "type="+type+"&srch="+srch+"&page_name=reg",

				success : function(data) {	
				 $('#assets_body_for_old_db').html('');
	
				  $.each(data, function(index, element) {
	
					var profile_pic="";
					if(element.check_flag!='0'){
					  if(element.uhid_no!=''){
						  if(element.patient_reg_upload!=''){
							   profile_pic=' <a href="javascript:void(0);"  onclick="image_view(\''+element.patient_reg_upload+'\',\''+element.uhid_no+'\',\''+element.patient_name+'\');" title="Patient Image Show" ><img src="<?php echo ADMIN_URL."icon/user.png"; ?>"  title="Patient Image Show"></a>';
						  }else{
							  //var profile_pic='';
							  var emtry_pic=''
							  profile_pic=' <a href="javascript:void(0);"  onclick="image_view(\''+emtry_pic+'\',\''+element.uhid_no+'\',\''+element.patient_name+'\');" title="Patient Image Show" ><img src="<?php echo ADMIN_URL."icon/user.png"; ?>"  title="Patient Image Show"></a>';
						  }
					  }  
					}
	
					$('#assets_body_for_old_db').html($('#assets_body_for_old_db').html()+'<tr ><td>'+element.sl+'</td><td><b>'+element.uhid_no+'</b></td><td><b>'+element.old_prefix+'</b></td><td><b>'+element.patient_name+'</b></td><td><b>'+element.registration_date+'</b></td><td><b>'+element.dob+'</b></td><td>'+element.old_gender+'</td><td>'+element.phone_no+'</td><td>'+element.address+'</td><td>'+element.action_tab_new+''+profile_pic+''+element.action_tab+'</td></tr>');
	
				});
	
					tab_asset_entry_for_old_db=$("#asset_entry_data_for_old_db").DataTable( {
	
						"destroy": true,
	
						dom: 'Bfrtip',
	
						"pageLength": 15,
	
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
	load_admssion_details();
	load_admssion_details_for_walk_in();
	load_admssion_details_for_follow_up();
	load_admssion_details_for_slip_generated();
	load_admssion_details_for_reg_by_pat();
}

function image_view(image_file,uhid,pat_name){
	//alert(image_file);	
	$('#uhid_span').html('');
	$('#pat_name_span').html('');
	$("#patient_reg_image_loading").attr("src","<?php echo ADMIN_URL; ?>icon/blank-profile-picture.png");
	$('#patient_reg_image_modal').modal('show');
	$('#uhid_span').html(uhid);
	$('#pat_name_span').html(pat_name);
	if(image_file==''){
		$("#patient_reg_image_loading").attr("src","<?php echo ADMIN_URL; ?>icon/blank-profile-picture.png");
		$("#download_image_href").attr("href","javascript:void(0);");
		$("#download_image_href").removeAttr('download')
		$("#download_image_href").removeAttr('target');;
	}else{
		$("#patient_reg_image_loading").attr("src","<?php echo ADMIN_URL; ?>upload/patient_reg_upload/"+image_file);		
		$("#download_image_href").attr("href","<?php echo ADMIN_URL; ?>upload/patient_reg_upload/"+image_file);
		$('#download_image_href').attr('target', '_blank');
	}
	
}
var get_post_op_discharge='';
get_post_op_discharge_details();
function get_post_op_discharge_details(){
	if(get_post_op_discharge!="") get_post_op_discharge.destroy();
	var data_details={
		"from_date": $('#date_form_discharge').val(),
		"to_date": $('#date_to_discharge').val(),
		"filter_purpose_of_discharge": $('#filter_purpose_of_discharge').val(),
		//"final_up_form_discharge": $('#final_up_form_discharge').val()
	   }
	$.ajax({
		url: 'get_json_data_for_appr_reports.php?flag=1',
		dataType: 'json',
		data: data_details,
		type: 'POST',
		success: function (data) {
			var html='';
			var sl=1;
			$.each(data, function(index, element) {
			html +='<tr><td>'+sl+'</td><td>'+element.uhid_no+'</td><td>'+element.patient_name+'</td><td>'+element.phone_no+'</td><td>'+element.registration_date+' '+element.registration_time+'</td><td>'+element.discharge_date+' '+element.discharge_time+'</td><td>'+element.next_postop_chkup+'</td><td>'+element.final_postop_chkup+'</td><td>'+element.admiting_doctor+'</td><td>'+element.anaesthetst_doctor+'</td><td>'+element.discharge_remarks+'</td><td style="display:flex;gap:11px;">'+element.action_tab+'</td></tr>';	
			sl++;});
			$('#post_op_descharge_tbody').html(html);
			get_post_op_discharge=$("#get_post_op_discharge").DataTable( {
	
						"destroy": true,
	
						dom: 'Bfrtip',
	
						"pageLength": 15,
	
						"language": {
	
						  "emptyTable": "No data available......"
	
						},
	
						"initComplete": function(settings, json) {
	
						//$('#products_filter').hide();
	
					}
	
					} );
		}
	  });
}
function remarks_patient(id,name,discharge_remarks){
	$('#remarks_modalLabel').html('Remarks For <b>'+name+'</b>');
	$('#discharge_summery_id').val(id);
	//var sss=$.parseJSON(discharge_remarks);
	//console.log(sss);
	//var dis=discharge_remarks.replace("//n/g", "\n");
	var dis=discharge_remarks.replaceAll("/n", "\n");
	$('#discharge_remarks').val(dis);
}
function update_discharge_summery(){
	var data_details={
		"discharge_remarks": $('#discharge_remarks').val(),
		"id": $('#discharge_summery_id').val(),
	   }
	$.ajax({
			url: 'get_json_data_for_appr_reports.php?flag=2',
			dataType: 'json',
			data: data_details,
			type: 'POST',
			success: function (data) {
				alert(data.Msg);
				$('#remarks_modal').modal('toggle');
				$('#discharge_remarks').val('');
				get_post_op_discharge_details();
			}
	});
}

var tab_asset_entry_for_reg_by_pat="";

load_admssion_details_for_reg_by_pat();

function load_admssion_details_for_reg_by_pat(){	

if(tab_asset_entry_for_reg_by_pat!="") tab_asset_entry_for_reg_by_pat.destroy();

var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val()			
	}

	$.ajax({



            url: 'get_json_data_for_ipd_details.php?flag=11',

			dataType: 'json',

			type: 'POST',
			data: data_details,

			beforeSend: function(){

			// Show image container

			$('#assets_body_for_reg_by_pat').html('');

			//$("#loader").show();

			$('#assets_body_for_reg_by_pat').html($('#assets_body_for_reg_by_pat').html()+'<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');			

			

		   },

			success: function (data) {

			 $('#assets_body_for_reg_by_pat').html('');

			  $.each(data, function(index, element) {

				  if(element.uhid_no==''){
					  var style_css='style="background-color:#87c0ef  !important;"';
				  }else{
					  var style_css='style="background-color:#87efbe  !important;"';
				  }
				  
			 	$('#assets_body_for_reg_by_pat').html($('#assets_body_for_reg_by_pat').html()+'<tr '+style_css+'><td>'+element.sl_no+'</td><td><b>'+element.uhid_no+'</b></td><td><b>'+element.patient_name+'</b></td><td><b>'+element.phone_no+'</b></td><td><b>'+element.appt_time+'</b></td><td><b>'+element.doctor_name+'</b></td><td>'+element.data_details+'</td><td>'+element.action_tab+' '+element.action_tab_new+'</td></tr>');

		 	});

				tab_asset_entry_for_reg_by_pat=$("#asset_entry_data_for_reg_by_pat").DataTable( {

					"destroy": true,

					dom: 'Bfrtip',

					"pageLength": 15,

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

</script>
</body><!-- END BODY -->

</html>