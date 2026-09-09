<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `main_menu_name`,`right_to_left_navigation` FROM `main_menu_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$main_menu_name=$row['main_menu_name'];
$right_to_left_navigation=$row['right_to_left_navigation'];

$arr=array("id" => $id,"main_menu_name" => $main_menu_name,"right_to_left_navigation" => $right_to_left_navigation);
echo json_encode($arr);
}

?> 

