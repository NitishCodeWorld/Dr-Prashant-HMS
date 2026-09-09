<?php include '../conn.php';
$optom_id=$_POST["countryId"];
$sql="SELECT `general_advise_subpackage_masters_for_emr`.`medication_package_subtext` FROM `general_advise_subpackage_masters_for_emr` INNER JOIN `general_advise_masters_for_emr` ON `general_advise_subpackage_masters_for_emr`.`package_id`=`general_advise_masters_for_emr`.`id` WHERE `general_advise_masters_for_emr`.`general_advise`='".$optom_id."'";
$result=$conn->query($sql) ;
//$count=$result->num_rows;
while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
$medication_package_subtext=preg_replace("/\r|\n/", "", $row['medication_package_subtext']);
$arr[]=array("medication_package_subtext" => $medication_package_subtext);
}
echo json_encode($arr);
?>