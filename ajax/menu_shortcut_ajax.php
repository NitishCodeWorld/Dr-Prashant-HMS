<?php
include '../conn.php';
$optom_id=$_POST["main_menu_id"];
$sql="SELECT `id`, `sub_menu_name`,`url` FROM `sub_menu_masters` WHERE `main_menu_id`='".$optom_id."' and `del_flag`='0'";
$result=$conn->query($sql) ;
$arr=array();
$flag=0;
$count=$result->num_rows;
if($count>0)
{
	$flag=1;
}
$arr=array("count"=>$count,"flag"=>$flag);
echo json_encode($arr);
?> 

