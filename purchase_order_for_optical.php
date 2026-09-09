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
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Department</label>
                      <select class="form-control" id="dept_name">
                        <option value="">IPD</option>
                        <option value="">Daily Cleaning</option>
                        <option value="">Other</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Type</label>
                      <select class="form-control" id="type_name" onChange="load_sub_types(); load_asset_entry_data()">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Sub Type</label>
                      <select class="form-control" id="sub_type_name" onChange="load_asset_entry_data();load_item();">
                        <option value="">Level 1</option>
                        <option value="">Level 2</option>
                        <option value="">Other</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Item</label>
                      <select class="form-control" id="item_id" name="item_id" onChange="load_asset_entry_data()">
                      </select>
                      
                      <!--<span class="small"><a data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Asset</a></span>--> 
                      
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Choose Vendor</label>
                      <select class="form-control" id="vendor_name">
                        <option value="">...</option>
                        <option value="">...</option>
                        <option value="">Other</option>
                      </select>
                    </div>
                  </div>
                  <!--<div class="col-md-2" style="text-align:center;">
                    <div class="form-group">
                      <label for="">Add Item For Item Master<br/>
                        <strong>(Please Click On '+')</strong></label>
                      <br />
                      <a href="javascript:void(0);" id="add_record"  data-toggle="modal" title="Add Record"><i class="fa fa-plus" style="font-size:24px;padding-top:10px;color:black"></i></a> </div>
                  </div>-->
                  
                  <!-- END PAGE CONTENT --> 
                  
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-md-12" style="overflow:auto">
                <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">
                  <caption>
                  Items Indented
                  </caption>
                  <thead>
                    <tr>
                      <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Asset Name </span></th>
                      <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category Name </span></th>
                      <th class="draggable" data-column="sub_cat"><span>Sub Cat </span></th>
                      
                      <!--<th class="draggable" data-column="department_name" style="cursor: move;"><span>Department Name

</span></th>-->
                      
                      <th class="draggable" data-column="location_name" style="cursor: move;"><span>Size </span></th>
                      <th class="draggable right" data-column="size" style="cursor: move;"><span>Colour </span></th>
                      
                      <!--<th class="draggable right" data-column="size" style="cursor: move;"><span>Covid Item

</span></th>-->
                      
                      <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Qty </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>GP </span></th>
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
                      
                      <!--<th class="draggable" data-column="department_name" style="cursor: move;"><span>Department Name

</span></th>-->
                      
                      <th class="draggable" data-column="location_name" style="cursor: move;"><span>GP </span></th>
                      <th class="draggable right" data-column="size" style="cursor: move;"><span>Size </span></th>
                      <th class="draggable right" data-column="size" style="cursor: move;"><span>Colour </span></th>
                      
                      <!--<th class="draggable" data-column="covid_item" style="cursor: move;"><span>Covid Item

</span></th>-->
                      
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
                    </tr>
                  </thead>
                  <tbody id="assets_indent_body">
                  </tbody>
                </table>
              </div>
              <div class="col-md-12" style="text-align:center; margin-bottom:10px">
                <input type="button" class="btn" onClick="save_purchase()" value="Save Purchase" style="background:#000099;color:#FFFFFF;width:120px" />
              </div>
            </div>
            
            <!-- END PAGE CONTENT -->
            
            <div class="row">
              <div class="col-md-12" style="overflow:auto">
                <table class="table table-striped table-bordered table-hover small" id="full_tab_details">
                  <caption>
                  Full Order Details
                  </caption>
                  <thead>
                    <tr>
                      <th class="draggable" data-column="asset_name" style="cursor: move;"><span>PO Number </span></th>
                      <th class="draggable" data-column="category_name" style="cursor: move;"><span>Vendor Name</span></th>
                      <th class="draggable" data-column="sub_cat"><span>Date</span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Status </span></th>
                      <th class="print_ignore"><span>Action</span></th>
                    </tr>
                  </thead>
                  <tbody id="tab_po_body">
                  </tbody>
                </table>
               
                <?php 

					$sql_="select * from `purchase_order_for_optical`";

					$result=mysqli_query($conn,$sql_);

					$count=$result->num_rows;  

					$count_limit=ceil($count / $limit);

					echo '<div class="col-md-6" style="float:right;text-align:right;">';

					for ($page_number = 1; $page_number <=$count_limit; $page_number++) {

					  echo '<a href="javascript:void(0);" class="btn btn-primary" onClick="load_item('.$page_number.')">'.$page_number.'</a>';

					}

					echo '</div>';

					?>
                <input type="hidden" name="row_limit" id="row_limit" value="<?php echo $limit?>">
              </div>
              
              <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
              
            </div>
          </div>
        </div>
      </div>
      
      <!-- END PAGE CONTENT INNER --> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTENT --> 
  
</div>
<?php include("footer_for_optical.php"); ?>
<script>

//Changes By Soumitra

/*$("#add_record").click(function(){

	$("#item_master_modal").modal("show");

	$("#hsm_code").val('');

	$("#type_name_mod").val('');

	$("#sub_type_name_mod").val('');

	$("#item_name").val('');

	$("#generic_name").val('');

	$("#moq").val('');

	$("#size").val('');

	$("#color").val('');

	$("#unit").val('');

	$("#gst_rate").val('');

	$("#cgst_rate").val('');

	$("#sgst_rate").val('');

	$("#mrp").val('');

	$("#specification").val('');

	

});
*/


//End changes by soumitra



var tab_asset_entry="";



load_vendor();

load_departments();

load_sub_types();

load_types();

//load_asset_entry_data();

load_unit();

var cou_pag_no=0;

load_po_det(cou_pag_no);

$('#item_id').select2();



function load_asset_entry_data(){

if(tab_asset_entry!="") tab_asset_entry.destroy();



var data_details={

		"id": $("#id").val(),

		"dept_name": $("#dept_name").val(),

		"type_name": $("#type_name").val(),

		"sub_type_name": $("#sub_type_name").val(),

		"asset_id": $("#item_id").val(),

		//"location_name": $("#location_name").val(),

		//"indent_flag" : "1"

		

}



$.ajax({

            url: 'get_json_data_for_optical.php?flag=21',

			type: 'POST',

			data: data_details,

			success: function (data) {

				$("#assets_body").html(data);

				tab_asset_entry=$("#asset_entry_data").DataTable( {

					"destroy": true,

					dom: 'Bfrtip',

					"pageLength": 15,

					"initComplete": function(settings, json) {

					//$('#products_filter').hide();

				}

				} );

				

			}

		});



}

function add_indent(id){



	var src=$("#assets_indent_body").html();

	var tds = $(src).find("td[id='"+id+"_qty_qty']");

	if(!tds.html()){ 

	

	//alert($("#"+id+"_rspf").val());

	

	if($("#"+id+"_qty").val()!="" || $("#"+id+"_qty").val()!=0){ 

	

		$("#assets_indent_body").html($("#assets_indent_body").html()+"<tr id='"+id+"'><td id='"+id+"_asset_name' >"+$("#"+id+"_asset").html()+"</td><td>"+$("#"+id+"_main_cat").html()+"</td><td>"+$("#"+id+"_sub_cat").html()+"</td><td><table class='table table-striped table-bordered table-hover small'><thead><th></th><th>SPF</th><th>Cyl</th><th>Axis</th><th>Add</th></thead><tbody><tr><td><b>RE</b></td><td><label style='width:70px' id='"+id+"_rspf_' >"+$("#"+id+"_rspf").val()+"</label></td><td><label style='width:70px' id='"+id+"_rcyl_' >"+$("#"+id+"_rcyl").val()+" </label></td><td><label style='width:70px' id='"+id+"_raxis_'>"+$("#"+id+"_raxis").val()+"</label></td><td><label style='width:70px' id='"+id+"_radd_'>"+$("#"+id+"_radd").val()+"</label></td><tr><td><b>LE</b></td><td><label style='width:70px' id='"+id+"_lspf_' >"+$("#"+id+"_lspf").val()+"</label></td><td><label style='width:70px' id='"+id+"_lcyl_' >"+$("#"+id+"_lcyl").val()+"</label></td><td><label style='width:70px' id='"+id+"_laxis_' >"+$("#"+id+"_laxis").val()+"</label></td><td><label style='width:70px' id='"+id+"_ladd_'>"+$("#"+id+"_ladd").val()+"</label></td></tr></tr></tbody></table></td><td>"+$("#"+id+"_size").html()+"</td><td>"+$("#"+id+"_color").html()+"</td><td id='"+id+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><a href='javascript:;' onclick='del(\""+id+"\")'><i class='fa fa-trash'></i></a></td></tr>");

	

	}

	

	}else $("#"+id+"_qty_qty").html((parseInt(tds.html())+parseInt($("#"+id+"_qty").val())));

}

function del(id){



	$("#"+id).remove();



}

function save_purchase(){

	if($("#vendor_name").val()==''){
		alert('Please Enter Vendor Name!...');
		return false;	
	}

	let ids=[];

	let qty=[];

	let rspf=[];

	let rcyl=[];

	let raxis=[];

	let lspf=[];

	let lcyl=[];

	let laxis=[];

	let asset_name=[];

	let i=0;

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){

  		console.log( index + ": " + $( this ).attr('id') );

		ids[i]=$( this ).attr('id');

		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();

		asset_name[i]=$("#"+$( this ).attr('id')+"_asset_name").html();

		if($("#"+$( this ).attr('id')+"_rspf_").length){

			rspf[i]=$("#"+$( this ).attr('id')+"_rspf_").html();

			rcyl[i]=$("#"+$( this ).attr('id')+"_rcyl_").html();

			raxis[i]=$("#"+$( this ).attr('id')+"_raxis_").html();

			lspf[i]=$("#"+$( this ).attr('id')+"_lspf_").html();

			lcyl[i]=$("#"+$( this ).attr('id')+"_lcyl_").html();

			laxis[i]=$("#"+$( this ).attr('id')+"_laxis_").html();

		}

		i++;

});

	var data_details={

		"id" : ids,

		"qty" : qty,

		"rspf"	: rspf,

		"rcyl"	: rcyl,

		"raxis"	: raxis,

		"lspf"	: lspf,

		"lcyl"	: lcyl,

		"laxis"	: laxis,

		"asset_name" : asset_name,

		"vendor_name" : $("#vendor_name option:selected").text(),

		"vendor_id" : $("#vendor_name").val()

	}

	

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=22',

			type: 'POST',

			dataType: 'json',

			data: data_details,

			success: function (data) {

			

				//console.log(data.confirm_flag);

				//alert("data");	

				//alert(data);

				//load_asset_entry_data();

				if(data.flag="1") toastr.success('Order Saved Successfully');

				else toastr.error('Unable to save indent');

				setTimeout(function(){ location.reload(); }, 2000);	

				

			}

		});



}

function load_departments(){

	

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

function load_sub_types(type_id,id){

	load_item();

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

function load_item(){



	$('#item_id').empty();

	var data_details={

		"type_id": $("#type_name").val(),

		"sub_type_id": $("#sub_type_name").val(),

	}

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=17',

			dataType: 'json',

			type: 'POST',

			data:data_details,

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

function load_po_det(cou_pag_no){

	//alert($('#row_limit').val());

	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;

	//let row_limit=($('#row_limit').val()!="" ) ? parseFloat($('#row_limit').val())+page_limit : '0';

	//$('#row_limit').val(initial_page);

	var data_details={

		"initial_page": initial_page,

		"limit": <?php echo $limit;?>

	}

	$.ajax({



            url: 'get_json_data_for_optical.php?flag=23',

			dataType: 'json',

			type: 'POST',

			data:data_details,

			success: function (data) {

				var html='';

				 $.each(data, function(index, element) {
					 if(element.status=='1'){
						var colour='#e011111f'; 
					 }else{
						 var colour='';
					 }
					html +='<tr style="background-color:'+colour+'"><td><a href="purchase_order_invoice_print_optical.php?inv_id='+element.id+'">'+element.order_number+'</a></td><td>'+element.vendor_name+'</td><td>'+element.date+'</td><td>'+element.status+'</td><td>'+element.action+'</td></tr>';
				});

				$('#tab_po_body').html(html);

			

			 }



		  });

}

</script>
</body>

<!-- END BODY -->

</html>
