<?php
include '../conn.php';
$main_procedure_id=$_POST["main_procedure_id"]; 

?> 
<tbody>
<?php 
  $sl=1;
  $sql="SELECT * FROM `procedure_bifarcation_masters` WHERE `main_procedure_id`='".$main_procedure_id."' AND `del_flag`='0' ";
$result=$conn->query($sql) ;
$count=$result->num_rows;
if($count>0)
{
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
  ?>
  <tr id="iop<?php echo $sl;?>">
  
    <td width="40%"><select class=" form-control" name="procedure_package_subtext<?php echo $sl;?>" id="procedure_package_subtext<?php echo $sl;?>">
     <?php 
			$sql7="SELECT `id`, `name` FROM `patient_type_master` WHERE  `del_flag`='0' ";
			 $result7=$conn->query($sql7) ;
			 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
			 {			
				 echo '<option value="'.$row7['id'].'" '; if($row['procedure_package_subtext']==$row7['id']){echo 'Selected';}  echo '>'.$row7['name'].'</option>';
			 }
			?>
      </select></td>
    <td width="40%"><input type="number" class="form-control" placeholder="Enter Sub Amount" name="sub_amount<?php echo $sl;?>" id="sub_amount<?php echo $sl;?>" value="<?php echo $row['sub_amount'];?>">
    <input type="hidden" class="form-control" placeholder="Enter Sub Amount" name="procedure_package_flag<?php echo $sl;?>" id="procedure_package_flag<?php echo $sl;?>" value="<?php echo $row['procedure_package_flag'];?>"><input type="hidden" class="form-control" placeholder="Enter Sub Amount" name="procedure_bifarcation_unique_id<?php echo $sl;?>" id="procedure_bifarcation_unique_id<?php echo $sl;?>" value="<?php echo $row['id'];?>">
    </td>
    <td width="20%"><a href="javascript:void(0);" id="iop_remove<?php echo $sl;?>" onClick="remove_sub_proc_del(<?php echo $sl;?>,<?php echo $row['id'];?>)" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
  </tr>
  <?php $sl++;} } ?>
  </tbody>