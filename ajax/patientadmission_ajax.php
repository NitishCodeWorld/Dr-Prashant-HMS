<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `serial_no`, `uhid_no`, `patient_name`, `date`, `time`, `age`, `gender`, `guardian`, `address`, `po`, `ps`, `district`, `phone_no`, `admiting_doctor`,`consultant`,`allocated_bed_no`,`patient_type`,`history`,`clinical_features`,`investigation`,`diagnosis`,`blood_pressure`,`heart_rate`,`spo2`,`resp_rate`,`temparature`,`weight` FROM `patient_admission_form` WHERE `id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$serial_no=$row['serial_no'];
$uhid_no=$row['uhid_no'];
$patient_name=$row['patient_name'];
$date=$row['date'];
$time=$row['time'];
$age=$row['age'];
$gender=$row['gender'];
$guardian=$row['guardian'];
$address=$row['address'];
$po=$row['po'];
$ps=$row['ps'];
$district=$row['district'];
$phone_no=$row['phone_no'];
$admiting_doctor=$row['admiting_doctor'];
$consultant=$row['consultant'];
$allocated_bed_no=$row['allocated_bed_no'];
$patient_type=$row['patient_type'];
$history=$row['history'];
$clinical_features=$row['clinical_features'];
$investigation=$row['investigation'];
$diagnosis=$row['diagnosis'];
$blood_pressure=$row['blood_pressure'];
$heart_rate=$row['heart_rate'];
$spo2=$row['spo2'];
$resp_rate=$row['resp_rate'];
$temparature=$row['temparature'];
$weight=$row['weight'];
$arr=array("id" => $id, "serial_no" => $serial_no, "uhid_no" => $uhid_no, "patient_name" => $patient_name, "date" => $date, "time" => $time, "age" => $age, "gender" => $gender, "guardian" => $guardian, "address" => $address, "po" => $po, "ps" => $ps, "district" => $district, "phone_no" => $phone_no, "admiting_doctor" => $admiting_doctor, "consultant" => $consultant, "allocated_bed_no" => $allocated_bed_no, "patient_type" => $patient_type, "history" => $history, "clinical_features" => $clinical_features, "investigation" => $investigation, "diagnosis" => $diagnosis, "blood_pressure" => $blood_pressure, "heart_rate" => $heart_rate,"spo2" => $spo2, "resp_rate" => $resp_rate, "temparature" => $temparature, "weight" => $weight);
echo json_encode($arr);
}

?> 

