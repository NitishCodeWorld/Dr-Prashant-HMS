<?php
include '../conn.php';
$floor_name=$_POST["floor_name"];
$ward_name=$_POST["ward_name"];
$category_name=$_POST["category_name"];
$equipment_name=$_POST["equipment_name"];
$code='';
if($floor_name!=''){
$sql="SELECT `f_code` AS `code` from `floor_master_for_complain` WHERE `del_flag`='0' AND `id`='".$floor_name."'";
$result=$conn->query($sql) ;
$row = $result->fetch_assoc();
$code.=$row['code'];
}		  
if($ward_name!=''){
$sql="SELECT `w_code` AS `code` from `ward_master_for_complain` WHERE `del_flag`='0' AND `id`='".$ward_name."'";
$result=$conn->query($sql) ;
$row = $result->fetch_assoc();
$code.=$row['code'];
}		  
if($category_name!=''){
$sql="SELECT `c_code` AS `code` from `category_master_for_complain` WHERE `del_flag`='0' AND `id`='".$category_name."'";
$result=$conn->query($sql) ;
$row = $result->fetch_assoc();
$code.=$row['code'];
}
if($equipment_name!=''){
$sql="SELECT `e_code` AS `code` from `equipment_master_for_complain` WHERE `del_flag`='0' AND `id`='".$equipment_name."'";
$result=$conn->query($sql) ;
$row = $result->fetch_assoc();
$code.=$row['code'];
}		  

$arr=array("code" => $code);
echo json_encode($arr);

?> 