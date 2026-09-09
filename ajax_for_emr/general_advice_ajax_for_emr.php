<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `general_advise` FROM `general_advise_masters_for_emr` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$general_advise=$row['general_advise'];
$arr=array("id" => $id,"general_advise" => $general_advise);
echo json_encode($arr);
}

?> 

