<?php
include 'conn.php';
$today=date('Y-m-d H:i:s');
$created_by=$_SESSION['id'];
$sql7 = "INSERT INTO `menu_access_distribution_to_employees` SET `created_on`='".$today."' , `created_by`='".$created_by."' ";
if($result=$conn->query($sql7)){
$id = $conn->insert_id;		
$redirectUrl = ADMIN_URL . 'menu_access_distribution_to_employees.php?id=' . $id.'&emp_id= ';
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
?>