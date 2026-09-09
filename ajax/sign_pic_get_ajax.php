<?php
include '../conn.php';
$sign_id=$_POST['sign_id'];
$signature="whitespace.jpg";
$flag=0;
$qry = mysqli_query($conn,"SELECT `users`.*,`user_infos`.`name`,`hr_login`.`emp_id`,`hr_login`.`signature` FROM `users` INNER JOIN `user_infos` on `users`.`id`=`user_infos`.`users_id` INNER JOIN `hr_login` on `users`.`id`=`hr_login`.`users_id` Where `users`.`id`='".$sign_id."' "); // select query
$count=$qry->num_rows;
if($count>'0'){
$row3 = mysqli_fetch_array($qry); // fetch data
if($row3['signature']!=''){
$signature=$row3['signature'];
$flag=1;
}
}
$arr=array("signature" => $signature,"flag" => $flag);
echo json_encode($arr);
?> 

