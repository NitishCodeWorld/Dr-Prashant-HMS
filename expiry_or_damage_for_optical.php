<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_for_optical.php"; ?>
<div class="page-container">   
  <div class="page-content">
    <div class="container-fluid"> 
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"> <?php echo str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-16));?> </li>
      </ul>      
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-16)));?></span></div>
            </div>
          </div>
          <div style="clear:both; margin-top:35px"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <div class="col-md-2" style="padding-left:0px; padding-right:2px">
            <input type="text" class="form-control" placeholder="Date" name="inv_date" id="inv_date" value="<?php echo date("d/m/Y") ?>" />
          </div>
        </div>
      </div>
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
              <select class="form-control" id="sub_type_name" onChange="load_item();">
                <option value="">Level 1</option>
                <option value="">Level 2</option>
                <option value="">Other</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="">Item</label>
              <select class="form-control item" id="item" onChange="load_batch_codes();" >
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
              <select id="batch_code_val" class="form-control" onChange="load_stock();">
              </select>
            </div>
          </div>
          <div class="col-md-2" style="margin-top:25px">
            <button class="btn green" onClick="add_item()">Add Item</button>
          </div>
        </div>
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
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Mfg. Date </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Expiry Date </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
              </tr>
            </thead>
            <tbody id="assets_indent_body">
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <div class="col-md-12" style="text-align:center; margin-bottom:10px">
          <input type="button" class="btn" onClick="save_sales()" value="Save Data" style="background:#000099;color:#FFFFFF;width:120px" />
          &nbsp;&nbsp;
          <input type="button" class="btn" onClick="save_sales(1)" value="Save & Print" style="background:#000099;color:#FFFFFF;width:120px" />
        </div>
        <div style="clear:both; height:15px">&nbsp;</div>
        <table class="table table-striped table-bordered table-hover small" id="full_tab_details">
                  <caption>Full Order Details <strong style="float:right;display:flex;line-height:34px;">Search:&nbsp;&nbsp;<input type="text" class="form-control" name="search" id="search" value="" style="width:100%;"/></strong></caption>
                  <thead>
                    <tr>
                      <th class="hidden-380" style="text-align:center"> Expiry Number </th>
              		  <th class="hidden-380" style="text-align:center"> Date </th>
              		  <th class="hidden-380" style="text-align:center"> Expiry Item Details </th>
                    </tr>
                  </thead>
                  <tbody id="tab_po_body">
                  </tbody>
                </table>
                <?php 
					$sql_="select * from `expiry_or_damage_for_optical`";
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
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DAMAGED AND EXPIRED ITEMS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered table-hover small" id="full_tab_details">
                  <caption>Full Order Details <strong style="float:right;display:flex;line-height:34px;">Search:&nbsp;&nbsp;<input type="text" class="form-control" name="search1" id="search1" value="" style="width:100%;"/></strong></caption>
                  <thead>
                    <tr>
                      <th class="hidden-380" style="text-align:center"> Asset Name </th>
              		  <th class="hidden-380" style="text-align:center"> Batch No </th>
              		  <th class="hidden-380" style="text-align:center"> Qty </th>
                    </tr>
                  </thead>
                  <tbody id="asset_tab_details">
                  </tbody>
                </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>
</div>
<?php include("footer_for_optical.php"); ?>
<script>
let tab_asset_entry="";
load_types();
load_sub_types();
let mrp=0;
let mrp_=0;
let expiry_date="";
let mgf_date="";
let uhid="";
var cou_pag_no=0;
load_sale_order_details(cou_pag_no);
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
		$("#search1").on("keyup", function() {
		  var value = $(this).val().toLowerCase();
		  $("#asset_tab_details tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		  });
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
function del(id){
	$("#"+id).remove();
	calculate(id);
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
	var batch_code_sel=$("#batch_code_val").val();
	if(batch_code_sel!=''){
	batch_code_sel=batch_code_sel;
	}else{
		batch_code_sel='';
	}
	if(typeof tds.html() === "undefined"){ 
		$("#assets_indent_body").append("<tr id='"+id+item_val[0]+"' data-mrp='"+mrp_+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+"_asset_name' >"+$("#item :selected").text()+"</td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+"_batch_no_' ><input type='text' id='"+id+item_val[0]+"_batch_no' style='width:80px' value='"+batch_code_sel+"' ></td><td id='"+id+"_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+"_mfg_date' class='mfg_date' value='"+mgf_date+"'></td><td id='"+id+"_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ></td><td id='"+id+item_val[0]+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+"\")'><i class='fa fa-trash'></i></a></td></tr>");
	$("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())));
	//calculate(id+item_val[0]);
	}else{
		if(confirm("Is the item from the same batch?")){
			var batch_flag=0;
			if($("#freeItem"+id+item_val[0]+"_batch_no").val()==batch_code_sal){
				batch_flag=0;
			}else{
			var sl=1;
			while(sl<=icount){				
				if($("#"+id+item_val[0]+sl+"_batch_no").val()==batch_code_sal){					
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
			}
		}else{
		$("#assets_indent_body").append("<tr id='"+id+item_val[0]+icount+"' data-mrp='"+mrp_+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+icount+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+icount+"_asset_name' >"+$("#item :selected").text()+"</td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+icount+"_batch_no_' ><input type='text' id='"+id+item_val[0]+icount+"_batch_no' style='width:80px' value='"+$("#batch_code_val").val()+"' ></td><td id='"+id+icount+"_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+icount+"_mfg_date' class='mfg_date' value='"+mgf_date+"'></td><td id='"+id+icount+"_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+icount+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ></td><td id='"+id+item_val[0]+icount+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+"\")'><i class='fa fa-trash'></i></a></td></tr>");
	$("#"+id+item_val[0]+icount+"_qty").val(parseFloat($("#"+id+item_val[0]+icount+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+icount+"_qty").val())));
	icount++;
	 	}
}
}
function save_sales(flag=0){
	let ids=[];
	let qty=[];
	let batch_no=[];
	let expiry_date=[];
	let mfg_date=[];
	let asset_name=[];
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
		asset_name[i]=$("#"+$( this ).attr('id')+"_asset_name").html();
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
		"asset_name" : asset_name,
		"inv_date": $("#inv_date").val()

	}

	

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=39',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
				if(data.flag=="1"){
				 	toastr.success('Data Saved Successfully');
				}else{
				 	if(data.reason!="") toastr.error(data.reason);
				 	else toastr.error('Unable to save order');
				}
				if(flag==1) window.open("stock_transfer_print.php?inv_id="+data.s_id);
				setTimeout(function(){ location.reload(); }, 2000);	

			}
		});
}

function data_reset(){
	$("#assets_indent_body").html("");
	$("#indent").val('');
	$("#vendor_name").val('');
	load_purchase();
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
function search_code(code){

	//alert($("#item").find(":selected").val());

	let item_val=$("#item").find(":selected").val().split("^");

	let flag_=false;

	let data_details={

	"batch_code": code,

	"item_id": item_val[0] ,

	}

	

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=30',

			type: 'POST',

			dataType: 'json',

			data: data_details,

			async: false, 

			success: function (data) {

			//alert(data.mrp);	

		 	mrp=data.rate;

			mrp_=data.mrp;

			expiry_date=data.expiry_date;

			mgf_date=data.mfg_date;

			

			if(mrp!=null){

				flag_=true;

			}

			//$("#item").focus();

				

			}

		});

			

		return flag_;

	

}
function load_batch_codes(){



	let item_val=$("#item").find(":selected").val().split("^");

	let item_id=item_val[0];

	$('#batch_code_val').empty();

	

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=28',

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
function load_sale_order_details(cou_pag_no){
	//alert($('#row_limit').val());
	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;
	//let row_limit=($('#row_limit').val()!="" ) ? parseFloat($('#row_limit').val())+page_limit : '0';
	//$('#row_limit').val(initial_page);
	var data_details={
		"initial_page": initial_page,
		"limit": <?php echo $limit;?>
	}
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=52',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				var html='';
				 $.each(data, function(index, element) {
					/*<th class="hidden-380" style="text-align:center"> Expiry Number </th>
              		  <th class="hidden-380" style="text-align:center"> Date </th>
              		  <th class="hidden-380" style="text-align:center"> Expiry Item Details </th>*/
					html +='<tr><td style="text-align:center"><a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal" onClick="load_only_expary_item('+element.id+')">'+element.order_number+'</a></td><td style="text-align:center">'+element.date+'</td><td style="text-align:center"><a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal" onClick="load_only_expary_item('+element.id+')"><i class="fa fa-eye"></i></a></td></tr>';
				});

				$('#tab_po_body').html(html);
			 }
		  });

}
function load_only_expary_item(id){
	var data_details={
		"id": id
	}
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=53',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				var html='';
				 $.each(data, function(index, element) {
					html +='<tr><td style="text-align:center">'+element.item_name+'</td><td style="text-align:center">'+element.batch_no+'</td><td style="text-align:center">'+element.qty+'</td></tr>';
				});

				$('#asset_tab_details').html(html);
			 }
		  });
}
</script>
</body><!-- END BODY -->

</html>