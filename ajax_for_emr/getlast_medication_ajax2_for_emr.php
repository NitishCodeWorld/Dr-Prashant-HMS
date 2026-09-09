<?php
include '../conn.php';
$mrd_no=$_POST["mrd_no"];
$sql="SELECT  `medication`  FROM `prescription_details_for_emr` WHERE `mrd_no`='".$mrd_no."' AND  `medication`<>'' ORDER BY `id` DESC";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$inc=1;
if($count>0)
{
	$medication='';
 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
	if($inc==2){
	$medication=$row['medication'];	
	}
	$inc++;
	}
$arr=array("medication" => $medication);
echo json_encode($arr);
}
?> 

