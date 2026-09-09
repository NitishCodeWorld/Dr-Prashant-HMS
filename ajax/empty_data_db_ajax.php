<?php
include '../conn.php';
$id=$_POST["id"];
$db_name=$_POST["db_name"];
$table_name=$_POST["table_name"];
$flag=0;
$empty_msg="";
$modified_by=$_SESSION['id'];
$modified_time=date('Y-m-d H:i:s');
if(($id!='')&&($db_name!='')){
	$sql="TRUNCATE `$db_name` ";
	$result=$conn->query($sql) ;
	$sql_new="UPDATE  `$table_name` SET `empty_flag`='1',`modified_by`='".$modified_by."' ,`modified_time`='".$modified_time."' WHERE `id`='".$id."' ";
	$result_new=$conn->query($sql_new) ;
	$flag=1;
	$empty_msg="TRUNCATE / EMPTY Data Of Table -> `".$db_name."`  Done";
}else{
	$sql3="SELECT * FROM `$table_name` WHERE  `del_flag`='0' ORDER BY `id` ASC";
	$result3=$conn->query($sql3) ;
	while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))				 
	{
		$db_rows=$row3['db_name'];
		$id_rows=$row3['id'];
		$sql="TRUNCATE `$db_rows` ";
		$result=$conn->query($sql) ;
		$sql_new="UPDATE  `$table_name` SET `empty_flag`='1',`modified_by`='".$modified_by."' ,`modified_time`='".$modified_time."' WHERE `id`='".$id_rows."' ";
		$result_new=$conn->query($sql_new) ;
		$flag=1;
		$empty_msg="TRUNCATE / EMPTY All Data Of Table -> `".$table_name."`  Done";
	}
}

$arr=array("flag" => $flag,"empty_msg" => $empty_msg);
echo json_encode($arr);
?> 

