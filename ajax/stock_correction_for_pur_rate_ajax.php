<?php
include '../conn.php';
$optom_id=$_POST["id"];

$sql="SELECT * FROM `purchase_details` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$item_name=$row['item_name'];
$batch_no=$row['batch_no'];
$expiry_date=$row['expiry_date'];
$qty=$row['qty'];
$rate=$row['rate'];
$mrp=$row['mrp'];
$date=date("Y-m-d", strtotime($row['date']));
$arr=array("id" => $id,"item_name" => $item_name,"batch_no" => $batch_no,"expiry_date" => $expiry_date,"qty" => $qty,"rate" => $rate,"mrp" => $mrp,"date" => $date);
echo json_encode($arr);
}
?> 