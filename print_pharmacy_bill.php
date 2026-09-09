<?php
include 'function.php';
include 'conn.php';
$id = $_REQUEST['id'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Print</title>
<link href="print_css/bootstrap.css" rel="stylesheet" media="all" />
<style>
@font-face {
 font-family: "Merchant";
 src: url("print_css/fonts/merchant/Merchant.ttf");
 font-weight: normal;
 font-style: normal;
}
 @font-face {
 *font-family: "Merchantwide";
 src: url("print_css/fonts/merchant/MerchantWide.ttf");
 font-weight: normal;
 font-style: normal;
}
.container {
	width: 700px;
}
.hos-name {
	font-weight: bold;
	font-size: 25px;
	margin-top: 10px;
}
.hos-unit, .address, .phone-area {
	margin-bottom: 0px;
	line-height: 14px;
}
.address, .phone-area, .bill-date, .payment-area {
 *font-family: 'Merchant';
}
.address {
 *font-size: 20px;
}
.phone-area, .billdate, .payment-area, .bill-patient, .bill-address {
 *font-size: 18px;
}
.bill-patient span, .bill-address span {
	font-weight: bold;
}
.money-title {
	font-size: 20px;
 *font-family: 'Merchantwide';
}
.money-title span {
	border-bottom: 1px solid;
}
.bill-no {
	font-size: 18px;
	letter-spacing: 2px;
}
.bill-date {
	height: 40px;
}
.bill-bill-date {
	height: 60px;
}
.billdate {
	padding-top: 7px;
}
.payment-area .name, .payment-area .mode {
	line-height: 13px;
}
.payment-area .received {
	margin-top: 10px;
	line-height: 17px;
}
.payment-area .rupee, .payment-area .mode, .payment-area .received {
	margin-bottom: 0px;
}
.payment-area .total {
	font-size: 20px;
}
.dr-sign {
	margin-top: 40px;
	font-weight: bold;
	font-style: italic;
	font-size: 16px;
	text-align: right;
}
.bill-patient {
	line-height: 14px;
}
.bill-area .total-amount {
	border-bottom: 1px dashed;
	border-top: 1px dashed;
	padding: 5px 0;
 *font-family: 'Merchant';
 *font-family: 'Merchant';
	font-size: 15px;
}
.bill-area .total-amount-word {
	margin-top: 3px;
 *font-family: 'Merchant';
 *font-family: 'Merchant';
	font-size: 15px;
}
.bill-area .dr-sign {
	border-bottom: 1px dashed;
	padding-bottom: 10px;
	margin-bottom: 10px;
}
.table > tbody > tr > th {
	border-bottom: 1px dashed;
	border-top: 1px dashed;
	padding: 2px;
}
.table > tbody > tr > td {
	padding: 2px;
	border-bottom: 0px;
	border-top: 0px;
}
.procedure {
 *font-family: 'Merchant';
 *font-size: 18px;
}
.bill-area > h2, .bill-area > p, .bill-area > h4, .receipt-area > h2, .receipt-area > p, .receipt-area > h4 {
	margin-bottom: 0px;
}
.bill-area > h4, .receipt-area > h4 {
	margin-top: 0px;
}
.receipt-area {
	margin-top: 30px;
}
</style>
</head>
<body>
<div class="container">
  <div class="bill-area">
    <?php $sql5="SELECT `id`, `hospital_name`, `doctor`, `designation`, `address`, `phone`, `mobile`, `email`, `hospital_unit` FROM `hospital_info_masters`";
		 $result5=$conn->query($sql5) ;
		 $row5 = $result5->fetch_assoc(); ?>
    <h2 class="text-center"><?php echo $row5['doctor']; ?></h2>
    <p class="text-center"><b><?php echo $row5['designation']; ?></b></p>
    <h4 class="text-center hos-name"> <?php echo $row5['hospital_name']; ?></h4>
    <p class="text-center address"><?php echo $row5['address']; ?></p>
    <p class="text-center phone-area">Phone: <?php echo $row5['phone']; ?>, Email: <?php echo $row5['email']; ?></p>
    <h3 class="money-title text-center"> <span>
      <?php 
		$sql3="SELECT * FROM `invoice_pharmacy_billing`  WHERE `id`='".$id."'";
		 $result3=$conn->query($sql3) ;
		 $row3 = $result3->fetch_assoc();
		 
		 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";
		 $result7=$conn->query($sql7) ;				
		 $row7 = $result7->fetch_assoc();
		 $count7=$result7->num_rows;
		 if($count7>0)
		 {
			$created_by=$row7['name'];
		 }		
		 $m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['created_on'])),"4/1","3/31");
		 
		


		if($row3['status'] == 4){ 
			echo "PROFORMA INVOICE CUM ADVANCE RECEIPT";
		} else {
			echo "BILL CUM MONEY RECEIPT";
		} ?>
      </span> </h3>
    <div class="row">
      <div class="bill-date bill-bill-date">
        <div class="pull-left">
          <div class="bill-patient"> Patient Name: <span> <?php echo $row3['name']; ?></span><br>
            UHID No. : <span><?php echo $row3['hospital_number']; ?></span><br>
            <?php 

					$inside_doc = $row3['doc_id'];
					

				$sql_inside = "SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5' AND `users`.`del_flag`='0' ORDER BY `user_infos`.`name` ASC  AND `users`.`id` = '$inside_doc'";

					$run_sql_inside = mysqli_query($conn,$sql_inside);

					$row_sql_inside = mysqli_fetch_assoc($run_sql_inside);

					

					 ?>
            Doctor: <span><?php echo $row_sql_inside['name']; ?> </span> <br>
            <?php if($row3['address']){ ?>
            Address:<span><?php echo nl2br($row3['address']); ?></span>
            <?php } ?>
          </div>
        </div>
        <div class="pull-right">
          <div class="bill-patient"> REGN. NO.: <span>BWN/33511340</span><br>
            Invoice No.: <span>
            <?php  echo $row3['invo_no'].'/'.$m_f_year; ?></span><br>
            Dated: <span><?php echo date("d/m/Y", strtotime($row3['created_on'])); ?></span><br>
            <?php if($fetchaprrove['p_key'] == 'TPA'){ ?>
            Tpa Name: <span><?php echo $fetchaprrove['tpa_name']; ?></span> <br>
            <?php } ?>
            <?php if($fetchaprrove['p_key'] == 'TPA'){ ?>
            Claim No: <span><?php echo $fetchaprrove['claim_no']; ?></span>
            <?php } ?>
          </div>
        </div>
      </div>
      
      <div class="procedure">
        <table class="table">
          <tr>
            <th>#</th>
            <th>Item Name</th>
            <th class="text-right">Batch No</th>
            <th class="text-right">Rate</th>
            <th class="text-right">Qty</th>
            <th class="text-right">Net Amount (Rs.)</th>
          </tr>
          
         <?php $sql23="SELECT * FROM `invoice_pharmacy_item` WHERE `i_id`='".$id."'";
				 $result23=$conn->query($sql23) ;
				 $i=1;
				 while ($row23=mysqli_fetch_array($result23,MYSQLI_ASSOC))
				 {	
				 ?>
          	<tr>
                <td><?php echo $i; $i++;?></td>
                <td><?php    
                                $sql27 = $conn->query("SELECT  `item_name` FROM `item_masters` WHERE `id` = '".$row23['item_id']."'");    
                                $procedure_info = $sql27->fetch_assoc();    
                                echo $procedure_info['item_name'];    
                            ?></td>
                <td class="text-right"><?php echo $row23['batch_no']; ?></td>
                <td class="text-right"><?php echo $row23['rate']; ?></td>
                <td class="text-right"><?php echo $row23['qty']; ?></td>
               
                <td class="text-right"><?php echo number_format($row23['net_amount'], 2); ?></td>
              </tr>
          
          <?php } ?>
          
         
          <?php if($row3['discount']){ ?>
          <tr>
            
            <td colspan="2">Less: Discount
              <?php 
				if($row3['discount_purpose']){
								echo '( '.$row3['discount_purpose'].' )';
				}
							


						?>
              </td>
            <td class="text-right">&nbsp;</td>
            <td class="text-right">&nbsp;</td>
            <td class="text-right">&nbsp;</td>
            <td class="text-right">&nbsp;</td>
            <td class="text-right"><?php 
							echo '-'.number_format($row3['discount'], 2); 

						?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
     
      <?php  ?>
      
      <div class="total-amount">
        <div class="text-right"> <b>Total Amount</b>: <?php echo number_format($row3['total'], 2); ?> </div>
      </div>
      <div class="total-amount-word">
        <div class="text-left"> Rupees <?php echo ucwords(number_to_indian_rupees_convert($row3['total'])); ?> Only </div>
      </div>
      <div class="payment-area">
        <p class="name"> Bill by <b>
          <?php  echo ucwords($created_by); ?>
          </b><br>
        </p>
        
      </div>
      <div class="dr-sign" >
        <h5 >
          <?php echo $row5['hospital_name']; ?> <br>
          <i>(This is a computer generated bill. Hence Signature is not required)</i></h5>
      </div>
    </div>
  </div>
  
</div>
<script>
window.print();
</script>
</body>
</html>