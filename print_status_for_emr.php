<?php
include 'conn.php';
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
$print_prescription=$_REQUEST['print_prescription'];
$terminted_on=date('Y-m-d H:i:s');
$id=$_REQUEST['id'];
//echo "UPDATE `prescription_details` SET `print_prescription`= '".$print_prescription."',`terminted_on`= '".$terminted_on."' WHERE `id`='".$id."' ";
$sel_de22 = $conn->query("UPDATE `prescription_details_for_emr` SET `print_prescription`= '".$print_prescription."',`terminted_on`= '".$terminted_on."' WHERE `id`='".$id."' ");
//echo "success";
echo json_encode(array("flag"=>1));
?>