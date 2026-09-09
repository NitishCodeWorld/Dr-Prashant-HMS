<?php
include 'function.php'; 
include "conn.php"; 	
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD --><head>
<meta charset="utf-8">
<title>MedBill</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico">
</head>

<style>

html {
	font-family: arial;
}
body {
	font-size:8pt;
	font-family: arial;
}
h5 {
	padding-left: 15px;
	font-size: 12px;
	font-weight: bold;
}
.ot td {
	font-size:7pt !important;
	padding: 2px;
	width: 10%;
	border: none;
	text-align: left;
}
.ot th {
	text-align:center;
	/*border: 1px solid #e1e1e1;*/
	padding: 1px 0px;
	background:#f1f1f1;
}
.ot td .form-control {
	background-color: transparent;
	border: none;
}
.ott td {
	padding: 4px 4px 0 4px;
}
th {
	text-align:left !important;
	border-top:1px dashed #333 !important;
	/*border-bottom:1px dashed #333 !important;*/
	border-left:none !important;
	border-right:none !important;
	background: #FFF !important;
}
.title {
	text-align:left;
	border-bottom:0;
	padding:10px;
	text-transform:uppercase;
}
</style>
<body>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
  <div class="page-content">
    <div class="container-fluid">
      <?php $split_flag=0;
	  ?>
      <div class="row">
        <div class="col-md-12">
          <?php 
		$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
	$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
		$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);
 	
 	$inv_id=$_GET['inv_id'];
	//$purch_invoice=(isset($_GET['purch_flag'])) ? $_GET['purch_flag'] : "0" ;
	$purch_invoice=0 ;
	if($purch_invoice=="0") $sql="select pharma_invoice_return.*,customer_master_return.*,pharma_invoice_return.status as `status_` from pharma_invoice_return left join customer_master_return on customer_master_return.id=pharma_invoice_return.customer_id where pharma_invoice_return.id='".$inv_id."'";
	
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
	$sql_mode="select * from `payment_mode` where pharma_invoice_id='".$inv_id."' AND `medicine_return_flag`='1' ";
	$res_mode=mysqli_query($conn,$sql_mode) or die(mysqli_error($conn));
	$mode="";
	$cash_patient=0;
	while($row_mode=mysqli_fetch_assoc($res_mode)){
		
		if($row_mode['amount']>0) { echo  $mode=$mode." ".$row_mode['mode'].": &#8377;".$row_mode['amount']; 
		$cash_patient=1;
		}
		
		
	}

		$row=mysqli_fetch_assoc($res);						
		
				$total_amount=$row['amount'];
				$total_cgst=$row['cgst_amount'];
				$total_sgst=$row['sgst_amount'];
				$status=$row['status_'];
				
 ?>
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title" style="text-align:center !important; margin-top:-9px; padding-bottom:9px; margin-bottom:0"> <span class="portlet-title" style="text-align:center !important; padding-bottom:9px"><span class="portlet-title" style="text-align:center !important; padding-bottom:9px"><strong style="font-size:12pt !important"><?php echo $row_hospital_info['hospital_name'];  ?></strong><br>
              <strong style="font-size:8pt !important"><?php echo $row_hospital_info['hospital_unit'];  ?></strong><br/>
              <?php echo $row_hospital_info['address'];  ?>,Phone: <?php echo $row_hospital_info['phone'];  ?></span></span><br/><br/>
              <center><strong style="font-size:10pt !important;text-decoration:underline;"><?php if($row['status_'] == 4){ echo "PROFORMA INVOICE CUM ADVANCE RECEIPT ( MEDICINE LIST FOR RETURN )";}else if($row['status_'] == 2){ echo "FULL DUE BILL ( MEDICINE LIST FOR RETURN )"; }else { echo "BILL CUM MONEY RECEIPT ( MEDICINE LIST FOR RETURN )";}  ?></strong></center>
              </div>
            
            <!-- BEGIN FORM-->
            <div class="form-body">
              <div class="row">
                <div class="col-md-12" style="padding-bottom:4px">
                  <table class="ott" style="width:100%" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                      <td colspan="2">GST IN: <strong><?php echo $row_hospital_info['gst_in'];  ?></strong></td>
                      <td width="57%"  style="padding-left:130px;" colspan="2">DRUG LICENCE NO.: <strong><?php echo $row_hospital_info['drug_licence'];  ?></strong></td>
                    </tr>
                    <tr>
                      <td colspan="2" style="line-height:14px !important"><strong>Party Details:</strong>
                        <?php if($cash_patient==1) echo 'Cash'; ?>
                        <br>
                        <strong>Admit Date:</strong> <br>
                        <strong>Discharge Date:</strong><br>
                        <strong>Ref. Doctors:</strong> Dr. S. Sau</td>
                      <td colspan="2" style="line-height:14px !important;padding-left:130px;"><strong>Invoice No:</strong><?php echo $row['order_number'];  ?><br>
                        <strong>Dated:</strong> <?php echo date("d-m-Y",strtotime($row['date']));  ?><br>
                        <strong>Patient Name:</strong> <?php echo $row['vendor_name']; ?><br>
                        <strong>Patient Address/Mob:</strong> <?php echo $row['phone']; ?></td>
                    </tr>
                    
                    <!-------------------------row end--------------------->
                    
                  </table>
                </div>
                <!-------------------------field end---------------------> 
              </div>
              <!--<div class="portlet-title" style="border-top:1px dashed #333; padding-top:0; height:1px !important">&nbsp;</div>-->
              <div class="row">
                <div class="col-md-12">
                  <table class="ot" style="width:100%" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                      <th width="4%">S.N.</th>
                      <th width="27%"><strong>Description of Goods</strong></th>
                      <th width="8%"><strong>HSN</strong></th>
                      <th width="8%" style="text-align:right !important; padding-right:19px;"><strong>Qty. Unit</strong></th>
                      <th width="8%" style="text-align:right !important; padding-right:19px;"><strong>Price</strong></th>
                      <th width="8%" style="text-align:right !important; padding-right:19px;"><strong>GST%</strong></th>
                      <th width="8%"><strong>Batch No.</strong></th>
                      <th width="8%"><strong>Exp. date</strong></th>
                      <th width="21%" style="text-align:right !important; padding-right:19px;">Amount (Rs.)</th>
                    </tr>
                    <?php
									$mrp_total=0;
									 if($purch_invoice=="0"){ 
										$sql="select sd.*,sd.qty as `quanitity`,pm.*,`unit_master`.`unit_name` from pharma_invoice_details_return as sd inner join item_master as pm on sd.item_id=pm.id  LEFT JOIN `unit_master` ON `unit_master`.`id`=`pm`.`unit_id` where sd.sales_id='".$inv_id."'";
									}
									
									$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
									$sl=1;
									$total_discount_amount=0;
									$amt_total=0;
									$gst_percen=0;	
									$gst_percen_total=0;									
									while($row_=mysqli_fetch_assoc($res)){
										$amount=$row_['rate']*$row_['quanitity'];
										$amount_after_disc=$amount-$row_['disc_amount'];
										$net_amount_after_tax_and_discount=$amount_after_disc+$row_['gst_amount'];
										$cgst_rate=$row_['cgst_rate'];
										$sgst_rate=$row_['sgst_rate'];
										$free_flag=($row_["purchase_order_id"]=="0") ? "free" : "";
										$total_discount_amount+=$row_['disc_amount'];
										$amt_total=$amt_total+$row_['total'];	
										$gst_percen=$gst_percen+$row_['gst_rate'];
										$gst_percen_total=$gst_percen_total+$row_['gst_amount'];
									?>
                    <tr>
                      <td width="4%"><?php echo $sl; ?>.</td>
                      <td width="27%"><?php echo strip_tags($row_['item_name']); ?></td>
                      <td width="8%"><?php echo $row_['hsm_code']; ?><br>
                        <?php echo $free_flag; ?></td>
                      <td width="8%" style="text-align:right !important; padding-right:19px;"><?php echo $row_['quanitity'].' '.$row_['unit_name']; ?></td>
                      <td width="8%"style="text-align:right !important; padding-right:19px;"><?php echo $row_['rate']; ?></td>
                      <td width="8%" style="text-align:right !important; padding-right:19px;"><?php echo $row_['gst_rate']; ?>%</td>
                      <td width="8%"><?php echo $row_['batch_no']; ?></td>
                      <td width="8%"><?php echo ($row_['expiry_date']=="0000-00-00" || $row_['expiry_date']=="1970-01-01") ? "" : date("M'Y",strtotime($row_['expiry_date'])); ?></td>
                      <td width="21%" style="text-align:right !important; padding-right:19px;"><?php echo $net_amount_after_tax_and_discount; ?></td>
                    </tr>
                    <?php
										$sl++;
									}
									
									 ?>
                    
                    <!-------------------------row end--------------------->
                  </table>
                  <table class="ot" style="width:100%" cellpadding="0" cellspacing="0" align="center">
                    <?php if(($row['discount_type']=='P')||($row['discount_type']=='F')){ ?>
                    <tr>
                      <td width="11%">&nbsp;</td>
                      <td width="11%">&nbsp;</td>
                      <td width="11%">&nbsp;</td>
                      <td width="11%">&nbsp;</td>
                      <td width="11%">&nbsp;</td>
                      <td width="7%">&nbsp;</td>
                      <td width="16%">Less: <strong>Discount</strong></td>
                      <td width="11%" style="text-align:right !important; padding-right:19px;">@
                        <?php if($row['discount_type']=='P'){ echo $row['discount_val'].'%'; }  if($row['discount_type']=='F'){ echo $row['discount_val']; }?></td>
                      <td width="11%" style="text-align:right !important; padding-right:19px;"><strong><?php echo $row['discount_total'] ?></strong></td>
                    </tr>
                    <tr>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="7%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="16%" style="border-top:1px dashed #333 !important;text-align:right !important;" colspan="2"><strong>Net Total:</strong></td>
                      <td width="11%" style="text-align:right !important; padding-right:19px;border-top:1px dashed #333 !important"><strong><?php echo $row['discount_total'] ?></strong></td>
                    </tr>
                    <?php }else{  ?>
                    <tr>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="11%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="7%" style="border-top:1px dashed #333 !important">&nbsp;</td>
                      <td width="16%" style="border-top:1px dashed #333 !important;text-align:right !important;" colspan="2"><strong>Net Total:</strong></td>
                      <td width="11%" style="text-align:right !important; padding-right:19px;border-top:1px dashed #333 !important"><strong><?php echo $row['amount'] ?></strong></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:center;border-left:1px solid #333 !important;"><strong>Taxable <br>
                        </strong></td>
                      <td colspan="2" style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:center"><strong>Central Tax (CGST)</strong></td>
                      <td colspan="2" style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:center"><strong>State Tax (SGST)</strong></td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px;text-align:center !important;"><strong>Total</strong></td>
                      <td style="border-top:0 !important; padding:0 3px 0 3px; text-align:right !important; padding-right:19px;" colspan="3"></td>
                    </tr>
                    <tr>
                      <td style="border-top:0 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:center !important;border-left:1px solid #333 !important;" >Value</td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:center !important;">Rate </td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:center !important;">Amount</td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:center !important;">Rate </td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:center !important;">Amount</td>
                      <td style="border-top:0 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:center !important;">Tax Amount</td>
                      <td style="border-top:0 !important; padding:0 3px 0 3px; text-align:right !important; padding-right:19px;" colspan="3"></td>
                    </tr>
                    <tr >
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:right !important;border-bottom:1px solid #333 !important;border-left:1px solid #333 !important;text-align:center !important;"><?php echo number_format($amt_total,2); ?></td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:right !important;border-bottom:1px solid #333 !important;text-align:center !important;"><?php echo number_format((($gst_percen/($sl-1))/2),2); ?>%</td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:right !important;border-bottom:1px solid #333 !important;text-align:center !important;"><?php echo number_format((($gst_percen_total/($sl-1))/2),2); ?></td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:right !important;border-bottom:1px solid #333 !important;"><?php echo number_format((($gst_percen/($sl-1))/2),2); ?>%</td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:right !important;border-bottom:1px solid #333 !important;text-align:center !important;"><?php echo number_format((($gst_percen_total/($sl-1))/2),2); ?></td>
                      <td style="border-top:1px solid #333 !important; border-right:1px solid #333 !important; padding:0 3px 0 3px; text-align:right !important;border-bottom:1px solid #333 !important;text-align:center !important;"><?php echo number_format(($gst_percen_total),2); ?></td>
                      <td style="border-top:0 !important; padding:0 3px 0 3px; text-align:right !important;border-bottom:1px solid #333 !important;" colspan="2">Round off +/-</td>
                      <td style="border-top:0 !important; padding:0 3px 0 3px; text-align:right !important; padding-right:19px;border-bottom:1px solid #333 !important;"><span id="footer_total2">
                        <?php if($row['round_off_total']!=''){ ?>
                        <strong>
                        <?php if($row['round_off_total']>'1'){ echo '+'; } ?>
                        <?php echo $row['round_off_total'] ?></strong>
                        <?php }?>
                        </span></td>
                    </tr>
                    <tr>
                      <td colspan="4"><strong>Amount in Words: <span style="border-bottom:1px dotted #666;" >Rupees <?php echo ucwords(convertNumber($row['grand_total'])); ?></span> only</strong></td>
                      <td >&nbsp;</td>
                      <td style="text-align:right !important;" colspan="2"><strong>GRAND TOTAL</strong></td>
                      <td style="text-align:right !important; padding-right:19px;" colspan="2" ><strong><?php echo number_format($row['grand_total'],2); ?></strong></td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-12">
                  <div class="portlet-title" style="border-top:1px dashed #333; padding-bottom:6px; height:1px !important">&nbsp;</div>
                  <table class="ot" style="width:100%" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td ><span style="border-bottom:1px dashed #666;"> Terms &amp; Conditions:</span></td>
                      <td style="border-bottom:1px dashed #666; padding-bottom:4px;"><strong>Reciever's Signature:</strong></td>
                    </tr>
                    <tr>
                      <td>E. &amp; O.E</td>
                      <td style="text-align:right">for <?php echo $row_hospital_info['hospital_name'];  ?><br>
                        Authorised Signatory</td>
                    </tr>
                    <!-------------------------row end--------------------->
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- END PAGE CONTENT --> 
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<!-- END BODY -->
</html>