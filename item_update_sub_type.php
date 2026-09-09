<?php
include 'conn.php';
$cur_date=date('Y-m-d');
$today=date('Y-m-d H:i:s');
$created_by=$_SESSION['id'];
$sql3="SELECT * FROM item_master";
$result3=$conn->query($sql3)or die($conn->error().$sql3) ;
	 $sl=1;
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		 //echo $sl.' -  '.$row3['TABLE_NAME'].'<br/>';
		 $new_id=$row3['sub_type_id']+10;
		// echo $row3['sub_type_id'].' - new - '.$new_id.'<br/>';
		//$tab_name=$row3['TABLE_NAME'];
		 //$sql8="ALTER TABLE `$tab_name` CHANGE `created_by` `created_by` INT(11) NOT NULL DEFAULT '0';";
		 //$sql8="ALTER TABLE `$tab_name` CHANGE `modified_by` `modified_by` INT(11) NOT NULL DEFAULT '0';";
		 $sql8="UPDATE `item_master` SET `sub_type_id`='".$new_id."' WHERE `id`='".$row3['id']."';";					 
		 //echo'<br/>';
		 $result8=$conn->query($sql8) ;
		 $sl++;
	 }
?>