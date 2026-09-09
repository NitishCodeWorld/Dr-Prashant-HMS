<?php
include '../conn.php';
$uhid_no=$_POST["uhid_no"];
$admiting_doctor=$_POST["admiting_doctor"];
$registration_date= date("Y-m-d", strtotime($_POST['registration_date']));
$flag=0;

$sql = "SELECT * FROM `patient_slip_generate_form` WHERE date(`registration_date`) = '".$registration_date."' AND  `admiting_doctor` = '".$admiting_doctor."' AND  `uhid_no` = '".$uhid_no."' AND `del_flag`='0'	ORDER BY `id` DESC LIMIT 1 ";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$flag=1;
}
$arr=array("flag" => $flag);
echo json_encode($arr);
?> 

