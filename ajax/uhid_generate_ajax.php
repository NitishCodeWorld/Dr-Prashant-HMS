<?php
include '../conn.php';

$created_by=$_SESSION['id'];

$today=date('Y-m-d H:i:s');

$sql="SELECT MAX(`max_mrd_no`) AS `max_mrd` FROM `mrd_increments`  ";

 $result=$conn->query($sql) ;	

 $row = $result->fetch_assoc();	

 $mrd_no= $row['max_mrd']+1;
/* $zero="";
 if($mrd_no<10){
	 $zero="00";
 }else if($mrd_no<100){
	$zero="0";
 }else{
	$zero=""; 
 }
 $mrdno="DEC-".$zero.$mrd_no;*/
// $mrdno=$mrd_no;
$mrdno="PEC".$mrd_no;
 $sql7 = "INSERT INTO `mrd_increments` SET `mrd_no`='".$mrdno."',`max_mrd_no`='".$mrd_no."', `created_on`='".$today."' , `created_by`='".$created_by."' ";

 if($conn->query($sql7)===TRUE)

{

	$arr=array("mrd_no" => $mrdno);

	echo json_encode($arr);

}

?>
