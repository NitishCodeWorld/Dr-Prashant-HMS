<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT * FROM `disease_template_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();

$id=$row['id'];
$name=$row['name'];
$arr=array("id" => $id,"gp_name" => $name,"template_html" => $row['template_html']);
echo json_encode($arr);


?> 

