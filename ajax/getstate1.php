<?php
include('../conn.php');
$cid = $_POST['cid'];	
$sql="SELECT `id`, `floor_id`, `wname`, `created_by`, `created_on`, `modified_by`, `modified_time`, `del_flag`, `deleted_by`, `deleted_time` FROM `ward_details_masters`  WHERE `floor_id`='".$cid."' AND `del_flag`='0' ORDER BY `wname`";
$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$arr=array();
$count=$result->num_rows;
if($count>0){
while($row=mysqli_fetch_assoc($result)){
extract($row);	
$arr[]=array("value"=>$id,"text"=>$wname);
}
}else{
    $arr[]=array("value"=>"","text"=>"");
}
echo json_encode($arr);
?>