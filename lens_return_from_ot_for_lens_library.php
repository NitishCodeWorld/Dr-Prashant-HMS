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
      <?php
  	include("lens_menu_for_lens_library.php");
  ?>
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-blue-sharp"></i> <span class="caption-subject font-blue-sharp bold uppercase"><?php echo strtoupper(str_replace('_',' ',substr(basename($_SERVER['PHP_SELF']),0,-17)));?></span></div>
            </div>
          </div>
          <div class="portlet" style="min-height:50px; margin-bottom:0px">
            <div class="portlet-body">
              <div class="col-md-1" style="margin-top:8px; font-weight:bold; text-align:right; padding-right:0px; margin-left:-59px;">UHID:</div>
              <div class="col-md-3" style="padding-left:0px; padding-right:2px"> 
                <!--<input type="text" class="form-control" placeholder="Enter UHID" name="uhid" id="uhid" />-->
                <select name="patient_uhid" id="patient_uhid" class="form-control select2" onChange="old_pres_pb_fetch_model()">
                  <option value="">Choose..</option>
                  <?php 
                       $sql7="SELECT * FROM `patient_registration_form`  WHERE  `del_flag`='0'   ORDER BY `id` DESC";
                       $result7=$conn->query($sql7) ;
                       while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                       {									 
                           echo '<option value="'.$row7['uhid_no'].'" ';  echo '>'.$row7['uhid_no'].' ( '.$row7['patient_name'].' '.$row7['phone_no'].' )</option>';
                       }
                      ?>
                </select>
              </div>
              <!--<div class="col-md-1">
                <button class="btn-circle btn green" onClick="get_patient_details()">Go</button>
              </div>-->
              <div style="clear:both"></div>
              <div class="col-md-3" style="padding-left:0px; padding-right:2px">
                <input type="text" class="form-control" placeholder="Customer Name" name="customer_name" id="customer_name" />
              </div>
              <div class="col-md-2" style="padding-left:0px; padding-right:2px">
                <input type="text" class="form-control" placeholder="Date" name="inv_date" id="inv_date" value="<?php echo date("d/m/Y") ?>" />
              </div>
              <div style="clear:both"></div>
              <div class="col-md-3" style="padding-left:0px; padding-right:2px">
                <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" id="phone_number" />
              </div>
              <div class="col-md-1" style="padding-left:0px; padding-right:2px">
                <select id="doctors" class="form-control" style="width:200px">
                  <option value="">-Select-</option>
                </select>
              </div>
            </div>
          </div>
          
          <!-- END PAGE CONTENT INNER --> 
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-12" style="overflow:auto">
          <table class="table table-striped table-bordered table-hover small" id="asset_entry_data">
            <caption>
            Lens Issued
            </caption>
            <thead>
              <tr>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Lens Name </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Batch </span></th>
                <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Bar Code </span></th>
                <th class="draggable right" data-column="qty" style="cursor: move;"><span>Qty </span></th>
                <td class="print_ignore"><span>Action</span></td>
              </tr>
            </thead>
            <tbody id="lens_issued">
            </tbody>
          </table>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel"><strong>Select Prescription Date</strong></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body" id="old_patient_date_popup_show"> </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!--<div class="col-xs-4 col-md-3"><input type="button" class="btn" value="Export To PDF" style="background:#000099;color:#FFFFFF;width:120px" /></div>-->
        
        <div class="col-xs-12 col-md-12" style="text-align:center">
          <input type="button" class="btn" onClick="save_return()" value="Save" style="background:#000099;color:#FFFFFF;width:120px" />
        </div>
      </div>
      <table class="table table-striped table-bordered table-hover small" id="full_tab_details">
          <caption>
          Full Order Details <strong style="float:right;display:flex;line-height:34px;">Search:&nbsp;&nbsp;
          <input type="text" class="form-control" name="search" id="search" value="" style="width:100%;"/>
          </strong>
          </caption>
          <thead>
            <tr>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>UHID</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Patient Name</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Asset Name</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Qty</span></th>
              <th class="draggable" data-column="asset_name" style="cursor: move;"><span>Batch</span></th>
              <th class="draggable" data-column="category_name" style="cursor: move;"><span>Bar Code</span></th>
              <th class="draggable" data-column="sub_cat"><span>Manufacturing Date</span></th>
              <th class="draggable right" data-column="qty" style="cursor: move;"><span>Expiry Date</span></th>
              <th class="draggable right" data-column="qty" style="cursor: move;"><span>Status</span></th>
              <th class="draggable right" data-column="qty" style="cursor: move;"><span>Date</span></th>
            </tr>
          </thead>
          <tbody id="tab_po_body">
          </tbody>
        </table>
        <?php 
                $sql_="select * from `lens_issued_for_lens_library` where sold='2'";
                $result=mysqli_query($conn,$sql_);
                $count=$result->num_rows;  
                $count_limit=ceil($count / $limit);
                echo '<div class="col-md-6" style="float:right;text-align:right;">';
                for ($page_number = 1; $page_number <=$count_limit; $page_number++) {
                  echo '<a href="javascript:void(0);" class="btn btn-primary" onClick="load_sale_order_details('.$page_number.')">'.$page_number.'</a>';
                }
                echo '</div>';
                ?>
        <input type="hidden" name="row_limit" id="row_limit" value="<?php echo $limit?>">
      <!-- END PAGE CONTENT --> 
      
    </div>
  </div>
  
  <!-- END PAGE CONTAINER --> 
  
</div>
<?php include("footer_for_optical.php"); ?>
<script>

load_doctors();
$('#patient_uhid').select2();
//let sold_=[];
let returned_=[];
var cou_pag_no=0;
load_sale_order_details(cou_pag_no);
$( document ).ready(function() {	
	/*$("#uhid").keypress(function(event){
		if ( event.which == 13 ) {
			//console.log(search_code($(this).val()));
			get_patient_details();
	});*/
	$('#item').select2();
	$('#doctors').select2();
	$("#search").on("keyup", function() {
		  var value = $(this).val().toLowerCase();
		  $("#tab_po_body tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		  });
		});

});
function data_reset(){
	$("#assets_indent_body").html("");
	$("#indent").val('');
	$("#vendor_name").val('');
	load_purchase();
}
function load_doctors(id){
//alert(id);
	$('#doctors').empty();
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=35',
			dataType: 'json',
			type: 'POST',
			success: function (data) {
			 $.each(data, function(index, element) {
			 	$('#doctors').append($('<option/>', { 
					value: element.id,
					text : element.text 
				}));
		 	});
			if(id!="")	$("#doctors").select2("val", id);
			 }
		  });}
function get_patient_details(){
	$("#customer_name").val('');
	$("#phone_number").val('');
	var uhid=$("#uhid").val();
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=34',
			type: 'POST',
			dataType: 'json',
			data: "uhid="+uhid,
			//async: false, 
			success: function (data) {
				$("#customer_name").val(data.name);
				$("#phone_number").val(data.mobile);
				//$("#doctors").val(data.primary_doctor);
				//$("#doctors").select2("val", data.primary_doctor);
				load_doctors(data.doc_id);
				get_lens_issued();
			}
		});
}
function old_pres_pb_fetch_model() {
			$("#uhid").val('');
			if($("#patient_uhid").val()==''){
				alert('Please Select UHID');
				return false;	
			}
			var mrd= $("#patient_uhid").val();
			$("#uhid").val(mrd);
            $("#old_patient_date_popup_show").html("loading...");
            var form_data = {
                "mrd": mrd,
                "id": '1'
            }
            $.ajax({
                url: '<?php echo ADMIN_URL; ?>ajax_for_emr/dr_pb_values_fetch_from_trenetralaya_for_emr.php?flag=3',
                dataType: 'json',
                type: 'POST',
                data: form_data,
                success: function(data) {
                    //alert(data);
                    $('#exampleModal').modal();
                    $("#old_patient_date_popup_show").html("");
                    $.each(data, function(index, element) {
                        //var html='<a href="javascript:void(0)" target="_blank">'+data.created_on+'</a>';
                        var html = '<label><span id="mrd"><a href="javascript:void(0)" onClick="old_pres_pb_fetch(\'' + element.id + '\',\'' + element.created_on + '\');">' + element.created_on + '</a></span></label><br>';
                        $("#old_patient_date_popup_show").append(html);
                    });
                }
            });
} 
function old_pres_pb_fetch(p_id,created_on) {
			 $("#uhid").val('');
			 if($("#patient_uhid").val()==''){
				alert('Please Select UHID');
				return false;	
			}
			var mrd= $("#patient_uhid").val();
			$("#uhid").val(mrd);	
			 $("#customer_name").val('');
			 $("#phone_number").val('');
            $('#exampleModal').modal('hide');
            //alert(p_id);
            var data = {
                "mrd": mrd,
                "id": p_id
            }
            $.ajax({
                beforeSend: function() {
                    $('.ajax-loader').css("visibility", "visible");
                },
                url: "<?php echo ADMIN_URL; ?>ajax_for_emr/dr_pb_values_fetch_from_trenetralaya_for_emr.php?flag=2",
                type: "POST",
                dataType: 'json',
                data: data,
                success: function(data) {
					$("#customer_name").val(data.patient_name);
					$("#phone_number").val(data.mobile);
					//load_doctors(data.doc_id);
					$('#inv_date').val(created_on);
					$("#doctors").select2("val", data.primary_doctor);
					get_lens_issued();
                },
                complete: function() {
                    $('.ajax-loader').css("visibility", "hidden");
                }
            });
}

function get_lens_issued(){
	uhid=$("#patient_uhid").val();
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=46',
			type: 'POST',
			dataType: 'json',
			data: "uhid="+uhid,
			async: false, 
			success: function (data) {				
		 		$("#lens_issued").html(data.ret_val);
				//alert(data.ret_val);
			}
		});
}
function sold(id,flag){
	let code='';
	if(flag==0){
		//if(sold_.indexOf(id)>=0) sold_.pop(id); 
		returned_.push(id);
	 	code='<b>Returned</b> <button class="btn btn-success" onclick="sold('+id+',2)">Undo</button>';
	}/*else if(flag==1){
		if(returned_.indexOf(id)>=0) returned_.pop(id);
	 	sold_.push(id);
	 	code='<b>Sold</b> <button class="btn btn-success" onclick="sold('+id+',2)">Undo</button>';
	}*/else{
		//if(sold_.indexOf(id)>=0) sold_.pop(id);
		if(returned_.indexOf(id)>=0) returned_.pop(id);
	 	code='<button class="btn btn-danger" onclick="sold('+id+',0)">Return</button>';
	}

	$("#"+id).html(code);	
}
function save_return(){
//console.log(returned_);return false;
	data={
		//"sold":sold_,
		"returned":returned_,
		"mrd":uhid
	}
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=47',
			type: 'POST',
			dataType: 'json',
			data: data,
			async: false, 
			success: function (data) {				
		 		if(data.flag=="1") toastr.success('Return Saved Successfully');
				else toastr.error('Unable to save return');
				setTimeout(function(){ location.reload(); }, 2000);	
			}
		});
}
function load_sale_order_details(cou_pag_no){
	let initial_page=(cou_pag_no!=0 ) ? parseFloat(cou_pag_no-1)*parseFloat($('#row_limit').val()) : cou_pag_no;
	var data_details={
		"initial_page": initial_page,
		"limit": <?php echo $limit;?>
	}
	$.ajax({
            url: 'get_json_data_for_lens_library.php?flag=56',
			dataType: 'json',
			type: 'POST',
			data:data_details,
			success: function (data) {
				var html='';
				 $.each(data, function(index, element) {
					  	if(element.status=='2'){
						var colour='#e011111f'; 
						 }else{
							 var colour='';
						 }
					 /*$arr[]=array("asset_name"=>$asset_name,"id"=>$id,"batch"=>$batch,"mrd"=>$mrd,"patient_name"=>$patient_name,"doctor_name"=>$doctor_name,"manufacturing_date"=>$mfg_date_,"expiry_date"=>$expiry_date,"status"=>$status,"bar_code"=>$bar_code,"qty"=>$qty);*/
					html +='<tr style="background-color:'+colour+'"><td>'+element.mrd+'</td><td>'+element.patient_name+'</td><td>'+element.asset_name+'</td><td>'+element.qty+'</td><td>'+element.batch+'</td><td>'+element.bar_code+'</td><td>'+element.manufacturing_date+'</td><td>'+element.expiry_date+'</td><td>'+element.sold+'</td><td>'+element.created_on+'</td></tr>';
				});
				$('#tab_po_body').html(html);
			 }
		  });

}
</script>
</body><!-- END BODY -->

</html>