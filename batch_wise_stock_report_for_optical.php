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
            <div class="row">
              <div class="col-md-12">
                <div class="form-body">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Item</label>
                      <select class="form-control" id="item" >
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">From Date</label>
                      <input name="from_date" id="from_date" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">To Date</label>
                      <input name="to_date" id="to_date" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">&nbsp;</label>
                      <input type="button" class="btn btn-info" name="Submit" id="submit" onClick="load_asset_entry_data();" value="GO">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="overflow:auto">
                <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">
                  <caption>
                  All Items
                  </caption>
                  <thead>
                    <tr>
                      <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Item Name </span></th>
                      <th class="draggable" data-column="category_name" style="cursor: move;"><span>Category Name </span></th>
                      <th class="draggable" data-column="sub_cat"><span>Sub Cat </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Opening Qty </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty Purchased </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty Consumables </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty Expiry Or Damage </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>From Department Transfer </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>To Department Transfer </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Lens Challan </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Utilised for surgery </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Pharmacy Sales </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Lens Challan Return</span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Closing Stock </span></th>
                      <th class="draggable right" data-column="size" style="cursor: move;"><span>Size </span></th>
                      <th class="draggable right" data-column="size" style="cursor: move;"><span>Colour </span></th>
                      <th class="draggable" data-column="specification" style="cursor: move;"><span>Specification </span></th>
                    </tr>
                  </thead>
                  <tbody id="assets_body">
                  </tbody>
                </table>
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
<script type="text/javascript">
var tab_asset_entry="";
load_asset_entry_data();
load_item();
$('#item').select2();
$( "div" ).mousemove(function( event ) {

	$("#from_date").datepicker({
	   format: 'dd-mm-yyyy'
   });

$("#to_date").datepicker({
	   format: 'dd-mm-yyyy'
   });


});//load_locations();


function load_asset_entry_data(){
	var data_details={
		"from_date" : $('#from_date').val(),
		"to_date" : $('#to_date').val(),
		"item_id" : $('#item').val()		
	}
if(tab_asset_entry!="") tab_asset_entry.destroy();
      		$.ajax({
            beforeSend: function(){
			$("#assets_body").html('<tr><td colspan="17" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');
		  	},
			url: 'get_json_data_for_optical.php?flag=43',
			data:data_details,
			type: 'POST',
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
				
				$("#staticBackdrop").modal('hide');
				
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