<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT  `medication_package_subtext` FROM `medication_subpackage_masters_for_emr` WHERE `package_id`='".$optom_id."' ORDER BY `id` DESC";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$investigation_package_subtext="";
if($count>0){
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){		
		$investigation_package_subtext=$row['medication_package_subtext'].'~'.$investigation_package_subtext;
	}
}
$arr=array("medication_package_subtext" => $investigation_package_subtext,"count" => $count);
echo json_encode($arr);

?> 

