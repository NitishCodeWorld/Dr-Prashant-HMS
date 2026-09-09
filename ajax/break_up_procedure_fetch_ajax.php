<?php
include '../conn.php';
$request_id=$_POST["id"];
if($_POST["opd_flag"]=='1'){
$ipd_flag=0;
}else{
	$ipd_flag=1;	
}
$sql="SELECT `id`, `break_up_procedure_name` FROM `invoice_break_up_procedure_masters` WHERE `del_flag`='0'  AND `ipd_flag`='".$ipd_flag."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$arr=array();
$counter=1;
//$row = $result->fetch_assoc();
if($count>0)
{
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
$id=$row['id'];
$break_up_procedure_name=$row['break_up_procedure_name'];
$sub_amount=0;
//unset($arr);
//$arr=array("count" => $count);
$arr[]=array("count" => $count,"id" => $id,"break_up_procedure_name" => $break_up_procedure_name,"sub_amount" => $sub_amount,"counter" => $counter);
$counter++;

}
echo json_encode($arr);
}
?>