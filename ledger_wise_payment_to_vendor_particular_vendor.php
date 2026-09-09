<?php 
include 'function.php';
include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	// Data Edit
		$payment_date=mysqli_real_escape_string($conn,$_REQUEST['payment_date']);
		$vendor_id=mysqli_real_escape_string($conn,$_REQUEST['vendor_id']);		
		$remarks=mysqli_real_escape_string($conn,$_REQUEST['remarks']);		
		$due_amt=mysqli_real_escape_string($conn,$_REQUEST['due_amt']);
		$amount_to_be_paid=mysqli_real_escape_string($conn,$_REQUEST['amount_to_be_paid']);
		
		/*$discount_purpose=mysqli_real_escape_string($conn,$_REQUEST['discount_purpose']);		
		$discount=mysqli_real_escape_string($conn,$_REQUEST['discount']);*/
		
		$cash=mysqli_real_escape_string($conn,$_REQUEST['cash']);
		$cash_amount=mysqli_real_escape_string($conn,$_REQUEST['cash_amount']);
		$card=mysqli_real_escape_string($conn,$_REQUEST['card']);
		$card_amount=mysqli_real_escape_string($conn,$_REQUEST['card_amount']);
		$upi=mysqli_real_escape_string($conn,$_REQUEST['upi']);
		$upi_amount=mysqli_real_escape_string($conn,$_REQUEST['upi_amount']);		
		$cheque=mysqli_real_escape_string($conn,$_REQUEST['cheque']);
		$cheque_amount=mysqli_real_escape_string($conn,$_REQUEST['cheque_amount']);
		$cheque_no=mysqli_real_escape_string($conn,$_REQUEST['cheque_no']);		
		$neft=mysqli_real_escape_string($conn,$_REQUEST['neft']);
		$neft_amount=mysqli_real_escape_string($conn,$_REQUEST['neft_amount']);
		$neft_no=mysqli_real_escape_string($conn,$_REQUEST['neft_no']);	
			
		$status=mysqli_real_escape_string($conn,$_REQUEST['status']);
		$created_by=mysqli_real_escape_string($conn,$_REQUEST['created_by']);
		$created_on=mysqli_real_escape_string($conn,$_REQUEST['created_on']);
		$opening_bal=mysqli_real_escape_string($conn,$_REQUEST['opening_bal']);
		
		//Financial year Automatically set value by variable
		$curnt_year=date("Y");
		//$curnt_year='2022';
		$next_year=$curnt_year+1;
		$previous_year=$curnt_year-1;
		
		$today_month=date("m");
		//$today_month='03';
		if($today_month<'04'){
			$start_finacial_year=$previous_year."-04-01";
			$end_finacial_year=$curnt_year."-03-31";
		}else{
			$start_finacial_year=$curnt_year."-04-01";
			$end_finacial_year=$next_year."-03-31";
		}
				
		$sql2="SELECT `invo_no` FROM `invoice_ledger_wise_payment_to_vendor` WHERE date(`created_on`) BETWEEN '".$start_finacial_year."' AND '".$end_finacial_year."'  ORDER BY `id` DESC ";
		$result2=$conn->query($sql2) ;	
		$row2 = $result2->fetch_assoc();	
		$max_invo= $row2['invo_no']+1;	
		
		$sql = "INSERT INTO `invoice_ledger_wise_payment_to_vendor` SET  `invo_no`='".$max_invo."', `payment_date`='".$payment_date."',`vendor_id` ='".$vendor_id."',`remarks`='".$remarks."',`due_amt`='".$due_amt."',`amount_to_be_paid`='".$amount_to_be_paid."',`status`='".$status."',`created_by`='".$created_by."',`created_on`='".$created_on."',`opening_bal`='".$opening_bal."'";		
		
		if($conn->query($sql)===TRUE)
		{
			$msg="Record updated successfully";
			$flg=0;		
			$id = $conn->insert_id;	
			
			$p_action='S';
			
			

			if($cash=='Cash')
		    {
				 $sql4 = $conn->query("INSERT INTO `invoice_payment_ledger_wise_payment_to_vendor` SET `i_id` = '".$id."',`p_key` = '".$cash."',`p_value` = '".$cash_amount."',`created_by`='".$created_by."',`created_on`='".$created_on."',`p_action` = '".$p_action."' ");
			}
			if($card=='Card')
		    {
				 $sql4 = $conn->query("INSERT INTO `invoice_payment_ledger_wise_payment_to_vendor` SET `i_id` = '".$id."',`p_key` = '".$card."',`p_value` = '".$card_amount."',`created_by`='".$created_by."',`created_on`='".$created_on."',`p_action` = '".$p_action."'");
			}
			if($upi=='UPI')
		    {
				 $sql4 = $conn->query("INSERT INTO `invoice_payment_ledger_wise_payment_to_vendor` SET `i_id` = '".$id."',`p_key` = '".$upi."',`p_value` = '".$upi_amount."',`created_by`='".$created_by."',`created_on`='".$created_on."',`p_action` = '".$p_action."'");
			}
			if($cheque=='Cheque')
		    {
				 $sql4 = $conn->query("INSERT INTO `invoice_payment_ledger_wise_payment_to_vendor` SET `i_id` = '".$id."',`p_key` = '".$cheque."',`p_value` = '".$cheque_amount."',`created_by`='".$created_by."',`created_on`='".$created_on."',`p_action` = '".$p_action."',`cheque_no`='".$cheque_no."' ");
			}
			if($neft=='NEFT')
		    {
				 $sql4 = $conn->query("INSERT INTO `invoice_payment_ledger_wise_payment_to_vendor` SET `i_id` = '".$id."',`p_key` = '".$neft."',`p_value` = '".$neft_amount."',`created_by`='".$created_by."',`created_on`='".$created_on."',`p_action` = '".$p_action."',`cheque_no`='".$neft_no."' ");
			}
						
			
			$redirectUrl=ADMIN_URL.'ledger_wise_payment_to_vendor_dashboard.php?msg='.$msg.'&flg='.$flg;
			echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
			 $redirectUrl=ADMIN_URL.'ledger_wise_payment_to_vendor_dashboard.php?msg='.$msg.'&flg='.$flg;
			echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

		}

}
?>
<?php include "header.php"; ?>
<link href="select2/select2.css" rel="stylesheet" />
<style>
[data-id="chief"] {
 max-width: 630px !important;
}
#general_instructions_subpackage {
	width: 1030px !important;
}
#s2id_autogen1 {
	width: 180px !important;
}
</style>
<style>
.control-label {
	color: black !important;
	font-weight:bold !important;
}
.portlet-body > label {
	color: black !important;
	font-weight:bold !important;
}
.portlet-body .row {
	background:#dcefff !important;
	font-weight:bold !important;
}
.portlet.light {
	background:#fff !important;
	font-weight:bold !important;
}
.footer-block {
	background: transparent !important;
	font-weight:bold !important;
}
.font-green-sharp {
	color: black !important;
	font-weight:bold !important;
}
.font-black-sharp {
	color: black !important;
	font-weight:bold !important;
}
/*.select2-container {
	width: 280px !important;
}*/
</style>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container">   
  <!-- BEGIN PAGE HEAD -->
  
  <div class="page-head">
    <div class="container-fluid">  
          <!-- BEGIN PAGE TITLE -->      
      <div class="page-title">
        <h1><small>Welcome to EMR Dashboard</small></h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
          <li class="active"> Manage </li>
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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Ledger Wise Payment To Vendor</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div id="reg_div"> 
                
                <!-- BEGIN FORM-->
                <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                  <div class="form-body">
                    <div class="col-md-12">
                      <div class="portlet-body">
                        <div class="row">
                          <input type="hidden" id="created_on" name="created_on" class="form-control" value="<?php echo date('Y-m-d H:i:s');?>">
                          <input type="hidden" id="created_by" name="created_by" class="form-control" value="<?php echo $_SESSION['id'];?>">
                          <input type="hidden" id="status" name="status" class="form-control" value="1">                          
                        </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff;!important; padding:9px 0px">
                     
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Payment Date</label>
                          <input class="form-control form-control-inline date-picker" type="date"  placeholder="Select Date" id="payment_date" name="payment_date" value="<?php echo date("Y-m-d"); ?>"  required />
                        </div>
                      </div>                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Choose Vendor</label>
                          <select class=" form-control select2" name="vendor_id" id="vendor_id" onChange="get_purchase_amt()" required>
                            <?php 
								  $sql7="SELECT * FROM `vendor_master` WHERE `status`='1' AND `id`='".$_REQUEST['vendor_id']."' ORDER BY `vendor_name` ASC ";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" '; if($_REQUEST['vendor_id']==$row7['id']){ echo 'selected';} echo '>'.$row7['vendor_name'].'</option>';

								 }
					 			?>
                          </select>
                        </div>
                      </div> 
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Opening Balance(Due)</label>
                         <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'');get_purchase_amt();" name="opening_bal"  id="opening_bal"  autocomplete="off" placeholder="Enter Amount" class="form-control" value="<?php if($_REQUEST['opening_bal']!=''){ echo $_REQUEST['opening_bal'];}else{ echo '0';}?>" readonly="readonly" />
                        </div>
                      </div>                    
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Remarks</label>
                          <textarea id="remarks" name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <p>&nbsp;</p>
                      </div>
                     
                      
                      <div class="col-md-12" style="text-align:left;font-weight:bold;color:blue;font-size:16px;"><b>Total Due Amount: </b><span id="net_tot" style="color:red;">0</span>
                        <input type="hidden" id="due_amt" name="due_amt" class="form-control" placeholder="Enter Text"  value="0"/>
                      </div>
                      <br />
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label" style="text-align:left;font-weight:bold;color:green !important;font-size:16px;"><br />
                            <b>Total Amount To Be paid: </b></label>
                          <input type="number" id="amount_to_be_paid" name="amount_to_be_paid" class="form-control" placeholder="Enter Total Amount To Be paid" required />
                        </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff; padding:9px 0px">
                      <div class="col-md-2">
                        <label for="nameField"><strong>Payment Mode:</strong></label>
                      </div>
                      <div class="col-md-2">
                        <label class="checkbox-inline">
                          <input type="checkbox" id="cash" name="cash" value="Cash" />
                          <span class="caption-subject font-black-sharp"><strong>Cash</strong></span></label>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" name="cash_amount" id="cash_amount" class="form-control" placeholder="Amount">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff; padding:9px 0px">
                      <div class="col-md-2">
                        <label for="nameField">&nbsp;</label>
                      </div>
                      <div class="col-md-2">
                        <label class="checkbox-inline">
                          <input type="checkbox" id="card" name="card" value="Card">
                          <span class="caption-subject font-black-sharp"><strong>Card</strong></span></label>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" name="card_amount" id="card_amount" class="form-control" placeholder="Amount">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff; padding:9px 0px">
                      <div class="col-md-2">
                        <label for="nameField">&nbsp;</label>
                      </div>
                      <div class="col-md-2">
                        <label class="checkbox-inline">
                          <input type="checkbox" id="upi" name="upi" value="UPI">
                          <span class="caption-subject font-black-sharp"><strong>UPI</strong></span></label>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" name="upi_amount" id="upi_amount" class="form-control" placeholder="Amount">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff; padding:9px 0px">
                      <div class="col-md-2">
                        <label for="nameField">&nbsp;</label>
                      </div>
                      <div class="col-md-2">
                        <label class="checkbox-inline">
                          <input type="checkbox" id="cheque" name="cheque" value="Cheque">
                          <span class="caption-subject font-black-sharp"><strong>Cheque</strong></span></label>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" name="cheque_amount" id="cheque_amount" class="form-control" placeholder="Amount">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="cheque_no" id="cheque_no" class="form-control" placeholder="Enter Cheque No.">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff; padding:9px 0px">
                      <div class="col-md-2">
                        <label for="nameField">&nbsp;</label>
                      </div>
                      <div class="col-md-2">
                        <label class="checkbox-inline">
                          <input type="checkbox" id="neft" name="neft" value="NEFT">
                          <span class="caption-subject font-black-sharp"><strong>NEFT</strong></span></label>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" name="neft_amount" id="neft_amount" class="form-control" placeholder="Amount">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="neft_no" id="neft_no" class="form-control" placeholder="Enter NEFT No.">
                        </div>
                      </div>
                    </div>
                  </div>
                  <p style="padding:12px 0 2px 0; text-align:center;" id="register_para" >                   
                    <button type="button" name="register" id="register" class="btn blue"  >Submit & Print</button>
                    <button type="submit" name="submit" id="submit" class="btn blue" style="display:none;">Submit & Print</button>
                  </p>
                  
                  <!-- 48 hours code-->
                  
                </form>
                <!-- END FORM--> 
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- END EXAMPLE TABLE PORTLET--> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTENT INNER --> 
  
</div>

<!-- END PAGE CONTENT --> 

<!-- END PAGE CONTAINER -->

<?php include "footer.php" ?>
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script src="select2/select2.min.js"></script> 
<script type="text/javascript"> 
get_purchase_amt();
$(document).ready( function() { 
	setTimeout('$("#alert_msg").hide()',3000);
	$("#vendor_id").select2();
	
	
	  $("#register").click(function(){ 
			 //alert("ani");			 
			var  due_amt=$("#due_amt").val(); 
			var flag=0;			
			var vendor_id=$("#vendor_id").val();
			if(vendor_id=='')
			{
				alert("Please Select Vendor");
				$("#vendor_id").focus();
				flag=1;
				$("#vendor_id").css( "border-width", "2px" );
				$("#vendor_id").css( "border-color", "red" );
			}
			var payment_date=$("#payment_date").val();
			if(payment_date=='')
			{
				alert("Please Choose Payment Date");
				$("#payment_date").focus();
				flag=1;
				$("#payment_date").css( "border-width", "2px" );
				$("#payment_date").css( "border-color", "red" );
			}
			
			if(($("#cash_amount").val()=='')&&($("#card_amount").val()=='')&&($("#upi_amount").val()=='')&&($("#cheque_amount").val()=='')&&($("#neft_amount").val()==''))
			{
					alert("Please Enter Payment Amount");
					$("#cash_amount").focus();
					flag=1;
					$("#cash_amount").css( "border-width", "2px" );
					$("#cash_amount").css( "border-color", "red" );
			}
			
			if($("#cash").prop("checked") == true){
				var cash_amount=$("#cash_amount").val();
				if(cash_amount==''){
					alert("Please Enter Cash Amount");
					$("#cash_amount").focus();
					flag=1;
					$("#cash_amount").css( "border-width", "2px" );
					$("#cash_amount").css( "border-color", "red" );
				}
			}
			var cash_amount=$("#cash_amount").val();
			if(cash_amount!=''){
			if($("#cash").prop("checked") == false){				
					alert("Please Tick On Cash Mode");
					$("#cash").focus();
					flag=1;
					$("#cash").css( "border-width", "2px" );
					$("#cash").css( "border-color", "red" );
					$("#cash").css( "background", "red" );
				}
			}
			
			if($("#card").prop("checked") == true){
				var card_amount=$("#card_amount").val();
				if(card_amount==''){
					alert("Please Enter Card Amount");
					$("#card_amount").focus();
					flag=1;
					$("#card_amount").css( "border-width", "2px" );
					$("#card_amount").css( "border-color", "red" );
				}
			}
			var card_amount=$("#card_amount").val();
			if(card_amount!=''){
			if($("#card").prop("checked") == false){				
					alert("Please Tick On Card Mode");
					$("#card").focus();
					flag=1;
					$("#card").css( "border-width", "2px" );
					$("#card").css( "border-color", "red" );
					$("#card").css( "background", "red" );
				}
			}
			
			if($("#upi").prop("checked") == true){
				var upi_amount=$("#upi_amount").val();
				if(upi_amount==''){
					alert("Please Enter UPI Amount");
					$("#upi_amount").focus();
					flag=1;
					$("#upi_amount").css( "border-width", "2px" );
					$("#upi_amount").css( "border-color", "red" );
				}
			}
			var upi_amount=$("#upi_amount").val();
			if(upi_amount!=''){
			if($("#upi").prop("checked") == false){				
					alert("Please Tick On UPI Mode");
					$("#upi").focus();
					flag=1;
					$("#upi").css( "border-width", "2px" );
					$("#upi").css( "border-color", "red" );
					$("#upi").css( "background", "red" );
				}
			}
			
			if($("#cheque").prop("checked") == true){
				var cheque_amount=$("#cheque_amount").val();
				if(cheque_amount==''){
					alert("Please Enter Cheque Amount");
					$("#cheque_amount").focus();
					flag=1;
					$("#cheque_amount").css( "border-width", "2px" );
					$("#cheque_amount").css( "border-color", "red" );
				}
			}
			var cheque_amount=$("#cheque_amount").val();
			if(cheque_amount!=''){
			if($("#cheque").prop("checked") == false){				
					alert("Please Tick On Cheque Mode");
					$("#cheque").focus();
					flag=1;
					$("#cheque").css( "border-width", "2px" );
					$("#cheque").css( "border-color", "red" );
					$("#cheque").css( "background", "red" );
				}
			}
			
			if($("#neft").prop("checked") == true){
				var neft_amount=$("#neft_amount").val();
				if(neft_amount==''){
					alert("Please Enter NEFT Amount");
					$("#neft_amount").focus();
					flag=1;
					$("#neft_amount").css( "border-width", "2px" );
					$("#neft_amount").css( "border-color", "red" );
				}
			}
			var neft_amount=$("#neft_amount").val();
			if(neft_amount!=''){
			if($("#neft").prop("checked") == false){				
					alert("Please Tick On TPA Mode");
					$("#neft").focus();
					flag=1;
					$("#neft").css( "border-width", "2px" );
					$("#neft").css( "border-color", "red" );
					$("#neft").css( "background", "red" );
				}
			}
			
			var amount_to_be_paid=$("#amount_to_be_paid").val();			
			if(parseInt(amount_to_be_paid)>parseInt(due_amt)){
							alert("Payment Amount is greater than Due Amount");
							$("#amount_to_be_paid").focus();
							flag=1;
							$("#amount_to_be_paid").css( "border-width", "2px" );
							$("#amount_to_be_paid").css( "border-color", "red" );
			}
			
			
			 if(($("#cash_amount").val()!='')||($("#card_amount").val()!='')||($("#upi_amount").val()!='')||($("#cheque_amount").val()!='')||($("#neft_amount").val()!=''))
			{
					//alert(total);
					var cash_amount=$("#cash_amount").val();
					if ((isNaN(cash_amount)) || (cash_amount == '')) {
						 cash_amount = 0;
					}					
					var card_amount=$("#card_amount").val();
					if ((isNaN(card_amount)) || (card_amount == '')) {
						 card_amount = 0;
					}
					var upi_amount=$("#upi_amount").val();
					if ((isNaN(upi_amount)) || (upi_amount == '')) {
						 upi_amount = 0;
					}
					var cheque_amount=$("#cheque_amount").val();
					if ((isNaN(cheque_amount)) || (cheque_amount == '')) {
						 cheque_amount = 0;
					}
					var neft_amount=$("#neft_amount").val();
					if ((isNaN(neft_amount)) || (neft_amount == '')) {
						 neft_amount = 0;
					}
					
					
					
					var total_payment=parseFloat(cash_amount)+parseFloat(card_amount)+parseFloat(upi_amount)+parseFloat(cheque_amount)+parseFloat(neft_amount);
					//alert(total);
					//alert(total_payment);	
													
					if((amount_to_be_paid=='')&&(amount_to_be_paid=='0')){
							alert("Please Enter Total Amount To Be paid");
							$("#amount_to_be_paid").focus();
							flag=1;
							$("#amount_to_be_paid").css( "border-width", "2px" );
							$("#amount_to_be_paid").css( "border-color", "red" );
					}
					else{
						if(total_payment>amount_to_be_paid){
							alert("Payment is greater than Payment Amount!");
							$("#cash_amount").focus();
							flag=1;
							$("#cash_amount").css( "border-width", "2px" );
							$("#cash_amount").css( "border-color", "red" );
						}
						if(total_payment<amount_to_be_paid){
							alert("Payment is less than Payment Amount!");
							$("#cash_amount").focus();
							flag=1;
							$("#cash_amount").css( "border-width", "2px" );
							$("#cash_amount").css( "border-color", "red" );
						}	
					}
					
			}
			if(flag==0)
			{
				//alert("success");
				$("#submit"). click();
			}
			
		 });
		 
		 $("#cash").click(function(){
				if($(this).prop("checked") == true){
					var empty='Cash';
					$("#cash").val(empty);
				}
				else if($(this).prop("checked") == false){
					var empty='';
					$("#cash").val(empty);
				}
		 });
		 $("#card").click(function(){
				if($(this).prop("checked") == true){
					var empty='Card';
					$("#card").val(empty);
				}
				else if($(this).prop("checked") == false){
					var empty='';
					$("#card").val(empty);
				}
		 });
		 $("#upi").click(function(){
				if($(this).prop("checked") == true){
					var empty='UPI';
					$("#upi").val(empty);
				}
				else if($(this).prop("checked") == false){
					var empty='';
					$("#upi").val(empty);
				}
		 });
		 $("#cheque").click(function(){
				if($(this).prop("checked") == true){
					var empty='Cheque';
					$("#cheque").val(empty);
				}
				else if($(this).prop("checked") == false){
					var empty='';
					$("#cheque").val(empty);
				}
		 });
		 $("#neft").click(function(){
				if($(this).prop("checked") == true){
					var empty='NEFT';
					$("#neft").val(empty);
				}
				else if($(this).prop("checked") == false){
					var empty='';
					$("#neft").val(empty);
				}
		 });

}); 

function get_purchase_amt(){
	var vendor_id=$("#vendor_id").val();
	if(vendor_id=='')
	{
		alert("Please Select Vendor");
		$("#vendor_id").focus();
		flag=1;
		$("#vendor_id").css( "border-width", "2px" );
		$("#vendor_id").css( "border-color", "red" );
		return false;
	}
	$("#net_tot").html('0');	
	$("#amount_to_be_paid").val('');
	$("#remarks").val('');
	
	var opening_bal=$("#opening_bal").val();
	$.ajax({
            url: 'get_json_data_inventory.php?flag=64',
			type: 'POST',
			dataType: 'json',
			data: "vendor_id="+vendor_id+"&opening_bal="+opening_bal,
			async: false, 
			success: function (data) {				
		 		$("#net_tot").html(data.due_amt);	
				$("#due_amt").val(data.due_amt);			
				
			}
		});

}
</script> 
<!-- END JAVASCRIPTS -->
</body><!-- END BODY -->
</html>