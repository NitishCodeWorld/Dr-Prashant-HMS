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
              <div class="caption"> <i class="fa fa-cogs font-red-pink"></i> <span class="caption-subject font-red-pink bold uppercase">add / Edit Branch</span><span style="font-size:10pt !important;"> (Create / Edit  Branch)</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body"> 
              <!-- BEGIN FORM-->
              <div class="form-body">
                <div class="row" style="padding:9px 0px">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Branch Name</label>
                      <input type="text" id="branchname" class="form-control" placeholder="" style="font-weight:bold;">
                      <input type="hidden" id="branches_id" class="form-control" placeholder="" style="font-weight:bold;">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Address</label>
                      <textarea name="address" id="address" class="form-control"></textarea>
                    </div>
                  </div>
                  <!--/span--> 
                </div>
                <p style="padding:11px 0 11px 0; text-align:center"><a href="javascript:" class="btn btn-sm blue" onClick="save_branch()"  title="Submit">Submit</a>&nbsp;<a href="<?php echo ADMIN_URL; ?>addbranch_for_appt.php" class="btn btn-sm red" title="Cancel">Cancel / Reload</a></p>
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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Branch List</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-6"> </div>
                  <div class="col-md-6">
                    <div class="btn-group pull-right"> 
                      <!--<button class="btn btn-sm grey-cascade dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i> </button>
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
                    <th>Branch Name</th>
                    <th>Address</th>
                    <th>Details</th>
                    <th> Action </th>
                  </tr>
                </thead>
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
<!-- END PAGE CONTAINER -->
<?php include_once("footer_for_appt.php"); ?>
<script>
//load_branches_chember();

var tab_val_menu1=$('#sample_editable_1').DataTable( {
	"bProcessing": true,
	"bServerSide": true,
	"iDisplayLength": 25,
	"sAjaxSource": "get_json_data_for_appt.php?flag=38",
	 "order": [[0,"asc"]],
	dom: 'Bfrtip',
	"initComplete": function(settings, json) {
	//$('#product_list_filter').hide();	
},
	"keys": true
} );

	function save_branch(){
	
		var form_data={
					"branchname":$("#branchname").val(),
					"address":$("#address").val(),
					"branches_id":$("#branches_id").val(),
					"flag":"8"					
			};
			
	$.ajax({
				url: 'get_json_data_for_appt.php',
				dataType: 'json',
				type: 'POST',
				data: form_data,
				success: function (data) {
				//alert(data.flag);
					//alert(element.flag);
					if(data.flag=="1"){
					//if(send_email()){
					 //$("#static2").modal('hide');
					 alert("Successfully saved");
					 tab_val_menu1.ajax.reload(null,false);
					 reset_val();
					 //window.location=window.location;
					 //}
					}
				//var obj=jQuery.parseJSON(data);
				////alert(obj.id);			
				 }
				 });
	
	}

function reset_val(){	
		$("#branchname").val('');
		$("#address").val('');
		$("#branches_id").val('');
	
}
function edit_this(edit_id){
	
		var form_data={
					"edit_id":edit_id,
					"flag":"57"					
			};
			
	$.ajax({
				url: 'get_json_data_for_appt.php',
				dataType: 'json',
				type: 'POST',
				data: form_data,
				success: function (data) {
					$("#branchname").val(data.branch_name);
					$("#address").val(data.address);
					$("#branches_id").val(data.branches_id);
						
				 }
				 });
	
	}

</script>