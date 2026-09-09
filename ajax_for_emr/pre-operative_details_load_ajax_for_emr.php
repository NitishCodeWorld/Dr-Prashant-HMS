<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT  `pre_operative_subpackage` FROM `pre_operative_subpackage_master_for_emr` WHERE `pre_operative_package_id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
if($count>0)
{
	$optm_name='';
 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
	if($optm_name=='')
	{
	$optm_name=$row['pre_operative_subpackage'];
	}else{
	$optm_name=$optm_name. "\n".$row['pre_operative_subpackage'];
	}
	}
$arr=array("optm_name" => $optm_name);
echo json_encode($arr);
}

?> 

