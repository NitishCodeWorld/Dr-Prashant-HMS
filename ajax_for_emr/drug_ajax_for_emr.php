<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT * FROM `drug_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();

$id=$row['id'];
$name=$row['medication_individual'];
$arr=array("id" => $id,"gp_name" => $name);
echo json_encode($arr);


?> 

