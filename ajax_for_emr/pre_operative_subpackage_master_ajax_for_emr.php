<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT  `pre_operative_subpackage` FROM `pre_operative_subpackage_master_for_emr` WHERE `pre_operative_package_id`='".$optom_id."' ORDER BY `id` DESC";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$pre_operative_subpackage="";
if($count>0)
{
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))

				 {
					
$pre_operative_subpackage=$row['pre_operative_subpackage'].'~'.$pre_operative_subpackage;
					 
				 }
}
$arr=array("pre_operative_subpackage" => $pre_operative_subpackage,"count" => $count);
echo json_encode($arr);

?> 

