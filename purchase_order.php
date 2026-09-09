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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Asset Management</span></div>
            </div>
            <!-- BEGIN FORM-->
            <input type="hidden" value="" id="id" name="id" />
            <div class="form-body">
              <div class="row" style="background:#dcefff; padding:9px 0px">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Choose Indent</label>
                    <select class="form-control" id="indent" onChange="load_asset_entry_data()">
                    </select>
                  </div>
                </div>
                
                <!--/span-->
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Choose Vendor</label>
                    <select class="form-control" id="vendor_name">
                      <option value="">...</option>
                      <option value="">...</option>
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
            Items Indented
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Item Name </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category Name </span></th>
                <th class="draggable" data-column="sub_cat"><span>Sub Cat </span></th>
                <th class="draggable" data-column="department_name" style="cursor: move;"><span>Department Name </span></th>     
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
            Order List
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Item Name </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category Name </span></th>
                <th class="draggable" data-column="sub_cat"><span>Sub Cat </span></th>
                <th class="draggable" data-column="department_name" style="cursor: move;"><span>Department Name </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
              </tr>
            </thead>
            <tbody id="assets_indent_body">
            </tbody>
          </table>
        </div>
        <div class="col-md-12" style="text-align:center; margin-bottom:10px">
          <input type="button" class="btn" onClick="save_purchase()" id="submit_form_button" value="Save Purchase" style="background:#000099;color:#FFFFFF;width:120px" />
        </div>
        
        <div style="clear:both; height:15px">&nbsp;</div>
								<table class="table table-bordered table-striped" id="invoices" role="grid" aria-describedby="product_list_info">
								<thead>
								<tr>
									<th class="hidden-380" style="text-align:center">
										 Indent Number
									</th>
									<th class="hidden-380" style="text-align:center">
										 Department
									</th>
									<th class="hidden-380" style="text-align:center">
										 Indent Date
									</th>
									<th class="hidden-380" style="text-align:center">
										 Action
									</th>
								</tr>
								</thead>
								<tbody id="invoices_disp">
									
								</tbody>
								</table>
      </div>
      
      <!-- END PAGE CONTENT --> 
    </div>
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

let tab_asset_entry="";

load_indents();
load_indents_purchase_order();
load_vendor();

function load_indents(){

	$('#indent').empty();
	
	$('#indent').append($('<option/>', { 

					value: '',
					text : '-Select-' 

				}));

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=24',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#indent').append($('<option/>', { 

					value: element.id,
					text : element.id+" "+element.department+" "+element.date, 

				}));
		 	});
			
			 },
			 complete: function(){
			  $('.ajax-loader').css("visibility", "hidden");
			  $("#submit_form_button").prop('disabled', false);
			}

		  });

}

function load_vendor(){
	
	$('#vendor_name').empty();
	
	

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			  $("#submit_form_button").prop('disabled', true);
			},
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
			
			 },
			 complete: function(){
			  $('.ajax-loader').css("visibility", "hidden");
			  $("#submit_form_button").prop('disabled', false);
			}

		  });
}


function load_asset_entry_data(){
if(tab_asset_entry!="") tab_asset_entry.destroy();

var data_details={
		"id": $("#indent").val(),
		"dept_name": $("#dept_name").val(),
		"type_name": $("#type_name").val(),
		"sub_type_name": $("#sub_type_name").val(),
		"location_name": $("#location_name").val(),
		"indent_flag" : "1"
		
}

$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=89',
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
			  $("#submit_form_button").prop('disabled', false);
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
			  $("#submit_form_button").prop('disabled', true);
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
			  $("#submit_form_button").prop('disabled', false);
			}
		});

}

function add_indent(id,indent_id,indent_details_id){

	var src=$("#assets_indent_body").html();
	var tds = $(src).find("td[id='"+id+"_qty_qty']");
	
	if(parseInt($("#"+id+"_qty").val())>parseInt($("#"+id+"_qty").attr("data-qty"))) alert("Order quantity must not exceed quanity indented1");
	
	//alert($("#"+id+"_qty").attr("data-qty"));
	//alert(tds.html());
	//alert($("#"+id+"_qty").val());
	
	if(typeof tds.html() === "undefined"){ 
	
	if(($("#"+id+"_qty").val()!="" || $("#"+id+"_qty").val()!=0) && (parseInt($("#"+id+"_qty").val())<=parseInt($("#"+id+"_qty").attr("data-qty"))) ){ 
	
		$("#assets_indent_body").html($("#assets_indent_body").html()+"<tr id='"+id+"' data-indent='"+indent_id+"' data-details-indent='"+indent_details_id+"'><td id='"+id+"_asset_name' >"+$("#"+id+"_asset").html()+"</td><td>"+$("#"+id+"_main_cat").html()+"</td><td>"+$("#"+id+"_sub_cat").html()+"</td><td id='"+id+"_dept_name' >"+$("#"+id+"_dept_name").html()+"</td><td id='"+id+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><a href='javascript:;' onclick='del(\""+id+"\")'><i class='fa fa-trash'></i></a></td></tr>");
	
	$("#"+id+"_qty").val(parseInt($("#"+id+"_qty").attr("data-qty"))-(parseInt($("#"+id+"_qty").val())));
	
	}else $("#"+id+"_qty").val($("#"+id+"_qty").attr("data-qty"));
	
	}else{
	 	if((parseInt($("#"+id+"_qty").val())+parseInt(tds.html()))>$("#"+id+"_qty").attr("data-qty")) alert("Order quantity must not exceed quanity indented");
	 	else{
		
		 let qty_added=tds.html();
		 $("#"+id+"_qty_qty").html((parseInt(tds.html())+parseInt($("#"+id+"_qty").val())));
		 $("#"+id+"_qty").val(parseInt($("#"+id+"_qty").attr("data-qty"))-(parseInt($("#"+id+"_qty").val())+parseInt(qty_added)));
	
	 	}
	 }
}

function save_purchase(){

	//alert(trs.id);
	if($("#vendor_name").val()==""){
	 
	 alert("Please select a vendor");
	 return;
	 
	}
	
	let indent_id=[];
	let indent_details_id=[];
	let ids=[];
	let qty=[];
	let asset_name=[];
	let dept_name=[];
	let i=0;
	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){
  		console.log( index + ": " + $( this ).attr('id') );
		indent_id[i]=$( this ).attr('data-indent');
		indent_details_id[i]=$( this ).attr('data-details-indent');
		ids[i]=$( this ).attr('id');
		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();
		asset_name[i]=$("#"+$( this ).attr('id')+"_asset_name").html();
		dept_name[i]=$("#"+$( this ).attr('id')+"_dept_name").html();
		i++;
});
	var data_details={
		"indent_id" : indent_id,
		"indent_details_id" : indent_details_id,
		"id" : ids,
		"qty" : qty,
		"asset_name" : asset_name,
		"department_name" : dept_name,
		"vendor_name" : $("#vendor_name option:selected").text(),
		"vendor_id" : $("#vendor_name").val()
		
	}
	
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=25',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data.flag);
				//load_asset_entry_data();
				if(data.flag=="1") toastr.success('Order Saved Successfully');
				else toastr.error('Unable to save order');
				setTimeout(function(){ window.location.href = window.location.href; }, 2000);	
				
			},
			 complete: function(){
			  $('.ajax-loader').css("visibility", "hidden");
			  $("#submit_form_button").prop('disabled', false);
			}
		});

}

function load_indents_purchase_order(){

	
	//alert("Into It");
	let html_data="";

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			  $("#submit_form_button").prop('disabled', true);
			},
			url: 'get_json_data_inventory.php?flag=77',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
				
				 $.each(data, function(index, element) {
			 	
					html_data+='<tr><td><a target="_blank" href="indent_print.php?inv_id='+element.id+'">'+element.id+'</a></td><td>'+element.department+'</td><td>'+element.date+'</td><td><a href="javascript:void(0);" onclick="del_asset_indent('+element.id+')"><i class="fa fa-trash"></i></a></td><tr>';
				
				
				 });
				
				$("#invoices_disp").html(html_data);
				
				
			},
			 complete: function(){
			  $('.ajax-loader').css("visibility", "hidden");
			  $("#submit_form_button").prop('disabled', false);
			}
	
	});



}
function del_asset_indent(id){

	if(!confirm("Are you sure you want to delete it?")){
		return false;
	}
	
	var data_details={
		"indent_id":id
	}

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=78',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
				
				if(data.flag=="1") toastr.success("Deleted Successfully");
				else toastr.error("Unable to delete");
				
				load_indent();
				
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