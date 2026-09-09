<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `anasthesia_name` FROM `anasthesia_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$anasthesia_name=$row['anasthesia_name'];
$arr=array("id" => $id,"anasthesia_name" => $anasthesia_name);
echo json_encode($arr);
}

?> 

