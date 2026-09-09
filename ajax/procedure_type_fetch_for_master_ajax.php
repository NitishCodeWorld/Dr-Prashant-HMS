<?php
include '../conn.php';
$sql="SELECT `id`, `name` FROM `patient_type_master` WHERE  `del_flag`='0'  ";
$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
while($row=mysqli_fetch_assoc($result)){			
	extract($row);	
	$arr[]=array("id"=>$id,"name"=>$name);

}
echo json_encode($arr);
?> 