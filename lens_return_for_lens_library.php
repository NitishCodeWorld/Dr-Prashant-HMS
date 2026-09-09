<?php

include "conn.php"; // Using database connection file here

?>
<?php include "header_for_optical.php"; ?>

<div class="page-container">
  <div class="page-content">
    <div class="container-fluid">
      <?php  include("lens_menu_for_lens_library.php");?>
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-17)));?></span></div>
            </div>
            
            <!-- BEGIN FORM--> 
            
          </div>
          <div class="portlet" style="min-height:50px; margin-bottom:0px">
            <div class="portlet-body">
              <div class="col-md-1" style="margin-top:8px; font-weight:bold; text-align:right; padding-right:0px; margin-left:-59px;">Vendor:</div>
              <div class="col-md-3" style="padding-left:0px; padding-right:2px">
                <select class="form-control" name="vendor_name" id="vendor_name" onChange="load_asset_details();">
                </select>
              </div>
            </div>
            <div style="clear:both" class="col-md-12">&nbsp;</div>
          </div>
          
          <!-- END PAGE CONTENT INNER --> 
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">
            <caption>
            Lens From Stock
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Lens Name </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Batch </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Bar Code </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <td class="print_ignore"><span>Action</span></td>
              </tr>
            </thead>
            <tbody id="lens_issued">
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-bordered table-hover small" id="tab_data">
            <caption>
            Lens Add Return Vendor
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>SL No </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Lens Name </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Batch </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <td class="print_ignore"><span>Action</span></td>
              </tr>
            </thead>
            <tbody id="lens_return_vandor">
            </tbody>
          </table>
        </div>
        
        <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>-->
        
        <div class="col-xs-12 col-md-12" style="text-align:center">
          <input type="button" class="btn" onClick="save_return()" value="Save" style="background:#000099;color:#FFFFFF;width:120px" />
        </div>
      </div>
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
            <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Batch</span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>Vendor</span></th>
            <th class="draggable" data-column="sub_cat"><span>Manufacturing Date</span></th>
            <th class="draggable right" data-column="qty" style="cursor: move;"><span>Expiry Date</span></th>
            <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Date</span></th>
            <!--<th class="draggable right" data-column="qty" style="cursor: move;"><span>Status</span></th>-->
          </tr>
        </thead>
        <tbody id="tab_po_body">
        </tbody>
      </table>
      <?php 
                $sql_="select * from `lens_returned_to_vendor_for_lens_library`";
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
      <!-- END PAGE CONTENT --> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTAINER --> 
  
</div>
<?php include("footer_for_optical.php"); ?>
<script type="text/javascript">
load_vendor();
load_types();
var cou_pag_no=0;
load_sale_order_details(cou_pag_no);
$("#search").on("keyup", function() {
		  var value = $(this).val().toLowerCase();
		  $("#tab_po_body tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		  });
		});
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
		  });}
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
	//alert('san_'+type_id);
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
function load_asset_details(){
	var data_details={
		"vendor_name": $("#vendor_name").val(),
		//"lens_recived_id": $("#lens_recived_id").val(),
	}
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=48',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			async: false, 
			success: function (data) {				
		 		$("#lens_issued").html(data.ret_val);
				//alert(data.ret_val);
			}
		});

}

var slno=0;
function add_item(item_id,batch_,recived_id){

var src=$("#lens_issued").html();

	if(parseInt($("#unsed_qty"+item_id+'_'+batch_).val())>parseInt($("#item_qty"+item_id+'_'+batch_).html())){

		alert("Quantity not in stock");

		return false;

	}

	

		slno=parseInt(slno+1);

	if($("#"+item_id+batch_+recived_id+"_batch").html()!=batch_){

		$("#lens_return_vandor").append("<tr id='"+item_id+batch_+recived_id+"' data-item='"+item_id+"' data-recived-id='"+recived_id+"'><td><span id='"+item_id+batch_+recived_id+"_sl_no'>"+slno+"</span></td><td id='"+item_id+batch_+recived_id+"_lans_name'>"+$("#item_name"+item_id+'_'+batch_).html()+"</span></td><td id='"+item_id+batch_+recived_id+"_batch'>"+batch_+"</span></td><td id='"+item_id+batch_+recived_id+"_lans_qty'>"+$("#unsed_qty"+item_id+'_'+batch_).val()+"</span></td><td><a href='javascript:void(0);' onclick='del(\""+item_id+batch_+recived_id+"\")'><i class='fa fa-trash'></i></a></td></tr>");

		//calculate(id+item_val[0]+batch_);

	}else{

		slno=parseInt(slno-1);

		let qty_added=$("#"+item_id+batch_+recived_id+"_lans_qty").html();

		$("#"+item_id+batch_+recived_id+"_lans_qty").html((parseFloat(qty_added)+parseFloat($("#unsed_qty"+item_id+'_'+batch_).val())));

	}

		

}

function del(id){

	slno=parseInt(slno-1);

	$("#"+id).remove();

	//calculate(id);

}

function save_return(flag=0){

	

	let ids=[];

	let recived_id=[];

	let qty=[];

	let batch_no=[];

	let asset_name=[];

	let i=0;

	let return_flag=0;

	

	$("#tab_data > tbody  > tr").each(function( index, val ){

  		console.log( index + ": " + $( this ).attr('id') );

		//alert($("#"+$( this ).attr('id')+"_batch_no").val());

		//return;

		//purchase_id[i]=$( this ).attr('data-indent');

		recived_id[i]=$( this ).attr('data-recived-id');

		ids[i]=$( this ).attr('data-item');

		qty[i]=$("#"+$( this ).attr('id')+"_lans_qty").html();

		batch_no[i]=$("#"+$( this ).attr('id')+"_batch").html();

		asset_name[i]=$("#"+$( this ).attr('id')+"_lans_name").html();

		

		

		i++;

});



	let grand_total=$("#total_qty").html();



	if(return_flag==1) return false;

	var data_details={

		//"purchase_id" : purchase_id,

		//"purchase_details_id" : purchase_details_id,

		"id" : ids,

		"qty" : qty,

		"batch_no" : batch_no,

		"recived_id" : recived_id,

		"asset_name" : asset_name,

		"vendor" : $("#vendor_name :selected").val()

	}

	//console.log(data_details);return false;

	$.ajax({

            url: 'get_json_data_for_lens_library.php?flag=49',

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
function load_sale_order_details(cou_pag_no){
	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;
	var data_details={
		"initial_page": initial_page,
		"limit": <?php echo $limit;?>
	}
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=57',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				var html='';
				 $.each(data, function(index, element) {
					 /*$arr[]=array("asset_name"=>$asset_name,"id"=>$id,"batch"=>$batch,"mrd"=>$mrd,"patient_name"=>$patient_name,"doctor_name"=>$doctor_name,"manufacturing_date"=>$mfg_date_,"expiry_date"=>$expiry_date,"status"=>$status,"bar_code"=>$bar_code,"qty"=>$qty);*/
					html +='<tr><td>'+element.asset_name+'</td><td>'+element.qty+'</td><td>'+element.batch+'</td><td>'+element.vendor_name+'</td><td>'+element.manufacturing_date+'</td><td>'+element.expiry_date+'</td><td>'+element.date+'</td></tr>';
				});
				$('#tab_po_body').html(html);
			 }
		  });

}
</script>