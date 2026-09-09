<?php 

if(!isset($_SESSION['username']))

{

$redirectUrl=ADMIN_URL.'index.php';

echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

}

?>

<!DOCTYPE html>

<html lang="en" class="no-js">

<!-- BEGIN HEAD -->

<head>
<meta charset="utf-8">
<title>Electronic Medical Records System by ESPPL</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Evolution of EMR stands for Electronic medical records, which are the digital equivalent of paper records, or charts at a clinician's office. EMRs typically contain general information such as treatment and medical history about a patient as it is collected by the individual medical practice." name="description"/>
<meta content="ESPPL" name="author"/>
<meta name="keywords" content="EMR, Electronic medical records, Hospital, Patient, Prescription ">

<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/jquery-multi-select/css/multi-select.css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">

<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN PAGE STYLES -->

<link href="assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>

<!-- END PAGE STYLES -->

<!-- BEGIN PLUGINS USED BY X-EDITABLE -->

<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css"/>

<!-- END PLUGINS USED BY X-EDITABLE -->

<!-- BEGIN THEME STYLES -->

<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->

<link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">

<!-- Added new-->

<link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->

<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<!--<link rel="manifest" href="favicon/manifest.json">-->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<style>
/* address phone-area hos-name */

.hos-name {
	font-size: 25px;
	margin-top: 10px;
	padding:10px;
	font-weight: bold;
}
.page-titles-content > .hos-name {
	font-size: 25px;
	margin-top: 10px;
	padding:10px;
	color:#c51b1b;
}
.page-titles-content {
	float: left;
	display: block;
	width: 755px;
	height: 75px;
}
 @media (max-width: 991px) {
 .page-titles-content {
 float: left;
 display: block;
 width: 365px;
 height: 75px;
}
 .page-titles-content > .hos-name {
 font-weight: bold;
 font-size: 20px;
 margin-top: 10px;
 padding:5px;
 color:#c51b1b;
}
}
</style>
</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->

<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->

<body>

<!-- BEGIN HEADER -->

<div class="page-header"> 
  
  <!-- BEGIN HEADER TOP -->
  
  <div class="page-header-top">
    <div class="container-fluid"> 
      
      <!-- BEGIN LOGO -->
      
      <?php 

				 $sql_hospital_information="SELECT * FROM `hospital_info_masters`";

				 $result_hospital_information=$conn->query($sql_hospital_information) ;

				 $row_hospital_information = $result_hospital_information->fetch_assoc(); ?>
      <div class="page-logo"> <a href="<?php echo ADMIN_URL; ?>dashboard.php"><img src="<?php echo ADMIN_URL.'upload/hospital_logo/'.$row_hospital_information['hospital_logo'];  ?>" alt="logo" class="logo-default"></a></div>
      
      <!-- END LOGO -->
      
      <div class="page-titles-content" style="padding-top:10px;text-align:center;">
        <h4 class="text-center hos-name"> <?php echo $row_hospital_information['hospital_name']; ?></h4>
        
        <!--<img src="<?php echo ADMIN_URL.'upload/hospital_pic/'.$row_hospital_information['hospital_pic'];  ?>" alt="logo" class="logo-default">--> 
        
      </div>
      
      <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
      
      <a href="javascript:;" class="menu-toggler"></a> 
      
      <!-- END RESPONSIVE MENU TOGGLER --> 
      
      <!-- BEGIN TOP NAVIGATION MENU -->
      
      <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
          <li class="dropdown dropdown-user dropdown-dark"> <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <img alt="user image" class="img-circle" src="assets/admin/layout3/img/814068_face_512x512.png"> <span class="username username-hide-mobile"><?php echo $_SESSION['username'];?></span><br>
            <span class="username username-hide-mobile font-green-sharp">( <?php echo $_SESSION['user_full_name'];?> )</span> </a>
            <ul class="dropdown-menu dropdown-menu-default">
              <li> <a href="<?php echo ADMIN_URL; ?>update_password.php" title="Change Password"> <i class="icon-key"></i> Change Password </a> </li>
              <li> <a href="logout.php" title="Log Out"> <i class="icon-logout"></i> Log Out </a> </li>
            </ul>
          </li>
          
          <!-- END USER LOGIN DROPDOWN -->
          
        </ul>
      </div>
      
      <!-- END TOP NAVIGATION MENU --> 
      
    </div>
  </div>
  
  <!-- END HEADER TOP --> 
  
  <!-- BEGIN HEADER MENU -->
  
  <div class="page-header-menu">
    <div class="container-fluid"> 
      
      <!-- BEGIN MEGA MENU --> 
      
      <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background --> 
      
      <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
      
      <div class="hor-menu ">
        <ul class="nav navbar-nav">
          <li class="active"> <a href="<?php echo $_SESSION['url']; ?>"><img alt="" class="img-circle" src="assets/admin/layout3/img/home-512.png"></a> </li>
          <?php 

		  $menu_sl_no=0;		  

		   $sql_menu_nav="SELECT `main_menu_masters`.`id`,`main_menu_masters`.`main_menu_name`,`main_menu_masters`.`right_to_left_navigation` FROM `menu_access_distribution_to_employees_individual` INNER JOIN `main_menu_masters` ON  `menu_access_distribution_to_employees_individual`.`mainmanu_id`=`main_menu_masters`.`id` WHERE  `menu_access_distribution_to_employees_individual`.`del_flag`='0' AND `menu_access_distribution_to_employees_individual`.`manu_access_employee`='0' AND `menu_access_distribution_to_employees_individual`.`user_id`='".$_SESSION['id']."' GROUP BY `menu_access_distribution_to_employees_individual`.`mainmanu_id` ORDER BY `menu_access_distribution_to_employees_individual`.`id` ASC";

								 $result_menu_nav=$conn->query($sql_menu_nav) ;

								 while($row_menu_nav=mysqli_fetch_array($result_menu_nav,MYSQLI_ASSOC))

								 {?>
          <?php 

								 $right_flag=0;

								 if($row_menu_nav['right_to_left_navigation']==1){

									 if($menu_sl_no>7){

									$right_flag=1; 

									 }

								 }

								 ?>
          <li class="menu-dropdown mega-menu-dropdown " <?php if($right_flag==1){ echo 'style="direction: rtl !important;"';}?> > <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
            <?php if($right_flag==1){echo '<i class="fa fa-angle-down"></i>';}?>
            <?php echo $row_menu_nav['main_menu_name']; ?>
            <?php if($right_flag==0){ echo '<i class="fa fa-angle-down"></i>';}?>
            </a>
            <ul class="dropdown-menu">
              <li>
                <div class="mega-menu-content">
                  <div class="row">
                    <div class="col-md-6">
                      <ul class="mega-menu-submenu" style="min-width:169px">
                        <?php $sql_menu_sub_nav="SELECT `sub_menu_masters`.`id`,`sub_menu_masters`.`sub_menu_name`,`sub_menu_masters`.`url`,`menu_access_distribution_to_employees_individual`.`break_down_flag`,`sub_menu_masters`.`function_click` ,`menu_access_distribution_to_employees_individual`.`special_flag` FROM `menu_access_distribution_to_employees_individual` INNER JOIN `sub_menu_masters` ON  `menu_access_distribution_to_employees_individual`.`submanu_id`=`sub_menu_masters`.`id` WHERE  `menu_access_distribution_to_employees_individual`.`del_flag`='0' AND `sub_menu_masters`.`del_flag`='0' AND `menu_access_distribution_to_employees_individual`.`manu_access_employee`='0' AND `menu_access_distribution_to_employees_individual`.`user_id`='".$_SESSION['id']."' AND `menu_access_distribution_to_employees_individual`.`mainmanu_id`='".$row_menu_nav['id']."'  ORDER BY `menu_access_distribution_to_employees_individual`.`id` ASC";

								 $result_menu_sub_nav=$conn->query($sql_menu_sub_nav) ;

								 while($row_menu_sub_nav=mysqli_fetch_array($result_menu_sub_nav,MYSQLI_ASSOC))

								 {?>
                        <li><a href="<?php if($row_menu_sub_nav['function_click']!='') {  echo $row_menu_sub_nav['url']; }else{ echo ADMIN_URL.$row_menu_sub_nav['url'].'.php'; } ?>" <?php echo $row_menu_sub_nav['function_click']; ?> class="iconify">
                          <?php if($right_flag==0){ echo '<i class="fa fa-angle-right"></i>';}?>
                          <?php echo $row_menu_sub_nav['sub_menu_name']; ?>
                          <?php if($right_flag==1){ echo '<i class="fa fa-angle-right"></i>';}?>
                          </a></li>
                        <?php if($row_menu_sub_nav['special_flag']=='1'){?>
                        <li style="border-bottom: 5px solid red;"></li>
                        <?php }?>
                        <?php if($row_menu_sub_nav['break_down_flag']=='1'){?>
                      </ul>
                    </div>
                    <div class="col-md-6">
                      <ul class="mega-menu-submenu">
                        <?php }?>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <?php $menu_sl_no++;} ?>
        </ul>
      </div>
      
      <!-- END MEGA MENU --> 
      
    </div>
  </div>
  
  <!-- END HEADER MENU --> 
  
</div>

<!-- END HEADER --> 