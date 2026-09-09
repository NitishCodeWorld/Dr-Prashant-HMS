<?php
include '../conn.php';
$age=$_POST['age'];
$currentDate = new DateTime();
// Subtract the age from the current date
$dob = $currentDate->sub(new DateInterval("P{$age}Y"));
// Return formatted date of birth (e.g., Y-m-d)
$dob_actual_format= $dob->format('Y-m-d');
$dob_date_picker_format=date('d-m-Y',strtotime($dob_actual_format));
$arr=array("dob" => $dob_date_picker_format, "dob_actual_format" => $dob_actual_format);
echo json_encode($arr);
?> 



