<?php include 'conn.php'; ?>
<?php 
$sql3="SELECT * FROM `zzzzz_empty_entry_data_db` ";
$result3=$conn->query($sql3) ;
$id=1;
while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
  $sql8=$conn->query(" TRUNCATE `".$row3['db_name']."`; ");
  
}
 ?>
