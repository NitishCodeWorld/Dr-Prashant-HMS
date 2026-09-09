<?php
include_once("conn.php");
$flag=isset($_POST["flag"]) ? $_POST["flag"] : $_GET["flag"];
if($flag=="1"){
	get_bed($opd_flag);
}
else if($flag=="2"){	
		load_view_allocated_recent_bed();	
	}
	else if($flag=="3"){	
		load_approved_leave_list();	
	}
	else {	
		echo "Wrong Flag ";	
	}
function get_bed(){

		global $conn;
		
		$floor_name=$_POST["floor_name"];
		$ward_name=$_POST["ward_name"];
		$admission_date=$_POST["admission_date"];
		$uhid_no=$_POST["uhid_no"];
		$admision_id=$_POST["admision_id"];
		$patient_id=$_POST["patient_id"];
		$modified_by=$_POST["modified_by"];
		$modified_time=$_POST["modified_time"];
		$patient_name=$_POST["patient_name"];
		$created_by=$_POST["modified_by"];
		$created_on=$_POST["modified_time"];


		$sql="SELECT `id`, `floor_id`, `ward_id`, `ini_bed_no`, `end_bed_no`, `created_by`, `created_on`, `modified_by`, `modified_time`, `del_flag`, `deleted_by`, `deleted_time`,`bed_code`,`bed_charge`  FROM `bed_masters` WHERE `floor_id`='".$floor_name."' AND `ward_id`='".$ward_name."' AND `del_flag`='0'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn).$sql);	

		$arr=array();

		while($row=mysqli_fetch_assoc($result)){
			//extract($row);	
			$arr[]=array("ini_bed_no"=>$row['ini_bed_no'],"end_bed_no"=>$row['end_bed_no']);	
		    $start=$row['ini_bed_no'];
			$end=$row['end_bed_no'];
			$bed_code=$row['bed_code'];
			$bed_charge=0;
			if($row['bed_charge']!=''){
			$bed_charge=$row['bed_charge'];
			}
			$time_interval=1;
			
				//*************Change by Chandrachur
				for($i=$start;$i<=$end;$i+=1){
	
					
	
					//$flag1=($flag==2) ? 2 : 1;
					
	
					$sql1="SELECT `id`, `admision_id`, `patient_id`, `uhid_no`, `floor_name`, `ward_name`, `bed_no`, `allocation_flag`, `bed_release`, `created_by`, `created_on`, `modified_by`, `modified_time`, `del_flag`, `deleted_by`, `deleted_time`, `bed_allocate_date`, `bed_allocate_time`, `bed_release_date`, `bed_release_time`, `bed_allocate_charge` FROM `bed_allocation_for_patient` WHERE `bed_release`='0' AND `del_flag`='0' AND `floor_name`='".$floor_name."' AND `ward_name`='".$ward_name."' AND `bed_no`='".$i."'";
	
					$res=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
	
					$num_rows=mysqli_num_rows($res);
	
					$color="";
	
					$confirm_col=0;
	
					if($num_rows==0) { $color="#009933";}
	
					else if($num_rows==1) {$color="#e33827";$confirm_col=1;}
					
					
					if($i<10){
						$bed_allot=$bed_code.'0'.$i;
					}else{
						$bed_allot=$bed_code.$i;
					}
					$bed_no=$floor_name.'^'.$ward_name.'^'.$i.'^'.$bed_allot.'^'.$bed_charge;
	
					
	
					if($num_rows<=1) $arr[]=array("flag"=>"0","button_name"=>$bed_allot,"value"=>$bed_no,"bgcolor"=>$color,"confirm_col"=>$confirm_col);
					else if($num_rows>1){
	
					 $arr[]=array("flag"=>"1","button_name"=>"Booked","value"=>$bed_no,"bgcolor"=>'red');
	
					}
	
	
					//$k++;
					//*************change by Chandrachur
					//$i++;
	
					//print_r($arr);
	
					//die();
	
				}
	
			
			$arr[]=array("counter"=>$i);		

		}
		echo json_encode($arr);

	
	}
	
	function load_view_allocated_recent_bed(){	
		global $conn;		
		$bed_number=$_POST['bed_number'];
		$floor_name=$_POST['floor_name'];
		$ward_name=$_POST['ward_name'];
		$bed_no=$_POST['bed_no'];
		$bed_name_with_code=$_POST['bed_name_with_code'];
		
		 $sql="SELECT `bed_allocation_for_patient`.*,`patient_admission_form`.`patient_name` FROM `bed_allocation_for_patient`  INNER JOIN `patient_admission_form` ON `bed_allocation_for_patient`.`patient_id`=`patient_admission_form`.`patient_id`  WHERE `bed_allocation_for_patient`.`del_flag`='0' AND `bed_allocation_for_patient`.`bed_release`='0' AND `bed_allocation_for_patient`.`floor_name`='".$floor_name."' AND `bed_allocation_for_patient`.`ward_name`='".$ward_name."' AND `bed_allocation_for_patient`.`bed_no`='".$bed_no."' ";
		
		$count=0;
		$sl=1;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$count=$res->num_rows;	
		echo '<input type="hidden" name="old_others_bed_allocation_countiop" id="old_others_bed_allocation_countiop" value="'.$count.'">';
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$flag_order=0;
			//$string = "123,456,78,000"; 		
				
		?>

<tr id="old_others_bed_allocation_iop<?php echo $sl; ?>"  <?php if($row['bed_release']=='1') { echo 'style="background-color:#69c385 !important;"';} else{ echo 'style="background-color:#c36969 !important;"';}?> >
  <td style="min-width:50px !important"><strong><?php echo $sl; ?>.</strong></td>
  <td style="min-width:100px !important"><strong><?php echo $uhid_no; ?></strong></td>
  <td style="min-width:100px !important"><strong><?php echo $patient_name; ?></strong></td>
  <td style="min-width:200px !important;width:200px !important;"><div class="form-group">
      <div class="input-group">
        <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Bed Allocating Date" id="old_others_bed_allocate_date<?php echo $sl; ?>" name="old_others_bed_allocate_date<?php echo $sl; ?>" value="<?php if($row['bed_allocate_date']!='') { echo date("d-m-Y", strtotime($row['bed_allocate_date']));} else{ echo date("d-m-Y"); } ?>" />
        <span class="input-group-addon" style="padding:0 !important; width:50% !important">
        <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Bed Allocating Time" name="old_others_bed_allocate_time<?php echo $sl; ?>" id="old_others_bed_allocate_time<?php echo $sl; ?>" value="<?php if($row['bed_allocate_time']!='') { echo date("h:i A", strtotime($row['bed_allocate_time']));} else{ echo date("h:i A"); } ?>"  />
        </span></div>
    </div>
    <input type="hidden" class="form-control" name="old_others_bed_allocation_id<?php echo $sl; ?>" id="old_others_bed_allocation_id<?php echo $sl; ?>" value="<?php echo $row['id']; ?>" ></td>
  <td style="min-width:180px !important;width:180px !important;"><select class="form-control" id="old_others_floor_name<?php echo $sl; ?>" name="old_others_floor_name<?php echo $sl; ?>"  >
      <?php
                                              $query1="SELECT * FROM `floor_masters` ORDER BY `name`" ;
                                              $rslt=$conn->query($query1);
                                              while($row7=mysqli_fetch_array($rslt)){
										if($row['floor_name']==$row7['id']){ echo '<option value="'.$row7['id'].'" '; if($row['floor_name']==$row7['id']) echo 'selected'; echo '>'.$row7['name'].'</option>';}   
										}?>
    </select></td>
  <td style="min-width:180px !important;width:180px !important;"><select class="form-control" id="old_others_ward_name<?php echo $sl; ?>" name="old_others_ward_name<?php echo $sl; ?>"  >
      <?php
                                              $query1="SELECT * FROM `ward_details_masters` ORDER BY `wname`" ;
                                              $rslt=$conn->query($query1);
                                              while($row7=mysqli_fetch_array($rslt)){
										if($row['ward_name']==$row7['id']){ echo '<option value="'.$row7['id'].'" '; if($row['ward_name']==$row7['id']) echo 'selected'; echo '>'.$row7['wname'].'</option>';}   
										}?>
    </select></td>
  <td style="min-width:50px !important;width:50px !important;"><div class="form-group" id="old_others_allocate_button_box<?php echo $sl; ?>">
      <button type="button" id="old_others_store_allocate_button_box<?php echo $sl; ?>" class="btn" style="width:80px;background:#b52f21;color:#ffffff" value="<?php echo $row['floor_name'].'^'.$row['ward_name'].'^'.$row['bed_no'].'^'.$row['bed_name_with_code'].'^'.$row['bed_allocate_charge'];?>"><?php echo $row['bed_name_with_code'];?></button>
    </div></td>
  <td style="min-width:50px !important;width:50px !important;"><input type="text" class="form-control" placeholder="Bed Charge" id="old_others_bed_allocate_charge<?php echo $sl; ?>" name="old_others_bed_allocate_charge<?php echo $sl; ?>" value="<?php echo $row['bed_allocate_charge'];?>" /></td>
  <td style="min-width:300px !important;width:300px !important"><div class="col-md-12">
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control form-control-inline date-picker" placeholder="Select Bed Allocating Date" id="old_others_bed_release_date<?php echo $sl; ?>" name="old_others_bed_release_date<?php echo $sl; ?>" value="<?php  echo date("d-m-Y");  ?>" />
          <span class="input-group-addon" style="padding:0 !important; width:50% !important">
          <input type="text" class="form-control form-control-inline time-picker" placeholder="Select Bed Allocating Time" name="old_others_bed_release_time<?php echo $sl; ?>" id="old_others_bed_release_time<?php echo $sl; ?>" value="<?php  echo date("h:i A");  ?>"  />
          </span></div>
      </div>
    </div></td>
  <td style="min-width:100px !important;width:100px !important;"><input type="number" class="form-control" placeholder="Total Days" id="old_others_total_days_occupied_bed<?php echo $sl; ?>" name="old_others_total_days_occupied_bed<?php echo $sl; ?>" value="<?php echo $row['total_days_occupied_bed'];?>" onkeyup="old_others_calculate_new_bed_total('<?php echo $sl; ?>')" /></td>
  <td style="min-width:100px !important;width:100px !important;"><input type="number" class="form-control" placeholder="Total Amount" id="old_others_total_charge_occupied_bed<?php echo $sl; ?>" name="old_others_total_charge_occupied_bed<?php echo $sl; ?>" value="<?php echo $row['total_charge_occupied_bed'];?>" /></td>
  <td style="min-width:100px !important;width:100px !important;"><input type="checkbox" name="old_others_bed_tick<?php echo $sl; ?>" id="old_others_bed_tick<?php echo $sl; ?>" value="<?php if($row['bed_release']=='1') { echo '1';}else{ echo '0';}?>" <?php if($row['bed_release']=='1') { echo 'checked';}else{ echo '';}?> onClick="old_others_bed_allocation_tick('<?php echo $sl; ?>','<?php echo $row['id']; ?>')" ></td>
</tr>
<?php
			
		$sl++;
		}		
		
		//echo json_encode($arr);
	
	}
	
function load_approved_leave_list(){	
		global $conn;		
		$from_date=date("Y-m-d", strtotime($_POST['from_date']));
		$to_date=date("Y-m-d", strtotime($_POST['to_date']));
		$employee_dept=$_POST['employee_dept'];
		$approval_type=$_POST['approval_type'];
		
		$sql="SELECT `employee_leave_or_extra_duty_form`.*, `leave_or_extra_duty_type_masters`.`type_name`,`department_masters`.`department` FROM `employee_leave_or_extra_duty_form` left join `leave_or_extra_duty_type_masters` on `leave_or_extra_duty_type_masters`.`id`=`employee_leave_or_extra_duty_form`.`approval` left join `department_masters` on `department_masters`.`id`=`employee_leave_or_extra_duty_form`.`employee_dept` where `employee_leave_or_extra_duty_form`.`del_flag`='0' AND `employee_leave_or_extra_duty_form`.`approval`='".$approval_type."' AND `employee_leave_or_extra_duty_form`.`employee_dept`='".$employee_dept."'   AND `employee_leave_or_extra_duty_form`.`approved_duty_type`='1' AND (( `employee_leave_or_extra_duty_form`.`from_date`>='".$from_date."' AND `employee_leave_or_extra_duty_form`.`from_date`<='".$to_date."' ) || ( `employee_leave_or_extra_duty_form`.`to_date`>='".$from_date."' AND `employee_leave_or_extra_duty_form`.`to_date`<='".$to_date."' ) || ( `employee_leave_or_extra_duty_form`.`from_date`<='".$from_date."' AND `employee_leave_or_extra_duty_form`.`to_date`>='".$to_date."' ) ) ";
		
		$count=0;
		$sl=1;
		$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$count=$res->num_rows;
		if($count>0){
		while($row=mysqli_fetch_assoc($res)){
			extract($row);
			$flag_order=0;
			//$string = "123,456,78,000"; 		
				
		?>
<tr id="old_others_bed_allocation_iop<?php echo $sl; ?>"   >
  <td style="min-width:50px !important"><strong><?php echo $sl; ?>.</strong></td>
  <td style="min-width:180px !important"><strong><?php echo $type_name; ?></strong></td>
  <td style="min-width:100px !important"><strong><?php echo $emplyee_id; ?></strong></td>
  <td style="min-width:100px !important"><strong><?php echo $emplyee_name; ?></strong></td>
  <td style="min-width:100px !important"><strong><?php echo $department; ?></strong></td>
  <td style="min-width:300px !important"><strong><?php echo date("d-m-Y", strtotime($from_date)). ' To '.date("d-m-Y", strtotime($to_date)); ?></strong></td>
  <td style="min-width:180px !important"><strong><?php echo $total_days; ?></strong></td>
</tr>
<?php
			
		$sl++;
		}		
		}else{
			?>
<tr id="old_others_bed_allocation_iop<?php echo $sl; ?>"   >
  <td colspan="7" style="text-align:center;"><strong>There is not any leave or extra duty approved details.....</strong></td>
</tr>
<?php 	
		}
		
		//echo json_encode($arr);
	
	}
?>
