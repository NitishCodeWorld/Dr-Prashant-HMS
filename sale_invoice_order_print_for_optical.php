<?php include("conn.php"); /*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/
function numberTowords($num)
	{ 
		if($num==0){
			$ones = array( 
		0 => "zero");
		}else{
		$ones = array( 
		0 => "",
		1 => "one", 
		2 => "two", 
		3 => "three", 
		4 => "four", 
		5 => "five", 
		6 => "six", 
		7 => "seven", 
		8 => "eight", 
		9 => "nine", 
		10 => "ten", 
		11 => "eleven", 
		12 => "twelve", 
		13 => "thirteen", 
		14 => "fourteen", 
		15 => "fifteen", 
		16 => "sixteen", 
		17 => "seventeen", 
		18 => "eighteen", 
		19 => "nineteen" 
		); 
		}
		$tens = array(
		0 => "", 
		1 => "ten",
		2 => "twenty", 
		3 => "thirty", 
		4 => "forty", 
		5 => "fifty", 
		6 => "sixty", 
		7 => "seventy", 
		8 => "eighty", 
		9 => "ninety" 
		); 
		$hundreds = array( 
		"hundred", 
		"thousand", 
		"million", 
		"billion", 
		"trillion", 
		"quadrillion" 
		); //limit t quadrillion 
		$num = number_format($num,2,".",","); 
		$num_arr = explode(".",$num); 
		$wholenum = $num_arr[0]; 
		$decnum = $num_arr[1]; 
		$whole_arr = array_reverse(explode(",",$wholenum)); 
		krsort($whole_arr); 
		$rettxt = ""; 
		foreach($whole_arr as $key => $i){ 
		//$i=intval($i);
		if($i < 20){ 
		$rettxt .= $ones[intval($i)]; 
		}elseif($i < 100){ 
			if(substr($i,0,1)=="0"){
			 $rettxt .= $tens[substr($i,1,1)];
			 $rettxt .= " ".$ones[substr($i,2,1)]; 
			}else{
			 $rettxt .= $tens[substr($i,0,1)];
			 $rettxt .= " ".$ones[substr($i,1,1)]; 
			} 
		}else{ 
		$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
		$rettxt .= " ".$tens[substr($i,1,1)]; 
		$rettxt .= " ".$ones[substr($i,2,1)]; 
		} 
		if($key > 0){ 
		$rettxt .= " ".$hundreds[$key]." "; 
		} 
		} 
		if($decnum > 0){ 
		$rettxt .= " and "; 
		if($decnum < 20){ 
		$rettxt .= $ones[$decnum]; 
		}elseif($decnum < 100){ 
		$rettxt .= $tens[substr($decnum,0,1)]; 
		$rettxt .= " ".$ones[substr($decnum,1,1)]; 
		} 
		} 
		return $rettxt; 
}
?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Sale Order Invoice</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/admin/pages/css/invoice.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<style>
@media print {
.print_size {
	font-size:19px !important;/*margin-top:-5px !important;*/
}
p {
	margin: 0 0 -15px;
}
.well {
	padding: 6px;
	padding-left: 5px !important;
}
.sticker_rec {
	font-size:15px !important;
}
.invoice table {
/*margin: 22px 0 18px 0;*/
}
.invoice1 {
	page-break-after: always;
}
.mode_table{
	border:none;
}
}
</style>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body style="font-family: Georgia, serif;">
<!-- BEGIN HEADER -->
<div class="page-container">
  <div class="page-content">
    <div class="container">
      <div class="portlet light">
        <div class="portlet-body">
          <div class="invoice<?php echo $i?>">
            <?php
		  $inv_id=$_GET['inv_id'];
			//$purch_invoice=(isset($_GET['purch_flag'])) ? $_GET['purch_flag'] : "0" ;
			$purch_invoice=0 ;
			
			if($purch_invoice=="0")$sql="select sales_order_for_optical.*,sales_order_for_optical.status as `status_`,`user_infos`.`name` as `user_name` from sales_order_for_optical left join user_infos on sales_order_for_optical.user_id=user_infos.users_id  where sales_order_for_optical.id='".$inv_id."'";
			else if($purch_invoice=="1") $sql="select purchase.*,vendor_master.* from purchase left join vendor_master on vendor_master.id=purchase.vendor_id where purchase.id='".$inv_id."' "; 
			$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
			
			//$sql_mode="select * from payment_mode where pharma_invoice_id='".$inv_id."' AND `amount`<>'0' order by id desc limit 0,1";
			$sql_mode="select * from payment_mode_for_optical where sales_order_id='".$inv_id."' AND `amount`<>'0' order by id desc";
						$res_mode=mysqli_query($conn,$sql_mode) or die(mysqli_error($conn));
						$mode="";
						while($row_mode=mysqli_fetch_assoc($res_mode)){
							if($row_mode['amount']>0) $mode=$mode."<tr><th style='text-align:center;'>".$row_mode['mode']."</th><th style='text-align:center;'>&#8377;".round($row_mode['amount']).'</th><th style="text-align:center;">'.date('d-m-Y',strtotime($row_mode['created_on'])).'</th></tr>'; 
						}
			while($row=mysqli_fetch_assoc($res)){
				$total_amount=$row['amount'];
				$customer_name=$row['customer_name'];
				$uhid=$row['uhid'];
				$phone_number=$row['phone_number'];
				$total_cgst=$row['cgst_amount'];
				$total_sgst=$row['sgst_amount'];
				$status=$row['status_'];
				$order_number=$row['order_number'];
				$gst_no=$row['gst_no'];$dl_number=$row['dl_number'];
				$address=$row['address_'];
				$date=$row['date'];
				$user_name=$row['user_name'];
			}
		  ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="print_size">
            	<?php 
				$sql_hos_info="select * from hospital_info_masters"; 
				$res_hos_info=mysqli_query($conn,$sql_hos_info);
				$row_hos_info=mysqli_fetch_assoc($res_hos_info);
				?>
              <tr>
                <th height="116"  colspan="3" style="text-align:center" scope="col"><!--<img src="img/logo.png" />--><strong style="font-size:20px;"><?php echo $row_hos_info['hospital_name'];?></strong><br>
                  <?php echo $row_hos_info['address'];?><br>
                  GSTIN : <?php echo $row_hos_info['gst_in'];?><br>
                  Mobile No.: <?php echo $row_hos_info['phone'];?><br>
                  e-mail : <?php echo $row_hos_info['email'];?><br>
                  Website : <?php echo $row_hos_info['website'];?></th>
              </tr>
              <tr>
                <td width="42%" style="vertical-align:top !important"><strong>Bill To</strong> <br>
                  <?php echo '<strong>UHID - </strong>'.$uhid.'<br>'.'<strong>Customer Name -</strong>'.$customer_name;?></td>
                <td width="17%" style="text-align:center; vertical-align:top !important"><?php if($purch_invoice=="0"){ ?>
                  <h4 class="print_size"><strong>TAX INVOICE</strong></h4>
                  <h5 class="print_size">Optical</h5>
                  <?php }else if($purch_invoice=="1"){ ?>
                  <h5 class="print_size">Purchase</h5>
                  <?php } ?></td>
                <td width="41%" style="vertical-align:top !important"><table width="100%" class="table table-bordered">
                    <tr style="text-align:center">
                      <th width="61%" scope="row"><strong>Invoice Date:</strong></th>
                      <td width="39%"><strong><?php echo date("d-m-Y",strtotime($date));  ?></strong></td>
                    </tr>
                    <tr style="text-align:center">
                      <th scope="row"><strong>Invoice Number:</strong></th>
                      <td><strong><?php echo $order_number;  ?></strong></td>
                    </tr>
                    <tr>
                      <th colspan="2" style="text-align:center">Payment Terms</th>
                    </tr>
                    <tr>
                      <th colspan="2" style="text-align:center">Within 30 days due net</th>
                    </tr>
                    <tr style="text-align:center">
                      <th scope="row">Due Date</th>
                      <td><?php echo date("d-m-Y",strtotime('+30 days',strtotime($date)));  ?></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <th colspan="4" scope="row"> <table class="table table-striped table-bordered table-hover" width="100%" id="main_body">
                    <thead>
                      <tr style="text-align:center">
                        <td>Item Name</td>
                        <td>HSN Code</td>
                        <td>Batch No</td>
                        <td>ExpDt</td>
                        <td>Qty</td>
                        <td>MRP</td>
                        <td>Rate</td>
                        <td>Discount(%)</td>
                        <td>Discount Amount</td>
                        <td>GST(%)</td>
                        <td>Amount</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
							$mrp_total=0;
							 if($purch_invoice=="0"){ 
								$sql="select sd.*,sd.qty as `quanitity`,pm.* from sales_order_details_for_optical as sd inner join item_master_for_optical as pm on sd.item_id=pm.id where sd.sales_id='".$inv_id."'";
							}else if($purch_invoice=="1"){
								$sql="select sd.*,sd.qty as `quanitity`,pm.* from purchase_details as sd inner join item_master as pm on sd.item_id=pm.id where sd.purchase_id='".$inv_id."'";						
							}
							
							$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
							$sl=1;
							$total_discount_amount=0;
							while($row_=mysqli_fetch_assoc($res)){
								$amount=$row_['rate']*$row_['quanitity'];
								$amount_after_disc=$amount-$row_['disc_amount'];
								$net_amount_after_tax_and_discount=$amount_after_disc+$row_['gst_amount'];
								$cgst_rate=$row_['cgst_rate'];
								$sgst_rate=$row_['sgst_rate'];
								$free_flag=($row_["purchase_order_id"]=="0") ? "free" : "";
								$total_discount_amount+=$row_['disc_amount'];
								$total_tax_amount+=$net_amount_after_tax_and_discount;
								//$mrp=(($row_['rate']*$row_['gst_rate'])/100)+$row_['rate'];
							?>
                      <tr>
                        <td class="text-center"><?php echo strip_tags($row_['item_name']); ?></td>
                        <td class="text-center"><?php echo strip_tags($row_['hsm_code']); ?></td>
                        <td class="text-center"><?php echo $row_['batch_no']; ?></td>
                        <td class="text-center"><?php echo date('m/y',strtotime($row_['expiry_date'])); ?></td>
                        <td class="text-center"><?php echo $row_['quanitity']; ?></td>
                        <td class="text-center"><?php echo $row_['mrp']; ?></td>
                        <td class="text-center"><?php echo $row_['rate']; ?></td>
                        <td class="text-center"><?php echo $row_['disc_rate']; ?></td>
                        <td class="text-center"><?php echo $row_['disc_amount']; ?></td>
                        <td class="text-center"><?php echo $row_['gst_rate']; ?></td>
                        <td class="text-center"><?php echo $amount_after_disc; $mrp_total=$mrp_total+$amount_after_disc; ?></td>
                      </tr>
                      <?php $sl++; }  ?>
                    </tbody>
                    <tfoot>
                      <tr style="font-weight:bold">
                        <th colspan="9" style="text-align:right">Taxable Amount:</th>
                        <th style="border-right:none;"></th>
                        <th style="text-align:center;width:16%">&#8377;<span id="footer_total"><?php echo number_format($mrp_total,2); ?></span></th>
                      </tr>
                      <tr style="font-weight:bold">
                        <th colspan="9" style="text-align:right">Add CGST:</th>
                        <th style="border-right:none;"></th>
                        <th style="text-align:center;width:16%">&#8377;<span id="footer_total"><?php echo number_format($total_cgst,2); ?></span></th>
                      </tr>
                      <tr style="font-weight:bold">
                        <th colspan="9" style="text-align:right">Add SGST:</th>
                        <th style="border-right:none;"></th>
                        <th style="text-align:center;width:16%">&#8377;<span id="footer_total"><?php echo number_format($total_sgst,2); ?></span></th>
                      </tr>
                      <tr style="font-weight:bold">
                        <th colspan="9" style="text-align:right">Net Amount:</th>
                        <th style="border-right:none;"></th>
                        <th style="text-align:center;width:16%">&#8377;<span id="footer_total"><?php echo number_format($total_amount,2);; ?></span></th>
                      </tr>
                    </tfoot>
                  </table>
                </th>
              </tr>
            </table>
            <p class="print_size"> <strong>Amount In Words:</strong> Rupees <?php echo ucwords(numberTowords($total_amount)); ?> Only <br/>
              <label><b class="print_size">Payment Mode:</b></label>
              <table class="print_size table-striped table-bordered table-hover" id="mode_table" style="margin:0;width:28%;">
              <?php echo $mode;  ?>
              </table>
              </b></p>
            <br/>
            <div class="row">
              <div class="col-xs-6">
                <div class="well print_size">
                  <address class="">
                  E & O E
                  For <?php echo $row_hos_info['hospital_name']?><br>
                  <?php if($total_discount_amount>0)?>
                  You saved : &#8377;<?php echo number_format($total_discount_amount,2); ?> <br>
                  <small>User: <?php echo $user_name; ?></small> <br>
                  Goods once sold cannot be returned
                  </address>
                </div>
              </div>
              <div class="col-xs-6 invoice-block print_size text-right">
                <ul class="list-unstyled amounts ">
                  <li> <strong class="" style="font-size:19px">Grand Total:</strong><strong style="font-size:19px"> &#8377;<?php echo $total_amount; ?></strong> </li>
                </ul>
                <br/>
                <?php  if($status=="0"){ ?>
                <button class="btn green hidden-print" type="button" onClick="restore_bill()">Restore &nbsp; <i class="fa fa-undo"></i></button>
                <?php }else{ ?>
                <button class="btn red hidden-print" type="button" onClick="cancel_bill()">Cancel Bill &nbsp; <i class="fa fa-close"></i></button>
                <?php } ?>
                <button class="btn green hidden-print" type="button" onClick="window.print();">Print <i class="fa fa-print"></i></button>
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
<!-- END PAGE CONTAINER --> 
<!-- BEGIN PRE-FOOTER --> 
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script> 
<script>
/*function cancel_bill(){
	
	let inv_id='<?php echo $inv_id; ?>';
	if(!confirm("Are you sure you want to cancel this bill?")) return false;
	
	$.ajax({
            url: 'get_json_data.php?flag=51',
			type: 'POST',
			dataType: 'json',
			data: "inv_id="+inv_id+"&status=0",
			async: false, 
			success: function (data) {			
		 		
				//alert(data.closing_stock);
				if(data.flag=="1") alert("Bill Successfully cancelled");
				else alert("Unable to cancel bill");
				
				location.reload();
				window.opener.load_sales();
				
			}
		});
}*/
</script>
</body>
<!-- END BODY -->
</html>