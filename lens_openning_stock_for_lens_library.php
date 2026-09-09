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
      <?php

  	include("lens_menu_for_lens_library.php");

  ?>
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-17)));?></span></div>
            </div>
            
            <!-- BEGIN FORM--> 
            
          </div>
          
          <!-- END PAGE CONTENT INNER --> 
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label>Choose Vendor</label>
          <select class="form-control" id="vendor_name">
          </select>
        </div>
      </div>
      <br/>
      <br/>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">Type</label>
              <select class="form-control" id="type_name" onChange="load_sub_types();">
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="">Sub Type</label>
              <select class="form-control" id="sub_type_name" onChange="load_item()">
                <option value="">Level 1</option>
                <option value="">Level 2</option>
                <option value="">Other</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="">Item</label>
              <select class="form-control item" id="item" >
              </select>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label for="">Quantity</label>
              <input type="text" id="freeItem_qty" class="form-control" data-qty="" />
              <span id='stock_qty' style="font-weight:bold"></span> </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="">Batch Code</label>
              <input type="text" id="batch_code_val" class="form-control" data-qty="" />
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="">Bar Code</label>
              <input type="text" id="bar_code_val" class="form-control" data-qty="" />
            </div>
          </div>
          <div class="col-md-1" style="margin-top:25px">
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
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Sl No. </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Lens Name </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Batch No. </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Bar Code. </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Mfg. Date </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Expiry Date </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
              </tr>
            </thead>
            <tbody id="assets_indent_body">
            </tbody>
            <tfoot>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="6" align="right">Total</td>
                <td><span id="total_qty"></span></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-md-12" style="text-align:center; margin-bottom:10px">
          <input type="button" class="btn" onClick="save_sales()" value="Save" style="background:#000099;color:#FFFFFF;width:120px" />
        </div>
        <div style="clear:both; height:15px">&nbsp;</div>
        <table class="table table-striped table-bordered table-hover small" id="full_tab_details">
          <caption>
          Full Order Details <strong style="float:right;display:flex;line-height:34px;">Search:&nbsp;&nbsp;
          <input type="text" class="form-control" name="search" id="search" value="" style="width:100%;"/>
          </strong>
          </caption>
          <thead>
            <tr>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Asset Name</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Qty</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Bar Code</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Batch</span></th>
              <th class="draggable" data-column="category_name" style="cursor: move;"><span>Vendor</span></th>
              <th class="draggable" data-column="sub_cat"><span>Manufacturing Date</span></th>
              <th class="draggable right" data-column="qty" style="cursor: move;"><span>Expiry Date</span></th>
            </tr>
          </thead>
          <tbody id="tab_po_body">
          </tbody>
        </table>
        <?php 
                $sql_="select * from `lens_opening_stock_for_lens_library`";
                $result=mysqli_query($conn,$sql_);
                $count=$result->num_rows;  
                $count_limit=ceil($count / $limit);
                echo '<div class="col-md-6" style="float:right;text-align:right;">';
                for ($page_number = 1; $page_number <=$count_limit; $page_number++) {
                  echo '<a href="javascript:void(0);" class="btn btn-primary" onClick="load_sale_order_details('.$page_number.')">'.$page_number.'</a>';
                }
                echo '</div>';
                ?>
        <input type="hidden" name="row_limit" id="row_limit" value="<?php echo $limit?>">
      </div>
      
      <!-- END PAGE CONTENT --> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTAINER --> 
  
</div>
<?php include("footer_for_optical.php"); ?>
<script>



let tab_asset_entry="";

load_vendor();
load_types();
var cou_pag_no=0;
load_sale_order_details(cou_pag_no);
$('#item_id').select2();
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

	

	$('#item').select2();

	$('#doctors').select2();

	

	$("#item").live('change', function(){

  		$("#freeItem_qty").focus();

	});

  $("#search").on("keyup", function() {
		  var value = $(this).val().toLowerCase();
		  $("#tab_po_body tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		  });
		});

});



function add_item(){

	//alert($("#batch_code_val").find(":selected").val());

	//if(search_code($("#batch_code_val").find(":selected").val())==true){

	if($("#freeItem_qty").val()=="" || $("#freeItem_qty").val()<=0){

		alert("Please enter a valid quanity");

		return;

	}

	

	if($("#batch_code_val").val()==""){

		alert("Please enter a batch code");

		return;

	}

	

	if($("#item").val()==""){

		alert("Item cannot be blank");

		return;	

	}

	

	add_indent_free('freeItem','freeindent','freeIndent_details',$("#batch_code_val").value);

	



}



function load_vendor(){

	$('#vendor_name').empty();

	$.ajax({

            url: 'get_json_data_for_lens_library.php?flag=11',

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



function del(id){



	$("#"+id).remove();

	calculate(id);

	slno=1;

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){

	

		total_qty=$("#"+$( this ).attr('id')+"_hsmcode").html(slno);

		slno++;

	});



}



let slno=0;

let mrp=0;

let mrp_=0;

let expiry_date="";

function add_indent_free(id,indent_id,indent_details_id,item_id){



	var src=$("#assets_indent_body").html();

	if(parseInt($("#stock_qty").html())<parseInt($("#freeItem_qty").val())){

		alert("Quantity not in stock");

		return false;

	}

	

	let item_val=$("#item").val().split("^");

	

	var batch_=$("#batch_code_val").val().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');

	var tds = $(src).find("td[id='"+id+item_val[0]+batch_+"_qty_qty']");

	

	if(typeof tds.html() === "undefined"){ 

	slno=parseInt(slno+1);

		$("#assets_indent_body").append("<tr id='"+id+item_val[0]+batch_+"' data-mrp='"+mrp_+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+batch_+"_hsmcode'>"+slno+"</span></td><td id='"+id+item_val[0]+batch_+"_asset_name' >"+$("#item :selected").text()+"</td><td id='"+id+item_val[0]+batch_+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+batch_+"_batch_no' class='form-control' value='"+$("#batch_code_val").val()+"' ></td><td id='"+id+item_val[0]+batch_+"_bar_code_no' ><input type='text' id='"+id+item_val[0]+batch_+"_bar_code' class='form-control' value='"+$("#bar_code_val").val()+"' ></td><td id='"+id+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+batch_+"_mfg_date' class='mfg_date' ></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+batch_+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ></td><td id='"+id+item_val[0]+batch_+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+batch_+"\")'><i class='fa fa-trash'></i></a></td></tr>");

	

	//$("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())));

	calculate(id+item_val[0]+batch_);

	

	

	}else{

		 let qty_added=tds.html();

		 $("#"+id+item_val[0]+batch_+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));

		 calculate(id+item_val[0]);

	 }

}



function save_sales(flag=0){



	//let doc=$("#doctors").select2('data');

	if($('#vendor_name').val()==''){

	alert('Please Choose Vendor!..');	

	return false;

	}

		

	let ids=[];

	let qty=[];

	let batch_no=[];

	let expiry_date=[];

	let mfg_date=[];

	let asset_name=[];
	let bar_code=[];

	let i=0;

	let return_flag=0;

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){

  		console.log( index + ": " + $( this ).attr('id') );

		//alert($("#"+$( this ).attr('id')+"_batch_no").val());

		//return;

		//purchase_id[i]=$( this ).attr('data-indent');

		//purchase_details_id[i]=$( this ).attr('data-details-indent');

		ids[i]=$( this ).attr('data-item-id');

		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();

		batch_no[i]=$("#"+$( this ).attr('id')+"_batch_no").val();
		bar_code[i]=$("#"+$( this ).attr('id')+"_bar_code").val();

		expiry_date[i]=$("#"+$( this ).attr('id')+"_expiry_date").val();

		mfg_date[i]=$("#"+$( this ).attr('id')+"_mfg_date").val();

		asset_name[i]=$("#"+$( this ).attr('id')+"_asset_name").html();

		

		

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
		"bar_code" : bar_code,

		"mfg_date" : mfg_date,

		"expiry_date" : expiry_date,

		"asset_name" : asset_name,

		"vendor_id"	:	$("#vendor_name :selected").val()

	}

	

	$.ajax({

            url: 'get_json_data_for_lens_library.php?flag=52',

			type: 'POST',

			dataType: 'json',

			data: data_details,

			success: function (data) {

			

				//console.log(data.confirm_flag);

				//alert("data");	

				//alert(data.flag);

				//load_asset_entry_data();

				if(data.flag=="1"){

				 	toastr.success('Lens Received Successfully');

				}else{

				

				 	if(data.reason!="") toastr.error(data.reason);

				 	else toastr.error('Unable to save data');

				}

				

				//if(flag==1) window.open("stock_transfer_print.php?inv_id="+data.s_id);

				

				setTimeout(function(){ location.reload(); }, 2000);	

			}

			

		});



}

let invoices="";

let total_discount=0;



function calculate(id){

	let total_qty=0;

	

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){

	

		total_qty=parseInt(total_qty)+parseInt($("#"+$( this ).attr('id')+"_qty_qty").html());

		

	});

	$("#total_qty").html(parseInt(total_qty));

	

	console.log("Total Qty: "+$("#"+$( this ).attr('id')+"_qty_qty").html());

	

}



function data_reset(){
	$("#assets_indent_body").html("");
	$("#indent").val('');
	$("#vendor_name").val('');
}



function load_types(id){

	

	$('#type_name').empty();



	$.ajax({



            url: 'get_json_data_for_lens_library.php?flag=5',

			dataType: 'json',

			type: 'POST',

			success: function (data) {

			

			 $.each(data, function(index, element) {

				 if(element.text=='Lens' || element.text=='LENS'){

			 	$('#type_name').append($('<option/>', { 



					value: element.id,

					text : element.text 



				}));

				 }

		 	});

			

			document.getElementById("type_name").onchange();

			load_item();

			 }



		  });

	

	

}
function load_sub_types(type_id,id){

	//load_item();

	$('#sub_type_name').empty();

	//alert($('#type_name').val());

	if(type_id=='' || typeof type_id === "undefined"){

		//alert('san'+type_id_);

		var type_id_=$('#type_name').val();

	}else{

		//alert('san2'+type_id_);

		var type_id_=type_id;

	}


	

	$.ajax({



            url: 'get_json_data_for_lens_library.php?flag=6',

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

            url: 'get_json_data_for_lens_library.php?flag=17',

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

		  });}

function load_doctors(id){

//alert(id);

	$('#doctors').empty();

	$.ajax({

            url: 'get_json_data_for_lens_library.php?flag=35',

			dataType: 'json',

			type: 'POST',

			success: function (data) {

			 $.each(data, function(index, element) {

			 	$('#doctors').append($('<option/>', { 

					value: element.id,

					text : element.text 

				}));

		 	});

			if(id!="")	$("#doctors").select2("val", id);

			 }

		  });}
function calculate_payment(){
	let cash=$("#cash").val();
	let card=$("#card").val();
	let upi=$("#UPI").val();
	let bal=$("#net_total_").html();
	let fbal=parseFloat(bal)-(parseFloat(cash)+parseFloat(card)+parseFloat(upi));
	$("#bal").html(fbal);
}
function load_sale_order_details(cou_pag_no){
	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;
	var data_details={
		"initial_page": initial_page,
		"limit": <?php echo $limit;?>
	}
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=53',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				var html='';
				 $.each(data, function(index, element) {
					html +='<tr><td>'+element.name+'</td><td>'+element.qty+'</td><td>'+element.bar_code+'</td><td>'+element.batch+'</td><td>'+element.vendor_id+'</td><td>'+element.manufacturing_date+'</td><td>'+element.expiry_date+'</td></tr>';
				});
				$('#tab_po_body').html(html);
			 }
		  });

}
</script>
</body>
<!-- END BODY -->

</html>