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
            <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase" id="title_span">Advance Billing Dashbaoard</span></div>
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
                  <input type="text" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo date("d-m-Y"); ?>" />
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo date("d-m-Y"); ?>" />
                  <input type="hidden" class="form-control" placeholder="Select To Date" id="bill_type" name="bill_type" value="1" />
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
                      <th width="5%" >Sl. No</th>
                      <th width="15%" >Receipt No.</th>
                      <th width="10%" >RegID</th>
                      <th width="15%" >Patient Name</th>
                      <th width="12%" >Amount INR</th>
                      <th width="15%" >Pay Type</th>
                      <th width="13%" >Doctor Name</th>
                      <th width="15%" >User Remarks</th>
                    </tr>
                  </thead>
                  <tbody id="assets_body">
                  </tbody>
                </table>
              </div>
            </div>
            
            <div class="table-toolbar">
              <div class="col-md-12">
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="Select From Date" id="from_date_for_ipd" name="from_date_for_ipd" value="<?php echo date("d-m-Y"); ?>" />
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="Select To Date" id="to_date_for_ipd" name="to_date_for_ipd" value="<?php echo date("d-m-Y"); ?>" />
                  <input type="hidden" class="form-control" placeholder="Select To Date" id="bill_type_for_ipd" name="bill_type_for_ipd" value="0" />
                </div>
                <div class="col-md-3">
                  <button type="button" name="submit" id="submit" class="btn red" title="Submit" onclick="date_wise_db_for_ipd();">Filter</button>
                </div>
              </div>
              <div class="col-md-12">
                <p>&nbsp;</p>
              </div>
              <div class="col-md-12" style="overflow:auto">
                <table class="table table-striped table-hover table-bordered" id="asset_entry_data_for_ipd">
                  <thead>
                    <tr>
                      <th width="5%" >Sl. No</th>
                      <th width="15%" >Receipt No.</th>
                      <th width="10%" >RegID</th>
                      <th width="15%" >Patient Name</th>
                      <th width="12%" >Amount INR</th>
                      <th width="15%" >Pay Type</th>
                      <th width="13%" >Doctor Name</th>
                      <th width="15%" >User Remarks</th>
                    </tr>
                  </thead>
                  <tbody id="assets_body_for_ipd">
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
	$("#from_date_for_ipd").datepicker({
		format: 'dd-mm-yyyy'
	});
	$("#to_date_for_ipd").datepicker({
	   format: 'dd-mm-yyyy'
	});

 });


var tab_asset_entry="";

load_admssion_details();

function load_admssion_details(){	

if(tab_asset_entry!="") tab_asset_entry.destroy();
	var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val(),
					"bill_type": $("#bill_type").val()				
	}
	var title_span="";
	
	$.ajax({
		
            url: 'get_json_data_for_report_details.php?flag=3',
			dataType: 'json',
			data: data_details,
			type: 'POST',
			beforeSend: function(){
			// Show image container

			$('#assets_body').html('');
			$('#title_span').html('');

			//$("#loader").show();
			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');		

		   },

			success: function (data) {
			 $('#assets_body').html('');
			 var amount_grand_total=0;			 
			 var print_url="";
			  $.each(data, function(index, element) {
				 
			  		 print_url="<?php echo ADMIN_URL.'print_advance_final_bill.php?id=';  ?>"+element.id;
					  
			 	$('#assets_body').html($('#assets_body').html()+'<tr ><td class="defualt_td">'+element.sl_inner+'</td><td class="defualt_td"><a href="'+print_url+'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'+element.bill_no+'</a></td><td class="defualt_td">'+element.hospital_number+'</td><td class="defualt_td">'+element.prefix+' '+element.name+'</td><td class="defualt_td">'+element.advance_amt+'</td><td class="defualt_td">'+element.pay_mode+'</td><td class="defualt_td">'+element.ini+'</td><td class="defualt_td">'+element.user_remarks+'</td></tr>');
				amount_grand_total=parseInt(amount_grand_total)+parseInt(element.advance_amt);
				title_span=element.title_span;	
			
		 	});
			
			$('#assets_body').html($('#assets_body').html()+'<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'+amount_grand_total+'</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td></tr>');
			if(amount_grand_total>0){
				$('#title_span').html(title_span);
				//document.title = title_span;
			}
				tab_asset_entry=$("#asset_entry_data").DataTable( {

					"destroy": true,
					"bSortable": false, 
					"bFilter": true,
					"bSort": false, 
					"aaSorting": [[0]], 

					dom: 'Bfrtip',
					"buttons": [
						{
							extend: 'collection',
							text : 'Download',
							 orientation: 'landscape',
							pageSize: 'LEGAL',
							buttons: [	
								{ extend: 'excelHtml5', footer: true, title: title_span },
								{ extend: 'csvHtml5', footer: true, title: title_span },
								{ extend: 'pdfHtml5', footer: true, title: title_span},
								{ extend: 'print', footer: true, title: title_span }
							]
						}   
					],

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


var tab_asset_entry_for_ipd="";

load_admssion_details_for_ipd();

function load_admssion_details_for_ipd(){	

if(tab_asset_entry_for_ipd!="") tab_asset_entry_for_ipd.destroy();
	var data_details={
					"from_date": $("#from_date_for_ipd").val(),	
					"to_date": $("#to_date_for_ipd").val(),
					"bill_type": $("#bill_type_for_ipd").val()				
	}
	var title_span="";
	
	$.ajax({
		
            url: 'get_json_data_for_report_details.php?flag=3',
			dataType: 'json',
			data: data_details,
			type: 'POST',
			beforeSend: function(){
			// Show image container

			$('#assets_body_for_ipd').html('');
			//$('#title_span').html('');

			//$("#loader").show();
			$('#assets_body_for_ipd').html($('#assets_body_for_ipd').html()+'<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');		

		   },

			success: function (data) {
			 $('#assets_body_for_ipd').html('');
			 var amount_grand_total=0;			 
			 var print_url="";
			  $.each(data, function(index, element) {
				 
			  		 print_url="<?php echo ADMIN_URL.'print_advance_final_bill.php?id=';  ?>"+element.id;
					  
			 	$('#assets_body_for_ipd').html($('#assets_body_for_ipd').html()+'<tr ><td class="defualt_td">'+element.sl_inner+'</td><td class="defualt_td"><a href="'+print_url+'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'+element.bill_no+'</a></td><td class="defualt_td">'+element.hospital_number+'</td><td class="defualt_td">'+element.prefix+' '+element.name+'</td><td class="defualt_td">'+element.advance_amt+'</td><td class="defualt_td">'+element.pay_mode+'</td><td class="defualt_td">'+element.ini+'</td><td class="defualt_td">'+element.user_remarks+'</td></tr>');
				amount_grand_total=parseInt(amount_grand_total)+parseInt(element.advance_amt);
				title_span=element.title_span;	
			
		 	});
			
			$('#assets_body_for_ipd').html($('#assets_body_for_ipd').html()+'<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'+amount_grand_total+'</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td></tr>');
			if(amount_grand_total>0){
				$('#title_span').html(title_span);
				//document.title = title_span;
			}
				tab_asset_entry_for_ipd=$("#asset_entry_data_for_ipd").DataTable( {

					"destroy": true,
					"bSortable": false, 
					"bFilter": true,
					"bSort": false, 
					"aaSorting": [[0]], 

					dom: 'Bfrtip',
					"buttons": [
						{
							extend: 'collection',
							text : 'Download',
							 orientation: 'landscape',
							pageSize: 'LEGAL',
							buttons: [	
								{ extend: 'excelHtml5', footer: true, title: title_span },
								{ extend: 'csvHtml5', footer: true, title: title_span },
								{ extend: 'pdfHtml5', footer: true, title: title_span},
								{ extend: 'print', footer: true, title: title_span }
							]
						}   
					],

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
function date_wise_db_for_ipd(){
	load_admssion_details_for_ipd();
}

</script> 

<!-- END PAGE CONTAINER --> 
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
