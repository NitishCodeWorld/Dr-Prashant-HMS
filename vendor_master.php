<?php
include "conn.php"; // Using database connection file here
?>
<?php include "header_inventory.php"; ?>
<!-- END HEADER --> 
<!-- BEGIN PAGE CONTAINER -->
<style>
.ajax-loader {
	visibility: hidden;
	background-color: rgba(255, 255, 255, 0.7);
	position: absolute;
	z-index: +100 !important;
	width: 100%;
	height:100%;
}
.ajax-loader img {
	position: relative;
	top:50%;
	left:50%;
}
</style>
<div class="page-container"> 
  <!-- BEGIN PAGE HEAD --> 
  
  <!-- END PAGE HEAD --> 
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE BREADCRUMB --> 
      <!--<ul class="page-breadcrumb breadcrumb">
        <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"> Dashboard </li>
      </ul> --> 
      <!-- END PAGE BREADCRUMB --> 
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">Vendor Creation</span></div>
            </div>
            <!-- BEGIN FORM-->
            <input type="hidden" value="" id="id" name="id" />
            <div class="form-body">
              <div class="row" style="background:#dcefff; padding:9px 0px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Vendor Name</label>
                    <div class="col-md-9">
                      <input type="text" id="vendor_name_" name="vendor_name_" class="form-control" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Vendor Address</label>
                    <div class="col-md-9">
                      <input type="text" id="vendor_address_" name="vendor_address_" class="form-control" placeholder="Address">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Vendor Phone</label>
                    <div class="col-md-9">
                      <input type="text" id="vendor_phone_" name="vendor_phone_" class="form-control" placeholder="Phone">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Vendor Email</label>
                    <div class="col-md-9">
                      <input type="text" id="vendor_email_" name="vendor_email_" class="form-control" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Vendor GST No.</label>
                    <div class="col-md-9">
                      <input type="text" id="vendor_gst_" name="vendor_gst_" class="form-control" placeholder="GST">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Contact Person</label>
                    <div class="col-md-9">
                      <input type="text" id="contact_person" name="contact_person" class="form-control" placeholder="Contact Person">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Contact Person Phone</label>
                    <div class="col-md-9">
                      <input type="text" id="contact_person_phone" name="contact_person_phone" class="form-control" placeholder="Contact Person Phone">
                    </div>
                  </div>
                  <div style="clear:both"></div>
                  <div class="form-group" style="margin-top:10px">
                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                          <button type="button" class="btn green" onClick="save_vendor(); return false;" id="submit_form_button">Submit</button>
                          <button type="button" class="btn default" onclick="init()">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div style="clear:both"></div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-md-3 control-label">A/c No</label>
                    <div class="col-md-9">
                      <input type="text" id="a_c_no" name="a_c_no" class="form-control" placeholder="A/c No">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">IFSC Code</label>
                    <div class="col-md-9">
                      <input type="text" id="ifsc_code" name="ifsc_code" class="form-control" placeholder="IFSC Code">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Bank Name</label>
                    <div class="col-md-9">
                      <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="Bank Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Branch</label>
                    <div class="col-md-9">
                      <input type="text" id="branch" name="branch" class="form-control" placeholder="Branch">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Bank Holder Name</label>
                    <div class="col-md-9">
                      <input type="text" id="bank_holder_name" name="bank_holder_name" class="form-control" placeholder="Bank Holder Name">
                    </div>
                  </div>
                </div>
                <!-- END PAGE CONTENT --> 
              </div>
            </div>
            <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>loader.gif" class="img-responsive" /> </div>
          </div>
          
          <!-- END PAGE CONTENT INNER --> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-hover table-bordered" id="asset_entry_data">
            <caption>
            All Vendors
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="vendor_id" style="cursor: move;"><span>Vendor ID</span></th>
                <th class="draggable" data-column="vendor_name" style="cursor: move;"><span>Vendor Name</span></th>
                <th class="draggable" data-column="address" style="cursor: move;"><span>Address</span></th>
                <th class="draggable" data-column="phone" style="cursor: move;"><span>Phone</span></th>
                <th class="draggable" data-column="email" style="cursor: move;"><span>Email</span></th>
                <th class="draggable" data-column="email" style="cursor: move;"><span>GST</span></th>
                <th class="draggable" data-column="email" style="cursor: move;"><span>Contact Person <br/> Name</span></th>
                <th class="draggable" data-column="email" style="cursor: move;"><span>Contact Person <br/> Phone</span></th>
                <th class="print_ignore"><span>Action</span></th>
              </tr>
            </thead>
            <tbody id="assets_body">
            </tbody>
          </table>
        </div>
        
        <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>--> 
      </div>
      <!-- END PAGE CONTENT --> 
    </div>
    
    <!-- END PAGE CONTAINER --> 
  </div>
</div>
<?php include("footer_inevntory.php"); ?>
<script>

let tab_asset_entry="";
load_vendors();

function save_vendor(){
	if($("#vendor_name_").val()==''){
		alert('Please Fill up Vendor Name');
		return false;
	}
	/*if($("#vendor_address_").val()==''){
		alert('Please Fill up Vendor Address');
		return false;
	}
	if($("#vendor_phone_").val()==''){
		alert('Please Fill up Vendor Phone');
		return false;
	}
	if($("#a_c_no").val()==''){
		alert('Please Fill up Account No');
		return false;
	}
	if($("#ifsc_code").val()==''){
		alert('Please Fill up IFSC Code');
		return false;
	}
	if($("#bank_name").val()==''){
		alert('Please Fill up Bank Name');
		return false;
	}
	if($("#branch").val()==''){
		alert('Please Fill up Branch');
		return false;
	}
	if($("#bank_holder_name").val()==''){
		alert('Please Fill up Bank Holder Name');
		return false;
	}
	if($("#vendor_email_").val()==''){
		alert('Please Fill up Vendor Email');
		return false;
	}
	if($("#vendor_gst_").val()==''){
		alert('Please Fill up GST');
		return false;
	}
	if($("#contact_person").val()==''){
		alert('Please Fill up Contact Person');
		return false;
	}
	if($("#contact_person_phone").val()==''){
		alert('Please Fill up Contact Person Phone');
		return false;
	}*/

	var data_details={
		"vendor_name": $("#vendor_name_").val(),
		"vendor_address": $("#vendor_address_").val(),
		"vendor_phone": $("#vendor_phone_").val(),
		"vendor_email": $("#vendor_email_").val(),
		"vendor_gst": $("#vendor_gst_").val(),
		"contact_person": $("#contact_person").val(),
		"contact_person_phone": $("#contact_person_phone").val(),
		"a_c_no": $("#a_c_no").val(),
		"ifsc_code": $("#ifsc_code").val(),
		"bank_name": $("#bank_name").val(),
		"branch": $("#branch").val(),
		"bank_holder_name": $("#bank_holder_name").val(),
		"id": $("#id").val(),
	}
	//contact_person,contact_person_phone,a_c_no,ifsc_code,bank_name,branch
	var edit_flag=0;
		$.ajax({
				beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
				},
				url: 'get_json_data_inventory.php?flag=12',
				type: 'POST',
				dataType: 'json',
				data: data_details,
				success: function (data) {
						if(data.flag=="1") toastr.success('Vendor Created Successfully');
						else toastr.error('Unable to create vendor');
						
						load_vendors();
						init();
						$('#staticBackdrop6').modal('hide');
						},
				complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
			});

}


function load_vendors(){

	if(tab_asset_entry!="") tab_asset_entry.destroy();

	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=11',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			 $('#assets_body').html('');
			 $.each(data, function(index, element) {
			 	$('#assets_body').html($('#assets_body').html()+'<tr><td>'+element.id+'</td><td>'+element.text+'</td><td>'+element.address+'</td><td>'+element.phone+'</td><td>'+element.email+'</td><td>'+element.gst+'</td><td>'+element.contact_person+'</td><td>'+element.contact_person_phone+'</td><td><a class="edit" href="javascript:;" onclick="edit('+element.id+',\''+element.text+'\',\''+element.address+'\',\''+element.phone+'\',\''+element.email+'\',\''+element.gst+'\',\''+element.contact_person+'\',\''+element.a_c_no+'\',\''+element.ifsc_code+'\',\''+element.bank_name+'\',\''+element.branch+'\',\''+element.bank_holder_name+'\',\''+element.contact_person_phone+'\')" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="delete" href="javascript:;" onclick="del('+element.id+')" ><i class="fa fa-trash"></i></a></td>');
		 	});
			
				tab_asset_entry=$("#asset_entry_data").DataTable( {
					"destroy": true,
					dom: 'Bfrtip',
					"pageLength": 15,
					"initComplete": function(settings, json) {
					//$('#products_filter').hide();
				}
				} );
				
				
			
			 },
			 complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}

		  });

}


function del(id){
if(confirm("Are you sure you want to delete the data?")){
	$.ajax({
			beforeSend: function(){
				  $('.ajax-loader').css("visibility", "visible");
				  $("#submit_form_button").prop('disabled', true);
			},
            url: 'get_json_data_inventory.php?flag=20',
			type: 'POST',
			data: "id="+id+"&table=vendor_master",
			success: function (data) {
			
				//console.log(data.confirm_flag);
				//alert("data");	
				//alert(data);
				load_vendors();
				
			},
			complete: function(){
				  $('.ajax-loader').css("visibility", "hidden");
				  $("#submit_form_button").prop('disabled', false);
				}
		});
	}
}


function edit(id,text,address,phone,email,gst,contact_person,a_c_no,ifsc_code,bank_name,branch,bank_holder_name,contact_person_phone){

	$("#id").val(id);
	$("#vendor_name_").val(text);
	$("#vendor_address_").val(address);
	$("#vendor_phone_").val(phone);
	$("#vendor_email_").val(email);
	$("#vendor_gst_").val(gst);
	$("#contact_person").val(contact_person);
	$("#a_c_no").val(a_c_no);
	$("#ifsc_code").val(ifsc_code);
	$("#bank_name").val(bank_name);
	$("#branch").val(branch);
	$("#bank_holder_name").val(bank_holder_name);
	$("#contact_person_phone").val(contact_person_phone);
	$("#vendor_name_").focus();
	

}


function init(){

	$("#vendor_name_").val('');
	$("#vendor_address_").val('');
	$("#vendor_phone_").val('');
	$("#vendor_email_").val('');
	$("#vendor_gst_").val('');
	$("#id").val('');
	$("#contact_person").val('');
	$("#contact_person_phone").val('');
	$("#a_c_no").val('');
	$("#ifsc_code").val('');
	$("#bank_name").val('');
	$("#branch").val('');
	$("#bank_holder_name").val('');


}
</script>
</body>
<!-- END BODY -->
</html>