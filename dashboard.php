<?php include 'conn.php'; ?>

<?php include "header.php"; ?>

<style>

/* address phone-area hos-name */

.hos-name {

	font-weight: bold;

	font-size: 25px;

	margin-top: 10px;

	padding:10px;

	font-weight: bold;

}

.hos-unit, .address, .phone-area {

	margin-bottom: 0px;

	line-height: 14px;

	padding:10px;

	font-weight: bold;

}

.address, .phone-area, .bill-date, .payment-area {

 *font-family: 'Merchant';

 

}

.address {

 *font-size: 20px;

}

.phone-area, .billdate, .payment-area, .bill-patient, .bill-address {

 *font-size: 18px;

}

.bill-patient span, .bill-address span {

	font-weight: bold;

}

</style>

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

              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Welcome to Dashboard</span></div>

              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>

            </div>

            <div class="portlet-body" >     

            <!--style="border:1px solid orange;background: url('<?php echo ADMIN_URL.'upload/hospital_pic/'.$row_hospital_information['hospital_pic'];  ?>') no-repeat center;"-->         

              <p class="text-center"></p>

              <p class="text-center"><img src="<?php echo ADMIN_URL.'upload/hospital_logo/'.$row_hospital_information['hospital_logo'];  ?>" alt="logo" class="logo-default"></p>

              <h4 class="text-center hos-name"> <?php echo $row_hospital_information['hospital_name']; ?></h4>

              <p class="text-center address"><?php echo $row_hospital_information['address']; ?></p>

              <p class="text-center phone-area">Phone: <?php echo $row_hospital_information['phone']; ?>, Email: <?php echo $row_hospital_information['email']; ?></p>

              <p class="text-center phone-area">Website: <?php echo $row_hospital_information['website']; ?></p>

              <!--<p class="text-center phone-area">REGN. NO.: <?php echo $row_hospital_information['hos_reg_no']; ?></p>

              <p class="text-center phone-area">GSTIN No.: <?php echo $row_hospital_information['gst_in']; ?></p>

              <p class="text-center phone-area">Drug Licence No.: <?php echo $row_hospital_information['drug_licence']; ?></p>-->

              <br/>

              <p class="text-center"><img src="<?php echo ADMIN_URL.'upload/hospital_pic/'.$row_hospital_information['hospital_pic'];  ?>" alt="logo" class="logo-default"></p>

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

<script src="newjs/jquery.min.js" type="text/javascript"></script> 

<script>

 $(document).ready( function() {       

  setTimeout('$("#alert_msg").hide()',3000);

 });

 

function check(id){

  setInterval(function(){

   $('#error_msg').html('');

  }, 5000);

 

} 

</script> 

<!-- END PAGE CONTAINER -->

<?php include "footer.php" ?>

