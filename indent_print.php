<?php include("conn.php"); ?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.1.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Indent</title>
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
<div class="page-container"><div class="page-content"><div class="container">
  <!-- END PAGE BREADCRUMB -->
  <!-- BEGIN PAGE CONTENT INNER -->
 <?php 
 	
 	$inv_id=$_GET['inv_id'];
	//$purch_invoice=(isset($_GET['purch_flag'])) ? $_GET['purch_flag'] : "0" ;
	$purch_invoice=0 ;
	if($purch_invoice=="0") $sql="select indent.*,department_master.department_name,indent.status as `status_` from indent left join department_master on department_master.id=indent.department where indent.id='".$inv_id."'";
	else if($purch_invoice=="1") $sql="select purchase.*,vendor_master.* from purchase left join vendor_master on vendor_master.id=purchase.vendor_id where purchase.id='".$inv_id."' "; 
	$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
	
 
 ?>
 <?php
								
		while($row=mysqli_fetch_assoc($res)){
				
				$status=$row['status_'];
				$amount_=$row['amount'];
				$remarks=$row['remarks'];
				
 ?>
 <?php 
				 $sql_hospital_information="SELECT * FROM `hospital_info_masters`";
				 $result_hospital_information=$conn->query($sql_hospital_information) ;
				 $row_hospital_information = $result_hospital_information->fetch_assoc(); ?>
<div class="portlet light">
				<div class="portlet-body">
					<div class="invoice">
						<div class="row invoice-logo">
							<div class="col-xs-3 invoice-logo-space">
								<ul class="list-unstyled">
								<li><img src="<?php echo ADMIN_URL.'upload/hospital_logo/'.$row_hospital_information['hospital_logo'];  ?>" /></li>
								<li><small><?php echo $row_hospital_information['hospital_name'];  ?></small></li>								
								<li>&nbsp;</li>
								</ul>
							</div>
							<div class="col-xs-3">
									<label>Indent Number:</label><br/>
									 <b><?php echo $row['id'];  ?></b>
							</div>
							<div  class="col-xs-2">
								<label>Date:</label><br/>
								<b><?php echo date("d-m-Y",strtotime($row['date']));  ?></b>
							</div>
							<div class="col-xs-4"><?php if($purch_invoice=="0"){ ?>
								<h4>Indent</h4>
							<?php }else if($purch_invoice=="1"){ ?>
								<h3>Purchase</h3>
							<?php } ?>
							</div>
							
						</div>
						<hr/>
						<?php
						
							if($status=="0"){
							
						?>
						<div class="row" style="margin-top:-30px">
							<div class="col-xs-12" style="background:#FF3300; color:#FFFFFF; text-align:center">
								<H3>CANCELLED</H3>
							</div>
						</div>
						<div style="clear:both"></div>	
						<?php	
							
							}
						
						?>										
						<div class="row" style="margin-top:-30px">
							<div class="col-xs-4">
							<?php if($purch_invoice=="0"){ ?>
								<h3>Department:</h3>
							<?php }else if($purch_invoice=="1"){ ?>
								<h3>Vendor:</h3>
							<?php } ?>
								<ul class="list-unstyled">
									
									<li>
										 <?php echo $row['department_name']; ?>
									</li>
																		
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
									<th class="hidden-380" style="text-align:center">
										 Sn
									</th>
								
									<th class="hidden-380" style="text-align:center">
										 Item Name
									</th>
									
									<th class="hidden-380" style="text-align:center">
										 Qty
									</th>							
								</tr>
								</thead>
								<tbody>
									<?php
									$mrp_total=0;
									 if($purch_invoice=="0"){ 
										$sql="select sd.*,sd.qty as `quanitity`,pm.* from indent_details as sd inner join item_master as pm on sd.item_id=pm.id where sd.indent_id='".$inv_id."'";
									}else if($purch_invoice=="1"){
										$sql="select sd.*,sd.qty as `quanitity`,pm.* from purchase_details as sd inner join item_master as pm on sd.item_id=pm.id where sd.purchase_id='".$inv_id."'";						
									}
									
									$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
									$sl=1;
									while($row_=mysqli_fetch_assoc($res)){
										$amount=$row_['rate']*$row_['quanitity'];
										
									?>
										<tr style="text-align:center"><td><?php echo $sl; ?></td><td><?php echo strip_tags($row_['asset_name']); ?></td><td><?php echo $row_['quanitity']; ?></td></tr>
									<?php
										$sl++;
									}
									
									 ?>
									 <tr><td colspan="3">Remarks:<?php echo $remarks; ?></td></tr>
								</tbody>
								
								</table>
															
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
							  <div class="well">
								  <address>
								  E & O E
For <?php echo $row_hospital_information['hospital_name'];  ?>
<br>

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
									
								</ul>
								<br/>
								<ul><!--<li></li>--></ul>
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
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script> 
<script>
/*function cancel_bill(){
	
	let inv_id='<?php echo $inv_id; ?>';
	if(!confirm("Are you sure you want to cancel this transfer?")) return false;
	
	$.ajax({
            url: 'get_json_data.php?flag=55',
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
}

function restore_bill(){
	
	let inv_id='<?php echo $inv_id; ?>';
	if(!confirm("Are you sure you want to restore this bill?")) return false;
	
	$.ajax({
            url: 'get_json_data.php?flag=51',
			type: 'POST',
			dataType: 'json',
			data: "inv_id="+inv_id+"&status=1",
			async: false, 
			success: function (data) {			
		 		
				//alert(data.closing_stock);
				if(data.flag=="1") alert("Bill Successfully Restored");
				else alert("Unable to restore bill");
				
				location.reload();
				window.opener.load_sales();
				
			}
		});
}*/
</script>
</body>
<!-- END BODY -->
</html>