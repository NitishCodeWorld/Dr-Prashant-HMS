<?php 
include 'function.php';
include 'conn.php'; ?>
<?php include "header_inventory.php"; ?>
<link href="select2/select2.css" rel="stylesheet" />
<style>
[data-id="chief"] {
 max-width: 630px !important;
}
#general_instructions_subpackage {
	width: 1030px !important;
}
#s2id_autogen1 {
	width: 180px !important;
}
</style>
<style>
.control-label {
	color: black !important;
	font-weight:bold !important;
}
.portlet-body > label {
	color: black !important;
	font-weight:bold !important;
}
.portlet-body .row {
	background:#dcefff !important;
	font-weight:bold !important;
}
.portlet.light {
	background:#fff !important;
	font-weight:bold !important;
}
.footer-block {
	background: transparent !important;
	font-weight:bold !important;
}
.font-green-sharp {
	color: black !important;
	font-weight:bold !important;
}
.font-black-sharp {
	color: black !important;
	font-weight:bold !important;
}
.select2-container {
	width: 342.083px !important;
}
#span_title {
	color:#b32424;
	font-weight:bold;
	text-transform:uppercase;
	font-size:16px;
	display: list-item;
	margin-left : 1em;
}
#span_title_new {
	color:#f9f8f8;
	font-weight:bold;
	text-transform:uppercase;
	font-size:16px;
	display: list-item;
	margin-left : 1em;
}
#alert_otp{
	color:#c54040;
	font-weight:bold;
	font-size:16px;
}
</style>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container"> 
  
  <!-- BEGIN PAGE CONTENT -->
  
  <div class="page-content">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE CONTENT INNER -->
      
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">OTP Generate For Final Bill Edit </span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div id="reg_div">
                <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                  <div class="form-body">
                    <div class="col-md-12">
                      <div class="portlet-body">
                        <div class="row"> </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff;!important; padding:9px 0px">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Enter MRD No. / Hospital No. Click On Check</label>
                          <div class="input-group">
                            <select name="mrd_check" id="mrd_check" class="form-control select2" onChange="mrd_check_ajax();">
                              <option value="">Choose..</option>
                              
                              <?php 
                                      $sql7="SELECT * FROM `invoice_final_billing`  WHERE  `del_flag`='0' AND  `reason_for_edit`<>'' AND  `otp_status`='0' ORDER BY `id` DESC";
                                     $result7=$conn->query($sql7) ;
                                     while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                                     {									 
                                         echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['hospital_number'].' ( '.$row7['name'].' '.$row7['mobile'].' )</option>';
                                     }
                                    ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8" style="padding-top:25px !important;">
                        <div class="form-group"><span id="alert_otp"> After Submitting Form Your OTP Will Generate And Valid For 15 Minutes For That Particular Bill Edit</span></div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- 48 hours code-->
                  
                </form>
                
                <!-- BEGIN FORM-->
                <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                  <div class="form-body">
                    <div class="col-md-12">
                      <div class="portlet-body">
                        <div class="row">
                          <input type="hidden" id="created_on" name="created_on" class="form-control" value="<?php echo date('Y-m-d H:i:s');?>">
                          <input type="hidden" id="created_by" name="created_by" class="form-control" value="<?php echo $_SESSION['id'];?>">
                          <input type="hidden" id="patient_registration_id" name="patient_registration_id" class="form-control" >
                          <input type="hidden" id="invoice_no" name="invoice_no" class="form-control" >
                          <input type="hidden" id="bill_id" name="bill_id" class="form-control" >
                          <input type="hidden" id="opd_flag" name="opd_flag" class="form-control" value="0">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="background:#dcefff;!important; padding:9px 0px">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">MRD No. / Hospital No.</label>
                          <input type="text" id="hospital_number" name="hospital_number" class="form-control" placeholder="Enter Text"  readonly />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Name</label>
                          <input type="text" id="name" name="name" class="form-control" placeholder="Enter Text" readonly />
                        </div>
                      </div>                     
                       <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Start Time</label>
                          <input class="form-control " type="text"  placeholder="Select Date" id="crdate" name="crdate" value="" readonly />
                        </div>
                      </div>
                       <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">End Time</label>
                           <input class="form-control" type="text"  placeholder="Select Date" id="end_time" name="end_time" value="" readonly />
                        </div>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Reason</label>
                           <textarea name="reason_for_edit" id="reason_for_edit" cols="3" class="form-control" readonly ></textarea>
                        </div>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Request By & Requested Time</label><br/>
                           <span id="request_by_span" style="color:red;font-weight:bold;font-size:14px;"></span>
                        </div>
                      </div>
                      
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Remarks</label>
                           <textarea name="remarks_for_edit" id="remarks_for_edit" cols="3" class="form-control" onBlur="empty_or_not();" ></textarea>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </form>
                <!-- END FORM--> 
                <p style="padding:12px 0 2px 0; text-align:center;" id="register_para" >
                    <button type="button" name="register" id="register" onClick="fuc_register();" class="btn blue" disabled >Submit</button>
                    <a href="<?php echo ADMIN_URL; ?>otp_generate_for_final_bill_view.php">
                        <button type="button" name="cancel" id="cancel" class="btn red" title="Cancel">Cancel</button>
                        </a>
                  </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- END EXAMPLE TABLE PORTLET--> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTENT INNER --> 
  
</div>
<div class="col-md-12" style="margin-bottom:4px;overflow-x: auto !important;">
  <div class="table-scrollable" style="overflow-x: auto !important;border:none;background-color:#ffffff;">
    <table class="table table-striped table-hover table-bordered" id="patient_information">
      <p style="text-align:right"></p>
      <thead>
        <tr>
          <th>Sl. No</th>
          <th>MRD No. / <br /> Hospital No.</th>
          <th>Name</th>
          <th>Phone No.</th>
          <th>Billing Date</th>
          <th>Details</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="patient_information_body">
      </tbody>
    </table>
  </div>
</div>

<!-- END PAGE CONTENT --> 

<!-- END PAGE CONTAINER -->
<?php include "footer_inevntory.php" ?>
<!--<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script src="select2/select2.min.js"></script> -->
 
<script type="text/javascript"> 
      $(document).ready( function() { 
	  $("#mrd_check").select2();		
		setTimeout('$("#alert_msg").hide()',3000);		
		 		
		 $("#crdate").change(function(){
				var crdate=$(this).val();
				if(crdate==''){
					$("#register").prop( "disabled", true );
				}
			});
			$("#end_time").change(function(){
				var crdate=$(this).val();
				if(crdate==''){
					$("#register").prop( "disabled", true );
				}
			});
	  });
	 
function mrd_check_ajax(){
		var id=$("#mrd_check").val();
		var hidden_button=$("#hidden_button").val();	
		$('#reason_for_edit').val('');
		$('#remarks_for_edit').val('');	
		$('#request_by_span').html('');					
		$.ajax({
				type : "POST",
				url : "<?php echo ADMIN_URL; ?>ajax/otp_generate_for_final_bill_ajax.php?flag=1",
				dataType : "json", 
				data : "id="+id,
				success : function(data) {
						if(data.flag=='1'){						 
							$("#hospital_number").val(data.uhid_no);	
							$("#name").val(data.name);		
							$("#patient_registration_id").val(data.patient_registration_id);	
							$("#opd_flag").val(data.opd_flag);
							load_final_bill_table_details(data.uhid_no);	
							$('#request_by_span').html(data.request_by_span);
							$('#reason_for_edit').val(data.reason_for_edit);
							$('#remarks_for_edit').val(data.remarks_for_edit);							
						}
				}
			});
}
var patient_information="";
var uhid_no_test="";
load_final_bill_table_details(uhid_no_test);

function load_final_bill_table_details(uhid_no){
	if(patient_information!="") patient_information.destroy();
	 $('#patient_information_body').html('');
		$.ajax({
			url: "<?php echo ADMIN_URL; ?>ajax/otp_generate_for_final_bill_ajax.php?flag=2",
			type: 'POST',
			data: 'uhid_no='+uhid_no,			
			success: function (data) {	
				$('#patient_information_body').html(data);
				patient_information=$("#patient_information").DataTable( {
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
			 }	
			 
		 });
	
}
function cheack_ind_bill_details(bill_id,sl_no,total_count){
			if(total_count!=0){
			for(var c=1;c<=total_count;c++){			
				$("#cheack_inv_bill"+c).prop('checked', false); 		
				$("#selected_rows_"+c).css('background-color', 'transparent'); 	
				$("#selected_rows_"+c).css('font-weight', 'normal'); 
			}
			$("#cheack_inv_bill"+sl_no).prop('checked', true);
			$("#register").prop( "disabled", true );
			$("#crdate").val('');
			$("#end_time").val('');
			$("#bill_id").val('');
			$("#invoice_no").val('');
			
			$("#selected_rows_"+sl_no).css('background-color', '#9956AF'); 	
			$("#selected_rows_"+sl_no).css('font-weight', 'bold'); 
			
			var data={
			"id": $("#hospital_number").val(),	
			"bill_id": bill_id
			}					
			$.ajax({
					type : "POST",
					url : "<?php echo ADMIN_URL; ?>ajax/otp_generate_for_final_bill_ajax.php?flag=3",
					dataType : "json", 
					data : data,
					success : function(data) {	
							if(data.flag=='1'){						 
								$("#crdate").val(data.start_time);
								$("#end_time").val(data.end_time);
								$("#bill_id").val(data.bill_id);
								$("#invoice_no").val(data.invoice_no);
								$("#register").prop( "disabled", false );			 
							}
					}
				});
		
		}
}
function fuc_register(){
	var remarks_for_edit=$("#remarks_for_edit").val();
	if(remarks_for_edit==''){
		alert("Please give remarks ...");
		$("#register").prop("disabled", true );
		return false;
	}
		var data={
		"patient_registration_id": $("#patient_registration_id").val(),
		"invoice_no": $("#invoice_no").val(),
		"bill_id": $("#bill_id").val(),
		"opd_flag": $("#opd_flag").val(),
		"hospital_number": $("#hospital_number").val(),
		"name": $("#name").val(),
		"crdate": $("#crdate").val(),
		"created_by": $("#created_by").val(),
		"created_on": $("#created_on").val(),
		"end_time": $("#end_time").val(),
		"remarks_for_edit": $("#remarks_for_edit").val()
		}				
		$.ajax({
				type : "POST",
				url : "<?php echo ADMIN_URL; ?>ajax/otp_generate_for_final_bill_ajax.php?flag=4",
				dataType : "json", 
				data : data,
				success : function(data) {						
						if(data.flg=='0'){
							toastr.success(data.msg);						 
							$("#register").prop( "disabled", true );
							//setTimeout(function(){ location.reload(); }, 1000);
							//window.location.href='$redirectUrl';
							// window.open("stock_transfer_print.php?inv_id="+data.s_id);
							setTimeout(function(){ window.location.href=data.redirectUrl;}, 2000);			 
						}
				}
			});
}

function empty_or_not(){
	$("#register").prop("disabled", true );
	var flg=0;
	var remarks_for_edit=$("#remarks_for_edit").val();
	if(remarks_for_edit==''){
		alert("Please give remarks ...");
		flg=1;
		return false;
	}	
	var hospital_number=$("#hospital_number").val();
	if(hospital_number==''){
		alert("Please choose MRD No. / Hospital No. ...");
		flg=1;
		return false;
	}
	var end_time=$("#end_time").val();
	if(end_time==''){
		alert("Please tick or choose which bill edit you want ...");
		flg=1;
		return false;
	}
	
	
	if(flg=='1'){		
		$("#register").prop("disabled", true );
		return false;
	}else{
		$("#register").prop("disabled", false );
	}
	
	
}
</script> 

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>