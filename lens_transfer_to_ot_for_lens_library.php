<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_for_optical.php"; ?>

<div class="page-container">
  <div class="page-content">
    <div class="container-fluid">
      <?php  include("lens_menu_for_lens_library.php");?>
      <div class="row margin-top-10">
        <div class="col-md-12">
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-17)));?></span></div>
            </div>
            
            <!-- BEGIN FORM--> 
            
          </div>
          <div class="portlet" style="min-height:50px; margin-bottom:0px">
            <div class="portlet-body">
              <div class="col-md-1" style="margin-top:8px; font-weight:bold; text-align:right; padding-right:0px; margin-left:-59px;">UHID:</div>
              <div class="col-md-3" style="padding-left:0px; padding-right:2px"> 
                <!--<input type="text" class="form-control" placeholder="Enter UHID" name="uhid" id="uhid" />-->
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
              <!-- <div class="col-md-1">
                <button class="btn-circle btn green" onClick="get_patient_details()">Go</button>
              </div>-->
              <div style="clear:both"></div>
              <div class="col-md-3" style="padding-left:0px; padding-right:2px">
                <input type="text" class="form-control" placeholder="Customer Name" name="customer_name" id="customer_name" />
              </div>
              <div class="col-md-2" style="padding-left:0px; padding-right:2px">
                <input type="text" class="form-control" placeholder="Date" name="inv_date" id="inv_date" value="<?php echo date("d/m/Y") ?>" />
              </div>
              <div style="clear:both"></div>
              <div class="col-md-3" style="padding-left:0px; padding-right:2px">
                <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" id="phone_number" />
              </div>
              <div class="col-md-1" style="padding-left:0px; padding-right:2px">
                <select id="doctors" class="form-control select2" style="width:200px">
                  <option value="">-Select-</option>
                </select
              >
              </div>
            </div>
          </div>
          
          <!-- END PAGE CONTENT INNER --> 
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-5" style="float: left;margin-top: 0 !important;padding-top: 0 !important;">
          <label class="control-label">Scan with barcode :&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-blue" id="qr_scan" style="background-color:#eff3f8;"><i class="fa fa-barcode fa-lg" aria-hidden="true" style="padding: 10px 0px 0px 0px;font-size:39px !important;"></i></button>
            <input type="text" name="qr_scan_input" id="qr_scan_input" class="form-control" value="<?php echo $qr_scan_input; ?>" style="position: absolute;margin: -42px 0px 0px 222px;width: 53%;display:none;pointer-events:none;">
          </label>
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
              <select class="form-control item" id="item" onChange="load_batch_codes()" >
              </select>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label for="">Quantity</label>
              <input type="text" id="freeItem_qty" class="form-control" data-qty="" />
              <span id='stock_qty' style="font-weight:bold"></span> </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="">Batch Code</label>
              
              <!--<input type="text" id="batch_code_val" class="form-control" data-qty="" />-->
              
              <select id="batch_code_val" class="form-control" onChange="load_stock_for_lens_library()">
              </select>
            </div>
          </div>
          <div class="col-md-2" style="margin-top:25px">
            <button class="btn green" onClick="add_item()">Add Item</button>
          </div>
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
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Asset Name </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Batch No. </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Bar Code. </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Mfg. Date </span></th>
                <th class="draggable" data-column="covid_item" style="cursor: move;"><span>Expiry Date </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>
              </tr>
            </thead>
            <tbody id="assets_indent_body">
            </tbody>
            <tfoot>
              <tr style="font-weight:bold;font-size:15px;">
                <td colspan="6" align="right">Total</td>
                <td><span id="total_qty"></span></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-md-12" style="text-align:center; margin-bottom:10px">
          <input type="button" class="btn" onClick="save_sales()" value="Save Transfer" style="background:#000099;color:#FFFFFF;width:120px" />
          &nbsp;&nbsp;
          <input type="button" class="btn" onClick="save_sales(1)" value="Save & Print" style="background:#000099;color:#FFFFFF;width:120px" />
        </div>
        <div style="clear:both; height:15px">&nbsp;</div>
        <table class="table table-striped table-bordered table-hover small" id="full_tab_details">
          <caption>
          Full Order Details <strong style="float:right;display:flex;line-height:34px;">Search:&nbsp;&nbsp;
          <input type="text" class="form-control" name="search" id="search" value="" style="width:100%;"/>
          </strong>
          </caption>
          <thead>
            <tr>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>UHID</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Patient Name</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Asset Name</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Qty</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Batch</span></th>
              <th class="draggable" data-column="category_name" style="cursor: move;"><span>Bar Code</span></th>
              <th class="draggable" data-column="sub_cat"><span>Manufacturing Date</span></th>
              <th class="draggable right" data-column="qty" style="cursor: move;"><span>Expiry Date</span></th>
              <th class="draggable right" data-column="qty" style="cursor: move;"><span>Status</span></th>
              <th class="draggable right" data-column="qty" style="cursor: move;"><span>Date</span></th>
            </tr>
          </thead>
          <tbody id="tab_po_body">
          </tbody>
        </table>
        <?php 
                $sql_="select * from `lens_issued_for_lens_library`";
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
      
      <!-- END PAGE CONTENT --> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTAINER --> 
  
</div>
<?php include("footer_for_optical.php"); ?>
<script>



//load_tpa();

var tab_asset_entry="";
load_types();
load_sub_types();
$('#patient_uhid').select2();
var cou_pag_no=0;
load_sale_order_details(cou_pag_no);
var mrp=0;

var expiry_date="";

var mgf_date="";

//load_item();

load_doctors();

var uhid="";

var operator="";

var print_flag=0;

$( document ).ready(function() {
$("#inv_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
$(".expiry_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
$(".mfg_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
	

    $("#freeItem_qty").change(function(){

  		$("#freeItem_qty").attr("data-qty",$("#freeItem_qty").val());

	});

	

	$("#freeItem_qty").keypress(function(event){
		if ( event.which == 13 ) {
			if($('#mrp').val()!=''){
			add_item();
			}else{
			$('#mrp').focus();
			}
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

	

	/*$("#uhid").keypress(function(event){

		

		if ( event.which == 13 ) {

			//console.log(search_code($(this).val()));

			get_patient_details();

		}

	

	});*/

	

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

var slno=0;

var icount=1;

function add_indent_free(id,indent_id,indent_details_id,item_id){



	var src=$("#assets_indent_body").html();

	if(parseInt($("#stock_qty").html())<parseInt($("#freeItem_qty").val())){

		alert("Quantity not in stock");

		return false;

	}
	

	

	let item_val=$("#item").val().split("^");

	

	var batch_=$("#batch_code_val").val().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');

	var tds = $(src).find("td[id='"+id+item_val[0]+batch_+"_qty_qty']");
	if(parseInt($("#stock_qty").html())<parseInt($("#"+id+item_val[0]+batch_+"_qty_qty").html())){

		alert("Quantity not in stock");

		return false;

	}

	slno=parseInt(slno+1);

	if(typeof tds.html() === "undefined"){ 

		

		$("#assets_indent_body").append("<tr id='"+id+item_val[0]+batch_+"' data-mrp='"+mrp_+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+batch_+"_hsmcode'>"+slno+"</span></td><td id='"+id+item_val[0]+batch_+"_asset_name' >"+$("#item :selected").text()+"</td><td id='"+id+item_val[0]+batch_+"_batch_no_batch_no' ><input type='text' id='"+id+item_val[0]+batch_+"_batch_no' class='form-control' value='"+$("#batch_code_val").val()+"' ></td><td id='"+id+item_val[0]+batch_+"_bar_cpde_span' ><input type='text' id='"+id+item_val[0]+batch_+"_bar_code' class='form-control' value='"+bar_code_+"' ></td><td id='"+id+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+batch_+"_mfg_date' class='mfg_date' ><div class='input-group'><input type='hidden' name='"+id+"_mfg_date_day_val' id='"+id+"_mfg_date_day_val' class='form-control'  value='01' /><select class='form-control' id='"+id+"_mfg_date_month_val' name='"+id+"_mfg_date_month_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' ><option value=''>-Month-</option><?php  for($month_num=1;$month_num<13;$month_num++){ ?> <option value='<?php if($month_num<10) { echo $month_number_convert='0'.$month_num; }else{ echo $month_number_convert=$month_num; } ?>'><?php echo date('M', mktime(0, 0, 0, $month_num, 10)); ?> (<?php echo $month_number_convert;?>)</option><?php  } ?></select><select class='form-control' id='"+id+"_mfg_date_year_val' name='"+id+"_mfg_date_year_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' ><option value=''>-Year-</option> <?php $current_years=date("Y"); $previ_y=$current_years-5;$next_y=$current_years+11;while($previ_y<$next_y){ ?><option value='<?php echo $previ_y; ?>'><?php echo $previ_y; ?></option><?php $previ_y++ ;  } ?></select><button type='button' style='background:transparent !important;border: none !important;'> <a href='javascript:void(0);'  id='iop_add_button'  title='Calculate' onClick='calculate_mfg_expire_date(\""+id+item_val[0]+batch_+"_mfg_date\",document.getElementById(\""+id+"_mfg_date_year_val\").options[document.getElementById(\""+id+"_mfg_date_year_val\").selectedIndex].value,document.getElementById(\""+id+"_mfg_date_month_val\").options[document.getElementById(\""+id+"_mfg_date_month_val\").selectedIndex].value,document.getElementById(\""+id+"_mfg_date_day_val\").value)' alt='Calculate'><img src='icon/icons8-calculator-16.png' class='img-responsive' alt='Calculate'></a></button></div></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+batch_+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ><div class='input-group'><input type='hidden' name='"+id+"_expiry_date_day_val' id='"+id+"_expiry_date_day_val' class='form-control'  value='31' /><select class='form-control' id='"+id+"_expiry_date_month_val' name='"+id+"_expiry_date_month_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' onChange='calculate_expire_day(\""+id+"_expiry_date_day_val\",document.getElementById(\""+id+"_expiry_date_year_val\").options[document.getElementById(\""+id+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+"_expiry_date_month_val\").options[document.getElementById(\""+id+"_expiry_date_month_val\").selectedIndex].value)' ><option value=''>-Month-</option><?php  for($month_num=1;$month_num<13;$month_num++){ ?> <option value='<?php if($month_num<10) { echo $month_number_convert='0'.$month_num; }else{ echo $month_number_convert=$month_num; } ?>'><?php echo date('M', mktime(0, 0, 0, $month_num, 10)); ?> (<?php echo $month_number_convert;?>)</option><?php  } ?></select><select class='form-control' id='"+id+"_expiry_date_year_val' name='"+id+"_expiry_date_year_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' onChange='calculate_expire_day(\""+id+"_expiry_date_day_val\",document.getElementById(\""+id+"_expiry_date_year_val\").options[document.getElementById(\""+id+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+"_expiry_date_month_val\").options[document.getElementById(\""+id+"_expiry_date_month_val\").selectedIndex].value)' ><option value=''>-Year-</option> <?php $current_years=date("Y"); $previ_y=$current_years-5;$next_y=$current_years+11;while($previ_y<$next_y){ ?><option value='<?php echo $previ_y; ?>'><?php echo $previ_y; ?></option><?php $previ_y++ ;  } ?></select><button type='button' style='background:transparent !important;border: none !important;'> <a href='javascript:void(0);'  id='iop_add_button'  title='Calculate' onClick='calculate_mfg_expire_date(\""+id+item_val[0]+batch_+"_expiry_date\",document.getElementById(\""+id+"_expiry_date_year_val\").options[document.getElementById(\""+id+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+"_expiry_date_month_val\").options[document.getElementById(\""+id+"_expiry_date_month_val\").selectedIndex].value,document.getElementById(\""+id+"_expiry_date_day_val\").value)' alt='Calculate'><img src='icon/icons8-calculator-16.png' class='img-responsive' alt='Calculate'></a></button></div></td><td id='"+id+item_val[0]+batch_+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+batch_+"\")'><i class='fa fa-trash'></i></a></td></tr>");

		calculate(id+item_val[0]+batch_);

	}else{

		

	 	if($("#"+id+item_val[0]+batch_+"_batch_no").val()!=$("#batch_code_val").val()){

			//alert($("[name='"+id+item_val[0]+"_batch_no_sub']").val());

			if(typeof $("[name='"+id+item_val[0]+batch_+"_batch_no_sub']").val() === "undefined"){ 

			icount=parseFloat(icount+1);

			$("#assets_indent_body").append("<tr id='"+id+item_val[0]+batch_+icount+"' data-mrp='"+mrp_+"' data-indent='"+indent_id+"' data-item-id='"+item_val[0]+"' data-details-indent='"+indent_details_id+"'><td><span id='"+id+item_val[0]+batch_+icount+"_hsmcode'>"+slno+"</span></td><td id='"+id+item_val[0]+batch_+icount+"_asset_name' >"+$("#item :selected").text()+"</td><td id='"+id+item_val[0]+batch_+"_batch_no_batch_no' ><input type='text' name='"+id+item_val[0]+batch_+"_batch_no_sub' id='"+id+item_val[0]+batch_+icount+"_batch_no' class='form-control' value='"+$("#batch_code_val").val()+"' ></td><td id='"+id+item_val[0]+batch_+icount+"_bar_cpde_span' ><input type='text' id='"+id+item_val[0]+batch_+"_bar_code' class='form-control' value='"+bar_code_+"' ></td><td id='"+id+icount+"_mfg_date_mfg_date' ><input style='width:80px' type='text' id='"+id+item_val[0]+batch_+icount+"_mfg_date' class='mfg_date' ><div class='input-group'><input type='hidden' name='"+id+icount+"_mfg_date_day_val' id='"+id+icount+"_mfg_date_day_val' class='form-control'  value='01' /><select class='form-control' id='"+id+icount+"_mfg_date_month_val' name='"+id+icount+"_mfg_date_month_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' ><option value=''>-Month-</option><?php  for($month_num=1;$month_num<13;$month_num++){ ?> <option value='<?php if($month_num<10) { echo $month_number_convert='0'.$month_num; }else{ echo $month_number_convert=$month_num; } ?>'><?php echo date('M', mktime(0, 0, 0, $month_num, 10)); ?> (<?php echo $month_number_convert;?>)</option><?php  } ?></select><select class='form-control' id='"+id+icount+"_mfg_date_year_val' name='"+id+"_mfg_date_year_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' ><option value=''>-Year-</option> <?php $current_years=date("Y"); $previ_y=$current_years-5;$next_y=$current_years+11;while($previ_y<$next_y){ ?><option value='<?php echo $previ_y; ?>'><?php echo $previ_y; ?></option><?php $previ_y++ ;  } ?></select><button type='button' style='background:transparent !important;border: none !important;'> <a href='javascript:void(0);'  id='iop_add_button'  title='Calculate' onClick='calculate_mfg_expire_date(\""+id+item_val[0]+batch_+icount+"_mfg_date\",document.getElementById(\""+id+"_mfg_date_year_val\").options[document.getElementById(\""+id+"_mfg_date_year_val\").selectedIndex].value,document.getElementById(\""+id+"_mfg_date_month_val\").options[document.getElementById(\""+id+"_mfg_date_month_val\").selectedIndex].value,document.getElementById(\""+id+"_mfg_date_day_val\").value)' alt='Calculate'><img src='icon/icons8-calculator-16.png' class='img-responsive' alt='Calculate'></a></button></div></td><td id='"+id+"_expiry_date_expiry_date' ><input type='text' style='width:80px' id='"+id+item_val[0]+batch_+"_expiry_date' class='expiry_date' value='"+expiry_date+"' ><div class='input-group'><input type='hidden' name='"+id+icount+"_expiry_date_day_val' id='"+id+icount+"_expiry_date_day_val' class='form-control'  value='31' /><select class='form-control' id='"+id+icount+"_expiry_date_month_val' name='"+id+"_expiry_date_month_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' onChange='calculate_expire_day(\""+id+"_expiry_date_day_val\",document.getElementById(\""+id+"_expiry_date_year_val\").options[document.getElementById(\""+id+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+"_expiry_date_month_val\").options[document.getElementById(\""+id+"_expiry_date_month_val\").selectedIndex].value)' ><option value=''>-Month-</option><?php  for($month_num=1;$month_num<13;$month_num++){ ?> <option value='<?php if($month_num<10) { echo $month_number_convert='0'.$month_num; }else{ echo $month_number_convert=$month_num; } ?>'><?php echo date('M', mktime(0, 0, 0, $month_num, 10)); ?> (<?php echo $month_number_convert;?>)</option><?php  } ?></select><select class='form-control' id='"+id+icount+"_expiry_date_year_val' name='"+id+icount+"_expiry_date_year_val' style='width:50px !important;font-size:8px !important;padding: 1px !important;height:20px !important;font-weight:bold !important;' onChange='calculate_expire_day(\""+id+icount+"_expiry_date_day_val\",document.getElementById(\""+id+icount+"_expiry_date_year_val\").options[document.getElementById(\""+id+icount+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+icount+"_expiry_date_month_val\").options[document.getElementById(\""+id+icount+"_expiry_date_month_val\").selectedIndex].value)' ><option value=''>-Year-</option> <?php $current_years=date("Y"); $previ_y=$current_years-5;$next_y=$current_years+11;while($previ_y<$next_y){ ?><option value='<?php echo $previ_y; ?>'><?php echo $previ_y; ?></option><?php $previ_y++ ;  } ?></select><button type='button' style='background:transparent !important;border: none !important;'> <a href='javascript:void(0);'  id='iop_add_button'  title='Calculate' onClick='calculate_mfg_expire_date(\""+id+item_val[0]+batch_+icount+"_expiry_date\",document.getElementById(\""+id+icount+"_expiry_date_year_val\").options[document.getElementById(\""+id+"_expiry_date_year_val\").selectedIndex].value,document.getElementById(\""+id+icount+"_expiry_date_month_val\").options[document.getElementById(\""+id+icount+"_expiry_date_month_val\").selectedIndex].value,document.getElementById(\""+id+icount+"_expiry_date_day_val\").value)' alt='Calculate'><img src='icon/icons8-calculator-16.png' class='img-responsive' alt='Calculate'></a></button></div></td><td id='"+id+item_val[0]+batch_+icount+"_qty_qty' >"+$("#"+id+"_qty").val()+"</td><td><a href='javascript:;' onclick='del(\""+id+item_val[0]+batch_+"\")'><i class='fa fa-trash'></i></a></td></tr>");

			}else{

						let qty_added=$("#"+id+item_val[0]+icount+"_qty_qty").html();

						// alert(qty_added);

						$("#"+id+item_val[0]+icount+"_qty_qty").html((parseFloat(qty_added)+parseFloat($("#"+id+"_qty").val())));

						 $("#"+id+item_val[0]+"_qty").val(parseFloat($("#"+id+item_val[0]+"_qty").attr("data-qty"))-(parseFloat($("#"+id+item_val[0]+"_qty").val())+parseFloat(qty_added)));

						  // let qty_added=tds.html();

						  //$("#"+id+item_val[0]+batch_+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));

						  calculate(id+item_val[0]+batch_+icount);

					}

					

			

		}else{

				 let qty_added=tds.html();

		 		 $("#"+id+item_val[0]+batch_+"_qty_qty").html((parseFloat(tds.html())+parseFloat($("#"+id+"_qty").val())));

				 calculate(id+item_val[0]);

		}

		

	 

		

	 }

}

function calculate(id){

	//alert(id);

	let total_qty=0;

	

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){

		//alert($("#"+$( this ).attr('id')+"_qty_qty").html());

		total_qty=parseInt(total_qty)+parseInt($("#"+$( this ).attr('id')+"_qty_qty").html());

		

	});

	$("#total_qty").html(parseInt(total_qty));

	

	console.log("Total Qty: "+$("#"+$( this ).attr('id')+"_qty_qty").html());

	

}

$("#stock_qty").html('');

function save_sales(flag=0){

	let doc=$("#doctors").select2('data');

	

	let doc_val="";

	let doc_id="";

	if(doc.text!="" || !doc.text){

		doc_val=doc.text;

		doc_id=doc.id;

	}else{

		if(confirm("Do you want to continue without Doctor?")) doc_val="";

		else return false;

	}

	let ids=[];

	let qty=[];

	let batch_no=[];

	let expiry_date=[];

	let mfg_date=[];

	let asset_name=[];
	let bar_codee=[];

	let i=0;

	let return_flag=0;

	

	$("#asset_entry_data1 > tbody  > tr").each(function( index, val ){

  		console.log( index + ": " + $( this ).attr('id') );

		//alert($("#"+$( this ).attr('id')+"_batch_no").val());

		//return;

		//purchase_id[i]=$( this ).attr('data-indent');

		//purchase_details_id[i]=$( this ).attr('data-details-indent');

		ids[i]=$( this ).attr('data-item-id');

		qty[i]=$("#"+$( this ).attr('id')+"_qty_qty").html();

		batch_no[i]=$("#"+$( this ).attr('id')+"_batch_no").val();

		expiry_date[i]=$("#"+$( this ).attr('id')+"_expiry_date").val();

		mfg_date[i]=$("#"+$( this ).attr('id')+"_mfg_date").val();
		bar_codee[i]=$("#"+$( this ).attr('id')+"_bar_code").val();

		asset_name[i]=$("#"+$( this ).attr('id')+"_asset_name").html();

		

		

		i++;

});



	let grand_total=$("#total_qty").html();



	if(return_flag==1) return false;

	var data_details={

		//"purchase_id" : purchase_id,

		//"purchase_details_id" : purchase_details_id,

		"id" : ids,

		"qty" : qty,

		"batch_no" : batch_no,

		"mfg_date" : mfg_date,

		"expiry_date" : expiry_date,

		"asset_name" : asset_name,

		"uhid"	:	$("#patient_uhid").val(),

		"doctor_id"	:	doc_id,

		"doctor_name"	:	doc_val,
		"bar_code"	:	bar_codee,

		"patient_name"	:	$("#customer_name").val(),

	}

	

	$.ajax({

            url: 'get_json_data_for_lens_library.php?flag=45',

			type: 'POST',

			dataType: 'json',

			data: data_details,

			success: function (data) {

			

				//console.log(data.confirm_flag);

				//alert("data");	

				//alert(data.flag);

				//load_asset_entry_data();

				if(data.flag=="1"){

				 	toastr.success('Lens Received Successfully');

				}else{

				

				 	if(data.reason!="") toastr.error(data.reason);

				 	else toastr.error('Unable to save data');

				}

				

				//if(flag==1) window.open("stock_transfer_print.php?inv_id="+data.s_id);

				

				setTimeout(function(){ location.reload(); }, 2000);	

			}

			

		});

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

            url: 'get_json_data_for_lens_library.php?flag=5',

			dataType: 'json',

			type: 'POST',

			success: function (data) {

			

			 $.each(data, function(index, element) {

				 if(element.text=='Lens' || element.text=='LENS'){

			 	$('#type_name').append($('<option/>', { 



					value: element.id,

					text : element.text 



				}));

				 }

		 	});

			

			document.getElementById("type_name").onchange();

			//load_item();

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



            url: 'get_json_data_for_lens_library.php?flag=6',

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

            url: 'get_json_data_for_lens_library.php?flag=17',

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

	/*let item_val=$("#item").find(":selected").val().split("^");

	var batch_code_val=$("#batch_code_val").find(":selected").val();

	let flag_=false;

	let data_details={

	"batch_code": batch_code_val,

	"item_id": item_val[0] ,

	}*/
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

            url: 'get_json_data_for_lens_library.php?flag=30',

			type: 'POST',

			dataType: 'json',

			data: data_details,

			async: false, 

			success: function (data) {

			//alert(data.mrp);	

		 	mrp=data.rate;

			mrp_=data.mrp;

			expiry_date=data.expiry_date;

			mgf_date=data.mfg_date;
			bar_code_=data.bar_code;

			$('#mrp').val(mrp_);

			if(mrp!=null){

				flag_=true;

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

            url: 'get_json_data_for_lens_library.php?flag=28',

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

			/*search_code();

			load_stock_for_lens_library();*/
			if(asset_val==''){
			search_code();
			load_stock_for_lens_library();
			}else{
			search_code(asset_val);	
			load_stock_for_lens_library(item_id);
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

/*function get_patient_details(){



	 $("#customer_name").val('');

	 $("#phone_number").val('');

	uhid=$("#patient_uhid").val();

	$.ajax({

            url: 'get_json_data_for_lens_library.php?flag=34',

			type: 'POST',

			dataType: 'json',

			data: "uhid="+uhid,

			async: false, 

			success: function (data) {

				

		 		$("#customer_name").val(data.name);

				$("#phone_number").val(data.mobile);

				//let tmp=uhid.split('/');

				//alert(tmp[1]);

				//$("#doctors").val(tmp[1]);

				load_doctors(data.doc_id);

				//$("#doctors").select2("val", data.doc_id);

				

			}

		});



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

                        var html = '<label><span id="mrd"><a href="javascript:void(0)" onClick="old_pres_pb_fetch(\'' + element.id + '\',\'' + element.created_on + '\');">' + element.created_on + '</a></span></label><br>';

                        $("#old_patient_date_popup_show").append(html);

                    });

                }

            });

} 
function old_pres_pb_fetch(p_id,created_on) {

			 $("#uhid").val('');

			 if($("#patient_uhid").val()==''){

				alert('Please Select UHID');

				return false;	

			}

			var mrd= $("#patient_uhid").val();
			$("#uhid").val(mrd);	
			 $("#customer_name").val('');
			 $("#phone_number").val('');

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
					$("#customer_name").val(data.patient_name);
					$("#phone_number").val(data.mobile);
					//load_doctors(data.doc_id);
					$('#inv_date').val(created_on);
					$("#doctors").select2("val", data.primary_doctor);
                },

                complete: function() {

                    $('.ajax-loader').css("visibility", "hidden");

                }

            });

}

function serch_item_ber_code(bar_code){
	$('#qr_scan_input').val('');
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=51',
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
function load_sale_order_details(cou_pag_no){
	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;
	var data_details={
		"initial_page": initial_page,
		"limit": <?php echo $limit;?>
	}
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=55',
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
					 /*$arr[]=array("asset_name"=>$asset_name,"id"=>$id,"batch"=>$batch,"mrd"=>$mrd,"patient_name"=>$patient_name,"doctor_name"=>$doctor_name,"manufacturing_date"=>$mfg_date_,"expiry_date"=>$expiry_date,"status"=>$status,"bar_code"=>$bar_code,"qty"=>$qty);*/
					html +='<tr style="background-color:'+colour+'"><td>'+element.mrd+'</td><td>'+element.patient_name+'</td><td>'+element.asset_name+'</td><td>'+element.qty+'</td><td>'+element.batch+'</td><td>'+element.bar_code+'</td><td>'+element.manufacturing_date+'</td><td>'+element.expiry_date+'</td><td>'+element.sold+'</td><td>'+element.created_on+'</td></tr>';
				});
				$('#tab_po_body').html(html);
			 }
		  });

}
</script>