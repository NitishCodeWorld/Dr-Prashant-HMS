<?php
include '../conn.php';
$range_upper=$_POST["range_upper"];
$str_arr = preg_split ("/\./", $range_upper);
$starting_range=($str_arr[0]*100)+1;
$end_range=($str_arr[0]*100)+100;
$arr=array("starting_range" => $starting_range,"end_range" => $end_range);
echo json_encode($arr);
?> 

