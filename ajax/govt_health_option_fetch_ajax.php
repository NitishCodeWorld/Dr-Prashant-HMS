<?php
include '../conn.php';
$no=$_POST["no"];
$sql="SELECT  * FROM `patient_type_master` WHERE  `del_flag`='0' ORDER BY `name` ASC";
$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$arr=array();
while($row=mysqli_fetch_assoc($result)){			
	extract($row);	
	$arr[]=array("value"=>$id,"text"=>$name);

}
echo json_encode($arr);
?> 