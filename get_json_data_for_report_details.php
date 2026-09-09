<?php
include 'function.php';
include "conn.php";

//$_SESSION["department_id"]=8;

/*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/


$flag=$_GET["flag"];

if($flag=="1"){		
	load_opd_billing_details();	
}
else if($flag=="2"){	
	load_ipd_billing_details();	
}
else if($flag=="3"){	
	load_opd_advance_billing_details();	
}
else if($flag=="4"){	
	load_opd_advance_adjusted_billing_details();	
}
else if($flag=="5"){	
	load_opd_refund_billing_details();	
}
else if($flag=="6"){	
	total_collection_billing_details();	
}else if($flag=="7"){	
	prcedure_wise_count_details();	
}
else if($flag=="8"){	
	tpa_entry_details();	
}else if($flag=="9"){	
	tpa_recovery_details();	
}
else if($flag=="10"){	
	opd_patient_report();	
}
else{
	echo "Flag  Not Selected";	
}

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

function load_opd_billing_details(){global $conn;

$from_date = date("Y-m-d", strtotime($_POST['from_date']));
$to_date   = date("Y-m-d", strtotime($_POST['to_date']));
$doc_id    = $_POST['doc_id'];

$bill_type = $_POST['bill_type'];

if ($bill_type == '3') {
    $extra_query = "";
} else {
    $extra_query = " AND `invoice_final_billing`.`opd_flag`='" . $bill_type . "' ";
}

if ($bill_type == 1) {
    $bill_for_til = 'OPD';
} else {
    $bill_for_til = 'IPD';
}

$doc_title = "";
$doc_query = "";

$primary_doctor = "";
$ini = "";

if ($doc_id != '0') {

    $sql36 = "
        SELECT 
            `user_infos`.`name`,
            `users`.`username`
        FROM `user_infos`
        INNER JOIN `users`
            ON `user_infos`.`users_id` = `users`.`id`
        WHERE `user_infos`.`users_id` = '" . $doc_id . "'
    ";

    $result36 = $conn->query($sql36);

    if ($result36 && $result36->num_rows > 0) {

        $row36 = $result36->fetch_assoc();

        $primary_doctor = $row36['name'];
        $ini = $row36['username'];
    }

    $doc_title = " - " . $primary_doctor;

    $doc_query = " AND `invoice_final_billing`.`doc_id`='" . $doc_id . "' ";
}

$title_span = "Pushpanjali collection Reports MIS From "
    . date("d-M-Y", strtotime($_POST['from_date']))
    . " To "
    . date("d-M-Y", strtotime($_POST['to_date']))
    . ' For '
    . $bill_for_til
    . ' Billing'
    . $doc_title;

$arr = array();

$due_net_total = 0;
$due_amt = 0;

$amount_grand_total = 0;
$discount_grand_total = 0;
$paid_grand_total = 0;
$advance_grand_total = 0;

$print_url = "";


/*
|--------------------------------------------------------------------------
| LOAD HOSPITAL INFORMATION ONLY ONCE
|--------------------------------------------------------------------------
*/

$hospital_short_code = "";

$sql_hospital_info = "
    SELECT `hos_short_code`
    FROM `hospital_info_masters`
    LIMIT 1
";

$res_hospital_info = mysqli_query($conn, $sql_hospital_info);

if ($res_hospital_info && mysqli_num_rows($res_hospital_info) > 0) {

    $row_hospital_info = mysqli_fetch_assoc($res_hospital_info);

    $hospital_short_code = $row_hospital_info['hos_short_code'];
}


/*
|--------------------------------------------------------------------------
| GET DISTINCT PROCEDURES
|
| Procedure name is already joined here.
| So sql7 is removed.
|--------------------------------------------------------------------------
*/

$sql3 = "
    SELECT DISTINCT
        `invoice_final_procedure`.`procedure_id` AS `distinct_proc_id`,
        `procedure_masters`.`procedure_name`
    FROM `invoice_final_procedure`

    INNER JOIN `invoice_final_billing`
        ON `invoice_final_procedure`.`i_id` = `invoice_final_billing`.`id`

    INNER JOIN `procedure_masters`
        ON `invoice_final_procedure`.`procedure_id` = `procedure_masters`.`id`

    WHERE DATE(`invoice_final_billing`.`billing_date`)
        BETWEEN '" . $from_date . "' AND '" . $to_date . "'

        $extra_query
        $doc_query

        AND `invoice_final_procedure`.`del_flag` = '0'
        AND `invoice_final_billing`.`del_flag` = '0'

    ORDER BY `procedure_masters`.`procedure_name` ASC
";

$result3 = $conn->query($sql3);

$count = ($result3) ? $result3->num_rows : 0;


if ($count > 0) {

    $sl_no = 1;

    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {

        /*
        |--------------------------------------------------------------------------
        | PROCEDURE NAME
        |--------------------------------------------------------------------------
        */

        $procedure_name = $row3['procedure_name'];


        /*
        |--------------------------------------------------------------------------
        | MAIN QUERY
        |
        | Doctor + Prefix + Discount information are loaded here.
        |
        | This removes:
        |   sql11
        |   sql_prefix
        |   sql_discount
        |--------------------------------------------------------------------------
        */

        $sql_inner = "
            SELECT

                `invoice_final_billing`.`id`,
                `invoice_final_billing`.`hospital_number`,
                `invoice_final_billing`.`invo_no`,
                `invoice_final_billing`.`name`,
                `invoice_final_billing`.`doc_id`,
                `invoice_final_billing`.`opd_flag`,
                `invoice_final_billing`.`billing_date`,
                `invoice_final_billing`.`discount`,
                `invoice_final_billing`.`discount_type`,
                `invoice_final_billing`.`total`,
                `invoice_final_billing`.`del_flag`,
                `invoice_final_billing`.`prefix`,

                `invoice_final_procedure`.`amount`
                    AS `procedure_amount`,

                `invoice_final_procedure`.`discount`
                    AS `procedure_dicount`,

                `invoice_final_procedure`.`net_amount`
                    AS `procedure_net_amount`,

                /* Doctor */
                `user_infos`.`name`
                    AS `primary_doctor`,

                `users`.`username`
                    AS `ini`,

                /* Prefix */
                `prefix_masters`.`prefix_name`
                    AS `prefix_name`,

                /* Discount calculation data */
                `discount_data`.`tot_net`,
                `discount_data`.`total_proc_cnt`

            FROM `invoice_final_procedure`

            INNER JOIN `invoice_final_billing`
                ON `invoice_final_procedure`.`i_id`
                    = `invoice_final_billing`.`id`

            LEFT JOIN `user_infos`
                ON `user_infos`.`users_id`
                    = `invoice_final_billing`.`doc_id`

            LEFT JOIN `users`
                ON `users`.`id`
                    = `user_infos`.`users_id`

            LEFT JOIN `prefix_masters`
                ON `prefix_masters`.`id`
                    = `invoice_final_billing`.`prefix`

            LEFT JOIN (
                SELECT
                    `i_id`,
                    SUM(`net_amount`) AS `tot_net`,
                    COUNT(`id`) AS `total_proc_cnt`
                FROM `invoice_final_procedure`
                WHERE `del_flag` = '0'
                GROUP BY `i_id`
            ) AS `discount_data`
                ON `discount_data`.`i_id`
                    = `invoice_final_billing`.`id`

            WHERE DATE(`invoice_final_billing`.`billing_date`)
                BETWEEN '" . $from_date . "' AND '" . $to_date . "'

                $extra_query
                $doc_query

                AND `invoice_final_procedure`.`del_flag` = '0'
                AND `invoice_final_billing`.`del_flag` = '0'

                AND `invoice_final_procedure`.`procedure_id`
                    = '" . $row3['distinct_proc_id'] . "'
        ";


        $result_inner = $conn->query($sql_inner);

        $count_inner = ($result_inner)
            ? $result_inner->num_rows
            : 0;


        $amount_net_total = 0;
        $discount_net_total = 0;
        $paid_net_total = 0;
        $paid_advance_total = 0;


        if ($count_inner > 0) {

            $sl_inner = 1;

            while ($row_inner = mysqli_fetch_array(
                $result_inner,
                MYSQLI_ASSOC
            )) {


                /*
                |--------------------------------------------------------------------------
                | DOCTOR
                |--------------------------------------------------------------------------
                */

                $primary_doctor = "";

                $ini = "";

                if (!empty($row_inner['primary_doctor'])) {
                    $primary_doctor = $row_inner['primary_doctor'];
                }

                if (!empty($row_inner['ini'])) {
                    $ini = $row_inner['ini'];
                }


                /*
                |--------------------------------------------------------------------------
                | BILL TYPE
                |--------------------------------------------------------------------------
                */

                if ($row_inner['opd_flag'] == 1) {
                    $bill_for = 'OPD';
                } else {
                    $bill_for = 'IPD';
                }


                /*
                |--------------------------------------------------------------------------
                | BILL NUMBER
                |--------------------------------------------------------------------------
                */

                $m_f_year = calculateFiscalYearForDate(
                    date(
                        "m/d/y",
                        strtotime($row_inner['billing_date'])
                    ),
                    "4/1",
                    "3/31"
                );

                $bill_no =
                    $hospital_short_code
                    . '/'
                    . $m_f_year
                    . '/'
                    . $bill_for
                    . '/'
                    . $row_inner['invo_no'];


                /*
                |--------------------------------------------------------------------------
                | BILLING DATE
                |--------------------------------------------------------------------------
                */

                $billing_date = date(
                    "d-m-Y",
                    strtotime($row_inner['billing_date'])
                );


                /*
                |--------------------------------------------------------------------------
                | PREFIX
                |--------------------------------------------------------------------------
                */

                $prefix = "";

                if (!empty($row_inner['prefix_name'])) {
                    $prefix = $row_inner['prefix_name'];
                }


                /*
                |--------------------------------------------------------------------------
                | PAYMENT VARIABLES
                |--------------------------------------------------------------------------
                */

                $payor_name = "SELF";

                $pay_mode = "";

                $advance_amt = 0;

                $pay_mode_ret = "";

                $advance_amt_ret = 0;

                $bill_time_paid = 0;


                /*
                |--------------------------------------------------------------------------
                | ONE PAYMENT QUERY
                |
                | Previously there were 5 separate payment queries
                | for every invoice.
                |
                | Now all payment information is loaded in one query.
                |--------------------------------------------------------------------------
                */

                $sql_payment = "
                    SELECT

                        GROUP_CONCAT(
                            CASE
                                WHEN `ifpb`.`p_key` <> '5'
                                AND `ifpb`.`advance_bill_refund_flag` IN ('3','0')
                                THEN `pmm`.`payment_mode_name`
                            END
                            ORDER BY `ifpb`.`id`
                            SEPARATOR ' , '
                        ) AS `pay_mode`,

                        GROUP_CONCAT(
                            CASE
                                WHEN `ifpb`.`p_key` <> '5'
                                AND `ifpb`.`advance_bill_refund_flag` = '1'
                                THEN `pmm`.`payment_mode_name`
                            END
                            ORDER BY `ifpb`.`id`
                            SEPARATOR ' , '
                        ) AS `pay_mode_ret`,

                        SUM(
                            CASE
                                WHEN `ifpb`.`p_key` <> '5'
                                AND `ifpb`.`advance_bill_refund_flag` = '0'
                                AND `ifpb`.`advance_bill_invoice_no` <> ''
                                THEN `ifpb`.`p_value`
                                ELSE 0
                            END
                        ) AS `advance_amt`,

                        SUM(
                            CASE
                                WHEN `ifpb`.`p_key` <> '5'
                                AND `ifpb`.`advance_bill_refund_flag` = '1'
                                AND `ifpb`.`advance_bill_invoice_no` <> ''
                                THEN `ifpb`.`p_value`
                                ELSE 0
                            END
                        ) AS `advance_amt_ret`,

                        SUM(
                            CASE
                                WHEN `ifpb`.`p_key` <> '5'
                                AND `ifpb`.`advance_bill_refund_flag` = '3'
                                AND `ifpb`.`payment_type` = '1'
                                THEN `ifpb`.`p_value`
                                ELSE 0
                            END
                        ) AS `bill_time_paid`,

                        (
                            SELECT `tm`.`name`
                            FROM `invoice_final_payment_billing` AS `ifpb2`

                            LEFT JOIN `tpa_masters` AS `tm`
                                ON `ifpb2`.`tpa_name` = `tm`.`id`

                            WHERE `ifpb2`.`i_id`
                                = '" . $row_inner['id'] . "'

                                AND `ifpb2`.`p_key` = '5'

                                AND `ifpb2`.`del_flag` = '0'

                            ORDER BY `ifpb2`.`id` DESC

                            LIMIT 1
                        ) AS `tpa_company`

                    FROM `invoice_final_payment_billing` AS `ifpb`

                    INNER JOIN `payment_mode_masters` AS `pmm`
                        ON `ifpb`.`p_key` = `pmm`.`id`

                    INNER JOIN `payment_type_masters` AS `ptm`
                        ON `ifpb`.`payment_type` = `ptm`.`id`

                    WHERE `ifpb`.`i_id`
                        = '" . $row_inner['id'] . "'

                        AND `ifpb`.`del_flag` = '0'
                ";


                $result_payment = $conn->query($sql_payment);

                if ($result_payment && $result_payment->num_rows > 0) {

                    $row_payment = $result_payment->fetch_assoc();


                    /*
                    |--------------------------------------------------------------------------
                    | PAYOR
                    |--------------------------------------------------------------------------
                    */

                    if (!empty($row_payment['tpa_company'])) {
                        $payor_name = $row_payment['tpa_company'];
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | PAYMENT MODE
                    |--------------------------------------------------------------------------
                    */

                    if (!empty($row_payment['pay_mode'])) {
                        $pay_mode = $row_payment['pay_mode'];
                    }


                    if (!empty($row_payment['pay_mode_ret'])) {
                        $pay_mode_ret = $row_payment['pay_mode_ret'];
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | ADVANCE
                    |--------------------------------------------------------------------------
                    */

                    $advance_amt = !empty($row_payment['advance_amt'])
                        ? $row_payment['advance_amt']
                        : 0;


                    $advance_amt_ret = !empty($row_payment['advance_amt_ret'])
                        ? $row_payment['advance_amt_ret']
                        : 0;


                    /*
                    |--------------------------------------------------------------------------
                    | BILL TIME PAID
                    |--------------------------------------------------------------------------
                    */

                    $bill_time_paid = !empty($row_payment['bill_time_paid'])
                        ? $row_payment['bill_time_paid']
                        : 0;
                }


                /*
                |--------------------------------------------------------------------------
                | REMOVE CONSECUTIVE DUPLICATES
                |--------------------------------------------------------------------------
                */

                $output = removeConsecutiveDuplicates($pay_mode);

                $pay_mode = $output;


                /*
                |--------------------------------------------------------------------------
                | PROCEDURE AMOUNT
                |--------------------------------------------------------------------------
                */

                $amount = 0;

                $discount = 0;

                $net_amount = 0;

                $procedure_amount = 0;

                $procedure_dicount = 0;

                $procedure_net_amount = 0;


                $procedure_amount = (float)$row_inner['procedure_amount'];
$procedure_dicount = (float)$row_inner['procedure_dicount'];
$procedure_net_amount = (float)$row_inner['procedure_net_amount'];


                $amount = $procedure_amount;

                $discount = $procedure_dicount;

                $net_amount = $procedure_net_amount;


                /*
                |--------------------------------------------------------------------------
                | DISCOUNT CALCULATION
                |
                | Same calculation as previous code.
                | Only SQL query has been removed.
                |--------------------------------------------------------------------------
                */

                $dicount_calculate = 0;

                $dicount_calculate_int = 0;

                $dicount_calculate_per_proc = 0;

                $dicount_calculate_per_proc_int = 0;


                if ($row_inner['discount'] != '0') {

                    if ($row_inner['discount'] != '') {

                        $tot_net =
                            !empty($row_inner['tot_net'])
                            ? $row_inner['tot_net']
                            : 0;

                        $total_proc_cnt =
                            !empty($row_inner['total_proc_cnt'])
                            ? $row_inner['total_proc_cnt']
                            : 0;


                        if (
                            $row_inner['discount_type'] == 'P'
                            && $total_proc_cnt > 0
                        ) {

                            $dicount_calculate =
                                (
                                    $tot_net
                                    * $row_inner['discount']
                                ) / 100;

                            $dicount_calculate_int =
                                round($dicount_calculate);

                            $dicount_calculate_per_proc =
                                (
                                    $dicount_calculate_int
                                    / $total_proc_cnt
                                );

                            $dicount_calculate_per_proc_int =
                                round(
                                    $dicount_calculate_per_proc
                                );
                        }


                        if (
                            $row_inner['discount_type'] == 'F'
                            && $total_proc_cnt > 0
                        ) {

                            $dicount_calculate_per_proc =
                                (
                                    $row_inner['discount']
                                    / $total_proc_cnt
                                );

                            $dicount_calculate_per_proc_int =
                                round(
                                    $dicount_calculate_per_proc
                                );
                        }
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | FINAL AMOUNT
                |--------------------------------------------------------------------------
                */

                $amount = $procedure_amount;

                $discount =
                    $procedure_dicount
                    + $dicount_calculate_per_proc_int;

                $net_amount =
                    $procedure_net_amount
                    - $dicount_calculate_per_proc_int;


                /*
                |--------------------------------------------------------------------------
                | TOTALS
                |--------------------------------------------------------------------------
                */

                $amount_net_total =
                    $amount_net_total + $amount;

                $discount_net_total =
                    $discount_net_total + $discount;

                $paid_net_total =
                    $paid_net_total + $net_amount;

                $paid_advance_total =
                    $paid_advance_total + $advance_amt;


                $due_net_total =
                    $due_net_total
                    + $due_amt
                    - $advance_amt_ret;


                $adjamt = 0;

                $adjamt =
                    $advance_amt
                    - $advance_amt_ret;


                $due_amt =
                    $due_amt
                    - $advance_amt_ret;


                /*
                |--------------------------------------------------------------------------
                | GRAND TOTAL
                |--------------------------------------------------------------------------
                */

                if ($sl_inner == $count_inner) {

                    $amount_grand_total =
                        $amount_grand_total
                        + $amount_net_total;

                    $discount_grand_total =
                        $discount_grand_total
                        + $discount_net_total;

                    $paid_grand_total =
                        $paid_grand_total
                        + $paid_net_total;

                    $advance_grand_total =
                        $advance_grand_total
                        + $paid_advance_total;
                }


                /*
                |--------------------------------------------------------------------------
                | OUTPUT
                |--------------------------------------------------------------------------
                */

                $arr[] = array(

                    "sl_no" =>
                        $sl_no,

                    "procedure_name" =>
                        $procedure_name,

                    "sl_inner" =>
                        $sl_inner,

                    "id" =>
                        $row_inner['id'],

                    "hospital_number" =>
                        $row_inner['hospital_number'],

                    "invo_no" =>
                        $row_inner['invo_no'],

                    "name" =>
                        $row_inner['name'],

                    "prefix" =>
                        $prefix,

                    "primary_doctor" =>
                        $primary_doctor,

                    "ini" =>
                        $ini,

                    "bill_no" =>
                        $bill_no,

                    "billing_date" =>
                        $billing_date,

                    "amount" =>
                        $amount,

                    "discount" =>
                        $discount,

                    "net_amount" =>
                        $net_amount,

                    "payor_name" =>
                        $payor_name,

                    "pay_mode" =>
                        $pay_mode,

                    "advance_amt" =>
                        $advance_amt,

                    "amount_net_total" =>
                        $amount_net_total,

                    "discount_net_total" =>
                        $discount_net_total,

                    "paid_net_total" =>
                        $paid_net_total,

                    "count_inner" =>
                        $count_inner,

                    "title_span" =>
                        $title_span,

                    "opd_flag" =>
                        $row_inner['opd_flag'],

                    "paid_advance_total" =>
                        $paid_advance_total,

                    "due_net_total" =>
                        $due_net_total,

                    "advance_amt_ret" =>
                        $advance_amt_ret,

                    "pay_mode_ret" =>
                        $pay_mode_ret,

                    "adjamt" =>
                        $adjamt,

                    "bill_time_paid" =>
                        $bill_time_paid
                );


                $sl_inner++;
            }
        }


        $sl_no++;
    }
}


echo json_encode($arr);
}


function load_ipd_billing_details(){

	global $conn;
	$from_date = date("Y-m-d");
	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));
	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));
	 $doc_id = $_POST['doc_id'];
	 
	  $bill_type =$_POST['bill_type'];
	 if($bill_type=='3'){
		 $extra_query="";
	 }else{
		$extra_query=" AND `invoice_final_billing`.`opd_flag`='".$bill_type."' ";
	 }
	 if($bill_type==1){
		$bill_for_til='OPD';
	}else{
		$bill_for_til='IPD';
	}
	$doc_title="";
	$doc_query="";
	if($doc_id!='0'){
	 $sql36="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$doc_id."'";
					 $result36=$conn->query($sql36) ;
					 $row36 = $result36->fetch_assoc();
					 $count36=$result36->num_rows;
					 if($count36>0)
					 {
						$primary_doctor=$row36['name'];
						$ini=$row36['username'];
					 }
					 $doc_title=" - ".$primary_doctor;
					 $doc_query=" AND `invoice_final_billing`.`doc_id`='".$doc_id."' ";
	}
	
	 $title_span="";
	$title_span="Pushpanjali collection Reports MIS From ".date("d-M-Y", strtotime($_POST['from_date']))." To ".date("d-M-Y", strtotime($_POST['to_date'])).' For '.$bill_for_til.' Billing'.$doc_title;
	$arr=array();
	

	 $due_net_total=0;

	$due_amt=0;

  

  $sql3=" SELECT DISTINCT (`invoice_final_procedure`.`procedure_id`) AS `distinct_proc_id` FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` INNER JOIN `procedure_masters` ON `invoice_final_procedure`.`procedure_id`=`procedure_masters`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  $extra_query $doc_query AND `invoice_final_procedure`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' ORDER BY `procedure_masters`.`procedure_name` ASC "; 

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


		 $sql_inner=" SELECT  `invoice_final_billing`.`id`,  `invoice_final_billing`.`hospital_number`,  `invoice_final_billing`.`invo_no`,  `invoice_final_billing`.`name`,  `invoice_final_billing`.`doc_id`,  `invoice_final_billing`.`opd_flag`,  `invoice_final_billing`.`billing_date`,  `invoice_final_billing`.`discount`,  `invoice_final_billing`.`discount_type`,  `invoice_final_billing`.`total`,  `invoice_final_billing`.`del_flag`,  `invoice_final_billing`.`prefix`,`invoice_final_procedure`.`amount`  AS `procedure_amount` , `invoice_final_procedure`.`discount` AS `procedure_dicount`, `invoice_final_procedure`.`net_amount`  AS `procedure_net_amount` FROM `invoice_final_procedure` INNER JOIN `invoice_final_billing` ON `invoice_final_procedure`.`i_id`=`invoice_final_billing`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query $doc_query AND `invoice_final_procedure`.`del_flag`='0'  AND  `invoice_final_billing`.`del_flag`='0'  AND  `invoice_final_procedure`.`procedure_id`='".$row3['distinct_proc_id']."' ";                   



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

					 					 
					 $due_net_total=$due_amt;

					 $adjamt=0;

					 $adjamt=$advance_amt-$advance_amt_ret;

					 

					if($sl_inner==$count_inner){

						
					$amount_grand_total=$amount_grand_total+$amount_net_total;

					$discount_grand_total=$discount_grand_total+$discount_net_total;

					$paid_grand_total=$paid_grand_total+$paid_net_total;

					$advance_grand_total=$advance_grand_total+$paid_advance_total;

					}
					
			 $arr[]=array("sl_no"=>$sl_no,"procedure_name"=>$procedure_name,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"amount"=>$amount,"discount"=>$discount,"net_amount"=>$net_amount,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"amount_net_total"=>$amount_net_total,"discount_net_total"=>$discount_net_total,"paid_net_total"=>$paid_net_total,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"paid_advance_total"=>$paid_advance_total,"due_net_total"=>$due_net_total,"advance_amt_ret"=>$advance_amt_ret,"pay_mode_ret"=>$pay_mode_ret,"adjamt"=>$adjamt,"due_amt"=>$due_amt,"advance_amt_ret"=>$advance_amt_ret);

			 $sl_inner++; 

			 }

			 

	 }



		



		$sl_no++; 



	}}
		echo json_encode($arr);

}

function load_opd_advance_billing_details(){

	global $conn;

	 $from_date = date("Y-m-d");
	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));
	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));
	 
	  $bill_type =$_POST['bill_type'];
	 if($bill_type=='3'){
		 $extra_query="";
	 }else{
		$extra_query=" AND `adavnce_final_billing`.`opd_flag`='".$bill_type."' ";
	 }
	 if($bill_type==1){
		$bill_for_til='OPD';
	}else{
		$bill_for_til='IPD';
	}
	 
	 $title_span="";
	$title_span="Pushpanjali collection Reports MIS From ".date("d-M-Y", strtotime($_POST['from_date']))." To ".date("d-M-Y", strtotime($_POST['to_date'])).' For '.$bill_for_til.'  Advance Billing';
	$arr=array();

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
					 
					
					 
			 
			 $arr[]=array("sl_no"=>$sl_no,"user_remarks"=>$user_remarks,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag']);
			 $sl_inner++; 
			 }
			 
	 }

		

		$sl_no++; 

	}}

		echo json_encode($arr);

}

function load_opd_advance_adjusted_billing_details(){

	global $conn;

	 $from_date = date("Y-m-d");
	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));
	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));
	 
	  $bill_type =$_POST['bill_type'];
	 if($bill_type=='3'){
		 $extra_query="";
	 }else{
		$extra_query=" AND `invoice_final_billing`.`opd_flag`='".$bill_type."' ";
	 }
	 if($bill_type==1){
		$bill_for_til='OPD';
	}else{
		$bill_for_til='IPD';
	}
	 
	 $title_span="";
	$title_span="Pushpanjali collection Reports MIS From ".date("d-M-Y", strtotime($_POST['from_date']))." To ".date("d-M-Y", strtotime($_POST['to_date'])).' For '.$bill_for_til.'  Advance Adjusted Billing';
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
			 
			 $arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"receipt_date"=>$receipt_date,"advance_bill_invoice_unique_id"=>$advance_bill_invoice_unique_id,"adjusted_value"=>$adjusted_value);
			 $sl_inner++; 
			 }
			 
	 }

		

		$sl_no++; 

	}}

		echo json_encode($arr);

}

function load_opd_refund_billing_details(){

	global $conn;
	

	 $from_date = date("Y-m-d");
	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));
	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));
	 
	  $bill_type =$_POST['bill_type'];
	 if($bill_type=='3'){
		 $extra_query="";
	 }else{
		$extra_query=" AND `invoice_final_billing`.`opd_flag`='".$bill_type."' ";
	 }
	 if($bill_type==1){
		$bill_for_til='OPD';
	}else{
		$bill_for_til='IPD';
	}
	 
	 $title_span="";
	$title_span="Pushpanjali collection Reports MIS From ".date("d-M-Y", strtotime($_POST['from_date']))." To ".date("d-M-Y", strtotime($_POST['to_date'])).' For '.$bill_for_til.' Refund Billing';
	$arr=array();

	$sql3=" SELECT DISTINCT (`invoice_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE DATE(`invoice_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_payment_billing`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' AND  `invoice_final_payment_billing`.`payment_type`='3'"; 
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
			 
			 $arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"created_by"=>$created_by,"advance_refund"=>$advance_refund);
			 $sl_inner++; 
			 }
			 
	 }

		

		$sl_no++; 

	}}
	
	if($bill_type=='3'){
		 $extra_query="";
	 }else{
		$extra_query=" AND `refund_adavnce_final_billing`.`opd_flag`='".$bill_type."' ";
	 }
	 
	// Refnd start
	$sql3=" SELECT DISTINCT (`refund_adavnce_final_payment_billing`.`i_id`) AS `distinct_proc_id` FROM `refund_adavnce_final_payment_billing` INNER JOIN `refund_adavnce_final_billing` ON `refund_adavnce_final_payment_billing`.`i_id`=`refund_adavnce_final_billing`.`id` WHERE DATE(`refund_adavnce_final_billing`.`billing_date`) BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `refund_adavnce_final_payment_billing`.`del_flag`='0' AND  `refund_adavnce_final_billing`.`del_flag`='0' AND  `refund_adavnce_final_payment_billing`.`payment_type`='3'  AND  `refund_adavnce_final_billing`.`adjust_with_final_bill_flag`='0' "; 
	 $result3=$conn->query($sql3) ;
	 $count=$result3->num_rows; 

	 if($count>'0'){
			 $sl_no=1;
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
					
					 
			 
			 $arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"id"=>$row_inner['id'],"hospital_number"=>$row_inner['hospital_number'],"invo_no"=>$row_inner['invo_no'],"name"=>$row_inner['name'],"prefix"=>$prefix,"primary_doctor"=>$primary_doctor,"ini"=>$ini,"bill_no"=>$bill_no,"billing_date"=>$billing_date,"payor_name"=>$payor_name,"pay_mode"=>$pay_mode,"advance_amt"=>$advance_amt,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"created_by"=>$created_by,"advance_refund"=>$advance_refund);
			 $sl_inner++; 
			 }
			 
	 }

		

		$sl_no++; 

	}}

		echo json_encode($arr);

}

function total_collection_billing_details(){

	global $conn;

	 $from_date = date("Y-m-d");
	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));
	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));
	 
	  $bill_type =$_POST['bill_type'];
	 if($bill_type=='3'){
		 $extra_query="";
	 }else{
		$extra_query=" AND `invoice_final_billing`.`opd_flag`='".$bill_type."' ";
	 }
	 if($bill_type==1){
		$bill_for_til='OPD';
	}else if($bill_type==0){
		$bill_for_til='IPD';
	}else{
		$bill_for_til='All Type';
	}
	 
	 $title_span="";
	$title_span="Pushpanjali Total Collection Reports MIS From ".date("d-M-Y", strtotime($_POST['from_date']))." To ".date("d-M-Y", strtotime($_POST['to_date'])).' For '.$bill_for_til.'  Billing';
	$arr=array();
	$grand_total=0;
	$sql3="SELECT * FROM `payment_type_masters` WHERE `del_flag`='0'"; 
	 $result3=$conn->query($sql3) ;
	 $count=$result3->num_rows;
	 if($count>'0'){
		 $sl_no=1;
		 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
		 {				
			 		$pay_type_name="";
					$pay_type_name=$row3['payment_type_name'];
					$bill_time_cash="0";
					 $sql_bill_time_cash="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_cash` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='1' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  $extra_query ";	
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
					 $sql_bill_time_card="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_card` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='2' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  $extra_query ";	
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
					 $sql_bill_time_upi="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_upi` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='3' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  $extra_query ";	
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
					 $sql_bill_time_cheque="SELECT SUM(`invoice_final_payment_billing`.`p_value`) AS `bill_time_cheque` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE `invoice_final_payment_billing`.`payment_type`='".$row3['id']."' AND `invoice_final_payment_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='4' AND DATE(`invoice_final_payment_billing`.`payment_date`) BETWEEN '".$from_date."' AND  '".$to_date."'  AND `invoice_final_billing`.`del_flag`='0'  $extra_query ";	
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
					 $grand_total=$bill_time_cash+$bill_time_card+$bill_time_upi+$bill_time_cheque;
			 
			 $arr[]=array("sl_no"=>$sl_no,"sl_inner"=>$sl_inner,"count_inner"=>$count_inner,"title_span"=>$title_span,"opd_flag"=>$row_inner['opd_flag'],"bill_for"=>$bill_for,"pay_type_name"=>$pay_type_name,"bill_time_cash"=>$bill_time_cash,"bill_time_card"=>$bill_time_card,"bill_time_upi"=>$bill_time_upi,"bill_time_cheque"=>$bill_time_cheque,"grand_total"=>$grand_total,"bill_tpe_unique_id"=>$row3['id']);
			 $sl_inner++; 
			 

			

		$sl_no++; 

	}}

		echo json_encode($arr);

}



function prcedure_wise_count_details(){

	global $conn;

	 $from_date = date("Y-m-d");
	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));
	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));
	 
	  $bill_type =$_POST['bill_type'];
	 if($bill_type=='3'){
		 $extra_query="";
	 }else{
		$extra_query=" AND `invoice_final_billing`.`opd_flag`='".$bill_type."' ";
	 }
	 if($bill_type==1){
		$bill_for_til='OPD';
	}else{
		$bill_for_til='IPD';
	}
	 
	 $title_span="";
	$title_span="Pushpanjali collection Reports MIS From ".date("d-M-Y", strtotime($_POST['from_date']))." To ".date("d-M-Y", strtotime($_POST['to_date'])).' For '.$bill_for_til.' Billing';
	$arr=array();

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
			 
			 
			 
			 $arr[]=array("procedure_name"=>$procedure_name,"total_count_procedure"=>$total_count_procedure,"total_normal_count_procedure"=>$total_normal_count_procedure,"total_concession_count_procedure"=>$total_concession_count_procedure,"total_waived_count_procedure"=>$total_waived_count_procedure,"total_p_amt_count_procedure"=>$total_p_amt_count_procedure,"total_w_amt_count_procedure"=>$total_w_amt_count_procedure);
			 

	}}

		echo json_encode($arr);

}


function tpa_entry_details(){

	global $conn;

	 $from_date = date("Y-m-d");
	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));
	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));
	 
	 $bill_type =$_POST['bill_type'];
	 $tpa_id =$_POST['tpa_id'];
	 $tpa_name =$_POST['tpa_name'];
	 if($bill_type=='3'){
		 $extra_query="";
	 }else{
		$extra_query=" AND `invoice_final_billing`.`opd_flag`='".$bill_type."' ";
	 }
	 if($bill_type==1){
		$bill_for_til='OPD';
	}else{
		$bill_for_til='IPD';
	}
	 
	 $title_span="";
	$title_span="Pushpanjali TPA Recovery Reports MIS From ".date("d-M-Y", strtotime($_POST['from_date']))." To ".date("d-M-Y", strtotime($_POST['to_date'])).' For '.$tpa_name.' ';
	$arr=array();

	$sql3=" SELECT `invoice_final_billing`.*,`invoice_final_payment_billing`.`p_key`, `invoice_final_payment_billing`.`p_value`,`invoice_final_payment_billing`.`id` AS `payment_unique_id` , `invoice_final_payment_billing`.`due_recieved_flag` , `invoice_final_payment_billing`.`due_recieved_date`,`invoice_final_payment_billing`.`payment_date`, `invoice_final_payment_billing`.`recovery_amt`, `invoice_final_payment_billing`.`tds`, `invoice_final_payment_billing`.`discount_tpa`, `invoice_final_payment_billing`.`tpa_recovery_due`, `invoice_final_payment_billing`.`total_tpa`, `invoice_final_payment_billing`.`remarks_tpa` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id` WHERE DATE(`invoice_final_payment_billing`.`payment_date`)  BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_payment_billing`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='5' AND `invoice_final_payment_billing`.`tpa_name`='".$tpa_id."' "; 
	 $result3=$conn->query($sql3) ;
	 $count=$result3->num_rows;
	 

	 if($count>'0'){
			 $sl_no=1;
			 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
			 {
				 $primary_doctor="";
					 $ini="";	
			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row3['doc_id']."'";
					 $result11=$conn->query($sql11) ;
					 $row11 = $result11->fetch_assoc();
					 $count11=$result11->num_rows;
					 if($count11>0)
					 {
						$primary_doctor=$row11['name'];
						$ini=$row11['username'];
					 }
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
				$billing_date =date("d-m-Y", strtotime($row3['billing_date']));
				$payment_date =date("d-m-Y", strtotime($row3['payment_date']));
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
				 $tpa_amt=0;
				 $tpa_amt=$row3['p_value'];
				 $hospital_number=$row3['hospital_number'];
				 $id=$row3['id'];
				 $payment_unique_id=$row3['payment_unique_id'];				 
				 
				 
				 $accounts_entry_date='';
				 $due_recieved_date='';
				
				 $net_amt=0;
				 $recovery_amt=0;
				 $tds=0;
				 $discount_tpa=0;
				 $total_tpa=0;
				 $tpa_recovery_due=0;
				 $remarks_tpa='';
				 	 
				 $sql11="SELECT * FROM `invoice_final_part_payment_tpa` WHERE `bill_unique_id`='".$id."' AND `del_flag`='0' AND `payment_unique_id`='".$payment_unique_id."' ";
				 $result11=$conn->query($sql11) ;				 
				 $count11=$result11->num_rows;
				 if($count11>0)
				 {
					 while($row11=mysqli_fetch_array($result11,MYSQLI_ASSOC)){
						 if($accounts_entry_date==''){
							$accounts_entry_date=$accounts_entry_date; 
						 }else{
							 $accounts_entry_date=$accounts_entry_date.'<br>'; 
						 }
						 if($due_recieved_date==''){
							$due_recieved_date=$due_recieved_date; 
						 }else{
							 $due_recieved_date=$due_recieved_date.'<br>'; 
						 }
						if($row11['accounts_entry_date']!=''){
							$accounts_entry_date=$accounts_entry_date.date("d-m-Y", strtotime($row11['accounts_entry_date']));
						}
						if($row11['due_recieved_date']!=''){
							$due_recieved_date=$due_recieved_date.date("d-m-Y", strtotime($row11['due_recieved_date']));
						}
						if($row11['net_amt']!=''){
							$net_amt=$net_amt+$row11['net_amt'];
						}
						if($row11['recovery_amt']!=''){
							$recovery_amt=$recovery_amt+$row11['recovery_amt'];
						}
						if($row11['tds']!=''){
							$tds=$tds+$row11['tds'];
						}		
						if($row11['total_tpa']!=''){
							$total_tpa=$total_tpa+$row11['total_tpa'];
						}	
						/* if($row11['tpa_recovery_due']!=''){
							$tpa_recovery_due=$tpa_recovery_due+$row11['tpa_recovery_due'];
						}	*/
						$tpa_recovery_due=$tpa_amt-$total_tpa;
						if($row11['remarks_tpa']!=''){
							$remarks_tpa=$row11['remarks_tpa'].'<br>'.$remarks_tpa;
						}	
					 }
					 
				 }		
				
				 
				 $arr[]=array("id"=>$id,"bill_no"=>$bill_no,"hospital_number"=>$hospital_number,"payment_date"=>$payment_date,"billing_date"=>$billing_date,"patient_name"=>$patient_name,"primary_doctor"=>$primary_doctor,"tpa_amt"=>$tpa_amt,"payment_unique_id"=>$payment_unique_id,"due_recieved_date"=>$due_recieved_date,"net_amt"=>$net_amt,"recovery_amt"=>$recovery_amt,"tds"=>$tds,"discount_tpa"=>$discount_tpa,"tpa_recovery_due"=>$tpa_recovery_due,"total_tpa"=>$total_tpa,"remarks_tpa"=>$remarks_tpa,"title_span"=>$title_span,"accounts_entry_date"=>$accounts_entry_date);
			 $sl_no++; 
				 
				 
	}}

		echo json_encode($arr);

}


function tpa_recovery_details(){

	global $conn;

	 $from_date = date("Y-m-d");
	 $from_date = date("Y-m-d", strtotime($_POST['from_date']));
	 $to_date = date("Y-m-d", strtotime($_POST['to_date']));
	 
	 $bill_type =$_POST['bill_type'];
	 $tpa_id =$_POST['tpa_id'];
	 $tpa_name =$_POST['tpa_name'];
	 if($bill_type=='3'){
		 $extra_query="";
	 }else{
		$extra_query=" AND `invoice_final_billing`.`opd_flag`='".$bill_type."' ";
	 }
	 if($bill_type==1){
		$bill_for_til='OPD';
	}else{
		$bill_for_til='IPD';
	}
	 
	 $title_span="";
	$title_span="Pushpanjali TPA Recovery Reports MIS From ".date("d-M-Y", strtotime($_POST['from_date']))." To ".date("d-M-Y", strtotime($_POST['to_date']));
	$arr=array();

	$sql3=" SELECT `invoice_final_billing`.*,`invoice_final_payment_billing`.`p_key`, `invoice_final_payment_billing`.`p_value`,`invoice_final_payment_billing`.`id` AS `payment_unique_id` , `invoice_final_payment_billing`.`due_recieved_flag` , `invoice_final_payment_billing`.`due_recieved_date`,`invoice_final_payment_billing`.`payment_date`, `invoice_final_payment_billing`.`recovery_amt`, `invoice_final_payment_billing`.`tds`, `invoice_final_payment_billing`.`discount_tpa`, `invoice_final_payment_billing`.`tpa_recovery_due`, `invoice_final_payment_billing`.`total_tpa`, `invoice_final_payment_billing`.`remarks_tpa`,`tpa_masters`.`name` AS `tpa_company` FROM `invoice_final_payment_billing` INNER JOIN `invoice_final_billing` ON `invoice_final_payment_billing`.`i_id`=`invoice_final_billing`.`id`  LEFT JOIN `tpa_masters` ON `invoice_final_payment_billing`.`tpa_name` =`tpa_masters`.`id`  WHERE DATE(`invoice_final_payment_billing`.`accounts_entry_date`)  BETWEEN '".$from_date."' AND  '".$to_date."' $extra_query AND `invoice_final_payment_billing`.`del_flag`='0' AND  `invoice_final_billing`.`del_flag`='0' AND `invoice_final_payment_billing`.`p_key`='5'  "; 
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
				$billing_date =date("d-m-Y", strtotime($row3['billing_date']));
				$payment_date =date("d-m-Y", strtotime($row3['payment_date']));
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
				 $id=$row3['id'];
				 $payment_unique_id=$row3['payment_unique_id'];
				 $due_recieved_flag=$row3['due_recieved_flag'];
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
				
				 
				 $arr[]=array("sl_no"=>$sl_no,"id"=>$id,"bill_no"=>$bill_no,"hospital_number"=>$hospital_number,"payment_date"=>$payment_date,"billing_date"=>$billing_date,"patient_name"=>$patient_name,"primary_doctor"=>$primary_doctor,"net_amt"=>$net_amt,"payment_unique_id"=>$payment_unique_id,"due_recieved_flag"=>$due_recieved_flag,"due_recieved_date"=>$due_recieved_date,"recovery_amt"=>$recovery_amt,"tds"=>$tds,"discount_tpa"=>$discount_tpa,"tpa_recovery_due"=>$tpa_recovery_due,"total_tpa"=>$total_tpa,"remarks_tpa"=>$remarks_tpa,"title_span"=>$title_span,"tpa_company"=>$tpa_company);
			 $sl_no++; 
				 
				 
	}}

		echo json_encode($arr);

}



function opd_patient_report(){

	global $conn; 
	
	
	
	 $today = date("Y-m-d");

	 if($_POST['from_date']!=''){

	 	$from_date = date("Y-m-d", strtotime($_POST['from_date']));

	 }

	 if($_POST['to_date']!=''){

	 	$to_date = date("Y-m-d", strtotime($_POST['to_date']));

	 }

	 $doc_id = $_POST['doc_id'];

	 $extra_query="";

	 $uhid_query="";

	 $date_query="";

	 $default_query="";
	 
	 $doc_title="";
	$doc_query="";
	if($doc_id!='0'){
	 $sql36="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$doc_id."'";
					 $result36=$conn->query($sql36) ;
					 $row36 = $result36->fetch_assoc();
					 $count36=$result36->num_rows;
					 if($count36>0)
					 {
						$primary_doctor=$row36['name'];
						$ini=$row36['username'];
					 }
					 $doc_title=" - ".$primary_doctor;
					 
	}
	
	 $title_span="";
	$title_span="OPD Patient Report From ".date("d-M-Y", strtotime($_POST['from_date']))." To ".date("d-M-Y", strtotime($_POST['to_date'])).$doc_title;
	
	  if($doc_id!='0'){

		$extra_query=" AND `prescription_details_for_emr`.`primary_doctor`='".$doc_id."' ";

	  }

	 if(($from_date=='')||($to_date=='')){

		 $date_query="";

	 }else{

		$date_query=" AND DATE(`prescription_details_for_emr`.`created_on`) BETWEEN '".$from_date."' AND  '".$to_date."' ";

	 }

	 

	 if(($from_date=='')&&($to_date=='')&&($uhid_no_srch=='')){

		 $default_query=" AND DATE(`prescription_details_for_emr`.`created_on`) BETWEEN '".$today."' AND  '".$today."' ";

	 }

	 

	 

	$arr=array();
	$sl_no=1;
	
	$sql3="SELECT `prescription_details_for_emr`.`id`,`prescription_details_for_emr`.`mrd_no`,`prefix_masters`.`prefix_name`,`prescription_details_for_emr`.`fname`,`prescription_details_for_emr`.`lname`,`prescription_details_for_emr`.`age`,`prescription_details_for_emr`.`investigation`,`prescription_details_for_emr`.`created_on`,`prescription_details_for_emr`.`temp_save`,`prescription_details_for_emr`.`dilatation`,`prescription_details_for_emr`.`dilatation_time`,`prescription_details_for_emr`.`username77`,`prescription_details_for_emr`.`print_prescription`,`prescription_details_for_emr`.`termination`,`purposevisit_masters_for_emr`.`purpose_visit` AS `purpose_visit_name`,`prescription_details_for_emr`.`next_visit_day`,`prescription_details_for_emr`.`next_visit_week`,`prescription_details_for_emr`.`next_visit_month`,`prescription_details_for_emr`.`next_visit_year`,`prescription_details_for_emr`.`mobile`,`prescription_details_for_emr`.`surgery`,`prescription_details_for_emr`.`procedure_comments`,`user_infos`.`name` AS `doc_name`,`prescription_details_for_emr`.`no_dialation`,`prescription_details_for_emr`.`no_dialation_reason`,`prescription_details_for_emr`.`terminted_on`,`prescription_details_for_emr`.`primary_doctor`,`prescription_details_for_emr`.`wrdoby` FROM `prescription_details_for_emr` LEFT JOIN `purposevisit_masters_for_emr` ON `prescription_details_for_emr`.`purpose_visit_id`= `purposevisit_masters_for_emr`.`id` INNER JOIN `user_infos` ON `prescription_details_for_emr`.`primary_doctor`= `user_infos`.`users_id` INNER JOIN `prefix_masters` ON `prescription_details_for_emr`.`prefix`= `prefix_masters`.`id` WHERE 1 $default_query $date_query $extra_query $uhid_query AND `prescription_details_for_emr`.`del_flag`='0'  ORDER BY `prescription_details_for_emr`.`termination` ASC, `prescription_details_for_emr`.`id` DESC ";               



	 $result3=$conn->query($sql3) ;


	 $count=$result3->num_rows;



	 if($count>'0'){



						 $data_return_flag=1; 



						 $sl_no=1;



						 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))



						 {	



							$rowclass="";

					 	if($row3['username77']!=''){

							$rowclass="#f59f01";

						}

						if($row3['dilatation']=='1'){

							$rowclass="#92bce0";

						}

						if($row3['print_prescription']=='1'){

							$rowclass="#d0e9c6";

						}						

						

						if($row3['terminted_on']!=''){

						$assigned_time_new = $row3['created_on'];

						$completed_time_new= $row3['terminted_on'];   

						$d1_new = new DateTime($assigned_time_new);

						$d2_new = new DateTime($completed_time_new);

						$interval_new = $d2_new->diff($d1_new);

						$time_taken=$interval_new->format('%H');

						$time_taken_minutes=$interval_new->format('%I');

						

						if($time_taken=='01'){

							if($time_taken_minutes>'29'){

							$rowclass="#10c52f";

							}

						}else{


							$rowclass="#ed420f";

						}

						

						}

						if($row3['termination']=='1'){

							$rowclass="#ebcccc";

						}						

						

						$optom_name="";

						if($row3['username77']!=''){

							$sql25="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['username77']."'";

								 $result25=$conn->query($sql25) ;				

								 $row25 = $result25->fetch_assoc();

								 $count25=$result25->num_rows;

								 if($count25>0)

								 {

									$optom_name=$row25['name'];

								 }

						}


	$pateint_name="";
	$pateint_others_test="";
		
	$id=$row3['id'];

	$mrd_no=$row3['mrd_no'];
	$pateint_name=$row3['prefix_name'].' '.$row3['fname'].' '.$row3['lname'].'<br/> Age: '.$row3['age'].'<br/> Mobile No.: '.$row3['mobile'];
	$patient_name=$row3['prefix_name'].' '.$row3['fname'].' '.$row3['lname'];	
	$age=$row3['age'];
	$mobile=$row3['mobile'];

	$purpose_visit_name=$row3['purpose_visit_name'];

	$pateint_others_test='Investigation: '.limit_text($row3['investigation'], 4).'<br/> Surgery Advice: '.limit_text($row3['surgery'], 4).'<br/> Procedure Advice: '. limit_text($row3['procedure_comments'], 4);	

	 $modifiaction_details="";



	if($row3['terminted_on']!=''){ 	
		$assigned_time = $row3['created_on'];		
		$completed_time= $row3['terminted_on'];  		
		$d1 = new DateTime($assigned_time);		
		$d2 = new DateTime($completed_time);		
		$interval = $d2->diff($d1);		
		$desired_time_int= $interval->format('%H hours, %I minutes, %S seconds');                       

	  $modifiaction_details=' <br /><b>Print Prescription time / Terminated Time: </b> '. date("h:i A", strtotime($row3['terminted_on'])).'<br /> <b>Prescription Duration Time: </b>'.$desired_time_int; 
	  } 

	$created_on=date("d/m/Y", strtotime($row3['created_on']));

	$data_details=date("d/m/Y", strtotime($row3['created_on'])).'<br/><b>Starting time : </b> '.date("h:i A", strtotime($row3['created_on'])). $modifiaction_details;

	$dialation="";
	if(($row3['dilatation']==1)&&($row3['dilatation_time']!='')){		
		$dialation=date('h:i A',strtotime($row3['dilatation_time']));
	}else if(($row3['no_dialation']==1)&&($row3['no_dialation_reason']!='')){
		 $dialation='<b>Reason Of No Dilatation : </b>'.$row3['no_dialation_reason'];
	} else{ $dialation='--';}
	$optom_name=$optom_name;
	$pri_doct="";
	$pri_doct=$row3['doc_name'];

	
	
	$action_tab="<a href='".ADMIN_URL."edit_prescription_for_emr.php?id=".$row3['id']."'  title='Edit Prescription' ><img src='". ADMIN_URL."icon/bt_edit.gif'  title='Edit Prescription'></a> | <a href='".ADMIN_URL."edit_prescription_for_emr_for_mobile.php?id=".$row3['id']."'  title='Edit Prescription for Mobile' ><img src='". ADMIN_URL."icon/mob_edit.png'  title='Edit Prescription for Mobile'></a> | <a href='".ADMIN_URL."printPrescription_for_emr.php?id=".$row3['id']."' target='_blank' title='Print Prescription' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print Prescription'></a> | <a href='javascript:void(0);' onclick='check(".$row3['id'].");' title='Download Attachments' ><img src='". ADMIN_URL."icon/download_icon.png'  title='Download Attachments'></a> | <a href='".ADMIN_URL."sepGlassprescription_for_emr.php?id=".$row3['id']."' target='_blank' title='Print Glass Prescription' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print Glass Prescription'></a> | <a onClick=\"if(confirm('Are you sure to Delete for $patient_name?')) return true; else return false;\" href='".ADMIN_URL."?delete=".$row3['id']."'  title='Delete' ><img src='". ADMIN_URL."icon/delete.gif'  title='Delete'></a> | <a href='".ADMIN_URL."sepMedication_for_emr.php?id=".$row3['id']."' target='_blank' title='Print Medication Prescription' ><img src='". ADMIN_URL."icon/printButton.png'  title='Print Medication Prescription'></a> | <a onClick=\"if(confirm('Are you sure to terminate for $patient_name?')) return true; else return false;\" href='".ADMIN_URL."?terminate=".$row3['id']."&termination=".$row3['termination']."&mobile=".$row3['mobile']."&nextday=".$row3['next_visit_day']."&nextweek=".$row3['next_visit_week']."&nextmonth=".$row3['next_visit_month']."&nextyear=".$row3['next_visit_year']."&fname=".$row3['fname']."&lname=".$row3['lname']."&mrd_no=".$row3['mrd_no']."'  title='Terminate ' ><img src='". ADMIN_URL."icon/terminate.png'  title='Terminate '></a> | <a href='".ADMIN_URL."oldpatient_search_for_emr.php?id=".$row3['id']."&mrd=".$row3['mrd_no']."' target='_blank' title='Old Prescription Archive' ><img src='". ADMIN_URL."icon/arrow.png'  title='Old Prescription Archive'></a> | <a href='javascript:void(0);' onclick='check3(".$row3['id'].");' title='Download Camera Attachments' ><img src='". ADMIN_URL."icon/download_icon.png'  title='Download Camera Attachments'></a> | <a href='javascript:void(0);' onclick='check_sms_send(".$row3['id'].");' title='SMS Message Send' ><img src='". ADMIN_URL."icon/sms_30x30.png'  title='SMS Message Send'></a>";




		$arr[]=array("sl_no"=>$sl_no,"id"=>$id,"rowclass"=>$rowclass,"mrd_no"=>$mrd_no,"pateint_name"=>$pateint_name,"purpose_visit_name"=>$purpose_visit_name,"pateint_others_test"=>$pateint_others_test,"data_details"=>$data_details,"dialation"=>$dialation,"optom_name"=>$optom_name,"pri_doct"=>$pri_doct,"action_tab"=>$action_tab,"patient_name"=>$patient_name,"age"=>$age,"mobile"=>$mobile,"created_on"=>$created_on,"title_span"=>$title_span);



		$sl_no++; 



	}}



		echo json_encode($arr);



	







}



?>