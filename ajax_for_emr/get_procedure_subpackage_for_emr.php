<?php include '../conn.php';
$optom_id=$_POST["countryId"];
$sql="SELECT `procedure_subpackage_masters_for_emr`.`procedure_package_subtext` FROM `procedure_subpackage_masters_for_emr` INNER JOIN `procedure_package_masters_for_emr` ON `procedure_subpackage_masters_for_emr`.`package_id`=`procedure_package_masters_for_emr`.`id` WHERE `procedure_package_masters_for_emr`.`procedure_package`='".$optom_id."'";
$result=$conn->query($sql) ;
//$count=$result->num_rows;
while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
$medication_package_subtext=preg_replace("/\r|\n/", "", $row['procedure_package_subtext']);
$arr[]=array("medication_package_subtext" => $medication_package_subtext);
}
echo json_encode($arr);
?>