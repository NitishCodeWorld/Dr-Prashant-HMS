<?php include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	// New Data Add
	if($_REQUEST['id']!=''){
		$item_name=mysqli_real_escape_string($conn,$_REQUEST['item_name']);
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);
		$batch_no=mysqli_real_escape_string($conn,$_REQUEST['batch_no']);
		$expiry_date=mysqli_real_escape_string($conn,$_REQUEST['expiry_date']);
		$qty=mysqli_real_escape_string($conn,$_REQUEST['qty']);
		$rate=mysqli_real_escape_string($conn,$_REQUEST['rate']);
		$mrp=mysqli_real_escape_string($conn,$_REQUEST['mrp']);

		$sql = "UPDATE `purchase_details` SET `item_name`='".$item_name."',`batch_no`='".$batch_no."' ,`expiry_date`='".$expiry_date."',`qty`='".$qty."' ,`rate`='".$rate."',`mrp`='".$mrp."' WHERE `id`='".$id."'";
		if($conn->query($sql)===TRUE)
		{
		$msg="Record updated successfully";
		$flg=0;
		$redirectUrl=ADMIN_URL.'stock_correction_for_pur_rate.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'stock_correction_for_pur_rate.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
	
} 
//Delete Data

?>
<?php include "header.php"; ?>

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
          <li class="active"> Masters </li>
        </ul>
      </div>
      <!-- END PAGE TITLE --> 
    </div>
  </div>
  <!-- END PAGE HEAD -->
  <?php 
						 
			 ?>
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Stock details</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats">
                <div class="col-md-11 col-sm-11 col-xs-11" style="border:none !important"></div>
                <div class="col-md-1 col-sm-1 col-xs-1 table-toolbar">
                  <div class="btn-group pull-right"> 
                    <!--<button class="btn btn-sm grey-cascade dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i> </button>
                    <ul class="dropdown-menu pull-right">
                      <li> <a href="#" onclick="window.print();return false;"> Print </a> </li>
                      <li> <a href="javascript:;"> Save as PDF </a> </li>
                      <li> <a href="javascript:;"> Export to Excel </a> </li>
                    </ul>--> 
                  </div>
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
            </div>
            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
              <p style="text-align:right">Search By Name</p>
              <thead>
                <tr>
                  <th>Sl. No</th>
                  <th>Item name</th>
                  <!-- //change -->
                  <th>batch_no</th>
                  <th>expiry_date</th>
                  <th>qty</th>
                  <th>rate</th>
                  <th>mrp</th>
                  <th>Entry Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				   //change
				  //$sql3="SELECT * FROM `purchase_details` WHERE `rate`='0' ORDER BY `item_name` ASC";   // Pur rate 0
				  //$sql3="SELECT * FROM `purchase_details` WHERE `mrp`='0' ORDER BY `item_name` ASC";	// Mrp 0	
				  //$sql3="SELECT * FROM `purchase_details` WHERE `expiry_date`=date(`date`) ORDER BY `item_name` ASC";  // expiry date
				  $sql3="SELECT * FROM `purchase_details` WHERE  `batch_no`='' ORDER BY `item_name` ASC";  // batch no
				  $result3=$conn->query($sql3) ;
				  $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {
					  //change
					  
					 
					 ?>
                <tr >
                  <td><?php echo $id; ?></td>
                  <td><?php echo $row3['item_name']; ?></td>
                  <td><?php echo $row3['batch_no']; ?></td>
                  <td><?php echo date("d-m-Y ", strtotime($row3['expiry_date']));?></td>
                  <td><?php echo $row3['qty']; ?></td>
                  <td><?php echo $row3['rate']; ?></td>
                  <td><?php echo $row3['mrp']; ?></td>
                  <td><?php echo date("d-m-Y ", strtotime($row3['date'])); ?></td>
                  
                  <td><a onClick="check('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" ><i class="fa fa-edit" title="Edit"></i> </a> </td>
                </tr>
                <?php 
				  $id++; }?>
              </tbody>
            </table>
            
            <!--Modal-->
            <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
              <div class="modal-dialog" id="model_header">
                <div class="modal-content"> 
                  <!-- <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                         <h4 class="modal-title"><strong>Add New Doctor</strong></h4>
                        </div>-->
                  <div class="modal-body">
                    <div class="portlet box blue-hoki">
                      <div class="portlet-title" >
                        <div class="caption"> <i class="fa fa-gift"></i>Stock</div>
                      </div>
                      <div class="portlet-body form"> 
                        <!-- BEGIN FORM-->
                        <form action="" method="post" class="form-horizontal">
                          <div class="form-body">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Item Name</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <input type="text" name="item_name" id="item_name" class="form-control" placeholder="Enter text" readonly="readonly" autocomplete="off" required/>
                                  <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />
                                  <!-- //change -->
                                  
                                </div> </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-md-4 control-label">batch_no</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <input type="text" name="batch_no" id="batch_no" class="form-control" placeholder="Enter text" autocomplete="off" />
                                </div> </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-md-4 control-label">expiry_date</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <input type="date" name="expiry_date" id="expiry_date" class="form-control" placeholder="Enter text" autocomplete="off" />
                                </div> </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-md-4 control-label">qty</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <input type="text" name="qty" id="qty" class="form-control" placeholder="Enter text" autocomplete="off" />
                                </div> </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-md-4 control-label">Purchase rate</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <input type="text" name="rate" id="rate" class="form-control" placeholder="Enter text" autocomplete="off" />
                                </div> </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-md-4 control-label">MRP</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <input type="text" name="mrp" id="mrp" class="form-control" placeholder="Enter text" autocomplete="off" />
                                </div> </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-md-4 control-label">Entry date</label>
                              <div class="col-md-7">
                                <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                                  <input type="date" name="date" id="date" class="form-control" placeholder="Enter text" autocomplete="off" />
                                </div> </div>
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
            
            <!--Modal End--> 
            
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
<!-- END PAGE CONTAINER --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script type="text/javascript"> 
      $(document).ready( function() {       
		setTimeout('$("#alert_msg").hide()',3000);
				
			$("#add_new").click(function(){
				var empty='';
				$("#floor").val(empty);
				$("#id").val(empty);				
				});
      });
function check(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/stock_correction_for_pur_rate_ajax.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {						
							//alert(data.flag);
							try{
								
								 $('#draggable').modal('show'); 								
								 $("#item_name").val(data.item_name);
								 $("#id").val(data.id);	
								 $("#batch_no").val(data.batch_no);
								 $("#expiry_date").val(data.expiry_date);
								 $("#qty").val(data.qty);	
								 $("#rate").val(data.rate);
								 $("#mrp").val(data.mrp);
								 $("#date").val(data.date);							
								
							}
							catch(err){
								alert(err.message);
							}
						
						}
					});
				}catch(err){
					alert(err.message);
				}
setInterval(function(){
   $('#error_msg').html('');
  }, 5000);
 
}
	  
</script>
<?php include "footer.php" ?>
