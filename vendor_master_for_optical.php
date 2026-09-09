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
            <!-- BEGIN FORM-->
            <form name="save_from" id="save_form" method="post" enctype="multipart/form-data">
              <input type="hidden" value="" id="id" name="id" />
              
              <!-- BEGIN FORM-->
              <div class="form-body">
                <div class="row" style="background:#dcefff; padding:9px 0px">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-3 control-label">Vendor Name</label>
                      <div class="col-md-9">
                        <input type="text" id="vendor_name_" name="vendor_name_" class="form-control" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Vendor Address</label>
                      <div class="col-md-9">
                        <input type="text" id="vendor_address_" name="vendor_address_" class="form-control" placeholder="Address">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Vendor Phone</label>
                      <div class="col-md-9">
                        <input type="text" id="vendor_phone_" name="vendor_phone_" class="form-control" placeholder="Phone">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Vendor Email</label>
                      <div class="col-md-9">
                        <input type="text" id="vendor_email_" name="vendor_email_" class="form-control" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Vendor GST No.</label>
                      <div class="col-md-9">
                        <input type="text" id="vendor_gst_" name="vendor_gst_" class="form-control" placeholder="GST">
                      </div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="form-group" style="margin-top:10px">
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="button" class="btn green" onClick="save_vendor(); return false;">Submit</button>
                            <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div style="clear:both"></div>
                  </div>
                  <!-- END PAGE CONTENT --> 
                </div>
              </div>
            </form>
            <!-- END PAGE CONTENT --> 
          </div>
        </div>
      </div>
      <!-- END PAGE CONTENT INNER --> 
    </div>
  </div>
  <div class="row">
    <div class="col-md-12" style="overflow:auto">
      <table class="table table-striped table-hover table-bordered" id="asset_entry_data">
        <caption class="text-right">
        <button class="btn blue" onClick="load_assets()"><i class="fa fa-refresh"></i></button>
        </caption>
        <thead>
          <tr>
            <th class="draggable" data-column="item_name" style="cursor: move;"><span>Vender ID </span></th>
            <th class="draggable" data-column="item_name" style="cursor: move;"><span>Vender Name </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>Address </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>Phone </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>Email </span></th>
            <th class="draggable" data-column="category_name" style="cursor: move;"><span>GST </span></th>
            <th class="print_ignore"><span>Action</span></th>
          </tr>
        </thead>
        <tbody id="assets_body">
        </tbody>
      </table>
    </div>
  </div>
  <!-- END PAGE CONTENT --> 
</div>
<?php include("footer_for_optical.php"); ?>
<script type="text/javascript">
let tab_asset_entry="";
load_item();
function save_vendor(){
	if($("#vendor_name_").val()==''){
		alert("Please Enter Vendor Name");
		return false;	
	}
	var edit_flag=0;
		$.ajax({
			  url: 'get_json_data_for_optical.php?flag=10',
			  type: 'POST',
			  dataType: 'json',
			  data: $('#save_form').serialize(),
			  success: function (data) {
					  //console.log(element.text);
					  if(data.flag=="1"){
						  if($("#id").val()!="") toastr.success('Item Updated Successfully');
						  else toastr.success('Item Created Successfully');
					  
					  }else toastr.error('Unable to create Item');
					  //$("#asset_name").val('');	
					  reset_val();
					  //load_item();			
					  setTimeout(function(){ location.reload(); }, 3000);	
					  //load_assets();
			  }
		  });

}
function load_item(){
	if(tab_asset_entry!="") tab_asset_entry.destroy();

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=11',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
				var html='';
				 $.each(data, function(index, element) {
					 //('.$id.',\''.$vendor_name.'\',\''.$address.'\',\''.$phone.'\','.$email.','.$gst.','.$unit_id.')"
					html +='<tr><td>'+element.id+'</td><td>'+element.vendor_name+'</td><td>'+element.address+'</td><td>'+element.phone+'</td><td>'+element.email+'</td><td>'+element.gst+'</td><td>'+element.action+'</td></tr>';
				});
				$('#assets_body').html(html);
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
function edit(id,vendor_name,address,phone,email,gst){
	$("#id").val(id);
	$("#vendor_name_").val(vendor_name);
	$("#vendor_address_").val(address);
	$("#vendor_phone_").val(phone);
	$("#vendor_email_").val(email);
	$("#vendor_gst_").val(gst);
	$("#vendor_name_").focus();
}
function reset_val(){
	$("#id").val("");
	$("#vendor_name_").val("");
	$("#vendor_address_").val("");
	$("#vendor_phone_").val("");
	$("#vendor_email_").val("");
	$("#vendor_gst_").val("");
}
function delete_(id){
	if (confirm('Are You Sure To Delete')) {
	var data_details={
		"table": 'vendor_master_for_optical',
		"id": id
	}
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=9',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				if(data.flag=="1"){
					if($("#id").val()!="") toastr.success('Item Deleted Successfully');
					
				}else toastr.error('Unable to Delete');
				//$("#asset_name").val('');	
				reset_val();
				//load_item(cou_pag_no);	
				setTimeout(function(){ location.reload(); }, 3000);	
			
			 }

		  });
	}
}

</script>
</body>
<!-- END BODY -->
</html>