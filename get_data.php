<?php
include 'conn.php';
$purpose=$_POST['purpose'];
if($purpose==1){
	master_add_on();
}else if($purpose==2){
	load_master();
}else if($purpose==3){
	save_pkg();
}else if($purpose==4){
	load_pkg();
}else if($purpose==5){
	save_diagnosis();
}else if($purpose==6){
	load_diagnosis();
}
function master_add_on(){
	global $conn;
	$table=$_POST['table'];
	$column=$_POST['column'];
	$name=$_POST['name'];
	$sql="INSERT INTO $table SET $column='$name'";
	if(mysqli_query($conn,$sql)){
		$flag=1;
	}else{
		$flag=2;
	}
	echo $flag;
}
function load_master(){
	global $conn;
	$table=$_POST['table'];
	$column=$_POST['column'];
	$result="<option value=''>None</option>";
	$sql="SELECT * FROM $table ORDER BY id DESC";
	$res=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_assoc($res)){
		$result.= "<option value='".$row[$column]."'";
		$result.= ">".$row[$column]."</option>";
	}
		echo $result;
}
function save_pkg(){
	global $conn;
	$table=$_POST['table'];
	$column=$_POST['column'];
	$name=$_POST['name'];
	$sql="INSERT INTO $table SET $column='$name'";
	if(mysqli_query($conn,$sql)){
		$package_id=mysqli_insert_id($conn);
		$pkg_flag=$_POST['pkg_flag'];
		if($pkg_flag=='1'){
			$sub_table='investigation_subpackage_masters_for_emr';
			$pkg_col='package_id';
			$sub_col='investigation_package_subtext';
		}else if($pkg_flag=='2'){
			$sub_table='pre_operative_subpackage_master_for_emr';
			$pkg_col='pre_operative_package_id';
			$sub_col='pre_operative_subpackage';
		}else if($pkg_flag=='3'){
			$sub_table='medication_subpackage_masters_for_emr';
			$pkg_col='package_id';
			$sub_col='medication_package_subtext';
		}
		$arr=$_POST['sub_pac'];
		for($i=0;$i<count($arr);$i++){
			$sub_pkg=$arr[$i];
			$pkg_add="INSERT INTO $sub_table SET $pkg_col=$package_id,$sub_col='$sub_pkg'";
			mysqli_query($conn,$pkg_add);
		}
		$flag=1;
	}else{
		$flag=2;
	}
	echo $flag;
}
function load_pkg(){
	global $conn;
	$table=$_POST['table'];
	$column=$_POST['column'];
	$result="<option value=''>None</option>";
	$sql="SELECT * FROM $table ORDER BY id DESC";
	$res=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_assoc($res)){
		$result.= "<option value='".$row['id']."'";
		$result.= ">".$row[$column]."</option>";
	}
		echo $result;
}
function save_diagnosis(){
	global $conn;
	$diagnosis=$_POST['diagnosis'];
	$code=$_POST['code'];
	$sql="INSERT INTO diagnosis_masters_for_emr SET code='$code',diagnosis='$diagnosis'";
	if(mysqli_query($conn,$sql)){
		$flag=1;
	}else{
		$flag=2;
	}
	echo $flag;
}
function load_diagnosis(){
	global $conn;
	$result="<option value=''>None</option>";
	$sql="SELECT * FROM diagnosis_masters_for_emr ORDER BY id DESC";
	$res=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_assoc($res)){
		$result.= '<option value="'.$row['code'].' '.$row['diagnosis'].'">'.$row['code'].' '.$row['diagnosis'].'</option>';
	}
		echo $result;
}

