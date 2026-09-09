<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `id`, `prescription_id`, `mrd_no`, `filename`, `filepath` FROM `patient_documents_for_emr` WHERE `prescription_id`='".$optom_id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$i=1;
if($count>0)
{
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
$id=$row['id'];
$prescription_id=$row['prescription_id'];
$mrd_no=$row['mrd_no'];
if($i=='1'){$filename1=$row['filename'];
$filepath1=$row['filepath'];
}
if($i=='2'){$filename2=$row['filename'];
$filepath2=$row['filepath'];
}
if($i=='3'){$filename3=$row['filename'];
$filepath3=$row['filepath'];
}
if($i=='4'){$filename4=$row['filename'];
$filepath4=$row['filepath'];
}
$i++;
}
}
$arr=array("id" => $id,"prescription_id" => $prescription_id,"mrd_no" => $mrd_no,"filename1" => $filename1,"filename2" => $filename2,"filename3" => $filename3,"filename4" => $filename4,"filepath1" => $filepath1,"filepath2" => $filepath2,"filepath3" => $filepath3,"filepath4" => $filepath4);
//$arr=array("filepath1" =>'ani');
echo json_encode($arr);
?> 

