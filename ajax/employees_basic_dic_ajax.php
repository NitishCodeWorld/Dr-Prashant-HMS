<?php
include '../conn.php';
$request_id=$_POST["id"];
$sql="SELECT `hr_login`.*, `department_masters`.`department`,`department_masters`.`id` as `dep_id` FROM `hr_login` left join `department_masters` on `department_masters`.`id`=`hr_login`.`emp_department` WHERE `hr_login`.`emp_id`='".$request_id."' ORDER BY `hr_login`.`id` DESC LIMIT 1";

$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
	//id`, `users_id`, `emp_id`, `emp_department`, `username`, `password`, `first_name`, `last_name`, `mobile`, `email`, `emp_designation`,
$id=$row['id'];
$dep_id=$row['dep_id'];
$emp_id=$row['emp_id'];
$users_id=$row['users_id'];
$emp_department=$row['department'];
$user_login_name=$row['username'];
$emp_full_name=$row['emp_name'];

$flag=1;
$arr=array("id" => $id,"emp_id"=>$emp_id,"users_id"=>$users_id,"emp_department"=>$emp_department,"emp_full_name"=>$emp_full_name,"user_login_name"=>$user_login_name,"dep_id"=>$dep_id,"flag"=>$flag);
echo json_encode($arr);
}
?> 