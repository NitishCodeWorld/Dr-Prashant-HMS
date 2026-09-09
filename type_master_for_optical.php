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
            <form name="save_from" id="save_form" method="post" enctype="multipart/form-data">
              <input type="hidden" value="" id="id" name="id" />
              <div class="form-body">
                <div class="row" style="background:#dcefff; padding:9px 0px">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="col-md-3 control-label">Type Name</label>
                      <div class="col-md-9">
                        <input type="text" id="sub_type_name" name="sub_type_name" class="form-control" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Choose Type</label>
                      <div class="col-md-9">
                        <select class="form-control" id="type_id" name="type_id">
                        </select>
                        <span class="small">You do not need to choose type in case it is a primary type.</span> </div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="form-group" style="margin-top:10px">
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="button" class="btn green" onClick="save_type(); return false;">Submit</button>
                            <button type="button" class="btn default" onclick="location.reload()">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
      <?php 
			
			$sql_="select * from `type_master_for_optical` where category_name<>''";
			$result=mysqli_query($conn,$sql_);
			$count=$result->num_rows;  
			$count_limit=ceil($count / $limit);
			echo '<div class="col-md-6" style="float:right;text-align:right;">';
	  		for ($page_number = 1; $page_number <=$count_limit; $page_number++) {
			  echo '<a href="javascript:void(0);" class="btn btn-primary" onClick="load_item('.$page_number.')">'.$page_number.'</a>';
			}
			echo '</div>';
	 		?>
      <input type="hidden" name="row_limit" id="row_limit" value="<?php echo $limit?>">
    </div>
    
    <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
  </div>
</div>

<!-- END PAGE CONTAINER -->
<?php include("footer_for_optical.php"); ?>
<script type="text/javascript">
var cou_pag_no=0;
load_item(cou_pag_no);
load_types();
function load_types(id){
	
	$('#type_id').empty();

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=5',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#type_id').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			if(id!="")	$("#type_id option[value="+id+"]").attr("selected","selected");
			 }

		  });
	
	
}
function save_type(){
	var edit_flag=0;
		$.ajax({
			  url: 'get_json_data_for_optical.php?flag=3',
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
					 // load_item(cou_pag_no);		
					 setTimeout(function(){ location.reload(); }, 3000);			
					  //load_assets();
			  }
		  });

}
function load_item(cou_pag_no){
	//alert($('#row_limit').val());
	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;
	//let row_limit=($('#row_limit').val()!="" ) ? parseFloat($('#row_limit').val())+page_limit : '0';
	//$('#row_limit').val(initial_page);
	var data_details={
		"initial_page": initial_page,
		"limit": <?php echo $limit;?>
	}
	$.ajax({

            url: 'get_json_data_for_optical.php?flag=12',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				var html='';
				 $.each(data, function(index, element) {
					 //'.$id.',\''.$category_name.'\','.$main_cat_id.'
					html +='<tr><td>'+element.id+'</td><td>'+element.category_name+'</td><td>'+element.main_cat+'</td><td>'+element.action+'</td></tr>';
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
function edit(id,category_name,main_cat_id){
	$("#id").val(id);
	load_types(main_cat_id);
	$("#sub_type_name").val(category_name);
	$("#sub_type_name").focus();
}
function reset_val(){
	$("#id").val("");
	$("#sub_type_name").val("");
	load_types();
}
function delete_(id){
	if (confirm('Are You Sure To Delete')) {
	var data_details={
		"table": 'type_master_for_optical',
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
				setTimeout(function(){ location.reload(); }, 3000);	
				//load_item(cou_pag_no);	
			
			 }

		  });
		  
	}
}

</script>
</body>
<!-- END BODY -->
</html>