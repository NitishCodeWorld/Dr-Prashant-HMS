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
</style>
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
          <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>loader.gif" class="img-responsive" /> </div>
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Purchase Order Approval</span></div>
            </div>
            <!-- BEGIN FORM-->
            <input type="hidden" value="" id="id" name="id" />
            <div class="form-body">
              <div class="row" style="background:#dcefff; padding:9px 0px">
                <table class="table table-striped table-bordered table-hover small" id="asset_entry_data1">
                  <thead>
                    <tr>
                      <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Date </span></th>
                      <th class="draggable" data-column="category_name" style="cursor: move;"><span>Purchase order number </span></th>
                      <th class="draggable" data-column="department_name" style="cursor: move;"><span>Vendor </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
                    </tr>
                  </thead>
                  <tbody id="purchase_order_body">
                  </tbody>
                </table>
                
                <!-- END PAGE CONTENT --> 
              </div>
              
            </div>
            
          </div>
          <!-- END PAGE CONTENT INNER --> 
          
        </div>
      </div>
      
      <!-- END PAGE CONTENT --> 
    </div>
    <!-- END PAGE CONTAINER -->
    <div id="staticBackdrop" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Purchase Order Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>
          </div>
          <div class="modal-body">
            <table width="100%">
              <tr>
                <td><label>Purchase Number:</label>
                  <span id="purchase_id" style="font-weight:bold" >PUR/100/1/2</span></td>
                <td></td>
                <td style="text-align:right"><label>Date:</label>
                  <span id="date_val" style="font-weight:bold">09/05/22</span></td>
              </tr>
              <tr>
                <td><span id="vendor_name">Debasish</span></td>
              </tr>
              <tr>
                <td colspan="3"><table width="100%">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Department</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                      </tr>
                    </thead>
                    <tbody id="purchase_order_body_">
                    </tbody>
                  </table></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

let tab_asset_entry="";

load_purchase_orders();
//load_assets();
//load_types();
//load_sub_types();
//load_departments();
//load_location();
//load_vendor();
//load_unit();


function load_purchase_orders(){
if(tab_asset_entry!="") tab_asset_entry.destroy();


$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=30',
			type: 'POST',
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				$("#purchase_order_body").html(data);
				tab_asset_entry=$("#asset_entry_data1").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					order: [[3, 'desc']],
					"pageLength": 15,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				
			},
			complete: function(){
			  $('.ajax-loader').css("visibility", "hidden");
			}
		});

}


function approve(id){
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=31',
			type: 'POST',
			dataType: 'json',
			data: "id="+id,
			success: function (data) {
				if(data.flag==1){ toastr.success('Order approved successfully');
					load_purchase_orders();
				}
				else toastr.error('Unable to approved order');
			},
			complete: function(){
			  $('.ajax-loader').css("visibility", "hidden");
			}
			
			});
}

function show_purchase_order(id){
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=32',
			type: 'POST',
			dataType: 'json',
			data: "id="+id,
			success: function (data) {
				$("#purchase_id").html(data.purchase_number);
				$("#date_val").html(data.date);
				$("#vendor_name").html(data.vendor_name);
				$("#purchase_order_body_").html(data.body);
				//alert(data.body);
				
			},
			complete: function(){
			  $('.ajax-loader').css("visibility", "hidden");
			}
			
			});
}

</script>
</body>
<!-- END BODY -->
</html>