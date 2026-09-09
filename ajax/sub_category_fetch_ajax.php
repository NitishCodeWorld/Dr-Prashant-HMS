<?php
include '../conn.php';
$request_id=$_POST["id"];
$sql="SELECT `id`, `category_id`, `sub_category_name`, `del_flag` FROM `sub_category_masters`  WHERE `category_id`='".$request_id."' AND `del_flag`='0'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$arr=array();
$counter=1;
//$row = $result->fetch_assoc();
if($count>0)
{
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
$id=$row['id'];
$sub_category_name=$row['sub_category_name'];
//unset($arr);
//$arr=array("count" => $count);
$arr[]=array("id" => $id,"sub_category_name" => $sub_category_name);
$counter++;
}
echo json_encode($arr);
}
else{
$arr[]=array("id" => '0',"sub_category_name" => '');	
echo json_encode($arr);
}
?>