<?php
include 'function.php';

include 'conn.php';
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/



function removeConsecutiveDuplicates($input) {

    $items = explode(", ", $input);

    $result = [];

    

    foreach ($items as $index => $item) {

        if ($index == 0 || $item !== $items[$index - 1]) {

            $result[] = $item;

        }

    }

    

    return implode(", ", $result);

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Collection Reports MIS</title>

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

<style>

td {

	vertical-align:middle !important;

	font-family:Arial, Helvetica, sans-serif;

	text-align:left;

	font-size:9pt;

	padding: 2px;

}

</style>

<style>

.defualt_td {

	font-size:10px !important;

	padding:1px;

	text-align:center;

}

.defualt_td_spcl {

	font-size:9px !important;

	padding:1px;

	text-align:center;

}

.bold_td {

	font-size:12px !important;

	font-weight:bold !important;

	padding:1px;

	text-align:center;

}

.bord {

	border:none !important;

	padding:1px;

	text-align:center;

}

.bord_bott {

	border-left:none !important;

	border-right:none !important;

	border-top:none !important;

	border-bottom:2px solid #000 !important;

	padding:1px;

	text-align:center;

}

.bord_top {

	border-left:none !important;

	border-right:none !important;

	border-bottom:none !important;

	border-top:2px solid #000 !important;

	padding:1px;

	text-align:center;

}

.bold_td_big {

	font-size:13px !important;

	font-weight:bold !important;

	color:#C00 !important;

	padding:1px;

	text-align:center;

}

@media print {

  @page {

    margin: 30px;

  }

}

</style>

</head>



<body style="padding:5px;">
  <?php 

				 $sql_hospital_information="SELECT * FROM `hospital_info_masters`";

				 $result_hospital_information=$conn->query($sql_hospital_information) ;

				 $row_hospital_information = $result_hospital_information->fetch_assoc(); ?>

<?php 

$from_date = date("Y-m-d", strtotime($_REQUEST['from_date']));

$to_date = date("Y-m-d", strtotime($_REQUEST['to_date']));

$title_span=$row_hospital_information['hospital_short_name']." collection Reports MIS From ".date("d-M-Y", strtotime($_REQUEST['from_date']))." To ".date("d-M-Y", strtotime($_REQUEST['to_date']));

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="padding:6px 4px; font-size:10pt; text-align:left; font-family:Arial, Helvetica, sans-serif"><strong><?php echo $title_span; ?></strong></td>

  </tr>

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <!--<tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:12pt"><strong>Branch Name:</strong> Kolkata</td>

        </tr>-->

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>OPD BILLING</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">

              <tr>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Sl No.</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Bill No. </strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>RegId</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Patient Name</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>INI</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Amount</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Discount</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Net Amt</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Advance</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Adj Adv</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Pay Type</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Paid</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Party Name</strong></td>

              </tr>

              <?php 

			  $due_net_total=0;

			  $due_amt=0;

  $extra_query=" AND `invoice_final_billing`.`opd_flag`='1' ";

  $sql3=" SELECT DISTINCT (`invoice_final_procedure`.`procedure_id`) AS `distinct_proc_id` FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` INNER JOIN `procedure_masters` ON `invoice_final_procedure`.`procedure_id`=`procedure_masters`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  $extra_query AND `invoice_final_procedure`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' ORDER BY `procedure_masters`.`procedure_name` ASC "; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	$amount_grand_total=0;

	$discount_grand_total=0;

	$paid_grand_total=0;

	$advance_grand_total=0;

	$print_url="";

	 if($count>'0'){

			 $sl_no=1;

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 $procedure_name="";

			 $sql7="SELECT `procedure_name` FROM `procedure_masters` Where `id`='".$row3['distinct_proc_id']."'";

			 $result7=$conn->query($sql7) ;		

			 $row7 = $result7->fetch_assoc();

			 $count7=$result7->num_rows;

			 if($count7>0)

			 {

				$procedure_name=$row7['procedure_name'];			 

			 }



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  `invoice_final_billing`.`id`,  `invoice_final_billing`.`hospital_number`,  `invoice_final_billing`.`invo_no`,  `invoice_final_billing`.`name`,  `invoice_final_billing`.`doc_id`,  `invoice_final_billing`.`opd_flag`,  `invoice_final_billing`.`billing_date`,  `invoice_final_billing`.`discount`,  `invoice_final_billing`.`discount_type`,  `invoice_final_billing`.`total`,  `invoice_final_billing`.`del_flag`,  `invoice_final_billing`.`prefix`,`invoice_final_procedure`.`amount`  AS `procedure_amount` , `invoice_final_procedure`.`discount` AS `procedure_dicount`, `invoice_final_procedure`.`net_amount`  AS `procedure_net_amount` FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_procedure`.`del_flag`='0'  AND  `invoice_final_billing`.`del_flag`='0'  AND  `invoice_final_procedure`.`procedure_id`='".$row3['distinct_proc_id']."' ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					$pay_mode_ret="";

					$advance_amt_ret=0;

					

					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name`,`tpa_masters`.`name` AS `tpa_company`  FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id` LEFT JOIN `tpa_masters` ON `invoice_final_payment_billing`.`tpa_name` =`tpa_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`='5'  AND `invoice_final_payment_billing`.`del_flag`='0' ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{

							$payor_name=$row2_payment['tpa_company'];						

							/*if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}*/

							

						}

					}

					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='3'  ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

							

						}

					}

					

					 $sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='0'  ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							if($row2_payment['advance_bill_invoice_no']!=''){

								$advance_amt=$advance_amt+$row2_payment['p_value'];

							}

							

						}

					}

					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='1'  ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode_ret==''){

								$pay_mode_ret=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode_ret=$pay_mode_ret.' , '.$row2_payment['payment_mode_name'];

							}

							if($row2_payment['advance_bill_invoice_no']!=''){

								$advance_amt_ret=$advance_amt_ret+$row2_payment['p_value'];

							}

							

						}

					}

					$bill_time_paid=0;

					

					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='3'   AND `invoice_final_payment_billing`.`payment_type`='1' ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	

							$bill_time_paid=$bill_time_paid+$row2_payment['p_value'];				

							

						}

					}

					

					$output = removeConsecutiveDuplicates($pay_mode);

					$pay_mode=$output;

					

					 

					 $amount=0;

					 $discount=0;

					 $net_amount=0;

					 $procedure_amount=0;

					 $procedure_dicount=0;

					 $procedure_net_amount=0;

					 

					 $procedure_amount=$row_inner['procedure_amount'];

					 $procedure_dicount=$row_inner['procedure_dicount'];

					 $procedure_net_amount=$row_inner['procedure_net_amount'];

					 

					 $amount=$procedure_amount;

					 $discount=$procedure_dicount;

					 $net_amount=$procedure_net_amount;

					 $dicount_calculate=0;

					 $dicount_calculate_int=0;

					 $dicount_calculate_per_proc=0;

					 $dicount_calculate_per_proc_int=0;

					 

					 if($row_inner['discount']!='0'){

						 if($row_inner['discount']!=''){

							$sql_discount=" SELECT  SUM(`net_amount`) AS `tot_net`,COUNT(`id`) AS `total_proc_cnt`  FROM `invoice_final_procedure` WHERE `i_id`='".$row_inner['id']."' AND `del_flag`='0'  ";  

	 						$result_discount=$conn->query($sql_discount) ;

							$row_discount = $result_discount->fetch_assoc();

							

							 if($row_inner['discount_type']=='P'){

								 	$dicount_calculate=( $row_discount['tot_net']*$row_inner['discount'])/100;

									$dicount_calculate_int=round($dicount_calculate);

									$dicount_calculate_per_proc=($dicount_calculate_int/$row_discount['total_proc_cnt']);

									$dicount_calculate_per_proc_int=round($dicount_calculate_per_proc);

							 }

							 if($row_inner['discount_type']=='F'){

									$dicount_calculate_per_proc=($row_inner['discount']/$row_discount['total_proc_cnt']);

									$dicount_calculate_per_proc_int=round($dicount_calculate_per_proc);

							 }

							 

						 }						 

					 }

					 $amount=$procedure_amount;

					 $discount=$procedure_dicount+$dicount_calculate_per_proc_int;

					 $net_amount=$procedure_net_amount-$dicount_calculate_per_proc_int;

					 

					 $amount_net_total=$amount_net_total+$amount;

					 $discount_net_total=$discount_net_total+$discount;

					 $paid_net_total=$paid_net_total+$net_amount;

					 $paid_advance_total=$paid_advance_total+$advance_amt;

					 

					 $due_net_total=$due_net_total+$due_amt-$advance_amt_ret;

					 $adjamt=0;

					 $adjamt=$advance_amt-$advance_amt_ret;

					 $due_amt=$due_amt-$advance_amt_ret;

					 

					 

					 

					 if($sl_inner==1){

						echo '<tr><td colspan="13" style="padding:4px;"><strong>'.$procedure_name.'</strong></td></tr>' ;

					 }

					 $print_url= ADMIN_URL.'print_final_bill_for_opd_new.php?id='.$row_inner['id'];  

					echo ' <tr ><td class="defualt_td">'.$sl_inner.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$ini.'</td><td class="defualt_td">'.$amount.'</td><td class="defualt_td">'.$discount.'</td><td class="defualt_td">'.$net_amount.'</td><td class="defualt_td">'.$advance_amt.'</td><td class="defualt_td">'.$adjamt.'</td><td class="defualt_td_spcl">'.$pay_mode.'</td><td class="defualt_td_spcl">'.$bill_time_paid.'</td><td class="defualt_td_spcl">'.$payor_name.'</td></tr>';

					if($sl_inner==$count_inner){

						echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total:</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">'.$amount_net_total.'</td><td class="bold_td bord_bott">'.$discount_net_total.'</td><td class="bold_td bord_bott">'.$paid_net_total.'</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td></tr>';

					$amount_grand_total=$amount_grand_total+$amount_net_total;

					$discount_grand_total=$discount_grand_total+$discount_net_total;

					$paid_grand_total=$paid_grand_total+$paid_net_total;

					$advance_grand_total=$advance_grand_total+$paid_advance_total;

					}

			 

			 //$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"amount"=>$amount,"discount"=>$discount,"net_amount"=>$net_amount,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"amount_net_total"=>$amount_net_total,"discount_net_total"=>$discount_net_total,"paid_net_total"=>$paid_net_total,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"paid_advance_total"=>$paid_advance_total,"due_net_total"=>$due_net_total,"advance_amt_ret"=>$advance_amt_ret,"pay_mode_ret"=>$pay_mode_ret,"adjamt"=>$adjamt);

			 $sl_inner++; 

			 }

			 

	 }



		



		$sl_no++; 



	}}

	echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total OPD Billng:</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">'.$amount_grand_total.'</td><td class="bold_td bord_bott">'.$discount_grand_total.'</td><td class="bold_td bord_bott">'.$paid_grand_total.'</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td></tr>';

    ?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>OPD ADVANCE</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="1" cellpadding="0" cellspacing="0">

              <tr>

                <td width="6%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Sl No.</strong></td>

                <td width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Receipt  No. </strong></td>

                <td width="9%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>RegId</strong></td>

                <td width="24%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Patient Name</strong></td>

                <td width="9%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Amt INR</strong></td>

                <td width="8%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Pay Type</strong></td>

                <td width="9%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Dr. Name</strong></td>

                <td width="25%" style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Remarks</strong></td>

              </tr>

              <?php

	

		$extra_query=" AND `adavnce_final_billing`.`opd_flag`='1' ";

	

	$arr=array();

	$amount_grand_total=0;



	$sql3=" SELECT DISTINCT (`adavnce_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `adavnce_final_payment_billing` INNER JOIN `adavnce_final_billing` ON `adavnce_final_payment_billing`.`i_id`=`adavnce_final_billing`.`id` WHERE DATE(`adavnce_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `adavnce_final_payment_billing`.`del_flag`='0' AND  `adavnce_final_billing`.`del_flag`='0' "; 

	//AND `adavnce_final_payment_billing`.`adjust_with_final_bill_flag`='0'

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	 



	 if($count>'0'){

			 $sl_no=1;

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 $user_remarks="";

			 $sql7="SELECT `procedure_id` FROM `adavnce_final_procedure` Where `i_id`='".$row3['distinct_proc_id']."'";

			 $result7=$conn->query($sql7) ;		

			 $row7 = $result7->fetch_assoc();

			 $count7=$result7->num_rows;

			 if($count7>0)

			 {

				

				if($user_remarks==''){

					$user_remarks=$row7['procedure_id'];

				}else{

					$user_remarks=$user_remarks.' , '.$row7['procedure_id'];

				}			 

			 }



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  * FROM `adavnce_final_billing`  WHERE DATE(`adavnce_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `adavnce_final_billing`.`del_flag`='0'   AND  `adavnce_final_billing`.`id`='".$row3['distinct_proc_id']."' ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/RECP/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					

					

					

					$sql_payment = "SELECT `adavnce_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `adavnce_final_payment_billing` INNER JOIN `payment_mode_masters` ON `adavnce_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `adavnce_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `adavnce_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `adavnce_final_payment_billing`.`p_key`<>'5'  AND `adavnce_final_payment_billing`.`del_flag`='0'  ";

					//AND `adavnce_final_payment_billing`.`adjust_with_final_bill_flag`='0'

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

								$advance_amt=$advance_amt+$row2_payment['p_value'];

							

							

						}

					}

					 

					 $print_url= ADMIN_URL.'print_advance_final_bill.php?id='.$row_inner['id'];  

					 echo '<tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$advance_amt.'</td><td class="defualt_td">'.$pay_mode.'</td><td class="defualt_td">'.$ini.'</td><td class="defualt_td">'.$user_remarks.'</td></tr>';

					 $amount_grand_total=$amount_grand_total+$advance_amt;

					 

			 

			 //$arr[]=array("sl_no"=>$sl_no,"user_remarks"=>$user_remarks,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag']);

			 $sl_inner++; 

			 }

			 

	 }



		



		$sl_no++; 



	}}



	echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'.$amount_grand_total.'</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td></tr>';

	 ?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>OPD Adjusted Advance Details</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="1" cellpadding="0" cellspacing="0">

              <tr>

                <th width="5%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Sl. No</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Receipt No.</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">RegID</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Patient Name</th>

                <th width="12%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Receipt Date</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">BillSeriesCode</th>

                <th width="13%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Adjusted Amount</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Total Rec Amt</th>

              </tr>

              <?php

     $amount_grand_total=0;

	$amount_grand_total_adusted=0;

		$extra_query=" AND `invoice_final_billing`.`opd_flag`='1' ";

	

	$arr=array();



	$sql3=" SELECT DISTINCT (`invoice_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_payment_billing`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_invoice_unique_id`<>'' AND DATE(`invoice_final_payment_billing`.`payment_date`) NOT BETWEEN '".$from_date."' AND  '".$to_date."'"; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	 



	 if($count>'0'){

			 $sl_no=1;

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  * FROM `invoice_final_billing`  WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_billing`.`del_flag`='0'   AND  `invoice_final_billing`.`id`='".$row3['distinct_proc_id']."' ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					

					

					$receipt_date='';

					$advance_bill_invoice_unique_id='';

					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_invoice_unique_id`<>''  AND `invoice_final_payment_billing`.`payment_type`='2'  AND DATE(`invoice_final_payment_billing`.`payment_date`) NOT BETWEEN '".$from_date."' AND  '".$to_date."' ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

								$advance_amt=$advance_amt+$row2_payment['p_value'];

								$receipt_date=date("d-M-Y", strtotime($row2_payment['payment_date']));

								$advance_bill_invoice_unique_id=$row2_payment['advance_bill_invoice_unique_id'];

						}

					}

					

					

					$pay_mode_ref="";

					$advance_amt_ref=0;

					

					

					$receipt_date_ref='';

					$advance_bill_invoice_unique_id_ref='';

					 $sql_payment_ref = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_invoice_unique_id`<>''  AND `invoice_final_payment_billing`.`payment_type`='3' ";

					$result_payment_ref = $conn->query($sql_payment_ref);

					if($result_payment_ref->num_rows > 0){

						while ($row2_payment_ref=mysqli_fetch_array($result_payment_ref,MYSQLI_ASSOC))

						{	if($pay_mode_ref==''){

								$pay_mode_ref=$row2_payment_ref['payment_mode_name'];

							}else{

								$pay_mode_ref=$pay_mode_ref.' , '.$row2_payment_ref['payment_mode_name'];

							}

							

								$advance_amt_ref=$advance_amt_ref+$row2_payment_ref['p_value'];

								$receipt_date_ref=date("d-M-Y", strtotime($row2_payment_ref['payment_date']));

								$advance_bill_invoice_unique_id_ref=$row2_payment_ref['advance_bill_invoice_unique_id'];

						}

					}

					$adjusted_value=0;	

					if($advance_amt_ref>0){				

						$adjusted_value=$advance_amt-$advance_amt_ref;

					}

					

				if($row_inner['opd_flag']==1){

						  $print_url= ADMIN_URL.'print_final_bill_for_opd_new.php?id='.$row_inner['id']; 

				  }else{

					   $print_url= ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$row_inner['id'];

				  }

				  echo '<tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$receipt_date.'</td><td class="defualt_td">'.$bill_for.'</td><td class="defualt_td">'.$adjusted_value.'</td><td class="defualt_td">'.$advance_amt.'</td></tr>';

				 $amount_grand_total=$amount_grand_total+$advance_amt;

				$amount_grand_total_adusted=$amount_grand_total_adusted+$adjusted_value;

			 

			// $arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"receipt_date"=>$receipt_date,"advance_bill_invoice_unique_id"=>$advance_bill_invoice_unique_id,"adjusted_value"=>$adjusted_value);

			 $sl_inner++; 

			 }

			 

	 }



		$sl_no++; 



	}}

	echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'.$amount_grand_total_adusted.'</td><td class="bold_td bord_bott">'.$amount_grand_total.'</td></tr>';



	?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>OPD Refund Details</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="1" cellpadding="0" cellspacing="0">

              <tr>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Sl. No</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Receipt No.</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">RegID</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Patient Name</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Amount</th>

                <th width="20%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Pay Type</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Created By</th>

              </tr>

              <?php

    

		$extra_query=" AND `invoice_final_billing`.`opd_flag`='1' ";

	$amount_grand_total=0;

	 

	

	$arr=array();



	$sql3=" SELECT DISTINCT (`invoice_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_payment_billing`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' AND  `invoice_final_payment_billing`.`payment_type`='3'"; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	 

 	$sl_no=1;

	 if($count>'0'){

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  * FROM `invoice_final_billing`  WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_billing`.`del_flag`='0'   AND  `invoice_final_billing`.`id`='".$row3['distinct_proc_id']."' ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 

					 

					 $created_by="";	

			  		 $sql_creat="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['created_by']."'";

					 $result_creat=$conn->query($sql_creat) ;

					 $row_creat = $result_creat->fetch_assoc();

					 $count_creat=$result_creat->num_rows;

					 if($count_creat>0)

					 {

						$created_by=$row_creat['name'];



					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					

					

					$receipt_date='';

					$advance_bill_invoice_unique_id='';

					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`payment_type`='3' ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

								$advance_amt=$advance_amt+$row2_payment['p_value'];

						}

					}

					 

					

					$advance_refund=0; 

					

					if($advance_refund=='1'){ 

					  $print_url= ADMIN_URL.'print_refund_advance_final_bill.php?id='.$row_inner['id']; 				 

					  }else{	

						  if($row_inner['opd_flag']==1){

								  $print_url= ADMIN_URL.'print_final_bill_for_opd_new.php?id='.$row_inner['id']; 

						  }else{

							   $print_url= ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$row_inner['id'];

						  }

					  }

					  

					  echo '<tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$advance_amt.'</td><td class="defualt_td">'.$pay_mode.'</td><td class="defualt_td">'.$created_by.'</td></tr>';

					  $amount_grand_total=$amount_grand_total+$advance_amt;

			 

			 //$arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"created_by"=>$created_by,"advance_refund"=>$advance_refund);

			 $sl_inner++; 

			 }

			 

	 }



		



		$sl_no++; 



	}}

	

	

		$extra_query=" AND `refund_adavnce_final_billing`.`opd_flag`='1' ";

	 

	 

	// Refnd start

	$sql3=" SELECT DISTINCT (`refund_adavnce_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `refund_adavnce_final_payment_billing` INNER JOIN `refund_adavnce_final_billing` ON `refund_adavnce_final_payment_billing`.`i_id`=`refund_adavnce_final_billing`.`id` WHERE DATE(`refund_adavnce_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `refund_adavnce_final_payment_billing`.`del_flag`='0' AND  `refund_adavnce_final_billing`.`del_flag`='0' AND  `refund_adavnce_final_payment_billing`.`payment_type`='3'  AND  `refund_adavnce_final_billing`.`adjust_with_final_bill_flag`='0' "; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows; 



	 if($count>'0'){

			

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  * FROM `refund_adavnce_final_billing`  WHERE DATE(`refund_adavnce_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `refund_adavnce_final_billing`.`del_flag`='0'   AND  `refund_adavnce_final_billing`.`id`='".$row3['distinct_proc_id']."'  AND  `refund_adavnce_final_billing`.`adjust_with_final_bill_flag`='0'  ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 

					 

					 $created_by="";	

			  		 $sql_creat="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['created_by']."'";

					 $result_creat=$conn->query($sql_creat) ;

					 $row_creat = $result_creat->fetch_assoc();

					 $count_creat=$result_creat->num_rows;

					 if($count_creat>0)

					 {

						$created_by=$row_creat['name'];

					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/REF/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					

					

					$receipt_date='';

					$advance_bill_invoice_unique_id='';

					$sql_payment = "SELECT `refund_adavnce_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `refund_adavnce_final_payment_billing` INNER JOIN `payment_mode_masters` ON `refund_adavnce_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `refund_adavnce_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `refund_adavnce_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `refund_adavnce_final_payment_billing`.`p_key`<>'5'  AND `refund_adavnce_final_payment_billing`.`del_flag`='0'  AND `refund_adavnce_final_payment_billing`.`payment_type`='3'  AND  `refund_adavnce_final_payment_billing`.`adjust_with_final_bill_flag`='0'  ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

								$advance_amt=$advance_amt+$row2_payment['p_value'];

						}

					}

					 $advance_refund=1;

					

					 if($advance_refund=='1'){ 

					  $print_url= ADMIN_URL.'print_refund_advance_final_bill.php?id='.$row_inner['id']; 				 

					  }else{	

						  if($row_inner['opd_flag']==1){

								  $print_url= ADMIN_URL.'print_final_bill_for_opd_new.php?id='.$row_inner['id']; 

						  }else{

							   $print_url= ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$row_inner['id'];

						  }

					  }

					  

					  echo '<tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$advance_amt.'</td><td class="defualt_td">'.$pay_mode.'</td><td class="defualt_td">'.$created_by.'</td></tr>';

					  $amount_grand_total=$amount_grand_total+$advance_amt;

			 

			 //$arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"created_by"=>$created_by,"advance_refund"=>$advance_refund);

			 $sl_inner++; 

			 }

			 

	 }



		$sl_no++; 



	}}

	

	echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'.$amount_grand_total.'</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td></tr>';

	?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>IPD BILLING</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">

              <tr>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Sl No.</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Bill No. </strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>RegId</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Patient Name</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>INI</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Amount</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Discount</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Net Amt</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Advance</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Adj Adv</strong></td>                

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Refund</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Pay Type</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Due</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Party Name</strong></td>

              </tr>

              <?php 

			  $due_net_total=0;

			  $due_amt=0;

  $extra_query=" AND `invoice_final_billing`.`opd_flag`='0' ";

  $sql3=" SELECT DISTINCT (`invoice_final_procedure`.`procedure_id`) AS `distinct_proc_id` FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` INNER JOIN `procedure_masters` ON `invoice_final_procedure`.`procedure_id`=`procedure_masters`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  $extra_query AND `invoice_final_procedure`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' ORDER BY `procedure_masters`.`procedure_name` ASC "; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	$amount_grand_total=0;

	$discount_grand_total=0;

	$paid_grand_total=0;

	$advance_grand_total=0;

	$print_url="";

	 if($count>'0'){

			 $sl_no=1;

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {	

			 		

			 $procedure_name="";

			 $sql7="SELECT `procedure_name` FROM `procedure_masters` Where `id`='".$row3['distinct_proc_id']."'";

			 $result7=$conn->query($sql7) ;		

			 $row7 = $result7->fetch_assoc();

			 $count7=$result7->num_rows;

			 if($count7>0)

			 {

				$procedure_name=$row7['procedure_name'];			 

			 }



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  `invoice_final_billing`.`id`,  `invoice_final_billing`.`hospital_number`,  `invoice_final_billing`.`invo_no`,  `invoice_final_billing`.`name`,  `invoice_final_billing`.`doc_id`,  `invoice_final_billing`.`opd_flag`,  `invoice_final_billing`.`billing_date`,  `invoice_final_billing`.`discount`,  `invoice_final_billing`.`discount_type`,  `invoice_final_billing`.`total`,  `invoice_final_billing`.`del_flag`,  `invoice_final_billing`.`prefix`,`invoice_final_procedure`.`amount`  AS `procedure_amount` , `invoice_final_procedure`.`discount` AS `procedure_dicount`, `invoice_final_procedure`.`net_amount`  AS `procedure_net_amount` FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_procedure`.`del_flag`='0'  AND  `invoice_final_billing`.`del_flag`='0'  AND  `invoice_final_procedure`.`procedure_id`='".$row3['distinct_proc_id']."' ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	
			 $due_amt=0;	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					$pay_mode_ret="";

					$advance_amt_ret=0;

					

					 $sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name`,`tpa_masters`.`name` AS `tpa_company`  FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id` LEFT JOIN `tpa_masters` ON `invoice_final_payment_billing`.`tpa_name` =`tpa_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`='5'  AND `invoice_final_payment_billing`.`del_flag`='0' ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{

							$payor_name=$row2_payment['tpa_company'];						

							/*if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}*/

							

							

								$due_amt=$due_amt+$row2_payment['p_value'];

							

							

						}

					}

					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='3'  ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

							

						}

					}

					

					 $sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='0'  ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							if($row2_payment['advance_bill_invoice_no']!=''){

								$advance_amt=$advance_amt+$row2_payment['p_value'];

							}

							

						}

					}

					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`payment_type`='3'  ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode_ret==''){

								$pay_mode_ret=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode_ret=$pay_mode_ret.' , '.$row2_payment['payment_mode_name'];

							}

							

								$advance_amt_ret=$advance_amt_ret+$row2_payment['p_value'];

							

							

						}

					}

					

				

					

					$output = removeConsecutiveDuplicates($pay_mode);

					$pay_mode=$output;

					 

					 $amount=0;

					 $discount=0;

					 $net_amount=0;

					 $procedure_amount=0;

					 $procedure_dicount=0;

					 $procedure_net_amount=0;

					 

					 $procedure_amount=$row_inner['procedure_amount'];

					 $procedure_dicount=$row_inner['procedure_dicount'];

					 $procedure_net_amount=$row_inner['procedure_net_amount'];

					 

					 $amount=$procedure_amount;

					 $discount=$procedure_dicount;

					 $net_amount=$procedure_net_amount;

					 $dicount_calculate=0;

					 $dicount_calculate_int=0;

					 $dicount_calculate_per_proc=0;

					 $dicount_calculate_per_proc_int=0;

					 

					 if($row_inner['discount']!='0'){

						 if($row_inner['discount']!=''){

							$sql_discount=" SELECT  SUM(`net_amount`) AS `tot_net`,COUNT(`id`) AS `total_proc_cnt`  FROM `invoice_final_procedure` WHERE `i_id`='".$row_inner['id']."' AND `del_flag`='0'  ";  

	 						$result_discount=$conn->query($sql_discount) ;

							$row_discount = $result_discount->fetch_assoc();

							

							 if($row_inner['discount_type']=='P'){

								 	$dicount_calculate=( $row_discount['tot_net']*$row_inner['discount'])/100;

									$dicount_calculate_int=round($dicount_calculate);

									$dicount_calculate_per_proc=($dicount_calculate_int/$row_discount['total_proc_cnt']);

									$dicount_calculate_per_proc_int=round($dicount_calculate_per_proc);

							 }

							 if($row_inner['discount_type']=='F'){

									$dicount_calculate_per_proc=($row_inner['discount']/$row_discount['total_proc_cnt']);

									$dicount_calculate_per_proc_int=round($dicount_calculate_per_proc);

							 }

							 

						 }						 

					 }

					 $amount=$procedure_amount;

					 $discount=$procedure_dicount+$dicount_calculate_per_proc_int;

					 $net_amount=$procedure_net_amount-$dicount_calculate_per_proc_int;

					 

					 $amount_net_total=$amount_net_total+$amount;

					 $discount_net_total=$discount_net_total+$discount;

					 $paid_net_total=$paid_net_total+$net_amount;

					 $paid_advance_total=$paid_advance_total+$advance_amt;

					 

					 //$due_net_total=$due_net_total+$due_amt-$advance_amt_ret;

					 $due_net_total=$due_amt;

					 $adjamt=0;

					 $adjamt=$advance_amt-$advance_amt_ret;

					 //$due_amt=$due_amt-$advance_amt_ret;

					 if(($advance_amt=='0')&&($adjamt<0)){
						 $adjamt=0;
					 }

					 if($sl_inner==1){

						echo '<tr><td colspan="12" style="padding:4px;"><strong>'.$procedure_name.'</strong></td></tr>' ;

					 }

					 $print_url= ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$row_inner['id'];  

					echo ' <tr ><td class="defualt_td">'.$sl_inner.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$ini.'</td><td class="defualt_td">'.$amount.'</td><td class="defualt_td">'.$discount.'</td><td class="defualt_td">'.$net_amount.'</td><td class="defualt_td">'.$advance_amt.'</td><td class="defualt_td">'.$adjamt.'</td><td class="defualt_td">'.$advance_amt_ret.'</td><td class="defualt_td_spcl">'.$pay_mode.'</td><td class="defualt_td">'.$due_amt.'</td><td class="defualt_td_spcl">'.$payor_name.'</td></tr>';

					if($sl_inner==$count_inner){

						echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total:</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">'.$amount_net_total.'</td><td class="bold_td bord_bott">'.$discount_net_total.'</td><td class="bold_td bord_bott">'.$paid_net_total.'</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td></tr>';

					$amount_grand_total=$amount_grand_total+$amount_net_total;

					$discount_grand_total=$discount_grand_total+$discount_net_total;

					$paid_grand_total=$paid_grand_total+$paid_net_total;

					$advance_grand_total=$advance_grand_total+$paid_advance_total;

					}

			 

			 //$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"amount"=>$amount,"discount"=>$discount,"net_amount"=>$net_amount,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"amount_net_total"=>$amount_net_total,"discount_net_total"=>$discount_net_total,"paid_net_total"=>$paid_net_total,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"paid_advance_total"=>$paid_advance_total,"due_net_total"=>$due_net_total,"advance_amt_ret"=>$advance_amt_ret,"pay_mode_ret"=>$pay_mode_ret,"adjamt"=>$adjamt);

			 $sl_inner++; 

			 }

			 

	 }



		



		$sl_no++; 



	}}

	echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total IPD Billng:</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">'.$amount_grand_total.'</td><td class="bold_td bord_bott">'.$discount_grand_total.'</td><td class="bold_td bord_bott">'.$paid_grand_total.'</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td></tr>';

    ?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>IPD ADVANCE</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="1" cellpadding="0" cellspacing="0">

              <tr>

                <td width="6%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Sl No.</strong></td>

                <td width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Receipt  No. </strong></td>

                <td width="9%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>RegId</strong></td>

                <td width="24%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Patient Name</strong></td>

                <td width="9%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Amt INR</strong></td>

                <td width="8%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Pay Type</strong></td>

                <td width="9%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;"><strong>Dr. Name</strong></td>

                <td width="25%" style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Remarks</strong></td>

              </tr>

              <?php

	

		$extra_query=" AND `adavnce_final_billing`.`opd_flag`='0' ";

	

	$arr=array();

	$amount_grand_total=0;



	$sql3=" SELECT DISTINCT (`adavnce_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `adavnce_final_payment_billing` INNER JOIN `adavnce_final_billing` ON `adavnce_final_payment_billing`.`i_id`=`adavnce_final_billing`.`id` WHERE DATE(`adavnce_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `adavnce_final_payment_billing`.`del_flag`='0' AND  `adavnce_final_billing`.`del_flag`='0' "; 

	//AND `adavnce_final_payment_billing`.`adjust_with_final_bill_flag`='0'

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	 



	 if($count>'0'){

			 $sl_no=1;

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 $user_remarks="";

			 $sql7="SELECT `procedure_id` FROM `adavnce_final_procedure` Where `i_id`='".$row3['distinct_proc_id']."'";

			 $result7=$conn->query($sql7) ;		

			 $row7 = $result7->fetch_assoc();

			 $count7=$result7->num_rows;

			 if($count7>0)

			 {

				

				if($user_remarks==''){

					$user_remarks=$row7['procedure_id'];

				}else{

					$user_remarks=$user_remarks.' , '.$row7['procedure_id'];

				}			 

			 }



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  * FROM `adavnce_final_billing`  WHERE DATE(`adavnce_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `adavnce_final_billing`.`del_flag`='0'   AND  `adavnce_final_billing`.`id`='".$row3['distinct_proc_id']."' ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/RECP/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					

					

					

					$sql_payment = "SELECT `adavnce_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `adavnce_final_payment_billing` INNER JOIN `payment_mode_masters` ON `adavnce_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `adavnce_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `adavnce_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `adavnce_final_payment_billing`.`p_key`<>'5'  AND `adavnce_final_payment_billing`.`del_flag`='0'  ";

					//AND `adavnce_final_payment_billing`.`adjust_with_final_bill_flag`='0'

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

								$advance_amt=$advance_amt+$row2_payment['p_value'];

							

							

						}

					}

					 

					 $print_url= ADMIN_URL.'print_advance_final_bill.php?id='.$row_inner['id'];  

					 echo '<tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$advance_amt.'</td><td class="defualt_td">'.$pay_mode.'</td><td class="defualt_td">'.$ini.'</td><td class="defualt_td">'.$user_remarks.'</td></tr>';

					 $amount_grand_total=$amount_grand_total+$advance_amt;

					 

			 

			 //$arr[]=array("sl_no"=>$sl_no,"user_remarks"=>$user_remarks,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag']);

			 $sl_inner++; 

			 }

			 

	 }



		



		$sl_no++; 



	}}



	echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'.$amount_grand_total.'</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td></tr>';

	 ?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>IPD Adjusted Advance Details</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="1" cellpadding="0" cellspacing="0">

              <tr>

                <th width="5%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Sl. No</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Receipt No.</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">RegID</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Patient Name</th>

                <th width="12%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Receipt Date</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">BillSeriesCode</th>

                <th width="13%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Adjusted Amount</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Total Rec Amt</th>

              </tr>

              <?php

     $amount_grand_total=0;

	$amount_grand_total_adusted=0;

		$extra_query=" AND `invoice_final_billing`.`opd_flag`='0' ";

	

	$arr=array();



	$sql3=" SELECT DISTINCT (`invoice_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_payment_billing`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_invoice_unique_id`<>'' AND DATE(`invoice_final_payment_billing`.`payment_date`) NOT BETWEEN '".$from_date."' AND  '".$to_date."'"; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	 



	 if($count>'0'){

			 $sl_no=1;

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  * FROM `invoice_final_billing`  WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_billing`.`del_flag`='0'   AND  `invoice_final_billing`.`id`='".$row3['distinct_proc_id']."' ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					

					

					$receipt_date='';

					$advance_bill_invoice_unique_id='';

					//$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_invoice_unique_id`<>''  AND `invoice_final_payment_billing`.`payment_type`='2'  AND DATE(`invoice_final_payment_billing`.`payment_date`) NOT BETWEEN '".$from_date."' AND  '".$to_date."' ";
					
					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_invoice_unique_id`<>''  AND `invoice_final_payment_billing`.`payment_type`='2'  AND DATE(`invoice_final_payment_billing`.`payment_date`) NOT BETWEEN '".$from_date."' AND  '".$to_date."' ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

								$advance_amt=$advance_amt+$row2_payment['p_value'];

								$receipt_date=date("d-M-Y", strtotime($row2_payment['payment_date']));

								$advance_bill_invoice_unique_id=$row2_payment['advance_bill_invoice_unique_id'];

						}

					}
					
					
					$advance_amt_today=0;
					
					
					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_invoice_unique_id`<>''  AND `invoice_final_payment_billing`.`payment_type`='2'  AND DATE(`invoice_final_payment_billing`.`payment_date`)  BETWEEN '".$from_date."' AND  '".$to_date."' ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	

							

								$advance_amt_today=$advance_amt_today+$row2_payment['p_value'];

								

						}

					}

					

					

					$pay_mode_ref="";

					$advance_amt_ref=0;

					

					

					$receipt_date_ref='';

					$advance_bill_invoice_unique_id_ref='';

					 $sql_payment_ref = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_invoice_unique_id`<>''  AND `invoice_final_payment_billing`.`payment_type`='3' ";

					$result_payment_ref = $conn->query($sql_payment_ref);

					if($result_payment_ref->num_rows > 0){

						while ($row2_payment_ref=mysqli_fetch_array($result_payment_ref,MYSQLI_ASSOC))

						{	if($pay_mode_ref==''){

								$pay_mode_ref=$row2_payment_ref['payment_mode_name'];

							}else{

								$pay_mode_ref=$pay_mode_ref.' , '.$row2_payment_ref['payment_mode_name'];

							}

							

								$advance_amt_ref=$advance_amt_ref+$row2_payment_ref['p_value'];

								$receipt_date_ref=date("d-M-Y", strtotime($row2_payment_ref['payment_date']));

								$advance_bill_invoice_unique_id_ref=$row2_payment_ref['advance_bill_invoice_unique_id'];

						}

					}

					$adjusted_value=0;	

					if($advance_amt_ref>0){				

						$adjusted_value=($advance_amt+$advance_amt_today)-$advance_amt_ref;

					}

					

				if($row_inner['opd_flag']==1){

						  $print_url= ADMIN_URL.'print_final_bill_for_opd_new.php?id='.$row_inner['id']; 

				  }else{

					   $print_url= ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$row_inner['id'];

				  }

				  echo '<tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$receipt_date.'</td><td class="defualt_td">'.$bill_for.'</td><td class="defualt_td">'.$adjusted_value.'</td><td class="defualt_td">'.$advance_amt.'</td></tr>';

				 $amount_grand_total=$amount_grand_total+$advance_amt;

				$amount_grand_total_adusted=$amount_grand_total_adusted+$adjusted_value;

			 

			// $arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"receipt_date"=>$receipt_date,"advance_bill_invoice_unique_id"=>$advance_bill_invoice_unique_id,"adjusted_value"=>$adjusted_value);

			 $sl_inner++; 

			 }

			 

	 }



		$sl_no++; 



	}}

	echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'.$amount_grand_total_adusted.'</td><td class="bold_td bord_bott">'.$amount_grand_total.'</td></tr>';



	?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>IPD Refund Details</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="1" cellpadding="0" cellspacing="0">

              <tr>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Sl. No</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Receipt No.</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">RegID</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Patient Name</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Amount</th>

                <th width="20%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Pay Type</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Created By</th>

              </tr>

              <?php

    

		$extra_query=" AND `invoice_final_billing`.`opd_flag`='0' ";

	$amount_grand_total=0;

	 

	

	$arr=array();

	 $sl_no=1;

	$sql3=" SELECT DISTINCT (`invoice_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_payment_billing`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' AND  `invoice_final_payment_billing`.`payment_type`='3'  AND `invoice_final_payment_billing`.`advance_bill_invoice_no`='' "; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	 



	 if($count>'0'){			 

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  * FROM `invoice_final_billing`  WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_billing`.`del_flag`='0'   AND  `invoice_final_billing`.`id`='".$row3['distinct_proc_id']."' ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 

					 

					 $created_by="";	

			  		 $sql_creat="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['created_by']."'";

					 $result_creat=$conn->query($sql_creat) ;

					 $row_creat = $result_creat->fetch_assoc();

					 $count_creat=$result_creat->num_rows;

					 if($count_creat>0)

					 {

						$created_by=$row_creat['name'];

					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					

					

					$receipt_date='';

					$advance_bill_invoice_unique_id='';

					$sql_payment = "SELECT `invoice_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `invoice_final_payment_billing` INNER JOIN `payment_mode_masters` ON `invoice_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `invoice_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `invoice_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `invoice_final_payment_billing`.`p_key`<>'5'  AND `invoice_final_payment_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`payment_type`='3' ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

								$advance_amt=$advance_amt+$row2_payment['p_value'];

						}

					}

					 

					

					$advance_refund=0; 

					

					if($advance_refund=='1'){ 

					  $print_url= ADMIN_URL.'print_refund_advance_final_bill.php?id='.$row_inner['id']; 				 

					  }else{	

						  if($row_inner['opd_flag']==1){

								  $print_url= ADMIN_URL.'print_final_bill_for_opd_new.php?id='.$row_inner['id']; 

						  }else{

							   $print_url= ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$row_inner['id'];

						  }

					  }

					  

					  echo '<tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$advance_amt.'</td><td class="defualt_td">'.$pay_mode.'</td><td class="defualt_td">'.$created_by.'</td></tr>';

					  $amount_grand_total=$amount_grand_total+$advance_amt;

			 

			 //$arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"created_by"=>$created_by,"advance_refund"=>$advance_refund);

			 $sl_inner++; 

			 }

			 

	 }



		



		$sl_no++; 



	}}

	

	

		$extra_query=" AND `refund_adavnce_final_billing`.`opd_flag`='0' ";

	 

	 

	// Refnd start

	$sql3=" SELECT DISTINCT (`refund_adavnce_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `refund_adavnce_final_payment_billing` INNER JOIN `refund_adavnce_final_billing` ON `refund_adavnce_final_payment_billing`.`i_id`=`refund_adavnce_final_billing`.`id` WHERE DATE(`refund_adavnce_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `refund_adavnce_final_payment_billing`.`del_flag`='0' AND  `refund_adavnce_final_billing`.`del_flag`='0' AND  `refund_adavnce_final_payment_billing`.`payment_type`='3'  AND  `refund_adavnce_final_billing`.`adjust_with_final_bill_flag`='0' "; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows; 



	 if($count>'0'){

			 

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 



		//$arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"distinct_proc_id"=>$row3['distinct_proc_id']);

		

		 $sql_inner=" SELECT  * FROM `refund_adavnce_final_billing`  WHERE DATE(`refund_adavnce_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `refund_adavnce_final_billing`.`del_flag`='0'   AND  `refund_adavnce_final_billing`.`id`='".$row3['distinct_proc_id']."'  AND  `refund_adavnce_final_billing`.`adjust_with_final_bill_flag`='0'  ";                   



	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 $amount_net_total=0;

	 $discount_net_total=0;

	 $paid_net_total=0;

	 $paid_advance_total=0;



	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 		 $primary_doctor="";

					 $ini="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['doc_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_doctor=$row11['name'];

						$ini=$row11['username'];

					 }

					 

					 

					 $created_by="";	

			  		 $sql_creat="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_inner['created_by']."'";

					 $result_creat=$conn->query($sql_creat) ;

					 $row_creat = $result_creat->fetch_assoc();

					 $count_creat=$result_creat->num_rows;

					 if($count_creat>0)

					 {

						$created_by=$row_creat['name'];

					 }

					 if($row_inner['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

					$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

					$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

					$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

					$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row_inner['billing_date'])) , "4/1", "3/31");

					$bill_no="";

					$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/REF/'.$bill_for.'/'.$row_inner['invo_no'];

				

					 $billing_date="";	

					 $billing_date =date("d-m-Y", strtotime($row_inner['billing_date']));

					 

					 $prefix="";

					 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row_inner['prefix']."'";	

					$res_prefix=mysqli_query($conn,$sql_prefix);

					$row_prefix=mysqli_fetch_assoc($res_prefix);

					$count_prefix=$res_prefix->num_rows;

					 if($count_prefix>0)

					 {

					 $prefix=$row_prefix['prefix_name']; 

					 }

					$payor_name="SELF";

					$pay_mode="";

					$advance_amt=0;

					

					

					$receipt_date='';

					$advance_bill_invoice_unique_id='';

					$sql_payment = "SELECT `refund_adavnce_final_payment_billing`.* , `payment_mode_masters`.`payment_mode_name`,`payment_type_masters`.`payment_type_name` FROM `refund_adavnce_final_payment_billing` INNER JOIN `payment_mode_masters` ON `refund_adavnce_final_payment_billing`.`p_key` =`payment_mode_masters`.`id` INNER JOIN `payment_type_masters` ON `refund_adavnce_final_payment_billing`.`payment_type` =`payment_type_masters`.`id`  WHERE `refund_adavnce_final_payment_billing`.`i_id` = '".$row_inner['id']."' AND `refund_adavnce_final_payment_billing`.`p_key`<>'5'  AND `refund_adavnce_final_payment_billing`.`del_flag`='0'  AND `refund_adavnce_final_payment_billing`.`payment_type`='3'  AND  `refund_adavnce_final_payment_billing`.`adjust_with_final_bill_flag`='0'  ";

					$result_payment = $conn->query($sql_payment);

					if($result_payment->num_rows > 0){

						while ($row2_payment=mysqli_fetch_array($result_payment,MYSQLI_ASSOC))

						{	if($pay_mode==''){

								$pay_mode=$row2_payment['payment_mode_name'];

							}else{

								$pay_mode=$pay_mode.' , '.$row2_payment['payment_mode_name'];

							}

							

								$advance_amt=$advance_amt+$row2_payment['p_value'];

						}

					}

					 $advance_refund=1;

					

					 if($advance_refund=='1'){ 

					  $print_url= ADMIN_URL.'print_refund_advance_final_bill.php?id='.$row_inner['id']; 				 

					  }else{	

						  if($row_inner['opd_flag']==1){

								  $print_url= ADMIN_URL.'print_final_bill_for_opd_new.php?id='.$row_inner['id']; 

						  }else{

							   $print_url= ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$row_inner['id'];

						  }

					  }

					  

					  echo '<tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$row_inner['hospital_number'].'</td><td class="defualt_td">'.$prefix.' '.$row_inner['name'].'</td><td class="defualt_td">'.$advance_amt.'</td><td class="defualt_td">'.$pay_mode.'</td><td class="defualt_td">'.$created_by.'</td></tr>';

					  $amount_grand_total=$amount_grand_total+$advance_amt;

			 

			 //$arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"created_by"=>$created_by,"advance_refund"=>$advance_refund);

			 $sl_inner++; 

			 }

			 

	 }



		$sl_no++; 



	}}

	

	echo '<tr ><td class="defualt_td bord_bott">&nbsp;</td><td class="defualt_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'.$amount_grand_total.'</td><td class="bold_td bord_bott">&nbsp;</td><td class="bold_td bord_bott">&nbsp;</td></tr>';

	?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>Total Collection</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="1" cellpadding="0" cellspacing="0">

              <tr>

                <th width="20%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Payment Type</th>

                <th width="12%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Cash</th>

                <th width="12%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Card</th>

                <th width="12%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">UPI</th>

                <th width="12%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Cheque</th>

                <th width="12%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Online</th>

                <th width="20%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Grand Total</th>

              </tr>

              <?php

			  

		 $extra_query="";

	

		$amount_grand_total=0;	

		

		$total_bill_time_cash=0;

		$total_bill_time_card=0;

		$total_bill_time_upi=0;

		$total_bill_time_cheque=0;	

		$total_bill_time_online=0;

		$total_bill_time_collection=0;	

		

		

		$total_advance_time_cash=0;

		$total_advance_time_card=0;

		$total_advance_time_upi=0;

		$total_advance_time_cheque=0;	

		$total_advance_time_online=0;

		$total_advance_time_collection=0;

		

		$total_refund_time_cash=0;

		$total_refund_time_card=0;

		$total_refund_time_upi=0;

		$total_refund_time_cheque=0;

		$total_refund_time_online=0;	

		$total_refund_time_collection=0;

		

		$total_advance_time_refund_cash=0;

		$total_advance_time_refund_card=0;

		$total_advance_time_refund_upi=0;

		$total_advance_time_refund_cheque=0;

		$total_advance_time_refund_online=0;

		$total_advance_time_refund_collection=0;	

		

		$net_collecton_cash=0;

		$net_collecton_card=0;

		$net_collecton_upi=0;

		$net_collecton_cheque=0;	

		$net_collecton_online=0;

		$net_collecton_collection=0;		

		

		$grand_total=0;

		$grand_total_for_advance_time=0;

		$grand_total_for_bill_time_refund=0;

		$grand_total_for_advance_time_refund=0;

			 

	$arr=array();

	$grand_total=0;

	$sql3="SELECT * FROM `payment_type_masters` WHERE `del_flag`='0'"; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	 if($count>'0'){

		 $sl_no=1;
		 $sl_inner=1;

		 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

		 {				

			 		$pay_type_name="";

					$pay_type_name=$row3['payment_type_name'];

					//Bill Time

					$bill_time_cash="0";

					 $sql_bill_time_cash="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_cash` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='1' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='3'  $extra_query ";	

					$res_bill_time_cash=mysqli_query($conn,$sql_bill_time_cash);

					$row_bill_time_cash=mysqli_fetch_assoc($res_bill_time_cash);

					$count_bill_time_cash=$res_bill_time_cash->num_rows;

					 if($count_bill_time_cash>0)

					 {

						 if($row_bill_time_cash['bill_time_cash']>0)

					 	{

					 		$bill_time_cash=$row_bill_time_cash['bill_time_cash']; 

						}

					 }

					 

					 $bill_time_card="0";

					 $sql_bill_time_card="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_card` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='2' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='3' $extra_query ";	

					$res_bill_time_card=mysqli_query($conn,$sql_bill_time_card);

					$row_bill_time_card=mysqli_fetch_assoc($res_bill_time_card);

					$count_bill_time_card=$res_bill_time_card->num_rows;

					 if($count_bill_time_card>0)

					 {	

					 	if($row_bill_time_card['bill_time_card']>0)

					 	{

					 		$bill_time_card=$row_bill_time_card['bill_time_card']; 

						}

					 }

					 

					 $bill_time_upi="0";

					 $sql_bill_time_upi="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_upi` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='3' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='3' $extra_query ";	

					$res_bill_time_upi=mysqli_query($conn,$sql_bill_time_upi);

					$row_bill_time_upi=mysqli_fetch_assoc($res_bill_time_upi);

					$count_bill_time_upi=$res_bill_time_upi->num_rows;

					 if($count_bill_time_upi>0)

					 {	

					 	if($row_bill_time_upi['bill_time_upi']>0)

					 	{

					 		$bill_time_upi=$row_bill_time_upi['bill_time_upi']; 

						}

					 }

				

				 	$bill_time_cheque="0";

					 $sql_bill_time_cheque="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_cheque` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='4' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='3' $extra_query ";	

					$res_bill_time_cheque=mysqli_query($conn,$sql_bill_time_cheque);

					$row_bill_time_cheque=mysqli_fetch_assoc($res_bill_time_cheque);

					$count_bill_time_cheque=$res_bill_time_cheque->num_rows;

					 if($count_bill_time_cheque>0)

					 {	

					 	if($row_bill_time_cheque['bill_time_cheque']>0)

					 	{

					 		$bill_time_cheque=$row_bill_time_cheque['bill_time_cheque']; 

						}

					 }

					 

					 $bill_time_online="0";

					 $sql_bill_time_online="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_online` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='7' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_refund_flag`='3'  $extra_query ";	

					$res_bill_time_online=mysqli_query($conn,$sql_bill_time_online);

					$row_bill_time_online=mysqli_fetch_assoc($res_bill_time_online);

					$count_bill_time_online=$res_bill_time_online->num_rows;

					 if($count_bill_time_online>0)

					 {	

					 	if($row_bill_time_online['bill_time_online']>0)

					 	{

					 		$bill_time_online=$row_bill_time_online['bill_time_online']; 

						}

					 }

					 

					 

					 //Advance

					 

					 $advance_time_cash="0";

					 $sql_advance_time_cash="SELECT SUM(`adavnce_final_payment_billing`.`p_value`) AS `advance_time_cash` FROM `adavnce_final_payment_billing` INNER JOIN `adavnce_final_billing` ON `adavnce_final_payment_billing`.`i_id`=`adavnce_final_billing`.`id` WHERE `adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `adavnce_final_payment_billing`.`del_flag`='0' AND `adavnce_final_payment_billing`.`p_key`='1' AND DATE(`adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `adavnce_final_billing`.`del_flag`='0'  $extra_query ";	

					$res_advance_time_cash=mysqli_query($conn,$sql_advance_time_cash);

					$row_advance_time_cash=mysqli_fetch_assoc($res_advance_time_cash);

					$count_advance_time_cash=$res_advance_time_cash->num_rows;

					 if($count_advance_time_cash>0)

					 {

						 if($row_advance_time_cash['advance_time_cash']>0)

					 	{

					 		$advance_time_cash=$row_advance_time_cash['advance_time_cash']; 

						}

					 }

					 

					 $advance_time_card="0";

					 $sql_advance_time_card="SELECT SUM(`adavnce_final_payment_billing`.`p_value`) AS `advance_time_card` FROM `adavnce_final_payment_billing` INNER JOIN `adavnce_final_billing` ON `adavnce_final_payment_billing`.`i_id`=`adavnce_final_billing`.`id` WHERE `adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `adavnce_final_payment_billing`.`del_flag`='0' AND `adavnce_final_payment_billing`.`p_key`='2' AND DATE(`adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `adavnce_final_billing`.`del_flag`='0'  $extra_query ";

					 

					$res_advance_time_card=mysqli_query($conn,$sql_advance_time_card);

					$row_advance_time_card=mysqli_fetch_assoc($res_advance_time_card);

					$count_advance_time_card=$res_advance_time_card->num_rows;

					 if($count_advance_time_card>0)

					 {	

					 	if($row_advance_time_card['advance_time_card']>0)

					 	{

					 		$advance_time_card=$row_advance_time_card['advance_time_card']; 

						}

					 }

					 

					 $advance_time_upi="0";

					 $sql_advance_time_upi="SELECT SUM(`adavnce_final_payment_billing`.`p_value`) AS `advance_time_upi` FROM `adavnce_final_payment_billing` INNER JOIN `adavnce_final_billing` ON `adavnce_final_payment_billing`.`i_id`=`adavnce_final_billing`.`id` WHERE `adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `adavnce_final_payment_billing`.`del_flag`='0' AND `adavnce_final_payment_billing`.`p_key`='3' AND DATE(`adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `adavnce_final_billing`.`del_flag`='0'  $extra_query ";	

					$res_advance_time_upi=mysqli_query($conn,$sql_advance_time_upi);

					$row_advance_time_upi=mysqli_fetch_assoc($res_advance_time_upi);

					$count_advance_time_upi=$res_advance_time_upi->num_rows;

					 if($count_advance_time_upi>0)

					 {	

					 	if($row_advance_time_upi['advance_time_upi']>0)

					 	{

					 		$advance_time_upi=$row_advance_time_upi['advance_time_upi']; 

						}

					 }

				

				 	$advance_time_cheque="0";

					 $sql_advance_time_cheque="SELECT SUM(`adavnce_final_payment_billing`.`p_value`) AS `advance_time_cheque` FROM `adavnce_final_payment_billing` INNER JOIN `adavnce_final_billing` ON `adavnce_final_payment_billing`.`i_id`=`adavnce_final_billing`.`id` WHERE `adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `adavnce_final_payment_billing`.`del_flag`='0' AND `adavnce_final_payment_billing`.`p_key`='4' AND DATE(`adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `adavnce_final_billing`.`del_flag`='0'  $extra_query "; 

					$res_advance_time_cheque=mysqli_query($conn,$sql_advance_time_cheque);

					$row_advance_time_cheque=mysqli_fetch_assoc($res_advance_time_cheque);

					$count_advance_time_cheque=$res_advance_time_cheque->num_rows;

					 if($count_advance_time_cheque>0)

					 {	

					 	if($row_advance_time_cheque['advance_time_cheque']>0)

					 	{

					 		$advance_time_cheque=$row_advance_time_cheque['advance_time_cheque']; 

						}

					 }

					 

					 $advance_time_online="0";

					 $sql_advance_time_online="SELECT SUM(`adavnce_final_payment_billing`.`p_value`) AS `advance_time_online` FROM `adavnce_final_payment_billing` INNER JOIN `adavnce_final_billing` ON `adavnce_final_payment_billing`.`i_id`=`adavnce_final_billing`.`id` WHERE `adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `adavnce_final_payment_billing`.`del_flag`='0' AND `adavnce_final_payment_billing`.`p_key`='7' AND DATE(`adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `adavnce_final_billing`.`del_flag`='0'  $extra_query ";

					$res_advance_time_online=mysqli_query($conn,$sql_advance_time_online);

					$row_advance_time_online=mysqli_fetch_assoc($res_advance_time_online);

					$count_advance_time_online=$res_advance_time_online->num_rows;

					 if($count_advance_time_online>0)

					 {	

					 	if($row_advance_time_online['advance_time_online']>0)

					 	{

					 		$advance_time_online=$row_advance_time_online['advance_time_online']; 

						}

					 }

					 

					 

					 //Bill Time Refund

					$bill_time_refund_cash="0";

					 $sql_bill_time_refund_cash="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_refund_cash` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='1' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`advance_bill_invoice_no`='' $extra_query ";	

					$res_bill_time_refund_cash=mysqli_query($conn,$sql_bill_time_refund_cash);

					$row_bill_time_refund_cash=mysqli_fetch_assoc($res_bill_time_refund_cash);

					$count_bill_time_refund_cash=$res_bill_time_refund_cash->num_rows;

					 if($count_bill_time_refund_cash>0)

					 {

						 if($row_bill_time_refund_cash['bill_time_refund_cash']>0)

					 	{

					 		$bill_time_refund_cash=$row_bill_time_refund_cash['bill_time_refund_cash']; 

						}

					 }

					 

					 $bill_time_refund_card="0";

					 $sql_bill_time_refund_card="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_refund_card` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='2' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_invoice_no`='' $extra_query ";	

					$res_bill_time_refund_card=mysqli_query($conn,$sql_bill_time_refund_card);

					$row_bill_time_refund_card=mysqli_fetch_assoc($res_bill_time_refund_card);

					$count_bill_time_refund_card=$res_bill_time_refund_card->num_rows;

					 if($count_bill_time_refund_card>0)

					 {	

					 	if($row_bill_time_refund_card['bill_time_refund_card']>0)

					 	{

					 		$bill_time_refund_card=$row_bill_time_refund_card['bill_time_refund_card']; 

						}

					 }

					 

					 $bill_time_refund_upi="0";

					 $sql_bill_time_refund_upi="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_refund_upi` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='3' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_invoice_no`='' $extra_query ";	

					$res_bill_time_refund_upi=mysqli_query($conn,$sql_bill_time_refund_upi);

					$row_bill_time_refund_upi=mysqli_fetch_assoc($res_bill_time_refund_upi);

					$count_bill_time_refund_upi=$res_bill_time_refund_upi->num_rows;

					 if($count_bill_time_refund_upi>0)

					 {	

					 	if($row_bill_time_refund_upi['bill_time_refund_upi']>0)

					 	{

					 		$bill_time_refund_upi=$row_bill_time_refund_upi['bill_time_refund_upi']; 

						}

					 }

				

				 	$bill_time_refund_cheque="0";

					 $sql_bill_time_refund_cheque="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_refund_cheque` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='4' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_invoice_no`='' $extra_query ";	

					$res_bill_time_refund_cheque=mysqli_query($conn,$sql_bill_time_refund_cheque);

					$row_bill_time_refund_cheque=mysqli_fetch_assoc($res_bill_time_refund_cheque);

					$count_bill_time_refund_cheque=$res_bill_time_refund_cheque->num_rows;

					 if($count_bill_time_refund_cheque>0)

					 {	

					 	if($row_bill_time_refund_cheque['bill_time_refund_cheque']>0)

					 	{

					 		$bill_time_refund_cheque=$row_bill_time_refund_cheque['bill_time_refund_cheque']; 

						}

					 }

					 

					 $bill_time_refund_online="0";

					 $sql_bill_time_refund_online="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_refund_online` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='7' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  AND `invoice_final_payment_billing`.`advance_bill_invoice_no`='' $extra_query ";	

					$res_bill_time_refund_online=mysqli_query($conn,$sql_bill_time_refund_online);

					$row_bill_time_refund_online=mysqli_fetch_assoc($res_bill_time_refund_online);

					$count_bill_time_refund_online=$res_bill_time_refund_online->num_rows;

					 if($count_bill_time_refund_online>0)

					 {	

					 	if($row_bill_time_refund_online['bill_time_refund_online']>0)

					 	{

					 		$bill_time_refund_online=$row_bill_time_refund_online['bill_time_refund_online']; 

						}

					 }

					 

					 

					 //Advance Time Refund

					 

					 $advance_time_refund_cash="0";

					 $sql_advance_time_refund_cash="SELECT SUM(`refund_adavnce_final_payment_billing`.`p_value`) AS `advance_time_refund_cash` FROM `refund_adavnce_final_payment_billing` INNER JOIN `refund_adavnce_final_billing` ON `refund_adavnce_final_payment_billing`.`i_id`=`refund_adavnce_final_billing`.`id` WHERE `refund_adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `refund_adavnce_final_payment_billing`.`del_flag`='0' AND `refund_adavnce_final_payment_billing`.`p_key`='1' AND DATE(`refund_adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `refund_adavnce_final_billing`.`del_flag`='0'  $extra_query ";	

					$res_advance_time_refund_cash=mysqli_query($conn,$sql_advance_time_refund_cash);

					$row_advance_time_refund_cash=mysqli_fetch_assoc($res_advance_time_refund_cash);

					$count_advance_time_refund_cash=$res_advance_time_refund_cash->num_rows;

					 if($count_advance_time_refund_cash>0)

					 {

						 if($row_advance_time_refund_cash['advance_time_refund_cash']>0)

					 	{

					 		$advance_time_refund_cash=$row_advance_time_refund_cash['advance_time_refund_cash']; 

						}

					 }

					 

					 $advance_time_refund_card="0";

					 $sql_advance_time_refund_card="SELECT SUM(`refund_adavnce_final_payment_billing`.`p_value`) AS `advance_time_refund_card` FROM `refund_adavnce_final_payment_billing` INNER JOIN `refund_adavnce_final_billing` ON `refund_adavnce_final_payment_billing`.`i_id`=`refund_adavnce_final_billing`.`id` WHERE `refund_adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `refund_adavnce_final_payment_billing`.`del_flag`='0' AND `refund_adavnce_final_payment_billing`.`p_key`='2' AND DATE(`refund_adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `refund_adavnce_final_billing`.`del_flag`='0'  $extra_query ";						 

					$res_advance_time_refund_card=mysqli_query($conn,$sql_advance_time_refund_card);

					$row_advance_time_refund_card=mysqli_fetch_assoc($res_advance_time_refund_card);

					$count_advance_time_refund_card=$res_advance_time_refund_card->num_rows;

					 if($count_advance_time_refund_card>0)

					 {	

					 	if($row_advance_time_refund_card['advance_time_refund_card']>0)

					 	{

					 		$advance_time_refund_card=$row_advance_time_refund_card['advance_time_refund_card']; 

						}

					 }

					 

					 $advance_time_refund_upi="0";

					 $sql_advance_time_refund_upi="SELECT SUM(`refund_adavnce_final_payment_billing`.`p_value`) AS `advance_time_refund_upi` FROM `refund_adavnce_final_payment_billing` INNER JOIN `refund_adavnce_final_billing` ON `refund_adavnce_final_payment_billing`.`i_id`=`refund_adavnce_final_billing`.`id` WHERE `refund_adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `refund_adavnce_final_payment_billing`.`del_flag`='0' AND `refund_adavnce_final_payment_billing`.`p_key`='3' AND DATE(`refund_adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `refund_adavnce_final_billing`.`del_flag`='0'  $extra_query ";

					$res_advance_time_refund_upi=mysqli_query($conn,$sql_advance_time_refund_upi);

					$row_advance_time_refund_upi=mysqli_fetch_assoc($res_advance_time_refund_upi);

					$count_advance_time_refund_upi=$res_advance_time_refund_upi->num_rows;

					 if($count_advance_time_refund_upi>0)

					 {	

					 	if($row_advance_time_refund_upi['advance_time_refund_upi']>0)

					 	{

					 		$advance_time_refund_upi=$row_advance_time_refund_upi['advance_time_refund_upi']; 

						}

					 }

				

				 	$advance_time_refund_cheque="0";

					 $sql_advance_time_refund_cheque="SELECT SUM(`refund_adavnce_final_payment_billing`.`p_value`) AS `advance_time_refund_cheque` FROM `refund_adavnce_final_payment_billing` INNER JOIN `refund_adavnce_final_billing` ON `refund_adavnce_final_payment_billing`.`i_id`=`refund_adavnce_final_billing`.`id` WHERE `refund_adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `refund_adavnce_final_payment_billing`.`del_flag`='0' AND `refund_adavnce_final_payment_billing`.`p_key`='4' AND DATE(`refund_adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `refund_adavnce_final_billing`.`del_flag`='0'  $extra_query ";

					$res_advance_time_refund_cheque=mysqli_query($conn,$sql_advance_time_refund_cheque);

					$row_advance_time_refund_cheque=mysqli_fetch_assoc($res_advance_time_refund_cheque);

					$count_advance_time_refund_cheque=$res_advance_time_refund_cheque->num_rows;

					 if($count_advance_time_refund_cheque>0)

					 {	

					 	if($row_advance_time_refund_cheque['advance_time_refund_cheque']>0)

					 	{

					 		$advance_time_refund_cheque=$row_advance_time_refund_cheque['advance_time_refund_cheque']; 

						}

					 }

					 

					 $advance_time_refund_online="0";

					 $sql_advance_time_refund_online="SELECT SUM(`refund_adavnce_final_payment_billing`.`p_value`) AS `advance_time_refund_online` FROM `refund_adavnce_final_payment_billing` INNER JOIN `refund_adavnce_final_billing` ON `refund_adavnce_final_payment_billing`.`i_id`=`refund_adavnce_final_billing`.`id` WHERE `refund_adavnce_final_payment_billing`.`payment_type`='".$row3['id']."' AND `refund_adavnce_final_payment_billing`.`del_flag`='0' AND `refund_adavnce_final_payment_billing`.`p_key`='7' AND DATE(`refund_adavnce_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `refund_adavnce_final_billing`.`del_flag`='0'  $extra_query ";

					$res_advance_time_refund_online=mysqli_query($conn,$sql_advance_time_refund_online);

					$row_advance_time_refund_online=mysqli_fetch_assoc($res_advance_time_refund_online);

					$count_advance_time_refund_online=$res_advance_time_refund_online->num_rows;

					 if($count_advance_time_refund_online>0)

					 {	

					 	if($row_advance_time_refund_online['advance_time_refund_online']>0)

					 	{

					 		$advance_time_refund_online=$row_advance_time_refund_online['advance_time_refund_online']; 

						}

					 }

					 

					 $grand_total=$bill_time_cash+$bill_time_card+$bill_time_upi+$bill_time_cheque+$bill_time_online;

					 

					 $grand_total_for_advance_time=$advance_time_cash+$advance_time_card+$advance_time_upi+$advance_time_cheque+$advance_time_online;

					 

					 $grand_total_for_bill_time_refund=$bill_time_refund_cash+$bill_time_refund_card+$bill_time_refund_upi+$bill_time_refund_cheque+$bill_time_refund_online;

					 $grand_total_for_advance_time_refund=$advance_time_refund_cash+$advance_time_refund_card+$advance_time_refund_upi+$advance_time_refund_cheque+$advance_time_refund_online;

					 

					 //echo '<tr ><td class="bold_td">'.$pay_type_name.'</td><td class="bold_td">'.$bill_time_cash.'</td><td class="bold_td">'.$bill_time_card.'</td><td class="bold_td">'.$bill_time_upi.'</td><td class="bold_td">'.$bill_time_cheque.'</td><td class="bold_td">'.$bill_time_online.'</td><td class="bold_td">'.$grand_total.'</td></tr>';

					 

					 $bill_tpe_unique_id=$row3['id'];

					 

					if($bill_tpe_unique_id=='1'){					 

						 $total_bill_time_cash=$bill_time_cash;

						 $total_bill_time_card=$bill_time_card;

						 $total_bill_time_upi=$bill_time_upi;

						 $total_bill_time_cheque=$bill_time_cheque;	

						 $total_bill_time_online=$bill_time_online;	

						 $total_bill_time_collection=$grand_total;	

						  echo '<tr ><td class="bold_td">'.$pay_type_name.'</td><td class="bold_td">'.$bill_time_cash.'</td><td class="bold_td">'.$bill_time_card.'</td><td class="bold_td">'.$bill_time_upi.'</td><td class="bold_td">'.$bill_time_cheque.'</td><td class="bold_td">'.$bill_time_online.'</td><td class="bold_td">'.$grand_total.'</td></tr>';

					}

					if($bill_tpe_unique_id=='2'){					 

						 $total_advance_time_cash=$advance_time_cash;

						 $total_advance_time_card=$advance_time_card;

						 $total_advance_time_upi=$advance_time_upi;

						 $total_advance_time_cheque=$advance_time_cheque;	

						 $total_advance_time_online=$advance_time_online;

						 $total_advance_time_collection=$grand_total_for_advance_time;

						  echo '<tr ><td class="bold_td">'.$pay_type_name.'</td><td class="bold_td">'.$advance_time_cash.'</td><td class="bold_td">'.$advance_time_card.'</td><td class="bold_td">'.$advance_time_upi.'</td><td class="bold_td">'.$advance_time_cheque.'</td><td class="bold_td">'.$advance_time_online.'</td><td class="bold_td">'.$grand_total_for_advance_time.'</td></tr>';	

					}

					if($bill_tpe_unique_id=='3'){					 

						$total_refund_time_cash=$bill_time_refund_cash;

						 $total_refund_time_card=$bill_time_refund_card;

						 $total_refund_time_upi=$bill_time_refund_upi;

						 $total_refund_time_cheque=$bill_time_refund_cheque;	

						 $total_refund_time_online=$bill_time_refund_online;

						 $total_refund_time_collection=$grand_total_for_bill_time_refund;	

						 

						 $total_advance_time_refund_cash=$advance_time_refund_cash;

						 $total_advance_time_refund_card=$advance_time_refund_card;

						 $total_advance_time_refund_upi=$advance_time_refund_upi;

						 $total_advance_time_refund_cheque=$advance_time_refund_cheque;	

						 $total_advance_time_refund_online=$advance_time_refund_online;

						 $total_advance_time_refund_collection=$grand_total_for_advance_time_refund;						 

						 

						  echo '<tr ><td class="bold_td">'.$pay_type_name.'</td><td class="bold_td">'.($bill_time_refund_cash+$advance_time_refund_cash).'</td><td class="bold_td">'.($bill_time_refund_card+$advance_time_refund_card).'</td><td class="bold_td">'.($bill_time_refund_upi+$advance_time_refund_upi).'</td><td class="bold_td">'.($bill_time_refund_cheque+$advance_time_refund_cheque).'</td><td class="bold_td">'.($bill_time_refund_online+$advance_time_refund_online).'</td><td class="bold_td">'.($grand_total_for_bill_time_refund+$grand_total_for_advance_time_refund).'</td></tr>';

					}

					

					$amount_grand_total=$amount_grand_total+$grand_total;

			 

			// $arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"pay_type_name"=>$pay_type_name,"bill_time_cash"=>$bill_time_cash,"bill_time_card"=>$bill_time_card,"bill_time_upi"=>$bill_time_upi,"bill_time_cheque"=>$bill_time_cheque,"grand_total"=>$grand_total,"bill_tpe_unique_id"=>$row3['id']);

			 $sl_inner++; 

			 



			



		$sl_no++; 



	}}

	$net_collecton_cash=($total_bill_time_cash+$total_advance_time_cash)-($total_refund_time_cash+$total_advance_time_refund_cash);

	$net_collecton_card=($total_bill_time_card+$total_advance_time_card)-($total_refund_time_card+$total_advance_time_refund_card);

	$net_collecton_upi=($total_bill_time_upi+$total_advance_time_upi)-($total_refund_time_upi+$total_advance_time_refund_upi);

	$net_collecton_cheque=($total_bill_time_cheque+$total_advance_time_cheque)-($total_refund_time_cheque+$total_advance_time_refund_cheque);	

	$net_collecton_online=($total_bill_time_online+$total_advance_time_online)-($total_refund_time_online+$total_advance_time_refund_online);

	$net_collecton_collection=($total_bill_time_collection+$total_advance_time_collection)-($total_refund_time_collection+$total_advance_time_refund_collection);

	

	echo '<tr ><td class="bold_td_big">Total Collection</td><td class="bold_td_big">'.$net_collecton_cash.'</td><td class="bold_td_big">'.$net_collecton_card.'</td><td class="bold_td_big">'.$net_collecton_upi.'</td><td class="bold_td_big">'.$net_collecton_cheque.'</td><td class="bold_td_big">'.$net_collecton_online.'</td><td class="bold_td_big">'.$net_collecton_collection.'</td></tr>';

			 

			  ?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>Procedure Statistics</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="1" cellpadding="0" cellspacing="0">

              <tr>

                <th width="30%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Particulars</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">Total</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">N</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">C</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">W</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">P_Amt</th>

                <th width="15%" style="border-bottom:2px solid #000000; padding:4px; text-align:center; border-right:1px solid #000;">W_Amt</th>

              </tr>

              <tr>

                <th colspan="7" style=" padding:4px 8px;" >OPD Billing</th>

              </tr>

              <?php

		

		$extra_query=" AND `invoice_final_billing`.`opd_flag`='1' ";

	 

	$arr=array();

	$total_grand_total=0;

	$n_grand_total=0;

	$c_grand_total=0;

	$w_grand_total=0;

	$p_amount_grand_total=0;	

	$w_amount_grand_total=0;	



	 $sql3=" SELECT DISTINCT (`invoice_final_procedure`.`procedure_id`) AS `distinct_proc_id` FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` INNER JOIN `procedure_masters` ON `invoice_final_procedure`.`procedure_id`=`procedure_masters`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_procedure`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' ORDER BY `procedure_masters`.`procedure_name` ASC "; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;



	 if($count>'0'){

			 $sl_no=1;

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 $procedure_name="";

			 $sql7="SELECT `procedure_name` FROM `procedure_masters` Where `id`='".$row3['distinct_proc_id']."'";

			 $result7=$conn->query($sql7) ;		

			 $row7 = $result7->fetch_assoc();

			 $count7=$result7->num_rows;

			 if($count7>0)

			 {

				$procedure_name=$row7['procedure_name'];			 

			 }



		

			$total_count_procedure=0;	

			$total_normal_count_procedure=0;

			$total_concession_count_procedure=0;

			$total_waived_count_procedure=0;

			$total_p_amt_count_procedure=0;

			$total_w_amt_count_procedure=0;	 

					 

			 $sql_discount=" SELECT `invoice_final_procedure`.* FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_procedure`.`procedure_id`='".$row3['distinct_proc_id']."' AND `invoice_final_procedure`.`del_flag`='0' AND DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND  `invoice_final_billing`.`del_flag`='0' $extra_query ";  

			$result_discount=$conn->query($sql_discount) ;

			while ($row_discount=mysqli_fetch_array($result_discount,MYSQLI_ASSOC))

			 {		

			 	$total_count_procedure++;

				if($row_discount['net_amount']=='0'){

					$total_waived_count_procedure++;

					$total_w_amt_count_procedure=$total_w_amt_count_procedure+$row_discount['amount'];

				}else{

					if($row_discount['discount']=='0'){

						$total_normal_count_procedure++;

						$total_p_amt_count_procedure=$total_p_amt_count_procedure+$row_discount['net_amount'];

					}else{

						$total_concession_count_procedure++;

						$total_w_amt_count_procedure=$total_w_amt_count_procedure+$row_discount['discount'];

						$total_p_amt_count_procedure=$total_p_amt_count_procedure+$row_discount['net_amount'];

					}

				}

				

				

			 }

			 echo '<tr ><td class="defualt_td">'.$procedure_name.'</td><td class="defualt_td">'.$total_count_procedure.'</td><td class="defualt_td">'.$total_normal_count_procedure.'</td><td class="defualt_td">'.$total_concession_count_procedure.'</td><td class="defualt_td">'.$total_waived_count_procedure.'</td><td class="defualt_td">'.$total_p_amt_count_procedure.'</td><td class="defualt_td">'.$total_w_amt_count_procedure.'</td></tr>';

			 

			 $total_grand_total=$total_grand_total+$total_count_procedure;

			$n_grand_total=$n_grand_total+$total_normal_count_procedure;

			$c_grand_total=$c_grand_total+$total_concession_count_procedure;

			$w_grand_total=$w_grand_total+$total_waived_count_procedure;

			$p_amount_grand_total=$p_amount_grand_total+$total_p_amt_count_procedure;

			$w_amount_grand_total=$w_amount_grand_total+$total_w_amt_count_procedure;

			 

			 

			 //$arr[]=array("procedure_name"=>$procedure_name,"total_count_procedure"=>$total_count_procedure,"total_normal_count_procedure"=>$total_normal_count_procedure,"total_concession_count_procedure"=>$total_concession_count_procedure,"total_waived_count_procedure"=>$total_waived_count_procedure,"total_p_amt_count_procedure"=>$total_p_amt_count_procedure,"total_w_amt_count_procedure"=>$total_w_amt_count_procedure);

			 



	}}

	echo '<tr ><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'.$total_grand_total.'</td><td class="bold_td bord_bott">'.$n_grand_total.'</td><td class="bold_td bord_bott">'.$c_grand_total.'</td><td class="bold_td bord_bott">'.$w_grand_total.'</td><td class="bold_td bord_bott">'.$p_amount_grand_total.'</td><td class="bold_td bord_bott">'.$w_amount_grand_total.'</td></tr>';

	?>

              <tr>

                <th colspan="7" style=" padding:4px 8px;" >&nbsp;</th>

              </tr>

              <tr>

                <th colspan="7" style=" padding:4px 8px;" >IPD Billing</th>

              </tr>

              <?php

		

		$extra_query=" AND `invoice_final_billing`.`opd_flag`='0' ";

	 

	$arr=array();

	$total_grand_total=0;

	$n_grand_total=0;

	$c_grand_total=0;

	$w_grand_total=0;

	$p_amount_grand_total=0;	

	$w_amount_grand_total=0;	



	 $sql3=" SELECT DISTINCT (`invoice_final_procedure`.`procedure_id`) AS `distinct_proc_id` FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` INNER JOIN `procedure_masters` ON `invoice_final_procedure`.`procedure_id`=`procedure_masters`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_procedure`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' ORDER BY `procedure_masters`.`procedure_name` ASC "; 

	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;



	 if($count>'0'){

			 $sl_no=1;

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {				

			 $procedure_name="";

			 $sql7="SELECT `procedure_name` FROM `procedure_masters` Where `id`='".$row3['distinct_proc_id']."'";

			 $result7=$conn->query($sql7) ;		

			 $row7 = $result7->fetch_assoc();

			 $count7=$result7->num_rows;

			 if($count7>0)

			 {

				$procedure_name=$row7['procedure_name'];			 

			 }



		

			$total_count_procedure=0;	

			$total_normal_count_procedure=0;

			$total_concession_count_procedure=0;

			$total_waived_count_procedure=0;

			$total_p_amt_count_procedure=0;

			$total_w_amt_count_procedure=0;	 

					 

			 $sql_discount=" SELECT `invoice_final_procedure`.* FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_procedure`.`procedure_id`='".$row3['distinct_proc_id']."' AND `invoice_final_procedure`.`del_flag`='0' AND DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND  `invoice_final_billing`.`del_flag`='0' $extra_query ";  

			$result_discount=$conn->query($sql_discount) ;

			while ($row_discount=mysqli_fetch_array($result_discount,MYSQLI_ASSOC))

			 {		

			 	$total_count_procedure++;

				if($row_discount['net_amount']=='0'){

					$total_waived_count_procedure++;

					$total_w_amt_count_procedure=$total_w_amt_count_procedure+$row_discount['amount'];

				}else{

					if($row_discount['discount']=='0'){

						$total_normal_count_procedure++;

						$total_p_amt_count_procedure=$total_p_amt_count_procedure+$row_discount['net_amount'];

					}else{

						$total_concession_count_procedure++;

						$total_w_amt_count_procedure=$total_w_amt_count_procedure+$row_discount['discount'];

						$total_p_amt_count_procedure=$total_p_amt_count_procedure+$row_discount['net_amount'];

					}

				}

				

				

			 }

			 echo '<tr ><td class="defualt_td">'.$procedure_name.'</td><td class="defualt_td">'.$total_count_procedure.'</td><td class="defualt_td">'.$total_normal_count_procedure.'</td><td class="defualt_td">'.$total_concession_count_procedure.'</td><td class="defualt_td">'.$total_waived_count_procedure.'</td><td class="defualt_td">'.$total_p_amt_count_procedure.'</td><td class="defualt_td">'.$total_w_amt_count_procedure.'</td></tr>';

			 

			 $total_grand_total=$total_grand_total+$total_count_procedure;

			$n_grand_total=$n_grand_total+$total_normal_count_procedure;

			$c_grand_total=$c_grand_total+$total_concession_count_procedure;

			$w_grand_total=$w_grand_total+$total_waived_count_procedure;

			$p_amount_grand_total=$p_amount_grand_total+$total_p_amt_count_procedure;

			$w_amount_grand_total=$w_amount_grand_total+$total_w_amt_count_procedure;

			 

			 

			 //$arr[]=array("procedure_name"=>$procedure_name,"total_count_procedure"=>$total_count_procedure,"total_normal_count_procedure"=>$total_normal_count_procedure,"total_concession_count_procedure"=>$total_concession_count_procedure,"total_waived_count_procedure"=>$total_waived_count_procedure,"total_p_amt_count_procedure"=>$total_p_amt_count_procedure,"total_w_amt_count_procedure"=>$total_w_amt_count_procedure);

			 



	}}

	echo '<tr ><td class="bold_td bord_bott">Total :</td><td class="bold_td bord_bott">'.$total_grand_total.'</td><td class="bold_td bord_bott">'.$n_grand_total.'</td><td class="bold_td bord_bott">'.$c_grand_total.'</td><td class="bold_td bord_bott">'.$w_grand_total.'</td><td class="bold_td bord_bott">'.$p_amount_grand_total.'</td><td class="bold_td bord_bott">'.$w_amount_grand_total.'</td></tr>';

	?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="3" style="border: 2px solid #333; padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td style="border-bottom:2px solid #000000; padding:4px; font-size:13pt"><strong>TPA Recovery</strong></td>

        </tr>

        <tr>

          <td><table width="100%" border="1" cellpadding="0" cellspacing="0">

              <tr>

                <th width="5%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Sl No.</th>

                <th width="5%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">RegID</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Patient Name</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Bill No.</th>

                <th width="7%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Insur. Amt</th>

                <th width="7%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Adjusted Amt.</th>

                <th width="7%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">TDS</th>

                <th width="7%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Discount</th>

                <th width="7%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Tpa <br/>Recovery<br/>Due</th>

                <th width="7%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Cl_Date</th>

                <th width="14%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Party Name</th>

                <th width="10%" style="border-bottom:2px solid #000000; padding:2px; text-align:center; border-right:1px solid #000;">Remarks</th>

              </tr>

              <?php

			  

		$extra_query=" AND `invoice_final_billing`.`opd_flag`='0' ";

		$net_amt_grand_total=0;

		$recovery_grand_total=0;

		$tds_grand_total=0;

		$discount_tpa_grand_total=0;

		$tpa_recovery_due_grand_total=0;

		$total_tpa_amount_grand_total=0;	

		$print_url="";

		$extra_info="";



	//$sql3=" SELECT `invoice_final_billing`.*,`invoice_final_payment_billing`.`p_key`, `invoice_final_payment_billing`.`p_value`,`invoice_final_payment_billing`.`id` AS `payment_unique_id` , `invoice_final_payment_billing`.`due_recieved_flag` , `invoice_final_payment_billing`.`due_recieved_date`,`invoice_final_payment_billing`.`payment_date`, `invoice_final_payment_billing`.`recovery_amt`, `invoice_final_payment_billing`.`tds`, `invoice_final_payment_billing`.`discount_tpa`, `invoice_final_payment_billing`.`tpa_recovery_due`, `invoice_final_payment_billing`.`total_tpa`, `invoice_final_payment_billing`.`remarks_tpa`,`tpa_masters`.`name` AS `tpa_company` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id`  LEFT JOIN `tpa_masters` ON `invoice_final_payment_billing`.`tpa_name` =`tpa_masters`.`id`  WHERE DATE(`invoice_final_payment_billing`.`accounts_entry_date`)  BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_payment_billing`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='5'  "; 
	
$sql3=" SELECT `invoice_final_part_payment_tpa`.*,`invoice_final_billing`.`opd_flag`, `invoice_final_billing`.`invo_no` , `invoice_final_billing`.`billing_date`, `invoice_final_billing`.`prefix` , `invoice_final_billing`.`name`,`invoice_final_billing`.`hospital_number`, `invoice_final_payment_billing`.`p_value`,`tpa_masters`.`name` AS `tpa_company` FROM `invoice_final_part_payment_tpa` INNER JOIN `invoice_final_billing` ON `invoice_final_part_payment_tpa`.`bill_unique_id`=`invoice_final_billing`.`id`  INNER JOIN `invoice_final_payment_billing` ON `invoice_final_part_payment_tpa`.`payment_unique_id`=`invoice_final_payment_billing`.`id` INNER JOIN `tpa_masters` ON `invoice_final_payment_billing`.`tpa_name` =`tpa_masters`.`id`  WHERE DATE(`invoice_final_part_payment_tpa`.`accounts_entry_date`)  BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_part_payment_tpa`.`del_flag`='0' AND `invoice_final_payment_billing`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='5'  "; 
	 $result3=$conn->query($sql3) ;

	 $count=$result3->num_rows;

	 



	 if($count>'0'){

			 $sl_no=1;

			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

			 {

				 $primary_doctor="";

					

					 if($row3['opd_flag']==1){

						$bill_for='OPD';

					}else{

						$bill_for='IPD';

					}	

				 $sql_hospital_info="SELECT * FROM `hospital_info_masters`";	

				$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));

				$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);	

				$m_f_year = calculateFiscalYearForDate(date("m/d/y", strtotime($row3['billing_date'])) , "4/1", "3/31");

				$bill_no="";

				$bill_no=$row_hospital_info['hos_short_code'].'/'.$m_f_year.'/'.$bill_for.'/'.$row3['invo_no'];

				$billing_date="";	

				//$billing_date =date("d-m-Y", strtotime($row3['billing_date']));

				//$payment_date =date("d-m-Y", strtotime($row3['payment_date']));

				$prefix="";

				 $sql_prefix="SELECT * FROM `prefix_masters` WHERE `id`='".$row3['prefix']."'";	

				$res_prefix=mysqli_query($conn,$sql_prefix);

				$row_prefix=mysqli_fetch_assoc($res_prefix);

				$count_prefix=$res_prefix->num_rows;

				 if($count_prefix>0)

				 {

				 $prefix=$row_prefix['prefix_name']; 

				 }

				 $patient_name=$prefix.' '.$row3['name'];

				 $net_amt=$row3['p_value'];

				 $hospital_number=$row3['hospital_number'];

				 $id=$row3['bill_unique_id'];

				 

				 $due_recieved_date='';

				 if($row3['due_recieved_date']!=''){

					 $due_recieved_date=date("d-m-Y", strtotime($row3['due_recieved_date']));

				 }

				 $recovery_amt='';

				 if($row3['recovery_amt']!=''){

				 	$recovery_amt=$row3['recovery_amt'];

				 }				 

				 $tds='';

				 if($row3['tds']!=''){

				 	$tds=$row3['tds'];

				 }				 

				 $discount_tpa='';

				 if($row3['discount_tpa']!=''){

				 	$discount_tpa=$row3['discount_tpa'];

				 }	

				  $tpa_recovery_due='';

				 if($row3['tpa_recovery_due']!=''){

				 	$tpa_recovery_due=$row3['tpa_recovery_due'];

				 }	

				 $total_tpa='';

				 if($row3['total_tpa']!=''){

				 	$total_tpa=$row3['total_tpa'];

				 }

				 $remarks_tpa='';

				 if($row3['remarks_tpa']!=''){

				 	$remarks_tpa=$row3['remarks_tpa'];

				 }

				 $tpa_company=$row3['tpa_company'];

				 

				  $print_url= ADMIN_URL.'print_final_bill_for_ipd_new.php?id='.$id;

				

				 echo '<tr ><td class="defualt_td">'.$sl_no.'</td><td class="defualt_td">'.$hospital_number.'</td><td class="defualt_td">'.$patient_name.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Bill Print" style="color:#0a5595 !important;">'.$bill_no.'</a></td><td class="defualt_td">'.$net_amt.'</td><td class="defualt_td">'.$recovery_amt.'</td><td class="defualt_td">'.$tds.'</td><td class="defualt_td">'.$discount_tpa.'</td><td class="defualt_td">'.$tpa_recovery_due.'</td><td class="defualt_td">'.$due_recieved_date.'</td><td class="defualt_td">'.$tpa_company.'</td><td class="defualt_td">'.$remarks_tpa.'</td></tr>';	

				 

				// $arr[]=array("sl_no"=>$sl_no,"id"=>$id,"bill_no"=>$bill_no,"hospital_number"=>$hospital_number,"payment_date"=>$payment_date,"billing_date"=>$billing_date,"patient_name"=>$patient_name,"primary_doctor"=>$primary_doctor,"net_amt"=>$net_amt,"payment_unique_id"=>$payment_unique_id,"due_recieved_flag"=>$due_recieved_flag,"due_recieved_date"=>$due_recieved_date,"recovery_amt"=>$recovery_amt,"tds"=>$tds,"discount_tpa"=>$discount_tpa,"total_tpa"=>$total_tpa,"remarks_tpa"=>$remarks_tpa,"title_span"=>$title_span,"tpa_company"=>$tpa_company);

			 $sl_no++; 

			 

			

			 

	}}

		

			  ?>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td colspan="3">&nbsp;</td>

  </tr>

</table>

</body>

<script>

window.print();

</script>

</html>

