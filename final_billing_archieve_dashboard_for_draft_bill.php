<?php

include 'conn.php';

?>

<?php include "header_inventory.php"; ?>



<!-- BEGIN PAGE CONTAINER -->
<style>

#alert_msg_for_query {

	color:red;

	font-size:16px;

	font-weight:bold;

}

#alert_msg_for_query_after_otp {

	color:red;

	font-size:16px;

	font-weight:bold;

}

.col-form-label {

	font-weight:bold;

}

.modal-title{

	font-size:16px;

	font-weight:bold;

}

.bill_gene{

	font-size:16px;

	font-weight:bold;

	float:left !important;

	text-align:left !important;

	padding:12px;

	text-decoration:underline;

	color:#e31515;

}

.bill_search{

	font-size:16px;

	font-weight:bold;	

	text-align:center !important;

	padding-left:138px;

	text-decoration:underline;

	color:#e31515;

}



</style>


<div class="page-container"> 

  <!-- BEGIN PAGE HEAD -->

  <div class="page-head">

    <div class="container-fluid"> 

      <!-- BEGIN PAGE TITLE -->

      <div class="page-title">

        <h1><small>Welcome to EMR Dashboard</small></h1>

        <ul class="page-breadcrumb breadcrumb">

          <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>

          <li class="active"> Dashboard </li>

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

              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Draft Billing Dashbaoard</span></div>

              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>

            </div>

            <div class="portlet-body">

              <div class="row number-stats margin-bottom-30">

                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">

                  <?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}else{ echo '<div class="alert alert-success" id="alert_msg" style="display:none;">';}?>

                  <button class="close" data-close="alert"></button>

                  <span id="error_msg">

                  <?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg']; echo '</div>';}?>

                  </span> </div>

              </div>

              <p>&nbsp;</p>

              <div class="table-toolbar">

              <div class="table-toolbar">              

                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">

                      <div class="col-md-12">                      	

                        <a href="<?php echo ADMIN_URL; ?>final_billing_archieve_dashboard.php">

                        <button type="button" name="archieve" id="archieve" class="btn green" title="Final Billing">Final Billing Dashboard</button>

                        </a>

                        </div>

                </div>

              </div>
              
              <div class="col-md-12">

                <div class="col-md-2">

                <div class="input-group">

                  <input type="text" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo date("d-m-Y"); ?>" />

                   <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#from_date').val(''))" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>

                </div>

                <div class="col-md-2">

                <div class="input-group">

                  <input type="text" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo date("d-m-Y"); ?>" />

                  <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#to_date').val(''))" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>

                </div>

                <div class="col-md-2">

                <div class="input-group">

                  <input type="text" class="form-control" placeholder="UHID NO." id="uhid_no_srch" name="uhid_no_srch" value="" />

                  <span class="input-group-addon"><a href="javascript:void(0);" onClick="($('#uhid_no_srch').val(''))" title="Erase"><img src="icon/erase64x64.png" title="Erase" class="img-responsive" /> </a></span> </div>

                </div>

                <div class="col-md-2">

                  <select class="form-control"  id="bill_type" name="bill_type">

                  	<option value="3">All Type Bill</option>

                  	<option value="1">OPD Bill</option>

                    <option value="0">IPD Bill</option>

                  </select>

                </div>

                <div class="col-md-4">

                  <button type="button" name="submit" id="submit" class="btn red" title="Submit" onclick="date_wise_db();">Filter</button>

                  <span class="bill_search"> BILL SEARCH </span>

                </div>

              </div>
              
               <div class="col-md-12">

                <p>&nbsp;</p>

              </div>

              <div class="col-md-12" style="overflow:auto">

                <table class="table table-striped table-hover table-bordered" id="asset_entry_data">

                  <thead>

                    <tr>

                    <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>

                    <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No.</th>

                    <th class="draggable" data-column="asset_name" style="cursor: move;">Bill No.</th>

                    <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Name</th>

                    <th class="draggable" data-column="asset_name" style="cursor: move;">Phone No.</th>

                    <th class="draggable" data-column="asset_name" style="cursor: move;">Billing Date</th>

                    <th class="draggable" data-column="asset_name" style="cursor: move;">Billing Doctor / Optom</th>

                    <th class="draggable" data-column="asset_name" style="cursor: move;">Bill Type</th>                    

                    <th class="draggable" data-column="asset_name" style="cursor: move;">Total Amt.</th>

                    <th class="draggable" data-column="asset_name" style="cursor: move;">Details</th>

                    <th class="print_ignore"><span>Action</span></th>                      

                    </tr>

                  </thead>

                  <tbody id="assets_body">

                  </tbody>

                </table>

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


<?php include("footer_inevntory.php"); ?>


<script>

 $(document).ready( function() {       

setTimeout('$("#alert_msg").hide()',3000);





	$(".table-striped>tbody>tr:nth-of-type(odd)").removeClass("odd");

	$(".table-striped>tbody>tr:nth-of-type(even)").removeClass("even");

	

	$("#model_close").click(function(){

		location.reload();

	});

	$("#model_close2").click(function(){

		location.reload();

	});

	$("#model_close3").click(function(){

		location.reload();

	});
	
	 $("#from_date").datepicker({

	   format: 'dd-mm-yyyy'

   	});

   $("#to_date").datepicker({

	   format: 'dd-mm-yyyy'

   });

 });



function purpose(id){

	var purpose = prompt("Please enter reason");

	if (purpose != null && purpose != '') {

		location.href = '<?php echo ADMIN_URL; ?>action/invoice_hospital_bill_action.php?id='+id+'&a=delDraftBill&reason='+purpose;

	}else{

		alert("Please give proper reason for bill cancel!!!");

	}

}




var tab_asset_entry="";



load_admssion_details();



function load_admssion_details(){	



if(tab_asset_entry!="") tab_asset_entry.destroy();

	var data_details={

					"from_date": $("#from_date").val(),	

					"to_date": $("#to_date").val(),	

					"bill_type": $("#bill_type").val(),

					"uhid_no_srch": $("#uhid_no_srch").val()		

	}

	

	$.ajax({







            url: 'get_json_data_for_ipd_details.php?flag=10',



			dataType: 'json',

			data: data_details,



			type: 'POST',



			beforeSend: function(){



			// Show image container



			$('#assets_body').html('');



			//$("#loader").show();



			$('#assets_body').html($('#assets_body').html()+'<tr><td colspan="11" style="text-align:center"><img src="loader.gif" style="width:50px" /></td></tr>');			



			



		   },



			success: function (data) {



			 $('#assets_body').html('');



			  $.each(data, function(index, element) {



				 var extra_info="";



					  var background_color="style='background-color: "+element.rowclass+";'";  

				

				 

			 	$('#assets_body').html($('#assets_body').html()+'<tr '+background_color+'><td>'+element.sl_no+'</td><td><b>'+element.hospital_number+'</b></td><td><b>'+element.bill_no+'</b></td><td><b>'+element.name+'</b></td><td><b>'+element.mobile+'</b></td><td><b>'+element.billing_date+'</b></td><td><b>'+element.primary_doctor+'</b></td><td>'+element.bill_type_name+'</td><td style="font-weight:bold !important; color:red !important;">'+element.total+'</td><td>'+element.data_details+'</td><td>'+element.action_tab+'</td></tr>');



		 	});



				tab_asset_entry=$("#asset_entry_data").DataTable( {



					"destroy": true,



					dom: 'Bfrtip',



					"pageLength": 15,



					"language": {



					  "emptyTable": "No data available......"



					},



					"initComplete": function(settings, json) {


				}



				} );


			 }



		  });

}

function date_wise_db(){

	load_admssion_details();

}


</script> 

<!-- END PAGE CONTAINER -->



<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>