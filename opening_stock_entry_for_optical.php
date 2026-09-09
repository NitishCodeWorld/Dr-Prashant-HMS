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
            <form name="save_op_stock" id="save_op_stock" method="post" enctype="multipart/form-data">
              <!-- BEGIN FORM-->
              <input type="hidden" value="" id="id" name="id" />
              <input type="hidden" value="1" id="dept_name" name="dept_name" />
              <input type="hidden" value="1" id="location_name" name="location_name" />
              <div class="form-body">
                <div class="row" style="background:#dcefff; padding:9px 0px">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Type</label>
                      <select class="form-control" id="type_name" name="type_name" onChange="load_sub_types()">
                      </select>
                      <span class="small"><a data-toggle="modal" data-target="#staticBackdrop1"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Type</a></span> </div>
                  </div>
                  <!--/span-->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Sub Type</label>
                      <select class="form-control" id="sub_type_name" name="sub_type_name">
                      </select>
                      <span class="small"><a data-toggle="modal" data-target="#staticBackdrop2"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sub-type</a></span> </div>
                  </div>
                  
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Item</label>
                      <select class="form-control" id="item_id" name="item_id" onChange="load_types_subtypes()">
                      </select>
                      <!--<span class="small"><a data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Asset</a></span>--> 
                    </div>
                  </div>
                 <div style="clear:both"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Vendor</label>
                      <select class="form-control" id="vendor_name" name="vendor_name">
                      </select>
                      <span class="small"><a data-toggle="modal" data-target="#staticBackdrop6"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Vendor</a></span> </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">QTY</label>
                      <div class="input-group" style="width:100%;">
                        <input name="qty" id="qty"  type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" class="form-control" placeholder="QTY">
                        <span class="input-group-addon" style="padding:0 !important; width:50% !important">
                        <select class="form-control" id="unit" name="unit">
                          <option value="">-Select-</option>
                        </select>
                        </span></div>
                      <span class="small" style="float:right;"><a data-toggle="modal" data-target="#staticBackdrop3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Unit</a></span> </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Batch</label>
                      <input name="batch" id="batch" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">MRP</label>
                      <input name="mrp" id="mrp" type="text" class="form-control">
                    </div>
                  </div>
                  <div style="clear:both"></div>
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
            </form>
          </div>
          <!-- END PAGE CONTENT INNER --> 
        </div>
      </div>
      <div class="row">
        <p style="padding:6px 0 2px 0; text-align:center;backgroung:#fff">
          <button name="submit" onClick="save_data()" class="btn btn-primary">Submit</button>
        </p>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">
            <caption>
            All Assets
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Item Name </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category Name </span></th>
                <th class="draggable" data-column="sub_cat"><span>Sub Cat </span></th>
                <th class="draggable" data-column="department_name" style="cursor: move;"><span>Department Name </span></th>                
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>MRP </span></th>
                <th class="draggable" data-column="location_name" style="cursor: move;"><span>Batch </span></th>
                <th class="draggable" data-column="vendor_name" style="cursor: move;"><span>Expiry Date </span></th>
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
    <!-- Type -->
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
    <!-- Sub Type -->
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
    <!-- Unit -->
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
    <!-- Department -->
    <div class="modal fade" id="staticBackdrop4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADD Departmint</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <label class="control-label">Department Name</label>
            <input type="text" id="department_name" name="department_name" class="form-control" placeholder="Name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onClick="save_department()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Location -->
    <div class="modal fade" id="staticBackdrop5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADD Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <label class="control-label">Location Name</label>
            <input type="text" id="location" name="location" class="form-control" placeholder="Name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onClick="save_location()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Vender -->
    <div class="modal fade" id="staticBackdrop6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADD Vendor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form name="save_from" id="save_form" method="post" enctype="multipart/form-data">
              <input type="hidden" value="" id="id" name="id" />
              
              <!-- BEGIN FORM-->
              <div class="form-body">
                <div class="row" style="background:#dcefff; padding:9px 0px">
                  <div class="col-md-12">
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
                  </div>
                  <!-- END PAGE CONTENT --> 
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn green" onClick="save_vendor(); return false;">Submit</button>
            <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END PAGE CONTAINER --> 
</div>
<?php include("footer_for_optical.php"); ?>
<script type="text/javascript">
$("#expiry").datepicker({
	   format: 'dd-mm-yyyy'
   });

$("#mfg_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
$('#item_id').select2();
$('#vendor_name').select2();
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
//load_department();
load_vendor();
//load_location();
load_item();
//var cou_pag_no=0;
//load_op_stock_data(cou_pag_no);
let tab_asset_entry="";
load_opening_stock_details();




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
function save_department(){

	var data_details={
		"department_name": $("#department_name").val(),
		"id": $("#id").val()
	}
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_for_optical.php?flag=14',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
					$('#staticBackdrop4').modal('hide');
						//console.log(element.text);
						if(data.flag=="1") toastr.success('Department Created Successfully');
						else toastr.error('Unable to create department');
						$("#department_name").val('');						
						load_department();
				}
			});

}
function load_department(){
	$('#dept_name').empty();
	$.ajax({

            url: 'get_json_data_for_optical.php?flag=13',
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
function save_vendor(){
	var edit_flag=0;
		$.ajax({
			  url: 'get_json_data_for_optical.php?flag=10',
			  type: 'POST',
			  dataType: 'json',
			  data: $('#save_form').serialize(),
			  success: function (data) {
					 $('#staticBackdrop6').modal('hide');
					  if(data.flag=="1"){
						  if($("#id").val()!="") toastr.success('Vendor Updated Successfully');
						  else toastr.success('Vendor Created Successfully');
					  
					  }else toastr.error('Unable to create Item');
					  load_vendor();				
					 
			  }
		  });

}
function load_vendor(){
	$('#vendor_name').empty();
	$.ajax({

            url: 'get_json_data_for_optical.php?flag=11',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
				$.each(data, function(index, element) {
			 	$('#vendor_name').append($('<option/>', { 

					value: element.id,
					text : element.vendor_name 

				}));
		 	});
			 }

		  });
}
function save_location(){
	var data_details={
		"location": $("#location").val()
	}
	$.ajax({

            url: 'get_json_data_for_optical.php?flag=15',
			dataType: 'json',
			type: 'POST',
			data: data_details,
			success: function (data) {
			$('#staticBackdrop5').modal('hide');
			load_location();
			 }

		  });
}
function load_location(){
	
	$('#location_name').empty();

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=16',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#location_name').append($('<option/>', { 

					value: element.id,
					text : element.location_name 

				}));
		 	});
			
			 }

		  });
}
function load_item(){
	
	$('#item_id').empty();

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=47',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#item_id').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 }

		  });
}
function save_data(){
		if($('#type_name').val()==''){
			alert('Plese Choose Type Name!...');
			return false;
		}
		if($('#item_id').val()==''){
			alert('Plese Choose Item Name!...');
			return false;
		}
		$.ajax({
				url: 'get_json_data_for_optical.php?flag=18',
				type: 'POST',
				dataType: 'json',
				data: $('#save_op_stock').serialize(),
				success: function (data) {
						if(data.flag=="1"){
						 	toastr.success('Save Date Successfully');
						
						}else toastr.error('Unable to Save Data');
						load_types();
						load_sub_types();
						load_unit();
						//load_department();
						load_vendor();
						//load_location();
						load_item();
						$("#batch").val("");
						$("#mrp").val("");
						$("#qty").val("");
						$("#expiry").val("");
						$("#mfg_date").val("");
						load_op_stock_data(cou_pag_no);
				}
			});

}

function load_op_stock_data(cou_pag_no){
	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;
	var data_details={
		"initial_page": initial_page,
		"limit": <?php echo $limit;?>
	}
	$.ajax({

            url: 'get_json_data_for_optical.php?flag=19',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				var html='';
				 $.each(data, function(index, element) {
					 /*$arr[]=array("id"=>$id,"item_name"=>$item_name,"type_name"=>$type_name,"sub_cat"=>$sub_cat,"department"=>$department,"location_name"=>$location_name,"vendor"=>$vendor,"mrp"=>$mrp,"qty"=>$qty,"action"=>$action_edit);*/
					html +='<tr><td>'+element.item_name+'</td><td>'+element.type_name+'</td><td>'+element.sub_cat+'</td><td>'+element.department+'</td><td>'+element.location_name+'</td><td>'+element.vendor+'</td><td>'+element.qty+'</td><td>'+element.mrp+'</td><td>'+element.action+'</td></tr>';
				});
				$('#assets_body').html(html);
			
			 }

		  });
}

function load_opening_stock_details(){

	$('#asset_name').empty();
	if(tab_asset_entry!="") tab_asset_entry.destroy();

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			  $("#submit_form_button").prop('disabled', true);
		    },
            url: 'get_json_data_for_optical.php?flag=19',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			 $('#assets_body').html('');
			 $.each(data, function(index, element) {
			 	$('#assets_body').html($('#assets_body').html()+'<tr><td>'+element.item_name+'</td><td>'+element.type_name+'</td><td>'+element.sub_cat+'</td><td>'+element.vendor+'</td><td>'+element.qty+'</td><td>'+element.mrp+'</td><td>'+element.batch+'</td><td>'+element.expiry+'</td><td>'+element.action+'</td></tr>');
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

}

function delete_(id){
	if (confirm('Are You Sure To Delete')) {
	var data_details={
		"table": 'opening_stock_for_optical',
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
				//reset_val();
				//load_op_stock_data(cou_pag_no);	
				setTimeout(function(){ location.reload(); }, 3000);	
			
			 }

		  });
	}
}

function load_types_subtypes(){
	var id=$("#item_id").val();
	$("#type_name").val("");
	$("#sub_type_name").val("");
	$("#mrp").val("");
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
				$("#type_name").val(data.category_name);
				load_sub_types_for_edit(data.sub_cat);					
				$("#sub_type_name").val(data.sub_cat);
				var data_sub_cat=data.sub_cat;
				$("#mrp").val(data.mrp);
			},
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			
		});
		//edit_sub_type_after_function(data_sub_cat);	

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

function edit_sub_type_after_function(data_sub_cat){
	//alert(ani);
	$("#sub_type_name").val(data_sub_cat);
}
</script>