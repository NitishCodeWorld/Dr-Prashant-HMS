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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Department Transfer</span></div>
            </div>
            <!-- BEGIN FORM--> 
            
          </div>
          <div class="portlet" style="min-height:50px; margin-bottom:0px">
            <div class="portlet-body">
              <div class="col-md-2" style="padding-left:0px; padding-right:2px">
                <label>Choose Department:</label>
                <select id="dept_name" name="dept_name" class="form-control" >
                </select>
              </div>
              <div style="clear:both"></div>
            </div>
          </div>
          <div style="clear:both; margin-top:35px"></div>
          <!-- END PAGE CONTENT INNER --> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
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
              <select class="form-control" id="sub_type_name" onChange="load_asset_entry_data()">
                <option value="">Level 1</option>
                <option value="">Level 2</option>
                <option value="">Other</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="">Item</label>
              <select class="form-control item" id="item" onChange="load_batch_codes()" >
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="">Batch Code</label>
              <!--<input type="text" id="batch_code_val" class="form-control" data-qty="" />-->
              <select id="batch_code_val" class="form-control" onChange="load_stock();load_expiry_date();">
              </select>
              <span id='batch_expiry' style="font-weight:bold;color:#903;"></span>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label for="">Quantity</label>
              <input type="text" id="freeItem_qty" class="form-control" data-qty="" />
              <span id='stock_qty' style="font-weight:bold"></span> </div>
          </div>
          
          <div class="col-md-2" style="margin-top:25px">
            <button class="btn green" onClick="add_item()">Add Item</button>
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
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Covid Item </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Batch No. </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Mfg. Date </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Expiry Date </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <th class="draggable right" data-column="rate" style="cursor: move;"><span>Rate </span></th>
                <th class="draggable right" data-column="rate" style="cursor: move;"><span>Amount </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
              </tr>
            </thead>
            <tbody id="assets_indent_body">
            </tbody>
            <tfoot>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="10" align="right">Total</td>
                <td><span id="total_amount"></span></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-md-12" style="text-align:center; margin-bottom:10px">
          <input type="button" class="btn" onClick="save_sales()" value="Save Transfer" style="background:#000099;color:#FFFFFF;width:120px" />
          &nbsp;&nbsp;
          <input type="button" class="btn" onClick="save_sales(1)" value="Save & Print" style="background:#000099;color:#FFFFFF;width:120px" />
        </div>
        <div style="clear:both; height:15px">&nbsp;</div>
        <table class="table table-bordered table-striped" id="invoices" role="grid" aria-describedby="product_list_info">
          <thead>
            <tr>
              <th class="hidden-380" style="text-align:center"> Sl No </th>
              <th class="hidden-380" style="text-align:center"> Invoice Number </th>
              <th class="hidden-380" style="text-align:center"> Invoice Date </th>
              <th class="hidden-380" style="text-align:center"> Transferred to Dept </th>
              <th class="hidden-380" style="text-align:center"> Total Amount (&#8377;) </th>
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

var tab_asset_entry="";

load_departments();
load_vendor();
load_purchase();
load_types();
load_sub_types();
let mrp=0;
let mrp_=0;
let expiry_date="";
load_doctors();
let uhid="";

$( "div" ).mousemove(function( event ) {

	$(".expiry_date").datepicker({
	   format: 'dd-mm-yyyy'
   });

$(".mfg_date").datepicker({
	   format: 'dd-mm-yyyy'
   });


});
$("#inv_date").datepicker({
	   format: 'dd-mm-yyyy'
   });


$( document ).ready(function() {
    $("#freeItem_qty").change(function(){
  		$("#freeItem_qty").attr("data-qty",$("#freeItem_qty").val());
	});
	
	$("#freeItem_qty").keypress(function(event){
		if ( event.which == 13 ) {
			$("#batch_code_val").focus();
  			//add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value);
		}
	});
	
	$("#batch_code_val").keypress(function(event){
		
		if ( event.which == 13 ) {
			//console.log(search_code($(this).val()));
			add_item();
		}
	
	});
	
	$("#uhid").keypress(function(event){
		
		if ( event.which == 13 ) {
			//console.log(search_code($(this).val()));
			get_patient_details();
		}
	
	});
	
	
	$('#item').select2();
	$('#doctors').select2();
	
	$("#item").live('change', function(){
  		$("#freeItem_qty").focus();
	});
  
});

function add_item(){
	//alert($("#batch_code_val").find(":selected").val());
	if(search_code($("#batch_code_val").find(":selected").val())==true){
		add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value);
	}else{
		alert("Batch does not exist.");
	}

}

function load_vendor(){
	
	$('#vendor_name').empty();
	
	$('#vendor_name').append($('<option/>', { 

					value: '',
					text : '-Select-' 

				}));

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


function load_purchase_order_data(){
if(tab_asset_entry!="") tab_asset_entry.destroy();


var data_details={
		"id": $("#indent").val()		
}

$.ajax({
            url: 'get_json_data_inventory.php?flag=27',
			type: 'POST',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				$("#assets_body").html(data);
				var tds = $(data).find("input[type='hidden']");
				//alert(tds.val());
				$("#vendor_name").val(tds.val());

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
	calculate(id);

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
var icount=1;
function add_indent_free(id,indent_id,indent_details_id,item_id){

	var src=$("#assets_indent_body").html();
	
	//alert($("#"+id+"_qty").val());
	
	//if(parseFloat($("#"+id+"_qty").val())>parseFloat($("#"+id+"_qty").attr("data-qty"))) alert("Order quantity must not exceed quanity indented1");
	
	//alert($("#"+id+"_qty").attr("data-qty"));
	//alert(tds.html());
	//alert($("#"+id+"_qty").val());
	//alert($("#item").val());
	
	if(parseInt($("#stock_qty").html())<parseInt($("#freeItem_qty").val())){
		alert("Quantity not in stock");
		return false;
	}
	
	let item_val=$("#item").val().split("^");
	
	var tds = $(src).find("td[id='"+id+item_val[0]+"_qty_qty']");
	
	
	console.log("HSMCODE"+item_val[1]);
	
	//let gst=item_val[5];
	
	
	
	if(typeof tds.html() === "undefined"){ 
	
	
		$("#assets_indent_body").append("<tr id='"+id+item_val[0]+"' data-mrp='"+mrp_+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+"_asset_name' >"+$("#item :selected").text()+"</td><td>"+item_val[2]+"</td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+"_batch_no' style='width:80px' value='"+$("#batch_code_val").val()+"' ></td><td id='"+id+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+"_mfg_date' class='mfg_date' value='"+mfg_date+"' ></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ></td><td id='"+id+item_val[0]+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><input style='width:80px' type='text' value='"+mrp+"' id='"+id+item_val[0]+"_rate' onblur='calculate(\""+id+item_val[0]+"\")'  ></td><td><input type='text' id='"+id+item_val[0]+"_total_amount'  style='width:80px' value='"+(mrp*$("#"+id+"_qty").val())+"' ></td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+"\")'><i class='fa fa-trash'></i></a></td></tr>");
	
	$("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())));
	calculate(id+item_val[0]);
	
	
	}else{
	 	//if((parseFloat($("#"+id+"_qty").val())+parseFloat(tds.html()))>$("#"+id+"_qty").attr("data-qty")) alert("Order quantity must not exceed quanity indented");
	 	//else{
		if(confirm("Is the item from the same batch?")){
			
			var batch_flag=0;
			if($("#freeItem"+id+item_val[0]+"_batch_no").val()==batch_code_val){
				batch_flag=0;
			}else{
			var sl=1;
			while(sl<icount){				
				if($("#"+id+item_val[0]+sl+"_batch_no").val()==batch_code_val){					
					batch_flag=1;
					var macth_bacth=sl;
				}
				sl=parseInt(sl)+1;
			}			
			}		
			
			if(batch_flag==0){
				 var qty_added=tds.html();		 
				 $("#"+id+item_val[0]+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));
				 $("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())+parseFloat(qty_added)));
				 calculate(id+item_val[0]);				
			}else{			
			var tds = $(src).find("td[id='"+id+item_val[0]+macth_bacth+"_qty_qty']");			
			var qty_added=tds.html();		
		 $("#"+id+item_val[0]+macth_bacth+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));
		 $("#"+id+item_val[0]+macth_bacth+"_qty").val(parseFloat($("#"+id+item_val[0]+macth_bacth+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+macth_bacth+"_qty").val())+parseFloat(qty_added)));
		 calculate(id+item_val[0]+macth_bacth);	
			}
		}else{
			$("#assets_indent_body").append("<tr id='"+id+item_val[0]+icount+"' data-mrp='"+mrp_+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+icount+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+icount+"_asset_name' >"+$("#item :selected").text()+"</td><td>"+item_val[2]+"</td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+icount+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+icount+"_batch_no' style='width:80px' value='"+$("#batch_code_val").val()+"' ></td><td id='"+id+icount+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+icount+"_mfg_date' class='mfg_date' value='"+mfg_date+"' ></td><td id='"+id+icount+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+icount+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ></td><td id='"+id+item_val[0]+icount+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><input style='width:80px' type='text' value='"+mrp+"' id='"+id+item_val[0]+icount+"_rate' onblur='calculate(\""+id+item_val[0]+"\")'  ></td><td><input type='text' id='"+id+item_val[0]+icount+"_total_amount'  style='width:80px' value='"+(mrp*$("#"+id+"_qty").val())+"' ></td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+"\")'><i class='fa fa-trash'></i></a></td></tr>");
	
	$("#"+id+item_val[0]+icount+"_qty").val(parseFloat($("#"+id+item_val[0]+icount+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+icount+"_qty").val())));
	calculate(id+item_val[0]+icount);
		
		icount++;
		}
		// let qty_added=tds.html();
//		 //alert(tds.html());
//		 $("#"+id+item_val[0]+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));
//		 $("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())+parseFloat(qty_added)));
//		 calculate(id+item_val[0]);
	 	//}
	 }
}

function save_sales(flag=0){

	//alert(trs.id);
	if(parseFloat($("#bal").html())<0){
		alert("Over paid");
		return false;
	}else if(parseFloat($("#bal").html())>0){
		alert("Under paid");
		return false;
	} 
	
	if($("#uhid").val()=="" || $("#customer_name").val()=="" ){
		alert("Please fill up patients details");
		$("#uhid").focus();
		return false;
	}
	
	let doc=$("#doctors").select2('data');
		
	let ids=[];
	let qty=[];
	let batch_no=[];
	let expiry_date=[];
	let mfg_date=[];
	let rate=[];
	let total_amount=[];
	let asset_name=[];
	let mrp=[];
	let i=0;
	let return_flag=0;
	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){
  		console.log( index + ": " + $( this ).attr('id') );
		//purchase_id[i]=$( this ).attr('data-indent');
		//purchase_details_id[i]=$( this ).attr('data-details-indent');
		ids[i]=$( this ).attr('data-item-id');
		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();
		batch_no[i]=$("#"+$( this ).attr('id')+"_batch_no").val();
		expiry_date[i]=$("#"+$( this ).attr('id')+"_expiry_date").val();
		mfg_date[i]=$("#"+$( this ).attr('id')+"_mfg_date").val();
		rate[i]=$("#"+$( this ).attr('id')+"_rate").val();
		total_amount[i]=$("#"+$( this ).attr('id')+"_total_amount").val();
		//mrp[i]=$("#"+$( this ).attr('id')+"_mrp").val();
		//alert($("#"+$( this ).attr('id')+"_total_amount").val());
		asset_name[i]=$("#"+$( this ).attr('id')+"_asset_name").html();
		mrp[i]=$( this ).attr('data-mrp');
		console.log("MRP::"+$("#"+$( this ).attr('id')+"_mrp").val());
		
		
		i++;
});

	let grand_total=$("#total_amount").html();

	if(return_flag==1) return false;
	var data_details={
		//"purchase_id" : purchase_id,
		//"purchase_details_id" : purchase_details_id,
		"id" : ids,
		"qty" : qty,
		"batch_no" : batch_no,
		"mfg_date" : mfg_date,
		"expiry_date" : expiry_date,
		"rate" : rate,
		"total_amount" : total_amount,
		"grand_total" : grand_total,
		"asset_name" : asset_name,
		"department_id" : $("#dept_name option:selected").val(),
		"inv_date": $("#inv_date").val(),
		"mrp" : mrp
		
	}
	
	$.ajax({
            url: 'get_json_data_inventory.php?flag=53',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data.flag);
				//load_asset_entry_data();
				if(data.flag=="1"){
				 	toastr.success('Order Saved Successfully');
				}else{
				
				 	if(data.reason!="") toastr.error(data.reason);
				 	else toastr.error('Unable to save order');
				}
				
				if(flag==1) window.open("stock_transfer_print.php?inv_id="+data.s_id);
				
				setTimeout(function(){ location.reload(); }, 2000);	
			}
			
		});

}
var invoices="";
function load_purchase(){

	//alert("Into It");

	$.ajax({
	
		url: 'get_json_data_inventory.php?flag=54',
			type: 'POST',
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data.flag);
				$("#invoices_disp").html(data);
				invoices=$("#invoices").DataTable( {
					order: [[0, 'desc']],
					"destroy": true,
					dom: 'Bfrtip',
					//"pageLength": 15,
				
				} );
				//load_asset_entry_data();
				//if(data.flag=="1") toastr.success('Order Saved Successfully');
				//else toastr.error('Unable to save order');
				
			}
	
	});

}
let total_discount=0;
function calculate(id){
	//alert($("#"+id+"_rate").val());
	//alert(id);
	let total=0;
	let cgst=0;
	let sgst=0;
	let net_total=0;
	$("#"+id+"_total_amount").val(parseFloat(($("#"+id+"_rate").val())*($("#"+id+"_qty_qty").html())).toFixed(2));
	
	//disc_amount=parseFloat(disc_amount).toFixed(2);
	//console.log(disc_amount);
	//$("#"+id+"_discount_amount").val(disc_amount);
	$("#"+id+"_total_amount").val(parseFloat($("#"+id+"_total_amount").val())); 
	//$("#"+id+"_gst_amount").html(parseFloat($("#"+id+"_total_amount").val()*($("#"+id+"_gstrate").html()/100)).toFixed(2));
	//$("#"+id+"_cgst_amount").html(parseFloat($("#"+id+"_total_amount").val()*($("#"+id+"_cgstrate").html()/100)).toFixed(2));
	//$("#"+id+"_sgst_amount").html(parseFloat($("#"+id+"_total_amount").val()*($("#"+id+"_sgstrate").html()/100)).toFixed(2));
	//$("#"+id+"_net_amount").html(parseFloat($("#"+id+"_total_amount").val())+parseFloat($("#"+id+"_gst_amount").html()));
	$("#"+id+"_net_amount").html(parseFloat($("#"+id+"_net_amount").html()).toFixed(2));
	//$("#"+id+"_net_amount").html(parseFloat($("#"+id+"_total_amount").val())+parseFloat($("#"+id+"_gst_amount").html()));
	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){
	
		total=parseFloat(total)+parseFloat($("#"+$( this ).attr('id')+"_total_amount").val());
		//cgst=parseFloat(cgst)+parseFloat($("#"+$( this ).attr('id')+"_cgst_amount").html());
		//sgst=parseFloat(sgst)+parseFloat($("#"+$( this ).attr('id')+"_sgst_amount").html());
		//net_total=total+cgst+sgst;
		
	});
	net_total=Math.round(net_total)
	$("#total_amount").html(parseFloat(total).toFixed(2));
	//$("#CGST_amount_").html(cgst);
	//$("#SGST_amount_").html(sgst);
	//$("#net_total_").html(net_total);
	//let cash=$("#cash").val();
	//let card=$("#card").val();
	//let upi=$("#UPI").val();
	//let bal=net_total-(parseFloat(cash)+parseFloat(card)+parseFloat(upi));
	//$("#bal").html(bal);
}

function data_reset(){

	$("#assets_indent_body").html("");
	$("#indent").val('');
	$("#vendor_name").val('');
	load_purchase();

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
			//$('#type_name').val("1");
			document.getElementById("type_name").options[1].selected = true;
			document.getElementById("type_name").onchange();
			//$('#type_name').change();
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


function load_asset_entry_data(){

$('#item').empty();

$('#item').append($('<option/>', { 

					value: '',
					text : '-Select-' 

				}));

var data_details={
		"id": $("#id").val(),
		"dept_name": $("#dept_name").val(),
		"type_name": $("#type_name").val(),
		"sub_type_name": $("#sub_type_name").val(),
		"location_name": $("#location_name :selected").text(),
		"location_id": $("#location_name").val(),
		
}

$.ajax({
            url: 'get_json_data_inventory.php?flag=41',
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
			
			$("#item").focus();
				
			}
		}); 

}

function search_code(code){
	//alert($("#item").find(":selected").val());
	let item_val=$("#item").find(":selected").val().split("^");
	let flag_=false;
	let data_details={
	"batch_code": code,
	"item_id": item_val[0] ,
	}
	
	$.ajax({
            url: 'get_json_data_inventory.php?flag=42',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			async: false, 
			success: function (data) {
			//alert(data.mrp);	
		 	mrp=data.rate;
			mrp_=data.mrp;
			expiry_date=data.expiry_date;
			mfg_date=data.mfg_date;
			
			if(mrp!=null){
				flag_=true;
			}
			//$("#item").focus();
				
			}
		});
			
		return flag_;
	
}

function calculate_payment(){

	let cash=$("#cash").val();
	let card=$("#card").val();
	let upi=$("#UPI").val();
	let bal=$("#net_total_").html();
	
	let fbal=parseFloat(bal)-(parseFloat(cash)+parseFloat(card)+parseFloat(upi));
	$("#bal").html(fbal);

}

function get_patient_details(){

	$("#customer_name").val('');
	$("#phone_number").val('');
	uhid="GLB-EYE/"+$("#uhid").val();
	$.ajax({
            url: 'get_json_data_inventory.php?flag=46',
			type: 'POST',
			dataType: 'json',
			data: "uhid="+uhid,
			async: false, 
			success: function (data) {
				
		 		$("#customer_name").val(data.customer_name);
				$("#phone_number").val(data.phone_number);
				let tmp=uhid.split('/');
				//alert(tmp[1]);
				//$("#doctors").val(tmp[1]);
				$("#doctors").select2("val", tmp[1]);
				
			}
		});

}

function load_batch_codes(){

	let item_val=$("#item").find(":selected").val().split("^");
	let item_id=item_val[0];
	$('#batch_code_val').empty();
	
	$.ajax({
            url: 'get_json_data_inventory.php?flag=47',
			type: 'POST',
			dataType: 'json',
			data: "item_id="+item_id,
			async: false, 
			success: function (data) {
				
		 		$.each(data, function(index, element) {
			 	$('#batch_code_val').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));				
		 	});
			
			load_stock();
			
				
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
function load_expiry_date(){
	$("#batch_expiry").html("");
	var item_val=$("#item").find(":selected").val().split("^");
	item_id=item_val[0];
	batch_code=$("#batch_code_val").find(":selected").val();
	if((item_id=='')||(batch_code=='')){
		return false;	
	}
	
	$.ajax({
            url: 'get_json_data_inventory.php?flag=73',
			type: 'POST',
			dataType: 'json',
			data: "item_id="+item_id+"&batch_code="+batch_code,
			async: false, 
			success: function (data) {			
		 		
				//alert(data.closing_stock);
					$("#batch_expiry").html("");
					$("#batch_expiry").html("Exp: "+data.expiry_date);	
				
				
			}
		});

}

</script>
</body>
<!-- END BODY -->
</html>