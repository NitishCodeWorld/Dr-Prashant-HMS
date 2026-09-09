<?php 
include 'conn.php';
?>
<?php include_once("header_for_appt.php"); ?>
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
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-red-pink"></i> <span class="caption-subject font-red-pink bold uppercase">add / edit procedure </span><span style="font-size:10pt !important;">(Create / edit procedure)</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body"> 
              <!-- BEGIN FORM-->
              <div class="form-body">
                <div class="row" style="padding:9px 0px">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Doctor *</label>
                      <select class="form-control select2" id="doctors">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Procedure Name</label>
                      <input type="text" id="procname" class="form-control" placeholder="" style=" font-weight:bold;">
                      <input type="hidden" id="proc_type" class="form-control" placeholder="" style=" font-weight:bold;" value="opd">
                      <input type="hidden" id="proc_insert_id" class="form-control" placeholder="" style=" font-weight:bold;" >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Duration in mins</label>
                      <input type="number" id="duration" class="form-control">
                    </div>
                  </div>
                </div>
                
                <p style="padding:11px 0 11px 0; text-align:center"><a href="javascript:" class="btn btn-sm blue" onClick="save_proc()"  title="Submit">Submit</a>&nbsp;<a href="<?php echo ADMIN_URL; ?>addprocedure_for_appt.php" class="btn btn-sm red" title="Cancel">Cancel</a></p>
              </div>
              <!-- END FORM--> 
            </div>
            <!---------------------------------------------------------------------> 
          </div>
          
          <!-- END EXAMPLE TABLE PORTLET--> 
        </div>
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Procedure List</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-6"> </div>
                  <div class="col-md-6">
                    <div class="btn-group pull-right"> 
                      <!-- <button class="btn btn-sm grey-cascade dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i> </button>
                      <ul class="dropdown-menu pull-right">
                        <li> <a href="#" onClick="window.print();return false;"> Print </a> </li>
                        <li> <a href="javascript:;"> Save as PDF </a> </li>
                        <li> <a href="javascript:;"> Export to Excel </a> </li>
                      </ul>--> 
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <!--<p style="text-align:right">By Copmpany, Vacancy Number</p>-->
                <thead>
                  <tr>
                    <th>OPD Procedure Name</th>
                    <th>Duration in mins</th>
                    <th>Doctor Name</th>
                    <th>Details</th>
                    <th> Action </th>
                  </tr>
                </thead>
              </table>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              
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
<?php include_once("footer_for_appt.php"); ?>
<script>
load_doctors("2");
	
var tab_val_menu1=$('#sample_editable_1').DataTable( {
	"bProcessing": true,
	"bServerSide": true,
	"iDisplayLength": 25,
	"sAjaxSource": "get_json_data_for_appt.php?flag=40",
	 "order": [[0,"asc"]],
	dom: 'Bfrtip',
	"initComplete": function(settings, json) {
	//$('#product_list_filter').hide();	
},
	"keys": true
} );




function reset_val(){	
		//$("#doctors").val('');
		$("#doctors").select2("val",'');
		$("#procname").val('');
		$("#proc_type").val('opd');
		$("#duration").val('');
		$("#proc_insert_id").val('');
	
}

	
function save_proc(){	
		if($("#doctors").val()==''){
			alert("Please Choose Doctor!!");
			return false;	
		}
		if($("#procname").val()==''){
			alert("Please Enter Procedure Name!!");
			return false;	
		}
		if($("#duration").val()==''){
			alert("Please Enter Duration!!");
			return false;	
		}
		var form_data={
					"doctors":$("#doctors").val(),
					"procname":$("#procname").val(),
					"proc_type":$("#proc_type").val(),
					"duration":$("#duration").val(),
					"proc_insert_id":$("#proc_insert_id").val(),
					"flag":"9"					
			};
			
	$.ajax({
				url: 'get_json_data_for_appt.php',
				dataType: 'json',
				type: 'POST',
				data: form_data,
				success: function (data) {
					if(data.flag=="1"){
					 alert("Successfully saved");
					 tab_val_menu1.ajax.reload(null,false);
					 reset_val()
					}		
				 }
				 });
}
function edit_this(edit_id){
	
		var form_data={
					"edit_id":edit_id,
					"flag":"58"					
			};
			
	$.ajax({
				url: 'get_json_data_for_appt.php',
				dataType: 'json',
				type: 'POST',
				data: form_data,
				success: function (data) {
					//$("#doctors").val(data.dr_user_id);
					$("#doctors").select2("val",data.dr_user_id);
					$("#procname").val(data.procedure_name);
					$("#proc_type").val('opd');
					$("#duration").val(data.time);
					$("#proc_insert_id").val(data.proc_insert_id);
						
				 }
				 });
	
	}
	
$(document).ready( function() { 
 $("#doctors").select2();	
});
	
</script>