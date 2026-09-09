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
                <th class="draggable" data-column="department_name" style="cursor: move;"><span>Department Name </span></th>
                <th class="draggable" data-column="location_name" style="cursor: move;"><span>Location Name </span></th>
                <th class="draggable" data-column="vendor_name" style="cursor: move;"><span>Vendor Name </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Opening Qty </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty Purchased </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Utilised for surgery </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Pharmacy Sales </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Closing Stock </span></th>
                <th class="draggable right" data-column="size" style="cursor: move;"><span>Size </span></th>
                <th class="draggable right" data-column="size" style="cursor: move;"><span>Colour </span></th>
                <th class="draggable" data-column="specification" style="cursor: move;"><span>Specification </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Covid Item </span></th>
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

let tab_asset_entry="";
load_asset_entry_data();
load_locations();


function load_asset_entry_data(){
if(tab_asset_entry!="") tab_asset_entry.destroy();
$.ajax({
            url: 'get_json_data_inventory.php?flag=33',
			type: 'POST',
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
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


</script>
</body>
<!-- END BODY -->
</html>