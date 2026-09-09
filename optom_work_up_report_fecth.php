<?php

include 'function.php';

include 'conn.php';

/*

ini_set('display_errors', 1);

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

<title>Pushpanjali collection Reports MIS</title>

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

	padding:4px;

	text-align:center;

}

.defualt_td_spcl {

	font-size:9px !important;

	padding:4px;

	text-align:center;

}

.bold_td {

	font-size:12px !important;

	font-weight:bold !important;

	padding:4px;

	text-align:center;

}

.bord {

	border:none !important;

	padding:4px;

	text-align:center;

}

.bord_bott {

	border-left:none !important;

	border-right:none !important;

	border-top:none !important;

	border-bottom:2px solid #000 !important;

	padding:4px;

	text-align:center;

}

.bord_bott_final {

	border-left:none !important;

	border-right:none !important;

	border-top:none !important;

	border-bottom:2px solid #000 !important;

	padding:4px;

	text-align:center;

	font-size:16px !important;

}

.bord_bott_final_tot {

	border-left:none !important;

	border-right:none !important;

	border-top:none !important;

	border-bottom:2px solid #000 !important;

	padding:4px 4px 4px 12px;

	text-align:right;

	font-size:16px !important;

}

.bord_top {

	border-left:none !important;

	border-right:none !important;

	border-bottom:none !important;

	border-top:2px solid #000 !important;

	padding:4px;

	text-align:center;

}

.bold_td_big {

	font-size:13px !important;

	font-weight:bold !important;

	color:#C00 !important;

	padding:4px;

	text-align:center;

}

</style>

<style type="text/css" media="print">

@media print {

.notprnt {

	display:none;

}

}

</style>

</head>



<body style="padding:5px;">

<?php 

$from_date = date("Y-m-d", strtotime($_REQUEST['from_date']));

$to_date = date("Y-m-d", strtotime($_REQUEST['to_date']));

$optom_id = $_REQUEST['optom_id'];

$optom_name="All Optom";



if($optom_id!='0'){

	$sql25="SELECT `name` FROM `user_infos` Where `users_id`='".$optom_id."'";

	 $result25=$conn->query($sql25) ;				

	 $row25 = $result25->fetch_assoc();

	 $count25=$result25->num_rows;

	 if($count25>0)

	 {

		$optom_name=$row25['name'];

	 }



}

$title_span="Optom Work Up Report From ".date("d-M-Y", strtotime($_REQUEST['from_date']))." To ".date("d-M-Y", strtotime($_REQUEST['to_date']))." For ".$optom_name;

?>

<div class="notprnt">

  <div class="col-md-12">

    <div class="col-md-3">

      <button type="button" name="exportBtn"  id="exportBtn"  class="btn red" title="Export to Excel">Export to Excel</button>

      <button type="button" name="printBtn"  id="printBtn"  class="btn red" title="Export to Excel" onclick="window.print();">Print</button>

      <input type="hidden" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo $_REQUEST['from_date']; ?>" />

      <input type="hidden" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo $_REQUEST['to_date']; ?>" />

      <input type="hidden" class="form-control" placeholder="Select To Date" id="optm_name" name="optm_name" value="<?php echo "For ".$optom_name; ?>" />

    </div>

  </div>

  <div class="col-md-12">

    <p>&nbsp;</p>

  </div>

</div>

<table width="100%" border="1" cellspacing="0" cellpadding="0" id="my_data_Table" >

  <tr>

    <td colspan="6" style="padding:6px 4px; font-size:12pt; text-align:left; font-family:Arial, Helvetica, sans-serif"><strong><?php echo $title_span; ?></strong></td>

  </tr>

  <?php 

  			$extra_query="";

			  if($optom_id!='0'){

			   $extra_query=" AND `prescription_details_for_emr`.`username77`='".$optom_id."' ";

			  }

			  $print_query="";

			//  $print_query=" AND `prescription_details_for_emr`.`print_prescription`='1' ";

			  

			   $doc_sl=1;

			   $all_sl=0;

		 $sql_doc=" SELECT DISTINCT (`prescription_details_for_emr`.`username77`) AS `distinct_optom_id` FROM `prescription_details_for_emr` INNER JOIN `user_infos` ON `prescription_details_for_emr`.`username77`=`user_infos`.`users_id`  WHERE DATE(`prescription_details_for_emr`.`created_on`) BETWEEN '".$from_date."' AND  '".$to_date."'  $extra_query AND `prescription_details_for_emr`.`del_flag`='0' $print_query  ORDER BY `user_infos`.`name` ASC ";     

	 $result_doc=$conn->query($sql_doc) ;

	 $count_doc=$result_doc->num_rows;

	 if($count_doc>'0'){

		 while ($row_doc=mysqli_fetch_array($result_doc,MYSQLI_ASSOC))

			 {	

			 

			 		$primary_optom="";

					 $ini_optom="";	

			  		 $sql11="SELECT `user_infos`.`name`,`users`.`username` FROM `user_infos` INNER JOIN `users` ON `user_infos`.`users_id`=`users`.`id` Where `user_infos`.`users_id`='".$row_doc['distinct_optom_id']."'";

					 $result11=$conn->query($sql11) ;

					 $row11 = $result11->fetch_assoc();

					 $count11=$result11->num_rows;

					 if($count11>0)

					 {

						$primary_optom=$row11['name'];

						$ini_optom=$row11['username'];

					 }

					  echo '<tr><td colspan="6" style="padding:4px;"><center><span style="font-size:13pt;font-weight:bold !important;">'.$primary_optom.'</span></center></td></tr>' ;

				$optom_where="";

			 $optom_where=" AND `prescription_details_for_emr`.`username77`='".$row_doc['distinct_optom_id']."' ";

			   

			 $sql_inner=" SELECT  `prescription_details_for_emr`.* ,`user_infos`.`name` AS `doc_name`,`prefix_masters`.`prefix_name` FROM `prescription_details_for_emr` INNER JOIN `user_infos` ON `prescription_details_for_emr`.`primary_doctor`=`user_infos`.`users_id`  LEFT JOIN `prefix_masters` ON `prescription_details_for_emr`.`prefix`= `prefix_masters`.`id` WHERE DATE(`prescription_details_for_emr`.`created_on`) BETWEEN '".$from_date."' AND  '".$to_date."'  $extra_query AND `prescription_details_for_emr`.`del_flag`='0' $optom_where  $print_query GROUP BY `prescription_details_for_emr`.`mrd_no` ORDER BY `prescription_details_for_emr`.`id` ASC";   

	 $result_inner=$conn->query($sql_inner) ;

	 $count_inner=$result_inner->num_rows;

	 if($count_inner>'0'){

			 $sl_inner=1;

			 while ($row_inner=mysqli_fetch_array($result_inner,MYSQLI_ASSOC))

			 {	

			 

			  if($sl_inner==1){						

						echo '<tr>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Sl No.</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Prescription Date </strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>RegId</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Patient Name</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Phone No.</strong></td>

                <td style="border-bottom:2px solid #000000; padding:4px; text-align:center"><strong>Doctor</strong></td>

              </tr>';

					 }

					 $print_url="";

				$print_url= ADMIN_URL.'printPrescription_for_emr.php?id='.$row_inner['id']; 

				echo ' <tr ><td class="defualt_td">'.$sl_inner.'</td><td class="defualt_td"><a href="'.$print_url.'" target="_blank" title="Prescription Print" style="color:#0a5595 !important;">'.date("d-M-Y", strtotime($row_inner['created_on'])).'</a></td><td class="defualt_td">'.$row_inner['mrd_no'].'</td><td class="defualt_td">'.$row_inner['prefix_name'].' '.$row_inner['fname'].' '.$row_inner['lname'].'</td><td class="defualt_td">'.$row_inner['mobile'].'</td><td class="defualt_td">'.$row_inner['doc_name'].'</td></tr>';	 

					 

			 $sl_inner++; 

			 $all_sl++;

			 }}

			 

			$doc_sl++;		

			}}

			

	//echo $all_sl;

    ?>

</table>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

 $(document).ready( function() {  

	$('#exportBtn').on('click', function () {

		var tableData = [];

		$('#my_data_Table tr').each(function () {

			var rowData = [];

			$(this).find('th, td').each(function () {

				rowData.push($(this).text());

			});

			tableData.push(rowData);

		});

		var from_date=$("#from_date").val();

		var to_date=$("#to_date").val();

	

		$.ajax({

			url: 'optom_work_up_report_export_data.php?from_date='+from_date+'&to_date='+to_date,

			type: 'POST',

			data: { tableData: JSON.stringify(tableData) },

			success: function (response) {

				// Trigger download

				window.location.href = response;

			}

		});

	});



});

</script>

<script>

//window.print();

</script>

</html>

