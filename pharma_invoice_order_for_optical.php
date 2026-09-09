<?php

include "conn.php"; // Using database connection file here

?>
<?php include "header_for_optical.php"; ?>
<style>
#add_table>tbody>tr>td, #add_table>tbody>tr>th, #add_table>tfoot>tr>td, #add_table>tfoot>tr>th, #add_table>thead>tr>td, #add_table>thead>tr>th {
	padding:1px;
	font-size: 11px;
}
#add_table .form-control {
	height:28px;
}
</style>

<div class="page-container">
  <div class="page-content">
    <div class="container-fluid">
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"> <?php echo str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-16));?> </li>
      </ul>
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-16)));?></span></div>
            </div>
            
            <!-- BEGIN FORM--> 
            
            <!-- END PAGE CONTENT --> 
            
          </div>
          <div class="col-md-12" >
            <div class="col-md-4" style="padding-left:0px; padding-right:2px">
              <div class="form-group"> 
                <!--<input type="text" id="patient_uhid" value="" name="patient_uhid" class="form-control" placeholder="Enter UHID No...">-->
                <select name="patient_uhid" id="patient_uhid" class="form-control select2" onChange="old_pres_pb_fetch_model()">
                  <option value="">Choose..</option>
                  <?php 
                       $sql7="SELECT * FROM `patient_registration_form`  WHERE  `del_flag`='0'   ORDER BY `id` DESC";
                       $result7=$conn->query($sql7) ;
                       while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                       {									 
                           echo '<option value="'.$row7['uhid_no'].'" ';  echo '>'.$row7['uhid_no'].' ( '.$row7['patient_name'].' '.$row7['phone_no'].' )</option>';
                       }
                      ?>
                </select>
              </div>
            </div>
            <div class="col-md-8" style="text-align:left !important;"> 
              <!--<button class="btn-circle btn blue" style="display:none" id="print_pres" >Print Glass Prescription</button>-->
              <div class="col-md-3"> <a href="javascript:void(0);" target="_blank" class="btn-circle btn blue" style="display:none" id="print_pres" >Print Glass Prescription</a> </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-2" style="padding-left:0px; padding-right:2px">
              <label class="control-label">Patient UHID</label>
              <input type="text" class="form-control" placeholder="UHID" name="uhid" id="uhid" readonly="readonly" />
              <input type="hidden" class="form-control" placeholder="UHID" name="prescription_id" id="prescription_id" value="" />
              <input type="hidden" class="form-control" placeholder="UHID" name="patient_registration_id" id="patient_registration_id" value="" />
              <input type="hidden" class="form-control" placeholder="UHID" name="slip_id" id="slip_id" value="" />
            </div>
            <div class="col-md-3" style="padding-left:0px; padding-right:2px">
              <label class="control-label">Patient Name</label>
              <input type="text" class="form-control" placeholder="Customer Name" name="customer_name" id="customer_name" />
            </div>
            <div class="col-md-2" style="padding-left:0px; padding-right:2px">
              <label class="control-label">Invoice Date</label>
              <input type="text" class="form-control" placeholder="Date" name="inv_date" id="inv_date" value="<?php echo date("d/m/Y") ?>" />
            </div>
            <div class="col-md-2" style="padding-left:0px; padding-right:2px">
              <label class="control-label">Patient Phone No</label>
              <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" id="phone_number" />
            </div>
            <div class="col-md-3" style="padding-left:0px; padding-right:2px">
              <label class="control-label">Doctor</label>
              <br>
              <select id="doctors" class="form-control select2" style="width:200px">
                <option value="">-Select-</option>
              </select>
            </div>
          </div>
          <div style="clear:both"></div>
          <div class="col-md-12">
            <p>&nbsp;</p>
          </div>
          <div class="col-md-12">
            <div class="col-md-2" style="padding-left:0px; padding-right:2px">
              <label class="control-label">PD</label>
              <input type="text" id="pd" class="form-control" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="PD">
            </div>
            <div class="col-md-2" style="padding-left:0px; padding-right:2px">
              <label class="control-label">SEG HT</label>
              <input type="text" id="seght" class="form-control" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="SEG HT">
            </div>
            <div class="col-md-2" style="padding-left:0px; padding-right:2px">
              <label class="control-label">COATING</label>
              <input type="text" id="coating" class="form-control" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="COATING">
            </div>
            <div class="col-md-3" style="padding-left:0px; padding-right:2px">
              <label class="control-label">COLOR</label>
              <input type="text" id="color" class="form-control" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="COLOR">
            </div>
            <div class="col-md-2" style="padding-left:0px; padding-right:2px">
              <label class="control-label">EXPECTED DELIVERY DATE</label>
              <input type="text" id="exp_date" class="form-control" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="EXP DEL DATE">
            </div>
          </div>
          <div style="clear:both"></div>
          <div class="col-md-12">
            <p>&nbsp;</p>
          </div>
          <div class="col-md-12">
            <div class="col-md-4">
              <label>
                <input type="checkbox" id="vendor_print" checked="checked" />
                Print vendor copy</label>
            </div>
            <div class="col-md-4" style="padding-left:0px; padding-right:2px">
              <label class="control-label"><strong>REMARKS</strong></label>
              <textarea id="remarks" class="form-control" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" rows="4" placeholder="REMARKS"></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <hr style="border-top: 1px solid #000;"/>
          </div>
          <div class="col-md-5" style="float: left;margin-top: 0 !important;padding-top: 0 !important;">
            <label class="control-label">Scan with barcode :&nbsp;&nbsp;&nbsp;
              <button type="button" class="btn btn-blue" id="qr_scan" style="background-color:#ebebeb;"><i class="fa fa-barcode fa-lg" aria-hidden="true" style="padding: 10px 0px 0px 0px;font-size:39px !important;"></i></button>
              <input type="text" name="qr_scan_input" id="qr_scan_input" class="form-control" value="<?php echo $qr_scan_input; ?>" style="position: absolute;margin: -42px 0px 0px 222px;width: 53%;display:none;pointer-events:none;">
            </label>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Choose Vendor</label>
              <select class="form-control" id="vendor_name">
                <option value="">Other</option>
              </select>
            </div>
          </div>
          <div class="col-md-1" style="float: right;margin-top: 0 !important;padding-top: 0 !important;">
            <button class="btn green" onClick="add_item()"><i class="fa fa-plus" title="ADD ITEM"></i></button>
          </div>
          <div class="col-md-12" style="overflow:auto">
            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Type</label>
                <select class="form-control" id="type_name" onChange="load_sub_types();">
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Sub Type</label>
                <select class="form-control" id="sub_type_name" onChange="load_item()">
                  <option value="">Level 1</option>
                  <option value="">Level 2</option>
                  <option value="">Other</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Item</label>
                <select class="form-control item" id="item" onChange="load_gp();load_batch_codes();" >
                </select>
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for="">Batch No</label>
                <select class="form-control" id="batch_code_val" onchange="search_code();load_stock();">
                </select>
                <input type="hidden" class="form-control" id="batch_flag" name="batch_flag"  value="0" />
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for="">Rate (MRP)</label>
                <input type="text" class="form-control" id="mrp" name="mrp" />
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for="">Quantity</label>
                <input type="text" id="freeItem_qty" class="form-control"  data-qty="" />
                <span id='stock_qty' style="font-weight:bold"></span> </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Input GP</label>
                <table class="table table-bordered table-hover" id="add_table">
                  <thead>
                    <tr>
                      <th></th>
                      <th>SPH</th>
                      <th>Cyl</th>
                      <th>Axis</th>
                      <th>Add</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>RE</b></td>
                      <td><input style="width:70px" type="text" class="gp gpr form-control" id="rspf" ></td>
                      <td><input style="width:70px" class="gp form-control" type="text" id="rcyl" ></td>
                      <td><input type="text" style="width:70px" class="gp form-control" id="1_raxis" ></td>
                      <td><input type="text" class="gp form-control" style="width:70px" id="radd" ></td>
                    </tr>
                    <tr>
                      <td><b>LE</b></td>
                      <td><input style="width:70px" type="text" class="gp gpr form-control" id="lspf" ></td>
                      <td><input style="width:70px" class="gp form-control" type="text" id="lcyl" ></td>
                      <td><input type="text" style="width:70px" class="gp form-control" id="1_laxis" ></td>
                      <td><input type="text" class="gp form-control" style="width:70px" id="ladd" ></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-12" style="overflow:auto">
            <table class="table table-striped table-bordered table-hover small" id="asset_entry_data1">
              <caption>
              Order List: User: <?php echo $_SESSION["user_full_name"]; ?>
              </caption>
              <thead>
                <tr>
                  <th class="draggable" data-column="asset_name" style="cursor: move;"><span>HSN Code </span></th>
                  <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Asset Name </span></th>
                  <th class="draggable right" data-column="size" style="cursor: move;"><span>Size </span></th>
                  <th class="draggable right" data-column="size" style="cursor: move;"><span>Colour </span></th>
                  <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Batch No. </span></th>
                  <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Mfg. Date </span></th>
                  <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Expiry Date </span></th>
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
                  <td colspan="11" align="right">Total</td>
                  <td><span id="total_amount"></span></td>
                  <td colspan="7"></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="11" align="right">Add: CGST</td>
                  <td><span id="CGST_amount_"></span></td>
                  <td colspan="7"></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="11" align="right">Add: SGST</td>
                  <td><span id="SGST_amount_"></span></td>
                  <td colspan="7"></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="11" align="right">Net Total</td>
                  <td><span id="net_total_"></span></td>
                  <td colspan="7"></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="10" align="right">Mode of Payment</td>
                  <td>Cash</td>
                  <td><input type="text" id="cash" style='width:80px' onkeyup="calculate_payment()" placeholder="Cash" value="0" /></td>
                  <td colspan="7"></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="10" align="right">Mode of Payment</td>
                  <td>Card</td>
                  <td><input type="text" id="card" style='width:80px' onkeyup="calculate_payment()" placeholder="Card" value="0" /></td>
                  <td colspan="7"></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="10" align="right">Mode of Payment</td>
                  <td>UPI</td>
                  <td><input type="text" id="UPI" style='width:80px' onkeyup="calculate_payment()" placeholder="UPI" value="0" /></td>
                  <td colspan="7"></td>
                </tr>
                <tr style="font-weight:bold;font-size:15px;">
                  <td colspan="11" align="right">Amount Due</td>
                  <td><span id="bal"></span></td>
                  <td colspan="7"></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="col-md-12" style="text-align:center; margin-bottom:10px">
            <input type="button" class="btn" onClick="save_sales()" value="Save Order" style="background:#000099;color:#FFFFFF;width:120px" />
            &nbsp;&nbsp;
            <input type="button" class="btn" onClick="modal_show(1); return false;" value="Save & Print" style="background:#000099;color:#FFFFFF;width:120px" />
          </div>
          <div style="clear:both; height:15px">&nbsp;</div>
        </div>
         <table class="table table-striped table-bordered table-hover small" id="full_tab_details">
                  <caption>Full Order Details <strong style="float:right;display:flex;line-height:34px;">Search:&nbsp;&nbsp;<input type="text" class="form-control" name="search" id="search" value="" style="width:100%;"/></strong></caption>
                  <thead>
                    <tr>
                      <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Invoice Number</span></th>
                      <th class="draggable" data-column="category_name" style="cursor: move;"><span>Invoice Date</span></th>
                      <th class="draggable" data-column="sub_cat"><span>Customer Name</span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Amount </span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Advance Amount </span></th>
                      <th class="print_ignore"><span>Action</span></th>
                    </tr>
                  </thead>
                  <tbody id="tab_po_body">
                  </tbody>
                </table>
                <?php 
					$sql_="select * from `sales_order_for_optical`";
					$result=mysqli_query($conn,$sql_);
					$count=$result->num_rows;  
					$count_limit=ceil($count / $limit);
					echo '<div class="col-md-6" style="float:right;text-align:right;">';
					for ($page_number = 1; $page_number <=$count_limit; $page_number++) {
					  echo '<a href="javascript:void(0);" class="btn btn-primary" onClick="load_sale_order_details('.$page_number.')">'.$page_number.'</a>';
					}
					echo '</div>';
					?>
                <input type="hidden" name="row_limit" id="row_limit" value="<?php echo $limit?>">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><strong>Select Prescription Date</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body" id="old_patient_date_popup_show"> </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- END PAGE CONTENT INNER --> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTENT --> 
  
</div>
<?php include("footer_for_optical.php"); ?>
<script>


//load_tpa();
load_vendor();
var tab_asset_entry="";
load_types();
load_sub_types();
var mrp=0;
var expiry_date="";
var cou_pag_no=0;
load_sale_order_details(cou_pag_no);
//load_item();
load_doctors();
var uhid="";
var operator="";
var print_flag=0;
//search_code();
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
$("#exp_date").datepicker({
	   format: 'dd-mm-yyyy'
   });

$( document ).ready(function() {
	
    $("#freeItem_qty").change(function(){
  		$("#freeItem_qty").attr("data-qty",$("#freeItem_qty").val());
	});
	$("#freeItem_qty").keypress(function(event){
		if ( event.which == 13 ) {
			//console.log(search_code($(this).val()));
			if($('#mrp').val()!=''){
			add_item();
			}else{
			$('#mrp').focus();
			}
		}
	});
	$('#patient_uhid').select2();
	/*$("#patient_uhid").keypress(function(event){
		if ( event.which == 13 ) {
			//console.log(search_code($(this).val()));
			get_patient_details();
		}
	});*/
	$("#qr_scan").on('click',function(event){
		$('#qr_scan_input').css('display','block');
		$('#qr_scan_input').focus();
		$('#qr_scan_input').val('');
		//$('#qr_scan_input').css('pointer-events','none');
		
	});
	$("#qr_scan_input").keypress(function(event){
		if ( event.which == 13 ) {
			var barcode=$(this).val();
			serch_item_ber_code(barcode);
		}
	});
	$(".gpr").blur(function(){
		let rsph=$("#rspf").val();
		let lsph=$("#lspf").val();
		//get_
	});

	$('#item').select2();
	$('#doctors').select2();
	$("#item").live('change', function(){
  		$("#freeItem_qty").focus();
	});
		$("#search").on("keyup", function() {
		  var value = $(this).val().toLowerCase();
		  $("#tab_po_body tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		  });
		});
});
function load_vendor(){

	$('#vendor_name').empty();

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=11',

			dataType: 'json',

			type: 'POST',

			success: function (data) {

			 $.each(data, function(index, element) {

			 	$('#vendor_name').append($('<option/>', { 

					value: element.id,

					text : element.vendor_name 

				}));

		 	});

			 }

		  });

}
function serch_item_ber_code(bar_code){
	$('#qr_scan_input').val('');
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=48',
			type: 'POST',
			dataType: 'json',
			data: "barcode="+bar_code,
			async: false, 
			success: function (data) {
				load_types(data.type_id);
				load_sub_types(data.type_id,data.sub_type_id);
				load_item(data.type_id,data.sub_type_id,data.item_details);
				load_batch_codes(data.item_details);
				
			}

		});
}

function add_item(){
	//alert($("#batch_code_val").find(":selected").val());
	if($("#item").val()==''){
		alert('Please Select Item!..');
		return false;
	}
		add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value);	

}
function del(id){
	$("#"+id).remove();
	calculate(id);
}
var icount=1;
function add_indent_free(id,indent_id,indent_details_id,item_id){
	let item_val=$("#item").val().split("^");
	var src=$("#assets_indent_body").html();
	if((($("#freeItem_qty").val())=='') || (($("#freeItem_qty").val())<'1') ){
	  alert("Please Give Quantity");
	  return false;	
	}
	if($("#batch_flag").val()=='1'){
	if(parseInt($("#stock_qty").html())<parseInt($("#freeItem_qty").val())){
		alert("Quantity not in stock");
		return false;
	}else{
		$("#freeItem_qty").val(1);
	}
	}
	/*if(item_stock_validation(id+item_val[0])!=true){
		return false;	
	};*/
	//let batch_val=$("#batch_code_val option:selected").text();
	var tds = $(src).find("td[id='"+id+item_val[0]+"_qty_qty']");
	//console.log("Batch Code"+tds.html());
	let gst=item_val[2];
	let mrp=$('#mrp').val();
	//console.log(mrp);
	//Back Calculation
	if(gst!=0 || gst!=''){
		mrp=parseFloat((parseFloat(mrp)/(parseFloat(gst)+100))*100).toFixed(2);
	}
	var batch_code_value="";
	/*var check_val_batch = $('#batch_code_val[document_type]').val();
	if(typeof check_val_batch === "undefined"){
	   batch_code_value="";
	}else{
	   batch_code_value=$("#batch_code_val").val();
	}*/
	if($("#batch_flag").val()=='0'){
	   batch_code_value="";
	}else{
	   batch_code_value=$("#batch_code_val").val();
	}
	//icount=parseFloat(icount+1);
	if(typeof tds.html() === "undefined"){ 
		//alert($("#type_name option:selected").text());
	if($("#type_name option:selected").text().toUpperCase()=="FRAME" || $("#type_name").text().toUpperCase()=="FRAMES"){
		$("#assets_indent_body").append("<tr id='"+id+item_val[0]+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+"_asset_name' >"+$("#item :selected").text()+"</td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+"_batch_no' style='width:80px' value='"+batch_code_value+"' ></td><td id='"+id+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+"_mfg_date' class='mfg_date' value='"+mfg_date+"' ></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ></td><td id='"+id+item_val[0]+"_qty_qty' >"+$("#"+id+"_qty").attr("data-qty")+"</td><td><input style='width:80px' type='text' value='"+mrp+"' id='"+id+item_val[0]+"_rate' onblur='calculate(\""+id+item_val[0]+"\")'  ></td><td><input type='text' id='"+id+item_val[0]+"_discount_rate' onblur='calculate(\""+id+item_val[0]+"\")'  size=5 value='0' ></td><td><input type='text' value='0'  id='"+id+item_val[0]+"_discount_amount' size=5 onchange='calculate_per(\""+id+item_val[0]+"\")'></td><td><input type='text' id='"+id+item_val[0]+"_total_amount' style='width:80px' value='"+(mrp*$("#"+id+"_qty").val())+"' ></td><td><span id='"+id+item_val[0]+"_gstrate' size=5 >"+item_val[2]+"</span></td><td><span id='"+id+item_val[0]+"_gst_amount' onblur='calculate(\""+id+item_val[0]+"\")' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_cgstrate' size=5 >"+item_val[5]+"</span></td><td><span id='"+id+item_val[0]+"_cgst_amount' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_sgstrate' >"+item_val[6]+"</span></td><td><span id='"+id+item_val[0]+"_sgst_amount' >0</span></td><td><span id='"+id+item_val[0]+"_net_amount' >0</span></td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+"\")'><i class='fa fa-trash'></i></a></td></tr>");

		

		}else{

		

			$("#assets_indent_body").append("<tr id='"+id+item_val[0]+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+"_asset_name' >"+$("#item :selected").text()+"<br><table class='table table-striped table-bordered table-hover small' id='add_table'><thead><th></th><th>SPF</th><th>Cyl</th><th>Axis</th><th>Add</th></thead><tbody><tr><td><b>RE</b></td><td><label style='width:70px' id='"+id+"_rspf_' >"+$("#rspf").val()+"</label></td><td><label style='width:70px' id='"+id+item_val[0]+"_rcyl_' >"+$("#rcyl").val()+" </label></td><td><label style='width:70px' id='"+id+item_val[0]+"_raxis_'>"+$("#1_raxis").val()+"</label></td><td><label style='width:70px' id='"+id+item_val[0]+"_radd_'>"+$("#radd").val()+"</label></td><tr><td><b>LE</b></td><td><label style='width:70px' id='"+id+item_val[0]+"_lspf_' >"+$("#lspf").val()+"</label></td><td><label style='width:70px' id='"+id+item_val[0]+"_lcyl_' >"+$("#lcyl").val()+"</label></td><td><label style='width:70px' id='"+id+item_val[0]+"_laxis_' >"+$("#1_laxis").val()+"</label></td><td><label style='width:70px' id='"+id+"_ladd_'>"+$("#ladd").val()+"</label></td></tr></tr></tbody></table></td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+"_batch_no' style='width:80px' value='"+batch_code_value+"' ></td><td id='"+id+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+"_mfg_date' class='mfg_date' value='"+mfg_date+"'  ></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ></td><td id='"+id+item_val[0]+"_qty_qty' >"+$("#"+id+"_qty").attr("data-qty")+"</td><td><input style='width:80px' type='text' value='"+mrp+"' id='"+id+item_val[0]+"_rate' onblur='calculate(\""+id+item_val[0]+"\")'  ></td><td><input type='text' id='"+id+item_val[0]+"_discount_rate' onblur='calculate(\""+id+item_val[0]+"\")'  size=5 value='0' ></td><td><input type='text' value='0'  id='"+id+item_val[0]+"_discount_amount' size=5 onchange='calculate_per(\""+id+item_val[0]+"\")' ></td><td><input type='text' id='"+id+item_val[0]+"_total_amount' style='width:80px' value='"+(mrp*$("#"+id+"_qty").val())+"' ></td><td><span id='"+id+item_val[0]+"_gstrate' size=5 >"+item_val[2]+"</span></td><td><span id='"+id+item_val[0]+"_gst_amount' onblur='calculate(\""+id+item_val[0]+"\")' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_cgstrate' size=5 >"+item_val[5]+"</span></td><td><span id='"+id+item_val[0]+"_cgst_amount' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_sgstrate' >"+item_val[6]+"</span></td><td><span id='"+id+item_val[0]+"_sgst_amount' >0</span></td><td><span id='"+id+item_val[0]+"_net_amount' >0</span></td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+"\")'><i class='fa fa-trash'></i></a></td></tr>");

		

		}

	

	$("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())));

	calculate(id+item_val[0]);

	

	

	}else{

	 	if($("#"+id+item_val[0]+"_batch_no").val()!=$("#batch_code_val").val()){

			//alert($("[name='"+id+item_val[0]+"_batch_no_sub']").val());

			if(typeof $("[name='"+id+item_val[0]+"_batch_no_sub']").val() === "undefined"){ 

			icount=parseFloat(icount+1);

			if($("#type_name option:selected").text().toUpperCase()=="FRAME" || $("#type_name").text().toUpperCase()=="FRAMES"){

	

					$("#assets_indent_body").append("<tr id='"+id+item_val[0]+icount+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+"_asset_name' >"+$("#item :selected").text()+"</td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+"_batch_no' style='width:80px' value='"+batch_code_value+"' ></td><td id='"+id+"_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+"_mfg_date' class='mfg_date' ></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ></td><td id='"+id+item_val[0]+"_qty_qty_sub' >"+$("#"+id+"_qty").val()+"</td><td><input style='width:80px' type='text' value='"+mrp+"' id='"+id+item_val[0]+"_rate' onblur='calculate(\""+id+item_val[0]+"\")'  ></td><td><input type='text' id='"+id+item_val[0]+"_discount_rate' onblur='calculate(\""+id+item_val[0]+"\")'  size=5 value='0' ></td><td><input type='text' value='0'  id='"+id+item_val[0]+"_discount_amount' size=5 onchange='calculate_per(\""+id+item_val[0]+"\")'></td><td><input type='text' id='"+id+item_val[0]+"_total_amount' style='width:80px' value='"+(mrp*$("#"+id+"_qty").val())+"' ></td><td><span id='"+id+item_val[0]+"_gstrate' size=5 >"+item_val[2]+"</span></td><td><span id='"+id+item_val[0]+"_gst_amount' onblur='calculate(\""+id+item_val[0]+"\")' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_cgstrate' size=5 >"+item_val[5]+"</span></td><td><span id='"+id+item_val[0]+"_cgst_amount' size=5 >0</span></td><td><span id='"+id+item_val[0]+"_sgstrate' >"+item_val[6]+"</span></td><td><span id='"+id+item_val[0]+"_sgst_amount' >0</span></td><td><span id='"+id+item_val[0]+"_net_amount' >0</span></td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+"\")'><i class='fa fa-trash'></i></a></td></tr>");

					

					}else{

						

						$("#assets_indent_body").append("<tr id='"+id+item_val[0]+icount+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+icount+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+icount+"_asset_name' >"+$("#item :selected").text()+"<br><table class='table table-striped table-bordered table-hover small' id='add_table'><thead><th></th><th>SPF</th><th>Cyl</th><th>Axis</th><th>Add</th></thead><tbody><tr><td><b>RE</b></td><td><label style='width:70px' id='"+id+item_val[0]+icount+"_rspf_' >"+$("#rspf").val()+"</label></td><td><label style='width:70px' id='"+id+item_val[0]+icount+"_rcyl_' >"+$("#rcyl").val()+" </label></td><td><label style='width:70px' id='"+id+item_val[0]+icount+"_raxis_'>"+$("#1_raxis").val()+"</label></td><td><label style='width:70px' id='"+id+item_val[0]+icount+"_radd_'>"+$("#radd").val()+"</label></td><tr><td><b>LE</b></td><td><label style='width:70px' id='"+id+item_val[0]+icount+"_lspf_' >"+$("#lspf").val()+"</label></td><td><label style='width:70px' id='"+id+item_val[0]+icount+"_lcyl_' >"+$("#lcyl").val()+"</label></td><td><label style='width:70px' id='"+id+item_val[0]+icount+"_laxis_' >"+$("#1_laxis").val()+"</label></td><td><label style='width:70px' id='"+id+item_val[0]+icount+"_ladd_'>"+$("#ladd").val()+"</label></td></tr></tr></tbody></table></td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+icount+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+icount+"_batch_no' name='"+id+item_val[0]+"_batch_no_sub' style='width:80px' value='"+batch_code_value+"' ></td><td id='"+id+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+icount+"_mfg_date' class='mfg_date' ></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+icount+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ></td><td id='"+id+item_val[0]+icount+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><input style='width:80px' type='text' value='"+mrp+"' id='"+id+item_val[0]+icount+"_rate' onblur='calculate(\""+id+item_val[0]+icount+"\")'  ></td><td><input type='text' id='"+id+item_val[0]+icount+"_discount_rate' onblur='calculate(\""+id+item_val[0]+icount+"\")'  size=5 value='0' ></td><td><input type='text' value='0'  id='"+id+item_val[0]+icount+"_discount_amount' size=5 onchange='calculate_per(\""+id+item_val[0]+icount+"\")' ></td><td><input type='text' id='"+id+item_val[0]+icount+"_total_amount' style='width:80px' value='"+(mrp*$("#"+id+"_qty").val())+"' ></td><td><span id='"+id+item_val[0]+icount+"_gstrate' size=5 >"+item_val[2]+"</span></td><td><span id='"+id+item_val[0]+icount+"_gst_amount' onblur='calculate(\""+id+item_val[0]+icount+"\")' size=5 >0</span></td><td><span id='"+id+item_val[0]+icount+"_cgstrate' size=5 >"+item_val[5]+"</span></td><td><span id='"+id+item_val[0]+icount+"_cgst_amount' size=5 >0</span></td><td><span id='"+id+item_val[0]+icount+"_sgstrate' >"+item_val[6]+"</span></td><td><span id='"+id+item_val[0]+icount+"_sgst_amount' >0</span></td><td><span id='"+id+item_val[0]+icount+"_net_amount' >0</span></td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+icount+"\")'><i class='fa fa-trash'></i></a></td></tr>");

					

					}}else{

						let qty_added=$("#"+id+item_val[0]+icount+"_qty_qty").html();

						 alert(qty_added);

						$("#"+id+item_val[0]+icount+"_qty_qty").html((parseFloat(qty_added)+parseFloat($("#"+id+"_qty").val())));

						 $("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())+parseFloat(qty_added)));

						 calculate(id+item_val[0]);	

					}

					

			

		}else{

				 let qty_added=tds.html();

				// alert(tds.html());

				 $("#"+id+item_val[0]+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));

				 $("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())+parseFloat(qty_added)));

				 calculate(id+item_val[0]);	

		}

		

	 }

	 $("#item").select2("val", '');

	 load_batch_codes();

	 $('#freeItem_qty').attr('data-qty', '');

	 $('#freeItem_qty').val('');

	 

	 

}

$("#stock_qty").html('');

function save_sales(flag=0){
	if(parseFloat($("#bal").html())<0){
		alert("Over paid");
		return false;
	}/*else if(parseFloat($("#bal").html())>0){

		alert("Under paid");

		return false;

	} */
	if($("#patient_uhid").val()=="" ){
		alert("Please fill up patients details");
		$("#patient_uhid").focus();
		return false;
	}
	if($("#vendor_name").val()=="" ){
		alert("Please Select Vendor");
		$("#vendor_name").focus();
		return false;
	}
	let doc=$("#doctors").select2('data');
	let doc_val="";
	if(doc.text!="" || !doc.text){
		doc_val=doc.text;
	}else{
		if(confirm("Do you want to continue without Doctor?")) doc_val="";
		else return false;
	}
	

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
	/*let rspf=[];
	let rcyl=[];
	let raxis=[];
	let radd=[];
	let lspf=[];
	let lcyl=[];
	let laxis=[];
	let ladd=[];*/
	let item_hsn_code=[];
	let i=0;
	let return_flag=0;
	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){
  		console.log( index + ": " + $( this ).attr('id') );
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
		item_hsn_code[i]=$("#"+$( this ).attr('id')+"_hsmcode").html();
		console.log("MRP::"+$("#"+$( this ).attr('id')+"_mrp").val());
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
		"cash": $("#cash").val(),
		"card": $("#card").val(),
		"upi": $("#UPI").val(),
		"tpa_company": $("#tpa").val(),
		"tpa_amount": $("#tpa_amount").val(),
		"doctor": doc_val,
		"uhid":$("#patient_uhid").val(),
		"advance_amount": parseFloat($("#cash").val())+parseFloat($("#card").val())+parseFloat($("#UPI").val()),
		"pd": $("#pd").val(),
		"seght": $("#seght").val(),
		"coating": $("#coating").val(),
		"color": $("#color").val(),
		"remarks": $("#remarks").val(),
		"exp_date": $("#exp_date").val(),
		"operator": operator,
		"item_hsn_code": item_hsn_code,
		"rspf": $("#rspf").val(),
		"rcyl": $("#rcyl").val(),
		"raxis": $("#1_raxis").val(),
		"radd": $("#radd").val(),
		"lspf": $("#lspf").val(),
		"lcyl": $("#lcyl").val(),
		"laxis": $("#1_laxis").val(),
		"ladd": $("#ladd").val()
		//"mrp" : mrp
	}
	$.ajax({

            url: 'get_json_data_for_optical.php?flag=36',

			type: 'POST',

			dataType: 'json',

			data: data_details,

			success: function (data) {
				if(data.flag=="1"){
				 	toastr.success('Order Saved Successfully');
				}else{
				 	if(data.reason!="") toastr.error(data.reason);
				 	else toastr.error('Unable to save order');
				}
				setTimeout(function(){ location.reload(); }, 2000);	

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

	net_total=Math.round(net_total);

	

	$("#total_amount").html(parseFloat(total).toFixed(2));

	$("#CGST_amount_").html(cgst.toFixed(2));

	$("#SGST_amount_").html(sgst.toFixed(2));

	$("#net_total_").html(net_total);

	let cash=$("#cash").val();

	let card=$("#card").val();

	let upi=$("#UPI").val();

	//let tpa=$("#tpa_amount").val();

	//console.log(cash+'~~'+card+'~~'+upi+'~~'+tpa);

	let bal=parseFloat(net_total)-(parseFloat(cash)+parseFloat(card)+parseFloat(upi)/*+parseFloat(tpa)*/);

	$("#bal").html(bal);

}
function calculate_per(id){

	if(confirm("Are You Change Amount?")) {

	let total=0;

	let cgst=0;

	let sgst=0;

	let net_total=0;

	$("#"+id+"_total_amount").val(parseFloat(($("#"+id+"_rate").val())*($("#"+id+"_qty_qty").html())).toFixed(2));

	let disc_amount=$("#"+id+"_discount_amount").val();

	let disc_per=(disc_amount!='' ) ? (disc_amount*100)/$("#"+id+"_total_amount").val() : '';

	disc_amount=parseFloat(disc_amount).toFixed(2);

	

	console.log(disc_per);

	$("#"+id+"_discount_amount").val(disc_amount);

	$("#"+id+"_discount_rate").val(parseFloat(disc_per).toFixed(2));

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

	net_total=Math.round(net_total)

	$("#total_amount").html(parseFloat(total).toFixed(2));

	$("#CGST_amount_").html(cgst.toFixed(2));

	$("#SGST_amount_").html(sgst.toFixed(2));

	$("#net_total_").html(net_total);

	let cash=$("#cash").val();

	let card=$("#card").val();

	let upi=$("#UPI").val();

	//let tpa=$("#tpa_amount").val();

	let bal=net_total-(parseFloat(cash)+parseFloat(card)+parseFloat(upi)/*+parseFloat(tpa)*/);

	$("#bal").html(bal);

	}

}
function data_reset(){



	$("#assets_indent_body").html("");

	$("#indent").val('');

	$("#vendor_name").val('');

	load_purchase();



}
function load_types(id){
	$('#type_name').empty();
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=5',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			 $.each(data, function(index, element) {
			 	$('#type_name').append($('<option/>', { 
					value: element.id,
					text : element.text 
				}));
		 	});
			//alert(id);
				if(id!="")	$("#type_name option[value="+id+"]").attr("selected","selected");
			 }
		  });
}
function load_sub_types(type_id,id){
	//load_item();
	$('#sub_type_name').empty();
	//alert('san_'+type_id);
	if(type_id=='' || typeof type_id === "undefined"){
		//alert('san'+type_id_);
		var type_id_=$('#type_name').val();
	}else{
		//alert('san2'+type_id_);
		var type_id_=type_id;
	}
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=6',
			dataType: 'json',
			data: 'type_id='+type_id_,
			type: 'POST',
			success: function (data) {
			 $.each(data, function(index, element) {
			 	$('#sub_type_name').append($('<option/>', { 
					value: element.id,
					text : element.text 
				}));
		 	});
			//alert(id);
				if(id!="")	$("#sub_type_name option[value="+id+"]").prop("selected","selected");
			 }
		  });
}
function load_item(type_id,sub_type_id,id){
	$('#item').empty();
	if(type_id=='' || typeof type_id === "undefined"){
		var type_id=$("#type_name").val();
	}else{
		var type_id=type_id;
	}
	if(sub_type_id=='' || typeof sub_type_id === "undefined"){
		var sub_type_id=$("#sub_type_name").val();
	}else{
		var sub_type_id=sub_type_id;
	}
	var data_details={
		"type_id": type_id,
		"sub_type_id": sub_type_id,
	}
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=17',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
			 $.each(data, function(index, element) {
			 	$('#item').append($('<option/>', { 
					value: element.id,
					text : element.text 
				}));
		 	});
			if(id!=''){
				$('#item').select2('val',id);
			}
			 }
		  });}
function load_doctors(id){

//alert(id);

	$('#doctors').empty();

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=35',

			dataType: 'json',

			type: 'POST',

			success: function (data) {

			 $.each(data, function(index, element) {

			 	$('#doctors').append($('<option/>', { 

					value: element.id,

					text : element.text 

				}));

		 	});

			if(id!="")	$("#doctors").select2("val", id);

			 }

		  });}
function search_code(asset_vel){
	//alert($("#item").find(":selected").val());
	//let item_val=$("#item").find(":selected").val().split("^");
	if(asset_vel=='' || typeof asset_vel === "undefined"){
	var item_val=$("#item").find(":selected").val().split("^");
	}else{
	var item_val=asset_vel.split("^");
	}
	var batch_code_val=$("#batch_code_val").find(":selected").val();
	let flag_=false;
	let data_details={
	"batch_code": batch_code_val,
	"item_id": item_val[0] ,
	}
	$("#batch_flag").val('0');

	$.ajax({
            url: 'get_json_data_for_optical.php?flag=30',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			async: false, 
			success: function (data) {
			//alert(data.mrp);	
		 	mrp=data.rate;
			mrp_=data.mrp;
			expiry_date=data.expiry_date;
			mfg_date=data.mfg_date;
			$("#batch_flag").val(data.batch_flag);
			$('#mrp').val(mrp_);
			if(mrp!=null){
				flag_=true;
			}
			if(data.batch_flag=='0'){
				$("#stock_qty").html('');
				$("#mrp").val(item_val[8]);
			}
			//$("#item").focus();
			}

		});
		return flag_;
	}
function load_batch_codes(asset_val){
	console.log(asset_val);
	if(asset_val=='' || typeof asset_val === "undefined"){
	var item_val=$("#item").find(":selected").val().split("^");
	}else{
	var item_val=asset_val.split("^");
	}
	//console.log(item_val);
	var item_id=item_val[0];
	$('#batch_code_val').empty();
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=28',
			type: 'POST',
			dataType: 'json',
			data: "item_id="+item_id,
			async: false, 
			success: function (data) {
		 		$.each(data, function(index, element) {
			 	$('#batch_code_val').append($('<option/>', { 
					value: element.value,
					text : element.text 
				}));				
		 	});
			if(asset_val==''){
			search_code();
			load_stock();
			}else{
			search_code(asset_val);	
			load_stock(item_id);
			}
			//search_code();
			}
		});
}

function calculate_payment(){



	let cash=$("#cash").val();

	let card=$("#card").val();

	let upi=$("#UPI").val();

	//let tpa=$("#tpa_amount").val();

	let bal=$("#net_total_").html();

	

	let fbal=parseFloat(bal)-(parseFloat(cash)+parseFloat(card)+parseFloat(upi)/*+parseFloat(tpa)*/);

	$("#bal").html(fbal);



}
function load_gp(){



	let item_val=$("#item").find(":selected").val().split("^");

	let item_id=item_val[0];

	$('#batch_code_val').empty();

	$("#mrp").val(item_val[8]);

	



}
function load_tpa(){

	

	$('#type_name').empty();



	$.ajax({



            url: 'get_json_data.php?flag=71',

			dataType: 'json',

			type: 'POST',

			success: function (data) {

			

			 $.each(data, function(index, element) {

			 	$('#tpa').append($('<option/>', { 



					value: element.id,

					text : element.text 



				}));

		 	});

			

			}



		  });

	

	

}
/*function item_stock_validation(id) {

	var tot_qty=1;

	var tot_qty_=0;

	//assets_indent_body

	var out = true;

	var i=0;

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){

		alert(i);

		if($("#"+id+"_batch_no").val()==$('#batch_code_val').val()){

			alert($("#"+id+"_qty_qty").html());

		 tot_qty += parseInt($("#"+id+"_qty_qty").html());

		}

		//alert(tot_qty);

		//alert($("[name='"+id+item_val[0]+"_batch_no_sub']").val());

		if($("[name='"+id+"_batch_no_sub']").val()==$('#batch_code_val').val()){

			//alert($("#"+id+item_val[0]+"_qty_qty_sub").html());

		 tot_qty_ += parseInt($("#"+id+"_qty_qty_sub").html());

		}

		

	i++;});

	

	//var i=1;

	

	if(parseInt($("#stock_qty").html())<parseInt(tot_qty)){

		alert("Quantity not in stock");

		//alert(tot_qty);

		out = false;

		}

		//alert(out);

	return out;

}*/

function old_pres_pb_fetch_model() {

			$("#uhid").val('');

			if($("#patient_uhid").val()==''){

				alert('Please Select UHID');

				return false;	

			}

			var mrd= $("#patient_uhid").val();

			$("#uhid").val(mrd);

            $("#old_patient_date_popup_show").html("loading...");

            var form_data = {

                "mrd": mrd,

                "id": '1'

            }

            $.ajax({

                url: '<?php echo ADMIN_URL; ?>ajax_for_emr/dr_pb_values_fetch_from_trenetralaya_for_emr.php?flag=3',

                dataType: 'json',

                type: 'POST',

                data: form_data,

                success: function(data) {

                    //alert(data);

                    $('#exampleModal').modal();

                    $("#old_patient_date_popup_show").html("");

                    $.each(data, function(index, element) {

                        //var html='<a href="javascript:void(0)" target="_blank">'+data.created_on+'</a>';

                        var html = '<label><span id="mrd"><a href="javascript:void(0)" onClick="old_pres_pb_fetch(\'' + element.id + '\');">' + element.created_on + '</a></span></label><br>';

                        $("#old_patient_date_popup_show").append(html);

                    });

                }

            });

} 
function old_pres_pb_fetch(p_id) {

			 $("#uhid").val('');

			 if($("#patient_uhid").val()==''){

				alert('Please Select UHID');

				return false;	

			}

			var mrd= $("#patient_uhid").val();

			$("#uhid").val(mrd);	

			 $("#customer_name").val('');

			 $("#phone_number").val('');

			 $("#rspf").val('');

			 $("#lspf").val('');

			 $("#rcyl").val('');

			 $("#lcyl").val('');

			 $("#1_raxis").val('');

			 $("#1_laxis").val('');

			 $("#radd").val('');

			 $("#ladd").val('');

			 $("#prescription_id").val('');

			 $("#slip_id").val('');

			 $("#patient_registration_id").val('');

            $('#exampleModal').modal('hide');

            //alert(p_id);

            var data = {

                "mrd": mrd,

                "id": p_id

            }

            $.ajax({

                beforeSend: function() {

                    $('.ajax-loader').css("visibility", "visible");

                },

                url: "<?php echo ADMIN_URL; ?>ajax_for_emr/dr_pb_values_fetch_from_trenetralaya_for_emr.php?flag=2",

                type: "POST",

                dataType: 'json',

                data: data,

                success: function(data) {

					 $("#prescription_id").val(data.prescription_id);

					 $("#slip_id").val(data.slip_id);

					 $("#patient_registration_id").val(data.patient_registration_id);

					$("#customer_name").val(data.patient_name);

					$("#phone_number").val(data.mobile);

					if(data.glass_block!=1){

						$("#print_pres").css('display','none')

						alert("No Glass Prescription Found");

					}else{

					 $("#print_pres").css('display','block');

					 $("#rspf").val(data.distance_sph_r);

					 $("#lspf").val(data.distance_sph_l);

					 $("#rcyl").val(data.distance_cyl_r);

					 $("#lcyl").val(data.distance_cyl_l);

					 $("#1_raxis").val(data.distance_axis_r);

					 $("#1_laxis").val(data.distance_axis_l);

					 $("#radd").val(data.near_sph_r);

					 $("#ladd").val(data.near_sph_l);

					 var main_url="<?php echo ADMIN_URL; ?>";

					 var sep_url=main_url+"sepGlassprescription_for_emr.php?id="+data.prescription_id;

					 $("#print_pres").prop("href", sep_url);

					}

					$("#doctors").select2("val", data.primary_doctor);

					

					

				

                },

                complete: function() {

                    $('.ajax-loader').css("visibility", "hidden");

                }

            });

}
function load_sale_order_details(cou_pag_no){

	//alert($('#row_limit').val());

	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;

	//let row_limit=($('#row_limit').val()!="" ) ? parseFloat($('#row_limit').val())+page_limit : '0';

	//$('#row_limit').val(initial_page);

	var data_details={

		"initial_page": initial_page,

		"limit": <?php echo $limit;?>

	}

	$.ajax({



            url: 'get_json_data_for_optical.php?flag=51',

			dataType: 'json',

			type: 'POST',

			data:data_details,

			success: function (data) {

				var html='';

				 $.each(data, function(index, element) {
					 if(element.status=='2'){
						var colour='#e011111f'; 
					 }else{
						 var colour='';
					 }
					/* $action_edit='<a href="javascript:void(0)" name="delete" id="delete" onClick="delete_('.$id.')"><i class="fa fa-trash"></i></a>';
			$arr[]=array("order_number"=>$order_number,"id"=>$id,"customer_name"=>$customer_name,"date"=>date('d-m-Y',strtotime($date)),"status"=>$status,"amount"=>$amount,"advance_amount"=>$advance_amount,"action"=>$action_edit);*/
					html +='<tr style="background-color:'+colour+'"><td><a href="sale_invoice_order_print_for_optical.php?inv_id='+element.id+'">'+element.order_number+'</a></td><td>'+element.customer_name+'</td><td>'+element.date+'</td><td>'+element.amount+'</td><td>'+element.advance_amount+'</td><td>'+element.action+'</td></tr>';
				});

				$('#tab_po_body').html(html);

			

			 }



		  });

}
</script>