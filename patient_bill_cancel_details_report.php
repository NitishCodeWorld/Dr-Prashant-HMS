<?php
include 'function.php';
include "conn.php"; // Using database connection file here
?>
<?php include "header_inventory.php"; ?>
<style>
.head_span {
	font-size:18px;
	font-weight:bold;
	color:red;
}
.heading_tables{
	font-size:18px;
	font-weight:bold;
	color:red;
}
</style>
<div class="page-container">
  <?php $today=date('Y-m-d'); ?>
  <div class="page-content">
    <div class="container-fluid">
      <div class="row margin-top-10">
        <div class="col-md-12">
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Patients Bills Cancel Record</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo date("d-m-Y"); ?>" />
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo date("d-m-Y"); ?>" />
          </div>
          <div class="col-md-3">
            <select class="form-control" name="bill_tpe" id="bill_tpe">
              <option value="ALL"> ALL </option>
              <option value="opd"> OPD </option>
              <option value="ipd"> IPD </option>
            </select>
          </div>
          <div class="col-md-1">
            <button type="button" name="submit" id="submit" class="btn blue" title="Submit" onclick="get_cancel_details();">Filter</button>
          </div>
          <div class="col-md-2"> </div>
        </div>
      </div>
      <div class="col-md-12">
        <p>&nbsp;</p>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <center>
            <span class="heading_tables" id="advance_cancel_span">Advance Billing Cancel</span>
          </center>
          <table class="table table-striped table-hover table-bordered" id="advance_billing_data">
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Hospital No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Invoice No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Details.</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Doctor</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Billing Details</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Cancel Details</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Payment Mode Details</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Amount</th>
              </tr>
            </thead>
            <tbody id="advance_billing_data_body">
            </tbody>
            <tfoot>
              <tr style="color:#F00;font-size:25px;">
                <td colspan="8" style="text-align:right;">Total</td>
                <td id="advance_total"></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-md-12" style="overflow:auto">
          <center>
            <span class="heading_tables" id="refund_cancel_span">Advance Refund Billing Cancel</span>
          </center>
          <table class="table table-striped table-hover table-bordered" id="refund_billing_data">
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Hospital No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Invoice No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Details.</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Doctor</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Billing Details</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Cancel Details</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Payment Mode Details</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Amount</th>
              </tr>
            </thead>
            <tbody id="refund_billing_data_body">
            </tbody>
            <tfoot>
              <tr style="color:#F00;font-size:25px;">
                <td colspan="8" style="text-align:right;">Total</td>
                <td id="refund_total"></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-md-12" style="overflow:auto">
          <center>
            <span class="heading_tables" id="final_cancel_span">Final Billing Cancel</span>
          </center>
          <table class="table table-striped table-hover table-bordered" id="final_billing_data">
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Hospital No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Invoice No</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Details.</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Doctor</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Billing Details</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Cancel Details</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Payment Mode Details</th>
                <th class="draggable" data-column="asset_name" style="cursor: move;">Amount</th>
              </tr>
            </thead>
            <tbody id="final_billing_data_body">
            </tbody>
            <tfoot>
              <tr style="color:#F00;font-size:25px;">
                <td colspan="8" style="text-align:right;">Total</td>
                <td id="final_total"></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <!-- END PAGE CONTAINER --> 
  
</div>
<?php include("footer_inevntory.php"); ?>
<script>

 $(document).ready( function() {    

 	$('input').attr('autocomplete','off');   

	setTimeout('$("#alert_msg").hide()',3000);
	 $("#from_date").datepicker({
	   format: 'dd-mm-yyyy'
   	});
   $("#to_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
 });
 
 var advance_billing_data='';
 var final_billing_data='';
  var refund_billing_data='';
  get_cancel_details();
function get_cancel_details(){
	if(advance_billing_data!="") advance_billing_data.destroy();
	if(final_billing_data!="") final_billing_data.destroy();
	if(refund_billing_data!="") refund_billing_data.destroy();
	
	var advance_cancel_span="";
	var refund_cancel_span="";
	var final_cancel_span="";
	$('#advance_cancel_span').html(advance_cancel_span);
	$('#refund_cancel_span').html(refund_cancel_span);
	$('#final_cancel_span').html(final_cancel_span);
	advance_cancel_span="Advance Billing Cancel From "+$('#from_date').val()+" To "+$('#to_date').val();
	refund_cancel_span="Advance Refund Billing Cancel From "+$('#from_date').val()+" To "+$('#to_date').val();
	final_cancel_span="Final Billing Cancel From "+$('#from_date').val()+" To "+$('#to_date').val();
	$('#advance_cancel_span').html(advance_cancel_span);
	$('#refund_cancel_span').html(refund_cancel_span);
	$('#final_cancel_span').html(final_cancel_span);
		
	var data_details={
		"from_date": $('#from_date').val(),
		"to_date": $('#to_date').val(),
		"bill_tpe": $('#bill_tpe').val(),
	   }
	$.ajax({
		url: 'get_json_data_for_appr_reports.php?flag=3',
		dataType: 'json',
		data: data_details,
		type: 'POST',
		success: function (data) {
			var html='';
			var html_='';
			var html_refund='';
			var sl=1;
			var total_advance=0;
			var print_url="";	 
			
			$.each(data.advance, function(index, ele) {
			html +='<tr><td>'+sl+'</td><td>'+ele.hospital_number+'</td><td><a href="print_advance_final_bill.php?id='+ele.id+'" target="_blank">'+ele.invo_no+'</a></td><td>'+ele.prefix+' '+ele.name+'<br>'+ele.mobile_prefix+'</td><td>'+ele.admiting_doctor+'</td><td>'+ele.billing_date+' '+ele.billing_time+'<br>Bill Type: '+ele.bill_type+'</td><td>'+ele.deleted_details+'</td><td>'+ele.billing_payment_mode+'</td><td>'+ele.total+'</td></tr>';
			total_advance +=Number(ele.total);	
			sl++;});
			
			var sl_f=1
			var total_final=0;			
			$.each(data.final, function(index, ele_) {
				if(ele_.opd_flag=='0'){	
			  		 print_url="<?php echo ADMIN_URL.'print_final_bill_for_ipd_new.php?id=';  ?>"+ele_.id;
				  }else{
					print_url="<?php echo ADMIN_URL.'print_final_bill_for_opd_new.php?id=';  ?>"+ele_.id;  
				  }
			html_ +='<tr><td>'+sl_f+'</td><td>'+ele_.hospital_number+'</td><td><a href="'+print_url+'" target="_blank">'+ele_.invo_no+'</td><td>'+ele_.prefix+' '+ele_.name+'<br>'+ele_.mobile_prefix+' '+ ele_.mobile+'</td><td>'+ele_.admiting_doctor+'</td><td>'+ele_.billing_date+' '+ele_.billing_time+'<br>Bill Type: '+ele_.bill_type+'</td><td>'+ele_.deleted_details+'</td><td>'+ele_.billing_payment_mode+'</td><td>'+ele_.total+'</td></tr>';	
			total_final +=Number(ele_.total);
			sl_f++;});
			
			var sl_f_refund=1
			var total_refund=0;
			$.each(data.refund, function(index, ele_refund) {				
			print_url="<?php echo ADMIN_URL.'print_refund_advance_final_bill.php?id=';  ?>"+ele_refund.id;				 
			html_refund +='<tr><td>'+sl_f_refund+'</td><td>'+ele_refund.hospital_number+'</td><td><a href="'+print_url+'" target="_blank">'+ele_refund.invo_no+'</td><td>'+ele_refund.prefix+' '+ele_refund.name+'<br>'+ele_refund.mobile_prefix+' '+ ele_refund.mobile+'</td><td>'+ele_refund.admiting_doctor+'</td><td>'+ele_refund.billing_date+' '+ele_refund.billing_time+'<br>Bill Type: '+ele_refund.bill_type+'</td><td>'+ele_refund.deleted_details+'</td><td>'+ele_refund.billing_payment_mode+'</td><td>'+ele_refund.total+'</td></tr>';	
			total_refund +=Number(ele_refund.total);
			sl_f_refund++;});
			
			$('#final_total').html(total_final);
			$('#advance_total').html(total_advance);
			$('#final_billing_data_body').html(html_);
			$('#advance_billing_data_body').html(html);
			$('#refund_total').html(total_refund);
			$('#refund_billing_data_body').html(html_refund);
			
			advance_billing_data=$("#advance_billing_data").DataTable({
					"destroy": true,
					dom: 'Bfrtip',
					"buttons": [
						{
							extend: 'collection',
							text : 'Download',
							 orientation: 'landscape',
							pageSize: 'LEGAL',
							buttons: [	
								{ extend: 'excelHtml5', footer: true, title: advance_cancel_span },
								{ extend: 'csvHtml5', footer: true, title: advance_cancel_span },
								{ extend: 'pdfHtml5', footer: true, title: advance_cancel_span},
								{ extend: 'print', footer: true, title: advance_cancel_span }
							]
						}   
					],
					"pageLength": 15,
					"language": {
					  "emptyTable": "No data available......"
					},
					"initComplete": function(settings, json) {
						//$('#products_filter').hide()
					}
			});
			final_billing_data=$("#final_billing_data").DataTable({
					"destroy": true,
					dom: 'Bfrtip',
					"buttons": [
						{
							extend: 'collection',
							text : 'Download',
							 orientation: 'landscape',
							pageSize: 'LEGAL',
							buttons: [	
								{ extend: 'excelHtml5', footer: true, title: final_cancel_span },
								{ extend: 'csvHtml5', footer: true, title: final_cancel_span },
								{ extend: 'pdfHtml5', footer: true, title: final_cancel_span},
								{ extend: 'print', footer: true, title: final_cancel_span }
							]
						}   
					],
					"pageLength": 15,
					"language": {
					  "emptyTable": "No data available......"
					},
					"initComplete": function(settings, json) {
						//$('#products_filter').hide()
					}
			});
			refund_billing_data=$("#refund_billing_data").DataTable({
					"destroy": true,
					dom: 'Bfrtip',
					"buttons": [
						{
							extend: 'collection',
							text : 'Download',
							 orientation: 'landscape',
							pageSize: 'LEGAL',
							buttons: [	
								{ extend: 'excelHtml5', footer: true, title: refund_cancel_span },
								{ extend: 'csvHtml5', footer: true, title: refund_cancel_span },
								{ extend: 'pdfHtml5', footer: true, title: refund_cancel_span},
								{ extend: 'print', footer: true, title: refund_cancel_span }
							]
						}   
					],
					"pageLength": 15,
					"language": {
					  "emptyTable": "No data available......"
					},
					"initComplete": function(settings, json) {
						//$('#products_filter').hide()
					}
			});
			
		}
	  });
}
</script>
</body><!-- END BODY -->

</html>