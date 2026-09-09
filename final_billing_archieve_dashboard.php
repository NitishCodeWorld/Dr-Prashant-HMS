<?php

include 'conn.php';

?>

<?php include "header_inventory.php"; ?>

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



<!-- BEGIN PAGE CONTAINER -->



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

            <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Final Billing Dashbaoard</span></div>

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

                <div class="row">

                  <div class="col-md-12">

                    <div class="col-md-12 col-sm-12 col-xs-12 clearfix" style="text-align:right !important; border:none !important;font-weight:bold;">

                      <table class="table table-striped table-hover table-bordered" >

                        <tbody>

                          <tr>

                            <td> Completed Bill: <span class="btn" style="background-color: #cfebcc;">&nbsp;</span></td>

                            <td> Cancelled Bill: <span class="btn" style="background-color: #ebcccc;">&nbsp;</span></td>

                            <td> Request Submitted(OTP is not generated) Bill : <span class="btn" style="background-color: #ebe7cc;">&nbsp;</span></td>

                          </tr>

                          <tr>

                            <td> Request Submitted(OTP is not submitted) Bill : <span class="btn" style="background-color: #baaae3;">&nbsp;</span></td>

                            <td> OTP submitted and ready for edit Bill : <span class="btn" style="background-color: #31badb;">&nbsp;</span></td>

                            <td> Bill Edit Done: <span class="btn" style="background-color: #7fbd78;">&nbsp;</span></td>

                          </tr>

                        </tbody>

                      </table>

                    </div>

                    <div class="btn-group pull-right"> </div>

                  </div>

                </div>

                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">

                  <div class="col-md-3">

                    <select class="form-control" name="type" id="type">

                      <option value="1"  >UHID No./ MRD / Hospital No.</option>

                      <option value="2"  >Name</option>

                      <option value="3" >Phone No.</option>

                    </select>

                  </div>

                  <div class="col-md-2">

                    <input type="text" id="srch" name="srch" class="form-control" value="" placeholder="Enter value">

                  </div>

                  <div class="col-md-1">

                    <button type="button" name="submit" id="submit" class="btn blue" title="Submit" onclick="old_pt_search_db(1);">Search</button>

                  </div>

                  <div class="col-md-6" style="float:right !important;text-align:right !important;"> <span class="bill_gene"> BILL GENERATION </span><a href="<?php echo ADMIN_URL; ?>final_billing_archieve_dashboard_for_draft_bill.php" title="Draft Billing Dashboard">

                    <button type="button" name="archieve" id="archieve" class="btn btn-default blue" title="Draft Billing Dashboard">Draft Billing Dashboard</button>

                    </a> </div>

                  <div class="col-md-12">

                    <p><br/>

                    </p>

                  </div>

                  <table class="table table-striped table-hover table-bordered" id="asset_entry_data_for_old_db">

                    <thead>

                      <tr>

                        <th class="draggable" data-column="asset_name" style="cursor: move;">Sl. No</th>

                        <th class="draggable" data-column="asset_name" style="cursor: move;">UHID No</th>

                        <th class="draggable" data-column="asset_name" style="cursor: move;">OLD Prefix</th>

                        <th class="draggable" data-column="asset_name" style="cursor: move;">Patient Name</th>

                        <th class="draggable" data-column="asset_name" style="cursor: move;">Reg. Date</th>

                        <th class="draggable" data-column="asset_name" style="cursor: move;">DOB</th>

                        <th class="draggable" data-column="asset_name" style="cursor: move;">Gender</th>

                        <th class="draggable" data-column="asset_name" style="cursor: move;">Phone No.</th>

                        <th class="draggable" data-column="asset_name" style="cursor: move;">Address</th>

                        <th class="print_ignore"><span>Action</span></th>

                      </tr>

                    </thead>

                    <tbody id="assets_body_for_old_db">

                    </tbody>

                  </table>

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

      <div class="modal fade" id="request_for_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel"><b> Request For Bill Edit </b></h5>

            </div>

            <form method="post" action="" id="add-request">

              <div class="modal-body">

                <table class="table table-bordered">

                  <thead>

                    <tr>

                      <th scope="col">UHID</th>

                      <th scope="col">Invoice No.</th>

                      <th scope="col">Bill Date</th>

                      <th scope="col">Patient Name</th>

                      <th scope="col">Total Bill Amt.</th>

                    </tr>

                  </thead>

                  <tbody id="tab_request">

                  </tbody>

                </table>

                <br />

                <span id="alert_msg_for_query"></span> <br />

                <div class="form-group">

                  <label for="recipient-name" class="col-form-label">Reason:</label>

                  <textarea name="reason_for_edit" id="reason_for_edit" cols="3" class="form-control" readonly ></textarea>

                </div>

                <div class="form-group">

                  <div id="request_by_div" style="display:none;">

                    <label for="recipient-name" class="col-form-label" style="font-weight:bold;font-size:16px;">Request By:</label>

                    <span id="request_by_span" style="color:red;font-weight:bold;font-size:14px;"></span></div>

                  <input type="hidden" name="request_by" id="request_by" class="form-control" value="" readonly />

                  <input type="hidden" name="invoice_id" id="invoice_id" class="form-control" value="" readonly />

                </div>

                <div class="form-group">

                  <label for="recipient-name" class="col-form-label">Remarks:</label>

                  <textarea name="remarks_for_edit" id="remarks_for_edit" cols="3" class="form-control" readonly ></textarea>

                </div>

              </div>

            </form>

            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

              <button type="button" class="btn btn-primary" id="save_request" onclick="save_request();">Save</button>

            </div>

          </div>

        </div>

      </div>

      <div class="modal fade" id="request_for_edit_modal_after_otp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel"> Request Bill Edit With OTP</h5>

            </div>

            <form method="post" action="" id="add-request">

              <div class="modal-body">

                <table class="table table-bordered">

                  <thead>

                    <tr>

                      <th scope="col">UHID</th>

                      <th scope="col">Invoice No.</th>

                      <th scope="col">Bill Date</th>

                      <th scope="col">Patient Name</th>

                      <th scope="col">Total Bill Amt.</th>

                    </tr>

                  </thead>

                  <tbody id="tab_request_after_otp">

                  </tbody>

                </table>

                <br />

                <div class="form-group">

                  <label for="recipient-name" class="col-form-label">Reason:</label>

                  <textarea name="reason_for_edit_after_otp" id="reason_for_edit_after_otp" cols="3" class="form-control" readonly ></textarea>

                </div>

                <div class="form-group">

                  <div id="request_by_div_after_otp" style="display:none;">

                    <label for="recipient-name" class="col-form-label" style="font-weight:bold;font-size:16px;">Request By:</label>

                    <span id="request_by_span_after_otp" style="color:red;font-weight:bold;font-size:14px;"></span></div>

                  <input type="hidden" name="request_by_after_otp" id="request_by_after_otp" class="form-control" value="" readonly />

                  <input type="hidden" name="invoice_id_after_otp" id="invoice_id_after_otp" class="form-control" value="" readonly />

                </div>

                <div class="form-group">

                  <label for="recipient-name" class="col-form-label">Remarks:</label>

                  <textarea name="remarks_for_edit_after_otp" id="remarks_for_edit_after_otp" cols="3" class="form-control" readonly ></textarea>

                </div>

                <div class="form-group">

                  <label for="recipient-name" class="col-form-label" style="font-weight:bold;font-size:16px;">OTP Details:</label>

                  <span id="otp_details" style="color:red;font-weight:bold;font-size:14px;"></span>

                  <input type="hidden" name="generated_otp" id="generated_otp" class="form-control" value="" readonly />

                  <input type="hidden" name="start_time" id="start_time" class="form-control" value="" readonly />

                  <input type="hidden" name="end_time" id="end_time" class="form-control" value="" readonly />

                </div>

                <br />

                <span id="alert_msg_for_query_after_otp"></span><br />

                <br />

                <div class="form-group">

                  <label for="recipient-name" class="col-form-label">Enter OTP:</label>

                  <input type="phone" onkeyup="value=value.replace(/[^\d]/g,'')" name="submitted_otp"  id="submitted_otp"  autocomplete="off" placeholder="Enter 6 Digit OTP" class="form-control"  >

                </div>

              </div>

            </form>

            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

              <button type="button" class="btn btn-primary" id="save_request" onclick="save_request_after_otp();">Save</button>

            </div>

          </div>

        </div>

      </div>

      

      <div class="modal fade" id="request_for_extra_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel"> Extra Info For TPA Cover Letter </h5>

            </div>

            <form method="post" action="" id="add-request">

              <div class="modal-body">

                <table class="table table-bordered">

                  <thead>

                    <tr>

                      <th scope="col">UHID</th>

                      <th scope="col">Invoice No.</th>

                      <th scope="col">Bill Date</th>

                      <th scope="col">Patient Name</th>

                      <th scope="col">Total Bill Amt.</th>

                    </tr>

                  </thead>

                  <tbody id="tab_rextra_info">

                  </tbody>

                </table>

                <br />

                <div class="form-group">

                  <label for="recipient-name" class="col-form-label">Diagnosis:</label>

                  <textarea name="diagnosis" id="diagnosis" cols="3" class="form-control"  ></textarea>

                </div>

                <div class="form-group">

                  <label for="recipient-name" class="col-form-label">Card No.:</label>

                  <input type="hidden" name="bill_unique_id" id="bill_unique_id" class="form-control" value=""  />

                  <input type="text" name="card_no" id="card_no" class="form-control" value=""  />

                </div>

                <div class="form-group">

                  <label for="recipient-name" class="col-form-label">Policy No.:</label>

                  <input type="text" name="policy_no" id="policy_no" class="form-control" value=""  />

                </div>

               

                

              </div>

            </form>

            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

              <button type="button" class="btn btn-primary" id="save_request" onclick="save_extra_info();">Save</button>

            </div>

          </div>

        </div>

      </div>

      

      <!-- END PAGE CONTENT INNER --> 

      <div class="modal fade draggable-modal" id="draggable_SMS" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog" id="model_header">
          <div class="modal-content">
            <div class="modal-body">
              <div class="portlet box blue-hoki">
                <div class="portlet-title" >
                  <div class="caption"> <i class="fa fa-gift"></i>Message Send (Click On The Icon To Send Message What You Want..)</div>
                </div>
                <div class="portlet-body form">
                  <input type="hidden" id="sms_msg_patient_name" name="sms_msg_patient_name"  value="">
                  <input type="hidden" id="sms_msg_patient_wp_no" name="sms_msg_patient_wp_no"  value="">
                  <input type="hidden" id="sms_msg_patient_mrd" name="sms_msg_patient_mrd"  value="">
                  <input type="hidden" id="sms_msg_patient_id" name="sms_msg_patient_id"  value="">
                  <input type="hidden" id="sms_msg_primary_doctor" name="sms_msg_primary_doctor"  value="">
                  <input type="hidden" id="sms_msg_opd_flag" name="sms_msg_opd_flag"  value="">
                  <input type="hidden" id="error_mobile_no_flag" name="error_mobile_no_flag"  value="">
                  <!-- BEGIN FORM-->
                  <table class="table table-striped table-hover table-bordered" id="table_SMS">
                    <tr>
                      <td class="patient_info_wp"><span class="patient_info_wp_display_main" >MRD No.</span></td>
                      <td class="patient_info_wp"><span class="patient_info_wp_display_main" >Patient Name</span></td>
                      <td class="patient_info_wp"><span class="patient_info_wp_display_main" >Mobile No.</span></td>
                    </tr>
                    <tr>
                      <td class="patient_info_wp"><span class="patient_info_wp_display" id="sms_msg_patient_mrd_span"></span></td>
                      <td class="patient_info_wp"><span class="patient_info_wp_display" id="sms_msg_patient_name_span"></span></td>
                      <td class="patient_info_wp"><span class="patient_info_wp_display" id="sms_msg_patient_wp_no_span"></span></td>
                    </tr>
                  </table>
                  <div class="col-md-12"><span id="msg_sent"></span><br />
                    <br />
                  </div>
                  <center>
                    <table id="table_SMS" width="60%" >
                      <tr>
                        <td class="patient_info_wp"><span class="patient_info_wp_display_send" >Bill send in SMS</span></td>
                        <td class="patient_info_wp"><span class="patient_info_wp_display" > <img src="<?php echo ADMIN_URL; ?>icon/arrow.png"  title="SMS Message Send"> &nbsp; <a onClick="billing_sms()"  href="javascript:void(0);" title="SMS Message Send"><img src="<?php echo ADMIN_URL; ?>icon/sms_30x30.png"  title="SMS Message Send"></a></span></td>
                      </tr>
                      <tr>
                        <td class="patient_info_wp" colspan="2">&nbsp; <br /></td>
                      </tr>
                    </table>
                  </center>
                  <!-- END FORM--> 
                </div>
                <div class="form-actions top">
                  <div class="row">
                    <div class="col-md-offset-4 col-md-7"> 
                      
                      <!--<button type="button" class="btn default">Cancel</button>-->
                      <button type="button" class="btn red" data-dismiss="modal" id="model_close_SMS">Close</button>
                    </div>
                  </div>
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

	$("#due_recieved_date").datepicker({

	   format: 'dd-mm-yyyy'

   });

 });







function purpose(id){



	var purpose = prompt("Please enter reason");



	if (purpose != null && purpose != '') {



		location.href = '<?php echo ADMIN_URL; ?>action/invoice_hospital_bill_action.php?id='+id+'&a=delFinalBill&reason='+purpose;



	}else{



		alert("Please give proper reason for bill cancel!!!");



	}



}







function request_function_for_edit(invoice_id){



	//alert(mrd_no);



	$('#reason_for_edit').val('');



	$('#invoice_id').val('');



	$('#remarks_for_edit').val('');



	$('#request_by_div').css('display','none');



	$('#alert_msg_for_query').html('');



	



	$('#request_for_edit_modal').modal('show');



	$('#invoice_id').val(invoice_id);



	$.ajax({



		url: '<?php echo ADMIN_URL; ?>ajax/request_for_edit_ajax.php?flag=1',



        type: 'post',



        data: 'invoice_id='+invoice_id,



		dataType: 'json',



        success: function(data) {



			$('#tab_request').html('<tr><td class="text-center">'+data.hospital_number+'</td><td class="text-center"><a href="<?php echo ADMIN_URL; ?>print_final_bill.php?id='+data.id+'" target="_blank" title="Print Final Bill">'+data.invoice_no+'</a></td><td class="text-center">'+data.billing_date+'</td><td class="text-center">'+data.name+'</td><td class="text-center">'+data.total+'</td></tr>');



			$('#reason_for_edit').val(data.reason_for_edit);



			$('#remarks_for_edit').val(data.remarks_for_edit);



			$('#request_by').val(data.request_by);



			if(data.request_by_span!=''){



				$('#request_by_div').css('display','block');



				$('#request_by_span').html(data.request_by_span);



			}



			$('#reason_for_edit').val(data.reason_for_edit);



			$('#remarks_for_edit').val(data.remarks_for_edit);



			



			if(data.reason_for_edit!=''){



				$('#reason_for_edit').prop('readonly', true);



				$('#remarks_for_edit').prop('readonly', true);



			}else{



				$('#reason_for_edit').prop('readonly', false);



				$('#remarks_for_edit').prop('readonly', true);



			}



			



        }



    });



}







function save_request(){



	



	var reason_for_edit=$("#reason_for_edit").val();



	if(reason_for_edit==''){



		$('#alert_msg_for_query').html('Please Enter Reason For Edit....');



		return false;



	}



	



		var data={



		"invoice_id": $("#invoice_id").val(),



		"reason_for_edit": $("#reason_for_edit").val(),



		"request_by": $("#request_by").val(),



		"remarks_for_edit": $("#remarks_for_edit").val(),



		}



							



		$.ajax({



				type : "POST",



				url : "<?php echo ADMIN_URL; ?>ajax/request_for_edit_ajax.php?flag=2",



				dataType : "json", 



				data : data,



				success : function(data) {	



						if(data.flg=='0'){



							$('#alert_msg_for_query').html('Bill Edit Request Submitted. Please Inform Administrator For Generating OTP For Edit. Then Submit OTP For Edit. (Remember : OTP Valid For 15 Minutes After Generating Time..)');



							$('#alert_msg_for_query').css('color','green');



							setTimeout(function(){ window.location.href=data.redirectUrl;}, 8000);			 



						}



				}



			});



}











 function request_function_for_edit_after_otp(invoice_id){



	//alert(mrd_no);



	$('#reason_for_edit_after_otp').val('');



	$('#invoice_id_after_otp').val('');



	$('#remarks_for_edit_after_otp').val('');



	$('#request_by_div_after_otp').css('display','none');



	$('#alert_msg_for_query_after_otp').html('');



	$("#submitted_otp").val('');



	



	$('#request_for_edit_modal_after_otp').modal('show');



	$('#invoice_id_after_otp').val(invoice_id);



	$.ajax({



		url: '<?php echo ADMIN_URL; ?>ajax/request_for_edit_ajax.php?flag=1',



        type: 'post',



        data: 'invoice_id='+invoice_id,



		dataType: 'json',



        success: function(data) {



			$('#tab_request_after_otp').html('<tr><td class="text-center">'+data.hospital_number+'</td><td class="text-center"><a href="<?php echo ADMIN_URL; ?>print_final_bill.php?id='+data.id+'" target="_blank" title="Print Final Bill">'+data.invoice_no+'</a></td><td class="text-center">'+data.billing_date+'</td><td class="text-center">'+data.name+'</td><td class="text-center">'+data.total+'</td></tr>');



			$('#reason_for_edit_after_otp').val(data.reason_for_edit);



			$('#remarks_for_edit_after_otp').val(data.remarks_for_edit);



			$('#request_by_after_otp').val(data.request_by);



			if(data.request_by_span!=''){



				$('#request_by_div_after_otp').css('display','block');



				$('#request_by_span_after_otp').html(data.request_by_span);



			}



			$('#reason_for_edit_after_otp').val(data.reason_for_edit);



			$('#remarks_for_edit_after_otp').val(data.remarks_for_edit);



			



			$('#otp_details').html(data.otp_timing);



			$('#start_time').val(data.start_time);



			$('#end_time').val(data.end_time);



			$('#generated_otp').val(data.otp_generate);



			



			if(data.reason_for_edit!=''){



				$('#reason_for_edit_after_otp').prop('readonly', true);



				$('#remarks_for_edit_after_otp').prop('readonly', true);



			}else{



				$('#reason_for_edit_after_otp').prop('readonly', false);



				$('#remarks_for_edit_after_otp').prop('readonly', true);



			}



			



        }



    });



}







function save_request_after_otp(){



	



	var submitted_otp=$("#submitted_otp").val();



	if(submitted_otp==''){



		$('#alert_msg_for_query_after_otp').html('Please Enter OTP For Edit....');



		return false;



	}



	



		var data={



		"invoice_id": $("#invoice_id_after_otp").val(),



		"generated_otp": $("#generated_otp").val(),



		"end_time": $("#end_time").val(),



		"submitted_otp": $("#submitted_otp").val(),



		}



							



		$.ajax({



				type : "POST",



				url : "<?php echo ADMIN_URL; ?>ajax/request_for_edit_ajax.php?flag=3",



				dataType : "json", 



				data : data,



				success : function(data) {	



						if(data.flg=='0'){



							$('#alert_msg_for_query_after_otp').html(data.msg);



							$('#alert_msg_for_query_after_otp').css('color','green');



							setTimeout(function(){ window.location.href=data.redirectUrl;}, 8000);			 



						}else{



							$('#alert_msg_for_query_after_otp').html(data.msg);



							$('#alert_msg_for_query_after_otp').css('color','red');



						}



				}



			});



}



var tab_asset_entry_for_old_db="";

old_pt_search_db(0);

function old_pt_search_db(fl){

	

	if(tab_asset_entry_for_old_db!="") tab_asset_entry_for_old_db.destroy();

	var type=$('#type').val();

	var srch=$('#srch').val();

	if(fl=='1'){

	if(srch==''){

		alert("please enter search value!!");

		return false; 	

	}

	}

	$.ajax({



				type : "POST",



				url : "<?php echo ADMIN_URL; ?>ajax/old_db_ajax.php?flag=1",

				dataType : "json",



				data : "type="+type+"&srch="+srch+"&page_name=bill",



				success : function(data) {	

				 $('#assets_body_for_old_db').html('');

	

				  $.each(data, function(index, element) {

	

					  

	

					$('#assets_body_for_old_db').html($('#assets_body_for_old_db').html()+'<tr ><td>'+element.sl+'</td><td><b>'+element.uhid_no+'</b></td><td><b>'+element.old_prefix+'</b></td><td><b>'+element.patient_name+'</b></td><td><b>'+element.registration_date+'</b></td><td><b>'+element.dob+'</b></td><td>'+element.old_gender+'</td><td>'+element.phone_no+'</td><td>'+element.address+'</td><td>'+element.action_tab+'</td></tr>');

	

				});

	

					tab_asset_entry_for_old_db=$("#asset_entry_data_for_old_db").DataTable( {

	

						"destroy": true,

	

						dom: 'Bfrtip',

	

						"pageLength": 15,

	

						"language": {

	

						  "emptyTable": "No data available......"

	

						},

	

						"initComplete": function(settings, json) {

	

						//$('#products_filter').hide();

	

					}

	

					} );

	

					

	

					//$("#filter_show_all_data").prop("onclick", null).off("click");

	

				 

	

					}



		});

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







            url: 'get_json_data_for_ipd_details.php?flag=5',



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

				if(element.bill_type_name=='IPD Bill'){

					extra_info="<a href='javascript:void(0);' onClick='extra_info_load("+element.bill_unique_id+")' style='color:#0600ff;'>"+element.bill_no+"</a>" ;

				}else{

					extra_info=element.bill_no;

				}

				 

			 	$('#assets_body').html($('#assets_body').html()+'<tr '+background_color+'><td>'+element.sl_no+'</td><td><b>'+element.hospital_number+'</b></td><td><b>'+extra_info+'</b></td><td><b>'+element.name+'</b></td><td><b>'+element.mobile+'</b></td><td><b>'+element.billing_date+'</b></td><td><b>'+element.primary_doctor+'</b></td><td>'+element.bill_type_name+'</td><td style="font-weight:bold !important; color:red !important;">'+element.total+'</td><td>'+element.data_details+'</td><td>'+element.action_tab+'</td></tr>');



		 	});



				tab_asset_entry=$("#asset_entry_data").DataTable( {



					"destroy": true,



					dom: 'Bfrtip',



					"pageLength": 15,



					"language": {



					  "emptyTable": "No data available......"



					},



					"initComplete": function(settings, json) {



					//$('#products_filter').hide();



				}



				} );



				



				//$("#filter_show_all_data").prop("onclick", null).off("click");



			 }



		  });







}

function date_wise_db(){

	load_admssion_details();

}

function extra_info_load(bill_unique_id){

	$("#bill_unique_id").val('');

	$('#request_for_extra_info').modal('show');

	$("#bill_unique_id").val(bill_unique_id);

	$('#diagnosis').val('');

	$('#card_no').val('');

	$('#policy_no').val('');

			

	$.ajax({



		url: '<?php echo ADMIN_URL; ?>ajax/request_for_edit_ajax.php?flag=4',



        type: 'post',



        data: 'bill_unique_id='+bill_unique_id,



		dataType: 'json',



        success: function(data) {



			$('#tab_rextra_info').html('<tr><td class="text-center">'+data.hospital_number+'</td><td class="text-center">'+data.bill_no+'</td><td class="text-center">'+data.billing_date+'</td><td class="text-center">'+data.name+'</td><td class="text-center">'+data.total+'</td></tr>');



			$('#diagnosis').val(data.diagnosis);

			$('#card_no').val(data.card_no);

			$('#policy_no').val(data.policy_no);



        }



    });

}



function save_extra_info(){



		var data={



		"bill_unique_id": $("#bill_unique_id").val(),



		"diagnosis": $("#diagnosis").val(),



		"card_no": $("#card_no").val(),



		"policy_no": $("#policy_no").val()



		}			



		$.ajax({



				type : "POST",



				url : "<?php echo ADMIN_URL; ?>ajax/request_for_edit_ajax.php?flag=5",



				dataType : "json", 



				data : data,



				success : function(data) {	

						

							alert('Data Saved successfully');



							setTimeout(function(){ window.location.href=data.redirectUrl;}, 2000);

				}



			});



}


function check_sms_send(id){
		//alert(id);
		$("#sms_msg_patient_name").val("");
		$("#sms_msg_patient_wp_no").val("");
		$("#sms_msg_patient_mrd").val("");
		$("#sms_msg_patient_id").val("");
		$("#sms_msg_patient_mrd_span").html("");
		$("#sms_msg_patient_name_span").html("");
		$("#sms_msg_patient_wp_no_span").html("");
		$("#msg_sent").html("");
		$("#error_mobile_no_flag").val("");
		$("#sms_msg_primary_doctor").val("");
		$("#sms_msg_opd_flag").val("");
		
		$.ajax({
			type : "POST",
			url : "<?php echo ADMIN_URL; ?>get_json_sms.php?data_flag=3",
			dataType : "json", 
			data : "id="+id,
			success : function(data) {	
				$('#draggable_SMS').modal('show'); 
				$("#sms_msg_patient_name").val(data.sms_msg_patient_name);
				$("#sms_msg_patient_wp_no").val(data.sms_msg_patient_wp_no);
				$("#sms_msg_patient_mrd").val(data.sms_msg_patient_mrd);
				$("#sms_msg_patient_id").val(data.sms_msg_patient_id);
				$("#sms_msg_patient_mrd_span").html(data.sms_msg_patient_mrd);
				$("#sms_msg_patient_name_span").html(data.sms_msg_patient_name);
				$("#sms_msg_patient_wp_no_span").html(data.sms_msg_patient_wp_no);
				$("#error_mobile_no_flag").val(data.error_mobile_no_flag);
				$("#sms_msg_primary_doctor").val(data.sms_msg_primary_doctor);
				$("#sms_msg_opd_flag").val(data.sms_msg_opd_flag);
			}
		});				
 
} 

function billing_sms(){
		var sms_msg_patient_wp_no=$("#sms_msg_patient_wp_no").val();
		if(sms_msg_patient_wp_no==''){
			$("#msg_sent").html("SMS no. is not provided, please edit prescription to enter SMS no.");
			$("#msg_sent").css("color","#cc335c");
			setInterval(function(){
				   $('#msg_sent').html('');
				}, 8000);
			return false;
		}
		var error_mobile_no_flag=$("#error_mobile_no_flag").val();
		if(error_mobile_no_flag=='1'){
			$("#msg_sent").html("SMS no. is not valid, please edit prescription to enter valid SMS no.");
			$("#msg_sent").css("color","#cc335c");
			setInterval(function(){
				   $('#msg_sent').html('');
				}, 8000);
			return false;
		}
		var form_data={
					"sms_msg_patient_name":$("#sms_msg_patient_name").val(),
					"sms_msg_patient_wp_no":$("#sms_msg_patient_wp_no").val(),	
					"sms_msg_patient_mrd":$("#sms_msg_patient_mrd").val(),
					"sms_msg_patient_id":$("#sms_msg_patient_id").val(),
					"sms_msg_primary_doctor":$("#sms_msg_primary_doctor").val(),
					"sms_msg_opd_flag":$("#sms_msg_opd_flag").val()	
			};
		
		$.ajax({
			type : "POST",
			url : "<?php echo ADMIN_URL; ?>get_json_sms.php?data_flag=4",
			dataType : "json", 
			data : form_data,
			success : function(data) {	
				if(data.return_flag==1){			
					$("#msg_sent").html("SMS Message Sent Successfully...");
					$("#msg_sent").css("color","#33cc80");
				}else{
					$("#msg_sent").html("SMS Message did not sent, try again..");
					$("#msg_sent").css("color","#cc335c");
				}
				setInterval(function(){
				   $('#msg_sent').html('');
				}, 6000);
			}
		});				
 
} 





</script> 



<!-- END PAGE CONTAINER --> 



<!-- END JAVASCRIPTS -->



</body>



<!-- END BODY -->



</html>

