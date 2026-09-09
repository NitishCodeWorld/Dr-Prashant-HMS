<?php
include '../conn.php';
$optom_id=$_POST["mainmanu_id"];
$sql="SELECT `id`, `sub_menu_name`,`url` FROM `sub_menu_masters` WHERE `main_menu_id`='".$optom_id."' and `del_flag`='0'";
$result=$conn->query($sql) ;
$arr=array();
$count=$result->num_rows;
if($count>0){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
$id=$row['id'];
$sub_menu_name=str_replace('<i class="fa fa-ban" style="color:red !important;" aria-hidden="true"></i>', '', $row['sub_menu_name']);
$url=$row['url'];
$arr[]=array("value"=>$id,"text"=>$sub_menu_name);
}
}else{
	$arr[]=array("value"=>"","text"=>"");
}
echo json_encode($arr);
?> 

