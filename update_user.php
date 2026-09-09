<?php
include "conn.php"; // Using database connection file here


 $sql7="SELECT * FROM `hr_login` WHERE `users_id`<>'1' ";
 $result7=$conn->query($sql7) ;
 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
 {	
	 $edit = mysqli_query($conn,"UPDATE `users` SET `username`='".$row7['emp_id']."' where `id`='".$row7['users_id']."' ") ;
	 $edit7 = mysqli_query($conn,"UPDATE `hr_login` SET `username`='".$row7['emp_id']."' where `users_id`='".$row7['users_id']."' ") ;

 }
?>
