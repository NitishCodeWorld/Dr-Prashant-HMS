<?php
include('../conn.php');
$cid = $_POST['cid'];	
$sql="SELECT `id`, `dept_id`, `desig_name` FROM `designation_details_masters`  WHERE `dept_id`='".$cid."' ";
$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$arr=array();
while($row=mysqli_fetch_assoc($result)){
extract($row);	
$arr[]=array("value"=>$id,"text"=>$desig_name);
}
echo json_encode($arr);
?>