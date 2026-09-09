<?php
include 'conn.php';
$discharge_id=$_GET['discharge_id'];

if($discharge_id!=''){
	$deleted_time=date('Y-m-d H:i:s');
	$deleted_by=$_SESSION['id'];
	
	$sql="UPDATE patient_discharge_summary set `del_flag`='1',`deleted_time`='".$deleted_time."',`deleted_by`='".$deleted_by."' where id='".$discharge_id."'";
	mysqli_query($conn,$sql) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Patient Delete Sucessfully")));
	$msg='Delete Data.....';
	$redirectUrl=ADMIN_URL.'discharge_dashboadrd.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
?>
<?php include "header_inventory.php"; ?>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container">

<!-- BEGIN PAGE HEAD -->

<div class="page-head">
  <div class="container-fluid"> 
    
    <!-- BEGIN PAGE TITLE -->
    
    <div class="page-title">
      <h1><small>Welcome to EMR Dashboard</small></h1>
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"> Dashboard </li>
      </ul>
    </div>
    
    <!-- END PAGE TITLE --> 
    
  </div>
</div>

<!-- END PAGE HEAD --> 

<!-- BEGIN PAGE CONTENT -->

<div class="page-content">
  <div class="container-fluid"> 
    
    <!-- BEGIN PAGE CONTENT INNER -->
    
    <div class="row margin-top-10">
      <div class="col-md-12"> 
        
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        
        <div class="portlet light">
          <div class="portlet-title">
            <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Patients Discharge Record</span></div>
            <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
          </div>
          <div class="portlet-body">
            <div class="row number-stats margin-bottom-30">
              <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}else{ echo '<div class="alert alert-success" id="alert_msg" style="display:none;">';}?>
                <button class="close" data-close="alert"></button>
                <span id="error_msg">
                <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg']; echo '</div>';}?>
                </span> </div>
            </div>
            <p>&nbsp;</p>
            <div class="table-toolbar">
              <div class="table-toolbar">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <div class="col-md-2"> </div>
                  <div class="col-md-3">
                    <select class="form-control" name="type" id="type">
                      <option value="1"  >UHID No./ MRD / Hospital No.</option>
                      <option value="2"  >Name</option>
                      <option value="3" >phone</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <input type="text" id="srch" name="srch" class="form-control" value="" placeholder="Enter value">
                  </div>
                  <div class="col-md-1">
                    <button type="button" name="submit" id="submit" class="btn blue" title="Submit" onclick="old_pt_search_db(1);">Search</button>
                  </div>
                  <div class="col-md-3"> </div>
                  <div class="col-md-12">
                    <p><br/>
                    </p>
                  </div>
                  <table class="table table-striped table-hover table-bordered" id="asset_entry_data_for_old_db">
                    <thead>
                      <tr>
                        <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                        <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No</th>
                        <th class="draggable" data-column="asset_name" style="cursor: move;">OLD Prefix</th>
                        <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Name</th>
                        <th class="draggable" data-column="asset_name" style="cursor: move;">Reg. Date</th>
                        <th class="draggable" data-column="asset_name" style="cursor: move;">DOB</th>
                        <th class="draggable" data-column="asset_name" style="cursor: move;">Gender</th>
                        <th class="draggable" data-column="asset_name" style="cursor: move;">Phone No.</th>
                        <th class="draggable" data-column="asset_name" style="cursor: move;">Address</th>
                        <th class="print_ignore"><span>Action</span></th>
                      </tr>
                    </thead>
                    <tbody id="assets_body_for_old_db">
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo date("d-m-Y"); ?>" />
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo date("d-m-Y"); ?>" />
                </div>
                <div class="col-md-3">
                 <input type="text" class="form-control" placeholder="Select To Date" id="uhid_no_search" name="uhid_no_search" value="" />
                </div>
                <div class="col-md-3">
                  <button type="button" name="submit" id="submit" class="btn red" title="Submit" onclick="date_wise_db();">Filter</button>
                </div>
              </div>
              <div class="col-md-12">
                <p>&nbsp;</p>
              </div>
              <div class="col-md-12" style="overflow:auto">
                <table class="table table-striped table-hover table-bordered" id="asset_entry_data">
                  <thead>
                    <tr>
                      <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                      <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No.</th>
                      <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Details</th>
                      <th class="draggable" data-column="asset_name" style="cursor: move;">Admitting Doctor / Optom</th>
                      <th class="draggable" data-column="asset_name" style="cursor: move;">Admission. Date</th>
                      <th class="draggable" data-column="asset_name" style="cursor: move;">Discharge Date</th>
                      <th class="draggable" data-column="asset_name" style="cursor: move;">Details</th>
                      <th class="print_ignore"><span>Action</span></th>
                    </tr>
                  </thead>
                  <tbody id="assets_body">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <!-- END EXAMPLE TABLE PORTLET--> 
          
        </div>
      </div>
      
      <!-- END PAGE CONTENT INNER --> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTENT --> 
  
</div>
<?php include("footer_inevntory.php"); ?>
<script>

 $(document).ready( function() {       

setTimeout('$("#alert_msg").hide()',3000);
	$(".table-striped>tbody>tr:nth-of-type(odd)").removeClass("odd");
	$(".table-striped>tbody>tr:nth-of-type(even)").removeClass("even");
	$("#model_close").click(function(){
		location.reload();
	});
	$("#model_close2").click(function(){
		location.reload();
	});
	$("#model_close3").click(function(){
		location.reload();
	});
	 $("#from_date").datepicker({
	   format: 'dd-mm-yyyy'
   	});
   $("#to_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
 });



function purpose(id){

	var purpose = prompt("Please enter reason");
	if (purpose != null && purpose != '') {
		location.href = '<?php echo ADMIN_URL; ?>action/invoice_hospital_bill_action.php?id='+id+'&a=delAdvanceBill&reason='+purpose;
	}else{
		alert("Please give proper reason for bill cancel!!!");
	}

}
var tab_asset_entry_for_old_db="";
old_pt_search_db(0);
function old_pt_search_db(fl){
	
	if(tab_asset_entry_for_old_db!="") tab_asset_entry_for_old_db.destroy();
	var type=$('#type').val();
	var srch=$('#srch').val();
	if(fl=='1'){
	if(srch==''){
		alert("please enter search value!!");
		return false; 	
	}
	}
	$.ajax({

				type : "POST",

				url : "<?php echo ADMIN_URL; ?>ajax/old_db_ajax.php?flag=1",
				dataType : "json",

				data : "type="+type+"&srch="+srch+"&page_name=discharge",

				success : function(data) {	
				 $('#assets_body_for_old_db').html('');
	
				  $.each(data, function(index, element) {
					$('#assets_body_for_old_db').html($('#assets_body_for_old_db').html()+'<tr ><td>'+element.sl+'</td><td><b>'+element.uhid_no+'</b></td><td><b>'+element.old_prefix+'</b></td><td><b>'+element.patient_name+'</b></td><td><b>'+element.registration_date+'</b></td><td><b>'+element.dob+'</b></td><td>'+element.old_gender+'</td><td>'+element.phone_no+'</td><td>'+element.address+'</td><td>'+element.action_tab+'</td></tr>');
				});
	
					tab_asset_entry_for_old_db=$("#asset_entry_data_for_old_db").DataTable( {
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
					//$("#filter_show_all_data").prop("onclick", null).off("click");
					}

		});
}
var tab_asset_entry="";

load_admssion_details();

function load_admssion_details(){	

if(tab_asset_entry!="") tab_asset_entry.destroy();
	var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val(),	
					"uhid_no": $("#uhid_no_search").val()		
	}
	$.ajax({
            url: 'get_json_data_for_ipd_details.php?flag=7',
			dataType: 'json',
			data: data_details,
			type: 'POST',
			beforeSend: function(){
			// Show image container
			$('#assets_body').html('');
			//$("#loader").show();
			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');			
		   },
			success: function (data) {
			 $('#assets_body').html('');
			  $.each(data, function(index, element) {
			    var background_color="style='background-color: "+element.rowclass+";'";  
			 	$('#assets_body').html($('#assets_body').html()+'<tr '+background_color+'><td>'+element.sl_no+'</td><td><b>'+element.uhid_no+'</b></td><td><b>Name: '+element.prefix+' '+element.patient_name+'<br>'+element.phone_no+'<br>'+element.age+'( '+element.gender+' )'+'</b></td><td><b>'+element.admiting_doctor+'</b></td><td><b>'+element.registration_date+' '+element.registration_time+'</b></td><td><b>'+element.discharge_date+' '+element.discharge_time+'</b></td><td>'+element.data_details+'</td><td>'+element.action_tab+'</td></tr>');

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
				});
				//$("#filter_show_all_data").prop("onclick", null).off("click");
			 }
		  });
}
function date_wise_db(){
	load_admssion_details();
}

</script> 

<!-- END PAGE CONTAINER --> 
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
