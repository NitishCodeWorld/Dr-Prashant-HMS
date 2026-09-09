<?php include 'conn.php'; ?>
<?php include "header_inventory.php"; 
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
.dt-search {
	clear:both;
	float:right;
}
.dt-input {
	border: 1px solid #dddddd;
	height: 35px;
	margin-bottom: 4px;
	border-radius: 5px;
}
.modal-xl {
	width:1165px;
}
</style>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container"> 
  <!-- BEGIN PAGE HEAD -->
  <div class="page-head">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1> <small>Welcome to Electronic Medical Records System</small> </h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="<?php echo ADMIN_URL; ?>dashboard.php">Home </a> <i class="fa fa-circle"></i> </li>
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Report (Click On the calender icon to choose date <i class="fa fa-calendar-o" style="color: black !important;"></i> ) </span> </div>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats margin-bottom-30">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}else{ echo '<div class="alert alert-success" id="alert_msg" style="display:none;">';}?>
                  <button class="close" data-close="alert"></button>
                  <span>
                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?>
                  </span> </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important;margin-bottom:10px;">
                <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                  <div class="form-body">
                    <div class="col-md-3"> Date From:
                      <input class="form-control form-control-inline date-picker" type="text"  placeholder="Select Date" id="date_from" name="date_from" value="<?php echo $_POST['date_from']; ?>"/>
                    </div>
                    <div class="col-md-3"> Date To :
                      <input class="form-control form-control-inline date-picker" type="text"  placeholder="Select Date" id="date_to" name="date_to" value="<?php echo $_POST['date_to']; ?>"/>
                    </div>
                    <div class="col-md-3" style="padding-top:18px;">
                      <button type="submit" name="submit" id="submit" class="btn blue" title="Submit">Submit</button>
                      <a href="<?php echo ADMIN_URL; ?>surgery_advised_report_for_emr.php">
                      <button type="button" name="reload" id="reload" class="btn green" title="Reload">Reload</button>
                      </a> </div>
                    <div class="col-md-3"> &nbsp; </div>
                  </div>
                </form>
              </div>
              <?php 

				$today=date('Y-m-d');

				 //$prev_date2=date('Y-m-d', strtotime("-1096 days"));
				 $prev_date2=date('Y-m-d');
				 $sms='';
				 $mob='';
				  if(isset($_REQUEST['date_from']))
				 {
					$prev_date2= date("Y-m-d", strtotime($_REQUEST['date_from']));
					}
					 if(isset($_REQUEST['date_to']))
				 {
					$today= date("Y-m-d", strtotime($_REQUEST['date_to']));
					}
				 
					?>
              <input type="hidden" name="date_change_from" id="date_change_from" value="<?php echo date("d-m-Y", strtotime($prev_date2));?> " />
              <input type="hidden" name="date_change_to" id="date_change_to" value="<?php echo date("d-m-Y", strtotime($today));?> " />
              <p>&nbsp;</p>
              <div class="col-md-12" style="text-align:center;"><span style="font-size:16px; font-weight:bold;color:#900;" id="header_h">Surgery Advised Report</span></div>
              <p>&nbsp;</p>
              <table class="table table-striped table-hover table-bordered" id="table_id_appt">
                <thead>
                  <tr>
                    <th class="th_header">Sl. No</th>
                    <th class="th_header">MRD No</th>
                    <th class="th_header">Name</th>
                    <th class="th_header">Phone No.</th>
                    <th class="th_header">Prescription Date</th>
                    <th class="th_header">Doctor Name</th>
                    <th class="th_header">Visit Purpose</th>
                    <th class="th_header">Surgery Advised</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
				  $sl_no=1;
				  
				   $sql="SELECT `prescription_details_for_emr`.*, purposevisit_masters_for_emr.`purpose_visit` AS `purpose_visit_name` FROM `prescription_details_for_emr` LEFT JOIN `purposevisit_masters_for_emr` ON `prescription_details_for_emr`.`purpose_visit_id`= `purposevisit_masters_for_emr`.`id`  WHERE surgery<>'' AND `prescription_details_for_emr`.`del_flag`='0' and date(prescription_details_for_emr.created_on) BETWEEN '".$prev_date2."' AND '".$today."' ";
				    $res=mysqli_query($conn,$sql);
					while($row3=mysqli_fetch_assoc($res)){
						extract($row3);
						 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='5' OR `users`.`role`='4' and `users`.`id`='".$row3['admiting_doctor']."'";
						  $result7=$conn->query($sql7) ;
						  $row7=mysqli_fetch_array($result7,MYSQLI_ASSOC);
						  
						  $prefix="";	
						 $sql_prefix="select * from `prefix_masters` Where `id`='".$row3['prefix']."' ";
						 $result_prefix=$conn->query($sql_prefix) ;
						 while($row_prefix=mysqli_fetch_array($result_prefix,MYSQLI_ASSOC))
						 {	
							 $prefix=$row_prefix['prefix_name'];
						 }
						  
						  
					?>
                  <tr >
                    <td class="border"><?php echo $sl_no; ?></td>
                    <td class="border"><a href="<?php echo ADMIN_URL; ?>oldpatient_search_for_emr.php?id=<?php echo $row3['id']; ?>&mrd=<?php echo $row3['mrd_no']; ?>" target="_blank" style="color: #5b9bd1 !important;"> <?php echo $row3['mrd_no']; ?></a></td>
                    <td class="border"><?php echo $prefix.' '.$row3['fname'].' '.$row3['lname']; ?></td>
                    <td class="border"><?php echo $row3['mobile']; ?></td>
                    <td class="border"><a href="<?php echo ADMIN_URL; ?>printPrescription_for_emr.php?id=<?php echo $row3['id']; ?>"  target="_blank" style="color: #5b9bd1 !important;"><?php echo date("d/m/Y", strtotime($row3['created_on']));  ?></a></td>
                    <td class="border"><b>
                      <?php  echo $row7['name'];  ?>
                      </b></td>
                    <td class="border"><b>
                      <?php  echo $row3['purpose_visit_name'];  ?>
                      </b></td>
                    <td class="border"><b>
                      <?php  echo $row3['surgery'];  ?>
                      </b></td>
                  </tr>
                  <?php

				  $sl_no++; }?>
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

<script>

 $(document).ready( function() {       

setTimeout('$("#alert_msg").hide()',3000);

 });
 

</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> 
<script>
    $(document).ready(function() {
		$("#date_from").datepicker({
		   format: 'dd-mm-yyyy'
		});
	   $("#date_to").datepicker({
		   format: 'dd-mm-yyyy'
	   });
		
        $('#table_id_appt').DataTable({
            "searching": false,
            "dom": 'Blfrtip',
            "bPaginate": false,
            "ordering": false,
            "buttons": [{
                extend: 'collection',
                text: 'Download',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                buttons: [{
                        extend: 'excelHtml5',
                        footer: true
                    },
                    {
                        extend: 'csvHtml5',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        footer: true,
                        customize: function(doc) {
                            doc.pageMargins = [20, 20, 20, 20];
                            doc.defaultStyle.fontSize = 6;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.tableFooter.fontSize = 7;
                            doc.content[1]._maxWidth = 760; // doesn't seem to change it, last col still truncated
                            var rowCount = doc.content[1].table.body.length;
                            for (c = 1; c < doc.content[1].table.body[0].length; c++) { // right align headers for numeric cols
                                if (["Revenue", "Vol.", "Yield"].includes(doc.content[1].table.body[0][c].text)) {
                                    doc.content[1].table.body[0][c].alignment = 'right';
                                };
                            }
                            for (i = 1; i < rowCount; i++) {
                                for (c = 1; c < doc.content[1].table.body[i].length; c++) { // right align numeric cols
                                    if (["Revenue", "Vol.", "Yield"].includes(doc.content[1].table.body[0][c].text)) {
                                        doc.content[1].table.body[i][c].alignment = 'right';
                                    };
                                }
                            }
                        }
                    },
                    {
                        extend: 'print',
                        footer: true
                    }
                ]
            }]
        });
        var from_date = $("#date_change_from").val();
        var to_date = $("#date_change_to").val();
        $("#header_h").html();
        if (from_date == to_date) {
            $("#header_h").html("<b>Surgery Advised Report On " + from_date + "</b>");
            document.title = "Surgery Advised Report  On " + from_date;
        } else {
            $("#header_h").html("<b>Surgery Advised Report From " + from_date + " To " + to_date + "</b>");
            document.title = "Surgery Advised Report From " + from_date + " To " + to_date;
        }
    });
</script>
<?php include "footer_inevntory.php" ?>
