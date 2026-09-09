<?php 

include 'conn.php';

?>
<?php include_once("header_for_appt.php"); ?>

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
#sample_editable_1_filter {
	display:none;
}
.danger_span {
	font-weight:bold;
	color:#F03;
}
.button-clicked {
	background: red !important;
}
#selected_date_time {
	font-size:16px;
	font-weight:bold;
	color:#F03;
}
#first_name{
	text-transform: capitalize;
}
.doc_tr{
	border: none !important;
}
.doc_tr_special{
	border: none !important;
	font-size:18px !important;
	font-weight:bold !important;
}
#appt_list_span{
	font-size:18px !important;
	font-weight:bold !important;
	color:#C06;
	padding:6px;
	
}
.next {
    background: #e5dcdc !important;
}
.paginate_button.next:hover {
    background-color: #333 !important; /* Example: blue background */
    color: white !important;
    cursor: pointer;
    border-radius: 5px;
    transition: all 0.3s ease;
}

</style>

<div class="page-container"> 
  
  <!-- BEGIN PAGE HEAD -->
  
  <div class="page-head">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE TITLE -->
      
      <div class="page-title">
        <h1><small>Welcome to Dashboard</small></h1>
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
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase">OPD Schedule Deleted Patient Information</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-group"> 
                      <!--<label>
                        <input type="text" id="datepicker_select" data-date-format="dd-mm-yyyy" /></label>-->
                        <label> From Date
                         <input type="text" class="form-control" placeholder="Select From Date" id="from_date" name="from_date" value="<?php echo date("d-m-Y"); ?>" />
                      </label>
                      <label> From Date
                         <input type="text" class="form-control" placeholder="Select To Date" id="to_date" name="to_date" value="<?php echo date("d-m-Y"); ?>" />
                      </label>
                      <label >Doctor
                        <select class="form-control select2" id="doctors_list" >
                          <option value="">-Select-</option>
                        </select>
                      </label>
                      <label >Branch
                        <select class="form-control" id="branches_list"  >
                        </select>
                      </label>
                      <label> Patient UHID No.
                        <input type="text" class="form-control" id="patient_uhid_search" value="" />
                      </label>
                      <label> Patient Name
                        <input type="text" class="form-control" id="patient_name_search" value="" />
                      </label>
                      </label>
                      <label> Patient Ph
                        <input type="text" class="form-control" id="patient_ph_search" value="" />
                      </label>
                      
                      <label>
                        <button id="filter_search" onclick="get_doctors_schedule2();">Filter</button>
                      </label>
                      
                    </div>
                  </div>
                  
                  <div class="col-md-12"><center><span id="appt_list_span"></span></center></div>
                  
                </div>
              </div>
              
              <table class="table table-striped table-hover table-bordered" id="get_appt_list">                
                <thead>
                   <tr>
                    <th style="width: 20px;"  class="noExport" >Sl No.</th>
                    <th style="width: 20px;">Doc Wise <br/>Sl No.</th>
                    <th style="width: 80px;" class="noExport_new" >Appt. Date</th>
                      <th style="width: 80px;">Time</th>
                      <th style="width: 150px;">Patient Name</th>
                      <th style="width: 80px;">Age/Sex</th>
                    <th style="width: 100px;">UHID No.</th>                    
                      <th style="width: 80px;">Ref By</th>
                      <th style="width: 100px;">Description</th>                      
                    <th style="width: 80px;">Phone No.</th>
                    <th style="width: 150px;">Created By</th>
                    <th style="width: 50px;" class="noExport">Action</th>
                   <!-- <th style="width: 50px;">DOC</th>-->
                  </tr>
                </thead>
                <tbody id="get_appt_tbody">                
                </tbody>
              </table>
            </div>
            
            
          </div>
          
          <!-- END EXAMPLE TABLE PORTLET--> 
          
        </div>
        <div class="ajax-loader"> <img src="<?php echo ADMIN_URL; ?>icon/loader.gif" class="img-responsive" /> </div>
      </div>
      
      <!-- END PAGE CONTENT INNER --> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTENT --> 
  
</div>

<!-- END PAGE CONTAINER -->

<?php include_once("footer_for_appt.php"); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js" type="text/javascript"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js" integrity="sha512-RLw8xx+jXrPhT6aXAFiYMXhFtwZFJ0O3qJH1TwK6/F02RSdeasBTTYWJ+twHLCk9+TU8OCQOYToEeYyF/B1q2g==" crossorigin="anonymous"></script> 
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> 

<!--<script src="select2/select2.min.js"></script>--> 

<script> 


 $(document).ready( function() { 

 

 
 $("#doctors_list").select2();	
 
  $("#from_date").datepicker({
	   format: 'dd-mm-yyyy'
   	});
   $("#to_date").datepicker({
	   format: 'dd-mm-yyyy'
   });
  
   
   

 });

 	



load_branches();

load_doctors("2");
//load_procedures();



function get_doctors_schedule2(){

get_appt_list_details();

}




function restore_val(id){

	const sms_flag=0;

	//alert(id);

	

	if(!confirm("Are you sure you want to restore the appointment?")) return;

	//if(confirm("Do you want to send cancelled SMS to the patient?")) sms_flag=1;

	$.ajax({



				url: 'get_json_data_for_appt.php?flag=67',



				dataType: 'json',



				type: 'POST',



				data: "id="+id+"&sms_flag="+sms_flag,



				success: function (data) {



					if(data.flag=="1"){



					 alert("You are successfully restored the schedule");



					 $("#ajax_password").modal('hide');

					  location_change();

					}

				 }



				 });
}

function delete_val_edit(id){

	const sms_flag=0;

	$.ajax({
				url: 'get_json_data_for_appt.php?flag=13',
				dataType: 'json',
				type: 'POST',
				data: "id="+id+"&sms_flag="+sms_flag,
				success: function (data) {
					if(data.flag=="1"){
					 /*alert("You are successfully deleted the schedule");
					 $("#ajax_password").modal('hide');*/
					  location_change();

					}

				 }

				 });
}




function location_change(){
	
	 $('#filter_search').click();	
}

var get_appt_list_='';
get_appt_list_details();
function get_appt_list_details(){
	//if(get_appt_list_!="") get_appt_list_.destroy();
	$('#get_appt_list').DataTable().destroy();
	var data_details={
		"from_date": $('#from_date').val(),
		"to_date": $('#to_date').val(),
		"branches_list": $('#branches_list').val(),
		"doctors_list": $('#doctors_list').val(),
		"patient_name_search": $('#patient_name_search').val(),
		"patient_uhid_search": $('#patient_uhid_search').val(),
		"patient_ph_search": $('#patient_ph_search').val(),
	   }
	   $('#get_appt_tbody').html('');
	   $('#get_appt_list tbody').empty();
	   $('#appt_list_span').html('');
	   
	  
	   var title_span='Appointment Delete List';
	   var from_date=$('#from_date').val();
	   var to_date=$('#to_date').val();
	   var display_block=0;
	   if(from_date==''){
		   display_block=1;
	   }
	   if(to_date==''){
		   display_block=1;
	   }	   
	   if(display_block=='0'){
		   if(from_date!=to_date){
		   		title_span='Appointment Delete List From '+from_date+' To '+to_date;
				$('#appt_list_span').html(title_span);
	   		}
			else{
				title_span='Appointment Delete List On '+from_date;
				$('#appt_list_span').html(title_span);
			}
		   
	   }else{
		   title_span='Appointment Delete List';
		   $('#appt_list_span').html(title_span);
	   }
	   if(from_date!=to_date){
		   display_block=1;
	   }
	  
		let exportCols = ':not(.noExport)';
		if (display_block === 0) {
			exportCols += ':not(.noExport_new)';
		}
		
		let columnDefs = [];
			if (display_block === 0) {
				columnDefs.push({
					targets: 2,
					visible: false
				});
			} else {
				columnDefs.push({
					targets: 2,
					visible: true
				});
			}
		 
	 	
	   
	$.ajax({
		url: 'get_json_data_for_appt.php?flag=66',
		dataType: 'json',
		data: data_details,
		type: 'POST',
		success: function (data) {
			var html='';
			var sl=1;
			var background_colo=" ";
			$.each(data, function(index, element) {
				
				if(element.doc_sl=='1'){
					html +='<tr><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr_special">'+element.doctor_name+' </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td><td class="doc_tr"> </td></tr>';
				}
				background_colo=" ";
				if(element.mrd_no!=''){
					background_colo=" style='background-color: #d0e9c6;' ";
				}
			html +='<tr '+background_colo+'><td>'+element.sl+'</td><td>'+element.doc_sl+'</td><td>'+element.start_date+'</td><td>'+element.start_time+'</td><td>'+element.name+'</td><td>'+element.gender_age+'</td><td>'+element.mrd_no+'</td><td>'+element.ref_by+'</td><td>'+element.description+'</td><td>'+element.phone_no+'</td><td>'+element.created_by+'</td><td>'+element.action_tab+'</td></tr>';	
			sl++;});
			$('#get_appt_tbody').html('');
			
			$('#get_appt_tbody').html(html);
			
			get_appt_list_=$("#get_appt_list").DataTable( {
	
						"destroy": true,
	
						dom: 'Bfrtip',
						"ordering": false,						
						columnDefs: columnDefs,
							"buttons": [
							{
								extend: 'collection',
								text : 'Download',
								 orientation: 'landscape',
								pageSize: 'LEGAL',
								buttons: [	
									{ extend: 'excelHtml5', footer: true, title: title_span, exportOptions: { columns: exportCols } },
									{ extend: 'csvHtml5', footer: true, title: title_span, exportOptions: { columns: exportCols } },
									{ extend: 'pdfHtml5', footer: true, title: title_span, exportOptions: { columns: exportCols }},
									{ extend: 'print', footer: true, title: title_span, exportOptions: { columns: exportCols } }
								]
							}   
						],
	
						"pageLength": 25,
	
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


</script>