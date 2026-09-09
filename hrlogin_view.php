<?php
include 'function.php';
include "conn.php"; // Using database connection file here

if(isset($_REQUEST['delete']))
{
$status=1;
$deleted_by=$_SESSION['id'];
$deleted_time=date('Y-m-d H:i:s');	
$sql = "UPDATE `hr_login` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `users_id`='".$_REQUEST['delete']."'";
$result=$conn->query($sql);
if ($conn->query($sql) === TRUE)
{
	$sql6 = $conn->query("UPDATE `users` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `id`='".$_REQUEST['delete']."'");
	
$msg= "Record deleted successfully";
$redirectUrl=ADMIN_URL.'hrlogin_view.php?msg='.$msg;
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
} 
else 
{
$msg= "Error deleting record: " . $conn->error;
}
}
if(isset($_REQUEST['users_id_for_inactive']))
{
$users_id_for_inactive=$_REQUEST['users_id_for_inactive'];
$inactive_flag=$_REQUEST['inactive_flag'];
$modified_by=$_SESSION['id'];
$modified_time=date('Y-m-d H:i:s');	
$sql = "UPDATE `hr_login` SET `inactive_status`='".$inactive_flag."',`modified_by`='".$modified_by."',`modified_time`='".$modified_time."'  WHERE `users_id`='".$users_id_for_inactive."'";
$result=$conn->query($sql);
if ($conn->query($sql) === TRUE)
{
	$sql6 = $conn->query("UPDATE `users` SET `del_flag`='".$status."',`deleted_by`='".$deleted_by."',`deleted_time`='".$deleted_time."'  WHERE `id`='".$users_id_for_inactive."'");
	
$msg= "Record Updated successfully";
$redirectUrl=ADMIN_URL.'hrlogin_view.php?msg='.$msg;
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
} 
else 
{
$msg= "Error Updating record: " . $conn->error;
}
}
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
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">User / Employee record</span></div>
            </div>
            <!-- BEGIN FORM-->
            <div class="portlet-body">
              <div class="row number-stats margin-bottom-30">
              <div class="row">
                  <div class="col-md-12">                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">EMP ID.</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Enter EMP ID." id="filter_emp_id" name="filter_emp_id" value="" />
                          <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#filter_emp_id').val(''));" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">EMP Name</label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Enter EMP Name" id="filter_emp_name" name="filter_emp_name" value="" />
                          <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#filter_emp_name').val(''));" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Department</label>
                        <div class="input-group">
                          <select class="form-control" id="filter_employee_dept" name="filter_employee_dept">
                            <option value="">All Department</option>
                            <?php
                                $query1="SELECT id,department FROM department_masters Where `del_flag`='0' ORDER BY `department`  ASC" ;
                                          $rslt=$conn->query($query1);
                                          while($row=mysqli_fetch_array($rslt)){
											  //if($row5['employee_dept']==$row['id']) echo 'selected';
                                          echo '<option value="'.$row['id'].'" ';echo '>'.$row['department'].'</option>'; 
                                          }
                              ?>
                          </select>
                          <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#filter_employee_dept').val(''));" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>
                      </div>
                    </div> 
                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Employee Status</label>
                        <div class="input-group">
                          <select class="form-control" id="filter_employee_status" name="filter_employee_status">
                            <option value="">None</option>
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                            
                          </select>
                          <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#filter_employee_status').val(''));" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>
                      </div>
                    </div>
                    
                    
                                      
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">&nbsp;</label>
                        <br/>
                        <div class="input-group">
                          <button type="button" id="filter_submit" name="filter_submit" class="btn red" onclick="filter_load_admssion_details(1);"  >Filter</button>
                          &nbsp;&nbsp; <a href="javascript:void(0);" style="color: #5b9bd1 !important;" id="filter_show_all_data" onClick="($('#filter_emp_id').val(''));($('#filter_emp_name').val(''));($('#filter_employee_dept').val(''));($('#filter_employee_status').val(''));filter_load_admssion_details(1);" title="Show All Data">Show All Data</a> </div>
                      </div>
                    </div>
                  </div>
                </div>
               
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}else{ echo '<div class="alert alert-success" id="alert_msg" style="display:none;">';}?>
                  <button class="close" data-close="alert"></button>
                  <span id="error_msg">
                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?>
                  </span> </div>
                  
                  <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-12">
                    <p>&nbsp;</p>
                  </div>
                  <div class="col-md-3">
                    <div class="btn-group">
                      <button id="new_button_id" class="btn btn-sm green">
                     <a onclick="if(confirm('Are you sure?')) return true; else return false;"  title="New User / Employee" style="color:#fff !important; text-decoration:none" href="<?php echo ADMIN_URL; ?>new_user.php"> New User / Employee</a>
                      </button>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="btn-group pull-right"> 
                    <div class="col-md-12 col-sm-12 col-xs-12 clearfix" style="text-align:right !important; border:none !important;font-weight:bold;"> Active Employee: <span class="btn" style="background-color: #d0e9c6;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Inactive / Resigned Employee: <span class="btn" style="background-color: #bd6e6e;">&nbsp;</span> </div>
                    </div>
                  </div>
                </div>
              </div>
              
              </div>
              
              
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
            <strong>User / Employee List</strong>
            </caption>
            <thead>
              <tr>
                
                <th  class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                    <th  class="draggable" data-column="asset_name" style="cursor: move;">Emp ID</th>
                    <th  class="draggable" data-column="asset_name" style="cursor: move;">Dept. / User Role</th>
                    <th  class="draggable" data-column="asset_name" style="cursor: move;">Name</th>
                    <th  class="draggable" data-column="asset_name" style="cursor: move;">Login ID</th>
                    <th  class="draggable" data-column="asset_name" style="cursor: move;">Password</th>
                    <th  class="draggable" data-column="asset_name" style="cursor: move;">Details</th>
                    <th  class="draggable" data-column="asset_name" style="cursor: move;">Action</th>
              </tr>
            </thead>
            <tbody id="assets_body">
              <!--<tr>
                <td colspan="9" style="text-align:center"><img src="loader.gif" style="width:50px" /></td>
              </tr>-->
            </tbody>
          </table>
          <input type="hidden" name="null_val" id="null_val" value="0" />
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
var null_val=$("#null_val").val();
if(null_val=='1')
{
	
	$("#new_button_id").css("display", "none") ;
}
 $(document).ready( function() {    
 $('input').attr('autocomplete','off');   
setTimeout('$("#alert_msg").hide()',3000);
/*

	$(".table-striped>tbody>tr:nth-of-type(odd)").removeClass("odd");
	$(".table-striped>tbody>tr:nth-of-type(even)").removeClass("even");
	*/
	
	
 });


var tab_asset_entry="";
load_admssion_details();

function load_admssion_details(){	
if(tab_asset_entry!="") tab_asset_entry.destroy();
	$.ajax({

            url: 'get_json_data_for_leave_extra_info_details.php?flag=2',
			dataType: 'json',
			type: 'POST',
			beforeSend: function(){
			// Show image container
			$('#assets_body').html('');
			//$("#loader").show();
			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');			
			$("#filter_submit").prop("disabled", true);	
			$("#filter_show_all_data").attr("onclick", "").unbind("click");
		   },
			success: function (data) {
			 $('#assets_body').html('');
			  $.each(data, function(index, element) {
				  if(element.inactive=='1'){
					  var bg_color='style="background-color: #bd6e6e ; !important"';
				  }
				  if(element.inactive=='0'){
					  var bg_color='style="background-color: #d0e9c6; !important"';
				  }
			 	$('#assets_body').html($('#assets_body').html()+'<tr '+bg_color+' ><td>'+element.sl_no+'</td><td><b>'+element.emp_id+'</b></td><td><b>'+element.department+'</b></td><td><b>'+element.full_name+'</b></td><td><b>'+element.username+'</b></td><td><b>'+element.password+'</b></td><td>'+element.data_details+'</td><td>'+element.action_tab+'</td></tr>');
				if((element.flag_null)=='1'){
					$("#new_button_id").css("display", "none") ;
				}
		 	});
				tab_asset_entry=$("#asset_entry_data").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					"language": {
					  "emptyTable": "No data available......"
					},
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				$("#filter_submit").prop("disabled", false); 
				$("#filter_show_all_data").attr("onclick", "($('#filter_emp_id').val(''));($('#filter_emp_name').val(''));($('#filter_employee_dept').val(''));($('#filter_employee_status').val(''));filter_load_admssion_details(1);").bind("click");
				//$("#filter_show_all_data").prop("onclick", null).off("click");
			 }
		  });

}

function filter_load_admssion_details(filter){	
if(tab_asset_entry!="") tab_asset_entry.destroy();
	var data_details={
					"filter_emp_id": $("#filter_emp_id").val(),	
					"filter_emp_name": $("#filter_emp_name").val(),							
					"filter_employee_dept": $("#filter_employee_dept").val(),
					"filter_employee_status": $("#filter_employee_status").val(),
					"filter": filter
			}
	$.ajax({
            url: 'get_json_data_for_leave_extra_info_details.php?flag=2',
			dataType: 'json',
			type: 'POST',
			data: data_details,
			beforeSend: function(){
			// Show image container
			$('#assets_body').html('');
			//$("#loader").show();
			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');
			$("#filter_submit").prop("disabled", true);	
			$("#filter_show_all_data").attr("onclick", "").unbind("click");
		   },
			success: function (data) {
			 $('#assets_body').html('');					 
			 $.each(data, function(index, element) {
				 if(element.inactive=='1'){
					  var bg_color='style="background-color: #bd6e6e ; !important"';
				  }
				  if(element.inactive=='0'){
					  var bg_color='style="background-color: #d0e9c6; !important"';
				  }				  
			 	$('#assets_body').html($('#assets_body').html()+'<tr '+bg_color+'><td>'+element.sl_no+'</td><td><b>'+element.emp_id+'</b></td><td><b>'+element.department+'</b></td><td><b>'+element.full_name+'</b></td><td><b>'+element.username+'</b></td><td><b>'+element.password+'</b></td><td>'+element.data_details+'</td><td>'+element.action_tab+'</td></tr>');
				if((element.flag_null)=='1'){
					$("#new_button_id").css("display", "none") ;
				}
				});					
			 tab_asset_entry=$("#asset_entry_data").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					'processing': true,
					"language": {						
					  	"emptyTable": "No data available......"
					  
					},
					"initComplete": function(settings, json) {
					//$('#asset_entry_data_filter').hide();
				}				
				} );
				$("#filter_submit").prop("disabled", false); 
				$("#filter_show_all_data").attr("onclick", "($('#filter_emp_id').val(''));($('#filter_emp_name').val(''));($('#filter_employee_dept').val(''));($('#filter_employee_status').val(''));filter_load_admssion_details(1);").bind("click");
			 }
		  });

}
</script>
</body><!-- END BODY -->
</html>