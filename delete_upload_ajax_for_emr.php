<?php
include 'conn.php';
$request_id=$_POST["id"];
$i_id=$_REQUEST["i_id"];
$sql="DELETE FROM `image_list_for_emr` WHERE `prescription_id`='".$i_id."' AND `image_name`='".$request_id."'";
$result=mysqli_query($conn,$sql) or die(mysqli_error($conn)) ;
/*$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$flag=1;
$arr=array("flag" => $flag);
echo json_encode($arr);
}*/
if($result)
{
$flag=1;
$arr=array("flag" => $flag);
echo json_encode($arr);
}
?> 