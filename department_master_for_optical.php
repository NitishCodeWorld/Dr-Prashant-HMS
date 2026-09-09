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
              <div class="portlet-title">
                <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-16)));?></span></div>
              </div>
            </div>
            <!-- BEGIN FORM-->
            <input type="hidden" value="" id="id" name="id" />
            <div class="form-body">
              <div class="row" style="background:#dcefff; padding:9px 0px">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Department Name</label>
                    <div class="col-md-9">
                      <input type="text" id="department_name" name="department_name" class="form-control" placeholder="Name">
                    </div>
                  </div>
                  <div style="clear:both"></div>
                  <div class="form-group" style="margin-top:10px">
                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                          <button type="button" class="btn green" onClick="save_unit(); return false;">Submit</button>
                          <button type="button" class="btn default" onClick="init()">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
            All Department
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Department ID </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Department Name </span></th>
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
  </div>
</div>
<!-- END PAGE CONTAINER -->
<?php include("footer_for_optical.php"); ?>
<script>

let tab_asset_entry="";
load_unit();

function save_unit(){

	var data_details={
		"department_name": $("#department_name").val(),
		"id": $("#id").val()
	}
	var edit_flag=0;
		$.ajax({
				url: 'get_json_data_for_optical.php?flag=14',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						//console.log(element.text);
						if(data.flag=="1") toastr.success('Unit Created Successfully');
						else toastr.error('Unable to create unit');
						$("#department_name").val('');
						$("#id").val('');						
						load_unit();
				}
			});

}


function load_unit(){

	if(tab_asset_entry!="") tab_asset_entry.destroy();

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=13',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			 $('#assets_body').html('');
			 $.each(data, function(index, element) {
			 	$('#assets_body').html($('#assets_body').html()+'<tr><td>'+element.id+'</td><td>'+element.text+'</td><td><a class="edit" href="javascript:;" onclick="edit('+element.id+',\''+element.text+'\')" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="delete" href="javascript:;" onclick="del('+element.id+')" ><i class="fa fa-trash"></i></a></td>');
		 	});
			
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


function del(id){
	var data_details={
		"table": 'department_master_for_optical',
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
				init();
				load_unit();	
			
			 }

		  });
}


function edit(id,text){

	$("#id").val(id);
	$("#department_name").val(text);
	$("#department_name").focus();

}

function init(){
	$("#department_name").val('');
	$("#id").val('');
}


</script>
</body>
<!-- END BODY -->
</html>