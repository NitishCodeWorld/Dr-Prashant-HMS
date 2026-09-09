<?php
include 'function.php';

include 'conn.php';


/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/



?>
<?php



$id = $_GET['id']; // get id through query string



// Changes_to_be
$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);




$qry = mysqli_query($conn, "select * from `invoice_final_billing` where `id`='".$id."'"); // select query
$row3 = mysqli_fetch_array($qry); // fetch data
$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['billing_date'])) , "4/1", "3/31");



$del_flag=$row3['del_flag'];



$cancled="";



if($del_flag=='1'){



	$cancled=" INVOICE ( Cancelled Bill )";



}else{

	$cancled=" INVOICE ";	

}

if($row3['opd_flag']==1){

	$bill_for='OPD';

}else{

	$bill_for='IPD';

}



$prefix="";

$sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row3['prefix']."'";	

$res_prefix=mysqli_query($conn,$sql_prefix);

$row_prefix=mysqli_fetch_assoc($res_prefix);

$count_prefix=$res_prefix->num_rows;

if($count_prefix>0)

{

	$prefix=$row_prefix['prefix_name']; 

}





$sql_gen="select * from `gender_masters` Where `id`='".$row3['gender']."' ";

$result_gen=$conn->query($sql_gen) ;

$row_gen=mysqli_fetch_assoc($result_gen);

$gen="";							 

$gen=" / ".mb_substr($row_gen['gender'], 0, 1);;

									

$sql_dob="select * from `patient_registration_form` Where `uhid_no`='".$row3['hospital_number']."' ";

$result_dob=$conn->query($sql_dob) ;

$row_dob=mysqli_fetch_assoc($result_dob);

if($row_dob['dob']!=''){

	$dob=' '.date("d/M/Y", strtotime($row_dob['dob']));

}else{

	$dob="";

}



$payor_name="SELF";

$insurance_name="";

$claim_no="";

$tpa_amt=0;

$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name`,`tpa_masters`.`name` AS `tpa_company` ,`insurance_masters`.`name` AS `insurance_company` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id` LEFT JOIN `tpa_masters` ON `invoice_final_payment_billing`.`tpa_name` =`tpa_masters`.`id` LEFT JOIN `insurance_masters` ON `invoice_final_payment_billing`.`insurance_name` =`insurance_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$id."' AND `invoice_final_payment_billing`.`p_key`='5'  AND `invoice_final_payment_billing`.`del_flag`='0' ";

$result_payment = $conn->query($sql_payment);

if($result_payment->num_rows > 0){

	while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

	{

		$payor_name=$row2_payment['tpa_company'];

		$insurance_name=$row2_payment['insurance_company'];

		$claim_no=$row2_payment['claim_no'];

		$tpa_amt=$tpa_amt+$row2_payment['p_value'];

	}

}

$ptflag=0;	

if(isset($_REQUEST['ptflag'])){

	$ptflag=$_REQUEST['ptflag'];

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Money Receipt</title>
<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">

<!--<link rel="manifest" href="favicon/manifest.json">-->

<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link href="<?php echo ADMIN_URL; ?>print_money_reciept_assets/css/bootstrap.css" rel="stylesheet" media="all" />
<style>
@font-face {
 font-family: "Merchant";
 src: url("<?php echo ADMIN_URL; ?>print_money_reciept_assets/fonts/merchant/Merchant.ttf");
 font-weight: normal;
 font-style: normal;
}
 @font-face {
 *font-family: "Merchantwide";
 src: url("<?php echo ADMIN_URL; ?>print_money_reciept_assets/fonts/merchant/MerchantWide.ttf");
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
  <div class="receipt-area">
    <h4 class="text-center hos-name"><?php echo $row_hospital_info['hospital_name'];  ?></h4>
    <p class="text-center address">(<?php echo $row_hospital_info['final_bill_unit']; ?>)</p>
    <p class="text-center address"><?php echo $row_hospital_info['address']; ?></p>
    <p class="text-center phone-area">Phone: <?php echo $row_hospital_info['final_bill_mobile']; ?>, Email: <?php echo $row_hospital_info['email']; ?></p>
    <h3 class="money-title text-center"> <span> <span>
      <?php 	echo "MONEY RECEIPT";
		?>
      </span> </span> </h3>
    <div class="row">
      <div class="bill-date">
        <div class="billdate pull-left"> No.: <b><?php echo $row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row3['invo_no'];  ?></b> </div>
        <div class="billdate pull-right"> Dated: <b><?php echo date("d/M/Y", strtotime($row3['billing_date']));  ?> <?php echo date("h:i A", strtotime($row3['billing_time']));  ?></b> </div>
      </div>
      <br>
      <div class="payment-area">
        <p class="name"> Payment Received with thanks from <b><?php echo $prefix.' '.$row3['name'];  ?></b><br>
          Address: <b><?php echo ucwords($row3['address']); ?></b> </p>
        <?php

		 $amt=$row3['total']-$tpa_amt; 
		 ?>
       
        <?php 
$sql_payment_details = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$id."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0' ";

$result_payment_details = $conn->query($sql_payment_details);

if($result_payment_details->num_rows > 0){

	
?>
        <p class="mode">
          <?php

while ($row2_payment_details=mysqli_fetch_array($result_payment_details,MYSQLI_ASSOC))

		{
	


						$amount_received = 'Rs. ';

						$amount_received .= number_format($row2_payment_details['p_value'], 2)." in ".ucfirst($row2_payment_details['payment_mode_name'])."</br>";

						echo $amount_received;

					}
				?>
        </p>
        <?php } ?>
        <p class="received">
          <?php 
				echo "Full"; ?>
          received against Bill No. <?php echo $row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row3['invo_no'];  ?><br>
          <span class="total">Rs. <?php echo number_format($amt, 2); ?></span> </p>
      </div>
      <div class="dr-sign">
        <p style="font-size: 12px; font-weight: normal; float: left; line-height: 1;"> Issued By:
          <?php $sql7_user="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";

					 $result7_user=$conn->query($sql7_user) ;	

					 $row7_user = $result7_user->fetch_assoc();

					 $count7_user=$result7_user->num_rows;

					 if($count7_user>0)

					 {

						echo $created_by=$row7_user['name'];

					 } ?>
        </p>
        <div class="dr-sign">
          <h5>
            <?php //echo $place_info['doctor']; ?>
            For<br/>
            <?php echo $row_hospital_info['hospital_name'];  ?><br/>
            (<?php echo $row_hospital_info['final_bill_unit'];  ?>) <br>
            <i>(This is a computer generated bill. Hence Signature is not required)</i></h5>
          <br>
          <span style="font-size: 12px; font-weight: normal; float: left; line-height: 1;margin-top:-40px;"> Printed On: <?php echo date('d/m/Y h:i A');?> </span> </div>
      </div>
    </div>
  </div>
  <?php //} ?>
</div>
<script>

window.print();

</script>
</body>
</html>
