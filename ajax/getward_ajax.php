<?php
include '../conn.php';
$optom_id=$_POST["cid"];
$sql="SELECT `id`,`wname_for_complain` from `ward_master_for_complain` WHERE `floor_id_for_complain`='".$optom_id."' AND `del_flag`='0' order by `wname_for_complain`";
$result=$conn->query($sql) ;
$arr=array();
$count=$result->num_rows;
if($count>0){
while($row=mysqli_fetch_assoc($result)){
extract($row);	
$arr[]=array("value"=>$id,"text"=>$wname_for_complain);
}
}else{
    $arr[]=array("value"=>"","text"=>"");
}
echo json_encode($arr);

?> 

