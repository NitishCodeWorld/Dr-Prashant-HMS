<?php

include '../conn.php';

$optom_id=$_POST["id"];

$sql="SELECT * FROM `hospital_info_masters` WHERE `id`='".$optom_id."'";

$result=$conn->query($sql) ;

$count=$result->num_rows;

$row = $result->fetch_assoc();

if($count>0)

{	

$id=$row['id'];

$hospital_name=$row['hospital_name'];

$address=$row['address'];

$phone=$row['phone'];

$mobile=$row['mobile'];

$email=$row['email'];

$hospital_unit=$row['hospital_unit'];

$gst_in=$row['gst_in'];

$drug_licence=$row['drug_licence'];

$hos_reg_no=$row['hos_reg_no'];

$website=$row['website'];

$final_bill_unit=$row['final_bill_unit'];

$final_bill_mobile=$row['final_bill_mobile'];

if($row['hospital_pic']!=''){

$hospital_pic=$row['hospital_pic'];

}else{

	$hospital_pic="";

}

if($row['hospital_logo']!=''){

$hospital_logo=$row['hospital_logo'];

}else{

	$hospital_logo="";

}

if($row['left_side_logo']!=''){

$left_side_logo=$row['left_side_logo'];

}else{

	$left_side_logo="";

}
if($row['right_side_logo']!=''){

$right_side_logo=$row['right_side_logo'];

}else{

	$right_side_logo="";

}
$arr=array("id" => $id,"hospital_name" => $hospital_name,"address" => $address,"phone" => $phone,"mobile" => $mobile,"email" => $email,"hospital_unit" => $hospital_unit,"gst_in" => $gst_in,"drug_licence" => $drug_licence,"hos_reg_no" => $hos_reg_no,"website" => $website,"final_bill_unit" => $final_bill_unit,"final_bill_mobile" => $final_bill_mobile,"hospital_pic" => $hospital_pic,"hospital_logo" => $hospital_logo,"left_side_logo" => $left_side_logo,"right_side_logo" => $right_side_logo);

echo json_encode($arr);

}



?> 



