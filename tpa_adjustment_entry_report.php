<?php
include 'conn.php';
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
if(isset($_REQUEST['save_request']))
{
	$bill_unique_id=mysqli_real_escape_string($conn,$_REQUEST['bill_unique_id']);
	$payment_unique_id=mysqli_real_escape_string($conn,$_REQUEST['payment_unique_id']);
	$countiopc=mysqli_real_escape_string($conn,$_REQUEST['countiopc']);
	 $flag_check=0;
	$created_on=date('Y-m-d H:i:s');
	$created_by=$_SESSION['id'];
	for($i=1;$i<=$countiopc;$i++) {

				 if($_REQUEST['net_amt'.$i]!='')
				   {
					  
					   if($_REQUEST['tpa_recovery_due'.$i]=='0')
				   		{
							$flag_check=1;
						}
						if($flag_check=='0')
				   		{
							if($_REQUEST['accounts_entry_date'.$i]==''){
								$accounts_entry_date='NULL';
							}else{
								$accounts_entry_date= "'".date("Y-m-d", strtotime($_REQUEST['accounts_entry_date'.$i]))."'";
					
							}
							if($_REQUEST['due_recieved_date'.$i]==''){
								$due_recieved_date='NULL';
							}else{
								$due_recieved_date= "'".date("Y-m-d", strtotime($_REQUEST['due_recieved_date'.$i]))."'";
					
							}
					     if($_REQUEST['part_payment_flag'.$i]!='1')
			   			 {
														 
							 $sql4 = $conn->query("INSERT INTO `invoice_final_part_payment_tpa` SET `bill_unique_id`='".$bill_unique_id."',`payment_unique_id`='".$payment_unique_id."',`accounts_entry_date` = ".$accounts_entry_date.",`due_recieved_date` = ".$due_recieved_date.",`part_payment_flag` = '1',`net_amt` = '".$_REQUEST['net_amt'.$i]."',`recovery_amt` = '".$_REQUEST['recovery_amt'.$i]."',`tds` = '".$_REQUEST['tds'.$i]."',`discount_tpa` = '".$_REQUEST['discount_tpa'.$i]."',`total_tpa` = '".$_REQUEST['total_tpa'.$i]."',`tpa_recovery_due` = '".$_REQUEST['tpa_recovery_due'.$i]."',`remarks_tpa` = '".$_REQUEST['remarks_tpa'.$i]."',`created_by`='".$created_by."',`created_on`='".$created_on."' ");						
			   			}
						if($_REQUEST['part_payment_flag'.$i]=='1')
			   			 {
							$sql4 = $conn->query(" UPDATE `invoice_final_part_payment_tpa` SET `bill_unique_id`='".$bill_unique_id."',`payment_unique_id`='".$payment_unique_id."',`accounts_entry_date` = ".$accounts_entry_date.",`due_recieved_date` = ".$due_recieved_date.",`part_payment_flag` = '1',`net_amt` = '".$_REQUEST['net_amt'.$i]."',`recovery_amt` = '".$_REQUEST['recovery_amt'.$i]."',`tds` = '".$_REQUEST['tds'.$i]."',`discount_tpa` = '".$_REQUEST['discount_tpa'.$i]."',`total_tpa` = '".$_REQUEST['total_tpa'.$i]."',`tpa_recovery_due` = '".$_REQUEST['tpa_recovery_due'.$i]."',`remarks_tpa` = '".$_REQUEST['remarks_tpa'.$i]."',`modified_by`='".$created_by."',`modified_time`='".$created_on."' WHERE `id` = '".$_REQUEST['part_payment_insrt_id'.$i]."' ");						

			   			}					 

				   }  
				   
				   
				   }

				}
				
		$remove_id_for_procedure=mysqli_real_escape_string($conn,$_REQUEST['remove_id_for_procedure']);
				
		if($remove_id_for_procedure!='')

		   {

			    $remove_id_array=explode(":",$remove_id_for_procedure);

			   //print_r($remove_id_array);

			    $itemCount = sizeof($remove_id_array);

			   //exit;

			   for($i=0;$i<($itemCount-1);$i++) {				  

			 	 $sql4 = $conn->query("UPDATE `invoice_final_part_payment_tpa` SET `del_flag` = '1', `deleted_time`='".$created_on."' , `deleted_by`='".$created_by."' WHERE `id`='".$remove_id_array[$i]."' ");

			   }

			   

		   }
		   $msg="Record updated successfully";
			$flg=0;		
		   $redirectUrl=ADMIN_URL.'tpa_adjustment_entry_report.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">window.location.href='$redirectUrl'; </script>";				

}

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
.modal-content {
	width:1200px !important;
	margin-left:-300px !important;
}
.tot_class {
	font-size:20px !important;
	font-weight:bold !important;
	color:red;
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
                  <select name="tpa_name" id="tpa_name" class="form-control select2" >
                    <option value=""> Choose..</option>
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
                      <th width="10%" >Bill No.</th>
                      <th width="10%" >RegID</th>
                      <th width="10%" >Bill Date</th>
                      <th width="10%" >Patient Name</th>
                      <th width="10%" >Doc Name</th>
                      <th width="10%" >Net Amt</th>
                      <th width="10%" >Recovery Amt.</th>
                      <th width="10%" >TDS</th>
                      <th width="10%" >Discount</th>
                      <th width="10%" >Total</th>
                      <th width="10%" >Tpa Recovery Due</th>    
                      <th width="10%" >Accounts Entry<br /> Date</th>                  
                      <th width="10%" >Recovery Date</th>
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
      <div class="modal fade" id="request_for_extra_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> TPA Adjustment / Recover </h5>
            </div>
            <form method="post" action="" id="add-request">
              <div class="modal-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">UHID</th>
                      <th scope="col">Invoice No.</th>
                      <th scope="col">Bill Date</th>
                      <th scope="col">Patient Name</th>
                      <th scope="col">Total Bill Amt.</th>
                      <th scope="col">TPA Amt.</th>
                    </tr>
                  </thead>
                  <tbody id="tab_rextra_info">
                  </tbody>
                </table>
                <br />
                <span class="tot_class">Total TPA Amount: </span><span  class="tot_class" id="total_tpa_amt_span"></span> <a href="javascript:void(0);" id="iop_add_buttonc" class="btn" title="Add One IOP" style="margin:0 !important; float:right;"><i class="fa fa-plus" style="font-size:20px;color:red;"></i></a> <br />
                <table class="table table-striped table-bordered table-advance table-hover" id="iop_tabc">
                  <?php

									$count=1;

									$sl=1;

                                     echo '<input type="hidden" name="countiopc" id="countiopc" value="'.$count.'">';

                                  ?>
                                  <input type="hidden" name="bill_unique_id" id="bill_unique_id" class="form-control" value=""  />
                 				 <input type="hidden" name="payment_unique_id" id="payment_unique_id" class="form-control" value=""  />
                                 <input type="hidden" name="total_tpa_amt_val" id="total_tpa_amt_val" class="form-control" value="0"  />
                    <thead>
                                 
                  <tr>
                    <th>TPA Due <br />
                      Entry Date:</th>
                    <th>TPA Due <br />
                      Received Date:</th>
                    <th>TPA Net Amt.</th>
                    <th>Recovery Amt.:</th>
                    <th>TDS.:</th>
                    <th>Discount:</th>
                    <th>Total:</th>
                    <th>Tpa Recovery Due:</th>
                    <th>Remarks:</th>
                    <th>&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr id="iopc<?php echo $sl; ?>">
                    <td ><input type="text"  autocomplete="off" class="form-control" placeholder="Enter Text" name="accounts_entry_date<?php echo $sl; ?>" id="accounts_entry_date<?php echo $sl; ?>" value="<?php echo date('d-m-Y'); ?>" readonly />
                     
                  <input type="hidden"  autocomplete="off" class="form-control" placeholder="Enter Text" name="part_payment_flag<?php echo $sl; ?>" id="part_payment_flag<?php echo $sl; ?>" value="0"   />
                  <input type="hidden"  autocomplete="off" class="form-control" placeholder="Enter Text" name="part_payment_insrt_id<?php echo $sl; ?>" id="part_payment_insrt_id<?php echo $sl; ?>" value=""   />
                    </td>
                    <td ><input type="text"  autocomplete="off" class="form-control" placeholder="Enter Text" name="due_recieved_date<?php echo $sl; ?>" id="due_recieved_date<?php echo $sl; ?>" value="<?php echo date('d-m-Y'); ?>"  /></td>
                    <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="net_amt<?php echo $sl; ?>" id="net_amt<?php echo $sl; ?>" value="0" readonly  /></td>
                    <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="recovery_amt<?php echo $sl; ?>" id="recovery_amt<?php echo $sl; ?>" onKeyUp="value=value.replace(/[^\d]/g,'');amount_calculate('recovery_amt<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();"  value="0" ></td>
                    <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="tds<?php echo $sl; ?>" id="tds<?php echo $sl; ?>" onKeyUp="value=value.replace(/[^\d]/g,'');amount_calculate('tds<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();"  value="0" ></td>
                    <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="discount_tpa<?php echo $sl; ?>" id="discount_tpa<?php echo $sl; ?>" onKeyUp="value=value.replace(/[^\d]/g,'');amount_calculate('discount_tpa<?php echo $sl; ?>','<?php echo $sl; ?>');calculate_sales();"  value="0" ></td>
                    <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="total_tpa<?php echo $sl; ?>" id="total_tpa<?php echo $sl; ?>" value="0" readonly  /></td>
                    <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="tpa_recovery_due<?php echo $sl; ?>" id="tpa_recovery_due<?php echo $sl; ?>" value="0" readonly  /></td>
                    <td ><textarea  class="form-control" placeholder="Enter Text" name="remarks_tpa<?php echo $sl; ?>" id="remarks_tpa<?php echo $sl; ?>"  ></textarea></td>
                    <td ><!--<a href="javascript:void(0);"  id="iop_removec<?php echo $sl; ?>" onClick="remove_iopc('<?php echo $sl; ?>');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a>--></td>
                  </tr>
                  </tbody>
                </table>
                <input type="hidden" name="remove_id_for_procedure" id="remove_id_for_procedure" value="">
                <br />
                <span class="tot_class">Total Amount: </span> <span class="tot_class" id="total_recieved_amt_span"></span> <br />
                <span class="tot_class">Total Due Amount: </span> <span class="tot_class" id="total_due_amt_span"></span> <br />
                <input type="hidden" name="total_recieved_amt_val" id="total_recieved_amt_val" class="form-control" value="0"  />
                <input type="hidden" name="total_due_amt_val" id="total_due_amt_val" class="form-control" value="0"  />
              </div>
               <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="save_request"  name="save_request" disabled="disabled">Save</button>
            </div>
            </form>
           
          </div>
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
	$("#tpa_name").select2();
	tpa_values_fetch();
	
	$("#due_recieved_date1").datepicker({
		format: 'dd-mm-yyyy'
	});
	
	$("#iop_add_buttonc").click(function(){ 
			 var i=$("#countiopc").val();
			 i=parseInt(i)+1;
			 $("#countiopc").val(i);			  
			 $("#iop_tabc").append('<tr id="iopc' + i + '"><td ><input type="text"  autocomplete="off" class="form-control" placeholder="Enter Text" name="accounts_entry_date' + i + '" id="accounts_entry_date' + i + '" value="<?php echo date('d-m-Y'); ?>" readonly /><input type="hidden"  autocomplete="off" class="form-control" placeholder="Enter Text" name="part_payment_flag' + i + '" id="part_payment_flag' + i + '" value="0"   /><input type="hidden"  autocomplete="off" class="form-control" placeholder="Enter Text" name="part_payment_insrt_id' + i + '" id="part_payment_insrt_id' + i + '" value=""   /></td><td ><input type="text"  autocomplete="off" class="form-control" placeholder="Enter Text" name="due_recieved_date' + i + '" id="due_recieved_date' + i + '" value="<?php echo date('d-m-Y'); ?>"  /></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="net_amt' + i + '" id="net_amt' + i + '" value="0" readonly  /></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="recovery_amt' + i + '" id="recovery_amt' + i + '" onKeyUp="replace_value(\'recovery_amt' + i + '\',\'' + i + '\');amount_calculate(\'recovery_amt' + i + '\',\'' + i + '\');calculate_sales();"  value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="tds' + i + '" id="tds' + i + '" onKeyUp="replace_value(\'tds' + i + '\',\'' + i + '\');amount_calculate(\'tds' + i + '\',\'' + i + '\');calculate_sales();"  value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="discount_tpa' + i + '" id="discount_tpa' + i + '" onKeyUp="replace_value(\'discount_tpa' + i + '\',\'' + i + '\');amount_calculate(\'discount_tpa' + i + '\',\'' + i + '\');calculate_sales();"  value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="total_tpa' + i + '" id="total_tpa' + i + '" value="0" readonly  /></td> <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="tpa_recovery_due' + i + '" id="tpa_recovery_due' + i + '" value="0" readonly  /></td><td ><textarea  class="form-control" placeholder="Enter Text" name="remarks_tpa' + i + '" id="remarks_tpa' + i + '"  ></textarea></td> <td ><a href="javascript:void(0);"  id="iop_removec' + i + '" onClick="remove_iopc(' + i + ');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
			 $("#due_recieved_date" + i ).datepicker({
				format: 'dd-mm-yyyy'
			});			
			calculate_sales();
			amount_calculate('recovery_amt'+ i,i);
			var countiopc=$("#countiopc").val(); 	
			var total_tpa_tot=0;
			for(var i=1;i<=countiopc;i++){		
				var total_tpa=$("#total_tpa"+i).val();
				if ((isNaN(total_tpa)) || (total_tpa == '')) {
					 total_tpa = 0;			 
				}	
				total_tpa_tot=parseFloat(total_tpa_tot)+parseFloat(total_tpa);				
		
			}
			var total_tpa_amt_val=$("#total_tpa_amt_val").val();
			var tpa_recovery_due=parseFloat(total_tpa_amt_val)-parseFloat(total_tpa_tot);
			$("#total_recieved_amt_span").html(total_tpa_tot);
			$("#total_recieved_amt_val").val(total_tpa_tot);
			$("#total_due_amt_span").html(tpa_recovery_due);
			$("#total_due_amt_val").val(tpa_recovery_due);
			 
		 });

 });
 
 
function remove_iopc(j) {
	  $("#iopc"+j).remove();
	  calculate_sales();
}

function remove_iopc_update(j,id) {
  $("#iopc"+j).remove();
  var remove_id_for_procedure=$("#remove_id_for_procedure").val();
  var values_drug=remove_id_for_procedure+id+":";
  $("#remove_id_for_procedure").val(values_drug);
  calculate_sales(); 
}

function replace_value(select_id,no){
	var id_values=$("#"+select_id).val();
	var newStr = id_values.replace(/[a-zA-Z]/g, '');
	var newStr2 = newStr.replace(/[ ]/g, '');
	var newStr3 = newStr2.replace(/[_\W]+/g, '');
	$("#"+select_id).val(newStr3);
}


function calculate_sales(){
	var submit_flag=0;
	if(parseFloat($("#total_recieved_amt_val").val()<=0)){
		alert("Please fill up details");		
		submit_flag=1;
	}
	if(parseFloat($("#total_recieved_amt_val").val())>parseFloat($("#total_tpa_amt_val").val())){
		alert("Total Amount is greater than Total TPA Amount");		
		submit_flag=1;
	}
	if(submit_flag=='0'){
		$("#save_request").prop( "disabled", false );	
	}else{
		$("#save_request").prop( "disabled", true );
	}
	
}
function amount_calculate(inpt_id,no){
	
	var total_tpa_amt_val=$("#total_tpa_amt_val").val();	
	if(no==1){
		$("#net_amt"+no).val(total_tpa_amt_val);
	}else{
		var prev_net_amt=$("#tpa_recovery_due"+(parseFloat(no)-1)).val();
		$("#net_amt"+no).val(prev_net_amt);
		var check_tpa=$("#tpa_recovery_due"+(parseFloat(no)-1)).val();
		//alert(check_tpa);
		if((parseInt(check_tpa))<1){
			alert("TPA Recovery Full Settled");
			remove_iopc(no);		
			return false;	
		}
		if (typeof check_tpa === "undefined") {
			alert("TPA Recovery Full Settled");
			remove_iopc(no);		
			return false;	
		}
	}
	var recovery_amt=$("#recovery_amt"+no).val();
	var tds=$("#tds"+no).val();
	var discount_tpa=$("#discount_tpa"+no).val();
	if ((isNaN(recovery_amt)) || (recovery_amt == '')) {
		 recovery_amt = 0;
	}
	if ((isNaN(tds)) || (tds == '')) {
		 tds = 0;
	}
	if ((isNaN(discount_tpa)) || (discount_tpa == '')) {
		 discount_tpa = 0;
	}
	var total_tpa=parseFloat(recovery_amt)+parseFloat(tds)+parseFloat(discount_tpa);
	$("#total_tpa"+no).val(total_tpa);
	var countiopc=$("#countiopc").val(); 	
	var total_tpa_tot=0;
	for(var i=1;i<=countiopc;i++){		
		var total_tpa=$("#total_tpa"+i).val();
		if ((isNaN(total_tpa)) || (total_tpa == '')) {
			 total_tpa = 0;			 
		}	
		total_tpa_tot=parseFloat(total_tpa_tot)+parseFloat(total_tpa);				

	}
	var tpa_recovery_due=parseFloat(total_tpa_amt_val)-parseFloat(total_tpa_tot);
	$("#total_recieved_amt_span").html(total_tpa_tot);
	$("#total_recieved_amt_val").val(total_tpa_tot);
	$("#total_due_amt_span").html(tpa_recovery_due);
	$("#total_due_amt_val").val(tpa_recovery_due);
	
	var net_amt=$("#net_amt"+no).val();
	if ((isNaN(net_amt)) || (net_amt == '')) {
		 net_amt = 0;			 
	}	
	var total_tpa=$("#total_tpa"+no).val();
	if ((isNaN(total_tpa)) || (total_tpa == '')) {
		 total_tpa = 0;			 
	}	
	var	tpa_recovery_due=parseFloat(net_amt)-parseFloat(total_tpa);
	$("#tpa_recovery_due"+no).val(tpa_recovery_due);
	
}
 
 
 function tpa_values_fetch(){

	$("#tpa_name").html("");

		$("#tpa_name").append($('<option/>', { 

			value: "",

			text : "Select" 

		}));
		

		$.ajax({

		url: 'ajax/tpa_option_fetch_ajax.php',

		dataType: 'json',

		type: 'POST',

		data: 'no=1',			

		success: function (data) {						

			 $.each(data, function(index, element) {

				$('#tpa_name').append($('<option/>', { 

					value: element.value,

					text : element.text 

				}));				

			 });

		 }
	 });
}



var tab_asset_entry="";

load_admssion_details();

function load_admssion_details(){	
if($("#tpa_name").val()==''){
 alert("Please Select TPA Option");
 //return false;	
}
if(tab_asset_entry!="") tab_asset_entry.destroy();
	var data_details={
					"from_date": $("#from_date").val(),	
					"to_date": $("#to_date").val(),
					"bill_type": $("#bill_type").val(),	
					"tpa_id": $("#tpa_name").val(),
					"tpa_name": $('#tpa_name option:selected').text()		
	}
	var title_span="";
	
	$.ajax({
		
            url: 'get_json_data_for_report_details.php?flag=8',
			dataType: 'json',
			data: data_details,
			type: 'POST',
			beforeSend: function(){
			// Show image container

			$('#assets_body').html('');
			$('#title_span').html('');

			//$("#loader").show();
			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="14" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');		

		   },

			success: function (data) {
			 $('#assets_body').html('');
				var tpa_amt_grand_total=0;
				var recovery_grand_total=0;
				var tds_grand_total=0;
				var discount_tpa_grand_total=0;
				var tpa_recovery_due_grand_total=0;
				var total_tpa_amount_grand_total=0;	
				var print_url="";
				var extra_info="";
			  $.each(data, function(index, element) {	
			  
			    print_url="<?php echo ADMIN_URL.'print_final_bill_for_ipd_new.php?id=';  ?>"+element.id;				  
				extra_info="<a href='javascript:void(0);' onClick='extra_info_load("+element.payment_unique_id+","+element.id+")' style='color:#0600ff;'>"+element.tpa_amt+"</a>" ;
			  		  
			 	$('#assets_body').html($('#assets_body').html()+'<tr ><td class="defualt_td"><a href="'+print_url+'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'+element.bill_no+'</a></td><td class="defualt_td">'+element.hospital_number+'</td><td class="defualt_td">'+element.payment_date+'</td><td class="defualt_td">'+element.patient_name+'</td><td class="defualt_td">'+element.primary_doctor+'</td><td class="defualt_td">'+extra_info+'</td><td class="defualt_td">'+element.recovery_amt+'</td><td class="defualt_td">'+element.tds+'</td><td class="defualt_td">'+element.discount_tpa+'</td><td class="defualt_td">'+element.total_tpa+'</td><td class="defualt_td">'+element.tpa_recovery_due+'</td><td class="defualt_td">'+element.accounts_entry_date+'</td><td class="defualt_td">'+element.due_recieved_date+'</td><td class="defualt_td">'+element.remarks_tpa+'</td></tr>');
				var tpa_amt=element.tpa_amt;
				if ((isNaN(tpa_amt)) || (tpa_amt == '')) {
					tpa_amt = 0;
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
				var tpa_recovery_due=element.tpa_recovery_due;
				if ((isNaN(tpa_recovery_due)) || (tpa_recovery_due == '')) {
					tpa_recovery_due = 0;
				}
				var total_tpa=element.total_tpa;
				if ((isNaN(total_tpa)) || (total_tpa == '')) {
					total_tpa = 0;
				}
				
				tpa_amt_grand_total=parseInt(tpa_amt_grand_total)+parseInt(tpa_amt);
				recovery_grand_total=parseInt(recovery_grand_total)+parseInt(recovery_amt);
				tds_grand_total=parseInt(tds_grand_total)+parseInt(tds);
				discount_tpa_grand_total=parseInt(discount_tpa_grand_total)+parseInt(discount_tpa);
				tpa_recovery_due_grand_total=parseInt(tpa_recovery_due_grand_total)+parseInt(tpa_recovery_due);
				total_tpa_amount_grand_total=parseInt(total_tpa_amount_grand_total)+parseInt(total_tpa);
				title_span=element.title_span;	
			
		 	});
			
			$('#assets_body').html($('#assets_body').html()+'<tr ><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'+tpa_amt_grand_total+'</td><td class="bold_td bord_bott">'+recovery_grand_total+'</td><td class="bold_td bord_bott">'+tds_grand_total+'</td><td class="bold_td bord_bott">'+discount_tpa_grand_total+'</td><td class="bold_td bord_bott">'+total_tpa_amount_grand_total+'</td><td class="bold_td bord_bott">'+tpa_recovery_due_grand_total+'</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td></tr>');
			if(tpa_amt_grand_total>0){
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

function extra_info_load(payment_unique_id,bill_unique_id){
	$("#bill_unique_id").val('');
	$("#payment_unique_id").val('');
	$('#request_for_extra_info').modal('show');
	$("#bill_unique_id").val(bill_unique_id);
	$("#payment_unique_id").val(payment_unique_id);			
	$('#due_recieved_date1').val('<?php echo date('d-m-Y'); ?>');	
	$('#net_amt1').val('0');
	$('#recovery_amt1').val('0');
	$('#tds1').val('0');
	$('#discount_tpa1').val('0');
	$('#tpa_recovery_due1').val('0');
	$('#total_tpa1').val('0');
	$('#remarks_tpa1').val('');
	$('#accounts_entry_date').val('<?php echo date('d-m-Y'); ?>');
	$('#total_tpa_amt_span').html('0');
	$('#total_recieved_amt_span').html('0');
	$('#total_due_amt_span').html('0');
	$('#total_tpa_amt_val').val('0');
	$('#total_recieved_amt_val').val('0');
	$('#total_due_amt_val').val('0');
	var countiopc= $('#countiopc').val();
	for(var i=2;i<=countiopc;i++){	
		remove_iopc(i);	
	}
	$('#countiopc').val('1');
	$("#save_request").prop( "disabled", true );
			
	$.ajax({
		url: '<?php echo ADMIN_URL; ?>ajax/request_for_edit_ajax.php?flag=6',
        type: 'post',
        data: 'bill_unique_id='+bill_unique_id+'&payment_unique_id='+payment_unique_id,
		dataType: 'json',
        success: function(data) {
			$('#tab_rextra_info').html('<tr><td class="text-center">'+data.hospital_number+'</td><td class="text-center">'+data.bill_no+'</td><td class="text-center">'+data.billing_date+'</td><td class="text-center">'+data.name+'</td><td class="text-center">'+data.total+'</td><td class="text-center">'+data.tpa_main_amt+'</td></tr>');						
			$('#total_tpa_amt_span').html(data.tpa_main_amt);			
			$('#total_recieved_amt_span').html(data.total_tpa);
			$('#total_due_amt_span').html((parseInt(data.tpa_main_amt)-parseInt(data.tpa_recovery_due)));
			$('#total_tpa_amt_val').val(data.tpa_main_amt);
			$('#total_recieved_amt_val').val(data.total_tpa);
			$('#total_due_amt_val').val((parseInt(data.tpa_main_amt)-parseInt(data.tpa_recovery_due)));
			$('#net_amt1').val(data.tpa_main_amt);
        }

    });
	
	$.ajax({
		url: '<?php echo ADMIN_URL; ?>ajax/request_for_edit_ajax.php?flag=8',
        type: 'post',
        data: 'bill_unique_id='+bill_unique_id+'&payment_unique_id='+payment_unique_id,
		dataType: 'json',
        success: function(data) {
			$("#iop_tabc > tbody").html('');
			var total_all_expences=0;	
			var row_increase=0;
			var total_rows=1;
			if (data && data.length > 0) {
			$.each(data, function(index, element) {
				$("#iop_tabc").append('<tr id="iopc' + element.sl +  '"><td ><input type="text"  autocomplete="off" class="form-control" placeholder="Enter Text" name="accounts_entry_date' + element.sl +  '" id="accounts_entry_date' + element.sl +  '" value="' + element.accounts_entry_date +  '" readonly /><input type="hidden"  autocomplete="off" class="form-control" placeholder="Enter Text" name="part_payment_flag' + element.sl +  '" id="part_payment_flag' + element.sl +  '" value="' + element.part_payment_flag +  '"   /><input type="hidden"  autocomplete="off" class="form-control" placeholder="Enter Text" name="part_payment_insrt_id' + element.sl +  '" id="part_payment_insrt_id' + element.sl +  '" value="' + element.part_payment_insrt_id +  '"   /></td><td ><input type="text"  autocomplete="off" class="form-control" placeholder="Enter Text" name="due_recieved_date' + element.sl +  '" id="due_recieved_date' + element.sl +  '" value="' + element.due_recieved_date +  '"  /></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="net_amt' + element.sl +  '" id="net_amt' + element.sl +  '" value="' + element.net_amt +  '" readonly  /></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="recovery_amt' + element.sl +  '" id="recovery_amt' + element.sl +  '" onKeyUp="replace_value(\'recovery_amt' + element.sl +  '\',\'' + element.sl +  '\');amount_calculate(\'recovery_amt' + element.sl +  '\',\'' + element.sl +  '\');calculate_sales();"  value="' + element.recovery_amt +  '" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="tds' + element.sl +  '" id="tds' + element.sl +  '" onKeyUp="replace_value(\'tds' + element.sl +  '\',\'' + element.sl +  '\');amount_calculate(\'tds' + element.sl +  '\',\'' + element.sl +  '\');calculate_sales();"  value="' + element.tds +  '" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="discount_tpa' + element.sl +  '" id="discount_tpa' + element.sl +  '" onKeyUp="replace_value(\'discount_tpa' + element.sl +  '\',\'' + element.sl +  '\');amount_calculate(\'discount_tpa' + element.sl +  '\',\'' + element.sl +  '\');calculate_sales();"  value="' + element.discount_tpa +  '" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="total_tpa' + element.sl +  '" id="total_tpa' + element.sl +  '" value="' + element.total_tpa +  '" readonly  /></td> <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="tpa_recovery_due' + element.sl +  '" id="tpa_recovery_due' + element.sl +  '" value="' + element.tpa_recovery_due +  '" readonly  /></td><td ><textarea  class="form-control" placeholder="Enter Text" name="remarks_tpa' + element.sl +  '" id="remarks_tpa' + element.sl +  '"  >' + element.remarks_tpa +  '</textarea></td> <td ><a href="javascript:void(0);"  id="iop_removec' + element.sl +  '" onClick="remove_iopc_update(' + element.sl +  ',' + element.part_payment_insrt_id +  ');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
				amount_calculate('net_amt' + element.sl, element.sl);
				//calculate_sales();
				$("#due_recieved_date" + element.sl ).datepicker({
					format: 'dd-mm-yyyy'
				});	
				total_rows=element.total_rows;
			});
			
			$("#countiopc").val(total_rows);
				amount_calculate('recovery_amt' + total_rows,total_rows);
					var countiopc=$("#countiopc").val(); 	
					var total_tpa_tot=0;
					for(var i=1;i<=countiopc;i++){		
						var total_tpa=$("#total_tpa"+i).val();
						if ((isNaN(total_tpa)) || (total_tpa == '')) {
							 total_tpa = 0;			 
						}	
						total_tpa_tot=parseFloat(total_tpa_tot)+parseFloat(total_tpa);				
				
					}
					var total_tpa_amt_val=$("#total_tpa_amt_val").val();
					var tpa_recovery_due=parseFloat(total_tpa_amt_val)-parseFloat(total_tpa_tot);
					$("#total_recieved_amt_span").html(total_tpa_tot);
					$("#total_recieved_amt_val").val(total_tpa_tot);
					$("#total_due_amt_span").html(tpa_recovery_due);
					$("#total_due_amt_val").val(tpa_recovery_due);
					amount_calculate('net_amt' + total_rows, total_rows);
					calculate_sales();

			
			}else{
					var new_sl=1;
					 $("#countiopc").val(new_sl);			  
					 $("#iop_tabc").append('<tr id="iopc' + new_sl + '"><td ><input type="text"  autocomplete="off" class="form-control" placeholder="Enter Text" name="accounts_entry_date' + new_sl + '" id="accounts_entry_date' + new_sl + '" value="<?php echo date('d-m-Y'); ?>" readonly /><input type="hidden"  autocomplete="off" class="form-control" placeholder="Enter Text" name="part_payment_flag' + new_sl + '" id="part_payment_flag' + new_sl + '" value="0"   /><input type="hidden"  autocomplete="off" class="form-control" placeholder="Enter Text" name="part_payment_insrt_id' + new_sl + '" id="part_payment_insrt_id' + new_sl + '" value=""   /></td><td ><input type="text"  autocomplete="off" class="form-control" placeholder="Enter Text" name="due_recieved_date' + new_sl + '" id="due_recieved_date' + new_sl + '" value="<?php echo date('d-m-Y'); ?>"  /></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="net_amt' + new_sl + '" id="net_amt' + new_sl + '" value="0" readonly  /></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="recovery_amt' + new_sl + '" id="recovery_amt' + new_sl + '" onKeyUp="replace_value(\'recovery_amt' + new_sl + '\',\'' + new_sl + '\');amount_calculate(\'recovery_amt' + new_sl + '\',\'' + new_sl + '\');calculate_sales();"  value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="tds' + new_sl + '" id="tds' + new_sl + '" onKeyUp="replace_value(\'tds' + new_sl + '\',\'' + new_sl + '\');amount_calculate(\'tds' + new_sl + '\',\'' + new_sl + '\');calculate_sales();"  value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="discount_tpa' + new_sl + '" id="discount_tpa' + new_sl + '" onKeyUp="replace_value(\'discount_tpa' + new_sl + '\',\'' + new_sl + '\');amount_calculate(\'discount_tpa' + new_sl + '\',\'' + new_sl + '\');calculate_sales();"  value="0" ></td><td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="total_tpa' + new_sl + '" id="total_tpa' + new_sl + '" value="0" readonly  /></td> <td ><input type="phone"  autocomplete="off" class="form-control" placeholder="Enter Text" name="tpa_recovery_due' + new_sl + '" id="tpa_recovery_due' + new_sl + '" value="0" readonly  /></td><td ><textarea  class="form-control" placeholder="Enter Text" name="remarks_tpa' + new_sl + '" id="remarks_tpa' + new_sl + '"  ></textarea></td> <td ><a href="javascript:void(0);"  id="iop_removec' + new_sl + '" onClick="remove_iopc(' + new_sl + ');calculate_sales();" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
					 $("#due_recieved_date" + new_sl ).datepicker({
						format: 'dd-mm-yyyy'
					});			
					//calculate_sales();
					amount_calculate('recovery_amt' + new_sl,new_sl);
					var countiopc=$("#countiopc").val(); 	
					var total_tpa_tot=0;
					for(var i=1;i<=countiopc;i++){		
						var total_tpa=$("#total_tpa"+i).val();
						if ((isNaN(total_tpa)) || (total_tpa == '')) {
							 total_tpa = 0;			 
						}	
						total_tpa_tot=parseFloat(total_tpa_tot)+parseFloat(total_tpa);				
				
					}
					var total_tpa_amt_val=$("#total_tpa_amt_val").val();
					var tpa_recovery_due=parseFloat(total_tpa_amt_val)-parseFloat(total_tpa_tot);
					$("#total_recieved_amt_span").html(total_tpa_tot);
					$("#total_recieved_amt_val").val(total_tpa_tot);
					$("#total_due_amt_span").html(tpa_recovery_due);
					$("#total_due_amt_val").val(tpa_recovery_due);
					amount_calculate('net_amt' + new_sl, new_sl);
					calculate_sales();
			}

        }

    });
}




</script> 

<!-- END PAGE CONTAINER --> 
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
