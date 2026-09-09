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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Indent Management</span></div>
            </div>
            <!-- BEGIN FORM-->
            <input type="hidden" value="" id="id" name="id" />
            <div class="form-body">
              <div class="row" style="background:#dcefff; padding:9px 0px">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Department</label>
                    <select class="form-control" id="dept_name" onChange="load_asset_entry_data()">
                      <option value="">IPD</option>
                      <option value="">Daily Cleaning</option>
                      <option value="">Other</option>
                    </select>
                  </div>
                </div>
                 <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Location</label>
                    <select class="form-control" id="location_name" onChange="load_asset_entry_data()">
                      <option value="">...</option>
                      <option value="">...</option>
                      <option value="">Other</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Type</label>
                    <select class="form-control" id="type_name" onChange="load_sub_types(); load_asset_entry_data()">
                    </select>
                  </div>
                </div>
                <!--/span-->
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Sub Type</label>
                    <select class="form-control" id="sub_type_name" onChange="load_asset_entry_data()">
                      <option value="">Level 1</option>
                      <option value="">Level 2</option>
                      <option value="">Other</option>
                    </select>
                  </div>
                </div>
               
                
                <!-- END PAGE CONTENT --> 
              </div>
            </div>
          </div>
          
          <!-- END PAGE CONTENT INNER --> 
        </div>
        <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>loader.gif" class="img-responsive" /> </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">
            <caption>
            All Items
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Indent Name </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category Name </span></th>
                <th class="draggable" data-column="sub_cat"><span>Sub Cat </span></th>
                <th class="draggable" data-column="location_name" style="cursor: move;"><span>Location Name </span></th>                
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <td class="print_ignore"><span>Action</span></td>
              </tr>
            </thead>
            <tbody id="assets_body">
            </tbody>
          </table>
        </div>
        
        <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-bordered table-hover small" id="asset_entry_data1">
            <caption>
            Requisition List
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Indent Name </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category Name </span></th>
                <th class="draggable" data-column="sub_cat"><span>Sub Cat </span></th>
                <th class="draggable" data-column="location_name" style="cursor: move;"><span>Location Name </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
              </tr>
            </thead>
            <tbody id="assets_indent_body">
            </tbody>
          </table>
        </div>
        <div class="col-md-12" style="text-align:center; margin-bottom:10px">
          <input type="button" class="btn" onClick="send_indent()" id="submit_form_button" value="Send Indent" style="background:#000099;color:#FFFFFF;width:120px" />
        </div>
      </div>
      
      <!-- END PAGE CONTENT --> 
    </div>
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

var tab_asset_entry="";

load_asset_entry_data();
load_assets();
load_types();
load_sub_types();
load_departments();
load_location();
load_vendor();
load_unit();


function load_assets(){

	$('#asset_name').empty();

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=1',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#asset_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 },
			 complete: function(){
				$('.ajax-loader').css("visibility", "hidden");
			  }

		  });

}

function load_types(){
	
	$('#type_name').empty();

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
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
			  }

		  });
	
	
}

function load_sub_types(id){
	
	$('#sub_type_name').empty();

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
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
			  }

		  });
}

function load_departments(){
	
	$('#dept_name').empty();

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
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
			
			 },
			 complete: function(){
				$('.ajax-loader').css("visibility", "hidden");
			  }

		  });
}


function load_location(){
	
	$('#location_name').empty();

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
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
			
			 },
			 complete: function(){
				$('.ajax-loader').css("visibility", "hidden");
			  }

		  });
}



function load_unit(){
	
	$('#unit').empty();

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
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
			
			 },
			 complete: function(){
				$('.ajax-loader').css("visibility", "hidden");
			  }

		  });
}


function load_asset_entry_data(){
if(tab_asset_entry!="") tab_asset_entry.destroy();

var data_details={
		"id": $("#id").val(),
		"dept_name": $("#dept_name").val(),
		"type_name": $("#type_name").val(),
		"sub_type_name": $("#sub_type_name").val(),
		"location_name": $("#location_name :selected").text(),
		"location_id": $("#location_name").val(),
		
}

$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=22',
			type: 'POST',
			data: data_details,
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
				
			},
			 complete: function(){
				$('.ajax-loader').css("visibility", "hidden");
			  }
		});

}

function del(id){

	$("#"+id).remove();

}


function edit(id){

$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=19',
			dataType: 'json',
			type: 'POST',
			data: "id="+id,
			success: function (data) {
				console.log(data.type_id);
				$("#id").val(id);
				$("#type_name").val(data.type_id);
				$("#dept_name").val(data.dept_id);
				$("#location_name").val(data.location_id);
				$("#vendor_name").val(data.vendor_id);
				$("#asset_name").val(data.asset_name);
				$("#qty").val(data.qty);
				$("#unit").val(data.unit_id);
				$("#size").val(data.size);
				$("#color").val(data.color);
				$("#covid_item").val(data.covid_item);
				$("#specification").val(data.specification);
				load_sub_types(data.sub_type_id);
				$("#type_name").focus()
				
				
			},
			 complete: function(){
				$('.ajax-loader').css("visibility", "hidden");
			  }
		});

}

function add_indent(id,location_id){

	var src=$("#assets_indent_body").html();
	var tds = $(src).find("td[id='"+id+"_qty_qty']");
	var location = $(src).find("td[id='"+id+"_location']");
	//alert(location.data('location'));
	//alert(location_id);
	if(!tds.html() || (location_id!=location.data('location'))){ 
	
	if($("#"+id+"_qty").val()!="" || $("#"+id+"_qty").val()!=0){ 
	
		$("#assets_indent_body").html($("#assets_indent_body").html()+"<tr id='"+id+"'><td>"+$("#"+id+"_asset").html()+"</td><td>"+$("#"+id+"_main_cat").html()+"</td><td>"+$("#"+id+"_sub_cat").html()+"</td><td id='"+id+"_location' data-location='"+$("#"+id+"_location_name").data('location')+"'>"+$("#"+id+"_location_name").html()+"</td><td id='"+id+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><a href='javascript:;' onclick='del(\""+id+"\")'><i class='fa fa-trash'></i></a></td></tr>");
	
	}
	
	}else $("#"+id+"_qty_qty").html((parseInt(tds.html())+parseInt($("#"+id+"_qty").val())));
}

function send_indent(){

	//alert(trs.id);
	
	let ids=[];
	let qty=[];
	let location=[];
	let i=0;
	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){
  		console.log( index + ": " + $( this ).attr('id') );
		ids[i]=$( this ).attr('id');
		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();
		location[i]=$("#"+$( this ).attr('id')+"_location").html();
		i++;
});
	var data_details={
		"id" : ids,
		"qty" : qty,
		"location": $("#location_name").val(),
		"department" : $("#dept_name").val()
	}
	
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=23',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				//load_asset_entry_data();
				if(data.flag="1") { toastr.success('Indent Saved Successfully');
				}
				else toastr.error('Unable to save indent');
				
				setTimeout(function(){ window.location.href = window.location.href; }, 2000);	
				
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