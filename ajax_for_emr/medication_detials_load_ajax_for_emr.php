<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT  `medication_package_subtext` FROM `medication_subpackage_masters_for_emr` WHERE `package_id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
if($count>0)
{
	$optm_name='';
 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
	if($optm_name=='')
	{
	$optm_name=$row['medication_package_subtext'];
	}else{
	$optm_name=$optm_name. "\n".$row['medication_package_subtext'];
	}
	}
$arr=array("optm_name" => $optm_name);
echo json_encode($arr);
}

?> 

