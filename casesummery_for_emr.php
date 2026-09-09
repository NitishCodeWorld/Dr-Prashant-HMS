<?php include 'conn.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print</title>
<style>
body {
	color:#000 !important;
	line-height: 95%;
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
</style>
<style type="text/css" media="print">
@media print {
 @page :first {
 margin-top: 90px;
 margin-left: -15px;
 size: auto;   /* auto is the initial value */
    	/* this affects the margin in the printer settings */ 
   		margin-bottom: 35mm !important;
}
 @page {
 margin-top: 90px;
 margin-bottom: 100px;
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
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}
function close_window() {
  /*if (confirm("Close Window?")) {
    close();
  }*/
  close();
}
</script>
</head>

<body style="font-family:Arial, Helvetica, sans-serif !important;  font-size:10px; font-weight:normal;padding-left:35px !important;padding-top:25px !important;" >
<div class="notprnt">
  <button class="print default" onclick="window.print();">Print</button>
  <!--<button class="cancel" onclick="GoBackWithRefresh();return false;">Cancel / Close</button>-->
  <button class="cancel" onclick="close_window();return false;">Cancel / Close</button>
</div>
<!-- -->
<div style="padding-left:50px;">
<?php
				$all_emr_id=$_REQUEST['all_mrd_id'];
				$emr_id=explode(',',$all_emr_id);
				$itemCount = sizeof($emr_id);
				
				for($i=0;$i<($itemCount-1);$i++) {
					$sql4 = $conn->query("SELECT * FROM `prescription_details_for_emr` WHERE `id`= '" .$emr_id[$i]. "'"  );
					$prescription_id=$_REQUEST['all_mrd_id']; 
				 	while ($row=mysqli_fetch_array($sql4,MYSQLI_ASSOC))
				
				 {

			  ?>

<?php if($row['location_print']=='1') { if($row['city_l']!='') { ?>
<div>
  <div style="float:left;width:70%;">
    <?php 
    $sql2="SELECT * FROM `location_masters_for_emr` WHERE `id`='".$row['city_l']."'";
	$pres_city=$conn->query($sql2) ;				
	$pres_city_fetch = $pres_city->fetch_assoc();
 ?>
    <table>
      <tr>
        <td ><img  alt="logo" src="<?php echo ADMIN_URL; ?>location_upload/<?php echo $pres_city_fetch['logo'];?>"  style="width:150px;height:70px;"></td>
      </tr>
      <tr>
        <td><span style="font-size:13px">Address : <?php echo $pres_city_fetch['location_address'];?></span></td>
      </tr>
      <tr>
        <td><span style="font-size:13px">Phone no : <?php echo $pres_city_fetch['phone_no'];?></span></td>
      </tr>
    </table>
  </div>
  <div style="float:right;width:30%;">
    <table>
      <tr>
        <td><span style="font-size:15px"><b style="color:red;">Doctor Name </b></span></td>
      </tr>
      <tr>
        <td>MBBS, DO (Gold Medallist), DNB,MNAMS, FVRS,</td>
      </tr>
      <tr>
        <td>Reg. No. - WBMC 56625</td>
      </tr>
      <tr>
        <td>Mobile No:+91 0123456789</td>
      </tr>
      <tr>
        <td>E-mail: doctor@gmail.com<br /></td>
      </tr>
      <tr>
        <td>Website:www.doctorsite.com<br /></td>
      </tr>
    </table>
  </div>
</div>
<div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:0px 0 0px 0; border-bottom:1px solid #000; border-top:1px solid #000;">
  <?php } } else { ?>
  <div style="width:100%; height:auto; float:left; margin:120px 0 0 0; padding:0px 0 0px 0; border-bottom:1px solid #000;">
    <?php } ?>
    
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

					 			?>
        <td style="margin:0px; padding:6px; width:40%;"><b>Referred by:</b>&nbsp;&nbsp;
          <?php if($ref_by!=''){ echo $ref_by; }  if($ref_by==''){echo "N/A";}?>
          <?php if($ref_by!='' ) echo "<br />&nbsp;".'(Thanks for referral.)'; ?></td>
        <td style="margin:0px; padding:6px; width:24%; vertical-align:top"><b>MRD No:</b> <?php echo $row['mrd_no']; ?></td>
        <td style="margin:0px; padding:6px; width:32%; vertical-align:top"><b>Date</b> – <?php echo date("d/m/Y", strtotime($row['created_on']));  ?></td>
      </tr>
      <tr style="margin:0px; width:100%;">
        <td style="margin:0px; padding:6px; width:40%;"><b>Name:</b>&nbsp;&nbsp;<?php echo $row['prefix']; ?>&nbsp;<?php echo $row['fname']; ?>&nbsp;<?php echo $row['lname']; ?></td>
        <td style="margin:0px; padding:6px; width:24%;"><b>Age:</b>&nbsp;&nbsp;
          <?php if(!empty($row['age'])){ if($row['age']>='1') echo $row['age'].' years'; if($row['age']=='1') echo $row['age'].' year'; }?>
          &nbsp;
          <?php if(!empty($row['age_month'])){ if($row['age_month']>'1') echo $row['age_month'].' months'; if($row['age_month']=='1') echo $row['age_month'].' month'; } ?>
          &nbsp;
          <?php if(!empty($row['age_days'])){ if($row['age_days']>'1') echo $row['age_days'].' days'; if($row['age_days']=='1') echo $row['age_days'].' day'; } ?></td>
        <?php 

								$purpose_visit='';

								 $sql7="select * from `purposevisit_masters_for_emr` Where `id`='".$row['purpose_visit_id']."' ";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {		

									 $purpose_visit=$row7['purpose_visit'];

								 }

					 			?>
        <td style="margin:0px; padding:6px; width:32%;"><b>Purpose of visit:</b>&nbsp;&nbsp;<?php echo $purpose_visit=='' ? 'N/A' : $purpose_visit; ?></td>
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
                  V <br /> Add</td>
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
                  V <br />Add</td>
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
      <?php if($row['dv_glasses']!="" or $row['nv_od']!="" or $row['nv_os']!=""){ ?>
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
      <?php if($row['EOM']!="" or $row['EOM_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">EOM</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['EOM']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['EOM_left']; ?></td>
      </tr>
      <?php } ?>
      <?php if($row['pupils']!="" or $row['pupils_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Pupils</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['pupils']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['pupils_left']; ?></td>
      </tr>
      <?php } ?>
      <?php if($row['lid_adnexa']!="" or $row['lid_adnexa_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Lid Adnexa</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['lid_adnexa']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['lid_adnexa_left']; ?></td>
      </tr>
      <?php } ?>
      <?php if($row['conjunctiva']!="" or $row['conjunctiva_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Conjunctiva</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['conjunctiva']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['conjunctiva_left']; ?></td>
      </tr>
      <?php } ?>
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

 $sql2="SELECT * FROM `fundus_figure_for_emr` WHERE `prescription_id`= '" .$emr_id[$i]. "' AND `anterior`=1";

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
      <?php if($row['misc_findings']!="" or $row['misc_findings_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Miscellaneous</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['misc_findings']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['misc_findings_left']; ?></td>
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

 $sql2="SELECT * FROM `fundus_figure_for_emr` WHERE `prescription_id`= '" .$emr_id[$i]. "' AND `fundus`=1";

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
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">IOL Power (118.4) </td>
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
    </table>
    <?php } ?>
    <?php

 $sql2="SELECT * FROM `at_details_for_emr` WHERE `prescription_id`= '" .$emr_id[$i]. "' ORDER BY `id` ASC";

 $result2=$conn->query($sql2) ;

 $count=$result2->num_rows; 

 if($count>0){

?>
    <table cellspacing="0" cellpadding="1" border="0" style="margin:0px 0 10px 0; border:1px solid #000; float:left; width:100%;">
      <tbody>
        <?php

 while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))

 {

?>
        <tr>
          <td width="20%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><b><?php echo $row2['at_select']; ?></b>&nbsp;(at <?php echo date('h:i A',strtotime($row2['at_time'])); ?>)</td>
          <td width="40%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><?php if(strtoupper($row2['at_select'])=='AT'){ echo $row2['at_od'].'mmhg'; } else { echo $row2['at_od']; } ?></td>
          <td width="40%" style="border-width:0 0 1px 0; border-style:solid; boder-color:#000;"><?php if(strtoupper($row2['at_select'])=='AT'){ echo $row2['at_os'].'mmhg'; } else { echo $row2['at_os']; } ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
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
      <?php if($row['dv_glasses']!="" or $row['nv_od']!="" or $row['nv_os']!=""){ ?>
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
      <?php if($row['EOM']!="" or $row['EOM_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">EOM</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['EOM']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['EOM_left']; ?></td>
      </tr>
      <?php } ?>
      <?php if($row['pupils']!="" or $row['pupils_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Pupils</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['pupils']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['pupils_left']; ?></td>
      </tr>
      <?php } ?>
      <?php if($row['lid_adnexa']!="" or $row['lid_adnexa_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Lid Adnexa</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['lid_adnexa']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['lid_adnexa_left']; ?></td>
      </tr>
      <?php } ?>
      <?php if($row['conjunctiva']!="" or $row['conjunctiva_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Conjunctiva</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['conjunctiva']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['conjunctiva_left']; ?></td>
      </tr>
      <?php } ?>
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

 $sql2="SELECT * FROM `fundus_figure_for_emr` WHERE `prescription_id`= '" .$emr_id[$i]."' AND `anterior`=1";

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
      <?php if($row['misc_findings']!="" or $row['misc_findings_left']!=""){ ?>
      <tr>
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">Miscellaneous</td>
        <td width="40%" style="border-style:solid; border-width:0px 1px 1px 1px; border-color:#000;"><?php echo $row['misc_findings']; ?></td>
        <td width="40%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;"><?php echo $row['misc_findings_left']; ?></td>
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

 $sql2="SELECT * FROM `fundus_figure_for_emr` WHERE `prescription_id`= '" .$emr_id[$i]. "' AND `fundus`=1";

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
        <td width="20%" style="border-style:solid; border-width:0px 0 1px 0; border-color:#000;">IOL Power (118.4) </td>
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

 $sql2="SELECT * FROM `at_details_for_emr` WHERE `prescription_id`= '" .$emr_id[$i]. "' ORDER BY `id` ASC";

 $result2=$conn->query($sql2) ;

 $count=$result2->num_rows; 

 if($count>0){

?>
      <?php
 while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))
 {
?>
      <tr>
        <td width="20%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><b><?php echo $row2['at_select']; ?></b>&nbsp;(at <?php echo date('h:i A',strtotime($row2['at_time'])); ?>)</td>
        <td width="40%" style="border-width:0 1px 1px 0; border-style:solid; boder-color:#000;"><?php if(strtoupper($row2['at_select'])=='AT'){ echo $row2['at_od'].'mmHg'; } else { echo $row2['at_od'].'mmHg'; } ?></td>
        <td width="40%" style="border-width:0 0 1px 0; border-style:solid; boder-color:#000;"><?php if(strtoupper($row2['at_select'])=='AT'){ echo $row2['at_os'].'mmHg'; } else { echo $row2['at_os'].'mmHg'; } ?></td>
      </tr>
      <?php } ?>
      <?php } ?>
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
  <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:6px 0 2px 0;">
    <h3 style="text-align:left; margin:0px;">Medication</h3>
    <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:4px 0 0 0; padding:0px;">
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
  <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:6px 0 2px 0;">
    <h3 style="text-align:left; margin:0px;">Surgery</h3>
    <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:4px 0 0 0; padding:0px;">
      <tr>
        <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['surgery']; ?></pre>
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
    <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:4px 0 0 0; padding:0px;">
      <tr>
        <td style="width:100%; border-width:0 0 0 0"><?php echo $row['pre_operative']; ?></td>
      </tr>
    </table>
  </div>
  <?php } ?>
  <?php } ?>
  <?php if($row['investigation']!=""){ ?>
  <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:6px 0 2px 0;">
    <h3 style="text-align:left; margin:0px;">Investigation</h3>
    <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:4px 0 0 0; padding:0px;">
      <tr>
        <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['investigation']; ?></pre>
          <?php /* $k=1; foreach(split("\r\n",$row['investigation']) as $gi) if($gi!=''){ echo ($k).". $gi<br>"; $k++; } */?></td>
      </tr>
    </table>
  </div>
  <?php } ?>
  <?php if($row['diagnostic']!=''){ ?>
  <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:6px 0 2px 0;">
    <h3 style="text-align:left; margin:0px;">Diagnosis</h3>
    <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:4px 0 0 0; padding:0px;">
      <tr>
        <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['diagnostic']; ?></pre>
          <?php /* echo nl2br($row['diagnostic']); */?></td>
      </tr>
    </table>
  </div>
  <?php } ?>
  <?php if($row['general_instructions']!=''){ ?>
  <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:6px 0 2px 0;">
    <h3 style="text-align:left; margin:0px;">General Instructions / Action Plan</h3>
    <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:4px 0 0 0; padding:0px;">
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
  <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:6px 0 2px 0;">
    <h3 style="text-align:left; margin:0px;">Certificate</h3>
    <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:4px 0 0 0; padding:0px;">
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
  <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:6px 0 2px 0;">
    <h3 style="text-align:left; margin:0px;">Procedure</h3>
    <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:4px 0 0 0; padding:0px;">
      <tr>
        <td style="width:100%; border-width:0 0 0 0"><pre><?php echo $row['procedure_comments']; ?></pre>
          <?php /* $k=1; foreach(split("\r\n",$row['procedure_comments']) as $gi) if($gi!=''){ echo ($k).". $gi<br>"; $k++; } */ ?></td>
      </tr>
    </table>
  </div>
  <?php } ?>
  <?php if($row['ot_notes_block']=='1'){ ?>
  <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:6px 0 2px 0;">
    <h3 style="text-align:left; margin:0px;">Surgical Procedure</h3>
    <table cellpadding="2" cellspacing="0" style="width:100%; border:0px solid #000; margin:4px 0 0 0; padding:0px;">
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
        <td width="95%" style="width:90%; border-width:0 0 0 0"><?php if($row['next_visit_day'] != '0') echo "After ".$row['next_visit_day']." days"; ?>
         
          <?php if($row['next_visit_week'] != '0') echo "After ".$row['next_visit_week']." weeks"; ?>
          
    <?php if($row['next_visit_month'] != '0') echo "After ".$row['next_visit_month']." months"; ?>
    <?php if($row['next_visit_year'] != '0') echo "After ".$row['next_visit_year']." years"; ?>
    
    </td>
      </tr>
    </table>
  </div>
  <?php } ?>
  <?php 			$inside_doc = $row['primary_doctor'];
					$sql_inside = "SELECT `users`.`id`,`user_infos`.`name`,`user_infos`.`regd_no` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`id` = '$inside_doc'";
					$run_sql_inside = mysqli_query($conn,$sql_inside);
					$row_sql_inside = mysqli_fetch_assoc($run_sql_inside);
					
					$sql77="SELECT `user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE  `users`.`username`='".$row['username77']."'";
					$pres_opt=$conn->query($sql77) ;				
					$pres_opt_fetch = $pres_opt->fetch_assoc();
					 ?>
  <?php if($row['username77'] != ''){ ?>
  <div style="width:50%; height:auto; float:left; margin:0px 0 15px 0px; padding:0px 0 10px 0;">
    <table cellpadding="6" cellspacing="0" style="width:100%; margin:0px; padding:0px; border:0px solid #000;">
      <tr>
        <td style="text-align:left; padding:35px 20px 0 0;"><b style="border-top:1px solid #000;">Workup Done By -&nbsp;&nbsp; <?php echo $pres_opt_fetch['name'] ;?></b><br/>        <b>(Optometrist)</b></td>
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
      <tr>
        <td style="text-align:right; padding:0 20px 0 0;"><b>Reg. No. - <?php echo $row_sql_inside['regd_no'] ;?></b></td>
      </tr>
    </table>
  </div>
  <?php }else{ ?>
  <div style="width:100%; height:auto; float:left; margin:0px 0 15px 0px; padding:0px 0 10px 0;">
    <table cellpadding="6" cellspacing="0" style="width:100%; margin:0px; padding:0px; border:0px solid #000;">
      <tr>
        <td style="text-align:right; padding:35px 20px 0 0;"><b style="border-top:1px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_sql_inside['name'] ;?></b></td>
      </tr>
      <tr>
        <td style="text-align:right; padding:0 20px 0 0;"><b>Reg. No. - <?php echo $row_sql_inside['regd_no'] ;?></b></td>
      </tr>
    </table>
  </div>
  <?php } ?>
  <?php }} ?>
</div>
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
</body>
</html>