<?php 
include 'conn.php';
$today=date('Y-m-d H:i:s');
$sql6 = $conn->query("UPDATE `login_details` SET `logout_time`='".$today."' WHERE `id`='".$_SESSION["login_unique_id"]."'");
session_destroy();
//header("location:index.php");
$redirectUrl=ADMIN_URL; // Main URL
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
?>