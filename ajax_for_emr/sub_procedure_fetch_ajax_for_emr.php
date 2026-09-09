<?php
include '../conn.php';
$request_id=$_POST["id"];
$sql="SELECT `id`, `package_id`, `procedure_package_subtext`, `sub_amount` FROM `procedure_subpackage_masters_for_emr`  WHERE `package_id`='".$request_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$arr=array();
$counter=1;
//$row = $result->fetch_assoc();
if($count>0)
{
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
$id=$row['id'];
$package_id=$row['package_id'];
$procedure_package_subtext=$row['procedure_package_subtext'];
$sub_amount=$row['sub_amount'];
//unset($arr);
//$arr=array("count" => $count);
$arr[]=array("count" => $count,"id" => $id,"package_id" => $package_id,"procedure_package_subtext" => $procedure_package_subtext,"sub_amount" => $sub_amount,"counter" => $counter);
$counter++;

}
echo json_encode($arr);
}
?>