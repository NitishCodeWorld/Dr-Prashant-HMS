
<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `options` FROM `regional_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$reg=$row['options'];
$arr=array("id" => $id,"options" => $reg);
echo json_encode($arr);
}

?> 

