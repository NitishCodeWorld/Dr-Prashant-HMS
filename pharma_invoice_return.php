<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_inventory.php"; ?>

<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<style>
.ajax-loader {
	visibility: hidden;
	background-color: rgba(255, 255, 255, 0.7);
	position: absolute;
	z-index: +100 !important;
	width: 100%;
	height:100%;
}
.ajax-loader img {
	position: relative;
	top:50%;
	left:50%;
}
#patient_admit {
	color:#cb1652;
	font-size:14px;
	font-weight:bold;
}
</style>
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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Pharmacy Billing Return For Inside Patient</span></div>
               
               <span style="float:right !important;" class="caption-subject font-green-sharp bold uppercase"> <a style="color:red !important;"  href="<?php echo ADMIN_URL; ?>pharma_invoice_return_for_cash_patient.php" class="iconify" title="Walk In Customer Medicine Return">  <img src="<?php echo ADMIN_URL; ?>icon/right_hand_arrow.png"  title="Walk In Customer Medicine Return"> Walk In Customer Medicine Return </a> </span>
               <!--<span style="float:right !important;" class="caption-subject font-green-sharp bold uppercase"> <a style="color:blue !important;"  href="javascript:void(0)" onclick="reset_temporary_sales_stock()" class="iconify">  Temporary Stock Set to 0 | </a> </span>-->
            </div>
            <!-- BEGIN FORM--> 
            
          </div>
        </div>
      </div>
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet" style="min-height:50px; margin-bottom:0px">
            <div class="portlet-body">
            <div class="col-md-12">
              <div class="col-md-3" style="margin-top:8px; font-weight:bold; text-align:right; padding-right:0px; margin-left:-59px;">Enter Patient UHID No.: &nbsp;&nbsp;</div>
              <div class="col-md-4" style="padding-left:0px; padding-right:2px">
                <!--<input type="text" class="form-control" placeholder="Enter UHID" name="uhid_check_text" id="uhid_check_text" value="<?php if(isset($_REQUEST['hospital_number'])){ echo $_REQUEST['hospital_number']; }?>" />-->
               <div class="form-group">
                    <select name="uhid_check_text" id="uhid_check_text" class="form-control select2">
                      <option value="">Choose..</option>
                      <?php 
                              $sql7="SELECT * FROM `patient_registration_form`  WHERE  `del_flag`='0'   ORDER BY `id` DESC";
                             $result7=$conn->query($sql7) ;
                             while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                             {									 
                                 echo '<option value="'.$row7['uhid_no'].'" '; if($_REQUEST['hospital_number']==$row7['id']){ echo "selected";}  echo '>'.$row7['uhid_no'].' ( '.$row7['patient_name'].' '.$row7['phone_no'].' )</option>';
                             }
                            ?>
                    </select>
                  
                </div>
              </div>
              <div class="col-md-2">
                <button class="btn-circle btn green" onClick="get_patient_details()">Go</button>
              </div>
              <div class="col-md-3" id="prescribe_div_btn" style="display:none;">
                <button class="btn-circle btn blue" onClick="view_medicine_details();view_medicine_prescribe_details();" id="medicine_presc_btn">View Prescribed Medicine List</button>
              </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-12">
                <p>&nbsp;</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="show_all_div_content" style="display:none;">
      
        <div class="row margin-top-10">
          <div class="col-md-12"> 
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet" style="min-height:50px; margin-bottom:0px">
              <div class="portlet-body">
                <div style="clear:both"></div>
                <div class="col-md-3" style="padding-left:0px; padding-right:2px">
                  <label class="control-label">Patient UHID</label>
                  <input type="text" class="form-control" placeholder="Enter UHID" name="uhid" id="uhid" readonly="readonly" />
                  <input type="hidden" class="form-control" placeholder="Enter UHID" name="patient_id" id="patient_id" value="" />
                </div>
                <div class="col-md-3" style="padding-left:0px; padding-right:2px">
                  <label class="control-label">Patient Name</label>
                  <input type="text" class="form-control" placeholder="Customer Name" name="customer_name" id="customer_name" />
                </div>
                <div class="col-md-2" style="padding-left:0px; padding-right:2px">
                  <label class="control-label">Billing Date</label>
                  <input type="text" class="form-control" placeholder="Date" name="inv_date" id="inv_date" value="<?php echo date("d-m-Y") ?>" />
                </div>
                <div style="clear:both"></div>
                <div class="col-md-3" style="padding-left:0px; padding-right:2px">
                  <label class="control-label">Patient Mobile No.</label>
                  <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" id="phone_number" />
                </div>
                <div class="col-md-3" style="padding-left:0px; padding-right:2px">
                  <label class="control-label">Doctor</label>
                  <br />
                  <select id="doctors" class="form-control" style="width:200px">
                    <option value="">-Select Doctor-</option>
                  </select>
                </div>
                <div class="col-md-2" style="padding-left:0px; padding-right:2px">
                  <label class="control-label">Patient Type</label>
                  <select name="patient_type" id="patient_type" class="form-control">
                  </select>
                  <span id="patient_admit"></span>
                </div>
              </div>
            </div>
            <div style="clear:both; margin-top:35px"></div>
            <!-- END PAGE CONTENT INNER --> 
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" style="overflow:auto">
            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Type</label>
                <select class="form-control" id="type_name" onChange="load_sub_types(); load_asset_entry_data()">
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Sub Type</label>
                <select class="form-control" id="sub_type_name" onChange="load_asset_entry_data()"  disabled="disabled" >
                  <option value="">Level 1</option>
                  <option value="">Level 2</option>
                  <option value="">Other</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Item</label>
                <select class="form-control item select2" id="item" onChange="load_batch_codes()"  disabled="disabled" >
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Batch Code</label>
                <!--<input type="text" id="batch_code_val" class="form-control" data-qty="" />-->
                <select id="batch_code_val" class="form-control" onChange="load_stock();load_expiry_date();"  disabled="disabled" >
                </select>
                <input type="hidden" id="temporary_customer_id" class="form-control" value="" />
                <input type="hidden" id="temporary_sales_id" class="form-control" value="" />
                <span id='batch_expiry' style="font-weight:bold;color:#903;"></span> </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for="">Quantity</label>
                <input type="text" id="freeItem_qty" class="form-control"  data-qty="" />
                <span id='stock_qty' style="font-weight:bold"></span> </div>
            </div>
            <div class="col-md-2" style="margin-top:25px">
              <button class="btn green" onClick="add_item()">Add Item</button>
            </div>
            <input type="hidden" name="iop_count" id="iop_count" value="2" />
          </div>
          <div class="col-md-12" id="prescribed_div_medicine" style="display:none;" >
            <table class="table table-striped table-bordered table-hover small" id="pharma_order_data1">
              <div style="margin-top:20px !important;">
                <center>
                  <h3><u> Prescribed Medicine List For Return </u></h3>
                </center>
              </div>
              <caption>
              Prescribe Medicine List
              </caption>
              <thead>
                <tr>
                  <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Sl No. </span></th>
                  <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Prescribe Date </span></th>
                  <th class="draggable" data-column="asset_name" style="cursor: move;"><span>HSN Code </span></th>
                  <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Item Name </span></th>
                  <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Batch Code</span></th>
                  <th class="draggable right" data-column="size" style="cursor: move;"><span>Category </span></th>
                  <th class="draggable right" data-column="size" style="cursor: move;"><span>Sub Category </span></th>
                  <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Sale Qty </span></th>
                  <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Return Qty </span></th>
                  <th class="draggable" data-column="covid_item" style="cursor: move;"><span>In Stock Qty </span></th>
                  <th class="draggable" data-column="covid_item" style="cursor: move;">&nbsp;</th>
                </tr>
              </thead>
              <tbody id="pharma_order_body">
              </tbody>
            </table>
          </div>
          
          <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
        </div>
        <div class="row">
          <div class="col-md-12" style="overflow:auto">
            <table class="table table-striped table-bordered table-hover small" id="asset_entry_data1">
              <caption>
              Order List
              </caption>
              <thead>
                <tr>
                  <th class="draggable" data-column="asset_name" style="cursor: move;"><span>HSN Code </span></th>
                  <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Item Name </span></th>                  
                  <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Batch No. </span></th>
                  <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Mfg. Date (dd-mm-yyyy)</span></th>
                  <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Expiry Date (dd-mm-yyyy)</span></th>
                  <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>Rate </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>Discount Rate </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>Discount Amount </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>Amount </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>GST Rate </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>GST Amount </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>CGST Rate </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>CGST Amount </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>SGST Rate </span></th>
                  <th class="draggable right" data-column="rate" style="cursor: move;"><span>SGST Amount </span></th>
                  <th class="draggable right" data-column="total_amount" style="cursor: move;"><span>Net Amount </span></th>
                  <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
                </tr>
              </thead>
              <tbody id="assets_indent_body">
              </tbody>
              <tfoot>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="12" align="right">Total</td>
                  <td><span id="total_amount"></span></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="12" align="right">Add: CGST</td>
                  <td><span id="CGST_amount_"></span></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="12" align="right">Add: SGST</td>
                  <td><span id="SGST_amount_"></span></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="12" align="right">Net Total</td>
                  <td><span id="net_total_"></span></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="10" align="right">Discount :</td>
                  <td  align="right"><select class="form-control" style="width:80px" id="discount_type"   >
                      <option value="">-Select-</option>
                      <option value="P">% Discount</option>
                      <option value="F">Gross Discount</option>
                    </select></td>
                  <td align="right"><input type="text" id="discount_val" style="width:80px"   value="0" onBlur="calculate_sales()" /></td>
                  <td><span id="discount_total_"></span></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="12" align="right">Round Off </td>
                  <td><span id="round_off_total_"></span></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="12" align="right">Grand Total</td>
                  <td><span id="grand_total_"></span></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="11" align="right">Mode of Payment</td>
                  <td>Cash</td>
                  <td><input type="text" id="cash" style='width:80px' onBlur="calculate_payment()" placeholder="Cash" value="0" /></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="11" align="right">Mode of Payment</td>
                  <td>Card</td>
                  <td><input type="text" id="card" style='width:80px' onBlur="calculate_payment()" placeholder="Card" value="0" /></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="11" align="right">Mode of Payment</td>
                  <td>UPI</td>
                  <td><input type="text" id="UPI" style='width:80px' onBlur="calculate_payment()" placeholder="UPI" value="0" /></td>
                  <td></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="12" align="right"><input id="due_bill" type="checkbox" value="0"  onchange="($(this).prop('checked') ? $(this).val(1) : $(this).val(0))" >
                    Amount Due</td>
                  <td><span id="bal"></span></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="col-md-12" style="text-align:center; margin-bottom:10px">
           <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>loader.gif" class="img-responsive" /> </div>
            <input type="hidden" id="drug_order_id_arr" style='width:80px'  placeholder="UPI" value="" />
            <input type="hidden" id="customer_id_arr" style='width:80px'  placeholder="UPI" value="" />
            <input type="button" class="btn" onClick="save_sales()" value="Save Sales" style="background:#000099;color:#FFFFFF;width:120px" />
            &nbsp;&nbsp;
            <input type="button" class="btn" onClick="save_sales(1)" value="Save & Print" style="background:#000099;color:#FFFFFF;width:120px" />
            &nbsp;&nbsp;
            <input type="button" class="btn" onClick="reset_temporary_save_sales()" value="Reset / Cancel Bill" style="background:#990e00;color:#FFFFFF;width:140px" />
          </div>
          <div style="clear:both; height:15px">&nbsp;</div>
        </div>
       
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
         <div style="margin-top:20px !important;">
                <center>
                  <h3><u> Return Bill List For Medicine</u></h3>
                </center>
              </div>
          <table class="table table-bordered table-striped" id="invoices" role="grid" aria-describedby="product_list_info">
            <thead>
              <tr>
                <th class="hidden-380" style="text-align:center">Sl. No.</th>
                <th class="hidden-380" style="text-align:center"> Invoice Number </th>
                <th class="hidden-380" style="text-align:center"> Invoice Date </th>
                <th class="hidden-380" style="text-align:center">UHID</th>
              <th class="hidden-380" style="text-align:center"> Doctor </th>
             <!-- <th class="hidden-380" style="text-align:center"> Phone </th>-->
               <th class="hidden-380" style="text-align:center"> Cash / Credit </th>
                <th class="hidden-380" style="text-align:center"> Customer Name </th>
                <th class="hidden-380" style="text-align:center"> Total Amount (&#8377;) </th>
                <th class="hidden-380" style="text-align:center">Action</th>
              </tr>
            </thead>
            <tbody id="invoices_disp">
            </tbody>
          </table>
        </div>
      </div>
      <!-- END PAGE CONTENT --> 
    </div>
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

var tab_asset_entry="";

//load_purchase_orders();
load_vendor();
load_purchase();
load_types();
load_sub_types();
var mrp=0;
var expiry_date="";
var mfg_date="";
load_doctors();
var uhid="";
item_name="";
load_patient_type(0);


$( "div" ).mousemove(function( event ) {

	$(".expiry_date").datepicker({
	   format: 'dd-mm-yyyy'
   });

$(".mfg_date").datepicker({
	   format: 'dd-mm-yyyy'
   });


});
$("#inv_date").datepicker({
	   format: 'dd-mm-yyyy'
   });


$( document ).ready(function() {
    $("#freeItem_qty").change(function(){
  		$("#freeItem_qty").attr("data-qty",$("#freeItem_qty").val());
	});
	
	$("#freeItem_qty").keypress(function(event){
		if ( event.which == 13 ) {
			$("#batch_code_val").focus();
  			//add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value);
		}
	});
	$("#uhid_check_text").change(function(){
  		$("#show_all_div_content").css("display","none");
	});
	
	
	$("#batch_code_val").keypress(function(event){
		
		if ( event.which == 13 ) {
			//console.log(search_code($(this).val()));
			add_item();
		}
	
	});
	
	$("#uhid").keypress(function(event){
		
		if ( event.which == 13 ) {
			//console.log(search_code($(this).val()));
			get_patient_details();
		}
	
	});
	
	
	$('#item').select2();
	$('#doctors').select2();
	$('#uhid_check_text').select2();
	$("#item").live('change', function(){
  		$("#freeItem_qty").focus();
	});
	
	var uhid_check_text=$("#uhid_check_text").val();
	if(uhid_check_text!=''){		
		get_patient_details();	
			
	}
  
});

function load_patient_type(fl){
	
	$('#patient_type').empty();
	//alert(fl);

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=70',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
				
			if(fl=='1'){
				$('#patient_type').empty();
			 $.each(data, function(index, element) {
			 	$('#patient_type').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			}else{
				$('#patient_type').empty();
				/*$('#patient_type').append($('<option/>', { 

					value: '',
					text : '' 

				}));*/
				$.each(data, function(index, element) {
			 	$('#patient_type').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			get_patient_details();
			}
			
			 },
			 complete: function(){
			  $('.ajax-loader').css("visibility", "hidden");
			}

		  });
	
	
}


function add_item(){
	//alert($("#batch_code_val").find(":selected").val());
	var new_cust_ids=$("#customer_id_arr").val();

	var data_details={	
			"new_cust_ids": new_cust_ids,
			"cust_check":"1"
	}
	
	$.ajax({
			
			url: 'get_json_data_inventory.php?flag=74',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				if(data.cust_order=='1'){
						//alert("Slip Already Generated!!!")
						message_var=' for '+$("#customer_name").val()+' ( ' +$("#item option:selected").text()+' ) - '+$("#freeItem_qty").val()+'PCS' ;
						if (confirm('Customer for the item return are different!!! Are You Sure To continue'+message_var)) {
							 if(search_code($("#batch_code_val").find(":selected").val())==true){			
								add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value,document.getElementById('batch_code_val').options[document.getElementById('batch_code_val').selectedIndex].value,document.getElementById('iop_count').value,document.getElementById('patient_type').value);
								temporary_save_sales();
								$("#freeItem_qty").val('');	
								//load_batch_codes();
								//load_batch_codes_return(batch_no,qty,item_name);
								load_batch_codes_for_return(document.getElementById('batch_code_val').options[document.getElementById('batch_code_val').selectedIndex].value,document.getElementById('stock_qty').html,'item_name');
								
								var grand_total = $("#grand_total_").html();
								if(grand_total!=''){
									calculate_sales();
								}
								
							}else{
								alert("Batch does not exist.");
							}
						} else {
							
						}
				}else{
					if(search_code($("#batch_code_val").find(":selected").val())==true){			
					add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value,document.getElementById('batch_code_val').options[document.getElementById('batch_code_val').selectedIndex].value,document.getElementById('iop_count').value,document.getElementById('patient_type').value);
					temporary_save_sales();
					$("#freeItem_qty").val('');	
					//load_batch_codes();
					//load_batch_codes_return(batch_no,qty,item_name);
					load_batch_codes_for_return(document.getElementById('batch_code_val').options[document.getElementById('batch_code_val').selectedIndex].value,document.getElementById('stock_qty').html,'item_name');
					
					var grand_total = $("#grand_total_").html();
					if(grand_total!=''){
						calculate_sales();
					}
					
				}else{
					alert("Batch does not exist.");
				}	
					
				}
			}
		});
		
	/*if(search_code($("#batch_code_val").find(":selected").val())==true){			
		add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value,document.getElementById('batch_code_val').options[document.getElementById('batch_code_val').selectedIndex].value,document.getElementById('iop_count').value,document.getElementById('patient_type').value);
		temporary_save_sales();
		$("#freeItem_qty").val('');	
		//load_batch_codes();
		//load_batch_codes_return(batch_no,qty,item_name);
		load_batch_codes_for_return(document.getElementById('batch_code_val').options[document.getElementById('batch_code_val').selectedIndex].value,document.getElementById('stock_qty').html,'item_name');
		
		var grand_total = $("#grand_total_").html();
		if(grand_total!=''){
			calculate_sales();
		}
		
	}else{
		alert("Batch does not exist.");
	}*/
	

}

function load_purchase_orders(){

	$('#indent').empty();
	
	$('#indent').append($('<option/>', { 

					value: '',
					text : '-Select-' 

				}));

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=26',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#indent').append($('<option/>', { 

					value: element.id,
					text : element.order_number+" "+element.date, 

				}));
		 	});
			
			 },
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}

		  });

}

function load_vendor(){
	
	$('#vendor_name').empty();
	
	$('#vendor_name').append($('<option/>', { 

					value: '',
					text : '-Select-' 

				}));

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=11',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#vendor_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			 },
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}

		  });
}


function load_purchase_order_data(){
if(tab_asset_entry!="") tab_asset_entry.destroy();


var data_details={
		"id": $("#indent").val()		
}

$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=27',
			type: 'POST',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				$("#assets_body").html(data);
				var tds = $(data).find("input[type='hidden']");
				//alert(tds.val());
				$("#vendor_name").val(tds.val());

				tab_asset_entry=$("#asset_entry_data").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});

}

function del(id,item_id,batch_code_value){

	$("#"+id).remove();
	calculate(id);
	var data_details={
		"item_id": item_id,
		"batch_code_value": batch_code_value ,
		"temporary_customer_id": $("#temporary_customer_id").val(), 
		"temporary_sales_id": $("#temporary_sales_id").val()
	}
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=68',
			dataType: 'json',
			type: 'POST',
			data: data_details,
			success: function (data) {
				console.log(data.flag);	
				
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});
	

}


function edit(id){

$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=19',
			dataType: 'json',
			type: 'POST',
			data: "id="+id,
			success: function (data) {
				console.log(data.type_id);
				$("#id").val(id);
				$("#type_name").val(data.type_id);
				$("#dept_name").val(data.dept_id);
				$("#location_name").val(data.location_id);
				$("#vendor_name").val(data.vendor_id);
				$("#asset_name").val(data.asset_name);
				$("#qty").val(data.qty);
				$("#unit").val(data.unit_id);
				$("#size").val(data.size);
				$("#color").val(data.color);
				$("#covid_item").val(data.covid_item);
				$("#specification").val(data.specification);
				load_sub_types(data.sub_type_id);
				$("#type_name").focus()
				
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});

}
var icount=1;

function add_indent_free(id,indent_id,indent_details_id,item_id,batch_code_val,iop_count,patient_type){

	var src=$("#assets_indent_body").html();
	var item_id_temp=item_id.split("^");
	//alert(item_id_temp[0]);
	//alert(batch_code_val);
	//return false;
	var total_iop=parseInt(iop_count)+1;
	$("#iop_count").val(total_iop);
	
	if(parseInt($("#stock_qty").html())<parseInt($("#freeItem_qty").val())){
		alert("Quantity not in stock");
		return false;
	}
	
	var item_val=$("#item").val().split("^");
	
	var tds = $(src).find("td[id='"+id+item_val[0]+"_qty_qty']");
	
	
	//console.log("HSMCODE"+item_val[1]);
	
	var gst=item_val[5];
	
	//Back Calculation
	if(gst!=0 || gst!=''){
		mrp=parseFloat((parseFloat(mrp)/(parseFloat(gst)+100))*100).toFixed(2);
	}
	
	//console.log(typeof tds.html()); 
	
	if(typeof tds.html() === "undefined"){  
	
		$("#assets_indent_body").append("<tr id='"+id+item_val[0]+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+"_asset_name' >"+$("#item :selected").text()+"</td><td id='"+id+item_val[0]+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+"_batch_no' style='width:80px' value='"+$("#batch_code_val").val()+"' ></td><td id='"+id+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+"_mfg_date' class='mfg_date' value='"+mfg_date+"' ><div class='input-group'><input type='hidden' name='"+id+item_val[0]+"_mfg_date_day_val' id='"+id+item_val[0]+"_mfg_date_day_val' class='form-control'  value='01' /><select class='form-control' id='"+id+item_val[0]+"_mfg_date_month_val' name='"+id+item_val[0]+"_mfg_date_month_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' ><option value=''>-Month-</option><?php  for($month_num=1;$month_num<13;$month_num++){ ?> <option value='<?php if($month_num<10) { echo '0'.$month_num; }else{ echo $month_num; } ?>'><?php echo date('M', mktime(0, 0, 0, $month_num, 10)); ?></option><?php  } ?></select><select class='form-control' id='"+id+item_val[0]+"_mfg_date_year_val' name='"+id+item_val[0]+"_mfg_date_year_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' ><option value=''>-Year-</option> <?php $current_years=date("Y"); $previ_y=$current_years-5;$next_y=$current_years+11;while($previ_y<$next_y){ ?><option value='<?php echo $previ_y; ?>'><?php echo $previ_y; ?></option><?php $previ_y++ ;  } ?></select><button type='button' style='background:transparent !important;border: none !important;'> <a href='javascript:void(0);'  id='iop_add_button'  title='Calculate' onClick='calculate_mfg_expire_date(\""+id+item_val[0]+"_mfg_date\",document.getElementById(\""+id+item_val[0]+"_mfg_date_year_val\").options[document.getElementById(\""+id+item_val[0]+"_mfg_date_year_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+"_mfg_date_month_val\").options[document.getElementById(\""+id+item_val[0]+"_mfg_date_month_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+"_mfg_date_day_val\").value)' alt='Calculate'><img src='icon/icons8-calculator-16.png' class='img-responsive' alt='Calculate'></a></button></div></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ><div class='input-group'><input type='hidden' name='"+id+item_val[0]+"_expiry_date_day_val' id='"+id+item_val[0]+"_expiry_date_day_val' class='form-control'  value='31' /><select class='form-control' id='"+id+item_val[0]+"_expiry_date_month_val' name='"+id+item_val[0]+"_expiry_date_month_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' onChange='calculate_expire_day(\""+id+item_val[0]+"_expiry_date_day_val\",document.getElementById(\""+id+item_val[0]+"_expiry_date_year_val\").options[document.getElementById(\""+id+item_val[0]+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+"_expiry_date_month_val\").options[document.getElementById(\""+id+item_val[0]+"_expiry_date_month_val\").selectedIndex].value)' ><option value=''>-Month-</option><?php  for($month_num=1;$month_num<13;$month_num++){ ?> <option value='<?php if($month_num<10) { echo '0'.$month_num; }else{ echo $month_num; } ?>'><?php echo date('M', mktime(0, 0, 0, $month_num, 10)); ?></option><?php  } ?></select><select class='form-control' id='"+id+item_val[0]+"_expiry_date_year_val' name='"+id+item_val[0]+"_expiry_date_year_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' onChange='calculate_expire_day(\""+id+item_val[0]+"_expiry_date_day_val\",document.getElementById(\""+id+item_val[0]+"_expiry_date_year_val\").options[document.getElementById(\""+id+item_val[0]+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+"_expiry_date_month_val\").options[document.getElementById(\""+id+item_val[0]+"_expiry_date_month_val\").selectedIndex].value)' ><option value=''>-Year-</option> <?php $current_years=date("Y"); $previ_y=$current_years-5;$next_y=$current_years+11;while($previ_y<$next_y){ ?><option value='<?php echo $previ_y; ?>'><?php echo $previ_y; ?></option><?php $previ_y++ ;  } ?></select><button type='button' style='background:transparent !important;border: none !important;'> <a href='javascript:void(0);'  id='iop_add_button'  title='Calculate' onClick='calculate_mfg_expire_date(\""+id+item_val[0]+"_expiry_date\",document.getElementById(\""+id+item_val[0]+"_expiry_date_year_val\").options[document.getElementById(\""+id+item_val[0]+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+"_expiry_date_month_val\").options[document.getElementById(\""+id+item_val[0]+"_expiry_date_month_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+"_expiry_date_day_val\").value)' alt='Calculate'><img src='icon/icons8-calculator-16.png' class='img-responsive' alt='Calculate'></a></button></div></td><td id='"+id+item_val[0]+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><input style='width:80px' type='text' value='"+mrp+"' id='"+id+item_val[0]+"_rate' onblur='calculate(\""+id+item_val[0]+"\")'  ></td><td><input type='text' id='"+id+item_val[0]+"_discount_rate' onblur='calculate(\""+id+item_val[0]+"\")'  size=5 value='0' ></td><td><input type='text' value='0'  id='"+id+item_val[0]+"_discount_amount' size=5 ></td><td><input type='text' id='"+id+item_val[0]+"_total_amount' style='width:80px' value='"+(mrp*$("#"+id+"_qty").val())+"' ></td><td><span id='"+id+item_val[0]+"_gstrate' size=5 >"+item_val[5]+"</span></td><td><span id='"+id+item_val[0]+"_gst_amount' onblur='calculate(\""+id+item_val[0]+"\")' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_cgstrate' size=5 >"+item_val[6]+"</span></td><td><span id='"+id+item_val[0]+"_cgst_amount' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_sgstrate' >"+item_val[7]+"</span></td><td><span id='"+id+item_val[0]+"_sgst_amount' >0</span></td><td><span id='"+id+item_val[0]+"_net_amount' >0</span></td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+"\" , \""+item_val[0]+"\" , \""+batch_code_val+"\")' ><i class='fa fa-trash'></i></a></td></tr>");
	
	$("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())));
	calculate(id+item_val[0]);
	
	
	} else{
	
	   //Code for same item different batch
		if(confirm("Is the item from the same batch?")){
			
			var batch_flag=0;
			if($("#freeItem"+id+item_val[0]+"_batch_no").val()==batch_code_val){
				batch_flag=0;
			}else{
			var sl=1;
			while(sl<icount){				
				if($("#"+id+item_val[0]+sl+"_batch_no").val()==batch_code_val){					
					batch_flag=1;
					var macth_bacth=sl;
				}
				sl=parseInt(sl)+1;
			}			
			}		
			
			if(batch_flag==0){
				 var qty_added=tds.html();		 
				 $("#"+id+item_val[0]+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));
				 $("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())+parseFloat(qty_added)));
				 calculate(id+item_val[0]);				
			}else{			
			var tds = $(src).find("td[id='"+id+item_val[0]+macth_bacth+"_qty_qty']");			
			var qty_added=tds.html();		
		 $("#"+id+item_val[0]+macth_bacth+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));
		 $("#"+id+item_val[0]+macth_bacth+"_qty").val(parseFloat($("#"+id+item_val[0]+macth_bacth+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+macth_bacth+"_qty").val())+parseFloat(qty_added)));
		 calculate(id+item_val[0]+macth_bacth);	
			}
			
		}else{

		$("#assets_indent_body").append("<tr id='"+id+item_val[0]+icount+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+icount+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+icount+"_asset_name' >"+$("#item :selected").text()+"</td><td id='"+id+item_val[0]+icount+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+icount+"_batch_no' style='width:80px' value='"+$("#batch_code_val").val()+"' ></td><td id='"+id+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+icount+"_mfg_date' class='mfg_date' value='"+mfg_date+"' ><div class='input-group'><input type='hidden' name='"+id+item_val[0]+icount+"_mfg_date_day_val' id='"+id+item_val[0]+icount+"_mfg_date_day_val' class='form-control'  value='01' /><select class='form-control' id='"+id+item_val[0]+icount+"_mfg_date_month_val' name='"+id+item_val[0]+icount+"_mfg_date_month_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' ><option value=''>-Month-</option><?php  for($month_num=1;$month_num<13;$month_num++){ ?> <option value='<?php if($month_num<10) { echo '0'.$month_num; }else{ echo $month_num; } ?>'><?php echo date('M', mktime(0, 0, 0, $month_num, 10)); ?></option><?php  } ?></select><select class='form-control' id='"+id+item_val[0]+icount+"_mfg_date_year_val' name='"+id+item_val[0]+icount+"_mfg_date_year_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' ><option value=''>-Year-</option> <?php $current_years=date("Y"); $previ_y=$current_years-5;$next_y=$current_years+11;while($previ_y<$next_y){ ?><option value='<?php echo $previ_y; ?>'><?php echo $previ_y; ?></option><?php $previ_y++ ;  } ?></select><button type='button' style='background:transparent !important;border: none !important;'> <a href='javascript:void(0);'  id='iop_add_button'  title='Calculate' onClick='calculate_mfg_expire_date(\""+id+item_val[0]+icount+"_mfg_date\",document.getElementById(\""+id+item_val[0]+icount+"_mfg_date_year_val\").options[document.getElementById(\""+id+item_val[0]+icount+"_mfg_date_year_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+icount+"_mfg_date_month_val\").options[document.getElementById(\""+id+item_val[0]+icount+"_mfg_date_month_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+icount+"_mfg_date_day_val\").value)' alt='Calculate'><img src='icon/icons8-calculator-16.png' class='img-responsive' alt='Calculate'></a></button></div></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+icount+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ><div class='input-group'><input type='hidden' name='"+id+item_val[0]+icount+"_expiry_date_day_val' id='"+id+item_val[0]+icount+"_expiry_date_day_val' class='form-control'  value='31' /><select class='form-control' id='"+id+item_val[0]+icount+"_expiry_date_month_val' name='"+id+item_val[0]+icount+"_expiry_date_month_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' onChange='calculate_expire_day(\""+id+item_val[0]+icount+"_expiry_date_day_val\",document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_year_val\").options[document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_month_val\").options[document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_month_val\").selectedIndex].value)' ><option value=''>-Month-</option><?php  for($month_num=1;$month_num<13;$month_num++){ ?> <option value='<?php if($month_num<10) { echo '0'.$month_num; }else{ echo $month_num; } ?>'><?php echo date('M', mktime(0, 0, 0, $month_num, 10)); ?></option><?php  } ?></select><select class='form-control' id='"+id+item_val[0]+icount+"_expiry_date_year_val' name='"+id+item_val[0]+icount+"_expiry_date_year_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' onChange='calculate_expire_day(\""+id+item_val[0]+icount+"_expiry_date_day_val\",document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_year_val\").options[document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_month_val\").options[document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_month_val\").selectedIndex].value)' ><option value=''>-Year-</option> <?php $current_years=date("Y"); $previ_y=$current_years-5;$next_y=$current_years+11;while($previ_y<$next_y){ ?><option value='<?php echo $previ_y; ?>'><?php echo $previ_y; ?></option><?php $previ_y++ ;  } ?></select><button type='button' style='background:transparent !important;border: none !important;'> <a href='javascript:void(0);'  id='iop_add_button'  title='Calculate' onClick='calculate_mfg_expire_date(\""+id+item_val[0]+icount+"_expiry_date\",document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_year_val\").options[document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_month_val\").options[document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_month_val\").selectedIndex].value,document.getElementById(\""+id+item_val[0]+icount+"_expiry_date_day_val\").value)' alt='Calculate'><img src='icon/icons8-calculator-16.png' class='img-responsive' alt='Calculate'></a></button></div></td><td id='"+id+item_val[0]+icount+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><input style='width:80px' type='text' value='"+mrp+"' id='"+id+item_val[0]+icount+"_rate' onblur='calculate(\""+id+item_val[0]+icount+"\")'  ></td><td><input type='text' id='"+id+item_val[0]+icount+"_discount_rate' onblur='calculate(\""+id+item_val[0]+icount+"\")'  size=5 value='0' ></td><td><input type='text' value='0'  id='"+id+item_val[0]+icount+"_discount_amount' size=5 ></td><td><input type='text' id='"+id+item_val[0]+icount+"_total_amount' style='width:80px' value='"+(mrp*$("#"+id+"_qty").val())+"' ></td><td><span id='"+id+item_val[0]+icount+"_gstrate' size=5 >"+item_val[5]+"</span></td><td><span id='"+id+item_val[0]+icount+"_gst_amount' onblur='calculate(\""+id+item_val[0]+icount+"\")' size=5 >0</span></td><td><span id='"+id+item_val[0]+icount+"_cgstrate' size=5 >"+item_val[6]+"</span></td><td><span id='"+id+item_val[0]+icount+"_cgst_amount' size=5 >0</span></td><td><span id='"+id+item_val[0]+icount+"_sgstrate' >"+item_val[7]+"</span></td><td><span id='"+id+item_val[0]+icount+"_sgst_amount' >0</span></td><td><span id='"+id+item_val[0]+icount+"_net_amount' >0</span></td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+icount+"\" , \""+item_val[0]+"\" , \""+batch_code_val+"\")' ><i class='fa fa-trash'></i></a></td></tr>");
	
	$("#"+id+item_val[0]+icount+"_qty").val(parseFloat($("#"+id+item_val[0]+icount+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+icount+"_qty").val())));
	calculate(id+item_val[0]+icount);
	
			
			icount++;
	 }
	}
}

function save_sales(flag=0){

	//alert(trs.id);
	var due_bill=$("#due_bill").val();
	if(due_bill=='0'){
	if(parseFloat($("#bal").html())<0){
		alert("Over paid");
		return false;
	}else if(parseFloat($("#bal").html())>0){
		alert("Under paid");
		return false;
	} 
	}
	
	if($("#customer_name").val()=="" ){
		alert("Please fill up patients details");
		$("#customer_name").focus();
		return false;
	}
	if($("#grand_total_").html()=="" ){
		alert("Please add items");
		//$("#customer_name").focus();
		return false;
	}
	
	let doc=$("#doctors").select2('data');
		
	let ids=[];
	let qty=[];
	let batch_no=[];
	let expiry_date=[];
	let mfg_date=[];
	let rate=[];
	let disc_rate=[];
	let disc_amount=[];
	let gst_rate=[];
	let gst_amount=[];
	let cgst_rate=[];
	let cgst_amount=[];
	let sgst_rate=[];
	let sgst_amount=[];
	let total_amount=[];
	let asset_name=[];
	let i=0;
	let return_flag=0;
	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){
  		//console.log( index + ": " + $( this ).attr('id') );
		//purchase_id[i]=$( this ).attr('data-indent');
		//purchase_details_id[i]=$( this ).attr('data-details-indent');
		ids[i]=$( this ).attr('data-item-id');
		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();
		batch_no[i]=$("#"+$( this ).attr('id')+"_batch_no").val();
		expiry_date[i]=$("#"+$( this ).attr('id')+"_expiry_date").val();
		mfg_date[i]=$("#"+$( this ).attr('id')+"_mfg_date").val();
		rate[i]=$("#"+$( this ).attr('id')+"_rate").val();
		disc_rate[i]=$("#"+$( this ).attr('id')+"_discount_rate").val();
		disc_amount[i]=$("#"+$( this ).attr('id')+"_discount_amount").val();
		gst_rate[i]=$("#"+$( this ).attr('id')+"_gstrate").html();
		gst_amount[i]=$("#"+$( this ).attr('id')+"_gst_amount").html();
		cgst_rate[i]=$("#"+$( this ).attr('id')+"_cgstrate").html();
		cgst_amount[i]=$("#"+$( this ).attr('id')+"_cgst_amount").html();
		sgst_rate[i]=$("#"+$( this ).attr('id')+"_sgstrate").html();
		sgst_amount[i]=$("#"+$( this ).attr('id')+"_sgst_amount").html();
		total_amount[i]=$("#"+$( this ).attr('id')+"_total_amount").val();
		//mrp[i]=$("#"+$( this ).attr('id')+"_mrp").val();
		//alert($("#"+$( this ).attr('id')+"_total_amount").val());
		asset_name[i]=$("#"+$( this ).attr('id')+"_asset_name").html();
		//console.log("MRP::"+$("#"+$( this ).attr('id')+"_mrp").val());
		if($("#"+$( this ).attr('id')+"_mrp").val()==0){
			alert("MRP must be entered");
			return_flag=1;
			return false;
			
		}
		
		i++;
});
	if(return_flag==1) return false;
	var data_details={
		//"purchase_id" : purchase_id,
		//"purchase_details_id" : purchase_details_id,
		"id" : ids,
		"qty" : qty,
		"batch_no" : batch_no,
		"mfg_date" : mfg_date,
		"expiry_date" : expiry_date,
		"rate" : rate,
		"total_amount" : total_amount,
		"net_total" : $("#net_total_").html(),
		"asset_name" : asset_name,
		"vendor_name" : $("#vendor_name option:selected").text(),
		"vendor_id" : $("#vendor_name").val(),
		"disc_rate" : disc_rate,
		"disc_amount" : disc_amount,
		"gst_rate" : gst_rate,
		"gst_amount" : gst_amount,
		"cgst_rate" : cgst_rate,
		"cgst_amount" : cgst_amount,
		"sgst_rate" : sgst_rate,
		"sgst_amount" : sgst_amount,
		"total_cgst_amount" : $("#CGST_amount_").html(),
		"total_sgst_amount" : $("#SGST_amount_").html(),
		"inv_date": $("#inv_date").val(),
		"customer_name": $("#customer_name").val(),
		"phone_number": $("#phone_number").val(),
		"cash": $("#cash").val(),
		"card": $("#card").val(),
		"upi": $("#UPI").val(),
		"doctor":doc.text,
		"uhid":uhid,
		"discount_type" : $("#discount_type").val(),
		"discount_val" : $("#discount_val").val(),
		"discount_total" : $("#discount_total_").html(), 
		"round_off_total" : $("#round_off_total_").html(), 
		"grand_total" : $("#grand_total_").html(),
		"temporary_customer_id": $("#temporary_customer_id").val(), 
		"temporary_sales_id": $("#temporary_sales_id").val() ,
		"drug_order_id_arr": $("#drug_order_id_arr").val(),
		"due_bill":due_bill,
		"patient_id": $("#patient_id").val(),
		"medicine_return_flag":'1'
		
		//"mrp" : mrp
		
	}
	
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=75',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data.flag);
				//load_asset_entry_data();
				if(data.flag=="1"){
				 	toastr.success('Order Saved Successfully');
					reset_temporary_sales_stock();
				}else{
				
				 	if(data.reason!="") toastr.error(data.reason);
				 	else toastr.error('Unable to save order');
				}
				
				if(flag==1) window.open("sales_invoice_print_return.php?inv_id="+data.s_id);
				
				setTimeout(function(){ location.reload(); }, 2000);	
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
			
		});

}
let invoices="";
function load_purchase(){

	//alert("Into It");
	var data_details={
		"inside_flag":'1'
	}

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
			url: 'get_json_data_inventory.php?flag=76',
			type: 'POST',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data.flag);
				$("#invoices_disp").html(data);
				invoices=$("#invoices").DataTable( {
					//order: [[1, 'desc'], [0, 'desc']],
					order: [0, 'asc'],
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
				
				} );
				//load_asset_entry_data();
				//if(data.flag=="1") toastr.success('Order Saved Successfully');
				//else toastr.error('Unable to save order');
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
	
	});

}
let total_discount=0;
function calculate(id){
	//alert($("#"+id+"_rate").val());
	//alert(id);
	let total=0;
	let cgst=0;
	let sgst=0;
	let net_total=0;
	$("#"+id+"_total_amount").val(parseFloat(($("#"+id+"_rate").val())*($("#"+id+"_qty_qty").html())).toFixed(2));
	let disc_amount=($("#"+id+"_discount_rate").val()!=0 || $("#"+id+"_discount_rate").val()!="" ) ? $("#"+id+"_total_amount").val()*($("#"+id+"_discount_rate").val()/100) : $("#"+id+"_discount_amount").val();
	disc_amount=parseFloat(disc_amount).toFixed(2);
	//console.log(disc_amount);
	$("#"+id+"_discount_amount").val(disc_amount);
	$("#"+id+"_total_amount").val(parseFloat($("#"+id+"_total_amount").val()-disc_amount).toFixed(2)); 
	$("#"+id+"_gst_amount").html(parseFloat($("#"+id+"_total_amount").val()*($("#"+id+"_gstrate").html()/100)).toFixed(2));
	$("#"+id+"_cgst_amount").html(parseFloat($("#"+id+"_total_amount").val()*($("#"+id+"_cgstrate").html()/100)).toFixed(2));
	$("#"+id+"_sgst_amount").html(parseFloat($("#"+id+"_total_amount").val()*($("#"+id+"_sgstrate").html()/100)).toFixed(2));
	$("#"+id+"_net_amount").html(parseFloat($("#"+id+"_total_amount").val())+parseFloat($("#"+id+"_gst_amount").html()));
	$("#"+id+"_net_amount").html(parseFloat($("#"+id+"_net_amount").html()).toFixed(2));
	//$("#"+id+"_net_amount").html(parseFloat($("#"+id+"_total_amount").val())+parseFloat($("#"+id+"_gst_amount").html()));
	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){
	
		total=parseFloat(total)+parseFloat($("#"+$( this ).attr('id')+"_total_amount").val());
		cgst=parseFloat(cgst)+parseFloat($("#"+$( this ).attr('id')+"_cgst_amount").html());
		sgst=parseFloat(sgst)+parseFloat($("#"+$( this ).attr('id')+"_sgst_amount").html());
		net_total=total+cgst+sgst;
		
	});
	//net_total=Math.round(net_total);
	net_total=parseFloat(net_total).toFixed(2);
	$("#total_amount").html(parseFloat(total).toFixed(2));
	var fixed_net_total=Math.round(net_total);
	$("#CGST_amount_").html(cgst.toFixed(2));
	$("#SGST_amount_").html(sgst.toFixed(2));
	$("#net_total_").html(net_total);
	$("#grand_total_").html(fixed_net_total);
	var round_off=(parseFloat(fixed_net_total)-parseFloat(net_total))
	let cash=$("#cash").val();
	let card=$("#card").val();
	let upi=$("#UPI").val();
	$("#round_off_total_").html(round_off.toFixed(2));
	let bal=fixed_net_total-(parseFloat(cash)+parseFloat(card)+parseFloat(upi));
	$("#bal").html(bal);
	calculate_sales();
}

function data_reset(){

	$("#assets_indent_body").html("");
	$("#indent").val('');
	$("#vendor_name").val('');
	load_purchase();

}

function load_types(){
	
	$('#type_name').empty();

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=3',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#type_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			//$('#type_name').val("1");
			document.getElementById("type_name").options[1].selected = true;
			document.getElementById("type_name").onchange();
			//$('#type_name').change();
			 },
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}

		  });
	
	
}


function load_sub_types(id){
	
	$('#sub_type_name').empty();

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=5',
			dataType: 'json',
			data: 'type_id='+$('#type_name').val(),
			type: 'POST',
			success: function (data) {
			
			 $.each(data, function(index, element) {
			 	$('#sub_type_name').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
				if(id!="")	$("#sub_type_name").val(id);
			
			 },
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}

		  });
}


function load_asset_entry_data(){

$('#item').empty();
$("#item").val('');
$("#freeItem_qty").val('');	

$('#select2-chosen-1').empty();
$('#batch_code_val').empty();
$("#stock_qty").html('');



$('#item').append($('<option/>', { 

					value: '',
					text : '-Select-' 

				}));

var data_details={
		"id": $("#id").val(),
		"dept_name": $("#dept_name").val(),
		"type_name": $("#type_name").val(),
		"sub_type_name": $("#sub_type_name").val(),
		"location_name": $("#location_name :selected").text(),
		"location_id": $("#location_name").val(),
		
}

$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=41',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
				$.each(data, function(index, element) {
			 	$('#item').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			$("#item").focus();
				//alert(searchOption('item',item_name));
				var idval=searchOption('item',item_name);
				$("#item").select2("val",idval);
				load_batch_codes();	
				//load_batch_codes_for_return();
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
			
		}); 

}

function search_code(code){
	//alert($("#item").find(":selected").val());
	let item_val=$("#item").find(":selected").val().split("^");
	let flag_=false;
	let data_details={
	"batch_code": code,
	"item_id": item_val[0] ,
	"patient_type": $("#patient_type").val(),
	}
	
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=42',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			async: false, 
			success: function (data) {
			//alert(data.mrp);	
		 	mrp=data.mrp;
			expiry_date=data.expiry_date;
			mfg_date=data.mfg_date;
			
			
			if(mrp!=null){
				flag_=true;
			}
			//$("#item").focus();
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});
			
		return flag_;
	
}

function calculate_payment(){

	let cash=$("#cash").val();
	let card=$("#card").val();
	let upi=$("#UPI").val();
	let bal=$("#grand_total_").html();
	
	let fbal=parseFloat(bal)-(parseFloat(cash)+parseFloat(card)+parseFloat(upi));
	$("#bal").html(fbal);

}

function get_patient_details(){

	$("#customer_name").val('');
	$("#phone_number").val('');
	$("#uhid").val('');
	$("#doctors").val('');
	$("#patient_id").val('');
	$("#patient_type").val('');
	
	//uhid="GLB-EYE/"+$("#uhid").val();
	uhid=$("#uhid_check_text").val();
	if(uhid==''){
		alert("Please Enter valid UHID No.");
		return false;
	}
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=46',
			type: 'POST',
			dataType: 'json',
			data: "uhid="+uhid,
			async: false, 
			success: function (data) {
				
		 		$("#customer_name").val(data.customer_name);
				$("#phone_number").val(data.phone_number);
				$("#uhid").val(data.uhid_no);
				//$("#doctors").val(data.consultant);
				$("#patient_id").val(data.patient_id);
				$("#doctors").select2("val", data.consultant);
				$("#patient_type").val(data.patient_type);
				if(data.patient_type!=''){				
					$("#patient_admit").html('Patient Admitted As:-> '+data.patient_type_names+' Patient');
				}
				
				view_medicine_details();
				
				/*var pt_type_fl=0;
				if(data.patient_type=='6'){
					pt_type_fl=1;
				}
				 load_patient_type(pt_type_fl);*/
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});
		
		
		

}

function load_batch_codes(){

	let item_val=$("#item").find(":selected").val().split("^");
	let item_id=item_val[0];
	$('#batch_code_val').empty();
	
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=47',
			type: 'POST',
			dataType: 'json',
			data: "item_id="+item_id,
			async: false, 
			success: function (data) {
				
		 		$.each(data, function(index, element) {
			 	$('#batch_code_val').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));				
		 	});
			
			load_stock();
			
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});
	

}


function temporary_save_sales(flag=0){	
//alert("ani");
	
	if($("#customer_name").val()=="" ){
		alert("Please fill up patients details");
		$("#customer_name").focus();
		return false;
	}
	var due_bill=$("#due_bill").val();
	
	let doc=$("#doctors").select2('data');
		
	let ids=[];
	let qty=[];
	let batch_no=[];
	let expiry_date=[];
	let mfg_date=[];
	let rate=[];
	let disc_rate=[];
	let disc_amount=[];
	let gst_rate=[];
	let gst_amount=[];
	let cgst_rate=[];
	let cgst_amount=[];
	let sgst_rate=[];
	let sgst_amount=[];
	let total_amount=[];
	let asset_name=[];
	let i=0;
	let return_flag=0;
	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){
  		//console.log( index + ": " + $( this ).attr('id') );
		//purchase_id[i]=$( this ).attr('data-indent');
		//purchase_details_id[i]=$( this ).attr('data-details-indent');
		ids[i]=$( this ).attr('data-item-id');
		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();
		batch_no[i]=$("#"+$( this ).attr('id')+"_batch_no").val();
		expiry_date[i]=$("#"+$( this ).attr('id')+"_expiry_date").val();
		mfg_date[i]=$("#"+$( this ).attr('id')+"_mfg_date").val();
		rate[i]=$("#"+$( this ).attr('id')+"_rate").val();
		disc_rate[i]=$("#"+$( this ).attr('id')+"_discount_rate").val();
		disc_amount[i]=$("#"+$( this ).attr('id')+"_discount_amount").val();
		gst_rate[i]=$("#"+$( this ).attr('id')+"_gstrate").html();
		gst_amount[i]=$("#"+$( this ).attr('id')+"_gst_amount").html();
		cgst_rate[i]=$("#"+$( this ).attr('id')+"_cgstrate").html();
		cgst_amount[i]=$("#"+$( this ).attr('id')+"_cgst_amount").html();
		sgst_rate[i]=$("#"+$( this ).attr('id')+"_sgstrate").html();
		sgst_amount[i]=$("#"+$( this ).attr('id')+"_sgst_amount").html();
		total_amount[i]=$("#"+$( this ).attr('id')+"_total_amount").val();
		//mrp[i]=$("#"+$( this ).attr('id')+"_mrp").val();
		//alert($("#"+$( this ).attr('id')+"_total_amount").val());
		asset_name[i]=$("#"+$( this ).attr('id')+"_asset_name").html();
		//console.log("MRP::"+$("#"+$( this ).attr('id')+"_mrp").val());
		if($("#"+$( this ).attr('id')+"_mrp").val()==0){
			alert("MRP must be entered");
			return_flag=1;
			return false;
			
		}
		
		i++;
});
	
	if(return_flag==1) return false;
	var data_details={
		"id" : ids,
		"qty" : qty,
		"batch_no" : batch_no,
		"mfg_date" : mfg_date,
		"expiry_date" : expiry_date,
		"rate" : rate,
		"total_amount" : total_amount,
		"grand_total" : $("#net_total_").html(),
		"asset_name" : asset_name,
		"vendor_name" : $("#vendor_name option:selected").text(),
		"vendor_id" : $("#vendor_name").val(),
		"disc_rate" : disc_rate,
		"disc_amount" : disc_amount,
		"gst_rate" : gst_rate,
		"gst_amount" : gst_amount,
		"cgst_rate" : cgst_rate,
		"cgst_amount" : cgst_amount,
		"sgst_rate" : sgst_rate,
		"sgst_amount" : sgst_amount,
		"total_cgst_amount" : $("#CGST_amount_").html(),
		"total_sgst_amount" : $("#SGST_amount_").html(),
		"inv_date": $("#inv_date").val(),
		"customer_name": $("#customer_name").val(),
		"phone_number": $("#phone_number").val(),		
		"doctor":doc.text,
		"uhid":$("#uhid").val(),
		"temporary_customer_id": $("#temporary_customer_id").val(), 
		"temporary_sales_id": $("#temporary_sales_id").val() ,
		"drug_order_id_arr": $("#drug_order_id_arr").val(),
		"due_bill":due_bill,
		"patient_id": $("#patient_id").val(),
		"medicine_return_flag":'1'
		//"mrp" : mrp
		
	}
	
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=66',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
				$("#temporary_customer_id").val(data.temporary_customer_id);				
				$("#temporary_sales_id").val(data.temporary_sales_id);
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
			

		});

}

function reset_temporary_save_sales(){		

	var data_details={
		"temporary_customer_id": $("#temporary_customer_id").val(), 
		"temporary_sales_id": $("#temporary_sales_id").val() 
	}
	
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=67',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
			
				 $("#temporary_customer_id").val(data.temporary_customer_id);				
				$("#temporary_sales_id").val(data.temporary_sales_id);
				/*$("#assets_indent_body").html("");
				$("#indent").val('');
				$("#vendor_name").val('');*/
				location.reload();
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
			

		});

}


function calculate_sales(){	
	var submit_flag=0;
	//var net_total=$("#net_total_").html();
	
	if($("#customer_name").val()=="" ){
		alert("Please fill up patients details");
		$("#customer_name").focus();
		submit_flag=1;
	}
	
	//net_total=Math.round(net_total);
	var net_total=$("#net_total_").html();
	if(net_total==''){
		alert("Net Total can not be 0!!");
		submit_flag=1;
	}
	
	var discount_type=$("#discount_type").val();
	var discount_val=$("#discount_val").val();
	if((discount_type=='')&& (discount_val=='')){
		alert("Please Give Proper Discount");
		$("#discount_type").focus();
		$("#discount_val").val('0');
		submit_flag=1;
	}
	var discount_total=net_total;
	if((discount_type!='')&& (discount_val!='')&& (discount_val!='0')){		
		if(discount_type=='F'){
			discount_total=(parseFloat(net_total)-parseFloat(discount_val));
		}
		if(discount_type=='P'){
			discount_total=parseFloat(net_total)-((parseFloat(net_total)*parseFloat(discount_val))/100);
		}
	}
	if(discount_val==0){
		discount_total=parseFloat(net_total);		
	}
	
	$("#discount_total_").html(discount_total.toFixed(2));
	var fixed_net_total=Math.round(discount_total);
	$("#grand_total_").html(fixed_net_total);
	var round_off=(parseFloat(fixed_net_total)-parseFloat(discount_total));
	$("#round_off_total_").html(round_off.toFixed(2));
	let cash=$("#cash").val();
	let card=$("#card").val();
	let upi=$("#UPI").val();
	let bal=fixed_net_total-(parseFloat(cash)+parseFloat(card)+parseFloat(upi));
	$("#bal").html(bal);

}
function view_medicine_details(){
	//alert("ani;");
	var uhid_check_text=$("#uhid").val();
	if(uhid_check_text!=''){
		$("#prescribe_div_btn").css("display","block");
		$("#prescribed_div_medicine").css("display","block");
		$("#show_all_div_content").css("display","block");
		view_medicine_prescribe_details();
		//$('#staticBackdrop1').modal('hide');
		 //$('#staticBackdrop1').modal('show');
		
	}else{
		$("#prescribe_div_btn").css("display","none");
		$("#prescribed_div_medicine").css("display","none");
		$("#show_all_div_content").css("display","none");
	}
}
function view_medicine_prescribe_details(){
	//$('#staticBackdrop1').modal('show');
		if(tab_asset_entry!="") tab_asset_entry.destroy();


var data_details={
		"patient_id": $("#patient_id").val(),	
		"uhid": $("#uhid").val(),
		"drug_order_id_arr": $("#drug_order_id_arr").val(),
		"walk_in_patient_flag":"0"			
}

$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=74',
			type: 'POST',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				$("#pharma_order_body").html(data);
				tab_asset_entry=$("#pharma_order_data1").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});
	
}
function add_indent_sale_pharma(order_id,sub_type_name,item_id,item_name1,qty)
{
	var drug_order_id_arr= $("#drug_order_id_arr").val();
	var new_order_id="";
	if(drug_order_id_arr==''){
		new_order_id=order_id+',';
	}else{		
	new_order_id=drug_order_id_arr+order_id+',';
	}
	
	$("#drug_order_id_arr").val(new_order_id);
	if(tab_asset_entry!="") tab_asset_entry.destroy();
	var data_details={
		"patient_id": $("#patient_id").val(),	
		"uhid": $("#uhid").val(),
		"drug_order_id_arr": $("#drug_order_id_arr").val(),
		"order_id_val": order_id	
}

$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=69',
			type: 'POST',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				$("#pharma_order_body").html(data);
				tab_asset_entry=$("#pharma_order_data1").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				$("#sub_type_name").val(sub_type_name);
				load_asset_entry_data();
				//alert(item_name);
				$("#s2id_autogen1_search").val(item_name);
				$("#freeItem_qty").attr("data-qty",qty);
				$("#freeItem_qty").val(qty);
				item_name=item_name1;
				
				$("#close_models"). click();
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});
		
}

function searchOption(element,text){

	 var selectLength = $("#"+element+" option").length;
	 var itemval = document.getElementById(element);
	//alert("Options:"+selectLength);
        
	for(i=0; i<selectLength;i++){
		if (itemval[i].text === text) {
            return itemval[i].value;
        }

    }

}

function load_patient_type(fl){
	
	$('#patient_type').empty();
	//alert(fl);

	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=70',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
				
			if(fl=='1'){
				$('#patient_type').empty();
			 $.each(data, function(index, element) {
			 	$('#patient_type').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			}else{
				$('#patient_type').empty();
				/*$('#patient_type').append($('<option/>', { 

					value: '',
					text : '' 

				}));*/
				$.each(data, function(index, element) {
			 	$('#patient_type').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			get_patient_details();
			}
			
			 },
			 complete: function(){
			  $('.ajax-loader').css("visibility", "hidden");
			}

		  });
	
	
}
function calculate_mfg_expire_date(name,mfg_date_year_val,mfg_date_month_val,mfg_date_day_val){
	//alert(mfg_date_year_val);
	var mfg_expire_date=mfg_date_day_val+'-'+mfg_date_month_val+'-'+mfg_date_year_val;
	$("#"+name).val(mfg_expire_date);
	
}
function calculate_expire_day(name,mfg_date_year_val,mfg_date_month_val){
	//alert(mfg_date_year_val);
	if(mfg_date_year_val==''){
		mfg_date_year_val=new Date().getFullYear();
	}
	if(mfg_date_month_val==''){
		var mfg_date_month=new Date().getMonth();
		var mfg_month=parseInt(mfg_date_month)+1;
		if(mfg_month<10){
			mfg_date_month_val='0'+mfg_month;
		}else{
			mfg_date_month_val=mfg_month;
		}
		
	}
	//alert(mfg_date_month_val);
	var a_date=mfg_date_year_val+'-'+mfg_date_month_val+'-01';
	 $.ajax({
		 				beforeSend: function(){
						  $('.ajax-loader').css("visibility", "visible");
						},
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/expire_date_cal_ajax.php",
						dataType : "json", 
						data : "a_date="+a_date,
						success : function(data) {								
								 $("#"+name).val(data.return_date);				
							
						},
						 complete: function(){
							 $('.ajax-loader').css("visibility", "hidden");
						}
					});
}

function load_expiry_date(){
	$("#batch_expiry").html("");
	var item_val=$("#item").find(":selected").val().split("^");
	item_id=item_val[0];
	batch_code=$("#batch_code_val").find(":selected").val();
	if((item_id=='')||(batch_code=='')){
		return false;	
	}
	
	$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=73',
			type: 'POST',
			dataType: 'json',
			data: "item_id="+item_id+"&batch_code="+batch_code,
			async: false, 
			success: function (data) {			
		 		
				//alert(data.closing_stock);
				
					$("#batch_expiry").html("Exp: "+data.expiry_date);	
				
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});

}

function add_indent_sale_pharma_return(order_id,sub_type_name,item_id,item_name1,qty,batch_no,cust_id,cust_name,cust_ph)
{
	message_var='Are you sure to return '+item_name1+' '+qty+'PCS for batch '+batch_no+' from '+cust_name ;
	if (confirm(message_var)) {
	var drug_order_id_arr= $("#drug_order_id_arr").val();
	var new_order_id="";
	if(drug_order_id_arr==''){
		new_order_id=order_id+',';
	}else{		
	new_order_id=drug_order_id_arr+order_id+',';
	}	
	$("#drug_order_id_arr").val(new_order_id);
	
	var customer_id_arr= $("#customer_id_arr").val();
	var new_order_id_customer="";
	if(customer_id_arr==''){
		new_order_id_customer=cust_id+',';
	}else{		
	new_order_id_customer=customer_id_arr+cust_id+',';
	}
	$("#customer_id_arr").val(new_order_id_customer);
	
	$("#customer_name").val(cust_name);
	$("#phone_number").val(cust_ph);
	//$("#drug_order_id_arr").val(new_order_id);
	var new_cust_ids=$("#customer_id_arr").val();
	if(tab_asset_entry!="") tab_asset_entry.destroy();
	var data_details={
		"patient_id": $("#patient_id").val(),	
		"uhid": $("#uhid").val(),
		"drug_order_id_arr": $("#drug_order_id_arr").val(),
		"order_id_val": order_id,
		"walk_in_patient_flag":"0",	
		"new_cust_ids": new_cust_ids,
		"cust_check":"0"	
}

$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=74',
			type: 'POST',
			data: data_details,
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				$("#pharma_order_body").html(data);
				tab_asset_entry=$("#pharma_order_data1").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				$("#sub_type_name").val(sub_type_name);
				load_asset_entry_data_return(batch_no,qty,item_name1);
				//alert(item_name);
				$("#s2id_autogen1_search").val(item_name);
				$("#freeItem_qty").attr("data-qty",qty);
				$("#freeItem_qty").val(qty);
				item_name=item_name1;
				
				
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
		});
		}else{
		//$("#item_1_6_tick").prop("checked","false");
		$("#item_"+qty+"_"+order_id+"_tick").removeAttr( "checked" );
	}
		
}

function load_batch_codes_for_return(batch_no,qty,item_name){

	let item_val=$("#item").find(":selected").val().split("^");
	let item_id=item_val[0];
	$('#batch_code_val').empty();

	$('#batch_code_val').append($('<option/>', { 
				value: batch_no,
				text : batch_no 
	}));
		
	load_stock_return(batch_no,qty,item_name);
}
function load_stock_return(batch_no,qty,item_name){
	
	var item_id="";
	var batch_code="";
	$("#stock_qty").html(qty);
}

function load_asset_entry_data_return(batch_no,qty,item_name){
	
		$('#item').empty();
		$("#item").val('');
		$("#freeItem_qty").val('');	
		
		$('#select2-chosen-1').empty();
		$('#batch_code_val').empty();
		$("#stock_qty").html('');
		
		
		
		$('#item').append($('<option/>', { 
		
							value: '',
							text : '-Select-' 
		
						}));
		
		var data_details={
				"id": $("#id").val(),
				"dept_name": $("#dept_name").val(),
				"type_name": $("#type_name").val(),
				"sub_type_name": $("#sub_type_name").val(),
				"location_name": $("#location_name :selected").text(),
				"location_id": $("#location_name").val(),
				
		}
		
		$.ajax({
			beforeSend: function(){
			  $('.ajax-loader').css("visibility", "visible");
			},
            url: 'get_json_data_inventory.php?flag=41',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
				$.each(data, function(index, element) {
			 	$('#item').append($('<option/>', { 

					value: element.id,
					text : element.text 

				}));
		 	});
			
			$("#item").focus();
				//alert(searchOption('item',item_name));
				var idval=searchOption('item',item_name);
				$("#item").select2("val",idval);
				//load_batch_codes();	
				load_batch_codes_for_return(batch_no,qty,item_name);
			},
			 complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			}
			
		}); 

}

</script>
</body><!-- END BODY -->
</html>