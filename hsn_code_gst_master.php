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
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">HSN Code With GST Master</span></div>
            </div>
            <!-- BEGIN FORM-->
            <input type="hidden" value="" id="id" name="id" />
            <div class="form-body">
              <div class="row" style="background:#dcefff; padding:9px 0px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-md-3 control-label">HSN Code</label>
                    <div class="col-md-9">
                      <input type="text" id="hsn_code_" name="hsn_code_" class="form-control" placeholder="Enter value">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">GST Rate(%)</label>
                    <div class="col-md-9">
                    <div class="input-group">
                      <input type="text" id="gst_rate_" name="gst_rate_" class="form-control" placeholder="Enter value" onkeyup="gst_divide()">
                      <span class="input-group-addon"> % </span> </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">CGST Rate(%)</label>
                    <div class="col-md-9">
                    <div class="input-group">
                      <input type="text" id="cgst_rate_" name="cgst_rate_" class="form-control" placeholder="Enter value">
                      <span class="input-group-addon"> % </span> </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">SGST Rate(%)</label>
                    <div class="col-md-9">
                    <div class="input-group">
                      <input type="text" id="sgst_rate_" name="sgst_rate_" class="form-control" placeholder="Enter value">
                      <span class="input-group-addon"> % </span> </div>
                    </div>
                  </div>
                  <div style="clear:both"></div>
                  <div class="form-group" style="margin-top:10px">
                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                          <button type="button" class="btn green" onClick="save_asset(); return false;" id="submit_form_button" >Submit</button>
                          <button type="button" class="btn default" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>loader.gif" class="img-responsive" /> </div>
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
            <caption>
            All HSN Code With GST
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>HSN ID </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>HSN Code </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>GST Rate </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>CGST Rate </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>SGST Rate </span></th>
                <th class="print_ignore"><span>Action</span></th>
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
load_departments();

function save_asset(){
		if($("#hsn_code_").val()==''){
		alert('Please Fill up');
		return false;
		}
		if($("#gst_rate_").val()==''){
		alert('Please Fill up');
		return false;
		}
		if($("#cgst_rate_").val()==''){
		alert('Please Fill up');
		return false;
		}
		if($("#sgst_rate_").val()==''){
		alert('Please Fill up');
		return false;
		}
		
	var data_details={
		"hsn_code": $("#hsn_code_").val(),
		"gst_rate": $("#gst_rate_").val(),
		"cgst_rate": $("#cgst_rate_").val(),
		"sgst_rate": $("#sgst_rate_").val(),
		"id": $("#id").val()
	}
	var edit_flag=0;
		$.ajax({
				beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
				url: 'get_json_data_inventory.php?flag=60',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						//console.log(element.text);
						if(data.flag=="1") toastr.success('HSN Code with GST Created Successfully');
						else toastr.error('Unable to create HSN Code with GST');
						$("#hsn_code_").val('');
						$("#gst_rate_").val('');
						$("#cgst_rate_").val('');
						$("#sgst_rate_").val('');
						$("#id").val('');						
						load_departments();
				},
				complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			});

}


function load_departments(){

	$('#asset_name').empty();
	if(tab_asset_entry!="") tab_asset_entry.destroy();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=59',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			 $('#assets_body').html('');
			 $.each(data, function(index, element) {
			 	$('#assets_body').html($('#assets_body').html()+'<tr><td>'+element.id+'</td><td>'+element.hsn_code+'</td><td>'+element.gst_rate+'</td><td>'+element.cgst_rate+'</td><td>'+element.sgst_rate+'</td><td><a class="edit" href="javascript:;" onclick="edit('+element.id+',\''+element.hsn_code+'\',\''+element.gst_rate+'\',\''+element.cgst_rate+'\',\''+element.sgst_rate+'\')" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="delete" href="javascript:;" onclick="del('+element.id+')" ><i class="fa fa-trash"></i></a></td>');
		 	});
			
				tab_asset_entry=$("#asset_entry_data").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				
				
			
			 },
				complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });

}


function del(id){
if(confirm("Are you sure you want to delete the data?")){
	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=20',
			type: 'POST',
			data: "id="+id+"&table=hsn_code_gst_master",
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				load_departments();
				
			},
			complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
			}
		});
	}
}


function edit(id,hsn_code,gst_rate,cgst_rate,sgst_rate){

	$("#id").val(id);
	$("#hsn_code_").val(hsn_code);
	$("#gst_rate_").val(gst_rate);
	$("#cgst_rate_").val(cgst_rate);
	$("#sgst_rate_").val(sgst_rate);
	$("#hsn_code_").focus();

}
function gst_divide(){
	var gst_rate=$("#gst_rate_").val();
	if(gst_rate!=''){
		var divide=parseFloat(gst_rate)/2;
		$("#cgst_rate_").val(divide);
		$("#sgst_rate_").val(divide);
	}else{
		$("#cgst_rate_").val('');
		$("#sgst_rate_").val('');
	}

}



</script>
</body>
<!-- END BODY -->
</html>