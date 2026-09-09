<?php 
include 'conn.php';
?>
<?php include_once("header_for_appt.php"); ?>
<!--<link href="https://fullcalendar.io/css/base.css?3.1.0-1.5.0-2" rel="stylesheet" type="text/css"/>-->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css" integrity="sha512-eOKbnuWqH2HMqH9nXcm95KXitbj8k7P49YYzpk7J4lw1zl+h4uCjkCfV7RaY4XETtTZnNhgsa+/7x29fH6ffjg==" crossorigin="anonymous" />
<style>

	body {
		margin: 20px 10px;
		padding: 0;
		font-family: Tahoma,Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}
	
	

.fc-day-grid-event .fc-content{
	white-space:normal;
	padding:0px;
}
	
	#index-page #calendar .fc-event{
		border-style: none !important;
	}

</style>
</head>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container"> 
  <!-- BEGIN PAGE HEAD -->
  <div class="page-head">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1><small>Welcome to Holiday Enlistment</small></h1>
      </div>
      <!-- END PAGE TITLE --> 
    </div>
  </div>
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
      <div id="main">
        <div class="modal fade" id="ajax_2" role="large" aria-hidden="true">
          <div class="modal-dialog" style="width:500px">
            <div class="modal-content">
              <div class="modal-body" id="mb">
                <div>
                  <label>Date <span id="my_date"></span>
                    <input type="hidden" id="my_dateh" />
                  </label>
                </div>
                Name of holiday:
                <textarea name="holiday" id="holiday" ></textarea>
                <br/>
                <BR/>
                <input type="button" value="Save" id="save_but" data-dismiss="modal" onClick="$('#id_val').val('');save_off_date($('#event_name').val(),$('#event_color').val())" />
                &nbsp;&nbsp;&nbsp;
                <input type="button" data-dismiss="modal" value="Close" />
                </label>
              </div>
            </div>
          </div>
        </div>
        <div id='calendar'></div>
      </div>
      <!-- END PAGE CONTENT INNER --> 
    </div>
  </div>
  <!-- END PAGE CONTENT --> 
</div>
<!-- END PAGE CONTAINER -->
<?php include_once("footer_for_appt.php"); ?>
<script>
	$( ".dtpicker" ).datepicker();
	
	$('.dtpicker').on('changeDate', function(ev){
    $(this).datepicker('hide');
});

	
	function remove_me(obj){
	
		$(obj).closest('.row').remove();
		
	
	}
	
	
	
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js" integrity="sha512-RLw8xx+jXrPhT6aXAFiYMXhFtwZFJ0O3qJH1TwK6/F02RSdeasBTTYWJ+twHLCk9+TU8OCQOYToEeYyF/B1q2g==" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
jQuery(document).ready(function() {

	Metronic.init(); // init metronic core componets
   //Layout.init(); // init layout
   Demo.init(); // init demo features
   ComponentsPickers.init();
	$('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });
  
	$('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });
  
  load_doctors("2");


//load_locations();


//$('#ajax_3').modal();
var dd;
$('#calendar').fullCalendar({
        header: {
				left: 'prev,next today',
				center: 'title',
				/*right: 'month,agendaWeek,agendaDay,listWeek'*/
				right: 'month'
			},
		dayRender: function (date, cell) {
      			cell.css("white-space", "normal");
				dd = new Date(date);       
    	},
		 dayClick: function(date) {
		 	var d = new Date(date);
			$('#my_date').html(d.getDate() + '/' + (d.getMonth()+1) + '/' + d.getFullYear());
			$('#my_dateh').val(d.getFullYear() + '-' + (d.getMonth()+1) + "-" + d.getDate());
			$('#ajax_2').modal();
			//alert('a day has been clicked!'+d.getDate() + '/' + (d.getMonth()+1) + '/' + d.getFullYear());
		  },
		 eventAfterRender: function(event, element, view) {
                      $(element).css('width','auto');
                    },

		displayEventTime: false,
		eventRender: function(event, element) {                                          
			element.find('span.fc-title').html(element.find('span.fc-title').text());
						  
		},
		viewRender: function( view, element ) {
    // this event fires whenever the month is changed
    
			
		},
		eventClick: function(info) {
			if(confirm("Are you sure you want to delete it?")){
			
			$.ajax({
				url: "get_json_data_for_appt.php?flag=19",
				type: 'POST',
				dataType : "json",
				data: {
					"id": info.id
				},
				success : function(data) {
				//alert(data.flag);
				if(data.flag=="1"){
					alert('Data Successfully Deleted');
					reload_calendar();
				}else alert('Unable to delete data');
				
				}
				
			
			
			});
			}
		},		
		height: 850,
		aspectRatio: 2,
		contentHeight: "auto",	
		events: {
		url: 'get_json_data_for_appt.php?flag=17',
		method: 'POST',
		data:function() {
      	return {
        
      	};
    	} 
	  }

    // any other sources...

  
		
		
    }); 
	
	
	$('#calendar').on('dateClick', function(info) {
  		console.log('clicked on ' + info.dateStr);
});
	
	

});


function save_off_date(event_val,event_color){

	//alert($("#event_color").val());
	var data_val={
			holiday_date:$("#my_dateh").val(),
			holiday_reason:$("#holiday").val(),
			flag:"18"			
	};
	 $.ajax({
			type : "POST",
			url : "get_json_data_for_appt.php",
			dataType : "json",
			data : data_val,
			success : function(data) {
				//alert(data.msg);
				if(data.flag=="1"){
					alert('Data Successfully Saved');
					reload_calendar();
					$("#my_dateh").val('');
					$("#holiday").val('');
				}else alert('Unable to save data');
			}
		});
		

}

function reload_calendar(){
	 $('#calendar').fullCalendar( 'refetchEvents' );
}

</script>
</html>