<?php

include "conn.php"; // Using database connection file here

//if(isset($_REQUEST['submit_employe_details']) || isset($_REQUEST['submit']))

if($_POST['emp_full_name']!='')

{

  //Edit Data

  

    $id = mysqli_real_escape_string($conn,$_POST['id']);

	$employee_gen_id=mysqli_real_escape_string($conn,$_POST['employee_gen_id']);

	$emp_id = mysqli_real_escape_string($conn,$_POST['emp_id']);

	$users_id = mysqli_real_escape_string($conn,$_POST['users_id']);

	$emp_department = mysqli_real_escape_string($conn,$_POST['emp_department']);

	$emp_full_name = mysqli_real_escape_string($conn,$_POST['emp_full_name']);

	$user_login_name = mysqli_real_escape_string($conn,$_POST['user_login_name']);

	$hr_login_id= mysqli_real_escape_string($conn,$_POST['hr_login_id']);

	$employee_flug=mysqli_real_escape_string($conn,$_POST['employee_flug']);

	$employee_ins_id=mysqli_real_escape_string($conn,$_POST['employee_ins_id']);

	$remove_id_for_drug=mysqli_real_escape_string($conn,$_POST['remove_id_for_drug']);

	$today=date('Y-m-d H:i:s');

	$created_by=$_SESSION['id'];

	

	$countiop=mysqli_real_escape_string($conn,$_POST['countiop']);  //Total Employee List For Meeting

	for($i=1;$i<=$countiop;$i++) {

		//echo "*******'".$countiop."'**'".$i."'****";

	}

	

 	$sql="UPDATE `menu_access_distribution_to_employees` SET `emp_id`='".$emp_id."',`emp_department`='".$emp_department."',`emp_full_name`='".$emp_full_name."',`user_login_name`='".$user_login_name."',`user_id`='".$users_id."',`hr_login_id`='".$hr_login_id."' ,`modified_by`='".$created_by."', `modified_on`='".$today."' where `id`='".$employee_gen_id."'";  

    if($conn->query($sql)===TRUE)



		{

	 //Meeting Department Dynamically Upload --->

	for($i=1;$i<=$countiop;$i++) {

		//echo "*******'".$countiop."'**'".$i."'****";

	 if($_REQUEST['submanu_id'.$i]!='')

		   {

			   if($_REQUEST['manu_access_employee'.$i]==''){

				  $manu_access_employee=0;

			  }else{

				  $manu_access_employee=$_REQUEST['manu_access_employee'.$i];

			  }

			  

			   if($_REQUEST['break_down_flag'.$i]==''){

				  $break_down_flag=0;

			  }else{

				  $break_down_flag=$_REQUEST['break_down_flag'.$i];

			  }

			   

			   if($_REQUEST['employee_flug'.$i]!='1')

		   {

			  $sql4=$conn->query("INSERT INTO `menu_access_distribution_to_employees_individual` SET `menu_access_unique_id`='".$employee_gen_id."',`emp_id`='".$emp_id."', `emp_department`='".$emp_department."', `mainmanu_id`='".$_REQUEST['mainmanu_id'.$i]."', `submanu_id`='".$_REQUEST['submanu_id'.$i]."', `emp_full_name`='".$emp_full_name."', `manu_url`='".$_REQUEST['manu_url'.$i]."', `user_id`='".$users_id."', `hr_login_id`='".$hr_login_id."', `manu_access_employee`='".$manu_access_employee."', `created_by`='".$created_by."', `created_on`='".$today."', `employee_flug`='1', `break_down_flag`='".$break_down_flag."', `special_flag`='".$_REQUEST['special_flag'.$i]."' ");

			  //$sql4 = $conn->query($sql4);

		   }

		      if($_REQUEST['employee_flug'.$i]=='1')

		   {

			   

			 $sql4 = $conn->query("UPDATE `menu_access_distribution_to_employees_individual` SET `menu_access_unique_id`='".$employee_gen_id."',`emp_id`='".$emp_id."', `emp_department`='".$emp_department."', `mainmanu_id`='".$_REQUEST['mainmanu_id'.$i]."', `submanu_id`='".$_REQUEST['submanu_id'.$i]."', `emp_full_name`='".$emp_full_name."', `manu_url`='".$_REQUEST['manu_url'.$i]."', `user_id`='".$users_id."', `hr_login_id`='".$hr_login_id."', `manu_access_employee`='".$manu_access_employee."', `modified_by`='".$created_by."', `modified_on`='".$today."', `employee_flug`='1', `break_down_flag`='".$break_down_flag."', `special_flag`='".$_REQUEST['special_flag'.$i]."'  WHERE  `id`='".$_REQUEST['employee_ins_id'.$i]."'");

		   }

		   }   

   		}

	

		if($remove_id_for_drug!='')

		   {

			    $remove_id_array=explode(":",$remove_id_for_drug);

			   //print_r($remove_id_array);

			    $itemCount = sizeof($remove_id_array);

			   //exit;

			   for($i=0;$i<($itemCount-1);$i++) {

				  // "UPDATE `drugsheet` SET `del_flag` = '1', `deleted_time`='".$today."' , `deleted_by`='".$created_by."' WHERE `id`='".$remove_id_array[$i]."' ";

			 	 $sql4 = $conn->query("UPDATE `menu_access_distribution_to_employees_individual` SET `del_flag` = '1', `deleted_time`='".$today."' , `deleted_by`='".$created_by."' WHERE `id`='".$remove_id_array[$i]."' ");

			   }

			   

		   }				  

	

        $msg="Record updated successfully";

        $flg=0;

		if(isset($_REQUEST['submit'])){

        $redirectUrl=ADMIN_URL.'menu_access_distribution_to_employees_view.php?msg='.$msg.'&flg='.$flg;

		}else{

			$redirectUrl=ADMIN_URL.'menu_access_distribution_to_employees.php?id=' . $employee_gen_id.'&emp_id='.$emp_id;

		}

        echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

    }

    else

    {

       

		$flg=1;

		$msg="Error:".$sql."<br>".$conn->error;

		$redirectUrl=ADMIN_URL.'menu_access_distribution_to_employees_view.php?msg='.$msg.'&flg='.$flg;

		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";

    }   

	

} 

?>

<?php include "header.php"; ?>

<style>

#span_title {

	color:#b32424;

	font-weight:bold;

	text-transform:uppercase;

	font-size:16px;

	display: list-item;

	margin-left : 1em;

}

.control-label {

	font-weight:bold;

}

th {

	font-weight:bold !important;

}

#add_more {

	font-weight:bold !important;

	font-size:16px;

	color:#b32424;

}

select[readonly] {

	pointer-events: none;

	-moz-appearance:none; /* Firefox */

	-webkit-appearance:none; /* Safari and Chrome */

	appearance:none;

}

#td_span_title {

	color:#b32424;

	font-weight:bold;

	font-size:16px;

}

</style>

<style>

.ajax-loader {

	visibility: hidden;

	background-color: rgba(255, 255, 255, 0.7);

	position: absolute;

	z-index: +100 !important;

	width: 100%;

	height:100%;

}

.ajax-loader img {

	position: relative;

	top:50%;

	left:50%;

}

</style>

<!-- BEGIN PAGE CONTAINER -->



<div class="page-container"> 

  <!-- BEGIN PAGE HEAD -->

  <div class="page-head">

    <div class="container-fluid"> 

      <!-- BEGIN PAGE TITLE -->

      <div class="page-title">

        <h1><small>Welcome to ...</small></h1>

      </div>

      <!-- END PAGE TITLE --> 

    </div>

  </div>

  <div class="row number-stats" >

    <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">

      <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>

      <button class="close" data-close="alert"></button>

      <span>

      <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?>

      </span> </div>

  </div>

  <!-- END PAGE HEAD --> 

  <!-- BEGIN PAGE CONTENT -->

  <div class="page-content">

    <div class="container-fluid"> 

      <!-- BEGIN PAGE BREADCRUMB --> 

      <!--<ul class="page-breadcrumb breadcrumb">

        <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>

        <li class="active"> Dashboard </li>

      </ul> --> 

      <!-- END PAGE BREADCRUMB --> 

      <!-- BEGIN PAGE CONTENT INNER -->

      <div class="row margin-top-10">

        <div class="col-md-12"> 

          <!-- BEGIN EXAMPLE TABLE PORTLET-->

          <div class="portlet light">

            <div class="portlet-title">

              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Menu Access Distribution To Employees</span></div>

            </div>

            <?php

			//$id = $_REQUEST['users_id']; // get id through query string

			

			//$qry = mysqli_query($conn,"select * from `meeting_scheduling_by_hr` where `id`='".$id."'"); // select query

//			

//			$row3 = mysqli_fetch_array($qry); // fetch data

			$qry = mysqli_query($conn,"select `menu_access_distribution_to_employees`.*, `department_masters`.`department` from `menu_access_distribution_to_employees` left join `department_masters` on `department_masters`.id=`menu_access_distribution_to_employees`.`emp_department` where  `menu_access_distribution_to_employees`.`id`='".$_REQUEST['id']."'"); // select query

		      while ($rowe_id=mysqli_fetch_array($qry,MYSQLI_ASSOC))

            	 {

					 $employee_gen_id=$rowe_id['id'];

				 

			//$rowe_id = mysqli_fetch_array($qry);

			

			

			?>

            <form  action="" method="post" enctype="multipart/form-data" class="horizontal-form" autocomplete="off">

              <input type="hidden" name="employee_gen_id" id="employee_gen_id" value="<?php echo $employee_gen_id;?>">

              <div class="form-body">

                <div class="row" style="background:#dcefff; padding:9px 0px">

                  <div class="col-md-12" >

                    <p><span id="span_title"><u>Employee Details </u></span></p>

                  </div>

                  <div class="col-md-4">

                    <?php if($rowe_id['emp_id']==''){

							?>

                    <div class="form-group">

                      <label class="control-label">Enter Employee ID. Click On Check</label>

                      <div class="input-group"> 

                        <!--<input type="text" id="mrd_check" name="mrd_check" class="form-control" placeholder="Enter Text" value="<?php if(isset($_REQUEST['emp_id'])){ echo $_REQUEST['emp_id'];};?>" />-->

                        <select name="mrd_check" id="mrd_check" class="form-control select2">

                          <option value="">Choose..</option>

                          <?php 

								  $sql7="SELECT * FROM `hr_login`  WHERE  `del_flag`='0'  AND `inactive_status`='0' ORDER BY `id` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['emp_id'].'" ';  echo '>'.$row7['emp_id'].' ( '.$row7['username'].' '.$row7['emp_name'].' )</option>';

								 }

					 			?>

                        </select>

                        <input type="hidden" name="id" id="id" class="form-control" value="<?php if(isset($_REQUEST['id'])){ echo $_REQUEST['id'];};?>" />

                        <input type="hidden" name="emp_r_id" id="emp_r_id" class="form-control" value="<?php if(isset($_REQUEST['emp_id'])){ echo $_REQUEST['emp_id'];};?>" />

                        <span class="input-group-addon" style="padding:0 !important"><a href="javascript:void(0);"  onClick="emp_menu_dis_check_ajax();" id="check_btn" class="btn btn-sm default" title="Calculate" >Check</a></span> </div>

                    </div>

                    <?php }?>

                  </div>

                  <div class="col-md-12">

                    <div class="form-group">

                      <div class="col-md-3" style="padding:0 6px 6px 0">

                        <label class="control-label">Employee ID.</label>

                        <input type="text" id="emp_id" name="emp_id" class="form-control" value="<?php if(isset($rowe_id['emp_id'])){echo $rowe_id['emp_id'];}?>" placeholder="Enter Text"  readonly />

                        

                        <input type="hidden" id="hr_login_id" name="hr_login_id" class="form-control" value="<?php echo $rowe_id['hr_login_id'];?>" placeholder="Enter Text"  readonly />

                        <input type="hidden" id="users_id" name="users_id" class="form-control" value="<?php echo $rowe_id['user_id'];?>" placeholder="Enter Text"  readonly />

                      </div>

                      <div class="col-md-3" style="padding:0 6px 6px 0">

                        <label class="control-label">Employee Department.</label>

                        <select class="form-control" name="emp_department" id="emp_department"  style="min-width:120px !important" readonly >

                          <?php if($rowe_id['emp_department']!='')

									echo '<option value="'.$rowe_id['emp_department'].'">'.$rowe_id['department'].'</option>';

							?>

                        </select>

                        <input type="hidden" id="emp_department_text" name="emp_department_text" class="form-control" value="<?php echo $rowe_id['department'];?>" readonly />

                      </div>

                      <div class="col-md-3" style="padding:0 6px 6px 0">

                        <label class="control-label">Employee Name.</label>

                        <input type="text" id="emp_full_name" name="emp_full_name" class="form-control" value="<?php echo $rowe_id['emp_full_name'];?>" placeholder="Enter Text"  readonly />

                      </div>

                      <div class="col-md-3" style="padding:0 6px 6px 0">

                        <label class="control-label">User Login ID</label>

                        <input type="text" id="user_login_name" name="user_login_name" class="form-control" value="<?php echo $rowe_id['user_login_name'];?>" placeholder="Enter Text"  readonly />

                      </div>

                      <p>&nbsp;</p>

                    </div>

                    <?php if($rowe_id['emp_id']==''){?>

                    <div class="col-md-12">

                      <p style="padding:12px 0 2px 0; text-align:center;backgroung:#fff">

                        <button type="submit" name="submit_employe_details" id="submit_employe_details" class="btn green">Submit</button>

                      </p>

                    </div>

                    <?php }?>

                    <?php if($rowe_id['emp_id']!=''){?>

                    <div class="col-md-3" style="padding:0 6px 6px 0">

                      <label class="control-label">Main Menu Nav Select(Optional)</label>

                      <select class="form-control" name="main_menu_id" id="main_menu_id" >

                        <option value="">-Select Menu-</option>

                        <?php 



								 $sql7="SELECT `id`, `main_menu_name` FROM `main_menu_masters` WHERE `del_flag`='0' ORDER BY `id` ASC ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['main_menu_name'].'</option>';



								 }



					 			?>

                      </select>

                    </div>

                    <p>&nbsp;</p>

                    <div class="col-md-12">

                      <p>&nbsp;

                      

                      <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>loader.gif" class="img-responsive" /> </div>

                      </p>

                    </div>

                    <div class="col-md-12">

                      <div class="col-md-2"><span id="td_span_title"> Main Menu Nav:-> </span> </div>

                      <div class="col-md-10" id="dept_add_block">

                        <?php  $sql_menu_nav="SELECT `main_menu_masters`.`id`,`main_menu_masters`.`main_menu_name` FROM `menu_access_distribution_to_employees_individual` INNER JOIN `main_menu_masters` ON  `menu_access_distribution_to_employees_individual`.`mainmanu_id`=`main_menu_masters`.`id` WHERE  `menu_access_distribution_to_employees_individual`.`del_flag`='0' AND `menu_access_distribution_to_employees_individual`.`manu_access_employee`='0' AND `menu_access_distribution_to_employees_individual`.`user_id`='".$rowe_id['user_id']."' GROUP BY `menu_access_distribution_to_employees_individual`.`mainmanu_id` ORDER BY `menu_access_distribution_to_employees_individual`.`id` ASC";

								 $result_menu_nav=$conn->query($sql_menu_nav) ;

								 $count50=$result_menu_nav->num_rows;	

								 echo '<input type="hidden" name="total_main_nav_menus" id="total_main_nav_menus" value="'.$count50.'">';

								 $cnt=0;

								 while($row_menu_nav=mysqli_fetch_array($result_menu_nav,MYSQLI_ASSOC))

								 { ?>

                        <?php 

                        if(($cnt!='1')&&($cnt!='0')){

                       		if(($cnt%6)=='0'){

								echo '<p>&nbsp;</p>';	

							}

						}

						?>

                        <div class="col-md-2" id="dept_div_id<?php echo $cnt;?>">

                          <div class="input-group">

                            <select class="form-control" name="dept_button<?php echo $cnt;?>" id="dept_button<?php echo $cnt;?>" style="min-width:120px !important;text-align:center !important;font-weight:bold;color: #430bc9;" readonly="">

                              <option value="<?php echo $row_menu_nav['id'];?>" selected=""><?php echo $row_menu_nav['main_menu_name'];?></option>

                            </select>

                          </div>

                        </div>

                        <?php  $cnt++;} ?>

                      </div>

                    </div>

                    <div class="col-md-12">

                      <p>&nbsp;</p>

                    </div>

                    <p>&nbsp;</p>

                    <div class="col-md-12" >

                      <div class="col-md-4"><span id="span_title"><u>Menu Distribution / Access Given</u></span></div>

                      <div class="col-md-8" style="text-align:right"></div>

                    </div>

                    <p>&nbsp;</p>

                    <div class="col-md-12" style="text-align:left;background:#3e9999;"><b>To add more, please click on this icon</b><a href="javascript:void(0);"  id="iop_add_button" class="btn" title="Add more" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>

                    <div class="col-md-12" style="margin-bottom:4px;overflow-x: auto !important;background:#3e9999;">

                      <div class="table-scrollable">

                        <table class="table table-striped table-bordered table-advance table-hover" id="iop_tab" style="overflow-x: auto !important;">

                          <thead>

                            <tr>

                              <th style="min-width:30px !important">SL. NO</th>

                              <th style="min-width:150px !important">Main Menu Nav</th>

                              <th style="min-width:300px !important">Sub Menu Nav</th>

                              <th style="min-width:200px !important">Menu Url</th>

                              <th style="min-width:100px !important">Emp Id</th>

                              <th style="min-width:300px !important">Emp Name</th>

                              <th  style="min-width:200px !important">Department</th>

                              <th  style="min-width:100px !important">Access Given</th>

                              <th  style="min-width:100px !important">Break Down </th>

                              <th  style="min-width:50px !important">&nbsp;</th>

                            </tr>

                          </thead>

                          <tbody>

                            <?php



								 $sl=1;

								 $sql5="SELECT `menu_access_distribution_to_employees_individual`.*,`department_masters`.`department` FROM `menu_access_distribution_to_employees_individual` left join `department_masters` on `department_masters`.id=`menu_access_distribution_to_employees_individual`.`emp_department` WHERE `menu_access_distribution_to_employees_individual`.`emp_id`= '" .$rowe_id['emp_id']. "' AND `menu_access_distribution_to_employees_individual`.`menu_access_unique_id`= '" .$employee_gen_id. "' AND `menu_access_distribution_to_employees_individual`.`del_flag`='0'";							

								  $result5=$conn->query($sql5) ;							

								  $count=$result5->num_rows;

									if($count=='0'){

								  	echo '<input type="hidden" name="countiop" id="countiop" value="'.($count+1).'">';

								 ?>

                            <tr id="iop<?php echo ($count+1); ?>">

                              <td style="min-width:30px !important"><?php echo ($count+1); ?></td>

                              <td style="min-width:150px !important"><select class="form-control" name="mainmanu_id<?php echo ($count+1); ?>" id="mainmanu_id<?php echo ($count+1); ?>" onChange="functionmain_manu('<?php echo ($count+1); ?>');">

                                  <option value="">-Select Menu-</option>

                                  <?php 



								 $sql7="SELECT `id`, `main_menu_name` FROM `main_menu_masters` WHERE `del_flag`='0' ORDER BY `id` ASC ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['main_menu_name'].'</option>';



								 }



					 			?>

                                </select></td>

                              <td style="min-width:300px !important"><select class="form-control" name="submanu_id<?php echo ($count+1); ?>" id="submanu_id<?php echo ($count+1); ?>" onChange="functionurl('<?php echo ($count+1); ?>')">

                                  <option value="">-Select Sub Menu-</option>

                                </select></td>

                              <td style="min-width:200px !important"><input type="text" class="form-control" name="manu_url<?php echo ($count+1); ?>" id="manu_url<?php echo ($count+1); ?>" value="" readonly>

                                <input type="hidden" id="hr_login_id<?php echo ($count+1); ?>" name="hr_login_id<?php echo ($count+1); ?>" class="form-control" value="<?php echo $rowe_id['hr_login_id'];?>" placeholder="Enter Text"  readonly />

                                <input type="hidden" id="users_id<?php echo ($count+1); ?>" name="users_id<?php echo ($count+1); ?>" class="form-control" value="<?php echo $rowe_id['user_id'];?>" placeholder="Enter Text"  readonly />

                                <input type="hidden" name="employee_flug<?php echo ($count+1); ?>" id="employee_flug<?php echo ($count+1); ?>" value="0">

                                 <input type="hidden" name="special_flag<?php echo ($count+1); ?>" id="special_flag<?php echo ($count+1); ?>" value="0">

                                

                                <!--<input type="hidden" name="employee_ins_id<?php echo ($count+1); ?>" id="employee_ins_id<?php echo ($count+1); ?>" value="0">--></td>

                              <td style="min-width:100px !important"><input type="text" class="form-control" name="emp_id<?php echo ($count+1); ?>" id="emp_id<?php echo ($count+1); ?>" value="<?php echo $rowe_id['emp_id']?>" readonly></td>

                              <td style="min-width:300px !important"><input type="text" class="form-control" name="emp_full_name<?php echo ($count+1); ?>" id="emp_full_name<?php echo ($count+1); ?>" value="<?php echo $rowe_id['emp_full_name']?>" readonly></td>

                              <td style="min-width:200px !important"><select class="form-control" name="emp_department<?php echo ($count+1); ?>" id="emp_department<?php echo ($count+1); ?>"  style="min-width:120px !important" readonly >

                                  <?php if($rowe_id['emp_department']!='')

									echo '<option value="'.$rowe_id['emp_department'].'">'.$rowe_id['department'].'</option>';

							?>

                                </select></td>

                              <td style="min-width:100px !important"><select class="form-control" name="manu_access_employee<?php echo ($count+1); ?>" id="manu_access_employee<?php echo ($count+1); ?>">

                                  <option value="0">YES</option>

                                  <option value="1">NO</option>

                                </select></td>

                              <td style="min-width:100px !important"><select class="form-control" name="break_down_flag<?php echo ($count+1); ?>" id="break_down_flag<?php echo ($count+1); ?>">

                                  <option value="0">No</option>

                                  <option value="1">Yes</option>

                                </select></td>

                              <td style="min-width:50px !important">&nbsp;</td>

                            </tr>

                            <?php } else{

							   		echo '<input type="hidden" name="countiop" id="countiop" value="'.$count.'">';



							   			while ($row5=mysqli_fetch_array($result5,MYSQLI_ASSOC))

							  		{



							?>

                            <tr id="iop<?php echo $sl; ?>">

                              <td style="min-width:30px !important"><?php echo $sl; ?></td>

                              <td style="min-width:150px !important"><select class="form-control" name="mainmanu_id<?php echo $sl; ?>" id="mainmanu_id<?php echo $sl; ?>" onChange="functionmain_manu('<?php echo $sl; ?>');">

                                  <option value="">-Select Menu-</option>

                                  <?php 



								 $sql7="SELECT `id`, `main_menu_name` FROM `main_menu_masters` WHERE `del_flag`='0' ORDER BY `id` ASC ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 echo '<option value="'.$row7['id'].'" '; if($row5['mainmanu_id']==$row7['id']){echo "selected";} echo '>'.$row7['main_menu_name'].'</option>';



								 }



					 			?>

                                </select></td>

                              <td style="min-width:300px !important">

                              <select class="form-control" name="submanu_id<?php echo $sl; ?>" id="submanu_id<?php echo $sl; ?>" onChange="functionurl('<?php echo $sl; ?>')">

                                  <option value="">-Select Sub Menu -</option>

                                  <?php 

                              $sql7="SELECT `id`, `sub_menu_name` FROM `sub_menu_masters` WHERE `del_flag`='0' ORDER BY `sub_menu_name` ASC ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {									 



									 if($row5['submanu_id']==$row7['id']){ echo '<option value="'.$row7['id'].'" '; if($row5['submanu_id']==$row7['id']){echo "selected";} echo '>'.$row7['sub_menu_name'].'</option>';}   

								 } 

								 ?>

                                </select></td>

                              <td style="min-width:200px !important"><input type="text" class="form-control" name="manu_url<?php echo $sl; ?>" id="manu_url<?php echo $sl; ?>" value="<?php echo $row5['manu_url'];?>" readonly>

                                <input type="hidden" id="hr_login_id<?php echo $sl; ?>" name="hr_login_id<?php echo $sl; ?>" class="form-control" value="<?php echo $row5['hr_login_id'];?>" placeholder="Enter Text"  readonly />

                                <input type="hidden" id="users_id<?php echo $sl; ?>" name="users_id<?php echo $sl; ?>" class="form-control" value="<?php echo $row5['user_id'];?>" placeholder="Enter Text"  readonly />

                                <input type="hidden" name="employee_flug<?php echo $sl; ?>" id="employee_flug<?php echo $sl; ?>" value="<?php echo $row5['employee_flug']?>">

                                <input type="hidden" name="special_flag<?php echo $sl; ?>" id="special_flag<?php echo $sl; ?>" value="<?php echo $row5['special_flag']?>">

                                <input type="hidden" name="employee_ins_id<?php echo $sl; ?>" id="employee_ins_id<?php echo $sl; ?>" value="<?php echo $row5['id']?>"></td>

                              <td style="min-width:100px !important"><input type="text" class="form-control" name="emp_id<?php echo $sl; ?>" id="emp_id<?php echo $sl; ?>" value="<?php echo $row5['emp_id']?>" readonly></td>

                              <td style="min-width:300px !important"><input type="text" class="form-control" name="emp_full_name<?php echo $sl; ?>" id="emp_full_name<?php echo $sl; ?>" value="<?php echo $row5['emp_full_name']?>" readonly></td>

                              <td style="min-width:200px !important"><select class="form-control" name="emp_department<?php echo $sl; ?>" id="emp_department<?php echo $sl; ?>"  style="min-width:120px !important" readonly >

                                  <?php if($row5['emp_department']!='')

									echo '<option value="'.$row5['emp_department'].'">'.$row5['department'].'</option>';

							?>

                                </select>

                                

                                <!--<input type="text" class="form-control" name="emp_department<?php echo $sl; ?>" id="emp_department<?php echo $sl; ?>" value="<?php echo $row5['emp_department']?>" readonly>--></td>

                              <td style="min-width:100px !important"><select class="form-control" name="manu_access_employee<?php echo $sl; ?>" id="manu_access_employee<?php echo $sl; ?>">

                                  <option value="0" <?php if($row5['manu_access_employee']=='0'){echo "selected";}?>>YES</option>

                                  <option value="1"<?php if($row5['manu_access_employee']=='1'){echo "selected";}?>>NO</option>

                                </select></td>

                              <td style="min-width:100px !important"><select class="form-control" name="break_down_flag<?php echo $sl; ?>" id="break_down_flag<?php echo $sl; ?>">

                                  <option value="0" <?php if($row5['break_down_flag']=='0'){echo "selected";}?>>NO</option>

                                  <option value="1"<?php if($row5['break_down_flag']=='1'){echo "selected";}?>>Yes</option>

                                </select></td>

                              <td style="min-width:50px !important"><a href="javascript:void(0);"  id="iop_remove<?php echo $sl; ?>" onClick="remove_iop_del('<?php echo $row5['id']; ?>','<?php echo $sl; ?>')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>

                            </tr>

                            <?php $sl++; }} ?>

                          </tbody>

                          <input type="hidden" name="remove_id_for_drug" id="remove_id_for_drug" value="">

                          <input type="hidden" name="total_rows_table_new" id="total_rows_table_new" value="0">

                        </table>

                      </div>

                    </div>

                    <p>&nbsp;</p>

                    <p>&nbsp;</p>

                    <p>&nbsp;</p>

                  </div>

                </div>

                <p style="padding:12px 0 2px 0; text-align:center;backgroung:#fff">

                  <button type="submit" name="submit" id="submit" class="btn green">Submit</button>

                </p>

                <?php }?>

              </div>

              <?php }?>

            </form>

          </div>

          

          <!-- </div> --> 

        </div>

        <!-- END PAGE CONTENT --> 

      </div>

    </div>

  </div>

  <!-- END PAGE CONTENT INNER --> 

</div>



<!-- END PAGE CONTENT --> 



<script src="newjs/jquery.min.js" type="text/javascript"></script> 

<script type="text/javascript"> 

$(document).ready( function() { 

	      

    setTimeout('$("#alert_msg").hide()',3000);       

	   $("#mrd_check").select2();

	 $("#meeting_date").datepicker({

			   format: 'dd-mm-yyyy'

		   });

		   

		   $("#meeting_time").timepicker({

			   timeFormat: 'h:mm p'

		   }); 

		   

		   $('#main_menu_id').on('change',function(){

			var main_menu_id=$("#main_menu_id").val();

			var main_menu_option_text=$("#main_menu_id option:selected").text();

			var total_main_nav_menus=$("#total_main_nav_menus").val();

			var emp_id=$("#emp_id").val();

			var emp_full_name=$("#emp_full_name").val();

			var emp_department=$("#emp_department").val();

			var emp_department_text=$("#emp_department_text").val();

			var hr_login_id=$("#hr_login_id").val();

			var users_id=$("#users_id").val();			 

			 $.ajax({

					  beforeSend: function(){

						 $('.ajax-loader').css("visibility", "visible");

					  },	

					  type : "POST",

					  url : "<?php echo ADMIN_URL; ?>ajax/menu_shortcut_ajax.php",

					  dataType : "json", 

					  data : "main_menu_id="+main_menu_id,

					  success : function(data) {

							  if(data.flag=='1'){				 

								  //$("#emp_id").val(data.emp_id);	

								  //alert(data.count);							  

								  $("#total_rows_table_new").val(data.count);

								  var rows_total=$("#total_rows_table_new").val();

								  //alert(rows_total);

								 if(rows_total>0){									 

									for(var new_inc=1;new_inc<=rows_total;new_inc++){

										 var i=$("#countiop").val();

										 i=parseInt(i)+1;

										 $("#countiop").val(i);

								 //alert(i);

								 $("#iop_tab").append('<tr id="iop'+ i +'"><td style="min-width:30px !important">'+ i +'</td><td style="min-width:150px !important"><select class="form-control" name="mainmanu_id'+ i +'" id="mainmanu_id'+ i +'" onChange="functionmain_manu('+ i +');"><option value="">-Select Menu-</option><?php $sql7="SELECT `id`, `main_menu_name` FROM `main_menu_masters` WHERE `del_flag`='0' ORDER BY `id` ASC "; $result7=$conn->query($sql7) ; while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){ echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['main_menu_name'].'</option>';}?></select></td><td style="min-width:300px !important"><select class="form-control" name="submanu_id'+ i +'" id="submanu_id'+ i +'" onChange="functionurl('+ i +')"> <option value="">-Select Sub Menu-</option></select></td><td style="min-width:150px !important"><input type="text" class="form-control" name="manu_url'+ i +'" id="manu_url'+ i +'" value="" readonly><input type="hidden" id="hr_login_id'+ i +'" name="hr_login_id'+ i +'" class="form-control" value="'+hr_login_id+'" placeholder="Enter Text"  readonly /><input type="hidden" id="users_id'+ i +'" name="users_id'+ i +'" class="form-control" value="'+users_id+'" placeholder="Enter Text"  readonly /><input type="hidden" name="employee_flug'+ i +'" id="employee_flug'+ i +'" value="0"><input type="hidden" name="special_flag'+ i +'" id="special_flag'+ i +'" value="0"><input type="hidden" name="employee_ins_id'+ i +'" id="employee_ins_id'+ i +'" value=""><td style="min-width:100px !important"><input type="text" class="form-control" name="emp_id'+ i +'" id="emp_id'+ i +'" value="'+emp_id+'" readonly></td><td style="min-width:300px !important"><input type="text" class="form-control" name="emp_full_name'+ i +'" id="emp_full_name'+ i +'" value="'+emp_full_name+'" readonly></td><td style="min-width:200px !important"><select class="form-control" name="emp_department'+ i +'" id="emp_department'+ i +'"  style="min-width:120px !important" readonly ><option value="'+emp_department+'">'+emp_department_text+'</option></select></td><td style="min-width:100px !important"><select class="form-control" name="manu_access_employee'+ i +'" id="manu_access_employee'+ i +'"><option value="0">YES</option><option value="1">NO</option></select></td><td style="min-width:100px !important"><select class="form-control" name="break_down_flag'+ i +'" id="break_down_flag'+ i +'"><option value="0">No</option><option value="1">Yes</option></select></td><td style="min-width:50px !important"><a href="javascript:void(0);"  id="iop_remove'+ i +'" onClick="remove_iop('+ i +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

								 

										$('#mainmanu_id'+ i +'').val(main_menu_id);

										new_slected_sub_manu(i,new_inc)

										

										 }

										 var new_total_main_nav_menus=parseInt(total_main_nav_menus)+1;

										 $("#total_main_nav_menus").val(new_total_main_nav_menus);

										 if((new_total_main_nav_menus!='1')&&(new_total_main_nav_menus!='0')){

											if((new_total_main_nav_menus%7)=='0'){

												 $("#dept_add_block").append('<p>&nbsp;</p>');	

											}

										}

										 $("#dept_add_block").append('<div class="col-md-2" id="dept_div_id'+ new_total_main_nav_menus +'"><div class="input-group"><select class="form-control" name="dept_button'+ new_total_main_nav_menus +'" id="dept_button'+ new_total_main_nav_menus +'" style="min-width:120px !important;text-align:center !important;font-weight:bold;color: #430bc9;" readonly=""><option value="'+main_menu_id+'" selected="">'+main_menu_option_text+'</option></select></div></div>');

									 }

								 

								 $("#total_rows_table_new").val("0");

							  }	

					  },

					 complete: function(){

					  $('.ajax-loader').css("visibility", "hidden");

					}

				  });

				  

});



});

function functionmain_manu(no){	

	var mainmanu_id=$("#mainmanu_id"+no).val();

	$('#submanu_id'+no).find('option').remove().end();

	 $('#submanu_id'+no).append($('<option/>', { 

		value: "",

		text : "Choose Submenu" 

	}));					

				$.ajax({

								beforeSend: function(){

								 $('.ajax-loader').css("visibility", "visible");

								},

								type : "POST",

								url : "<?php echo ADMIN_URL; ?>ajax/sub_manu_select_ajax.php?mainmanu_id="+mainmanu_id,

								dataType : "json", 

								data : "mainmanu_id="+mainmanu_id,

								success : function(data) {	

										  $.each(data, function(index, element) { //alert(element.value); 

												if(element.value!=''){

												$('#submanu_id'+no).append($('<option/>', { 

															value: element.value,

															text : element.text 

														}));														

												}

										 });	

								},

								complete: function(){

								  $('.ajax-loader').css("visibility", "hidden");

								}

							});

						

}

function functionurl(no){

	var submanu_id=$("#submanu_id"+no).val();					

				$.ajax({

								beforeSend: function(){

								 $('.ajax-loader').css("visibility", "visible");

								},

								type : "POST",

								url : "<?php echo ADMIN_URL; ?>ajax/sub_manu_url_select_ajax.php?submanu_id="+submanu_id,

								dataType : "json", 

								data : "submanu_id="+submanu_id,

								success : function(data) {	

										$("#manu_url"+no).val(data.manu_url); 		

										$("#break_down_flag"+no).val(data.break_down_flag); 

										$("#special_flag"+no).val(data.special_flag); 

								},

								complete: function(){

								  $('.ajax-loader').css("visibility", "hidden");

								}

							});

					

}

 $("#iop_add_button").on('click',function(){ 

 			var emp_id=$("#emp_id").val();

			var emp_full_name=$("#emp_full_name").val();

			var emp_department=$("#emp_department").val();

			var emp_department_text=$("#emp_department_text").val();

			var hr_login_id=$("#hr_login_id").val();

			var users_id=$("#users_id").val();

			 var i=$("#countiop").val();

			 i=parseInt(i)+1;

			 $("#countiop").val(i);

			 //alert(i);

			 $("#iop_tab").append('<tr id="iop'+ i +'"><td style="min-width:30px !important">'+ i +'</td><td style="min-width:150px !important"><select class="form-control" name="mainmanu_id'+ i +'" id="mainmanu_id'+ i +'" onChange="functionmain_manu('+ i +');"><option value="">-Select Menu-</option><?php $sql7="SELECT `id`, `main_menu_name` FROM `main_menu_masters` WHERE `del_flag`='0' ORDER BY `id` ASC "; $result7=$conn->query($sql7) ; while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){ echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['main_menu_name'].'</option>';}?></select></td><td style="min-width:300px !important"><select class="form-control" name="submanu_id'+ i +'" id="submanu_id'+ i +'" onChange="functionurl('+ i +')"> <option value="">-Select Sub Menu-</option></select></td><td style="min-width:150px !important"><input type="text" class="form-control" name="manu_url'+ i +'" id="manu_url'+ i +'" value="" readonly><input type="hidden" id="hr_login_id'+ i +'" name="hr_login_id'+ i +'" class="form-control" value="'+hr_login_id+'" placeholder="Enter Text"  readonly /><input type="hidden" id="users_id'+ i +'" name="users_id'+ i +'" class="form-control" value="'+users_id+'" placeholder="Enter Text"  readonly /><input type="hidden" name="employee_flug'+ i +'" id="employee_flug'+ i +'" value="0"><input type="hidden" name="special_flag'+ i +'" id="special_flag'+ i +'" value="0"><input type="hidden" name="employee_ins_id'+ i +'" id="employee_ins_id'+ i +'" value=""><td style="min-width:100px !important"><input type="text" class="form-control" name="emp_id'+ i +'" id="emp_id'+ i +'" value="'+emp_id+'" readonly></td><td style="min-width:300px !important"><input type="text" class="form-control" name="emp_full_name'+ i +'" id="emp_full_name'+ i +'" value="'+emp_full_name+'" readonly></td><td style="min-width:200px !important"><select class="form-control" name="emp_department'+ i +'" id="emp_department'+ i +'"  style="min-width:120px !important" readonly ><option value="'+emp_department+'">'+emp_department_text+'</option></select></td><td style="min-width:100px !important"><select class="form-control" name="manu_access_employee'+ i +'" id="manu_access_employee'+ i +'"><option value="0">YES</option><option value="1">NO</option></select></td><td style="min-width:100px !important"><select class="form-control" name="break_down_flag'+ i +'" id="break_down_flag'+ i +'"><option value="0">No</option><option value="1">Yes</option></select></td><td style="min-width:50px !important"><a href="javascript:void(0);"  id="iop_remove'+ i +'" onClick="remove_iop('+ i +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

	 }); 

function remove_iop(j) {

  $("#iop"+j).remove();

} 

function remove_iop_del(id,sl_no) {

	  $("#iop"+sl_no).remove();	  

	  var remove_id_for_drug=$("#remove_id_for_drug").val();

	  var values_drug=remove_id_for_drug+id+":";

	  $("#remove_id_for_drug").val(values_drug);

	}



	

function emp_menu_dis_check_ajax(){

	  var id=$("#mrd_check").val();	  					

	  $.ajax({

		  			  beforeSend: function(){

						 $('.ajax-loader').css("visibility", "visible");

					  },	

					  type : "POST",

					  url : "<?php echo ADMIN_URL; ?>ajax/employees_basic_dic_ajax.php",

					  dataType : "json", 

					  data : "id="+id,

					  success : function(data) {

							  if(data.flag=='1'){				 

								  $("#emp_id").val(data.emp_id);	

								  

								  $("#hr_login_id").val(data.id);										 

								  $("#users_id").val(data.users_id);

								  $('#emp_department').append('<option value="' + data.dep_id + '" selected>' + data.emp_department + '</option>');		

								  $("#emp_full_name").val(data.emp_full_name);

								  $("#user_login_name").val(data.user_login_name);								 

							  }

					  },

					complete: function(){

					  $('.ajax-loader').css("visibility", "hidden");

					}

				  });			 

}









function submenus_with_row() {

	var main_menu_id=$("#main_menu_id").val();

	var main_menu_option_text=$("#main_menu_id option:selected").text();

	var total_main_nav_menus=$("#total_main_nav_menus").val();

	var emp_id=$("#emp_id").val();

	var emp_full_name=$("#emp_full_name").val();

	var emp_department=$("#emp_department").val();

	var emp_department_text=$("#emp_department_text").val();

	var hr_login_id=$("#hr_login_id").val();

	var users_id=$("#users_id").val();			 

	 $.ajax({

		 	  beforeSend: function(){

				 $('.ajax-loader').css("visibility", "visible");

			  },		

			  type : "POST",

			  url : "<?php echo ADMIN_URL; ?>ajax/menu_shortcut_ajax.php",

			  dataType : "json", 

			  data : "main_menu_id="+main_menu_id,

			  success : function(data) {

					  if(data.flag=='1'){				 

						  //$("#emp_id").val(data.emp_id);	

						  //alert(data.count);							  

						  $("#total_rows_table_new").val(data.count);

						  var rows_total=$("#total_rows_table_new").val();

						  //alert(rows_total);

						 if(rows_total>0){									 

							for(var new_inc=1;new_inc<=rows_total;new_inc++){

								 var i=$("#countiop").val();

								 i=parseInt(i)+1;

								 $("#countiop").val(i); 

						 //alert(i);

						 $("#iop_tab").append('<tr id="iop'+ i +'"><td style="min-width:30px !important">'+ i +'</td><td style="min-width:150px !important"><select class="form-control" name="mainmanu_id'+ i +'" id="mainmanu_id'+ i +'" onChange="functionmain_manu('+ i +');"><option value="">-Select Menu-</option><?php $sql7="SELECT `id`, `main_menu_name` FROM `main_menu_masters` WHERE `del_flag`='0' ORDER BY `id` ASC "; $result7=$conn->query($sql7) ; while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){ echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['main_menu_name'].'</option>';}?></select></td><td style="min-width:300px !important"><select class="form-control" name="submanu_id'+ i +'" id="submanu_id'+ i +'" onChange="functionurl('+ i +')"> <option value="">-Select Sub Menu-</option></select></td><td style="min-width:150px !important"><input type="text" class="form-control" name="manu_url'+ i +'" id="manu_url'+ i +'" value="" readonly><input type="hidden" id="hr_login_id'+ i +'" name="hr_login_id'+ i +'" class="form-control" value="'+hr_login_id+'" placeholder="Enter Text"  readonly /><input type="hidden" id="users_id'+ i +'" name="users_id'+ i +'" class="form-control" value="'+users_id+'" placeholder="Enter Text"  readonly /><input type="hidden" name="employee_flug'+ i +'" id="employee_flug'+ i +'" value="0"><input type="hidden" name="special_flag'+ i +'" id="special_flag'+ i +'" value="0"><input type="hidden" name="employee_ins_id'+ i +'" id="employee_ins_id'+ i +'" value=""><td style="min-width:100px !important"><input type="text" class="form-control" name="emp_id'+ i +'" id="emp_id'+ i +'" value="'+emp_id+'" readonly></td><td style="min-width:300px !important"><input type="text" class="form-control" name="emp_full_name'+ i +'" id="emp_full_name'+ i +'" value="'+emp_full_name+'" readonly></td><td style="min-width:200px !important"><select class="form-control" name="emp_department'+ i +'" id="emp_department'+ i +'"  style="min-width:120px !important" readonly ><option value="'+emp_department+'">'+emp_department_text+'</option></select></td><td style="min-width:100px !important"><select class="form-control" name="manu_access_employee'+ i +'" id="manu_access_employee'+ i +'"><option value="0">YES</option><option value="1">NO</option></select></td><td style="min-width:100px !important"><select class="form-control" name="break_down_flag'+ i +'" id="break_down_flag'+ i +'"><option value="0">No</option><option value="1">Yes</option></select></td><td style="min-width:50px !important"><a href="javascript:void(0);"  id="iop_remove'+ i +'" onClick="remove_iop('+ i +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

						 

								$('#mainmanu_id'+ i +'').val(main_menu_id);

								new_slected_sub_manu(i,new_inc)

								

								 }

								 var new_total_main_nav_menus=parseInt(total_main_nav_menus)+1;

								 $("#total_main_nav_menus").val(new_total_main_nav_menus);

								 if((new_total_main_nav_menus!='1')&&(new_total_main_nav_menus!='0')){

									if((new_total_main_nav_menus%7)=='0'){

										 $("#dept_add_block").append('<p>&nbsp;</p>');	

									}

								}

								 $("#dept_add_block").append('<div class="col-md-2" id="dept_div_id'+ new_total_main_nav_menus +'"><div class="input-group"><select class="form-control" name="dept_button'+ new_total_main_nav_menus +'" id="dept_button'+ new_total_main_nav_menus +'" style="min-width:120px !important;text-align:center !important;font-weight:bold;color: #430bc9;" readonly=""><option value="'+main_menu_id+'" selected="">'+main_menu_option_text+'</option></select></div></div>');

							 }

						 

						 $("#total_rows_table_new").val("0");

					  }	

			  },

			complete: function(){

			  $('.ajax-loader').css("visibility", "hidden");

			}

			  

		  });

				  

			

}



function new_slected_sub_manu(no,index_cols){

	var mainmanu_id=$("#mainmanu_id"+no).val();

	$('#submanu_id'+no).find('option').remove().end();

	 $('#submanu_id'+no).append($('<option/>', { 

		value: "",

		text : "Choose Submenu" 

	}));					

				$.ajax({		

								beforeSend: function(){

									 $('.ajax-loader').css("visibility", "visible");

								},

								type : "POST",

								url : "<?php echo ADMIN_URL; ?>ajax/sub_manu_select_ajax.php?mainmanu_id="+mainmanu_id,

								dataType : "json", 

								data : "mainmanu_id="+mainmanu_id,

								success : function(data) {	

										  $.each(data, function(index, element) { //alert(element.value); 

												if(element.value!=''){

												$('#submanu_id'+no).append($('<option/>', { 

															value: element.value,

															text : element.text 

														}));

														//$('#submanu_id'+ no +' option').eq(index_cols).prop('selected', true);

														$('#submanu_id'+ no).children().removeAttr("selected");

														$('#submanu_id'+ no).children().eq(index_cols).attr('selected', 'selected');

														//functionurl(no);

												}

										 });

										 functionurl(no);

								},

								complete: function(){

								  $('.ajax-loader').css("visibility", "hidden");

								}

								

							});

						

}

</script>

<?php include "footer.php" ?>

