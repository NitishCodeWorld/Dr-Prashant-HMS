<?php

include '../conn.php';

$optom_id=$_POST["id"];

$sql="SELECT `id`, `purpose_name` FROM `procedure_purpose_masters_for_appt` WHERE `id`='".$optom_id."'";

$result=$conn->query($sql) ;

$count=$result->num_rows;

$row = $result->fetch_assoc();

if($count>0)

{

$id=$row['id'];

$purpose_name=$row['purpose_name'];

$arr=array("id" => $id,"purpose_name" => $purpose_name);

echo json_encode($arr);

}



?> 



