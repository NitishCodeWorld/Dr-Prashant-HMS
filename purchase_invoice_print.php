<?php
include "conn.php"; // Using database connection file here
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
<?php /*include "header_inventory.php"; */?>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Invoice</title>
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
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
<!-- BEGIN HEADER -->
<div class="page-container">
  <div class="page-content">
    <div class="container"> 
      <!-- END PAGE BREADCRUMB --> 
      <!-- BEGIN PAGE CONTENT INNER -->
      <?php 
 	
 	$inv_id=$_GET['inv_id'];
	//$purch_invoice=(isset($_GET['purch_flag'])) ? $_GET['purch_flag'] : "0" ;
	$purch_invoice=1 ;
	if($purch_invoice=="0") $sql="select sales_invoice.*,customers_master.* from sales_invoice left join customers_master on customers_master.id=sales_invoice.customer_id where sales_invoice.id='".$inv_id."'";
	else if($purch_invoice=="1") $sql="select purchase.*,vendor_master.* from purchase left join vendor_master on vendor_master.id=purchase.vendor_id where purchase.id='".$inv_id."' "; 
	$res=mysqli_query($conn,$sql);
	
 
 ?>
      <?php
								
		while($row=mysqli_fetch_assoc($res)){
				$total_amount=$row['amount'];
				$total_cgst=$row['cgst_amount'];
				$total_sgst=$row['sgst_amount'];
				$grand_net_total_=$row['grand_net_total_'];
				
 ?>
      <div class="portlet light">
        <div class="portlet-body">
          <div class="invoice">
            <div class="row invoice-logo">
              <div class="col-xs-3 invoice-logo-space">
                <ul class="list-unstyled">
                  <li><b>PARIJAT SEVALAY (P) Ltd.</b></li>
                  <li>SHYAMSAYER (N) * POWER HOUSE MORE * BURDWAN</li>
                  <li>GSTIN : 19AALCS3328P1ZM</li>
                  <li>Mobile No.: 9434214103 / 9775470555</li>
                  <li>e-mail : parijatsevalaya@gmail.com, website : www.parijatsevalay.com</li>
                </ul>
              </div>
              <div class="col-xs-3">
                <label>PI Number:</label>
                <br/>
                <b><?php echo $row['order_number'];  ?></b><br/>
                <br/>
                <label>Supplier Invoice No:</label>
                <br/>
                <b><?php echo $row['supplier_invoice_no'];  ?></b> </div>
              <div  class="col-xs-2">
                <label>Date:</label>
                <br/>
                <b><?php echo date("d-m-Y",strtotime($row['date']));  ?></b> <br/>
                <br/>
                <label>Purchase Bill Date:</label>
                <br/>
                <b><?php echo date("d-m-Y",strtotime($row['purchase_bill_date']));  ?></b> </div>
              <div class="col-xs-4">
                <?php if($purch_invoice=="0"){ ?>
                <h4>PROFORMA INVOICE</h4>
                <?php }else if($purch_invoice=="1"){ ?>
                <h3>Purchase</h3>
                <?php } ?>
              </div>
            </div>
            <hr/>
            <div class="row">
              <div class="col-xs-4">
                <?php if($purch_invoice=="0"){ ?>
                <h3>Customer:</h3>
                <?php }else if($purch_invoice=="1"){ ?>
                <h3>Vendor:</h3>
                <?php } ?>
                <ul class="list-unstyled">
                  <li> <?php echo $row['vendor_name']; ?> </li>
                  <li> <?php echo $row['address']; ?> </li>
                  <li> <?php echo $row['phone']; ?> </li>
                  <li> <?php echo $row['email']; ?> </li>
                  <li> GST:<?php echo $row['gst']; ?> </li>
                  <?php
										}
									?>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table class="table table-striped table-hover" style="margin-bottom:0px" id="main_body">
                  <thead>
                    <tr>
                      <th class="hidden-380" style="text-align:center"> Sn </th>
                      <th class="hidden-380" style="text-align:center"> HSN Code </th>
                      <th class="hidden-380" style="text-align:center"> Item Name </th>
                      <th class="hidden-380" style="text-align:center"> Qty </th>
                      <th class="hidden-380" style="text-align:center"> Rate </th>
                      <th class="hidden-380" style="text-align:center"> Disc Rate </th>
                      <th class="hidden-380" style="text-align:center"> Disc Amount </th>
                      <th class="hidden-380" style="text-align:center"> Total </th>
                      <th class="hidden-380" style="text-align:center"> GST Rate </th>
                      <th class="hidden-380" style="text-align:center"> GST Amount </th>
                      <th class="hidden-380" style="text-align:center"> CGST Rate </th>
                      <th class="hidden-380" style="text-align:center"> CGST Amount </th>
                      <th class="hidden-380" style="text-align:center"> SGST Rate </th>
                      <th class="hidden-380" style="text-align:center"> SGST Amount </th>
                      <th class="hidden-380" style="text-align:center"> Net Total </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
									$mrp_total=0;
									 if($purch_invoice=="0"){ 
										$sql="select sd.*,sd.qty as `quanitity`,pm.* from sales_invoice_details as sd inner join products_master as pm on sd.product_id=pm.id where sd.sales_invoice_id='".$inv_id."'";
									}else if($purch_invoice=="1"){
										$sql="select sd.*,sd.qty as `quanitity`,pm.* from purchase_details as sd inner join item_master as pm on sd.item_id=pm.id where sd.purchase_id='".$inv_id."'";						
									}
									
									$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
									$sl=1;
									while($row_=mysqli_fetch_assoc($res)){
										$amount=$row_['rate']*$row_['quanitity'];
										$amount_after_disc=$amount-$row_['disc_amount'];
										$net_amount_after_tax_and_discount=$amount_after_disc+$row_['gst_amount'];
										$cgst_rate=$row_['cgst_rate'];
										$sgst_rate=$row_['sgst_rate'];
										//$free_flag=($row_["purchase_order_id"]=="0") ? "free" : "";
										$free_flag=($row_["purchase_order_id"]=="0") ? "" : "";
									?>
                    <tr style="text-align:center">
                      <td><?php echo $sl; ?></td>
                      <td><?php echo $row_['hsm_code']; ?><br>
                        <?php echo $free_flag; ?></td>
                      <td><?php echo strip_tags($row_['item_name']); ?> ( <?php echo $row_['batch_no']; ?> <?php echo ($row_['expiry_date']=="0000-00-00") ? "" : "Expiry Date: ".date("d-m-y",strtotime($row_['expiry_date'])); ?> <?php echo ($row_['manufacturing_date']=="0000-00-00" || $row_['manufacturing_date']=="1970-01-01") ? "" : "Mfg Date: ".date("d-m-y",strtotime($row_['manufacturing_date'])); ?> )</td>
                      <td><?php echo $row_['quanitity']; ?></td>
                      <td><?php echo $row_['rate']; ?></td>
                      <td><?php echo $row_['disc_rate']; ?></td>
                      <td><?php echo $row_['disc_amount']; ?></td>
                      <td><?php echo $amount_after_disc; $mrp_total=$mrp_total+$amount_after_disc; ?></td>
                      <td><?php echo $row_['gst_rate']; ?></td>
                      <td><?php echo $row_['gst_amount']; ?></td>
                      <td><?php echo $row_['cgst_rate']; ?></td>
                      <td><?php echo $row_['cgst_amount']; ?></td>
                      <td><?php echo $row_['sgst_rate']; ?></td>
                      <td><?php echo $row_['sgst_amount']; ?></td>
                      <td><?php echo $net_amount_after_tax_and_discount; ?></td>
                    </tr>
                    <?php
										$sl++;
									}
									
									 ?>
                  </tbody>
                  <tfoot>
                    <tr style="font-weight:bold">
                      <th colspan="7" style="text-align:right">Total:</th>
                      <th style="text-align:center;width:16%">&#8377;<span id="footer_total"><?php echo $mrp_total ?></span></th>
                    </tr>
                    <tr style="font-weight:bold">
                      <th colspan="7" style="text-align:right">Add CGST:</th>
                      <th style="text-align:center;width:16%">&#8377;<span id="footer_total"><?php echo $total_cgst; ?></span></th>
                    </tr>
                    <tr style="font-weight:bold">
                      <th colspan="7" style="text-align:right">Add SGST:</th>
                      <th style="text-align:center;width:16%">&#8377;<span id="footer_total"><?php echo $total_sgst; ?></span></th>
                    </tr>
                    <tr style="font-weight:bold">
                      <th colspan="7" style="text-align:right">Net Total:</th>
                      <th style="text-align:center;width:16%">&#8377;<span id="footer_total"><?php echo $total_amount; ?></span></th>
                    </tr>
                    <tr style="font-weight:bold">
                      <th colspan="7" style="text-align:right">After Adjust Net Total:</th>
                      <th style="text-align:center;width:16%">&#8377;<span id="footer_total"><?php echo $grand_net_total_ ; ?></span></th>
                    </tr>
                  </tfoot>
                </table>
                Rupees <?php echo ucwords(numberTowords($total_amount)); ?> Only </div>
            </div>
            <div class="row">
              <div class="col-xs-4">
                <div class="well">
                  <address>
                  E & O E
                  For PARIJAT SEVALAY (P) Ltd.
                  </address>
                </div>
              </div>
              <div class="col-xs-8 invoice-block">
                <ul class="list-unstyled amounts">
                  <!--<li>
										<strong>Sub - Total amount:</strong> $9265
									</li>--> 
                  <!--<li>
										<strong>Discount:</strong> 12.9%
									</li>--> 
                  <!--<li>
										<strong>VAT:</strong> -----
									</li>-->
                  <li> <strong>Grand Total:</strong> &#8377;<?php echo $grand_net_total_; ?> </li>
                </ul>
                <br/>
                <ul>
                  <li></li>
                </ul>
                <br/>
                <button class="btn green hidden-print" type="button" onClick="window.print();">Print <i class="fa fa-print"></i></button>
                <!--<a class="btn btn-lg blue hidden-print margin-bottom-5" onClick="javascript:window.print();">
								Print <i class="fa fa-print"></i>
								</a>
								<a class="btn btn-lg green hidden-print margin-bottom-5">
								Submit Your Invoice <i class="fa fa-check"></i>
								</a>--> 
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
</body>
<!-- END BODY -->
</html>