<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_for_optical.php"; ?>
<div class="page-container"> 
  <!-- BEGIN PAGE HEAD --> 
  
  <!-- END PAGE HEAD --> 
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE BREADCRUMB -->
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"> <?php echo str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-16));?> </li>
      </ul>
      <!-- END PAGE BREADCRUMB --> 
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-16)));?></span></div>
            </div>
            <!-- BEGIN FORM-->
            <form name="save_from" id="save_form" method="post" enctype="multipart/form-data">
              <input type="hidden" value="" id="id" name="id" />
              <div class="form-body">
                <div class="row" style="background:#dcefff; padding:9px 0px">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">HSN Code</label>
                      <input type="text" id="hsm_code" name="hsm_code" class="form-control" placeholder="HSN Code">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Item Name</label>
                      <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Name">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Type</label>
                      <select class="form-control" id="type_name" name="type_name" onChange="load_sub_types()">
                      </select>
                      <span class="small"><a data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Type</a></span> </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Sub Type</label>
                      <select class="form-control" id="sub_type_name" name="sub_type_name">
                        <option value="">Level 1</option>
                        <option value="">Level 2</option>
                        <option value="">Other</option>
                      </select>
                      <span class="small"><a data-toggle="modal" data-target="#staticBackdrop2"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sub-type</a></span> </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Model No.</label>
                      <input type="text" id="generic_name" name="generic_name" class="form-control" placeholder="Model Number">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Unit</label>
                      <select class="form-control" id="unit" name="unit">
                        <option value="">-Select-</option>
                      </select>
                      <span class="small"><a data-toggle="modal" data-target="#staticBackdrop3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Unit</a></span> </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">GST Rate</label>
                      <input  id="gst_rate" name="gst_rate" class="form-control" placeholder="GST Rate" type="phone" onkeyup="value=value.replace(/[^\d]/g,'');gst_divide_new()" >
                      % </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">CGST Rate</label>
                      <input type="text"  id="cgst_rate" name="cgst_rate" class="form-control" placeholder="CGST Rate">
                      % </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">SGST Rate</label>
                      <input type="text"  id="sgst_rate" name="sgst_rate" class="form-control" placeholder="SGST Rate">
                      % </div>
                  </div>
                  <div style="clear:both"></div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Re-Order Level</label>
                      <input name="moq" id="moq" type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Size</label>
                      <input name="size" id="size" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Color</label>
                      <input name="color" id="color" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">MRP (Base / Default Rate)</label>
                      <input name="mrp" id="mrp" type="text" class="form-control">
                    </div>
                  </div>
                  <div style="clear:both"></div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Specification</label>
                      <textarea name="specification" id="specification" class="form-control" cols="" rows="5"></textarea>
                    </div>
                  </div>
                  <!-- END PAGE CONTENT -->
                  <div style="clear:both"></div>
                </div>
              </div>
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
            </form>
            <!-- END PAGE CONTENT --> 
          </div>
        </div>
      </div>
      <!-- END PAGE CONTENT INNER --> 
    </div>
  </div>
  <div class="row">
    <div class="col-md-12" style="overflow:auto">
      <table class="table table-striped table-hover table-bordered" id="asset_entry_data">
        <thead>
          <tr>
            <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Item ID </span></th>
            <th class="draggable" data-column="item_name" style="cursor: move;"><span>Item Name </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>Sub-Category </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>Size </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>Colour </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>GST % </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>MRP </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>Re-Order Level </span></th>
            <th class="print_ignore"><span>Action</span></th>
          </tr>
        </thead>
        <tbody id="assets_body">
        </tbody>
      </table>
    </div>
    <div class="modal fade" id="staticBackdrop1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADD Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <label class="control-label">Type Name</label>
            <input type="text" id="type_name_" name="type_name_" class="form-control" placeholder="Name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onClick="save_type()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="staticBackdrop2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sub Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <label class="control-label">Sub Type Name</label>
            <input type="text" id="sub_type_name_" name="sub_type_name_" class="form-control" placeholder="Name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onClick="save_sub_type()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="staticBackdrop3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADD Unit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <label class="control-label">Unit Name</label>
            <input type="text" id="unit_name_" name="unit_name_" class="form-control" placeholder="Name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onClick="save_unit()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
  </div>
  <!-- END PAGE CONTENT --> 
</div>
<?php include("footer_for_optical.php"); ?>
<script type="text/javascript">
$(".num").keypress(function (evt)
 {
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 
	  && (charCode < 48 || charCode > 57))
	   return false;

	return true;
 });
load_types();
load_sub_types();
load_unit();

function save_asset(){
	if($("#item_name").val()==''){
		alert("Please Enter Item Name");
		return false;	
	}
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_for_optical.php?flag=1',
				type: 'POST',
				dataType: 'json',
				data: $('#save_form').serialize(),
				success: function (data) {
						//console.log(element.text);
						if(data.flag=="1"){
							if($("#id").val()!="") toastr.success('Item Updated Successfully');
						 	else toastr.success('Item Created Successfully');
						
						}else toastr.error('Unable to create Item');
						//$("#asset_name").val('');	
						reset_val();
						//load_item(0);				
						//load_assets();
						setTimeout(function(){ location.reload(); }, 3000);
				}
			});

}
function save_type(){
	var data_details={
		"type_name": $("#type_name_").val()
	}
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_for_optical.php?flag=2',
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
	 $('#staticBackdrop2').modal('hide');
	 $("#type_name").focus();
	 return false;
	}
	
	var data_details={
		"type_id": $("#type_name").val(),
		"sub_type_name": $("#sub_type_name_").val()
	}
	
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_for_optical.php?flag=3',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						if(data.flag=="1") toastr.success('Sub-type Created Successfully');
						else toastr.error('Unable to create sub-type');
						$("#sub_type_name_").val('');
						load_sub_types();
						$('#staticBackdrop2').modal('hide');
									}
			});

}
function save_unit(){
	$('#unit').empty();
	var data_details={
		"unit_name": $("#unit_name_").val()
	}
	$.ajax({

            url: 'get_json_data_for_optical.php?flag=4',
			dataType: 'json',
			type: 'POST',
			data: data_details,
			success: function (data) {
			$('#staticBackdrop3').modal('hide');
			load_unit();
			 $.each(data, function(index, element) {
			 	$('#unit').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 }

		  });
}
function load_types(id){
	
	$('#type_name').empty();

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=5',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#type_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			//alert(id);
				if(id!="")	$("#type_name option[value="+id+"]").attr("selected","selected");
			 }

		  });
	
	
}
//var type_id='';
function load_sub_types(type_id,id){
	
	$('#sub_type_name').empty();
	//alert('san_'+type_id);
	if(type_id=='' || typeof type_id === "undefined"){
		//alert('san'+type_id_);
		var type_id_=$('#type_name').val();
	}else{
		//alert('san2'+type_id_);
		var type_id_=type_id;
	}
	
	$.ajax({

            url: 'get_json_data_for_optical.php?flag=6',
			dataType: 'json',
			data: 'type_id='+type_id_,
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#sub_type_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			//alert(id);
				if(id!="")	$("#sub_type_name option[value="+id+"]").prop("selected","selected");
			
			 }

		  });
}

function load_sub_types_for_edit(id){
	
	$('#sub_type_name').empty();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
            url: 'get_json_data_for_optical.php?flag=6',
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

            url: 'get_json_data_for_optical.php?flag=7',
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



var tab_val_menu=$('#asset_entry_data').DataTable( {

	"bProcessing": true,

	"bServerSide": true,

	"iDisplayLength": 300,

	"sAjaxSource": "get_json_data_for_optical.php?flag=46",

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

function edit(id,hsm_code,asset_name,moq,type_id,sub_type_id,unit_id,size,color,gst_rate,cgst_rate,sgst_rate,generic_name,mrp){
	load_types(type_id);
	//alert(sub_type_id);
	load_sub_types(type_id,sub_type_id);
	load_unit();
	$("#id").val(id);
	$("#hsm_code").val(hsm_code);
	//$("#sub_type_name option[value="+sub_type_id+"]").attr("selected","selected");
	$("#type_name").val(type_id);
	//$("#sub_type_name").val(sub_type_id);
	$("#item_name").val(asset_name);
	$("#generic_name").val(generic_name);
	$("#moq").val(moq);
	$("#size").val(size);
	$("#color").val(color);
	//$("#covid_item").val("");
	$("#unit").val(unit_id);
	$("#gst_rate").val(gst_rate);
	$("#cgst_rate").val(cgst_rate);
	$("#sgst_rate").val(sgst_rate);
	$("#mrp").val(mrp);
	$("#item_name").focus();
	//$("#specification").val(model_no);
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
	//$("#covid_item").val("");
	$("#unit").val("");
	$("#gst_rate").val("");
	$("#cgst_rate").val("");
	$("#sgst_rate").val("");
	$("#mrp").val("");
	$("#specification").val("");
}
function delete_(id){
	if (confirm('Are You Sure To Delete')) {
	var data_details={
		"table": 'item_master_for_optical',
		"id": id
	}
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=9',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				if(data.flag=="1"){
					if($("#id").val()!="") toastr.success('Item Deleted Successfully');
					
				}else toastr.error('Unable to Delete');
				//$("#asset_name").val('');	
				reset_val();
				//load_item(cou_pag_no);	
				setTimeout(function(){ location.reload(); }, 3000);	
			
			 }

		  });
	}
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
function load_individual_asset(id){

	
	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
            url: 'get_json_data_for_optical.php?flag=45',
			type: 'POST',
			dataType: 'json',
			data: "id="+id,
			success: function (data) {
				console.log("Text:"+data.generic_name);
				$("#id").val(data.id);
				$("#hsm_code").val(data.hsm_code);
				$("#type_name").val(data.category_name);
				load_sub_types_for_edit(data.sub_cat);
					
				$("#sub_type_name").val(data.sub_cat);
				$("#item_name").val(data.text);
				$("#generic_name").val(data.generic_name);
				$("#moq").val(data.moq);
				$("#size").val(data.size);
				$("#color").val(data.color);
				$("#mrp").val(data.mrp);
				$("#unit").val(data.unit_name);
				$("#gst_rate").val(data.gst_rate);
				$("#cgst_rate").val(data.cgst_rate);
				$("#sgst_rate").val(data.sgst_rate);
				$("#specification").val(data.specification);
				
				$("#hsn_code").val(data.hsm_code);
				var data_sub_cat=data.sub_cat;
				//alert(data_sub_cat);
						
				
			},
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			
		});
		//edit_sub_type_after_function(data_sub_cat);	

}

function edit_sub_type_after_function(data_sub_cat){
	//alert(ani);
				$("#sub_type_name").val(data_sub_cat);
}
</script> 
</body>
<!-- END BODY -->
</html>