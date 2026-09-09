<?php
include 'function.php';
include "conn.php";
$ptflag=0;	
if(isset($_REQUEST['ptflag'])){
	$ptflag=$_REQUEST['ptflag'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DISCHARGE SUMMARY</title>
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
td {
	vertical-align:middle !important;
	font-family:Arial, Helvetica, sans-serif;
	text-align:left;
	font-size:9pt;
	padding: 2px;
}
</style>
<style type="text/css" media="print">
@media print {
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









  close();







}







</script>
</head>

<body style="padding:2px 12px 2px 12px;">
<div id="invoice" style=" height: 1030px;display: flex;  flex-direction: column;">
  <div id="invoice_print" >
    <?php 
  $patient_discharge_id = $_REQUEST['discharge_id']; // get id through query string
  $qry = mysqli_query($conn,"select * from `patient_discharge_summary` where `id`='".$patient_discharge_id."'"); // select query
  $row3 = mysqli_fetch_array($qry);
  
  $sql_hospital_info="SELECT * FROM `hospital_info_masters`";	
  $res_hospital_info=mysqli_query($conn,$sql_hospital_info) or die(mysqli_error($conn));
  $row_hospital_info=mysqli_fetch_assoc($res_hospital_info);
  ?>
    <?php if($ptflag==0){?>
    <div class="notprnt" >
      <button class="print default" onclick="window.print();"  >Print</button>
      
      <!--<button class="cancel" onclick="GoBackWithRefresh();return false;">Cancel / Close</button>-->
      
      <button class="cancel" onclick="close_window();return false;">Cancel / Close</button>
    </div>
    <?php } ?>
    <div style="font-size: 12px;padding-top:7px !important;padding-bottom:10px !important;">
      <div style="width:100%; height:auto; float:left; margin:0px 0 0 0; padding:0px 0 0px 0; ">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="10%" style="border-left: 2px solid #333; border-top: 2px solid #333; border-bottom: 2px solid #333; padding:6px; text-align:center"><img src="<?php echo ADMIN_URL.'upload/left_side_logo/'.$row_hospital_info['left_side_logo'];  ?>" alt="left" /></td>
            <td width="80%" style="font-family:Times New Roman, Times, serif; font-size:11pt; border-top: 2px solid #333; border-bottom: 2px solid #333; line-height:20px; padding:6px; text-align:center; vertical-align:middle !important;"><h2 style="margin:0px"> <?php echo $row_hospital_info['hospital_name'];  ?></h2>
              <strong>(<?php echo $row_hospital_info['final_bill_unit'];  ?>)<br />
              <?php echo $row_hospital_info['address'];  ?><br />
              <?php echo $row_hospital_info['final_bill_mobile'];  ?>; <?php echo $row_hospital_info['email'];  ?></strong></td>
            <td width="10%" style="border-right: 2px solid #333; border-top: 2px solid #333; border-bottom: 2px solid #333; padding:6px; text-align:center"><img src="<?php echo ADMIN_URL.'upload/right_side_logo/'.$row_hospital_info['right_side_logo'];  ?>" alt="Sumetra" /></td>
          </tr>
        </table>
      </div>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" style="padding:0px; text-align:center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="7" style="text-align:center; font-size:11pt;"><strong><u>DISCHARGE SUMMARY</u></strong></td>
            </tr>
            <tr>
              <td width="11%" style="">&nbsp;</td>
              <td width="51%" colspan="4" style="padding-left:4px">&nbsp;</td>
              <td style="padding-left:4px">&nbsp;</td>
              <td style="padding-left:4px">&nbsp;</td>
            </tr>
            <tr>
              <?php
          $sql7="SELECT `prefix_name` FROM `prefix_masters`  WHERE  id='".$row3['prefix']."' and `del_flag`='0' ORDER BY `id` ASC";
		  $result7=$conn->query($sql7) ;
		  $row7=mysqli_fetch_array($result7,MYSQLI_ASSOC);
		  ?>
              <td colspan="5" style=""><strong>NAME: </strong> <?php echo $row7['prefix_name'].' '.$row3['patient_name'];?></td>
              <?php
          $sql7="SELECT `gender` FROM `gender_masters`  WHERE  id='".$row3['gender']."' and `del_flag`='0' ORDER BY `id` ASC";
		  $result7=$conn->query($sql7) ;
		  $row7=mysqli_fetch_array($result7,MYSQLI_ASSOC);
		  ?>
              <td width="13%" style="padding-left:4px"><strong>A/S: </strong><?php echo $row3['age'].'/'.$row7['gender'];?></td>
              <td width="25%" style="padding-left:4px"><strong>REF. NO.: </strong><?php echo $row3['uhid_no'];?></td>
            </tr>
            <tr>
              <td colspan="5" style=""><strong>ADMISSION DATE/TIME:</strong>
                <?php if($row3['registration_date']!=''){ echo date("d-M-Y", strtotime($row3['registration_date'])); } ?>
                <?php if($row3['registration_time']!=''){ echo ' at '.date("h:i A", strtotime($row3['registration_time']));}  ?></td>
              <td colspan="2" style="padding-left:4px"><strong>DISCHARGE DATE/TIME:</strong>
                <?php if($row3['discharge_date']!=''){ echo date("d-M-Y", strtotime($row3['discharge_date'])); } ?>
                <?php if($row3['discharge_time']!=''){ echo ' at '.date("h:i A", strtotime($row3['discharge_time']));}  ?></td>
            </tr>
            <tr>
              <td colspan="5" style=""><strong>MAIN OCULAR DIAGNOSES:</strong></td>
              <td style="padding-left:4px">&nbsp;</td>
              <td style="padding-left:4px">&nbsp;</td>
            </tr>
            <tr>
              <td style="">&nbsp;</td>
              <?php
		  $incr=1;
		  $sql_diag="SELECT * FROM `patient_discharge_diagnoses_details_table` WHERE `patient_discharge_id`= '" .$patient_discharge_id. "' and `del_flag`<>1";
		  $res_diag=$conn->query($sql_diag);
		  $disg_name='';
		  $disg_eye='';
		  while($row_diag=mysqli_fetch_array($res_diag,MYSQLI_ASSOC)){
			 $disg_name .=$incr.'. &nbsp; &nbsp; &nbsp; '.$row_diag['discharge_diagnoses_name'].'<br>';
			 $disg_eye .=$row_diag['discharge_diagnoses_eye'].'<br>';
			 $incr++;
		  }
		  ?>
              <td colspan="4" style="padding-left:4px"><strong><?php echo $disg_name;?></strong></td>
              <td style="padding-left:4px"><strong><?php echo $disg_eye;?></strong></td>
              <td style="padding-left:4px">&nbsp;</td>
            </tr>
            <tr>
              <td style=""><strong>PROCEDURE:</strong></td>
              <td colspan="4" style="padding-left:4px"><?php echo $row3['procedure'];?></td>
              <td style="padding-left:4px">&nbsp;</td>
              <td style="padding-left:4px">&nbsp;</td>
            </tr>
            <tr>
              <td style="">in the</td>
              <td style="padding-left:4px"><strong><?php echo $row3['procedure_eye'];?></strong></td>
              <td style="padding-left:4px"> under</td>
              <td style="padding-left:4px"><strong><?php echo $row3['procedure_type'];?></strong></td>
              <td style="padding-left:4px">anaesthesia on <strong>
                <?php if($row3['anaesthesia_date']!=''){ echo date("d-M-Y", strtotime($row3['anaesthesia_date'])); } ?>
                </strong></td>
              <td style="padding-left:4px">&nbsp;</td>
              <td style="padding-left:4px">&nbsp;</td>
            </tr>
            <tr>
              <?php
          $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`id`='".$row3['admiting_doctor']."'";
		  $result7=$conn->query($sql7) ;
		  $row7=mysqli_fetch_array($result7,MYSQLI_ASSOC);
		  $sql_asst="SELECT * FROM `patient_discharge_anaesthetst_assistent_details` WHERE `patient_discharge_id`= '" .$patient_discharge_id. "' and `del_flag`<>1";
			$res_asst=$conn->query($sql_asst);
			$assisent_name='';
			$sl_ass=1;
			while($row_asst=mysqli_fetch_array($res_asst,MYSQLI_ASSOC)){
			   $assisent_name .='<strong>Asst '.$sl_ass.':</strong> &nbsp;&nbsp;'.$row_asst['anaesthetst_assistent'].'&nbsp;&nbsp;';
				$sl_ass++;
			}
		  ?>
              <td colspan="7"><span><strong>Surgeon:</strong> <?php echo $row7['name'];?></span><span style="padding: 0 25px 0 25px;"><strong>Anaesthetist:</strong> <?php echo $row3['anaesthetst_doctor'];?></span><span><?php echo $assisent_name?></span></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"><strong>MEDICATIONS:</strong></td>
            </tr>
            <tr>
              <td colspan="2"><?php echo $row3['medication_editor'];?></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left; padding:16px 2px 2px 2px;"><strong><span style="border-top:2px dotted #000;">&nbsp;&nbsp;&nbsp;&nbsp;Signature / Date &nbsp;&nbsp;&nbsp;&nbsp;</span></strong></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left; padding:4px 2px;"><strong>FOLLOW-UP</strong></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left; padding:2px;">Next post-op check-up:
          <?php if($row3['next_postop_chkup']!=''){echo date('d-m-Y',strtotime($row3['next_postop_chkup']));}else{echo '';};?>
          at
          <?php if($row3['next_postop_chkup_time']!=''){echo date('h:i A',strtotime($row3['next_postop_chkup_time']));}else{echo '';};?></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left; padding:2px;">Final post-op check-up:
          <?php if($row3['final_postop_chkup']!=''){echo date('d-m-Y',strtotime($row3['final_postop_chkup']));}else{echo '';};?>
          [Confirm the time over 9830006769 on the previous day (10 AM - 2 PM)</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left; padding:2px;">For acute pain, swelling and/or similar emergencies, if any, contact: <u><strong><?php echo $row3['query_contact_number'];?></strong></u> by text sms/voice call.</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left; padding:2px; border-top:solid 1px #333"><strong>1st POST-OP CHECK-UP:</strong>
          <?php
		$sql_post_of_chk_up="SELECT * FROM `patient_discharge_post_up_chkup_details` WHERE `patient_discharge_id`= '" .$patient_discharge_id. "' and `del_flag`<>1";
		$res_post_of_chk_up=$conn->query($sql_post_of_chk_up);
		$post_up_chk_up_advice='';
		$sl_ass=1;
		while($row_post_of_chk_up=mysqli_fetch_array($res_post_of_chk_up,MYSQLI_ASSOC)){
		   $post_up_chk_up_advice .='<li>'.$row_post_of_chk_up['post_up_chk_up_advice'].'</li>';
			$sl_ass++;
		}
	?>
          <ol>
            <?php echo $post_up_chk_up_advice;?>
          </ol></td>
      </tr>
    </table>
  </div>
  <div id="footer_img_pdf" style="margin-top: auto;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td width="50%" style="padding-left:8px;"><span style="font-size:11.5px;font-weight:bold;"><?php echo $row_hospital_info['hospital_name'];  ?><br/>
          <i class="fa fa-map-marker" title="Edit"></i> 49/2 Purna Das Road, Golpark - Gariahat,<br />
          Kolkata 700029 <br />
          <i class="fa fa-phone" title="Edit"></i> 9051155660 </span></td>
        <td height="23" width="52%"  colspan="2" style="padding-left:8px;"><span style="font-size:11.5px;font-weight:bold;"><?php echo $row_hospital_info['hospital_name'];  ?><br/>
          <i class="fa fa-map-marker" title="Edit"></i> DC-9/16/1, Shastribagan, Joramandir, <br />
          Baguihati Vip Road, Kolkata 700059 <br />
          <i class="fa fa-phone" title="Edit"></i> 9874144440</span></td>
      </tr>
      <tr>
        <td width="50%" style="background:#aa1328;border-right: 5px solid #aa1328;clip-path: polygon(0 0, 94% 0, 100% 100%, 0% 100%);height: 3px !important;">&nbsp;</td>
        <td height="23" width="52%"  colspan="2"  style="background:#104882; color:#fff;clip-path: polygon(0 0, 100% 0, 100% 100%, 5% 100%);height: 3px !important;">&nbsp;</td>
      </tr>
    </table>
  </div>
</div>
<script>
function close_window() {
	close();
}
</script>
</body>
</html>
