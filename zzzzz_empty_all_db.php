<?php include 'conn.php'; ?>
<?php 
//Add Code
$sql = "SHOW TABLES";
$result = $conn->query($sql);
echo '<table border="1"><tbody>';
$sl=1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        echo '<tr><td>'.$sl . '</td><td>'.$row[0] . '</td></tr>';
    
	$sl++;}
} else {
    echo "No tables found.";
}
echo '</tbody></table>';
 ?>
