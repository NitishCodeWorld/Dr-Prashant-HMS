<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_inventory.php"; ?>
<!-- END HEADER --> 
<!-- BEGIN PAGE CONTAINER -->
<style>
.re_order_td{
font-weight:bold;
font-size:13px;
color:#212529;
}
</style>

<div class="page-container"> 
  <!-- BEGIN PAGE HEAD --> 
  
  <!-- END PAGE HEAD --> 
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container-fluid"> 
    
      <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label class="control-label">Re-order Level</label>
              <div class="input-group"><!--onChange="fun_re_order($('#re_order_level').val(''));"-->
                <select class="form-control" id="re_order_level" name="re_order_level" onChange="load_asset_entry_data();">
                  <option value="1">Under Re-order Level</option>                  
                  <option value="">All</option>
                  <!--<option value="1">Uploaded</option>-->
                </select>
              </div>
            </div>
            
          </div>
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
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Closing Stock </span></th>
                <th class="draggable right" data-column="rol" style="cursor: move;"><span>Re-order Level </span></th>
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
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

var tab_asset_entry="";
load_asset_entry_data();



function load_asset_entry_data(){
	$("#assets_body").html('<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');
	var data_details={
					"re_order_level": $("#re_order_level").val(),
			}
			
if(tab_asset_entry!="") tab_asset_entry.destroy();
$.ajax({
			
            url: 'get_json_data_inventory.php?flag=81',
			type: 'POST',
			data: data_details,
			success: function (data) {
				$("#assets_body").html(data);
				$("#staticBackdrop").modal('hide');
				
				tab_asset_entry=$("#asset_entry_data").DataTable( {
					order: [[0, 'asc']],
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