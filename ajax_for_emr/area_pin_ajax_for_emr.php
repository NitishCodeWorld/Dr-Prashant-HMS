<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`,`location`, `pin`, `latitude`, `longitude` FROM `area_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$location=$row['location'];
$pin=$row['pin'];
$latitude=$row['latitude'];
$longitude=$row['longitude'];
$arr=array("id" => $id,"location" => $location,"pin" => $pin,"latitude" => $latitude,"longitude" => $longitude);
echo json_encode($arr);
}

?> 

