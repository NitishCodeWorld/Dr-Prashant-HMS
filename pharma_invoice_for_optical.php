<?php

include "conn.php"; // Using database connection file here

?>
<?php include "header_for_optical.php"; ?>

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
          </div>
          <div class="row" style="clear:both !important">
            <div class="col-md-4">
              <div class="form-group">
                <div class="input-group">
                  <?php if($_GET['uhid']!=''){
					$readonly='style="pointer-events:none;background: #eee;"';
					}else{
						$readonly='';
					}
				?>
                  <!--<input type="text" id="patient_uhid" name="patient_uhid" class="form-control" value="<?php echo $_GET['uhid']; ?>" placeholder="Enter UHID OR Phone No..." <?php echo $readonly;?>>-->
                  <select name="patient_uhid" id="patient_uhid" class="form-control select2" onChange="old_pres_pb_fetch_model();get_patient_details();" <?php echo $readonly;?>>
                    <option value="">Choose..</option>
                    <?php 
                       $sql7="SELECT * FROM `patient_registration_form`  WHERE  `del_flag`='0'   ORDER BY `id` DESC";
                       $result7=$conn->query($sql7) ;
                       while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                       {									 
                           echo '<option value="'.$row7['uhid_no'].'" '; if($_GET['uhid']==$row7['uhid_no']){echo "selected";}  echo '>'.$row7['uhid_no'].' ( '.$row7['patient_name'].' '.$row7['phone_no'].' )</option>';
                       }
                      ?>
                  </select>
                  <span class="input-group-addon"> <i class="fa fa-search" onClick="get_patient_details()"></i> </span> </div>
              </div>
            </div>
            <div class="col-md-8" style="text-align:left !important;">
              <select id="orders" class="form-control" style="width:200px" onchange="load_order_details();">
                <option value="">Choose</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="col-md-3" style="padding-left:0px; padding-right:2px">
              <input type="text" class="form-control" placeholder="Customer Name" name="customer_name" id="customer_name" />
            </div>
            <div class="col-md-2" style="padding-left:0px; padding-right:2px">
              <input type="text" class="form-control" placeholder="Date" name="inv_date" id="inv_date" value="<?php echo date("d/m/Y") ?>" />
            </div>
            <div class="col-md-3" style="padding-left:0px; padding-right:2px">
              <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" id="phone_number" />
            </div>
            <div class="col-md-1" style="padding-left:0px; padding-right:2px">
              <select id="doctors" class="form-control" style="width:200px">
                <option value="">-Select-</option>
              </select>
            </div>
          </div>
          <?php 
		  if(isset($_GET['id'])){
		  $sales_id=$_GET['id'];
		  $sql_vender="select * from vendor_order_for_optical where sales_order_id='$sales_id'";
		  $res_vender=mysqli_query($conn,$sql_vender) or die(mysqli_error($conn));
		  $row_vender=mysqli_fetch_assoc($res_vender);
		  }
		  $pd=($row_vender['pd']) ? $row_vender['pd'] : "";
			$seg_ht=($row_vender['seg_ht']) ? $row_vender['seg_ht'] : "";
			$coating=($row_vender['coating']) ? $row_vender['coating'] : "";
			$color=($row_vender['color']) ? $row_vender['color'] : "";
			$remarks=($row_vender['remarks']) ? $row_vender['remarks'] : "";
			$order_date=($row_vender['order_date']) ? date('d-m-Y',strtotime($row_vender['order_date'])) : "";
		  ?>
          <div class="col-md-6">
            <div class="col-md-2" style="overflow:auto">
              <input type="text" id="pd" class="form-control" value="<?php echo $pd;?>" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="PD">
            </div>
            <div class="col-md-2" style="overflow:auto">
              <input type="text" id="seght" class="form-control" value="<?php echo $seg_ht;?>" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="SEG HT">
            </div>
            <div class="col-md-2" style="overflow:auto">
              <input type="text" id="coating" class="form-control" value="<?php echo $coating;?>" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="COATING">
            </div>
            <div class="col-md-3" style="overflow:auto">
              <input type="text" id="color" class="form-control" value="<?php echo $color;?>" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="COLOR">
            </div>
            <div class="col-md-3" style="overflow:auto">
              <input type="text" id="exp_date" class="form-control" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="EXP DEL DATE" value="<?php echo $order_date;?>">
            </div>
          </div>
          <div class="col-md-12" style="overflow:auto">
            <label class="control-label"><strong>REMARKS</strong></label>
            <textarea id="remarks" class="form-control" style="border:solid #CCC 1px; border-radius:4px; margin-bottom:3px;" placeholder="REMARKS"><?php echo $remarks;?></textarea>
          </div>
          <div style="clear:both; margin-top:35px">
            <hr style="border-top: 1px solid #000;"/>
          </div>
          <!-- END PAGE CONTENT INNER --> 
        </div>
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
            <select class="form-control item" id="item" onChange="load_batch_codes();" >
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
        <div class="col-md-1" style="line-height: 77px;">
          <button class="btn green" onClick="add_item()"><i class="fa fa-plus" title="ADD ITEM"></i></button>
        </div>
      </div>
      <div class="row">
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
              <?php 
						if(isset($_GET['id'])){
						$sales_id=$_GET['id'];
						$sql="select *,sales_order_for_optical.cgst_amount as cgst,sales_order_for_optical.sgst_amount as sgst,sales_order_details_for_optical.batch_no from sales_order_for_optical inner join sales_order_details_for_optical on sales_order_for_optical.id=sales_order_details_for_optical.sales_id inner join item_master_for_optical on item_master_for_optical.id=sales_order_details_for_optical.item_id where sales_order_for_optical.id='$sales_id' and (sales_order_for_optical.status=1 || sales_order_for_optical.status=2) "; 
						$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
						$total_=0;
						$cgst_amount=0;
						$sgst_amount=0;
						$net_total=0;
						$sl=1;
						while($row=mysqli_fetch_assoc($res)){

						?>
              <tr id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>' data-indent='"+indent_id+"' data-indent-batch='<?php echo $row['batch_no']; ?>' data-item-id='<?php echo $row['item_id']; ?>' >
                <td><span id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_hsmcode'><?php echo $row['item_hsn_code']; ?></span></td>
                <td id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_asset_name' ><?php echo $row['item_name']; ?></td>
                <td><?php echo $row['size']; ?></td>
                <td><?php echo $row['color']; ?></td>
                <td id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_qty_qty' ><?php echo $row['qty']; ?></td>
                <td><input style='width:80px' type='text' value='<?php echo $row['rate']; ?>' id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_rate' onblur='calculate("item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>")'  ></td>
                <td><input type='text' id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_discount_rate' onblur='calculate("item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>")'  size=5 value='<?php echo $row['disc_rate']; ?>' ></td>
                <td><input type='text' value='<?php echo $row['disc_amount']; ?>'  id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_discount_amount' size=5 ></td>
                <td><input type='text' id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_total_amount' style='width:80px' value='<?php $total_=$total_+$row['total']; echo $row['total']; ?>' ></td>
                <td><span id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_gstrate' size=5 ><?php echo $row['gst_rate']; ?></span></td>
                <td><span id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_gst_amount' onblur='calculate("item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>")' size=5 ><?php echo $row['gst_amount']; ?></span></td>
                <td><span id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_cgstrate' size=5 ><?php echo $row['cgst_rate']; ?></span></td>
                <td><span id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_cgst_amount' size=5 ><?php echo $row['cgst_amount']; ?></span></td>
                <td><span id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_sgstrate' ><?php echo $row['sgst_rate']; ?></span></td>
                <td><span id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_sgst_amount' ><?php echo $row['sgst_amount']; ?></span></td>
                <td><span id='item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>_net_amount' ><?php echo (($row['total'])+($row['gst_amount']))-($row['disc_amount']); ?></span></td>
                <td><a href='javascript:;' onclick='del("item<?php echo $row['item_id']; ?><?php echo $row['batch_no']; ?>")'><i class='fa fa-trash'></i></a></td>
              </tr>
              <?php $cgst_amount=$row['cgst']; $sgst_amount=$row['sgst']; $sl++;}} ?>
            </tbody>
            <tfoot>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="8" align="right">Total</td>
                <td><span id="total_amount"><?php echo $total_; ?></span></td>
               <td colspan="2"></td>
              </tr>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="8" align="right">Add: CGST</td>
                <td><span id="CGST_amount_"><?php echo $cgst_amount; ?></span></td>
                <td colspan="2"></td>
              </tr>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="8" align="right">Add: SGST</td>
                <td><span id="SGST_amount_"><?php echo $sgst_amount; ?></span></td>
               <td colspan="2"></td>
              </tr>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="8" align="right">Net Total</td>
                <td><span id="net_total_"><?php echo $net_total=($total_+$cgst_amount+$sgst_amount); ?></span></td>
               <td colspan="2"></td>
              </tr>
              <?php 
							$sql="select payment_mode_for_optical.* from payment_mode_for_optical left join sales_order_for_optical on sales_order_for_optical.id=payment_mode_for_optical.sales_order_id where payment_mode_for_optical.amount<>0 and sales_order_id='$sales_id' and (sales_order_for_optical.status=1 || sales_order_for_optical.status=2)";
							$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
							$amount_cash=0;
							$amount_card=0;
							$amount_upi=0;
							$amount_tpa=0;
							$amount=0;
							$mode="";
							$total_advance_amount=0;
							while($row=mysqli_fetch_assoc($res)){
						 		$mode=$row['mode'];
								$amount=$row['amount'];
								$amount_cash +=($mode=="cash") ? $amount : "0";
								$amount_card +=($mode=="card") ? $amount : "0";
								$amount_upi +=($mode=="upi") ? $amount : "0";
								$amount_tpa +=($mode=="tpa") ? $amount : "0";
								$total_advance_amount=($total_advance_amount)+($amount);
							}

							?>
                <input type="hidden" name="advance_amount" id="advance_amount" value="<?php if($total_advance_amount!='' || $total_advance_amount!='0'){ echo $total_advance_amount;}else{echo '0';}?>" />
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="7" align="right">Mode of Payment</td>
                <td>Cash</td>
                <td><input type="text" id="cash" style='width:80px' onBlur="calculate_payment()" placeholder="Cash" value="<?php echo $amount_cash; ?>" /></td>
                <td colspan="2"></td>
              </tr>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="7" align="right">Mode of Payment</td>
                <td>Card</td>
                <td><input type="text" id="card" style='width:80px' onBlur="calculate_payment()" placeholder="Card" value="<?php echo $amount_card; ?>" /></td>
                <td colspan="2"></td>
              </tr>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="7" align="right">Mode of Payment</td>
                <td>UPI</td>
                <td><input type="text" id="UPI" style='width:80px' onBlur="calculate_payment()" placeholder="UPI"  value="<?php echo $amount_upi; ?>" /></td>
                <td colspan="2"></td>
              </tr>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="7" align="right">Mode of Payment</td>
                <td>TPA:
                  <select id="tpa" style="width:150px">
                    <?php 
							$sql_tpa="select * from tpa_masters where del_flag='0'";
							$res_tpa=mysqli_query($conn,$sql_tpa) or die(mysqli_error($conn));
							while($row_tpa=mysqli_fetch_assoc($res_tpa)){
								echo '<option value="'.$row_tpa['name'].'">'.$row_tpa['name'].'</option>';
							}
							?>
                  </select></td>
                <td><input type="text" id="tpa_amount" style='width:80px' onBlur="calculate_payment()" placeholder="tpa amount" value="<?php echo $amount_tpa; ?>" /></td>
                <td colspan="2"></td>
              </tr>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="8" align="right">Amount Due(Total - Advance)</td>
                <td><span id="bal"><?php echo $net_total-$total_advance_amount; ?></span></td>
                <td style="color:#F00;">Advance</td>
                <td style="color:#F00;"><?php echo $total_advance_amount.'/-'; ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-md-12" style="text-align:center; margin-bottom:10px">
          <input type="button" class="btn" onClick="save_sales()" value="Save Sales" style="background:#000099;color:#FFFFFF;width:120px" />
          &nbsp;&nbsp;
          <input type="button" class="btn" onClick="save_sales(1)" value="Save & Print" style="background:#000099;color:#FFFFFF;width:120px" />
        </div>
        <div style="clear:both; height:15px">&nbsp;</div>
        <table class="table table-striped table-bordered table-hover small" id="full_tab_details">
                  <caption>Full Sale Details <strong style="float:right;display:flex;line-height:34px;">Search:&nbsp;&nbsp;<input type="text" class="form-control" name="search" id="search" value="" style="width:100%;"/></strong></caption>
                  <thead>
                    <tr>
                      <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Invoice Number</span></th>
                      <th class="draggable" data-column="category_name" style="cursor: move;"><span>Invoice Date</span></th>
                      <th class="draggable" data-column="sub_cat"><span>Customer Name</span></th>
                      <th class="draggable right" data-column="qty" style="cursor: move;"><span>Total Amount </span></th>
                      <th class="print_ignore"><span>Action</span></th>
                    </tr>
                  </thead>
                  <tbody id="tab_po_body">
                  </tbody>
                </table>
                <?php 
					$sql_="select * from `pharma_invoice_for_optical`";
					$result=mysqli_query($conn,$sql_);
					$count=$result->num_rows;  
					$count_limit=ceil($count / $limit);
					echo '<div class="col-md-6" style="float:right;text-align:right;">';
					for ($page_number = 1; $page_number <=$count_limit; $page_number++) {
					  echo '<a href="javascript:void(0);" class="btn btn-primary" onClick="load_sale_details('.$page_number.')">'.$page_number.'</a>';
					}
					echo '</div>';
					?>
                <input type="hidden" name="row_limit" id="row_limit" value="<?php echo $limit?>">
      </div>
      
      <!-- END PAGE CONTENT --> 
      
    </div>
    
    <!-- END PAGE CONTAINER --> 
    
  </div>
</div>
<?php include("footer_for_optical.php"); ?>
<script>



//load_tpa();
let tab_asset_entry="";
load_purchase_orders();
load_vendor();
var cou_pag_no=0;
load_sale_details(cou_pag_no);
load_types();
load_sub_types();
let mrp=0;
let expiry_date="";
load_doctors();
let uhid="";
$('#patient_uhid').select2();
<?php if($_GET['uhid']!=''){?>
get_patient_details();
get_order_vender(<?php echo $_GET['id']?>);
<?php }?>

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
			$("#batch_code_val").focus();
  			//add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value);
		}
	});

	$("#batch_code_val").keypress(function(event){
		if ( event.which == 13 ) {
			add_item();
		}
	});

	$("#patient_uhid").keypress(function(event){
		if ( event.which == 13 ) {alert('san');
			//console.log(search_code($(this).val()));
			get_patient_details();
		}
	});

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

	if($('#type_name option:selected').text()=='FRAME' || $('#type_name option:selected').text()=='Frame' || $('#type_name option:selected').text()=='frame'){
		alert("You can't add Fream or Lens!..");
		return false;
	}

	if($('#type_name').text()=='Lens' || $('#type_name').text()=='LENS' || $('#type_name').text()=='lens'){
		alert("You can't add Fream or Lens!..");
		return false;
	}

	//alert($("#batch_code_val").find(":selected").val());
/*
	if(search_code($("#batch_code_val").find(":selected").val())==true){

		add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value);

	}else{

		alert("Batch does not exist.");

	}*/
	if($("#item").val()==''){
		alert('Please Select Item!..');
		return false;
	}
		add_indent_free('freeItem','freeindent','freeIndent_details',document.getElementById('item').options[document.getElementById('item').selectedIndex].value);	



}
function load_purchase_orders(){



	$('#indent').empty();

	

	$('#indent').append($('<option/>', { 



					value: '',

					text : '-Select-' 



				}));



	$.ajax({



            url: 'get_json_data_for_optical.php?flag=26',

			dataType: 'json',

			type: 'POST',

			success: function (data) {

			

			 $.each(data, function(index, element) {

			 	$('#indent').append($('<option/>', { 



					value: element.id,

					text : element.order_number+" "+element.date, 



				}));

		 	});

			

			 }



		  });



}
function load_vendor(id){
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
			if(id!="")	$("#vendor_name option[value="+id+"]").attr("selected","selected");
			 }
		  });

}
function load_purchase_order_data(){

if(tab_asset_entry!="") tab_asset_entry.destroy();





var data_details={

		"id": $("#indent").val()		

}



$.ajax({

            url: 'get_json_data_for_optical.php?flag=27',

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

				

			}

		});



}
function del(id){



	$("#"+id).remove();

	calculate(id);



}
function edit(id){



$.ajax({

            url: 'get_json_data_for_optical.php?flag=19',

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

				

				

			}

		});



}
function add_indent_free(id,indent_id,indent_details_id,item_id){
	var src=$("#assets_indent_body").html();
	//alert($("#"+id+"_qty").val());
	//if(parseFloat($("#"+id+"_qty").val())>parseFloat($("#"+id+"_qty").attr("data-qty"))) alert("Order quantity must not exceed quanity indented1");
	//alert($("#"+id+"_qty").attr("data-qty"));
	//alert(tds.html());
	//alert($("#"+id+"_qty").val());
	//alert($("#item").val());

	if(parseInt($("#stock_qty").html())<parseInt($("#freeItem_qty").val())){
		alert("Quantity not in stock");
		return false;
	}
	let item_val=$("#item").val().split("^");
	let batch_val=$("#batch_code_val option:selected").text();
	
	var tds = $(src).find("td[id='"+id+item_val[0]+"_qty_qty']");
	//console.log("Batch Code"+tds.html());
	let gst=item_val[2];
	let mrp=$('#mrp').val();
	console.log(mrp);
	//Back Calculation
	if(gst!=0 || gst!=''){
		mrp=parseFloat((parseFloat(mrp)/(parseFloat(gst)+100))*100).toFixed(2);
	}

	if(typeof tds.html() === "undefined"){ 
		$("#assets_indent_body").append("<tr id='"+id+item_val[0]+batch_val+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+batch_val+"_hsmcode'>"+item_val[1]+"</span></td><td id='"+id+item_val[0]+batch_val+"_asset_name' >"+$("#item :selected").text()+"</td><td>"+item_val[3]+"</td><td>"+item_val[4]+"</td><td id='"+id+item_val[0]+batch_val+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><input style='width:80px' type='text' value='"+mrp+"' id='"+id+item_val[0]+batch_val+"_rate' onblur='calculate(\""+id+item_val[0]+batch_val+"\")'  ></td><td><input type='text' id='"+id+item_val[0]+batch_val+"_discount_rate' onblur='calculate(\""+id+item_val[0]+batch_val+"\")'  size=5 value='0' ></td><td><input type='text' value='0'  id='"+id+item_val[0]+batch_val+"_discount_amount' size=5 ></td><td><input type='text' id='"+id+item_val[0]+batch_val+"_total_amount' style='width:80px' value='"+(mrp*$("#"+id+"_qty").val())+"' ></td><td><span id='"+id+item_val[0]+batch_val+"_gstrate' size=5 >"+item_val[2]+"</span></td><td><span id='"+id+item_val[0]+batch_val+"_gst_amount' onblur='calculate(\""+id+item_val[0]+batch_val+"\")' size=5 >0</span></td><td><span id='"+id+item_val[0]+batch_val+"_cgstrate' size=5 >"+item_val[5]+"</span></td><td><span id='"+id+item_val[0]+batch_val+"_cgst_amount' size=5 >0</span></td><td><span id='"+id+item_val[0]+batch_val+"_sgstrate' >"+item_val[6]+"</span></td><td><span id='"+id+item_val[0]+batch_val+"_sgst_amount' >0</span></td><td><span id='"+id+item_val[0]+batch_val+"_net_amount' >0</span></td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+batch_val+"\")'><i class='fa fa-trash'></i></a></td></tr>");
	$("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())));
	calculate(id+item_val[0]+batch_val);
	}else{
	 	//if((parseFloat($("#"+id+"_qty").val())+parseFloat(tds.html()))>$("#"+id+"_qty").attr("data-qty")) alert("Order quantity must not exceed quanity indented");
	 	//else{
		 let qty_added=tds.html();
		 //alert(tds.html());
		 $("#"+id+item_val[0]+batch_val+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));
		 $("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())+parseFloat(qty_added)));
		 calculate(id+item_val[0]);
	 	//}
	 }

}
function save_sales(flag=0){
	if(parseFloat($("#bal").html())<0){
		alert("Over paid");
		return false;
	}else if(parseFloat($("#bal").html())>0){
		alert("Under paid");
		return false;
	} 

	if($("#uhid").val()=="" || $("#customer_name").val()=="" ){
		alert("Please fill up patients details");
		$("#uhid").focus();
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
	let hsn_code=[];
	let i=0;
	let return_flag=0;

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){
  		console.log( index + ": " + $( this ).attr('id') );
		//purchase_id[i]=$( this ).attr('data-indent');
		//purchase_details_id[i]=$( this ).attr('data-details-indent');
		ids[i]=$( this ).attr('data-item-id');
		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();
		batch_no[i]=$( this ).attr('data-indent-batch');
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
		hsn_code[i]=$("#"+$( this ).attr('id')+"_hsmcode").html();
		console.log("MRP::"+$("#"+$( this ).attr('id')+"_mrp").val());

		/*if($("#"+$( this ).attr('id')+"_mrp").val()==0){

			alert("MRP must be entered");

			return_flag=1;

			return false;

			

		}*/
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
		//"sales_order_id":$("#patient_uhid").val(),
		"hsn_code":hsn_code,
		"sales_order_id":"<?php echo (isset($_GET['id'])) ? $_GET['id'] : ""; ?>"
		//"mrp" : mrp
	}

	$.ajax({
            url: 'get_json_data_for_optical.php?flag=38',
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
				}else{
				 	if(data.reason!="") toastr.error(data.reason);
				 	else toastr.error('Unable to save order');
				}
				//if(flag==1) window.open("sales_invoice_print.php?inv_id="+data.s_id);
				setTimeout(function(){ location.reload(); }, 2000);	
			}	
		});
}
let invoices="";
function load_sale_details(cou_pag_no){
	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;
	var data_details={
		"initial_page": initial_page,
		"limit": <?php echo $limit;?>
	}
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=50',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				var html='';
				 $.each(data, function(index, element) {
					html +='<tr><td><a href="sale_invoice_print_for_optical.php?inv_id='+element.id+'">'+element.order_number+'</a></td><td>'+element.customer_name+'</td><td>'+element.date+'</td><td>'+element.amount+'</td><td></td></tr>';
				});
				$('#tab_po_body').html(html);
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

	console.log($("#"+id+"_discount_rate").val());

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

	net_total=Math.round(net_total)

	$("#total_amount").html(parseFloat(total).toFixed(2));

	$("#CGST_amount_").html(cgst);

	$("#SGST_amount_").html(sgst);

	$("#net_total_").html(net_total);

	let cash=$("#cash").val();

	let card=$("#card").val();

	let upi=$("#UPI").val();

	let tpa=$("#tpa_amount").val();

	let bal=net_total-(parseFloat(cash)+parseFloat(card)+parseFloat(upi)+parseFloat(tpa));

	$("#bal").html(bal);

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


	let advance_amount=$("#advance_amount").val();
	let cash=$("#cash").val();
	let card=$("#card").val();
	let upi=$("#UPI").val();
	let tpa=$("#tpa_amount").val();
	let bal=$("#net_total_").html();

	let fbal=parseFloat(bal)-(parseFloat(cash)+parseFloat(card)+parseFloat(upi)+parseFloat(tpa)+parseFloat(advance_amount));
	$("#bal").html(fbal);
}
function get_patient_details(){
	let uhid_len=$("#patient_uhid").val().length;
	let phone_no='';
	let uhid='';
	if(uhid_len>=10 && $.isNumeric($("#patient_uhid").val())){
		phone_no=$("#patient_uhid").val();
	}else{
		uhid=$("#patient_uhid").val();
	}
	let data_details={
	"phone_no": phone_no,
	"uhid": uhid
	}
	load_orders(uhid,phone_no);
	//load_orders_no(phone_number);
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=34',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
		 		$("#customer_name").val(data.name);
				$("#phone_number").val(data.mobile);
				load_doctors(data.doc_id);
			}
		});
}
function load_tpa(){

	

	$('#type_name').empty();



	$.ajax({



            url: 'get_json_data_for_optical.php?flag=71',

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
function load_orders(uhid,phone_no){

	//var get_id=<?php echo $_GET['id'];?>;

	$('#orders').empty();

	let data_details={

	"phone_no": phone_no,

	"uhid": uhid

	}

	

	$('#orders').append($('<option/>', { 



		value: "",

		text : "-Select-" 



	}));



	$.ajax({



            url: 'get_json_data_for_optical.php?flag=37',

			dataType: 'json',

			type: 'POST',

			data: data_details,

			success: function (data) {

			

			 $.each(data, function(index, element) {

			 	$('#orders').append($('<option/>', { 



					value: element.id,

					text : element.order_number 



				}));

		 	});

			

			//$('#orders select').val("<?php echo $_GET['id']; ?>");

			//if(get_id!=''){

			//$('#orders option[value='+get_id+']').attr('selected','selected');

			//}

			}



		  });





}
function load_order_details(){
	let id=$("#orders").val();
	let uhid=$("#patient_uhid").val();
	var location='<?php echo basename($_SERVER['PHP_SELF']);?>';
	//window.location.href=window.location.location+'?id='+id+'&uhid='+uhid;
	window.open(location+'?id='+id+'&uhid='+uhid , "_self");
	get_order_vender(id);
}
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
function get_order_vender(order_id){
	let data_details={
	"order_id": order_id
	}
	$.ajax({
            url: 'get_json_data_for_optical.php?flag=49',
			type: 'POST',
			dataType: 'json',
			data: data_details,
			success: function (data) {
				load_vendor(data.value);
				//$('#vendor_name').val(data.value);
			}

		});
}
</script>