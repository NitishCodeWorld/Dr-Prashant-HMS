<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_inventory.php"; ?>
<style>
.ajax-loader {
	visibility: visible;
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
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Type Creation</span></div>
            </div>
            <!-- BEGIN FORM-->
            <input type="hidden" value="" id="id" name="id" />
            <div class="form-body">
              <div class="row" style="background:#dcefff; padding:9px 0px">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Type Name</label>
                    <div class="col-md-9">
                      <input type="text" id="type_name_" name="type_name_" class="form-control" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Choose Type</label>
                    <div class="col-md-9">
                      <select class="form-control" id="type_name">
                      </select>
                      <span class="small">You do not need to choose type in case it is a primary type.</span> </div>
                  </div>
                  <div style="clear:both"></div>
                  <div class="form-group" style="margin-top:10px">
                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                          <button type="button" class="btn green" onClick="save_type(); return false;" id="submit_form_button">Submit</button>
                          <button type="button" class="btn default" onclick="location.reload()">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END PAGE CONTENT --> 
              </div>
            </div>
            <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>loader.gif" class="img-responsive" /> </div>
          </div>
          <!-- END PAGE CONTENT INNER --> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-hover table-bordered" id="asset_entry_data">
            <caption>
            All Types
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Type ID </span></th>
                <th class="draggable" data-column="type_name" style="cursor: move;"><span>Type Name</span></th>
                <th class="draggable" data-column="subtype_name" style="cursor: move;"><span>Main Type Name</span></th>
                <th class="print_ignore"><span>Action</span></th>
              </tr>
            </thead>
            <tbody id="assets_body">
            </tbody>
          </table>
        </div>
        
        <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
      </div>
      <!-- END PAGE CONTENT --> - </div>
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

let tab_asset_entry="";
load_all_types();
load_types();

function save_type(){
	if($("#type_name_").val()==''){
		alert('Please Fill up');
		return false;
	}if($("#type_name").val()==''){
		alert('Please Fill up');
		return false;
	}
	var data_details={
		"sub_type_name": $("#type_name_").val(),
		"type_id": $("#type_name").val(),
		"id": $("#id").val()
	}
	var edit_flag=0;
		$.ajax({
				beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
				url: 'get_json_data_inventory.php?flag=6',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						//console.log(element.text);
						if(data.flag=="1") toastr.success('Location Created Successfully');
						else toastr.error('Unable to create location');
						$("#type_name_").val('');
						$("#id").val('');						
						load_all_types();
						load_types();
				},
				complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			});

}


function load_all_types(){

	if(tab_asset_entry!="") tab_asset_entry.destroy();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=21',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			 $('#assets_body').html('');
			 $.each(data, function(index, element) {
			 	$('#assets_body').html($('#assets_body').html()+'<tr><td>'+element.id+'</td><td>'+element.text+'</td><td>'+((element.main_cat) ? element.main_cat : "-")+'</td><td><a class="edit" href="javascript:;" onclick="edit('+element.id+',\''+element.text+'\',\''+element.main_cat_id+'\')" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="delete" href="javascript:;" onclick="del('+element.id+')" ><i class="fa fa-trash"></i></a></td>');
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
			data: "id="+id+"&table=type_master",
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				load_all_types();
				load_types();
				
			},
			complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
		});
	}
}

function load_types(){
	
	$('#type_name').empty();

	$.ajax({

            url: 'get_json_data_inventory.php?flag=3',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#type_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 }

		  });
	
	
}


function edit(id,text,main_cat_id){

	$("#id").val(id);
	$("#type_name_").val(text);
	$("#type_name").val(main_cat_id);
	$("#type_name_").focus();

}


</script>
</body>
<!-- END BODY -->
</html>