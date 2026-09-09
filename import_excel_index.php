<?php 
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

                

                

                <!-- BEGIN FORM-->

                <form action="import_excel.php" method="post" enctype="multipart/form-data" class="horizontal-form">

                  <div class="form-body">

                   

                    <div class="row" style="background:#dcefff;!important; padding:9px 0px">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label class="control-label">CSV/Excel File:</label>

                          <input type="file" name="file" id="file" class="input-large">

                        </div>

                      </div>
                      <div class="col-md-3">

                        <div class="form-group">

                         <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>

                        </div>

                      </div>

                      
                    </div>

                  </div>

                </form>

                <!-- END FORM--> 

                

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

          <th>MRD No. / <br /> Hospital No.</th>
          <th>OLD Prefix</th>

          <th>Patient Name</th>

          <th>Reg Date</th>

          <th>DOB</th>

          <th>Gender</th>

          <th>Mobile</th>
          <th>Address</th>

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

	 

</script> 



<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>