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
.bold_td_big {
	font-size:14px !important;
	font-weight:bold !important;
	color:#C00 !important;
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
                  
                </div>
                <div class="col-md-3">
                  <select class="form-control"  id="bill_type" name="bill_type">
                  	<option value="3">All Type Bill</option>
                  	<option value="1">OPD Bill</option>
                    <option value="0">IPD Bill</option>
                  </select>
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
                      <th width="20%" >Payment Type</th>
                      <th width="15%" >Cash</th>
                      <th width="15%" >Card</th>
                      <th width="15%" >UPI</th>
                      <th width="15%" >Cheque</th>
                      <th width="15%" >Grand Total</th>
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
		
            url: 'get_json_data_for_report_details.php?flag=6',
			dataType: 'json',
			data: data_details,
			type: 'POST',
			beforeSend: function(){
			// Show image container

			$('#assets_body').html('');
			$('#title_span').html('');

			//$("#loader").show();
			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="6" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');		

		   },

			success: function (data) {
			 $('#assets_body').html('');
			 var amount_grand_total=0;	
			 var total_bill_time_cash=0;
			 var total_bill_time_card=0;
			 var total_bill_time_upi=0;
			 var total_bill_time_cheque=0;	
			 var total_bill_time_collection=0;	
			 
			 var total_advance_time_cash=0;
			 var total_advance_time_card=0;
			 var total_advance_time_upi=0;
			 var total_advance_time_cheque=0;	
			 var total_advance_time_collection=0;
			 
			 var total_refund_time_cash=0;
			 var total_refund_time_card=0;
			 var total_refund_time_upi=0;
			 var total_refund_time_cheque=0;	
			 var total_refund_time_collection=0;
			 
			 var net_collecton_cash=0;
			 var net_collecton_card=0;
			 var net_collecton_upi=0;
			 var net_collecton_cheque=0;	
			 var net_collecton_collection=0;
			 	 
			 var print_url="";
			  $.each(data, function(index, element) {					  
			 	$('#assets_body').html($('#assets_body').html()+'<tr ><td class="bold_td">'+element.pay_type_name+'</td><td class="bold_td">'+element.bill_time_cash+'</td><td class="bold_td">'+element.bill_time_card+'</td><td class="bold_td">'+element.bill_time_upi+'</td><td class="bold_td">'+element.bill_time_cheque+'</td><td class="bold_td">'+element.grand_total+'</td></tr>');
				if(element.bill_tpe_unique_id=='1'){					 
					 total_bill_time_cash=element.bill_time_cash;
					 total_bill_time_card=element.bill_time_card;
					 total_bill_time_upi=element.bill_time_upi;
					 total_bill_time_cheque=element.bill_time_cheque;	
					 total_bill_time_collection=element.grand_total;	
				}
				if(element.bill_tpe_unique_id=='2'){					 
					 total_advance_time_cash=element.bill_time_cash;
					 total_advance_time_card=element.bill_time_card;
					 total_advance_time_upi=element.bill_time_upi;
					 total_advance_time_cheque=element.bill_time_cheque;	
					 total_advance_time_collection=element.grand_total;	
				}
				if(element.bill_tpe_unique_id=='3'){					 
					 total_refund_time_cash=element.bill_time_cash;
					 total_refund_time_card=element.bill_time_card;
					 total_refund_time_upi=element.bill_time_upi;
					 total_refund_time_cheque=element.bill_time_cheque;	
					 total_refund_time_collection=element.grand_total;	
				}
				
				amount_grand_total=parseInt(amount_grand_total)+parseInt(element.grand_total);
				title_span=element.title_span;	
			
		 	});
			 net_collecton_cash=(parseInt(total_bill_time_cash)+parseInt(total_advance_time_cash))-parseInt(total_refund_time_cash);
			 net_collecton_card=(parseInt(total_bill_time_card)+parseInt(total_advance_time_card))-parseInt(total_refund_time_card);
			 net_collecton_upi=(parseInt(total_bill_time_upi)+parseInt(total_advance_time_upi))-parseInt(total_refund_time_upi);
			 net_collecton_cheque=(parseInt(total_bill_time_cheque)+parseInt(total_advance_time_cheque))-parseInt(total_refund_time_cheque);	
			 net_collecton_collection=(parseInt(total_bill_time_collection)+parseInt(total_advance_time_collection))-parseInt(total_refund_time_collection);
			 
			$('#assets_body').html($('#assets_body').html()+'<tr ><td class="bold_td_big">Total Collection</td><td class="bold_td_big">'+net_collecton_cash+'</td><td class="bold_td_big">'+net_collecton_card+'</td><td class="bold_td_big">'+net_collecton_upi+'</td><td class="bold_td_big">'+net_collecton_cheque+'</td><td class="bold_td_big">'+net_collecton_collection+'</td></tr>');
			
			
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


</script> 

<!-- END PAGE CONTAINER --> 
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
