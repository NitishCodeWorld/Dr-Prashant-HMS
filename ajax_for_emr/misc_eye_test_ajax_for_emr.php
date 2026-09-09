<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `misc_eye_test_name` FROM `miscellaneous_eye_test_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$misc_eye_test_name=$row['misc_eye_test_name'];
$arr=array("id" => $id,"misc_eye_test_name" => $misc_eye_test_name);
echo json_encode($arr);
}
?> 



