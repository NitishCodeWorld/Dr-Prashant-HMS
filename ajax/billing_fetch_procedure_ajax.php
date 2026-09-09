<?php

include '../conn.php';

$pt_type=$_POST["pt_type"];

if($_POST["opd_flag"]=='1'){

$ipd_flag=0;

}else{

	$ipd_flag=1;	

}

$sql="SELECT `id`, `procedure_name`,`amount` FROM `procedure_masters` WHERE  `del_flag`='0'  AND `ipd_flag`='".$ipd_flag."'";

$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

$arr=array();

while($row=mysqli_fetch_assoc($result)){			

	extract($row);	
	
	$proceure_new_name=$procedure_name.' ( '.$amount.' ) ';

	$arr[]=array("value"=>$id,"text"=>$proceure_new_name);



}

echo json_encode($arr);

?> 