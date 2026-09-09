<?php
include "conn.php"; // Using database connection file here
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
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <div class="col-md-2">
            <label>From</label>
            <input type="text" class="form-control" id="from_" />
          </div>
          <div class="col-md-2">
            <label>To</label>
            <input type="text" class="form-control" id="to_" />
          </div>
          <div class="col-md-2" style="padding-top:25px">
            <button class="btn blue" onClick="load_sales()">Go</button>
          </div>
          <div class="col-md-2" style="padding-top:25px">
            <table width="100%" cellpadding="3" cellspacing="3">
              <thead>
                <tr>
                  <th>Cash</th>
                  <th>Card</th>
                  <th>UPI</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td id="cash_">0.00</td>
                  <td id="card_">0.00</td>
                  <td id="upi_">0.00</td>
                  <td id="total_">0.00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
        
          <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">
            <caption>
            All Items
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Sl. </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Invoice </span></th>
                <th class="draggable" data-column="date_" style="cursor: move;"><span>Date </span></th>
                <th class="draggable" data-column="category_name" style="cursor: move;"><span>Cash </span></th>
                <th class="draggable" data-column="sub_cat"><span>Card </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>UPI </span></th>
                <th class="draggable right" data-column="size" style="cursor: move;"><span>Total </span></th>
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
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

let tab_asset_entry="";
//load_sales();

$( document ).ready(function() {

	$("#from_").datepicker({
	   format: 'dd-mm-yyyy'
   }).on('changeDate', function(e){
    $(this).datepicker('hide');
});
   
   $("#to_").datepicker({
	   format: 'dd-mm-yyyy'
   }).on('changeDate', function(e){
    $(this).datepicker('hide');
});

});

function load_sales(){

$("#assets_body").html('<tr><td colspan="8" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');

let data_={
	"from": $("#from_").val(),
	"to": $("#to_").val(),
}

if(tab_asset_entry!="") tab_asset_entry.destroy();
$.ajax({
			
            url: 'get_json_data_inventory.php?flag=50',
			type: 'POST',
			dataType: 'json',
			data:data_,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				let html="<tr>";
				let total=0;
				let cash_total=0;
				let card_total=0;
				let upi_total=0;
				$sl_counter=1;
				let color_code="";
				let cancel_="";
				 $.each(data, function(index, element) {
				 	color_code="";
					cancel_="";
				 	if(element.status=="0"){
					 color_code="background:#ff0000; color:#ffffff";
					 cancel_="(cancelled)";
					}
					if(element.status=="1")	total =parseFloat(total)+parseFloat(element.amount); 
					html+="<td style='"+color_code+"'>"+$sl_counter+"</td>";
					if(element.mode=="cash"){
						html+="<td style='"+color_code+"'><a href='sales_invoice_print.php?inv_id="+element.invoice_id+"' style='"+color_code+"' target='_blank'>"+element.invoice_number+"</a> "+cancel_+"</td><td style='"+color_code+"'>"+element.date+"</td><td style='"+color_code+"'>"+element.amount+"</td><td style='"+color_code+"'></td><td style='"+color_code+"'></td><td style='"+color_code+"'>"+element.amount+"</td>";
						if(element.status=="1")	cash_total =parseFloat(cash_total)+parseFloat(element.amount); 	
					}else if(element.mode=="card"){
						html+="<td style='"+color_code+"'><a href='sales_invoice_print.php?inv_id="+element.invoice_id+"' target='_blank'>"+element.invoice_number+"</a></td><td style='"+color_code+"'>"+element.date+"</td><td style='"+color_code+"'></td><td style='"+color_code+"'>"+element.amount+"</td><td style='"+color_code+"'></td><td style='"+color_code+"'>"+element.amount+"</td>";
						if(element.status=="1") card_total =parseFloat(card_total)+parseFloat(element.amount);
					}else if(element.mode=="upi"){
						html+="<td style='"+color_code+"'><a href='sales_invoice_print.php?inv_id="+element.invoice_id+"' target='_blank'>"+element.invoice_number+"</a></td><td style='"+color_code+"'>"+element.date+"</td><td style='"+color_code+"'></td><td style='"+color_code+"'></td><td style='"+color_code+"'>"+element.amount+"</td><td style='"+color_code+"'>"+element.amount+"</td>";
						if(element.status=="1") upi_total =parseFloat(upi_total)+parseFloat(element.amount);
					}
					html+="</tr>";
					$sl_counter++;			
				 });
				 html+="<tr style='font-weight:bold'><td></td><td></td><td>TOTAL</td><td>"+cash_total.toFixed(2)+"</td><td>"+card_total.toFixed(2)+"</td><td>"+upi_total.toFixed(2)+"</td><td>"+total.toFixed(2)+"</td></tr>";
				 $("#cash_").html(cash_total.toFixed(2));
				 $("#card_").html(card_total.toFixed(2));
				 $("#upi_").html(upi_total.toFixed(2));
				 $("#total_").html(total.toFixed(2));
				 $("#assets_body").html(html);	
				//$("#staticBackdrop").modal('hide');
				
			}
			
		});

}

</script>
</body>
<!-- END BODY -->
</html>