<?php
include 'conn.php';
$cur_date=date('Y-m-d');
$today=date('Y-m-d H:i:s');
$created_by=$_SESSION['id'];
$sql3="SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='".$db."'";
$result3=$conn->query($sql3)or die($conn->error().$sql3) ;
	 $sl=1;
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		 //echo $row3['TABLE_NAME'].'<br/>';
		 $tab_name=$row3['TABLE_NAME'];
		 //$sql8="ALTER TABLE `$tab_name` CHANGE `created_by` `created_by` INT(11) NOT NULL DEFAULT '0';";
		 //$sql8="ALTER TABLE `$tab_name` CHANGE `modified_by` `modified_by` INT(11) NOT NULL DEFAULT '0';";
			$sql8="ALTER TABLE `$tab_name` CHANGE `deleted_by` `deleted_by` INT(11) NOT NULL DEFAULT '0';";					 
		 
		 $result8=$conn->query($sql8) ;
	 }
?>