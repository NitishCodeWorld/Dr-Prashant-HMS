<?php
include 'conn.php';

?>
<?php include "header_inventory.php"; ?>

<!-- BEGIN PAGE CONTAINER -->
<style>
.defualt_td {
	font-size:10px !important;
}
.defualt_td_spcl {
	font-size:9px !important;
}
.bold_td {
	font-size:12px !important;
	font-weight:bold !important;
}
.bord {
	border:none !important;
}
.bord_bott {
	border-left:none !important;
	border-right:none !important;
	border-top:none !important;
	border-bottom:2px solid #000 !important;
}
.bord_top {
	border-left:none !important;
	border-right:none !important;
	border-bottom:none !important;
	border-top:2px solid #000 !important;
}
</style>

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
            <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase" id="title_span">OPD Patient Report</span></div>
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
              <div class="col-md-12">
                <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">From Date</label>
                  <input type="text" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo date("d-m-Y"); ?>" />
                  </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">To Date</label>
                  <input type="text" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo date("d-m-Y"); ?>" />
                  <input type="hidden" class="form-control" placeholder="Select To Date" id="bill_type" name="bill_type" value="1" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Doctor</label>
                    <select class=" form-control select2" name="selected_doc_optom_id" id="selected_doc_optom_id"  >
                      <option value="0">(None)</option>
                      <?php 

								  $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5'  AND `users`.`del_flag`='0' ORDER BY `user_infos`.`name` ASC ";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {		

									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';

								 }

					 			?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                  <button type="button" name="submit" id="submit" class="btn red" title="Submit" onclick="date_wise_db();">Filter</button>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <p>&nbsp;</p>
              </div>
              <div class="col-md-12" style="overflow:auto">
                <table class="table table-striped table-hover table-bordered" id="asset_entry_data">
                  <thead>
                    <tr>
                      <th width="5%" >Sl. No</th>
                      <th width="10%" >UHID</th>
                      <th width="10%" >Date</th>                      
                      <th width="15%" >Patient Name</th>
                      <th width="5%" >Age</th>
                      <th width="10%" >Phone No.</th>                      
                      <th width="10%" >Visit Purpose</th>
                      <th width="10%" >Optometrist</th>
                      <th width="10%" >Doctor</th> 
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
	
	$("#from_date").datepicker({
		format: 'dd-mm-yyyy'
	});
	$("#to_date").datepicker({
	   format: 'dd-mm-yyyy'
	});
	
	$("#selected_doc_optom_id").select2();

 });


var tab_asset_entry="";

load_admssion_details();

function load_admssion_details(){	

if(tab_asset_entry!="") tab_asset_entry.destroy();
	var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val(),
					"bill_type": $("#bill_type").val(),	
					"doc_id": $("#selected_doc_optom_id").val()				
	}
	var title_span="";
	
	$.ajax({



            url: 'get_json_data_for_report_details.php?flag=10',

			dataType: 'json',
			data: data_details,
			type: 'POST',
			beforeSend: function(){
			// Show image container

			$('#assets_body').html('');
			$('#title_span').html('');

			//$("#loader").show();
			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="9" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');		

		   },

			success: function (data) {
			 $('#assets_body').html('');
			 var print_url="";
			  $.each(data, function(index, element) {
				  	
			  		 print_url="<?php echo ADMIN_URL.'printPrescription_for_emr.php?id=';  ?>"+element.id;
				 
				
			 	$('#assets_body').html($('#assets_body').html()+'<tr ><td class="defualt_td">'+element.sl_no+'</td><td class="defualt_td">'+element.mrd_no+'</td><td class="defualt_td"><a href="'+print_url+'" target="_blank" title="Prescription Print" style="color:#0a5595 !important;">'+element.created_on+'</a></td><td class="defualt_td">'+element.patient_name+'</td><td class="defualt_td">'+element.age+'</td><td class="defualt_td">'+element.mobile+'</td><td class="defualt_td">'+element.purpose_visit_name+'</td><td class="defualt_td">'+element.optom_name+'</td><td class="defualt_td">'+element.pri_doct+'</td></tr>');
				// '+element.paid_advance_total+'
				
					 title_span=element.title_span;
		 	});
			// '+advance_grand_total+'
			
			$('#title_span').html(title_span);
			document.title = title_span;

				tab_asset_entry=$("#asset_entry_data").DataTable( {

					"destroy": true,
					"bSortable": false, 
					"bFilter": true,
					"bSort": false, 
					"aaSorting": [[0]], 

					dom: 'Bfrtip',

					"pageLength": 50,

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
function date_wise_db(){
	load_admssion_details();
}

</script> 

<!-- END PAGE CONTAINER --> 
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
