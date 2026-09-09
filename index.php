<?php include 'conn.php';
if(isset($_POST['username']))
{
$userid = $_POST['username'];
$password = $_POST['password'];

$username_check = stripcslashes($userid);  
$password_check = stripcslashes($password); 
  
$sanitized_userid =  mysqli_real_escape_string($conn, $username_check);      
$sanitized_password =  mysqli_real_escape_string($conn, $password_check);

$sql='SELECT * FROM `users` WHERE `username`="'.$sanitized_userid.'" and `password`="'.$sanitized_password.'" AND `del_flag`=0 AND `inactive_status`=0';
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$_SESSION['username']=$_POST['username'];
$_SESSION['password']=$_POST['password'];
$_SESSION['role']=$row['role'];
$_SESSION['id']=$row['id'];
$_SESSION["user_role"]=$row['user_role'];		
//$_SESSION["role_name"]=$role_name;
$_SESSION["department_id"]=$row['department_id'];
$_SESSION["user_id"]=$row['id'];
$_SESSION["approve_flag"]=$row['approved_permission_for_leave_extra_duty'];
$_SESSION["patient_show_flag"]=$row['patient_show_flag'];
$_SESSION['choose_doctors']=$row['choose_doctors'];
$_SESSION['emr_pres_master_add_flag']=$row['emr_pres_master_add_flag'];
$today=date('Y-m-d H:i:s');

$sql_user_name='SELECT * FROM `user_infos` WHERE `users_id`="'.$row['id'].'" ';
$result_user_name=$conn->query($sql_user_name) ;
$count_user_name=$result_user_name->num_rows;
$row_user_name = $result_user_name->fetch_assoc();
if($count_user_name>0)
{
	$_SESSION["user_full_name"]=$row_user_name['name'];
}
$sql6 = $conn->query("INSERT INTO `login_details` SET `login_id`='".$row['id']."',`login_time`='".$today."'");
$login_unique_id = $conn->insert_id;
$_SESSION["login_unique_id"]=$login_unique_id;

$redirectUrl=ADMIN_URL.'dashboard.php'; // student
$_SESSION['url']=$redirectUrl;
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
exit();
}
else {
$err="Incorrect User Name / Password";	
}
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Electronic Medical Records System by ESPPL | Login Form</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="Evolution of EMR stands for Electronic medical records, which are the digital equivalent of paper records, or charts at a clinician's office. EMRs typically contain general information such as treatment and medical history about a patient as it is collected by the individual medical practice." name="description"/>
<meta content="ESPPL" name="author"/>
<meta name="keywords" content="EMR, Electronic medical records, Hospital, Patient, Prescription ">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
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
<link rel="manifest" href="favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
</head>
<style>
a {
    color: #850404 !important;
}
.control-label{
	font-weight:bold !important;
}

.form-title{
	font-weight:bold !important;
	text-align:center !important;
}
.login .content .form-actions {
	padding: 0px 30px 10px 30px !important;
}
.login .content .form-title {
    font-weight: 300px !important;
    margin-bottom: 18px !important;
}
.login .copyright {
    padding: 0px !important;
}
input[type=text] {
 font-weight:bold !important;
 color: #000 !important;
}
.alert {
    padding: 2px !important;
    margin-bottom: 8px !important;
    color: #c50b0b !important;
    font-weight: 400 !important;
}
@media only screen and (max-width: 600px) {
	#captcha_reload_div > img
	{
		width: 180px !important;
	}
}
</style>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login" style="">
<!--<body class="login" >--> 
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler"> </div>
<!-- END SIDEBAR TOGGLER BUTTON --> 
<!-- BEGIN LOGO -->
<div ><p>&nbsp;</p> </div>
<!-- END LOGO --> 
<!-- BEGIN LOGIN -->
<div class="content" >
 <?php 
				 $sql_hospital_information="SELECT * FROM `hospital_info_masters`";
				 $result_hospital_information=$conn->query($sql_hospital_information) ;
				 $row_hospital_information = $result_hospital_information->fetch_assoc(); ?>
  <center>
    <a href="<?php echo ADMIN_URL; ?>"> <img src="<?php echo ADMIN_URL.'upload/hospital_logo/'.$row_hospital_information['hospital_logo'];  ?>" alt=""/> </a>
  </center>
  <!-- BEGIN LOGIN FORM -->
  <form class="login-form" action="" method="post">
    <h3 class="form-title"><?php echo $row_hospital_information['hospital_name']; ?> Login</h3>
    <div class="alert alert-reception display-hide" id="alert_msg">
      <button class="close" data-close="alert"></button>
      <span id="err_msg"> Incorrect User Name / Password </span> </div>
    <div class="form-group">
      <label class="control-label">Login ID / Username</label>
      <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Login ID" name="username" id="username" />
    </div>
    <div class="form-group">
      <label class="control-label ">Password</label> 
       <div class="input-group">
      <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password" />
      <span class="input-group-addon"><b> <a href="javascript:void(0);" onclick="show_pass();" style="font-weight:bold;" id="show_anchor" title="Show Password"> <i class="fa fa-eye"></i> </a> <a href="javascript:void(0);" onclick="hide_pass();" style="font-weight:bold;display:none;" id="hide_anchor" title="Hide Password"> <i class="fa fa-eye-slash"></i> </a> </b></span> </div>
      <input class="form-control form-control-solid placeholder-no-fix" type="hidden" autocomplete="off" placeholder="error" name="err" id="err" value="<?php if(isset($err)){ echo $err;} ?>"/>
     
    </div>
    
    <div class="form-group">
      <label class="control-label">Are you human? </label>
      <div id="captcha_reload_div">
      <?php
      require "captcha.php";
      $PHPCAP->prime();
      $PHPCAP->draw();
      ?>
       </div>
       <?php $_SESSION["captcha"];?>
      <p>&nbsp;<span>In captcha alphanumeric charecter is always in small case.<br><a href="javascript:void(0);" id="reload_captcha" name="reload_captcha" title="Reload Captcha " onClick="reload_div()">Reload Captcha <i class="fa fa-rotate-right" title="Reload Captcha "></i></a></span></p>
      <input  class="form-control form-control-solid placeholder-no-fix"  name="captcha" id="captcha" placeholder="Enter Above Captcha Value" type="text" required/>
        
    </div>
   
    <div class="form-actions">
      <center>
      	 <button type="button" name="register" id="register" class="btn btn-success uppercase"  >Login</button>
         <div id="submit_load_div"> </div>
         
      </center>
    </div>
  </form>
  <div class="copyright"> © All content Copy Right reserved 2021 to <a href="https://www.elegantsystems.net/" title="www.elegantsystems.net" target="_blank">www.elegantsystems.net</a> </div>
</div>

<!-- END LOGIN --> 
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) --> 
<!-- BEGIN CORE PLUGINS --> 
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript">
$("#username").focus();

$(document).ready(function(){    
	var err = $("#err").val();
	if(err!='')
	{
		$("#alert_msg").removeClass("display-hide");
	}
	
	
	
	$("#register").click(function(){ 
			 $("#register").prop('disabled', true);
			 //alert("ani");
			var flag=0;			
			var username=$("#username").val();
			if(username=='')
			{
				alert("Please Enter Login ID");
				$("#username").focus();
				flag=1;
				$("#username").css( "border-width", "2px" );
				$("#username").css( "border-color", "red" );
			}
			var password=$("#password").val();
			if(password=='')
			{
				alert("Please Enter Password");
				$("#password").focus();
				flag=1;
				$("#password").css( "border-width", "2px" );
				$("#password").css( "border-color", "red" );
			}
			var specialChars = "<>!#$%^&*()+[]{}?:;|'\"\\,/~`="
			var check = function(string){
				for(i = 0; i < specialChars.length;i++){
					if(string.indexOf(specialChars[i]) > -1){
						return true
					}
				}
				return false;
			}
			
			if(check($('#username').val()) == false){
				// Code that needs to execute when none of the above is in the string
				
			}else{
				alert('Login ID / Username contains illegal characters.');
				$("#username").focus();
				flag=1;
				$("#username").css( "border-width", "2px" );
				$("#username").css( "border-color", "red" );
			}
			
			var captcha=$("#captcha").val();
			if(captcha=='')
			{
				alert("Please Enter Above Captcha");
				$("#captcha").focus();
				flag=1;
				$("#captcha").css( "border-width", "2px" );
				$("#captcha").css( "border-color", "red" );
			}
			$.ajax({
				url: 'captcha_check.php',
				type: 'POST',
				dataType: 'json',
				data: "captcha="+captcha,
				async: false, 
				success: function (data) {						
					if((data.fl)=='0')	{
						flag=1;
						$("#alert_msg").removeClass("display-hide");
						//$('#err_msg').empty();
						alert("Incorrect Captcha!!");
						$('#err_msg').html("Incorrect Captcha!!");
						$("#captcha").focus();
						$("#captcha").css( "border-width", "2px" );
						$("#captcha").css( "border-color", "red" );
					}
					
				}
			});
			if(flag==0)
			{
				//alert("success");
				var submit_load_div_val='<button type="submit" name="submit" id="submit" class="btn blue" style="display:none;">Login</button>';
				$("#submit_load_div").html(submit_load_div_val);
				$("#submit"). click();
			}else{
				$("#register").prop('disabled', false);	
			}
	});
});
function reload_div(){
	
	$('#captcha_reload_div').empty();
	$.ajax({
		url: 'reload_captcha_file.php',
		type: 'POST',
		data: "test=2",
		async: false, 
		success: function (data) {						
			$("#assets_body").html(data);
			$("#captcha_reload_div").html(data);
			
		}
	});
}
function show_pass(){
	$("#show_anchor").css("display", "none") ;
	$("#password").prop("type", "text") ;
	$("#hide_anchor").css("display", "block") ;
}
function hide_pass(){
	$("#hide_anchor").css("display", "none") ;
	$("#password").prop("type", "password") ;
	$("#show_anchor").css("display", "block") ;
}

</script> 
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script> 
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script> 
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script> 
<!-- END PAGE LEVEL PLUGINS --> 
<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script> 
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script> 
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script> 
<script src="assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script> 
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script> 
<script src="assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 
<script>
jQuery(document).ready(function() {     
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Login.init();
	Demo.init();
	$.backstretch([
        "assets/admin/pages/media/bg/1.jpg",
        "assets/admin/pages/media/bg/2.jpg",
        "assets/admin/pages/media/bg/3.jpg",
        "assets/admin/pages/media/bg/4.jpg"
        ], {
          fade: 1000,
          duration: 8000
    }
    );
});
</script> 

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>