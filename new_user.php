<?php

include 'conn.php';

$today=date('Y-m-d H:i:s');

$created_by=$_SESSION['id'];



$sql="SELECT MAX(`max_emp_id`) AS `max_emp` FROM `emp_id_increments`";

 $result=$conn->query($sql) ;	

 $row = $result->fetch_assoc();	

 $max_emp= $row['max_emp']+1;

 $max_emp_id="EMP".$max_emp;

 $sql7 = "INSERT INTO `emp_id_increments` SET `max_emp_id`='".$max_emp."',`emp_id`='".$max_emp_id."', `created_on`='".$today."' , `created_by`='".$created_by."' ";

 if($conn->query($sql7)===TRUE)

{	

$sql3 = "INSERT INTO `users` SET  `username`='".$max_emp_id."',`created_on`='".$today."' , `created_by`='" . $created_by . "',`password`='123'";

if ($conn->query($sql3) === true)

{

	$users_id = $conn->insert_id;	

	$sql6 = $conn->query("INSERT INTO `user_infos` SET `users_id`='".$users_id."', `created_on`='".$today."'");	

	$sql6 = $conn->query("INSERT INTO `hr_login` SET `username`='".$max_emp_id."',`users_id`='".$users_id."',`emp_id`='".$max_emp_id."', `created_on`='".$today."', `created_by`='" . $created_by . "',`password`='123' ");		

	$redirectUrl = ADMIN_URL . 'hrlogin_edit.php?users_id=' . $users_id;

	echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

}

}

?>