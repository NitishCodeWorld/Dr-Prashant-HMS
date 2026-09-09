<?php include 'conn.php'; ?>
<?php include "header.php"; 
function limit_text($text, $limit) {
  if (str_word_count($text, 0) > $limit) {
	  $words = str_word_count($text, 2);
	  $pos = array_keys($words);
	  $text = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}

?>
<style>
.dt-search{
clear:both;
float:right;	
}
.dt-input{
	border: 1px solid #dddddd;
    height: 35px;
    margin-bottom: 4px;
    border-radius: 5px;
}
</style>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container">
  <!-- BEGIN PAGE HEAD -->
  <div class="page-head">
    <div class="container-fluid">
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1>
          <small>Welcome to Electronic Medical Records System</small>
        </h1>
        <ul class="page-breadcrumb breadcrumb">
          <li>
            <a href="<?php echo ADMIN_URL; ?>dashboard.php">Home </a>
            <i class="fa fa-circle"></i>
          </li>
          <li class="active">Report </li>
        </ul>
      </div>
      <!-- END PAGE TITLE -->
    </div>
  </div>
  <!-- END PAGE HEAD -->
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container-fluid">
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row margin-top-10">
        <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-cogs font-green-sharp"></i>
                <span class="caption-subject font-green-sharp bold uppercase">Report (Click On the calender icon to choose date <i class="fa fa-calendar-o" style="color: black !important;"></i> ) </span>
              </div>
              <div class="tools">
                <a href="javascript:;" class="collapse"></a>
                <a href="javascript:;" class="reload"></a>
                <a href="javascript:;" class="remove"></a>
              </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats margin-bottom-30">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important"> <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}else{ echo '<div class="alert alert-success" id="alert_msg" style="display:none;">';}?> <button class="close" data-close="alert"></button> <span> <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?> </span>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important;margin-bottom:10px;">
                <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                  <div class="form-body">
                    <div class="col-md-3"> Date From: <input class="form-control form-control-inline date-picker" type="date" placeholder="Select Date" id="date_from" name="date_from" value="<?php echo $_POST['date_from']; ?>" />
                    </div>
                    <div class="col-md-3"> Date To : <input class="form-control form-control-inline date-picker" type="date" placeholder="Select Date" id="date_to" name="date_to" value="<?php echo $_POST['date_to']; ?>" />
                    </div>
                    <div class="col-md-3" style="padding-top:18px;">
                      <button type="submit" name="submit" id="submit" class="btn blue" title="Submit">Submit</button>
                      <a href="<?php echo ADMIN_URL; ?>date_wise_report.php">
                        <button type="button" name="reload" id="reload" class="btn green" title="Reload">Reload</button>
                      </a>
                    </div>
                    <div class="col-md-3"> &nbsp; </div>
                  </div>
                </form>
              </div>
              <table class="table table-striped table-hover table-bordered" id="table_data">
                
                <thead>
                  <tr>
                    <th>Sl. No</th>
                    <th>MRD No</th>
                    <th>Name</th>
                    <th>Phone No.</th>
                    <th>Registration Date</th>
                    <th>GP Advice</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
					$sl=1;
					$from_=(isset($_POST['date_from'])) ? date("Y-m-d",strtotime($_POST['date_from'])) : date("Y-m-d");
                    $to_=(isset($_POST['date_to'])) ? date("Y-m-d",strtotime($_POST['date_to'])) : date("Y-m-d");
                    $sql="SELECT * FROM `prescription_details_for_emr` WHERE prescription_details_for_emr.glass_block<>0 AND date(prescription_details_for_emr.created_on)BETWEEN '".$from_."' AND '".$to_."' ORDER BY id DESC";
					$res=mysqli_query($conn,$sql);
					while($row=mysqli_fetch_assoc($res)){
						echo '<tr><td>'.$sl.'</td><td><a href="printPrescription_for_emr.php?id='.$row['id'].'">'.$row['mrd_no'].'</a></td><td>'.$row['prefix'].' '.$row['fname'].' '.$row['lname'].'</td><td>'.$row['mobile'].'</td><td>'.date("Y/m/d H:i:s",strtotime($row['created_on'])).'</td>'?><td><table style="width:100%; margin:0px; padding:0px;" cellpadding="0" cellspacing="0"><tbody><tr><td width="50%"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>  <td align="center" height="25" colspan="5">Right</td></tr><tr>  <td width="5%" align="center" rowspan="2">DV</td>  <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">SPH.</td>  <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">CYL.</td>  <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">AXIS.</td>  <td width="23%" align="center" height="20" style="border:1px solid #000">V/A.</td></tr><tr>  <td width="23%" align="center" height="30" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_sph_r']; ?></td>  <td width="23%" align="center" height="" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_cyl_r']; ?></td>  <td width="23%" align="center" height="" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_axis_r']; ?><sup>o</sup></td>  <td width="23%" align="center" height="" style="border:1px solid #000; border-top:none;"><?php echo $row['distance_va_r']; ?></td></tr>      </tbody>    </table></td><td><table width="100%" cellspacing="0" cellpadding="0" border="0" align="right">      <tbody><tr>  <td align="center" height="25" colspan="5">Left</td></tr><tr>  <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">SPH.</td>  <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">CYL.</td>  <td width="23%" align="center" height="20" style="border:1px solid #000; border-right:none;">AXIS.</td>  <td width="23%" align="center" height="20" style="border:1px solid #000">V/A.</td> </tr><tr>  <td width="23%" align="center" height="30" style="border:1px solid #000; border-right:none; border-top:none; "><?php echo $row['distance_sph_l']; ?></td>  <td width="23%" align="center" height="" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_cyl_l']; ?></td>  <td width="23%" align="center" height="" style="border:1px solid #000; border-right:none; border-top:none;"><?php echo $row['distance_axis_l']; ?><sup>o</sup></td>  <td width="23%" align="center" height="" style="border:1px solid #000; border-top:none;"><?php echo $row['distance_va_l']; ?></td></tr>      </tbody>    </table></td></tr><tr><td width="50%"><table style="width:98%; margin:10px 0 0 0;" cellspacing="0" cellpadding="0" border="0"> <tbody><tr>  <td width="5%" align="center" height="30">NV  Add</td>  <td width="23%" align="center" style="border:1px solid #000; border-right:none;"><?php echo $row['near_sph_r']; ?></td>  <td width="23%" align="center" style="border:1px solid #000; border-right:none;"><?php echo $row['near_cyl_r']; ?></td>  <td width="23%" align="center" style="border:1px solid #000; border-right:none;"><?php echo $row['near_axis_r']; ?></td>  <td width="23%" align="center" style="border:1px solid #000;"><?php echo $row['near_va_r']; ?></td></tr></tbody> </table></td><td><table style="width:98%; margin:10px 0 0 0;" cellspacing="0" cellpadding="0" border="0" align="right">      <tbody><tr>  <td width="23%" align="center" height="30" style="border:1px solid #000; border-right:none;"><?php echo $row['near_sph_l']; ?></td>  <td width="23%" align="center" style="border:1px solid #000; border-right:none;"><?php echo $row['near_cyl_l']; ?></td>  <td width="23%" align="center" style="border:1px solid #000; border-right:none;"><?php echo $row['near_axis_l']; ?></td>  <td width="23%" align="center" style="border:1px solid #000;"><?php echo $row['near_va_l']; ?></td>  </tr></tbody></table></td></tr><tr><td colspan="2"><?php echo $row['glass_prescription'];?></td></tr></tbody></table></td><?php echo '</tr>';
					$sl++;}
                    ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
        </div>
      </div>
      <!-- END PAGE CONTENT INNER -->
    </div>
  </div>
  <!-- END PAGE CONTENT -->
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" type="text/javascript"></script> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>

<script>
$( document ).ready(function() {
	new DataTable('#table_data', {
	"iDisplayLength" : 40,
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    layout: {
        topStart: 'buttons'
    }
	});
});
</script>
<?php include "footer.php" ?>
