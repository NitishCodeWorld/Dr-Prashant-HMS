<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_for_optical.php"; ?>

<div class="page-container"> 
  <!-- BEGIN PAGE HEAD --> 
  
  <!-- END PAGE HEAD --> 
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
<!-- END PAGE HEAD --> 
<!-- BEGIN PAGE CONTENT -->


  <div class="container-fluid">
  <?php  
  	include("lens_menu_for_lens_library.php");
  
  ?>
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-17)));?></span></div>
      </div>
      <!-- BEGIN FORM--> 
    </div>
    <div class="row">
      <div class="col-md-12" style="overflow:auto">
     
        <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">         
          <thead>
            <tr>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Sl. </span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Lens Name </span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Batch </span></th>
              <th class="draggable" data-column="date_" style="cursor: move;"><span>Opening Stock </span></th>
              <th class="draggable" data-column="category_name" style="cursor: move;"><span>Lens Recieved </span></th>
              <th class="draggable" data-column="sub_cat"><span>Lens Issued </span></th>
              <th class="draggable" data-column="sub_cat"><span>Lens Return <br>To Vendor </span></th>
              <th class="draggable right" data-column="qty" style="cursor: move;"><span>Closing Stock </span></th>
            </tr>
          </thead>
          <tbody id="assets_body">
          </tbody>
        </table>
      </div>
      
      <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
    </div>
    <!-- END PAGE CONTENT --> 
  </div>
</div>
</div>
<!-- END PAGE CONTAINER -->
<?php include("footer_for_optical.php"); ?>
<script>

let tab_asset_entry="";
load_sales();
let stock_report="";

/*$( document ).ready(function() {

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

});*/

function load_sales(){

$("#assets_body").html('<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');

let data_={
	"from": $("#from_").val(),
	"to": $("#to_").val(),
}

if(tab_asset_entry!="") tab_asset_entry.destroy();
$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=50',
			type: 'POST',
			data:data_,
			success: function (data) {
				$("#assets_body").html('');
				$("#assets_body").html(data);
				stock_report=$("#asset_entry_data").DataTable( {
					order: [[1, 'desc'], [0, 'desc']],
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
				
				} );
			
			}
			
		});

}

</script>
</body>
<!-- END BODY -->
</html>