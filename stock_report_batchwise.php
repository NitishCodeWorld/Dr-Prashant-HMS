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
.close_stock_span {
	font-weight:bold;
	color:#933;
}
</style>
<div class="page-container"> 
  <!-- BEGIN PAGE HEAD -->
  <div class="page-head">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1>Stock Report Batchwise<small>&nbsp;</small></h1>
      </div>
      <!-- END PAGE TITLE --> 
    </div>
  </div>
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
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <form method="post">
            <div class="col-md-2">
              <label>From</label>
              <input type="text" class="form-control" id="from_" name="from_" />
            </div>
            <div class="col-md-2">
              <label>To</label>
              <input type="text" class="form-control" id="to_" name="to_" />
            </div>
            <div class="col-md-2">
              <label>Batch Code Exist:</label>
              <select class="form-control" id="batch_exist_" name="batch_exist_">
                <option value="1">Batch Exist</option>
                <option value="2">Batch Is Not Exist</option>
              </select>
            </div>
            <div class="col-md-4">
              <label>Item Range:</label>
              <select class="form-control" id="item_range" name="item_range">
              </select>
            </div>
            <div class="col-md-2" style="padding-top:25px">
              <input type="button" class="btn blue" onClick="load_stock_();" value="Go">
            </div>
          </form>
        </div>
      </div>
      <div class="row" style="margin-top:20px">
        <div class="col-md-6" style="overflow:auto;display:none;">
          <div class="col-md-2">
            <label>
              <input type="checkbox" id="pharmacy_chk" checked="checked" class="form-control">
              Pharmacy</label>
          </div>
          <div class="col-md-2">
            <label>
              <input type="checkbox" id="lense_chk" checked="checked" class="form-control">
              Lense</label>
          </div>
          <div class="col-md-2">
            <label>
              <input type="checkbox" id="injection_chk" checked="checked" class="form-control">
              Injection</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-4">
            <label>Item :</label>
            <select class="form-control select2" name="drug_item" id="drug_item" onChange="stock_value_check();">
              <option value="">-Select Medicine-</option>
              <?php 

								 $sql7="SELECT `id`, `asset_name` FROM `item_master` WHERE `status`='1' AND `type_id`='1' ORDER BY `asset_name` ASC ";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['asset_name'].'</option>';

								 }

					 			?>
            </select>
          </div>
          <div class="col-md-4" ><span class="close_stock_span" id="close_stock_span" name="close_stock_span">Closing Stock: 0</span><br/>
            <span class="close_stock_span" id="stock_range_span" name="stock_range_span">Range Between: 0</span></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-4">
            <label style="font-size:24px">Total Stock Value:&nbsp; &#8377;</label>
            <span id="total_val" style="font-size:24px; font-weight:bold"><img src="loader.gif" width="20px"></span></div>
          <div class="col-md-4">
            <label style="font-size:24px">Total Item :&nbsp; </label>
            <span id="total_item_val" style="font-size:24px; font-weight:bold"><img src="loader.gif" width="20px"></span></div>
        </div>
      </div>
      <br/>
      <br/>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">
            <?php $from=$_POST['from_'];
							  $to=$_POST['to_'];
						?>
            <caption>
            All Items -
            <?php //echo "From: ".$from ."-  To: ". $to; ?>
            </caption>
            <thead>
              <tr>
                <th>Sl No.</th>
                <th>Item Name</th>
                <th>Batch</th>
                <th>Opening Stock</th>
                <th>Purchase</th>
                <th>Sale</th>
               <!-- <th>Stock Transfer In</th>-->
                <th>Sale Return</th>
                <!--<th>Stock Transfer Out</th>-->
                <th>Consumables</th>
                <th>Expired/ <br/>Damaged Item</th>
                <!--<th>Purchase Return</th>-->
                <th>Temporary stock</th>
                <th>Rate</th>
                <th>MRP</th>
                <th>Margin %</th>
                <th>Closing Stock</th>
                <th>Stock Valuation</th>
              </tr>
            </thead>
            <tbody id="assets_body">
              <tr>
                <td><!--<img src="loader.gif" width="40px">--></td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
      </div>
      <!-- END PAGE CONTENT --> 
    </div>
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

var asset_entry_data="";
//load_sales();

$( document ).ready(function() {
load_tota_items();
//load_stock_();

$("#drug_item").select2();
	$("#from_").datepicker({
	   format: 'dd-mm-yyyy'
   }).on('changeDate', function(e){
    $(this).datepicker('hide');
});
   
   $("#to_").datepicker({
	   format: 'dd-mm-yyyy'
   }).on('changeDate', function(e){
    $(this).datepicker('hide');
});


});

function load_stock_(){

	
	//destroy datatable
	if(asset_entry_data!="") asset_entry_data.destroy();
	
	let pharmacy=0;
	let lense=0;
	let injection=0;
	
	if($("#pharmacy_chk").is(':checked')) pharmacy=1;
	if($("#lense_chk").is(':checked')) lense=1;
	if($("#injection_chk").is(':checked')) injection=1; 	
	$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="17" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');
	//$("#assets_body").html('<img src="loader.gif" width="40px">');
	$("#total_val").html('<img src="loader.gif" width="40px">');
	
	
	data_={
		"from_":$("#from_").val(),
		"to_":$("#to_").val(),
		"pharmacy": pharmacy,
		"lense": lense,
		"injection": injection,
		"batch_exist_":$("#batch_exist_").val(),
		"item_range":$("#item_range").val(),
		
	}
	
	$.ajax({

            url: 'get_json_data_inventory.php?flag=86',
			dataType : "json",
			data : data_,
			type: 'POST',
			success: function (data) {
				
				$("#assets_body").html(data.table_body);
				$("#total_val").html(data.total_val);
				asset_entry_data=$("#asset_entry_data").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 50,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );

			
			 }

		  });
}
function load_tota_items(){
	$("#total_item_val").html('');
	$('#item_range').empty();
	
	data_={
		"batch_exist_":$("#batch_exist_").val()
	}
	
	$.ajax({
            url: 'get_json_data_inventory.php?flag=87',
			dataType : "json",
			data : data_,
			type: 'POST',
			success: function (data) {				
				$("#total_item_val").html(data.count);
				var total_count=parseInt(data.count)+100;
				var per_loop=100;
				var intial_val=1;
				var last_val=100;
				while(last_val<=total_count){
					var range_val=intial_val+'-'+last_val;
					$('#item_range').append($('<option/>', { 
						value: range_val,
						text : range_val
					}));
					intial_val=parseInt(intial_val)+parseInt(per_loop);
					last_val=parseInt(last_val)+parseInt(per_loop);					
				}
				load_stock_();
				
			 }
		  });
}
function stock_value_check(){	
		
	$('#close_stock_span').html('');
	var item_id=$('#drug_item').val();
	$('#stock_range_span').html('');
	if(item_id<101){
		var ranges_val="1-100";	
	}else{
		var range_upper=parseInt(item_id)/100;
		$.ajax({
			type : "POST",
			url : "<?php echo ADMIN_URL; ?>ajax/range_ajax.php",
			dataType : "json", 
			data : "range_upper="+range_upper,
			success : function(data) {
					$('#stock_range_span').html('Range Between: '+data.starting_range+'-'+data.end_range);																				
			}
		});	
		
	}
	
	$.ajax({
			type : "POST",
			url : "<?php echo ADMIN_URL; ?>ajax/inventory_stock_get_ajax.php",
			dataType : "json", 
			data : "item_id="+item_id,
			success : function(data) {
					$('#close_stock_span').html('Closing Stock : '+data.closing_stock);																			
			}
		});	
};

</script>
</body><!-- END BODY -->
</html>