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

                  <div class="col-md-3">

                    <div class="form-group">

                      <label for="">Choose Purchase Order</label>

                      <select class="form-control" id="indent" onChange="load_purchase_order_data()">

                      </select>

                      <br/>

                      <button type="button" class="btn btn-primary btn-sm" onClick="load_purchase_orders()"><i class="fa fa-refresh" aria-hidden="true"></i></button>

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

                      <th class="draggable" data-column="covid_item" style="cursor: move;"><span>GP Details</span></th>

                      <th class="draggable right" data-column="qty" style="cursor: move;"><span> Qty</span></th>

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

                <div class="col-md-3">

                  <div class="form-group">

                    <label class="control-label">Type</label>

                    <select class="form-control" id="type_name" onChange="load_sub_types(); load_asset_entry_data()">

                    </select>

                  </div>

                </div>

                <div class="col-md-3">

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

                    <select class="form-control" id="item" >

                      <option value="">Level 1</option>

                      <option value="">Level 2</option>

                      <option value="">Other</option>

                    </select>

                  </div>

                </div>

                <div class="col-md-1">

                  <div class="form-group">

                    <label for="">Quantity</label>

                    <input type="text" id="freeItem_qty" class="form-control" data-qty="" />

                  </div>

                </div>

                <div class="col-md-2" style="margin-top:25px">

                  <button class="btn green" onClick="add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value)">Add Free Item</button>

                </div>

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
                      <th class="draggable" data-column="asset_name" style="cursor: move;"><span>HSN Code </span></th>
                      <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Asset Name </span></th>
                      <th class="draggable right" data-column="size" style="cursor: move;"><span>Size </span></th>
                      <th class="draggable right" data-column="size" style="cursor: move;"><span>Colour </span></th>
                      <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Batch No. </span></th>
                      <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Bar Code </span></th>
                      <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Manufacturing Date </span></th>
                      <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Expiry Date </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>Rate </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>Discount Rate </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>Discount Amount </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>Amount </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>GST Rate </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>GST Amount </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>CGST Rate </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>CGST Amount </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>SGST Rate </span></th>
                      <th class="draggable right" data-column="rate" style="cursor: move;"><span>SGST Amount </span></th>
                      <th class="draggable right" data-column="total_amount" style="cursor: move;"><span>Net Amount </span></th>
                      <th class="draggable right" data-column="total_amount" style="cursor: move;"><span>MRP </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
                    </tr>
                  </thead>
                  <tbody id="assets_indent_body">
                  </tbody>
                  <tfoot>
                    <tr style="font-weight:bold;font-size:15px;">
                      <td colspan="11" align="right">Total</td>
                      <td><span id="total_amount"></span></td>
                      <td colspan="9"></td>
                    </tr>
                    <tr style="font-weight:bold;font-size:15px;">
                      <td colspan="11" align="right">Add: CGST</td>
                      <td><span id="CGST_amount_"></span></td>
                      <td colspan="9"></td>
                    </tr>
                    <tr style="font-weight:bold;font-size:15px;">
                      <td colspan="11" align="right">Add: SGST</td>
                      <td><span id="SGST_amount_"></span></td>
                      <td colspan="9"></td>
                    </tr>
                    <tr style="font-weight:bold;font-size:15px;">
                      <td colspan="11" align="right">Net Total</td>
                      <td><span id="net_total_"></span></td>
                      <td colspan="9"></td>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <div class="col-md-12" style="text-align:center; margin-bottom:10px">

                <input type="button" class="btn" onClick="save_purchase()" id="save_purchase" value="Save Purchase" style="background:#000099;color:#FFFFFF;width:120px" />

                &nbsp;&nbsp;

                <input type="button" id="save_purchase_print" class="btn" onClick="save_purchase(1)" value="Save & Print" style="background:#000099;color:#FFFFFF;width:120px" />

              </div>

              <div style="clear:both; height:15px">&nbsp;</div>

              <table class="table table-bordered table-striped" id="invoices" role="grid" aria-describedby="product_list_info">

                <thead>

                  <tr>

                    <th class="hidden-380" style="text-align:center"> Invoice Number </th>

                    <th class="hidden-380" style="text-align:center"> Invoice Date </th>

                    <th class="hidden-380" style="text-align:center"> Vendor Name </th>

                    <th class="hidden-380" style="text-align:center"> Total Amount (&#8377;) </th>

                    <th class="hidden-380" style="text-align:center"> Action </th>

                  </tr>

                </thead>

                <tbody id="invoices_disp">

                </tbody>

              </table>

            </div>

            <!-- END PAGE CONTENT --> 

            

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



let tab_asset_entry="";



load_purchase_orders();

load_vendor();

load_purchase();

load_types();

load_sub_types();



$( "div" ).mousemove(function( event ) {



	$(".expiry_date").datepicker({

	   format: 'dd-mm-yyyy'

   });



$(".mfg_date").datepicker({

	   format: 'dd-mm-yyyy'

   });





});



$( document ).ready(function() {

    $("#freeItem_qty").change(function(){

  		$("#freeItem_qty").attr("data-qty",$("#freeItem_qty").val());

	});

});



function load_purchase_orders(){

	$('#indent').empty();

	$('#indent').append($('<option/>', { 



					value: '',

					text : '-Select-' 



				}));

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=24',

			dataType: 'json',

			type: 'POST',

			success: function (data) {

			 $.each(data, function(index, element) {

			 	$('#indent').append($('<option/>', { 

					value: element.id,

					text : element.order_number+" "+element.date, 

				}));

		 	});

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

function load_purchase_order_data(){
if(tab_asset_entry!="") tab_asset_entry.destroy();
var data_details={
		"id": $("#indent").val()		
}

$.ajax({
            url: 'get_json_data_for_optical.php?flag=25',
			type: 'POST',
			data: data_details,
			success: function (data) {
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				$("#assets_body").html(data);
				var tds = $(data).find("input[type='hidden']");
				//var vender=$(data).find("data-vender").attr('data-vender');
				var vender=$('#assets_body').children('tr:first').attr('data-vender');
				//console.log(vender);
				$("#vendor_name").val(vender);



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

function del(id){



	$("#"+id).remove();

	icount--;

	calculate(id);



}

function edit(id){



$.ajax({

            url: 'get_json_data_for_optical.php?flag=19',

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

				

				

			}

		});



}

let icount=1;

function add_indent(id,indent_id,indent_details_id,item_id,pur_batch){
	var src=$("#assets_indent_body").html();
	var tds = $(src).find("td[id='"+id+"_qty_qty']");
	//alert($("#"+id+"_qty").val());
	if(parseFloat($("#"+id+"_qty").val())>parseFloat($("#"+id+"_qty").attr("data-qty"))) alert("Order quantity must not exceed quanity indented1");
	//alert($("#"+id+"_qty").attr("data-qty"));
	//alert(tds.html());
	//alert($("#"+id+"_qty").val());
	if(typeof pur_batch === "undefined") pur_batch="";
	if(typeof tds.html() === "undefined"){ 	
	if(($("#"+id+"_qty").val()!="" || $("#"+id+"_qty").val()!=0) && (parseFloat($("#"+id+"_qty").val())<=parseFloat($("#"+id+"_qty").attr("data-qty"))) ){ 
		$("#assets_indent_body").append("<tr id='"+id+"' data-indent='"+indent_id+"' data-item-id='"+item_id+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+"_hsmcode'>"+$("#"+id+"_hsm_code").val()+"</span></td><td id='"+id+"_asset_name' >"+$("#"+id+"_asset").html()+"<br/>"+$("#"+id+"_gp").html()+"</td><td>"+$("#"+id+"_size").html()+"</td><td>"+$("#"+id+"_color").html()+"</td><td id='"+id+"_batch_no_batch_no' ><input type='text' id='"+id+"_batch_no' value='"+pur_batch+"' ><input type='hidden' id='"+id+"_gp_id' value='"+$("#"+id+"_gp_id").val()+"' /></td><td id='"+id+"_bar_code_td' ><input type='text' id='"+id+"_bar_code' value=''></td><td id='"+id+"_mfg_date_mfg_date' ><input type='text' id='"+id+"_mfg_date' class='mfg_date' ></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' id='"+id+"_expiry_date' class='expiry_date' ></td><td id='"+id+"_qty_qty' name='item_"+item_id+"[]' >"+$("#"+id+"_qty").val()+"</td><td><input type='text' value='0' id='"+id+"_rate' onchange='calculate(\""+id+"\")' ></td><td><input type='text' id='"+id+"_discount_rate' onblur='calculate(\""+id+"\")' size=5 value='0' ></td><td><input type='text' value='0' onblur='calculate(\""+id+"\")' id='"+id+"_discount_amount' size=5 ></td><td><input type='text' id='"+id+"_total_amount' value='0' ></td><td><span id='"+id+"_gstrate' size=5 >"+$("#"+id+"_gst_rate").val()+"</span></td><td><span id='"+id+"_gst_amount' size=5 ></span></td><td><span id='"+id+"_cgstrate' size=5 >"+$("#"+id+"_cgst_rate").val()+"</span></td><td><span id='"+id+"_cgst_amount' size=5 ></span></td><td><span id='"+id+"_sgstrate' >"+$("#"+id+"_sgst_rate").val()+"</span></td><td><span id='"+id+"_sgst_amount' ></span></td><td><span id='"+id+"_net_amount' ></span></td><td><input type='text' id='"+id+"_mrp' value='0' size='8' ></td><td><a href='javascript:;' onclick='del(\""+id+"\")'><i class='fa fa-trash'></i></a></td></tr>");
	$("#"+id+"_qty").val(parseFloat($("#"+id+"_qty").attr("data-qty"))-(parseFloat($("#"+id+"_qty").val())));
	}else $("#"+id+"_qty").val($("#"+id+"_qty").attr("data-qty"));
	}else{
	   //Code for same item different batch
		if(confirm("Is the item from the same batch?")){
			if((parseFloat($("#"+id+"_qty").val())+parseFloat(tds.html()))>$("#"+id+"_qty").attr("data-qty")) alert("Order quantity must not exceed quanity indented");
			else{
			 let qty_added=tds.html();
			 $("#"+id+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));
			 $("#"+id+"_qty").val(parseFloat($("#"+id+"_qty").attr("data-qty"))-(parseFloat($("#"+id+"_qty").val())+parseFloat(qty_added)));
			}
		}else{
			$("#assets_indent_body").append("<tr id='"+id+icount+"' data-indent='"+indent_id+"' data-item-id='"+item_id+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+icount+"_hsmcode'>"+$("#"+id+"_hsm_code").val()+"</span></td><td id='"+id+icount+"_asset_name' >"+$("#"+id+"_asset").html()+"</td><td>"+$("#"+id+icount+"_size").html()+"</td><td>"+$("#"+id+"_color").html()+"</td><td id='"+id+icount+"_batch_no_batch_no' ><input type='text' id='"+id+icount+"_batch_no' ></td><td id='"+id+icount+"_bar_code_td' ><input type='text' id='"+id+icount+"_bar_code' ></td><td id='"+id+icount+"_mfg_date_mfg_date' ><input type='text' id='"+id+icount+"_mfg_date' class='mfg_date' ></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' id='"+id+"_expiry_date' class='expiry_date' ></td><td id='"+id+icount+"_qty_qty' name='item_"+item_id+"[]' >"+$("#"+id+"_qty").val()+"</td><td><input type='text' value='0' id='"+id+icount+"_rate' onchange='calculate(\""+id+icount+"\")' ></td><td><input type='text' id='"+id+icount+"_discount_rate' onblur='calculate(\""+id+icount+"\")' size=5 value='0' ></td><td><input type='text' value='0' onblur='calculate(\""+id+icount+"\")' id='"+id+icount+"_discount_amount' size=5 ></td><td><input type='text' id='"+id+icount+"_total_amount' value='0' ></td><td><span id='"+id+icount+"_gstrate' size=5 >"+$("#"+id+"_gst_rate").val()+"</span></td><td><span id='"+id+icount+"_gst_amount' size=5 ></span></td><td><span id='"+id+icount+"_cgstrate' size=5 >"+$("#"+id+"_cgst_rate").val()+"</span></td><td><span id='"+id+icount+"_cgst_amount' size=5 ></span></td><td><span id='"+id+icount+"_sgstrate' >"+$("#"+id+"_sgst_rate").val()+"</span></td><td><span id='"+id+icount+"_sgst_amount' ></span></td><td><span id='"+id+icount+"_net_amount' ></span></td><td><input type='text' id='"+id+icount+"_mrp' value='0' size='8' ></td><td><a href='javascript:;' onclick='del(\""+id+icount+"\")'><i class='fa fa-trash'></i></a></td></tr>");
			var tds1 = $(src).find("td[id='"+id+(icount-1)+"_qty_qty']");
			let qty_added=tds.html();
			let qty_added1=tds1.html();
			let same_prod_total=0;
			console.log("Qty Added:"+qty_added);
			console.log("Qty Added1:"+qty_added1);
			/*for(ii=icount;ii>0;ii--){
				if(typeof $("#"+id+ii+"_qty_qty").html() != "undifined"){
					same_prod_total=same_prod_total+parseInt($("#"+id+ii+"_qty_qty").html());
				}
			}*/
			$("td[name^='item_"+item_id+"'").each(function(){
			  same_prod_total=same_prod_total+parseInt($(this).html());
			});
			console.log("Same Product Total:"+same_prod_total);
			if(typeof tds1.html() === "undefined"){ 
				$("#"+id+"_qty").val(parseFloat($("#"+id+"_qty").attr("data-qty"))-(parseFloat($("#"+id+"_qty").val())+parseFloat(qty_added)));
			}else{
				$("#"+id+"_qty").val(parseFloat($("#"+id+"_qty").attr("data-qty"))-(same_prod_total));
			}
			icount++;
		}
	 }
}

function add_indent_free(id,indent_id,indent_details_id,item_id){



	var src=$("#assets_indent_body").html();

	

	//alert($("#"+id+"_qty").val());

	

	//if(parseFloat($("#"+id+"_qty").val())>parseFloat($("#"+id+"_qty").attr("data-qty"))) alert("Order quantity must not exceed quanity indented1");

	

	//alert($("#"+id+"_qty").attr("data-qty"));

	//alert(tds.html());

	//alert($("#"+id+"_qty").val());

	let item_val=$("#item").val().split("^");

	

	var tds = $(src).find("td[id='"+id+item_val[0]+"_qty_qty']");

	

	

	console.log("HSMCODE"+item_val[1]);

	

	if(typeof tds.html() === "undefined"){ 

	

	

		$("#assets_indent_body").append("<tr style='background:#59C28E' id='"+id+item_val[0]+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+"_asset_name' >"+$("#item :selected").text()+"</td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+"_batch_no' ></td><td id='"+id+"_mfg_date_mfg_date' ><input type='text' id='"+id+item_val[0]+"_mfg_date' class='mfg_date' ></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' id='"+id+item_val[0]+"_expiry_date' class='expiry_date' ></td><td id='"+id+item_val[0]+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><input type='text' value='0' id='"+id+item_val[0]+"_rate' readonly ></td><td><input type='text' id='"+id+item_val[0]+"_discount_rate'  size=5 value='0' ></td><td><input type='text' value='0' readonly id='"+id+item_val[0]+"_discount_amount' size=5 ></td><td><input type='text' readonly id='"+id+item_val[0]+"_total_amount' value='0' ></td><td><span id='"+id+item_val[0]+"_gstrate' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_gst_amount' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_cgstrate' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_cgst_amount' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_sgstrate' >0</span></td><td><span id='"+id+item_val[0]+"_sgst_amount' >0</span></td><td><span id='"+id+item_val[0]+"_net_amount' >0</span></td><td><input type='text' id='"+id+item_val[0]+"_mrp' value='0' size='8' ></td><td><a href='javascript:;' onclick='del(\""+id+"\")'><i class='fa fa-trash'></i></a></td></tr>");

	

	$("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())));

	

	

	

	}else{

	 	//if((parseFloat($("#"+id+"_qty").val())+parseFloat(tds.html()))>$("#"+id+"_qty").attr("data-qty")) alert("Order quantity must not exceed quanity indented");

	 	//else{

		

		 let qty_added=tds.html();

		 //alert(tds.html());

		 $("#"+id+item_val[0]+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));

		 $("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())+parseFloat(qty_added)));

	

	 	//}

	 }

}

function save_purchase(flag=0){
	//alert(trs.id);
	if($("#vendor_name").val()==""){
		alert("Please choose a vendor");
		return false;
	}
	//$("#save_purchase").attr('disabled','disabled');
	//$("#save_purchase_print").attr('disabled','disabled');
	let purchase_id=[];

	let purchase_details_id=[];

	let ids=[];

	let qty=[];

	let batch_no=[];

	let expiry_date=[];

	let mfg_date=[];

	let rate=[];

	let gp_id=[];

	let disc_rate=[];

	let disc_amount=[];

	let gst_rate=[];

	let gst_amount=[];

	let cgst_rate=[];

	let cgst_amount=[];

	let sgst_rate=[];

	let sgst_amount=[];

	let total_amount=[];

	let mrp=[];

	let asset_name=[];
	let bar_code=[];

	let i=0;

	let return_flag=0;

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){

  		console.log( index + ": " + $( this ).attr('id') );

		purchase_id[i]=$( this ).attr('data-indent');

		purchase_details_id[i]=$( this ).attr('data-details-indent');

		ids[i]=$( this ).attr('data-item-id');

		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();

		batch_no[i]=$("#"+$( this ).attr('id')+"_batch_no").val();

		expiry_date[i]=$("#"+$( this ).attr('id')+"_expiry_date").val();

		mfg_date[i]=$("#"+$( this ).attr('id')+"_mfg_date").val();

		rate[i]=$("#"+$( this ).attr('id')+"_rate").val();

		gp_id[i]=$("#"+$( this ).attr('id')+"_gp_id").val();

		disc_rate[i]=$("#"+$( this ).attr('id')+"_discount_rate").val();

		disc_amount[i]=$("#"+$( this ).attr('id')+"_discount_amount").val();

		gst_rate[i]=$("#"+$( this ).attr('id')+"_gstrate").html();

		gst_amount[i]=$("#"+$( this ).attr('id')+"_gst_amount").html();

		cgst_rate[i]=$("#"+$( this ).attr('id')+"_cgstrate").html();

		cgst_amount[i]=$("#"+$( this ).attr('id')+"_cgst_amount").html();

		sgst_rate[i]=$("#"+$( this ).attr('id')+"_sgstrate").html();

		sgst_amount[i]=$("#"+$( this ).attr('id')+"_sgst_amount").html();

		total_amount[i]=$("#"+$( this ).attr('id')+"_total_amount").val();

		mrp[i]=$("#"+$( this ).attr('id')+"_mrp").val();

		//alert($("#"+$( this ).attr('id')+"_total_amount").val());

		asset_name[i]=$("#"+$( this ).attr('id')+"_asset_name").html();
		bar_code[i]=$("#"+$( this ).attr('id')+"_bar_code").val();

		console.log("MRP::"+$("#"+$( this ).attr('id')+"_mrp").val());

		if($("#"+$( this ).attr('id')+"_mrp").val()==0){

			alert("MRP must be entered");

			return_flag=1;

			return false;

			

		}

		

		i++;

});

	if(return_flag==1) return false;

	var data_details={

		"purchase_id" : purchase_id,

		"purchase_details_id" : purchase_details_id,

		"id" : ids,

		"qty" : qty,

		"batch_no" : batch_no,

		"mfg_date" : mfg_date,

		"expiry_date" : expiry_date,

		"rate" : rate,

		"total_amount" : total_amount,

		"grand_total" : $("#net_total_").html(),

		"asset_name" : asset_name,

		"vendor_name" : $("#vendor_name option:selected").text(),

		"vendor_id" : $("#vendor_name").val(),

		"disc_rate" : disc_rate,

		"disc_amount" : disc_amount,

		"gst_rate" : gst_rate,

		"gst_amount" : gst_amount,

		"cgst_rate" : cgst_rate,

		"cgst_amount" : cgst_amount,

		"sgst_rate" : sgst_rate,

		"sgst_amount" : sgst_amount,

		"gp_id" : gp_id,

		"total_cgst_amount" : $("#CGST_amount_").html(),

		"total_sgst_amount" : $("#SGST_amount_").html(),

		"mrp" : mrp,
		"bar_code" : bar_code

		

	}

	

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=26',

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

				

				if(flag==1) window.open("purchase_invoice_print.php?inv_id="+data.p_id);

				

				setTimeout(function(){ location.reload(); }, 2000);	

			}

			

		});



}

let invoices="";

function load_purchase(){



	//alert("Into It");



	$.ajax({

	

		url: 'get_json_data_for_optical.php?flag=27',

			type: 'POST',

			success: function (data) {

			

				//console.log(data.confirm_flag);

				//alert("data");	

				//alert(data.flag);

				$("#invoices_disp").html(data);

				invoices=$("#invoices").DataTable( {

					/*order: [[1, 'desc'], [0, 'desc']],*/

					"aaSorting": [],

					"destroy": true,

					dom: 'Bfrtip',

					"pageLength": 15,

				

				} );

				//load_asset_entry_data();

				//if(data.flag=="1") toastr.success('Order Saved Successfully');

				//else toastr.error('Unable to save order');

				

			}

	

	});



}



function calculate(id){

	//alert($("#"+id+"_rate").val());

	//alert(id);

	let total=0;

	let cgst=0;

	let sgst=0;

	let net_total=0;

	console.log(($("#"+id+"_rate").val())*($("#"+id+"_qty_qty").html()));

	console.log("Discount Rate::"+$("#"+id+"_discount_rate").val());

	$("#"+id+"_total_amount").val(($("#"+id+"_rate").val())*($("#"+id+"_qty_qty").html()));

	let disc_amount=($("#"+id+"_discount_rate").val()!=0 || $("#"+id+"_discount_rate").val()!="" ) ? $("#"+id+"_total_amount").val()*($("#"+id+"_discount_rate").val()/100) : $("#"+id+"_discount_amount").val();

	console.log(disc_amount);

	$("#"+id+"_discount_amount").val(disc_amount);

	$("#"+id+"_total_amount").val($("#"+id+"_total_amount").val()-disc_amount); 

	$("#"+id+"_gst_amount").html($("#"+id+"_total_amount").val()*($("#"+id+"_gstrate").html()/100));

	$("#"+id+"_cgst_amount").html($("#"+id+"_total_amount").val()*($("#"+id+"_cgstrate").html()/100));

	$("#"+id+"_sgst_amount").html($("#"+id+"_total_amount").val()*($("#"+id+"_sgstrate").html()/100));

	$("#"+id+"_net_amount").html(parseFloat($("#"+id+"_total_amount").val())+parseFloat($("#"+id+"_gst_amount").html()));

	$("#"+id+"_net_amount").html(parseFloat($("#"+id+"_total_amount").val())+parseFloat($("#"+id+"_gst_amount").html()));

	

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){

	

		total=parseFloat(total)+parseFloat($("#"+$( this ).attr('id')+"_total_amount").val());

		cgst=parseFloat(cgst)+parseFloat($("#"+$( this ).attr('id')+"_cgst_amount").html());

		sgst=parseFloat(sgst)+parseFloat($("#"+$( this ).attr('id')+"_sgst_amount").html());

		net_total=total+cgst+sgst;

		

	});

	Math.round(net_total);

	$("#total_amount").html(total);

	$("#CGST_amount_").html(cgst);

	$("#SGST_amount_").html(sgst);

	$("#net_total_").html(net_total);

}



function data_reset(){



	$("#assets_indent_body").html("");

	$("#indent").val('');

	$("#vendor_name").val('');

	load_purchase();



}



function load_asset_entry_data(){



$('#item').empty();



var data_details={

		"id": $("#id").val(),

		"dept_name": $("#dept_name").val(),

		"type_name": $("#type_name").val(),

		"sub_type_name": $("#sub_type_name").val(),

		"location_name": $("#location_name :selected").text(),

		"location_id": $("#location_name").val(),

		

}



$.ajax({

            url: 'get_json_data_for_optical.php?flag=41',

			type: 'POST',

			dataType: 'json',

			data: data_details,

			success: function (data) {

				$.each(data, function(index, element) {

			 	$('#item').append($('<option/>', { 



					value: element.id,

					text : element.text 



				}));

		 	});

				

			}

		});



}



function del_invoice(id){



	if(!confirm("Are you sure you want to delete it?")){

		return false;

	}

	

	var data_details={

		"inv_id":id

	}



	$.ajax({

            url: 'get_json_data_for_optical.php?flag=52',

			type: 'POST',

			dataType: 'json',

			data: data_details,

			success: function (data) {

				

				if(data.flag=="1") toastr.success("Deleted Successfully");

				else toastr.error("Unable to delete");

				

				load_purchase();

				

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

function load_item(){



	$('#item').empty();

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

			 	$('#item').append($('<option/>', { 

					value: element.id,

					text : element.text 

				}));

		 	});

			 }

		  });

}

</script>

</body>

<!-- END BODY -->

</html>