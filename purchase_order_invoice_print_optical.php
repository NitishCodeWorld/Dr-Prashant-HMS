<?php

include "conn.php"; // Using database connection file here
error_reporting(E_ALL);
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
<title>Invoice Order</title>
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

	else if($purch_invoice=="1") $sql="select purchase_order_for_optical.*,vendor_master_for_optical.* from purchase_order_for_optical left join vendor_master_for_optical on vendor_master_for_optical.id=purchase_order_for_optical.vendor_id where purchase_order_for_optical.id='".$inv_id."' "; 

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
                  <?php 
				$sql_hos_info="select * from hospital_info_masters"; 
				$res_hos_info=mysqli_query($conn,$sql_hos_info);
				$row_hos_info=mysqli_fetch_assoc($res_hos_info);
				?>
                  <li><b><?php echo $row_hos_info['hospital_name'];?></b></li>
                  <li><?php echo $row_hos_info['address'];?></li>
                  <li>GSTIN : <?php echo $row_hos_info['gst_in'];?></li>
                  <li>Mobile No.: <?php echo $row_hos_info['phone'];?></li>
                  <li>e-mail : <?php echo $row_hos_info['email'];?> </li>
                  <li>Website : <?php echo $row_hos_info['website'];?></li>
                </ul>
              </div>
              <div class="col-xs-3">
                <label>PI Number:</label>
                <br/>
                <b><?php echo $row['order_number'];  ?></b><br/>
              </div>
              <div  class="col-xs-2">
                <label>Date:</label>
                <br/>
                <b><?php echo date("d-m-Y",strtotime($row['date']));  ?></b> <br/>
              </div>
              <div class="col-xs-4">
                <?php if($purch_invoice=="0"){ ?>
                <h4>PROFORMA INVOICE</h4>
                <?php }else if($purch_invoice=="1"){ ?>
                <h3>Purchase Order</h3>
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
                  <?php }?>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table class="table table-striped table-hover" style="margin-bottom:0px" id="main_body">
                  <thead>
                    <tr>
                      <th class="hidden-380" style="text-align:center"> Sn </th>
                      <th class="hidden-380" style="text-align:center"> Item Name </th>
                      <th class="hidden-380" style="text-align:center"> Category Name </th>
                      <th class="hidden-380" style="text-align:center"> Sub Cat </th>
                      <th class="hidden-380" style="text-align:center"> GP </th>
                      <th class="hidden-380" style="text-align:center"> Size </th>
                      <th class="hidden-380" style="text-align:center"> Colour </th>
                      <th class="hidden-380" style="text-align:center"> Qty </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					//type_master_for_optical.category_name,(select category_name from type_master_for_optical where id=item_master_for_optical.sub_type_id) as sub_cat
						  $mrp_total=0;
						   if($purch_invoice=="0"){ 
							  $sql="select sd.*,sd.qty as `quanitity`,pm.* from sales_invoice_details as sd inner join products_master as pm on sd.product_id=pm.id where sd.sales_invoice_id='".$inv_id."'";
						  }else if($purch_invoice=="1"){
							  $sql="select sd.*,sd.qty as `quanitity`,pm.*,ty.category_name,(select category_name from type_master_for_optical where type_master_for_optical.id=pm.sub_type_id) as sub_cat from purchase_order_details_for_optical as sd inner join item_master_for_optical as pm on sd.item_id=pm.id inner join type_master_for_optical as ty on ty.id=pm.type_id where sd.order_id='".$inv_id."'";						
						  }
						  $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
						  $sl=1;
						  while($row_=mysqli_fetch_assoc($res)){
						  ?>
                    <tr style="text-align:center">
                      <td><?php echo $sl; ?></td>
                      <td><?php echo $row_['item_name']; ?></td>
                      <td><?php echo $row_['category_name']; ?></td>
                      <td><?php echo $row_['sub_cat']; ?></td>
                      <td><table class="table table-striped table-hover" style="margin: -12px 0 -8px 0;" id="main_body">
                          <thead>
                            <tr>
                              <th></th>
                              <th>SPF</th>
                              <th>Cyl</th>
                              <th>Axis</th>
                              <th>Add</th>
                            </tr>
                          </thead>
                          <tbody>
							   <?php 
                              $sql_gp="select * from gp_item_master_for_optical where item_id='".$row_['item_id']."'";						
                              $res_gp=mysqli_query($conn,$sql_gp) or die(mysqli_error($conn));
                              $row_gp=mysqli_fetch_assoc($res_gp);
                              ?>
                            <tr>
                              <td><b>RE</b></td>
                              <td><?php echo $row_gp['rspf']; ?></td>
                              <td><?php echo $row_gp['rcyl']; ?></td>
                              <td><?php echo $row_gp['raxis']; ?></td>
                              <td><?php echo $row_gp['lspf']; ?></td>
                            </tr>
                            <tr>
                              <td><b>LE</b></td>
                              <td><?php echo $row_gp['lcyl']; ?></td>
                              <td><?php echo $row_gp['laxis']; ?></td>
                              <td><?php echo $row_gp['radd']; ?></td>
                              <td><?php echo $row_gp['ladd']; ?></td>
                            </tr>
                          </tbody>
                        </table>
                       </td>
                      <td><?php echo $row_['size']; ?></td>
                      <td><?php echo $row_['color']; ?></td>
                      <td><?php echo $row_['qty']; ?></td>
                    </tr>
                    <?php $sl++; }  ?>
                  </tbody>
                </table>
                <p></p>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-4">
                <div class="well">
                  <address>
                  E & O E
                  For OM EYE CARE.
                  </address>
                </div>
              </div>
              <div class="col-xs-8 invoice-block">
               <!-- <ul class="list-unstyled amounts">
                  <li> <strong>Grand Total:</strong> &#8377;<?php echo $grand_net_total_; ?> </li>
                </ul>
                <br/>
                <ul>
                  <li></li>
                </ul>
                <br/>-->
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

</body>

<!-- END BODY -->

</html>