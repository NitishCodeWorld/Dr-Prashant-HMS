<?php
include '../conn.php';
//$dob=$_POST["dob"];
$dob=date("Y-m-d", strtotime($_POST['dob']));
$diff = date_diff(date_create($dob), date_create(date('Y-m-d')));
$arr=array("age" => $diff->format('%y'), "age_month" => $diff->format('%m'),"age_days" => $diff->format('%d'));
echo json_encode($arr);
?> 

