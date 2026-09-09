<?php include 'conn.php'; ?>
<?php 
		
		
				  $sql3="SELECT * FROM `purchase`  ORDER BY `id` DESC";  // expiry date
				  $result3=$conn->query($sql3) ;
				  $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {
					  //change
					  
					  
					 echo $row3['id'].' -> '.$row3['amount'].' -> '.$row3['grand_net_total_'].'<br/>';
					$sql9= $conn->query("UPDATE `purchase` SET `grand_net_total_`='".$row3['amount']."' WHERE `id`='".$row3['id']."' ");
					
				  $id++; }
				  
				  ?>
             