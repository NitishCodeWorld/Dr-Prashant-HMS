<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_inventory.php"; ?>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->

<div class="page-container"> 
  <!-- BEGIN PAGE HEAD --> 
  
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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Opening Stock Entry</span></div>
            </div>
            <!-- BEGIN FORM-->
            <input type="hidden" value="" id="id" name="id" />
            <div class="form-body">
              <div class="row" style="background:#dcefff; padding:9px 0px">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Type</label>
                    <select class="form-control" id="type_name" onChange="load_sub_types();load_assets();">
                    </select>
                    <span class="small"><a data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Type</a></span> </div>
                </div>
                <!--/span-->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Sub Type</label>
                    <select class="form-control" id="sub_type_name" onChange="load_assets();">
                      <option value="">Level 1</option>
                      <option value="">Level 2</option>
                      <option value="">Other</option>
                    </select>
                    <span class="small"><a data-toggle="modal" data-target="#staticBackdrop3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sub-type</a></span> </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Department</label>
                    <select class="form-control" id="dept_name">
                      <option value="">IPD</option>
                      <option value="">Daily Cleaning</option>
                      <option value="">Other</option>
                    </select>
                    <span class="small"><a data-toggle="modal" data-target="#staticBackdrop4"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Department</a></span> </div>
                </div>
                <div class="col-md-12" style="height:0px !important">&nbsp;</div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Item</label>
                    <select class="form-control" id="item_id">
                      <option value="">Select</option>
                    </select>
                    <!--<span class="small"><a data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Asset</a></span>--> 
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Location</label>
                    <select class="form-control" id="location_name">
                    <option value="">Select</option>
                    </select>
                    <span class="small"><a data-toggle="modal" data-target="#staticBackdrop5"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Location</a></span> </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Vendor</label>
                    <select class="form-control" id="vendor_name">
                    <option value="">Select</option>
                    </select>
                    <span class="small"><a data-toggle="modal" data-target="#staticBackdrop6"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Vendor</a></span> </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Qty</label>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><input name="qty" id="qty" type="text" class="form-control" placeholder="Units"></td>
                        <td><select class="form-control" id="unit">
                            <option value="">-Select-</option>
                          </select></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><span class="small"><a data-toggle="modal" data-target="#staticBackdrop7"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Unit</a></span></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Batch</label>
                    <input name="batch" id="batch" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">Manufacturing Date</label>
                    <input name="mfg_date" id="mfg_date" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">Expiry Date</label>
                    <input name="expiry" id="expiry" type="text" class="form-control">
                  </div>
                </div>
                <div style="clear:both"></div>
                <!-- END PAGE CONTENT --> 
              </div>
            </div>
          </div>
          <!-- END PAGE CONTENT INNER --> 
        </div>
      </div>
      <div class="row">
        <p style="padding:6px 0 2px 0; text-align:center;backgroung:#fff"><a href="#" class="btn btn-sm blue" title="Save Template" onClick="save_data()">Submit</a></p>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">
            <caption>
            All Items
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Item Name </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category Name </span></th>
                <th class="draggable" data-column="sub_cat"><span>Sub Cat </span></th>
                <th class="draggable" data-column="department_name" style="cursor: move;"><span>Department Name </span></th>
                <th class="draggable" data-column="location_name" style="cursor: move;"><span>Location Name </span></th>
                <th class="draggable" data-column="vendor_name" style="cursor: move;"><span>Vendor Name </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Size </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Colour </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span> </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>COVID ITEM</span></th>
                <td class="print_ignore"><span>Action</span></td>
              </tr>
            </thead>
            <tbody id="assets_body">
            </tbody>
          </table>
        </div>
        
        <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
      </div>
      <!-- END PAGE CONTENT --> 
    </div>
    
    <!-- BEGIN ASSET MASTER -->
    <div id="staticBackdrop" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Item</label>
              <div class="col-md-9">
                <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Item Name">
              </div>
            </div>
            <div style="clear:both"></div>
            <div class="form-group" style="margin-top:10px">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="button" class="btn green" onClick="save_asset(); return false;">Submit</button>
                    <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END ASSET MASTER --> 
    
    <!-- BEGIN TYPE MASTER -->
    <div id="staticBackdrop1" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Type Name</label>
              <div class="col-md-9">
                <input type="text" id="type_name_" name="type_name_" class="form-control" placeholder="Name">
              </div>
            </div>
            <div style="clear:both"></div>
            <div class="form-group" style="margin-top:10px">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="button" class="btn green" onClick="save_type(); return false;">Submit</button>
                    <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END TYPE MASTER --> 
    
    <!-- BEGIN SUB-TYPE MASTER -->
    <div id="staticBackdrop3" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Sub Type Name</label>
              <div class="col-md-9">
                <input type="text" id="sub_type_name_" name="sub_type_name_" class="form-control" placeholder="Name">
              </div>
            </div>
            <div style="clear:both"></div>
            <div class="form-group" style="margin-top:10px">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="button" class="btn green" onClick="save_sub_type(); return false;">Submit</button>
                    <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END SUB-TYPE MASTER --> 
    
    <!-- BEGIN DEPARTMENT MASTER -->
    <div id="staticBackdrop4" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Department Name</label>
              <div class="col-md-9">
                <input type="text" id="dept_name_" name="dept_name_" class="form-control" placeholder="Name">
              </div>
            </div>
            <div style="clear:both"></div>
            <div class="form-group" style="margin-top:10px">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="button" class="btn green" onClick="save_department(); return false;">Submit</button>
                    <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END DEPARTMENT MASTER --> 
    
    <!-- BEGIN LOCATION MASTER -->
    <div id="staticBackdrop5" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Location Name</label>
              <div class="col-md-9">
                <input type="text" id="location_name_" name="location_name_" class="form-control" placeholder="Name">
              </div>
            </div>
            <div style="clear:both"></div>
            <div class="form-group" style="margin-top:10px">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="button" class="btn green" onClick="save_location(); return false;">Submit</button>
                    <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END LOCATION MASTER --> 
    
    <!-- BEGIN VENDOR MASTER -->
    <div id="staticBackdrop6" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Vendor Name</label>
              <div class="col-md-9">
                <input type="text" id="vendor_name_" name="vendor_name_" class="form-control" placeholder="Name">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Vendor Address</label>
              <div class="col-md-9">
                <input type="text" id="vendor_address_" name="vendor_address_" class="form-control" placeholder="Address">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Vendor Phone</label>
              <div class="col-md-9">
                <input type="text" id="vendor_phone_" name="vendor_phone_" class="form-control" placeholder="Phone">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Vendor Email</label>
              <div class="col-md-9">
                <input type="text" id="vendor_email_" name="vendor_email_" class="form-control" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Vendor GST No.</label>
              <div class="col-md-9">
                <input type="text" id="vendor_gst_" name="vendor_gst_" class="form-control" placeholder="GST">
              </div>
            </div>
            <div style="clear:both"></div>
            <div class="form-group" style="margin-top:10px">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="button" class="btn green" onClick="save_vendor(); return false;">Submit</button>
                    <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END VENDOR MASTER --> 
    
    <!-- BEGIN UNIT MASTER -->
    <div id="staticBackdrop7" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Unit Name</label>
              <div class="col-md-9">
                <input type="text" id="unit_name_" name="unit_name_" class="form-control" placeholder="Name">
              </div>
            </div>
            <div style="clear:both"></div>
            <div class="form-group" style="margin-top:10px">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="button" class="btn green" onClick="save_unit(); return false;">Submit</button>
                    <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END UNIT MASTER --> 
    
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

let tab_asset_entry="";

load_asset_entry_data();
load_assets();
load_types();
load_sub_types();
load_departments();
load_location();
load_vendor();
load_unit();

$("#expiry").datepicker({
	   format: 'dd-mm-yyyy'
   });

$("#mfg_date").datepicker({
	   format: 'dd-mm-yyyy'
   });

function save_asset(){

	var data_details={
		"asset_name": $("#asset_name_").val()
	}
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_inventory.php?flag=2',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						//console.log(element.text);
						if(data.flag=="1") toastr.success('Asset Created Successfully');
						else toastr.error('Unable to create asset');
						//$("#asset_name").val('');						
						load_assets();
						$('#staticBackdrop').modal('hide');
				}
			});

}

function save_type(){

	var data_details={
		"type_name": $("#type_name_").val()
	}
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_inventory.php?flag=4',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						if(data.flag=="1") toastr.success('Type Created Successfully');
						else toastr.error('Unable to create type');
						$("#type_name_").val('');
						load_types();
						$('#staticBackdrop1').modal('hide');
				}
			});

}

function save_sub_type(){

	if($("#type_name").val()==''){
	 alert("Please select a type");
	 $('#staticBackdrop3').modal('hide');
	 $("#type_name").focus();
	 return false;
	}
	
	var data_details={
		"type_id": $("#type_name").val(),
		"sub_type_name": $("#sub_type_name_").val()
	}
	
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_inventory.php?flag=6',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						if(data.flag=="1") toastr.success('Sub-type Created Successfully');
						else toastr.error('Unable to create sub-type');
						$("#sub_type_name_").val('');
						load_sub_types();
						$('#staticBackdrop3').modal('hide');
									}
			});

}

function save_department(){

	var data_details={
		"dept_name": $("#dept_name_").val()
	}
	
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_inventory.php?flag=8',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						if(data.flag=="1") toastr.success('Department Created Successfully');
						else toastr.error('Unable to create department');
						$("#dept_name_").val('');
						load_departments();
						$('#staticBackdrop4').modal('hide');
						}
			});

}

function save_location(){

	var data_details={
		"location_name": $("#location_name_").val()
	}
	
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_inventory.php?flag=10',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						if(data.flag=="1") toastr.success('Location Created Successfully');
						else toastr.error('Unable to create location');
						$("#location_name_").val('');
						load_location();
						$('#staticBackdrop5').modal('hide');
						}
			});

}


function save_vendor(){

	var data_details={
		"vendor_name": $("#vendor_name_").val(),
		"vendor_address": $("#vendor_address_").val(),
		"vendor_phone": $("#vendor_phone_").val(),
		"vendor_email": $("#vendor_email_").val(),
		"vendor_gst": $("#vendor_gst_").val(),
	}
	
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_inventory.php?flag=12',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						if(data.flag=="1") toastr.success('Vendor Created Successfully');
						else toastr.error('Unable to create vendor');
						$("#vendor_name_").val('');
						$("#vendor_address_").val('');
						$("#vendor_phone_").val('');
						$("#vendor_email_").val('');
						$("#vendor_gst_").val('');
						load_vendor();
						$('#staticBackdrop6').modal('hide');
						}
			});

}


function save_unit(){

	var data_details={
		"unit_name": $("#unit_name_").val()
	}
	
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_inventory.php?flag=14',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						if(data.flag=="1") toastr.success('Unit Created Successfully');
						else toastr.error('Unable to create unit');
						$("#unit_name_").val('');
						load_unit();
						$('#staticBackdrop7').modal('hide');
						}
			});

}

function save_data(){

	var data_details={
		"id": $("#id").val(),
		"type_name": $("#type_name").val(),
		"sub_type_name": $("#sub_type_name").val(),
		"dept_name": $("#dept_name").val(),
		"location_name": $("#location_name").val(),
		"vendor_name": $("#vendor_name").val(),
		"batch": $("#batch").val(),
		"mfg_date": $("#mfg_date").val(),
		"expiry": $("#expiry").val(),
		"item_id": $("#item_id").val(),
		"qty": $("#qty").val(),
		"specification": $("#specification").val()
	}
	
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_inventory.php?flag=15',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						if(data.flag=="1") toastr.success('Opening Stock Added Successfully');
						else toastr.error('Unable to add Opening Stock');
						$("#id").val('');
						$("#type_name").val('');
						$("#sub_type_name").val('');
						$("#dept_name").val('');
						$("#location_name").val('');
						$("#vendor_name").val('');
						$("#asset_name").val('');
						$("#qty").val('');
						$("#unit").val('');
						$("#color").val('');
						$("#batch").val('');
						$("#covid_item").val('');
						$("#specification").val('');
						//load_vendor();
						load_asset_entry_data();
						$('#staticBackdrop6').modal('hide');
						}
			});

}


function load_assets(id=""){

	$('#asset_name').empty();
	
	var data_details={
		"type_id": $("#type_name").val(),
		"sub_type_id": $("#sub_type_name").val()
		}

	$.ajax({

            url: 'get_json_data_inventory.php?flag=1',
			dataType: 'json',
			data: data_details,
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#item_id').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
				$('#unit').append($('<option/>', { 

					value: element.unit_id,
					text : element.unit_text 

				}));
				
		 	});
			
				$("#item_id").val(id);
			
			 }
			
		  });

}

function load_types(){
	
	$('#type_name').empty();

	$.ajax({

            url: 'get_json_data_inventory.php?flag=3',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#type_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 }

		  });
	
	
}

function load_sub_types(id){
	
	$('#sub_type_name').empty();

	$.ajax({

            url: 'get_json_data_inventory.php?flag=5',
			dataType: 'json',
			data: 'type_id='+$('#type_name').val(),
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#sub_type_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
				if(id!="")	$("#sub_type_name").val(id);
			
			 }

		  });
}

function load_departments(){
	
	$('#dept_name').empty();

	$.ajax({

            url: 'get_json_data_inventory.php?flag=7',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#dept_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 }

		  });
}


function load_location(){
	
	$('#location_name').empty();

	$.ajax({

            url: 'get_json_data_inventory.php?flag=9',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#location_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 }

		  });
}


function load_vendor(){
	
	$('#vendor_name').empty();

	$.ajax({

            url: 'get_json_data_inventory.php?flag=11',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#vendor_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 }

		  });
}


function load_unit(){
	
	$('#unit').empty();

	$.ajax({

            url: 'get_json_data_inventory.php?flag=13',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#unit').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 }

		  });
}


function load_asset_entry_data(){
if(tab_asset_entry!="") tab_asset_entry.destroy();
$.ajax({
            url: 'get_json_data_inventory.php?flag=16',
			type: 'POST',
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				$("#assets_body").html(data);
				tab_asset_entry=$("#asset_entry_data").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				
				$("#staticBackdrop").modal('hide');
				
			}
		});

}

function del(id){
if(confirm("Are you sure you want to delete the data?")){
	$.ajax({
            url: 'get_json_data_inventory.php?flag=17',
			type: 'POST',
			data: "id="+id,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				load_asset_entry_data();
				
			}
		});
	}
}


function edit(id){

$.ajax({
            url: 'get_json_data_inventory.php?flag=19',
			dataType: 'json',
			type: 'POST',
			data: "id="+id,
			success: function (data) {
				console.log(data.type_id);
				$("#id").val(id);
				$("#type_name").val(data.type_id);
				$("#sub_type_name").val(data.sub_type_id);
				$("#sub_type_name").change();
				//$("#item_id").val(data.item_id);
				$("#dept_name").val(data.dept_id);
				$("#location_name").val(data.location_id);
				$("#vendor_name").val(data.vendor_id);
				$("#asset_name").val(data.asset_name);
				$("#qty").val(data.qty);
				$("#unit").val(data.unit_id);
				$("#size").val(data.size);
				$("#color").val(data.color);
				$("#batch").val(data.batch);
				$("#covid_item").val(data.covid_item);
				$("#specification").val(data.specification);
				$("#mfg_date").val(data.mfg_date),
				$("#expiry").val(data.expiry),
				load_sub_types(data.sub_type_id);
				$("#type_name").focus()
				load_assets(data.item_id);
				
			}
		});

}


</script>
</body><!-- END BODY -->
</html>