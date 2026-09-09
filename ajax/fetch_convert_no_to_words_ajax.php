<?php
include '../function.php';
include '../conn.php';
$fixed_net_total=$_POST["fixed_net_total"];
$number_to_words_val= ucwords(number_to_indian_rupees_convert($fixed_net_total));
$arr=array("number_to_words_val" => $number_to_words_val);
echo json_encode($arr);
?>