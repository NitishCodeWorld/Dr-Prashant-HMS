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
                  <input type="hidden" class="form-control" placeholder="Select To Date" id="bill_type" name="bill_type" value="0" />
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
                      <th width="10%" >Sl No.</th>
                      <th width="10%" >RegID</th>
                      <th width="10%" >Patient Name</th>
                      <th width="10%" >Bill No.</th>
                      <th width="10%" >Insur. Amt</th>
                      <th width="10%" >Adjusted Amt.</th>
                      <th width="10%" >TDS</th>
                      <th width="10%" >Discount</th>
                      <th width="10%" >Cl_Date</th>
                      <th width="10%" >Party Name</th>
                      <th width="10%" >Remarks</th>
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
		
            url: 'get_json_data_for_report_details.php?flag=9',
			dataType: 'json',
			data: data_details,
			type: 'POST',
			beforeSend: function(){
			// Show image container

			$('#assets_body').html('');
			$('#title_span').html('');

			//$("#loader").show();
			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="11" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');		

		   },

			success: function (data) {
			 $('#assets_body').html('');
				var net_amt_grand_total=0;
				var recovery_grand_total=0;
				var tds_grand_total=0;
				var discount_tpa_grand_total=0;
				var total_tpa_amount_grand_total=0;	
				var print_url="";
				var extra_info="";
			  $.each(data, function(index, element) {	
			  
			    print_url="<?php echo ADMIN_URL.'print_final_bill_for_ipd_new.php?id=';  ?>"+element.id;
			  		  
			 	$('#assets_body').html($('#assets_body').html()+'<tr ><td class="defualt_td">'+element.sl_no+'</td><td class="defualt_td">'+element.hospital_number+'</td><td class="defualt_td">'+element.patient_name+'</td><td class="defualt_td"><a href="'+print_url+'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'+element.bill_no+'</a></td><td class="defualt_td">'+element.net_amt+'</td><td class="defualt_td">'+element.recovery_amt+'</td><td class="defualt_td">'+element.tds+'</td><td class="defualt_td">'+element.discount_tpa+'</td><td class="defualt_td">'+element.due_recieved_date+'</td><td class="defualt_td">'+element.tpa_company+'</td><td class="defualt_td">'+element.remarks_tpa+'</td></tr>');
				var net_amt=element.net_amt;
				if ((isNaN(net_amt)) || (net_amt == '')) {
					net_amt = 0;
				}
				var recovery_amt=element.recovery_amt;
				if ((isNaN(recovery_amt)) || (recovery_amt == '')) {
					recovery_amt = 0;
				}
				var tds=element.tds;
				if ((isNaN(tds)) || (tds == '')) {
					tds = 0;
				}
				var discount_tpa=element.discount_tpa;
				if ((isNaN(discount_tpa)) || (discount_tpa == '')) {
					discount_tpa = 0;
				}
				
				
				net_amt_grand_total=parseInt(net_amt_grand_total)+parseInt(net_amt);
				recovery_grand_total=parseInt(recovery_grand_total)+parseInt(recovery_amt);
				tds_grand_total=parseInt(tds_grand_total)+parseInt(tds);
				discount_tpa_grand_total=parseInt(discount_tpa_grand_total)+parseInt(discount_tpa);				
				title_span=element.title_span;	
			
		 	});
			
			/*$('#assets_body').html($('#assets_body').html()+'<tr ><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'+net_amt_grand_total+'</td><td class="bold_td bord_bott">'+recovery_grand_total+'</td><td class="bold_td bord_bott">'+tds_grand_total+'</td><td class="bold_td bord_bott">'+discount_tpa_grand_total+'</td><td class="bold_td bord_bott">'+total_tpa_amount_grand_total+'</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td></tr>');*/
			if(net_amt_grand_total>0){
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
