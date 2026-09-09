<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_inventory.php"; ?>
<!-- END HEADER --> 
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
</style>
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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Inventory Management</span></div>
            </div>
            <!-- BEGIN FORM-->
            <input type="hidden" value="" id="id" name="id" />
            <div class="form-body">
              <div class="row" style="background:#dcefff; padding:9px 0px">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">HSN Code</label>
                    <select class="form-control" id="hsn_code" name="hsn_code" onChange="get_gst_rate_hsn()">
                      <option value="">Select</option>
                    </select>
                    <input type="hidden" id="hsm_code" name="hsm_code" class="form-control" placeholder="Name">
                    <span class="small"><a data-toggle="modal" data-target="#staticBackdrop9"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add HSN Code With GST</a></span> </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Item Name</label>
                    <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Name" onBlur="check_item()">
                    <span class="small" id="alert_item_name" style="color:red !important;font-weight:bold !important;"></span>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Type</label>
                    <select class="form-control" id="type_name" onChange="load_sub_types()">
                    </select>
                    <span class="small"><a data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Type</a></span> </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Sub Type</label>
                    <select class="form-control" id="sub_type_name">
                      <option value="">Level 1</option>
                      <option value="">Level 2</option>
                      <option value="">Other</option>
                    </select>
                    <span class="small"><a data-toggle="modal" data-target="#staticBackdrop3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sub-type</a></span> </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Generic Name</label>
                    <input type="text" id="generic_name" name="generic_name" class="form-control" placeholder="Generic Name">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="control-label">Unit</label>
                    <select class="form-control" id="unit">
                      <option value="">-Select-</option>
                    </select>
                    <!--<span class="small"><a data-toggle="modal" data-target="#staticBackdrop7"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Unit</a></span>--> </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Department</label>
                    <select class="form-control" id="dept_name" >
                      
                    </select>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Location</label>
                    <select class="form-control" id="location_name" >
                    </select>
                  </div>
                </div>
                
                <div style="clear:both"></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">GST Rate</label>
                    <input type="text" id="gst_rate" name="gst_rate" class="form-control" placeholder="GST Rate" onkeyup="gst_divide_new()">
                    % </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">CGST Rate</label>
                    <input type="text" id="cgst_rate" name="cgst_rate" class="form-control" placeholder="CGST Rate">
                    % </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">SGST Rate</label>
                    <input type="text" id="sgst_rate" name="sgst_rate" class="form-control" placeholder="SGST Rate">
                    % </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Reorder Level</label>
                    <input name="moq" id="moq" type="text" class="form-control" value="0" onClick="valid_reorder_moq();">
                    <input name="size" id="size" type="hidden" class="form-control">
                    <input name="color" id="color" type="hidden" class="form-control">
                    <input name="covid_item" id="covid_item" type="hidden" class="form-control"  value="0" >
                  </div>
                </div>
                <div style="clear:both"></div>
                
                <!--/span--> 
                <!--<div style="clear:both;">&nbsp;</div>-->
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Asset Specification</label>
                    <textarea name="specification" id="specification" class="form-control" cols="" rows="5"></textarea>
                  </div>
                </div>
                <!-- END PAGE CONTENT -->
                <div style="clear:both"></div>
                <div class="form-group" style="margin-top:10px">
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <button type="button" class="btn green" onClick="save_asset(); return false;" id="submit_form_button">Submit</button>
                        <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- END PAGE CONTENT --> 
              </div>
              <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>loader.gif" class="img-responsive" /> </div>
            </div>
          </div>
          <!-- END PAGE CONTENT INNER --> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-hover table-bordered" id="asset_entry_data">
            <caption>
            All Items
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Item ID </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>HSN Code </span></th>
                <th class="draggable" data-column="item_name" style="cursor: move;"><span>Item Name </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Generic Name </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Sub-Category </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Re-order Level</span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>GST </span></th>
                <th class="print_ignore"><span>Action</span></th>
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
    
    <!-- END PAGE CONTAINER --> 
    
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
    <div id="staticBackdrop9" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">HSN Code</label>
              <div class="col-md-9">
                <input type="text" id="hsn_code_" name="hsn_code_" class="form-control" placeholder="Enter value">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">GST Rate(%)</label>
              <div class="col-md-9">
                <div class="input-group">
                  <input type="text" id="gst_rate_" name="gst_rate_" class="form-control" placeholder="Enter value" onkeyup="gst_divide()">
                  <span class="input-group-addon"> % </span> </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">CGST Rate(%)</label>
              <div class="col-md-9">
                <div class="input-group">
                  <input type="text" id="cgst_rate_" name="cgst_rate_" class="form-control" placeholder="Enter value">
                  <span class="input-group-addon"> % </span> </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">SGST Rate(%)</label>
              <div class="col-md-9">
                <div class="input-group">
                  <input type="text" id="sgst_rate_" name="sgst_rate_" class="form-control" placeholder="Enter value">
                  <span class="input-group-addon"> % </span> </div>
              </div>
            </div>
            <div style="clear:both"></div>
            <div class="form-group" style="margin-top:10px">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="button" class="btn green" onClick="save_hsn_gst(); return false;">Submit</button>
                    <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>
//let tab_asset_entry="";
//load_assets();
load_types();
load_sub_types();
load_unit();
load_hsn_gst();
load_departments();
load_location();

function save_asset(){
	if($("#item_name").val()==''){
		alert('Please Fill up Item');
		return false;
	}
	if($("#moq").val()==''){
		alert('Please Fill up Reorder Level');
		valid_reorder_moq();
	}
	if($("#dept_name").val()==''){
		alert('Please choose department');
		return false;
	}
	if($("#location_name").val()==''){
		alert('Please choose location');
		return false;
	}
	
	var data_details={
		"id": $("#id").val(),
		"hsm_code": $("#hsm_code").val(),
		"type_name": $("#type_name").val(),
		"sub_type_name": $("#sub_type_name").val(),
		"item_name": $("#item_name").val(),
		"generic_name": $("#generic_name").val(),
		"moq": $("#moq").val(),
		"size": $("#size").val(),
		"color": $("#color").val(),
		"covid_item": $("#covid_item").val(),
		"unit": $("#unit").val(),
		"gst_rate": $("#gst_rate").val(),
		"cgst_rate": $("#cgst_rate").val(),
		"sgst_rate": $("#sgst_rate").val(),
		"specification": $("#specification").val(),
		"dept_name": $("#dept_name").val(),
		"location_name": $("#location_name").val()
	}
	
	var edit_flag=0;
		$.ajax({
				beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
				url: 'get_json_data_inventory.php?flag=2',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						//console.log(element.text);
						if(data.flag=="1"){
							if($("#id").val()!="") toastr.success('Item Updated Successfully');
						 	else toastr.success('Item Created Successfully');
						
						}else toastr.error('Unable to create Item');
						//$("#asset_name").val('');	
						reset_val();					
						//load_assets();
						tab_val_menu.draw();
				},
				complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			});

}
//Change Sandip
function valid_reorder_moq(){
	//alert('sas');
	var defult=0;
	$("#moq").val("");
}

/*function load_assets(){

	$('#asset_name').empty();
	if(tab_asset_entry!="") tab_asset_entry.destroy();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=1',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			 $('#assets_body').html('');
			 $.each(data, function(index, element) {
			 	$('#assets_body').html($('#assets_body').html()+'<tr><td>'+element.id+'</td><td>'+element.hsm_code+'</td><td>'+element.text+'</td><td>'+element.generic_name+'</td><td>'+element.category_name+'</td><td>'+element.sub_cat+'</td><td>'+element.size+'</td><td>'+element.color+'</td><td><a class="edit" href="javascript:;" onclick="edit('+element.id+',\''+element.text+'\')" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="delete" href="javascript:;" onclick="del('+element.id+')" ><i class="fa fa-trash"></i></a></td>');
		 	});
			
				tab_asset_entry=$("#asset_entry_data").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				
				
			
			 },
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });

}*/


var tab_val_menu=$('#asset_entry_data').DataTable( {

	"bProcessing": true,

	"bServerSide": true,

	"iDisplayLength": 300,

	"sAjaxSource": "get_json_data_inventory.php?flag=85",

	 "order": [[0,"asc"]],
	
	 "fnServerParams": function ( aoData ) {

	/*aoData.push( { "name": "date_filter", "value": $( "#datepicker_select" ).val() },{"name" : "branches_list", "value" : $("#branches_list").val()} ,{"name" : "doctors_list", "value" : $("#doctors_list").val()},{"name" : "procedure_list", "value" : $("#procedure_list").val()},{"name" : "patient_name_search", "value" : $("#patient_name_search").val()});*/

	},

	dom: 'Bfrtip',
   
	

	"initComplete": function(settings, json) {

	//$('#product_list_filter').hide();	

},

	"keys": true

} );




function del(id){
if(confirm("Are you sure you want to delete the data?")){
	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
            url: 'get_json_data_inventory.php?flag=20',
			type: 'POST',
			data: "id="+id+"&table=item_master",
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				//load_assets();
				tab_val_menu.draw();
				
			},
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
		});
	}
}
function edit_sub_type_after_function(data_sub_cat){
	//alert(ani);
				$("#sub_type_name").val(data_sub_cat);
}


function edit(id){

	
	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
            url: 'get_json_data_inventory.php?flag=39',
			type: 'POST',
			dataType: 'json',
			data: "id="+id,
			success: function (data) {
				console.log("Text:"+data.generic_name);
				$("#id").val(data.id);
				$("#hsm_code").val(data.hsm_code);
				$("#type_name").val(data.category_name);
				load_sub_types(data.sub_cat);	
				load_departments(data.dept_id);
				load_location(data.location_id);
				//$("#dept_name").val(data.dept_id);		
				$("#sub_type_name").val(data.sub_cat);
				$("#item_name").val(data.text);
				$("#generic_name").val(data.generic_name);
				$("#moq").val(data.moq);
				$("#size").val(data.size);
				$("#color").val(data.color);
				$("#covid_item").val(data.covid_item);
				$("#unit").val(data.unit_name);
				$("#gst_rate").val(data.gst_rate);
				$("#cgst_rate").val(data.cgst_rate);
				$("#sgst_rate").val(data.sgst_rate);
				$("#specification").val(data.specification);
				
				$("#hsn_code option:selected").text(data.hsm_code);
				$("#hsm_code").focus();
				var data_sub_cat=data.sub_cat;
				//alert(data_sub_cat);
						
				
			},
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			
		});
		edit_sub_type_after_function(data_sub_cat);	

}

function save_type(){

	var data_details={
		"type_name": $("#type_name_").val()
	}
	var edit_flag=0;
		$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
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
				},
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
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
				beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
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
									},
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			});

}

function load_types(){
	
	$('#type_name').empty();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
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
			
			 },
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });
	
	
}

function load_sub_types(id){
	
	$('#sub_type_name').empty();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
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
			
			 },
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });
}

function load_unit(){
	
	$('#unit').empty();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
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
			$("#unit").val('1');
			 },
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });
}

function save_unit(){

	var data_details={
		"unit_name": $("#unit_name_").val()
	}
	
	var edit_flag=0;
		$.ajax({
				beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
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
						},
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			});

}


function reset_val(){

	$("#id").val("");
	$("#hsm_code").val("");
	$("#type_name").val("");
	$("#sub_type_name").val("");
	$("#item_name").val("");
	$("#generic_name").val("");
	$("#moq").val("");
	$("#size").val("");
	$("#color").val("");
	$("#covid_item").val("");
	$("#unit").val("1");
	$("#gst_rate").val("");
	$("#cgst_rate").val("");
	$("#sgst_rate").val("");
	$("#specification").val("");
	$("#hsn_code").val("");

}

function save_hsn_gst(){
				
	var data_details={
		"hsn_code": $("#hsn_code_").val(),
		"gst_rate": $("#gst_rate_").val(),
		"cgst_rate": $("#cgst_rate_").val(),
		"sgst_rate": $("#sgst_rate_").val(),
		"id": ''
	}
	var edit_flag=0;
		$.ajax({
				beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
				url: 'get_json_data_inventory.php?flag=60',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						//console.log(element.text);
						if(data.flag=="1") toastr.success('HSN Code with GST Created Successfully');
						else toastr.error('Unable to create HSN Code with GST');
						$("#hsn_code_").val('');
						$("#gst_rate_").val('');
						$("#cgst_rate_").val('');
						$("#sgst_rate_").val('');
						load_hsn_gst();
						$('#staticBackdrop9').modal('hide');
				},
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			});

}
function load_hsn_gst(){
	
	$('#hsn_code').empty();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
            url: 'get_json_data_inventory.php?flag=59',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#hsn_code').append($('<option/>', { 

					value: element.id,
					text : element.hsn_code 

				}));
		 	});
			
			 },
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });
}

function gst_divide(){
	var gst_rate=$("#gst_rate_").val();
	if(gst_rate!=''){
		var divide=parseFloat(gst_rate)/2;
		$("#cgst_rate_").val(divide);
		$("#sgst_rate_").val(divide);
	}else{
		$("#cgst_rate_").val('');
		$("#sgst_rate_").val('');
	}

}
function get_gst_rate_hsn(){
		var hsm_code=$("#hsn_code option:selected").text();
		$("#hsm_code").val(hsm_code);
		
		$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
            url: 'get_json_data_inventory.php?flag=61',
			dataType: 'json',
			data: 'hsn_id='+$('#hsn_code').val(),
			type: 'POST',
			success: function (data) {
			 	$("#hsn_code").val(data.id);
				$("#gst_rate").val(data.gst_rate);
				$("#cgst_rate").val(data.cgst_rate);
				$("#sgst_rate").val(data.sgst_rate);	
				
			 },
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });

		
}
function gst_divide_new(){
	var gst_rate=$("#gst_rate").val();
	if(gst_rate!=''){
		var divide=parseFloat(gst_rate)/2;
		$("#cgst_rate").val(divide);
		$("#sgst_rate").val(divide);
	}else{
		$("#cgst_rate").val('');
		$("#sgst_rate").val('');
	}

}

function check_item(){
	var item_name=$("#item_name").val();
	$("#alert_item_name").html('');	
	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
            url: 'get_json_data_inventory.php?flag=65',
			dataType: 'json',
			type: 'POST',
			data: "item_name="+item_name,
			success: function (data) {			
				//console.log(data.flag);
				if((data.flag)=='1'){
					alert("Item name already exist!!!");
					$("#item_name").css( "border-width", "2px" );
					$("#item_name").css( "border-color", "red" );
					$("#alert_item_name").html('Item name already exist!!!');
				}
				
			},
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
		});

}


function load_location(id){
	
	$('#location_name').empty();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
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
			if(id!="")	$("#location_name").val(id);
			 },
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });
}

function load_departments(id){
	
	$('#dept_name').empty();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
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
			if(id!="")	$("#dept_name").val(id);
			 },
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });
}

</script>
</body>
<!-- END BODY -->
</html>