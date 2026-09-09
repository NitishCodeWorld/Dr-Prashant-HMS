<?php

include "conn.php"; // Using database connection file here

?>

<?php include "header_for_optical.php"; ?>

<div class="page-container"> 

  <!-- BEGIN PAGE HEAD --> 

  

  <!-- END PAGE HEAD --> 

  <!-- BEGIN PAGE CONTENT -->

  <div class="page-content">

    <div class="container-fluid"> 

      <!-- BEGIN PAGE BREADCRUMB -->

      <ul class="page-breadcrumb breadcrumb">

        <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>

        <li class="active"> <?php echo str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-16));?> </li>

      </ul>

      <!-- END PAGE BREADCRUMB --> 

      <!-- BEGIN PAGE CONTENT INNER -->

      <div class="row margin-top-10">

        <div class="col-md-12"> 

          <!-- BEGIN EXAMPLE TABLE PORTLET-->

          <div class="portlet light">

            <div class="portlet-title">

              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-16)));?></span></div>

            </div>

            <!-- BEGIN FORM-->

            <div class="row" style="background:#dcefff; padding:9px 0px">

              <table class="table table-striped table-bordered table-hover small" id="asset_entry_data1">

                <thead>

                  <tr>

                    <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Date </span></th>

                    <th class="draggable" data-column="category_name" style="cursor: move;"><span>Purchase order number </span></th>

                    <th class="draggable" data-column="department_name" style="cursor: move;"><span>Vendor </span></th>

                    <th class="draggable right" data-column="qty" style="cursor: move;"><span>Action </span></th>

                  </tr>

                </thead>

                <?php 

					$action='';

				 	$sql="select * FROM `purchase_order_for_optical` where status=1 and status<>4";

					$res=mysqli_query($conn,$sql);

				?>

                <tbody id="purchase_order_body">

                  <?php while($row=mysqli_fetch_assoc($res)){

					$action='<a href="javascript:void(0)" id="approve" name="approve" onClick="approve('.$row['id'].')"><i class=" fa fa-check"></i></a>';

					$action.='&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" id="delete" name="delete" onClick="delete_('.$row['id'].')"><i class=" fa fa-trash"></i></a>';

					echo '<tr><td>'.date('d-m-y',strtotime($row['date'])).'</td><td><a href="javascript:void(0);" id="delete" name="delete" data-toggle="modal" data-target="#staticBackdrop" onclick="view_order_details('.$row['id'].')">'.$row['order_number'].'</a></td><td>'.$row['vendor_name'].'</td><td>'.$action.'</td></tr>';

				}?>

                </tbody>

              </table>

              

              <!-- END PAGE CONTENT --> 

            </div>

            <!-- END PAGE CONTENT --> 

          </div>

        </div>

      </div>

      <!-- END PAGE CONTENT INNER --> 

    </div>

  </div>

  <div id="staticBackdrop" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document" style="width:50%">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Purchase Order Details</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i> </button>

        </div>

        <div class="modal-body">

          <table width="100%">

            <tr>

              <td><label>Purchase Number:</label>

                <span id="purchase_id" style="font-weight:bold" >PUR/100/1/2</span></td>

              <td></td>

              <td style="text-align:right"><label>Date:</label>

                <span id="date_val" style="font-weight:bold">09/05/22</span></td>

            </tr>

            <tr>

              <td><span id="vendor_name">Debasish</span></td>

            </tr>

            <tr>

              <td colspan="3"><table width="100%" class="table table-bordered table-striped">

                  <thead>

                    <tr>

                      <th>Date</th>

                      <th>Department</th>

                      <th>Asset Name</th>

                      <th>Qty</th>

                      <th>GP Details</th>

                    </tr>

                  </thead>

                  <tbody id="purchase_order_body_">

                  </tbody>

                </table></td>

            </tr>

          </table>

        </div>

      </div>

    </div>

  </div>

  <!-- END PAGE CONTENT --> 

</div>

<?php include("footer_for_optical.php"); ?>

<script type="text/javascript">

function approve(id){

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=40',

			type: 'POST',

			dataType: 'json',

			data: "id="+id,

			async: false, 

			success: function (data) {

				if(data.flag=="1"){

				 	toastr.success('Approved Successfully');

					setTimeout(function(){ location.reload(); }, 2000);	

				}else{

				

				 	if(data.reason!="") toastr.error(data.reason);

				 	else toastr.error('Unable to Approve');

					setTimeout(function(){ location.reload(); }, 2000);	

				}

			}

		});



}

function delete_(id){

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=41',

			type: 'POST',

			dataType: 'json',

			data: "id="+id,

			async: false, 

			success: function (data) {

				if(data.flag=="1"){

				 	toastr.success('Delete Successfully');

					setTimeout(function(){ location.reload(); }, 2000);	

				}else{

				

				 	if(data.reason!="") toastr.error(data.reason);

				 	else toastr.error('Unable to Delete');

					setTimeout(function(){ location.reload(); }, 2000);	

				}

			}

		});



}

function view_order_details(id){

	$.ajax({

            url: 'get_json_data_for_optical.php?flag=42',

			type: 'POST',

			dataType: 'json',

			data: "id="+id,

			success: function (data) {

				$("#purchase_id").html(data.purchase_number);

				$("#date_val").html(data.date);

				$("#vendor_name").html('<h6>'+data.vendor_name+'</h6>');

				$("#purchase_order_body_").html(data.body);

				//alert(data.body);

				

			}

			

			});

}

</script>