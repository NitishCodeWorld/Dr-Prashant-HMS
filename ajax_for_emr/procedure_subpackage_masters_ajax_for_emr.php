<?php
include '../conn.php';
$optom_id=$_POST["id"];
$sql="SELECT `procedure_package_subtext`,`sub_amount` FROM `procedure_subpackage_masters_for_emr` WHERE `package_id`='".$optom_id."' ORDER BY `id` DESC";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$procedure_package_subtext="";
$sub_amount="";
if($count>0)
{
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))

				 {
					
$procedure_package_subtext=$row['procedure_package_subtext'].'~'.$procedure_package_subtext;
$sub_amount=$row['sub_amount'].'~'.$sub_amount;
					 
				 }
}
$arr=array("procedure_package_subtext" => $procedure_package_subtext,"sub_amount" => $sub_amount,"count" => $count);
echo json_encode($arr);
?> 