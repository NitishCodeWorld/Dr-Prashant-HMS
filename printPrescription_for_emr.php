<?php include 'conn.php'; ?>
<?php



$sql_hospital_info="SELECT * FROM `hospital_info_masters`";	



$res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));



$row_hospital_info=mysqli_fetch_assoc($res_hospital_info);







$sql="SELECT * FROM `prescription_details_for_emr` WHERE `id`= '" .$_REQUEST['id']. "'";



$prescription_id=$_REQUEST['id']; 



$result=$conn->query($sql) ;



$row = $result->fetch_assoc();	



$ptflag=0;	



if(isset($_REQUEST['ptflag'])){



	$ptflag=$_REQUEST['ptflag'];



}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Prescription</title>
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
<link href="assets/global_prev/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<style>
body {
	color:#000 !important;
	line-height: 1.2;
}
.figure {
	background: none repeat scroll 0 0 #fff !important;
	clear: both;
	float: left;
	height: auto;
	margin: 0;
	padding: 0;
	position: relative;
	width: 100%;
}
.figure_mid {
	border:0px none !important;
}
pre {
	font-family:Arial, Helvetica, sans-serif !important;
	font-size:10px;
	font-weight:normal;
}
.notep {
	position: fixed;
	top: 0;
}
.hosp_h {
	font-size:15px !important;
	font-weight:bold !important;
}
.hosp_add {
	font-size:13px !important;
	font-weight:bold !important;
}
.hosp_cont {
	font-size:12px !important;
	font-weight:bold !important;
}
pre {
	font-size: 12px !important;
}
</style>
<style type="text/css" media="print">
@media print {
 @page :first {
 margin-top: 2px;
 margin-left: 5px;
 size: auto;   /* auto is the initial value */
/*margin-bottom: 35mm !important;*/

}
 @page {
 margin-top: 20px;
 margin-bottom: 20px;
 margin-left: -15px;
}
.notprnt {
	display:none;
}
}
</style>
<script>

function GoBackWithRefresh(event) {



    if ('referrer' in document) {

        window.location = document.referrer;

    } else {

        window.history.back();



    }



}

function close_window() {

  close();



}

</script>
</head>

<body style="font-family: Courier New, Courier, monospace !important;  font-size:9px; font-weight:normal;padding-left:35px !important;padding-top:2px !important;" >
<div id="invoice" style="height: 1080px;display: flex;  flex-direction: column;">
  <div id="invoice_print">
    <?php if($ptflag==0){?>
    <div class="notprnt" >
      <button class="print default" onclick="print_send_request();window.print();"  >Print</button>
      
      <!--<button class="cancel" onclick="GoBackWithRefresh();return false;">Cancel / Close</button>-->
      
      <button class="cancel" onclick="close_window();return false;">Cancel / Close</button>
    </div>
    <?php } ?>
    <?php 			$inside_doc = $row['signed_by_doctor'];



				 $sql_inside = "SELECT `users`.`id`,`user_infos`.`name`,`user_infos`.`regd_no`,`user_infos`.`designation`,`user_infos`.`designation_desc` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`id` = '$inside_doc'";

					$run_sql_inside = mysqli_query($conn,$sql_inside);

					$row_sql_inside = mysqli_fetch_assoc($run_sql_inside);







					 ?>
     <?php if($row['location_print']=='1') {  ?>
    <div style="padding-left:30px;font-size: 12px;padding-top:3px !important;padding-bottom:10px !important;">
      <div style="width:100%; height:auto; float:left; margin:30px 0 0 0; padding:0px 0 0px 0; ">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4" style="padding:0 !important"><table width="100%" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #333">
                <tr>
                  <td width="40%" style="background:#aa1328;border-right: 5px solid #aa1328;clip-path: polygon(0 0, 94% 0, 100% 100%, 0% 100%);">&nbsp;</td>
                  <td height="23" colspan="2" style="background:#104882; color:#fff;clip-path: polygon(0 0, 100% 0, 100% 100%, 5% 100%);">&nbsp;</td>
                </tr>
                <tr>
                  <td width="15%" style="text-align:center;padding-left:15px;border-left: 1px solid #333;"><img src="<?php echo ADMIN_URL.'upload/right_side_logo/'.$row_hospital_info['right_side_logo'];  ?>" weight="100" height="81" /></td>
                  <td width="40%" rowspan="6" style="vertical-align:top !important;border-right: 1px solid #333;padding-left:25px;"><table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="3" style="vertical-align:top !important"><h1 style="color:#104882; margin:0px; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic; font-weight:normal !important; font-size:16pt"><?php echo $row_sql_inside['name'] ;?></h1></td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:left;font-size:7.5pt;"><strong><?php echo $row_sql_inside['designation_desc'] ;?></strong></td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:left; color:#0c4988; font-size:10pt;"><strong><?php echo $row_sql_inside['designation'] ;?></strong></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div>
    </div>
    <?php }  ?>
    <div style="padding-left:30px;font-size: 12px;<?php if($row['location_print']=='0') { echo 'padding-top:170px;'; } ?>">
      <div style="width:100%; height:auto; float:left; margin:20px 0 0 0; padding:0px 0 0px 0; border-bottom:1px solid #000;">
        <table border="0" style="margin:0px; width:100%;" cellpadding="0" cellspacing="0">
          <tr style="margin:0px; width:100%;">
            <?php 



								$ref_by='';



								 $sql7="select * from `doctor_masters_for_emr` Where `id`='".$row['doctor_id']."' ";



								 $result7=$conn->query($sql7) ;



								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))



								 {		







									 $ref_by=$row7['doctor_name'];



								 }



								 if($ref_by==''){



									 $ref_by=$row['reffered_other_doc'];



									 }



								$prefix="";	







								 $sql_prefix="select * from `prefix_masters` Where `id`='".$row['prefix']."' ";







								 $result_prefix=$conn->query($sql_prefix) ;







								 while($row_prefix=mysqli_fetch_array($result_prefix,MYSQLI_ASSOC))







								 {	







									 $prefix=$row_prefix['prefix_name'];







								 }



								



								 $sql_gen="select * from `patient_registration_form` Where `uhid_no`='".$row['mrd_no']."' ";







								 $result_gen=$conn->query($sql_gen) ;







								 while($row_gen=mysqli_fetch_array($result_gen,MYSQLI_ASSOC))







								 {	







									 



									 if($row_gen['gender']=='2'){



									 	$gen=" / F";



									 }else{



										 $gen=" / M";



									 }







								 }



















					 			?>
            <td style="margin:0px; padding:6px; width:35%;"><b>UHID No.:</b> <?php echo $row['mrd_no']; ?></td>
            <td style="margin:0px; padding:6px; width:24%; vertical-align:top"><b>Age/Gender:</b>&nbsp;&nbsp;
              <?php if(!empty($row['age'])){ if($row['age']>='1') echo $row['age'].' years'; if($row['age']=='1') echo $row['age'].' year'; }?>
              <?php echo  $gen; ?></td>
            <td style="margin:0px; padding:6px; width:37%; vertical-align:top"><b>Date</b> – <?php echo date("d/m/Y", strtotime($row['created_on']));  ?></td>
          </tr>
          <tr style="margin:0px; width:100%;">
            <td style="margin:0px; padding:6px; width:35%;"><b>Name:</b>&nbsp;&nbsp;<?php echo $prefix; ?>&nbsp;<?php echo $row['fname']; ?>&nbsp;<?php echo $row['lname']; ?></td>
            <td style="margin:0px; padding:6px; width:24%;"><b>Contact No.:</b> <?php echo $row['mobile']; ?></td>
            <td style="margin:0px; padding:6px; width:37%;"><b>Referred by:</b>&nbsp;&nbsp;
              <?php if($ref_by!=''){ echo $ref_by; }  if($ref_by==''){echo "";}?>
              <?php if($ref_by!='' ) echo "<br />&nbsp;".'(Thank You For Your Trust & Confidence.)'; ?></td>
          </tr>
        </table>
      </div>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:0px 0 0px 0;">
        <table border="0" style="margin:0px; width:100%;" cellpadding="0" cellspacing="0">
          <?php if($row['chief_complaints_history']!=""){ ?>
          <tr style="margin:0px;">
            <td style="margin:0px; padding:0px; padding: 6px; width:30%;"><b>Chief Complaints/History -</b></td>
            <td style="margin:0px; padding:0px; padding: 6px; width:70%;"><?php echo $row['chief_complaints_history']; ?></td>
          </tr>
          <?php }  ?>
          <?php if($row['history_of_present_illness']!=""){ ?>
          <tr style="margin:0px;">
            <td style="margin:0px; padding:0px; padding: 6px; width:30%;"><b>History of Present Illness -</b></td>
            <td style="margin:0px; padding:0px; padding: 6px; width:70%;"><?php echo $row['history_of_present_illness']; ?></td>
          </tr>
          <?php }  ?>
          <?php if($row['current_treatment']!=""){ ?>
          <tr style="margin:0px;">
            <td style="margin:0px; padding:0px; padding: 6px; width:30%;"><b>Current Treatment -</b></td>
            <td style="margin:0px; padding:0px; padding: 6px; width:70%;"><?php echo $row['current_treatment']; ?></td>
          </tr>
          <?php }  ?>
          <?php if($row['general_health']!=""){ ?>
          <tr style="margin:0px;">
            <td style="margin:0px; padding:0px; padding: 6px; width:30%;"><b>General Health –</b></td>
            <td style="margin:0px; padding:0px; padding: 6px; width:70%;"><?php echo $row['general_health']; ?></td>
          </tr>
          <?php }  ?>
          <?php if($row['family_history']!=""){ ?>
          <tr style="margin:0px;">
            <td style="margin:0px; padding:0px; padding: 6px; width:30%;"><b>Family History –</b></td>
            <td style="margin:0px; padding:0px; padding: 6px; width:70%;"><?php echo $row['family_history']; ?></td>
          </tr>
          <?php }  ?>
          <?php if($row['allergy_history']!=""){ ?>
          <tr style="margin:0px;">
            <td style="margin:0px; padding:0px; padding: 6px; width:30%;"><b>Allergy History –</b></td>
            <td style="margin:0px; padding:0px; padding: 6px; width:70%;"><?php echo $row['allergy_history']; ?></td>
          </tr>
          <?php }  ?>
          <?php if($row['past_ocular_history']!=""){ ?>
          <tr style="margin:0px;">
            <td style="margin:0px; padding:0px; padding: 6px; width:30%;"><b>Past Ocular History –</b></td>
            <td style="margin:0px; padding:0px; padding: 6px; width:70%;"><?php echo $row['past_ocular_history']; ?></td>
          </tr>
          <?php }  ?>
        </table>
      </div>
      <?php if($row['pgp_block']==1){ ?>
      
      <!-- PGP  -->
      
      <div style="width:80%; height:auto; float:left; margin:0px 0 0 0; padding:4px 0 10px 0;">
        <table border="0" style="margin:0px 0 10px 0; width:100%;" cellpadding="0" cellspacing="0">
          <tr>
            <td width="30%" style="padding:0 6px 0 6px; margin:0px;"><b>PGP :</b></td>
            <td width="70%" style="padding:0 6px 0 6px; margin:0px;"><?php echo $row['pgp']; ?></td>
          </tr>
        </table>
        <table border="0" style="width:40%; border:1px solid #000; float:left; margin:0 1% 0 0;" cellpadding="2" cellspacing="0">
          <tr>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;">&nbsp;</td>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><b>Sph</b></td>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><b>Cyl</b></td>
            <td style="width:25%; border-width:0 0 1px 0; border-color:#000; border-style:solid;"><b>Axis</b></td>
          </tr>
          <tr>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><b>OD</b></td>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><?php echo $row['sph_od']; ?>&nbsp;</td>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><?php echo $row['cly_od']; ?>&nbsp;</td>
            <td style="width:25%; border-width:0 0 1px 0; border-color:#000; border-style:solid;"><?php echo $row['axis_od']; ?>&nbsp;</td>
          </tr>
          <tr>
            <td style="width:25%; border-width:0 1px 0px 0; border-color:#000; border-style:solid;"><b>ADD</b></td>
            <td style="width:25%; border-width:0 1px 0px 0; border-color:#000; border-style:solid;"><?php echo $row['sph_add']; ?>&nbsp;</td>
            <td style="width:25%; border-width:0 1px 0px 0; border-color:#000; border-style:solid;">&nbsp;</td>
            <td style="width:25%; border-width:0 0 0px 0; border-color:#000; border-style:solid;">&nbsp;</td>
          </tr>
        </table>
        <table border="0" style="width:40%; border:1px solid #000; float:left; margin:0 1% 0 0;" cellpadding="2" cellspacing="0">
          <tr>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;">&nbsp;</td>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><b>Sph</b></td>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><b>Cyl</b></td>
            <td style="width:25%; border-width:0 0 1px 0; border-color:#000; border-style:solid;"><b>Axis</b></td>
          </tr>
          <tr>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><b>OS</b></td>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><?php echo $row['sph_os']; ?>&nbsp;</td>
            <td style="width:25%; border-width:0 1px 1px 0; border-color:#000; border-style:solid;"><?php echo $row['cyl_os']; ?>&nbsp;</td>
            <td style="width:25%; border-width:0 0 1px 0; border-color:#000; border-style:solid;"><?php echo $row['axis_os']; ?>&nbsp;</td>
          </tr>
          <tr>
            <td style="width:25%; border-width:0 1px 0px 0; border-color:#000; border-style:solid;"><b>ADD</b></td>
            <td style="width:25%; border-width:0 1px 0px 0; border-color:#000; border-style:solid;"><?php  echo $row['add_os'];  ?>
              &nbsp;</td>
            <td style="width:25%; border-width:0 1px 0px 0; border-color:#000; border-style:solid;">&nbsp;</td>
            <td style="width:25%; border-width:0 0 0px 0; border-color:#000; border-style:solid;">&nbsp;</td>
          </tr>
        </table>
      </div>
      
      <!--  End PGP  -->
      
      <?php } ?>
      
      <!-- Glass Prescription -->
      
      <?php if($row['glass_block']==1){ ?>
      <div style="width:100%; height:auto; float:left; margin:10px 0 0 0; padding:0px 0 10px 0;">
        <h3 style="text-align:left; margin:0px;">Glass Prescription</h3>
        <table style="width:100%; margin:0px; padding:0px;" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%"><table width="98%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                  <tr>
                    <td align="center" height="25" colspan="5">Right</td>
                  </tr>
                  <tr>
                    <td width="5%" align="center" rowspan="2">D<br>
                      V</td>
                    <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">SPH.</td>
                    <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">CYL.</td>
                    <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">AXIS.</td>
                    <td width="23%" align="center" height="20" style="border:1px solid #000">V/A.</td>
                  </tr>
                  <tr>
                    <td width="23%" align="center" height="30" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_sph_r']; ?></td>
                    <td width="23%" align="center" height="" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_cyl_r']; ?></td>
                    <td width="23%" align="center" height="" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_axis_r']; ?><sup>o</sup></td>
                    <td width="23%" align="center" height="" style="border:1px solid #000; border-top:none;"><?php echo $row['distance_va_r']; ?></td>
                  </tr>
                </tbody>
              </table></td>
            <td><table width="98%" cellspacing="0" cellpadding="0" border="0" align="right">
                <tbody>
                  <tr>
                    <td align="center" height="25" colspan="5">Left</td>
                  </tr>
                  <tr>
                    <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">SPH.</td>
                    <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">CYL.</td>
                    <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">AXIS.</td>
                    <td width="23%" align="center" height="20" style="border:1px solid #000">V/A.</td>
                    <td width="5%" align="center" rowspan="2">D<br>
                      V</td>
                  </tr>
                  <tr>
                    <td width="23%" align="center" height="30" style="border:1px solid #000; border-right:none; border-top:none; "><?php echo $row['distance_sph_l']; ?></td>
                    <td width="23%" align="center" height="" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_cyl_l']; ?></td>
                    <td width="23%" align="center" height="" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_axis_l']; ?><sup>o</sup></td>
                    <td width="23%" align="center" height="" style="border:1px solid #000; border-top:none;"><?php echo $row['distance_va_l']; ?></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
          <tr>
            <td width="50%"><table style="width:98%; margin:10px 0 0 0;" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                  <tr>
                    <td width="5%" align="center" height="30">N<br>
                      V <br />
                      Add</td>
                    <td width="23%" align="center" style="border:1px solid #000; border-right:none;"><?php if($row['near_sph_r']!='') { ?>
                      <?php $re2=$row['near_sph_r']; if($re2>0) { echo "+".number_format($re2, 2);} else { echo number_format($re2, 2); } } ?>
                      &nbsp;</td>
                    <td width="23%" align="center" style="border:1px solid #000; border-right:none;"></td>
                    <td width="23%" align="center" style="border:1px solid #000; border-right:none;"></td>
                    <td width="23%" align="center" style="border:1px solid #000;"><?php echo $row['near_va_r']; ?></td>
                  </tr>
                </tbody>
              </table></td>
            <td><table style="width:98%; margin:10px 0 0 0;" cellspacing="0" cellpadding="0" border="0" align="right">
                <tbody>
                  <tr>
                    <td width="23%" align="center" height="30" style="border:1px solid #000; border-right:none;"><?php if($row['near_sph_l']!='') { ?>
                      <?php $re2=$row['near_sph_l']; if($re2>0) { echo "+".number_format($re2, 2);} else { echo number_format($re2, 2); } } ?>
                      &nbsp;</td>
                    <td width="23%" align="center" style="border:1px solid #000; border-right:none;"></td>
                    <td width="23%" align="center" style="border:1px solid #000; border-right:none;"></td>
                    <td width="23%" align="center" style="border:1px solid #000;"><?php echo $row['near_va_l']; ?></td>
                    <td width="5%" align="center">N<br>
                      V <br />
                      Add</td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
          <table style="width:44%; margin:10px 0 0 0;margin-left:32px;" cellspacing="0" cellpadding="0" border="0" align="left">
            <tr>
              <td width="23%" align="center" style="border:1px solid #000;"><?php echo $row['add_re_eye']; ?></td>
            </tr>
          </table>
          <table style="width:44%; margin:10px 0 0 0;margin-right:32px;" cellspacing="0" cellpadding="0" border="0" align="right">
            <tr>
              <td width="23%" align="center" style="border:1px solid #000;"><?php echo $row['add_le_eye']; ?></td>
            </tr>
          </table>
        </table>
      </div>
      
      <!-- Constant Use -->
      
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:0px 0 10px 0;">
        <h3 style="text-align:left; margin:0px;"></h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:10px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><?php echo $row['glass_prescription']; ?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php















$ocflag=0;















if($row['flash_od']!="" or $row['flash_os']!=""){ 















$ocflag=1;















}















?>
      <?php 















if($ocflag==1){















?>
      <?php if($row['ocular_block']==1){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px0 0 0; padding:0px 0 10px 0;">
        <h3>Ocular Examination</h3>
        <?php if($row['dv_glasses']!="" or $row['nv_od']!="" or $row['nv_os']!="" or $row['pinhole_od']!="" or $row['pinhole_os']!=""){ ?>
        <table border="0" style="margin:0px 0 10px 0; width:100%; border:1px solid #000" cellpadding="1" cellspacing="0">
          <tr>
            <td style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">&nbsp;</td>
            <td style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><strong>RIGHT</strong></td>
            <td style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><strong>LEFT</strong></td>
          </tr>
          <?php if($row['dv_glasses']!="" or $row['dv_glasses_left']!="" or $row['nv_od']!="" or $row['nv_os']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Vision <?php echo $row['dv_glasses']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['dv_od']; ?>&nbsp;&nbsp;<?php echo $row['nv_od']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['dv_os']; ?>&nbsp;&nbsp;<?php echo $row['nv_os']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['pinhole_od']!="" or $row['pinhole_os']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Pinhole</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['pinhole_od']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['pinhole_os']; ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      <?php } ?>
      <?php if($row['flash_od']!="" or $row['flash_os']!=""){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px0 0 0; padding:0px 0 10px 0;">
        <table border="0" style="margin:0px 0 10px 0; width:100%; border:1px solid #000" cellpadding="1" cellspacing="0">
          <tr>
            <td colspan="8" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><b>Flash (Not Glass Prescription)</b></td>
          </tr>
          <tr>
            <td width="12.5%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><b>&nbsp;</b></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><b>Sph</b></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><b>Cyl</b></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><b>Axis</b></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><b>&nbsp;</b></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><b>Sph</b></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><b>Cyl</b></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><b>Axis</b></td>
          </tr>
          <tr>
            <td width="12.5%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><b>OD</b></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['flash_od']; ?></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['flash_cly_od']; ?></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['flash_axis_od']; ?></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><b>OS</b></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['flash_os']; ?></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['flash_cyl_os']; ?></td>
            <td width="12.5%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['flash_axis_os']; ?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if($row['ocular_block']==1){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px0 0 0; padding:0px 0 10px 0;">
        <table border="0" style="margin:0px 0 10px 0; width:100%; border:1px solid #000" cellpadding="1" cellspacing="0">
          <tr>
            <td style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">&nbsp;</td>
            <td style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><strong>RIGHT</strong></td>
            <td style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><strong>LEFT</strong></td>
          </tr>
          <?php if($row['mb_ocular_checkbox_check']==1){ ?>
          <?php if($row['mb_ocular']!="" or $row['mb_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">MB</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['mb_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['mb_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['eom_checkbox_check']==1){ ?>
          <?php if($row['EOM']!="" or $row['EOM_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">EOM</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['EOM']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['EOM_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['lid_checkbox_check']==1){ ?>
          <?php if($row['lid_adnexa']!="" or $row['lid_adnexa_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Lid Adnexa</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['lid_adnexa']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['lid_adnexa_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['tears_outflow_system']!="" or $row['tears_outflow_system_right']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Tears Outflow System</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['tears_outflow_system']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['tears_outflow_system_right']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['conjunctiva_checkbox_check']==1){ ?>
          <?php if($row['conjunctiva']!="" or $row['conjunctiva_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Conjunctiva</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['conjunctiva']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['conjunctiva_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['cornea_ocular_checkbox_check']==1){ ?>
          <?php if($row['cornea_ocular']!="" or $row['cornea_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Cornea</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['cornea_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['cornea_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['pupils_checkbox_check']==1){ ?>
          <?php if($row['pupils']!="" or $row['pupils_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Pupils</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['pupils']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['pupils_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['iris_ocular_checkbox_check']==1){ ?>
          <?php if($row['iris_ocular']!="" or $row['iris_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Iris</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['iris_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['iris_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['ac_ocular_checkbox_check']==1){ ?>
          <?php if($row['ac_ocular']!="" or $row['ac_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">AC</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['ac_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['ac_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['lens_ocular_checkbox_check']==1){ ?>
          <?php if($row['lens_ocular']!="" or $row['lens_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Lens</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['lens_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['lens_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['vitreous_ocular_checkbox_check']==1){ ?>
          <?php if($row['vitreous_ocular']!="" or $row['vitreous_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Vitreous</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['vitreous_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['vitreous_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['retina_ocular_checkbox_check']==1){ ?>
          <?php if($row['retina_ocular']!="" or $row['retina_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Retina</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['retina_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['retina_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['onh_ocular_checkbox_check']==1){ ?>
          <?php if($row['onh_ocular']!="" or $row['onh_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">ONH</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['onh_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['onh_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['anterior_segment']!="" or $row['anterior_left_segment']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Anterior Segment</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['anterior_segment']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['anterior_left_segment']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['anterior_figure']==1){ ?>
          <tr> 
            
            <!--<td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">&nbsp;</td>-->
            
            <?php 































 $sql2="SELECT * FROM `fundus_figure_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' AND `anterior`=1";































 $result2=$conn->query($sql2) ;































 $count=$result2->num_rows; 































 if($count>0){































         while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))































 {                            















 ?>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000; text-align:center;" colspan="3"><img border="0" alt="" src="<?php echo ADMIN_URL; ?>wPaint-master/test/uploads/<?php echo $row2['filename'];?>" class="add_pro" id="add_pro" style="width: 420px;  "></td>
            <?php } }?>
          </tr>
          <?php } ?>
          <?php if($row['goneoscopy']!="" or $row['goneoscopy_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Gonioscopy</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['goneoscopy']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['goneoscopy_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['fundus']!="" or $row['fundus_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Fundus</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['fundus']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['fundus_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['fundus_figure']==1){ ?>
          <tr> 
            
            <!--<td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">&nbsp;</td>-->
            
            <?php 































 $sql2="SELECT * FROM `fundus_figure_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' AND `fundus`=1";































 $result2=$conn->query($sql2) ;































 $count=$result2->num_rows; 































 if($count>0){































         while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))































 {                            















 ?>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000; text-align:center;" colspan="3"><img border="0" alt="" src="<?php echo ADMIN_URL; ?>wPaint-master/test/uploads/<?php echo $row2['filename'];?>" class="add_pro" id="add_pro" style="width: 420px;   "></td>
            <?php } }?>
          </tr>
          <?php } ?>
          
          <?php if($row['iridotomy_left']!="" or $row['iridotomy_right']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Iridotomy</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['iridotomy_left']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['iridotomy_right']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['rk1']!="" or $row['lk2']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Keratometry</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;">K1:&nbsp;&nbsp;<?php echo $row['rk1']; ?>&nbsp;&nbsp;k2:&nbsp;&nbsp;<?php echo $row['rk2']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">K1:&nbsp;&nbsp;<?php echo $row['lk1']; ?>&nbsp;&nbsp;k2:&nbsp;&nbsp;<?php echo $row['lk2']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['roplas_right']!="" or $row['roplas_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Roplas</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['roplas_right']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['roplas_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['pachymetery']!="" or $row['pachymetery_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Pachymetery</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['pachymetery']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['pachymetery_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['axial_length']!="" or $row['axial_length_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Axial Length</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['axial_length']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['axial_length_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['scotopic_pupil']!="" or $row['scotopic_pupil_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Scotopic Pupil Diameter</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['scotopic_pupil']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['scotopic_pupil_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['ww_diameter']!="" or $row['ww_diameter_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">W-W Piameter</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['ww_diameter']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['ww_diameter_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['anterior_chamber']!="" or $row['anterior_chamber_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Anterior Chamber Depth</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['anterior_chamber']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['anterior_chamber_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['iol_power']!="" or $row['iol_power_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">IOL Power </td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['iol_power']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['iol_power_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['schirmers_test']!="" or $row['schirmers_test_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Schirmer's Test (Type II)</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['schirmers_test']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['schirmers_test_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['visual_fields']!="" or $row['visual_fields_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Visual Fields</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['visual_fields']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['visual_fields_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['optical_coherence']!="" or $row['optical_coherence_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Optical Coherence Tomography ( RNFL)</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['optical_coherence']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['optical_coherence_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['oct_macula']!="" or $row['oct_macula_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">OCT MACULA</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['oct_macula']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['oct_macula_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['color_vision_isihara']!="" or $row['color_vision_isihara_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Colour Vision (Isihara Chart)</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['color_vision_isihara']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['color_vision_isihara_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['misc_findings']!="" or $row['misc_findings_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Miscellaneous</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['misc_findings']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['misc_findings_left']; ?></td>
          </tr>
          <?php } ?>
          <?php

 $sql2="SELECT * FROM `miscellaneous_eye_test_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' AND  `del_flag`='0' ORDER BY `id` ASC";

 $result2=$conn->query($sql2) ;

 $count=$result2->num_rows; 

 if($count>0){

 while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))

 {

	 $sql_misc="SELECT `misc_eye_test_name` FROM `miscellaneous_eye_test_masters_for_emr` Where `id`='".$row2['misc_eye_test_select']."'";

	 $pres_misc=$conn->query($sql_misc) ;	

	 $pres_misc_fetch = $pres_misc->fetch_assoc();

?>
          <tr>
            <td width="20%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><b><?php echo $pres_misc_fetch['misc_eye_test_name']; ?></b></td>
            <td width="40%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><?php echo $row2['misc_eye_test_od']; ?></td>
            <td width="40%" style="border-width:0 0 1px 0; border-style:solid; boder-color:#000;"><?php echo $row2['misc_eye_test_os']; ?></td>
          </tr>
          <?php }} ?>
        </table>
        <?php } ?>
        <?php

 $sql2="SELECT * FROM `at_details_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' AND  `del_flag`='0' ORDER BY `id` ASC";

 $result2=$conn->query($sql2) ;

 $count=$result2->num_rows; 

 if($count>0){

 while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))

 {

?>
        <tr>
          <td width="20%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><b><?php echo $row2['at_select']; ?></b>&nbsp;(at <?php echo date('h:i A',strtotime($row2['at_time'])); ?>)</td>
          <td width="40%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><?php if(strtoupper($row2['at_select'])=='AT'){ echo $row2['at_od'].' mmHg'; } else { echo $row2['at_od'].' mmHg'; } ?></td>
          <td width="40%" style="border-width:0 0 1px 0; border-style:solid; boder-color:#000;"><?php if(strtoupper($row2['at_select'])=='AT'){ echo $row2['at_os'].' mmHg'; } else { echo $row2['at_os'].' mmHg'; } ?></td>
        </tr>
        <?php }} ?>
        <?php if($row['cover_test_select']!="" and $row['cover_test_text']!=""){ ?>
        <table border="0" style="margin:0px 0 10px 0; width:100%;" cellpadding="1" cellspacing="0">
          <tr>
            <td width="20%"><?php echo $row['cover_test_select']; ?>&nbsp;:</td>
            <td width="80%"><?php echo $row['cover_test_text']; ?></td>
          </tr>
        </table>
        <?php } ?>
      </div>
      <?php } ?>
      <?php 















}else{















?>
      <?php if($row['ocular_block']==1){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px0 0 0; padding:0px 0 10px 0;">
        <h3>Ocular Examination</h3>
        <table border="0" style="margin:0px 0 10px 0; width:100%; border:1px solid #000" cellpadding="1" cellspacing="0">
          <tr>
            <td style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">&nbsp;</td>
            <td style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><strong>RIGHT</strong></td>
            <td style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><strong>LEFT</strong></td>
          </tr>
          <?php if($row['dv_glasses']!="" or $row['dv_glasses_left']!="" or $row['nv_od']!="" or $row['nv_os']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Vision <?php echo $row['dv_glasses']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['dv_od']; ?>&nbsp;&nbsp;<?php echo $row['nv_od']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['dv_os']; ?>&nbsp;&nbsp;<?php echo $row['nv_os']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['pr_left']!="" or $row['pr_right']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">PR</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['pr_right']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['pr_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['pinhole_od']!="" or $row['pinhole_os']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Pinhole</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['pinhole_od']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['pinhole_os']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['mb_ocular_checkbox_check']==1){ ?>
          <?php if($row['mb_ocular']!="" or $row['mb_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">MB</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['mb_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['mb_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['eom_checkbox_check']==1){ ?>
          <?php if($row['EOM']!="" or $row['EOM_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">EOM</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['EOM']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['EOM_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['lid_checkbox_check']==1){ ?>
          <?php if($row['lid_adnexa']!="" or $row['lid_adnexa_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Lid Adnexa</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['lid_adnexa']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['lid_adnexa_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['tears_outflow_system']!="" or $row['tears_outflow_system_right']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Tears Outflow System</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['tears_outflow_system']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['tears_outflow_system_right']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['conjunctiva_checkbox_check']==1){ ?>
          <?php if($row['conjunctiva']!="" or $row['conjunctiva_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Conjunctiva</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['conjunctiva']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['conjunctiva_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['cornea_ocular_checkbox_check']==1){ ?>
          <?php if($row['cornea_ocular']!="" or $row['cornea_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Cornea</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['cornea_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['cornea_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['pupils_checkbox_check']==1){ ?>
          <?php if($row['pupils']!="" or $row['pupils_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Pupils</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['pupils']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['pupils_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['iris_ocular_checkbox_check']==1){ ?>
          <?php if($row['iris_ocular']!="" or $row['iris_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Iris</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['iris_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['iris_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['ac_ocular_checkbox_check']==1){ ?>
          <?php if($row['ac_ocular']!="" or $row['ac_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">AC</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['ac_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['ac_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['lens_ocular_checkbox_check']==1){ ?>
          <?php if($row['lens_ocular']!="" or $row['lens_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Lens</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['lens_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['lens_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['vitreous_ocular_checkbox_check']==1){ ?>
          <?php if($row['vitreous_ocular']!="" or $row['vitreous_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Vitreous</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['vitreous_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['vitreous_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['retina_ocular_checkbox_check']==1){ ?>
          <?php if($row['retina_ocular']!="" or $row['retina_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Retina</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['retina_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['retina_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['onh_ocular_checkbox_check']==1){ ?>
          <?php if($row['onh_ocular']!="" or $row['onh_ocular_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">ONH</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['onh_ocular']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['onh_ocular_left']; ?></td>
          </tr>
          <?php }} ?>
          <?php if($row['anterior_segment']!="" or $row['anterior_left_segment']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Anterior Segment</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['anterior_segment']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['anterior_left_segment']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['anterior_figure']==1){ ?>
          <tr> 
            
            <!--<td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">&nbsp;</td>-->
            
            <?php 































 $sql2="SELECT * FROM `fundus_figure_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' AND `anterior`=1";































 $result2=$conn->query($sql2) ;































 $count=$result2->num_rows; 































 if($count>0){































         while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))































 {                            















 ?>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000; text-align:center;" colspan="3"><img border="0" alt="" src="<?php echo ADMIN_URL; ?>wPaint-master/test/uploads/<?php echo $row2['filename'];?>" class="add_pro" id="add_pro" style="width: 420px;  "></td>
            <?php } }?>
          </tr>
          <?php } ?>
          <?php if($row['goneoscopy']!="" or $row['goneoscopy_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Gonioscopy</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['goneoscopy']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['goneoscopy_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['fundus']!="" or $row['fundus_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Fundus</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['fundus']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['fundus_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['fundus_figure']==1){ ?>
          <tr> 
            
            <!--<td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">&nbsp;</td>-->
            
            <?php 































 $sql2="SELECT * FROM `fundus_figure_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' AND `fundus`=1";































 $result2=$conn->query($sql2) ;































 $count=$result2->num_rows; 































 if($count>0){































         while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))































 {                            















 ?>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000; text-align:center;" colspan="3"><img border="0" alt="" src="<?php echo ADMIN_URL; ?>wPaint-master/test/uploads/<?php echo $row2['filename'];?>" class="add_pro" id="add_pro" style="width: 420px;  "></td>
            <?php } }?>
          </tr>
          <?php } ?>
          <?php if($row['iridotomy_left']!="" or $row['iridotomy_right']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Iridotomy</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['iridotomy_left']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['iridotomy_right']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['rk1']!="" or $row['lk2']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Keratometry</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;">K1:&nbsp;&nbsp;<?php echo $row['rk1']; ?>&nbsp;&nbsp;k2:&nbsp;&nbsp;<?php echo $row['rk2']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">K1:&nbsp;&nbsp;<?php echo $row['lk1']; ?>&nbsp;&nbsp;k2:&nbsp;&nbsp;<?php echo $row['lk2']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['roplas_right']!="" or $row['roplas_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Roplas</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['roplas_right']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['roplas_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['pachymetery']!="" or $row['pachymetery_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Pachymetery</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['pachymetery']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['pachymetery_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['axial_length']!="" or $row['axial_length_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Axial Length</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['axial_length']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['axial_length_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['scotopic_pupil']!="" or $row['scotopic_pupil_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Scotopic Pupil Diameter</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['scotopic_pupil']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['scotopic_pupil_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['ww_diameter']!="" or $row['ww_diameter_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">W-W Piameter</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['ww_diameter']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['ww_diameter_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['anterior_chamber']!="" or $row['anterior_chamber_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Anterior Chamber Depth</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['anterior_chamber']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['anterior_chamber_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['iol_power']!="" or $row['iol_power_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">IOL Power </td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['iol_power']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['iol_power_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['schirmers_test']!="" or $row['schirmers_test_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Schirmer's Test (Type II)</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['schirmers_test']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['schirmers_test_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['visual_fields']!="" or $row['visual_fields_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Visual Fields</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['visual_fields']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['visual_fields_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['optical_coherence']!="" or $row['optical_coherence_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Optical Coherence Tomography ( RNFL)</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['optical_coherence']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['optical_coherence_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['oct_macula']!="" or $row['oct_macula_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">OCT MACULA</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['oct_macula']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['oct_macula_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['color_vision_isihara']!="" or $row['color_vision_isihara_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Colour Vision (Isihara Chart)</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['color_vision_isihara']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['color_vision_isihara_left']; ?></td>
          </tr>
          <?php } ?>
          <?php if($row['misc_findings']!="" or $row['misc_findings_left']!=""){ ?>
          <tr>
            <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Miscellaneous</td>
            <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['misc_findings']; ?></td>
            <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['misc_findings_left']; ?></td>
          </tr>
          <?php } ?>
          <?php

 $sql2="SELECT * FROM `miscellaneous_eye_test_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' AND  `del_flag`='0' ORDER BY `id` ASC";

 $result2=$conn->query($sql2) ;

 $count=$result2->num_rows; 

 if($count>0){

 while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))

 {

	 $sql_misc="SELECT `misc_eye_test_name` FROM `miscellaneous_eye_test_masters_for_emr` Where `id`='".$row2['misc_eye_test_select']."'";

	 $pres_misc=$conn->query($sql_misc) ;	

	 $pres_misc_fetch = $pres_misc->fetch_assoc();

?>
          <tr>
            <td width="20%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><b><?php echo $pres_misc_fetch['misc_eye_test_name']; ?></b></td>
            <td width="40%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><?php echo $row2['misc_eye_test_od']; ?></td>
            <td width="40%" style="border-width:0 0 1px 0; border-style:solid; boder-color:#000;"><?php echo $row2['misc_eye_test_os']; ?></td>
          </tr>
          <?php }} ?>
          <?php

 $sql2="SELECT * FROM `at_details_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' AND  `del_flag`='0' ORDER BY `id` ASC";

 $result2=$conn->query($sql2) ;

 $count=$result2->num_rows; 

 if($count>0){

 while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))

 {

?>
          <tr>
            <td width="20%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><b><?php echo $row2['at_select']; ?></b>&nbsp;(at <?php echo date('h:i A',strtotime($row2['at_time'])); ?>)</td>
            <td width="40%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><?php if(strtoupper($row2['at_select'])=='AT'){ echo $row2['at_od'].' mmHg'; } else { echo $row2['at_od'].' mmHg'; } ?></td>
            <td width="40%" style="border-width:0 0 1px 0; border-style:solid; boder-color:#000;"><?php if(strtoupper($row2['at_select'])=='AT'){ echo $row2['at_os'].' mmHg'; } else { echo $row2['at_os'].' mmHg'; } ?></td>
          </tr>
          <?php }} ?>
        </table>
        <?php if($row['cover_test_select']!="" and $row['cover_test_text']!=""){ ?>
        <table border="0" style="margin:0px 0 10px 0; width:100%;" cellpadding="1" cellspacing="0">
          <tr>
            <td width="20%"><?php echo $row['cover_test_select']; ?>&nbsp;:</td>
            <td width="80%"><?php echo $row['cover_test_text']; ?></td>
          </tr>
        </table>
        <?php } ?>
      </div>
      <?php } ?>
      <?php 















}















?>
      <?php if(($row['medication_block']==1)||($row['medication']!='')){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">Medication</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <?php if($row['table_structure_block']==1){ ?>
          <tr>
            <td width="12.5%" style="border-style:solid; border-width: 1px; border-color:#000;"><b>EYE</b></td>
            <td width="18.5%" style="border-style:solid; border-width:1px; border-color:#000;"><b>DRUG</b></td>
            <td width="12.5%" style="border-style:solid; border-width: 1px; border-color:#000;"><b>DOSAGE</b></td>
            <td width="12.5%" style="border-style:solid; border-width:1px; border-color:#000;"><b>TIME </b></td>
            <td width="12.5%" style="border-style:solid; border-width: 1px; border-color:#000;"><b>No.</b></td>
            <td width="12.5%" style="border-style:solid; border-width: 1px; border-color:#000;"><b>DURATION</b></td>
            <td width="19%" style="border-style:solid; border-width: 1px; border-color:#000;"><b>REMARK</b></td>
          </tr>
          <?php $var = $row['medication'];















					$var_arr = preg_split ("/\#/", $var);















					$asz= sizeof($var_arr);















					















					for($m=0;$m<$asz-1; $m++){















						















						//echo $p.'. '.$var_arr[$m].'<br/>';















						















						?>
          <tr>
            <?php $var2 = $var_arr[$m];















					$var_arr2 = preg_split ("/\^/", $var2);















					$asz2= sizeof($var_arr2);















					















					for($n=0;$n<$asz2-1; $n++){















						















						















						















						?>
            <td width="12.5%" style="border-style:solid; border-width:1px ; border-color:#000;"><?php echo $var_arr2[$n]; ?></td>
            <?php















					}















						?>
          </tr>
          <?php















					}















						?>
          <?php } else{ ?>
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><!--<pre><?php echo $row['medication']; ?></pre>-->
              
              <?php /*$k=1; foreach(split("\r\n",$row['medication']) as $gi) if($gi!=''){ echo ($k).". $gi<br>"; $k++; } */?>
              <?php $var = $row['medication'];















					$var_arr = preg_split ("/\\n/", $var);















					$asz= sizeof($var_arr);















					$p=1;















					for($m=0;$m<$asz; $m++){















						















						//echo $p.'. '.$var_arr[$m].'<br/>';















						echo $var_arr[$m].'<br/>';















						$p++;















					}















						?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      <?php } ?>
      <?php if($row['surgery_block']==1){ ?>
      <?php if($row['surgery']!=""){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">Surgery</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['surgery']; ?></pre>
              <?php /*echo nl2br($row['surgery']);*/ ?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if($row['explained_surgery_textarea']!=""){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">Explained About</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['explained_surgery_textarea']; ?></pre>
              <?php /*echo nl2br($row['surgery']);*/ ?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php } ?>
      <?php if($row['pre_operative_block'] == 1){ ?>
      <?php if($row['pre_operative'] != ""){ ?>
      <div style="width:50%; height:auto; float:left; margin:0px 0 15px 0px; padding:0px 0 10px 0;">
        <h3 style="text-align:left; margin:0px;">Pre Operative</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['pre_operative']; ?></pre></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php } ?>
      <?php if($row['investigation']!=""){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">Investigation</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0; "><pre><?php echo $row['investigation']; ?></pre>
              <?php /* $k=1; foreach(split("\r\n",$row['investigation']) as $gi) if($gi!=''){ echo ($k).". $gi<br>"; $k++; } */?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if($row['diagnostic']!=''){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">Diagnosis</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['diagnostic']; ?></pre>
              <?php /* echo nl2br($row['diagnostic']); */?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if($row['general_instructions']!=''){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">General Instructions / Action Plan</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><!--<pre><?php echo $row['general_instructions']; ?></pre>-->
              
              <?php /*$k=1; foreach(split("\r\n",$row['general_instructions']) as $gi) if($gi!=''){ echo ($k).". $gi<br>"; $k++; }*/ ?>
              <?php $var = $row['general_instructions'];















					$var_arr = preg_split ("/\\n/", $var);















					$asz= sizeof($var_arr);















					$p=1;















					for($m=0;$m<$asz; $m++){















						















						echo $var_arr[$m].'<br/>';















						$p++;















					}















						?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if($row['certificate']!=''){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">Certificate</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><!--<pre><?php echo $row['general_instructions']; ?></pre>-->
              
              <?php /*$k=1; foreach(split("\r\n",$row['general_instructions']) as $gi) if($gi!=''){ echo ($k).". $gi<br>"; $k++; }*/ ?>
              <?php $var = $row['certificate'];















					$var_arr = preg_split ("/\\n/", $var);















					$asz= sizeof($var_arr);















					$p=1;















					for($m=0;$m<$asz; $m++){















						















						echo $var_arr[$m].'<br/>';















						$p++;















					}















						?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if($row['procedure_block']=='1'){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">Procedure</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['procedure_comments']; ?></pre>
              <?php /* $k=1; foreach(split("\r\n",$row['procedure_comments']) as $gi) if($gi!=''){ echo ($k).". $gi<br>"; $k++; } */ ?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if($row['ot_notes_block']=='1'){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">Surgical Procedure</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['ot_notes']; ?></pre>
              <?php /* $k=1; foreach(split("\r\n",$row['procedure_comments']) as $gi) if($gi!=''){ echo ($k).". $gi<br>"; $k++; } */ ?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if($row['nextvisit_block']==1){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0px 0; padding:0px 0 10px 0;">
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:10px 0 0 0; padding:0px;">
          <tr>
            <td width="5%" style="width:10%; border-width:0 0 0 0">Review –</td>
            <td width="95%" style="width:90%; border-width:0 0 0 0"><?php if($row['next_visit_day'] != '0') echo "After ".$row['next_visit_day']." day(s)"; ?>
              <?php if($row['next_visit_week'] != '0') echo "After ".$row['next_visit_week']." week(s)"; ?>
              <?php if($row['next_visit_month'] != '0') echo "After ".$row['next_visit_month']." month(s)"; ?>
              <?php if($row['next_visit_year'] != '0') echo "After ".$row['next_visit_year']." year(s)"; ?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if($row['remarks_pres']!=''){ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:2px 0 1px 0;">
        <h3 style="text-align:left; margin:0px;">Remarks</h3>
        <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:0px 0 0 0; padding:0px;">
          <tr>
            <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['remarks_pres']; ?></pre>
              <?php /* echo nl2br($row['diagnostic']); */?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <div style="width:100%;  float:left; "><br/>
      </div>
      <?php 			$inside_doc = $row['signed_by_doctor'];



				 $sql_inside = "SELECT `users`.`id`,`user_infos`.`name`,`user_infos`.`regd_no`,`user_infos`.`designation` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`id` = '$inside_doc'";

					$run_sql_inside = mysqli_query($conn,$sql_inside);

					$row_sql_inside = mysqli_fetch_assoc($run_sql_inside);





					$sql77="SELECT `name` FROM `user_infos` Where `users_id`='".$row['username77']."'";

					$pres_opt=$conn->query($sql77) ;	

					$pres_opt_fetch = $pres_opt->fetch_assoc();



					 ?>
      <?php if($row['username77'] != ''){ ?>
      <div style="width:50%; height:auto; float:left; margin:0px 0 15px 0px; padding:0px 0 10px 0;">
        <table cellpadding="6" cellspacing="0" style="width:100%; margin:0px; padding:0px; border:0px solid #000;">
          <tr>
            <td style="text-align:left; padding:35px 20px 0 0;"><span style="border-top:1px solid #000;font-size:8px !important;color:black !important;">Workup Done By -&nbsp;&nbsp; <?php echo $pres_opt_fetch['name'] ;?> </span><span style="font-size:8px !important;color:black !important;">
              <?php $sql2="SELECT `user_infos`.`name` FROM `additional_optom_for_prescription_for_emr` INNER JOIN `user_infos` ON `additional_optom_for_prescription_for_emr`.`additional_optom_id` =`user_infos`.`users_id`  WHERE `additional_optom_for_prescription_for_emr`.`prescription_id`= '" .$_REQUEST['id']. "' AND  `additional_optom_for_prescription_for_emr`.`del_flag`='0' ";



								 $result2=$conn->query($sql2) ;



								 $count=$result2->num_rows;

								if($count>'0'){

									while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))

										{

											echo ' <br/> '.$row2['name'];

										}



								}?>
              </span><br/>
              <span style="font-size:8px !important;color:black !important;">(Optometrist)</span></td>
          </tr>
          <tr>
            <td style="text-align:left; padding:0 20px 0 100px;"></td>
          </tr>
        </table>
      </div>
      <div style="width:50%; height:auto; float:left; margin:0px 0 15px 0px; padding:0px 0 10px 0;">
        <table cellpadding="6" cellspacing="0" style="width:100%; margin:0px; padding:0px; border:0px solid #000;">
          <tr>
            <td style="text-align:right; padding:35px 20px 0 0;"><b style="border-top:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_sql_inside['name'] ;?></b></td>
          </tr>
          <?php if($row_sql_inside['designation']!=''){ ?>
          <tr>
            <td style="text-align:right; padding:0 20px 0 0;"><b>( <?php echo $row_sql_inside['designation'] ;?> )</b></td>
          </tr>
          <?php } ?>
          <?php if($row_sql_inside['regd_no']!=''){ ?>
          <tr>
            <td style="text-align:right; padding:0 20px 0 0;"><b>Reg. No. - <?php echo $row_sql_inside['regd_no'] ;?></b></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      <?php }else{ ?>
      <div style="width:100%; height:auto; float:left; margin:0px 0 15px 0px; padding:0px 0 10px 0;">
        <table cellpadding="6" cellspacing="0" style="width:100%; margin:0px; padding:0px; border:0px solid #000;">
          <tr>
            <td style="text-align:right; padding:35px 20px 0 0;"><b style="border-top:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_sql_inside['name'] ;?></b></td>
          </tr>
          <?php if($row_sql_inside['designation']!=''){ ?>
          <tr>
            <td style="text-align:right;padding: 6px 20px 5px 0;"><b>(<?php echo $row_sql_inside['designation'] ;?>)</b></td>
          </tr>
          <?php } ?>
          <?php if($row_sql_inside['regd_no']!=''){ ?>
          <tr>
            <td style="text-align:right; padding:0 20px 0 0;"><b>Reg. No. - <?php echo $row_sql_inside['regd_no'] ;?></b></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      <?php } ?>
      <?php  ?>
    </div>
  </div>
   <?php if($row['location_print']=='1') {  ?>
  <div id="footer_img_pdf" style="margin-top: auto;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td width="50%" style="padding-left:8px;"><span style="font-size:11.5px;font-weight:bold;"><?php echo $row_hospital_info['hospital_name'];  ?><br/><i class="fa fa-map-marker" title="Edit"></i> 49/2 Purna Das Road, Golpark - Gariahat,<br />
          Kolkata 700029 <br />
          <i class="fa fa-phone" title="Edit"></i> 9051155660 </span></td>
        <td height="23" width="52%"  colspan="2" style="padding-left:8px;"><span style="font-size:11.5px;font-weight:bold;"><?php echo $row_hospital_info['hospital_name'];  ?><br/><i class="fa fa-map-marker" title="Edit"></i> DC-9/16/1, Shastribagan, Joramandir, <br />
          Baguihati Vip Road, Kolkata 700059 <br />
          <i class="fa fa-phone" title="Edit"></i> 9874144440</span></td>
      </tr>
      <tr>
        <td width="50%" style="background:#aa1328;border-right: 5px solid #aa1328;clip-path: polygon(0 0, 94% 0, 100% 100%, 0% 100%);height: 3px !important;">&nbsp;</td>
        <td height="23" width="52%"  colspan="2"  style="background:#104882; color:#fff;clip-path: polygon(0 0, 100% 0, 100% 100%, 5% 100%);height: 3px !important;">&nbsp;</td>
      </tr>
    </table>
  </div>
   <?php }  ?>
</div>
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript">



<?php if($ptflag==1){?>



//window.print();



<?php } ?>







function print_send_request(){







	var a=1;



	var b=<?php echo $prescription_id; ?>;  



	$.ajax({



			type : "POST",



			url : "<?php echo ADMIN_URL; ?>print_status_for_emr.php?print_prescription="+a,



			dataType : "json", 



			data : "id="+b,



			success : function(data) {	



					if(data.flag=='1'){	



					// alert("Ready for print")



					}



			}



	});



}



</script>
</body>
</html>