<?php include 'conn.php'; ?>
<?php 
				  $sql3="SELECT `purchase_details`.`id`,`purchase_details`.`item_name` , `item_master`.`asset_name` FROM `purchase_details` INNER JOIN `item_master` ON  `purchase_details`.`item_id`=`item_master`.`id` ORDER BY `purchase_details`.`item_name` ASC";  // expiry date
				  $result3=$conn->query($sql3) ;
				  $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {
					  //change
					  if($row3['item_name']!=$row3['asset_name']){
					  
					 echo $row3['id'].' -> '.$row3['item_name'].' -> '.$row3['asset_name'].'<br/>';
					$sql9= $conn->query("UPDATE `purchase_details` SET `item_name`='".$row3['asset_name']."' WHERE `id`='".$row3['id']."' ");
					  }
              
				  $id++; }
				  
				  ?>
             