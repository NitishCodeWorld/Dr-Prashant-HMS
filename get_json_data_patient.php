<?php
include "conn.php";

//$_SESSION["department_id"]=8;

/*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/


$flag=$_GET["flag"];

if($flag=="1"){	
	save_hospital_reg_image();	
}
else if($flag=="2"){
	load_hospital_reg_image();	
}
else if($flag=="3"){
	gender_defualt();	
}
else{
	echo "Flag  Not Selected";	
}

function save_hospital_reg_image(){
	global $conn;
	$pdfContent=$_POST['imagedata'];
	$uhid_no=$_POST['uhid_no'];
	
	//$data = base64_decode($pdfContent);
	$folderPath = 'upload/patient_reg_upload/';
	$image_parts = explode(";base64,", $pdfContent);
	$image_base64 = base64_decode($image_parts[1]);
	//echo $image_base64;die;
	$sql_delete="DELETE FROM `patient_reg_upload` WHERE `uhid_no`='".$uhid_no."'";
	$query_delete=mysqli_query($conn,$sql_delete);
	$unic=uniqid();
	$imagepath = $folderPath . $unic . '.png';
	$imagename = $unic . '.png';
	$isUploaded=file_put_contents($imagepath, $image_base64);
	 if($isUploaded){
		  $sql_customer="INSERT INTO `patient_reg_upload` set `image_name`='".$imagename."',`uhid_no`='".$uhid_no."'";
		  mysqli_query($conn,$sql_customer) or die(json_encode(array("flag"=>"0","mysql_error"=>mysqli_error($conn)."Patient Update Sucessfully")));
		  echo json_encode(array("Msg"=>"Photo Upload Sucessfully!!"));
	 }else{
		echo json_encode(array("Msg"=>"Image Can't Uploded Samthing Error"));
	 }
	 // echo ($N);
	  // print_r($data);
	//file_put_contents("'sssss.pdf'", $data);
}
function load_hospital_reg_image(){
	global $conn;
	$uhid_no=$_POST['uhid_no'];
	$arr=array();
	$sql_med="SELECT * FROM `patient_reg_upload` WHERE `uhid_no`= '" .$uhid_no. "'";
	$result_med=$conn->query($sql_med) ;
	while($row_med=mysqli_fetch_array($result_med,MYSQLI_ASSOC)){
		$arr[]=array('image'=>$row_med['image_name']);
		//echo '<img src="upload/pediatric_pres_report/'.$row_med['upload_image'].'" alt="Screenshot" class="img-thumbnail">';
	}	
	echo json_encode($arr);
}	

function gender_defualt(){
	global $conn;
	$prefix=$_POST['prefix'];
	$arr=array();
	$sql_med="SELECT * FROM `prefix_masters` WHERE `id`= '" .$prefix. "'";
	$result_med=$conn->query($sql_med) ;
	while($row_med=mysqli_fetch_array($result_med,MYSQLI_ASSOC)){
		$arr=array('default_gender'=>$row_med['default_gender']);
		//echo '<img src="upload/pediatric_pres_report/'.$row_med['upload_image'].'" alt="Screenshot" class="img-thumbnail">';
	}	
	echo json_encode($arr);
}	

		// For IPD
?>