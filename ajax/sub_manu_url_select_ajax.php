<?php
include '../conn.php';
$optom_id=$_POST["submanu_id"];
$sql="SELECT `url`,`break_down_flag`,`special_flag` FROM `sub_menu_masters` WHERE `id`='".$optom_id."' and `del_flag`='0'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0){
$manu_url=$row['url'];
$break_down_flag=$row['break_down_flag'];
$special_flag=$row['special_flag'];
$arr=array("manu_url" => $manu_url,"break_down_flag" => $break_down_flag,"special_flag" => $special_flag);
echo json_encode($arr);

}
?> 

