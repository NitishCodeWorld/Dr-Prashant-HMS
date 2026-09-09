<?php 
include 'conn.php';
?>
<?php include_once("header_for_appt.php"); ?>
<!--<link href="https://fullcalendar.io/css/base.css?3.1.0-1.5.0-2" rel="stylesheet" type="text/css"/>-->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css" integrity="sha512-eOKbnuWqH2HMqH9nXcm95KXitbj8k7P49YYzpk7J4lw1zl+h4uCjkCfV7RaY4XETtTZnNhgsa+/7x29fH6ffjg==" crossorigin="anonymous" />
<!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />-->
<link href="select2/select2.css" rel="stylesheet" />
<style>

	body {
		margin: 20px 10px;
		padding: 0;
		font-family: Tahoma,Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}
	
	

.fc-day-grid-event .fc-content{
	white-space:normal;
	padding:0px;
}
	
	#index-page #calendar .fc-event{
		border-style: none !important;
	}


</style>
</head>
<!-- BEGIN PAGE CONTAINER -->
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
  <div class="page-content">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE BREADCRUMB --> 
      <!--<ul class="page-breadcrumb breadcrumb">
        <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"> Dashboard </li>
      </ul> --> 
      <!-- END PAGE BREADCRUMB --> 
      <!-- BEGIN PAGE CONTENT INNER -->
      <div id="main">
        <div id="ajax_4" class="modal fade" role="large" aria-hidden="true">
          <div class="modal-dialog" style="width:700px">
            <div class="modal-content" style="padding:5px">
              <div class="row">
                <div class="col-md-12"> 
                  
                  <!-- BEGIN PAGE VIEW OF A LEAD TABLE PORTLET-->
                  <div class="portlet box green ">
                    <div class="portlet-title">
                      <div class="caption"> <i class="fa fa-gift"></i> Add Availability </div>
                      <div class="tools"> <a href="" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="" class="reload"> </a> <a href="" data-dismiss="modal"> </a> </div>
                    </div>
                    <div class="portlet-body">
                      <div style="float:right;">
                        <input type="button" class="btn blue" onclick="open_modal1()" value="For Particular Date Only click on it" />
                      </div>
                      <div>
                        <label>Date <span id="my_date"></span>
                          <input type="hidden" id="my_dateh" />
                        </label>
                      </div>
                      <div >
                        <label>Select Doctor:&nbsp;
                          <select class="form-control select2" id="doctors" >
                            <option value="">-Select Doctor-</option>
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Select Branch:&nbsp;
                          <select id="branches" >
                            <option value="">Choose a Branch</option>
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Select Schedule Type:&nbsp;
                          <select id="schedule_type" >
                            <option value="1">OPD</option>
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Patient Limit:&nbsp;
                          <input type="number" id="patient_limit" />
                        </label>
                      </div>
                      <div>
                        <label>
                          <input type="checkbox" name="doctors_only" id="doctors_only" value="0" >
                          <span class="caption-subject font-blue-sharp"><strong>&nbsp; &nbsp;Doctor Only</strong></span></label>
                      </div>
                      <!--<div>
	<label>Destination Month Type:&nbsp;<select id="destination_month" ><?php for ($m=1; $m<=12; $m++) {
     $mt = date('F', mktime(0,0,0,$m, 1, date('Y')));
	 $month = date('m', mktime(0,0,0,$m, 1, date('Y'))); ?><option value="<?php echo $month;?>"><?php echo $mt;?></option><?php } ?></select></label>
	</div>-->
                      <div>
                        <label>Destination Month:&nbsp;
                          <select id="destination_month1" >
                          <option value="">-Select-</option>
                            <?php for ($m=1; $m<=12; $m++) {
     $mt = date('F', mktime(0,0,0,$m, 1, date('Y')));
	 $month = date('m', mktime(0,0,0,$m, 1, date('Y'))); ?>
                            <option value="<?php echo $month;?>"><?php echo $mt;?></option>
                            <?php } ?>
                          </select>
                          For the Year
                          <select id="destination_year1" >
                            <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                            <option value="<?php echo date('Y',strtotime("+1 year"));?>"><?php echo date('Y',strtotime("+1 year"));?></option>
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Select Weekday:&nbsp;
                          <select name="weekdays[]" style="width:100px">
                            <option value="">-Select-</option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                          </select>
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="input_starttime[]" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="etime[]" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                      <div>
                        <label>Select Weekday:&nbsp;
                          <select name="weekdays[]" style="width:100px">
                            <option value="">-Select-</option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                          </select>
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="input_starttime[]" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="etime[]" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                      <div>
                        <label>Select Weekday:&nbsp;
                          <select name="weekdays[]" style="width:100px">
                            <option value="">-Select-</option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                          </select>
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="input_starttime[]" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="etime[]" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                      <div>
                        <label>Select Weekday:&nbsp;
                          <select name="weekdays[]" style="width:100px">
                            <option value="">-Select-</option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                          </select>
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="input_starttime[]" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="etime[]" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                      <div>
                        <label>Select Weekday:&nbsp;
                          <select name="weekdays[]" style="width:100px">
                            <option value="">-Select-</option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                          </select>
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="input_starttime[]" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="etime[]" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                      <div>
                        <label>Select Weekday:&nbsp;
                          <select name="weekdays[]" style="width:100px">
                            <option value="">-Select-</option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                          </select>
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="input_starttime[]" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="etime[]" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                      <div>
                        <label>Select Weekday:&nbsp;
                          <select name="weekdays[]" style="width:100px">
                            <option value="">-Select-</option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                          </select>
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="input_starttime[]" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="etime[]" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                      <div>
                        <label>Select Weekday:&nbsp;
                          <select name="weekdays[]" style="width:100px">
                            <option value="">-Select-</option>
                            <option value="1">Sunday</option>
                            <option value="2">Monday</option>
                            <option value="3">Tuesday</option>
                            <option value="4">Wednesday</option>
                            <option value="5">Thursday</option>
                            <option value="6">Friday</option>
                            <option value="7">Saturday</option>
                          </select>
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="input_starttime[]" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="etime[]" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <label>
                  <input type="button" class="btn green" onclick="save_data()" value="Save" />
                  <input type="button" data-dismiss="modal" class="btn red" value="Close" />
                </label>
              </div>
            </div>
          </div>
        </div>
        <div id="ajax_9" class="modal fade" role="large" aria-hidden="true">
          <div class="modal-dialog" style="width:700px">
            <div class="modal-content" style="padding:5px">
              <div class="row">
                <div class="col-md-12"> 
                  
                  <!-- BEGIN PAGE VIEW OF A LEAD TABLE PORTLET-->
                  <div class="portlet box green ">
                    <div class="portlet-title">
                      <div class="caption"> <i class="fa fa-gift"></i> Add Availability </div>
                      <div class="tools"> <a href="" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="" class="reload"> </a> <a href="" data-dismiss="modal"> </a> </div>
                    </div>
                    <div class="portlet-body">
                      <div>
                        <label>Choose Date:&nbsp;
                          <input  type="date" style="width:150px" name="particular_date" id="particular_date" >
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="particular_date_starttime" id="particular_date_starttime" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="particular_date_etime"  id="particular_date_etime" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                      <div>
                        <label>Select Doctor:&nbsp;
                          <select id="particular_date_doctors" class="form-control select2" >
                            <option value="">-Select-</option>
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Select Branch:&nbsp;
                          <select id="particular_date_branches" >
                            <option value="">Choose a Branch</option>
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Select Schedule Type:&nbsp;
                          <select id="particular_date_schedule_type" >
                            <option value="1">OPD</option>
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Patient Limit:&nbsp;
                          <input type="number" id="particular_date_patient_limit" />
                        </label>
                      </div>
                      <div>
                        <label>
                          <input type="checkbox" name="particular_date_doctors_only" id="particular_date_doctors_only" value="0" >
                          <span class="caption-subject font-blue-sharp"><strong>&nbsp; &nbsp;Doctor Only</strong></span></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <label>
                  <input type="button" class="btn green" onclick="save_data9()" value="Save" />
                  <input type="button" data-dismiss="modal" class="btn red" value="Close" />
                </label>
              </div>
            </div>
          </div>
        </div>
        <div id="ajax_5" class="modal fade" role="large" aria-hidden="true">
          <div class="modal-dialog" style="width:700px">
            <div class="modal-content" style="padding:5px">
              <div class="row">
                <div class="col-md-12"> 
                  
                  <!-- BEGIN PAGE VIEW OF A LEAD TABLE PORTLET-->
                  <div class="portlet box green ">
                    <div class="portlet-title">
                      <div class="caption"> <i class="fa fa-gift"></i> Edit and Delete Availability </div>
                      <div class="tools"> <a href="" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="" class="reload"> </a> <a href="" data-dismiss="modal"> </a> </div>
                    </div>
                    <div class="portlet-body">
                      <input type="hidden" id="pk_id" />
                      <label>
                        <input type="button" class="btn green" onclick="edit_data()" value="Edit" />
                        &nbsp;&nbsp;
                        <input type="button" class="btn green" onclick="delete_model_open()"  value="Delete" />
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <label>
                  <input type="button" data-dismiss="modal" class="btn red" value="Close" />
                </label>
              </div>
            </div>
          </div>
        </div>
        <div id="ajax_6" class="modal fade" role="large" aria-hidden="true">
          <div class="modal-dialog" style="width:700px">
            <div class="modal-content" style="padding:5px">
              <div class="row">
                <div class="col-md-12"> 
                  
                  <!-- BEGIN PAGE VIEW OF A LEAD TABLE PORTLET-->
                  <div class="portlet box green ">
                    <div class="portlet-title">
                      <div class="caption"> <i class="fa fa-gift"></i> Edit Schedule </div>
                      <div class="tools"> <a href="" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="" class="reload"> </a> <a href="" data-dismiss="modal"> </a> </div>
                    </div>
                    <div class="portlet-body">
                      <div>
                        <label>Date: <span id="my_date1"></span>
                          <input type="hidden" id="my_dateh1" />
                        </label>
                      </div>
                      <div>
                        <label>Select Doctor:&nbsp;
                          <select class="form-control select2" id="doctors1" >
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Select Branch:&nbsp;
                          <select id="branches1" >
                            <option value="">Choose a Branch</option>
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Select Schedule Type:&nbsp;
                          <select id="schedule_type1" >
                            <option value="1">OPD</option>
                          </select>
                        </label>
                      </div>
                      <div>
                        <label>Patient Limit:&nbsp;
                          <input type="number" id="patient_limit1" />
                        </label>
                      </div>
                      <div>
                        <label>
                          <input type="checkbox" name="doctors_only1" id="doctors_only1" value="0" >
                          <span class="caption-subject font-blue-sharp"><strong>&nbsp; &nbsp;Doctor Only</strong></span></label>
                      </div>
                      <label>Destination Month:&nbsp;
                        <select id="destination_month1" >
                        <option value="">-Select-</option>
                          <?php for ($m=1; $m<=12; $m++) {
     $mt = date('F', mktime(0,0,0,$m, 1, date('Y')));
	 $month = date('m', mktime(0,0,0,$m, 1, date('Y'))); ?>
                          <option value="<?php echo $month;?>"><?php echo $mt;?></option>
                          <?php } ?>
                        </select>
                        For the Year
                        <select id="destination_year1" >
                          <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                          <option value="<?php echo date('Y',strtotime("+1 year"));?>"><?php echo date('Y',strtotime("+1 year"));?></option>
                        </select>
                      </label>
                      <div>
                        <label>Select Weekday:&nbsp;
                          <select name="weekdays1[]" id="myweekday" style="width:100px">
                            <option value="">-Select-</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                          </select>
                        </label>
                        <label>Start Time: <span>
                          <input placeholder="00:00" type="text" style="width:100px" name="input_starttime1" id="input_starttime1" class="timepicker timepicker-default">
                          </span> </label>
                        <label>End Time: <span>
                          <input type="text" placeholder="00:00" name="etime1" id="etime1" style="width:100px" class="timepicker timepicker-default" />
                          </span></span> </label>
                      </div>
                      <div>
                        <label style="margin-right:5px">Update Full Year&nbsp;
                          <input checked="checked" value="1" type="radio" name="updateflag" id="full_year" />
                        </label>
                        <label>Update This Date Only&nbsp;
                          <input type="radio" name="updateflag" value="2" id="this_year" />
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <label>
                  <input type="button" class="btn green" onclick="update_data()" value="Save" />
                  <input type="button" data-dismiss="modal" class="btn red" value="Close" />
                </label>
              </div>
            </div>
          </div>
        </div>
        <div id="ajax_7" class="modal fade" role="large" aria-hidden="true">
          <div class="modal-dialog" style="width:700px">
            <div class="modal-content" style="padding:5px">
              <div class="row">
                <div class="col-md-12"> 
                  
                  <!-- BEGIN PAGE VIEW OF A LEAD TABLE PORTLET-->
                  <div class="portlet box green ">
                    <div class="portlet-title">
                      <div class="caption"> <i class="fa fa-gift"></i> Delete Availability </div>
                      <div class="tools"> <a href="" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="" class="reload"> </a> <a href="" data-dismiss="modal"> </a> </div>
                    </div>
                    <div class="portlet-body">
                      <input type="hidden" id="pk_id_for_delete" />
                      <div>
                        <label style="margin-right:5px">Update Full Year&nbsp;
                          <input checked="checked" value="1" type="radio" name="updateflag1" id="full_year1" />
                        </label>
                        <label>Update This Date Only&nbsp;
                          <input type="radio" name="updateflag1" value="2" id="this_year1" />
                        </label>
                      </div>
                      <div>
                        <label>
                          <input type="button" class="btn green" onclick="delete_data()" value="Delete" />
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <label>
                  <input type="button" data-dismiss="modal" class="btn red" value="Close" />
                </label>
              </div>
            </div>
          </div>
        </div>
        <div>
          <label>Select Doctor:&nbsp;
            <select class="form-control select2"  id="choose_doctors" >
              <option value="">Choose a Doctor</option>
            </select>
          </label>
          &nbsp;&nbsp;<!--
    <b>BBeye Foundation VIP:</b> <span class="btn btn-sm" style="background-color: #83AFFA;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;<b>Netralayam:</b> <span class="btn btn-sm" style="background-color: #ff9900;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;<b>OT:</b> <span class="btn btn-sm" style="background-color: #BCF0A4;">&nbsp;</span>--> 
        </div>
        <div id='calendar'></div>
      </div>
      <!-- END PAGE CONTENT INNER --> 
    </div>
  </div>
  <!-- END PAGE CONTENT --> 
</div>
<!-- END PAGE CONTAINER --> 

<!--<script src="select2/select2.min.js"></script>--> 
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script>
 $(document).ready( function() { 
 $("#choose_doctors").select2();	
 $("#doctors").select2();	
 $("#doctors1").select2();
 $("#particular_date_doctors").select2();
 });
 </script>
<?php include_once("footer_for_appt.php"); ?>
<script>
	
	$( ".dtpicker" ).datepicker();
	load_doctors("2");
	load_branches();
	
	$('.dtpicker').on('changeDate', function(ev){
    $(this).datepicker('hide');
});

	
	function remove_me(obj){
	
		$(obj).closest('.row').remove();
		
	
	}
	
	
	
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js" integrity="sha512-RLw8xx+jXrPhT6aXAFiYMXhFtwZFJ0O3qJH1TwK6/F02RSdeasBTTYWJ+twHLCk9+TU8OCQOYToEeYyF/B1q2g==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
//$("#choose_doctors").prop("selectedIndex", 0);
$('#calendar').fullCalendar( 'refetchEvents' );	

jQuery(document).ready(function() {
	//$("select#choose_doctors").prop('selectedIndex', 0);	
	Metronic.init(); // init metronic core componets
   //Layout.init(); // init layout
   Demo.init(); // init demo features
   ComponentsPickers.init();
   $('#choose_doctors').val(2).trigger('change');
   //$('#choose_doctors')[3].selected = true;
   //$('#choose_doctors option')[3].selected = true; 
   
   // load_doctors("2");
  
    //$('#weekdays').select2();

//load_locations();


//$('#ajax_3').modal();

$("#doctors_only").click(function(){
				if($(this).prop("checked") == true){
					var empty=1;
					$("#doctors_only").val(empty);
				}
				else if($(this).prop("checked") == false){
					var empty=0;
					$("#doctors_only").val(empty);
				}
			});
$("#doctors_only1").click(function(){
				if($(this).prop("checked") == true){
					var empty=1;
					$("#doctors_only1").val(empty);
				}
				else if($(this).prop("checked") == false){
					var empty=0;
					$("#doctors_only1").val(empty);
				}
			});
$("#particular_date_doctors_only").click(function(){
				if($(this).prop("checked") == true){
					var empty=1;
					$("#particular_date_doctors_only").val(empty);
				}
				else if($(this).prop("checked") == false){
					var empty=0;
					$("#particular_date_doctors_only").val(empty);
				}
			});

$('#calendar').fullCalendar({
	
        header: {
				left: 'prev,next today',
				center: 'title',
				/*right: 'month,agendaWeek,agendaDay,listWeek'*/
				right: 'month'
			},
		dayRender: function (date, cell) {
      			cell.css("white-space", "normal");        
    	},
		 dayClick: function(date) {
		 	var d = new Date(date);
			$('#my_date').html(d.getDate() + '/' + (d.getMonth()+1) + '/' + d.getFullYear());
			$('#my_dateh').val(d.getFullYear() + '-' + (d.getMonth()+1) + "-" + d.getDate());
			var parti_date=d.getFullYear() + '-' + (d.getMonth()+1) + "-" + d.getDate();
			var dateAr = parti_date.split('-');
			if(dateAr[2]<10){
			 	var day_ar='0'+dateAr[2];
			}else{
				var day_ar=dateAr[2];
			}
			if(dateAr[1]<10){
			 	var month_ar='0'+dateAr[1];
			}else{
				var month_ar=dateAr[1];
			}
			var newDate = dateAr[0] + '-' + month_ar + '-' +day_ar ;
			$('#particular_date').val(newDate);
			//alert(newDate);
			$('#ajax_4').modal();
			//alert('a day has been clicked!'+d.getDate() + '/' + (d.getMonth()+1) + '/' + d.getFullYear());
		  },
		 eventAfterRender: function(event, element, view) {
                      $(element).css('width','auto');
                    },
		eventClick: function(info) {
			var wd = new Date(info.start);
			$('#my_date1').html(wd.getDate() + '/' + (wd.getMonth()+1) + '/' + wd.getFullYear());
			$('#my_dateh1').val(wd.getFullYear() + '-' + (wd.getMonth()+1) + "-" + wd.getDate());
			$('#myweekday').val(wd.getDay());
			$('#pk_id').val(info.id);
			$('#pk_id_for_delete').val(info.id);			
			$('#ajax_5').modal();
		
			/*if(confirm("Are you sure you want to delete it?")){
			
			$.ajax({
				url: "get_json_data_for_appt.php?flag=23",
				type: 'POST',
				dataType : "json",
				data: {
					"id": info.id
				},
				success : function(data) {
				//alert(data.flag);
				if(data.flag=="1"){
					alert('Data Successfully Deleted');
					$('#calendar').fullCalendar( 'refetchEvents' );
				}else alert('Unable to delete data');
				
				}
				
			
			
			});
			}*/
		},
		displayEventTime: false,
		eventRender: function(event, element) {                                          
			element.find('span.fc-title').html(element.find('span.fc-title').text());
			 var choose_doctors=$("#choose_doctors").val();	
			 				  
		},		
		height: 850,
		aspectRatio: 2,
		contentHeight: "auto",			
		events: {
		url: 'get_json_data_for_appt.php?flag=10',
		method: 'POST',
		data:function() {
      	return {
        choose_doctors: $("#choose_doctors").val()
			//date_val: $("#calendar").fullCalendar('getDate').toString()
			
      	};
		}
		}
		
    });
	
	 $('#choose_doctors').change( function(){
		 var choose_doctors=$("#choose_doctors").val();
		 //alert(choose_doctors);
		$('#calendar').fullCalendar( 'refetchEvents' );	 
    });
	//$('#choose_doctors option:eq(2)').prop('selected', true);
	//$('#choose_doctors option')[3].selected = true; 
	//$("#choose_doctors option:second").attr('selected','selected');
//$("#choose_doctors").prop("selectedIndex", 0);
$('#calendar').fullCalendar( 'refetchEvents' );	
	
	
	$('#calendar').on('dateClick', function(info) {
  console.log('clicked on ' + info.dateStr);
});
	
	

});

//summary();

 $('.branches').change( function(){
		//alert($(this).val());	
        var events = {
            url: "get_json_data_for_appt.php?flag=10",
            type: 'POST',
            data: {
                location_id: $(this).val()
            }
        }
		$('.branches').val($(this).val());
        $('#calendar').fullCalendar( 'removeEventSource', events);
        $('#calendar').fullCalendar( 'addEventSource', events);         
        $('#calendar').fullCalendar( 'refetchEvents' );
    });
	
$('#locations1').change( function(){
		//alert($(this).val());	
        var events = {
            url: "get_json_data_for_appt.php?flag=10",
            type: 'POST',
            data: {
                location_id: $(this).val()
            }
        }
		$('#locations').val($(this).val());
        $('#calendar').fullCalendar( 'removeEventSource', events);
        $('#calendar').fullCalendar( 'addEventSource', events);         
        $('#calendar').fullCalendar( 'refetchEvents' );
    });



function GetCalendarDateRange() {
        //var calendar = $('#calendar').fullcalendar('getView');
        //var view = calendar.visStart;
        var date = $("#calendar").fullCalendar('getDate');
  		var month_int = date.getMonth();
		alert(month_int);
		//var start = view.title;
		//var end = view.intervalEnd;
        //var dates = { start: start, end: end };
        //return dates;
    }
	
function summary(){
var gt=GetCalendarDateRange();
//alert(gt.start);
/*$.ajax({
            url: 'get_json_data_for_appt.php?flag=25',
			dataType: 'json',
			type: 'POST',
			data: GetCalendarDateRange(),
			success: function (data) {
			alert(data.value);
			//var obj=jQuery.parseJSON(data);
			////alert(obj.id);
			 $.each(data, function(index, element) {
			 	//alert(element.value);
			 	$('#summary').html("<td>"+element.pf+":</td><td>"+element.pf+"</td>");
				
			 });
			 }
			 });*/

}

function edit_data(){

	$.ajax({
            url: 'get_json_data_for_appt.php?flag=46',
			dataType: 'json',
			type: 'POST',
			data: 'id='+$('#pk_id').val(),
			success: function (data) {
				$("#input_starttime1").val(data.visiting_starttime);
				$("#etime1").val(data.visiting_endtime);
				$("#schedule_type1").val(data.schedule_type);			
				$("#branches1").val(data.branches_id);
				//$("#doctors1").val(data.doctor_id);
				$("#doctors1").select2("val",data.doctor_id);
				$("#patient_limit1").val(data.patient_limit);
				$("#destination_month1").val(data.destination_month);
				if(data.doctors_only==1){
					var empty=1;
					$("#doctors_only1").prop("checked", true);
					$("#doctors_only1").val(empty);					
				}
				if(data.doctors_only==0){
					var empty=0;
					$("#doctors_only1").prop("checked", false);
					$("#doctors_only1").val(empty);					
				}
				$('#ajax_5').modal('hide');
	 			$('#ajax_6').modal();
			}
		});


	 //$('#ajax_5').modal('hide');
	 //$('#ajax_6').modal();

}

function delete_model_open(){
	
	$('#ajax_5').modal('hide');
	$('#ajax_7').modal();
}

function save_data(){
	
	var dtval=$("#my_dateh").val();
	var doctors=$("#doctors").val();
	var branches=$("#branches").val();
	var patient_limit=$("#patient_limit").val();
	var destination_month=$("#destination_month1").val();
	var destination_year=$("#destination_year1").val();
	//var weekdays=$('#weekdays').select2('data');
	//var input_starttime=$("#input_starttime").val();
	//var etime=$("#etime").val();
	var schedule_type=$("#schedule_type").val();
	var weekdays=[];
	var input_starttime=[];
	var etime=[];
	var doctors_only=$("#doctors_only").val();
	if(doctors==''){
		alert("Please Select Doctor..");
		return false;		
	}
	
	$("select[name^='weekdays']").each(function () {
   		console.log($(this).val());
		if($(this).val()!="") weekdays.push(($(this).val())-1);
	});
	
	$("input[name^='input_starttime']").each(function () {
   		console.log($(this).val());
		if($(this).val()!="") input_starttime.push($(this).val());
	});
	
	$("input[name^='etime']").each(function () {
   		console.log($(this).val());
		if($(this).val()!="") etime.push($(this).val());
	});
	
	var mydata={"dtval":dtval,"doctor":doctors,"branches":branches,"input_starttime":input_starttime,"etime":etime,"schedule_type":schedule_type,"weekdays":weekdays,"patient_limit":patient_limit,"destination_month":destination_month,"destination_year":destination_year,"doctors_only":doctors_only};
	
	//alert(mydata.weekdays[0].text);
	
	$.ajax({
            url: 'get_json_data_for_appt.php?flag=11',
			dataType: 'json',
			type: 'POST',
			data: mydata,
			success: function (data) {
		
					if(data.flag==1){
					 alert("Successfully Saved");
					 reset_values();
					 $('#ajax_4').modal('hide');
					 $('#calendar').fullCalendar( 'refetchEvents' );
					}else alert('Unable to save');
					
			
			}
		});
	
	//alert(data.etime);
}

function update_data(){
	
	var id=$('#pk_id').val();
	var dtval=$("#my_dateh1").val();
	var doctors=$("#doctors1").val();
	var branches=$("#branches1").val();
	var patient_limit=$("#patient_limit1").val();
	var destination_month=$("#destination_month1").val();
	//var weekdays=$('#weekdays').select2('data');
	//var input_starttime=$("#input_starttime").val();
	//var etime=$("#etime").val();
	var schedule_type=$("#schedule_type1").val();
	var weekdays=$("#myweekday").val();
	var input_starttime=$("#input_starttime1").val();
	var etime=$("#etime1").val();
	var yearflag=$('input[name="updateflag"]:checked').val();
	var doctors_only=$("#doctors_only1").val();
	if(doctors==''){
		alert("Please Select Doctor..");
		return false;		
	}
	
	var mydata={"dtval":dtval,"doctor":doctors,"branches":branches,"input_starttime":input_starttime,"etime":etime,"schedule_type":schedule_type,"weekdays":weekdays,"yearflag":yearflag,"id":id,"patient_limit":patient_limit,"destination_month":destination_month,"doctors_only":doctors_only};
	
	//alert(mydata.weekdays[0].text);
	
	$.ajax({
            url: 'get_json_data_for_appt.php?flag=47',
			dataType: 'json',
			type: 'POST',
			data: mydata,
			success: function (data) {
		
					if(data.flag==1){
					 alert("Successfully Saved");
					 $('#calendar').fullCalendar( 'refetchEvents' );
					 $('#ajax_6').modal('hide');
					 reset_values();
					}else alert('Unable to save');
					
			
			}
		});
	
	//alert(data.etime);
}

function delete_data(){

	var id=$('#pk_id_for_delete').val();
	//$('#ajax_5').modal('hide');
	var yearflag=$('input[name="updateflag1"]:checked').val();
	
	if(confirm("Are you sure you want to delete it?")){
	$.ajax({
            url: 'get_json_data_for_appt.php?flag=23',
			dataType: 'json',
			type: 'POST',
			data: 'id='+id+'&yearflag='+yearflag,
			success: function (data) {
		
					if(data.flag==1){
					 alert("Successfully Deleted Data");
					 reset_values();
					 $('#ajax_6').modal('hide');
	 				 $('#ajax_7').modal('hide');
					 $('#ajax_5').modal('hide');
					 $('#calendar').fullCalendar( 'refetchEvents' );
					}else alert('Unable to Delete');
			}
		});
		
	}

}

function reset_values(){
		
	$("#my_dateh").val("");
	$("#doctors").val("");
	$("#branches").val("");
	$("#patient_limit").val("");
	$("#destination_month").val("");
	//var weekdays=$('#weekdays').select2('data');
	//var input_starttime=$("#input_starttime").val();
	//var etime=$("#etime").val();
	$("#schedule_type").val("");
	$("#doctors_only").val(0);
	$("select[name^='weekdays']").each(function () {
   		console.log($(this).val());
		$(this).val("");
	});
		
}
function open_modal1(){
	$('#ajax_9').modal('show');
	$('#ajax_4').modal('hide');
}

function save_data9(){
	
	var particular_date=$("#particular_date").val();
	var particular_date_starttime=$("#particular_date_starttime").val();
	var particular_date_etime=$("#particular_date_etime").val();
	//alert(particular_date_starttime);
	var particular_date_doctors=$("#particular_date_doctors").val();
	var particular_date_branches=$("#particular_date_branches").val();
	var particular_date_schedule_type=$("#particular_date_schedule_type").val();
	var particular_date_patient_limit=$("#particular_date_patient_limit").val();
	var particular_date_doctors_only=$("#particular_date_doctors_only").val();
	
	if(particular_date_doctors==''){
		alert("Please Select Doctor..");
		return false;		
	}
	
	
	var mydata={"particular_date":particular_date,"particular_date_starttime":particular_date_starttime,"particular_date_etime":particular_date_etime,"particular_date_doctors":particular_date_doctors,"particular_date_branches":particular_date_branches,"particular_date_schedule_type":particular_date_schedule_type,"particular_date_patient_limit":particular_date_patient_limit,"particular_date_doctors_only":particular_date_doctors_only};
	
	
	
	$.ajax({
            url: 'get_json_data_for_appt.php?flag=51',
			dataType: 'json',
			type: 'POST',
			data: mydata,
			success: function (data) {
		
					if(data.flag==1){
					 alert("Successfully Saved");
					 reset_values();
					 $('#ajax_9').modal('hide');
					 $('#calendar').fullCalendar( 'refetchEvents' );
					}else alert('Unable to save');
					
			
			}
		});
	
	//alert(data.etime);
}

</script>
</html>