<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
include "conn.php";
//$_SESSION["department_id"]=8;
$flag=$_GET["flag"];
if($flag=="1"){
	
}else if($flag=="2"){		
	load_employee_list_details();
}
else{
	echo "Flag  Not Selected";
}
		

	
	function load_employee_list_details(){
	
		global $conn;
		$filter_flag =0;
		$where_condition=" ";
		$empty="";
		if(isset($_POST['filter'])){
		$filter = mysqli_real_escape_string($conn,$_POST['filter']);
		}
		if(isset($filter)){
			$filter_flag =1;
		 $filter_emp_id = mysqli_real_escape_string($conn,$_POST['filter_emp_id']);
		 $filter_emp_name = mysqli_real_escape_string($conn,$_POST['filter_emp_name']);	
		 $filter_employee_dept = mysqli_real_escape_string($conn,$_POST['filter_employee_dept']);	
		 $filter_employee_status = mysqli_real_escape_string($conn,$_POST['filter_employee_status']);	 
		}
		
		
		if($filter_flag==1){	
			if(($filter_emp_id!='')){				
				$where_condition.=" AND `hr_login`.`emp_id` = '".$filter_emp_id ."' ";
			}
			if(($filter_employee_dept!='')){				
				$where_condition.=" AND `hr_login`.`emp_department` = '".$filter_employee_dept ."' ";
			}
			
			if(($filter_emp_name!='')){				
				$where_condition.=" AND ( `hr_login`.`first_name` like '%".$filter_emp_name ."%' OR `hr_login`.`last_name` like '%".$filter_emp_name ."%'  )  ";
			}
			if(($filter_employee_status!='')){				
				$where_condition.=" AND `hr_login`.`inactive_status` = '".$filter_employee_status ."' ";
			}
			
			
			//`opd_flag`
			
		}
		
		 
		$data_return_flag=0;
		if($where_condition==" "){
			$limit=" LIMIT 400";
		}else{
		 $limit=" ";
		}
		
		 
		  $flag_null=0;
			
		 $sql3="SELECT `hr_login`.*, `department_masters`.`department` FROM `hr_login`  left join `department_masters` on `hr_login`.`emp_department`=`department_masters`.`id` where `hr_login`.`del_flag`='0'  $where_condition ORDER BY `hr_login`.`id` DESC $limit";  
		                
		 $result3=$conn->query($sql3) ;
		 $count=$result3->num_rows;
		 if($count>'0'){
							 $data_return_flag=1; 
            				 $sl_no=1;
            				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
            				 {	
							 	$created_by="None";
								 $modified_by="None";					
								 $sql7="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['created_by']."'";
								 $result7=$conn->query($sql7) ;				
								 $row7 = $result7->fetch_assoc();
								 $count7=$result7->num_rows;
								 if($count7>0)
								 {
									$created_by=$row7['name'];
								 }
								 
								 $sql8="SELECT `name` FROM `user_infos` Where `users_id`='".$row3['modified_by']."'";
								 $result8=$conn->query($sql8) ;				
								 $row8 = $result8->fetch_assoc();
								 $count8=$result8->num_rows;
								 if($count8>0)
								 {
									$modified_by=$row8['name'];
								 } 	 
								 
			 
		if($row3['emp_name']==''){  $flag_null=1; }
		
		 $modifiaction_details="";
		if($row3['modified_time']!=''){ 
		  $modifiaction_details="<b>Last Modified By: </b>". $modified_by." ; <br/><b>Modified On: </b>".date('d-m-Y h:i A', strtotime($row3['modified_time'])); 
		  } 
		$data_details="<b>Created By: </b>".$created_by." ; <br/><b>Created On: </b>".date('d-m-Y h:i A', strtotime($row3['created_on']))." ; <br/>". $modifiaction_details;
		
		$full_name="";	
		$full_name=$row3['emp_name'];
		
		$action_tab="";
		$action1="";
		
		$action2="";
		$inactive=0;
		
		if($row3['inactive_status']=='0'){
			$action2=" | <a onClick=\"if(confirm('Are you sure to inactive users?')) return true; else return false;\" href='?users_id_for_inactive=".$row3['users_id']."&inactive_flag=1' title='Inactive Users' ><img src='". ADMIN_URL."icon/cross.png'  title='Inactive Users'> </a>";
			
		}
		if($row3['inactive_status']=='1'){
			$action2=" | <a onClick=\"if(confirm('Are you sure to active users?')) return true; else return false;\" href='?users_id_for_inactive=".$row3['users_id']."&inactive_flag=0' title='Active Users' ><img src='". ADMIN_URL."icon/test-pass-icon.png'  title='Active Users'> </a>";
			$inactive=1;
		}
		
					
			$action1="<a href='".ADMIN_URL."hrlogin_edit.php?users_id=".$row3['users_id']."' title='Edit Details'><img src='". ADMIN_URL."icon/bt_edit.gif'  title='Edit Details '></a> | <a onClick=\"if(confirm('Are you sure to delete?')) return true; else return false;\" href='?delete=".$row3['users_id']."' title='Delete / Cancel ' ><img src='". ADMIN_URL."icon/delete.gif'  title='Delete / Cancel '> </a> $action2 ";
			
		$action_tab=$action1;		
		
			$arr[]=array("sl_no"=>$sl_no,"emp_id"=>$row3['emp_id'],"department"=>$row3['department'],"full_name"=>$full_name,"username"=>$row3['username'],"password"=>$row3['password'],"data_details"=>$data_details,"action_tab"=>$action_tab,"data_return_flag"=>$data_return_flag,"flag_null"=>$flag_null,"inactive"=>$inactive);
			
			$sl_no++; 
		}}
		else{
			$arr="";
			
		}
		
			echo json_encode($arr);
	
	}
	
	
?>