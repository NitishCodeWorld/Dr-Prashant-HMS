<?php include 'conn.php'; ?>

<?php include "header.php"; ?>

<style>

#sample_editable_1_filter {

	display:none !important;

}

</style>



<!-- BEGIN PAGE CONTAINER -->



<div class="page-container">



<!-- BEGIN PAGE HEAD -->



<div class="page-head">

  <div class="container-fluid"> 

    

    <!-- BEGIN PAGE TITLE -->

    

    <div class="page-title">

      <h1><small>Welcome to Electronic Medical Records System</small></h1>

      <ul class="page-breadcrumb breadcrumb">

        <li> <a href="<?php echo ADMIN_URL; ?>dashboard.php">Home</a><i class="fa fa-circle"></i> </li>

        <li class="active">Old Patients </li>

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

            <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">OLD PATIENTS Search RECORD</span></div>

            <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>

          </div>

          <div class="portlet-body">

            <div class="row number-stats margin-bottom-30">

                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">

                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>

                  <button class="close" data-close="alert"></button>

                  <span>

                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg']; echo '</div>';}?>

                  </span> </div>

              </div>

              <div class="col-md-6"> <span class="caption-subject font-blue-sharp bold uppercase">&nbsp; </span> </div>

              <div class="col-md-6">

                <div class="col-md-12 col-sm-12 col-xs-12 clearfix" style="text-align:right !important; border:none !important"> Normal : <span class="btn btn-sm" style="background-color: #5b9bd1;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Laser Procedure: <span class="btn btn-sm" style="background-color: green;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Surgery Advise: <span class="btn btn-sm" style="background-color: purple;">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;Important Visit: <span class="btn btn-sm" style="background-color: red;">&nbsp;</span> </div>

              </div>

              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                <p style="text-align:right">&nbsp;</p>

                <thead>

                  <tr>

                    <th>Sl. No</th>

                    <th>UHID No.</th>

                    <th>Name</th>

                    <th>Phone No.</th>

                    <!--<th>Action</th>-->

                  </tr>

                </thead>

                <tbody>

                  <?php 

				$sql3="SELECT `id`,`mrd_no`,`fname`,`prefix`,`lname`,`mobile` FROM `prescription_details_for_emr` WHERE `mrd_no`='".$_REQUEST['mrd']."' ORDER BY `prescription_details_for_emr`.`id` DESC LIMIT 1";

				 $result3=$conn->query($sql3) ;

				 $id=1;

				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))

				 {
					 $prefix="";
					 	
					 $sql_prefix="select * from `prefix_masters` Where `id`='".$row3['prefix']."' ";
					 
					 $result_prefix=$conn->query($sql_prefix) ;
					 
					 $row_prefix=mysqli_fetch_array($result_prefix,MYSQLI_ASSOC);
					 
					 $prefix=$row_prefix['prefix_name'];

					?>

                  <tr class="success odd">

                    <td><?php echo $id; ?></td>

                    <td><?php echo $row3['mrd_no']; ?></td>

                    <td><?php echo $prefix.' '.$row3['fname'].' '.$row3['lname']; ?></td>

                    <td><?php echo $row3['mobile']; ?></td>

                    <!--<td><a href="<?php echo ADMIN_URL; ?>old_patient_new_prescription_for_emr.php?id=<?php echo $row3['id']; ?>" title="Old Prescription New ADD"><img src="<?php echo ADMIN_URL; ?>icon/new.png"  title="Old Prescription New ADD"></a></td>-->

                  </tr>

                  <?php







				  $id++; }?>

                </tbody>

              </table>

              <p style="text-align:right">&nbsp;</p>

              <table class="table table-striped table-hover table-bordered">

                <tbody>

                  <tr>

                    <td colspan="5"><strong>Print Prescription Archive: </strong>

                      <?php 			







				$sql4="SELECT `id`,`created_on`,`important_visit`,`surgery`,`procedure_comments`,`primary_doctor` FROM `prescription_details_for_emr` WHERE `mrd_no`='".$_REQUEST['mrd']."' AND `del_flag`='0' ORDER BY `prescription_details_for_emr`.`id` ASC ";







				 $result4=$conn->query($sql4) ;				 







				 while ($row4=mysqli_fetch_array($result4,MYSQLI_ASSOC))







				 {



					$color='';



					if($row4['procedure_comments']!='')



					{



						$color='style="color:green !important;"';



						}



						if($row4['surgery']!='')



					{



						$color='style="color:purple !important;"';



						}



					 if($row4['important_visit']=='1')



					{



						$color='style="color:red !important;"';



						}





					?>

                      <a href="<?php echo ADMIN_URL; ?>printPrescription_for_emr.php?id=<?php echo $row4['id']; ?>"  <?php echo $color; ?> target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Prescription"> <?php echo date("d/m/Y", strtotime( $row4['created_on']));  ?> </a> |

                      

                     

                        

                      <?php

						





				   }?></td>

                  </tr>

                </tbody>

              </table>

              <p style="text-align:right">&nbsp;</p>

           

              <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">

                <div class="modal-dialog" id="model_header">

                  <div class="modal-content"> 

                    

                    <!-- <div class="modal-header">



                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>



                         <h4 class="modal-title"><strong>Add New Medication</strong></h4>



                        </div>-->

                    

                    <div class="modal-body">

                      <div class="portlet box blue-hoki">

                        <div class="portlet-title" >

                          <div class="caption"> <i class="fa fa-gift"></i>Attachment (Click On The Browse To Upload) On Presciption Date: <span id="pdate"></span> </div>

                        </div>

                        <div class="portlet-body form"> 

                          

                          <!-- BEGIN FORM-->

                          

                          <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">

                            <div class="form-body">

                              <div class="form-group">

                                <div class="col-md-11">

                                  <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>

                                    <input type="hidden" id="presciption_id" name="presciption_id" >

                                    <input type="hidden" id="presciption_mrd" name="presciption_mrd" >

                                    <input type="file" name="download_for1" id="download_for1" class="form-control">

                                  </div>

                                </div>

                              </div>

                            </div>

                            <div class="form-actions top">

                              <div class="row">

                                <div class="col-md-offset-4 col-md-7">

                                  <button type="submit" name="submit" id="submit" class="btn green">Submit</button>

                                  

                                  <!--<button type="button" class="btn default">Cancel</button>-->

                                  

                                  <button type="button" class="btn default" data-dismiss="modal">Close</button>

                                </div>

                              </div>

                            </div>

                          </form>

                          

                          <!-- END FORM--> 

                          

                        </div>

                      </div>

                    </div>

                  </div>

                  

                  <!-- /.modal-content --> 

                  

                </div>

                

                <!-- /.modal-dialog --> 

                

              </div>

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

<script src="newjs/jquery.min.js" type="text/javascript"></script> 

<script>







 $(document).ready( function() {       







setTimeout('$("#alert_msg").hide()',3000);







$("#model_close").click(function(){



		location.reload();



	});







 });



 



function check(id,dt,mrd){



	$('#draggable').modal('show');



	



	$("#pdate").html(dt);



	$("#presciption_id").val(id);



	$("#presciption_mrd").val(mrd);







 



} 







</script> 



<!-- END PAGE CONTAINER -->



<?php include "footer.php" ?>

<!-- END JAVASCRIPTS -->

</body><!-- END BODY -->

</html>