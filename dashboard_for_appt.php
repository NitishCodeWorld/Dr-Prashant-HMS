<?php 

include 'conn.php';

?>
<?php include_once("header_for_appt.php"); ?>

<!-- BEGIN PAGE CONTAINER -->
<style>
.ajax-loader {
	visibility: hidden;
	background-color: rgba(255, 255, 255, 0.7);
	position: absolute;
	z-index: +100 !important;
	width: 100%;
	height:100%;
}
.ajax-loader img {
	position: relative;
	top:50%;
	left:50%;
}
#sample_editable_1_filter {
	display:none;
}
.danger_span {
	font-weight:bold;
	color:#F03;
}
.button-clicked {
	background: red !important;
}
#selected_date_time {
	font-size:16px;
	font-weight:bold;
	color:#F03;
}
#first_name{
	text-transform: capitalize;
}
.doc_tr{
	border: none !important;
}
.doc_tr_special{
	border: none !important;
	font-size:18px !important;
	font-weight:bold !important;
}
#appt_list_span{
	font-size:18px !important;
	font-weight:bold !important;
	color:#C06;
	padding:6px;
	
}
.next {
    background: #e5dcdc !important;
}
.paginate_button.next:hover {
    background-color: #333 !important; /* Example: blue background */
    color: white !important;
    cursor: pointer;
    border-radius: 5px;
    transition: all 0.3s ease;
}

</style>

<div class="page-container"> 
  
  <!-- BEGIN PAGE HEAD -->
  
  <div class="page-head">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE TITLE -->
      
      <div class="page-title">
        <h1><small>Welcome to Dashboard</small></h1>
      </div>
      
      <!-- END PAGE TITLE --> 
      
    </div>
  </div>
  
  
  <!-- END PAGE HEAD --> 
  
  <!-- BEGIN PAGE CONTENT -->
  

 
  <div id="ajax_password" class="modal fade" role="large" aria-hidden="true">
    <div class="modal-dialog" style="width:500px">
      <div class="modal-content" style="padding:5px">
        <div class="row">
          <div class="col-md-12"> 
            
            <!-- BEGIN PAGE VIEW OF A LEAD TABLE PORTLET-->
            
            <div class="portlet-body">
              <input type="hidden" id="my_patient_id" />
              <label>Password:
                <input type="password" class="form-input" id="password" />
              </label>
              <label>
                <input type="button" value="Submit" onclick="validate_pw()" />
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="page-content">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE CONTENT INNER -->
      
      <div class="row margin-top-10">
        <div class="col-md-12">
          <div class="col-md-4">
            <select class="form-control" name="type" id="type">
              <option value="3" >Phone No.</option>
              <option value="1"  >UHID No./ MRD / Hospital No.</option>
              <option value="2"  >Name</option>
            </select>
          </div>
          <div class="col-md-4">
            <input type="text" id="srch" name="srch" class="form-control" value="" placeholder="Enter value">
          </div>
          <div class="col-md-4">
            <button type="button" name="submit" id="submit" class="btn blue" title="Submit" onclick="old_pt_search_db(1);">Search</button>
            <button type="button" name="booking_as_new_btn" id="booking_as_new_btn" class="btn red" title="Submit" onclick="booking_as_new();">Booking As New Patient</button>
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
        <div class="col-md-8"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-red-pink"></i> <span class="caption-subject font-red-pink bold uppercase">Appointment Information</span>&nbsp;<br>
                <span style="font-size:10pt !important;">(Find a doctor and make your appointment online)</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body"> 
              
              <!-- BEGIN FORM--> 
              
              <!--/span-->
              <div class="form-body">
                <div class="row" style="padding:9px 0px">
                  <div class="col-md-4">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Date Of Appt.</label>
                        <div id="datepicker" data-date-format="dd/mm/yyyy"> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Doctor *</label>
                        <select class="form-control select2" id="doctors" onchange="load_procedures(0);">
                          <option value="">-Select-</option>
                        </select>
                        <input type="hidden" id="selected_time" value="0" />
                        <input type="hidden" id="opd_flag" value="1" />
                        <input type="hidden" id="user_id" value="<?php echo $_SESSION['id'];?>" />
                      </div>
                    </div>
                    
                    <!--/span-->
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Branches *</label>
                        <select class="form-control" id="branches" onchange="get_doctors_schedule()">
                          <option value="7">(None)</option>
                        </select>
                      </div>
                    </div>
                    
                    <!--/span-->
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Select OPD Procedure *</label>
                        <select class="form-control"  id="opd_procedures" onchange="get_doctors_schedule()">
                          <option value="" selected="selected">(None)</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12"> <span id="selected_date_time"></span>
                      <hr>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group" id="button_box">
                        <label>OPD Timing *</label>
                      </div>
                      <hr>
                    </div>
                  </div>
                  
                  <!--/span-->
                  
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Referred Doctor</label>
                        <select class="form-control select2"  id="ref_doctor_id" >
                          <option value="" selected="selected">(None)</option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Procedure Purpose</label>
                        <div class="input-group">
                        <select class="form-control"  id="procedures_purpose" >
                          <option value="" selected="selected">(None)</option>
                        </select>
                        <span class="input-group-addon"><a href="javascript:void(0);" onClick="purpose_add();" title="add">Ok</a></span> </div>
                      </div>
                    </div>
                    
                  </div>
                  
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Description *</label>
                      <textarea name="description" id="description" class="form-control" cols="45" rows="5"></textarea>
                    </div>
                  </div>
                  
                  <!--/span--> 
                  
                </div>
              </div>
              
              <!-- END FORM--> 
              
            </div>
            
            <!---------------------------------------------------------------------> 
            
          </div>
          
          <!-- END EXAMPLE TABLE PORTLET--> 
          
        </div>
        <div class="col-md-4"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-red-pink"></i> <span class="caption-subject font-red-pink bold uppercase">Patient Information</span>&nbsp;<br>
                <span style="font-size:10pt !important;">(Please fill needful details)</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body"> 
              
              <!-- BEGIN FORM-->
              
              <div class="form-body">
                <div class="row" style="padding:9px 0px">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">UHID No. *</label>
                      <input type="text" id="mrd_no" class="form-control"  placeholder="" value="<?php if(isset($_REQUEST['mrd_no'])){ echo $_REQUEST['mrd_no'];}?>" readonly />
                      <input type="hidden" id="button_id_save" value="" />
                      <!-- <small><a href="javascript:void(0)" class="btn btn-xs yellow" onclick="get_patient_info('mrd_no')" />Search&nbsp;&nbsp;<i class="fa fa-search"></i></a></small>--> </div>
                  </div>
                  
                  <!--/span-->
                  
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Full Name<span class="danger_span"> * (Without Prefix i.e Mr. , Miss. etc)</span> </label>
                      <div class="input-group">
                      <input type="text" id="first_name" class="form-control" placeholder="" value="<?php if(isset($_REQUEST['first_name'])){ echo $_REQUEST['first_name'];}?>" onblur="case_convrt('first_name')" readonly />
                      <span class="input-group-addon"><a href="javascript:void(0);" onClick="edit_enable('first_name')" title="edit"><img src="icon/erase64x64.png" title="edit" class="img-responsive" /> </a></span> </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Phone/Mobile<span class="danger_span"> * (Enter 10 Digit Ph No.)</span></label>
                      
                      <div class="input-group">
                   <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'');mobile_check();" onblur="mobile_check();" name="phone"  id="phone"  autocomplete="off" placeholder="Enter 10 Digit ph no." class="form-control" value="<?php if(isset($_REQUEST['phone'])){ echo $_REQUEST['phone'];}?>" readonly />
                    <span class="input-group-addon"><a href="javascript:void(0);" onClick="edit_enable('phone')" title="edit"><img src="icon/erase64x64.png" title="edit" class="img-responsive" /> </a></span> </div>
                    <span id="error_mobie" style="color: red;font-weight:bold;"></span>
                       </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Email ID </label>
                      <input type="email" id="email" class="form-control" placeholder="" value="<?php if(isset($_REQUEST['email'])){ echo $_REQUEST['email'];}?>">
                      <input type="hidden" id="old_db_id" class="form-control" placeholder="" value="">
                      <input type="hidden" id="patient_info_unique_id" class="form-control" placeholder="" value="">
                      <input type="hidden" id="opd_schedule_unique_id" class="form-control" placeholder="" value="">
                      <input type="hidden" id="button_id_for_color" class="form-control" placeholder="" value="">
                    </div>
                  </div>
                  
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">DOB<span class="danger_span">  (dd-mm-YYYY)</span></label>                      
                      <div class="input-group">
                   <input type="text" class="form-control" placeholder="Select DOB" id="dob" name="dob" value="" />
                    <span class="input-group-addon"><a href="javascript:void(0);"  id="calculate" class="btn btn-sm blue" title="Calculate" onclick="age_calculate();">Calculate</a></span> </div>
                      </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Age<span class="danger_span">  (In Years)</span> <a href="javascript:void(0);"  id="calculate_dob" class="btn btn-sm blue" title="Calculate" onclick="dob_calculate();">Calculate DOB</a></label>                      
                      <div class="input-group">
                   <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="age"  id="age"  autocomplete="off" placeholder="Enter Age" class="form-control" value="<?php if(isset($_REQUEST['age'])){ echo $_REQUEST['age'];}?>"  />
                    <span class="input-group-addon">Years</span> </div>
                      </div>
                  </div>
                  
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Gender/Sex</label>
                      <select class="form-control" name="gender" id="gender" >
                        <?php 

								  $sql7="SELECT `id`, `gender` FROM `gender_masters`  WHERE  `del_flag`='0' ORDER BY `id` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['gender'].'</option>';

								 }

					 			?>
                      </select>
                   
                      </div>
                  </div>
                  
                  <!--/span--> 
                  
                </div>
                
                <!--<p style="padding:12px 0 2px 0; text-align:center"><a href="#" class="btn btn-sm red" title="Submit">Submit</a></p> -->
                
                <p style="padding:11px 0 11px 0; text-align:center" id="submit_but"><a href="javascript:" id="submit_appt" onClick="save_form()" class="btn btn-sm blue" title="Submit" >Submit</a>&nbsp;<a href="<?php echo ADMIN_URL; ?>dashboard_for_appt.php" class="btn btn-sm red" title="Cancel">Cancel</a></p>
              </div>
              
              <!-- END FORM--> 
              
            </div>
          </div>
          
          <!-- END EXAMPLE TABLE PORTLET--> 
          
        </div>
        <div class="col-md-12"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">OPD Schedule Patient Information</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-group"> 
                      <!--<label>
                        <input type="text" id="datepicker_select" data-date-format="dd-mm-yyyy" /></label>-->
                        <label> From Date
                         <input type="text" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo date("d-m-Y"); ?>" />
                      </label>
                      <label> From Date
                         <input type="text" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo date("d-m-Y"); ?>" />
                      </label>
                      <label >Doctor
                        <select class="form-control select2" id="doctors_list" >
                          <option value="">-Select-</option>
                        </select>
                      </label>
                      <label >Branch
                        <select class="form-control" id="branches_list"  >
                        </select>
                      </label>
                      <label> Patient UHID No.
                        <input type="text" class="form-control" id="patient_uhid_search" value="" />
                      </label>
                      <label> Patient Name
                        <input type="text" class="form-control" id="patient_name_search" value="" />
                      </label>
                      </label>
                      <label> Patient Ph
                        <input type="text" class="form-control" id="patient_ph_search" value="" />
                      </label>
                      
                      <label>
                        <button id="filter_search" onclick="get_doctors_schedule2();">Filter</button>
                      </label>
                      
                    </div>
                  </div>
                  
                  <div class="col-md-12"><center><span id="appt_list_span"></span></center></div>
                  
                </div>
              </div>
              
              <table class="table table-striped table-hover table-bordered" id="get_appt_list">                
                <thead>
                   <tr>
                    <th style="width: 20px;"  class="noExport" >Sl No.</th>
                    <th style="width: 20px;">Doc Wise <br/>Sl No.</th>
                    <th style="width: 80px;" class="noExport_new" >Appt. Date</th>
                      <th style="width: 80px;">Time</th>
                      <th style="width: 150px;">Patient Name</th>
                      <th style="width: 80px;">Age/Sex</th>
                    <th style="width: 100px;">UHID No.</th>                    
                      <th style="width: 80px;">Ref By</th>
                      <th style="width: 100px;">Description</th>                      
                    <th style="width: 80px;">Phone No.</th>
                    <th style="width: 150px;">Created By</th>
                    <th style="width: 50px;" class="noExport">Action</th>
                   <!-- <th style="width: 50px;">DOC</th>-->
                  </tr>
                </thead>
                <tbody id="get_appt_tbody">                
                </tbody>
              </table>
            </div>
            
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-group"> 
                        <label> From Date
                         <input type="text" class="form-control" placeholder="Select From Date" id="date_form_discharge" name="date_form_discharge" value="<?php echo date("d-m-Y"); ?>" />
                      </label>
                       <label> To Date
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
                      <label>
                        <button id="filter_search" onclick="get_post_op_discharge_details();">Filter</button>
                      </label>
                     
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="get_post_op_discharge">                
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
            </div>
          </div>
          <div class="modal fade" id="remarks_modal" tabindex="-1" role="dialog" aria-labelledby="remarks_modalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="remarks_modalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
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
          <!-- END EXAMPLE TABLE PORTLET--> 
          
        </div>
        <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>icon/loader.gif" class="img-responsive" /> </div>
      </div>
      
      <!-- END PAGE CONTENT INNER --> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTENT --> 
  
</div>

<!-- END PAGE CONTAINER -->

<?php include_once("footer_for_appt.php"); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js" type="text/javascript"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js" integrity="sha512-RLw8xx+jXrPhT6aXAFiYMXhFtwZFJ0O3qJH1TwK6/F02RSdeasBTTYWJ+twHLCk9+TU8OCQOYToEeYyF/B1q2g==" crossorigin="anonymous"></script> 
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> 

<!--<script src="select2/select2.min.js"></script>--> 

<script> 


 $(document).ready( function() { 

 

 $("#doctors").select2();	
 $("#ref_doctor_id").select2();

 $("#doctors_list").select2();	
 
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
   $("#dob").datepicker({
       format: 'dd-mm-yyyy'
   });
   
   

 });

 	



load_branches();

load_doctors("2");
load_ref_doctors("0","");
load_procedures_purpose();


function age_calculate(){
	var dob = $("#dob").val();
	if(dob==''){
		alert('Please Select DOB');
		return false;	
	}
	$.ajax({
			type: "POST",
			url: "<?php echo ADMIN_URL; ?>ajax_for_emr/age_change_ajax_for_emr.php",
			dataType: "json",
			data: "dob=" + dob,
			success: function(data) {
					$("#age").val(data.age);    
			}
	});     
}

function dob_calculate(){
	var age = $("#age").val();
	if(age==''){
		alert('Please Enter Age');
		return false;	
	}
	$.ajax({
			type: "POST",
			url: "<?php echo ADMIN_URL; ?>ajax_for_emr/dob_change_ajax_for_emr.php",
			dataType: "json",
			data: "age=" + age,
			success: function(data) {
					$("#dob").val(data.dob);    
			}
	});     
}

function load_ref_doctors(defualts_val,selected_doc_id){

	$('#ref_doctor_id')

	.find('option')

	.remove()

	.end();
	
	/*$('#ref_doctor_id')

	.append($('<option/>', {

		value: "",

		text : "-Select-"

	}));*/

	$.ajax({

	 url: 'get_json_data_for_appt.php',

			dataType: 'json',

			type: 'POST',

			data: 'flag=62&defualts_val='+defualts_val,

			success: function (data) {

			 $.each(data, function(index, element) {

					$('#ref_doctor_id')

				.append($('<option/>', {

								value: element.value,

								text : element.doctor_name+' ( '+element.doctor_ini+' ) '

							}));

			 });
			 if(defualts_val=='0'){
			 $("#ref_doctor_id").select2("val", "1");
			 }else{
			 if(selected_doc_id==''){
			 	$("#ref_doctor_id").select2("val", "1");
				
			 }else{
				 $("#ref_doctor_id").select2("val", selected_doc_id); 
			 }
			 }
			 
			 }
			 

			 });

}


function load_procedures_purpose(){

	$('#procedures_purpose')

	.find('option')

	.remove()

	.end();

	$('#procedures_purpose')

	.append($('<option/>', {

		value: "",

		text : "-Select-"

	}));

	$.ajax({

	 url: 'get_json_data_for_appt.php',

			dataType: 'json',

			type: 'POST',

			data: 'flag=63',

			success: function (data) {

			 $.each(data, function(index, element) {

					$('#procedures_purpose')

				.append($('<option/>', {

								value: element.purpose_name,

								text : element.purpose_name

							}));

			 });
			 }

			 });

}

function purpose_add(){
	
	var procedures_purpose=$( "#procedures_purpose" ).val();
	if(procedures_purpose==''){
		procedures_purpose='';
	}else{
		procedures_purpose=procedures_purpose;
	}
	var description=$( "#description" ).val();
	var description_text='';
	if(description==''){		
		description_text=description+procedures_purpose;
	}else{
		description_text=description+' , '+procedures_purpose;
	}
	$( "#description" ).val(description_text);
}


//load_procedures();


$( "#datepicker" ).datepicker();


//$("#datepicker").daterangepicker();



	var start = moment();

	var end = start;



    function cb(start, end) {
        //$('#datepicker_select span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    }


    $('#datepicker_select').daterangepicker({



        startDate: start,



        endDate: end,



		ranges: {



           'Today': [moment(), moment()],



           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],



           'Last 7 Days': [moment().subtract(6, 'days'), moment()],



           'Last 30 Days': [moment().subtract(29, 'days'), moment()],



           'This Month': [moment().startOf('month'), moment().endOf('month')],



           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]



        }



    }, cb);

    cb(start, end);


$("#datepicker").click(function() {



        var start=$.datepicker.formatDate("mm/dd/yy", $("#datepicker").datepicker("getDate"));



		var end=$.datepicker.formatDate("mm/dd/yy", $("#datepicker").datepicker("getDate"));
		//cb(start, end);
		//$('#datepicker_select').val(start+" - "+end);
		get_doctors_schedule();

    }); 

function get_doctors_schedule(){

	

	if(!$("#opd_procedures").val()){

		alert("Procedure not selected");

		return;	

	} 

	

	var selected_date=$.datepicker.formatDate("yy-mm-dd", $("#datepicker").datepicker("getDate"));



	var selected_date_now=$.datepicker.formatDate("yymmdd", $("#datepicker").datepicker("getDate"));

	var doctor_id=0;


	var today = new Date();



	var dd = String(today.getDate()).padStart(2, '0');



	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!



	var yyyy = today.getFullYear();


	$("#submit_but").html('<a href="javascript:" onClick="save_form()" class="btn btn-sm blue" title="Submit">Submit</a>&nbsp;<a href="<?php echo ADMIN_URL; ?>dashboard_for_appt.php" class="btn btn-sm red" title="Cancel">Cancel</a>');


	let today_now = yyyy +''+  mm+''  + dd;	



	if(parseInt(selected_date_now)<parseInt(today_now)) $("#submit_but").html("");

	doctor_id=$("#doctors").val();


	var procedure_id=$("#opd_procedures").val();

	var branch_id=$("#branches").val();

	

	$("#button_box").html("Loading...");

	



	$.ajax({



            url: 'get_json_data_for_appt.php',



			dataType: 'json',



			type: 'POST',



			data: 'flag=1&doc_id='+doctor_id+'&branches_id='+branch_id+'&selected_date='+selected_date+"&opd_flag=1"+"&procedure_id="+procedure_id,



			success: function (data) {



			$("#button_box").html("");



			$("#button_box").append("<label>OPD Timing *</label>");



			var i=0;



			 $.each(data, function(index, element) {



			// console.log($('#tab_flag').val());



			 	if(typeof(element.button_name)!="undefined"){

					

				 var cntr=6;



				 if(check) cntr=3;


				 if(i%cntr==0) $("#button_box").append("<div class='input-group' style='margin-bottom:3px !important'>");



					//console.log(element.button_name);

				 if(parseInt(element.flag)>="1") {$("#button_box").append("<button type='button' class='btn ' disabled style='width:80px;background:"+element.bgcolor+";color:#ffffff' value='"+element.value+"'>"+element.button_name+"</button>");}



				 else { 

				 if(parseInt(element.confirm_col)=="0"){

				//button_selected_check(\''+element.button_id_unique+'\');
				
				 $("#button_box").append("<button type='button' class='btn' onclick='show_div();button_selected_check(\""+element.button_id_unique+"\");alert(this.value); document.getElementById(\"selected_time\").value=this.value;' style='width:80px;background:"+element.bgcolor+";color:#ffffff' value='"+element.value+"' id='"+element.button_id_unique+"'>"+element.button_name+"</button>");

				 } 
				 if(parseInt(element.confirm_col)=="1"){

					  $("#button_box").append("<button type='button' class='btn' onclick='check_psw(this.value);' style='width:80px;background:"+element.bgcolor+";color:#ffffff' value='"+element.value+"' >"+element.button_name+"</button>");
				 }
				 }



				 i++;



				}



			 });

			 //alert(i);



				if(i<=0) $("#button_box").append("<b><font size='14px' color='red'>Not Available</font>");

				var button_id_for_color=$("#button_id_for_color").val();
				//alert(button_id_for_color);
				if(button_id_for_color!=''){
					$('#'+button_id_for_color).css('background','#861c9f');
				}
				

			 }



			 });

}







function get_doctors_schedule2(){

get_appt_list_details();

}







function show_div(){

	$("#submit_but").css("display", "block");

}



function check_psw(time_appt){

  var person = prompt("Please Enter password:");

  if ( person == "appt@2021") {



    alert("Right Password");



	$("#selected_time").val(time_appt);



	$("#submit_but").css("display", "block");



  }



  else  {



    alert("Wrong password");



	$("#submit_but").css("display", "none");



  }

}







function save_form(){

	var dt=$.datepicker.formatDate("yy-mm-dd", $("#datepicker").datepicker("getDate"));



	//alert("Date:"+dt);

	if(!$("#opd_procedures").val()){

		alert("Procedure not selected");

		return false;	

	} 
	
	if(!$("#first_name").val()){

		alert("Please enter patient name....");

		return false;	

	} 
	
	if(!$("#phone").val()){

		alert("Please enter patient phone no....");

		return false;	

	} 
	
	if(!$("#selected_time").val()){

		alert("Please choose time slot for appointment....");

		return false;	

	}
	
	var mob_flag=mobile_check();
	//alert(mob_flag);
	//return false;
	if(mob_flag=='1'){
		alert('Please check phone no.');
		return false;
	}

	

	var procedure_id= $("#opd_procedures").val() ;



	var procedure_name=$("#opd_procedures option:selected").text() ;



	var form_data={



					"fname":$("#first_name").val(),



					"mrd_no":$("#mrd_no").val(),

					"email":$("#email").val(),



					"phone_no":$("#phone").val(),

					"doc_id":$("#doctors").val(),

					

					"doc_name":$("#doctors option:selected").text(),



					"branches_id":$("#branches").val(),



					"selected_time":$("#selected_time").val(),



					"selected_date":dt,



					"description":$("#description").val(),



					"flag":"3",



					"opd_flag":$("#opd_flag").val(),



					"branches_name":$("#branches option:selected").text(),



					"user_id":$("#user_id").val(),



					"procedure_id": procedure_id,



					"procedure_name":procedure_name,
					"old_db_id":$("#old_db_id").val(),
					"age":$("#age").val(),
					"gender":$("#gender").val(),
					"ref_doctor_id":$("#ref_doctor_id").val(),
					"dob":$("#dob").val()

			};



		$.ajax({



				url: 'get_json_data_for_appt.php',



				dataType: 'json',



				type: 'POST',



				data: form_data,



				success: function (data) {				

				if(data.flag=="1"){
					 var opd_schedule_unique_id=$("#opd_schedule_unique_id").val();
					 if(opd_schedule_unique_id!=''){
					 	delete_val_edit(opd_schedule_unique_id);  
					 }

					 alert("You are successfully scheduled");	

					 reset_values();

					 get_doctors_schedule();	
					  location_change();				

					}	

					if(data.flag=="2"){

					 alert("Appoinment is not scheduled");	

					 reset_values();

					 get_doctors_schedule();	
					  location_change();				

					}

				 }

				 });	



}



function ask_pw(id){



	$("#my_patient_id").val(id);

	$("#ajax_password").modal('show');



}



function validate_pw(){



	const id=$("#my_patient_id").val();

	const pw=$("#password").val();

	$.ajax({



				url: 'get_json_data_for_appt.php?flag=49',



				dataType: 'json',



				type: 'POST',



				data: "pw="+pw,



				success: function (data) {

					if(data.flag=="1"){

						$("#password").val('');

						delete_val(id)

					}else alert("Invalid Password");

				}

				

			});



}



function delete_val(id){

	const sms_flag=0;

	//alert(id);

	

	if(!confirm("Are you sure you want to delete?")) return;

	//if(confirm("Do you want to send cancelled SMS to the patient?")) sms_flag=1;

	$.ajax({



				url: 'get_json_data_for_appt.php?flag=13',



				dataType: 'json',



				type: 'POST',



				data: "id="+id+"&sms_flag="+sms_flag,



				success: function (data) {



					if(data.flag=="1"){



					 alert("You are successfully deleted the schedule");



					 $("#ajax_password").modal('hide');

					  location_change();

					}

				 }



				 });
}

function delete_val_edit(id){

	const sms_flag=0;

	$.ajax({
				url: 'get_json_data_for_appt.php?flag=13',
				dataType: 'json',
				type: 'POST',
				data: "id="+id+"&sms_flag="+sms_flag,
				success: function (data) {
					if(data.flag=="1"){
					 /*alert("You are successfully deleted the schedule");
					 $("#ajax_password").modal('hide');*/
					  location_change();

					}

				 }

				 });
}








function reset_values(){

	$("#mrd_no").val("");

	$("#phone").val("");

	$("#first_name").val("");

	$("#email").val("");

	$("#description").val("");

	/*$('#phone').attr('readonly', 'false');

	$('#first_name').attr('readonly', 'false');

	$('#email').attr('readonly', 'false');*/

	$('#phone').prop('readonly', false);

	$('#first_name').prop('readonly', false);

	$('#email').prop('readonly', false);
	$("#old_db_id").val("");
	$("#selected_time").val("");
	$("#patient_info_unique_id").val("");
	$("#opd_schedule_unique_id").val("");
	var button_id_for_color=$("#button_id_for_color").val();				
	if(button_id_for_color!=''){
		$('#'+button_id_for_color).css('background','#009933');
	}
	$("#button_id_for_color").val('');
	$("#age").val("");
	$("#dob").val("");
	$("#gender").val("1");
}



var input = document.getElementById("phone");

//var input1 = document.getElementById("mrd_no");

// Execute a function when the user releases a key on the keyboard



input.addEventListener("keyup", function(event) {

  // Number 13 is the "Enter" key on the keyboard

  if (event.keyCode === 13) {

    // Cancel the default action, if needed

	event.preventDefault();

    get_patient_info('phone');

  }



});



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

				url : "<?php echo ADMIN_URL; ?>ajax/old_db_ajax.php?flag=3",
				dataType : "json",

				data : "type="+type+"&srch="+srch+"&page_name=appt",

				success : function(data) {	
				 $('#assets_body_for_old_db').html('');
	
				  $.each(data, function(index, element) {
						if(element.action_tab=='0'){	
					 		 var profile_pic='<a href="javascript:void(0);"  onclick="select_appt(\''+element.uhid_no+'\',\''+element.patient_name+'\',\''+element.phone_no+'\',\''+element.old_db_id+'\',\''+element.new_db_id+'\',\''+element.action_tab+'\');" title="Take appt" ><button id="" class="btn btn-default red">Select</button></a>';
						}
						if(element.action_tab=='1'){	
					  		var profile_pic='<a href="javascript:void(0);"  onclick="select_appt(\''+element.uhid_no+'\',\''+element.patient_name+'\',\''+element.phone_no+'\',\''+element.old_db_id+'\',\''+element.new_db_id+'\',\''+element.action_tab+'\');" title="Take appt" ><button id="" class="btn btn-default green">Select</button></a>';
						}
	
					$('#assets_body_for_old_db').html($('#assets_body_for_old_db').html()+'<tr ><td>'+element.sl+'</td><td><b>'+element.uhid_no+'</b></td><td><b>'+element.old_prefix+'</b></td><td><b>'+element.patient_name+'</b></td><td><b>'+element.registration_date+'</b></td><td><b>'+element.dob+'</b></td><td>'+element.old_gender+'</td><td>'+element.phone_no+'</td><td>'+element.address+'</td><td>'+profile_pic+'</td></tr>');
	
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

function booking_as_new(){	
	$("#phone").removeAttr("readonly");
	$("#first_name").removeAttr("readonly");
	$('#phone').val('');
	$('#first_name').val('');
	$('#mrd_no').val('');
	$('#description').val('');
	$('#old_db_id').val('');
	$("#selected_time").val("");
	$("#patient_info_unique_id").val("");
	$("#opd_schedule_unique_id").val("");
	$("#button_id_for_color").val('');
	var button_id_save="";
	button_id_save=$('#button_id_save').val();
	if(button_id_save!=''){
		$('#'+button_id_save).css('background','#009933');
	}
	var srch=$('#srch').val();
	if($('#type').val()=='3'){
		if($('#srch').val()!=''){
		var id_values=srch;
		var newStr = id_values.replace(/[a-zA-Z]/g, '');
		var newStr2 = newStr.replace(/[ ]/g, '');
		var newStr3 = newStr2.replace(/[_\W]+/g, '');
		$('#phone').val(newStr3);
		}
	}
	mobile_check();
}

function select_appt(mrd_no,first_name,phone_no,old_db_id,new_db_id,action_tab){
	$('#phone').val('');
	$('#first_name').val('');
	$('#mrd_no').val('');
	$('#description').val('');
	$('#old_db_id').val('');
	
	
	$('#phone').val(phone_no);
	$('#first_name').val(first_name);
	$('#mrd_no').val(mrd_no);
	$('#description').val('');
	$('#old_db_id').val(old_db_id);
	case_convrt('first_name');
	// working
	$.ajax({	
			type : "POST",	
			url : "<?php echo ADMIN_URL; ?>get_json_data_for_appt.php?flag=64",	
			dataType : "json",	
			data : "mrd_no="+mrd_no,	
			success : function(data) {
				$("#dob").val(data.dob);	
				$("#gender").val(data.gender);
				$("#age").val(data.age);		
			}	
		});
		
		mobile_check();
	
}
function button_selected_check(button_id){
	//alert(button_id);
	$("#selected_date_time").html('');	
	var button_id_save="";
	button_id_save=$('#button_id_save').val();
	if(button_id_save!=''){
		$('#'+button_id_save).css('background','#009933');
	}
	$('#button_id_save').val(button_id);
	$('#'+button_id).css('background','#861c9f');
	//selected_date_time  selected_time
	var select_date_cal=$.datepicker.formatDate("yy-mm-dd", $("#datepicker").datepicker("getDate"));
	var selected_times=$('#'+button_id).val();
	$.ajax({	
			type : "POST",	
			url : "<?php echo ADMIN_URL; ?>get_json_data_for_appt.php?flag=59",	
			dataType : "json",	
			data : "select_date_cal="+select_date_cal+"&selected_times="+selected_times,	
			success : function(data) {
				var selected_date_time=	'Appointment taken for : '+data.select_date_cal+' '+data.first_letter;
				$("#selected_date_time").html('');	
				$("#selected_date_time").html(selected_date_time);			
			}	
		});
	//alert(select_date_cal);
}
function edit_enable(field_id){
	$("#"+field_id).removeAttr("readonly");
	
}
function special_edit_infos(patient_info_unique_id,opd_schedule_unique_id){
	$('#patient_info_unique_id').val('');
	$('#opd_schedule_unique_id').val('');
	$('#button_id_for_color').val('');
	if(!confirm("Are you sure you want to edit?")) return;
	//alert("edit");
	$('#patient_info_unique_id').val(patient_info_unique_id);
	$('#opd_schedule_unique_id').val(opd_schedule_unique_id);
	$.ajax({	
			type : "POST",	
			url : "<?php echo ADMIN_URL; ?>get_json_data_for_appt.php?flag=60",	
			dataType : "json",	
			data : "patient_info_unique_id="+patient_info_unique_id+"&opd_schedule_unique_id="+opd_schedule_unique_id,	
			success : function(data) {
				var selected_date_time=	'Appointment taken for : '+data.selected_slot_show_special_edit;
				$("#selected_date_time").html('');	
				$("#selected_date_time").html(selected_date_time);	
				
				$("#mrd_no").val('');	
				$("#mrd_no").val(data.mrd_no_special_edit);		
				$("#first_name").val('');	
				$("#first_name").val(data.name_special_edit);	
				$("#first_name").removeAttr("readonly");
				$("#phone").val('');	
				$("#phone").val(data.phone_no_special_edit);	
				$("#phone").removeAttr("readonly");
				$("#description").val('');	
				$("#description").val(data.description_special_edit);
				$("#doctors").select2("val", "");
				$("#doctors").select2("val", data.doc_id_special_edit);
				$("#branches").val('');	
				$("#branches").val(data.branches_id_special_edit);
				$("#description").val('');	
				$("#description").val(data.description_special_edit);
				load_procedures(data.opd_procedures_id_special_edit);
				$("#opd_flag").val('1');
				$("#old_db_id").val('');	
				$("#old_db_id").val(data.old_db_id_special_edit);
				$("#datepicker").datepicker('setDate', data.selected_date_calender_special_edit);
				$('#button_id_for_color').val(data.button_id_unique);
				$('#selected_time').val(data.selected_slot_start_ending);
				$("#email").val('');	
				$("#email").val(data.email_id_special_edit);	
				case_convrt('first_name');		
				$("#age").val('');	
				$("#age").val(data.age_special_edit);
				$("#gender").val('1');	
				$("#gender").val(data.gender_special_edit);	
				$("#ref_doctor_id").select2("val", "1");				
				load_ref_doctors("1",data.ref_doctor_id_special_edit);
				//$("#ref_doctor_id").select2("val", data.ref_doctor_id_special_edit); 
				$("#dob").val('');	
				$("#dob").val(data.dob_special_edit);
				age_calculate();
				
			}	
		});
	
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

function location_change(){
	
	 $('#filter_search').click();	
}

var get_appt_list_='';
get_appt_list_details();
function get_appt_list_details(){
	//if(get_appt_list_!="") get_appt_list_.destroy();
	$('#get_appt_list').DataTable().destroy();
	var data_details={
		"from_date": $('#from_date').val(),
		"to_date": $('#to_date').val(),
		"branches_list": $('#branches_list').val(),
		"doctors_list": $('#doctors_list').val(),
		"patient_name_search": $('#patient_name_search').val(),
		"patient_uhid_search": $('#patient_uhid_search').val(),
		"patient_ph_search": $('#patient_ph_search').val(),
	   }
	   $('#get_appt_tbody').html('');
	   $('#get_appt_list tbody').empty();
	   $('#appt_list_span').html('');
	   
	  
	   var title_span='Appointment List';
	   var from_date=$('#from_date').val();
	   var to_date=$('#to_date').val();
	   var display_block=0;
	   if(from_date==''){
		   display_block=1;
	   }
	   if(to_date==''){
		   display_block=1;
	   }	   
	   if(display_block=='0'){
		   if(from_date!=to_date){
		   		title_span='Appointment List From '+from_date+' To '+to_date;
				$('#appt_list_span').html(title_span);
	   		}
			else{
				title_span='Appointment List On '+from_date;
				$('#appt_list_span').html(title_span);
			}
		   
	   }else{
		   title_span='Appointment List';
		   $('#appt_list_span').html(title_span);
	   }
	   if(from_date!=to_date){
		   display_block=1;
	   }
	  
		let exportCols = ':not(.noExport)';
		if (display_block === 0) {
			exportCols += ':not(.noExport_new)';
		}
		
		let columnDefs = [];
			if (display_block === 0) {
				columnDefs.push({
					targets: 2,
					visible: false
				});
			} else {
				columnDefs.push({
					targets: 2,
					visible: true
				});
			}
		 
	 	
	   
	$.ajax({
		url: 'get_json_data_for_appt.php?flag=65',
		dataType: 'json',
		data: data_details,
		type: 'POST',
		success: function (data) {
			var html='';
			var sl=1;
			var background_colo=" ";
			$.each(data, function(index, element) {
				
				if(element.doc_sl=='1'){
					html +='<tr><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr_special">'+element.doctor_name+' </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td></tr>';
				}
				background_colo=" ";
				if(element.mrd_no!=''){
					background_colo=" style='background-color: #d0e9c6;' ";
				}
			html +='<tr '+background_colo+'><td>'+element.sl+'</td><td>'+element.doc_sl+'</td><td>'+element.start_date+'</td><td>'+element.start_time+'</td><td>'+element.name+'</td><td>'+element.gender_age+'</td><td>'+element.mrd_no+'</td><td>'+element.ref_by+'</td><td>'+element.description+'</td><td>'+element.phone_no+'</td><td>'+element.created_by+'</td><td>'+element.action_tab+'</td></tr>';	
			sl++;});
			$('#get_appt_tbody').html('');
			
			$('#get_appt_tbody').html(html);
			
			get_appt_list_=$("#get_appt_list").DataTable( {
	
						"destroy": true,
	
						dom: 'Bfrtip',
						"ordering": false,						
						columnDefs: columnDefs,
							"buttons": [
							{
								extend: 'collection',
								text : 'Download',
								 orientation: 'landscape',
								pageSize: 'LEGAL',
								buttons: [	
									{ extend: 'excelHtml5', footer: true, title: title_span, exportOptions: { columns: exportCols } },
									{ extend: 'csvHtml5', footer: true, title: title_span, exportOptions: { columns: exportCols } },
									{ extend: 'pdfHtml5', footer: true, title: title_span, exportOptions: { columns: exportCols }},
									{ extend: 'print', footer: true, title: title_span, exportOptions: { columns: exportCols } }
								]
							}   
						],
	
						"pageLength": 25,
	
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
function case_convrt(input_id){
		let inputText = $("#"+input_id).val();
		//alert(inputText);
		let properCaseText = toProperCase(inputText);
		//alert(properCaseText);
		$("#"+input_id).val(properCaseText);            
}
function toProperCase(str) {
	return str.toLowerCase().replace(/\b\w/g, function(char) {
		return char.toUpperCase();
	});
}
function mobile_check() {
	$('#error_mobie').html('');	
	var mobile = $('#phone').val();
    // Remove all non-digit characters
    mobile = mobile.replace(/\D/g, '');
    $('#phone').val(mobile); // Set only digits back
	var mob_flag=0;
    if (mobile.length > 10) {
      $('#error_mobie').html('Mobile number cannot exceed 10 digits');
	  mob_flag=1;
    }else if (mobile.length < 10) {
      $('#error_mobie').html('Mobile number cannot less than 10 digits');
	  mob_flag=1;
    } else {
      $('#error_mobie').html('');
	  mob_flag=0;
    }
	return mob_flag;
}
</script>