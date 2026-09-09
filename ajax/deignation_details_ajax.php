<?php
include '../conn.php';
$optom_id=$_POST["id"];
 $sql="SELECT `designation_details_masters`.`id`,`designation_details_masters`.`desig_name`,`designation_details_masters`.`upload_job_des_mas`,`department_masters`.`department`,`designation_details_masters`.`dept_id` FROM `designation_details_masters` INNER JOIN `department_masters` ON  `designation_details_masters`.`dept_id`=`department_masters`.`id` WHERE `designation_details_masters`.`id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$desig_name=$row['desig_name'];
$dept_id=$row['dept_id'];
$upload_job_des_mas=$row['upload_job_des_mas'];

$arr=array("id" => $id,"desig_name" => $desig_name,"dept_id" => $dept_id,"upload_job_des_mas" => $upload_job_des_mas);
echo json_encode($arr);
}
?> 