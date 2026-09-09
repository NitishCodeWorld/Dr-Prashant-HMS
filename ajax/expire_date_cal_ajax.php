<?php
include '../conn.php';
$a_date=$_POST["a_date"];
$return_date=date("t", strtotime($a_date));
$arr=array("return_date" => $return_date);
echo json_encode($arr);
?> 