<?php
include 'conn.php';
$cur_date=date('Y-m-d');
$today=date('Y-m-d H:i:s');
$created_by=$_SESSION['id'];
$sql3="SELECT `hsn_code_gst_master`.`hsn_code`, `item_master`.* FROM `item_master` INNER JOIN `hsn_code_gst_master` ON `item_master`.`hsm_code`=`hsn_code_gst_master`.`id`";
$result3=$conn->query($sql3)or die($conn->error().$sql3) ;
	 $sl=1;
	 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
	 {
		 //echo $sl.' -  '.$row3['TABLE_NAME'].'<br/>';
		 $new_id=$row3['hsn_code'];
		// echo $row3['sub_type_id'].' - new - '.$new_id.'<br/>';
		//$tab_name=$row3['TABLE_NAME'];
		 //$sql8="ALTER TABLE `$tab_name` CHANGE `created_by` `created_by` INT(11) NOT NULL DEFAULT '0';";
		 //$sql8="ALTER TABLE `$tab_name` CHANGE `modified_by` `modified_by` INT(11) NOT NULL DEFAULT '0';";
		 $sql8="UPDATE `item_master` SET `hsm_code`='".$new_id."' WHERE `id`='".$row3['id']."';";					 
		 //echo'<br/>';
		 $result8=$conn->query($sql8) ;
		 $sl++;
	 }
?>