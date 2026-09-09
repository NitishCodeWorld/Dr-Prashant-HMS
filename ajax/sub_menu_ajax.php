<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `sub_menu_name`,`main_menu_id`,`url`,`function_click`,`break_down_flag` FROM `sub_menu_masters` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$sub_menu_name=$row['sub_menu_name'];
$main_menu_id=$row['main_menu_id'];
$url=$row['url'];
$function_click=$row['function_click'];
$break_down_flag=$row['break_down_flag'];
$arr=array("id" => $id,"sub_menu_name" => $sub_menu_name,"main_menu_id" => $main_menu_id,"url" => $url,"function_click"=>$function_click,"break_down_flag"=>$break_down_flag);
echo json_encode($arr);
}

?> 

