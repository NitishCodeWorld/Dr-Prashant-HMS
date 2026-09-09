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
 margin-top: 5px;
 margin-left: -15px;
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
</head>

<body style="font-family:Arial, Helvetica, sans-serif !important;  font-size:9px; font-weight:normal;padding-left:35px !important;padding-top:5px !important;" >
<div id="invoice" style="height: 1080px;display: flex;  flex-direction: column;">
  <div id="invoice_print">
    <?php 			$inside_doc = $row['signed_by_doctor'];



				 $sql_inside = "SELECT `users`.`id`,`user_infos`.`name`,`user_infos`.`regd_no`,`user_infos`.`designation`,`user_infos`.`designation_desc` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`id` = '$inside_doc'";

					$run_sql_inside = mysqli_query($conn,$sql_inside);

					$row_sql_inside = mysqli_fetch_assoc($run_sql_inside);







					 ?>
    <div style="padding-left:30px;font-size: 12px;padding-top:7px !important;padding-bottom:10px !important;">
      <div style="width:100%; height:auto; float:left; margin:30px 0 0 0; padding:0px 0 0px 0; ">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4" style="padding:0 !important"><table width="100%" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #333">
                <tr>
                  <td width="40%" style="background:#aa1328;border-right: 5px solid #aa1328;clip-path: polygon(0 0, 94% 0, 100% 100%, 0% 100%);">&nbsp;</td>
                  <td height="23" colspan="2" style="background:#104882; color:#fff;clip-path: polygon(0 0, 100% 0, 100% 100%, 5% 100%);">&nbsp;</td>
                </tr>
                <tr>
                  <td width="40%" rowspan="6" style="vertical-align:top !important;border-left: 1px solid #333;padding-left:4px;"><table width="100%" cellpadding="0" cellspacing="0">
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
                <tr>
                  <td width="15%" style="text-align:center;padding-left:15px;"><img src="<?php echo ADMIN_URL.'upload/right_side_logo/'.$row_hospital_info['right_side_logo'];  ?>" weight="100" height="81" /></td>
                  <td width="30%" style="vertical-align:top !important; padding-left:10px;border-right: 1px solid #333;"><h2 style="color:#104882; margin:0px; padding-top:6px;font-size:12pt;"><?php echo $row_hospital_info['hospital_name'];  ?></h2>
                    <img src="icons8-location-16.png" width="10" height="10" /> <span style="font-size:8pt;"><?php echo $row_hospital_info['address'];  ?></span><br />
                    <img src="icons8-phone-16.png" width="10" height="10" /><strong> <?php echo $row_hospital_info['mobile'];  ?></strong><br />
                    <span style="padding-bottom:9px"><img src="icons8-mail-16.png" width="10" height="10" /><strong> <?php echo $row_hospital_info['email'];  ?></strong></span><br />
                    <br /></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div>
    </div>
    <div style="padding-left:30px;font-size: 12px;">
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

						echo $var_arr[$m].'<br/>';

						$p++;





					}



						?></td>
          </tr>
          <?php } ?>
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
              <?php $sql2="SELECT `user_infos`.`name` FROM `additional_optom_for_prescription_for_emr` INNER JOIN `user_infos` ON `additional_optom_for_prescription_for_emr`.`additional_optom_id` =`user_infos`.`users_id`  WHERE `additional_optom_for_prescription_for_emr`.`prescription_id`= '" .$_REQUEST['id']. "' ";



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
            <td style="text-align:right;padding: 6px 20px 5px 0;"><b>( <?php echo $row_sql_inside['designation'] ;?> )</b></td>
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
  <div id="footer_img_pdf" style="margin-top: auto;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td width="50%" style="background:#aa1328;border-right: 5px solid #aa1328;clip-path: polygon(0 0, 94% 0, 100% 100%, 0% 100%);height: 3px !important;">&nbsp;</td>
        <td height="23" width="52%"  colspan="2"  style="background:#104882; color:#fff;clip-path: polygon(0 0, 100% 0, 100% 100%, 5% 100%);height: 3px !important;">&nbsp;</td>
      </tr>
    </table>
  </div>
</div>
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript">

window.print();

</script>
</body>
</html>